-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
/*SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';*/

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `access_level` tinyint(4) DEFAULT NULL COMMENT ' EMPTY : NO ACCESS\n 1: ROOT\n 2: MANAGER\n 3: EMPLOYEE',
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admins_email_uindex` (`admin_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Admin table for handling admins accounts';

INSERT INTO `admins` (`admin_id`, `first_name`, `last_name`, `admin_email`, `admin_pass`, `created_at`, `updated_at`, `access_level`, `deleted_at`) VALUES
  (1,	NULL,	NULL,	'gopalindians@gmail.com',	'$2y$10$f4dZkMNhBl957hq6f2chXeXuNoMWtaGxFivKNblntCJSbVUmnwMiC',	'2018-02-24T19:28:44+00:00',	'2018-02-24T19:28:44+00:00',	NULL,	'current_timestamp()');

DROP TABLE IF EXISTS `flagged_questions`;
CREATE TABLE `flagged_questions` (
  `fq_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 not resolved\n1 working\n2 resolved\n3 other                              ',
  PRIMARY KEY (`fq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'current_timestamp()',
  `updated_at` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'current_timestamp()',
  `deleted_at` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_posted_by` int(11) NOT NULL,
  `question_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `questions` (`question_id`, `question_text`, `question_description`, `created_at`, `updated_at`, `deleted_at`, `question_posted_by`, `question_slug`) VALUES
  (34,	'Hello oye new queson',	'Hanji',	'2018-02-08 19:36:53+00:00',	'2018-02-08 19:36:53',	NULL,	28,	'Hello-oye-new-queson'),
  (35,	'Hello oye new queson',	'Hanji',	'2018-02-08 19:37:42+00:00',	'2018-02-08 19:37:42',	NULL,	28,	'hello-oye-new-queson'),
  (37,	'To th epoint',	'hello Description',	'2018-02-08 19:55:30+00:00',	'2018-02-08 19:55:30',	NULL,	28,	'to-th-epoint'),
  (38,	'This is atest qquestion',	'hello question description',	'2018-02-10 06:08:33+00:00',	'2018-02-10 06:08:33',	NULL,	28,	'this-is-atest-qquestion'),
  (39,	'ipoipipipiHello oye new queson',	'khkj',	'2018-02-10 19:16:38+00:00',	'2018-02-10 19:16:38',	NULL,	40,	'ipoipipipihello-oye-new-queson'),
  (40,	'Passing variable from controller to view in CodeIgniter',	'Passing variable from controller to view in CodeIgniter',	'2018-02-10 19:19:37+00:00',	'2018-02-10 19:19:37',	NULL,	40,	'passing-variable-from-controller-to-view-in-codeigniter');

DROP TABLE IF EXISTS `question_comments`;
CREATE TABLE `question_comments` (
  `qc_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `updated_at` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `deleted_at` varchar(30) COLLATE utf8mb4_unicode_ci,
  `comment_body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`qc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT current_timestamp(),
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id_uindex` (`id`),
  UNIQUE KEY `users_email_uindex` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='all the user data';

INSERT INTO `users` (`id`, `email`, `pass`, `created_at`, `updated_at`, `profile_image`, `deleted_at`) VALUES
  (28,	'gopalindians@gmail.com',	'$2y$10$8JIXeZtAUTYZGSNvAOAms.UJDGYwICTHODoj1X2MZzceLp8KbcUrm',	'2018-02-06T17:28:16+00:00',	'2018-02-06T17:28:16+00:00',	NULL,	''),
  (40,	'gopal_indians@yahoo.com',	'$2y$10$vVV5Y369DjXF/SWn4IrauubDdhRlvVy9e6kbqx9jWmiZWQhpalWyO',	'2018-02-10T06:20:58+00:00',	'2018-02-10T06:20:58+00:00',	NULL,	''),
  (41,	'gopalindians@cueblocks.com',	'$2y$10$glFdakONCbrhzG2TYs7M.uTNdO2icpJGu6oQoacHlQVLF/udDytHq',	'2018-02-25T18:53:19+00:00',	'2018-02-25T18:53:19+00:00',	NULL,	''),
  (42,	'hello@gopal.com',	'$2y$10$3MLzK1ZbJx.gEKq3K3mgCO41qM.m06yZMCesPNWSXEilEWfDijC9m',	'2018-02-25T18:54:39+00:00',	'2018-02-25T18:54:39+00:00',	NULL,	NULL),
  (43,	'g_opalindians@gmail.com',	'$2y$10$vP0oRRgXGIjNYZb4RYefneCsHiwh2MGQq7PPMEU9MdBQclDKCzdr.',	'2018-03-11T17:42:16+00:00',	'2018-03-11T17:42:16+00:00',	NULL,	NULL);

-- 2018-03-11 21:24:24