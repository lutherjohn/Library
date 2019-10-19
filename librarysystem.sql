-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2015 at 12:31 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `librarysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permission`) VALUES
(1, 'Administrator', ''),
(2, 'Librarian', ''),
(3, 'Cashier', ''),
(4, 'Student', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE IF NOT EXISTS `tbl_books` (
  `book_id` int(11) NOT NULL,
  `book_isbn` varchar(45) NOT NULL,
  `book_title` varchar(45) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_edition` varchar(45) NOT NULL,
  `book_copies` varchar(15) NOT NULL,
  `book_status` varchar(45) NOT NULL,
  `book_price` varchar(45) NOT NULL,
  `book_call_number` varchar(45) NOT NULL,
  `bc_id` int(1) NOT NULL,
  `bp_id` int(1) NOT NULL,
  `book_date_added` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`book_id`, `book_isbn`, `book_title`, `book_author`, `book_edition`, `book_copies`, `book_status`, `book_price`, `book_call_number`, `bc_id`, `bp_id`, `book_date_added`) VALUES
(1, '1234-001', 'Harry', 'J.K', '2nd', '9', 'Available', '557', '0023695', 1, 1, '2015-09-04'),
(2, '1234-002', 'Eden & Eve', 'Romeo ', '1st', '8', 'Available', '229', '009088', 4, 1, '2015-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_borrow`
--

CREATE TABLE IF NOT EXISTS `tbl_book_borrow` (
  `bb_id` int(11) NOT NULL,
  `issue_date` varchar(25) NOT NULL,
  `due_date` varchar(25) NOT NULL,
  `student` int(1) NOT NULL,
  `book` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_category`
--

CREATE TABLE IF NOT EXISTS `tbl_book_category` (
  `bc_id` int(11) NOT NULL,
  `book_category` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_book_category`
--

INSERT INTO `tbl_book_category` (`bc_id`, `book_category`) VALUES
(1, '000-009 - Generalities'),
(2, '100-199 - Philosophy & Psychology'),
(3, '200-299 - Religion'),
(4, '300-399 - Social Science'),
(5, '400-499 - Languages');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_publisher`
--

CREATE TABLE IF NOT EXISTS `tbl_book_publisher` (
  `bp_id` int(11) NOT NULL,
  `book_publisher` varchar(255) NOT NULL,
  `book_date_publication` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_book_publisher`
--

INSERT INTO `tbl_book_publisher` (`bp_id`, `book_publisher`, `book_date_publication`) VALUES
(1, 'Pica Fresh', '2015-08-06'),
(2, 'Esons & Jsons', '2015-08-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_reserved`
--

CREATE TABLE IF NOT EXISTS `tbl_book_reserved` (
  `br_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_reserved` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_unreturn`
--

CREATE TABLE IF NOT EXISTS `tbl_book_unreturn` (
  `bu_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_unreturn` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personnel`
--

CREATE TABLE IF NOT EXISTS `tbl_personnel` (
  `p_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `middlename` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(22) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `marital_status` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_personnel`
--

INSERT INTO `tbl_personnel` (`p_id`, `username`, `lastname`, `firstname`, `middlename`, `address`, `contact_number`, `gender`, `marital_status`) VALUES
(1, 'Admin', 'Pitok', 'Batolata', 'Candid', 'Barra', '09363351331', 'Male', 'Single'),
(2, 'User2', 'Santiago', 'Miriam', 'Defensor', 'Bulua', '09365789632', 'Female', 'Married'),
(3, 'Cashier', 'Mendoza', 'John', 'Randolph', 'Bulua', '09896325647', 'Female', 'Married');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE IF NOT EXISTS `tbl_student` (
  `s_id` int(11) NOT NULL,
  `s_username` varchar(20) NOT NULL,
  `s_lastname` varchar(64) NOT NULL,
  `s_firstname` varchar(64) NOT NULL,
  `s_middlename` varchar(64) NOT NULL,
  `s_gradeLevelSection` varchar(15) NOT NULL,
  `s_email` varchar(25) NOT NULL,
  `s_cp` varchar(15) NOT NULL,
  `s_gender` varchar(25) NOT NULL,
  `s_month` varchar(20) NOT NULL,
  `s_day` varchar(20) NOT NULL,
  `s_year` varchar(20) NOT NULL,
  `s_address` text NOT NULL,
  `s_parent` varchar(255) NOT NULL,
  `s_parentRelation` varchar(25) NOT NULL,
  `s_parentCp` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`s_id`, `s_username`, `s_lastname`, `s_firstname`, `s_middlename`, `s_gradeLevelSection`, `s_email`, `s_cp`, `s_gender`, `s_month`, `s_day`, `s_year`, `s_address`, `s_parent`, `s_parentRelation`, `s_parentCp`) VALUES
(1, 'student103', 'Najer', 'Madid', 'Test', 'Grade 8 -  Live', 'najer@yahoo.com', '09356987410', 'Male', '6', '14', '2003', 'Opol', 'Rolando Mosque', 'Father', '09365789632'),
(3, 'student101', 'Batolata', 'Pitok', 'Tumba', 'Grade 8 -  Live', 'gwapoko@yahoo.com', '09369874563', 'Male', '9', '15', '2003', 'Barra', 'Rolando Mosque', 'Father', '09365789632'),
(4, 'student105', 'Gabitano', 'Joan', 'Mabalos', 'Grade 8 -  Live', 'Joangabitano23@yahoo.com.', '09369874563', 'Female', '4', '11', '1999', 'Barra', 'Rolando Mosque', 'Father', '09365789632');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `joined` date NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `joined`, `group`) VALUES
(1, 'Admin', '939c3fc4baca98ba48de3c03b45c942086115458f71abe58d64f8dc2e584ae81', 'Ž£d1Ä<Ä¥`ÎšD¢~-JÌKñ™@5jÜÑ[*²«', '2015-07-15', 1),
(2, 'User2', '68443becf15c3e92ab29267bbe3b7e6339928ce3f712260579f7955fc5ca91ba', 'SpUÄ.¿	i`˜«›¦Uò-åµ=K¸ªÝ`rxk¶', '2015-09-06', 2),
(3, 'student101', '9fbf11ee9f3bd116de222bbfa0fd3a8181432f9667ea75dade5d4aa6c922894a', 'HØ=@	»g´3ªÆGbà×/×==~­ëªcÎa6]^', '2015-09-06', 4),
(4, 'Cashier', 'a26edd7e1e33e37baf4e06608fc83542d1dcb6b080cde5b2fa05b81f2d413279', '­À"˜<ïÄT±Ö_Ëè_~óe€†˜\0+»ÑÌ1y', '2015-09-09', 3),
(5, 'student105', '187b6a83d9557275268438569b215723542fb981aec165d9ff80d4e0b465f713', 'áX•¿õJ=í$Z ¥sxÛˆYí_*Sc¬4Î\0•É', '2015-09-10', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`book_id`), ADD KEY `bc_id` (`bc_id`), ADD KEY `bp_id` (`bp_id`);

--
-- Indexes for table `tbl_book_borrow`
--
ALTER TABLE `tbl_book_borrow`
  ADD PRIMARY KEY (`bb_id`);

--
-- Indexes for table `tbl_book_category`
--
ALTER TABLE `tbl_book_category`
  ADD PRIMARY KEY (`bc_id`);

--
-- Indexes for table `tbl_book_publisher`
--
ALTER TABLE `tbl_book_publisher`
  ADD PRIMARY KEY (`bp_id`);

--
-- Indexes for table `tbl_book_reserved`
--
ALTER TABLE `tbl_book_reserved`
  ADD PRIMARY KEY (`br_id`);

--
-- Indexes for table `tbl_book_unreturn`
--
ALTER TABLE `tbl_book_unreturn`
  ADD PRIMARY KEY (`bu_id`);

--
-- Indexes for table `tbl_personnel`
--
ALTER TABLE `tbl_personnel`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_book_borrow`
--
ALTER TABLE `tbl_book_borrow`
  MODIFY `bb_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_book_category`
--
ALTER TABLE `tbl_book_category`
  MODIFY `bc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_book_publisher`
--
ALTER TABLE `tbl_book_publisher`
  MODIFY `bp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_book_reserved`
--
ALTER TABLE `tbl_book_reserved`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_book_unreturn`
--
ALTER TABLE `tbl_book_unreturn`
  MODIFY `bu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_personnel`
--
ALTER TABLE `tbl_personnel`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
