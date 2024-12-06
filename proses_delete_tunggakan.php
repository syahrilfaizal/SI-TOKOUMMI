<?php
include('conf.php');

// Ambil data dari parameter URL
$id = $_GET['id_tunggakan'];
$tanggal = $_GET['tanggal'];
$keterangan = $_GET['keterangan'];
$jumlah = $_GET['jumlah'];
$status = $_GET['status'];

// Query update untuk tabel tunggakan
$query = mysqli_query($koneksi, "DELETE FROM tunggakan WHERE id_tunggakan='$id'");

if ($query) {
    // Redirect ke halaman tunggakan.php setelah update berhasil
    header("location:tunggakan.php"); 
} else {
    echo "ERROR, data gagal diupdate: " . mysqli_error($koneksi);
}

// Tutup koneksi (opsional)
mysqli_close($koneksi);
?>
