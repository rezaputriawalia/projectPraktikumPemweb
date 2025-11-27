-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2025 at 08:45 AM
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
-- Database: `teduh`
--

-- --------------------------------------------------------

--
-- Table structure for table `mood`
--

CREATE TABLE `mood` (
  `id_mood` int(11) NOT NULL,
  `mood` varchar(50) NOT NULL,
  `note` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mood`
--

INSERT INTO `mood` (`id_mood`, `mood`, `note`, `id_user`, `created_at`) VALUES
(3, 'average', 'ini punya admin', 2, '0000-00-00'),
(5, 'great', 'horee', 3, '2025-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `questioncategory`
--

CREATE TABLE `questioncategory` (
  `id_category` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questioncategory`
--

INSERT INTO `questioncategory` (`id_category`, `category`) VALUES
(1, 'Pola tidur'),
(2, 'Pola makan'),
(3, 'Aktivitas fisik'),
(4, 'Hidrasi dan kebiasaan sehari-hari');

-- --------------------------------------------------------

--
-- Table structure for table `questionkesehatan`
--

CREATE TABLE `questionkesehatan` (
  `id_question` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questionkesehatan`
--

INSERT INTO `questionkesehatan` (`id_question`, `question`, `id_category`) VALUES
(1, 'Saya tidur 7–8 jam setiap malam', 1),
(2, 'Saya tidur dan bangun di jam yang hampir sama setiap hari', 1),
(3, 'Saya jarang begadang tanpa alasan penting', 1),
(4, 'Saya merasa segar saat bangun tidur', 1),
(5, 'Saya tidak menggunakan gadget 30 menit sebelum tidur', 1),
(6, 'Saya tidak sering terbangun di tengah malam', 1),
(7, 'Saya bisa tidur tanpa kesulitan', 1),
(8, 'Saya tidak tidur terlalu larut setiap harinya', 1),
(9, 'Saya sarapan sebelum memulai aktivitas', 2),
(10, 'Saya makan tiga kali sehari secara teratur', 2),
(11, 'Saya mengonsumsi sayuran setiap hari', 2),
(12, 'Saya mengonsumsi buah setiap hari', 2),
(13, 'Saya mengurangi makanan tinggi gula seperti minuman manis', 2),
(14, 'Saya menghindari makanan cepat saji atau gorengan', 2),
(15, 'Saya tidak makan berlebihan menjelang malam', 2),
(16, 'Saya mengonsumsi makanan berprotein cukup (telur, ikan, ayam, kacang)', 2),
(17, 'Saya tidak sering ngemil makanan tidak sehat.', 2),
(18, 'Saya mengatur porsi makan agar tidak berlebihan', 2),
(19, 'Saya berolahraga minimal 3 kali seminggu', 3),
(20, 'Saya rutin berjalan kaki atau beraktivitas fisik ringan setiap hari.', 3),
(21, 'Saya tidak duduk terlalu lama tanpa bergerak', 3),
(22, 'Saya melakukan peregangan agar tubuh tidak kaku', 3),
(23, 'Saya mencoba menjaga postur tubuh saat duduk atau bekerja', 3),
(24, 'Saya melakukan aktivitas rumah (menyapu, mencuci, dll) yang membantu bergerak', 3),
(25, 'Saya menghindari gaya hidup terlalu sedentari (rebahan/ duduk seharian)', 3),
(26, 'Saya minum minimal 6–8 gelas air putih setiap hari', 4),
(27, 'Saya membatasi konsumsi kopi atau minuman bersoda', 4),
(28, 'Saya tidak merokok', 4),
(29, 'Saya menjaga kebersihan tubuh setiap hari', 4),
(30, 'Saya memiliki waktu istirahat di tengah aktivitas agar tidak kelelahan', 4);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id_test` int(11) NOT NULL,
  `jenis_test` varchar(50) NOT NULL,
  `skortotal` int(11) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id_test`, `jenis_test`, `skortotal`, `ket`, `id_user`, `created_at`) VALUES
(1, '', 30, 'Sangat Sehat', 2, '2025-11-27'),
(2, 'Pola Hidup Sehat', 30, 'Sangat Sehat', 3, '2025-11-27'),
(3, 'Pola Hidup Sehat', 30, 'Sangat Sehat', 3, '2025-11-27'),
(4, 'Pola Hidup Sehat', 22, 'Sehat', 4, '2025-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `jenis_kelamin`, `email`, `password`, `usia`) VALUES
(2, 'putri', 'Perempuan', 'admin@gmail.com', '1234', 21),
(3, 'safna', 'Perempuan', 'putri@gmail.com', '12345', 20),
(4, 'safna', 'Perempuan', 'safna@gmail.com', '123', 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mood`
--
ALTER TABLE `mood`
  ADD PRIMARY KEY (`id_mood`),
  ADD KEY `fk_mood` (`id_user`);

--
-- Indexes for table `questioncategory`
--
ALTER TABLE `questioncategory`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `questionkesehatan`
--
ALTER TABLE `questionkesehatan`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `fk_category` (`id_category`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mood`
--
ALTER TABLE `mood`
  MODIFY `id_mood` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questioncategory`
--
ALTER TABLE `questioncategory`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questionkesehatan`
--
ALTER TABLE `questionkesehatan`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mood`
--
ALTER TABLE `mood`
  ADD CONSTRAINT `fk_mood` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `questionkesehatan`
--
ALTER TABLE `questionkesehatan`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`id_category`) REFERENCES `questioncategory` (`id_category`);

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
