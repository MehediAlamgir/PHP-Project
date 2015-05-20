-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 04, 2014 at 09:30 PM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `club_db_4`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `assign_volunteer`
-- 

CREATE TABLE `assign_volunteer` (
  `assignment_id` int(11) NOT NULL auto_increment,
  `requester_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY  (`assignment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `assign_volunteer`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `club_event_organize`
-- 

CREATE TABLE `club_event_organize` (
  `club_event_id` int(11) NOT NULL,
  `president_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `status` tinyint(4) default NULL,
  PRIMARY KEY  (`club_event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `club_event_organize`
-- 

INSERT INTO `club_event_organize` VALUES (0, 2, 3, 12, NULL);
INSERT INTO `club_event_organize` VALUES (1, 3, 4, 2, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `club_members`
-- 

CREATE TABLE `club_members` (
  `club_member_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  PRIMARY KEY  (`club_member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `club_members`
-- 

INSERT INTO `club_members` VALUES (1, 13, 1);
INSERT INTO `club_members` VALUES (2, 14, 4);
INSERT INTO `club_members` VALUES (3, 5, 4);
INSERT INTO `club_members` VALUES (4, 7, 4);
INSERT INTO `club_members` VALUES (5, 6, 0);
INSERT INTO `club_members` VALUES (6, 15, 4);

-- --------------------------------------------------------

-- 
-- Table structure for table `clubs`
-- 

CREATE TABLE `clubs` (
  `club_id` int(11) NOT NULL auto_increment,
  `club_name` varchar(255) NOT NULL,
  `club_desc` varchar(500) default NULL,
  `club_president` int(11) default NULL COMMENT 'Here we put the user id who will president of a club',
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`club_id`),
  UNIQUE KEY `club_president` (`club_president`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `clubs`
-- 

INSERT INTO `clubs` VALUES (1, 'AIUB Computer Club', 'Computer programming, contest, organizer etc', 1, 1);
INSERT INTO `clubs` VALUES (3, 'AIUB Shomoy Club', 'Shomoy club desc', 2, 0);
INSERT INTO `clubs` VALUES (4, 'AIUB Drama Club', 'Drama club desc', 3, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `event_members`
-- 

CREATE TABLE `event_members` (
  `event_member_id` int(11) NOT NULL auto_increment,
  `event_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`event_member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `event_members`
-- 

INSERT INTO `event_members` VALUES (1, 2, 5, 0);
INSERT INTO `event_members` VALUES (2, 2, 5, 0);
INSERT INTO `event_members` VALUES (3, 2, 5, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `events`
-- 

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL auto_increment,
  `event_name` varchar(255) NOT NULL,
  `event_desc` varchar(500) NOT NULL,
  `event_date` date default NULL,
  `event_status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `events`
-- 

INSERT INTO `events` VALUES (1, 'Moncho Natok Named Kopila', 'This is a 2 hrs Drama', '0000-00-00', 1);
INSERT INTO `events` VALUES (2, 'Natok Named " Fear of  Final Exam"', 'This is a 3 hrs Drama', '2014-05-05', 1);
INSERT INTO `events` VALUES (3, 'Boishakhi Ullash', 'Boishakh', '0000-00-00', 0);
INSERT INTO `events` VALUES (4, 'Firoz', 'haha', '2014-05-11', 0);
INSERT INTO `events` VALUES (5, 'Firoz', 'haha', '2014-05-20', 0);
INSERT INTO `events` VALUES (6, 'amar event', 'desc herere', '2014-05-21', 1);
INSERT INTO `events` VALUES (7, 'amar event', 'haha', '2014-05-26', 1);
INSERT INTO `events` VALUES (8, 'amar event', 'dfdfdfd', '2014-05-25', 1);
INSERT INTO `events` VALUES (9, 'hello events', 'haha', '2014-05-26', 1);
INSERT INTO `events` VALUES (10, 'amar event', 'haha', '2014-05-26', 0);
INSERT INTO `events` VALUES (11, 'amar eventddd', 'Boishakh', '2014-05-27', 0);
INSERT INTO `events` VALUES (12, 'amar eventddddd', 'dfdffsfs', '2014-05-25', 0);
INSERT INTO `events` VALUES (13, 'aaa', 'bbb', '2014-05-05', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `join_club_for` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'Habibur', 'Rahmans', 'xtcoder@gmail.com', 'demo', 3, 1, 0);
INSERT INTO `users` VALUES (2, 'Rokons', 'Uddins', 'rokon@gmail.com', 'demo', 2, 1, 0);
INSERT INTO `users` VALUES (3, 'Mehedi', 'Misuk', 'mehedi@yahoo.com', 'demo', 2, 1, 0);
INSERT INTO `users` VALUES (4, 'Nasir', 'Uddin', 'nasir@hotmail.com', 'demo', 2, 0, 0);
INSERT INTO `users` VALUES (5, 'Easin', 'jabers', 'easin@yahoo.com', 'demo', 1, 1, 0);
INSERT INTO `users` VALUES (6, 'israr', 'jaber', 'israr@gmail.com', 'demo', 1, 1, 0);
INSERT INTO `users` VALUES (7, 'AA', 'BB', 'aa@aiub.edu', '123456', 3, 1, 0);
INSERT INTO `users` VALUES (8, 'CC', 'DD', 'dd@aiub.edu', '123456', 1, 10, 0);
INSERT INTO `users` VALUES (9, 'EE', 'FF', 'ee@aiub.edu', '123456', 1, 10, 0);
INSERT INTO `users` VALUES (10, 'GG', 'HH', 'gg@aiub.edu', '123456', 1, 10, 0);
INSERT INTO `users` VALUES (11, 'some', 'One', 'some@some.com', 'demo', 1, 10, 0);
INSERT INTO `users` VALUES (12, 'Md', 'Imran', 'imran@gmail.com', 'demo', 1, 0, 3);
INSERT INTO `users` VALUES (13, 'ss', 'dd', 'gfgfg@aiub.edu', 'demo', 1, 0, 1);
INSERT INTO `users` VALUES (14, 'ss', 'dd', 'gfsgfg@aiub.edu', 'demo', 1, 1, 4);
INSERT INTO `users` VALUES (15, 'PP', 'UU', 'pp@aiub.edu', 'demo', 1, 1, 4);

-- --------------------------------------------------------

-- 
-- Table structure for table `volunteer_request`
-- 

CREATE TABLE `volunteer_request` (
  `request_id` int(11) NOT NULL auto_increment,
  `requester` int(11) NOT NULL,
  `request_to` int(11) NOT NULL,
  `number_of_volunteer` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `volunteer_request`
-- 

