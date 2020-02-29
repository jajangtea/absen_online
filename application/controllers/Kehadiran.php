<?php

class Kehadiran extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('KehadiranModel','mk');
        $this->load->model('PresensiModel','mp');
    }

    public function index()
    {
        if (isset($_POST['hidden1']) && isset($_POST['hidden_id'])) {
            $this->session->set_userdata('pertemuanke', $_POST['hidden1']);
            $this->session->set_userdata('hidden_id', $_POST['hidden_id']);
        }
        $nama_kelompok = $this->session->userdata('nama_kelompok');
        $idpenyelenggaraan = $this->session->userdata('idpenyelenggaraans_');
        $nama_kelas = $this->session->userdata('kls');
        $data['data_kehadiran_master'] = $this->mp->get_tampil_mahasiswa($idpenyelenggaraan, $nama_kelompok, $nama_kelas);
        $data['data_kehadiran'] = $this->mp->get_data_kehadiran($this->session->userdata('hidden_id'));
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
            'keterangan' => $this->input->post('keterangan'),
            'id_kehadiran_master' => $this->input->post('hidden_id'),
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
        $this->db->insert_batch('sia_kehadiran', $data);
        redirect(base_url() . 'kehadiran/index');
    }
}
