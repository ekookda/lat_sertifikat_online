<?php defined('BASEPATH') OR exit('No direct script access allowed');

class c_Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_Admin');
        $this->is_logged_in();
    }

    public function is_logged_in()
    {
        // cek session logged_in true or false ?
        $check_logged_in = $this->session->has_userdata('logged_in');
        if (!$check_logged_in)
            redirect('Welcome');
    }

    public function set_index()
    {
        $this->load->view('dashboard2');
    }

    public function data_siswa()
    {
        $get_data ['data_siswa'] = $this->m_Admin->get_data_siswa('siswa');
        $this->load->view('admin/data_siswa', $get_data);
    }

    public function set_import_file()
    {
		
    }

	public function certified()
	{
		$this->load->library('fpdf181/fpdf');
		$pdf = new FPDF('L', 'cm', 'Letter');
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Write(12, 'Hello World! Hello World! Hello World!');
		$data['v_output'] = $pdf->Output();
	}

}
