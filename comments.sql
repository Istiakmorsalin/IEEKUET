-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2013 at 09:45 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comments`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(15) NOT NULL,
  `position` int(3) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `page_id`, `user_id`, `date`, `time`, `position`, `content`) VALUES
(12, 20, 4, '01 January 2005', '07:51 AM', 2, 'asdfasdfasdf');

-- --------------------------------------------------------

--
-- Table structure for table `messeges`
--

CREATE TABLE IF NOT EXISTS `messeges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `date` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `content` text NOT NULL,
  `time` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `messeges`
--

INSERT INTO `messeges` (`id`, `sender_id`, `reciever_id`, `date`, `position`, `status`, `content`, `time`) VALUES
(24, 0, 5, '01 January 2005', 1, 1, '"bashpoka" has commented on "History" page.', '07:51 AM');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `date` varchar(20) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `subject_id`, `menu_name`, `position`, `date`, `visible`, `content`) VALUES
(20, 4, 'History', 1, '01 January 2005', 1, 'This is the page which will tell about the history of Sgipc...'),
(21, 4, 'Our mission ', 2, '01 January 2005', 1, 'Our mission is to make people familiar with programming......'),
(22, 4, 'Our success', 3, '01 January 2005', 1, 'About our success................'),
(23, 5, 'About Group contest', 1, '01 January 2005', 0, 'Notices about group contests...... '),
(24, 5, 'others', 2, '01 January 2005', 0, 'Notices on other things.... '),
(25, 6, 'Class on Concrete math', 1, '01 January 2005', 1, 'News on concrete math class....');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `menu_name`, `position`, `visible`) VALUES
(4, 'About SGIPC', 1, 1),
(5, 'Notices', 2, 1),
(6, 'Extra classes', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `date` int(3) NOT NULL,
  `month` varchar(5) NOT NULL,
  `year` int(5) NOT NULL,
  `c_address` varchar(100) NOT NULL,
  `c_city` varchar(20) NOT NULL,
  `c_pc` varchar(10) NOT NULL,
  `c_pn` varchar(20) NOT NULL,
  `c_mn` varchar(20) NOT NULL,
  `p_address` varchar(100) NOT NULL,
  `p_city` varchar(20) NOT NULL,
  `p_pc` varchar(10) NOT NULL,
  `p_pn` varchar(20) NOT NULL,
  `p_mn` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `job` varchar(10) NOT NULL,
  `interest` varchar(11) NOT NULL,
  `known` varchar(50) NOT NULL,
  `about` text NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `hashed_password` varchar(40) NOT NULL,
  `admin_value` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `country`, `sex`, `date`, `month`, `year`, `c_address`, `c_city`, `c_pc`, `c_pn`, `c_mn`, `p_address`, `p_city`, `p_pc`, `p_pn`, `p_mn`, `email`, `job`, `interest`, `known`, `about`, `user_name`, `hashed_password`, `admin_value`) VALUES
(4, 'MD. Gul Jamal', 'Zim', 'Bangladesh', 'Male', 30, 'Aug', 1991, 'Kuet, Khulna', 'Khulna', '', '', '01674801920', 'Dhaka , Bangladesh', 'Dhaka', '1205', '', '', 'bashpoka@hotmail.com', 'Student', 'Develop', 'c, c++, php, html, css.', 'Nothing important to say about me,\r\nsorry guys...', 'bashpoka', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
(5, 'Abdul Shukkur', 'Shaku', 'Bangladesh', 'Male', 10, 'Mar', 1972, 'Dhaka, Bangladesh', 'Dhaka', '', '', '1553778462', 'Khulna, Bangladesh', 'Khulna', '', '', '', 'shukkur@gmail.com', 'Student', 'Develop', 'c, c++, php, java etc..', 'Nothing', 'shukkur', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0),
(6, 'Parvin', 'Akter', 'Bangladesh', 'Female', 5, 'Aug', 1987, 'Dhaka, Bangladesh', 'Dhaka', '', '', '1553778462', 'Chittagong.', 'Chittagong', '', '', '', 'p_akter@gmail.com', 'Developer', 'Develop', 'c, c++, php, java etc..', '', 'pakter', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
