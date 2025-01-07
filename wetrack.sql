-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 07:49 AM
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

--
-- Dumping data for table `login_history`
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
(20, 1000001, '2024-12-21 06:39:34', '::1'),
(21, 1000001, '2024-12-21 07:23:10', '::1'),
(22, 1000001, '2024-12-21 10:29:43', '::1'),
(23, 1000001, '2024-12-21 10:35:22', '::1'),
(24, 1000001, '2024-12-21 11:00:29', '::1'),
(25, 1300001, '2024-12-21 11:00:51', '::1'),
(26, 1200001, '2024-12-21 11:01:32', '::1'),
(27, 1200001, '2024-12-21 11:06:26', '::1'),
(28, 1000001, '2024-12-21 11:08:16', '::1'),
(29, 1100001, '2024-12-21 11:10:19', '::1'),
(30, 1200001, '2024-12-22 08:30:07', '::1'),
(31, 1200001, '2024-12-22 09:25:41', '::1'),
(32, 1200001, '2024-12-22 09:27:40', '::1'),
(33, 1200001, '2024-12-22 09:30:45', '::1'),
(34, 1200001, '2024-12-22 09:37:30', '::1'),
(35, 1200001, '2024-12-22 09:38:50', '::1'),
(36, 1200001, '2024-12-22 09:40:24', '::1'),
(37, 1200001, '2024-12-22 09:59:32', '::1'),
(38, 1200001, '2024-12-22 13:41:50', '::1'),
(39, 1200001, '2024-12-22 13:46:48', '::1'),
(40, 1200001, '2024-12-23 01:25:21', '::1'),
(41, 1200001, '2024-12-23 02:14:18', '::1'),
(42, 1200001, '2024-12-23 08:32:08', '::1'),
(43, 1200001, '2024-12-23 13:36:17', '::1'),
(44, 1200001, '2024-12-23 14:05:36', '::1'),
(45, 1200001, '2024-12-23 14:09:18', '::1'),
(46, 1200001, '2024-12-23 14:18:46', '::1'),
(47, 1200001, '2024-12-24 00:59:50', '::1'),
(48, 1200001, '2024-12-24 01:05:27', '::1'),
(49, 1200001, '2024-12-24 03:30:37', '::1'),
(50, 1200001, '2024-12-24 04:41:19', '::1'),
(51, 1000001, '2024-12-24 08:09:25', '::1'),
(52, 1200001, '2024-12-24 08:10:32', '::1'),
(53, 1000001, '2024-12-24 08:12:09', '::1'),
(54, 1200001, '2024-12-26 12:33:53', '::1'),
(55, 1200001, '2024-12-26 12:34:37', '::1'),
(56, 1200001, '2025-01-03 00:08:59', '::1'),
(57, 1200001, '2025-01-03 01:53:53', '::1'),
(58, 1200001, '2025-01-03 03:02:31', '::1'),
(59, 1200001, '2025-01-03 10:26:18', '::1'),
(60, 1200001, '2025-01-03 11:54:36', '::1'),
(61, 1200001, '2025-01-03 11:58:09', '::1'),
(62, 1100001, '2025-01-03 12:01:42', '::1'),
(63, 1200001, '2025-01-03 13:32:53', '::1'),
(64, 1200001, '2025-01-03 13:33:37', '::1'),
(65, 1200001, '2025-01-03 14:59:37', '::1'),
(66, 1200001, '2025-01-03 15:00:49', '::1'),
(67, 1200001, '2025-01-03 15:02:35', '::1'),
(68, 1000001, '2025-01-03 15:12:11', '::1'),
(69, 1100001, '2025-01-03 15:12:57', '::1'),
(70, 1000001, '2025-01-04 04:57:07', '::1'),
(71, 1000001, '2025-01-04 04:57:07', '::1'),
(72, 1200001, '2025-01-04 05:00:44', '::1'),
(73, 1200001, '2025-01-04 05:00:44', '::1'),
(74, 1100001, '2025-01-04 05:41:09', '::1'),
(75, 1100001, '2025-01-04 05:41:09', '::1'),
(76, 1100001, '2025-01-04 10:39:11', '::1'),
(77, 1200001, '2025-01-04 10:39:25', '::1'),
(78, 1100001, '2025-01-04 10:41:22', '::1'),
(79, 1200001, '2025-01-04 10:56:18', '::1'),
(80, 1100001, '2025-01-04 11:45:14', '::1'),
(81, 1200001, '2025-01-04 11:45:31', '::1'),
(82, 1100001, '2025-01-04 13:22:10', '::1');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prisoner_type` enum('houseArrest','cityPrisoner') DEFAULT NULL,
  `geofence_type` enum('houseArrest','cityPrisoner') DEFAULT NULL,
  `geofence_radius` float DEFAULT NULL,
  `geofence_lat` decimal(10,8) DEFAULT NULL,
  `geofence_lng` decimal(11,8) DEFAULT NULL,
  `geofence_city_district` varchar(100) DEFAULT NULL,
  `radiusFence` float DEFAULT NULL,
  `centerLat` float DEFAULT NULL,
  `centerLng` float DEFAULT NULL,
  `city_district` varchar(100) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mantan_narapidana`
--

