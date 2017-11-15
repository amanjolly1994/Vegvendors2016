-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2017 at 08:42 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `natrajpo_vegvendors`
--
CREATE DATABASE IF NOT EXISTS `natrajpo_vegvendors` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `natrajpo_vegvendors`;


-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE IF NOT EXISTS `advertisement` (
  `ad_id` int(10) NOT NULL,
  `ad_title` varchar(90) NOT NULL,
  `picture` longtext NOT NULL,
  `link` mediumtext NOT NULL,
  `adv_type` int(90) NOT NULL COMMENT '0 for mobile 1 for web',
  `position` varchar(90) NOT NULL,
  `place_code` int(10) NOT NULL,
  `hyperlocal` tinyint(1) NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`ad_id`, `ad_title`, `picture`, `link`, `adv_type`, `position`, `place_code`, `hyperlocal`) VALUES
(1, 'vv wale', 'http://www.vegvendors.in/android/advertisements/v1.jpg', 'http://www.vegvendors.in', 0, 'main', 1, 0),
(2, 'vv wale', 'http://www.vegvendors.in/android/advertisements/v2.jpg', 'http://www.vegvendors.in', 0, 'main', 1, 0),
(3, 'vv wale', 'http://www.vegvendors.in/android/advertisements/v3.jpg', 'http://www.vegvendors.in', 0, 'main', 1, 0);

--
-- Triggers `advertisement`
--
DROP TRIGGER IF EXISTS `delete_advertisement_trigger`;
DELIMITER //
CREATE TRIGGER `delete_advertisement_trigger` AFTER DELETE ON `advertisement`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'MainJson';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `insert_advertisement_trigger`;
DELIMITER //
CREATE TRIGGER `insert_advertisement_trigger` AFTER INSERT ON `advertisement`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'MainJson';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `update_advertisement_trigger`;
DELIMITER //
CREATE TRIGGER `update_advertisement_trigger` AFTER UPDATE ON `advertisement`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'MainJson';

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `area_table`
--

CREATE TABLE IF NOT EXISTS `area_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area` varchar(90) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `area_table`
--

INSERT INTO `area_table` (`id`, `area`) VALUES
(1, 'Pitampura');

--
-- Triggers `area_table`
--
DROP TRIGGER IF EXISTS `Delete_area_table_trigger`;
DELIMITER //
CREATE TRIGGER `Delete_area_table_trigger` AFTER DELETE ON `area_table`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'areaJson';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Insert_area_table_trigger`;
DELIMITER //
CREATE TRIGGER `Insert_area_table_trigger` AFTER INSERT ON `area_table`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'areaJson';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Update_area_table_trigger`;
DELIMITER //
CREATE TRIGGER `Update_area_table_trigger` AFTER UPDATE ON `area_table`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'areaJson';

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bug_testing`
--

CREATE TABLE IF NOT EXISTS `bug_testing` (
  `post` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bug_testing`
--

INSERT INTO `bug_testing` (`post`) VALUES
('5'),
('6'),
('123'),
('123');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_type_id` int(10) NOT NULL,
  `category_name` varchar(90) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category_type`
--

CREATE TABLE IF NOT EXISTS `category_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_type_name` varchar(90) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category_type`
--

INSERT INTO `category_type` (`id`, `category_type_name`) VALUES
(1, 'vegitables'),
(2, 'fruits');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE IF NOT EXISTS `complain` (
  `srno` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `order_id` int(10) NOT NULL COMMENT 'see main_orders',
  `complain` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(30) NOT NULL,
  `remark` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`srno`, `uid`, `order_id`, `complain`, `date`, `token`, `remark`, `status`) VALUES
(1, 161, 0, 'cvv', '2016-08-08 10:14:32', '', '', 0),
(2, 114, 0, 'hgv', '2016-08-08 10:42:38', '', '', 0),
(3, 114, 0, 'hgv', '2016-08-08 10:43:12', '', '', 0),
(4, 114, 0, 'hgv', '2016-08-08 10:43:12', '', '', 0),
(5, 150, 0, 'jggh', '2016-08-08 12:13:02', '', '', 0),
(6, 62, 0, '', '2016-08-10 07:18:05', '', '', 0),
(7, 62, 0, '', '2016-08-10 07:18:28', '', '', 0),
(8, 62, 0, '', '2016-08-10 07:18:34', '', '', 0),
(9, 0, 0, 'complain fired', '2016-08-10 10:45:50', '', '', 0),
(10, 0, 0, 'complain fired', '2016-08-10 10:55:23', '', '', 0),
(11, 0, 0, 'complain fired', '2016-08-10 11:01:55', '', '', 0),
(12, 114, 0, '', '2016-08-10 19:09:52', '', '', 0),
(13, 114, 0, '', '2016-08-10 19:10:44', '', '', 0),
(14, 114, 0, '   ', '2016-08-10 19:11:17', '', '', 0),
(15, 153, 0, '', '2016-08-10 19:35:10', '', '', 0),
(16, 114, 0, 'jwnw', '2016-08-10 20:32:01', '', '', 0),
(17, 113, 0, 'vaajajajsjss', '2016-08-11 07:52:39', '', '', 0),
(18, 62, 0, 'Hello', '2016-08-26 19:15:16', '', '', 0),
(19, 181, 0, 'ghdnej', '2016-08-28 17:22:01', '', '', 0),
(20, 183, 0, 'good ', '2016-09-02 19:26:47', '', '', 0),
(21, 113, 0, 'i am so sad', '2016-09-04 01:42:20', '', '', 0),
(22, 62, 0, 'I don''t get my veggies.', '2016-09-10 07:31:37', '', '', 0),
(23, 62, 0, 'tjgfhjk\n', '2016-09-13 11:00:10', '', '', 0),
(24, 1, 313, 'IamaGoodBoy', '2016-11-15 20:59:50', 'VV-EJ51441', '', 0),
(25, 1, 313, 'Ok. not getting anything.', '2016-11-15 21:34:43', 'VV-DQ32496', 'It is well under construction.', 0),
(26, 1, 313, 'Batman SUperman', '2016-11-15 21:55:37', 'VV-IA86390', '', 0),
(27, 1, 313, 'ajshd adiadas', '2016-11-15 21:58:26', 'VV-UC95226', '', 0),
(28, 1, 314, 'fufucfiugyu yfiugiu yfig go uo kj', '2016-11-17 11:15:09', 'VV-UW68990', '', 0),
(29, 1, 313, 'App comp check up', '2016-11-24 00:17:23', 'VV-EF73116', '', 0),
(30, 241, 0, 'vegetable not delivered', '2016-12-22 07:52:52', '', '', 0),
(31, 1, 397, 'My order not delivered.', '2016-12-28 08:51:32', 'VV-AY17880', '', 0),
(32, 241, 0, 'vegetable not delivered', '0000-00-00 00:00:00', '', '', 0),
(33, 241, 1, 'vegetable not delivered', '0000-00-00 00:00:00', '', 'assasa', 0),
(34, 1, 1, 'fdfsdfsdf', '2016-12-29 10:26:33', '', '', 0),
(35, 0, 12, '121212121', '2016-12-29 14:07:45', '21212', '212121212', 0),
(36, 1, 414, 'not yet placed', '2016-12-30 17:35:38', 'VV-LT85177', '', 0),
(37, 1, 446, 'The vendor was very bad and abusive. Please take care of this.', '2017-01-05 09:23:26', 'VV-BB66081', '', 0),
(38, 216, 0, 'yo bro', '2017-01-05 20:35:00', '', '', 0),
(39, 253, 523, '664', '2017-01-18 17:01:28', 'VV-SQ68195', '', 0),
(40, 281, 0, 'zsnns', '2017-01-19 17:21:47', '', '', 0),
(41, 281, 0, 'zsnns', '2017-01-19 17:21:47', '', '', 0),
(42, 281, 0, 'zsnns', '2017-01-19 17:21:47', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_user`
--

