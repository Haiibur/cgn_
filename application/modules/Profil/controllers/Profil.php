<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->_isLogged();
	}

	function _isLogged() {
		if($this->session->userdata('status_sesi') != TRUE) {
			redirect('login', 'refresh');
		}
	}

	







	public function index() {
        $data['title'] = "Profil Sistem :: CSS XII Kota Cilegon";
        $data['judul'] = 'Profil Sistem';
        $data['linkpage'] ='';

        $req = [
            'method' => 'get',
            'select' => '*',
            'table' => 't_profil',
			'where' =>'kd_profil=1'
        ];
        $res = $this->Modular->queryBuild($req)->row();

        $data['id']	 					= 1;
        $data['nama_profil']	 		= $res->nama_profil_sistem;
		$data['logo']				 	= $res->logo;
		$data['versi'] 				 	= $res->versi;
        $data['ket_profil'] 		 	= $res->ket_profil;
        $data['ket_tentang_css'] 	 	= $res->ket_tentang_css;
		$data['tgl_pelaksanaan'] 	 	= $res->tgl_pelaksanaan;
		$data['foto_walikota']		 	= $res->foto_walikota;
        $data['no_tlp'] 			 	= $res->no_tlp;
		$data['email'] 					= $res->email;
        $data['alamat'] 			 	= $res->alamat;
        $data['kode_undangan']		  	= $res->kode_undangan;
		$data['kordinat_lokasi_utama']	= $res->kordinat_lokasi_utama;
		
		$this->template->load('home', 'profil_index' ,$data);	
	}

	function update_prf() {
		// Konfigurasi untuk upload gambar lokasi
		$config['upload_path']   = './assets/profil_sistem';
		$config['allowed_types'] = 'mp4|mp3|jpg|jpeg|png|gif';
		$config['max_size']      = 200000;
		$this->load->library('upload', $config);
	
		$gambar_files = array(); // Simpan nama file gambar
	
		// Loop untuk mengupload gambar 1-2
		for ($i = 1; $i <= 2; $i++) {
			$field_name = 'foto_' . $i;
	
			// Lakukan upload jika ada file yang diunggah
			if (!empty($_FILES[$field_name]['name']) && $this->upload->do_upload($field_name)) {
				$data_gambar = $this->upload->data();
				$gambar_files[$field_name] = $data_gambar['file_name'];
			} elseif (!empty($this->input->post($field_name . '_existing'))) {
				// Jika tidak ada file yang diunggah, tetapi ada file yang ada sebelumnya, gunakan file yang ada sebelumnya
				$gambar_files[$field_name] = $this->input->post($field_name . '_existing');
			}
		}
	
		// Mengatur nilai default untuk variabel gambar
		$foto_1 = isset($gambar_files['foto_1']) ? $gambar_files['foto_1'] : '';
		$foto_2 = isset($gambar_files['foto_2']) ? $gambar_files['foto_2'] : '';
	
		// Insert data tanpa memeriksa keberadaan file gambar
		$req = [
			'method' => 'update',
			'table'  => 't_profil',
			'value'  => [
				'nama_profil_sistem'    => $this->input->post('nama_profil'),
				'logo'                  => $foto_1,
				'ket_profil'            => $this->input->post('ket_profil'),
				'ket_tentang_css'       => $this->input->post('ket_tentang_css'),
				'foto_walikota'         => $foto_2,
				'no_tlp'                => $this->input->post('no_tlp'),
				'email'                 => $this->input->post('email'),
				'tgl_pelaksanaan'       => $this->input->post('tgl_pelaksanaan'),
				'alamat'                => $this->input->post('alamat'),
				'kode_undangan'         => $this->input->post('kode_undangan'),
				'kordinat_lokasi_utama' => $this->input->post('kordinat_lokasi_utama')
			],
			'where' => ['kd_profil' => 1]
		];
	
		$this->Modular->queryBuild($req);
	}
	
}