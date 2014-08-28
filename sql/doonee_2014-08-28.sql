# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19)
# Database: doonee
# Generation Time: 2557-08-28 01:05:20 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table api_access
# ------------------------------------------------------------

CREATE TABLE `api_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL DEFAULT '',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table api_keys
# ------------------------------------------------------------

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table api_limits
# ------------------------------------------------------------

CREATE TABLE `api_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table api_logs
# ------------------------------------------------------------

CREATE TABLE `api_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table ci_sessions
# ------------------------------------------------------------

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table do_banner
# ------------------------------------------------------------

CREATE TABLE `do_banner` (
  `banner_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `do_banner` WRITE;
/*!40000 ALTER TABLE `do_banner` DISABLE KEYS */;

INSERT INTO `do_banner` (`banner_id`, `title`, `link`, `cover`, `description`, `sort`, `startdate`, `enddate`, `status`)
VALUES
	(1,'Captan Amarica The winner','http://dev.doonee.tv','/files/2014/cover80072.jpg',NULL,2,'2014-07-24 07:47:49','2014-09-24 07:48:09','ACTIVE'),
	(2,'Captan Amarica The winner','http://dev.doonee.tv','/files/2014/cover255e7.jpg','',1,NULL,NULL,'ACTIVE');

/*!40000 ALTER TABLE `do_banner` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_category
# ------------------------------------------------------------

CREATE TABLE `do_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

LOCK TABLES `do_category` WRITE;
/*!40000 ALTER TABLE `do_category` DISABLE KEYS */;

INSERT INTO `do_category` (`category_id`, `title`, `parent_id`, `status`, `sort`)
VALUES
	(1,'หนังฮอลลีวู้ด',0,'ACTIVE',1),
	(2,'หนังเอเชีย',0,'ACTIVE',10),
	(3,'หนังแอ็คชั่น',1,'ACTIVE',2),
	(4,'หนังซุปเปอร์ฮีโร่',1,'ACTIVE',3),
	(5,'หนังตลก',1,'ACTIVE',4),
	(6,'หนังสยองขวัญ',1,'ACTIVE',5),
	(7,'หนังดราม่า',1,'ACTIVE',6),
	(8,'หนังโรแมนติก',1,'ACTIVE',7),
	(9,'หนังการ์ตูน',1,'ACTIVE',8),
	(10,'หนังอิโรติก 18+',1,'ACTIVE',9),
	(11,'หนังญี่ปุ่น',2,'ACTIVE',11),
	(12,'หนังเกาหลี',2,'ACTIVE',12),
	(13,'หนังจีน',2,'ACTIVE',13),
	(14,'ซีรีย์ฮอลลีวู้ด',0,'ACTIVE',14),
	(15,'ซีรีย์การ์ตูน เสริมสร้างทักษะเด็ก',0,'ACTIVE',15),
	(16,'samsung package',0,'ACTIVE',NULL);

/*!40000 ALTER TABLE `do_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_episode
# ------------------------------------------------------------

CREATE TABLE `do_episode` (
  `episode_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`episode_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

LOCK TABLES `do_episode` WRITE;
/*!40000 ALTER TABLE `do_episode` DISABLE KEYS */;

INSERT INTO `do_episode` (`episode_id`, `movie_id`, `title`, `path`, `status`)
VALUES
	(1,13,'ทดสอบ EP1','/series/ddasdidjidfjidf.mp4','ACTIVE'),
	(2,13,'ทดสอบ EP2',NULL,'ACTIVE'),
	(3,13,'ทดสอบ EP3',NULL,'ACTIVE'),
	(4,13,'ทดสอบ EP4',NULL,'ACTIVE'),
	(5,13,'ทดสอบ EP4',NULL,'ACTIVE'),
	(6,13,'ทดสอบ EP5',NULL,'ACTIVE'),
	(7,13,'ทดสอบ EP6',NULL,'ACTIVE'),
	(8,13,'ทดสอบ EP7',NULL,'ACTIVE'),
	(9,13,'ทดสอบ EP8',NULL,'ACTIVE'),
	(10,13,'ทดสอบ EP9',NULL,'ACTIVE'),
	(11,13,'ทดสอบ EP10',NULL,'ACTIVE'),
	(12,13,'ทดสอบ EP12',NULL,'ACTIVE'),
	(13,13,'ทดสอบ EP12',NULL,'ACTIVE'),
	(14,13,'ทดสอบ EP10',NULL,'ACTIVE'),
	(15,13,'ทดสอบ EP10',NULL,'ACTIVE'),
	(16,13,'ทดสอบ EP10',NULL,'ACTIVE'),
	(17,13,'ทดสอบ EP10',NULL,'ACTIVE'),
	(18,13,'ทดสอบ EP10',NULL,'ACTIVE'),
	(19,13,'dsdsd',NULL,'ACTIVE'),
	(20,13,'dsdsddd',NULL,'ACTIVE'),
	(21,13,'dsdd',NULL,'ACTIVE'),
	(22,13,'dsdsdd',NULL,'ACTIVE'),
	(23,13,'dsdsdddd',NULL,'ACTIVE'),
	(24,13,'dsdsd',NULL,'ACTIVE'),
	(26,13,'dddds',NULL,'ACTIVE');

