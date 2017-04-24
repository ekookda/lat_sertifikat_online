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
                    <?php
                    if ($main_mapel->num_rows() > 0) {
                        $no = 1;
                       	$total_nilai = 0;
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th class='text-center' rowspan='2'>No</th>";
                        echo "<th class='text-center' colspan='4'>Daftar Nilai</th>";
                        echo "<th class='text-center' rowspan='2'>Total Nilai</th>";
                        echo "<th class='text-center' rowspan='2'>Rata-rata Nilai</th>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th class='text-center'>Microsoft Word</th>";
                        echo "<th class='text-center'>Microsoft Excel</th>";
                        echo "<th class='text-center'>Microsoft PowerPoint</th>";
                        echo "<th class='text-center'>Microsoft Access</th>";
                        echo "</tr>";
                        echo "</thead>";
						
                        echo "<tbody>";
                        foreach ($main_mapel->result() as $nilai) {
                            echo "<td class='text-center'>" . $no++ . "</td>";
                            echo "<td class='text-center'>" . strtoupper($nilai->word) . "</td>";
                            echo "<td class='text-center'>" . strtoupper($nilai->excel) . "</td>";
                            echo "<td class='text-center'>" . strtoupper($nilai->powerpoint) . "</td>";
                            echo "<td class='text-center'>" . strtoupper($nilai->access) . "</td>";
                            $total_nilai = ($nilai->word + $nilai->excel + $nilai->powerpoint + $nilai->access);
                        }
						echo "<td class='text-center'><strong>" . $total_nilai . "</strong></td>";
						$rata_nilai = $total_nilai/4;
						if ($rata_nilai > 75) {
							$span = "<span class='label label-success'>";
						} else {
							$span = "<span class='label label-danger'>";
						}
						echo "<td class='text-center'>". $span ."<strong>" . $rata_nilai . "</strong></span></td>";
						echo "</tr>";
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
