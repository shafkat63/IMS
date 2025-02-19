-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 01:36 PM
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
-- Database: `bchemical`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bin_number` varchar(255) NOT NULL,
  `tin_number` varchar(255) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `bin_number`, `tin_number`, `status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Brac Bank Update', 'Something', '1315', 'active', '20', '2025-01-28 05:22:53', '20', '2025-01-28 06:06:22'),
(10, 'Sonali Bank', '323', '234234', 'active', '20', '2025-01-29 00:22:18', NULL, '2025-01-29 06:22:18'),
(12, 'AB Bank PLC', '666', '909', 'active', '20', '2025-02-05 01:00:38', NULL, '2025-02-05 07:00:39'),
(13, 'Bangladesh Commerce Bank Limited', '742', '950', 'active', '20', '2025-02-05 01:02:12', NULL, '2025-02-05 07:02:12'),
(14, 'Bank Asia PLC', '742', '33', 'active', '20', '2025-02-05 01:02:28', NULL, '2025-02-05 07:02:28'),
(15, 'City Bank PLC', '316', '46', 'inactive', '20', '2025-02-05 01:03:22', NULL, '2025-02-05 07:03:22'),
(16, 'Dhaka Bank PLC', '23424', '424234', 'active', '20', '2025-02-05 01:06:12', NULL, '2025-02-05 07:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `bank_branches`
--

CREATE TABLE `bank_branches` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `routing_number` varchar(50) NOT NULL,
  `swift_code` varchar(50) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` int(11) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_branches`
--

INSERT INTO `bank_branches` (`id`, `bank_name`, `routing_number`, `swift_code`, `branch_name`, `contact_number`, `contact_person_name`, `email`, `status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Reagan Smith', '875', 'Sunt ut laborum aspe', 'Briar Whitaker', '604', 'Anastasia Lynch', 'fumilole@mailinator.com', 'active', 20, '2025-01-29 01:39:56', 20, '2025-01-29 01:44:47'),
(2, 'Brac Bank', '858', 'Sunt ut laborum aspe', 'Regina Burks', '188', 'Jahanara', 'test@gmail.com', 'active', 20, '2025-01-29 01:45:11', 20, '2025-01-29 01:46:12'),
(4, '10', '53g', 'gdgd', '435345', '35435', '35435', 'msm.shafkat@gmail.com', 'active', 20, '2025-01-29 02:00:55', 20, '2025-01-29 02:06:11'),
(5, '1', 'ydty', 'utyut', '743645', 'hfdu5674', '547rthf', 'superadmin@innogas.com', 'active', 20, '2025-01-29 02:09:00', NULL, '2025-01-29 08:09:00'),
(6, '14', '475', 'Qui esse ad vel in', 'Khilgoan', '239', 'Kitra Wells', 'peletob@mailinator.com', 'active', 20, '2025-02-05 01:04:13', NULL, '2025-02-05 07:04:13'),
(7, '13', '435', '5345345', 'Shantinagor', '43242343', '3423423', 'fdsfdsfdmin@gmail.com', 'active', 20, '2025-02-05 01:07:51', NULL, '2025-02-05 07:07:51'),
(8, '14', '662', 'Culpa irure volupta', 'Cheryl Merrill', '712', 'Benedict Kline', 'navo@mailinator.com', 'active', 20, '2025-02-05 01:08:02', NULL, '2025-02-05 07:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(2, 'Clothes', 'active', '20', '2025-01-29 05:58:06', '20', '2025-02-03 03:13:45'),
(3, 'Furniture', 'active', '20', '2025-02-05 01:46:36', NULL, NULL),
(6, 'Electronics', 'active', '20', '2025-02-05 01:47:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'Red', 'active', '20', '2025-01-29 05:11:59', NULL, NULL),
(3, 'Green', 'active', '20', '2025-01-29 05:17:20', NULL, NULL),
(4, 'Blue', 'active', '20', '2025-02-05 01:57:04', NULL, NULL),
(5, 'Purple', 'active', '20', '2025-02-05 01:57:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` int(11) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Bangladesh', 'active', 20, '2025-01-29 00:19:21', NULL, '2025-01-29 06:19:21'),
(3, 'Russia', 'active', 20, '2025-01-29 00:21:35', NULL, '2025-01-29 06:21:35'),
(4, 'Iran', 'active', 20, '2025-01-29 00:55:05', NULL, '2025-01-29 06:55:05'),
(5, 'USA', 'active', 20, '2025-02-05 00:49:36', NULL, '2025-02-05 06:49:36'),
(8, 'Armenia', 'active', 20, '2025-02-05 00:54:14', NULL, '2025-02-05 06:54:14'),
(9, 'Austria', 'active', 20, '2025-02-05 00:55:26', NULL, '2025-02-05 06:55:26'),
(10, 'Mauritania', 'active', 20, '2025-02-05 00:55:36', NULL, '2025-02-05 06:55:36'),
(11, 'Monaco', 'active', 20, '2025-02-05 00:55:57', NULL, '2025-02-05 06:55:57'),
(12, 'Moldova', 'active', 20, '2025-02-05 00:56:14', NULL, '2025-02-05 06:56:14'),
(13, 'Test', 'active', 20, '2025-02-09 00:02:51', NULL, '2025-02-09 06:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'BDT', 'active', '20', '2025-01-29 05:37:48', '20', '2025-01-29 05:38:12'),
(3, 'USD', 'active', '20', '2025-02-08 03:10:19', NULL, NULL),
(4, 'YEN', 'active', '20', '2025-02-08 03:10:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bin_number` varchar(50) NOT NULL,
  `tin_number` varchar(50) NOT NULL,
  `vat_registration_number` varchar(50) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `irc_number` varchar(20) NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `country_name`, `address`, `mobile_number`, `email`, `bin_number`, `tin_number`, `vat_registration_number`, `national_id`, `irc_number`, `remarks`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'Rakib', '1', 'dsad', '42342', 'rakib@gmail.com', '4234', '3424', '4234', '463463', '423423', 'MUFTI', 'active', '20', '2025-02-03 06:12:40', '20', '2025-02-03 06:37:03'),
(3, 'Vivian Brock', '11', 'Perspiciatis dicta', '536', 'gonijap@mailinator.com', '828', '788', '707', 'Dicta non et esse te', '914', 'Dolor enim ab magna', 'active', '20', '2025-02-05 08:03:35', NULL, NULL),
(4, 'Chase Wall', '8', 'Eveniet eaque et ad', '548', 'qurona@mailinator.com', '421', '925', '445', 'Quo dignissimos simi', '689', 'Neque possimus in c', 'active', '20', '2025-02-09 06:15:22', NULL, NULL),
(5, 'Lunea Kim', '11', 'Lorem Ipsum i', '838', 'siworub@mailinator.com', '327', '314', '521', 'Id nostrum sunt erro', '660', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected', 'active', '20', '2025-02-09 06:19:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_inquiries`
--

CREATE TABLE `customer_inquiries` (
  `id` int(11) NOT NULL,
  `inquiry_date` date NOT NULL,
  `system_generated_inquiry_number` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `inquiry_account_manager` varchar(255) DEFAULT NULL,
  `shipment_mode_id` varchar(50) DEFAULT NULL,
  `expected_arrival_date` date DEFAULT NULL,
  `payment_term` varchar(100) DEFAULT NULL,
  `inquiry_validity` int(11) DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `authorization_status` enum('Yes','No') DEFAULT 'No',
  `sample_needed` enum('Yes','No') DEFAULT 'No',
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_inquiries`
--

INSERT INTO `customer_inquiries` (`id`, `inquiry_date`, `system_generated_inquiry_number`, `customer_id`, `inquiry_account_manager`, `shipment_mode_id`, `expected_arrival_date`, `payment_term`, `inquiry_validity`, `remarks`, `authorization_status`, `sample_needed`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(4, '2025-02-11', ' $request->system_generated_inquiry_number', '3', 'esf', '2', '2025-02-21', 'advance', 45, 'ddljsandjsand', 'No', 'Yes', 'active', '20', '2025-02-11 04:24:25', NULL, NULL),
(6, '2000-06-30', '20000630-00-0-VJU', '4', 'Nihil iusto reprehen', '2', '1993-04-02', 'Harum officia aut et', 6, 'Nihil delectus illo', 'No', 'Yes', 'active', '20', '2025-02-11 04:28:53', NULL, NULL),
(7, '1992-10-19', '19921019-3-1-NMX', '3', 'Esse ut ut delectus', '1', '1991-01-10', 'Aut incididunt non v', 3, 'Cupiditate veritatis', 'No', '', 'active', '20', '2025-02-12 05:46:43', NULL, NULL),
(8, '2025-02-13', '20250213-00-0-S88', '1', 'asasd', '1', '2025-02-13', 'asd', 222, 'asdasdasdadad', 'No', '', 'active', '20', '2025-02-13 04:03:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_inquiry_details`
--

CREATE TABLE `customer_inquiry_details` (
  `id` int(11) NOT NULL,
  `inquiry_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `import_country_hs_code` varchar(20) NOT NULL,
  `export_country_hs_code` varchar(20) NOT NULL,
  `item_spec` varchar(255) DEFAULT NULL,
  `mode_of_unit_id` varchar(50) NOT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `country_of_origin` varchar(100) DEFAULT NULL,
  `packing_size` varchar(100) DEFAULT NULL,
  `currency_id` varchar(60) NOT NULL,
  `item_quantity` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_inquiry_details`
--

INSERT INTO `customer_inquiry_details` (`id`, `inquiry_id`, `product_name`, `import_country_hs_code`, `export_country_hs_code`, `item_spec`, `mode_of_unit_id`, `manufacturer`, `country_of_origin`, `packing_size`, `currency_id`, `item_quantity`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(3, '4', '8', 'Occaecat corrupti v', 'Qui assumenda ut aut', 'Sequi iusto nostrum', '1', '2', '10', 'Nostrud dignissimos', '1', '65', NULL, '20', '2025-02-11 04:24:25', NULL, NULL),
(4, '6', '4', 'Harum soluta est eni', 'Eligendi eos non sus', 'Deserunt qui quis co', '1', '2', '4', 'Voluptatem In enim', '3', '470', NULL, '20', '2025-02-11 04:28:53', NULL, NULL),
(5, '7', '4', 'Harum soluta est eni', 'Eligendi eos non sus', 'Corrupti nostrud ar', '1', '2', '12', 'Ex reprehenderit iu', '4', '567', NULL, '20', '2025-02-12 05:46:43', NULL, NULL),
(6, '7', '11', 'Corporis recusandae', 'In in omnis nisi cul', 'Dolorum molestiae to', '5', '2', '4', 'Laborum Laboris ven', '1', '445', NULL, '20', '2025-02-12 05:46:43', NULL, NULL),
(7, '7', '10', 'Voluptatem Vel quo', 'Dolore et sunt repre', 'Molestias magni aliq', '1', '2', '12', 'Magni non hic veniam', '1', '416', NULL, '20', '2025-02-12 05:46:43', NULL, NULL),
(8, '8', '11', 'Corporis recusandae', 'In in omnis nisi cul', 'Ipsum delectus quia', '5', '2', '4', '22', '1', '22', NULL, '20', '2025-02-13 04:03:14', NULL, NULL);

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
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` varchar(30) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `country_id`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(2, 'Kerman', '4', 'active', '20', '2025-01-30 04:19:59', '20', '2025-01-30 04:24:39'),
(3, 'RGF', '1', 'active', '20', '2025-02-18 01:35:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` varchar(255) DEFAULT '#',
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT '#',
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `title`, `icon`, `url`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, '#', 'Dashboard', 'aaa', '/admin', 'A', '', '2025-02-19 05:56:03', NULL, '2025-02-19 06:08:27'),
(2, '#', 'Roles & Permissions', 'aaa', '#', 'A', '', '2025-02-19 05:56:03', NULL, '2025-02-19 06:08:32'),
(3, '2', 'Role', 'aaa', 'role', 'A', '', '2025-02-19 05:56:03', NULL, '2025-02-19 06:03:31'),
(4, '2', 'Permissions', 'permissions', 'Permission', 'A', '', '2025-02-19 05:56:03', NULL, '2025-02-19 12:34:38'),
(9, '#', 'Basic Setup', '#', '#', 'active', '23', '2025-02-19 01:10:56', '23', '2025-02-19 01:54:21'),
(10, '#', 'Test', '#', '#', 'active', '23', '2025-02-19 01:54:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_assign`
--

CREATE TABLE `menu_assign` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `role_id` varchar(255) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'A',
  `create_by` varchar(20) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(20) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_assign`
--

INSERT INTO `menu_assign` (`id`, `menu`, `role_id`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(7, '1', '2', 'A', '23', '2025-02-19 04:06:36', NULL, NULL),
(8, '2', '2', 'A', '23', '2025-02-19 04:06:36', NULL, NULL),
(27, '4', '6', '1', '23', '2025-02-19 06:02:28', NULL, NULL),
(28, '2', '6', '1', '23', '2025-02-19 06:02:28', NULL, NULL),
(29, '10', '6', '1', '23', '2025-02-19 06:02:28', NULL, NULL),
(30, '1', '5', '1', '23', '2025-02-19 06:02:44', NULL, NULL),
(31, '2', '5', '1', '23', '2025-02-19 06:02:44', NULL, NULL),
(32, '10', '5', '1', '23', '2025-02-19 06:02:44', NULL, NULL);

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
(5, '2024_04_23_071651_create_divisions_table', 1),
(6, '2024_05_06_115944_create_districts_table', 1),
(7, '2024_05_27_045516_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 23),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 21),
(6, 'App\\Models\\User', 22);

-- --------------------------------------------------------

--
-- Table structure for table `mode_of_units`
--

CREATE TABLE `mode_of_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mode_of_units`
--

INSERT INTO `mode_of_units` (`id`, `unit_name`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'KG', 'active', '20', '2025-01-29 04:35:48', '20', '2025-02-05 01:55:00'),
(5, 'Pound', 'active', '20', '2025-02-05 01:55:10', NULL, '2025-02-05 07:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `organization_logo` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) NOT NULL,
  `tin_number` varchar(20) NOT NULL,
  `bin_number` varchar(20) NOT NULL,
  `vat_registration_number` varchar(20) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `contact_person_1` varchar(255) NOT NULL,
  `contact_person_2` varchar(255) DEFAULT NULL,
  `contact_number_1` varchar(20) NOT NULL,
  `contact_number_2` varchar(20) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `web_address` varchar(255) DEFAULT NULL,
  `mobile_wallet_number` varchar(20) DEFAULT NULL,
  `erc_number` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `organization_logo`, `organization_name`, `tin_number`, `bin_number`, `vat_registration_number`, `national_id`, `address_1`, `address_2`, `contact_person_1`, `contact_person_2`, `contact_number_1`, `contact_number_2`, `email_address`, `web_address`, `mobile_wallet_number`, `erc_number`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'ALLImages/OrganizationLogos/TUWEezTLhBadWPE.jpg', 'Carpenter and Estes Traders', '777', '894', '486', 'Eius nobis magni nos', '79 Rocky Clarendon Road', 'Dignissimos illo lab', 'Atque illum sed sun', 'Incididunt ut labori', '372', '89', 'telicavax@mailinator.com', 'In optio tempor dol', '704999', '487', 'active', '20', '2025-02-02 01:10:18', '20', '2025-02-02 01:44:03'),
(3, NULL, 'Castaneda Ramsey Traders', '975', '664', '130', 'Eu aliquam harum in', '192 East Rocky Nobel Lane', 'Culpa est error exp', 'Excepteur dolorem do', 'Error aut nulla exer', '425', '595', 'wiquxod@mailinator.com', 'Proident corporis m', '928', '50', 'active', '20', '2025-02-02 01:14:43', NULL, NULL),
(6, 'ALLImages/OrganizationLogos/sCBPXP9B3tGR9rf.jpg', 'Becker and Dalton Traders', '966', '827', '862', 'Ut ut excepturi susc', '547 North Cowley Court', 'Commodo rerum rerum', 'Corrupti qui nulla', 'Temporibus ut omnis', '733', '30', 'qycehosaxy@mailinator.com', 'Cupidatat sed nihil', '540', '99', 'active', '20', '2025-02-09 00:55:56', '20', '2025-02-09 00:56:11');

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
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`id`, `name`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(2, 'RECEIVED', 'active', '20', '2025-01-30 05:24:26', '20', '2025-02-05 02:12:42'),
(3, 'PENDING', 'active', '20', '2025-02-05 02:08:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create_user', 'web', '2024-05-27 05:29:46', '2024-05-27 00:24:18'),
(2, 'view_user', 'web', '2024-05-26 23:39:10', '2024-05-27 00:26:00'),
(4, 'update_user', 'web', '2024-05-27 00:26:52', '2024-05-27 00:26:52'),
(5, 'delete_user', 'web', '2024-05-27 00:27:00', '2024-05-27 00:27:00'),
(6, 'create_role', 'web', '2024-05-27 02:56:46', '2024-05-27 11:32:06'),
(7, 'view_role', 'web', '2024-05-27 02:56:55', '2024-05-27 11:32:14'),
(8, 'update_role', 'web', '2024-05-27 02:57:03', '2024-05-27 11:32:21'),
(9, 'delete_role', 'web', '2024-05-27 02:57:16', '2024-05-27 11:39:27'),
(13, 'create_permission', 'web', '2024-05-27 06:31:01', '2024-05-27 11:38:15'),
(14, 'view_permission', 'web', '2024-05-27 11:38:39', '2024-05-27 11:38:39'),
(15, 'update_permission', 'web', '2024-05-27 11:38:54', '2024-05-27 11:38:54'),
(16, 'delete_permission', 'web', '2024-05-27 11:39:40', '2024-05-27 11:39:40'),
(27, 'view_organization', 'web', '2025-02-17 06:05:32', '2025-02-17 06:05:32'),
(28, 'create_organization', 'web', '2025-02-17 06:05:32', '2025-02-17 06:05:32'),
(29, 'update_organization', 'web', '2025-02-17 06:05:32', '2025-02-17 06:05:32'),
(30, 'delete_organization', 'web', '2025-02-17 06:05:33', '2025-02-17 06:05:33'),
(31, 'view_countries', 'web', '2025-02-17 06:05:46', '2025-02-17 06:05:46'),
(32, 'create_countries', 'web', '2025-02-17 06:05:46', '2025-02-17 06:05:46'),
(33, 'update_countries', 'web', '2025-02-17 06:05:46', '2025-02-17 06:05:46'),
(34, 'delete_countries', 'web', '2025-02-17 06:05:46', '2025-02-17 06:05:46'),
(35, 'view_banks', 'web', '2025-02-17 06:06:01', '2025-02-17 06:06:01'),
(36, 'create_banks', 'web', '2025-02-17 06:06:01', '2025-02-17 06:06:01'),
(37, 'update_banks', 'web', '2025-02-17 06:06:01', '2025-02-17 06:06:01'),
(38, 'delete_banks', 'web', '2025-02-17 06:06:01', '2025-02-17 06:06:01'),
(39, 'view_bank_branches', 'web', '2025-02-17 23:53:27', '2025-02-17 23:53:27'),
(40, 'create_bank_branches', 'web', '2025-02-17 23:53:27', '2025-02-17 23:53:27'),
(41, 'update_bank_branches', 'web', '2025-02-17 23:53:27', '2025-02-17 23:53:27'),
(42, 'delete_bank_branches', 'web', '2025-02-17 23:53:27', '2025-02-17 23:53:27'),
(43, 'view_modes_of_units', 'web', '2025-02-17 23:53:48', '2025-02-17 23:53:48'),
(44, 'create_modes_of_units', 'web', '2025-02-17 23:53:48', '2025-02-17 23:53:48'),
(45, 'update_modes_of_units', 'web', '2025-02-17 23:53:48', '2025-02-17 23:53:48'),
(46, 'delete_modes_of_units', 'web', '2025-02-17 23:53:49', '2025-02-17 23:53:49'),
(47, 'view_colors', 'web', '2025-02-17 23:54:06', '2025-02-17 23:54:06'),
(48, 'create_colors', 'web', '2025-02-17 23:54:06', '2025-02-17 23:54:06'),
(49, 'update_colors', 'web', '2025-02-17 23:54:06', '2025-02-17 23:54:06'),
(50, 'delete_colors', 'web', '2025-02-17 23:54:06', '2025-02-17 23:54:06'),
(51, 'view_currencies', 'web', '2025-02-17 23:54:21', '2025-02-17 23:54:21'),
(52, 'create_currencies', 'web', '2025-02-17 23:54:21', '2025-02-17 23:54:21'),
(53, 'update_currencies', 'web', '2025-02-17 23:54:21', '2025-02-17 23:54:21'),
(54, 'delete_currencies', 'web', '2025-02-17 23:54:21', '2025-02-17 23:54:21'),
(55, 'view_product_types', 'web', '2025-02-17 23:54:32', '2025-02-17 23:54:32'),
(56, 'create_product_types', 'web', '2025-02-17 23:54:32', '2025-02-17 23:54:32'),
(57, 'update_product_types', 'web', '2025-02-17 23:54:32', '2025-02-17 23:54:32'),
(58, 'delete_product_types', 'web', '2025-02-17 23:54:32', '2025-02-17 23:54:32'),
(59, 'view_product_categories', 'web', '2025-02-17 23:54:54', '2025-02-17 23:54:54'),
(60, 'create_product_categories', 'web', '2025-02-17 23:54:54', '2025-02-17 23:54:54'),
(61, 'update_product_categories', 'web', '2025-02-17 23:54:54', '2025-02-17 23:54:54'),
(62, 'delete_product_categories', 'web', '2025-02-17 23:54:54', '2025-02-17 23:54:54'),
(63, 'view_product_sub_categories', 'web', '2025-02-17 23:55:12', '2025-02-17 23:55:12'),
(64, 'create_product_sub_categories', 'web', '2025-02-17 23:55:12', '2025-02-17 23:55:12'),
(65, 'update_product_sub_categories', 'web', '2025-02-17 23:55:12', '2025-02-17 23:55:12'),
(66, 'delete_product_sub_categories', 'web', '2025-02-17 23:55:13', '2025-02-17 23:55:13'),
(67, 'view_products', 'web', '2025-02-17 23:55:27', '2025-02-17 23:55:27'),
(68, 'create_products', 'web', '2025-02-17 23:55:27', '2025-02-17 23:55:27'),
(69, 'update_products', 'web', '2025-02-17 23:55:27', '2025-02-17 23:55:27'),
(70, 'delete_products', 'web', '2025-02-17 23:55:27', '2025-02-17 23:55:27'),
(71, 'view_manufacturers', 'web', '2025-02-17 23:56:06', '2025-02-17 23:56:06'),
(72, 'create_manufacturers', 'web', '2025-02-17 23:56:06', '2025-02-17 23:56:06'),
(73, 'update_manufacturers', 'web', '2025-02-17 23:56:06', '2025-02-17 23:56:06'),
(74, 'delete_manufacturers', 'web', '2025-02-17 23:56:06', '2025-02-17 23:56:06'),
(75, 'view_shipmentmodes', 'web', '2025-02-17 23:56:16', '2025-02-17 23:56:16'),
(76, 'create_shipmentmodes', 'web', '2025-02-17 23:56:16', '2025-02-17 23:56:16'),
(77, 'update_shipmentmodes', 'web', '2025-02-17 23:56:16', '2025-02-17 23:56:16'),
(78, 'delete_shipmentmodes', 'web', '2025-02-17 23:56:16', '2025-02-17 23:56:16'),
(79, 'view_customers', 'web', '2025-02-17 23:56:27', '2025-02-17 23:56:27'),
(80, 'create_customers', 'web', '2025-02-17 23:56:27', '2025-02-17 23:56:27'),
(81, 'update_customers', 'web', '2025-02-17 23:56:27', '2025-02-17 23:56:27'),
(82, 'delete_customers', 'web', '2025-02-17 23:56:27', '2025-02-17 23:56:27'),
(83, 'view_suppliers', 'web', '2025-02-17 23:56:38', '2025-02-17 23:56:38'),
(84, 'create_suppliers', 'web', '2025-02-17 23:56:38', '2025-02-17 23:56:38'),
(85, 'update_suppliers', 'web', '2025-02-17 23:56:38', '2025-02-17 23:56:38'),
(86, 'delete_suppliers', 'web', '2025-02-17 23:56:38', '2025-02-17 23:56:38'),
(87, 'view_payment_statuses', 'web', '2025-02-17 23:56:51', '2025-02-17 23:56:51'),
(88, 'create_payment_statuses', 'web', '2025-02-17 23:56:51', '2025-02-17 23:56:51'),
(89, 'update_payment_statuses', 'web', '2025-02-17 23:56:51', '2025-02-17 23:56:51'),
(90, 'delete_payment_statuses', 'web', '2025-02-17 23:56:51', '2025-02-17 23:56:51'),
(91, 'view_product_grades', 'web', '2025-02-17 23:57:02', '2025-02-17 23:57:02'),
(92, 'create_product_grades', 'web', '2025-02-17 23:57:02', '2025-02-17 23:57:02'),
(93, 'update_product_grades', 'web', '2025-02-17 23:57:02', '2025-02-17 23:57:02'),
(94, 'delete_product_grades', 'web', '2025-02-17 23:57:02', '2025-02-17 23:57:02'),
(95, 'view_customer_inquiry', 'web', '2025-02-17 23:57:15', '2025-02-17 23:57:15'),
(96, 'create_customer_inquiry', 'web', '2025-02-17 23:57:15', '2025-02-17 23:57:15'),
(97, 'update_customer_inquiry', 'web', '2025-02-17 23:57:15', '2025-02-17 23:57:15'),
(98, 'delete_customer_inquiry', 'web', '2025-02-17 23:57:15', '2025-02-17 23:57:15'),
(99, 'view_inquiry_to_supplier', 'web', '2025-02-17 23:57:24', '2025-02-17 23:57:24'),
(100, 'create_inquiry_to_supplier', 'web', '2025-02-17 23:57:24', '2025-02-17 23:57:24'),
(101, 'update_inquiry_to_supplier', 'web', '2025-02-17 23:57:24', '2025-02-17 23:57:24'),
(102, 'delete_inquiry_to_supplier', 'web', '2025-02-17 23:57:24', '2025-02-17 23:57:24');

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
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `mode_of_unit` varchar(50) NOT NULL,
  `part_number` varchar(50) DEFAULT NULL,
  `import_hs_code` varchar(20) DEFAULT NULL,
  `export_hs_code` varchar(20) DEFAULT NULL,
  `product_grade` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_type`, `product_category_id`, `sub_category_id`, `mode_of_unit`, `part_number`, `import_hs_code`, `export_hs_code`, `product_grade`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'Ezekiel Stephenson', '2', 2, 1, '1', '886', 'Magna rerum natus op', 'Reprehenderit laboru', '3', NULL, '20', '2025-02-03 05:06:15', NULL, NULL),
(4, 'Ila Powers', '2', 2, 1, '1', '285', 'Harum soluta est eni', 'Eligendi eos non sus', '1', NULL, '20', '2025-02-03 05:10:46', NULL, NULL),
(6, 'Burke Potter', '2', 2, 2, '1', '95', 'Elit molestiae id', 'Ea repudiandae ex ac', '3', NULL, '20', '2025-02-03 05:15:34', NULL, NULL),
(8, 'Christine Thompson', '2', 2, 1, '1', '822', 'Occaecat corrupti v', 'Qui assumenda ut aut', '3', NULL, '20', '2025-02-03 05:19:04', NULL, NULL),
(9, 'Christine Thompson', '2', 2, 1, '1', '822', 'Occaecat corrupti v', 'Qui assumenda ut aut', '3', NULL, '20', '2025-02-03 05:20:07', NULL, NULL),
(10, 'Paki Schneider', '2', 2, 2, '1', '898', 'Voluptatem Vel quo', 'Dolore et sunt repre', '1', NULL, '20', '2025-02-04 04:00:57', NULL, NULL),
(11, 'Hu Sharpe', '4', 6, 2, '5', '86', 'Corporis recusandae', 'In in omnis nisi cul', '5', NULL, '20', '2025-02-10 06:00:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `spec` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `color`, `spec`, `image_path`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 9, '1', 'Voluptas ullamco eos', NULL, NULL, '20', '2025-02-03 05:20:07', NULL, NULL),
(6, 11, '3', 'Aspernatur reprehend', NULL, NULL, '20', '2025-02-10 06:00:23', NULL, NULL),
(7, 11, '4', 'Explicabo Optio si', NULL, NULL, '20', '2025-02-10 06:00:23', NULL, NULL),
(8, 11, '1', 'Ipsum delectus quia', NULL, NULL, '20', '2025-02-10 06:00:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_grade`
--

CREATE TABLE `product_grade` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_grade`
--

INSERT INTO `product_grade` (`id`, `name`, `remarks`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'Test Update', 'dsd update', 'active', '20', '2025-01-30 05:41:04', '20', '2025-01-30 05:44:14'),
(4, 'Grade A', 'Almost best quality', 'active', '20', '2025-02-05 03:12:24', '20', '2025-02-05 03:12:37'),
(5, 'Grade S', 'Best Quality', 'active', '20', '2025-02-05 03:12:54', NULL, NULL),
(6, 'Grade B', 'Ok Product', 'active', '20', '2025-02-08 01:44:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_categories`
--

CREATE TABLE `product_sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_categories_id` varchar(30) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sub_categories`
--

INSERT INTO `product_sub_categories` (`id`, `name`, `product_categories_id`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'T-shirts', '2', 'active', '20', '2025-01-30 01:11:25', NULL, NULL),
(2, 'Shirts', '2', 'active', '20', '2025-01-30 02:56:41', '20', '2025-01-30 02:57:00'),
(3, 'Pants', '2', 'active', '20', '2025-01-30 03:17:53', NULL, NULL),
(4, 'Chair', '3', 'active', '20', '2025-02-05 01:52:14', '20', '2025-02-05 01:52:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `alias`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(2, 'Machineries', 'MH', 'active', '20', '2025-02-03 01:22:37', '20', '2025-02-05 00:34:57'),
(3, 'Service products', 'SP', 'active', '20', '2025-02-05 01:45:21', NULL, NULL),
(4, 'Test', 'T', 'active', '20', '2025-02-09 00:35:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2025-02-18 10:53:16', NULL),
(2, 'Admin', 'web', '2024-05-27 00:11:46', '2025-01-27 04:26:43'),
(3, 'Manager', 'web', '2024-05-27 00:11:50', '2024-05-27 11:55:46'),
(5, 'Customer', 'web', '2025-02-17 05:44:07', '2025-02-17 05:44:39'),
(6, 'Supplier', 'web', '2025-02-17 05:44:31', '2025-02-17 05:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 6),
(2, 1),
(2, 5),
(4, 1),
(5, 1),
(6, 1),
(6, 6),
(7, 1),
(7, 5),
(8, 1),
(9, 1),
(13, 1),
(13, 6),
(14, 1),
(14, 5),
(15, 1),
(16, 1),
(27, 1),
(27, 5),
(28, 1),
(28, 6),
(29, 1),
(30, 1),
(31, 1),
(31, 5),
(32, 1),
(32, 6),
(33, 1),
(34, 1),
(35, 1),
(35, 5),
(35, 6),
(36, 1),
(36, 6),
(37, 1),
(37, 6),
(38, 1),
(38, 6),
(39, 1),
(39, 5),
(40, 1),
(40, 6),
(41, 1),
(42, 1),
(43, 1),
(43, 5),
(44, 1),
(44, 6),
(45, 1),
(46, 1),
(47, 1),
(47, 5),
(48, 1),
(48, 6),
(49, 1),
(50, 1),
(51, 1),
(51, 5),
(52, 1),
(52, 6),
(53, 1),
(54, 1),
(55, 1),
(55, 5),
(56, 1),
(56, 6),
(57, 1),
(58, 1),
(59, 1),
(59, 5),
(60, 1),
(60, 6),
(61, 1),
(62, 1),
(63, 1),
(63, 5),
(64, 1),
(64, 6),
(65, 1),
(66, 1),
(67, 1),
(67, 5),
(68, 1),
(68, 6),
(69, 1),
(70, 1),
(71, 1),
(71, 5),
(72, 1),
(72, 6),
(73, 1),
(74, 1),
(75, 1),
(75, 5),
(76, 1),
(76, 6),
(77, 1),
(78, 1),
(79, 1),
(79, 5),
(80, 1),
(80, 6),
(81, 1),
(82, 1),
(83, 5),
(84, 1),
(84, 6),
(85, 1),
(86, 1),
(87, 1),
(87, 5),
(88, 1),
(88, 6),
(89, 1),
(90, 1),
(91, 1),
(91, 5),
(92, 1),
(92, 6),
(93, 1),
(94, 1),
(95, 1),
(95, 5),
(96, 1),
(96, 6),
(97, 1),
(98, 1),
(99, 1),
(99, 5),
(100, 1),
(100, 6),
(101, 1),
(102, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipment_mode`
--

CREATE TABLE `shipment_mode` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipment_mode`
--

INSERT INTO `shipment_mode` (`id`, `name`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'BY AIR', 'active', '20', '2025-01-30 04:49:05', '20', '2025-01-30 04:50:02'),
(2, 'BY Road', 'active', '20', '2025-02-05 02:00:29', NULL, NULL),
(3, 'BY Road', 'active', '20', '2025-02-05 02:00:30', '20', '2025-02-05 02:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `country_name`, `address1`, `address2`, `city`, `email`, `contact_number`, `remarks`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'Fatima Odonneddll', '4', '36 Rocky First Court', 'In eu laudantium pa', 'Veritatis voluptatem', 'videby@mailinator.com', '993', 'Rem dignissimos ea e', 'active', '20', '2025-02-04 05:41:44', '20', '2025-02-04 05:42:02'),
(2, 'MUSA', '3', '77 Hague Boulevard', 'Enim in excepturi eu', 'Velit et reiciendis', 'qewec@mailinator.com', '485', 'Nihil commodo maiore', 'active', '20', '2025-02-04 05:42:35', NULL, NULL),
(3, 'Cheryl Singleton', '4', '717 Second Extension', 'Neque ratione ut qui', 'Hic dolore rerum dol', 'byso@mailinator.com', '694', 'Sit labore commodo d', 'active', '20', '2025-02-04 05:42:54', NULL, NULL),
(4, 'Whoopi Baldwin', '5', '89 Second Parkway', 'Asperiores ullamco e', 'Et sit iure quia rei', 'zota@mailinator.com', '133', 'Voluptas fugit cons', 'active', '20', '2025-02-05 02:05:27', '20', '2025-02-08 04:12:54'),
(5, 'Fatima Odonneddll', '5', 'Street	1640 S Abilene St City/Town	Aurora State/Province/Region	Colorado Zip/Postal Code	80012 Phone Number	(303) 623-0589 Country	United States Latitude	39.687097 Longitude	-104.828155', 'Street	2420 Hudson Rd #13 City/Town	Greer State/Province/Region	South Carolina Zip/Postal Code	29650 Phone Number	(864) 292-2828 Country	United States Latitude	34.893345 Longitude	-82.28903', 'Dhaka', 'dasdsad@gmail.com', '32424234', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 'active', '20', '2025-02-08 03:27:37', NULL, NULL),
(6, 'This is more than five words', '5', '36 Rocky First Court', 'Enim in excepturi eu', 'fdgfdg', 'fgfd@gmail.com', '342342', 'hdgh', 'active', '20', '2025-02-08 05:42:19', NULL, NULL),
(7, 'William Powers', '8', '92 North Cowley Extension', 'Quidem irure ducimus', 'Officia fugit dolor', 'bino@mailinator.com', '426', 'Quidem dolore velit', 'inactive', '20', '2025-02-09 00:04:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_inquiries`
--

CREATE TABLE `supplier_inquiries` (
  `id` int(11) NOT NULL,
  `submission_date` date NOT NULL,
  `system_generated_inquiry_number` varchar(20) NOT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `customer_inquiry_number` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `shipment_mode` varchar(50) DEFAULT NULL,
  `expected_arrival_date` date DEFAULT NULL,
  `payment_term` varchar(100) DEFAULT NULL,
  `inquiry_validity` varchar(20) DEFAULT NULL,
  `authorization_status` enum('Yes','No') DEFAULT 'No',
  `remarks` text DEFAULT NULL,
  `sample_need` enum('Yes','No') DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_inquiry_details`
--

CREATE TABLE `supplier_inquiry_details` (
  `id` int(11) NOT NULL,
  `s_inquiry_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `import_country_hs_code` varchar(20) NOT NULL,
  `export_country_hs_code` varchar(20) NOT NULL,
  `item_spec` varchar(255) DEFAULT NULL,
  `mode_of_unit_id` varchar(50) NOT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `country_of_origin` varchar(100) DEFAULT NULL,
  `packing_size` varchar(100) DEFAULT NULL,
  `currency_id` varchar(60) NOT NULL,
  `item_quantity` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(10, 'Dhali', '017852', 'dhali@gmail.com', NULL, '$2y$10$3zs.Yyc5hQeiljj9NpRBxOgqMHzukVXALbrooJ.rdGfMCVIlRolRK', NULL, '2024-05-27 04:50:00', '2024-05-27 04:50:00'),
(13, 'Abir', '0145236', 'abir@gmail.com', NULL, '$2y$10$616qid.JGXKMB0p7T113cOZL1L9IND7p5LVfiTIgqOQfAu7z6o9.y', NULL, '2024-05-27 06:25:10', '2024-05-27 06:25:10'),
(16, 'DA', '000', 'da@gmail.com', NULL, '$2y$10$6jJ6Gb4UUl3y8pUx15MjYupz9L4GBJez06JoRu8Q8eScXq6sYQ3T6', NULL, '2024-05-27 11:57:37', '2024-05-27 11:57:37'),
(20, 'Super Admin', '123124151', 'superadmin@gmail.com', NULL, '$2y$10$.C5vNSsm/h0eMnQXuHtkJe2JT0uOlvN4yD1dVqoCerJLKuBoSiE32', NULL, '2025-01-27 03:31:45', '2025-01-27 03:31:45'),
(21, 'Customer', '3423423', 'customer@gmail.com', NULL, '$2y$10$0LHjJpooVkZM12o3F6JQ7eAmiC/5BWQPR95kWJTSXrxKptW0ueHWW', NULL, '2025-02-17 05:45:50', '2025-02-17 05:45:50'),
(22, 'Supplier', '4234234', 'supplier@gmail.com', NULL, '$2y$10$gTOY6Q5Qbmxmoa9OjC3/fuIsYLxM/2YqGcSyVANWaZTUeeaW6eU/K', NULL, '2025-02-17 05:46:43', '2025-02-17 05:46:43'),
(23, 'Super Admin 2', '34234', 'superadmin2@gmail.com', NULL, '$2y$10$5QO2oHrVOp63dJMHQgv.je9kyLkK44N2a/y8Vao4qjbrs4up/8ol.', NULL, '2025-02-18 04:30:25', '2025-02-18 04:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `web_sidebar_menu`
--

CREATE TABLE `web_sidebar_menu` (
  `id` bigint(10) NOT NULL,
  `uid` varchar(36) DEFAULT '0',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `assign` varchar(100) DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL,
  `is_collapsed` tinyint(1) DEFAULT 0,
  `is_heading` tinyint(1) DEFAULT 0,
  `permission_id` bigint(10) DEFAULT 0,
  `status` varchar(10) DEFAULT 'I',
  `create_by` varchar(10) DEFAULT NULL,
  `create_date` varchar(20) DEFAULT NULL,
  `update_by` varchar(10) DEFAULT NULL,
  `update_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_sidebar_menu`
--

INSERT INTO `web_sidebar_menu` (`id`, `uid`, `parent_id`, `name`, `icon`, `url`, `assign`, `order`, `is_collapsed`, `is_heading`, `permission_id`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, '04befafd-dfd0-4eec-b4d7-62825975d3f5', NULL, 'Dashboard', 'bi bi-grid', 'Dashboard', NULL, 1, 0, 0, 0, 'A', NULL, NULL, '5', '2024-09-09 11:24:36'),
(3, 'e7608767-119d-414a-8f5a-eab8afcfff18', NULL, 'Web Setup', 'bi bi-person-gear', '#', NULL, 3, 1, 0, 0, 'A', NULL, NULL, '5', '2024-10-27 12:43:06'),
(4, '05aecfb6-f5b5-4496-94e2-a6d65bb02c90', 3, 'Side Menu', 'bi bi-circle', 'SidebarNav', NULL, 1, 0, 0, 0, 'A', NULL, NULL, '5', '2024-10-28 05:46:35'),
(11, '59ebdca8-b889-4ec9-8ff6-22966d423137', NULL, 'User Config', 'bi bi-people-fill', '#', NULL, 5, 1, 0, 0, 'A', '1010', '2024-09-01 08:26:21', '1010', '2024-09-01 08:56:26'),
(13, '71d5ac51-a43d-4cd8-82e6-d12e81153c99', 11, 'User Info', 'bi bi-person-lines-fill', 'User', NULL, 2, 0, 0, 0, 'A', '1010', '2024-09-01 08:50:26', '1010', '2024-09-01 12:12:16'),
(14, '65c69934-50af-444a-96a0-0fe8c0c8f4e0', 11, 'User Roles', 'bi bi-person-lines-fill', 'Roles', NULL, 3, 0, 0, 0, 'A', '1010', '2024-09-01 08:51:46', '1010', '2024-09-01 11:48:57'),
(15, '35732e13-6bf8-4bfd-9d0f-a5fccb528af1', 11, 'Permission', 'bi', 'Permission', NULL, 5, 0, 0, 0, 'A', '1010', '2024-09-01 08:52:12', '4', '2024-09-03 06:58:53'),
(17, 'c034233a-5e12-432b-be7d-ca2b5375b663', NULL, 'Header Page', '', '', NULL, 7, NULL, 1, 0, 'A', NULL, NULL, NULL, NULL),
(19, '3d2c11b0-a15c-461e-bccc-f6214cc96b3f', NULL, 'Setup', 'bi bi-gear-wide-connected', '#', NULL, 4, 1, 0, 0, 'A', '5', '2024-09-11 09:13:09', NULL, NULL),
(20, '6f1531f7-5116-40a8-9494-567c460ba54c', 19, 'Department', 'bi bi-house-door', 'department', NULL, 1, 0, 0, 0, 'A', '5', '2024-09-11 09:14:17', NULL, NULL),
(21, '5666a805-414e-4e04-af35-d3559e5ab100', 19, 'Designation', 'bi bi-person', 'designation', NULL, 2, 0, 0, 0, 'A', '5', '2024-09-11 09:15:35', NULL, NULL),
(22, '86424200-4e76-4924-9f3b-c3f011d9d759', 19, 'District', '#', 'district', NULL, 3, 0, 0, 0, 'A', '5', '2024-09-11 09:34:49', NULL, NULL),
(23, 'df4feb07-b84f-4ea4-8c1b-b1a3a76ede46', 19, 'Blood Group', 'f', 'bloodgroup', NULL, 4, 0, 0, 0, 'A', '5', '2024-09-11 10:44:49', NULL, NULL),
(24, '9bcceb2d-264e-402f-b647-352935019ea6', 19, 'Occupation', '#', 'occupation', NULL, 5, 0, 0, 0, 'A', '5', '2024-09-12 05:35:15', NULL, NULL),
(25, '2b43c9d3-8909-42d5-b5e4-2cd7a06a9ca5', 19, 'Relationship', '#', 'relationship', NULL, 6, 0, 0, 0, 'A', '5', '2024-09-12 05:52:12', NULL, NULL),
(26, '404bbcfc-ea0e-4fa3-b8a4-cf5dff11f0e7', 19, 'Religion', '#', 'religion', NULL, 7, 0, 0, 0, 'A', '5', '2024-09-14 05:14:34', '5', '2024-09-14 05:16:47'),
(27, '004fd490-f74c-4ba2-a35e-b10d73c31c8d', 19, 'Employee', '#', 'employee', NULL, 8, 0, 0, 0, 'A', '5', '2024-09-14 08:41:32', NULL, NULL),
(28, '2f61cbb2-9f73-4453-9dc2-57cf658c5313', NULL, 'Attendance', 'bi bi-person-fill-check', '#', NULL, 5, 1, 0, 0, 'A', '5', '2024-09-23 10:26:58', '5', '2024-11-24 05:33:11'),
(29, '360e0000-e6aa-4445-8d14-590acc236034', 28, 'Attendance', '#', 'attendance', NULL, 1, 0, 0, 0, 'A', '5', '2024-09-23 10:27:36', NULL, NULL),
(30, 'a436d377-1854-413a-b9a3-bf08d73cfbe6', NULL, 'Test', 'bi bi-airplane-fill', '#', NULL, 7, 0, 0, 0, 'Deleted', '5', '2024-10-27 10:49:45', '5', '2024-11-26 10:10:29'),
(31, '5ae5172e-1c4f-4387-8f03-5347f63855e1', 3, 'Top Menu', 'bi', '#', NULL, 2, 0, 0, 0, 'Deleted', '5', '2024-10-27 10:56:12', '5', '2024-11-27 05:49:35'),
(32, '46e8223d-5367-4727-9ac8-46ff6ae2d2a0', 3, 'Side Nav', 'bi', '#', NULL, 3, 0, 0, 0, 'Deleted', '5', '2024-10-27 10:57:33', '5', '2024-11-27 05:49:44'),
(33, 'da17b005-922a-42fe-895e-9f448a09eec1', NULL, 'Leave Setup', 'bi bi-gear', '#', NULL, 5, 1, 0, 0, 'A', '5', '2024-11-18 06:06:32', '5', '2024-11-19 11:52:50'),
(34, 'a555c00b-3ee8-4970-8af7-00d48a164421', 33, 'Leave Application Form', 'bi bi-person-gear', 'leave/create', NULL, 1, 1, 0, 0, 'A', '5', '2024-11-19 11:50:03', '5', '2024-11-19 11:50:56'),
(35, 'bb3ef461-dd8f-4d52-8913-dca12b2d021f', 33, 'Leave Year', '#', 'leaveyear', NULL, 1, 0, 0, 0, 'A', '5', '2024-11-20 05:46:04', NULL, NULL),
(36, '292fa0cd-9a1c-4c7e-9c70-908d52573e1d', 33, 'Holidays', '#', 'holidays', NULL, 3, 0, 0, 0, 'A', '5', '2024-11-20 07:48:35', NULL, NULL),
(37, '08ebca89-3a32-4586-acb6-07fee3db5075', 28, 'Employee Data', '#', 'employeedata', NULL, 2, 0, 0, 0, 'A', '5', '2024-11-24 07:24:48', NULL, NULL),
(38, '44ddb76a-c282-41d5-b9c7-ea3021f8fe22', NULL, 'Reports', 'bi bi-file-earmark-spreadsheet-fill', '#', NULL, 6, 1, 0, 0, 'A', '5', '2024-11-27 06:51:57', '5', '2024-11-27 06:53:01'),
(39, 'b186fd70-4923-4042-abb4-5c0ea67bf050', 19, 'Degree', '#', 'degree', NULL, 3, 0, 0, 0, 'A', '5', '2024-12-01 07:59:51', NULL, NULL),
(40, 'd9d81a4a-0d5d-4db9-8e51-1545f4dc542a', 33, 'Leave Application', '#', 'leave', NULL, 1, 0, 0, 0, 'A', '5', '2024-12-02 07:42:41', '5', '2024-12-02 09:20:31'),
(41, 'e2586f0f-7fa3-4293-8ad6-2162ab7082a3', 38, 'Individual Reports', '#', 'individualreports', NULL, 1, 0, 0, 0, 'A', '5', '2024-12-07 06:50:41', NULL, NULL),
(42, 'c6ef956e-21f6-4893-a3cf-44946d7ee61c', 38, 'All Employees Reports', '.', 'allemployeesreports', NULL, 2, 0, 0, 0, 'A', '5', '2024-12-07 06:51:50', '5', '2024-12-07 06:52:17'),
(43, 'd32afc48-fa65-4ba4-9f68-30ddc4f5a384', NULL, 'Hardware and Network', 'bi bi-motherboard', '#', NULL, 6, 0, 0, 0, 'A', '5', '2024-12-08 07:34:25', '5', '2024-12-08 07:35:03'),
(44, 'e946e0fe-4c12-435d-baed-cdfdf973196f', 43, 'Hardware', '#', 'hardware', NULL, 1, 0, 0, 0, 'A', '5', '2024-12-08 07:35:37', NULL, NULL),
(45, '51ee7dc7-a481-44ed-8a8d-937f6d5f89cc', 43, 'Network', '#', 'network', NULL, 2, 0, 0, 0, 'A', '5', '2024-12-08 07:36:10', NULL, NULL),
(46, '307f76c0-2d18-4255-9ac4-6cb812b1c29e', 43, 'Components', '#', 'components', NULL, 3, 0, 0, 0, 'A', '5', '2024-12-10 08:41:25', NULL, NULL),
(47, 'e98c8fd7-999b-4e76-960e-f41ee55ab067', 43, 'Type/Size', '#', 'typesize', NULL, 4, 0, 0, 0, 'A', '5', '2024-12-10 09:12:55', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_branches`
--
ALTER TABLE `bank_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_inquiries`
--
ALTER TABLE `customer_inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_inquiry_details`
--
ALTER TABLE `customer_inquiry_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_assign`
--
ALTER TABLE `menu_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `mode_of_units`
--
ALTER TABLE `mode_of_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_grade`
--
ALTER TABLE `product_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `shipment_mode`
--
ALTER TABLE `shipment_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `supplier_inquiries`
--
ALTER TABLE `supplier_inquiries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `system_generated_inquiry_number` (`system_generated_inquiry_number`);

--
-- Indexes for table `supplier_inquiry_details`
--
ALTER TABLE `supplier_inquiry_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `web_sidebar_menu`
--
ALTER TABLE `web_sidebar_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bank_branches`
--
ALTER TABLE `bank_branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_inquiries`
--
ALTER TABLE `customer_inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_inquiry_details`
--
ALTER TABLE `customer_inquiry_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu_assign`
--
ALTER TABLE `menu_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mode_of_units`
--
ALTER TABLE `mode_of_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_grade`
--
ALTER TABLE `product_grade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shipment_mode`
--
ALTER TABLE `shipment_mode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier_inquiries`
--
ALTER TABLE `supplier_inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_inquiry_details`
--
ALTER TABLE `supplier_inquiry_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `web_sidebar_menu`
--
ALTER TABLE `web_sidebar_menu`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
