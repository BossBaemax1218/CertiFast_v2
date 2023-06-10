-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 06:43 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_certifast`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbrgy_info`
--

CREATE TABLE `tblbrgy_info` (
  `id` int(11) NOT NULL,
  `province` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `brgy_name` varchar(50) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `b_email` varchar(50) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `city_logo` varchar(100) DEFAULT NULL,
  `brgy_logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbrgy_info`
--

INSERT INTO `tblbrgy_info` (`id`, `province`, `town`, `brgy_name`, `number`, `b_email`, `image`, `city_logo`, `brgy_logo`) VALUES
(1, 'Davao', 'Barangay Los Amigos, Tugbok District', 'Office of Punong Barangay', '(082) 228-8984', 'losamigosdavaocity.gov@gmail.com', '28012023073819LogoIcon.png', '10022023131914DavaoSeal.png', '25032023083959brgyLA.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblofficials`
--

CREATE TABLE `tblofficials` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `termstart` date DEFAULT NULL,
  `termend` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblofficials`
--

INSERT INTO `tblofficials` (`id`, `fullname`, `position`, `photo`, `termstart`, `termend`, `status`) VALUES
(79, 'Wimple Aira Umaoeng', '1', NULL, '2023-06-09', '2023-06-09', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayments`
--

CREATE TABLE `tblpayments` (
  `id` int(11) NOT NULL,
  `details` varchar(100) DEFAULT NULL,
  `amounts` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpayments`
--

INSERT INTO `tblpayments` (`id`, `details`, `amounts`, `date`, `user`, `name`) VALUES
(18, 'Barangay Clearance Payment', '20.00', '2023-03-13', 'admin', ' Gretchen S. Sanchez'),
(19, 'Barangay Clearance Payment', '20.00', '2023-03-13', 'Staff_Wimple', ' Gretchen S. Sanchez'),
(20, 'Barangay Clearance Payment', '20.00', '2023-03-16', 'admin', ' Gretchen S. Sanchez'),
(21, 'Certificate of Indigency Payment', '20.00', '2023-03-16', 'admin', ' Gretchen S. Sanchez'),
(22, 'Business Permit Payment', '20.00', '2023-03-16', 'admin', ' Bag\'s Store'),
(24, 'Certificate of Residency Payment', '10.00', '2023-04-15', 'admin', ' Gretchen S. Sanchez');

-- --------------------------------------------------------

--
-- Table structure for table `tblpermit`
--

CREATE TABLE `tblpermit` (
  `id` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `owner1` varchar(200) DEFAULT NULL,
  `nature` varchar(220) DEFAULT NULL,
  `applied` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpermit`
--

INSERT INTO `tblpermit` (`id`, `name`, `owner1`, `nature`, `applied`) VALUES
(8, 'Shark Incorporation', 'Ash Pangcatan', 'Loan Store', '2017-10-11'),
(9, 'Sharks Inc.', 'Christopher Mangadlao', 'Loan Store', '2014-02-11'),
(10, 'Bag\'s Store', 'Wimple Aira Umaoeng', 'Fashion Store', '2015-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `tblposition`
--

CREATE TABLE `tblposition` (
  `id` int(11) NOT NULL,
  `position` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblposition`
--

INSERT INTO `tblposition` (`id`, `position`) VALUES
(1, 'Kapitan'),
(2, 'Kagawad'),
(3, 'Secretary'),
(4, 'Treasurer'),
(5, 'SK Chairman'),
(6, 'SK Kagawad');

-- --------------------------------------------------------

--
-- Table structure for table `tblprecinct`
--

CREATE TABLE `tblprecinct` (
  `id` int(11) NOT NULL,
  `precinct` varchar(100) DEFAULT NULL,
  `total_residents` varchar(50) DEFAULT NULL,
  `total_households` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpurok`
--

CREATE TABLE `tblpurok` (
  `id` int(11) NOT NULL,
  `purok` varchar(255) DEFAULT NULL,
  `total_residents` varchar(50) DEFAULT NULL,
  `total_households` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpurok`
--

INSERT INTO `tblpurok` (`id`, `purok`, `total_residents`, `total_households`) VALUES
(14, '1-A', '274', '66'),
(15, '1-B', '376', '105'),
(16, '1-B Graceland', '245', '52'),
(17, '1-C', '243', '74'),
(18, '2-A', '314', '87'),
(19, '2-B', '300', '93'),
(20, '3-A', '244', '73'),
(21, '3-B', '527', '128'),
(22, '4-A', '151', '38'),
(23, '4-B', '295', '73'),
(24, '5-A', '494', '122'),
(25, '5-B', '559', '142'),
(26, '6-A', '190', '45'),
(27, '6A-1', '386', '79'),
(28, '6A-2', '240', '56'),
(29, '6A-3', '384', '77'),
(30, '6A-4', '226', '44'),
(31, '6A-5', '317', '93'),
(32, '6B-1', '371', '77'),
(33, '6B-3', '440', '96'),
(34, '6B3-A', '298', '72'),
(35, '6B-4', '258', '53'),
(36, '6B-5', '269', '60'),
(37, '6B-6', '525', '123'),
(38, '6B6-A', '157', '42'),
(39, '6B-7', '311', '71'),
(40, '6B-8', '311', '56'),
(41, '6-C', '210', '60'),
(42, '6-D', '185', '53'),
(43, '7', '469', '112'),
(44, '8-A', '560', '154'),
(45, '8-B', '441', '104'),
(46, '9', '551', '117'),
(47, '10-A', '167', '50'),
(48, '10-B', '460', '127'),
(49, '11', '262', '67'),
(50, '11-A', '228', '63'),
(51, '12', '394', '109');

-- --------------------------------------------------------

--
-- Table structure for table `tblresident`
--

CREATE TABLE `tblresident` (
  `id` int(11) NOT NULL,
  `national_id` varchar(100) DEFAULT NULL,
  `citizenship` varchar(50) DEFAULT NULL,
  `picture` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alias` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birthplace` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `civilstatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `purok` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `voterstatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `identified_as` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `resident_type` int(11) DEFAULT 1,
  `remarks` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblresident`
--

INSERT INTO `tblresident` (`id`, `national_id`, `citizenship`, `picture`, `firstname`, `middlename`, `lastname`, `alias`, `birthplace`, `birthdate`, `age`, `civilstatus`, `gender`, `purok`, `voterstatus`, `identified_as`, `phone`, `email`, `occupation`, `address`, `resident_type`, `remarks`) VALUES
(183, '134981930198', 'Davao City', '04062023121613officials-2.jpg', 'Gretchen', 'S.', 'Sanchez', '1-A', 'Tugbok, Davao City', '1991-03-20', 31, 'Married', 'Female', '1-A', 'Yes', 'Positive', '09272938801', '2315123123', 'N/A', 'Purok 1-B', 1, '4ps Requirements'),
(181, '1231344362362', 'Davao City', '10022023141807bg4.png', 'Ariel', 'A.', 'Suribas', '1-A', 'Davao City', '1972-10-25', 51, 'Married', 'Male', '1-A', 'Yes', 'Positive', '09272938801', '1231231351234', 'N/A', 'Barangay Los Amigos, Purok 1-A, Tugbok Davao City', 1, 'Bank Requirements'),
(189, '1515856231239080', 'Filipino', '080620231709021.png', 'Wimple ', 'G. ', 'Umaoeng', 'Tugbok, Davao City', 'Tugbok, Davao City', '2000-09-18', 22, 'Single', 'Female', '1-B Graceland', 'Yes', 'Positive', '09272938801', '1162547456712', 'N/A', 'TESDA', 1, '4ps Requirements');

-- --------------------------------------------------------

--
-- Table structure for table `tblverify`
--

CREATE TABLE `tblverify` (
  `id` int(11) NOT NULL,
  `verifycode` varchar(11) NOT NULL,
  `expires` time NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblverify`
--

INSERT INTO `tblverify` (`id`, `verifycode`, `expires`, `email`, `created_at`, `verified`) VALUES
(46, '3ba80d', '11:40:36', 'airagorre1218@gmail.com', '2023-06-09', 1),
(47, 'd9b913', '11:06:07', 'cyberlez12345@gmail.com', '2023-06-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_support`
--

CREATE TABLE `tbl_support` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_admin`
--

CREATE TABLE `tbl_user_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_admin`
--

INSERT INTO `tbl_user_admin` (`id`, `username`, `password`, `user_type`, `avatar`, `created_at`) VALUES
(11, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'administrator', '280120230832181.jfif', '2021-05-03 02:33:03'),
(12, 'Staff_Wimple', '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', 'staff', '28012023073945brgyHall.jpg', '2023-01-28 06:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_resident`
--

CREATE TABLE `tbl_user_resident` (
  `id` int(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `verifycode` varchar(11) NOT NULL,
  `codesend` time DEFAULT NULL,
  `verifystatus` int(11) NOT NULL,
  `account_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_resident`
--

INSERT INTO `tbl_user_resident` (`id`, `fullname`, `user_email`, `password`, `verifycode`, `codesend`, `verifystatus`, `account_created`) VALUES
(48, 'Wimple Aira Umaoeng', 'iraauy12345@gmail.com', '29eeed416aacea1f58ee82b4f0cc76a1a91e55cc', 'df21d2', '18:25:06', 1, '2023-06-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbrgy_info`
--
ALTER TABLE `tblbrgy_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblofficials`
--
ALTER TABLE `tblofficials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpermit`
--
ALTER TABLE `tblpermit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblposition`
--
ALTER TABLE `tblposition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblprecinct`
--
ALTER TABLE `tblprecinct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpurok`
--
ALTER TABLE `tblpurok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresident`
--
ALTER TABLE `tblresident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblverify`
--
ALTER TABLE `tblverify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_support`
--
ALTER TABLE `tbl_support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_admin`
--
ALTER TABLE `tbl_user_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_resident`
--
ALTER TABLE `tbl_user_resident`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbrgy_info`
--
ALTER TABLE `tblbrgy_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblofficials`
--
ALTER TABLE `tblofficials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tblpayments`
--
ALTER TABLE `tblpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblpermit`
--
ALTER TABLE `tblpermit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblposition`
--
ALTER TABLE `tblposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblprecinct`
--
ALTER TABLE `tblprecinct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblpurok`
--
ALTER TABLE `tblpurok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tblresident`
--
ALTER TABLE `tblresident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `tblverify`
--
ALTER TABLE `tblverify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_user_admin`
--
ALTER TABLE `tbl_user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_user_resident`
--
ALTER TABLE `tbl_user_resident`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
