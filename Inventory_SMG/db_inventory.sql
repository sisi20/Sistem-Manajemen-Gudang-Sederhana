-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Agu 2025 pada 15.09
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(8, 'IT EQUIPMENTS', '2025-08-20 08:10:57', '2025-08-20 08:10:57'),
(9, 'OFFICE EQUIPMENTS', '2025-08-20 08:11:07', '2025-08-20 08:11:07'),
(10, 'SPARE PART', '2025-08-20 08:11:18', '2025-08-20 08:11:18'),
(11, 'KENDARAAN DAN ALAT BERAT', '2025-08-20 08:11:31', '2025-08-20 08:11:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `incoming_items`
--

CREATE TABLE `incoming_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `purchase_item_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `received_at` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `incoming_items`
--

INSERT INTO `incoming_items` (`id`, `purchase_item_id`, `product_id`, `received_at`, `quantity`, `created_at`, `updated_at`) VALUES
(25, 7, 5, '2025-08-20 08:50:02', 2, '2025-08-20 08:50:02', '2025-08-20 08:50:02'),
(26, 8, 6, '2025-08-20 08:50:02', 1, '2025-08-20 08:50:02', '2025-08-20 08:50:02'),
(27, 7, 5, '2025-08-20 08:52:16', 1, '2025-08-20 08:52:16', '2025-08-20 08:52:16'),
(28, 8, 6, '2025-08-20 08:52:16', 2, '2025-08-20 08:52:16', '2025-08-20 08:52:16'),
(29, 9, 7, '2025-08-20 10:30:41', 20, '2025-08-20 10:30:41', '2025-08-20 10:30:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-08-19-084732', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', 1755595316, 1),
(2, '2025-08-19-085118', 'App\\Database\\Migrations\\CreateProductsTable', 'default', 'App', 1755595316, 1),
(3, '2025-08-19-085213', 'App\\Database\\Migrations\\CreateVendorsTable', 'default', 'App', 1755595316, 1),
(4, '2025-08-19-085338', 'App\\Database\\Migrations\\CreatePurchasesTable', 'default', 'App', 1755595316, 1),
(5, '2025-08-19-085437', 'App\\Database\\Migrations\\CreatePurchaseItemsTable', 'default', 'App', 1755595316, 1),
(6, '2025-08-19-085537', 'App\\Database\\Migrations\\CreateIncomingItemsTable', 'default', 'App', 1755595316, 1),
(7, '2025-08-19-085614', 'App\\Database\\Migrations\\CreateOutgoingItemsTable', 'default', 'App', 1755595316, 1),
(8, '2025-08-20-111545', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1755688592, 2),
(9, '2025-08-20-115041', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1755690653, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `outgoing_items`
--

CREATE TABLE `outgoing_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `issued_at` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `outgoing_items`
--

INSERT INTO `outgoing_items` (`id`, `product_id`, `issued_at`, `quantity`, `note`, `created_at`, `updated_at`) VALUES
(5, 5, '2025-08-20 09:41:52', 1, '', '2025-08-20 09:41:52', '2025-08-20 09:41:52'),
(6, 5, '2025-08-20 10:01:43', 1, '', '2025-08-20 10:01:43', '2025-08-20 10:01:43'),
(7, 7, '2025-08-20 10:31:11', 1, '', '2025-08-20 10:31:11', '2025-08-20 10:31:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `code`, `unit`, `stock`, `created_at`, `updated_at`) VALUES
(5, 8, 'Laptop Lenovo ThinkPad', 'IT001', 'unit', 1, '2025-08-20 08:12:15', '2025-08-20 10:01:43'),
(6, 8, 'Printer Canon iP2770', 'IT002', 'unit', 3, '2025-08-20 08:13:00', '2025-08-20 08:52:16'),
(7, 10, 'Oli Mesin Pertamina Fastron', 'SP001', 'liter', 19, '2025-08-20 08:13:33', '2025-08-20 10:31:11'),
(8, 11, 'Ban Truk Bridgestone', 'KB001', 'pcs', 0, '2025-08-20 08:14:05', '2025-08-20 08:14:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) UNSIGNED NOT NULL,
  `vendor_id` int(11) UNSIGNED NOT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `purchase_date` date NOT NULL,
  `status` enum('pending','completed','canceled') NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `purchases`
--

INSERT INTO `purchases` (`id`, `vendor_id`, `buyer_name`, `purchase_date`, `status`, `created_at`, `updated_at`) VALUES
(7, 5, 'sisi', '2025-08-20', 'completed', '2025-08-20 08:14:27', '2025-08-20 08:52:16'),
(8, 7, 'arul', '2025-08-20', 'completed', '2025-08-20 10:29:21', '2025-08-20 10:30:41'),
(9, 5, 'rendi', '2025-08-20', 'pending', '2025-08-20 13:01:49', '2025-08-20 13:01:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `purchase_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(7, 7, 5, 3, 5000000.00, '2025-08-20 08:14:56', '2025-08-20 08:16:52'),
(8, 7, 6, 3, 2500000.00, '2025-08-20 08:15:15', '2025-08-20 08:15:15'),
(9, 8, 7, 20, 25000.00, '2025-08-20 10:29:55', '2025-08-20 10:29:55'),
(10, 9, 8, 1, 5000000.00, '2025-08-20 13:04:16', '2025-08-20 13:04:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$HQUK4Pl5J3jobooPqKOkzuaY6r0bjHRm7jEX/CmxA/G5VZwi5C3A2', 'admin@gmail.com', '2025-08-20 11:50:53', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(5, 'PT Sumber Jaya Abadi', 'Jl. Merdeka No. 10, Jakarta', '2025-08-20 08:09:52', '2025-08-20 08:09:52'),
(6, 'CV Teknologi Mandiri', 'Jl. Sudirman No. 25, Bandung', '2025-08-20 08:10:17', '2025-08-20 08:10:17'),
(7, 'PT Auto Sparepart Sejahtera', 'Jl. Raya Industri, Bekasi', '2025-08-20 08:10:39', '2025-08-20 08:10:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `incoming_items`
--
ALTER TABLE `incoming_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incoming_items_purchase_item_id_foreign` (`purchase_item_id`),
  ADD KEY `incoming_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `outgoing_items`
--
ALTER TABLE `outgoing_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outgoing_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_vendor_id_foreign` (`vendor_id`);

--
-- Indeks untuk tabel `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_items_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `incoming_items`
--
ALTER TABLE `incoming_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `outgoing_items`
--
ALTER TABLE `outgoing_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `incoming_items`
--
ALTER TABLE `incoming_items`
  ADD CONSTRAINT `incoming_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incoming_items_purchase_item_id_foreign` FOREIGN KEY (`purchase_item_id`) REFERENCES `purchase_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `outgoing_items`
--
ALTER TABLE `outgoing_items`
  ADD CONSTRAINT `outgoing_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD CONSTRAINT `purchase_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_items_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
