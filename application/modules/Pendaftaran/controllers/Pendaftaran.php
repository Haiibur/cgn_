<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->_isLogged();
	}

	function _isLogged()
	{
		if ($this->session->userdata('status_sesi') != TRUE) {
			redirect('login', 'refresh');
		}
	}

	public function index()
	{
		$data['title'] = "Pendaftaran :: My Asisten";
		$data['judul'] = 'Pendaftaran';
		$data['linkpage'] = '';
		$this->template->load('home', 'Pendaftaran', $data);
	}

	function load_pendaftaran()
	{
		$res = $this->Modular->Pendaftaran()->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_daftar.'=t_pendaftaran=kd_daftar=Pendaftaran=0.jpg';

			$detail=$value->nama_peserta."<br>Telp : ".$value->tlp_peserta."<br>Email : ".$value->email_peserta;
			$level='<span class="badge text-bg-secondary text-white" style="background-color:#'.$value->warna_level.'">'.$value->nama_level_peserta.'</span>';
			if($value->tgl_konfirmasi_hadir !=""){
				$hadirr='<span class="badge text-bg-success">Siap Hadir</span>';
				
			}else{
				$hadirr='<span class="badge text-bg-secondary text-danger">Belum Konfirmasi</span>';
			}
			$data = [
				'id' 				 => $value->kd_daftar,
				'ids'				 => $iddata,
				'kd_daftar'			 => $value->kd_daftar,
				'peserta'		 	 => $detail,
				'provinsi'	 	 	 => $value->nama_provinsi,
				'kabupaten'	 	 	 => $value->nama_kab,
				'level_peserta'	 	 => $level,
				//'username'		 	 => $value->username,
				//'password'			 => $value->password,
				'tgl_daftar'		 => $value->tgl_daftar,
				'tgl_verifikasi'	 => $value->tgl_verifikasi,
				'status_peserta'	 => $hadirr,
			];
			array_push($output, $data);
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function getkabupaten()
    {
        $kd_provinsi = $this->input->post('kd_provinsi', TRUE);
        $data = $this->Modular->get_kabupaten($kd_provinsi)->result();

        echo json_encode($data);
    }

	function form_tambah_pendaftaran()
	{
		///// ID Pendaftaran /////
		$table1       = 't_pendaftaran';
		$field1       = 'kd_daftar';

		$lastKode1    = $this->Modular->getMax($table1, $field1);

		$noUrut1      = (int) substr($lastKode1, -4, 4);
		$noUrut1++;

		$str1         = 'DFR';
		$kd_daftar  = $str1 . sprintf('%04s', $noUrut1);
		///// END ID Pendaftaran /////

		$data['title'] 			= "Pendaftaran :: My Asisten";
		$data['judul'] 			= 'Form Pendaftaran';
		$data['url'] 			= base_url('Pendaftaran/Insert_pendaftaran');
		$data['id'] 			= rand(0, 99) . date('mdh');

		$data['kd_daftar']			= $kd_daftar;
		$data['undangan_kd']		= $this->Modular->Undangan()->result();
		$data['nama_peserta']		= '';
		$data['tlp_peserta']		= '';
		$data['email_peserta']		= '';
		$data['level_peserta']		= $this->Modular->level_peserta()->result();
		$data['username']			= '';
		$data['password']			= '';
		$data['tgl_daftar']			= '';
		$data['tgl_verifikasi']		= '';
		$data['status_peserta']		= '';
		
		$this->template->load('home', 'form_pendaftaran', $data);
	}

	function Insert_pendaftaran()
	{	
		date_default_timezone_set('Asia/Jakarta');

		$req = [
			'method' => 'insert',
			'table' => 't_pendaftaran',
			'value' => [
				'kd_daftar'			 => $this->input->post('kd_daftar'),
				'undangan_kd'	 	 => $this->input->post('undangan_kd'),
				'nama_peserta'		 => $this->input->post('nama_peserta'),
				'tlp_peserta'	 	 => $this->input->post('tlp_peserta'),
				'email_peserta'	 	 => $this->input->post('email_peserta'),
				'level_peserta'	 	 => $this->input->post('level_peserta'),
				'username'		 	 => $this->input->post('username'),
				'password'			 => $this->input->post('password'),
				'tgl_daftar'		 => date("Y-m-d H:i:s"),
				'tgl_verifikasi'	 => '',
				'status_peserta'	 => $this->input->post('status_peserta'),
			]
		];
				
		$this->Modular->queryBuild($req);
	}

	function edit_pendaftaran($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_pendaftaran',
			'where' => [
				'kd_daftar' => $id
			]
		];
		
		$row = $this->Modular->queryBuild($req)->row();
				
		$data['title'] = "Update Pendaftaran :: My Asisten";
		$data['judul'] = 'Update Pendaftaran ';
		$data['url'] = base_url('Pendaftaran/update_pendaftaran');
		$data['id'] = $id;

		$data['kd_daftar']			= $row->kd_daftar;
		$data['undangan_kd']		= $this->Modular->Undangan()->result();
		$data['nama_peserta']		= $row->nama_peserta;
		$data['tlp_peserta']		= $row->tlp_peserta;
		$data['email_peserta']		= $row->email_peserta;
		$data['level_peserta']		= $this->Modular->level_peserta()->result();
		$data['username']			= $row->username;
		$data['password']			= $row->password;
		$data['tgl_daftar']			= $row->tgl_daftar;
		$data['tgl_verifikasi']		= '';
		$data['status_peserta']		= $row->status_peserta;
		
		$this->template->load('home', 'form_pendaftaran', $data);
		
	}

	function update_pendaftaran()
	{
		$req = [
			'method' => 'update',
			'table' => 't_pendaftaran',
			'value' => [
				'kd_daftar'			 => $this->input->post('kd_daftar'),
				'undangan_kd'	 	 => $this->input->post('undangan_kd'),
				'nama_peserta'		 => $this->input->post('nama_peserta'),
				'tlp_peserta'	 	 => $this->input->post('tlp_peserta'),
				'email_peserta'	 	 => $this->input->post('email_peserta'),
				'level_peserta'	 	 => $this->input->post('level_peserta'),
				'username'		 	 => $this->input->post('username'),
				'password'			 => $this->input->post('password'),
				'tgl_daftar'		 => date("Y-m-d H:i:s"),
				'tgl_verifikasi'	 => '',
				'status_peserta'	 => $this->input->post('status_peserta'),
			],
			'where' => ['kd_daftar' => $this->input->post('id')]
		];
		
		$this->Modular->queryBuild($req);
	}

	public function update_status($id, $status) {
        $req = [
            'method' => 'update',
            'table' => 't_pendaftaran',
            'value' => [
                'status_peserta' => $status,
            ],
            'where' => ['kd_daftar' => $id]
        ];

        // Panggil fungsi untuk menjalankan query pembaruan status
        $this->Modular->queryBuild($req);

		redirect('Pendaftaran');
    }
}