-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2021 at 09:30 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csi_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `departmentId` int(10) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `website` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- Error reading data for table csi_project.contact_info: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `csi_project`.`contact_info`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department` varchar(50) NOT NULL,
  `departmentId` int(10) NOT NULL,
  `dep_description` varchar(2000) NOT NULL,
  `linked` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department`, `departmentId`, `dep_description`, `linked`) VALUES
('Admin', 1, 'this is my description', 'department.blog'),
('BSc Computer Science', 17, 'Department of Computer Science', 'www.rgasc.edu.in'),
('BSc Computer Application', 43, 'Department of Computer Application', 'www.rgasc.edu.in'),
('newone', 32, 'this just a text', 'www.example.com'),
('newone12343224fas', 39, 'this just a text 421', 'www.example.comf'),
('newone12343224fasrewq', 40, 'this just a text 421', 'www.example.comf'),
('random', 41, 'random desc', 'www.random.com');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `departmentId` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(30) NOT NULL,
  `userlevel` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`departmentId`, `username`, `password`, `name`, `userlevel`) VALUES
(1, 'Kiruthi', '827ccb0eea8a706c4c34a16891f84e7b', 'Kiruthi', 1),
(17, 'Revathi', '827ccb0eea8a706c4c34a16891f84e7b', 'Revathi', 0),
(43, 'jega', '827ccb0eea8a706c4c34a16891f84e7b', 'Jegadesswari S', NULL),
(42, 'yuva2000', '827ccb0eea8a706c4c34a16891f84e7b', 'Yuvii', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notificationId` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `time_stamp` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notificationId`, `username`, `heading`, `description`, `time_stamp`) VALUES
(1, 'Kiruthi', 'This is just a Heading.', 'Didn\'t you get it, its just a heading. How many times do I have to tell you that?', '2017-08-02 00:00:00'),
(36, 'Revathi', 'SQM', 'SQM  internal test number 1', '2021-07-13 10:04:22'),
(37, 'jega', 'Microprocessor', 'Hello student \r\n', '2021-07-13 12:06:22'),
(9, 'Kiruthi', 'The POst!', '\r\nWith more than 83,000 books ranging from the classics to contemporary non-fiction works, Questia is your single destination for reading books online – and remember, nothing is ever checked out!\r\n\r\nQuestia is great for scholarly research too! With deep archives of thousands of academic journals and easy to use project and bibliography building tools, Questia will help you research better, faster.\r\nJoin Questia today!\r\nTime-saving research tools\r\nTools to streamline your research process\r\n\r\nTime-saving research tools, like automatic bibliography creation, highlights, notes, citations and more, all designed with the research process in mind.\r\nCitations\r\nCite passages, pages or entire articles instantly from within our library or anywhere online Notes\r\nAdd notes for yourself directly to\r\nbook pages or articles Bookmarks\r\nEasily return to any page in any\r\nbook in our library Bibliographies\r\nAutomatically generate bibliographies in MLA, APA or Chicago format Highlights\r\nHighlight and save ', '2017-08-02 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD UNIQUE KEY `departmentId` (`departmentId`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departmentId`),
  ADD UNIQUE KEY `department` (`department`),
  ADD UNIQUE KEY `departmentId` (`departmentId`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`departmentId`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `departmentId` (`departmentId`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notificationId`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `departmentId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `departmentId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `departmentId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notificationId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
