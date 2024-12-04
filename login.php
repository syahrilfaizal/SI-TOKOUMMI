<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <style>
    /* Custom styling to match the website's blue-gray color scheme */
    body {
      background: #BFCACD; /* Warna latar belakang biru keabu-abuan */
      margin: 0; /* Hilangkan margin default */
      height: 100vh; /* Tinggi penuh viewport */
      overflow: hidden; /* Cegah scroll */
    }

    .card {
      position: fixed; /* Form tetap di posisi tetap */
      top: 50%; /* Tempatkan di tengah vertikal */
      left: 50%; /* Tempatkan di tengah horizontal */
      transform: translate(-50%, -50%); /* Pusatkan secara sempurna */
      background: #7188AE; /* Warna putih keabu-abuan untuk kartu */
      border: 1px solid #C5C7C9; /* Border abu-abu terang */
      width: 100%; /* Lebar penuh untuk responsif */
      max-width: 400px; /* Maksimal lebar untuk form */
      padding: 20px; /* Tambahkan padding */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan */
    }

    .btn-primary {
      background-color: #ffffff; /* Biru keabu-abuan lebih gelap untuk hover */
      border-color: #5A6268;
      color: black;
    }

    .form-control {
      border-color: #C5C7C9; /* Border abu-abu terang */
    }

    .form-control:focus {
      border-color: #6C757D; /* Border biru keabu-abuan saat fokus */
      box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25); /* Efek fokus */
    }

    h1 {
      color: #ffffff; /* Warna teks abu-abu gelap */
    }

    .text-center {
      color: #ffffff; /* Warna teks abu-abu gelap */
    }

  </style>

</head>

<body>

  <div class="card">
    <div class="p-4">
      <div class="text-center">
        <h1 class="h4 mb-4 textselamat">Selamat Datang!</h1>
      </div>
      <form class="user" action="proses-login.php" method="post">
      <div class="form-group">
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-user"></i></span>
    </div>
    <input type="text" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username..">
  </div>
</div>
<div class="form-group">
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-lock"></i></span>
    </div>
    <input type="password" name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password..">
  </div>
</div>
        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Masuk">
      </form>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <?php
    // Tampilkan SweetAlert jika login gagal
    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == "gagal") {
        echo "
            <script>
                Swal.fire({
                    title: 'Login Gagal!',
                    text: 'Username atau password salah.',
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi'
                });
            </script>
        ";
        // Hapus session pesan setelah ditampilkan
        unset($_SESSION['pesan']);
    }
    ?>
</body>

</html>
