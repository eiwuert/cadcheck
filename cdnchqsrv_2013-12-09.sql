# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.24-55-log)
# Database: cdnchqsrv
# Generation Time: 2013-12-09 00:26:07 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table batch
# ------------------------------------------------------------

DROP TABLE IF EXISTS `batch`;

CREATE TABLE `batch` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `datesubmitted` datetime DEFAULT NULL,
  `status` tinyint(3) DEFAULT '0',
  `userid` int(11) unsigned DEFAULT NULL,
  `ext_batchid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_batch` (`userid`),
  CONSTRAINT `FK_batch` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `batch` WRITE;
/*!40000 ALTER TABLE `batch` DISABLE KEYS */;

INSERT INTO `batch` (`id`, `title`, `datecreated`, `datesubmitted`, `status`, `userid`, `ext_batchid`)
VALUES
	(1,'Batch ID # 1','2011-08-01 04:33:48',NULL,0,3,NULL),
	(3,'Batch ID # 3','2011-08-05 00:27:32','2011-08-05 12:40:08',2,2,NULL),
	(4,'Batch ID # 4','2011-08-06 19:58:10','2011-08-09 12:39:50',2,2,NULL),
	(5,'Batch ID # 5','2011-08-09 18:30:38','2011-08-12 07:08:58',2,2,NULL),
	(6,'Batch ID # 6','2011-08-30 15:08:14',NULL,0,2,NULL);

/*!40000 ALTER TABLE `batch` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table batchgroups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `batchgroups`;

CREATE TABLE `batchgroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` int(11) unsigned DEFAULT NULL,
  `batchid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_batchgroups` (`groupid`),
  KEY `FK_batchgroups2` (`batchid`),
  CONSTRAINT `FK_batchgroups` FOREIGN KEY (`groupid`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_batchgroups2` FOREIGN KEY (`batchid`) REFERENCES `batch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `batchgroups` WRITE;
/*!40000 ALTER TABLE `batchgroups` DISABLE KEYS */;

INSERT INTO `batchgroups` (`id`, `groupid`, `batchid`)
VALUES
	(1,2,1),
	(3,1,3),
	(4,1,4),
	(5,1,5),
	(6,1,6);

/*!40000 ALTER TABLE `batchgroups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table country
# ------------------------------------------------------------

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `printable_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table customer_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_data`;

CREATE TABLE `customer_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `address1` varchar(256) DEFAULT NULL,
  `address2` varchar(256) DEFAULT NULL,
  `postcode` varchar(11) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `merchant_submitted` int(11) unsigned DEFAULT NULL,
  `user_submitted` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_customer_data` (`merchant_submitted`),
  KEY `FK_customer_data2` (`user_submitted`),
  KEY `NewIndex1` (`name`,`postcode`),
  CONSTRAINT `FK_customer_data` FOREIGN KEY (`merchant_submitted`) REFERENCES `merchants` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_customer_data2` FOREIGN KEY (`user_submitted`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `customer_data` WRITE;
/*!40000 ALTER TABLE `customer_data` DISABLE KEYS */;

