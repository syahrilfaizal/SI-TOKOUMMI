  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-">
          <img src="img/logo.png" alt="Logo" style="width: 90px; height: auto;"> <!-- Sesuaikan ukuran sesuai kebutuhan -->
        </div>
        <div class="sidebar-brand-text mx-3"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Transaksi
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="pendapatan.php">
          <i class="fas fa-fw fa-arrow-up"></i>
          <span>Pendapatan</span>
        </a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="pengeluaran.php">
          <i class="fas fa-fw fa-arrow-down"></i>
          <span>Pengeluaran</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Tagihan
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="tunggakan.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Tunggakan</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="laporan.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Laporan</span></a>
      </li>


      <hr class="sidebar-divider d-none d-md-block">

      <!-- Nav Item - Logout -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php" id="logout-button">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </li>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('logout-button').addEventListener('click', function (e) {
        e.preventDefault(); // Mencegah link default

        // SweetAlert untuk konfirmasi logout
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan keluar dari akun ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengklik "Ya", arahkan ke logout.php
                window.location.href = 'logout.php';
            }
        });
    });
</script>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <!-- Divider -->


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
