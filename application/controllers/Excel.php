<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');

class Excel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array( 'PHPExcel', 'PHPExcel/IOFactory' ));
        $this->load->helper('file');
    }

    public function index_()
    {
        $this->load->view('admin/data_siswa');
    }

    public function upload($uri_segment = NULL)
    {
        $fileName = time() . $_FILES['file']['name'];

        $config['upload_path'] = './uploads/'; //buat folder dengan nama uploads di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ( !$this->upload->do_upload('file') )
            $this->upload->display_errors();

        $media = $this->upload->data('file');
        $inputFileName = $this->upload->data('full_path');

        try {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch ( Exception $e ) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ( $row = 2; $row <= $highestRow; $row++ ) { //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            if ( $uri_segment == 'C_admin' ) {

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

                $nilai = array(
                    'nisn_siswa' => $rowData[0][1],
                    'mapel_id' => 1,
                    'type_test' => 'praktik',
                    'word' => $rowData[0][6],
                    'excel' => $rowData[0][7],
                    'powerpoint' => $rowData[0][8],
                    'access' => $rowData[0][9]
                );

                //sesuaikan nama dengan nama tabel
                $this->db->insert('siswa', $data);
                $this->db->insert('nilai', $nilai);

                $redirect = $uri_segment . "/data_siswa";
            } elseif ( $uri_segment == 'SMA' ) {
                $data = array(
                    'username' => $rowData[0][1],
                    'nama_lengkap' => $rowData[0][2],
                    'password' => password_hash($rowData[0][3], PASSWORD_DEFAULT),
                    'jurusan' => $rowData[0][4],
                    'mata_uji_pilihan' => $rowData[0][5],
                    'hasil' => $rowData[0][6],
                    'spp' => $rowData[0][7]
                );

                $this->db->insert('sma', $data);
                $redirect = $uri_segment . "/datasiswa";
            }

            delete_files($this->upload->data('full_path'));
        }

        redirect($redirect);
    }

}
