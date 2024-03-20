<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotel extends CI_Controller
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
		$data['title'] 		= "Hotel :: CSS XII Kota Cilegon";
		$data['judul'] 		= 'Hotel';
		$data['linkpage'] 	= '';
		$this->template->load('home', 'Hotel', $data);
	}

	function load_hotel()
	{
		$res = $this->Modular->Seleksi_foto_hotel()->result();

		$output = array();
		foreach ($res as $key => $value) {
				$iddata = $value->kd_hotel . '=t_hotel=kd_hotel=Hotel=0.jpg';
				$foto='<img src="'.base_url('assets/img/hotel/'.$value->foto_1).'" width="80">';
				$data = [
					'id' 			=> $value->kd_hotel,
					'ids' 			=> $iddata,
					'nama_hotel' 	=> $value->nama_hotel,
					'foto' 			=> $foto,
					'titik_lokasi' 	=> $value->lat . ',' . $value->longg,
					'harga' 		=> $value->harga,
					'no_tlp' 		=> $value->no_tlp,
					'link_website' 	=> $value->link_website,
					'ket_hotel' 	=> $value->ket_hotel,
				];

				array_push($output, $data);
			}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
		// Add the closing bracket for the foreach loop
	}

	

	function form_tambah_hotel()
	{
		$data['title'] 			= "Hotel :: CSS XII Kota Cilegon";
		$data['judul'] 			= 'Form Hotel';
		$data['url'] 			= base_url('Hotel/Insert_Hotel');
		$data['id'] 			= rand(0, 99) . date('mdh');

		$data['nama_hotel']   		= '';
		$data['foto_1'] 			= '';
		$data['foto_2'] 			= '';
		$data['foto_3'] 			= '';
		$data['foto_4'] 			= '';
		$data['foto_5'] 			= '';
		$data['lat']				= '';
		$data['longg']				= '';
		$data['ket_hotel']			= '';
		$data['harga']				= '';
		$data['no_tlp']				= '';
		$data['link_website']		= '';
		
		$this->template->load('home', 'form_hotel', $data);
	}

	function Insert_Hotel()
	{
		// Konfigurasi untuk upload gambar lokasi
		// $config['upload_path']   = './assets/upload_hotel';
		// $config['allowed_types'] = 'mp4|mp3|jpg|jpeg|png|gif';
		// $config['max_size']      = 6048;
		// $this->load->library('upload', $config);
	
		// $upload_errors = array();
		// $gambar_files = array(); // Simpan nama file gambar
	
		// // Loop untuk mengupload gambar 1-5
		// for ($i = 1; $i <= 5; $i++) {
		// 	$field_name = 'foto_' . $i;
	
		// 	// Lakukan upload
		// 	if ($this->upload->do_upload($field_name)) {
		// 		$data_gambar = $this->upload->data();
		// 		$gambar_files[$field_name] = $data_gambar['file_name'];
		// 	} else {
		// 		// Jika terjadi error, simpan pesan error
		// 		$error = $this->upload->display_errors();
		// 		if ($error != "You did not select a file to upload.") {
		// 			$upload_errors[] = $error;
		// 		}
		// 	}
		// }
	
		// // Mengatur nilai default untuk variabel gambar
		// $foto_1 = isset($gambar_files['foto_1']) ? $gambar_files['foto_1'] : 'NULL';
		// $foto_2 = isset($gambar_files['foto_2']) ? $gambar_files['foto_2'] : 'NULL';
		// $foto_3 = isset($gambar_files['foto_3']) ? $gambar_files['foto_3'] : 'NULL';
		// $foto_4 = isset($gambar_files['foto_4']) ? $gambar_files['foto_4'] : 'NULL';
		// $foto_5 = isset($gambar_files['foto_5']) ? $gambar_files['foto_5'] : 'NULL';
		$config['upload_path']   = 'assets/img/hotel';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		if (!empty($_FILES['foto_1']['name'])) {
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("foto_1")) { //upload file
				$data = array('upload_data' => $this->upload->data());
				$gambar = $data['upload_data']['file_name'];
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/img/hotel/' . $gambar;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width'] = 600;
				$config['height'] = 650;
				$config['quality'] = '100%';
				$config['new_image'] = 'assets/img/hotel/' . $gambar;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
		} else {
			$gambar = "";
		}
		// Insert data tanpa memeriksa keberadaan file gambar
		$req = [
			'method' => 'insert',
			'table'  => 't_hotel',
			'value'  => [
				'nama_hotel'    => $this->input->post('nama_hotel'),
				'foto_1'        => $gambar,
				// 'foto_2'        => $foto_2,
				// 'foto_3'        => $foto_3,
				// 'foto_4'        => $foto_4,
				// 'foto_5'        => $foto_5,
				'lat'           => $this->input->post('lat'),
				'longg'         => $this->input->post('longg'),
				'ket_hotel'     => $this->input->post('ket_hotel'),
				//'harga'         => $this->input->post('harga'),
				//'no_tlp'        => $this->input->post('no_tlp'),
				'link_website'  => $this->input->post('link_website')
			]
		];
	
		$this->Modular->queryBuild($req);
	
		// Tangani error jika ada
		if (!empty($upload_errors)) {
			// Handle error pada upload (misalnya, log error, tampilkan pesan kepada pengguna, dll.)
			foreach ($upload_errors as $error) {
				// Handle error (misalnya, log error, tampilkan pesan kepada pengguna, dll.)
			}
		}
	}
	

	function edit_hotel($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_hotel',
			'where' => [
				'kd_Hotel' => $id
			]
		];

		$row = $this->Modular->queryBuild($req)->row();
		$data['title'] 			= "Update Hotel :: CSS XII Kota Cilegon";
		$data['judul'] 			= 'Update Hotel ';
		$data['url'] 			= base_url('Hotel/update_hotel');
		$data['id'] 			= $id;
		
		$data['nama_hotel'] 	= $row->nama_hotel;
		$data['foto_1']			= $row->foto_1;
		$data['foto_2'] 	 	= $row->foto_2;
		$data['foto_3'] 	 	= $row->foto_3;
		$data['foto_4'] 		= $row->foto_4;
		$data['foto_5'] 		= $row->foto_5;
		$data['lat']			= $row->lat;
		$data['longg']			= $row->longg;
		$data['ket_hotel']		= $row->ket_hotel;
		$data['harga']			= $row->harga;
		$data['no_tlp']			= $row->no_tlp;
		$data['link_website']	= $row->link_website;

		$this->template->load('home', 'form_hotel', $data);
		
	}

	function update_hotel()
	{
		// Konfigurasi untuk upload gambar lokasi
		// $config['upload_path']   = './assets/upload_hotel';
		// $config['allowed_types'] = 'mp4|mp3|jpg|jpeg|png|gif';
		// $config['max_size']      = 6048;
		// $this->load->library('upload', $config);
	
		// $gambar_files = array(); // Simpan nama file gambar
	
		// // Loop untuk mengupload gambar 1-5
		// for ($i = 1; $i <= 5; $i++) {
		// 	$field_name = 'foto_' . $i;
	
		// 	// Lakukan upload
		// 	if ($this->upload->do_upload($field_name)) {
		// 		$data_gambar = $this->upload->data();
		// 		$gambar_files[$field_name] = $data_gambar['file_name'];
		// 	} else {
		// 		// Jika terjadi error, simpan pesan error
		// 		$error = $this->upload->display_errors();
		// 		if ($error != "You did not select a file to upload.") {
		// 			$upload_errors[] = $error;
		// 		}
		// 	}
		// }
	
		// // Mengatur nilai default untuk variabel gambar
		// $foto_1 = isset($gambar_files['foto_1']) ? $gambar_files['foto_1'] : 'NULL';
		// $foto_2 = isset($gambar_files['foto_2']) ? $gambar_files['foto_2'] : 'NULL';
		// $foto_3 = isset($gambar_files['foto_3']) ? $gambar_files['foto_3'] : 'NULL';
		// $foto_4 = isset($gambar_files['foto_4']) ? $gambar_files['foto_4'] : 'NULL';
		// $foto_5 = isset($gambar_files['foto_5']) ? $gambar_files['foto_5'] : 'NULL';
		$config['upload_path']   = 'assets/img/hotel';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		if (!empty($_FILES['foto_1']['name'])) {
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("foto_1")) { //upload file
				$data = array('upload_data' => $this->upload->data());
				$gambar = $data['upload_data']['file_name'];
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/img/hotel/' . $gambar;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width'] = 600;
				$config['height'] = 650;
				$config['quality'] = '100%';
				$config['new_image'] = 'assets/img/hotel/' . $gambar;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
		} else {
			$gambar = $this->input->post('fotolama');
		}
		// Insert data tanpa memeriksa keberadaan file gambar
		$req = [
			'method' => 'update',
			'table'  => 't_hotel',
			'value'  => [
				'nama_hotel'    => $this->input->post('nama_hotel'),
				'foto_1'        => $gambar,
				// 'foto_2'        => $foto_2,
				// 'foto_3'        => $foto_3,
				// 'foto_4'        => $foto_4,
				// 'foto_5'        => $foto_5,
				'lat'           => $this->input->post('lat'),
				'longg'         => $this->input->post('longg'),
				'ket_hotel'     => $this->input->post('ket_hotel'),
				//'harga'         => $this->input->post('harga'),
				//'no_tlp'        => $this->input->post('no_tlp'),
				'link_website'  => $this->input->post('link_website')
			],
			'where' => ['kd_hotel' => $this->input->post('id')]
		];
	
		$this->Modular->queryBuild($req);
	}
}