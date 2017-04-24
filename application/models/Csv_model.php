<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Csv_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_siswa()
    {
        $query = $this->db->get('siswa');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function insert_csv($data)
    {
        $this->db->insert('siswa', $data);
    }

}
/*END OF FILE*/