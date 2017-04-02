-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2017 at 02:55 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `docx`
--
CREATE DATABASE `docx`;
USE `docx`;
-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `_id` int(10) NOT NULL,
  `p_name` text NOT NULL,
  `diagnosis` text NOT NULL,
  `prescription` text NOT NULL,
  `last_visited` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`_id`, `p_name`, `diagnosis`, `prescription`, `last_visited`) VALUES
(1, 'Danish Shah', 'Terbina Fungus', 'Panderm, TORZ-200', '2017-01-17');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `_id` int(10) NOT NULL,
  `f_name` text,
  `l_name` text,
  `age` int(3) DEFAULT NULL,
  `gender` text,
  `weight` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `mob_no` text NOT NULL,
  `diagnosis` text,
  `prescription` text,
  `last_visited` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`_id`, `f_name`, `l_name`, `age`, `gender`, `weight`, `height`, `mob_no`, `diagnosis`, `prescription`, `last_visited`, `created_at`) VALUES
(1, 'Danish', 'Shah', 20, 'Male', 55, 78, '8828496830', 'Terbina Fungus', 'Panderm, TORZ-200', '2017-01-17', '2017-01-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
