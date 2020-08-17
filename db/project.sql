/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.12-MariaDB : Database - fk_project
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `log_activity` */

DROP TABLE IF EXISTS `log_activity`;

CREATE TABLE `log_activity` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_project` int(20) DEFAULT 0,
  `id_project_d` int(20) DEFAULT 0,
  `activity_type` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `value` varchar(250) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `note` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `user_insert` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `log_activity` */

insert  into `log_activity`(`id`,`id_project`,`id_project_d`,`activity_type`,`value`,`note`,`user_insert`,`insert_at`) values 
(1,1,0,'create_project','',NULL,'admin','2020-07-23 14:53:45'),
(2,1,1,'input-pattern-plan','07/07/2020','<p>TES </p>','jpg','2020-07-23 15:24:17'),
(3,1,2,'input-tec-sheet-plan','24/07/2020','<p>CONTOH <u><b xss=removed>NOTE</b></u></p>','admin','2020-07-24 10:18:35'),
(4,1,3,'input-tec-sheet-plan','24/07/2020','<p>CONTOH <u><b xss=removed>NOTE</b></u></p>','admin','2020-07-24 10:19:07'),
(5,1,4,'input-tec-sheet-plan','08/07/2020','<p>NOTE</p>','admin','2020-07-24 11:09:02'),
(6,2,0,'create_project','',NULL,'admin','2020-07-24 11:18:05'),
(7,1,5,'input-tec-sheet-actual','','<p><br></p>','admin','2020-07-24 13:20:27'),
(8,1,6,'input-sewing-actual','31/07/2020','<p><br></p>','admin','2020-07-24 13:24:16'),
(9,1,7,'input-kirim-plan','03/08/2020','<p><br></p>','admin','2020-07-24 13:25:38'),
(10,1,8,'input-kirim-actual','20/08/2020','','admin','2020-07-24 13:26:01'),
(11,1,9,'input-persiapan-plan','20/07/2020','<p><br></p>','admin','2020-07-24 13:46:39'),
(12,1,10,'input-persiapan-actual','21/07/2020','','admin','2020-07-24 13:46:50'),
(13,1,11,'input-persiapan-actual','21/07/2020','','admin','2020-07-24 13:47:01'),
(14,1,12,'input-tec-sheet-actual','30/07/2020','<p><br></p>','admin','2020-07-24 14:29:25'),
(15,1,13,'input-tec-sheet-actual','','','admin','2020-07-24 14:29:40'),
(16,1,14,'input-tec-sheet-actual','08/07/2020','<p><br></p>','admin','2020-07-27 13:12:38'),
(17,3,0,'create_project','',NULL,'jpg','2020-07-27 13:50:40'),
(18,4,0,'create_project','',NULL,'admin','2020-08-05 16:06:12'),
(19,1,15,'input-cad-plan','03/08/2020','<p><br></p>','admin','2020-08-05 16:07:49'),
(20,1,16,'input-cad-actual','04/08/2020','','admin','2020-08-05 16:07:57'),
(21,1,17,'input-cutting-plan','11/08/2020','<p><br></p>','admin','2020-08-05 16:08:34'),
(22,1,18,'input-sewing-actual','05/08/2020','','admin','2020-08-05 16:08:48'),
(23,1,19,'input-sewing-plan','05/08/2020','','admin','2020-08-05 16:08:53'),
(24,1,20,'input-cutting-plan','04/08/2020','','admin','2020-08-05 16:08:59'),
(25,1,21,'input-cutting-actual','04/08/2020','','admin','2020-08-05 16:09:04'),
(26,1,22,'input-kirim-actual','','','admin','2020-08-05 16:09:21'),
(27,1,23,'input-kirim-actual','05/08/2020','','admin','2020-08-05 16:09:30'),
(28,1,24,'input-kirim-plan','05/08/2020','','admin','2020-08-05 16:09:35'),
(29,1,25,'input-fg-plan','05/08/2020','','admin','2020-08-05 16:09:40'),
(30,1,26,'input-fg-actual','05/08/2020','','admin','2020-08-05 16:09:45'),
(31,1,27,'input-line','JAS A','','admin','2020-08-05 16:10:05'),
(32,1,28,'input-mastercode','M.J01.123456.001B','','admin','2020-08-05 16:10:24'),
(33,1,29,'input-pattern-actual','07/07/2020','','admin','2020-08-05 16:10:37'),
(34,1,30,'input-fabric-actual','17/08/2020','','admin','2020-08-05 16:10:47'),
(35,1,31,'input-fabric-actual','17/07/2020','','admin','2020-08-05 16:10:54'),
(36,1,32,'input-aksesories-actual','22/07/2020','','admin','2020-08-05 16:11:05'),
(37,2,33,'input-aksesories-plan','14/08/2020','<p><br></p>','admin','2020-08-14 15:06:26'),
(38,2,34,'input-aksesories-actual','06/08/2020','<p><br></p>','admin','2020-08-14 15:08:56'),
(39,2,35,'input-fabric-actual','14/08/2020','<p><br></p>','admin','2020-08-14 15:16:38'),
(40,2,36,'input-persiapan-plan','10/08/2020','<p><br></p>','admin','2020-08-14 15:30:18'),
(41,2,37,'input-persiapan-actual','12/08/2020','','admin','2020-08-14 15:30:26'),
(42,2,38,'input-cad-plan','13/08/2020','','admin','2020-08-14 15:30:35'),
(43,2,39,'input-tec-sheet-plan','01/08/2020','<p><br></p>','admin','2020-08-14 15:31:36'),
(44,2,40,'input-tec-sheet-actual','02/08/2020','<p><br></p>','admin','2020-08-14 15:32:24'),
(45,2,41,'input-pattern-plan','04/08/2020','','admin','2020-08-14 15:32:32'),
(46,2,42,'input-pattern-actual','05/08/2020','','admin','2020-08-14 15:32:40'),
(47,2,43,'input-fabric-plan','06/08/2020','','admin','2020-08-14 15:32:52'),
(48,2,44,'input-mastercode','m.j01.12345.0003','<p><br></p>','admin','2020-08-14 15:34:06'),
(49,2,45,'input-line','jas b','','admin','2020-08-14 15:34:14'),
(50,5,0,'create_project','',NULL,'admin','2020-08-14 15:41:25');

/*Table structure for table `ms_action` */

DROP TABLE IF EXISTS `ms_action`;

CREATE TABLE `ms_action` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `action_type` varchar(60) DEFAULT '',
  `form_update` varchar(250) DEFAULT '',
  `field` varchar(60) DEFAULT '',
  `data_type` varchar(30) DEFAULT '',
  `keterangan` varchar(250) DEFAULT '',
  `status` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `ms_action` */

insert  into `ms_action`(`id`,`action_type`,`form_update`,`field`,`data_type`,`keterangan`,`status`) values 
(1,'input-tec-sheet-plan','<input type=\"text\" class=\"form-control datepicker\" name=\"input-tec-sheet-plan\" id=\"input-tec-sheet-plan\" />','tec_sheet_plan','date','',1),
(2,'input-tec-sheet-actual','<input type=\"text\" class=\"form-control datepicker\" name=\"input-tec-sheet-actual\" id=\"input-tec-sheet-actual\" />','tec_sheet_actual','date','',1),
(3,'input-pattern-plan','<input type=\"text\" class=\"form-control datepicker\" name=\"input-pattern-plan\" id=\"input-pattern-plan\" />','pattern_plan','date','',1),
(4,'input-pattern-actual','<input type=\"text\" class=\"form-control datepicker\" name=\"input-pattern-actual\" id=\"input-pattern-actual\" />','pattern_actual','date','',1),
(5,'input-fabric-plan','<input type=\"text\" class=\"form-control datepicker\" name=\"input-fabric-plan\" id=\"input-fabric-plan\" />','fabric_plan','date','',1),
(6,'input-fabric-actual','<input type=\"text\" class=\"form-control datepicker\" name=\"input-fabric-actual\" id=\"input-fabric-actual\" />','fabric_actual','date','',1),
(7,'input-aksesories-plan','<input type=\"text\" class=\"form-control datepicker\" name=\"input-aksesories-plan\" id=\"input-aksesories-plan\" />','aksesories_plan','date','',1),
(8,'input-aksesories-actual','<input type=\"text\" class=\"form-control datepicker\" name=\"input-aksesories-actual\" id=\"input-aksesories-actual\" />','aksesories_actual','date','',1),
(9,'input-mastercode','<input type=\"text\" class=\"form-control\" name=\"input-mastercode\" id=\"input-mastercode\" />','master_code','string','',1),
(10,'input-line','<input type=\"text\" class=\"form-control\" name=\"input-line\" id=\"input-line\" />','line','string','',1),
(11,'input-persiapan-plan','<input type=\"text\" class=\"form-control datepicker\" name=\"input-persiapan-plan\" id=\"input-persiapan-plan\" />','persiapan_plan','date','',1),
(12,'input-persiapan-actual','<input type=\"text\" class=\"form-control datepicker\" name=\"input-persiapan-actual\" id=\"input-persiapan-actual\" />','persiapan_actual','date','',1),
(13,'input-cutting-plan','<input type=\"text\" class=\"form-control datepicker\" name=\"input-cutting-plan\" id=\"input-cutting-plan\" />','cutting_plan','date','',1),
(14,'input-cutting-actual','<input type=\"text\" class=\"form-control datepicker\" name=\"input-cutting-actual\" id=\"input-cutting-actual\" />','cutting_actual','date','',1),
(15,'input-cad-plan','<input type=\"text\" class=\"form-control datepicker\" name=\"input-cad-plan\" id=\"input-cad-plan\" />','cad_plan','date','',1),
(16,'input-cad-actual','<input type=\"text\" class=\"form-control datepicker\" name=\"input-cad-actual\" id=\"input-cad-actual\" />','cad_actual','date','',1),
(17,'input-sewing-plan','<input type=\"text\" class=\"form-control datepicker\" name=\"input-sewing-plan\" id=\"input-sewing-plan\" />','sewing_plan','date','',1),
(18,'input-sewing-actual','<input type=\"text\" class=\"form-control datepicker\" name=\"input-sewing-actual\" id=\"input-sewing-actual\" />','sewing_actual','date','',1),
(19,'input-fg-plan','<input type=\"text\" class=\"form-control datepicker\" name=\"input-fg-plan\" id=\"input-fg-plan\" />','fg_plan','date','',1),
(20,'input-fg-actual','<input type=\"text\" class=\"form-control datepicker\" name=\"input-fg-actual\" id=\"input-fg-actual\" />','fg_actual','date','',1),
(21,'input-kirim-plan','<input type=\"text\" class=\"form-control datepicker\" name=\"input-kirim-plan\" id=\"input-kirim-plan\" />','kirim_plan','date','',1),
(22,'input-kirim-actual','<input type=\"text\" class=\"form-control datepicker\" name=\"input-kirim-actual\" id=\"input-kirim-actual\" />','kirim_actual','date','',1),
(23,'input-keterangan','<input type=\"text\" class=\"form-control\" name=\"input-keterangan\" id=\"input-keterangan\" />','keterangan','string','',1),
(24,'create_project','','create_project','','',1);

/*Table structure for table `project_attachment` */

DROP TABLE IF EXISTS `project_attachment`;

CREATE TABLE `project_attachment` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_project_d` int(20) DEFAULT 0,
  `lampiran` varchar(250) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `project_attachment` */

