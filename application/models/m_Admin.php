<?php defined('BASEPATH') OR exit('No direct script access allowed');

class m_Admin extends CI_Model
{
    public function check_log_in($table, $where)
    {
        $get = $this->db->get_where($table, $where);
        return $get;
    }

    public function get_data_siswa($table)
    {
        return $this->db->get($table);
    }

    public function get_nilai_praktikum()
    {
        return $this->db->get('nilai');
    }

}