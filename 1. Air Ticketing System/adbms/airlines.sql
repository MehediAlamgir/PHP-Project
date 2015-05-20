-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2013 at 12:56 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airlines`
--
CREATE DATABASE IF NOT EXISTS `airlines` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `airlines`;

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE IF NOT EXISTS `airport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`id`, `name`, `latitude`, `longitude`) VALUES
(1, 'Washington Island Airport\r\n', '47.3917', '-121.5708'),
(2, 'Cambridge Airport', '38.5393981934', '-76.0278015137'),
(3, 'Norwich International Airport\r\n', '52.67580032', '1.282780051'),
(4, 'Shahjalal International Airport\r\n', '23.843070900000000000', '90.405449800000040000'),
(5, 'Dubai International Airport\r\n', '25.2527999878', '55.3643989563');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_flight_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `booking_date_time` date NOT NULL,
  `flight_date` date NOT NULL,
  `flight_day` varchar(20) NOT NULL,
  `economy_class` int(11) NOT NULL,
  `executive_class` int(11) NOT NULL,
  `first_class` int(11) NOT NULL,
  `cancel_status` tinyint(4) NOT NULL,
  `total_discount` double NOT NULL,
  `total_bill` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `fk_flight_id`, `fk_user_id`, `booking_date_time`, `flight_date`, `flight_day`, `economy_class`, `executive_class`, `first_class`, `cancel_status`, `total_discount`, `total_bill`) VALUES
(2, 6, 13, '2013-11-26', '2013-12-01', '7', 0, 5, 0, 0, 0, 5563.5135135135);

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE IF NOT EXISTS `flight` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_schedule_id` int(11) NOT NULL,
  `isActive` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`id`, `fk_schedule_id`, `isActive`) VALUES
(1, 6, 'YES'),
(2, 7, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `phone`, `gender`, `password`, `type`) VALUES
(13, 'demo', 'demo@yahoo.com', '01674420006', 'Male', 'ddddd%', 'GOLDEN_USER'),
(14, 'nazim', 'nazim@y.com', '01674420007', 'Male', 'ddddd%', 'NORMAL_USER'),
(15, 'root', 'root', '00000000000', 'Male', 'root', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `plane`
--

CREATE TABLE IF NOT EXISTS `plane` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `economy_class` int(11) NOT NULL,
  `executive_class` int(11) NOT NULL,
  `first_class` int(11) NOT NULL,
  `active_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `plane`
--

INSERT INTO `plane` (`id`, `name`, `economy_class`, `executive_class`, `first_class`, `active_status`) VALUES
(1, 'Biman Bangladesh Airlines', 70, 50, 30, 1),
(17, 'Biman Bangladesh Airlines', 50, 20, 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE IF NOT EXISTS `route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_airport_id` int(11) NOT NULL,
  `fk_via_airport_id_1` int(11) NOT NULL,
  `fk_via_airport_id_2` int(11) NOT NULL,
  `fk_via_airport_id_3` int(11) NOT NULL,
  `fk_destination_airport_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`id`, `fk_airport_id`, `fk_via_airport_id_1`, `fk_via_airport_id_2`, `fk_via_airport_id_3`, `fk_destination_airport_id`) VALUES
(2, 4, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `on_sunday` tinyint(4) NOT NULL,
  `on_monday` tinyint(4) NOT NULL,
  `on_tuesday` tinyint(4) NOT NULL,
  `on_wednesday` tinyint(4) NOT NULL,
  `on_thursday` tinyint(4) NOT NULL,
  `on_friday` tinyint(4) NOT NULL,
  `on_saturday` tinyint(4) NOT NULL,
  `fk_plane_id` int(11) NOT NULL,
  `fk_route_id` int(11) NOT NULL,
  `airfare` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `departure_time`, `arrival_time`, `on_sunday`, `on_monday`, `on_tuesday`, `on_wednesday`, `on_thursday`, `on_friday`, `on_saturday`, `fk_plane_id`, `fk_route_id`, `airfare`) VALUES
(6, '14:58:00', '13:59:00', 1, 1, 0, 1, 0, 0, 0, 1, 2, 555),
(7, '01:59:00', '12:00:00', 0, 1, 1, 1, 1, 0, 1, 17, 2, 777);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