insert  into `project_attachment`(`id`,`id_project_d`,`lampiran`,`insert_at`,`user_insert`) values 
(1,3,'20200724051812/2683.jpg','2020-07-24 10:19:07',''),
(2,3,'20200724051815/bersin.jpg','2020-07-24 10:19:07',''),
(3,4,'20200724060854/poster-ramadhan.psd','2020-07-24 11:09:02',''),
(4,4,'20200724060854/sedang_1582720816_CEGAH+VIRUS+CORONA.jpg','2020-07-24 11:09:02',''),
(5,5,'20200724082023/Ganti_rugi_shoulder_pad.xlsx','2020-07-24 13:20:27',''),
(6,13,'20200724092936/CASH_FLOW_2017.xlsx','2020-07-24 14:29:40',''),
(7,14,'20200727081235/2683.jpg','2020-07-27 13:12:38',''),
(8,33,'20200814100619/nexmo_pricing.xlsx','2020-08-14 15:06:26',''),
(9,34,'20200814100848/nexmo_pricing.xlsx','2020-08-14 15:08:56',''),
(10,35,'20200814101636/nexmo_pricing.xlsx','2020-08-14 15:16:38','');

/*Table structure for table `project_d` */

DROP TABLE IF EXISTS `project_d`;

CREATE TABLE `project_d` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_project` int(20) DEFAULT 0,
  `description` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `project_d` */

insert  into `project_d`(`id`,`id_project`,`description`,`insert_at`,`user_insert`) values 
(1,1,'<p>TES </p>','2020-07-23 15:24:17','jpg'),
(2,1,'<p>CONTOH <u><b xss=removed>NOTE</b></u></p>','2020-07-24 10:18:35','admin'),
(3,1,'<p>CONTOH <u><b xss=removed>NOTE</b></u></p>','2020-07-24 10:19:07','admin'),
(4,1,'<p>NOTE</p>','2020-07-24 11:09:02','admin'),
(5,1,'<p><br></p>','2020-07-24 13:20:27','admin'),
(6,1,'<p><br></p>','2020-07-24 13:24:16','admin'),
(7,1,'<p><br></p>','2020-07-24 13:25:38','admin'),
(8,1,'','2020-07-24 13:26:01','admin'),
(9,1,'<p><br></p>','2020-07-24 13:46:39','admin'),
(10,1,'','2020-07-24 13:46:50','admin'),
(11,1,'','2020-07-24 13:47:01','admin'),
(12,1,'<p><br></p>','2020-07-24 14:29:25','admin'),
(13,1,'','2020-07-24 14:29:40','admin'),
(14,1,'<p><br></p>','2020-07-27 13:12:38','admin'),
(15,1,'<p><br></p>','2020-08-05 16:07:49','admin'),
(16,1,'','2020-08-05 16:07:57','admin'),
(17,1,'<p><br></p>','2020-08-05 16:08:34','admin'),
(18,1,'','2020-08-05 16:08:48','admin'),
(19,1,'','2020-08-05 16:08:53','admin'),
(20,1,'','2020-08-05 16:08:59','admin'),
(21,1,'','2020-08-05 16:09:04','admin'),
(22,1,'','2020-08-05 16:09:21','admin'),
(23,1,'','2020-08-05 16:09:30','admin'),
(24,1,'','2020-08-05 16:09:35','admin'),
(25,1,'','2020-08-05 16:09:40','admin'),
(26,1,'','2020-08-05 16:09:45','admin'),
(27,1,'','2020-08-05 16:10:05','admin'),
(28,1,'','2020-08-05 16:10:24','admin'),
(29,1,'','2020-08-05 16:10:37','admin'),
(30,1,'','2020-08-05 16:10:47','admin'),
(31,1,'','2020-08-05 16:10:54','admin'),
(32,1,'','2020-08-05 16:11:05','admin'),
(33,2,'<p><br></p>','2020-08-14 15:06:26','admin'),
(34,2,'<p><br></p>','2020-08-14 15:08:56','admin'),
(35,2,'<p><br></p>','2020-08-14 15:16:38','admin'),
(36,2,'<p><br></p>','2020-08-14 15:30:18','admin'),
(37,2,'','2020-08-14 15:30:26','admin'),
(38,2,'','2020-08-14 15:30:35','admin'),
(39,2,'<p><br></p>','2020-08-14 15:31:36','admin'),
(40,2,'<p><br></p>','2020-08-14 15:32:24','admin'),
(41,2,'','2020-08-14 15:32:32','admin'),
(42,2,'','2020-08-14 15:32:40','admin'),
(43,2,'','2020-08-14 15:32:52','admin'),
(44,2,'<p><br></p>','2020-08-14 15:34:06','admin'),
(45,2,'','2020-08-14 15:34:14','admin');

/*Table structure for table `project_h` */

DROP TABLE IF EXISTS `project_h`;

CREATE TABLE `project_h` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(120) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `brand` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `kontrak` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `item` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `style` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `no_pattern` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `order` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `size` varchar(250) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `qty` double DEFAULT 0,
  `price` double DEFAULT 0,
  `tec_sheet_plan` date DEFAULT NULL,
  `tec_sheet_actual` date DEFAULT NULL,
  `pattern_plan` date DEFAULT NULL,
  `pattern_actual` date DEFAULT NULL,
  `fabric_plan` date DEFAULT NULL,
  `fabric_actual` date DEFAULT NULL,
  `aksesories_plan` date DEFAULT NULL,
  `aksesories_actual` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `tujuan_sample` varchar(500) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `master_code` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `line` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `persiapan_plan` date DEFAULT NULL,
  `persiapan_actual` date DEFAULT NULL,
  `cutting_plan` date DEFAULT NULL,
  `cutting_actual` date DEFAULT NULL,
  `cad_plan` date DEFAULT NULL,
  `cad_actual` date DEFAULT NULL,
  `sewing_plan` date DEFAULT NULL,
  `sewing_actual` date DEFAULT NULL,
  `fg_plan` date DEFAULT NULL,
  `fg_actual` date DEFAULT NULL,
  `kirim_plan` date DEFAULT NULL,
  `kirim_actual` date DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `update_at` datetime DEFAULT NULL,
  `user_update` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `project_h` */

insert  into `project_h`(`id`,`type`,`brand`,`kontrak`,`item`,`style`,`no_pattern`,`order`,`size`,`qty`,`price`,`tec_sheet_plan`,`tec_sheet_actual`,`pattern_plan`,`pattern_actual`,`fabric_plan`,`fabric_actual`,`aksesories_plan`,`aksesories_actual`,`due_date`,`tujuan_sample`,`master_code`,`line`,`persiapan_plan`,`persiapan_actual`,`cutting_plan`,`cutting_actual`,`cad_plan`,`cad_actual`,`sewing_plan`,`sewing_actual`,`fg_plan`,`fg_actual`,`kirim_plan`,`kirim_actual`,`keterangan`,`insert_at`,`user_insert`,`update_at`,`user_update`) values 
(1,'LADIES','IMAGINE','S101','JK','GJ215003-A','18SS-IMG-JK-1B-M2','NEW','7X2, 9X2, 11X1',5,18,'2020-07-08','2020-07-08','2020-07-07','2020-07-07','2020-07-15','2020-07-17','2020-07-22','2020-07-22','2020-08-31','SAMPLE PERS IMGN (S101) 21SS','M.J01.123456.001B','JAS A','2020-07-20','2020-07-21','2020-08-04','2020-08-04','2020-08-03','2020-08-04','2020-08-05','2020-08-05','2020-08-05','2020-08-05','2020-08-05','2020-08-05',NULL,'2020-07-23 14:53:45','admin',NULL,''),
(2,'LADIES','N-LINE','S104','JK','NJ195050-C','21SS-FR-CU-02','NEW','7X2, 9X2, 11X1',5,18,'2020-08-01','2020-08-02','2020-08-04','2020-08-05','2020-08-06','2020-08-14','2020-08-14','2020-08-06','2020-08-07','(S104) 21SS 先上げ兼ね撮影サンプル/ PRA PRO JP','m.j01.12345.0003','jas b','2020-08-10','2020-08-12',NULL,NULL,'2020-08-13',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-07-24 11:18:05','admin',NULL,''),
(3,'LADIES','HILTON','S107','SK','HR205081-C','F-S-LDS-006','REPEAT','7×2 / 9×2 / 11×1',5,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-08-07','プレス会用サンプル','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-07-27 13:50:40','jpg',NULL,''),
(4,'LADIES','IMAGINE','S101','JK','GJ215003-A','18SS-IMG-JK-1B-M2','NEW','7X2, 9X2, 11X1',5,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-07-17','SAMPLE PERS IMGN (S101) 21SS','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-08-05 16:06:12','admin',NULL,''),
(5,'LADIES','IMAGINE','91KI70F062','JK','123456-03','123456-11','NEW','7X2, 9X2',1,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-08-28','SAMPLE','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-08-14 15:41:25','admin',NULL,'');

/*Table structure for table `tb_menu` */

DROP TABLE IF EXISTS `tb_menu`;

CREATE TABLE `tb_menu` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `label` varchar(120) DEFAULT '',
  `icon` varchar(60) DEFAULT '',
  `url` varchar(120) DEFAULT '',
  `fungsi` varchar(30) DEFAULT '',
  `method` varchar(30) DEFAULT '',
  `parent` int(20) DEFAULT 0,
  `urutan` double DEFAULT 0,
  `status` int(1) DEFAULT 1,
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) DEFAULT '',
  `update_at` datetime DEFAULT NULL,
  `user_update` varchar(60) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tb_menu` */