/*!40000 ALTER TABLE `do_episode` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_history
# ------------------------------------------------------------

CREATE TABLE `do_history` (
  `history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table do_log_login
# ------------------------------------------------------------

CREATE TABLE `do_log_login` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `email` int(11) DEFAULT NULL,
  `password` int(11) DEFAULT NULL,
  `from` enum('WEB','IOS','ANDROID','API') DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `status` enum('SUCCESS','FAIL') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table do_movie
# ------------------------------------------------------------

CREATE TABLE `do_movie` (
  `movie_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `summary` varchar(200) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `description` text,
  `rating` enum('G','PG','PG-13','R','NC-17') DEFAULT NULL,
  `score` enum('1','2','3','4','5') DEFAULT '1',
  `cast` varchar(255) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `genre` int(11) DEFAULT NULL,
  `audio` varchar(20) DEFAULT NULL,
  `subtitle` varchar(20) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `is_free` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `is_hd` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `is_hot` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `is_3d` enum('YES','NO') DEFAULT 'NO',
  `is_series` enum('YES','NO') DEFAULT NULL,
  `view` int(11) DEFAULT '0',
  `create_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `edit_date` datetime DEFAULT NULL,
  `publish_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  PRIMARY KEY (`movie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

LOCK TABLES `do_movie` WRITE;
/*!40000 ALTER TABLE `do_movie` DISABLE KEYS */;

