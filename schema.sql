SET NAMES utf8;
SET time_zone = '+00:00';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `access_level` tinyint(4) DEFAULT NULL COMMENT ' EMPTY : NO ACCESS\n 1: ROOT\n 2: MANAGER\n 3: EMPLOYEE',
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admins_email_uindex` (`admin_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Admin table for handling admins accounts';


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
  `created_at` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `updated_at` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `deleted_at` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_posted_by` int(11) NOT NULL,
  `question_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id_uindex` (`id`),
  UNIQUE KEY `users_email_uindex` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='all the user data';


DROP TABLE IF EXISTS `users_meta_info`;
CREATE TABLE `users_meta_info` (
  `umi_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `updated_at` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `deleted_at` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'current_timestamp()',
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobbies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`umi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2018-03-18 18:21:38