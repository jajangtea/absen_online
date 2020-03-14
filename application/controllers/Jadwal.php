<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('JadwalModel', 'jm');
    }
    public function index()
    {
        $penyelenggaraan = $this->db->query("select * from sia_penyelenggaraan where status='yes'")->row();
        $tahun = $penyelenggaraan->tahun;
        $idsmt = $penyelenggaraan->semester;
        $data['prodi'] = $this->jm->get_prodi();
        $data['kelas'] = $this->jm->get_kelas();
        $data['jadwal'] = $this->jm->get_jadwal($tahun, $idsmt, 2, 12,'A');

        $this->config->config["pageTitle"] = 'Jadwal';
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('jadwal/index', $data);
        $this->load->view('layouts/footer');
    }

    public function cari(){
        $penyelenggaraan = $this->db->query("select * from sia_penyelenggaraan where status='yes'")->row();
        $tahun = $penyelenggaraan->tahun;

        $hari = $this->input->post('hari');
        $kjur = $this->input->post('prodi');
        $kelas = $this->input->post('kelas');
        $semester = $this->input->post('semester');
        
        $data['kelas'] = $this->jm->get_kelas();
        $data['prodi'] = $this->jm->get_prodi();
        $data['jadwal'] = $this->jm->get_jadwal($tahun, $semester, $hari, $kjur,$kelas);

        $this->config->config["pageTitle"] = 'Jadwal';
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('jadwal/index', $data);
        $this->load->view('layouts/footer');
    }

    public function laporan_pdf(){
        $data = array(
            "dataku" => array(
                "nama" => "Oke Kode",
                "url" => "http://oke.com"
            )
        );
    
        $this->load->library('pdf');
    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan-absen-mhs.pdf";
        $this->pdf->load_view('laporan_pdf', $data);
    
    
    }
}

/* End of file Jadwal.php */
