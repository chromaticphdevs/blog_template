-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2018 at 07:07 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ls_601`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountpersonalinformation`
--

CREATE TABLE `accountpersonalinformation` (
  `id` int(11) NOT NULL,
  `accno` varchar(25) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `bdate` date NOT NULL,
  `dbplace` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accountpersonalinformation`
--

INSERT INTO `accountpersonalinformation` (`id`, `accno`, `fname`, `lname`, `mname`, `gender`, `bdate`, `dbplace`) VALUES
(1, 'ls_601rpizoc4ym7', 'mark angelo', 'gonzales', NULL, 1, '1998-11-16', NULL),
(2, 'ls_601jvzkdiyfzo', 'earl dennison', 'tan', NULL, 1, '1963-01-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `accno` varchar(25) NOT NULL,
  `blog_name` varchar(100) NOT NULL,
  `dateRegistered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uemail` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `setup` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `accno`, `blog_name`, `dateRegistered`, `uemail`, `username`, `password`, `setup`) VALUES
(1, 'ls_601rpizoc4ym7', 'blog_number_1', '2018-04-16 07:33:15', 'admin_1@email.com', 'admin_1', '4297f44b13955235245b2497399d7a93', 0),
(2, 'ls_601jvzkdiyfzo', 'admin_2_blog', '2018-04-16 07:34:30', 'admin_2@email.com', 'admin_2', '4297f44b13955235245b2497399d7a93', 0);

-- --------------------------------------------------------

--
-- Table structure for table `postcomments`
--

CREATE TABLE `postcomments` (
  `commentsid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `postby` varchar(100) NOT NULL,
  `commentby` varchar(25) NOT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postcomments`
--

INSERT INTO `postcomments` (`commentsid`, `postid`, `postby`, `commentby`, `comment`) VALUES
(1, 3, 'ls_601jvzkdiyfzo', 'ls_601jvzkdiyfzo', 'try'),
(2, 4, 'ls_601jvzkdiyfzo', 'ls_601jvzkdiyfzo', 'sapa'),
(3, 1, '', 'ls_601jvzkdiyfzo', 'pa comment ako'),
(4, 2, '', 'ls_601jvzkdiyfzo', 'comment: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore'),
(5, 1, '', 'ls_601jvzkdiyfzo', 'comment testing cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(6, 4, '', 'ls_601rpizoc4ym7', 'dolor sit amet, consectetur adipisicing elit, sed do eiusm'),
(7, 3, '', 'ls_601rpizoc4ym7', 'dolor sit amet, consectetur adipisicing elit, sed do eiusm');

-- --------------------------------------------------------

--
-- Table structure for table `userposts`
--

CREATE TABLE `userposts` (
  `postid` int(11) NOT NULL,
  `postby` varchar(25) NOT NULL,
  `dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postval` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userposts`
--

INSERT INTO `userposts` (`postid`, `postby`, `dateposted`, `postval`) VALUES
(1, 'ls_601rpizoc4ym7', '2018-04-16 07:33:43', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(2, 'ls_601rpizoc4ym7', '2018-04-16 07:34:00', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore '),
(3, 'ls_601jvzkdiyfzo', '2018-04-16 07:35:13', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo'),
(4, 'ls_601jvzkdiyfzo', '2018-04-16 07:35:20', 'dolor sit amet, consectetur adipisicing elit, sed do eiusm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountpersonalinformation`
--
ALTER TABLE `accountpersonalinformation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accno` (`accno`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accno` (`accno`),
  ADD UNIQUE KEY `uemail` (`uemail`),
  ADD UNIQUE KEY `blog_name` (`blog_name`);

--
-- Indexes for table `postcomments`
--
ALTER TABLE `postcomments`
  ADD PRIMARY KEY (`commentsid`);

--
-- Indexes for table `userposts`
--
ALTER TABLE `userposts`
  ADD PRIMARY KEY (`postid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountpersonalinformation`
--
ALTER TABLE `accountpersonalinformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `postcomments`
--
ALTER TABLE `postcomments`
  MODIFY `commentsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userposts`
--
ALTER TABLE `userposts`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
