<?php defined('BASEPATH') or exit('tidak bisa diakses scara langsung');

class Pengguna extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PenggunaModel');
        $this->load->library('form_validation');
        
    }

    public function index()
    {

        $data['semua_data'] = $this->PenggunaModel->tampilSemua();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('pengguna/index', $data);
        $this->load->view('layouts/footer');


    }

    public function tambah()
    {
        $this->load->view('layouts/header');
        $this->load->view('pengguna/create');
        $this->load->view('layouts/footer');
    }

    public function edit($id)
    {
        $data['pengguna']=$this->Pengguna->view($id)->row();
        $this->load->view('layouts/header');
        $this->load->view('Pengguna/update',$data);
        $this->load->view('layouts/footer');
    }

    public function hapus($id){
        if($this->Pengguna->hapus($id) == TRUE) {
            $this->session->set_flashdata('hapus', true);
       }
       else {
            $this->session->set_flashdata('hapus', false);
       }
       redirect(base_url());
    }

    public function simpan()
    {
        $this->form_validation->set_rules('nama', 'Username', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('umur', 'Umur', 'trim|required|min_length[8]');
       // $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        //$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    
        $data = array(
            'nama' => $this->input->post('nama'),
            'umur' => $this->input->post('umur'),
            'tanggal_lahir' => date('Y-m-d 00:00:00', strtotime($this->input->post('tanggal_lahir'))),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
        );


        if ($this->form_validation->run() == false){
            $this->load->view('layouts/header');
            $this->load->view('pengguna/create');
            $this->load->view('layouts/footer');
        } else {
            $this->session->set_flashdata('tambah', flase);
            $this->Pengguna->tambah($data) == true;
            redirect(base_url());
        }

       
    }
}
