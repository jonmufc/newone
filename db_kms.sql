/*
SQLyog Ultimate v8.55 
MySQL - 5.6.35 : Database - db_kms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_kms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_kms`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_user_code` varchar(100) DEFAULT NULL,
  `ad_username` varchar(100) DEFAULT NULL,
  `ad_password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `admin` */

insert  into `admin`(`ad_id`,`ad_user_code`,`ad_username`,`ad_password`) values (1,'A001','admin','1234');

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_ref_code` varchar(10) DEFAULT NULL,
  `cate_name` varchar(200) DEFAULT NULL,
  `cate_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `category` */

insert  into `category`(`cate_id`,`cate_ref_code`,`cate_name`,`cate_status`) values (1,'C001','องค์ความรู้ผู้เกษียณ',1),(2,'C002','องค์ความรู้ผู้ปฏิบัติงาน',1);

/*Table structure for table `tbl_file_doc` */

DROP TABLE IF EXISTS `tbl_file_doc`;

CREATE TABLE `tbl_file_doc` (
  `fd_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(500) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `folder_name` varchar(500) NOT NULL,
  `file_size` varchar(20) NOT NULL,
  PRIMARY KEY (`fd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_file_doc` */

insert  into `tbl_file_doc`(`fd_id`,`file_name`,`full_name`,`folder_name`,`file_size`) values (1,'Yoga-for-Weight-Loss-with-Yoga.jpg','Yoga-for-Weight-Loss-with-Yoga.jpg','f0aa7fda-1203-4b9c-a070-85b45e007477',''),(2,'Does-Yoga-Work-for-Weight-Loss-header-760x380.jpg','Does-Yoga-Work-for-Weight-Loss-header-760x380.jpg','64583622-615e-4dbb-b257-08fff13d21a6',''),(3,'แนะนำสกิล Joker.png','แนะนำสกิล Joker.png','fcb4accf-6fbc-467d-a60f-7cb0a71573a1',''),(4,'แนะนำสกิล Joker.png','แนะนำสกิล Joker.png','f96a6eda-d389-4aa9-aefb-e862e20cf965',''),(5,'14963402_1005043969605852_4405958642409336961_n-1.jpg','yyyyyyyyyyปxผzzxxx','2326aaf4-18fb-4824-8fd1-5d052ca00691','');

/*Table structure for table `tbl_group_doc` */

DROP TABLE IF EXISTS `tbl_group_doc`;

CREATE TABLE `tbl_group_doc` (
  `gd_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `fd_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`gd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_group_doc` */

insert  into `tbl_group_doc`(`gd_id`,`post_id`,`fd_id`) values (11,2,5),(12,2,4),(13,2,3),(14,2,1),(15,3,3),(16,4,3);

/*Table structure for table `tbl_posts` */

DROP TABLE IF EXISTS `tbl_posts`;

CREATE TABLE `tbl_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(300) DEFAULT NULL,
  `post_desc` varchar(5000) DEFAULT NULL,
  `post_owner` varchar(100) DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `post_gd_id` int(11) DEFAULT NULL,
  `post_cate_id` int(11) DEFAULT NULL,
  `post_status` int(11) DEFAULT NULL,
  `post_update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_posts` */

insert  into `tbl_posts`(`post_id`,`post_name`,`post_desc`,`post_owner`,`post_date`,`post_gd_id`,`post_cate_id`,`post_status`,`post_update_date`) values (2,'test1','&lt;p&gt;test&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;test1&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;color: #333399;&quot;&gt;&lt;strong&gt;test2&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;','test1','2017-09-12 13:10:42',NULL,2,0,'2017-09-12 14:30:09'),(3,'test','&lt;p&gt;test&lt;/p&gt;','test','2017-09-12 14:35:20',NULL,1,0,NULL),(4,'test','&lt;p&gt;test&lt;/p&gt;','test','2017-09-12 14:36:25',NULL,1,0,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
