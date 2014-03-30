-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2014 at 02:25 PM
-- Server version: 5.5.36-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lab360_gcsa-mobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `gcsa_users`
--

DROP TABLE IF EXISTS `gcsa_users`;
CREATE TABLE `gcsa_users` (
  `id` mediumint(12) unsigned NOT NULL AUTO_INCREMENT,
  `facebook_user_id` int(10) unsigned DEFAULT NULL,
  `facebook_access_token` text,
  `greenville_student_id` int(10) unsigned DEFAULT NULL,
  `greenville_facstaff_first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `greenville_facstaff_last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `activation_code` mediumint(10) unsigned DEFAULT NULL,
  `is_activated` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `facebook_user_id` (`facebook_user_id`,`greenville_student_id`,`activation_code`,`is_activated`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Truncate table before insert `gcsa_users`
--

TRUNCATE TABLE `gcsa_users`;
--
-- Dumping data for table `gcsa_users`
--

INSERT INTO `gcsa_users` (`id`, `facebook_user_id`, `facebook_access_token`, `greenville_student_id`, `greenville_facstaff_first_name`, `greenville_facstaff_last_name`, `activation_code`, `is_activated`, `user_type`) VALUES
(3, 1247228946, NULL, 201202055, '', '', 1954, 1, 1),
(8, 159854, 'fhfhsfhsfhajksfsfukhasjfy2y2895y2798', 20130904, '', '', 4965, 0, 1),
(9, 1958578373, 'fji518dhifdhjk15879513hkdjanlkfsjks', NULL, 'Becky', 'Kerle', 9375, 0, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
