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

/*Table structure for table `mail_body_email` */

DROP TABLE IF EXISTS `mail_body_email`;

CREATE TABLE `mail_body_email` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mv_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `desc` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mail_body_email` */

insert  into `mail_body_email`(`id`,`mv_id`,`desc`,`subject`,`body_mail`,`user_id`,`created_at`,`updated_at`) values (1,'SET-00002','Pemegang Polis','Pemegang Polis [#NOPOL#/#NAMA#]','<p>Kepada Yth.</p>\r\n\r\n<p>Bapak/Ibu #NAMA#</p>\r\n\r\n<p>Selamat Bergabung di Pacific Life Insurance!</p>\r\n\r\n<p>Terima kasih atas kepercayaannya kepada PT Pacific Life Insurance dan telah memilih kami sebagai mitra untuk memberikan perlindungan Asuransi Anda.</p>\r\n\r\n<p>Bersama ini kami kirimkan lampiran bentuk elektronik dari Data Polis, Ketentuan Umum Polis, Ketentuan Khusus Polis, beserta seluruh lampiran yang berisi syarat dan kondisi dari kontrak asuransi Mohon segera mempelajari Polis Anda sesuai dengan ketentuan masa mempelajari Polis (free-look period) yang berlaku</p>\r\n\r\n<p>Untuk menjaga kerahasiaan dokumen milik nasabah, maka dokumen-dokumen yang tercantum dalam e-Policy dilindungi dengan password. Silahkan gunakan password e-Policy Anda untuk membukanya.</p>\r\n\r\n<table cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>dd</td>\r\n			<td>:</td>\r\n			<td>Dua digit tanggal lahir Anda, contoh: 09</td>\r\n		</tr>\r\n		<tr>\r\n			<td>mm</td>\r\n			<td>:</td>\r\n			<td>Dua digit bulan lahir Anda, contoh: 08</td>\r\n		</tr>\r\n		<tr>\r\n			<td>yyyy</td>\r\n			<td>:</td>\r\n			<td>Empat digit Tahun lahir Anda, contoh: 1988</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Contoh</td>\r\n			<td>:</td>\r\n			<td>Tanggal lahir 10 Desember 1971 menjadi 10121971&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Apabila Anda mengalami kesulitan untuk mengakses e-Policy, silakan hubungi Tenaga Pemasar Anda atau Customer Service kami melaui telepon (021) 5082 0758, fax (021) 5082 0757 atau melalui e-mail di <a href=\"mailto:cs@pacificlife.co.id\">cs@pacificlife.co.id</a></p>\r\n\r\n<p>Kami terus berupaya memberikan pelayanan yang terbaik untuk Anda. Terima kasih atas kerja sama yang telah terjalin selama ini.</p>\r\n\r\n<p>Hormat kami,</p>\r\n\r\n<p>PT Pacific Life Insurance&nbsp;<br />\r\nPT Pacific Life Insurance terdaftar dan diawasi oleh Otoritas Jasa Keuangan</p>',1,'2021-08-19 19:58:14','2021-08-23 12:25:00'),(2,'SET-00002','Pemegang Polis_addendum','Pemegang Polis_addendum [#NOPOL#/#NAMA#]','<p>Nasabah Yth,</p>\r\n\r\n<p style=\"text-align: justify;\"><font face=\"arial, helvetica, sans-serif\">Bapak/Ibu&nbsp;#NAMA#</font><br />\r\n<br />\r\nTerima kasih atas kepercayaannya kepada PT Pacific Life Insurance dan telah memilih kami sebagai mitra untuk memberikan perlindungan Asuransi Anda.</p>\r\n\r\n<p style=\"text-align: justify;\">Bersama ini kami kirimkan lampiran bentuk elektronik dari Addendum Polis dan demi kenyamanan Anda, kami menyarankan untuk memeriksa san membaca kembali secara seksama karena addendum ini adalah merupakan bagian yang tidak terpisahkan dari Polis.</p>\r\n\r\n<p style=\"text-align:justify\">Untuk membuka berkas di dalam tautan, silakan gunakan password Anda dengan ketentuan sebagai berikut:</p>\r\n\r\n<table align=\"left\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"width:5px\">dd</td>\r\n			<td style=\"width:2px\">:</td>\r\n			<td>Dua digit tanggal lahir Anda, contoh: 09</td>\r\n		</tr>\r\n		<tr>\r\n			<td>mm</td>\r\n			<td>:</td>\r\n			<td>Dua digit bulan lahir Anda, contoh: 08</td>\r\n		</tr>\r\n		<tr>\r\n			<td>yyyy</td>\r\n			<td>:</td>\r\n			<td>Empat digit Tahun lahir Anda, contoh: 1988</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Contoh&nbsp;</td>\r\n			<td>:</td>\r\n			<td>Tanggal lahir 10 Desember 1971 menjadi 10121971</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n<br />\r\n<br />\r\nHormat Kami,</p>\r\n\r\n<p>PT AXA Mandiri Financial Services<br />\r\n&nbsp;</p>\r\n\r\n<table cellpadding=\"1\" cellspacing=\"1\" style=\"width:320px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align: top;\"><span style=\"font-size:10px;\"><em>1.</em></span></td>\r\n			<td style=\"white-space: nowrap;\"><span style=\"font-size:10px;\"><em>Surat ini dibuat dan dicetak dengan sistem komputerisasi sehingga tidak&nbsp;<br />\r\n			memerlukan tanda tangan.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>2.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Dokumen ini dikirimkan sesuai dengan alamat e-mail Pemegang Polis yang<br />\r\n			didaftarkan ke AXA Mandiri. AXA Mandiri tidak bertanggung jawab atas segala&nbsp;<br />\r\n			kerugian yang timbul akibat kesalahan informasi yang diberikan oleh<br />\r\n			Pemegang Polis untuk fasilitas pengiriman e-letter atau keperluan<br />\r\n			korespondensi lainnya.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>3.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Jika berkas tidak dapat diakses, mohon perbarui PC, Notebook&nbsp;<br />\r\n			atau Ponsel Anda dengan perangkat lunak Adobe Reader versi 9&nbsp;<br />\r\n			atau versi yang terbaru.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>4.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Jika Anda bukan Pemegang Polis AXA Mandiri sesuai data di atas, maka<br />\r\n			Anda tidak diperkenankan menggunakan dan atau memanfaatkan e-mail ini&nbsp;<br />\r\n			beserta seluruh lampirannya. Penggunaan e-mail ini secara tidak semestinya<br />\r\n			dapat diproses secara hukum.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>5.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Apabila ada pertanyaan lebih lanjut, mohon&nbsp;<br />\r\n			hubungi Customer Care Centre kami.</em></span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>',1,'2021-08-19 19:58:17','2021-08-24 02:07:27'),(3,'SET-00002','Tenaga Pemasar Addendum','Tenaga Pemasar Addendum [#NOPOL#/#NAMA#]','<p style=\"text-align: justify;\">Tenaga Pemasar yang terhormat,</p>\r\n\r\n<p style=\"text-align: justify;\">Bersama ini kami lampirkan Salinan Addendum Polis nasabah anda dengan nomor polis <strong>#NOPOL#/#NAMA#.</strong></p>\r\n\r\n<p style=\"text-align: justify;\">Sebagai upaya kami untuk menjaga kerahasiaan data polis, silakan gunakan password untuk membuka Salinan Addendum Polis.</p>\r\n\r\n<p style=\"text-align: justify;\">Format password adalah Kode Agen :</p>\r\n\r\n<p style=\"text-align: justify;\">Contoh : Kode agen Anda PLI1900159</p>\r\n\r\n<p style=\"text-align: justify;\">Kami terus berupaya untuk memberikan pelayanan yang terbaik kepada Anda.</p>\r\n\r\n<p style=\"text-align: justify;\">Terima kasih atas kerja sama yang telah terjalin selama ini.</p>\r\n\r\n<p style=\"text-align: justify;\">Hormat kami,</p>\r\n\r\n<p style=\"text-align: justify;\">PT Pacific Life Insurance</p>',1,'2021-08-19 19:58:31','2021-08-23 08:30:00'),(4,'SET-00002','Tenaga Pemasar Polis','Tenaga Pemasar Polis [#NOPOL#/#NAMA#]','<p style=\"text-align: justify;\">Tenaga Pemasar yang terhormat,<br />\r\n<br />\r\nBersama ini kami lampirkan Salinan Ringkasan Polis nasabah anda dengan nomor polis <strong>#NOPOL#/#NAMA#</strong> yang diterbitkan pada tanggal #TGL_TERBIT#<br />\r\n<br />\r\nSebagai upaya kami untuk menjaga kerahasiaan data polis, silakan gunakan password untuk membuka Salinan Ringkasan Polis.<br />\r\n<br />\r\nFormat password adalah Kode Agen :<br />\r\n<br />\r\nContoh : Kode agen Anda PLI1900159<br />\r\n<br />\r\nKami terus berupaya untuk memberikan pelayanan yang terbaik kepada Anda.<br />\r\n<br />\r\nTerima kasih atas kerja sama yang telah terjalin selama ini.<br />\r\n<br />\r\nHormat kami,<br />\r\n<br />\r\nPT Pacific Life Insurance&nbsp;<br />\r\n&nbsp;&nbsp; &nbsp;</p>',1,'2021-08-19 19:58:29','2021-08-23 11:50:49');

/*Table structure for table `mail_detail_data` */

DROP TABLE IF EXISTS `mail_detail_data`;

CREATE TABLE `mail_detail_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_id` int(11) NOT NULL,
  `account` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_spaj` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cc` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `bcc` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `attachment` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password_attach` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `app` int(11) NOT NULL DEFAULT 0,
  `tgl_terbit` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `flaging` bigint(20) DEFAULT NULL,
  `id_mail` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mail_detail_data` */

insert  into `mail_detail_data`(`id`,`master_id`,`account`,`no_spaj`,`name`,`to`,`cc`,`bcc`,`attachment`,`password_attach`,`app`,`tgl_terbit`,`created_at`,`updated_at`,`flaging`,`id_mail`) values (62,20,'1995001873','SPAJ1995001873','EBIT','hary@xptlp.co.id','','','/var/www/mail_blast/storage/app/attachment/20210218/1.pdf','05061983',1,'23 Agustus 2021','2021-08-24 04:21:52',NULL,1,1),(63,20,'1995001875','SPAJ1995001875','TEJO','farhan@xptlp.co.id','','','/var/www/mail_blast/storage/app/attachment/20210218/2.pdf','12061976',1,'23 Agustus 2021','2021-08-24 04:21:52',NULL,2,1),(64,20,'1995001876','SPAJ1995001876','MESSI','agil@xptlp.co.id','','','/var/www/mail_blast/storage/app/attachment/20210218/3.pdf','17111964',1,'23 Agustus 2021','2021-08-24 04:21:52',NULL,3,1),(65,20,'1995001878','SPAJ1995001878','BEPE','ria@xptlp.co.id','','','/var/www/mail_blast/storage/app/attachment/20210218/4.pdf','03091972',1,'23 Agustus 2021','2021-08-24 04:21:52',NULL,4,1);

/*Table structure for table `mail_master` */

DROP TABLE IF EXISTS `mail_master`;

CREATE TABLE `mail_master` (
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mail_master` */

