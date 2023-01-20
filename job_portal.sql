-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2023 at 05:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `Id` int(10) NOT NULL,
  `Applicant_id` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Number` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`Id`, `Applicant_id`, `Name`, `Email`, `Password`, `Number`) VALUES
(1, 'A_1', 'Smit', 'smit@gnu.ac.in', '123', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `candidates_applied`
--

CREATE TABLE `candidates_applied` (
  `Id` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Applicant_id` varchar(255) NOT NULL,
  `Applied_For` varchar(255) NOT NULL,
  `Qualification` varchar(255) NOT NULL,
  `YearOf_Graduation` varchar(15) NOT NULL,
  `Resume` varchar(255) NOT NULL,
  `Applied_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidates_applied`
--

INSERT INTO `candidates_applied` (`Id`, `Name`, `Applicant_id`, `Applied_For`, `Qualification`, `YearOf_Graduation`, `Resume`, `Applied_on`) VALUES
(1, 'PATEL SMIT ASHOKKUMAR', 'A_1', 'Teacher', 'BTech-IT', '2026', 'Smit_Resume.pdf', '2023-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `jobpost_details`
--

CREATE TABLE `jobpost_details` (
  `Id` int(10) NOT NULL,
  `Posted_on` date NOT NULL DEFAULT current_timestamp(),
  `Company_name` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Skills` varchar(255) NOT NULL,
  `CTC` varchar(50) NOT NULL,
  `Job_Description` longtext NOT NULL,
  `Recruiter_Id` varchar(255) NOT NULL,
  `Job_Id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobpost_details`
--

INSERT INTO `jobpost_details` (`Id`, `Posted_on`, `Company_name`, `Position`, `Skills`, `CTC`, `Job_Description`, `Recruiter_Id`, `Job_Id`) VALUES
(1, '2023-01-18', 'Google Company', 'Web Developer', 'PHP,HTML,CSS', '3 LPA', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore voluptate, ducimus voluptatibus totam, facilis dolorum laborum dolore, atque reprehenderit recusandae et? Aliquam explicabo debitis omnis doloremque ducimus! Sapiente amet pariatur autem tenetur, quos dicta nam incidunt alias sed necessitatibus odit maxime! Veniam eligendi nemo, hic dicta modi numquam praesentium animi nostrum, minus qui neque ad quos impedit? Cumque repellendus neque, unde aliquam sapiente minus.Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore voluptate, ducimus voluptatibus totam, facilis dolorum laborum dolore, atque reprehenderit recusandae et? Aliquam explicabo debitis omnis doloremque ducimus! Sapiente amet pariatur autem tenetur, quos dicta nam incidunt alias sed necessitatibus odit maxime! Veniam eligendi nemo, hic dicta modi numquam praesentium animi nostrum, minus qui neque ad quos impedit? Cumque repellendus neque, unde aliquam sapiente minus.', 'R_1', 'J_1R'),
(2, '2023-01-18', 'Amazon', 'HR', 'Communication Skills,leadership Skills', '$1000-$1500', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore voluptate, ducimus voluptatibus totam, facilis dolorum laborum dolore, atque reprehenderit recusandae et? Aliquam explicabo debitis omnis doloremque ducimus! Sapiente amet pariatur autem tenetur, quos dicta nam incidunt alias sed necessitatibus odit maxime! Veniam eligendi nemo, hic dicta modi numquam praesentium animi nostrum, minus qui neque ad quos impedit? Cumque repellendus neque, unde aliquam sapiente minus.', 'R_1', 'J_2R'),
(3, '2023-01-18', 'COINCENT', 'Teacher', 'English speaking,Teaching Skills', '₹12000-15000/Month', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore voluptate, ducimus voluptatibus totam, facilis dolorum laborum dolore, atque reprehenderit recusandae et? Aliquam explicabo debitis omnis doloremque ducimus! Sapiente amet pariatur autem tenetur, quos dicta nam incidunt alias sed necessitatibus odit maxime! Veniam eligendi nemo, hic dicta modi numquam praesentium animi nostrum, minus qui neque ad quos impedit? Cumque repellendus neque, unde aliquam sapiente minus.', 'R_2', 'J_3R'),
(5, '2023-01-18', 'Flipkart', 'Software Engineer', 'Programming Skills, Familiarity with Databases, Data Structures and Algorithms.', '$2000-$2500 PA', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore voluptate, ducimus voluptatibus totam, facilis dolorum laborum dolore, atque reprehenderit recusandae et? Aliquam explicabo debitis omnis doloremque ducimus! Sapiente amet pariatur autem tenetur, quos dicta nam incidunt alias sed necessitatibus odit maxime! Veniam eligendi nemo, hic dicta modi numquam praesentium animi nostrum, minus qui neque ad quos impedit? Cumque repellendus neque, unde aliquam sapiente minus.', 'R_2', 'J_5R');

-- --------------------------------------------------------

--
-- Table structure for table `recruiters`
--

CREATE TABLE `recruiters` (
  `Id` int(10) NOT NULL,
  `Recruiter_Id` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Number` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recruiters`
--

INSERT INTO `recruiters` (`Id`, `Recruiter_Id`, `Name`, `Email`, `Password`, `Number`) VALUES
(1, 'R_1', 'PATEL SMIT ASHOKKUMAR', 'smitpatel@gmail.com', '123', 2147483647),
(2, 'R_2', 'Dhruv', 'xyz@gmail.com', '123', 1234567890);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Applicant_id` (`Applicant_id`);

--
-- Indexes for table `candidates_applied`
--
ALTER TABLE `candidates_applied`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `jobpost_details`
--
ALTER TABLE `jobpost_details`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Job_Id` (`Job_Id`);

--
-- Indexes for table `recruiters`
--
ALTER TABLE `recruiters`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Recruiter_Id` (`Recruiter_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidates_applied`
--
ALTER TABLE `candidates_applied`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobpost_details`
--
ALTER TABLE `jobpost_details`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recruiters`
--
ALTER TABLE `recruiters`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
