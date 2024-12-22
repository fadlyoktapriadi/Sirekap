-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Des 2024 pada 15.38
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

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
-- Struktur dari tabel `tbl_kerangka_kerja`
--

CREATE TABLE `tbl_kerangka_kerja` (
  `id_kak` int(11) NOT NULL,
  `id_proker` int(11) NOT NULL,
  `nama_kegiatan` varchar(128) NOT NULL,
  `lokasi` varchar(128) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `anggaran_dibutuhkan` int(11) NOT NULL,
  `anggaran_disetujui` int(11) DEFAULT NULL,
  `penanggung_jawab` varchar(128) NOT NULL,
  `file` varchar(128) NOT NULL,
  `status` enum('Diproses','Diterima','Perbaikan','Ditolak','Selesai') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kerangka_kerja`
--

INSERT INTO `tbl_kerangka_kerja` (`id_kak`, `id_proker`, `nama_kegiatan`, `lokasi`, `tanggal_mulai`, `tanggal_selesai`, `anggaran_dibutuhkan`, `anggaran_disetujui`, `penanggung_jawab`, `file`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Imunisasi Vitamin B', 'Majalaya', '2024-12-22', '2024-12-31', 3000000, NULL, '199207082018019012', '1734806083_2ca88e14aa30b31e8265.docx', 'Diproses', '2024-12-21', '2024-12-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengguna`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id_pengguna`, `NIP`, `nama_pengguna`, `alamat`, `unit_kerja`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, '', 'admin', '', '', 'admin', '$2y$10$2la3rQIW0y7J8hkO4PAMdeE9L4.kq512P2eOnFnLDhTpxsGpXYIle', 'Administrator', '2024-12-18', '2024-12-18'),
(2, '198503122010011234', 'dr. Jajang Nurohmat', 'Komplek Bumi Asri, Blok B No. 5, Kecamatan Medan Satria, Kota Bekasi', '', 'kepala_puskesmas', '$2y$10$hmutOTF5Qd60wY1PUZqADuYW62h1oT6YK64CaoO7MSNHKwdC5GTaO', 'Kepala Puskesmas', '2024-12-18', '2024-12-18'),
(3, '199207082018019012', 'Pipiw Rosmana Dewi, S.kes', 'Jl. Anggrek Raya No. 12, Perumahan Harmoni Indah, Kota Bekasi', 'Esensial dan Keperawatan Kesehatan Masyarakat', 'kepala_unit', '$2y$10$dvquP5BijVCCVRhh/riZo.xI/9JBqo7P9YzJIBKQhhmOT8hv4g0.C', 'Kepala Unit', '2024-12-18', '2024-12-18'),
(4, '196912312000023456', 'Wawan Supriatno', 'Perum Griya Asri, Jl. Mawar, Kota Bandung', 'Esensial dan Keperawatan Kesehatan Masyarakat', 'staf_unit', '$2y$10$1PCPNZtbMOm.tt446ZK81ukhlnyGuRXIQ1pWT.VSK.6zZfP/rsy9q', 'Staf Unit', '2024-12-18', '2024-12-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_proker`
--

CREATE TABLE `tbl_proker` (
  `id_proker` int(11) NOT NULL,
  `nama_proker` varchar(128) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `tujuan` varchar(128) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_proker`
--

INSERT INTO `tbl_proker` (`id_proker`, `nama_proker`, `deskripsi`, `tujuan`, `created_at`, `updated_at`) VALUES
(1, 'Upaya Perbaikan Gizi', 'Upaya Perbaikan Gizi (UPG) adalah serangkaian kegiatan yang bertujuan untuk meningkatkan status gizi masyarakat, terutama pada kelompok rentan seperti ibu hamil, bayi, dan anak-anak.', 'Meningkatkan status gizi dan Perbaikan Pola makan', '2024-12-21', '2024-12-21');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_kerangka_kerja`
--
ALTER TABLE `tbl_kerangka_kerja`
  ADD PRIMARY KEY (`id_kak`),
  ADD KEY `id_proker` (`id_proker`);

--
-- Indeks untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `tbl_proker`
--
ALTER TABLE `tbl_proker`
  ADD PRIMARY KEY (`id_proker`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_kerangka_kerja`
--
ALTER TABLE `tbl_kerangka_kerja`
  MODIFY `id_kak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_proker`
--
ALTER TABLE `tbl_proker`
  MODIFY `id_proker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_kerangka_kerja`
--
ALTER TABLE `tbl_kerangka_kerja`
  ADD CONSTRAINT `tbl_kerangka_kerja_ibfk_1` FOREIGN KEY (`id_proker`) REFERENCES `tbl_proker` (`id_proker`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
