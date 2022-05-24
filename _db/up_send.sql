-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Bulan Mei 2022 pada 05.54
-- Versi server: 5.7.33
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `up_send`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `pertemuan_ke` int(3) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `materi_kuliah` text,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_detail`
--

CREATE TABLE `absensi_detail` (
  `id` int(11) NOT NULL,
  `id_absensi` int(11) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `keterangan` enum('Hadir','Tidak Hadir','Sakit','Izin','Lainnya') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `semester` int(3) DEFAULT NULL,
  `sks` int(3) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`, `id_matkul`, `semester`, `sks`, `id_user`) VALUES
(1, 'TIN M1', 1, 2, 2, 3),
(2, 'TIN S1', 1, 2, 2, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_detail`
--

CREATE TABLE `kelas_detail` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `aktif` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas_detail`
--

INSERT INTO `kelas_detail` (`id`, `id_kelas`, `id_mahasiswa`, `qr_code`, `aktif`) VALUES
(1, 1, 1, 'huTgpvwBFYWO485Vn4YJ', 'Y'),
(2, 1, 2, '1PouDtrv4rfvAByWn1kP', 'Y'),
(3, 1, 3, 'YmxmfgDZBSAVcOqKpK0z', 'Y'),
(4, 1, 4, 'UyygxLAEuNmdtwuzQXUO', 'Y'),
(5, 1, 5, 'yuZ7Ck3ckEn3kbeoJm2p', 'Y'),
(6, 1, 6, 'jO7RMAVif2FR6FmWcc9s', 'Y'),
(7, 1, 7, 'ImsjhK2w44olnMoBV9XW', 'Y'),
(8, 1, 8, 'nWJqlSWfBhp5hYHhDJ9N', 'Y'),
(9, 1, 9, 'ItVrJfHrIxBLumVLdtQq', 'Y'),
(10, 1, 10, 'mu9PLx9zqNBv8Qzm8kAC', 'Y'),
(11, 1, 11, 'umDltV7HAh9K5LpzLelI', 'Y'),
(12, 1, 12, 'UAS7zF05vbOe9ILKEr2B', 'Y'),
(13, 1, 13, 'xTolJV4EonRU5NVSdLFA', 'Y'),
(14, 1, 14, 'BapNwtZAg7hveMgM9xEk', 'Y'),
(15, 1, 15, 'rhJWSZhOFZBL3Aj1y4CC', 'Y'),
(16, 1, 16, '2QNybwgXuFiw6hC5qDJr', 'Y'),
(17, 1, 17, '12YKVXlBZcbWcix0MTTg', 'Y'),
(18, 1, 18, 'YWln2oV8zNTMaVtBgG7X', 'Y'),
(19, 1, 19, 'e2YnvdI85IuEJ3e3GOoG', 'Y'),
(20, 1, 20, 'K2NHGZWvkVLoOU1v1Gsk', 'Y'),
(21, 1, 21, 'fJdcza4H0E8r0rpRjuf5', 'Y'),
(22, 1, 22, 'PfJfhtYbfT8yLyjQqxcc', 'Y'),
(23, 1, 23, 'AOZms20ke85OJkvtqCjX', 'Y'),
(24, 1, 24, '61OTUyOxJjo4mcFTeiJC', 'Y'),
(25, 1, 25, '7HO6ZWPiaNI8CcQHJLMM', 'Y'),
(26, 1, 26, 'NXuPGs6cJAHQOp5Y4B6P', 'Y'),
(27, 1, 27, 'IppAbY7gNs3dV7k94Tih', 'Y'),
(28, 1, 28, 'jttIU9DdXSDqjxogqZci', 'Y'),
(29, 1, 29, 'zGCtx8kjAfMJ9KgqXReT', 'Y'),
(30, 1, 30, 'buCuv0in4Kju8b9CwdNX', 'Y'),
(31, 1, 31, 'lQYylJuCm2zJAx41ZPiX', 'Y'),
(32, 1, 32, '6kAXvVB0cvp5kgnu2tIU', 'Y'),
(33, 2, 33, 'o8wZSO0gJo7xX1uGPd2s', 'Y'),
(34, 2, 34, 'lhxaO9osAitO14ZBsAl7', 'N'),
(35, 2, 35, 'YaKfLkMmN55IyNdvEhos', 'Y'),
(36, 2, 36, 'rIf8RgRsyVeAVgT3TdUH', 'N'),
(37, 2, 37, 'OP6GMbjD1T9BYxCVjCyo', 'N'),
(38, 2, 38, 'vJQI24B4ccNbpyJ1IK8W', 'Y'),
(39, 2, 39, 'oVe346f5zU3E5iIh9L4L', 'Y'),
(40, 2, 40, 'kDdigCCTCEXqMjXvtMja', 'Y'),
(41, 2, 41, 'IGrwNf9sqzJAOGacWfxf', 'Y'),
(42, 2, 42, 'eEl2PnQ69mpItZZyppyz', 'N'),
(43, 2, 43, 'cD0OwQJe1p50F5p6cOaD', 'Y'),
(44, 2, 44, 'dIN7IXEnRpYShTf1dSjk', 'Y'),
(45, 2, 45, 'kMg30TWQGA4Rwdc7Jqb8', 'N'),
(46, 2, 46, 'i9DHBotvJhcG62H8iO38', 'N'),
(47, 2, 47, 'xCTx0n3j1Oo5TGblB4bD', 'Y'),
(48, 2, 48, 'v4HDaWC8c0SwnIpoM8VI', 'Y'),
(49, 2, 49, 'OEIV82tmXFDEiJNGaLql', 'Y'),
(50, 2, 50, 'ub4bITNYRlAgwfFvpCEq', 'Y'),
(51, 2, 51, 'AbGhOnhDIAzCspfGnsH3', 'Y'),
(52, 2, 52, 'atmqFfWShlHRc6GbIhni', 'Y'),
(53, 2, 53, '7lADYfyK2MbBS2u2SBuB', 'N'),
(54, 2, 54, 'GYnOegAojP88nbT4Dbt9', 'Y'),
(55, 2, 55, 'Uf2IdXr3fx7BHZWgvkPo', 'N'),
(56, 2, 56, 'BffsCSI5pNzyoqjuSTQI', 'Y'),
(57, 2, 57, 'NyWqeGfywZMmzTiWRnOU', 'Y'),
(58, 2, 58, 'dbJbAXVf1W8U5rsJZ6Mu', 'N'),
(59, 2, 59, 'bCqIVZkSIXnF1eU3mTkK', 'Y'),
(60, 2, 60, 'LMO06QoYsfReFYCSPqmm', 'Y'),
(61, 2, 61, 'qdDj9c7VU3J8Hb9OBKpF', 'Y'),
(62, 2, 62, 'K2xyO0hneUi8uIncmj7M', 'Y'),
(63, 2, 63, 'vKhh3KEpfwEbhUs3DTXj', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `npm` char(15) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `npm`, `nama`, `jk`) VALUES
(1, '2301211062', 'Andrian Bilhuda', 'L'),
(2, '2301211015', 'ARFAI', 'L'),
(3, '2301211019', 'Arfan Riyandhie', 'L'),
(4, '2301211002', 'Asep Nurudin', 'L'),
(5, '2301211016', 'Budiman', 'L'),
(6, '2301211026', 'Doni Pranata', 'L'),
(7, '2301211041', 'Elpanji Yuwianto', 'L'),
(8, '2301211051', 'Faizal Aulia', 'L'),
(9, '2301211043', 'Fikri Fadhilah', 'L'),
(10, '2301211064', 'Hari Dwi Putra', 'L'),
(11, '2301211021', 'Ikfal Ardiyanto', 'L'),
(12, '2301211004', 'Irvan', 'L'),
(13, '2301211057', 'Kristian Bernaldus', 'L'),
(14, '2301211042', 'Mahrus Helmi', 'L'),
(15, '2301211033', 'Mei Lino Nanda Nur Hidayat', 'L'),
(16, '2301211029', 'Muhamad Ahyanul Hakiki', 'L'),
(17, '2301211023', 'Muhamad Apriyana', 'L'),
(18, '2301211005', 'Muhamad Bahri', 'L'),
(19, '2321211004', 'Muhamad Ubaidillah', 'L'),
(20, '2301211058', 'Muhammad Reza Noviansyah', 'L'),
(21, '2301211008', 'Mujahidin', 'L'),
(22, '2301211028', 'Mustopah', 'L'),
(23, '2301211027', 'Naufal Firdaus', 'L'),
(24, '2301211039', 'Navis Alfauzan Rais', 'L'),
(25, '2302211004', 'Nuraisah', 'P'),
(26, '2302211006', 'Ratna Febriana', 'P'),
(27, '2301211045', 'Raymanul Hakim', 'L'),
(28, '2301211034', 'Rico Triyantara', 'L'),
(29, '2301211009', 'Rona Maulana', 'L'),
(30, '2301211012', 'Sohib Amrulloh', 'L'),
(31, '2301211024', 'Tb. Iib Baehaqi', 'L'),
(32, '2301211014', 'Tubagus Maulana Ari Saputra', 'L'),
(33, '2301211001', 'Agus Setia Budi', 'L'),
(34, '2301211046', 'Ahmad Ali Firdaus', 'L'),
(35, '2302211001', 'Amalia', 'P'),
(36, '2301211020', 'Andif Achmad Pamungkas', 'L'),
(37, '2301191079', 'Angga Ade Putra', 'L'),
(38, '2301211054', 'Anggi Faozi', 'L'),
(39, '2301211038', 'David Eduardo Manulang', 'L'),
(40, '2302211008', 'Erhan Joemaytanti', 'L'),
(41, '2301211032', 'Fajar Dwi Andano', 'L'),
(42, '2301211031', 'Fajarul Fauzan', 'L'),
(43, '2301211003', 'Fandi Ahmad Ababil', 'L'),
(44, '2301211050', 'Fathi Bilhaq Wirananggapathi', 'L'),
(45, '2302211002', 'Gina Maulia', 'P'),
(46, '2302211003', 'Iis Magpiroh', 'P'),
(47, '2301211047', 'Irgi Irfan Nurmuaziz', 'L'),
(48, '2301211040', 'M Miftahuddin E', 'L'),
(49, '2301211044', 'Muhamad Nur Iqbal', 'L'),
(50, '2301211006', 'Muhamad Rizky Rafly', 'L'),
(51, '2301211035', 'Muhammad Ardi Prasetya', 'L'),
(52, '2301211036', 'Muhammad Rafi Fadli', 'L'),
(53, '2301211007', 'Mujahidin', 'L'),
(54, '2301211048', 'Mulya Wahyu Diansyah', 'L'),
(55, '2302211007', 'Nova Windiarti', 'P'),
(56, '2301211037', 'Rumhani', 'P'),
(57, '2301211011', 'Singgih Lasmana', 'L'),
(58, '2302211005', 'Suhodah Erna wati', 'P'),
(59, '2301211010', 'Syaiful Hikmatullah', 'L'),
(60, '2301211018', 'Tegar Pambudi Hidayat', 'L'),
(61, '2301211059', 'Todi Tirta Wijaya', 'L'),
(62, '2301211052', 'Yanuar Nuryadin', 'L'),
(63, '2301211013', 'Yayan Khoirussibyan', 'L');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id` int(11) NOT NULL,
  `kode` char(30) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `matakuliah`
--

INSERT INTO `matakuliah` (`id`, `kode`, `nama`) VALUES
(1, '202235', 'Fisika Dasar II (otomasi Industri) + Praktikum');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_05_17_022018_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3);

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
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-05-16 22:44:39', '2022-05-16 22:44:39'),
(2, 'dosen', 'web', '2022-05-16 22:44:39', '2022-05-16 22:44:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@email.com', NULL, '$2y$10$VukhbRUMBjS.06uY8602TeHg1Ac/iW2I8sgZjFyEuiMe9UELWl5CW', 'blank.png', NULL, '2022-05-16 22:44:39', '2022-05-16 22:44:39'),
(2, 'Muhammad Dede Nuraen', 'm.dedenuraen@gmail.com', NULL, '$2y$10$tmMBbUL/dBNUluW0Gvf7U.Rix8.wMyHbBXPta8vRy5OoR2D3vSYZq', 'avatar-2.jpg', 'zMGNWOsylhCKfjjO5zrHOPPFpStJuuEQqCiBUFFbrsHP1rUoj8MMuVxmf97Z', '2022-05-16 22:44:39', '2022-05-17 23:24:14'),
(3, 'Uswatun', 'uswatun@gmail.com', NULL, '$2y$10$tmMBbUL/dBNUluW0Gvf7U.Rix8.wMyHbBXPta8vRy5OoR2D3vSYZq', 'blank.png', NULL, '2022-05-18 04:35:34', '2022-05-18 04:46:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `absensi_detail`
--
ALTER TABLE `absensi_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_absensi` (`id_absensi`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_matkul` (`id_matkul`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `kelas_detail`
--
ALTER TABLE `kelas_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npm` (`npm`);

--
-- Indeks untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `absensi_detail`
--
ALTER TABLE `absensi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kelas_detail`
--
ALTER TABLE `kelas_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
