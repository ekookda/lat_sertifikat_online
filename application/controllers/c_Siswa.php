<?php defined('BASEPATH') OR exit('No direct script access allowed');

class C_siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_siswa');
        $this->countdown();
    }

    public function countdown()
    {
        $this->load->helper('date');
        date_default_timezone_set('Asia/Jakarta');
        $waktu_sekarang = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
        $waktu_finished = mktime(22, 0, 0, date('m'), date('d'), date('Y'));

        $selisih = $waktu_finished - $waktu_sekarang;

        if ($selisih > 0) {
            if ( $_SESSION != NULL ) {
                // hapus session
                $this->session->sess_destroy();
                if ($_SESSION == NULL) {
                    $this->session->set_flashdata('msg', 'Maaf, web belum bisa diakses');
                }
                redirect('Welcome/waiting');
            }
        } else {
            $this->is_logged_in();
        }
    }

    public function is_logged_in()
    {
        // cek session logged_in true or false ?
        $check_logged_in = $this->session->has_userdata('logged_in');
        if ( !$check_logged_in )
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
            'nisn_siswa' => $nisn,
            'mapel_id' => 1,
            'type_test' => 'praktik'
        );
        $get_nilai = [ 'main_mapel' => $this->M_siswa->get_nilai('nilai', $where) ];

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