INSERT INTO `do_movie` (`movie_id`, `title`, `title_en`, `cover`, `summary`, `path`, `trailer`, `description`, `rating`, `score`, `cast`, `director`, `genre`, `audio`, `subtitle`, `length`, `year`, `is_free`, `is_hd`, `is_hot`, `is_3d`, `is_series`, `view`, `create_date`, `edit_date`, `publish_date`, `end_date`, `status`)
VALUES
	(1,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-01.jpg',NULL,NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','5','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','NO','YES',0,'2014-08-27 06:42:46',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(2,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-02.jpg',NULL,NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','PG','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','YES',0,'2014-08-17 13:42:45',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(3,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-03.jpg',NULL,NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'NO','NO','YES','YES','YES',0,'2014-08-17 23:20:11',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(4,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-04.jpg',NULL,NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'NO','YES','YES','YES','YES',0,'2014-08-17 23:17:16',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(5,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-05.jpg',NULL,NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','YES',0,'2014-08-17 13:42:49',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(6,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-06.jpg',NULL,NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','YES',0,'2014-08-17 13:42:49',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(7,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-07.jpg',NULL,NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','NO',0,'2014-08-17 12:55:42','2014-08-17 12:55:42','2014-07-09 00:00:00',NULL,'ACTIVE'),
	(8,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-08.jpg',NULL,NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','NO',0,'2014-08-17 12:55:23','2014-08-17 12:55:23','2014-07-09 00:00:00',NULL,'ACTIVE'),
	(9,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-09.jpg','Immortal Masterpiece',NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','5','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','NO',0,'2014-08-21 06:11:07','2014-08-17 12:55:03','2014-07-09 00:00:00',NULL,'ACTIVE'),
	(10,'ทอสอบ','Testing','/files/2014/49946.jpg',NULL,NULL,'ตัวอย่าง','เรื่องย่อ','PG-13','3','ไม่ระบุ','ไม่ระบุ',0,'TH','TH',120,2014,'YES','NO','YES','NO','NO',0,'2014-08-17 12:53:59','2014-08-17 12:53:59',NULL,NULL,'INACTIVE'),
	(13,'ทดสอบ','testt','/files/2014/071b4.jpg','น่ารัก','071b4760d2','ตัวอย่าง','เรื่องย่อ','G','1','-','-',0,'TH,EN','EN,TH',120,2014,'YES','YES','YES','YES','YES',0,'2014-08-26 01:46:25','2014-08-26 01:46:25',NULL,NULL,'ACTIVE'),
	(15,'testTags','testTags','/files/2014/67eec.jpg','dddd','67eec5c1f4',NULL,'5555','G','1','','',NULL,'','',0,0,'NO','NO','NO','NO','YES',0,'2014-08-26 19:39:53','2014-08-26 19:39:53',NULL,NULL,'INACTIVE'),
	(16,'fsfsdf','dffd','/files/2014/e30b1.jpg','adasd','e30b1478da',NULL,'','G','1','','',NULL,'','',0,0,'NO','NO','NO','NO','NO',0,NULL,NULL,NULL,NULL,'INACTIVE'),
	(17,'dsds','dsdsd','/files/2014/29765.jpg','','297652ddf1',NULL,'','G','1','','',NULL,'','',0,0,'NO','NO','NO','NO','NO',0,NULL,NULL,NULL,NULL,'INACTIVE'),
	(18,'dsdad','weweew','/files/2014/71363.jpg','','87a2a45283',NULL,'','G','1','','',NULL,'','',0,0,'NO','NO','NO','NO','NO',0,NULL,NULL,NULL,NULL,'INACTIVE'),
	(19,'sdada','ddsdsd','/files/2014/b1d20.jpg','','b1d204cc92',NULL,'','G','1','','',NULL,'','',0,0,'NO','NO','NO','NO','NO',0,NULL,NULL,NULL,NULL,'INACTIVE'),
	(20,'sdadaddd','ddsdsddd','/files/2014/f5831.jpg','','f58310d11c',NULL,'','G','1','','',NULL,'','',0,0,'NO','NO','NO','NO','NO',0,NULL,NULL,NULL,NULL,'INACTIVE'),
	(21,'sdadaddd','ddsdsddd','/files/2014/d0440.jpg','','d0440fbb15',NULL,'','G','1','','',NULL,'','',0,0,'NO','NO','NO','NO','NO',0,NULL,NULL,NULL,NULL,'INACTIVE'),
	(22,'adadasd','adadad','/files/2014/6cf83.jpg','','18929ba1a2',NULL,'','G','1','','',NULL,'','',0,0,'NO','NO','NO','NO','NO',0,NULL,NULL,NULL,NULL,'INACTIVE');

/*!40000 ALTER TABLE `do_movie` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_movie_category
# ------------------------------------------------------------

CREATE TABLE `do_movie_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mov_cat` (`movie_id`,`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

LOCK TABLES `do_movie_category` WRITE;
/*!40000 ALTER TABLE `do_movie_category` DISABLE KEYS */;

INSERT INTO `do_movie_category` (`id`, `movie_id`, `category_id`)
VALUES
	(12,1,3),
	(14,1,3),
	(13,1,4),
	(15,1,4),
	(11,1,9),
	(9,7,1),
	(10,7,6),
	(7,8,2),
	(8,8,13),
	(4,9,1),
	(5,9,3),
	(6,9,6),
	(2,10,2),
	(3,10,11),
	(1,13,1);

/*!40000 ALTER TABLE `do_movie_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_movie_history
# ------------------------------------------------------------

CREATE TABLE `do_movie_history` (
  `history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`history_id`),
  UNIQUE KEY `user_mov` (`user_id`,`movie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `do_movie_history` WRITE;
/*!40000 ALTER TABLE `do_movie_history` DISABLE KEYS */;

INSERT INTO `do_movie_history` (`history_id`, `user_id`, `movie_id`)
VALUES
	(1,1,8);

/*!40000 ALTER TABLE `do_movie_history` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_movie_tags
# ------------------------------------------------------------

CREATE TABLE `do_movie_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tags_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_mov` (`tags_id`,`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

LOCK TABLES `do_movie_tags` WRITE;
/*!40000 ALTER TABLE `do_movie_tags` DISABLE KEYS */;

INSERT INTO `do_movie_tags` (`id`, `tags_id`, `movie_id`)
VALUES
	(13,7,13),
	(22,10,13),
	(26,11,6),
	(24,11,13),
	(25,12,13),
	(27,13,1),
	(29,14,15),
	(30,15,1),
	(31,16,1),
	(32,17,1),
	(33,18,1),
	(34,19,1),
	(35,20,1),
	(36,21,21),
	(37,22,22),
	(38,23,22);

/*!40000 ALTER TABLE `do_movie_tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_news
# ------------------------------------------------------------

CREATE TABLE `do_news` (
  `news_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `description` text,
  `edit_date` datetime DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `do_news` WRITE;
/*!40000 ALTER TABLE `do_news` DISABLE KEYS */;

INSERT INTO `do_news` (`news_id`, `title`, `cover`, `description`, `edit_date`, `create_date`, `status`)
VALUES
	(1,'ดูหนังจัดเต็ม!! ซื้อแพ็คเกจดูหนัง 3 เดือน รับสิทธิ์ดูหนังฟรีเพิ่มอีก 1 เดือน เมื่อชำระผ่าน AIS mPAY Mastercard','/files/news/2a3w2.jpg','ลูกค้าที่ซื้อ Package Doonee 3 เดือน ราคา 387 บาท และชำระผ่าน AIS mPAY MasterCard รับสิทธิ์พิเศษดูหนังฟรีอีก 1 เดือนเต็มคุ้มสุดๆ บอกเลย!!\nAIS mPAY MasterCard บัตรซื้อสินค้าออนไลน์แทนบัตรเครดิต เป็นบริการใหม่ที่จะช่วยเพิ่มความสะดวกสบายซื้อสินค้าออนไลน์แทนบัตรเครดิต โดยไม่จำเป็นต้องมีบัตรเครดิต ก็สามารถซื้อของกับเว็บไซต์ที่รับชำระผ่านบัตรเครดิต (MasterCard) ได้ ร่วมกับเว็บไซต์ Doonee.com ในเครือ MTHAI! มอบสิทธิพิเศษให้ลูกค้าที่ดูหนังออนไลน์บนเว็บไซต์ Doonee.com\nเงื่อนไขการเข้าร่วม promotion\n- ลูกค้าต้องชำระผ่านบัตร AIS mPAY MasterCard เท่านั้น\n- ลูกค้าจะได้รับสิทธิ์ดูหนังฟรี 1 เดือนทันทีหลังจากทำรายการ\n- ระยะเวลาโปรโมชั่นตั้งแต่วันนี้ -24 พฤศจิกายน 2556 (3 เดือน) นะค่ะ','2014-08-17 20:41:23','2014-08-17 20:41:27','ACTIVE');

/*!40000 ALTER TABLE `do_news` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_package
# ------------------------------------------------------------

CREATE TABLE `do_package` (
  `package_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `banner` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `detail` text,
  `conditions` text,
  `dayleft` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  PRIMARY KEY (`package_id`),
  KEY `nam_sta` (`name`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

LOCK TABLES `do_package` WRITE;
/*!40000 ALTER TABLE `do_package` DISABLE KEYS */;

INSERT INTO `do_package` (`package_id`, `title`, `banner`, `name`, `detail`, `conditions`, `dayleft`, `price`, `start_date`, `end_date`, `edit_date`, `status`)
VALUES
	(1,'Movie Pack 30 Day','/files/2014/package997d0.jpg','movie_pack_30_day','บัตรผ่านดูหนังไม่อั้นกว่า 300 เรื่องต่อเดือน','รองรับการรับชมผ่านอุปกรณ์ที่ใช้ iOS เวอร์ชั่น 6 ขึ้นไป (สำหรับการใช้งานร่วมกับ Apple TV กรุณาใช้เวอร์ชั่น 7 ขึ้นไป) และ Android 4.0 ขึ้นไปเท่านั้น\n• กรณีรับชมผ่านเว็บเบราเซอร์จะต้องใช้ Chrome และ Firefox ในระบบปฏิบัติการ Windows หรือ Safari ในระบบปฏิบัติการ Mac OS เท่านั้น\n• ลูกค้าไม่สามารถใช้งานได้มากกว่า 1 อุปกรณ์ในช่วงเวลาเดียวกัน\n• สงวนสิทธิ์ในการลงทะเบียนอุปกรณ์ได้ไม่เกิน 3 อุปกรณ์ และสามารถเปลี่ยนแปลงได้ไม่เกิน 1 ครั้งต่อเดือน\n• รับสิทธิ์ดูหนังทุกเรื่องตามที่ระบุในแพ็คเกจไม่จำกัดจำนวนครั้งภายในจำนวนวันที่ระบุในแพ็คเกจที่คุณเลือก โดยเริ่มนับตั้งแต่วันที่สมัคร\n• ระบบจะคิดค่าบริการต่อเนื่องเมื่อครบจำนวนวันที่ระบุในแพ็คเกจที่คุณเลือกชำระด้วยบัตรเครดิตหรือบัตรเดบิต และอนุญาตให้หักเงินอัตโนมัติ\n• อัตราค่าบริการนี้ยังไม่รวมค่าธรรมเนียมในการชำระเงินจากทางธนาคาร หรือผู้รับชำระ\n• อัตราค่าบริการนี้ยังไม่รวมค่าอินเทอร์เน็ตในการรับชม\n• รอบการชำระเงินของแต่ละรอบนั้น จะนับจากวันที่สมาชิกได้สมัครในครั้งแรกแล้วนับไปตามจำนวนวันที่ระบุไว้ในขณะที่ทำการสมัครสมาชิก เช่น 30 วัน, 180 วัน หรือ 360 วัน\n• ภาพยนตร์ที่มีในแพ็คเกจนี้อาจมีการเปลี่ยนแปลงตามความเหมาะสมได้ในแต่ละเดือน\n• ผู้สมัครสมาชิกมีความประสงค์ยินดีที่จะเข้ารับข่าวสารจากผู้ให้บริการทาง อีเมล์ โทรศัพท์ จดหมายและ SMS\n• ผู้ให้บริการขอสงวนสิทธิ์ในการใช้บริการในต่างแดน\n• ประสิทธิภาพในการรับชมขึ้นอยู่กับความเร็วอินเทอร์เน็ต ช่วงระยะเวลาของการใช้งาน ความหนาแน่นของผู้ใช้บริการ และ ความเร็วในการประมวลผลของอุปกรณ์ที่รับชม\n• ผู้ให้บริการขอสงวนสิทธิ์ในการคืนเงินแก่ผู้สมัครสมาชิกทุกกรณี \n• สิทธิ์ในการรับชมนี้จำกัดเฉพาะการรับชมเพื่อความบันเทิงส่วนตัวเท่านั้น หากปรากฏข้อเท็จจริงว่ามีการนำไปแสวงหาผลประโยชน์ทางธุรกิจในเชิงการค้า ผู้ให้บริการขอสงวนสิทธิ์ในการระงับหรือยกเลิกการให้บริการ และหากการละเมิดเงื่อนไขเกิดความเสียหายแก่ผู้ให้บริการ ทางสมาชิกจะต้องชดใช้ค่าเสียหายที่เกิดขึ้นจากเหตุแห่งการละเมิด\n• สมาชิกที่ใช้บริการไม่สามารถทำช้ำ ดัดแปลงหรือเผยแพร่ของการรับชม ไม่ว่าทั้งหมดหรือส่วนหนึ่งส่วนใดทั้งสิ้น หากสมาชิกได้ทำการละเมิด ทางผู้ให้บริการจะดำเนินคดีตามกฏหมาย\n• แอพพลิเคชั่น Hollywood HDTV สามารถใช้งานได้เฉพาะในประเทศไทยเท่านั้น และไม่อนุญาตให้ใช้งานกับอุปกรณ์ที่ Jailbreak บน iOS หรือ Root บน android\n• เงื่อนไขการให้บริการ รายชื่อภาพยนตร์ และราคาเป็นไปตามที่ Hollywood HDTV กำหนด และสามารถเปลี่ยนแปลงได้โดยไม่ต้องแจ้งให้ทราบล่วงหน้า\n• ให้บริการโดย บริษัท ฟลาย ดิจิตอลมีเดีย จำกัด ที่อยู่ 889 อาคารไทยซีซีทาวเวอร์ ชั้น 12 ห้อง 125-128 ถนนสาทรใต้ แขวงยานนาวา เขตสาทร กรุงเทพ 10120',30,200,NULL,NULL,'2014-08-17 15:23:06','ACTIVE'),
	(2,'Series Pack 30 Day','/files/2014/package2c5cc.jpg','Series_Pack_30_Day','ดูซีรี่ย์ Holywood และซีรี่ย์เกาหลีไม่อั้นกว่า 300 ตอนต่อเดือน','รองรับการรับชมผ่านอุปกรณ์ที่ใช้ iOS เวอร์ชั่น 6 ขึ้นไป (สำหรับการใช้งานร่วมกับ Apple TV กรุณาใช้เวอร์ชั่น 7 ขึ้นไป) และ Android 4.0 ขึ้นไปเท่านั้น\n• กรณีรับชมผ่านเว็บเบราเซอร์จะต้องใช้ Chrome และ Firefox ในระบบปฏิบัติการ Windows หรือ Safari ในระบบปฏิบัติการ Mac OS เท่านั้น\n• ลูกค้าไม่สามารถใช้งานได้มากกว่า 1 อุปกรณ์ในช่วงเวลาเดียวกัน\n• สงวนสิทธิ์ในการลงทะเบียนอุปกรณ์ได้ไม่เกิน 3 อุปกรณ์ และสามารถเปลี่ยนแปลงได้ไม่เกิน 1 ครั้งต่อเดือน\n• รับสิทธิ์ดูหนังทุกเรื่องตามที่ระบุในแพ็คเกจไม่จำกัดจำนวนครั้งภายในจำนวนวันที่ระบุในแพ็คเกจที่คุณเลือก โดยเริ่มนับตั้งแต่วันที่สมัคร\n• ระบบจะคิดค่าบริการต่อเนื่องเมื่อครบจำนวนวันที่ระบุในแพ็คเกจที่คุณเลือกชำระด้วยบัตรเครดิตหรือบัตรเดบิต และอนุญาตให้หักเงินอัตโนมัติ\n• อัตราค่าบริการนี้ยังไม่รวมค่าธรรมเนียมในการชำระเงินจากทางธนาคาร หรือผู้รับชำระ\n• อัตราค่าบริการนี้ยังไม่รวมค่าอินเทอร์เน็ตในการรับชม\n• รอบการชำระเงินของแต่ละรอบนั้น จะนับจากวันที่สมาชิกได้สมัครในครั้งแรกแล้วนับไปตามจำนวนวันที่ระบุไว้ในขณะที่ทำการสมัครสมาชิก เช่น 30 วัน, 180 วัน หรือ 360 วัน\n• ภาพยนตร์ที่มีในแพ็คเกจนี้อาจมีการเปลี่ยนแปลงตามความเหมาะสมได้ในแต่ละเดือน\n• ผู้สมัครสมาชิกมีความประสงค์ยินดีที่จะเข้ารับข่าวสารจากผู้ให้บริการทาง อีเมล์ โทรศัพท์ จดหมายและ SMS\n• ผู้ให้บริการขอสงวนสิทธิ์ในการใช้บริการในต่างแดน\n• ประสิทธิภาพในการรับชมขึ้นอยู่กับความเร็วอินเทอร์เน็ต ช่วงระยะเวลาของการใช้งาน ความหนาแน่นของผู้ใช้บริการ และ ความเร็วในการประมวลผลของอุปกรณ์ที่รับชม\n• ผู้ให้บริการขอสงวนสิทธิ์ในการคืนเงินแก่ผู้สมัครสมาชิกทุกกรณี \n• สิทธิ์ในการรับชมนี้จำกัดเฉพาะการรับชมเพื่อความบันเทิงส่วนตัวเท่านั้น หากปรากฏข้อเท็จจริงว่ามีการนำไปแสวงหาผลประโยชน์ทางธุรกิจในเชิงการค้า ผู้ให้บริการขอสงวนสิทธิ์ในการระงับหรือยกเลิกการให้บริการ และหากการละเมิดเงื่อนไขเกิดความเสียหายแก่ผู้ให้บริการ ทางสมาชิกจะต้องชดใช้ค่าเสียหายที่เกิดขึ้นจากเหตุแห่งการละเมิด\n• สมาชิกที่ใช้บริการไม่สามารถทำช้ำ ดัดแปลงหรือเผยแพร่ของการรับชม ไม่ว่าทั้งหมดหรือส่วนหนึ่งส่วนใดทั้งสิ้น หากสมาชิกได้ทำการละเมิด ทางผู้ให้บริการจะดำเนินคดีตามกฏหมาย\n• แอพพลิเคชั่น Hollywood HDTV สามารถใช้งานได้เฉพาะในประเทศไทยเท่านั้น และไม่อนุญาตให้ใช้งานกับอุปกรณ์ที่ Jailbreak บน iOS หรือ Root บน android\n• เงื่อนไขการให้บริการ รายชื่อภาพยนตร์ และราคาเป็นไปตามที่ Hollywood HDTV กำหนด และสามารถเปลี่ยนแปลงได้โดยไม่ต้องแจ้งให้ทราบล่วงหน้า\n• ให้บริการโดย บริษัท ฟลาย ดิจิตอลมีเดีย จำกัด ที่อยู่ 889 อาคารไทยซีซีทาวเวอร์ ชั้น 12 ห้อง 125-128 ถนนสาทรใต้ แขวงยานนาวา เขตสาทร กรุงเทพ 10120',30,199,NULL,NULL,'2014-08-17 15:38:57','ACTIVE'),
	(3,'Samsung Free Series',NULL,'SamsungFreeSeries','ดูSeries ฟรีผ่าน Samsung Showtime','รับชม  serires ฟรี  ตอน',365,0,NULL,NULL,'2014-08-23 09:12:47','ACTIVE'),
	(4,'Samsung 199 บาท 30Day ',NULL,'Samsung30Day199Bath','เหมาจ่าย 199  บาทดูได้  30  วัน','เหมาจ่าย 199  บาทดูได้  30  วัน',30,199,NULL,NULL,NULL,'ACTIVE');

/*!40000 ALTER TABLE `do_package` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_package_category
# ------------------------------------------------------------

CREATE TABLE `do_package_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `package_id` (`package_id`,`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

LOCK TABLES `do_package_category` WRITE;
/*!40000 ALTER TABLE `do_package_category` DISABLE KEYS */;

INSERT INTO `do_package_category` (`id`, `package_id`, `category_id`)
VALUES
	(1,1,1),
	(4,1,3),
	(3,1,4),
	(5,1,5),
	(6,1,6),
	(7,1,7),
	(8,2,14),
	(9,2,15),
	(10,3,16);

/*!40000 ALTER TABLE `do_package_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_payment
# ------------------------------------------------------------

CREATE TABLE `do_payment` (
  `payment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `channel` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table do_ss_transection
# ------------------------------------------------------------

CREATE TABLE `do_ss_transection` (
  `transection_id` int(11) NOT NULL AUTO_INCREMENT,
  `uId` varchar(32) NOT NULL,
  `command` varchar(50) NOT NULL,
  `transactionId` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `appId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`transection_id`),
  UNIQUE KEY `transection_id` (`transection_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `do_ss_transection` WRITE;
/*!40000 ALTER TABLE `do_ss_transection` DISABLE KEYS */;

INSERT INTO `do_ss_transection` (`transection_id`, `uId`, `command`, `transactionId`, `status`, `description`, `appId`, `cId`, `price`, `create_date`, `update_date`)
VALUES
	(1,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612131,200,'Success',20,0,199,'2014-08-28 00:52:36','2014-08-28 02:09:31'),
	(3,'8d89c3087cc6cb98793ab7c0f5658c56','confirmChargingd',612132,200,'Success',20,0,199,'2014-08-28 02:12:51','2014-08-28 02:13:34');

/*!40000 ALTER TABLE `do_ss_transection` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_ss_transection_log
# ------------------------------------------------------------

CREATE TABLE `do_ss_transection_log` (
  `transection_id` int(11) NOT NULL AUTO_INCREMENT,
  `uId` varchar(32) NOT NULL,
  `command` varchar(50) NOT NULL,
  `transactionId` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `appId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`transection_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

LOCK TABLES `do_ss_transection_log` WRITE;
/*!40000 ALTER TABLE `do_ss_transection_log` DISABLE KEYS */;

INSERT INTO `do_ss_transection_log` (`transection_id`, `uId`, `command`, `transactionId`, `status`, `description`, `appId`, `cId`, `price`, `create_date`)
VALUES
	(1,'8d89c3087cc6cb98793ab7c0f5658c56','prepareCharging',612131,202,'Success',20,0,199,'2014-08-28 00:52:36'),
	(2,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612131,200,'Success',20,120,129,'2014-08-28 01:00:52'),
	(3,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612131,200,'Success',20,0,129,'2014-08-28 01:01:19'),
	(4,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612131,200,'Success',20,0,199,'2014-08-28 01:01:24'),
	(5,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612131,200,'Success',20,0,199,'2014-08-28 02:06:02'),
	(6,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612131,200,'Success',20,0,199,'2014-08-28 02:06:52'),
	(7,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612131,200,'Success',20,0,199,'2014-08-28 02:07:04'),
	(8,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612131,200,'Success',20,0,199,'2014-08-28 02:08:07'),
	(9,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612131,200,'Success',20,0,199,'2014-08-28 02:09:11'),
	(10,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612131,200,'Success',20,0,199,'2014-08-28 02:09:31'),
	(11,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612131,200,'Success',20,0,199,'2014-08-28 02:12:14'),
	(12,'8d89c3087cc6cb98793ab7c0f5658c56','prepareCharging',612132,202,'Success',20,0,199,'2014-08-28 02:12:51'),
	(13,'8d89c3087cc6cb98793ab7c0f5658c56','confirmCharging',612132,200,'Success',20,0,19,'2014-08-28 02:13:18'),
	(14,'8d89c3087cc6cb98793ab7c0f5658c56','confirmChargingd',612132,200,'Success',20,0,199,'2014-08-28 02:13:33');

/*!40000 ALTER TABLE `do_ss_transection_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_tags
# ------------------------------------------------------------

CREATE TABLE `do_tags` (
  `tags_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tags_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`tags_id`),
  KEY `tagname` (`tags_name`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

LOCK TABLES `do_tags` WRITE;
/*!40000 ALTER TABLE `do_tags` DISABLE KEYS */;

INSERT INTO `do_tags` (`tags_id`, `tags_name`)
VALUES
	(1,'สยองขวัญ'),
	(2,'Drama'),
	(3,'ตลก'),
	(4,'ชีวิต'),
	(5,'นำ้เน่า'),
	(9,'ง่วง'),
	(7,'นำ้หวาน'),
	(8,'ลูกทุ่ง'),
	(10,'นอน'),
	(11,'หิวข้าว'),
	(12,'นำ้ตก'),
	(13,'สายลม'),
	(14,'แสงแดด'),
	(15,'นะจ๊ะ'),
	(16,'ดูดี'),
	(17,'ไม่ดูดีกว่า'),
	(18,'จ๊ะ'),
	(19,'ssss'),
	(20,'wwww'),
	(21,'qqqq'),
	(22,'aaaa'),
	(23,'pppp');

/*!40000 ALTER TABLE `do_tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_user
# ------------------------------------------------------------

CREATE TABLE `do_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `idcard` char(13) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  `gender` enum('MAIL','FEMAIL') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `facebook_id` varchar(100) DEFAULT NULL,
  `samsung_id` varchar(32) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `permission` enum('USER','ADMIN') DEFAULT 'USER',
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`user_id`),
  KEY `login` (`email`,`password`,`status`),
  KEY `login_sam` (`samsung_id`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

LOCK TABLES `do_user` WRITE;
/*!40000 ALTER TABLE `do_user` DISABLE KEYS */;

INSERT INTO `do_user` (`user_id`, `email`, `password`, `avatar`, `firstname`, `lastname`, `idcard`, `phone`, `gender`, `birthdate`, `facebook_id`, `samsung_id`, `create_date`, `permission`, `status`)
VALUES
	(1,'banpot.sr@gmail.com','62c8ad0a15d9d1ca38d5dee762a16e01',NULL,'banpot','srihawong','1670500004865','0870791456','MAIL','1984-03-10','10203752730192501',NULL,'2014-07-20 09:59:47','ADMIN','ACTIVE'),
	(2,'somchai@gmail.com','MD5(ssdsdsdsd)',NULL,'somchai','youyen','2210313302303','0892321333','FEMAIL','1933-03-06',NULL,NULL,'2014-07-20 09:59:51','USER','ACTIVE'),
	(3,'korn.jobs@gmail.com','25f9e794323b453885f5181f1b624d0b',NULL,NULL,NULL,NULL,NULL,'MAIL',NULL,NULL,NULL,'2014-08-04 20:09:33','ADMIN','ACTIVE'),
	(4,'banpot.sr1@gmail.com','62c8ad0a15d9d1ca38d5dee762a16e01',NULL,'Banpot','Srihawong',NULL,'sdsfdfsf','MAIL',NULL,NULL,NULL,NULL,NULL,'INACTIVE'),
	(5,'banpot.sr2@gmail.com','1234qwer',NULL,'Banpot','Srihawong',NULL,'0870791456','MAIL',NULL,NULL,NULL,NULL,NULL,'INACTIVE'),
	(6,'banpot.sr3@gmail.com','62c8ad0a15d9d1ca38d5dee762a16e01',NULL,'Banpot','Srihawong',NULL,'0870791456','MAIL',NULL,NULL,NULL,NULL,NULL,'ACTIVE'),
	(7,'banpot.sr4@gmail.com','62c8ad0a15d9d1ca38d5dee762a16e01',NULL,'Banpot','Srihawong',NULL,'0870791456','MAIL',NULL,NULL,NULL,NULL,'USER','ACTIVE'),
	(8,'banpot.sr5@gmail.com','62c8ad0a15d9d1ca38d5dee762a16e01',NULL,'Banpot','Srihawong',NULL,'0870791456','MAIL',NULL,NULL,NULL,NULL,'USER','ACTIVE'),
	(9,'banpot.sr6@gmail.com','62c8ad0a15d9d1ca38d5dee762a16e01',NULL,'Banpot','Srihawong',NULL,'6687079145','MAIL',NULL,NULL,NULL,NULL,'USER','ACTIVE'),
	(13,'8d89c3087cc6cb98793ab7c0f5658c56@samsung.com','8d89c3087cc6cb98793ab7c0f5658c56',NULL,'Samsung','Samsung',NULL,NULL,NULL,NULL,NULL,'8d89c3087cc6cb98793ab7c0f5658c56','2014-08-28 01:56:06','USER','ACTIVE');

/*!40000 ALTER TABLE `do_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_user_favorite
# ------------------------------------------------------------

CREATE TABLE `do_user_favorite` (
  `favorite_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`favorite_id`),
  UNIQUE KEY `user_mov` (`user_id`,`movie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `do_user_favorite` WRITE;
/*!40000 ALTER TABLE `do_user_favorite` DISABLE KEYS */;

INSERT INTO `do_user_favorite` (`favorite_id`, `user_id`, `movie_id`)
VALUES
	(1,1,8);

/*!40000 ALTER TABLE `do_user_favorite` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_user_package
# ------------------------------------------------------------

CREATE TABLE `do_user_package` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

LOCK TABLES `do_user_package` WRITE;
/*!40000 ALTER TABLE `do_user_package` DISABLE KEYS */;

INSERT INTO `do_user_package` (`id`, `user_id`, `package_id`, `create_date`, `expire_date`, `status`)
VALUES
	(4,13,4,'2014-08-28 02:13:34','2014-09-27 02:13:34','ACTIVE');

/*!40000 ALTER TABLE `do_user_package` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table log_search
# ------------------------------------------------------------

CREATE TABLE `log_search` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
