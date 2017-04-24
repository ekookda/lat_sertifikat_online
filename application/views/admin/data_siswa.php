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
                <h3 class="box-title">Data Peserta Ujian</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-error"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('success') == TRUE): ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                <?php endif; ?>
                <table id="example1" class="table table-responsive table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class='text-center'>No</th>
                        <th class='text-center'>NISN</th>
                        <th class='text-center'>Username Peserta</th>
                        <th class='text-center'>Nama Peserta Ujian</th>
                        <th class='text-center'>Tempat Tanggal Lahir</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($data_siswa->num_rows() > 0) {
                        $no = 1;
                        foreach ($data_siswa->result() as $data) {
                            echo "<tr>";
                            echo "<td class='text-center'>" . $no++ . "</td>";
                            echo "<td class='text-center'>" . strtoupper($data->nisn) . "</td>";
                            echo "<td class='text-center'>" . strtoupper($data->username) . "</td>";
                            echo "<td>" . strtoupper($data->nama_lengkap) . "</td>";
                            echo "<td class='text-center'>" . ucfirst(strtolower($data->tempat_lahir)) . ", " . date('d F Y', strtotime($data->tgl_lahir)) . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="box-body">
                <?php
                $this->load->helper('form');
                echo form_open_multipart('Excel/upload');
                ?>
                <div class="row">
                    <div class="col-sm-3">
                        <?php
                        echo form_input(array('type' => 'file', 'name' => 'file', 'class' => 'form-control', 'value' => 'Upload'));
                        echo form_button(array('type' => 'submit', 'name' => 'submit', 'content' => '<i class="fa fa-upload"></i> Import File', 'class' => 'btn btn-danger import', 'style' => 'margin-top:5px'));
                        ?>
                    </div>
                </div>
                <?php echo form_close(); ?>
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