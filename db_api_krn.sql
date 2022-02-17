-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2022 at 07:40 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_api_krn`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_upload`
--

CREATE TABLE `file_upload` (
  `file_upload_id` int(11) NOT NULL,
  `session_upload_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `file_upload`
--

INSERT INTO `file_upload` (`file_upload_id`, `session_upload_id`, `file_name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 654298819, 'pulsa.png', 1, 1643871893, 1643871893),
(2, 601399697, 'seluler.png', 1, 1643871893, 1643871893),
(3, 634049627, 'prabayar-&-pascabayar.png', 1, 1643871893, 1643871893),
(4, 855420222, 'pulsa.png', 1, 1643871893, 1643871893),
(5, 251893436, 'paket-data.png', 1, 1643871893, 1643871893),
(6, 479966394, 'tagihan-listrik.png', 1, 1643871893, 1643871893),
(7, 145201874, 'token-listrik.png', 1, 1643871893, 1643871893),
(8, 158803724, 'telkom.png', 1, 1643871893, 1643871893),
(9, 699286050, 'e-money.png', 1, 1643871893, 1643871893);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `session_upload_id` int(11) NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '0. Delete, 1.Aktif',
  `created_by` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `session_upload_id`, `nama_kategori`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 654298819, 'Rekomendasi', '0', 1, 1643871893, 1643877388),
(2, 601399697, 'Seluler', '1', 1, 1643871893, 1643871893),
(3, 634049627, 'Prabayar & Pascabayar', '1', 1, 1643871893, 1643871893);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `kota_id` int(11) NOT NULL,
  `provinsi_id` int(11) DEFAULT NULL,
  `nama_kota` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`kota_id`, `provinsi_id`, `nama_kota`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kabupaten Aceh Besar', 1644391436, 1644391436),
