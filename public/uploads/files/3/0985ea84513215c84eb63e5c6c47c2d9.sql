-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2013 at 07:02 PM
-- Server version: 5.6.13
-- PHP Version: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bpjt`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `caption` text,
  `url` varchar(255) NOT NULL,
  `semester` int(1) NOT NULL DEFAULT '0',
  `year` int(4) NOT NULL DEFAULT '0',
  `filename` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content_type` varchar(255) NOT NULL,
  `sub_content_type` varchar(255) NOT NULL DEFAULT '',
  `lang` varchar(5) NOT NULL DEFAULT 'id',
  `status` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `status` (`status`),
  KEY `lang` (`lang`),
  KEY `content_type` (`content_type`),
  KEY `filename` (`filename`),
  KEY `sub_content_type` (`sub_content_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `caption`, `url`, `semester`, `year`, `filename`, `slug`, `content_type`, `sub_content_type`, `lang`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Online Marketing Inside Out', 'Ini tentang online marketing yang dibahas dengan lengkap sekali.', 'http://local.bpjt.net/uploads/files/1/Sitepoint.Online.Marketing.Inside.Out.May.2009.pdf', 1, 2013, 'Sitepoint.Online.Marketing.Inside.Out.May.2009.pdf', 'online-marketing-inside-out', 'regulation', 'undang-undang', 'id', 'published', '2013-09-02 00:00:00', '2013-09-02 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
