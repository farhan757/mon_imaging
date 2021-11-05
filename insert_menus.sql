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

insert  into `menus`(`id`,`order`,`name_menu`,`parent`,`active`,`desc`,`url`,`icon`,`created_at`) values (27,6,'System Email',0,1,NULL,NULL,'fa fa-send','2021-08-19 14:40:46'),(28,1,'Start Email',27,1,NULL,'startmail.list',NULL,'2021-08-18 10:18:24'),(29,2,'Progress Email',27,1,NULL,'progress.list',NULL,'2021-08-18 17:53:21'),(30,6,'Report Email',0,1,NULL,NULL,NULL,'2021-08-19 14:40:53'),(31,1,'Summary',30,1,NULL,NULL,NULL,'2021-08-19 14:38:44'),(32,1,'Body Email',17,1,NULL,'settings.bodyemail',NULL,'2021-08-19 19:54:57'),(33,2,'Variable Field',17,1,NULL,'settings.variablefield',NULL,'2021-08-20 15:28:08');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
