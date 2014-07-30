# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19)
# Database: doonee
# Generation Time: 2557-07-28 23:44:32 +0000
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

DROP TABLE IF EXISTS `api_access`;

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

DROP TABLE IF EXISTS `api_keys`;

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

DROP TABLE IF EXISTS `api_limits`;

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

DROP TABLE IF EXISTS `api_logs`;

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

DROP TABLE IF EXISTS `ci_sessions`;

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

DROP TABLE IF EXISTS `do_banner`;

CREATE TABLE `do_banner` (
  `banner_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `do_banner` WRITE;
/*!40000 ALTER TABLE `do_banner` DISABLE KEYS */;

INSERT INTO `do_banner` (`banner_id`, `title`, `link`, `cover`, `startdate`, `enddate`, `status`)
VALUES
	(1,'Captan Amarica The winner','http://dev.doonee.tv','/files/2014/cover80072.jpg','2014-07-24 07:47:49','2014-09-24 07:48:09','ACTIVE'),
	(2,'Captan Amarica The winner','http://dev.doonee.tv','/files/2014/cover255e7.jpg',NULL,NULL,'ACTIVE');

/*!40000 ALTER TABLE `do_banner` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `do_category`;

CREATE TABLE `do_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
	(15,'ซีรีย์การ์ตูน เสริมสร้างทักษะเด็ก',0,'ACTIVE',15);

/*!40000 ALTER TABLE `do_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `do_history`;

CREATE TABLE `do_history` (
  `history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table do_log_login
# ------------------------------------------------------------

DROP TABLE IF EXISTS `do_log_login`;

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

DROP TABLE IF EXISTS `do_movie`;

CREATE TABLE `do_movie` (
  `movie_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
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
  `create_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `edit_date` datetime DEFAULT NULL,
  `publish_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  PRIMARY KEY (`movie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `do_movie` WRITE;
/*!40000 ALTER TABLE `do_movie` DISABLE KEYS */;

INSERT INTO `do_movie` (`movie_id`, `title`, `title_en`, `cover`, `path`, `trailer`, `description`, `rating`, `score`, `cast`, `director`, `genre`, `audio`, `subtitle`, `length`, `year`, `is_free`, `is_hd`, `is_hot`, `is_3d`, `create_date`, `edit_date`, `publish_date`, `end_date`, `status`)
VALUES
	(1,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-01.jpg',NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','NO','2014-07-20 09:25:40',NULL,'2014-07-09 00:00:00',NULL,'INACTIVE'),
	(2,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-02.jpg',NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','PG','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','2014-07-19 14:04:51',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(3,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-03.jpg',NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','2014-07-19 11:27:13',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(4,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-04.jpg',NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','2014-07-19 11:27:11',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(5,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-05.jpg',NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','2014-07-19 11:27:10',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(6,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-06.jpg',NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','2014-07-19 11:27:08',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(7,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-07.jpg',NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','2014-07-19 11:27:07',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(8,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-08.jpg',NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','2014-07-19 11:27:05',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(9,'วันแวมไพร์ครองโลก','Immortal Masterpiece','/files/2014/movies-09.jpg',NULL,NULL,'Daybreakers ภาพยนตร์แอ็คชั้นล้ำสมัยกระแทกอารมณ์บู๊กระหน่ำ นำแสดงโดย นักแสดงที่เคยเข้าชิงออสการ์มาแล้ว 2 ครั้ง อีธาน ฮอว์ก (นักแสดงสมทบชายยอดเยี่ยม: TRAINING DAY ปี 2001 และ บทภาพยนตร์ดัดแปลงยอดเยี่ยม: BEFORE SUNSET ปี 2004) ร่วมด้วย วิลเลม เดโฟ และ แซม นีลล์ ทุ่มทุนสร้างสุดอลังการจากทีมผู้สร้าง The Matrix และ 28 Days Later เขียนบทและกำกับภาพยนตร์โดย ไมเคิล และ ปีเตอร์ สไปริก - See more at: http://122.155.197.142/player.php#sthash.d0CTbjMY.dpuf','G','4','Ethan Hawke, Willem Dafoe, Sam Neill','Michael Spierig, Peter Spierig',NULL,'EN,TH','EN,TH',7200,2014,'YES','YES','YES','YES','2014-07-19 11:27:01',NULL,'2014-07-09 00:00:00',NULL,'ACTIVE'),
	(10,'ทอสอบ','Testing','/files/2014/49946.jpg',NULL,'ตัวอย่าง','เรื่องย่อ','PG-13','3','ไม่ระบุ','ไม่ระบุ',0,'TH','TH',120,2014,'YES','NO','YES','NO','2014-07-23 07:23:03','2014-07-23 07:23:03',NULL,NULL,'INACTIVE'),
	(11,'ทอสอบ','Testing','/files/2014/c9ca8.jpg',NULL,'ตัวอย่าง','เรื่องย่อ','PG-13','3','ไม่ระบุ','ไม่ระบุ',0,'TH','TH',120,2014,'YES','NO','YES','NO',NULL,NULL,NULL,NULL,'INACTIVE'),
	(12,'ทอสอบ','Testing','/files/2014/37a9e.jpg',NULL,'ตัวอย่าง','เรื่องย่อ','PG-13','3','ไม่ระบุ','ไม่ระบุ',0,'TH','TH',120,2014,'YES','NO','YES','YES','2014-07-26 12:27:39','2014-07-26 12:27:39',NULL,NULL,'INACTIVE'),
	(13,'ทดสอบ22','testt22','/files/2014/071b4.jpg','071b4760d2','ตัวอย่าง','เรื่องย่อ','G','3','-','-',0,'TH,EN','EN,TH',120,2014,'YES','YES','YES','NO',NULL,NULL,NULL,NULL,'INACTIVE');

/*!40000 ALTER TABLE `do_movie` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_package
# ------------------------------------------------------------

DROP TABLE IF EXISTS `do_package`;

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
  PRIMARY KEY (`package_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `do_package` WRITE;
/*!40000 ALTER TABLE `do_package` DISABLE KEYS */;

INSERT INTO `do_package` (`package_id`, `title`, `banner`, `name`, `detail`, `conditions`, `dayleft`, `price`, `start_date`, `end_date`, `edit_date`, `status`)
VALUES
	(1,'Movie Pack 30 Day','/files/2014/package31c5c.jpg','movie_pack_30_day','บัตรผ่านดูหนังไม่อั้นกว่า 300 เรื่องต่อเดือน','รองรับการรับชมผ่านอุปกรณ์ที่ใช้ iOS เวอร์ชั่น 6 ขึ้นไป (สำหรับการใช้งานร่วมกับ Apple TV กรุณาใช้เวอร์ชั่น 7 ขึ้นไป) และ Android 4.0 ขึ้นไปเท่านั้น\n• กรณีรับชมผ่านเว็บเบราเซอร์จะต้องใช้ Chrome และ Firefox ในระบบปฏิบัติการ Windows หรือ Safari ในระบบปฏิบัติการ Mac OS เท่านั้น\n• ลูกค้าไม่สามารถใช้งานได้มากกว่า 1 อุปกรณ์ในช่วงเวลาเดียวกัน\n• สงวนสิทธิ์ในการลงทะเบียนอุปกรณ์ได้ไม่เกิน 3 อุปกรณ์ และสามารถเปลี่ยนแปลงได้ไม่เกิน 1 ครั้งต่อเดือน\n• รับสิทธิ์ดูหนังทุกเรื่องตามที่ระบุในแพ็คเกจไม่จำกัดจำนวนครั้งภายในจำนวนวันที่ระบุในแพ็คเกจที่คุณเลือก โดยเริ่มนับตั้งแต่วันที่สมัคร\n• ระบบจะคิดค่าบริการต่อเนื่องเมื่อครบจำนวนวันที่ระบุในแพ็คเกจที่คุณเลือกชำระด้วยบัตรเครดิตหรือบัตรเดบิต และอนุญาตให้หักเงินอัตโนมัติ\n• อัตราค่าบริการนี้ยังไม่รวมค่าธรรมเนียมในการชำระเงินจากทางธนาคาร หรือผู้รับชำระ\n• อัตราค่าบริการนี้ยังไม่รวมค่าอินเทอร์เน็ตในการรับชม\n• รอบการชำระเงินของแต่ละรอบนั้น จะนับจากวันที่สมาชิกได้สมัครในครั้งแรกแล้วนับไปตามจำนวนวันที่ระบุไว้ในขณะที่ทำการสมัครสมาชิก เช่น 30 วัน, 180 วัน หรือ 360 วัน\n• ภาพยนตร์ที่มีในแพ็คเกจนี้อาจมีการเปลี่ยนแปลงตามความเหมาะสมได้ในแต่ละเดือน\n• ผู้สมัครสมาชิกมีความประสงค์ยินดีที่จะเข้ารับข่าวสารจากผู้ให้บริการทาง อีเมล์ โทรศัพท์ จดหมายและ SMS\n• ผู้ให้บริการขอสงวนสิทธิ์ในการใช้บริการในต่างแดน\n• ประสิทธิภาพในการรับชมขึ้นอยู่กับความเร็วอินเทอร์เน็ต ช่วงระยะเวลาของการใช้งาน ความหนาแน่นของผู้ใช้บริการ และ ความเร็วในการประมวลผลของอุปกรณ์ที่รับชม\n• ผู้ให้บริการขอสงวนสิทธิ์ในการคืนเงินแก่ผู้สมัครสมาชิกทุกกรณี \n• สิทธิ์ในการรับชมนี้จำกัดเฉพาะการรับชมเพื่อความบันเทิงส่วนตัวเท่านั้น หากปรากฏข้อเท็จจริงว่ามีการนำไปแสวงหาผลประโยชน์ทางธุรกิจในเชิงการค้า ผู้ให้บริการขอสงวนสิทธิ์ในการระงับหรือยกเลิกการให้บริการ และหากการละเมิดเงื่อนไขเกิดความเสียหายแก่ผู้ให้บริการ ทางสมาชิกจะต้องชดใช้ค่าเสียหายที่เกิดขึ้นจากเหตุแห่งการละเมิด\n• สมาชิกที่ใช้บริการไม่สามารถทำช้ำ ดัดแปลงหรือเผยแพร่ของการรับชม ไม่ว่าทั้งหมดหรือส่วนหนึ่งส่วนใดทั้งสิ้น หากสมาชิกได้ทำการละเมิด ทางผู้ให้บริการจะดำเนินคดีตามกฏหมาย\n• แอพพลิเคชั่น Hollywood HDTV สามารถใช้งานได้เฉพาะในประเทศไทยเท่านั้น และไม่อนุญาตให้ใช้งานกับอุปกรณ์ที่ Jailbreak บน iOS หรือ Root บน android\n• เงื่อนไขการให้บริการ รายชื่อภาพยนตร์ และราคาเป็นไปตามที่ Hollywood HDTV กำหนด และสามารถเปลี่ยนแปลงได้โดยไม่ต้องแจ้งให้ทราบล่วงหน้า\n• ให้บริการโดย บริษัท ฟลาย ดิจิตอลมีเดีย จำกัด ที่อยู่ 889 อาคารไทยซีซีทาวเวอร์ ชั้น 12 ห้อง 125-128 ถนนสาทรใต้ แขวงยานนาวา เขตสาทร กรุงเทพ 10120',30,200,NULL,NULL,'2014-07-24 06:36:14','ACTIVE');

/*!40000 ALTER TABLE `do_package` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table do_payment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `do_payment`;

CREATE TABLE `do_payment` (
  `payment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `channel` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table do_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `do_user`;

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
  `create_date` datetime DEFAULT NULL,
  `permission` enum('USER','ADMIN') DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `do_user` WRITE;
/*!40000 ALTER TABLE `do_user` DISABLE KEYS */;

INSERT INTO `do_user` (`user_id`, `email`, `password`, `avatar`, `firstname`, `lastname`, `idcard`, `phone`, `gender`, `birthdate`, `create_date`, `permission`, `status`)
VALUES
	(1,'banpot.sr@gmail.com','62c8ad0a15d9d1ca38d5dee762a16e01',NULL,'banpot','srihawong','1670500004865','0870791456','MAIL','1984-03-10','2014-07-20 09:59:47','ADMIN','ACTIVE'),
	(2,'somchai@gmail.com','MD5(ssdsdsdsd)',NULL,'somchai','youyen','2210313302303','0892321333','FEMAIL','1933-03-06','2014-07-20 09:59:51',NULL,'ACTIVE');

/*!40000 ALTER TABLE `do_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table log_search
# ------------------------------------------------------------

DROP TABLE IF EXISTS `log_search`;

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
