-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2019 at 07:17 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apex`
--

-- --------------------------------------------------------

--
-- Table structure for table `advocate`
--

CREATE TABLE IF NOT EXISTS `advocate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advocate_name` varchar(50) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `advocate`
--

INSERT INTO `advocate` (`id`, `advocate_name`, `mobile`, `email`, `address`, `status`, `added_on`, `update_on`) VALUES
(2, 'Advocate1', 1212121212, 'advocate1@advocate1.com', 'advocate1 advocate1', 1, '2019-03-30 07:28:56', '2019-03-30 08:07:25'),
(3, 'advocate2', 123456789, 'advocate2@advocate2.com', 'advocate2\r\nadvocate2', 1, '2019-03-30 07:29:22', '2019-03-30 08:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE IF NOT EXISTS `applicant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_name` varchar(30) NOT NULL,
  `mobile` int(12) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `concern_person` varchar(50) NOT NULL,
  `added_on` date NOT NULL,
  `update_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`id`, `applicant_name`, `mobile`, `email`, `address`, `concern_person`, `added_on`, `update_on`) VALUES
(1, 'Applicant', 1212121212, 'app@s.s', 'applicant', 'applicantasf', '2019-04-10', '2019-04-10'),
(2, 'Applicant2', 1212121212, 'app@app.app', 'asdf', 'ASDFA', '2019-04-10', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`, `status`, `added_on`, `update_on`) VALUES
(2, 'adfs', 1, '2019-03-29 13:16:01', '2019-03-30 08:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_date`
--

CREATE TABLE IF NOT EXISTS `attendance_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dates` date NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `attendance_date`
--

INSERT INTO `attendance_date` (`id`, `dates`, `added_on`, `update_on`) VALUES
(6, '2019-04-08', '2019-04-15 07:19:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_member`
--

CREATE TABLE IF NOT EXISTS `attendance_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `attendance` tinyint(1) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `attendance_member`
--

INSERT INTO `attendance_member` (`id`, `date_id`, `member_id`, `attendance`, `reason`, `added_on`, `update_on`) VALUES
(20, 6, 2, 1, '', '2019-04-15 07:19:25', '2019-04-15 07:19:49'),
(21, 6, 3, 1, '', '2019-04-15 07:19:25', '2019-04-15 07:19:49'),
(22, 6, 5, 1, '', '2019-04-15 07:19:25', '2019-04-15 07:19:49'),
(23, 6, 6, 1, '', '2019-04-15 07:19:25', '2019-04-15 07:19:49'),
(24, 6, 7, 0, 'Out of Town', '2019-04-15 07:19:25', '2019-04-15 07:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `bench`
--

CREATE TABLE IF NOT EXISTS `bench` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bench_name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bench`
--

INSERT INTO `bench` (`id`, `bench_name`, `status`, `added_on`, `update_on`) VALUES
(1, 'HPC-1', 1, '2019-04-02 07:41:29', '2019-04-02 07:53:01'),
(2, 'HPC-2', 1, '2019-04-02 07:52:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE IF NOT EXISTS `cases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_type` varchar(30) NOT NULL,
  `regular_number` varchar(20) NOT NULL,
  `lodging_number` varchar(20) NOT NULL,
  `filling_date` date NOT NULL,
  `department_name` varchar(30) NOT NULL,
  `bench` varchar(20) NOT NULL,
  `complaint_detail` varchar(255) NOT NULL,
  `advocate_name` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `cts_no` varchar(11) NOT NULL,
  `society` varchar(20) NOT NULL,
  `area` varchar(20) NOT NULL,
  `village` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `case_type`, `regular_number`, `lodging_number`, `filling_date`, `department_name`, `bench`, `complaint_detail`, `advocate_name`, `status`, `cts_no`, `society`, `area`, `village`, `description`, `added_on`, `update_on`) VALUES
(5, 'Appeal', '12', '12', '2019-04-15', 'MAHADA', 'HPC-1', 'text', 'Advocate1', 'Close For Order', 'C101', 'Society ', 'adfs', 'v', 'asdf', '2019-04-05 07:15:37', '2019-04-15 12:05:24'),
(6, 'Application', '20', '20', '2019-04-08', 'MAHADA', 'HPC-1', 'text', 'advocate2', 'Dismissed', 'C101', 'Society ', 'adfs', 'v', 'asdf', '2019-04-05 12:26:22', '2019-04-15 12:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `casetype`
--

CREATE TABLE IF NOT EXISTS `casetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_name` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `casetype`
--

INSERT INTO `casetype` (`id`, `case_name`, `status`, `added_on`, `update_on`) VALUES
(1, 'Appeal', 1, '2019-04-01 06:40:40', 127),
(2, 'Application', 1, '2019-04-01 07:05:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `case_applicant_respondent`
--

CREATE TABLE IF NOT EXISTS `case_applicant_respondent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` int(11) NOT NULL,
  `applicant_name` varchar(30) NOT NULL,
  `respondent_name` varchar(30) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `case_applicant_respondent`
--

INSERT INTO `case_applicant_respondent` (`id`, `case_id`, `applicant_name`, `respondent_name`, `added_on`, `update_on`) VALUES
(42, 5, 'Applicant', 'res', '2019-04-05 07:15:38', '2019-04-15 12:05:24'),
(43, 5, 'Applicant2', 'res2', '2019-04-05 07:15:38', '2019-04-15 12:05:24'),
(44, 6, 'Applicant', 'res', '2019-04-05 12:26:22', '2019-04-15 12:05:31'),
(45, 6, 'Applicant2', 'res2', '2019-04-05 12:26:22', '2019-04-15 12:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `case_order`
--

CREATE TABLE IF NOT EXISTS `case_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` int(11) NOT NULL,
  `order_file` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `case_order`
--

INSERT INTO `case_order` (`id`, `case_id`, `order_file`, `status`, `date`, `added_on`, `update_on`) VALUES
(7, 5, 'List_3.pdf', 'Disposed', '2019-04-05', '2019-04-05 10:24:57', '2019-04-10 11:16:54'),
(10, 5, 'List_1.pdf', 'Dismissed', '2019-04-05', '2019-04-05 12:03:04', '2019-04-08 07:29:37'),
(15, 6, 'users.pdf', 'Dismissed', '2019-04-08', '2019-04-08 07:30:10', '2019-04-08 08:18:25'),
(16, 5, '_profile.pdf', 'Disposed', '2019-04-11', '2019-04-12 06:56:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `causelist`
--

CREATE TABLE IF NOT EXISTS `causelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cause_list_pdf` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `causelist`
--

INSERT INTO `causelist` (`id`, `cause_list_pdf`, `date`, `added_on`, `update_on`) VALUES
(1, 'List_3.pdf', '2019-04-03', '2019-04-03 06:51:16', '2019-04-03 08:02:41'),
(3, 'users.pdf', '2019-04-01', '2019-04-03 08:02:58', '2019-04-08 10:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `conjunction`
--

CREATE TABLE IF NOT EXISTS `conjunction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regular_number` int(20) NOT NULL,
  `society_name` varchar(30) NOT NULL,
  `year` int(6) NOT NULL,
  `status` varchar(30) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ctsnumber`
--

CREATE TABLE IF NOT EXISTS `ctsnumber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cts_number` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ctsnumber`
--

INSERT INTO `ctsnumber` (`id`, `cts_number`, `status`, `added_on`, `update_on`) VALUES
(2, 'C101', 1, '2019-03-30 09:41:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(20) NOT NULL,
  `designation_name` varchar(20) NOT NULL,
  `person_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`, `designation_name`, `person_name`, `email`, `mobile`, `status`, `added_on`, `update_on`) VALUES
(6, 'MAHADA', 'Designation 1', 'test', 'test@test.com', 123456789, 1, '2019-03-30 06:42:16', '2019-03-30 07:59:20'),
(7, 'BMC', 'Designation 2', 'BMC', 'bmc@bmc.com', 1212121212, 1, '2019-03-30 06:50:08', '2019-04-10 12:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `designation_name`, `status`, `added_on`, `update_on`) VALUES
(3, 'Designation 1', 1, '2019-03-30 06:41:35', '2019-03-30 08:05:22'),
(4, 'Designation 2', 1, '2019-03-30 06:44:05', '2019-03-30 08:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `directive`
--

CREATE TABLE IF NOT EXISTS `directive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` int(11) NOT NULL,
  `department` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `duration` int(10) NOT NULL,
  `end_date` date NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `directive`
--

INSERT INTO `directive` (`id`, `case_id`, `department`, `start_date`, `duration`, `end_date`, `subject`, `body`, `status`, `added_on`, `update_on`) VALUES
(2, 5, 'MAHADA', '2019-04-09', 6, '2019-04-15', 'subject', 'body', 'Closed For Order', '2019-04-09 08:04:14', '2019-04-10 06:21:19'),
(3, 5, 'MAHADA', '2019-04-10', 10, '2019-04-20', 'Subject for order', 'Body Body Body', 'Pending', '2019-04-10 07:03:57', '2019-04-17 06:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(30) NOT NULL,
  `designation_name` varchar(30) NOT NULL,
  `department_name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_name`, `designation_name`, `department_name`, `status`, `added_on`, `update_on`) VALUES
(2, 'Aakash Bhatt', 'Designation 1', 'MAHADA', 1, '2019-03-30 10:48:42', '2019-04-11 14:20:43'),
(3, 'Radhakishan Jangid', 'Designation 2', 'BMC', 1, '2019-03-30 10:48:57', '2019-04-11 14:20:52'),
(5, 'Dinesh Sir', 'Designation 1', 'MAHADA', 1, '2019-04-11 14:21:00', '0000-00-00 00:00:00'),
(6, 'Siddhant', 'Designation 1', 'BMC', 1, '2019-04-11 14:21:13', '0000-00-00 00:00:00'),
(7, 'Nitin', 'Designation 2', 'BMC', 1, '2019-04-11 14:21:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `minutes`
--

CREATE TABLE IF NOT EXISTS `minutes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` int(11) NOT NULL,
  `minute_file` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `minutes`
--

INSERT INTO `minutes` (`id`, `case_id`, `minute_file`, `status`, `date`, `added_on`, `update_on`) VALUES
(3, 6, 'List_1.pdf', 'Close For Order', '2019-04-08', '2019-04-08 07:42:07', '2019-04-08 07:42:40'),
(6, 5, 'List_1.pdf', 'Close For Order', '2019-04-15', '2019-04-15 07:53:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `respondent`
--

CREATE TABLE IF NOT EXISTS `respondent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `respondent_name` varchar(30) NOT NULL,
  `mobile` int(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `respondent`
--

INSERT INTO `respondent` (`id`, `respondent_name`, `mobile`, `email`, `address`, `added_on`, `update_on`) VALUES
(1, 'res', 132123123, 'asdf@dsf.sdf', 'sdafsf', '2019-04-10 10:28:41', '2019-04-10 10:28:45'),
(2, 'res2', 2147483647, 'res@res.com', 'asfdasdf sdfa', '2019-04-10 11:14:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `society`
--

CREATE TABLE IF NOT EXISTS `society` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `society_name` varchar(30) NOT NULL,
  `secretary_name` varchar(30) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `society`
--

INSERT INTO `society` (`id`, `society_name`, `secretary_name`, `mobile`, `email`, `status`, `added_on`, `update_on`) VALUES
(2, 'Society ', 'Secretary ', 1234567890, 'ss@sdf.sdf', 1, '2019-03-30 11:26:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `status`, `added_on`, `update_on`) VALUES
(1, 'admin', 'admin@admin.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2019-04-15 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `village`
--

CREATE TABLE IF NOT EXISTS `village` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `village_name` varchar(30) NOT NULL,
  `taluka` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `village`
--

INSERT INTO `village` (`id`, `village_name`, `taluka`, `district`, `status`, `added_on`, `update_on`) VALUES
(2, 'v', 't', 'd', 1, '2019-03-30 11:43:27', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
