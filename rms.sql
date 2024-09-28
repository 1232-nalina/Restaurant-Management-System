-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2024 at 08:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `mission` longtext DEFAULT NULL,
  `vision` longtext DEFAULT NULL,
  `values` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `latitude`, `longitude`, `email`, `username`, `email_verified_at`, `password_changed`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', NULL, NULL, 'superadmin@admin.com', 'superadmin', NULL, 1, '$2a$12$UpgwgPKg0Nw6W9UtQBzdKOwGQwF0deTu1yC/hs4BEJQmj/tH.jdfe', 'FJOBZ1KZQ11S0S8qv8q0qC58aQ0NXS03M3U1Qj85iaowO2pS4cBv4pvihIfZ', '2024-08-17 21:26:09', '2024-08-17 21:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `started_year` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_section`
--

CREATE TABLE `class_section` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classes_id` bigint(20) UNSIGNED NOT NULL,
  `sections_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_one` varchar(255) NOT NULL,
  `phone_two` varchar(255) DEFAULT NULL,
  `logo` text NOT NULL,
  `fab_icon` text DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `google_map` text DEFAULT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `instagram_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `gmail_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `issuer` varchar(255) NOT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `cost_price` int(11) DEFAULT NULL,
  `selling_price` int(11) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `expenses_date` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `hostings`
--

CREATE TABLE `hostings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hosting_cat_id` bigint(20) UNSIGNED NOT NULL,
  `domain_id` bigint(20) UNSIGNED DEFAULT NULL,
  `external_domain` varchar(255) DEFAULT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `selling_price` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hosting_categories`
--

CREATE TABLE `hosting_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `income_categories`
--

