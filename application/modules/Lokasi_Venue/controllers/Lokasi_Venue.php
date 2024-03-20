<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi_Venue extends CI_Controller {
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
        $data['title'] = "Lokasi Venue :: CSS XII Kota Cilegon";
        $data['judul'] = 'Lokasi Venue';
        $data['linkpage'] ='';
		$this->template->load('home', 'Lokasi_Venue' ,$data);	
	}

	function load_lokasi_venue() {
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_lokasi_venue',
			'order' => 'kd_venue DESC'
		];
		
		$res = $this->Modular->queryBuild($req)->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_venue.'=t_lokasi_venue=kd_venue=Lokasi_Venue=0.jpg';

			$detail = 
			'<div class="btn-group dropup" style="display: flex;">
				<a class="btn btn-sm btn-primary" style="color: white;">' . ($value->status == 1 ? '<small>Aktif</small>' : '<small>Non-Aktif</small>') . '</a>
				<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
				<div class="dropdown-menu">' .
					($value->status == 1 
						? '<a href="' . base_url() . 'Lokasi__Venue/update_status/' . $value->kd_venue . '/2" class="dropdown-item" style="text-align: center;">
								Non-Aktif
						   </a>' 
						: '<a href="' . base_url() . 'Lokasi_Venue/update_status/' . $value->kd_venue . '/1" class="dropdown-item" style="text-align: center;">
								Aktif
						   </a>') .
				'</div>
			</div>';
			$foto='<img src="'.base_url('assets/img/lokasi/'.$value->foto_venue).'" width="80">';

			$data = [
				'id' 			=> $value->kd_venue,
				'ids' 			=> $iddata,
				'nama_venue' 	=> $value->nama_venue,
				'foto_venue' 	=> $foto,
				'titik_lokasi'	=> $value->lat.','.$value->longg,
				'ket_venue' 	=> $value->ket_venue,
				'status'		=> $detail
			];
			array_push($output, $data);
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_lokasi_venue() {
		$data=[
			'title'			=> "Form Lokasi Venue :: CSS XII Kota Cilegon",
			'judul'			=> "Form Lokasi Venue",
			'url'			=> base_url('Lokasi_Venue/Insert_lokasi_venue'),
			'id'			=> '',
			'nama_venue'	=> '',
			'foto_venue'	=> '',
			'lat' 			=> '',
			'longg' 		=> '',
			'ket_venue'		=> '',
			'status'		=> ''
		];
		
		$this->template->load('home', 'form_lokasi_venue' ,$data);	
	}

	function Insert_lokasi_venue() {
		// Konfigurasi untuk upload gambar lokasi
		$config['upload_path']   = './assets/img/lokasi';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		if (!empty($_FILES['foto_venue']['name'])) {
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("foto_venue")) { //upload file
				$data = array('upload_data' => $this->upload->data());
				$gambar = $data['upload_data']['file_name'];
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/img/lokasi/' . $gambar;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width'] = 800;
				$config['height'] = 700;
				$config['quality'] = '100%';
				$config['new_image'] = 'assets/img/lokasi/' . $gambar;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
		} else {
			$gambar = "";
		}
		
		// Upload gambar lokasi
		if (!empty($_FILES['foto_venue']['name'])) {
			//$data = $this->upload->data();
			//$foto_venue = $data['file_name'];
			
			$req = [
				'method' => 'insert',
				'table' => 't_lokasi_venue',
				'value' => [
					'nama_venue'	 => $this->input->post('nama_venue'),
					'foto_venue' 	 => $gambar,
					'lat' 	 		 => $this->input->post('lat'),
					'longg' 	 	 => $this->input->post('longg'),
					'ket_venue' 	 => $this->input->post('ket_venue'),
					//'status' 		 => $this->input->post('status'),
				],
			];

			$this->Modular->queryBuild($req);
		} else {
			$error = $this->upload->display_errors();
		}
	}	
	

	function edit_lokasi_venue($id) {
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_lokasi_venue',
			'where' => [
				'kd_venue' => $id
			]
		];
		
		$row = $this->Modular->queryBuild($req)->row();

		$data=[
			'title'			=> "Form Lokasi Venue :: CSS XII Kota Cilegon",
			'judul'			=> "Form Lokasi Venue",
			'url'			=> base_url('Lokasi_Venue/update_lokasi_venue'),
			'id'			=> $id,
			'nama_venue'	=> $row->nama_venue,
			'foto_venue'	=> $row->foto_venue,
			'lat' 	 		=> $row->lat,
			'longg' 	 	=> $row->longg,
			'ket_venue'		=> $row->ket_venue,
			'status'		=> $row->status
		];
		
		$this->template->load('home', 'form_lokasi_venue' ,$data);	
	}

	function update_lokasi_venue() {
		$config['upload_path']   = './assets/img/lokasi';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		if (!empty($_FILES['foto_venue']['name'])) {
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("foto_venue")) { //upload file
				$data = array('upload_data' => $this->upload->data());
				$gambar = $data['upload_data']['file_name'];
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/img/lokasi/' . $gambar;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width'] = 800;
				$config['height'] = 700;
				$config['quality'] = '100%';
				$config['new_image'] = 'assets/img/lokasi/' . $gambar;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
		} else {
			$gambar = $this->input->post('fotolama');
		}
		$req = [
				'method' => 'update',
				'table' => 't_lokasi_venue',
				'value' => [
					'nama_venue'	 => $this->input->post('nama_venue'),
					'foto_venue' 	 => $gambar,
					'lat' 	 		 => $this->input->post('lat'),
					'longg' 	 	 => $this->input->post('longg'),
					'ket_venue' 	 => $this->input->post('ket_venue'),
					//'status' 		 => $this->input->post('status'),
				],
				'where' => ['kd_venue' => $this->input->post('id')]
			];

		$this->Modular->queryBuild($req);
		// Konfigurasi untuk upload gambar lokasi
		// $config['upload_path']   = './assets/upload_Lokasi_Vanue';
		// $config['allowed_types'] = 'mp4|mp3|jpg|jpeg|png|gif';
		// $config['max_size']      = 200000;
		// $this->load->library('upload', $config);
				
		// Upload gambar lokasi
		// if ($this->upload->do_upload('foto_venue')) {
		// 	//$data = $this->upload->data();
		// 	//$foto_venue = $data['file_name'];
			
			
		// } else {
		// 	$error = $this->upload->display_errors();
		// }
	}

	public function update_status($id, $status) {
        $req = [
            'method' => 'update',
            'table' => 't_lokasi_venue',
            'value' => [
                'status' => $status,
            ],
            'where' => ['kd_venue' => $id]
        ];

        // Panggil fungsi untuk menjalankan query pembaruan status
        $this->Modular->queryBuild($req);

		redirect('Lokasi_Venue');
    }
}