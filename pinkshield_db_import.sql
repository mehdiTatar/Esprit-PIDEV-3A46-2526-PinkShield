-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2026 at 06:21 PM
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
-- Database: `pinkshield_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `auth_code` varchar(10) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `auth_code`, `email`, `roles`, `password`) VALUES
(1, NULL, 'admin@pinkshield.com', '[\"ROLE_ADMIN\"]', '$2y$13$R.dNvQ8jG2dX.9lfnT1UGOshj2tumE3ur4ZalgS7ZvuKbT2nEPdMm');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `patient_email` varchar(180) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `doctor_email` varchar(180) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `patient_email`, `patient_name`, `doctor_email`, `doctor_name`, `appointment_date`, `status`, `notes`, `created_at`) VALUES
(1, 'user1@pinkshield.com', 'Patient User 1', 'doctor1@pinkshield.com', 'Doctor 1', '2026-03-09 15:03:10', 'confirmed', 'Sample appointment 1 for user 1', '2026-03-01 14:03:10'),
(2, 'user1@pinkshield.com', 'Patient User 1', 'doctor1@pinkshield.com', 'Doctor 1', '2026-03-10 15:03:10', 'confirmed', 'Sample appointment 2 for user 1', '2026-03-01 14:03:10'),
(3, 'user1@pinkshield.com', 'Patient User 1', 'doctor1@pinkshield.com', 'Doctor 1', '2026-03-11 15:03:10', 'Cancelled', 'Sample appointment 3 for user 1', '2026-03-01 14:03:10'),
(4, 'user2@pinkshield.com', 'Patient User 2', 'doctor2@pinkshield.com', 'Doctor 2', '2026-03-11 15:03:10', 'confirmed', 'Sample appointment 1 for user 2', '2026-03-01 14:03:10'),
(5, 'user2@pinkshield.com', 'Patient User 2', 'doctor2@pinkshield.com', 'Doctor 2', '2026-03-12 15:03:10', 'confirmed', 'Sample appointment 2 for user 2', '2026-03-01 14:03:10'),
(6, 'user2@pinkshield.com', 'Patient User 2', 'doctor2@pinkshield.com', 'Doctor 2', '2026-03-13 15:03:10', 'pending', 'Sample appointment 3 for user 2', '2026-03-01 14:03:10'),
(7, 'user3@pinkshield.com', 'Patient User 3', 'doctor3@pinkshield.com', 'Doctor 3', '2026-03-13 15:03:10', 'Cancelled', 'Sample appointment 1 for user 3', '2026-03-01 14:03:10'),
(8, 'user3@pinkshield.com', 'Patient User 3', 'doctor3@pinkshield.com', 'Doctor 3', '2026-03-14 15:03:10', 'Cancelled', 'Sample appointment 2 for user 3', '2026-03-01 14:03:10'),
(9, 'user3@pinkshield.com', 'Patient User 3', 'doctor3@pinkshield.com', 'Doctor 3', '2026-03-15 15:03:10', 'pending', 'Sample appointment 3 for user 3', '2026-03-01 14:03:10'),
(10, 'user4@pinkshield.com', 'Patient User 4', 'doctor4@pinkshield.com', 'Doctor 4', '2026-03-15 15:03:10', 'confirmed', 'Sample appointment 1 for user 4', '2026-03-01 14:03:10'),
(11, 'user4@pinkshield.com', 'Patient User 4', 'doctor4@pinkshield.com', 'Doctor 4', '2026-04-30 15:03:10', 'Cancelled', 'Sample appointment 2 for user 4', '2026-03-01 14:03:10'),
(12, 'user4@pinkshield.com', 'Patient User 4', 'doctor4@pinkshield.com', 'Doctor 4', '2026-03-17 15:03:10', 'pending', 'Sample appointment 3 for user 4', '2026-03-01 14:03:10'),
(13, 'user5@pinkshield.com', 'Patient User 5', 'doctor5@pinkshield.com', 'Doctor 5', '2026-03-17 15:03:10', 'confirmed', 'Sample appointment 1 for user 5', '2026-03-01 14:03:10'),
(14, 'user5@pinkshield.com', 'Patient User 5', 'doctor5@pinkshield.com', 'Doctor 5', '2026-03-18 15:03:10', 'confirmed', 'Sample appointment 2 for user 5', '2026-03-01 14:03:10'),
(15, 'user5@pinkshield.com', 'Patient User 5', 'doctor5@pinkshield.com', 'Doctor 5', '2026-03-19 15:03:10', 'pending', 'Sample appointment 3 for user 5', '2026-03-01 14:03:10'),
(16, 'fadydrissi3@gmail.com', 'fady drissi', 'doctor2@pinkshield.com', 'Doctor 2', '2026-03-30 21:10:00', 'pending', 'heart attacks every 4 hours', '2026-03-01 14:04:51'),
(23, 'ffff@gmail.com', 'fffff', 'doc@test.com', 'ffff', '2026-04-30 14:55:00', 'pending', 'heart attacks', '2026-04-16 00:35:16'),
(24, 'ssss@gmail.com', 'sss', 'doc@test.com', 'ddddsss', '2026-05-20 20:00:00', 'Confirmed', 'dddddddsss', '2026-04-16 00:36:47'),
(25, 'fadydrissi@gmail.com', 'drissi fady', 'doc@test.com', 'Dr.ahmed', '2026-05-01 11:00:00', 'Confirmed', '', '2026-04-16 11:14:54'),
(26, 'fadydrissi9@gmail.com', 'fady drissi', 'kais.hamza@pinkshield.tn', 'Dr. Kais Hamza', '2026-05-01 17:00:00', 'Confirmed', 'j\'ai mal à la gorge', '2026-04-28 15:58:08'),
(27, 'fadydrissi9@gmail.com', 'fady drissi', 'wafa.cherif@pinkshield.tn', 'Dr. Wafa Cherif', '2026-05-02 15:00:00', 'Confirmed', 'j\'ai un peu mal à la tete et j\'ai des douleurs dans les pieds', '2026-04-29 13:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(190) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'PATIENT',
  `specialty` varchar(120) DEFAULT NULL,
  `medical_license_id` varchar(80) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `full_name`, `email`, `password_hash`, `role`, `specialty`, `medical_license_id`, `created_at`) VALUES
(1, 'fady drissi', 'fadydrissi4@gmail.com', 'sha256$256c8d3e682375a0ed8e59de5f8e34f8f76de4286a2fcd2adb8d0ce79b9cc007', 'ADMIN', 'cardiologue', '543', '2026-04-19 18:23:24'),
(2, 'fady drissii', 'fadydrissi2@gmail.com', 'sha256$256c8d3e682375a0ed8e59de5f8e34f8f76de4286a2fcd2adb8d0ce79b9cc007', 'PATIENT', NULL, NULL, '2026-04-19 18:37:20'),
(3, 'fady drissi', 'fadydrissi9@gmail.com', '$2a$12$I.TnHWt7GI6w19am8EFtUO9lHFFbUmSgaN4c/m28tTfgot9icGCDe', 'PATIENT', NULL, NULL, '2026-04-28 15:56:13'),
(4, 'drissi fady', 'fadydrissi7@gmail.com', '$2a$12$Ud3g5Pcu8FQSxv/XXnXkZO5l3EbSgczs5sqBvZw07f.MsldaDJ6v2', 'PATIENT', NULL, NULL, '2026-05-04 11:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `author_email` varchar(180) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_role` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `blog_post_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `author_email` varchar(180) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_tracking`
--

