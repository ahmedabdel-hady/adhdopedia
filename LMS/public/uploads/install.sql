-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-05-2021 a las 22:58:35
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `install`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academic_settings`
--

DROP TABLE IF EXISTS `academic_settings`;
CREATE TABLE IF NOT EXISTS `academic_settings` (
  `settings_id` int(100) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`settings_id`),
  UNIQUE KEY `settings_id` (`settings_id`),
  KEY `settings_id_2` (`settings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `academic_settings`
--

INSERT INTO `academic_settings` (`settings_id`, `type`, `description`) VALUES
(2, 'report_teacher', '1'),
(3, 'minium_mark', '61'),
(22, 'tabulation', NULL),
(25, 'routine', '1'),
(1, 'limit_upload', ''),
(26, 'terms', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accountant`
--

DROP TABLE IF EXISTS `accountant`;
CREATE TABLE IF NOT EXISTS `accountant` (
  `accountant_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(300) NOT NULL,
  `email` varchar(300) DEFAULT NULL,
  `password` varchar(300) NOT NULL,
  `phone` varchar(300) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `username` varchar(300) NOT NULL,
  `fb_token` longtext DEFAULT NULL,
  `fb_id` longtext DEFAULT NULL,
  `fb_photo` longtext DEFAULT NULL,
  `fb_name` longtext DEFAULT NULL,
  `g_oauth` longtext DEFAULT NULL,
  `g_fname` longtext DEFAULT NULL,
  `femail` longtext DEFAULT NULL,
  `g_lname` longtext DEFAULT NULL,
  `g_picture` longtext DEFAULT NULL,
  `link` longtext DEFAULT NULL,
  `g_email` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `gender` varchar(200) DEFAULT NULL,
  `idcard` varchar(200) DEFAULT NULL,
  `since` varchar(20) DEFAULT NULL,
  `birthday` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`accountant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_role`
--

DROP TABLE IF EXISTS `account_role`;
CREATE TABLE IF NOT EXISTS `account_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permissions` int(10) DEFAULT 0,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `account_role`
--

INSERT INTO `account_role` (`role_id`, `type`, `permissions`) VALUES
(1, 'messages', 1),
(2, 'students', 1),
(3, 'academic', 1),
(4, 'polls', 1),
(5, 'news', 1),
(6, 'schedules', 1),
(7, 'admins', 1),
(8, 'accountants', 1),
(9, 'attendance', 1),
(10, 'notifications', 1),
(11, 'school_bus', 1),
(12, 'system_reports', 1),
(13, 'parents', 1),
(14, 'librarians', 1),
(15, 'calendar', 1),
(16, 'admissions', 1),
(17, 'classrooms', 1),
(18, 'academic_settings', 1),
(19, 'teachers', 1),
(20, 'library', 1),
(21, 'files', 1),
(22, 'behavior', 1),
(23, 'accounting', 1),
(24, 'settings', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_read`
--

DROP TABLE IF EXISTS `activity_read`;
CREATE TABLE IF NOT EXISTS `activity_read` (
  `actividy_read_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `subject_activity_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `activity_type` varchar(50) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`actividy_read_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `owner_status` int(11) NOT NULL DEFAULT 0 COMMENT '1 owner, 0 not owner',
  `username` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT 1,
  `birthday` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `authentication_key` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_token` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_id` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_photo` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_oauth` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_fname` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `femail` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_lname` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_picture` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_email` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `idcard` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profession` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `since` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`admin_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`, `owner_status`, `username`, `status`, `birthday`, `authentication_key`, `fb_token`, `fb_id`, `fb_photo`, `fb_name`, `g_oauth`, `g_fname`, `femail`, `g_lname`, `g_picture`, `link`, `g_email`, `gender`, `image`, `idcard`, `profession`, `since`) VALUES
(1, 'Mr.', 'Admin', 'demo@demo.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '000000', 'Ciudad de Guatemala, Guatemala', 1, 'admin', 1, '01/04/1994', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5867d8845d426ad17b0bc109c4ebc6eeavatar1.jpg', '00000000', 'Enginner', '21 Feb, 2019');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `year` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0(undefined) 1(present) 2(absent)',
  `subject_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`attendance_id`),
  KEY `attendance_id` (`attendance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attendance_live`
--

DROP TABLE IF EXISTS `attendance_live`;
CREATE TABLE IF NOT EXISTS `attendance_live` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `live_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `date` varchar(600) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `author` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_copies` int(11) DEFAULT NULL,
  `issued_copies` int(11) DEFAULT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book_request`
--

DROP TABLE IF EXISTS `book_request`;
CREATE TABLE IF NOT EXISTS `book_request` (
  `book_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `issue_start_date` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_end_date` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`book_request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `jornada_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `nivel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_routine`
--

DROP TABLE IF EXISTS `class_routine`;
CREATE TABLE IF NOT EXISTS `class_routine` (
  `class_routine_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `time_start` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_end` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_start_min` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_end_min` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `amend` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amstart` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `classroom_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`class_routine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `homework_code` varchar(600) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` varchar(600) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_comment` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_comment` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `homework_reply` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mark` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_type` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filesize` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wall_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `upload_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dormitory`
--

DROP TABLE IF EXISTS `dormitory`;
CREATE TABLE IF NOT EXISTS `dormitory` (
  `dormitory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `number` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`dormitory_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_template`
--

DROP TABLE IF EXISTS `email_template`;
CREATE TABLE IF NOT EXISTS `email_template` (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `task` longtext COLLATE utf8_unicode_ci NOT NULL,
  `subject` longtext COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `instruction` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`email_template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `email_template`
--

INSERT INTO `email_template` (`email_template_id`, `task`, `subject`, `body`, `instruction`) VALUES
(1, 'new_homework', 'New homework uploaded', '<p>Hi,</p>\r\n<p>Your teacher of&nbsp;[SUBJECT] has created a new&nbsp;homework to the system, the information is as follows:</p>\r\n<p><br />Title&nbsp;: [TITLE]</p>\r\n<p>Description: [DESCRIPTION]</p>\r\n<p>&nbsp;</p>\r\n<p>To review this homework, enter your <strong>Virtual Classroom</strong>,&nbsp;Homework section.</p>', ''),
(2, 'student_absences', 'Absenses', '<div>Hi&nbsp;<strong>[PARENT]</strong>,</div>\r\n<p>The reason for the mail is to notify you that your appreciable son&nbsp;<strong>[STUDENT]</strong>&nbsp; is not present in the classes today, if it is an emergency please contact the shcool.</p>', ''),
(3, 'student_reports', 'New report', '<div>\r\n<div>\r\n<p>Hi&nbsp;<strong>[PARENT]</strong>,</p>\r\n<p>A new discipline report has been created for <strong>[STUDENT]</strong>, please check the academic reports within your account.</p>\r\n</div>\r\n</div>', ''),
(4, 'parent_new_invoice', 'New invoice', '<p>Hi&nbsp;<strong>[PARENT]</strong>,</p>\r\n<p>A new invoice has been created for <strong>[STUDENT]</strong>,&nbsp;to see the details of the invoice please enter your payment management in your account.</p>', ''),
(5, 'student_new_invoice', 'New invoice', '<p>Hi <strong>[STUDENT]</strong>,</p>\r\n<p>A new invoice has been created with your name, to see the details of the invoice please enter your payment management in your account.</p>', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enroll`
--

DROP TABLE IF EXISTS `enroll`;
CREATE TABLE IF NOT EXISTS `enroll` (
  `enroll_id` int(11) NOT NULL AUTO_INCREMENT,
  `enroll_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `roll` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `date_added` longtext COLLATE utf8_unicode_ci NOT NULL,
  `year` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`enroll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `start` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `end` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expense_category`
--

DROP TABLE IF EXISTS `expense_category`;
CREATE TABLE IF NOT EXISTS `expense_category` (
  `expense_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`expense_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `file`
--

DROP TABLE IF EXISTS `file`;
CREATE TABLE IF NOT EXISTS `file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `folder_token` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fileorder` varchar(200) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folder`
--

DROP TABLE IF EXISTS `folder`;
CREATE TABLE IF NOT EXISTS `folder` (
  `folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(200) NOT NULL,
  `token` longtext NOT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_id` int(11) NOT NULL,
  `post_status` int(11) DEFAULT 1,
  `type` varchar(200) NOT NULL,
  `wall_type` varchar(20) DEFAULT NULL,
  `publish_date` varchar(20) DEFAULT NULL,
  `upload_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forum_message`
--

DROP TABLE IF EXISTS `forum_message`;
CREATE TABLE IF NOT EXISTS `forum_message` (
  `message` longtext CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `grade_point` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `mark_from` int(11) DEFAULT NULL,
  `mark_upto` int(11) DEFAULT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_message`
--

DROP TABLE IF EXISTS `group_message`;
CREATE TABLE IF NOT EXISTS `group_message` (
  `group_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_message_thread_code` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `sender` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `read_status` int(11) DEFAULT NULL,
  `attached_file_name` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`group_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_message_thread`
--

DROP TABLE IF EXISTS `group_message_thread`;
CREATE TABLE IF NOT EXISTS `group_message_thread` (
  `group_message_thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_message_thread_code` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `members` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_name` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_message_timestamp` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_timestamp` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`group_message_thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `homework`
--

DROP TABLE IF EXISTS `homework`;
CREATE TABLE IF NOT EXISTS `homework` (
  `homework_id` int(11) NOT NULL AUTO_INCREMENT,
  `homework_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `time_end` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `section_id` int(11) NOT NULL,
  `uploader_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_end` varchar(600) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `filesize` varchar(20) DEFAULT NULL,
  `wall_type` varchar(20) DEFAULT NULL,
  `publish_date` varchar(20) DEFAULT NULL,
  `upload_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`homework_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `homework_files`
--

DROP TABLE IF EXISTS `homework_files`;
CREATE TABLE IF NOT EXISTS `homework_files` (
  `fhomework_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `homework_code` varchar(200) DEFAULT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `file` longtext DEFAULT NULL,
  PRIMARY KEY (`fhomework_file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios_examenes`
--

DROP TABLE IF EXISTS `horarios_examenes`;
CREATE TABLE IF NOT EXISTS `horarios_examenes` (
  `horario_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `time_start_min` varchar(11) NOT NULL,
  `time_end_min` varchar(11) NOT NULL,
  `day` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `year` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fecha` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `amstart` varchar(20) DEFAULT NULL,
  `amend` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`horario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_paid` longtext COLLATE utf8_unicode_ci NOT NULL,
  `due` longtext COLLATE utf8_unicode_ci NOT NULL,
  `creation_timestamp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `payment_timestamp` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'paid or unpaid',
  `year` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL,
  `spanish` longtext COLLATE utf8_unicode_ci NOT NULL,
  `portuguese` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `hindi` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `french` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `serbian` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `arabic` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`phrase_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3689 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `spanish`, `portuguese`, `hindi`, `french`, `serbian`, `arabic`) VALUES
(1, 'dashboard', 'Dashboard', 'Tablero', 'Painel de controle', 'डैशबोर्ड', 'Tableau de bord', 'Командна табла', 'لوحة القيادة'),
(2, 'parent', 'Parent', 'Padre', 'Pai', 'माता-पिता', 'Parent', 'Родитељ', 'الأبوين'),
(3, 'profile', 'Profile', 'Perfil', 'Perfil do usuário', 'प्रोफाइल', 'Profil', 'профил', 'الملف الشخصي'),
(4, 'logout', 'Logout', 'Cerrar sesión', 'Fechar Sessão', 'लोग आउट', 'Connectez - Out', 'одјавити се', 'الخروج'),
(5, 'messages', 'Messages', 'Mensajes', 'Postagens', 'संदेश', 'Messages', 'Поруке', 'رسائل'),
(6, 'noticeboard', 'Noticeboard', 'Noticias y Eventos', 'Quadro de notícias', 'सूचना पट्ट', 'Tableau d\'affichage', 'Огласна табла', 'لوح الإعلانات'),
(7, 'teachers', 'Teachers', 'Profesores', 'Professores', 'शिक्षकों की', 'Enseignants', 'Наставници', 'معلمون'),
(8, 'schedules', 'Schedules', 'Horarios', 'Horários', 'अनुसूचियों', 'Des horaires', 'распоред', 'جداول'),
(9, 'attendance', 'Attendance', 'Asistencia', 'Comparecimento', 'उपस्थिति', 'Présence', 'похађање', 'الحضور'),
(10, 'library', 'Library', 'Biblioteca', 'Biblioteca', 'पुस्तकालय', 'Bibliothèque', 'Библиотека', 'مكتبة'),
(11, 'marks', 'Marks', 'Calificaciones', 'Classificações', 'निशान', 'Des notes', 'оцене', 'علامات'),
(12, 'classroom', 'Classroom', 'Salon', 'Sala de aula virtual', 'कक्षा', 'Salle de classe', 'Учионица', 'قاعة الدراسة'),
(13, 'payments', 'Payments', 'Pagos', 'Pagamentos', 'भुगतान', 'Paiements', 'Плаћања', 'المدفوعات'),
(14, 'admins', 'Admins', 'Directores', 'Administradores', 'व्यवस्थापक', 'Administrateurs', 'Админс', 'مدراء'),
(15, 'students', 'Students', 'Estudiantes', 'Estudantes', 'छात्र', 'Élèves', 'студенти', 'الطلاب'),
(16, 'parents', 'Parents', 'Padres', 'Parentes', 'माता-पिता', 'Parents', 'Родитељи', 'الآباء'),
(17, 'news', 'News', 'Noticias', 'Notícia', 'समाचार', 'Nouvelles', 'Вести', 'أخبار'),
(18, 'events', 'Events', 'Eventos', 'Eventos', 'आयोजन', 'Événements', 'Догађаји', 'أحداث'),
(19, 'view_more', 'View more', 'Ver más', 'Veja mais', 'और देखो', 'Afficher plus', 'Погледај још', 'عرض المزيد'),
(20, 'online_users', 'Online users', 'Usuarios en línea', 'Usuários online', 'ऑनलाइन उपयोगकर्ता', 'Utilisateurs en ligne', 'Онлине корисници', 'مستخدمين على الهواء'),
(21, 'last_5_minutes', 'Last 5 minutes', 'Últimos 5 minutos', 'Últimos 5 minutos', 'पिछले 5 मिनट', 'Dernières 5 minutes', 'Последњих 5 минута', 'آخر 5 دقائق'),
(22, 'polls', 'Polls', 'Encuestas', 'Enquetes', 'पोल', 'Les sondages', ' Анкете', 'استطلاعات الرأي'),
(23, 'thank_you_polls', 'Thanks for your participation', 'Gracias por participar', 'Obrigado pela sua participação', 'आपकी भागीदारी के लिए धन्यवाद', 'Merci de votre participation', 'Хвала што сте учествовали', 'شكرا على مشاركتكم'),
(24, 'private_messages', 'Private messages', 'Mensajes Privados', 'Mensagens privadas', 'निजी संदेश', 'Messages privés', 'Приватне поруке', 'رسائل خاصة'),
(25, 'admin', 'Admin', 'Director', 'Administradores', 'व्यवस्थापक', 'Admin', 'Админ', 'مشرف'),
(26, 'hi', 'Hi', 'Hola', 'Oi', 'नमस्ते', 'salut', 'Здраво', 'مرحبا'),
(27, 'message_home', 'Chat, Connect and Learn', 'Chatea, Conecta y Aprende', 'Bate-papo, Conecte e Aprenda', 'चैट करें, कनेक्ट करें और जानें', 'Chat, connexion et apprentissage', 'Ћаскање се повезује и учити', 'دردشة، الاتصال والتعلم'),
(28, 'write_message', 'Write your message', 'Escribir mensaje', 'Escreva sua mensagem', 'अपना संदेश लिखें', 'Écrivez votre message', 'Писати поруке', 'اكتب رسالتك'),
(29, 'send_file', 'Send a file', 'Enviar archivo', 'Enviar um arquivo', 'एक फाइल भेजें', 'Envoyer un fichier', 'Пошаљи датотеку', 'إرسال ملف'),
(30, 'send', 'Send', 'Enviar', 'Enviar', 'भेजना', 'Envoyer', 'Пошаљи', 'إرسال'),
(31, 'receiver', 'Receiver', 'Receptor', 'Receptor', 'रिसीवर', 'Récepteur', 'Пријемник', 'المتلقي'),
(32, 'view', 'View', 'Ver', 'Visão', 'राय', 'Vue', 'поглед', 'رأي'),
(33, 'comment_success', 'Comment posted successfully', 'Comentario publicado', 'Comentários publicados com sucesso', 'टिप्पणी सफलतापूर्वक पोस्ट की गई', 'Commentaire publié avec succès', 'Коментар успех', 'تم نشر التعليق بنجاح'),
(34, 'subject', 'Subject', 'Curso', 'Sujeito', 'विषय', 'Assujettir', 'Предмет', 'موضوع'),
(35, 'teacher', 'Teacher', 'Profesor', 'Professor', 'अध्यापक', 'Prof', 'Наставник', 'مدرس'),
(36, 'send_message', 'Send message', 'Enviar mensaje', 'Enviar mensagem', 'मेसेज भेजें', 'Envoyer le message', 'Пошаљи поруку', 'إرسال رسالة'),
(37, 'class_routine', 'Class Routine', 'Horario de clases', 'Rotina de Classe', 'कक्षा सामान्य', 'Routine de classe', 'Распоред класа', 'الدرجة الروتينية'),
(38, 'exam_routine', 'Exam Routine', 'Horario de examenes', 'Rotina de exames', 'परीक्षा नियमित', 'Routine d\'examen', 'Распоред испита', 'امتحان روتيني'),
(39, 'attendance_report', 'Attendance report', 'Reporte de asistencia', 'Relatório de presenças', 'उपस्थिति विवरण', 'Rapport de présence', 'Извештај о присуству', 'تقرير الحضور'),
(40, 'month', 'Month', 'Mes', 'Mês', 'महीना', 'Mois', 'месец дана', 'شهر'),
(41, 'january', 'January', 'Enero', 'janeiro', 'जनवरी', 'janvier', 'Јануар', 'كانون الثاني'),
(42, 'february', 'February', 'Febrero', 'fevereiro', 'फरवरी', 'février', 'Фебруар', 'شهر فبراير'),
(43, 'march', 'March', 'Marzo', 'marcha', 'मार्च', 'Mars', 'Марш', 'مارس'),
(44, 'april', 'April', 'Abril', 'abril', 'अप्रैल', 'avril', 'Абрил', 'أبريل'),
(45, 'may', 'May', 'Mayo', 'mayo', 'मई', 'Mai', 'Мај', 'قد'),
(46, 'june', 'June', 'Junio', 'Junho', 'जून', 'juin', 'jyh', 'يونيو'),
(47, 'july', 'July', 'Julio', 'Julho', 'जुलाई', 'juillet', 'Јули', 'يوليو'),
(48, 'august', 'August', 'Agosto', 'agosto', 'अगस्त', 'août', 'Август', 'أغسطس'),
(49, 'september', 'September', 'Septiembre', 'setembro', 'सितंबर', 'septembre', 'септембар', 'سبتمبر'),
(50, 'october', 'October', 'Octubre', 'Outubro', 'अक्टूबर', 'octobre', 'Октобар', 'شهر اكتوبر'),
(51, 'november', 'November', 'Noviembre ', 'novembro', 'नवंबर', 'novembre', 'Новембар', 'شهر نوفمبر'),
(52, 'december', 'December', 'Diciembre', 'dezembro', 'दिसंबर', 'décembre', 'Децембар', 'ديسمبر'),
(53, 'student', 'Student', 'Estudiante', 'Aluna', 'छात्र', 'Étudiant', 'ученик', 'طالب علم'),
(54, 'select', 'Select', 'Seleccionar', 'Selecione', 'चुनते हैं', 'Sélectionner', 'Изаберите', 'تحديد'),
(55, 'generate', 'Generate', 'Generar', 'Gerar', 'उत्पन्न', 'Générer', 'Генериши', 'توفير'),
(56, 'type', 'Type', 'Tipo', 'Tipo', 'प्रकार', 'Type', 'тип', 'اكتب'),
(57, 'name', 'Name', 'Nombre', 'Nome', 'नाम', 'prénom', 'Име', 'اسم'),
(58, 'author', 'Author', 'Autor', 'Autor', 'लेखक', 'Auteur', 'Аутор', 'مؤلف'),
(59, 'description', 'Description', 'Descripción', 'Descrição', 'विवरण', 'La description', 'Опис', 'وصف'),
(60, 'status', 'Status', 'Estado', 'Status', 'स्थिति', 'Statut', 'Статус', 'الحالة'),
(61, 'price', 'Price', 'Precio', 'Preço', 'मूल्य', 'Prix', 'Цена', 'السعر'),
(62, 'download', 'Download', 'Descargar', 'Download', 'डाउनलोड', 'Télécharger', 'преузимање', 'تحميل'),
(63, 'normal', 'Normal', 'Normal', 'Normal', 'साधारण', 'Normal', 'Нормално', 'عادي'),
(64, 'no_downloaded', 'No file to download', 'No disponible', 'Nenhum arquivo para baixar', 'डाउनलोड करने के लिए कोई फ़ाइल नहीं', 'Aucun fichier à télécharger', 'није доступно', 'لا يوجد ملف لتنزيله'),
(65, 'virtual', 'Virtual', 'Virtual', 'Virtual', 'वास्तविक', 'Virtuel', 'Виртуелно', 'افتراضية'),
(66, 'roll', 'Roll ID', 'Roll ID', 'Roll ID', 'रोल आईडी', 'Roll ID', 'Ролл', 'معرف لفة'),
(67, 'class', 'Class', 'Grado', 'Classe', 'कक्षा', 'Classe', 'класа', 'صف دراسي'),
(68, 'section', 'Section', 'Sección', 'Seção', 'अनुभाग', 'Section', 'Одељак', 'الجزء'),
(69, 'mark', 'Mark', 'Nota', 'Marca', 'निशान', 'marque', 'Марк', 'علامة'),
(70, 'comment', 'Comment', 'Comentario', 'Comente', 'टिप्पणी', 'Commentaire', 'Коментар', 'تعليق'),
(71, 'view_all', 'View all', 'Ver todo', 'Ver tudo', 'सभी को देखें', 'Voir tout', 'погледати све', 'عرض الكل'),
(72, 'online_exams', 'Online exams', 'Exámenes en línea', 'Exames on-line', 'ऑनलाइन परीक्षाएं', 'Examens en ligne', 'Онлине испити', 'الامتحانات عبر الإنترنت'),
(73, 'homework', 'Homework', 'Tarea', 'Dever de casa', 'घर का पाठ', 'Devoirs', 'домаћи задатак', 'واجب منزلي'),
(74, 'study_material', 'Study material', 'Material de estudio', 'Material de estudo', 'अध्ययन सामग्री', 'Matériel d\'étude', 'Студијски материјал', 'المواد الدراسية'),
(75, 'syllabus', 'Syllabus', 'Contenidos de unidad', 'Programa de Estudos', 'पाठ्यक्रम', 'Programme', 'Садржај семестра', 'المنهج'),
(76, 'title', 'Title', 'Título', 'Título', 'शीर्षक', 'Titre', 'Наслов', 'عنوان'),
(77, 'start_date', 'Start date', 'Fecha de inicio', 'Data de início', 'आरंभ करने की तिथि', 'Date de début', 'Датум почетка', 'تاريخ البدء'),
(78, 'end_date', 'End date', 'Fecha límite', 'Data final', 'अंतिम तिथि', 'Date de fin', 'крајњи датум', 'تاريخ الانتهاء'),
(79, 'results', 'Results', 'Resultados', 'Resultados', 'परिणाम', 'Résultats', 'Резултате', 'النتائج'),
(80, 'view_results', 'View results', 'Ver resultados', 'Ver resultados', 'परिणाम देखें', 'Voir les résultats', 'Погледајте резултате', 'عرض النتائج'),
(81, 'no_data', 'No data available', 'Sin datos', 'Não há dados disponíveis', 'कोई डेटा उपलब्ध नहीं है', 'Pas de données disponibles', 'нема података', 'لا تتوافر بيانات'),
(82, 'of', 'of', 'de', 'of', 'का', 'de', 'Оф', 'من'),
(83, 'delivery_date', 'Delivery date', 'Fecha de entrega', 'Data de entrega', 'डिलीवरी की तारीख', 'Date de livraison', 'датум испоруке', 'تاريخ التسليم او الوصول'),
(84, 'details', 'Details', 'Detalles', 'Detalhes', 'विवरण', 'Détails', 'Детаље', 'تفاصيل'),
(85, 'back', 'Back', 'Regresar', 'Back', 'वापस', 'Arrière', 'назад', 'الى الخلف'),
(86, 'file', 'File', 'Archivo', 'Arquivo', 'फ़ाइल', 'Fichier', 'Филе', 'ملف'),
(87, 'no_delivered', 'Not delivered', 'No entregado', 'Não entregue', 'डिलीवर नहीं हुआ', 'Non livrés', 'Није испоручено', 'لم يتم تسليمها'),
(88, 'information', 'Information', 'Estudiantes', 'Em formação', 'जानकारी', 'Information', 'Информације', 'معلومات'),
(89, 'limit_date', 'Limit date', 'Fecha limite', 'Data-limite', 'सीमा तिथि', 'Date limite', 'Датум ограничења', 'تاريخ الحد'),
(90, 'allowed_deliveries', 'Deliveries allowed up to', 'Se permiten entregas hasta', 'Entregas permitidas até', 'तक पहुंचने की अनुमति', 'Les livraisons ont permis jusqu\'à', 'Достава је дозвољена до', 'عمليات التسليم المسموح بها تصل إلى'),
(91, 'unrated', 'Unrated', 'Sin calificar', 'Sem classificação', 'अनरेटेड', 'Non évalué', 'Унратед', 'غير مصنف'),
(92, 'teacher_comment', 'Teacher comment', 'Comentario del profesor', 'Comentário do professor', 'शिक्षक टिप्पणी', 'Commentaire de l\'enseignant', 'Коментар наставника', 'تعليق المعلم'),
(93, 'date', 'Date', 'Fecha', 'Date', 'तारीख', 'Rendez-vous amoureux', 'Датум', 'تاريخ'),
(94, 'upload_by', 'Uploaded by', 'Subido por', 'Enviado por', 'द्वारा डाली गई', 'telechargé par', 'Уплоад би', 'تم الرفع بواسطة...'),
(95, 'subject_marks', 'Subject marks', 'Calificaciones por curso', 'Marcas de assunto', 'विषय के निशान', 'Signes du sujet', 'Оцене по курсу', 'علامات الموضوع'),
(96, 'activity', 'Activity', 'Actividad', 'Atividade', 'गतिविधि', 'Activité', 'активност', 'نشاط'),
(97, 'amount', 'Amount', 'Monto', 'Montante', 'रकम', 'Montant', 'износ', 'كمية'),
(98, 'invoice', 'Invoice', 'Factura', 'Fatura', 'बीजक', 'Facture d\'achat', 'фактура', 'فاتورة'),
(99, 'make_payment', 'Make payment', 'Realizar pago', 'Faça o pagamento', 'भुगतान करो', 'Effectuer le paiement', 'извршити уплату', 'قم بالدفع'),
(100, 'pay_with_paypal', 'Pay with PayPal', 'Pagar con PayPal', 'Pagar com PayPal', 'पेपैल के साथ भुगतान करें', 'Payer avec PayPal', 'Платите уз паипал', 'الدفع بواسط باى بال'),
(101, 'view_invoice', 'View invoice', 'Ver factura', 'Ver fatura', 'चालान देखें', 'Voir la facture', 'Погледајте фактуру', 'عرض الفاتورة'),
(102, 'phone', 'Phone', 'Celular', 'telefone', 'फ़ोन', 'Téléphone', 'Телефон', 'هاتف'),
(103, 'total', 'Total', 'Total', 'Total', 'कुल', 'Total', 'Укупно', 'مجموع'),
(104, 'login', 'Login', 'Acceder', 'Entrar', 'लॉग इन करें', 'S\'identifier', 'Пријавите се', 'تسجيل الدخول'),
(105, 'username', 'Username', 'Usuario', 'Nome de usuário', 'उपयोगकर्ता नाम', 'Nom d\'utilisateur', 'корисничко име', 'اسم المستخدم'),
(106, 'password', 'Password', 'Contraseña', 'Senha', 'पासवर्ड', 'Mot de passe', 'Лозинка', 'كلمه السر'),
(107, 'register', 'Register', 'Registrarse', 'registo', 'रजिस्टर', 'registre', 'регистровати', 'تسجيل'),
(108, 'lost_password', 'Lost password', '¿Perdiste tu contraseña?', 'Senha perdida', 'पासवर्ड खो गया', 'Mot de passe perdu', 'Да ли сте изгубили лозинку?', 'كلمة مرور مفقودة'),
(109, 'create_account', 'Create an account', 'Crear cuenta', 'Crie a sua conta aqui', 'खाता बनाएं', 'Créer un compte', 'Региструј се', 'انشئ حساب'),
(110, 'email', 'Email', 'Correo', 'O email', 'ईमेल', 'Email', 'Емаил', 'البريد الإلكتروني'),
(111, 'address', 'Address', 'Dirección', 'Endereço', 'पता', 'Adresse', 'Адреса', 'عنوان'),
(112, 'birthday', 'Birthday', 'Cumpleaños', 'Aniversário', 'जन्मदिन', 'Anniversaire', 'Рођендан', 'عيد الميلاد'),
(113, 'gender', 'Gender', 'Género', 'Gênero', 'लिंग', 'Le genre', 'Пол', 'جنس'),
(114, 'male', 'Male', 'Masculino', 'Masculino', 'नर', 'Mâle', 'Мушки', 'الذكر'),
(115, 'female', 'Female', 'Femenino', 'Fêmea', 'महिला', 'Femelle', 'зенски пол', 'إناثا'),
(116, 'profession', 'Profession', 'Profesión', 'Profissão', 'व्यवसाय', 'Métier', 'Професија', 'مهنة'),
(117, 'recover_your_password', 'Recover your password', 'Recupera tu contraseña', 'Recupere sua senha', 'पासवर्ड पुनः प्राप्त करना', 'Récupérez votre mot de passe', 'Опоравите своју лозинку', 'استعادة كلمة المرور'),
(118, 'enter_email', 'Enter your email', 'Ingresa tu correo', 'Insira seu email', 'अपना ईमेल दर्ज करें', 'Entrer votre Email', 'Унесите пошту', 'أدخل بريدك الإلكتروني'),
(119, 'recover', 'Recover', 'Recuperar', 'Recuperar', 'वसूली', 'Récupérer', 'опоравити се', 'استعادة'),
(120, 'invalid_data', 'Invalid information', 'Datos incorrectos, verifique y vuelva a intentar', 'Informação inválida', 'अमान्य जानकारी', 'Informations invalides', 'Неисправни подаци, молимо проверите и покушајте поново', 'معلومات غير صالحة'),
(121, 'subjects', 'Subjects', 'Cursos', 'assuntos', 'विषय', 'Sujets', 'Теме', 'المواضيع'),
(122, 'permissions', 'Permissions', 'Permisos', 'Permissões', 'अनुमतियां', 'Autorisations', 'Дозволе', 'أذونات'),
(123, 'teacher_report', 'Teacher reports', 'Reporte de profesores', 'Relatórios dos professores', 'शिक्षक की रिपोर्ट', 'Rapports des enseignants', 'Извјештај учитеља', 'تقارير المعلم'),
(124, 'private_message', 'Private messages', 'Mensajes privados', 'Mensagens privadas', 'निजी संदेश', 'Messages privés', 'приватна порука', 'رسائل خاصة'),
(125, 'your_marks', 'Your marks', 'Tus calificaciones', 'Suas marcas', 'आपके अंक', 'Vos marques', 'Ваша квалификација', 'علاماتك'),
(126, 'print', 'Print', 'Imprimir ', 'Impressão', 'छाप', 'Impression', 'Принт', 'طباعة'),
(127, 'forum', 'Forum', 'Foro', 'Fórum', 'मंच', 'Forum', 'Форум', 'المنتدى'),
(128, 'options', 'Options', 'Opciones', 'Opções', 'विकल्प', 'Options', 'Опције', 'خيارات'),
(129, 'exam_finish', 'Finish exam', 'El examen ha finalizado', 'Termine o exame', 'परीक्षा समाप्त करें', 'Fin de l\'examen', 'Испит је завршен', 'إنهاء الامتحان'),
(130, 'exam_results', 'Exam results', 'Resultados del examen', 'Resultados dos exames', 'परीक्षा के परिणाम', 'Résultats d\'examen', 'Резултати испита', 'نتائج الامتحانات'),
(131, 'question', 'Question', 'Pregunta', 'Questão', 'प्रश्न', 'Question', 'Питање', 'سؤال'),
(132, 'correct_answer', 'Correct answer', 'Respuesta correcta', 'Resposta correta', 'सही उत्तर', 'Bonne réponse', 'тачан одговор', 'اجابة صحيحة'),
(133, 'answer', 'Answer', 'Respuesta', 'Responda', 'उत्तर', 'Répondre', 'одговор', 'إجابة'),
(134, 'no_response', 'Unanswered', 'Sin responder', 'Sem resposta', 'अनुत्तरित', 'Sans réponse', 'без одговора', 'لم يتم الرد عليها'),
(135, 'solved_in', 'Solved in', 'Resuelto en', 'Resolvido em', 'में हल', 'Résolu dans', 'Решено', 'حلها في'),
(136, 'correct_answers', 'Correct answers', 'Respuestas correctas', 'Respostas corretas', 'सही उत्तर', 'Bonnes réponses', 'Тачне одговоре', 'الإجابات الصحيحة'),
(137, 'average', 'Average', 'Promedio', 'Média', 'औसत', 'Moyenne', 'просек', 'معدل'),
(138, 'homework_details', 'Homework details', 'Detalles de la tarea', 'Detalhes do dever de casa', 'होमवर्क विवरण', 'Détail des devoirs', 'Домаћи детаљи', 'تفاصيل الواجبات المنزلية'),
(139, 'send_teacher_comment', 'Send a comment to the teacher', 'Enviar un comentario al profesor', 'Envie um comentário ao professor', 'शिक्षक को एक टिप्पणी भेजें', 'Envoyer un commentaire à l\'enseignant', 'Пошаљите коментар наставнику', 'إرسال تعليق إلى المعلم'),
(140, 'premissions', 'ss', 'Permisos', '', '', '', 'Дозволе', 'أذونات'),
(141, 'apply', 'Apply', 'Aplicar', 'Aplique', 'लागू करें', 'Appliquer', 'Аплиразлог', 'تطبيق'),
(142, 'reason', 'Reason', 'Motivo', 'Razão', 'कारण', 'Raison', 'разлог', 'السبب'),
(143, 'from', 'From', 'Desde', 'A partir de', 'से', 'De', 'Од', 'من عند'),
(144, 'until', 'Until', 'Hasta', 'Até', 'जब तक', 'Jusqu\'à', 'све док', 'حتى'),
(145, 'approved', 'Approved', 'Aprobado', 'Aprovado', 'मंजूर की', 'Approuvé', 'Одобрен', 'وافق'),
(146, 'rejected', 'Rejected', 'Rechazado', 'Rejeitado', 'अस्वीकृत', 'Rejeté', 'одбијен', 'مرفوض'),
(147, 'create', 'Create', 'Crear', 'Crio', 'सर्जन करना', 'Créer', 'Створити', 'خلق'),
(148, 'code', 'Code', 'Código', 'Código', 'कोड', 'Code', 'Код', 'الشفرة'),
(149, 'priority', 'Priority', 'Prioridad', 'Prioridade', 'प्राथमिकता', 'Priorité', 'Приоритет', 'أفضلية'),
(150, 'high', 'High', 'Alta', 'Alto', 'उच्च', 'Haute', 'Високо', 'متوسط'),
(151, 'pending', 'Pending', 'Pendiente', 'Pendente', 'अपूर्ण', 'en attendant', 'У току', 'قيد الانتظار'),
(152, 'create_teacher_report', 'Create teacher report', 'Nuevo reporte de profesor', 'Criar relatório do professor', 'शिक्षक रिपोर्ट बनाएं', 'Créer un rapport d\'enseignant', 'Нови извештај учитеља', 'إنشاء تقرير المعلم'),
(153, 'report', 'Report', 'Reporte', 'Relatório', 'रिपोर्ट', 'rapport', 'извештај', 'أبلغ عن'),
(154, 'low', 'Low', 'Baja', 'Baixo', 'कम', 'Faible', 'Ниско', 'منخفض'),
(155, 'middle', 'Middle', 'Media', 'Meio', 'मध्य', 'Milieu', 'Средњи', 'وسط'),
(156, 'files', 'Files', 'Archivos', 'arquivos', 'फ़ाइलें', 'Des dossiers', 'фајлови', 'ملفات'),
(157, 'view_report', 'View report', 'Ver reporte', 'Exibir relatório', 'रिपोर्ट देखें', 'Voir le rapport', 'Погледај извештај', 'عرض التقرير'),
(158, 'active', 'Active', 'Activo', 'Ativo', 'सक्रिय', 'actif', 'Активан', 'نشيط'),
(159, 'personal_information', 'Personal information', 'Información personal', 'Informação pessoal', 'व्यक्तिगत जानकारी', 'Informations personnelles', 'лична информација', 'معلومات شخصية'),
(160, 'update_password', 'Update password', 'Actualizar contraseña', 'Atualizar senha', 'पासवर्ड अपडेट करें', 'Update password', 'Ажурирање лозинке', 'تطوير كلمة السر'),
(161, 'photo', 'Profile Photo', 'Fotografía', 'Foto de perfil', 'प्रोफाइल फोटो', 'Photo de profil', 'Фотографије', 'صورة الملف الشخصي'),
(162, 'update', 'Update', 'Actualizar', 'Atualizar', 'अद्यतन', 'Mettre à jour', 'ажурирање', 'تحديث'),
(163, 'take_exam', 'Take exam', 'Tomar examen', 'Fazer exame', 'परीक्षा लो', 'Passer un examen', 'полаже испит', 'خذ الامتحان'),
(164, 'total_questions', 'Total Questions', 'Preguntas totales', 'Perguntas totais', 'कुल सवाल', 'Total des questions', 'Укупно питање', 'مجموع الأسئلة'),
(165, 'duration', 'Duration', 'Duración', 'Duração', 'अवधि', 'Durée', 'трајање', 'المدة الزمنية'),
(166, 'minutes', 'minutes', 'minutos', 'minutos', 'मिनट', 'minutes', 'минута', 'الدقائق'),
(167, 'average_required', 'Average required', 'Promedio requerido', 'Média requerida', 'औसत आवश्यक', 'Moyenne requise', 'Потребан просек', 'متوسط المطلوب'),
(168, 'answer_all_questions', 'Answer all the questions before sending your exam.', 'Asegúrate de responder todas las preguntas antes de finalizar', 'Responda todas as perguntas antes de enviar seu exame', 'अपनी परीक्षा भेजने से पहले सभी प्रश्नों का उत्तर दें', 'Répondez à toutes les questions avant d\'envoyer votre examen.', 'Обавезно одговорите на сва питања пре него што завршите', 'أجب عن جميع الأسئلة قبل إرسال الامتحان.'),
(169, 'finish_message', 'When finished your results will be displayed automatically', 'Al finalizar se mostrarán tus resultados automáticamente', 'Quando terminar, seus resultados serão exibidos automaticamente', 'जब आपका परिणाम समाप्त हो जाए तो स्वचालित रूप से प्रदर्शित किया जाएगा', 'Une fois les résultats terminés, vos résultats s\'affichent automatiquement', 'Кад завршите, резултати ће се аутоматски приказивати', 'عند الانتهاء سيتم عرض النتائج تلقائيا'),
(170, 'important', 'IMPORTANT', 'IMPORTANTE', 'IMPORTANTE', 'जरूरी', 'IMPORTANT', 'Важно', 'مهم'),
(171, 'important_message', 'At the end of the exam, be sure to click on the End exam button, which is located on the top left', 'Al finalizar el examen asegúrate de hacer click en el botón Finaliza examen, que se encuentra en la parte superior izquierda', 'No final do exame, certifique-se de clicar no botão Executar final, que está localizado na parte superior esquerda', 'परीक्षा के अंत में, अंत परीक्षा बटन पर क्लिक करना सुनिश्चित करें, जो ऊपर बाईं ओर स्थित है', 'À la fin de l\'examen, assurez-vous de cliquer sur le bouton Fin de l\'examen, situé en haut à gauche', 'На крају испита обавезно кликните на дугме Заврши испит који се налази на врху', 'في نهاية الامتحان، تأكد من النقر على زر اختبار النهاية، والذي يقع أعلى اليمين'),
(172, 'start_exam', 'Start exam', 'Iniciar examen', 'Iniciar exame', 'प्रारंभिक परीक्षा', 'Examen de départ', 'Започните испит', 'بدء الاختبار'),
(173, 'online_exam', 'Online exam', 'Examen en línea', 'Exame on-line', 'ऑनलाइन परीक्षा', 'Examen en ligne', 'Онлине испит', 'الامتحان عبر الإنترنت'),
(174, 'time_left', 'Time left', 'Tiempo restante', 'Tempo restante', 'शेष समय', 'Temps restant', 'Преостало време', 'الوقت المتبقي'),
(175, 'finish_exam', 'Finish exam', 'Finalizar examen', 'Termine o exame', 'परीक्षा समाप्त करें', 'Fin de l\'examen', 'Завршни испит', 'إنهاء الامتحان'),
(176, 'success', 'Success', 'Exito', 'Sucesso', 'सफलता', 'Succès', 'Успех', 'نجاح'),
(177, 'success_delivery', 'Has been delivered', 'Has entregado esta tarea correctamente', 'Foi entregue', 'पहुँचा दिया गया है', 'A été livré', 'Успешно сте обавили овај задатак', 'تم تسليمها'),
(178, 'submitted_for_review', 'Submitted for review', 'Enviada para revisión', 'Enviado para revisão', 'समीक्षा के लिए सबमिट किया गया', 'Soumis pour examen', 'Поднесене на разматрање', 'تم تقديمه للمراجعة'),
(179, 'no_required', 'This task does not require you to submit a file, you can respond in the text box below.', 'Esta tarea no requiere que envíes un archivo en línea, puedes resolverla en el siguiente cuadro de texto, cuando finalices haz click en enviar', 'Não exigido', 'आवश्यक नहीं', 'Non requis', 'Овај задатак не захтева од вас да пошаљете датотеку на мрежи, можете је ријешити у сљедећем текстуалном пољу, када завршите са кликом на слање', 'لا حاجة'),
(180, 'users', 'Users', 'Usuarios', 'Users', 'उपयोगकर्ता', 'Utilisateurs', 'Корисници', 'المستخدمين'),
(181, 'notifications', 'Notifications', 'Notificaciones', 'Notificações', 'सूचनाएं', 'Notifications', 'Обавештења', 'إخطارات'),
(182, 'behavior', 'Behavior', 'Disciplina', 'Comportamento', 'व्यवहार', 'Comportement', 'Понашање', 'سلوك'),
(183, 'accounting', 'Accounting', 'Contabilidad', 'Contabilidade', 'लेखांकन', 'Comptabilité', 'Рачуноводство', 'محاسبة'),
(184, 'teacher_files', 'Teacher files', 'Archivos para profesores', 'Arquivos de professores', 'शिक्षक फाइलें', 'Fichiers d\'enseignant', 'Наставничке датотеке', 'ملفات المعلم'),
(185, 'classrooms', 'Classrooms', 'Salones de clases', 'Salas de aula', 'कक्षाओं', 'Salles de classe', 'Учионице', 'الفصول الدراسية'),
(186, 'school_bus', 'School bus', 'Bus escolar', 'Ônibus escolar', 'स्कूल बस', 'Bus scolaire', 'школски аутобус', 'باص المدرسة'),
(187, 'system_settings', 'System Settings', 'Ajustes del sistema', 'Configurações de sistema', 'प्रणाली व्यवस्था', 'Les paramètres du système', 'Подешавања система', 'اعدادات النظام'),
(188, 'academic_settings', 'Academic Settings', 'Ajustes académicos', 'Configurações acadêmicas', 'अकादमिक सेटिंग्स', 'Paramètres académiques', 'Академске поставке', 'الإعدادات الأكاديمية'),
(189, 'add_student', 'Add student', 'Agregar estudiante', 'Adicionar aluno', 'छात्र जोड़ें', 'Ajouter un étudiant', 'Додајте ученике', 'إضافة طالب'),
(190, 'admissions', 'Admissions', 'Admisiones', 'Admissões', 'प्रवेश', 'Admissions', 'Пријем', 'القبول'),
(191, 'students_area', 'Students area', 'Area de estudiantes', 'Área de estudantes', 'छात्र क्षेत्र', 'Zone étudiante', 'Подручје студената', 'Students area'),
(192, 'student_portal', 'Student portal', 'Portal de estudiantes', 'Portal do estudante', 'विद्यार्थी पोर्टल', 'Portail étudiant', 'Студентски портал', 'البوابة طالب'),
(193, 'upload_marks', 'Upload marks', 'Subir calificaciones', 'Fazer upload de marcas', 'अंकों को अपलोड करें', 'Télécharger des marques', 'Квалификација отпреме', 'علامات التحميل'),
(194, 'tabulation_sheet', 'Tabulation sheet', 'Hoja de tabulación', 'Folha de tabulação', 'सारणी पत्र', 'Feuille de tabulation', 'Табеларни лист', 'جدول تبويب'),
(195, 'teacher_attendance', 'Teacher attendance', 'Asistencia de profesores', 'Assistência dos professores', 'शिक्षक उपस्थिति', 'Participation des enseignantsRapport de présence de l\'enseignant', 'Присуство наставника', 'حضور المعلم'),
(196, 'teacher_attendance_report', 'Teacher attendance report', 'Reporte de asistencia de profesores', 'Relatório de comparecimento de professores', 'शिक्षक उपस्थिति रिपोर्ट', 'Rapport de présence de l\'enseignant', 'Извештај о присуству наставника', 'تقرير حضور المدرسين'),
(197, 'teacher_routine', 'Teacher routine', 'Horario de profesores', 'Rotina dos professores', 'शिक्षक दिनचर्या', 'La routine des enseignants', 'Наставник рутина', 'روتين المعلم'),
(198, 'send_news', 'Send news', 'Enviar noticias', 'Enviar notícias', 'समाचार भेजें', 'Envoyer des nouvelles', 'Пошаљи вести', 'إرسال الأخبار'),
(199, 'add_event', 'Add event', 'Agregar evento', 'Adicionar Evento', 'कार्यक्रम जोड़ें', 'Ajouter un évènement', 'Додајте догађај', 'إضافة حدث'),
(200, 'update_book', 'Update book', 'Actualizar libro', 'Atualizar livro', 'अद्यतन किताब', 'Mettre à jour le livre', 'Ажурирање књиге', 'تحديث الكتاب'),
(201, 'student_permissions', 'Student permissions', 'Permisos de estudiantes', 'Permissões do aluno', 'छात्र अनुमतियाँ', 'Autorisations d\'élève', 'Студентске дозволе', 'أذونات الطالب'),
(202, 'teacher_permissions', 'Teacher permissions', 'Permisos de profesores', 'Permissões do professor', 'शिक्षक अनुमतियां', 'Autorisations d\'enseignant', 'Студентске дозволе', 'أذونات المعلم'),
(203, 'student_payments', 'Student payments', 'Pagos de estudiantes', 'Pagamentos de estudantes', 'छात्र भुगतान', 'Paiements aux étudiants', 'Студентска уплата', 'دفعات الطالب'),
(204, 'expense', 'Expense', 'Egresos', 'Despesa', 'व्यय', 'Frais', 'Трошак', 'مصروف'),
(205, 'poll_details', 'Poll details', 'Detalles de la encuesta', 'Detalhes da pesquisa', 'पोल विवरण', 'Détails du sondage', 'Детаљи истраживања', 'تفاصيل الاستطلاع'),
(206, 'sms', 'SMS', 'SMS', 'SMS', 'एसएमएस', 'SMS', 'CMC', 'رسالة قصيرة'),
(207, 'email_settings', 'Email settings', 'Ajustes de correo', 'Configurações de e-mail', 'ईमेल सेटिंग्स', 'Paramètres de messagerie', 'Поставке е-поште', 'إعدادات البريد الإلكتروني'),
(208, 'translate', 'Translate', 'Traducción', 'Traduzir', 'अनुवाद करना', 'Traduire', 'превести', 'ترجمه'),
(209, 'database', 'Database', 'Base de datos', 'Base de dados', 'डेटाबेस', 'Base de données', 'база података', 'قاعدة البيانات'),
(210, 'manage_class', 'Manage classes', 'Grados', 'Gerenciar aulas', 'कक्षाएं प्रबंधित करें', 'Gérer les cours', 'Менаџер класе', 'إدارة الطبقات'),
(211, 'sections', 'Sections', 'Secciones', 'Seções', 'धारा', 'Sections', 'Одељак', 'الأقسام'),
(212, 'semesters', 'Semesters', 'Unidades', 'Semestres', 'सेमेस्टर', 'Semestres', 'Семестре', 'فصول دراسية'),
(213, 'student_promotion', 'Student promotion', 'Promover estudiantes', 'Promoção estudantil', 'छात्र पदोन्नति', 'Promotion étudiante', 'Промоција студената', 'ترقية الطلاب'),
(214, 'event', 'Event', 'Evento', 'Evento', 'घटना', 'un événement', 'Догађај', 'هدف'),
(215, 'pending_users', 'Pending users', 'Usuarios pendientes', 'Usuários pendentes', 'लंबित उपयोगकर्ता', 'Les utilisateurs en attente', 'Очекивани корисници', 'المستخدمون في انتظار المراجعة'),
(216, 'new', 'New', 'Nuevo', 'Novo', 'नया', 'Nouveau', 'Ново', 'الجديد'),
(217, 'account_type', 'Account type', 'Tipo de cuenta', 'Tipo de conta', 'खाते का प्रकार', 'Type de compte', 'Тип рачуна', 'نوع الحساب'),
(218, 'super_admin', 'Super admin', 'Propietario', 'Super admin', 'सुपर व्यवस्थापक', 'Super admin', 'Супер админ', 'سوبر المشرف'),
(219, 'delete', 'Delete', 'Eliminar', 'Excluir', 'हटाना', 'Effacer', 'Избрисати', 'حذف'),
(220, 'add_new', 'Add new', 'Agregar nuevo', 'Adicionar novo', 'नया जोड़ें', 'Ajouter un nouveau', 'Додај нови', 'اضف جديد'),
(221, 'upload', 'Upload', 'Subir', 'Envio', 'अपलोड', 'Télécharger', 'отпремити', 'تحميل'),
(222, 'save', 'Save', 'Guardar', 'Salve', 'बचाना', 'sauvegarder', 'сачувати', 'حفظ'),
(223, 'salary', 'Salary', 'Salario', 'Salário', 'वेतन', 'Un salaire', 'Плата', 'راتب'),
(224, 'add', 'Add', 'Agregar', 'Adicionar', 'जोड़ना', 'Ajouter', 'додати', 'إضافة'),
(225, 'single_student', 'Single Student', 'Estudiante individual', 'Único estudante', 'एकल छात्र', 'Étudiant unique', 'Један студент', 'طالب واحد'),
(226, 'student_bulk', 'Student bulk', 'Múltiples estudiantes', 'Student bulk', 'छात्र थोक', 'Élève en vrac', 'Више ученика', 'الطالب الأكبر'),
(227, 'excel_import', 'Import from excel', 'Importar desde excel', 'Importar do excel', 'एक्सेल से आयात करें', 'Importation depuis Excel', 'Екцел импорт', 'تسجيل النموذج'),
(228, 'register_form', 'Register form', 'Formulario de registro', 'Formulário de registro', 'रजिस्टर फॉर्म', 'Formulaire d\'inscription', 'Регистарски образац', 'أضف المزيد'),
(229, 'add_more', 'Add more', 'Agregar más', 'Adicione mais', 'अधिक जोड़ें', 'Ajouter plus', 'Додај још', 'أضف المزيد'),
(230, 'download_model', 'Download model', 'Descargar modelo', 'Baixar modelo', 'डाउनलोड मॉडल', 'Télécharger le modèle', 'Довнлоад модел', 'تحميل النموذج'),
(231, 'import', 'Import', 'Importar ', 'Importar', 'आयात', 'Importer', 'увоз', 'استيراد'),
(232, 'accept', 'Accept', 'Aceptar', 'Aceitar', 'स्वीकार करना', 'Acceptez', 'Прихватити', 'قبول'),
(233, 'reject', 'Reject', 'Rechazar', 'Rejeitar', 'अस्वीकार', 'Rejeter', 'одбити', 'رفض'),
(234, 'new_password', 'New password', 'Nueva contrasela', 'Nova senha', 'नया पासवर्ड', 'Nouveau mot de passe', 'Нова лозинка', 'كلمة السر الجديدة'),
(235, 'assigned_subjects', 'Assigned Subjects', 'Cursos asignados', 'Assuntos Assinados', 'सौंपा विषय', 'Sujets assignés', 'Додељени предмети', 'الموضوعات المخصصة'),
(236, 'assigned_students', 'Assigned Students', 'Estudiantes asignados', 'Alunos Atribuídos', 'असाइन किए गए छात्र', 'Étudiants affectés', 'Додијељени студенти', 'الطلاب المعينين'),
(237, 'all', 'All', 'Todos', 'Todos', 'सब', 'Tout', 'све', 'الكل'),
(238, 'addres', 'Address', 'Dirección', 'Endereço', 'पता', 'Adresse', 'Адреса', 'عنوان'),
(239, 'inactive', 'Inactive', 'Inactivo', 'Inativo', 'निष्क्रिय', 'Inactif', 'Неактиван', 'غير نشط'),
(240, 'semester', 'Semester', 'Unidad', 'Semestre', 'छमाही', 'Semestre', 'Семестар', 'نصف السنة'),
(241, 'update_activities', 'Update activities', 'Actualizar acividades', 'Atualizar atividades', 'गतिविधियों को अपडेट करें', 'Activités de mise à jour', 'Активности ажурирања', 'تحديث الأنشطة'),
(242, 'student_attendance_report', 'Student Attendance Report', 'Reporte de asistencia estudiantes', 'Relatório de presença de estudantes', 'छात्र उपस्थिति रिपोर्ट', 'Rapport de présence des étudiants', 'Извештај о ученику', 'تقرير حضور الطالب'),
(243, 'present', 'Present', 'Presente', 'Presente', 'वर्तमान', 'Présent', 'поклон', 'حاضر'),
(244, 'late', 'Late', 'Tarde', 'Atrasado', 'देर से', 'En retard', 'Касни', 'متأخر'),
(245, 'absent', 'Absent', 'Ausente', 'Ausente', 'अनुपस्थित', 'Absent', 'Одсутан', 'غائب'),
(246, 'add_class_routine', 'Add class routine', 'Agregar horario de clases', 'Adicionar rotina de classe', 'क्लास रूटीन जोड़ें', 'Ajouter une routine de classe', 'Додајте распоред распореда', 'إضافة روتين الطبقة'),
(247, 'day', 'Day', 'Día', 'Dia', 'दिन', 'journée', 'Дан', 'يوم'),
(248, 'monday', 'Monday', 'Lunes', 'Segunda-feira', 'सोमवार', 'Lundi', 'Понедељак', 'الإثنين'),
(249, 'tuesday', 'Tuesday', 'Martes', 'terça', 'मंगलवार', 'Mardi', 'Уторак', 'الثلاثاء'),
(250, 'wednesday', 'Wednesday', 'Miércoles', 'Quarta-feira', 'बुधवार', 'Mercredi', 'Среда', 'الأربعاء'),
(251, 'thursday', '', 'Jueves', 'Quinta-feira', 'गुरूवार', 'Jeudi', 'Четвртак', 'الخميس'),
(252, 'time_start', 'Time start', 'Hora de inicio', 'Início do tempo', 'समय प्रारंभ', 'Démarrage du temps', 'Почетак времена', 'بداية الوقت'),
(253, 'hour', 'Hour', 'Hora', 'Hora', 'घंटा', 'Heure', 'Сат', 'ساعة'),
(254, 'time_end', 'Time end', 'Hora final', 'Fim do tempo', 'समय समाप्ति', 'Fin du temps', 'Временски крај', 'نهاية الوقت'),
(255, 'friday', '', 'Viernes', 'Sexta-feira', 'शुक्रवार', 'Vendredi', 'Петак', 'يوم الجمعة'),
(256, 'add_news', 'Add news', 'Agregar noticia', 'Adicione notícias', 'समाचार जोड़ें', 'Ajouter des nouvelles', 'Додајте вести', 'إضافة أخبار'),
(257, 'edit', 'Edit', 'Editar', 'Editar', 'संपादित करें', 'modifier', 'Уредити', 'تصحيح'),
(258, 'update_news', 'Update news', 'Actualizar noticia', 'Atualizar notícias', 'न्यूज अपडेट करें', 'Actualiser les nouvelles', 'Ажурирајте вести', 'آخر الأخبار'),
(259, 'featured_image', 'Featured image', 'Imagen destacada', 'Imagem em destaque', 'निरूपित चित्र', 'L\'image sélectionnée', 'садржавана слика', 'صورة مميزة'),
(260, 'notice', 'Notice', 'Noticia', 'Aviso prévio', 'नोटिस', 'Remarquer', 'објава', 'تنويه'),
(261, 'add_book', 'Add book', 'Agregar libro', 'Adicionar livro', 'पुस्तक जोड़ें', 'Ajouter un livre', 'Додајте књигу', 'إضافة كتاب'),
(262, 'available', 'Available', 'Disponible', 'acessível', 'उपलब्ध', 'Disponible', 'доступан', 'متاح'),
(263, 'unavailable', 'Unavailable', 'No disponible', 'Indisponível', 'अनुपलब्ध', 'Indisponible', 'Недоступан', 'غير متوفره'),
(264, 'book', 'Book', 'Libro', 'Livro', 'किताब', 'Livre', 'Књига', 'كتاب'),
(265, 'image', 'Image', 'Imagen', 'Imagem', 'छवि', 'Image', 'слика', 'صورة'),
(266, 'other', 'Other', 'Otros', 'De outros', 'अन्य', 'Autre', 'Други', 'آخر'),
(267, 'reports', 'Reports', 'Reportes', 'Relatórios', 'रिपोर्ट', 'Rapports', 'извештаји', 'تقارير'),
(268, 'student_reports', 'Student reports', 'Reporte de estudiantes', 'Relatórios estudantis', 'छात्र रिपोर्ट', 'Rapports d\'étudiants', 'Студентски извештаји', 'تقارير الطالب'),
(269, 'create_report', 'Create report', 'Crear reporte', 'Criar relatório', 'रिपोर्ट बनाएं', 'Creer un rapport', 'Креирајте извештај', 'إنشاء تقرير'),
(270, 'created_by', 'Created by', 'Creado por', 'Criado por', 'के द्वारा बनाई गई', 'Créé par', 'Креирана од стране', 'صنع من قبل'),
(271, 'teacher_reports', 'Teacher reports', 'Reporte de profesores', 'Relatórios dos professores', 'शिक्षक की रिपोर्ट', 'Rapports des enseignants', 'Извјештај учитеља', 'تقارير المعلم'),
(272, 'medium', 'Medium', 'Media', 'Médio', 'मध्यम', 'Moyen', 'Средња', 'متوسط'),
(273, 'upload_file', 'Upload file', 'Subir archivo', 'Subir arquivo', 'दस्तावेज अपलोड करें', 'Téléverser un fichier', 'отпреми датотекуc', 'رفع ملفتفاصيل التقرير'),
(274, 'report_details', 'Report details', 'Detalles del reporte', 'Informar detalhes', 'रिपोर्ट का विवरण', 'Signaler des détails', 'Извештај детаље', 'تفاصيل التقرير'),
(275, 'mark_solved', 'Mark as resolved', 'Marcar como resuelto', 'Marcar como resolvido', 'सही के रूप में चिन्हित करो', 'Marquer comme résolu', 'Означи као ријешено', 'وضع علامة على أنه تم حلها'),
(276, 'user_report', 'Created by', 'Usuario que reporta', 'Reporting User', 'रिपोर्टिंग उपयोगकर्ता', 'Reporting utilisateur', 'Кориснички извештај', 'الإبلاغ عن المستخدم'),
(277, 'user', 'User', 'Usuario', 'Do utilizador', 'उपयोगकर्ता', 'Utilisateur', 'Корисник', 'المستعمل'),
(278, 'no_options', 'No options', 'No hay opciones', 'Sem opções', 'कोई विकल्प नहीं', 'Aucune option', 'Нема опција', 'لا توجد خيارات'),
(279, 'invoice_details', 'Invoice details', 'Detalles de la factura', 'Detalhes da factura', 'चालान विवरण', 'Détails de la facture', 'Детаљи фактуре', 'تفاصيل الفاتورة'),
(280, 'payment_details', 'Payment details', 'Detalles del pago', 'Detalhes do pagamento', 'भुगतान विवरण', 'Détails de paiement', 'Подаци о плаћању', 'بيانات الدفع'),
(281, 'completed', 'Completed', 'Completado', 'Concluído', 'पूरा कर लिया है', 'Terminé', 'Завршено', 'منجز'),
(282, 'method', 'Method', 'Método', 'Método', 'तरीका', 'méthode', 'Метода', 'طريقة'),
(283, 'card', 'Card', 'Tarjeta', 'Cartão', 'कार्ड', 'Carte', 'Картица', 'بطاقة'),
(284, 'cash', 'Cash', 'Efectivo', 'Dinheiro', 'कैश', 'En espèces', 'Готовина', 'السيولة النقدية'),
(285, 'check', 'Check', 'Cheque', 'Check', 'चेक', 'Vérifier', 'Провери', 'التحقق من'),
(286, 'create_invoice', 'Create invoice', 'Crear factura', 'Criar recibo', 'इनवॉयस बनाएँ', 'Créer une facture', 'Креирајте фактуру', 'إنشاء فاتورة'),
(287, 'new_payment', 'New payment', 'Nuevo pago', 'Novo pagamento', 'नया भुगतान', 'Nouveau paiement', 'Нова уплата', 'دفعة جديدة'),
(288, 'expenses', 'Expenses', 'Egresos', 'Despesas', 'व्यय', 'Dépenses', 'трошкови', 'نفقات'),
(289, 'invoices', 'Invoices', 'Facturas', 'Faturas', 'चालान', 'Factures', 'Фактуре', 'الفواتير'),
(290, 'history', 'Payment history', 'Historial', 'Histórico de pagamento', 'भुगतान इतिहास', 'Historique de paiement', 'Историја', 'سجل الدفعات'),
(291, 'add_class_room', 'Add classroom', 'Agregar salon de clases', 'Adicionar sala de aula', 'कक्षा जोड़ें', 'Ajouter une salle de classe', 'Додајте учионицу', 'إضافة فصل دراسي'),
(292, 'number', 'Number', 'Número', 'Número', 'संख्या', 'Nombre', 'број', 'رقم'),
(293, 'route', 'Route', 'Ruta', 'Rota', 'मार्ग', 'Route', 'рута', 'طريق'),
(294, 'bus_id', 'Bus ID', 'ID del bus', 'Bus ID', 'बस आईडी', 'Identifiant du bus', 'Бус ид', 'معرف الحافلة'),
(295, 'driver', 'Driver name', 'Conductor', 'Nome do motorista', 'चालक का नाम', 'Nom du conducteur', 'Возач', 'اسم السائق'),
(296, 'driver_phone', 'Driver phone', 'Celular del conductor', 'Driver phone', 'चालक फोन', 'Téléphone du pilote', 'Управљачки телефон', 'هاتف السائق'),
(297, 'transport_name', 'Transport name', 'Nombre del bus', 'Nome do transporte', 'परिवहन का नाम', 'Nom du transport', 'Име транспорта', 'اسم النقل'),
(299, 'driver_name', 'Driver name', 'Nombre del conductor', 'Nome do motorista', 'चालक का नाम', 'Nom du conducteur', 'Име возача', 'اسم السائق'),
(300, 'create_poll', 'Create poll', 'Crear encuesta', 'Create poll', 'मतदान बनाएं', 'Créer un sondage', 'Створити анкету', 'إنشاء استطلاع الرأي'),
(301, 'more_options', 'More options', 'Más opciones', 'Mais opções', 'अधिक विकल्प', 'Plus d\'options', 'Више опција', 'خيارات أخرى'),
(302, 'system_name', 'System name', 'Nombre del sistema', 'Nome do sistema', 'सिस्टम का नाम', 'Nom du système', 'Име система', 'اسم النظام'),
(303, 'logo', 'Logotype', 'Logotipo', 'Logótipo', 'लोगोटाइप', 'Logotype', 'Лого', 'الشعار'),
(304, 'system_title', 'System title', 'Título del sistema', 'Título do sistema', 'सिस्टम शीर्षक', 'Titre du système', 'Назив система', 'عنوان النظام'),
(305, 'language', 'Language', 'Idioma', 'Língua', 'भाषा', 'La langue', 'Језик', 'لغة'),
(306, 'currency', 'Currency', 'Moneda', 'Moeda', 'मुद्रा', 'Devise', 'Валута', 'دقة'),
(307, 'paypal_email', 'PayPal email', 'Correo de PayPal', 'PayPal email', 'पे पल ईमेल', 'Email Paypal', 'Емаил паипал', 'بريد باي بال'),
(308, 'running_year', 'Running year', 'Año en curso', 'Ano corrente', 'वर्ष चल रहा है', 'Année courante', 'Године', 'تشغيل العام'),
(309, 'personalization', 'Personalization', 'Personalización', 'Personalização', 'निजीकरण', 'Personnalisation', 'Персонализација', 'إضفاء الطابع الشخصي'),
(310, 'theme', 'Theme', 'Tema', 'Tema', 'विषय', 'Thème', 'Тема', 'المقدمة'),
(311, 'sms_service', 'SMS Service', 'Servicio de SMS', 'SMS Service', 'एसएमएस सेवा', 'Service SMS', 'Смс сервис', 'خدمة الرسائل القصيرة'),
(312, 'disabled', 'Disabled', 'Desactivado', 'Disabled', 'विकलांग', 'désactivé', 'Онемогућено', 'معاق'),
(313, 'notify_send', 'What notifications do you want to send?', '¿Qué notificaciones desea enviar?', 'Quais notificações você deseja enviar?', 'आप कौन से अधिसूचनाएं भेजना चाहते हैं?', 'Quelles notifications voulez-vous envoyer?', 'Које обавештења желите послати?', 'ما الإخطارات التي تريد إرسالها؟'),
(314, 'for_parents', 'For parents', 'Para padres', 'Para os pais', 'माता - पिता के लिए', 'Pour les parents', 'За родитеље', 'للوالدين'),
(315, 'absences', 'Absences', 'Ausencias', 'Ausências', 'अनुपस्थिति', 'Absences', 'Одсуства', 'الغياب'),
(316, 'students_reports', 'Student reports', 'Reportes académicos', 'Relatórios estudantis', 'छात्र रिपोर्ट', 'Rapports d\'étudiants', 'Студенти извештавају', 'تقارير الطالب'),
(317, 'new_invoice', 'New invoice', 'Nueva factura', 'Nova factura', 'नया चालान', 'Nouvelle facture', 'Нова фактура', 'فاتورة جديدة'),
(318, 'for_students', 'For students', 'Para estudiantes', 'Para estudantes', 'छात्रों के लिए', 'Pour les étudiants', 'За студенте', 'للطلاب'),
(319, 'new_homework', 'New homework', 'Nueva tarea', 'Nova tarefa de casa', 'नया होमवर्क', 'Nouveau travail', 'Нови домаћи задатак', 'الواجبات المنزلية الجديدة'),
(320, 'smtp_host', 'SMTP Hostname', 'Host SMTP', 'SMTP Host', 'एसएमटीपी होस्टनाम', 'SMTP Hostname', 'Смпт хост', 'SMTP Hostname'),
(321, 'smtp_port', 'SMTP Port', 'Puerto SMTP', 'SMTP Port', 'एसएमटीपी पोर्ट', 'SMTP Port', 'Смпт порт', 'SMTP Port'),
(322, 'smtp_timeout', 'SMTP Timeout', 'Tiempo de espera', 'SMTP Timeout', 'एसएमटीपी समयबाह्य', 'SMTP Timeout', 'Смтп тимеоут', 'SMTP Timeout'),
(323, 'smtp_user', 'SMTP User', 'Usuario SMTP', 'SMTP User', 'एसएमटीपी उपयोगकर्ता', 'SMTP User', 'Смтп корисник', 'SMTP User'),
(324, 'smtp_password', 'SMTP Password', 'Contraseña SMTP', 'SMTP Password', 'एसएमटीपी पासवर्ड', 'SMTP Password', 'Смтп лозинка', 'SMTP Password'),
(325, 'charset', 'Charset', 'Tipo de caracter', 'Charset', 'harset', 'Charset', 'Цхарсет', 'محارف'),
(326, 'mail_type', 'Mailtype', 'Tipo de correo', 'Mailtype', 'Mailtype', 'Mailtype', 'Маил порука', 'Mailtype'),
(327, 'email_templates', 'Email templates', 'Plantillas de correo', 'Modelos de e-mail', 'ईमेल टेम्पलेट्स', 'Modèles d\'email', 'Емаил предлоге', 'قوالب البريد الإلكتروني'),
(328, 'send_marks', 'Send marks', 'Enviar calificaciones', 'Enviar marcas', 'अंक भेजें', 'Envoyer des marques', 'Пошаљи оцене', 'إرسال علامات'),
(329, 'bulk_email', 'Bulk email', 'Correos masivos', 'E-mail em massa', 'थोक ईमेल', 'Courrier électronique en vrac', 'Масовна пошта', 'البريد الإلكتروني السائبة'),
(330, 'languages', 'Languages', 'Idiomas', 'línguas', 'बोली', 'Langues', 'Језици', 'اللغات'),
(331, 'create_backup', 'Create system backup', 'Crear copia de seguridad', 'Criar backup do sistema', 'सिस्टम बैकअप बनाएं', 'Créer une sauvegarde système', 'Креирајте резервну копију', 'إنشاء نظام النسخ الاحتياطي'),
(332, 'restore_backup', 'Restore system backup', 'Restaurar copia de seguridad', 'Restaurar o backup do sistema', 'सिस्टम बैकअप पुनर्स्थापित करें', 'Restaurer la sauvegarde du système', 'Враћајте резервну копију', 'استعادة النسخ الاحتياطي للنظام'),
(333, 'restore', 'Restore', 'Restaurar', 'Restaurar', 'पुनर्स्थापित', 'Restaurer', 'Вратити', 'استعادة'),
(334, 'minimum_mark', 'Minimum mark to pass a subject', 'Nota mínima para aprobar un curso', 'Marca mínima para passar um assunto', 'किसी विषय को पास करने के लिए न्यूनतम अंक', 'Marque minimale pour transmettre un sujet', 'Минимална оцена за пролазак на курс', 'علامة الحد الأدنى لتمرير موضوع'),
(335, 'use_saturday', 'Use Saturday and Sunday at class routine?', '¿Utilizar sábado y domingo en horarios?', 'Use sábado e domingo no classroutine?', 'कक्षा नियमानुसार शनिवार और रविवार का उपयोग करें?', 'Utilisez le samedi et le dimanche à la routine de cours?', 'Користите суботу и недељу понекад?', 'استخدام السبت والأحد في روتين الطبقة؟'),
(336, 'yes', 'Yes', 'Si', 'sim', 'हाँ', 'Oui', 'да', 'نعم فعلا'),
(337, 'no', 'No ', 'No', 'No', 'नहीं', 'Non', 'не', 'لا'),
(338, 'classes', 'Classes', 'Grados', 'Aulas', 'कक्षाएं', 'Des classes', 'Часови', 'الطبقات'),
(339, 'start', 'Start', 'Iniciar', 'Começar', 'प्रारंभ', 'Début', 'почетак', 'بداية'),
(340, 'end', 'End', 'Fin', 'Fim', 'समाप्त', 'Fin', 'крај', 'النهاية'),
(341, 'runnig_year', 'Running year', 'Año en curso', 'Ano corrente', 'वर्ष चल रहा है', 'Année courante', 'Године', 'تشغيل العام'),
(342, 'year_to_promote', 'Year to promote', 'Año a promover', 'Ano de promoção', 'प्रोत्साहन के लिए वर्ष', 'Année de promotion', 'Годину за промоцију', 'السنة لتعزيز'),
(343, 'promote', 'Promote', 'Promover', 'Promover', 'को बढ़ावा देना', 'Promouvoir', 'Промовисати', 'تروج \\ يشجع \\ يعزز \\ ينمى \\ يطور'),
(344, 'promoted', 'Already promoted', 'Promovido', 'Já promovido', 'पहले से ही पदोन्नत', 'Déjà promu', 'Промовисана', 'تمت ترقيته بالفعل'),
(345, 'promote_to', 'Promote to', 'Promover a', 'Promover para', 'को बढ़ावा देना', 'Promouvoir', 'Промовисати', 'الترقية إلى'),
(346, 'send_marks_sms', 'Send marks notification by SMS', 'Enviar notificación de calificaciones por SMS', 'Enviar notificação de marca por SMS', 'एसएमएस द्वारा नोटिस भेजें', 'Envoyer une note de notification par SMS', 'Слање обавештења о квалификацијама путем СМС-а', 'إرسال علامات الإخطار عن طريق الرسائل القصيرة'),
(347, 'notification', 'Notification', 'Notificación', 'Notificação', 'अधिसूचना', 'Notification', 'Обавештење', 'إعلام'),
(348, 'send_sms', 'Send SMS', 'Enviar SMS', 'Enviar SMS', 'संदेश भेजो', 'Envoyer un SMS', 'послати СМС', 'أرسل رسالة نصية قصيرة'),
(349, 'my_subjects', 'My subjects', 'Mis cursos', 'Meus assuntos', 'मेरे विषय', 'Mes sujets', 'Моје субјекте', 'موضوعاتي'),
(350, 'my_routine', 'My routine', 'Mi horario', 'Minha rotina', 'मेरा दिनचर्या', 'Ma routine', 'моја рутина', 'روتين بلدي'),
(351, 'academic', 'Academic', 'Académico', 'Acadêmico', 'अकादमिक', 'Académique', 'Академски', 'أكاديمي'),
(352, 'student_absences', 'Student absences', 'Ausencias de estudiantes', 'Ausências estudantis', 'छात्र अनुपस्थिति', 'Les absences des étudiants', 'Одсуство студената', 'تغيب الطالب'),
(353, 'parent_new_invoice', 'New invoice (Parents)', 'Nueva factura (Padres)', 'Nova fatura (Pais)', 'नया चालान (अभिभावक)', 'Nouvelle facture (Parents)', 'Нова фактура (родитељ)', 'فاتورة جديدة (أولياء الأمور)'),
(354, 'student_new_invoice', 'New invoice (Students)', 'Nueva factura (Estudiantes)', 'Nova factura (Estudantes)', 'नया चालान (छात्र)', 'Nouvelle facture (étudiants)', 'Нови рачун (студенти)', 'فاتورة جديدة (طلاب)'),
(355, 'email_subject', 'Email subject', 'Asunto del correo', 'Assunto do email', 'ईमेल विषय', 'Sujet du courriel', 'Емаил субјецт', 'موضوع البريد الإلكتروني'),
(356, 'email_body', 'Email body', 'Contenido del correo', 'Corpo do email', 'ईमेल बॉडी', 'Courrier électronique', 'Емаил тело', 'هيئة البريد الإلكتروني'),
(357, 'reciever', 'Receiver', 'Receptor', 'Receptor', 'रिसीवर', 'Récepteur', 'Пријемник', 'المتلقي'),
(358, 'view_marks', 'View marks', 'Ver calificaciones', 'Ver marcas', 'देखें अंक', 'Afficher les marques', 'Погледајте ознаке', 'عرض علامات'),
(359, 'new_exam', 'New exam', 'Nuevo examen', 'Novo exame', 'नई परीक्षा', 'Nouvel examen', 'Нови испит', 'امتحان جديد'),
(360, 'start_hour', 'Start hour', 'Hora de inicio', 'Hora de início', 'शुरुआती घंटे', 'Heure de début', 'Почните сат', 'بدء الساعة'),
(361, 'end_hour', 'End hour', 'Hora de finalización', 'Hora final', 'समाप्ति समय', 'Heure de fin', 'Крај сата', 'نهاية الساعة'),
(362, 'exam_duration', 'Exam duration (in minutes)', 'Duración del examen (en minutos)', 'Tempo de exame em minutos', 'मिनटों में परीक्षा का समय', 'Durée de l\'examen (en minutes)', 'Време испитивања (у минутима)', 'مدة الامتحان (بالدقائق)'),
(363, 'exam_details', 'Exam details', 'Detalles del examen', 'Detalhes do Exame', 'परीक्षा विवरण', 'Détails de l\'examen', 'Испитни детаљи', 'تفاصيل الامتحان'),
(364, 'questions', 'Questions', 'Preguntas', 'Questões', 'प्रशन', 'Des questions', 'Питање', 'الأسئلة'),
(365, 'exam_questions', 'Exam questions', 'Preguntas del examen', 'Perguntas do exame', 'परीक्षा प्रश्न', 'Questions d\'examen', 'Испитна питања', 'أسئلة الامتحان'),
(366, 'add_question', 'Add question', 'Agregar pregunta', 'Adicionar pergunta', 'प्रश्न जोड़ें', 'Ajouter une question', 'Додајте питање', 'إضافة سؤال'),
(367, 'option', 'Option', 'Opción', 'Opção', 'विकल्प', 'Option', 'опција', 'اختيار'),
(368, 'exams_results', 'Exam results', 'Resultados del examen', 'Resultados dos exames', 'परीक्षा के परिणाम', 'Résultats d\'examen', 'Резултати испита', 'نتائج الامتحانات'),
(369, 'update_exam', 'Update exam', 'Actualizar examen', 'Exame de atualização', 'परीक्षा अपडेट करें', 'Examen de mise à jour', 'Ажурирајте испит', 'تحديث الاختبار'),
(370, 'start_clock', 'Start hour', 'Hora de inicio', 'Hora de início', 'शुरुआती घंटे', 'Heure de début', 'Започети сат', 'بدء الساعة'),
(371, 'end_clock', 'End hour', 'Hora de finalización', 'Hora final', 'समाप्ति समय', 'Heure de fin', 'Крај сата', 'نهاية الساعة'),
(372, 'no_file', 'No file available', 'Sin archivo', 'Nenhum arquivo disponível', 'कोई फ़ाइल उपलब्ध नहीं है', 'Aucun fichier disponible', 'нема фајла', 'لا يتوفر أي ملف'),
(373, 'study_meterial', 'ss', 'Material de estudio', '', '', '', 'Студијски материјал', ''),
(374, 'add_homework', 'Add homework', 'Agregar tarea', 'Adicione lição de casa', 'होमवर्क जोड़ें', 'Ajouter les devoirs', 'Додајте домаћи задатак', 'إضافة الواجبات المنزلية'),
(375, 'homework_type', 'Homework type', 'Tipo de tarea', 'Tipo de lição de casa', 'होमवर्क का प्रकार', 'Type de devoir', 'Домаћи тип', 'نوع الواجبات المنزلية'),
(376, 'online_text', 'Online text', 'Texto en línea', 'Texto em linha', 'ऑनलाइन पाठ', 'Texte en ligne', 'Онлине текст', 'النص عبر الإنترنت'),
(377, 'limit_hour', 'Limit hour', 'Hora límite', 'Hora limite', 'सीमा घंटे', 'Heure limite', 'Ограничити сат', 'ساعة الحد'),
(378, 'deliveries', 'Deliveries', 'Entregas', 'Entregas', 'वितरण', 'Livraisons', 'Испоруке', 'التسليم'),
(379, 'total_students', 'Total students', 'Estudiantes totales', 'Total de alunos', 'कुल छात्रों', 'Nombre total d\'étudiants', 'Укупно ученика', 'إجمالي الطلاب'),
(380, 'delivered', 'Delivered', 'Entregada', 'Entregue', 'पहुंचा दिया', 'Livré', 'испоручена', 'تم التوصيل'),
(381, 'undeliverable', 'Undeliverable', 'Sin entregar', 'Não-entregável', 'गैर-वितरण योग्य', 'Non livrable', 'Унделиверабле', 'غير قابلة للتسليم');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `spanish`, `portuguese`, `hindi`, `french`, `serbian`, `arabic`) VALUES
(382, 'student_comment', 'Student comment', 'Comentario del estudiante', 'Comentário do aluno', 'छात्र टिप्पणी', 'Commentaire de l\'élève', 'Студентски коментар', 'تعليق الطالب'),
(383, 'delivery_status', 'Delivery status', 'Estado de la entrega', 'Status de entrega', 'वितरण की स्थिति', 'Statut de livraison', 'Статус испоруке', 'حالة التسليم'),
(384, 'file_response', 'File/Response', 'Archivo/Respuesta', 'Arquivo / Resposta', 'फ़ाइल / प्रतिक्रिया', 'Fichier / Réponse', 'Одговор на фајл', 'ملف / الاستجابة'),
(385, 'delayed_delivery', 'Delivery after time', 'Entrega tarde', 'Entrega após o tempo', 'समय के बाद वितरण', 'Livraison après le temps', 'Одложена испорука', 'التسليم بعد الوقت'),
(386, 'update_homework', 'Update homework', 'Actualizar tarea', 'Atualize a lição de casa', 'होमवर्क अपडेट करें', 'Mettre à jour les devoirs', 'Ажурирати домаћи задатак', 'تحديث الواجبات المنزليةv'),
(387, 'delivery_type', 'Delivery type', 'Tipo de entrega', 'Tipo de entrega', 'वितरण के प्रकार', 'Type de livraison', 'Тип испоруке', 'نوع التوصيل'),
(388, 'new_discussion', 'New discussion', 'Nueva discusión ', 'Nova discussão', 'नई चर्चा', 'Nouvelle discussion', 'Нова дискусија', 'مناقشة جديدة'),
(389, 'publish', 'Publish', 'Publicar', 'Publicar', 'प्रकाशित करना', 'Publier', 'Објавити', 'نشر'),
(390, 'update_forum', 'Update forum', 'Actualizar foro', 'Atualizar fórum', 'फ़ोरम अपडेट करें', 'Forum de mise à jour', 'Упдате форум', 'تحديث المنتدى'),
(391, 'uploaded_by', 'Uploaded by', 'Subido por', 'Enviado por', 'द्वारा डाली गई', 'telechargé par', 'Уплоадед би', 'تم الرفع بواسطة'),
(392, 'send_bulk_emails', 'Send bulk email', 'Enviar correos masivos', 'Enviar e-mail em massa', 'थोक ईमेल भेजें', 'Envoyer un courrier électronique en bloc', 'Пошаљите масе е-поште', 'إرسال البريد الإلكتروني المجمع'),
(393, 'categories', 'Categories', 'Categorías', 'Categorias', 'श्रेणियाँ', 'Catégories', 'Категорије', 'الاقسام'),
(394, 'new_expense', 'New expense', 'Nuevo egreso', 'Nova despesa', 'नया खर्च', 'Nouvelle dépense', 'Ново издање', 'حساب جديد'),
(395, 'category', 'Category', 'Categoría', 'Categoria', 'वर्ग', 'Catégorie', 'Категорија', 'الفئة'),
(396, 'new_category', 'New category', 'Nueva categoria', 'Nova categoria', 'नई श्रेणी', 'Nouvelle catégorie', 'Нова категорија', 'فئة جديدة'),
(397, 'confirm_delete', 'Do you want to delete the information?', 'Seguro desea eliminar la información?', 'Deseja excluir as informações?', 'क्या आप जानकारी को हटाना चाहते हैं?', 'Voulez-vous supprimer les informations?', 'Да ли желите да обришете информације?', 'هل تريد حذف المعلومات؟'),
(398, 'confirm_approval', 'Surely you want to approve?', 'Confirma que desea aprobar?', 'Certamente você quer aprovar?', 'निश्चित रूप से आप स्वीकृति देना चाहते हैं?', 'Vous voulez certainement approuver?', 'Да ли желите да одобрите?', 'بالتأكيد كنت ترغب في الموافقة؟'),
(399, 'confirm_reject', 'Insurance do you want to reject?', 'Confirma que desea rechazar?', 'Seguro você quer rejeitar?', 'बीमा क्या आप अस्वीकार करना चाहते हैं?', 'Assurance voulez-vous rejeter?', 'Да ли желите да одбијете?', 'التأمين هل تريد أن ترفض؟'),
(400, 'confirm_delete_student', 'Are you sure you want to remove the student?', 'Confirma que desea eliminar al estudiante?', 'Tem certeza de que deseja remover o aluno?', 'क्या आप वाकई छात्र को निकालना चाहते हैं?', 'Êtes-vous sûr de vouloir supprimer l\'étudiant?', 'Да ли желите да избришете ученика?', 'هل تريد بالتأكيد إزالة الطالب؟'),
(401, 'confirm_solved', 'Are you sure you want to mark as resolved?', 'Seguro desea marcar como resuelto?', 'Tem certeza de que deseja marcar como resolvido?', 'क्या आप वाकई हल के रूप में चिह्नित करना चाहते हैं?', 'Êtes-vous sûr de vouloir marquer comme résolu?', 'Осигурање желите означити као ријешено?', 'هل تريد بالتأكيد وضع علامة على أنه تم حلها؟'),
(402, 'notification_center', 'Notification center', 'Centro de notificaciones', 'Centro de Notificação', 'सूचना केन्द्र', 'Centre de notification', 'Обавештење центар', 'مركز إعلام'),
(403, 'welcome_notifications', 'Welcome to the notification center', 'Bienvenido al centro de notificaciones', 'Bem-vindo ao centro de notificação', 'अधिसूचना केंद्र में आपका स्वागत है', 'Bienvenue au centre de notification', 'Добродошли у центар за обавештења', 'مرحبا بكم في مركز الإعلام'),
(404, 'what_send', 'What do you want to notify today?', '¿Qué notificaciones desea enviar?', 'O que você quer notificar hoje?', 'आज आपको क्या सूचित करना है?', 'Que souhaitez-vous notifier aujourd\'hui?', 'Које обавештења желите послати?', 'ماذا تريد أن تخطر اليوم؟'),
(405, 'send_email', 'Send email', 'Enviar correo', 'Enviar email', 'ईमेल भेजें', 'Envoyer un courrier électronique', 'Пошаљи пошту', 'ارسل بريد الكتروني'),
(406, 'successfully_added', 'Successfully added information', 'Información agregada con éxito', 'nformações adicionadas com sucesso', 'सफलतापूर्वक जानकारी जोड़ा', 'Informations ajoutées avec succès', 'Успешно додано', 'تمت إضافة معلومات بنجاح'),
(407, 'successfully_updated', 'Information updated successfully', 'Información actualizada con éxito', 'Informações atualizadas com sucesso', 'सूचना सफलतापूर्वक अपडेट की गई', 'Informations mises à jour avec succès', 'Успешно ажуриран', 'تم تحديث المعلومات بنجاح'),
(408, 'successfully_deleted', 'Information deleted successfully', 'Información eliminada con éxito', 'Informações eliminadas com sucesso', 'जानकारी सफलतापूर्वक हटाई गई', 'Informations supprimées avec succès', 'Успешно избрисан', 'تم حذف المعلومات بنجاح'),
(409, 'sent_successfully', 'Information sent successfully', 'Información enviada con éxito', 'Informações enviadas com sucesso', 'सूचना सफलतापूर्वक भेजी गई', 'Informations envoyées avec succès', 'Послато успешно', 'تم إرسال المعلومات بنجاح'),
(410, 'successfully_uploaded', 'Information uploaded successfully', 'Información subida con éxito', 'Informações carregadas com sucesso', 'सूचना सफलतापूर्वक अपलोड की गई', 'Informations téléchargées avec succès', 'Успешно постављен', 'تم تحميل المعلومات بنجاح'),
(411, 'reply_sent', 'Reply sent', 'Respuesta enviada', 'Resposta enviada', 'उत्तर भेजा', 'Réponse envoyée', 'Одговор послат', 'تم إرسال الرد'),
(412, 'message_sent', 'Message sent', 'Mensaje enviado', 'Mensagem enviada', 'मैसेज बेजा गया', 'Message envoyé', 'Порука послата', 'تم الارسال'),
(413, 'limit_questions', 'To add more questions configure the exam to accept more', 'Para agregar más preguntas configura el examen para aceptar más', 'Para adicionar mais perguntas configure o exame para aceitar mais', 'और अधिक प्रश्न जोड़ने के लिए अधिक स्वीकार करने के लिए परीक्षा को कॉन्फ़िगर करें', 'Pour ajouter d\'autres questions, configurez l\'examen pour accepter plus', 'Да бисте додали још питања, конфигурирајте испит да бисте прихватили више', 'لإضافة المزيد من الأسئلة، يمكنك تهيئة الاختبار لقبول المزيد'),
(414, 'delivered_homework', 'Homework successfully delivered', 'Tarea entregada correctamente', 'Tarefa entregue corretamente.', 'कार्य सफलतापूर्वक वितरित', 'Travail à domicile livré avec succès', 'Задатак је исправно достављен', 'تم تسليم الواجبات المنزلية بنجاح'),
(415, 'paid', 'Paid', 'Pagado', 'Paid', 'भुगतान किया', 'Payé', 'Плаћени', 'دفع'),
(416, 'unpaid', 'Unpaid', 'Sin pagar', 'Unpaid', 'वेतन के बिना', 'Non payé', 'Неплаћен', 'غير مدفوع'),
(417, 'social', 'Socials', 'Social', 'Social', 'सामाजिक', 'Socials', 'Социјално', 'سيالز'),
(418, 'no_questions', 'No. Questions', 'No. de Preguntas', 'Pergunta Total', 'कोई प्रश्न नहीं', 'Question totale', 'Укупно питање', 'إجمالي السؤال'),
(419, 'on_time', 'On time', 'A tiempo', 'Na Hora', 'समय पर', 'À temps', 'На време', 'في الوقت المحدد'),
(420, 'view_response', 'View response', 'Ver respuesta', 'Ver resposta', 'प्रतिक्रिया देखें', 'Voir la réponse', 'Погледајте одговор', 'عرض الرد'),
(421, 'success_password', 'Your password has been reset successfully. This is your new password:', 'Tu password ha sido reseteado exitosamente. Éste es tu nuevo password:', 'Sua senha foi reiniciada com sucesso. Esta é a sua nova senha:', 'आपका पासवर्ड सफलतापूर्वक रीसेट कर दिया गया है यह आपका नया पासवर्ड है:', 'Votre mot de passe a été réinitialisé avec succès. Ceci est votre nouveau mot de passe:', 'Ваша лозинка је успјешно ресетована. Ово је ваша нова лозинка:', 'تمت إعادة تعيين كلمة المرور بنجاح. هذه هي كلمة المرور الجديدة:'),
(422, 'message_group', 'Group Message', 'Mensaje en grupo', NULL, NULL, NULL, NULL, ''),
(423, 'groups', 'Groups', 'Grupos', NULL, NULL, NULL, NULL, ''),
(424, 'create_group', 'Create group', 'Crear un grupo', NULL, NULL, NULL, NULL, ''),
(425, 'select_group_or', 'Select group or', 'Seleccionar un grupo o', NULL, NULL, NULL, NULL, ''),
(426, 'group_members', 'Group members', 'Miembros del grupo', NULL, NULL, NULL, NULL, ''),
(427, 'user_type', 'User type', 'Tipo de profesor', NULL, NULL, NULL, NULL, ''),
(428, 'user_permissions', 'User permissions', 'Permisos del usuario', NULL, NULL, NULL, NULL, ''),
(429, 'add_language', 'Add language', 'Agregar idioma', NULL, NULL, NULL, NULL, ''),
(430, 'flag', 'Flag', 'Bandera', NULL, NULL, NULL, NULL, ''),
(431, 'grades', 'Grade leves', 'Niveles de grado', NULL, NULL, NULL, NULL, ''),
(432, 'mark_from', 'Mark from', 'Desde', NULL, NULL, NULL, NULL, ''),
(433, 'mark_to', 'Mark to', 'Hasta', NULL, NULL, NULL, NULL, ''),
(434, 'point', 'Point', 'Punto', NULL, NULL, NULL, NULL, ''),
(435, 'grade', 'Grade', 'Grado', NULL, NULL, NULL, NULL, ''),
(436, 'participants', 'Participants', 'Participantes', NULL, NULL, NULL, NULL, ''),
(437, 'google_err', 'This email address is already being used by another user, to be able to add it first it must be deactivated from the other account', 'Esta dirección de email ya esta siendo utilizada por otro usuario, para poder agregarla primero debe ser desactivada desde la otra cuenta', NULL, NULL, NULL, NULL, ''),
(438, 'google_true', 'Your Google account has been linked successfully', 'Tu cuenta de Google se ha vinculado con éxito', NULL, NULL, NULL, NULL, ''),
(439, 'facebook_true', 'Your Facebook account has been linked successfully', 'Tu cuenta de Facebook se ha vinculado con éxito', NULL, NULL, NULL, NULL, ''),
(440, 'facebook_err', 'This Facebook account is already being used by another user, to be able to add it first it must be deactivated from the other profile', 'Esta cuenta de Facebook ya esta siendo utilizada por otro usuario, para poder agregarla primero debe ser desactivada desde el otro perfil', NULL, NULL, NULL, NULL, ''),
(441, 'facebook_delete', 'Your Facebook account has been successfully unlinked', 'Tu cuenta de Facebook se ha desvinculado correctamente', NULL, NULL, NULL, NULL, ''),
(442, 'google_delete', 'Your Google account has been successfully unlinked', 'Tu cuenta de Facebook se ha desvinculado correctamente', NULL, NULL, NULL, NULL, ''),
(443, 'my_notifications', 'My Notifications', 'Mis notificaciones', NULL, NULL, NULL, NULL, ''),
(444, 'absence_approved', 'You have approved your leave of absence.', 'Ha aprobado tu permiso de ausencia.', NULL, NULL, NULL, NULL, ''),
(445, 'absence_rejected', 'You have rejected your leave of absence.', 'Ha rechazado tu permiso de ausencia.', NULL, NULL, NULL, NULL, ''),
(446, 'absence_approved_for', 'Has approved the leave of absence for', 'Ha aprobado el permiso de ausencia para', NULL, NULL, NULL, NULL, ''),
(447, 'absence_rejected_for', 'You have rejected the leave of absence to', 'Ha rechazado el permiso de ausencia para', NULL, NULL, NULL, NULL, ''),
(448, 'new_homework_notify', 'You have created a new homework with the title', 'Ha creado una nueva tarea con el título', NULL, NULL, NULL, NULL, ''),
(449, 'homework_rated', 'has rated your homework', 'ha calificado tu tarea', NULL, NULL, NULL, NULL, ''),
(450, 'study_material_notify', 'You have uploaded study material to your portal', 'Ha subido material de estudio a tu portal', NULL, NULL, NULL, NULL, ''),
(451, 'online_exam_notify', 'added a new online exam with the title', 'agregó un nuevo examen en línea con el título', NULL, NULL, NULL, NULL, ''),
(452, 'news_notify', 'You have received a new news with title', 'Has recibido una nueva noticia con título', NULL, NULL, NULL, NULL, ''),
(453, 'event_notify', 'A new event has been created with the title', 'Se ha creado un nuevo evento con el título', NULL, NULL, NULL, NULL, ''),
(454, 'new_comment', 'Added a new comment on', 'Agregó un nuevo comentario en', NULL, NULL, NULL, NULL, ''),
(455, 'report_solved', 'It has been marked as solved', 'Se ha marcado como resuelto', NULL, NULL, NULL, NULL, ''),
(456, 'unit_content', 'has uploaded files in Unit Contents for', 'ha subido archivos en Contenidos de Unidad para', NULL, NULL, NULL, NULL, ''),
(457, 'book_added', 'has added a new book to the library for', 'ha agregado un nuevo libro a la biblioteca para', NULL, NULL, NULL, NULL, ''),
(458, 'file_uploaded', 'Uploaded a file for teachers with the title', 'Subió un archivo para profesores con el título', NULL, NULL, NULL, NULL, ''),
(459, 'absence_request', 'has requested a new leave of absence to', 'ha solicitado un nuevo permiso de ausencia para', NULL, NULL, NULL, NULL, ''),
(460, 'reg_teacher', 'A new user has been registered as a teacher with the name', 'Se ha registrado un nuevo usuario como profesor con el nombre', NULL, NULL, NULL, NULL, ''),
(461, 'reg_student', 'A new user has been registered as a student with the name', 'Se ha registrado un nuevo usuario como estudiante con el nombre', NULL, NULL, NULL, NULL, ''),
(462, 'reg_parent', 'A new user has been registered as a parent with the name', 'Se ha registrado un nuevo usuario como padre con el nombre', NULL, NULL, NULL, NULL, ''),
(463, 'finish_exam_notify', 'has finished the exam', 'ha finalizado el examen', NULL, NULL, NULL, NULL, ''),
(464, 'teacher_report_notify', 'has created a new report for the teacher', 'ha creado un nuevo reporte para el profesor', NULL, NULL, NULL, NULL, ''),
(465, 'comment_forum', 'has posted a comment in the forum', 'ha publicado un comentario en el foro', NULL, NULL, NULL, NULL, ''),
(466, 'student_report_notify', 'has created a new report for the student', 'ha creado un nuevo reporte para el estudiante', NULL, NULL, NULL, NULL, ''),
(467, 'marks_notify', 'has updated the marks of', 'ha actualizado las calificaciones de', NULL, NULL, NULL, NULL, ''),
(468, 'absense_teacher', 'has requested a new leave of absence', 'ha solicitado un nuevo permiso de ausencia', NULL, NULL, NULL, NULL, ''),
(469, 'new_message_notify', 'has sent you a new message', 'te ha enviado un nuevo mensaje', NULL, NULL, NULL, NULL, ''),
(470, 'at', 'at', 'a las', NULL, NULL, NULL, NULL, ''),
(471, 'login_facebook', 'Login with Facebook', 'Acceder con Facebook', NULL, NULL, NULL, NULL, ''),
(472, 'login_google', 'Login with Google', 'Acceder con Google', NULL, NULL, NULL, NULL, ''),
(473, 'login_error', 'There is an error in the login, verify and try again', 'Hay un error en el inicio de sesión, verifica y vuelve a intentarlo nuevamente', NULL, NULL, NULL, NULL, ''),
(474, 'social_error', 'Sorry, you can not sign in with this account you must first link it to your user profile', 'Lo sentimos, no puedes iniciar sesión con esta cuenta primero debes vincularla a tu perfil de usuario', NULL, NULL, NULL, NULL, ''),
(475, 'calendar', 'Calendar', 'Calendario', NULL, NULL, NULL, NULL, ''),
(476, 'my_files', 'My files', 'Mis archivos', NULL, NULL, NULL, NULL, ''),
(477, 'system_reports', 'System reports', 'Reportes del Sistema', NULL, NULL, NULL, NULL, ''),
(478, 'settings', 'Settings', 'Ajustes', NULL, NULL, NULL, NULL, ''),
(479, 'minimize_menu', 'Minimize menu', 'Minimizar menu', NULL, NULL, NULL, NULL, ''),
(480, 'search_students', 'Search students', 'Buscar estudiantes', NULL, NULL, NULL, NULL, ''),
(481, 'you', 'You', 'Tu', NULL, NULL, NULL, NULL, ''),
(482, 'view_all_messages', 'View all messages', 'Ver todos los mensajes', NULL, NULL, NULL, NULL, ''),
(483, 'view_all_notifications', 'View all notifications', 'Ver todas las notificationes', NULL, NULL, NULL, NULL, ''),
(484, 'my_account', 'My Account', 'Mi cuenta', NULL, NULL, NULL, NULL, ''),
(485, 'my_profile', 'My profile', 'Mi perfil', NULL, NULL, NULL, NULL, ''),
(486, 'what_publish', 'What do you want to publish today?', 'qué deseas publicar hoy?', NULL, NULL, NULL, NULL, ''),
(487, 'upload_image', 'Upload image', 'Subir imagen', NULL, NULL, NULL, NULL, ''),
(488, 'poll', 'Poll', 'Encuesta', NULL, NULL, NULL, NULL, ''),
(489, 'go_to_details', 'Go to details', 'Ir a los detalles', NULL, NULL, NULL, NULL, ''),
(490, 'welcome_admin_dashboard', 'Welcome to your admin dashboard.', 'Bienvenido a tu tablero de administrador.', NULL, NULL, NULL, NULL, ''),
(491, 'no_today_events', 'There are no events today', 'No hay eventos para hoy', NULL, NULL, NULL, NULL, ''),
(492, 'this_month_is_birthday', 'This month is the birthday of', 'Este mes es el cumpleaños de', NULL, NULL, NULL, NULL, ''),
(493, 'view_all_birthdays', 'View all birthdays', 'Ver todos los cumpleaños', NULL, NULL, NULL, NULL, ''),
(494, 'absent_students', 'Absent', 'Estudiantes ausentes', NULL, NULL, NULL, NULL, ''),
(495, 'no_absent_students', 'No students absent', 'No hay estudiantes ausentes', NULL, NULL, NULL, NULL, ''),
(496, 'select_an_option', 'Select an option', 'Seleccionar una ocion', NULL, NULL, NULL, NULL, ''),
(497, 'chats', 'Chats', 'Chats', NULL, NULL, NULL, NULL, ''),
(498, 'write', 'Write', 'Escribir', NULL, NULL, NULL, NULL, ''),
(499, 'librarian', 'Librarian', 'Bibliotecaria', NULL, NULL, NULL, NULL, ''),
(500, 'accountant', 'Accountant', 'Contadora', NULL, NULL, NULL, NULL, ''),
(501, 'create_message', 'Create message', 'Crear mensaje', NULL, NULL, NULL, NULL, ''),
(502, 'shared_files', 'Shared files', 'Archivos compartidos', NULL, NULL, NULL, NULL, ''),
(503, 'without_shared_files', 'There are no shared files', 'Sin archivos compartidos', NULL, NULL, NULL, NULL, ''),
(504, 'shared_photos', 'Shared photos', 'Fotos compartidas', NULL, NULL, NULL, NULL, ''),
(505, 'without_shared_pictures', 'There are no shared photos', 'Sin fotos compartidas', NULL, NULL, NULL, NULL, ''),
(506, 'viewed', 'Seen', 'Visto', NULL, NULL, NULL, NULL, ''),
(507, 'your_notifications', 'Your notifications', 'Tus notifications', NULL, NULL, NULL, NULL, ''),
(508, 'member_since', 'Member since', 'Miembro desde', NULL, NULL, NULL, NULL, ''),
(509, 'identification', 'Personal document', 'Identificación', NULL, NULL, NULL, NULL, ''),
(510, 'quick_links', 'Quick links', 'Enlaces rápidos', NULL, NULL, NULL, NULL, ''),
(511, 'update_information', 'Update information', 'Actualizar información', NULL, NULL, NULL, NULL, ''),
(512, 'your_linked_accounts', 'Your linked accounts', 'Tus cuentas vinculadas', NULL, NULL, NULL, NULL, ''),
(513, 'link', 'Link', 'Vincular', NULL, NULL, NULL, NULL, ''),
(514, 'update_profile', 'Update profile', 'Actualizar perfil', NULL, NULL, NULL, NULL, ''),
(515, 'first_name', 'First name', 'Nombre', NULL, NULL, NULL, NULL, ''),
(516, 'last_name', 'Last name', 'Apellido', NULL, NULL, NULL, NULL, ''),
(517, 'student_details', 'Student details', 'Detalles del estudiante', NULL, NULL, NULL, NULL, ''),
(518, 'parent_details', 'Parent details', 'Detalles del padre', NULL, NULL, NULL, NULL, ''),
(519, 'complementary_data', 'Complementary data', 'Información complementaria', NULL, NULL, NULL, NULL, ''),
(520, 'transport', 'School bus', 'Transporte', NULL, NULL, NULL, NULL, ''),
(521, 'next', 'Next', 'Siguiente', NULL, NULL, NULL, NULL, ''),
(522, 'new_parent_admission', 'Select an parent', 'Nuevo padre', NULL, NULL, NULL, NULL, ''),
(523, 'new_parent_admission_message', 'If you want to add a new parent, mark this option', 'Si dese agregar un nuevo padre marque esta opción', NULL, NULL, NULL, NULL, ''),
(524, 'select_parent', 'Select parent', 'Seleccionar un padre', NULL, NULL, NULL, NULL, ''),
(525, 'home_phone', 'Home phone', 'Telefono de casa', NULL, NULL, NULL, NULL, ''),
(526, 'business_work', 'Workplace', 'Lugar de trabajo', NULL, NULL, NULL, NULL, ''),
(527, 'phone_work', 'Work phone', 'Telefono de trabajo', NULL, NULL, NULL, NULL, ''),
(528, 'conditions_or_diseases', 'Conditions or diseases', 'Condiciones o enfermedades', NULL, NULL, NULL, NULL, ''),
(529, 'allergies', 'Allergies', 'Alergías', NULL, NULL, NULL, NULL, ''),
(530, 'personal_doctor', 'Personal doctor', 'Doctor personal', NULL, NULL, NULL, NULL, ''),
(531, 'doctor_phone', 'Doctor phone', 'Telefono del doctor', NULL, NULL, NULL, NULL, ''),
(532, 'athorized_person', 'Authorized person', 'Persona autorizada', NULL, NULL, NULL, NULL, ''),
(533, 'phone_authorized_person', 'Authorized person phone', 'Telefono persona autorizada', NULL, NULL, NULL, NULL, ''),
(534, 'notes', 'Notes', 'Notas', NULL, NULL, NULL, NULL, ''),
(535, 'already_exist', 'Username already exist', 'El usuario ya existe', NULL, NULL, NULL, NULL, ''),
(536, 'accountants', 'Accountants', 'Contadoras', NULL, NULL, NULL, NULL, ''),
(537, 'librarians', 'Librarians', 'Bibliotecarias', NULL, NULL, NULL, NULL, ''),
(538, 'admin_permissions', 'Admin permissions', 'Permisos de administrador', NULL, NULL, NULL, NULL, ''),
(539, 'all_permissions', 'All permissions', 'Todos los permisos', NULL, NULL, NULL, NULL, ''),
(540, 'new_account', 'New account', 'Nueva cuenta', NULL, NULL, NULL, NULL, ''),
(541, 'search', 'Search', 'Buscar', NULL, NULL, NULL, NULL, ''),
(542, 'return', 'Return', 'Regresar', NULL, NULL, NULL, NULL, ''),
(543, 'upload_from_excel', 'Upload from excel', 'Subir desde excel', NULL, NULL, NULL, NULL, ''),
(544, 'export_students', 'Export students', 'Exportar estudiantes', NULL, NULL, NULL, NULL, ''),
(545, 'filter_by_class', 'Filter by class', 'Filtrar por grado', NULL, NULL, NULL, NULL, ''),
(546, 'export', 'Export', 'Exportar', NULL, NULL, NULL, NULL, ''),
(547, 'upload_students', 'Upload students', 'Subir estudiantes', NULL, NULL, NULL, NULL, ''),
(548, 'download_template', 'Download template', 'Descargar plantilla', NULL, NULL, NULL, NULL, ''),
(549, 'work_phone', 'Work phone', 'Telefono de trabajo', NULL, NULL, NULL, NULL, ''),
(550, 'authorized_person', 'Authorized person', 'Persona autorizada', NULL, NULL, NULL, NULL, ''),
(551, 'note', 'Notes', 'Notas', NULL, NULL, NULL, NULL, ''),
(552, 'authorized_person_phone', 'Authorized person phone', 'Telefono persona autorizada', NULL, NULL, NULL, NULL, ''),
(553, 'payments_history', 'Payments history', 'Historial de pagos', NULL, NULL, NULL, NULL, ''),
(554, 'view_details', 'View details', 'Ver detalles', NULL, NULL, NULL, NULL, ''),
(555, 'student_attendance', 'Students attendance', 'Asistencia de estudiante', NULL, NULL, NULL, NULL, ''),
(556, 'year', 'Year', 'Año', NULL, NULL, NULL, NULL, ''),
(557, 'student_marks', 'Student marks', 'Calificaciones', NULL, NULL, NULL, NULL, ''),
(558, 'student_invoices', 'Student invoices', 'Pagos de estudiantes', NULL, NULL, NULL, NULL, ''),
(559, 'payments_and_invoices', 'Payments and invoices', 'Pagos y Facturas', NULL, NULL, NULL, NULL, ''),
(560, 'atendance', 'Attendance', 'Asistencia', NULL, NULL, NULL, NULL, ''),
(561, 'add_schedule', 'Add class routine', 'Agregar horario', NULL, NULL, NULL, NULL, ''),
(562, 'add_schedules', 'Add class routine', 'Agregar horarios', NULL, NULL, NULL, NULL, ''),
(563, 'course', 'Subject', 'Curso', NULL, NULL, NULL, NULL, ''),
(564, 'sunday', 'Sunday', 'Domingo', NULL, NULL, NULL, NULL, ''),
(565, 'saturday', 'Saturday', 'Sábado', NULL, NULL, NULL, NULL, ''),
(566, 'add_routine', 'Add class routine', 'Agregar horario', NULL, NULL, NULL, NULL, ''),
(567, 'time', 'Time', 'Tiempo', NULL, NULL, NULL, NULL, ''),
(568, 'new_class', 'New class', 'Nuevo grado', NULL, NULL, NULL, NULL, ''),
(569, 'create_new_class', 'Create new class', 'Crear nuevo grado', NULL, NULL, NULL, NULL, ''),
(570, 'new_subject', ' New subject', 'Nuevo curso', NULL, NULL, NULL, NULL, ''),
(571, 'create_new_subject', 'Create new subject', 'Crear nuevo curso', NULL, NULL, NULL, NULL, ''),
(572, 'icon', 'Subject icon', 'Icono', NULL, NULL, NULL, NULL, ''),
(573, 'color', 'Subject color', 'Color', NULL, NULL, NULL, NULL, ''),
(574, 'subject_dashboard', 'Subject dashboard ', 'Tablero de curso', NULL, NULL, NULL, NULL, ''),
(575, 'view_exam', 'View exam', 'Ver examen', NULL, NULL, NULL, NULL, ''),
(576, 'view_forum', 'View forum', 'Ver foro', NULL, NULL, NULL, NULL, ''),
(577, 'view_homework', 'View homework', 'Ver tarea', NULL, NULL, NULL, NULL, ''),
(578, 'subject_activity', 'Subject activity', 'Actividad del curso', NULL, NULL, NULL, NULL, ''),
(579, 'latest_news', 'Latest news', 'Ultimas noticias', NULL, NULL, NULL, NULL, ''),
(580, 'teacher_of_the_subject', 'Teacher of the subject', 'Profesor del curso', NULL, NULL, NULL, NULL, ''),
(581, 'confirm_publish', 'Sure you want to publish the information?', 'Seguro desea publicar la información?', NULL, NULL, NULL, NULL, ''),
(582, 'publish_exam', 'Publish exam', 'Publicar examen', NULL, NULL, NULL, NULL, ''),
(583, 'published', 'Published', 'Publicado', NULL, NULL, NULL, NULL, ''),
(584, 'confirm_expired', 'Sure you want to mark as expired?', 'Seguro desea marcar como expirado', NULL, NULL, NULL, NULL, ''),
(585, 'mark_as_expired', 'Mark as expired', 'Marcar como expirado', NULL, NULL, NULL, NULL, ''),
(586, 'expired', 'Expired', 'Expirado', NULL, NULL, NULL, NULL, ''),
(587, 'start_time', 'Start time', 'Hora de inicio', NULL, NULL, NULL, NULL, ''),
(588, 'end_time', 'End time', 'Hora limite', NULL, NULL, NULL, NULL, ''),
(589, 'minimum_percentage', 'Minimum percentage', 'Porcentaje minimo', NULL, NULL, NULL, NULL, ''),
(590, 'allow_homework_deliveries', 'Allow deliveries up to', 'Permitir entregas hasta', NULL, NULL, NULL, NULL, ''),
(591, 'no_published', 'Not published', 'No publicado', NULL, NULL, NULL, NULL, ''),
(592, 'show_students', 'Show to students', 'Mostrar a los estudiantes?', NULL, NULL, NULL, NULL, ''),
(593, 'show_message', 'If you want students to see this information, enable this option.', 'Si desea mostrar la información a los estudiantes marque esta opción', NULL, NULL, NULL, NULL, ''),
(594, 'not_published', 'Not published', 'No publicado', NULL, NULL, NULL, NULL, ''),
(595, 'read_forum', 'Read forum', 'Leer foro', NULL, NULL, NULL, NULL, ''),
(596, 'new_topic', 'New topic', 'Nuevo tema', NULL, NULL, NULL, NULL, ''),
(597, 'topic', 'Topic', 'Tema', NULL, NULL, NULL, NULL, ''),
(598, 'reply', 'Reply', 'Responder', NULL, NULL, NULL, NULL, ''),
(599, 'upload_study_material', 'Upload study material', 'Subir material de estudio', NULL, NULL, NULL, NULL, ''),
(600, 'file_type', 'File type', 'Tipo de archivo', NULL, NULL, NULL, NULL, ''),
(601, 'book_request', 'Book request', 'Solicitudes de libros', NULL, NULL, NULL, NULL, ''),
(602, 'total_books', 'Total books', 'Libros totales', NULL, NULL, NULL, NULL, ''),
(603, 'total_copies', 'Total copies', 'Copias totales', NULL, NULL, NULL, NULL, ''),
(604, 'delivered_copies', 'Delivered copies', 'Copias entregadas', NULL, NULL, NULL, NULL, ''),
(605, 'available_message', ' If the book is available, enable this option', 'Si el libro esta disponible active esta opcion', NULL, NULL, NULL, NULL, ''),
(606, 'virtual_message', 'If it is a virtual book (PDF, Doc) enable this option', 'Si el libro es virtual (PDF, Doc) habilite esta opción', NULL, NULL, NULL, NULL, ''),
(607, 'upload_book', 'Upload book', 'Subir libro', NULL, NULL, NULL, NULL, ''),
(608, 'requested_by', 'Requested by', 'Solicitado por', NULL, NULL, NULL, NULL, ''),
(609, 'starting_date', 'Starting date', 'Fecha de inicio', NULL, NULL, NULL, NULL, ''),
(610, 'ending_date', 'Ending date', 'Fecha limite ', NULL, NULL, NULL, NULL, ''),
(611, 'no_actions', 'No more actions', 'Sin acciones', NULL, NULL, NULL, NULL, ''),
(612, 'calendar_events', 'Calendar events', 'Calendario de eventos', NULL, NULL, NULL, NULL, ''),
(613, 'edit_event', 'Edit event', 'Editar evento', NULL, NULL, NULL, NULL, ''),
(614, 'general_reports', 'General reports', 'Reporte general', NULL, NULL, NULL, NULL, ''),
(615, 'final_marks', 'FInal marks', 'Calificaciones finales', NULL, NULL, NULL, NULL, ''),
(616, 'class_report', 'Class report', 'Reporte de grado', NULL, NULL, NULL, NULL, ''),
(617, 'get_report', 'Get report', 'Generar reporte', NULL, NULL, NULL, NULL, ''),
(618, 'system_email', 'System email', 'Correo del sistema', NULL, NULL, NULL, NULL, ''),
(619, 'system_phone', 'System phone', 'Telefono del sistema', NULL, NULL, NULL, NULL, ''),
(620, 'allow_user_register', 'Allow users to create accounts', 'Permitir registros', NULL, NULL, NULL, NULL, ''),
(621, 'user_register_message', 'Users can register from the frontend if you enable this option', 'Permitir a los usuarios crear cuentas', NULL, NULL, NULL, NULL, ''),
(622, 'timezone', 'Timezone', 'Zona horaria', NULL, NULL, NULL, NULL, ''),
(623, 'social_login', 'Social login', 'Inicio de sesión con social', NULL, NULL, NULL, NULL, ''),
(624, 'enable_social_login', 'Enable social login', 'Habilitar inicio de sesión social', NULL, NULL, NULL, NULL, ''),
(625, 'social_login_message', 'Users can use their Google account and Facebook to login', 'Permita a los usuarios acceder con su cuenta de facebook y google', NULL, NULL, NULL, NULL, ''),
(626, 'logo_color', 'Logo color', 'Logo color', NULL, NULL, NULL, NULL, ''),
(627, 'logo_white', 'Logo white', 'Colo blanco', NULL, NULL, NULL, NULL, ''),
(628, 'icon_white', 'Icon white', 'Icono blanco', NULL, NULL, NULL, NULL, ''),
(629, 'favicon', 'Favicon', 'Favicon', NULL, NULL, NULL, NULL, ''),
(630, 'background', 'Background', 'Backrgound', NULL, NULL, NULL, NULL, ''),
(631, 'home', 'Home', 'Inicio', NULL, NULL, NULL, NULL, ''),
(632, 'total_income', 'Total income', 'Ingresos totales', NULL, NULL, NULL, NULL, ''),
(633, 'total_expense', 'Total expense', 'Egresos totales', NULL, NULL, NULL, NULL, ''),
(634, 'pending_payments', 'Pending payments', 'Pagos pendientes', NULL, NULL, NULL, NULL, ''),
(635, 'completed_payments', 'Completed payments', 'Pagos confirmados', NULL, NULL, NULL, NULL, ''),
(636, 'recent_income', 'Recent income', 'Ingresos recientes', NULL, NULL, NULL, NULL, ''),
(637, 'recent_expense', 'Recent expense ', 'Egresos recientes', NULL, NULL, NULL, NULL, ''),
(638, 'single_invoice', 'Single invoice', 'Factura individual', NULL, NULL, NULL, NULL, ''),
(639, 'bulk_invoice', 'Bulk invoice', 'Facturas multiples', NULL, NULL, NULL, NULL, ''),
(640, 'add_category', 'Add category', 'Agregar categoría', NULL, NULL, NULL, NULL, ''),
(641, 'add_expense', 'Add expense', 'Agregar egreso', NULL, NULL, NULL, NULL, ''),
(642, 'folder', 'Folder', 'Carpeta', NULL, NULL, NULL, NULL, ''),
(643, 'recents', 'Recents', 'Recientes', NULL, NULL, NULL, NULL, ''),
(644, 'folders', 'Folders', 'Carpetas', NULL, NULL, NULL, NULL, ''),
(645, 'your_files', 'Your files', 'Tus archivos', NULL, NULL, NULL, NULL, ''),
(646, 'upload_new_file', 'Upload new file', 'Subir nuevo', NULL, NULL, NULL, NULL, ''),
(647, 'drag_your_files_here', 'Drag your files here', 'Arrastra tus archivos aquí', NULL, NULL, NULL, NULL, ''),
(648, 'your_files_message', 'Upload your files to your account', 'Almacena tus archivos en tu cuenta', NULL, NULL, NULL, NULL, ''),
(649, 'new_folder', 'New folder', 'Nueva careta', NULL, NULL, NULL, NULL, ''),
(650, 'create_folder', 'Create folder', 'Crear carpeta', NULL, NULL, NULL, NULL, ''),
(651, 'recent_files', 'Recent files', 'Archivos recientes', NULL, NULL, NULL, NULL, ''),
(652, 'my_folders', 'My folders', 'Mis carpetas', NULL, NULL, NULL, NULL, ''),
(653, 'total_folders', 'Total folders', 'Carpetas totales', NULL, NULL, NULL, NULL, ''),
(654, 'total_files', 'Total files', 'Archivos totales', NULL, NULL, NULL, NULL, ''),
(655, 'upload_files', 'Upload files', 'Subir archivos', NULL, NULL, NULL, NULL, ''),
(656, 'notifications_center', 'Notifications center', 'Centro de notificaciones', NULL, NULL, NULL, NULL, ''),
(657, 'available_for_all_users', 'Available for all users', 'Disponible para todos los usuarios', NULL, NULL, NULL, NULL, ''),
(658, 'send_emails', 'Send emails', 'Enviar correos', NULL, NULL, NULL, NULL, ''),
(659, 'message', 'Message', 'Mensaje', NULL, NULL, NULL, NULL, ''),
(660, 'enable_teacher_reports', 'Enable teacher reports', 'Habilitar reporte de profesores', NULL, NULL, NULL, NULL, ''),
(661, 'enable_sundays_schedules', 'Enable saturday and sunday in the schedules', 'Habilitar sabado y domingo en horarios', NULL, NULL, NULL, NULL, ''),
(662, 'terms_conditions', 'Terms and Conditions', 'Términos y Condiciones', NULL, NULL, NULL, NULL, ''),
(663, 'login_to_your_account', 'Login to your account.', 'Accede a tu cuenta', NULL, NULL, NULL, NULL, ''),
(664, 'forgot_my_password', 'Forgot my password.', 'Olvide mi contraseña', NULL, NULL, NULL, NULL, ''),
(665, 'or', 'or', 'o', NULL, NULL, NULL, NULL, ''),
(666, 'no_recent_activity', 'There is no recent activity', 'Sin actividad reciente', NULL, NULL, NULL, NULL, ''),
(667, 'no_subject_activity', 'No activity in the subject', 'No hay actividad en el curso', NULL, NULL, NULL, NULL, ''),
(668, 'teachers_reports', 'Teacher reports', 'Reporte de profesoresq', NULL, NULL, NULL, NULL, ''),
(669, 'add_report', 'Add report', 'Agregar reporte', NULL, NULL, NULL, NULL, ''),
(670, 'stduent', 'Student', 'Estudiante', NULL, NULL, NULL, NULL, ''),
(671, 'update_group', 'Update group', 'Actualizar grupo', NULL, NULL, NULL, NULL, ''),
(672, 'select_all', 'Select all', 'Seleccionar todos', NULL, NULL, NULL, NULL, ''),
(673, 'teacher_schedules', 'Teacher schedules', 'Horario de profesores', NULL, NULL, NULL, NULL, ''),
(674, 'teacher_subjects', 'Teacher subjects', 'Cursos de profesores', NULL, NULL, NULL, NULL, ''),
(675, 'personal_informaton', 'Personal information', 'Información personal', NULL, NULL, NULL, NULL, ''),
(676, 'parent_childs', 'Parent Childs', 'Estudiantes asociados', NULL, NULL, NULL, NULL, ''),
(677, 'stuents', 'Students', 'Estudiantes', NULL, NULL, NULL, NULL, ''),
(678, 'librarian_update', 'Librarian Update', 'Actualizar bibliotecaria', NULL, NULL, NULL, NULL, ''),
(679, 'birthdays', 'Birthdays', 'Cumpleaños', NULL, NULL, NULL, NULL, ''),
(680, 'print_invoice', 'Print invoice', 'Imprimir', NULL, NULL, NULL, NULL, ''),
(681, 'vote', 'Vote now', 'Votar', NULL, NULL, NULL, NULL, ''),
(682, 'welcome_teacher_dashboard', 'Welcome to your teacher dashboard.', 'Bienvenido a tu tablero de profesor.', NULL, NULL, NULL, NULL, ''),
(683, 'go_to_my_classes', 'Go to your classes.', 'Ir a mis clases', NULL, NULL, NULL, NULL, ''),
(684, 'create_new_folder', 'Create new folder', 'Crear nueva carpeta', NULL, NULL, NULL, NULL, ''),
(685, 'cerate_folder', 'Create folder', 'Crear carpeta', NULL, NULL, NULL, NULL, ''),
(686, 'available_for_students', 'Available for students', 'Disponible para estudiantes', NULL, NULL, NULL, NULL, ''),
(687, 'student_welcome_dashboard_message', ' Welcome to your student dashboard.', 'Bienvenido a tu tablero de estudiante.', NULL, NULL, NULL, NULL, ''),
(688, 'go_to_my_subjects', 'Go to your subjects', 'Ir a mis cursos', NULL, NULL, NULL, NULL, ''),
(689, 'complementary_information', 'Complementary data', 'Información adicional', NULL, NULL, NULL, NULL, ''),
(690, 'phone_doctor', 'Doctor phone', 'Telefono del doctor', NULL, NULL, NULL, NULL, ''),
(691, 'go_to_exams', 'Go to exams', 'Ir a examenes', NULL, NULL, NULL, NULL, ''),
(692, 'take_exam_message', 'You can take the exam in the established time', 'Solo puedes tomar el examen en horarios establecidos', NULL, NULL, NULL, NULL, ''),
(693, 'online_exam_results', 'Online exam results', 'Resultados', NULL, NULL, NULL, NULL, ''),
(694, 'no_reply', 'No reply', 'Sin responder', NULL, NULL, NULL, NULL, ''),
(695, 'view_all_marks', 'View all marks', 'Ver todas las calificaciones', NULL, NULL, NULL, NULL, ''),
(696, 'all_files', 'All files', 'Todos los archivos', NULL, NULL, NULL, NULL, ''),
(697, 'welcome_message_parent', 'Welcome to your parent dashboard.', 'Bienvenido a tu tablero de padre.', NULL, NULL, NULL, NULL, ''),
(698, 'go_to_academic', 'Go to academic', 'Ir a academico', NULL, NULL, NULL, NULL, ''),
(699, 'work_business', 'Workplace', 'Lugar de trabajo', NULL, NULL, NULL, NULL, ''),
(700, 'librarian_dashboard', 'Librarian dashboard', 'Tablero', NULL, NULL, NULL, NULL, ''),
(701, 'welcome_librarian_dashboard', 'Welcome to your librarian dashboard', 'Bienvenido a tu tablero de bibliotecario.', NULL, NULL, NULL, NULL, ''),
(702, 'go_to_library', 'Go to library', 'Ir a libreria', NULL, NULL, NULL, NULL, ''),
(703, 'accountant_dashboard', 'Accountant dashboard', 'Tablero', NULL, NULL, NULL, NULL, ''),
(704, 'vew_all_notifications', 'View all notifications', 'Ver todas las notificaciones', NULL, NULL, NULL, NULL, ''),
(705, 'welcome_accountant_dashboard', 'Welcome to you accountant dashboard.', 'Bienvenido a tu tablero de contador.', NULL, NULL, NULL, NULL, ''),
(706, 'go_to_payments', 'Go to payments', 'Ir a pagos', NULL, NULL, NULL, NULL, ''),
(707, 'your_email', 'Your email', 'Tu correo', NULL, NULL, NULL, NULL, ''),
(708, 'fist_name', 'First name', 'Nombre', NULL, NULL, NULL, NULL, ''),
(709, 'percentage_required', 'Percentage Required', 'Porcentaje requerido', NULL, NULL, NULL, NULL, ''),
(710, 'total_mark', 'Total mark', 'Calificacion total', NULL, NULL, NULL, NULL, ''),
(711, 'question_type', 'Question type', 'Tipo de pregunt', NULL, NULL, NULL, NULL, ''),
(712, 'multiple_choice', 'Multiple choice', 'Opcion multiple', NULL, NULL, NULL, NULL, ''),
(713, 'true_false', 'True  or False', 'Falso o Verdadero', NULL, NULL, NULL, NULL, ''),
(714, 'blank_spaces', 'Blank Spaces', 'Espacios en blanco', NULL, NULL, NULL, NULL, ''),
(715, 'select_question_type', 'Select question type', 'Seleccionar', NULL, NULL, NULL, NULL, ''),
(716, 'results_for', 'Results for', 'Resultados para', NULL, NULL, NULL, NULL, ''),
(717, 'mark_obtained', 'Mark obtained', 'Calificacion obtenida', NULL, NULL, NULL, NULL, ''),
(718, 'result', 'Result', 'Resultado', NULL, NULL, NULL, NULL, ''),
(719, 'answers', 'Answers', 'Respuestas', NULL, NULL, NULL, NULL, ''),
(720, 'fail', 'Failed', 'Fallo', NULL, NULL, NULL, NULL, ''),
(721, 'options_number', 'Number of options', 'Numero de opciones', NULL, NULL, NULL, NULL, ''),
(722, 'value_required', 'Value required', 'Requerido', NULL, NULL, NULL, NULL, ''),
(723, 'true', 'True', 'Verdadero', NULL, NULL, NULL, NULL, ''),
(724, 'false', 'False', 'Falso', NULL, NULL, NULL, NULL, ''),
(725, 'instructions', 'Instructions', 'Instrucciones', NULL, NULL, NULL, NULL, ''),
(726, 'instructions_message', 'It is required to complete the question of type of spaces. When you need to insert a line, you can simply enter \'_\' to get a blank space. You can check it in the preview below.', 'Se requiere para completar la pregunta de tipo de espacios. Cuando necesite insertar una línea, simplemente puede ingresar \'_\' para obtener un espacio en blanco. Puedes comprobarlo en la vista previa abajo.', NULL, NULL, NULL, NULL, ''),
(727, 'preview', 'Preview', 'Previsualizacion', NULL, NULL, NULL, NULL, ''),
(728, 'correct_words', 'Correct words', 'Palabras correctas', NULL, NULL, NULL, NULL, ''),
(729, 'correct_words_message', 'Here enter the words that complement your question, please enter them in the same order and separated by commas.', 'Aquí ingrese las palabras que complementan su pregunta, por favor ingresarlas en el mismo orden y separadas por coma.', NULL, NULL, NULL, NULL, ''),
(730, 'report_success', 'It has been marked as solved', 'El reporte se ha marcado como resuelto', NULL, NULL, NULL, NULL, ''),
(731, 'manage_sections', '', 'Administrar secciones', NULL, NULL, NULL, NULL, ''),
(732, 'new_section', '', 'Nueva sección', NULL, NULL, NULL, NULL, ''),
(733, 'new_event_notify', '', 'Se ha agregado un nuevo evento a tu calendario.', NULL, NULL, NULL, NULL, ''),
(734, 'new_poll_notify', '', 'Se ha agregado una nueva encuesta.', NULL, NULL, NULL, NULL, ''),
(735, 'suer_admin', '', 'Super admin', NULL, NULL, NULL, NULL, ''),
(736, 'grade_levels', '', 'Niveles de grado', NULL, NULL, NULL, NULL, ''),
(737, 'new_semester', '', 'Nuevo semestre', NULL, NULL, NULL, NULL, ''),
(738, 'absences_message', '', 'El estudiante no se encuentra presente el día de hoy', NULL, NULL, NULL, NULL, ''),
(739, 'students_reports_message', '', 'Se ha agregado un nuevo reporte', NULL, NULL, NULL, NULL, ''),
(740, 'new_invoice_message', '', 'Se ha agregado una nueva factura', NULL, NULL, NULL, NULL, ''),
(741, 'new_invoices', '', 'Nuevas facturas', NULL, NULL, NULL, NULL, ''),
(742, 'backup_restore', '', 'Copias de seguridad ', NULL, NULL, NULL, NULL, ''),
(743, 'generate_backup', '', 'Generar copia de seguridad', NULL, NULL, NULL, NULL, ''),
(744, 'import_backup', '', 'Restaurar copia de seguridad', NULL, NULL, NULL, NULL, ''),
(745, 'update_section', '', 'Actualizar seccón', NULL, NULL, NULL, NULL, ''),
(746, 'calassrooms', '', 'Salones de clases', NULL, NULL, NULL, NULL, ''),
(747, 'new_bus', '', 'Nuevo bus', NULL, NULL, NULL, NULL, ''),
(748, 'update_transport', '', 'Actualizar bus', NULL, NULL, NULL, NULL, ''),
(749, 'update_subject', '', 'Actualizar curso', NULL, NULL, NULL, NULL, ''),
(750, 'new_poll', '', 'Nueva encuest', NULL, NULL, NULL, NULL, ''),
(751, 'votes', '', 'Votos', NULL, NULL, NULL, NULL, ''),
(752, 'create_new_group', '', 'Crear nuevo grupo', NULL, NULL, NULL, NULL, ''),
(753, 'teachers_permissions', '', 'Permisos de profesores', NULL, NULL, NULL, NULL, ''),
(754, 'without_shared_picture', '', 'Sin fotografías compartidas', NULL, NULL, NULL, NULL, ''),
(755, 'dashoard', '', 'Dashboard', NULL, NULL, NULL, NULL, ''),
(756, 'suject_activity', '', 'Actividad del curso', NULL, NULL, NULL, NULL, ''),
(757, 'waiting_information', '', 'Esperando información', NULL, NULL, NULL, NULL, ''),
(758, 'select_an_question', '', 'Seleccionar una pregunta', NULL, NULL, NULL, NULL, ''),
(759, 'option_', '', 'Opción', NULL, NULL, NULL, NULL, ''),
(760, 'instuctions', '', 'Instrucciones', NULL, NULL, NULL, NULL, ''),
(761, 'failed', '', 'Fallo', NULL, NULL, NULL, NULL, ''),
(762, 'exam_information', '', 'Información del examen', NULL, NULL, NULL, NULL, ''),
(763, 'minute', '', 'Minuto', NULL, NULL, NULL, NULL, ''),
(764, 'second', '', 'Segundo', NULL, NULL, NULL, NULL, ''),
(765, 'waiting_results', '', 'Esperando resultados', NULL, NULL, NULL, NULL, ''),
(766, 'youtube_video', '', '', NULL, NULL, NULL, NULL, ''),
(767, 'income', '', '', NULL, NULL, NULL, NULL, ''),
(768, 'new_notice_info', '', '', NULL, NULL, NULL, NULL, ''),
(769, 'live', '', '', NULL, NULL, NULL, NULL, ''),
(770, 'meet', '', '', NULL, NULL, NULL, NULL, ''),
(771, 'create_live', '', '', NULL, NULL, NULL, NULL, ''),
(772, 'optional', '', '', NULL, NULL, NULL, NULL, ''),
(773, 'lost_text', '', '', NULL, NULL, NULL, NULL, ''),
(774, 'multilpe_choice', '', '', NULL, NULL, NULL, NULL, ''),
(775, 'update_question', '', '', NULL, NULL, NULL, NULL, ''),
(776, 'no_options_can_be_blank', '', '', NULL, NULL, NULL, NULL, ''),
(777, 'enter_exam_password', '', '', NULL, NULL, NULL, NULL, ''),
(778, 'password_does_not_match', '', '', NULL, NULL, NULL, NULL, ''),
(779, 'pass', '', '', NULL, NULL, NULL, NULL, ''),
(780, 'Verdadero', 'Verdadero', '', NULL, NULL, NULL, NULL, ''),
(796, 'students_report', '', '', NULL, NULL, NULL, NULL, ''),
(797, 'update_semester', '', '', NULL, NULL, NULL, NULL, ''),
(798, 'marks_report', '', '', NULL, NULL, NULL, NULL, ''),
(799, 'student_card', '', '', NULL, NULL, NULL, NULL, ''),
(800, 'tabulation_report', '', '', NULL, NULL, NULL, NULL, ''),
(801, 'mens', '', '', NULL, NULL, NULL, NULL, ''),
(802, 'women', '', '', NULL, NULL, NULL, NULL, ''),
(803, 'signature', '', '', NULL, NULL, NULL, NULL, ''),
(804, 'accounting_report', '', '', NULL, NULL, NULL, NULL, ''),
(1125, 'go_to_timeline', '', '', NULL, NULL, NULL, NULL, ''),
(865, 'update_routine', '', '', NULL, NULL, NULL, NULL, ''),
(1087, 'this_week', '', '', NULL, NULL, NULL, NULL, ''),
(1086, 'school_timeline', '', '', NULL, NULL, NULL, NULL, ''),
(1055, 'go_to_my_timeline', '', '', NULL, NULL, NULL, NULL, ''),
(1050, 'added_new_forum_discussion', '', '', NULL, NULL, NULL, NULL, ''),
(1045, 'progress', '', '', NULL, NULL, NULL, NULL, ''),
(966, 'new_request', '', '', NULL, NULL, NULL, NULL, ''),
(967, 'request', '', '', NULL, NULL, NULL, NULL, ''),
(1017, 'date_format', '', '', NULL, NULL, NULL, NULL, ''),
(1016, 'group_information', '', '', NULL, NULL, NULL, NULL, ''),
(1015, 'actions', '', '', NULL, NULL, NULL, NULL, ''),
(1014, 'waiting_mark', '', '', NULL, NULL, NULL, NULL, ''),
(1003, 'send_marks_by_email', '', '', NULL, NULL, NULL, NULL, ''),
(1004, 'you_dont_have_notifications', '', '', NULL, NULL, NULL, NULL, ''),
(1005, 'download_adminssion_sheet', '', '', NULL, NULL, NULL, NULL, ''),
(1006, 'download_adminssion_sheet_message', '', '', NULL, NULL, NULL, NULL, ''),
(1007, 'interal', 'Internal', '', NULL, NULL, NULL, NULL, ''),
(1008, 'external', '', '', NULL, NULL, NULL, NULL, ''),
(1009, 'live_type', 'Live type', '', NULL, NULL, NULL, NULL, ''),
(1010, 'internal', '', '', NULL, NULL, NULL, NULL, ''),
(1011, 'site_url', 'Site URL', '', NULL, NULL, NULL, NULL, ''),
(1012, 'update_live', 'Update live', '', NULL, NULL, NULL, NULL, ''),
(1013, 'modules', '', '', NULL, NULL, NULL, NULL, ''),
(1239, 'no_available', '', '', NULL, NULL, NULL, NULL, ''),
(1293, 'see_files', '', '', NULL, NULL, NULL, NULL, ''),
(1311, 'calendar_language', '', '', NULL, NULL, NULL, NULL, ''),
(1314, 'download_file', '', '', NULL, NULL, NULL, NULL, ''),
(1315, 'download_student_sheet', '', '', NULL, NULL, NULL, NULL, ''),
(1318, 'new_student', '', '', NULL, NULL, NULL, NULL, ''),
(1319, 'enroll', '', '', NULL, NULL, NULL, NULL, ''),
(1320, 'date_of_birth', '', '', NULL, NULL, NULL, NULL, ''),
(1321, 'generated_by', '', '', NULL, NULL, NULL, NULL, ''),
(1328, 'student_live_attendance', '', '', NULL, NULL, NULL, NULL, ''),
(1399, 'school_location', '', '', NULL, NULL, NULL, NULL, ''),
(1584, 'enable_logs', '', '', NULL, NULL, NULL, NULL, ''),
(1585, 'for_development_purposes', '', '', NULL, NULL, NULL, NULL, ''),
(1602, 'about_the_subject', '', '', NULL, NULL, NULL, NULL, ''),
(1605, 'subject_stats', '', '', NULL, NULL, NULL, NULL, ''),
(1608, 'homeworks', '', '', NULL, NULL, NULL, NULL, ''),
(1609, 'forums', '', '', NULL, NULL, NULL, NULL, ''),
(1610, 'live_classes', '', '', NULL, NULL, NULL, NULL, ''),
(1663, 'student_marksheet', '', '', NULL, NULL, NULL, NULL, ''),
(1664, 'student_marksheet_are_there', '', '', NULL, NULL, NULL, NULL, ''),
(1671, 'exam', '', '', NULL, NULL, NULL, NULL, ''),
(1672, 'marks_sent', '', '', NULL, NULL, NULL, NULL, ''),
(1673, 'welcome', '', '', NULL, NULL, NULL, NULL, ''),
(1674, 'new_account_has_been_created_with_your_email_address_in', '', '', NULL, NULL, NULL, NULL, ''),
(1675, 'your_data_are_as_follows', '', '', NULL, NULL, NULL, NULL, ''),
(1676, 'your_account_require_approval', '', '', NULL, NULL, NULL, NULL, ''),
(1677, 'congratulations', '', '', NULL, NULL, NULL, NULL, ''),
(1678, 'your_account_has_been_approved_now_you_can_login', '', '', NULL, NULL, NULL, NULL, ''),
(1679, 'root_folder', '', '', NULL, NULL, NULL, NULL, ''),
(1741, 'password_reset', '', '', NULL, NULL, NULL, NULL, ''),
(1781, 'email_already_exist', '', '', NULL, NULL, NULL, NULL, ''),
(1786, 'blue', '', '', NULL, NULL, NULL, NULL, ''),
(1787, 'turquoise', '', '', NULL, NULL, NULL, NULL, ''),
(1788, 'green', '', '', NULL, NULL, NULL, NULL, ''),
(1789, 'yellow', '', '', NULL, NULL, NULL, NULL, ''),
(1790, 'orange', '', '', NULL, NULL, NULL, NULL, ''),
(1791, 'red', '', '', NULL, NULL, NULL, NULL, ''),
(1792, 'black', '', '', NULL, NULL, NULL, NULL, ''),
(1797, 'current_class', '', '', NULL, NULL, NULL, NULL, ''),
(1798, 'class_to_promote', '', '', NULL, NULL, NULL, NULL, ''),
(1799, 'current_section', '', '', NULL, NULL, NULL, NULL, ''),
(1800, 'to_section', '', '', NULL, NULL, NULL, NULL, ''),
(1801, 'successfully_promoted', '', '', NULL, NULL, NULL, NULL, ''),
(1924, 'users_have_a_birthday_this_month', '', '', NULL, NULL, NULL, NULL, ''),
(1963, 'create_your_first_group', '', '', NULL, NULL, NULL, NULL, ''),
(1968, 'chat groups', '', '', NULL, NULL, NULL, NULL, ''),
(1981, 'without_shared_photos', '', '', NULL, NULL, NULL, NULL, ''),
(1986, 'members_on_this_group', '', '', NULL, NULL, NULL, NULL, ''),
(2049, 'show_results', '', '', NULL, NULL, NULL, NULL, ''),
(2050, 'keep_hidden', '', '', NULL, NULL, NULL, NULL, ''),
(2051, 'show_when_exam_is_finished', '', '', NULL, NULL, NULL, NULL, ''),
(2052, '15_minutes_after_finished', '', '', NULL, NULL, NULL, NULL, ''),
(2053, '30_minutes_after_finished', '', '', NULL, NULL, NULL, NULL, ''),
(2058, 'edit_delivery', '', '', NULL, NULL, NULL, NULL, ''),
(2059, 'are_you_sure', '', '', NULL, NULL, NULL, NULL, ''),
(2062, 'your_comment', '', '', NULL, NULL, NULL, NULL, ''),
(2063, 'your_submitted_files', '', '', NULL, NULL, NULL, NULL, ''),
(2304, 'have_seen_this_post', '', '', NULL, NULL, NULL, NULL, ''),
(2405, 'your_chats_groups', '', '', NULL, NULL, NULL, NULL, ''),
(2454, 'chat_groups', '', '', NULL, NULL, NULL, NULL, ''),
(2537, 'manage_attendance', '', '', NULL, NULL, NULL, NULL, ''),
(2540, 'teachers_attendance', '', '', NULL, NULL, NULL, NULL, ''),
(2980, 'your_other_live_classes', '', '', NULL, NULL, NULL, NULL, ''),
(2981, 'solved', '', '', NULL, NULL, NULL, NULL, ''),
(2986, 'new_invoice_has_been_generated_for', '', '', NULL, NULL, NULL, NULL, ''),
(2987, 'update_invoice', '', '', NULL, NULL, NULL, NULL, ''),
(2988, 'descrition', '', '', NULL, NULL, NULL, NULL, ''),
(2989, 'update_category', '', '', NULL, NULL, NULL, NULL, ''),
(2990, 'udate', '', '', NULL, NULL, NULL, NULL, ''),
(2991, 'update_expense', '', '', NULL, NULL, NULL, NULL, ''),
(2992, 'update_grade_level', '', '', NULL, NULL, NULL, NULL, ''),
(2997, 'show_questions_randomly', '', '', NULL, NULL, NULL, NULL, ''),
(3020, 'ask_for_results', '', '', NULL, NULL, NULL, NULL, ''),
(3021, 'waiting_for_results', '', '', NULL, NULL, NULL, NULL, ''),
(3154, 'your_child', '', '', NULL, NULL, NULL, NULL, ''),
(3155, 'is_absent_today', '', '', NULL, NULL, NULL, NULL, ''),
(3188, 'users_seen_this_post', '', '', NULL, NULL, NULL, NULL, ''),
(3201, 'students_seen_this_post', '', '', NULL, NULL, NULL, NULL, ''),
(3613, 'approve', '', '', NULL, NULL, NULL, NULL, ''),
(3614, 'request_accepted_successfully', '', '', NULL, NULL, NULL, NULL, ''),
(3615, 'no_actions_available', '', '', NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `librarian`
--

DROP TABLE IF EXISTS `librarian`;
CREATE TABLE IF NOT EXISTS `librarian` (
  `librarian_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(300) NOT NULL,
  `email` varchar(300) DEFAULT NULL,
  `password` varchar(300) NOT NULL,
  `phone` varchar(300) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `username` varchar(300) NOT NULL,
  `fb_token` longtext DEFAULT NULL,
  `fb_id` longtext DEFAULT NULL,
  `fb_photo` longtext DEFAULT NULL,
  `fb_name` longtext DEFAULT NULL,
  `g_oauth` longtext DEFAULT NULL,
  `g_fname` longtext DEFAULT NULL,
  `femail` longtext DEFAULT NULL,
  `g_lname` longtext DEFAULT NULL,
  `g_picture` longtext DEFAULT NULL,
  `link` longtext DEFAULT NULL,
  `g_email` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `gender` varchar(200) DEFAULT NULL,
  `idcard` varchar(200) DEFAULT NULL,
  `since` varchar(20) DEFAULT NULL,
  `birthday` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`librarian_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `live`
--

DROP TABLE IF EXISTS `live`;
CREATE TABLE IF NOT EXISTS `live` (
  `live_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(600) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `time` varchar(200) DEFAULT NULL,
  `user_type` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `year` varchar(200) DEFAULT NULL,
  `wall_type` varchar(200) DEFAULT NULL,
  `publish_date` varchar(300) DEFAULT NULL,
  `upload_date` varchar(300) DEFAULT NULL,
  `room` longtext DEFAULT NULL,
  `siteUrl` longtext DEFAULT NULL,
  `liveType` int(11) DEFAULT NULL,
  PRIMARY KEY (`live_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `live_status`
--

DROP TABLE IF EXISTS `live_status`;
CREATE TABLE IF NOT EXISTS `live_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(300) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `live_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mark`
--

DROP TABLE IF EXISTS `mark`;
CREATE TABLE IF NOT EXISTS `mark` (
  `mark_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `mark_obtained` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mark_total` int(11) NOT NULL DEFAULT 100,
  `comment` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` longtext COLLATE utf8_unicode_ci NOT NULL,
  `labuno` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `labdos` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `labtres` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `labcuatro` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `labcinco` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `labseis` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `labsiete` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `labocho` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `labnueve` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `labtotal` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `final` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`mark_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje_reporte`
--

DROP TABLE IF EXISTS `mensaje_reporte`;
CREATE TABLE IF NOT EXISTS `mensaje_reporte` (
  `news_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `news_id` int(11) NOT NULL,
  `date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`news_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext NOT NULL,
  `message` longtext NOT NULL,
  `sender` longtext NOT NULL,
  `timestamp` longtext NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 unread 1 read',
  `file_name` longtext DEFAULT NULL,
  `reciever` varchar(200) DEFAULT NULL,
  `file_type` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message_thread`
--

DROP TABLE IF EXISTS `message_thread`;
CREATE TABLE IF NOT EXISTS `message_thread` (
  `message_thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender` longtext COLLATE utf8_unicode_ci NOT NULL,
  `reciever` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_message_timestamp` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`message_thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `embed` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notice_message`
--

DROP TABLE IF EXISTS `notice_message`;
CREATE TABLE IF NOT EXISTS `notice_message` (
  `notice_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `notice_id` int(11) NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`notice_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_type` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `time` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `notify` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `original_id` int(11) DEFAULT NULL,
  `original_type` varchar(200) DEFAULT NULL,
  `url` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `class_id` int(11) DEFAULT 0,
  `subject_id` int(11) DEFAULT 0,
  `year` varchar(20) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `online_exam`
--

DROP TABLE IF EXISTS `online_exam`;
CREATE TABLE IF NOT EXISTS `online_exam` (
  `online_exam_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `title` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `exam_date` int(11) DEFAULT NULL,
  `time_start` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_end` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'duration in second',
  `minimum_percentage` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `instruction` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'pending',
  `running_year` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `wall_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uploader_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uploader_id` int(11) DEFAULT NULL,
  `upload_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `results` int(11) DEFAULT 0,
  `show_random` int(11) DEFAULT 0,
  PRIMARY KEY (`online_exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `online_exam_result`
--

DROP TABLE IF EXISTS `online_exam_result`;
CREATE TABLE IF NOT EXISTS `online_exam_result` (
  `online_exam_result_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `online_exam_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `answer_script` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `obtained_mark` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `exam_started_timestamp` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` text COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`online_exam_result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `online_users`
--

DROP TABLE IF EXISTS `online_users`;
CREATE TABLE IF NOT EXISTS `online_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` longtext NOT NULL,
  `time` longtext NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `type` longtext NOT NULL,
  `gp` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `parent_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `profession` longtext COLLATE utf8_unicode_ci NOT NULL,
  `username` longtext COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `business` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idcard` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_token` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_id` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_photo` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_oauth` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_fname` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `femail` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_lname` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_picture` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_email` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `since` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_category_id` int(11) DEFAULT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `year` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `month` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pending_users`
--

DROP TABLE IF EXISTS `pending_users`;
CREATE TABLE IF NOT EXISTS `pending_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `birthday` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `profession` varchar(200) DEFAULT NULL,
  `sex` varchar(200) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  `roll` varchar(200) DEFAULT NULL,
  `since` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polls`
--

DROP TABLE IF EXISTS `polls`;
CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `options` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `poll_code` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date2` varchar(200) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `publish_date` varchar(20) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poll_response`
--

DROP TABLE IF EXISTS `poll_response`;
CREATE TABLE IF NOT EXISTS `poll_response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_code` varchar(100) NOT NULL,
  `answer` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `date2` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question_bank`
--

DROP TABLE IF EXISTS `question_bank`;
CREATE TABLE IF NOT EXISTS `question_bank` (
  `question_bank_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `online_exam_id` int(11) DEFAULT NULL,
  `question_title` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_of_options` int(11) DEFAULT NULL,
  `options` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `correct_answers` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `mark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`question_bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question_paper`
--

DROP TABLE IF EXISTS `question_paper`;
CREATE TABLE IF NOT EXISTS `question_paper` (
  `question_paper_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `question_paper` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`question_paper_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `readed`
--

DROP TABLE IF EXISTS `readed`;
CREATE TABLE IF NOT EXISTS `readed` (
  `readed_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL,
  `activity_code` varchar(50) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`readed_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_alumnos`
--

DROP TABLE IF EXISTS `reporte_alumnos`;
CREATE TABLE IF NOT EXISTS `reporte_alumnos` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `report_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `priority` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT 0,
  `file` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_mensaje`
--

DROP TABLE IF EXISTS `reporte_mensaje`;
CREATE TABLE IF NOT EXISTS `reporte_mensaje` (
  `report_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sender_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sender_id` int(11) NOT NULL,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`report_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `user_id` varchar(600) NOT NULL,
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `priority` varchar(100) NOT NULL,
  `file` longtext DEFAULT NULL,
  `status` int(11) NOT NULL,
  `date` varchar(600) NOT NULL,
  `code` varchar(600) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `report_response`
--

DROP TABLE IF EXISTS `report_response`;
CREATE TABLE IF NOT EXISTS `report_response` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext NOT NULL,
  `date` varchar(600) NOT NULL,
  `report_code` varchar(100) NOT NULL,
  `sender_type` varchar(100) NOT NULL,
  `sender_id` int(11) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE IF NOT EXISTS `request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `start_date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `end_date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = accepted, 2 = rejected',
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'EduAppGT PRO'),
(2, 'system_title', 'School Management System'),
(3, 'address', 'Guatemala City'),
(4, 'phone', '00000000'),
(5, 'paypal_email', 'admin@paypal.com'),
(6, 'currency', '$'),
(7, 'system_email', 'cool@eduappgt.com'),
(20, 'municipio', NULL),
(11, 'language', 'english'),
(13, 'minimark', '50'),
(16, 'timezone', 'America/Guatemala'),
(18, 'msg91_code', '0'),
(21, 'running_year', '2021'),
(22, 'facebook', 'https://facebook.com/google'),
(23, 'twitter', 'https://twitter.com/google'),
(24, 'instagram', 'https://instagram.com/google'),
(25, 'youtube', 'https://youtube.com/google'),
(26, 'sms_status', '0'),
(27, 'msg91_key', NULL),
(28, 'msg91_sender', NULL),
(29, 'msg91_route', NULL),
(30, 'buyer', NULL),
(31, 'purchase_code', NULL),
(32, 'clickatell_username', NULL),
(33, 'clickatell_password', NULL),
(34, 'clickatell_api', NULL),
(35, 'twilio_account', NULL),
(36, 'authentication_token', NULL),
(37, 'registered_phone', NULL),
(38, 'absences', NULL),
(39, 'students_reports', NULL),
(40, 'p_new_invoice', NULL),
(41, 's_new_invoice', '1'),
(42, 'new_homework', NULL),
(43, 'register', '1'),
(44, 'facebook_sync', ''),
(45, 'google_sync', 'gooogle_client_id'),
(46, 'facebook_login', ''),
(47, 'google_login', 'gooogle_secret'),
(48, 'social_login', '1'),
(49, 'favicon', '63f1ed995b376666a593b00cdb32d5ddfavicon.png'),
(50, 'logow', '8231ae739c7bd4a126c4c7f3d1685e6elogo-white.png'),
(51, 'logo', '63f1ed995b376666a593b00cdb32d5dd0564fea78adf8acf191ec32910140a6blogo.png'),
(52, 'logocolor', '6ec8d3ab0e71c79bb4805a22fabbdd00logo-color.png'),
(53, 'icon_white', '63f1ed995b376666a593b00cdb32d5ddlogo-icon.png'),
(55, 'bglogin', '3ad1f8ca3f9012765ce53ca8ef6dca57math.svg'),
(56, 'date_format', 'm/d'),
(57, 'calendar', 'en'),
(58, 'logs', '0'),
(59, 'stat', '0'),
(60, 'protocol', NULL),
(61, 'smtp_host', NULL),
(62, 'smtp_port', NULL),
(63, 'smtp_user', NULL),
(64, 'smtp_pass', NULL),
(65, 'charset', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` text CHARACTER SET utf8 NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `dormitory_id` int(11) DEFAULT NULL,
  `transport_id` int(11) DEFAULT NULL,
  `student_session` int(11) NOT NULL DEFAULT 1,
  `username` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `board` int(11) DEFAULT 0,
  `fb_token` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_id` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_photo` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_oauth` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_fname` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `femail` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_lname` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_picture` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_email` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `solvencia` int(11) NOT NULL DEFAULT 1,
  `class_id` int(11) NOT NULL,
  `image` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `since` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diseases` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allergies` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doctor` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doctor_phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authorized_person` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authorized_phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students_request`
--

DROP TABLE IF EXISTS `students_request`;
CREATE TABLE IF NOT EXISTS `students_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `start_date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `end_date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `year` longtext COLLATE utf8_unicode_ci NOT NULL,
  `la1` varchar(500) COLLATE utf8_unicode_ci DEFAULT 'Lab 1.',
  `la2` varchar(500) COLLATE utf8_unicode_ci DEFAULT 'Lab 2.',
  `la3` varchar(500) COLLATE utf8_unicode_ci DEFAULT 'Lab 3.',
  `la4` varchar(500) COLLATE utf8_unicode_ci DEFAULT 'Lab 4.',
  `la5` varchar(500) COLLATE utf8_unicode_ci DEFAULT 'Lab 5.',
  `la6` varchar(500) COLLATE utf8_unicode_ci DEFAULT 'Lab 6.',
  `la7` varchar(500) COLLATE utf8_unicode_ci DEFAULT 'Lab 7.',
  `la8` varchar(500) COLLATE utf8_unicode_ci DEFAULT 'Lab 8.',
  `la9` varchar(500) COLLATE utf8_unicode_ci DEFAULT 'Lab 9.',
  `la10` varchar(500) COLLATE utf8_unicode_ci DEFAULT 'Lab 10.',
  `type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_id` int(11) NOT NULL,
  `color` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `idcard` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_code` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_token` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_id` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_photo` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_oauth` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_fname` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `femail` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_lname` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_picture` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g_email` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `since` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teacher_attendance`
--

DROP TABLE IF EXISTS `teacher_attendance`;
CREATE TABLE IF NOT EXISTS `teacher_attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` longtext NOT NULL,
  `year` longtext NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`attendance_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ticket_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'opened closed',
  `priority` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'baja media alta',
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `assigned_staff_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_message`
--

DROP TABLE IF EXISTS `ticket_message`;
CREATE TABLE IF NOT EXISTS `ticket_message` (
  `ticket_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender_id` int(11) NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ticket_message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transport`
--

DROP TABLE IF EXISTS `transport`;
CREATE TABLE IF NOT EXISTS `transport` (
  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `number_of_vehicle` longtext COLLATE utf8_unicode_ci NOT NULL,
  `route_fare` longtext COLLATE utf8_unicode_ci NOT NULL,
  `driver_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `driver_phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `route` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transport_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
