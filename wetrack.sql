-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 20, 2024 at 01:19 AM
-- Server version: 8.0.35
-- PHP Version: 8.2.20

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
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `id_napi` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `unggah_foto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `isi_laporan` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_laporan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_polri`
--

INSERT INTO `data_polri` (`id`, `nama`, `nik`, `id_napi`, `alamat`, `unggah_foto`, `isi_laporan`, `created_at`, `tanggal_laporan`) VALUES
(1, 'nama', '1111111111111111', '123', 'qwe', 'uploads/6763baf87d618.jpeg', 'qwe', '2024-12-19 06:19:36', '2025-01-02'),
(2, 'niko', '1111111111111111', '234', 'ruko', 'uploads/6763bb41314c0.jpeg', 'weok', '2024-12-19 06:20:49', '2024-12-18'),
(3, 'rafi', '1111111111111111', '123', 'qwe', 'uploads/6763bcb4c93e1.jpeg', 'qwe', '2024-12-19 06:27:00', '2024-12-20'),
(4, 'nama', '1111111111111111', 'qwe', 'qwe', 'uploads/6763bedb289fb.jpeg', 'qwe', '2024-12-19 06:36:11', '2024-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `kemenkumham_users`
--

CREATE TABLE `kemenkumham_users` (
  `id` int NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '/wetrack/kemenkumham/image/kemenkumham.png'
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

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `login_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mantan_narapidana`
--

CREATE TABLE `mantan_narapidana` (
  `id` int NOT NULL,
  `fileInput` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nrt` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dateBirth` date DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nationality` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `crime` enum('TwA','Ot','Fraud','Assault','NO','Embezzlement','MvT','Robbery','Brawling') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `case` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `punishment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `releaseDate` date DEFAULT NULL,
  `report` text COLLATE utf8mb4_general_ci,
  `action` tinyint(1) DEFAULT NULL COMMENT '1 for accept, 0 for reject',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mantan_narapidana`
--

INSERT INTO `mantan_narapidana` (`id`, `fileInput`, `nik`, `nrt`, `nama`, `dateBirth`, `address`, `gender`, `nationality`, `crime`, `case`, `punishment`, `releaseDate`, `report`, `action`, `created_at`) VALUES
(1, 'uploads/nanti-diganti.png', '892189', '123141', 'yanto', '2024-12-03', 'jakal', 'male', 'Jamaica', 'Embezzlement', 'tersangka', '5 years', '2028-12-06', NULL, NULL, '2024-12-18 15:53:43'),
(2, 'uploads/nanti-diganti.png', '1245', '66666', 'jokowi', '2013-06-30', 'solo', 'male', 'Indonesia', 'NO', 'pengedar', '100000 years', '2047-05-27', NULL, NULL, '2024-12-18 15:55:37'),
(3, 'uploads/lapas-logo.png', '1234', '1234', 'anjay', '2024-12-18', 'kepo', 'male', 'Indonesia', 'Assault', 'nusuk', '10000', '2024-12-19', NULL, NULL, '2024-12-19 00:00:21'),
(4, 'uploads/lapas-logo.png', '78978979', '123189481', 'Joko', '2002-02-28', 'Jl. Jakal', 'male', 'Belgium', 'NO', 'Pengedar', '100 Years', '2025-01-22', NULL, NULL, '2024-12-19 03:09:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_polri`
--
ALTER TABLE `data_polri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kemenkumham_users`
--
ALTER TABLE `kemenkumham_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_polri`
--
ALTER TABLE `data_polri`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kemenkumham_users`
--
ALTER TABLE `kemenkumham_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000006;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `kemenkumham_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
