-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 06:09 PM
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
-- Database: `stocks`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `kode_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `deskripsi`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'BRG1733986312', 'Kulit Lumpia', 240000, 300000, 'Kulit Lumpia', 'PTzsRpuhVUtboAEPggZMOam4LA9RHPX592SYZfW6.jpg', 1, NULL, '2024-12-11 23:51:52', '2024-12-12 02:33:33'),
(2, 'BRG1733990678', 'Karton Mie Sedap', 2400000, 72000, 'Karton Mie Sedap 1 Box isi 120 Pcs Mie', 'BTSqFW0sRQjmjOjqn4kSZPxQDrmP2hows9hQEx1E.jpg', 0, NULL, '2024-12-12 01:04:38', '2024-12-12 09:34:23'),
(3, 'BRG1733990808', 'Mie Burung Dara 1 Pack', 840000, 7000, 'Mie Burung Dara Per Pcs Original', 'kWECUX5hp3Llg0Z9oYXABajeg4d9Tdh9SZhW7rTe.jpg', 1, NULL, '2024-12-12 01:06:48', '2024-12-12 01:06:48'),
(4, 'BRG1734020569', 'Minyak Sunco', 1100000, 17000, 'Minyan Sunco 1 Box isi 1 Minyak', 'dgclxHZhemR1yy0BqldHufuUazOPiedwzD0jHNZH.jpg', 1, NULL, '2024-12-12 09:22:49', '2024-12-12 09:22:49'),
(5, 'BRG1734020847', 'Beras Maknyus 5kg', 1920000, 80000, 'Beras Maknyus Pulen 5kg', '9MW4lVC3PFNFzDfGXWZqeARcfraSthmvnkzacFnB.jpg', 1, NULL, '2024-12-12 09:27:27', '2024-12-12 09:27:27'),
(6, 'BRG1734022126', 'Kacang Hijau Karung', 9945000, 663000, 'Kacang Hijau 1 Karung 15kg', '2YnMNPkLAHzsjJhGnoL3vyTRZPIFnXaniWG5h52J.jpg', 1, NULL, '2024-12-12 09:48:46', '2024-12-12 09:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_11_093029_create_suppliers_table', 1),
(5, '2024_12_11_100015_create_barangs_table', 1),
(6, '2024_12_12_061736_create_satuans_table', 1),
(7, '2024_12_12_063812_create_stok_barangs_table', 1);

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
-- Table structure for table `satuans`
--

CREATE TABLE `satuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_satuan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuans`
--

INSERT INTO `satuans` (`id`, `nama_satuan`, `created_at`, `updated_at`) VALUES
(1, 'pcs', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(2, 'box', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(3, 'set', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(4, 'kg', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(5, 'gr', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(6, 'mg', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(7, 'ton', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(8, 'kwintal', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(9, 'kw', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(10, 'kwh', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(11, 'm', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(12, 'cm', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(13, 'mm', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(14, 'km', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(15, 'inch', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(16, 'ft', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(17, 'yard', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(18, 'liter', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(19, 'ml', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(20, 'galon', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(21, 'oz', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(22, 'lb', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(23, 'ton', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(24, 'kwintal', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(25, 'kw', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(26, 'kwh', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(27, 'm', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(28, 'cm', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(29, 'mm', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(30, 'km', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(31, 'inch', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(32, 'ft', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(33, 'yard', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(34, 'liter', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(35, 'ml', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(36, 'galon', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(37, 'oz', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(38, 'lb', '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(39, 'Krat', '2024-12-12 02:14:04', '2024-12-12 02:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('q7ISf1z33CJimjyLjZXo5znFJXHnUYkduQBMhhXK', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMUVCNFRsMG9Odm0xRHNEMzdZblFpeTZaUkVORWJWZ1c1RnJDODlkeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9saXN0LWJhcmFuZyI7fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTczNDAyMjM4NDt9fQ==', 1734022850);

-- --------------------------------------------------------

--
-- Table structure for table `stok_barangs`
--

CREATE TABLE `stok_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `satuan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stok_barangs`
--

INSERT INTO `stok_barangs` (`id`, `barang_id`, `stok`, `supplier_id`, `satuan_id`, `created_at`, `updated_at`) VALUES
(1, 1, 120, 3, 1, '2024-12-11 23:51:52', '2024-12-12 02:33:33'),
(2, 2, 0, 1, 2, '2024-12-12 01:04:38', '2024-12-12 09:34:23'),
(3, 3, 1200, 3, 1, '2024-12-12 01:06:48', '2024-12-12 01:06:48'),
(4, 4, 64, 5, 2, '2024-12-12 09:22:49', '2024-12-12 09:22:49'),
(5, 5, 24, 5, 4, '2024-12-12 09:27:27', '2024-12-12 09:30:53'),
(6, 6, 15, 3, 4, '2024-12-12 09:48:46', '2024-12-12 09:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama_supplier`, `alamat`, `telepon`, `email`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'PT. Supplier 1', 'Jl. Supplier 1 No. 1', '081234567890', 'supplier1@example.com', '1', NULL, '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(2, 'PT. Supplier 2', 'Jl. Supplier 2 No. 2', '081234567891', 'supplier2@example.com', '1', NULL, '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(3, 'PT. Supplier 3', 'Jl. Supplier 3 No. 3', '081234567892', 'supplier3@example.com', '1', NULL, '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(4, 'PT. Supplier 4', 'Jl. Supplier 4 No. 4', '081234567893', 'supplier4@example.com', '1', NULL, '2024-12-11 23:42:33', '2024-12-11 23:42:33'),
(5, 'PT. Supplier 5', 'Jl. Supplier 5 No. 5', '081234567894', 'supplier5@example.com', '1', NULL, '2024-12-11 23:42:33', '2024-12-11 23:42:33');

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
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '2024-12-11 23:42:33', '$2y$12$UEccAeoD4L2xjHDceNi5JOcS1cp/2A1al1JyLqDIg4/LXeNgBzacm', 'admin', 'f7QDkJeAw7t3D7tnDw8BhYvArKpNkqVaTUWWFmZKGEaqJbcx1lN602AvPA52', '2024-12-11 23:42:33', '2024-12-11 23:42:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `satuans`
--
ALTER TABLE `satuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stok_barangs`
--
ALTER TABLE `stok_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_barangs_barang_id_foreign` (`barang_id`),
  ADD KEY `stok_barangs_supplier_id_foreign` (`supplier_id`),
  ADD KEY `stok_barangs_satuan_id_foreign` (`satuan_id`);

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
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `satuans`
--
ALTER TABLE `satuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `stok_barangs`
--
ALTER TABLE `stok_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stok_barangs`
--
ALTER TABLE `stok_barangs`
  ADD CONSTRAINT `stok_barangs_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`),
  ADD CONSTRAINT `stok_barangs_satuan_id_foreign` FOREIGN KEY (`satuan_id`) REFERENCES `satuans` (`id`),
  ADD CONSTRAINT `stok_barangs_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