(2, 1, 'Kota Banda Aceh', 1644391665, 1644391665),
(3, 1, 'Aneuklot Kota Sabang', 1644391695, 1644391695),
(4, 1, 'Kabupaten Aceh Tamiang', 1644391719, 1644391719),
(5, 1, 'Kabupaten Aceh Timur', 1644391732, 1644391732),
(6, 1, 'Kabupaten Aceh Barat', 1644391752, 1644391752),
(7, 1, 'Kabupaten Pidie', 1644391768, 1644391768),
(8, 1, 'Aceh Utara', 1644391791, 1644391791),
(9, 1, 'Kota Langsa', 1644391805, 1644391805),
(12, 2, 'Kota Denpasar', 1644398807, 1644398807),
(13, 10, 'Kota Bandung', 1644459685, 1644459685),
(14, 10, 'Kabupaten Bogor', 1644460504, 1644460504);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `layanan_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `session_upload_id` int(11) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0. Delete, 1.Aktif',
  `created_by` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`layanan_id`, `kategori_id`, `session_upload_id`, `nama_layanan`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, 855420222, 'Pulsa', '1', 1, 1643871893, 1643871893),
(2, 2, 251893436, 'Paket Data', '1', 1, 1643871893, 1643871893),
(3, 3, 479966394, 'Tagihan Listrik', '1', 1, 1643871893, 1643871893),
(4, 3, 145201874, 'Token Listrik', '1', 1, 1643871893, 1643871893),
(5, 3, 158803724, 'Telkom', '1', 1, 1643871893, 1643871893),
(6, 3, 699286050, 'E-Money', '1', 1, 1643871893, 1643871893),
(7, 3, 164977607, 'PDAM', '1', 1, 1643873325, 1643873325),
(8, 3, 412282911, 'Angsuran', '1', 1, 1644207975, 1644207975);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1643870444),
('m130524_201442_init', 1643871892),
('m190124_110200_add_verification_token_column_to_user_table', 1643871892),
('m220113_081656_create_produk_table', 1643871892),
('m220113_082601_create_kategori_table', 1643871892),
('m220113_085515_create_file_upload_table', 1643871892),
('m220131_024246_create_layanan_table', 1643871892),
('m220131_024518_create_tagihan_table', 1643871892),
('m220131_031848_insert_produk', 1643871892),
('m220131_041634_insert_user', 1643871893),
('m220214_040250_insert_data', 1643871893);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `layanan_id` int(11) NOT NULL,
  `provinsi_id` int(11) DEFAULT NULL,
  `kota_id` int(11) DEFAULT NULL,
  `kode_produk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `harga_produk` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `harga_markdown` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `harga_markup` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `sub_produk` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0. Other 1. Telkomsel 2. Indosat 3. XL 4. Axis 5. Smartfreen 6. Three	',
  `jenis` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '2' COMMENT '1. Cek Tagihan 2. Bayar',
  `is_emoney` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1.Grab, 2.OVO, 3.ShoppePay, 4.Gojek, 5.Dana, 6.Link Aja, 7.Maxim,',
  `is_emoney_status` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1.Driver, 2.Customer',
  `is_delete` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '0. Delete, 1.Aktif',
  `keterangan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `layanan_id`, `provinsi_id`, `kota_id`, `kode_produk`, `nama_produk`, `harga_produk`, `harga_markdown`, `harga_markup`, `sub_produk`, `jenis`, `is_emoney`, `is_emoney_status`, `is_delete`, `keterangan`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'TN5', '5K', '5235', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL H2H 5K PROMO', 1, 1643871892, 1643968390),
(2, 1, NULL, NULL, 'TN10', '10K', '10180', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL H2H 10K PROMO', 1, 1643871892, 1643968390),
(3, 1, NULL, NULL, 'TM25', '25K', '24795', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL H2H 25K', 1, 1643871892, 1644200695),
(4, 1, NULL, NULL, 'TM150', '150K', '147750', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL H2H 150K', 1, 1643871892, 1643968390),
(5, 1, NULL, NULL, 'TM40', '40K', '39350', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL H2H 40K', 1, 1643871892, 1643968390),
(6, 1, NULL, NULL, 'TM50', '50K', '49570', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL H2H 50K', 1, 1643871892, 1644200696),
(7, 1, NULL, NULL, 'TM100', '100K', '96700', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL H2H 100K', 1, 1643871892, 1644460053),
(8, 1, NULL, NULL, 'TM200', '200K', '195900', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL H2H 200K', 1, 1643871892, 1643968391),
(9, 1, NULL, NULL, 'TM500', '500K', '489925', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL H2H 500K', 1, 1643871892, 1643968391),
(10, 2, NULL, NULL, 'TDH25', '25GB', '191200', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL Data Bulk 25GB Flash (3G 4G) +2GB OMG 30 Hari', 1, 1643871892, 1643968391),
(11, 2, NULL, NULL, 'MAXGH3', '2GB', '49400', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL DATA 3GB FLASH + 12GB VIDEOMAX 30HR', 1, 1643871892, 1643968391),
(12, 2, NULL, NULL, 'MAXGH15', '15GB', '147400', '0', '0', '1', '2', NULL, NULL, '1', 'TSEL DATA 15GB FLASH + 40GB VIDEOMAX 30HR', 1, 1643871892, 1643968392),
(13, 2, NULL, NULL, 'TDFP5', '5GB', '53700', '0', '0', '1', '2', NULL, NULL, '1', 'TELKOMSEL DATA FLASH 5GB 30 HARI', 1, 1643871892, 1643968392),
(14, 2, NULL, NULL, 'TDFP12', '12GB', '102500', '0', '0', '1', '2', NULL, NULL, '1', 'TELKOMSEL DATA FLASH 12GB 30 HARI', 1, 1643871892, 1643968392),
(15, 2, NULL, NULL, 'TDFP8', '8GB', '85000', '0', '0', '1', '2', NULL, NULL, '1', 'TELKOMSEL DATA FLASH 8GB 30 HARI', 1, 1643871892, 1643968392),
(16, 2, NULL, NULL, 'TDFH5', '5GB', '62700', '0', '0', '1', '2', NULL, NULL, '1', 'Telkomsel Data Flash 5 GB / 30 Hari', 1, 1643871892, 1643968392),
(17, 2, NULL, NULL, 'TDFH8', '8GB', '83800', '0', '0', '1', '2', NULL, NULL, '1', 'Telkomsel Data Flash 8 GB / 30 Hari', 1, 1643871892, 1643968393),
(18, 2, NULL, NULL, 'TDFH3', '3GB', '37700', '0', '0', '1', '2', NULL, NULL, '1', 'Telkomsel Data Flash 3 GB / 30 Hari', 1, 1643871892, 1643968393),
(19, 2, NULL, NULL, 'TDFH12', '12GB', '103000', '0', '0', '1', '2', NULL, NULL, '1', 'Telkomsel Data Flash 12 GB / 30 Hari', 1, 1643871892, 1643968393),
(20, 1, NULL, NULL, 'XH5', '5K', '5775', '0', '0', '3', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968393),
(21, 1, NULL, NULL, 'XH10', '10K', '10695', '0', '0', '3', '2', NULL, NULL, '1', 'XL AXIS H2H ', 1, 1643871892, 1643968393),
(22, 1, NULL, NULL, 'XH25', '25K', '24750', '0', '0', '3', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968394),
(23, 1, NULL, NULL, 'XH50', '50K', '49190', '0', '0', '3', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968394),
(24, 1, NULL, NULL, 'XH100', '100K', '98400', '0', '0', '3', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968394),
(25, 1, NULL, NULL, 'XH150', '150K', '149000', '0', '0', '3', '2', NULL, NULL, '1', 'XL AXIS H2H', 2, 1643871892, 1643968394),
(26, 1, NULL, NULL, 'XH200', '200K', '198500', '0', '0', '3', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968394),
(27, 1, NULL, NULL, 'XH300', '300K', '298000', '0', '0', '3', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968394),
(28, 1, NULL, NULL, 'XH500', '500K', '493000', '0', '0', '3', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968395),
(29, 1, NULL, NULL, 'XH1000', '1000K', '995000', '0', '0', '3', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968395),
(30, 2, NULL, NULL, 'XLCH3', '6GB', '61860', '0', '0', '3', '2', NULL, NULL, '1', '6GB+4GB Lokal+4GB Jaringan 4G+1GB Youtube 30 hr', 1, 1643871892, 1643968395),
(31, 2, NULL, NULL, 'XLCH4', '18GB', '121000', '0', '0', '3', '2', NULL, NULL, '1', '18GB+6GB Lokal+12GB Jaringan 4G+1GB Youtube 30hr', 1, 1643871892, 1643968395),
(32, 2, NULL, NULL, 'XLDH3', '3GB', '21900', '0', '0', '3', '2', NULL, NULL, '1', 'XL DATA HOTROD 3 GB 7 HARI', 1, 1643871892, 1643968395),
(33, 2, NULL, NULL, 'XLDH5', '6GB', '92500', '0', '0', '3', '2', NULL, NULL, '1', 'XL DATA HOTROD 6GB 30 HARI', 1, 1643871892, 1643968396),
(34, 2, NULL, NULL, 'XLDH7', '12GB', '164000', '0', '0', '3', '2', NULL, NULL, '1', 'XL DATA HOTROD 12GB 30 HARI', 2, 1643871892, 1643968396),
(35, 2, NULL, NULL, 'XDCP5', '5GB', '55600', '0', '0', '3', '2', NULL, NULL, '1', 'Combo Promo 5GB + 10GB Youtube + Telp 20mnt all', 1, 1643871892, 1644200702),
(36, 2, NULL, NULL, 'XDCP15', '15GB', '115000', '0', '0', '3', '2', NULL, NULL, '1', 'Combo Promo 15GB + 30GB Youtube + Telp 40mnt all', 1, 1643871892, 1644200702),
(37, 2, NULL, NULL, 'XDCP20', '20GB', '162000', '0', '0', '3', '2', NULL, NULL, '1', 'Combo Promo 20GB + 40GB Youtube + Telp 60mnt all', 1, 1643871892, 1644200702),
(38, 1, NULL, NULL, 'XH5', '5K', '5775', '0', '0', '4', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968397),
(39, 1, NULL, NULL, 'XH10', '10K', '10695', '0', '0', '4', '2', NULL, NULL, '1', 'XL AXIS H2H ', 1, 1643871892, 1643968397),
(40, 1, NULL, NULL, 'XH25', '25K', '24750', '0', '0', '4', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968397),
(41, 1, NULL, NULL, 'XH50', '50K', '49190', '0', '0', '4', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968397),
(42, 1, NULL, NULL, 'XH100', '100K', '98400', '0', '0', '4', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968397),
(43, 1, NULL, NULL, 'XH150', '150K', '149000', '0', '0', '4', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968398),
(44, 1, NULL, NULL, 'XH200', '200K', '198500', '0', '0', '4', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968398),
(45, 1, NULL, NULL, 'XH300', '300K', '298000', '0', '0', '4', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968398),
(46, 1, NULL, NULL, 'XH500', '500K', '493000', '0', '0', '4', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968398),
(47, 1, NULL, NULL, 'XH1000', '1000K', '995000', '0', '0', '4', '2', NULL, NULL, '1', 'XL AXIS H2H', 1, 1643871892, 1643968398),
(48, 2, NULL, NULL, 'AXDB4', '3GB', '28100', '0', '0', '4', '2', NULL, NULL, '1', 'Paket Data Axis Owsem 1GB+3GB (4G) 30Hari', 1, 1643871892, 1643968399),
(49, 2, NULL, NULL, 'AXDB8', '8GB', '44850', '0', '0', '4', '2', NULL, NULL, '1', 'Paket Data Axis Owsemcc 2GB+6GB 4G 30Hari', 1, 1643871892, 1643968399),
(50, 2, NULL, NULL, 'AXDB12', '12GB', '59400', '0', '0', '4', '2', NULL, NULL, '1', 'Paket Data Axis Owsem 3GB+9GB (4G) 30Hari', 1, 1643871892, 1643968399),
(51, 2, NULL, NULL, 'AXDH2', '2GB', '22210', '0', '0', '4', '2', NULL, NULL, '1', 'AXIX DATA BRONET 2GB 30 HARI', 1, 1643871892, 1643968399),
(52, 2, NULL, NULL, 'AXDH3', '3GB', '28050', '0', '0', '4', '2', NULL, NULL, '1', 'AXIS DATA BRONET 3GB 30 HARI', 1, 1643871892, 1643968399),
(53, 2, NULL, NULL, 'AXDH5', '8GB', '56310', '0', '0', '4', '2', NULL, NULL, '1', 'AXIS DATA BRONET 8GB 30 HARI', 1, 1643871892, 1643968400),
(54, 2, NULL, NULL, 'AXDH7', '12GB', '68610', '0', '0', '4', '2', NULL, NULL, '1', 'AXIS DATA BRONET 12GB 30 HARI', 1, 1643871892, 1643968400),
(55, 2, NULL, NULL, 'ADM7', '3GB', '19850', '0', '0', '4', '2', NULL, NULL, '1', 'Axis Data Mini 3 GB / 15 Hari', 1, 1643871892, 1643968400),
(56, 2, NULL, NULL, 'ADM8', '5GB', '30625', '0', '0', '4', '2', NULL, NULL, '1', 'Axis Data Mini 5 GB / 15 Hari', 1, 1643871892, 1643968400),
(57, 1, NULL, NULL, 'IH5', '5K', '5690', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT H2H 5K', 1, 1643871892, 1643968400),
(58, 1, NULL, NULL, 'IH10', '10K', '10690', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT H2H 10K', 1, 1643871892, 1643968400),
(59, 1, NULL, NULL, 'IH25', '25K', '24740', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT H2H 25K', 1, 1643871892, 1643968401),
(60, 1, NULL, NULL, 'IH40', '40K', '39260', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT H2H 40K', 1, 1643871892, 1643968401),
(61, 1, NULL, NULL, 'IH50', '50K', '48750', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT H2H 50K', 1, 1643871892, 1643968401),
(62, 1, NULL, NULL, 'IH100', '100K', '96430', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT H2H 100K', 1, 1643871892, 1643968401),
(63, 1, NULL, NULL, 'IH150', '150K', '141000', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT H2H 150K', 1, 1643871892, 1643968401),
(64, 1, NULL, NULL, 'IH200', '200K', '187000', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT H2H 200K', 1, 1643871892, 1643968402),
(65, 1, NULL, NULL, 'IH500', '500K', '465000', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT H2H 500K', 1, 1643871892, 1643968402),
(66, 2, NULL, NULL, 'IDYP7', '1GB', '9825', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT YELOW 1GB 7HR', 1, 1643871892, 1643968402),
(67, 2, NULL, NULL, 'IDUH1', '1GB', '24400', '0', '0', '2', '2', NULL, NULL, '1', 'Indosat Data 1GB + 4,GB APK 30HARI', 1, 1643871892, 1643968402),
(68, 2, NULL, NULL, 'IDUH2', '2GB', '37600', '0', '0', '2', '2', NULL, NULL, '1', 'Indosat Data 2GB + 7,5GB APK 30HRI', 1, 1643871892, 1643968402),
(69, 2, NULL, NULL, 'IDUH7', '7GB', '74300', '0', '0', '2', '2', NULL, NULL, '1', 'Indosat Data 7GB + 20GB YOUTUBE + FREE SMS 30 HARI', 1, 1643871892, 1643968403),
(70, 2, NULL, NULL, 'IDUH15', '15GB', '124500', '0', '0', '2', '2', NULL, NULL, '1', 'Indosat Data 15GB+30GB YOUTUBE+IG+FREE SMS/tlp30HR', 1, 1643871892, 1643968403),
(71, 2, NULL, NULL, 'IDUH100', '60GB', '142300', '0', '0', '2', '2', NULL, NULL, '1', 'Indosat Data 60GB ALL + FREE SMS/TELP 30 HARI', 1, 1643871892, 1643968403),
(72, 2, NULL, NULL, 'IDUF1', '2GB', '14800', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT DATA FREEDOM 2GB 30 HARI', 1, 1643871892, 1643968403),
(73, 2, NULL, NULL, 'IDUF3', '8GB', '35600', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT DATA FREEDOM 8GB 30 HARI', 1, 1643871892, 1643968403),
(74, 2, NULL, NULL, 'IDUF4', '10GB', '47300', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT DATA FREEDOM 10GB 30 HARI', 1, 1643871892, 1643968404),
(75, 2, NULL, NULL, 'IDUF6', '25GB', '92850', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT DATA FREEDOM 25GB 30 HARI', 1, 1643871892, 1643968404),
(76, 2, NULL, NULL, 'IDUF7', '50GB', '102000', '0', '0', '2', '2', NULL, NULL, '1', 'INDOSAT DATA FREEDOM 50GB 30 HARI', 1, 1643871892, 1643968404),
(77, 2, NULL, NULL, 'IDVH2', '2GB', '38500', '0', '0', '2', '2', NULL, NULL, '1', 'V.Indosat Unlimited Aplikasi +2GB 30 Hari', 1, 1643871892, 1643968404),
(78, 2, NULL, NULL, 'IDVH7', '7GB', '76400', '0', '0', '2', '2', NULL, NULL, '1', 'V.Indosat Unlimited Aplikasi+sms+7GB 30 Hari', 1, 1643871892, 1643968404),
(79, 2, NULL, NULL, 'IDVH15', '15GB', '124700', '0', '0', '2', '2', NULL, NULL, '1', 'V.Indosat Unlimited Aplikasi+sms+15GB 30 Hari', 1, 1643871892, 1643968404),
(80, 2, NULL, NULL, 'IDVH100', 'Unlimited', '145200', '0', '0', '2', '2', NULL, NULL, '1', 'V.Indosat Unlimited Aplikasi+Unlimited 30 Hari', 1, 1643871892, 1643968405),
(81, 1, NULL, NULL, 'TH5', '5K', '5254', '0', '0', '6', '2', NULL, NULL, '1', 'THREE REGULAR', 1, 1643871892, 1643968405),
(82, 1, NULL, NULL, 'TH10', '10K', '10115', '0', '0', '6', '2', NULL, NULL, '1', 'THREE REGULAR', 1, 1643871892, 1643968405),
(83, 1, NULL, NULL, 'TH25', '25K', '24310', '0', '0', '6', '2', NULL, NULL, '1', 'THREE REGULAR', 1, 1643871892, 1643968405),
(84, 1, NULL, NULL, 'TH40', '40K', '38890', '0', '0', '6', '2', NULL, NULL, '1', 'THREE REGULAR', 1, 1643871892, 1643968405),
(85, 1, NULL, NULL, 'TH50', '50K', '48610', '0', '0', '6', '2', NULL, NULL, '1', 'THREE REGULAR', 1, 1643871892, 1643968406),
(86, 1, NULL, NULL, 'TH100', '100K', '97210', '0', '0', '6', '2', NULL, NULL, '1', 'THREE REGULAR', 1, 1643871892, 1643968406),
(87, 1, NULL, NULL, 'TH150', '150K', '145900', '0', '0', '6', '2', NULL, NULL, '1', 'THREE REGULAR ', 1, 1643871892, 1643968406),
(88, 1, NULL, NULL, 'TH200', '200K', '194500', '0', '0', '6', '2', NULL, NULL, '1', 'THREE REGULAR', 1, 1643871892, 1643968406),
(89, 2, NULL, NULL, 'TRHM5', '9GB', '27450', '0', '0', '6', '2', NULL, NULL, '1', 'Kuota Happy 9GB 10hari', 1, 1643871892, 1643968406),
(90, 2, NULL, NULL, 'TRDF33', '33GB', '48950', '0', '0', '6', '2', NULL, NULL, '1', 'Tri Data New 33GB Nasional,Full 24 Jam Selama 30Hr', 1, 1643871892, 1643968407),
(91, 2, NULL, NULL, 'TDL1000', '1GB', '6000', '0', '0', '6', '2', NULL, NULL, '1', 'THREE DATA PURE 1GB 30 Hari', 1, 1643871892, 1643968407),
(92, 2, NULL, NULL, 'TDL2000', '2GB', '12100', '0', '0', '6', '2', NULL, NULL, '1', 'THREE DATA PURE 2GB 30 Hari', 1, 1643871892, 1643968407),
(93, 2, NULL, NULL, 'TDL5000', '5GB', '30100', '0', '0', '6', '2', NULL, NULL, '1', 'THREE DATA PURE 5GB 30 Hari', 1, 1643871892, 1643968407),
(94, 2, NULL, NULL, 'TDL10000', '10GB', '60300', '0', '0', '6', '2', NULL, NULL, '1', 'THREE DATA PURE 10GB 30 Hari', 1, 1643871892, 1643968407),
(95, 1, NULL, NULL, 'SMH5', '5K', '4910', '0', '0', '5', '2', NULL, NULL, '1', 'SMARTFREN REGULAR 5K', 1, 1643871892, 1643968408),
(96, 1, NULL, NULL, 'SMH10', '10K', '9785', '0', '0', '5', '2', NULL, NULL, '1', 'SMARTFREN REGULAR 10K', 1, 1643871892, 1643968408),
(97, 1, NULL, NULL, 'SMH25', '25K', '24385', '0', '0', '5', '2', NULL, NULL, '1', 'SMARTFREN REGULAR 25K', 1, 1643871892, 1643968408),
(98, 1, NULL, NULL, 'SMH50', '50K', '48445', '0', '0', '5', '2', NULL, NULL, '1', 'SMARTFREN REGULAR  50K', 1, 1643871892, 1643968408),
(99, 1, NULL, NULL, 'SMH100', '100K', '96200', '0', '0', '5', '2', NULL, NULL, '1', 'SMARFREN REGULAR 100K', 1, 1643871892, 1643968408),
(100, 1, NULL, NULL, 'SMH150', '150K', '147700', '0', '0', '5', '2', NULL, NULL, '1', 'SMARTFREN REGULAR 150K', 1, 1643871892, 1643968408),
(101, 1, NULL, NULL, 'SMH200', '200K', '197100', '0', '0', '5', '2', NULL, NULL, '1', 'SMARTFREN REGULAR 200K', 1, 1643871892, 1643968409),
(102, 2, NULL, NULL, 'SMDP60', '8GB', '56200', '0', '0', '5', '2', NULL, NULL, '1', '8GB + 8GB malam + chat 30Hari', 1, 1643871892, 1643968409),
(103, 2, NULL, NULL, 'SMDP150', '22GB', '148200', '0', '0', '5', '2', NULL, NULL, '1', '22.5GB + 22.5GB malam + chat 30Hari', 1, 1643871892, 1643968409),
(104, 2, NULL, NULL, 'SMDP100', '15GB', '93700', '0', '0', '5', '2', NULL, NULL, '1', '15GB + 15GB + chat 30Hari', 1, 1643871892, 1643968409),
(105, 2, NULL, NULL, 'SMDP200', '30GB', '198200', '0', '0', '5', '2', NULL, NULL, '1', '30GB + 30GB malam + chat 30Hari', 1, 1643871892, 1643968409),
(106, 2, NULL, NULL, 'SNA30', '6GB UNLIMITED', '27875', '0', '0', '5', '2', NULL, NULL, '1', 'KUOTA UTAMA 6GB (24JAM)  + UNLIMITED NONSTOP 28 HR', 1, 1643871892, 1643968410),
(107, 2, NULL, NULL, 'SNA45', '10GB UNLIMITED', '42120', '0', '0', '5', '2', NULL, NULL, '1', 'KUOTA UTAMA 10GB (24JAM) +UNLIMITED NONSTOP 28 HR', 1, 1643871892, 1643968410),
(108, 2, NULL, NULL, 'SNA65', '18GB UNLIMITED', '60375', '0', '0', '5', '2', NULL, NULL, '1', 'KUOTA UTAMA 18GB (24JAM) + UNLIMITED NONSTOP 28 HR', 1, 1643871892, 1643968410),
(109, 2, NULL, NULL, 'SNA100', '30GB UNLIMITED', '93825', '0', '0', '5', '2', NULL, NULL, '1', 'KUOTA UTAMA 30GB (24JAM) + UNLIMITED NONSTOP 28 HR', 1, 1643871892, 1643968410),
(110, 1, NULL, NULL, 'BYY5', '5K', '5400', '0', '0', '7', '2', NULL, NULL, '1', 'Telkomsel Byu 5K', 1, 1643871892, 1643968410),
(111, 1, NULL, NULL, 'BYY10', '10K', '10340', '0', '0', '7', '2', NULL, NULL, '1', 'Telkomsel Byu 10K', 1, 1643871892, 1643968411),
(112, 1, NULL, NULL, 'BYY25', '25K', '25025', '0', '0', '7', '2', NULL, NULL, '1', 'Telkomsel Byu 25K', 1, 1643871892, 1643968411),
(113, 1, NULL, NULL, 'BYY40', '40K', '39925', '0', '0', '7', '2', NULL, NULL, '1', 'Telkomsel Byu 40K', 1, 1643871892, 1643968411),
(114, 1, NULL, NULL, 'BYY50', '50K', '49900', '0', '0', '7', '2', NULL, NULL, '1', 'Telkomsel Byu 50K', 1, 1643871892, 1643968411),
(115, 1, NULL, NULL, 'BYY100', '100K', '98000', '0', '0', '7', '2', NULL, NULL, '1', 'Telkomsel Byu 100K', 1, 1643871892, 1643968411),
(116, 1, NULL, NULL, 'BYY150', '150K', '149100', '0', '0', '7', '2', NULL, NULL, '1', 'Telkomsel Byu 150K', 1, 1643871892, 1643968412),
(117, 1, NULL, NULL, 'BYY200', '200K', '200200', '10', '1000', '7', '2', NULL, NULL, '1', 'Telkomsel Byu 200K', 1, 1643871892, 1643968412),
(118, 3, NULL, NULL, 'INQ3511', 'Cek Tagihan Listrik', '0', '0', '0', '0', '1', NULL, NULL, '1', 'PLN POSTPAID BY STAND-METER', 1, 1643871892, 1643968412),
(119, 3, NULL, NULL, 'PAY3511', 'Bayar Tagihan Listrik', '2500', '0', '0', '0', '2', NULL, NULL, '1', 'PLN POSTPAID BY STAND METER', 1, 1643871892, 1644300973),
(120, 5, NULL, NULL, 'INQ720', 'Cek Tagihan Indihome', '0', '0', '0', '0', '1', NULL, NULL, '1', 'TELKOMPAY 3000 (SPEEDY)', 1, 1643871892, 1643968412),
(121, 5, NULL, NULL, 'PAY720', 'Bayar Tagihan Indihome', '650', '0', '0', '0', '2', NULL, NULL, '1', 'Telkom Speedy', 1, 1643871892, 1644300973),
(127, 4, NULL, NULL, 'PLZ50', '50K', '49990', '0', '0', '0', '2', NULL, NULL, '1', 'PLN H2H', 1, 1644202807, 1644203027),
(128, 4, NULL, NULL, 'PLZ100', '100K', '99990', '0', '0', '0', '2', NULL, NULL, '1', 'PLN H2H', 1, 1644202823, 1644203027),
(129, 4, NULL, NULL, 'PLZ200', '200K', '199990', '0', '0', '0', '2', NULL, NULL, '1', 'PLN H2H', 1, 1644202836, 1644203027),
(130, 4, NULL, NULL, 'PLZ500', '500K', '499990', '0', '0', '0', '2', NULL, NULL, '1', 'PLN H2H', 1, 1644202849, 1644203027),
(131, 4, NULL, NULL, 'PLZ1000', '1000K', '999990', '1000', '0', '0', '2', NULL, NULL, '1', 'PLN H2H', 1, 1644202864, 1644213825),
(132, 8, NULL, NULL, 'INQ3001', 'CEK TAGIHAN ASTRA FINANCE', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAGIHAN ASTRA FINANCE', 1, 1644208504, 1644221277),
(133, 8, NULL, NULL, 'INQ791', 'MEGA CENTRAL FINANCE	', '0', '0', '0', '0', '1', NULL, NULL, '1', 'MEGA CENTRAL FINANCE', 1, 1644208750, 1644221250),
(134, 8, NULL, NULL, 'INQ792', 'Cek Mega Auto Finance ( MAF )', '0', '0', '0', '0', '1', NULL, NULL, '1', 'Cek Mega Auto Finance ( MAF )', 1, 1644208768, 1644221257),
(135, 8, NULL, NULL, 'INQ793', 'MEGA FINANCE', '0', '0', '0', '0', '1', NULL, NULL, '1', 'MEGA FINANCE', 1, 1644208796, 1644221269),
(136, 4, NULL, NULL, 'CPLZ', 'Cek Pelanggan Token', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK NOMER METER PLN TOKEN', 1, 1644214609, 1644217906),
(137, 4, NULL, NULL, 'PLZ5', '5K', '6545', '0', '0', '0', '2', NULL, NULL, '1', 'PLN H2H', 1, 1644217853, 1644217907),
(138, 8, NULL, NULL, 'INQ3011', 'CEK TAGIHAN BCA FINANCE', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAGIHAN MPM FINANCE', 1, 1644223576, 1644287999),
(139, 8, NULL, NULL, 'INQ6602', 'FINANCE BAF 6000', '0', '0', '0', '0', '1', NULL, NULL, '1', 'FINANCE BAF 6000', 1, 1644224774, 1644287999),
(140, 8, NULL, NULL, 'INQ6604', 'FINANCE FIF 3000', '0', '0', '0', '0', '1', NULL, NULL, '1', 'FINANCE FIF 3000', 1, 1644225387, 1644288000),
(141, 8, NULL, NULL, 'INQ796', 'AL IJARAH FINANCE', '0', '0', '0', '0', '1', NULL, NULL, '1', 'AL IJARAH FINANCE', 1, 1644286656, 1644288000),
(142, 8, NULL, NULL, 'INQ839', 'CEK HOME CREDIT INDONESIA', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK HOME CREDIT INDONESIA', 1, 1644286720, 1644288000),
(143, 8, NULL, NULL, 'INQ3011', 'CEK TAGIHAN MPM FINANCE', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAGIHAN MPM FINANCE', 1, 1644286754, 1644288000),
(144, 8, NULL, NULL, 'INQ3012', 'Cek Tagihan Indomobil Finance Indonesia', '0', '0', '0', '0', '1', NULL, NULL, '1', 'Cek Tagihan Indomobil Finance Indonesia', 1, 1644286780, 1644288000),
(145, 8, NULL, NULL, 'INQ3013', 'CEK TAGIHAN MNC FINANCE', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAGIHAN MNC FINANCE', 1, 1644286825, 1644288001),
(146, 8, NULL, NULL, 'INQ3015', 'CEK TAGIHAN ARTA ASIA FINANCE', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAGIHAN ARTA ASIA FINANCE', 1, 1644286898, 1644288001),
(147, 8, NULL, NULL, 'INQ3016', 'CEK TAGIHAN AEON CREDIT', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAGIHAN AEON CREDIT', 1, 1644286946, 1644288001),
(148, 8, NULL, NULL, 'INQ6603', 'FINANCE COLUMBIA', '0', '0', '0', '0', '1', NULL, NULL, '1', 'FINANCE COLUMBIA', 1, 1644286982, 1644288001),
(149, 8, NULL, NULL, 'INQ6607', 'FINANCE NSC', '0', '0', '0', '0', '1', NULL, NULL, '1', 'FINANCE NSC', 1, 1644287010, 1644288001),
(150, 8, NULL, NULL, 'INQ6608', 'CEK TAGIHAN OTO FINANCE', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAGIHAN OTO FINANCE', 1, 1644287029, 1644288002),
(151, 8, NULL, NULL, 'INQ6609', 'FINANCE SMS 5000', '0', '0', '0', '0', '1', NULL, NULL, '1', 'FINANCE SMS 5000', 1, 1644287055, 1644288002),
(152, 8, NULL, NULL, 'INQ6613', 'CEK TAGIHAN BFI FINANCE', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAGIHAN BFI FINANCE', 1, 1644287095, 1644288002),
(153, 8, NULL, NULL, 'INQ6614', 'CEK TAG. TUNAS MANDIRI', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAG. TUNAS MANDIRI', 1, 1644287159, 1644288002),
(154, 8, NULL, NULL, 'INQ6621', 'CEK TAGIHAN BUANA FINANCE', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAGIHAN BUANA FINANCE', 1, 1644287179, 1644288002),
(155, 8, NULL, NULL, 'INQ7703', 'CEK TAGIHAN ALMADANI', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAGIHAN ALMADANI', 1, 1644287212, 1644288003),
(156, 8, NULL, NULL, 'INQ7711', 'CEK TAGIHAN CAPELLA MULTIDANA', '0', '0', '0', '0', '1', NULL, NULL, '1', 'CEK TAGIHAN CAPELLA MULTIDANA', 1, 1644287241, 1644288003),
(157, 8, NULL, NULL, 'INQ6610', 'FINANCE WOM 4000', '0', '0', '0', '0', '1', NULL, NULL, '1', 'FINANCE WOM 4000', 1, 1644287267, 1644288003),
(158, 8, NULL, NULL, 'INQ6601', 'FINANCE ADIRA 7500', '0', '0', '0', '0', '1', NULL, NULL, '1', 'FINANCE ADIRA 7500', 1, 1644287283, 1644288003),
(159, 8, NULL, NULL, 'PAY3001', 'TAGIHAN ASTRA FINANCE', '1000', '0', '0', '0', '2', NULL, NULL, '1', 'TAGIHAN ASTRA FINANCE', 1, 1644288076, 1644300980),
(160, 6, NULL, NULL, 'SHP10', '10K', '10585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPPEPAY 10K', 1, 1644306696, 1644307326),
(161, 6, NULL, NULL, 'SHP20', '20K', '20585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPPEPAY 20K', 1, 1644306914, 1644307327),
(162, 6, NULL, NULL, 'SHP30', '30K', '30585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPPEPAY 30K', 1, 1644306934, 1644307327),
(163, 6, NULL, NULL, 'SHP40', '40K', '40585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPPEPAY 40K', 1, 1644306950, 1644307327),
(164, 6, NULL, NULL, 'SHP50', '50K', '50585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPPEPAY 50K', 1, 1644306965, 1644307327),
(165, 6, NULL, NULL, 'SHP60', '60K', '60585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPPEPAY 60K', 1, 1644306978, 1644307327),
(166, 6, NULL, NULL, 'SHP70', '70K', '70585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPPEPAY 70K', 1, 1644306994, 1644307328),
(167, 6, NULL, NULL, 'SHP80', '80K', '80585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPPEPAY 80K', 1, 1644307008, 1644307328),
(168, 6, NULL, NULL, 'SHP90', '90K', '90585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPPEPAY 90K', 1, 1644307024, 1644307328),
(169, 6, NULL, NULL, 'SHP100', '100K', '100585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPPEPAY 100K', 1, 1644307040, 1644307328),
(170, 6, NULL, NULL, 'SHP150', '150K', '150585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPPEPAY 150K', 1, 1644307055, 1644307328),
(171, 6, NULL, NULL, 'SHP200', '200K', '200585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPEPAY 200K', 1, 1644307068, 1644307329),
(172, 6, NULL, NULL, 'SHP300', '300K', '300585', '0', '0', '0', '2', '3', NULL, '1', 'SALDO SHOPEPAY 300K', 1, 1644307082, 1644307329),
(173, 6, NULL, NULL, 'GRC20', '20K', '20725', '0', '0', '0', '2', '1', '2', '1', 'SALDO GRAB KONSUMEN ', 1, 1644312950, 1644313308),
(174, 6, NULL, NULL, 'GRC25', '25K', '25725', '0', '0', '0', '2', '1', '2', '1', 'SALDO GRAB KONSUMEN', 1, 1644312972, 1644313309),
(175, 6, NULL, NULL, 'GRC40', '40K', '40725', '0', '0', '0', '2', '1', '2', '1', 'SALDO GRAB KONSUMEN', 1, 1644312989, 1644313309),
(176, 6, NULL, NULL, 'GRC50', '50K', '50725', '0', '0', '0', '2', '1', '2', '1', 'SALDO GRAB KONSUMEN', 1, 1644313006, 1644313309),
(177, 6, NULL, NULL, 'GRC75', '75K', '75725', '0', '0', '0', '2', '1', '2', '1', 'SALDO GRAB KONSUMEN', 1, 1644313022, 1644313309),
(178, 6, NULL, NULL, 'GRC100', '100K', '100725', '0', '0', '0', '2', '1', '2', '1', 'SALDO GRAB KONSUMEN', 1, 1644313039, 1644313310),
(179, 6, NULL, NULL, 'GRC150', '150K', '150725', '0', '0', '0', '2', '1', '2', '1', 'SALDO GRAB KONSUMEN', 1, 1644313053, 1644313310),
(180, 6, NULL, NULL, 'GRD50', '50K', '50595', '0', '0', '0', '2', '1', '1', '1', 'SALDO GRAB DRIVER', 1, 1644313113, 1644313310),
(181, 6, NULL, NULL, 'GRD100', '100K', '100195', '0', '0', '0', '2', '1', '1', '1', 'SALDO GRAB DRIVER', 1, 1644313127, 1644313310),
(182, 6, NULL, NULL, 'GRD150', '150K', '150195', '0', '0', '0', '2', '1', '1', '1', 'SALDO GRAB DRIVER', 1, 1644313143, 1644313310),
(183, 6, NULL, NULL, 'GRD200', '200K', '200195', '0', '0', '0', '2', '1', '1', '1', 'SALDO GRAB DRIVER', 1, 1644313158, 1644313311),
(184, 6, NULL, NULL, 'GRD250', '250K', '250195', '0', '0', '0', '2', '1', '1', '1', 'SALDO GRAB DRIVER', 1, 1644313174, 1644313311),
(185, 6, NULL, NULL, 'OVP20', '20K', '20675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H 20K', 1, 1644313324, 1644313569),
(187, 6, NULL, NULL, 'OVP30', '30K', '30675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H 30K', 1, 1644313356, 1644313569),
(188, 6, NULL, NULL, 'OVP40', '40K', '40675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H 40K', 1, 1644313390, 1644313569),
(189, 6, NULL, NULL, 'OVP50', '50K', '50675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H 50K', 1, 1644313404, 1644313569),
(190, 6, NULL, NULL, 'OVP60', '60K', '60675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H 60K', 1, 1644313418, 1644313569),
(191, 6, NULL, NULL, 'OVP70', '70K', '70675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H 70K', 1, 1644313431, 1644313570),
(192, 6, NULL, NULL, 'OVP80', '80K', '80675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H 80K', 1, 1644313445, 1644313570),
(193, 6, NULL, NULL, 'OVP90', '90K', '90675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H 90K', 1, 1644313460, 1644313570),
(194, 6, NULL, NULL, 'OVP100', '100K', '100675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H  100K', 1, 1644313473, 1644313570),
(195, 6, NULL, NULL, 'OVP150', '150K', '150675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H 150K', 1, 1644313489, 1644313570),
(196, 6, NULL, NULL, 'OVP200', '200K', '200675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H 200K', 1, 1644313502, 1644313571),
(197, 6, NULL, NULL, 'OVP300', '300K', '300675', '0', '0', '0', '2', '2', NULL, '1', 'SALDO OVO H2H 300K', 1, 1644313519, 1644313571),
(198, 6, NULL, NULL, 'SGC10', '10K', '10585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 10K', 1, 1644313712, 1644379272),
(199, 6, NULL, NULL, 'SGC20', '20K', '20585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 20K', 1, 1644313751, 1644379273),
(200, 6, NULL, NULL, 'SGC30', '30K', '30585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 30K', 1, 1644313769, 1644379273),
(201, 6, NULL, NULL, 'SGC40', '40K', '40585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 40K', 1, 1644313785, 1644379282),
(202, 6, NULL, NULL, 'SGC50', '50K', '50585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 50K', 1, 1644313802, 1644379282),
(203, 6, NULL, NULL, 'SGC60', '60K', '60585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 60K', 1, 1644313820, 1644379282),
(204, 6, NULL, NULL, 'SGC70', '70K', '70585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 70K', 1, 1644313838, 1644379283),
(205, 6, NULL, NULL, 'SGC80', '80K', '80585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 80K', 1, 1644313855, 1644379283),
(206, 6, NULL, NULL, 'SGC90', '90K', '90585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 90K', 1, 1644313871, 1644379283),
(207, 6, NULL, NULL, 'SGC100', '100K', '100585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 100K', 1, 1644313890, 1644379283),
(208, 6, NULL, NULL, 'SGC150', '150K', '150585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 150K', 1, 1644313905, 1644379283),
(209, 6, NULL, NULL, 'SGC200', '200K', '200585', '0', '0', '0', '2', '4', '2', '1', 'SALDO GOJEK CUSTOMER 200K', 1, 1644313919, 1644379284),
(210, 7, 1, 8, 'INQ643', 'PDAM Kabupaten Aceh Barat', '0', '0', '0', '0', '1', NULL, NULL, '1', 'PDAM Kabupaten Aceh Barat ', 1, 1644395009, 1644460091),
(211, 7, 2, 12, 'INQ630', 'PDAM Kota Denpasar', '0', '0', '0', '0', '1', NULL, NULL, '1', 'PDAM Kota Denpasar', 1, 1644398848, 1644460091),
(213, 7, 2, 12, 'INQ720', 'PDAM Kota Denpasar (BALI)', '0', '0', '0', '0', '2', NULL, NULL, '0', 'TELKOMPAY 3000 (SPEEDY)', 1, 1644400509, 1644460231),
(214, 7, 10, 13, 'INQ654', 'PDAM Kota Bandung', '0', '0', '0', '0', '1', NULL, NULL, '1', 'PDAM Kota Bandung', 1, 1644459735, 1644460092),
(215, 7, 10, 13, 'PAY654', 'PDAM Kota Bandung (JABAR)', '250', '0', '0', '0', '2', NULL, NULL, '1', 'PDAM Kota Bandung (JABAR)', 1, 1644460020, 1644460092),
(216, 7, 10, 14, 'PAY646', 'PDAM Kabupaten Bogor (JABAR)', '250', '0', '0', '0', '2', NULL, NULL, '1', 'PDAM Kabupaten Bogor (JABAR)', 1, 1644460537, 1644460624),
(217, 7, 10, 14, 'INQ646', 'PDAM Kabupaten Bogor', '0', '0', '0', '0', '1', NULL, NULL, '1', 'PDAM Kabupaten Bogor', 1, 1644460577, 1644460625);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `provinsi_id` int(11) NOT NULL,
  `nama_provinsi` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`provinsi_id`, `nama_provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Aceh', 1644388970, 1644389158),
