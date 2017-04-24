<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Excel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
        $this->load->helper('file');
    }

    public function index_()
    {
        $this->load->view('admin/data_siswa');
    }

    public function upload()
    {
        $fileName = time() . $_FILES['file']['name'];

        $config['upload_path'] = './uploads/'; //buat folder dengan nama uploads di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file'))
            $this->upload->display_errors();

        $media = $this->upload->data('file');
        $inputFileName = $this->upload->data('full_path');

        try {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 2; $row <= $highestRow; $row++) { //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            //Sesuaikan sama nama kolom tabel di database
            $data = array(
                // "id" => $rowData[0][0],
                'username' => $rowData[0][0],
                'nisn' => $rowData[0][1],
                'nama_lengkap' => $rowData[0][2],
                'password' => password_hash($rowData[0][3], PASSWORD_DEFAULT),
                'tempat_lahir' => $rowData[0][4],
                'tgl_lahir' => date('Y-m-d', strtotime($rowData[0][5]))
            );

            //sesuaikan nama dengan nama tabel
            $insert = $this->db->insert('siswa', $data);
            delete_files($this->upload->data('full_path'));
        }

        redirect('c_Admin/data_siswa');
    }

}