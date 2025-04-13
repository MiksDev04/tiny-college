-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 08:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiny_college`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `bldg_code` int(11) NOT NULL,
  `bldg_name` varchar(100) DEFAULT NULL,
  `bldg_location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`bldg_code`, `bldg_name`, `bldg_location`) VALUES
(3, 'CCST Building', 'Left Side of Main Road'),
(4, 'CAS Building', 'Right Side of Pavillion');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_code` int(11) NOT NULL,
  `class_section` varchar(50) DEFAULT NULL,
  `class_time` time DEFAULT NULL,
  `crs_code` int(11) DEFAULT NULL,
  `prof_num` int(11) DEFAULT NULL,
  `room_code` int(11) DEFAULT NULL,
  `semester_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_code`, `class_section`, `class_time`, `crs_code`, `prof_num`, `room_code`, `semester_code`) VALUES
(1, '2-A', '14:00:00', 1, 9, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `crs_code` int(11) NOT NULL,
  `dept_code` int(11) DEFAULT NULL,
  `crs_title` varchar(100) DEFAULT NULL,
  `crs_description` text DEFAULT NULL,
  `crs_credit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`crs_code`, `dept_code`, `crs_title`, `crs_description`, `crs_credit`) VALUES
(1, 5, 'Computer Programming', 'This is the fundamentals of programming', 2),
(2, 5, 'Networking', 'This is about studying computer connections', 2);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_code` int(11) NOT NULL,
  `dept_name` varchar(100) DEFAULT NULL,
  `school_code` int(11) DEFAULT NULL,
  `prof_num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_code`, `dept_name`, `school_code`, `prof_num`) VALUES
(2, 'CCST', 1, 9),
(6, 'CAS', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `class_code` int(11) NOT NULL,
  `stu_num` int(11) NOT NULL,
  `enroll_date` date DEFAULT NULL,
  `enroll_grade` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`class_code`, `stu_num`, `enroll_date`, `enroll_grade`) VALUES
(1, 1, '2025-04-22', '95'),
(4, 1, '2025-04-16', '907');

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `prof_num` int(11) NOT NULL,
  `dept_code` int(11) DEFAULT NULL,
  `prof_specialty` varchar(100) DEFAULT NULL,
  `prof_rank` varchar(50) DEFAULT NULL,
  `prof_lname` varchar(50) DEFAULT NULL,
  `prof_fname` varchar(50) DEFAULT NULL,
  `prof_initial` char(1) DEFAULT NULL,
  `prof_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`prof_num`, `dept_code`, `prof_specialty`, `prof_rank`, `prof_lname`, `prof_fname`, `prof_initial`, `prof_email`) VALUES
(9, 5, 'Jujutsu Techniques', 'Teacher III', 'Satoru', 'Gojo', 'S', 'gojo@gmai.com');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_code` int(11) NOT NULL,
  `room_type` varchar(50) DEFAULT NULL,
  `bldg_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_code`, `room_type`, `bldg_code`) VALUES
(3, 'AVR Room', 3);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `school_code` int(11) NOT NULL,
  `school_name` varchar(100) DEFAULT NULL,
  `prof_num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`school_code`, `school_name`, `prof_num`) VALUES
(1, 'PLSP', 9);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_code` int(11) NOT NULL,
  `semester_year` int(11) DEFAULT NULL,
  `semester_term` varchar(50) DEFAULT NULL,
  `semester_start_date` date DEFAULT NULL,
  `semester_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_code`, `semester_year`, `semester_term`, `semester_start_date`, `semester_end_date`) VALUES
(2, 2025, 'Long term', '2025-03-18', '2025-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_num` int(11) NOT NULL,
  `dept_code` int(11) DEFAULT NULL,
  `stu_lname` varchar(50) DEFAULT NULL,
  `stu_fname` varchar(50) DEFAULT NULL,
  `stu_initial` char(1) DEFAULT NULL,
  `stu_email` varchar(100) DEFAULT NULL,
  `prof_num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_num`, `dept_code`, `stu_lname`, `stu_fname`, `stu_initial`, `stu_email`, `prof_num`) VALUES
(1, 5, 'Gapasan', 'Miko', 'M', 'miko@gmail.com', 9),
(2, 5, 'q', 'wq', 'w', 'qww@gmail.com', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'miko gapasan', 'mikogapasan04@gmail.com', '1234'),
(2, 'Miko Gapasan', 'helloworld@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`bldg_code`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_code`),
  ADD KEY `crs_code` (`crs_code`),
  ADD KEY `prof_num` (`prof_num`),
  ADD KEY `room_code` (`room_code`),
  ADD KEY `semester_code` (`semester_code`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`crs_code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_code`),
  ADD KEY `school_code` (`school_code`),
  ADD KEY `department_ibfk_1` (`prof_num`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`class_code`,`stu_num`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`prof_num`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_code`),
  ADD KEY `bldg_code` (`bldg_code`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_code`),
  ADD KEY `school_ibfk_1` (`prof_num`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_code`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_num`),
  ADD KEY `prof_num` (`prof_num`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `bldg_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `crs_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `prof_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `school_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`crs_code`) REFERENCES `course` (`crs_code`),
  ADD CONSTRAINT `class_ibfk_2` FOREIGN KEY (`prof_num`) REFERENCES `professor` (`prof_num`),
  ADD CONSTRAINT `class_ibfk_3` FOREIGN KEY (`room_code`) REFERENCES `room` (`room_code`),
  ADD CONSTRAINT `class_ibfk_4` FOREIGN KEY (`semester_code`) REFERENCES `semester` (`semester_code`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`prof_num`) REFERENCES `professor` (`prof_num`),
  ADD CONSTRAINT `department_ibfk_2` FOREIGN KEY (`school_code`) REFERENCES `school` (`school_code`);

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`stu_num`) REFERENCES `student` (`stu_num`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`bldg_code`) REFERENCES `building` (`bldg_code`);

--
-- Constraints for table `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `school_ibfk_1` FOREIGN KEY (`prof_num`) REFERENCES `professor` (`prof_num`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`prof_num`) REFERENCES `professor` (`prof_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
