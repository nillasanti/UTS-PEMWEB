<?php
 if(@$_SESSION['status']=="admin"){ ?>
	 <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="halweb.php?pages=homead">
        <div class="sidebar-brand-icon rotate-n-15">
         
        </div>
         <i class="fas fa-fw fa-cog fa-2x"></i>
        <div class="sidebar-brand-text mx-3">Admin</div>
      
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="halweb.php?pages=homead">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Room</h6>
            <a class="collapse-item" href="halweb.php?pages=view_fasilitas">Fasilitas</a>
            </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor:pointer;" onclick="if(confirm('Apakah anda yakin keluar dari sistem ?')){window.location.href='logout.php'}">
        <i class="fas fa-door-open"></i>
          <span>Logout</span></a>
      </li>

<?php } elseif (@$_SESSION['status']=="akuntan") { ?>
	 <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="halweb.php?pages=home">
        <div class="sidebar-brand-icon rotate-n-15">
         
        </div>
         <i class="fas fa-fw fa-music fa-2x"></i>
        <div class="sidebar-brand-text mx-3">Holiyeay Admin </div>
      
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="halweb.php?pages=home">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Data & transaksi
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Master</h6>
            <a class="collapse-item" href="halweb.php?pages=akun">Data Akun</a>
            <a class="collapse-item" href="halweb.php?pages=supplier">Data Supplier</a>
            <a class="collapse-item" href="halweb.php?pages=produk">Data Produk</a>
            <a class="collapse-item" href="halweb.php?pages=pelanggan">Data Pelanggan</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-archive"></i>
          <span>Transaksi</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pendapatan:</h6>
            <a class="collapse-item" href="halweb.php?pages=penjualan">Penjualan</a>
            <a class="collapse-item" href="halweb.php?pages=pelunasan_piutang">Pelunasan piutang</a>
            <a class="collapse-item" href="halweb.php?pages=modal">Input modal</a>
            <h6 class="collapse-header">Pengeluaran:</h6>
            <a class="collapse-item" href="halweb.php?pages=beban">Biaya beban</a>
            <a class="collapse-item" href="halweb.php?pages=pembelian_produk">Pembelian Produk</a>
            <a class="collapse-item" href="halweb.php?pages=pelunasan_hutang">Pelunasan Hutang</a>
            <a class="collapse-item" href="halweb.php?pages=pengeluaran">Pengeluaran</a>
            <a class="collapse-item" href="halweb.php?pages=prive">Prive</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Laporan & pencatatan akuntansi
      </div>


      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="halweb.php?pages=jurnal">
          <i class="fas fa-fw fa-table"></i>
          <span>Jurnal</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="halweb.php?pages=bukubesar">
          <i class="fas fa-fw fa-table"></i>
          <span>Buku besar</span></a>
      </li>

        <li class="nav-item">
        <a class="nav-link" href="halweb.php?pages=neraca_saldo">
          <i class="fas fa-fw fa-table"></i>
          <span>Neraca Saldo</span></a>
      </li>
       <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-file"></i>
          <span>Laporan</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Laporan</h6>
            <a class="collapse-item" href="halweb.php?pages=labarugi">Laporan laba rugi</a>
            <a class="collapse-item" href="halweb.php?pages=perubahan_modal">Laporan perubahan modal</a>
            <a class="collapse-item" href="halweb.php?pages=laporan_neraca">Laporan Neraca</a>
          
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor:pointer;" onclick="if(confirm('Apakah anda yakin keluar dari sistem ?')){window.location.href='logout.php'}">
        <i class="fas fa-door-open"></i>
          <span>Logout</span></a>
      </li>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
  <?php } ?>