-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Des 2024 pada 07.44
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `data_polri`
--

CREATE TABLE `data_polri` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `id_napi` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `unggah_foto` varchar(255) NOT NULL,
  `isi_laporan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_laporan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_polri`
--

INSERT INTO `data_polri` (`id`, `nama`, `nik`, `id_napi`, `alamat`, `unggah_foto`, `isi_laporan`, `created_at`, `tanggal_laporan`) VALUES
(1, 'nama', '1111111111111111', '123', 'qwe', 'uploads/6763baf87d618.jpeg', 'qwe', '2024-12-19 06:19:36', '2025-01-02'),
(2, 'niko', '1111111111111111', '234', 'ruko', 'uploads/6763bb41314c0.jpeg', 'weok', '2024-12-19 06:20:49', '2024-12-18'),
(3, 'rafi', '1111111111111111', '123', 'qwe', 'uploads/6763bcb4c93e1.jpeg', 'qwe', '2024-12-19 06:27:00', '2024-12-20'),
(4, 'nama', '1111111111111111', 'qwe', 'qwe', 'uploads/6763bedb289fb.jpeg', 'qwe', '2024-12-19 06:36:11', '2024-12-14'),
(5, 'Ardel ganteng', '1111111111111111', 'awikwok', '123', '/wetrack/polri/uploads/6764ca13306d7.png', '12343', '2024-12-20 01:36:19', '2024-12-20'),
(6, 'ardel ganteng 20 dec', '1111111111111111', 'awikwok', 'ardel ganteng 20 dec', '/wetrack/polri/uploads/6764cbb8be624.jpg', 'ardel ganteng 20 dec', '2024-12-20 01:43:20', '2024-12-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `final_report`
--

CREATE TABLE `final_report` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nrt` varchar(20) NOT NULL,
  `docInput` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `final_report`
--

INSERT INTO `final_report` (`id`, `nik`, `nrt`, `docInput`, `created_at`) VALUES
(1, '78978979', '123189481', 'uploads/stakeholder-engagement-plan-template.pdf', '2024-12-19 19:04:06'),
(2, '1234', '1234', 'uploads/WBS-Kelompok 4.xlsx - WBS with Gantt Chart - WETRACK.pdf', '2024-12-19 19:12:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login_history`
--

INSERT INTO `login_history` (`id`, `user_id`, `login_time`, `ip_address`) VALUES
(1, 1000001, '2024-12-20 14:28:05', '::1'),
(2, 1000001, '2024-12-20 14:29:04', '::1'),
(3, 1000005, '2024-12-20 14:31:56', '::1'),
(4, 1000001, '2024-12-20 14:47:57', '::1'),
(5, 1000001, '2024-12-20 15:12:20', '::1'),
(6, 1000005, '2024-12-20 15:21:08', '::1'),
(10, 1000001, '2024-12-20 17:17:50', '::1'),
(12, 1000001, '2024-12-20 17:22:06', '::1'),
(13, 1000001, '2024-12-20 17:30:25', '::1'),
(14, 1000001, '2024-12-20 17:33:07', '::1'),
(15, 1000001, '2024-12-20 17:35:19', '::1'),
(17, 1000001, '2024-12-20 17:59:09', '::1'),
(18, 1000001, '2024-12-21 04:16:05', '::1'),
(19, 1000001, '2024-12-21 06:11:37', '::1'),
(20, 1000001, '2024-12-21 06:39:34', '::1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mantan_narapidana`
--

CREATE TABLE `mantan_narapidana` (
  `id` int(11) NOT NULL,
  `fileInput` varchar(255) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nrt` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `dateBirth` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `crime` enum('TwA','Ot','Fraud','Assault','NO','Embezzlement','MvT','Robbery','Brawling') DEFAULT NULL,
  `case` text DEFAULT NULL,
  `punishment` varchar(100) DEFAULT NULL,
  `releaseDate` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mantan_narapidana`
--

INSERT INTO `mantan_narapidana` (`id`, `fileInput`, `nik`, `nrt`, `nama`, `dateBirth`, `address`, `gender`, `nationality`, `crime`, `case`, `punishment`, `releaseDate`, `created_at`) VALUES
(1, 'uploads/nanti-diganti.png', '892189', '123141', 'yanto', '2024-12-03', 'jakal', 'male', 'Jamaica', 'Embezzlement', 'tersangka', '5 years', '2028-12-06', '2024-12-18 15:53:43'),
(2, 'uploads/nanti-diganti.png', '1245', '66666', 'jokowi', '2013-06-30', 'solo', 'male', 'Indonesia', 'NO', 'pengedar', '100000 years', '2047-05-27', '2024-12-18 15:55:37'),
(3, 'uploads/lapas-logo.png', '1234', '1234', 'anjay', '2024-12-18', 'kepo', 'male', 'Indonesia', 'Assault', 'nusuk', '10000', '2024-12-19', '2024-12-19 00:00:21'),
(4, 'uploads/lapas-logo.png', '78978979', '123189481', 'Joko', '2002-02-28', 'Jl. Jakal', 'male', 'Belgium', 'NO', 'Pengedar', '100 Years', '2025-01-22', '2024-12-19 03:09:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `recent_activities`
--

CREATE TABLE `recent_activities` (
  `id` int(11) NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `action_description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `recent_activities`
--

INSERT INTO `recent_activities` (`id`, `action_type`, `action_description`, `created_at`) VALUES
(1, 'report', 'Final report created for NRT: 66666', '2024-12-19 19:45:21'),
(2, 'account_creation', 'New Lapas account created: Ardel', '2024-12-20 15:27:39'),
(3, 'account_creation', 'New Lapas account created: Ardel', '2024-12-20 15:32:11'),
(4, 'account_creation', 'New Lapas account created: Ardel', '2024-12-20 15:32:20'),
(5, 'account_creation', 'New Lapas account created: Ardel', '2024-12-20 15:35:19'),
(6, 'account_creation', 'New Lapas account created: abdul', '2024-12-20 15:36:33'),
(7, 'account_creation', 'New Bapas account created: Ardel', '2024-12-20 15:42:19'),
(8, 'account_creation', 'New Polri account created: Ardel', '2024-12-20 15:42:44'),
(9, 'account_creation', 'New Polri account created: Ardel', '2024-12-20 16:19:10'),
(10, 'account_creation', 'New Polri account created: Ardel', '2024-12-20 16:20:20'),
(11, 'account_creation', 'New Polri account created: Ardel', '2024-12-20 16:20:31'),
(12, 'account_creation', 'New Bapas account created: abdul', '2024-12-20 16:21:21'),
(13, 'account_creation', 'New Bapas account created: abdul', '2024-12-20 16:21:25'),
(14, 'account_creation', 'New Bapas account created: abdul', '2024-12-20 16:23:28'),
(15, 'account_creation', 'New Bapas account created: abdul', '2024-12-20 16:23:54'),
(16, 'account_creation', 'New Bapas account created: awiawko', '2024-12-20 16:24:46'),
(17, 'account_creation', 'New Polri account created: awiawko', '2024-12-20 16:29:07'),
(18, 'account_creation', 'New Polri account created: abdul', '2024-12-20 16:31:50'),
(19, 'account_creation', 'New Polri account created: awikwik', '2024-12-20 17:08:07'),
(20, 'account_creation', 'New Polri account created: abdul qadir', '2024-12-20 18:00:14'),
(21, 'account_creation', 'New Polri account created: King ABDUL', '2024-12-21 03:38:25'),
(22, 'account_creation', 'New Polri account created: Ardel', '2024-12-21 06:30:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `profile_picture` varchar(255) DEFAULT '/wetrack/kemenkumham/image/kemenkumham.png',
  `nip` varchar(50) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `role` enum('Kemenkumham','Lapas','Bapas','Polri') NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `position` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `profile_picture`, `nip`, `full_name`, `place_of_birth`, `date_of_birth`, `religion`, `region`, `role`, `email`, `phone`, `address`, `status`, `created_by`, `created_at`, `position`, `password`, `gender`) VALUES
(1000001, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', NULL),
(1000002, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', NULL),
(1000003, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', NULL),
(1000004, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', NULL),
(1000005, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_polri`
--
ALTER TABLE `data_polri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `final_report`
--
ALTER TABLE `final_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik_nrt` (`nik`,`nrt`);

--
-- Indeks untuk tabel `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indeks untuk tabel `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nik_nrt` (`nik`,`nrt`);

--
-- Indeks untuk tabel `recent_activities`
--
ALTER TABLE `recent_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_created_by` (`created_by`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_polri`
--
ALTER TABLE `data_polri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `final_report`
--
ALTER TABLE `final_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `recent_activities`
--
ALTER TABLE `recent_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `final_report`
--
ALTER TABLE `final_report`
  ADD CONSTRAINT `final_report_ibfk_1` FOREIGN KEY (`nik`,`nrt`) REFERENCES `mantan_narapidana` (`nik`, `nrt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `fk_user_login_history` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
