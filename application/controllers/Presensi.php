<?php
class Presensi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated(); // Panggil fungsi authenticated
        $this->load->model('PresensiModel');
        $this->load->model('KehadiranModel', 'mk');
        $this->load->model('PresensiModel', 'mp');
        $this->load->model('JadwalModel', 'jm');
        $this->db2 = $this->load->database('db_simak', true);
    }

    public function index()
    {
        $data['prodi'] = $this->jm->get_prodi();
        $data['kelas'] = $this->jm->get_kelas();
        $this->config->config["pageTitle"] = 'Beranda';
        $this->session->unset_userdata('nama_kelompok');
        $yes = $this->PresensiModel->get_yes();
        $this->session->set_userdata('semester', $yes->semester);
        $this->session->set_userdata('tahun', $yes->tahun);
        $this->session->set_userdata('tahun_akademik', $yes->tahun_akademik);
        $data['sql_jadwal_dosen'] = $this->PresensiModel->get_jadwal_dosen($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_ruangan']     = $this->PresensiModel->get_ruang();
        $data['data_hari']        = $this->PresensiModel->get_hari($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_matakuliah']  = $this->PresensiModel->get_matakuliah($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_nama_kelas']  = $this->PresensiModel->get_nama_kelas($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('presensi/home', $data);
        $this->load->view('layouts/footer');
    }

    public function cari()
    {
        $this->session->set_userdata('semester');
        $semester = $this->input->post('semester');
        $this->session->set_userdata('semester',$semester);
        $data['prodi'] = $this->jm->get_prodi();
        $data['kelas'] = $this->jm->get_kelas();
        $this->config->config["pageTitle"] = 'Beranda';
        $this->session->unset_userdata('nama_kelompok');
        $yes = $this->PresensiModel->get_yes();
        $this->session->set_userdata('tahun', $yes->tahun);
        $this->session->set_userdata('tahun_akademik', $yes->tahun_akademik);
        $data['sql_jadwal_dosen'] = $this->PresensiModel->get_jadwal_dosen($yes->tahun, $semester, $this->session->userdata('iddosen'));
        $data['data_ruangan']     = $this->PresensiModel->get_ruang();
        $data['data_hari']        = $this->PresensiModel->get_hari($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_matakuliah']  = $this->PresensiModel->get_matakuliah($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_nama_kelas']  = $this->PresensiModel->get_nama_kelas($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('presensi/home', $data);
        $this->load->view('layouts/footer');
    }

    public function tampil_absen($idpenyelenggaraan, $idkelas)
    {
        $this->config->config["pageTitle"] = 'Data Pertemuan';
        $this->session->set_userdata('idpenyelenggaraans_', $idpenyelenggaraan);
        $yes                           = $this->PresensiModel->get_yes();
        $data['sql_jadwal_dosen']      = $this->PresensiModel->get_jadwal_dosen($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_ruangan']          = $this->PresensiModel->get_ruang();
        $data['data_hari']             = $this->PresensiModel->get_hari($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_matakuliah']       = $this->PresensiModel->get_matakuliah($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_nama_kelas']       = $this->PresensiModel->get_nama_kelas($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_mhs']              = $this->PresensiModel->get_mahasiswa($idpenyelenggaraan, $idkelas);
        $data['data_detil']            = $this->PresensiModel->get_detil_mahasiswa($idpenyelenggaraan, $idkelas);
        $data['data_kehadiran_master'] = $this->PresensiModel->get_kehadiran_master($idpenyelenggaraan, $nama_kelompok = null, $this->session->userdata('kls'));
        foreach ($data['data_detil']->result() as $dx) {
            $this->session->set_userdata('nmatkul', $dx->nmatkul);
            $this->session->set_userdata('kjur', $dx->kjur);
            $this->session->set_userdata('kls', $dx->idkelas);
        }
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('presensi/data_mhs', $data);
        $this->load->view('layouts/footer');
    }

    public function tampil_kelompok($nama_kelas)
    {
        $this->config->config["pageTitle"] = 'Data Kelompok';
        $this->session->set_userdata('nama_kelompok', $nama_kelas);
        $yes                      = $this->PresensiModel->get_yes();
        $data['sql_jadwal_dosen'] = $this->PresensiModel->get_jadwal_dosen($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_ruangan']     = $this->PresensiModel->get_ruang();
        $data['data_hari']        = $this->PresensiModel->get_hari($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_matakuliah']  = $this->PresensiModel->get_matakuliah($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $data['data_nama_kelas']  = $this->PresensiModel->get_nama_kelas($yes->tahun, $yes->semester, $this->session->userdata('iddosen'));
        $idpenyelenggaraans       = $this->session->userdata('idpenyelenggaraans_');
        $nama_kelompok            = $nama_kelas;
        $data['data_mhs']         = $this->PresensiModel->get_tampil_mahasiswa($idpenyelenggaraans, $nama_kelompok, $this->session->userdata('kls'));
        $data['data_jam_ngajar']  = $this->PresensiModel->get_jam_ngajar($idpenyelenggaraans, $nama_kelompok, $this->session->userdata('kls'));
        // $data['data_detil_mahasiswa'] = $this->PresensiModel->get_detil_mahasiswa($this->session->userdata('idpenyelenggaraans_'), $this->session->userdata('idkelas_'));
        $data['data_kehadiran_master'] = $this->PresensiModel->get_kehadiran_master($idpenyelenggaraans, $nama_kelompok, $this->session->userdata('kls'));
        if ($data['data_kehadiran_master']->num_rows() == 0) {
            $pertemuan_karyawan = 14;
            for ($i = 1; $pertemuan_karyawan >= $i; $i++) {
                $this->db->query("insert into sia_kehadiran_master(iddosen,idpenyelenggaraan,idkelas,nama_kelas,kode_mkul,matakuliah,pertemuan)values('" . $this->session->userdata('iddosen') . "','" . $idpenyelenggaraans . "','" . $this->session->userdata('kls') . "','" . $nama_kelas . "','" . $this->session->userdata('kode') . "','" . $this->session->userdata('nmatkul') . "','" . $i . "')");
            }
        }
        $data['data_kehadiran_master'] = $this->PresensiModel->get_kehadiran_master($idpenyelenggaraans, $nama_kelompok, $this->session->userdata('kls'));
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('presensi/data_mhs', $data);
        $this->load->view('layouts/footer');
    }
}
