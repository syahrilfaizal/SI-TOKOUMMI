<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard - Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body id="page-top">

<?php 
require 'conf.php';
require ('sidebar.php'); ?>   
     <!-- Main Content -->
      <div id="content">

<?php require ('navbar.php'); ?> 

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Chart -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Perkembangan Pemasukan</h6>
      </div>
      <div class="card-body">
        <canvas id="myChart" style="height: 200px;"></canvas>
      </div>
    </div>

    <!-- Tombol untuk memunculkan modal tambah pendapatan -->
    <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah">
      <i class="fa fa-plus"> Pemasukan</i>
    </button><br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pemasukan</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID Pemasukan</th>
                <th>Jumlah Pemasukan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            
            <tbody>
  <?php
  // Query untuk mengambil data dari tabel pemasukan
  $query = mysqli_query($koneksi, "SELECT * FROM pemasukan"); 

  // Data untuk chart
  $tanggalArray = [];
  $jumlahArray = [];
  
  while ($data = mysqli_fetch_assoc($query)) {
    $jumlah_pemasukan = !empty($data['jumlah_pemasukan']) ? $data['jumlah_pemasukan'] : 0;
    
    echo "<tr>";
    echo "<td>" . $data['id_pemasukan'] . "</td>";
    echo "<td>Rp. " . number_format($jumlah_pemasukan, 0, ',', '.') . "</td>";
    echo "<td>" . $data['tanggal'] . "</td>";
    echo "<td>";
    echo "<button type='button' class='fa fa-edit btn btn-primary btn-md' data-toggle='modal' data-target='#modalAksi" . $data['id_pemasukan'] . "'></button>";
    echo "</td>";
    echo "</tr>";
    
    $tanggalArray[] = $data['tanggal'];
    $jumlahArray[] = $jumlah_pemasukan;
  }

  $tanggalArrayJS = json_encode($tanggalArray);
  $jumlahArrayJS = json_encode($jumlahArray);
  ?>
</tbody>
<?php
$query = mysqli_query($koneksi, "SELECT * FROM pemasukan");
while ($data = mysqli_fetch_assoc($query)) {
?>
  <div class="modal fade" id="modalAksi<?= $data['id_pemasukan']; ?>" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Data Pemasukan</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form method="post" id="formpemasukan<?= $data['id_pemasukan']; ?>" action="proses-edit-pemasukan.php">
    <input type="hidden" name="id_pemasukan" value="<?= $data['id_pemasukan']; ?>">
    <div class="form-group">
        <label>Jumlah Pemasukan</label>
        <input type="number" name="jumlah_pemasukan" class="form-control" value="<?= $data['jumlah_pemasukan']; ?>" required>
    </div>
    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal']; ?>" required>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Edit</button>
        <button type="button" class="btn btn-danger" onclick="hapusPendapatan(<?= $data['id_pemasukan']; ?>)">Hapus</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
    </div>
</form>

<script>
function hapusPendapatan(id) {
    console.log("Menghapus pemasukan dengan ID: " + id);
    var form = document.getElementById('formpemasukan' + id);
    form.action = 'proses_delete_pemasukan.php'; // Pastikan nama file benar
    form.submit();
}
</script>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>


          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <!-- Modal untuk Tambah Pendapatan -->
  <div id="myModalTambah" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Pendapatan</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
        <form action="tambah-pendapatan.php" method="get">
          <div class="modal-body">
            Tanggal : 
            <input type="date" class="form-control" name="tgl_pemasukan" required>
            Jumlah : 
            <input type="number" class="form-control" name="jumlah" required>
          </div>
          <!-- footer modal -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Tambah</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php require 'footer.php';?>

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<?php require 'logout-modal.php';?>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<!-- Script untuk Chart -->
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line', // Anda bisa mengubah menjadi 'bar' untuk grafik batang
    data: {
      labels: <?php echo $tanggalArrayJS; ?>, // Tanggal diambil dari PHP
      datasets: [{
        label: 'Jumlah Pemasukan',
        data: <?php echo $jumlahArrayJS; ?>, // Jumlah diambil dari PHP
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 2,
        fill: true
      }]
    },
    options: {
      maintainAspectRatio: false, // Memungkinkan chart untuk mengabaikan rasio aspek default
      aspectRatio: 2, // Mengubah rasio aspek, 2 berarti 2 kali lebih lebar daripada tinggi
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>


</body>

</html>
