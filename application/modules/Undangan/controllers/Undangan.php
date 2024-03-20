<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Undangan extends CI_Controller
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
		$data['title'] = "Undangan :: My Asisten";
		$data['judul'] = 'Undangan';
		$data['linkpage'] = '';
		$this->template->load('home', 'Undangan', $data);
	}

	function load_undangan()
	{
		$res = $this->Modular->Undangan()->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->id_undangan.'=t_undangan=id_undangan=Undangan=0.jpg';
			$data = [
				'id' 				 => $value->id_undangan,
				'ids'				 => $iddata,
				'id_undangan'		 => $value->id_undangan,
				'kode_undangan'		 => $value->kode_undangan,
				'nama_provinsi'		 => $value->nama_provinsi,
				'nama_kabupaten'	 => $value->nama_kabupaten,
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

	function form_tambah_undangan()
	{
		///// ID UNDANGAN /////
		$table1       = 't_undangan';
		$field1       = 'id_undangan';

		$lastKode1    = $this->Modular->getMax($table1, $field1);

		$noUrut1      = (int) substr($lastKode1, -4, 4);
		$noUrut1++;

		$str1         = 'ID';
		$id_undangan  = $str1 . sprintf('%04s', $noUrut1);
		///// END ID UNDANGAN /////

		///// KODE UNDANGAN /////
		// $table2       	= 't_undangan';
		// $field2       	= 'kode_undangan';

		// $lastKode2    	= $this->Modular->getMax($table2, $field2);

		// $noUrut2      	= (int) substr($lastKode2, -4, 4);
		// $noUrut2++;

		// $str2         	= 'ACR';
		// $kode_undangan  = $str2 . sprintf('%04s', $noUrut2);
		///// END KODE UNDANGAN /////

		$data['title'] 			= "Undangan :: My Asisten";
		$data['judul'] 			= 'Form Undangan';
		$data['url'] 			= base_url('Undangan/Insert_undangan');
		$data['id'] 			= rand(0, 99) . date('mdh');

		$data['id_undangan']		= $id_undangan;
		$data['kode_undangan']		= '';
		$data['provinsi']		= $this->Modular->get_provinsi()->result();
		$data['nama_undangan']	= '';
		
		$this->template->load('home', 'form_undangan', $data);
	}

	function Insert_undangan()
	{	
		$req = [
			'method' => 'insert',
			'table' => 't_undangan',
			'value' => [
				'id_undangan'		=> $this->input->post('id_undangan'),
				'kode_undangan'		=> $this->input->post('kode_undangan'),
				'prov_kd'			=> $this->input->post('kd_provinsi'),
				'kab_kd'			=> $this->input->post('kd_kabupaten'),
			]
		];
		
		$this->Modular->queryBuild($req);
	}

	function edit_undangan($id)
	{

		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_undangan',
			'where' => [
				'id_undangan' => $id
			]
		];
		
		$row = $this->Modular->queryBuild($req)->row();
		$kabupaten=$this->Modular->get_kabupaten($row->kab_kd)->row();
		
		$data['title'] = "Update Undangan :: My Asisten";
		$data['judul'] = 'Update Undangan ';
		$data['url'] = base_url('Undangan/update_undangan');
		$data['id'] = $id;

		$data['id_undangan']		= $row->id_undangan;
		$data['kode_undangan']		= $row->kode_undangan;
		$data['provinsi']			= $this->Modular->get_provinsi()->result();
		$data['kab_kd'] 			= '';
		
		$this->template->load('home', 'form_undangan', $data);
		
	}

	function update_undangan()
	{
		$req = [
			'method' => 'update',
			'table' => 't_undangan',
			'value' => [
				'id_undangan'		=> $this->input->post('id_undangan'),
				'kode_undangan'		=> $this->input->post('kode_undangan'),
				'prov_kd'			=> $this->input->post('kd_provinsi'),
				'kab_kd'			=> $this->input->post('kd_kabupaten'),
			],
			'where' => ['id_undangan' => $this->input->post('id')]
		];
		
		$this->Modular->queryBuild($req);
	}
}