-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 04:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `growcrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `allotmanagers`
--

CREATE TABLE `allotmanagers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mr_id` varchar(255) DEFAULT NULL,
  `manager_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allotmanagers`
--

INSERT INTO `allotmanagers` (`id`, `mr_id`, `manager_id`, `created_at`, `updated_at`) VALUES
(1, '4', '3', '2024-04-08 04:46:07', NULL),
(2, '17', '6', '2024-04-24 09:29:54', NULL),
(3, '18', '6', '2024-04-24 09:30:32', '2024-04-24 09:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `add_by` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `add_by`, `title`, `company_id`, `cover_image`, `created_at`, `updated_at`) VALUES
(1, '2', 'Once Upon In A jungle', '2', 'uploads/Bharat Tech  Pvt Ltd/1712551234.webp', '2024-04-08 04:40:34', NULL),
(2, '2', 'Justice Ledge', '2', 'uploads/Bharat Tech  Pvt Ltd/1712551293.webp', '2024-04-08 04:41:33', NULL),
(3, '5', 'first book', '5', 'uploads/abc/1712668130.webp', '2024-04-09 13:08:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupens`
--

CREATE TABLE `coupens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupen_code` varchar(255) DEFAULT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `valid_upto` varchar(211) DEFAULT NULL,
  `usage` int(11) NOT NULL DEFAULT 0,
  `used` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupens`
--

INSERT INTO `coupens` (`id`, `coupen_code`, `percentage`, `valid_upto`, `usage`, `used`, `created_at`, `updated_at`) VALUES
(1, 'holi10', '10', '2024-04-12', 3, 0, '2024-04-08 16:27:09', '2024-04-15 17:32:58'),
(2, 'coupen2', '10', '2024-04-17', 5, 2, '2024-04-15 17:33:12', '2024-04-15 17:43:37');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `contact_number` varchar(10) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `anniversary` varchar(50) DEFAULT NULL,
  `dob` varchar(15) DEFAULT NULL,
  `clinic_1_address_timings` varchar(200) NOT NULL,
  `clinic_2_address_timings` varchar(200) DEFAULT NULL,
  `clinic_3_address_timings` varchar(200) DEFAULT NULL,
  `clinic_4_address_timings` varchar(200) DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `doctor_name`, `specialty`, `contact_number`, `email`, `anniversary`, `dob`, `clinic_1_address_timings`, `clinic_2_address_timings`, `clinic_3_address_timings`, `clinic_4_address_timings`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'Noelle Carson', 'Ex eos recusandae E', '9876543210', 'rixupurujy@mailinator.com', NULL, NULL, 'Dolor ducimus imped', 'Dolor ducimus imped', 'Dolor ducimus imped', 'Dolor ducimus imped', 2, '2024-04-27 21:24:42', '2024-05-01 11:44:14'),
(2, 'Noelle Carson', 'Noelle Carson', '9876543210', 'anshg@axepertexhibits.com', NULL, NULL, 'Dolor ducimus imped', 'Dolor ducimus imped', 'Dolor ducimus imped', 'Dolor ducimus imped', 0, '2024-04-27 21:25:29', '2024-04-30 12:03:29'),
(3, 'Leandra Greer', 'Consectetur ut rem', '370', 'hakuwes@mailinator.com', '1978-06-27', '1994-09-03', 'Minima esse itaque t', 'Minima esse itaque t', 'Minima esse itaque t', 'Minima esse itaque t', 0, '2024-04-27 21:39:04', '2024-04-27 21:39:04'),
(4, 'Brynn Huber', 'Ad et anim deserunt', '9876543210', 'bihi@mailinator.com', '1987-02-04', '2013-12-20', 'Commodi voluptas pro', 'Commodi voluptas pro', 'Commodi voluptas pro', 'Commodi voluptas pro', 0, '2024-04-28 08:23:00', '2024-04-28 08:23:00'),
(5, 'Stewart Cox', 'Aspernatur optio et', '9876543289', 'qyqalyx@mailinator.com', '2006-11-18', '1980-09-05', 'Adipisicing sunt qui', 'Adipisicing sunt qui', 'Adipisicing sunt qui', 'Adipisicing sunt qui', 0, '2024-04-30 16:42:46', '2024-04-30 16:42:46'),
(6, 'Davis Kline', 'Molestiae quibusdam', '9876543210', 'tilezunew@mailinator.com', '2012-09-16', '1993-10-24', 'Blanditiis eius exer', 'Blanditiis eius exer', 'Blanditiis eius exer', 'Blanditiis eius exer', 0, '2024-04-30 17:32:08', '2024-04-30 17:32:08'),
(7, 'Davis Kline', 'Molestiae quibusdam', '9876543210', 'tilezunew@mailinator.com', '2012-09-16', '1993-10-24', 'Blanditiis eius exer', 'Blanditiis eius exer', 'Blanditiis eius exer', 'Blanditiis eius exer', 0, '2024-04-30 17:32:08', '2024-04-30 17:32:08'),
(8, 'Virginia Spears', 'Repudiandae ut aliqu', '6178789098', 'powesure@mailinator.com', '1978-01-18', '1990-09-08', 'Rerum omnis consequa', 'Rerum omnis consequa', 'Rerum omnis consequa', 'Rerum omnis consequa', 0, '2024-05-01 06:30:36', '2024-05-01 06:30:36'),
(9, 'Virginia Spears', 'Repudiandae ut aliqu', '6178789098', 'powesure@mailinator.com', '1978-01-18', '1990-09-08', 'Rerum omnis consequa', 'Rerum omnis consequa', 'Rerum omnis consequa', 'Rerum omnis consequa', 0, '2024-05-01 06:30:36', '2024-05-01 06:30:36'),
(10, 'Porter Juarez', 'Culpa in sequi cupi', '0987654321', 'neqy@mailinator.com', '1999-10-10', '2014-08-05', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 0, '2024-05-01 09:59:41', '2024-05-01 09:59:41'),
(11, 'Porter Juarez', 'Culpa in sequi cupi', '0987654321', 'neqy@mailinator.com', '1999-10-10', '2014-08-05', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 0, '2024-05-01 09:59:41', '2024-05-01 09:59:41'),
(12, 'Porter Juarez', 'Culpa in sequi cupi', '0987654321', 'neqy@mailinator.com', '1999-10-10', '2014-08-05', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 0, '2024-05-01 09:59:44', '2024-05-01 09:59:44'),
(13, 'Porter Juarez', 'Culpa in sequi cupi', '0987654321', 'neqy@mailinator.com', '1999-10-10', '2014-08-05', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 0, '2024-05-01 09:59:44', '2024-05-01 09:59:44'),
(14, 'Porter Juarez', 'Culpa in sequi cupi', '0987654321', 'neqy@mailinator.com', '1999-10-10', '2014-08-05', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 0, '2024-05-01 09:59:53', '2024-05-01 09:59:53'),
(15, 'Porter Juarez', 'Culpa in sequi cupi', '0987654321', 'neqy@mailinator.com', '1999-10-10', '2014-08-05', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 'Id odit magnam facil', 0, '2024-05-01 09:59:54', '2024-05-01 09:59:54'),
(16, 'Caesar Mcpherson', 'Eiusmod atque qui as', '3189876543', 'jegaxigasa@mailinator.com', '1977-10-08', '1978-12-06', 'Nemo mollitia volupt', 'Nemo mollitia volupt', 'Nemo mollitia volupt', 'Nemo mollitia volupt', 0, '2024-05-01 10:02:24', '2024-05-01 10:02:24'),
(17, 'Caesar Mcpherson', 'Eiusmod atque qui as', '3189876543', 'jegaxigasa@mailinator.com', '1977-10-08', '1978-12-06', 'Nemo mollitia volupt', 'Nemo mollitia volupt', 'Nemo mollitia volupt', 'Nemo mollitia volupt', 0, '2024-05-01 10:02:25', '2024-05-01 10:02:25'),
(18, 'Griffin Sanders', 'Impedit ullam inven', '9934504905', 'kigeheri@mailinator.com', '2015-05-17', '1993-09-13', 'Cupiditate officia d', 'Cupiditate officia d', 'Cupiditate officia d', 'Cupiditate officia d', 2, '2024-05-01 16:53:31', '2024-05-01 11:44:29'),
(19, '1. Dr. Alex Von Clumsy', 'Pathologist', '9876543210', 'doctor@gmail.com', '1-01-20210', '32874', 'XYZ', NULL, NULL, NULL, 0, '2024-05-01 21:16:36', '2024-05-01 21:16:36'),
(20, '2. Dr. Sarah Slipup', 'Surgeon', '9876543210', 'doctor@gmail.com', '1-01-20211', '32875', 'XYZ', NULL, NULL, NULL, 0, '2024-05-01 21:16:36', '2024-05-01 21:16:36'),
(21, '3. Dr. Bob Blunder', 'Radiologist', '9876543210', 'doctor@gmail.com', '1-01-20212', '32876', 'XYZ', NULL, NULL, NULL, 0, '2024-05-01 21:16:36', '2024-05-01 21:16:36'),
(22, '4. Dr. Emily Oops', 'Cardiologist', '9876543210', 'doctor@gmail.com', '1-01-20213', '32877', 'XYZ', NULL, NULL, NULL, 0, '2024-05-01 21:16:36', '2024-05-01 21:16:36'),
(23, '5. Dr. Jack Fumble', 'Psychiatrist', '9876543210', 'doctor@gmail.com', '1-01-20214', '32878', 'XYZ', NULL, NULL, NULL, 0, '2024-05-01 21:16:36', '2024-05-01 21:16:36'),
(24, '6. Dr. Lily Mishap', 'General Practitioner', '9876543210', 'doctor@gmail.com', '1-01-20215', '32879', 'XYZ', NULL, NULL, NULL, 0, '2024-05-01 21:16:36', '2024-05-01 21:16:36'),
(25, '7. Dr. Max Muddle', 'Physical Therapist', '9876543210', 'doctor@gmail.com', '1-01-20216', '32880', 'XYZ', NULL, NULL, NULL, 0, '2024-05-01 21:16:36', '2024-05-01 21:16:36'),
(26, '8. Dr. Grace Gaffe', 'Ophthalmologist', '9876543210', 'doctor@gmail.com', '1-01-20217', '32881', 'XYZ', NULL, NULL, NULL, 0, '2024-05-01 21:16:36', '2024-05-01 21:16:36'),
(27, '9. Dr. Oliver Oversight', 'Pharmacist', '9876543210', 'doctor@gmail.com', '1-01-20218', '32882', 'XYZ', NULL, NULL, NULL, 0, '2024-05-01 21:16:36', '2024-05-01 21:16:36'),
(28, '10. Dr. Sophie Snafu', 'Radiologist', '9876543210', 'doctor@gmail.com', '1-01-20219', '32883', 'XYZ', NULL, NULL, NULL, 0, '2024-05-01 21:16:36', '2024-05-01 21:16:36');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_report`
--

