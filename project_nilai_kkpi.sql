-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2017 at 11:21 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_nilai_kkpi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(8) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'eko', '$2y$10$xI9t43.a8SqIMtN11mxPM.H0kyoXDwmpi3j/JO7J9V5YVOEKcRdQ.', 'Eko Okda');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` int(11) NOT NULL,
  `nama_pelajaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `nama_pelajaran`) VALUES
(1, 'keterampilan komputer dan pengelolaan informasi');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `tampilkan_menu` enum('tampil','sembunyi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama_menu`, `link`, `icon`, `parent_id`, `tampilkan_menu`) VALUES
(1, 'beranda', '', 'fa fa-home', 0, 'tampil'),
(2, 'daftar nilai', '#', 'fa fa-bookmark', 0, 'tampil'),
(3, 'nilai ujian praktikum', 'praktikum', 'fa fa-file-excel-o', 2, 'tampil'),
(4, 'nilai ujian sekolah', 'ujian_sekolah', 'fa fa-file-word-o', 2, 'sembunyi'),
(5, 'logout', 'logout', 'fa fa-sign-out', 0, 'tampil');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nisn_siswa` varchar(10) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `type_test` enum('pg','essay','praktik') NOT NULL,
  `word` int(3) NOT NULL,
  `excel` int(3) NOT NULL,
  `powerpoint` int(3) NOT NULL,
  `access` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `nisn_siswa`, `mapel_id`, `type_test`, `word`, `excel`, `powerpoint`, `access`) VALUES
(5, '9980048860', 1, 'praktik', 85, 85, 85, 82),
(6, '9987135044', 1, 'praktik', 82, 80, 80, 80),
(7, '9995212934', 1, 'praktik', 90, 88, 88, 82),
(8, '9980141455', 1, 'praktik', 82, 82, 80, 82),
(9, '9983178875', 1, 'praktik', 88, 85, 83, 82),
(10, '9990525334', 1, 'praktik', 83, 82, 82, 82),
(11, '9997357270', 1, 'praktik', 85, 83, 83, 82),
(12, '9997357271', 1, 'praktik', 85, 83, 83, 82),
(13, '9990888819', 1, 'praktik', 82, 82, 80, 82),
(14, '9983283901', 1, 'praktik', 82, 80, 80, 80),
(15, '9996777876', 1, 'praktik', 82, 80, 80, 80),
(16, '9991062351', 1, 'praktik', 90, 88, 88, 82),
(17, '9989447331', 1, 'praktik', 85, 83, 83, 82),
(18, '9981817336', 1, 'praktik', 90, 88, 88, 82),
(19, '9996890483', 1, 'praktik', 82, 80, 80, 80),
(20, '9983651933', 1, 'praktik', 82, 82, 82, 80),
(21, '9983283918', 1, 'praktik', 88, 85, 85, 82),
(22, '6286455', 1, 'praktik', 85, 85, 83, 80),
(23, '9997372121', 1, 'praktik', 85, 85, 85, 82),
(24, '9996536905', 1, 'praktik', 88, 85, 85, 82),
(25, '1234567890', 1, 'praktik', 83, 82, 82, 80),
(26, '9991881233', 1, 'praktik', 85, 83, 83, 82),
(27, '9997151807', 1, 'praktik', 85, 85, 83, 82),
(28, '9994422997', 1, 'praktik', 85, 85, 85, 82),
(29, '9996372196', 1, 'praktik', 90, 88, 88, 82),
(30, '9985282452', 1, 'praktik', 90, 90, 88, 82);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `username` varchar(100) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`username`, `nisn`, `nama_lengkap`, `password`, `tempat_lahir`, `tgl_lahir`) VALUES
('K01020630214', '1234567890', 'SUNITA', '$2y$10$t2JDYIfkSmPoPLto6s2u0.O.98zT.YIepIxsPT9PzPi4iDEg2INh6', 'LEBAK', '1999-02-28'),
('K01020630187', '6286455', 'RUSWANTO', '$2y$10$fDz62l2ViQ06.q5wmHJIB.JUsnXgzfCvRKj1pkKSfCS4ZiPvbRbm.', 'Jakarta', '2000-09-23'),
('K01020630018', '9980048860', 'ANJELLA ANINDIYA MARTIN', '$2y$10$QLNmaJrOf9x5PCXrHWtDMOGAU.R8gn7vO4qaRztzHLZZl5QgpMRP2', 'Jakarta', '1998-08-09'),
('K01020630045', '9980141455', 'AVINDA LESTARI', '$2y$10$MLowiSteukYt01zF2gldsewbBPTds4S3hC31xJqP2qwuhPu52sKZ2', 'Jakarta', '1998-10-08'),
('K01020630143', '9981817336', 'PRIMA DANA PUTRA', '$2y$10$cjGP5aD15kvGXz7sNA/XnOkYxUfpTShb7GLbmytBNwacSuCEcmOIW', 'Jakarta', '1998-12-22'),
('K01020630054', '9983178875', 'BERNADETTE FIANA', '$2y$10$6ybuUXQ8Owd2BltarW3SQeDKf99E0ML0I/ZZpbBl9.3NBZyEfrReO', 'Jakarta', '1998-08-20'),
('K01020630107', '9983283901', 'IHSANUL HAKIMIN', '$2y$10$lNH4mxKef3Izu2FjR5AVHuNNdaNd4/kfekiFrFDlDXo2aVofQvDB2', 'AMBACANG', '1998-05-14'),
('K01020630178', '9983283918', 'ROSIANA', '$2y$10$kelWPNYwqfyGs/zsDb3w0uLtQzNjocHkuczgYCvKMSpmC1n9OCmFC', 'PALEMBANG', '1998-10-21'),
('K01020630169', '9983651933', 'RISKI SETYO SUPRIYANTO', '$2y$10$lZUO3k80LShP6tRmTOhadOuegaFoQ2.pKsNjW0ar1hRaYlNjUtE7O', 'BOYOLALI', '1998-08-07'),
('K01020630267', '9985282452', 'YUNI ASIATUROHMAH', '$2y$10$30HambWJeBVWAlzdqWccWewa5AZY5AtLE7qSe63bYznjhszcYmSIS', 'TEGAL', '1998-06-14'),
('K01020630027', '9987135044', 'ARI INDRA JAYA', '$2y$10$BbvORp53nKvO15MoDpie0OzEPII.EasQHsjSDcitcrkCmUx7EPaBa', 'Indramayu', '1998-03-14'),
('K01020630134', '9989447331', 'PALENTINA DWIYANA', '$2y$10$D4Rnh7Mg7O5rAAbr6/eZQuZqqFLuXX2JfJBAELZgPtyWhmgjoWzwa', 'SUKABUMI', '1998-02-19'),
('K01020630063', '9990525334', 'DIANA SARI', '$2y$10$AQO8ZFYToXYj1xC.Sx7nNOue7WysPxTWvPDabybzTXJQrNU.FPEYi', 'Jakarta', '1999-03-08'),
('K01020630098', '9990888819', 'EVA ROSALINA', '$2y$10$.Z1dZr34xz7kVXQLWlaYvuFd5uFawaP0S8XE46dzbxWFVpJ2R7gPa', 'BREBES', '1999-06-08'),
('K01020630125', '9991062351', 'LANNY YUFIA', '$2y$10$qaTEIwosOdN3Q8lW8Pu35eAfO06l1/zMKy0ufkvJUVujWGVSHY6Ni', 'Jakarta', '1999-12-12'),
('K01020630223', '9991881233', 'TIA WIDYANTI', '$2y$10$qyu6U/DHzTFZJP6P7P9nluqc24iCAm.Fi5apxb8cE3S22oIqdQx7O', 'CIANJUR', '1999-05-02'),
('K01020630249', '9994422997', 'WARNESIH', '$2y$10$gJkRXQgppeSiqXzV8k8zueXu4LGx2Bx55nB8TbWunCkqJ0vjb2uum', 'INDRAMAYU', '1999-09-05'),
('K01020630036', '9995212934', 'AULIYAH UMMAROH', '$2y$10$tmyQci/RyK/r1FSspoynOOzBzwR1j5nmfitMh5jk742.BFKrQ4RnC', 'Jakarta', '1999-08-04'),
('K01020630258', '9996372196', 'YOLANDHA', '$2y$10$K5gBnbZ2oxxaYrrUIzAFo.3.NMkqNRdhjsDSUFP98uqJqrA8eFqyq', 'TANGERANG', '1999-12-09'),
('K01020630205', '9996536905', 'SUCI ANDINI', '$2y$10$cAS/uSlxeiT8C3/ThKHO.O1vn1qyAYbyzexvnCoKPUtptsrEw.IbO', 'Jakarta', '1999-09-15'),
('K01020630116', '9996777876', 'ISNA HUSNUL KHOTIMAH GITA SAPUTRI', '$2y$10$tlV02pBW0fK6GQbZQ3f3T.YfZsah/pik.kCnf6k8Xuh8xbhXh41hG', 'PATI', '1999-07-27'),
('K01020630152', '9996890483', 'RICHARD', '$2y$10$anp9r25Bqq5yf1GQLrRkyeqQ1Le0mfAZynQqEkY9D9vu.irDWY0OC', 'Jakarta', '1999-01-22'),
('K01020630232', '9997151807', 'VERONIKA PUTRI ELA REFORMA', '$2y$10$gh/oXvuqlpt7.u7S9Ru4COAoCCbLyLTLPfZ21PoJCnF94JRDZPAsS', 'MAGETAN', '1999-06-19'),
('K01020630072', '9997357270', 'ELVARA YULIANA', '$2y$10$6jryhYuj0WjYSXzCAa2OnOVHbtYMI5I4nRpLDdLaA0xlkZ2O7Z.Y6', 'Jakarta', '1999-01-31'),
('K01020630089', '9997357271', 'ELVIRA YULIANI', '$2y$10$xe/4O9W52FN2OMKd5/mCJOZoNxH3HVqVmQPWszt3Ccs54KRSq9Mfu', 'Jakarta', '1999-01-31'),
('K01020630196', '9997372121', 'SANDI', '$2y$10$q1HbKKoYIAIiqWh/WMNf.OweVMyadwf/EX2agUPzJ20bX/dflcyp6', 'Jakarta', '1999-09-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mapel_id` (`mapel_id`),
  ADD KEY `nisn_siswa` (`nisn_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajaran` (`id`),
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`nisn_siswa`) REFERENCES `siswa` (`nisn`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
