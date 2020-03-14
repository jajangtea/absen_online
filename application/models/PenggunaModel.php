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
        $this->db->select('*');
        $this->db->from('sia_user');
        $this->db->order_by('username');
        return $this->db->get();
      //return $this->db->get('sia_user');
    }

    // public function getrata2()
    // {
    //     $this->db->select_avg('umur');
    //     $q = $this->db->get('pengguna');
    //     return $q->row()->umur;
    // }

    // public function get_total_umur()
    // {
    //     $this->db->select_sum('umur');
    //     $q = $this->db->get('pengguna');
    //     return $q->row()->umur;
    // }

    // public function tambah($data)
    // {
    //     $this->db->insert('pengguna', $data);
    //     return ($this->db->affected_rows() > 0) ? true : false;
    // }

    public function hapus($id)
    {
        $this->db->delete('sia_user', array('id' => $id));
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function view($id)
    {
        $this->db->select('*');
        $this->db->from('sia_user');
        $this->db->where(array('id' => $id));

        return $this->db->get();

    }

}
