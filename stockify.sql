-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 10, 2026 at 08:26 AM
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
-- Database: `stockify`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `activity` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', 'Kategori Elektronik', '2026-10-09 04:11:40', '2026-10-09 04:11:40'),
(2, 'Alat Tulis', 'Kategori Alat Tulis', '2026-10-09 04:11:40', '2026-10-09 04:11:40'),
(3, 'Perlengkapan Kantor', 'Kategori Perlengkapan Kantor', '2026-10-09 04:11:40', '2026-10-09 04:11:40');

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
(5, '2026_09_15_070115_add_role_to_users_table', 1),
(6, '2026_09_15_160300_create_categories_table', 1),
(7, '2026_09_16_053618_create_suppliers_table', 1),
(8, '2026_09_16_062741_create_products_table', 1),
(9, '2026_09_16_063656_add_stock_to_products_table', 1),
(10, '2026_09_16_070957_create_stock_transactions_table', 1),
(11, '2026_09_17_121513_create_stock_opnames_table', 1),
(12, '2026_09_21_020038_create_activity_logs_table', 1),
(13, '2026_09_22_093034_create_settings_table', 1),
(14, '2026_09_25_131235_add_size_and_color_to_products_table', 1),
(15, '2026_09_26_152402_add_status_to_stock_transactions_table', 1);

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
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `unit` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `purchase_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `selling_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `minimum_stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `supplier_id`, `code`, `name`, `description`, `unit`, `size`, `color`, `purchase_price`, `selling_price`, `minimum_stock`, `stock`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'PRD001', 'Mouse Wireless', 'Produk Mouse Wireless', 'pcs', '-', 'Hitam', 65000.00, 75000.00, 5, 1700, 'products/RhvYuiiFfQHsvHPjyKJCBGYnIYBmj7BVQUTs8eKA.jpg', '2026-10-09 04:11:41', '2026-10-10 04:09:24'),
(2, 1, 1, 'PRD002', 'Keyboard Mechanical', 'Produk Keyboard Mechanical', 'unit', '-', 'hitam', 240000.00, 250000.00, 5, 1015, 'products/2gcMGy1nrvcM4MmS077g2F8TpRl2Re2TFu4JUo3a.jpg', '2026-10-09 04:11:41', '2026-10-09 05:28:54'),
(3, 1, 1, 'PRD003', 'Flashdisk 32GB', 'Produk Flashdisk 32GB', 'pcs', '-', 'Hitam', 55000.00, 65000.00, 5, 1240, 'products/KukLas4yLn5RIeMFlHn9rBX0yN2BspzlSW24te1J.jpg', '2026-10-09 04:11:41', '2026-10-09 06:49:18'),
(4, 2, 2, 'PRD004', 'Pulpen Gel', 'Produk Pulpen Gel', 'pax', '-', 'Hitam', 5000.00, 5000.00, 5, 1600, 'products/hJIxLGu0AHqCZZDvge9mlunzg3IXgeXq5SrWxI8V.jpg', '2026-10-09 04:11:41', '2026-10-09 06:51:45'),
(5, 2, 2, 'PRD005', 'Buku Tulis', 'Produk Buku Tulis', 'pax', '-', 'Biru', 3000.00, 7000.00, 5, 1080, 'products/hTQqpgQq5PMgIANJVIHwjowJNzN7zJZyBqAOwphW.jpg', '2026-10-09 04:11:41', '2026-10-09 06:49:05'),
(6, 3, 3, 'PRD006', 'Kertas A4', 'Produk Kertas A4', 'pcs', '-', 'Putih', 35000.00, 45000.00, 5, 1125, 'products/sybXDqFdB8Jy1ZbCrsrptDG0meh9s0MuaAcckAsd.jpg', '2026-10-09 04:11:41', '2026-10-09 06:52:42'),
(7, 3, 3, 'PRD007', 'Map Plastik', 'Produk Map Plastik', 'pcs', '-', 'Merah', 500.00, 3000.00, 5, 1260, 'products/2KPGJZverqHFklhy7EDCRvONbki9TG1DJiv7VZjQ.webp', '2026-10-09 04:11:41', '2026-10-09 06:49:56'),
(8, 1, 2, 'PRD008', 'Headset Kabel', 'headset model terbaru', 'unit', NULL, 'Hitam', 20000.00, 50000.00, 10, 5, 'products/IujPvN0pjkDEk397wsEhorwdr2B35PGdv9wVMqDh.jpg', '2026-10-09 06:56:35', '2026-10-10 04:19:43'),
(9, 1, 2, 'PRD009', 'Charger HP', 'fast charging charger', 'pcs', '-', 'putih', 35000.00, 55000.00, 10, 7, 'products/bQ4iYql71luwBXdpHpvea4bvfGuDlDp8CGWOokd0.jpg', '2026-10-10 01:30:49', '2026-10-10 04:19:25'),
(10, 2, 2, 'PRD010', 'Tipex', 'model tipex terbaru', 'pcs', '-', 'merah', 5000.00, 12000.00, 8, 0, 'products/j1isY1aU07i5XXxz1uCw07pstuSlCBqtx0HCkR07.jpg', '2026-10-10 01:38:51', '2026-10-10 04:19:59');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) NOT NULL DEFAULT 'Stockify',
  `app_logo` varchar(255) DEFAULT NULL,
  `app_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_name`, `app_logo`, `app_description`, `created_at`, `updated_at`) VALUES
(1, 'Stockify', NULL, 'Sistem Manajemen Stok Barang', '2026-10-09 04:06:21', '2026-10-09 04:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `stock_opnames`
--

CREATE TABLE `stock_opnames` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `opname_date` date NOT NULL,
  `system_stock` int(11) NOT NULL,
  `actual_stock` int(11) NOT NULL,
  `difference` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_opnames`
