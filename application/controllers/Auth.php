<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // panggil model Admin
        $this->load->model('m_Admin');
        $this->load->library('session');
    }

    public function login()
    {
        $this->load->library('form_validation');

        // rules validation
        $rules = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[6]'
            ),
            array(
                'field' => 'akses',
                'label' => 'Akses',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($rules);

        if ( $this->form_validation->run() == false ) {
            // gagal validasi
            $this->load->view('login_form');
        } else {
            // lolos validasi, ambil value input
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $akses = $this->input->post('akses');

            $where = array( 'username' => $username );

            if ( $akses == 'admin' ) {
                $data = $this->m_Admin->check_log_in('admin', $where);
            } elseif ( $akses == 'siswa' ) {
                $data = $this->m_Admin->check_log_in('siswa', $where);
            } else {
                $data = $this->m_Admin->check_log_in('sma', $where);
            }

            if ( $data->num_rows() > 0 ):
                $get = $data->result_array();

                foreach ( $get as $v ) {
                    $name = $v['nama_lengkap'];
                    $pass = $v['password'];
                    $nisn = $v['nisn'];
                }

                $cek_password = password_verify($password, $pass);

                if ( $cek_password ) {
                    // password cocok, buat session
                    $sess_data = array(
                        'nama_lengkap' => $name,
                        'nisn' => $nisn,
                        'username' => $username,
                        'akses' => $akses,
                        'logged_in' => true
                    );

                    $this->session->set_userdata($sess_data);

                    if ( $akses == 'admin' ) {
                        redirect('C_admin/set_index');
                    } elseif ( $akses == 'siswa' ) {
                        redirect('C_siswa/');
                    } else {
                        redirect('SMA/beranda');
                    }
                } else {
                    // password tidak cocok
                    $this->session->set_flashdata('messageError', 'Password yang anda masukkan salah');
                    $this->load->view('login_form');
                }
            else:
                // username tidak cocok
                $this->session->set_flashdata('messageError', 'Maaf, username anda belum terdaftar');
                $this->load->view('login_form');
            endif;
        }
    }

}
