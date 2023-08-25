# ABMS : MySQL database backup
#
# Generated: Sunday 20. August 2023
# Hostname: localhost
# Database: db_certifast
# --------------------------------------------------------


#
# Delete any existing table `tbl_announcement`
#

DROP TABLE IF EXISTS `tbl_announcement`;


#
# Table structure of table `tbl_announcement`
#



CREATE TABLE `tbl_announcement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `date_posted` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_announcement VALUES("1","SCHOLARSHIP PROGRAM FOR ACADEMIC SY 2023-2024","Ania na ang ginaatangang scholarship program! 
OPEN ONLY FOR INCOMING GRADE 11 STUDENTS
Bisita lang sa opisina ni Kap sa mga buot mag avail.","admin","2023-07-15 12:50:35","2023-07-15");
INSERT INTO tbl_announcement VALUES("3","MASS BLOOD DONATION!","‼️‼️ATENSYON‼️‼️
Inaanyayahan ang lahat na makilahalok sa bloodletting activity na gaganapin sa Barangay Gymnasium sa MAY 9, 2023, Martes sa 6:30 ng umaga. Ito ay pangnguna ng Department of Health Davao Blood Center Regional Field Office XI kaagapay ang Barangay Los Amigos. 
PAALALA:
Kinakailangang  nakatulog ng 8 oras at pataas, kumain ng sapat, at uminom ng maraming tubig ang mga nais maghandog ng dugo. Pinapayuhan din ang mga magbibigay ng dugo na magsuot ng komportableng damit, face mask and face shield. Samantala, hindi naman maaaring magbigay ng dugo ang mga may karamdaman o ang mga kababaihang may buwanang dalaw.
Ayon sa Department of Health, isa sa mga mabuting dulot ng paghahandog ng dugo ay ang pagbaba ng tsansa ng pagakakaroon ng kanser at sakit sa puso.","admin","2023-07-15 13:53:38","2023-05-06");
INSERT INTO tbl_announcement VALUES("8","No more SIM card registration extension","With less than two weeks left, the Department of Information and Communications Technology (DICT) is sticking to the July 25 cutoff for the mandatory SIM (subscriber identity module) card registration after previously extending the compliance period by 90 days.","staff","2023-07-21 13:20:28","2023-07-21");
INSERT INTO tbl_announcement VALUES("9","Toyota Scholarship","Deadline on or before August 4, 2023
For more details, you may contact Ms. Tabaque at 09209578442 or 226-2994.","admin","2023-08-07 13:40:49","2023-08-07");



#
# Delete any existing table `tbl_support`
#

DROP TABLE IF EXISTS `tbl_support`;


#
# Table structure of table `tbl_support`
#



CREATE TABLE `tbl_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_support VALUES("4","Asnida Pangcatan","a.pangcatan.441914@umindanao.edu.ph","09460420068","PASIMULANAMI","SIGI NA PO MASTER","2023-08-06 14:35:32");
INSERT INTO tbl_support VALUES("5","purokleader","cyberlez12345@gmail.com","09272938801","Need Help ASAP!","asa naka","2023-08-08 07:00:39");



#
# Delete any existing table `tbl_user_admin`
#

DROP TABLE IF EXISTS `tbl_user_admin`;


#
# Table structure of table `tbl_user_admin`
#



CREATE TABLE `tbl_user_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `purok` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_user_admin VALUES("20","Wimple Aira Umaoeng","admin","1-A","$2y$10$Ut1OhoJck27n7JxOHvb/Wu5J12QbEKO0qIREB.aqEgFldHMO6MOdi","administrator","08082023205818brgyLA.png","2023-07-13 06:09:12");
INSERT INTO tbl_user_admin VALUES("25","Aileen N. Atino","purokleader","11-A","$2y$10$SO6q8GHO1Sz6uUid4tEpp.wD8N96W6Ow3SU3lJsE4vpiT0Bs76Mgy","purok leader","08082023152053portrait.jpg","2023-07-16 09:02:52");
INSERT INTO tbl_user_admin VALUES("28","staff","staff","1-A","$2y$10$xqNAqtJ0TV6Yu0J3L9LxlulYOEyKBOrV8dI.ge41JcsBL1smbuSem","staff","060820232242241.jpg","2023-08-06 14:42:25");
INSERT INTO tbl_user_admin VALUES("29","John Matubang","staffs","1-B Graceland","$2y$10$4eE6tO83Onv7uDDT9TK.9e.r79sMz2fnJycQLip/uRsAA3CANZXpq","purok leader","16082023224029simul.jpg","2023-08-16 14:40:29");
INSERT INTO tbl_user_admin VALUES("30","Aileen N. Atino","purok1-ALeader","1-A","$2y$10$5CKz5jy3ahn/IMbVNIv9Qu4U9eFfMdtHF.owYSvAhMDkyTQSu.4hK","purok leader","19082023201148pretty-blonde-woman-wearing-white-t-shirt.jpg","2023-08-19 12:11:48");



#
# Delete any existing table `tbl_user_resident`
#

DROP TABLE IF EXISTS `tbl_user_resident`;


#
# Table structure of table `tbl_user_resident`
#



CREATE TABLE `tbl_user_resident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purok` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `verification_code` varchar(255) DEFAULT NULL,
  `verification_send` datetime DEFAULT NULL,
  `account_status` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO tbl_user_resident VALUES("1","1-A","Wimple Aira Umaoeng","cyberlez12345@gmail.com","1-A Los Amigos, Davao City","f4f768bb274afff0668538dc13e77ea3","19082023192221portrait.jpg","resident","bb0317","2023-08-19 19:19:50","verified","2023-08-19");
INSERT INTO tbl_user_resident VALUES("2","1-A","ASNIDA PANGCATAN","a.pangcatan.441914@umindanao.edu.ph","Los Amigos","6fd032c3c0a5e2dcdb641d2b361e4940","","resident","6ec70a","2023-08-19 20:27:32","verified","2023-08-19");



#
# Delete any existing table `tblbirthcert`
#

DROP TABLE IF EXISTS `tblbirthcert`;


#
# Table structure of table `tblbirthcert`
#



CREATE TABLE `tblbirthcert` (
  `birth_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `age` varchar(20) NOT NULL,
  `bdate` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `mother` varchar(50) NOT NULL,
  `father` varchar(50) NOT NULL,
  `requirement` varchar(100) NOT NULL,
  `cert_name` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`birth_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tblbrgy_id`
#

DROP TABLE IF EXISTS `tblbrgy_id`;


#
# Table structure of table `tblbrgy_id`
#



