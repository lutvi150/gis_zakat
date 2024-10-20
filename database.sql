-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6935
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table zakat.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table zakat.migrations: ~5 rows (approximately)
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2024-09-07-102114', 'App\\Database\\Migrations\\TableUser', 'default', 'App', 1725704612, 1),
	(2, '2024-09-07-112138', 'App\\Database\\Migrations\\TableZakat', 'default', 'App', 1725708625, 2),
	(3, '2024-09-07-141659', 'App\\Database\\Migrations\\TableDokumentasi', 'default', 'App', 1725719173, 3),
	(4, '2024-09-07-142045', 'App\\Database\\Migrations\\TableBantuan', 'default', 'App', 1725719173, 3),
	(5, '2024-10-20-160406', 'App\\Database\\Migrations\\TableSetting', 'default', 'App', 1729448776, 4);

-- Dumping structure for table zakat.table_bantuan
CREATE TABLE IF NOT EXISTS `table_bantuan` (
  `id_bantuan` int(5) NOT NULL AUTO_INCREMENT,
  `id_zakat` int(5) NOT NULL,
  `peruntukan` text NOT NULL,
  `jenis_bantuan` varchar(255) NOT NULL,
  `total_bantuan` int(11) NOT NULL,
  `penerima_bantuan` varchar(500) NOT NULL,
  `jenis_identitas` varchar(50) NOT NULL,
  `nomor_identitas` varchar(50) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_bantuan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table zakat.table_bantuan: ~9 rows (approximately)
INSERT INTO `table_bantuan` (`id_bantuan`, `id_zakat`, `peruntukan`, `jenis_bantuan`, `total_bantuan`, `penerima_bantuan`, `jenis_identitas`, `nomor_identitas`, `latitude`, `longitude`, `nama_penerima`, `created_at`, `updated_at`) VALUES
	(2, 10, 'Bantuan modal usaha masyarakat tidak mampu', 'Uang', 1000000, '1', '1', '1194116806970002', '4.6309391934639965', '96.8288000585305', 'AYUNIARA SYAHMIDI', '2024-09-07 23:21:15', '2024-09-07 23:21:15'),
	(3, 11, 'Bantuan modal usaha', 'Uang', 23000000, '1', '1', '1194116806970002', '4.619304231039399', '96.80682740301567', 'AYUNIARA SYAHMIDI', '2024-09-07 23:28:11', '2024-09-07 23:29:05'),
	(4, 14, 'sekolah', 'uang', 2000000, '1', '1', '1104080408010001', '4.595675743317159', '96.99743320425866', 'SAFRIKA SYAHPUTRA', '2024-09-07 23:29:06', '2024-09-30 18:23:56'),
	(5, 16, 'pakir', 'uang tunai', 2000000, '1', '1', '1104080408010001', '4.647022502762781', '96.88441834304413', 'PUTRA', '2024-09-30 18:23:56', '2024-10-02 11:06:38'),
	(6, 17, 'Fakir', 'Uang', 3000000, '1', '1', '1194116806970002', '4.626528577771399', '96.82532869280723', 'AYUNIARA SYAHMIDI', '2024-10-02 11:06:38', '2024-10-09 13:02:56'),
	(7, 18, 'Miskin', 'uang', 2000000, '1', '1', '1112289y87565e65t', '4.648391278116749', '96.88819489323198', 'KANU', '2024-10-09 13:02:56', '2024-10-09 13:04:56'),
	(8, 19, 'Miskin', 'uang', 2147483647, '1', '1', '1104080408010001', '4.601166997294317', '96.99599823634401', 'IKA', '2024-10-09 13:04:56', '2024-10-09 13:07:00'),
	(9, 20, 'Riqab', 'uang', 3000000, '1', '1', '1104080408010001', '4.6316235970631485', '96.95273956917028', 'PUTRA', '2024-10-09 13:07:01', '2024-10-09 13:30:30'),
	(10, 0, '', '', 0, '', '', '', '', '', '', '2024-10-09 13:30:31', '2024-10-09 13:30:31');

-- Dumping structure for table zakat.table_dokumentasi
CREATE TABLE IF NOT EXISTS `table_dokumentasi` (
  `id_dokumentasi` int(5) NOT NULL AUTO_INCREMENT,
  `id_bantuan` int(11) NOT NULL,
  `dokumentasi` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_dokumentasi`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table zakat.table_dokumentasi: ~9 rows (approximately)
INSERT INTO `table_dokumentasi` (`id_dokumentasi`, `id_bantuan`, `dokumentasi`, `created_at`, `updated_at`) VALUES
	(5, 1, 'uploads/dokumentasi/240907104434_1725723874_8f52c6839707671146b8.png', '2024-09-07 22:44:34', '2024-09-07 22:44:34'),
	(6, 3, 'uploads/dokumentasi/240907112901_1725726541_0ef05cee3aa10c453aac.jpeg', '2024-09-07 23:29:01', '2024-09-07 23:29:01'),
	(8, 4, 'uploads/dokumentasi/240930125840_1727675920_ddfcb26e59da6e8348b0.jpg', '2024-09-30 12:58:40', '2024-09-30 12:58:40'),
	(10, 5, 'uploads/dokumentasi/241002110605_1727841965_c981686325974040a3fd.jpg', '2024-10-02 11:06:05', '2024-10-02 11:06:05'),
	(11, 6, 'uploads/dokumentasi/241009125432_1728453272_7b1938bc1f0e41949090.jpg', '2024-10-09 12:54:32', '2024-10-09 12:54:32'),
	(12, 6, 'uploads/dokumentasi/241009010048_1728453648_71ec1e6b99b6e6b3d6d8.jpg', '2024-10-09 13:00:48', '2024-10-09 13:00:48'),
	(13, 7, 'uploads/dokumentasi/241009010453_1728453893_86995c6529796c757369.jpg', '2024-10-09 13:04:53', '2024-10-09 13:04:53'),
	(14, 8, 'uploads/dokumentasi/241009010652_1728454012_59679f1961565794c767.jpg', '2024-10-09 13:06:52', '2024-10-09 13:06:52'),
	(15, 9, 'uploads/dokumentasi/241009013021_1728455421_20877e49297ca394b118.jpg', '2024-10-09 13:30:21', '2024-10-09 13:30:21');

-- Dumping structure for table zakat.table_setting
CREATE TABLE IF NOT EXISTS `table_setting` (
  `id_setting` int(5) NOT NULL AUTO_INCREMENT,
  `jenis_setting` varchar(255) NOT NULL,
  `value_setting` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table zakat.table_setting: ~1 rows (approximately)
INSERT INTO `table_setting` (`id_setting`, `jenis_setting`, `value_setting`, `created_at`, `updated_at`) VALUES
	(1, 'penerima', '[{"peruntukan":"Fakir","persentase":10,"total_dana":1961018000},{"peruntukan":"Miskin","persentase":30,"total_dana":5883054000},{"peruntukan":"Amil","persentase":12,"total_dana":2353221600},{"peruntukan":"Riqab","persentase":5,"total_dana":980509000},{"peruntukan":"Gharim","persentase":12,"total_dana":2353221600},{"peruntukan":"Fisabilillah","persentase":15,"total_dana":2941527000},{"peruntukan":"Ibnu_Sabil","persentase":15,"total_dana":2941527000},{"peruntukan":"Mualaf","persentase":1,"total_dana":196101800}]', '0000-00-00 00:00:00', NULL);

-- Dumping structure for table zakat.table_user
CREATE TABLE IF NOT EXISTS `table_user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table zakat.table_user: ~1 rows (approximately)
INSERT INTO `table_user` (`id`, `nama`, `email`, `password`, `role`, `last_login`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', '2024-09-07 17:23:41', '2024-09-07 17:23:41', NULL);

-- Dumping structure for table zakat.table_zakat
CREATE TABLE IF NOT EXISTS `table_zakat` (
  `id_zakat` int(5) NOT NULL AUTO_INCREMENT,
  `keterangan` text NOT NULL,
  `status` varchar(5) NOT NULL,
  `total` bigint(20) NOT NULL,
  `saldo_akhir` bigint(20) NOT NULL,
  `tanggal_transaksi` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_zakat`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table zakat.table_zakat: ~15 rows (approximately)
INSERT INTO `table_zakat` (`id_zakat`, `keterangan`, `status`, `total`, `saldo_akhir`, `tanggal_transaksi`, `created_at`, `updated_at`) VALUES
	(1, 'Zakat Dari Pemerintah Daerah Kabupaten Aceh Tengah tahun 2024', 'K', 2000000000, 2000000000, '2024-09-07', '2024-09-07 18:45:56', '2024-09-07 18:45:56'),
	(2, 'Hibah Dari Mesjid', 'K', 300000000, 2300000000, '2024-09-07', '2024-09-07 18:46:38', '2024-09-07 18:46:38'),
	(3, 'Zakat DROK Kabupaten Aceh Tengah', 'K', 345980000, 2645980000, '2024-09-07', '2024-09-07 18:47:16', '2024-09-07 18:47:16'),
	(4, 'Bantuan yang di terima oleh : AYUNIARA', 'D', 1000000, 2644980000, '2024-09-07', '2024-09-07 23:17:36', '2024-09-07 23:17:36'),
	(11, 'Bantuan yang di terima oleh :AYUNIARA SYAHMIDI', 'D', 23000000, 2621980000, '2024-09-07', '2024-09-07 23:29:04', '2024-09-07 23:29:04'),
	(12, 'kabut', 'K', 200000, 2622180000, '2024-09-30', '2024-09-30 08:17:07', '2024-09-30 08:17:07'),
	(13, 'uang masuk priode 2024', 'K', 2000000000, 4622180000, '2024-09-30', '2024-09-30 13:12:29', '2024-09-30 13:12:29'),
	(14, 'Bantuan yang di terima oleh :safrika syahputra', 'D', 2000000, 4620180000, '2024-09-30', '2024-09-30 18:23:56', '2024-09-30 18:23:56'),
	(15, 'dari kemenak', 'K', 2000000, 4622180000, '2024-10-02', '2024-10-02 11:04:31', '2024-10-02 11:04:31'),
	(16, 'Bantuan yang di terima oleh :putra', 'D', 2000000, 4620180000, '2024-10-02', '2024-10-02 11:06:38', '2024-10-02 11:06:38'),
	(17, 'Bantuan yang di terima oleh :AYUNIARA SYAHMIDI', 'D', 3000000, 4617180000, '2024-10-09', '2024-10-09 13:02:56', '2024-10-09 13:02:56'),
	(18, 'Bantuan yang di terima oleh :kanu', 'D', 2000000, 4615180000, '2024-10-09', '2024-10-09 13:04:56', '2024-10-09 13:04:56'),
	(19, 'Bantuan yang di terima oleh :ika', 'D', 2000000, 4613180000, '2024-10-09', '2024-10-09 13:07:00', '2024-10-09 13:07:00'),
	(20, 'Bantuan yang di terima oleh :putra', 'D', 3000000, 4610180000, '2024-10-09', '2024-10-09 13:30:30', '2024-10-09 13:30:30'),
	(21, 'Hibah Dari pemerintah daerah', 'K', 15000000000, 19610180000, '2024-10-20', '2024-10-20 23:15:29', '2024-10-20 23:15:29');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
