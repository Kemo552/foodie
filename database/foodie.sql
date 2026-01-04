-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2026 at 08:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodie`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(15, 1, 3, 4, '2026-01-04 08:00:34', '2026-01-04 08:00:50'),
(16, 1, 2, 2, '2026-01-04 08:00:44', '2026-01-04 08:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `imageUrl` varchar(255) NOT NULL DEFAULT 'no_image.png',
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `imageUrl`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Pizza', '1767008959.png', 1, '2025-12-29 08:49:19', '2026-01-02 12:06:35'),
(2, 'Burger', '1767365949.png', 1, '2025-12-29 08:49:27', '2026-01-02 12:00:31'),
(3, 'Fries', '1767461605.png', 1, '2026-01-03 14:33:25', '2026-01-03 14:33:25'),
(4, 'Spaghetti', '1767461692.png', 1, '2026-01-03 14:34:52', '2026-01-03 14:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_12_20_042015_create_categories_table', 1),
(6, '2025_12_21_135321_create_products_table', 1),
(7, '2025_12_22_105235_alter_products_description_nullable', 1),
(8, '2025_12_25_100426_create_carts_table', 1),
(9, '2025_12_27_113429_create_payments_table', 1),
(10, '2025_12_27_113757_create_orders_table', 1),
(11, '2025_12_28_095634_add_price_column_to_orders_table', 1),
(12, '2025_12_28_182706_change_status_column_on_orders_table', 1),
(13, '2025_12_29_140320_update_columns_orders_table', 2),
(14, '2025_12_30_191454_create_reservations_table', 3),
(15, '2025_12_31_101848_update_columns_on_reservations_table', 4),
(16, '2025_12_31_121621_add_admin_to_users_table', 5),
(17, '2026_01_01_181133_edit_email_column_on_reservations_table', 6),
(18, '2026_01_01_181519_edit_email_column_on_reservations_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `status` enum('pending','paid','delivered') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_price` double NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `product_id`, `user_id`, `payment_id`, `quantity`, `status`, `created_at`, `updated_at`, `unit_price`, `total_price`) VALUES
(1, '9f8c27f5-b256-4b99-ae29-ba68fe542a43', 2, 1, 1, 3, 'delivered', '2025-12-29 08:51:48', '2025-12-30 08:20:12', 1, 2),
(2, '222764a4-1ea6-456a-9dfb-489cd08fce40', 1, 1, 1, 4, 'pending', '2025-12-29 08:51:48', '2025-12-30 15:17:59', 1, 2),
(3, 'c1cd06ae-7d9f-48fd-bb3c-159c472e2359', 1, 1, 2, 1, 'paid', '2025-12-29 08:52:31', '2025-12-29 08:52:31', 1, 1),
(4, '074e868e-2a4c-49c5-bee0-c64cb49ecd67', 2, 1, 3, 1, 'delivered', '2025-12-29 11:07:06', '2026-01-04 08:07:28', 0.7, 0.7),
(5, '2293ce0c-d92f-450b-9175-91bf514699f0', 1, 1, 4, 1, 'paid', '2025-12-29 11:08:26', '2025-12-29 11:08:26', 0.5, 0.5),
(6, '2ae7e051-9dac-4b7f-8501-e77b0cd3d9ff', 1, 1, 5, 1, 'paid', '2025-12-29 16:12:42', '2025-12-29 16:12:42', 0.5, 0.5),
(7, '890f37c6-b107-4fa7-9746-2014fbf61dc7', 2, 4, 6, 7, 'paid', '2026-01-02 12:13:43', '2026-01-02 12:13:43', 0.7, 4.9),
(8, '73f00b4b-ee39-4cf1-a846-7639bc4198ce', 1, 4, 6, 5, 'paid', '2026-01-02 12:13:43', '2026-01-02 12:13:43', 0.5, 2.5),
(9, '5599263d-3df5-42e6-972d-35ae0264b626', 1, 4, 8, 7, 'paid', '2026-01-03 14:31:47', '2026-01-03 14:31:47', 0.5, 3.5),
(10, 'aa52a5e0-e01c-4dad-bc31-3e3f593b067e', 2, 4, 8, 4, 'paid', '2026-01-03 14:31:47', '2026-01-03 14:31:47', 0.7, 2.8),
(11, '753228a1-2935-4459-a973-86ea9eb30dc0', 2, 4, 9, 3, 'paid', '2026-01-04 07:50:36', '2026-01-04 07:50:36', 0.7, 2.1),
(12, '571d47bc-e098-442e-9cf6-fab0e3e0db09', 1, 4, 9, 2, 'paid', '2026-01-04 07:50:36', '2026-01-04 07:50:36', 0.5, 1),
(13, '7c6c140c-8a23-4788-8e2c-055cf69fff23', 4, 4, 9, 1, 'paid', '2026-01-04 07:50:36', '2026-01-04 07:50:36', 0.4, 0.4),
(14, '33fab172-fb24-4887-8ffe-2d79831502ce', 3, 4, 9, 2, 'paid', '2026-01-04 07:50:37', '2026-01-04 07:50:37', 0.2, 0.4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `card_no` varchar(255) DEFAULT NULL,
  `expiry_date` varchar(7) DEFAULT NULL,
  `cvv` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `payment_mode` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `card_no`, `expiry_date`, `cvv`, `address`, `payment_mode`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, 'Jules Jammal', 'cod', '2025-12-29 08:51:47', '2025-12-29 08:51:47'),
