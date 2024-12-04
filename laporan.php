<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Laporan Keuangan</title>

  <!-- Custom fonts and styles -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

<?php 
require 'conf.php'; // File koneksi database
require 'sidebar.php'; ?>

<div id="content">
<?php require 'navbar.php'; ?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan</h6>
    </div>
    <div class="card-body">

      <!-- Form Filter Tanggal -->
      <form method="GET" action="">
        <div class="form-group row">
          <label for="start_date" class="col-sm-2 col-form-label">Tanggal Mulai:</label>
          <div class="col-sm-4">
            <input type="date" class="form-control" name="start_date">
          </div>
          <label for="end_date" class="col-sm-2 col-form-label">Tanggal Akhir:</label>
          <div class="col-sm-4">
            <input type="date" class="form-control" name="end_date">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
      </form>

      <?php 
      // Inisialisasi nilai default
      $total_pemasukan = 0;
      $jumlah_pemasukan = 0;
      $total_pengeluaran = 0;
      $jumlah_pengeluaran = 0;
      $saldo = 0;

      // Mendapatkan filter tanggal dari input
      $start_date = isset($_GET['start_date']) ? mysqli_real_escape_string($koneksi, $_GET['start_date']) : null;
      $end_date = isset($_GET['end_date']) ? mysqli_real_escape_string($koneksi, $_GET['end_date']) : null;

      // Query data berdasarkan filter tanggal atau default
      if (!empty($start_date) && !empty($end_date)) {
          $pemasukan_query = "SELECT * FROM pemasukan WHERE tanggal BETWEEN '$start_date' AND '$end_date'";
          $pengeluaran_query = "SELECT * FROM pengeluaran WHERE tanggal BETWEEN '$start_date' AND '$end_date'";
      } else {
          $pemasukan_query = "SELECT * FROM pemasukan";
          $pengeluaran_query = "SELECT * FROM pengeluaran";
          $start_date = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT MIN(tanggal) as tanggal FROM pemasukan UNION SELECT MIN(tanggal) as tanggal FROM pengeluaran"))['tanggal'];
          $end_date = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT MAX(tanggal) as tanggal FROM pemasukan UNION SELECT MAX(tanggal) as tanggal FROM pengeluaran"))['tanggal'];
      }

      // Eksekusi query pemasukan dan pengeluaran
      $pemasukan = mysqli_query($koneksi, $pemasukan_query);
      $pengeluaran = mysqli_query($koneksi, $pengeluaran_query);

      // Menghitung total pemasukan dan pengeluaran
      if ($pemasukan) {
          while ($masuk = mysqli_fetch_array($pemasukan)) {
              $total_pemasukan += $masuk['jumlah_pemasukan'];
              $jumlah_pemasukan++;
          }
      }

      if ($pengeluaran) {
          while ($keluar = mysqli_fetch_array($pengeluaran)) {
              $total_pengeluaran += $keluar['jumlah'];
              $jumlah_pengeluaran++;
          }
      }

      // Menghitung saldo
      $saldo = $total_pemasukan - $total_pengeluaran;

      // Menyiapkan data untuk grafik
      $all_dates = [];
      $pemasukan_assoc = [];
      $pengeluaran_assoc = [];
      $pemasukan_data = [];
      $pengeluaran_data = [];

      // Mendapatkan semua tanggal dalam rentang filter
      $start = new DateTime($start_date);
      $end = new DateTime($end_date);
      $interval = new DateInterval('P1D');
      $date_period = new DatePeriod($start, $interval, $end->modify('+1 day'));

      foreach ($date_period as $date) {
          $all_dates[] = $date->format('Y-m-d');
      }

      // Mendapatkan data pemasukan berdasarkan tanggal
      $pemasukan_result = mysqli_query($koneksi, $pemasukan_query);
      if ($pemasukan_result) {
          while ($row = mysqli_fetch_assoc($pemasukan_result)) {
              $pemasukan_assoc[$row['tanggal']] = $row['jumlah_pemasukan'];
          }
      }

      // Mendapatkan data pengeluaran berdasarkan tanggal
      $pengeluaran_result = mysqli_query($koneksi, $pengeluaran_query);
      if ($pengeluaran_result) {
          while ($row = mysqli_fetch_assoc($pengeluaran_result)) {
              $pengeluaran_assoc[$row['tanggal']] = $row['jumlah'];
          }
      }

      // Menyiapkan data untuk grafik dengan nilai default 0
      foreach ($all_dates as $tanggal) {
          $pemasukan_data[] = isset($pemasukan_assoc[$tanggal]) ? $pemasukan_assoc[$tanggal] : 0;
          $pengeluaran_data[] = isset($pengeluaran_assoc[$tanggal]) ? $pengeluaran_assoc[$tanggal] : 0;
      }
      ?>

      <!-- Tabel Data -->
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Kategori</th>
              <th>Jumlah Transaksi</th>
              <th>Total (Rp)</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Pemasukan</td>
              <td><?= $jumlah_pemasukan ?: 0 ?></td>
              <td>Rp. <?= number_format($total_pemasukan ?: 0, 2, ',', '.') ?></td>
              <td><a href="download.php?type=pemasukan&start_date=<?= $_GET['start_date'] ?? '' ?>&end_date=<?= $_GET['end_date'] ?? '' ?>" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a></td>
            </tr>
            <tr>
              <td>Pengeluaran</td>
              <td><?= $jumlah_pengeluaran ?: 0 ?></td>
              <td>Rp. <?= number_format($total_pengeluaran ?: 0, 2, ',', '.') ?></td>
              <td><a href="download.php?type=pengeluaran&start_date=<?= $_GET['start_date'] ?? '' ?>&end_date=<?= $_GET['end_date'] ?? '' ?>" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a></td>
            </tr>
            <tr>
              <td><strong>Saldo</strong></td>
              <td colspan="2"><strong>Rp. <?= number_format($saldo ?: 0, 2, ',', '.') ?></strong></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Grafik Analisis -->
      <canvas id="financialChart"></canvas>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>

</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script>
// Data dari PHP ke JavaScript
var tanggalData = <?php echo json_encode($all_dates); ?>;
var pemasukanData = <?php echo json_encode($pemasukan_data); ?>;
var pengeluaranData = <?php echo json_encode($pengeluaran_data); ?>;

// Membuat Line Chart menggunakan Chart.js
var ctx = document.getElementById('financialChart').getContext('2d');
var financialChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: tanggalData,
        datasets: [
            {
                label: 'Pemasukan',
                data: pemasukanData,
                borderColor: 'green',
                backgroundColor: 'rgba(0, 128, 0, 0.1)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'Pengeluaran',
                data: pengeluaranData,
                borderColor: 'red',
                backgroundColor: 'rgba(255, 0, 0, 0.1)',
                fill: true,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Analisis Keuangan (Pemasukan & Pengeluaran)'
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Tanggal'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Jumlah (Rp)'
                },
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>
