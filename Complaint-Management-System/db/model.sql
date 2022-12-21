-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2020 at 04:17 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

DROP DATABASE cms;
CREATE DATABASE IF NOT EXISTS cms;
USE cms;


START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(250) NOT NULL,
  `password_hash` varchar(250) NOT NULL,
  `updateDate` varchar(255) NOT NULL
);


-- Dumping data for table `admin`

INSERT INTO `admin` (`id`, `username`, `password_hash`, `updateDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '08-05-2020 07:23:45 PM');



CREATE TABLE lecturer (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL
  );

CREATE TABLE course (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `code` varchar(255) NOT NULL
);

CREATE TABLE course_lecture (
  `course_id` INT NOT NULL,
  `lecture_id` INT NOT NULL,
  PRIMARY KEY (course_id, lecture_id),
  FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE  ,
  FOREIGN KEY (lecture_id) REFERENCES lecturer(id) ON DELETE CASCADE 
);

CREATE TABLE student (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fullName` varchar(255) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `matric_number` varchar(255) NOT NULL,

  UNIQUE(matric_number)
);

CREATE TABLE complaint (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `student_id` INT NOT NULL,
  `course_id` INT NOT NULL,
  `lecturer_id` INT NOT NULL,
  `complaint_text` TEXT NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` INT NOT NULL DEFAULT 1,
  `lastUpdateDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  
  FOREIGN KEY (student_id) REFERENCES student(id) ON DELETE CASCADE,
  FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE,
  FOREIGN KEY (lecturer_id) REFERENCES lecturer(id) ON DELETE CASCADE
);

CREATE TABLE complaint_status (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `status` VARCHAR(255) NOT NULL
);

INSERT INTO `complaint_status` (`id`, `status`) VALUES ('1', 'Pending'), ('2', 'In Progress'), ('3', 'Closed');
-- --------------------------------------------------------

--
-- Table structure for table `complaintremark`
--


-- --------------------------------------------------------

--
-- Table structure for table `category`
--

-- CREATE TABLE `category` (
--   `id` int(11) NOT NULL,
--   `categoryName` varchar(255) NOT NULL,
--   `categoryDescription` longtext NOT NULL,
--   `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `updateDate` varchar(255) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- CREATE TABLE `complaintremark` (
--   `id` int(11) NOT NULL,
--   `complaintNumber` int(11) NOT NULL,
--   `status` varchar(255) NOT NULL,
--   `remark` mediumtext NOT NULL,
--   `remarkDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `state`
-- --

-- CREATE TABLE `state` (
--   `id` int(11) NOT NULL,
--   `stateName` varchar(255) NOT NULL,
--   `stateDescription` tinytext NOT NULL,
--   `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `updationDate` varchar(255) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `subcategory`
-- --

-- CREATE TABLE `subcategory` (
--   `id` int(11) NOT NULL,
--   `categoryid` int(11) NOT NULL,
--   `subcategory` varchar(255) NOT NULL,
--   `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `updationDate` varchar(255) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `tblcomplaints`
-- --

-- CREATE TABLE `tblcomplaints` (
--   `complaintNumber` int(11) NOT NULL,
--   `userId` int(11) NOT NULL,
--   `category` int(11) NOT NULL,
--   `subcategory` varchar(255) NOT NULL,
--   `complaintType` varchar(255) NOT NULL,
--   `state` varchar(255) NOT NULL,
--   `noc` varchar(255) NOT NULL,
--   `complaintFile` varchar(255) DEFAULT NULL,
--   `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `status` varchar(50) DEFAULT NULL,
--   `lastUpdationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `userlog`
-- --

-- --
-- -- Dumping data for table `userlog`
-- --

-- INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
-- (1, 0, 'john@gmail.com', 0x3a3a3100000000000000000000000000, '2020-05-08 14:14:43', '', 0),
-- (2, 1, 'john@gmail.com', 0x3a3a3100000000000000000000000000, '2020-05-08 14:14:50', '08-05-2020 07:44:51 PM', 1),
-- (3, 1, 'john@gmail.com', 0x3a3a3100000000000000000000000000, '2020-05-08 14:16:30', '', 1);

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `users`
-- --

-- CREATE TABLE `users` (
--   `id` int(11) NOT NULL,
--   `userEmail` varchar(255) DEFAULT NULL,
--   `password` varchar(255) DEFAULT NULL,
--   `contactNo` bigint(11) DEFAULT NULL,
--   `address` tinytext,
--   `State` varchar(255) DEFAULT NULL,
--   `country` varchar(255) DEFAULT NULL,
--   `pincode` int(6) DEFAULT NULL,
--   `userImage` varchar(255) DEFAULT NULL,
--   `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
--   `status` int(1) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --
-- -- Dumping data for table `users`
-- --

-- INSERT INTO `users` (`id`, `fullName`, `userEmail`, `password`, `contactNo`, `address`, `State`, `country`, `pincode`, `userImage`, `regDate`, `updationDate`, `status`) VALUES
-- (1, 'John Smith', 'john@gmail.com', '202cb962ac59075b964b07152d234b70', 9999999999, NULL, NULL, NULL, NULL, NULL, '2020-05-08 14:10:50', '2020-05-08 14:16:22', 1);

-- --
-- -- Indexes for dumped tables
-- --

-- --
-- -- Indexes for table `admin`
-- --
-- ALTER TABLE `admin`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `category`
-- --
-- ALTER TABLE `category`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `complaintremark`
-- --
-- ALTER TABLE `complaintremark`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `state`
-- --
-- ALTER TABLE `state`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `subcategory`
-- --
-- ALTER TABLE `subcategory`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `tblcomplaints`
-- --
-- ALTER TABLE `tblcomplaints`
--   ADD PRIMARY KEY (`complaintNumber`);

-- --
-- -- Indexes for table `userlog`
-- --
-- ALTER TABLE `userlog`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `users`
-- --
-- ALTER TABLE `users`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- AUTO_INCREMENT for dumped tables
-- --

-- --
-- -- AUTO_INCREMENT for table `admin`
-- --
-- ALTER TABLE `admin`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- --
-- -- AUTO_INCREMENT for table `category`
-- --
-- ALTER TABLE `category`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT for table `complaintremark`
-- --
-- ALTER TABLE `complaintremark`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT for table `state`
-- --
-- ALTER TABLE `state`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT for table `subcategory`
-- --
-- ALTER TABLE `subcategory`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT for table `tblcomplaints`
-- --
-- ALTER TABLE `tblcomplaints`
--   MODIFY `complaintNumber` int(11) NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT for table `userlog`
-- --
-- ALTER TABLE `userlog`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- --
-- -- AUTO_INCREMENT for table `users`
-- --
-- ALTER TABLE `users`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
