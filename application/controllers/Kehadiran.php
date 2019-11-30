<?php

class Kehadiran extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kehadiran_model', 'mk');
        $this->load->model('PresensiModel', 'mp');
    }

    public function index()
    {
        if (isset($_POST['hidden1'])) {
            $this->session->set_userdata('pertemuanke', $_POST['hidden1']);
        }

        $nama_kelompok = $this->session->userdata('nama_kelompok');
        $idpenyelenggaraan = $this->session->userdata('idpenyelenggaraans_');
        $nama_kelas = $this->session->userdata('kls');
        $data['data_kehadiran_master'] = $this->mp->get_tampil_mahasiswa($idpenyelenggaraan, $nama_kelompok, $nama_kelas);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('kehadiran/index', $data);
        $this->load->view('layouts/footer');
    }

    public function simpan_absen()
    {
        $data_array = array(
            'nim' => $this->input->post('nim_mhs'),
            'absen' => $this->input->post('absen'),
        );

        $data = array();
        $i = 0;
        foreach ($data_array as $key => $val) {
            $i = 0;
            foreach ($val as $k => $v) {
                $data[$i][$key] = $v;
                $i++;
            }
        }
        $this->db->insert_batch('kehadiran', $data);
    }
}