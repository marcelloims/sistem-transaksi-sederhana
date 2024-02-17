-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2024 at 07:47 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(256) NOT NULL,
  `nama_barang` varchar(256) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `updated_by` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(14, 'BRG-001', 'Skin Care', 5000, 'admin@mailinator.com', 'admin@mailinator.com', '2024-02-16 12:44:19', '2024-02-16 12:44:19'),
(15, 'BRG-002', 'Body Care\r\n', 4000, 'admin@mailinator.com', 'admin@mailiantor.com', '2024-02-16 12:44:50', '2024-02-16 12:44:50'),
(28, 'BRG-003', 'Facial Care', 3000, 'admin@mailinator.com', 'admin@mailinator.com', '2024-02-17 00:03:30', '2024-02-17 00:03:30'),
(29, 'BRG-004', 'Hair Care', 2000, 'admin@mailinator.com', 'admin@mailinator.com', '2024-02-17 00:03:40', '2024-02-17 00:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_header`
--

CREATE TABLE `penjualan_header` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(256) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `customer` varchar(256) NOT NULL,
  `kode_promo` varchar(256) DEFAULT NULL,
  `total_bayar` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `updated_by` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_header`
--

INSERT INTO `penjualan_header` (`id`, `no_transaksi`, `tgl_transaksi`, `customer`, `kode_promo`, `total_bayar`, `ppn`, `grand_total`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, '202402-001', '2024-02-17 14:06:24', 'Marcello', NULL, 32000, 3200, 35200, 'admin@mailinator.com', 'admin@mailinator.com', '2024-02-17 14:06:24', '2024-02-17 14:06:24'),
(4, '202402-002', '2024-02-17 14:09:09', 'Cell', NULL, 12000, 1200, 13200, 'admin@mailinator.com', 'admin@mailinator.com', '2024-02-17 14:09:09', '2024-02-17 14:09:09'),
(5, '202402-003', '2024-02-17 14:16:35', 'Cell', NULL, 15000, 1500, 16500, 'admin@mailinator.com', 'admin@mailinator.com', '2024-02-17 14:16:35', '2024-02-17 14:16:35'),
(6, '202402-004', '2024-02-17 14:20:21', 'Marcell', NULL, 14000, 1400, 15400, 'admin@mailinator.com', 'admin@mailinator.com', '2024-02-17 14:20:21', '2024-02-17 14:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_header_detail`
--

CREATE TABLE `penjualan_header_detail` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(256) NOT NULL,
  `kode_barang` varchar(256) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_header_detail`
--

INSERT INTO `penjualan_header_detail` (`id`, `no_transaksi`, `kode_barang`, `qty`, `harga`, `discount`, `subtotal`) VALUES
(1, '202402-001', 'BRG-001', 4, 5000, NULL, 20000),
(2, '202402-001', 'BRG-002', 3, 4000, NULL, 12000),
(3, '202402-002', 'BRG-002', 2, 4000, NULL, 8000),
(4, '202402-002', 'BRG-004', 2, 2000, NULL, 4000),
(5, '202402-003', 'BRG-001', 3, 5000, NULL, 15000),
(6, '202402-004', 'BRG-001', 1, 5000, NULL, 5000),
(7, '202402-004', 'BRG-002', 1, 4000, NULL, 4000),
(8, '202402-004', 'BRG-003', 1, 3000, NULL, 3000),
(9, '202402-004', 'BRG-004', 1, 2000, NULL, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `kode_promo` varchar(256) NOT NULL,
  `nama_promo` varchar(256) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `updated_by` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `kode_promo`, `nama_promo`, `keterangan`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'promo-001', 'prmo facial care\r\n', 'setiap pembelian Facial Care sejumlah 2 pcs akan mendapat potongan harga 3000\r\n', 'admin@mailiantor.com', 'admin@mailiantor.com', '2024-02-16 16:09:10', '2024-02-16 16:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@mailinator.com', 'MEJOTWN6WU9GRU8xNGxoS2VrMFV3dz09', '2024-02-15 17:57:23', '2024-02-15 17:57:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_header`
--
ALTER TABLE `penjualan_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_header_detail`
--
ALTER TABLE `penjualan_header_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
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
-- AUTO_INCREMENT for table `master_barang`
--
ALTER TABLE `master_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penjualan_header`
--
ALTER TABLE `penjualan_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penjualan_header_detail`
--
ALTER TABLE `penjualan_header_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
