<?php if (!defined('BASEPATH')) {
    exit('tidak bisa diakses secara langsung');
}

class PenggunaModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function tampilSemua()
    {

        // $this->db->select('*');
        // $this->db->from('pengguna');
        // $this->db->order_by('nama','ASC');
        //return $this->db->get();

       // $query = $this->db->query("select * from pengguna order by nama asc");
        return $this->db->get('pengguna');
    }

    public function getrata2(){
        $this->db->select_avg('umur');
        $q=$this->db->get('pengguna');
        return $q->row()->umur;
    }

    public function get_total_umur(){
        $this->db->select_sum('umur');
        $q=$this->db->get('pengguna');
        return $q->row()->umur;
    }

    public function tambah($data)
    {
        $this->db->insert('pengguna', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function hapus($id)
    {
        $this->db->delete('pengguna', array('id' => $id));
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function view($id)
    {
        $this->db->select('*');
        $this->db->from('pengguna');
        $this->db->where(array('id' => $id));

        return $this->db->get();

    }

}
