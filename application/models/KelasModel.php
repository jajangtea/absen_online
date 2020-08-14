<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class KelasModel extends CI_Model
{
    public $message = "";
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('db_simak', true);
    }
    public function get_kelas($tahun, $smt)
    {
        $sql = "SELECT *,kk.nama_kelas as aturan,vk.nama_kelas AS pilihan FROM krsmatkul krsm 
INNER JOIN v_kelas_mhs vk ON krsm.idkrsmatkul=vk.idkrsmatkul
INNER JOIN krs krs ON krs.idkrs=krsm.idkrs
INNER JOIN penyelenggaraan p ON p.idpenyelenggaraan=vk.idpenyelenggaraan
INNER JOIN matakuliah mkul ON mkul.kmatkul=p.kmatkul
INNER JOIN register_mahasiswa rm ON rm.nim=krs.nim
INNER JOIN formulir_pendaftaran fp ON fp.no_formulir=rm.no_formulir
INNER JOIN kelompok_kelas kk ON kk.nim=krs.nim
WHERE krs.tahun='$tahun' AND krs.idsmt='$smt' AND kk.nama_kelas <> vk.nama_kelas
ORDER BY kk.nim ASC";

        $query_kelas = $this->db2->query($sql);
        return $query_kelas->result();
    }

    public function get_kelas_cari($tahun, $smt, $idkelas, $kjur, $nim)
    {
        $sql = "SELECT *,kk.nama_kelas as aturan,vk.nama_kelas AS pilihan FROM krsmatkul krsm 
INNER JOIN v_kelas_mhs vk ON krsm.idkrsmatkul=vk.idkrsmatkul
INNER JOIN krs krs ON krs.idkrs=krsm.idkrs
INNER JOIN penyelenggaraan p ON p.idpenyelenggaraan=vk.idpenyelenggaraan
INNER JOIN matakuliah mkul ON mkul.kmatkul=p.kmatkul
INNER JOIN register_mahasiswa rm ON rm.nim=krs.nim
INNER JOIN formulir_pendaftaran fp ON fp.no_formulir=rm.no_formulir
INNER JOIN kelompok_kelas kk ON kk.nim=krs.nim
WHERE krs.tahun='$tahun' AND krs.idsmt='$smt' AND kk.nama_kelas <> vk.nama_kelas 
AND vk.idkelas='$idkelas' AND p.kjur='$kjur' AND fp.nama_mhs like '%$nim%'
ORDER BY kk.nim ASC";

        $query_kelas = $this->db2->query($sql);
        return $query_kelas->result();
    }

    public function get_kelas_cari_mhs($tahun, $smt, $nim)
    {
        $sql = "SELECT *,kk.nama_kelas as aturan,vk.nama_kelas AS pilihan FROM krsmatkul krsm 
INNER JOIN v_kelas_mhs vk ON krsm.idkrsmatkul=vk.idkrsmatkul
INNER JOIN krs krs ON krs.idkrs=krsm.idkrs
INNER JOIN penyelenggaraan p ON p.idpenyelenggaraan=vk.idpenyelenggaraan
INNER JOIN matakuliah mkul ON mkul.kmatkul=p.kmatkul
INNER JOIN register_mahasiswa rm ON rm.nim=krs.nim
INNER JOIN formulir_pendaftaran fp ON fp.no_formulir=rm.no_formulir
INNER JOIN kelompok_kelas kk ON kk.nim=krs.nim
WHERE krs.tahun='$tahun' AND krs.idsmt='$smt' AND kk.nama_kelas <> vk.nama_kelas 
AND fp.nama_mhs like '%$nim%'
ORDER BY kk.nim ASC";

        $query_kelas = $this->db2->query($sql);
        return $query_kelas->result();
    }

    function getUsers($tahun, $smt)
    {

        // Fetch users
        $this->db2->select('*');
        $this->db2->from('krs');
        $this->db2->join('register_mahasiswa', 'register_mahasiswa.nim = krs.nim', 'inner');
        $this->db2->join('formulir_pendaftaran', 'formulir_pendaftaran.no_formulir = register_mahasiswa.no_formulir', 'inner');
        $this->db2->where(array('krs.tahun' => $tahun, 'krs.idsmt' => $smt));
        $fetched_records = $this->db2->get();



        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        $no = 1;
        foreach ($users as $user) {

            $data[] = array("name" => $user['nama_mhs'], "index" => $no++, "id" => $user['nim']);
        }
        return $data;
    }
}
