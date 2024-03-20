<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {
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
        $data['title'] = "Agenda :: CSS XII Kota Cilegon";
        $data['judul'] = 'Agenda';
        $data['linkpage'] ='';
		$this->template->load('home', 'agenda' ,$data);	
	}

	function load_agenda() {
		$res = $this->Modular->All_agenda()->result();
		$output = array();
		foreach ($res as $key => $value) {
			$iddata = $value->kd_agenda.'=t_agenda=kd_agenda=agenda=0.jpg';
			$harike=$this->db->query("SELECT * FROM t_harike WHERE kdhari='".$value->harike."'")->row();
			$data = [
				'id' 				=> $value->kd_agenda,
				'ids' 				=> $iddata,
				'harike'			=> $harike->nama_hari,
				'nama_agenda' 		=> $value->nama_agenda,
				'nama_venue' 		=> $value->nama_venue,
				'detail'			=> $value->jam_agenda,
				'jumlah_peserta' 	=> $value->jumlah_peserta
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
		$data['harike']		=$this->db->query("SELECT * FROM t_harike ORDER BY kdhari ASC")->result();
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