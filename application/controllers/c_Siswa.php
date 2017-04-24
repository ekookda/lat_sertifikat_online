<?php defined('BASEPATH') OR exit('No direct script access allowed');

class c_Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_Siswa');
        $this->is_logged_in();
    }

    public function is_logged_in()
    {
        // cek session logged_in true or false ?
        $check_logged_in = $this->session->has_userdata('logged_in');
        if (!$check_logged_in)
            redirect('Welcome');
    }

    public function index()
    {
        $this->load->view('dashboard2');
    }

    public function praktikum()
    {
        $nisn = $this->session->userdata('nisn');
        $where = array(
            'nisn_siswa'=> $nisn,
            'mapel_id'  => 1,
            'type_test' => 'praktik'
        );
        $get_nilai = ['main_mapel' => $this->m_Siswa->get_nilai('nilai', $where)];

        $this->load->view('siswa/nilai_praktikum', $get_nilai);
    }

    public function ujian_sekolah()
    {
        $this->load->view('siswa/nilai_ujian_sekolah');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Welcome');
    }

}