-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 10:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sirekap`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `NIP` char(18) NOT NULL,
  `nama_karyawan` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `unit_kerja` enum('Esensial dan Keperawatan Kesehatan Masyarakat','Pengembangan','Kefarmasian & Laboratorium') NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`NIP`, `nama_karyawan`, `alamat`, `unit_kerja`, `jabatan`, `created_at`, `updated_at`) VALUES
('0', 'Administrator', '-', '', 'Admin', '2024-12-23', '2024-12-23'),
('196912312000023456', 'Wawan Supriatno', 'Perum Griya Asri, Jl. Mawar, Kota Bandung', 'Esensial dan Keperawatan Kesehatan Masyarakat', 'Staf', '2024-12-23', '2024-12-23'),
('198503122010011234', 'dr. Jajang Nurohmat', 'Komplek Bumi Asri, Blok B No. 5, Kecamatan Medan Satria, Kota Bekasi', '', 'Kepala Puskesmas', '2024-12-23', '2024-12-23'),
('199207082001801901', 'Pipiw Rosmana Dewi, S.kes', 'Jl. Anggrek Raya No. 12, Perumahan Harmoni Indah, Kota Bekasi', 'Esensial dan Keperawatan Kesehatan Masyarakat', 'Kepala Unit', '2024-12-23', '2024-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kerangka_kerja`
--

