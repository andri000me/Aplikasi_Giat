-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 12, 2021 at 08:53 AM
-- Server version: 5.7.33-0ubuntu0.16.04.1
-- PHP Version: 5.6.40-12+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_giat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` char(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
('1', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` char(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `tgl_input` date NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `stok` int(10) NOT NULL DEFAULT '0',
  `photo_barang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_customer`
--

CREATE TABLE `daftar_customer` (
  `kd_customer` char(10) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `alamat_customer` varchar(50) NOT NULL,
  `no_tlp_customer` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_karyawan`
--

CREATE TABLE `daftar_karyawan` (
  `kd_karyawan` char(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_tlp` int(13) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_karyawan`
--

INSERT INTO `daftar_karyawan` (`kd_karyawan`, `nama`, `alamat`, `no_tlp`, `jabatan`, `username`, `password`) VALUES
('KK001', 'darto', 'jakarta', 8976564, 'manager', 'darto', 'admin'),
('kk002', 'kiki', 'tangerang', 89867, 'owner', 'kiki', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_survey`
--

CREATE TABLE `hasil_survey` (
  `kd_survey` char(10) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `harga_import` varchar(50) NOT NULL,
  `harga_lokal` varchar(50) NOT NULL,
  `ukurkd_jadwal_ukur` char(10) NOT NULL,
  `sub_total_lokal` varchar(50) NOT NULL,
  `sub_total_import` varchar(50) NOT NULL,
  `keterangan_approve` varchar(20) NOT NULL DEFAULT 'not yet approve'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kerja`
--

CREATE TABLE `jadwal_kerja` (
  `kd_jadwal_kerja` int(10) NOT NULL,
  `tgl` varchar(20) NOT NULL,
  `jam_kerja` varchar(15) NOT NULL,
  `karyawankd_karyawan` char(10) NOT NULL,
  `keterangan` varchar(30) DEFAULT 'belum diisi',
  `ket_manual` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_ukur`
--

CREATE TABLE `jadwal_ukur` (
  `kd_jadwal_ukur` char(10) NOT NULL,
  `tgl_ukur` date NOT NULL,
  `jam_ukur` varchar(20) NOT NULL,
  `karyawankd_karyawan` char(10) NOT NULL,
  `customerkd_customer` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `kd_penjualan` char(10) NOT NULL,
  `jumlah_barang` int(10) NOT NULL,
  `harga_barang` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `waktu_kirim` varchar(50) NOT NULL,
  `karyawankd_karyawan` char(10) NOT NULL,
  `customerkd_customer` char(10) NOT NULL,
  `barangkd_barang` char(10) NOT NULL,
  `keterangan_approve` varchar(20) NOT NULL DEFAULT 'not yet approve'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip_ojek`
--

CREATE TABLE `trip_ojek` (
  `kd_perjalanan` char(10) NOT NULL,
  `titik_awal` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `tgl_trip` date NOT NULL,
  `foto_bukti` varchar(200) NOT NULL,
  `karyawankd_karyawan` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `daftar_customer`
--
ALTER TABLE `daftar_customer`
  ADD PRIMARY KEY (`kd_customer`);

--
-- Indexes for table `daftar_karyawan`
--
ALTER TABLE `daftar_karyawan`
  ADD PRIMARY KEY (`kd_karyawan`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `hasil_survey`
--
ALTER TABLE `hasil_survey`
  ADD PRIMARY KEY (`kd_survey`),
  ADD KEY `ukurkd_jadwal_ukur` (`ukurkd_jadwal_ukur`);

--
-- Indexes for table `jadwal_kerja`
--
ALTER TABLE `jadwal_kerja`
  ADD PRIMARY KEY (`kd_jadwal_kerja`),
  ADD KEY `karyawankd_karyawan` (`karyawankd_karyawan`);

--
-- Indexes for table `jadwal_ukur`
--
ALTER TABLE `jadwal_ukur`
  ADD PRIMARY KEY (`kd_jadwal_ukur`),
  ADD KEY `customerkd_customer` (`customerkd_customer`),
  ADD KEY `karyawankd_karyawan` (`karyawankd_karyawan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kd_penjualan`),
  ADD KEY `karyawankd_karyawan` (`karyawankd_karyawan`),
  ADD KEY `customerkd_customer` (`customerkd_customer`),
  ADD KEY `barangkd_barang` (`barangkd_barang`);

--
-- Indexes for table `trip_ojek`
--
ALTER TABLE `trip_ojek`
  ADD PRIMARY KEY (`kd_perjalanan`),
  ADD KEY `karyawankd_karyawan` (`karyawankd_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_kerja`
--
ALTER TABLE `jadwal_kerja`
  MODIFY `kd_jadwal_kerja` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_survey`
--
ALTER TABLE `hasil_survey`
  ADD CONSTRAINT `hasil_survey_ibfk_1` FOREIGN KEY (`ukurkd_jadwal_ukur`) REFERENCES `jadwal_ukur` (`kd_jadwal_ukur`);

--
-- Constraints for table `jadwal_kerja`
--
ALTER TABLE `jadwal_kerja`
  ADD CONSTRAINT `jadwal_kerja_ibfk_1` FOREIGN KEY (`karyawankd_karyawan`) REFERENCES `daftar_karyawan` (`kd_karyawan`);

--
-- Constraints for table `jadwal_ukur`
--
ALTER TABLE `jadwal_ukur`
  ADD CONSTRAINT `jadwal_ukur_ibfk_2` FOREIGN KEY (`customerkd_customer`) REFERENCES `daftar_customer` (`kd_customer`),
  ADD CONSTRAINT `jadwal_ukur_ibfk_3` FOREIGN KEY (`karyawankd_karyawan`) REFERENCES `daftar_karyawan` (`kd_karyawan`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`karyawankd_karyawan`) REFERENCES `daftar_karyawan` (`kd_karyawan`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`customerkd_customer`) REFERENCES `daftar_customer` (`kd_customer`),
  ADD CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`barangkd_barang`) REFERENCES `barang` (`kd_barang`);

--
-- Constraints for table `trip_ojek`
--
ALTER TABLE `trip_ojek`
  ADD CONSTRAINT `trip_ojek_ibfk_1` FOREIGN KEY (`karyawankd_karyawan`) REFERENCES `daftar_karyawan` (`kd_karyawan`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