CREATE TABLE `income_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `income_amount` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_items_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit` enum('litre','kg','pcs') NOT NULL DEFAULT 'pcs'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `menu_items_id`, `name`, `quantity`, `created_at`, `updated_at`, `unit`) VALUES
(2, 2, 'Pancake', '1', '2024-08-22 07:42:43', '2024-08-22 07:42:43', 'pcs'),
(3, 3, 'Meat', '1', '2024-08-22 07:45:14', '2024-08-22 07:45:14', 'pcs'),
(4, 4, 'Potato', '1', '2024-08-22 19:44:16', '2024-08-22 19:44:16', 'pcs'),
(5, 5, 'Meat', '10', '2024-08-22 19:45:15', '2024-08-22 19:45:15', 'pcs'),
(6, 6, 'Meat', '1', '2024-08-22 19:46:04', '2024-08-22 19:46:04', 'pcs'),
(7, 7, 'Himalayan Coffee Beans', '1', '2024-08-22 19:47:26', '2024-08-22 19:47:26', 'pcs'),
(8, 8, 'Tea', '1', '2024-08-22 19:48:03', '2024-08-22 19:48:03', 'pcs'),
(9, 9, 'Fruit', '1', '2024-08-22 19:48:44', '2024-08-22 19:48:44', 'pcs'),
(10, 10, 'Cheese', '1', '2024-08-22 19:49:55', '2024-08-22 19:49:55', 'pcs'),
(12, 12, 'Chicken', '1', '2024-08-22 19:50:50', '2024-08-22 19:50:50', 'pcs'),
(13, 13, 'Sandwich', '1', '2024-08-22 19:52:14', '2024-08-22 19:52:14', 'pcs'),
(14, 14, 'Sandwich', '1', '2024-08-22 19:52:46', '2024-08-22 19:52:46', 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` decimal(8,2) NOT NULL,
  `price` varchar(255) NOT NULL,
  `unit` enum('litre','kg','pcs') NOT NULL DEFAULT 'pcs',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kitchen`
--

CREATE TABLE `kitchen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kitchen`
--

INSERT INTO `kitchen` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Steak', '2024-08-19 01:15:41', '2024-08-19 01:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('breakfast','lunch','all','dinner','drink') NOT NULL DEFAULT 'all'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`id`, `name`, `created_at`, `updated_at`, `type`) VALUES
(3, 'Breakfast', '2024-08-22 07:41:39', '2024-08-22 07:43:29', 'breakfast'),
(4, 'Dinner', '2024-08-22 07:43:49', '2024-08-22 07:44:05', 'dinner'),
(6, 'Snacks', '2024-08-22 19:38:50', '2024-08-22 19:38:50', 'all'),
(7, 'Drinks', '2024-08-22 19:46:20', '2024-08-22 19:46:20', 'drink');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_cat_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_cat_id`, `name`, `price`, `status`, `created_at`, `updated_at`, `image`, `description`) VALUES
(2, 3, 'American Breakfast', '250', 'active', '2024-08-22 07:42:43', '2024-08-22 19:42:25', 'Image_1724376445383YdNvw1WLgtvTvkPnVhwiqMUMJUUobn6qG9kOl933.jpg', 'Authentic American'),
(3, 4, 'Steak', '2500', 'active', '2024-08-22 07:45:14', '2024-08-22 19:42:42', 'Image_172437646252yOYelyfKSH9yf3aeMiWjsHi3aIm67Dpa2ANahx89.jpg', 'BeefMeat'),
(4, 6, 'French Fries', '200', 'active', '2024-08-22 19:44:16', '2024-08-22 19:44:16', 'Image_17243765566525qarzyYLV06NhxQp1e4dtxd2na9qPZvZ8PIJkdVO.jpg', 'French Fries'),
(5, 6, 'Nuggets', '225', 'active', '2024-08-22 19:45:15', '2024-08-22 19:45:15', 'Image_17243766159588pPpMFbnmTabMJ4qu5F5bLkevM9NbMnvwAZNJqcv.jpg', 'Chicken Nuggets'),
(6, 6, 'Hotdog', '180', 'active', '2024-08-22 19:46:04', '2024-08-22 19:46:04', 'Image_1724376664899ZJJnPW8Pek3S3mAnICOOeV0OLEYBKkdM5r6qBE9U.jpg', 'Hotdog'),
(7, 7, 'Americano', '175', 'active', '2024-08-22 19:47:26', '2024-08-22 19:47:26', 'Image_1724376746623YPpq6fECDHkuhUUYV1oVAH5MZ0pHvM6sVtJurBzv.jpg', 'Coffee'),
(8, 7, 'Iced Tea', '100', 'active', '2024-08-22 19:48:03', '2024-08-22 19:48:03', 'Image_1724376783939R0TEP9KUy1pPseKN9V7gAjO2l3rCfmtU5SMY7rd7.jpg', 'Tea'),
(9, 6, 'Fruit Salad', '500', 'active', '2024-08-22 19:48:44', '2024-08-22 19:48:44', 'Image_17243768248732448BgkeCOchRaxy8BDQtkXRiatsiD0EpmYrJR67.jpg', 'Fruit Salad'),
(10, 6, 'Cheese Burger', '300', 'active', '2024-08-22 19:49:55', '2024-08-22 19:49:55', 'Image_172437689527DuLOXxcEmpCenHGEK5BHKrT4aAJGgq4sy0dwYD3a.jpg', 'Cheese'),
(12, 6, 'Chicken Burger', '350', 'active', '2024-08-22 19:50:50', '2024-08-22 19:50:50', 'Image_1724376950402XjGEXmyd5S5aU5nvERhbHRElx7hOvNb9k5lNt3Vl.jpg', 'Chicken'),
(13, 3, 'Cheese Sandwich', '100', 'active', '2024-08-22 19:52:14', '2024-08-22 19:52:56', 'Image_1724377034903GN9LfFc1vLjDBHIn1XrAyI6TgYJIXLxIpaLQAQhT.jpg', 'Sandwich'),
(14, 3, 'Ham Sandwich', '150', 'active', '2024-08-22 19:52:46', '2024-08-22 19:52:46', 'Image_1724377066957O2f3AwVcNnPg0TbhRCjozimeBtmoqUUxZydM8diR.jpg', 'Sandwich');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_22_023116_create_classes_table', 1),
(6, '2023_02_23_085333_create_sections_table', 1),
(7, '2023_02_23_142441_create_class_section_table', 1),
(8, '2023_02_24_024154_create_permission_tables', 1),
(9, '2023_02_25_131630_create_admins_table', 1),
(10, '2023_03_02_084416_create_clients_table', 1),
(11, '2023_03_02_104244_create_hosting_categories_table', 1),
(12, '2023_03_02_104323_create_domains_table', 1),
(13, '2023_03_03_090337_create_hostings_table', 1),
(14, '2023_03_07_062343_create_system_settings_table', 1),
(15, '2023_03_07_063113_add_dates_to_hosting_categories_table', 1),
(16, '2023_05_08_053356_create_income_categories_table', 1),
(17, '2023_05_08_071442_create_expense_categories_table', 1),
(18, '2023_05_08_075303_create_expenses_table', 1),
(19, '2023_05_14_054527_create_tables_table', 1),
(20, '2023_05_14_062841_create_menu_categories_table', 1),
(21, '2023_05_14_094758_create_menu_items_table', 1),
(22, '2023_05_14_105138_create_orders_table', 1),
(23, '2023_05_14_105157_create_order_items_table', 1),
(24, '2023_05_15_041824_create_payments_table', 1),
(25, '2023_07_19_051145_create_abouts_table', 1),
(26, '2023_07_28_073005_create_teams_table', 1),
(27, '2023_07_28_074527_create_contacts_table', 1),
(28, '2023_08_02_092818_create_table_ingredients', 1),
(29, '2023_08_07_062119_create_table_kitchen', 1),
(30, '2023_09_30_084940_add_no_of_seats_in_table', 1),
(31, '2023_10_04_153248_create_table_stock', 1),
(32, '2023_10_06_084028_create_inventories_table', 1),
(33, '2023_10_06_151500_add_unit_in_ingredients_items', 1),
(34, '2023_10_06_155531_change_qty_type_in_ingredients', 1),
(35, '2023_10_06_165413_add_type_in_menu_categories', 1),
(36, '2023_10_06_181234_add_image_in_menu_item', 1),
(37, '2023_10_07_050200_add_description_in_menuitem', 1),
(38, '2023_10_07_085725_create_reservations_table', 1),
(39, '2023_10_07_130035_add_kitchen_id_toorderitem', 1),
(40, '2023_10_07_160924_add_status_in_orderitem', 1);

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
(1, 'App\\Models\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','inprogress','completed') NOT NULL DEFAULT 'pending',
  `total` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kitchen_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `cashamount` varchar(255) DEFAULT NULL,
  `changeamount` varchar(255) DEFAULT NULL,
  `status` enum('pending','failed','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(2, 'dashboard.edit', 'admin', 'dashboard', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(3, 'admin.create', 'admin', 'admin', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(4, 'admin.view', 'admin', 'admin', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(5, 'admin.edit', 'admin', 'admin', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(6, 'admin.delete', 'admin', 'admin', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(7, 'role.create', 'admin', 'role', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(8, 'role.view', 'admin', 'role', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(9, 'role.edit', 'admin', 'role', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(10, 'role.delete', 'admin', 'role', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(11, 'stock.create', 'admin', 'stock', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(12, 'stock.view', 'admin', 'stock', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(13, 'stock.edit', 'admin', 'stock', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(14, 'stock.delete', 'admin', 'stock', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(15, 'setting.create', 'admin', 'setting', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(16, 'setting.view', 'admin', 'setting', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(17, 'setting.edit', 'admin', 'setting', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(18, 'setting.delete', 'admin', 'setting', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(19, 'income_category.create', 'admin', 'income_category', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(20, 'income_category.view', 'admin', 'income_category', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(21, 'income_category.edit', 'admin', 'income_category', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(22, 'income_category.delete', 'admin', 'income_category', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(23, 'expenses_category.create', 'admin', 'expenses_category', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(24, 'expenses_category.view', 'admin', 'expenses_category', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(25, 'expenses_category.edit', 'admin', 'expenses_category', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(26, 'expenses_category.delete', 'admin', 'expenses_category', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(27, 'expenses.create', 'admin', 'expenses', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(28, 'expenses.view', 'admin', 'expenses', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(29, 'expenses.edit', 'admin', 'expenses', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(30, 'expenses.delete', 'admin', 'expenses', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(31, 'expenses.report', 'admin', 'expenses', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(32, 'table.create', 'admin', 'table', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(33, 'table.view', 'admin', 'table', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(34, 'table.edit', 'admin', 'table', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(35, 'table.delete', 'admin', 'table', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(36, 'menucategory.create', 'admin', 'menucategory', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(37, 'menucategory.view', 'admin', 'menucategory', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(38, 'menucategory.edit', 'admin', 'menucategory', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(39, 'menucategory.delete', 'admin', 'menucategory', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(40, 'menuitem.create', 'admin', 'menuitem', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(41, 'menuitem.view', 'admin', 'menuitem', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(42, 'menuitem.edit', 'admin', 'menuitem', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(43, 'menuitem.delete', 'admin', 'menuitem', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(44, 'order.take', 'admin', 'order', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(45, 'order.view', 'admin', 'order', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(46, 'order.edit', 'admin', 'order', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(47, 'order.delete', 'admin', 'order', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(48, 'payment.make', 'admin', 'payment', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(49, 'menuitemingredients.take', 'admin', 'menuitemingredients', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(50, 'menuitemingredients.view', 'admin', 'menuitemingredients', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(51, 'menuitemingredients.edit', 'admin', 'menuitemingredients', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(52, 'menuitemingredients.delete', 'admin', 'menuitemingredients', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(53, 'kitchen.view', 'admin', 'kitchen', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(54, 'kitchen.edit', 'admin', 'kitchen', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(55, 'kitchen.delete', 'admin', 'kitchen', '2024-08-17 21:26:09', '2024-08-17 21:26:09'),
(56, 'kitchen.create', 'admin', 'kitchen', '2024-08-17 21:26:09', '2024-08-17 21:26:09');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL,
  `person` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `email`, `phone`, `date`, `time`, `person`, `created_at`, `updated_at`) VALUES
(1, 'Gagan Shrestha', 'admin@gmail.com', '1231234567', '2024-08-31', '04:31:00', 3, '2024-08-22 04:59:46', '2024-08-22 04:59:46'),
(2, 'Gagan Shrestha', 'sandesh@gmail.com', '123', '2024-08-23', '20:12:00', 2, '2024-08-22 08:40:26', '2024-08-22 08:40:26');

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
(1, 'superadmin', 'admin', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(2, 'admin', 'admin', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(3, 'reception', 'admin', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(4, 'kitchen', 'admin', '2024-08-17 21:26:08', '2024-08-17 21:26:08'),
(5, 'user', 'admin', '2024-08-17 21:26:08', '2024-08-17 21:26:08');

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
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity_in_gm` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `pan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('empty','full') NOT NULL DEFAULT 'empty',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seats` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `facebook_link` text DEFAULT NULL,
  `insta_link` text DEFAULT NULL,
  `linkedin_link` text DEFAULT NULL,
  `twitter_link` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'sandesh thapa', 'sandesh@gmail.com', NULL, '$2y$10$gnXPWcLRcrDdAA/DExEPa.N2.W1OPGiVwanbos3kQS0pPR85HoDBu', NULL, '2024-08-17 21:29:35', '2024-08-17 21:29:35'),
