-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Okt 2024 pada 11.04
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

--
-- Dumping data untuk tabel `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `transaction_id`, `user_name`, `receiver`, `product_id`, `quantity`, `borrowed_at`, `returned_at`, `give_back`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Paijo Kopral', 'Administrator', 1, 1, '2024-10-19', '2024-10-31', '2024-10-19', 'Assda', '2024-10-19 01:58:28', '2024-10-19 01:59:38'),
(2, 2, 1, 'Paijo Kopral', 'Administrator', 2, 1, '2024-10-19', '2024-10-31', '2024-10-19', 'Assda', '2024-10-19 01:58:28', '2024-10-19 01:59:38'),
(3, 2, 1, 'Paijo Kopral', 'Administrator', 4, 1, '2024-10-19', '2024-10-31', '2024-10-19', 'Assda', '2024-10-19 01:58:28', '2024-10-19 01:59:38'),
(4, 2, 1, 'Paijo Kopral', 'Administrator', 5, 1, '2024-10-19', '2024-10-31', '2024-10-19', 'Assda', '2024-10-19 01:58:28', '2024-10-19 01:59:38'),
(5, 2, 1, 'Paijo Kopral', 'Administrator', 7, 1, '2024-10-19', '2024-10-31', '2024-10-19', 'Assda', '2024-10-19 01:58:28', '2024-10-19 01:59:38'),
(6, 1, 2, 'Romi Anjay', 'Administrator', 1, 5, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(7, 1, 2, 'Romi Anjay', 'Administrator', 2, 3, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(8, 1, 2, 'Romi Anjay', 'Administrator', 3, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(9, 1, 2, 'Romi Anjay', 'Administrator', 4, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(10, 1, 2, 'Romi Anjay', 'Administrator', 5, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(11, 1, 2, 'Romi Anjay', 'Administrator', 6, 5, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(12, 1, 2, 'Romi Anjay', 'Administrator', 7, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(13, 1, 2, 'Romi Anjay', 'Administrator', 8, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(14, 1, 2, 'Romi Anjay', 'Administrator', 9, 2, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(15, 1, 2, 'Romi Anjay', 'Administrator', 10, 4, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(16, 1, 2, 'Romi Anjay', 'Administrator', 11, 3, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(17, 1, 2, 'Romi Anjay', 'Administrator', 12, 3, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(18, 1, 2, 'Romi Anjay', 'Administrator', 13, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(19, 1, 2, 'Romi Anjay', 'Administrator', 14, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(20, 1, 2, 'Romi Anjay', 'Administrator', 15, 2, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(21, 1, 2, 'Romi Anjay', 'Administrator', 16, 2, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(22, 1, 2, 'Romi Anjay', 'Administrator', 17, 2, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(23, 1, 2, 'Romi Anjay', 'Administrator', 18, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(24, 1, 2, 'Romi Anjay', 'Administrator', 19, 2, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(25, 1, 2, 'Romi Anjay', 'Administrator', 20, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(26, 1, 2, 'Romi Anjay', 'Administrator', 21, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(27, 1, 2, 'Romi Anjay', 'Administrator', 22, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(28, 1, 2, 'Romi Anjay', 'Administrator', 23, 6, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(29, 1, 2, 'Romi Anjay', 'Administrator', 24, 7, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(30, 1, 2, 'Romi Anjay', 'Administrator', 25, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(31, 1, 2, 'Romi Anjay', 'Administrator', 26, 6, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(32, 1, 2, 'Romi Anjay', 'Administrator', 27, 4, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(33, 1, 2, 'Romi Anjay', 'Administrator', 28, 4, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(34, 1, 2, 'Romi Anjay', 'Administrator', 29, 4, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(35, 1, 2, 'Romi Anjay', 'Administrator', 30, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(36, 1, 2, 'Romi Anjay', 'Administrator', 31, 3, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(37, 1, 2, 'Romi Anjay', 'Administrator', 32, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(38, 1, 2, 'Romi Anjay', 'Administrator', 33, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(39, 1, 2, 'Romi Anjay', 'Administrator', 34, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:25'),
(40, 1, 2, 'Romi Anjay', 'Administrator', 35, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(41, 1, 2, 'Romi Anjay', 'Administrator', 36, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(42, 1, 2, 'Romi Anjay', 'Administrator', 37, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(43, 1, 2, 'Romi Anjay', 'Administrator', 38, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(44, 1, 2, 'Romi Anjay', 'Administrator', 39, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(45, 1, 2, 'Romi Anjay', 'Administrator', 40, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(46, 1, 2, 'Romi Anjay', 'Administrator', 41, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(47, 1, 2, 'Romi Anjay', 'Administrator', 42, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(48, 1, 2, 'Romi Anjay', 'Administrator', 43, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(49, 1, 2, 'Romi Anjay', 'Administrator', 44, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(50, 1, 2, 'Romi Anjay', 'Administrator', 45, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(51, 1, 2, 'Romi Anjay', 'Administrator', 46, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(52, 1, 2, 'Romi Anjay', 'Administrator', 47, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(53, 1, 2, 'Romi Anjay', 'Administrator', 48, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(54, 1, 2, 'Romi Anjay', 'Administrator', 49, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(55, 1, 2, 'Romi Anjay', 'Administrator', 50, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(56, 1, 2, 'Romi Anjay', 'Administrator', 51, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(57, 1, 2, 'Romi Anjay', 'Administrator', 52, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(58, 1, 2, 'Romi Anjay', 'Administrator', 53, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(59, 1, 2, 'Romi Anjay', 'Administrator', 54, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(60, 1, 2, 'Romi Anjay', 'Administrator', 55, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(61, 1, 2, 'Romi Anjay', 'Administrator', 56, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(62, 1, 2, 'Romi Anjay', 'Administrator', 57, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(63, 1, 2, 'Romi Anjay', 'Administrator', 58, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(64, 1, 2, 'Romi Anjay', 'Administrator', 59, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(65, 1, 2, 'Romi Anjay', 'Administrator', 60, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(66, 1, 2, 'Romi Anjay', 'Administrator', 61, 5, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(67, 1, 2, 'Romi Anjay', 'Administrator', 62, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(68, 1, 2, 'Romi Anjay', 'Administrator', 63, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(69, 1, 2, 'Romi Anjay', 'Administrator', 64, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(70, 1, 2, 'Romi Anjay', 'Administrator', 65, 1, '2024-10-19', '2024-10-20', '2024-10-19', 'Tes', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(71, 1, 3, 'Bang Ndolip', 'Administrator', 1, 5, '2024-10-19', '2024-10-21', '2024-10-19', 'Slimekk', '2024-10-19 03:23:50', '2024-10-19 03:24:02'),
(72, 1, 3, 'Bang Ndolip', 'Administrator', 3, 1, '2024-10-19', '2024-10-21', '2024-10-19', 'Slimekk', '2024-10-19 03:23:50', '2024-10-19 03:24:02'),
(73, 1, 3, 'Bang Ndolip', 'Administrator', 4, 1, '2024-10-19', '2024-10-21', '2024-10-19', 'Slimekk', '2024-10-19 03:23:50', '2024-10-19 03:24:02'),
(74, 1, 4, 'Arbi Namikaze', NULL, 1, 5, '2024-10-19', '2024-10-31', NULL, 'Nyilih', '2024-10-19 03:35:07', '2024-10-19 03:35:07'),
(75, 1, 4, 'Arbi Namikaze', NULL, 3, 1, '2024-10-19', '2024-10-31', NULL, 'Nyilih', '2024-10-19 03:35:07', '2024-10-19 03:35:07'),
(76, 1, 4, 'Arbi Namikaze', NULL, 4, 1, '2024-10-19', '2024-10-31', NULL, 'Nyilih', '2024-10-19 03:35:07', '2024-10-19 03:35:07');

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
(1, 'HDMI (20 Meter Biru 4K)', 0, '2024-10-01 05:30:00', '2024-10-19 03:35:07'),
(2, 'HDMI (20 Meter)', 3, '2024-10-01 06:10:00', '2024-10-19 03:13:25'),
(3, 'HDMI (10 Meter)', 0, '2024-10-01 07:00:00', '2024-10-19 03:35:07'),
(4, 'HDMI (15 Meter HD)', 0, '2024-10-01 08:20:00', '2024-10-19 03:35:07'),
(5, 'HDMI (10 Meter 4K)', 1, '2024-10-01 09:00:00', '2024-10-19 03:13:25'),
(6, 'SDI (20 Meter)', 5, '2024-10-01 09:30:00', '2024-10-19 03:13:25'),
(7, 'Kabel Type C to Sata', 1, '2024-10-01 10:00:00', '2024-10-19 03:13:25'),
(8, 'Converter SDI to HDMI (HD)', 1, '2024-10-01 10:30:00', '2024-10-19 03:13:25'),
(9, 'Converter SDI to HDMI (FHD)', 2, '2024-10-01 11:00:00', '2024-10-19 03:13:25'),
(10, 'Kabel Roll', 4, '2024-10-01 11:30:00', '2024-10-19 03:13:25'),
(11, 'Kamera + Charger (Sony PXW)', 3, '2024-10-02 02:00:00', '2024-10-19 03:13:25'),
(12, 'Kamera + Charger (Sony PXW 4K)', 3, '2024-10-02 02:30:00', '2024-10-19 03:13:25'),
(13, 'Kamera + Charger (Sony NX)', 1, '2024-10-02 03:00:00', '2024-10-19 03:13:25'),
(14, 'Kamera + Charger (Sony A6300 + Lensa Kit)', 1, '2024-10-02 03:30:00', '2024-10-19 03:13:25'),
(15, 'Kamera + Charger (Sony A6400 + Lensa Kit)', 2, '2024-10-02 04:00:00', '2024-10-19 03:13:25'),
(16, 'Kamera + Charger (Webcam)', 2, '2024-10-02 04:30:00', '2024-10-19 03:13:25'),
(17, 'Go Pro', 2, '2024-10-02 05:00:00', '2024-10-19 03:13:25'),
(18, 'Go Pro 360', 1, '2024-10-02 05:30:00', '2024-10-19 03:13:25'),
(19, 'Drone', 2, '2024-10-02 06:00:00', '2024-10-19 03:13:25'),
(20, 'Lensa (Tele 70-200 mm)', 1, '2024-10-02 06:30:00', '2024-10-19 03:13:25'),
(21, 'Lensa Fix', 1, '2024-10-02 07:00:00', '2024-10-19 03:13:25'),
(22, 'Lensa Wide', 1, '2024-10-02 07:30:00', '2024-10-19 03:13:25'),
(23, 'Baterai Mirrorless', 6, '2024-10-02 08:00:00', '2024-10-19 03:13:25'),
(24, 'Baterai PXW', 7, '2024-10-02 08:30:00', '2024-10-19 03:13:25'),
(25, 'Baterai NX', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:25'),
(26, 'Baterai Go Pro', 6, '2024-10-02 09:00:00', '2024-10-19 03:13:25'),
(27, 'Rode (4 Set)', 4, '2024-10-02 09:00:00', '2024-10-19 03:13:25'),
(28, 'Senheizer (4 Set)', 4, '2024-10-02 09:00:00', '2024-10-19 03:13:25'),
(29, 'Mic Podcast', 4, '2024-10-02 09:00:00', '2024-10-19 03:13:25'),
(30, 'Mic Rode (bulu)', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:25'),
(31, 'Saramonic', 3, '2024-10-02 09:00:00', '2024-10-19 03:13:25'),
(32, 'Soundcard', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:25'),
(33, 'Podtrack', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:25'),
(34, 'H6', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:25'),
(35, 'Evo 4', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:25'),
(36, 'Audio Interface Focusrite Scarlett', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(37, 'Mic Holly land', 2, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(38, 'Memory Card (32 gb 90 mbps Extreme)', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(39, 'Memory Card (64 gb 170 mbps Extreme)', 9, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(40, 'Memory Card (64 gb 170 mbps Extreme Pro)', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(41, 'Memory Card (Micro SD 64 gb Extreme)', 3, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(42, 'Switcher ATEM + Black Magic', 2, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(43, 'Video Capture', 3, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(44, 'Intercome (1 set (8 buah))', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(45, 'HT (1 set (8 buah))', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(46, 'Hollyland + Transmitter (3 set)', 3, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(47, 'Baterai Hollyland', 6, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(48, 'Laptop (Putih) + Charger', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(49, 'Laptop ROG + Charger', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(50, 'Tripod', 5, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(51, 'Lightstand', 11, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(52, 'Monopod', 2, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(53, 'Ipad', 3, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(54, 'Lighting Softbox', 5, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(55, 'Lighting Besar godox', 6, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(56, 'Lighting Gvm (4 set)', 4, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(57, 'Baterai Lighting', 9, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(58, 'Gimbal', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(59, 'Mixer', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(60, 'Teleprompter', 4, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(61, 'Smart TV', 5, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(62, 'Layar Viltrox', 2, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(63, 'Mic Boya', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(64, 'Standing Mic Podcast', 2, '2024-10-02 09:00:00', '2024-10-19 03:13:26'),
(65, 'Slider Camera', 1, '2024-10-02 09:00:00', '2024-10-19 03:13:26');

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

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'returned', '2024-10-19 01:58:28', '2024-10-19 01:59:38'),
(2, 1, 'returned', '2024-10-19 03:12:06', '2024-10-19 03:13:26'),
(3, 1, 'returned', '2024-10-19 03:23:50', '2024-10-19 03:24:02'),
(4, 1, 'borrowed', '2024-10-19 03:35:07', '2024-10-19 03:35:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'admin',
  `full_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `level`, `full_name`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'superAdmin', NULL, '$2y$12$3.bCTaSRCfVHOA.cmsuQTulg4uHWc4i74d849CBgH/ecFGP6DBfVC', NULL, '2024-10-19 01:55:16', '2024-10-19 01:55:16'),
(2, 'excel', 'admin', NULL, '$2y$12$b9N8/7OlNlHBQzRi0vusA.1LEr1NRrTSQDXWCC3hKzBCg4Gy9ryju', NULL, '2024-10-19 01:55:28', '2024-10-19 01:55:28'),
(3, 'ryu', 'admin', NULL, '$2y$12$bqIgvdpNXeUhvo0jnTJn.eScYJlCR.eyvhLn/Fkjkwyrn2r95Cwti', NULL, '2024-10-19 01:57:18', '2024-10-19 01:57:18');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
