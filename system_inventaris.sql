-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Okt 2024 pada 20.48
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
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `borrowed_at` date NOT NULL,
  `returned_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `loans`
--

INSERT INTO `loans` (`id`, `product_id`, `user_id`, `quantity`, `borrowed_at`, `returned_at`, `created_at`, `updated_at`, `status`) VALUES
(18, 1, 1, 1, '2024-10-12', '2024-10-14', '2024-10-05 04:01:43', '2024-10-05 04:01:43', 'returned'),
(19, 5, 1, 1, '2024-10-12', '2024-10-14', '2024-10-05 04:01:43', '2024-10-05 04:01:43', 'returned'),
(20, 1, 2, 1, '2024-10-05', '2024-10-07', '2024-10-05 04:02:03', '2024-10-05 04:02:03', 'borrowed'),
(21, 2, 2, 1, '2024-10-05', '2024-10-07', '2024-10-05 04:02:03', '2024-10-05 04:02:03', 'borrowed'),
(22, 3, 2, 1, '2024-10-05', '2024-10-07', '2024-10-05 04:02:03', '2024-10-05 04:02:03', 'borrowed'),
(23, 4, 2, 1, '2024-10-05', '2024-10-07', '2024-10-05 04:02:03', '2024-10-05 04:02:03', 'borrowed'),
(24, 5, 2, 1, '2024-10-05', '2024-10-07', '2024-10-05 04:02:03', '2024-10-05 04:02:03', 'borrowed'),
(25, 1, 2, 1, '2024-10-05', '2024-10-06', '2024-10-05 04:05:30', '2024-10-05 04:05:30', 'borrowed'),
(26, 2, 2, 1, '2024-10-05', '2024-10-06', '2024-10-05 04:05:30', '2024-10-05 04:05:30', 'borrowed'),
(27, 3, 2, 1, '2024-10-05', '2024-10-06', '2024-10-05 04:05:30', '2024-10-05 04:05:30', 'borrowed'),
(28, 4, 2, 1, '2024-10-05', '2024-10-06', '2024-10-05 04:05:30', '2024-10-05 04:05:30', 'borrowed'),
(29, 5, 2, 1, '2024-10-05', '2024-10-06', '2024-10-05 04:05:30', '2024-10-05 04:05:30', 'borrowed'),
(30, 1, 2, 1, '2024-10-05', '2024-10-06', '2024-10-05 04:52:34', '2024-10-05 04:52:34', 'borrowed'),
(31, 5, 2, 1, '2024-10-06', '2024-10-09', '2024-10-05 04:53:05', '2024-10-05 04:53:05', 'borrowed'),
(32, 5, 1, 1, '2024-10-11', '2024-10-14', '2024-10-05 05:01:31', '2024-10-05 05:01:31', 'returned'),
(33, 1, 2, 1, '2024-10-05', '2024-10-25', '2024-10-05 05:18:21', '2024-10-05 05:18:21', 'returned'),
(34, 1, 1, 1, '2024-10-05', '2024-10-10', '2024-10-05 05:36:21', '2024-10-05 05:36:21', 'borrowed'),
(35, 3, 1, 1, '2024-10-06', '2024-10-10', '2024-10-05 11:39:07', '2024-10-05 11:39:07', 'borrowed'),
(36, 4, 1, 1, '2024-10-06', '2024-10-10', '2024-10-05 11:39:07', '2024-10-05 11:39:07', 'borrowed');

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
(6, '2024_10_04_120953_create_loans_table', 1),
(7, '2024_10_05_121224_add_status_to_loans_table', 2);

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
(1, 'kamera', 4, '2024-10-04 12:50:03', '2024-10-05 05:36:21'),
(2, 'light', 2, '2024-10-04 13:07:48', '2024-10-05 04:05:30'),
(3, 'komputer', 3, '2024-10-05 13:08:11', '2024-10-05 11:39:07'),
(4, 'printer', 5, '2024-10-12 13:08:35', '2024-10-05 11:39:07'),
(5, 'microphone', 1, '2024-10-05 10:28:36', '2024-10-05 05:01:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `level`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Azizil', 'user', 'latif@gmail.com', NULL, '$2y$12$/nzcZZuhsBi/QLmFHwEfaexS.j0nrbWTO09AkLB8LcbEFaujyJXOy', NULL, '2024-10-04 05:50:33', '2024-10-04 05:50:33'),
(2, 'ee', 'user', 'ee@gmail.com', NULL, '$2y$12$SOC.rMlvuR2krwvIGGST9uk1DxN61nmjeFCucpG0GSoR.zadXPJ9u', NULL, '2024-10-04 05:52:53', '2024-10-04 05:52:53');

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
  ADD KEY `loans_product_id_foreign` (`product_id`),
  ADD KEY `loans_user_id_foreign` (`user_id`);

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
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