insert  into `tb_menu`(`id`,`label`,`icon`,`url`,`fungsi`,`method`,`parent`,`urutan`,`status`,`insert_at`,`user_insert`,`update_at`,`user_update`) values 
(1,'menu_dashboard','nav-icon fas fa-tachometer-alt','Main/index','Main','index',0,1,1,'2020-07-09 09:01:15','',NULL,''),
(2,'menu_add_project','nav-icon fas fa-folder-plus','Project/add','Project','add',0,2,1,'2020-07-09 09:27:16','',NULL,''),
(3,'menu_project_list','nav-icon fas fa-list','Project/list','Project','list',0,3,1,'2020-07-09 09:34:04','',NULL,''),
(4,'menu_logout','nav-icon fas fa-lock','','','',0,9999,1,'2020-07-09 11:08:32','',NULL,''),
(5,'menu_manajemen_menu','nav-icon fas fa-user','Menu/user','Menu','user',0,9998,1,'2020-07-24 13:19:07','',NULL,''),
(6,'menu_change_password','nav-icon fas fa-exchange-alt','User/change_password','User','change_password',0,9997,1,'2020-07-24 13:29:43','',NULL,''),
(7,'menu_management_user','nav-icon fas fa-user','User/index','User','index',0,9996,1,'2020-07-24 14:00:41','',NULL,''),
(8,'menu_privilege','nav-icon fas fa-fingerprint','User/privilege','User','privilege',0,9995,1,'2020-07-27 09:24:58','',NULL,'');