(2, 'Karam Ayoub', '************6245', '4-2028', '559', 'Jules Jammal 0', 'card', '2025-12-29 08:52:30', '2025-12-29 08:52:30'),
(3, 'Karam Ayoub', '************6549', '2-2026', '123', 'Tartous, Syria', 'card', '2025-12-29 11:07:06', '2025-12-29 11:07:06'),
(4, 'Pizza', '************6548', '1-2028', '323', 'Jules Jammal 0', 'card', '2025-12-29 11:08:26', '2025-12-29 11:08:26'),
(5, NULL, NULL, NULL, NULL, 'Jules Jammal', 'cod', '2025-12-29 16:12:42', '2025-12-29 16:12:42'),
(6, 'Test User', '************2134', '6-2029', '554', 'Tartous, Syria', 'card', '2026-01-02 12:13:41', '2026-01-02 12:13:41'),
(7, NULL, NULL, NULL, NULL, 'Jules Jammal', 'cod', '2026-01-03 10:16:29', '2026-01-03 10:16:29'),
(8, 'John Doe', '************3574', '2-2031', '547', '3909 Main Street New York, CA 57876 United States', 'card', '2026-01-03 14:31:47', '2026-01-03 14:31:47'),
(9, 'John Doe', '************6244', '1-2029', '654', '3909 Main Street New York, CA 57876 United States', 'card', '2026-01-04 07:50:36', '2026-01-04 07:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `imageUrl` varchar(255) NOT NULL DEFAULT 'no_image.png',
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `category_id`, `imageUrl`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Pizza Hut', 'Dominos Pizza Hut', 0.50, 14, 1, '1767008999.png', 1, '2025-12-29 08:49:59', '2025-12-30 08:30:13'),
(2, 'Burger King', 'Burger King - MAC cheese', 0.70, 2, 2, '1767009051.png', 1, '2025-12-29 08:50:51', '2025-12-29 08:50:51'),
(3, 'French Fries', 'French Fries with Ketchup', 0.20, 38, 3, '1767461659.png', 1, '2026-01-03 14:34:19', '2026-01-03 14:34:19'),
(4, 'Spaghetti', 'Spaghetti with pepper and cheese', 0.40, 34, 1, '1767461751.png', 1, '2026-01-03 14:35:51', '2026-01-03 14:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `people` int(10) UNSIGNED NOT NULL,
  `reservation_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `people`, `reservation_date`, `created_at`, `updated_at`, `name`, `email`, `phone`) VALUES
(6, 1, 4, '2026-02-02', '2026-01-01 15:15:58', '2026-01-01 15:15:58', 'Karam Ayoub', 'karamaioub552@gmail.com', '0964932361'),
(9, 1, 3, '2026-01-16', '2026-01-01 15:28:56', '2026-01-01 15:40:55', 'Karam Ayoub', 'karamaioub552@gmail.com', '0964932361'),
(10, 4, 5, '2026-01-31', '2026-01-03 14:30:09', '2026-01-03 14:30:09', 'John Doe', 'john@doe.com', '0988415546'),
(11, 4, 2, '2026-02-07', '2026-01-03 14:30:33', '2026-01-03 14:30:33', 'John Doe', 'john@doe.com', '0988415546');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `imageUrl` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `address`, `phone`, `imageUrl`, `zip`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Karam Ayoub', 'karam_ayoub.552', 'karamaioub552@gmail.com', NULL, '$2y$12$vSDfcX8S5NjsNCScXkHrwucKbDjh1uPv1FNLXq8BdouW2si6.BbFK', 'Tartous, Syria', '0964932361', '1767008859.jpg', '123123', NULL, '2025-12-29 08:47:40', '2025-12-29 08:47:40'),
(4, 'John Doe', 'test_user', 'john@doe.com', NULL, '$2y$12$57yvoP3Z6vUKOVSC92rYwOdZK/QTvb4Ua0ph5YcJOy5y/4J3p6Aqy', '3909 Main Street New York, CA 57876 United States', '0988415546', '1767461355.jpg', '897564', NULL, '2026-01-02 10:40:12', '2026-01-03 14:29:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_no_unique` (`order_no`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
