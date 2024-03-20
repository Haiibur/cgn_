<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
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
		$data['title'] = "Informasi :: CSS XII Kota Cilegon";
		$data['judul'] = 'Informasi';
		$data['linkpage'] = '';
		$this->template->load('home', 'Informasi', $data);
	}

	function load_informasi()
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_informasi',
			'order' => 'kd_informasi DESC'
		];

		$res = $this->Modular->queryBuild($req)->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_informasi . '=t_informasi=kd_informasi=Informasi=0.jpg';
			$jmlar=20; //banyak kata yang akan dipotong/diambil
            $ketart=implode(" ", array_slice(explode(" ", $value->ket_informasi), 0, $jmlar));
			
			$gambar='<img src="'.base_url().'./assets/img/informasi/'.$value->gambar_informasi.'" width="80" height="80">';
			$data = [
				'id' 					 => $value->kd_informasi,
				'ids' 					 => $iddata,				
				'tgl_post'		 		 => date("d M Y H:i:s", strtotime($value->tgl_post)),
				'judul_informasi'		 => $value->judul_informasi,
				'foto' 		 			 => $gambar,
				'yt' 			 		 => $value->link_youtube,
				'status_informasi'		 => $value->status_informasi,
				'ket_informasi'			 => $ketart.'..........',
			];
			array_push($output, $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_informasi()
	{
		$data['title'] 				= "Informasi :: CSS XII Kota Cilegon";
		$data['judul'] 				= 'Form Informasi';
		$data['url'] 				= base_url('Informasi/Insert_informasi');
		$data['id'] 				= rand(0, 99) . date('mdh');

		$data['judul_informasi'] 	= '';
		$data['gambar_informasi']   = '';
		$data['link_youtube']   	= '';
		$data['status_informasi'] 	= '';
		$data['ket_informasi'] 		= '';
		
		$this->template->load('home', 'form_informasi', $data);
	}


	
	function Insert_informasi()
	{
		// Konfigurasi untuk upload gambar lokasi
		// $config['upload_path']   = './assets/upload_informasi';
		// $config['allowed_types'] = 'mp4|mp3|jpg|jpeg|png|gif';
		// $config['max_size']      = 200000;
		// $this->load->library('upload', $config);

		// date_default_timezone_set('Asia/Jakarta');
		$config['upload_path']   = 'assets/img/informasi';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		if (!empty($_FILES['gambar_informasi']['name'])) {
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("gambar_informasi")) { //upload file
				$data = array('upload_data' => $this->upload->data());
				$gambar = $data['upload_data']['file_name'];
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/img/informasi/' . $gambar;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width'] = 800;
				//$config['height'] = 650;
				$config['quality'] = '100%';
				$config['new_image'] = 'assets/img/informasi/' . $gambar;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
		} else {
			$gambar = "";
		}






		// Upload Informasi 2
		if (!empty($_FILES['gambar_informasi']['name'])) {
			

			$req = [
				'method' => 'insert',
				'table' => 't_informasi',
				'value' => [
					'tgl_post'				 => date("Y-m-d H:i:s"),
					'judul_informasi'		 => $this->input->post('judul_informasi'),
					'gambar_informasi'		 => $gambar,
					'link_youtube'			 => $this->input->post('link_youtube'),
					'status_informasi'		 => $this->input->post('status_informasi'),
					'ket_informasi'			 => $this->input->post('ket_informasi'),
				]
			];
			
			$this->Modular->queryBuild($req);

		} else {
			$error = $this->upload->display_errors();
		}
	}

	function edit_informasi($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_informasi',
			'where' => [
				'kd_informasi' => $id
			]
		];

		$row = $this->Modular->queryBuild($req)->row();
		$data['title']				= "Update Informasi :: CSS XII Kota Cilegon";
		$data['judul'] 				= 'Update Informasi ';
		$data['url'] 				= base_url('Informasi/update_informasi');
		$data['id'] 				= $id;

		$data['judul_informasi'] 	= $row->judul_informasi;
		$data['gambar_informasi'] 	= $row->gambar_informasi;
		$data['link_youtube'] 		= $row->link_youtube;
		$data['status_informasi'] 	= $row->status_informasi;
		$data['ket_informasi'] 		= $row->ket_informasi;
		$this->template->load('home', 'form_informasi', $data);
		
	}

	function update_informasi()
	{
		// Konfigurasi untuk upload gambar lokasi
		// $config['upload_path']   = './assets/upload_informasi';
		// $config['allowed_types'] = 'mp4|mp3|jpg|jpeg|png|gif';
		// $config['max_size']      = 200000;
		// $this->load->library('upload', $config);
		$config['upload_path']   = 'assets/img/informasi';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		if (!empty($_FILES['gambar_informasi']['name'])) {
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("gambar_informasi")) { //upload file
				$data = array('upload_data' => $this->upload->data());
				$gambar = $data['upload_data']['file_name'];
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/img/informasi/' . $gambar;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width'] = 800;
				//$config['height'] = 650;
				$config['quality'] = '100%';
				$config['new_image'] = 'assets/img/informasi/' . $gambar;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
		} else {
			$gambar = $this->input->post('gambarlama');
		}

		$req = [
				'method' => 'update',
				'table' => 't_informasi',
				'value' => [
					'tgl_post'				 => date("Y-m-d H:i:s"),
					'judul_informasi'		 => $this->input->post('judul_informasi'),
					'gambar_informasi'		 => $gambar,
					'link_youtube'			 => $this->input->post('link_youtube'),
					'status_informasi'		 => $this->input->post('status_informasi'),
					'ket_informasi'			 => $this->input->post('ket_informasi'),
				],
				'where' => ['kd_informasi' => $this->input->post('id')]
			];
			
		$this->Modular->queryBuild($req);
	}

	public function update_status($id, $status_informasi) {
        $req = [
            'method' => 'update',
            'table' => 't_informasi',
            'value' => [
                'status_informasi' => $status_informasi,
            ],
            'where' => ['kd_informasi' => $id]
        ];

        // Panggil fungsi untuk menjalankan query pembaruan status
        $this->Modular->queryBuild($req);

		redirect('Informasi');
    }
}