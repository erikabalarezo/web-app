-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 09, 2012 at 07:30 PM
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
-- Table structure for table `off_event`
--

CREATE TABLE IF NOT EXISTS `off_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `category` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `location_id` int(50) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `rate_count` int(11) NOT NULL,
  `rate_total` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `off_event`
--

INSERT INTO `off_event` (`id`, `start_date`, `end_date`, `category`, `location_id`, `name`, `description`, `rating`, `rate_count`, `rate_total`, `paid`) VALUES
(1, '2012-05-25', '2012-09-03', 'Galleries', 0, 'Van Gogh Up Close', 'Featuring more than 40 of the famous artist’s works, some of them rarely seen in public. This exhibition presents Van Gogh’s close up view of nature.  This is an exclusive canadian showing expected to be highly popular.', 1, 2, 3, 0),
(2, '2012-06-22', '2012-09-09', 'Galleries', 1, 'Christos Pantieras - Your Word is Bond', 'Your Word Is Bond explores the notion of giving your word to someone, of what it means to speak tender or fervent “truths” that are sincerely meant at one time but not for all time. The exhibition considers as well the nature of memory, correspondence and other talismans of the past. Composed of four inter-related works by Ottawa-based artist Christos Pantieras, each piece stands as a chronicle of a separate relationship, linked together via correspondence that lays it bare, from initial flirtations to parting words. ', 1, 2, 7, 0),
(3, '2012-06-22', '2012-08-19', 'Galleries', 1, 'Adad Hannah - Visitors', 'Visitors demonstrates Hannah’s interest in activating a historical work, as well as depicting subjects and situations encountered by chance. Whether we are being transported to Calais in the installation, or stumble upon the couple’s sweet embrace, the viewer becomes a visitor to both sites. Each work, like a memento mori, is a reminder of our imminent death, whether physical, induced by sleep or controlled by the camera’s lens.', 1, 1, 5, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `off_event`
--
ALTER TABLE `off_event`
  ADD CONSTRAINT `off_event_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `off_location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