insert  into `mail_master`(`id`,`product_id`,`batch`,`cycle`,`file_name_upload`,`path_file_upload`,`upload_by`,`created_at`,`updated_at`) values (20,1,1,'2021-08-24','CONTOH-DATA-DEMO-MAIL_BLAST.txt','/var/www/filemailblast\\CONTOH-DATA-DEMO-MAIL_BLAST.txt',1,'2021-08-24 04:21:52',NULL);

/*Table structure for table `mail_master_variable` */

DROP TABLE IF EXISTS `mail_master_variable`;

CREATE TABLE `mail_master_variable` (
  `id` varchar(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `mail_master_variable` */

insert  into `mail_master_variable`(`id`,`name`,`user_id`,`created_at`,`updated_at`) values ('SET-00002','Demo',1,'2021-08-20 15:30:39',NULL);

/*Table structure for table `mail_sending_data` */

DROP TABLE IF EXISTS `mail_sending_data`;

CREATE TABLE `mail_sending_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_id` int(11) NOT NULL,
  `account` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_spaj` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cc` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `bcc` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `subject_mail` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `body_mail` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `body_mail_base` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password_attach` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `sent` int(11) NOT NULL,
  `msg_error_send` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_at` datetime NOT NULL,
  `delivered` int(11) NOT NULL,
  `delivered_at` datetime NOT NULL,
  `read` int(11) NOT NULL,
  `read_at` datetime NOT NULL,
  `resend` int(11) NOT NULL DEFAULT 0,
  `desc` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tgl_terbit` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `flaging` bigint(20) DEFAULT NULL,
  `id_mail` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mail_sending_data` */

insert  into `mail_sending_data`(`id`,`master_id`,`account`,`no_spaj`,`name`,`to`,`cc`,`bcc`,`subject_mail`,`body_mail`,`body_mail_base`,`attachment`,`password_attach`,`user_id`,`sent`,`msg_error_send`,`send_at`,`delivered`,`delivered_at`,`read`,`read_at`,`resend`,`desc`,`tgl_terbit`,`created_at`,`updated_at`,`flaging`,`id_mail`) values (83,20,'1995001873','SPAJ1995001873','EBIT','hary@xptlp.co.id','','','Pemegang Polis [1995001873/EBIT]','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n            <p>Kepada Yth.</p>\r\n\r\n<p>Bapak/Ibu EBIT</p>\r\n\r\n<p>Selamat Bergabung di Pacific Life Insurance!</p>\r\n\r\n<p>Terima kasih atas kepercayaannya kepada PT Pacific Life Insurance dan telah memilih kami sebagai mitra untuk memberikan perlindungan Asuransi Anda.</p>\r\n\r\n<p>Bersama ini kami kirimkan lampiran bentuk elektronik dari Data Polis, Ketentuan Umum Polis, Ketentuan Khusus Polis, beserta seluruh lampiran yang berisi syarat dan kondisi dari kontrak asuransi Mohon segera mempelajari Polis Anda sesuai dengan ketentuan masa mempelajari Polis (free-look period) yang berlaku</p>\r\n\r\n<p>Untuk menjaga kerahasiaan dokumen milik nasabah, maka dokumen-dokumen yang tercantum dalam e-Policy dilindungi dengan password. Silahkan gunakan password e-Policy Anda untuk membukanya.</p>\r\n\r\n<table cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>dd</td>\r\n			<td>:</td>\r\n			<td>Dua digit tanggal lahir Anda, contoh: 09</td>\r\n		</tr>\r\n		<tr>\r\n			<td>mm</td>\r\n			<td>:</td>\r\n			<td>Dua digit bulan lahir Anda, contoh: 08</td>\r\n		</tr>\r\n		<tr>\r\n			<td>yyyy</td>\r\n			<td>:</td>\r\n			<td>Empat digit Tahun lahir Anda, contoh: 1988</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Contoh</td>\r\n			<td>:</td>\r\n			<td>Tanggal lahir 10 Desember 1971 menjadi 10121971&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Apabila Anda mengalami kesulitan untuk mengakses e-Policy, silakan hubungi Tenaga Pemasar Anda atau Customer Service kami melaui telepon (021) 5082 0758, fax (021) 5082 0757 atau melalui e-mail di <a href=\"mailto:cs@pacificlife.co.id\">cs@pacificlife.co.id</a></p>\r\n\r\n<p>Kami terus berupaya memberikan pelayanan yang terbaik untuk Anda. Terima kasih atas kerja sama yang telah terjalin selama ini.</p>\r\n\r\n<p>Hormat kami,</p>\r\n\r\n<p>PT Pacific Life Insurance&nbsp;<br />\r\nPT Pacific Life Insurance terdaftar dan diawasi oleh Otoritas Jasa Keuangan</p>','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n            <p>Kepada Yth.</p>\r\n\r\n<p>Bapak/Ibu EBIT</p>\r\n\r\n<p>Selamat Bergabung di Pacific Life Insurance!</p>\r\n\r\n<p>Terima kasih atas kepercayaannya kepada PT Pacific Life Insurance dan telah memilih kami sebagai mitra untuk memberikan perlindungan Asuransi Anda.</p>\r\n\r\n<p>Bersama ini kami kirimkan lampiran bentuk elektronik dari Data Polis, Ketentuan Umum Polis, Ketentuan Khusus Polis, beserta seluruh lampiran yang berisi syarat dan kondisi dari kontrak asuransi Mohon segera mempelajari Polis Anda sesuai dengan ketentuan masa mempelajari Polis (free-look period) yang berlaku</p>\r\n\r\n<p>Untuk menjaga kerahasiaan dokumen milik nasabah, maka dokumen-dokumen yang tercantum dalam e-Policy dilindungi dengan password. Silahkan gunakan password e-Policy Anda untuk membukanya.</p>\r\n\r\n<table cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>dd</td>\r\n			<td>:</td>\r\n			<td>Dua digit tanggal lahir Anda, contoh: 09</td>\r\n		</tr>\r\n		<tr>\r\n			<td>mm</td>\r\n			<td>:</td>\r\n			<td>Dua digit bulan lahir Anda, contoh: 08</td>\r\n		</tr>\r\n		<tr>\r\n			<td>yyyy</td>\r\n			<td>:</td>\r\n			<td>Empat digit Tahun lahir Anda, contoh: 1988</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Contoh</td>\r\n			<td>:</td>\r\n			<td>Tanggal lahir 10 Desember 1971 menjadi 10121971&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Apabila Anda mengalami kesulitan untuk mengakses e-Policy, silakan hubungi Tenaga Pemasar Anda atau Customer Service kami melaui telepon (021) 5082 0758, fax (021) 5082 0757 atau melalui e-mail di <a href=\"mailto:cs@pacificlife.co.id\">cs@pacificlife.co.id</a></p>\r\n\r\n<p>Kami terus berupaya memberikan pelayanan yang terbaik untuk Anda. Terima kasih atas kerja sama yang telah terjalin selama ini.</p>\r\n\r\n<p>Hormat kami,</p>\r\n\r\n<p>PT Pacific Life Insurance&nbsp;<br />\r\nPT Pacific Life Insurance terdaftar dan diawasi oleh Otoritas Jasa Keuangan</p>','/var/www/mail_blast/storage/app/attachment/20210218/1.pdf','05061983',1,1,'','2021-08-24 11:21:59',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'','23 Agustus 2021','2021-08-24 04:21:52',NULL,1,1),(84,20,'1995001875','SPAJ1995001875','TEJO','farhan@xptlp.co.id','','','Pemegang Polis_addendum [1995001875/TEJO]','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n            <p>Nasabah Yth,</p>\r\n\r\n<p style=\"text-align: justify;\"><font face=\"arial, helvetica, sans-serif\">Bapak/Ibu&nbsp;TEJO</font><br />\r\n<br />\r\nTerima kasih atas kepercayaannya kepada PT Pacific Life Insurance dan telah memilih kami sebagai mitra untuk memberikan perlindungan Asuransi Anda.</p>\r\n\r\n<p style=\"text-align: justify;\">Bersama ini kami kirimkan lampiran bentuk elektronik dari Addendum Polis dan demi kenyamanan Anda, kami menyarankan untuk memeriksa san membaca kembali secara seksama karena addendum ini adalah merupakan bagian yang tidak terpisahkan dari Polis.</p>\r\n\r\n<p style=\"text-align:justify\">Untuk membuka berkas di dalam tautan, silakan gunakan password Anda dengan ketentuan sebagai berikut:</p>\r\n\r\n<table align=\"left\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"width:5px\">dd</td>\r\n			<td style=\"width:2px\">:</td>\r\n			<td>Dua digit tanggal lahir Anda, contoh: 09</td>\r\n		</tr>\r\n		<tr>\r\n			<td>mm</td>\r\n			<td>:</td>\r\n			<td>Dua digit bulan lahir Anda, contoh: 08</td>\r\n		</tr>\r\n		<tr>\r\n			<td>yyyy</td>\r\n			<td>:</td>\r\n			<td>Empat digit Tahun lahir Anda, contoh: 1988</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Contoh&nbsp;</td>\r\n			<td>:</td>\r\n			<td>Tanggal lahir 10 Desember 1971 menjadi 10121971</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n<br />\r\n<br />\r\nHormat Kami,</p>\r\n\r\n<p>PT AXA Mandiri Financial Services<br />\r\n&nbsp;</p>\r\n\r\n<table cellpadding=\"1\" cellspacing=\"1\" style=\"width:320px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align: top;\"><span style=\"font-size:10px;\"><em>1.</em></span></td>\r\n			<td style=\"white-space: nowrap;\"><span style=\"font-size:10px;\"><em>Surat ini dibuat dan dicetak dengan sistem komputerisasi sehingga tidak&nbsp;<br />\r\n			memerlukan tanda tangan.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>2.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Dokumen ini dikirimkan sesuai dengan alamat e-mail Pemegang Polis yang<br />\r\n			didaftarkan ke AXA Mandiri. AXA Mandiri tidak bertanggung jawab atas segala&nbsp;<br />\r\n			kerugian yang timbul akibat kesalahan informasi yang diberikan oleh<br />\r\n			Pemegang Polis untuk fasilitas pengiriman e-letter atau keperluan<br />\r\n			korespondensi lainnya.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>3.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Jika berkas tidak dapat diakses, mohon perbarui PC, Notebook&nbsp;<br />\r\n			atau Ponsel Anda dengan perangkat lunak Adobe Reader versi 9&nbsp;<br />\r\n			atau versi yang terbaru.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>4.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Jika Anda bukan Pemegang Polis AXA Mandiri sesuai data di atas, maka<br />\r\n			Anda tidak diperkenankan menggunakan dan atau memanfaatkan e-mail ini&nbsp;<br />\r\n			beserta seluruh lampirannya. Penggunaan e-mail ini secara tidak semestinya<br />\r\n			dapat diproses secara hukum.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>5.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Apabila ada pertanyaan lebih lanjut, mohon&nbsp;<br />\r\n			hubungi Customer Care Centre kami.</em></span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n            <p>Nasabah Yth,</p>\r\n\r\n<p style=\"text-align: justify;\"><font face=\"arial, helvetica, sans-serif\">Bapak/Ibu&nbsp;TEJO</font><br />\r\n<br />\r\nTerima kasih atas kepercayaannya kepada PT Pacific Life Insurance dan telah memilih kami sebagai mitra untuk memberikan perlindungan Asuransi Anda.</p>\r\n\r\n<p style=\"text-align: justify;\">Bersama ini kami kirimkan lampiran bentuk elektronik dari Addendum Polis dan demi kenyamanan Anda, kami menyarankan untuk memeriksa san membaca kembali secara seksama karena addendum ini adalah merupakan bagian yang tidak terpisahkan dari Polis.</p>\r\n\r\n<p style=\"text-align:justify\">Untuk membuka berkas di dalam tautan, silakan gunakan password Anda dengan ketentuan sebagai berikut:</p>\r\n\r\n<table align=\"left\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"width:5px\">dd</td>\r\n			<td style=\"width:2px\">:</td>\r\n			<td>Dua digit tanggal lahir Anda, contoh: 09</td>\r\n		</tr>\r\n		<tr>\r\n			<td>mm</td>\r\n			<td>:</td>\r\n			<td>Dua digit bulan lahir Anda, contoh: 08</td>\r\n		</tr>\r\n		<tr>\r\n			<td>yyyy</td>\r\n			<td>:</td>\r\n			<td>Empat digit Tahun lahir Anda, contoh: 1988</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Contoh&nbsp;</td>\r\n			<td>:</td>\r\n			<td>Tanggal lahir 10 Desember 1971 menjadi 10121971</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n<br />\r\n<br />\r\nHormat Kami,</p>\r\n\r\n<p>PT AXA Mandiri Financial Services<br />\r\n&nbsp;</p>\r\n\r\n<table cellpadding=\"1\" cellspacing=\"1\" style=\"width:320px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align: top;\"><span style=\"font-size:10px;\"><em>1.</em></span></td>\r\n			<td style=\"white-space: nowrap;\"><span style=\"font-size:10px;\"><em>Surat ini dibuat dan dicetak dengan sistem komputerisasi sehingga tidak&nbsp;<br />\r\n			memerlukan tanda tangan.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>2.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Dokumen ini dikirimkan sesuai dengan alamat e-mail Pemegang Polis yang<br />\r\n			didaftarkan ke AXA Mandiri. AXA Mandiri tidak bertanggung jawab atas segala&nbsp;<br />\r\n			kerugian yang timbul akibat kesalahan informasi yang diberikan oleh<br />\r\n			Pemegang Polis untuk fasilitas pengiriman e-letter atau keperluan<br />\r\n			korespondensi lainnya.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>3.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Jika berkas tidak dapat diakses, mohon perbarui PC, Notebook&nbsp;<br />\r\n			atau Ponsel Anda dengan perangkat lunak Adobe Reader versi 9&nbsp;<br />\r\n			atau versi yang terbaru.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>4.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Jika Anda bukan Pemegang Polis AXA Mandiri sesuai data di atas, maka<br />\r\n			Anda tidak diperkenankan menggunakan dan atau memanfaatkan e-mail ini&nbsp;<br />\r\n			beserta seluruh lampirannya. Penggunaan e-mail ini secara tidak semestinya<br />\r\n			dapat diproses secara hukum.</em></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>5.</em></span></td>\r\n			<td style=\"white-space: nowrap; vertical-align: top;\"><span style=\"font-size:10px;\"><em>Apabila ada pertanyaan lebih lanjut, mohon&nbsp;<br />\r\n			hubungi Customer Care Centre kami.</em></span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>','/var/www/mail_blast/storage/app/attachment/20210218/2.pdf','12061976',1,1,'','2021-08-24 11:21:58',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'','23 Agustus 2021','2021-08-24 04:21:52',NULL,2,1),(85,20,'1995001876','SPAJ1995001876','MESSI','agil@xptlp.co.id','','','Tenaga Pemasar Addendum [1995001876/MESSI]','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n            <p style=\"text-align: justify;\">Tenaga Pemasar yang terhormat,</p>\r\n\r\n<p style=\"text-align: justify;\">Bersama ini kami lampirkan Salinan Addendum Polis nasabah anda dengan nomor polis <strong>1995001876/MESSI.</strong></p>\r\n\r\n<p style=\"text-align: justify;\">Sebagai upaya kami untuk menjaga kerahasiaan data polis, silakan gunakan password untuk membuka Salinan Addendum Polis.</p>\r\n\r\n<p style=\"text-align: justify;\">Format password adalah Kode Agen :</p>\r\n\r\n<p style=\"text-align: justify;\">Contoh : Kode agen Anda PLI1900159</p>\r\n\r\n<p style=\"text-align: justify;\">Kami terus berupaya untuk memberikan pelayanan yang terbaik kepada Anda.</p>\r\n\r\n<p style=\"text-align: justify;\">Terima kasih atas kerja sama yang telah terjalin selama ini.</p>\r\n\r\n<p style=\"text-align: justify;\">Hormat kami,</p>\r\n\r\n<p style=\"text-align: justify;\">PT Pacific Life Insurance</p>','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n            <p style=\"text-align: justify;\">Tenaga Pemasar yang terhormat,</p>\r\n\r\n<p style=\"text-align: justify;\">Bersama ini kami lampirkan Salinan Addendum Polis nasabah anda dengan nomor polis <strong>1995001876/MESSI.</strong></p>\r\n\r\n<p style=\"text-align: justify;\">Sebagai upaya kami untuk menjaga kerahasiaan data polis, silakan gunakan password untuk membuka Salinan Addendum Polis.</p>\r\n\r\n<p style=\"text-align: justify;\">Format password adalah Kode Agen :</p>\r\n\r\n<p style=\"text-align: justify;\">Contoh : Kode agen Anda PLI1900159</p>\r\n\r\n<p style=\"text-align: justify;\">Kami terus berupaya untuk memberikan pelayanan yang terbaik kepada Anda.</p>\r\n\r\n<p style=\"text-align: justify;\">Terima kasih atas kerja sama yang telah terjalin selama ini.</p>\r\n\r\n<p style=\"text-align: justify;\">Hormat kami,</p>\r\n\r\n<p style=\"text-align: justify;\">PT Pacific Life Insurance</p>','/var/www/mail_blast/storage/app/attachment/20210218/3.pdf','17111964',1,1,'','2021-08-24 11:21:58',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'','23 Agustus 2021','2021-08-24 04:21:52',NULL,3,1),(86,20,'1995001878','SPAJ1995001878','BEPE','ria@xptlp.co.id','','','Tenaga Pemasar Polis [1995001878/BEPE]','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n            <p style=\"text-align: justify;\">Tenaga Pemasar yang terhormat,<br />\r\n<br />\r\nBersama ini kami lampirkan Salinan Ringkasan Polis nasabah anda dengan nomor polis <strong>1995001878/BEPE</strong> yang diterbitkan pada tanggal 23 Agustus 2021<br />\r\n<br />\r\nSebagai upaya kami untuk menjaga kerahasiaan data polis, silakan gunakan password untuk membuka Salinan Ringkasan Polis.<br />\r\n<br />\r\nFormat password adalah Kode Agen :<br />\r\n<br />\r\nContoh : Kode agen Anda PLI1900159<br />\r\n<br />\r\nKami terus berupaya untuk memberikan pelayanan yang terbaik kepada Anda.<br />\r\n<br />\r\nTerima kasih atas kerja sama yang telah terjalin selama ini.<br />\r\n<br />\r\nHormat kami,<br />\r\n<br />\r\nPT Pacific Life Insurance&nbsp;<br />\r\n&nbsp;&nbsp; &nbsp;</p>','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n            <p style=\"text-align: justify;\">Tenaga Pemasar yang terhormat,<br />\r\n<br />\r\nBersama ini kami lampirkan Salinan Ringkasan Polis nasabah anda dengan nomor polis <strong>1995001878/BEPE</strong> yang diterbitkan pada tanggal 23 Agustus 2021<br />\r\n<br />\r\nSebagai upaya kami untuk menjaga kerahasiaan data polis, silakan gunakan password untuk membuka Salinan Ringkasan Polis.<br />\r\n<br />\r\nFormat password adalah Kode Agen :<br />\r\n<br />\r\nContoh : Kode agen Anda PLI1900159<br />\r\n<br />\r\nKami terus berupaya untuk memberikan pelayanan yang terbaik kepada Anda.<br />\r\n<br />\r\nTerima kasih atas kerja sama yang telah terjalin selama ini.<br />\r\n<br />\r\nHormat kami,<br />\r\n<br />\r\nPT Pacific Life Insurance&nbsp;<br />\r\n&nbsp;&nbsp; &nbsp;</p>','/var/www/mail_blast/storage/app/attachment/20210218/4.pdf','03091972',1,1,'','2021-08-24 11:21:57',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'','23 Agustus 2021','2021-08-24 04:21:52',NULL,4,1),(87,20,'1995001878','SPAJ1995001878','BEPE','harymw1990@gmail.com','','','Tenaga Pemasar Polis [1995001878/BEPE]','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n            <p style=\"text-align: justify;\">Tenaga Pemasar yang terhormat,<br />\r\n<br />\r\nBersama ini kami lampirkan Salinan Ringkasan Polis nasabah anda dengan nomor polis <strong>1995001878/BEPE</strong> yang diterbitkan pada tanggal 23 Agustus 2021<br />\r\n<br />\r\nSebagai upaya kami untuk menjaga kerahasiaan data polis, silakan gunakan password untuk membuka Salinan Ringkasan Polis.<br />\r\n<br />\r\nFormat password adalah Kode Agen :<br />\r\n<br />\r\nContoh : Kode agen Anda PLI1900159<br />\r\n<br />\r\nKami terus berupaya untuk memberikan pelayanan yang terbaik kepada Anda.<br />\r\n<br />\r\nTerima kasih atas kerja sama yang telah terjalin selama ini.<br />\r\n<br />\r\nHormat kami,<br />\r\n<br />\r\nPT Pacific Life Insurance&nbsp;<br />\r\n&nbsp;&nbsp; &nbsp;</p>','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n            <p style=\"text-align: justify;\">Tenaga Pemasar yang terhormat,<br />\r\n<br />\r\nBersama ini kami lampirkan Salinan Ringkasan Polis nasabah anda dengan nomor polis <strong>1995001878/BEPE</strong> yang diterbitkan pada tanggal 23 Agustus 2021<br />\r\n<br />\r\nSebagai upaya kami untuk menjaga kerahasiaan data polis, silakan gunakan password untuk membuka Salinan Ringkasan Polis.<br />\r\n<br />\r\nFormat password adalah Kode Agen :<br />\r\n<br />\r\nContoh : Kode agen Anda PLI1900159<br />\r\n<br />\r\nKami terus berupaya untuk memberikan pelayanan yang terbaik kepada Anda.<br />\r\n<br />\r\nTerima kasih atas kerja sama yang telah terjalin selama ini.<br />\r\n<br />\r\nHormat kami,<br />\r\n<br />\r\nPT Pacific Life Insurance&nbsp;<br />\r\n&nbsp;&nbsp; &nbsp;</p>','/var/www/mail_blast/storage/app/attachment/20210218/4.pdf','03091972',1,1,'','2021-08-24 11:22:28',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',1,'Cetak Sertifikat BCA',NULL,'2021-08-24 04:22:24','2021-08-24 04:22:24',4,1);

/*Table structure for table `mail_set_email_sender` */

DROP TABLE IF EXISTS `mail_set_email_sender`;

CREATE TABLE `mail_set_email_sender` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `host` varchar(125) DEFAULT NULL,
  `user_email` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `port` bigint(20) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mail_set_email_sender` */

insert  into `mail_set_email_sender`(`id`,`host`,`user_email`,`password`,`port`,`name`,`created_at`,`updated_at`) values (1,'mail.pacificlife.co.id','noreply@pacificlife.co.id','(CoRp2018!)',587,'PT Pacific Life Insurance','2021-08-20 15:11:02',NULL);

/*Table structure for table `mail_table_counter` */

DROP TABLE IF EXISTS `mail_table_counter`;

CREATE TABLE `mail_table_counter` (
  `keys` varchar(20) DEFAULT NULL,
  `counter` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `mail_table_counter` */

insert  into `mail_table_counter`(`keys`,`counter`) values ('gen_code',6),('mail_gen_code',2);

/*Table structure for table `mail_tmp_history_read` */

DROP TABLE IF EXISTS `mail_tmp_history_read`;

CREATE TABLE `mail_tmp_history_read` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sending_id` int(11) NOT NULL,
  `ip` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web_browser` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lon` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mail_tmp_history_read` */

insert  into `mail_tmp_history_read`(`id`,`sending_id`,`ip`,`web_browser`,`city`,`provinsi`,`country`,`lat`,`lon`,`created_at`,`updated_at`) values (32,67,'::1','\'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 02:52:20',NULL),(33,71,'::1','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 02:54:16',NULL),(34,71,'::1','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 03:00:57',NULL),(35,71,'::1','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 03:01:03',NULL),(36,74,'192.168.12.47','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 03:02:31',NULL),(37,74,'192.168.12.47','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 03:02:37',NULL),(38,74,'192.168.12.47','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 03:12:54',NULL),(39,67,'::1','\'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 03:13:19',NULL),(40,74,'192.168.12.47','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 03:23:04',NULL),(41,67,'::1','\'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 03:24:13',NULL),(42,74,'192.168.12.47','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 03:28:02',NULL),(43,74,'192.168.12.47','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 04:14:02',NULL),(44,79,'192.168.12.47','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 04:14:27',NULL),(45,79,'192.168.12.47','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 04:16:05',NULL),(46,79,'192.168.12.47','\'Mozilla/4.0 (compatible; ms-office; MSOffice 16)\'',NULL,NULL,NULL,NULL,NULL,'2021-08-24 04:31:01',NULL);

/*Table structure for table `mail_tmp_verify_read` */

DROP TABLE IF EXISTS `mail_tmp_verify_read`;

CREATE TABLE `mail_tmp_verify_read` (
  `code_verify` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sending_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`code_verify`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mail_tmp_verify_read` */

insert  into `mail_tmp_verify_read`(`code_verify`,`sending_id`,`created_at`,`updated_at`) values ('19k2iLjfTOfcTXzyST1Pqw9jKgWemASs',86,'2021-08-24 04:21:52',NULL),('1Iod9w8iUYLOJ2c0tW1zIwP1ONoLqhai',69,'2021-08-24 02:17:24',NULL),('1OUmbl6ZctMia7GEMgxMsMRNRVBtzMM5',81,'2021-08-24 04:13:23',NULL),('6G76KJawxBDaEUmaVRS5wFd5DscgFCJZ',60,'2021-08-23 09:00:13',NULL),('6zq2eE0opFpYGOEyxZpUbJSVkrwGhxMS',85,'2021-08-24 04:21:52',NULL),('8xM7ciPfd5dxwAFb4zI9WNJ9j5VwDKcs',63,'2021-08-23 11:51:07',NULL),('A6a8kYNpVUDcQdZG3HZnCjUwnUS3hm3l',55,'2021-08-19 10:04:25',NULL),('a7PjCA3LeqFMBaEJBWs1liTnsXAUSOqa',84,'2021-08-24 04:21:52',NULL),('DhKJ4QvFRSOQYYilrGYFRQbK8yfK5lfM',83,'2021-08-24 04:21:52',NULL),('dj1di7ED4H3MbmnzULREDBXZVIZypZgn',72,'2021-08-24 02:55:09',NULL),('ETIqII1NXs2aLq7uktpnF0ErkC4Jwfwg',73,'2021-08-24 03:00:31',NULL),('FaWEuZujIxWmS8krWFMxIByz7pzYD3Rb',54,'2021-08-19 10:04:25',NULL),('fSM8fJzWIs7as74j1zsCeIdWKZOstXHs',62,'2021-08-23 09:00:13',NULL),('gPtvIk1hJmKg1x0EbzVoCmn81qO6gPdD',82,'2021-08-24 04:18:41',NULL),('GTfSeqAmIvysm0BJxpW0Qjfm3lAu9NN6',74,'2021-08-24 03:00:31',NULL),('HADWKXY0G5Aqlxgt3mqaHMLE7lDJiYtB',61,'2021-08-23 09:00:13',NULL),('HQQIgKiKcb5cUf6jeHtPQG7foRcANuXE',79,'2021-08-24 04:13:22',NULL),('Jmh25J2EnLQnXsdQPAhD78uPjE1tP9uu',58,'2021-08-23 08:20:47',NULL),('jqBqDQELonIBRJtDtOVkWzAOQ6noPt6V',68,'2021-08-24 02:17:24',NULL),('k62AsSI35tYSY38o2qyNffWUtKaoSlBw',59,'2021-08-23 09:00:13',NULL),('ncy39xc8FAiAazD5iowCpKXr3hg6jKFT',75,'2021-08-24 03:00:31',NULL),('O5rFz47ftME3HLhRBQVyUyiz5XSN7Nh1',87,'2021-08-24 04:22:24',NULL),('o6bzIAMXqNhJBUOXguQs8eu1Lf81fG17',70,'2021-08-24 02:17:24',NULL),('oomgTwklnUynS1jMmFAJMrdr9HFW6u5e',80,'2021-08-24 04:13:22',NULL),('RyXLKuETjo10DmkF2swXsx2q0gRxgfkS',78,'2021-08-24 04:13:22',NULL),('sDQFtTXXKBTsEAnEUKmjgEkEJ8BPdDdW',66,'2021-08-23 11:51:07',NULL),('Tt4IeXApXijbIkRiJb0PR4LtsSs80OdR',77,'2021-08-24 03:29:07',NULL),('uql3D3YVag1Foub5644aFYwAn1IgQB14',65,'2021-08-23 11:51:07',NULL),('VLQoNgePcmOjansd97n8tu50W4l5tee7',71,'2021-08-24 02:53:18',NULL),('VwhjlwjJwZs2Bk7IorZzvafinIPHYgA7',64,'2021-08-23 11:51:07',NULL),('XFT2S5lVlRT1HmuCg9MeGHFI22jghfmb',56,'2021-08-19 10:04:25',NULL),('xVWxvv4D8055r3NlHLEgQ2VQEVjl5V2N',57,'2021-08-19 10:04:25',NULL),('zjZz9HmEAIegSrRusYqMInKtL8oXyHU4',76,'2021-08-24 03:00:31',NULL),('ZS9mSflTdVGU46IOvFEVchFGcKXLIWiW',67,'2021-08-24 02:17:24',NULL);

/*Table structure for table `mail_variable_detail` */

DROP TABLE IF EXISTS `mail_variable_detail`;

CREATE TABLE `mail_variable_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `master_vid` varchar(11) DEFAULT NULL,
  `nm_variable` varchar(150) DEFAULT NULL,
  `nm_field` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mail_variable_detail` */

insert  into `mail_variable_detail`(`id`,`master_vid`,`nm_variable`,`nm_field`) values (27,'SET-00002','#NAMA#','name'),(28,'SET-00002','#NOPOL#','account'),(29,'SET-00002','#TGL_TERBIT#','tgl_terbit');

/* Procedure structure for procedure `delete_imaging_master` */

/*!50003 DROP PROCEDURE IF EXISTS  `delete_imaging_master` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_imaging_master`(IN `id` INT)
BEGIN
DELETE FROM imaging_master WHERE imaging_master.id=id;
DELETE FROM imaging_master_detail WHERE imaging_master_detail.id_master=id;
END */$$
DELIMITER ;

/* Procedure structure for procedure `imaging_master_detail_where_id` */

/*!50003 DROP PROCEDURE IF EXISTS  `imaging_master_detail_where_id` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `imaging_master_detail_where_id`(IN `id` INT)
    NO SQL
SELECT * FROM imaging_master_detail WHERE imaging_master_detail.id_master=id GROUP BY imaging_master_detail.no_account */$$
DELIMITER ;

/* Procedure structure for procedure `imaging_master_where_id` */

/*!50003 DROP PROCEDURE IF EXISTS  `imaging_master_where_id` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `imaging_master_where_id`(IN `id` INT)
    NO SQL
SELECT * FROM imaging_master
WHERE imaging_master.id=id */$$
DELIMITER ;

/* Procedure structure for procedure `master_join_product` */

/*!50003 DROP PROCEDURE IF EXISTS  `master_join_product` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `master_join_product`()
    NO SQL
SELECT imaging_master.*, imaging_product.product_name
from imaging_master
JOIN imaging_product ON imaging_product.id=imaging_master.product_id
ORDER by imaging_master.id DESC */$$
DELIMITER ;

/* Procedure structure for procedure `select_imaging_pos` */

/*!50003 DROP PROCEDURE IF EXISTS  `select_imaging_pos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `select_imaging_pos`()
    NO SQL
select * from imaging_pos */$$
DELIMITER ;

/* Procedure structure for procedure `select_imaging_product` */

/*!50003 DROP PROCEDURE IF EXISTS  `select_imaging_product` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `select_imaging_product`(IN `id` INT)
BEGIN
IF (id is null) THEN 
	SELECT * from imaging_product;
ELSE
	SELECT * from imaging_product WHERE 		  imaging_product.id=id;  
END IF;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
