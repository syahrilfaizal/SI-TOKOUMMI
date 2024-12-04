<?php
//include('dbconnected.php');
include('conf.php');

$tgl_pengeluaran = $_GET['tgl_hutang'];
$keterangan = $_GET['keterangan'];
$jumlah = $_GET['jumlah'];
$status = "Belum Dibayar";

//query insert
$query = mysqli_query($koneksi, "INSERT INTO tunggakan (tanggal, keterangan, jumlah, status) VALUES ('$tgl_pengeluaran', '$keterangan', '$jumlah', '$status')");

if ($query) {
    // Redirect ke halaman hutang.php
    header("location:tunggakan.php"); 
} else {
    echo "ERROR, data gagal ditambahkan: " . mysqli_error($koneksi);
}

// Tutup koneksi jika diperlukan (opsional)
mysqli_close($koneksi);
?>
