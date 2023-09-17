# ABMS : MySQL database backup
#
# Generated: Saturday 15. April 2023
# Hostname: localhost
# Database: db_certifast
# --------------------------------------------------------


#
# Delete any existing table `tbl_support`
#

DROP TABLE IF EXISTS `tbl_support`;


#
# Table structure of table `tbl_support`
#



CREATE TABLE `tbl_support` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbl_users`
#

DROP TABLE IF EXISTS `tbl_users`;


#
# Table structure of table `tbl_users`
#



CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_users VALUES("11","admin","d033e22ae348aeb5660fc2140aec35850c4da997","administrator","280120230832181.jfif","2021-05-03 10:33:03");
INSERT INTO tbl_users VALUES("12","Staff_Wimple","6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611","staff","28012023073945brgyHall.jpg","2023-01-28 14:39:45");



#
# Delete any existing table `tblbrgy_info`
#

DROP TABLE IF EXISTS `tblbrgy_info`;


#
# Table structure of table `tblbrgy_info`
#



CREATE TABLE `tblbrgy_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `brgy_name` varchar(50) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `b_email` varchar(50) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `city_logo` varchar(100) DEFAULT NULL,
  `brgy_logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblbrgy_info VALUES("1","Davao","Barangay Los Amigos, Tugbok District","Office of Punong Barangay","(082) 228-8984","losamigosdavaocity.gov@gmail.com","28012023073819LogoIcon.png","10022023131914DavaoSeal.png","25032023083959brgyLA.png");



#
# Delete any existing table `tblofficials`
#

DROP TABLE IF EXISTS `tblofficials`;


#
# Table structure of table `tblofficials`
#



CREATE TABLE `tblofficials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `termstart` date DEFAULT NULL,
  `termend` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblofficials VALUES("37","ROBERTO A. BALLARTA","1","2018-07-02","2022-07-02","Active");
