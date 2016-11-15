-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2016 at 07:42 PM
-- Server version: 10.1.9-MariaDB-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharma`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Arion Healthcare', 1, NULL, NULL),
(2, 'Oval Organic', 1, NULL, NULL),
(3, 'SAC Pharma', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_08_22_014824_create_companies_table', 2),
('2016_08_30_022128_create_products_table', 3),
('2016_10_24_043036_create_stock_ins_table', 4),
('2016_10_24_052410_add_company_id_products_table', 5),
('2016_10_24_052633_add_unit_products_table', 6),
('2016_10_24_053106_add_mrp_trade_products_table', 7),
('2016_10_24_053224_add_stockinhand_products_table', 8),
('2016_10_26_171725_create_stock_outs_table', 9),
('2016_11_07_163614_rename_stockin_stockinproducts', 9),
('2016_11_07_164151_create_stockin_table', 9),
('2016_11_07_170347_add_col_stockinid_stocinproducts', 9),
('2016_11_08_103616_create_stock_out_products_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `mrp` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `trade` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `stock_in_hand` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `unit`, `mrp`, `trade`, `stock_in_hand`, `status`, `created_at`, `updated_at`) VALUES
(3, 'AROCAST (Tab.)', '10x10', '98.00', '82.00', 81, 1, '2016-10-21 21:14:11', '2016-11-11 02:48:41'),
(4, 'ARICEPO CL(Tab.)', '10x6', '173.00', '145.00', 116, 1, '2016-10-21 21:45:25', '2016-11-11 02:48:41'),
(5, 'Aridic sp (tab)', '10x2x10', '35.00', '29.00', 102, 1, '2016-10-21 21:45:58', '2016-11-09 02:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `stock_ins`
--

CREATE TABLE `stock_ins` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `receive_date` date NOT NULL,
  `receipt_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `party_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `party_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `party_dl` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_ins`
--

INSERT INTO `stock_ins` (`id`, `company_id`, `receive_date`, `receipt_number`, `party_name`, `party_address`, `party_dl`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '2016-11-11', 'SDD/1/16', 'Nitish Demo', 'Beltola Guwahati 781028', 'Nitish DL Demo', 1, '2016-11-11 02:48:41', '2016-11-11 02:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in_products`
--

CREATE TABLE `stock_in_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_in_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `expiry_date` date NOT NULL,
  `batch_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `quanity` int(11) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_in_products`
--

INSERT INTO `stock_in_products` (`id`, `stock_in_id`, `product_id`, `expiry_date`, `batch_number`, `unit_cost`, `quanity`, `total_cost`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2020-11-19', 'NHU78/099/M898', '45.88', 8, '367.04', '2016-11-11 02:48:41', '2016-11-11 02:48:41'),
(2, 1, 4, '2019-08-15', 'NHU78/099/M6733', '28.36', 8, '226.88', '2016-11-11 02:48:41', '2016-11-11 02:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `stock_outs`
--

CREATE TABLE `stock_outs` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) NOT NULL,
  `dispatch_date` date NOT NULL,
  `receipt_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `party_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `party_dl` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `party_address` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `avat` decimal(10,2) NOT NULL,
  `special_discount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_outs`
--

INSERT INTO `stock_outs` (`id`, `company_id`, `dispatch_date`, `receipt_number`, `party_name`, `party_dl`, `party_address`, `avat`, `special_discount`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-11-14', 'SDD/DIS/1/16', 'asd', 'asdasd', 'asdas', '10.00', '0.00', '2016-11-14 18:15:55', '2016-11-14 18:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_products`
--

CREATE TABLE `stock_out_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_out_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `expiry_date` date NOT NULL,
  `batch_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quanity` int(11) NOT NULL,
  `free` int(11) NOT NULL DEFAULT '0',
  `unit_cost` decimal(10,2) NOT NULL,
  `flat_rate` decimal(8,2) DEFAULT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_out_products`
--

INSERT INTO `stock_out_products` (`id`, `stock_out_id`, `product_id`, `expiry_date`, `batch_number`, `quanity`, `free`, `unit_cost`, `flat_rate`, `total_cost`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2019-11-28', '123', 2, 0, '82.00', '0.00', '164.00', '2016-11-14 18:15:55', '2016-11-14 18:15:55'),
(2, 1, 4, '2019-11-07', '1234', 1, 0, '145.00', '144.00', '144.00', '2016-11-14 18:15:55', '2016-11-14 18:15:55'),
(3, 1, 4, '2019-09-26', '211', 1, 0, '145.00', '0.00', '145.00', '2016-11-14 18:15:55', '2016-11-14 18:15:55'),
(4, 1, 5, '2015-07-28', '222', 1, 0, '29.00', '30.00', '30.00', '2016-11-14 18:15:55', '2016-11-14 18:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pharma Admin', 'admin', '$2y$10$WkYEW0dcrtQxfSrZFQ4kseOwTfbq41ds9drmx5hvf3OuzY0yBwali', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_ins`
--
ALTER TABLE `stock_ins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_in_products`
--
ALTER TABLE `stock_in_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_in_products_stock_in_id_foreign` (`stock_in_id`);

--
-- Indexes for table `stock_outs`
--
ALTER TABLE `stock_outs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_out_products`
--
ALTER TABLE `stock_out_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_out_products_stock_out_id_foreign` (`stock_out_id`),
  ADD KEY `stock_out_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `stock_ins`
--
ALTER TABLE `stock_ins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stock_in_products`
--
ALTER TABLE `stock_in_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stock_outs`
--
ALTER TABLE `stock_outs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stock_out_products`
--
ALTER TABLE `stock_out_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `stock_ins`
--
ALTER TABLE `stock_ins`
  ADD CONSTRAINT `stock_ins_company_id_foreign` FOREIGN KEY (`id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `stock_in_products`
--
ALTER TABLE `stock_in_products`
  ADD CONSTRAINT `stock_in_products_stock_in_id_foreign` FOREIGN KEY (`stock_in_id`) REFERENCES `stock_ins` (`id`);

--
-- Constraints for table `stock_outs`
--
ALTER TABLE `stock_outs`
  ADD CONSTRAINT `stock_outs_company_id_foreign` FOREIGN KEY (`id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `stock_out_products`
--
ALTER TABLE `stock_out_products`
  ADD CONSTRAINT `stock_out_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `stock_out_products_stock_out_id_foreign` FOREIGN KEY (`stock_out_id`) REFERENCES `stock_outs` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