CREATE TABLE `doctor_report` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `report` text NOT NULL,
  `flag` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `scope` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `scope`, `value`, `created_at`, `updated_at`) VALUES
(1, 'admin_panel', 'App\\Models\\User|1', 'true', '2024-04-08 04:37:47', '2024-04-08 04:37:47'),
(2, 'company_pannel', 'App\\Models\\User|1', 'false', '2024-04-08 04:37:47', '2024-04-08 04:37:47'),
(3, 'manager_pannel', 'App\\Models\\User|1', 'false', '2024-04-08 04:37:47', '2024-04-08 04:37:47'),
(4, 'admin_panel', 'App\\Models\\User|2', 'false', '2024-04-08 04:39:09', '2024-04-08 04:39:09'),
(5, 'company_pannel', 'App\\Models\\User|2', 'true', '2024-04-08 04:39:09', '2024-04-08 04:39:09'),
(6, 'manager_pannel', 'App\\Models\\User|2', 'false', '2024-04-08 04:39:09', '2024-04-08 04:39:09'),
(7, 'admin_panel', 'App\\Models\\User|5', 'false', '2024-04-08 16:27:21', '2024-04-08 16:27:21'),
(8, 'company_pannel', 'App\\Models\\User|5', 'true', '2024-04-08 16:27:21', '2024-04-08 16:27:21'),
(9, 'manager_pannel', 'App\\Models\\User|5', 'false', '2024-04-08 16:27:21', '2024-04-08 16:27:21'),
(10, 'admin_panel', 'App\\Models\\User|6', 'false', '2024-04-08 16:31:09', '2024-04-08 16:31:09'),
(11, 'company_pannel', 'App\\Models\\User|6', 'false', '2024-04-08 16:31:09', '2024-04-08 16:31:09'),
(12, 'manager_pannel', 'App\\Models\\User|6', 'true', '2024-04-08 16:31:09', '2024-04-08 16:31:09'),
(13, 'admin_panel', 'App\\Models\\User|14', 'false', '2024-04-19 18:37:58', '2024-04-19 18:37:58'),
(14, 'company_pannel', 'App\\Models\\User|14', 'true', '2024-04-19 18:37:58', '2024-04-19 18:37:58'),
(15, 'manager_pannel', 'App\\Models\\User|14', 'false', '2024-04-19 18:37:58', '2024-04-19 18:37:58'),
(16, 'admin_panel', 'App\\Models\\User|15', 'false', '2024-04-24 00:16:47', '2024-04-24 00:16:47'),
(17, 'company_pannel', 'App\\Models\\User|15', 'true', '2024-04-24 00:16:47', '2024-04-24 00:16:47'),
(18, 'manager_pannel', 'App\\Models\\User|15', 'false', '2024-04-24 00:16:47', '2024-04-24 00:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `innerpages`
--

CREATE TABLE `innerpages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `add_by` varchar(255) DEFAULT NULL,
  `book_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `inner_image` varchar(255) DEFAULT NULL,
  `audio_file` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `sequence` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `innerpages`
--

INSERT INTO `innerpages` (`id`, `add_by`, `book_id`, `title`, `inner_image`, `audio_file`, `youtube_link`, `sequence`, `created_at`, `updated_at`) VALUES
(1, '2', '2', 'When Caratos hits Vegeta', 'uploads/Bharat Tech  Pvt Ltd/1712551410_When Caratos hits Vegeta.png', 'uploads/Bharat Tech  Pvt Ltd/1712551410_When Caratos hits Vegeta.mp3', NULL, '4', '2024-04-08 04:43:30', '2024-04-23 17:31:13'),
(2, '2', '2', 'When Caratos hits Goku', 'uploads/Bharat Tech  Pvt Ltd/1712551410_When Caratos hits Goku.png', NULL, NULL, '2', '2024-04-08 04:43:30', '2024-04-23 17:31:36'),
(3, '2', '2', 'When Caratos hits Superman', 'uploads/Bharat Tech  Pvt Ltd/1712551410_When Caratos hits Superman.png', NULL, NULL, '3', '2024-04-08 04:43:30', '2024-04-23 17:31:06'),
(4, '2', '1', 'join', 'uploads/Bharat Tech  Pvt Ltd/1712551453_join.png', NULL, NULL, '1', '2024-04-08 04:44:13', '2024-04-23 17:29:13'),
(5, '2', '1', 'medium', 'uploads/Bharat Tech  Pvt Ltd/1712551453_medium.png', NULL, NULL, '2', '2024-04-08 04:44:13', NULL),
(6, '2', '1', 'Screenshot (40)', 'uploads/Bharat Tech  Pvt Ltd/1712551453_Screenshot (40).png', 'uploads/Bharat Tech  Pvt Ltd/1712551453_Screenshot (40).mp3', NULL, '2', '2024-04-08 04:44:13', '2024-04-23 17:30:26'),
(7, '2', '1', 'biding', 'uploads/Bharat Tech  Pvt Ltd/1712551453_biding.png', NULL, NULL, '3', '2024-04-08 04:44:13', '2024-04-23 17:30:54'),
(8, '2', '1', 'dealclose', 'uploads/Bharat Tech  Pvt Ltd/1712551453_dealclose.png', NULL, NULL, '5', '2024-04-08 04:44:13', NULL),
(9, '5', '3', 'front', 'uploads/abc/1712668437_front.png', NULL, NULL, '16', '2024-04-09 13:13:57', '2024-04-28 16:18:26'),
(10, '5', '3', 'page11', 'uploads/abc/1712668437_page1.png', NULL, '', '17', '2024-04-09 13:13:57', '2024-04-28 16:18:26'),
(11, '5', '3', 'page2', 'uploads/abc/1712668437_page2.png', NULL, NULL, '11', '2024-04-09 13:13:57', '2024-04-28 16:18:26'),
(12, '5', '3', 'page3', 'uploads/abc/1712668437_page3.png', NULL, NULL, '12', '2024-04-09 13:13:57', '2024-04-28 16:18:26'),
(13, '5', '3', 'page44', 'uploads/abc/1712668437_page4.png', NULL, '', '13', '2024-04-09 13:13:57', '2024-04-28 16:18:26'),
(14, '5', '3', 'page5', 'uploads/abc/1712668437_page5.png', NULL, NULL, '14', '2024-04-09 13:13:57', '2024-04-28 16:18:26'),
(15, '5', '4', 'Dencal k2', 'uploads/abc/1713003067_Dencal k2.png', NULL, NULL, '4', '2024-04-13 10:11:07', NULL),
(16, '5', '4', 'Kofrage-DX', 'uploads/abc/1713003067_Kofrage-DX.png', NULL, NULL, '2', '2024-04-13 10:11:07', '2024-04-24 08:43:33'),
(17, '5', '4', 'Lyfin-M', 'uploads/abc/1713003067_Lyfin-M.png', NULL, NULL, '1', '2024-04-13 10:11:07', '2024-04-24 08:43:33'),
(18, '5', '4', 'Retrival', 'uploads/abc/1713003067_Retrival.png', NULL, NULL, '3', '2024-04-13 10:11:07', '2024-04-23 17:50:23'),
(19, '5', '5', 'LULOCT-Derma', 'uploads/abc/1713003193_LULOCT-Derma.png', NULL, NULL, '1', '2024-04-13 10:13:13', NULL),
(20, '5', '5', 'LULOCT-Gyn', 'uploads/abc/1713003193_LULOCT-Gyn.png', NULL, NULL, '2', '2024-04-13 10:13:13', NULL),
(21, '5', '5', 'Eboctin', 'uploads/abc/1713003193_Eboctin.png', NULL, NULL, '3', '2024-04-13 10:13:13', NULL),
(22, '5', '5', 'BILACOTIN-M', 'uploads/abc/1713003193_BILACOTIN-M.png', NULL, NULL, '4', '2024-04-13 10:13:13', NULL),
(23, '5', '5', 'XOLTAN-MR', 'uploads/abc/1713003193_XOLTAN-MR.png', NULL, NULL, '5', '2024-04-13 10:13:13', NULL),
(24, '5', '5', 'INSTANT GEL', 'uploads/abc/1713003193_INSTANT GEL.png', NULL, NULL, '6', '2024-04-13 10:13:13', NULL),
(25, '5', '5', 'RABOCTIN', 'uploads/abc/1713003193_RABOCTIN.png', NULL, NULL, '7', '2024-04-13 10:13:13', NULL),
(26, '5', '5', 'BENANC', 'uploads/abc/1713003193_BENANC.png', NULL, NULL, '8', '2024-04-13 10:13:13', NULL),
(27, '5', '5', 'EVITANC', 'uploads/abc/1713003193_EVITANC.png', NULL, NULL, '9', '2024-04-13 10:13:13', NULL),
(28, '5', '5', 'MVETA-O', 'uploads/abc/1713003193_MVETA-O.png', NULL, NULL, '11', '2024-04-13 10:13:13', '2024-04-23 17:49:56'),
(29, '5', '5', 'MVETA-Plus', 'uploads/abc/1713003193_MVETA-Plus.png', NULL, NULL, '10', '2024-04-13 10:13:13', '2024-04-23 17:49:56'),
(30, '5', '5', 'Restore Capsule', 'uploads/abc/1713003193_Restore Capsule.png', NULL, NULL, '12', '2024-04-13 10:13:13', NULL),
(31, '5', '5', 'TANOCT', 'uploads/abc/1713003193_TANOCT.png', NULL, NULL, '13', '2024-04-13 10:13:13', NULL),
(32, '5', '3', 'Ants4u-DV', 'uploads/abc/1713093299_Ants4u-DV.png', 'uploads/abc/1714105697_mp3', '', '18', '2024-04-14 11:14:59', '2024-04-28 16:18:26'),
(36, '5', '6', '3Sum-D3', 'uploads/abc/1713185913_3Sum-D3.png', '', '', '3', '2024-04-15 12:58:33', '2024-04-23 17:34:51'),
(37, '5', '6', 'Boostpro-S', 'uploads/abc/1713185913_Boostpro-S.png', NULL, NULL, '2', '2024-04-15 12:58:33', '2024-04-23 17:34:44'),
(38, '5', '6', 'Calsoya-D', 'uploads/abc/1713185913_Calsoya-D.png', NULL, NULL, '1', '2024-04-15 12:58:33', '2024-04-23 17:34:44'),
(39, '5', '6', '27-271499-hormone-free-milk-milk-and-eggs-png', 'uploads/abc/1713203217_27-271499_hormone-free-milk-milk-and-eggs-png.png', '', '', '4', '2024-04-15 17:46:57', '2024-04-24 22:19:22'),
(52, '5', '3', 'Page 6 test', 'uploads/abc/1714295695_IMG_1893.webp', NULL, '', '15', NULL, '2024-04-28 16:18:26');

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
(30, '2014_10_12_000000_create_users_table', 1),
(31, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(32, '2019_08_19_000000_create_failed_jobs_table', 1),
(33, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(34, '2022_11_01_000001_create_features_table', 1),
(35, '2024_03_29_165348_price', 1),
(36, '2024_03_30_162315_primary_plan', 1),
(37, '2024_03_30_162606_purchased_credits', 1),
(38, '2024_04_02_014300_mr_package_allotment', 1),
(39, '2024_04_02_014337_mr_manger_allotment', 1),
(40, '2024_04_02_153150_planallotment', 1),
(41, '2024_04_04_054448_books', 1),
(42, '2024_04_04_171950_innerpages', 1),
(43, '2024_04_05_060730_coupens', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notify_mr`
--

CREATE TABLE `notify_mr` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mr_id` varchar(255) DEFAULT NULL,
  `is_notify` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notify_mr`
--

INSERT INTO `notify_mr` (`id`, `mr_id`, `is_notify`, `created_at`, `updated_at`) VALUES
(1, '7', '1', '2024-04-21 01:08:23', '2024-04-26 11:28:26'),
(2, '8', '1', '2024-04-21 01:08:23', '2024-04-26 11:28:26'),
(3, '9', '1', '2024-04-21 01:08:23', '2024-04-26 11:28:26'),
(4, '10', '1', '2024-04-21 01:08:23', '2024-04-26 11:28:26'),
(5, '11', '1', '2024-04-21 01:08:23', '2024-04-26 11:28:26'),
(6, '12', '1', '2024-04-21 01:08:23', '2024-04-26 11:28:26'),
(7, '13', '0', '2024-04-21 01:08:23', '2024-04-26 11:28:33'),
(8, '16', '1', '2024-04-24 21:51:16', '2024-04-26 11:28:26'),
(9, '17', '1', '2024-04-24 21:51:16', '2024-04-26 11:28:26'),
(10, '18', '1', '2024-04-24 21:51:16', '2024-04-26 11:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `subquestion_id` int(11) DEFAULT 0,
  `option` longtext DEFAULT NULL,
  `point` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `subquestion_id`, `option`, `point`, `created_at`) VALUES
(1, 1, 0, ' 18+ - 30', '2', '2024-05-09 17:09:58'),
(2, 1, 0, ' 30+ - 45', '1.5', '2024-05-09 17:09:58'),
(3, 1, 0, ' 45+ - 60', '1', '2024-05-09 17:09:58'),
(4, 1, 0, ' 60+', '0.5', '2024-05-09 17:09:58'),
(5, 2, 0, ' More than 50%', '3', '2024-05-09 17:14:59'),
(6, 2, 0, '25-50%', '2', '2024-05-09 17:14:59'),
(7, 2, 0, '10-25%', '1', '2024-05-09 17:14:59'),
(8, 2, 0, 'None', '0', '2024-05-09 17:14:59'),
(9, 3, 0, ' 5k-50k', '3', '2024-05-09 17:16:20'),
(10, 3, 0, ' 50k-1 lacs', '2', '2024-05-09 17:16:20'),
(11, 3, 0, ' 1 lacs-3 lacs', '1', '2024-05-09 17:16:20'),
(12, 3, 0, ' More than 3 lacs', '0', '2024-05-09 17:16:20'),
(13, 4, 0, 'Only Intraday\r\n', '3', '2024-05-09 17:17:46'),
(14, 4, 0, 'Intraday + Short Term (Days to Month)', '2', '2024-05-09 17:17:46'),
(15, 4, 0, 'Short Term + Medium Term (Month to Year)', '1', '2024-05-09 17:17:46'),
(16, 4, 0, 'Long Term (More than Year)', '0', '2024-05-09 17:17:46'),
(17, 5, 0, 'Below 3 lac', '3', '2024-05-09 17:20:05'),
(18, 5, 0, '3-5 lac\r\n', '2', '2024-05-09 17:20:05'),
(19, 5, 0, '5-10 lac', '1', '2024-05-09 17:20:05'),
(20, 5, 0, '10 lac', '0', '2024-05-09 17:20:05'),
(21, 6, 0, '0-1 Years', '3', '2024-05-09 17:21:35'),
(22, 6, 0, '1-3 Years', '2', '2024-05-09 17:21:35'),
(23, 6, 0, '3-5 Years', '1', '2024-05-09 17:21:35'),
(24, 6, 0, 'More than 5 years', '0', '2024-05-09 17:21:35'),
(25, 7, 1, 'Salary', '0', '2024-05-09 17:23:35'),
(26, 7, 1, 'Business', '1', '2024-05-09 17:23:35'),
(27, 7, 1, 'Student', '3', '2024-05-09 17:23:35'),
(28, 7, 1, 'Retired', '2', '2024-05-09 17:23:35'),
(29, 7, 2, 'Income from house property', '0', '2024-05-09 17:25:48'),
(30, 7, 2, 'Income from bank FD/Interest or other\r\n', '1', '2024-05-09 17:25:48'),
(31, 7, 2, 'Income from other source', '0.5', '2024-05-09 17:25:48'),
(32, 7, 2, 'None', '2', '2024-05-09 17:25:48'),
(33, 8, 0, '1%-5%', '0', '2024-05-09 17:27:08'),
(34, 8, 0, '5%-10%', '1', '2024-05-09 17:27:08'),
(35, 8, 0, '10%-15%', '2', '2024-05-09 17:27:08'),
(36, 8, 0, 'More than 15%', '3', '2024-05-09 17:27:08'),
(37, 9, 0, 'None', '0', '2024-05-09 17:28:14'),
(38, 9, 0, '1-2\r\n', '1', '2024-05-09 17:28:14'),
(39, 9, 0, '2-3', '2', '2024-05-09 17:28:14'),
(40, 9, 0, '3+', '3', '2024-05-09 17:28:14'),
(41, 10, 0, 'Do not have', '3', '2024-05-09 17:31:01'),
(42, 10, 0, '1-3 months income', '2', '2024-05-09 17:31:01'),
(43, 10, 0, '3-6 months income', '1', '2024-05-09 17:31:01'),
(44, 10, 0, '6 months income', '0', '2024-05-09 17:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `packageallotment`
--

CREATE TABLE `packageallotment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mr_id` varchar(255) DEFAULT NULL,
  `plan_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `planallotments`
--

CREATE TABLE `planallotments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mr_id` varchar(255) DEFAULT NULL,
  `plan_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plantype`
--

CREATE TABLE `plantype` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plantype`
--

INSERT INTO `plantype` (`id`, `name`, `created_at`, `updated_at`) VALUES
(7, 'Manager', '2024-05-07 19:44:42', '2024-05-07 19:47:01'),
(8, 'Customer Associate', '2024-05-07 19:48:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `type`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Monthly', '400', '2024-04-08 04:38:47', NULL),
(2, 'Half Yearly', '500', '2024-04-08 04:38:51', NULL),
(4, 'Annually', '3000', '2024-04-24 10:09:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `primaryplans`
--

CREATE TABLE `primaryplans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `expiry_date` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `coupen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `primaryplans`
--

INSERT INTO `primaryplans` (`id`, `company_id`, `type`, `totalamount`, `expiry_date`, `quantity`, `coupen`, `created_at`, `updated_at`) VALUES
(1, '2', 'Monthly', '1600', '2024-05-08 04:45:25', '4', NULL, '2024-04-08 04:45:25', NULL),
(2, '5', 'Monthly', '2400', '2024-05-08 16:34:09', '6', 'holi10', '2024-04-08 16:34:09', NULL),
(3, '5', 'Monthly', '472', '2024-05-09 13:05:32', '1', NULL, '2024-04-09 13:05:32', NULL),
(4, '5', 'Monthly', '424', '2024-05-15 17:42:37', '1', 'coupen2', '2024-04-15 17:42:37', NULL),
(5, '5', 'Monthly', '424', '2024-05-15 17:43:37', '1', 'coupen2', '2024-04-15 17:43:37', NULL),
(6, '5', 'Monthly', '472', '2024-05-15 17:44:14', '1', NULL, '2024-04-15 17:44:14', NULL),
(7, '5', 'Half Yearly', '590', '2024-10-24 02:45:16', '1', NULL, '2024-04-24 09:45:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchasedcredits`
--

CREATE TABLE `purchasedcredits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `plan_id` varchar(255) DEFAULT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `alloted_user_id` varchar(255) DEFAULT NULL,
  `alloted_date` varchar(255) DEFAULT NULL,
  `expiry_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchasedcredits`
--

INSERT INTO `purchasedcredits` (`id`, `company_id`, `plan_id`, `unique_code`, `alloted_user_id`, `alloted_date`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, '2', '1', 'Bh1', '4', '2024-04-08 04:46:07', '2024-05-08 04:45:25', '2024-04-08 04:45:25', '2024-04-08 04:46:07'),
(2, '2', '1', 'Bh2', NULL, NULL, '2024-05-08 04:45:25', '2024-04-08 04:45:25', NULL),
(3, '2', '1', 'Bh3', NULL, NULL, '2024-05-08 04:45:25', '2024-04-08 04:45:25', NULL),
(4, '2', '1', 'Bh4', NULL, NULL, '2024-05-08 04:45:25', '2024-04-08 04:45:25', NULL),
(5, '5', '2', 'ab1', '7', '2024-04-08 16:34:48', '2024-05-08 16:34:09', '2024-04-08 16:34:09', '2024-05-02 16:00:46'),
(6, '5', '2', 'ab2', '8', '2024-04-08 16:36:06', '2024-05-08 16:34:09', '2024-04-08 16:34:09', '2024-04-24 09:22:05'),
(7, '5', '2', 'ab3', '9', '2024-04-08 16:36:33', '2024-05-20 16:34:09', '2024-04-08 16:34:09', '2024-04-17 19:33:03'),
(8, '5', '2', 'ab4', '10', '2024-04-08 16:37:08', '2024-05-08 16:34:09', '2024-04-08 16:34:09', '2024-04-08 16:37:08'),
(9, '5', '2', 'ab5', '11', '2024-04-08 16:37:33', '2024-05-30 16:34:09', '2024-04-08 16:34:09', '2024-05-02 16:28:00'),
(10, '5', '2', 'ab6', '12', '2024-04-08 16:37:56', '2024-05-08 16:34:09', '2024-04-08 16:34:09', '2024-04-08 16:37:56'),
(11, '5', '3', 'ab7', '13', '2024-04-09 13:06:03', '2024-05-20 13:05:32', '2024-04-09 13:05:32', '2024-04-14 16:51:20'),
(12, '5', '4', 'ab8', '16', '2024-04-24 02:27:03', '2024-05-15 17:42:37', '2024-04-15 17:42:37', '2024-04-24 09:27:03'),
(13, '5', '5', 'ab9', '17', '2024-04-24 02:29:54', '2024-05-15 17:43:37', '2024-04-15 17:43:37', '2024-04-24 09:29:54'),
(14, '5', '6', 'ab10', '18', '2024-04-24 02:30:32', '2024-05-15 17:44:14', '2024-04-15 17:44:14', '2024-04-24 09:30:32'),
(15, '5', '7', 'ab11', NULL, NULL, '2024-10-24 02:45:16', '2024-04-24 09:45:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `created_at`) VALUES
(1, '1. What is your current Age?', '2024-05-09 17:04:52'),
(2, '2. What percentage (%) of monthly income allocated to pay off debt (all EMI’s)', '2024-05-09 17:04:52'),
(3, '3. Proposed Investment Amount', '2024-05-09 17:04:52'),
(4, '4. Preferred Investment time horizon', '2024-05-09 17:04:52'),
(5, '5. Annual Income details:', '2024-05-09 17:04:52'),
(6, '6. Investment Experience:', '2024-05-09 17:04:52'),
(7, '7. What are the primary sources of Income:', '2024-05-09 17:04:52'),
(8, '8. Risk tolerance limit per trade(As per the stock value)', '2024-05-09 17:04:52'),
(9, '9. How many dependents do you financially support? ', '2024-05-09 17:04:52'),
(10, '10. What is the size of your emergency fund? ', '2024-05-09 17:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `risk`
--

CREATE TABLE `risk` (
  `id` int(11) NOT NULL,
  `name` longtext DEFAULT NULL,
  `email` longtext DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `assess_name` varchar(255) DEFAULT NULL,
  `previous_advisory` varchar(255) NOT NULL DEFAULT '',
  `firm` varchar(255) DEFAULT NULL,
  `previous_loss` varchar(255) DEFAULT NULL,
  `loss_percentage` varchar(255) DEFAULT NULL,
  `liability` varchar(255) DEFAULT NULL,
  `other_Liability` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `ever_did_trade` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subquestions`
--

CREATE TABLE `subquestions` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `question` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subquestions`
--

INSERT INTO `subquestions` (`id`, `question_id`, `question`, `created_at`) VALUES
(1, 7, 'A. Primary Source', '2024-05-09 17:07:02'),
(2, 7, 'B. Secondary Source', '2024-05-09 17:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `userresponse`
--

CREATE TABLE `userresponse` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `point` varchar(211) DEFAULT NULL,
  `risk_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `joining_date` varchar(211) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gst` varchar(255) DEFAULT NULL,
  `registered_office` varchar(255) DEFAULT NULL,
  `license_cost` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `add_by` varchar(255) DEFAULT NULL,
  `work_area` longtext DEFAULT NULL,
  `can_create_mr` varchar(255) NOT NULL DEFAULT '0',
  `can_create_books` varchar(255) NOT NULL DEFAULT '0',
  `flag` varchar(255) NOT NULL DEFAULT '0' COMMENT 'Here 0 is inactive and 1 is active',
  `remember_token` varchar(100) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `is_paused` int(11) NOT NULL DEFAULT 0,
  `paused_till` varchar(211) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `is_loggedin` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `username`, `email`, `company_name`, `email_verified_at`, `password`, `joining_date`, `phone`, `gst`, `registered_office`, `license_cost`, `company_id`, `add_by`, `work_area`, `can_create_mr`, `can_create_books`, `flag`, `remember_token`, `otp`, `is_paused`, `paused_till`, `logo`, `is_loggedin`, `created_at`, `updated_at`) VALUES
(1, 'Grow Fortuna', 'admin', NULL, 'growfortuna@gmail.com', 'Grow Fortuna', NULL, '$2y$10$R9ZfVh6ZrMCbbbumsq2szOQT7FMFHIbc/dhIeXpGpc73gywONJWua', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '1', NULL, 123456, 0, NULL, 'uploads/Grow Fortuna/1715129210.webp', 0, NULL, '2024-05-07 19:16:50'),
(20, 'Bhavesh Kapoor', 'Manager', NULL, 'bhaveshkapoor09@gmail.com', NULL, NULL, '$2y$10$zXSKtzV73XhKJZhp.PgHFuC1chupD7NaVI8nMxPPIChiEjSOoLbY2', '2024-05-08', '8595529873', NULL, 'test', NULL, NULL, NULL, NULL, '0', '0', '1', NULL, NULL, 0, NULL, NULL, 1, '2024-05-07 20:11:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allotmanagers`
--
ALTER TABLE `allotmanagers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupens`
--
ALTER TABLE `coupens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_report`
--
ALTER TABLE `doctor_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `features_name_scope_unique` (`name`,`scope`);

--
-- Indexes for table `innerpages`
--
ALTER TABLE `innerpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify_mr`
--
ALTER TABLE `notify_mr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packageallotment`
--
ALTER TABLE `packageallotment`
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
-- Indexes for table `planallotments`
--
ALTER TABLE `planallotments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plantype`
--
ALTER TABLE `plantype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `primaryplans`
--
ALTER TABLE `primaryplans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchasedcredits`
--
ALTER TABLE `purchasedcredits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk`
--
ALTER TABLE `risk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subquestions`
--
ALTER TABLE `subquestions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userresponse`
--
ALTER TABLE `userresponse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_company_name_unique` (`company_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allotmanagers`
--
ALTER TABLE `allotmanagers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `coupens`
--
ALTER TABLE `coupens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `doctor_report`
--
ALTER TABLE `doctor_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `innerpages`
--
ALTER TABLE `innerpages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `notify_mr`
--
ALTER TABLE `notify_mr`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `packageallotment`
--
ALTER TABLE `packageallotment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planallotments`
--
ALTER TABLE `planallotments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plantype`
--
ALTER TABLE `plantype`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `primaryplans`
--
ALTER TABLE `primaryplans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchasedcredits`
--
ALTER TABLE `purchasedcredits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `risk`
--
ALTER TABLE `risk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subquestions`
--
ALTER TABLE `subquestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userresponse`
--
ALTER TABLE `userresponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
