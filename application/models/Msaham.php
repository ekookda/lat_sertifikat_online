<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Msaham extends CI_model
{

    public function __contruct()
    {
        parent::__construct();
    }

    public function eksekusi($sql)
    {
        for ($i = 0; $i < count($sql); $i++) {
            $this->db->query($sql[$i]);
        }
    }

}