INSERT INTO `customer_data` (`id`, `name`, `email`, `address1`, `address2`, `postcode`, `phone`, `merchant_submitted`, `user_submitted`)
VALUES
	(1,'Bruce Parker','bparker@Ipayoptions.com','41 Sefton Road','Albion','423423','0416926756',NULL,NULL),
	(2,'Bryan Johnson','bj@bj.com','42342342','jkljlk','j','lkjlkj',NULL,NULL),
	(4,'Santi Services (2007) Corporation','','2384 Yonge. Street','Toronto, ON','M4P 2J4','N/A',1,2),
	(5,'Argos Cleaners','','n/a','n/a','n/a','n/a',1,2),
	(6,'SMP Cleaning Services','','n/a','n/a','n/a','n/a',1,2),
	(7,'Pro Restoration','','754 Scarlett Rd','Toronto, ON','M9P 2V1','N/A',1,2),
	(8,'Aim Restoration','','n/a','n/a','n/a','n/a',1,2),
	(9,'Brimakel Masonry Ltd.','','305 Iroquois  Ave.; Unit B','Mississauga, ON','L5G 1M8','n/a',1,2),
	(10,'Michael S. Construction','','3-741 Lawrence Ave. West','Toronto, ON','M6A 1B7','n/a',1,2),
	(11,'Right-Fit Foam Insulation Ltd.','','3000 Langstaff Rd; Unit 2','Concord, ON','L4K 4R7','N/A',1,2),
	(12,'LM General Work','','n/a','N/A','n/a','n/a',1,2),
	(13,'Particular Janitorial Inc.','','n/a','n/a','n/a','416 506 9371',1,2),
	(14,'Numodas','','n/a','N/A','n/a','n/a',1,2),
	(15,'CYS Cleaning Services','','n/a','n/a','n/a','N/A',1,2),
	(16,'Iberia Landscape Services Ltd.','','14662 Hwy 48,','Stouffville, ON','L4A 7X3','905 642 1354',1,2),
	(17,'First C General Services','','n/a','n/a','n/a','n/a',1,2),
	(18,'Nosso Talho Partnership','','1048 Bloor Street West','Toronto, ON','M6H 1M3','416 531 7462',1,2),
	(19,'Stop BBQ','','n/a','n/a','n/a','n/a',1,2),
	(20,'Andorra Building Maintenance Ltd.','','46 Chauncey Ave.','Etobicoke, ON','M8Z 2Z4','n/a',1,2),
	(21,'Braga Cleaning Services','','433 Silverthorn Ave.','Toronto, ON','M6M 3H4','n/a',1,2),
	(22,'2189542 Ontario Inc.','','n/a','n/a','n/a','n/a',1,2),
	(23,'Ace Construction','','n/a','n/a','n/a','n/a',1,2),
	(24,'MDF Construction','','n/a','n/a','n/a','n/a',1,2),
	(25,'Bethania Construction','','n/a','n/a','n/a','n/a',1,2),
	(26,'Armand-Shel Investments Inc.','','Best western Plus Milton Inn; Chisholm Dr.','Milton','L9T 4A6','905 875 3818',1,2),
	(27,'Top Skill International Training& Staffing','','n/a','n/a','n/a','n/a',1,2),
	(28,'JMCC Cleaning and Maintenance Services','','n/a','n/a','n/a','n/a',1,2),
	(29,'Santi Services (2007) Corporation','','220 Woolner Ave., Sutie 607','Toronto, ON','M6N 1Y6','N/A',1,2),
	(30,'Veria Building Maintenance Inc.','','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','n/a',1,2),
	(31,'Maxximous Services','','n/a','n/a','n/a','n/a',1,2),
	(32,'Whiterose Janitorial Services Ltd.','','n/a','n/a','n/a','n/a',1,2),
	(33,'AAG General Services','','133 Mulock Ave.','Toronto, ON','M6N 3C5','n/a',1,2),
	(34,'Pequena Lulu ','','107-1441 Lawrence Ave. East','Toronto, ON','M4A 1W3','n/a',1,2),
	(35,'Wonder General Services','','158 Emerson Street','Toronto, ON','M6H 3T4','n/a',1,2),
	(36,'Jona\'s Services','','1965 Weston Rd','Toronto, ON','M9N 8P3','n/a',1,2),
	(37,'Cristiano Rfc','','530-2700 Lawrence ','Toronto, ON','M1P 2S5','n/a',1,2),
	(38,'Isabel Cleaning ','','2 Avalon ','Toronto, ON','M6N 4V5','n/a',1,2),
	(39,'Yunka ','','404-1A Bansley  Ave.','Toronto, ON','M6E 2A1','n/a',1,2),
	(40,'Seybe ','','1967 Dufferin St.','Toronto, ON','M3E 3P8','n/a',1,2),
	(41,'Ariad General Services','','3-34 Nair Ave.','Toronto, ON','M6E 4G7','n/a',1,2),
	(42,'J.J.G General Service','','175 Rankin Crescent','Toronto, ON','M3N 3H2','n/a',1,2),
	(43,'Los Remedios','','811-390 Dawes Rd','Toronto, ON','M4B 2E5','n/a',1,2),
	(44,'Fernandel Studio','','401-26 Gulliver Rd','Toronto, ON','M6M 2M8','n/a',1,2),
	(45,'Lima Cleaning Services','','n/a','n/a','n/a','n/a',1,2),
	(46,'Heidy\'s Cleaner Maintenance','','n/a','n/a','n/a','n/a',1,2),
	(47,'Eminico Services','','n/a','n/a','n/a','n/a',1,2),
	(48,'Rivera Group','','n/a','n/a','n/a','n/a',1,2),
	(49,'Zapata Group','','n/a','n/a','n/a','n/a',1,2),
	(50,'John Majia Cleaning Services','','n/a','n/a','n/a','n/a',1,2),
	(51,'Navy Multi Services','','n/a','n/a','n/a','n/a',1,2),
	(52,'Pinzon Cleaner','','n/a','n/a','n/a','n/a',1,2),
	(53,'MAF General Services','','n/a','n/a','n/a','n/a',1,2),
	(54,'Green Valley Landscaping Inc.','','77 Burlington St.','Etobicoke, ON','M8V 3W1','n/a',1,2),
	(55,'Euro Landscaping','','n/a','n/a','n/a','n/a',1,2),
	(56,'Ferbel Cafe','','32 Atomic Ave.','Toronto, ON','M8Z 5L1','n/a',1,2),
	(57,'Total Bricklayers Inc. ','','1238 Dundas St.W','Toronto, ON','M6J 1X5','n/a',1,2),
	(58,'Magana Brick','','565 Sherbourne ','Toronto, ON','M4X 1W7','n/a',1,2),
	(59,'JS Brick','','326 Campbell ','Toronto, ON','M6P 3V9','n/a',1,2),
	(60,'Petunia Gral. Services','','n/a','n/a','n/a','n/a',1,2),
	(61,'Brownstone masonry Inc. ','','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','n/a',1,2),
	(62,'CAV Brick','','8821 Weston Rd,','Woodbridge, ON','L4L 1A6','n/a',1,2),
	(63,'Dylhi Services','','640 Lauder Ave.','Toronto, ON','M6E 3K1','n/a',1,2),
	(64,'Rita General Services','','161 William Street- BSMT','Toronto, ON','M9N 2G9','n/a',1,2),
	(65,'Roherma General Services','','103 Kennard Avenue','Toronto, ON','M3H 4M3','n/a',1,2),
	(66,'Ingerv Cleaner Company Ltd.','','n/a','n/a','n/a','416 897 7935',1,2),
	(67,'Willowdale Maintenance ','','n/a','n/a','n/a','n/a',1,2),
	(68,'Goldcrest Drywall & Acoustics','','3120 Rutherford Rd. 13-307','Concord, ON','L4K 0B2','416 630 7800',1,2),
	(69,'Prise- Franc Company','','n/a','n/a','n/a','n/a',1,2),
	(70,'Aragon Building Maintenance ','','55 Torbay Road, Unit #6','Markham, ON','L3R 1G7','905 948 1400',1,2),
	(71,'Red Hood Services','','291 Wychwood Ave.','Toronto, ON','M6C 2T6','n/a',1,2),
	(72,'Acura Maintenance Service Ltd.','','4739 Rathkeale Rd','Mississauga, ON','L5V 1K3','n/a',1,2),
	(73,'LM General Work','','265 Main Street, # 109','Toronto, ON','M4C 4X3','n/a',1,2),
	(74,'Premium Decorating Services Ltd.  ','','Premium Painting ','n/a','n/a','n/a',1,2),
	(75,'Ram Painting ','','n/a','n/a','n/a','n/a',1,2),
	(76,'Asbury Building Services','','323 Evans Ave.','Toronto, ON','M8Z 1K2','416 620 5513',1,2),
	(77,'Isabel Cleaning Services','','2 Avalon ','Toronto, ON','M6N 4V5','n/a',1,2),
	(78,'Stoneland Masonry Ltd.','','1238 Dundas St.W','Toronto, ON','M6J 1X5','n/a',1,2),
	(79,'D.H Brick ','','59 Goldboro','Toronto, ON','M9L 1A6','n/a',1,2),
	(80,'Arnoldo De Oliveira ','','Ana Couto ; 47 Ulson Dr.','Richmond Hill, ON','L4E 4W3','n/a',1,2),
	(81,'Sanchez Drywall','','n/a','n/a','n/a','n/a',1,2),
	(82,'Peter Caltsoudas- Odyssey Janitorial Services','','n/a','n/a','n/a','n/a',1,2),
	(83,'Coliat General Services','','n/a','n/a','n/a','n/a',1,2),
	(84,'Global Maintenance Services Co.','','1635 Dufferin St.','Toronto, ON','M6H 3L9','n/a',1,2),
	(85,'We Clean Blue ','','652 Crawford St.','Toronto, ON','M6G 3K2','n/a',1,2),
	(86,'Jeka Company ','','1249 College St','Toronto, ON','M6H 1C2','n/a',1,2),
	(87,'Racoon\'s Cleaning','','182 Prescott Avenue','Toronto, ON','M6N 3H1','n/a',1,2),
	(88,'Chilo Cleaning','','74 Lappin ','Toronto, ON','M6H 1Y4','n/a',1,2),
	(89,'Alcover Roofing Inc. ','','107 Shorncliffe Rd.','Etobicoke, ON','M8Z 5K7','n/a',1,2),
	(90,'Yoxo Roofing','','n/a','n/a','n/a','n/a',1,2),
	(91,'Capital Restoration Ltd.','','4936 Yonge St.; Suite 179','Toronto, ON','M2N 6S3','416 702 5502',1,2),
	(92,'H.C General Construction','','n/a','n/a','n/a','n/a',1,2),
	(93,'Rogel Construction & Balconies','','n/a','n/a','n/a','n/a',1,2),
	(94,'Quijano','','468 Vaughan Rd','Toronto, ON','M6C 2P7','n/a',1,2),
	(95,'Cleaning Group','','B-1003 Weston Rd','Toronto, ON','M6N 3R9','n/a',1,2),
	(96,'Eileen Roofing Inc. ','','1825 Wilson Ave.','Toronto, ON','M9M 1A2','416 762 1819',1,2),
	(97,'Mexicaly Roofing ','','281 Wallace Ave.','Toronto, ON','M6E 3N2','n/a',1,2),
	(98,'Newsells Old Boys Company','','1206-20 Stonehill Court','Toronto, ON','n/a','n/a',1,2),
	(99,'Jino General Services','','8 Laxis Ave.','Toronto, ON','M6M 2K5','n/a',1,2),
	(100,'L & P Gral Services','','n/a','n/a','n/a','n/a',1,2),
	(101,'Andes Service','','407-685 Finch Ave. West','Toronto, ON','M2R 1P2','n/a',1,2),
	(102,'Medios Jarros Gral. Services','','605-829 Birchmount','Scarborough, ON','n/a','n/a',1,2),
	(103,'Abassco Renovations Inc.','','n/a','n/a','n/a','n/a',1,2),
	(104,'The Girls Flooring ','','n/a','n/a','n/a','n/a',1,2),
	(105,'P & G Brothers Painting','','502 Brookmill Cres.','Waterloo, ','N2V 2M1','n/a',1,2),
	(106,'Kazemi Enterprises Inc.','','19 Kimberly Court','Richmond Hill, ON','L4E 4C6','905 292 0669',1,2),
	(107,'Panther Cleaning Services','','395 Arlington Ave.','Toronto, ON','M6C 3A1','n/a',1,2),
	(108,'SRL ','','n/a','n/a','n/a','n/a',1,2),
	(109,'Stonehouse Masonry Ltd.','','103 Clyde Ave.','Toronto, ON','M5M 4G5','n/a',1,2),
	(110,'Manuel Alves Contraction','','189 Bellwoods Ave.','Toronto, ON','M6J 2R3','n/a',1,2),
	(111,'1781027 Ontario Ltd. ','','2900 Langstaff Road, Unit 11','Concord, ON','L4K 4R9','n/a',1,2),
	(112,'NC Brick','','n/a','n/a','n/a','n/a',1,2),
	(113,'Brick Silva','','n/a','n/a','n/a','n/a',1,2),
	(114,'TONAR','','1357 Dundas St.W','Toronto, ON','M6J 1Y3','n/a',1,2),
	(115,'1834948 Ontario Inc. ','','996 Vickerman Way','Milton, ON','L9T 0J6','n/a',1,2),
	(116,'Custom Renovations Ltd. ','','3265 Wharton Way ;Unit 17','Mississauga, ON','L4X 2X9','905 282 0666',1,2),
	(117,'Igen Services','','2677 Eglington Ave. West; Unit 14','Toronto, ON','M6M 1T8','n/a',1,2),
	(118,'Xpert Tech Roofing Systems Inc. ','','n/a','n/a','n/a','n/a',1,2),
	(119,'T.J.S. Roofing','','n/a','n/a','n/a','n/a',1,2),
	(120,'Skyline Roofing ','','12-172 Vaughan Rd.','Toronto, ON','M6C 2M3','n/a',1,2),
	(121,'Jay\'s Roofing','','62 William Cragg Dr. ','North York, ON','M3M 1V2','n/a',1,2),
	(122,'Syntex Roofing','','n/a','n/a','n/a','n/a',1,2),
	(123,'2228169 Ontario Ltd','','726 Brock Ave.','Toronto, ON','M6H 3P2','n/a',1,2),
	(124,'Oscar Santiago Brick','','68 Turntable Cres.','Toronto, ON','M6H 4K9','n/a',1,2),
	(125,'Ramos Brick ','','330 Steeles Ave.','Thornhill, ON','L4J 6W9','n/a',1,2),
	(126,'J Martins Brick','','n/a','n/a','n/a','n/a',1,2),
	(127,'E Tiburcio Brick','','n/a','n/a','n/a','n/a',1,2),
	(128,'Limen Restoration Ltd.','','72  Ashwarren Rd','Toronto, ON','M3J 1Z5','n/a',1,2),
	(129,'Lines and Levels Masonry','','141 RR1 ','Warkworth, ON','K0K 3K0','n/a',1,2),
	(130,'MBC Contracting','','n/a','n/a','n/a','n/a',1,2),
	(131,'Montes Brick','','284 Earlscourt','Toronto, ON','M6E 4B8','n/a',1,2),
	(132,'T.F.E Construction','','1-168 Oakwood Ave.','Toronto, ON','M6E 2T9','n/a',1,2),
	(133,'Anthony Construction','','202-1170 Bay St.','Toronto, ON','M5S 2B4','n/a',1,2),
	(134,'Y.D Renovations','','205-25 Guilliver Rd','Toronto, ON','M6M 2M5','n/a',1,2),
	(135,'Tops Agency Inc. ','','n/a','n/a','n/a','416 661 7452',1,2),
	(136,'Tilue Construction','','n/a','n/a','n/a','N/A',1,2),
	(137,'Tops Agency Inc. ','','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','416 661 7452',1,2),
	(138,'Jorge Gomes Construction','','n/a','n/a','n/a','n/a',1,2),
	(139,'OB Brick','','n/a','n/a','n/a','n/a',1,2),
	(140,'Maxum Drywall','','40 Trowers Road, Unit 1','Woodbridge, ON','L4L 7K6','n/a',1,2),
	(141,'D.E.N','','153 Perth Avenue','Toronto, ON','M6P 3X2','n/a',1,2),
	(142,'M & E Cleaning Services','','n/a','n/a','n/a','n/a',1,2),
	(143,'Colorado Brick','','470 Old Weston Rd.','Toronto, ON','M6N 3A9','n/a',1,2),
	(144,'Caledonia Brothers','','9 Columbus St.','Toronto, ON','M6R 1S2','n/a',1,2),
	(145,'Lavs Masonry','','286 Earlscourt Ave.','Toronto, ON','M6E 4B1','n/a',1,2),
	(146,'Century Building Restoration Inc.','','86 Ringwood Drive, Unit 205','Stouffville, ON','L4A 1C3','n/a',1,2),
	(147,'Wikueld ','','25-1780 Wilson Ave.','Toronto, ON','M3L 1A9','n/a',1,2),
	(148,'HM Construction','','99 King Rd','Burlington, ON','L7T 3K4','n/a',1,2),
	(149,'Mao Brick','','51 Boon','Toronto, ON','M6E 3Z2','n/a',1,2),
	(150,'Gloria Construction','','120 Pioneer Lane','Woodbridge, ON','L4L 2J1','n/a',1,2),
	(151,'DCR Construction','','1049 Weston Rd','York, ON ','M6N 3R9','n/a',1,2),
	(152,'Rahel Group','','265 Main Street, # 109','Toronto, ON','M4C 4X3','n/a',1,2),
	(153,'Villafuerte Construction','','220 Woolner Ave., Sutie 607','Toronto, ON','M6N 1Y6','n/a',1,2);

/*!40000 ALTER TABLE `customer_data` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `groupname`)
VALUES
	(1,''),
	(2,''),
	(3,''),
	(4,'National Check Processing');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table merchants
# ------------------------------------------------------------

DROP TABLE IF EXISTS `merchants`;

CREATE TABLE `merchants` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `groupid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_merchants` (`groupid`),
  CONSTRAINT `FK_merchants` FOREIGN KEY (`groupid`) REFERENCES `groups` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `merchants` WRITE;
/*!40000 ALTER TABLE `merchants` DISABLE KEYS */;