CREATE TABLE `daily_tracking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `mood` int(11) NOT NULL,
  `stress` int(11) NOT NULL,
  `activities` longtext DEFAULT NULL,
  `anxiety_level` int(11) DEFAULT NULL,
  `focus_level` int(11) DEFAULT NULL,
  `motivation_level` int(11) DEFAULT NULL,
  `social_interaction_level` int(11) DEFAULT NULL,
  `sleep_hours` int(11) DEFAULT NULL,
  `energy_level` int(11) DEFAULT NULL,
  `symptoms` longtext DEFAULT NULL,
  `medication_taken` tinyint(1) DEFAULT NULL,
  `appetite_level` int(11) DEFAULT NULL,
  `water_intake` int(11) DEFAULT NULL,
  `physical_activity_level` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `auth_code` varchar(10) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `auth_code`, `email`, `roles`, `password`, `first_name`, `last_name`, `speciality`, `address`, `phone`, `status`) VALUES
(1, NULL, 'doctor1@pinkshield.com', '[\"ROLE_DOCTOR\"]', '$2y$13$7PaRDvQrZX6gQbzRUvq5eOJ2iaFBbwm1GBhWeys.eauHL9lXUvrZe', 'Doctor', '1', 'Cardiology', NULL, NULL, 'active'),
(2, NULL, 'doctor2@pinkshield.com', '[\"ROLE_DOCTOR\"]', '$2y$13$pe9iJdK70V30fK5lYexNBuiD8RrVvbg8uB1lqvA98bIiCnlxOVOhC', 'Doctor', '2', 'Dermatology', NULL, NULL, 'active'),
(3, NULL, 'doctor3@pinkshield.com', '[\"ROLE_DOCTOR\"]', '$2y$13$VzYoXt0yAaXOsfNZN1lDBOSTAA47kw7D8/MbMLyn/VJCel2PQE6EK', 'Doctor', '3', 'Neurology', NULL, NULL, 'active'),
(4, NULL, 'doctor4@pinkshield.com', '[\"ROLE_DOCTOR\"]', '$2y$13$mf9M5rj6fzzUrP8mEfDuBONUM.LiwefVX2ZVHm7TUyLExJraZzjau', 'Doctor', '4', 'Orthopedics', NULL, NULL, 'active'),
(5, NULL, 'doctor5@pinkshield.com', '[\"ROLE_DOCTOR\"]', '$2y$13$35sa4MomnL1VLzEsLkdm.eJDcWide7psQk5.cIp2orBRnvlT5aVQO', 'Doctor', '5', 'Pediatrics', NULL, NULL, 'active'),
(6, NULL, 'doctor6@pinkshield.com', '[\"ROLE_DOCTOR\"]', '$2y$13$dDk1O/U2LQeI4OTOVTMmTuY4ojgHVlZZmanKmC9RjDWDQ9idjVeyy', 'Doctor', '6', 'Psychiatry', NULL, NULL, 'active'),
(7, NULL, 'doctor7@pinkshield.com', '[\"ROLE_DOCTOR\"]', '$2y$13$A7mKzcXed8UXzmZXcfPv/eDNYBVBeYn362iJjYDLzLiX58IVhxXfO', 'Doctor', '7', 'Radiology', NULL, NULL, 'active'),
(8, NULL, 'doctor8@pinkshield.com', '[\"ROLE_DOCTOR\"]', '$2y$13$TfBP73prJeFaPdczJnApeeefygIDkBzmGBZrj50.oh2cCade/4Sf6', 'Doctor', '8', 'Surgery', NULL, NULL, 'active'),
(9, NULL, 'doctor9@pinkshield.com', '[\"ROLE_DOCTOR\"]', '$2y$13$U2Jkd07tp8Nb4aHxWx8R.OvffTqCAIwZrzS5egxK5dkaYq3dR2UPu', 'Doctor', '9', 'Gastroenterology', NULL, NULL, 'active'),
(10, NULL, 'doctor10@pinkshield.com', '[\"ROLE_DOCTOR\"]', '$2y$13$BXaMTkDgPXwncEOv.H876eMgTQJoZApEJbl8TxiRNzDgU9zmlCyRy', 'Doctor', '10', 'Oncology', NULL, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260211144342', '2026-03-01 16:11:50', 355);

-- --------------------------------------------------------

--
-- Table structure for table `health_log`
--

CREATE TABLE `health_log` (
  `id` int(11) NOT NULL,
  `user_email` varchar(180) NOT NULL,
  `mood` int(11) NOT NULL,
  `stress` int(11) NOT NULL,
  `activities` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_log`