INSERT INTO `mantan_narapidana` (`id`, `fileInput`, `nik`, `nrt`, `nama`, `dateBirth`, `address`, `gender`, `nationality`, `crime`, `case`, `punishment`, `releaseDate`, `report`, `action`, `created_at`, `prisoner_type`, `geofence_type`, `geofence_radius`, `geofence_lat`, `geofence_lng`, `geofence_city_district`, `radiusFence`, `centerLat`, `centerLng`, `city_district`, `last_login`) VALUES
(25, 'uploads/250066886.webp', '1111111111111111', '001', 'Ousamane Dembele', '1999-02-03', 'Jl. Harjobinangun, Turgo Gede, RT.04/RW.22, Bondosari, Harjobinangun, Kec. Pakem, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55582', 'male', 'France', 'Robbery', 'tersangka melakukan perampokan minimarket, dua korban tewas saat kejadian', '10 years', '2031-01-03', NULL, NULL, '2025-01-03 15:30:27', NULL, 'houseArrest', 1, -7.69958590, 110.41430400, NULL, NULL, NULL, NULL, NULL, '2025-01-04 11:06:19'),
(27, 'uploads/foto-tahanan.jpg', '1111111111111112', '002', 'Budi Santoso', '1980-01-29', 'Jl. Merpati No. 10, Kel. Sukamaju, Kec. Pasar Minggu, Jakarta Selatan, DKI Jakarta, 12520', 'male', 'Indonesia', 'Fraud', 'Tersangka melakukan penipuan investasi bodong senilai Rp 5 miliar.', '5 Years', '2030-10-22', NULL, NULL, '2025-01-04 09:48:31', NULL, 'houseArrest', 1, -7.69841080, 110.40917320, NULL, NULL, NULL, NULL, NULL, '2025-01-04 10:18:20'),
(28, 'uploads/foto-tahanan-2.jpg', '1111111111111113', '003', 'Eka Putri', '1998-03-04', 'Jl. Mangga Dua No. 25, Kel. Tanjung Duren, Kec. Grogol, Jakarta Barat, DKI Jakarta, 11470', 'female', 'Indonesia', 'Embezzlement', 'Tersangka menggelapkan dana perusahaan sebesar Rp 2 miliar.', '7 Years', '2031-10-11', NULL, NULL, '2025-01-04 09:50:48', NULL, 'houseArrest', 1, -7.69836990, 110.40919020, NULL, NULL, NULL, NULL, NULL, '2025-01-04 10:20:57'),
(29, 'uploads/foto-tahanan.jpg', '1111111111111114', '004', 'Rudi Setiawan', '1995-07-15', 'Jl. Melati No. 12, Kel. Kebon Jeruk, Kec. Kebon Jeruk, Jakarta Barat, DKI Jakarta, 11530', 'male', 'Indonesia', '', 'Tersangka melakukan pencurian dengan kekerasan di sebuah rumah, korbannya mengalami luka berat.', '8 Years', '2033-07-15', NULL, NULL, '2025-01-04 02:55:12', NULL, 'houseArrest', 1, -7.69524564, 110.39869308, NULL, NULL, NULL, NULL, NULL, '2025-01-04 10:15:57'),
(30, 'uploads/foto-tahanan-2.jpg', '1111111111111115', '005', 'Maria Anggraini', '1992-11-11', 'Jl. Jambu No. 8, Kel. Cempaka Putih, Kec. Cempaka Putih, Jakarta Pusat, DKI Jakarta, 10510', 'female', 'Indonesia', 'Assault', 'Tersangka melakukan penganiayaan terhadap teman sekantornya yang berujung pada cedera berat.', '4 Years', '2029-11-11', NULL, NULL, '2025-01-04 02:58:46', NULL, 'houseArrest', 1, -7.70051918, 110.39302826, NULL, NULL, NULL, NULL, NULL, '2025-01-04 10:16:14'),
(31, 'uploads/foto-tahanan.jpg', '1111111111111116', '006', 'Joko Nurhakim', '1987-04-17', 'Jl. Raya No. 10, Kel. Taman Sari, Kec. Taman Sari, Jakarta Barat, DKI Jakarta, 11180', 'male', 'Indonesia', 'Brawling', 'Tersangka terlibat perkelahian massal di sebuah tempat hiburan malam.', '2 Years', '2027-04-17', NULL, NULL, '2025-01-04 03:01:59', NULL, 'cityPrisoner', NULL, NULL, NULL, 'Kabupaten Sleman', NULL, NULL, NULL, NULL, '2025-01-04 10:17:52'),
(32, 'uploads/foto-tahanan-2.jpg', '1111111111111117', '007', 'Siti Nurhaliza', '1993-05-10', 'Jl. Anggrek No. 15, Kel. Pahlawan, Kec. Medan, Sumatera Utara, 20221', 'female', 'Indonesia', '', 'Tersangka terlibat dalam peredaran narkoba jenis sabu-sabu di wilayah Medan.', '6 Years', '2031-05-10', NULL, NULL, '2025-01-04 03:04:07', NULL, 'cityPrisoner', NULL, NULL, NULL, 'Kota Yogyakarta', NULL, NULL, NULL, NULL, '2025-01-04 10:18:07'),
(33, 'uploads/foto-tahanan.jpg', '1111111111111118', '008', 'Slamet Riyadi', '1980-09-06', 'Jl. Mangga No. 50, Kel. Cikini, Kec. Menteng, Jakarta Pusat, DKI Jakarta, 10330', 'male', 'Indonesia', '', 'Tersangka terlibat dalam pencurian kendaraan bermotor di area perumahan elite.', '5 Years', '2030-09-06', NULL, NULL, '2025-01-04 03:06:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:06:11'),
(34, 'uploads/foto-tahanan-2.jpg', '1111111111111119', '009', 'Rina Pertiwi', '1995-12-22', 'Jl. Gading No. 30, Kel. Tanjung Duren, Kec. Grogol, Jakarta Barat, DKI Jakarta, 11470', 'female', 'Indonesia', 'Fraud', 'Tersangka melakukan penipuan dalam bentuk jual beli barang elektronik palsu.', '4 Years', '2030-12-22', NULL, NULL, '2025-01-04 03:09:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:09:25'),
(35, 'uploads/foto-tahanan.jpg', '1111111111111120', '010', 'Herman Wijaya', '1990-02-28', 'Jl. Raya Selatan No. 20, Kel. Karet, Kec. Setiabudi, Jakarta Selatan, DKI Jakarta, 12920', 'male', 'Indonesia', 'Robbery', 'Tersangka melakukan perampokan di sebuah toko emas, membawa kabur barang senilai Rp 1,5 miliar.', '7 Years', '2032-02-28', NULL, NULL, '2025-01-04 03:12:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:12:38'),
(36, 'uploads/foto-tahanan-2.jpg', '1111111111111121', '011', 'Ayu Lestari', '1986-08-18', 'Jl. Cemara No. 10, Kel. Sumber, Kec. Cikupa, Tangerang, Banten, 15710', 'female', 'Indonesia', 'Embezzlement', 'Tersangka menggelapkan dana bantuan sosial senilai Rp 800 juta.', '6 Years', '2032-08-18', NULL, NULL, '2025-01-04 03:14:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:14:44'),
(37, 'uploads/foto-tahanan.jpg', '1111111111111122', '012', 'Budi Rahardjo', '1983-10-03', 'Jl. Kenari No. 11, Kel. Pancoran, Kec. Pancoran, Jakarta Selatan, DKI Jakarta, 12780', 'male', 'Indonesia', '', 'Tersangka melakukan pencurian dengan kekerasan di sebuah ATM, membawa kabur uang tunai Rp 250 juta.', '6 Years', '2031-10-03', NULL, NULL, '2025-01-04 03:17:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:17:59'),
(38, 'uploads/foto-tahanan-2.jpg', '1111111111111123', '013', 'Indah Sari', '1994-01-21', 'Jl. Kebon Jeruk No. 45, Kel. Kebon Jeruk, Kec. Kebon Jeruk, Jakarta Barat, DKI Jakarta, 11530', 'female', 'Indonesia', '', 'Tersangka terlibat dalam penyalahgunaan narkoba jenis ekstasi di klub malam.', '5 Years', '2029-01-21', NULL, NULL, '2025-01-04 03:21:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:21:18'),
(39, 'uploads/foto-tahanan.jpg', '1111111111111124', '014', 'Ali Imron', '1985-06-12', 'Jl. Delima No. 18, Kel. Menteng, Kec. Menteng, Jakarta Pusat, DKI Jakarta, 10310', 'male', 'Indonesia', 'Robbery', 'Tersangka merampok dengan senjata api di sebuah toko elektronik.', '8 Years', '2033-06-12', NULL, NULL, '2025-01-04 03:23:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:23:50'),
(40, 'uploads/foto-tahanan-2.jpg', '1111111111111125', '015', 'Dewi Lestari', '1991-11-09', 'Jl. Bambu No. 5, Kel. Bambu, Kec. Bambu, Jakarta Timur, DKI Jakarta, 13410', 'female', 'Indonesia', 'Assault', 'Tersangka melakukan penganiayaan terhadap tetangga yang berujung pada kerusakan fisik.', '3 Years', '2028-11-09', NULL, NULL, '2025-01-04 03:26:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:26:10'),
(41, 'uploads/foto-tahanan.jpg', '1111111111111126', '016', 'Andi Saputra', '1990-03-25', 'Jl. Pahlawan No. 5, Kel. Pahlawan, Kec. Sukaraja, Bandung, Jawa Barat, 40121', 'male', 'Indonesia', '', 'Tersangka terlibat dalam pencurian dengan kekerasan terhadap warga yang sedang berbelanja.', '4 Years', '2029-03-25', NULL, NULL, '2025-01-04 03:29:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:29:21'),
(42, 'uploads/foto-tahanan-2.jpg', '1111111111111127', '017', 'Tina Setiawati', '1988-06-14', 'Jl. Mangga No. 45, Kel. Jatiwaringin, Kec. Pondok Gede, Bekasi, Jawa Barat, 17411', 'female', 'Indonesia', 'Fraud', 'Tersangka melakukan penipuan dalam jual beli rumah dengan dokumen palsu.', '5 Years', '2030-06-14', NULL, NULL, '2025-01-04 03:31:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:31:42'),
(43, 'uploads/foto-tahanan.jpg', '1111111111111128', '018', 'Muhammad Iqbal', '1992-08-23', 'Jl. Merdeka No. 33, Kel. Merdeka, Kec. Kota Baru, Malang, Jawa Timur, 65111', 'male', 'Indonesia', 'Assault', 'Tersangka melakukan penganiayaan terhadap temannya yang berujung pada kecelakaan.', '3 Years', '2028-08-23', NULL, NULL, '2025-01-04 03:34:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:34:09'),
(44, 'uploads/foto-tahanan-2.jpg', '1111111111111129', '019', 'Dewi Ramadhani', '1996-12-02', 'Jl. Surya No. 10, Kel. Bumi, Kec. Ngaliyan, Semarang, Jawa Tengah, 50125', 'female', 'Indonesia', 'Robbery', 'Tersangka terlibat dalam perampokan toko perhiasan di daerah Semarang.', '6 Years', '2032-12-02', NULL, NULL, '2025-01-04 03:36:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:36:59'),
(45, 'uploads/foto-tahanan.jpg', '1111111111111130', '020', 'Heru Wijayanto', '1985-05-15', 'Jl. Raya No. 10, Kel. Kuta, Kec. Kuta, Bali, 80361', 'male', 'Indonesia', '', 'Tersangka mencuri kendaraan bermotor di kawasan wisata Bali.', '4 Years', '2029-05-15', NULL, NULL, '2025-01-04 03:39:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:39:11'),
(46, 'uploads/foto-tahanan-2.jpg', '1111111111111131', '021', 'Linda Susanti', '1984-11-11', 'Jl. Cendana No. 23, Kel. Kencana, Kec. Sleman, Yogyakarta, 55283', 'female', 'Indonesia', 'Embezzlement', 'Tersangka menggelapkan dana bantuan masyarakat sebesar Rp 1 juta.', '3 Years', '2027-11-11', NULL, NULL, '2025-01-04 03:41:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:41:34'),
(47, 'uploads/foto-tahanan.jpg', '1111111111111132', '022', 'Yusuf Kurniawan', '1994-01-17', 'Jl. Pahlawan No. 12, Kel. Sumber, Kec. Rungkut, Surabaya, Jawa Timur, 60293', 'male', 'Indonesia', 'Brawling', 'Tersangka terlibat dalam perkelahian antar geng di kawasan Surabaya.', '2 Years', '2027-01-17', NULL, NULL, '2025-01-04 03:43:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:43:12'),
(48, 'uploads/foto-tahanan-2.jpg', '1111111111111133', '023', 'Rika Puspitasari', '1990-10-05', 'Jl. Raya No. 15, Kel. Jambu, Kec. Ciledug, Tangerang, Banten, 15154', 'female', 'Indonesia', 'Fraud', 'Tersangka melakukan penipuan dalam investasi bodong senilai Rp 3 miliar.', '5 Years', '2030-10-05', NULL, NULL, '2025-01-04 03:45:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:45:39'),
(49, 'uploads/foto-tahanan.jpg', '1111111111111134', '024', 'Iwan Setiawan', '1997-07-21', 'Jl. Merdeka No. 8, Kel. Kelapa Gading, Kec. Kelapa Gading, Jakarta Utara, DKI Jakarta, 14240', 'male', 'Indonesia', '', 'Tersangka terlibat dalam peredaran narkoba jenis ekstasi di klub malam.', '6 Years', '2033-07-21', NULL, NULL, '2025-01-04 03:47:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:47:52'),
(50, 'uploads/foto-tahanan-2.jpg', '1111111111111135', '025', 'Marlina Amalia', '1993-04-11', 'Jl. Cempaka No. 18, Kel. Taman, Kec. Ciputat, Tangerang Selatan, Banten, 15413', 'female', 'Indonesia', 'Robbery', 'Tersangka merampok toko perhiasan dengan kekerasan, membawa kabur barang senilai Rp 500 juta.', '7 Years', '2030-04-11', NULL, NULL, '2025-01-04 03:50:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:50:09'),
(51, 'uploads/foto-tahanan.jpg', '1111111111111136', '026', 'Hendra Kurniawan', '1992-05-18', 'Jl. Bunga No. 32, Kel. Sidomulyo, Kec. Gresik, Jawa Timur, 61121', 'male', 'Indonesia', '', 'Tersangka melakukan pencurian dengan kekerasan terhadap warga yang sedang tidur.', '4 Years', '2029-05-18', NULL, NULL, '2025-01-04 03:53:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:53:16'),
(52, 'uploads/foto-tahanan-2.jpg', '1111111111111137', '027', 'Sari Wulandari', '1989-12-12', 'Jl. Kenanga No. 45, Kel. Bintaro, Kec. Pesanggrahan, Jakarta Selatan, DKI Jakarta, 12330', 'female', 'Indonesia', 'Fraud', 'Tersangka terlibat dalam penipuan proyek investasi yang merugikan korban hingga Rp 10 miliar.', '6 Years', '2030-12-12', NULL, NULL, '2025-01-04 03:55:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:55:31'),
(53, 'uploads/foto-tahanan.jpg', '1111111111111138', '028', 'Rudi Hartono', '1995-07-04', 'Jl. Raya No. 20, Kel. Kampung Melayu, Kec. Jatinegara, Jakarta Timur, DKI Jakarta, 13410', 'male', 'Indonesia', 'Assault', 'Tersangka melakukan penganiayaan terhadap seorang pengemudi mobil yang sedang menunggu di lampu merah.', '3 Years', '2028-07-04', NULL, NULL, '2025-01-04 03:58:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 03:58:02'),
(54, 'uploads/foto-tahanan-2.jpg', '1111111111111139', '029', 'Siti Maulani', '1993-02-21', 'Jl. Cempaka No. 8, Kel. Jatisari, Kec. Cikarang, Bekasi, Jawa Barat, 17530', 'female', 'Indonesia', 'Robbery', 'Tersangka melakukan perampokan di rumah warga dengan menggunakan senjata tajam.', '6 Years', '2029-02-21', NULL, NULL, '2025-01-04 04:00:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:00:34'),
(55, 'uploads/foto-tahanan.jpg', '1111111111111140', '030', 'Rizal Pratama', '1987-10-03', 'Jl. Sejahtera No. 25, Kel. Lintas, Kec. Padang, Sumatera Barat, 25151', 'male', 'Indonesia', '', 'Tersangka mencuri sepeda motor dari area parkir rumah sakit.', '4 Years', '2027-10-03', NULL, NULL, '2025-01-04 04:03:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:03:03'),
(56, 'uploads/foto-tahanan-2.jpg', '1111111111111141', '031', 'Anita Sari', '1985-11-09', 'Jl. Rawa No. 12, Kel. Kebon Jeruk, Kec. Tangerang, Banten, 15117', 'female', 'Indonesia', 'Embezzlement', 'Tersangka menggelapkan dana perusahaan sebesar Rp 500 juta.', '5 Years', '2030-11-09', NULL, NULL, '2025-01-04 04:05:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:05:24'),
(57, 'uploads/foto-tahanan.jpg', '1111111111111142', '032', 'Irwan Mahendra', '1994-01-10', 'Jl. Alam No. 9, Kel. Wana, Kec. Sidoarjo, Jawa Timur, 61234', 'male', 'Indonesia', 'Brawling', 'Tersangka terlibat dalam perkelahian antar kelompok di jalan raya.', '2 Years', '2026-01-10', NULL, NULL, '2025-01-04 04:07:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:07:51'),
(58, 'uploads/foto-tahanan-2.jpg', '1111111111111143', '033', 'Diana Oktaviani', '1996-09-20', 'Jl. Melati No. 18, Kel. Sumberjati, Kec. Karanganyar, Solo, Jawa Tengah, 57119', 'female', 'Indonesia', 'Fraud', 'Tersangka melakukan penipuan dalam bentuk investasi online dengan kerugian Rp 3 miliar.', '4 Years', '2030-09-20', NULL, NULL, '2025-01-04 04:10:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:10:15'),
(59, 'uploads/foto-tahanan.jpg', '1111111111111144', '034', 'Budi Setiawan', '1990-11-05', 'Jl. Rindam No. 6, Kel. Melati, Kec. Pasir, Surabaya, Jawa Timur, 60156', 'male', 'Indonesia', '', 'Tersangka terlibat dalam peredaran narkoba jenis ganja dan sabu-sabu.', '5 Years', '2030-11-05', NULL, NULL, '2025-01-04 04:12:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:12:42'),
(60, 'uploads/foto-tahanan-2.jpg', '1111111111111145', '035', 'Eka Wahyuni', '1992-07-18', 'Jl. Teratai No. 2, Kel. Krapyak, Kec. Bantul, Yogyakarta, 55194', 'female', 'Indonesia', 'Robbery', 'Tersangka merampok warung makan dengan senjata api dan melukai pemilik warung.', '6 Years', '2028-07-18', NULL, NULL, '2025-01-04 04:15:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:15:09'),
(61, 'uploads/foto-tahanan.jpg', '1111111111111146', '036', 'Ahmad Zaky', '1988-05-14', 'Jl. Harapan No. 15, Kel. Waru, Kec. Cipayung, Jakarta Timur, DKI Jakarta, 13850', 'male', 'Indonesia', '', 'Tersangka melakukan pencurian dengan kekerasan dan pembunuhan terhadap korban.', '8 Years', '2032-05-14', NULL, NULL, '2025-01-04 04:17:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:17:38'),
(62, 'uploads/foto-tahanan-2.jpg', '1111111111111147', '037', 'Siti Aminah', '1994-02-10', 'Jl. Pahlawan No. 4, Kel. Desa Baru, Kec. Palembang, Sumatera Selatan, 30111', 'female', 'Indonesia', 'Fraud', 'Tersangka melakukan penipuan terhadap masyarakat dengan modus arisan online.', '4 Years', '2028-02-10', NULL, NULL, '2025-01-04 04:20:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:20:01'),
(63, 'uploads/foto-tahanan.jpg', '1111111111111148', '038', 'Joni Setiawan', '1986-09-30', 'Jl. Merdeka No. 3, Kel. Gempol, Kec. Malang, Jawa Timur, 65156', 'male', 'Indonesia', 'Assault', 'Tersangka terlibat dalam penganiayaan terhadap temannya yang menyebabkan korban kehilangan penglihatan.', '5 Years', '2031-09-30', NULL, NULL, '2025-01-04 04:22:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:22:28'),
(64, 'uploads/foto-tahanan-2.jpg', '1111111111111149', '039', 'Tina Wulandari', '1995-04-06', 'Jl. Kencana No. 19, Kel. Tanah Abang, Kec. Bandung, Jawa Barat, 40234', 'female', 'Indonesia', '', 'Tersangka mencuri barang-barang elektronik di toko ritel dengan cara menyembunyikannya di tas.', '2 Years', '2027-04-06', NULL, NULL, '2025-01-04 04:24:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:24:50'),
(65, 'uploads/foto-tahanan.jpg', '1111111111111150', '040', 'Joko Santoso', '1991-01-15', 'Jl. Cendana No. 11, Kel. Cipinang, Kec. Bekasi, Jawa Barat, 17151', 'male', 'Indonesia', '', 'Tersangka mencuri mobil dengan menggunakan kunci palsu dan melarikan diri ke luar kota.', '4 Years', '2027-01-15', NULL, NULL, '2025-01-04 04:27:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:27:13'),
(66, 'uploads/foto-tahanan.jpg', '1111111111111151', '041', 'Dewi Susanti', '1994-08-25', 'Jl. Raya No. 10, Kel. Kedaton, Kec. Bandar Lampung, Lampung, 35121', 'female', 'Indonesia', '', 'Tersangka terlibat dalam peredaran narkoba jenis ekstasi di kota Lampung.', '6 Years', '2030-08-25', NULL, NULL, '2025-01-04 04:29:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:29:35'),
(67, 'uploads/foto-tahanan-2.jpg', '1111111111111152', '042', 'Yudi Hermawan', '1993-04-16', 'Jl. Bukit No. 14, Kel. Sukasari, Kec. Tasikmalaya, Jawa Barat, 46115', 'male', 'Indonesia', 'Assault', 'Tersangka melakukan penganiayaan terhadap seorang anak muda yang terlibat dalam tawuran antar kampung.', '4 Years', '2027-04-16', NULL, NULL, '2025-01-04 04:31:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:31:58'),
(68, 'uploads/foto-tahanan.jpg', '1111111111111153', '043', 'Sri Widayati', '1987-11-30', 'Jl. Melati No. 21, Kel. Palembang, Sumatera Selatan, 30112', 'female', 'Indonesia', 'Fraud', 'Tersangka menggelapkan dana bantuan sosial yang ditujukan untuk masyarakat miskin.', '5 Years', '2032-11-30', NULL, NULL, '2025-01-04 04:34:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:34:14'),
(69, 'uploads/foto-tahanan-2.jpg', '1111111111111154', '044', 'Andi Pratama', '1990-02-10', 'Jl. Bunga No. 5, Kel. Manis, Kec. Semarang, Jawa Tengah, 50234', 'male', 'Indonesia', '', 'Tersangka terlibat dalam kasus suap terhadap pejabat pemerintah untuk mendapatkan kontrak proyek.', '6 Years', '2030-02-10', NULL, NULL, '2025-01-04 04:36:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:36:40'),
(70, 'uploads/foto-tahanan.jpg', '1111111111111155', '045', 'Wahyu Setiawan', '1995-06-22', 'Jl. Senyum No. 8, Kel. Tanjung, Kec. Madiun, Jawa Timur, 63113', 'male', 'Indonesia', '', 'Tersangka mencuri barang-barang berharga di toko elektronik dengan cara merusak sistem alarm.', '4 Years', '2029-06-22', NULL, NULL, '2025-01-04 04:39:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:39:05'),
(71, 'uploads/foto-tahanan-2.jpg', '1111111111111156', '046', 'Ratna Lestari', '1996-07-19', 'Jl. Kupu-Kupu No. 17, Kel. Kuta, Kec. Bali, 80361', 'female', 'Indonesia', '', 'Tersangka membuat dokumen palsu untuk memperoleh pinjaman bank atas nama orang lain.', '5 Years', '2031-07-19', NULL, NULL, '2025-01-04 04:41:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:41:30'),
(72, 'uploads/foto-tahanan.jpg', '1111111111111157', '047', 'Rudianto Adi', '1992-03-12', 'Jl. Merpati No. 2, Kel. Banjar, Kec. Singkawang, Kalimantan Barat, 79111', 'male', 'Indonesia', '', 'Tersangka melakukan perampokan dengan senjata api dan melukai korbannya.', '7 Years', '2030-03-12', NULL, NULL, '2025-01-04 04:43:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:43:54'),
(73, 'uploads/foto-tahanan-2.jpg', '1111111111111158', '048', 'Yenny Lestari', '1988-10-02', 'Jl. Sejahtera No. 23, Kel. Sindang Jaya, Kec. Jakarta Barat, DKI Jakarta, 11410', 'female', 'Indonesia', '', 'Tersangka ditangkap dengan kepemilikan narkoba jenis heroin dalam jumlah besar.', '6 Years', '2034-10-02', NULL, NULL, '2025-01-04 04:46:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:46:21'),
(74, 'uploads/foto-tahanan.jpg', '1111111111111159', '049', 'Budi Susanto', '1985-09-15', 'Jl. Pahlawan No. 7, Kel. Bintaro, Kec. South Tangerang, Banten, 15411', 'male', 'Indonesia', 'Assault', 'Tersangka terlibat dalam penganiayaan terhadap seorang pengemudi taksi online yang menyebabkan korban koma.', '5 Years', '2030-09-15', NULL, NULL, '2025-01-04 04:48:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:48:45'),
(75, 'uploads/foto-tahanan-2.jpg', '1111111111111160', '050', 'Maya Sari', '1993-11-04', 'Jl. Cendana No. 6, Kel. Sumber, Kec. Pematangsiantar, Sumatera Utara, 21111', 'female', 'Indonesia', 'Robbery', 'Tersangka merampok sebuah toko emas dan melarikan diri dengan membawa perhiasan senilai Rp 1,5 miliar.', '8 Years', '2031-11-04', NULL, NULL, '2025-01-04 04:51:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-04 04:51:08'),
(76, 'uploads/foto-tahanan.jpg', '1111111111111161', '051', 'Ahmad Naufal Hakim', '2005-06-08', 'Senepo, Kutoarjo, Purworejo, Jawa Tengah', 'male', 'Indonesia', 'Robbery', 'tersangka merampok sebuah toko emas dan melarikan diri dengan membawa perhiasan senilai Rp 1,5 miliar.', '5 Years', '2030-07-11', NULL, NULL, '2025-01-04 11:52:54', NULL, 'houseArrest', 1, -7.70099763, 110.40763924, NULL, NULL, NULL, NULL, NULL, '2025-01-04 11:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `prisoner_location`
--

CREATE TABLE `prisoner_location` (
  `id` int(11) NOT NULL,
  `prisoner_id` varchar(20) NOT NULL,
  `nrt` varchar(20) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prisoner_location`
--

INSERT INTO `prisoner_location` (`id`, `prisoner_id`, `nrt`, `latitude`, `longitude`, `timestamp`) VALUES
(37, '1111111111111111', '001', -7.69838730, 110.40920730, '2025-01-04 05:05:08'),
(38, '1111111111111111', '001', -7.69838730, 110.40920730, '2025-01-04 05:05:08'),
(39, '1111111111111112', '002', -7.69841080, 110.40917320, '2025-01-04 10:18:19'),
(40, '1111111111111112', '002', -7.69841080, 110.40917320, '2025-01-04 10:18:20'),
(41, '1111111111111113', '003', -7.69836990, 110.40919020, '2025-01-04 10:20:57'),
(42, '1111111111111113', '003', -7.69836990, 110.40919020, '2025-01-04 10:20:57'),
(45, '1111111111111111', '001', -7.69844380, 110.40920450, '2025-01-04 10:57:07'),
(46, '1111111111111111', '001', -7.69844380, 110.40920450, '2025-01-04 10:57:07'),
(47, '1111111111111111', '001', -7.69958590, 110.41430400, '2025-01-04 11:06:19'),
(48, '1111111111111111', '001', -7.69958590, 110.41430400, '2025-01-04 11:06:19'),
(49, '1111111111111161', '051', -7.69854420, 110.40896150, '2025-01-04 11:53:36'),
(50, '1111111111111161', '051', -7.69854420, 110.40896150, '2025-01-04 11:53:36');

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
(1, 'report', 'Final report created for NRT: 66666', '2024-12-19 19:45:21'),
(23, 'account_creation', 'New Lapas account created: Ardelia Putri Eka Rahmawati', '2024-12-21 06:48:42'),
(24, 'account_creation', 'New Bapas account created: Abdul Qadir Abdurrahman Mahrus', '2024-12-21 06:49:51'),
(25, 'account_creation', 'New Polri account created: Mohammad Rafi Hendryansyah', '2024-12-21 06:51:53'),
(26, 'account_creation', 'New Lapas account created: Ardelia Putri Eka Rahmawati', '2024-12-21 11:10:03'),
(27, 'alert_rejected', 'Alert ID #3 () was rejected - Subject: rafi', '2024-12-21 13:17:56'),
(28, 'alert_rejected', 'Alert ID #6 () was rejected - Subject: ardel ganteng 20 dec', '2024-12-21 13:18:11'),
(29, 'alert_accepted', 'Alert ID #5 for Ardel ganteng was accepted', '2024-12-21 13:22:29'),
(30, 'alert_rejected', 'Alert ID #2 for niko was rejected', '2024-12-21 13:22:40'),
(31, 'alert_accepted', 'Alert ID #1 for nama was accepted', '2024-12-21 13:22:42'),
(32, 'alert_rejected', 'Alert ID #4 for nama was rejected', '2024-12-21 13:24:15'),
(33, 'create', 'New user account created: Ferdi Sambo', '2024-12-22 08:33:18'),
(34, 'create', 'New user account created: Anthoni', '2024-12-22 08:39:25'),
(35, 'create', 'New user account created: ferdi', '2024-12-22 09:57:53'),
(36, 'create', 'New user account created: anto', '2024-12-22 10:03:15'),
(37, 'report', 'Final report created for NRT: 001', '2024-12-22 10:12:56'),
(38, 'create', 'New user account created: anton', '2024-12-22 10:16:31'),
(39, 'create', 'New user account created: darwin', '2024-12-22 10:22:51'),
(40, 'create', 'New user account created: ferdi', '2024-12-22 14:23:10'),
(41, 'create', 'New user account created: Anton', '2024-12-22 14:54:58'),
(42, 'create', 'New user account created: Anton', '2024-12-22 15:00:27'),
(43, 'create', 'New user account created: Muth Rick', '2024-12-22 15:02:40'),
(44, 'create', 'New user account created: Nyu Nyez', '2024-12-22 15:42:49'),
(45, 'create', 'New user account created: Juwita', '2024-12-23 09:23:55'),
(46, 'create', 'New user account created: Kang Udik', '2024-12-23 10:30:07'),
(47, 'create', 'New user account created: Darween', '2024-12-23 10:39:58'),
(48, 'create', 'New user account created: Kang Udik', '2024-12-23 10:44:37'),
(49, 'alert_rejected', 'Alert ID #6 for ardel ganteng 20 dec was rejected', '2024-12-23 13:34:37'),
(50, 'alert_rejected', 'Alert ID #6 for ardel ganteng 20 dec was rejected', '2024-12-23 13:34:46'),
(51, 'create', 'New user account created: Adam', '2024-12-24 03:47:25'),
(52, 'create', 'New user account created: Anton', '2024-12-24 03:50:42'),
(53, 'create', 'New user account created: Kang Udrik ', '2024-12-24 03:55:18'),
(54, 'create', 'New user account created: Darwis Nur Nes', '2024-12-24 04:02:16'),
(55, 'report', 'Final report created for NRT: 001', '2025-01-03 02:15:09'),
(56, 'create', 'New user account created: Genta Gede Saputra', '2025-01-03 12:02:38'),
(57, 'create', 'New user account created: Ousamane Dembele', '2025-01-03 15:30:27'),
(58, 'create', 'New user account created: Budi Santoso', '2025-01-04 09:48:31'),
(59, 'create', 'New user account created: Eka Putri', '2025-01-04 09:50:48'),
(60, 'create', 'New user account created: Ahmad Naufal Hakim', '2025-01-04 11:52:54');

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
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_picture`, `nip`, `full_name`, `place_of_birth`, `date_of_birth`, `religion`, `region`, `role`, `email`, `phone`, `address`, `status`, `created_by`, `created_at`, `position`, `password`, `gender`) VALUES
(1000001, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', NULL),
(1000002, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', NULL),
(1000003, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', NULL),
(1000004, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', NULL),
(1000005, '/wetrack/kemenkumham/image/kemenkumham.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkumham', NULL, NULL, NULL, 'Active', NULL, '2024-12-20 14:16:42', NULL, '$2y$10$w/r8735TfDv0HBUOz5pkmedxSWYZjq/LDcWe4GzOXy/I5T1LWeLlu', NULL),
(1100001, '/wetrack/kemenkumham/uploads/profile-picture-admin-2.jpg', '199008172020041001', 'Ardelia Putri Eka Rahmawati', 'Sleman, Yogyakarta', '2005-03-22', 'Islam', 'Condongcatur', 'Lapas', 'ardel@gmail.com', '081111111111', 'Sleman, Yogyakarta', 'Active', 1000001, '2024-12-21 11:10:03', 'Head of Administrator', '$2y$10$5xrUGidtFUKUtKSUYqoeC.gQ7QmrFKOLUhMkUMshDsNPlo.Tda2Ki', 'Female'),
(1200001, '/wetrack/kemenkumham/uploads/profile-picture-admin.jpg', '199008172020041001	', 'Abdul Qadir Abdurrahman Mahrus', 'Sleman, Yogyakarta', '2005-01-01', 'Islam', 'Condongcatur', 'Bapas', 'abdul@gmail.com', '081111111111', 'Sleman, Yogyakarta', 'Active', 1000001, '2024-12-21 06:49:51', 'Head of Administrator', '$2y$10$.qg3t61xFN1Z598thzY0D.rxr.uXvNwnN4QuaxWRS2nO6JyogipJ6', 'Male'),
(1300001, '/wetrack/kemenkumham/uploads/profile-picture-admin.jpg', '199008172020041001', 'Mohammad Rafi Hendryansyah', 'Sleman, Yogyakarta', '2005-01-01', 'Islam', 'Condongcatur', 'Polri', 'rafi@gmail.com', '081111111111', 'Sleman, Yogyakarta', 'Active', 1000001, '2024-12-21 06:51:53', 'Head of Administrator', '$2y$10$xcYWDrCf7.wJI1E2e0O.XOOkj1yZ7fkZJyHeYPkwAEFzw4rochlXm', 'Male');

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
-- Indexes for table `prisoner_location`
--
ALTER TABLE `prisoner_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prisoner_location` (`prisoner_id`,`nrt`),
  ADD KEY `idx_prisoner_location_timestamp` (`timestamp`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `final_report`
--
ALTER TABLE `final_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `mantan_narapidana`
--
ALTER TABLE `mantan_narapidana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `prisoner_location`
--
ALTER TABLE `prisoner_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `recent_activities`
--
ALTER TABLE `recent_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `final_report`
--
ALTER TABLE `final_report`
  ADD CONSTRAINT `final_report_ibfk_1` FOREIGN KEY (`nik`,`nrt`) REFERENCES `mantan_narapidana` (`nik`, `nrt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `fk_user_login_history` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prisoner_location`
--
ALTER TABLE `prisoner_location`
  ADD CONSTRAINT `fk_prisoner_location` FOREIGN KEY (`prisoner_id`,`nrt`) REFERENCES `mantan_narapidana` (`nik`, `nrt`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