/*Table structure for table `tb_menu_setting` */

DROP TABLE IF EXISTS `tb_menu_setting`;

CREATE TABLE `tb_menu_setting` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_menu` int(20) DEFAULT 0,
  `tools` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `status` int(1) DEFAULT 1,
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `tb_menu_setting` */

insert  into `tb_menu_setting`(`id`,`id_menu`,`tools`,`status`,`insert_at`,`user_insert`) values 
(1,3,'tec-sheet-plan-kirim',1,'2020-07-24 10:33:52',''),
(2,3,'tec-sheet-actual-kirim',1,'2020-07-24 10:34:22',''),
(3,3,'pattern-plan-kirim',1,'2020-07-24 10:34:51',''),
(4,3,'pattern-actual-kirim',1,'2020-07-24 10:34:57',''),
(5,3,'fabric-kirim',1,'2020-07-24 10:35:10',''),
(6,3,'fabric-kedatangan',1,'2020-07-24 10:35:16',''),
(7,3,'aksesories-kirim',1,'2020-07-24 10:35:32',''),
(8,3,'aksesories-kedatangan',1,'2020-07-24 10:35:46',''),
(9,3,'master-code',1,'2020-07-24 10:36:02',''),
(10,3,'line',1,'2020-07-24 10:36:09',''),
(11,3,'persiapan-finish-plan',1,'2020-07-24 10:36:21',''),
(12,3,'persiapan-finish-actual',1,'2020-07-24 10:36:31',''),
(13,3,'cutting-finish-plan',1,'2020-07-24 10:37:04',''),
(14,3,'cutting-finish-actual',1,'2020-07-24 10:48:31',''),
(15,3,'cad-finish-plan',1,'2020-07-24 10:48:44',''),
(16,3,'cad-finish-actual',1,'2020-07-24 10:48:54',''),
(17,3,'sewing-finish-plan',1,'2020-07-24 10:49:04',''),
(18,3,'sewing-finish-actual',1,'2020-07-24 10:49:10',''),
(19,3,'finish-goods-plan',1,'2020-07-24 10:49:24',''),
(20,3,'finish-goods-actual',1,'2020-07-24 10:49:32',''),
(21,3,'kirim-plan',1,'2020-07-24 10:49:43',''),
(22,3,'kirim-actual',1,'2020-07-24 10:49:47',''),
(23,3,'keterangan',1,'2020-07-24 10:49:56','');

/*Table structure for table `tb_privilege` */

DROP TABLE IF EXISTS `tb_privilege`;

CREATE TABLE `tb_privilege` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_menu` int(20) DEFAULT 0,
  `username` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `tools` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `status` int(1) DEFAULT 1,
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

