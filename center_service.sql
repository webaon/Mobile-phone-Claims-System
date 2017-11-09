-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `center_service`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `brand` varchar(100) NOT NULL COMMENT 'ยี่ห้อ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ยี่ห้อสินค้า' AUTO_INCREMENT=5 ;

--
-- dump ตาราง `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Aplus'),
(4, 'i-mobile');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `colors`
--

CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `color` varchar(100) NOT NULL COMMENT 'สี',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='สี' AUTO_INCREMENT=5 ;

--
-- dump ตาราง `colors`
--

INSERT INTO `colors` (`id`, `color`) VALUES
(1, 'ทอง'),
(2, 'ดำ'),
(3, 'ขาว'),
(4, 'ชมพู');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสลูกค้า',
  `name` varchar(255) DEFAULT NULL COMMENT 'ชื่อลูกค้า',
  `address` varchar(45) DEFAULT NULL COMMENT 'ที่อยู่',
  `phone` varchar(10) DEFAULT NULL COMMENT 'เบอร์โทร',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ข้อมูลลูกค้า' AUTO_INCREMENT=10 ;

--
-- dump ตาราง `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `phone`) VALUES
(1, 'คนไหน มาไม', 'pattaya', '0983848585'),
(2, 'มานี คีใจ', 'ชลบุรี', '0984848539'),
(3, 'สมหมาย ไปไหนมา', 'pattaya', '0893485889'),
(4, 'ใกล้ตาย ไข่ดี', '593/11 กรุงเทพ  22111', '0892123333'),
(5, 'กรรมกรร ธรไทย', 'บุรีรัมย์', '0903859588'),
(6, 'การจณา มาจากไหน', 'กทม.', '0903324533'),
(7, 'สมศักดิ์ ชายไทย', '21/122 อ.ศรีราชา จ.ชลบุรี 23322', '0899897090'),
(8, 'สมใจ ไปไหนมา', '12/123 อ.ศรีราชา จ.ชลบุรี 20000', '0912364789'),
(9, 'เด็กดี ในไทย', '21/127 อ.ศรีราชา จ.ชลบุรี 23322', '0598633949');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสพนักงาน',
  `idemployee` varchar(50) DEFAULT NULL COMMENT 'รหัสพนักงาน',
  `f_name` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `l_name` varchar(100) NOT NULL COMMENT 'นามสกุล',
  `n_name` varchar(25) DEFAULT NULL COMMENT 'ชื่อเล่น',
  `user_id` int(11) NOT NULL COMMENT 'สาขา',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idemployee_UNIQUE` (`idemployee`),
  KEY `fk_employees_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='พนักงาน' AUTO_INCREMENT=4 ;

--
-- dump ตาราง `employees`
--

INSERT INTO `employees` (`id`, `idemployee`, `f_name`, `l_name`, `n_name`, `user_id`) VALUES
(1, '08-008', 'สัตยา', 'ประทา', 'Aon', 1),
(2, '08-001', 'สมยศ', 'สีอะไร', 'คน', 4),
(3, '08-009', 'สมหญิง', 'ที่ไหนดี', 'หญิง', 4);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `job_service`
--

