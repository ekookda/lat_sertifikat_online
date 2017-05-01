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
<style>
    body {
        text-align: center;
        background-image: url("http://img.friv5games.me/2016/11/06/school-computer-backgrounds-l-ac748e41a12a6214.jpg");
        font-family: sans-serif;
        font-weight: 100;
    }

    /*h1 {*/
        /*color: #396;*/
        /*font-weight: 100;*/
        /*font-size: 40px;*/
        /*margin: 40px 0px 20px;*/
    /*}*/

    /*#clockdiv {*/
        /*font-family: sans-serif;*/
        /*color: #fff;*/
        /*display: inline-block;*/
        /*font-weight: 100;*/
        /*text-align: center;*/
        /*font-size: 30px;*/
    /*}*/

    /*#clockdiv > div {*/
        /*padding: 10px;*/
        /*border-radius: 3px;*/
        /*background: #00BF96;*/
        /*display: inline-block;*/
    /*}*/

    /*#clockdiv div > span {*/
        /*padding: 15px;*/
        /*border-radius: 3px;*/
        /*background: #00816A;*/
        /*display: inline-block;*/
    /*}*/

    /*.smalltext {*/
        /*padding-top: 5px;*/
        /*font-size: 16px;*/
    /*}*/
</style>
<?php
echo "</head>";
echo "<body>";
?>
<div class="container-fluid">
    <div class="alert alert-danger text-center">
        <h1 id="getting-started"></h1>
    </div>
</div>

<!--<h1>Countdown Clock</h1>-->
<!--<div id="clockdiv">-->
<!--    <div>-->
<!--        <span class="days"></span>-->
<!--        <div class="smalltext">Days</div>-->
<!--    </div>-->
<!--    <div>-->
<!--        <span class="hours"></span>-->
<!--        <div class="smalltext">Hours</div>-->
<!--    </div>-->
<!--    <div>-->
<!--        <span class="minutes"></span>-->
<!--        <div class="smalltext">Minutes</div>-->
<!--    </div>-->
<!--    <div>-->
<!--        <span class="seconds"></span>-->
<!--        <div class="smalltext">Seconds</div>-->
<!--    </div>-->
<!--</div>-->

<!-- javascript -->
<script src="<?= base_url() . 'assets/jquery/jquery.min.js'; ?>"></script>
<script src="<?= base_url() . 'assets/jquery-countdown/jquery.countdown.min.js'; ?>"></script>
<script type="text/javascript">
    $("#getting-started").countdown("2017/05/02 10:00:00", {elapse: true})
        .on('update.countdown', function (event) {
            if (event.elapsed) {
                window.location.href = "<?= site_url('Welcome'); ?>";
            } else {
                $(this).text(event.strftime('%H jam %M Menit %S Detik Lagi Menuju Waktu Pengumuman Kelulusan'));
            }
        });
</script>
<!--<script>-->
<!--    function getTimeRemaining(endtime) {-->
<!--        var t = Date.parse(endtime) - Date.parse(new Date());-->
<!--        var seconds = Math.floor((t / 1000) % 60);-->
<!--        var minutes = Math.floor((t / 1000 / 60) % 60);-->
<!--        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);-->
<!--        var days = Math.floor(t / (1000 * 60 * 60 * 24));-->
<!--        return {-->
<!--            'total': t,-->
<!--            'days': days,-->
<!--            'hours': hours,-->
<!--            'minutes': minutes,-->
<!--            'seconds': seconds-->
<!--        };-->
<!--    }-->
<!---->
<!--    function initializeClock(id, endtime) {-->
<!--        var clock = document.getElementById(id);-->
<!--        var daysSpan = clock.querySelector('.days');-->
<!--        var hoursSpan = clock.querySelector('.hours');-->
<!--        var minutesSpan = clock.querySelector('.minutes');-->
<!--        var secondsSpan = clock.querySelector('.seconds');-->
<!---->
<!--        function updateClock() {-->
<!--            var t = getTimeRemaining(endtime);-->
<!---->
<!--            daysSpan.innerHTML = t.days;-->
<!--            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);-->
<!--            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);-->
<!--            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);-->
<!---->
<!--            if (t.total <= 0) {-->
<!--                clearInterval(timeinterval);-->
<!--            }-->
<!--        }-->
<!---->
<!--        updateClock();-->
<!--        var timeinterval = setInterval(updateClock, 1000);-->
<!--    }-->
<!---->
<!--    //    var deadline = new Date(Date.parse(new Date()) + 1 * 12 * 60 * 60 * 1000);-->
<!--    var deadline = new Date('2017/05/02 00:00:00');-->
<!--    initializeClock('clockdiv', deadline);-->
<!--</script>-->
</body>
</html>