<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Input Trip Ojek Online</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>assets/bootstrap-4.4.1-dist/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/datepicker/dist/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
    $(function()
    {
      $('#tgl').datepicker({autoclose: true,todayHighlight: true,format: 'yyyy-mm-dd'})
      // $('#tgl_akhir').datepicker({autoclose: true,todayHighlight: true,format: 'yyyy-mm-dd'})
    });
    </script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include("sidebar.php"); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
              <?php if($this->session->jabatan == 'owner' || $this->session->jabatan == 'manager'){?> 
                <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata("nama"); ?></span></a>
                 <?php } else {?>
                <a class="nav-link dropdown-toggle" href="<?php blink('Dashboard/login')?>" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">LogIn</span></a>
                <?php }?>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php blink('Dashboard/logOut')?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

         <!-- Begin Page Content -->
         <div class="container-fluid">

        <!-- Page Heading -->

        <!-- Data -->
        <div class="card shadow mb-4">
  
            <div class="card-body">
            <h3 style="color:green;text-align:center;">INPUT DATA TRIP OJEK</h3><br/>
             <form class="user" action="<?php blink('input/inputTripOjek')?>" enctype="multipart/form-data" method="post">
                <div class="form-group">
                <label>Nama Karyawan</label>
                <select class="form-control" id="" name="karyawan">
                  <?php if($dataKaryawan == null) { ?>
                      <option value="">-</option>
                        <?php } else { ?>
                            <?php foreach($dataKaryawan as $data){ ?>
                              <option value="<?php echo $data->kd_karyawan; ?>"><?php echo $data->nama; ?></option>
                            <?php } ?>  
                        <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                <label>Titik Keberangkatan</label>
                  <input type="text" name="start" autocomplete="off" class="form-control" id="" placeholder="Titik Awal" required>
                </div>
                <div class="form-group">
                <label>Tujuan</label>
                  <input type="text" name="tujuan" autocomplete="off" class="form-control" id="" placeholder="Titik Akhir" required>
                </div>
                <div class="form-group">
                <label>Tanggal Perjalanan</label>
                  <input type="date" name="tgl" autocomplete="off" class="form-control" required>
                </div>
                <label>Biaya Yang Dikeluarkan</label><br/>
                <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text" id="btnGroupAddon">Rp</div>
                </div>
                  <input type="number" min="0" autocomplete="off" class="form-control" name="harga" placeholder="" aria-label="Input group example" aria-describedby="btnGroupAddon" requred>
                </div> <br/>
                <div class="form-group">
                <label>Foto Bukti Transaksi</label>
                 <input type="file" class="form-control-file" name="photo" required accept="image/png, image/jpeg, image/gif" id="imgInp">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Simpan Data Trip Ojek
                </button>
              </form>
            </div>

         </div>

        <!-- /.container-fluid -->
        </div>
          
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
