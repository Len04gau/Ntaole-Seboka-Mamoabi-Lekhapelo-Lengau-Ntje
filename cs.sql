-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 05:01 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Name` varchar(50) DEFAULT NULL,
  `Email` varchar(60) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Name`, `Email`, `Password`) VALUES
('', 'thabelomoloisane4@gmail.com', '$2y$10$ejz5AWMsFKTIJg6lNSM/Yexgc5Igr9UoSvsFopebEzYhwC.NFDJUG'),
('albert', 'tha@gmail.com', '$2y$10$/jQJVzmIMg8KmkjaRF3VyOJrTsASht6nPqB2e3JiiO2ulffVxWW0a'),
('tumelo', 'fokothi@gmail.com', '$2y$10$6KRhXGp9XP/duEZD/eZ.xeMpC/lmeerkZn3qndwCIs1PHksQ88UIi'),
('limko', 'limko@2023', '$2y$10$t8WMhMX/EcA2ghm6City4OBqV1H9d1ybe0c2fQrs9VQK3ebENxIre'),
('fokothi', 'fokothi@gmail.com', '$2y$10$fJqNyTkBarx20FGY8Teaouqlp14VcA.EWdTjOLaA9VECropmrf3Z6'),
('limko', 'limko@2023', '$2y$10$ddAcDLV6AMfd6XJC2wlP5ev26HkH/q8QAyeKZpkclBgiPaP5YqlMe'),
('fokothi', 'fokothi@gmail.com', '$2y$10$jy4J71t/G9U3uWM.2vnfEuibQR2djTAI34ZMJum6SEs0uqXEEeyKy');

-- --------------------------------------------------------

--
-- Table structure for table `admin login`
--

CREATE TABLE `admin login` (
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses_table`
--

CREATE TABLE `courses_table` (
  `COURSE_ID` varchar(30) NOT NULL,
  `COURSE_NAME` text NOT NULL,
  `QUALIFICATIONS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_table`
--

INSERT INTO `courses_table` (`COURSE_ID`, `COURSE_NAME`, `QUALIFICATIONS`) VALUES
('AP', 'Arts and performance', '3 credits 2 passes'),
('BIT', 'Business information Technology', '3 credits 2 passes'),
('GD', 'Graphic designing', '3 credits 2 passes'),
('MSE1', 'Multimedia in software engineering', '3 credits and 2 passes');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_table`
--

CREATE TABLE `faculty_table` (
  `FACULTY_ID` varchar(30) NOT NULL,
  `FACULTY_NAME` text NOT NULL,
  `COURSE_ID` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_table`
--

INSERT INTO `faculty_table` (`FACULTY_ID`, `FACULTY_NAME`, `COURSE_ID`) VALUES
('FCMB', 'Faculty of communication media and broadcasting', 'FP'),
('FDI', 'Faculty of design and innovation', 'GD'),
('FICT', 'Faculty of information communication technology', 'MSE1');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `Name` varchar(55) DEFAULT NULL,
  `Email` varchar(55) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`Name`, `Email`, `Password`) VALUES
('fokothi', 'fokothi@gmail.com', '$2y$10$w9mx7OYvMSB3D0phJlUkQesZDVBaeNEJYj2UubWb4x7QUL1JztH4i');

-- --------------------------------------------------------

--
-- Table structure for table `intuition login`
--

CREATE TABLE `intuition login` (
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Name` varchar(55) DEFAULT NULL,
  `Email` varchar(55) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`Name`, `Email`, `Password`) VALUES
('takane', 'takane@gmail.com', '$2y$10$48oATGmmvOv7ecbSFOxAPezmVf5DmGLAVGQYe8vOzZ3UQEALXQTjG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin login`
--
ALTER TABLE `admin login`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `courses_table`
--
ALTER TABLE `courses_table`
  ADD PRIMARY KEY (`COURSE_ID`);

--
-- Indexes for table `faculty_table`
--
ALTER TABLE `faculty_table`
  ADD PRIMARY KEY (`FACULTY_ID`),
  ADD KEY `Test` (`COURSE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