INSERT INTO `merchants` (`id`, `name`, `groupid`)
VALUES
	(1,'Merchant 1',1),
	(2,'Merchant 2',2),
	(3,'Merchant 3',3),
	(4,'National Check Processing',4);

/*!40000 ALTER TABLE `merchants` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reports
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports`;

CREATE TABLE `reports` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned DEFAULT NULL,
  `filename` varchar(256) DEFAULT NULL,
  `filetype` varchar(16) DEFAULT NULL,
  `location` varchar(256) DEFAULT NULL,
  `viewed` int(11) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_reports` (`userid`),
  CONSTRAINT `FK_reports` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;

INSERT INTO `reports` (`id`, `userid`, `filename`, `filetype`, `location`, `viewed`, `datecreated`)
VALUES
	(1,3,'test','zip','downloads',1,'2011-08-01 01:16:11'),
	(2,3,'test','rtf','downloads',0,'2011-07-31 11:22:51');

/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reports_content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports_content`;

CREATE TABLE `reports_content` (
  `fileid` int(11) unsigned NOT NULL,
  `filecontent` blob NOT NULL,
  PRIMARY KEY (`fileid`),
  CONSTRAINT `FK_reports_content` FOREIGN KEY (`fileid`) REFERENCES `reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `reports_content` WRITE;
/*!40000 ALTER TABLE `reports_content` DISABLE KEYS */;

INSERT INTO `reports_content` (`fileid`, `filecontent`)
VALUES
	(1,X'504B0304140008000800B666013F00000000000000000000000010001000746573747465787466696C652E72746655580C005D15364E3715364EF50114005592C18EDB201086EF790A7AAA54A91290389B555E601FA0C7B9603CC43418BC80ED4491DFBD636C77DB0B7CFF300CF3032F88D908503ED932E8FE26642541071DD4B2C48F9755A4A1267D3CF3C30B4CF039D70E0C0793269B1218DDAA983073F6816EC46CB5BACE94A9830B9152AF10B1915505B788E817A8DD8034AF0B7C8D57A71216E7AA6CFE01CEA69C55EDF05570D5D8F54E65B48D28BA7DD6D1366B82C3111D94D11B2D8F7FD1EFFC5BF31DFC46263817A64DA44CB655169BEA9546F2BC2AEB1BF49997C616DDA978C7C8E0D5D8A4619E5F6B38E323EFF4D5EA772E60A0C3878B946776DD93FDD0D518D37506637F9693EC9B5C464F139B575B5E75485B0A53ADF9EB72C28891DCE33F97B487F6ECFF823A0CE4005C5A8A40AF7A8C9310EF9CAFDC8AF3E5C4818CDD9C386D140B8D16A749BC551BB6A27ADFF04EF7C20FD0A0A12EA8EBA56E6C203F2419C98FC5CE12D89737876477993E1D7C7A9587A8DC61690BAC1B1D95285F4B9E186823D92F2427FEC6BA27D3F4F5E811581B7A3483734F66339B42BCA76FF31F504B07089BD2FD048D010000CD020000504B03040A0000000000CB66013F000000000000000000000000090010005F5F4D41434F53582F55580C005D15364E5D15364EF5011400504B0304140008000800B666013F0000000000000000000000001B0010005F5F4D41434F53582F2E5F746573747465787466696C652E72746655580C005D15364E3715364EF50114006360156367606260F04D4C56F00F568850800290180327101B01B1021083F8410CC84080012B0000504B070825ED219F2800000052000000504B01021503140008000800B666013F9BD2FD048D010000CD02000010000C000000000000000040FF8100000000746573747465787466696C652E727466555808005D15364E3715364E504B010215030A0000000000CB66013F00000000000000000000000009000C000000000000000040FD41DB0100005F5F4D41434F53582F555808005D15364E5D15364E504B01021503140008000800B666013F25ED219F28000000520000001B000C000000000000000040B681120200005F5F4D41434F53582F2E5F746573747465787466696C652E727466555808005D15364E3715364E504B05060000000003000300E2000000930200000000'),
	(2,X'7B5C727466315C616E73695C616E7369637067313235325C636F636F61727466313033385C636F636F617375627274663336300A7B5C666F6E7474626C5C66305C6673776973735C6663686172736574302048656C7665746963613B7D0A7B5C636F6C6F7274626C3B5C7265643235355C677265656E3235355C626C75653235353B5C72656432305C677265656E35345C626C75653136353B7D0A7B5C2A5C6C6973747461626C657B5C6C6973745C6C69737474656D706C6174656964315C6C6973746879627269647B5C6C6973746C6576656C5C6C6576656C6E666332335C6C6576656C6E66636E32335C6C6576656C6A63305C6C6576656C6A636E305C6C6576656C666F6C6C6F77305C6C6576656C73746172746174315C6C6576656C73706163653336305C6C6576656C696E64656E74307B5C2A5C6C6576656C6D61726B6572205C7B646973635C7D7D7B5C6C6576656C746578745C6C6576656C74656D706C6174656964315C2730315C7563305C7538323236203B7D7B5C6C6576656C6E756D626572733B7D5C66692D3336305C6C693732305C6C696E373230207D7B5C6C6973746E616D65203B7D5C6C6973746964317D7D0A7B5C2A5C6C6973746F766572726964657461626C657B5C6C6973746F766572726964655C6C6973746964315C6C6973746F76657272696465636F756E74305C6C73317D7D0A5C70617065727731313930305C70617065726831363834305C6D6172676C313434305C6D61726772313434305C766965777731373534305C766965776831353934305C766965776B696E64300A5C6465667461623732300A5C706172645C74783232305C74783732305C7061726465667461623732305C6C693732305C66692D3732305C716C5C716E61747572616C0A5C6C73315C696C766C300A5C66305C66733234205C6366322054657374696E67206D7920636F6E74656E7420686F706566756C6C7920697420776F726B73217D');

/*!40000 ALTER TABLE `reports_content` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table transaction_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transaction_type`;

CREATE TABLE `transaction_type` (
  `typeid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `typename` varchar(256) DEFAULT NULL,
  `shortname` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `transaction_type` WRITE;
/*!40000 ALTER TABLE `transaction_type` DISABLE KEYS */;

INSERT INTO `transaction_type` (`typeid`, `typename`, `shortname`)
VALUES
	(1,'Cheque','CHQ');

