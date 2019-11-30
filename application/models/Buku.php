<?php

class Buku extends CI_Model{
    public function get_buku(){
        $this->db->select('*');
        $this->db->from('buku');
        return $this->db->get();
    }
}