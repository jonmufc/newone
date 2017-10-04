-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2017 at 08:22 AM
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
  `cate_status` int(11) DEFAULT NULL,
  `prim_cate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `cate_ref_code`, `cate_name`, `cate_status`, `prim_cate_id`) VALUES
(3, 'C003', 'ควบคุมคุณภาพถ่าน', 1, 0),
(4, 'C004', '[P-1] ควบคุมคุณภาพถ่านให้ได้มาตรฐานเพื่อจัดส่งโรงไฟฟ้าแม่เมาะ', 1, 3),
(5, 'C005', '[P-2] วิธีควบคุม', 1, 3),
(6, 'C006', '[P-3] วิธีผสมถ่าน', 1, 3),
(7, 'C007', '[P-4] วิธีผสมถ่านโดยศูนย์ควบคุม CCC', 1, 3),
(8, 'C008', '[P-5] จัดส่งถ่านจากลานกองถ่านไปยังโรงไฟฟ้าแม่เมาะ', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `profile_image`
--

CREATE TABLE `profile_image` (
  `pf_id` int(11) NOT NULL,
  `pf_file_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile_image`
--

INSERT INTO `profile_image` (`pf_id`, `pf_file_name`) VALUES
(1, 'บัตรตัวแทน_171002_0052.jpg'),
(2, 'บัตรตัวแทน_171002_0052.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `ReplyID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `QuestionID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `CreateDate` datetime NOT NULL,
  `Details` text NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`ReplyID`, `QuestionID`, `CreateDate`, `Details`, `Name`) VALUES
(00003, 00002, '2017-09-21 00:05:13', 'test', 'Khunponpun Thongaroon'),
(00004, 00002, '2017-09-21 00:05:17', 'test', 'Khunponpun Thongaroon');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file_doc`
--

