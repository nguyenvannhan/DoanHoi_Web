-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 03, 2018 at 04:19 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vannhan_cyu_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `leader` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_regis_date` date NOT NULL,
  `end_regis_date` date NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `school_year_id` int(10) UNSIGNED NOT NULL,
  `conduct_mark` tinyint(3) UNSIGNED NOT NULL,
  `social_mark` tinyint(3) UNSIGNED NOT NULL,
  `activity_level` tinyint(3) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED DEFAULT NULL,
  `trailer` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_regis_number` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activities_leader_foreign` (`leader`),
  KEY `activities_class_id_foreign` (`class_id`),
  KEY `activities_school_year_id_foreign` (`school_year_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attenders`
--

DROP TABLE IF EXISTS `attenders`;
CREATE TABLE IF NOT EXISTS `attenders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) UNSIGNED NOT NULL,
  `student_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `time_id` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `check` tinyint(1) NOT NULL DEFAULT '0',
  `conduct_mark` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `social_mark` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `minus_conduct_mark` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `minus_social_mark` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attenders_activity_id_student_id_unique` (`activity_id`,`student_id`),
  KEY `attenders_student_id_foreign` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `check_number`
--

DROP TABLE IF EXISTS `check_number`;
CREATE TABLE IF NOT EXISTS `check_number` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) UNSIGNED NOT NULL,
  `student_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `check_number_activity_id_student_id_unique` (`activity_id`,`student_id`),
  KEY `check_number_student_id_foreign` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `science_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `classes_name_unique` (`name`),
  KEY `classes_science_id_foreign` (`science_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `science_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '139100', 2, NULL, '2018-01-02 20:51:07', '2018-01-02 20:51:07');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

DROP TABLE IF EXISTS `faculties`;
CREATE TABLE IF NOT EXISTS `faculties` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faculties_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Công nghệ Thông Tin', NULL, NULL, NULL),
(2, 'CN Hóa học & Thực Phẩm', NULL, NULL, NULL),
(3, 'Cơ khí Chế tạo máy', NULL, NULL, NULL),
(4, 'CN may và Thời trang', NULL, NULL, NULL),
(5, 'ĐT Chất lượng cao', NULL, NULL, NULL),
(6, 'Điện - Điện tử', NULL, NULL, NULL),
(7, 'In - Truyền Thông', NULL, NULL, NULL),
(8, 'Khoa học Ứng dụng', NULL, NULL, NULL),
(9, 'Kinh tế', NULL, NULL, NULL),
(10, 'Xây dựng', NULL, NULL, NULL),
(11, 'Ngoại ngữ', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

-- --------------------------------------------------------

--
-- Table structure for table `school_years`
--

DROP TABLE IF EXISTS `school_years`;
CREATE TABLE IF NOT EXISTS `school_years` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `school_years_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `school_years`
--

INSERT INTO `school_years` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2017 - 2018', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sciences`
--

DROP TABLE IF EXISTS `sciences`;
CREATE TABLE IF NOT EXISTS `sciences` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sciences_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sciences`
--

INSERT INTO `sciences` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2012', NULL, NULL, NULL),
(2, '2013', NULL, NULL, NULL),
(3, '2014', NULL, NULL, NULL),
(4, '2015', NULL, NULL, NULL),
(5, '2016', NULL, NULL, NULL),
(6, '2017', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(10) UNSIGNED DEFAULT NULL,
  `science_id` int(10) UNSIGNED NOT NULL,
  `is_female` tinyint(1) NOT NULL DEFAULT '1',
  `is_cyu` tinyint(1) NOT NULL DEFAULT '1',
  `partisan_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `hometown` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `social_mark` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `is_it_student` tinyint(1) NOT NULL DEFAULT '1',
  `faculty_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_number_phone_unique` (`number_phone`),
  UNIQUE KEY `students_email_unique` (`email`),
  KEY `students_science_id_foreign` (`science_id`),
  KEY `students_class_id_foreign` (`class_id`),
  KEY `students_faculty_id_foreign` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `class_id`, `science_id`, `is_female`, `is_cyu`, `partisan_id`, `hometown`, `number_phone`, `birthday`, `email`, `social_mark`, `status`, `is_it_student`, `faculty_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
('13110113', 'Nguyen Van Nhan', 1, 2, 0, 1, 0, NULL, '01219833537', '1995-10-08', 'nguyenvannhan0810@gmail.com', 0, 1, 1, 1, NULL, '2018-01-02 20:55:39', '2018-01-02 20:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_student_id_unique` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_id`, `password`, `remember_token`, `level`, `created_at`, `updated_at`) VALUES
(2, 'admin', '$2y$10$6NPZfbhhGdslXUaeaOSnd.sR3pPZQBtJs9kvOBGJpQQMYRzOz2pMe', '08h3XdexKTClPu5TSTPf4qC4yBYgZwhxz2P3rNon6ZghT9VhjI9Yxgwpwbrc', 0, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activities_leader_foreign` FOREIGN KEY (`leader`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activities_school_year_id_foreign` FOREIGN KEY (`school_year_id`) REFERENCES `school_years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attenders`
--
ALTER TABLE `attenders`
  ADD CONSTRAINT `attenders_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attenders_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `check_number`
--
ALTER TABLE `check_number`
  ADD CONSTRAINT `check_number_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `check_number_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_science_id_foreign` FOREIGN KEY (`science_id`) REFERENCES `sciences` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_science_id_foreign` FOREIGN KEY (`science_id`) REFERENCES `sciences` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
