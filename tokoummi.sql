-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 03 Des 2024 pada 14.52
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokoummi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int NOT NULL,
  `jumlah_pemasukan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `jumlah_pemasukan`, `tanggal`) VALUES
(1, '1000000', '2024-10-07'),
(5, '300000', '2024-10-04'),
(6, '2500000', '2024-10-12'),
(7, '2000000', '2024-10-05'),
(8, '200000', '2024-10-30'),
(9, '2000000', '2024-11-24'),
(10, '200000', '2024-11-21'),
(11, '15000000', '2024-07-18'),
(13, '2000000', '2024-11-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int NOT NULL,
  `pengeluaran` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `pengeluaran`, `jumlah`, `tanggal`) VALUES
(1, 'Pembelian domain', '10000000', '2024-10-16'),
(2, 'Perpanjang Domain', '2000000', '2024-10-22'),
(3, 'Pembelian domain', '5000000', '2024-10-08'),
(4, 'Kebutuhan Pokok', '10000000', '2024-10-14'),
(5, 'Operasional', '5000000', '2024-10-15'),
(6, 'Bayar Listrik', '5000000', '2024-10-16'),
(7, 'Bayar Air', '3000000', '2024-10-10'),
(8, 'Bayar Gaji Pegawai', '12000000', '2024-10-13'),
(9, 'Bayar Air', '2000000', '2024-10-28'),
(10, 'Kebutuhan Pokok', '400000', '2024-10-25'),
(11, 'Operasional', '100000', '2024-10-26'),
(12, 'Perpanjang Domain', '15000000', '2024-10-30'),
(14, 'Kebutuhan Pokok', '20000000', '2024-11-24'),
(15, 'Bayar Wifi', '2000000', '2024-10-17'),
(16, 'Bayar Tagihan BANK', '5000000', '2024-11-24'),
(18, 'Operasional', '2000000', '2024-11-26'),
(19, 'Bayar Wifi', '300000', '2024-11-30'),
(20, 'Bayar Wifi', '200000', '2024-11-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tunggakan`
--

CREATE TABLE `tunggakan` (
  `id_tunggakan` int NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(355) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tunggakan`
--

INSERT INTO `tunggakan` (`id_tunggakan`, `tanggal`, `keterangan`, `jumlah`, `status`) VALUES
(1, '2024-10-17', 'Bayar Wifi', '2000000', 'Sudah Dibayar'),
(2, '2024-10-18', 'Bayar Listrik', '2000000', 'Sudah Dibayar'),
(3, '2024-10-16', 'Bayar Gaji', '10000000', 'Belum Dibayar'),
(4, '2024-11-30', 'Bayar Gaji', '20000000', 'Sudah Dibayar'),
(5, '2024-10-05', 'Bayar Listrik', '20000000', 'Belum Dibayar'),
(6, '2024-11-24', 'Bayar Gaji', '2000000', 'Belum Dibayar'),
(7, '2024-11-22', 'Bayar Listrik', '20000000', 'Belum Dibayar'),
(8, '2024-11-24', 'Bayar Tagihan BANK', '5000000', 'Sudah Dibayar'),
(9, '2024-11-26', 'Bayar Wifi', '200000', 'Sudah Dibayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '1234');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `tunggakan`
--
ALTER TABLE `tunggakan`
  ADD PRIMARY KEY (`id_tunggakan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tunggakan`
--
ALTER TABLE `tunggakan`
  MODIFY `id_tunggakan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
