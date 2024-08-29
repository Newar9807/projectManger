-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2024 at 05:14 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
-- Table structure for table `tbl_query`
--

CREATE TABLE `tbl_query` (
  `query_id` int UNSIGNED NOT NULL,
  `query_from_id` int NOT NULL,
  `query_to_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `query` varchar(255) NOT NULL,
  `query_time` varchar(255) NOT NULL,
  `query_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_query`
--

INSERT INTO `tbl_query` (`query_id`, `query_from_id`, `query_to_id`, `query`, `query_time`, `query_status`) VALUES
(1, 3, '1', 'This is for Q and A', '2024-08-29 15:27:47', 'send'),
(2, 2, '1', 'This is from Q and A', '2024-08-29 15:28:06', 'send'),
(3, 2, '1', 'Sir, reply please', '2024-08-29 16:20:06', 'send'),
(4, 3, '1', 'Okay, I\'m in what\'s the problem', '2024-08-29 16:27:21', 'unread'),
(5, 2, '1', 'We\'re having issue in some thing', '2024-08-29 16:29:29', 'unread'),
(6, 3, '1', 'Now what?', '2024-08-29 16:31:31', 'unread'),
(7, 4, '1', 'We\'re trying to figure out sir.. 🥲🙃', '2024-08-29 16:38:42', 'unread'),
(8, 2, '1', 'We, Kindly request you to accept our meeting request', '2024-08-29 16:40:07', 'unread'),
(9, 4, '1', 'Okay i\'ll check it', '2024-08-29 16:41:35', 'unread'),
(10, 4, '1', 'haha', '2024-08-29 16:41:59', 'unread'),
(11, 3, '1', 'Sarowor, that\'s not funny. You\'re in trouble now.', '2024-08-29 16:44:33', 'unread'),
(12, 4, '1', 'Sry, sir.', '2024-08-29 16:44:57', 'unread'),
(13, 4, '1', 'I\'m really sry', '2024-08-29 16:45:18', 'unread'),
(14, 4, '1', 'My brother sent this message', '2024-08-29 16:45:45', 'unread'),
(15, 3, '1', 'You kidding with me ? ', '2024-08-29 17:03:27', 'unread'),
(16, 2, '1', 'We\'re really sry sir.. Please forgive us', '2024-08-29 17:04:07', 'unread');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_query`
--
ALTER TABLE `tbl_query`
  ADD PRIMARY KEY (`query_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_query`
--
ALTER TABLE `tbl_query`
  MODIFY `query_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
