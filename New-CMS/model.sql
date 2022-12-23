
-- DROP DATABASE cms;
CREATE DATABASE IF NOT EXISTS CMS_DB;
USE CMS_DB;


START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(250) NOT NULL,
  `password_hash` varchar(250) NOT NULL,
  `updateDate` varchar(255) NOT NULL
);


INSERT INTO `admin` (`id`, `username`, `password_hash`, `updateDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '08-05-2020 07:23:45 PM');



CREATE TABLE lecturer (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,

  UNIQUE(email)

  );

CREATE TABLE course (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `code` varchar(255) NOT NULL
);

CREATE TABLE course_lecturer (
  `course_id` INT NOT NULL,
  `lecturer_id` INT NOT NULL,
  PRIMARY KEY (course_id, lecturer_id),
  FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE  ,
  FOREIGN KEY (lecturer_id) REFERENCES lecturer(id) ON DELETE CASCADE 
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

COMMIT;
