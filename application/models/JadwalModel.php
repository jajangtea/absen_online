<?php

defined('BASEPATH') or exit('No direct script access allowed');

class JadwalModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('db_simak', true);
    }

    function get_jadwal($tahun, $idsmt, $hari, $kjur, $kelas)
    {
        $sql = "SELECT * FROM kelas_mhs svk
        INNER JOIN pengampu_penyelenggaraan spp ON svk.idpengampu_penyelenggaraan=spp.idpengampu_penyelenggaraan
        INNER JOIN penyelenggaraan sp ON spp.idpenyelenggaraan=sp.idpenyelenggaraan
        INNER JOIN matakuliah mk ON sp.kmatkul=mk.kmatkul
        INNER JOIN program_studi sps ON sp.kjur=sps.kjur
        INNER JOIN ruangkelas rk ON svk.idruangkelas=rk.idruangkelas
        WHERE sp.tahun='$tahun' AND sp.idsmt='$idsmt' AND svk.hari='$hari' AND sp.kjur='$kjur' AND svk.idkelas='$kelas'";
        return $this->db2->query($sql)->result();
    }

    function get_prodi()
    {
        $this->db2->select('kjur,CONCAT( nama_ps, " ", konsentrasi) AS nama_prodi ');
        $this->db2->order_by('nama_prodi');
        return $this->db2->get('program_studi')->result_array();
    }

    function get_kelas()
    {
        $this->db2->select('idkelas,nkelas');
        $this->db2->order_by('idkelas');
        return $this->db2->get('kelas')->result_array();
    }

    public static function kelas_huruf($angka)
    {
        $huruf='';
        if ($angka == 1) {
            $huruf = "A";
        }elseif($angka==2){
            $huruf = "B";
        }elseif($angka==3){
            $huruf = "C";
        }
        return $huruf;
    }
}

/* End of file JadwalModel.php */
