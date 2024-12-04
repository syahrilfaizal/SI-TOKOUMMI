<?php
include('conf.php');

// Ambil data dari parameter URL
$id = $_GET['id_tunggakan'];
$tanggal = $_GET['tanggal'];
$keterangan = $_GET['keterangan'];
$jumlah = $_GET['jumlah'];
$status = $_GET['status'];

// Query update untuk tabel tunggakan
$query = mysqli_query($koneksi, "UPDATE tunggakan SET tanggal='$tanggal', keterangan='$keterangan', jumlah='$jumlah', status='$status' WHERE id_tunggakan='$id'");

if ($query) {
    // Redirect ke halaman tunggakan.php setelah update berhasil
    $tambah = mysqli_query($koneksi,"INSERT INTO `pengeluaran` (`tanggal`, `jumlah`, `pengeluaran`) VALUES ('$tanggal', '$jumlah', '$keterangan')");
    header("location:tunggakan.php"); 
} else {
    echo "ERROR, data gagal diupdate: " . mysqli_error($koneksi);
}

// Tutup koneksi (opsional)
mysqli_close($koneksi);
?>
