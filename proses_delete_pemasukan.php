<?php
include('conf.php'); // Pastikan koneksi database sesuai

$id = $_POST['id_pemasukan'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah_pemasukan'];

// Query update untuk tabel pengeluaran
$query = mysqli_query($koneksi, "DELETE FROM pemasukan WHERE id_pemasukan='$id'");

if ($query) {
    // Redirect ke halaman pengeluaran.php setelah update berhasil
    header("location:pendapatan.php"); 
} else {
    echo "ERROR, data gagal diupdate: " . mysqli_error($koneksi);
}

// Tutup koneksi (opsional)
mysqli_close($koneksi);
?>
