<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi extends CI_Controller
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
		$data['title'] = "Materi :: CSS XII Kota Cilegon";
		$data['judul'] = 'Materi';
		$data['linkpage'] = '';
		$this->template->load('home', 'Materi', $data);
	}

	function load_Materi()
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_materi',
			'order' => 'kd_materi DESC'
		];

		$res = $this->Modular->queryBuild($req)->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_materi . '=t_materi=kd_materi=Materi=0.jpg';

			$detail = 
			'<div style="display: flex; justify-content: space-evenly;">
				<a href="' . base_url() . 'assets/img/materi/' . $value->file_materi . '" class="btn btn-primary btn-sm" target="_blank">
					<i class="fa-solid fa-file"></i>
				</a>
			</div>';
					
			$data = [
				'id' => $value->kd_materi,
				'ids' => $iddata,
				'nama_materi'		 => $value->nama_materi,
				'file_materi'		 => $detail,
				'jumlah_download'	 => $value->jumlah_download
			];
			array_push($output, $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_Materi()
	{
		$data['title'] 			= "Materi :: CSS XII Kota Cilegon";
		$data['judul'] 			= 'Form Materi';
		$data['url'] 			= base_url('Materi/Insert_materi');
		$data['id'] 			= rand(0, 99) . date('mdh');
		$data['nama_materi']    = '';
		$data['file_materi'] 	= '';
		
		$this->template->load('home', 'form_materi', $data);
	}

	function Insert_materi()
	{
		// Konfigurasi untuk upload gambar lokasi
		$config['upload_path']   = 'assets/img/materi';
		$config['allowed_types'] = 'jpeg|png|gif|pdf|doc';
		$config['max_size']      = 200000;
		$config['encrypt_name'] = true;
		$config['overwrite'] = true;
		$this->load->library('upload', $config);

		// Upload Materi 2
		if ($this->upload->do_upload('file_materi')) {
			$data_file_materi = $this->upload->data();
			$file_materi = $data_file_materi['file_name'];

			$req = [
				'method' => 'insert',
				'table' => 't_materi',
				'value' => [
					'nama_materi'		 => $this->input->post('nama_materi'),
					'file_materi'		 => $file_materi,
				]
			];
			
			$this->Modular->queryBuild($req);

		} else {
			$error = $this->upload->display_errors();
		}
	}

	function edit_materi($id)
	{
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_materi',
			'where' => [
				'kd_materi' => $id
			]
		];

		$row = $this->Modular->queryBuild($req)->row();
		$data['title'] = "Update Materi :: CSS XII Kota Cilegon";
		$data['judul'] = 'Update Materi ';
		$data['url'] = base_url('Materi/update_Materi');
		$data['id'] = $id;
		$data['nama_materi'] 	= $row->nama_materi;
		$data['file_materi'] 	= $row->file_materi;
		$this->template->load('home', 'form_materi', $data);
		
	}

	function update_Materi()
	{
		// Konfigurasi untuk upload gambar lokasi
		$config['upload_path']   = './assets/upload_materi';
		$config['allowed_types'] = 'mp4|mp3|jpg|jpeg|png|gif';
		$config['max_size']      = 200000;
		$this->load->library('upload', $config);

		// Upload Materi 2
		if ($this->upload->do_upload('file_materi')) {
			$data_file_materi = $this->upload->data();
			$file_materi = $data_file_materi['file_name'];

			$req = [
				'method' => 'update',
				'table' => 't_materi',
				'value' => [
					'nama_materi' 	 => $this->input->post('nama_materi'),
					'file_materi' 	 => $file_materi,
				],
				
				'where' => ['kd_materi' => $this->input->post('id')]
			];
			
			$this->Modular->queryBuild($req);
			
		} else {
			$error = $this->upload->display_errors();
			// Handle kesalahan upload foto gambar 2
		}
	}

	public function downloadFile($kd_materi, $file_name) {
        $file_path = FCPATH . './assets/upload_materi/' . $file_name;

        if (file_exists($file_path)) {

			$Jumlah = $this->Modular->Jumlahdownload($kd_materi)->row()->jumlah_download;

			// Increment Jumlah
			$Jumlah++;

			$req = [
				'method' => 'update',
				'table' => 't_materi',
				'value' => [
					'jumlah_download' 	 => $Jumlah,
				],
				
				'where' => ['kd_materi' => $kd_materi]
			];
			
			$this->Modular->queryBuild($req);
			
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            readfile($file_path);
            exit;
        } else {
            echo "File not found";
        }
    }
}