<?php defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        $this->is_logged_in();
    }

    public function is_logged_in()
    {
        // cek session logged_in true or false ?
        $check_logged_in = $this->session->userdata('logged_in');
        $sess_admin = $this->session->userdata('akses');
        if ( $check_logged_in == false || $sess_admin != 'admin' || $sess_admin == 'siswa') {
            $this->session->sess_destroy();
            redirect('Welcome');
        }
    }

    public function set_index()
    {
        $this->load->view('dashboard2');
    }

    public function data_siswa()
    {
        $get_data ['data_siswa'] = $this->M_admin->get_data_siswa('siswa', 'nama_lengkap', 'ASC');
        $this->load->view('admin/data_siswa', $get_data);
    }

    public function praktikum()
    {
        $query = $this->M_admin->get_nilai_praktikum('*', 'nilai', 'siswa', 'nilai.nisn_siswa=siswa.nisn');

        $data['data'] = $query;
        $this->load->view('admin/nilai-praktikum', $data);
    }

}
