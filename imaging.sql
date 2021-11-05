/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.14-MariaDB : Database - imaging
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`imaging` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `imaging`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `imaging_bast` */

DROP TABLE IF EXISTS `imaging_bast`;

CREATE TABLE `imaging_bast` (
  `no_bast` varchar(20) DEFAULT NULL,
  `no_box` varchar(25) DEFAULT NULL,
  `pickupBy` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `imaging_bast` */

insert  into `imaging_bast`(`no_bast`,`no_box`,`pickupBy`,`created_at`,`created_by`) values ('743327','B-0001','Host','2021-06-16 12:56:59',NULL);

/*Table structure for table `imaging_counter` */

DROP TABLE IF EXISTS `imaging_counter`;

CREATE TABLE `imaging_counter` (
  `key` varchar(25) NOT NULL,
  `cntr` bigint(20) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `max_isi` int(11) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `imaging_counter` */

insert  into `imaging_counter`(`key`,`cntr`,`created_at`,`max_isi`) values ('no_box',0,'2021-04-05 15:30:20',10),('no_doc',0,'2021-04-05 15:30:23',NULL),('no_manifest',0,'2021-04-05 15:30:25',NULL);

/*Table structure for table `imaging_customer` */

DROP TABLE IF EXISTS `imaging_customer`;

CREATE TABLE `imaging_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_pic` varchar(25) DEFAULT NULL,
  `customer_add` varchar(500) DEFAULT NULL,
  `customer_telp` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `imaging_customer` */

insert  into `imaging_customer`(`id`,`customer_name`,`customer_pic`,`customer_add`,`customer_telp`,`created_at`,`updated_at`) values (1,'Pasific Life','Farhan','Cipinang s','021456789','2021-04-07 14:18:35','2021-05-03 09:47:18'),(3,'ABC','DEF','jl x','02154645','2021-05-04 01:16:26','2021-05-04 01:16:36');

/*Table structure for table `imaging_group` */

DROP TABLE IF EXISTS `imaging_group`;

CREATE TABLE `imaging_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `imaging_group` */

insert  into `imaging_group`(`id`,`group_name`,`created_at`) values (1,'Administrator',NULL),(2,'User',NULL);

/*Table structure for table `imaging_history_pos` */

DROP TABLE IF EXISTS `imaging_history_pos`;

CREATE TABLE `imaging_history_pos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_box` varchar(25) DEFAULT NULL,
  `pos_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `imaging_history_pos` */

/*Table structure for table `imaging_master` */

DROP TABLE IF EXISTS `imaging_master`;

CREATE TABLE `imaging_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `batch` int(11) DEFAULT NULL,
  `cycle` date DEFAULT NULL,
  `file_name_upload` varchar(150) DEFAULT NULL,
  `path_file_upload` varchar(250) DEFAULT NULL,
  `upload_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `imaging_master` */

insert  into `imaging_master`(`id`,`product_id`,`batch`,`cycle`,`file_name_upload`,`path_file_upload`,`upload_by`,`created_at`,`updated_at`) values (22,1,NULL,'2021-06-16','Softcopy-POS-19042021.txt','/var/www/filelistimaging\\2021-06-16\\Softcopy-POS-19042021.txt',1,'2021-06-16 12:56:32',NULL);

/*Table structure for table `imaging_master_detail` */

DROP TABLE IF EXISTS `imaging_master_detail`;

CREATE TABLE `imaging_master_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_master` int(11) DEFAULT NULL,
  `no_account` varchar(25) DEFAULT NULL,
  `no_spaj` varchar(25) DEFAULT NULL,
  `name_account` varchar(50) DEFAULT NULL,
  `address_account` varchar(500) DEFAULT NULL,
  `number_of_pages` int(11) DEFAULT NULL,
  `no_box` varchar(25) DEFAULT NULL,
  `no_manifest` varchar(25) DEFAULT NULL,
  `no_doc` varchar(25) DEFAULT NULL,
  `before_pos` int(11) DEFAULT NULL,
  `current_pos` int(11) DEFAULT 0,
  `file_name` varchar(150) DEFAULT NULL,
  `path_file` varchar(250) DEFAULT NULL,
  `count_view` bigint(20) DEFAULT 0,
  `tgl_scan` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=utf8mb4;

/*Data for the table `imaging_master_detail` */

insert  into `imaging_master_detail`(`id`,`id_master`,`no_account`,`no_spaj`,`name_account`,`address_account`,`number_of_pages`,`no_box`,`no_manifest`,`no_doc`,`before_pos`,`current_pos`,`file_name`,`path_file`,`count_view`,`tgl_scan`,`created_at`,`updated_at`) values (293,22,'0258520','SPAJ-001','','',2,'B-0001','19042021M-0001','D-0001',1,2,'SPAJ-0258520.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(294,22,'0258520','SPAJ-001','','',1,'B-0001','19042021M-0001','D-0002',1,2,'KTP-0258520.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(295,22,'0258520','SPAJ-001','','',3,'B-0001','19042021M-0001','D-0003',1,2,'ILUSTRASI-0258520.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(296,22,'21456452','SPAJ-002','','',2,'B-0001','19042021M-0001','D-0004',1,2,'SPAJ-21456452.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(297,22,'21456452','SPAJ-002','','',1,'B-0001','19042021M-0001','D-0005',1,2,'KTP-21456452.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(298,22,'21456452','SPAJ-002','','',3,'B-0001','19042021M-0001','D-0006',1,2,'ILUSTRASI-21456452.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(299,22,'58476565125','SPAJ-003','','',2,'B-0001','19042021M-0001','D-0007',1,2,'SPAJ-58476565125.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(300,22,'58476565125','SPAJ-003','','',1,'B-0001','19042021M-0001','D-0008',1,2,'KTP-58476565125.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(301,22,'58476565125','SPAJ-003','','',3,'B-0001','19042021M-0001','D-0009',1,2,'ILUSTRASI-58476565125.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(302,22,'14525966','SPAJ-004','','',2,'B-0001','19042021M-0001','D-0010',1,2,'SPAJ-14525966.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(303,22,'14525966','SPAJ-004','','',1,'B-0001','19042021M-0001','D-0011',1,2,'KTP-14525966.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(304,22,'14525966','SPAJ-004','','',3,'B-0001','19042021M-0001','D-0012',1,2,'ILUSTRASI-14525966.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(305,22,'561156168','SPAJ-005','','',2,'B-0001','19042021M-0001','D-0013',1,2,'SPAJ-561156168.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(306,22,'561156168','SPAJ-005','','',1,'B-0001','19042021M-0001','D-0014',1,2,'KTP-561156168.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL),(307,22,'561156168','SPAJ-005','','',3,'B-0001','19042021M-0001','D-0015',1,2,'ILUSTRASI-561156168.pdf','/POS/20210616',0,'2021-06-15 20:20:20','2021-06-16 12:56:32',NULL);

/*Table structure for table `imaging_pos` */

DROP TABLE IF EXISTS `imaging_pos`;

CREATE TABLE `imaging_pos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pos_name` varchar(25) DEFAULT NULL,
  `pos_lokasi` varchar(35) DEFAULT NULL,
  `pos_alamat` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `imaging_pos` */

insert  into `imaging_pos`(`id`,`pos_name`,`pos_lokasi`,`pos_alamat`,`created_at`) values (1,'GTV-1','JAKARTA','Cipinang Cempedak II','2021-05-04 01:48:01'),(2,'PASIFIC-LIFE','JAKARTA','Menara Jamsostek','2021-05-04 01:48:14');

/*Table structure for table `imaging_product` */

DROP TABLE IF EXISTS `imaging_product`;

CREATE TABLE `imaging_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_desc` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `imaging_product` */

insert  into `imaging_product`(`id`,`customer_id`,`product_name`,`product_desc`,`created_at`,`updated_at`) values (1,1,'POS','Berkas-berkas divisi POS',NULL,'2021-05-04 01:04:13'),(2,1,'CLAIM','Berkas-berkas KLAIM',NULL,'2021-05-04 02:11:27'),(3,1,'NB','Berkas-berkas divisi RENEWAL',NULL,'2021-05-04 01:08:51');

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `name_menu` varchar(50) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `desc` varchar(150) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `icon` varchar(25) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menus` */

insert  into `menus`(`id`,`order`,`name_menu`,`parent`,`active`,`desc`,`url`,`icon`,`created_at`) values (1,1,'Data Imaging',0,1,NULL,NULL,'fa fa-file-image-o','2021-04-20 09:53:18'),(2,1,'List Imaging',1,1,NULL,'imaging.listupload',NULL,'2021-05-03 15:56:48'),(4,2,'Report',0,1,NULL,'','fa fa-line-chart','2021-04-20 09:58:44'),(8,1,'Detail',4,1,NULL,'report.list',NULL,'2021-04-20 09:58:43'),(9,2,'Summary',4,1,NULL,'report.summary',NULL,'2021-04-20 13:41:53'),(10,3,'Mutation Box',0,1,NULL,'','fa fa-exchange','2021-04-27 09:43:44'),(11,1,'Form Mutation',10,1,NULL,'mutation.form',NULL,'2021-04-27 09:45:43'),(12,2,'List Mutation',10,1,NULL,'mutation.list',NULL,'2021-04-27 09:45:51'),(13,4,'Master',0,1,NULL,NULL,'fa fa-database','2021-05-03 09:24:10'),(14,1,'Users',13,1,NULL,'master.users',NULL,'2021-05-03 09:43:25'),(15,2,'Customer',13,1,NULL,'master.customer',NULL,'2021-05-03 09:46:03'),(16,3,'Product',13,1,NULL,'master.product',NULL,'2021-05-03 09:46:35'),(17,5,'Setting',0,1,NULL,NULL,'fa fa-gear','2021-05-03 09:27:04'),(18,1,'Database',17,1,NULL,NULL,NULL,'2021-05-03 09:26:48'),(20,4,'Pos Location',13,1,NULL,'master.posloc',NULL,'2021-05-03 09:47:06'),(21,2,'Data NB',1,1,NULL,'imaging.nb.list',NULL,'2021-05-11 17:29:33'),(22,3,'Data POS',1,1,NULL,'imaging.pos.list',NULL,'2021-05-11 17:37:08'),(23,4,'Data Claim',1,1,NULL,'imaging.claim.list',NULL,'2021-05-11 17:37:12');

/*Table structure for table `menus_to_users` */

DROP TABLE IF EXISTS `menus_to_users`;

CREATE TABLE `menus_to_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menus_to_users` */

insert  into `menus_to_users`(`id`,`user_id`,`menu_id`,`created_at`) values (1,1,1,'2021-04-07 10:16:37'),(2,1,2,'2021-04-07 10:16:37'),(4,1,4,'2021-04-16 14:42:33'),(5,1,8,'2021-04-20 09:58:59'),(6,1,9,'2021-04-23 15:53:02'),(7,1,10,'2021-04-26 10:40:03'),(8,1,11,'2021-04-27 09:46:47'),(9,1,12,'2021-04-27 16:41:52'),(10,2,1,'2021-04-30 15:39:45'),(11,2,2,'2021-04-30 15:39:55'),(12,2,4,'2021-04-30 15:39:59'),(13,2,8,'2021-04-30 15:40:07'),(14,2,9,'2021-04-30 15:40:11'),(16,1,13,'2021-05-03 15:13:56'),(17,1,14,'2021-05-03 15:14:00'),(18,1,15,'2021-05-03 16:04:17'),(19,1,16,'2021-05-03 17:09:48'),(20,1,20,'2021-05-04 08:36:57'),(21,1,21,'2021-05-11 17:26:35'),(22,1,22,'2021-05-11 17:37:21'),(23,1,23,'2021-05-11 17:37:22');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`group_id`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'farhan','farhan@xptlp.co.id',1,NULL,'$2y$10$RlGJdmw2V00134PdDQwfuuTqFDhx1WtZE/h.LMeWomz2RVz9YSVvS',NULL,'2021-04-07 03:15:59','2021-04-07 03:15:59'),(2,'demos','demo@demo.com',2,NULL,'$2y$10$Ecfvro6rexPZghDA./7ge.aShNh631oDLbyQ73WrAryVlmoLfYaza',NULL,'2021-04-30 07:46:56','2021-04-30 07:46:56');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
