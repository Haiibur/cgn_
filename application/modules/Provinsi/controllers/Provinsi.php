<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Provinsi extends CI_Controller
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
		$data['title'] = "Provinsi :: My Asisten";
		$data['judul'] = 'Provinsi';
		$data['linkpage'] = '';
		$this->template->load('home', 'Provinsi', $data);
	}

	function load_provinsi()
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_provinsi',
			'order' => 'kd_provinsi DESC'
		];

		$res = $this->Modular->queryBuild($req)->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_provinsi . '=t_provinsi=kd_provinsi=Provinsi=0.jpg';
			$data = [
				'id' 				 => $value->kd_provinsi,
				'ids'				 => $iddata,
				'nama_provinsi'		 => '<b>' . $value->nama_provinsi . '</b>',
			];
			array_push($output, $data);
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_provinsi()
	{
		$data['title'] 			= "Provinsi :: My Asisten";
		$data['judul'] 			= 'Form Provinsi';
		$data['url'] 			= base_url('Provinsi/Insert_provinsi');
		$data['id'] 			= rand(0, 99) . date('mdh');
		$data['nama_provinsi']  = '';
		
		$this->template->load('home', 'form_provinsi', $data);
	}

	function Insert_provinsi()
	{
		$req = [
			'method' => 'insert',
			'table' => 't_provinsi',
			'value' => [
				'nama_provinsi'		 => $this->input->post('nama_provinsi'),
			]
		];
		
		$this->Modular->queryBuild($req);
	}

	function edit_provinsi($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_provinsi',
			'where' => [
				'kd_provinsi' => $id
			]
		];

		$row = $this->Modular->queryBuild($req)->row();
		$data['title'] = "Update Provinsi :: My Asisten";
		$data['judul'] = 'Update Provinsi ';
		$data['url'] = base_url('Provinsi/update_provinsi');
		$data['id'] = $id;
		$data['nama_provinsi'] 	= $row->nama_provinsi;
		$this->template->load('home', 'form_provinsi', $data);
		
	}

	function update_provinsi()
	{
		$req = [
			'method' => 'update',
			'table' => 't_provinsi',
			'value' => [
				'nama_provinsi' 	 => $this->input->post('nama_provinsi'),
			],
			
			'where' => ['kd_provinsi' => $this->input->post('id')]
		];
		
		$this->Modular->queryBuild($req);
	}
}