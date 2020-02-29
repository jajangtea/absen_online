<?php
class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RegisterModel');
        $this->load->library('encryption');
    }

    public function signup()
    {

        if ($this->input->method() === 'post') {
           $key_pass=md5(rand());
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->encryption->encrypt($this->input->post('password')),
                'password_key' => $key_pass,
                'nama' => $this->input->post('nama'),
                'role' => $this->input->post('role'),
                'iddosen' => $this->input->post('iddosen'),
            );

            $this->db->insert('sia_user', $data);
            $this->session->set_flashdata('pesan_register','Berhasil');
            redirect(base_url() . 'user/register');
        } else {
            redirect(base_url() . 'user/register');
        }
    }
    public function register()
    {
        $data['data_dosen'] = $this->RegisterModel->get_dosen();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('user/register', $data);
        $this->load->view('layouts/footer');

    }

}
