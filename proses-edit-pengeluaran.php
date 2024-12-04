<?php
include('conf.php'); // Pastikan koneksi database sesuai

$id = $_POST['id_pengeluaran'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$pengeluaran = $_POST['pengeluaran'];

// Query update untuk tabel pengeluaran
$query = mysqli_query($koneksi, "UPDATE pengeluaran SET tanggal='$tanggal', jumlah='$jumlah', pengeluaran='$pengeluaran' WHERE id_pengeluaran='$id'");

if ($query) {
    // Redirect ke halaman pengeluaran.php setelah update berhasil
    header("location:pengeluaran.php"); 
} else {
    echo "ERROR, data gagal diupdate: " . mysqli_error($koneksi);
}

// Tutup koneksi (opsional)
mysqli_close($koneksi);
?>
