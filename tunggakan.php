<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kelola Hutang</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js Library -->
</head>

<body id="page-top">

<?php 
require 'conf.php';
require 'sidebar.php'; 

// Query untuk mengambil data tunggakan dengan status "Belum Dibayar"
$queryBelumDibayar = mysqli_query($koneksi, "SELECT tanggal, SUM(jumlah) as total FROM tunggakan WHERE status='Belum Dibayar' GROUP BY tanggal ORDER BY tanggal ASC");

$tanggalArray = [];
$totalArray = [];
while ($row = mysqli_fetch_assoc($queryBelumDibayar)) {
    $tanggalArray[] = $row['tanggal'];
    $totalArray[] = $row['total'];
}

// Encode data untuk digunakan di JavaScript
$tanggalArrayJS = json_encode($tanggalArray);
$totalArrayJS = json_encode($totalArray);
?>

<div id="content">
  <?php require 'navbar.php'; ?>
  
  <div class="container-fluid">
    <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"> Tambah Tunggakan</i></button><br>
    
    <!-- Chart for Belum Dibayar Tunggakan -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tunggakan Belum Dibayar</h6>
      </div>
      <div class="card-body">
        <canvas id="chartBelumDibayar" style="height: 200px;"></canvas>
      </div>
    </div>

    <!-- Tabel Data Tunggakan -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Tunggakan</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $query = mysqli_query($koneksi, "SELECT * FROM tunggakan ORDER BY tanggal DESC");
              $no = 1;
              while ($data = mysqli_fetch_assoc($query)) {
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $data['tanggal'] ?></td>
                  <td><?= $data['keterangan'] ?></td>
                  <td><?= number_format($data['jumlah'], 0, ',', '.') ?></td>
                  <td><?= $data['status'] ?></td>
                  <td>
                    <a href="#" type="button" class="fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?= $data['id_tunggakan']; ?>"></a>
                  </td>
                </tr>

                <!-- Modal Edit Data Tunggakan -->
                <div class="modal fade" id="myModal<?= $data['id_tunggakan']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Ubah Data Tunggakan</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
  <form id="formTunggakan" role="form" action="proses-edit-tunggakan.php" method="get">
    <input type="hidden" name="id_tunggakan" value="<?= $data['id_tunggakan']; ?>">

    <div class="form-group">
      <label>Jumlah</label>
      <input type="text" name="jumlah" class="form-control" value="<?= $data['jumlah']; ?>">      
    </div>

    <div class="form-group">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal']; ?>">      
    </div>

    <div class="form-group">
      <label>Keterangan</label>
      <input type="text" name="keterangan" class="form-control" value="<?= $data['keterangan']; ?>">      
    </div>

    <div class="form-group">
      <label>Status</label>
      <select name="status" class="form-control">
        <option value="Belum Dibayar" <?= $data['status'] == 'Belum Dibayar' ? 'selected' : '' ?>>Belum Dibayar</option>
        <option value="Sudah Dibayar" <?= $data['status'] == 'Sudah Dibayar' ? 'selected' : '' ?>>Sudah Dibayar</option>
      </select>     
    </div>
    <div class="modal-footer">  
      <button type="submit" class="btn btn-success">Ubah</button>
      <button type="button" class="btn btn-danger" onclick="hapusTunggakan()">Hapus</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
    </div>
  </form>
</div>

<script>
  function hapusTunggakan() {
    var form = document.getElementById('formTunggakan');
    form.action = 'proses_delete_tunggakan.php';
    form.submit();
  }
</script>

                    </div>
                  </div>
                </div>
              <?php 
              } 
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Tambah Tunggakan -->
    <div id="myModalTambah" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Tunggakan</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form action="tambah-tunggakan.php" method="get">
            <div class="modal-body">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" name="tgl_hutang" required>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" name="keterangan" required>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" required>
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
  </div>
</div>

<!-- Script untuk Chart Belum Dibayar -->
<script>
  var ctx = document.getElementById('chartBelumDibayar').getContext('2d');
  var chartBelumDibayar = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo $tanggalArrayJS; ?>,
      datasets: [{
        label: 'Total Belum Dibayar',
        data: <?php echo $totalArrayJS; ?>,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 2,
        fill: false,
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          suggestedMax: Math.max(...<?php echo $totalArrayJS; ?>) + 10000
        },
        x: {
          title: {
            display: true,
            text: 'Tanggal'
          }
        }
      },
      plugins: {
        legend: {
          display: true,
          position: 'top'
        },
        tooltip: {
          callbacks: {
            label: function(tooltipItem) {
              return 'Total Belum Dibayar: Rp. ' + tooltipItem.formattedValue;
            }
          }
        }
      }
    }
  });
</script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

<!-- JavaScript for DataTables Initialization -->
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true
    });
  });
</script>

</body>
</html>
