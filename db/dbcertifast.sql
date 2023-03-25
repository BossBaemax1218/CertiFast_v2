-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2023 at 01:04 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcertifast`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblblotter`
--

CREATE TABLE `tblblotter` (
  `id` int(11) NOT NULL,
  `complainant` varchar(100) DEFAULT NULL,
  `respondent` varchar(100) DEFAULT NULL,
  `victim` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `details` varchar(10000) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbrgy_info`
--

INSERT INTO `tblbrgy_info` (`id`, `province`, `town`, `brgy_name`, `number`, `b_email`, `image`, `city_logo`, `brgy_logo`) VALUES
(1, 'Davao', 'Barangay Los Amigos, Tugbok District', 'Office of Punong Barangay', '(082) 228-8984', 'losamigosdavaocity.gov@gmail.com', '28012023073819LogoIcon.png', '10022023131914DavaoSeal.png', '280120230757261.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `tblchairmanship`
--

CREATE TABLE `tblchairmanship` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblchairmanship`
--

INSERT INTO `tblchairmanship` (`id`, `title`) VALUES
(12, 'Barangay Captain'),
(13, 'Barangay Kagawad'),
(14, 'Sanggunian Kabataan'),
(15, 'SK Kagawad'),
(16, 'Barangay Secretary'),
(17, 'Barangay Treasury');

-- --------------------------------------------------------

--
-- Table structure for table `tblofficials`
--

CREATE TABLE `tblofficials` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `chairmanship` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `termstart` date DEFAULT NULL,
  `termend` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblofficials`
--

INSERT INTO `tblofficials` (`id`, `name`, `chairmanship`, `position`, `termstart`, `termend`, `status`) VALUES
(18, 'Aileen N. Atino', '13', '7', '2018-07-02', '2024-07-02', 'Active'),
(19, 'Ruel Ceballos', '13', '7', '2018-07-02', '2024-07-02', 'Active'),
(20, 'Simeon Alejaga, Sr.', '13', '7', '2018-07-02', '2024-07-02', 'Active'),
(21, 'Angelico Santander, Jr.', '13', '7', '2018-07-02', '2024-07-02', 'Active'),
(22, 'Ann Liezl Deliquiña', '13', '7', '2018-07-02', '2024-07-02', 'Active'),
(23, 'Raymundo Pupa', '13', '7', '2018-07-02', '2024-07-02', 'Active'),
(24, 'Adonis Santander', '13', '7', '2018-07-02', '2024-07-02', 'Active'),
(25, 'Arlene D. Suaybaguio ', '13', '7', '2018-07-02', '2024-07-02', 'Active'),
(26, 'Rowen Sampadong', '14', '24', '2018-07-02', '2024-07-10', 'Active'),
(27, 'Karol Jean Pilongo', '15', '25', '2018-07-02', '2024-07-02', 'Active'),
(28, 'Alien Rey Basa', '15', '25', '2018-07-02', '2024-07-02', 'Active'),
(29, 'Gladys Calicdan', '15', '25', '2018-07-02', '2024-07-02', 'Active'),
(30, 'Kim Sitchon', '15', '25', '2018-07-02', '2024-07-02', 'Active'),
(31, 'Adrian Bibat', '15', '25', '2018-07-02', '2024-07-02', 'Active'),
(32, 'Nico Tabaranza', '15', '25', '2018-07-02', '2024-07-02', 'Active'),
(33, 'Roxanne Joy Marie Gelicame', '15', '25', '2018-07-02', '2024-07-02', 'Active'),
(34, 'Abbie Charlotte Cabig-Sarsale', '16', '32', '2018-07-02', '2024-07-02', 'Active'),
(35, 'Melliza Joie Basuga-Tañac', '17', '33', '2018-07-02', '2024-07-02', 'Active'),
(36, 'Roberto A. Ballarta ', '12', '4', '2018-07-02', '2024-07-02', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpayments`
--

INSERT INTO `tblpayments` (`id`, `details`, `amounts`, `date`, `user`, `name`) VALUES
(5, 'Business Permit Payment', '7000.00', '2021-05-19', 'admin', ' Atrium Salon & Studio'),
(6, 'Certificate of Indigency Payment', '3500.00', '2021-05-19', 'admin', ' Ronil Gonzales Cajan'),
(7, 'Barangay Clearance Payment', '2500.00', '2021-05-19', 'admin', ' Ronil Poe Cajan'),
(8, 'Business Permit Payment', '3500.00', '2021-05-18', 'admin', ' Atrium Salon & Studio'),
(9, 'Business Permit Payment', '7000.00', '2021-05-18', 'admin', ' Atrium Salon & Studio'),
(10, 'Business Permit Payment', '7500.00', '2021-05-18', 'admin', ' Atrium Salon & Studio'),
(11, 'Barangay Clearance Payment', '20.00', '2023-02-11', 'admin', ' Archie S. Suribas'),
(12, 'Barangay Clearance Payment', '20.00', '2023-02-11', 'admin', ' Gretchen S. Sanchez'),
(13, 'Certificate of Indigency Payment', '20.00', '2023-02-11', 'admin', ' Gretchen S. Sanchez');

-- --------------------------------------------------------

--
-- Table structure for table `tblpermit`
--

CREATE TABLE `tblpermit` (
  `id` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `owner1` varchar(200) DEFAULT NULL,
  `owner2` varchar(80) DEFAULT NULL,
  `nature` varchar(220) DEFAULT NULL,
  `applied` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpermit`
--

INSERT INTO `tblpermit` (`id`, `name`, `owner1`, `owner2`, `nature`, `applied`) VALUES
(8, 'Shark Incorporation', 'Ash Pangcatan', '', 'Loan Store', '2017-10-11'),
(9, 'Sharks Inc.', 'Christopher Mangadlao', '', 'Loan Store', '2014-02-11'),
(10, 'Bag\'s Store', 'Wimple Aira Umaoeng', '', 'Fashion Store', '2015-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `tblposition`
--

CREATE TABLE `tblposition` (
  `id` int(11) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblposition`
--

INSERT INTO `tblposition` (`id`, `position`, `order`) VALUES
(4, 'Captain', 1),
(7, 'Kagawad', 1),
(24, 'SK Chairman', 1),
(25, 'SK Kagawad', 1),
(32, 'Secretary', 1),
(33, 'Treasurer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblprecinct`
--

CREATE TABLE `tblprecinct` (
  `id` int(11) NOT NULL,
  `precinct` varchar(100) DEFAULT NULL,
  `total_residents` varchar(50) DEFAULT NULL,
  `total_households` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblpurok`
--

CREATE TABLE `tblpurok` (
  `id` int(11) NOT NULL,
  `purok` varchar(255) DEFAULT NULL,
  `total_residents` varchar(50) DEFAULT NULL,
  `total_households` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `picture` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `alias` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `birthplace` varchar(80) CHARACTER SET utf8mb4 DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `civilstatus` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `purok` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `voterstatus` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `identified_as` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tax` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `resident_type` int(11) DEFAULT 1,
  `remarks` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresident`
--

INSERT INTO `tblresident` (`id`, `national_id`, `citizenship`, `picture`, `firstname`, `middlename`, `lastname`, `alias`, `birthplace`, `birthdate`, `age`, `civilstatus`, `gender`, `purok`, `voterstatus`, `identified_as`, `phone`, `tax`, `occupation`, `address`, `resident_type`, `remarks`) VALUES
(183, '134981930198', 'Davao City', 'person.png', 'Gretchen', 'S.', 'Sanchez', 'Gretchen', 'Tugbok, Davao City', '1991-03-20', 31, 'Married', 'Female', '1-A', 'Yes', 'Positive', '09272938801', '3123111211123', 'N/A', 'Purok 1-B', 1, '4ps Requirements'),
(184, 'N/A', 'Davao City', 'person.png', 'Archie', 'S.', 'Suribas', 'Arc', 'Tugbok, Davao City', '2009-02-11', 14, 'Single', 'Male', '1-A', 'No', '', '09272938801', 'N/A', 'N/A', 'Purok 1-A', 1, NULL),
(181, '1231344362362', 'Davao City', '10022023141807bg4.png', 'Ariel', 'A.', 'Suribas', 'Ariel', 'Davao City', '1972-10-25', 51, 'Married', 'Male', '1-A', 'Yes', 'Positive', '09272938801', '1257423422131', 'N/A', 'Barangay Los Amigos, Purok 1-A, Tugbok Davao City', 1, 'Bank Requirements');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `user_type`, `avatar`, `created_at`) VALUES
(11, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'administrator', '280120230832181.jfif', '2021-05-03 02:33:03'),
(12, 'Staff_Wimple', '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', 'staff', '28012023073945brgyHall.jpg', '2023-01-28 06:39:45'),
(13, 'Admin_Wimple', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'administrator', '29012023030320DavaoSeal.png', '2023-01-29 02:03:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblblotter`
--
ALTER TABLE `tblblotter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbrgy_info`
--
ALTER TABLE `tblbrgy_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblchairmanship`
--
ALTER TABLE `tblchairmanship`
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
-- Indexes for table `tbl_support`
--
ALTER TABLE `tbl_support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblblotter`
--
ALTER TABLE `tblblotter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tblbrgy_info`
--
ALTER TABLE `tblbrgy_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblchairmanship`
--
ALTER TABLE `tblchairmanship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblofficials`
--
ALTER TABLE `tblofficials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblpayments`
--
ALTER TABLE `tblpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblpermit`
--
ALTER TABLE `tblpermit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblposition`
--
ALTER TABLE `tblposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