CREATE TABLE `tblbrgy_id` (
  `brgy_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_no` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `purok` varchar(40) NOT NULL,
  `precintno` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `guardian` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `cert_name` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`brgy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tblbrgy_info`
#

DROP TABLE IF EXISTS `tblbrgy_info`;


#
# Table structure of table `tblbrgy_info`
#



CREATE TABLE `tblbrgy_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province_name` varchar(100) DEFAULT NULL,
  `town_name` varchar(100) DEFAULT NULL,
  `brgy_address` varchar(100) NOT NULL,
  `brgy_name` varchar(50) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `brgy_email` varchar(50) DEFAULT NULL,
  `dashboardphoto` varchar(200) DEFAULT NULL,
  `city_logo` varchar(100) DEFAULT NULL,
  `brgy_logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblbrgy_info VALUES("1","Davao","Barangay Los Amigos, Tugbok District","Purok 1-A Barangay, Tugbok, Davao City, 8000 Davao del Sur","Office of Punong Barangay","(082) 228-8984","losamigosdavaocity.gov@gmail.com","28012023073819LogoIcon.png","10022023131914DavaoSeal.png","25032023083959brgyLA.png");



#
# Delete any existing table `tblcertificates`
#

DROP TABLE IF EXISTS `tblcertificates`;


#
# Table structure of table `tblcertificates`
#



CREATE TABLE `tblcertificates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `list_certificates` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `link` varchar(50) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblcertificates VALUES("1","certificate of residency","Barangay residency refers to a person's legal and official status as a resident within a specific barangay (community) in the Philippines.","#addresidency","2023-07-31");
INSERT INTO tblcertificates VALUES("2","barangay clearance","A barangay clearance is a certificate given by the local barangay (village) confirming that a person is a resident of the area and of high moral character.","#addclearance","2023-07-31");
INSERT INTO tblcertificates VALUES("3","certificate of indigency","A government-issued indigency certificate confirms an individual's impoverished status, granting access to social welfare benefits.","#addindigency","2023-07-31");
INSERT INTO tblcertificates VALUES("4","business permit","A business permit is an official document issued by the government that allows a business to operate legally within a specific jurisdiction.","#addpermit","2023-07-31");
INSERT INTO tblcertificates VALUES("5","certificate of good moral","Good moral refers to a person's upright and ethical behavior, reflecting their adherence to societal norms and values.","#addgoodmoral","2023-07-31");
INSERT INTO tblcertificates VALUES("6","certificate of birth","A birth certificate is an official record of a person's birth information, including the person's name, date, and place of birth.
","#addbirth","2023-07-31");
INSERT INTO tblcertificates VALUES("7","family home estate","In order for surviving family members to keep the family home without having to pay estate taxes, there is a tax treatment.","#addfamilytax","2023-07-31");
INSERT INTO tblcertificates VALUES("8","certificate of oath taking","An official document known as a certificate of oath taking attests that a person has made a solemn commitment.
","#addoath","2023-07-31");
INSERT INTO tblcertificates VALUES("9","first time jobseekers","A certificate that grants first-time job seekers in the Philippines special privileges and benefits is known as a Certificate of First-Time Jobseekers.","#addjobseekers","2023-07-31");
INSERT INTO tblcertificates VALUES("10","certificate of live in","Is a legal document that attests to an unmarried couple's cohabitation in a given home.","#addlivein","2023-07-31");
INSERT INTO tblcertificates VALUES("11","barangay identification","The Certificate of Barangay Identification is an official document issued by the local barangay.
","#addbrgyId","2023-08-01");
INSERT INTO tblcertificates VALUES("12","certificate of death","A certificate of death is a legal document that states that someone has passed away.","#adddeath","2023-08-01");



#
# Delete any existing table `tblclearance`
#

DROP TABLE IF EXISTS `tblclearance`;


#
# Table structure of table `tblclearance`
#



CREATE TABLE `tblclearance` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `cert_name` varchar(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `taxno` varchar(50) NOT NULL,
  `requirement` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbldeath`
#

DROP TABLE IF EXISTS `tbldeath`;


#
# Table structure of table `tbldeath`
#



CREATE TABLE `tbldeath` (
  `death_id` int(11) NOT NULL AUTO_INCREMENT,
  `death_person` varchar(50) NOT NULL,
  `death_bdate` date NOT NULL,
  `purok` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `death_date` date NOT NULL,
  `guardian` varchar(50) NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `cert_name` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`death_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tblfamily_tax`
#

DROP TABLE IF EXISTS `tblfamily_tax`;


#
# Table structure of table `tblfamily_tax`
#



CREATE TABLE `tblfamily_tax` (
  `fam_id` int(11) NOT NULL AUTO_INCREMENT,
  `fam_1` varchar(50) NOT NULL,
  `fam_2` varchar(50) NOT NULL,
  `fam_3` varchar(50) NOT NULL,
  `fam_4` varchar(50) NOT NULL,
  `fam_5` varchar(50) NOT NULL,
  `tctno` varchar(50) NOT NULL,
  `cert_name` varchar(50) NOT NULL,
  `requirements` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`fam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tblfirstjob`
#

DROP TABLE IF EXISTS `tblfirstjob`;


#
# Table structure of table `tblfirstjob`
#



CREATE TABLE `tblfirstjob` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `cert_name` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tblgood_moral`
#

DROP TABLE IF EXISTS `tblgood_moral`;


#
# Table structure of table `tblgood_moral`
#



CREATE TABLE `tblgood_moral` (
  `good_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `taxno` varchar(50) NOT NULL,
  `cert_name` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`good_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tblindigency`
#

DROP TABLE IF EXISTS `tblindigency`;


#
# Table structure of table `tblindigency`
#



CREATE TABLE `tblindigency` (
  `indi_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `cert_name` varchar(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `requirements` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`indi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbllive_in`
#

DROP TABLE IF EXISTS `tbllive_in`;


#
# Table structure of table `tbllive_in`
#



CREATE TABLE `tbllive_in` (
  `live_id` int(11) NOT NULL AUTO_INCREMENT,
  `wife` varchar(50) NOT NULL,
  `wife_age` varchar(50) NOT NULL,
  `husband` varchar(50) NOT NULL,
  `husband_age` varchar(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `living_year` varchar(50) NOT NULL,
  `requirements` varchar(50) NOT NULL,
  `cert_name` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`live_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbloath`
#

DROP TABLE IF EXISTS `tbloath`;


#
# Table structure of table `tbloath`
#



CREATE TABLE `tbloath` (
  `oath_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `cert_name` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`oath_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tblofficials`
#

DROP TABLE IF EXISTS `tblofficials`;


#
# Table structure of table `tblofficials`
#



CREATE TABLE `tblofficials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` text DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `termstart` date DEFAULT NULL,
  `termend` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblofficials VALUES("18","26072023170308BALLARTA.jpg","Roberto A. Ballarta","1","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("19","26072023170316BRGYSEC.jpg","Abbie Charlotte Cabig-Sarsale","3","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("20","26072023170603BRGYTREAS.jpg","Melliza Joie Basuga-Tañac","4","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("21","26072023170620NATINO.jpg","Aileen N. Natino","2","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("22","26072023170644CEBALLOS.jpg","Ruel C. Ceballos","2","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("23","26072023225641CONCON.jpg","Loudel B. Concon","2","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("24","26072023225717SANTANDER,ANGELICO.jpg","Angelico T. Santander Jr.","2","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("25","26072023225654DELIQUIÑA.jpg","Ann Liezl G. Deliquiña","2","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("26","26072023171451PUPA.jpg","Raymundo Pupa","2","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("27","26072023171505SANTANDER,ADONIS.jpg","Adonis Santander","2","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("28","26072023171516SUAYBAGUIO.jpg","Arlene D. Suaybaguio","2","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("29","26072023171526SAMPADONG.jpg","Rowen Sampadong","5","1-A","2018-07-02","2024-07-10","Active");
INSERT INTO tblofficials VALUES("30","04072023203349person.png","Karol Jean Pilongo","6","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("31","04072023203349person.png","Alien Rey Basa","6","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("32","04072023203349person.png","Gladys Calicdan","6","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("33","04072023203349person.png","Kim Sitchon","6","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("34","04072023203349person.png","Adrian Bibat","6","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("35","04072023203349person.png","Nico Tabaranza","6","1-A","2018-07-02","2024-07-02","Active");
INSERT INTO tblofficials VALUES("36","04072023203349person.png","Roxanne Joy Marie Gelicame","6","1-A","2018-07-02","2024-07-02","Active");



#
# Delete any existing table `tblpayments`
#

DROP TABLE IF EXISTS `tblpayments`;


#
# Table structure of table `tblpayments`
#



CREATE TABLE `tblpayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_id` varchar(50) DEFAULT NULL,
  `details` varchar(100) DEFAULT NULL,
  `amounts` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tblpermit`
#

DROP TABLE IF EXISTS `tblpermit`;


#
# Table structure of table `tblpermit`
#



CREATE TABLE `tblpermit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permit_number` varchar(50) NOT NULL,
  `business_name` varchar(80) DEFAULT NULL,
  `owner1` varchar(200) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `applied` date DEFAULT current_timestamp(),
  `community_tax` varchar(50) NOT NULL,
  `issued_on` date NOT NULL DEFAULT current_timestamp(),
  `issued_at` varchar(50) NOT NULL,
  `validation` date DEFAULT NULL,
  `cert_name` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `req_email` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




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
  `purok_leader` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpurok VALUES("14","1-A","274","66","Miguel Mendoza","+63 000 000 0000");
INSERT INTO tblpurok VALUES("15","1-B","376","105","Isabela Fernandez","+63 000 000 0000");
INSERT INTO tblpurok VALUES("16","1-B Graceland","245","52","Andres Martinez","");
INSERT INTO tblpurok VALUES("17","1-C","243","74","Luisa Aquino","");
INSERT INTO tblpurok VALUES("18","2-A","314","87","Carolina Pascual","");
INSERT INTO tblpurok VALUES("19","2-B","300","93","Antonio Mercado","");
INSERT INTO tblpurok VALUES("20","3-A","244","73","Angelica Reyes","");
INSERT INTO tblpurok VALUES("21","3-B","527","128","Carlos Co","");
INSERT INTO tblpurok VALUES("22","4-A","151","38","Patricia Lim","");
INSERT INTO tblpurok VALUES("23","4-B","295","73","Ricardo Castro","");
INSERT INTO tblpurok VALUES("24","5-A","494","122","Rosario Santos","");
INSERT INTO tblpurok VALUES("25","5-B","559","142","Felipe Bautista","");
INSERT INTO tblpurok VALUES("26","6-A","190","45","Margarita Sison","");
INSERT INTO tblpurok VALUES("27","6A-1","386","79","Beatriz Ocampo","");
INSERT INTO tblpurok VALUES("28","6A-2","240","56","Fernando Aguilar","");
INSERT INTO tblpurok VALUES("29","6A-3","384","77","Amelia Cruz","");
INSERT INTO tblpurok VALUES("30","6A-4","226","44","Gabriel Manalo","");
INSERT INTO tblpurok VALUES("31","6A-5","317","93","Estrella Pineda","");
INSERT INTO tblpurok VALUES("32","6B-1","371","77","Simon Yap","");
INSERT INTO tblpurok VALUES("33","6B-3","440","96","Maximo Reyes","");
INSERT INTO tblpurok VALUES("34","6B3-A","298","72","Teresa Dela Cruz","");
INSERT INTO tblpurok VALUES("35","6B-4","258","53","Ignacio Santos","");
INSERT INTO tblpurok VALUES("36","6B-5","269","60","Felicitas Lim","");
INSERT INTO tblpurok VALUES("37","6B-6","525","123","Santiago Tan","");
INSERT INTO tblpurok VALUES("38","6B6-A","157","42","Victoriano Reyes","");
INSERT INTO tblpurok VALUES("39","6B-7","311","71","Dolores Rivera","");
INSERT INTO tblpurok VALUES("40","6B-8","311","56","Rodolfo Santos","");
INSERT INTO tblpurok VALUES("41","6-C","210","60","Alfredo Reyes","");
INSERT INTO tblpurok VALUES("42","6-D","185","53","Cecilia Santos","");
INSERT INTO tblpurok VALUES("43","7","469","112","Juan Santos","");
INSERT INTO tblpurok VALUES("44","8-A","560","154","Maria Cruz","");
INSERT INTO tblpurok VALUES("45","8-B","441","104","Jose Garcia","");
INSERT INTO tblpurok VALUES("46","9","551","117","Ana Reyes","");
INSERT INTO tblpurok VALUES("47","10-A","167","50","Pedro Lopez","");
INSERT INTO tblpurok VALUES("48","10-B","460","127","Mariana Gonzales","");
INSERT INTO tblpurok VALUES("49","11","262","67","Emilio Torres","");
INSERT INTO tblpurok VALUES("50","11-A","228","63","Aileen N. Atino","");
INSERT INTO tblpurok VALUES("51","12","394","109","Ramon Ramos","");



#
# Delete any existing table `tblpurok_records`
#

DROP TABLE IF EXISTS `tblpurok_records`;


#
# Table structure of table `tblpurok_records`
#



CREATE TABLE `tblpurok_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `national_id` varchar(100) DEFAULT NULL,
  `citizenship` varchar(50) DEFAULT NULL,
  `picture` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birthplace` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `civilstatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `purok` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `voterstatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `taxno` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `resident_type` int(11) DEFAULT 1,
  `purpose` text DEFAULT NULL,
  `residency_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1027 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO tblpurok_records VALUES("401","7020040824-0730","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Caloocan","1988-12-01","34","Separated","Female","1-A","Yes","000123 456401","9576866780","kre7gk3wkr@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("402","0819970917-0684","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Tuguegarao","1988-11-05","34","Separated","Female","1-A","Yes","000123 456402","9677901530","p6u56dxsnz@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("403","8319910915-9191","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Kabugao","1988-03-18","35","Single","Female","1-A","Yes","000123 456403","9576343972","19rvjt0tda@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("405","9919850905-0561","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Antipolo","2000-01-03","23","Single","Female","1-A","Yes","000123 456405","9872918432","gr8n632crn@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("406","0719641014-4755","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","","1983-11-23","39","Separated","Female","7","Yes","000123 456406","9378128811","75zf7ykup3@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("407","4620000303-2778","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","General Santos","1984-10-05","38","Single","Female","6A-5","Yes","000123 456407","9775367197","ie5uia6ojx@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("409","7219940506-0927","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Borongan","1989-09-11","33","Separated","Female","6A-5","Yes","000123 456409","9478429028","as06n3h4x6@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("410","6319860328-4567","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Urdaneta","1976-01-17","47","Separated","Female","12","Yes","000123 456410","9674708839","bgvyiugpo3@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("411","4919970218-8493","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Tagbilaran","1999-09-27","23","Single","Female","3-B","Yes","000123 456411","9876130612","cz6o2or3sa@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("412","4919700809-6380","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Cabanatuan","1978-01-02","45","Separated","Female","6B3-A","Yes","000123 456412","9472124260","1w3tpthy3n@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("413","4019640919-8145","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Malolos","1985-12-23","37","Separated","Female","6B-8","Yes","000123 456413","9276732990","ifhyqw1gqp@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("414","7719680320-2801","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Surigao City","1984-10-16","38","Single","Female","11","Yes","000123 456414","9171516455","2es034ngea@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("415","8920021207-2936","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Talisay","1999-10-27","23","Married","Female","4-B","Yes","000123 456415","9473369482","8wx8vusdmb@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("416","3719700501-6917","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Cadiz","1991-03-01","32","Single","Female","6B-5","Yes","000123 456416","9474649385","ky547pr5oi@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("417","1320040709-3429","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Laoag","1983-05-15","40","Single","Female","10-B","Yes","000123 456417","9876441378","et35zfamvu@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("418","6319950912-7599","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Tabaco","1973-01-09","50","Single","Female","6-D","Yes","000123 456418","9874314187","luv5vipib4@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("419","8219690204-5771","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Pili","1986-02-21","37","Separated","Female","6-C","Yes","000123 456419","9879559728","zjw9ji4g8l@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("420","5719861212-1645","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Iloilo City","1990-01-23","33","Separated","Female","3-B","Yes","000123 456420","9177837853","y5nciahpio@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("421","8419760116-8961","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Angeles","1994-02-12","29","Separated","Female","6B-5","Yes","000123 456421","9474543711","94eefiv12l@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("422","9119850508-5828","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Romblon","1983-09-18","39","Single","Female","6A-2","Yes","000123 456422","9579794473","x1cg3bc0x0@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("423","7219941018-3197","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Kabacan","1999-08-16","23","Married","Female","1-C","Yes","000123 456423","9274832772","lr1gttq78q@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("424","7519970812-8011","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Meycauayan","1988-01-19","35","Married","Female","6B-1","Yes","000123 456424","9677516878","t85ww2nnzq@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("425","3919691207-2192","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Canlaon","1990-07-10","32","Single","Female","3-B","Yes","000123 456425","9874812979","wrfdvjxwwh@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("426","2919890724-9036","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Bago","1991-10-06","31","Separated","Female","10-A","Yes","000123 456426","9272484745","lwxygxrq4q@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("427","4419970304-3472","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Kabugao","1980-09-10","42","Married","Female","3-A","Yes","000123 456427","9278916877","ehycz6ku94@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("428","7119640505-1972","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Pili","1996-10-05","26","Single","Female","11-A","Yes","000123 456428","9278323845","7jkeezqwec@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("429","7719840918-8603","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Tuguegarao","1991-12-10","31","Married","Female","6B6-A","Yes","000123 456429","9772332239","fw84fpm52s@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("430","1619750514-5404","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Makati","1978-10-20","44","Single","Female","6B3-A","Yes","000123 456430","9174338217","9bybg963mb@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("431","2119720628-2167","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Manila","1986-03-01","37","Married","Female","6A-5","Yes","000123 456431","9177752575","7xd0iycnuf@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("432","0919861104-1779","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Bacolod","1989-12-19","33","Married","Female","1-C","Yes","000123 456432","9173348856","wt9p9vjbkm@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("433","0719980805-0124","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Iloilo City","1985-06-03","38","Married","Female","6-C","Yes","000123 456433","9176320883","pftli1pg7f@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("434","4419610318-6450","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Dasmariñas","1973-06-23","50","Married","Female","3-A","Yes","000123 456434","9873755137","ywql6zdobj@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("435","8819930916-4611","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Calapan","2001-07-09","21","Separated","Female","5-B","Yes","000123 456435","9776244614","so2oyftjmq@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("437","0319720911-7530","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Tuguegarao","1986-06-25","37","Separated","Female","6B3-A","Yes","000123 456437","9873314056","8qyh0w6yv1@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("438","3619620312-9657","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Bacolod","1980-02-20","43","Single","Female","4-A","Yes","000123 456438","9177892067","psob1w2pro@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("439","8519950418-0256","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Calamba","1985-03-16","38","Separated","Female","6B6-A","Yes","000123 456439","9471412507","k7bn11cxmk@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("440","8619890701-7026","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Cagayan de Oro","1987-09-05","35","Single","Female","6-D","Yes","000123 456440","9173126733","uclzmdcwmr@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("441","6119881228-5059","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Tuguegarao","1988-10-07","34","Married","Female","1-C","Yes","000123 456441","9377124418","o3t5dhalbr@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("442","1819990914-6979","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Cabanatuan","1973-10-12","49","Separated","Female","12","Yes","000123 456442","9578716651","lahvl79g8o@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("443","6019671024-9158","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Bacoor","2001-03-29","22","Single","Female","3-B","Yes","000123 456443","9677260709","8jn46d7kg4@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("444","2620031007-8235","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Urdaneta","1980-07-14","42","Married","Female","3-A","Yes","000123 456444","9177956431","i98fj56584@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("445","3319861027-9726","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Taguig","1987-09-08","35","Married","Female","8-B","Yes","000123 456445","9876837090","ytdipcc1p8@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("446","5319850602-5808","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Kabankalan","1995-04-05","28","Married","Female","10-B","Yes","000123 456446","9877633169","m4k1yj2f7f@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("447","7719600312-4876","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Koronadal","1999-12-28","23","Separated","Female","3-B","Yes","000123 456447","9579253923","pw6s49vfjh@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("448","6319670827-0889","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Ozamiz","1981-01-15","42","Separated","Female","2-A","Yes","000123 456448","9376693229","lmln2qjsb3@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("449","4919741003-1403","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","San Carlos","1989-10-13","33","Separated","Female","6B-7","Yes","000123 456449","9572036639","2r8lnng8yz@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("450","3519910817-1135","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","San Carlos","1973-06-21","50","Single","Female","2-B","Yes","000123 456450","9475282159","h5ffllk70r@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("451","5719880122-5605","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Dumaguete","1973-01-29","50","Married","Female","6A-2","Yes","000123 456451","9276737020","5rcwrd9jzg@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("452","6119910309-1297","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Trece Martires","1991-12-21","31","Single","Female","4-B","Yes","000123 456452","9472119034","01gsu6u3n4@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("453","6420001217-5341","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Lipa","1993-10-31","29","Separated","Female","6A-4","Yes","000123 456453","9178914507","15qdwymhio@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("454","8119631122-3541","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Mandaue","1981-02-02","42","Single","Female","6A-5","Yes","000123 456454","9677537549","hvkaap3rct@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("455","1319930907-0104","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Angeles","1974-08-11","48","Married","Female","6A-4","Yes","000123 456455","9278351172","ax0drqafd6@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("456","7919860524-6202","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Kidapawan","1988-04-25","35","Single","Female","11","Yes","000123 456456","9872285768","tm5pfjav5t@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("457","2019871214-0025","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Dasmariñas","1982-09-16","40","Single","Female","2-B","Yes","000123 456457","9375587198","wdv68t5096@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("458","3620051115-4954","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","San Jose","1998-01-03","25","Single","Female","5-B","Yes","000123 456458","9872688328","ttbeyfha31@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("459","3719710328-0043","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Batangas City","1999-07-24","23","Single","Female","6B-4","Yes","000123 456459","9872889074","buzywxjuzf@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("460","5719641013-2987","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Tabaco","1987-10-25","35","Married","Female","10-B","Yes","000123 456460","9378665184","1zdfvybain@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("461","1619950113-0595","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Malolos","1992-02-19","31","Separated","Female","9","Yes","000123 456461","9772385690","fxd56ls28a@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("462","9219720313-1256","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Samal","1987-10-22","35","Separated","Female","6B-3","Yes","000123 456462","9271899489","ib3fjgoece@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("463","2119830628-1587","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Meycauayan","1981-04-03","42","Single","Female","3-B","Yes","000123 456463","9275324243","cmskib43te@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("465","5719891126-9604","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Bago","1976-01-04","47","Single","Female","6B-4","Yes","000123 456465","9479921575","v0tw5vqkas@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("466","1220050922-0873","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Tabaco","1993-03-22","30","Single","Female","6A-5","Yes","000123 456466","9277648417","tk9dhq8u2f@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("467","4120000522-7621","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Laoag","2001-08-01","21","Married","Female","6B-4","Yes","000123 456467","9173048359","dnw12xrfx2@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("468","9319860324-9494","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Malabon","1973-12-07","49","Separated","Female","7","Yes","000123 456468","9877287749","jnhleffyjt@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("469","9219820109-8036","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Baguio","2001-02-10","22","Single","Female","11-A","Yes","000123 456469","9774196774","yii2i0ws3t@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("470","5019950427-6185","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Bacoor","1999-12-06","23","Married","Female","6B-1","Yes","000123 456470","9575588704","9lnmc4hw0c@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("471","8219971104-8300","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Sagay","2000-02-10","23","Single","Female","6-D","Yes","000123 456471","9274965675","uexxeq9ohf@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("472","0519800411-1942","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Himamaylan","1998-07-22","24","Separated","Female","6B-1","Yes","000123 456472","9376419943","7asag24mab@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("473","7019751204-6080","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Davao City","1980-12-05","42","Separated","Female","2-B","Yes","000123 456473","9174107797","j2ueoegrsn@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("474","2119811010-8446","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Iriga","1973-03-16","50","Married","Female","6A-3","Yes","000123 456474","9372729646","v1by9u32lx@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("475","6519630704-0331","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","San Jose","1983-01-30","40","Single","Female","11","Yes","000123 456475","9377661833","dost8ydt76@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("476","3619650115-1959","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Antipolo","1976-08-08","46","Single","Female","6B6-A","Yes","000123 456476","9475152135","cjej2702b9@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("477","0520000222-2927","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Mati","1997-09-01","25","Single","Female","6B-4","Yes","000123 456477","9178356250","sym096qlnc@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("478","1819840820-0397","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","San Fernando","1975-09-04","47","Separated","Female","6B-1","Yes","000123 456478","9672624078","s9ycvtuyvh@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("479","2019760824-4044","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Pili","1989-03-26","34","Separated","Female","6B3-A","Yes","000123 456479","9674590639","fxg6i3qij2@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("480","7819951110-1119","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Butuan","1989-09-09","33","Married","Female","11","Yes","000123 456480","9571673186","5esbrnbnz2@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("481","1819770217-6189","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Marawi","1985-02-03","38","Single","Female","4-B","Yes","000123 456481","9675461811","qfb9h9s77f@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("482","4319900610-6209","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","General Trias","1997-10-07","25","Separated","Female","11-A","Yes","000123 456482","9271473556","lrn2jddgiv@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("483","8919960502-5548","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Virac","1974-07-25","48","Separated","Female","6A-5","Yes","000123 456483","9371319275","9h63td6y06@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("484","5019760305-6732","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Cabanatuan","1988-04-06","35","Single","Female","5-A","Yes","000123 456484","9471529272","dz2rihba7o@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("485","2119870427-0709","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Calapan","1987-10-31","35","Single","Female","6B-5","Yes","000123 456485","9479659405","4fikr1h081@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("486","4919600101-0960","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Taguig","1994-04-28","29","Single","Female","6-A","Yes","000123 456486","9574425597","dyf6nf6vlc@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("487","1419611226-6358","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","San Juan","1991-04-29","32","Separated","Female","6B-4","Yes","000123 456487","9272968434","79xcbg7ry8@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("488","8719730307-2999","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Quezon City","1978-08-24","44","Single","Female","6A-5","Yes","000123 456488","9575283640","xad5n8kemi@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("489","0719931015-3082","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Calbayog","1999-03-11","24","Separated","Female","6B-1","Yes","000123 456489","9372879510","8bvzyuz3h0@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("490","8620000914-9673","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Cebu City","1998-03-05","25","Married","Female","6A-5","Yes","000123 456490","9171243597","xfoynzk3qm@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("491","5019610413-9093","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Santiago","1990-06-27","33","Single","Female","8-A","Yes","000123 456491","9673282245","8z89ez7hut@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("493","3319801215-3080","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Urdaneta","1981-02-11","42","Married","Female","6B-5","Yes","000123 456493","9471805880","dujr922vo2@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("494","5919690713-0427","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Bogo","1996-10-11","26","Single","Female","11","Yes","000123 456494","9475684435","5odc5k9amn@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("495","6120051122-7516","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Sorsogon City","1986-03-18","37","Married","Female","6A-1","Yes","000123 456495","9379841647","b18tzw20yl@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("496","0219850119-9438","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Legazpi","1982-03-27","41","Single","Female","6-D","Yes","000123 456496","9871239678","gz0meuue8o@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("497","8719930612-9090","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Santa Maria","1985-05-26","38","Separated","Female","6B-1","Yes","000123 456497","9577194436","ovb32h4x8e@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("498","8419830718-3871","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Silay","2001-09-09","21","Single","Female","6B-7","Yes","000123 456498","9379011080","oviy8urs1f@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("499","9019890203-5522","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Bacoor","1974-08-07","48","Separated","Female","6B-3","Yes","000123 456499","9777622458","gj8e1ftm11@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("500","7519640201-4176","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Legazpi","1979-08-04","43","Married","Female","2-A","Yes","000123 456500","9377134563","hrfvohl8q9@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("501","6720020407-2979","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Tabuk","1986-12-02","36","Single","Female","9","Yes","000123 456501","9675016058","8yebi1jmxs@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("502","6719830520-4659","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Pagadian","1975-09-20","47","Married","Female","6B-5","Yes","000123 456502","9375350006","wbj5w6tj41@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("503","8319711223-3475","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Makati","1972-09-09","50","Single","Female","6B-8","Yes","000123 456503","9373083969","qhc8l1xlcf@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("504","1519660304-3407","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Surigao City","1982-01-16","41","Married","Female","6B-4","Yes","000123 456504","9376899077","55roiqfmna@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("505","9519670822-1980","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Zamboanga","1988-11-29","34","Single","Female","6B-5","Yes","000123 456505","9671166882","w0zwlz8r3v@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("506","4619650904-1450","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Iloilo City","1980-11-08","42","Married","Female","6B-5","Yes","000123 456506","9175348012","msya1smy8w@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("507","1019781118-2942","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","San Pablo","1997-06-26","26","Married","Female","6B-6","Yes","000123 456507","9178632220","wv2t7m9squ@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("508","7420001028-9524","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Samal","1975-07-01","48","Married","Female","12","Yes","000123 456508","9872704080","dqq9qarum1@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("509","3619681112-4100","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Tuguegarao","1996-05-06","27","Married","Female","6A-1","Yes","000123 456509","9272817581","rypvkllyca@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("510","0919760124-5132","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Isabela","1994-12-24","28","Married","Female","6A-5","Yes","000123 456510","9471427276","y1tlvztypz@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("511","2819960606-7733","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Puerto Princesa","1997-01-17","26","Single","Female","3-B","Yes","000123 456511","9876313887","hcnbfd32w6@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("512","1419770108-8073","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Bacoor","1976-04-23","47","Married","Female","1-C","Yes","000123 456512","9277804518","jopomb5dcg@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("513","2919930907-0411","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Iloilo City","1979-02-05","44","Single","Female","10-A","Yes","000123 456513","9571586090","xmoypxjqev@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("514","4219980813-4379","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Cebu City","1981-10-29","41","Single","Female","11","Yes","000123 456514","9472356605","8cz02t7v99@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("515","3619740922-0891","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Calapan","1982-08-05","40","Married","Female","6B6-A","Yes","000123 456515","9875340571","5ktaejohq3@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("516","8419810523-0208","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Daet","1980-08-15","42","Married","Female","6A-5","Yes","000123 456516","9178360243","lr0erwfbo3@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("517","3819640805-2950","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Calamba","1973-11-09","49","Single","Female","4-A","Yes","000123 456517","9772972272","gcr13em3rs@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("518","8820000423-2432","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Pili","1975-09-06","47","Married","Female","6A-4","Yes","000123 456518","9475010999","fk2u1plcta@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("519","8119930917-6355","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Tayabas","1996-04-13","27","Single","Female","6-A","Yes","000123 456519","9271844969","82uub04dul@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("521","6219751012-9476","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Bongao","1997-01-01","26","Married","Female","10-B","Yes","000123 456521","9276880822","86jnpqk4s1@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("522","9820030122-2125","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","San Carlos","1977-06-17","46","Single","Female","8-A","Yes","000123 456522","9777980726","2lhfq7ppwy@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("523","6119830506-5696","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Cebu City","1989-02-08","34","Single","Female","6A-5","Yes","000123 456523","9871574565","b2zjugyxkn@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("524","7119770412-1715","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","San Juan","1974-12-14","48","Married","Female","6B-4","Yes","000123 456524","9873066376","l4m1axt5qc@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("525","1519780305-2228","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Iloilo City","1984-01-12","39","Married","Female","5-A","Yes","000123 456525","9471215057","uuk5631xdn@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("526","2819751010-1147","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Cabanatuan","1979-06-20","44","Single","Female","7","Yes","000123 456526","9675434346","76hed8xk2b@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("527","6319600811-7722","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Zamboanga","1973-03-24","50","Married","Female","5-B","Yes","000123 456527","9277966506","hebum2459q@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("528","6919690305-3913","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Calapan","1977-11-29","45","Single","Female","1-C","Yes","000123 456528","9179815030","0maaeziweh@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("529","6919881122-0334","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","General Trias","1975-07-14","47","Married","Female","8-A","Yes","000123 456529","9573510071","umpm6zfa4b@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("530","4619920303-2453","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","San Juan","1975-04-27","48","Single","Female","4-B","Yes","000123 456530","9374858484","rf6ba4r846@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("531","8019810409-5037","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Tuguegarao","2002-12-25","20","Married","Female","2-B","Yes","000123 456531","9377991121","bx9evqmm19@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("532","6519901126-9661","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","General Santos","1996-10-01","26","Married","Female","6-D","Yes","000123 456532","9171597071","nl9keag6kr@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("533","2319660116-5275","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Isabela","2001-08-13","21","Single","Female","6B-5","Yes","000123 456533","9679832604","qc8wljmbrl@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("534","4719690815-2038","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Taguig","1975-02-19","48","Single","Female","6-C","Yes","000123 456534","9176409311","h6oxs2kg3r@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("535","5419800217-6178","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Sipalay","1982-01-30","41","Married","Female","6-C","Yes","000123 456535","9471476477","h2ass3os77@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("536","1119660819-1059","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Baguio","1983-09-27","39","Single","Female","4-B","Yes","000123 456536","9276312811","sj5i6qp7tj@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("537","1620001227-1687","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Valenzuela","2000-04-17","23","Single","Female","10-B","Yes","000123 456537","9778659235","yxj9huf5nf@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("538","3919701006-8515","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Digos","2002-09-25","20","Married","Female","6B3-A","Yes","000123 456538","9877266258","w3vnql4nir@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("539","7019730913-5657","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","San Juan","1993-06-27","30","Single","Female","6-C","Yes","000123 456539","9774070408","12a48gv4uw@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("540","2519750628-7505","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Sorsogon","1972-01-24","51","Single","Female","6B-3","Yes","000123 456540","9672710504","p8htxjyey3@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("541","5819770826-8469","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","General Santos","1994-02-01","29","Single","Female","11","Yes","000123 456541","9775179574","7rqjrf17i4@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("542","0419981101-7747","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Valenzuela","2000-04-16","23","Single","Female","11-A","Yes","000123 456542","9679014845","57mrvr2bev@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("543","7819770217-8617","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Calbayog","1997-12-07","25","Married","Female","6B-7","Yes","000123 456543","9374472625","qp0ytxcf9t@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("544","0119740611-5847","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Tandag","1988-05-02","35","Single","Female","9","Yes","000123 456544","9475558866","seg0mw64x4@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("545","2319650919-3759","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Gapan","1990-03-02","33","Married","Female","6-D","Yes","000123 456545","9672488586","gwjkf5ebbu@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("546","2919820328-4785","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Urdaneta","2002-04-19","21","Married","Female","6-D","Yes","000123 456546","9172500689","uucjeqs2tc@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("547","6619610728-4923","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Samal","1998-03-21","25","Single","Female","6-A","Yes","000123 456547","9678308548","bxwbxx6j9u@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("549","5219650711-1088","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Tabuk","1982-12-29","40","Married","Female","6B-6","Yes","000123 456549","9277544671","755yibt2fu@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("550","1220040212-1364","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Bogo","1998-07-23","24","Married","Female","10-B","Yes","000123 456550","9576934402","qpjxb4qjeg@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("551","3019650122-4507","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Santiago","1975-08-30","47","Married","Female","6A-1","Yes","000123 456551","9874428895","mpr6tu8k5y@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("552","5919981004-5699","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Baguio","1980-01-30","43","Married","Female","11-A","Yes","000123 456552","9872536169","ce5m4t86iz@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("553","1519680828-8994","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Cotabato City","1988-06-22","35","Married","Female","12","Yes","000123 456553","9778077584","ercp7mpvx3@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("554","7419840810-5538","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Sorsogon","1991-03-09","32","Married","Female","6B-1","Yes","000123 456554","9576685410","3i1dctxmah@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("555","9220040101-7805","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Mati","1981-01-09","42","Single","Female","6A-3","Yes","000123 456555","9475344106","7eqzs73kda@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("556","1619620321-9783","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","General Trias","1999-12-08","23","Single","Female","11","Yes","000123 456556","9372001330","lqy44regpu@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("557","9919790525-6266","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Legazpi","1989-07-05","33","Married","Female","8-A","Yes","000123 456557","9577573751","s2r78fgvy5@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("558","2819650611-6791","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","San Pablo","1994-02-26","29","Single","Female","5-B","Yes","000123 456558","9871764429","1i7d7jemn7@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("559","9619990305-9999","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Makati","1982-04-06","41","Married","Female","3-A","Yes","000123 456559","9571423846","3yn2vlunql@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("560","7619880624-4130","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Muntinlupa","1994-09-30","28","Married","Female","9","Yes","000123 456560","9176915289","dj3c5nbp7v@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("561","8119810919-1302","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Tayabas","2001-03-24","22","Single","Female","6A-1","Yes","000123 456561","9777105646","ufnt9uo5ra@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("562","9219810720-8522","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Kidapawan","1983-12-21","39","Single","Female","6A-2","Yes","000123 456562","9377996390","or5jr29ioe@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("563","5819690827-3605","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Cabanatuan","1998-09-21","24","Single","Female","2-A","Yes","000123 456563","9276759895","nninbewpg4@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("564","1319981204-2194","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Dapitan","1976-11-12","46","Single","Female","9","Yes","000123 456564","9179365680","5xodn411i0@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("565","4519910203-0560","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Mabalacat","1995-07-24","27","Single","Female","3-A","Yes","000123 456565","9274751111","pl2fyrofie@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("566","6419610707-4984","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Kawit","1983-12-22","39","Married","Female","3-A","Yes","000123 456566","9174225688","i060ril2z6@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("567","3319730310-3588","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","San Carlos","1991-10-16","31","Married","Female","1-C","Yes","000123 456567","9578408634","x1arcznvqe@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("568","3819911204-8890","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Cadiz","1989-01-28","34","Single","Female","4-A","Yes","000123 456568","9578627181","61q05lclt7@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("569","3219700415-7184","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Mandaue","1989-05-06","34","Married","Female","2-A","Yes","000123 456569","9374967995","j3se7ykg8e@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("570","8019830723-3674","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","General Trias","1977-04-03","46","Married","Female","6A-3","Yes","000123 456570","9777137607","o6bz041yaw@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("571","1519920819-6457","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Zamboanga City","1987-09-06","35","Married","Female","9","Yes","000123 456571","9172827112","y2c3vi3gwa@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("572","7519640423-0813","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Lapu-Lapu","1985-02-24","38","Married","Female","6B3-A","Yes","000123 456572","9671762707","s6r8kni0o8@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("573","3219800121-7971","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez(DOB:","Tugbok, Los Amigos","Calamba","1978-08-16","44","Single","Female","9","Yes","000123 456573","9571182958","vn5xbby221@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("574","2219661116-2996","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Sorsogon","1992-07-10","30","Single","Female","6B-7","Yes","000123 456574","9477331158","7ovw372lsi@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("575","2619600513-9803","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Dasmariñas","1981-10-18","41","Single","Female","12","Yes","000123 456575","9871669559","a83b99h494@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("577","5519880414-3629","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Santa Rosa","1975-10-12","47","Married","Female","6A-2","Yes","000123 456577","9275642630","xmkytdhb5z@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("578","0920050227-5112","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Manila","1974-04-26","49","Single","Female","8-A","Yes","000123 456578","9671934606","hvyq9ik3p7@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("579","3619920415-1122","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Guihulngan","2000-04-20","23","Single","Female","2-A","Yes","000123 456579","9871282387","ko0kt537u2@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("580","4919610120-5536","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Ormoc","1991-05-02","32","Married","Female","6-A","Yes","000123 456580","9774056079","f9v9n8ne07@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("581","4219650120-3531","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Zamboanga","1983-11-28","39","Married","Female","9","Yes","000123 456581","9774996107","gapzz6z0hg@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("582","3819630427-2238","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Cabanatuan","1986-05-17","37","Married","Female","12","Yes","000123 456582","9172722341","ioqkb8x0id@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("583","2819701001-1813","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","GuihulnganMalolos","2001-04-16","22","Single","Female","3-B","Yes","000123 456583","9277021820","3dh0dnx2ns@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("584","0819731106-9646","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Baybay","1979-07-25","43","Married","Female","6B-4","Yes","000123 456584","9779689973","mes7c8xkes@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("585","3919800913-6967","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Mati","1999-09-08","23","Married","Female","2-B","Yes","000123 456585","9471078277","q3g3o9mp8h@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("586","6420040105-6152","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Bacolod","1991-07-12","31","Married","Female","2-B","Yes","000123 456586","9777402182","2evrl1xax1@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("587","7120040909-6014","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Urdaneta","1978-06-15","45","Married","Female","4-A","Yes","000123 456587","9572006334","58s7f0thjm@yahoo.com",">","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("588","0219830213-3714","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Tagbilaran","1991-04-25","32","Single","Female","7","Yes","000123 456588","9172079083","1hf38bi6kv@gmail.com","Vendor","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("589","8419701019-6442","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Kabugao","1997-05-26","26","Married","Female","4-A","Yes","000123 456589","9877910545","f9v5yvl0ga@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("590","1119910820-9441","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Cadiz","1993-03-05","30","Married","Female","9","Yes","000123 456590","9177822426","g3vqyxxne0@gmail.com","Merchandiser","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("591","5219910622-5382","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Pagadian","1981-09-02","41","Single","Female","6A-1","Yes","000123 456591","9177485988","hn7imvm7p0@gmail.com","Manager","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("592","0619931206-2726","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Cadiz","1986-08-09","36","Married","Female","5-A","Yes","000123 456592","9778141739","j9rvc0z857@gmail.com","Cashier","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("593","6919770121-8835","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","San Jose","1972-02-14","51","Married","Female","6B-4","Yes","000123 456593","9773502295","x2xkbvkog7@yahoo.com","Call Center","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("594","6620030608-8711","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Santa Maria","1983-06-07","40","Single","Female","5-A","Yes","000123 456594","9276681322","sigzj8z4sq@gmail.com","Tricyle Driver","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("595","3619751022-5382","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Pasay","1986-04-21","37","Married","Female","3-B","Yes","000123 456595","9475559793","nylfc847s9@yahoo.com","Teacher","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("596","7519820417-5707","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Trece Martires","1988-02-11","35","Married","Female","1-C","Yes","000123 456596","9278049255","emubpaow47@yahoo.com","Vendor","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("597","9119730708-6040","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Kabankalan","1974-01-28","49","Married","Female","6-C","Yes","000123 456597","9576750688","cwmlu7wq4f@gmail.com","Cashier","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("598","0820000428-8404","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Urdaneta","1997-03-17","26","Single","Female","9","Yes","000123 456598","9376853874","i7e3m32hvc@gmail.com","Call Center","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("599","1619690817-8741","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Kabacan","1975-09-14","47","Single","Female","1-C","Yes","000123 456599","9376574929","rmxjvu2p18@yahoo.com","Businessman","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("600","6619951220-4151","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Davao City","2002-04-07","21","Single","Female","4-A","Yes","000123 456600","9177334385","xxijlkjv5l@yahoo.com","Vendor","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("601","7019841128-7350","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Calbayog","1974-10-12","48","Single","Female","6B-1","Yes","000123 456601","9874697702","i6hqcth0ah@gmail.com","Vendor","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("602","7919830801-7951","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Gapan","2000-11-10","22","Married","Female","12","Yes","000123 456602","9678251301","5yflpgvmof@yahoo.com","Driver","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("603","0119710115-1664","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Valencia","1987-12-25","35","Single","Female","6B-7","Yes","000123 456603","9273067912","igs5onibj3@gmail.com","Teacher","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("605","2719810403-9657","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Daet","1974-04-03","49","Single","Female","5-A","Yes","000123 456605","9877086629","l73uksl2hs@yahoo.com","Merchandiser","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("606","7719840918-4675","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Zamboanga","1974-11-09","48","Married","Female","3-A","Yes","000123 456606","9474087242","2iyrfq2fa0@gmail.com","Vendor","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("607","5619631213-1681","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Trece Martires","1974-05-06","49","Married","Female","6A-3","Yes","000123 456607","9773290952","up0d05231d@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("608","1819600615-4432","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Dumaguete","1995-07-24","27","Single","Female","5-B","Yes","000123 456608","9377039455","fa7z7no88o@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("609","1319720122-4663","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Zamboanga","2002-09-09","20","Single","Female","6A-3","Yes","000123 456609","9372845694","0uot0joo1m@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("610","3219940120-8154","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Tuguegarao","1987-10-18","35","Married","Female","6B3-A","Yes","000123 456610","9177091425","rv5ab2iya0@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("611","1219800726-0854","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Ozamiz","1976-02-27","47","Married","Female","5-B","Yes","000123 456611","9679863952","626dp1kd3v@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("612","8719630411-6741","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","NagaBogo","1981-04-28","42","Single","Female","3-A","Yes","000123 456612","9176469687","0pye8tqbwx@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("613","5419610524-0161","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Toledo","1987-04-19","36","Single","Female","6A-5","Yes","000123 456613","9878336884","f7p1klgc9e@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("614","9819981216-5599","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Kabankalan","1997-08-16","25","Single","Female","6-D","Yes","000123 456614","9279469090","axahu6o1ve@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("615","4720001225-8033","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Kabacan","2002-12-14","20","Single","Female","6A-3","Yes","000123 456615","9476109084","bvoyoyn5n1@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("616","8619850511-0972","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Calamba","1991-12-24","31","Married","Female","6A-1","Yes","000123 456616","9572282028","y51jkkaiv0@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("617","4319830505-5437","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Tandag","1989-06-08","34","Single","Female","6B-6","Yes","000123 456617","9374810002","c1iq6dz8uw@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("618","9519851128-4296","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Legazpi","1996-11-27","26","Single","Female","6-D","Yes","000123 456618","9374105361","l204os2rjl@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("619","4819970313-4519","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Kabankalan","1974-07-07","49","Married","Female","8-A","Yes","000123 456619","9279195639","advp5a3yb8@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("620","7519721223-1445","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Bongao","1972-05-06","51","Single","Female","6B-5","Yes","000123 456620","9776823491","g02bmj7ihf@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("621","8219890814-5100","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Santiago","1982-02-20","41","Single","Female","6B-3","Yes","000123 456621","9173216788","ysxu5wku0w@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("622","2920021105-8594","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Tandag","1998-02-27","25","Married","Female","10-B","Yes","000123 456622","9571266145","k3ohcphkk0@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("623","5319610222-1168","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Las Piñas","1978-12-29","44","Single","Female","2-B","Yes","000123 456623","9674543302","w0ks7vwlsc@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("624","9920031204-7832","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Ormoc","1989-10-01","33","Married","Female","10-A","Yes","000123 456624","9875926331","pp4jtiw3sp@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("625","8720000824-1954","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Davao City","2001-08-21","21","Single","Female","3-A","Yes","000123 456625","9471245914","awztefbd4f@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("626","4020010817-4389","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Cabanatuan","1974-07-04","49","Married","Female","2-B","Yes","000123 456626","9378884310","qmn9hyruqp@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("627","3319641102-8286","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","San Pablo","1980-01-22","43","Single","Female","6A-4","Yes","000123 456627","9576319649","5fb2ric8fj@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("628","0519610811-9109","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Trece Martires","1975-05-13","48","Married","Female","3-A","Yes","000123 456628","9376631910","kk6xwp72om@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("629","6019930301-0240","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Gapan","1987-05-06","36","Married","Female","6-C","Yes","000123 456629","9372968980","oesayjsa9f@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("630","8419641012-5205","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Dasmariñas","1973-08-15","49","Single","Female","11","Yes","000123 456630","9275401005","3mh9bgha8n@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("631","9619970618-0712","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Baybay","2002-09-25","20","Married","Female","6-A","Yes","000123 456631","9772897891","fqdl8p3tln@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("633","1019920702-5620","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Cadiz","1997-11-30","25","Single","Female","6B-6","Yes","000123 456633","9874727439","qmps1gworp@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("634","6219850825-8303","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","San Jose","1986-10-29","36","Single","Female","6A-1","Yes","000123 456634","9771667048","aw14lbbz0f@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("635","6119841003-3311","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Manila","1972-11-28","50","Married","Female","4-B","Yes","000123 456635","9476129054","rypr1yao6v@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("636","7719650628-0521","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Urdaneta","1978-01-13","45","Married","Female","2-A","Yes","000123 456636","9371760545","srxe2xvlqm@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("637","1719640109-4688","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Pili","1990-08-09","32","Single","Female","2-A","Yes","000123 456637","9577585391","cp4ji070ns@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("638","6319980819-3593","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Valencia","2000-04-25","23","Married","Female","8-B","Yes","000123 456638","9372090048","yqu6i9gnab@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("639","7719940802-6545","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Makati","1988-11-03","34","Married","Female","6B-6","Yes","000123 456639","9574792828","3rmt4abfws@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("640","8119610713-0673","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Kawit","1998-04-01","25","Married","Female","6B-4","Yes","000123 456640","9275575977","4p3uj9paf2@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("641","5019740512-0619","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Kidapawan","1997-06-24","26","Single","Female","6B-5","Yes","000123 456641","9179384069","729wxn1ls7@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("642","5919800828-8788","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Santiago","1992-04-09","31","Single","Female","11-A","Yes","000123 456642","9873003607","777hvlb6uw@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("643","7419940428-7527","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Lipa","2000-12-26","22","Single","Female","10-B","Yes","000123 456643","9172247502","c7rwka1rib@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("644","1919951218-3244","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Cadiz","1993-07-06","29","Married","Female","10-A","Yes","000123 456644","9177334217","1xk76rb6ub@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("645","4819980928-6882","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Kabacan","1975-07-26","47","Single","Female","12","Yes","000123 456645","9476648451","4c43v254uq@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("646","4519940415-5497","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Urdaneta","1975-09-11","47","Single","Female","4-A","Yes","000123 456646","9573672602","5gpncpb1z9@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("647","3119960719-9228","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Dasmariñas","1978-10-12","44","Married","Female","2-B","Yes","000123 456647","9776258430","mktksizfqb@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("648","9119720310-9992","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Legazpi","1980-06-24","43","Married","Female","6B-8","Yes","000123 456648","9571271814","b70zqovk24@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("649","6119640726-9437","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Toledo","1996-11-03","26","Married","Female","8-B","Yes","000123 456649","9173192916","kb9lzcjmqk@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("650","9019670116-8903","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Baguio","1983-05-31","40","Married","Female","10-A","Yes","000123 456650","9273680600","99z6xg1mm2@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("651","2619800409-7982","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Angeles","1983-06-26","40","Married","Female","6B-4","Yes","000123 456651","9775801370","b3kpznx85i@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("652","6319790801-9050","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Baybay","1988-09-04","34","Single","Female","2-B","Yes","000123 456652","9578773467","kav0swnw3k@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("653","9219781122-2135","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Tacloban","1989-05-20","34","Married","Female","6A-1","Yes","000123 456653","9776983331","gkzb99t8tz@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("654","3219830805-2809","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Pili","1986-03-14","37","Single","Female","6A-5","Yes","000123 456654","9678126790","q8mp66x917@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("655","4219650114-4417","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Caloocan","1983-04-09","40","Married","Female","3-B","Yes","000123 456655","9271596371","hw44wdpduy@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("656","7119820518-6372","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Talisay","1995-12-03","27","Married","Female","8-B","Yes","000123 456656","9279034006","x41gi4krww@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("657","6219860923-9802","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Tacloban","1992-07-09","30","Married","Female","6A-2","Yes","000123 456657","9574721087","wjsg4ezdyd@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("658","4619920714-7781","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Candon","1986-11-25","36","Single","Female","8-A","Yes","000123 456658","9172367737","dxu62nat6n@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("659","8919750906-6487","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Baybay","1984-01-15","39","Single","Female","2-A","Yes","000123 456659","9376139078","akvwjfjvnw@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("661","9219901001-4240","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Calamba","1993-06-27","30","Single","Female","8-B","Yes","000123 456661","9172825122","drbxdveuoh@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("662","6819680407-9327","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Zamboanga City","1994-12-06","28","Married","Female","6B3-A","Yes","000123 456662","9771397779","yzwmhceh9p@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("663","8819740710-2201","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Lipa","1973-11-21","49","Single","Female","6-C","Yes","000123 456663","9474371071","g7ajhpxk1b@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("664","4719770822-8306","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Virac","1994-04-16","29","Single","Female","11-A","Yes","000123 456664","9272539327","0pxt9x3a7y@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("665","4719751109-0473","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Koronadal","1974-11-01","48","Single","Female","6B-5","Yes","000123 456665","9277657124","wbl5qfrh5u@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("666","5319990604-3006","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Koronadal","2002-03-28","21","Single","Female","6-C","Yes","000123 456666","9378446504","cywceew7w8@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("667","9619690124-9839","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Silay","1989-04-18","34","Single","Female","5-B","Yes","000123 456667","9775328902","t2abrgib61@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("668","5619800116-3818","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Isabela","1988-06-30","35","Single","Female","6B-6","Yes","000123 456668","9274139605","sgnbgjyk3b@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("669","2620000916-1267","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Legazpi","1976-10-23","46","Married","Female","6B-1","Yes","000123 456669","9475619135","6gb4xmxpag@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("670","6520040201-4857","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","San Juan","1999-12-15","23","Married","Female","3-A","Yes","000123 456670","9172230724","dwzlinqnkt@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("671","1719720601-3853","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Baybay","2001-09-08","21","Married","Female","5-B","Yes","000123 456671","9876728808","4rofl2txwm@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("672","8519710403-9619","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Makati","1984-02-29","39","Single","Female","1-C","Yes","000123 456672","9571335831","y8edvtfqfy@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("673","5519781128-8659","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Tagum","1992-03-29","31","Single","Female","5-B","Yes","000123 456673","9571248625","vyjoy6wska@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("674","1119941202-9907","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Manila","1976-12-19","46","Single","Female","6B-3","Yes","000123 456674","9877673895","szqlmh8383@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("675","3219980315-9137","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Tabaco","1995-02-07","28","Married","Female","6A-4","Yes","000123 456675","9677931228","4ngn46zf50@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("676","4819701225-0584","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Zamboanga City","1978-05-27","45","Married","Female","7","Yes","000123 456676","9279356776","nv6fw9d6e6@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("677","3219680926-0036","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Malaybalay","2001-09-03","21","Single","Female","6A-5","Yes","000123 456677","9776128138","32enck178r@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("678","8119990524-1145","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","San Carlos","1983-05-09","40","Single","Female","8-B","Yes","000123 456678","9678224931","ze98g0q3bh@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("679","6319871201-5071","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Kabankalan","1988-12-01","34","Single","Female","6B-5","Yes","000123 456679","9478451849","j4gus8pr1m@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("680","3819970104-0403","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Parañaque","1990-03-05","33","Single","Female","9","Yes","000123 456680","9873886248","jowa4zgji3@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("681","7819980722-2874","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Lapu-Lapu","1975-09-02","47","Married","Female","6-D","Yes","000123 456681","9174348061","0s62e7av6t@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("682","4219741216-8008","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Calamba","1973-12-19","49","Single","Female","8-A","Yes","000123 456682","9171059418","yocs9kl2fe@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("683","1119850806-8071","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Pagadian","2001-07-15","21","Single","Female","3-B","Yes","000123 456683","9878591293","7q12mvpo4p@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("684","3819871010-7725","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","San Fernando","1975-02-13","48","Married","Female","11","Yes","000123 456684","9577985003","ki7j8gwtj3@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("685","0219800118-8689","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Tarlac City","1978-06-10","45","Single","Female","6B-3","Yes","000123 456685","9477183843","38nt9820kq@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("686","4119960603-4834","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Sorsogon","1999-12-09","23","Single","Female","2-B","Yes","000123 456686","9879856589","ram3f5agd1@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("687","9419950423-4694","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Dumaguete","1989-08-14","33","Married","Female","6B-6","Yes","000123 456687","9677438534","dkfflhhfvy@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("689","2019660109-1683","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Batangas City","1994-12-05","28","Married","Female","1-C","Yes","000123 456689","9376739030","guuhh1qum7@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("690","2319841118-8051","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Davao City","1995-01-14","28","Married","Female","10-A","Yes","000123 456690","9874348680","dti4bkksqq@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("691","2619710618-4743","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Zamboanga","2002-12-04","20","Married","Female","1-C","Yes","000123 456691","9272907007","6radhuizyi@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("692","9919800921-2942","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","San Carlos","1991-09-18","31","Single","Female","6B-1","Yes","000123 456692","9779565518","fgjhuja7rg@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("693","0120000827-1943","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Legazpi","1997-07-10","25","Married","Female","6B-1","Yes","000123 456693","9578728191","1g4dqxrrvt@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("694","2119780801-3216","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Bais","1997-08-01","25","Single","Female","6A-5","Yes","000123 456694","9774451900","yp6j5nkrgg@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("695","6419871212-3723","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Kawit","1999-08-06","23","Single","Female","4-B","Yes","000123 456695","9476114973","dp4hpcpz3s@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("696","8719951105-9819","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Tayabas","1987-11-22","35","Single","Female","6A-1","Yes","000123 456696","9379005801","cwrhympav5@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("697","8919830225-6187","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","San Jose","2001-02-04","22","Single","Female","6A-4","Yes","000123 456697","9279865696","jdq4coepfa@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("698","3719950310-6977","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Pasay","1995-03-01","28","Married","Female","6A-1","Yes","000123 456698","9371517364","ovvfth1ahs@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("699","1419830604-8761","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Iloilo City","1989-12-25","33","Single","Female","6-D","Yes","000123 456699","9472805193","h8dfc6f65u@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("700","1219810505-6118","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Kabacan","1982-09-28","40","Married","Female","5-B","Yes","000123 456700","9377278383","abnujfyhko@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("701","3120010424-8764","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","San Fernando","2001-01-12","22","Married","Female","2-B","Yes","000123 456701","9675826293","csq6gsxa59@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("702","0119690105-7825","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Candon","1999-07-09","23","Single","Female","10-B","Yes","000123 456702","9479525358","7shgrpjvqk@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("703","8219760815-8909","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Toledo","1987-12-15","35","Married","Female","6B-8","Yes","000123 456703","9474027108","xjnzq6dzb2@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("704","6619720101-3567","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Butuan","1992-07-10","30","Married","Female","6B3-A","Yes","000123 456704","9772142526","odf1g9o9rs@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("705","4619800625-0286","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Mati","1991-05-30","32","Single","Female","8-A","Yes","000123 456705","9379276956","xcig72btwb@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("706","9119990512-7870","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Urdaneta","1982-04-25","41","Single","Female","3-B","Yes","000123 456706","9178000754","khozke97hx@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("707","7219671005-2601","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","San Carlos","1976-03-14","47","Single","Female","4-A","Yes","000123 456707","9175601299","9yqyaf26fu@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("708","1519881204-9941","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Malolos","1975-10-09","47","Married","Female","6-D","Yes","000123 456708","9879212579","wgnnhhypvi@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("709","6919640616-1838","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Talisay","1998-03-27","25","Married","Female","6A-2","Yes","000123 456709","9179817280","9od25bfi5r@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("710","8019721221-7607","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Silay","1982-02-22","41","Married","Female","6B-6","Yes","000123 456710","9379391196","opcs0j9lrz@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("711","4719981228-6246","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","San Fernando","2002-04-03","21","Married","Female","6B-6","Yes","000123 456711","9771146551","et4zdi9et8@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("712","0820041102-9146","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Bacoor","1993-03-10","30","Married","Female","6B-8","Yes","000123 456712","9672360351","ezfrrftong@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("713","4319630102-5020","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Dasmariñas","1997-07-05","25","Married","Female","6-C","Yes","000123 456713","9471589973","knge0p7bry@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("714","9119810320-7260","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Muntinlupa","1988-03-11","35","Single","Female","4-B","Yes","000123 456714","9875582129","54t39obzua@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("715","6819810610-0764","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Calbayog","1996-01-13","27","Married","Female","6A-3","Yes","000123 456715","9879991855","hm7ics6h09@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("717","1219720814-7381","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Butuan","1983-01-25","40","Single","Female","6A-2","Yes","000123 456717","9877571397","c0sng9a657@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("718","0519670628-0932","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Bacoor","1990-10-04","32","Single","Female","6A-2","Yes","000123 456718","9772114502","afdn83465w@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("719","9019800921-6206","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Mabalacat","1988-03-06","35","Single","Female","6B-4","Yes","000123 456719","9573977267","p6fkgvczzi@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("720","9820050516-7461","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Manila","1993-06-15","30","Single","Female","3-A","Yes","000123 456720","9775453279","c5bidvriof@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("721","5219880216-9969","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Iriga","1978-12-08","44","Married","Female","2-B","Yes","000123 456721","9179765898","tllcuddsu0@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("722","1219951127-2937","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Quezon City","1976-03-14","47","Single","Female","6B-4","Yes","000123 456722","9771476485","g0tovyqmqx@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("723","1819990608-1247","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Naga","1988-09-11","34","Single","Female","6B-3","Yes","000123 456723","9271191984","9fa8jtg0ur@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("724","3019820319-5938","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Manila","2001-11-21","21","Single","Female","4-A","Yes","000123 456724","9572189254","yppttnasmu@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("725","3319950610-8461","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Calbayog","1991-02-11","32","Single","Female","6B3-A","Yes","000123 456725","9471025454","rgymq3errr@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("726","2219930525-5330","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Pagadian","1979-11-28","43","Single","Female","2-B","Yes","000123 456726","9272230835","r916fn9hbt@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("727","1819840419-1272","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Muntinlupa","1982-11-01","40","Single","Female","3-B","Yes","000123 456727","9578255521","31m0cmy0hh@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("728","9719760727-1610","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Sagay","1986-05-05","37","Single","Female","6B-7","Yes","000123 456728","9171429636","kpg2o66f43@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("729","5619700710-7614","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","San Juan","1996-07-09","26","Married","Female","2-B","Yes","000123 456729","9178397864","ift73gz1or@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("730","0919720307-7292","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Quezon City","1997-01-18","26","Single","Female","11-A","Yes","000123 456730","9379354496","p53sn9d6uf@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("731","3919851221-2828","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Pagadian","1975-05-30","48","Married","Female","6B-4","Yes","000123 456731","9375020379","d6wc24zsm0@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("732","4119931112-4342","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Calamba","1998-01-16","25","Single","Female","3-B","Yes","000123 456732","9279110765","7qhb0rh7zt@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("733","2919950427-9238","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Bongao","2002-03-31","21","Single","Female","6-A","Yes","000123 456733","9779774315","du75h4okq2@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("734","7719681006-5626","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Kabankalan","1972-06-22","51","Single","Female","6-D","Yes","000123 456734","9475670021","q4i58jo3oc@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("735","9919661213-2010","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Calapan","1977-02-27","46","Single","Female","6-D","Yes","000123 456735","9676941519","y0q9ek7bbn@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("736","4219910608-6097","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Cabanatuan","1997-06-15","26","Single","Female","6B-7","Yes","000123 456736","9472747849","n2dnav0p0x@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("737","1919640225-5452","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Santa Rosa","1987-09-19","35","Married","Female","6-D","Yes","000123 456737","9676654895","wbncvi79zo@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("738","5019630518-4330","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Cabanatuan","1973-09-12","49","Married","Female","6B-5","Yes","000123 456738","9875080827","oldny7w26d@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("739","3219751208-5837","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Koronadal","1983-09-07","39","Single","Female","4-B","Yes","000123 456739","9771607377","jt457hbd1u@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("740","7519930810-2186","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Urdaneta","1996-07-28","26","Married","Female","10-B","Yes","000123 456740","9276987846","mqzblc26za@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("741","5419901006-7870","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Borongan","1987-10-28","35","Single","Female","6B-1","Yes","000123 456741","9872826799","jz2ogd1dh5@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("742","3319940620-1425","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Kabugao","1997-08-03","25","Married","Female","3-B","Yes","000123 456742","9873080122","9gel3pkccn@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("743","5419691219-0171","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Manila","1972-03-28","51","Married","Female","6B3-A","Yes","000123 456743","9874501096","3t8dxwjx0o@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("745","2719880319-1587","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Batangas City","1978-08-17","44","Single","Female","10-B","Yes","000123 456745","9575273110","94jx35np9z@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("746","5619880301-6978","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Legazpi","1992-11-20","30","Single","Female","9","Yes","000123 456746","9374557638","pkkab7fjw4@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("747","6819860616-8685","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Davao City","1975-02-11","48","Single","Female","2-A","Yes","000123 456747","9679990117","wejg8m234t@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("748","6319680411-2228","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Sorsogon City","1987-01-29","36","Single","Female","6A-4","Yes","000123 456748","9374652046","au0vapahax@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("749","1119750426-7612","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Puerto Princesa","1984-12-04","38","Single","Female","6B-4","Yes","000123 456749","9475374167","mxtgz915cm@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("750","2919910404-5078","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","San Pablo","2000-09-10","22","Separated","Female","2-B","Yes","000123 456750","9676406815","qp5gn92k3g@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("751","7519831113-6699","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Surigao City","1986-04-24","37","Single","Female","7","Yes","000123 456751","9471051296","whkl6u9e52@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("752","2519760228-2152","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Cabanatuan","1991-10-02","31","Married","Female","6-A","Yes","000123 456752","9374925587","nzjh45ipp3@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("753","9420031113-0605","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Silay","1977-09-22","45","Single","Female","11-A","Yes","000123 456753","9176931178","58t8mj2vn6@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("754","0319740207-9736","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Santiago","1976-03-11","47","Separated","Female","6B-4","Yes","000123 456754","9779459525","gvlsq4msw4@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("755","5719880823-3046","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Cotabato City","1991-01-23","32","Married","Female","12","Yes","000123 456755","9279193467","sjyxru4dp1@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("756","7019600828-2962","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Valenzuela","1983-08-22","39","Separated","Female","2-A","Yes","000123 456756","9377268176","vfmsxmzwnw@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("757","2620050603-7659","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","San Juan","1996-06-09","27","Single","Female","6A-3","Yes","000123 456757","9273926498","9kq10bgsc1@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("758","5619940527-3118","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Balanga","1997-03-18","26","Separated","Female","6-C","Yes","000123 456758","9575514593","bmwslbb5kj@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("759","8820041120-2202","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","San Carlos","2000-10-02","22","Single","Female","4-B","Yes","000123 456759","9874051214","9owewdsu0a@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("760","4619610802-2061","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Tuguegarao","1998-07-30","24","Separated","Female","8-A","Yes","000123 456760","9775818413","42rbfzv30d@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("761","6919800918-1034","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Davao City","1983-03-21","40","Single","Female","6A-5","Yes","000123 456761","9774614143","4m8obbumko@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("762","5219781126-5678","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","San Jose","1974-03-15","49","Single","Female","6-C","Yes","000123 456762","9478269784","uw8e0kl1xt@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("763","7519860225-1547","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Kawit","2001-03-08","22","Separated","Female","6A-4","Yes","000123 456763","9571292613","vlpxp9pisy@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("764","2920050413-6010","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Tayabas","1997-12-26","25","Single","Female","6-D","Yes","000123 456764","9174365537","87jvmdl1zl@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("765","9919620308-0866","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Tarlac City","1979-10-01","43","Single","Female","6B-1","Yes","000123 456765","9376381931","xrs8x2iqpx@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("766","8820020221-2566","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Sagay","1980-11-02","42","Single","Female","11-A","Yes","000123 456766","9779643636","v18ztb410f@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("767","4719830609-9047","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Legazpi","1985-10-14","37","Single","Female","6A-2","Yes","000123 456767","9479353142","zb1w3preyd@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("768","7119850528-6554","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Calapan","2002-10-19","20","Separated","Female","6A-2","Yes","000123 456768","9772041965","3zt8jsb6um@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("769","0119660406-3774","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Tuguegarao","1987-12-23","35","Married","Female","3-B","Yes","000123 456769","9673859198","rtpbkpc2th@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("770","4719691021-2013","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","General Trias","1981-02-10","42","Single","Female","3-B","Yes","000123 456770","9379339102","g7h2khh2ip@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("771","6419891110-8293","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Kidapawan","1981-07-15","41","Single","Female","6-A","Yes","000123 456771","9175542840","obzraap8cy@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("773","4819611027-2310","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Bago","1987-03-10","36","Single","Female","6-C","Yes","000123 456773","9276300936","p1yglg2tnr@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("774","7120030516-8627","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Kabacan","1980-03-07","43","Single","Female","6A-5","Yes","000123 456774","9377614909","9sxqk6dovr@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("775","5719871121-8002","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Taguig","2001-10-02","21","Married","Female","10-A","Yes","000123 456775","9376734375","27c1x3bewp@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("776","2919990902-9976","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Santiago","1977-07-17","45","Single","Female","6A-5","Yes","000123 456776","9373828309","8wtyc6kpk2@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("777","0819681203-7711","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Lipa","2000-01-22","23","Single","Female","1-C","Yes","000123 456777","9575075663","qwfd5enadt@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("778","7519611008-6271","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Angeles","1983-03-21","40","Separated","Female","6B-3","Yes","000123 456778","9872991007","3t4oe7a4o3@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("779","3319700501-0151","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","La Carlota","1979-10-03","43","Single","Female","1-C","Yes","000123 456779","9579098178","ityibcj1n6@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("780","0919760410-5134","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Davao City","1987-07-16","35","Married","Female","8-A","Yes","000123 456780","9779429554","ucfc297zwx@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("781","2219960409-1818","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Kabacan","1997-04-20","26","Separated","Female","6A-2","Yes","000123 456781","9774719398","cxc7plmlpt@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("782","2019740412-1749","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Borongan","1991-08-14","31","Single","Female","11","Yes","000123 456782","9172767609","drjgfrnlv0@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("783","3619600723-9447","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Gapan","1989-05-09","34","Single","Female","3-A","Yes","000123 456783","9679221297","gjpp2p4fno@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("784","2119610720-6808","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Naga","1988-07-28","34","Single","Female","6-A","Yes","000123 456784","9572752356","cg8lqooic8@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("785","2319910309-5535","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Zamboanga City","1976-10-12","46","Separated","Female","10-A","Yes","000123 456785","9272150897","rqnbszkc5g@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("786","2119680806-0871","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Valencia","1997-12-21","25","Single","Female","6-D","Yes","000123 456786","9871982843","bra4vp1gvy@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("787","1819910405-0449","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Davao City","1983-10-21","39","Separated","Female","6A-5","Yes","000123 456787","9772754631","kuwpfksmi7@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("788","2419840704-5621","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Marawi","1980-02-03","43","Single","Female","6B-7","Yes","000123 456788","9575157509","lj8ueiq6hz@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("789","4719931112-5443","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Digos","1990-11-18","32","Single","Female","5-B","Yes","000123 456789","9575744693","nrj8u1jjrw@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("790","3919890607-0890","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Roxas City","1990-12-29","32","Single","Female","3-B","Yes","000123 456790","9674009847","i4bezvh6mf@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("791","3419921102-4271","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Bogo","1987-02-14","36","Single","Female","11","Yes","000123 456791","9673721243","izclmxlwn7@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("792","1719780801-5548","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","LegazpiPuerto Princesa","1989-06-17","34","Single","Female","6A-5","Yes","000123 456792","9678846353","20hcesgcqp@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("793","4219751117-0686","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Manila","1990-02-09","33","Single","Female","6-D","Yes","000123 456793","9173092774","7l6utx5fv4@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("794","6520011020-3145","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Cotabato City","2000-07-09","22","Married","Female","6B-4","Yes","000123 456794","9572412205","azs19rinde@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("795","0819941023-8628","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Pasay","1999-12-14","23","Single","Female","11","Yes","000123 456795","9871375078","xutbrrnbvh@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("796","5619650728-2016","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","General Trias","1991-09-03","31","Separated","Female","6-C","Yes","000123 456796","9275178390","sgjplorz09@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("797","0119630103-6874","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","General Santos","1986-02-16","37","Separated","Female","6A-5","Yes","000123 456797","9372349514","8ajq2kof5k@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("798","1419860716-3548","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Valenzuela","1976-08-19","46","Single","Female","6A-2","Yes","000123 456798","9577239548","s8wcu8hb6z@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("799","4419991019-6306","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Pili","1995-02-16","28","Single","Female","6B-4","Yes","000123 456799","9473473836","64hm5bvxjx@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("801","3319760910-6273","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Davao City","1988-10-31","34","Married","Female","6A-4","Yes","000123 456801","9377451182","q58rw0p2of@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("802","0219710523-4354","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Legazpi","2002-10-25","20","Single","Female","6-C","Yes","000123 456802","9373393270","8lxdblvgw1@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("803","7219800815-1030","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Pili","1993-02-15","30","Married","Female","6B-6","Yes","000123 456803","9675206533","oupzfwg88s@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("804","1620041107-8243","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Iloilo City","1996-04-05","27","Single","Female","4-A","Yes","000123 456804","9374533089","6u9xhoe1gs@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("805","9619820801-6793","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Tabaco","1999-05-04","24","Single","Female","5-A","Yes","000123 456805","9174304197","6ortz86hns@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("806","1919870809-6643","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Tuguegarao","1991-09-29","31","Single","Female","6B-8","Yes","000123 456806","9779740388","za68j4n7rh@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("807","8519831222-0151","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Batangas City","1988-05-20","35","Separated","Female","6B-3","Yes","000123 456807","9276069976","fe3myxudva@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("808","7319760620-9186","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Virac","1998-04-27","25","Single","Female","5-B","Yes","000123 456808","9373997772","5b098vwzbt@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("809","8619970307-2702","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Bogo","1972-12-29","50","Single","Female","8-A","Yes","000123 456809","9872423823","ozk8jh7wrx@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("810","7519950828-4200","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Dasmariñas","1981-05-23","42","Single","Female","6A-4","Yes","000123 456810","9579344581","5404ojxyga@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("811","4920020806-7561","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Sorsogon","1995-11-08","27","Married","Female","6B-8","Yes","000123 456811","9278717189","qa3y3c0iyc@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("812","4019971213-6413","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Cagayan de Oro","1995-09-21","27","Separated","Female","6B-4","Yes","000123 456812","9373817746","20lmvceiww@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("813","4819780628-6866","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Catbalogan","1982-10-26","40","Single","Female","3-B","Yes","000123 456813","9373027306","5sf8f25kvl@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("814","9819911013-9276","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Iloilo City","2000-07-06","22","Single","Female","4-A","Yes","000123 456814","9776886687","pc1oh589v2@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("815","6919920203-8752","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Dumaguete","1992-02-26","31","Separated","Female","6A-3","Yes","000123 456815","9376825734","9xms2tdf0b@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("816","6019730416-0908","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Cabanatuan","1974-09-29","48","Single","Female","6B-7","Yes","000123 456816","9872449670","bd4k7mex6z@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("817","6919680818-7219","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Kawit","1998-11-23","24","Separated","Female","6B-3","Yes","000123 456817","9775255889","zykwgs3bd3@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("818","1419910927-7694","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Mamburao","1975-07-12","47","Single","Female","5-A","Yes","000123 456818","9272215828","gz7x8v6u5h@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("819","9520001022-4077","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","San Juan","1997-08-17","25","Single","Female","6B-8","Yes","000123 456819","9476895772","7mb9adb9bm@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("820","9619940815-5382","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Canlaon","1975-03-17","48","Married","Female","6B-6","Yes","000123 456820","9.478E+20","b6bmnqx8r8@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("821","5719650214-4813","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Davao City","1985-02-02","38","Separated","Female","3-B","Yes","000123 456821","9474094078","y093rur54a@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("822","1619711118-3694","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Mati","1985-11-19","37","Separated","Female","8-A","Yes","000123 456822","9277991170","t156lnr33d@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("823","6019970704-1821","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Bacoor","1989-05-28","34","Single","Female","6-D","Yes","000123 456823","9577993048","ev7b9nlc1b@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("824","5919771103-7487","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Marawi","1983-03-16","40","Married","Female","5-B","Yes","000123 456824","9776015383","n6p3voezpw@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("825","0819900313-4496","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Malaybalay","2000-07-18","22","Separated","Female","6A-1","Yes","000123 456825","9779913484","aoddhyz2qr@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("826","7619730805-6070","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","SorsogonCaloocan","1986-06-04","37","Single","Female","4-A","Yes","000123 456826","9777915031","gkciwxdd09@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("827","6420050516-0289","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Baguio","1999-09-26","23","Separated","Female","11-A","Yes","000123 456827","9672057467","hj8hb234vs@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("829","0319920110-4498","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Dasmariñas","1987-10-22","35","Married","Female","5-B","Yes","000123 456829","9771752902","vc5xa6rzsv@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("830","3519670618-4612","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Talisay","1997-08-19","25","Single","Female","2-B","Yes","000123 456830","9372747049","1tcwbmcvt9@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("831","3020020427-8838","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Cadiz","1977-06-13","46","Single","Female","6A-4","Yes","000123 456831","9673873916","r9id8dbl6k@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("832","3619670925-2178","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Kabugao","1974-04-13","49","Married","Female","3-B","Yes","000123 456832","9376698607","5hnr1zizyb@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("833","5920040619-7977","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Mati","1980-10-06","42","Separated","Female","9","Yes","000123 456833","9575036614","r5ja7a5fe6@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("834","1919720418-9696","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Santiago","2002-10-16","20","Single","Female","6-A","Yes","000123 456834","9678025544","w21etrrqgr@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("835","3819980804-3175","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Sipalay","1981-10-05","41","Single","Female","6B-8","Yes","000123 456835","9375206254","5guut8v8p3@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("836","5019960114-9845","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Mandaue","1992-02-02","31","Single","Female","6B-4","Yes","000123 456836","9874605369","p1pvfrbu6g@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("837","4819620809-1324","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Tagbilaran","1991-07-29","31","Married","Female","6B6-A","Yes","000123 456837","9774077879","ggteno9jfn@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("838","4919970910-5122","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","General Santos","1990-08-01","32","Single","Female","3-B","Yes","000123 456838","9572869371","er0xgip2e8@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("839","5619720417-3546","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Tandag","1981-06-06","42","Single","Female","1-C","Yes","000123 456839","9278668103","wgg2p52ouf@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("840","0719910717-3956","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Mati","1986-11-20","36","Married","Female","5-A","Yes","000123 456840","9679318172","y9ckud7k28@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("841","2219961007-6370","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Cauayan","1980-07-31","42","Single","Female","2-B","Yes","000123 456841","9871602683","6uuww3a5ax@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("842","9419940616-2090","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Bayawan","1985-06-13","38","Single","Female","6B-5","Yes","000123 456842","9871847375","aaux4korfg@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("843","3619731205-0553","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","San Pablo","1987-07-08","35","Single","Female","6-C","Yes","000123 456843","9676495061","4g5rirw0il@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("844","8019631115-2464","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Makati","1990-02-07","33","Single","Female","6A-1","Yes","000123 456844","9478913439","yptfvr4aze@yahoo.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("845","9719631223-7268","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Bacolod","1995-04-26","28","Single","Female","6-C","Yes","000123 456845","9879270281","d40dp29cem@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("846","4219970107-0180","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Iriga","1981-06-09","42","Separated","Female","10-B","Yes","000123 456846","9274028076","6ozomx4rwo@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("847","9119770616-7524","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Bacolod","1993-03-27","30","Single","Female","6B-3","Yes","000123 456847","9177595276","qompgi08xb@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("848","9719920310-7654","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Isabela","1991-12-18","31","Single","Female","10-B","Yes","000123 456848","9375667784","lfwzss3evc@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("849","1019930821-8872","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Mati","1972-05-13","51","Single","Female","6A-2","Yes","000123 456849","9771125708","zxcngihnmi@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("850","5919740504-3443","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","San Carlos","1988-03-23","35","Married","Female","6B3-A","Yes","000123 456850","9375139171","2zhd3qsx9x@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("851","2919711207-3460","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Cauayan","1994-10-11","28","Single","Female","12","Yes","000123 456851","9477671466","2m4scycwfm@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("852","2819710824-7773","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Puerto Princesa","2001-10-31","21","Married","Female","9","Yes","000123 456852","9273891394","vg5clhvzye@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("853","7219680409-5178","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Tayabas","2001-06-04","22","Single","Female","8-B","Yes","000123 456853","9475556499","q61bpzp2vf@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("854","8819840312-0946","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Calbayog","1996-06-21","27","Single","Female","4-A","Yes","000123 456854","9771570822","t1ieeg9zxv@yahoo.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("855","8419970918-4689","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Batangas City","1986-11-12","36","Single","Female","4-B","Yes","000123 456855","9671145173","ukayqgnu7d@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("857","7319840521-8765","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","General Santos","1988-04-14","35","Single","Female","1-C","Yes","000123 456857","9276391886","gbf1rxxjf5@gmail.com",">","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("858","0619600626-3007","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Cadiz","1994-08-15","28","Separated","Female","6B-4","Yes","000123 456858","9372329510","zvq5ew4qyw@gmail.com","Promodiser","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("859","0219910320-9811","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Trece Martires","1977-04-05","46","Single","Female","6B-8","Yes","000123 456859","9373139636","vyl0et6vgg@gmail.com","Cashier","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("860","3219860310-9496","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Baybay","2000-09-05","22","Separated","Female","2-B","Yes","000123 456860","9472316386","ylxspv7k60@yahoo.com","Driver","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("861","2419860401-0913","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Malaybalay","1998-06-16","25","Single","Female","5-B","Yes","000123 456861","9374253794","ye1ua1v871@yahoo.com","Tricyle Driver","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("862","7219740317-3759","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Trece Martires","1977-02-06","46","Married","Female","9","Yes","000123 456862","9179114148","11lk3cp5d1@gmail.com","Cashier","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("863","1219610214-2933","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","General Trias","1977-07-11","45","Married","Female","6A-5","Yes","000123 456863","9271429896","ze2aqhljyo@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("864","6819970818-6493","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Dumaguete","1977-05-07","46","Single","Female","6B6-A","Yes","000123 456864","9677000793","eawlgdvyu8@yahoo.com","Teacher","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("865","4020011127-1033","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Manila","1988-11-03","34","Married","Female","6A-4","Yes","000123 456865","9774963468","himnvn113h@gmail.com","Manager","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("866","2019790127-3284","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Iriga","1983-04-18","40","Single","Female","6B-3","Yes","000123 456866","9574756638","1jvujup3f6@yahoo.com","Promodiser","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("867","2119711111-6308","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","San Carlos","1998-03-21","25","Married","Female","4-B","Yes","000123 456867","9471200118","i2srh918ke@yahoo.com","Vendor","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("868","6919960406-8513","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Iriga","1997-10-31","25","Single","Female","6B-4","Yes","000123 456868","9671039529","fm9rl4kde0@gmail.com","Driver","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("869","4519870403-0025","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Malabon","1986-04-08","37","Single","Female","6A-5","Yes","000123 456869","9278190233","z278p19ihd@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("870","7519650325-4133","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Davao City","1987-08-24","35","Married","Female","4-B","Yes","000123 456870","9179007678","fg012vyr3w@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("871","6919941007-3243","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Cagayan de Oro","1981-04-17","42","Single","Female","5-A","Yes","000123 456871","9774537752","842017hsci@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("872","5319690306-4363","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Dasmariñas","1980-05-28","43","Separated","Female","6A-3","Yes","000123 456872","9879969291","fxi0mmy33g@gmail.com","Cashier","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("873","5819890421-0458","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Valenzuela","1989-12-07","33","Single","Female","4-B","Yes","000123 456873","9378528054","ftfb4je08w@yahoo.com","Cashier","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("874","4019720313-9324","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Bayawan","1992-04-07","31","Married","Female","6B-1","Yes","000123 456874","9679810804","jk7etlmhsv@yahoo.com","Vendor","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("875","9519651219-1197","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","La Carlota","1979-08-16","43","Married","Female","2-A","Yes","000123 456875","9574851716","ujr6c79h66@yahoo.com","Teacher","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("876","0419971108-2176","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Canlaon","1990-05-31","33","Married","Female","3-B","Yes","000123 456876","9779811957","j8i0qae8f1@gmail.com","Tricyle Driver","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("877","6919870119-6187","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Cadiz","1989-04-22","34","Single","Female","4-B","Yes","000123 456877","9571412322","3m5xo9cu7k@yahoo.com","Call Center","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("878","5319671221-1171","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Zamboanga City","1989-10-07","33","Single","Female","6B-3","Yes","000123 456878","9875439986","s4m7bytthu@yahoo.com","Promodiser","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("879","2019760316-5524","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","Davao City","1985-11-11","37","Single","Female","12","Yes","000123 456879","9877264664","hl1mnzsj61@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("880","5619660701-0369","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Daet","1981-05-30","42","Single","Female","11","Yes","000123 456880","9871969485","vgfc45b7o8@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("881","2719790906-4788","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","La Carlota","1977-04-28","46","Separated","Female","11","Yes","000123 456881","9679075747","8h7espti19@yahoo.com","Call Center","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("882","9519900218-8742","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Tabaco","1972-03-22","51","Single","Female","6A-2","Yes","000123 456882","9171950249","oazmtx7lpt@gmail.com","Promodiser","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("883","8719690225-8236","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Digos","1998-03-18","25","Married","Female","6A-1","Yes","000123 456883","9179808919","ov1824lxqa@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("885","8120000108-9713","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Quezon City","1982-03-24","41","Married","Female","7","Yes","000123 456885","9476250503","mg0uq7ules@gmail.com","Vendor","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("886","9620010816-5121","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Himamaylan","1973-03-24","50","Single","Female","6B6-A","Yes","000123 456886","9573698899","sk9xlo3ac6@yahoo.com","Teacher","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("887","0819900412-7484","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Tacloban","1995-10-23","27","Separated","Female","5-A","Yes","000123 456887","9374238322","70rz7r1qo9@yahoo.com","Cashier","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("888","8419880409-6901","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Bayawan","1978-11-28","44","Separated","Female","11","Yes","000123 456888","9176418006","6n7u1rj06d@yahoo.com","Promodiser","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("889","9819631228-0974","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","San Carlos","1997-06-30","26","Separated","Female","6A-3","Yes","000123 456889","9573258156","1eycf1uijh@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("890","6219841123-3641","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Koronadal","1996-10-15","26","Married","Female","5-B","Yes","000123 456890","9777393945","algze0c5z7@yahoo.com","Call Center","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("891","5819630611-0515","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Davao City","1988-09-11","34","Separated","Female","6B6-A","Yes","000123 456891","9177277839","ja79cr81pa@gmail.com","Businessman","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("892","0219780724-1319","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Santa Maria","1984-05-21","39","Single","Female","6B-1","Yes","000123 456892","9179537138","qa8fh9x4ac@gmail.com","Call Center","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("893","0919921027-7630","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Dumaguete","1991-08-24","31","Separated","Female","6B-6","Yes","000123 456893","9174058864","3t60lyuou7@yahoo.com","Promodiser","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("894","3519891014-5569","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Puerto Princesa","1976-07-28","46","Separated","Female","11-A","Yes","000123 456894","9174359407","se3frxqkms@gmail.com","Businessman","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("895","8519891028-1455","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Silay","1977-10-16","45","Separated","Female","12","Yes","000123 456895","9774723206","836ok69fga@gmail.com","Tricyle Driver","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("896","0920040822-6389","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Bayawan","2001-08-08","21","Single","Female","3-A","Yes","000123 456896","9376928549","nd8wubgx5n@gmail.com","Merchandiser","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("897","6819880417-4531","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Olongapo","1997-11-13","25","Single","Female","6B-3","Yes","000123 456897","9575042870","nvu1p3s2zm@yahoo.com","Manager","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("898","1119860701-5656","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Borongan","1977-10-29","45","Single","Female","6A-2","Yes","000123 456898","9279872138","77vwrgbyas@yahoo.com","Vendor","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("899","8619891022-3567","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Kidapawan","1973-02-24","50","Single","Female","6B-8","Yes","000123 456899","9472303716","3uwmbqjkae@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("900","4719650614-8465","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Calbayog","1989-08-05","33","Married","Female","6B-5","Yes","000123 456900","9175364211","3u9mnl84wm@yahoo.com","Merchandiser","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("901","2519790726-1610","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Digos","1998-06-30","25","Single","Female","6B6-A","Yes","000123 456901","9275639817","z5x0fb7yor@yahoo.com","Tricyle Driver","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("902","3919940310-1796","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Pasay","1998-07-08","24","Single","Female","6A-3","Yes","000123 456902","9575847367","j2x9kyik9h@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("903","9119870223-9918","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Naga","1978-04-25","45","Separated","Female","2-B","Yes","000123 456903","9372472388","bf03q6ny68@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("904","1519921205-9257","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Sagay","1982-02-18","41","Married","Female","6B-8","Yes","000123 456904","9375843497","z7miz12et6@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("905","1119840817-9808","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Taguig","1994-11-06","28","Single","Female","10-A","Yes","000123 456905","9178992763","7l367c0qkl@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("906","9119860620-7647","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Tacloban","1980-12-27","42","Separated","Female","1-C","Yes","000123 456906","9172050351","2lx9qt5tnk@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("907","4220000301-4465","Filipino","03072023123634person.png","Sofia","Aquino","Reyes","Tugbok, Los Amigos","San Carlos","1992-02-07","31","Single","Female","6B-1","Yes","000123 456907","9276817641","t95v7todq3@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("908","4720000410-7256","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Mati","1976-01-22","47","Married","Female","3-A","Yes","000123 456908","9278176140","pisulucisr@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("909","2119720224-1908","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Tarlac City","1975-10-17","47","Single","Female","6A-1","Yes","000123 456909","9475668872","472fihbkxy@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("910","2719991216-3761","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Pasig","1982-06-08","41","Single","Female","6A-1","Yes","000123 456910","9177406796","t1fv5j9314@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("911","0219700701-7969","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Sorsogon City","1976-05-05","47","Married","Female","8-B","Yes","000123 456911","9577773635","o3n12c9634@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("913","9719670104-5828","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Borongan","1991-03-29","32","Single","Female","5-B","Yes","000123 456913","9.77839E+20","uzybuk20mf@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("914","6419801214-7527","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Catbalogan","1982-05-09","41","Single","Female","6B-1","Yes","000123 456914","9779013999","w4vb9m6hch@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("915","9120040901-3918","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Marawi","1977-03-10","46","Single","Female","6A-5","Yes","000123 456915","9179023774","maosfle1us@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("916","0419610109-2991","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Imus","1983-11-05","39","Married","Female","11","Yes","000123 456916","9871823213","d6r8ravcze@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("917","7019770313-0782","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Iriga","1998-02-06","25","Separated","Female","3-B","Yes","000123 456917","9872383269","wyj3694oqm@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("918","5319611101-5591","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Taguig","1974-05-29","49","Single","Female","4-A","Yes","000123 456918","9576553027","io9fd22tz1@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("919","5119980705-9751","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Tacloban","1984-01-22","39","Separated","Female","6-C","Yes","000123 456919","9871976269","kv3jyntps8@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("920","8219871009-7115","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Mati","1982-08-02","40","Single","Female","4-B","Yes","000123 456920","9875718729","ceymvuwioq@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("921","5919891117-5770","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Baybay","1974-05-26","49","Single","Male","10-A","Yes","000123 456921","9775525307","c4e61jbeyk@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("922","0119951005-6616","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Tandag","2000-10-30","22","Married","Male","6A-2","Yes","000123 456922","9.77618E+20","s2c0zv14lq@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("923","1119740901-3268","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Dasmariñas","2002-01-02","21","Separated","Male","6B-7","Yes","000123 456923","9278904656","houtk9jy2o@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("924","6619740923-0520","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","Malolos","1982-06-27","41","Single","Male","6-A","Yes","000123 456924","9373934306","1jqbrx79fl@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("925","4920000901-8788","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Puerto Princesa","2001-04-03","22","Single","Male","11-A","Yes","000123 456925","9175648393","dusvxt303h@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("926","0419770203-1029","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Tandag","1985-02-24","38","Married","Male","4-A","Yes","000123 456926","9372442321","8ebyr4mhb2@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("927","5319860805-7560","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Daet","1988-11-03","34","Single","Male","2-A","Yes","000123 456927","9771988285","hskc894bfi@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("928","0419920821-2885","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Cebu City","1972-02-05","51","Single","Male","6B6-A","Yes","000123 456928","9874623619","h5cl6l1cce@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("929","7919740211-3333","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Dumaguete","1992-02-16","31","Single","Male","12","Yes","000123 456929","9871033896","6ug2rmumf9@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("930","3419840306-4279","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","San Jose","1995-09-06","27","Single","Male","6A-3","Yes","000123 456930","9175510964","r3azvge4vg@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("931","8219650906-2659","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Angeles","1984-02-25","39","Single","Male","6B-4","Yes","000123 456931","9874171915","jbob86gl1z@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("932","0219790426-6876","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Valenzuela","1994-04-08","29","Single","Male","6-C","Yes","000123 456932","9678247630","wjlhdv55dg@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("933","8819830824-2627","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Marawi","1993-11-30","29","Single","Male","11-A","Yes","000123 456933","9577743540","6m07bdwmbf@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("934","9119891013-3005","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Dasmariñas","1991-07-02","32","Married","Male","6B-4","Yes","000123 456934","9671865876","olvd8mba0g@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("936","2219811110-5534","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Legazpi","1998-04-01","25","Single","Male","6B-4","Yes","000123 456936","9576734313","8pbs6lb3yy@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("937","7019650321-9809","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","General Santos","2001-07-04","21","Single","Male","6B-7","Yes","000123 456937","9479049425","139gb67xmv@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("938","0619750116-8209","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Bacolod","1976-07-09","46","Single","Male","6B-1","Yes","000123 456938","9576642755","lghvyyjor6@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("939","6219941115-2937","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Bais","1990-02-14","33","Separated","Male","11","Yes","000123 456939","9176612467","0fy9z5q2u3@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("941","8319830916-1982","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Ormoc","1993-04-23","30","Single","Male","10-A","Yes","000123 456941","9677029889","1nzb1uvsjb@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("942","5519800309-7981","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Tacloban","1992-12-20","30","Single","Male","5-A","Yes","000123 456942","9876728332","df5eg4b2ty@yahoo.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("943","8219800602-0580","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Naga","1977-05-23","46","Single","Male","6A-3","Yes","000123 456943","9277054995","4ic5b85jdx@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("944","5819830526-5656","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Pasay","1983-11-28","39","Married","Male","6B-5","Yes","000123 456944","9879355852","gk4x3hjswh@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("945","9519710802-8568","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Iloilo City","1975-05-29","48","Married","Male","1-C","Yes","000123 456945","9276246940","6la5cbswgc@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("946","5919860215-7590","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","Sorsogon City","1993-11-01","29","Single","Male","9","Yes","000123 456946","9878962070","ztf4ew9lts@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("947","2719800506-3386","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Valenzuela","1977-06-13","46","Single","Male","6B-3","Yes","000123 456947","9371621901","sapphmm1i2@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("948","0619810318-1973","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Malolos","1972-03-22","51","Single","Male","6A-1","Yes","000123 456948","9279287603","89jrco2kb3@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("949","2819930222-8083","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Marikina","1993-01-10","30","Separated","Male","3-B","Yes","000123 456949","9575433839","4hmz6mn345@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("950","3419820718-4420","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Kabugao","1992-09-04","30","Single","Male","6A-3","Yes","000123 456950","9875003565","89x2gxu79p@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("951","5119980501-9339","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Kabankalan","1982-08-24","40","Single","Male","10-A","Yes","000123 456951","9473654351","34d466ixc2@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("952","0619681208-2226","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","San Pablo","1990-05-02","33","Single","Male","6-D","Yes","000123 456952","9476760961","ynlnc9cvag@yahoo.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("953","3619721028-9564","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","Surigao City","1975-10-14","47","Separated","Male","6A-4","Yes","000123 456953","9272932707","0kbnyiua9s@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("954","5019721212-7930","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","Pagadian","1980-11-19","42","Single","Male","2-A","Yes","000123 456954","9874558256","8pgg4e4a61@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("955","2719641107-1809","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Santiago","1988-02-04","35","Single","Male","2-A","Yes","000123 456955","9871025302","0i9nwbx5o9@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("956","8219680922-1921","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Baybay","1986-09-06","36","Single","Male","2-B","Yes","000123 456956","9778651254","lw2cpsr80c@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("957","2019710919-5176","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Cabanatuan","1981-08-08","41","Single","Male","6-D","Yes","000123 456957","9676805741","7o65au98kk@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("958","6519931203-1330","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Borongan","1989-01-01","34","Separated","Male","6B-3","Yes","000123 456958","9678120310","b2bl25pssm@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("959","3819760607-2577","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Calbayog","1996-08-02","26","Married","Male","5-B","Yes","000123 456959","9472606173","s5vkz0huav@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("960","4519830514-0719","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Calapan","2000-03-22","23","Separated","Male","9","Yes","000123 456960","9579494120","xdcq3x61xg@gmail.com","Student","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("961","4619730509-1606","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","Tandag","1992-08-15","30","Married","Male","6B3-A","Yes","000123 456961","9873921855","z3xn347e3o@gmail.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("962","8419670221-7292","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","Tandag","1995-02-23","28","Married","Male","6B-3","Yes","000123 456962","9872184255","bw8v4mo1or@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("964","1919690521-3211","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Tabaco","1989-10-30","33","Single","Male","6B-8","Yes","000123 456964","9678497921","eq5x1yw77p@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("965","5319630217-8811","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Baguio","1992-02-27","31","Separated","Male","6A-4","Yes","000123 456965","9675815586","gcpy7ooua0@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("966","4019830326-2994","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Santiago","1972-05-15","51","Separated","Male","10-B","Yes","000123 456966","9472598597","ia1iztebs2@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("967","7719920915-4510","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Santa Maria","1979-10-30","43","Single","Male","1-C","Yes","000123 456967","9477147549","wguqbgpjj0@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("969","5920040816-3601","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Malolos","2002-08-10","20","Single","Male","6A-3","Yes","000123 456969","9774889822","ga6as7azp4@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("970","6219910209-5736","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Mati","1985-02-20","38","Married","Male","5-B","Yes","000123 456970","9271462382","0i6tzayee6@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("971","1219900904-3782","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","Tugbok, Los Amigos","Puerto Princesa","1993-11-21","29","Married","Male","6-D","Yes","000123 456971","9779693536","716rvcgt60@yahoo.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("972","1419610201-4966","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Pasig","1972-03-14","51","Single","Male","6B-1","Yes","000123 456972","9871262201","t59ecqpy8u@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("973","9119740324-4590","Filipino","03072023123634person.png","Jose","Torres","Garcia","Tugbok, Los Amigos","Makati","1989-04-19","34","Single","Male","4-A","Yes","000123 456973","9273253626","lesjcokmiy@gmail.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("974","8920031109-3502","Filipino","03072023123634person.png","Maria","Elena","Aquino","Tugbok, Los Amigos","San Carlos","2000-04-08","23","Single","Male","3-B","Yes","000123 456974","9476981638","5v1l0pnug3@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("975","8419820405-0048","Filipino","03072023123634person.png","Antonio","Fernandez","Ramos","Tugbok, Los Amigos","Puerto Princesa","1983-10-10","39","Single","Male","2-A","Yes","000123 456975","9575622212","lpai43ezqw@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("976","8919980814-4137","Filipino","03072023123634person.png","Gabriela","Cruz","Torres","Tugbok, Los Amigos","Balanga","1994-05-12","29","Single","Male","6-D","Yes","000123 456976","9675349120","j2il4cy8kp@yahoo.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("977","1119870815-5426","Filipino","03072023123634person.png","Rafaela","Aquino","Reyes","Tugbok, Los Amigos","Balanga","1984-02-19","39","Separated","Male","1-C","Yes","000123 456977","9279964422","qrr4qo9i8x@yahoo.com","Sel-employed","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("978","5119750506-3461","Filipino","03072023123634person.png","Luis","Dela Cruz","Cruz","Tugbok, Los Amigos","Bongao","1993-12-29","29","Separated","Male","6A-5","Yes","000123 456978","9173076169","z51wfdsizh@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("979","2219981115-7962","Filipino","03072023123634person.png","Isabel","Ramos","Rodriguez","Tugbok, Los Amigos","Mabalacat","1972-06-25","51","Separated","Male","6B-3","Yes","000123 456979","9671502700","1y5asy2sn4@gmail.com","Student","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("980","0919810207-7829","Filipino","03072023123634person.png","Pedro","Torres","Gonzales","Tugbok, Los Amigos","rdaneta","1994-10-25","28","Single","Male","5-A","Yes","000123 456980","9378757289","n85djclewx@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("981","1219851112-5538","Filipino","03072023123634person.png","Ana","Reyes","Dela Cruz","Tugbok, Los Amigos","General Trias","1986-06-07","37","Separated","Male","4-A","Yes","000123 456981","9572160914","p305bnlv1w@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("982","4419781123-4998","Filipino","03072023123634person.png","Juan","Garcia","Cruz","Tugbok, Los Amigos","La Carlota","2001-10-21","21","Single","Male","3-A","Yes","000123 456982","9679097845","oo0ohteosn@yahoo.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("983","4319781009-0579","Filipino","03072023123634person.png","Maria","Carmen","Aquino","Tugbok, Los Amigos","Marawi","1998-06-15","25","Separated","Male","1-C","Yes","000123 456983","9776734385","xnxv49b42p@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("984","2119850113-5497","Filipino","03072023123634person.png","Carlos","Dela Cruz","Cruz","Tugbok, Los Amigos","Toledo","1999-11-13","23","Single","Male","6B-1","Yes","000123 456984","9874141329","qsm75b6wlh@gmail.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("985","5520041015-2056","Filipino","03072023123634person.png","Rosa","Fernandez","Aquino","Tugbok, Los Amigos","Imus","1981-03-07","42","Single","Male","5-A","Yes","000123 456985","9272018022","ubd0f1oh5j@yahoo.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("986","0619701006-6733","Filipino","03072023123634person.png","Roberto","Garcia","Fernandez","Tugbok, Los Amigos","Ozamiz","1981-08-10","41","Single","Male","4-B","Yes","000123 456986","9379380716","13nodveclj@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("987","4819611212-9926","Filipino","03072023123634person.png","Ana","Santos","Garcia","Tugbok, Los Amigos","Cebu City","1988-02-08","35","Married","Male","1-C","Yes","000123 456987","9279707331","3xztwje2vs@gmail.com","Student","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("988","9519681123-5421","Filipino","03072023123634person.png","Miguel","Ramos","Dela Cruz","Tugbok, Los Amigos","Pagadian","1980-10-20","42","Single","Male","8-A","Yes","000123 456988","9277842926","jf4lkmoob1@yahoo.com","N/A","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("989","8220010708-1420","Filipino","03072023123634person.png","Maria","Clara","Torres","Tugbok, Los Amigos","San Juan","1978-07-09","44","Single","Male","8-B","Yes","000123 456989","9579955248","2hn340b5j2@gmail.com","N/A","4ps Requirements","1","","");
INSERT INTO tblpurok_records VALUES("990","4119610918-0631","Filipino","03072023123634person.png","Pedro","Reyes","Torres","Tugbok, Los Amigos","San Fernando","1982-11-29","40","Single","Male","8-B","Yes","000123 456990","9776916133","lw8rpy76ib@yahoo.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("1024","9879688374123","","person.png","Sofia","Garcia","Cruz","1-A Los Amigos","Tugbok, Davao City","2000-09-18","22","Single","Female","1-A","Yes","","09272938801","cyberlez12345@gmail.com","Teacher","","1","","");
INSERT INTO tblpurok_records VALUES("992","7019790723-5324","Filipino","03072023123634person.png","Gabriel","Dela Cruz","Cruz","Tugbok, Los Amigos","Cebu City","1977-06-11","46","Single","Male","3-B","Yes","000123 456992","9271837730","bx8il6h63h@yahoo.com","Sel-employed","Bank Requirements","1","","");
INSERT INTO tblpurok_records VALUES("993","4319750420-2700","Filipino","03072023123634person.png","Andrea","Ramos","Rodriguez","Tugbok, Los Amigos","Cadiz","2000-09-19","22","Single","Male","6B-4","Yes","000123 456993","9674021826","8re6l6t1l0@gmail.com","Student","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("994","7719930706-2405","Filipino","03072023123634person.png","Manuel","Torres","Gonzales","Tugbok, Los Amigos","Mati","1975-06-16","48","Married","Male","6B-4","No","000123 456994","9874567234","unu4o9j6ny@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("995","6819610617-2064","Filipino","03072023123634person.png","Maria","Reyes","Dela Cruz","Tugbok, Los Amigos","Naga","1998-04-26","25","Married","Male","6-C","No","000123 456995","9272476032","v85j46cs1y@gmail.com","Sel-employed","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("997","7019650724-6904","Filipino","03072023123634person.png","Juanito","Aquino","Santos","Tugbok, Los Amigos","Pagadian","1985-07-09","37","Single","Male","6B6-A","No","000123 456997","9776734385","w9vj3f6lt3@gmail.com","N/A","Scholarship Requirements","1","","");
INSERT INTO tblpurok_records VALUES("998","7019800704-3741","Filipino","03072023123634person.png","Patricia","Dela Cruz","Cruz","Tugbok, Los Amigos","Himamaylan","1993-09-29","29","Single","Male","8-B","No","000123 456998","9874141329","vr3qxbb9fw@gmail.com","N/A","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("999","3119670504-0434","Filipino","03072023123634person.png","Alejandro","Santos","Aquino","1-A Los Amigos","Mati","1993-10-14","29","Single","Male","10-A","No","1231123123671","9272018022","kcyq2uvghg@gmail.com","N/A","Bank Requirements","1","4ps Requirements","");
INSERT INTO tblpurok_records VALUES("1000","1020011021-5827","Filipino","03072023123634person.png","Carmen","Reyes","Fernandez","Tugbok, Los Amigos","Koronadal","1976-03-27","47","Married","Male","7","No","000123 457000","9776734385","m7sfhixudw@gmail.com","Sel-employed","Employment Requirements","1","","");
INSERT INTO tblpurok_records VALUES("1025","BLA - 202378","","person.png","ASNIDA","A.","PANGCATAN","TUGBOK, LOS AMIGOS","DAVAO CITY","1997-06-07","26","Single","Female","1-B Graceland","Yes","","09460420068","a.pangcatan.441914@umindanao.edu.ph","","","0","","");
INSERT INTO tblpurok_records VALUES("1026","BLA-202368","","person.png","Wimple","Aira","Umaoeng","11-A Los Amigos","Tugbok, Los Amigos","2000-09-18","22","Single","Female","11-A","Yes","","09272938801","iraauy12345@gmail.com","Teacher","","1","","");



#
# Delete any existing table `tblresidency`
#

DROP TABLE IF EXISTS `tblresidency`;


#
# Table structure of table `tblresidency`
#



CREATE TABLE `tblresidency` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `cert_name` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `resident_year` int(11) NOT NULL,
  `requirement` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`res_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




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
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birthplace` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `civilstatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `purok` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `voterstatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `taxno` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `resident_type` int(11) DEFAULT 1,
  `purpose` text DEFAULT NULL,
  `residency_status` varchar(50) NOT NULL,
  `certificate_name` varchar(50) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `residency_date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO tblresident VALUES("1","BLA - 2023198","Filipino","20082023125804portrait.jpg","Wimple","Aira","Umaoeng","1-A Los Amigos, Davao City","Tugbok, Los Amigos","2000-09-18","22","Single","Female","1-A","Yes","1231123123","09272938801","cyberlez12345@gmail.com","Teacher","","1","","approved","","Wimple Aira Umaoeng","2023-08-19");



#
# Delete any existing table `tblresident_requested`
#

DROP TABLE IF EXISTS `tblresident_requested`;


#
# Table structure of table `tblresident_requested`
#



CREATE TABLE `tblresident_requested` (
  `cert_id` int(10) NOT NULL AUTO_INCREMENT,
  `req_cert_id` varchar(50) DEFAULT NULL,
  `resident_name` varchar(100) NOT NULL,
  `certificate_name` varchar(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  `requirement` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`cert_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


