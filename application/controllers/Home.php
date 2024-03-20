<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
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
        $data['title'] = "Beranda :: My Asisten";
        $data['judul'] = '<h4 class="mb-0">Beranda</h4> <b>Selamat datang di Panel My Asisten</b>';
        $data['linkpage'] ='';
		$this->template->load('home', 'pages/dashboard' ,$data);	
	}

	function hapusData() {
		foreach($this->input->post('id') as $key => $value) {
			$x = explode('=', $value);
			$pk = $x['0'];
			$tabel = $x['1'];
			$field = $x['2'];
			$folder= $x['3'];
			$file = $x['4'];

			if($file != '' && file_exists($dot = 'assets/images/'.$folder.'/'.$file)) {
				unlink($dot);
			}
			$req = [
				'method' => 'delete',
				'table' => $tabel,
				'where' => [
					$field => $pk
				]
			];
			$this->Modular->queryBuild($req);
		}
	}

	function update_usrdt() {
		$row = $this->db->get_where('t_admin', ['kd_admin' => $this->session->userdata('kd_sesi')])->row();
		if($this->input->post('password') != '') {
			$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		} else {
			$password = $row->passwordnya;
		}
		$req = [
			'method' => 'update',
			'table' => 't_admin',
			'where' => [
				'kd_admin' => $this->session->userdata('kd_sesi')
			],
			'value' => [
				'username' => $this->input->post('username'),
				'level_admin' => $this->input->post('level'),
				'passwordnya' => $password
			]
		];
		$this->Modular->queryBuild($req);
	}
}
