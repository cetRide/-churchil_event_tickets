-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2019 at 02:03 PM
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
-- Database: `churchill_event_tickets`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_accounts`
--

CREATE TABLE `customer_accounts` (
  `account_id` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_accounts`
--

INSERT INTO `customer_accounts` (`account_id`, `name`, `email`, `password`, `created_at`) VALUES
('5dc92f713e0c5', 'cetric okola', 'cetokola2015@gmail.com', '$2y$10$t61gBjTLXkPR073.WNNCK.mV/Bp0mSWc8pwDLXbstRoFdxzNIK7hK', '2019-11-11 09:52:49'),
('5dc92fe46a05a', 'cetric', 'c@gmail.com', '$2y$10$MV3jAJjPOUPkpR5zxSbIiex4xjnJrhjOgpgnjpuJK9ZtEaXoyVLMi', '2019-11-11 09:54:44'),
('5dc930231e611', 'cetric', 'k@gmail.com', '$2y$10$hbjq46nl48RNgVifnK3su.sWX9Cfei7Nv7gNR1rOGh.hf47yGuD4.', '2019-11-11 09:55:47'),
('5dc930583d245', 'Happy', 'h@gmail.com', '$2y$10$Y7sF.VweA9dr.aq8XPpP3uQXNTTov1il/7Zm9ppDRPMp5xAUWFpkC', '2019-11-11 09:56:40');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `location` varchar(256) NOT NULL,
  `banner` varchar(256) NOT NULL,
  `time` datetime DEFAULT NULL,
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
('5dca71908ee2d', 'cet', 'dfgthjuksdfghjklwaesrdtyuioawesrtyuioaesrgtyuji', 'cet', '', '2019-11-11 12:52:49', '20', '20', '20', '20', '2019-11-12 08:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`) VALUES
('2019092600'),
('2019092601'),
('2019092602'),
('SCHEMA_INIT');

-- --------------------------------------------------------

--
-- Table structure for table `reserved_tickets`
--

CREATE TABLE `reserved_tickets` (
  `id` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `event_id` varchar(256) NOT NULL,
  `vip_ticket_quantity` varchar(256) NOT NULL,
  `regular_ticket_quantity` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_accounts`
--
ALTER TABLE `customer_accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
  ADD CONSTRAINT `reserved_tickets_event_id_events_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `reserved_tickets_user_id_customer_accounts_account_id_foreign` FOREIGN KEY (`email`) REFERENCES `customer_accounts` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
