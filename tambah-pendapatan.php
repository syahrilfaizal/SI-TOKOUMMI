<?php
//include('dbconnected.php');
include('conf.php');

$tgl_pemasukan = $_GET['tgl_pemasukan'];
$jumlah = $_GET['jumlah'];

//query update
$query = mysqli_query($koneksi,"INSERT INTO `pemasukan` (`tanggal`, `jumlah_pemasukan`) VALUES ('$tgl_pemasukan', '$jumlah')");

if ($query) {
 # credirect ke page index
 header("location:pendapatan.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>