-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 30 Jan 2025 pada 11.00
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
-- Database: `sirekap`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `NIP` char(18) NOT NULL,
  `nama_karyawan` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `unit_kerja` enum('Esensial dan Keperawatan Kesehatan Masyarakat','Pengembangan','Kefarmasian & Laboratorium') NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`NIP`, `nama_karyawan`, `alamat`, `unit_kerja`, `jabatan`, `created_at`, `updated_at`) VALUES
('0', 'Administrator', '-', '', 'Admin', '2024-12-23', '2024-12-23'),
('196912312000023456', 'Wawan Supriatno', 'Perum Griya Asri, Jl. Mawar, Kota Bandung', 'Esensial dan Keperawatan Kesehatan Masyarakat', 'Staf', '2024-12-23', '2025-01-28'),
('197011011995011002', 'Rere Jayabaya Sitepu, S.Kes.', 'Komp. Citra Damai Indah Blok.A4, Ciamis, Bekasi Barat', 'Kefarmasian & Laboratorium', 'Staf', '2025-01-17', '2025-01-18'),
('197501221991041001', 'Herman Gultom, S.Kes', 'Jl. Merdeka Barat Daya No.33, Buah Batu, Bandung', 'Kefarmasian & Laboratorium', 'Kepala Unit', '2025-01-17', '2025-01-17'),
('198501012008121001', 'Dr. Siti Nurhaliza, Sp.M', 'Jl. Kesehatan No. 12, Kota Medan', 'Pengembangan', 'Kepala Unit', '2025-01-18', '2025-01-18'),
('198503122010011234', 'dr. Jajang Nurohmat', 'Komplek Bumi Asri, Blok B No. 5, Kecamatan Medan Satria, Kota Bekasi', '', 'Kepala Puskesmas', '2024-12-23', '2024-12-23'),
('199002022015032002', 'Siska Sihotang, S.Kep., Ners', 'Perumahan Griya Sehat Blok A No. 5, Kabupaten Bogor', 'Pengembangan', 'Staf  Unit', '2025-01-18', '2025-01-18'),
('199207082001801901', 'Pipiw Rosmana Dewi, S.kes', 'Jl. Anggrek Raya No. 12, Perumahan Harmoni Indah, Kota Bekasi', 'Esensial dan Keperawatan Kesehatan Masyarakat', 'Kepala Unit', '2024-12-23', '2025-01-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kerangka_kerja`
--

CREATE TABLE `tbl_kerangka_kerja` (
  `id_kak` int NOT NULL,
  `program_kerja` varchar(128) NOT NULL,
  `nama_kegiatan` varchar(128) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `anggaran_dibutuhkan` int NOT NULL,
  `anggaran_disetujui` int DEFAULT NULL,
  `penanggung_jawab` varchar(128) NOT NULL,
  `sasaran` varchar(128) NOT NULL,
  `target` int NOT NULL,
  `file` varchar(128) NOT NULL,
  `status` enum('Diproses','Diterima','Menunggu Persetujuan LPJ','Perlu Perbaikan KAK','Perlu Perbaikan LPJ','KAK Ditolak','LPJ Ditolak','Selesai') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `catatan_status` varchar(256) DEFAULT NULL,
  `tanggal_diterima` date DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `tbl_kerangka_kerja`
--

INSERT INTO `tbl_kerangka_kerja` (`id_kak`, `program_kerja`, `nama_kegiatan`, `tanggal_mulai`, `tanggal_selesai`, `anggaran_dibutuhkan`, `anggaran_disetujui`, `penanggung_jawab`, `sasaran`, `target`, `file`, `status`, `catatan_status`, `tanggal_diterima`, `created_at`, `updated_at`) VALUES
(1, 'Pencegahan Tunawicara Anak', 'Imunisasi Vitamin B', '2025-02-01', '2025-02-28', 10000000, NULL, '199002022015032002', 'Balita dan Dibawah Anak Usia 12 Tahun', 150, 'Imunisasi_Vitamin_B67991bdcb9b9d.docx', 'Diproses', NULL, NULL, '2025-01-28', '2025-01-28'),
(2, 'Pencegahan Obat non BPOM', 'Penyuluhan Obat Herbal', '2025-02-01', '2025-02-28', 15000000, 13000000, '197501221991041001', 'Umum', 100, 'Penyuluhan_Obat_Herbal67991ef2ad936.docx', 'Diterima', NULL, '2025-01-28', '2025-01-28', '2025-01-28'),
(3, 'Pencegahan Stunting', 'Imunisasi Vitamin A', '2025-02-20', '2025-02-28', 8000000, 8000000, '199207082001801901', 'Balita dan Dibawah Anak Usia 12 Tahun', 120, 'Imunisasi_Vitamin_C67991f8de3876.docx', 'Selesai', NULL, '2025-01-28', '2025-01-28', '2025-01-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kunjungan`
--

CREATE TABLE `tbl_kunjungan` (
  `id_kunjungan` int NOT NULL,
  `id_kak` int NOT NULL,
  `nama_desa` varchar(128) NOT NULL,
  `jumlah_kunjungan` int NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `tbl_kunjungan`
--

INSERT INTO `tbl_kunjungan` (`id_kunjungan`, `id_kak`, `nama_desa`, `jumlah_kunjungan`, `created_at`, `updated_at`) VALUES
(1, 3, 'Burujul Kulon', 15, '2025-01-28', '2025-01-28'),
(2, 3, 'Burujul Wetan', 15, '2025-01-28', '2025-01-28'),
(3, 3, 'Cicadas', 20, '2025-01-28', '2025-01-28'),
(4, 3, 'Jatisura', 15, '2025-01-28', '2025-01-28'),
(5, 3, 'Jatiwangi', 10, '2025-01-28', '2025-01-28'),
(6, 3, 'Mekarsari', 10, '2025-01-28', '2025-01-28'),
(7, 3, 'Surawangi', 15, '2025-01-28', '2025-01-28'),
(8, 3, 'Sutawangi', 10, '2025-01-28', '2025-01-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_lpj`
--

CREATE TABLE `tbl_lpj` (
  `id_lpj` int NOT NULL,
  `id_kak` int NOT NULL,
  `anggaran_digunakan` int NOT NULL,
  `keterangan` text NOT NULL,
  `catatan` text,
  `file_lpj` varchar(128) NOT NULL,
  `dokumentasi` varchar(128) NOT NULL,
  `lpj_selesai` date DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `tbl_lpj`
--

INSERT INTO `tbl_lpj` (`id_lpj`, `id_kak`, `anggaran_digunakan`, `keterangan`, `catatan`, `file_lpj`, `dokumentasi`, `lpj_selesai`, `created_at`, `updated_at`) VALUES
(1, 3, 8000000, 'ngga ada hehe', 'Aman bang', 'LPJ_679958d87e88d.docx', 'Dokumentasi_679958d87f0c3.jpg', '2025-01-28', '2025-01-28', '2025-01-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pagu_anggaran`
--

CREATE TABLE `tbl_pagu_anggaran` (
  `id_pagu_anggaran` int NOT NULL,
  `jumlah_anggaran` int NOT NULL,
  `balance` int NOT NULL,
  `tahun_anggaran` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `tbl_pagu_anggaran`
--

INSERT INTO `tbl_pagu_anggaran` (`id_pagu_anggaran`, `jumlah_anggaran`, `balance`, `tahun_anggaran`, `created_at`, `updated_at`) VALUES
(2, 100000000, 87000000, '2025', '2025-01-27', '2025-01-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_riwayat_anggaran`
--

CREATE TABLE `tbl_riwayat_anggaran` (
  `id_riwayat_anggaran` int NOT NULL,
  `id_kak` int NOT NULL,
  `jumlah_anggaran` int NOT NULL,
  `label_anggaran` enum('Masuk','Keluar') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `tbl_riwayat_anggaran`
--

INSERT INTO `tbl_riwayat_anggaran` (`id_riwayat_anggaran`, `id_kak`, `jumlah_anggaran`, `label_anggaran`, `created_at`, `updated_at`) VALUES
(6, 3, 8000000, 'Keluar', '2025-01-28', '2025-01-28'),
(7, 2, 13000000, 'Keluar', '2025-01-28', '2025-01-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` int NOT NULL,
  `NIP` char(18) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('Administrator','Kepala Puskesmas','Kepala Unit','Staf Unit') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `NIP`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, '0', 'admin', '$2y$10$YMaizMZysm9CQHeFuL/L3uoAtGsLMepOdqZF6xGzJ4X3Uotp8f8AG', 'Administrator', '2024-12-23', '2024-12-23'),
(2, '198503122010011234', 'kepala_puskesmas', '$2y$10$hmutOTF5Qd60wY1PUZqADuYW62h1oT6YK64CaoO7MSNHKwdC5GTaO', 'Kepala Puskesmas', '2024-12-23', '2024-12-23'),
(3, '199207082001801901', 'kepala_pipiw', '$2y$10$CXmlMpgjoxxNdm.U.I9peunpJ2hWQCEP86sJyQiFNaU9fjjeQESzW', 'Kepala Unit', '2024-12-23', '2025-01-30'),
(4, '196912312000023456', 'staf_wawan', '$2y$10$1PCPNZtbMOm.tt446ZK81ukhlnyGuRXIQ1pWT.VSK.6zZfP/rsy9q', 'Staf Unit', '2024-12-23', '2025-01-28'),
(7, '197501221991041001', 'kepala_herman', '$2y$10$Y884yCPsljRChTW4P59dJeQVNQmBC79Vt9tw3JIb7rFyb5JrPEhXG', 'Kepala Unit', '2025-01-17', '2025-01-17'),
(8, '197011011995011002', 'staf_rere', '$2y$10$D0QKrW8U5TjXOVo.Ciegjes0HrGbng8nPtC94YcEPBDCFcsZZ7q4O', 'Staf Unit', '2025-01-17', '2025-01-18'),
(9, '198501012008121001', 'kepala_siti', '$2y$10$H5i96nNivqarEXvNVv0FlODR/GfEV5VbcbwjX215Lz4HnU38Rczku', 'Kepala Unit', '2025-01-18', '2025-01-18'),
(10, '199002022015032002', 'staf_siska', '$2y$10$RLG7Z1mucNVzpuD7G2QXTenZ7KpMRrmRFh1FtMxwTOkAmqKOhJi92', 'Staf Unit', '2025-01-18', '2025-01-18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`NIP`);

--
-- Indeks untuk tabel `tbl_kerangka_kerja`
--
ALTER TABLE `tbl_kerangka_kerja`
  ADD PRIMARY KEY (`id_kak`),
  ADD KEY `id_proker` (`program_kerja`);

--
-- Indeks untuk tabel `tbl_kunjungan`
--
ALTER TABLE `tbl_kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD KEY `id_kak` (`id_kak`);

--
-- Indeks untuk tabel `tbl_lpj`
--
ALTER TABLE `tbl_lpj`
  ADD PRIMARY KEY (`id_lpj`),
  ADD KEY `id_kak` (`id_kak`);

--
-- Indeks untuk tabel `tbl_pagu_anggaran`
--
ALTER TABLE `tbl_pagu_anggaran`
  ADD PRIMARY KEY (`id_pagu_anggaran`);

--
-- Indeks untuk tabel `tbl_riwayat_anggaran`
--
ALTER TABLE `tbl_riwayat_anggaran`
  ADD PRIMARY KEY (`id_riwayat_anggaran`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `NIP` (`NIP`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_kerangka_kerja`
--
ALTER TABLE `tbl_kerangka_kerja`
  MODIFY `id_kak` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_kunjungan`
--
ALTER TABLE `tbl_kunjungan`
  MODIFY `id_kunjungan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_lpj`
--
ALTER TABLE `tbl_lpj`
  MODIFY `id_lpj` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_pagu_anggaran`
--
ALTER TABLE `tbl_pagu_anggaran`
  MODIFY `id_pagu_anggaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_riwayat_anggaran`
--
ALTER TABLE `tbl_riwayat_anggaran`
  MODIFY `id_riwayat_anggaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_lpj`
--
ALTER TABLE `tbl_lpj`
  ADD CONSTRAINT `tbl_lpj_ibfk_1` FOREIGN KEY (`id_kak`) REFERENCES `tbl_kerangka_kerja` (`id_kak`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
