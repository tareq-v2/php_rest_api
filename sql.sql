/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.20-MariaDB : Database - onlineshopping
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`onlineshopping` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `onlineshopping`;

/*Table structure for table `about_us` */

DROP TABLE IF EXISTS `about_us`;

CREATE TABLE `about_us` (
  `title` varchar(20) NOT NULL,
  `details` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `about_us` */

insert  into `about_us`(`title`,`details`) values ('About Us','About Details');

/*Table structure for table `brand_info` */

DROP TABLE IF EXISTS `brand_info`;

CREATE TABLE `brand_info` (
  `brand_id` varchar(15) NOT NULL,
  `brand_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `brand_info` */

insert  into `brand_info`(`brand_id`,`brand_name`) values ('BRAND-0003','OnePlus'),('BRAND-0004','Samsung'),('BRAND-0005','Vivo'),('BRAND-0006','Oppo'),('BRAND-0010','Lenovo'),('BRAND-0011','Sony');

/*Table structure for table `category_info` */

DROP TABLE IF EXISTS `category_info`;

CREATE TABLE `category_info` (
  `id` varchar(10) NOT NULL,
  `item_id` varchar(10) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `category_info` */

insert  into `category_info`(`id`,`item_id`,`category_name`) values ('CAT-00001','ITEM-00001','Leather Product'),('CAT-00002','ITEM-00001','Watches'),('CAT-00003','ITEM-00001','Perfume'),('CAT-00004','ITEM-00001','Sunglass'),('CAT-00005','ITEM-00001','Health & Beauty'),('CAT-00006','ITEM-00002','Saree'),('CAT-00007','ITEM-00002','Jewelry'),('CAT-00008','ITEM-00002','Kameez & Kurti'),('CAT-00009','ITEM-00002','Western'),('CAT-00010','ITEM-00002','Health & Beauty'),('CAT-00011','ITEM-00002','Accessories'),('CAT-00012','ITEM-00002','Personal Care'),('CAT-00013','ITEM-00002','Watches'),('CAT-00014','ITEM-00003','Kitchen Appliances'),('CAT-00015','ITEM-00003','Security System'),('CAT-00016','ITEM-00004','Laptop'),('CAT-00017','ITEM-00004','Desktop'),('CAT-00018','ITEM-00004','Microphone'),('CAT-00019','ITEM-00004','Speaker'),('CAT-00020','ITEM-00004','Computer Accessories'),('CAT-00021','ITEM-00005','Mobile Phone'),('CAT-00022','ITEM-00005','Mobile Accessories'),('CAT-00023','ITEM-00005','Gadget'),('CAT-00024','ITEM-00006','Smart TV'),('CAT-00025','ITEM-00006','Air Condition'),('CAT-00026','ITEM-00006','Refrigerator'),('CAT-00027','ITEM-00006','Washing Machine'),('CAT-00028','ITEM-00006','Fan'),('CAT-00029','ITEM-00006','Camera'),('CAT-00030','ITEM-00006','Microwave Oven'),('CAT-00031','ITEM-00007','Motor Bike'),('CAT-00032','ITEM-00007','Bike Accessories'),('CAT-00033','ITEM-00009','Baby Care'),('CAT-00034','ITEM-00009','Health & Food'),('CAT-00035','ITEM-00009','Toys'),('CAT-00036','ITEM-00010','Books'),('CAT-00037','ITEM-00010','Stationary'),('CAT-00038','ITEM-00011','Emergency Products'),('CAT-00039','ITEM-00011','Bed Sheet'),('CAT-00040','ITEM-00011','Curtains'),('CAT-00041','ITEM-00011','Home Decore'),('CAT-00042','ITEM-00011','Fitness');

/*Table structure for table `contact_us` */

DROP TABLE IF EXISTS `contact_us`;

CREATE TABLE `contact_us` (
  `title` varchar(20) NOT NULL,
  `details` longtext DEFAULT NULL,
  `map` text DEFAULT NULL,
  PRIMARY KEY (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `contact_us` */

insert  into `contact_us`(`title`,`details`,`map`) values ('Contact Us','Contact Details','https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14597.936335391718!2d90.3711184!3d23.8369382!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7a8f026abc0c0c4f!2sSkill%20Based%20Information%20Technology%20-%20SBIT!5e0!3m2!1sen!2sbd!4v1627822497566!5m2!1sen!2sbd');

/*Table structure for table `create_admin` */

DROP TABLE IF EXISTS `create_admin`;

CREATE TABLE `create_admin` (
  `Name` varchar(50) DEFAULT NULL,
  `Email` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `Password` varchar(25) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `create_admin` */

insert  into `create_admin`(`Name`,`Email`,`phone`,`Password`,`gender`) values ('Aminta','aminta@gmail.com','01679026025','123','Female'),('Babul','babul@gmail.com','465985','123',NULL),('Nahian','nahian@gmail.com','878652','1234',NULL),('Sabina','sabina@gmail.com','7895','123',NULL),('Tushnim','t@gmail.com','01679026025','123',NULL);

/*Table structure for table `gallery` */

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `id` varchar(15) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `slider` varchar(15) DEFAULT NULL,
  `gallery` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `gallery` */

insert  into `gallery`(`id`,`title`,`details`,`slider`,`gallery`) values ('P-00001','Picture-1','Image',NULL,NULL),('P-00002','Picture-2','fgfd','slider',''),('P-00003','Picture-3','6465','slider','gallery');

/*Table structure for table `item_info` */

DROP TABLE IF EXISTS `item_info`;

CREATE TABLE `item_info` (
  `id` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `item_info` */

insert  into `item_info`(`id`,`name`) values ('ITEM-00001','Men\'s Product'),('ITEM-00002','Women\'s Product'),('ITEM-00003','Home Appliances'),('ITEM-00004','Computer & Accessories'),('ITEM-00005','Smartphone & Gadget'),('ITEM-00006','Electronics'),('ITEM-00007','Bike & Automobiles'),('ITEM-00008','Gift Shop'),('ITEM-00009','Kids'),('ITEM-00010','Books & Stationary'),('ITEM-00011','Lifestyle'),('ITEM-00012','Digital Products');

/*Table structure for table `product_info` */

DROP TABLE IF EXISTS `product_info`;


-- what is UNIQUE KEY?
-- How it Work with SQL?

CREATE TABLE `product_info` (
  `pdt_id` varchar(10) NOT NULL,
  `pdt_name` varchar(255) DEFAULT NULL,
  `pdt_item` varchar(15) DEFAULT NULL,
  `pdt_cat` varchar(15) DEFAULT NULL,
  `pdt_sub_cat` varchar(15) DEFAULT NULL,
  `pdt_brand` varchar(15) DEFAULT NULL,
  `pdt_price` double(9,2) DEFAULT NULL,
  `pdt_details` longtext DEFAULT NULL,
  `pdt_condition` text DEFAULT NULL,
  `pdt_stock` double(9,2) DEFAULT NULL,
  `pdt_status` int(5) DEFAULT NULL,
  PRIMARY KEY (`pdt_id`),
  UNIQUE KEY `index1` (`pdt_name`,`pdt_item`,`pdt_cat`,`pdt_brand`,`pdt_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `product_info` */

insert  into `product_info`(`pdt_id`,`pdt_name`,`pdt_item`,`pdt_cat`,`pdt_sub_cat`,`pdt_brand`,`pdt_price`,`pdt_details`,`pdt_condition`,`pdt_stock`,`pdt_status`) values ('PDT-000001','43456','ITEM-00002','CAT-00004','SC-00003','BRAND-0001',6546.00,'',' 54654',9999999.99,1),('PDT-000002','43456','ITEM-00002','CAT-00005','','BRAND-0001',6546.00,'',' 54654',9999999.99,1),('PDT-000003','Power Bank Test','ITEM-00005','CAT-00022','SC-00010','BRAND-0009',100.00,' tyy',' Good',2.00,1);

/*Table structure for table `subcat_info` */

DROP TABLE IF EXISTS `subcat_info`;

CREATE TABLE `subcat_info` (
  `subcat_id` varchar(15) NOT NULL,
  `subcat_name` varchar(50) DEFAULT NULL,
  `item_id` varchar(15) DEFAULT NULL,
  `cat_id` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`subcat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `subcat_info` */

insert  into `subcat_info`(`subcat_id`,`subcat_name`,`item_id`,`cat_id`) values ('SC-00001','Wallet','ITEM-00001','CAT-00001'),('SC-00002','Belt','ITEM-00001','CAT-00001'),('SC-00003','Silk','ITEM-00002','CAT-00006'),('SC-00004','Pure Cotton','ITEM-00002','CAT-00006'),('SC-00005','Jamdani','ITEM-00002','CAT-00006'),('SC-00006','Katan','ITEM-00002','CAT-00006'),('SC-00007','Pendent','ITEM-00002','CAT-00007'),('SC-00008','Earrings','ITEM-00002','CAT-00007'),('SC-00009','Bracelet & Bengles','ITEM-00002','CAT-00007'),('SC-00010','Power Bank','ITEM-00005','CAT-00022'),('SC-00011','Headphone','ITEM-00005','CAT-00022');

/*Table structure for table `user_reg` */

DROP TABLE IF EXISTS `user_reg`;

CREATE TABLE `user_reg` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(35) NOT NULL,
  `user_password` varchar(35) DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_phone` varchar(15) DEFAULT NULL,
  `status` int(2) DEFAULT 0,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `index` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_reg` */

insert  into `user_reg`(`user_id`,`user_name`,`user_email`,`user_password`,`user_address`,`user_phone`,`status`) values (1,'sbit','sbit@gmail.com','123','1234678','Feni',0),(3,'ghjghg','fghfgvhg@fhvgn','1222','21245','gyfjhm ',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