CREATE TABLE `tbl_kerangka_kerja` (
  `id_kak` int(11) NOT NULL,
  `program_kerja` varchar(128) NOT NULL,
  `nama_kegiatan` varchar(128) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `anggaran_dibutuhkan` int(11) NOT NULL,
  `anggaran_disetujui` int(11) DEFAULT NULL,
  `penanggung_jawab` varchar(128) NOT NULL,
  `sasaran` varchar(128) NOT NULL,
  `target` int(11) NOT NULL,
  `file` varchar(128) NOT NULL,
  `status` enum('Diproses','Diterima','Menunggu Persetujuan LPJ','Perlu Perbaikan','Ditolak','Selesai') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_kerangka_kerja`
--

INSERT INTO `tbl_kerangka_kerja` (`id_kak`, `program_kerja`, `nama_kegiatan`, `tanggal_mulai`, `tanggal_selesai`, `anggaran_dibutuhkan`, `anggaran_disetujui`, `penanggung_jawab`, `sasaran`, `target`, `file`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Penyuluhan Stunting', 'Imunisasi Vitamin B', '2025-01-01', '2025-01-31', 4500000, 4000000, '199207082001801901', 'Balita dan Anak dibawah 12 Tahun', 150, 'Imunisasi_Vitamin_B6775fd558b102.docx', 'Selesai', '2025-01-02', '2025-01-02'),
(11, 'test aaaaa', 'hahahhihihi', '2025-02-01', '2025-02-28', 5000000, 145000, '199207082001801901', 'asdfasdfasdf', 133, 'hahahhihihi677b5797c2cb1.pdf', 'Diterima', '2025-01-01', '2025-01-06'),
(12, 'sfgadgasdg', 'sadgasdgasdg', '2025-03-01', '2025-03-31', 100000, NULL, '199207082001801901', 'sdafsdfasdfsd', 100, 'sadgasdgasdg677b581e39e3f.png', 'Diproses', '2025-01-06', '2025-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kunjungan`
--

CREATE TABLE `tbl_kunjungan` (
  `id_kunjungan` int(11) NOT NULL,
  `id_kak` int(11) NOT NULL,
  `nama_desa` varchar(128) NOT NULL,
  `jumlah_kunjungan` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_kunjungan`
--

INSERT INTO `tbl_kunjungan` (`id_kunjungan`, `id_kak`, `nama_desa`, `jumlah_kunjungan`, `created_at`, `updated_at`) VALUES
(25, 9, 'Burujul Kulon', 15, '2025-01-02', '2025-01-02'),
(26, 9, 'Burujul Wetan', 20, '2025-01-02', '2025-01-02'),
(27, 9, 'Cicadas', 25, '2025-01-02', '2025-01-02'),
(28, 9, 'Jatisura', 15, '2025-01-02', '2025-01-02'),
(29, 9, 'Jatiwangi', 15, '2025-01-02', '2025-01-02'),
(30, 9, 'Mekarsari', 10, '2025-01-02', '2025-01-02'),
(31, 9, 'Surawangi', 15, '2025-01-02', '2025-01-02'),
(32, 9, 'Sutawangi', 15, '2025-01-02', '2025-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lpj`
--

CREATE TABLE `tbl_lpj` (
  `id_lpj` int(11) NOT NULL,
  `id_kak` int(11) NOT NULL,
  `anggaran_digunakan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `catatan` text DEFAULT NULL,
  `file_lpj` varchar(128) NOT NULL,
  `dokumentasi` varchar(128) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_lpj`
--

INSERT INTO `tbl_lpj` (`id_lpj`, `id_kak`, `anggaran_digunakan`, `keterangan`, `catatan`, `file_lpj`, `dokumentasi`, `created_at`, `updated_at`) VALUES
(4, 9, 3500000, 'gak ada hehehe', 'aman hehe', 'LPJ_6775fe252b8d9.pdf', 'Dokumentasi_6775fe3a91543.jpg', '2025-01-02', '2025-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pagu_anggaran`
--

CREATE TABLE `tbl_pagu_anggaran` (
  `id_pagu_anggaran` int(11) NOT NULL,
  `jumlah_anggaran` int(11) NOT NULL,
  `tahun_anggaran` varchar(5) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pagu_anggaran`
--

INSERT INTO `tbl_pagu_anggaran` (`id_pagu_anggaran`, `jumlah_anggaran`, `tahun_anggaran`, `created_at`, `updated_at`) VALUES
(1, 25000000, '2025', '2025-01-06', '2025-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` int(11) NOT NULL,
  `NIP` char(18) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('Administrator','Kepala Puskesmas','Kepala Unit','Staf Unit') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `NIP`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, '0', 'admin', '$2y$10$YMaizMZysm9CQHeFuL/L3uoAtGsLMepOdqZF6xGzJ4X3Uotp8f8AG', 'Administrator', '2024-12-23', '2024-12-23'),
(2, '198503122010011234', 'kepala_puskesmas', '$2y$10$hmutOTF5Qd60wY1PUZqADuYW62h1oT6YK64CaoO7MSNHKwdC5GTaO', 'Kepala Puskesmas', '2024-12-23', '2024-12-23'),
(3, '199207082001801901', 'kepala_unit', '$2y$10$dvquP5BijVCCVRhh/riZo.xI/9JBqo7P9YzJIBKQhhmOT8hv4g0.C', 'Kepala Unit', '2024-12-23', '2024-12-23'),
(4, '196912312000023456', 'staf_unit', '$2y$10$1PCPNZtbMOm.tt446ZK81ukhlnyGuRXIQ1pWT.VSK.6zZfP/rsy9q', 'Staf Unit', '2024-12-23', '2024-12-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `tbl_kerangka_kerja`
--
ALTER TABLE `tbl_kerangka_kerja`
  ADD PRIMARY KEY (`id_kak`),
  ADD KEY `id_proker` (`program_kerja`);

--
-- Indexes for table `tbl_kunjungan`
--
ALTER TABLE `tbl_kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD KEY `id_kak` (`id_kak`);

--
-- Indexes for table `tbl_lpj`
--
ALTER TABLE `tbl_lpj`
  ADD PRIMARY KEY (`id_lpj`),
  ADD KEY `id_kak` (`id_kak`);

--
-- Indexes for table `tbl_pagu_anggaran`
--
ALTER TABLE `tbl_pagu_anggaran`
  ADD PRIMARY KEY (`id_pagu_anggaran`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `NIP` (`NIP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kerangka_kerja`
--
ALTER TABLE `tbl_kerangka_kerja`
  MODIFY `id_kak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_kunjungan`
--
ALTER TABLE `tbl_kunjungan`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_lpj`
--
ALTER TABLE `tbl_lpj`
  MODIFY `id_lpj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pagu_anggaran`
--
ALTER TABLE `tbl_pagu_anggaran`
  MODIFY `id_pagu_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_lpj`
--
ALTER TABLE `tbl_lpj`
  ADD CONSTRAINT `tbl_lpj_ibfk_1` FOREIGN KEY (`id_kak`) REFERENCES `tbl_kerangka_kerja` (`id_kak`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