/*!40000 ALTER TABLE `transaction_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table transactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) unsigned NOT NULL DEFAULT '1',
  `debitcredit` varchar(11) DEFAULT NULL,
  `check_no` varchar(256) DEFAULT NULL,
  `check_amount` decimal(10,2) DEFAULT NULL,
  `check_date` date DEFAULT NULL,
  `issued_by_bank` varchar(256) DEFAULT NULL,
  `issued_by_name` varchar(256) DEFAULT NULL,
  `issued_by_address` varchar(256) DEFAULT NULL,
  `issued_by_address2` varchar(256) DEFAULT NULL,
  `issued_by_postcode` varchar(10) DEFAULT NULL,
  `issued_by_state` varchar(5) DEFAULT NULL,
  `issued_by_phone` varchar(36) DEFAULT NULL,
  `issued_by_email` varchar(256) DEFAULT NULL,
  `payee_name` varchar(256) DEFAULT NULL,
  `payee_address` varchar(256) DEFAULT NULL,
  `payee_address2` varchar(256) DEFAULT NULL,
  `payee_postcode` varchar(10) DEFAULT NULL,
  `payee_state` varchar(5) DEFAULT NULL,
  `payee_phone` varchar(36) DEFAULT NULL,
  `payee_email` varchar(256) DEFAULT NULL,
  `datesubmitted` datetime DEFAULT NULL,
  `merchantid` int(11) unsigned DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT '0',
  `batch` int(11) unsigned DEFAULT NULL,
  `usersubmitted` int(11) unsigned DEFAULT NULL,
  `note` tinytext,
  `external_batchid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_transactions` (`type`),
  KEY `FK_transactions2` (`merchantid`),
  KEY `FK_transactions3` (`batch`),
  KEY `FK_transactions4` (`usersubmitted`),
  CONSTRAINT `FK_transactions` FOREIGN KEY (`type`) REFERENCES `transaction_type` (`typeid`) ON UPDATE CASCADE,
  CONSTRAINT `FK_transactions2` FOREIGN KEY (`merchantid`) REFERENCES `merchants` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_transactions3` FOREIGN KEY (`batch`) REFERENCES `batch` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_transactions4` FOREIGN KEY (`usersubmitted`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;

INSERT INTO `transactions` (`id`, `type`, `debitcredit`, `check_no`, `check_amount`, `check_date`, `issued_by_bank`, `issued_by_name`, `issued_by_address`, `issued_by_address2`, `issued_by_postcode`, `issued_by_state`, `issued_by_phone`, `issued_by_email`, `payee_name`, `payee_address`, `payee_address2`, `payee_postcode`, `payee_state`, `payee_phone`, `payee_email`, `datesubmitted`, `merchantid`, `status`, `batch`, `usersubmitted`, `note`, `external_batchid`)
VALUES
	(1,1,NULL,'12312345-999',433.00,'2011-08-01','asdf','jklj','lkj','klj','klj',NULL,'lkjlk','jl','kjlk','jlk','jlk','jlk',NULL,'jl','kjl','2011-08-01 04:29:40',2,0,NULL,3,'kj',NULL),
	(53,1,NULL,'003629-14402-004-05525223383',40.00,'2011-07-15','asdf','Santi Services (2007) Corporation','2384 Yonge. Street','Toronto','M4P 2J4','ON','N/A','','Argos Cleaners','n/a','n/a','n/a',NULL,'n/a','','2011-08-05 00:27:33',1,4,3,2,'',6567),
	(54,1,NULL,'003615-14402-004-05525223383',650.00,'2011-07-31','asdf','Santi Services (2007) Corporation','2384 Yonge. Street','Toronto','M4P 2J4','ON','N/A','','Argos Cleaners','n/a','n/a','n/a',NULL,'n/a','','2011-08-05 00:29:02',1,4,3,2,'',6568),
	(55,1,NULL,'003623-14402-004-05525223383',470.00,'2011-07-31','asdf','Santi Services (2007) Corporation','2384 Yonge. Street','Toronto','M4P 2J4','ON','N/A','','SMP Cleaning Services','n/a','n/a','n/a',NULL,'n/a','','2011-08-05 00:30:47',1,4,3,2,'',6569),
	(56,1,NULL,'000029-01932-004-01935220608',1455.00,'2011-07-22','asdf','Pro Restoration','754 Scarlett Rd','Toronto','M9P 2V1','ON','N/A','','Aim Restoration','n/a','n/a','n/a',NULL,'n/a','','2011-08-05 00:33:21',1,1,3,2,'',6570),
	(57,1,NULL,'008896-03022-010-1400711',796.72,'2011-07-28','asdf','Brimakel Masonry Ltd.','305 Iroquois  Ave.; Unit B','Mississauga','L5G 1M8','ON','n/a','','Michael S. Construction','3-741 Lawrence Ave. West','Toronto','M6A 1B7',NULL,'ON','','2011-08-05 00:36:20',1,1,3,2,'',6571),
	(59,1,NULL,'004380-00192-003-1061308',751.00,'2011-08-05','Royal Bank of Canada','Right-Fit Foam Insulation Ltd.','3000 Langstaff Rd; Unit 2','Concord, ON','L4K 4R7','ON','N/A','','LM General Work','n/a','N/A','n/a','n/a','n/a','','2011-08-06 19:58:10',1,1,4,2,'',7297),
	(60,1,NULL,'003432-06622-003-1011915',382.50,'2011-08-05','Royal Bank of Canada','Particular Janitorial Inc.','n/a','n/a','n/a','n/a','416 506 9371','','Numodas','n/a','N/A','n/a','n/a','n/a','','2011-08-06 20:01:01',1,1,4,2,'',7298),
	(61,1,NULL,'003431-06622-003-1011915',802.50,'2011-08-05','Royal Bank of Canada','Particular Janitorial Inc.','n/a','n/a','n/a','n/a','416 506 9371','','CYS Cleaning Services','n/a','n/a','n/a','n/a','N/A','','2011-08-06 20:04:41',1,1,4,2,'Inv. #101024',7299),
	(62,1,NULL,'009961-08642-010-1786210',682.50,'2011-07-23','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','First C General Services','n/a','n/a','n/a','n/a','n/a','','2011-08-06 20:07:57',1,1,4,2,'',7300),
	(63,1,NULL,'005837-63032-002-0118117',208.00,'2011-07-25','Scotiabank','Nosso Talho Partnership','1048 Bloor Street West','Toronto, ON','M6H 1M3','ON','416 531 7462','','Stop BBQ','n/a','n/a','n/a','n/a','n/a','','2011-08-06 20:13:09',1,1,4,2,'',7301),
	(64,1,NULL,'001336-05462-003-1004514',156.00,'2011-07-25','Royal Bank of Canada','Nosso Talho Partnership','1048 Bloor Street West','Toronto, ON','M6H 1M3','ON','416 531 7462','','Stop BBQ','n/a','n/a','n/a','n/a','n/a','','2011-08-06 20:42:21',1,1,4,2,'',7302),
	(65,1,NULL,'020786-06022-010-1110217',433.92,'2011-07-31','CIBC','Andorra Building Maintenance Ltd.','46 Chauncey Ave.','Etobicoke, ON','M8Z 2Z4','ON','n/a','','Braga Cleaning Services','433 Silverthorn Ave.','Toronto, ON','M6M 3H4','ON','n/a','','2011-08-06 20:46:46',1,1,4,2,'',7303),
	(66,1,NULL,'000800-06582-004-0658522835',332.03,'2011-08-04','TD Canada Trust','2189542 Ontario Inc.','n/a','n/a','n/a','n/a','n/a','','Ace Construction','n/a','n/a','n/a','n/a','n/a','','2011-08-06 20:50:47',1,4,4,2,'',7304),
	(67,1,NULL,'000807-06582-004-0658522835',1016.90,'2011-08-04','TD Canada Trust','2189542 Ontario Inc.','n/a','n/a','n/a','n/a','n/a','','MDF Construction','n/a','n/a','n/a','n/a','n/a','','2011-08-06 20:53:40',1,4,4,2,'',7305),
	(68,1,NULL,'000801-06582-004-0658522835',569.87,'2011-08-04','TD Canada Trust','2189542 Ontario Inc.','n/a','n/a','n/a','n/a','n/a','','Bethania Construction','n/a','n/a','n/a','n/a','n/a','','2011-08-06 20:55:40',1,4,4,2,'',7306),
	(69,1,NULL,'006841-00472-003-1011501',569.30,'2011-07-28','Royal Bank of Canada','Armand-Shel Investments Inc.','Best western Plus Milton Inn; Chisholm Dr.','Milton','L9T 4A6','ON','905 875 3818','','Top Skill International Training& Staffing','n/a','n/a','n/a','n/a','n/a','','2011-08-06 21:00:34',1,1,4,2,'',7307),
	(70,1,NULL,'007093-63032-002-0046817',744.92,'2011-06-30','Bank of Nova Scotia','JMCC Cleaning and Maintenance Services','n/a','n/a','n/a','n/a','n/a','','Santi Services (2007) Corporation','220 Woolner Ave., Sutie 607','Toronto, ON','M6N 1Y6','ON','N/A','','2011-08-06 21:03:47',1,4,4,2,'',7308),
	(71,1,NULL,'006431-05592-003-1036847',1260.00,'2011-07-31','Royal Bank of Canada','Veria Building Maintenance Inc.','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','ON','n/a','','Maxximous Services','n/a','n/a','n/a','n/a','n/a','','2011-08-06 21:16:41',1,1,4,2,'',7309),
	(72,1,NULL,'017741-02742-010-9602313',829.50,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','AAG General Services','133 Mulock Ave.','Toronto, ON','M6N 3C5','ON','n/a','','2011-08-06 21:20:54',1,1,4,2,'',7310),
	(73,1,NULL,'017705-02742-010-9602313',440.00,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Pequena Lulu ','107-1441 Lawrence Ave. East','Toronto, ON','M4A 1W3','ON','n/a','','2011-08-06 21:24:45',1,1,4,2,'',7311),
	(74,1,NULL,'017665-02742-010-9602313',1017.55,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Wonder General Services','158 Emerson Street','Toronto, ON','M6H 3T4','ON','n/a','','2011-08-06 21:26:48',1,1,4,2,'',7312),
	(75,1,NULL,'017409-02742-010-9602313',273.20,'2011-07-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Jona\'s Services','1965 Weston Rd','Toronto, ON','M9N 8P3','ON','n/a','','2011-08-06 21:30:36',1,1,4,2,'',7313),
	(76,1,NULL,'017689-02742-010-9602313',900.00,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Cristiano Rfc','530-2700 Lawrence ','Toronto, ON','M1P 2S5','ON','n/a','','2011-08-06 21:33:56',1,1,4,2,'',7314),
	(77,1,NULL,'017647-02742-010-9602313',1000.00,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','AAG General Services','133 Mulock Ave.','Toronto, ON','M6N 3C5','ON','n/a','','2011-08-06 21:36:15',1,1,4,2,'ARLEY GLORIA',7315),
	(78,1,NULL,'017663-02742-010-9602313',1218.55,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Isabel Cleaning ','2 Avalon ','Toronto, ON','M6N 4V5','n/a','n/a','','2011-08-06 21:39:28',1,1,4,2,'',7316),
	(79,1,NULL,'017646-02742-010-9602313',1072.50,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Yunka ','404-1A Bansley  Ave.','Toronto, ON','M6E 2A1','ON','n/a','','2011-08-06 21:41:51',1,1,4,2,'',7317),
	(80,1,NULL,'017716-02742-010-9602313',360.00,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Seybe ','1967 Dufferin St.','Toronto, ON','M3E 3P8','ON','n/a','','2011-08-06 21:43:55',1,1,4,2,'',7318),
	(81,1,NULL,'017707-02742-010-9602313',1124.00,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','AAG General Services','133 Mulock Ave.','Toronto, ON','M6N 3C5','ON','n/a','','2011-08-06 21:45:44',1,1,4,2,'Noe Alberto Juarez',7319),
	(82,1,NULL,'017697-02742-010-9602313',944.00,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Ariad General Services','3-34 Nair Ave.','Toronto, ON','M6E 4G7','ON','n/a','','2011-08-06 21:47:23',1,1,4,2,'',7320),
	(83,1,NULL,'017616-02742-010-9602313',577.50,'2011-07-19','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','AAG General Services','133 Mulock Ave.','Toronto, ON','M6N 3C5','ON','n/a','','2011-08-06 21:50:06',1,1,4,2,'',7321),
	(84,1,NULL,'017680-02742-010-9602313',1072.50,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','J.J.G General Service','175 Rankin Crescent','Toronto, ON','M3N 3H2','ON','n/a','','2011-08-06 21:54:59',1,1,4,2,'',7322),
	(85,1,NULL,'017643-02742-010-9602313',832.75,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Los Remedios','811-390 Dawes Rd','Toronto, ON','M4B 2E5','ON','n/a','','2011-08-06 21:56:40',1,1,4,2,'',7323),
	(86,1,NULL,'017662-02742-010-9602313',1072.40,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Fernandel Studio','401-26 Gulliver Rd','Toronto, ON','M6M 2M8','ON','n/a','','2011-08-06 21:58:29',1,1,4,2,'',7324),
	(87,1,NULL,'017685-02742-010-9602313',922.50,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Lima Cleaning Services','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:00:23',1,1,4,2,'',7325),
	(88,1,NULL,'006407-05592-003-1036847',855.00,'2011-07-31','Royal Bank of Canada','Veria Building Maintenance Inc.','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','ON','n/a','','Heidy\'s Cleaner Maintenance','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:03:07',1,1,4,2,'',7326),
	(89,1,NULL,'006413-05592-003-1036847',720.00,'2011-07-31','Royal Bank of Canada','Veria Building Maintenance Inc.','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','ON','n/a','','Eminico Services','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:04:43',1,1,4,2,'',7327),
	(90,1,NULL,'006467-05592-003-1036847',915.00,'2011-07-31','Royal Bank of Canada','Veria Building Maintenance Inc.','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','ON','n/a','','Jona\'s Services','1965 Weston Rd','Toronto, ON','M9N 8P3','ON','n/a','','2011-08-06 22:05:51',1,1,4,2,'',7328),
	(91,1,NULL,'006461-05592-003-1036847',1139.00,'2011-07-31','Royal Bank of Canada','Veria Building Maintenance Inc.','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','ON','n/a','','Rivera Group','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:07:44',1,1,4,2,'',7329),
	(92,1,NULL,'006415-05592-003-1036847',1148.00,'2011-07-31','Royal Bank of Canada','Veria Building Maintenance Inc.','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','ON','n/a','','Isabel Cleaning ','2 Avalon ','Toronto, ON','M6N 4V5','ON','n/a','','2011-08-06 22:09:00',1,1,4,2,'',7330),
	(93,1,NULL,'006455-05592-003-1036847',1230.00,'2011-07-31','CIBC','Veria Building Maintenance Inc.','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','ON','n/a','','Zapata Group','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:10:28',1,1,4,2,'',7331),
	(94,1,NULL,'006479-05592-003-1036847',1452.00,'2011-07-31','Royal Bank of Canada','Veria Building Maintenance Inc.','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','ON','n/a','','John Majia Cleaning Services','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:11:58',1,1,4,2,'',7332),
	(95,1,NULL,'006421-05592-003-1036847',769.00,'2011-07-31','Royal Bank of Canada','Veria Building Maintenance Inc.','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','ON','n/a','','Navy Multi Services','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:13:30',1,1,4,2,'',7333),
	(96,1,NULL,'006469-05592-003-1036847',1320.00,'2011-07-31','Royal Bank of Canada','Veria Building Maintenance Inc.','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','ON','n/a','','Pinzon Cleaner','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:15:04',1,1,4,2,'',7334),
	(97,1,NULL,'006471-05592-003-1036847',1015.00,'2011-08-06','Royal Bank of Canada','Veria Building Maintenance Inc.','879 O\'Connor Dr.','Toronto, ON','M4B 2S7','ON','n/a','','MAF General Services','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:30:10',1,1,4,2,'',7335),
	(98,1,NULL,'000793-06582-004-0658522835',359.00,'2011-07-28','TD Canada Trust','2189542 Ontario Inc.','n/a','n/a','n/a','n/a','n/a','','Bethania Construction','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:31:33',1,4,4,2,'',7336),
	(99,1,NULL,'000792-06582-004-0658522835',867.48,'2011-07-28','TD Canada Trust','2189542 Ontario Inc.','n/a','n/a','n/a','n/a','n/a','','Ace Construction','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:33:07',1,4,4,2,'',7337),
	(100,1,NULL,'000523-17362-004-05885223766',819.00,'2011-07-29','TD Canada Trust','Green Valley Landscaping Inc.','77 Burlington St.','Etobicoke, ON','M8V 3W1','ON','n/a','','Euro Landscaping','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:35:48',1,1,4,2,'',7338),
	(101,1,NULL,'000333-06302-003-1062991',345.00,'2011-08-03','Royal Bank of Canada','Ferbel Cafe','32 Atomic Ave.','Toronto, ON','M8Z 5L1','ON','n/a','','Stop BBQ','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:39:05',1,1,4,2,'',7339),
	(102,1,NULL,'000242-81182-002-0041017',1320.00,'2011-08-04','Bank of Nova Scotia','Total Bricklayers Inc. ','1238 Dundas St.W','Toronto, ON','M6J 1X5','ON','n/a','','Magana Brick','565 Sherbourne ','Toronto, ON','M4X 1W7','ON','n/a','','2011-08-06 22:47:02',1,1,4,2,'',7340),
	(103,1,NULL,'000243-81182-002-0041017',1456.00,'2011-08-04','Bank of Nova Scotia','Total Bricklayers Inc. ','1238 Dundas St.W','Toronto, ON','M6J 1X5','ON','n/a','','JS Brick','326 Campbell ','Toronto, ON','M6P 3V9','ON','n/a','','2011-08-06 22:50:06',1,1,4,2,'',7341),
	(104,1,NULL,'000240-81182-004-0041017',960.00,'2011-07-28','Bank of Nova Scotia','Total Bricklayers Inc. ','1238 Dundas St.W','Toronto, ON','M6J 1X5','ON','n/a','','JS Brick','326 Campbell ','Toronto, ON','M6P 3V9','ON','n/a','','2011-08-06 22:52:51',1,4,4,2,'',7342),
	(105,1,NULL,'000241-81182-002-0041017',742.50,'2011-07-28','Bank of Nova Scotia','Total Bricklayers Inc. ','1238 Dundas St.W','Toronto, ON','M6J 1X5','ON','n/a','','Magana Brick','565 Sherbourne ','Toronto, ON','M4X 1W7','ON','n/a','','2011-08-06 22:54:43',1,1,4,2,'',7343),
	(106,1,NULL,'009960-08642-010-1786210',611.00,'2011-07-23','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Petunia Gral. Services','n/a','n/a','n/a','n/a','n/a','','2011-08-06 22:57:39',1,1,4,2,'',7344),
	(107,1,NULL,'009921-08642-010-1786210',591.50,'2011-07-16','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Petunia Gral. Services','n/a','n/a','n/a','ON','n/a','','2011-08-06 22:59:55',1,1,4,2,'',7345),
	(108,1,NULL,'010849-18902-004-18905264121',375.00,'2011-07-31','TD Canada Trust','Brownstone masonry Inc. ','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','ON','n/a','','CAV Brick','8821 Weston Rd,','Woodbridge, ON','L4L 1A6','ON','n/a','','2011-08-06 23:03:34',1,1,4,2,'',7346),
	(109,1,NULL,'007077-63032-002-0046817',611.32,'2011-07-31','Bank of Nova Scotia','JMCC Cleaning and Maintenance Services','n/a','n/a','n/a','n/a','n/a','','Dylhi Services','640 Lauder Ave.','Toronto, ON','M6E 3K1','ON','n/a','','2011-08-06 23:05:38',1,4,4,2,'',7347),
	(110,1,NULL,'007056-63032-002-0046817',851.67,'2011-07-31','Bank of Nova Scotia','JMCC Cleaning and Maintenance Services','n/a','n/a','n/a','ON','n/a','','Rita General Services','161 William Street- BSMT','Toronto, ON','M9N 2G9','ON','n/a','','2011-08-06 23:08:07',1,4,4,2,'',7348),
	(111,1,NULL,'007064-63032-002-0046817',1415.97,'2011-07-31','Bank of Nova Scotia','JMCC Cleaning and Maintenance Services','n/a','n/a','n/a','n/a','n/a','','Roherma General Services','103 Kennard Avenue','Toronto, ON','M3H 4M3','ON','n/a','','2011-08-06 23:09:58',1,4,4,2,'',7349),
	(112,1,NULL,'004362-10402-004-05035209666',1220.00,'2011-08-03','TD Canada Trust','Ingerv Cleaner Company Ltd.','n/a','n/a','n/a','n/a','416 897 7935','','Willowdale Maintenance ','n/a','n/a','n/a','n/a','n/a','','2011-08-06 23:13:41',1,1,4,2,'',7350),
	(113,1,NULL,'000414-00192-003-1011949',900.00,'2011-08-03','Royal Bank of Canada','Goldcrest Drywall & Acoustics','3120 Rutherford Rd. 13-307','Concord, ON','L4K 0B2','ON','416 630 7800','','Prise- Franc Company','n/a','n/a','n/a','n/a','n/a','','2011-08-06 23:16:28',1,1,4,2,'',7351),
	(114,1,NULL,'013825-12772-004-06985230457',1088.75,'2011-08-04','TD Canada Trust','Aragon Building Maintenance ','55 Torbay Road, Unit #6','Markham, ON','L3R 1G7','ON','905 948 1400','','Red Hood Services','291 Wychwood Ave.','Toronto, ON','M6C 2T6','ON','n/a','','2011-08-06 23:19:41',1,1,4,2,'',7352),
	(115,1,NULL,'007324-05462-003-1000025',665.28,'2011-07-20','Royal Bank of Canada','Acura Maintenance Service Ltd.','4739 Rathkeale Rd','Mississauga, ON','L5V 1K3','ON','n/a','','LM General Work','265 Main Street, # 109','Toronto, ON','M4C 4X3','ON','n/a','','2011-08-06 23:26:05',1,1,4,2,'',7353),
	(116,1,NULL,'002335-74856-002-0000213',896.00,'2011-07-30','Bank of Nova Scotia','Premium Decorating Services Ltd.  ','Premium Painting ','n/a','n/a','n/a','n/a','','Ram Painting ','n/a','n/a','n/a','n/a','n/a','','2011-08-06 23:30:26',1,1,4,2,'',7354),
	(117,1,NULL,'019694-07962-010-5312817',265.23,'2011-07-15','CIBC','Asbury Building Services','323 Evans Ave.','Toronto, ON','M8Z 1K2','ON','416 620 5513','','Isabel Cleaning Services','2 Avalon ','Toronto, ON','M6N 4V5','ON','n/a','','2011-08-06 23:33:09',1,1,4,2,'',7355),
	(118,1,NULL,'000508-14712-004-14715215245',1350.00,'2011-08-04','TD Canada Trust','Stoneland Masonry Ltd.','1238 Dundas St.W','Toronto, ON','M6J 1X5','ON','n/a','','D.H Brick ','59 Goldboro','Toronto, ON','M9L 1A6','ON','n/a','','2011-08-06 23:36:05',1,1,4,2,'',7356),
	(119,1,NULL,'193-07472-003-5074356',1260.00,'2011-07-28','Royal Bank of Canada','Arnoldo De Oliveira ','Ana Couto ; 47 Ulson Dr.','Richmond Hill, ON','L4E 4W3','ON','n/a','','Sanchez Drywall','n/a','n/a','n/a','n/a','n/a','','2011-08-09 18:30:38',1,2,5,2,'',7923),
	(120,1,NULL,'001231-00364-003-1023290',913.00,'2011-07-31','Royal Bank of Canada','Peter Caltsoudas- Odyssey Janitorial Services','n/a','n/a','n/a','n/a','n/a','','Coliat General Services','n/a','n/a','n/a','n/a','n/a','','2011-08-09 18:33:09',1,2,5,2,'',7924),
	(121,1,NULL,'013799-12772-004-06985230457',1198.75,'2011-08-04','TD Canada Trust','Aragon Building Maintenance ','55 Torbay Road, Unit #6','Markham, ON','L3R 1G7','ON','905 948 1400','','Global Maintenance Services Co.','1635 Dufferin St.','Toronto, ON','M6H 3L9','ON','n/a','','2011-08-09 18:35:37',1,2,5,2,'',7925),
	(122,1,NULL,'013749-12772-004-06985230457',1056.00,'2011-07-21','TD Canada Trust','Aragon Building Maintenance ','55 Torbay Road, Unit #6','Markham, ON','L3R 1G7','ON','905 948 1400','','We Clean Blue ','652 Crawford St.','Toronto, ON','M6G 3K2','ON','n/a','','2011-08-09 18:37:49',1,2,5,2,'',7926),
	(123,1,NULL,'013803-12772-004-06985230457',787.50,'2011-08-04','TD Canada Trust','Aragon Building Maintenance ','55 Torbay Road, Unit #6','Markham, ON','L3R 1G7','ON','905 948 1400','','Jeka Company ','1249 College St','Toronto, ON','M6H 1C2','ON','n/a','','2011-08-09 18:40:05',1,2,5,2,'Hanna',7927),
	(124,1,NULL,'013835-12772-004-06985230457',976.50,'2011-08-04','TD Canada Trust','Aragon Building Maintenance ','55 Torbay Road, Unit #6','Markham, ON','L3R 1G7','ON','905 948 1400','','Racoon\'s Cleaning','182 Prescott Avenue','Toronto, ON','M6N 3H1','ON','n/a','','2011-08-09 18:41:46',1,2,5,2,'',7928),
	(125,1,NULL,'013788-12772-004-06985230457',990.00,'2011-08-04','TD Canada Trust','Aragon Building Maintenance ','55 Torbay Road, Unit #6','Markham, ON','L3R 1G7','ON','905 948 1400','','Chilo Cleaning','74 Lappin ','Toronto, ON','M6H 1Y4','ON','n/a','','2011-08-09 18:43:22',1,2,5,2,'',7929),
	(126,1,NULL,'013657-12772-004-06985230457',495.00,'2011-07-07','TD Canada Trust','Aragon Building Maintenance ','55 Torbay Road, Unit #6','Markham, ON','L3R 1G7','ON','905 948 1400','','Jona\'s Services','1965 Weston Rd','Toronto, ON','M9N 8P3','ON','n/a','','2011-08-09 18:44:31',1,2,5,2,'',7930),
	(127,1,NULL,'000993-17042-004-15845236812',990.00,'2011-08-05','TD Canada Trust','Alcover Roofing Inc. ','107 Shorncliffe Rd.','Etobicoke, ON','M8Z 5K7','ON','n/a','','Yoxo Roofing','n/a','n/a','n/a','n/a','n/a','','2011-08-09 18:46:43',1,4,5,2,'',7931),
	(128,1,NULL,'001485-04362-001-1050415',597.77,'2011-08-04','Bank of Montreal','Capital Restoration Ltd.','4936 Yonge St.; Suite 179','Toronto, ON','M2N 6S3','ON','416 702 5502','','H.C General Construction','n/a','n/a','n/a','n/a','n/a','','2011-08-09 18:50:04',1,2,5,2,'invoice no. 175251',7932),
	(129,1,NULL,'001479-04362-001-1050415',1039.60,'2011-07-29','Bank of Montreal','Capital Restoration Ltd.','4936 Yonge St.; Suite 179','Toronto, ON','M2N 6S3','ON','416 702 5502','','Rogel Construction & Balconies','n/a','n/a','n/a','n/a','n/a','','2011-08-09 18:52:42',1,2,5,2,'',7933),
	(130,1,NULL,'017706-02742-010-9602313',1071.50,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','ON','n/a','','Quijano','468 Vaughan Rd','Toronto, ON','M6C 2P7','ON','n/a','','2011-08-09 18:56:38',1,2,5,2,'',7934),
	(131,1,NULL,'017641-02742-010-9602313',837.53,'2011-08-01','CIBC','Whiterose Janitorial Services Ltd.','n/a','n/a','n/a','n/a','n/a','','Cleaning Group','B-1003 Weston Rd','Toronto, ON','M6N 3R9','ON','n/a','','2011-08-09 18:59:26',1,2,5,2,'',7935),
	(132,1,NULL,'022629-04182-001-1071841',800.28,'2011-07-27','Bank of Montreal','Eileen Roofing Inc. ','1825 Wilson Ave.','Toronto, ON','M9M 1A2','ON','416 762 1819','','Mexicaly Roofing ','281 Wallace Ave.','Toronto, ON','M6E 3N2','ON','n/a','','2011-08-09 19:02:42',1,2,5,2,'',7936),
	(133,1,NULL,'022695-04182-001-1071841',558.52,'2011-08-03','Bank of Montreal','Eileen Roofing Inc. ','1825 Wilson Ave.','Toronto, ON','M9M 1A2','ON','416 762 1819','','Mexicaly Roofing ','281 Wallace Ave.','Toronto, ON','M6E 3N2','ON','n/a','','2011-08-09 19:04:09',1,2,5,2,'',7937),
	(134,1,NULL,'009956-08642-010-1786210',564.00,'2011-07-23','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Newsells Old Boys Company','1206-20 Stonehill Court','Toronto, ON','n/a','ON','n/a','','2011-08-09 19:06:03',1,2,5,2,'',7938),
	(135,1,NULL,'009990-08642-010-1786210',756.00,'2011-07-30','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Jino General Services','8 Laxis Ave.','Toronto, ON','M6M 2K5','ON','n/a','','2011-08-09 19:07:39',1,2,5,2,'',7939),
	(136,1,NULL,'009994-08642-010-1786210',845.00,'2011-07-30','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Jino General Services','8 Laxis Ave.','Toronto, ON','M6M 2K5','ON','n/a','','2011-08-09 19:08:40',1,2,5,2,'',7940),
	(137,1,NULL,'009991-08642-010-1786210',1007.25,'2011-07-30','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Jino General Services','8 Laxis Ave.','Toronto, ON','M6M 2K5','ON','n/a','','2011-08-09 19:09:48',1,2,5,2,'',7941),
	(138,1,NULL,'009954-08642-010-1786210',824.00,'2011-07-23','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','L & P Gral Services','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:11:26',1,2,5,2,'',7942),
	(139,1,NULL,'009981-08642-010-1786210',788.00,'2011-07-30','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','L & P Gral Services','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:14:35',1,2,5,2,'',7943),
	(140,1,NULL,'009980-08642-010-1786210',791.25,'2011-07-30','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','L & P Gral Services','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:16:15',1,2,5,2,'',7944),
	(141,1,NULL,'009996-08642-010-1786210',388.50,'2011-07-30','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Andes Service','407-685 Finch Ave. West','Toronto, ON','M2R 1P2','ON','n/a','','2011-08-09 19:18:04',1,2,5,2,'',7945),
	(142,1,NULL,'009987-08642-010-1786210',695.50,'2011-07-30','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Petunia Gral. Services','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:19:46',1,2,5,2,'',7946),
	(143,1,NULL,'009963-08642-010-1786210',1111.25,'2011-07-23','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Medios Jarros Gral. Services','605-829 Birchmount','Scarborough, ON','n/a','ON','n/a','','2011-08-09 19:21:30',1,2,5,2,'',7947),
	(144,1,NULL,'009962-08642-010-1786210',661.50,'2011-07-23','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Medios Jarros Gral. Services','605-829 Birchmount','Scarborough, ON','n/a','n/a','n/a','','2011-08-09 19:22:40',1,2,5,2,'',7948),
	(145,1,NULL,'009989-08642-010-1786210',927.50,'2011-07-30','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Medios Jarros Gral. Services','605-829 Birchmount','Scarborough, ON','n/a','n/a','n/a','','2011-08-09 19:24:13',1,2,5,2,'',7949),
	(146,1,NULL,'009992-08642-010-1786210',777.00,'2011-07-30','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Medios Jarros Gral. Services','605-829 Birchmount','Scarborough, ON','n/a','n/a','n/a','','2011-08-09 19:25:11',1,2,5,2,'',7950),
	(147,1,NULL,'000827-13362-004-05355213081',904.00,'2011-08-05','TD Canada Trust','Abassco Renovations Inc.','n/a','n/a','n/a','n/a','n/a','','The Girls Flooring ','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:27:32',1,2,5,2,'',7951),
	(148,1,NULL,'000066-36592-004-36595212226',783.00,'2011-08-04','TD Canada Trust','P & G Brothers Painting','502 Brookmill Cres.','Waterloo, ','N2V 2M1','ON','n/a','','The Girls Flooring ','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:29:55',1,2,5,2,'',7952),
	(149,1,NULL,'000045-01932-004-01935220608',1309.50,'2011-08-05','TD Canada Trust','Pro Restoration','754 Scarlett Rd','Toronto, ON','M9P 2V1','ON','N/A','','Aim Restoration','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:31:40',1,2,5,2,'',7953),
	(150,1,NULL,'001167-91702-002-0250414',1066.00,'2011-08-05','Bank of Nova Scotia','Kazemi Enterprises Inc.','19 Kimberly Court','Richmond Hill, ON','L4E 4C6','ON','905 292 0669','','Panther Cleaning Services','395 Arlington Ave.','Toronto, ON','M6C 3A1','ON','n/a','','2011-08-09 19:35:45',1,2,5,2,'',7954),
	(151,1,NULL,'004314-10402-004-05035209666',950.00,'2011-07-22','TD Canada Trust','Ingerv Cleaner Company Ltd.','n/a','n/a','n/a','n/a','416 897 7935','','SRL ','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:37:30',1,2,5,2,'',7955),
	(152,1,NULL,'010992-06772-004-84625005952',567.00,'2011-07-30','TD Canada Trust','Stonehouse Masonry Ltd.','103 Clyde Ave.','Toronto, ON','M5M 4G5','ON','n/a','','Manuel Alves Contraction','189 Bellwoods Ave.','Toronto, ON','M6J 2R3','ON','n/a','','2011-08-09 19:40:24',1,2,5,2,'',7956),
	(153,1,NULL,'004182-10562-016-157514001',1260.00,'2011-07-27','HSBC BANK Canada','1781027 Ontario Ltd. ','2900 Langstaff Road, Unit 11','Concord, ON','L4K 4R9','ON','n/a','','NC Brick','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:43:11',1,2,5,2,'',7957),
	(154,1,NULL,'004207-10562-016-157514001',1395.00,'2011-08-03','HSBC BANK Canada','1781027 Ontario Ltd. ','2900 Langstaff Road, Unit 11','Concord, ON','L4K 4R9','ON','n/a','','NC Brick','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:45:50',1,2,5,2,'',7958),
	(155,1,NULL,'004179-10562-016-157514001',575.00,'2011-07-27','HSBC BANK Canada','1781027 Ontario Ltd. ','2900 Langstaff Road, Unit 11','Concord, ON','L4K 4R9','ON','n/a','','Brick Silva','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:47:40',1,2,5,2,'',7959),
	(156,1,NULL,'004215-10562-016-157514001',1112.50,'2011-08-03','HSBC BANK Canada','1781027 Ontario Ltd. ','2900 Langstaff Road, Unit 11','Concord, ON','L4K 4R9','ON','n/a','','Brick Silva','n/a','n/a','n/a','n/a','n/a','','2011-08-09 19:49:15',1,2,5,2,'',7960),
	(157,1,NULL,'018949-81182-002-0038911',495.39,'2011-08-05','Scotiabank','TONAR','1357 Dundas St.W','Toronto, ON','M6J 1Y3','ON','n/a','','1834948 Ontario Inc. ','996 Vickerman Way','Milton, ON','L9T 0J6','ON','n/a','','2011-08-09 19:52:20',1,3,5,2,'',NULL),
	(158,1,NULL,'017087-01182-003-1002211',1293.75,'2011-08-05','Royal Bank of Canada','Custom Renovations Ltd. ','3265 Wharton Way ;Unit 17','Mississauga, ON','L4X 2X9','ON','905 282 0666','','Igen Services','2677 Eglington Ave. West; Unit 14','Toronto, ON','M6M 1T8','ON','n/a','','2011-08-09 19:58:17',1,2,5,2,'',7961),
	(159,1,NULL,'000847-17042-004-05845253067',465.30,'2011-08-05','TD Canada Trust','Xpert Tech Roofing Systems Inc. ','n/a','n/a','n/a','n/a','n/a','','T.J.S. Roofing','n/a','n/a','n/a','n/a','n/a','','2011-08-09 20:00:40',1,2,5,2,'',7962),
	(160,1,NULL,'000845-17042-004-05845253067',574.20,'2011-08-05','TD Canada Trust','Xpert Tech Roofing Systems Inc. ','n/a','n/a','n/a','n/a','n/a','','Skyline Roofing ','12-172 Vaughan Rd.','Toronto, ON','M6C 2M3','ON','n/a','','2011-08-09 20:02:46',1,2,5,2,'',7963),
	(161,1,NULL,'000848-17042-004-05845253067',939.36,'2011-08-05','TD Canada Trust','Xpert Tech Roofing Systems Inc. ','n/a','n/a','n/a','n/a','n/a','','Jay\'s Roofing','62 William Cragg Dr. ','North York, ON','M3M 1V2','ON','n/a','','2011-08-09 20:04:45',1,2,5,2,'',7964),
	(162,1,NULL,'000846-17042-004-05845253067',680.40,'2011-08-05','TD Canada Trust','Xpert Tech Roofing Systems Inc. ','n/a','n/a','n/a','n/a','n/a','','Syntex Roofing','n/a','n/a','n/a','n/a','n/a','','2011-08-09 20:06:09',1,2,5,2,'',7965),
	(163,1,NULL,'000356-27972-001-1003837',647.50,'2011-08-04','Bank of Montreal','2228169 Ontario Ltd','726 Brock Ave.','Toronto, ON','M6H 3P2','ON','n/a','','Oscar Santiago Brick','68 Turntable Cres.','Toronto, ON','M6H 4K9','ON','n/a','','2011-08-09 20:09:39',1,2,5,2,'',7966),
	(164,1,NULL,'000358-27972-001-1003837',525.00,'2011-08-04','Bank of Montreal','2228169 Ontario Ltd','726 Brock Ave.','Toronto, ON','M6H 3P2','ON','n/a','','Ramos Brick ','330 Steeles Ave.','Thornhill, ON','L4J 6W9','ON','n/a','','2011-08-09 20:12:07',1,2,5,2,'',7967),
	(165,1,NULL,'000354-27972-001-1003837',542.50,'2011-08-04','Bank of Montreal','2228169 Ontario Ltd','726 Brock Ave.','Toronto, ON','M6H 3P2','ON','n/a','','J Martins Brick','n/a','n/a','n/a','n/a','n/a','','2011-08-09 20:18:15',1,2,5,2,'',7968),
	(166,1,NULL,'000355-27972-001-1003837',490.00,'2011-08-04','Bank of Montreal','2228169 Ontario Ltd','726 Brock Ave.','Toronto, ON','M6H 3P2','ON','n/a','','E Tiburcio Brick','n/a','n/a','n/a','n/a','n/a','','2011-08-09 20:20:05',1,2,5,2,'',7969),
	(167,1,NULL,'009955-08642-010-1786210',611.00,'2011-07-23','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Newsells Old Boys Company','1206-20 Stonehill Court','Toronto, ON','n/a','ON','n/a','','2011-08-09 20:21:36',1,2,5,2,'',7970),
	(168,1,NULL,'009983-08642-010-1786210',618.00,'2011-07-30','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Newsells Old Boys Company','1206-20 Stonehill Court','Toronto, ON','n/a','n/a','n/a','','2011-08-09 20:22:48',1,2,5,2,'',7971),
	(169,1,NULL,'016834-00042-837-0394935111',1370.54,'2011-08-04','Meridian Credit Union','Limen Restoration Ltd.','72  Ashwarren Rd','Toronto, ON','M3J 1Z5','ON','n/a','','Lines and Levels Masonry','141 RR1 ','Warkworth, ON','K0K 3K0','ON','n/a','','2011-08-09 20:26:27',1,2,5,2,'',7972),
	(170,1,NULL,'010862-18902-004-18905264121',316.00,'2011-07-27','TD Canada Trust','Brownstone masonry Inc. ','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','ON','n/a','','MBC Contracting','n/a','n/a','n/a','n/a','n/a','','2011-08-09 20:28:16',1,2,5,2,'',7973),
	(171,1,NULL,'010802-18902-004-18905264121',600.00,'2011-07-27','TD Canada Trust','Brownstone masonry Inc. ','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','ON','n/a','','CAV Brick','8821 Weston Rd,','Woodbridge, ON','L4L 1A6','ON','n/a','','2011-08-09 20:29:46',1,2,5,2,'',7974),
	(172,1,NULL,'010801-18902-004-18905264121',768.00,'2011-07-27','TD Canada Trust','Brownstone masonry Inc. ','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','ON','n/a','','Montes Brick','284 Earlscourt','Toronto, ON','M6E 4B8','ON','n/a','','2011-08-09 20:32:42',1,2,5,2,'',7975),
	(173,1,NULL,'010848-18902-004-18905264121',731.00,'2011-07-31','TD Canada Trust','Brownstone masonry Inc. ','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','ON','n/a','','Montes Brick','284 Earlscourt','Toronto, ON','M6E 4B8','ON','n/a','','2011-08-09 20:34:32',1,2,5,2,'',7976),
	(174,1,NULL,'010790-18902-004-18905264121',880.00,'2011-07-27','TD Canada Trust','Brownstone masonry Inc. ','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','ON','n/a','','T.F.E Construction','1-168 Oakwood Ave.','Toronto, ON','M6E 2T9','ON','n/a','','2011-08-09 20:36:24',1,2,5,2,'',7977),
	(175,1,NULL,'010837-18902-004-18905264121',758.00,'2011-07-31','TD Canada Trust','Brownstone masonry Inc. ','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','ON','n/a','','T.F.E Construction','1-168 Oakwood Ave.','Toronto, ON','M6E 2T9','ON ','n/a','','2011-08-09 20:37:41',1,2,5,2,'',7978),
	(176,1,NULL,'010803-18902-004-18905264121',816.00,'2011-07-27','TD Canada Trust','Brownstone masonry Inc. ','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','ON','n/a','','Anthony Construction','202-1170 Bay St.','Toronto, ON','M5S 2B4','ON','n/a','','2011-08-09 20:39:20',1,2,5,2,'',7979),
	(177,1,NULL,'010850-18902-004-18905264121',760.00,'2011-07-31','TD Canada Trust','Brownstone masonry Inc. ','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','ON','n/a','','Anthony Construction','202-1170 Bay St.','Toronto, ON','M5S 2B4','ON','n/a','','2011-08-09 20:40:33',1,2,5,2,'',7980),
	(178,1,NULL,'010799-18902-004-18905264121',1024.00,'2011-07-27','TD Canada Trust','Brownstone masonry Inc. ','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','ON','n/a','','Y.D Renovations','205-25 Guilliver Rd','Toronto, ON','M6M 2M5','ON','n/a','','2011-08-09 20:42:15',1,2,5,2,'',7981),
	(179,1,NULL,'010846-18902-004-18905264121',375.00,'2011-07-31','TD Canada Trust','Brownstone masonry Inc. ','120 Woodstream Blvd.; Unit 11','Woodbridge, ON','L4L 7Z1','ON','n/a','','Y.D Renovations','205-25 Guilliver Rd','Toronto, ON','M6M 2M5','ON','n/a','','2011-08-09 20:43:28',1,2,5,2,'',7982),
	(180,1,NULL,'012491-18002-004-05975216106',1219.00,'2011-07-28','TD Canada Trust','Tops Agency Inc. ','n/a','n/a','n/a','n/a','416 661 7452','','Tilue Construction','n/a','n/a','n/a','n/a','N/A','','2011-08-09 20:47:53',1,2,5,2,'',7983),
	(181,1,NULL,'008500-09522-010-1802011',1261.50,'2011-07-28','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','Tilue Construction','n/a','n/a','n/a','n/a','N/A','','2011-08-09 20:50:04',1,2,5,2,'',7984),
	(182,1,NULL,'008499-09522-010-1802011',1188.00,'2011-07-28','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','Tilue Construction','n/a','n/a','n/a','n/a','N/A','','2011-08-09 20:51:21',1,2,5,2,'',7985),
	(183,1,NULL,'008565-09522-010-1802011',1207.50,'2011-08-04','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','Tilue Construction','n/a','n/a','n/a','n/a','N/A','','2011-08-09 20:52:56',1,2,5,2,'',7986),
	(184,1,NULL,'008559-09522-010-1802011',810.00,'2011-08-04','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','Tilue Construction','n/a','n/a','n/a','n/a','N/A','','2011-08-09 20:54:17',1,2,5,2,'',7987),
	(185,1,NULL,'008560-09522-010-1802011',594.50,'2011-08-04','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','Tilue Construction','n/a','n/a','n/a','n/a','N/A','','2011-08-09 20:57:03',1,2,5,2,'',7988),
	(186,1,NULL,'008537-09522-010-1802011',324.00,'2011-08-04','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','Jorge Gomes Construction','n/a','n/a','n/a','n/a','n/a','','2011-08-09 20:59:44',1,2,5,2,'',7989),
	(187,1,NULL,'008495-09522-010-1802011',957.00,'2011-07-28','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','OB Brick','n/a','n/a','n/a','n/a','n/a','','2011-08-09 21:01:55',1,2,5,2,'',7990),
	(188,1,NULL,'008496-09522-010-1802011',675.00,'2011-07-28','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','OB Brick','n/a','n/a','n/a','n/a','n/a','','2011-08-09 21:04:00',1,2,5,2,'',7991),
	(189,1,NULL,'008497-09522-010-1802011',1325.00,'2011-07-28','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','OB Brick','n/a','n/a','n/a','n/a','n/a','','2011-08-09 21:07:53',1,2,5,2,'',7992),
	(190,1,NULL,'008557-09522-010-1802011',711.00,'2011-08-04','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','OB Brick','n/a','n/a','n/a','n/a','n/a','','2011-08-09 21:12:38',1,2,5,2,'',7993),
	(191,1,NULL,'008558-09522-010-1802011',1200.00,'2011-08-04','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','OB Brick','n/a','n/a','n/a','n/a','n/a','','2011-08-09 21:14:31',1,2,5,2,'',7994),
	(192,1,NULL,'008556-09522-010-1802011',1212.50,'2011-08-04','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','OB Brick','n/a','n/a','n/a','n/a','n/a','','2011-08-09 21:16:34',1,2,5,2,'',7995),
	(193,1,NULL,'008555-09522-010-1802011',837.50,'2011-08-04','CIBC','Tops Agency Inc. ','314- 1315 Finch Ave.W','North York, ON','M3J 2G6','ON','416 661 7452','','OB Brick','n/a','n/a','n/a','n/a','n/a','','2011-08-09 21:18:09',1,2,5,2,'',7996),
	(194,1,NULL,'052069-10852-004-10850374495',775.89,'2011-07-30','TD Canada Trust','Maxum Drywall','40 Trowers Road, Unit 1','Woodbridge, ON','L4L 7K6','ON','n/a','','D.E.N','153 Perth Avenue','Toronto, ON','M6P 3X2','ON','n/a','','2011-08-09 21:35:11',1,2,5,2,'',7997),
	(195,1,NULL,'019693-07962-010-5312817',258.75,'2011-07-15','CIBC','Asbury Building Services','323 Evans Ave.','Toronto, ON','M8Z 1K2','ON','416 620 5513','','M & E Cleaning Services','n/a','n/a','n/a','n/a','n/a','','2011-08-09 21:38:26',1,2,5,2,'',7998),
	(196,1,NULL,'000496-14712-004-14715215245',1282.50,'2011-07-28','TD Canada Trust','Stoneland Masonry Ltd.','1238 Dundas St.W','Toronto, ON','M6J 1X5','ON','n/a','','D.H Brick ','59 Goldboro','Toronto, ON','M9L 1A6','ON','n/a','','2011-08-09 21:40:09',1,2,5,2,'',7999),
	(197,1,NULL,'016659-00042-837-0394935111',1464.12,'2011-07-28','Meridian Credit Union','Limen Restoration Ltd.','72  Ashwarren Rd','Toronto, ON','M3J 1Z5','ON','n/a','','Colorado Brick','470 Old Weston Rd.','Toronto, ON','M6N 3A9','ON','n/a','','2011-08-09 21:42:40',1,2,5,2,'',8000),
	(198,1,NULL,'016806-00042-837-0394935111',1350.05,'2011-08-04','Meridian Credit Union','Limen Restoration Ltd.','72  Ashwarren Rd','Toronto, ON','M3J 1Z5','ON','n/a','','Caledonia Brothers','9 Columbus St.','Toronto, ON','M6R 1S2','ON','n/a','','2011-08-09 21:45:25',1,2,5,2,'',8001),
	(199,1,NULL,'016808-00042-837-0394935111',1499.40,'2011-08-04','Meridian Credit Union','Limen Restoration Ltd.','72  Ashwarren Rd','Toronto, ON','M3J 1Z5','ON','n/a','','Colorado Brick','470 Old Weston Rd.','Toronto, ON','M6N 3A9','ON','n/a','','2011-08-09 21:47:00',1,2,5,2,'',8002),
	(200,1,NULL,'016833-00042-837-0394935111',1350.11,'2011-08-04','Meridian Credit Union','Limen Restoration Ltd.','72  Ashwarren Rd','Toronto, ON','M3J 1Z5','ON','n/a','','Lavs Masonry','286 Earlscourt Ave.','Toronto, ON','M6E 4B1','ON','n/a','','2011-08-09 21:50:40',1,2,5,2,'',8003),
	(201,1,NULL,'003325-06622-001-1016459',673.38,'2011-07-29','Bank of Montreal','Century Building Restoration Inc.','86 Ringwood Drive, Unit 205','Stouffville, ON','L4A 1C3','ON','n/a','','Wikueld ','25-1780 Wilson Ave.','Toronto, ON','M3L 1A9','ON','n/a','','2011-08-09 21:53:15',1,2,5,2,'',8004),
	(202,1,NULL,'003369-06622-001-1016459',495.36,'2011-08-05','Bank of Montreal','Century Building Restoration Inc.','86 Ringwood Drive, Unit 205','Stouffville, ON','L4A 1C3','ON','n/a','','Wikueld ','25-1780 Wilson Ave.','Toronto, ON','M3L 1A9','ON','n/a','','2011-08-09 21:54:51',1,2,5,2,'',8005),
	(203,1,NULL,'003317-06622-001-1016459',967.50,'2011-07-29','Bank of Montreal','Century Building Restoration Inc.','86 Ringwood Drive, Unit 205','Stouffville, ON','L4A 1C3','ON','n/a','','HM Construction','99 King Rd','Burlington, ON','L7T 3K4','ON','n/a','','2011-08-09 21:56:44',1,2,5,2,'',8006),
	(204,1,NULL,'003361-06622-001-1016459',967.50,'2011-08-05','Bank of Montreal','Century Building Restoration Inc.','86 Ringwood Drive, Unit 205','Stouffville, ON','L4A 1C3','ON','n/a','','HM Construction','99 King Rd','Burlington, ON','L7T 3K4','ON','n/a','','2011-08-09 21:58:04',1,2,5,2,'',8007),
	(205,1,NULL,'004217-10562-016-157514001',330.00,'2011-08-03','HSBC BANK Canada','1781027 Ontario Ltd. ','2900 Langstaff Road, Unit 11','Concord, ON','L4K 4R9','ON','n/a','','Mao Brick','51 Boon','Toronto, ON','M6E 3Z2','ON','n/a','','2011-08-09 22:00:00',1,2,5,2,'',8008),
	(206,1,NULL,'003295-06622-001-1016459',919.13,'2011-07-29','Bank of Montreal','Century Building Restoration Inc.','86 Ringwood Drive, Unit 205','Stouffville, ON','L4A 1C3','ON','n/a','','Gloria Construction','120 Pioneer Lane','Woodbridge, ON','L4L 2J1','ON','n/a','','2011-08-09 22:01:42',1,2,5,2,'',8009),
	(207,1,NULL,'003212-06622-001-1016459',772.07,'2011-07-15','Bank of Montreal','Century Building Restoration Inc.','86 Ringwood Drive, Unit 205','Stouffville, ON','L4A 1C3','ON','n/a','','Gloria Construction','120 Pioneer Lane','Woodbridge, ON','L4L 2J1','ON','n/a','','2011-08-09 22:04:08',1,2,5,2,'',8010),
	(208,1,NULL,'003381-06622-001-1016459',919.13,'2011-08-05','Bank of Montreal','Century Building Restoration Inc.','86 Ringwood Drive, Unit 205','Stouffville, ON','L4A 1C3','ON','n/a','','Gloria Construction','120 Pioneer Lane','Woodbridge, ON','L4L 2J1','ON','n/a','','2011-08-09 22:05:38',1,2,5,2,'',8011),
	(209,1,NULL,'003373-06622-001-1016459',1308.06,'2011-08-05','Bank of Montreal','Century Building Restoration Inc.','86 Ringwood Drive, Unit 205','Stouffville, ON','L4A 1C3','ON','n/a','','DCR Construction','1049 Weston Rd','York, ON ','M6N 3R9','ON','n/a','','2011-08-09 22:07:39',1,2,5,2,'',8012),
	(210,1,NULL,'009997-08642-010-1786210',1054.00,'2011-07-30','CIBC','Iberia Landscape Services Ltd.','14662 Hwy 48,','Stouffville, ON','L4A 7X3','ON','905 642 1354','','Jino General Services','8 Laxis Ave.','Toronto, ON','M6M 2K5','ON','n/a','','2011-08-09 22:08:59',1,2,5,2,'',8013),
	(211,1,NULL,'007320-05462-003-1000025',92.88,'2011-07-20','Royal Bank of Canada','Acura Maintenance Service Ltd.','4739 Rathkeale Rd','Mississauga, ON','L5V 1K3','ON','n/a','','Rahel Group','265 Main Street, # 109','Toronto, ON','M4C 4X3','ON','n/a','','2011-08-09 22:10:58',1,2,5,2,'',8014),
	(212,1,NULL,'007093-63032-002-0046817',744.92,'2011-06-30','Bank of Nova Scotia','JMCC Cleaning and Maintenance Services','n/a','n/a','n/a','n/a','n/a','','Villafuerte Construction','220 Woolner Ave., Sutie 607','Toronto, ON','M6N 1Y6','ON','n/a','','2011-08-30 15:08:14',1,0,6,2,'',NULL);

/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_permissions`;

CREATE TABLE `user_permissions` (
  `permid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(256) DEFAULT NULL,
  `userid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`permid`),
  KEY `FK_user_permissions` (`userid`),
  CONSTRAINT `FK_user_permissions` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user_permissions` WRITE;
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;

INSERT INTO `user_permissions` (`permid`, `role`, `userid`)
VALUES
	(1,'user',2),
	(2,'user',1),
	(3,'admin',3),
	(4,'admin',4),
	(5,'admin',6),
	(6,'admin',7),
	(7,'user',8),
	(8,'user',9),
	(9,'user',10);

/*!40000 ALTER TABLE `user_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table usergroups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usergroups`;

CREATE TABLE `usergroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` int(11) unsigned DEFAULT NULL,
  `userid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usergroups` (`groupid`),
  KEY `FK_usergroups2` (`userid`),
  CONSTRAINT `FK_usergroups` FOREIGN KEY (`groupid`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_usergroups2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `usergroups` WRITE;
/*!40000 ALTER TABLE `usergroups` DISABLE KEYS */;

