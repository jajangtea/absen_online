<?php
class RegisterModel extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->db2=$this->load->database('db_simak',true);
    }
    public function get_dosen(){
        $this->db2->select('iddosen,nama_dosen');
        $this->db2->order_by('nama_dosen');
        return $this->db2->get('dosen')->result_array();
    }
}