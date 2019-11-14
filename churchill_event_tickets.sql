-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 08:08 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CdEgjh5AXU`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `account_id` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`account_id`, `email`, `password`, `created_at`) VALUES
('5dcbdd2540de3', 'test@gmail.com', '$2y$10$RRCtoE1Npw4KgbDPi/n13edTidbqJt4JqP8PPqBlsjxr9.BPmAuQ6', '2019-11-13 10:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(256) NOT NULL,
  `banner` varchar(256) DEFAULT NULL,
  `time` datetime NOT NULL,
  `vip_allocation` varchar(256) NOT NULL,
  `regular_allocation` varchar(256) NOT NULL,
  `vip_price` varchar(256) NOT NULL,
  `regular_price` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `name`, `description`, `location`, `banner`, `time`, `vip_allocation`, `regular_allocation`, `vip_price`, `regular_price`, `created_at`) VALUES
('5dcc52cc8367e', 'Churchill Show Mariakani', 'We are hereby invited to attend this event', 'Mariakani', '5dcc52cc807378.97711374.jpg', '2019-11-15 21:11:00', '500', '1000', '3500', '1500', '2019-11-13 19:00:28'),
('5dcc537d5f815', 'Churchill Show Makunga', 'Watu wa ingo vipi', 'Makunga', '5dcc537d573d94.33549728.jpg', '2019-11-16 21:11:00', '500', '1000', '3500', '1500', '2019-11-13 19:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `reserved_tickets`
--

CREATE TABLE `reserved_tickets` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `event_id` varchar(256) NOT NULL,
  `vip_ticket_quantity` varchar(256) NOT NULL,
  `regular_ticket_quantity` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `reserved_tickets`
--
ALTER TABLE `reserved_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reserved_tickets_event_id_events_event_id_foreign` (`event_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reserved_tickets`
--
ALTER TABLE `reserved_tickets`
  ADD CONSTRAINT `reserved_tickets_event_id_events_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
