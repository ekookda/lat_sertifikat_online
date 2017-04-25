<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('fpdf181/fpdf'));
    }

    public function certificate()
    {
		$this->load->model('M_admin');
		$nisn = $this->session->userdata('nisn');
        $query = $this->M_admin->get_all_data('*', 'nilai', 'siswa', 'nilai.nisn_siswa=siswa.nisn', 'nilai.nisn_siswa', $nisn);
		$qry = $query->result();

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
        # Mengambil nomor absen untuk sertifikat
		foreach ($qry as $v);
		$nomor = substr($v->username, -4, 3);
        $pdf->Cell(0, 10, 'NOMOR : ' . $nomor . '/101.2/SMK.P.WK/JU/IV/' . date('Y'), '', '', 'C');

        # text 'pernyataan'
        $pdf->Ln(10);
        $pdf->SetFont('', '', 14);
        $text = 'Kepala SMK Pangeran Wijayakusuma, Jakarta Utara dengan ini menerangkan bahwa :';
        $pdf->Cell(0, 10, $text, 0, 0, 'L');

        # table
        $pdf->Ln(10);
        $pdf->SetLeftMargin(45);

        if ( $query->num_rows() > 0 ) {
            foreach ( $query->result() as $v ) {
                $pdf->Cell(50, 7, 'Nama Lengkap');
                $pdf->Cell(5, 7, ':');
                $pdf->Cell(100, 7, ucwords(strtolower($v->nama_lengkap)));
                $pdf->Ln();
                $pdf->Cell(50, 7, 'Tempat, Tgl Lahir');
                $pdf->Cell(5, 7, ':');
                $pdf->Cell(100, 7, ucfirst(strtolower($v->tempat_lahir)) . ', ' . date('d F Y', strtotime($v->tgl_lahir)));
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
        $pdf->Cell(60, 7, '', 0, '', 'L');
        $pdf->Cell(25, 7, '', 0, 'L');
        $pdf->Cell(45, 40, 'Pas Photo', 1, '', 'C');
        $pdf->Cell(25, 7, '', 0, '', 'L');
        $pdf->Cell(60, 7, 'Kepala SMK', 0, 'L');
        $pdf->Ln(0);
        # body
        $pdf->Cell(60, 22, '', 0, '', 'L');
        $pdf->Cell(25, 7);
        $pdf->Cell(25, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(55, 22, 'Pangeran Wijayakusuma', 0, '', 'C');
        $pdf->Ln(21);
        # footer
        $pdf->Cell(60, 28, '', 0, '', 'L');
        $pdf->Cell(25, 7);
        $pdf->Cell(25, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(60, 28, 'Riyanto, S.Pd', 0, '', 'L');

        # lembar belakang
        $pdf->AddPage();
        $pdf->SetLeftMargin(25);
        $pdf->SetRightMargin(25);
        $pdf->Ln(20);

        # Heading 'DAFTAR NILAI'
        $pdf->SetFont('Arial', 'U', 36);
        $pdf->Cell(0, 10, 'DAFTAR NILAI', 0, '', 'C');
        $pdf->Ln(25);

        # Data Siswa
        $pdf->SetLeftMargin(85);
        $pdf->SetFont('Arial', '', 14);
        if ( $query->num_rows() > 0 ) {
            foreach ( $query->result() as $v ) {
                $pdf->Cell(50, 7, 'Nama Lengkap');
                $pdf->Cell(5, 7, ':');
                $pdf->Cell(100, 7, ucwords(strtolower($v->nama_lengkap)));
                $pdf->Ln();
                $pdf->Cell(50, 7, 'Tempat, Tgl Lahir');
                $pdf->Cell(5, 7, ':');
                $pdf->Cell(100, 7, ucfirst(strtolower($v->tempat_lahir)) . ', ' . date('d F Y', strtotime($v->tgl_lahir)));
                $pdf->Ln();
                $pdf->Cell(50, 7, 'Nomor Peserta Ujian');
                $pdf->Cell(5, 7, ':');
                $pdf->Cell(100, 7, $v->username);;
            }
        }
        $pdf->SetLeftMargin(73);
        $pdf->Ln(20);

        # Daftar Nilai
        if ( $query->num_rows() > 0 ) {
            $no = 1;
            $pdf->Cell(15, 10, 'No.', 1, '', 'C');
            $pdf->Cell(80, 10, 'Materi Uji', 1, '', 'C');
            $pdf->Cell(50, 10, 'Nilai', 1, '', 'C');
            $pdf->Ln();
            foreach ( $query->result() as $v ) {
                $pdf->Cell(15, 8, $no++, 1, '', 'C');
                $pdf->Cell(80, 8, 'Microsoft Word', 1, '', 'L');
                $pdf->Cell(50, 8, $v->word, 1, '', 'C');
                $pdf->Ln();
                $pdf->Cell(15, 8, $no++, 1, '', 'C');
                $pdf->Cell(80, 8, 'Microsoft Excel', 1, '', 'L');
                $pdf->Cell(50, 8, $v->excel, 1, '', 'C');
                $pdf->Ln();
                $pdf->Cell(15, 8, $no++, 1, '', 'C');
                $pdf->Cell(80, 8, 'Microsoft PowerPoint', 1, '', 'L');
                $pdf->Cell(50, 8, $v->word, 1, '', 'C');
                $pdf->Ln();
                $pdf->Cell(15, 8, $no++, 1, '', 'C');
                $pdf->Cell(80, 8, 'Microsoft Access', 1, '', 'L');
                $pdf->Cell(50, 8, $v->word, 1, '', 'C');
                $pdf->Ln();
            }
        }

        #
        # tandatangan kepala sekolah dan penguji
        $pdf->SetLeftMargin(35);
        $pdf->Ln(15);
        # header
        $pdf->Cell(60, 7, '', 0, '', 'L');
        $pdf->Cell(25, 7, '', 0, 'L');
        $pdf->Cell(45, 40, '', 0, '', 'C');
        $pdf->Cell(25, 7, '', 0, '', 'L');
        $pdf->Cell(60, 7, 'Jakarta, ' . date('d F Y'), 0, 'L');
        $pdf->Ln(0);
        # body
        $pdf->Cell(60, 22, '', 0, '', 'L');
        $pdf->Cell(25, 7);
        $pdf->Cell(25, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(50, 22, 'Penguji', 0, '', 'L');
        $pdf->Ln(21);
        # footer
        $pdf->Cell(60, 28, '', 0, '', 'L');
        $pdf->Cell(25, 7);
        $pdf->Cell(25, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(23, 7);
        $pdf->Cell(60, 28, 'Eko Okdasatyagama', 0, '', 'L');

        $data['v_output'] = $pdf->Output();
    }
}
