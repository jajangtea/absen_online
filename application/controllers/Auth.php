<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('encryption');
    }

    public function index() {
        if ($this->session->userdata('authenticated')) {
            redirect('presensi/index');
        }
        $this->render_login('login');
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->UserModel->get($username);
        if (empty($user)) {
            $this->session->set_flashdata('message', 'Username tidak ditemukan');
            redirect('auth');
        } else {
            if ($password == $this->encryption->decrypt($user->password)) {
                $session = array(
                    'authenticated' => true,
                    'username' => $user->username,
                    'nama' => $user->nama,
                    'iddosen'=>$user->iddosen,
                    'role' => $user->role,
                );
                $this->session->set_userdata($session);
                redirect('presensi/home');
            } else {
                $this->session->set_flashdata('message', 'Password salah');
                redirect('auth');
            }
        }
    }
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }

}
