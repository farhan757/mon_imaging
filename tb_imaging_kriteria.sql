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

/*Table structure for table `imaging_kriteria` */

DROP TABLE IF EXISTS `imaging_kriteria`;

CREATE TABLE `imaging_kriteria` (
  `id_kriteria` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `imaging_kriteria` */

insert  into `imaging_kriteria`(`id_kriteria`,`nama_kriteria`) values (1,'RO'),(2,'SURAT JATUH TEMPO'),(3,'PERUBAHAN'),(4,'BREAK'),(5,'TANDA TERIMA'),(6,'SURRENDER'),(7,'FREELOOK'),(8,'LAIN LAIN');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
