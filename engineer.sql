-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2019 at 03:31 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `engineer`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_title` varchar(60) NOT NULL,
  `course_tages` varchar(60) NOT NULL,
  `language` varchar(10) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `learn_tabs` longtext NOT NULL,
  `require_tabs` longtext NOT NULL,
  `date_course` varchar(15) NOT NULL,
  `course_image` varchar(20) NOT NULL,
  `last_update` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses_rating`
--

CREATE TABLE `courses_rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `depart_id` int(11) NOT NULL,
  `department_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`depart_id`, `department_name`) VALUES
(1, 'Preporatory'),
(2, 'Telecomunication'),
(3, 'Mechatronics'),
(4, 'Construction');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `ID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(25) DEFAULT NULL,
  `birth_date` varchar(18) DEFAULT NULL,
  `face_un` varchar(15) DEFAULT NULL,
  `twitter_un` varchar(15) DEFAULT NULL,
  `linked_un` varchar(15) DEFAULT NULL,
  `insta_un` varchar(15) DEFAULT NULL,
  `website_url` varchar(30) DEFAULT NULL,
  `avater_image` varchar(20) DEFAULT NULL,
  `background_image` varchar(30) DEFAULT NULL,
  `depart_id` int(11) DEFAULT NULL,
  `sem_id` int(11) DEFAULT NULL,
  `watchlist` varchar(30) DEFAULT NULL,
  `complete_courses` varchar(30) DEFAULT NULL,
  `courses_depart` varchar(300) DEFAULT NULL,
  `status_courses` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`ID`, `username`, `name`, `email`, `address`, `birth_date`, `face_un`, `twitter_un`, `linked_un`, `insta_un`, `website_url`, `avater_image`, `background_image`, `depart_id`, `sem_id`, `watchlist`, `complete_courses`, `courses_depart`, `status_courses`) VALUES
(1, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `sem_id` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `semester_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`sem_id`, `depart_id`, `semester_name`) VALUES
(1, 1, 'semester_one'),
(2, 1, 'semester_two'),
(3, 2, 'semester_three'),
(4, 2, 'semester_four'),
(5, 2, 'semester_five'),
(6, 2, 'semester_six'),
(7, 2, 'semester_seven'),
(8, 2, 'semester_eight'),
(9, 2, 'semester_nine'),
(10, 2, 'semester_ten'),
(11, 3, 'semester_three'),
(12, 3, 'semester_four'),
(13, 3, 'semester_five'),
(14, 3, 'semester_six'),
(15, 3, 'semester_seven'),
(16, 3, 'semester_eight'),
(16, 3, 'semester_nine'),
(17, 3, 'semester_ten'),
(18, 4, 'semester_three'),
(19, 4, 'semester_four'),
(20, 4, 'semester_five'),
(21, 4, 'semester_six'),
(22, 4, 'semester_seven'),
(23, 4, 'semester_eight'),
(24, 4, 'semester_nine'),
(25, 4, 'semester_ten');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe_people`
--

CREATE TABLE `subscribe_people` (
  `scribe_id` int(11) NOT NULL,
  `scribe_name` varchar(30) NOT NULL,
  `scribe_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'user',
  `actived` tinyint(1) NOT NULL DEFAULT '0',
  `data_id` varchar(120) DEFAULT NULL,
  `joined_date` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `status`, `actived`, `data_id`, `joined_date`) VALUES
(1, 'admin', 'MTIzNDU2Nw==', 'admin', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos_files`
--

CREATE TABLE `videos_files` (
  `video_file_id` int(11) NOT NULL,
  `section_name` varchar(30) NOT NULL,
  `course_id` int(11) NOT NULL,
  `video_file_name` varchar(50) NOT NULL,
  `video_file_date` varchar(20) NOT NULL,
  `video_file_content` varchar(150) NOT NULL,
  `video_file_type` varchar(5) NOT NULL,
  `video_duration` varchar(15) NOT NULL DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visitors_number`
--

CREATE TABLE `visitors_number` (
  `visitor_id` int(11) NOT NULL,
  `visitor_ip` text NOT NULL,
  `visitor_date` time DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_title` (`course_title`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `subscribe_people`
--
ALTER TABLE `subscribe_people`
  ADD PRIMARY KEY (`scribe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `videos_files`
--
ALTER TABLE `videos_files`
  ADD PRIMARY KEY (`video_file_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `visitors_number`
--
ALTER TABLE `visitors_number`
  ADD PRIMARY KEY (`visitor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribe_people`
--
ALTER TABLE `subscribe_people`
  MODIFY `scribe_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videos_files`
--
ALTER TABLE `videos_files`
  MODIFY `video_file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors_number`
--
ALTER TABLE `visitors_number`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
