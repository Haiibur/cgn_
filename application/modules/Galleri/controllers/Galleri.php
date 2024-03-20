<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galleri extends CI_Controller
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
		$data['title'] = "Galleri :: CSS XII Kota Cilegon";
		$data['judul'] = 'Galleri';
		$data['linkpage'] = '';
		$this->template->load('home', 'Galleri', $data);
	}

	function load_Galleri()
	{
		$res = $this->Modular->Seleksi_foto_galleri()->result();
		$output = array();
		foreach ($res as $key => $value) {
			$iddata = $value->kd_galleri . '=t_galleri=kd_galleri=Galleri=0.jpg';	
			
			$foto='<img src="'.base_url('assets/img/galleri/'.$value->foto_ke).'" width="80">';
			if($value->katagori =='1'){
				$katagori='<span class="badge badge-primary">FOTO</span>';
				$video="";
			}else{
				if($value->link_vidio !=""){
					$video='<a href="https://www.youtube.com/watch?v='.$value->link_vidio.'" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-play"></i> Lihat</a>';
				}else{
					$video='ID Video Tidak Ada';
				}
				$katagori='<span class="badge badge-danger">VIDEO</span>';
			}
			$data = [
				'id' => $value->kd_galleri,
				'ids' => $iddata,
				'kategori'	 	=> $katagori,
				'nama_galleri'	 => $value->nama_galleri,
				'foto' 		 	 => $foto,
				'tgl_post'		 => date("d M Y H:i:s", strtotime($value->tglpost)),
				'link_vidio'	 => $video,
				'ket_galleri'	 => $value->ket_galleri
			];

			array_push($output, $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_galleri()
	{
		$data['title'] 			= "Galleri :: CSS XII Kota Cilegon";
		$data['judul'] 			= 'Form Galleri';
		$data['url'] 			= base_url('Galleri/Insert_galleri');
		$data['id'] 			= rand(0, 99) . date('mdh');

		$data['kategori']    = '';
		$data['nama_galleri']    = '';
		$data['foto_1'] 		 = '';
		$data['foto_2'] 		 = '';
		$data['foto_3'] 		 = '';
		$data['foto_4'] 		 = '';
		$data['foto_5'] 	 	 = '';
		$data['link_vidio']		 = '';
		$data['ket_galleri']	 = '';
		
		$this->template->load('home', 'form_galleri', $data);
	}

	function Insert_galleri()
	{
		// Konfigurasi untuk upload gambar lokasi
		// $config['upload_path']   = './assets/upload_galleri';
		// $config['allowed_types'] = 'mp4|mp3|jpg|jpeg|png|gif';
		// $config['max_size']      = 6048;

		$config['upload_path']   = 'assets/img/galleri';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		$this->load->library('upload', $config);
	
		$gambar_files = array(); // Simpan nama file gambar
		//date_default_timezone_set('Asia/Jakarta');

		// Loop untuk mengupload gambar 1-5
		for ($i = 1; $i <= 5; $i++) {
			$field_name = 'foto_' . $i;
	
			// Lakukan upload
			if ($this->upload->do_upload($field_name)) {
				$data_gambar = $this->upload->data();
				$gambar_files[$field_name] = $data_gambar['file_name'];
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/img/galleri/' . $gambar_files[$field_name];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width'] = 700;
				//$config['height'] = 580;
				$config['quality'] = '100%';
				$config['new_image'] = 'assets/img/galleri/' . $gambar_files[$field_name];
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
		$foto_1 = isset($gambar_files['foto_1']) ? $gambar_files['foto_1'] : 'NULL';
		$foto_2 = isset($gambar_files['foto_2']) ? $gambar_files['foto_2'] : 'NULL';
		$foto_3 = isset($gambar_files['foto_3']) ? $gambar_files['foto_3'] : 'NULL';
		$foto_4 = isset($gambar_files['foto_4']) ? $gambar_files['foto_4'] : 'NULL';
		$foto_5 = isset($gambar_files['foto_5']) ? $gambar_files['foto_5'] : 'NULL';
	
		// Insert data tanpa memeriksa keberadaan file gambar
		//echo "tes ".$this->input->post('katagori');
		$req = [
			'method' => 'insert',
			'table' => 't_galleri',
			'value' => [
				'katagori' 	 	 => $this->input->post('katagori'),
				'nama_galleri' 	 => $this->input->post('nama_galleri'),
				'foto_1' 		 => $foto_1,
				'foto_2' 		 => $foto_2,
				'foto_3' 		 => $foto_3,
				'foto_4'		 => $foto_4,
				'foto_5'		 => $foto_5,
				'link_vidio' 	 => $this->input->post('link_vidio'),
				'tglpost' 	 	 => date("Y-m-d H:i:s"),
				'ket_galleri' 	 => $this->input->post('ket_galleri')
			]
		];
	
		$this->Modular->queryBuild($req);
	}

	function edit_galleri($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_galleri',
			'where' => [
				'kd_galleri' => $id
			]
		];

		$row = $this->Modular->queryBuild($req)->row();
		$data['title'] 			= "Update Galleri :: CSS XII Kota Cilegon";
		$data['judul'] 			= 'Update Galleri ';
		$data['url'] 			= base_url('Galleri/update_galleri');
		$data['id'] 			= $id;

		$data['kategori'] 		= $row->katagori;
		$data['nama_galleri'] 	= $row->nama_galleri;
		$data['foto_1'] 		= $row->foto_1;
		$data['foto_2'] 		= $row->foto_2;
		$data['foto_3'] 		= $row->foto_3;
		$data['foto_4'] 		= $row->foto_4;
		$data['foto_5'] 		= $row->foto_5;
		$data['link_vidio']		= $row->link_vidio;
		$data['ket_galleri'] 	= $row->ket_galleri;
		
		$this->template->load('home', 'form_galleri', $data);
		
	}

	function update_galleri()
	{
		// Konfigurasi untuk upload gambar lokasi
		$config['upload_path']   = 'assets/img/galleri';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		$this->load->library('upload', $config);
	
		$gambar_files = array(); // Simpan nama file gambar
		date_default_timezone_set('Asia/Jakarta');

		// Loop untuk mengupload gambar 1-5
		for ($i = 1; $i <= 5; $i++) {
			$field_name = 'foto_' . $i;
			$field_name1 = 'gambarlama_' . $i;
	
			if (!empty($_FILES[$field_name]['name'])) {
				if ($this->upload->do_upload($field_name)) {
					$data_gambar = $this->upload->data();
					$gambar_files[$field_name] = $data_gambar['file_name'];
					$this->load->library('image_lib');
					$config['image_library'] = 'gd2';
					$config['source_image'] = 'assets/img/galleri/' . $gambar_files[$field_name];
					$config['create_thumb'] = false;
					$config['maintain_ratio'] = false;
					$config['width'] = 700;
					//$config['height'] = 580;
					$config['quality'] = '100%';
					$config['new_image'] = 'assets/img/galleri/' . $gambar_files[$field_name];
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
		$foto_1 = isset($gambar_files['foto_1']) ? $gambar_files['foto_1'] : 'NULL';
		$foto_2 = isset($gambar_files['foto_2']) ? $gambar_files['foto_2'] : 'NULL';
		$foto_3 = isset($gambar_files['foto_3']) ? $gambar_files['foto_3'] : 'NULL';
		$foto_4 = isset($gambar_files['foto_4']) ? $gambar_files['foto_4'] : 'NULL';
		$foto_5 = isset($gambar_files['foto_5']) ? $gambar_files['foto_5'] : 'NULL';
	
		// Insert data tanpa memeriksa keberadaan file gambar
		$req = [
			'method' => 'update',
			'table' => 't_galleri',
			'value' => [
				'katagori' 	 => $this->input->post('kategori'),
				'nama_galleri' 	 => $this->input->post('nama_galleri'),
				'foto_1' 		 => $foto_1,
				'foto_2' 		 => $foto_2,
				'foto_3' 		 => $foto_3,
				'foto_4'		 => $foto_4,
				'foto_5'		 => $foto_5,
				'link_vidio' 	 => $this->input->post('link_vidio'),
				'tglpost' 	 	 => date("Y-m-d H:i:s"),
				'ket_galleri' 	 => $this->input->post('ket_galleri')
			],
			'where' => ['kd_galleri' => $this->input->post('id')]
		];
	
		$this->Modular->queryBuild($req);
	}
}