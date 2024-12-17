-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 05:13 PM
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
-- Database: `wetrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `bapas`
--

CREATE TABLE `bapas` (
  `id_pegawai_bapas` int(11) NOT NULL,
  `nip_pegawai_bapas` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `penempatan` varchar(100) NOT NULL,
  `tanggal_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `check_in`
--

CREATE TABLE `check_in` (
  `id_check_in` int(11) NOT NULL,
  `id_mantan_narapidana` int(11) NOT NULL,
  `garis_lintang` decimal(10,6) NOT NULL,
  `garis_bujur` decimal(10,6) NOT NULL,
  `waktu_check_in` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lapas`
--

CREATE TABLE `lapas` (
  `id_pegawai_lapas` int(11) NOT NULL,
  `nip_pegawai_lapas` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `penempatan` varchar(100) NOT NULL,
  `tanggal_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_akhir`
--

CREATE TABLE `laporan_akhir` (
  `id_laporan_akhir` int(11) NOT NULL,
  `id_mantan_narapidana` int(20) NOT NULL,
  `status_akhir_narapidana` enum('Bebas','Mengulang pengawasan') NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `tanggal_dibuat` datetime NOT NULL,
  `status_laporan` enum('Selesai','Diproses') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mantan_narapidana`
--

CREATE TABLE `mantan_narapidana` (
  `id_mantan_narapidana` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `id_pegawai_bapas` int(11) NOT NULL,
  `id_polisi` int(11) NOT NULL,
  `nomor_kartu_keluarga` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_narapidana` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `foto` varchar(100) NOT NULL,
  `garis_bujur_batas_wilayah` decimal(10,6) NOT NULL,
  `garis_bujur_lintang_wilayah` decimal(10,6) NOT NULL,
  `radius_batas_wilayah` decimal(10,2) NOT NULL,
  `waktu_mulai_jam_malam` time NOT NULL,
  `waktu_berakhir_jam_malam` time NOT NULL,
  `status_jam_malam` enum('Aktif','Tidak aktif') NOT NULL,
  `status_narapidana` enum('Dalam pengawasan','Bebas') NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peringatan`
--

CREATE TABLE `peringatan` (
  `id_peringatan` int(11) NOT NULL,
  `tipe_peringatan` enum('Membutuhkan tindakan','Tidak membutuhkan tindakan') NOT NULL,
  `deskripsi` text NOT NULL,
  `waktu-dibuat` datetime NOT NULL,
  `status_tindakan` enum('selesai','diproses') NOT NULL,
  `id_mantan_narapidana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polisi`
--

CREATE TABLE `polisi` (
  `id_polisi` int(11) NOT NULL,
  `nrp_polisi` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `penempatan` varchar(100) NOT NULL,
  `tanggal_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_kejahatan`
--

CREATE TABLE `riwayat_kejahatan` (
  `id_riwayat_kejahatan` int(11) NOT NULL,
  `id_mantan_narapidana` int(11) NOT NULL,
  `riwayat_kejahatan` text NOT NULL,
  `waktu_kejahatan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pelanggaran`
--

CREATE TABLE `riwayat_pelanggaran` (
  `id_riwayat_pelanggaran` int(11) NOT NULL,
  `id_mantan_narapidana` int(11) NOT NULL,
  `riwayat_pelanggaran` text NOT NULL,
  `waktu_pelanggaran` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id_super_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tanggal_dibuat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bapas`
--
ALTER TABLE `bapas`
  ADD PRIMARY KEY (`id_pegawai_bapas`),
  ADD UNIQUE KEY `id_pegawai_bapas` (`id_pegawai_bapas`),
  ADD UNIQUE KEY `idx_bapas_nip_pegawai` (`nip_pegawai_bapas`),
  ADD UNIQUE KEY `idx_bapas_email` (`email`),
  ADD UNIQUE KEY `idx_bapas_username` (`username`);

--
-- Indexes for table `check_in`
--
ALTER TABLE `check_in`
  ADD PRIMARY KEY (`id_check_in`),
  ADD KEY `fk_id_mantan_narapidana_check_in` (`id_mantan_narapidana`);

--
-- Indexes for table `lapas`
--
ALTER TABLE `lapas`
  ADD PRIMARY KEY (`id_pegawai_lapas`),
  ADD UNIQUE KEY `idx_lapas_nip_pegawai` (`nip_pegawai_lapas`),
  ADD UNIQUE KEY `idx_lapas_email` (`email`),
  ADD UNIQUE KEY `idx_lapas_username` (`username`);

--
-- Indexes for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  ADD PRIMARY KEY (`id_laporan_akhir`),
  ADD KEY `fk_id_mantan_narapidana_laporan_akhir` (`id_mantan_narapidana`);

--
-- Indexes for table `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  ADD PRIMARY KEY (`id_mantan_narapidana`),
  ADD UNIQUE KEY `id_mantan_narapidana` (`id_mantan_narapidana`,`nik`),
  ADD KEY `fk_id_polisi` (`id_pegawai_bapas`);

--
-- Indexes for table `peringatan`
--
ALTER TABLE `peringatan`
  ADD PRIMARY KEY (`id_peringatan`),
  ADD KEY `fk_id_mantan_narapidana_peringatan` (`id_mantan_narapidana`);

--
-- Indexes for table `polisi`
--
ALTER TABLE `polisi`
  ADD PRIMARY KEY (`id_polisi`),
  ADD UNIQUE KEY `idx_polisi_nrp_polisi` (`nrp_polisi`),
  ADD UNIQUE KEY `idx_polisi_email` (`email`),
  ADD UNIQUE KEY `idx_polisi_username` (`username`);

--
-- Indexes for table `riwayat_kejahatan`
--
ALTER TABLE `riwayat_kejahatan`
  ADD PRIMARY KEY (`id_riwayat_kejahatan`),
  ADD KEY `fk_id_mantan_narapidana_riwayat_kejahatan` (`id_mantan_narapidana`);

--
-- Indexes for table `riwayat_pelanggaran`
--
ALTER TABLE `riwayat_pelanggaran`
  ADD PRIMARY KEY (`id_riwayat_pelanggaran`),
  ADD KEY `fk_id_mantan_narapidana_riwayat_pelanggaran` (`id_mantan_narapidana`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id_super_admin`),
  ADD UNIQUE KEY `idx_super_admin_username` (`username`),
  ADD UNIQUE KEY `idx_super_admin_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bapas`
--
ALTER TABLE `bapas`
  MODIFY `id_pegawai_bapas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `check_in`
--
ALTER TABLE `check_in`
  MODIFY `id_check_in` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lapas`
--
ALTER TABLE `lapas`
  MODIFY `id_pegawai_lapas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  MODIFY `id_laporan_akhir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  MODIFY `id_mantan_narapidana` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peringatan`
--
ALTER TABLE `peringatan`
  MODIFY `id_peringatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polisi`
--
ALTER TABLE `polisi`
  MODIFY `id_polisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_kejahatan`
--
ALTER TABLE `riwayat_kejahatan`
  MODIFY `id_riwayat_kejahatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_pelanggaran`
--
ALTER TABLE `riwayat_pelanggaran`
  MODIFY `id_riwayat_pelanggaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id_super_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `check_in`
--
ALTER TABLE `check_in`
  ADD CONSTRAINT `fk_id_mantan_narapidana_check_in` FOREIGN KEY (`id_mantan_narapidana`) REFERENCES `mantan_narapidana` (`id_mantan_narapidana`);

--
-- Constraints for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  ADD CONSTRAINT `fk_id_mantan_narapidana_laporan_akhir` FOREIGN KEY (`id_mantan_narapidana`) REFERENCES `mantan_narapidana` (`id_mantan_narapidana`);

--
-- Constraints for table `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  ADD CONSTRAINT `fk_id_bapas` FOREIGN KEY (`id_pegawai_bapas`) REFERENCES `bapas` (`id_pegawai_bapas`),
  ADD CONSTRAINT `fk_id_polisi` FOREIGN KEY (`id_pegawai_bapas`) REFERENCES `polisi` (`id_polisi`);

--
-- Constraints for table `peringatan`
--
ALTER TABLE `peringatan`
  ADD CONSTRAINT `fk_id_mantan_narapidana_peringatan` FOREIGN KEY (`id_mantan_narapidana`) REFERENCES `mantan_narapidana` (`id_mantan_narapidana`);

--
-- Constraints for table `riwayat_kejahatan`
--
ALTER TABLE `riwayat_kejahatan`
  ADD CONSTRAINT `fk_id_mantan_narapidana_riwayat_kejahatan` FOREIGN KEY (`id_mantan_narapidana`) REFERENCES `mantan_narapidana` (`id_mantan_narapidana`);

--
-- Constraints for table `riwayat_pelanggaran`
--
ALTER TABLE `riwayat_pelanggaran`
  ADD CONSTRAINT `fk_id_mantan_narapidana_riwayat_pelanggaran` FOREIGN KEY (`id_mantan_narapidana`) REFERENCES `mantan_narapidana` (`id_mantan_narapidana`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
