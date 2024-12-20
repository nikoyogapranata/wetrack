-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Dec 19, 2024 at 04:36 PM
=======
-- Generation Time: Dec 20, 2024 at 03:46 AM
>>>>>>> abf4a73c3f951eb0aff569238a7d2f07274f5459
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
(5, 'HABDIL IQRAWARDANA', '1234567891234567', '123', 'Jl. Degolan, Ngemplak, Umbulmartani, Kec.Ngemplak, Kab. Sleman, Daerah Istimewa Yogyakarta 55584', 'uploads/6763ec680142f.jpg', 'haii', '2024-12-19 09:50:32', '2024-12-19');

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `mantan_narapidana`
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
  `report` text DEFAULT NULL,
  `action` tinyint(1) DEFAULT NULL COMMENT '1 for accept, 0 for reject',
=======
-- Table structure for table `final_report`
--

CREATE TABLE `final_report` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nrt` varchar(20) NOT NULL,
  `docInput` varchar(255) NOT NULL,
>>>>>>> abf4a73c3f951eb0aff569238a7d2f07274f5459
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
<<<<<<< HEAD
-- Dumping data for table `mantan_narapidana`
--

INSERT INTO `mantan_narapidana` (`id`, `fileInput`, `nik`, `nrt`, `nama`, `dateBirth`, `address`, `gender`, `nationality`, `crime`, `case`, `punishment`, `releaseDate`, `report`, `action`, `created_at`) VALUES
(1, 'uploads/nanti-diganti.png', '892189', '123141', 'yanto', '2024-12-03', 'jakal', 'male', 'Jamaica', 'Embezzlement', 'tersangka', '5 years', '2028-12-06', NULL, 0, '2024-12-18 15:53:43'),
(2, 'uploads/nanti-diganti.png', '1245', '66666', 'jokowi', '2013-06-30', 'solo', 'male', 'Indonesia', 'NO', 'pengedar', '100000 years', '2047-05-27', NULL, 1, '2024-12-18 15:55:37'),
(3, 'uploads/lapas-logo.png', '1234', '1234', 'anjay', '2024-12-18', 'kepo', 'male', 'Indonesia', 'Assault', 'nusuk', '10000', '2024-12-19', NULL, 0, '2024-12-19 00:00:21'),
(4, 'uploads/lapas-logo.png', '78978979', '123189481', 'Joko', '2002-02-28', 'Jl. Jakal', 'male', 'Belgium', 'NO', 'Pengedar', '100 Years', '2025-01-22', NULL, 1, '2024-12-19 03:09:25'),
(6, 'uploads/aa001af445145043238cf42d9ac25fdc.jpg', '1234567891234567', '0854632159', 'akmskams', '2024-12-28', 'askdmaskdmaksmd', 'male', 'Australia', 'NO', 'aksdaksdkasmdkamskdmajnjnasd', 'ajnsjns', '2024-12-21', 'Narkoba woii', 0, '2024-12-19 14:41:41');
=======
-- Dumping data for table `final_report`
--

INSERT INTO `final_report` (`id`, `nik`, `nrt`, `docInput`, `created_at`) VALUES
(1, '78978979', '123189481', 'uploads/stakeholder-engagement-plan-template.pdf', '2024-12-20 02:04:06'),
(2, '1234', '1234', 'uploads/WBS-Kelompok 4.xlsx - WBS with Gantt Chart - WETRACK.pdf', '2024-12-20 02:12:56');

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

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime DEFAULT current_timestamp(),
  `ip_address` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mantan_narapidana`
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
  `report` text DEFAULT NULL,
  `action` tinyint(1) DEFAULT NULL COMMENT '1 for accept, 0 for reject',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mantan_narapidana`
--

INSERT INTO `mantan_narapidana` (`id`, `fileInput`, `nik`, `nrt`, `nama`, `dateBirth`, `address`, `gender`, `nationality`, `crime`, `case`, `punishment`, `releaseDate`, `report`, `action`, `created_at`) VALUES
(1, 'uploads/nanti-diganti.png', '892189', '123141', 'yanto', '2024-12-03', 'jakal', 'male', 'Jamaica', 'Embezzlement', 'tersangka', '5 years', '2028-12-06', NULL, NULL, '2024-12-18 15:53:43'),
(2, 'uploads/nanti-diganti.png', '1245', '66666', 'jokowi', '2013-06-30', 'solo', 'male', 'Indonesia', 'NO', 'pengedar', '100000 years', '2047-05-27', NULL, NULL, '2024-12-18 15:55:37'),
(3, 'uploads/lapas-logo.png', '1234', '1234', 'anjay', '2024-12-18', 'kepo', 'male', 'Indonesia', 'Assault', 'nusuk', '10000', '2024-12-19', NULL, NULL, '2024-12-19 00:00:21'),
(4, 'uploads/lapas-logo.png', '78978979', '123189481', 'Joko', '2002-02-28', 'Jl. Jakal', 'male', 'Belgium', 'NO', 'Pengedar', '100 Years', '2025-01-22', NULL, NULL, '2024-12-19 03:09:25');

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
(1, 'report', 'Final report created for NRT: 66666', '2024-12-20 02:45:21');
>>>>>>> abf4a73c3f951eb0aff569238a7d2f07274f5459

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_polri`
--
ALTER TABLE `data_polri`
  ADD PRIMARY KEY (`id`);

--
<<<<<<< HEAD
-- Indexes for table `mantan_narapidana`
=======
-- Indexes for table `final_report`
>>>>>>> abf4a73c3f951eb0aff569238a7d2f07274f5459
--
ALTER TABLE `final_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik` (`nik`,`nrt`);

--
-- Indexes for table `kemenkumham_users`
--
ALTER TABLE `kemenkumham_users`
  ADD PRIMARY KEY (`id`);

--
<<<<<<< HEAD
-- AUTO_INCREMENT for dumped tables
=======
-- Indexes for table `login_history`
>>>>>>> abf4a73c3f951eb0aff569238a7d2f07274f5459
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
<<<<<<< HEAD
-- AUTO_INCREMENT for table `data_polri`
--
ALTER TABLE `data_polri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
=======
-- Indexes for table `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nik_nrt` (`nik`,`nrt`);

--
-- Indexes for table `recent_activities`
--
ALTER TABLE `recent_activities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_polri`
--
ALTER TABLE `data_polri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `final_report`
--
ALTER TABLE `final_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kemenkumham_users`
--
ALTER TABLE `kemenkumham_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000006;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recent_activities`
--
ALTER TABLE `recent_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `final_report`
--
ALTER TABLE `final_report`
  ADD CONSTRAINT `final_report_ibfk_1` FOREIGN KEY (`nik`,`nrt`) REFERENCES `mantan_narapidana` (`nik`, `nrt`);

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `kemenkumham_users` (`id`);
>>>>>>> abf4a73c3f951eb0aff569238a7d2f07274f5459
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
