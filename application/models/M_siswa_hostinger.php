<?php defined('BASEPATH') OR exit('No direct script access allowed');

class m_Siswa extends CI_Model
{
    public function get_nilai($table, $where)
    {
        $get = $this->db->get_where($table, $where);
        return $get;
    }

}