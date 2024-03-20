<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
        $data['title'] = "Login :: My Asisten";
        $this->load->view('pages/login', $data);	
	}

    function ceklogin() {
        $check  = $this->db->get_where('t_admin', ['username' => $this->input->post('user')]);
        if ($check->num_rows() > 0) {
            $row = $check->row();
            if (password_verify($this->input->post('password'), $row->passwordnya)) {
                $session= array(
                    'kd_sesi'  => $row->kd_admin,
                    'status_sesi'=> TRUE
                );
                $this->session->set_userdata($session);
                $this->db->where('kd_admin', $this->session->userdata('kd_sesi'));
                $this->db->update('t_admin', ['last_login' => date('Y-m-d H:i:s')]);
                echo '1';
            } else {
                $session['status_sesi'] = FALSE;
                $this->session->set_userdata($session);
                echo "2";
            }
        } else {
            $session['status_sesi'] = FALSE;
            $this->session->set_userdata($session);
            echo "3";
        }
    }
    //reset_password//
    public function reset_password() {
        $data['title'] = "Lupa Password :: My Asisten";
        $this->load->view('pages/reset_password', $data);	
	}

    function out() {
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }
}