-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 20, 2017 at 08:11 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ad_id` int(11) NOT NULL,
  `ad_user_code` varchar(100) DEFAULT NULL,
  `ad_username` varchar(100) DEFAULT NULL,
  `ad_password` varchar(100) DEFAULT NULL,
  `ad_mail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ad_id`, `ad_user_code`, `ad_username`, `ad_password`, `ad_mail`) VALUES
(1, 'A001', 'admin', '1234', 'jonmufc@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL,
  `cate_ref_code` varchar(10) DEFAULT NULL,
  `cate_name` varchar(200) DEFAULT NULL,
  `cate_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `cate_ref_code`, `cate_name`, `cate_status`) VALUES
(1, 'C001', 'องค์ความรู้ผู้เกษียณ', 1),
(2, 'C002', 'องค์ความรู้ผู้ปฏิบัติงาน', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_doc`
--

CREATE TABLE `tbl_group_doc` (
  `gd_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `fd_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_group_doc`
--

INSERT INTO `tbl_group_doc` (`gd_id`, `post_id`, `fd_id`) VALUES
(11, 2, 5),
(12, 2, 4),
(13, 2, 3),
(14, 2, 1),
(15, 3, 3),
(16, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `post_id` int(11) NOT NULL,
  `post_name` varchar(300) DEFAULT NULL,
  `post_desc` varchar(5000) DEFAULT NULL,
  `post_owner` varchar(100) DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `post_gd_id` int(11) DEFAULT NULL,
  `post_cate_id` int(11) DEFAULT NULL,
  `post_status` int(11) DEFAULT NULL,
  `post_update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`post_id`, `post_name`, `post_desc`, `post_owner`, `post_date`, `post_gd_id`, `post_cate_id`, `post_status`, `post_update_date`) VALUES
(2, 'test1', '&lt;p&gt;test&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;test1&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;color: #333399;&quot;&gt;&lt;strong&gt;test2&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;', 'test1', '2017-09-12 13:10:42', NULL, 2, 1, '2017-09-12 14:30:09'),
(3, 'test', '&lt;p&gt;test&lt;/p&gt;', 'test', '2017-09-12 14:35:20', NULL, 1, 1, NULL),
(4, 'test', '&lt;p&gt;test&lt;/p&gt;', 'test', '2017-09-12 14:36:25', NULL, 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `tbl_file_doc`
--
ALTER TABLE `tbl_file_doc`
  ADD PRIMARY KEY (`fd_id`);

--
-- Indexes for table `tbl_group_doc`
--
ALTER TABLE `tbl_group_doc`
  ADD PRIMARY KEY (`gd_id`);

--
-- Indexes for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_file_doc`
--
ALTER TABLE `tbl_file_doc`
  MODIFY `fd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_group_doc`
--
ALTER TABLE `tbl_group_doc`
  MODIFY `gd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
