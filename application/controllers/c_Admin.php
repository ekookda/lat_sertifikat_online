<?php defined('BASEPATH') or exit('No direct script access allowed');

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
        if ( $check_logged_in == false || $sess_admin != 'admin' || $sess_admin == 'siswa' ) {
            $this->session->sess_destroy();
            redirect('Welcome');
        }
    }

    public function index()
    {
        $this->set_index();
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

    public function editprofile($username)
    {
        $qry = $this->M_admin->get_edit_siswa('sma', array( 'username' => $username ), 1);

        $data['datasiswa'] = $qry;
        $this->load->view('admin/editprofile', $data);
    }

    public function updatevalidation()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('h_username', 'Username', 'trim|required|min_length[12]|max_length[12]');
        $this->form_validation->set_rules('input_namaLengkap', 'Name', 'trim|required');
        $this->form_validation->set_rules('select_jurusan', 'Jurusan ', 'trim|required');
        $this->form_validation->set_rules('select_ujian', 'Exam', 'trim|required');
        $this->form_validation->set_rules('select_kelulusan', 'Hasil', 'trim|required');
        $this->form_validation->set_rules('select_spp', 'SPP', 'trim|required');


        if ( $this->form_validation->run() == false ) {
            $username = $this->input->post('h_username');
            $this->editprofile($username);
        } else {
            $this->update();
        }
    }

    public function update()
    {
        $username = $this->input->post('h_username');
        $datapost = array(
            'username' => $this->input->post('h_username'),
            'nama_lengkap' => $this->input->post('input_namaLengkap'),
            'jurusan' => $this->input->post('select_jurusan'),
            'mata_uji_pilihan' => $this->input->post('select_ujian'),
            'hasil' => $this->input->post('select_kelulusan'),
            'spp' => $this->input->post('select_spp')
        );

        $kode = substr($username, '0', '1');

        $qry = $this->M_admin->profileupdate('sma', $datapost, array( 'username' => $username ));

        if ( $qry == true ) {
            if ( $kode == 'U' )
                redirect('SMA/datasiswa');
        }
    }

    public function delete()
    {
        $id = $this->uri->segment(3);

        $delete = $this->M_admin->delete('sma', 'username', $id);

        if ($delete == true)
            redirect('SMA/datasiswa');
    }

    public function drop()
    {
        $qry = $this->M_admin->delete_all('sma');

        if ($qry == true)
            redirect('SMA/datasiswa');
    }

    public function logout()
    {
        redirect('C_siswa/logout');
    }

}