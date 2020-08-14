<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public $message = "";
    public $userdata = "";
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('db_simak', true);
    }
    public function validateUser($username, $password)
    {
        $this->db2->where('username', $username);
        $result = $this->db2->get('user')->row();



        // $this->db2->where('nim', $username);
        $this->db2->select('*');
        $this->db2->from('v_datamhs');
        // $this->db2->join('formulir_pendaftaran', 'formulir_pendaftaran.no_formulir = profiles_mahasiswa.no_formulir');
        // $this->db2->join('register_mahasiswa', 'register_mahasiswa.nim = profiles_mahasiswa.nim');
        $this->db2->join('program_studi', 'program_studi.kjur = v_datamhs.kjur');
        $this->db2->where(array('v_datamhs.nim' => $username));
        $profiles_mahasiswa = $this->db2->get()->row();


        if (!empty($profiles_mahasiswa)) {
            $this->userdata = 'mh';
        } elseif (!empty($result)) {
            $this->userdata = $result->page;
        } else {
            $this->session->set_flashdata('message', 'Username tidak ditemukan');
            redirect('auth');
        }

        if ($this->userdata != "") {
            switch ($this->userdata) {
                case 'mh':
                    $pass = md5($password);
                    if ($profiles_mahasiswa->userpassword == $pass) {

                        $session = array(
                            'authenticated' => true,
                            'username' => $profiles_mahasiswa->nim,
                            'nama' => $profiles_mahasiswa->nama_mhs,
                            'nama_ps' => $profiles_mahasiswa->nama_ps,
                            'konsentrasi' => $profiles_mahasiswa->konsentrasi,
                            'tempat_lahir' => $profiles_mahasiswa->tempat_lahir,
                            'tanggal_lahir' => $profiles_mahasiswa->tanggal_lahir,
                            'idkelas' => $profiles_mahasiswa->idkelas,
                            'role' => "mh",
                        );
                        $this->session->set_userdata($session);
                        redirect('presensi/absen');
                    } else {
                        $message = "Gagal. Silahkan masukan username dan password dengan benar.";
                        $this->session->set_flashdata('message', $message);
                        redirect('auth');
                    }
                    break;
                case 'd':
                case 'm':
                    $pass = hash('sha256', $result->salt . hash('sha256', $password));
                    // print_r($result);
                    // exit;
                    if ($result->userpassword == $pass && $result->active == 1) {
                        $session = array(
                            'authenticated' => true,
                            'username' => $result->username,
                            'nama' => $result->nama,
                            'iddosen' => $this->get_dosen($result->username),
                            'role' => $result->page,
                        );
                        $this->session->set_userdata($session);
                        redirect('presensi/home');
                    } else {
                        $message = "Gagal. Silahkan masukan username dan password dengan benar.";
                        $this->session->set_flashdata('message', $message);
                        redirect('auth');
                    }

                    break;
                default:
                    $message = "Gagal. Silahkan masukan username dan password dengan benar.";
                    $pass = md5($password);
                    redirect('auth');
            }
        }
    }

    public function get_dosen($username)
    {
        $this->db2->where('username', $username);
        $result = $this->db2->get('dosen')->row();
        if (isset($result)) {
            return $result->iddosen;
        } else {
            return false;
        }
    }
}
