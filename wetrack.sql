-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< Updated upstream
-- Generation Time: Dec 21, 2024 at 05:55 AM
=======
-- Generation Time: Dec 20, 2024 at 03:26 PM
>>>>>>> Stashed changes
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
-- Table structure for table `data_polri`
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
-- Dumping data for table `data_polri`
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
-- Table structure for table `final_report`
--

CREATE TABLE `final_report` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nrt` varchar(20) NOT NULL,
  `docInput` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< Updated upstream
-- --------------------------------------------------------

--
-- Table structure for table `kemenkumham_users`
--

CREATE TABLE `kemenkumham_users` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT '/wetrack/kemenkumham/image/kemenkumham.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kemenkumham_users`
--

INSERT INTO `kemenkumham_users` (`id`, `password`, `profile_picture`) VALUES
(1000001, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', '/wetrack/kemenkumham/image/kemenkumham.png'),
(1000002, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', '/wetrack/kemenkumham/image/kemenkumham.png'),
(1000003, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', '/wetrack/kemenkumham/image/kemenkumham.png'),
(1000004, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', '/wetrack/kemenkumham/image/kemenkumham.png'),
(1000005, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', '/wetrack/kemenkumham/image/kemenkumham.png');
=======
--
-- Dumping data for table `final_report`
--

INSERT INTO `final_report` (`id`, `nik`, `nrt`, `docInput`, `created_at`) VALUES
(1, '78978979', '123189481', 'uploads/stakeholder-engagement-plan-template.pdf', '2024-12-19 19:04:06'),
(2, '1234', '1234', 'uploads/WBS-Kelompok 4.xlsx - WBS with Gantt Chart - WETRACK.pdf', '2024-12-19 19:12:56');
>>>>>>> Stashed changes

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mantan_narapidana`
--

CREATE TABLE `mantan_narapidana` (
  `id` int(11) NOT NULL,
<<<<<<< Updated upstream
  `fileInput` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nrt` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `dateBirth` date NOT NULL,
  `address` text NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `crime` enum('TwA','Ot','Fraud','Assault','NO','Embezzlement','MvT','Robbery','Brawling') NOT NULL,
  `case` text NOT NULL,
  `punishment` varchar(100) NOT NULL,
  `releaseDate` date NOT NULL,
  `report` text NOT NULL,
  `action` tinyint(1) NOT NULL COMMENT '1 for accept, 0 for reject',
=======
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
>>>>>>> Stashed changes
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mantan_narapidana`
--

<<<<<<< Updated upstream
INSERT INTO `mantan_narapidana` (`id`, `fileInput`, `nik`, `nrt`, `nama`, `dateBirth`, `address`, `gender`, `nationality`, `crime`, `case`, `punishment`, `releaseDate`, `report`, `action`, `created_at`) VALUES
(4, 'uploads/lapas-logo.png', '78978979', '123189481', 'Joko', '2002-02-28', 'Jl. Jakal', 'male', 'Belgium', 'NO', 'Pengedar', '100 Years', '2025-01-22', '', 0, '2024-12-19 03:09:25'),
(5, 'uploads/tahanan1.webp', '1230000000000000', '0001', 'Ferdy Sambo', '1969-08-29', 'Jakarta Utara', 'male', 'Belgium', 'Brawling', 'Tersangka ', '10 Tahun', '2034-12-21', '', 0, '2024-12-21 00:04:38'),
(6, 'uploads/tahanan2.jpeg', '1000000000000000', '0002', 'Anthony Santos', '2001-06-06', 'Jakal Km 14', 'male', 'Brazil', 'Robbery', 'Tersangka', '5 tahun', '2029-12-21', '', 0, '2024-12-21 04:08:31');

-- --------------------------------------------------------

--
-- Table structure for table `prisoner_locations`
--

CREATE TABLE `prisoner_locations` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nrt` varchar(20) NOT NULL,
  `type` enum('houseArrest','cityPrisoner') NOT NULL,
  `radius` float DEFAULT NULL,
  `center_lat` decimal(10,8) DEFAULT NULL,
  `center_lng` decimal(11,8) DEFAULT NULL,
  `city_district` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
INSERT INTO `mantan_narapidana` (`id`, `fileInput`, `nik`, `nrt`, `nama`, `dateBirth`, `address`, `gender`, `nationality`, `crime`, `case`, `punishment`, `releaseDate`, `created_at`) VALUES
(1, 'uploads/nanti-diganti.png', '892189', '123141', 'yanto', '2024-12-03', 'jakal', 'male', 'Jamaica', 'Embezzlement', 'tersangka', '5 years', '2028-12-06', '2024-12-18 15:53:43'),
(2, 'uploads/nanti-diganti.png', '1245', '66666', 'jokowi', '2013-06-30', 'solo', 'male', 'Indonesia', 'NO', 'pengedar', '100000 years', '2047-05-27', '2024-12-18 15:55:37'),
(3, 'uploads/lapas-logo.png', '1234', '1234', 'anjay', '2024-12-18', 'kepo', 'male', 'Indonesia', 'Assault', 'nusuk', '10000', '2024-12-19', '2024-12-19 00:00:21'),
(4, 'uploads/lapas-logo.png', '78978979', '123189481', 'Joko', '2002-02-28', 'Jl. Jakal', 'male', 'Belgium', 'NO', 'Pengedar', '100 Years', '2025-01-22', '2024-12-19 03:09:25');
>>>>>>> Stashed changes

-- --------------------------------------------------------

--
-- Table structure for table `recent_activities`
--

CREATE TABLE `recent_activities` (
  `id` int(11) NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `action_description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recent_activities`
--

INSERT INTO `recent_activities` (`id`, `action_type`, `action_description`, `created_at`) VALUES
<<<<<<< Updated upstream
(1, 'report', 'Final report created for NRT: 66666', '2024-12-20 02:45:21'),
(2, 'create', 'New user account created: Ferdy Sambo', '2024-12-21 00:04:38'),
(3, 'create', 'New user account created: Anthony Santos', '2024-12-21 04:08:31');
=======
(1, 'report', 'Final report created for NRT: 66666', '2024-12-19 19:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_picture`, `nip`, `full_name`, `place_of_birth`, `date_of_birth`, `religion`, `region`, `role`, `email`, `phone`, `address`, `status`, `created_by`, `created_at`, `position`, `password`) VALUES
(1000001, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu'),
(1000002, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu'),
(1000003, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu'),
(1000004, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu'),
(1000005, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu');
>>>>>>> Stashed changes

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_polri`
--
ALTER TABLE `data_polri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_report`
--
ALTER TABLE `final_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik_nrt` (`nik`,`nrt`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nik_nrt` (`nik`,`nrt`);

--
-- Indexes for table `prisoner_locations`
--
ALTER TABLE `prisoner_locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nik_nrt` (`nik`,`nrt`);

--
-- Indexes for table `recent_activities`
--
ALTER TABLE `recent_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_polri`
--
ALTER TABLE `data_polri`
<<<<<<< Updated upstream
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
>>>>>>> Stashed changes

--
-- AUTO_INCREMENT for table `final_report`
--
ALTER TABLE `final_report`
<<<<<<< Updated upstream
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kemenkumham_users`
--
ALTER TABLE `kemenkumham_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000006;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
>>>>>>> Stashed changes

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prisoner_locations`
--
ALTER TABLE `prisoner_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recent_activities`
--
ALTER TABLE `recent_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `final_report`
--
ALTER TABLE `final_report`
<<<<<<< Updated upstream
  ADD CONSTRAINT `fk_final_reports_mantan_narapidana` FOREIGN KEY (`nik`,`nrt`) REFERENCES `mantan_narapidana` (`nik`, `nrt`) ON DELETE CASCADE ON UPDATE CASCADE;
=======
  ADD CONSTRAINT `final_report_ibfk_1` FOREIGN KEY (`nik`,`nrt`) REFERENCES `mantan_narapidana` (`nik`, `nrt`) ON DELETE CASCADE ON UPDATE CASCADE;
>>>>>>> Stashed changes

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
<<<<<<< Updated upstream
  ADD CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `kemenkumham_users` (`id`);

--
-- Constraints for table `prisoner_locations`
--
ALTER TABLE `prisoner_locations`
  ADD CONSTRAINT `fk_prisoner_locations_mantan_narapidana` FOREIGN KEY (`nik`,`nrt`) REFERENCES `mantan_narapidana` (`nik`, `nrt`) ON DELETE CASCADE ON UPDATE CASCADE;
=======
  ADD CONSTRAINT `fk_user_login_history` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
>>>>>>> Stashed changes
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
