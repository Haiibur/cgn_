<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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
        $data['title'] = "Administrator :: My Asisten";
        $data['judul'] = 'Administrator';
        $data['linkpage'] ='';
		$this->template->load('home', 'admin' ,$data);	
	}
	
	function load_admin() {
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_admin',
			'order' => 'kd_admin ASC'
		];
		$res = $this->Modular->queryBuild($req)->result();
		$output = array();
		foreach ($res as $key => $value) {
			$iddata = $value->kd_admin.'=t_admin=kd_admin=admin=0.jpg';
			$level = $this->db->get_where('t_level_admin', ['kd_level' => $value->level_admin])->row();
			$data = [
				'id' => $value->kd_admin,
				'ids' => $iddata,
				'level' => $level->nama_level,
				'username' => $value->username,
				'login' => $value->last_login
			];
			array_push($output, $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function buat_adm() {
		$var   = [];
		$req_level = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_level_admin',
			'order' => 'kd_level ASC'
		];
		foreach($this->Modular->queryBuild($req_level)->result() as $key => $value) {
			$data = [
				$value->kd_level => $value->nama_level
			];
			array_push($var, $data);
		}
		$output = [
			'action' => ''.base_url('admin/simpan_adm').'',
			'id' => rand(0, 99).date('mdH'),
			'name' => '',
			'level' => $var,
			'username' => ''
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function simpan_adm() {
		$req = [
			'method' => 'insert',
			'table' => 't_admin',
			'value' => [
				'kd_admin' => $this->input->post('id'),
				'level_admin' => $this->input->post('level'),
				'username' => $this->input->post('username'),
				'passwordnya' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
			]
		];
		$this->Modular->queryBuild($req);
	}

	function edit_adm($id) {
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_admin',
			'where' => [
				'kd_admin' => $id
			]
		];
		$res = $this->Modular->queryBuild($req)->row_array();
		$var   = [];
		$req_level = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_level_admin',
			'order' => 'kd_level ASC'
		];
		foreach($this->Modular->queryBuild($req_level)->result() as $key => $value) {
			$data = [
				$value->kd_level => $value->nama_level
			];
			array_push($var, $data);
		}
		$output = [
			'action' => ''.base_url('admin/update_adm').'',
			'id' => $id,
			'level' => $var,
			'selected' => $res['level_admin'],
			'username' => $res['username']
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function update_adm() {
		$req = [
			'method' => 'get',
			'select' => '*',
			'table' => 't_admin',
			'where' => [
				'kd_admin' => $this->input->post('id')
			]
		];
		$res = $this->Modular->queryBuild($req)->row_array();


		if($this->input->post('password') != '') {
			$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		} else {
			$password = $res['passwordnya'];
		}
		$data = 
		$req = [
			'method' => 'update',
			'table' => 't_admin',
			'where' => [
				'kd_admin' => $res['kd_admin']
			],
			'value' => [
				'level_admin' => $this->input->post('level'),
				'username' => $this->input->post('username'),
				'passwordnya' => $password
			]
		];
		$this->Modular->queryBuild($req);
	}
}