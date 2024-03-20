<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->_isLogged();
	}

	function _isLogged() {
		if($this->session->userdata('status_sesi') != TRUE) {
			redirect('login', 'refresh');
		}
	}

	public function index() {
		$data['title'] 		= "Info Grafik :: CSS XII Kota Cilegon";
        $data['judul'] 		= 'Info Grafik';
        $data['linkpage'] 	= '';

		$res = $this->Modular->Grafik1()->result();
		
		$status_peserta = array();
		$JumlahData = array();
	
		foreach ($res as $key => $value) {
			$status_peserta[] = $value->status_peserta;
			$JumlahData[] = $value->jmlhdata;
		}

		$reslist = $this->Modular->Grafik_list()->result();
		
		$list_nama_level = array();
		$list_status_peserta = array();
		$list_JumlahData = array();

		foreach ($reslist as $key => $value) {
			$list_nama_level[] = $value->nama_level_peserta;
			$list_status_peserta[] = $value->status_peserta;
			$list_JumlahData[] = $value->jmlhdata;
		}

		$data['Status'] = json_encode($status_peserta);
		$data['Jumlah'] = json_encode($JumlahData);
		$data['list_nama_level'] = json_encode($list_nama_level);		
		$data['List_Status'] = json_encode($list_status_peserta);
		$data['List_Jumlah'] = json_encode($list_JumlahData);
		
		$this->template->load('home', 'Grafik' ,$data);	
	}

	function load_grafik()
	{
		$res = $this->Modular->Grafik_list()->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_daftar.'=t_pendaftaran=kd_daftar=Pendaftaran=0.jpg';

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
				'level_peserta'	 	 => $level,
				'Jumlah_Data'		 => $value->jmlhdata,
				'status_peserta'	 => $hadirr,
			];
			array_push($output, $data);
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function buat_agd() {
        $data['title'] 		= "Buat Agenda :: CSS XII Kota Cilegon";
        $data['judul'] 		= 'Form Agenda';
        $data['linkpage'] 	='<a href="https://chat.openai.com/chat" target="_blank" class="btn btn-success btn-sm">Buat Naskah di ChatGPT</a>';
		$data['url'] 		= base_url('Agenda/simpan_agd');
		$data['id'] 		= rand(0, 99).date('mdh');
		$data['harike']		= $this->db->query("SELECT * FROM t_harike ORDER BY kdhari ASC")->result();
		$data['nama_agenda'] 		= '';
		$data['tgl_agenda'] 		= '';
		$data['jam_agenda'] 		= '';		
		$data['kd_venue'] 			= $this->Modular->Venue()->result();
		$data['jumlah_peserta'] 	= '';
		$data['keterangan'] 		= '';
		$data['harike1'] 			= '';
		$data['venue'] 				= '';
		$data['absen'] 				= '';

		$this->template->load('home', 'form_agenda' ,$data);	
	}

	function simpan_agd() {
		$req = [
			'method' => 'insert',
			'table' => 't_agenda',
			'value' => [
				'kd_venue' 	 			 => $this->input->post('kd_venue'),
				'harike' 	 			 => $this->input->post('harike'),
				'nama_agenda' 	 		 => $this->input->post('nama_agenda'),
				'absen' 			 	 => $this->input->post('absen'),
				'jam_agenda' 			 => $this->input->post('jam_agenda'),
				'jumlah_peserta'		 => $this->input->post('jumlah_peserta'),
				'keterangan' 	 		 => $this->input->post('keterangan')
			]
		];
		$this->Modular->queryBuild($req);
	}

	function edit_agd($id) {
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_agenda',
			'where' => [
				'kd_agenda' => $id
			]
		];
		$row = $this->Modular->queryBuild($req)->row();
        $data['title'] 		= "Update Agenda :: CSS XII Kota Cilegon";
        $data['judul'] 		= 'Update Agenda ';
        $data['linkpage'] 	='<a href="https://chat.openai.com/chat" target="_blank" class="btn btn-success btn-sm"></a>';
		$data['url'] 		= base_url('Agenda/update_agd');
		$data['harike']		=$this->db->query("SELECT * FROM t_harike ORDER BY kdhari ASC")->result();
		$data['id']			= $id;
		$data['nama_agenda'] 		= $row->nama_agenda;
		$data['harike1'] 			= $row->harike;
		$data['absen'] 				= $row->absen;
		$data['venue'] 				= $row->kd_venue;
		$data['jam_agenda'] 		= $row->jam_agenda;
		$data['kd_venue'] 			= $this->Modular->Venue()->result();
		$data['jumlah_peserta'] 	= $row->jumlah_peserta;
		$data['keterangan'] 		= $row->keterangan;
		
		$this->template->load('home', 'form_agenda' ,$data);	
	}

	function update_agd() {
		$req = [
			'method' => 'update',
			'table' => 't_agenda',
			'value' => [
				'kd_venue' 			=> $this->input->post('kd_venue'),
				'harike' 	 			 => $this->input->post('harike'),
				'nama_agenda' 		=> $this->input->post('nama_agenda'),
				'absen' 			 	 => $this->input->post('absen'),
				'jam_agenda' 		=> $this->input->post('jam_agenda'),
				'jumlah_peserta' 	=> $this->input->post('jumlah_peserta'),
				'keterangan' 		=> $this->input->post('keterangan')
			],
			'where' => ['kd_agenda' => $this->input->post('id')]
		];
		$this->Modular->queryBuild($req);
	}
}