CREATE TABLE IF NOT EXISTS `coupon_user` (
  `coupon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `used` int(11) NOT NULL DEFAULT '0' COMMENT '0: Not used // 1: Used'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='No of times coupon has been used by a user';

-- --------------------------------------------------------

--
-- Table structure for table `crashreport`
--

CREATE TABLE IF NOT EXISTS `crashreport` (
  `crashId` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `path` text NOT NULL,
  PRIMARY KEY (`crashId`),
  KEY `FK_UserID` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `crashreport`
--

INSERT INTO `crashreport` (`crashId`, `userId`, `timestamp`, `path`) VALUES
(1, 1, '2017-01-05 18:17:15', 'eqqwrw'),
(2, 1, '2017-01-05 18:42:05', 'CrashReports/1/2017-01-05_18-42-05.txt'),
(3, 1, '2017-01-05 18:50:51', 'CrashReports/1/2017-01-05_18-50-51.txt'),
(4, 1, '2017-01-05 18:53:48', 'CrashReports/1/2017-01-05_18-53-48.txt'),
(5, 1, '2017-01-05 19:03:37', 'CrashReports/1/2017-01-05_19-03-37.txt'),
(6, 1, '2017-01-05 19:03:57', 'CrashReports/1/2017-01-05_19-03-57.txt'),
(7, 1, '2017-01-05 19:22:21', 'CrashReports/1/2017-01-05_19-22-21.txt'),
(8, 1, '2017-01-05 19:22:31', 'CrashReports/1/2017-01-05_19-22-31.txt'),
(9, 1, '2017-01-05 19:24:13', 'CrashReports/1/2017-01-05_19-24-13.txt'),
(10, 1, '2017-01-05 19:24:21', 'CrashReports/1/2017-01-05_19-24-21.txt'),
(11, 1, '2017-01-05 19:24:26', 'CrashReports/1/2017-01-05_19-24-26.txt'),
(12, 1, '2017-01-05 19:34:22', 'CrashReports/1/2017-01-05_19-34-22.txt'),
(13, 1, '2017-01-05 19:34:37', 'CrashReports/1/2017-01-05_19-34-37.txt'),
(14, 1, '2017-01-05 19:34:40', 'CrashReports/1/2017-01-05_19-34-40.txt'),
(15, 1, '2017-01-05 19:42:17', 'CrashReports/1/2017-01-05_19-42-17.txt'),
(16, 1, '2017-01-06 01:13:19', 'CrashReports/1/2017-01-06_01-13-19.txt'),
(17, 1, '2017-01-06 01:15:08', 'CrashReports/1/2017-01-06_01-15-08.txt'),
(20, 145, '2017-01-08 19:32:32', 'CrashReports/145/2017-01-08_19-32-32.txt'),
(23, 281, '2017-01-08 19:33:49', 'CrashReports/281/2017-01-08_19-33-49.txt'),
(24, 1, '2017-01-10 00:52:31', 'CrashReports/1/2017-01-10_00-52-30.txt'),
(25, 1, '2017-01-11 16:44:51', 'CrashReports/1/2017-01-11_16-44-51.txt'),
(33, 218, '2017-01-14 16:33:47', 'CrashReports/218/2017-01-14_16-33-47.txt'),
(36, 204, '2017-01-18 01:15:23', 'CrashReports/204/2017-01-18_01-15-23.txt'),
(39, 281, '2017-01-19 16:26:46', 'CrashReports/281/2017-01-19_16-26-46.txt'),
(40, 246, '2017-01-19 20:20:59', 'CrashReports/246/2017-01-19_20-20-59.txt');

-- --------------------------------------------------------

--
-- Table structure for table `daily_buy`
--

CREATE TABLE IF NOT EXISTS `daily_buy` (
  `uid` int(10) NOT NULL,
  `veg_id` int(10) NOT NULL,
  `count` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_buy`
--

INSERT INTO `daily_buy` (`uid`, `veg_id`, `count`) VALUES
(1, 1, 3),
(1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `default_promo_table`
--

CREATE TABLE IF NOT EXISTS `default_promo_table` (
  `Psno` int(10) NOT NULL AUTO_INCREMENT,
  `Promo_code` varchar(45) NOT NULL,
  `discount` int(3) NOT NULL,
  `minimum` int(10) NOT NULL,
  `maximum` int(10) NOT NULL,
  `description` text NOT NULL,
  `orign_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Psno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `default_promo_table`
--

INSERT INTO `default_promo_table` (`Psno`, `Promo_code`, `discount`, `minimum`, `maximum`, `description`, `orign_date`, `expiry_date`) VALUES
(1, 'SALE50', 50, 80, 100, 'BLA BLA', '2016-08-01 08:19:37', '2017-03-01 00:00:00'),
(2, 'LAUNCH20', 20, 0, 100000, 'On the ocassion of the launch of the relovutionary application - Veg Vendors, We are offering a 20% discount on the very first order from our website or our android application. Enjoy the discount.', '2017-01-12 08:19:51', '2017-03-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `deo_users`
--

CREATE TABLE IF NOT EXISTS `deo_users` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `pwd` varchar(45) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='deo entry ke liye user rigths defined hai es table me ' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `deo_users`
--

INSERT INTO `deo_users` (`uid`, `username`, `pwd`) VALUES
(1, 'deo_admin1', '@veg.vendors.in2016');

-- --------------------------------------------------------

--
-- Table structure for table `express_delivery`
--

CREATE TABLE IF NOT EXISTS `express_delivery` (
  `place_code` int(10) NOT NULL AUTO_INCREMENT,
  `duration` varchar(90) NOT NULL,
  `charges` int(90) NOT NULL,
  PRIMARY KEY (`place_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `express_delivery`
--

INSERT INTO `express_delivery` (`place_code`, `duration`, `charges`) VALUES
(4, '2', 30),
(5, '2', 30),
(6, '2', 30),
(7, '2', 30),
(8, '2', 30),
(9, '2', 30),
(10, '2', 30),
(11, '2', 30);

-- --------------------------------------------------------

--
-- Table structure for table `facebook`
--

CREATE TABLE IF NOT EXISTS `facebook` (
  `sno` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `facebookOauthId` double NOT NULL,
  PRIMARY KEY (`sno`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `facebookOauthId` (`facebookOauthId`),
  UNIQUE KEY `sno` (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `facts`
--

CREATE TABLE IF NOT EXISTS `facts` (
  `fact_id` int(11) NOT NULL AUTO_INCREMENT,
  `facts` mediumtext NOT NULL,
  PRIMARY KEY (`fact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `facts`
--

INSERT INTO `facts` (`fact_id`, `facts`) VALUES
(1, 'vegetables are the good sources of viatamins and minerals which help in boosting our immunity and maintain other body functions.'),
(2, 'Vegetables yellow, red and orange in colour are very good sources of carotene which are very good for our vision.'),
(3, 'chillies like green, red chillies and capsicum and citrus vegetables like lemon and gooseberry(amla) are rich in vitamin C.'),
(4, 'green vegetables are good source of vitamin K which are very essential for increasing platelet count in our blood.'),
(5, 'spinach and beans are good sources of Iron which is must for formation of haemoglobin and thus our blood.'),
(6, 'vegetables are rich in anti-oxidants and help maintaining our good health.'),
(7, 'some vegetables like green leafy vegetables and bitter gourd, cucumber etc are rich in dietary fiber which improves our digestion.'),
(8, 'vegetables are healthy as most of them are low-calorie and low fat in nature.'),
(9, 'vegetables like turmeric, ginger, garlic etc which are also used as spices have anti-inflammatory and healing affects on our body.'),
(10, 'Bottle gourd is much helpful in reducing high blood pressure and keeping your heart healthy.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `sno` int(25) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL DEFAULT 'ANONYMOUS',
  `feedback` longtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forget`
--

CREATE TABLE IF NOT EXISTS `forget` (
  `uid` int(11) NOT NULL,
  `code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forget`
--

INSERT INTO `forget` (`uid`, `code`) VALUES
(197, 'AAS4242ITVA7LK2OIYSA6XNJG'),
(232, 'WH34UHORBUTM3AJ37M4SJAJSE'),
(244, 'N63DLFVBT4HJLG70T6TEHX6WA'),
(229, '4CYYAZVKU33SABI50CQ0ZZZLN'),
(241, 'XLY7XM7N0QLU3CLJ0QXHSIC5F'),
(246, '4IKKPUSEAZGUMR426HWY73H5P'),
(62, 'KBBHWIPAV2VQHZAMGH7X5REIY'),
(204, '05BB7VVZK00CYKQYA0WT2DL6I'),
(1, 'W5EB4VGKR46WPW0JL66XU6RLK');

-- --------------------------------------------------------

--
-- Table structure for table `google`
--

CREATE TABLE IF NOT EXISTS `google` (
  `sno` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `googleOauthId` double NOT NULL,
  PRIMARY KEY (`sno`),
  UNIQUE KEY `googleOauthId` (`googleOauthId`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `sno` (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `google`
--

INSERT INTO `google` (`sno`, `uid`, `googleOauthId`) VALUES
(1, 281, 1.004653012402841e20),
(2, 311, 1.0103772698595028e20);

-- --------------------------------------------------------

--
-- Table structure for table `immediate_delivery_settings`
--

CREATE TABLE IF NOT EXISTS `immediate_delivery_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `immediate_delivery_status` int(1) NOT NULL,
  `place_code` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `place_code` (`place_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `main_orders`
--

CREATE TABLE IF NOT EXISTS `main_orders` (
  `order_id` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `total_price` int(4) unsigned NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_rating` int(1) unsigned DEFAULT NULL COMMENT 'rating review of order to judge how was your delivery',
  `coupon_code` varchar(60) DEFAULT NULL,
  `timeslot_id` int(2) unsigned DEFAULT NULL,
  `delivery_status` tinyint(1) NOT NULL DEFAULT '0',
  `prev_oid` int(10) unsigned DEFAULT NULL,
  `type_of_delivery` int(1) unsigned NOT NULL COMMENT '1 for cash 2 for paytm 3 for online payment',
  `timeslot_change_counter` int(11) NOT NULL DEFAULT '0',
  `secondary_no` int(10) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=545 ;

--
-- Dumping data for table `main_orders`
--

INSERT INTO `main_orders` (`order_id`, `uid`, `total_price`, `order_date`, `order_rating`, `coupon_code`, `timeslot_id`, `delivery_status`, `prev_oid`, `type_of_delivery`, `timeslot_change_counter`, `secondary_no`) VALUES
(1, 48, 50, '2016-11-20 12:20:25', NULL, '0', NULL, -1, NULL, 0, 0, NULL),
(2, 48, 75, '2016-06-21 19:57:23', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(3, 83, 88, '2016-06-23 21:32:25', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(4, 83, 25, '2016-06-23 21:52:30', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(5, 83, 50, '2016-06-23 21:55:54', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(6, 81, 50, '2016-06-23 21:59:44', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(7, 81, 193, '2016-06-23 22:01:48', NULL, '0', NULL, 1, NULL, 0, 0, NULL),
(8, 81, 78, '2016-06-23 22:04:46', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(9, 81, 25, '2016-06-23 22:28:11', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(10, 81, 38, '2016-06-23 22:35:22', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(11, 81, 28, '2016-06-23 22:37:16', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(12, 81, 38, '2016-06-23 22:39:41', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(13, 81, 25, '2016-06-23 22:40:31', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(14, 81, 13, '2016-06-23 22:41:41', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(15, 81, 143, '2016-06-23 22:43:03', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(16, 81, 38, '2016-06-23 22:45:11', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(17, 81, 63, '2016-06-24 06:31:36', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(18, 81, 63, '2016-06-24 06:31:49', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(19, 61, 105, '2016-06-24 07:01:17', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(20, 61, 70, '2016-06-24 07:02:37', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(21, 81, 105, '2016-06-24 07:07:53', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(22, 69, 25, '2016-06-24 07:55:40', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(23, 81, 88, '2016-06-24 08:13:49', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(24, 84, 115, '2016-06-26 17:51:35', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(25, 81, 25, '2016-06-27 09:54:01', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(26, 81, 38, '2016-06-27 09:56:24', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(27, 81, 90, '2016-06-27 11:22:37', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(28, 81, 13, '2016-06-27 11:23:11', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(29, 81, 50, '2016-06-27 11:23:23', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(30, 81, 50, '2016-06-27 11:23:26', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(31, 81, 38, '2016-06-27 11:47:49', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(32, 81, 63, '2016-06-27 13:58:43', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(33, 61, 210, '2016-06-27 19:48:30', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(34, 61, 210, '2016-06-27 19:48:36', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(35, 81, 78, '2016-06-28 10:16:47', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(36, 61, 60, '2016-06-28 10:20:09', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(37, 1, 38, '2016-06-28 12:47:24', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(38, 1, 38, '2016-06-28 12:48:23', NULL, '0', NULL, 1, NULL, 0, 0, NULL),
(39, 1, 220, '2016-06-29 09:33:19', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(40, 69, 25, '2016-06-24 07:55:40', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(41, 69, 25, '2016-06-24 07:55:40', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(42, 1, 22, '2016-07-04 07:47:03', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(43, 1, 66, '2016-07-04 07:50:45', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(44, 1, 66, '2016-07-04 07:51:43', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(45, 1, 47, '2016-07-04 11:49:59', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(46, 1, 22, '2016-07-04 12:24:36', NULL, '0', NULL, 1, NULL, 0, 0, NULL),
(47, 1, 55, '2016-07-04 12:56:01', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(48, 1, 66, '2016-07-04 13:00:36', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(49, 1, 33, '2016-07-04 13:24:03', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(50, 1, 85, '2016-07-04 15:40:09', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(51, 1, 98, '2016-07-08 08:44:39', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(52, 107, 7, '2016-07-25 09:30:46', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(53, 107, 7, '2016-07-25 09:31:00', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(54, 107, 40, '2016-07-25 09:47:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(55, 107, 60, '2016-07-25 09:48:03', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(56, 1, 60, '2016-07-25 09:49:24', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(57, 107, 40, '2016-07-25 16:38:00', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(58, 107, 40, '2016-07-25 16:38:03', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(59, 107, 48, '2016-07-25 16:47:37', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(60, 107, 48, '2016-07-25 16:48:34', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(61, 107, 48, '2016-07-25 16:49:18', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(62, 81, 48, '2016-07-25 16:52:59', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(63, 81, 48, '2016-07-25 16:54:29', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(64, 1, 720, '2016-07-25 17:14:38', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(65, 81, 48, '2016-07-25 17:17:24', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(66, 1, 201, '2016-07-25 17:38:45', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(67, 1, 120, '2016-07-25 17:43:17', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(68, 110, 180, '2016-07-26 00:03:25', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(69, 112, 8, '2016-07-26 01:56:33', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(70, 81, 150, '2016-07-26 09:22:34', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(71, 81, 45, '2016-07-26 09:36:52', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(72, 1, 350, '2016-07-26 11:22:44', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(73, 1, 345, '2016-07-26 16:24:04', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(74, 110, 40, '2016-07-26 18:02:22', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(75, 114, 40, '2016-07-26 19:06:50', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(76, 114, 40, '2016-07-26 19:07:34', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(77, 114, 80, '2016-07-27 10:07:26', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(78, 110, 52, '2016-07-27 11:33:26', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(79, 1, 115, '2016-07-27 13:37:58', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(80, 1, 60, '2016-07-28 05:05:35', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(81, 114, 93, '2016-07-28 06:28:28', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(82, 1, 267, '2016-07-28 06:41:47', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(83, 1, 281, '2016-07-28 06:48:09', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(84, 1, 100, '2016-07-28 09:47:47', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(85, 120, 1478, '2016-07-28 15:25:45', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(86, 120, 100, '2016-07-28 15:28:31', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(87, 114, 200, '2016-07-28 17:40:04', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(88, 122, 373, '2016-07-28 18:41:57', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(89, 119, 1642, '2016-07-30 10:09:53', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(90, 1, 300, '2016-07-30 14:44:25', 5, '0', NULL, 0, NULL, 0, 0, NULL),
(91, 1, 222, '2016-07-30 14:45:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(92, 114, 180, '2016-08-01 19:45:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(93, 85, 75, '2016-08-01 19:54:45', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(94, 111, 86, '2016-08-01 20:04:37', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(95, 152, 70, '2016-08-03 14:48:09', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(96, 85, 135, '2016-08-04 05:34:56', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(97, 85, 100, '2016-08-04 08:54:04', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(98, 114, 0, '2016-08-06 20:35:46', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(99, 114, 0, '2016-08-06 20:36:11', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(100, 114, 0, '2016-08-06 20:36:12', NULL, '0', NULL, 1, NULL, 0, 0, NULL),
(101, 114, 0, '2016-08-06 20:36:12', NULL, '0', NULL, 1, NULL, 0, 0, NULL),
(102, 114, 0, '2016-08-06 20:36:46', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(106, 114, 0, '2016-08-06 20:49:53', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(108, 114, 0, '2016-08-06 20:50:27', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(109, 114, 0, '2016-08-06 20:50:28', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(110, 114, 0, '2016-08-06 20:50:36', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(111, 153, 0, '2016-08-06 21:12:39', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(112, 153, 158, '2016-08-06 21:15:31', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(113, 153, 158, '2016-08-06 21:27:35', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(114, 153, 158, '2016-08-06 21:31:30', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(115, 114, 0, '2016-08-07 07:29:38', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(116, 114, 0, '2016-08-07 07:31:20', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(117, 81, 0, '2016-08-07 07:41:52', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(118, 111, 329, '2016-08-07 18:30:07', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(119, 81, 30, '2016-08-08 03:39:10', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(120, 81, 15, '2016-08-08 03:39:46', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(121, 81, 8, '2016-08-08 03:51:04', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(122, 81, 8, '2016-08-08 04:43:28', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(123, 114, 140, '2016-08-08 07:42:37', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(124, 114, 300, '2016-08-08 07:44:54', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(125, 1, 300, '2016-08-08 07:52:35', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(126, 114, 20, '2016-08-08 09:36:56', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(127, 114, 30, '2016-08-08 09:38:49', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(128, 114, 20, '2016-08-08 09:48:08', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(129, 161, 35, '2016-08-08 10:07:16', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(130, 161, 35, '2016-08-08 10:10:40', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(131, 161, 35, '2016-08-08 10:11:30', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(132, 114, 300, '2016-08-08 11:09:08', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(133, 114, 20, '2016-08-08 11:17:17', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(134, 114, 180, '2016-08-08 12:27:37', 1, '0', NULL, 0, NULL, 0, 0, NULL),
(135, 114, 140, '2016-08-08 12:41:37', 5, '0', NULL, 0, NULL, 0, 0, NULL),
(136, 161, 20, '2016-08-08 19:25:40', 5, '0', NULL, 0, NULL, 0, 0, NULL),
(137, 114, 80, '2016-08-09 10:07:27', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(138, 1, 107, '2016-08-09 10:29:42', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(139, 114, 99, '2016-08-10 15:21:40', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(140, 153, 228, '2016-08-10 20:15:47', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(141, 113, 185, '2016-08-11 07:57:03', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(142, 114, 55, '2016-08-11 16:51:15', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(143, 114, 55, '2016-08-11 16:51:51', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(144, 29, 95, '2016-08-14 17:49:43', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(145, 114, 60, '2016-08-15 10:47:03', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(146, 114, 60, '2016-08-15 10:47:50', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(147, 1, 88, '2016-08-19 19:08:07', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(148, 113, 123, '2016-08-20 06:54:03', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(149, 61, 56, '2016-08-21 20:46:28', 5, '0', NULL, 1, NULL, 0, 0, NULL),
(150, 61, 60, '2016-08-21 20:49:15', 5, '0', NULL, 0, NULL, 0, 0, NULL),
(151, 61, 36, '2016-08-21 20:50:30', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(152, 101, 133, '2016-08-21 21:04:13', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(153, 101, 18, '2016-08-21 21:05:58', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(154, 101, 16, '2016-08-21 21:07:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(155, 101, 78, '2016-08-21 21:08:00', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(156, 101, 53, '2016-08-21 21:09:41', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(157, 101, 65, '2016-08-21 21:14:10', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(158, 101, 76, '2016-08-21 21:15:27', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(159, 101, 20, '2016-08-21 21:17:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(160, 101, 75, '2016-08-21 21:17:37', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(161, 101, 24, '2016-08-21 21:19:20', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(162, 101, 252, '2016-08-21 21:27:41', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(163, 101, 41, '2016-08-21 21:28:44', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(164, 158, 65, '2016-08-21 21:45:07', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(165, 158, 226, '2016-08-21 21:47:53', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(166, 158, 48, '2016-08-21 21:49:27', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(167, 158, 136, '2016-08-21 21:57:56', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(168, 158, 77, '2016-08-21 22:00:59', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(169, 101, 344, '2016-08-21 22:23:46', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(170, 113, 30, '2016-08-22 11:30:31', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(171, 101, 235, '2016-08-22 11:40:11', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(172, 158, 216, '2016-08-22 19:16:06', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(173, 174, 48, '2016-08-22 19:33:21', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(174, 174, 50, '2016-08-22 19:34:38', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(175, 174, 45, '2016-08-22 19:36:29', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(176, 174, 40, '2016-08-22 19:42:53', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(177, 114, 70, '2016-08-23 04:19:08', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(178, 114, 140, '2016-08-23 04:46:23', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(179, 114, 33, '2016-08-23 09:40:04', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(180, 114, 134, '2016-08-23 09:47:44', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(181, 114, 88, '2016-08-23 09:48:31', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(182, 114, 75, '2016-08-23 09:49:37', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(183, 114, 190, '2016-08-23 09:50:19', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(184, 114, 146, '2016-08-23 19:27:37', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(185, 114, 30, '2016-08-23 19:29:00', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(186, 114, 105, '2016-08-23 22:32:46', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(187, 1, 170, '2016-08-24 02:19:18', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(188, 62, 130, '2016-08-24 10:26:50', 5, '0', NULL, 0, NULL, 0, 0, NULL),
(189, 62, 46, '2016-08-24 10:28:04', 1, '0', NULL, 0, NULL, 0, 0, NULL),
(190, 62, 20, '2016-08-24 10:31:55', 2, '0', NULL, 0, NULL, 0, 0, NULL),
(191, 1, 38, '2016-08-24 11:29:28', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(192, 62, 40, '2016-08-24 11:32:00', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(193, 62, 88, '2016-08-24 11:38:43', 5, '0', NULL, 0, NULL, 0, 0, NULL),
(194, 62, 30, '2016-08-24 11:39:32', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(195, 62, 50, '2016-08-24 11:43:19', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(196, 62, 70, '2016-08-24 15:34:39', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(197, 114, 140, '2016-08-24 16:01:11', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(198, 114, 50, '2016-08-24 16:03:47', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(199, 114, 80, '2016-08-24 16:04:55', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(200, 114, 30, '2016-08-24 17:07:29', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(201, 114, 65, '2016-08-26 08:34:41', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(202, 114, 88, '2016-08-26 08:35:37', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(203, 62, 70, '2016-08-26 08:36:52', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(204, 62, 120, '2016-08-26 08:38:55', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(205, 62, 10, '2016-08-26 08:54:42', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(206, 62, 100, '2016-08-26 09:04:18', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(207, 62, 50, '2016-08-26 09:04:41', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(208, 62, 80, '2016-08-26 09:05:34', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(209, 62, 25, '2016-08-26 11:07:15', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(210, 62, 25, '2016-08-26 11:08:00', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(211, 62, 25, '2016-08-26 19:04:18', 1, '0', NULL, 0, NULL, 0, 0, NULL),
(212, 62, 68, '2016-08-26 19:06:11', 2, '0', NULL, 0, NULL, 0, 0, NULL),
(213, 62, 50, '2016-08-26 19:06:52', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(214, 62, 20, '2016-08-26 19:10:24', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(215, 62, 40, '2016-08-26 20:13:12', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(216, 62, 35, '2016-08-26 20:14:11', 2, '0', NULL, 0, NULL, 0, 0, NULL),
(217, 62, 45, '2016-08-26 20:15:01', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(218, 1, 135, '2016-08-27 01:09:26', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(219, 62, 8, '2016-08-28 04:42:03', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(220, 1, 45, '2016-08-28 13:26:50', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(221, 1, 20, '2016-08-28 13:27:40', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(222, 101, 14, '2016-08-28 17:41:10', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(223, 101, 25, '2016-08-28 17:42:49', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(224, 98, 398, '2016-09-02 02:57:26', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(225, 114, 50, '2016-09-03 07:57:27', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(226, 113, 200, '2016-09-04 01:39:26', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(227, 62, 30, '2016-09-04 15:18:48', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(228, 1, 135, '2016-09-07 08:15:17', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(229, 62, 40, '2016-09-07 18:37:36', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(230, 62, 25, '2016-09-09 11:18:21', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(231, 62, 140, '2016-09-09 11:56:10', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(232, 114, 30, '2016-09-09 16:12:44', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(233, 62, 795, '2016-09-10 08:47:10', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(234, 98, 210, '2016-09-15 14:54:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(235, 1, 85, '2016-09-17 06:07:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(236, 1, 155, '2016-09-17 06:21:28', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(237, 1, 696, '2016-09-17 08:01:34', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(238, 1, 325, '2016-09-20 15:39:38', NULL, '0', NULL, -1, NULL, 0, 0, NULL),
(239, 1, 345, '2016-09-20 15:43:33', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(240, 1, 70, '2016-09-25 12:17:22', NULL, '0', 99, 0, NULL, 0, 0, NULL),
(241, 1, 183, '2016-09-25 12:22:29', NULL, '0', 99, 0, NULL, 0, 0, NULL),
(242, 1, 139, '2016-09-25 13:42:16', NULL, '0', 99, -1, NULL, 0, 0, NULL),
(243, 1, 60, '2016-09-26 16:55:25', NULL, '0', 1, -1, NULL, 0, 0, NULL),
(244, 85, 235, '2016-09-26 21:17:21', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(245, 114, 60, '2016-10-05 17:23:07', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(246, 62, 105, '2016-10-08 13:45:09', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(247, 62, 40, '2016-10-10 02:10:08', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(248, 62, 43, '2016-10-10 02:11:11', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(249, 62, 45, '2016-10-10 02:12:00', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(250, 62, 55, '2016-10-12 12:44:30', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(251, 113, 10, '2016-10-13 10:14:50', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(252, 62, 85, '2016-10-13 15:09:12', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(253, 62, 120, '2016-10-13 15:12:59', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(254, 62, 8, '2016-10-14 11:40:27', 5, '0', NULL, 0, NULL, 0, 0, NULL),
(255, 62, 30, '2016-10-14 12:20:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(256, 114, 48, '2016-10-15 08:07:33', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(257, 114, 60, '2016-10-15 09:05:23', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(258, 114, 140, '2016-10-15 09:07:48', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(259, 62, 60, '2016-10-15 15:21:34', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(260, 114, 45, '2016-10-16 17:58:05', 4, '0', NULL, 0, NULL, 0, 0, NULL),
(261, 200, 60, '2016-10-17 20:58:10', 5, '0', NULL, 0, NULL, 0, 0, NULL),
(262, 218, 182, '2016-10-18 06:42:15', 3, '0', NULL, 0, NULL, 0, 0, NULL),
(263, 206, 35, '2016-10-18 10:20:47', 4, '0', NULL, -1, NULL, 0, 0, NULL),
(264, 200, 11, '2016-10-18 13:07:33', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(265, 62, 55, '2016-10-21 11:57:44', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(266, 218, 190, '2016-10-21 17:57:44', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(267, 220, 8, '2016-10-21 17:58:49', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(268, 200, 10, '2016-10-22 21:57:32', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(269, 218, 100, '2016-10-23 14:58:29', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(270, 218, 100, '2016-10-23 14:59:50', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(271, 218, 45, '2016-10-23 15:30:27', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(272, 220, 65, '2016-11-01 05:32:29', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(273, 220, 25, '2016-11-01 05:36:44', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(274, 1, 24, '2016-11-04 13:10:32', NULL, '0', 3, -1, NULL, 0, 0, NULL),
(275, 1, 175, '2016-11-04 13:20:40', NULL, '0', 3, -1, NULL, 0, 0, NULL),
(276, 220, 76, '2016-11-07 09:12:34', 5, '0', NULL, 0, NULL, 0, 0, NULL),
(277, 200, 135, '2016-11-07 11:17:35', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(278, 200, 0, '2016-11-07 11:18:28', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(279, 200, 30, '2016-11-07 11:20:08', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(280, 200, 275, '2016-11-07 11:21:34', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(281, 200, 305, '2016-11-07 11:23:38', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(282, 220, 34, '2016-11-12 13:36:37', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(283, 200, 20, '2016-11-12 17:48:25', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(284, 200, 65, '2016-11-12 18:11:10', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(285, 200, 10, '2016-11-12 18:16:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(286, 200, 10, '2016-11-12 18:24:20', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(287, 200, 50, '2016-11-12 18:51:19', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(288, 200, 50, '2016-11-12 18:55:19', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(289, 200, 50, '2016-11-12 19:01:51', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(290, 200, 50, '2016-11-12 19:01:59', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(291, 200, 20, '2016-11-12 19:19:19', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(292, 200, 20, '2016-11-12 19:23:22', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(293, 200, 18, '2016-11-12 19:23:52', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(294, 200, 8, '2016-11-12 19:25:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(295, 200, 10, '2016-11-12 19:25:20', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(296, 200, 10, '2016-11-12 19:25:32', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(297, 200, 30, '2016-11-12 19:26:59', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(298, 200, 20, '2016-11-12 19:32:14', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(299, 200, 30, '2016-11-12 19:36:14', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(300, 200, 30, '2016-11-12 19:36:44', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(301, 200, 10, '2016-11-12 19:37:55', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(302, 200, 161, '2016-11-13 07:25:29', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(303, 200, 647, '2016-11-13 07:30:43', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(304, 200, 647, '2016-11-13 07:37:21', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(305, 200, 647, '2016-11-13 07:37:25', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(306, 200, 33, '2016-11-13 07:44:30', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(307, 200, 15, '2016-11-13 07:46:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(308, 200, 15, '2016-11-13 07:46:37', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(309, 200, 15, '2016-11-13 11:10:36', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(310, 200, 74, '2016-11-14 12:27:40', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(311, 200, 40, '2016-11-14 21:29:33', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(312, 204, 415, '2016-11-14 21:42:09', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(313, 1, 70, '2016-11-15 19:40:11', NULL, '0', 5, -1, NULL, 0, 0, NULL),
(314, 1, 110, '2016-11-17 11:14:32', NULL, '0', 5, -1, NULL, 0, 0, NULL),
(315, 204, 388, '2016-11-17 11:44:58', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(316, 204, 8, '2016-11-17 11:45:05', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(317, 204, 62, '2016-11-17 12:18:43', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(318, 220, 50, '2016-11-17 12:22:15', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(319, 204, 19, '2016-11-18 14:45:15', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(320, 200, 50, '2016-11-19 12:25:44', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(321, 200, 150, '2016-11-19 12:26:29', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(322, 204, 330, '2016-11-24 15:16:32', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(323, 206, 200, '2016-11-24 15:19:11', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(324, 206, 0, '2016-11-28 06:30:06', NULL, '0', 2, 0, 0, 1, 0, NULL),
(325, 206, 0, '2016-11-28 06:30:13', NULL, '0', 2, 0, 0, 1, 0, NULL),
(326, 206, 0, '2016-11-28 06:34:09', NULL, '0', 2, 0, 0, 1, 0, NULL),
(327, 206, 0, '2016-11-28 06:34:10', NULL, '0', 2, 0, 0, 1, 0, NULL),
(328, 206, 0, '2016-11-28 06:34:11', NULL, '0', 2, 0, 0, 1, 0, NULL),
(329, 206, 0, '2016-11-28 06:34:11', NULL, '0', 2, 0, 0, 1, 0, NULL),
(330, 206, 0, '2016-11-28 06:34:11', NULL, '0', 2, 0, 0, 1, 0, NULL),
(331, 206, 0, '2016-11-28 06:34:12', NULL, '0', 2, 0, 0, 1, 0, NULL),
(332, 206, 0, '2016-11-28 06:34:18', NULL, '0', 2, 0, 0, 1, 0, NULL),
(333, 206, 0, '2016-11-28 06:34:18', NULL, '0', 2, 0, 0, 1, 0, NULL),
(334, 206, 0, '2016-11-28 06:34:19', NULL, '0', 2, 0, 0, 1, 0, NULL),
(335, 206, 0, '2016-11-28 06:34:19', NULL, '0', 2, 0, 0, 1, 0, NULL),
(336, 206, 0, '2016-11-28 06:34:19', NULL, '0', 2, 0, 0, 1, 0, NULL),
(337, 206, 0, '2016-11-28 06:34:20', NULL, '0', 2, 0, 0, 1, 0, NULL),
(338, 206, 0, '2016-11-28 06:34:20', NULL, '0', 2, 0, 0, 1, 0, NULL),
(339, 206, 0, '2016-11-28 06:34:20', NULL, '0', 2, 0, 0, 1, 0, NULL),
(340, 206, 0, '2016-11-28 06:34:20', NULL, '0', 2, 0, 0, 1, 0, NULL),
(341, 206, 0, '2016-11-28 06:34:21', NULL, '0', 2, 0, 0, 1, 0, NULL),
(342, 206, 0, '2016-11-28 06:34:21', NULL, '0', 2, 0, 0, 1, 0, NULL),
(343, 206, 0, '2016-11-28 06:34:21', NULL, '0', 2, 0, 0, 1, 0, NULL),
(344, 206, 0, '2016-11-28 06:34:21', NULL, '0', 2, 0, 0, 1, 0, NULL),
(345, 206, 0, '2016-11-28 06:34:22', NULL, '0', 2, 0, 0, 1, 0, NULL),
(346, 206, 0, '2016-11-28 06:34:22', NULL, '0', 2, 0, 0, 1, 0, NULL),
(347, 206, 1578, '2016-11-28 06:45:09', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(348, 206, 40, '2016-11-28 06:47:18', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(349, 206, 0, '2016-11-28 09:38:41', NULL, '0', 2, 0, 0, 1, 0, NULL),
(350, 206, 665, '2016-11-28 09:54:38', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(351, 206, 0, '2016-11-28 10:34:55', NULL, '0', 2, 0, 0, 1, 0, NULL),
(352, 206, 0, '2016-11-28 10:36:36', NULL, '0', 2, 0, 0, 1, 0, NULL),
(353, 206, 0, '2016-11-29 11:57:41', NULL, '0', 2, 0, 0, 1, 0, NULL),
(354, 206, 75, '2016-11-29 12:01:30', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(355, 206, 53, '2016-11-29 12:46:33', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(356, 206, 128, '2016-11-29 13:29:33', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(357, 229, 89, '2016-12-01 09:41:43', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(358, 229, 78, '2016-12-01 13:08:17', NULL, '0', NULL, -1, NULL, 0, 0, NULL),
(359, 200, 15, '2016-12-01 22:49:16', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(360, 200, 46, '2016-12-01 23:38:09', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(361, 225, 162, '2016-12-02 00:56:58', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(362, 204, 160, '2016-12-03 13:08:12', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(363, 204, 10, '2016-12-03 19:30:39', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(364, 225, 225, '2016-12-06 15:55:21', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(365, 1, 47, '2016-12-21 13:41:44', NULL, '0', 1, -1, NULL, 0, 0, NULL),
(366, 241, 98, '2016-12-22 07:49:43', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(367, 200, 420, '2016-12-22 16:05:21', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(368, 204, 646, '2016-12-24 02:54:27', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(369, 204, 41, '2016-12-24 06:07:35', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(370, 204, 30, '2016-12-24 09:30:08', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(371, 204, 88, '2016-12-24 10:36:19', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(372, 204, 1023, '2016-12-24 11:13:45', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(373, 246, 75, '2016-12-24 11:23:32', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(374, 246, 35, '2016-12-24 11:24:26', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(375, 246, 15, '2016-12-24 11:43:13', 5, '0', NULL, 0, NULL, 0, 0, NULL),
(376, 246, 15, '2016-12-24 11:57:43', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(377, 246, 20, '2016-12-24 12:25:34', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(378, 246, 8, '2016-12-24 12:32:28', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(379, 246, 60, '2016-12-24 14:02:58', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(380, 246, 54, '2016-12-25 09:32:16', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(381, 246, 0, '2016-12-26 09:24:03', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(382, 1, 116, '2016-12-26 12:41:06', NULL, '0', 1, 0, NULL, 0, 0, NULL),
(383, 1, 76, '2016-12-27 06:32:06', NULL, '0', 2, 0, NULL, 0, 0, NULL),
(384, 1, 76, '2016-12-27 06:32:06', NULL, '0', 2, 0, NULL, 0, 0, NULL),
(385, 1, 76, '2016-12-27 06:32:38', NULL, '0', 2, 0, NULL, 0, 0, NULL),
(386, 1, 96, '2016-12-27 06:36:18', NULL, '0', 99, 0, NULL, 0, 0, NULL),
(387, 1, 76, '2016-12-27 06:39:34', NULL, '0', 4, 0, NULL, 0, 0, NULL),
(388, 246, 0, '2016-12-27 07:48:23', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(389, 1, 40, '2016-12-27 08:28:00', NULL, '0', 4, 0, NULL, 0, 0, NULL),
(390, 1, 125, '2016-12-27 10:54:51', NULL, '0', 0, 0, NULL, 0, 0, NULL),
(391, 2, 12, '2016-12-27 13:47:03', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(392, 23, 23, '2016-12-27 13:49:17', NULL, '0', 2, 0, NULL, 0, 0, NULL),
(393, 12, 122, '2016-12-27 13:49:43', 3, '0', 2, 0, NULL, 1, 0, NULL),
(394, 23, 122, '2016-12-27 13:52:27', NULL, '0', NULL, 0, NULL, 2, 0, NULL),
(395, 12, 122, '2016-12-27 14:18:04', 3, '0', 2, 0, NULL, 1, 0, NULL),
(396, 1, 180, '2016-12-27 14:20:04', NULL, '0', 0, 0, NULL, 0, 0, NULL),
(397, 1, 132, '2016-12-28 08:25:41', NULL, '0', 0, 0, NULL, 0, 0, NULL),
(398, 1, 45, '2016-12-28 10:27:58', NULL, '0', 4, 0, NULL, 0, 0, NULL),
(399, 1, 304, '2016-12-28 10:39:59', NULL, '0', 2, 0, NULL, 0, 0, NULL),
(400, 1, 193, '2016-12-29 11:24:46', NULL, '0', 3, 0, NULL, 0, 1, NULL),
(401, 1, 230, '2016-12-29 11:40:14', NULL, '0', 3, 0, NULL, 0, 1, NULL),
(402, 1, 25, '2016-12-29 11:43:07', NULL, '0', 3, 0, NULL, 0, 1, NULL),
(403, 1, 90, '2016-12-29 11:56:02', NULL, '0', 3, 0, NULL, 0, 1, NULL),
(404, 1, 235, '2016-12-29 11:57:59', NULL, '0', 4, 0, NULL, 0, 1, NULL),
(405, 1, 200, '2016-12-29 12:00:56', NULL, '0', 1, -1, NULL, 0, 0, NULL),
(406, 1, 218, '2016-12-29 12:08:30', NULL, '0', 4, 0, NULL, 0, 1, NULL),
(407, 1, 260, '2016-12-29 12:09:53', NULL, '0', 5, -1, NULL, 0, 0, NULL),
(408, 1, 110, '2016-12-29 12:16:46', NULL, '0', 2, -1, NULL, 0, 0, NULL),
(409, 1, 95, '2016-12-29 12:17:55', NULL, '0', 99, -1, NULL, 0, 0, NULL),
(410, 1, 1136, '2016-12-29 12:43:24', NULL, '0', 2, -1, NULL, 0, 0, NULL),
(411, 1, 53, '2016-12-29 18:37:11', NULL, '0', 4, -1, NULL, 0, 0, NULL),
(412, 1, 150, '2016-12-30 16:20:57', NULL, '0', 1, -1, NULL, 0, 0, NULL),
(413, 1, 356, '2016-12-30 16:30:53', NULL, '0', 99, -1, NULL, 0, 0, NULL),
(414, 1, 468, '2016-12-30 17:05:46', NULL, '0', 4, -1, NULL, 0, 0, NULL),
(415, 216, 100, '2017-01-03 14:52:04', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(416, 216, 100, '2017-01-03 14:52:09', 0, '0', NULL, 0, NULL, 0, 0, NULL),
(417, 216, 540, '2017-01-03 14:53:12', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(418, 216, 540, '2017-01-03 14:53:18', 2, '0', NULL, 0, NULL, 0, 0, NULL),
(419, 246, 89, '2017-01-03 17:22:28', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(420, 246, 89, '2017-01-03 17:22:30', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(421, 246, 89, '2017-01-03 17:22:31', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(422, 246, 89, '2017-01-03 17:22:49', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(423, 246, 89, '2017-01-03 17:22:51', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(424, 246, 89, '2017-01-03 17:22:51', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(425, 246, 89, '2017-01-03 17:22:52', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(426, 246, 89, '2017-01-03 17:22:52', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(427, 246, 89, '2017-01-03 17:22:53', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(428, 246, 89, '2017-01-03 17:22:53', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(429, 0, 228, '2017-01-03 17:30:23', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(430, 0, 228, '2017-01-03 17:30:46', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(431, 0, 228, '2017-01-03 17:31:15', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(432, 216, 393, '2017-01-03 17:41:11', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(433, 216, 393, '2017-01-03 17:41:18', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(434, 246, 25, '2017-01-03 18:45:37', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(435, 246, 11, '2017-01-03 18:50:44', 5, '0', 3, -1, NULL, 0, 0, NULL),
(436, 246, 19, '2017-01-03 18:51:43', NULL, '0', 5, 0, NULL, 0, 0, NULL),
(437, 246, 8, '2017-01-03 19:35:46', NULL, '0', 4, -1, NULL, 0, 0, NULL),
(438, 246, 410, '2017-01-03 19:43:05', 4, '0', 5, -1, NULL, 0, 0, NULL),
(439, 0, 780, '2017-01-04 14:04:08', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(440, 0, 780, '2017-01-04 14:04:14', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(441, 229, 80, '2017-01-04 18:47:56', 5, '0', 4, -1, NULL, 0, 0, NULL),
(442, 218, 138, '2017-01-04 20:32:15', NULL, '0', 5, 0, NULL, 0, 0, NULL),
(443, 218, 169, '2017-01-04 20:39:15', NULL, '0', 6, 0, NULL, 0, 0, NULL),
(444, 246, 33, '2017-01-04 23:33:35', 4, '0', 5, 0, NULL, 0, 0, NULL),
(445, 1, 95, '2017-01-05 00:01:07', NULL, '0', 4, 0, NULL, 0, 1, NULL),
(446, 1, 90, '2017-01-05 00:17:10', NULL, '0', 5, 0, NULL, 0, 1, NULL),
(447, 246, 93, '2017-01-05 00:57:49', NULL, '0', 4, 0, NULL, 0, 0, NULL),
(448, 246, 506, '2017-01-05 00:58:34', NULL, '0', 0, -1, NULL, 0, 0, NULL),
(449, 246, 506, '2017-01-05 00:59:52', NULL, '0', 0, -1, NULL, 0, 0, NULL),
(450, 246, 341, '2017-01-05 01:00:33', NULL, '0', 0, -1, NULL, 0, 0, NULL),
(451, 246, 506, '2017-01-05 01:01:51', NULL, '0', 5, -1, NULL, 0, 0, NULL),
(452, 0, 805, '2017-01-05 11:17:41', NULL, '0', NULL, 0, NULL, 0, 0, NULL),
(453, 111, 60, '2017-01-05 11:54:59', NULL, '0', 2, 0, NULL, 0, 0, NULL),
(454, 229, 30, '2017-01-05 15:52:32', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(455, 229, 80, '2017-01-05 15:53:34', NULL, '0', 4, 0, NULL, 0, 1, NULL),
(456, 204, 195, '2017-01-05 18:28:25', NULL, '0', 3, -1, NULL, 0, 0, NULL),
(457, 216, 1166, '2017-01-05 20:30:35', NULL, '0', 4, 0, NULL, 0, 0, NULL),
(458, 216, 68, '2017-01-05 20:32:38', NULL, '0', 6, 0, NULL, 0, 0, NULL),
(459, 204, 2158, '2017-01-05 20:41:01', NULL, '0', 4, -1, NULL, 0, 0, NULL),
(460, 216, 696, '2017-01-06 17:31:09', NULL, '0', 4, 0, NULL, 0, 0, NULL),
(461, 218, 185, '2017-01-06 21:34:57', 5, '0', 4, -1, NULL, 0, 0, NULL),
(462, 216, 163, '2017-01-07 21:41:12', NULL, '0', 4, 0, NULL, 0, 0, NULL),
(463, 204, 95, '2017-01-08 13:51:22', NULL, '0', 5, 0, NULL, 0, 0, NULL),
(464, 1, 110, '2017-01-08 14:04:11', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(465, 1, 115, '2017-01-08 14:17:07', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(466, 1, 70, '2017-01-08 16:52:11', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(467, 1, 140, '2017-01-08 16:55:18', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(468, 1, 65, '2017-01-08 16:56:11', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(469, 1, 29, '2017-01-08 17:00:01', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(470, 1, 69, '2017-01-08 17:01:33', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(471, 1, 180, '2017-01-08 17:29:57', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(472, 246, 11, '2017-01-08 18:02:54', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(473, 281, 361, '2017-01-08 19:08:50', NULL, '0', 3, 0, NULL, 0, 0, NULL),
(474, 281, 44, '2017-01-08 20:46:20', NULL, '0', 6, 0, NULL, 0, 0, NULL),
(475, 281, 325, '2017-01-08 20:57:54', NULL, '0', 4, 0, NULL, 0, 0, NULL),
(476, 218, 45, '2017-01-09 09:59:06', NULL, '0', 2, 0, NULL, 0, 0, NULL),
(477, 218, 395, '2017-01-09 10:00:06', 4, '0', 6, 0, NULL, 0, 0, NULL),
(478, 229, 0, '2017-01-09 10:12:45', NULL, '0', 2, -1, NULL, 0, 0, NULL),
(479, 229, 0, '2017-01-09 10:12:53', NULL, '0', 2, -1, NULL, 0, 0, NULL),
(480, 229, 0, '2017-01-09 10:13:07', NULL, '0', 2, -1, NULL, 0, 0, NULL),
(481, 229, 0, '2017-01-09 10:14:03', NULL, '0', 2, -1, NULL, 0, 0, NULL),
(482, 229, 0, '2017-01-09 10:14:05', NULL, '0', 2, -1, NULL, 0, 0, NULL),
(483, 1, 950, '2017-01-10 12:59:36', NULL, '0', 4, 0, NULL, 0, 1, NULL),
(484, 1, 140, '2017-01-10 18:35:08', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(485, 1, 140, '2017-01-10 18:35:34', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(486, 1, 140, '2017-01-10 18:39:49', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(487, 1, 140, '2017-01-10 18:39:54', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(488, 1, 55, '2017-01-10 18:51:50', NULL, NULL, 3, -1, NULL, 0, 0, NULL),
(489, 1, 130, '2017-01-10 19:02:51', NULL, NULL, 3, -1, NULL, 0, 0, NULL),
(490, 1, 350, '2017-01-10 19:30:18', 5, NULL, 4, -1, NULL, 0, 0, NULL),
(491, 204, 55, '2017-01-11 18:30:08', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(492, 204, 55, '2017-01-11 18:30:26', NULL, NULL, 3, -1, NULL, 0, 0, NULL),
(493, 204, 88, '2017-01-11 23:51:04', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(494, 204, 88, '2017-01-11 23:54:23', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(495, 204, 121, '2017-01-11 23:54:59', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(496, 204, 121, '2017-01-11 23:55:07', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(497, 204, 121, '2017-01-11 23:56:21', 3, NULL, 4, 0, NULL, 0, 0, NULL),
(498, 218, 45, '2017-01-12 08:17:02', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(499, 218, 45, '2017-01-12 08:17:06', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(500, 1, 140, '2017-01-12 12:22:05', NULL, NULL, 2, 0, NULL, 0, 0, NULL),
(501, 216, 75, '2017-01-12 13:50:44', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(502, 204, 274, '2017-01-12 15:28:57', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(503, 229, 122, '2017-01-12 17:24:10', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(504, 216, 180, '2017-01-12 21:09:35', NULL, NULL, 5, 0, NULL, 0, 0, NULL),
(505, 216, 360, '2017-01-13 14:45:42', NULL, NULL, 5, 0, NULL, 0, 0, NULL),
(506, 1, 736, '2017-01-13 15:29:11', NULL, NULL, 3, -1, NULL, 0, 0, NULL),
(507, 216, 499, '2017-01-14 10:04:05', NULL, NULL, 2, 0, NULL, 0, 0, NULL),
(508, 204, 655, '2017-01-14 13:59:16', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(509, 218, 268, '2017-01-14 17:21:47', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(510, 218, 115, '2017-01-14 17:25:52', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(511, 218, 255, '2017-01-14 17:57:15', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(512, 204, 105, '2017-01-18 01:13:18', NULL, NULL, 0, 0, NULL, 0, 0, NULL),
(513, 204, 8, '2017-01-18 01:22:21', NULL, NULL, 0, 0, NULL, 0, 0, NULL),
(514, 204, 620, '2017-01-18 01:35:48', NULL, NULL, 0, 0, NULL, 0, 0, NULL),
(515, 204, 8, '2017-01-18 18:08:44', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(516, 204, 8, '2017-01-18 18:12:07', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(517, 281, 0, '2017-01-18 20:24:56', NULL, NULL, 6, 0, NULL, 0, 0, NULL),
(518, 281, 0, '2017-01-18 20:27:12', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(519, 281, 0, '2017-01-18 20:28:53', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(520, 281, 0, '2017-01-18 20:34:40', NULL, NULL, 6, 0, NULL, 0, 0, NULL),
(521, 281, 0, '2017-01-18 20:35:54', NULL, NULL, 6, 0, NULL, 0, 0, NULL),
(522, 281, 0, '2017-01-18 20:36:49', NULL, NULL, 6, 0, NULL, 0, 0, NULL),
(523, 253, 0, '2017-01-18 22:30:18', NULL, NULL, 4, 0, NULL, 0, 1, NULL),
(524, 259, 40, '2017-01-18 22:46:33', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(525, 218, 340, '2017-01-18 23:21:07', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(526, 218, 190, '2017-01-18 23:22:22', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(527, 281, 0, '2017-01-18 23:36:37', NULL, NULL, 5, 0, NULL, 0, 0, NULL),
(528, 281, 0, '2017-01-18 23:42:09', NULL, NULL, 6, 0, NULL, 0, 0, NULL),
(529, 281, 0, '2017-01-18 23:48:27', NULL, NULL, 5, 0, NULL, 0, 0, NULL),
(530, 281, 0, '2017-01-19 00:04:48', NULL, NULL, 1, 0, NULL, 0, 0, NULL),
(531, 1, 0, '2017-01-19 12:13:34', NULL, NULL, 2, 0, NULL, 0, 0, NULL),
(532, 1, 0, '2017-01-19 12:30:02', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(533, 1, 0, '2017-01-19 12:32:46', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(534, 1, 70, '2017-01-19 12:38:45', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(535, 281, 570, '2017-01-19 16:42:35', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(536, 281, 361, '2017-01-19 17:19:50', NULL, NULL, 5, 0, NULL, 0, 0, NULL),
(537, 229, 100, '2017-01-19 22:22:11', NULL, NULL, 4, 0, NULL, 0, 0, NULL),
(538, 281, 490, '2017-02-25 08:28:59', NULL, NULL, NULL, 0, NULL, 0, 0, NULL),
(539, 281, 1020, '2017-02-26 17:56:04', NULL, NULL, NULL, 0, NULL, 0, 0, NULL),
(540, 281, 1020, '2017-02-26 17:56:49', NULL, NULL, NULL, 0, NULL, 0, 0, NULL),
(541, 216, 50, '2017-03-04 07:32:14', NULL, NULL, 3, 0, NULL, 0, 0, NULL),
(542, 216, 22, '2017-03-04 07:39:44', NULL, NULL, 5, 0, NULL, 0, 0, NULL),
(543, 216, 200, '2017-03-04 07:40:14', NULL, NULL, 3, -1, NULL, 0, 0, NULL),
(544, 1, 80, '2017-03-04 08:05:37', NULL, NULL, 3, 0, NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `place_code` int(10) NOT NULL AUTO_INCREMENT,
  `area` int(10) unsigned NOT NULL,
  `division` varchar(90) NOT NULL,
  `increment_percentage` int(3) DEFAULT NULL COMMENT 'this percentage will make increment in price_per_kg of sabzi_prize',
  PRIMARY KEY (`place_code`),
  KEY `FK_places_ID` (`area`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`place_code`, `area`, `division`, `increment_percentage`) VALUES
(4, 1, 'DA1', NULL),
(5, 1, 'DA2', NULL),
(6, 1, 'DA3', NULL),
(7, 1, 'DA4', NULL),
(8, 1, 'DA5', NULL),
(9, 1, 'DA6', NULL),
(10, 1, 'DA7', NULL),
(11, 1, 'DA8', NULL);

--
-- Triggers `places`
--
DROP TRIGGER IF EXISTS `Delete_places_trigger`;
DELIMITER //
CREATE TRIGGER `Delete_places_trigger` AFTER DELETE ON `places`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'areaJson';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Insert_places_trigger`;
DELIMITER //
CREATE TRIGGER `Insert_places_trigger` AFTER INSERT ON `places`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'areaJson';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Update_places_trigger`;
DELIMITER //
CREATE TRIGGER `Update_places_trigger` AFTER UPDATE ON `places`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'areaJson';

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `referral_code`
--

CREATE TABLE IF NOT EXISTS `referral_code` (
  `uid` int(10) unsigned NOT NULL,
  `referral code` varchar(45) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `referral code` (`referral code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `referral_code`
--

INSERT INTO `referral_code` (`uid`, `referral code`) VALUES
(200, 'VV835200'),
(204, 'VV980204');

-- --------------------------------------------------------

--
-- Table structure for table `referral_parent`
--

CREATE TABLE IF NOT EXISTS `referral_parent` (
  `uid_child` int(11) unsigned NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `count` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid_child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE IF NOT EXISTS `registered_users` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `pwd` varchar(45) NOT NULL,
  `pic` varchar(300) NOT NULL DEFAULT '../../content/profile_photos/vegvendor_black_dp.png',
  `contact` decimal(10,0) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `dor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` varchar(45) DEFAULT NULL,
  `gender_preference` varchar(45) NOT NULL DEFAULT 'both',
  `send_invoice` int(11) NOT NULL,
  `oauth_provider` varchar(255) NOT NULL DEFAULT 'vegvendors',
  `oauth_uid` varchar(255) NOT NULL DEFAULT 'vegvendors',
  `favourite` varchar(60) NOT NULL,
  `address` varchar(150) NOT NULL,
  `activation` varchar(255) DEFAULT NULL,
  `credit` int(3) unsigned NOT NULL,
  `referral_code` varchar(45) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `contact` (`contact`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=312 ;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`uid`, `user_name`, `email`, `pwd`, `pic`, `contact`, `delivery_address`, `state`, `dor`, `gender`, `gender_preference`, `send_invoice`, `oauth_provider`, `oauth_uid`, `favourite`, `address`, `activation`, `credit`, `referral_code`) VALUES
(1, 'Pratyush Pankaj', 'ronny.rooney10@gmail.com', '12345678', 'https://lh4.googleusercontent.com/-wi5CMT6Ynvk/AAAAAAAAAAI/AAAAAAAAAkY/AOEYHz-80HY/s96-c/photo.jpg', '8375930322', 'asuhdoasd', NULL, '2016-06-28 12:12:10', 'male', 'female', 2, 'google', 'vegvendors', 'Pizza', '', '78fa739d61a47758fc7f2137c42f9360', 0, 'abc'),
(3, 'Sanjay JAIN ', 'sanjay111971@hotmail.com', 'sanjay@1971', '../../content/profile_photos/vegvendor_black_dp.png', '9999123456', NULL, NULL, '2016-06-09 04:12:04', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', 'Rohini Sector-1, Delhi-110085', 'active', 0, 'VV5223'),
(28, 'Lakshit Mittal', 'lakshit.aman@gmail.com', '986768721405662', 'https://graph.facebook.com/986768721405662/picture?type=large', NULL, NULL, NULL, '2016-06-20 10:11:21', 'male', 'both', 0, 'facebook', '986768721405662', '', '', 'active', 0, 'VV55828'),
(39, 'Nancy Gupta', 'nancygupta.5994@gmail.com', '1150150501709118', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xal1/v/t1.0-1/c0.19.50.50/p50x50/13265869_1130617780329057_3538293518868211880_n.jpg?oh=9020d6c22a8529283ac7a6fc5814e536&oe=57C10B1E&__gda__=1474217586', NULL, NULL, NULL, '2016-06-20 10:54:08', 'female', 'both', 0, 'facebook', '1150150501709118', '', '', 'active', 0, ''),
(60, 'NANCY', 'nancygupta5994@gmail.com', 'authentic6186', 'https://lh3.googleusercontent.com/-f1R-w4XCZcY/AAAAAAAAAAI/AAAAAAAAAEo/fDyVddjFe9Y/photo.jpg', NULL, NULL, NULL, '2016-06-21 10:49:40', 'female', 'both', 0, 'google', '102615265107444231511', '', '', '0805b5d9ca3810caf5c825f2cb74cfa5', 0, ''),
(61, 'Saurabh Suman', 'saurabhsuman93@gmail.com', '106760435725431601714', 'https://lh5.googleusercontent.com/-Nvswa3XXV94/AAAAAAAAAAI/AAAAAAAAAE0/zU9EhzkSLl8/s96-c/photo.jpg', '9313001876', 'H. No-7, Pitampura', NULL, '2016-06-21 11:51:29', 'male', 'both', 0, 'google', 'vegvendors', '', '', '3b548064509234c5b2130543a9d73b15', 0, ''),
(63, 'Ranjeet Kumar', 'ranjeet01kumar@gmail.com', '114697613984879852098', 'https://scontent.xx.fbcdn.net/v/t1.0-1/p200x200/15894625_1153740241388011_8661865189890047127_n.jpg?oh=fc7998c19c19c37ec8f82e55e70eca46&oe=58DF712A', NULL, NULL, NULL, '2016-06-22 06:16:22', 'male', 'both', 0, 'FACEBOOK', '1154095394685829', '', '', NULL, 0, ''),
(65, 'tad ka gajj', 'tarunngupta100@gmail.com', '1234567890tarun', '../../content/profile_photos/vegvendor_black_dp.png', '37495', 'pata ni', NULL, '2016-06-22 10:28:07', 'male', 'female', 0, 'vegvendors', 'vegvendors', '', '', 'active', 0, ''),
(84, 'Nishant Kumar', 'nishant2312@gmail.com', '12345678', '../../content/profile_photos/vegvendor_black_dp.png', NULL, '3B-132, GC Grand, Vaibhav Khand, Indrapuram', NULL, '2016-06-25 19:46:49', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'active', 0, ''),
(91, 'lakshit bhai', 'lakshitbhairocks@xyz.com', 'xyz123456', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-06-28 18:23:58', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '19d8bad419ab7064fbb457ef2507cc3d', 0, ''),
(92, 'Parveen', 'krishnantreyparveen11@gmail.com', '123456789', 'https://lh4.googleusercontent.com/-Jhc2dYz1dKk/AAAAAAAAAAI/AAAAAAAAAF0/nYTQRCaWgLs/photo.jpg', NULL, '', NULL, '2016-06-29 08:06:50', '', 'both', 0, 'google', '111768741440359918039', '', '', 'active', 0, ''),
(93, 'sass', 'aasds@hjjhh.sldkl', 'abcdefgh', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-06-29 11:38:54', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '5aa0deae04b518bd602cf32d5858c5bc', 0, ''),
(94, 'Nitish Gupta', 'nitish_gupta73@yahoo.com', '10207108358250716', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xat1/v/t1.0-1/c20.0.50.50/p50x50/11427736_10204792165627348_497070593589634358_n.jpg?oh=d878a7dfcf480e37bdb5808a48b2a177&oe=57F24E32&__gda__=1479937960', NULL, NULL, NULL, '2016-06-29 14:38:11', 'male', 'both', 0, 'facebook', '10207108358250716', '', '', NULL, 0, ''),
(95, 'tarun preet', 'tarunpreetsingh16@gmail.com', '109862296211766076960', 'https://lh6.googleusercontent.com/-V7F9g5Ykdbo/AAAAAAAAAAI/AAAAAAAAASQ/-XWuTDk_WAY/photo.jpg', NULL, NULL, NULL, '2016-06-30 02:11:59', 'male', 'both', 0, 'google', '109862296211766076960', '', '', NULL, 0, ''),
(96, 'Naman Jolly', 'naman.jolly2003@gmail.com', '568247510010718', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfa1/v/t1.0-1/c0.0.50.50/p50x50/1233978_343089392526532_62074240186582103_n.jpg?oh=483c3461fc8d184c35a435aeb520121e&oe=57ED42F0&__gda__=1476785340_87e3', NULL, NULL, NULL, '2016-07-02 08:17:23', 'male', 'both', 0, 'facebook', '568247510010718', '', '', NULL, 0, ''),
(97, 'naman', 'namanjolly2003@gmail.com', '111982069672401588380', 'https://lh3.googleusercontent.com/-N9INyuodRs0/AAAAAAAAAAI/AAAAAAAAABg/SBy1toyoGb4/photo.jpg', NULL, NULL, NULL, '2016-07-02 08:20:34', 'male', 'both', 0, 'google', '111982069672401588380', '', '', NULL, 0, ''),
(99, 'root', 'root@gmail.com', 'root@gmail.com', '../../content/profile_photos/vegvendor_black_dp.png', NULL, '', NULL, '2016-07-02 18:36:41', 'male', 'both', 0, 'vegvendors', 'vegvendors', '', '', '435d4ab16d5402c3e74d62bf7604b188', 0, ''),
(100, '', '', '', '', NULL, NULL, NULL, '2016-07-03 03:59:39', '', 'both', 0, '', '', '', '', NULL, 0, ''),
(101, 'Shivangi Prabha', 'shivangi1411994@gmail.com', '100248415399218111678', 'https://lh5.googleusercontent.com/-IhSxxFDpRJE/AAAAAAAAAAI/AAAAAAAAAAA/AKB_U8uPsO0SpfALQL-8SFud52Gn9gTsWA/s96-c/photo.jpg', '9313692809', 'azadpur delhi hai', '', '2016-07-03 09:42:38', 'male', 'NP', 0, 'google', '100248415399218111678', '', '', NULL, 0, ''),
(102, 'Lakshit', 'Lakshit.aman1@gmail.com', '12345678', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-03 10:48:16', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '668127dd60825e2537c0ab0e22f929a1', 0, ''),
(104, 'ROOTER', 'ROOTER@GMAIL.COM', 'ROOT@GMAIL.COM', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-05 07:37:39', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '7a51ed049dcb78b24d4b0cb7bdc0c6b3', 0, ''),
(105, 'Android', 'android@android.in', 'androiddev', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-06 07:15:53', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'd5e452319bddd60d563080c856e338b5', 0, ''),
(106, 'suman', 'suman.rawat@rocketmail.com', 'sumanrawat', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-15 09:48:08', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '4057478370e70bca43eb2c42fd909258', 0, ''),
(107, 'Jagriti Verma', 'jagriti.verma04@gmail.com', '1130814473645811', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xft1/v/t1.0-1/p50x50/12004741_953671634693430_791317034783982407_n.jpg?oh=f221def3f94051d69c0d4f7765cdcc75&oe=58246BB0&__gda__=1479803244_994428e12723d', NULL, NULL, NULL, '2016-07-22 07:35:23', 'female', 'both', 0, 'facebook', '1130814473645811', '', '', NULL, 0, ''),
(111, 'Avinash Kumar', 'loveavi1988@gmail.com', '1320014371388175', 'https://scontent.xx.fbcdn.net/v/t1.0-1/c0.78.200.200/p200x200/12928306_1239160249473588_8058635742536303224_n.jpg?oh=7acb4bb4170f945ec9793582626c3906&oe=58DF2370', '8802032319', 'd 49', NULL, '2016-07-25 11:20:18', 'male', 'both', 0, 'FACEBOOK', '1320014371388175', '', '', NULL, 0, ''),
(114, 'prabhat rai', 'prabhat.rai1707@gmail.com', '0987654321', 'https://lh5.googleusercontent.com/-nz1lMgkAdEE/AAAAAAAAAAI/AAAAAAAABOI/bbwyXuWNPl4/photo.jpg', '9991231234', 'xyz', NULL, '2016-07-26 17:33:04', '', 'NP', 0, 'GOOGLE', '115924646310070194252', '', '', NULL, 0, ''),
(115, 'Rajesh Kumar', 'rajeshkmr504@gmail.com', 'Rajesh200', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-27 02:47:11', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '0b470b64d655ef4b7851cba5e8f2a06c', 0, ''),
(116, 'aman jolly', 'jollyman.jolly663@gmail.com', 'hitman047', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-27 11:57:02', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(117, 'Shivangi', 'shivangi@gmail.com', '12345678', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-28 13:54:56', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(118, 'Shalu', 'shalushili420@gmail.com', '921156', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-28 13:56:28', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(120, 'avi', 'avi187@gmail.com', 'a123456', '../../content/profile_photos/vegvendor_black_dp.png', NULL, 'null', NULL, '2016-07-28 15:22:24', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(121, 'Pratyush Pankaj', 'pratyush.pankaj@vegvendors.in', 'pratyush26', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-28 16:01:56', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(122, 'aman', 'pop', 'pop', '../../content/profile_photos/vegvendor_black_dp.png', '9810670255', '', NULL, '2016-07-28 18:39:28', 'Male', 'NP', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(123, 'jatin gandhi ', 'jatingandhi100@gmail.com', 'Bonkerman100', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-29 06:14:05', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(124, 'SaurabhSuman', 'saurabh@gmail.com', '12345678', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-29 06:39:53', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(145, 'Gagan Mittal', 'gagan.mittal29@gmail.com', 'gaganloveme', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-31 11:05:42', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, 'VV340145'),
(146, 'nitika khanna', 'nitikakhanna8130@gmail.com', 'kakaniku', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-07-31 19:39:55', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(147, 'P', 'p', '', 'P', NULL, NULL, NULL, '2016-08-01 07:43:11', 'P', 'both', 0, 'P', 'P', '', '', NULL, 0, ''),
(148, 'tiger', 'tiger@gmail.com', '1234', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-01 16:28:12', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(149, 'Gagan Mittal', 'prsjn3@gmail.com', '', 'https://fb-s-d-a.akamaihd.net/h-ak-xtp1/v/t1.0-1/p200x200/13645264_1094821273897661_8159044885791453785_n.jpg?oh=8716850e3287cbe424054adbf9f3b622&oe=585D78F2&__gda__=1480670416_d5c017485f05031375ca352d8d4f622d', NULL, NULL, NULL, '2016-08-02 05:57:04', 'male', 'both', 0, 'ye rha token', '1118232088223246', '', '', NULL, 0, ''),
(150, 'Deepak Rai', 'deepak.rai1707@gmail.com', '', 'http://vegvendors.in/android/user.jpg', NULL, NULL, NULL, '2016-08-03 09:38:45', '', 'both', 0, 'GOOGLE', '108913166492359097148', '', '', NULL, 0, ''),
(151, 'h', 'h@c.com', 'gt1234', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-03 14:46:55', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(152, 'c', 'g@f.com', 'asd123', '../../content/profile_photos/vegvendor_black_dp.png', NULL, 'null', NULL, '2016-08-03 14:47:32', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(154, 'Ashish', 'test@gnail', '12345678', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-04 08:11:04', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '6ee4901a2664a466c53ca3d700705e59', 0, ''),
(155, 'jolly', 'aman.jolly1994@gmail.com', 'hitman047', '../../content/profile_photos/vegvendor_black_dp.png', '9999999999', 'null', NULL, '2016-08-05 19:30:45', 'Female', 'Male', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(156, 'nick', 'nickyadav89@gmail.com', '123456789', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-06 04:39:32', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(157, 'Sunil Kumar', 'sk.inc4ever4u@gmail.com', '102785802179142373724', 'https://lh5.googleusercontent.com/-PmlegE2AqNA/AAAAAAAAAAI/AAAAAAAAC7E/-HTyPRZG6Dk/s96-c/photo.jpg', NULL, NULL, NULL, '2016-08-06 04:39:54', 'male', 'both', 0, 'google', 'vegvendors', '', '', NULL, 0, ''),
(158, 'Raman Chaudhary', 'ramankumar221069@gmail.com', '', 'http://vegvendors.in/android/user.jpg', '9310244566', 'kewal Park', NULL, '2016-08-06 16:41:36', '', 'NP', 0, 'GOOGLE', '114793068499589043201', '', '', NULL, 0, ''),
(159, 'Tushar Jaggi', 'tusharjaggi92@gmail.com', '', 'http://vegvendors.in/android/user.jpg', NULL, NULL, NULL, '2016-08-07 19:00:13', '', 'both', 0, 'GOOGLE', '101845601625241517474', '', '', NULL, 0, ''),
(160, 'Kunal Batra', 'kunalbtr49@gmail.com', '', 'https://lh5.googleusercontent.com/-eOhiaS3Qb9I/AAAAAAAAAAI/AAAAAAAAAkI/SyN8eXzVBnQ/photo.jpg', '8860037027', '', NULL, '2016-08-08 05:26:59', 'Male', 'NP', 0, 'GOOGLE', '112835323600322206346', '', '', NULL, 0, ''),
(161, 'mkc', 'mkc@gmail.com', '123456', '../../content/profile_photos/vegvendor_black_dp.png', '6598', 'ygh', NULL, '2016-08-08 09:57:15', 'Male', 'NP', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(162, 'my', 'my@gmail.com', '123456', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-08 10:18:58', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(163, 'ayush garg', 'ayush.gar12@gmail.com', '', 'http://vegvendors.in/android/user.jpg', NULL, NULL, NULL, '2016-08-09 18:28:21', '', 'both', 0, 'GOOGLE', '111037751144419682191', '', '', NULL, 0, ''),
(164, 'Ajeet Kamat', 'ajeet.mdb@gmail.com', '', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpa1/v/t1.0-1/p200x200/12308805_914582545245991_7092738184371235068_n.jpg?oh=f1b27c23471d5889ce580489e2f017ba&oe=581DEBA5&__gda__=1478125336_11940edcf4c602ab8cca874a30a42d5c', NULL, NULL, NULL, '2016-08-10 18:51:50', 'male', 'both', 0, 'FACEBOOK', '1054750391229205', '', '', NULL, 0, ''),
(165, 'sushil singh', 'sushil.singh714@gmail.com', '', 'https://lh5.googleusercontent.com/-Gual5cpBfSw/AAAAAAAAAAI/AAAAAAAAADM/UavE0VNrkeM/photo.jpg', NULL, NULL, NULL, '2016-08-10 19:00:23', '', 'both', 0, 'GOOGLE', '108901491124320525581', '', '', NULL, 0, ''),
(166, ',', 'h@h.com', 'v', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-10 19:10:21', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(167, 'gd', 't@g.com', 'g', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-10 19:15:13', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(168, 'mighty jerry', 'mighty.jerry94@gmail.com', '', 'http://vegvendors.in/android/user.jpg', NULL, NULL, NULL, '2016-08-12 07:16:02', '', 'both', 0, 'GOOGLE', '105887752595047547376', '', '', NULL, 0, ''),
(170, 'Sarthak Rajpal', 'rajpalsarthak@gmail.com', '', 'http://vegvendors.in/android/user.jpg', NULL, NULL, NULL, '2016-08-14 10:27:37', '', 'both', 0, 'GOOGLE', '114746376735316051522', '', '', NULL, 0, ''),
(171, 'Himanshu Raj', 'h1235p@gmail.com', '', 'https://lh4.googleusercontent.com/-6BceCD9sSXY/AAAAAAAAAAI/AAAAAAAAABU/j3PidpEP_IY/photo.jpg', NULL, NULL, NULL, '2016-08-15 10:56:17', '', 'both', 0, 'GOOGLE', '105368894798865384520', '', '', NULL, 0, ''),
(172, 'JAGRITI VERMA', 'victoriaverma1306@gmail.com', '@123456jagriti', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-16 12:01:28', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'active', 0, ''),
(173, 'Saurabh Suman', 'timebazaarindia@gmail.com', '', 'http://vegvendors.in/android/user.jpg', NULL, NULL, NULL, '2016-08-21 22:15:42', '', 'both', 0, 'GOOGLE', '109907576573508849624', '', '', NULL, 0, ''),
(174, 'Vibha Chaudhary', 'chaudhary.vibha74@gmail.com', '', 'http://vegvendors.in/android/user.jpg', '9313684205', 'azadpur', NULL, '2016-08-22 19:25:39', '', 'both', 0, 'GOOGLE', '111772840819320258684', '', '', NULL, 0, ''),
(175, 'Fake Id', 'fake.lakshit@gmail.com', '', 'http://vegvendors.in/android/user.jpg', NULL, NULL, NULL, '2016-08-23 18:35:10', '', 'both', 0, 'GOOGLE', '102583767965702707853', '', '', NULL, 0, ''),
(176, 'gaurav kumar', 'gauravrwt@gmail.com', '1234567890', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-25 10:58:14', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '61582a0cfd2e91f9b703102798cab12a', 0, ''),
(177, 'vaishali mittal', 'vaishal.mittal.886@email.com', '8860551313', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-26 11:22:29', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(178, 'rishabh jain', 'rishabh9213@gmail.com', '9871928225', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-26 11:32:55', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(179, 'vaishali', 'vaishalimittal886@gmail.com', '8860551313', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-08-26 16:13:10', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(180, 'Gaurav Mittal', 'gauravmittal300@gmail.com', '', 'https://scontent.xx.fbcdn.net/v/t1.0-1/p200x200/14067606_1074524975969975_8294368901346722415_n.jpg?oh=d727a3c2946d7553951ecc50134d6905&oe=585B7037', NULL, NULL, NULL, '2016-08-28 07:34:16', 'male', 'both', 0, 'ye rha token', '1081755385246934', '', '', NULL, 0, ''),
(181, 'atul joshi', 'joshiatul921998@gmail.com', '', 'http://vegvendors.in/android/user.jpg', NULL, NULL, NULL, '2016-08-28 17:18:15', '', 'both', 0, 'GOOGLE', '117211208572464577317', '', '', NULL, 0, ''),
(183, 'Mukul Mishra', 'mukulmishra112@gmail.com', '', 'https://lh4.googleusercontent.com/-q5uBA7OjcoQ/AAAAAAAAAAI/AAAAAAAAAHw/B3N5HbZy3dM/photo.jpg', NULL, NULL, NULL, '2016-09-02 19:13:52', '', 'both', 0, 'GOOGLE', '116161941390946294356', '', '', NULL, 0, ''),
(184, 'hello', 'hello@gmail.com', 'hellohello', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-09-07 09:10:19', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '2fef3edfb7733fa0122117963ec4f6ce', 0, ''),
(185, 'Karan Joshi', 'kjoshi@orkut.in', '', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xft1/v/t1.0-1/p200x200/13921058_1254490737937051_4739029229060310813_n.jpg?oh=b0f3632077687066a5af573aeccdba51&oe=58423460&__gda__=1480631269_d9b5b184b4500b6f106daf48c047e7d0', NULL, NULL, NULL, '2016-09-17 05:59:59', 'male', 'both', 0, 'FACEBOOK', '1282719571780834', '', '', NULL, 0, ''),
(186, 'Navita Panwar', 'navita.09341@gmail.com', '1072638716117129', 'https://graph.facebook.com/1072638716117129/picture?type=large', NULL, '', NULL, '2016-09-18 08:03:33', 'female', 'female', 0, 'facebook', '1072638716117129', 'Lady finger', '', NULL, 0, ''),
(187, 'abc', 'abc@xyz.com', 'abcd', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-09-20 18:46:12', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(188, 'Sanjay Vig', 'isanjayvig@gmail.com', '327185057673268', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfa1/v/t1.0-1/p50x50/13900352_299679553757152_6903131205293208156_n.jpg?oh=a5fedfc21410eecfeba5a3a05065f62b&oe=587B5C30&__gda__=1480384608_f3a1410b1104892ba13c6e4b8f7302a8', NULL, NULL, NULL, '2016-09-21 16:12:59', 'male', 'both', 0, 'facebook', '327185057673268', '', '', NULL, 0, ''),
(189, 'Rahul', 'rahulyup@gmail.com', '12345', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-09-24 16:13:30', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(198, 'kapss', 'parveenkrishnantrey@gmail.com', 'chutiyapa', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-06 07:20:13', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'fbe5bab70f015c6ee5a1a595cfd81696', 0, ''),
(199, 'Rishabh Gulati', 'rishabh.gulati2010@gmail.com', '', 'https://lh5.googleusercontent.com/-M-pbmGCSbeg/AAAAAAAAAAI/AAAAAAAAAHU/3nrMNY0WWCk/photo.jpg', NULL, NULL, NULL, '2016-10-07 06:46:42', '', 'both', 0, 'GOOGLE', '106884657963372184346', '', '', NULL, 0, ''),
(201, 'Aarjay', 'rj@yahoo.com', 'qwerty', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-08 09:47:37', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(202, '.njk', 'fs@gdgf.com', 'hgnjghjhj', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-08 10:45:40', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '0ca4a48dd3840e64537421f15cb41e92', 0, ''),
(203, 'hxjx', 'tsgs@yahoo.com', 'qwerty', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-08 13:29:57', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(204, 'tAarj', 'ras@yahoo.com', 'qwerty', '../../content/profile_photos/vegvendor_black_dp.png', '9818110900', 'dh, jjj, AU Block, Pitampura', NULL, '2016-10-08 13:30:38', 'Male', 'NP', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, 'VV466204'),
(205, 'Jayant Sancheti', 'jayantsancheti11@yahoo.com', '', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpa1/v/t1.0-1/p200x200/13938373_1034207630030520_5708508999049037410_n.jpg?oh=d0ce7895d799c73ea8402e3e4c33cab9&oe=589F21FF&__gda__=1487755005_71f3d27f2556405536406d8aae632f6d', NULL, NULL, NULL, '2016-10-10 12:17:29', 'male', 'both', 0, 'ye rha token', '1081348055316477', '', '', NULL, 0, ''),
(207, '      ', 'ras@jsjs.com', 'qwer', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-12 08:52:16', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(208, 'a       ', 'q@c.com', ' ', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-12 09:07:09', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(209, 'djjdjdj', 'rasna@haho.com', '111111', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-12 09:21:57', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(210, 'Rasban', 's@s.com', 'qqqqqq', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-12 09:32:05', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(211, '     ', 'abc@gmail.com', 'ttjf', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-12 12:49:31', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(212, 'Harsh Gupta', 'harshgupta404@gmail.com', '', 'https://scontent.xx.fbcdn.net/v/t1.0-1/c186.28.349.349/s200x200/267800_101024463329243_2282639_n.jpg?oh=c75b49e8415a9e211c58a574dca4beef&oe=589F7322', NULL, NULL, NULL, '2016-10-13 11:16:01', 'male', 'both', 0, 'FACEBOOK', '1117191998379146', '', '', NULL, 0, ''),
(213, 'aa', 'ras@h.com', 'qwerqwer', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-15 20:55:44', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(214, 'tt', 'o@o.com', 'qwerty', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-15 20:58:30', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(215, 'e', 'e@e.com', 'qwerty', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-15 21:04:07', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(216, 'ra', 'q@q.com', 'qwer1234', '../../content/profile_photos/216/howlifegoing.jpg', '9650407655', 'tb', NULL, '2016-10-15 21:16:58', 'male', 'male', 0, 'vegvendors', 'vegvendors', 'aalu', '', NULL, 0, 'VV996216'),
(217, 'eieie', 'w@w.com', 'qwer1234', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-15 21:39:55', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(218, 'Lakshit', 'Lakshit.aman4@gmail.com', 'lakshitm', '../../content/profile_photos/vegvendor_black_dp.png', NULL, 'bk', NULL, '2016-10-18 06:34:56', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '0994e1a1c9f159aea63fe78f01b98cbc', 0, 'VV521218'),
(219, 'Rashan', 'rashanjjyot@yahoo.com', 'qwerqwer', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-18 10:21:48', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(221, 'Tammini Venkat', 'tammini@solivarindia.com', '', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p200x200/12523926_883560705098869_8774891929772080920_n.jpg?oh=47921a5bfb5d271e6a9556d36de9827b&oe=58A362E3&__gda__=1485736453_afe530413cd6e3f98b5e8f2c4c94f11d', NULL, NULL, NULL, '2016-10-23 15:20:52', 'male', 'both', 0, 'ye rha token', '1095123707275900', '', '', NULL, 0, ''),
(222, 'vaishali', 'vaishalimittal.061@gmail.com', 'omomomomomom', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-10-25 18:00:23', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(223, 'vaishali', 'vaishalimittal466@gmail.com', '8860551313', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-11-02 09:23:19', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(224, 'Lakshay Khosla', 'klakshaya@yahoo.com', '', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xtf1/v/t1.0-1/c0.0.200.200/p200x200/996760_10205444197966087_5019728227792830172_n.jpg?oh=08cf16bcbeeb6fde6a6c372450df74ee&oe=589AF6B9&__gda__=1485914735_1f46e6f065e6b16ae5a9067a98475cbd', NULL, NULL, NULL, '2016-11-08 08:42:33', 'male', 'both', 0, 'ye rha token', '10207614877311714', '', '', NULL, 0, ''),
(225, 'lakshit', 'lakshit.aman5@gmail.com', 'lakshitm', '../../content/profile_photos/vegvendor_black_dp.png', NULL, 'zhh', NULL, '2016-11-25 16:41:58', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(226, 'babita', 'babitakdelhi@gmail.com', 'babita123', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-11-27 04:46:09', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(227, 'Vikash Kumar', 'vikash0439@gmail.com', '117566992456788049008', 'https://lh3.googleusercontent.com/-RQG7EybJd_Y/AAAAAAAAAAI/AAAAAAAADe4/drK1Vj8GBQQ/s96-c/photo.jpg', NULL, NULL, NULL, '2016-11-28 11:22:09', 'male', 'both', 0, 'google', 'vegvendors', '', '', NULL, 0, ''),
(228, 'rj', 'rvvasd@yahoo.com', '11111111', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-11-30 13:16:09', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(229, 'Saurabh Suman', '21saurabhsuman@gmail.com', '1735515359998227', 'https://graph.facebook.com/1735515359998227/picture?type=large', '9999475171', 'Pitampura', NULL, '2016-12-01 08:13:43', 'male', 'NP', 0, 'facebook', '1735515359998227', '', '', NULL, 0, 'VV870229'),
(231, 'sj', 'a@yah.com', '11111111', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-03 13:15:23', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(232, 'Rohan Sharma', 'rohan.kinshu@gmail.com', '107700925990592457967', 'https://lh4.googleusercontent.com/-SSQYZ69koTY/AAAAAAAAAAI/AAAAAAAAAEk/eyqJ42ewSQ8/s96-c/photo.jpg', NULL, NULL, NULL, '2016-12-03 14:05:44', 'male', 'both', 0, 'google', '1465447103500129', '', '', NULL, 0, 'VV904232'),
(233, 'Akshay', 'akshay@akshay.com', '123', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-04 08:10:45', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(234, 'Vaibhav Sharma', 'vsvaibhav2@gmail.com', '', 'https://scontent.xx.fbcdn.net/v/t1.0-1/p200x200/11081495_932205936809902_5287714094666751692_n.jpg?oh=39ffd831d499f9b2c42614162b40080b&oe=58F6A67B', NULL, NULL, NULL, '2016-12-04 10:12:52', 'male', 'both', 0, 'FACEBOOK', '1335504803146678', '', '', NULL, 0, ''),
(235, 'Sunil Kumar', 'sk.inc4ever@yahoo.co.in', '', 'https://scontent.xx.fbcdn.net/v/t1.0-1/c0.0.200.200/p200x200/14713778_1233183166702607_1651917942815959941_n.jpg?oh=6efeda02e8024e32c12ff24bf9e39a1e&oe=58C7087F', NULL, NULL, NULL, '2016-12-04 10:13:13', 'male', 'both', 0, 'FACEBOOK', '1275504679137122', '', '', NULL, 0, ''),
(236, 'bhoot', 'bhoot@gmail.com', '123456', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-04 17:15:39', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(237, 'yash', 'yashpasricha@yahoo.com', 'pasricha6923', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-05 16:34:50', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(238, 'demo', 'demo@demo.demo', 'demo', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-13 12:57:56', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(239, 'demo', 'demo@demo.dem', 'demo', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-13 13:00:07', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, ''),
(241, 'Time Bazaar', 'timebazaar@yahoo.com', 'timebazaar2345', '../../content/profile_photos/vegvendor_black_dp.png', '9878987102', 'ap block', NULL, '2016-12-22 07:42:35', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'active', 0, 'VV420241'),
(242, 'Veg Vendors', 'vegvendors@yahoo.com', 'vegvendors@2345', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-22 08:20:39', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '43b46afce2a4eb78311df3c0e57109b9', 0, ''),
(243, 'Pratyush Pankaj', 'ronny.rooney10@yahoo.com', '851211381673652', 'https://graph.facebook.com/851211381673652/picture?type=large', NULL, NULL, NULL, '2016-12-22 09:12:06', 'male', 'both', 0, 'facebook', 'vegvendors', '', '', NULL, 0, ''),
(244, 'Saurabh Suman', '93saurabhsuman@gmail.com', 'saurabh123', '../../content/profile_photos/vegvendor_black_dp.png', NULL, '', NULL, '2016-12-22 09:26:16', 'male', 'both', 0, 'vegvendors', 'vegvendors', '', '', 'active', 0, ''),
(245, 'yxh', 'a@a.com', '11111111', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-23 07:39:57', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '514ae85462614a59b8bc8376025b0273', 0, 'VV119245'),
(246, 'Rashanjyot Singh', 'rashanjyotg@gmail.com', 'rashan123', 'http://vegvendors.in/android/user.jpg', '9818110933', 'sjsi', NULL, '2016-12-23 07:44:38', '', 'NP', 0, 'GOOGLE', '105843249614708484178', '', '', '5e2e2441ef01f0c78d69dcab181cc35a', 0, 'VV646246'),
(247, 'ronny', 'ron1@test.in', '12345678', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-23 12:08:00', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'e9c32f66674cea1ac184ebd80640d4bd', 0, ''),
(248, 'ronny', 'ron101@test.in', '12345678', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-23 12:13:58', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '1312404dccb0b2f99e5dea45914e80fb', 0, ''),
(249, 'rasha jyot', 'r@r.com', 'rrrrrrrr', '../../content/profile_photos/vegvendor_black_dp.png', '66', '', NULL, '2016-12-23 12:16:39', 'Female', 'NP', 0, 'vegvendors', 'vegvendors', '', '', '08de569168db27c8c7748128aaa24ad8', 0, 'VV373249'),
(250, 'Milky Bar', 'milky@bar.com', '12345678', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-23 16:01:08', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '9a192e6e387e4471959a651c75579acb', 0, ''),
(251, 'Classic', 'classic@wills.com', '12345678', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-23 16:05:07', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '0ae5de77f2615251b1cc2a2600a15d9a', 0, ''),
(252, 'Divyansh Jha', 'divyanshj.16@gmail.com', '1197623093665108', 'https://graph.facebook.com/1197623093665108/picture?type=large', NULL, NULL, NULL, '2016-12-24 05:36:52', 'male', 'both', 0, 'facebook', 'vegvendors', '', '', 'dee21925f36a046232eed0461421d2bb', 0, 'VV119252'),
(253, 'Saurabh Suman', 'saurabhsuman21@gmail.com', '115375032299290507719', 'https://lh6.googleusercontent.com/-ilcUbflVWT8/AAAAAAAAAAI/AAAAAAAAA7w/zHzxFwStmgE/s96-c/photo.jpg', NULL, NULL, NULL, '2016-12-24 12:44:13', 'male', 'both', 0, 'google', 'vegvendors', '', '', NULL, 0, 'VV498253'),
(254, 'MAYANK BHATT', 'mayankbhatt404@gmail.com', '109512578607074756914', 'https://lh6.googleusercontent.com/-4fnLnFCzrJo/AAAAAAAAAAI/AAAAAAAAAAA/AKB_U8shRs6PCD9Sd5XyX_LLXTlXfwFPhg/s96-c/photo.jpg', NULL, NULL, NULL, '2016-12-26 07:57:46', 'male', 'both', 0, 'google', 'vegvendors', '', '', 'active', 0, ''),
(255, 'Sunil Kumar', 'skumar.hurray123@gmail.com', 'sunil123', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-26 12:20:42', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'd023880cd2e3f888db750b4ba196ffa1', 0, ''),
(256, 'Master Vendor', 'mvpitampura@gmail.com', '102608841355662159402', 'https://lh3.googleusercontent.com/-bhjSHrCZZBw/AAAAAAAAAAI/AAAAAAAAAAA/AKB_U8un9GQ9swvPw4k3VyJM7CMskse3Aw/s96-c/photo.jpg', NULL, NULL, NULL, '2016-12-27 12:15:10', 'male', 'both', 0, 'google', 'vegvendors', '', '', NULL, 0, ''),
(257, 'pankaj', 'bhattpankaj8439@ymail.com', 'pankajbhatt', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-29 12:32:10', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '6efefe02ccd0856643ec1c30cf7f0c0e', 0, ''),
(258, 'Laptop baba', 'laptop@hp.com', '12345678', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2016-12-29 19:52:33', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'f06b180b81f3cd5258bb105f0fecc8b4', 0, ''),
(259, 'aman 3', 'lakshit.aman3@gmail.com', '115049817229860455321', 'https://lh5.googleusercontent.com/-8CHg7q4lW0o/AAAAAAAAAAI/AAAAAAAAAAA/AKB_U8sgBv4nDijEE3c8PUriFQBWmvKSzw/s96-c/photo.jpg', NULL, 'bhx', NULL, '2017-01-02 07:46:01', 'male', 'both', 0, 'google', 'vegvendors', '', '', NULL, 0, 'VV459259'),
(260, '1', '1', '', '1', NULL, NULL, NULL, '2017-01-03 09:14:00', '1', 'both', 0, '1', '1', '', '', NULL, 0, ''),
(261, 'G', 'G', '', 'G', NULL, NULL, NULL, '2017-01-03 09:14:00', 'G', 'both', 0, 'G', 'G', '', '', NULL, 0, ''),
(262, 'r', 'r', '', 'r', NULL, NULL, NULL, '2017-01-03 09:14:00', 'r', 'both', 0, 'r', 'r', '', '', NULL, 0, ''),
(263, 'j', 'j', '', 'j', NULL, NULL, NULL, '2017-01-03 09:24:42', 'j', 'both', 0, 'j', 'j', '', '', NULL, 0, ''),
(264, 'F', 'F', '', 'F', NULL, NULL, NULL, '2017-01-03 09:24:42', 'F', 'both', 0, 'F', 'F', '', '', NULL, 0, ''),
(265, 'A', 'A', '', 'A', NULL, NULL, NULL, '2017-01-03 09:24:42', 'A', 'both', 0, 'A', 'A', '', '', NULL, 0, ''),
(266, 'Rashanjyot Singh', 'rashanjyot@yahoo.com', '1399210626775441', 'https://graph.facebook.com/1399210626775441/picture?type=large', NULL, NULL, NULL, '2017-01-03 09:38:30', 'male', 'both', 0, 'facebook', '1399210626775441', '', '', NULL, 0, 'VV928266'),
(267, '2', '2', '', '2', NULL, NULL, NULL, '2017-01-03 11:55:59', '2', 'both', 0, '2', '2', '', '', NULL, 0, ''),
(268, 'S', 'S', '', 'S', NULL, NULL, NULL, '2017-01-03 11:55:59', 'S', 'both', 0, 'S', 'S', '', '', NULL, 0, ''),
(269, 'Divyansh Jha', 'xa@a.com', '123456789', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2017-01-03 19:32:12', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'ee955f4c1753484daa962ec44be5e6f4', 0, ''),
(270, 'sadasdasdas asdas', 'ads@gmas.com', '1234567890', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2017-01-03 19:48:52', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '7debb6fc503630fa126aa543e77e4c5c', 0, ''),
(271, 'asasad', 'aa@a.com', '1234567890', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2017-01-03 19:49:49', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '663310cadedf73adbb59821736ed1d8f', 0, ''),
(272, 'asasa', 'asasas@a.com', '1234567890', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2017-01-03 19:50:42', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'a4e16e89ad3f6ff41bc1aab50893b376', 0, ''),
(273, 'asasasad', 'abxcds@acd.com', 'aaaaaaaaaaaa', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2017-01-03 19:52:47', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '8b20fb05ce20864b4a9b47417b36b394', 0, ''),
(274, 'Divyansh Jha', 'dj@dj.com', '1234567890', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2017-01-03 19:53:26', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '3b64761d7eb38cc4f283f2fab9b31bc5', 0, 'VV561274'),
(275, 'JJ', 'div@div.com', 'knocknock', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2017-01-04 10:14:10', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'd9b657b0e57687b9654fc28b39dac390', 0, ''),
(276, 'Divyansh Jha', 'hello@hi.com', '1234567890', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2017-01-04 10:15:19', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'f1c4dabf06c38d071e0495b42aa73740', 0, 'VV192276'),
(277, 'Divyansh', 'mb@ak.com', 'divyanshjha', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2017-01-04 13:12:17', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', '17d9d5d720d00e90d0c5d4025a68421b', 0, ''),
(278, 'mayank Bhatt', 'maa@ak.com', '1234567890', '../../content/profile_photos/vegvendor_black_dp.png', NULL, NULL, NULL, '2017-01-04 13:13:22', NULL, 'both', 0, 'vegvendors', 'vegvendors', '', '', 'acfc1e179bfece3ab8fb34a95d3b9be4', 0, 'VV671278'),
(281, 'Aman Jolly', 'jollyaman.jolly663@gmail.com', '100465301240284103425', 'https://lh4.googleusercontent.com/-UXj_6-LIWm8/AAAAAAAAAAI/AAAAAAAAAWI/v-2HecZf2xU/s96-c/photo.jpg', '9968967301', 'b rty', NULL, '2017-01-07 14:24:54', 'male', 'both', 0, 'google', 'vegvendors', '', '', NULL, 0, 'VV974281'),
(311, 'Divyansh jha', 'jha.divyansh.97@gmail.com', '', 'https://lh3.googleusercontent.com/-5BQJl2lfPvQ/AAAAAAAAAAI/AAAAAAAAACk/AgZoEYooxMA/photo.jpg', NULL, NULL, NULL, '2017-01-11 17:58:24', 'male', 'both', 0, 'vegvendors', 'vegvendors', '', '', NULL, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `sabziz`
--

CREATE TABLE IF NOT EXISTS `sabziz` (
  `sabzi_id` int(2) NOT NULL AUTO_INCREMENT,
  `sabzi_name` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `sabzi_category` int(1) NOT NULL,
  `sabzi_pic` mediumtext CHARACTER SET latin1 NOT NULL,
  `rate` float NOT NULL DEFAULT '1',
  `alt` varchar(90) NOT NULL DEFAULT 'vegvendors',
  `hindi_name` varchar(90) DEFAULT NULL,
  `hing_name` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`sabzi_id`),
  KEY `svid` (`sabzi_id`),
  KEY `svid_2` (`sabzi_id`),
  KEY `sabzi_name` (`sabzi_name`(767)),
  KEY `sid` (`sabzi_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `sabziz`
--

INSERT INTO `sabziz` (`sabzi_id`, `sabzi_name`, `sabzi_category`, `sabzi_pic`, `rate`, `alt`, `hindi_name`, `hing_name`) VALUES
(1, 'Potato (à¤†à¤²à¥‚)', 1, 'sabzi-pics/potato.gif', 0.5, 'vegvendors potato', 'allu allo alu alloo aalu', 'Aalu'),
(2, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 'sabzi-pics/onion.gif', 0.5, 'vegvendors onion', 'pyaaz pyaz pyaaj pyaj', 'Pyaaz'),
(3, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 'sabzi-pics/tomato.gif', 0.5, 'vegvendors tomato', 'tamatar', 'Tamatar'),
(4, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 2, 'sabzi-pics/cabbage.gif', 0.5, 'vegvendors cabbage', 'bandh gobhi patta gobhi band gobi', 'Patta gobhi'),
(5, 'Carrot (à¤—à¤¾à¤œà¤°)', 2, 'sabzi-pics/carrot.gif', 0.25, 'vegvendors carrot', 'gajjar gaajar gajar gazar gaazar', 'Gajar'),
(6, 'Radish (à¤®à¥‚à¤²à¥€)', 2, 'sabzi-pics/reddish.gif', 0.5, 'vegvendors radish', 'mooli', 'Mooli'),
(7, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 2, 'sabzi-pics/peas.gif', 0.25, 'vegvendors peas', 'matar', 'Matar'),
(8, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 2, 'sabzi-pics/french_beans.gif', 0.25, 'vegvendors french beans', 'fali', 'French beans'),
(9, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 2, 'sabzi-pics/jackfruit.gif', 0.5, 'vegvendors jackfruit', 'kathal', 'Kathal'),
(10, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 2, 'sabzi-pics/tori.gif', 0.5, 'vegvendors ridge gourd', 'tori', 'Tori'),
(11, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 2, 'sabzi-pics/sweet_corn.gif', 0.25, 'vegvendors sweet corn', 'Sweet Corn Baby Corn', 'Sweet corn'),
(12, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 2, 'sabzi-pics/broccoli.gif', 0.25, 'vegvendors broccoli', 'Broccoli', 'Broccoli'),
(13, 'Cucumber (à¤–à¥€à¤°à¤¾)', 2, 'sabzi-pics/cucumber.gif', 0.5, 'vegvendors cucumber', 'kheera', 'Kheera'),
(14, 'Sem (&#2360;&#2375;&#2350; &#2325;&#2368; &#2347;&#2354;&#2368;)', 2, 'sabzi-pics/sem.gif', 0.25, 'vegvendors sem', 'sem', 'Sem'),
(15, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 2, 'sabzi-pics/capsicum(green).gif', 0.25, 'vegvendors capsicum', 'shimla mirch', 'Hari shimla mirch'),
(16, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 3, 'sabzi-pics/cauliflower.gif', 0.5, 'vegvendors cauliflower', 'fool gobi Phool gobhi', 'Phool gobhi'),
(17, 'Sarso Saag ( ????? ?? ???)', 3, 'sabzi-pics/sarso_saag.gif', 0.5, 'vegvendors sarso saag', 'Sarso Saag', 'Sarso saag'),
(18, 'Spinach (à¤ªà¤¾à¤²à¤•)', 3, 'sabzi-pics/spinach.gif', 0.25, 'vegvendors spinach', 'palak paalak', 'Palak'),
(19, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 3, 'sabzi-pics/lady_finger.gif', 0.25, 'vegvendors lady finger', 'bhindi', 'Bhindi'),
(20, 'Cluster Beans (????? ?? ???))', 3, 'sabzi-pics/green_beans.gif', 0.25, 'vegvendors cluster beans', 'gwar phali fali guar', 'Gwar Phali'),
(21, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 3, 'sabzi-pics/brinjal.gif', 0.5, 'vegvendors brinjal', 'baingan', 'Baingan'),
(22, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 3, 'sabzi-pics/tinda.gif', 0.5, 'vegvendors tinda', 'tinda', 'Tinda'),
(23, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 3, 'sabzi-pics/pumpkin.gif', 0.5, 'vegvendors pumpkin', 'kaddu', 'Sitaphal'),
(24, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 3, 'sabzi-pics/bottle_gourd.gif', 0.5, 'vegvendors bottle gourd', 'loki ghiya lauki', 'Gheeya'),
(25, 'Lettuce (&#2360;&#2354;&#2366;&#2342; &#2346;&#2340;&#2381;&#2340;&#2366;)', 3, 'sabzi-pics/lettuce.gif', 0.25, 'vegvendors lettuce', 'salaad patta', 'Lettuce'),
(26, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 3, 'sabzi-pics/mushrooms.gif', 0.1, 'vegvendors mushroom', 'Mushroom', 'Mushroom'),
(27, 'Olives (&#2332;&#2376;&#2340;&#2370;&#2344;)', 3, 'sabzi-pics/olive.gif', 0.25, 'vegvendors olives', 'Olives Jaitun', 'Olives'),
(28, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 4, 'sabzi-pics/lemon.gif', 0.25, 'vegvendors lemon', 'nimbo nimboo neemboo', 'Nimbu'),
(29, 'Ginger (à¤…à¤¦à¤°à¤•)', 4, 'sabzi-pics/ginger.gif', 0.1, 'vegvendors ginger', 'adrak', 'Adarak'),
(30, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 4, 'sabzi-pics/peppermint.gif', 0.1, 'vegvendors pudina', 'pudeena', 'Pudina'),
(31, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 4, 'sabzi-pics/coriander_leaves.gif', 0.1, 'vegvendors corriander leaves', 'dhaniya', 'Hara dhaniya'),
(32, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 4, 'sabzi-pics/amla.gif', 0.25, 'vegvendors amla', 'amla ', 'Aanwla'),
(33, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 4, 'sabzi-pics/sweet_potato.gif', 0.5, 'vegvendors sweet potato', 'sakarkand shakarkand', 'Shakarkand'),
(34, 'Turnip (à¤¶à¤²à¤—à¤®)', 4, 'sabzi-pics/turnip.gif', 0.5, 'vegvendors turnip', 'shalgam', 'Shalgam'),
(35, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 4, 'sabzi-pics/garlic.gif', 0.1, 'vegvendors garlic', 'lehsoon lason', 'Lahsun'),
(36, 'Bitter Gourd (à¤•à¤°à¥‡à¤²à¤¾)', 4, 'sabzi-pics/bittergourd.gif', 0.25, 'vegvendors bitter gourd', 'karela', 'Karela'),
(37, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 4, 'sabzi-pics/chillies(red_green).gif', 0.1, 'vegvendors chillies', 'mirch', 'Mirch'),
(38, 'Bell Pepper (&#2354;&#2366;&#2354; &#2324;&#2352; &#2346;&#2368;&#2354;&#2368; &#2358;&#2367;&#2350;&#2354;&#2366; &#2350;&#2367;&#2352;&#2381;&#2330; )', 4, 'sabzi-pics/bell_pepper(red_yellow).gif', 0.25, 'vegvendors bell pepper', 'shimla mirch', 'Lal-peeli shimla mirch'),
(40, 'Methi (à¤®à¥‡à¤¥à¥€)', 4, 'sabzi-pics/methi.gif', 0.1, 'vegvendors methi', 'Methi', 'Methi'),
(41, 'Arbi (à¤…à¤°à¤¬à¥€)', 2, 'sabzi-pics/arbi.gif', 0.25, 'vegvendors arbi', 'Arbi', 'Arbi'),
(42, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 4, 'sabzi-pics/ambi.gif', 0.1, 'vegvendors ambi', 'kaccha aam', 'Kacchi ambi');

--
-- Triggers `sabziz`
--
DROP TRIGGER IF EXISTS `Delete_sabziz_trigger`;
DELIMITER //
CREATE TRIGGER `Delete_sabziz_trigger` AFTER DELETE ON `sabziz`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'vegnmlist';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Insert_sabziz_trigger`;
DELIMITER //
CREATE TRIGGER `Insert_sabziz_trigger` AFTER INSERT ON `sabziz`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'vegnmlist';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Update_sabziz_trigger`;
DELIMITER //
CREATE TRIGGER `Update_sabziz_trigger` AFTER UPDATE ON `sabziz`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'vegnmlist';

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sabzi_price`
--

CREATE TABLE IF NOT EXISTS `sabzi_price` (
  `prsno` int(10) NOT NULL AUTO_INCREMENT,
  `sabzi_id` int(2) NOT NULL,
  `place_code` varchar(45) NOT NULL,
  `price_per_kg` double NOT NULL,
  `availability` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`prsno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=334 ;

--
-- Dumping data for table `sabzi_price`
--

INSERT INTO `sabzi_price` (`prsno`, `sabzi_id`, `place_code`, `price_per_kg`, `availability`) VALUES
(4, 24, '5', 30, 1),
(5, 32, '4', 120, 1),
(6, 1, '4', 30, 1),
(8, 3, '4', 80, 1),
(9, 4, '4', 30, 1),
(10, 5, '4', 40, 1),
(11, 6, '4', 20, 1),
(12, 7, '4', 60, 1),
(13, 8, '4', 75, 1),
(14, 9, '4', 40, 1),
(15, 10, '4', 40, 1),
(16, 11, '4', 75, 1),
(17, 12, '4', 100, 1),
(18, 13, '4', 60, 1),
(19, 15, '4', 70, 1),
(20, 16, '4', 70, 1),
(22, 18, '4', 30, 1),
(23, 19, '4', 40, 1),
(24, 21, '4', 70, 1),
(25, 22, '4', 60, 1),
(26, 23, '4', 20, 1),
(27, 24, '4', 40, 1),
(28, 26, '4', 250, 1),
(29, 28, '4', 100, 1),
(30, 29, '4', 80, 1),
(31, 30, '4', 100, 1),
(32, 31, '4', 80, 1),
(34, 35, '4', 200, 1),
(35, 36, '4', 40, 1),
(36, 37, '4', 80, 1),
(37, 28, '5', 100, 1),
(38, 29, '5', 80, 1),
(39, 30, '5', 100, 1),
(40, 31, '5', 80, 1),
(42, 32, '5', 120, 1),
(43, 35, '5', 200, 1),
(44, 36, '5', 40, 1),
(45, 37, '5', 80, 1),
(46, 1, '5', 22, 1),
(47, 2, '5', 22, 1),
(48, 3, '5', 50, 1),
(49, 4, '5', 30, 1),
(51, 5, '5', 40, 1),
(52, 6, '5', 20, 1),
(53, 7, '5', 60, 1),
(54, 8, '5', 80, 1),
(55, 9, '5', 40, 1),
(56, 10, '5', 40, 1),
(57, 11, '5', 75, 1),
(58, 12, '5', 100, 1),
(59, 13, '5', 50, 1),
(60, 15, '5', 70, 1),
(61, 16, '5', 70, 1),
(62, 18, '5', 30, 1),
(63, 19, '5', 40, 1),
(64, 21, '5', 70, 1),
(65, 22, '5', 60, 1),
(66, 23, '5', 20, 1),
(70, 26, '5', 250, 1),
(71, 1, '6', 22, 1),
(72, 2, '6', 22, 1),
(73, 3, '6', 50, 1),
(75, 4, '6', 30, 1),
(76, 5, '6', 40, 1),
(77, 6, '6', 20, 1),
(78, 7, '6', 60, 1),
(79, 8, '6', 80, 1),
(80, 9, '6', 40, 1),
(81, 10, '6', 40, 1),
(82, 11, '6', 75, 1),
(83, 12, '6', 100, 1),
(84, 13, '6', 50, 1),
(85, 15, '6', 70, 1),
(86, 16, '6', 70, 1),
(87, 18, '6', 30, 1),
(89, 21, '6', 70, 1),
(90, 22, '6', 60, 1),
(91, 23, '6', 20, 1),
(92, 24, '6', 40, 1),
(93, 26, '6', 250, 1),
(94, 28, '6', 100, 1),
(95, 29, '6', 80, 1),
(96, 30, '6', 100, 1),
(97, 31, '6', 80, 1),
(98, 32, '6', 120, 1),
(99, 35, '6', 200, 1),
(100, 36, '6', 40, 1),
(102, 37, '6', 80, 1),
(103, 28, '7', 100, 1),
(104, 29, '7', 80, 1),
(105, 30, '7', 100, 1),
(106, 31, '7', 80, 1),
(107, 32, '7', 120, 1),
(108, 35, '7', 200, 1),
(109, 36, '7', 40, 1),
(110, 37, '7', 80, 1),
(111, 28, '8', 100, 1),
(112, 29, '8', 80, 1),
(117, 30, '8', 100, 1),
(119, 31, '8', 80, 1),
(120, 32, '8', 120, 1),
(121, 35, '8', 200, 1),
(122, 36, '8', 40, 1),
(123, 37, '8', 80, 1),
(124, 28, '9', 100, 1),
(125, 29, '9', 80, 1),
(126, 30, '9', 100, 1),
(127, 31, '9', 80, 1),
(128, 32, '9', 120, 1),
(129, 35, '9', 200, 1),
(130, 36, '9', 40, 1),
(131, 37, '9', 80, 1),
(132, 28, '10', 100, 1),
(133, 29, '10', 80, 1),
(134, 30, '10', 100, 1),
(135, 31, '10', 80, 1),
(136, 32, '10', 120, 1),
(137, 35, '10', 200, 1),
(138, 36, '10', 40, 1),
(140, 37, '10', 80, 1),
(141, 28, '11', 100, 1),
(142, 29, '11', 80, 1),
(143, 30, '11', 100, 1),
(145, 32, '11', 120, 1),
(147, 35, '11', 200, 1),
(148, 36, '11', 40, 1),
(149, 37, '11', 80, 1),
(150, 1, '7', 22, 1),
(151, 2, '7', 22, 1),
(152, 3, '7', 50, 1),
(153, 1, '8', 22, 1),
(155, 3, '8', 50, 1),
(157, 1, '9', 22, 1),
(159, 2, '8', 22, 1),
(162, 2, '9', 22, 1),
(164, 3, '9', 50, 1),
(166, 1, '10', 22, 1),
(168, 2, '10', 22, 1),
(170, 3, '10', 50, 1),
(173, 3, '11', 50, 1),
(174, 2, '11', 22, 1),
(175, 4, '7', 30, 1),
(178, 6, '7', 20, 1),
(182, 4, '8', 30, 1),
(188, 5, '8', 40, 1),
(189, 6, '8', 20, 1),
(190, 4, '9', 30, 1),
(192, 5, '9', 40, 1),
(193, 6, '9', 20, 1),
(194, 4, '10', 30, 1),
(195, 5, '10', 40, 1),
(196, 6, '10', 20, 1),
(197, 4, '11', 30, 1),
(199, 6, '11', 20, 1),
(200, 5, '11', 40, 1),
(201, 7, '7', 60, 1),
(202, 7, '8', 60, 1),
(204, 7, '9', 60, 1),
(205, 7, '10', 60, 1),
(206, 7, '11', 60, 1),
(207, 8, '7', 80, 1),
(209, 8, '9', 80, 1),
(211, 8, '10', 80, 1),
(213, 9, '7', 40, 1),
(214, 16, '7', 70, 1),
(215, 9, '8', 40, 1),
(216, 9, '9', 40, 1),
(218, 9, '10', 40, 1),
(219, 9, '11', 40, 1),
(220, 18, '7', 30, 1),
(221, 10, '7', 40, 1),
(222, 19, '7', 40, 1),
(223, 10, '8', 40, 1),
(224, 10, '9', 40, 1),
(225, 10, '10', 40, 1),
(226, 21, '7', 70, 1),
(227, 10, '11', 40, 1),
(228, 22, '7', 60, 1),
(229, 11, '7', 75, 1),
(230, 23, '7', 20, 1),
(231, 11, '8', 75, 1),
(232, 11, '9', 75, 1),
(233, 24, '7', 40, 1),
(234, 11, '10', 75, 1),
(235, 11, '11', 75, 1),
(236, 26, '7', 250, 1),
(237, 12, '7', 100, 1),
(238, 12, '8', 100, 1),
(239, 12, '9', 100, 1),
(240, 12, '10', 100, 1),
(241, 12, '11', 100, 1),
(242, 16, '8', 70, 1),
(244, 18, '8', 30, 1),
(245, 13, '8', 50, 1),
(246, 13, '9', 50, 1),
(247, 19, '8', 40, 1),
(250, 21, '8', 70, 1),
(251, 13, '10', 50, 1),
(252, 22, '8', 60, 1),
(253, 13, '11', 50, 1),
(254, 23, '8', 20, 1),
(255, 15, '7', 70, 1),
(257, 24, '8', 40, 1),
(258, 15, '8', 70, 1),
(259, 15, '9', 70, 1),
(260, 26, '8', 250, 1),
(262, 15, '11', 70, 1),
(263, 16, '9', 70, 1),
(264, 19, '9', 40, 1),
(265, 18, '9', 30, 1),
(267, 21, '9', 70, 1),
(268, 22, '9', 60, 1),
(269, 23, '9', 20, 1),
(270, 24, '9', 40, 1),
(271, 26, '9', 250, 1),
(272, 16, '10', 70, 1),
(273, 18, '10', 30, 1),
(275, 19, '10', 40, 1),
(276, 21, '10', 70, 1),
(277, 22, '10', 60, 1),
(278, 23, '10', 20, 1),
(279, 24, '10', 40, 1),
(280, 26, '10', 250, 1),
(281, 16, '11', 70, 1),
(282, 18, '11', 30, 1),
(283, 19, '11', 40, 1),
(284, 21, '11', 70, 1),
(285, 22, '11', 60, 1),
(286, 23, '11', 20, 1),
(287, 24, '11', 40, 1),
(288, 26, '11', 250, 1),
(290, 42, '4', 44, 1),
(291, 41, '4', 80, 1),
(292, 41, '5', 80, 1),
(293, 41, '6', 80, 1),
(294, 41, '7', 80, 1),
(295, 41, '8', 80, 1),
(296, 41, '9', 80, 1),
(297, 41, '10', 80, 1),
(298, 41, '11', 80, 1),
(299, 42, '5', 60, 1),
(300, 42, '6', 60, 1),
(301, 42, '7', 60, 1),
(302, 42, '8', 60, 1),
(303, 42, '9', 60, 1),
(304, 42, '10', 60, 1),
(305, 42, '11', 60, 1),
(306, 40, '', 35, 1),
(307, 40, '5', 140, 1),
(308, 40, '6', 140, 1),
(309, 40, '7', 140, 1),
(310, 40, '8', 140, 1),
(311, 40, '9', 140, 1),
(312, 40, '10', 140, 1),
(313, 40, '11', 140, 1),
(314, 40, '4', 140, 1),
(315, 34, '4', 100, 1),
(316, 34, '5', 100, 1),
(317, 34, '6', 100, 1),
(318, 34, '7', 100, 1),
(319, 34, '8', 100, 1),
(320, 34, '9', 100, 1),
(321, 34, '10', 100, 1),
(322, 34, '11', 100, 1),
(323, 33, '4', 70, 1),
(324, 33, '5', 70, 1),
(325, 33, '6', 70, 1),
(326, 33, '7', 70, 1),
(327, 33, '8', 70, 1),
(328, 33, '9', 70, 1),
(330, 33, '11', 70, 1),
(331, 33, '10', 70, 1),
(333, 2, '4', 20, 1);

--
-- Triggers `sabzi_price`
--
DROP TRIGGER IF EXISTS `delete_sabzi_price_trigger`;
DELIMITER //
CREATE TRIGGER `delete_sabzi_price_trigger` AFTER DELETE ON `sabzi_price`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'MainJson' and tableName = 'sabzi_price';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `insert_sabzi_price_trigger`;
DELIMITER //
CREATE TRIGGER `insert_sabzi_price_trigger` AFTER INSERT ON `sabzi_price`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'MainJson'AND tableName = 'sabzi_price';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `update_sabzi_price_trigger`;
DELIMITER //
CREATE TRIGGER `update_sabzi_price_trigger` AFTER UPDATE ON `sabzi_price`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'MainJson'AND tableName = 'sabzi_price';

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sabzi_wala`
--

CREATE TABLE IF NOT EXISTS `sabzi_wala` (
  `svid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `pic` mediumtext NOT NULL,
  `contact` varchar(10) NOT NULL,
  `sabzi_category1` tinyint(1) NOT NULL DEFAULT '0',
  `sabzi_category2` tinyint(1) NOT NULL DEFAULT '0',
  `sabzi_category3` tinyint(1) NOT NULL DEFAULT '0',
  `sabzi_category4` tinyint(1) NOT NULL DEFAULT '0',
  `dor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `place_code` varchar(45) NOT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`svid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `sabzi_wala`
--

INSERT INTO `sabzi_wala` (`svid`, `name`, `pic`, `contact`, `sabzi_category1`, `sabzi_category2`, `sabzi_category3`, `sabzi_category4`, `dor`, `place_code`, `gender`, `available`) VALUES
(35, 'Ajay', 'vender-pics/4/Ajay/BlueLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:06:10', '4', NULL, 1),
(36, 'Tarun', 'vender-pics/5/Tarun/DarkGreenLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:07:03', '5', NULL, 1),
(37, 'Rajpal', 'vender-pics/6/Rajpal/GreenLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:07:30', '6', NULL, 1),
(38, 'Sambhu', 'vender-pics/7/Sambhu/PinkLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:07:59', '7', NULL, 1),
(39, 'Bhushan', 'vender-pics/8/Bhushan/RedLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:08:26', '8', NULL, 1),
(40, 'Sanjay', 'vender-pics/9/Sanjay/YellowLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:08:53', '9', NULL, 1),
(41, 'Ajay', 'vender-pics/10/Ajay/BlueLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:10:07', '10', NULL, 1),
(42, 'Tarun', 'vender-pics/11/Tarun/DarkGreenLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:10:35', '11', NULL, 1),
(43, 'Kalu', 'vender-pics/4/Kalu/GreenLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:13:01', '4', NULL, 1),
(44, 'Ramu', 'vender-pics/4/Ramu/PinkLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:13:26', '4', NULL, 1),
(46, 'Tinku', 'vender-pics/5/Tinku/YellowLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:14:24', '5', NULL, 1),
(47, 'Shyam', 'vender-pics/5/Shyam/BlueLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:15:57', '5', NULL, 1),
(48, 'Lalu', 'vender-pics/6/Lalu/DarkGreenLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:16:39', '6', NULL, 1),
(49, 'Sohan', 'vender-pics/6/Sohan/PinkLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:17:04', '6', NULL, 1),
(50, 'Ramu', 'vender-pics/7/Ramu/YellowLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:18:41', '7', NULL, 1),
(51, 'Shyam', 'vender-pics/7/Shyam/RedLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:19:06', '7', NULL, 1),
(52, 'Vikas', 'vender-pics/8/Vikas/BlueLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:20:00', '8', NULL, 1),
(53, 'Suraj', 'vender-pics/8/Suraj/GreenLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:20:25', '8', NULL, 1),
(54, 'Ramesh', 'vender-pics/9/Ramesh/PinkLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:21:10', '9', NULL, 1),
(55, 'Chandan', 'vender-pics/9/Chandan/RedLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:21:34', '9', NULL, 1),
(56, 'Rinku', 'vender-pics/10/Rinku/YellowLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:22:34', '10', NULL, 1),
(57, 'Utpal', 'vender-pics/10/Utpal/BlueLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:22:56', '10', NULL, 1),
(58, 'Lucky', 'vender-pics/11/Lucky/DarkGreenLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:24:01', '11', NULL, 1),
(59, 'Karan', 'vender-pics/11/Karan/YellowLogo.png', '9999475171', 1, 1, 1, 1, '2016-12-27 10:24:21', '11', NULL, 1);

--
-- Triggers `sabzi_wala`
--
DROP TRIGGER IF EXISTS `Delete_sabzi_wala_trigger`;
DELIMITER //
CREATE TRIGGER `Delete_sabzi_wala_trigger` AFTER DELETE ON `sabzi_wala`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'MainJson'AND tableName = 'sabzi_wala';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Insert_sabzi_wala_trigger`;
DELIMITER //
CREATE TRIGGER `Insert_sabzi_wala_trigger` AFTER INSERT ON `sabzi_wala`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'MainJson'AND tableName = 'sabzi_wala';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Update_sabzi_wala_trigger`;
DELIMITER //
CREATE TRIGGER `Update_sabzi_wala_trigger` AFTER UPDATE ON `sabzi_wala`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'MainJson'AND tableName = 'sabzi_wala';

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subareas`
--

CREATE TABLE IF NOT EXISTS `subareas` (
  `sno` int(10) NOT NULL AUTO_INCREMENT,
  `place_code` int(10) NOT NULL,
  `subareas` varchar(90) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `subareas`
--

INSERT INTO `subareas` (`sno`, `place_code`, `subareas`) VALUES
(6, 4, 'AP Block'),
(7, 4, 'BP Block'),
(8, 4, 'CP Block'),
(9, 4, 'DP Block'),
(10, 4, 'KP Block'),
(11, 5, 'GP Block'),
(12, 5, 'QP Block'),
(13, 5, 'HP Block'),
(14, 5, 'SP Block'),
(15, 5, 'RP Block'),
(16, 5, 'PP Block'),
(17, 5, 'ZP Block'),
(18, 5, 'TP Block'),
(19, 5, 'FP Block'),
(20, 6, 'JP Block'),
(21, 6, 'VP Block'),
(22, 6, 'LP Block'),
(23, 6, 'MP Block'),
(24, 6, 'NP Block'),
(25, 6, 'WP Block'),
(26, 6, 'UP Block'),
(27, 6, 'YP Block'),
(28, 7, 'AU Block'),
(29, 7, 'BU Block'),
(30, 7, 'CU Block'),
(31, 7, 'DU Block'),
(32, 7, 'EU Block'),
(33, 7, 'GU Block'),
(34, 7, 'HU Block'),
(35, 7, 'JU Block'),
(36, 8, 'UU Block'),
(37, 8, 'SU Block'),
(38, 8, 'RU Block'),
(40, 8, 'TU Block'),
(41, 9, 'PU Block'),
(43, 9, 'KU Block'),
(44, 9, 'QU Block'),
(45, 9, 'NU Block'),
(46, 9, 'MU Block'),
(47, 9, 'FU Block'),
(48, 9, 'LU Block'),
(49, 10, 'AD Block'),
(50, 10, 'BD Block'),
(51, 10, 'CD Block'),
(52, 10, 'GD Block'),
(53, 10, 'ED Block'),
(54, 10, 'FD Block'),
(55, 10, 'HD Block'),
(56, 10, 'JD Block'),
(57, 11, 'ND Block'),
(58, 11, 'MD Block'),
(59, 11, 'PD Block'),
(60, 11, 'SD Block'),
(61, 11, 'LD Block'),
(62, 11, 'KD Block');

--
-- Triggers `subareas`
--
DROP TRIGGER IF EXISTS `Delete_subareas_trigger`;
DELIMITER //
CREATE TRIGGER `Delete_subareas_trigger` AFTER DELETE ON `subareas`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'areaJson';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Insert_subareas_trigger`;
DELIMITER //
CREATE TRIGGER `Insert_subareas_trigger` AFTER INSERT ON `subareas`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'areaJson';

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Update_subareas_trigger`;
DELIMITER //
CREATE TRIGGER `Update_subareas_trigger` AFTER UPDATE ON `subareas`
 FOR EACH ROW begin

           UPDATE  table_timestamp
           SET update_timestamp = now()
           WHERE tableName = 'areaJson';

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subscribtion`
--

CREATE TABLE IF NOT EXISTS `subscribtion` (
  `sno` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(90) NOT NULL,
  `subscribedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sno`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `subscribtion`
--

INSERT INTO `subscribtion` (`sno`, `email`, `subscribedOn`) VALUES
(1, 'nancygupta5994@gmail.com', '2016-06-21 10:55:30'),
(2, 'ronny.rooney10@gmail.com', '2016-06-21 16:36:06'),
(5, 'gagan.mittal29@gmail.com', '2016-08-04 12:53:21'),
(9, 'mayankbatt404@gmail.com', '2016-12-26 08:27:03'),
(10, 'mayankbhatt404@gmail.com', '2016-12-26 12:02:29'),
(12, 'jollyaman.jolly663@gmail.com', '2016-12-27 10:00:57'),
(13, 'saurabhsuman21@gmail.com', '2016-12-27 10:04:22'),
(14, 'divyanshj.16@gmail.com', '2016-12-27 11:33:43'),
(15, '', '2017-01-14 05:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `sub_orders`
--

CREATE TABLE IF NOT EXISTS `sub_orders` (
  `sno` int(25) NOT NULL AUTO_INCREMENT,
  `order_id` int(25) NOT NULL,
  `sabziz` varchar(45) NOT NULL,
  `qty_in_kg` float NOT NULL,
  `price` int(4) NOT NULL,
  `svid` int(10) NOT NULL,
  `confirmation` tinyint(1) NOT NULL DEFAULT '0',
  `delivery_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1222 ;

--
-- Dumping data for table `sub_orders`
--

INSERT INTO `sub_orders` (`sno`, `order_id`, `sabziz`, `qty_in_kg`, `price`, `svid`, `confirmation`, `delivery_status`) VALUES
(1, 1, 'Potato (à¤†à¤²à¥‚)', 2, 50, 2, 0, 1),
(4, 3, 'Potato (à¤†à¤²à¥‚)', 3, 63, 2, 0, 1),
(5, 3, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 25, 2, 0, -1),
(6, 4, 'Potato (à¤†à¤²à¥‚)', 1, 25, 2, 0, -1),
(7, 5, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 50, 10, 0, 1),
(8, 6, 'Potato (à¤†à¤²à¥‚)', 2, 38, 10, 0, 1),
(9, 6, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 13, 10, 0, 1),
(10, 7, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 4, 193, 10, 0, 1),
(11, 8, 'Potato (à¤†à¤²à¥‚)', 1, 25, 10, 0, 0),
(12, 8, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 25, 10, 0, 0),
(13, 8, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 28, 10, 0, -1),
(14, 9, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 25, 10, 0, 0),
(15, 10, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 38, 10, 0, 0),
(16, 11, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 28, 10, 0, 0),
(17, 12, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 38, 10, 0, 0),
(18, 13, 'Potato (à¤†à¤²à¥‚)', 1, 25, 10, 0, 0),
(19, 14, 'Potato (à¤†à¤²à¥‚)', 1, 13, 10, 0, 0),
(20, 15, 'Potato (à¤†à¤²à¥‚)', 2, 38, 10, 0, 0),
(21, 15, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 50, 10, 0, 0),
(22, 15, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 55, 10, 0, 0),
(23, 16, 'Potato (à¤†à¤²à¥‚)', 2, 38, 10, 0, 0),
(24, 17, 'Potato (à¤†à¤²à¥‚)', 1, 25, 10, 0, 0),
(25, 17, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 38, 10, 0, 0),
(26, 18, 'Potato (à¤†à¤²à¥‚)', 1, 25, 10, 0, 0),
(27, 18, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 38, 10, 0, 0),
(28, 22, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 25, 12, 0, 0),
(29, 22, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 38, 12, 0, 0),
(30, 22, 'Potato (à¤†à¤²à¥‚)', 1, 25, 12, 0, 0),
(31, 31, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 13, 12, 0, 0),
(32, 32, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 38, 12, 0, 0),
(33, 32, 'Potato (à¤†à¤²à¥‚)', 1, 25, 12, 0, 0),
(34, 35, 'Potato (à¤†à¤²à¥‚)', 2, 38, 12, 0, 0),
(35, 35, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 13, 12, 0, 0),
(36, 35, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 28, 12, 0, 0),
(37, 36, 'Spinach (à¤ªà¤¾à¤²à¤•)', 2, 60, 9, 0, 0),
(38, 37, 'Potato (à¤†à¤²à¥‚)', 2, 38, 12, 0, 0),
(39, 38, 'Potato (à¤†à¤²à¥‚)', 2, 38, 12, 0, 0),
(40, 39, 'Potato (à¤†à¤²à¥‚)', 2, 50, 12, 0, 0),
(41, 39, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 110, 12, 0, 0),
(42, 39, 'Bottle Gourd (à¤˜à¥€à¤¯à¤¾/ à¤²à¥Œà¤•à¥€)', 2, 60, 12, 0, 0),
(45, 43, 'Potato (à¤†à¤²à¥‚)', 3, 66, 15, 0, 0),
(46, 44, 'Potato (à¤†à¤²à¥‚)', 3, 66, 15, 0, 0),
(47, 45, 'Potato (à¤†à¤²à¥‚)', 1, 11, 17, 0, 0),
(48, 45, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 11, 17, 0, 0),
(49, 45, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 25, 17, 0, 0),
(50, 46, 'Potato (à¤†à¤²à¥‚)', 1, 22, 16, 0, 0),
(51, 47, 'Potato (à¤†à¤²à¥‚)', 3, 55, 17, 0, 0),
(52, 48, 'Potato (à¤†à¤²à¥‚)', 3, 66, 16, 0, 0),
(53, 49, 'Potato (à¤†à¤²à¥‚)', 2, 33, 17, 0, 0),
(54, 50, 'Potato (à¤†à¤²à¥‚)', 1, 30, 20, 0, 0),
(55, 50, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 35, 20, 0, 0),
(56, 50, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 20, 0, 0),
(57, 54, 'Potato', 2, 40, 1, 0, 0),
(58, 55, 'Potato', 2, 60, 1, 0, 0),
(59, 56, 'Potato', 2, 60, 1, 0, 0),
(60, 57, 'Potato', 2, 40, 1, 0, 0),
(61, 58, 'Potato', 2, 40, 1, 0, 0),
(62, 59, '1', 1, 15, 1, 0, 0),
(63, 59, '2', 1, 10, 1, 0, 0),
(64, 59, '18', 1, 23, 1, 0, 0),
(65, 60, '1', 1, 15, 1, 0, 0),
(66, 60, '2', 1, 10, 1, 0, 0),
(67, 60, '18', 1, 23, 1, 0, 0),
(68, 61, '1', 1, 15, 1, 0, 0),
(69, 61, '2', 1, 10, 1, 0, 0),
(70, 61, '18', 1, 23, 1, 0, 0),
(71, 62, '1', 1, 15, 1, 0, 0),
(72, 62, '2', 1, 10, 1, 0, 0),
(73, 62, '18', 1, 23, 1, 0, 0),
(74, 63, '1', 1, 15, 1, 0, 0),
(75, 63, '2', 1, 10, 1, 0, 0),
(76, 63, '18', 1, 23, 1, 0, 0),
(77, 64, 'Potato (à¤†à¤²à¥‚)', 1, 15, 21, 0, 0),
(78, 64, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 35, 21, 0, 0),
(79, 64, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 10, 21, 0, 0),
(80, 64, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€ / à¤¬à¤', 1, 15, 21, 0, 0),
(81, 64, 'Carrot (à¤—à¤¾à¤œà¤°)', 0, 12, 21, 0, 0),
(82, 64, 'Radish (à¤®à¥‚à¤²à¥€)', 1, 10, 21, 0, 0),
(83, 64, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0, 18, 21, 0, 0),
(84, 64, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0, 24, 21, 0, 0),
(85, 64, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 1, 20, 21, 0, 0),
(86, 64, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 1, 20, 21, 0, 0),
(87, 64, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0, 23, 21, 0, 0),
(88, 64, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0, 30, 21, 0, 0),
(89, 64, 'Cucumber (à¤–à¥€à¤°à¤¾)', 1, 30, 21, 0, 0),
(90, 64, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0, 21, 21, 0, 0),
(91, 64, 'Arbi (à¤…à¤°à¤¬à¥€)', 0, 24, 21, 0, 0),
(92, 64, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 35, 21, 0, 0),
(93, 64, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0, 9, 21, 0, 0),
(94, 64, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0, 12, 21, 0, 0),
(95, 64, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 1, 35, 21, 0, 0),
(96, 64, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 1, 30, 21, 0, 0),
(97, 64, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 1, 10, 21, 0, 0),
(98, 64, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 1, 20, 21, 0, 0),
(99, 64, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0, 25, 21, 0, 0),
(100, 64, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0, 30, 17, 0, 0),
(101, 64, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0, 36, 17, 0, 0),
(102, 64, 'Ginger (à¤…à¤¦à¤°à¤•)', 0, 8, 17, 0, 0),
(103, 64, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0, 10, 17, 0, 0),
(104, 64, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0, 8, 17, 0, 0),
(105, 64, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0, 20, 17, 0, 0),
(106, 64, 'Bitter Gourd (à¤•à¤°à¥‡à¤²à¤¾)', 0, 12, 17, 0, 0),
(107, 64, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0, 8, 17, 0, 0),
(108, 64, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0, 6, 17, 0, 0),
(109, 64, 'Methi (à¤®à¥‡à¤¥à¥€)', 0, 14, 17, 0, 0),
(110, 64, 'Turnip (à¤¶à¤²à¤—à¤®)', 1, 50, 17, 0, 0),
(111, 64, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 1, 35, 17, 0, 0),
(112, 65, '1', 1, 15, 1, 0, 0),
(113, 65, '2', 1, 10, 1, 0, 0),
(114, 65, '18', 1, 23, 1, 0, 0),
(115, 66, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 4, 105, 21, 0, 0),
(116, 66, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 2, 96, 21, 0, 0),
(117, 67, 'Potato (à¤†à¤²à¥‚)', 1, 30, 21, 0, 0),
(118, 67, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 70, 21, 0, 0),
(119, 67, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 21, 0, 0),
(120, 68, '1', 4, 120, 1, 0, 0),
(121, 68, '2', 3, 60, 1, 0, 0),
(122, 69, '1', 0, 0, 1, 0, 0),
(123, 69, '2', 0, 0, 1, 0, 0),
(124, 69, '3', 0, 0, 1, 0, 0),
(125, 69, '13', 0, 0, 1, 0, 0),
(126, 69, '29', 0, 8, 1, 0, 0),
(127, 70, '4', 2, 45, 1, 0, 0),
(128, 70, '33', 2, 105, 1, 0, 0),
(129, 71, '4', 2, 45, 1, 0, 0),
(130, 72, '1', 1, 30, 1, 0, 0),
(131, 72, '4', 3, 90, 1, 0, 0),
(132, 72, '15', 1, 70, 1, 0, 0),
(133, 72, '24', 2, 80, 1, 0, 0),
(134, 72, '35', 0, 80, 1, 0, 0),
(135, 73, 'Potato (à¤†à¤²à¥‚)', 2, 45, 21, 0, 0),
(136, 73, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 140, 21, 0, 0),
(137, 73, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 40, 21, 0, 0),
(138, 73, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 2, 120, 21, 0, 0),
(139, 74, '6', 2, 40, 1, 0, 0),
(140, 75, '23', 2, 40, 1, 0, 0),
(141, 76, '23', 2, 40, 1, 0, 0),
(142, 77, '35', 0, 80, 0, 0, 0),
(143, 78, '6', 1, 20, 0, 0, 0),
(144, 78, '31', 0, 32, 0, 0, 0),
(145, 79, '1', 2, 60, 21, 0, 0),
(146, 79, '2', 1, 20, 21, 0, 0),
(147, 79, '3', 1, 35, 21, 0, 0),
(148, 80, '1', 2, 60, 21, 0, 0),
(149, 81, '5', 1, 40, 0, 0, 0),
(150, 81, '15', 1, 53, 0, 0, 0),
(151, 82, '11', 1, 56, 0, 0, 0),
(152, 82, '33', 1, 35, 0, 0, 0),
(153, 82, '34', 1, 100, 0, 0, 0),
(154, 82, '35', 0, 20, 0, 0, 0),
(155, 82, '37', 1, 56, 0, 0, 0),
(156, 83, '11', 2, 131, 0, 0, 0),
(157, 83, '32', 1, 150, 0, 0, 0),
(158, 84, '9', 3, 100, 0, 0, 0),
(159, 85, '12', 0, 25, 0, 0, 0),
(160, 85, '15', 1, 88, 0, 0, 0),
(161, 85, '16', 2, 140, 0, 0, 0),
(162, 85, '28', 12, 1225, 0, 0, 0),
(163, 86, '12', 1, 100, 0, 0, 0),
(164, 87, '34', 2, 200, 0, 0, 0),
(165, 88, '3', 2, 105, 0, 0, 0),
(166, 88, '4', 2, 45, 0, 0, 0),
(167, 88, '18', 2, 53, 0, 0, 0),
(168, 88, '19', 1, 40, 0, 0, 0),
(169, 88, '22', 2, 90, 0, 0, 0),
(170, 88, '24', 1, 40, 0, 0, 0),
(171, 89, '1', 1, 15, 34, 0, 0),
(172, 89, '2', 3, 50, 34, 0, 0),
(173, 89, '3', 2, 105, 34, 0, 0),
(174, 89, '8', 1, 100, 0, 0, 0),
(175, 89, '12', 4, 375, 0, 0, 0),
(176, 89, '13', 2, 120, 0, 0, 0),
(177, 89, '19', 1, 40, 0, 0, 0),
(178, 89, '22', 3, 150, 0, 0, 0),
(179, 89, '23', 1, 10, 0, 0, 0),
(180, 89, '24', 3, 100, 0, 0, 0),
(181, 89, '26', 1, 125, 0, 0, 0),
(182, 89, '31', 2, 192, 0, 0, 0),
(183, 89, '32', 1, 120, 0, 0, 0),
(184, 89, '33', 2, 140, 0, 0, 0),
(185, 90, '1', 3, 90, 21, 0, 0),
(186, 90, '3', 3, 210, 21, 0, 0),
(187, 91, '32', 1, 120, 0, 0, 0),
(188, 91, '37', 0, 32, 0, 0, 0),
(189, 91, '40', 1, 70, 0, 0, 0),
(190, 92, '10', 2, 60, 28, 0, 0),
(191, 92, '32', 1, 120, 28, 0, 0),
(192, 93, '11', 1, 75, 28, 0, 0),
(193, 94, '2', 2, 33, 14, 0, 0),
(194, 94, '15', 1, 53, 0, 0, 0),
(195, 95, '16', 1, 70, 10, 0, 0),
(196, 96, '1', 3, 75, 26, 0, 0),
(197, 96, '2', 3, 60, 26, 0, 0),
(198, 97, '4', 2, 60, 28, 0, 0),
(199, 97, '5', 1, 40, 28, 0, 0),
(200, 98, '9', 1, 0, 0, 0, 0),
(201, 99, '9', 1, 0, 0, 0, 0),
(202, 100, '9', 1, 0, 0, 0, 0),
(203, 101, '9', 1, 0, 0, 0, 0),
(204, 102, '9', 1, 0, 0, 0, 0),
(208, 106, '16', 1, 0, 0, 0, 0),
(211, 108, '2', 2, 0, 15, 0, 0),
(212, 108, '16', 1, 0, 0, 0, 0),
(213, 109, '2', 2, 0, 15, 0, 0),
(214, 109, '16', 1, 0, 0, 0, 0),
(215, 110, '2', 2, 0, 15, 0, 0),
(216, 110, '16', 1, 0, 0, 0, 0),
(217, 110, '33', 1, 0, 0, 0, 0),
(218, 111, '3', 2, 0, 28, 0, 0),
(219, 111, '15', 1, 0, 28, 0, 0),
(220, 112, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 105, 28, 0, 0),
(221, 112, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 1, 53, 28, 0, 0),
(222, 113, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 105, 21, 0, 0),
(223, 113, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 1, 53, 21, 0, 0),
(224, 114, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 105, 26, 0, 0),
(225, 114, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 1, 53, 26, 0, 0),
(226, 115, '2', 2, 0, 15, 0, 0),
(227, 115, '16', 1, 0, 0, 0, 0),
(228, 115, '33', 1, 0, 0, 0, 0),
(229, 116, '22', 1, 0, 0, 0, 0),
(230, 117, '1', 1, 0, 15, 0, 0),
(231, 118, '1', 1, 22, 14, 0, 0),
(232, 118, '2', 1, 22, 14, 0, 0),
(233, 118, '3', 1, 50, 14, 0, 0),
(234, 118, '8', 1, 40, 0, 0, 0),
(235, 118, '18', 1, 15, 10, 0, 0),
(236, 118, '24', 1, 40, 10, 0, 0),
(237, 118, '26', 0, 50, 10, 0, 0),
(238, 118, '28', 1, 50, 0, 0, 0),
(239, 118, '30', 0, 40, 0, 0, 0),
(240, 119, 'Cucumber (à¤–à¥€à¤°à¤¾)', 1, 30, 21, 0, 0),
(241, 120, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 15, 21, 0, 0),
(242, 121, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0, 8, 25, 0, 0),
(243, 122, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0, 8, 24, 0, 0),
(244, 123, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 25, 0, 0),
(245, 123, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 1, 20, 25, 0, 0),
(246, 123, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 1, 50, 25, 0, 0),
(247, 124, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 3, 175, 25, 0, 0),
(248, 124, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 1, 125, 25, 0, 0),
(249, 125, 'Turnip (à¤¶à¤²à¤—à¤®)', 1, 100, 21, 0, 0),
(250, 125, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 2, 70, 27, 0, 0),
(251, 125, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 3, 20, 25, 0, 0),
(252, 126, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0, 20, 27, 0, 0),
(253, 127, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0, 30, 24, 0, 0),
(254, 128, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 1, 20, 21, 0, 0),
(255, 129, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 15, 21, 0, 0),
(256, 129, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 1, 20, 21, 0, 0),
(257, 130, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 35, 24, 0, 0),
(258, 131, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 1, 35, 21, 0, 0),
(259, 132, 'Turnip (à¤¶à¤²à¤—à¤®)', 3, 300, 0, 0, 0),
(260, 133, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 1, 20, 0, 0, 0),
(261, 134, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 1, 75, 21, 0, 0),
(262, 134, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 2, 105, 21, 0, 0),
(263, 135, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 2, 140, 25, 0, 0),
(264, 136, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 1, 20, 0, 0, 0),
(265, 137, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 2, 80, 10, 0, 0),
(266, 138, 'Spinach (à¤ªà¤¾à¤²à¤•)', 3, 75, 26, 0, 0),
(267, 138, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0, 32, 26, 0, 0),
(268, 139, 'Potato (à¤†à¤²à¥‚)', 4, 88, 10, 0, 0),
(269, 139, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 11, 10, 0, 0),
(270, 140, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 3, 175, 27, 0, 0),
(271, 140, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 1, 53, 24, 0, 0),
(272, 141, 'Potato (à¤†à¤²à¥‚)', 1, 15, 24, 0, 0),
(273, 141, 'Cucumber (à¤–à¥€à¤°à¤¾)', 2, 120, 27, 0, 0),
(274, 141, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 1, 50, 27, 0, 0),
(275, 142, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 1, 20, 27, 0, 0),
(276, 142, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 35, 27, 0, 0),
(277, 143, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 1, 20, 27, 0, 0),
(278, 143, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 35, 27, 0, 0),
(279, 144, 'Potato (à¤†à¤²à¥‚)', 1, 15, 24, 0, 0),
(280, 144, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 1, 30, 24, 0, 0),
(281, 144, 'Turnip (à¤¶à¤²à¤—à¤®)', 1, 50, 24, 0, 0),
(282, 145, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 3, 60, 28, 0, 0),
(283, 146, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 3, 60, 28, 0, 0),
(284, 147, 'Potato (à¤†à¤²à¥‚)', 2, 33, 15, 0, 0),
(285, 147, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 3, 55, 15, 0, 0),
(286, 148, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 2, 123, 24, 0, 0),
(287, 149, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 1, 56, 25, 0, 0),
(288, 150, 'Potato (à¤†à¤²à¥‚)', 2, 60, 27, 0, 0),
(289, 151, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0, 20, 21, 0, 0),
(290, 151, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0, 16, 21, 0, 0),
(291, 152, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 33, 14, 0, 0),
(292, 152, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 100, 14, 0, 0),
(293, 153, 'Ginger (à¤…à¤¦à¤°à¤•)', 0, 8, 0, 0, 0),
(294, 153, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0, 10, 0, 0, 0),
(295, 154, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0, 16, 0, 0, 0),
(296, 155, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 2, 45, 0, 0, 0),
(297, 155, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0, 15, 0, 0, 0),
(298, 155, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0, 18, 0, 0, 0),
(299, 156, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 1, 53, 0, 0, 0),
(300, 157, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 2, 40, 10, 0, 0),
(301, 157, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0, 25, 0, 0, 0),
(302, 158, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 1, 50, 0, 0, 0),
(303, 158, 'Ginger (à¤…à¤¦à¤°à¤•)', 0, 8, 0, 0, 0),
(304, 158, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0, 10, 0, 0, 0),
(305, 158, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0, 8, 0, 0, 0),
(306, 159, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0, 20, 0, 0, 0),
(307, 160, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 75, 14, 0, 0),
(308, 161, 'Ginger (à¤…à¤¦à¤°à¤•)', 0, 24, 0, 0, 0),
(309, 162, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 1, 75, 27, 0, 0),
(310, 162, 'Ginger (à¤…à¤¦à¤°à¤•)', 0, 16, 27, 0, 0),
(311, 162, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0, 16, 27, 0, 0),
(312, 162, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 1, 60, 27, 0, 0),
(313, 162, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 1, 35, 27, 0, 0),
(314, 162, 'Turnip (à¤¶à¤²à¤—à¤®)', 1, 50, 27, 0, 0),
(315, 163, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0, 25, 27, 0, 0),
(316, 163, 'Ginger (à¤…à¤¦à¤°à¤•)', 0, 16, 27, 0, 0),
(317, 164, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 2, 45, 24, 0, 0),
(318, 164, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0, 20, 24, 0, 0),
(319, 165, 'Spinach (à¤ªà¤¾à¤²à¤•)', 1, 23, 24, 0, 0),
(320, 165, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 1, 70, 24, 0, 0),
(321, 165, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 1, 30, 24, 0, 0),
(322, 165, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0, 25, 24, 0, 0),
(323, 165, 'Turnip (à¤¶à¤²à¤—à¤®)', 1, 50, 24, 0, 0),
(324, 165, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0, 8, 24, 0, 0),
(325, 165, 'Methi (à¤®à¥‡à¤¥à¥€)', 0, 14, 24, 0, 0),
(326, 165, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0, 6, 24, 0, 0),
(327, 166, 'Carrot (à¤—à¤¾à¤œà¤°)', 1, 20, 24, 0, 0),
(328, 166, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0, 20, 24, 0, 0),
(329, 166, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0, 8, 24, 0, 0),
(330, 167, 'Potato (à¤†à¤²à¥‚)', 1, 30, 25, 0, 0),
(331, 167, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 25, 0, 0),
(332, 167, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 15, 25, 0, 0),
(333, 167, 'Carrot (à¤—à¤¾à¤œà¤°)', 0, 10, 25, 0, 0),
(334, 167, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0, 8, 25, 0, 0),
(335, 167, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 1, 35, 25, 0, 0),
(336, 167, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0, 10, 27, 0, 0),
(337, 167, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0, 8, 27, 0, 0),
(338, 168, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 30, 25, 0, 0),
(339, 168, 'Radish (à¤®à¥‚à¤²à¥€)', 1, 10, 25, 0, 0),
(340, 168, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0, 15, 25, 0, 0),
(341, 168, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0, 8, 27, 0, 0),
(342, 168, 'Methi (à¤®à¥‡à¤¥à¥€)', 0, 14, 27, 0, 0),
(343, 169, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 10, 24, 0, 0),
(344, 169, 'Carrot (à¤—à¤¾à¤œà¤°)', 1, 30, 24, 0, 0),
(345, 169, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 1, 30, 24, 0, 0),
(346, 169, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 2, 90, 24, 0, 0),
(347, 169, 'Turnip (à¤¶à¤²à¤—à¤®)', 2, 150, 24, 0, 0),
(348, 169, 'Bitter Gourd (à¤•à¤°à¥‡à¤²à¤¾)', 1, 20, 24, 0, 0),
(349, 169, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0, 8, 24, 0, 0),
(350, 169, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0, 6, 24, 0, 0),
(351, 170, 'Carrot (à¤—à¤¾à¤œà¤°)', 1, 30, 25, 0, 0),
(352, 171, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 2, 105, 28, 0, 0),
(353, 171, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0, 10, 28, 0, 0),
(354, 171, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 1, 30, 28, 0, 0),
(355, 171, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0, 25, 28, 0, 0),
(356, 171, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0, 30, 28, 0, 0),
(357, 171, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 1, 35, 28, 0, 0),
(358, 172, 'Potato (à¤†à¤²à¥‚)', 1, 30, 27, 0, 0),
(359, 172, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 30, 27, 0, 0),
(360, 172, 'Radish (à¤®à¥‚à¤²à¥€)', 1, 20, 27, 0, 0),
(361, 172, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 1, 40, 27, 0, 0),
(362, 172, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0, 16, 27, 0, 0),
(363, 172, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 1, 60, 27, 0, 0),
(364, 172, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0, 20, 27, 0, 0),
(365, 173, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0, 15, 27, 0, 0),
(366, 173, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0, 25, 27, 0, 0),
(367, 173, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0, 8, 27, 0, 0),
(368, 174, 'Potato (à¤†à¤²à¥‚)', 1, 15, 27, 0, 0),
(369, 174, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 35, 27, 0, 0),
(370, 175, 'Carrot (à¤—à¤¾à¤œà¤°)', 0, 10, 25, 0, 0),
(371, 175, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0, 25, 25, 0, 0),
(372, 175, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0, 10, 25, 0, 0),
(373, 176, 'Methi (à¤®à¥‡à¤¥à¥€)', 0, 14, 28, 0, 0),
(374, 176, 'Arbi (à¤…à¤°à¤¬à¥€)', 0, 20, 28, 0, 0),
(375, 176, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0, 6, 28, 0, 0),
(376, 177, 'Potato (à¤†à¤²à¥‚)', 1, 11, 10, 0, 0),
(377, 177, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 44, 10, 0, 0),
(378, 177, 'Cucumber (à¤–à¥€à¤°à¤¾)', 1, 0, 0, 0, 0),
(379, 177, 'Spinach (à¤ªà¤¾à¤²à¤•)', 1, 15, 10, 0, 0),
(380, 178, 'Potato (à¤†à¤²à¥‚)', 1, 11, 10, 0, 0),
(381, 178, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 44, 10, 0, 0),
(382, 178, 'Cucumber (à¤–à¥€à¤°à¤¾)', 1, 0, 0, 0, 0),
(383, 178, 'Spinach (à¤ªà¤¾à¤²à¤•)', 1, 15, 10, 0, 0),
(384, 178, 'Methi (à¤®à¥‡à¤¥à¥€)', 1, 70, 0, 0, 0),
(385, 179, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 33, 14, 0, 0),
(386, 180, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 33, 14, 0, 0),
(387, 180, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 1, 45, 0, 0, 0),
(388, 180, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 1, 56, 0, 0, 0),
(389, 181, 'Potato (à¤†à¤²à¥‚)', 2, 33, 14, 0, 0),
(390, 181, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 3, 55, 14, 0, 0),
(391, 182, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 75, 14, 0, 0),
(392, 183, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 2, 140, 10, 0, 0),
(393, 183, 'Spinach (à¤ªà¤¾à¤²à¤•)', 1, 30, 10, 0, 0),
(394, 183, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 1, 20, 10, 0, 0),
(395, 184, 'Radish (à¤®à¥‚à¤²à¥€)', 2, 30, 0, 0, 0),
(396, 184, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 2, 60, 0, 0, 0),
(397, 184, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 1, 56, 0, 0, 0),
(398, 185, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 1, 30, 0, 0, 0),
(399, 186, 'Potato (à¤†à¤²à¥‚)', 1, 30, 24, 0, 0),
(400, 186, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 1, 75, 24, 0, 0),
(401, 187, 'Radish (à¤®à¥‚à¤²à¥€)', 2, 30, 25, 0, 0),
(402, 187, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 2, 140, 25, 0, 0),
(403, 188, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 70, 26, 0, 0),
(404, 188, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 1, 60, 26, 0, 0),
(405, 189, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 30, 26, 0, 0),
(406, 189, 'Ginger (à¤…à¤¦à¤°à¤•)', 0, 16, 26, 0, 0),
(407, 190, 'Carrot (à¤—à¤¾à¤œà¤°)', 0, 10, 27, 0, 0),
(408, 190, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0, 10, 27, 0, 0),
(409, 191, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 1, 38, 25, 0, 0),
(410, 192, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 1, 20, 0, 0, 0),
(411, 192, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 1, 20, 0, 0, 0),
(412, 193, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 1, 20, 26, 0, 0),
(413, 193, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.1, 8, 26, 0, 0),
(414, 193, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.5, 60, 26, 0, 0),
(415, 194, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 24, 0, 0),
(416, 194, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.1, 20, 24, 0, 0),
(417, 195, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 21, 0, 0),
(418, 195, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 21, 0, 0),
(419, 195, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.1, 25, 21, 0, 0),
(420, 196, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 1, 70, 24, 0, 0),
(421, 197, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 140, 28, 0, 0),
(422, 198, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 1.25, 50, 0, 0, 0),
(423, 199, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 2, 80, 0, 0, 0),
(424, 200, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 30, 27, 0, 0),
(425, 201, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 30, 21, 0, 0),
(426, 201, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0.5, 35, 21, 0, 0),
(427, 202, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 1.25, 88, 21, 0, 0),
(428, 203, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 0.5, 30, 27, 0, 0),
(429, 203, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 2, 40, 27, 0, 0),
(430, 204, 'Cucumber (à¤–à¥€à¤°à¤¾)', 2, 120, 26, 0, 0),
(431, 205, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 0.5, 10, 28, 0, 0),
(432, 206, 'Turnip (à¤¶à¤²à¤—à¤®)', 1, 100, 25, 0, 0),
(433, 207, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 21, 0, 0),
(434, 207, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.2, 40, 21, 0, 0),
(435, 208, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2.5, 50, 25, 0, 0),
(436, 208, 'Radish (à¤®à¥‚à¤²à¥€)', 1.5, 30, 25, 0, 0),
(437, 209, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.1, 25, 25, 0, 0),
(438, 210, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.1, 25, 24, 0, 0),
(439, 211, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.25, 25, 24, 0, 0),
(440, 212, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 25, 0, 0),
(441, 212, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 25, 0, 0),
(442, 212, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 25, 0, 0),
(443, 212, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 25, 0, 0),
(444, 213, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 26, 0, 0),
(445, 213, 'Cucumber (à¤–à¥€à¤°à¤¾)', 0.5, 30, 26, 0, 0),
(446, 214, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.1, 20, 26, 0, 0),
(447, 215, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.25, 20, 25, 0, 0),
(448, 215, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.1, 20, 25, 0, 0),
(449, 216, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 0.5, 35, 26, 0, 0),
(450, 217, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 21, 0, 0),
(451, 217, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 21, 0, 0),
(452, 218, 'Potato (à¤†à¤²à¥‚)', 4, 120, 27, 0, 0),
(453, 218, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 27, 0, 0),
(454, 219, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.1, 8, 25, 0, 0),
(455, 220, 'Potato (à¤†à¤²à¥‚)', 1.5, 45, 28, 0, 0),
(456, 221, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 28, 0, 0),
(457, 222, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0.1, 8, 25, 0, 0),
(458, 222, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0.1, 6, 25, 0, 0),
(459, 223, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 27, 0, 0),
(460, 223, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 27, 0, 0),
(461, 224, 'Potato (à¤†à¤²à¥‚)', 1.5, 33, 15, 0, 0),
(462, 224, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 1, 75, 0, 0, 0),
(463, 224, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 2.5, 175, 0, 0, 0),
(464, 224, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 1, 40, 0, 0, 0),
(465, 224, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.75, 75, 0, 0, 0),
(466, 225, 'Potato (à¤†à¤²à¥‚)', 1, 30, 24, 0, 0),
(467, 225, 'Radish (à¤®à¥‚à¤²à¥€)', 1, 20, 24, 0, 0),
(468, 226, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 30, 26, 0, 0),
(469, 226, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 2, 80, 26, 0, 0),
(470, 226, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 1.5, 90, 26, 0, 0),
(471, 227, 'Potato (à¤†à¤²à¥‚)', 1, 30, 26, 0, 0),
(472, 228, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1.5, 105, 21, 0, 0),
(473, 228, 'Potato (à¤†à¤²à¥‚)', 1, 30, 21, 0, 0),
(474, 229, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 1, 40, 27, 0, 0),
(475, 230, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.25, 25, 26, 0, 0),
(476, 231, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 28, 0, 0),
(477, 231, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 1.5, 120, 28, 0, 0),
(478, 232, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.5, 30, 26, 0, 0),
(479, 233, 'Potato (à¤†à¤²à¥‚)', 1, 30, 21, 0, 0),
(480, 233, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 21, 0, 0),
(481, 233, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 3.5, 140, 21, 0, 0),
(482, 233, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 1, 40, 21, 0, 0),
(483, 233, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 5.75, 575, 21, 0, 0),
(484, 234, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 2, 140, 24, 0, 0),
(485, 234, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 1, 40, 24, 0, 0),
(486, 234, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.3, 30, 26, 0, 0),
(487, 235, 'Potato (à¤†à¤²à¥‚)', 1.5, 45, 21, 0, 0),
(488, 235, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 21, 0, 0),
(489, 235, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 0.5, 30, 21, 0, 0),
(490, 236, 'Potato (à¤†à¤²à¥‚)', 1, 30, 21, 0, 0),
(491, 236, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.25, 20, 21, 0, 0),
(492, 236, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.25, 25, 21, 0, 0),
(493, 236, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 21, 0, 0),
(494, 236, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.1, 10, 21, 0, 0),
(495, 237, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0.7, 56, 28, 0, 0),
(496, 237, 'Arbi (à¤…à¤°à¤¬à¥€)', 8, 640, 28, 0, 0),
(497, 238, 'Potato (à¤†à¤²à¥‚)', 4, 120, 21, 0, 0),
(498, 238, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2.5, 175, 21, 0, 0),
(499, 238, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1.5, 30, 21, 0, 0),
(500, 239, 'Potato (à¤†à¤²à¥‚)', 2, 60, 21, 0, 0),
(501, 239, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 3.5, 245, 21, 0, 0),
(502, 239, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.2, 40, 21, 0, 0),
(503, 240, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 21, 0, 0),
(504, 240, 'Potato (à¤†à¤²à¥‚)', 1, 30, 21, 0, 0),
(505, 241, 'Potato (à¤†à¤²à¥‚)', 1.5, 45, 21, 0, 0),
(506, 241, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 1.1, 88, 21, 0, 0),
(507, 241, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0.5, 30, 21, 0, 0),
(508, 242, 'Potato (à¤†à¤²à¥‚)', 2.5, 75, 21, 0, 0),
(509, 242, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 21, 0, 0),
(510, 242, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.6, 24, 21, 0, 0),
(511, 243, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 10, 21, 0, 0),
(512, 243, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 35, 21, 0, 0),
(513, 243, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 21, 0, 0),
(514, 244, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 26, 0, 0),
(515, 244, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.5, 30, 26, 0, 0),
(516, 244, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 0.5, 20, 26, 0, 0),
(517, 244, 'Cucumber (à¤–à¥€à¤°à¤¾)', 0.5, 30, 26, 0, 0),
(518, 244, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 26, 0, 0),
(519, 244, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 0.5, 10, 26, 0, 0),
(520, 244, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 1.25, 125, 26, 0, 0),
(521, 245, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.5, 60, 25, 0, 0),
(522, 246, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 1.5, 105, 24, 0, 0),
(523, 247, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.25, 20, 27, 0, 0),
(524, 247, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 0.5, 20, 27, 0, 0),
(525, 248, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0.25, 18, 27, 0, 0),
(526, 248, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.25, 25, 27, 0, 0),
(527, 249, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 27, 0, 0),
(528, 249, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 27, 0, 0),
(529, 250, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 0.5, 20, 24, 0, 0),
(530, 250, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 24, 0, 0),
(531, 251, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 21, 0, 0),
(532, 252, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 70, 26, 0, 0),
(533, 252, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 26, 0, 0),
(534, 253, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 70, 26, 0, 0),
(535, 253, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 26, 0, 0),
(536, 253, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 26, 0, 0),
(537, 253, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 0.5, 20, 26, 0, 0),
(538, 254, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 24, 0, 0),
(539, 255, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.25, 30, 24, 0, -1),
(540, 256, 'Radish (à¤®à¥‚à¤²à¥€)', 2, 40, 0, 0, 0),
(541, 256, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 0, 0, 0),
(542, 257, 'Carrot (à¤—à¤¾à¤œà¤°)', 1, 40, 0, 0, 0),
(543, 257, 'Radish (à¤®à¥‚à¤²à¥€)', 1, 20, 0, 0, 0),
(544, 258, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 2, 140, 0, 1, 1),
(545, 259, 'Cucumber (à¤–à¥€à¤°à¤¾)', 0.5, 30, 25, 1, 1),
(546, 259, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.25, 30, 25, 1, 1),
(547, 260, 'Potato (à¤†à¤²à¥‚)', 1.5, 45, 25, 0, 0),
(548, 261, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.25, 25, 0, 0, 0),
(549, 261, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 0.5, 35, 10, 0, 0),
(550, 262, 'Potato (à¤†à¤²à¥‚)', 1.5, 33, 15, 0, 0),
(551, 262, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.75, 75, 0, 0, 0),
(552, 262, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.5, 50, 0, 0, 0),
(553, 262, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.3, 24, 0, 0, 0),
(554, 263, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.1, 25, 24, 0, 0),
(555, 263, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.1, 10, 24, 0, 0),
(556, 264, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 11, 14, 0, 0),
(557, 265, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 26, 0, 0),
(558, 265, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 26, 0, 0),
(559, 265, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 0.5, 10, 26, 0, 0),
(560, 266, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 2, 140, 0, 0, 0),
(561, 266, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 2.5, 50, 0, 0, 0),
(562, 267, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.1, 8, 21, 0, 0),
(563, 268, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 10, 27, 0, 0),
(564, 269, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 1, 100, 27, 0, 0),
(565, 270, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 1, 100, 27, 0, 0),
(566, 271, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.75, 45, 0, 0, 0),
(567, 272, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 27, 0, 0),
(568, 272, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 27, 0, 0),
(569, 273, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.1, 25, 10, 0, 0),
(570, 274, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.3, 24, 21, 0, 0),
(571, 275, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 2.5, 175, 21, 0, 0),
(572, 276, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 1, 20, 21, 0, 0),
(573, 276, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.2, 16, 21, 0, 0),
(574, 276, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.2, 40, 21, 0, 0),
(575, 277, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 25, 0, 0, 0),
(576, 277, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 3, 90, 0, 0, 0),
(577, 277, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 0.5, 20, 0, 0, 0),
(578, 279, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.25, 30, 0, 0, 0),
(579, 280, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 2.75, 275, 0, 0, 0),
(580, 281, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 2.75, 275, 0, 0, 0),
(581, 281, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.25, 30, 0, 0, 0),
(582, 282, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 25, 0, 0),
(583, 282, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 27, 0, 0),
(584, 283, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.5, 20, 27, 0, 0),
(585, 284, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 35, 21, 0, 0),
(586, 284, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.25, 30, 0, 0, 0),
(587, 285, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 24, 0, 0),
(588, 286, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 24, 0, 0),
(589, 287, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 0, 0, 0),
(590, 288, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 0, 0, 0),
(591, 289, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 0, 0, 0),
(592, 290, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 0, 0, 0),
(593, 291, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.1, 20, 0, 0, 0),
(594, 292, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 0.5, 20, 26, 0, 0),
(595, 293, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0.25, 18, 24, 0, 0),
(596, 294, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 26, 0, 0),
(597, 295, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 26, 0, 0),
(598, 296, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 26, 0, 0),
(599, 297, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 24, 0, 0),
(600, 297, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 26, 0, 0),
(601, 298, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 24, 0, 0),
(602, 299, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 24, 0, 0),
(603, 299, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.1, 10, 0, 0, 0),
(604, 300, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 24, 0, 0),
(605, 300, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.1, 10, 0, 0, 0),
(606, 301, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 10, 21, 0, 0),
(607, 302, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 21, 0, 0),
(608, 302, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 10, 21, 0, 0),
(609, 302, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 35, 21, 0, 0),
(610, 302, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 24, 0, 0),
(611, 302, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0.25, 18, 24, 0, 0),
(612, 302, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 26, 0, 0),
(613, 302, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 0.5, 10, 26, 0, 0),
(614, 302, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.1, 8, 0, 0, 0),
(615, 302, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 0, 0, 0),
(616, 302, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 0.5, 35, 0, 0, 0),
(617, 303, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 21, 0, 0),
(618, 303, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 10, 21, 0, 0),
(619, 303, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 35, 21, 0, 0),
(620, 303, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 24, 0, 0),
(621, 303, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 24, 0, 0),
(622, 303, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 24, 0, 0),
(623, 303, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 24, 0, 0),
(624, 303, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.25, 19, 24, 0, 0),
(625, 303, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 24, 0, 0),
(626, 303, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 0.5, 20, 24, 0, 0),
(627, 303, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 24, 0, 0),
(628, 303, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.25, 25, 24, 0, 0),
(629, 303, 'Cucumber (à¤–à¥€à¤°à¤¾)', 0.5, 30, 24, 0, 0),
(630, 303, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0.25, 18, 24, 0, 0),
(631, 303, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 26, 0, 0),
(632, 303, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 26, 0, 0),
(633, 303, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 26, 0, 0),
(634, 303, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 0.5, 35, 26, 0, 0),
(635, 303, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 0.5, 30, 26, 0, 0),
(636, 303, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 0.5, 10, 26, 0, 0),
(637, 303, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 0.5, 20, 26, 0, 0),
(638, 303, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.1, 25, 26, 0, 0),
(639, 303, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.25, 25, 0, 0, 0),
(640, 303, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.1, 8, 0, 0, 0),
(641, 303, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.1, 10, 0, 0, 0),
(642, 303, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 0, 0, 0),
(643, 303, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 0.5, 35, 0, 0, 0),
(644, 303, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 0, 0, 0),
(645, 303, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.1, 20, 0, 0, 0),
(646, 303, 'Bitter Gourd (à¤•à¤°à¥‡à¤²à¤¾)', 0.25, 10, 0, 0, 0),
(647, 303, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0.1, 8, 0, 0, 0),
(648, 303, 'Methi (à¤®à¥‡à¤¥à¥€)', 0.1, 14, 0, 0, 0),
(649, 303, 'Arbi (à¤…à¤°à¤¬à¥€)', 0.25, 20, 24, 0, 0),
(650, 303, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0.1, 6, 0, 0, 0),
(651, 304, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 21, 0, 0),
(652, 304, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 10, 21, 0, 0),
(653, 304, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 35, 21, 0, 0),
(654, 304, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 24, 0, 0),
(655, 304, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 24, 0, 0),
(656, 304, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 24, 0, 0),
(657, 304, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 24, 0, 0),
(658, 304, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.25, 19, 24, 0, 0),
(659, 304, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 24, 0, 0),
(660, 304, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 0.5, 20, 24, 0, 0),
(661, 304, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 24, 0, 0),
(662, 304, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.25, 25, 24, 0, 0),
(663, 304, 'Cucumber (à¤–à¥€à¤°à¤¾)', 0.5, 30, 24, 0, 0),
(664, 304, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0.25, 18, 24, 0, 0),
(665, 304, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 26, 0, 0),
(666, 304, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 26, 0, 0),
(667, 304, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 26, 0, 0),
(668, 304, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 0.5, 35, 26, 0, 0),
(669, 304, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 0.5, 30, 26, 0, 0),
(670, 304, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 0.5, 10, 26, 0, 0),
(671, 304, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 0.5, 20, 26, 0, 0),
(672, 304, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.1, 25, 26, 0, 0),
(673, 304, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.25, 25, 0, 0, 0),
(674, 304, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.1, 8, 0, 0, 0),
(675, 304, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.1, 10, 0, 0, 0),
(676, 304, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 0, 0, 0),
(677, 304, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 0.5, 35, 0, 0, 0),
(678, 304, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 0, 0, 0),
(679, 304, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.1, 20, 0, 0, 0),
(680, 304, 'Bitter Gourd (à¤•à¤°à¥‡à¤²à¤¾)', 0.25, 10, 0, 0, 0),
(681, 304, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0.1, 8, 0, 0, 0),
(682, 304, 'Methi (à¤®à¥‡à¤¥à¥€)', 0.1, 14, 0, 0, 0),
(683, 304, 'Arbi (à¤…à¤°à¤¬à¥€)', 0.25, 20, 24, 0, 0),
(684, 304, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0.1, 6, 0, 0, 0),
(685, 305, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 21, 0, 0),
(686, 305, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 10, 21, 0, 0),
(687, 305, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 35, 21, 0, 0),
(688, 305, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 24, 0, 0),
(689, 305, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 24, 0, 0),
(690, 305, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 24, 0, 0),
(691, 305, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 24, 0, 0),
(692, 305, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.25, 19, 24, 0, 0),
(693, 305, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 24, 0, 0),
(694, 305, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 0.5, 20, 24, 0, 0),
(695, 305, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 24, 0, 0),
(696, 305, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.25, 25, 24, 0, 0),
(697, 305, 'Cucumber (à¤–à¥€à¤°à¤¾)', 0.5, 30, 24, 0, 0),
(698, 305, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0.25, 18, 24, 0, 0),
(699, 305, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 26, 0, 0),
(700, 305, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 26, 0, 0),
(701, 305, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 26, 0, 0),
(702, 305, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 0.5, 35, 26, 0, 0),
(703, 305, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 0.5, 30, 26, 0, 0),
(704, 305, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 0.5, 10, 26, 0, 0),
(705, 305, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 0.5, 20, 26, 0, 0),
(706, 305, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.1, 25, 26, 0, 0),
(707, 305, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.25, 25, 0, 0, 0),
(708, 305, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.1, 8, 0, 0, 0),
(709, 305, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.1, 10, 0, 0, 0),
(710, 305, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 0, 0, 0);
INSERT INTO `sub_orders` (`sno`, `order_id`, `sabziz`, `qty_in_kg`, `price`, `svid`, `confirmation`, `delivery_status`) VALUES
(711, 305, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 0.5, 35, 0, 0, 0),
(712, 305, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 0, 0, 0),
(713, 305, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.1, 20, 0, 0, 0),
(714, 305, 'Bitter Gourd (à¤•à¤°à¥‡à¤²à¤¾)', 0.25, 10, 0, 0, 0),
(715, 305, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0.1, 8, 0, 0, 0),
(716, 305, 'Methi (à¤®à¥‡à¤¥à¥€)', 0.1, 14, 0, 0, 0),
(717, 305, 'Arbi (à¤…à¤°à¤¬à¥€)', 0.25, 20, 24, 0, 0),
(718, 305, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0.1, 6, 0, 0, 0),
(719, 306, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 24, 0, 0),
(720, 306, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0.25, 18, 24, 0, 0),
(721, 307, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 24, 0, 0),
(722, 308, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 24, 0, 0),
(723, 309, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 24, 0, 0),
(724, 310, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(725, 310, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 0.5, 35, 0, 0, 0),
(726, 310, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 0.5, 20, 0, 0, 0),
(727, 311, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 0, 0, 0),
(728, 311, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 0, 0, 0),
(729, 311, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 0, 0, 0),
(730, 312, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 25, 0, 0, 0),
(731, 312, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 6.5, 390, 0, 0, 0),
(732, 313, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 40, 21, 0, 0),
(733, 313, 'Potato (à¤†à¤²à¥‚)', 1, 30, 21, 0, 0),
(734, 314, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 40, 21, 0, 0),
(735, 314, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 70, 21, 0, 0),
(736, 315, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 9.5, 380, 0, 0, 0),
(737, 315, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 0, 0, 0),
(738, 316, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 0, 0, 0),
(739, 317, 'Potato (à¤†à¤²à¥‚)', 0.5, 11, 0, 0, 0),
(740, 317, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 0, 0, 0),
(741, 317, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 0, 0, 0),
(742, 317, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 0, 0, 0),
(743, 317, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 0, 0, 0),
(744, 318, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 21, 0, 0),
(745, 319, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(746, 320, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 2.5, 50, 0, 0, 0),
(747, 321, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 2.5, 150, 0, 0, 0),
(748, 322, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 2.75, 330, 0, 0, 0),
(749, 323, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.8, 200, 0, 0, 0),
(750, 347, 'Radish (à¤®à¥‚à¤²à¥€)', 1, 20, 0, 0, 0),
(751, 347, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 10.5, 630, 0, 0, 0),
(752, 347, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 3, 120, 0, 0, 0),
(753, 347, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 1.5, 113, 0, 0, 0),
(754, 347, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 4.75, 333, 0, 0, 0),
(755, 347, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 0, 0, 0),
(756, 347, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.75, 30, 0, 0, 0),
(757, 347, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.6, 150, 0, 0, 0),
(758, 347, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 0, 0, 0),
(759, 347, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 2, 140, 0, 0, 0),
(760, 348, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.4, 40, 0, 0, 0),
(761, 350, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 9.5, 665, 0, 0, 0),
(762, 354, 'Potato (à¤†à¤²à¥‚)', 1.5, 45, 0, 0, 0),
(763, 354, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 0.5, 20, 25, 0, 0),
(764, 354, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 27, 0, 0),
(765, 355, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 27, 0, 0),
(766, 355, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 27, 0, 0),
(767, 355, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 27, 0, 0),
(768, 356, 'Ginger (à¤…à¤¦à¤°à¤•)', 1.6, 128, 25, 0, 0),
(769, 357, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 0, 0, 0),
(770, 357, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 35, 0, 0, 0),
(771, 357, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(772, 357, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 0.5, 20, 0, 0, 0),
(773, 358, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 0, 0, 0),
(774, 358, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 35, 0, 0, 0),
(775, 358, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 0.5, 20, 0, 0, 0),
(776, 358, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 0, 0, 0),
(777, 359, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 0, 0, 0),
(778, 360, 'Potato (à¤†à¤²à¥‚)', 0.5, 11, 0, 0, 0),
(779, 360, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 0, 0, 0),
(780, 361, 'Potato (à¤†à¤²à¥‚)', 2, 44, 0, 0, 0),
(781, 361, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1.5, 33, 0, 0, 0),
(782, 361, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 2, 60, 0, 0, 0),
(783, 361, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.25, 25, 0, 0, 0),
(784, 362, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2.5, 55, 0, 0, 0),
(785, 362, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 25, 0, 0, 0),
(786, 362, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.75, 45, 0, 0, 0),
(787, 362, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.25, 25, 0, 0, 0),
(788, 362, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 0, 0, 0),
(789, 363, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 0, 0, 0),
(790, 364, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1.5, 45, 0, 0, 0),
(791, 364, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 1.5, 60, 0, 0, 0),
(792, 364, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 1, 120, 0, 0, 0),
(793, 365, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 25, 15, 0, 0),
(794, 365, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 11, 15, 0, 0),
(795, 365, 'Potato (à¤†à¤²à¥‚)', 0.5, 11, 15, 0, 0),
(796, 366, 'Potato (à¤†à¤²à¥‚)', 0.1, 3, 0, 0, 0),
(797, 366, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.25, 25, 0, 0, 0),
(798, 366, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.5, 40, 0, 0, 0),
(799, 366, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.25, 30, 0, 0, 0),
(800, 367, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 0, 0, 0),
(801, 367, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 4, 280, 0, 0, 0),
(802, 367, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.1, 10, 0, 0, 0),
(803, 367, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 1, 120, 0, 0, 0),
(804, 368, 'Potato (à¤†à¤²à¥‚)', 6.5, 143, 0, 0, 0),
(805, 368, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 6.5, 143, 0, 0, 0),
(806, 368, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 0, 0, 0),
(807, 368, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 2.5, 100, 0, 0, 0),
(808, 368, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 1.5, 105, 0, 0, 0),
(809, 368, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 0.5, 30, 0, 0, 0),
(810, 368, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.1, 25, 0, 0, 0),
(811, 368, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.25, 25, 0, 0, 0),
(812, 368, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 0.5, 35, 0, 0, 0),
(813, 368, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.1, 20, 0, 0, 0),
(814, 369, 'Potato (à¤†à¤²à¥‚)', 0.5, 11, 0, 0, 0),
(815, 369, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.25, 30, 0, 0, 0),
(816, 370, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.3, 30, 0, 0, 0),
(817, 371, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 0, 0, 0),
(818, 371, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 0, 0, 0),
(819, 371, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0.25, 18, 0, 0, 0),
(820, 371, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 0.5, 10, 0, 0, 0),
(821, 371, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.1, 25, 0, 0, 0),
(822, 372, 'Cucumber (à¤–à¥€à¤°à¤¾)', 4.5, 270, 0, 0, 0),
(823, 372, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0.25, 18, 0, 0, 0),
(824, 372, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 10.5, 735, 0, 0, 0),
(825, 373, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.25, 25, 0, 0, 0),
(826, 373, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.5, 50, 0, 0, 0),
(827, 374, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 0.5, 35, 0, 0, 0),
(828, 375, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 21, 0, 0),
(829, 376, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 0, 0, 0),
(830, 377, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.1, 20, 0, 0, 0),
(831, 378, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 0, 0, 0),
(832, 379, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 0, 0, 0),
(833, 379, 'Cucumber (à¤–à¥€à¤°à¤¾)', 0.5, 30, 0, 0, 0),
(834, 379, 'Pumpkin (à¤¸à¥€à¤¤à¤¾à¤«à¤²/ à¤•à¤¦à¥à¤¦à¥‚)', 0.5, 10, 0, 0, 0),
(835, 380, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.25, 19, 0, 0, 0),
(836, 380, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 0.5, 35, 0, 0, 0),
(837, 381, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.75, 0, 0, 0, 0),
(838, 382, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 10, 26, 0, 0),
(839, 382, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 35, 26, 0, 0),
(840, 382, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 26, 0, 0),
(841, 382, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0.1, 6, 26, 0, 0),
(842, 382, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 26, 0, 0),
(843, 388, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.75, 0, 0, 0, 0),
(844, 389, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 40, 21, 0, 0),
(845, 390, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1.5, 105, 44, 0, 0),
(846, 390, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 44, 0, 0),
(847, 396, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 140, 35, 0, 0),
(848, 396, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 40, 35, 0, 0),
(849, 397, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1.5, 30, 55, 0, 0),
(850, 397, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.1, 8, 54, 0, 0),
(851, 397, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.25, 30, 54, 0, 0),
(852, 397, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 40, 0, 0),
(853, 397, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 54, 0, 0),
(854, 397, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 54, 0, 0),
(855, 398, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 54, 0, 0),
(856, 398, 'Methi (à¤®à¥‡à¤¥à¥€)', 0.1, 14, 54, 0, 0),
(857, 398, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.1, 8, 54, 0, 0),
(858, 398, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 40, 0, 0),
(859, 399, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 11, 55, 0, 0),
(860, 399, 'Potato (à¤†à¤²à¥‚)', 0.5, 11, 55, 0, 0),
(861, 399, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 25, 55, 0, 0),
(862, 399, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 54, 0, 0),
(863, 399, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 0.5, 35, 54, 0, 0),
(864, 399, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.2, 40, 54, 0, 0),
(865, 399, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 0.5, 35, 54, 0, 0),
(866, 399, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0.1, 6, 54, 0, 0),
(867, 399, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.25, 25, 54, 0, 0),
(868, 399, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.1, 8, 54, 0, 0),
(869, 399, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.1, 10, 54, 0, 0),
(870, 399, 'Bitter Gourd (à¤•à¤°à¥‡à¤²à¤¾)', 0.25, 10, 54, 0, 0),
(871, 399, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.25, 30, 54, 0, 0),
(872, 399, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 54, 0, 0),
(873, 400, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 35, 0, 0),
(874, 400, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 35, 0, 0),
(875, 400, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 35, 0, 0),
(876, 400, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 35, 0, 0),
(877, 400, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 44, 0, 0),
(878, 400, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 44, 0, 0),
(879, 400, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 35, 43, 0, 0),
(880, 400, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 10, 43, 0, 0),
(881, 400, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.25, 25, 35, 0, 0),
(882, 400, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.25, 30, 35, 0, 0),
(883, 401, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 3, 210, 35, 0, 0),
(884, 402, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 35, 0, 0),
(885, 402, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 35, 0, 0),
(886, 403, 'Spinach (à¤ªà¤¾à¤²à¤•)', 1, 30, 40, 0, 0),
(887, 403, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.25, 25, 40, 0, 0),
(888, 403, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 40, 0, 0),
(889, 404, 'Radish (à¤®à¥‚à¤²à¥€)', 2, 40, 40, 0, 0),
(890, 404, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 1.25, 75, 40, 0, 0),
(891, 404, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 1.5, 120, 40, 0, 0),
(892, 405, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 2, 200, 40, 0, 0),
(893, 406, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 3, 150, 40, 0, 0),
(894, 406, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0.6, 48, 50, 0, 0),
(895, 407, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 4, 120, 40, 0, 0),
(896, 407, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 1, 60, 40, 0, 0),
(897, 407, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 1, 80, 40, 0, 0),
(898, 408, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 1, 60, 35, 0, 0),
(899, 408, 'Radish (à¤®à¥‚à¤²à¥€)', 2.5, 50, 35, 0, 0),
(900, 409, 'Spinach (à¤ªà¤¾à¤²à¤•)', 2.5, 75, 35, 0, 0),
(901, 410, 'Carrot (à¤—à¤¾à¤œà¤°)', 2.75, 110, 35, 0, 0),
(902, 410, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 2.25, 135, 35, 0, 0),
(903, 410, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 4, 120, 35, 0, 0),
(904, 410, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 2, 240, 35, 0, 0),
(905, 410, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.75, 75, 35, 0, 0),
(906, 410, 'Ginger (à¤…à¤¦à¤°à¤•)', 2.2, 176, 35, 0, 0),
(907, 410, 'Spinach (à¤ªà¤¾à¤²à¤•)', 1.5, 45, 35, 0, 0),
(908, 410, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 1.5, 60, 35, 0, 0),
(909, 410, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 2.5, 175, 35, 0, 0),
(910, 411, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 35, 0, 0),
(911, 411, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 35, 0, 0),
(912, 411, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 35, 0, 0),
(913, 412, 'Potato (à¤†à¤²à¥‚)', 1.5, 45, 35, 0, 0),
(914, 412, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1.5, 105, 35, 0, 0),
(915, 413, 'Potato (à¤†à¤²à¥‚)', 1.5, 33, 56, 0, 0),
(916, 413, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1.5, 33, 56, 0, 0),
(917, 413, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 30, 41, 0, 0),
(918, 413, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 2, 140, 35, 0, 0),
(919, 413, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 1, 100, 35, 0, 0),
(920, 414, 'Potato (à¤†à¤²à¥‚)', 2, 60, 35, 0, 0),
(921, 414, 'Radish (à¤®à¥‚à¤²à¥€)', 2, 40, 43, 0, 0),
(922, 414, 'Spinach (à¤ªà¤¾à¤²à¤•)', 1.25, 38, 44, 0, 0),
(923, 414, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 1.25, 150, 44, 0, 0),
(924, 414, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1.5, 30, 35, 0, 0),
(925, 414, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 1, 100, 44, 0, 0),
(926, 414, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 1.25, 50, 44, 0, 0),
(927, 415, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 2.5, 100, 44, 0, 0),
(928, 416, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 2.5, 100, 44, 0, 0),
(929, 417, 'Carrot (à¤—à¤¾à¤œà¤°)', 1.5, 60, 0, 0, 0),
(930, 417, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 2.5, 100, 44, 0, 0),
(931, 417, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 1.9, 380, 0, 0, 0),
(932, 418, 'Carrot (à¤—à¤¾à¤œà¤°)', 1.5, 60, 0, 0, 0),
(933, 418, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 2.5, 100, 44, 0, 0),
(934, 418, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 1.9, 380, 0, 0, 0),
(935, 419, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(936, 419, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 0, 0, 0),
(937, 420, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(938, 420, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 0, 0, 0),
(939, 421, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(940, 421, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 0, 0, 0),
(941, 422, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(942, 422, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 0, 0, 0),
(943, 423, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(944, 423, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 0, 0, 0),
(945, 424, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(946, 424, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 0, 0, 0),
(947, 425, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(948, 425, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 0, 0, 0),
(949, 426, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(950, 426, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 0, 0, 0),
(951, 427, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(952, 427, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 0, 0, 0),
(953, 428, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 0, 0, 0),
(954, 428, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 1, 70, 0, 0, 0),
(955, 429, 'Potato (à¤†à¤²à¥‚)', 1, 30, 0, 0, 0),
(956, 429, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.5, 38, 44, 0, 0),
(957, 429, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 1, 40, 44, 0, 0),
(958, 429, 'Cucumber (à¤–à¥€à¤°à¤¾)', 1, 60, 44, 0, 0),
(959, 429, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.5, 60, 0, 0, 0),
(960, 430, 'Potato (à¤†à¤²à¥‚)', 1, 30, 0, 0, 0),
(961, 430, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.5, 38, 44, 0, 0),
(962, 430, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 1, 40, 44, 0, 0),
(963, 430, 'Cucumber (à¤–à¥€à¤°à¤¾)', 1, 60, 44, 0, 0),
(964, 430, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.5, 60, 0, 0, 0),
(965, 431, 'Potato (à¤†à¤²à¥‚)', 1, 30, 0, 0, 0),
(966, 431, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.5, 38, 44, 0, 0),
(967, 431, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 1, 40, 44, 0, 0),
(968, 431, 'Cucumber (à¤–à¥€à¤°à¤¾)', 1, 60, 44, 0, 0),
(969, 431, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.5, 60, 0, 0, 0),
(970, 432, 'Potato (à¤†à¤²à¥‚)', 1, 30, 0, 0, 0),
(971, 432, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 30, 0, 0, 0),
(972, 432, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.5, 38, 0, 0, 0),
(973, 432, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 1, 40, 0, 0, 0),
(974, 432, 'Cucumber (à¤–à¥€à¤°à¤¾)', 1, 60, 0, 0, 0),
(975, 432, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 1.5, 105, 0, 0, 0),
(976, 432, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.75, 90, 0, 0, 0),
(977, 433, 'Potato (à¤†à¤²à¥‚)', 1, 30, 0, 0, 0),
(978, 433, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 30, 0, 0, 0),
(979, 433, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.5, 38, 0, 0, 0),
(980, 433, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 1, 40, 0, 0, 0),
(981, 433, 'Cucumber (à¤–à¥€à¤°à¤¾)', 1, 60, 0, 0, 0),
(982, 433, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 1.5, 105, 0, 0, 0),
(983, 433, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.75, 90, 0, 0, 0),
(984, 434, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.1, 25, 0, 0, 0),
(985, 435, 'Potato (à¤†à¤²à¥‚)', 0.5, 11, 50, 0, 0),
(986, 436, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 51, 0, 0),
(987, 437, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 51, 0, 0),
(988, 438, 'Potato (à¤†à¤²à¥‚)', 5, 110, 0, 0, 0),
(989, 438, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 3, 150, 0, 0, 0),
(990, 438, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.7, 70, 50, 0, 0),
(991, 438, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 1, 80, 50, 0, 0),
(992, 439, 'Potato (à¤†à¤²à¥‚)', 3, 90, 44, 0, 0),
(993, 439, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 2, 60, 0, 0, 0),
(994, 439, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 2, 200, 0, 0, 0),
(995, 439, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 3, 180, 0, 0, 0),
(996, 439, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 1, 250, 0, 0, 0),
(997, 440, 'Potato (à¤†à¤²à¥‚)', 3, 90, 44, 0, 0),
(998, 440, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 2, 60, 0, 0, 0),
(999, 440, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 2, 200, 0, 0, 0),
(1000, 440, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 3, 180, 0, 0, 0),
(1001, 440, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 1, 250, 0, 0, 0),
(1002, 441, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 30, 44, 0, 0),
(1003, 441, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.5, 50, 44, 0, 0),
(1004, 442, 'Potato (à¤†à¤²à¥‚)', 1.5, 33, 0, 0, 0),
(1005, 442, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 1.5, 105, 0, 0, 0),
(1006, 443, 'Potato (à¤†à¤²à¥‚)', 2, 44, 0, 0, 0),
(1007, 443, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1.5, 75, 0, 0, 0),
(1008, 443, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.5, 50, 0, 0, 0),
(1009, 444, 'Potato (à¤†à¤²à¥‚)', 1.5, 33, 51, 0, 0),
(1010, 445, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.5, 60, 35, 0, 0),
(1011, 445, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 0.5, 35, 35, 0, 0),
(1012, 446, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 70, 35, 0, 0),
(1013, 446, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 35, 0, 0),
(1014, 447, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 11, 51, 0, 0),
(1015, 447, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 0, 0, 0),
(1016, 447, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 0, 0, 0),
(1017, 447, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 0, 0, 0),
(1018, 447, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 0.5, 35, 0, 0, 0),
(1019, 447, 'Methi (à¤®à¥‡à¤¥à¥€)', 0.1, 14, 0, 0, 0),
(1020, 448, 'Potato (à¤†à¤²à¥‚)', 23, 506, 51, 0, 0),
(1021, 449, 'Potato (à¤†à¤²à¥‚)', 23, 506, 51, 0, 0),
(1022, 450, 'Potato (à¤†à¤²à¥‚)', 15.5, 341, 51, 0, 0),
(1023, 451, 'Potato (à¤†à¤²à¥‚)', 23, 506, 51, 0, 0),
(1024, 452, 'Potato (à¤†à¤²à¥‚)', 3, 90, 44, 0, 0),
(1025, 452, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1.5, 45, 0, 0, 0),
(1026, 452, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 2, 200, 0, 0, 0),
(1027, 452, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 3, 180, 0, 0, 0),
(1028, 452, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 1, 250, 0, 0, 0),
(1029, 452, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.5, 40, 0, 0, 0),
(1030, 453, 'Carrot (à¤—à¤¾à¤œà¤°)', 1, 40, 0, 0, 0),
(1031, 453, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.1, 20, 0, 0, 0),
(1032, 454, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.5, 30, 0, 0, 0),
(1033, 455, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.75, 45, 0, 0, 0),
(1034, 455, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 0.5, 35, 0, 0, 0),
(1035, 456, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 48, 0, 0),
(1036, 456, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.75, 45, 48, 0, 0),
(1037, 456, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 1.75, 140, 48, 0, 0),
(1038, 457, 'Carrot (à¤—à¤¾à¤œà¤°)', 1, 40, 0, 0, 0),
(1039, 457, 'Radish (à¤®à¥‚à¤²à¥€)', 4, 80, 0, 0, 0),
(1040, 457, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 2.25, 135, 0, 0, 0),
(1041, 457, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 1.25, 94, 0, 0, 0),
(1042, 457, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 4.5, 315, 0, 0, 0),
(1043, 457, 'Spinach (à¤ªà¤¾à¤²à¤•)', 1.75, 53, 0, 0, 0),
(1044, 457, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 1.25, 50, 0, 0, 0),
(1045, 457, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 2.5, 100, 0, 0, 0),
(1046, 457, 'Turnip (à¤¶à¤²à¤—à¤®)', 3, 300, 0, 0, 0),
(1047, 458, 'Spinach (à¤ªà¤¾à¤²à¤•)', 2.25, 68, 56, 0, 0),
(1048, 459, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 2.25, 158, 48, 0, 0),
(1049, 459, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.8, 64, 0, 0, 0),
(1050, 459, 'Turnip (à¤¶à¤²à¤—à¤®)', 16, 1600, 0, 0, 0),
(1051, 459, 'Methi (à¤®à¥‡à¤¥à¥€)', 2.4, 336, 0, 0, 0),
(1052, 460, 'Potato (à¤†à¤²à¥‚)', 4, 88, 0, 0, 0),
(1053, 460, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2.5, 125, 0, 0, 0),
(1054, 460, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 6, 180, 0, 0, 0),
(1055, 460, 'Spinach (à¤ªà¤¾à¤²à¤•)', 1.75, 53, 0, 0, 0),
(1056, 460, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 1, 250, 0, 0, 0),
(1057, 461, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 44, 36, 0, 0),
(1058, 461, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.75, 23, 47, 0, 0),
(1059, 461, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.5, 40, 46, 0, 0),
(1060, 461, 'Bitter Gourd (à¤•à¤°à¥‡à¤²à¤¾)', 0.75, 30, 46, 0, 0),
(1061, 461, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0.8, 48, 46, 0, 0),
(1062, 462, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1.5, 33, 0, 0, 0),
(1063, 462, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 2, 60, 0, 0, 0),
(1064, 462, 'Capsicum (à¤¶à¤¿à¤®à¤²à¤¾ à¤®à¤¿à¤°à¥à¤š)', 1, 70, 0, 0, 0),
(1065, 463, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 0, 0, 0),
(1066, 463, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 2, 80, 0, 0, 0),
(1067, 464, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 70, 35, 0, 0),
(1068, 464, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 35, 0, 0),
(1069, 464, 'Radish (à¤®à¥‚à¤²à¥€)', 1, 20, 44, 0, 0),
(1070, 465, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 70, 35, 0, 0),
(1071, 465, 'Potato (à¤†à¤²à¥‚)', 1.5, 45, 35, 0, 0),
(1072, 466, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 70, 35, 0, 0),
(1073, 467, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 140, 35, 0, 0),
(1074, 468, 'Potato (à¤†à¤²à¥‚)', 1.5, 45, 35, 0, 0),
(1075, 468, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 35, 0, 0),
(1076, 469, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 35, 0, 0),
(1077, 469, 'Methi (à¤®à¥‡à¤¥à¥€)', 0.1, 14, 35, 0, 0),
(1078, 470, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 0.5, 50, 35, 0, 0),
(1079, 470, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 35, 0, 0),
(1080, 471, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 40, 43, 0, 0),
(1081, 471, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 140, 43, 0, 0),
(1082, 472, 'Potato (à¤†à¤²à¥‚)', 0.5, 11, 50, 0, 0),
(1083, 473, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 4, 200, 51, 0, 0),
(1084, 473, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 4.5, 99, 51, 0, 0),
(1085, 473, 'Potato (à¤†à¤²à¥‚)', 1, 30, 51, 0, 0),
(1086, 473, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.4, 32, 38, 0, 0),
(1087, 474, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 44, 51, 0, 0),
(1088, 475, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 6.5, 325, 51, 0, 0),
(1089, 476, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.75, 45, 0, 0, 0),
(1090, 477, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 44, 36, 0, 0),
(1091, 477, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.75, 23, 47, 0, 0),
(1092, 477, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 3.5, 210, 47, 0, 0),
(1093, 477, 'Ginger (à¤…à¤¦à¤°à¤•)', 0.5, 40, 46, 0, 0),
(1094, 477, 'Bitter Gourd (à¤•à¤°à¥‡à¤²à¤¾)', 0.75, 30, 46, 0, 0),
(1095, 477, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0.8, 48, 46, 0, 0),
(1096, 483, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 2.5, 175, 41, 0, 0),
(1097, 483, 'Carrot (à¤—à¤¾à¤œà¤°)', 1.5, 60, 41, 0, 0),
(1098, 483, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 4.75, 475, 41, 0, 0),
(1099, 483, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 2, 240, 41, 0, 0),
(1100, 484, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 140, 35, 0, 0),
(1101, 485, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 140, 35, 0, 0),
(1102, 486, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 140, 35, 0, 0),
(1103, 487, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 140, 35, 0, 0),
(1104, 488, 'Potato (à¤†à¤²à¥‚)', 1.5, 45, 44, 0, 0),
(1105, 488, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 10, 44, 0, 0),
(1106, 489, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.3, 60, 43, 0, 0),
(1107, 489, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 70, 44, 0, 0),
(1108, 490, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 5, 350, 44, 0, 0),
(1109, 491, 'Potato (à¤†à¤²à¥‚)', 2.5, 55, 47, 0, 0),
(1110, 492, 'Potato (à¤†à¤²à¥‚)', 2.5, 55, 47, 0, 0),
(1111, 493, 'Potato (à¤†à¤²à¥‚)', 4, 88, 47, 0, 0),
(1112, 494, 'Potato (à¤†à¤²à¥‚)', 4, 88, 47, 0, 0),
(1113, 495, 'Potato (à¤†à¤²à¥‚)', 5.5, 121, 47, 0, 0),
(1114, 496, 'Potato (à¤†à¤²à¥‚)', 5.5, 121, 47, 0, 0),
(1115, 497, 'Potato (à¤†à¤²à¥‚)', 5.5, 121, 47, 0, 0),
(1116, 498, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.75, 45, 0, 0, 0),
(1117, 499, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.75, 45, 0, 0, 0),
(1118, 500, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 140, 0, 0, 0),
(1119, 501, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.75, 45, 0, 0, 0),
(1120, 501, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.3, 30, 0, 0, 0),
(1121, 502, 'Potato (à¤†à¤²à¥‚)', 5.5, 165, 0, 0, 0),
(1122, 502, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 0.5, 15, 35, 0, 0),
(1123, 502, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 35, 0, 0),
(1124, 502, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 35, 0, 0),
(1125, 502, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 35, 0, 0),
(1126, 502, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.25, 19, 35, 0, 0),
(1127, 502, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 35, 0, 0),
(1128, 502, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 0.5, 20, 35, 0, 0),
(1129, 503, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 11, 57, 0, 0),
(1130, 503, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 25, 57, 0, 0),
(1131, 503, 'Potato (à¤†à¤²à¥‚)', 0.5, 11, 57, 0, 0),
(1132, 503, 'Arbi (à¤…à¤°à¤¬à¥€)', 0.25, 20, 56, 0, 0),
(1133, 503, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.25, 10, 56, 0, 0),
(1134, 503, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 56, 0, 0),
(1135, 503, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 41, 0, 0),
(1136, 504, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 0, 0, 0),
(1137, 504, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 2, 60, 0, 0, 0),
(1138, 504, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.5, 100, 0, 0, 0),
(1139, 505, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 3, 90, 46, 0, 0),
(1140, 505, 'Radish (à¤®à¥‚à¤²à¥€)', 2, 40, 46, 0, 0),
(1141, 505, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.75, 45, 46, 0, 0),
(1142, 505, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.75, 60, 46, 0, 0),
(1143, 505, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 1.25, 125, 46, 0, 0),
(1144, 506, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 0.5, 10, 0, 0, 0),
(1145, 506, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 3, 210, 0, 0, 0),
(1146, 506, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 1, 30, 0, 0, 0),
(1147, 506, 'Carrot (à¤—à¤¾à¤œà¤°)', 1.25, 50, 0, 0, 0),
(1148, 506, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.5, 30, 0, 0, 0),
(1149, 506, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 1, 40, 0, 0, 0),
(1150, 506, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 0, 0, 0),
(1151, 506, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 1, 60, 0, 0, 0),
(1152, 506, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.5, 50, 44, 0, 0),
(1153, 506, 'Peppermint (à¤ªà¥à¤¦à¥€à¤¨à¤¾)', 0.2, 20, 44, 0, 0),
(1154, 506, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.5, 60, 44, 0, 0),
(1155, 506, 'Turnip (à¤¶à¤²à¤—à¤®)', 1, 100, 44, 0, 0),
(1156, 506, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 0.2, 40, 44, 0, 0),
(1157, 506, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0.2, 16, 44, 0, 0),
(1158, 506, 'Kachi Ambi (à¤•à¤šà¥à¤šà¥€ à¤…à¤®à¥à¤¬à¥€)', 0.2, 12, 44, 0, 0),
(1159, 507, 'Broccoli (à¤¬à¥à¤°à¥‹à¤•à¥à¤•à¥‹à¤²à¥€)', 2.75, 275, 0, 0, 0),
(1160, 507, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 2.8, 224, 0, 0, 0),
(1161, 508, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 4.5, 225, 0, 0, 0),
(1162, 508, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 0.5, 30, 0, 0, 0),
(1163, 508, 'Garlic (à¤²à¤¹à¤¸à¥à¤¨)', 2, 400, 0, 0, 0),
(1164, 509, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1.5, 33, 0, 0, 0),
(1165, 509, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1.5, 75, 0, 0, 0),
(1166, 509, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 1.5, 60, 0, 0, 0),
(1167, 509, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 1, 100, 0, 0, 0),
(1168, 510, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 2, 40, 0, 0, 0),
(1169, 510, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 1, 75, 0, 0, 0),
(1170, 511, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1.5, 105, 44, 0, 0),
(1171, 511, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 1.25, 150, 44, 0, 0),
(1172, 512, 'Cucumber (à¤–à¥€à¤°à¤¾)', 0.5, 25, 0, 0, 0),
(1173, 512, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.25, 30, 0, 0, 0),
(1174, 512, 'Turnip (à¤¶à¤²à¤—à¤®)', 0.5, 50, 0, 0, 0),
(1175, 513, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 0, 0, 0),
(1176, 514, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 1, 70, 0, 0, 0),
(1177, 514, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 2.2, 550, 0, 0, 0),
(1178, 515, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 0, 0, 0),
(1179, 516, 'Coriander Leaves (à¤¹à¤°à¤¾ à¤§à¤¨à¤¿à¤¯à¤¾)', 0.1, 8, 0, 0, 0),
(1180, 524, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 1, 40, 0, 0, 0),
(1181, 525, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.75, 45, 0, 0, 0),
(1182, 525, 'Lemon (à¤¨à¥€à¤‚à¤¬à¥‚)', 0.75, 75, 0, 0, 0),
(1183, 525, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 1, 120, 0, 0, 0),
(1184, 525, 'Turnip (à¤¶à¤²à¤—à¤®)', 1, 100, 0, 0, 0),
(1185, 526, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 1, 120, 46, 0, 0),
(1186, 526, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 1, 70, 46, 0, 0),
(1187, 534, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 0.5, 35, 35, 0, 0),
(1188, 534, 'Onion (à¤ªà¥à¤¯à¤¾à¥›)', 1, 20, 35, 0, 0),
(1189, 534, 'Potato (à¤†à¤²à¥‚)', 0.5, 15, 35, 0, 0),
(1190, 535, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 1.5, 90, 0, 0, 0),
(1191, 535, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 3, 180, 0, 0, 0),
(1192, 535, 'Mushroom (à¤®à¤¶à¤°à¥à¤®)', 0.6, 150, 0, 0, 0),
(1193, 535, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 1.25, 150, 0, 0, 0),
(1194, 536, 'Cabbage (à¤ªà¤¤à¥à¤¤à¤¾ à¤—à¥‹à¤­à¥€)', 2, 60, 36, 0, 0),
(1195, 536, 'Carrot (à¤—à¤¾à¤œà¤°)', 0.5, 20, 36, 0, 0),
(1196, 536, 'Radish (à¤®à¥‚à¤²à¥€)', 0.5, 10, 36, 0, 0),
(1197, 536, 'Peas (à¤¹à¤°à¥€ à¤®à¤Ÿà¤°)', 0.25, 15, 36, 0, 0),
(1198, 536, 'French Beans (à¤«à¥à¤°à¤¾à¤‚à¤¸ à¤¬à¥€à¤¨à¥', 0.25, 20, 36, 0, 0),
(1199, 536, 'Jackfruit (à¤•à¤Ÿà¤¹à¤²)', 0.5, 20, 36, 0, 0),
(1200, 536, 'Ridge Gourd (à¤¤à¥‹à¤°à¥€/ à¤¤à¥à¤°à¤ˆ)', 0.5, 20, 36, 0, 0),
(1201, 536, 'Sweet Corn (à¤¸à¥à¤µà¥€à¤Ÿ à¤•à¥‰à¤°à¥à¤¨)', 0.25, 19, 36, 0, 0),
(1202, 536, 'Cauliflower (à¤«à¥‚à¤² à¤—à¥‹à¤­à¥€)', 0.5, 35, 46, 0, 0),
(1203, 536, 'Spinach (à¤ªà¤¾à¤²à¤•)', 0.25, 8, 46, 0, 0),
(1204, 536, 'Ladyfinger (à¤­à¤¿à¤¨à¥à¤¡à¥€/ à¤“à¤•à¤°à¤¾)', 0.25, 10, 46, 0, 0),
(1205, 536, 'Brinjal (à¤¬à¥ˆà¤‚à¤—à¤¨)', 0.5, 35, 46, 0, 0),
(1206, 536, 'Round Gourd (à¤Ÿà¤¿à¤‚à¤¡à¤¾)', 0.5, 30, 46, 0, 0),
(1207, 536, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 2, 60, 46, 0, 0),
(1208, 537, 'Bottle Gourd (à¤˜à¤¿à¤¯à¤¾ / à¤²à¥Œà¤•à¥€)', 1, 40, 0, 0, 0),
(1209, 537, 'Gooseberry (à¤†à¤à¤µà¤²à¤¾)', 0.5, 60, 0, 0, 0),
(1210, 538, 'Potato (à¤†à¤²à¥‚)', 8, 30, 35, 0, 1),
(1211, 538, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 7, 70, 43, 0, 0),
(1212, 539, 'Turnip (à¤¶à¤²à¤—à¤®)', 6, 100, 100, 0, 0),
(1213, 539, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 6, 70, 100, 0, 0),
(1214, 540, 'Turnip (à¤¶à¤²à¤—à¤®)', 6, 100, 100, 0, 0),
(1215, 540, 'Sweet Potato (à¤¶à¤•à¤°à¤•à¤‚à¤¦)', 6, 70, 100, 0, 0),
(1216, 541, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 50, 35, 0, 0),
(1217, 542, 'Potato (à¤†à¤²à¥‚)', 1, 22, 35, 0, 0),
(1218, 543, 'Bitter Gourd (à¤•à¤°à¥‡à¤²à¤¾)', 1.5, 60, 41, 0, 0),
(1219, 543, 'Chillies (à¤®à¤¿à¤°à¥à¤š)', 0.5, 40, 41, 0, 0),
(1220, 543, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 2, 100, 41, 0, 0),
(1221, 544, 'Tomato (à¤Ÿà¤®à¤¾à¤Ÿà¤°)', 1, 80, 35, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_timestamp`
--

CREATE TABLE IF NOT EXISTS `table_timestamp` (
  `tableName` varchar(45) NOT NULL,
  `update_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_timestamp`
--

INSERT INTO `table_timestamp` (`tableName`, `update_timestamp`) VALUES
('areaJson', '2017-01-02 09:12:22'),
('MainJson', '2017-01-02 09:12:22'),
('vegnmlist', '2017-01-06 09:01:13'),
('sabzi_price', '2017-01-24 06:24:52'),
('sabzi_wala', '2017-01-24 06:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `temp_otp`
--

CREATE TABLE IF NOT EXISTS `temp_otp` (
  `uid` int(255) NOT NULL,
  `otp` varchar(90) NOT NULL,
  `phone_no` decimal(11,0) NOT NULL,
  `time_of_otp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_otp`
--

INSERT INTO `temp_otp` (`uid`, `otp`, `phone_no`, `time_of_otp`) VALUES
(81, '81101', '9716932279', '2016-06-24 06:32:43'),
(1, '72492', '8375930322', '2016-06-28 12:16:52'),
(92, '28833', '8459805917', '2016-06-29 08:11:46'),
(98, '12326', '9810670255', '2016-07-02 12:31:29'),
(110, '85845', '9971693859', '2016-07-25 12:29:07'),
(-1, '45504', '9971693859', '2016-07-26 11:23:23'),
(114, '63574', '9716932279', '2016-07-27 10:07:05'),
(120, '84244', '8802032319', '2016-07-28 15:24:59'),
(121, '67495', '8375930322', '2016-07-28 16:03:07'),
(122, '19359', '9810670255', '2016-07-28 18:40:47'),
(111, '16352', '8802032319', '2016-08-06 01:29:37'),
(158, '20935', '9313001876', '2016-08-06 16:43:23'),
(150, '15509', '9716932279', '2016-08-08 12:13:22'),
(0, '45662', '8375930322', '2016-08-09 10:02:24'),
(62, '60201', '9968967301', '2016-08-10 07:14:04'),
(29, '68136', '9311486146', '2016-08-10 18:33:38'),
(113, '42952', '9968967301', '2016-08-11 07:54:00'),
(85, '28012', '9313001876', '2016-08-21 20:25:06'),
(179, '18238', '8860551313', '2016-08-26 17:17:06'),
(183, '83697', '8802621532', '2016-09-03 02:46:52'),
(187, '74298', '8860993234', '2016-09-20 18:49:45'),
(204, '71155', '8375051132', '2016-10-10 14:41:19'),
(200, '59373', '9818110944', '2016-10-17 20:49:54'),
(182, '43631', '7503729799', '2016-10-25 08:25:31'),
(223, '62849', '8860551313', '2016-11-02 09:26:46'),
(206, '62170', '9818110944', '2016-11-24 15:18:55'),
(229, '87823', '9999475171', '2016-12-01 09:41:01'),
(246, '44807', '9968967301', '2016-12-24 12:34:28'),
(254, '33083', '9540860980', '2016-12-26 08:17:56'),
(186, '32342', '9582191037', '2016-12-31 12:42:29'),
(216, '80070', '9650407655', '2017-01-03 09:20:38'),
(218, '47735', '9810670255', '2017-01-04 15:06:53'),
(281, '36942', '9968967301', '2017-01-08 13:34:54'),
(253, '39085', '9999475171', '2017-01-18 17:34:40'),
(28, '98135', '9968967301', '2017-01-19 10:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `testhindi`
--

CREATE TABLE IF NOT EXISTS `testhindi` (
  `test` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testhindi`
--

INSERT INTO `testhindi` (`test`) VALUES
('गोभी');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot_availability`
--

CREATE TABLE IF NOT EXISTS `timeslot_availability` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `timeslot_id` int(11) NOT NULL,
  `place_code` int(11) NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `timeslot_availability`
--

INSERT INTO `timeslot_availability` (`sno`, `timeslot_id`, `place_code`, `availability`) VALUES
(1, 1, 4, 1),
(2, 2, 4, 1),
(3, 3, 4, 1),
(4, 4, 4, 1),
(5, 5, 4, 1),
(6, 6, 4, 1),
(7, 1, 5, 1),
(8, 2, 5, 1),
(9, 3, 5, 1),
(10, 4, 5, 1),
(11, 5, 5, 1),
(12, 6, 5, 1),
(13, 1, 6, 1),
(14, 2, 6, 1),
(15, 3, 6, 1),
(16, 4, 6, 1),
(17, 5, 6, 1),
(18, 6, 6, 1),
(19, 1, 7, 1),
(20, 2, 7, 1),
(21, 3, 7, 1),
(22, 4, 7, 1),
(23, 5, 7, 1),
(24, 6, 7, 1),
(25, 1, 8, 1),
(26, 2, 8, 1),
(27, 3, 8, 1),
(28, 4, 8, 1),
(29, 5, 8, 1),
(30, 6, 8, 1),
(31, 1, 9, 1),
(32, 2, 9, 1),
(33, 3, 9, 1),
(34, 4, 9, 1),
(35, 5, 9, 1),
(36, 6, 9, 1),
(37, 1, 10, 1),
(38, 2, 10, 1),
(39, 3, 10, 1),
(40, 4, 10, 1),
(41, 5, 10, 1),
(42, 6, 10, 1),
(43, 1, 11, 1),
(44, 2, 11, 1),
(45, 3, 11, 1),
(46, 4, 11, 1),
(47, 5, 11, 1),
(48, 6, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE IF NOT EXISTS `time_slot` (
  `timeslot_id` int(10) NOT NULL AUTO_INCREMENT,
  `timeslot` varchar(90) NOT NULL,
  PRIMARY KEY (`timeslot_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`timeslot_id`, `timeslot`) VALUES
(1, '7AM to 10AM'),
(2, '1PM to 2PM'),
(3, '6PM to 9PM'),
(4, '7AM to 10AM'),
(5, '1PM to 2PM'),
(6, '6PM to 9PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gpluslink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_promocode`
--

CREATE TABLE IF NOT EXISTS `user_promocode` (
  `promo_sno` int(100) NOT NULL,
  `Promo_code` varchar(45) NOT NULL,
  `uid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_reviews`
--

CREATE TABLE IF NOT EXISTS `vendor_reviews` (
  `rsno` int(10) NOT NULL AUTO_INCREMENT,
  `svid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `star_rating` int(1) NOT NULL,
  `review` text,
  PRIMARY KEY (`rsno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crashreport`
--
ALTER TABLE `crashreport`
  ADD CONSTRAINT `FK_UserID` FOREIGN KEY (`userId`) REFERENCES `registered_users` (`uid`);

--
-- Constraints for table `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `FK_places_ID` FOREIGN KEY (`area`) REFERENCES `area_table` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
