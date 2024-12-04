<?php
require 'vendor/autoload.php'; // Pastikan path ini benar sesuai dengan lokasi PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tokoummi";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan parameter dari URL
$type = isset($_GET['type']) ? $_GET['type'] : '';
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Validasi tipe data
if (!in_array($type, ['pemasukan', 'pengeluaran'])) {
    die("Tipe data tidak valid!");
}

// Query sesuai filter
if ($start_date && $end_date) {
    $query = "SELECT * FROM $type WHERE tanggal BETWEEN '$start_date' AND '$end_date'";
} else {
    $query = "SELECT * FROM $type";
}

$result = $conn->query($query);

// Siapkan spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
if ($type == 'pemasukan') {
    $sheet->setCellValue('A1', 'ID Pemasukan');
    $sheet->setCellValue('B1', 'Jumlah Pemasukan');
    $sheet->setCellValue('C1', 'Tanggal');
} elseif ($type == 'pengeluaran') {
    $sheet->setCellValue('A1', 'ID Pengeluaran');
    $sheet->setCellValue('B1', 'Pengeluaran');
    $sheet->setCellValue('C1', 'Jumlah');
    $sheet->setCellValue('D1', 'Tanggal');
}

// Isi data
$rowIndex = 2; // Mulai dari baris ke-2
while ($row = $result->fetch_assoc()) {
    if ($type == 'pemasukan') {
        $sheet->setCellValue("A$rowIndex", $row['id_pemasukan']);
        $sheet->setCellValue("B$rowIndex", $row['jumlah_pemasukan']);
        $sheet->setCellValue("C$rowIndex", $row['tanggal']);
    } elseif ($type == 'pengeluaran') {
        $sheet->setCellValue("A$rowIndex", $row['id_pengeluaran']);
        $sheet->setCellValue("B$rowIndex", $row['pengeluaran']);
        $sheet->setCellValue("C$rowIndex", $row['jumlah']);
        $sheet->setCellValue("D$rowIndex", $row['tanggal']);
    }
    $rowIndex++;
}

// Menambahkan baris jumlah di paling bawah
if ($type == 'pemasukan') {
    $totalCell = "B" . $rowIndex; // Kolom B untuk jumlah pemasukan
    $sheet->setCellValue("A$rowIndex", 'Jumlah Total');
    $sheet->setCellValue($totalCell, "=SUM(B2:B" . ($rowIndex - 1) . ")");
    $sheet->getStyle("A$rowIndex:$totalCell")->getFont()->setBold(true);
} elseif ($type == 'pengeluaran') {
    $totalCell = "C" . $rowIndex; // Kolom C untuk jumlah pengeluaran
    $sheet->setCellValue("B$rowIndex", 'Jumlah Total');
    $sheet->setCellValue($totalCell, "=SUM(C2:C" . ($rowIndex - 1) . ")");
    $sheet->getStyle("B$rowIndex:$totalCell")->getFont()->setBold(true);
}

// Otomatis sesuaikan lebar kolom
foreach (range('A', $sheet->getHighestColumn()) as $column) {
    $sheet->getColumnDimension($column)->setAutoSize(true);
}

// Tambahkan border ke seluruh tabel
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
];

$sheet->getStyle("A1:" . $sheet->getHighestColumn() . ($rowIndex))
    ->applyFromArray($styleArray);

// Simpan dan unduh file Excel
$filename = $type . "_data.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
