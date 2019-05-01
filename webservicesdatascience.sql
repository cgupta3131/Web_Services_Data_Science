-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2019 at 01:39 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webservicesdatascience`
--

-- --------------------------------------------------------

--
-- Table structure for table `Advertisements`
--

CREATE TABLE `Advertisements` (
  `header` varchar(128) NOT NULL,
  `details` text NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Advertisements`
--

INSERT INTO `Advertisements` (`header`, `details`, `deadline`) VALUES
('New Admission', 'Welcome Students, Admission for Data Science! Please send your Application whosoever is Willing to join IIT Guwahati', '2019-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `contact` text NOT NULL,
  `age` int(11) NOT NULL,
  `graduationyear` int(11) NOT NULL,
  `graduationfield` varchar(128) NOT NULL,
  `gatescore` int(11) NOT NULL,
  `application_number` text,
  `selected` varchar(5) DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`name`, `email`, `contact`, `age`, `graduationyear`, `graduationfield`, `gatescore`, `application_number`, `selected`) VALUES
('Harit Gupta', 'hgupta@gmail.com', '789456123', 18, 2018, 'CSE', 98, '702512866113', 'True'),
('Mehul Chaturvedu', 'mehul@gmail.com', '7894561230', 20, 2016, 'EE', 80, '14765665373', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `CourseAssignments`
--

CREATE TABLE `CourseAssignments` (
  `CourseID` char(255) DEFAULT NULL,
  `AssignmentID` char(255) DEFAULT NULL,
  `Details` mediumtext,
  `Deadline` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssignmentFile` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CourseAssignments`
--

INSERT INTO `CourseAssignments` (`CourseID`, `AssignmentID`, `Details`, `Deadline`, `AssignmentFile`) VALUES
('CS210', 'CS123', 'First Assignment For All the Students', '2019-05-08 21:58:00', '/opt/lampp/htdocs/Web_Services_Data_Science/media/courses/CS210/assignments/CS123/document.pdf'),
('CS210', '78-AB', 'One more assignment (Optional)', '2019-05-11 23:55:00', '/opt/lampp/htdocs/Web_Services_Data_Science/media/courses/CS210/assignments/78-AB/document (11).pdf'),
('CS210', 'PD-123', 'New Assignment', '2019-05-11 05:12:00', '/opt/lampp/htdocs/Web_Services_Data_Science/media/courses/CS210/assignments/PD-123/document (6).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `CourseNotices`
--

CREATE TABLE `CourseNotices` (
  `CourseID` char(255) DEFAULT NULL,
  `Username` char(255) DEFAULT NULL,
  `NoticeHead` text,
  `NoticeBody` mediumtext,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CourseNotices`
--

INSERT INTO `CourseNotices` (`CourseID`, `Username`, `NoticeHead`, `NoticeBody`, `DateTime`) VALUES
('CS210', 'saish@gmail.com', 'New Course Added', 'This is to Inform that New Course has been Added in our Curriculum. Who so ever is Interested can Apply for the Course.', '2019-05-01 23:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(128) NOT NULL,
  `course_id` varchar(128) NOT NULL,
  `about_course` varchar(10000) NOT NULL,
  `start_semester` varchar(128) NOT NULL,
  `username` text,
  `seats_remaining` int(11) DEFAULT NULL,
  `last_date` date NOT NULL,
  `Application_Status` varchar(100) NOT NULL DEFAULT 'Closed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_id`, `about_course`, `start_semester`, `username`, `seats_remaining`, `last_date`, `Application_Status`) VALUES
(32, 'Graph Algorithms and Data Structures', 'CS210', 'This Course will give you Insight about the Algorithms concerning Graphs and Trees.', 'Spring', 'saish@gmail.com', 20, '2019-05-04', 'Completed'),
(33, 'CS243', 'System Software ', 'Will let you know about Details of Software and learn more about Linux Structure.', 'Fall', 'saish@gmail.com', 20, '0000-00-00', 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `EnrolledStudents`
--

CREATE TABLE `EnrolledStudents` (
  `CourseID` char(255) DEFAULT NULL,
  `Username` char(255) DEFAULT NULL,
  `Grade` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EnrolledStudents`
--

INSERT INTO `EnrolledStudents` (`CourseID`, `Username`, `Grade`) VALUES
('CS210', 'hgupta@gmail.com', 'AS'),
('CS210', 'mehul@gmail.com', 'AB');

-- --------------------------------------------------------

--
-- Table structure for table `HomeNotices`
--

CREATE TABLE `HomeNotices` (
  `NoticeHead` text,
  `NoticeBody` mediumtext,
  `Username` char(255) DEFAULT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `HomeNotices`
--

INSERT INTO `HomeNotices` (`NoticeHead`, `NoticeBody`, `Username`, `DateTime`) VALUES
('New Staff Joining', 'Data Science Students Please Take Note of this', 'cgupta3131@gmail.com', '2019-05-01 22:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `Publish_results`
--

CREATE TABLE `Publish_results` (
  `IsOpen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Publish_results`
--

INSERT INTO `Publish_results` (`IsOpen`) VALUES
('Yes');

-- --------------------------------------------------------

--
-- Table structure for table `RequestCourse`
--

CREATE TABLE `RequestCourse` (
  `courseID` text NOT NULL,
  `UserName` varchar(128) NOT NULL,
  `FacultyName` varchar(128) NOT NULL,
  `gateScore` int(11) NOT NULL,
  `CPI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RequestCourse`
--

INSERT INTO `RequestCourse` (`courseID`, `UserName`, `FacultyName`, `gateScore`, `CPI`) VALUES
('CS210', 'mehul@gmail.com', 'saish@gmail.com', 80, 0),
('CS210', 'hgupta@gmail.com', 'saish@gmail.com', 98, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Username` char(100) NOT NULL,
  `Password` text,
  `RollNumber` char(255) DEFAULT NULL,
  `FullName` char(255) DEFAULT NULL,
  `Designation` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Username`, `Password`, `RollNumber`, `FullName`, `Designation`) VALUES
('cgupta3131@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Chirag Gupta', 'Staff'),
('chirag@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Chirag Gupta', 'Faculty'),
('hgupta@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '190101001', 'Harit Gupta', 'Student'),
('mehul@gmail.com', '015dd42a595f1ba305ddb5aee6ff5906', '190101002', 'Mehul Chaturvedu', 'Student'),
('saish@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Saish', 'Faculty');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `RollNumber` (`RollNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
