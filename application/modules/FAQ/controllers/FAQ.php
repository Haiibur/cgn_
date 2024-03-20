<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FAQ extends CI_Controller
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
		$data['title'] = "FAQ :: CSS XII Kota Cilegon";
		$data['judul'] = 'FAQ';
		$data['linkpage'] = '';
		$this->template->load('home', 'FAQ', $data);
	}

	function load_faq()
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_faq',
			'order' => 'kd_faq DESC'
		];

		$res = $this->Modular->queryBuild($req)->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_faq . '=t_faq=kd_faq=FAQ=0.jpg';
			$data = [
				'id' => $value->kd_faq,
				'ids' => $iddata,
				'pertanyaan'	 => $value->pertanyaan,
				'jawaban'		 => $value->jawaban,
			];
			array_push($output, $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_faq()
	{
		$data['title'] 			= "FAQ :: CSS XII Kota Cilegon";
		$data['judul'] 			= 'Form FAQ';
		$data['url'] 			= base_url('FAQ/Insert_faq');
		$data['id'] 			= rand(0, 99) . date('mdh');
		$data['pertanyaan']    	= '';
		$data['jawaban'] 		= '';
		
		$this->template->load('home', 'form_faq', $data);
	}

	function Insert_faq()
	{
		$req = [
			'method' => 'insert',
			'table' => 't_faq',
			'value' => [
				'pertanyaan'	 => $this->input->post('pertanyaan'),
				'jawaban'		 => $this->input->post('jawaban'),
			]
		];
		
		$this->Modular->queryBuild($req);
	}

	function edit_faq($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_faq',
			'where' => [
				'kd_faq' => $id
			]
		];

		$row = $this->Modular->queryBuild($req)->row();
		$data['title'] = "Update FAQ :: CSS XII Kota Cilegon";
		$data['judul'] = 'Update FAQ ';
		$data['url'] = base_url('FAQ/update_faq');
		$data['id'] = $id;
		$data['pertanyaan'] 	= $row->pertanyaan;
		$data['jawaban'] 		= $row->jawaban;
		$this->template->load('home', 'form_faq', $data);
		
	}

	function update_faq()
	{
		$req = [
			'method' => 'update',
			'table' => 't_faq',
			'value' => [
				'pertanyaan' 	 => $this->input->post('pertanyaan'),
				'jawaban' 	 	 => $this->input->post('jawaban'),
			],
			
			'where' => ['kd_faq' => $this->input->post('id')]
		];
		
		$this->Modular->queryBuild($req);
	}
}