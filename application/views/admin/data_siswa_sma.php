<?php
$this->load->helper('form');
$this->load->view('template/head');
?>

<!--tambahkan custom css disini-->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

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

        <div class="box-body">
            <?php if ( isset($error) ) : ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ( $this->session->flashdata('success') == true ) : ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <legend><span class="fa fa-info-circle"></span>&nbsp;Download/Upload Data</legend>
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    $filename = 'peserta_sma.csv';
                    echo anchor(base_url() . 'uploads/' . $filename, '<span class="fa fa-download"></span> Download Contoh Data', array( 'class' => 'btn btn-primary' ));
                    ?>
                </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-5 text-right">
                    <?php
                    $uri_segment = $this->uri->segment(1);
                    echo form_open_multipart('Excel/upload/' . $uri_segment, array( 'class' => 'form-inline' ));
                    echo "<div class='form-group'>";
                    echo form_input(array( 'type' => 'file', 'name' => 'file', 'class' => 'form-control', 'value' => 'Upload', 'required' => 'required' ));

                    echo form_button(array( 'type' => 'submit', 'name' => 'submit', 'content' => '<i class="fa fa-upload"></i> Upload Data', 'class' => 'btn btn-danger import', 'style' => 'margin-top:5px' ));
                    echo "</div>";
                    echo form_close();
                    ?>
                </div>
            </div>
            <hr>
            <!-- box-header -->
            <div class="box-header">
                <legend class="text-primary" style="text-decoration:underline; border-bottom:none">Data Peserta Ujian
                </legend>
            </div>
            <!-- /.box-header -->
            <table id="myTable" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
                    <th class='text-center'>No</th>
                    <th class='text-center'>Username Peserta</th>
                    <th class='text-center'>Nama Peserta Ujian</th>
                    <th class='text-center'>Jurusan</th>
                    <th class='text-center'>Mata Uji Pilihan</th>
                    <th class='text-center'>Grade</th>
                    <th class='text-center'>Pembayaran SPP</th>
                    <th class='text-center'>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ( $data_siswa_sma->num_rows() > 0 ) {
                    $no = 1;
                    foreach ( $data_siswa_sma->result() as $data ) {
                        $hasil = $data->hasil;
                        $pembspp = $data->spp;

                        if ( $hasil == 1 ) {
                            $result = '<span class="label label-success">Lulus</span>';
                        } else {
                            $result = '<span class="label label-danger">Tidak Lulus</span>';
                        }

                        if ( $pembspp == 1 ) {
                            $byr_spp = '<span class="label label-success">Lunas</span>';
                        } else {
                            $byr_spp = '<span class="label label-warning">Belum Lunas</span>';
                        }

                        echo "<tr>";
                        echo "<td class='text-center'>" . $no++ . "</td>";
                        echo "<td class='text-center'>" . anchor('C_admin/editprofile/' . $data->username, strtoupper($data->username)) . "</td>";
                        echo "<td>" . strtoupper($data->nama_lengkap) . "</td>";
                        echo "<td class='text-center'>" . strtoupper($data->jurusan) . "</td>";
                        echo "<td class='text-center'>" . ucfirst($data->mata_uji_pilihan) . "</td>";
                        // keterangan grade
                        echo "<td class='text-center'>" . form_label($result, 'grade', array( 'class' => 'label-control' )) . "</td>";
                        // keterangan spp
                        echo "<td class='text-center'>" . form_label($byr_spp, 'spp', array( 'class' => 'label-control' )) . "</td>";
                        echo "<td class='text-center text-danger'>" . anchor('C_admin/delete/' . $data->username, '<button class="btn btn-danger"><span class="fa fa-trash"></span></button>') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'><h2>" . heading('Tidak ada data', 2, 'class="text-center text-info"') . "</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    echo anchor('C_admin/drop', form_button(array( 'type' => 'button', 'id' => 'buttondrop', 'name' => 'btn-drop', 'class' => 'btn btn-danger popconfirm_full', 'content' => '<span class="fa fa-trash-o"></span> Hapus Semua Data', 'data-toggle' => 'confirmation' )));
    ?>
</section>

<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/js/popconfirm.js'; ?>"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
        $('#buttondrop').click(function () {
            alert('Data akan dihapus ?');
            window.location.href = "<?= site_url('C_admin/drop'); ?>";
        });
        $("[data-toggle='confirmation']").popConfirm({
            title: "Yakin",
            content: "Apakah anda yakin ingin menghapus semua data siswa ?"
        });
    });
</script>

<?php
$this->load->view('template/foot');
?>
