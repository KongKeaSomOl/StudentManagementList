-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 03:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` varchar(15) NOT NULL,
  `faculty_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`) VALUES
('F-1', 'Economics'),
('F-2', 'IT'),
('F-3', 'Law');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `province_id` varchar(15) NOT NULL,
  `province_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`province_id`, `province_name`) VALUES
('P-01', 'Phnom Penh'),
('P-02', 'Kandal'),
('P-03', 'Kampot'),
('P-04', 'Kep');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(10) NOT NULL,
  `student_name` varchar(40) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `stu_university_id` varchar(10) NOT NULL,
  `stu_faculty_id` varchar(15) NOT NULL,
  `stu_province_id` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `gender`, `stu_university_id`, `stu_faculty_id`, `stu_province_id`) VALUES
('stu-00001', 'Sreng Sineang', 'Female', 'RULE', 'ECONOMIC', 'Phnom Penh'),
('Stu-00002', 'Huy Makara', 'Male', 'RULE', 'IT', 'Kandal'),
('Stu-00003', 'Chean Sopheak', 'Male', 'NUM', 'ECONOMIC', 'Siem Reap'),
('Stu-00004', 'Heng Hay', 'Male', 'RUPP', 'ECONOMIC', 'Preah Sihano'),
('Stu-00005', 'Phen Sophana', 'Male', 'RULE', 'BANK', 'Phnom Penh');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `university_id` varchar(15) NOT NULL,
  `university_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`university_id`, `university_name`) VALUES
('U-1', 'RULE'),
('U-2', 'NUM'),
('U-3', 'BBU');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`university_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
