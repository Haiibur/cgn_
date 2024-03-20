<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
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
		$data['title'] = "Produk :: CSS XII Kota Cilegon";
		$data['judul'] = 'Produk';
		$data['linkpage'] = '';
		$this->template->load('home', 'Produk', $data);
	}

	function load_produk()
	{
		$res = $this->Modular->Produk()->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_produk . '=t_produk=kd_produk=Produk=0.jpg';

			$detail = 
			'<div class="btn-group dropup" style="display: flex;">
				<a class="btn btn-sm btn-primary" style="color: white;">' . ($value->status_produk == 1 ? '<small>Aktif</small>' : '<small>Non-Aktif</small>') . '</a>
				<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
				<div class="dropdown-menu">' .
					($value->status_produk == 1 
						? '<a href="' . base_url() . 'Produk/update_status/' . $value->kd_produk . '/2" class="dropdown-item" style="text-align: center;">
								Non-Aktif
						   </a>' 
						: '<a href="' . base_url() . 'Produk/update_status/' . $value->kd_produk . '/1" class="dropdown-item" style="text-align: center;">
								Aktif
						   </a>') .
				'</div>
			</div>';
			$foto='<img src="'.base_url().'assets/img/produk/'.$value->gambar_1.'" width="80">';

			$data = [
				'id' => $value->kd_produk,
				'ids' => $iddata,
				'gambar_1'		 	 => $foto,
				'katagori_produk'	 => $value->nama_kat,
				'nama_produk'		 => $value->nama_produk,
				'harga'		 		 => $value->harga,
				'qty'		 		 => $value->qty,
				'satuan_produk'		 => $value->satuan_produk,
				'ket_produk'		 => $value->ket_produk,
				'status_produk'		 => $detail,
			];
			array_push($output, $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_produk()
	{
		$data['title'] 				= "Produk :: CSS XII Kota Cilegon";
		$data['judul'] 				= 'Form Produk';
		$data['url'] 				= base_url('Produk/Insert_produk');
		$data['id'] 				= rand(0, 99) . date('mdh');
		$data['katagori_produk']    = $this->Modular->produk_kat()->result();
		$data['nama_produk'] 		= '';
		$data['harga'] 				= '';
		$data['qty'] 				= '';
		$data['satuan_produk'] 		= '';
		$data['gambar_1'] 			= '';
		$data['gambar_2'] 			= '';
		$data['gambar_3'] 			= '';
		$data['gambar_4'] 			= '';
		$data['gambar_5'] 			= '';
		$data['status_produk'] 		= '';
		$data['ket_produk'] 		= '';
		
		$this->template->load('home', 'form_produk', $data);
	}

	function Insert_produk()
	{
		$config['upload_path']   = 'assets/img/produk';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		


		// // Konfigurasi untuk upload gambar lokasi
		// $config['upload_path']   = './assets/upload_produk';
		// $config['allowed_types'] = 'mp4|mp3|jpg|jpeg|png|gif';
		// $config['max_size']      = 6048;
		$this->load->library('upload', $config);
	
		$upload_errors = array();
		$gambar_files = array(); // Simpan nama file gambar
	
		// Loop untuk mengupload gambar 1-5
		for ($i = 1; $i <= 5; $i++) {
			$field_name = 'gambar_' . $i;
	
			// Lakukan upload
			if ($this->upload->do_upload($field_name)) {
				$data_gambar = $this->upload->data();
				$gambar_files[$field_name] = $data_gambar['file_name'];
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/img/produk/' . $gambar_files[$field_name];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width'] = 600;
				$config['height'] = 580;
				$config['quality'] = '100%';
				$config['new_image'] = 'assets/img/produk/' . $gambar_files[$field_name];
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			} else {
				// Jika terjadi error, simpan pesan error
				$error = $this->upload->display_errors();
				if ($error != "You did not select a file to upload.") {
					$upload_errors[] = $error;
				}
			}
		}
	
		// Mengatur nilai default untuk variabel gambar
		$gambar_1 = isset($gambar_files['gambar_1']) ? $gambar_files['gambar_1'] : 'NULL';
		$gambar_2 = isset($gambar_files['gambar_2']) ? $gambar_files['gambar_2'] : 'NULL';
		$gambar_3 = isset($gambar_files['gambar_3']) ? $gambar_files['gambar_3'] : 'NULL';
		$gambar_4 = isset($gambar_files['gambar_4']) ? $gambar_files['gambar_4'] : 'NULL';
		$gambar_5 = isset($gambar_files['gambar_5']) ? $gambar_files['gambar_5'] : 'NULL';
	
		date_default_timezone_set('Asia/Jakarta');

		$req = [
			'method' => 'insert',
			'table' => 't_produk',
			'value' => [
				'katagori_produk'	 => $this->input->post('katagori_produk'),
				'nama_produk'		 => $this->input->post('nama_produk'),
				'harga'		 		 => $this->input->post('harga'),
				'qty'		 		 => $this->input->post('qty'),
				'satuan_produk'		 => $this->input->post('satuan_produk'),
				'gambar_1'		 	 => $gambar_1,
				'gambar_2'		 	 => $gambar_2,
				'gambar_3'		 	 => $gambar_3,
				'gambar_4'		 	 => $gambar_4,
				'gambar_5'		 	 => $gambar_5,
				//'status_produk'		 => $this->input->post('status_produk'),
				'tgl_buat'			 => date("Y-m-d H:i:s"),
				'ket_produk'		 => $this->input->post('ket_produk'),
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

	function edit_produk($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_produk',
			'where' => [
				'kd_produk' => $id
			]
		];

		$row = $this->Modular->queryBuild($req)->row();
		$data['title'] = "Update Produk :: CSS XII Kota Cilegon";
		$data['judul'] = 'Update Produk ';
		$data['url'] = base_url('Produk/update_produk');
		$data['id'] = $id;
		$data['katagori_produk']    = $this->Modular->produk_kat()->result();
		$data['nama_produk'] 		= $row->nama_produk;
		$data['harga'] 				= $row->harga;
		$data['katproduk'] 			= $row->katagori_produk;
		$data['qty'] 				= $row->qty;
		$data['satuan_produk'] 		= $row->satuan_produk;
		$data['gambar_1'] 			= $row->gambar_1;
		$data['gambar_2'] 			= $row->gambar_2;
		$data['gambar_3'] 			= $row->gambar_3;
		$data['gambar_4'] 			= $row->gambar_4;
		$data['gambar_5'] 			= $row->gambar_5;
		$data['status_produk'] 		= $row->status_produk;
		$data['ket_produk'] 		= $row->ket_produk;
		$this->template->load('home', 'form_produk', $data);
	}

	function update_produk()
	{
		// Konfigurasi untuk upload gambar lokasi
		$config['upload_path']   = 'assets/img/produk';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		$this->load->library('upload', $config);
	
		$upload_errors = array();
		$gambar_files = array(); // Simpan nama file gambar
	
		// Loop untuk mengupload gambar 1-5
		for ($i = 1; $i <= 5; $i++) {
			$field_name = 'gambar_' . $i;
			$field_name1 = 'gambarlama_' . $i;
	
			// Lakukan upload
			if (!empty($_FILES[$field_name]['name'])) {
				if ($this->upload->do_upload($field_name)) {
					$data_gambar = $this->upload->data();
					$gambar_files[$field_name] = $data_gambar['file_name'];
					$this->load->library('image_lib');
					$config['image_library'] = 'gd2';
					$config['source_image'] = 'assets/img/produk/' . $gambar_files[$field_name];
					$config['create_thumb'] = false;
					$config['maintain_ratio'] = false;
					$config['width'] = 600;
					$config['height'] = 580;
					$config['quality'] = '100%';
					$config['new_image'] = 'assets/img/produk/' . $gambar_files[$field_name];
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
				} else {
					// Jika terjadi error, simpan pesan error
					$error = $this->upload->display_errors();
					if ($error != "You did not select a file to upload.") {
						$upload_errors[] = $error;
					}
				}
			}else{
				$gambar_files[$field_name]=$this->input->post($field_name1);
			}
		}
	
		// Mengatur nilai default untuk variabel gambar
		$gambar_1 = isset($gambar_files['gambar_1']) ? $gambar_files['gambar_1'] : 'NULL';
		$gambar_2 = isset($gambar_files['gambar_2']) ? $gambar_files['gambar_2'] : 'NULL';
		$gambar_3 = isset($gambar_files['gambar_3']) ? $gambar_files['gambar_3'] : 'NULL';
		$gambar_4 = isset($gambar_files['gambar_4']) ? $gambar_files['gambar_4'] : 'NULL';
		$gambar_5 = isset($gambar_files['gambar_5']) ? $gambar_files['gambar_5'] : 'NULL';
	
		//date_default_timezone_set('Asia/Jakarta');

		$req = [
			'method' => 'update',
			'table' => 't_produk',
			'value' => [
				'katagori_produk'	 => $this->input->post('katagori_produk'),
				'nama_produk'		 => $this->input->post('nama_produk'),
				'harga'		 		 => $this->input->post('harga'),
				'qty'		 		 => $this->input->post('qty'),
				'satuan_produk'		 => $this->input->post('satuan_produk'),
				'gambar_1'		 	 => $gambar_1,
				'gambar_2'		 	 => $gambar_2,
				'gambar_3'		 	 => $gambar_3,
				'gambar_4'		 	 => $gambar_4,
				'gambar_5'		 	 => $gambar_5,
				//'status_produk'		 => $this->input->post('status_produk'),
				'tgl_buat'			 => date("Y-m-d H:i:s"),
				'ket_produk'		 => $this->input->post('ket_produk'),
			],
			'where' => ['kd_produk' => $this->input->post('id')]
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

	public function update_status($id, $status) {
        $req = [
            'method' => 'update',
            'table' => 't_produk',
            'value' => [
                'status_produk' => $status,
            ],
            'where' => ['kd_produk' => $id]
        ];

        // Panggil fungsi untuk menjalankan query pembaruan status
        $this->Modular->queryBuild($req);

		redirect('Produk');
    }

	function Get_harga()
    {
        $kd_produk = $this->input->post('kd_produk', TRUE);
        $data = $this->Modular->Produk_get($kd_produk)->result();
        echo json_encode($data);
    }
}