INSERT INTO tblofficials VALUES("39","Abbie Charlotte Cabig-Sarsale","3","2018-07-02","2022-07-01","Active");
INSERT INTO tblofficials VALUES("40","Melliza Joie Basuga-Tañac","4","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("41","Aileen N. Atino","2","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("42","Ruel Ceballos","2","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("43","Simeon Alejaga, Sr.","2","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("44","Angelico Santander, Jr.","2","2018-06-02","2023-05-02","Active");
INSERT INTO tblofficials VALUES("45","Ann Liezl Deliquiña","2","2018-06-02","2022-05-02","Active");
INSERT INTO tblofficials VALUES("46","Raymundo Pupa","2","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("47","Adonis Santander","2","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("48","Arlene D. Suaybaguio","2","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("49","Rowen Sampadong","5","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("50","Karol Jean Pilongo","6","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("51","Alien Rey Basa","6","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("52","Gladys Calicdan","6","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("53","Kim Sitchon","6","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("54","Adrian Bibat","6","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("55","Nico Tabaranza","6","2018-06-02","2022-06-02","Active");
INSERT INTO tblofficials VALUES("56","Roxanne Joy Marie Gelicame","6","2018-06-02","2022-06-02","Active");



#
# Delete any existing table `tblpayments`
#

DROP TABLE IF EXISTS `tblpayments`;


#
# Table structure of table `tblpayments`
#



CREATE TABLE `tblpayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `details` varchar(100) DEFAULT NULL,
  `amounts` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpayments VALUES("18","Barangay Clearance Payment","20.00","2023-03-13","admin"," Gretchen S. Sanchez");
INSERT INTO tblpayments VALUES("19","Barangay Clearance Payment","20.00","2023-03-13","Staff_Wimple"," Gretchen S. Sanchez");
INSERT INTO tblpayments VALUES("20","Barangay Clearance Payment","20.00","2023-03-16","admin"," Gretchen S. Sanchez");
INSERT INTO tblpayments VALUES("21","Certificate of Indigency Payment","20.00","2023-03-16","admin"," Gretchen S. Sanchez");
INSERT INTO tblpayments VALUES("22","Business Permit Payment","20.00","2023-03-16","admin"," Bag's Store");



#
# Delete any existing table `tblpermit`
#

DROP TABLE IF EXISTS `tblpermit`;


#
# Table structure of table `tblpermit`
#



CREATE TABLE `tblpermit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `owner1` varchar(200) DEFAULT NULL,
  `nature` varchar(220) DEFAULT NULL,
  `applied` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpermit VALUES("8","Shark Incorporation","Ash Pangcatan","Loan Store","2017-10-11");
INSERT INTO tblpermit VALUES("9","Sharks Inc.","Christopher Mangadlao","Loan Store","2014-02-11");
INSERT INTO tblpermit VALUES("10","Bag's Store","Wimple Aira Umaoeng","Fashion Store","2015-01-04");



#
# Delete any existing table `tblposition`
#

DROP TABLE IF EXISTS `tblposition`;


#
# Table structure of table `tblposition`
#



CREATE TABLE `tblposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblposition VALUES("1","Kapitan");
INSERT INTO tblposition VALUES("2","Kagawad");
INSERT INTO tblposition VALUES("3","Secretary");
INSERT INTO tblposition VALUES("4","Treasurer");
INSERT INTO tblposition VALUES("5","SK Chairman");
INSERT INTO tblposition VALUES("6","SK Kagawad");



#
# Delete any existing table `tblprecinct`
#

DROP TABLE IF EXISTS `tblprecinct`;


#
# Table structure of table `tblprecinct`
#



CREATE TABLE `tblprecinct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precinct` varchar(100) DEFAULT NULL,
  `total_residents` varchar(50) DEFAULT NULL,
  `total_households` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tblpurok`
#

DROP TABLE IF EXISTS `tblpurok`;


#
# Table structure of table `tblpurok`
#



CREATE TABLE `tblpurok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purok` varchar(255) DEFAULT NULL,
  `total_residents` varchar(50) DEFAULT NULL,
  `total_households` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpurok VALUES("14","1-A","274","66");
INSERT INTO tblpurok VALUES("15","1-B","376","105");
INSERT INTO tblpurok VALUES("16","1-B Graceland","245","52");
INSERT INTO tblpurok VALUES("17","1-C","243","74");
INSERT INTO tblpurok VALUES("18","2-A","314","87");
INSERT INTO tblpurok VALUES("19","2-B","300","93");
INSERT INTO tblpurok VALUES("20","3-A","244","73");
INSERT INTO tblpurok VALUES("21","3-B","527","128");
INSERT INTO tblpurok VALUES("22","4-A","151","38");
INSERT INTO tblpurok VALUES("23","4-B","295","73");
INSERT INTO tblpurok VALUES("24","5-A","494","122");
INSERT INTO tblpurok VALUES("25","5-B","559","142");
INSERT INTO tblpurok VALUES("26","6-A","190","45");
INSERT INTO tblpurok VALUES("27","6A-1","386","79");
INSERT INTO tblpurok VALUES("28","6A-2","240","56");
INSERT INTO tblpurok VALUES("29","6A-3","384","77");
INSERT INTO tblpurok VALUES("30","6A-4","226","44");
INSERT INTO tblpurok VALUES("31","6A-5","317","93");
INSERT INTO tblpurok VALUES("32","6B-1","371","77");
INSERT INTO tblpurok VALUES("33","6B-3","440","96");
INSERT INTO tblpurok VALUES("34","6B3-A","298","72");
INSERT INTO tblpurok VALUES("35","6B-4","258","53");
INSERT INTO tblpurok VALUES("36","6B-5","269","60");
INSERT INTO tblpurok VALUES("37","6B-6","525","123");
INSERT INTO tblpurok VALUES("38","6B6-A","157","42");
INSERT INTO tblpurok VALUES("39","6B-7","311","71");
INSERT INTO tblpurok VALUES("40","6B-8","311","56");
INSERT INTO tblpurok VALUES("41","6-C","210","60");
INSERT INTO tblpurok VALUES("42","6-D","185","53");
INSERT INTO tblpurok VALUES("43","7","469","112");
INSERT INTO tblpurok VALUES("44","8-A","560","154");
INSERT INTO tblpurok VALUES("45","8-B","441","104");
INSERT INTO tblpurok VALUES("46","9","551","117");
INSERT INTO tblpurok VALUES("47","10-A","167","50");
INSERT INTO tblpurok VALUES("48","10-B","460","127");
INSERT INTO tblpurok VALUES("49","11","262","67");
INSERT INTO tblpurok VALUES("50","11-A","228","63");
INSERT INTO tblpurok VALUES("51","12","394","109");



#
# Delete any existing table `tblresident`
#

DROP TABLE IF EXISTS `tblresident`;


#
# Table structure of table `tblresident`
#



CREATE TABLE `tblresident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `remarks` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=188 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO tblresident VALUES("183","134981930198","Davao City","27032023163718bg3.png","Gretchen","S.","Sanchez","1-A","Tugbok, Davao City","1991-03-20","31","Married","Female","1-A","Yes","Positive","09272938801","2315123123","N/A","Purok 1-B","1","4ps Requirements");
INSERT INTO tblresident VALUES("181","1231344362362","Davao City","10022023141807bg4.png","Ariel","A.","Suribas","1-A","Davao City","1972-10-25","51","Married","Male","1-A","Yes","Positive","09272938801","1231231351234","N/A","Barangay Los Amigos, Purok 1-A, Tugbok Davao City","1","Bank Requirements");
INSERT INTO tblresident VALUES("187","9879688374123","Davao City","person.png","Gretchen","S.","Sanchez","1-A","Tugbok, Davao City","1991-03-20","31","Married","Female","1-A","Yes","Positive","09272938801","123851393123","N/A","4ps Requirements","1","");

