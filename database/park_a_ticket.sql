-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2020 at 06:39 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `park_a_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `parking_locations`
--

CREATE TABLE `parking_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parking_locations`
--

INSERT INTO `parking_locations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'C-11', '2020-09-19 09:55:10', '2020-09-19 09:55:10'),
(2, 'C-12', '2020-09-19 09:55:18', '2020-09-19 09:55:18'),
(3, 'C-13', '2020-09-19 09:55:27', '2020-09-19 09:55:27'),
(4, 'D-11', '2020-09-19 09:55:36', '2020-09-19 09:55:36'),
(5, 'D-12', '2020-09-19 09:55:46', '2020-09-19 09:55:46'),
(6, 'D-13', '2020-09-19 09:55:55', '2020-09-19 09:55:55'),
(7, 'E-11', '2020-09-20 10:10:35', '2020-09-20 10:10:35'),
(8, 'E-12', '2020-09-20 10:10:42', '2020-09-20 10:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_users`
--

CREATE TABLE `ticket_users` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `car_number` varchar(10) NOT NULL,
  `parking_location` int(11) NOT NULL,
  `mobile` varchar(24) NOT NULL,
  `otp` int(11) NOT NULL,
  `time` int(10) NOT NULL,
  `total_cost` int(30) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_users`
--

INSERT INTO `ticket_users` (`id`, `name`, `car_number`, `parking_location`, `mobile`, `otp`, `time`, `total_cost`, `status`, `created_at`, `updated_at`) VALUES
(22, 'K M Safwan Hassan', '34-5678', 3, '8801703980587', 787002, 6, 360, 0, '2020-09-20 10:26:28', '2020-09-20 10:26:28'),
(23, 'Safwan', '34-5678', 7, '8801703980587', 504432, 5, 500, 0, '2020-09-20 10:31:03', '2020-09-20 10:31:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parking_locations`
--
ALTER TABLE `parking_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_users`
--
ALTER TABLE `ticket_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parking_locations`
--
ALTER TABLE `parking_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ticket_users`
--
ALTER TABLE `ticket_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
