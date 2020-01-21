-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2020 at 03:33 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `r-penjadwalan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(15, 1, 1),
(19, 1, 3),
(21, 1, 11),
(24, 1, 9),
(28, 1, 3),
(29, 1, 2),
(30, 1, 2),
(31, 1, 12),
(35, 1, 10),
(36, 1, 13),
(37, 1, 14),
(38, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id_penjadwalan` int(11) NOT NULL,
  `tanggal_rencana_kunjungan` date NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id_penjadwalan`, `tanggal_rencana_kunjungan`, `id_mitra`, `keterangan`) VALUES
(2, '2020-01-19', 1, 'PERJALANAN DINAS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kunjungan`
--

CREATE TABLE `tbl_kunjungan` (
  `id_kunjungan` int(11) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `foto_kunjungan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kunjungan`
--

INSERT INTO `tbl_kunjungan` (`id_kunjungan`, `tanggal_kunjungan`, `id_mitra`, `keterangan`, `foto_kunjungan`) VALUES
(1, '2020-01-18', 3, 'PERJALANAN DINAS', 'xxx.jpg'),
(5, '2020-01-17', 2, 'PERJALANAN DINAS', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 'y'),
(2, 'TAMBAH USER', 'user', 'fa fa-user-o', 0, 'y'),
(3, 'AKSES MODUL USER', 'userlevel', 'fa fa-users', 0, 'y'),
(9, 'CONTOH FORM', 'welcome/form', 'fa fa-id-card', 0, 'y'),
(10, 'TES', 'tes', 'fa fa-user-o', 0, 'y'),
(11, 'HAK AKSES', 'hak_akses', 'fa fa-id-card', 0, 'y'),
(12, 'JADWAL', 'jadwal', 'fa fa-id-card', 0, 'y'),
(13, 'KUNJUNGAN', 'kunjungan', 'fa fa-id-card', 0, 'y'),
(14, 'MITRA', 'miitra', 'fa fa-id-card', 0, 'y'),
(15, 'KARYAWAN', 'ts', 'fa fa-id-card', 0, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mitra`
--

CREATE TABLE `tbl_mitra` (
  `id_mitra` int(11) NOT NULL,
  `nama_mitra` varchar(255) NOT NULL,
  `wilayah` varchar(35) NOT NULL,
  `no_hp_mitra` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mitra`
--

INSERT INTO `tbl_mitra` (`id_mitra`, `nama_mitra`, `wilayah`, `no_hp_mitra`) VALUES
(1, 'PT MITRA PERTAMA', 'BANDAR LAMPUNG', '0721 000000'),
(2, 'PT MITRA KEDUA', 'METRO', '0721 000000'),
(3, 'PT MITRA KETIGA', 'KALIANDA', '0721 000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ts`
--

CREATE TABLE `tbl_ts` (
  `id_ts` int(11) NOT NULL,
  `nama_ts` varchar(30) NOT NULL,
  `tempat_lahir_ts` varchar(50) NOT NULL,
  `tanggal_lahir_ts` date NOT NULL,
  `alamat_ts` int(11) NOT NULL,
  `pendidikan_ts` varchar(15) NOT NULL,
  `no_hp_ts` varchar(15) NOT NULL,
  `gol_darah_ts` varchar(11) NOT NULL,
  `id_penjadwalan` int(15) NOT NULL,
  `id_kunjungan` int(15) NOT NULL,
  `id_user_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 1, 'y'),
(3, 'admin', 'admin@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', '7.png', 2, 'y'),
(7, 'ibor', 'ibor@gmail.com', '$2y$04$djhfP13u5K4/L8c7Ze7ETOGkygIXSzpic0RvTEL2w31VAspgsSeWu', 'controlpanel.png', 3, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'PEGAWAI');

-- --------------------------------------------------------

--
-- Table structure for table `tes`
--

CREATE TABLE `tes` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tes`
--

INSERT INTO `tes` (`id`, `nama`) VALUES
(1, 'TES');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id_penjadwalan`) USING BTREE,
  ADD KEY `tbl_mitra` (`id_mitra`);

--
-- Indexes for table `tbl_kunjungan`
--
ALTER TABLE `tbl_kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`) USING BTREE,
  ADD KEY `id_mitra` (`id_mitra`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tbl_mitra`
--
ALTER TABLE `tbl_mitra`
  ADD PRIMARY KEY (`id_mitra`) USING BTREE;

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tbl_ts`
--
ALTER TABLE `tbl_ts`
  ADD PRIMARY KEY (`id_ts`) USING BTREE,
  ADD KEY `tbl_kunjungan` (`id_kunjungan`),
  ADD KEY `tbl_jadwal` (`id_penjadwalan`),
  ADD KEY `tbl_user_level` (`id_user_level`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- Indexes for table `tes`
--
ALTER TABLE `tes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id_penjadwalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_kunjungan`
--
ALTER TABLE `tbl_kunjungan`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_mitra`
--
ALTER TABLE `tbl_mitra`
  MODIFY `id_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_ts`
--
ALTER TABLE `tbl_ts`
  MODIFY `id_ts` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tes`
--
ALTER TABLE `tes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD CONSTRAINT `tbl_mitra` FOREIGN KEY (`id_mitra`) REFERENCES `tbl_mitra` (`id_mitra`);

--
-- Constraints for table `tbl_kunjungan`
--
ALTER TABLE `tbl_kunjungan`
  ADD CONSTRAINT `f_table_mitra` FOREIGN KEY (`id_mitra`) REFERENCES `tbl_mitra` (`id_mitra`);

--
-- Constraints for table `tbl_ts`
--
ALTER TABLE `tbl_ts`
  ADD CONSTRAINT `tbl_jadwal` FOREIGN KEY (`id_penjadwalan`) REFERENCES `tbl_jadwal` (`id_penjadwalan`),
  ADD CONSTRAINT `tbl_kunjungan` FOREIGN KEY (`id_kunjungan`) REFERENCES `tbl_kunjungan` (`id_kunjungan`),
  ADD CONSTRAINT `tbl_user_level` FOREIGN KEY (`id_user_level`) REFERENCES `tbl_user_level` (`id_user_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
