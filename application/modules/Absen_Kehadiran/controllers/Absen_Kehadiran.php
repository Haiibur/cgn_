<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen_Kehadiran extends CI_Controller
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
		$data['title'] = "Registrasi Peserta :: CSS XII Kota Cilegon";
		$data['judul'] = 'Registrasi Peserta';
		$data['linkpage'] = '';

		$this->template->load('home', 'Absen_Kehadiran', $data);
	}

	function simpanRegistrasi(){
		$kd_daftar=$this->input->post('kdpeserta');
		//cek data//
		$table="t_pendaftaran";
		$where=array('kd_daftar'=>$kd_daftar);
		$datapeserta=$this->Modular->Peserta($table,$where);
		if($datapeserta->num_rows() < 1){
			echo"0";//data tidak ada
		}else{
			foreach ($datapeserta->result() as $key => $value) {}
			if($value->status_peserta =="1"){
				echo"1";//belum konfirmasi kehadiran//
			}else if($value->status_peserta =="3"){
				echo"3";//sudah registrasi//
			}else{
				$data['peserta']=$datapeserta->result();
				$this->load->view('detail_peserta',$data);
			}
		}
	}
	function simpanRegistrasihadir(){
		$kd_daftar=$this->input->post('id');
		$table="t_pendaftaran";
		$where=array('kd_daftar'=>$kd_daftar);
		$data=array('status_peserta'=>'3','tgl_verifikasi'=>date('d M Y H:i:s'),'jam_verifikasi'=>date('H:i:s'));
		$this->Modular->UpdateData($table, $data, $where);
	}

	

	//load_absen_peserta//
	function load_absen_peserta()
	{
		
		$res = $this->Modular->Absen_KehadiranPeserta()->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_daftar.'=t_pendaftaran=kd_daftar==0.jpg';
			$peserta=$value->nama_peserta."<br>Telp : ".$value->tlp_peserta."<br>Email : ".$value->email_peserta;
			$data = [
				'id' 				 => $value->kd_daftar,
				'ids'				 => $iddata,				
				'jam'		 		 => $value->jam_verifikasi,
				'provinsi'			 => $value->nama_provinsi,
				'kab'			 	 => $value->nama_kab,
				'peserta'		 	 => $peserta,
				'level'	 			 => $value->nama_level_peserta,
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

	function form_tambah_absen_kehadiran()
	{
		$data['title'] 			= "Absen Kehadiran :: CSS XII Kota Cilegon";
		$data['judul'] 			= 'Form Absen Kehadiran';
		$data['url'] 			= base_url('Absen_Kehadiran/Insert_absen_kehadiran');
		$data['id'] 			= rand(0, 99) . date('mdh');

		$data['peserta_kd']		= $this->Modular->level_peserta()->result();
		$data['agenda_kd']		= $this->Modular->Agenda()->result();
		$data['provinsi']		= $this->Modular->get_provinsi()->result();
		
		$this->template->load('home', 'form_absen_kehadiran', $data);
	}

	function Insert_absen_kehadiran()
	{	
		date_default_timezone_set('Asia/Jakarta');

		$req = [
			'method' => 'insert',
			'table' => 't_absen_kehadiran',
			'value' => [
				'peserta_kd'		=> $this->input->post('peserta_kd'),
				'agenda_kd'			=> $this->input->post('agenda_kd'),
				'tgl_absen'			=> date("Y-m-d H:i:s"),
				'prov_kd'			=> $this->input->post('kd_provinsi'),
				'kab_kd'			=> $this->input->post('kd_kabupaten'),
			]
		];
		
		$this->Modular->queryBuild($req);
	}

	function edit_absen_kehadiran($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_absen_kehadiran',
			'where' => [
				'kd_hadir' => $id
			]
		];
		
		$row = $this->Modular->queryBuild($req)->row();
		$kabupaten=$this->Modular->get_kabupaten($row->kab_kd)->row();
		
		$data['title'] = "Update Absen_Kehadiran :: CSS XII Kota Cilegon";
		$data['judul'] = 'Update Absen_Kehadiran ';
		$data['url'] = base_url('Absen_Kehadiran/update_absen_kehadiran');
		$data['id'] = $id;

		$data['peserta_kd']		= $this->Modular->level_peserta()->result();
		$data['agenda_kd']		= $this->Modular->Agenda()->result();
		$data['provinsi']		= $this->Modular->get_provinsi()->result();
		
		$this->template->load('home', 'form_absen_kehadiran', $data);	
	}

	function update_absen_kehadiran()
	{
		$req = [
			'method' => 'update',
			'table' => 't_absen_kehadiran',
			'value' => [
				'peserta_kd'		=> $this->input->post('peserta_kd'),
				'agenda_kd'			=> $this->input->post('agenda_kd'),
				'tgl_absen'			=> date("Y-m-d H:i:s"),
				'prov_kd'			=> $this->input->post('kd_provinsi'),
				'kab_kd'			=> $this->input->post('kd_kabupaten'),
			],
			'where' => ['kd_hadir' => $this->input->post('id')]
		];
		
		$this->Modular->queryBuild($req);
	}
}