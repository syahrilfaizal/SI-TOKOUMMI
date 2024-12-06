<?php
include('conf.php'); // Pastikan koneksi database sesuai

if (isset($_POST['id_pengeluaran'])) {
    $id = $_POST['id_pengeluaran'];

    // Query untuk menghapus data dari tabel pengeluaran
    $query = mysqli_query($koneksi, "DELETE FROM pengeluaran WHERE id_pengeluaran='$id'");

    if ($query) {
        // Redirect ke halaman pengeluaran.php setelah penghapusan berhasil
        header("location:pengeluaran.php"); 
    } else {
        echo "ERROR, data gagal dihapus: " . mysqli_error($koneksi);
    }
}

// Tutup koneksi (opsional)
mysqli_close($koneksi);
?>
