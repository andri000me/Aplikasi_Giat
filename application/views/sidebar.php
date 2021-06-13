    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php blink('Dashboard')?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Aplikasi GIAT</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php blink('Dashboard')?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <?php if($this->session->jabatan !='owner' && $this->session->jabatan != 'manager'){
        echo "";
        } else {
          ?>
      <!-- Divider -->
      <hr class="sidebar-divider">
     
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link" href="<?php blink('Dashboard/jadwalKerja')?>">
            <i class="far fa-calendar-alt"></i>
            <span>Jadwal Kerja</span></a>
        </li>
      <?php }?>
      <?php if($this->session->jabatan !='owner' && $this->session->jabatan != 'manager'){
        echo "";
        } else {
          ?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link" href="<?php blink('Dashboard/jadwalUkur')?>">
            <i class="far fa-calendar-alt"></i>
            <span>Jadwal Ukur</span></a>
        </li>
        <?php }?>
        <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
        echo "";
        } else {
          ?>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="<?php blink('Dashboard/tableAbsen')?>">
            <i class="fas fa-calendar-day"></i>
            <span>Daftar Absensi</span></a>
        </li>
        <?php }?>

        <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
        echo "";
        } else {
          ?>
        <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Input Data
      </div>
      <?php }?>

      <!-- Nav Item - Charts -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="<?php blink('Dashboard/inputKaryawan')?>">
          <i class="fas fa-clipboard-list"></i>
          <span>Karyawan</span></a>
      </li> -->
      <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
        echo "";
        } else {
          ?>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php blink('Dashboard/inputCustomer')?>">
          <i class="fas fa-edit"></i>
          <span>Customer</span></a>
      </li>
      <?php }?>
      <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
        echo "";
        } else {
          ?>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php blink('Dashboard/inputBarang')?>">
          <i class="fas fa-edit"></i>
          <span>Barang</span></a>
      </li>
      <?php }?>
      <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
        echo "";
        } else {
          ?>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php blink('Dashboard/inputJadwalKerja')?>">
          <i class="fas fa-edit"></i>
          <span>Jadwal Kerja Karyawan</span></a>
      </li>
      <?php }?>
      <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
        echo "";
        } else {
          ?>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php blink('Dashboard/inputJadwalUkur')?>">
          <i class="fas fa-edit"></i>
          <span>Jadwal Ukur</span></a>
      </li>
      <?php }?>
      <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
        echo "";
        } else {
          ?>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php blink('Dashboard/inputPenjualan')?>">
          <i class="fas fa-edit"></i>
          <span>Penjualan Barang</span></a>
      </li>
      <?php }?>
      <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
        echo "";
        } else {
          ?>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php blink('Dashboard/inputTripOjek')?>">
          <i class="fas fa-edit"></i>
          <span>Trip Ojek</span></a>
      </li>
      <?php }?>
        
      <?php if($this->session->jabatan !="owner"){
        echo "";
        } else {
          ?>
        <!-- Divider -->
        <hr class="sidebar-divider">  
       
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#approve" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-file-alt"></i>
            <span>Approve</span>
          </a>
          <div id="approve" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Approve:</h6>
              <a class="collapse-item" href="<?php blink('Dashboard/approveHasilSurvey')?>">Hasil Survey</a>
            </div>
          </div>
        </li>
        <?php }?>
      
        <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
              echo "";
              } else {
                ?>
       <!-- Divider -->
       <hr class="sidebar-divider">  
       <?php }?>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
      <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
              echo "";
              } else {
                ?>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-file-alt"></i>
          <span>Laporan</span>
        </a>
        <?php }?>
        <div id="laporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Laporan:</h6>
            <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
              echo "";
              } else {
                ?>
            <a class="collapse-item" href="<?php blink('Dashboard/tablePenjualan')?>">Laporan Penjualan</a>
            <?php }?>
            <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
            echo "";
            } else {
              ?>
            <a class="collapse-item" href="<?php blink('Dashboard/tableBarang')?>">Laporan Data Barang</a>
            <?php }?>
            <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
            echo "";
            } else {
              ?>
            <a class="collapse-item" href="<?php blink('Dashboard/tableHasilSurvey')?>">Laporan Hasil Survey</a>
            <?php }?>
            <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
            echo "";
            } else {
              ?>
            <a class="collapse-item" href="<?php blink('Dashboard/absensi')?>">Laporan Absensi</a>
            <?php }?>
            <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
            echo "";
            } else {
              ?>
            <a class="collapse-item" href="<?php blink('Dashboard/tableTripOjek')?>">Laporan Ojek Online</a>
            <?php }?>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <?php if($this->session->jabatan != 'manager' && $this->session->jabatan != 'karyawan'){
              echo "";
              } else {
                ?>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Data Customer</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php Blink('Dashboard/tableCustomer');?>">Daftar Customer</a>
          </div>
        </div>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <?php }?>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->