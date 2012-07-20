-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2012 at 07:16 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bala0069`
--

-- --------------------------------------------------------

--
-- Table structure for table `off_location`
--

CREATE TABLE IF NOT EXISTS `off_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `off_location`
--

INSERT INTO `off_location` (`id`, `name`, `description`) VALUES
(1, 'National Gallery of Canada', 'National Gallery of Canada 380 Sussex Drive P.O. Box 427, Station A Ottawa, Ontario K1N 9N4 Canada  General Inquiries Tel: 613-990-1985 Toll free: 1-800-319-ARTS (2787) Fax: 613-993-4385 TDD: 613-990-0777 Email: info@gallery.ca '),
(2, 'The Ottawa Art Gallery', 'The Ottawa Art Gallery Arts Court, 2 Daly Avenue, Ottawa, Ontario K1N 6E2 Canada 613-233-8699 fax 613-569-7660 info@ottawaartgallery.ca');
