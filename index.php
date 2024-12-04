<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}
?>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<?php
require ('conf.php');
require ('sidebar.php');


$pemasukantujuh = mysqli_query($koneksi, "SELECT jumlah_pemasukan FROM pemasukan WHERE tanggal BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()");
while ($tujuhharipemasukan=mysqli_fetch_array($pemasukantujuh)){
$arraypemasukantujuh[] = $tujuhharipemasukan['jumlah_pemasukan'];
}
if (empty($arraypemasukantujuh)) {
    $tujuh_haripemasukan = 0;
} else {
    // Jika array tidak kosong, hitung total pengeluaran
    $tujuh_haripemasukan = array_sum($arraypemasukantujuh);
}

$pengeluarantujuh = mysqli_query($koneksi, "SELECT jumlah FROM pengeluaran WHERE tanggal BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()");
while ($tujuhharipengeluaran=mysqli_fetch_array($pengeluarantujuh)){
$arraypengeluarantujuh[] = $tujuhharipengeluaran['jumlah'];
}
if (empty($arraypengeluarantujuh)) {
    $tujuh_haripengeluaran = 0;
} else {
    // Jika array tidak kosong, hitung total pengeluaran
    $tujuh_haripengeluaran = array_sum($arraypengeluarantujuh);
}

$tunggakantujuh = mysqli_query($koneksi, "SELECT jumlah FROM tunggakan WHERE tanggal BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() AND status = 'Belum Dibayar'");
while ($tujuhharitunggakan=mysqli_fetch_array($tunggakantujuh)){
$arraytunggakantujuh[] = $tujuhharitunggakan['jumlah'];
}
if (empty($arraytunggakantujuh)) {
    $tujuh_haritunggakan = 0;
} else {
    // Jika array tidak kosong, hitung total pengeluaran
    $tujuh_haritunggakan = array_sum($arraytunggakantujuh);
}

$pengeluaran_hari_ini = mysqli_query($koneksi, "SELECT jumlah FROM pengeluaran where tanggal = CURDATE()");
while ($pengeluaran_hariini=mysqli_fetch_array($pengeluaran_hari_ini)){
  $arraypengeluaran[] = $pengeluaran_hariini['jumlah'];
  }
  if (empty($arraypengeluaran)) {
    $pengeluaranhariini = 0;
} else {
    // Jika array tidak kosong, hitung total pengeluaran
    $pengeluaranhariini = array_sum($arraypengeluaran);
}
 
$pemasukan_hari_ini = mysqli_query($koneksi, "SELECT jumlah_pemasukan FROM pemasukan where tanggal = CURDATE()");
while ($hariini=mysqli_fetch_array($pemasukan_hari_ini)){
$arrayhariini[] = $hariini['jumlah_pemasukan'];
}
if (empty($arrayhariini)) {
    $pemasukanhariini = 0;
} else {
    // Jika array tidak kosong, hitung total pengeluaran
    $pemasukanhariini = array_sum($arrayhariini);
}

$tunggakan_hari_ini = mysqli_query($koneksi, "SELECT jumlah FROM tunggakan where tanggal = CURDATE() AND status = 'Belum DIbayar'");
while ($tunggakan_hariini=mysqli_fetch_array($tunggakan_hari_ini)){
$arraytunggakanhariini[] = $tunggakan_hariini['jumlah'];
}
if (empty($arraytunggakanhariini)) {
    $tunggakanhariini = 0;
} else {
    // Jika array tidak kosong, hitung total pengeluaran
    $tunggakanhariini = array_sum($arraytunggakanhariini);
}

$pemasukan=mysqli_query($koneksi,"SELECT * FROM pemasukan");
while ($masuk=mysqli_fetch_array($pemasukan)){
$arraymasuk[] = $masuk['jumlah_pemasukan'];
}
$jumlahmasuk = array_sum($arraymasuk);


$pengeluaran=mysqli_query($koneksi,"SELECT * FROM pengeluaran");
while ($keluar=mysqli_fetch_array($pengeluaran)){
$arraykeluar[] = $keluar['jumlah'];
}
$jumlahkeluar = array_sum($arraykeluar);


$uang = $jumlahmasuk - $jumlahkeluar;

//untuk data chart area



