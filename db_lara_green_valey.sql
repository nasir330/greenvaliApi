-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 25, 2023 at 03:39 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lara_green_valey`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_11_160527_create_ventures_table', 1),
(6, '2023_05_17_170607_create_venture_plots_table', 1),
(7, '2023_05_18_121101_create_customers_table', 1),
(8, '2023_05_18_121450_create_staff_table', 1),
(9, '2023_05_31_131742_create_user_roles_table', 1),
(10, '2023_05_31_131941_alter_users_table', 1),
(11, '2023_06_03_130907_create_user_infos_table', 1),
(12, '2023_06_03_131717_add_active_status_to_users_table', 1),
(13, '2023_06_04_153837_add_booking_status_to_venture_plots_table', 1),
(20, '2023_06_05_202753_add_column_to_ventures_table', 2),
(21, '2023_06_11_114743_create_venture_plot_images_table', 2),
(22, '2023_06_14_120144_create_schedules_table', 2),
(25, '2023_06_25_122715_create_sliders_table', 3),
(26, '2023_06_25_163513_create_social_links_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'admin@mail.com', 'f145a1045a356febd25d50f5f8a274f63c26730f8b774f13c75aaadae3d05174', '[\"*\"]', '2023-06-06 07:46:08', NULL, '2023-06-06 07:37:03', '2023-06-06 07:46:08'),
(5, 'App\\Models\\User', 2, 'customer@mail.com', '99717954a32858dfcccd93c80b670119adfb9a4949f2a1852b4fee1cb8a31bf8', '[\"*\"]', '2023-06-14 06:58:29', NULL, '2023-06-14 06:20:01', '2023-06-14 06:58:29'),
(6, 'App\\Models\\User', 2, 'customer@mail.com', '05723875a1468ed917f80b70eb079afb84f2b72f4912eaf05b77991de8b369f1', '[\"*\"]', '2023-06-18 05:57:02', NULL, '2023-06-18 05:50:44', '2023-06-18 05:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `venture_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `schedule_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_time` time NOT NULL,
  `schedule_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `venture_id`, `user_id`, `schedule_title`, `schedule_date`, `schedule_time`, `schedule_description`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Schedule for Test Venture One', '2023-06-14', '18:14:00', 'Your appointment on 2023-06-14 at 18:14 with so and so person for Test Venture One', '2023-06-14 06:54:23', '2023-06-14 06:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `created_at`, `updated_at`) VALUES
(2, '/slider/Xoh75_034818.png', '2023-06-25 09:48:18', '2023-06-25 09:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `name`, `url`, `created_at`, `updated_at`) VALUES
(1, 'facebook', NULL, '2023-06-25 10:44:47', '2023-06-25 11:22:39'),
(2, 'linkedin', 'https://www.mantri.in', '2023-06-25 10:44:47', '2023-06-25 11:22:39'),
(3, 'twitter', NULL, '2023-06-25 10:44:47', '2023-06-25 11:22:39'),
(4, 'vimeo', 'https://www.youtube.com/', '2023-06-25 10:44:47', '2023-06-25 11:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint UNSIGNED NOT NULL,
  `staff_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_address` text COLLATE utf8mb4_unicode_ci,
  `staff_start_date` date DEFAULT NULL,
  `staff_end_date` date DEFAULT NULL,
  `staff_active_status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL DEFAULT '3',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `active_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'User', 'admin@mail.com', NULL, '$2y$10$MCObQ4W/b2LsDURd6U2id.SzPl4nbYCToHOfmLbCHh5yEl75WBgDS', 1, NULL, '2023-06-05 14:23:03', '2023-06-05 14:23:03'),
(2, 3, 'customer', 'user', 'customer@mail.com', NULL, '$2y$10$AyyV86eKY49Nz8tPH/4fdeCKSat.0v5Kuj7HxHK1V.oPrGE1hgZqK', 1, NULL, '2023-06-06 14:23:33', '2023-06-06 14:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_infos`
--

CREATE TABLE `user_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_infos`
--

