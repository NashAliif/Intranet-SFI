-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 19, 2025 at 02:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intranet_sfi`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `warranty_expiry` date DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `instance_id` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `name`, `purchase_date`, `warranty_expiry`, `description`, `user_id`, `instance_id`, `qty`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Komputer IT Support', '2025-01-06', '2025-01-06', 'Spesifikasi\r\n- Motherboard : B75M\r\n- Processor : Intel Core i5-3470\r\n- VGA : GeForce GTX 1050 Ti\r\n- Storage : 1750 GB (HDD 250 GB, HDD 500 GB, HDD 1 TB)\r\n- Memory : 12 GB\r\n- PSU : 500 W Silver\r\n- Casing : ATX\r\n\r\nLokasi : Lantai 2 Meja IT', 2, 2, 1, '2025-01-06 05:18:01', '2025-01-07 08:38:50', NULL),
(8, 'UPS IT Support', '2025-01-07', '2025-01-07', 'Spesifikasi\r\n- Model : MFU-650\r\n- Power : 650 VA\r\n\r\nLokasi : Lantai 2 Meja IT', 2, 2, 1, '2025-01-07 05:29:18', '2025-01-07 08:38:57', NULL),
(9, 'CCTV', '2025-01-07', '2025-01-07', 'IPCAM Dahua\r\n\r\nLokasi : \r\n- Lantai 1, Pintu Masuk - 2, Lobby - 1\r\n- Lantai 2, Diatas Tempat Aidil - 1, Diatas Tempat Ibu Lenny - 1\r\n- Lantai 3, Ruang Finance - 2, Tangga - 1\r\n- Lantai 4, Ruang Ibu Mega - 1, Tangga - 1', 2, 2, 10, '2025-01-07 05:43:29', '2025-01-07 05:55:28', NULL),
(10, 'NVR', '2025-01-07', '2025-01-07', 'NVR Dahua 16 Port\r\n\r\nLokasi : Rak Server Lantai 2', 2, 2, 1, '2025-01-07 05:44:56', '2025-01-07 05:55:55', NULL),
(11, 'Switch Commax', '2025-01-07', '2025-01-07', '8 Port Fast Ethernet 10/100\r\n\r\nLokasi : Rak Server Lantai 2', 2, 2, 2, '2025-01-07 05:47:48', '2025-01-07 05:56:09', NULL),
(12, 'Switch Mikrotik', '2025-01-07', '2025-01-07', '24 Port Gigabit Ethernet 10/100/1000\r\n\r\nLokasi : Rak Server Lantai 2', 2, 2, 1, '2025-01-07 05:48:53', '2025-01-07 05:56:25', NULL),
(13, 'Access Point TP Link', '2025-01-07', '2025-01-07', 'Wifi 5 AC POE\r\n\r\nLokasi : Lantai 1 Ruang Meeting dan Lantai 4 Ruang Ibu Mega', 2, 2, 2, '2025-01-07 05:49:41', '2025-01-07 05:58:24', NULL),
(14, 'Router Mikrotik', NULL, NULL, '4 Port Gigabit Ethernet, 1 Port Gigabit Ethernet POE\r\n\r\nLokasi : Rak Server Lantai 2', 2, 2, 1, '2025-01-07 05:50:26', '2025-01-07 05:57:28', NULL),
(16, 'Access Point Unify', '2025-01-07', '2025-01-07', 'Wifi 5 AC POE\r\n\r\nLokasi : Rak Server Lantai 2', 2, 2, 1, '2025-01-07 05:51:09', '2025-01-07 05:57:35', NULL),
(17, 'POE Adapter Unify', '2025-01-07', '2025-01-07', 'Lokasi : Rak Server Lantai 2', 2, 2, 1, '2025-01-07 05:51:44', '2025-01-07 05:57:43', NULL),
(18, 'Router Tenda', '2025-01-07', '2025-01-07', 'Wifi 5 AC\r\n\r\n\r\nLokasi : Lantai 3 Diatas Pintu Toilet', 2, 2, 1, '2025-01-07 05:52:10', '2025-01-07 05:58:59', NULL),
(21, 'as', NULL, NULL, NULL, 2, 2, NULL, '2025-01-07 08:51:50', NULL, '2025-01-07 08:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `instances`
--

CREATE TABLE `instances` (
  `id` int NOT NULL,
  `instance` char(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instances`
--

INSERT INTO `instances` (`id`, `instance`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PT SELARAS MAKMUS SEJAHTERA', '2024-12-27', NULL, NULL),
(2, 'PT DIGITAL INOVASI ASIA', '2024-12-27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role` char(20) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `update_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `update_at`, `deleted_at`) VALUES
(1, 'admin', NULL, NULL, NULL),
(2, 'user', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instance_id` int DEFAULT NULL,
  `position` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `full_name`, `telephone`, `address`, `instance_id`, `position`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'it_support@sfigroup.co.id', '$2y$10$pPceQ743QFvYeHmABtEUauiX9hifde5wSbyDgrUFSZXMeQzNIXXQq', 'Muhammad Aliif Nashrullah', '089670014230', 'Jalan Harun III', 2, 'IT Support', 1, '2024-12-27 00:00:00', '2025-01-07 05:30:57', NULL),
(25, 'aliif@email.com', '', NULL, NULL, NULL, 1, '', 2, '2025-01-07 08:51:25', NULL, '2025-01-07 08:51:30'),
(29, 'design_grafis@sfigroup.co.id', '$2y$10$7dbxzt0b7HoQHpNWa17c1O3/BIoHXy6NpTE2pCtIkOZ8EhwJ6Mn82', 'Dhika', NULL, NULL, 2, 'Design Grafis', 2, '2025-01-07 09:34:49', NULL, NULL),
(30, 'hr-ga@sfigroup.co.id', '$2y$10$ChfDf7icX9YUMPgTVomZAOeappodR747vp1T1ODqAkQ.gWoM0eFVy', 'Lenny', NULL, NULL, 1, 'HR-GA', 2, '2025-03-07 03:37:32', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assets_users_relation` (`user_id`),
  ADD KEY `assets_instances_relation` (`instance_id`);

--
-- Indexes for table `instances`
--
ALTER TABLE `instances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_roles_relation` (`role_id`),
  ADD KEY `users_instances_relation` (`instance_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `instances`
--
ALTER TABLE `instances`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_instances_relation` FOREIGN KEY (`instance_id`) REFERENCES `instances` (`id`),
  ADD CONSTRAINT `assets_users_relation` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_instances_relation` FOREIGN KEY (`instance_id`) REFERENCES `instances` (`id`),
  ADD CONSTRAINT `users_roles_relation` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
