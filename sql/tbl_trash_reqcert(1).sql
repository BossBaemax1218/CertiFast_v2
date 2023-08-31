-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 31, 2023 at 01:33 PM
-- Server version: 10.6.14-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u704096088_db_certifast`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trash_reqcert`
--

CREATE TABLE `tbl_trash_reqcert` (
  `cert_id` int(10) NOT NULL,
  `req_cert_id` varchar(255) DEFAULT NULL,
  `resident_name` varchar(100) DEFAULT NULL,
  `certificate_name` varchar(50) DEFAULT NULL,
  `purok` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  `requirement` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_deleted` date NOT NULL DEFAULT current_timestamp(),
  `requested_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_trash_reqcert`
--

INSERT INTO `tbl_trash_reqcert` (`cert_id`, `req_cert_id`, `resident_name`, `certificate_name`, `purok`, `email`, `date_applied`, `requirement`, `status`, `date_deleted`, `requested_datetime`) VALUES
(2, '', 'Aira Gorre Uy', 'barangay clearance', '1-A', 'iraauy12345@gmail.com', '2023-08-26', '4ps Requirements', 'claimed', '2023-08-27', '2023-08-26 23:07:56'),
(16, '', 'Aira Gorre Uy', 'certificate of residency', '1-A', 'iraauy12345@gmail.com', '2023-08-28', 'Done Requirements', 'on hold', '2023-08-28', '2023-08-28 16:33:18'),
(17, '', 'Aira Gorre Uy', 'certificate of residency', '1-A', 'iraauy12345@gmail.com', '2023-08-29', '4ps Requirements', 'approved', '2023-08-29', '2023-08-29 17:10:52'),
(18, '', 'Aira Gorre Uy', 'family home estate', '1-A', 'iraauy12345@gmail.com', '2023-08-29', '4ps Requirements', 'approved', '2023-08-29', '2023-08-29 17:10:57'),
(19, '', 'Aira Gorre Uy', 'certificate of good moral', '1-A', 'iraauy12345@gmail.com', '2023-08-29', '4ps Requirements', 'approved', '2023-08-29', '2023-08-29 17:11:01'),
(20, '', 'ASNIDA PANGCATAN', 'business permit', 'Los Amigos', 'a.pangcatan.441914@umindanao.edu.ph', '2023-08-29', 'business', 'on hold', '2023-08-29', '2023-08-29 17:11:06'),
(21, '', 'ASNIDA PANGCATAN', 'certificate of good moral', '1-A', 'a.pangcatan.441914@umindanao.edu.ph', '2023-08-29', '4ps Requirements', 'approved', '2023-08-29', '2023-08-29 17:11:13'),
(22, '', 'Aira Gorre Uy', 'first time jobseekers', '1-A', 'iraauy12345@gmail.com', '2023-08-29', '4ps Requirements', 'approved', '2023-08-29', '2023-08-29 17:11:18'),
(23, '', 'Aira Gorre Uy', 'barangay identification', '1-A', 'iraauy12345@gmail.com', '2023-08-29', '4ps Requirements', 'approved', '2023-08-29', '2023-08-29 17:11:23'),
(24, '', 'Aira Gorre Uy', 'certificate of oath taking', '1-A', 'iraauy12345@gmail.com', '2023-08-29', '4ps Requirements', 'approved', '2023-08-29', '2023-08-29 17:11:36'),
(25, '', 'Aira Gorre Uy', 'certificate of indigency', '1-A', 'iraauy12345@gmail.com', '2023-08-29', '4ps Requirements', 'approved', '2023-08-29', '2023-08-29 17:11:59'),
(26, '', 'Aira Gorre Uy', 'certificate of birth', '1-A', 'iraauy12345@gmail.com', '2023-08-29', '4ps Requirements', 'approved', '2023-08-29', '2023-08-29 17:12:08'),
(27, '', 'ASNIDA PANGCATAN', 'barangay identification', '1-A', 'a.pangcatan.441914@umindanao.edu.ph', '2023-08-29', '4ps Requirements', 'approved', '2023-08-29', '2023-08-29 17:12:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_trash_reqcert`
--
ALTER TABLE `tbl_trash_reqcert`
  ADD PRIMARY KEY (`cert_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_trash_reqcert`
--
ALTER TABLE `tbl_trash_reqcert`
  MODIFY `cert_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
