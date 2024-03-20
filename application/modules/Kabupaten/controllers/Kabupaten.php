<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kabupaten extends CI_Controller
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
		$data['title'] = "Kabupaten :: My Asisten";
		$data['judul'] = 'Kabupaten';
		$data['linkpage'] = '';
		$this->template->load('home', 'Kabupaten', $data);
	}

	function load_kabupaten()
	{
		$res = $this->Modular->Kabupaten()->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_kabupaten.'=t_kabupaten=kd_kabupaten=Kabupaten=0.jpg';
			$data = [
				'id' 				 => $value->kd_kabupaten,
				'ids'				 => $iddata,
				'nama_provinsi'		 => $value->nama_provinsi,
				'nama_kabupaten'	 => '<b>' . $value->nama_kabupaten . '</b>',
			];
			array_push($output, $data);
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_kabupaten()
	{
		$data['title'] 			= "Kabupaten :: My Asisten";
		$data['judul'] 			= 'Form Kabupaten';
		$data['url'] 			= base_url('Kabupaten/Insert_kabupaten');
		$data['id'] 			= rand(0, 99) . date('mdh');

		$data['provinsi']		= $this->Modular->get_provinsi()->result();
		$data['nama_kabupaten']	= '';
		
		$this->template->load('home', 'form_kabupaten', $data);
	}

	function Insert_kabupaten()
	{	
		$req = [
			'method' => 'insert',
			'table' => 't_kabupaten',
			'value' => [
				'prov_kd'			=> $this->input->post('kd_provinsi'),
				'nama_kabupaten'	=> $this->input->post('nama_kabupaten'),
			]
		];
		
		$this->Modular->queryBuild($req);
	}

	function edit_kabupaten($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_kabupaten',
			'where' => [
				'kd_kabupaten' => $id
			]
		];

		$row = $this->Modular->queryBuild($req)->row();
		$data['title'] = "Update Kabupaten :: My Asisten";
		$data['judul'] = 'Update Kabupaten ';
		$data['url'] = base_url('Kabupaten/update_kabupaten');
		$data['id'] = $id;
		$data['provinsi']		= $this->Modular->get_provinsi()->result();
		$data['nama_kabupaten'] 	= $row->nama_kabupaten;
		$this->template->load('home', 'form_kabupaten', $data);
		
	}

	function update_kabupaten()
	{
		$req = [
			'method' => 'update',
			'table' => 't_kabupaten',
			'value' => [
				'prov_kd'			 =>$this->input->post('kd_provinsi'),
				'nama_kabupaten' 	 => $this->input->post('nama_kabupaten'),
			],
			
			'where' => ['kd_kabupaten' => $this->input->post('id')]
		];
		
		$this->Modular->queryBuild($req);
	}
}