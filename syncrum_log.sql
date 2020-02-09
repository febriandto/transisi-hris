-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Feb 2020 pada 00.43
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syncrum`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_barang`
--

CREATE TABLE `m_barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga_jual` decimal(10,0) DEFAULT NULL,
  `harga_beli` decimal(10,0) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `input_by` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `delete_by` varchar(50) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `is_delete` varchar(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_barang`
--

INSERT INTO `m_barang` (`id_barang`, `kode_barang`, `nama_barang`, `harga_jual`, `harga_beli`, `satuan`, `input_by`, `input_date`, `update_by`, `update_date`, `delete_by`, `delete_date`, `is_delete`) VALUES
(1, 'BRG001', 'kljklj', '76', '76', 'Test', 'wahyu', '2020-02-05 16:10:54', 'wahyu', '2020-02-05 16:13:52', NULL, NULL, 'N'),
(2, NULL, 'lkjljlkjkljkl', '8787', '878', 'kljkj', 'wahyu', '2020-02-05 16:12:12', NULL, NULL, 'wahyu', '2020-02-08 04:43:31', 'Y'),
(25, '001', 'pizza', '3000', '2000', 'biji', 'wahyu', '2020-02-07 09:34:54', NULL, NULL, NULL, NULL, 'N'),
(26, '001', 'pizza', '1300', '1200', 'satu', 'wahyu', '2020-02-09 06:51:31', NULL, NULL, NULL, NULL, 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Wahyu', 'wahyu', 'theprojectseven@gmail.com', NULL, '$2y$10$tTUlZzr0NEzWK0.sigiYRuEvAaHUYn8SUHmGwNaS9issF4YMJ/5du', NULL, '2020-01-26 08:30:03', '2020-01-26 08:30:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wms_m_area`
--

CREATE TABLE `wms_m_area` (
  `wh_area_id` varchar(100) NOT NULL,
  `wh_zone_id` varchar(100) DEFAULT NULL,
  `wh_area_name` varchar(200) DEFAULT NULL,
  `wh_area_desc` varchar(200) DEFAULT NULL,
  `input_by` varchar(100) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `edit_by` varchar(100) DEFAULT NULL,
  `edit_date` date DEFAULT NULL,
  `delete_by` varchar(255) DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `is_delete` varchar(2) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wms_m_area`
--

INSERT INTO `wms_m_area` (`wh_area_id`, `wh_zone_id`, `wh_area_name`, `wh_area_desc`, `input_by`, `input_date`, `edit_by`, `edit_date`, `delete_by`, `delete_date`, `is_delete`) VALUES
('02', 'test2', 'Warehouse Area 2', 'dua', 'wahyu', '2020-02-09', NULL, NULL, NULL, NULL, 'N'),
('03', 'test2', 'test3', 'test3', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wms_m_bin`
--

CREATE TABLE `wms_m_bin` (
  `bin_loc_id` varchar(100) NOT NULL,
  `wh_row_id` varchar(100) DEFAULT NULL,
  `bin_loc_name` varchar(200) DEFAULT NULL,
  `bin_loc_desc` varchar(200) DEFAULT NULL,
  `input_by` varchar(100) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `edit_by` varchar(100) DEFAULT NULL,
  `edit_date` date DEFAULT NULL,
  `delete_by` varchar(255) DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `is_delete` varchar(2) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wms_m_bin`
--

INSERT INTO `wms_m_bin` (`bin_loc_id`, `wh_row_id`, `bin_loc_name`, `bin_loc_desc`, `input_by`, `input_date`, `edit_by`, `edit_date`, `delete_by`, `delete_date`, `is_delete`) VALUES
('1', '1', 'test', 'test', 'test', '2020-02-08', 'test', NULL, NULL, NULL, 'N'),
('14', 'test1', 'test14', 'test14', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wms_m_row`
--

CREATE TABLE `wms_m_row` (
  `wh_row_id` varbinary(255) NOT NULL,
  `wh_area_id` varchar(100) DEFAULT NULL,
  `wh_row_name` varchar(100) DEFAULT NULL,
  `wh_row_desc` varchar(200) DEFAULT NULL,
  `input_by` varchar(100) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `edit_by` varchar(100) DEFAULT NULL,
  `edit_date` date DEFAULT NULL,
  `delete_by` varchar(255) DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `is_delete` varchar(2) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wms_m_row`
--

INSERT INTO `wms_m_row` (`wh_row_id`, `wh_area_id`, `wh_row_name`, `wh_row_desc`, `input_by`, `input_date`, `edit_by`, `edit_date`, `delete_by`, `delete_date`, `is_delete`) VALUES
(0x30783031, 'test1', '1', 'test1', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', 'Y'),
(0x30783032, 'test1', 'RowName', 'RowDesc', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', NULL, NULL, 'N'),
(0x30783033, 'test2', 'RowName03', 'RowDesc03', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', NULL, NULL, 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wms_m_warehouse`
--

CREATE TABLE `wms_m_warehouse` (
  `wh_id` varchar(50) NOT NULL,
  `wh_name` varchar(200) DEFAULT NULL,
  `wh_description` varchar(200) DEFAULT NULL,
  `input_by` varchar(100) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `edit_by` varchar(100) DEFAULT NULL,
  `edit_date` date DEFAULT NULL,
  `delete_by` varchar(255) DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `is_delete` varchar(2) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wms_m_warehouse`
--

INSERT INTO `wms_m_warehouse` (`wh_id`, `wh_name`, `wh_description`, `input_by`, `input_date`, `edit_by`, `edit_date`, `delete_by`, `delete_date`, `is_delete`) VALUES
('0x03', 'Joni', 'Jono', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', 'Y'),
('1', 'Warehouse 1', 'Warehouse Desc', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', NULL, NULL, 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wms_m_warehouse_zone`
--

CREATE TABLE `wms_m_warehouse_zone` (
  `wh_zone_id` int(11) NOT NULL,
  `wh_id` varchar(100) DEFAULT NULL,
  `wh_zone_name` varchar(100) DEFAULT NULL,
  `wh_zone_desc` varchar(200) DEFAULT NULL,
  `input_by` varchar(100) DEFAULT NULL,
  `input_date` date DEFAULT current_timestamp(),
  `edit_by` varchar(100) DEFAULT NULL,
  `edit_date` date DEFAULT NULL,
  `delete_by` varchar(255) DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `is_delete` varchar(2) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wms_m_warehouse_zone`
--

INSERT INTO `wms_m_warehouse_zone` (`wh_zone_id`, `wh_id`, `wh_zone_name`, `wh_zone_desc`, `input_by`, `input_date`, `edit_by`, `edit_date`, `delete_by`, `delete_date`, `is_delete`) VALUES
(1, 'test', 'Warehouse Zone 1', 'WHZ desc', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', 'febri', '2020-02-09', 'N'),
(2, 'test1', 'Zona Nyaman', 'Nyaman', 'wahyu', '2020-02-09', NULL, NULL, 'wahyu', '2020-02-09', 'Y'),
(3, 'test2', 'Zona Bahaya', 'Bahaya', 'wahyu', '2020-02-09', NULL, NULL, NULL, NULL, 'N'),
(4, 'test2', 'Zona Nyaman', 'Bahaya', 'wahyu', '2020-02-09', NULL, NULL, NULL, NULL, 'N'),
(5, 'test1', 'Zona Nyaman', 'Bahaya', 'wahyu', '2020-02-09', NULL, NULL, NULL, NULL, 'N'),
(6, 'test1', 'Zona Nyaman', 'Bahaya', 'wahyu', '2020-02-09', NULL, NULL, 'wahyu', '2020-02-09', 'Y'),
(7, 'test1', 'Zona Bahaya', 'Bahaya', 'wahyu', '2020-02-09', NULL, NULL, NULL, NULL, 'N'),
(8, 'test1', 'Zona Nyamans', 'Bahayas', 'wahyu', '2020-02-09', NULL, NULL, NULL, NULL, 'N'),
(9, 'test2', 'testtest edit', 'test edit', 'wahyu', '2020-02-09', 'wahyu', '2020-02-09', NULL, NULL, 'N');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `wms_m_area`
--
ALTER TABLE `wms_m_area`
  ADD PRIMARY KEY (`wh_area_id`);

--
-- Indeks untuk tabel `wms_m_bin`
--
ALTER TABLE `wms_m_bin`
  ADD PRIMARY KEY (`bin_loc_id`);

--
-- Indeks untuk tabel `wms_m_row`
--
ALTER TABLE `wms_m_row`
  ADD PRIMARY KEY (`wh_row_id`);

--
-- Indeks untuk tabel `wms_m_warehouse`
--
ALTER TABLE `wms_m_warehouse`
  ADD PRIMARY KEY (`wh_id`);

--
-- Indeks untuk tabel `wms_m_warehouse_zone`
--
ALTER TABLE `wms_m_warehouse_zone`
  ADD PRIMARY KEY (`wh_zone_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `wms_m_warehouse_zone`
--
ALTER TABLE `wms_m_warehouse_zone`
  MODIFY `wh_zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
