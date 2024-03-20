<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Level_Peserta extends CI_Controller
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
		$data['title'] = "Level_Peserta :: My Asisten";
		$data['judul'] = 'Level_Peserta';
		$data['linkpage'] = '';
		$this->template->load('home', 'Level_Peserta', $data);
	}

	function load_level_peserta()
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_peserta_level',
			'order' => 'kd_level_peserta DESC'
		];

		$res = $this->Modular->queryBuild($req)->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_level_peserta . '=t_peserta_level=kd_level_peserta=Level_Peserta=0.jpg';
			$data = [
				'id' 					=> $value->kd_level_peserta,
				'ids' 					=> $iddata,
				'nama_level_peserta'	=> $value->nama_level_peserta,
				'warna_level'		 	=> $value->warna_level,
			];
			array_push($output, $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_level_peserta()
	{
		$data['title'] 			= "Level_Peserta :: My Asisten";
		$data['judul'] 			= 'Form Level_Peserta';
		$data['url'] 			= base_url('Level_Peserta/Insert_level_peserta');
		$data['id'] 			= rand(0, 99) . date('mdh');
		$data['nama_level_peserta']    = '';
		$data['warna_level'] 	= '';
		
		$this->template->load('home', 'form_level_peserta', $data);
	}

	function Insert_level_peserta()
	{

		$req = [
			'method' => 'insert',
			'table' => 't_peserta_level',
			'value' => [
				'nama_level_peserta'	=> $this->input->post('nama_level_peserta'),
				'warna_level'		 	=> $this->input->post('warna_level'),
			]
		];
		
		$this->Modular->queryBuild($req);

	}

	function edit_level_peserta($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_peserta_level',
			'where' => [
				'kd_level_peserta' => $id
			]
		];

		$row = $this->Modular->queryBuild($req)->row();
		$data['title'] = "Update Level_Peserta :: My Asisten";
		$data['judul'] = 'Update Level_Peserta ';
		$data['url'] = base_url('Level_Peserta/update_level_peserta');
		$data['id'] = $id;
		$data['nama_level_peserta'] 	= $row->nama_level_peserta;
		$data['warna_level'] 			= $row->warna_level;
		$this->template->load('home', 'form_level_peserta', $data);
		
	}

	function update_level_peserta()
	{
		$req = [
			'method' => 'update',
			'table' => 't_peserta_level',
			'value' => [
				'nama_level_peserta' 	 => $this->input->post('nama_level_peserta'),
				'warna_level' 	 => $this->input->post('warna_level'),
			],
			
			'where' => ['kd_level_peserta' => $this->input->post('id')]
		];
		
		$this->Modular->queryBuild($req);
	}
}