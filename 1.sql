-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.36 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table db_kmss.admin: ~0 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`ad_id`, `ad_user_code`, `ad_username`, `ad_password`) VALUES
	(1, 'A001', 'jonmufc', 18762697);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping data for table db_kmss.category: ~1 rows (approximately)
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`cate_id`, `cate_ref_code`, `cate_name`, `cate_status`) VALUES
	(1, 'C001', 'องค์ความรู้ผู้เกษียณ', 1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping data for table db_kmss.tbl_file_doc: ~4 rows (approximately)
DELETE FROM `tbl_file_doc`;
/*!40000 ALTER TABLE `tbl_file_doc` DISABLE KEYS */;
INSERT INTO `tbl_file_doc` (`fd_id`, `file_name`, `full_name`, `folder_name`, `file_size`) VALUES
	(1, 'Yoga-for-Weight-Loss-with-Yoga.jpg', 'Yoga-for-Weight-Loss-with-Yoga.jpg', 'f0aa7fda-1203-4b9c-a070-85b45e007477', ''),
	(2, 'Does-Yoga-Work-for-Weight-Loss-header-760x380.jpg', 'Does-Yoga-Work-for-Weight-Loss-header-760x380.jpg', '64583622-615e-4dbb-b257-08fff13d21a6', ''),
	(3, 'แนะนำสกิล Joker.png', 'แนะนำสกิล Joker.png', 'fcb4accf-6fbc-467d-a60f-7cb0a71573a1', ''),
	(4, 'แนะนำสกิล Joker.png', 'แนะนำสกิล Joker.png', 'f96a6eda-d389-4aa9-aefb-e862e20cf965', ''),
	(5, '14963402_1005043969605852_4405958642409336961_n-1.jpg', 'yyyyyyyyyyปxผzzxxx', '2326aaf4-18fb-4824-8fd1-5d052ca00691', '');
/*!40000 ALTER TABLE `tbl_file_doc` ENABLE KEYS */;

-- Dumping data for table db_kmss.tbl_posts: ~0 rows (approximately)
DELETE FROM `tbl_posts`;
/*!40000 ALTER TABLE `tbl_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_posts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
