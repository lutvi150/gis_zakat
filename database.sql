-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table zakat.migrations: ~4 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2024-09-07-102114', 'App\\Database\\Migrations\\TableUser', 'default', 'App', 1725704612, 1),
	(2, '2024-09-07-112138', 'App\\Database\\Migrations\\TableZakat', 'default', 'App', 1725708625, 2),
	(3, '2024-09-07-141659', 'App\\Database\\Migrations\\TableDokumentasi', 'default', 'App', 1725719173, 3),
	(4, '2024-09-07-142045', 'App\\Database\\Migrations\\TableBantuan', 'default', 'App', 1725719173, 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table zakat.table_bantuan: ~3 rows (approximately)
/*!40000 ALTER TABLE `table_bantuan` DISABLE KEYS */;
INSERT INTO `table_bantuan` (`id_bantuan`, `id_zakat`, `peruntukan`, `jenis_bantuan`, `total_bantuan`, `penerima_bantuan`, `jenis_identitas`, `nomor_identitas`, `latitude`, `longitude`, `nama_penerima`, `created_at`, `updated_at`) VALUES
	(2, 10, 'Bantuan modal usaha masyarakat tidak mampu', 'Uang', 1000000, '1', '1', '1194116806970002', '4.6309391934639965', '96.8288000585305', 'AYUNIARA SYAHMIDI', '2024-09-07 23:21:15', '2024-09-07 23:21:15'),
	(3, 11, 'Bantuan modal usaha', 'Uang', 23000000, '1', '1', '1194116806970002', '4.619304231039399', '96.80682740301567', 'AYUNIARA SYAHMIDI', '2024-09-07 23:28:11', '2024-09-07 23:29:05'),
	(4, 0, '', '', 0, '', '', '', '', '', '', '2024-09-07 23:29:06', '2024-09-07 23:29:06');
/*!40000 ALTER TABLE `table_bantuan` ENABLE KEYS */;

-- Dumping structure for table zakat.table_dokumentasi
CREATE TABLE IF NOT EXISTS `table_dokumentasi` (
  `id_dokumentasi` int(5) NOT NULL AUTO_INCREMENT,
  `id_bantuan` int(11) NOT NULL,
  `dokumentasi` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_dokumentasi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table zakat.table_dokumentasi: ~2 rows (approximately)
/*!40000 ALTER TABLE `table_dokumentasi` DISABLE KEYS */;
INSERT INTO `table_dokumentasi` (`id_dokumentasi`, `id_bantuan`, `dokumentasi`, `created_at`, `updated_at`) VALUES
	(5, 1, 'uploads/dokumentasi/240907104434_1725723874_8f52c6839707671146b8.png', '2024-09-07 22:44:34', '2024-09-07 22:44:34'),
	(6, 3, 'uploads/dokumentasi/240907112901_1725726541_0ef05cee3aa10c453aac.jpeg', '2024-09-07 23:29:01', '2024-09-07 23:29:01');
/*!40000 ALTER TABLE `table_dokumentasi` ENABLE KEYS */;

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

-- Dumping data for table zakat.table_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `table_user` DISABLE KEYS */;
INSERT INTO `table_user` (`id`, `nama`, `email`, `password`, `role`, `last_login`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', '2024-09-07 17:23:41', '2024-09-07 17:23:41', NULL);
/*!40000 ALTER TABLE `table_user` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table zakat.table_zakat: ~4 rows (approximately)
/*!40000 ALTER TABLE `table_zakat` DISABLE KEYS */;
INSERT INTO `table_zakat` (`id_zakat`, `keterangan`, `status`, `total`, `saldo_akhir`, `tanggal_transaksi`, `created_at`, `updated_at`) VALUES
	(1, 'Zakat Dari Pemerintah Daerah Kabupaten Aceh Tengah tahun 2024', 'K', 2000000000, 2000000000, '2024-09-07', '2024-09-07 18:45:56', '2024-09-07 18:45:56'),
	(2, 'Hibah Dari Mesjid', 'K', 300000000, 2300000000, '2024-09-07', '2024-09-07 18:46:38', '2024-09-07 18:46:38'),
	(3, 'Zakat DROK Kabupaten Aceh Tengah', 'K', 345980000, 2645980000, '2024-09-07', '2024-09-07 18:47:16', '2024-09-07 18:47:16'),
	(4, 'Bantuan yang di terima oleh : AYUNIARA', 'D', 1000000, 2644980000, '2024-09-07', '2024-09-07 23:17:36', '2024-09-07 23:17:36'),
	(11, 'Bantuan yang di terima oleh :AYUNIARA SYAHMIDI', 'D', 23000000, 2621980000, '2024-09-07', '2024-09-07 23:29:04', '2024-09-07 23:29:04');
/*!40000 ALTER TABLE `table_zakat` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