$sekarang =mysqli_query($koneksi, "SELECT jumlah_pemasukan FROM pemasukan
WHERE tanggal = CURDATE()");
$sekarang = mysqli_fetch_array($sekarang);

$satuhari =mysqli_query($koneksi, "SELECT jumlah_pemasukan FROM pemasukan
WHERE tanggal = CURDATE() - INTERVAL 1 DAY");
$satuhari= mysqli_fetch_array($satuhari);


$duahari =mysqli_query($koneksi, "SELECT jumlah_pemasukan FROM pemasukan
WHERE tanggal = CURDATE() - INTERVAL 2 DAY");
$duahari= mysqli_fetch_array($duahari);

$tigahari =mysqli_query($koneksi, "SELECT jumlah_pemasukan FROM pemasukan
WHERE tanggal = CURDATE() - INTERVAL 3 DAY");
$tigahari= mysqli_fetch_array($tigahari);

$empathari =mysqli_query($koneksi, "SELECT jumlah_pemasukan FROM pemasukan
WHERE tanggal = CURDATE() - INTERVAL 4 DAY");
$empathari= mysqli_fetch_array($empathari);

$limahari =mysqli_query($koneksi, "SELECT jumlah_pemasukan FROM pemasukan
WHERE tanggal = CURDATE() - INTERVAL 5 DAY");
$limahari= mysqli_fetch_array($limahari);

$enamhari =mysqli_query($koneksi, "SELECT jumlah_pemasukan FROM pemasukan
WHERE tanggal = CURDATE() - INTERVAL 6 DAY");
$enamhari= mysqli_fetch_array($enamhari);

$tujuhhari =mysqli_query($koneksi, "SELECT jumlah_pemasukan FROM pemasukan
WHERE tanggal = CURDATE() - INTERVAL 7 DAY");
$tujuhhari= mysqli_fetch_array($tujuhhari);
?>
      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php
    // Tampilkan SweetAlert jika login berhasil
    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == "berhasil") {
        echo "
            <script>
                Swal.fire({
                    title: 'Login Berhasil!',
                    text: 'Selamat datang !!!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        ";
        // Hapus session pesan setelah ditampilkan
        unset($_SESSION['pesan']);
        unset($_SESSION['nama_user']);
    }
    ?>        


<?php require 'user.php'; ?>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemasukan (Hari Ini)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php
				echo number_format($pemasukanhariini,2,',','.');
				?></div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div> &nbsp Mingguan : Rp. 
				<?php
				echo number_format($tujuh_haripemasukan,2,',','.');
				?>
			</div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengeluaran (Hari Ini)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php
				echo number_format($pengeluaranhariini,2,',','.');
				?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div> &nbsp Mingguan : Rp. 
				<?php
				echo number_format($tujuh_haripengeluaran,2,',','.');
				?>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tunggakan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php
				echo number_format($tunggakanhariini,2,',','.');
				?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div> &nbsp Mingguan : Rp. 
				<?php
				echo number_format($tujuh_haritunggakan,2,',','.');
				?>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tanggal Hari Ini</div>
          <div id="todayDate" class="h5 mb-0 font-weight-bold text-gray-800"></div> <!-- Tempat menampilkan tanggal -->
        </div>
        <div class="col-auto">
          <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  // Fungsi untuk mendapatkan tanggal hari ini
  function getTodayDate() {
    const today = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = today.toLocaleDateString('id-ID', options); // Menggunakan format Indonesia
    document.getElementById('todayDate').innerText = formattedDate;
  }

  // Memanggil fungsi setelah halaman dimuat
  window.onload = function() {
    getTodayDate();
  };
</script>

            <!-- Pending Requests Card Example -->
            
          </div>

          <!-- Content Row -->

          <div class="row">
  <!-- Card Sumber Pendapatan -->
<?php
// Buat array semua bulan dalam rentang waktu tertentu
$start_date = new DateTime('2024-01-01'); // Sesuaikan tanggal awal
$end_date = new DateTime('2024-12-31'); // Sesuaikan tanggal akhir
$end_date->modify('+1 month'); // Tambahkan 1 bulan untuk memastikan iterasi mencakup akhir bulan
$interval = new DateInterval('P1M');
$period = new DatePeriod($start_date, $interval, $end_date);

$labels = [];
foreach ($period as $date) {
    $labels[] = $date->format('Y-m'); // Format bulan (YYYY-MM)
}

// Inisialisasi data pemasukan dan pengeluaran dengan nilai 0
$data_pemasukan = array_fill_keys($labels, 0);
$data_pengeluaran = array_fill_keys($labels, 0);

// Ambil data pemasukan
$query_pemasukan = mysqli_query($koneksi, "
    SELECT DATE_FORMAT(tanggal, '%Y-%m') AS bulan, SUM(jumlah_pemasukan) AS total_pemasukan
    FROM pemasukan
    GROUP BY DATE_FORMAT(tanggal, '%Y-%m')
");
while ($row = mysqli_fetch_assoc($query_pemasukan)) {
    $data_pemasukan[$row['bulan']] = $row['total_pemasukan'];
}

// Ambil data pengeluaran
$query_pengeluaran = mysqli_query($koneksi, "
    SELECT DATE_FORMAT(tanggal, '%Y-%m') AS bulan, SUM(jumlah) AS total_pengeluaran
    FROM pengeluaran
    GROUP BY DATE_FORMAT(tanggal, '%Y-%m')
");
while ($row = mysqli_fetch_assoc($query_pengeluaran)) {
    $data_pengeluaran[$row['bulan']] = $row['total_pengeluaran'];
}

// Ubah array menjadi format yang bisa digunakan di Chart.js
$labels = array_keys($data_pemasukan); // Ambil nama bulan
$data_pemasukan = array_values($data_pemasukan); // Data pemasukan
$data_pengeluaran = array_values($data_pengeluaran); // Data pengeluaran


?>
  <div class="col-xl-8 col-lg-7">
  <div class="card shadow mb-4">
    <!-- Card Header -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Perbandingan Pemasukan dan Pengeluaran per Bulan</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <canvas id="barChartPerBulan"></canvas>
    </div>
  </div>
</div>
<script>
  var ctx = document.getElementById("barChartPerBulan").getContext('2d');
var barChartPerBulan = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode($labels); ?>, // Label bulan dari PHP
    datasets: [
      {
        label: "Pemasukan (Rp)",
        data: <?= json_encode($data_pemasukan); ?>, // Data pemasukan dari PHP
        backgroundColor: 'rgba(54, 162, 235, 0.6)', // Warna batang pemasukan
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      },
      {
        label: "Pengeluaran (Rp)",
        data: <?= json_encode($data_pengeluaran); ?>, // Data pengeluaran dari PHP
        backgroundColor: 'rgba(255, 99, 132, 0.6)', // Warna batang pengeluaran
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      tooltip: {
        callbacks: {
          label: function(tooltipItem) {
            return 'Rp. ' + tooltipItem.raw.toLocaleString('id-ID');
          }
        }
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          callback: function(value) {
            return 'Rp. ' + value.toLocaleString('id-ID');
          }
        }
      }
    }
  }
});

</script>

  <!-- Card Perbandingan -->
  <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
      <!-- Card Header -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Perbandingan</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Dropdown Header:</div>
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </div>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
          <canvas id="myPieChart"></canvas>
        </div>
        <div class="mt-4 text-center small">
          <span class="mr-2">
            <i class="fas fa-circle text-primary"></i> Pendapatan
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-danger"></i> Pengeluaran
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-info"></i> Tunggakan
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

      <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<?php require 'logout-modal.php'; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script type="text/javascript">
  // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["7 hari lalu","6 hari lalu", "5 hari lalu", "4 hari lalu", "3 hari lalu", "2 hari lalu", "1 hari lalu"],
    datasets: [{
      label: "Pendapatan",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php echo $tujuhhari['0']?>, <?php echo $enamhari['0'] ?>, <?php echo $limahari['0'] ?>, <?php echo $empathari['0'] ?>, <?php echo $tigahari['0'] ?>, <?php echo $duahari['0'] ?>, <?php echo $satuhari['0'] ?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'Rp.' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': Rp.' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});

  
  </script>
  
  <script type="text/javascript">
  
  // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Pendapatan", "Pengeluaran", "Tunggakan"],
    datasets: [{
      data: [<?php echo $jumlahmasuk/1000000 ?>, <?php echo $jumlahkeluar/1000000 ?>, <?php echo $uang/1000000 ?>],
      backgroundColor: ['#4e73df', '#e74a3b', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#e74a3b', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

  
  </script>

</body>

</html>
