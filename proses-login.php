<?php
// Mengaktifkan session PHP
session_start();

// Menghubungkan dengan koneksi
include 'conf.php';

// Menangkap data yang dikirim dari form
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$pass = mysqli_real_escape_string($koneksi, $_POST['pass']);

// Menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$email' AND password='$pass'");

// Menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if ($cek > 0) {
    // Jika login berhasil
    $sesi = mysqli_fetch_assoc($data);
    $_SESSION['id'] = $sesi['id_user'];
    $_SESSION['username'] = $sesi['username'];
    $_SESSION['status'] = "login";

    // Set session untuk pesan sukses
    $_SESSION['pesan'] = "berhasil";
    $_SESSION['nama_user'] = $sesi['username'];

    // Redirect ke halaman index
    header("Location: index.php");
    exit();
} else {
    // Jika login gagal, set session untuk pesan gagal
    $_SESSION['pesan'] = "gagal";

    // Redirect kembali ke halaman login
    header("Location: login.php");
    exit();
}
?>
