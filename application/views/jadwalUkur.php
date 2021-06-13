<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Jadwal Ukur</title>

  <!-- Custom fonts for this template -->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
          <h3 style="color:green;text-align:center;">JADWAL UKUR</h3>
         
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3"><a href="<?php echo site_url('Laporan/cetakJU') ?>" class="btn btn-outline-info">Unduh Pdf</a>
              <a href="<?php blink('Dashboard/inputJadwalUkur')?>" class="btn btn-outline-success">Tambah Data Jadwal Ukur</a>
              &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
              &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
              <a href="<?php blink('input/hapusJadwalUkur')?>" class="btn btn-outline-danger">Hapus Semua Data</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode Jadwal Ukur</th>
                      <th>Nama Customer</th>
                      <th>Tanggal Ukur</th>
                      <th>Jam Ukur</th>
                      <th>Lokasi</th>
                      <th>No.Telpon Customer</th>
                      <th>Petugas Pengukur</th>
                      <th>Input Hasil Survey</th>
                      <th>Hapus</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Kode Jadwal Ukur</th>
                      <th>Nama Customer</th>
                      <th>Tanggal Ukur</th>
                      <th>Jam Ukur</th>
                      <th>Lokasi</th>
                      <th>No.Telpon Customer</th>
                      <th>Petugas Pengukur</th>
                      <th>Input Hasil Survey</th>
                      <th>Hapus</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php foreach($dataJadwalUkur as $data){?>
                    <tr>
                      <td><?php echo $data->kd_jadwal_ukur; ?></td>
                      <td><?php echo $data->nama_customer; ?></td>
                      <td><?php echo $data->tgl_ukur; ?></td>
                      <td><?php echo $data->jam_ukur; ?></td>
                      <td><?php echo $data->alamat_customer; ?></td>
                      <td><?php echo $data->no_tlp_customer; ?></td>
                      <td><?php echo $data->nama; ?></td>
                      <td><a href="#modalform<?php echo $data->kd_jadwal_ukur ?>" class="btn btn-primary" data-toggle="modal" role="button"><i class="fas fa-newspaper"></i></a></td>
                      <td><a href="<?php echo site_url('input/hapusKdJadwalUkur/'.$data->kd_jadwal_ukur) ?>"  class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    </tr>
                  <?php } ?> 
                  </tbody>
                </table>
              </div>
            </div>
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


  <?php foreach($dataJadwalUkur as $data){ ?> 
		<!-- modal hasil survey -->
				<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="modalform<?php echo $data->kd_jadwal_ukur ?>" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h5 id="myModalLabel">Input Hasil Survey</h5>
							</div>
							<div class="modal-body">
								<form method="POST" action="<?php blink('input/inputHasilSurvey');?>" enctype="multipart/form-data">
									 <table class="table table-striped" border="0">
									  <thead>
										<td width="10%" ></td>
									  <td width="10%"  ></td>
									  <td width="60%" ></td>
									</thead>
									<tbody>
									<div class="form-group">
                        <label>Kode Jadwal Ukur</label>
                        <input required class="form-control required text-capitalize" value="<?php echo $data->kd_jadwal_ukur ?>" readonly data-placement="top" data-trigger="manual" type="text" name="kdUkur">
                      </div>
										<tr>
										  <td>Barang</td>
										  <td>:</td>
										  <td ><input type="text" name="nmBarang" class="form-control" id="" placeholder="Nama Barang" required></td>
									  </tr>
                    <tr>
										  <td>Jumlah</td>
										  <td>:</td>
										  <td style="text-transform:capitalize;"><input type="number" name="qty" min="1" id="qty" class="quantity form-control" placeholder="Jumlah Barang" required></td>
										</tr>
										<tr>
										  <td>Ukuran</td>
										  <td>:</td>
										  <td style="text-transform:capitalize;"><input type="text" name="ukuran"  class="quantity form-control" placeholder="CM (PxLxT)" required></td>
										</tr>
										<tr>
										  <td>Harga Lokal</td>
										  <td>:</td>
										  <td style="text-transform:capitalize;"><input type="number" name="hargaLokal" min="1" id="hargaLokal" class="form-control" placeholder="Harga Satuan" required></td>
									  </tr>
										<tr>
										  <td>Harga Import</td>
										  <td>:</td>
										  <td style="text-transform:capitalize;"><input type="number" name="hargaImport" min="1" id="hargaImport" class="form-control" placeholder="Harga Satuan" required></td>
									  </tr>
									  </tbody>
									</table>
							  </div>
							  <div class="modal-footer">
						      	<button type="submit" class="btn btn-success" > Simpan Hasil Survey</button>
						      	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
									</form>
								</div>
						</div>
					</div>
				</div>
				<?php }?>
		<!-- end modal hasil survey -->

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url(); ?>assets/js/demo/datatables-demo.js"></script>

</body>

</html>