CREATE TABLE IF NOT EXISTS `job_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขใบฝาก',
  `user_id` int(11) NOT NULL COMMENT 'สาขา',
  `employees_id` int(11) NOT NULL COMMENT 'พนักงาน',
  `customers_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `product_id` int(11) NOT NULL COMMENT 'สินค้า',
  `job_manner` varchar(255) DEFAULT NULL COMMENT 'อาการ',
  `job_details` text COMMENT 'รายละเอียด',
  `attachment` varchar(255) DEFAULT NULL COMMENT 'อุปกรณ์ที่นำมาด้วย',
  `price_service` int(11) DEFAULT '0' COMMENT 'ค่าบริการ',
  `job_note` text COMMENT 'หมายเหตุ',
  `sta_date` datetime DEFAULT NULL COMMENT 'วันที่ส่งเรื่งเคลม',
  `get_date` datetime DEFAULT NULL COMMENT 'วันที่รับเรื่อง',
  `close_date` datetime DEFAULT NULL COMMENT 'วันที่ปิดงาน',
  `wait_date` datetime DEFAULT NULL COMMENT 'วันที่สาขารับคืน',
  `end_date` datetime DEFAULT NULL COMMENT 'วันที่ลูกค้ารับคืน',
  `status` enum('ยังไม่รับเรื่อง','รับเรื่องแล้ว','ปิดงาน','รอลูกค้ามารับ','ลูกค้ารับคืนแล้ว') DEFAULT 'ยังไม่รับเรื่อง' COMMENT 'สถานะ',
  `note_end` text COMMENT 'หมายเหตุการเคลม',
  `totlo_price` int(11) DEFAULT '0' COMMENT 'ยอดที่ต้องชำระทั้งหมด',
  `suppliers_id` int(11) DEFAULT NULL COMMENT 'ศูนย์บริการ',
  PRIMARY KEY (`id`),
  KEY `fk_job_service_employees1_idx` (`employees_id`),
  KEY `fk_job_service_product2_idx` (`product_id`),
  KEY `fk_job_service_user1_idx` (`user_id`),
  KEY `fk_job_service_suppliers1_idx` (`suppliers_id`),
  KEY `fk_job_service_customers1_idx` (`customers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ใบฝากส่งศูนย์' AUTO_INCREMENT=27 ;

--
-- dump ตาราง `job_service`
--

INSERT INTO `job_service` (`id`, `user_id`, `employees_id`, `customers_id`, `product_id`, `job_manner`, `job_details`, `attachment`, `price_service`, `job_note`, `sta_date`, `get_date`, `close_date`, `wait_date`, `end_date`, `status`, `note_end`, `totlo_price`, `suppliers_id`) VALUES
(1, 1, 1, 1, 1, 'fgf', 'gfdfdgfd', 'sffefef', 0, NULL, '2016-06-15 00:00:00', NULL, NULL, '2016-06-16 20:46:42', '2016-06-16 20:51:26', 'ลูกค้ารับคืนแล้ว', NULL, 0, NULL),
(2, 3, 1, 2, 1, 'yyy', 'yyyyy', 'yyyyyy', 0, NULL, '2016-06-15 00:00:00', NULL, NULL, NULL, NULL, 'ยังไม่รับเรื่อง', NULL, 0, NULL),
(3, 3, 1, 1, 1, 'reeeeer', 'eweweweweweweeew', 'eeeweweewwesdsa', 0, NULL, '2016-06-09 00:00:00', '2016-06-20 07:06:11', NULL, NULL, NULL, 'รับเรื่องแล้ว', NULL, 0, 1),
(4, 1, 1, 2, 1, 'dsaas', 'assasasas', 'aasssas', 0, NULL, '2016-06-09 00:00:00', NULL, NULL, '2016-06-16 19:15:56', NULL, 'รอลูกค้ามารับ', NULL, 0, NULL),
(5, 1, 1, 1, 1, 'fggf', 'dgdg', 'dgdg', 0, NULL, '2016-06-10 00:00:00', '2016-06-17 10:57:42', '2016-06-17 10:58:06', '2016-06-19 12:35:19', NULL, 'รอลูกค้ามารับ', '', 0, 1),
(8, 1, 1, 1, 1, 'ทดสอบ', 'dferere', 'erere', 30, 'rrerer', '2016-06-19 20:54:05', NULL, '2016-06-23 18:48:57', NULL, NULL, 'ปิดงาน', '', 230, NULL),
(10, 1, 1, 1, 8, 'ตกน้ำ', 'จอมองไม่เห็นภาพแต่มีไฟขึ้นมา', 'เครื่อง+แบตเตอร์รี', 50, 'เบอร์สำรองลูกค้า : 089-2875647', '2016-06-19 21:05:27', '2016-06-19 21:48:20', '2016-06-20 07:06:48', NULL, NULL, 'ปิดงาน', '', 0, 3),
(14, 1, 1, 1, 1, 'fdg', 'dgd', 'dg', 0, '', '2016-06-19 21:12:50', '2016-06-19 21:48:14', NULL, NULL, NULL, 'รับเรื่องแล้ว', NULL, 0, 2),
(15, 1, 1, 1, 1, 'ตกน้ำ', 'กดดหฟกดหฟดหดกหดกหด', 'เครื่อง', 0, '', '2016-06-19 21:50:01', NULL, NULL, NULL, NULL, 'ยังไม่รับเรื่อง', NULL, 0, NULL),
(24, 1, 1, 1, 1, 'ไพ', 'ไำพ', 'ไพ', 0, 'ไพ', '2016-06-19 21:53:02', NULL, NULL, NULL, NULL, 'ยังไม่รับเรื่อง', NULL, 0, NULL),
(25, 1, 1, 6, 10, 'เครื่องเปิด/ปิดเอง', 'เครื่องเปิด/ปิดเอง ทำการแฟชโปรแกรมแล้วไม่หาย', 'เครื่อง+แบตเตอร์รี+กล่อง', 0, '-', '2016-06-20 20:17:04', '2016-06-20 22:36:32', '2016-06-23 18:37:17', NULL, NULL, 'ปิดงาน', 'iikkokk', 550, 2),
(26, 1, 1, 9, 16, 'เครื่องเปิดไม่ติด', 'ชาร์จแบตไว้แล้วเครื่องดับเปิดเครื่องอีกครั้งไม่ติด', 'ตัวเครื่องอย่างเดียว', 0, 'เบอร์สำรองลูกค้า : 089-8988475', '2016-06-23 21:22:20', '2016-06-25 18:48:59', '2016-06-23 21:36:08', '2016-06-26 05:14:41', '2016-06-26 05:14:43', 'ลูกค้ารับคืนแล้ว', '', 0, 2);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `product_category_id` int(11) NOT NULL COMMENT 'ประเภทสินค้า',
  `brand_id` int(11) NOT NULL COMMENT 'ยี่ห้อ',
  `model` varchar(255) NOT NULL COMMENT 'รุ่น',
  `color_id` int(11) NOT NULL COMMENT 'สี',
  `ime` varchar(45) NOT NULL COMMENT 'หมายเลขสินค้า',
  `customers_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ime_UNIQUE` (`ime`),
  KEY `fk_product_product_category1_idx` (`product_category_id`),
  KEY `fk_product_brand1_idx` (`brand_id`),
  KEY `fk_product_color1_idx` (`color_id`),
  KEY `fk_product_customers1_idx` (`customers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='สินค้า' AUTO_INCREMENT=17 ;

--
-- dump ตาราง `product`
--

INSERT INTO `product` (`id`, `product_category_id`, `brand_id`, `model`, `color_id`, `ime`, `customers_id`) VALUES
(1, 1, 1, 'iphone4s 16gb', 1, '12223222455', 1),
(5, 1, 1, 'iphone4s 32gb', 1, '122232224555455554566', 2),
(7, 1, 1, 'iphone6', 2, '099999888877666', 1),
(8, 1, 2, 'j200', 2, '12334556667770', 1),
(9, 1, 1, 'iphone5', 2, '12334556667778e', 1),
(10, 1, 2, 'A701', 3, '14333828829930', 6),
(11, 1, 1, 'A500', 2, '1234555555555', 7),
(12, 1, 1, 'iPAD2', 2, '122232233222232', 7),
(13, 1, 1, 'iphone5', 3, '12334556667778', 5),
(14, 2, 2, 'A500', 3, '128938488475775', 8),
(15, 1, 1, 'iphone5', 1, '56466555666545', 8),
(16, 2, 1, 'iPAD4', 2, '1232343356789', 9);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `pd_category` varchar(100) NOT NULL COMMENT 'ประเภทสินค้า',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ประเภทสินค้า' AUTO_INCREMENT=4 ;

--
-- dump ตาราง `product_category`
--

INSERT INTO `product_category` (`id`, `pd_category`) VALUES
(1, 'โทรศัพท์มือถือ'),
(2, 'แทปเล็ต'),
(3, 'เครื่องก๊อปป');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `repairs`
--

CREATE TABLE IF NOT EXISTS `repairs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายการซ่อม',
  `repair` varchar(255) DEFAULT NULL COMMENT 'รายการ',
  `price` int(11) DEFAULT NULL COMMENT 'ราคา',
  `note` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `job_service_id` int(11) NOT NULL COMMENT 'หมายเลขใบเคลม',
  PRIMARY KEY (`id`),
  KEY `fk_repairs_job_service1_idx` (`job_service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='รายการซ่อม' AUTO_INCREMENT=10 ;

--
-- dump ตาราง `repairs`
--

INSERT INTO `repairs` (`id`, `repair`, `price`, `note`, `job_service_id`) VALUES
(2, 'เปลี่ยนกล้องหน้า', 200, '', 5),
(3, 'เปลี่ยนแบต', 350, '', 5),
(4, 'เปลี่ยนแบต', 200, '', 24),
(5, 'เปลี่ยนกล้องหน้า', 350, '', 10),
(6, 'เปลี่ยนกล้องหน้า', 200, '', 25),
(7, 'เปลี่ยนแบต', 350, '', 25),
(8, 'เปลี่ยนกล้องหน้า', 200, '', 8),
(9, 'แฟรชโปรแกรมใหม่', 0, '', 26);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสศูนย์ให้บริการ',
  `supplier` varchar(100) NOT NULL COMMENT 'ชื่อศูนย์บริการ',
  `se_phone` varchar(10) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ศูนย์บริการ' AUTO_INCREMENT=6 ;

--
-- dump ตาราง `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier`, `se_phone`) VALUES
(1, 'Apple', '0989998999'),
(2, 'Samsung', '0999999999'),
(3, 'i-mobile', '0989998777'),
(4, 'centerphone', '0882030611'),
(5, 'aplus', '0989888789');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL COMMENT 'สาขา',
  `password` varchar(100) NOT NULL COMMENT 'Password',
  `user_type` enum('User','UserPro','Admin') NOT NULL DEFAULT 'User' COMMENT 'กลุ่มสถานะ',
  `last_login` datetime DEFAULT NULL COMMENT 'เข้าระบบล่าสุด',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ผู้ใช้างาน' AUTO_INCREMENT=6 ;

--
-- dump ตาราง `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `user_type`, `last_login`) VALUES
(1, 'c1', '1', 'User', '2016-06-26 07:25:57'),
(2, 'admin', 'admin', 'Admin', '2016-06-25 20:28:25'),
(3, 'c2', '2', 'User', '2016-06-23 21:12:37'),
(4, 'c3', '3', 'User', '0000-00-00 00:00:00'),
(5, 'c4', '4', 'User', '0000-00-00 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_employees_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `job_service`
--
ALTER TABLE `job_service`
  ADD CONSTRAINT `fk_job_service_customers1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_job_service_employees1` FOREIGN KEY (`employees_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_job_service_product2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_job_service_suppliers1` FOREIGN KEY (`suppliers_id`) REFERENCES `suppliers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_job_service_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_color1` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_customers1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_product_category1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `repairs`
--
ALTER TABLE `repairs`
  ADD CONSTRAINT `fk_repairs_job_service1` FOREIGN KEY (`job_service_id`) REFERENCES `job_service` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
