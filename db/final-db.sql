-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 05:33 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduanapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id` int(11) NOT NULL,
  `nama_lab` varchar(30) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id`, `nama_lab`, `id_user`, `created_at`) VALUES
(7, 'lab bahasa', 8, '2022-11-14 21:15:56'),
(8, 'Lab 2', 9, '2022-11-16 11:10:11'),
(9, 'Lab 2s', 17, '2022-12-03 16:52:11'),
(10, 'lab umum-1', 18, '2022-12-26 09:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `id_prop` int(11) NOT NULL,
  `id_teknisi` int(11) NOT NULL,
  `nama_pelapor` varchar(30) NOT NULL,
  `npm` int(11) NOT NULL,
  `masalah` text NOT NULL,
  `foto_bukti` varchar(50) NOT NULL DEFAULT '''no.png''',
  `status` enum('diproses','selesai','divalidasi') NOT NULL DEFAULT 'diproses',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `id_prop`, `id_teknisi`, `nama_pelapor`, `npm`, `masalah`, `foto_bukti`, `status`, `created_at`) VALUES
(3, 1, 11, 'andri', 120140191, 'koneksi mati', 'Diagram Tanpa Judul.jpg', 'selesai', '2022-11-18 14:05:02'),
(4, 3, 11, 'andri2', 120140192, 'layar mati', 'no.png', 'diproses', '2022-11-16 14:05:37'),
(5, 12, 14, 'Andri', 120140191, 'bluescreen', 'no.png', 'selesai', '2022-12-03 16:54:56'),
(6, 12, 14, 'alex', 20753023, 'hardisk eror', 'logo-polinela.png', 'selesai', '2022-12-17 13:46:22'),
(7, 11, 14, 'jonathan', 207563002, 'Hardisk tidak terbaca', 'logo-polinela.png', 'selesai', '2022-12-17 13:50:08'),
(8, 11, 14, 'jonathan', 20753023, 'hardisk eror', 'foto-bukti.png', 'selesai', '2022-12-17 13:51:40'),
(9, 8, 15, 'budi', 20653003, 'monitor rusak', '\'no.png\'', 'divalidasi', '2022-12-26 04:43:15'),
(10, 18, 15, 'Ocha', 20763018, 'Hidup tidak tampil', '1.png', 'diproses', '2022-12-26 09:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `properti`
--

CREATE TABLE `properti` (
  `id` int(11) NOT NULL,
  `nama_prop` varchar(10) NOT NULL,
  `status` enum('aman','problem') NOT NULL DEFAULT 'aman',
  `xPos` int(11) NOT NULL,
  `yPos` int(11) NOT NULL,
  `id_lab` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `properti`
--

INSERT INTO `properti` (`id`, `nama_prop`, `status`, `xPos`, `yPos`, `id_lab`, `created_at`) VALUES
(3, 'pc1-lab-ko', 'problem', 891, 603, 7, '2022-11-15 09:26:48'),
(4, 'b-ca', 'aman', 296, 382, 7, '2022-11-15 16:45:57'),
(7, 'tes-ting', 'aman', 488, 382, 7, '2022-11-16 10:53:23'),
(8, 'PC-24', 'aman', 303, 343, 8, '2022-11-16 11:10:59'),
(9, 'hello-s', 'aman', 694, 383, 7, '2022-12-03 10:53:04'),
(10, 'b', 'aman', 883, 383, 7, '2022-12-03 11:11:10'),
(11, 'pc-1', 'aman', 298, 369, 9, '2022-12-03 16:53:05'),
(12, 'pc-2', 'aman', 469, 371, 9, '2022-12-03 16:53:26'),
(13, 'printer-ca', 'aman', 300, 602, 7, '2022-12-14 07:09:31'),
(14, 'printer', 'aman', 492, 606, 7, '2022-12-14 07:09:48'),
(15, 'pc4', 'aman', 688, 607, 7, '2022-12-14 07:10:46'),
(16, 'pc-3', 'aman', 655, 356, 9, '2022-12-14 15:05:37'),
(17, 'printer-2', 'aman', 1064, 380, 7, '2022-12-14 19:41:02'),
(18, 'PC-Teknisi', 'problem', 496, 341, 8, '2022-12-26 09:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `ttd_laporan`
--

CREATE TABLE `ttd_laporan` (
  `id` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `file_rt` varchar(100) NOT NULL,
  `id_lab` int(11) NOT NULL,
  `file_kaleb` varchar(100) NOT NULL,
  `status` enum('dikirim','dibalas') NOT NULL DEFAULT 'dikirim',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ttd_laporan`
--

INSERT INTO `ttd_laporan` (`id`, `pesan`, `file_rt`, `id_lab`, `file_kaleb`, `status`, `created_at`) VALUES
(1, 'tes pesan', 'DOC-RT.pdf', 7, '', 'dikirim', '2022-12-07 10:38:21'),
(2, 'tolong ditandatangani', 'DOC-RT.pdf', 9, 'DOC-KALAB.pdf', 'dibalas', '2022-12-07 10:46:24'),
(3, 'tolong ditandatangani', 'DOC-RT.pdf', 9, 'DOC-KALAB.pdf', 'dibalas', '2022-12-22 10:43:32'),
(4, 'Tolong ditandatangani', 'PUM_BAB_1-4_lengkap revisi bismillah (2).docx', 8, '', 'dikirim', '2022-12-26 10:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL DEFAULT '$2y$10$wJ6NtPz/Wgq3OI3INu0flecs/Yvz3tJfI3RDNFIgd2Y4zV80zUrlO',
  `role` enum('rt','kalab','teknisi') NOT NULL,
  `id_lab` int(11) NOT NULL DEFAULT 0,
  `NIP` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `id_lab`, `NIP`, `created_at`) VALUES
(1, 'Rumah Tangga', 'akunrt@gmail.com', '$2y$10$OZK9RQ.g9vr0s0sgTaAUHOYBpdnhSOBPi/0b4.iK.jcENErIZHUQ2', 'rt', 0, '1234', '2022-11-13 00:00:00'),
(8, 'tes kalab 1', 'kalab1@gmail.com', '$2y$10$r/ODow950H/ax.8ZncL/NulKnUZvox.3BsSDrdACCFnmk6/0XVWMK', 'kalab', 7, '12345', '2022-11-14 20:44:46'),
(9, 'tes kalab 2', 'kalab2@gmail.com', '$2y$10$wJ6NtPz/Wgq3OI3INu0flecs/Yvz3tJfI3RDNFIgd2Y4zV80zUrlO', 'kalab', 8, '123456', '2022-11-14 20:46:12'),
(11, 'teknisi 1', 'teknisi1@gmail.com', '$2y$10$BZuu1mnSoK2RlrXVIPy87.osWxaBOe0S8JAdvDMcWtgCsmOMtldPW', 'teknisi', 0, '1234567', '2022-11-14 21:45:29'),
(14, 'teknisi lab 2s', 'teklab2s@gmail.com', '$2y$10$wJ6NtPz/Wgq3OI3INu0flecs/Yvz3tJfI3RDNFIgd2Y4zV80zUrlO', 'teknisi', 0, '1234567', '2022-12-03 16:54:02'),
(15, 'ocha', 'ocha@gmail.com', '$2y$10$wJ6NtPz/Wgq3OI3INu0flecs/Yvz3tJfI3RDNFIgd2Y4zV80zUrlO', 'teknisi', 8, '1234567', '2022-12-14 09:45:33'),
(16, 'budi', 'budi@gmail.com', '$2y$10$dUQrgfMceIQc9GUz2CS9weIKZB9p7oNXW88BsbY7DVZigPrtMzj9W', 'teknisi', 7, '1234567', '2022-12-14 14:30:05'),
(17, 'aries', 'aries@gmail.com', '$2y$10$wJ6NtPz/Wgq3OI3INu0flecs/Yvz3tJfI3RDNFIgd2Y4zV80zUrlO', 'kalab', 9, '1234567', '2022-12-22 10:40:00'),
(18, 'budianto', 'budianto@gmail.com', '$2y$10$wJ6NtPz/Wgq3OI3INu0flecs/Yvz3tJfI3RDNFIgd2Y4zV80zUrlO', 'kalab', 10, '1234567', '2022-12-26 09:50:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properti`
--
ALTER TABLE `properti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `ttd_laporan`
--
ALTER TABLE `ttd_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `properti`
--
ALTER TABLE `properti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ttd_laporan`
--
ALTER TABLE `ttd_laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