CREATE TABLE `tbl_file_doc` (
  `fd_id` int(11) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `folder_name` varchar(500) NOT NULL,
  `file_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_file_doc`
--

INSERT INTO `tbl_file_doc` (`fd_id`, `file_name`, `full_name`, `folder_name`, `file_type`) VALUES
(6, 'Task.pdf', 'Task.pdf', 'e1d1bb82-fc19-428c-b3ef-feac8789a04f', 2),
(7, 'Inference Knowledge 11_ควบคุมคุณภาพถ่านให้ได้มาตรฐานเพื่อจัดส่ง รฟฟ.pdf', 'Inference Knowledge 11_ควบคุมคุณภาพถ่านให้ได้มาตรฐานเพื่อจัดส่ง รฟฟ.pdf', 'c75dc161-8e1d-4f65-bfc2-55c5890ce723', 2),
(8, 'Domain Knowledge 111_ค่าคุณภาพถ่านที่ต้องควบคุมเพื่อจัดส่งให้โรงไฟฟ้าแม่เมาะ หน่วยที่ 4-7 และ หน่วยที่ 8-13.pdf', 'Domain Knowledge 111_ค่าคุณภาพถ่านที่ต้องควบคุมเพื่อจัดส่งให้โรงไฟฟ้าแม่เมาะ หน่วยที่ 4-7 และ หน่วยที่ 8-13.pdf', '', 2),
(9, 'Inference Knowledge 12_วิธีควบคุม.pdf', 'Inference Knowledge 12_วิธีควบคุม.pdf', '562bfa75-1134-47af-aeee-5fda77285f58', 2),
(10, 'Domain Knowledge 121_วิธีควบคุม.pdf', 'Domain Knowledge 121_วิธีควบคุม.pdf', '4d0952a9-1cbd-41d6-a91d-ce32f031a16c', 2),
(11, 'Inference Knowledge 13_วิธีผสมถ่าน.pdf', 'Inference Knowledge 13_วิธีผสมถ่าน.pdf', '939a5fad-6686-44e4-af4f-b58a04993c8f', 2),
(12, 'Domian Knowledge 131_วิธีผสมถ่าน.pdf', 'Domian Knowledge 131_วิธีผสมถ่าน.pdf', 'd50277f6-d9d2-4fcc-8b91-1b8bbbaca32a', 2),
(13, 'Domain Knowledge 142_วิธีผสมถ่านโดยศูนย์ควบคุม CCC  กรณีค่าคุณภาพไม่เป็นไปตามกำหนด.pdf', 'Domain Knowledge 142_วิธีผสมถ่านโดยศูนย์ควบคุม CCC  กรณีค่าคุณภาพไม่เป็นไปตามกำหนด.pdf', '', 2),
(14, 'Domain Knowledge 141_วิธีผสมถ่านโดยศูนย์ควบคุม CCC  กรณีค่าคุณภาพเป็นไปตามกำหนด.pdf', 'Domain Knowledge 141_วิธีผสมถ่านโดยศูนย์ควบคุม CCC  กรณีค่าคุณภาพเป็นไปตามกำหนด.pdf', '', 2),
(15, 'Inference Knowledge 14_วิธีผสมถ่านโดย CCC.pdf', 'Inference Knowledge 14_วิธีผสมถ่านโดย CCC.pdf', '063a55fd-586c-4555-8c68-ec131c1e7b7c', 2),
(18, 'Domain Knowledge 141.pdf', 'Domain Knowledge 141.pdf', '07753936-642d-4e38-9676-0a3b23708319', 2),
(19, 'Domain Knowledge 142.pdf', 'Domain Knowledge 142.pdf', 'b1f9134c-834b-45a9-9032-8155ce1b1ac7', 2),
(20, 'Inference Knowledge 15_จัดส่งถ่านจากลานกองถ่านไปยังโรงไฟฟ้า.pdf', 'Inference Knowledge 15_จัดส่งถ่านจากลานกองถ่านไปยังโรงไฟฟ้า.pdf', '7875c4ad-9ace-4b91-804c-17946e8fa16b', 2),
(21, 'Domian Knowledge 151_จัดส่งถ่านจากลานกองถ่านไปยังโรงไฟฟ้า.pdf', 'Domian Knowledge 151_จัดส่งถ่านจากลานกองถ่านไปยังโรงไฟฟ้า.pdf', 'acb6f145-bea0-429f-b60d-2c6e40095951', 2),
(24, 'c700x420.jpg', 'c700x420.jpgxxxx', 'fdab468c-28e1-4d73-9297-a5ab13e24c1b', 1);

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
(16, 4, 3),
(17, 5, 6),
(19, 6, 7),
(20, 7, 8),
(22, 8, 10),
(23, 8, 9),
(24, 9, 12),
(25, 9, 11),
(26, 10, 19),
(27, 10, 18),
(28, 10, 15),
(29, 11, 21),
(30, 11, 20);

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
(2, 'test1', '&lt;p&gt;test&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;test1&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;color: #333399;&quot;&gt;&lt;strong&gt;test2&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;', 'test1', '2017-09-12 13:10:42', NULL, 2, 0, '2017-09-12 14:30:09'),
(3, 'test', '&lt;p&gt;test&lt;/p&gt;', 'test', '2017-09-12 14:35:20', NULL, 1, 0, NULL),
(4, 'test', '&lt;p&gt;test&lt;/p&gt;', 'test', '2017-09-12 14:36:25', NULL, 1, 0, NULL),
(5, 'ควบคุมคุณภาพถ่านและจัดส่งถ่านจากลานกองถ่านไปยังโรงไฟฟ้าแม่เมาะให้ได้ปริมาณและคุณภาพตามที่โรงไฟฟ้ากำหนด', '&lt;p&gt;&lt;img src=&quot;../lib/source/Task.jpg?1506053329270&quot; alt=&quot;Task&quot; width=&quot;709&quot; height=&quot;502&quot; /&gt;&lt;/p&gt;\r\n&lt;p&gt;ควบคุมคุณภาพถ่านและจัดส่งถ่านจากลานกองถ่านไปยังโรงไฟฟ้าแม่เมาะให้ได้ปริมาณและคุณภาพตามที่โรงไฟฟ้ากำหนด&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;&lt;a href=&quot;../post.php?p=6&quot; target=&quot;_blank&quot; rel=&quot;noopener&quot;&gt;[P-1] ควบคุมคุณภาพถ่านให้ได้มาตรฐานเพื่อจัดส่งโรงไฟฟ้าแม่เมาะ&lt;/a&gt;&lt;/li&gt;\r\n&lt;li&gt;&lt;a href=&quot;../post.php?p=8&quot;&gt;[P-2] วิธีควบคุม&lt;/a&gt;&lt;/li&gt;\r\n&lt;li&gt;&lt;a href=&quot;../post.php?p=9&quot;&gt;[P-2] วิธีผสมถ่าน&lt;/a&gt;&lt;/li&gt;\r\n&lt;li&gt;&lt;a href=&quot;../post.php?p=10&quot;&gt;[P-2] วิธีผสมถ่านโดยศูนย์ควบคุม CCC&lt;/a&gt;&lt;/li&gt;\r\n&lt;li&gt;&lt;a href=&quot;../post.php?p=11&quot;&gt;[P-2] จัดส่งถ่านจากลานกองถ่านไปยังโรงไฟฟ้าแม่เมาะ&lt;/a&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', 'Admin', '2017-09-22 11:11:31', NULL, 3, 1, '2017-09-22 14:46:05'),
(6, 'ควบคุมคุณภาพถ่านให้ได้มาตรฐานเพื่อจัดส่งโรงไฟฟ้าแม่เมาะ', '&lt;p&gt;&lt;a href=&quot;../lib/source/Inference%20Knowledge%2011.jpg&quot;&gt;&lt;img src=&quot;../lib/source/Inference%20Knowledge%2011.jpg?1506061987667&quot; alt=&quot;Inference Knowledge 11&quot; width=&quot;733&quot; height=&quot;518&quot; /&gt;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;ควบคุมคุณภาพถ่านให้ได้มาตรฐานเพื่อจัดส่งโรงไฟฟ้าแม่เมาะ&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;ค่าคุณภาพถ่านตามข้อกำหนดสำหรับโรงไฟฟ้า หน่วยที่ 4-7&lt;/li&gt;\r\n&lt;li&gt;ค่าคุณภาพถ่านตามข้อกำหนดสำหรับโรงไฟฟ้า หน่วยที่ 8-13&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;&lt;a href=&quot;../lib/source/Domain%20Knowledge%20111-4-7_Page_1.jpg&quot;&gt;&lt;img src=&quot;../lib/source/Domain%20Knowledge%20111-4-7_Page_1.jpg?1506066165521&quot; alt=&quot;Domain Knowledge 111-4-7_Page_1&quot; width=&quot;791&quot; height=&quot;554&quot; /&gt;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;a href=&quot;../lib/source/Domain%20Knowledge%20111-8-13_Page_2.jpg&quot;&gt;&lt;img src=&quot;../lib/source/Domain%20Knowledge%20111-8-13_Page_2.jpg?1506066186322&quot; alt=&quot;Domain Knowledge 111-8-13_Page_2&quot; width=&quot;791&quot; height=&quot;554&quot; /&gt;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'Admin', '2017-09-22 13:34:32', NULL, 4, 1, '2017-09-22 14:43:53'),
(7, 'ค่าคุณภาพถ่านตามข้อกำหนดสำหรับโรงไฟฟ้าหน่วยที่ 4-7 และหน่วยที่ 8-13', '&lt;p&gt;&lt;a href=&quot;../lib/source/Domain%20Knowledge%20111-4-7_Page_1.jpg&quot;&gt;&lt;img src=&quot;../lib/source/Domain%20Knowledge%20111-4-7_Page_1.jpg?1506062836589&quot; alt=&quot;Domain Knowledge 111-4-7_Page_1&quot; width=&quot;791&quot; height=&quot;554&quot; /&gt;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;a href=&quot;../lib/source/Domain%20Knowledge%20111-8-13_Page_2.jpg&quot;&gt;&lt;img src=&quot;../lib/source/Domain%20Knowledge%20111-8-13_Page_2.jpg?1506062853348&quot; alt=&quot;Domain Knowledge 111-8-13_Page_2&quot; width=&quot;787&quot; height=&quot;551&quot; /&gt;&lt;/a&gt;&lt;/p&gt;', 'Admin', '2017-09-22 13:46:24', NULL, 4, 0, '2017-09-22 13:49:27'),
(8, 'วิธีควบคุม', '&lt;p&gt;&lt;img src=&quot;../lib/source/Inference%20Knowledge%2012.jpg?1506063326555&quot; alt=&quot;Inference Knowledge 12&quot; width=&quot;787&quot; height=&quot;556&quot; /&gt;&lt;/p&gt;\r\n&lt;p&gt;[P-2] วิธีควบคุม&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;ควบคุมที่หน้างานถ่าน&lt;/li&gt;\r\n&lt;li&gt;ควบคุมที่ลานกองถ่าน&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;img src=&quot;../lib/source/Domain%20Knowledge%20121__Page_1.jpg?1506063700525&quot; alt=&quot;Domain Knowledge 121__Page_1&quot; width=&quot;783&quot; height=&quot;554&quot; /&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;img src=&quot;../lib/source/Domain%20Knowledge%20121__Page_2.jpg?1506063723820&quot; alt=&quot;Domain Knowledge 121__Page_2&quot; width=&quot;764&quot; height=&quot;540&quot; /&gt;&lt;/p&gt;', 'Admin', '2017-09-22 13:56:15', NULL, 5, 1, '2017-09-22 14:02:23'),
(9, 'วิธีผสมถ่าน', '&lt;p&gt;&lt;a href=&quot;../lib/source/13/Inference%20Knowledge%2013.jpg&quot;&gt;&lt;img src=&quot;../lib/source/13/Inference%20Knowledge%2013.jpg?1506064033941&quot; alt=&quot;Inference Knowledge 13&quot; width=&quot;789&quot; height=&quot;558&quot; /&gt;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;[P-3] วิธีผสมถ่าน&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;ผสมที่เครื่องโม่ถ่านในบ่อเหมือง (Crusher Blending)&lt;/li&gt;\r\n&lt;li&gt;ผสมที่เครื่องโปรยถ่านในลานกองถ่าน (Stockpile Blending)&lt;/li&gt;\r\n&lt;li&gt;ผสมบนสายพานลำเลียง (Conveyor Blending)&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;&lt;a href=&quot;../lib/source/13/Domian%20Knowledge%20131_Page_1.jpg&quot;&gt;&lt;img src=&quot;../lib/source/13/Domian%20Knowledge%20131_Page_1.jpg?1506064178891&quot; alt=&quot;Domian Knowledge 131_Page_1&quot; width=&quot;763&quot; height=&quot;534&quot; /&gt;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;a href=&quot;../lib/source/13/Domian%20Knowledge%20131_Page_2.jpg&quot;&gt;&lt;img src=&quot;../lib/source/13/Domian%20Knowledge%20131_Page_2.jpg?1506064224411&quot; alt=&quot;Domian Knowledge 131_Page_2&quot; width=&quot;789&quot; height=&quot;552&quot; /&gt;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;a href=&quot;../lib/source/13/Domian%20Knowledge%20131_Page_3.jpg&quot;&gt;&lt;img src=&quot;../lib/source/13/Domian%20Knowledge%20131_Page_3.jpg?1506064247931&quot; alt=&quot;Domian Knowledge 131_Page_3&quot; width=&quot;787&quot; height=&quot;551&quot; /&gt;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'Admin', '2017-09-22 14:11:17', NULL, 6, 1, NULL),
(10, 'วิธีผสมถ่านโดยศูนย์ควบคุม CCC', '&lt;p&gt;&lt;a href=&quot;../lib/source/14/Inference%20Knowledge%2014.jpg&quot;&gt;&lt;img src=&quot;../lib/source/14/Inference%20Knowledge%2014.jpg?1506065340562&quot; alt=&quot;Inference Knowledge 14&quot; width=&quot;792&quot; height=&quot;559&quot; /&gt;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;วิธีผสมถ่านโดยศูนย์ควบคุม CCC&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;วิธีผสมถ่าน โดยศูนย์ควบคุม CCC กรณีค่าคุณภาพถ่านที่มีอยู่ เป็นไปตามที่กำหนด&lt;/li&gt;\r\n&lt;li&gt;วิธีผสมถ่าน โดยศูนย์ควบคุม CCC กรณีค่าคุณภาพถ่านที่มีอยู่ ไม่เป็นไปตามที่กำหนด&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;&lt;a href=&quot;../lib/source/14/Domain%20Knowledge%20141-Page1.jpg&quot;&gt;&lt;img src=&quot;../lib/source/14/Domain%20Knowledge%20141-Page1.jpg?1506065481330&quot; alt=&quot;Domain Knowledge 141-Page1&quot; width=&quot;782&quot; height=&quot;548&quot; /&gt;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;img src=&quot;../lib/source/14/Domain%20Knowledge%20142-Page2.jpg?1506065518842&quot; alt=&quot;Domain Knowledge 142-Page2&quot; width=&quot;780&quot; height=&quot;811&quot; /&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'Admin', '2017-09-22 14:32:09', NULL, 7, 1, NULL),
(11, 'จัดส่งถ่านจากลานกองถ่านไปยังโรงไฟฟ้าแม่เมาะ', '&lt;p&gt;&lt;a href=&quot;../lib/source/15/Inference%20Knowledge%2015.jpg&quot;&gt;&lt;img src=&quot;../lib/source/15/Inference%20Knowledge%2015.jpg?1506065787713&quot; alt=&quot;Inference Knowledge 15&quot; width=&quot;788&quot; height=&quot;557&quot; /&gt;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;[P-5] จัดส่งถ่านจากลานกองถ่านไปยังโรงไฟฟ้าแม่เมาะ&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;คุณภาพถ่านในลานกองถ่านก่อนดำเนินการส่งโรงไฟฟ้า&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;&lt;a href=&quot;../lib/source/15/Domian%20Knowledge%20151.jpg&quot;&gt;&lt;img src=&quot;../lib/source/15/Domian%20Knowledge%20151.jpg?1506065926520&quot; alt=&quot;Domian Knowledge 151&quot; width=&quot;777&quot; height=&quot;544&quot; /&gt;&lt;/a&gt;&lt;/p&gt;', 'Admin', '2017-09-22 14:39:20', NULL, 8, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `empn` int(10) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `user_tel` varchar(10) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_pic` varchar(100) NOT NULL,
  `user_dept` varchar(100) NOT NULL,
  `record_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`empn`, `fullname`, `user_tel`, `user_password`, `user_pic`, `user_dept`, `record_date`) VALUES
(0, 'test', 'test', 'test', '1.jpg', 'test', '2017-10-04 22:20:53'),
(593403, 'ขุนพลพัน ทองอรุณ', '4839', '018762697', '2.jpg', 'ชชม.', '2017-10-04 22:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `webboard`
--

CREATE TABLE `webboard` (
  `QuestionID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `CreateDate` datetime NOT NULL,
  `Question` varchar(255) NOT NULL,
  `Details` text NOT NULL,
  `Name` varchar(50) NOT NULL,
  `View` int(5) NOT NULL,
  `Reply` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `webboard`
--

INSERT INTO `webboard` (`QuestionID`, `CreateDate`, `Question`, `Details`, `Name`, `View`, `Reply`) VALUES
(00002, '2017-09-21 00:05:04', 'test', 'test', 'Khunponpun Thongaroon', 3, 2);

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
-- Indexes for table `profile_image`
--
ALTER TABLE `profile_image`
  ADD PRIMARY KEY (`pf_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`ReplyID`);

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
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`empn`);

--
-- Indexes for table `webboard`
--
ALTER TABLE `webboard`
  ADD PRIMARY KEY (`QuestionID`);

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
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `profile_image`
--
ALTER TABLE `profile_image`
  MODIFY `pf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `ReplyID` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_file_doc`
--
ALTER TABLE `tbl_file_doc`
  MODIFY `fd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_group_doc`
--
ALTER TABLE `tbl_group_doc`
  MODIFY `gd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `webboard`
--
ALTER TABLE `webboard`
  MODIFY `QuestionID` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
