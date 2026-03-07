-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2026 at 04:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon_management`;
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `slot_id` int(11) DEFAULT NULL,
  `status` enum('pending','confirmed','rejected','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) DEFAULT 'unpaid',
  `payment_method` varchar(50) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `client_id`, `service_id`, `staff_id`, `appointment_date`, `slot_id`, `status`, `created_at`, `payment_status`, `payment_method`, `paid_amount`, `paid_at`) VALUES
(1, 1, NULL, 1, '2026-02-28', 4, 'completed', '2026-02-27 22:28:51', 'paid', 'card', 1700.00, '2026-03-03 22:05:56'),
(2, 2, NULL, 1, '2026-02-27', 5, 'completed', '2026-02-28 03:18:28', 'paid', 'cash', 1700.00, '2026-03-02 17:58:49'),
(3, 3, NULL, 1, '2026-03-13', 1, 'completed', '2026-03-03 22:30:40', 'paid', 'cash', 3700.00, '2026-03-04 03:40:42'),
(4, 4, NULL, NULL, '2026-03-13', 1, 'rejected', '2026-03-03 22:32:59', 'unpaid', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_services`
--

CREATE TABLE `appointment_services` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_services`
--

INSERT INTO `appointment_services` (`id`, `appointment_id`, `service_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Qunoot Zehra', 's.qunootzehra@gmail.com', '03001234567'),
(2, 'Moosa Khan', 'moosa.khan@gmail.com', '03123456789'),
(3, 'Maryam Fatima', 'maryam.fatima@gmail.com', '03234567890');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `appointment_id`, `client_id`, `rating`, `message`, `created_at`) VALUES
(1, 1, 1, 5, 'Excellent manicure service. The staff was very professional and friendly.', '2026-03-03 23:26:57'),
(2, 2, 2, 4, 'Good pedicure service. Clean environment and staff was polite.', '2026-03-06 01:53:47'),
(3, 3, 3, 5, 'Great experience with Mahnoor. Very relaxing and well done.', '2026-03-04 03:45:10');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `min_limit` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_name`, `quantity`, `min_limit`) VALUES
(1, 'Hair Color Tube', 20, 5),
(2, 'Shampoo Bottle', 15, 5),
(3, 'Facial Kit', 4, 2),
(4, 'Hand Cream', 25, 10),
(5, 'Nail Polish Remover', 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `appointment_id`, `amount`, `payment_method`, `payment_date`) VALUES
(1, 1, 1700.00, 'card', '2026-02-27 23:24:19'),
(2, 2, 1700.00, 'cash', '2026-03-02 12:58:49'),
(3, 3, 3700.00, 'cash', '2026-03-04 03:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'receptionist'),
(3, 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `services_img` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `services_img`, `price`) VALUES
(1, 'Manicure', '1769507860.png', 1700.00),
(2, 'Pedicure', 'Untitled_design-removebg-preview.png', 2000.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff_img` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_img`, `name`, `user_id`) VALUES
(1, '2-preview-1767624501703.png', 'Mahnoor Ahmed', 4),
(2, 'Orange E-commerce Online Store Logo.png', 'Kashaf Ali', 6);

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL,
  `slot_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `slot_time`) VALUES
(1, '11:00:00'),
(2, '11:30:00'),
(3, '12:00:00'),
(4, '12:30:00'),
(5, '14:00:00'),
(6, '14:30:00'),
(7, '15:00:00'),
(8, '15:30:00'),
(9, '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `user_name`, `user_email`, `user_phone`, `user_img`, `user_password`, `created_at`) VALUES
(1, 1, 'Ali', 'ali@gmail.com', '03001234567', 'ali.png', '$2y$10$o6kKv60H0o3yFrwz3bERCOGenTPCTJl8CcOtW2a1/bT4ZP.FkepM.', '2026-02-27 22:03:26'),
(2, 3, 'Hassan', 'hassan@gmail.com', '03004567890', '2-preview-1767624501703.png', '$2y$10$Wt6YO1o3Rxo1aQUvOsF6VuxPjOo4Ydn9W/XgwZ1et9w54iyBFNFxK', '2026-02-27 22:08:35'),
(4, 3, 'Mahnoor', 'mahnoor@gmail.com', '03006789012', '2-preview-1767624501703.png', '$2y$10$tL0jYlA6BErgYr6nmARBv.Qt8gpSeYoGKseKZ.DqOBk1BGp7/j9YG', '2026-02-27 22:20:37'),
(5, 2, 'Emaan', 'emaan@gmail.com', '03007894561', 'Untitled design.png', '$2y$10$run82iZpxqpJuUL9sF8mqeR2ryLeD.bm.yvciI9WHqCRwTY.7XtoC', '2026-03-03 15:43:26'),
(6, 3, 'Kashaf', 'kashaf@gmail.com', '03009876234', 'Orange E-commerce Online Store Logo.png', '$2y$10$nACFpkbpgZoAJnRoI1Abuuia/SNQr/YZwYGQxWKX5/i3v.QclWFPy', '2026-03-05 06:18:39');

-- --------------------------------------------------------
-- Indexes, AUTO_INCREMENT, and constraints remain exactly the same
-- --------------------------------------------------------
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;