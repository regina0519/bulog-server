-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2021 at 03:42 PM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18013485_bulog`
--

-- --------------------------------------------------------

--
-- Table structure for table `00tes`
--

CREATE TABLE `00tes` (
  `id` int(11) NOT NULL,
  `tes_string` varchar(255) NOT NULL,
  `tes_double` double NOT NULL,
  `tes_boolean` tinyint(1) NOT NULL,
  `tes_datetime` datetime NOT NULL,
  `tes_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='for testing';

--
-- Dumping data for table `00tes`
--

INSERT INTO `00tes` (`id`, `tes_string`, `tes_double`, `tes_boolean`, `tes_datetime`, `tes_text`) VALUES
(1, 'String test', 123456, 1, '2021-10-17 00:00:00', 'Tes text\r\nHaha\r\nHihi');

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id_setting` int(11) NOT NULL,
  `app_user_key` varchar(10) NOT NULL,
  `app_pass_key` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id_setting`, `app_user_key`, `app_pass_key`) VALUES
(1, 'RM_USER', 'RM_PASS');

-- --------------------------------------------------------

--
-- Table structure for table `ref_bidang`
--

CREATE TABLE `ref_bidang` (
  `id_bidang` varchar(10) NOT NULL,
  `nm_bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_bidang`
--

INSERT INTO `ref_bidang` (`id_bidang`, `nm_bidang`) VALUES
('BIDANG_001', 'Administrasi dan Keuangan'),
('BIDANG_002', 'Komersial'),
('BIDANG_003', 'Operasional dan Pelayanan Publik'),
('BIDANG_004', 'Pengadaan');

-- --------------------------------------------------------

--
-- Table structure for table `ref_fungsi_disposisi`
--

CREATE TABLE `ref_fungsi_disposisi` (
  `id_fungsi` varchar(10) NOT NULL,
  `fungsi_disposisi` varchar(30) NOT NULL,
  `ket_fungsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_fungsi_disposisi`
--

INSERT INTO `ref_fungsi_disposisi` (`id_fungsi`, `fungsi_disposisi`, `ket_fungsi`) VALUES
('FUNGSI_001', 'Pembuat Tagihan', 'Yang membuat tagihan'),
('FUNGSI_002', 'Pangaju Tagihan', 'Yang mengajukan tagihan'),
('FUNGSI_003', 'Kakanwil', 'Kepala Kantor'),
('FUNGSI_004', 'Admin Keuangan', 'Admin Keuangan'),
('FUNGSI_005', 'Verifikator', 'Yang memverifikasi dokumen'),
('FUNGSI_006', 'Bag. Keuangan', 'Yang meproses pencairan dana');

-- --------------------------------------------------------

--
-- Table structure for table `ref_jabatan`
--

CREATE TABLE `ref_jabatan` (
  `id_jab` varchar(10) NOT NULL,
  `id_bidang` varchar(10) NOT NULL,
  `id_fungsi` varchar(10) NOT NULL,
  `nm_jab` varchar(255) NOT NULL,
  `singk_jab` varchar(10) NOT NULL,
  `adalah_kepala_bidang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_jabatan`
--

INSERT INTO `ref_jabatan` (`id_jab`, `id_bidang`, `id_fungsi`, `nm_jab`, `singk_jab`, `adalah_kepala_bidang`) VALUES
('JABATAN001', '', 'FUNGSI_003', 'Kepala Kantor Wilayah', 'Kakanwil', 0),
('JABATAN002', 'BIDANG_001', 'FUNGSI_004', 'Kepala Bidang Administrasi dan Keuangan', 'Kab Minku', 1),
('JABATAN003', 'BIDANG_001', 'FUNGSI_001', 'Kepala Seksi Sekretariat, Umum dan Humas', 'Kasi Umum', 0),
('JABATAN004', 'BIDANG_001', 'FUNGSI_006', 'Kepala Seksi Keuangan', 'Kasi Keu', 0),
('JABATAN005', 'BIDANG_001', 'FUNGSI_001', 'Kepala Seksi SDM, Hukum dan Manajemen Perubahan', 'Kasi SDMHM', 0),
('JABATAN006', 'BIDANG_001', 'FUNGSI_001', 'Kepala Seksi Akuntansi', 'Kasi Akun', 0),
('JABATAN007', 'BIDANG_002', 'FUNGSI_002', 'Kepala Bidang Komersial', 'Kab Kom', 1),
('JABATAN008', 'BIDANG_002', 'FUNGSI_001', 'Kepala Seksi Penjualan Ritel', 'Kasi Ritel', 0),
('JABATAN009', 'BIDANG_002', 'FUNGSI_001', 'Kepala Seksi Penjualan Grosir dan Pasar Pemerintah', 'Kasi PGPP', 0),
('JABATAN010', 'BIDANG_002', 'FUNGSI_001', 'Kepala Seksi Komunikasi dan Pemasaran', 'Kasi Kompe', 0),
('JABATAN011', 'BIDANG_002', 'FUNGSI_001', 'Kepala Seksi Pengolahan', 'Kasi Olah', 0),
('JABATAN012', 'BIDANG_002', 'FUNGSI_001', 'Kepala Seksi Informasi dan Teknologi', 'Kasi IT', 0),
('JABATAN013', 'BIDANG_003', 'FUNGSI_002', 'Kepala Bidang Operasional dan Pelayanan Publik', 'Kabid OPP', 1),
('JABATAN014', 'BIDANG_003', 'FUNGSI_001', 'Kepala Seksi Pergudangan, Persediaan dan Angkutan', 'Kasi P2A', 0),
('JABATAN015', 'BIDANG_003', 'FUNGSI_001', 'Kepala Seksi Perawatan dan Pengendalian Mutu', 'Kasi P2M', 0),
('JABATAN016', 'BIDANG_003', 'FUNGSI_001', 'Kepala Seksi Perencanaan Operasional dan Data Pangan', 'Kasi PODP', 0),
('JABATAN017', 'BIDANG_004', 'FUNGSI_002', 'Kepala Bidang Pengadaan', 'Kab ADA', 1),
('JABATAN018', 'BIDANG_004', 'FUNGSI_001', 'Kepala Seksi Pengadaan Barang dan Jasa', 'Kasi PBJ', 0),
('JABATAN019', 'BIDANG_004', 'FUNGSI_001', 'Kepala Seksi Pengadaan Pangan', 'Kasi PP', 0),
('JABATAN020', 'BIDANG_001', 'FUNGSI_005', 'Staf Akuntasi', 'Staf Akun', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbldet_item_tagihan`
--

CREATE TABLE `tbldet_item_tagihan` (
  `id_det_item` varchar(70) NOT NULL,
  `id_tagihan` varchar(34) NOT NULL,
  `id_item` varchar(25) NOT NULL,
  `qty` double NOT NULL,
  `harga` double NOT NULL,
  `ket_det_item` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldet_item_tagihan`
--

INSERT INTO `tbldet_item_tagihan` (`id_det_item`, `id_tagihan`, `id_item`, `qty`, `harga`, `ket_det_item`) VALUES
('DET_TAG_BIDANG_001_20210101000000_0001_ITEM_20210101000000_00001_00001', 'TAG_BIDANG_001_20210101000000_0001', 'ITEM_20210101000000_00001', 5, 15000, ''),
('DET_TAG_BIDANG_001_20210101000000_0001_ITEM_20210101000000_00002_00001', 'TAG_BIDANG_001_20210101000000_0001', 'ITEM_20210101000000_00002', 10, 10000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `id_item` varchar(25) NOT NULL,
  `nm_item` varchar(255) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `harga_patokan` double NOT NULL,
  `ket_item` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`id_item`, `nm_item`, `satuan`, `harga_patokan`, `ket_item`) VALUES
('ITEM_20210101000000_00001', 'Ballpoint Baliner Hitam', 'Buah', 25000, ''),
('ITEM_20210101000000_00002', 'Ballpoint Baliner Merah', 'Buah', 30000, ''),
('ITEM_20211122031617_00001', 'Hahah', 'Hihi', 5000, 'Nnn'),
('ITEM_20211122153933_00001', 'Tes', 'Ggg', 2500, ''),
('ITEM_20211122185320_00001', 'Napa', 'Ini', 234, ''),
('ITEM_20211122185458_00001', 'Gina', 'Nut', 3000, ''),
('ITEM_20211124195056_00001', 'Hahay', 'Uuy', 6000, ''),
('ITEM_20211127182025_00001', 'Tes validation', 'Gjj', 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` varchar(20) NOT NULL,
  `id_jab` varchar(10) NOT NULL,
  `nm_pegawai` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipe_user` varchar(45) NOT NULL,
  `ganti_pass` tinyint(1) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `id_jab`, `nm_pegawai`, `password`, `tipe_user`, `ganti_pass`, `aktif`) VALUES
('087408748', 'JABATAN002', 'Noldi Ramayadi', '$2y$10$oKiXcytz6ras5MzYFJhMR.LaI0vz9gP9KtuXgi34uilo78r91Trai', 'Pengguna', 0, 1),
('087408749', 'JABATAN001', 'Ali Ahmad Najih Amsari', '$2y$10$LNowAZrekluu793oOM6cy.AMDUjx.lEv.Y3PKVDAATb5SSnAiGPPy', 'Pengguna', 0, 1),
('087408750', 'JABATAN004', 'Maria Sarkol', '$2y$10$LNowAZrekluu793oOM6cy.AMDUjx.lEv.Y3PKVDAATb5SSnAiGPPy', 'Pengguna', 0, 1),
('087408751', 'JABATAN012', 'Vica Lalujan', '$2y$10$LNowAZrekluu793oOM6cy.AMDUjx.lEv.Y3PKVDAATb5SSnAiGPPy', 'Admin', 0, 1),
('087408752', 'JABATAN013', 'Maradona Singal', '$2y$10$LNowAZrekluu793oOM6cy.AMDUjx.lEv.Y3PKVDAATb5SSnAiGPPy', 'Pengguna', 0, 1),
('087408753', 'JABATAN007', 'Sherly Ransingin', '$2y$10$LNowAZrekluu793oOM6cy.AMDUjx.lEv.Y3PKVDAATb5SSnAiGPPy', 'Pengguna', 0, 1),
('087408754', 'JABATAN020', 'Rachmad Wunangkolu', '$2y$10$LNowAZrekluu793oOM6cy.AMDUjx.lEv.Y3PKVDAATb5SSnAiGPPy', 'Pengguna', 0, 1),
('087408755', 'JABATAN009', 'Ireneus Kevin Vinsensius', '$2y$10$LNowAZrekluu793oOM6cy.AMDUjx.lEv.Y3PKVDAATb5SSnAiGPPy', 'Pengguna', 0, 1),
('087408756', 'JABATAN015', 'Vinsensius Dattu Yudanto', '$2y$10$LNowAZrekluu793oOM6cy.AMDUjx.lEv.Y3PKVDAATb5SSnAiGPPy', 'Pengguna', 0, 1),
('087408757', 'JABATAN018', 'Fajrul Iman Ibrahim', '$2y$10$LNowAZrekluu793oOM6cy.AMDUjx.lEv.Y3PKVDAATb5SSnAiGPPy', 'Pengguna', 0, 1),
('087408758', 'JABATAN017', 'Herman', '$2y$10$LNowAZrekluu793oOM6cy.AMDUjx.lEv.Y3PKVDAATb5SSnAiGPPy', 'Pengguna', 0, 1),
('087408759', 'JABATAN003', 'Novita Lampasian', '$2y$10$LNowAZrekluu793oOM6cy.AMDUjx.lEv.Y3PKVDAATb5SSnAiGPPy', 'Pengguna', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tagihan`
--

CREATE TABLE `tbl_tagihan` (
  `id_tagihan` varchar(34) NOT NULL,
  `ket_tagihan` varchar(255) NOT NULL,
  `id_bidang` varchar(10) NOT NULL,
  `id_pembuat` varchar(20) NOT NULL,
  `nm_pembuat` varchar(255) NOT NULL,
  `jab_pembuat` varchar(255) NOT NULL,
  `cat_pembuat` text NOT NULL,
  `tgl_pembuatan` datetime NOT NULL,
  `status_pembuatan` tinyint(4) NOT NULL,
  `no_nota_intern` varchar(30) NOT NULL,
  `id_pengaju` varchar(20) DEFAULT NULL,
  `nm_pengaju` varchar(255) DEFAULT NULL,
  `jab_pengaju` varchar(255) DEFAULT NULL,
  `cat_pengaju` text DEFAULT NULL,
  `tgl_pengajuan` datetime DEFAULT NULL,
  `status_pengajuan` tinyint(4) NOT NULL,
  `id_kakanwil` varchar(20) DEFAULT NULL,
  `nm_kakanwil` varchar(255) DEFAULT NULL,
  `jab_kakanwil` varchar(255) DEFAULT NULL,
  `cat_kakanwil` text DEFAULT NULL,
  `tgl_disposisi_kakanwil` datetime DEFAULT NULL,
  `status_approval_kakanwil` tinyint(4) NOT NULL,
  `id_minkeu` varchar(20) DEFAULT NULL,
  `nm_minkeu` varchar(255) DEFAULT NULL,
  `jab_minkeu` varchar(255) DEFAULT NULL,
  `cat_minkeu` text DEFAULT NULL,
  `tgl_disposisi_minkeu` datetime DEFAULT NULL,
  `status_approval_minkeu` tinyint(4) NOT NULL,
  `id_verifikator` varchar(20) DEFAULT NULL,
  `nm_verifikator` varchar(255) DEFAULT NULL,
  `jab_verifikator` varchar(255) DEFAULT NULL,
  `cat_verifikator` text DEFAULT NULL,
  `tgl_verifikasi` datetime DEFAULT NULL,
  `kesesuaian_data` tinyint(1) NOT NULL,
  `kesesuaian_perhitungan` tinyint(1) NOT NULL,
  `status_verifikasi` tinyint(4) NOT NULL,
  `no_verifikasi` varchar(30) DEFAULT NULL,
  `id_bag_keu` varchar(20) DEFAULT NULL,
  `nm_bag_keu` varchar(255) DEFAULT NULL,
  `jab_bag_keu` varchar(255) DEFAULT NULL,
  `cat_bag_keu` text DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `status_approval_bagkeu` tinyint(4) NOT NULL,
  `no_bukti_pembayaran` varchar(30) DEFAULT NULL,
  `status_tagihan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tagihan`
--

INSERT INTO `tbl_tagihan` (`id_tagihan`, `ket_tagihan`, `id_bidang`, `id_pembuat`, `nm_pembuat`, `jab_pembuat`, `cat_pembuat`, `tgl_pembuatan`, `status_pembuatan`, `no_nota_intern`, `id_pengaju`, `nm_pengaju`, `jab_pengaju`, `cat_pengaju`, `tgl_pengajuan`, `status_pengajuan`, `id_kakanwil`, `nm_kakanwil`, `jab_kakanwil`, `cat_kakanwil`, `tgl_disposisi_kakanwil`, `status_approval_kakanwil`, `id_minkeu`, `nm_minkeu`, `jab_minkeu`, `cat_minkeu`, `tgl_disposisi_minkeu`, `status_approval_minkeu`, `id_verifikator`, `nm_verifikator`, `jab_verifikator`, `cat_verifikator`, `tgl_verifikasi`, `kesesuaian_data`, `kesesuaian_perhitungan`, `status_verifikasi`, `no_verifikasi`, `id_bag_keu`, `nm_bag_keu`, `jab_bag_keu`, `cat_bag_keu`, `tgl_bayar`, `status_approval_bagkeu`, `no_bukti_pembayaran`, `status_tagihan`) VALUES
('TAG_BIDANG_001_20210101000000_0001', 'Tagihan ATK', 'BIDANG_001', '087408759', 'Novita Lampasian', 'Kepala Seksi Sekretariat, Umum dan Humas', 'Tes', '2021-01-01 00:00:00', 0, 'NI001', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi`
--

CREATE TABLE `tb_notifikasi` (
  `id_notifikasi` varchar(82) NOT NULL,
  `id_pegawai` varchar(20) NOT NULL,
  `id_tagihan` varchar(34) NOT NULL,
  `notif_title` varchar(255) NOT NULL,
  `notif_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tes`
--

CREATE TABLE `tes` (
  `id` int(11) NOT NULL,
  `data_string` varchar(255) DEFAULT NULL,
  `data_double` double DEFAULT NULL,
  `data_datetime` datetime DEFAULT NULL,
  `data_boolean` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tes`
--

INSERT INTO `tes` (`id`, `data_string`, `data_double`, `data_datetime`, `data_boolean`) VALUES
(1, 'satu', 1000, '2021-01-01 00:00:00', 1),
(2, 'dua', 2000, '2021-02-02 01:01:01', 0),
(3, 'tiga', 3000, '2021-03-03 00:00:00', 1),
(4, 'empat', 4000, '2021-04-04 00:00:00', 0),
(5, 'lima', 5000, '2021-05-05 00:00:00', 1),
(6, 'enam', 6000, '2021-06-06 00:00:00', 0),
(7, 'tujuh', 7000, '2021-07-07 00:00:00', 1),
(8, 'delapan', 8000, '2021-08-08 00:00:00', 0),
(9, 'sembilan', 9000, '2021-09-09 00:00:00', 1),
(10, 'sepuluh', 10000, '2021-10-10 00:00:00', 0),
(11, 'sebelas', 11000, '2021-11-11 00:00:00', 1),
(12, 'dua belas', 12000, '2021-12-12 00:00:00', 0),
(13, 'tiga belas', 13000, '2021-01-01 00:00:00', 1),
(14, 'empat belas', 14000, '2021-01-01 00:00:00', 0),
(15, 'lima belas', 15000, '2021-01-01 00:00:00', 1),
(16, 'enam belas', 16000, '2021-01-01 00:00:00', 0),
(17, 'tujuh belas', 17000, '2021-01-01 00:00:00', 1),
(18, 'delapan belas', 18000, '2021-01-01 00:00:00', 0),
(19, 'sembilan belas', 19000, '2021-01-01 00:00:00', 1),
(20, 'dua puluh', 20000, '2021-01-01 00:00:00', 0),
(21, 'dua puluh satu', 21000, '2021-01-01 00:00:00', 1),
(22, 'dua puluh dua', 22000, '2021-01-01 00:00:00', 0),
(23, 'dua puluh tiga', 23000, '2021-01-01 00:00:00', 1),
(24, 'dua puluh empat', 24000, '2021-01-01 00:00:00', 0),
(25, 'dua puluh lima', 25000, '2021-01-01 00:00:00', 1),
(26, 'dua puluh enam', 26000, '2021-01-01 00:00:00', 0),
(27, 'dua puluh tujuh', 27000, '2021-01-01 00:00:00', 1),
(28, 'dua puluh delapan', 28000, '2021-01-01 00:00:00', 0),
(29, 'dua puluh sembilan', 29000, '2021-01-01 00:00:00', 1),
(30, 'tiga puluh', 30000, '2021-01-01 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `00tes`
--
ALTER TABLE `00tes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `ref_bidang`
--
ALTER TABLE `ref_bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `ref_fungsi_disposisi`
--
ALTER TABLE `ref_fungsi_disposisi`
  ADD PRIMARY KEY (`id_fungsi`);

--
-- Indexes for table `ref_jabatan`
--
ALTER TABLE `ref_jabatan`
  ADD PRIMARY KEY (`id_jab`);

--
-- Indexes for table `tbldet_item_tagihan`
--
ALTER TABLE `tbldet_item_tagihan`
  ADD PRIMARY KEY (`id_det_item`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `tbl_tagihan`
--
ALTER TABLE `tbl_tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- Indexes for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `tes`
--
ALTER TABLE `tes`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
