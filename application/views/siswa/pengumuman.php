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
            <h3 class="box-title"><i class="fa fa-info-circle "></i> Pengumuman Kelulusan SMA Wijayakusuma 2017</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php
            echo heading('Berdasarkan hasil Ujian Nasional dan rapat musyawarah dewan guru, maka dengan ini memutuskan bahwa siswa/i kami :', '3', array( 'class' => 'text-left' ));
            if ( isset($data) ) {
                echo "<table id=\"example1\" class=\"table table-responsive table-striped\">";
                foreach ( $data->result() as $row ) {

                    if ( $row->spp == 0 ) {
                        echo "<tr><td colspan='3'>" . heading('Untuk segera melunasi administrasi.', 3, 'class="text-center text-danger"') . "</td></tr>";
                    } else {

                        $hasil = $row->hasil;
                        if ( $hasil == 1 ) {
                            $value = '<span class="label label-success">LULUS</span>';
                        } else {
                            $value = '<span class="label label-danger">TIDAK LULUS</span>';
                        }
                        ?>
                        <tbody>
                        <tr>
                            <td style="width: 400px" class="text-right">Nama Peserta</td>
                            <td style="width: 10px">:</td>
                            <th><?= ucwords(strtolower($row->nama_lengkap)); ?></th>
                        </tr>
                        <tr>
                            <td class="text-right">Nomor Peserta Ujian</td>
                            <td>:</td>
                            <th><?= $row->username; ?></th>
                        </tr>
                        <tr>
                            <td class="text-right">Jurusan</td>
                            <td>:</td>
                            <th><?= strtoupper($row->jurusan); ?></th>
                        </tr>
                        <tr>
                            <td class="text-right">Mata Ujian Pilihan</td>
                            <td>:</td>
                            <th><?= ucwords($row->mata_uji_pilihan); ?></th>
                        </tr>
                        <tr>
                            <td class="text-right">Dinyatakan</td>
                            <td>:</td>
                            <th><?= heading($value, 4); ?></th>
                        </tr>
                        </tbody>
                        <?php
                    }
                }
                echo "</table>";
            }
            ?>
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
