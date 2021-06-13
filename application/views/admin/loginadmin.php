<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panenpangan Login Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/dist/css/AdminLTE.min.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/dist/css/skins/_all-skins.min.css')?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/bower_components/morris.js/morris.css')?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css')?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css')?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')?>">

  <!--PLUGINS-->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/iCheck/flat/blue.css')?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/morris/morris.css')?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/daterangepicker/daterangepicker.css')?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/datepicker/datepicker3.css')?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')?>">
  <!-- Datatables -->
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css')?>">
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.css')?>">
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/datatables/jquery.dataTables.css')?>">
  <link rel="stylesheet" href="<?php blink('/assets/AdminLTE/plugins/datatables/jquery.dataTables.min.css')?>">
  <!--END PLUGINS-->


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background: #595959">

<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
      <a href="<?php blink('Home') ?>">
        <img src="<?php blink('assets/img/img/panen.png')?>" alt="User Image" width="35%"><br>
      </a>
    </div>
    <hr>
    <p class="login-box-msg"><b>Silahkan login sebagai Admin</p>
    <form action="<?php echo site_url('Login/auth') ?>" method="POST">

    <input type="hidden" name="id_admin">
    <!-- /.INPUTAN ID -->
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
    <!-- END INPUTAN ID -->

    <!-- INPUTAN PASSWORD -->
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
    <!-- END INPUTAN PASSWORD -->
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <button type="submit" class="btn btn-success btn-block btn-flat"><i class="fa fa-sign-in"></i> Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php blink('/assets/AdminLTE/bower_components/jquery/dist/jquery.min.js')?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php blink('/assets/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php blink('/assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- Morris.js charts -->
<script src="<?php blink('/assets/AdminLTE/bower_components/raphael/raphael.min.js')?>"></script>
<script src="<?php blink('/assets/AdminLTE/bower_components/morris.js/morris.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?php blink('/assets/AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')?>"></script>
<!-- jvectormap -->
<script src="<?php blink('/assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="<?php blink('/assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php blink('/assets/AdminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js')?>"></script>
<!-- daterangepicker -->
<script src="<?php blink('/assets/AdminLTE/bower_components/moment/min/moment.min.js')?>"></script>
<script src="<?php blink('/assets/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js')?>"></script>
<!-- datepicker -->
<script src="<?php blink('/assets/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php blink('/assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
<!-- Slimscroll -->
<script src="<?php blink('/assets/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<!-- FastClick -->
<script src="<?php blink('/assets/AdminLTE/bower_components/fastclick/lib/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php blink('/assets/AdminLTE/dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php blink('/assets/AdminLTE/dist/js/pages/dashboard.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php blink('/assets/AdminLTE/dist/js/demo.js')?>"></script>

<!--script PLUGINS-->
<script src="<?php blink('/assets/AdminLTE/bootstrap/js/bootstrap.min.js')?>"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js')?>"></script>
<script src="<?php blink('/assets/AdminLTE/plugins/morris/morris.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?php blink('/assets/AdminLTE/plugins/sparkline/jquery.sparkline.min.js')?>"></script>
<!-- jvectormap -->
<script src="<?php blink('/assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php blink('/assets/AdminLTE/plugins/knob/jquery.knob.js')?>"></script>
<!-- daterangepicker -->
<script src="<?php blink('/assets/https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js')?>"></script>
<script src="<?php blink('/assets/AdminLTE/plugins/daterangepicker/daterangepicker.js')?>"></script>
<!-- datepicker -->
<script src="<?php blink('/assets/AdminLTE/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php blink('/assets/dminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
<!-- Slimscroll -->
<script src="<?php blink('/assets/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
<!-- FastClick -->
<script src="<?php blink('/assets/AdminLTE/plugins/fastclick/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php blink('/assets/AdminLTE/dist/js/app.min.js')?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php blink('/assets/AdminLTE/dist/js/pages/dashboard.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php blink('/assets/AdminLTE/dist/js/demo.js')?>"></script>
<!-- DataTables JavaScript -->
<script src="<?php blink('/assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php blink('/assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<!-- Select2 -->
<script src="<?php blink('/assets/AdminLTE/plugins/select2/select2.full.min.js')?>"></script>
<!--END script PLUGINS-->
</body>
</html>
