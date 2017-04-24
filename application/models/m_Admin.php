<?php defined('BASEPATH') OR exit('No direct script access allowed');

class m_Admin extends CI_Model
{
    public function check_log_in($table, $where)
    {
        $get = $this->db->get_where($table, $where);
        return $get;
    }

    public function get_data_siswa($table, $title, $sort)
    {
        $this->db->order_by($title, $sort);
        return $this->db->get($table);
    }

    public function get_nilai_praktikum($select, $dbFrom, $dbJoin, $onJoin)
    {
        $this->db->select($select);
        $this->db->from($dbFrom);
        $this->db->join($dbJoin, $onJoin);
        return $this->db->get();
    }

    public function get_all_data($select, $dbFrom, $dbJoin, $onJoin, $field, $where)
    {
        $this->db->select($select);
        $this->db->from($dbFrom);
        $this->db->join($dbJoin, $onJoin);
        $this->db->where($field, $where);

        return $this->db->get();
    }

}