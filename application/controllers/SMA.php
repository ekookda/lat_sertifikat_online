<?php defined('BASEPATH') or exit('No direct script access allowed');

class SMA extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        # cek session logged in
        $logged_in = $this->session->userdata('logged_in');
        if (!$logged_in) {
            redirect('Welcome');
        }

        # load model
        $this->load->model('M_admin');
    }

    public function beranda()
    {
        $data['title'] = 'Beranda';
        redirect('C_siswa');
    }

    public function pengumuman()
    {
        $where = array( 'username' => $this->session->userdata('username') );
        $get = $this->M_admin->check_log_in('sma', $where);

        $data['title'] = 'Pengumuman Kelulusan';
        $data['data'] = $get;

        $this->load->view('siswa/pengumuman', $data);
    }

    public function datasiswa()
    {
        $get_data ['data_siswa_sma'] = $this->M_admin->get_data_siswa('sma', 'username', 'ASC', 'jurusan', 'ASC');
        $this->load->view('admin/data_siswa_sma', $get_data);
    }

}
