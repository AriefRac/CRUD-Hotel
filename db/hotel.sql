-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2025 at 02:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` enum('booked','checked_in','checked_out','cancelled') NOT NULL DEFAULT 'booked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `room_id`, `guest_id`, `check_in`, `check_out`, `total_price`, `status`) VALUES
(5, 4, 4, '2025-12-04', '2025-12-10', 600000000, 'checked_in');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `name`, `phone`, `nik`, `address`) VALUES
(2, 'muhamad arief rachmatullah', '08518312312', '00831312', 'ciherang'),
(3, 'arlen', '08524523', '08524234523', 'lampung'),
(4, 'fadil jaidi', '085423829', '1057034', 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status` enum('available','occupied','maintenance') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `type_id`, `status`) VALUES
(4, 'PRS01', 2, 'available'),
(5, 'VIP001', 3, 'available'),
(6, 'VIP002', 3, 'maintenance'),
(7, 'REG001', 4, 'available'),
(8, 'REG002', 4, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `description`, `price`) VALUES
(2, 'Presidential Suite', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lobortis ac turpis eu sollicitudin. Etiam rhoncus fermentum metus, eget tempus leo ultrices tempus. Sed a ultrices turpis. Etiam tincidunt vitae augue at cursus. Duis dictum, augue eget condimentum imperdiet, orci elit congue erat, sed facilisis mauris nibh sed mi. Aliquam tincidunt neque nibh, eget ultricies massa facilisis finibus. Maecenas at nunc luctus, pellentesque tellus a, efficitur eros. Quisque in justo sed est luctus convallis. Fusce ac nisl vel elit sagittis aliquam eu vitae ex. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean quis ex risus. Fusce ac consequat eros.', 100000000),
(3, 'VIP', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis erat at dui vehicula scelerisque. Mauris vel auctor lectus. Fusce convallis leo ut sapien semper consequat. Ut varius purus eget orci mattis tempus ac sed nulla. Fusce vitae urna nisi. Cras vehicula lacinia rhoncus. Vestibulum non ligula faucibus, porttitor orci ultrices, faucibus velit. Nam vitae aliquet erat. Quisque a mi orci. Quisque hendrerit ligula a ligula volutpat aliquam. Cras tortor justo, malesuada at est ac, consectetur dapibus quam. Morbi elementum porta urna, nec ultrices massa tincidunt vitae. Aliquam iaculis congue sodales. Fusce sagittis fermentum est, quis congue magna venenatis in. Integer elit libero, elementum nec rutrum ut, dignissim eget dolor.', 15000000),
(4, 'Regular', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lobortis ac turpis eu sollicitudin. Etiam rhoncus fermentum metus, eget tempus leo ultrices tempus. Sed a ultrices turpis. Etiam tincidunt vitae augue at cursus. Duis dictum, augue eget condimentum imperdiet, orci elit congue erat, sed facilisis mauris nibh sed mi. Aliquam tincidunt neque nibh, eget ultricies massa facilisis finibus. Maecenas at nunc luctus, pellentesque tellus a, efficitur eros. Quisque in justo sed est luctus convallis. Fusce ac nisl vel elit sagittis aliquam eu vitae ex. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean quis ex risus. Fusce ac consequat eros.', 500000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `password` varchar(256) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `privilege` enum('Admin','Staff') NOT NULL DEFAULT 'Staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `fullname`, `password`, `address`, `telephone`, `privilege`) VALUES
(1, 'admin', 'Arlen Prima', '$2y$10$35CE7VO8lu8J92OLiNjZMu.9Oy/ErvQYJpkVSJeh8X6Sqx.V9qlBu', 'Lampung Utara', '087354326134', 'Admin'),
(4, 'feira', 'feira', '$2y$10$7oDX3eJq7.AAHjHICAOSM.CW3Fs5rohb4PohnLYP1PWWAFRmCo7my', 'feira', '0874319', 'Staff'),
(12, 'amar', 'Amar Subagja', '$2y$10$1Rcl1Ov17/g4cNe2jQYzK.K0SFDfH7R/Ooc1rZqm5bXXQkz7LDKaC', 'bukit intan', '081244321', 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `guest_id` (`guest_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_number` (`room_number`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
