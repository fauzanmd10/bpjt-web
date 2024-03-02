-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2023 at 05:49 PM
-- Server version: 5.7.41
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpjt_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_answers`
--

CREATE TABLE `kuesioner_answers` (
  `id` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `ans1` int(11) DEFAULT NULL,
  `ans2` int(11) DEFAULT NULL,
  `ans3` int(11) DEFAULT NULL,
  `ans4` int(11) DEFAULT NULL,
  `ans5` int(11) DEFAULT NULL,
  `ans6` int(11) DEFAULT NULL,
  `ans7` int(11) DEFAULT NULL,
  `ans8` int(11) DEFAULT NULL,
  `ans9` int(11) DEFAULT NULL,
  `ans10` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuesioner_answers`
--

INSERT INTO `kuesioner_answers` (`id`, `type`, `ans1`, `ans2`, `ans3`, `ans4`, `ans5`, `ans6`, `ans7`, `ans8`, `ans9`, `ans10`, `created_at`, `updated_at`) VALUES
(1, 'badan_hukum', 2, 3, 3, 3, 3, 2, 3, 3, 3, '-', '2023-03-22 03:56:56', NULL),
(2, 'badan_hukum', 4, 4, 4, 3, 3, 3, 3, 3, 3, 'Lemot', '2023-03-28 12:36:28', NULL),
(3, 'badan_hukum', 4, 3, 3, 3, 3, 5, 4, 3, 3, 'Jalan tol banyak yang rusak', '2023-03-15 22:18:24', NULL),
(4, 'badan_hukum', 3, 4, 4, 3, 5, 4, 4, 3, 3, 'Update cctv dan maintenancenya', '2023-01-20 20:58:37', NULL),
(5, 'badan_hukum', 4, 3, 3, 4, 4, 4, 4, 4, 4, '-', '2023-02-12 01:25:28', NULL),
(6, 'badan_hukum', 3, 3, 3, 3, 5, 4, 5, 4, 5, '-', '2023-03-11 00:35:52', NULL),
(7, 'badan_hukum', 4, 3, 4, 5, 4, 4, 4, 4, 4, 'ok bgt', '2023-03-06 15:52:58', NULL),
(8, 'badan_hukum', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'oke banget', '2023-02-02 21:01:53', NULL),
(9, 'badan_hukum', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'sipt', '2023-02-18 22:56:34', NULL),
(10, 'badan_hukum', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'good job', '2023-01-25 18:17:05', NULL),
(11, 'badan_hukum', 4, 4, 4, 4, 4, 4, 5, 4, 4, 'Semoga banyak masyarakat yang bisa memanfaatjab akses website', '2023-02-05 04:43:45', NULL),
(12, 'badan_hukum', 4, 4, 4, 4, 4, 4, 4, 5, 4, 'lebih baik lagi kedepannya dlm menjalankan tupoksi', '2023-03-09 11:42:28', NULL),
(13, 'badan_hukum', 4, 4, 4, 5, 4, 4, 4, 4, 4, 'Pelayanan ada sudah cukup cepat', '2023-03-16 15:12:21', NULL),
(14, 'badan_hukum', 4, 5, 4, 4, 4, 4, 4, 4, 4, 'Tetap pertahankan pelayanan yang sangat baik dan memuaskan', '2023-01-21 08:43:29', NULL),
(15, 'badan_hukum', 4, 4, 5, 5, 4, 4, 4, 5, 4, 'oke', '2023-02-07 11:49:10', NULL),
(16, 'individu', 4, 3, 3, 3, 5, 3, 3, 2, 2, 'kajfdkqwoifnlanf', '2023-02-04 13:21:28', NULL),
(17, 'individu', 4, 4, 4, 4, 5, 2, 3, 2, 2, 'Tarif tol mahal', '2023-02-26 21:50:11', NULL),
(18, 'individu', 3, 4, 3, 3, 4, 5, 3, 3, 3, 'tol tapi tetep macet', '2023-03-18 07:19:58', NULL),
(19, 'individu', 4, 3, 3, 3, 4, 2, 5, 4, 4, 'Tolong di aspal', '2023-01-18 12:22:41', NULL),
(20, 'individu', 3, 4, 5, 5, 2, 4, 3, 3, 3, 'Tarif jangan naik lagi', '2023-01-22 07:53:36', NULL),
(21, 'individu', 3, 4, 3, 4, 4, 5, 3, 3, 3, 'Pelayanan agar lebih ditingkatkan ', '2023-01-21 00:33:26', NULL),
(22, 'individu', 4, 4, 4, 3, 4, 4, 3, 3, 3, 'Mohon izin menyampaikan kepada bapak /ibu pejabat mungkin kedepan nya cctv pemantauan dapat di tambah titik lokasinya', '2023-03-04 15:27:58', NULL),
(23, 'individu', 4, 3, 4, 3, 4, 4, 4, 3, 3, 'ewG', '2023-02-01 19:35:24', NULL),
(24, 'individu', 4, 4, 4, 4, 3, 3, 3, 3, 4, '?', '2023-01-15 12:09:07', NULL),
(25, 'individu', 5, 2, 4, 3, 4, 3, 4, 4, 4, '-', '2023-02-09 11:58:11', NULL),
(26, 'individu', 4, 4, 4, 4, 4, 4, 3, 3, 3, '-', '2023-02-04 03:10:12', NULL),
(27, 'individu', 4, 4, 4, 4, 3, 4, 3, 3, 4, '-', '2023-03-13 22:18:37', NULL),
(28, 'individu', 4, 3, 4, 4, 3, 4, 4, 3, 4, '-', '2023-02-26 06:39:34', NULL),
(29, 'individu', 4, 4, 4, 4, 3, 3, 4, 3, 4, '-', '2023-02-10 06:43:23', NULL),
(30, 'individu', 4, 3, 4, 4, 4, 3, 4, 3, 4, 'Jalan tol cipali pada lebaran idul fitri jalannya sangat rusak dari jalan utama hingga bahu jalan', '2023-03-24 19:55:35', NULL),
(31, 'individu', 4, 4, 3, 4, 4, 3, 4, 3, 4, 'Tolong tingkatkan pelayana khususnya di tol trans Sumatera ', '2023-03-04 07:56:32', NULL),
(32, 'individu', 4, 4, 4, 3, 4, 3, 4, 3, 4, 'Di perbanyak penerangan jalan', '2023-02-13 03:16:51', NULL),
(33, 'individu', 4, 4, 3, 4, 5, 3, 3, 4, 4, '-', '2023-01-11 11:59:22', NULL),
(34, 'individu', 4, 4, 3, 3, 4, 4, 4, 4, 4, '-', '2023-03-10 07:04:58', NULL),
(35, 'individu', 4, 3, 4, 3, 4, 3, 5, 4, 4, '-', '2023-03-18 18:42:05', NULL),
(36, 'individu', 4, 4, 4, 4, 2, 3, 5, 4, 4, '-', '2023-03-14 22:55:10', NULL),
(37, 'individu', 3, 4, 4, 3, 5, 3, 4, 5, 3, '-', '2023-03-04 07:25:59', NULL),
(38, 'individu', 4, 3, 3, 4, 3, 4, 4, 5, 4, '-', '2023-02-20 12:27:21', NULL),
(39, 'individu', 4, 3, 4, 3, 4, 5, 4, 4, 3, '-', '2023-03-10 23:34:33', NULL),
(40, 'individu', 5, 5, 4, 3, 4, 4, 3, 3, 3, '-', '2023-02-19 19:21:39', NULL),
(41, 'individu', 4, 4, 4, 5, 3, 4, 3, 3, 4, '-', '2023-01-14 16:17:40', NULL),
(42, 'individu', 4, 3, 4, 4, 4, 3, 4, 3, 5, '-', '2023-02-25 22:37:30', NULL),
(43, 'individu', 4, 3, 3, 4, 4, 3, 4, 4, 5, '-', '2023-02-03 10:26:36', NULL),
(44, 'individu', 4, 3, 4, 4, 3, 3, 4, 4, 5, '-', '2023-01-19 01:17:39', NULL),
(45, 'individu', 4, 4, 5, 3, 2, 4, 5, 4, 4, 'good job', '2023-01-01 20:56:44', NULL),
(46, 'individu', 2, 4, 4, 4, 5, 3, 5, 4, 4, 'sipt', '2023-03-26 18:55:22', NULL),
(47, 'individu', 4, 4, 3, 4, 4, 3, 5, 4, 4, 'no komen', '2023-02-25 04:36:31', NULL),
(48, 'individu', 4, 4, 3, 3, 4, 4, 4, 5, 4, 'no komen', '2023-02-02 03:32:34', NULL),
(49, 'individu', 4, 4, 4, 4, 3, 3, 4, 5, 4, 'no komen', '2023-01-04 20:43:25', NULL),
(50, 'individu', 3, 4, 4, 4, 4, 4, 4, 4, 4, 'no komen', '2023-01-17 06:06:26', NULL),
(51, 'individu', 4, 4, 4, 5, 4, 4, 3, 3, 4, 'no komen', '2023-02-14 01:10:21', NULL),
(52, 'individu', 4, 4, 4, 4, 4, 3, 4, 3, 5, 'no komen', '2023-03-08 10:28:56', NULL),
(53, 'individu', 4, 4, 4, 4, 4, 3, 4, 4, 4, 'no komen', '2023-02-08 14:18:04', NULL),
(54, 'individu', 4, 4, 5, 4, 3, 4, 4, 3, 4, 'no komen', '2023-03-15 21:23:17', NULL),
(55, 'individu', 4, 4, 4, 5, 4, 3, 4, 3, 4, 'no komen', '2023-01-16 11:33:42', NULL),
(56, 'individu', 4, 3, 4, 5, 4, 4, 3, 4, 4, 'no komen', '2023-02-11 07:27:50', NULL),
(57, 'individu', 4, 4, 4, 4, 4, 4, 4, 3, 4, 'no komen', '2023-01-23 01:23:17', NULL),
(58, 'individu', 4, 4, 4, 4, 4, 3, 4, 4, 4, 'no komen', '2023-03-24 12:58:04', NULL),
(59, 'individu', 4, 5, 4, 3, 4, 3, 4, 4, 4, 'no komen', '2023-02-04 21:53:43', NULL),
(60, 'individu', 2, 5, 4, 4, 4, 4, 5, 4, 4, 'sudah baik', '2023-01-24 09:25:05', NULL),
(61, 'individu', 5, 4, 3, 4, 5, 4, 3, 4, 4, 'ditingkatkan lagi', '2023-02-21 05:59:35', NULL),
(62, 'individu', 4, 3, 4, 4, 5, 4, 4, 4, 4, 'sudah bagus', '2023-01-15 05:36:45', NULL),
(63, 'individu', 5, 4, 4, 4, 4, 5, 3, 4, 3, 'semangat', '2023-03-14 14:39:22', NULL),
(64, 'individu', 4, 5, 5, 4, 3, 4, 3, 4, 4, 'sudah baik', '2023-03-02 12:42:43', NULL),
(65, 'individu', 4, 3, 5, 4, 4, 4, 4, 3, 5, 'tingkatkan', '2023-03-03 02:58:39', NULL),
(66, 'individu', 4, 5, 4, 5, 4, 3, 4, 3, 4, 'joss', '2023-03-14 20:47:14', NULL),
(67, 'individu', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'joss', '2023-03-25 11:42:16', NULL),
(68, 'individu', 3, 4, 4, 5, 3, 5, 4, 5, 4, 'joss', '2023-01-04 02:45:44', NULL),
(69, 'individu', 4, 4, 4, 5, 4, 4, 3, 4, 5, 'no comment', '2023-03-05 16:08:07', NULL),
(70, 'individu', 4, 4, 4, 4, 4, 4, 4, 4, 5, 'Semoga bisa diakses kapanpun', '2023-01-14 01:29:34', NULL),
(71, 'individu', 4, 4, 5, 5, 3, 4, 4, 3, 5, 'Mantap', '2023-02-19 03:13:06', NULL),
(72, 'individu', 5, 4, 4, 4, 4, 4, 4, 4, 4, 'Sukses selalu', '2023-02-09 16:59:12', NULL),
(73, 'individu', 5, 3, 5, 3, 4, 4, 5, 5, 4, 'oke', '2023-02-23 21:12:45', NULL),
(74, 'individu', 5, 4, 4, 3, 5, 4, 4, 5, 4, 'Boleh laah….', '2023-03-27 11:07:58', NULL),
(75, 'individu', 4, 5, 4, 5, 4, 4, 5, 4, 4, 'Lumayan membantu', '2023-01-02 09:57:20', NULL),
(76, 'kelompok_masyarakat', 2, 3, 2, 4, 2, 2, 3, 2, 2, 'secutity mohon ditingkatkan', '2023-01-10 07:10:01', NULL),
(77, 'kelompok_masyarakat', 3, 3, 3, 3, 3, 4, 3, 3, 4, '???', '2023-01-21 09:18:48', NULL),
(78, 'kelompok_masyarakat', 4, 3, 4, 4, 3, 3, 3, 3, 3, 'Turunkan tarif TOL', '2023-03-06 03:28:04', NULL),
(79, 'kelompok_masyarakat', 4, 4, 4, 3, 3, 3, 3, 3, 3, 'Tampilannya kuno', '2023-01-26 12:37:59', NULL),
(80, 'kelompok_masyarakat', 4, 4, 4, 3, 3, 4, 3, 3, 3, 'ewkjghfojwe', '2023-03-14 19:54:55', NULL),
(81, 'kelompok_masyarakat', 4, 3, 3, 3, 4, 4, 3, 4, 4, 'wlkqnjfqlw', '2023-03-15 08:51:21', NULL),
(82, 'kelompok_masyarakat', 4, 3, 4, 4, 4, 3, 4, 3, 3, 'qwfknjlwqnk', '2023-02-24 07:53:14', NULL),
(83, 'kelompok_masyarakat', 5, 4, 4, 4, 4, 3, 4, 3, 3, '-', '2023-03-03 13:26:41', NULL),
(84, 'kelompok_masyarakat', 5, 4, 5, 3, 4, 4, 4, 3, 3, 'no komen', '2023-02-20 12:37:08', NULL),
(85, 'kelompok_masyarakat', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'sip', '2023-01-18 18:15:57', NULL),
(86, 'kelompok_masyarakat', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'sip', '2023-01-09 18:09:55', NULL),
(87, 'kelompok_masyarakat', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'mantab', '2023-03-09 00:28:02', NULL),
(88, 'kelompok_masyarakat', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'mantab', '2023-03-23 18:02:38', NULL),
(89, 'kelompok_masyarakat', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'mantab', '2023-02-08 15:24:16', NULL),
(90, 'kelompok_masyarakat', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'mantab', '2023-01-04 22:41:59', NULL),
(91, 'kelompok_masyarakat', 5, 5, 5, 4, 4, 3, 5, 3, 3, 'joss', '2023-01-05 18:49:28', NULL),
(92, 'kelompok_masyarakat', 4, 4, 4, 4, 4, 4, 4, 5, 4, 'sipt', '2023-01-16 07:06:59', NULL),
(93, 'kelompok_masyarakat', 4, 4, 4, 5, 4, 4, 4, 4, 4, 'mantab', '2023-03-18 16:06:35', NULL),
(94, 'kelompok_masyarakat', 4, 4, 4, 5, 4, 4, 4, 4, 5, 'Sangat membantu untuk melihat rute', '2023-03-28 00:14:02', NULL),
(95, 'kelompok_masyarakat', 4, 4, 4, 5, 4, 4, 4, 4, 5, 'Tarif tol update', '2023-01-24 22:54:02', NULL),
(96, 'kelompok_masyarakat', 4, 4, 4, 5, 4, 4, 4, 4, 5, 'joss', '2023-02-24 14:52:08', NULL),
(97, 'kelompok_masyarakat', 4, 4, 5, 4, 5, 4, 5, 4, 4, 'Tampilannya lumayan oke', '2023-02-07 08:54:18', NULL),
(98, 'kelompok_masyarakat', 4, 5, 4, 4, 5, 4, 5, 4, 4, 'Semoga tetap bisa di akses saat dibutuhkan', '2023-01-04 20:41:03', NULL),
(99, 'kelompok_masyarakat', 4, 4, 4, 4, 5, 5, 4, 5, 4, 'sip', '2023-03-19 00:01:41', NULL),
(100, 'kelompok_masyarakat', 4, 4, 4, 4, 5, 5, 5, 5, 4, 'Bagus', '2023-02-19 11:22:12', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kuesioner_answers`
--
ALTER TABLE `kuesioner_answers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kuesioner_answers`
--
ALTER TABLE `kuesioner_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
