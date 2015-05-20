-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 15, 2014 at 09:04 AM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `at`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `airport`
-- 

CREATE TABLE `airport` (
  `country` varchar(100) collate latin1_general_ci NOT NULL,
  `airportname` varchar(500) collate latin1_general_ci NOT NULL,
  `latitude` varchar(500) collate latin1_general_ci NOT NULL,
  `longitude` varchar(500) collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `airport`
-- 

INSERT INTO `airport` VALUES ('Canada', 'Saskatoon International Airport', '52.1708', '106.7000');
INSERT INTO `airport` VALUES ('Japan', 'Narita International Airport', '35.7653', '140.3856');
INSERT INTO `airport` VALUES ('USA', 'Washington Island Airport', '40.0000', '100.0000');
INSERT INTO `airport` VALUES ('England', 'Cambridge Airport', '52.20500183', '0.174999997');
INSERT INTO `airport` VALUES ('Finland', 'Ivalo Airport', '64.0000', '26.0000');
INSERT INTO `airport` VALUES ('Bangladesh', 'Shahjalal International Airport', '23.843070900000000000', '90.405449800000040000');

-- --------------------------------------------------------

-- 
-- Table structure for table `book`
-- 

CREATE TABLE `book` (
  `username` varchar(100) collate latin1_general_ci NOT NULL,
  `name` varchar(30) collate latin1_general_ci NOT NULL,
  `fromm` varchar(100) collate latin1_general_ci NOT NULL,
  `too` varchar(100) collate latin1_general_ci NOT NULL,
  `arrivalairport` varchar(500) collate latin1_general_ci NOT NULL,
  `destinationairport` varchar(500) collate latin1_general_ci NOT NULL,
  `seatid` int(11) NOT NULL auto_increment,
  `no_of_seat` int(30) NOT NULL,
  `class` varchar(30) collate latin1_general_ci NOT NULL,
  `status` varchar(100) collate latin1_general_ci NOT NULL,
  UNIQUE KEY `seatid` (`seatid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `book`
-- 

INSERT INTO `book` VALUES ('mehedi', 'Mehedi', 'Bangladesh', 'USA', 'Shahjalal International Airport', 'Washington Island Airport', 1, 2, 'Normal', 'confirmed');
INSERT INTO `book` VALUES ('rr', 'rr', 'Bangladesh', 'Canada', 'Shahjalal International Airport', 'Saskatoon International Airport', 18, 1, 'Normal', 'confirmed');
INSERT INTO `book` VALUES ('ahbab', 'Ahbab', 'Bangladesh', 'USA', 'Shahjalal International Airport', 'NewYork  Int. Airport', 9, 1, 'Premium', 'confirmed');
INSERT INTO `book` VALUES ('ahnaf', 'Ahnaf Bashir', 'Bangladesh', 'Sweden', 'Shahjalal International Airport', 'Stockhom International Airport', 10, 1, 'Normal', 'confirmed');
INSERT INTO `book` VALUES ('l', 'l', 'Bangladesh', 'USA', 'Shahjalal International Airport', 'Washington Island Airport', 12, 1, 'Normal', 'booked');
INSERT INTO `book` VALUES ('ahbab', 'Ahbab', 'Bangladesh', 'Canada', 'Shahjalal International Airport', 'Saskatoon International Airport', 14, 2, 'Business', 'booked');
INSERT INTO `book` VALUES ('ahbab', 'Ahbab', 'Japan', 'Bangladesh', 'Narita International Airport', 'Shahjalal International Airport', 15, 1, 'Premium', 'confirmed');
INSERT INTO `book` VALUES ('aa', 'aa', 'Bangladesh', 'Canada', 'Shahjalal International Airport', 'Saskatoon International Airport', 16, 1, 'Normal', 'confirmed');
INSERT INTO `book` VALUES ('kk', 'kk', 'Bangladesh', 'Canada', 'Shahjalal International Airport', 'Saskatoon International Airport', 20, 1, 'Business', 'confirmed');

-- --------------------------------------------------------

-- 
-- Table structure for table `flight`
-- 

CREATE TABLE `flight` (
  `id` int(11) NOT NULL auto_increment,
  `flightname` varchar(30) collate latin1_general_ci NOT NULL,
  `flightno` varchar(20) collate latin1_general_ci NOT NULL,
  `totalseat` int(30) NOT NULL,
  `destination` varchar(500) collate latin1_general_ci NOT NULL,
  `source` varchar(500) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `flight`
-- 

INSERT INTO `flight` VALUES (1, 'BD105', '1', 250, 'Canada', 'Bangladesh');
INSERT INTO `flight` VALUES (2, 'BD101', '2', 233, 'England', 'Bangladesh');
INSERT INTO `flight` VALUES (3, 'BD108', '3', 200, 'China', 'Bangladesh');
INSERT INTO `flight` VALUES (9, 'BD112', '6', 200, 'Sweden', 'Bangladesh');

-- --------------------------------------------------------

-- 
-- Table structure for table `route`
-- 

CREATE TABLE `route` (
  `rid` int(11) NOT NULL auto_increment,
  `dairport` varchar(500) collate latin1_general_ci NOT NULL,
  `aairport` varchar(500) collate latin1_general_ci NOT NULL,
  `flightname` varchar(500) collate latin1_general_ci NOT NULL,
  `transitairport` varchar(500) collate latin1_general_ci NOT NULL,
  `transithour` int(20) NOT NULL,
  PRIMARY KEY  (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `route`
-- 

INSERT INTO `route` VALUES (1, 'Washington Island Airport', 'Shahjalal International Airpor', 'BD101', 'Dubai Airport', 5);
INSERT INTO `route` VALUES (2, 'Cambridge Airport', 'Chittagong  Airport', 'BD102', 'Kuwait Airport', 2);
INSERT INTO `route` VALUES (10, 'Washington Island Airport', 'Shahjalal International Airpor', 'BD114', 'Cambridge Airport', 3);
INSERT INTO `route` VALUES (7, 'Norwich International Airport', 'Shahjalal International Airpor', 'BD103', 'Washington Island Airport', 3);
INSERT INTO `route` VALUES (5, 'Washington Island Airport', 'Chittagong Airpor', 'BD105', 'Cambridge Airport', 3);
INSERT INTO `route` VALUES (9, 'Washington Island Airport', 'Shahjalal International Airpor', 'BD111', 'Cambridge Airport', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `schedule`
-- 

CREATE TABLE `schedule` (
  `flightname` varchar(30) collate latin1_general_ci NOT NULL,
  `rid` int(11) NOT NULL auto_increment,
  `dtime` varchar(30) collate latin1_general_ci NOT NULL,
  `atime` varchar(30) collate latin1_general_ci NOT NULL,
  `day` varchar(50) collate latin1_general_ci NOT NULL,
  `seatprice` int(20) NOT NULL,
  `transithour` int(20) NOT NULL,
  `transitairport` varchar(500) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `schedule`
-- 

INSERT INTO `schedule` VALUES ('BD112', 9, '8:30PM', '10.30AM', 'Saturday', 80000, 4, 'Dubai Airport');
INSERT INTO `schedule` VALUES ('BD109', 2, '8:30 PM', '11:20 AM', 'Monday', 150000, 10, 'Belgium Airport');
INSERT INTO `schedule` VALUES ('BD108', 3, '8:30PM', '10:13PM', 'Sunday', 80000, 3, 'Dubai Airport');
INSERT INTO `schedule` VALUES ('BD105', 4, '1:10 AM', '10:13 PM', 'Tuesday', 12000, 5, 'Saskatchewan Airport');
INSERT INTO `schedule` VALUES ('BD103', 5, '8:30PM', '11:20 AM', 'Sunday', 150000, 1, 'Dubai Airport');
INSERT INTO `schedule` VALUES ('BD103', 6, '8:30AM', '10:13 PM', 'Monday', 15000, 5, 'Dubai Airport');
INSERT INTO `schedule` VALUES ('BD108', 7, '8:30PM', '10:13PM', 'Sunday', 15000, 1, 'Dubai Airport');
INSERT INTO `schedule` VALUES ('BD110', 8, '1.30AM', '10.30AM', 'Wednesday', 80000, 3, 'Qatar Airport');
INSERT INTO `schedule` VALUES ('BD103', 10, '1:10 AM', '10:13 PM', 'Monday', 150000, 4, 'Dubai Airport');
INSERT INTO `schedule` VALUES ('BD111', 11, '8:30AM', '10:13PM', 'Sunday', 15000, 4, 'Belgium Airport');

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) collate latin1_general_ci NOT NULL,
  `username` varchar(30) collate latin1_general_ci NOT NULL,
  `password` varchar(30) collate latin1_general_ci NOT NULL,
  `mobile` varchar(20) collate latin1_general_ci NOT NULL,
  `email` varchar(30) collate latin1_general_ci NOT NULL,
  `type` varchar(10) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` VALUES (2, 'Mehedi Alamgir', 'mehedi33', 'mehedi33', '01674555966', 'mehedi33mail@yahoo.com', 'admin');
INSERT INTO `user` VALUES (4, 'Ahbab', 'ahbab', 'ahbab33', '01666666666', 'ahbab@aiub.edu', 'user');
INSERT INTO `user` VALUES (19, 'uu', 'uu', 'uuuuuu', '01677777777', 'uu@aiub.edu', 'user');
INSERT INTO `user` VALUES (18, 'aa', 'aa', 'aaaaaa', '01788888888', 'aa@aiub.edu', 'user');
INSERT INTO `user` VALUES (20, 'zz', 'zz', 'zzzzzz', '01899999999', 'zz@aiub.edu', 'user');
INSERT INTO `user` VALUES (22, 'ee', 'ee', 'eeeeee', '01511111111', 'ee@aiub.edu', 'user');
INSERT INTO `user` VALUES (23, 'rr', 'rr', 'rrrrrr', '01122222222', 'rr@aiub.edu', 'user');
INSERT INTO `user` VALUES (25, 'bb', 'bb', 'bbbbbb', '11111111111', 'bb@aiub.edu', 'user');
INSERT INTO `user` VALUES (26, 'cc', 'cc', 'cccccc', '22222222222', 'cc@aiub.edu', 'user');