INSERT INTO `usergroups` (`id`, `groupid`, `userid`)
VALUES
	(1,1,1),
	(2,1,2),
	(3,2,3),
	(4,2,4),
	(5,1,4),
	(6,4,8),
	(7,4,9),
	(9,4,10),
	(10,3,4),
	(11,4,4);

/*!40000 ALTER TABLE `usergroups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(26) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `firstname` varchar(256) DEFAULT NULL,
  `lastname` varchar(256) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `loginip` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `lastlogin`, `loginip`)
VALUES
	(1,'malcolm','bf251503bf68842545cd84a20d9ac43c','malcolm@ipayoptions.com','Malcolm','Ramsay','0000-00-00 00:00:00','59.167.216.98'),
	(2,'bparker','c795494bc3d4162966d766a5cec6db2b','bparker@ipayoptions.com','Bruce','Parker','0000-00-00 00:00:00','99.243.240.19'),
	(3,'admin','4b381c4105e2514df6ace099e3edf815','malcolm@ipayoptions.com','CDNCHQSRV','Admin','0000-00-00 00:00:00','209.148.220.74'),
	(4,'system','d83a1cbc22e89ee65397a5b25aefc4fe','system@ibanxprocessing.com','IBanx','System','0000-00-00 00:00:00','59.167.216.98'),
	(6,'arkcap','4966ca04cb8bd889b878c66358d2f7ba',NULL,'Ark','Cap','0000-00-00 00:00:00','59.167.216.98'),
	(7,'system2','f93dbbc2ae87260c3a3a202e5e15a1a0',NULL,'IBanx','System2',NULL,NULL),
	(8,'ib001','293b9920f6e1c176bd04aedff398c555',NULL,'IB','001',NULL,NULL),
	(9,'ib002','4fcc5d8602e9397ab4139caeccf61cb6',NULL,'IB','002',NULL,NULL),
	(10,'ib003','f68f88957d8aec8895f86cdae31e56a7',NULL,'IB','003','0000-00-00 00:00:00','59.167.216.98');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
