<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisata extends CI_Controller
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
		$data['title'] = "Wisata :: My Asisten";
		$data['judul'] = 'Wisata';
		$data['linkpage'] = '';
		$this->template->load('home', 'Wisata', $data);
	}

	function load_wisata()
	{
		$res = $this->Modular->Seleksi_foto_wisata()->result();
		$output = array();
		foreach ($res as $key => $value) {
			$iddata = $value->kd_wisata . '=t_wisata=kd_wisata=Wisata=0.jpg';			
			$data = [
				'id' 					 => $value->kd_wisata,
				'ids' 					 => $iddata,
				'nama_wisata'			 => $value->nama_wisata,
				'foto' 				   	 => base_url() . './assets/upload_hotel/' . $value->foto_ke,
				'ket_wisata'	 		 => $value->ket_wisata,
				'no_tlp'	 			 => $value->no_tlp,
			];

			array_push($output, $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_wisata()
	{
		$data['title'] 			= "Wisata :: My Asisten";
		$data['judul'] 			= 'Form Wisata';
		$data['url'] 			= base_url('Wisata/Insert_Wisata');
		$data['id'] 			= rand(0, 99) . date('mdh');

		$data['nama_wisata']   		= '';
		$data['foto_1'] 			= '';
		$data['foto_2'] 			= '';
		$data['foto_3'] 			= '';
		$data['foto_4'] 			= '';
		$data['foto_5'] 			= '';
		$data['ket_wisata']			= '';
		$data['no_tlp']				= '';
		
		$this->template->load('home', 'form_wisata', $data);
	}

	function Insert_Wisata()
	{
		// Konfigurasi untuk upload gambar lokasi
		$config['upload_path']   = './assets/upload_wisata';
		$config['allowed_types'] = 'mp4|mp3|jpg|jpeg|png|gif';
		$config['max_size']      = 6048;
		$this->load->library('upload', $config);
	
		$upload_errors = array();
		$gambar_files = array(); // Simpan nama file gambar
	
		// Loop untuk mengupload gambar 1-5
		for ($i = 1; $i <= 5; $i++) {
			$field_name = 'foto_' . $i;
	
			// Lakukan upload
			if ($this->upload->do_upload($field_name)) {
				$data_gambar = $this->upload->data();
				$gambar_files[$field_name] = $data_gambar['file_name'];
			} else {
				// Jika terjadi error, simpan pesan error
				$error = $this->upload->display_errors();
				if ($error != "You did not select a file to upload.") {
					$upload_errors[] = $error;
				}
			}
		}
	
		// Mengatur nilai default untuk variabel gambar
		$foto_1 = isset($gambar_files['foto_1']) ? $gambar_files['foto_1'] : 'NULL';
		$foto_2 = isset($gambar_files['foto_2']) ? $gambar_files['foto_2'] : 'NULL';
		$foto_3 = isset($gambar_files['foto_3']) ? $gambar_files['foto_3'] : 'NULL';
		$foto_4 = isset($gambar_files['foto_4']) ? $gambar_files['foto_4'] : 'NULL';
		$foto_5 = isset($gambar_files['foto_5']) ? $gambar_files['foto_5'] : 'NULL';
	
		// Insert data tanpa memeriksa keberadaan file gambar
		$req = [
			'method' => 'insert',
			'table' => 't_wisata',
			'value' => [
				'nama_wisata' 	 => $this->input->post('nama_wisata'),
				'foto_1' 		 => $foto_1,
				'foto_2' 		 => $foto_2,
				'foto_3' 		 => $foto_3,
				'foto_4' 		 => $foto_4,
				'foto_5' 		 => $foto_5,
				'ket_wisata' 	 => $this->input->post('ket_wisata'),
				'no_tlp' 		 => $this->input->post('no_tlp')
			]
		];
	
		$this->Modular->queryBuild($req);
	}

	function edit_wisata($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_wisata',
			'where' => [
				'kd_wisata' => $id
			]
		];

		$row = $this->Modular->queryBuild($req)->row();
		$data['title'] 			= "Update Wisata :: My Asisten";
		$data['judul'] 			= 'Update Wisata ';
		$data['url'] 			= base_url('Wisata/update_wisata');
		$data['id'] 			= $id;
		$data['nama_wisata'] 	= $row->nama_wisata;
		$data['foto_1']			= $row->foto_1;
		$data['foto_2'] 	 	= $row->foto_2;
		$data['foto_3'] 	 	= $row->foto_3;
		$data['foto_4'] 		= $row->foto_4;
		$data['foto_5'] 		= $row->foto_5;
		$data['ket_wisata']		= $row->ket_wisata;
		$data['no_tlp']			= $row->no_tlp;

		$this->template->load('home', 'form_wisata', $data);
		
	}

	function update_wisata()
	{
		// Konfigurasi untuk upload gambar lokasi
		$config['upload_path']   = './assets/upload_wisata';
		$config['allowed_types'] = 'mp4|mp3|jpg|jpeg|png|gif';
		$config['max_size']      = 6048;
		$this->load->library('upload', $config);
	
		$upload_errors = array();
		$gambar_files = array(); // Simpan nama file gambar
	
		// Loop untuk mengupload gambar 1-5
		for ($i = 1; $i <= 5; $i++) {
			$field_name = 'foto_' . $i;
	
			// Lakukan upload
			if ($this->upload->do_upload($field_name)) {
				$data_gambar = $this->upload->data();
				$gambar_files[$field_name] = $data_gambar['file_name'];
			} else {
				// Jika terjadi error, simpan pesan error
				$error = $this->upload->display_errors();
				if ($error != "You did not select a file to upload.") {
					$upload_errors[] = $error;
				}
			}
		}
	
		// Mengatur nilai default untuk variabel gambar
		$foto_1 = isset($gambar_files['foto_1']) ? $gambar_files['foto_1'] : 'NULL';
		$foto_2 = isset($gambar_files['foto_2']) ? $gambar_files['foto_2'] : 'NULL';
		$foto_3 = isset($gambar_files['foto_3']) ? $gambar_files['foto_3'] : 'NULL';
		$foto_4 = isset($gambar_files['foto_4']) ? $gambar_files['foto_4'] : 'NULL';
		$foto_5 = isset($gambar_files['foto_5']) ? $gambar_files['foto_5'] : 'NULL';
	
		// Insert data tanpa memeriksa keberadaan file gambar
		$req = [
			'method' => 'update',
			'table' => 't_wisata',
			'value' => [
				'nama_wisata' 	 => $this->input->post('nama_wisata'),
				'foto_1' 		 => $foto_1,
				'foto_2' 		 => $foto_2,
				'foto_3' 		 => $foto_3,
				'foto_4' 		 => $foto_4,
				'foto_5' 		 => $foto_5,
				'ket_wisata' 	 => $this->input->post('ket_wisata'),
				'no_tlp' 		 => $this->input->post('no_tlp')
			],
			'where' => ['kd_wisata' => $this->input->post('id')]
		];
	
		$this->Modular->queryBuild($req);
	}
}	