(2, 'Bali', 1644389184, 1644389184),
(3, 'Bangka Belitung', 1644389339, 1644389339),
(4, 'Banten', 1644389394, 1644389394),
(5, 'Bengkulu', 1644389407, 1644389407),
(6, 'DI Yogyakarta', 1644389420, 1644389420),
(7, 'DKI Jakarta', 1644389437, 1644389437),
(8, 'Gorontalo', 1644389450, 1644389450),
(9, 'Jambi', 1644389460, 1644389460),
(10, 'Jawa Barat', 1644389472, 1644389472),
(11, 'Jawa Tengah', 1644389485, 1644389485),
(12, 'Jawa Timur', 1644389496, 1644389496),
(13, 'Kalimantan', 1644389508, 1644389508),
(14, 'Kalimantan Barat', 1644389518, 1644389518),
(15, 'Kalimantan Selatan', 1644389532, 1644389532),
(16, 'Kalimantan Timur', 1644389568, 1644389568),
(17, 'Kalimantan Utara', 1644389578, 1644389578),
(18, 'Kepulauan Riau', 1644389591, 1644389591),
(19, 'Lampung', 1644389596, 1644389596),
(20, 'Maluku', 1644389605, 1644389605),
(21, 'Maluku Utara', 1644389612, 1644389612),
(22, 'Nusa Tenggara Barat', 1644389627, 1644389627),
(23, 'Nusa Tenggara Timur', 1644389641, 1644389641),
(24, 'Papua', 1644389649, 1644389649),
(25, 'Riau', 1644389657, 1644389657),
(26, 'Sulawesi', 1644389668, 1644389668),
(27, 'Sulawesi Barat', 1644389685, 1644389685),
(28, 'Sulawesi Selatan', 1644389694, 1644389694),
(29, 'Sulawesi Tengah', 1644389705, 1644389705),
(30, 'Sulawesi Utara', 1644389713, 1644389713),
(31, 'Sumatera', 1644389779, 1644389779),
(32, 'Sumatera Barat', 1644389794, 1644389794),
(33, 'Sumatera Selatan', 1644389813, 1644389813),
(34, 'Sumatera Utara', 1644389835, 1644389835);

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `tagihan_id` int(11) NOT NULL,
  `layanan_id` int(11) NOT NULL,
  `kode_tagihan` varchar(255) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `dest` varchar(255) NOT NULL,
  `status_tagihan` enum('0','1','2','3','4') NOT NULL DEFAULT '0' COMMENT '0.Menunggu Pembayaran,  1.Proses, 2.Selesai, 3.Batal, 4.Gagal	',
  `total_harga` varchar(255) NOT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`tagihan_id`, `layanan_id`, `kode_tagihan`, `kode_produk`, `nama_pelanggan`, `dest`, `status_tagihan`, `total_harga`, `serial_number`, `keterangan`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 3, 'FP809030222080506', 'INQ3511', NULL, '521082117417', '0', '357183', NULL, NULL, 1, 1643871906, 1643871913),
