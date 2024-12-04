<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard - Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

<?php 
require 'conf.php';
require 'sidebar.php';

$dataPengeluaran = array_fill(0, 8, 0);

$query = "SELECT tanggal, jumlah FROM pengeluaran 
          WHERE tanggal BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() 
          ORDER BY tanggal ASC";
$result = mysqli_query($koneksi, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $tanggal = $row['tanggal'];
    $interval = (new DateTime())->diff(new DateTime($tanggal))->days;
    $dataPengeluaran[7 - $interval] = $row['jumlah'];
}
?>   

<div id="content">
  <?php require 'navbar.php'; ?>  

  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4" style="width: 1200px;">
          <div class="card-header py-3" style="width: 1200px;">
            <h6 class="m-0 font-weight-bold text-primary">Pengeluaran 7 Hari Terakhir</h6>
          </div>
          <div class="card-body" style="width: 1200px;" style="height: 200px;">
            <div class="chart-area" style="width: 1100px;">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4" style="width: 1200px;">
          <div class="card-header py-3">
            <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah">
              <i class="fa fa-plus"></i> Keluaran
            </button>
            <h6 class="m-0 font-weight-bold text-primary">Transaksi Keluar</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID Pengeluaran</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Pengeluaran</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $query = mysqli_query($koneksi, "SELECT * FROM pengeluaran");
                while ($data = mysqli_fetch_assoc($query)) {
                ?>
                  <tr>
                    <td><?= $data['id_pengeluaran']; ?></td>
                    <td><?= $data['tanggal']; ?></td>
                    <td>Rp. <?= number_format($data['jumlah'], 2, ',', '.'); ?></td>
                    <td><?= $data['pengeluaran']; ?></td>
                    <td>
                      <a href="#" class="fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?= $data['id_pengeluaran']; ?>"></a>
                    </td>
                  </tr>

                  <div class="modal fade" id="myModal<?= $data['id_pengeluaran']; ?>" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Ubah Data Pengeluaran</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form action="proses-edit-pengeluaran.php" method="post">
                            <input type="hidden" name="id_pengeluaran" value="<?= $data['id_pengeluaran']; ?>">
                            <div class="form-group">
                              <label>Pengeluaran</label>
                              <input type="text" name="pengeluaran" class="form-control" value="<?= $data['pengeluaran']; ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Tanggal</label>
                              <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal']; ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Jumlah</label>
                              <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah']; ?>" required>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success">Ubah</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div id="myModalTambah" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pengeluaran</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="tambah-pengeluaran.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Tanggal:</label>
            <input type="date" class="form-control" name="tanggal" required>
          </div>
          <div class="form-group">
            <label>Jumlah:</label>
            <input type="number" class="form-control" name="jumlah" required>
          </div>
          <div class="form-group">
            <label>Sumber:</label>
            <input type="text" class="form-control" name="sumber" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Tambah</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script type="text/javascript">
  var dataPengeluaran = <?php echo json_encode($dataPengeluaran); ?>;

  var ctx = document.getElementById("myAreaChart").getContext('2d');
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["7 days ago", "6 days ago", "5 days ago", "4 days ago", "3 days ago", "2 days ago", "Yesterday", "Today"],
      datasets: [{
        label: "Pengeluaran",
        data: dataPengeluaran,
        backgroundColor: 'rgba(78, 115, 223, 0.2)',
        borderColor: 'rgba(78, 115, 223, 1)',
        borderWidth: 2,
        fill: true
      }]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            callback: function(value) {
              return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
            }
          }
        }]
      }
    }
  });
</script>

</body>
</html>