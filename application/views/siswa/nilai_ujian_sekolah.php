<?php
$this->load->view('template/head');
?>

    <!--tambahkan custom css disini-->

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h5>
            <ol class="breadcrumb">
                <li><?php echo anchor('c_Siswa/', '<i class="fa fa-home"></i> Home'); ?></li>
                <li class="active"><?php echo ucfirst($this->uri->segment(2)); ?></li>
            </ol>
            <small></small>
        </h5>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Nilai Ujian Praktikum</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-responsive table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class='text-center'>No</th>
                        <th class='text-center'>Nilai Pilihan Ganda</th>
                        <th class='text-center'>Nilai Essay</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $where = "nisn_siswa='1234567890' AND type_test='pg' OR type_test='essay'";
                    $this->db->where($where);
                    $get_db = $this->db->get('nilai');

//                    echo "<pre>";
//                    echo print_r($get_db->result());
//                    echo "</pre>";
//                    die();
                    if ($get_db->num_rows() > 0) {
                        $no = 1;
                        foreach ($get_db as $nilai) {
                            echo "<tr>";
                            echo "<td class='text-center'>" . $no++ . "</td>";
                            echo "<td>" . strtoupper($nilai->nama_sub_kompetensi) . "</td>";
                            echo "<td class='text-center'>" . $nilai->nilai . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="box-body text-right">
                <a href="#">
                    <button class="btn btn-dropbox"><i class="fa fa-print"></i> Cetak</button>
                </a>
            </div>
        </div>
    </section>

<?php
$this->load->view('template/js');
?>

    <!--tambahkan custom js disini-->

<?php
$this->load->view('template/foot');
?>