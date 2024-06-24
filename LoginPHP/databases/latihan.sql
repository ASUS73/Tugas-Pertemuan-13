-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 09:07 AM
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
-- Database: `latihan`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_mhs` int(11) NOT NULL,
  `gambar_mhs` varchar(225) NOT NULL,
  `nim_mhs` varchar(225) NOT NULL,
  `nama_mhs` varchar(225) NOT NULL,
  `email_mhs` varchar(225) NOT NULL,
  `prodi` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_mhs`, `gambar_mhs`, `nim_mhs`, `nama_mhs`, `email_mhs`, `prodi`) VALUES
(1, 'leader.jpg', '2371192001', 'Tachibana Kanade', 'kanade@gmail.com', 'Teknik Informatika'),
(2, 'user-2.jpg', '2371192002', 'Satomi Rentaro', 'rentaro@gmail.com', 'Teknik Sipil'),
(3, 'user-1.jpg', '2371192003', 'Suzukaze Aoba', 'aoba@gmail.com', 'Teknik Komputer'),
(7, 'user-3.jpg', '2371192004', 'Accelerator', 'accelerator@gmail.com', 'Teknik Elektro');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_mhs`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
