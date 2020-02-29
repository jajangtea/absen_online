<?php

class KehadiranModel extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public static function get_kehadiran($kode){
        if($kode=='A'){
            return 'ALFA';
        }elseif($kode=='S'){
            return 'SAKIT';
        }elseif($kode=='I'){
            return 'IZIN';
        }elseif($kode=='H'){
            return 'HADIR';
        }
    }
}