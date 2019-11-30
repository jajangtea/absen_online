<?php

class BukuController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Buku');
        
    }

    public function index(){
        $data['semua_buku']=$this->Buku->get_buku();
        $this->load->view('layouts/header');
        $this->load->view('Buku/index', $data);
        $this->load->view('layouts/footer');
        
    }

    public function view($id){
        $this->db->select('*');
        $this->db->from('buku');
        $this->db->where('kode_buku',$id)->row();
        $data['semua_buku']=$this->Buku->get_buku();
        echo 'coba';
        
        
    }
    public function delete($id){
        $data['semua_buku']=$this->Buku->get_buku();
        
        
    }
    public function tambah($id){
        $data['semua_buku']=$this->Buku->get_buku();
        
        
    }


}