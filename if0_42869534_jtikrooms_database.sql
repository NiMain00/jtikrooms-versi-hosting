-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql306.infinityfree.com
-- Waktu pembuatan: 16 Sep 2026 pada 03.58
-- Versi server: 11.4.13-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_42869534_jtikrooms_database`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about_jtik`
--

CREATE TABLE `about_jtik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hero_stats` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ;

--
-- Dumping data untuk tabel `about_jtik`
--

INSERT INTO `about_jtik` (`id`, `hero_stats`, `info`, `detail`, `created_at`, `updated_at`) VALUES
(1, '{\"title\":\"Jurusan Teknik Informatika dan Komputer\",\"subtitle\":\"Menciptakan generasi unggul di bidang teknologi informasi\",\"students\":\"500+\",\"lecturers\":\"25+\",\"accreditation_badge\":\"A\"}', '{\"address\":\"Jl. A.H. Nasution No.105, Cibiru, Bandung\",\"phone\":\"+62 22 1234 5678\",\"email\":\"jtik@universitas.ac.id\",\"maps_url\":\"#\",\"operational_hours\":[],\"study_programs\":[],\"accreditation\":\"A (Unggul)\"}', '{\"history\":\"-\",\"vision\":\"-\",\"missions\":[],\"achievements\":[],\"lecturers\":[],\"staff\":[]}', '2026-09-09 11:11:56', '2026-09-09 11:11:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin123', '2026-09-09 11:12:00', '2026-09-09 11:12:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mata_kuliah` varchar(255) DEFAULT NULL,
  `dosen` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `waktu_mulai` timestamp NOT NULL DEFAULT current_timestamp(),
  `waktu_berakhir` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','completed','cancelled') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `type` enum('general','report') NOT NULL DEFAULT 'general',
  `status` enum('open','resolved') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_kelas` varchar(255) DEFAULT NULL,
  `prodi` varchar(50) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `angkatan` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `username`, `password`, `nama_kelas`, `prodi`, `kelas`, `angkatan`, `created_at`, `updated_at`) VALUES
(1, 'TEKOM_A', '123456', 'Teknik Komputer Kelas A', 'TEKOM', 'A', '2023', '2026-09-09 11:12:00', '2026-09-09 11:12:00');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_24_003835_create_admin_table', 1),
(5, '2025_10_24_003906_create_kelas_table', 1),
(6, '2025_10_27_024333_create_bookings_table_fixed', 1),
(7, '2025_10_29_124729_create_rooms_table', 1),
(8, '2025_11_10_003307_create_about_jtik_table', 1),
(9, '2025_11_19_133114_create_qr_sessions_table', 1),
(10, '2025_11_27_185118_create_queues_table', 1),
(11, '2025_11_27_190218_create_comments_table', 1),
(12, '2025_12_18_182050_add_booking_indexes_to_bookings_table', 1),
(13, '2025_12_18_182735_create_telescope_entries_table', 1);

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
-- Struktur dari tabel `qr_sessions`
--

CREATE TABLE `qr_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(64) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `queues`
--

CREATE TABLE `queues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `queue_number` int(11) NOT NULL,
  `status` enum('waiting','processing','completed','cancelled') NOT NULL DEFAULT 'waiting',
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL DEFAULT 'Gedung JTIK',
  `lantai` varchar(255) NOT NULL DEFAULT '1',
  `luas` decimal(8,2) NOT NULL DEFAULT 48.00,
  `type` enum('kelas','lab','other') NOT NULL DEFAULT 'kelas',
  `status` enum('available','occupied','maintenance') NOT NULL DEFAULT 'available',
  `description` text DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `facilities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ;

--
-- Dumping data untuk tabel `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `display_name`, `location`, `lantai`, `luas`, `type`, `status`, `description`, `capacity`, `facilities`, `qr_code`, `permanent_qr_url`, `qr_content`, `created_at`, `updated_at`) VALUES
(1, 'AE 101', 'Ruangan AE 101', 'Gedung JTIK - Lantai 1', '1', '48.00', 'kelas', 'available', 'Ruang kelas reguler', 40, '[\"AC\",\"Proyektor\",\"Whiteboard\",\"WiFi\"]', 'img/qrcodes/qr-ae-101-1788960090.png', '/storage/qrcodes/qr-permanent-AE 101.svg', 'http://localhost/booking/create/AE+101', '2026-09-09 11:11:57', '2026-09-10 04:21:31'),
(2, 'AE 102', 'Ruangan AE 102', 'Gedung JTIK - Lantai 1', '1', '48.00', 'kelas', 'available', 'Ruang kelas standar', 35, '[\"AC\",\"Whiteboard\",\"WiFi\"]', 'img/qrcodes/qr-ae-102-1788960127.png', '/storage/qrcodes/qr-permanent-AE 102.svg', 'http://localhost/booking/create/AE+102', '2026-09-09 11:11:59', '2026-09-10 04:22:08'),
(3, 'AE 103', 'Ruangan AE 103', 'Gedung JTIK - Lantai 1', '1', '48.00', 'kelas', 'available', 'Ruang kelas standar', 35, '[\"AC\",\"Whiteboard\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-AE 103.svg', 'http://localhost/booking/create/AE+103', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(4, 'AE 104', 'Ruangan AE 104', 'Gedung JTIK - Lantai 1', '1', '48.00', 'kelas', 'available', 'Ruang kelas standar', 35, '[\"AC\",\"Whiteboard\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-AE 104.svg', 'http://localhost/booking/create/AE+104', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(5, 'AE 105', 'Ruangan AE 105', 'Gedung JTIK - Lantai 1', '1', '48.00', 'kelas', 'available', 'Ruang kelas standar', 35, '[\"AC\",\"Whiteboard\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-AE 105.svg', 'http://localhost/booking/create/AE+105', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(6, 'AE 106', 'Ruangan AE 106', 'Gedung JTIK - Lantai 1', '1', '48.00', 'kelas', 'available', 'Ruang kelas standar', 35, '[\"AC\",\"Whiteboard\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-AE 106.svg', 'http://localhost/booking/create/AE+106', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(7, 'AE 107', 'Ruangan AE 107', 'Gedung JTIK - Lantai 1', '1', '48.00', 'kelas', 'available', 'Ruang kelas standar', 35, '[\"AC\",\"Whiteboard\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-AE 107.svg', 'http://localhost/booking/create/AE+107', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(8, 'AE 209', 'Ruangan AE 209', 'Gedung JTIK - Lantai 2', '1', '48.00', 'kelas', 'available', 'Ruang kelas lantai 2', 40, '[\"AC\",\"Proyektor\",\"Whiteboard\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-AE 209.svg', 'http://localhost/booking/create/AE+209', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(9, 'Lab Animasi', 'Laboratorium Animasi', 'Gedung JTIK - Lantai 2', '1', '48.00', 'lab', 'available', 'Laboratorium untuk praktikum animasi dan multimedia', 30, '[\"AC\",\"Komputer\",\"Software Animasi\",\"Proyektor\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-Lab Animasi.svg', 'http://localhost/booking/create/Lab+Animasi', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(10, 'IT Workshop', 'IT Workshop', 'Gedung JTIK - Lantai 2', '1', '48.00', 'lab', 'available', 'Workshop untuk praktikum IT', 25, '[\"AC\",\"Komputer\",\"Tools IT\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-IT Workshop.svg', 'http://localhost/booking/create/IT+Workshop', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(11, 'Lab Jaringan', 'Laboratorium Jaringan', 'Gedung JTIK - Lantai 2', '1', '48.00', 'lab', 'available', 'Laboratorium jaringan komputer', 20, '[\"AC\",\"Router\",\"Switch\",\"Kabel Jaringan\",\"Tools Network\"]', NULL, '/storage/qrcodes/qr-permanent-Lab Jaringan.svg', 'http://localhost/booking/create/Lab+Jaringan', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(12, 'Lab Programing', 'Laboratorium Programming', 'Gedung JTIK - Lantai 2', '1', '48.00', 'lab', 'available', 'Laboratorium pemrograman', 30, '[\"AC\",\"Komputer\",\"Software Development\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-Lab Programing.svg', 'http://localhost/booking/create/Lab+Programing', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(13, 'Lab Sistem Cerdas', 'Laboratorium Sistem Cerdas', 'Gedung JTIK - Lantai 2', '1', '48.00', 'lab', 'available', 'Laboratorium sistem cerdas dan AI', 25, '[\"AC\",\"Komputer\",\"Software AI\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-Lab Sistem Cerdas.svg', 'http://localhost/booking/create/Lab+Sistem+Cerdas', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(14, 'Lab Embeded', 'Laboratorium Embedded', 'Gedung JTIK - Lantai 2', '1', '48.00', 'lab', 'available', 'Laboratorium sistem embedded', 20, '[\"AC\",\"Microcontroller\",\"Tools Elektronik\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-Lab Embeded.svg', 'http://localhost/booking/create/Lab+Embeded', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(15, 'Sekretariat HIMATIK', 'Sekretariat HIMATIK', 'Gedung JTIK - Lantai 2', '1', '48.00', 'other', 'available', 'Ruangan sekretariat himpunan mahasiswa teknik informatika', 15, '[\"AC\",\"Meja Kerja\",\"Kursi\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-Sekretariat HIMATIK.svg', 'http://localhost/booking/create/Sekretariat+HIMATIK', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(16, 'Ruangan Admin', 'Ruangan Administrator', 'Gedung JTIK - Lantai 2', '1', '48.00', 'other', 'available', 'Ruangan administrasi jurusan', 10, '[\"AC\",\"Meja Kerja\",\"Komputer\",\"Printer\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-Ruangan Admin.svg', 'http://localhost/booking/create/Ruangan+Admin', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(17, 'Perpustakaan', 'Perpustakaan JTIK', 'Gedung JTIK - Lantai 2', '1', '48.00', 'other', 'available', 'Perpustakaan jurusan teknik informatika', 50, '[\"AC\",\"Rak Buku\",\"Meja Baca\",\"WiFi\",\"Komputer\"]', NULL, '/storage/qrcodes/qr-permanent-Perpustakaan.svg', 'http://localhost/booking/create/Perpustakaan', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(18, 'Ruangan Sekertaris Jurusan', 'Ruangan Sekretaris Jurusan', 'Gedung JTIK - Lantai 2', '1', '48.00', 'other', 'available', 'Ruangan sekretaris jurusan', 8, '[\"AC\",\"Meja Kerja\",\"Komputer\",\"Printer\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-Ruangan Sekertaris Jurusan.svg', 'http://localhost/booking/create/Ruangan+Sekertaris+Jurusan', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(19, 'Ruangan Kepala Laboratorium', 'Ruangan Kepala Lab', 'Gedung JTIK - Lantai 2', '1', '48.00', 'other', 'available', 'Ruangan kepala laboratorium', 8, '[\"AC\",\"Meja Kerja\",\"Komputer\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-Ruangan Kepala Laboratorium.svg', 'http://localhost/booking/create/Ruangan+Kepala+Laboratorium', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(20, 'Ruangan Dosen', 'Ruangan Dosen', 'Gedung JTIK - Lantai 2', '1', '48.00', 'other', 'available', 'Ruangan dosen', 12, '[\"AC\",\"Meja Kerja\",\"Komputer\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-Ruangan Dosen.svg', 'http://localhost/booking/create/Ruangan+Dosen', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(21, 'Ruangan Ketua Prodi TEKOM', 'Ruangan Ketua Prodi TEKOM', 'Gedung JTIK - Lantai 2', '1', '48.00', 'other', 'available', 'Ruangan ketua program studi teknik komputer', 8, '[\"AC\",\"Meja Kerja\",\"Komputer\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-Ruangan Ketua Prodi TEKOM.svg', 'http://localhost/booking/create/Ruangan+Ketua+Prodi+TEKOM', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(22, 'Ruangan Ujian', 'Ruangan Ujian', 'Gedung JTIK - Lantai 2', '1', '48.00', 'other', 'available', 'Ruangan khusus ujian', 40, '[\"AC\",\"Meja Ujian\",\"Kursi\",\"Whiteboard\"]', NULL, '/storage/qrcodes/qr-permanent-Ruangan Ujian.svg', 'http://localhost/booking/create/Ruangan+Ujian', '2026-09-09 11:11:59', '2026-09-09 11:11:59'),
(23, 'Ruangan Ketua Prodi PTIK', 'Ruangan Ketua Prodi PTIK', 'Gedung JTIK - Lantai 2', '1', '48.00', 'other', 'available', 'Ruangan ketua program studi pendidikan teknik informatika', 8, '[\"AC\",\"Meja Kerja\",\"Komputer\",\"WiFi\"]', NULL, '/storage/qrcodes/qr-permanent-Ruangan Ketua Prodi PTIK.svg', 'http://localhost/booking/create/Ruangan+Ketua+Prodi+PTIK', '2026-09-09 11:12:00', '2026-09-09 11:12:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `telescope_entries`
--

CREATE TABLE `telescope_entries` (
  `sequence` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `batch_id` char(36) NOT NULL,
  `family_hash` varchar(255) DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(20) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `telescope_entries_tags`
--

CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `telescope_monitoring`
--

CREATE TABLE `telescope_monitoring` (
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username_unique` (`username`);

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_room_name_status_index` (`room_name`,`status`),
  ADD KEY `bookings_waktu_mulai_waktu_berakhir_index` (`waktu_mulai`,`waktu_berakhir`),
  ADD KEY `idx_booking_availability` (`room_name`,`status`,`waktu_berakhir`),
  ADD KEY `idx_user_bookings` (`username`,`status`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_kelas_id_foreign` (`kelas_id`),
  ADD KEY `comments_room_id_type_index` (`room_id`,`type`),
  ADD KEY `comments_status_index` (`status`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kelas_username_unique` (`username`);

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
-- Indeks untuk tabel `qr_sessions`
--
ALTER TABLE `qr_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `qr_sessions_token_unique` (`token`);

--
-- Indeks untuk tabel `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `queues_kelas_id_foreign` (`kelas_id`),
  ADD KEY `queues_room_id_status_index` (`room_id`,`status`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `telescope_entries`
--
ALTER TABLE `telescope_entries`
  ADD PRIMARY KEY (`sequence`),
  ADD UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  ADD KEY `telescope_entries_batch_id_index` (`batch_id`),
  ADD KEY `telescope_entries_family_hash_index` (`family_hash`),
  ADD KEY `telescope_entries_created_at_index` (`created_at`),
  ADD KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`);

--
-- Indeks untuk tabel `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD PRIMARY KEY (`entry_uuid`,`tag`),
  ADD KEY `telescope_entries_tags_tag_index` (`tag`);

--
-- Indeks untuk tabel `telescope_monitoring`
--
ALTER TABLE `telescope_monitoring`
  ADD PRIMARY KEY (`tag`);

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
-- AUTO_INCREMENT untuk tabel `about_jtik`
--
ALTER TABLE `about_jtik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `qr_sessions`
--
ALTER TABLE `qr_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `queues`
--
ALTER TABLE `queues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `telescope_entries`
--
ALTER TABLE `telescope_entries`
  MODIFY `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `queues`
--
ALTER TABLE `queues`
  ADD CONSTRAINT `queues_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `queues_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
