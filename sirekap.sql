-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 10:23 AM
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
-- Table structure for table `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `NIP` varchar(18) NOT NULL,
  `nama_pengguna` varchar(256) NOT NULL,
  `alamat` text NOT NULL,
  `unit_kerja` enum('Esensial dan Keperawatan Kesehatan Masyarakat','Pengembangan','Kefarmasian & Laboratorium') DEFAULT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('Administrator','Kepala Puskesmas','Kepala Unit','Staf Unit') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id_pengguna`, `NIP`, `nama_pengguna`, `alamat`, `unit_kerja`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, '', 'admin', '', '', 'admin', '$2y$10$2la3rQIW0y7J8hkO4PAMdeE9L4.kq512P2eOnFnLDhTpxsGpXYIle', 'Administrator', '2024-12-18', '2024-12-18'),
(2, '198503122010011234', 'dr. Jajang Nurohmat', 'Komplek Bumi Asri, Blok B No. 5, Kecamatan Medan Satria, Kota Bekasi', '', 'kepala_puskesmas', '$2y$10$hmutOTF5Qd60wY1PUZqADuYW62h1oT6YK64CaoO7MSNHKwdC5GTaO', 'Kepala Puskesmas', '2024-12-18', '2024-12-18'),
(3, '199207082018019012', 'Pipiw Rosmana Dewi, S.kes', 'Jl. Anggrek Raya No. 12, Perumahan Harmoni Indah, Kota Bekasi', 'Esensial dan Keperawatan Kesehatan Masyarakat', 'kepala_unit', '$2y$10$dvquP5BijVCCVRhh/riZo.xI/9JBqo7P9YzJIBKQhhmOT8hv4g0.C', 'Kepala Unit', '2024-12-18', '2024-12-18'),
(4, '196912312000023456', 'Wawan Supriatno', 'Perum Griya Asri, Jl. Mawar, Kota Bandung', 'Esensial dan Keperawatan Kesehatan Masyarakat', 'staf_unit', '$2y$10$1PCPNZtbMOm.tt446ZK81ukhlnyGuRXIQ1pWT.VSK.6zZfP/rsy9q', 'Staf Unit', '2024-12-18', '2024-12-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