INSERT INTO `user_infos` (`id`, `user_id`, `phone`, `address`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 1, '8555555555555', 'Dhaka, Bangladesh', NULL, NULL, '2023-06-05 14:23:03', '2023-06-05 14:23:03'),
(2, 2, '1234567', NULL, NULL, NULL, '2023-06-06 14:23:33', '2023-06-06 14:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '2023-06-05 14:23:03', '2023-06-05 14:23:03'),
(2, 'Employee', 'employee', '2023-06-05 14:23:03', '2023-06-05 14:23:03'),
(3, 'Customer', 'customer', '2023-06-05 14:23:03', '2023-06-05 14:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `ventures`
--

CREATE TABLE `ventures` (
  `id` bigint UNSIGNED NOT NULL,
  `venture_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `venture_name_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `venture_description` text COLLATE utf8mb4_unicode_ci,
  `number_of_plot` int NOT NULL,
  `per_square_feet_price` double(8,2) NOT NULL,
  `venture_brochure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venture_layout` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highlights` longtext COLLATE utf8mb4_unicode_ci,
  `near_by_infos` longtext COLLATE utf8mb4_unicode_ci,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `active_status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ventures`
--

INSERT INTO `ventures` (`id`, `venture_name`, `venture_name_slug`, `venture_description`, `number_of_plot`, `per_square_feet_price`, `venture_brochure`, `venture_layout`, `highlights`, `near_by_infos`, `latitude`, `longitude`, `active_status`, `created_at`, `updated_at`) VALUES
(1, 'Test Venture One', 'test-venture-one', 'ass', 15, 1700.00, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-06-06 05:49:04', '2023-06-06 14:18:30'),
(4, 'Test Venture', 'test-venture', 'ass', 20, 1700.00, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-06-06 07:32:35', '2023-06-06 14:16:54'),
(5, 'Test Venture 03', 'test-venture-03', NULL, 20, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-06-06 13:08:57', '2023-06-06 13:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `venture_plots`
--

CREATE TABLE `venture_plots` (
  `id` bigint UNSIGNED NOT NULL,
  `venture_id` bigint UNSIGNED NOT NULL COMMENT 'FK of table:ventures',
  `plot_id` int NOT NULL,
  `plot_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_square_feet` double(8,2) DEFAULT NULL,
  `total_price` double(8,2) DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `staff_id` bigint UNSIGNED DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `handover_date` date DEFAULT NULL,
  `plot_status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venture_plots`
--

INSERT INTO `venture_plots` (`id`, `venture_id`, `plot_id`, `plot_name`, `number_of_square_feet`, `total_price`, `customer_id`, `staff_id`, `sale_date`, `handover_date`, `plot_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Test Venture- Plot Id -1', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(2, 1, 2, 'Test Venture- Plot Id -2', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(3, 1, 3, 'Test Venture- Plot Id -3', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(4, 1, 4, 'Test Venture- Plot Id -4', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(5, 1, 5, 'Test Venture- Plot Id -5', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(6, 1, 6, 'Test Venture- Plot Id -6', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(7, 1, 7, 'Test Venture- Plot Id -7', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(8, 1, 8, 'Test Venture- Plot Id -8', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(9, 1, 9, 'Test Venture- Plot Id -9', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(10, 1, 10, 'Test Venture- Plot Id -10', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(11, 1, 11, 'Test Venture- Plot Id -11', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(12, 1, 12, 'Test Venture- Plot Id -12', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(13, 1, 13, 'Test Venture- Plot Id -13', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(14, 1, 14, 'Test Venture- Plot Id -14', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(15, 1, 15, 'Test Venture- Plot Id -15', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 05:49:04', '2023-06-06 05:49:04'),
(16, 2, 1, 'Test Ven- Plot Id -1', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(17, 2, 2, 'Test Ven- Plot Id -2', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(18, 2, 3, 'Test Ven- Plot Id -3', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(19, 2, 4, 'Test Ven- Plot Id -4', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(20, 2, 5, 'Test Ven- Plot Id -5', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(21, 2, 6, 'Test Ven- Plot Id -6', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(22, 2, 7, 'Test Ven- Plot Id -7', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(23, 2, 8, 'Test Ven- Plot Id -8', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(24, 2, 9, 'Test Ven- Plot Id -9', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(25, 2, 10, 'Test Ven- Plot Id -10', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(26, 2, 11, 'Test Ven- Plot Id -11', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(27, 2, 12, 'Test Ven- Plot Id -12', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(28, 2, 13, 'Test Ven- Plot Id -13', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(29, 2, 14, 'Test Ven- Plot Id -14', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(30, 2, 15, 'Test Ven- Plot Id -15', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(31, 2, 16, 'Test Ven- Plot Id -16', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(32, 2, 17, 'Test Ven- Plot Id -17', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(33, 2, 18, 'Test Ven- Plot Id -18', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(34, 2, 19, 'Test Ven- Plot Id -19', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(35, 2, 20, 'Test Ven- Plot Id -20', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:41:15', '2023-06-06 06:41:15'),
(36, 3, 1, 'aa- Plot Id -1', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(37, 3, 2, 'aa- Plot Id -2', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(38, 3, 3, 'aa- Plot Id -3', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(39, 3, 4, 'aa- Plot Id -4', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(40, 3, 5, 'aa- Plot Id -5', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(41, 3, 6, 'aa- Plot Id -6', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(42, 3, 7, 'aa- Plot Id -7', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(43, 3, 8, 'aa- Plot Id -8', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(44, 3, 9, 'aa- Plot Id -9', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(45, 3, 10, 'aa- Plot Id -10', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(46, 3, 11, 'aa- Plot Id -11', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(47, 3, 12, 'aa- Plot Id -12', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(48, 3, 13, 'aa- Plot Id -13', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(49, 3, 14, 'aa- Plot Id -14', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(50, 3, 15, 'aa- Plot Id -15', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(51, 3, 16, 'aa- Plot Id -16', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(52, 3, 17, 'aa- Plot Id -17', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(53, 3, 18, 'aa- Plot Id -18', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(54, 3, 19, 'aa- Plot Id -19', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(55, 3, 20, 'aa- Plot Id -20', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 06:44:32', '2023-06-06 06:44:32'),
(56, 4, 1, 'ass- Plot Id -1', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(57, 4, 2, 'ass- Plot Id -2', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(58, 4, 3, 'ass- Plot Id -3', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(59, 4, 4, 'ass- Plot Id -4', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(60, 4, 5, 'ass- Plot Id -5', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(61, 4, 6, 'ass- Plot Id -6', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(62, 4, 7, 'ass- Plot Id -7', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(63, 4, 8, 'ass- Plot Id -8', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(64, 4, 9, 'ass- Plot Id -9', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(65, 4, 10, 'ass- Plot Id -10', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(66, 4, 11, 'ass- Plot Id -11', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(67, 4, 12, 'ass- Plot Id -12', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(68, 4, 13, 'ass- Plot Id -13', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(69, 4, 14, 'ass- Plot Id -14', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(70, 4, 15, 'ass- Plot Id -15', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(71, 4, 16, 'ass- Plot Id -16', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(72, 4, 17, 'ass- Plot Id -17', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(73, 4, 18, 'ass- Plot Id -18', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(74, 4, 19, 'ass- Plot Id -19', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(75, 4, 20, 'ass- Plot Id -20', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 07:32:35', '2023-06-06 07:32:35'),
(76, 5, 1, 'Test Venture 02- Plot Id -1', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(77, 5, 2, 'Test Venture 02- Plot Id -2', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(78, 5, 3, 'Test Venture 02- Plot Id -3', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(79, 5, 4, 'Test Venture 02- Plot Id -4', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(80, 5, 5, 'Test Venture 02- Plot Id -5', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(81, 5, 6, 'Test Venture 02- Plot Id -6', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(82, 5, 7, 'Test Venture 02- Plot Id -7', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(83, 5, 8, 'Test Venture 02- Plot Id -8', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(84, 5, 9, 'Test Venture 02- Plot Id -9', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(85, 5, 10, 'Test Venture 02- Plot Id -10', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(86, 5, 11, 'Test Venture 02- Plot Id -11', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(87, 5, 12, 'Test Venture 02- Plot Id -12', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(88, 5, 13, 'Test Venture 02- Plot Id -13', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(89, 5, 14, 'Test Venture 02- Plot Id -14', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(90, 5, 15, 'Test Venture 02- Plot Id -15', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(91, 5, 16, 'Test Venture 02- Plot Id -16', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(92, 5, 17, 'Test Venture 02- Plot Id -17', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(93, 5, 18, 'Test Venture 02- Plot Id -18', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(94, 5, 19, 'Test Venture 02- Plot Id -19', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57'),
(95, 5, 20, 'Test Venture 02- Plot Id -20', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-06-06 13:08:57', '2023-06-06 13:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `venture_plot_images`
--

CREATE TABLE `venture_plot_images` (
  `id` bigint UNSIGNED NOT NULL,
  `venture_id` bigint UNSIGNED NOT NULL,
  `venture_plot_id` bigint UNSIGNED NOT NULL,
  `plot_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venture_plot_images`
--

INSERT INTO `venture_plot_images` (`id`, `venture_id`, `venture_plot_id`, `plot_image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '/venture-plot/_TnDpc_041354.jpg', '2023-06-25 10:13:54', '2023-06-25 10:13:54'),
(2, 1, 1, '/venture-plot/_kW8aC_041408.png', '2023-06-25 10:14:08', '2023-06-25 10:14:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_customer_phone_unique` (`customer_phone`);

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
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_venture_id_foreign` (`venture_id`),
  ADD KEY `schedules_user_id_foreign` (`user_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_staff_phone_unique` (`staff_phone`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_infos_phone_unique` (`phone`),
  ADD KEY `user_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ventures`
--
ALTER TABLE `ventures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ventures_venture_name_slug_unique` (`venture_name_slug`);

--
-- Indexes for table `venture_plots`
--
ALTER TABLE `venture_plots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venture_plots_customer_id_foreign` (`customer_id`),
  ADD KEY `venture_plots_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `venture_plot_images`
--
ALTER TABLE `venture_plot_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venture_plot_images_venture_id_foreign` (`venture_id`),
  ADD KEY `venture_plot_images_venture_plot_id_foreign` (`venture_plot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_infos`
--
ALTER TABLE `user_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ventures`
--
ALTER TABLE `ventures`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `venture_plots`
--
ALTER TABLE `venture_plots`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `venture_plot_images`
--
ALTER TABLE `venture_plot_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `schedules_venture_id_foreign` FOREIGN KEY (`venture_id`) REFERENCES `ventures` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`);

--
-- Constraints for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD CONSTRAINT `user_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `venture_plots`
--
ALTER TABLE `venture_plots`
  ADD CONSTRAINT `venture_plots_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `venture_plots_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `venture_plot_images`
--
ALTER TABLE `venture_plot_images`
  ADD CONSTRAINT `venture_plot_images_venture_id_foreign` FOREIGN KEY (`venture_id`) REFERENCES `ventures` (`id`),
  ADD CONSTRAINT `venture_plot_images_venture_plot_id_foreign` FOREIGN KEY (`venture_plot_id`) REFERENCES `venture_plots` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
