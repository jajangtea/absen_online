<?php

class Kehadiran extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('KehadiranModel', 'mk');
    $this->load->model('PresensiModel', 'mp');
    $this->db2 = $this->load->database('db_simak', true);
  }

  public function sync()
  {
    $this->db->truncate('master_mhs');

    $data = $this->db2->select('nim, nama_mhs,tempat_lahir,tanggal_lahir,tanggal_lahir,jk,alamat_rumah,telp_hp,email,kjur')->get('v_datamhs');
    foreach ($data->result_array() as $row) { // loop over results
      $this->db->insert('master_mhs', $row); // insert each row to another table
    }
  }

  public function cek()
  {
    $query1        = $this->db->query("select nim from master_mhs");
    $query1_result = $query1->result();
    $nim           = array();
    foreach ($query1_result as $row) {
      $nim[] = $row->nim;
    }
    $room = implode(",", $nim);
    $ids  = explode(",", $room);

    $data = $this->db2->select('nim, nama_mhs,tempat_lahir,tanggal_lahir,tanggal_lahir,jk,alamat_rumah,telp_hp,email,kjur');
    $this->db2->from('v_datamhs');
    $this->db2->where_not_in('nim', $ids);

    $data = $this->db2->get();
    //  print_r($query->result());
    foreach ($data->result_array() as $row) { // loop over results
      $this->db->insert('master_mhs', $row); // insert each row to another table
    }
  }

  public function index($id = null)
  {
    if (isset($_POST['hidden1']) && isset($_POST['hidden_id'])) {
      $this->session->set_userdata('pertemuanke', $_POST['hidden1']);
      $this->session->set_userdata('hidden_id', $_POST['hidden_id']);
    }
    $nama_kelompok                 = $this->session->userdata('nama_kelompok');
    $idpenyelenggaraan             = $this->session->userdata('idpenyelenggaraans_');
    $nama_kelas                    = $this->session->userdata('kls');
    $idkehadiran = $this->session->userdata('hidden_id');
    $data_kehadiran = $this->mp->get_data_kehadiran($this->session->userdata('hidden_id'), $nama_kelas, $nama_kelompok, $idpenyelenggaraan);
    $my_values = array();
    $my_nim = array();
    foreach ($data_kehadiran as $datas_kehadiran) {
      $my_nim[] = $datas_kehadiran->nim;
    }

    $string_nim = implode(', ', $my_nim);
    if (empty($string_nim)) {
      $data['data_kehadiran_master'] = $this->mp->get_tampil_mahasiswa_kelompok($idpenyelenggaraan, $nama_kelompok, $nama_kelas);
    } else {
      $data['data_kehadiran_master'] = $this->mp->get_tampil_mahasiswa($idpenyelenggaraan, $nama_kelompok, $nama_kelas, $string_nim);
    }


    $data['ubah'] = $this->mk->update_status_absen('OK', $this->session->userdata('hidden_id'));

    $this->config->config["pageTitle"] = 'Absen Mahasiswa';
    $this->load->view('layouts/header');
    $this->load->view('layouts/sidebar');
    $this->load->view('kehadiran/index', $data);
    $this->load->view('layouts/footer');
  }

  public function cari_ektension()
  {
    $query = $this->input->get('query');
    if (isset($_POST['hidden1']) && isset($_POST['hidden_id'])) {
      $this->session->set_userdata('pertemuanke', $_POST['hidden1']);
      $this->session->set_userdata('hidden_id', $_POST['hidden_id']);
    }
    $idpenyelenggaraan             = $this->session->userdata('idpenyelenggaraans_');
    $data = $this->mp->get_tampil_mahasiswa_ektension($idpenyelenggaraan, $query);
    
    echo json_encode($data);
  }

  public function tampil_kehadiran()
  {
    $this->config->config["pageTitle"] = 'Data Mahasiswa';
    $nama_kelompok                 = $this->session->userdata('nama_kelompok');
    $idpenyelenggaraan             = $this->session->userdata('idpenyelenggaraans_');
    $nama_kelas                    = $this->session->userdata('kls');

    $data = $this->mp->get_data_kehadiran($this->session->userdata('hidden_id'), $nama_kelas, $nama_kelompok, $idpenyelenggaraan);
    echo json_encode($data);
  }

  public function tampil_input_absen()
  {
    $this->config->config["pageTitle"] = 'Input Absen';

    $nama_kelompok                  = $this->session->userdata('nama_kelompok');
    $idpenyelenggaraan              = $this->session->userdata('idpenyelenggaraans_');
    $nama_kelas                     = $this->session->userdata('kls');
    $idkehadiran                    = $this->session->userdata('hidden_id');
    $data_kehadiran                 = $this->mp->get_data_kehadiran($this->session->userdata('hidden_id'), $nama_kelas, $nama_kelompok, $idpenyelenggaraan);
    $my_values = array();
    $my_nim = array();
    foreach ($data_kehadiran as $datas_kehadiran) {
      $my_nim[] = $datas_kehadiran->nim;
    }

    $string_nim = implode(', ', $my_nim);
    if (empty($string_nim)) {
      $data = $this->mp->get_tampil_mahasiswa_kelompok($idpenyelenggaraan, $nama_kelompok, $nama_kelas);
    } else {
      $data = $this->mp->get_tampil_mahasiswa($idpenyelenggaraan, $nama_kelompok, $nama_kelas, $string_nim);
    }
    $data=array(
      'input_data'=>$data->result(),
      'idkehadiran'=>$idkehadiran,
    );
    echo json_encode($data);
   // $data['ubah'] = $this->mk->update_status_absen('OK', $this->session->userdata('hidden_id'));
    
  }



  public function cek_absen()
  {
    $status_absen = $this->mk->cek_status_absen('OK', $this->session->userdata('hidden_id'));

    $callback = array(
      'status' => 'sukses',
      'pesan' => 'Data berhasil dibaca.',
      'status_absen' => $status_absen
    );

    echo json_encode($callback);
  }

  public function cek_absen_mahasiswa()
  {
    $status_absen_mahasiswa = $this->mk->cek_status_absen_mahasiswa($this->session->userdata('hidden_id'), $this->session->userdata('username'));

    $callback = array(
      'status' => 'sukses',
      'pesan' => 'Data berhasil dibaca.',
      'status_absen' => $status_absen_mahasiswa
    );

    echo json_encode($callback);
  }

  public function simpan_absen()
  {
    $data_array = array(
      'id_kehadiran_master' => $this->input->post('hidden_id'),
      'nim'                 => $this->input->post('nim_mhs'),
      'absen'               => $this->input->post('absen'),
      'keterangan'          => $this->input->post('keterangan'),
      'rangkuman'           => $this->input->post('rangkuman'),
    );
    $data = array();
    foreach ($data_array as $key => $val) {
      $i = 0;
      foreach ($val as $k => $v) {
        $data[$i][$key] = $v;
        $i++;
      }
    }

    $data['simpan'] = $this->db->insert_batch('sia_kehadiran', $data);
    $data['ubah'] = $this->mk->update_status_absen('OK', $this->session->userdata('hidden_id'));
    echo json_encode($data);
  }

  public function simpan_absen_oleh_dosen()
  {
    $data_array = array(
      'id_kehadiran_master' => $this->input->post('hidden_id'),
      'nim'                 => $this->input->post('nim_mhs'),
      'absen'               => $this->input->post('absen'),
      'keterangan'          => $this->input->post('keterangan'),
      'rangkuman'           => $this->input->post('rangkuman'),
    );
    $data = array();
    foreach ($data_array as $key => $val) {
      $i = 0;
      foreach ($val as $k => $v) {
        $data[$i][$key] = $v;
        $i++;
      }
    }

    $data['simpan'] = $this->db->insert_batch('sia_kehadiran', $data);
    $data['ubah'] = $this->mk->update_status_absen('OK', $this->session->userdata('hidden_id'));
    echo json_encode($data);
    // redirect(base_url() . 'kehadiran/index');

  }

  public function edit()
  {
    $id = $this->input->get('id');

    $this->db->select('*');
    $this->db->from('sia_kehadiran vk');
    $this->db->join('master_mhs rk', 'vk.nim=rk.nim');
    $this->db->where('id', $id);
    $e = $this->db->get()->row();

    $kirim['id']         = $e->id;
    $kirim['nim']        = $e->nim;
    $kirim['absen']      = $e->absen;
    $kirim['nama']       = $e->nama_mhs;
    $kirim['keterangan'] = $e->keterangan;
    $kirim['rangkuman'] = $e->rangkuman;
    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($kirim));
  }
  public function update()
  {
    $id = $this->input->get('id');
    $absen      = $this->input->post('absen');
    $keterangan = $this->input->post('keterangan');
    $rangkuman = $this->input->post('rangkuman');
    $data       = $this->mk->update_absen($id, $absen, $keterangan, $rangkuman);
    echo json_encode($data);
  }

  public function cari()
  {
    $query = $this->input->get('query');
    $data = $this->mp->cari_data($query);
    echo json_encode($data);
  }

  public function cari_mahasiswa()
  {
    $data = $this->mp->cari_data_mahasiswa();
    echo json_encode($data);
  }

  public function absen_mhs()
  {
    if (isset($_POST['hidden1']) && isset($_POST['hidden_id'])) {
      $this->session->set_userdata('pertemuanke', $_POST['hidden1']);
      $this->session->set_userdata('hidden_id', $_POST['hidden_id']);
    }
    $idpenyelenggaraan             = $this->session->userdata('idpenyelenggaraans_');
    $data['data_kehadiran_master'] = $this->mp->get_tampil_mahasiswa_kelompok($idpenyelenggaraan, $nama_kelompok, $nama_kelas);
    //   $data['data_kehadiran'] = $this->mp->get_data_kehadiran($this->session->userdata('hidden_id'));
    $this->config->config["pageTitle"] = 'Absen';
    $this->load->view('layouts/header');
    $this->load->view('layouts/sidebar');
    $this->load->view('kehadiran/index', $data);
    $this->load->view('layouts/footer');
  }

  public function do_absen($id = null)
  {
    if (isset($_POST['hidden1']) && isset($_POST['hidden_id'])) {
      $this->session->set_userdata('pertemuanke', $_POST['hidden1']);
      $this->session->set_userdata('hidden_id', $_POST['hidden_id']);
    }
    $idpenyelenggaraan             = $this->session->userdata('pertemuan');
    $nim = $this->session->userdata('username');
    $data['data_kehadiran_master'] = $this->mp->do_tampil_mahasiswa($idpenyelenggaraan, $nim);
    $this->config->config["pageTitle"] = 'Absen Mahasiswa';
    $this->load->view('layouts/header');
    $this->load->view('layouts/sidebar');
    $this->load->view('kehadiran/mahasiswa_index.php', $data);
    $this->load->view('layouts/footer');
  }
}
