-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2023 at 04:50 PM
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
-- Table structure for table `kuesioners`
--

CREATE TABLE `kuesioners` (
  `id` int(11) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `sequence` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuesioners`
--

INSERT INTO `kuesioners` (`id`, `question`, `sequence`, `type`, `answer`, `deleted_at`) VALUES
(1, 'Apakah persyaratan pelayanan mudah diperoleh?', 1, 'radio', '[\"Sangat Sulit\", \"Sulit\", \"Cukup Sulit\", \"Mudah\", \"Sangat Mudah\"]', NULL),
(2, 'Apakah persyaratan pelayanan mudah dipahami?', 2, 'radio', '[\"Sangat Sulit Dipahami\", \"Sulit Dipahami\", \"Cukup Sulit Dipahami\", \"Mudah Dipahami\", \"Sangat Mudah Dipahami\"]', NULL),
(3, 'Apakah prosedur pelayanan dipahami dengan jelas?', 3, 'radio', '[\"Sangat Sulit Dipahami\", \"Sulit Dipahami\", \"Cukup Sulit Dipahami\", \"Mudah Dipahami\", \"Sangat Mudah Dipahami\"]', NULL),
(4, 'Apakah prosedur pelayanan dapat dipenuhi dengan mudah?', 4, 'radio', '[\"Sangat Sulit Dipenuhi\", \"Sulit Dipenuhi\", \"Cukup Sulit Dipenuhi\", \"Mudah Dipenuhi\", \"Sangat Mudah Dipenuhi\"]', NULL),
(5, 'Apakah informasi tentang biaya pelayanan diketahui dengan jelas?', 5, 'radio', '[\"Sangat Tidak Jelas\", \"Tidak Jelas\", \"Cukup Jelas\", \"Jelas\", \"Sangat Jelas\"]', NULL),
(6, 'Apakah petugas pelayanan cepat dan responsif dalam memberikan pelayanan?', 6, 'radio', '[\"Sangat Lambat\", \"Lambat\", \"Cukup Cepat\", \"Cepat\", \"Sangat Cepat\"]', NULL),
(7, 'Apakah petugas pelayanan memiliki kompetensi pengetahuan yang memadai?', 7, 'radio', '[\"Sangat Tidak Memadai\", \"Tidak Memadai\", \"Cukup Memadai\", \"Memadai\", \"Sangat Memadai\"]', NULL),
(8, 'Apakah pelayanan diberikan tepat waktu sesuai yang diinformasikan?', 8, 'radio', '[\"Sangat Terlambat\", \"Terlambat\", \"Cukup Tepat Waktu\", \"Tepat Waktu\", \"Sangat Tepat Waktu\"]', NULL),
(9, 'Apakah pelayanan yang saudara peroleh memuaskan?', 9, 'radio', '[\"Sangat Tidak Puas\", \"Tidak Puas\", \"Cukup Puas\", \"Puas\", \"Sangat Puas\"]', NULL),
(10, 'Inputan/masukan sangat kami butuhkan dalam upaya perbaikan layanan guna', 10, 'text', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kuesioners`
--
ALTER TABLE `kuesioners`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kuesioners`
--
ALTER TABLE `kuesioners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
