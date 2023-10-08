-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2023 at 06:49 PM
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
(36, 3, 1, 'Gather Requirement', 'Requirement Analysis', 'This should be done in time', 'Medium', 'Completed', 'Soon..', '2023-09-07', '2023-09-09', '2023-09-07'),
(37, 3, 2, 'Task1', 'Requirement Analysis', 'complete first phase of your prototype', 'High', 'Completed', 'Soon..', '2023-09-07', '2023-09-16', '2023-09-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `foreign_from_task` (`task_from_id`),
  ADD KEY `foreign_to_task` (`task_to_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `task_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD CONSTRAINT `foreign_from_task` FOREIGN KEY (`task_from_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_to_task` FOREIGN KEY (`task_to_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
