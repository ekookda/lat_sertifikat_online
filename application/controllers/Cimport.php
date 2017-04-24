<?php if (!defined('BASEPATH')) exit ("no direct script access allowed");

class Cimport extends CI_controller
{

    public function import_data()
    {
        $this->load->model('Msaham');
        $this->load->library('Csv2sql');
        $csv = new Csv2sql("./uploads / data . csv", ",", "nilai_saham");
        $query = $csv->Export();

        $this->Msaham->eksekusi($query);
    }

}