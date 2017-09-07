-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2017 at 07:08 AM
-- Server version: 5.6.36
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file_doc`
--

CREATE TABLE `tbl_file_doc` (
  `fd_id` int(11) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `folder_name` varchar(500) NOT NULL,
  `file_size` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_file_doc`
--

INSERT INTO `tbl_file_doc` (`fd_id`, `file_name`, `full_name`, `folder_name`, `file_size`) VALUES
(1, 'Yoga-for-Weight-Loss-with-Yoga.jpg', 'Yoga-for-Weight-Loss-with-Yoga.jpg', 'f0aa7fda-1203-4b9c-a070-85b45e007477', ''),
(2, 'Does-Yoga-Work-for-Weight-Loss-header-760x380.jpg', 'Does-Yoga-Work-for-Weight-Loss-header-760x380.jpg', '64583622-615e-4dbb-b257-08fff13d21a6', ''),
(3, 'แนะนำสกิล Joker.png', 'แนะนำสกิล Joker.png', 'fcb4accf-6fbc-467d-a60f-7cb0a71573a1', ''),
(4, 'แนะนำสกิล Joker.png', 'แนะนำสกิล Joker.png', 'f96a6eda-d389-4aa9-aefb-e862e20cf965', ''),
(5, '14963402_1005043969605852_4405958642409336961_n-1.jpg', 'yyyyyyyyyyปxผzzxxx', '2326aaf4-18fb-4824-8fd1-5d052ca00691', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_file_doc`
--
ALTER TABLE `tbl_file_doc`
  ADD PRIMARY KEY (`fd_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_file_doc`
--
ALTER TABLE `tbl_file_doc`
  MODIFY `fd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
