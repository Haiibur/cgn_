<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi_Tujuan extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->_isLogged();
		$this->load->helper('form');
	}

	function _isLogged() {
		if($this->session->userdata('status_sesi') != TRUE) {
			redirect('login', 'refresh');
		}
	}

	public function index() {
        $data['title'] = "Lokasi Kunjungan :: CSS XII Kota Cilegon";
        $data['judul'] = 'Lokasi Kunjungan';
        $data['linkpage'] ='';
		$this->template->load('home', 'Lokasi_Tujuan' ,$data);	
	}

	function load_lokasi_tujuan() {
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_lokasi_tujuan',
			'order' => 'kd_lokasi DESC'
		];
		$res = $this->Modular->queryBuild($req)->result();
		$output = array();
		foreach ($res as $key => $value) {
			$iddata = $value->kd_lokasi.'=t_lokasi_tujuan=kd_lokasi=lokasi=0.jpg';
			$foto='<img src="'.base_url('assets/img/lokasikunjungan/'.$value->gambar_lokasi).'" width="80">';
			$video='<a href="https://www.youtube.com/watch?v='.$value->link_vidio.'" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-play"></i> Lihat</a>';
			$data = [
				'id' 	=> $value->kd_lokasi,
				'ids' => $iddata,
				'nama_lokasi' 	=> $value->nama_lokasi,
				'ket_lokasi' 	=> $value->ket_lokasi,
				'foto' => $foto,
				'video' 	=> $video,
			];
			array_push($output, $data);
		}
		// var_dump($data);
		// die();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_lokasi_tujuan() {
		$data=[
			'title'			=> "Form Lokasi Kunjungan :: CSS XII Kota Cilegon",
			'judul'			=> "Form Lokasi Kunjungan",
			'url'			=> base_url('Lokasi_Tujuan/Insert_Lokasi_Tujuan'),
			'id'			=> '',
			'nama_lokasi'	=> '',
			'ket_lokasi'	=> '',
			'gambar_lokasi' => '',
			'link_vidio'	=> ''
		];
		
		$this->template->load('home', 'form_lokasi_tujuan' ,$data);	
	}

	function Insert_Lokasi_Tujuan() {
		// Konfigurasi untuk upload gambar lokasi
		$config['upload_path']   = './assets/img/lokasikunjungan';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		if (!empty($_FILES['gambar_lokasi']['name'])) {
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("gambar_lokasi")) { //upload file
				$data = array('upload_data' => $this->upload->data());
				$gambar = $data['upload_data']['file_name'];
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/img/lokasikunjungan/' . $gambar;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width'] = 800;
				$config['height'] = 500;
				$config['quality'] = '100%';
				$config['new_image'] = 'assets/img/lokasikunjungan/' . $gambar;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
		} else {
			$gambar = "";
		}
		
		// Upload gambar lokasi
		if (!empty($_FILES['gambar_lokasi']['name'])) {		
		
			$req = [
				'method' => 'insert',
				'table' => 't_lokasi_tujuan',
				'value' => [
					'nama_lokasi' => $this->input->post('nama_lokasi'),
					'ket_lokasi' => $this->input->post('ket_lokasi'),
					'gambar_lokasi' => $gambar,
					'link_vidio' => $this->input->post('link_vidio'),
				]
			];

			$this->Modular->queryBuild($req);
		} else {
			$error = $this->upload->display_errors();
			// Handle kesalahan upload gambar
		}
	}	
	

	function edit_lokasi_tujuan($id) {
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_lokasi_tujuan',
			'where' => [
				'kd_lokasi' => $id
			]
		];
		
		$row = $this->Modular->queryBuild($req)->row();

		$data=[
			'title'			=> "Form Lokasi Tujuan :: CSS XII Kota Cilegon",
			'judul'			=> "Form Lokasi Tujuan",
			'url'			=> base_url('Lokasi_Tujuan/update_lokasi_tujuan'),
			'id'			=> $id,
			'nama_lokasi'	=> $row->nama_lokasi,
			'ket_lokasi'	=> $row->ket_lokasi,
			'gambar_lokasi' => $row->gambar_lokasi,
			'link_vidio'	=> $row->link_vidio
		];
		$this->template->load('home', 'form_lokasi_tujuan' ,$data);	
	}

	function update_lokasi_tujuan() {
		// Konfigurasi untuk upload gambar lokasi
		$config['upload_path']   = './assets/img/lokasikunjungan';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		if (!empty($_FILES['gambar_lokasi']['name'])) {
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("gambar_lokasi")) { //upload file
				$data = array('upload_data' => $this->upload->data());
				$gambar = $data['upload_data']['file_name'];
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/img/lokasikunjungan/' . $gambar;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width'] = 800;
				$config['height'] = 500;
				$config['quality'] = '100%';
				$config['new_image'] = 'assets/img/lokasikunjungan/' . $gambar;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
		} else {
			$gambar = $this->input->post('fotolama');
		}
		$req = [
				'method' => 'update',
				'table' => 't_lokasi_tujuan',
				'value' => [
					'nama_lokasi'	 => $this->input->post('nama_lokasi'),
					'ket_lokasi' 	 => $this->input->post('ket_lokasi'),
					'gambar_lokasi'  => $gambar,
					'link_vidio' => $this->input->post('link_vidio'),
				],
				'where' => ['kd_lokasi' => $this->input->post('id')]
			];
			$this->Modular->queryBuild($req);

		// // Upload gambar lokasi
		// if ($this->upload->do_upload('gambar_lokasi')) {
		// 	$data = $this->upload->data();
		// 	$gambar_lokasi = $data['file_name'];

			
		// } else {
		// 	$error = $this->upload->display_errors();
		// 	// Handle error jika upload gagal
		// 	// Misalnya: echo $error; exit();
		// }
	}
}