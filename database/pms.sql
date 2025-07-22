-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2023 at 02:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_archieve`
--

CREATE TABLE `tbl_archieve` (
  `archieve_project_id` int(10) UNSIGNED NOT NULL,
  `archieve_status` varchar(255) NOT NULL DEFAULT 'Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assign_role`
--

CREATE TABLE `tbl_assign_role` (
  `assign_user_id` int(10) UNSIGNED NOT NULL,
  `assign_role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `events_id` int(10) UNSIGNED NOT NULL,
  `events_from_id` int(10) UNSIGNED DEFAULT NULL,
  `events_to_id` int(10) UNSIGNED DEFAULT NULL,
  `events_description` varchar(255) DEFAULT NULL,
  `events_status` varchar(255) DEFAULT NULL,
  `events_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`events_id`, `events_from_id`, `events_to_id`, `events_description`, `events_status`, `events_date`) VALUES
(14, 3, 2, 'sad', 'Meeting Assigned', '2023-03-25'),
(15, 1, 3, 'This is request', 'Meeting Rejected', '2023-03-31'),
(16, 1, 3, 'Sir please', 'Meeting Accepted', '2023-03-31'),
(17, 1, 3, 'thank you', 'Meeting Accepted', '2023-03-30'),
(18, 1, 3, 'aa', 'Meeting Rejected', '2023-03-24'),
(20, 1, 3, 'Sir can we meet', 'Meeting Accepted', '2023-03-31'),
(21, 1, 3, 'Please we wanna meet', 'Meeting Rejected', '2023-03-24'),
(22, 3, 1, 'Yo din aaijaa..', 'Meeting Assigned', '2023-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ext_logbook`
--

CREATE TABLE `tbl_ext_logbook` (
  `ext_logbook_id` int(10) UNSIGNED NOT NULL,
  `ext_user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ext_task`
--

CREATE TABLE `tbl_ext_task` (
  `ext_task_id` int(10) UNSIGNED DEFAULT NULL,
  `ext_uploaded_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ext_task`
--

INSERT INTO `tbl_ext_task` (`ext_task_id`, `ext_uploaded_file`) VALUES
(6, 'files/final.docx'),
(6, 'files/'),
(6, 'files/final.docx'),
(6, 'files/Basic LR.pdf'),
(6, 'files/Basic LR.pdf'),
(6, 'files/Basic LR.pdf'),
(6, 'files/Basic LR.pdf'),
(6, 'files/final.docx'),
(6, 'files/Basic LR.pdf'),
(15, 'files/final.docx'),
(3, 'files/final.docx'),
(25, 'files/73445 (1).jpg'),
(25, 'files/ERD.jpg'),
(15, 'files/final.docx');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ext_user`
--

CREATE TABLE `tbl_ext_user` (
  `ext_user_id` int(10) UNSIGNED DEFAULT NULL,
  `ext_project_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ext_user`
--

INSERT INTO `tbl_ext_user` (`ext_user_id`, `ext_project_id`) VALUES
(2, 1),
(4, 1),
(3, 1),
(3, 2),
(6, 2),
(7, 2),
(8, 2),
(5, 1),
(12, 3),
(11, 3),
(10, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty`
--

CREATE TABLE `tbl_faculty` (
  `faculty_Id` int(11) UNSIGNED NOT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_faculty`
--

INSERT INTO `tbl_faculty` (`faculty_Id`, `faculty_name`, `is_active`) VALUES
(1, 'Science And Technology', 'Yes'),
(2, 'Enginneering', 'Yes'),
(3, 'Law', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(10) UNSIGNED NOT NULL,
  `feedback_from_id` int(10) UNSIGNED DEFAULT NULL,
  `feedback_to_id` int(10) UNSIGNED DEFAULT NULL,
  `feedback_created` date NOT NULL DEFAULT current_timestamp(),
  `feedback_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logbook`
--

CREATE TABLE `tbl_logbook` (
  `logbook_id` int(10) UNSIGNED NOT NULL,
  `logbook_project_id` int(11) UNSIGNED NOT NULL,
  `logbook_created` date NOT NULL DEFAULT current_timestamp(),
  `logbook_completed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `notification_id` int(10) UNSIGNED NOT NULL,
  `notification_from_id` int(10) UNSIGNED NOT NULL,
  `notification_to_id` int(10) UNSIGNED NOT NULL,
  `notification_message` varchar(255) NOT NULL,
  `notification_status` varchar(255) NOT NULL DEFAULT 'Unseen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program`
--

CREATE TABLE `tbl_program` (
  `program_id` int(10) UNSIGNED NOT NULL,
  `program_faculty_id` int(11) UNSIGNED NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `program_description` varchar(255) NOT NULL,
  `program_duration` varchar(255) NOT NULL,
  `program_type` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_program`
--

INSERT INTO `tbl_program` (`program_id`, `program_faculty_id`, `program_name`, `program_description`, `program_duration`, `program_type`, `is_active`) VALUES
(1, 1, 'BIT', 'BACHELOR OF INFORMATION TECHNOLOGY', '4 Years', 'Undergraduate', 'Yes'),
(2, 1, 'BCA', 'BACHELOR OF COMPUTER APPLICATION', '4 Years', 'Undergraduate', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE `tbl_project` (
  `project_id` int(10) UNSIGNED NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_frontend` varchar(255) NOT NULL,
  `project_backend` varchar(255) NOT NULL,
  `project_sdlc` varchar(255) NOT NULL,
  `project_created` date NOT NULL DEFAULT current_timestamp(),
  `project_abstract` varchar(255) NOT NULL,
  `project_ppt` varchar(255) NOT NULL,
  `project_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `project_priority` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`project_id`, `project_name`, `project_frontend`, `project_backend`, `project_sdlc`, `project_created`, `project_abstract`, `project_ppt`, `project_status`, `project_priority`) VALUES
(1, 'Project Manager', 'Html,Css,JavaScript', 'php', 'ProtoType', '2023-03-23', 'Pope John XXIII Middle School is currently accepting applications for the 2023-2024 school year! We invite students entering grades 5-7 to visit our school and spend the day with us.Click Here to schedule your visit or contact our admissions office at adm', 'location', 'Pending', 'High'),
(2, 'Handy Craft', 'Html, Css, Js', 'Php', 'WaterFall', '2023-03-05', 'Hello this is abstract', 'this is ppt location', 'Approved', 'Medium'),
(3, 'Molestiae omnis ei us', 'Omnis consequuntur i ', 'In mollitia na tus am', 'WaterFall', '2023-03-21', 'Voluptatem dolore s ', 'Soon..', 'Approved', 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `task_id` int(10) UNSIGNED NOT NULL,
  `task_from_id` int(10) UNSIGNED DEFAULT NULL,
  `task_to_id` int(10) UNSIGNED DEFAULT NULL,
  `task_title` varchar(255) NOT NULL,
  `task_phase` varchar(255) NOT NULL,
  `task_description` text NOT NULL,
  `task_priority` varchar(255) NOT NULL,
  `task_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `task_file` varchar(255) DEFAULT NULL,
  `task_created` date NOT NULL DEFAULT current_timestamp(),
  `task_deadline` date NOT NULL,
  `task_submitted` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`task_id`, `task_from_id`, `task_to_id`, `task_title`, `task_phase`, `task_description`, `task_priority`, `task_status`, `task_file`, `task_created`, `task_deadline`, `task_submitted`) VALUES
(2, 3, 2, 'Documentation', 'Testing', 'This is to be done till the', 'High', 'Completed', 'Soon..', '2023-03-14', '2023-04-06', '2023-03-23'),
(3, 3, 1, 'Test ', 'Testing', 'please test before release', 'Medium', 'Submitted Late', 'Soon..', '2023-03-14', '2023-03-15', '2023-04-23'),
(4, 3, 2, 'Analysis', 'Requirement Analysis', 'Analysis is must important', 'High', 'Pending', 'Soon..', '2023-03-14', '2023-03-15', '2023-03-23'),
(5, 3, 2, 'Ariel Ellis ', 'System Design', 'Qui vitae sed iste possimus omnis iusto ullam nihil ullamco cupiditate ', 'Medium', 'Pending', 'Soon', '2023-03-14', '1983-09-15', '2023-03-23'),
(6, 3, 1, 'Juliet Jackson ', 'Building ProtoType', 'Odio consequat Quia proident deser unt est nulla suscipit obcaecati molestiae quibusdam non eligend', 'Medium', 'Completed', 'Soon..', '2023-03-14', '2028-05-10', '2023-03-23'),
(7, 3, 1, 'Raya Harmon ', 'Testing', 'Qui non Nam pariatur Quis rerum tota m non velit amet irure voluptatem fugiat id dolore laborum fu', 'Medium', 'Completed', 'Soon..', '2023-03-14', '1978-10-21', '2023-04-23'),
(14, 3, 2, 'This is new', 'Testing', 'this is the paragraph description', 'Medium', 'Pending', 'Soon', '2023-03-15', '2023-03-25', '2023-03-23'),
(15, 3, 1, 'Calvin Sexton ', 'Quick Design', 'Fugiat adipisci amet atque c onsequatur', 'High', 'Submitted Late', 'Soon..', '2023-03-15', '2023-03-20', '2023-03-23'),
(16, 3, 2, 'Bradley Neal ', 'Implementation', 'Sunt quis dolore ipsum et ipsam aut est ', 'High', 'Pending', 'Soon..', '2023-03-15', '2024-01-04', '2023-03-23'),
(18, 3, 2, 'Kuame Weeks', 'Implementation', 'Et molestiae est sunt rerum nihil accusamus natus et esse corporis fuga Eaque accusantium perspic', 'Low', 'Pending', 'Soon', '2023-03-15', '2024-11-30', '2023-03-23'),
(22, 3, 2, 'Reece Pennington ', 'System Design', 'Tempore vero est porro exercitation veniam asperiores incididunt autem nisi autem consectetur ', 'High', 'Completed', 'Soon', '2023-03-16', '2033-07-21', '2023-03-23'),
(25, 3, 1, 'Eden Moreno ', 'Testing', 'Non ex ex qui sit eum excepteur deserunt odit p erferendis atque eiusmod qui', 'High', 'Submitted Late', 'Soon..', '2023-03-17', '2023-03-18', '2023-03-23'),
(26, 3, 1, 'melina', 'Requirement Analysis', 'asdf asdfasf asf asfasdf', 'Medium', 'Pending', 'Soon', '2023-03-23', '2023-03-24', '2023-03-23'),
(27, 3, 2, 'Blaine Roth ', 'Requirement Analysis', 'Et dolore ea voluptatem Reprehenderit quisquams ea autem', 'Low', 'Pending', 'Soon..', '2023-03-23', '2025-11-13', '2023-03-23'),
(28, 3, 1, 'Task Check', 'Requirement Analysis', 'Do this task it is very imp.', 'Medium', 'Pending', 'Soon..', '2023-03-24', '2023-03-25', '2023-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_program_id` int(10) UNSIGNED DEFAULT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_faculty` varchar(255) NOT NULL,
  `user_phone` bigint(20) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_program_id`, `user_role`, `user_name`, `user_faculty`, `user_phone`, `user_email`, `user_password`, `user_pic`) VALUES
(1, NULL, 'Teacher', 'Sheila Fischer', 'Nostrud eaque sunt e', 1, 'vakas@mailinator.com', 'Pa$$w0rd!', ''),
(2, 1, 'Student', 'Samir Shrestha', 'Science And Technology', 9807898070, 'samirshrestha9807@gmail.com', 'samir', 'images/saw.jpg'),
(3, NULL, 'Teacher', 'Utsav Maharjan', 'Science And Technology', 9807898070, 'utsavmaharjan@gmail.com', 'utsav', 'images/326475352_842685286834527_6870009029398673099_n.jpg'),
(4, 1, 'Student', 'Sarowor Malla', 'Science And Technology', 9123456789, 'sarowor@gmail.com', 'Sarowor@1', 'images/saro.jpg'),
(5, 1, 'Student', 'Melina Rayamajhi', 'Science And Technology', 9231242311, 'melina@gmail.com', 'Melina@1', 'images/meli.jpg'),
(6, 1, 'Student', 'Bishal Tamang', 'Science And Technology', 9807898070, 'bishal@gmail.com', 'Bishal@1', 'images/bis.jpg'),
(7, 1, 'Student', 'Shristi Pradhan', 'Science And Technology', 9807121222, 'shristi@gmail.com', 'Shristi@1%', 'images/user.png'),
(8, 1, 'Student', 'Prajita Bhattrai', 'Science And Technology', 9812121213, 'prajita@gmail.com', 'Prajita@1%', 'images/pra.jpg'),
(9, 1, 'Student', 'Yogesh Rajbanshi', 'Science And Technology', 9807898070, 'yogesh@gmail.com', 'Yogesh@1', 'images/user.png'),
(10, 1, 'Student', 'Laxman Basnet', 'Science And Technology', 9807898010, 'laxman@gmail.com', 'Laxman@1', 'images/user.png'),
(11, 1, 'Student', 'Subash Pandey', 'Science And Technology', 9802298070, 'subash@gmail.com', 'Subash@1', 'images/user.png'),
(12, 1, 'Student', 'Nima Sherpa', 'Science And Technology', 9807891170, 'nima@gmail.com', 'NimaSherpa@1', 'images/user.png'),
(13, 1, 'Student', 'Luniva Shrestha', 'Science And Technology', 9872298070, 'luniva@gmail.com', 'Luniva@1', 'images/user.png'),
(14, 1, 'Student', 'Rupak Dangi', 'Science And Technology', 9812133231, 'rupak@gmail.com', 'Rupak@11', 'images/DFD_0.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_archieve`
--
ALTER TABLE `tbl_archieve`
  ADD KEY `foreign_project_archieve` (`archieve_project_id`);

--
-- Indexes for table `tbl_assign_role`
--
ALTER TABLE `tbl_assign_role`
  ADD KEY `foreign_role_assign` (`assign_role_id`),
  ADD KEY `foreign_user_assign` (`assign_user_id`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`events_id`);

--
-- Indexes for table `tbl_ext_logbook`
--
ALTER TABLE `tbl_ext_logbook`
  ADD KEY `foreign_logbook_ext` (`ext_logbook_id`),
  ADD KEY `foreign_user_ext` (`ext_user_id`);

--
-- Indexes for table `tbl_ext_user`
--
ALTER TABLE `tbl_ext_user`
  ADD KEY `foreign_ext_project` (`ext_project_id`),
  ADD KEY `foreign_ext_user` (`ext_user_id`);

--
-- Indexes for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  ADD PRIMARY KEY (`faculty_Id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `foreign_from_feedback` (`feedback_from_id`),
  ADD KEY `foreign_to_feedback` (`feedback_to_id`);

--
-- Indexes for table `tbl_logbook`
--
ALTER TABLE `tbl_logbook`
  ADD PRIMARY KEY (`logbook_id`),
  ADD KEY `foreign_project_logbook` (`logbook_project_id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `foreign_from_notification` (`notification_from_id`),
  ADD KEY `foreign_to_notification` (`notification_to_id`);

--
-- Indexes for table `tbl_program`
--
ALTER TABLE `tbl_program`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `foreign_faculty_program` (`program_faculty_id`);

--
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `foreign_from_task` (`task_from_id`),
  ADD KEY `foreign_to_task` (`task_to_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `foreign_program_user` (`user_program_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `events_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  MODIFY `faculty_Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_logbook`
--
ALTER TABLE `tbl_logbook`
  MODIFY `logbook_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `notification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_program`
--
ALTER TABLE `tbl_program`
  MODIFY `program_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_project`
--
ALTER TABLE `tbl_project`
  MODIFY `project_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `task_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_archieve`
--
ALTER TABLE `tbl_archieve`
  ADD CONSTRAINT `foreign_project_archieve` FOREIGN KEY (`archieve_project_id`) REFERENCES `tbl_project` (`project_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_assign_role`
--
ALTER TABLE `tbl_assign_role`
  ADD CONSTRAINT `foreign_role_assign` FOREIGN KEY (`assign_role_id`) REFERENCES `tbl_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_user_assign` FOREIGN KEY (`assign_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ext_logbook`
--
ALTER TABLE `tbl_ext_logbook`
  ADD CONSTRAINT `foreign_logbook_ext` FOREIGN KEY (`ext_logbook_id`) REFERENCES `tbl_logbook` (`logbook_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_user_ext` FOREIGN KEY (`ext_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ext_user`
--
ALTER TABLE `tbl_ext_user`
  ADD CONSTRAINT `foreign_ext_project` FOREIGN KEY (`ext_project_id`) REFERENCES `tbl_project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_ext_user` FOREIGN KEY (`ext_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `foreign_from_feedback` FOREIGN KEY (`feedback_from_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_to_feedback` FOREIGN KEY (`feedback_to_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_logbook`
--
ALTER TABLE `tbl_logbook`
  ADD CONSTRAINT `foreign_project_logbook` FOREIGN KEY (`logbook_project_id`) REFERENCES `tbl_project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD CONSTRAINT `foreign_from_notification` FOREIGN KEY (`notification_from_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_to_notification` FOREIGN KEY (`notification_to_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_program`
--
ALTER TABLE `tbl_program`
  ADD CONSTRAINT `foreign_faculty_program` FOREIGN KEY (`program_faculty_id`) REFERENCES `tbl_faculty` (`faculty_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD CONSTRAINT `foreign_from_task` FOREIGN KEY (`task_from_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_to_task` FOREIGN KEY (`task_to_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `foreign_program_user` FOREIGN KEY (`user_program_id`) REFERENCES `tbl_program` (`program_Id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
