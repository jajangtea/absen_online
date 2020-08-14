<?php
class Kelas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated(); // Panggil fungsi authenticated
        $this->load->model('KelasModel', 'km');
        $this->db2 = $this->load->database('db_simak', true);

        $this->load->model('JadwalModel', 'jm');
    }

    public function index()
    {
        $this->config->config["pageTitle"] = 'Beranda';
        $penyelenggaraan = $this->db->query("select * from sia_penyelenggaraan where status='yes'")->row();
        $tahun  = $penyelenggaraan->tahun;
        $idsmt = $penyelenggaraan->semester;
        $data['prodi'] = $this->jm->get_prodi();
        $data['kelas'] = $this->jm->get_kelas();
        $data['sql_kelas'] = $this->km->get_kelas($tahun, $idsmt);

        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('kelas/index', $data);
        $this->load->view('layouts/footer');
    }
    public function cari()
    {
        $this->config->config["pageTitle"] = 'Beranda';
        $kjur = $this->input->post('prodi');
        $kelas_ = $this->input->post('kelas');


        $penyelenggaraan = $this->db->query("select * from sia_penyelenggaraan where status='yes'")->row();
        $tahun  = $penyelenggaraan->tahun;
        $idsmt = $penyelenggaraan->semester;
        $data['prodi'] = $this->jm->get_prodi();
        $data['kelas_'] = $this->input->post('kelas');
        $data['kelas'] = $this->jm->get_kelas();
        $data['sql_kelas'] = $this->km->get_kelas_cari($tahun, $idsmt, $kelas_, $kjur);

        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('kelas/index', $data);
        $this->load->view('layouts/footer');
    }

    public function getUsers()
    {
        $penyelenggaraan = $this->db->query("select * from sia_penyelenggaraan where status='yes'")->row();
        $tahun  = $penyelenggaraan->tahun;
        $idsmt = $penyelenggaraan->semester;
        $response = $this->km->getUsers($tahun, $idsmt);

        echo json_encode($response);
    }
    public function cari_mhs()
    {
        $query = $this->input->get('query');
        $prodi = $this->input->get('prodi');
        $kelas = $this->input->get('kelas');
        $penyelenggaraan = $this->db->query("select * from sia_penyelenggaraan where status='yes'")->row();
        $tahun  = $penyelenggaraan->tahun;
        $idsmt = $penyelenggaraan->semester;
        $data = $this->km->get_kelas_cari($tahun, $idsmt, $kelas, $prodi, $query);
        echo json_encode($data);
    }
}