(2, 3, 'FP928040222105729', 'INQ3511', NULL, '521082117417', '0', '357183', NULL, NULL, 1, 1643968649, 1643968655),
(3, 1, 'FP660040222105805', 'TM500', NULL, '082322525083', '4', '489925', NULL, NULL, 1, 1643968685, 1643968697),
(4, 3, 'FP282040222105955', 'INQ3511', NULL, '521082117417', '2', '357183', NULL, NULL, 1, 1643968795, 1643968817),
(5, 1, 'FP785070222032553', 'TM500', NULL, '082322525083', '4', '489925', NULL, NULL, 1, 1644200753, 1644200762),
(6, 4, 'FP943070222043133', 'PLZ5', NULL, '32118447286', '0', '0', NULL, NULL, 1, 1644204693, 1644204693),
(7, 1, 'FP572070222043242', 'TM500', NULL, '082322525083', '0', '489925', NULL, NULL, 1, 1644204762, 1644204762),
(8, 4, 'FP451070222043338', 'PLZ5', NULL, '32118447286', '0', '0', NULL, NULL, 1, 1644204818, 1644204818),
(9, 4, 'FP214070222043412', 'PLZ1000', NULL, '32118447286', '0', '999990', NULL, NULL, 1, 1644204852, 1644204852),
(10, 4, 'FP477070222043637', 'PLZ1000', NULL, '32118447286', '0', '999990', NULL, NULL, 1, 1644204998, 1644204998),
(11, 4, 'FP882070222043813', 'PLZ1000', NULL, '32118447286', '0', '999990', NULL, NULL, 1, 1644205093, 1644205093),
(12, 4, 'FP855070222044129', 'PLZ1000', NULL, '32118447286', '0', '999990', NULL, NULL, 1, 1644205289, 1644205289),
(13, 1, 'FP941070222045025', 'TM500', NULL, '082322525083', '4', '489925', NULL, NULL, 1, 1644205825, 1644205856),
(14, 4, 'FP312070222045938', 'PLZ1000', NULL, '32118447286', '0', '999990', NULL, NULL, 1, 1644206378, 1644206378),
(15, 4, 'FP884070222050456', 'PLZ1000', NULL, '32118447286', '4', '999990', NULL, NULL, 1, 1644206696, 1644206711),
(16, 3, 'FP594070222050840', 'INQ3511', NULL, '521082117417', '4', '357183', NULL, NULL, 1, 1644206920, 1644207106),
(17, 5, 'FP155070222052220', 'INQ720', NULL, '141114171573', '4', '261000', NULL, NULL, 1, 1644207740, 1644207748),
(18, 4, 'FP366070222054642', 'PLZ5', NULL, '141114171573', '0', '0', NULL, NULL, 1, 1644209202, 1644209202),
(19, 4, 'FP769070222054927', 'PLZ5', NULL, '32118447286', '0', '0', NULL, NULL, 1, 1644209368, 1644209368),
(20, 4, 'FP168070222055003', 'PLZ5', NULL, '32118447286', '0', '0', NULL, NULL, 1, 1644209406, 1644209406),
(21, 4, 'FP725070222055815', 'CPLZ1000', NULL, '32118447286', '0', '0', NULL, NULL, 1, 1644209895, 1644209895),
(22, 4, 'FP551070222073324', 'PLZ1000', NULL, '141114171573', '0', '0', NULL, NULL, 1, 1644215604, 1644215604),
(23, 4, 'FP341070222073510', 'PLZ500', NULL, '32118447286', '0', '0', NULL, NULL, 1, 1644215710, 1644215710),
(24, 4, 'FP588070222073724', 'CPLZ', NULL, '32118447286', '0', '0', NULL, NULL, 1, 1644215844, 1644215948),
(25, 4, 'FP526070222074435', 'PLZ1000', NULL, '32118447286', '4', '0', NULL, NULL, 1, 1644216275, 1644216729),
(26, 4, 'FP113070222075718', 'PLZ1000', NULL, '32118447286', '4', '998990', NULL, NULL, 1, 1644217038, 1644217118),
(27, 4, 'FP363070222080942', 'PLZ200', NULL, '32118447286', '4', '199990', NULL, NULL, 1, 1644217782, 1644217799),
(28, 4, 'FP646070222081158', 'PLZ5', 'TOKO VARIZAL AMIR', '32118447286', '2', '6545', '2424-3475-8417-0388-3628', NULL, 1, 1644217919, 1644219076),
(29, 3, 'FP834070222083850', 'INQ3511', 'SUMARNO', '521082117417', '4', '357183', NULL, NULL, 1, 1644219530, 1644219858),
(30, 3, 'FP709070222084716', '', NULL, '521082117417', '0', '0', NULL, NULL, 1, 1644220036, 1644220036),
(31, 3, 'FP920070222084747', 'PAY3511', 'SUMARNO', '521082117417', '4', '357183', NULL, NULL, 1, 1644220067, 1644220387),
(32, 1, 'FP463070222085319', 'TM500', NULL, '082322525083', '4', '489925', NULL, NULL, 1, 1644220399, 1644220410),
(33, 2, 'FP508070222085347', 'TDFH12', NULL, '082322525083', '4', '103000', NULL, NULL, 1, 1644220428, 1644220445),
(34, 4, 'FP581070222085422', 'PLZ1000', 'TOKO VARIZAL AMIR', '32118447286', '4', '998990', NULL, NULL, 1, 1644220462, 1644220482),
(35, 5, 'FP751070222085454', 'INQ720', NULL, '141114171573', '0', '0', NULL, NULL, 1, 1644220494, 1644220494),
(36, 5, 'FP672070222085652', 'INQ720', NULL, '141114171573', '4', '0', NULL, NULL, 1, 1644220612, 1644220721),
(37, 4, 'FP825070222090331', 'PLZ1000', 'TOKO VARIZAL AMIR', '32118447286', '4', '998990', NULL, NULL, 1, 1644221011, 1644221022),
(38, 8, 'FP125070222093019', 'INQ793', NULL, '521082117417', '4', '0', NULL, NULL, 1, 1644222619, 1644222655),
(39, 8, 'FP449070222094413', 'INQ3001', NULL, '02300302001858376', '0', '0', NULL, NULL, 1, 1644223453, 1644223453),
(40, 8, 'FP312070222095133', 'INQ3001', NULL, '02300302001858376', '0', '0', NULL, NULL, 1, 1644223893, 1644223893),
(41, 8, 'FP291070222100635', 'INQ6602', NULL, '310010119499', '0', '0', NULL, NULL, 1, 1644224795, 1644224795),
(42, 8, 'FP285070222101700', 'INQ6604', NULL, '533000569191', '0', '0', NULL, NULL, 1, 1644225420, 1644225420),
(43, 8, 'FP774070222101811', 'INQ6604', NULL, '533000569191', '4', '0', NULL, NULL, 1, 1644225491, 1644225498),
(44, 8, 'FP665070222102424', 'INQ6602', NULL, '310010119499', '4', '0', NULL, NULL, 1, 1644225864, 1644225871),
(45, 8, 'FP423070222102802', 'INQ6602', NULL, '310010119499', '4', '0', NULL, NULL, 1, 1644226082, 1644226089),
(46, 8, 'FP986070222104420', 'INQ6602', NULL, '310010119499', '0', '0', NULL, NULL, 1, 1644227060, 1644227060),
(47, 8, 'FP898070222104457', 'INQ6602', NULL, '310010119499', '0', '0', NULL, NULL, 1, 1644227097, 1644227097),
(48, 8, 'FP304080222033058', 'INQ791', NULL, '02300302001858376', '4', '0', NULL, NULL, 1, 1644287458, 1644287560),
(49, 1, 'FP696080222033720', 'TM500', NULL, '082322525083', '4', '489925', NULL, NULL, 1, 1644287840, 1644287851),
(50, 1, 'FP791080222043547', 'TM500', NULL, '082322525083', '0', '489925', NULL, NULL, 1, 1644291348, 1644291348),
(51, 1, 'FP926080222043608', 'TM500', NULL, '082322525083', '0', '489925', NULL, NULL, 1, 1644291368, 1644291368),
(52, 1, 'FP434080222043630', 'TM500', NULL, '082322525083', '4', '489925', NULL, NULL, 1, 1644291391, 1644291606),
(53, 1, 'FP719080222043732', 'TM500', NULL, '082322525083', '0', '489925', NULL, NULL, 1, 1644291452, 1644291452),
(54, 1, 'FP797080222044025', 'TM150', NULL, '082322525083', '4', '147750', NULL, NULL, 1, 1644291625, 1644291642),
(55, 1, 'FP350080222044054', 'TM200', NULL, '082322525083', '4', '195900', NULL, NULL, 1, 1644291654, 1644291673),
(56, 2, 'FP917080222044537', 'TDH25', NULL, '082322525083', '4', '191200', NULL, NULL, 1, 1644291937, 1644291939),
(57, 3, 'FP166080222045748', 'INQ3511', NULL, '521082117417', '0', '0', NULL, NULL, 1, 1644292668, 1644292668),
(58, 3, 'FP358080222045800', 'INQ3511', 'SUMARNO', '521082117417', '0', '357183', NULL, NULL, 1, 1644292680, 1644292687),
(59, 3, 'FP465080222050151', 'INQ3511', 'SUMARNO', '521082117417', '0', '357183', NULL, NULL, 1, 1644292911, 1644292918),
(60, 3, 'FP327080222050403', 'INQ3511', 'SUMARNO', '521082117417', '0', '357183', NULL, NULL, 1, 1644293043, 1644293217),
(61, 1, 'FP600080222050555', 'TM500', NULL, '082322525083', '0', '489925', NULL, NULL, 1, 1644293161, 1644293161),
(62, 3, 'FP234080222050718', 'PAY3511', 'SUMARNO', '521082117417', '4', '357183', NULL, NULL, 1, 1644293238, 1644293406),
(63, 3, 'FP150080222051310', 'PAY3511', 'SUMARNO', '521082117417', '4', '357183', NULL, NULL, 1, 1644293590, 1644293609),
(64, 4, 'FP606080222053350', 'PLZ500', NULL, '310010119499', '4', '0', NULL, NULL, 1, 1644294830, 1644294838),
(65, 4, 'FP756080222053712', 'PLZ500', NULL, '310010119499', '4', '0', NULL, NULL, 1, 1644295032, 1644295060),
(66, 4, 'FP830080222053815', 'PLZ500', NULL, '310010119499', '0', '0', NULL, NULL, 1, 1644295095, 1644295095),
(67, 4, 'FP900080222053908', 'PLZ200', 'TOKO VARIZAL AMIR', '32118447286', '0', '199990', NULL, NULL, 1, 1644295148, 1644295162),
(68, 4, 'FP416080222053943', 'PLZ1000', 'TOKO VARIZAL AMIR', '32118447286', '4', '998990', NULL, NULL, 1, 1644295183, 1644295354),
(69, 4, 'FP457080222054306', 'PLZ200', 'TOKO VARIZAL AMIR', '32118447286', '4', '199990', NULL, NULL, 1, 1644295386, 1644295403),
(70, 4, 'FP502080222054643', 'PLZ1000', 'TOKO VARIZAL AMIR', '32118447286', '4', '998990', NULL, NULL, 1, 1644295603, 1644295616),
(71, 5, 'FP716080222055229', 'PAY720', 'akbar wicaksono', '141114171573', '4', '261000', NULL, NULL, 1, 1644295949, 1644296129),
(72, 8, 'FP340080222060031', 'INQ6604', NULL, '02300302001858376', '4', '0', NULL, NULL, 1, 1644296431, 1644296439),
(73, 1, 'FP137080222070303', 'TM500', NULL, '082322525083', '4', '489925', NULL, NULL, 1, 1644300183, 1644300185),
(74, 2, 'FP862080222070314', 'TDFP8', NULL, '082322525083', '4', '85000', NULL, NULL, 1, 1644300194, 1644300195),
(75, 3, 'FP321080222070322', 'PAY3511', 'SUMARNO', '521082117417', '4', '357183', NULL, NULL, 1, 1644300203, 1644300220),
(76, 4, 'FP761080222070557', 'PLZ200', 'TOKO VARIZAL AMIR', '32118447286', '4', '199990', NULL, NULL, 1, 1644300357, 1644300365),
(77, 4, 'FP279080222070619', 'PLZ200', 'TOKO VARIZAL AMIR', '32118447286', '4', '199990', NULL, NULL, 1, 1644300379, 1644300399),
(78, 4, 'FP188080222070652', 'PLZ200', 'TOKO VARIZAL AMIR', '32118447286', '4', '199990', NULL, NULL, 1, 1644300413, 1644300417),
(79, 5, 'FP345080222070732', 'PAY720', 'akbar wicaksono', '141114171573', '4', '261000', NULL, NULL, 1, 1644300452, 1644300486),
(80, 3, 'FP545080222071744', 'PAY3511', 'SUMARNO', '521082117417', '4', '359683', NULL, NULL, 1, 1644301064, 1644301707),
(81, 3, 'FP796080222072913', 'PAY3511', 'SUMARNO', '521082117417', '4', '359683', NULL, NULL, 1, 1644301753, 1644301843),
(82, 3, 'FP343080222073016', 'PAY3511', 'SUMARNO', '521082117417', '4', '359683', NULL, NULL, 1, 1644301816, 1644301869),
(83, 1, 'FP310090222031651', 'TM500', NULL, '082322525083', '4', '489925', NULL, NULL, 1, 1644373012, 1644373016),
(84, 3, 'FP334090222031725', 'PAY3511', 'SUMARNO', '521082117417', '4', '359683', NULL, NULL, 1, 1644373045, 1644373057),
(85, 6, 'FP254090222033250', 'SHP300', NULL, '082322525083', '4', '0', NULL, NULL, 1, 1644373970, 1644373977),
(86, 6, 'FP923090222050559', 'SHP300', NULL, '082322525083', '0', '0', NULL, NULL, 1, 1644379559, 1644379559),
(87, 6, 'FP189090222050655', 'SHP300', NULL, '082322525083', '4', '300585', NULL, NULL, 1, 1644379615, 1644379618),
(88, 7, 'FP407100222030300', 'INQ643', NULL, '521082117417', '4', '0', NULL, NULL, 1, 1644458580, 1644458588),
(89, 7, 'FP575100222032237', 'INQ654', 'IDA AYU WARSIKI', '00501670425', '0', '53050', NULL, NULL, 1, 1644459757, 1644460438),
(90, 7, 'FP530100222033810', 'INQ646', NULL, '00501670425', '0', '0', NULL, NULL, 1, 1644460690, 1644460690),
(91, 7, 'FP175100222034529', 'INQ646', NULL, '00501670425', '4', '0', NULL, NULL, 1, 1644461129, 1644461353),
(92, 7, 'FP366100222034940', 'PAY654', 'IDA AYU WARSIKI', '00501670425', '4', '53050', NULL, NULL, 1, 1644461380, 1644461504),
(93, 6, 'FP231100222035350', 'SHP300', NULL, '082322525083', '4', '300585', NULL, NULL, 1, 1644461631, 1644461633),
(94, 5, 'FP373100222035700', 'PAY720', 'akbar wicaksono', '141114171573', '4', '261000', NULL, NULL, 1, 1644461823, 1644461849),
(95, 7, 'FP749100222035747', 'PAY654', 'IDA AYU WARSIKI', '00501670425', '4', '53050', NULL, NULL, 1, 1644461867, 1644461918),
(96, 8, 'FP958100222051010', 'INQ6602', NULL, '310010119499', '4', '0', NULL, NULL, 1, 1644466210, 1644466218),
(97, 4, 'FP750100222054145', '', 'TOKO VARIZAL AMIR', '32118447286', '0', '0', NULL, NULL, 1, 1644468105, 1644468399),
(98, 4, 'FP210100222054726', '', 'TOKO VARIZAL AMIR', '32118447286', '0', '0', NULL, NULL, 1, 1644468449, 1644468456),
(99, 4, 'FP229100222054840', 'PLZ1000', 'TOKO VARIZAL AMIR', '32118447286', '0', '998990', NULL, NULL, 1, 1644468520, 1644468567),
(100, 1, 'FP134100222070242', 'TM500', NULL, '082322525083', '4', '489925', NULL, NULL, 1, 1644472963, 1644472965),
(101, 6, 'FP535100222070654', 'SHP10', 'aXXXXXXXXXXXXXXXa', '082322525083', '2', '10585', NULL, NULL, 1, 1644473214, 1644474010),
(102, 3, 'FP934100222072836', 'PAY3511', 'SUMARNO', '521082117417', '4', '359683', NULL, NULL, 1, 1644474516, 1644474770),
(103, 5, 'FP382100222073642', 'PAY720', 'akbar wicaksono', '141114171573', '4', '261000', NULL, NULL, 1, 1644475002, 1644475019);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'PsSYqueBa69t_wOquVFKi47jzmrzbhpy', '$2y$13$Kn6zzamuFOhck/IgvkNqfu2qNJ4U7P7t78y2hlvsG6lw.8hqKEP5i', NULL, 'programmer@fasapay.co.id', 10, 1643871893, 1643871893, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_upload`
--
ALTER TABLE `file_upload`
  ADD PRIMARY KEY (`file_upload_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`kota_id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`layanan_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`provinsi_id`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`tagihan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_upload`
--
ALTER TABLE `file_upload`
  MODIFY `file_upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `kota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `layanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `provinsi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `tagihan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
