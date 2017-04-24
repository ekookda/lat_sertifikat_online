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
        $get_nilai = [ 'main_mapel' => $this->m_Siswa->get_nilai('nilai', $where) ];

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

    public function certificate()
    {
        $this->load->library('fpdf181/fpdf');
        $pdf = new FPDF('L', 'mm', 'Letter');
        $pdf->AddPage();

        # add background-image
        $pdf->Image(base_url() . '/assets/AdminLTE-2.0.5/dist/img/certificate.jpg', 0, 0, 280, 215);

        # membuat garis
        $pdf->SetLineWidth(0.5);
        $pdf->Line(30, 58, 250, 58);
        $pdf->SetLineWidth(0.8);
        $pdf->Line(30, 59, 250, 59);

        $pdf->SetLeftMargin(25);
        $pdf->SetRightMargin(25);

        # Heading 'SERTIFIKAT'
        $pdf->Ln(54);
        $pdf->SetFont('Arial', 'U', 36);
        $pdf->Cell(0, 10, 'SERTIFIKAT KOMPUTER', 0, '', 'C');

        # subheading 'NOMOR'
        $pdf->Ln(10);
        $pdf->SetFont('', '', 14);
        $pdf->Cell(0, 10, 'NOMOR : 2017/05/0018', '', '', 'C');

        # text 'pernyataan'
        $pdf->Ln(10);
        $pdf->SetFont('', '', 14);
        $text = 'Kepala SMK Pangeran Wijayakusuma, Jakarta Utara dengan ini menerangkan bahwa :';
        $pdf->Cell(0, 10, $text, 0, 0, 'L');

        # table
        $pdf->Ln(10);
        $pdf->SetLeftMargin(45);
        $nisn = $this->session->userdata('nisn');
        $this->load->model('m_Admin');
        $query = $this->m_Admin->get_all_data('*', 'nilai', 'siswa', 'nilai.nisn_siswa=siswa.nisn', 'nilai.nisn_siswa', $nisn);

        if ( $query->num_rows() > 0 ) {
            foreach ( $query->result() as $v ) {
                $pdf->Cell(50, 7, 'Nama Lengkap');
                $pdf->Cell(5, 7, ':');
                $pdf->Cell(100, 7, $v->nama_lengkap);
                $pdf->Ln();
                $pdf->Cell(50, 7, 'Tempat, Tgl Lahir');
                $pdf->Cell(5, 7, ':');
                $pdf->Cell(100, 7, $v->tempat_lahir . ', ' . date('d F Y', strtotime($v->tgl_lahir)));
                $pdf->Ln();
                $pdf->Cell(50, 7, 'Nomor Peserta Ujian');
                $pdf->Cell(5, 7, ':');
                $pdf->Cell(100, 7, $v->username);
                $total_nilai = ( $v->word + $v->excel + $v->powerpoint + $v->access ) / 4;
            }
        }

        $grade = '';
        if ( $total_nilai < 80 ) {
            $grade = 'Cukup';
        } elseif ( $total_nilai >= 80 && $total_nilai < 88 ) {
            $grade = 'Baik';
        } elseif ( $total_nilai >= 88 && $total_nilai <= 100 ) {
            $grade = 'Sangat Baik';
        }

        $pdf->SetLeftMargin(25);
        $pdf->Ln(10);
        $text = 'Dinyatakan telah selesai mengikuti pendidikan komputer tingkat dasar program "Microsoft Office 2010" di SMK Pangeran Wijayakusuma dengan hasil "' . $grade . '" dengan nilai kompetensi tercantum dibalik sertifikat ini.';
        $pdf->MultiCell(0, 8, $text, 0, 'J');

        # tandatangan kepala sekolah dan penguji
        $pdf->SetLeftMargin(35);
        $pdf->Ln(4);
        # header
        $pdf->Cell(60, 7, 'Kepala SMK', 0, '', 'L');
        $pdf->Cell(25, 7, '', 0, 'L');
        $pdf->Cell(45, 40, 'Pas Photo', 1, '', 'C');
        $pdf->Cell(25, 7, '', 0, '', 'L');
        $pdf->Cell(60, 7, 'Jakarta, ' . date('d F Y'), 0, 'L');
        $pdf->Ln(0);
        # body
        $pdf->Cell(60, 22, 'Pangeran Wijayakusuma', 0, '', 'L');
        $pdf->Cell(25, 7);
        $pdf->Cell(25, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(50, 22, 'Penguji', 0, '', 'C');
        $pdf->Ln(21);
        # footer
        $pdf->Cell(60, 28, 'Riyanto, S.Pd', 0, '', 'L');
        $pdf->Cell(25, 7);
        $pdf->Cell(25, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(60, 28, 'Eko Okdasatyagama', 0, '', 'L');

        # lembar belakang
        $pdf->AddPage();

        $data['v_output'] = $pdf->Output();
    }

}