<?php
$this->load->helper('form');

echo doctype('html5');
echo "<html>";
echo "<head>";

// meta
echo meta('description', 'Aplikasi Tabungan Siswa');
echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
echo meta('X-UA-Compatible', 'IE=edge');
echo meta('keywords', 'tabungan, siswa');
// <!-- Tell the browser to be responsive to screen width -->
echo meta('', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport');

echo "<title>Form Login</title>";

// link_tag
echo link_tag('assets/font-awesome-4.3.0/css/font-awesome.css', 'stylesheet', 'text/css');
echo link_tag('assets/ionicons.min.css', 'stylesheet', 'text/css');
echo link_tag('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css', 'stylesheet', 'text/css');
echo link_tag('assets/bootstrap/css/square-iCheck-blue.css', 'stylesheet', 'text/css');
echo link_tag('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css', 'stylesheet', 'text/css');
echo link_tag('assets/parsley.css', 'stylesheet', 'text/css');
?>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<?php
echo "</head>";
echo "<body class='hold-transition login-page'>";

// Form Login
echo "<div class='login-box'>";
echo "<div class='login-logo'>";
echo anchor('#', '<b>Aplikasi</b> Nilai LTE');
echo "</div>";
echo "<p style='color: #000;font-weight: 400;text-align: center;'><i>\"Belajarlah, karena tidak ada manusia yang dilahirkan dalam keadaan cerdas.\" ~ Imam Syafi'i</i></p>";

// login-logo
echo "<div class=\"login-box-body\" style='background-color: #fcfcfc;'>";
echo heading('<i class="fa fa-user-circle-o"></i> Login', '1', array( 'class' => 'login-box-msg' ));

// form login
echo form_open('auth/login', array( 'id' => 'formLogin', 'data-parsley-validate' => '' ));

if ( $this->session->flashdata('messageError') ) {
    echo "<div class='alert alert-danger'>";
    echo '<i class="fa fa-info-circle"></i> ' . $this->session->flashdata('messageError');
    echo "</div>";
}

if ( $this->session->flashdata('msg') ) {
    echo "<div class='alert alert-danger'>";
    echo '<i class="fa fa-info-circle"></i> ' . $this->session->flashdata('msg');
    echo "</div>";
}

echo "<div class=\"form-group has-feedback\">";
echo form_input('username', set_value('username'), array( 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'nomor peserta ujian', 'required' => '' ));
echo "<span class=\"fa fa-user form-control-feedback\"></span>";
echo "<span class='text-danger'>" . form_error('username') . "</span>";
echo "</div>";

echo "<div class=\"form-group has-feedback\">";
echo form_password('password', '', array( 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'password', 'required' => '' ));
echo "<span class=\"fa fa-lock form-control-feedback\"></span>";
echo "<span class='text-danger'>" . form_error('password') . "</span>";
echo "</div>";

echo "<div class=\"form-group has-feedback\">";
$options = array( '' => '-- Login sebagai --', 'admin' => 'Administrator', 'siswa' => 'Siswa SMK', 'sma' => 'Siswa SMA' );
echo form_dropdown('akses', $options, '', array( 'id' => 'akses', 'class' => 'form-control', 'required' => '' ));
echo "<span class='text-danger'>" . form_error('login_as') . "</span>";
echo "</div>";

echo "<div class=\"row\">";
echo "<div class=\"col-xs-8\">";
//echo "<p>Mau tau pengumuman kelululusan SMA ? " . anchor('Pengumuman/', '<span class="label label-danger">klik disini</span>', 'style="text-decoration:none"') . "</p>";
echo "</div>"; // .col-xs-8

// .col
echo "<div class=\"col-offset-xs-8 col-xs-4\">";
echo form_button(array( 'type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat', 'name' => 'btn-login', 'id' => 'btn-login', 'content' => '<i class="fa fa-sign-in"></i> Sign In' ));
echo "</div>"; // .col-xs-4
echo "</div>"; // .row
echo form_close();

echo "</div>"; // .login-box-body
echo heading('Copyright <i class="fa fa-copyright"></i> ' . Date("Y") . ' Made By <span>Eko Alfarisi</span>', 6, array( 'class' => 'text-center' ));
echo "</div>"; // .login-box
?>

<script type="text/javascript" src="<?= base_url(); ?>assets/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/jquery-validation/dist/parsley.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/AdminLTE-2.0.5/bootstrap/js/iCheck.min.js"></script>
<script>
    $(function () {
        $('#formLogin').parsley().on('field:validated', function () {
            var ok = $('.parsley-error').length === 0;
        })
            .on('form:submit', function () {
                return true;
            });
    });

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>

</body>
</html>