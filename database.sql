-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
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
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table zakat.migrations: ~6 rows (approximately)
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2024-09-07-102114', 'App\\Database\\Migrations\\TableUser', 'default', 'App', 1725704612, 1),
	(2, '2024-09-07-112138', 'App\\Database\\Migrations\\TableZakat', 'default', 'App', 1725708625, 2),
	(3, '2024-09-07-141659', 'App\\Database\\Migrations\\TableDokumentasi', 'default', 'App', 1725719173, 3),
	(4, '2024-09-07-142045', 'App\\Database\\Migrations\\TableBantuan', 'default', 'App', 1725719173, 3),
	(5, '2024-10-20-160406', 'App\\Database\\Migrations\\TableSetting', 'default', 'App', 1729448776, 4),
	(6, '2024-12-05-103140', 'App\\Database\\Migrations\\TableUsulZakat', 'default', 'App', 1733394868, 5);

-- Dumping structure for table zakat.table_bantuan
DROP TABLE IF EXISTS `table_bantuan`;
CREATE TABLE IF NOT EXISTS `table_bantuan` (
  `id_bantuan` int NOT NULL AUTO_INCREMENT,
  `id_zakat` int NOT NULL,
  `peruntukan` text NOT NULL,
  `jenis_bantuan` varchar(255) NOT NULL,
  `total_bantuan` int NOT NULL,
  `penerima_bantuan` varchar(500) NOT NULL,
  `jenis_identitas` varchar(50) NOT NULL,
  `nomor_identitas` varchar(50) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `kecamatan` char(50) NOT NULL DEFAULT '',
  `desa` char(50) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_bantuan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table zakat.table_bantuan: ~9 rows (approximately)
INSERT INTO `table_bantuan` (`id_bantuan`, `id_zakat`, `peruntukan`, `jenis_bantuan`, `total_bantuan`, `penerima_bantuan`, `jenis_identitas`, `nomor_identitas`, `latitude`, `longitude`, `nama_penerima`, `kecamatan`, `desa`, `created_at`, `updated_at`) VALUES
	(2, 10, 'Bantuan modal usaha masyarakat tidak mampu', 'Uang', 1000000, '1', '1', '1194116806970002', '4.6309391934639965', '96.8288000585305', 'AYUNIARA SYAHMIDI', '', '', '2024-09-07 23:21:15', '2024-09-07 23:21:15'),
	(3, 11, 'Bantuan modal usaha', 'Uang', 23000000, '1', '1', '1194116806970002', '4.619304231039399', '96.80682740301567', 'AYUNIARA SYAHMIDI', '', '', '2024-09-07 23:28:11', '2024-09-07 23:29:05'),
	(4, 14, 'sekolah', 'uang', 2000000, '1', '1', '1104080408010001', '4.595675743317159', '96.99743320425866', 'SAFRIKA SYAHPUTRA', '', '', '2024-09-07 23:29:06', '2024-09-30 18:23:56'),
	(5, 16, 'pakir', 'uang tunai', 2000000, '1', '1', '1104080408010001', '4.647022502762781', '96.88441834304413', 'PUTRA', '', '', '2024-09-30 18:23:56', '2024-10-02 11:06:38'),
	(6, 17, 'Fakir', 'Uang', 3000000, '1', '1', '1194116806970002', '4.626528577771399', '96.82532869280723', 'AYUNIARA SYAHMIDI', '', '', '2024-10-02 11:06:38', '2024-10-09 13:02:56'),
	(7, 18, 'Miskin', 'uang', 2000000, '1', '1', '1112289y87565e65t', '4.648391278116749', '96.88819489323198', 'KANU', '', '', '2024-10-09 13:02:56', '2024-10-09 13:04:56'),
	(8, 19, 'Miskin', 'uang', 2147483647, '1', '1', '1104080408010001', '4.601166997294317', '96.99599823634401', 'IKA', '', '', '2024-10-09 13:04:56', '2024-10-09 13:07:00'),
	(9, 20, 'Riqab', 'uang', 3000000, '1', '1', '1104080408010001', '4.6316235970631485', '96.95273956917028', 'PUTRA', '', '', '2024-10-09 13:07:01', '2024-10-09 13:30:30'),
	(10, 0, '', '', 0, '', '', '', '', '', '', '', '', '2024-10-09 13:30:31', '2024-10-09 13:30:31');

-- Dumping structure for table zakat.table_desa
DROP TABLE IF EXISTS `table_desa`;
CREATE TABLE IF NOT EXISTS `table_desa` (
  `id` char(50) DEFAULT NULL,
  `id_kecamatan` char(50) DEFAULT NULL,
  `nama_desa` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table zakat.table_desa: ~295 rows (approximately)
INSERT INTO `table_desa` (`id`, `id_kecamatan`, `nama_desa`) VALUES
	('1104012003', '110401', 'Delung Sekinel'),
	('1104012005', '110401', 'Gelampang Gading'),
	('1104012006', '110401', 'Gewat'),
	('1104012008', '110401', 'Jamat'),
	('1104012009', '110401', 'Kemerleng'),
	('1104012010', '110401', 'Kute Baru'),
	('1104012011', '110401', 'Kute Keramil'),
	('1104012012', '110401', 'Kute Rayang'),
	('1104012013', '110401', 'Kute Riyem'),
	('1104012014', '110401', 'Kute Robel'),
	('1104012015', '110401', 'Linge'),
	('1104012016', '110401', 'Lumut'),
	('1104012018', '110401', 'Mungkur'),
	('1104012019', '110401', 'Owaq'),
	('1104012020', '110401', 'Pantan Nangka'),
	('1104012021', '110401', 'Penarun'),
	('1104012022', '110401', 'Simpang Tige Uning'),
	('1104012023', '110401', 'Umang'),
	('1104012024', '110401', 'Despot Linge'),
	('1104012025', '110401', 'Gemboyah'),
	('1104012031', '110401', 'Arul Item'),
	('1104012032', '110401', 'Ise-Ise'),
	('1104012033', '110401', 'Kute Reje'),
	('1104012034', '110401', 'Reje Payung'),
	('1104012035', '110401', 'Pantan Reduk'),
	('1104012036', '110401', 'Antara'),
	('1104022001', '110402', 'Arul Gele'),
	('1104022002', '110402', 'Arul Kumer'),
	('1104022003', '110402', 'Burni Bius'),
	('1104022004', '110402', 'Genting Gerbang'),
	('1104022005', '110402', 'Gunung Singit'),
	('1104022007', '110402', 'Pepayungen Angkup'),
	('1104022008', '110402', 'Remesen'),
	('1104022009', '110402', 'Rutih'),
	('1104022010', '110402', 'Semelit Mutiara'),
	('1104022012', '110402', 'Wih Porak'),
	('1104022013', '110402', 'Wihni Bakong'),
	('1104022014', '110402', 'Wihni Durin'),
	('1104022016', '110402', 'Arul Putih'),
	('1104022017', '110402', 'Arul Relem'),
	('1104022018', '110402', 'Burni Bius Baru'),
	('1104022019', '110402', 'Jerata'),
	('1104022022', '110402', 'Paya Beke'),
	('1104022023', '110402', 'Paya Pelu'),
	('1104022026', '110402', 'Rebe Gedung'),
	('1104022027', '110402', 'Reremal'),
	('1104022029', '110402', 'Sanehen'),
	('1104022030', '110402', 'Simpang Kemili'),
	('1104022031', '110402', 'Tenebuk Kampung Baru'),
	('1104022032', '110402', 'Terang Engon'),
	('1104022033', '110402', 'Wih Pesam'),
	('1104022034', '110402', 'Bius Utama'),
	('1104022035', '110402', 'Meker Indah'),
	('1104022036', '110402', 'Mulie Jadi'),
	('1104022037', '110402', 'Wih Bersih'),
	('1104022038', '110402', 'Wih Sagi Indah'),
	('1104022039', '110402', 'Arul Kumer Barat'),
	('1104022040', '110402', 'Arul Kumer Timur'),
	('1104022041', '110402', 'Arul Kumer Selatan'),
	('1104032001', '110403', 'Blang Kolak I'),
	('1104032002', '110403', 'Bebesan'),
	('1104032003', '110403', 'Mongal'),
	('1104032004', '110403', 'Daling'),
	('1104032005', '110403', 'Tensaran'),
	('1104032006', '110403', 'Lelabu'),
	('1104032007', '110403', 'Blang Gele'),
	('1104032008', '110403', 'Kemili'),
	('1104032009', '110403', 'Tan Saril'),
	('1104032010', '110403', 'Blang Kolak II'),
	('1104032011', '110403', 'Umang'),
	('1104032012', '110403', 'Simpang IV'),
	('1104032013', '110403', 'Bahgie'),
	('1104032014', '110403', 'Keramat Mupakat'),
	('1104032015', '110403', 'Atu Gajah Reje Guru'),
	('1104032016', '110403', 'Atu Tulu'),
	('1104032017', '110403', 'Burbiah'),
	('1104032018', '110403', 'Empus Talu'),
	('1104032019', '110403', 'Gele Lah'),
	('1104032020', '110403', 'Kebet'),
	('1104032021', '110403', 'Lemah Burbana'),
	('1104032022', '110403', 'Mah Bengi'),
	('1104032023', '110403', 'Nunang Antara'),
	('1104032024', '110403', 'Pendere Saril'),
	('1104032025', '110403', 'Sadong Juru Mudi'),
	('1104032026', '110403', 'Ulu Nuwih'),
	('1104032027', '110403', 'Colo Blang Gele'),
	('1104032028', '110403', 'Kala Kemili'),
	('1104072001', '110407', 'Arul Badak'),
	('1104072004', '110407', 'Berawang Baro'),
	('1104072008', '110407', 'Gelelungi'),
	('1104072009', '110407', 'Ie Relop'),
	('1104072010', '110407', 'Kayu Kul'),
	('1104072011', '110407', 'Kedelah'),
	('1104072012', '110407', 'Kung'),
	('1104072013', '110407', 'Kute Lintang'),
	('1104072014', '110407', 'Lelumu'),
	('1104072016', '110407', 'Paya Jeget'),
	('1104072017', '110407', 'Pedekok'),
	('1104072018', '110407', 'Pegasing'),
	('1104072019', '110407', 'Pepalang'),
	('1104072021', '110407', 'Simpang Kelaping'),
	('1104072024', '110407', 'Tebuk'),
	('1104072025', '110407', 'Terang Ulen'),
	('1104072026', '110407', 'Ujung Gele'),
	('1104072029', '110407', 'Wih Ilang'),
	('1104072030', '110407', 'Wih Nareh'),
	('1104072031', '110407', 'Wih Lah'),
	('1104072032', '110407', 'Jejem'),
	('1104072033', '110407', 'Jurusen'),
	('1104072034', '110407', 'Kala Pegasing'),
	('1104072035', '110407', 'Linung Ayu'),
	('1104072036', '110407', 'Panangan Mata'),
	('1104072037', '110407', 'Pantan Musara'),
	('1104072038', '110407', 'Wih Terjun'),
	('1104072039', '110407', 'Belang Bebangka'),
	('1104072040', '110407', 'Uning'),
	('1104072041', '110407', 'Uring'),
	('1104072042', '110407', 'Suka Damai'),
	('1104082001', '110408', 'Atu Payung'),
	('1104082002', '110408', 'Bale Nosar'),
	('1104082003', '110408', 'Bamil Nosar'),
	('1104082004', '110408', 'Bewang'),
	('1104082005', '110408', 'Dedamar'),
	('1104082006', '110408', 'Genuren'),
	('1104082007', '110408', 'Kala Bintang'),
	('1104082008', '110408', 'Kala Segi'),
	('1104082009', '110408', 'Kejurun Syiah Utama'),
	('1104082010', '110408', 'Kelitu Sintep'),
	('1104082011', '110408', 'Kuala I'),
	('1104082012', '110408', 'Kuala II'),
	('1104082013', '110408', 'Linung Bulen I'),
	('1104082014', '110408', 'Linung Bulen II'),
	('1104082015', '110408', 'Mengaya'),
	('1104082016', '110408', 'Mude Nosar'),
	('1104082017', '110408', 'Serule'),
	('1104082018', '110408', 'Wakil Jalil'),
	('1104082019', '110408', 'Wihlah Setie'),
	('1104082020', '110408', 'Gegarang'),
	('1104082021', '110408', 'Jamur Konyel'),
	('1104082022', '110408', 'Merodot'),
	('1104082023', '110408', 'Sintep'),
	('1104082024', '110408', 'Gele Pulo'),
	('1104102001', '110410', 'Bah'),
	('1104102002', '110410', 'Blang Mancung'),
	('1104102003', '110410', 'Bintang Pepara'),
	('1104102004', '110410', 'Burlah'),
	('1104102005', '110410', 'Buter'),
	('1104102006', '110410', 'Cang Duri'),
	('1104102007', '110410', 'Gelumpang Payung'),
	('1104102008', '110410', 'Jaluk'),
	('1104102009', '110410', 'Kala Ketol'),
	('1104102010', '110410', 'Karang Ampar'),
	('1104102011', '110410', 'Kekuyang'),
	('1104102012', '110410', 'Kute Gelime'),
	('1104102013', '110410', 'Pantan Penyo'),
	('1104102014', '110410', 'Pantan Reduk'),
	('1104102015', '110410', 'Pondok Balik'),
	('1104102016', '110410', 'Rejewali'),
	('1104102017', '110410', 'Serempah'),
	('1104102018', '110410', 'Bergang'),
	('1104102019', '110410', 'Blang Mancung Bawah'),
	('1104102020', '110410', 'Buge Ara'),
	('1104102021', '110410', 'Genting Bulen'),
	('1104102022', '110410', 'Jalan Tengah'),
	('1104102023', '110410', 'Jerata'),
	('1104102024', '110410', 'Simpang Juli'),
	('1104102025', '110410', 'Selon'),
	('1104112001', '110411', 'Bukit Sama'),
	('1104112002', '110411', 'Gunung Bukit'),
	('1104112003', '110411', 'Jongok Meluem'),
	('1104112004', '110411', 'Kelupak Mata'),
	('1104112005', '110411', 'Lot Kala'),
	('1104112006', '110411', 'Mendale'),
	('1104112007', '110411', 'Paya Reje Tami Dalem'),
	('1104112008', '110411', 'Paya Tumpi'),
	('1104112009', '110411', 'Pinangan'),
	('1104112010', '110411', 'Bukit'),
	('1104112011', '110411', 'Bukit Ewih Tami Delem'),
	('1104112012', '110411', 'Gunung Bahgie'),
	('1104112013', '110411', 'Gunung Balohen'),
	('1104112014', '110411', 'Jongkok Bathin'),
	('1104112015', '110411', 'Kala Lengkio'),
	('1104112016', '110411', 'Kute Lot'),
	('1104112017', '110411', 'Paya Tumpi Baru'),
	('1104112018', '110411', 'Paya Tumpi I'),
	('1104112019', '110411', 'Timangan Gading'),
	('1104112020', '110411', 'Telege Atu'),
	('1104122001', '110412', 'Atu Gogop'),
	('1104122002', '110412', 'Balik'),
	('1104122003', '110412', 'Buter Balik'),
	('1104122004', '110412', 'Dedingin'),
	('1104122005', '110412', 'Kute Panang'),
	('1104122006', '110412', 'Lukub Sabun'),
	('1104122007', '110412', 'Pantan Sile'),
	('1104122008', '110412', 'Ratawali'),
	('1104122009', '110412', 'Segene Balik'),
	('1104122010', '110412', 'Tapak Moge'),
	('1104122011', '110412', 'Tawar Miko'),
	('1104122012', '110412', 'Tawardi'),
	('1104122013', '110412', 'Timang Rasa'),
	('1104122014', '110412', 'Wih Nongkal'),
	('1104122015', '110412', 'Bukit Rata'),
	('1104122016', '110412', 'Lukub Sabun Barat'),
	('1104122017', '110412', 'Lukub Sabun Tengah'),
	('1104122018', '110412', 'Lukub Sabun Timur'),
	('1104122019', '110412', 'Wih Nongkal Toa'),
	('1104122020', '110412', 'Tapak Moge Timur'),
	('1104122021', '110412', 'Empu Balik'),
	('1104122022', '110412', 'Blang Balik'),
	('1104122023', '110412', 'Kala Nongkal'),
	('1104122024', '110412', 'Pantan Jerik'),
	('1104132001', '110413', 'Arul Gading'),
	('1104132002', '110413', 'Belang Kekumur'),
	('1104132003', '110413', 'Berawang Gading'),
	('1104132004', '110413', 'Celala'),
	('1104132005', '110413', 'Cibro'),
	('1104132006', '110413', 'Kuyun'),
	('1104132007', '110413', 'Kuyun Toa'),
	('1104132008', '110413', 'Kuyun Uken'),
	('1104132009', '110413', 'Makmur'),
	('1104132010', '110413', 'Melala'),
	('1104132011', '110413', 'Paya Kolak'),
	('1104132012', '110413', 'Ramung Ara'),
	('1104132013', '110413', 'Sepakat'),
	('1104132014', '110413', 'Tanoh Depet'),
	('1104132015', '110413', 'Uning Berawang Ramung'),
	('1104132016', '110413', 'Blang Delem'),
	('1104132017', '110413', 'Depet Indah'),
	('1104172001', '110417', 'Takengon Timur'),
	('1104172002', '110417', 'Asir Asir'),
	('1104172003', '110417', 'Asir Asir Asia'),
	('1104172004', '110417', 'Bale Atu'),
	('1104172005', '110417', 'Bujang'),
	('1104172006', '110417', 'Gunung Suku'),
	('1104172007', '110417', 'Hakim Bale Bujang'),
	('1104172008', '110417', 'Kenawat'),
	('1104172009', '110417', 'Kuteni Reje'),
	('1104172010', '110417', 'Pedemun One One'),
	('1104172011', '110417', 'Rawe'),
	('1104172012', '110417', 'Takengon Barat'),
	('1104172013', '110417', 'Toweren Antara'),
	('1104172014', '110417', 'Toweren Toa'),
	('1104172015', '110417', 'Toweren Uken'),
	('1104172016', '110417', 'Teluk One-One'),
	('1104172017', '110417', 'Merah Mersa'),
	('1104172018', '110417', 'Waq Toweren'),
	('1104182001', '110418', 'Atu Lintang'),
	('1104182002', '110418', 'Merah Mege'),
	('1104182003', '110418', 'Merah Pupuk'),
	('1104182004', '110418', 'Merah Muyang'),
	('1104182005', '110418', 'Gayo Murni'),
	('1104182006', '110418', 'Kepala Akal'),
	('1104182007', '110418', 'Tanoh Abu'),
	('1104182008', '110418', 'Bintang Kekelip'),
	('1104182009', '110418', 'Merah Jernang'),
	('1104182010', '110418', 'Damar Mulyo'),
	('1104182011', '110418', 'Pantan Damar'),
	('1104192001', '110419', 'Merah Said'),
	('1104192002', '110419', 'Berawang Dewal'),
	('1104192003', '110419', 'Gegarang'),
	('1104192004', '110419', 'Telege Sari'),
	('1104192005', '110419', 'Jeget Ayu'),
	('1104192006', '110419', 'Paya Tungel'),
	('1104192007', '110419', 'Jagong Jeget'),
	('1104192008', '110419', 'Bukit Sari'),
	('1104192009', '110419', 'Bukit Kemuning'),
	('1104192010', '110419', 'Paya Dedep'),
	('1104202001', '110420', 'Bies Penentanan'),
	('1104202002', '110420', 'Bies Baru'),
	('1104202003', '110420', 'Bies Mulie'),
	('1104202004', '110420', 'Arul Latong'),
	('1104202005', '110420', 'Simpang Lukup Badak'),
	('1104202006', '110420', 'Atang Jungket'),
	('1104202007', '110420', 'Tebes Lues'),
	('1104202008', '110420', 'Pucuk Deku'),
	('1104202009', '110420', 'Lenga'),
	('1104202010', '110420', 'Uning Pegantungen'),
	('1104202011', '110420', 'Simpang Uning Niken'),
	('1104202012', '110420', 'Karang Bayur'),
	('1104212001', '110421', 'Pantan Tengah'),
	('1104212002', '110421', 'Rusip'),
	('1104212003', '110421', 'Pilar'),
	('1104212004', '110421', 'Arul Pertik'),
	('1104212005', '110421', 'Pilar Jaya'),
	('1104212006', '110421', 'Tirmi Ara'),
	('1104212007', '110421', 'Atu Singkih'),
	('1104212008', '110421', 'Pantan Bener'),
	('1104212009', '110421', 'Kerawang'),
	('1104212010', '110421', 'Mekar Maju'),
	('1104212011', '110421', 'Paya Tampu'),
	('1104212012', '110421', 'Tanjung'),
	('1104212013', '110421', 'Merandeh Paya'),
	('1104212014', '110421', 'Kuala Rawa'),
	('1104212015', '110421', 'Pilar Wih Kiri'),
	('1104212016', '110421', 'Lut Jaya');

-- Dumping structure for table zakat.table_dokumentasi
DROP TABLE IF EXISTS `table_dokumentasi`;
CREATE TABLE IF NOT EXISTS `table_dokumentasi` (
  `id_dokumentasi` int NOT NULL AUTO_INCREMENT,
  `id_bantuan` int NOT NULL,
  `dokumentasi` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_dokumentasi`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- Dumping structure for table zakat.table_kecamatan
DROP TABLE IF EXISTS `table_kecamatan`;
CREATE TABLE IF NOT EXISTS `table_kecamatan` (
  `id` char(50) DEFAULT NULL,
  `nama_kecamatan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table zakat.table_kecamatan: ~14 rows (approximately)
INSERT INTO `table_kecamatan` (`id`, `nama_kecamatan`) VALUES
	('110401', 'Linge'),
	('110402', 'Silih Nara'),
	('110403', 'Bebesen'),
	('110407', 'Pegasing'),
	('110408', 'Bintang'),
	('110410', 'Ketol'),
	('110411', 'Kebayakan'),
	('110412', 'Kute Panang'),
	('110413', 'Celala'),
	('110417', 'Laut Tawar'),
	('110418', 'Atu Lintang'),
	('110419', 'Jagong Jeget'),
	('110420', 'Bies'),
	('110421', 'Rusip Antara');

-- Dumping structure for table zakat.table_setting
DROP TABLE IF EXISTS `table_setting`;
CREATE TABLE IF NOT EXISTS `table_setting` (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `jenis_setting` varchar(255) NOT NULL,
  `value_setting` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table zakat.table_setting: ~1 rows (approximately)
INSERT INTO `table_setting` (`id_setting`, `jenis_setting`, `value_setting`, `created_at`, `updated_at`) VALUES
	(1, 'penerima', '[{"peruntukan":"Fakir","persentase":10,"total_dana":1961018000},{"peruntukan":"Miskin","persentase":30,"total_dana":5883054000},{"peruntukan":"Amil","persentase":12,"total_dana":2353221600},{"peruntukan":"Riqab","persentase":5,"total_dana":980509000},{"peruntukan":"Gharim","persentase":12,"total_dana":2353221600},{"peruntukan":"Fisabilillah","persentase":15,"total_dana":2941527000},{"peruntukan":"Ibnu_Sabil","persentase":15,"total_dana":2941527000},{"peruntukan":"Mualaf","persentase":1,"total_dana":196101800}]', '0000-00-00 00:00:00', NULL);

-- Dumping structure for table zakat.table_user
DROP TABLE IF EXISTS `table_user`;
CREATE TABLE IF NOT EXISTS `table_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table zakat.table_user: ~1 rows (approximately)
INSERT INTO `table_user` (`id`, `nama`, `email`, `password`, `role`, `last_login`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', '2024-09-07 17:23:41', '2024-09-07 17:23:41', NULL);

-- Dumping structure for table zakat.table_zakat
DROP TABLE IF EXISTS `table_zakat`;
CREATE TABLE IF NOT EXISTS `table_zakat` (
  `id_zakat` int NOT NULL AUTO_INCREMENT,
  `keterangan` text NOT NULL,
  `status` varchar(5) NOT NULL,
  `total` bigint NOT NULL,
  `saldo_akhir` bigint NOT NULL,
  `tanggal_transaksi` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_zakat`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
