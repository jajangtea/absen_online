<?php

class PresensiModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('db_simak', true);
    }

    public function get_data()
    {
        $this->db2->order_by('nama_mhs');
        return $this->db2->get('v_datamhs');
    }

    public function get_ruang()
    {
        $this->db2->distinct();
        $this->db2->select('vk.idruangkelas,rk.namaruang');
        $this->db2->from('v_kelas_mhs vk');
        $this->db2->join('ruangkelas rk', 'vk.idruangkelas=rk.idruangkelas');
        $this->db2->order_by('rk.namaruang', 'asc');
        $query = $this->db2->get();
        return $query->result_array();
    }

    public function get_hari($tahun, $semester, $iddosen)
    {
        $sql_hari = " SELECT DISTINCT (vkm.hari)
                        FROM v_kelas_mhs vkm
                        INNER JOIN krsmatkul km ON vkm.idkrsmatkul=km.idkrsmatkul
                        INNER JOIN krs kr ON km.idkrs=kr.idkrs
                        INNER JOIN register_mahasiswa rm ON kr.nim=rm.nim
                        INNER JOIN formulir_pendaftaran fp ON rm.no_formulir=fp.no_formulir
                        INNER JOIN penyelenggaraan pn ON vkm.idpenyelenggaraan=pn.idpenyelenggaraan
                        INNER JOIN matakuliah mkul ON pn.kmatkul=mkul.kmatkul
                        INNER JOIN ruangkelas rk ON vkm.idruangkelas=rk.idruangkelas
                        WHERE
                        pn.tahun ='$tahun' AND
                        kr.idsmt='$semester' AND
                        vkm.iddosen ='$iddosen' order by vkm.hari asc";

        $query_hari = $this->db2->query($sql_hari);
        return $query_hari->result_array();
    }

    public function get_matakuliah($tahun, $semester, $iddosen)
    {
        $sql_semester = "SELECT  mkul.nmatkul,mkul.kmatkul AS kode FROM v_kelas_mhs vkm INNER JOIN krsmatkul km ON vkm.idkrsmatkul=km.idkrsmatkul
                        INNER JOIN krs kr ON km.idkrs=kr.idkrs INNER JOIN register_mahasiswa rm ON kr.nim=rm.nim
                        INNER JOIN formulir_pendaftaran fp ON rm.no_formulir=fp.no_formulir
                        INNER JOIN penyelenggaraan pn ON vkm.idpenyelenggaraan=pn.idpenyelenggaraan
                        INNER JOIN matakuliah mkul ON pn.kmatkul=mkul.kmatkul INNER JOIN ruangkelas rk ON vkm.idruangkelas=rk.idruangkelas
                        INNER JOIN penyelenggaraan p ON p.idpenyelenggaraan=vkm.idpenyelenggaraan
                        WHERE pn.tahun ='$tahun' AND kr.idsmt='$semester' AND vkm.iddosen ='$iddosen'
                        GROUP BY mkul.kmatkul,mkul.nmatkul
                        ORDER BY vkm.hari ASC";

        $query_semester = $this->db2->query($sql_semester);
        return $query_semester->result_array();
    }

    public function get_nama_kelas($tahun, $semester, $iddosen)
    {
        $sql_nama_kelas = "SELECT  vkm.nama_kelas AS nama_kelas FROM v_kelas_mhs vkm INNER JOIN krsmatkul km ON vkm.idkrsmatkul=km.idkrsmatkul
                        INNER JOIN krs kr ON km.idkrs=kr.idkrs INNER JOIN register_mahasiswa rm ON kr.nim=rm.nim
                        INNER JOIN formulir_pendaftaran fp ON rm.no_formulir=fp.no_formulir
                        INNER JOIN penyelenggaraan pn ON vkm.idpenyelenggaraan=pn.idpenyelenggaraan
                        INNER JOIN matakuliah mkul ON pn.kmatkul=mkul.kmatkul INNER JOIN ruangkelas rk ON vkm.idruangkelas=rk.idruangkelas
                        INNER JOIN penyelenggaraan p ON p.idpenyelenggaraan=vkm.idpenyelenggaraan
                        WHERE pn.tahun ='$tahun' AND kr.idsmt='$semester' AND vkm.iddosen ='$iddosen'
                        GROUP BY vkm.nama_kelas
                        ORDER BY vkm.nama_kelas ASC";

        $query_nama_kelas = $this->db2->query($sql_nama_kelas);
        return $query_nama_kelas->result_array();
    }

    public static function get_nama_hari($id_hari)
    {
        if ($id_hari == 1) {
            return "Senin";
        } elseif ($id_hari == 2) {
            return "Selasa";
        } elseif ($id_hari == 3) {
            return "Rabu";
        } elseif ($id_hari == 4) {
            return "Kamis";
        } elseif ($id_hari == 5) {
            return "Jumat";
        } elseif ($id_hari == 6) {
            return "Sabtu";
        }
    }

    public static function get_nama_semester($idsmt)
    {
        if ($idsmt == 1) {
            return "Ganjil";
        } elseif ($idsmt == 2) {
            return "Genap";
        } elseif ($idsmt == 3) {
            return "Pendek";
        }
    }

    public static function get_nama_kelompok($id_kelompok)
    {
        if ($id_kelompok == 1) {
            return "A";
        } elseif ($id_kelompok == 2) {
            return "B";
        } elseif ($id_kelompok == 3) {
            return "C";
        }
    }

    public static function tampil_nama_prodi($kode)
    {
        switch ($kode) {
            case 12:
                $prodi = "TEKNIK INFORMATIKA";
                break;
            case 32:
                $prodi = "SISTEM INFORMASI";
                break;
            case 42:
                $prodi = "SISTEM INFORMASI KONSETRASI KOMPUTER AKUNTANSI";
                break;
            default:
                $prodi = "Kode Prodi tidak ditemukan.";
        }
        return $prodi;
    }

    public function get_yes()
    {
        return $this->db->get_where('sia_penyelenggaraan', array('status' => 'yes'))->row();
    }

    public function get_jadwal_dosen($tahun, $semester, $iddosen)
    {
        $sql_jadwal_dosen = "SELECT  vkm.idpenyelenggaraan,mkul.nmatkul,mkul.kmatkul AS kode ,vkm.hari,vkm.jam_masuk,vkm.jam_keluar,pn.kjur,vkm.idkelas  FROM v_kelas_mhs vkm INNER JOIN krsmatkul km ON vkm.idkrsmatkul=km.idkrsmatkul
                            INNER JOIN krs kr ON km.idkrs=kr.idkrs INNER JOIN register_mahasiswa rm ON kr.nim=rm.nim
                            INNER JOIN formulir_pendaftaran fp ON rm.no_formulir=fp.no_formulir
                            INNER JOIN penyelenggaraan pn ON vkm.idpenyelenggaraan=pn.idpenyelenggaraan
                            INNER JOIN matakuliah mkul ON pn.kmatkul=mkul.kmatkul INNER JOIN ruangkelas rk ON vkm.idruangkelas=rk.idruangkelas
                            INNER JOIN penyelenggaraan p ON p.idpenyelenggaraan=vkm.idpenyelenggaraan
                            WHERE pn.tahun ='$tahun' AND kr.idsmt='$semester' AND vkm.iddosen ='$iddosen'
                            GROUP BY mkul.kmatkul,mkul.nmatkul,vkm.idkelas
                            ORDER BY vkm.hari ASC";

        $query_jadwal_dosen = $this->db2->query($sql_jadwal_dosen);
        return $query_jadwal_dosen;
    }

    public function get_mahasiswa($idpenyelenggaraan, $id_kelas)
    {
        $sql_mahasiswa = "SELECT * FROM v_kelas_mhs vkm
                INNER JOIN krsmatkul km ON vkm.idkrsmatkul=km.idkrsmatkul
                INNER JOIN krs kr ON km.idkrs=kr.idkrs
                INNER JOIN register_mahasiswa rm ON kr.nim=rm.nim
                INNER JOIN formulir_pendaftaran fp ON rm.no_formulir=fp.no_formulir
                INNER JOIN penyelenggaraan pn ON  vkm.idpenyelenggaraan=pn.idpenyelenggaraan
                INNER JOIN matakuliah mkul ON pn.kmatkul=mkul.kmatkul
                WHERE
                vkm.idpenyelenggaraan='$idpenyelenggaraan' and vkm.idkelas='$id_kelas' order by fp.nama_mhs asc";

        $query_mahasiswa = $this->db2->query($sql_mahasiswa);
        return $query_mahasiswa;
    }

    public function get_detil_mahasiswa($idpenyelenggaraan, $id_kelas)
    {
        $sql_mahasiswa = "SELECT * FROM v_kelas_mhs vkm
                INNER JOIN krsmatkul km ON vkm.idkrsmatkul=km.idkrsmatkul
                INNER JOIN krs kr ON km.idkrs=kr.idkrs
                INNER JOIN register_mahasiswa rm ON kr.nim=rm.nim
                INNER JOIN formulir_pendaftaran fp ON rm.no_formulir=fp.no_formulir
                INNER JOIN penyelenggaraan pn ON  vkm.idpenyelenggaraan=pn.idpenyelenggaraan
                INNER JOIN matakuliah mkul ON pn.kmatkul=mkul.kmatkul
                WHERE
                vkm.idpenyelenggaraan='$idpenyelenggaraan' and vkm.idkelas='$id_kelas' group by vkm.idkelas order by fp.nama_mhs asc";
        $query_mahasiswa = $this->db2->query($sql_mahasiswa);
        return $query_mahasiswa;
    }

    public function get_tampil_mahasiswa($idpenyelenggaraan, $kelompok, $idkelas)
    {
        $sql_mahasiswa = "SELECT * FROM v_kelas_mhs vkm
                INNER JOIN krsmatkul km ON vkm.idkrsmatkul=km.idkrsmatkul
                INNER JOIN krs kr ON km.idkrs=kr.idkrs
                INNER JOIN register_mahasiswa rm ON kr.nim=rm.nim
                INNER JOIN formulir_pendaftaran fp ON rm.no_formulir=fp.no_formulir
                INNER JOIN penyelenggaraan pn ON  vkm.idpenyelenggaraan=pn.idpenyelenggaraan
                INNER JOIN matakuliah mkul ON pn.kmatkul=mkul.kmatkul
                WHERE
                vkm.idpenyelenggaraan='$idpenyelenggaraan' and vkm.nama_kelas='$kelompok' and vkm.idkelas='$idkelas' order by fp.nama_mhs asc";
        $query_mahasiswa = $this->db2->query($sql_mahasiswa);
        return $query_mahasiswa;
    }

    public function get_tampil_nama_mahasiswa($nim)
    {
        $data = $this->db2->select('nim, nama_mhs,tempat_lahir,tanggal_lahir,tanggal_lahir,jk,alamat_rumah,tlp_hp,email,kjur')->get('v_datamhs');
        if ($data->num_rows()) {
            $insert = $this->db->insert('master_mhs', $data->result_array());
        }
    }

    public function get_data_kehadiran($idkehadiran)
    {
        $this->db->select('*');
        $this->db->from('sia_kehadiran');
        $this->db->join('master_mhs', 'master_mhs.nim = sia_kehadiran.nim');
        $this->db->where(array('sia_kehadiran.id_kehadiran_master' => $idkehadiran));
        $this->db->order_by("nama_mhs", "asc");
        $query_kehadiran = $this->db->get();
        return $query_kehadiran->result();
    }

    public function get_jam_ngajar($idpenyelenggaraan, $kelompok, $idkelas)
    {
        $sql_jam_ngajar = "SELECT distinct vkm.jam_masuk,vkm.jam_keluar FROM v_kelas_mhs vkm
                INNER JOIN krsmatkul km ON vkm.idkrsmatkul=km.idkrsmatkul
                INNER JOIN krs kr ON km.idkrs=kr.idkrs
                INNER JOIN register_mahasiswa rm ON kr.nim=rm.nim
                INNER JOIN formulir_pendaftaran fp ON rm.no_formulir=fp.no_formulir
                INNER JOIN penyelenggaraan pn ON  vkm.idpenyelenggaraan=pn.idpenyelenggaraan
                INNER JOIN matakuliah mkul ON pn.kmatkul=mkul.kmatkul
                WHERE
                vkm.idpenyelenggaraan='$idpenyelenggaraan' and vkm.nama_kelas='$kelompok' and vkm.idkelas='$idkelas'";
        $query_jam_ngajar = $this->db2->query($sql_jam_ngajar)->row();
        return $query_jam_ngajar;
    }

    public static function get_prodi($kode)
    {
        if ($kode == '12') {
            return 'TEKNIK INFORMATIKA';
        } elseif ($kode == '32') {
            return 'SISTEM INFORMASI';
        } elseif ($kode == '42') {
            return 'KOMPUTER AKUNTANSI';
        }
    }

    public static function get_kelas($kode)
    {
        if ($kode == 'A') {
            return 'REGULER (S1)';
        } elseif ($kode == 'B') {
            return 'KARYAWAN (S1)';
        } elseif ($kode == 'C') {
            return 'EKSEKUTIF (S1)';
        } elseif ($kode == 'D') {
            return 'TG. UBAN (S-1)';
        }
    }

    public function simpan_kehadiran($data)
    {
        $this->db = $this->load->database();
        return $this->db->insert('sia_kehadiran', $data);
    }

    public function simpan_pertemuan_master($data)
    {
        return $this->db->insert('sia_kehadiran_master', $data);
    }

    public function get_kehadiran_master($idpenyelenggaraan, $nama_kelompok, $idkelas)
    {
        $query = $this->db->get_where('sia_kehadiran_master', array(
            'idpenyelenggaraan' => $idpenyelenggaraan,
            'nama_kelas' => $nama_kelompok,
            'idkelas' => $idkelas,
        ));
        return $query;
    }

    public function edit($id)
    {
        $this->db->select('*');
        $this->db->from('sia_kehadiran join master_mhs on sia_kehadiran.nim=master_mhs.nim');
        $this->db->where(array('id' => $id));
        $result = $this->db->get();
        return $result;
    }

    function cari_data($query)
    {
        $str = $this->session->userdata('pertemuanke');
        $id = explode("-", $str);
        $pertemuanke= $id[1];
        $this->db->select("*,sia_kehadiran.id as id");
        $this->db->from('sia_kehadiran');
        $this->db->join('master_mhs', 'master_mhs.nim = sia_kehadiran.nim');
        $this->db->join('sia_kehadiran_master', 'sia_kehadiran_master.id = sia_kehadiran.id_kehadiran_master');
        $this->db->where('id_kehadiran_master', $this->session->userdata('hidden_id'));
        $this->db->where('pertemuan', $pertemuanke);
        $this->db->like('master_mhs.nama_mhs', $query);
        $this->db->order_by('master_mhs.nama_mhs', 'ASC');
        return $this->db->get()->result();
    }

    static function get_day($date){
        if(is_null($date)){
            $day="";
        }else{
            $timestamp = strtotime($date);
            $day = date('D', $timestamp);
        }
        return $day;
    }
}