--

INSERT INTO `stock_opnames` (`id`, `product_id`, `user_id`, `opname_date`, `system_stock`, `actual_stock`, `difference`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2026-10-10', 1900, 1700, -200, NULL, '2026-10-10 01:27:50', '2026-10-10 04:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `stock_transactions`
--

CREATE TABLE `stock_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('in','out') NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `quantity` int(10) UNSIGNED NOT NULL,
  `transaction_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_transactions`
--

INSERT INTO `stock_transactions` (`id`, `product_id`, `type`, `status`, `quantity`, `transaction_date`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'in', 'confirmed', 1000, '2026-10-09', NULL, 5, '2026-10-09 04:13:50', '2026-10-09 05:50:57'),
(2, 5, 'in', 'confirmed', 1000, '2026-10-09', NULL, 6, '2026-10-09 06:49:05', '2026-10-09 06:53:21'),
(3, 3, 'in', 'confirmed', 1200, '2026-10-09', NULL, 6, '2026-10-09 06:49:18', '2026-10-09 06:53:18'),
(4, 6, 'in', 'confirmed', 1500, '2026-10-09', NULL, 6, '2026-10-09 06:49:31', '2026-10-09 06:53:14'),
(5, 7, 'in', 'confirmed', 1200, '2026-10-09', NULL, 6, '2026-10-09 06:49:56', '2026-10-09 06:53:11'),
(6, 4, 'in', 'confirmed', 1500, '2026-10-09', NULL, 6, '2026-10-09 06:51:45', '2026-10-09 06:53:09'),
(7, 1, 'in', 'confirmed', 2000, '2026-10-09', NULL, 6, '2026-10-09 06:51:58', '2026-10-09 06:53:06'),
(8, 1, 'out', 'confirmed', 125, '2026-10-09', NULL, 6, '2026-10-09 06:52:13', '2026-10-09 06:53:28'),
(9, 6, 'out', 'confirmed', 425, '2026-10-09', NULL, 6, '2026-10-09 06:52:42', '2026-10-09 06:53:24'),
(10, 8, 'in', 'confirmed', 5, '2026-10-10', NULL, 5, '2026-10-10 01:31:48', '2026-10-10 01:35:51'),
(11, 9, 'in', 'confirmed', 7, '2026-10-10', NULL, 5, '2026-10-10 01:32:05', '2026-10-10 01:35:47');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'PT Sumber Jaya', 'Jakarta', '081234567890', 'pt-sumber-jaya@gmail.com', '2026-10-09 04:11:41', '2026-10-09 04:11:41'),
(2, 'CV Maju Bersama', 'Bandung', '082345678901', 'cv-maju-bersama@gmail.com', '2026-10-09 04:11:41', '2026-10-09 04:11:41'),
(3, 'Toko Gudang Mandiri', 'Surabaya', '083456789012', 'toko-gudang-mandiri@gmail.com', '2026-10-09 04:11:41', '2026-10-09 04:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','manager','staff') NOT NULL DEFAULT 'staff',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Admin Stockify', 'admin@stockify.com', NULL, '$2y$10$ERz1rx6aBbWg1vM2go5die2f0wWmR1EvOd3EDDmQ42Xqp7ReQ8Cia', 'admin', NULL, '2026-10-09 04:08:52', '2026-10-09 04:08:52'),
(6, 'Manager Gudang', 'manager@stockify.com', NULL, '$2y$10$Qjrkv1DpgWXSdHO9YolnhuMnjOC0TmPaA7Utp.5JoBLtkohkXqaEK', 'manager', NULL, '2026-10-09 04:08:52', '2026-10-09 04:08:52'),
(7, 'Staff Gudang', 'staff@stockify.com', NULL, '$2y$10$pfGLvuPgQtIwSXvWE0wQQOG3GR8OOaKz8OuKpoL1GbseTRnQbhC/S', 'staff', NULL, '2026-10-09 04:08:53', '2026-10-09 04:08:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`),
  ADD KEY `activity_logs_module_index` (`module`),
  ADD KEY `activity_logs_created_at_index` (`created_at`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_opnames`
--
ALTER TABLE `stock_opnames`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_opnames_product_id_foreign` (`product_id`),
  ADD KEY `stock_opnames_user_id_foreign` (`user_id`);

--
-- Indexes for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_transactions_product_id_foreign` (`product_id`),
  ADD KEY `stock_transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_opnames`
--
ALTER TABLE `stock_opnames`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `stock_opnames`
--
ALTER TABLE `stock_opnames`
  ADD CONSTRAINT `stock_opnames_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_opnames_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD CONSTRAINT `stock_transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
