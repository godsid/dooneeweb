# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19)
# Database: doonee
# Generation Time: 2557-08-17 13:48:15 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table do_news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `do_news`;

CREATE TABLE `do_news` (
  `news_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `description` text,
  `edit_date` datetime DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `do_news` WRITE;
/*!40000 ALTER TABLE `do_news` DISABLE KEYS */;

INSERT INTO `do_news` (`news_id`, `title`, `cover`, `description`, `edit_date`, `create_date`, `status`)
VALUES
	(1,'ดูหนังจัดเต็ม!! ซื้อแพ็คเกจดูหนัง 3 เดือน รับสิทธิ์ดูหนังฟรีเพิ่มอีก 1 เดือน เมื่อชำระผ่าน AIS mPAY Mastercard','/files/news/2a3w2.jpg','ลูกค้าที่ซื้อ Package Doonee 3 เดือน ราคา 387 บาท และชำระผ่าน AIS mPAY MasterCard รับสิทธิ์พิเศษดูหนังฟรีอีก 1 เดือนเต็มคุ้มสุดๆ บอกเลย!!\nAIS mPAY MasterCard บัตรซื้อสินค้าออนไลน์แทนบัตรเครดิต เป็นบริการใหม่ที่จะช่วยเพิ่มความสะดวกสบายซื้อสินค้าออนไลน์แทนบัตรเครดิต โดยไม่จำเป็นต้องมีบัตรเครดิต ก็สามารถซื้อของกับเว็บไซต์ที่รับชำระผ่านบัตรเครดิต (MasterCard) ได้ ร่วมกับเว็บไซต์ Doonee.com ในเครือ MTHAI! มอบสิทธิพิเศษให้ลูกค้าที่ดูหนังออนไลน์บนเว็บไซต์ Doonee.com\nเงื่อนไขการเข้าร่วม promotion\n- ลูกค้าต้องชำระผ่านบัตร AIS mPAY MasterCard เท่านั้น\n- ลูกค้าจะได้รับสิทธิ์ดูหนังฟรี 1 เดือนทันทีหลังจากทำรายการ\n- ระยะเวลาโปรโมชั่นตั้งแต่วันนี้ -24 พฤศจิกายน 2556 (3 เดือน) นะค่ะ','2014-08-17 20:41:23','2014-08-17 20:41:27','ACTIVE');

/*!40000 ALTER TABLE `do_news` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
