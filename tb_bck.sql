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

/*Table structure for table `imaging_tmp_pdf_enc` */

DROP TABLE IF EXISTS `imaging_tmp_pdf_enc`;

CREATE TABLE `imaging_tmp_pdf_enc` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `path_source` varchar(500) DEFAULT NULL,
  `path_dest` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `kriteria` varchar(11) DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `imaging_tmp_pdf_enc` */

insert  into `imaging_tmp_pdf_enc`(`id`,`path_source`,`path_dest`,`status`,`kriteria`) values (1,'C:\\home\\sftp-PDFimaging\\Upload\\POS\\20210616\\PDF-DECRYPT\\14525966\\KTP-14525966.pdf','D:\\OFFICE\\TLP\\PASIFIC_LIFE\\PDF_PASS\\KTP-14525966.pdf',1,'user');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
