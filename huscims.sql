-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2021 at 07:34 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `huscims`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `staff_id` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `work_position` text NOT NULL,
  `password` text NOT NULL,
  `date_of_reg` date NOT NULL,
  `phone_num` int(11) NOT NULL,
  `gender` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`staff_id`, `first_name`, `last_name`, `work_position`, `password`, `date_of_reg`, `phone_num`, `gender`) VALUES
('baya1597@admin', 'baya', 'marley', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2021-07-06', 936, ''),
('kaleab1679@doctor', 'kaleab', 'nigusse', 'doctor', 'b65cb28b7c2569d90631cef9c8a8c29e', '2021-07-06', 937, 'male'),
('dagim3270@doctor', 'dagim', 'nigusse', 'doctor', 'a684eceee76fc522773286a895bc8436', '2021-07-13', 936, 'male'),
('kal1300@doctor', 'kal', 'nig', 'doctor', 'a684eceee76fc522773286a895bc8436', '2021-08-01', 936, 'male'),
('sfs5847@doctor', 'sfs', 'sfsf', 'doctor', '03c7c0ace395d80182db07ae2c30f034', '2021-08-01', 936, 'male'),
('sfs5863@doctor', 'sfs', 'sfsf', 'doctor', '03c7c0ace395d80182db07ae2c30f034', '2021-08-01', 936, 'male'),
('sfa2405@registrar', 'sfa', 'ss', 'registrar', 'a684eceee76fc522773286a895bc8436', '2021-08-01', 936, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `drug_store`
--

CREATE TABLE `drug_store` (
  `drug_name` text NOT NULL,
  `category` text NOT NULL,
  `desc` text NOT NULL,
  `company` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_supplied` date NOT NULL,
  `manu_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `desc_no` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `stu_id` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `gender` text NOT NULL,
  `age` int(11) NOT NULL,
  `phone_num` int(11) NOT NULL,
  `department` text NOT NULL,
  `date_of_reg` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`stu_id`, `first_name`, `last_name`, `gender`, `age`, `phone_num`, `department`, `date_of_reg`) VALUES
('43ds', 'kalab', 'nigusse', 'male', 23, 936, 'cs', '2021-08-01'),
('456fff', 'sfsf', 'ada', 'male', 67, 0, 'cs', '2021-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `patient_history`
--

CREATE TABLE `patient_history` (
  `stu_id` text NOT NULL,
  `staff_id` date NOT NULL,
  `service` text NOT NULL,
  `diagnosis` text NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pending_patients`
--

CREATE TABLE `pending_patients` (
  `stu_id` text NOT NULL,
  `pat_name` text NOT NULL,
  `time_of_reg` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `pat_id` text NOT NULL,
  `staff_id` text NOT NULL,
  `medicine` text NOT NULL,
  `strength` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