--

INSERT INTO `health_log` (`id`, `user_email`, `mood`, `stress`, `activities`, `created_at`) VALUES
(1, 'fadydrissi3@gmail.com', 3, 3, 'Regular day at work, some challenging tasks', '2026-02-28 15:03:10'),
(2, 'fadydrissi3@gmail.com', 5, 1, 'Day off, relaxation, reading', '2026-02-27 15:03:10'),
(3, 'fadydrissi3@gmail.com', 3, 3, 'Regular day at work, some challenging tasks', '2026-02-26 15:03:10'),
(4, 'fadydrissi3@gmail.com', 2, 5, 'Difficult project, lack of sleep', '2026-02-25 15:03:10'),
(5, 'fadydrissi3@gmail.com', 4, 2, 'Work meeting, lunch break, walked to the park', '2026-02-24 15:03:10'),
(6, 'fadydrissi3@gmail.com', 4, 2, 'Work meeting, lunch break, walked to the park', '2026-02-28 15:12:21'),
(7, 'fadydrissi3@gmail.com', 5, 1, 'Morning workout, yoga, meditation', '2026-02-27 15:12:21'),
(8, 'fadydrissi3@gmail.com', 4, 1, 'Swimming, healthy meals, good sleep', '2026-02-26 15:12:21'),
(9, 'fadydrissi3@gmail.com', 3, 4, 'Stressful meeting, tight deadlines', '2026-02-25 15:12:21'),
(10, 'fadydrissi3@gmail.com', 4, 2, 'Gym session, dinner with friends', '2026-02-24 15:12:21'),
(11, 'fadydrissi3@gmail.com', 5, 1, 'Morning workout, yoga, meditation', '2026-02-28 15:33:17'),
(12, 'fadydrissi3@gmail.com', 4, 1, 'Swimming, healthy meals, good sleep', '2026-02-27 15:33:17'),
(13, 'fadydrissi3@gmail.com', 3, 4, 'Stressful meeting, tight deadlines', '2026-02-26 15:33:17'),
(14, 'fadydrissi3@gmail.com', 5, 1, 'Day off, relaxation, reading', '2026-02-25 15:33:17'),
(15, 'fadydrissi3@gmail.com', 2, 5, 'Difficult project, lack of sleep', '2026-02-24 15:33:17'),
(16, 'fadydrissi3@gmail.com', 5, 1, 'Day off, relaxation, reading', '2026-02-28 16:13:53'),
(17, 'fadydrissi3@gmail.com', 2, 5, 'Difficult project, lack of sleep', '2026-02-27 16:13:53'),
(18, 'fadydrissi3@gmail.com', 4, 2, 'Gym session, dinner with friends', '2026-02-26 16:13:53'),
(19, 'fadydrissi3@gmail.com', 2, 5, 'Difficult project, lack of sleep', '2026-02-25 16:13:53'),
(20, 'fadydrissi3@gmail.com', 5, 1, 'Morning workout, yoga, meditation', '2026-02-24 16:13:53'),
(21, 'fadydrissi3@gmail.com', 4, 2, 'Gym session, dinner with friends', '2026-02-28 16:17:29'),
(22, 'fadydrissi3@gmail.com', 2, 5, 'Difficult project, lack of sleep', '2026-02-27 16:17:29'),
(23, 'fadydrissi3@gmail.com', 4, 2, 'Gym session, dinner with friends', '2026-02-26 16:17:29'),
(24, 'fadydrissi3@gmail.com', 4, 2, 'Work meeting, lunch break, walked to the park', '2026-02-25 16:17:29'),
(25, 'fadydrissi3@gmail.com', 4, 1, 'Swimming, healthy meals, good sleep', '2026-02-24 16:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `type` varchar(50) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `admin_id`, `title`, `message`, `type`, `icon`, `is_read`, `created_at`) VALUES
(1, 1, NULL, 'Appointment Cancelled', 'Your appointment scheduled for next Monday has been cancelled. Please reschedule if needed.', 'danger', 'fas fa-calendar-times', 0, '2026-02-28 08:03:10'),
(2, 1, NULL, 'Health Goal Progress', 'Great job! You\'ve achieved 80% of your weekly health goals.', 'success', 'fas fa-trophy', 1, '2026-02-24 10:03:10'),
(3, 1, NULL, 'Medication Reminder', 'Time to take your scheduled medication. Set a reminder on your phone.', 'warning', 'fas fa-clock', 1, '2026-02-25 22:03:10'),
(4, 1, NULL, 'Health Report Updated', 'Your latest health report has been updated. Review your health metrics in the dashboard.', 'success', 'fas fa-chart-line', 1, '2026-02-22 23:12:22'),
(5, 1, NULL, 'Health Goal Progress', 'Great job! You\'ve achieved 80% of your weekly health goals.', 'success', 'fas fa-trophy', 0, '2026-02-24 18:12:22'),
(6, 1, NULL, 'Lab Results Available', 'Your lab test results are now available. Please consult your doctor for interpretation.', 'warning', 'fas fa-flask', 0, '2026-02-27 05:12:22'),
(7, 1, NULL, 'Appointment Reminder', 'You have an appointment scheduled with Dr. Smith tomorrow at 2:00 PM. Please arrive 15 minutes early.', 'info', 'fas fa-calendar-alt', 0, '2026-02-23 23:33:17'),
(8, 1, NULL, 'Doctor Review Request', 'Dr. Johnson has shared feedback on your recent appointment. Read the full review in your messages.', 'info', 'fas fa-comment-medical', 0, '2026-02-25 10:33:17'),
(9, 1, NULL, 'Health Report Updated', 'Your latest health report has been updated. Review your health metrics in the dashboard.', 'success', 'fas fa-chart-line', 0, '2026-02-22 21:33:17'),
(10, NULL, 1, 'New Wishlist Addition', 'fady drissi added \"Oral Rehydration Salts (10)\" to their wishlist', 'info', 'fas fa-heart', 0, '2026-03-01 15:34:54'),
(11, NULL, 1, 'New Wishlist Addition', 'fady drissi added \"Antifungal Cream 15g\" to their wishlist', 'info', 'fas fa-heart', 0, '2026-03-01 15:34:55'),
(12, NULL, 1, 'New Wishlist Addition', 'fady drissi added \"Earwax Removal Drops 15ml\" to their wishlist', 'info', 'fas fa-heart', 0, '2026-03-01 15:34:56'),
(13, NULL, 1, 'New Wishlist Addition', 'fady drissi added \"SunShield SPF50 Sunscreen\" to their wishlist', 'info', 'fas fa-heart', 0, '2026-03-01 15:35:43'),
(14, NULL, 1, 'New Wishlist Addition', 'fady drissi added \"Hydrating Face Moisturizer\" to their wishlist', 'info', 'fas fa-heart', 0, '2026-03-01 15:35:46'),
(15, NULL, 1, 'New Wishlist Addition', 'fady drissi added \"Gentle Baby Wash\" to their wishlist', 'info', 'fas fa-heart', 0, '2026-03-01 15:35:52'),
(16, NULL, 1, 'New Wishlist Addition', 'fady drissi added \"Acne Cleansing Gel 150ml\" to their wishlist', 'info', 'fas fa-heart', 0, '2026-03-01 15:48:39'),
(17, NULL, 1, 'New Wishlist Addition', 'fady drissi added \"Antibacterial Wipes (50)\" to their wishlist', 'info', 'fas fa-heart', 0, '2026-03-01 15:48:40'),
(18, 1, NULL, 'Medication Reminder', 'Time to take your scheduled medication. Set a reminder on your phone.', 'warning', 'fas fa-clock', 0, '2026-02-28 01:13:53'),
(19, 1, NULL, 'Health Report Updated', 'Your latest health report has been updated. Review your health metrics in the dashboard.', 'success', 'fas fa-chart-line', 1, '2026-02-22 20:13:53'),
(20, 1, NULL, 'Lab Results Available', 'Your lab test results are now available. Please consult your doctor for interpretation.', 'warning', 'fas fa-flask', 0, '2026-02-27 23:13:53'),
(21, 1, NULL, 'Health Report Updated', 'Your latest health report has been updated. Review your health metrics in the dashboard.', 'success', 'fas fa-chart-line', 1, '2026-02-28 14:17:29'),
(22, 1, NULL, 'Health Goal Progress', 'Great job! You\'ve achieved 80% of your weekly health goals.', 'success', 'fas fa-trophy', 0, '2026-03-01 06:17:29'),
(23, 1, NULL, 'Appointment Reminder', 'You have an appointment scheduled with Dr. Smith tomorrow at 2:00 PM. Please arrive 15 minutes early.', 'info', 'fas fa-calendar-alt', 1, '2026-02-25 13:17:29'),
(24, NULL, 1, 'New Wishlist Addition', 'fady drissi added \"Calcium + D3 (90)\" to their wishlist', 'info', 'fas fa-heart', 0, '2026-03-01 16:28:21'),
(25, NULL, 1, 'New Wishlist Addition', 'fady drissi added \"Collagen Peptides 250g\" to their wishlist', 'info', 'fas fa-heart', 0, '2026-03-01 16:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `parapharmacie`
--

CREATE TABLE `parapharmacie` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `description` longtext DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parapharmacie`
--

INSERT INTO `parapharmacie` (`id`, `appointment_id`, `name`, `description`, `price`, `stock`) VALUES
(1, NULL, 'SunShield SPF50 Sunscreen', 'Broad-spectrum SPF50 sunscreen for face and body, non-greasy and water-resistant.', 14.99, 92),
(2, NULL, 'Hydrating Face Moisturizer', 'Lightweight daily moisturizer with hyaluronic acid for long-lasting hydration.', 9.99, 76),
(3, NULL, 'Gentle Baby Wash', 'Tear-free baby wash with natural chamomile to soothe and clean delicate skin.', 7.50, 19),
(4, NULL, 'Antiseptic Wound Spray', 'Fast-acting antiseptic spray to clean and protect minor cuts and abrasions.', 6.25, 77),
(5, NULL, 'PainRelief Gel 50g', 'Topical analgesic gel for muscle and joint pain relief.', 8.99, 99),
(6, NULL, 'Multivitamin Adult 60 tabs', 'Daily multivitamin to support general health and vitality.', 12.50, 19),
(7, NULL, 'Omega-3 Fish Oil 1000mg (60)', 'High-strength omega-3 capsules to support heart and brain health.', 15.00, 82),
(8, NULL, 'Probiotic 30 capsules', 'Live probiotics to support gut flora and digestion.', 18.99, 10),
(9, NULL, 'Vitamin C 500mg (100)', 'Immune support vitamin C tablets, antioxidant formula.', 9.50, 11),
(10, NULL, 'Zinc 50mg (60)', 'Zinc supplement to support immune function and skin health.', 8.00, 63),
(11, NULL, 'Calcium + D3 (90)', 'Bone support supplement combining calcium and vitamin D3.', 11.00, 86),
(12, NULL, 'Sleep Aid Herbal (30)', 'Natural herbal sleep aid with valerian and lemon balm.', 10.00, 51),
(13, NULL, 'Cough Syrup 200ml', 'Soothing cough syrup for cough and throat irritation.', 7.99, 56),
(14, NULL, 'Nasal Saline Spray 100ml', 'Saline nasal spray to relieve congestion and moisturize nasal passages.', 5.49, 85),
(15, NULL, 'Eye Lubricant Drops 10ml', 'Lubricating eye drops for dry and irritated eyes.', 6.99, 51),
(16, NULL, 'Earwax Removal Drops 15ml', 'Gentle ear drops to soften and remove excess earwax.', 5.99, 55),
(17, NULL, 'Antifungal Cream 15g', 'Effective topical cream for fungal skin infections.', 6.49, 18),
(18, NULL, 'Diaper Rash Cream 50ml', 'Protective ointment to soothe and prevent diaper rash.', 8.49, 68),
(19, NULL, 'Hand Sanitizer 500ml', 'Quick-drying alcohol sanitizer for effective hand hygiene.', 6.99, 30),
(20, NULL, 'Hydrocortisone Cream 1% 15g', 'Mild steroid cream for itching and minor skin irritation.', 4.99, 83),
(21, NULL, 'Oral Rehydration Salts (10)', 'Electrolyte replacement sachets to prevent dehydration.', 3.99, 59),
(22, NULL, 'Digital Thermometer', 'Fast and accurate digital thermometer for oral/axillary use.', 19.99, 50),
(23, NULL, 'Cold & Flu Relief Tablets (20)', 'Relieves common cold and flu symptoms: fever, ache, congestion.', 8.99, 63),
(24, NULL, 'Vitamin D3 1000IU (120)', 'Daily vitamin D3 supplement to support bone and immune health.', 7.99, 16),
(25, NULL, 'Collagen Peptides 250g', 'Hydrolyzed collagen powder to support skin, hair and joint health.', 24.99, 22),
(26, NULL, 'Hyaluronic Acid Serum 30ml', 'Anti-aging hydrating serum to plump and smooth skin.', 19.99, 86),
(27, NULL, 'Acne Cleansing Gel 150ml', 'Gentle acne cleanser with salicylic acid to clear pores.', 9.99, 94),
(28, NULL, 'Sensitive Shampoo 250ml', 'Mild shampoo for sensitive scalp and daily use.', 6.50, 29),
(29, NULL, 'Conditioner 250ml', 'Moisturizing conditioner for soft, manageable hair.', 6.50, 11),
(30, NULL, 'Foot Repair Cream 75ml', 'Intensive foot cream for cracked heels and dry skin.', 7.50, 90),
(31, NULL, 'Insect Repellent Spray 150ml', 'Long-lasting insect repellent for outdoor protection.', 9.49, 92),
(32, NULL, 'Lip Balm SPF15', 'Moisturizing lip balm with sun protection.', 3.49, 47),
(33, NULL, 'Muscle Rub 100ml', 'Cooling and warming rub for sore muscles.', 8.99, 63),
(34, NULL, 'Small Heating Pad', 'Reusable heating pad for targeted pain relief.', 14.00, 36),
(35, NULL, 'Eye Makeup Remover 100ml', 'Gentle eye makeup remover that cleans without irritation.', 5.49, 35),
(36, NULL, 'Saline Nasal Rinse Pack', 'Complete nasal rinse kit to clear sinuses and allergens.', 7.99, 57),
(37, NULL, 'Electrolyte Drink Mix (10)', 'Powdered electrolyte mix to rehydrate after exercise or illness.', 6.99, 73),
(38, NULL, 'Iron Supplement (30)', 'Iron tablets to support healthy blood and energy levels.', 8.50, 81),
(39, NULL, 'Magnesium 250mg (60)', 'Magnesium supplement for muscle function and relaxation.', 9.00, 15),
(40, NULL, 'Digestive Enzymes 60 caps', 'Digestive enzyme blend to aid nutrient absorption.', 15.50, 66),
(41, NULL, 'Gentle Laxative 20 tabs', 'Mild laxative for occasional constipation relief.', 5.99, 68),
(42, NULL, 'Herbal Calm Tea (20)', 'Soothing herbal tea blend to promote relaxation and sleep.', 4.99, 36),
(43, NULL, 'Protein Powder 500g (Vanilla)', 'Whey protein powder for muscle recovery and daily protein needs.', 29.99, 15),
(44, NULL, 'Face Clay Mask 100ml', 'Purifying clay mask to detoxify and refine pores.', 8.99, 95),
(45, NULL, 'Antibacterial Wipes (50)', 'Convenient antibacterial wipes for hands and surfaces.', 4.99, 58),
(46, NULL, 'Deodorant Roll-on 50ml', 'Alcohol-free deodorant with long-lasting protection.', 5.99, 92),
(47, NULL, 'Toothpaste Sensitive 75ml', 'Toothpaste formulated for sensitive teeth and enamel protection.', 3.99, 30),
(48, NULL, 'Mouthwash Antiseptic 500ml', 'Antiseptic mouthwash to freshen breath and reduce bacteria.', 6.99, 55),
(49, NULL, 'Cooling Eye Gel 15ml', 'Refreshing eye gel to reduce puffiness and soothe tired eyes.', 8.99, 26),
(50, NULL, 'Nasal Decongestant Spray 15ml', 'Fast-acting nasal decongestant for short-term relief.', 7.49, 14),
(51, NULL, 'Panado 500mg', 'Pain Relief', 7.50, 1),
(52, NULL, 'Doliprane 500mg', 'Pain Relief', 7.90, 20),
(53, NULL, 'Doliprane 1000mg', 'Pain Relief', 11.50, 21),
(54, NULL, 'Panado Forte', 'Pain Relief', 10.90, 22),
(55, NULL, 'Efferalgan 500mg', 'Pain Relief', 8.20, 23),
(56, NULL, 'Efferalgan 1g', 'Pain Relief', 12.30, 24),
(57, NULL, 'Nurofen 200mg', 'Pain Relief', 9.80, 25),
(58, NULL, 'Nurofen 400mg', 'Pain Relief', 13.40, 26),
(59, NULL, 'Advil 200mg', 'Pain Relief', 8.70, 27),
(60, NULL, 'Aspirin Protect', 'Pain Relief', 9.10, 28),
(61, NULL, 'Vitamin C 1000mg', 'Vitamins', 13.20, 19),
(62, NULL, 'Zinc + Vitamin C', 'Vitamins', 18.50, 20),
(63, NULL, 'Magnesium B6', 'Vitamins', 19.90, 21),
(64, NULL, 'Omega 3 Capsules', 'Supplements', 24.80, 22),
(65, NULL, 'Multivitamin Adult', 'Vitamins', 22.40, 23),
(66, NULL, 'Berocca Boost', 'Vitamins', 28.90, 24),
(67, NULL, 'Supradyn Energy', 'Vitamins', 29.50, 10),
(68, NULL, 'Iron + Folic Acid', 'Supplements', 16.90, 11),
(69, NULL, 'Calcium D3', 'Supplements', 21.30, 12),
(70, NULL, 'Vitamin D3 2000 IU', 'Vitamins', 15.70, 13),
(71, NULL, 'Vichy Mineral 89 Serum', 'Skincare', 79.00, 15),
(72, NULL, 'Vichy Liftactiv Supreme', 'Skincare', 145.00, 16),
(73, NULL, 'Vichy Normaderm Gel', 'Skincare', 62.00, 17),
(74, NULL, 'La Roche-Posay Cicaplast Baume B5', 'Dermatology', 58.00, 18),
(75, NULL, 'La Roche-Posay Effaclar Gel', 'Dermatology', 66.50, 19),
(76, NULL, 'Avène Cleanance Gel', 'Dermatology', 54.80, 12),
(77, NULL, 'Avène Thermal Water Spray', 'Dermatology', 31.50, 13),
(78, NULL, 'Bioderma Sébium H2O', 'Dermatology', 47.90, 14),
(79, NULL, 'Bioderma Atoderm Cream', 'Dermatology', 53.20, 15),
(80, NULL, 'Bioderma Photoderm SPF50', 'Sun Care', 72.00, 23),
(81, NULL, 'Uriage Xémose Balm', 'Dermatology', 61.40, 17),
(82, NULL, 'CeraVe Moisturizing Cream', 'Dermatology', 49.90, 18),
(83, NULL, 'Eucerin UreaRepair Lotion', 'Dermatology', 57.80, 19),
(84, NULL, 'Mustela Hydra Bébé', 'Baby Care', 44.50, 23),
(85, NULL, 'Mustela Stelatopia Cream', 'Baby Care', 59.90, 24),
(86, NULL, 'Nuxe Huile Prodigieuse', 'Skincare', 89.00, 14),
(87, NULL, 'Nuxe Rêve de Miel Lip Balm', 'Skincare', 32.50, 15),
(88, NULL, 'SVR Sebiaclear Hydra', 'Dermatology', 61.20, 16),
(89, NULL, 'Nivea Soft Cream', 'Skincare', 18.90, 17),
(90, NULL, 'Cetaphil Gentle Skin Cleanser', 'Dermatology', 45.30, 18),
(91, NULL, 'Toplexil Syrup', 'Respiratory', 18.70, 19),
(92, NULL, 'Actifed Syrup', 'Respiratory', 16.90, 20),
(93, NULL, 'Strepsils Lozenges', 'Respiratory', 9.80, 21),
(94, NULL, 'Hexaspray', 'Respiratory', 15.50, 22),
(95, NULL, 'Vicks VapoRub', 'Respiratory', 20.40, 23),
(96, NULL, 'Sinutab', 'Respiratory', 17.30, 24),
(97, NULL, 'Humer Nasal Spray', 'Respiratory', 14.20, 10),
(98, NULL, 'Physiomer Nasal Spray', 'Respiratory', 19.10, 11),
(99, NULL, 'Bronchostop Syrup', 'Respiratory', 21.70, 12),
(100, NULL, 'Humex Cold', 'Respiratory', 18.20, 13),
(101, NULL, 'Smecta', 'Digestive', 11.70, 16),
(102, NULL, 'Gaviscon', 'Digestive', 14.90, 17),
(103, NULL, 'Maalox', 'Digestive', 13.60, 18),
(104, NULL, 'Motilium', 'Digestive', 15.80, 19),
(105, NULL, 'Spasfon Lyoc', 'Digestive', 10.90, 20),
(106, NULL, 'Enterogermina', 'Digestive', 22.30, 21),
(107, NULL, 'Probiotical', 'Digestive', 25.40, 22),
(108, NULL, 'Buscopan', 'Digestive', 16.20, 16),
(109, NULL, 'Lacteol', 'Digestive', 23.10, 17),
(110, NULL, 'Normacol', 'Digestive', 12.80, 18),
(111, NULL, 'Mustela Gentle Cleansing Gel', 'Baby Care', 39.80, 23),
(112, NULL, 'Mustela Diaper Cream', 'Baby Care', 35.50, 24),
(113, NULL, 'Chicco Baby Lotion', 'Baby Care', 29.90, 25),
(114, NULL, 'Bebisol Formula', 'Baby Care', 68.00, 26),
(115, NULL, 'Bepanthen Ointment', 'First Aid', 24.60, 13),
(116, NULL, 'Sudocrem', 'Baby Care', 28.30, 19),
(117, NULL, 'Pampers New Baby', 'Baby Care', 42.90, 20),
(118, NULL, 'Johnson\'s Baby Oil', 'Baby Care', 19.50, 21),
(119, NULL, 'Nivea Baby Cream', 'Baby Care', 17.90, 22),
(120, NULL, 'Cetaphil Baby Wash', 'Baby Care', 31.90, 23),
(121, NULL, 'Optive Eye Drops', 'Eye Care', 26.40, 19),
(122, NULL, 'Hylo-Comod Eye Drops', 'Eye Care', 49.20, 20),
(123, NULL, 'Artelac Splash', 'Eye Care', 45.70, 21),
(124, NULL, 'Sensodyne Repair & Protect', 'Oral Care', 21.10, 22),
(125, NULL, 'Elmex Toothpaste', 'Oral Care', 16.30, 23),
(126, NULL, 'Parodontax Toothpaste', 'Oral Care', 17.80, 24),
(127, NULL, 'Listerine Mouthwash', 'Oral Care', 13.90, 10),
(128, NULL, 'Oral-B Toothbrush', 'Oral Care', 11.50, 11),
(129, NULL, 'Otrivin Baby Aspirator', 'Baby Care', 22.90, 23),
(130, NULL, 'Ear Clean Spray', 'Ear Care', 14.70, 13),
(131, NULL, 'Betadine Antiseptic', 'First Aid', 12.20, 14),
(132, NULL, 'Mercurochrome Spray', 'First Aid', 10.50, 15),
(133, NULL, 'Steri-Strip Wound Closures', 'First Aid', 18.80, 16),
(134, NULL, 'Compeed Blister Patches', 'First Aid', 21.90, 17),
(135, NULL, 'Elastic Bandage', 'First Aid', 8.30, 18),
(136, NULL, 'Salicylic Acid Acne Gel', 'Dermatology', 24.40, 16),
(137, NULL, 'Hand Sanitizer Gel', 'Hygiene', 7.90, 20),
(138, NULL, 'Antibacterial Soap', 'Hygiene', 6.50, 21),
(139, NULL, 'Sunscreen SPF50 Vichy', 'Sun Care', 75.00, 22),
(140, NULL, 'Sunscreen SPF50 Avène', 'Sun Care', 73.50, 23),
(141, NULL, 'Collagen Beauty Capsules', 'Supplements', 55.60, 24),
(142, NULL, 'Propolis Spray', 'Respiratory', 20.90, 10),
(143, NULL, 'Magnesium Glycinate', 'Supplements', 26.80, 11),
(144, NULL, 'Probiotic Complex', 'Digestive', 28.70, 17),
(145, NULL, 'Throat Lozenges Honey', 'Respiratory', 8.90, 13),
(146, NULL, 'Nasal Decongestant Spray', 'Respiratory', 14.40, 14),
(147, NULL, 'Arnica Gel', 'Pain Relief', 19.60, 25),
(148, NULL, 'Anti-itch Cream', 'Dermatology', 23.90, 12),
(149, NULL, 'Foot Cream Urea', 'Skincare', 21.20, 13),
(150, NULL, 'Night Repair Cream', 'Skincare', 69.50, 14);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Completed',
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `user_id`, `amount`, `status`, `transaction_date`) VALUES
(1, 3, 18.75, 'Completed', '2026-05-04 12:13:26'),
(2, 3, 21.47, 'Completed', '2026-05-04 13:04:21'),
(3, 3, 22.990000000000002, 'Completed', '2026-05-04 13:08:13'),
(4, 3, 34.99, 'Completed', '2026-05-04 13:13:45'),
(5, 3, 25.23, 'Completed', '2026-05-04 13:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `auth_code` varchar(10) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `face_id` varchar(255) DEFAULT NULL,
  `face_image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `auth_code`, `email`, `roles`, `password`, `full_name`, `first_name`, `last_name`, `address`, `phone`, `status`, `reset_token`, `reset_token_expires_at`, `face_id`, `face_image_path`) VALUES
(1, '928830', 'fadydrissi3@gmail.com', '[\"ROLE_USER\"]', '$2y$13$XVrFjKioGdeS8y8L.BgtyuBA.IFPe4Wvhd0XfFZuyYK8EbUPM4jfi', 'fady drissi', 'fady', 'drissi', 'dkfkelkvle 5e', '5525222556', 'active', NULL, NULL, NULL, NULL),
(6, NULL, 'drissifady11@gmail.com', '[\"ROLE_USER\"]', '$2y$10$BPrya6oncmMrUrmnEcjYAekeoexwFmKozeYc7QgRtIl2qO9VWOoZ.', 'Driss', NULL, NULL, NULL, '123456789', 'active', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `parapharmacie_id` int(11) NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `parapharmacie_id`, `added_at`) VALUES
(1, 1, 21, '2026-03-01 15:34:54'),
(2, 1, 17, '2026-03-01 15:34:55'),
(7, 1, 27, '2026-03-01 15:48:39'),
(8, 1, 45, '2026-03-01 15:48:40'),
(9, 1, 11, '2026-03-01 16:28:21'),
(10, 1, 25, '2026-03-01 16:28:22'),
(12, 1, 4, '2026-04-15 16:43:32'),
(15, 1, 2, '2026-04-15 21:28:17'),
(19, 1, 33, '2026-04-16 12:18:43'),
(20, 1, 51, '2026-04-18 22:07:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL_ADMIN` (`email`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CA77FBEAF` (`blog_post_id`);

--
-- Indexes for table `daily_tracking`
--
ALTER TABLE `daily_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1273B5C8A76ED395` (`user_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL_DOCTOR` (`email`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `health_log`
--
ALTER TABLE `health_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BF5476CAA76ED395` (`user_id`),
  ADD KEY `IDX_BF5476CA642B8210` (`admin_id`);

--
-- Indexes for table `parapharmacie`
--
ALTER TABLE `parapharmacie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_27D41E87E5B533F9` (`appointment_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D889262287F4FB17` (`doctor_id`),
  ADD KEY `IDX_D8892622A76ED395` (`user_id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_date` (`transaction_date`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9CE12A31A76ED395` (`user_id`),
  ADD KEY `IDX_9CE12A314584665A` (`parapharmacie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_tracking`
--
ALTER TABLE `daily_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `health_log`
--
ALTER TABLE `health_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `parapharmacie`
--
ALTER TABLE `parapharmacie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CA77FBEAF` FOREIGN KEY (`blog_post_id`) REFERENCES `blog_post` (`id`);

--
-- Constraints for table `daily_tracking`
--
ALTER TABLE `daily_tracking`
  ADD CONSTRAINT `FK_1273B5C8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
