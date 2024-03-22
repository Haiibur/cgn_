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

		// Grafik 1
		$reslist = $this->Modular->Grafik_list2()->result();
		$list_Kabupaten			 = array();
		$list_Siap 				 = array();
		$list_Tidak_Siap_Hadir 	 = array();
		foreach ($reslist as $key => $value) {
			$list_Kabupaten[] = $value->nama_kab;
			$list_Siap_Hadir[] = $value->Siap;
			$list_Tidak_Siap_Hadir[] = $value->Tidak_Siap;
		}

		// Grafik 2
		$reslist1 = $this->Modular->Grafik_list()->result();
		$list_nama_level1 = array();
		$list_Siap1 = array();
		$list_Tidak_Siap_Hadir1 = array();
		foreach ($reslist1 as $key => $value) {
			$list_nama_level1[] = $value->nama_level_peserta;
			$list_Siap_Hadir1[] = $value->Siap;
			$list_Tidak_Siap_Hadir1[] = $value->Tidak_Siap;
		}

		// Grafik 1
		$data['Kabupaten'] 	= json_encode($list_Kabupaten);
		$data['Siap_Hadir'] = json_encode($list_Siap_Hadir);
		$data['Tidak_Siap'] = json_encode($list_Tidak_Siap_Hadir);

		// Grafik 2
		$data['list_nama_level'] 	= json_encode($list_nama_level1);
		$data['Siap_Hadir1'] = json_encode($list_Siap_Hadir1);
		$data['Tidak_Siap1'] = json_encode($list_Tidak_Siap_Hadir1);
		
		$this->template->load('home', 'Grafik' ,$data);	
	}

	function load_grafik()
	{
		$res = $this->Modular->Grafik_list()->result();
		$output = array();
		
		foreach ($res as $key => $value) {

			$level='<span class="badge text-bg-secondary text-white" style="background-color:#'.$value->warna_level.'">'.$value->nama_level_peserta.'</span>';

			$data = [
				'level_peserta'	 	 => $level,
				'Siap'				 => $value->Siap,
				'Tidak_Siap'	 	 => $value->Tidak_Siap,
			];

			array_push($output, $data);
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function load_grafik2()
	{
		$res = $this->Modular->Grafik_list2()->result();
		$output = array();
		
		foreach ($res as $key => $value) {			
			$data = [
				'Kabupaten'	 	 	 => $value->nama_kab,
				'Jumlah_Undangan'	 => $value->Jumlah_Undangan,
				'Siap'				 => $value->Siap,
				'Tidak_Siap'		 => $value->Tidak_Siap,
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