<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function check_log_in($table, $where)
    {
        $get = $this->db->get_where($table, $where);
        return $get;
    }

    public function get_data_siswa($table, $title1, $sort1 = 'ASC', $title2=NULL, $sort2=NULL)
    {
        $this->db->order_by($title1, $sort1);
        $this->db->order_by($title2, $sort2);
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

	public function get_edit_siswa($table, $username)
	{
		return $this->db->get_where($table, $username);
	}

    public function profileupdate($table, $data, $id=NULL)
    {
        return $this->db->update($table, $data, $id);
	}

    public function delete($table, $columnid, $valueid)
    {
        $this->db->where($columnid, $valueid);
        $this->db->delete($table);

        return true;
	}

}
