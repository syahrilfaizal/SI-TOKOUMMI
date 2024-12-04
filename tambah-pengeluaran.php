<?php
//include('dbconnected.php');
include('conf.php');

$tgl_pengeluaran = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$sumber = $_POST['sumber'];

//query update
$query = mysqli_query($koneksi,"INSERT INTO `pengeluaran` (`tanggal`, `jumlah`, `pengeluaran`) VALUES ('$tgl_pengeluaran', '$jumlah', '$sumber')");

if ($query) {
 # credirect ke page index
 header("location:pengeluaran.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>