(6, 'admin', 'admin@gmail.com', NULL, '$2y$10$q8Sy3YponVo4wgdoA16d9eqyfaRyOqjHQ1wOUoHj45tw/78kUiDbe', NULL, '2024-08-17 21:37:07', '2024-08-17 21:37:07'),
(7, 'admin', 'superadmin@admin.com', NULL, '$2y$10$jhixQEafj9GaP8bgzcyrfeU18b7PxCC32u4b0D0lmjmPT1AWtsXwq', NULL, '2024-08-19 00:44:16', '2024-08-19 00:44:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`),
  ADD UNIQUE KEY `admin_username_unique` (`username`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_section`
--
ALTER TABLE `class_section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_section_classes_id_foreign` (`classes_id`),
  ADD KEY `class_section_sections_id_foreign` (`sections_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domains_client_id_index` (`client_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_category_id_index` (`category_id`),
  ADD KEY `expenses_admin_id_index` (`admin_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_categories_admin_id_index` (`admin_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hostings`
--
ALTER TABLE `hostings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hostings_hosting_cat_id_index` (`hosting_cat_id`),
  ADD KEY `hostings_domain_id_index` (`domain_id`),
  ADD KEY `hostings_client_id_index` (`client_id`);

--
-- Indexes for table `hosting_categories`
--
ALTER TABLE `hosting_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_categories`
--
ALTER TABLE `income_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `income_categories_admin_id_index` (`admin_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredients_menu_items_id_index` (`menu_items_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kitchen`
--
ALTER TABLE `kitchen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kitchen_name_unique` (`name`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_cat_id_index` (`menu_cat_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_table_id_index` (`table_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_index` (`order_id`),
  ADD KEY `order_items_menu_item_id_index` (`menu_item_id`),
  ADD KEY `order_items_kitchen_id_foreign` (`kitchen_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_index` (`order_id`);

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
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
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
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
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
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_section`
--
ALTER TABLE `class_section`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostings`
--
ALTER TABLE `hostings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hosting_categories`
--
ALTER TABLE `hosting_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_categories`
--
ALTER TABLE `income_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kitchen`
--
ALTER TABLE `kitchen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_section`
--
ALTER TABLE `class_section`
  ADD CONSTRAINT `class_section_classes_id_foreign` FOREIGN KEY (`classes_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_section_sections_id_foreign` FOREIGN KEY (`sections_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `domains`
--
ALTER TABLE `domains`
  ADD CONSTRAINT `domains_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `expense_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hostings`
--
ALTER TABLE `hostings`
  ADD CONSTRAINT `hostings_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hostings_domain_id_foreign` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hostings_hosting_cat_id_foreign` FOREIGN KEY (`hosting_cat_id`) REFERENCES `hosting_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_menu_items_id_foreign` FOREIGN KEY (`menu_items_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_cat_id_foreign` FOREIGN KEY (`menu_cat_id`) REFERENCES `menu_categories` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_kitchen_id_foreign` FOREIGN KEY (`kitchen_id`) REFERENCES `kitchen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

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
