-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2024 at 10:00 PM
-- Server version: 10.5.22-MariaDB-cll-lve
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mocg6655_edor`
--

-- --------------------------------------------------------

--
-- Table structure for table `gps`
--

CREATE TABLE `gps` (
  `id` int(11) NOT NULL,
  `kordinat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gps`
--

INSERT INTO `gps` (`id`, `kordinat`) VALUES
(1, '-6.873282,109.154007');

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

CREATE TABLE `label` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`id`, `nama`) VALUES
(1, 'Adi Rahmad'),
(2, 'Sudirga'),
(3, 'Made Restu'),
(6, 'Vania Kezia'),
(8, 'Mujiharti'),
(9, 'Sarah ( Ni Luh Meliana L)'),
(10, 'adi'),
(11, 'adi');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user`, `pass`, `alamat`, `email`, `nama`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'kkkk', 'utara', 'Adi Rahmad Ramadhan', 'admin'),
(2, 'super', '1b3231655cebb7a1f783eddf27d254ca', 'super', 'utara', 'supervisi', 'sepervisi'),
(3, 'warga', '4ab7d9d3a2a915753862aa89e6ff319c', 'warga', 'barat', 'warga', 'warga'),
(4, 'warga2', '4ab7d9d3a2a915753862aa89e6ff319c', 'war2', 'baratdaya', 'war1', 'warga'),
(5, 'adi', 'c46335eb267e2e1cde5b017acb4cd799', 'edors', 'adirahmad607@gmail.com', 'edor', 'warga'),
(6, 'ainul', '110a4fa5d91e3af9ec1c099f934e6d7d', 'Surabaya', 'mainulyaqin8@gmail.com', 'Ainul', 'warga');

-- --------------------------------------------------------

--
-- Table structure for table `tb_daftar`
--

CREATE TABLE `tb_daftar` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `proses` int(11) NOT NULL,
  `face` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_daftar`
--

INSERT INTO `tb_daftar` (`id`, `nama`, `proses`, `face`) VALUES
(2, 'Sudirga', 1, 0),
(3, 'Adi Rahmad', 1, 0),
(4, 'Vania Kezia', 1, 0),
(5, 'Mujiharti', 1, 0),
(6, 'Made Restu', 1, 0),
(8, 'Sarah', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_imgdeteksi`
--

CREATE TABLE `tb_imgdeteksi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_imgdeteksi`
--

INSERT INTO `tb_imgdeteksi` (`id`, `nama`, `waktu`) VALUES
(1, 'panu_3109_20240922_131145.png', '2024-09-22 13:11:48'),
(2, 'panu_3955_20240922_131201.png', '2024-09-22 13:12:04'),
(3, 'kadasKurap_984_20240922_134346.png', '2024-09-22 13:43:53'),
(4, 'panu_3109_20240922_134350.png', '2024-09-22 13:43:53'),
(5, 'panu_3955_20240922_134351.png', '2024-09-22 13:43:54'),
(6, 'kadasKurap_9113_20240922_134736.png', '2024-09-22 13:47:40'),
(7, 'panu_6467_20240922_134737.png', '2024-09-22 13:47:41'),
(8, 'fluSingapura_2951_20240922_134808.png', '2024-09-22 13:48:11'),
(9, 'biduran_8084_20240922_134938.png', '2024-09-22 13:49:42'),
(10, 'biduran_677_20240922_135044.png', '2024-09-22 13:50:47'),
(11, 'fluSingapura_8687_20240922_135044.png', '2024-09-22 13:50:48'),
(12, 'kadasKurap_1320_20240922_135045.png', '2024-09-22 13:50:48'),
(13, 'panu_6644_20240922_135046.png', '2024-09-22 13:50:49'),
(14, 'bisul_8716_20240922_135216.png', '2024-09-22 13:52:19'),
(15, 'biduran_8011_20240922_135612.png', '2024-09-22 13:56:16'),
(16, 'biduran_9567_20240922_135638.png', '2024-09-22 13:56:41'),
(17, 'kadasKurap_1320_20240922_135045.png', '2024-09-22 14:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_proses`
--

CREATE TABLE `tb_proses` (
  `id` int(11) NOT NULL,
  `proses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_proses`
--

INSERT INTO `tb_proses` (`id`, `proses`) VALUES
(1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gps`
--
ALTER TABLE `gps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `label`
--
ALTER TABLE `label`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_daftar`
--
ALTER TABLE `tb_daftar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_imgdeteksi`
--
ALTER TABLE `tb_imgdeteksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_proses`
--
ALTER TABLE `tb_proses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gps`
--
ALTER TABLE `gps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `label`
--
ALTER TABLE `label`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_daftar`
--
ALTER TABLE `tb_daftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_imgdeteksi`
--
ALTER TABLE `tb_imgdeteksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_proses`
--
ALTER TABLE `tb_proses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
