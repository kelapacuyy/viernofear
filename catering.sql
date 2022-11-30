-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 02:33 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konsultasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `berlangganan`
--

CREATE TABLE `berlangganan` (
  `id_langganan` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `id_toko` varchar(255) NOT NULL,
  `tanggal_awal_langganan` date NOT NULL,
  `tanggal_akhir_langganan` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `anak_kost`
--

CREATE TABLE `anak_kost` (
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat_kos` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_langganan` int(11) NOT NULL,
  `tagihan` varchar(255) NOT NULL,
  `jenis_pembayaran` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `toko_catering`
--

CREATE TABLE `toko_catering` (
  `id_toko` varchar(255) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tanggal_bergabung` date NOT NULL,
  `no_hp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko_catering`
--

INSERT INTO `toko_catering` (`id_toko`, `nama_toko`, `nama_pemilik`, `email`, `tanggal_bergabung`, `no_hp`) VALUES
('DRG01', 'Khadijah Catering', 'Khadijah', 'khadijah43@gmail.com', '2020-11-19', '089898349823'),
('DRG02', 'Cateringku Enak', 'Siti Fatimah', 'siti_fatimah@gmail.com', '2021-07-09', '085632349847'),
('DRG03', 'Catering Aja', 'Luthfiah', 'luthfi67@gmail.com', '2020-06-17', '083898349283'),
('BGR01', 'Marwah Catering', 'Marwah Sitanggang', 'sitanggang02@gmail.com', '2021-04-03', '089738492748'),
('DRG04', 'Yura Catering', 'Yura Yanita', 'yanita_yura@gmail.com', '2020-05-19', '085687577381'),
('DRG05', 'HealtyFood', 'Khusnul Janna', 'janna892@gmail.com', '2019-03-04', '089838849283'),
('DRG06', 'Goody Catering', 'Rowan Nur', 'nur_rowan@gmail.com', '2022-01-05', '087843988934'),
('BGR02', 'Catering Mama', 'Nurul Hudda', 'nurulhudda88@gmail.com', '2021-10-20', '089584578394'),
('LWL01', 'Koala Catering', 'Boby', 'boby87829@gmail.com', '2020-11-14', '089387346874');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berlangganan`
--
ALTER TABLE `berlangganan`
  ADD PRIMARY KEY (`id_langganan`),
  ADD KEY `berlangganan_toko_catering_id_fkey` (`id_toko`),
  ADD KEY `berlangganan_username_fkey` (`username`);

--
-- Indexes for table `anak_kost`
--
ALTER TABLE `anak_kost`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_langganan`);

--
-- Indexes for table `toko_catering`
--
ALTER TABLE `toko_catering`
  ADD PRIMARY KEY (`id_toko`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `toko_catering`
--
ALTER TABLE `berlangganan`
  MODIFY `id_langganan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berlangganan`
--
ALTER TABLE `berlangganan`
  ADD CONSTRAINT `berlangganan_toko_catering_id_fkey` FOREIGN KEY (`id_toko`) REFERENCES `toko_catering` (`id_toko`),
  ADD CONSTRAINT `berlangganan_username_fkey` FOREIGN KEY (`username`) REFERENCES `anak_kost` (`username`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_berlangganan_id_fkey` FOREIGN KEY (`id_langganan`) REFERENCES `berlangganan` (`id_langganan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