/*Data for the table `tb_privilege` */

insert  into `tb_privilege`(`id`,`id_menu`,`username`,`tools`,`status`,`insert_at`,`user_insert`) values 
(39,3,'jpg','tec-sheet-plan-kirim',1,'2020-07-27 10:23:25','admin'),
(40,3,'jpg','tec-sheet-actual-kirim',1,'2020-07-27 10:23:25','admin'),
(41,3,'jpg','pattern-plan-kirim',1,'2020-07-27 10:23:25','admin'),
(42,3,'jpg','pattern-actual-kirim',1,'2020-07-27 10:23:25','admin'),
(43,3,'jpg','fabric-kirim',1,'2020-07-27 10:23:25','admin'),
(44,3,'jpg','aksesories-kirim',1,'2020-07-27 10:23:25','admin'),
(62,3,'indo','fabric-kedatangan',1,'2020-07-27 10:25:08','admin'),
(63,3,'indo','aksesories-kedatangan',1,'2020-07-27 10:25:08','admin'),
(64,3,'indo','master-code',1,'2020-07-27 10:25:08','admin'),
(65,3,'indo','line',1,'2020-07-27 10:25:08','admin'),
(66,3,'indo','persiapan-finish-plan',1,'2020-07-27 10:25:08','admin'),
(67,3,'indo','persiapan-finish-actual',1,'2020-07-27 10:25:08','admin'),
(68,3,'indo','cutting-finish-plan',1,'2020-07-27 10:25:08','admin'),
(69,3,'indo','cutting-finish-actual',1,'2020-07-27 10:25:08','admin'),
(70,3,'indo','cad-finish-plan',1,'2020-07-27 10:25:08','admin'),
(71,3,'indo','cad-finish-actual',1,'2020-07-27 10:25:08','admin'),
(72,3,'indo','sewing-finish-plan',1,'2020-07-27 10:25:08','admin'),
(73,3,'indo','sewing-finish-actual',1,'2020-07-27 10:25:08','admin'),
(74,3,'indo','finish-goods-plan',1,'2020-07-27 10:25:08','admin'),
(75,3,'indo','finish-goods-actual',1,'2020-07-27 10:25:08','admin'),
(76,3,'indo','kirim-plan',1,'2020-07-27 10:25:08','admin'),
(77,3,'indo','kirim-actual',1,'2020-07-27 10:25:08','admin'),
(78,3,'indo','keterangan',1,'2020-07-27 10:25:08','admin'),
(79,3,'admin','tec-sheet-plan-kirim',1,'2020-07-27 10:25:33','admin'),
(80,3,'admin','tec-sheet-actual-kirim',1,'2020-07-27 10:25:33','admin'),
(81,3,'admin','pattern-plan-kirim',1,'2020-07-27 10:25:33','admin'),
(82,3,'admin','pattern-actual-kirim',1,'2020-07-27 10:25:33','admin'),
(83,3,'admin','fabric-kirim',1,'2020-07-27 10:25:33','admin'),
(84,3,'admin','fabric-kedatangan',1,'2020-07-27 10:25:33','admin'),
(85,3,'admin','aksesories-kirim',1,'2020-07-27 10:25:33','admin'),
(86,3,'admin','aksesories-kedatangan',1,'2020-07-27 10:25:33','admin'),
(87,3,'admin','master-code',1,'2020-07-27 10:25:33','admin'),
(88,3,'admin','line',1,'2020-07-27 10:25:33','admin'),
(89,3,'admin','persiapan-finish-plan',1,'2020-07-27 10:25:33','admin'),
(90,3,'admin','persiapan-finish-actual',1,'2020-07-27 10:25:33','admin'),
(91,3,'admin','cutting-finish-plan',1,'2020-07-27 10:25:33','admin'),
(92,3,'admin','cutting-finish-actual',1,'2020-07-27 10:25:33','admin'),
(93,3,'admin','cad-finish-plan',1,'2020-07-27 10:25:33','admin'),
(94,3,'admin','cad-finish-actual',1,'2020-07-27 10:25:33','admin'),
(95,3,'admin','sewing-finish-plan',1,'2020-07-27 10:25:33','admin'),
(96,3,'admin','sewing-finish-actual',1,'2020-07-27 10:25:33','admin'),
(97,3,'admin','finish-goods-plan',1,'2020-07-27 10:25:33','admin'),
(98,3,'admin','finish-goods-actual',1,'2020-07-27 10:25:33','admin'),
(99,3,'admin','kirim-plan',1,'2020-07-27 10:25:33','admin'),
(100,3,'admin','kirim-actual',1,'2020-07-27 10:25:33','admin'),
(101,3,'admin','keterangan',1,'2020-07-27 10:25:33','admin'),
(102,3,'budi','tec-sheet-plan-kirim',1,'2020-08-04 11:27:39','admin'),
(103,3,'budi','tec-sheet-actual-kirim',1,'2020-08-04 11:27:39','admin'),
(104,3,'budi','pattern-plan-kirim',1,'2020-08-04 11:27:39','admin');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `password` varchar(120) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `profile_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `image` varchar(250) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `phone` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `email` varchar(120) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `session` varchar(120) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `last_login` datetime DEFAULT NULL,
  `language` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT 'english',
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `update_at` datetime DEFAULT NULL,
  `user_update` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `status` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`profile_name`,`image`,`phone`,`email`,`session`,`last_login`,`language`,`insert_at`,`user_insert`,`update_at`,`user_update`,`status`) values 
(1,'admin','7cfa28cde915ea86f0906b343435ce28','Super Admin','','','admin@localhost','e8b9a57b0a39c6fb74e9e8f229878741','2020-08-14 15:18:32','english','2020-07-09 08:59:23','-','2020-07-27 10:51:09','admin',1),
(2,'jpg','dface3503e6a0753c0584d2cab38baf6','Fukuryo Japan','','','','c41381cb1fc0d832e2c8014bb1f767d3','2020-08-14 15:46:45','japan','2020-07-23 15:03:32','-','2020-07-27 13:14:51','jpg',1),
(3,'indo','dface3503e6a0753c0584d2cab38baf6','Fukuryo Indo','','','','2355e18f9e0b884dc2bba7fecb50da95','2020-07-27 13:15:29','english','2020-07-23 15:04:06','-','2020-07-27 13:15:21','indo',1),
(4,'budi','410d12f121d35849f16ace2235decf77','budi','','','','06e7cf73dc5a18480c10a785d68be4f1','2020-08-04 11:27:48','japan','2020-08-04 11:25:54','admin','2020-08-04 11:27:08','budi',1);

/*Table structure for table `tb_user_menu` */

DROP TABLE IF EXISTS `tb_user_menu`;

CREATE TABLE `tb_user_menu` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_menu` int(20) DEFAULT 0,
  `username` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user_menu` */

insert  into `tb_user_menu`(`id`,`id_menu`,`username`,`insert_at`,`user_insert`) values 
(39,1,'admin','2020-07-27 09:25:13','admin'),
(40,2,'admin','2020-07-27 09:25:13','admin'),
(41,3,'admin','2020-07-27 09:25:13','admin'),
(42,4,'admin','2020-07-27 09:25:13','admin'),
(43,5,'admin','2020-07-27 09:25:13','admin'),
(44,6,'admin','2020-07-27 09:25:13','admin'),
(45,7,'admin','2020-07-27 09:25:13','admin'),
(46,8,'admin','2020-07-27 09:25:13','admin'),
(47,1,'jpg','2020-07-27 10:25:58','admin'),
(48,2,'jpg','2020-07-27 10:25:58','admin'),
(49,3,'jpg','2020-07-27 10:25:58','admin'),
(50,4,'jpg','2020-07-27 10:25:58','admin'),
(51,6,'jpg','2020-07-27 10:25:58','admin'),
(52,1,'indo','2020-07-27 10:26:06','admin'),
(53,3,'indo','2020-07-27 10:26:06','admin'),
(54,6,'indo','2020-07-27 10:26:06','admin'),
(55,4,'indo','2020-07-27 10:26:06','admin'),
(60,1,'budi','2020-08-04 11:27:24','admin'),
(61,2,'budi','2020-08-04 11:27:24','admin'),
(62,3,'budi','2020-08-04 11:27:24','admin'),
(63,4,'budi','2020-08-04 11:27:24','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
