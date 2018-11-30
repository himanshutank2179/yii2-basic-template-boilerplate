-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2018 at 10:12 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daily_lottery`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `location_image` varchar(255) NOT NULL,
  `hour` int(255) NOT NULL,
  `minute` int(255) NOT NULL,
  `day_start_time` time NOT NULL,
  `day_end_time` time NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `location_image`, `hour`, `minute`, `day_start_time`, `day_end_time`, `created_at`) VALUES
(1, 'RJ Delhi', '15435590905c00d7b2186875.29293234.jpeg', 0, 15, '09:00:00', '21:00:00', '2018-11-30 11:55:00'),
(2, 'RJ Mumbai', '15435598055c00da7d8ca3b3.97712968.jpeg', 0, 30, '09:00:00', '21:00:00', '2018-11-30 12:07:00'),
(3, 'RJ Kolkata', '15435598605c00dab42bbbf6.82622567.jpg', 1, 0, '09:00:00', '21:00:00', '2018-11-30 12:08:00'),
(4, 'RJ Hyderabad', '15435599275c00daf7ec3541.70162596.jpg', 1, 0, '09:00:00', '21:00:00', '2018-11-30 12:08:00'),
(5, 'Sharjah', '15435608775c00dead6fdf48.03319603.jpeg', 0, 0, '16:30:00', '16:30:00', '2018-11-30 12:25:00'),
(6, '4Minar', '15435609535c00def910e657.40097889.jpeg', 0, 0, '17:00:00', '17:00:00', '2018-11-30 12:26:00'),
(7, 'Rajkot', '15435632865c00e81671c6e2.82427648.png', 0, 20, '15:00:00', '23:55:00', '2018-11-30 13:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_values`
--

CREATE TABLE `ticket_values` (
  `ticket_value_id` int(255) NOT NULL,
  `location_id` int(255) NOT NULL,
  `ticket_value` int(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_values`
--

INSERT INTO `ticket_values` (`ticket_value_id`, `location_id`, `ticket_value`, `date`, `time`, `created_at`) VALUES
(1, 1, 1, '2018-11-30', '09:00:00', '2018-11-30 12:26:33'),
(2, 1, 2, '2018-11-30', '09:15:00', '2018-11-30 12:26:57'),
(3, 1, 3, '2018-11-30', '09:30:00', '2018-11-30 12:27:25'),
(4, 1, 4, '2018-11-30', '09:45:00', '2018-11-30 12:37:20'),
(5, 1, 5, '2018-11-30', '10:00:00', '2018-11-30 12:37:40'),
(6, 2, 11, '2018-11-30', '09:00:00', '2018-11-30 12:38:30'),
(7, 2, 12, '2018-11-30', '09:30:00', '2018-11-30 12:38:50'),
(8, 2, 13, '2018-11-30', '10:00:00', '2018-11-30 12:39:11'),
(9, 3, 21, '2018-11-30', '09:00:00', '2018-11-30 12:40:03'),
(10, 3, 22, '2018-11-30', '10:00:00', '2018-11-30 12:40:18'),
(11, 3, 23, '2018-11-30', '11:00:00', '2018-11-30 12:40:38'),
(12, 4, 31, '2018-11-30', '09:00:00', '2018-11-30 12:42:23'),
(13, 4, 32, '2018-11-30', '11:00:00', '2018-11-30 12:42:41'),
(14, 4, 33, '2018-11-30', '13:00:00', '2018-11-30 12:43:02'),
(15, 7, 65, '2018-11-30', '13:00:00', '2018-11-30 01:07:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `location_name` (`location_name`);

--
-- Indexes for table `ticket_values`
--
ALTER TABLE `ticket_values`
  ADD PRIMARY KEY (`ticket_value_id`),
  ADD KEY `location_id` (`location_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ticket_values`
--
ALTER TABLE `ticket_values`
  MODIFY `ticket_value_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket_values`
--
ALTER TABLE `ticket_values`
  ADD CONSTRAINT `ticket_values_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
