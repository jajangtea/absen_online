<?php

class KehadiranModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function get_kehadiran($kode)
    {
        if ($kode == 'A') {
            return 'ALFA';
        } elseif ($kode == 'S') {
            return 'SAKIT';
        } elseif ($kode == 'I') {
            return 'IZIN';
        } elseif ($kode == 'H') {
            return 'HADIR';
        }
    }

    function update_absen($id, $absen, $keterangan, $rangkuman)
    {
        $sql = "UPDATE sia_kehadiran SET absen='" . $absen . "',keterangan='" . $keterangan . "',rangkuman='" . $rangkuman . "' WHERE id='" . $id . "'";
        $hasil = $this->db->query($sql);
        return $hasil;
    }

    function update_status_absen($status, $id)
    {
        $sql = "UPDATE sia_kehadiran_master SET status='" . $status . "',tanggal=curdate() WHERE id='" . $id . "'";
        $hasil = $this->db->query($sql);
        return $hasil;
    }

    function cek_status_absen($status, $id)
    {
        $this->db->where("status='" . $status . "' and id='" . $id . "'");
        return $this->db->count_all_results('sia_kehadiran_master');
    }

    function cek_status_absen_mahasiswa($id_kehadiran_master, $nim)
    {
        $this->db->where("id_kehadiran_master='" . $id_kehadiran_master . "' and tgl_absen > 0 and nim='$nim'");
        return $this->db->count_all_results('sia_kehadiran');
    }
}
