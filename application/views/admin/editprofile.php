<?php
$this->load->helper('form');
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
    <div class="box box-primary">

        <!-- box-header -->
        <div class="box-header">
            <legend class="text-primary">Update Peserta Ujian</legend>
        </div>
        <!-- /.box-header -->

        <!-- box-body -->
        <div class="box-body">
            <?php if ( isset($error) ) : ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ( $this->session->flashdata('success') == true ) : ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                <?php
            endif;

            if ( isset($datasiswa) ):
                if ( $datasiswa->num_rows() == true ) {
                    # form start
                    echo form_open('C_admin/updatevalidation/', array( 'class' => '', 'role' => 'form' ));
                    foreach ( $datasiswa->result() as $row ):
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Nomor Peserta Ujian', '', array( 'for' => 'username', 'class' => 'label-control' ));
                                        echo form_input('input_username', $row->username, array( 'disabled'=>'disabled', 'class' => 'form-control', 'placeholder' => 'Nomor Peserta Ujian' ));
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Nama Peserta', '', array( 'for' => 'namaPeserta', 'class' => 'label-control' ));
                                        echo form_input('input_namaLengkap', $row->nama_lengkap, array( 'class' => 'form-control', 'placeholder' => 'Nama Peserta Ujian' ));
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Jurusan', '', array( 'for' => 'jurusan', 'class' => 'label-control' ));
                                        $options = array( 'ipa' => 'IPA', 'ips' => 'IPS' );
                                        if ( $row->jurusan == 'ipa' ) $selected = 'ipa';
                                        else $selected = 'ips';
                                        echo form_dropdown('select_jurusan', $options, $selected, array( 'class' => 'form-control' ));
                                        ?>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Mata Ujian Pilihan', '', array( 'for' => 'ujipilihan', 'class' => 'label-control' ));
                                        $options = array( 'biologi' => 'Biologi', 'fisika' => 'Fisika', 'kimia' => 'Kimia', 'ekonomi' => 'Ekonomi', 'geografi' => 'Geografi', 'sosiologi' => 'Sosiologi' );
                                        $ujian = $row->mata_uji_pilihan;
                                        $select = '';
                                        switch ($ujian):
                                            case 'Biologi';
                                                $select = 'biologi';
                                                break;
                                            case 'Fisika';
                                                $select = 'fisika';
                                                break;
                                            case 'Kimia';
                                                $select = 'kimia';
                                                break;
                                            case 'Ekonomi';
                                                $select = 'ekonomi';
                                                break;
                                            case 'Geografi';
                                                $select = 'geografi';
                                                break;
                                            case 'Sosiologi';
                                                $select = 'sosiologi';
                                                break;
                                        endswitch;
                                        echo form_dropdown('select_ujian', $options, $select, array( 'class' => 'form-control' ));
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Kelulusan', '', array( 'for' => 'kelulusan', 'class' => 'label-control' ));
                                        $options = array( 0 => 'Tidak Lulus', 1 => 'Lulus' );
                                        if ( $row->hasil == true ) $selected = true;
                                        else $selected = 0;
                                        echo form_dropdown('select_kelulusan', $options, $selected, array( 'class' => 'form-control' ));
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Pelunasan SPP', '', array( 'for' => 'spp', 'class' => 'label-control' ));
                                        $options = array( 0 => 'Belum Lunas', 1 => 'Lunas' );
                                        if ( $row->spp == true ) $pilih = true;
                                        else $pilih = 0;
                                        echo form_dropdown('select_spp', $options, $pilih, array( 'class' => 'form-control' ));
                                        ?>
                                    </div>
                                </div>
                            </div><!-- /.col-md-6 -->
                        </div><!-- /.row -->
                        <div class="box-footer text-right">
                            <?php
                            echo form_hidden('h_username', $row->username);
                            echo form_button(array( 'name' => 'btn-update', 'class' => 'btn btn-primary', 'type' => 'submit', 'content' => '<span class="fa fa-edit"></span> Update' ));
                            ?>
                        </div>
                        <?php
                    endforeach;
                    echo form_close();
                } // num_rows()
            endif;
            ?>

        </div>
        <!-- ./box-body -->
    </div>
</section>

<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->

<?php
$this->load->view('template/foot');
?>
