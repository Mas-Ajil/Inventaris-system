-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Okt 2024 pada 12.26
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_inventaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `receiver` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_at` date NOT NULL,
  `returned_at` date NOT NULL,
  `give_back` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_04_115152_create_products_table', 1),
(6, '2024_10_11_092420_create_transactions_table', 1),
(7, '2024_10_12_120953_create_loans_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'HDMI (20 Meter Biru 4K)', 5, '2024-10-01 05:30:00', '2024-10-22 02:50:51'),
(2, 'HDMI (20 Meter)', 3, '2024-10-01 06:10:00', '2024-10-22 02:50:51'),
(3, 'HDMI (10 Meter)', 1, '2024-10-01 07:00:00', '2024-10-22 02:50:51'),
(4, 'HDMI (15 Meter HD)', 1, '2024-10-01 08:20:00', '2024-10-05 08:10:00'),
(5, 'HDMI (10 Meter 4K)', 1, '2024-10-01 09:00:00', '2024-10-05 08:30:00'),
(6, 'SDI (20 Meter)', 5, '2024-10-01 09:30:00', '2024-10-05 09:00:00'),
(7, 'Kabel Type C to Sata', 1, '2024-10-01 10:00:00', '2024-10-05 09:20:00'),
(8, 'Converter SDI to HDMI (HD)', 1, '2024-10-01 10:30:00', '2024-10-05 09:40:00'),
(9, 'Converter SDI to HDMI (FHD)', 2, '2024-10-01 11:00:00', '2024-10-05 10:00:00'),
(10, 'Kabel Roll', 4, '2024-10-01 11:30:00', '2024-10-05 10:20:00'),
(11, 'Kamera + Charger (Sony PXW)', 3, '2024-10-02 02:00:00', '2024-10-06 02:20:00'),
(12, 'Kamera + Charger (Sony PXW 4K)', 3, '2024-10-02 02:30:00', '2024-10-06 02:40:00'),
(13, 'Kamera + Charger (Sony NX)', 1, '2024-10-02 03:00:00', '2024-10-06 03:10:00'),
(14, 'Kamera + Charger (Sony A6300 + Lensa Kit)', 1, '2024-10-02 03:30:00', '2024-10-06 03:40:00'),
(15, 'Kamera + Charger (Sony A6400 + Lensa Kit)', 2, '2024-10-02 04:00:00', '2024-10-06 04:10:00'),
(16, 'Kamera + Charger (Webcam)', 2, '2024-10-02 04:30:00', '2024-10-06 04:40:00'),
(17, 'Go Pro', 2, '2024-10-02 05:00:00', '2024-10-06 05:20:00'),
(18, 'Go Pro 360', 1, '2024-10-02 05:30:00', '2024-10-06 05:40:00'),
(19, 'Drone', 2, '2024-10-02 06:00:00', '2024-10-06 06:10:00'),
(20, 'Lensa (Tele 70-200 mm)', 1, '2024-10-02 06:30:00', '2024-10-06 06:40:00'),
(21, 'Lensa Fix', 1, '2024-10-02 07:00:00', '2024-10-06 07:20:00'),
(22, 'Lensa Wide', 1, '2024-10-02 07:30:00', '2024-10-06 07:40:00'),
(23, 'Baterai Mirrorless', 6, '2024-10-02 08:00:00', '2024-10-06 08:20:00'),
(24, 'Baterai PXW', 7, '2024-10-02 08:30:00', '2024-10-06 08:40:00'),
(25, 'Baterai NX', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(26, 'Baterai Go Pro', 6, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(27, 'Rode (4 Set)', 4, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(28, 'Senheizer (4 Set)', 4, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(29, 'Mic Podcast', 4, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(30, 'Mic Rode (bulu)', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(31, 'Saramonic', 3, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(32, 'Soundcard', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(33, 'Podtrack', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(34, 'H6', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(35, 'Evo 4', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(36, 'Audio Interface Focusrite Scarlett', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(37, 'Mic Holly land', 2, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(38, 'Memory Card (32 gb 90 mbps Extreme)', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(39, 'Memory Card (64 gb 170 mbps Extreme)', 9, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(40, 'Memory Card (64 gb 170 mbps Extreme Pro)', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(41, 'Memory Card (Micro SD 64 gb Extreme)', 3, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(42, 'Switcher ATEM + Black Magic', 2, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(43, 'Video Capture', 3, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(44, 'Intercome (1 set (8 buah))', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(45, 'HT (1 set (8 buah))', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(46, 'Hollyland + Transmitter (3 set)', 3, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(47, 'Baterai Hollyland', 6, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(48, 'Laptop (Putih) + Charger', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(49, 'Laptop ROG + Charger', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(50, 'Tripod', 5, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(51, 'Lightstand', 11, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(52, 'Monopod', 2, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(53, 'Ipad', 3, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(54, 'Lighting Softbox', 5, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(55, 'Lighting Besar godox', 6, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(56, 'Lighting Gvm (4 set)', 4, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(57, 'Baterai Lighting', 9, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(58, 'Gimbal', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(59, 'Mixer', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(60, 'Teleprompter', 4, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(61, 'Smart TV', 5, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(62, 'Layar Viltrox', 2, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(63, 'Mic Boya', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(64, 'Standing Mic Podcast', 2, '2024-10-02 09:00:00', '2024-10-06 09:10:00'),
(65, 'Slider Camera', 1, '2024-10-02 09:00:00', '2024-10-06 09:10:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('borrowed','returned') NOT NULL DEFAULT 'borrowed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'admin',
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `level`, `email`, `email_verified_at`, `phone`, `address`, `full_name`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'superAdmin', NULL, NULL, NULL, NULL, NULL, '$2y$12$.6FPm31S23vyNvnJSk3xNet5z6ibCyMwBfMkW7rv/qzyAXe7bmqHS', NULL, '2024-10-22 02:33:36', '2024-10-22 02:33:36'),
(3, 'azizil', 'superAdmin', 'azizil@ganteng.com', NULL, '08512763416', 'banjarnegara', 'Azizil putra gaming slur', '$2y$12$.gt6efjyuUkGhWAhiR9MW.DLrbjYaMWHhNXTb2d9pQAPzdDYHMXvS', NULL, '2024-10-22 02:35:20', '2024-10-22 02:46:52'),
(5, 'exksel', 'admin', 'daffaazhar66@gmail.com', NULL, '087725274081', 'Perum Panorama Wilis F.19', 'Muhammad Daffa Azhar', '$2y$12$ysibcD94R4jy0xa09b47cOjMa0rzkpgnDx4NErOpH0iK0Cfi6SJSW', NULL, '2024-10-22 03:11:23', '2024-10-22 03:12:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_user_id_foreign` (`user_id`),
  ADD KEY `loans_transaction_id_foreign` (`transaction_id`),
  ADD KEY `loans_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
