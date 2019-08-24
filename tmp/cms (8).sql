-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2019 at 07:06 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_admin`
--

CREATE TABLE `cms_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_admin`
--

INSERT INTO `cms_admin` (`id`, `name`, `role_id`, `avatar`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'NGUYEN VAN TUAN', 1, 'dist/img/user2-160x160.jpg', 'admin', '$2y$10$P0GK/41Xk88OL55si5OGpeGrRBRaEkxZcuIbzx1fZiTWIfA1WjaFC', NULL, '2019-07-23 00:23:29', '2019-07-23 00:23:29'),
(2, 'NGUYEN VAN TUAN', 2, 'dist/img/user2-160x160.jpg', 'admin1', '$2y$10$P0GK/41Xk88OL55si5OGpeGrRBRaEkxZcuIbzx1fZiTWIfA1WjaFC', NULL, '2019-07-23 00:23:29', '2019-07-23 00:23:29'),
(3, 'NGUYEN VAN TUAN', 2, 'dist/img/user2-160x160.jpg', 'admin2', '$2y$10$P0GK/41Xk88OL55si5OGpeGrRBRaEkxZcuIbzx1fZiTWIfA1WjaFC', NULL, '2019-07-23 00:23:29', '2019-07-23 00:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `cms_blog_post`
--

CREATE TABLE `cms_blog_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `featured` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_blog_post`
--

INSERT INTO `cms_blog_post` (`id`, `slug`, `image`, `status`, `user_id`, `featured`, `views`, `created_at`, `updated_at`) VALUES
(4, 'sdfasd', '/uploads/bg_win.png', 1, 1, 1, 0, '2019-08-19 08:50:18', '2019-08-19 08:50:18'),
(5, 'demo', '/uploads/bg_win.png', 1, 1, 1, 0, '2019-08-19 08:53:43', '2019-08-19 10:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `cms_blog_post_category`
--

CREATE TABLE `cms_blog_post_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_blog_post_category`
--

INSERT INTO `cms_blog_post_category` (`category_id`, `post_id`) VALUES
(12, 5),
(16, 5),
(18, 5),
(21, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cms_blog_post_translation`
--

CREATE TABLE `cms_blog_post_translation` (
  `post_id` int(10) NOT NULL,
  `lang_code` varchar(5) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_blog_post_translation`
--

INSERT INTO `cms_blog_post_translation` (`post_id`, `lang_code`, `title`, `description`, `content`) VALUES
(1, 'cn', '4', '4', '<p>4</p>'),
(1, 'en', '1', '1', '<p>1</p>'),
(1, 'jp', '3', '3', '<p>3</p>'),
(1, 'vi', '2', '2', '<p>2</p>'),
(5, 'cn', 'en demo', 'sdfsdf', '<p>sdfsdfsf</p>'),
(5, 'en', 'Demo 12', 'Description 12', '<p>Content</p>'),
(5, 'jp', 'jp title 1', 'jp Description1', '<p>jp</p>'),
(5, 'vi', 'Ví dụ 1', 'Mô tả 1', '<p>Nội dung</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cms_categories`
--

CREATE TABLE `cms_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'category',
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT 0,
  `order` tinyint(4) NOT NULL DEFAULT 0,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_categories`
--

INSERT INTO `cms_categories` (`id`, `name`, `slug`, `parent_id`, `description`, `data`, `status`, `type`, `icon`, `featured`, `order`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'de3mo', 'de3mo', 0, 'sdfsdf', 'a:0:{}', 1, 'category', '', 1, 0, 0, '2019-08-20 05:03:59', '2019-08-20 05:03:59'),
(4, 'ádfsadf', 'adfsadf', 0, 'sdfsdfsfd', 'a:0:{}', 1, 'category', '', 0, 0, 0, '2019-08-20 05:13:02', '2019-08-20 05:13:02'),
(5, 'abc', 'abc', 0, 'def', 'a:0:{}', 1, 'category', '', 0, 0, 0, '2019-08-20 06:59:39', '2019-08-20 06:59:39'),
(12, 'abc', 'abc', 0, 'abc', 'a:0:{}', 1, 'blog:category', '', 0, 0, 0, '2019-08-21 10:22:13', '2019-08-21 10:22:13'),
(16, 'mmm', 'mmm', 0, 'mmm', 'a:0:{}', 1, 'blog:category', '', 0, 0, 0, '2019-08-21 10:30:30', '2019-08-21 10:30:30'),
(18, 'cccc', 'cccc', 0, 'cccc', 'a:2:{s:8:\"meta_des\";s:6:\"dfgdfg\";s:8:\"meta_key\";s:6:\"dfgdfg\";}', 1, 'blog:category', '', 0, 0, 0, '2019-08-21 10:30:48', '2019-08-22 03:19:14'),
(19, 'bbb', 'bbb', 0, 'bbbb', 'a:0:{}', 1, 'blog:category', '', 0, 0, 0, '2019-08-21 10:30:54', '2019-08-21 10:30:54'),
(21, 'game', 'game', 0, 'game', 'a:2:{s:8:\"meta_des\";s:3:\"dfg\";s:8:\"meta_key\";s:5:\"dfgdg\";}', 1, 'blog:category', '', 0, 0, 0, '2019-08-22 09:42:54', '2019-08-22 09:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `cms_component`
--

CREATE TABLE `cms_component` (
  `id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `data` text CHARACTER SET utf8 NOT NULL,
  `layout` varchar(255) NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `layout_id` int(5) NOT NULL DEFAULT 0,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_component`
--

INSERT INTO `cms_component` (`id`, `data`, `layout`, `type`, `layout_id`, `update_at`) VALUES
('a02ce975-af58-41eb-3e2d-8960b11dfeef', 'a:2:{s:3:\"cfg\";a:6:{s:5:\"title\";s:6:\"demo 1\";s:4:\"func\";s:9:\"No Action\";s:6:\"status\";s:1:\"1\";s:6:\"public\";s:1:\"1\";s:7:\"dynamic\";s:1:\"0\";s:2:\"id\";s:36:\"a02ce975-af58-41eb-3e2d-8960b11dfeef\";}s:3:\"stg\";a:6:{s:6:\"system\";s:5:\"theme\";s:6:\"module\";s:3:\"zoe\";s:4:\"type\";s:7:\"partial\";s:2:\"id\";s:1:\"7\";s:5:\"token\";s:36:\"094bde12-ffeb-4fdc-ae8e-a5c1a80e2d9f\";s:4:\"name\";s:4:\"demo\";}}', 'a:1:{i:14;s:19:\"2019-14-08 16:53:50\";}', 'partial', 7, '2019-08-14 17:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `cms_config`
--

CREATE TABLE `cms_config` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` text CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_config`
--

INSERT INTO `cms_config` (`id`, `name`, `type`, `data`, `created_at`, `updated_at`) VALUES
(1, 'language', 'json', 'a:1:{s:4:\"lang\";a:4:{s:2:\"en\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:9:\"Dashboard\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";s:3:\"Key\";}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:7:\"Plugins\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"vi\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:22:\"Trình điều khiển\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";s:5:\"Khóa\";}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:9:\"Bổ sung\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"jp\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:21:\"ダッシュボード\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:15:\"プラグイン\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"cn\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:9:\"仪表盘\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:6:\"插件\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}}}', NULL, NULL),
(2, 'language', 'data', 'a:1:{s:4:\"lang\";a:4:{s:2:\"en\";a:63:{s:32:\"c54e439ce10495935e37b5e9e2c4d6dc\";a:2:{s:4:\"name\";s:2:\"Id\";s:5:\"value\";s:2:\"Id\";}s:32:\"9263cf79ab9b3749d1c8a881f8ae6505\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";s:4:\"Name\";}s:32:\"cbbe35271deb32d04718517a7e6fd525\";a:2:{s:4:\"name\";s:4:\"Type\";s:5:\"value\";N;}s:32:\"bfe602fddfc0cd02ea67a43931e2b9b3\";a:2:{s:4:\"name\";s:6:\"Status\";s:5:\"value\";N;}s:32:\"14d838e8568853b6c12bde092cf6fcbb\";a:2:{s:4:\"name\";s:9:\"Create At\";s:5:\"value\";N;}s:32:\"1941f6f0e1790f221a9306bd06a9c05b\";a:2:{s:4:\"name\";s:9:\"Update At\";s:5:\"value\";N;}s:32:\"caabbc50d2205d323279eb0de28df194\";a:2:{s:4:\"name\";s:4:\"Edit\";s:5:\"value\";N;}s:32:\"0a16f30a7de493151df0838e8f0614ed\";a:2:{s:4:\"name\";s:7:\"Preview\";s:5:\"value\";N;}s:32:\"2c8e8a7c4512658e744f25080476dc86\";a:2:{s:4:\"name\";s:5:\"Trash\";s:5:\"value\";N;}s:32:\"f8a416c12dea55c2857aaf8eaf49aa88\";a:2:{s:4:\"name\";s:5:\"Title\";s:5:\"value\";N;}s:32:\"802886669980d44e23c45116950ccee4\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";N;}s:32:\"5c0f88b350a9dec052e83d8b7ab46656\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"8630e4c1db19346b37dcc353bedcc0b2\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"3b8de48ef9e24e57c7ebc625ce74b669\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";N;}s:32:\"5564293b759d79cc3c82e0eff0f96a6a\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"13d3e34226670623a663aefeaa78ca6c\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"ae0dc8360f1493bb1dfdc83b6e6da0f1\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"f2d9ce115a38fd7516ed8a2ef5a68a73\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8f754f671153823c0750dc643fc10862\";a:2:{s:4:\"name\";s:15:\"Category Create\";s:5:\"value\";N;}s:32:\"851a31d3ad3aa806fd6a9dba6c528322\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"5308d7cefd8421a79357324f8dc8772b\";a:2:{s:4:\"name\";s:21:\"Category Edit : :Name\";s:5:\"value\";N;}s:32:\"69713a0a387e995af5d4a0658331fad0\";a:2:{s:4:\"name\";s:19:\"Error update failed\";s:5:\"value\";N;}s:32:\"0872e85c3750746b17455d97c8bcb8bc\";a:2:{s:4:\"name\";s:19:\"Update Successfully\";s:5:\"value\";N;}s:32:\"18d1ad637ea8f7048f3cca0ea41ffae9\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f98a5e080dabc6134a7c4ea0b04504b8\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"af0a44f35003a9dbaa408b83154f38b9\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"529f58491b46aff94ca99602cf946dac\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"fde32b5d6b669a314d238d1c03a261a6\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"2441925e45663a1b875bddb8da5097d7\";a:2:{s:4:\"name\";s:5:\"First\";s:5:\"value\";N;}s:32:\"623ddc2bc5e277840e5663367daf6888\";a:2:{s:4:\"name\";s:4:\"Last\";s:5:\"value\";N;}s:32:\"6737c71e7b6cfb4a479493d55d1d686d\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"eae111172ccf87f9791f4fad5b88eb90\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";N;}s:32:\"a5b2ad2d51a03c36fe21c0ac0d9ee796\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"245bd2f466ada51ae30b4177235cbbf4\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"3289e64e9ef6be1a2e63d0d14a1d9fda\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"66f32c75234daa84ef72fd70cebe9bbc\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"55844f1d7bd9cf7eeb2bbf8816c09411\";a:2:{s:4:\"name\";s:5:\"Close\";s:5:\"value\";N;}s:32:\"47c93d3fb5b69ba533bdaf0b683fd3ce\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"1a47920739d655627abbbe64e252fdfa\";a:2:{s:4:\"name\";s:10:\"List Empty\";s:5:\"value\";N;}s:32:\"3a963be719849b97adcd2f3004daa881\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0597b0a564fb58743fc6d56fef3bcca0\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"babff3d7d82fcbd62d056172e3877987\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"18ba178ee292addde5f8c6f79362c3ba\";a:2:{s:4:\"name\";s:17:\"Edit Layout :name\";s:5:\"value\";N;}s:32:\"0e8c4816046b55336d6e814a86b448c6\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"187e3809546af1aa3991787a76520951\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";N;}s:32:\"67fcc91a851da49e419f5ecfd68efdb0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"4c646971faaaba867e81f561949f6579\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"918988b09faaf85b7991572f0075a4d9\";a:2:{s:4:\"name\";s:4:\"User\";s:5:\"value\";N;}s:32:\"d593a775811890a31bd954beacc8795c\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"f1b516fce95fc8c8f1da6a8a9c8945bd\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a38af5b949d3d781fd959a6c7e70c23b\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"1ce429690616260932f6d1f420a9ebd0\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"dcf421d4e90c67b917fdfc633d8eb888\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"8b1a590c6ea2219f7703f9311e3c8a51\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"c80a7ff131257d81c9de11547282e1db\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"5223e67481b9e54b00bd15dc35dea91b\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"e5346cbe203e7a2ccab781a684158097\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"e971f5985667dc6ee3d309fc9986ed9c\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"8b5e739c13eeaf9a3e4f6514f56b9082\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"6170a61cd0b42b6ed27d8e532578c9ab\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"6867adf0a7247b763595aef0b22da0d9\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";N;}s:32:\"1451ce67c3106687fd85920423867128\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"6ab18be957da5d271ca74517a1096d85\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"vi\";a:63:{s:32:\"c54e439ce10495935e37b5e9e2c4d6dc\";a:2:{s:4:\"name\";s:2:\"Id\";s:5:\"value\";s:3:\"Mã\";}s:32:\"9263cf79ab9b3749d1c8a881f8ae6505\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";s:4:\"Tên\";}s:32:\"cbbe35271deb32d04718517a7e6fd525\";a:2:{s:4:\"name\";s:4:\"Type\";s:5:\"value\";N;}s:32:\"bfe602fddfc0cd02ea67a43931e2b9b3\";a:2:{s:4:\"name\";s:6:\"Status\";s:5:\"value\";N;}s:32:\"14d838e8568853b6c12bde092cf6fcbb\";a:2:{s:4:\"name\";s:9:\"Create At\";s:5:\"value\";N;}s:32:\"1941f6f0e1790f221a9306bd06a9c05b\";a:2:{s:4:\"name\";s:9:\"Update At\";s:5:\"value\";N;}s:32:\"caabbc50d2205d323279eb0de28df194\";a:2:{s:4:\"name\";s:4:\"Edit\";s:5:\"value\";N;}s:32:\"0a16f30a7de493151df0838e8f0614ed\";a:2:{s:4:\"name\";s:7:\"Preview\";s:5:\"value\";N;}s:32:\"2c8e8a7c4512658e744f25080476dc86\";a:2:{s:4:\"name\";s:5:\"Trash\";s:5:\"value\";N;}s:32:\"f8a416c12dea55c2857aaf8eaf49aa88\";a:2:{s:4:\"name\";s:5:\"Title\";s:5:\"value\";N;}s:32:\"802886669980d44e23c45116950ccee4\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";N;}s:32:\"5c0f88b350a9dec052e83d8b7ab46656\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"8630e4c1db19346b37dcc353bedcc0b2\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"3b8de48ef9e24e57c7ebc625ce74b669\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";N;}s:32:\"5564293b759d79cc3c82e0eff0f96a6a\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"13d3e34226670623a663aefeaa78ca6c\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"ae0dc8360f1493bb1dfdc83b6e6da0f1\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"f2d9ce115a38fd7516ed8a2ef5a68a73\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8f754f671153823c0750dc643fc10862\";a:2:{s:4:\"name\";s:15:\"Category Create\";s:5:\"value\";N;}s:32:\"851a31d3ad3aa806fd6a9dba6c528322\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"5308d7cefd8421a79357324f8dc8772b\";a:2:{s:4:\"name\";s:21:\"Category Edit : :Name\";s:5:\"value\";N;}s:32:\"69713a0a387e995af5d4a0658331fad0\";a:2:{s:4:\"name\";s:19:\"Error update failed\";s:5:\"value\";N;}s:32:\"0872e85c3750746b17455d97c8bcb8bc\";a:2:{s:4:\"name\";s:19:\"Update Successfully\";s:5:\"value\";N;}s:32:\"18d1ad637ea8f7048f3cca0ea41ffae9\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f98a5e080dabc6134a7c4ea0b04504b8\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"af0a44f35003a9dbaa408b83154f38b9\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"529f58491b46aff94ca99602cf946dac\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"fde32b5d6b669a314d238d1c03a261a6\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"2441925e45663a1b875bddb8da5097d7\";a:2:{s:4:\"name\";s:5:\"First\";s:5:\"value\";N;}s:32:\"623ddc2bc5e277840e5663367daf6888\";a:2:{s:4:\"name\";s:4:\"Last\";s:5:\"value\";N;}s:32:\"6737c71e7b6cfb4a479493d55d1d686d\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"eae111172ccf87f9791f4fad5b88eb90\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";N;}s:32:\"a5b2ad2d51a03c36fe21c0ac0d9ee796\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"245bd2f466ada51ae30b4177235cbbf4\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"3289e64e9ef6be1a2e63d0d14a1d9fda\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"66f32c75234daa84ef72fd70cebe9bbc\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"55844f1d7bd9cf7eeb2bbf8816c09411\";a:2:{s:4:\"name\";s:5:\"Close\";s:5:\"value\";N;}s:32:\"47c93d3fb5b69ba533bdaf0b683fd3ce\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"1a47920739d655627abbbe64e252fdfa\";a:2:{s:4:\"name\";s:10:\"List Empty\";s:5:\"value\";N;}s:32:\"3a963be719849b97adcd2f3004daa881\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0597b0a564fb58743fc6d56fef3bcca0\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"babff3d7d82fcbd62d056172e3877987\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"18ba178ee292addde5f8c6f79362c3ba\";a:2:{s:4:\"name\";s:17:\"Edit Layout :name\";s:5:\"value\";N;}s:32:\"0e8c4816046b55336d6e814a86b448c6\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"187e3809546af1aa3991787a76520951\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";N;}s:32:\"67fcc91a851da49e419f5ecfd68efdb0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"4c646971faaaba867e81f561949f6579\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"918988b09faaf85b7991572f0075a4d9\";a:2:{s:4:\"name\";s:4:\"User\";s:5:\"value\";N;}s:32:\"d593a775811890a31bd954beacc8795c\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"f1b516fce95fc8c8f1da6a8a9c8945bd\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a38af5b949d3d781fd959a6c7e70c23b\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"1ce429690616260932f6d1f420a9ebd0\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"dcf421d4e90c67b917fdfc633d8eb888\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"8b1a590c6ea2219f7703f9311e3c8a51\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"c80a7ff131257d81c9de11547282e1db\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"5223e67481b9e54b00bd15dc35dea91b\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"e5346cbe203e7a2ccab781a684158097\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"e971f5985667dc6ee3d309fc9986ed9c\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"8b5e739c13eeaf9a3e4f6514f56b9082\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"6170a61cd0b42b6ed27d8e532578c9ab\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"6867adf0a7247b763595aef0b22da0d9\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";N;}s:32:\"1451ce67c3106687fd85920423867128\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"6ab18be957da5d271ca74517a1096d85\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"jp\";a:63:{s:32:\"c54e439ce10495935e37b5e9e2c4d6dc\";a:2:{s:4:\"name\";s:2:\"Id\";s:5:\"value\";N;}s:32:\"9263cf79ab9b3749d1c8a881f8ae6505\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"cbbe35271deb32d04718517a7e6fd525\";a:2:{s:4:\"name\";s:4:\"Type\";s:5:\"value\";N;}s:32:\"bfe602fddfc0cd02ea67a43931e2b9b3\";a:2:{s:4:\"name\";s:6:\"Status\";s:5:\"value\";N;}s:32:\"14d838e8568853b6c12bde092cf6fcbb\";a:2:{s:4:\"name\";s:9:\"Create At\";s:5:\"value\";N;}s:32:\"1941f6f0e1790f221a9306bd06a9c05b\";a:2:{s:4:\"name\";s:9:\"Update At\";s:5:\"value\";N;}s:32:\"caabbc50d2205d323279eb0de28df194\";a:2:{s:4:\"name\";s:4:\"Edit\";s:5:\"value\";N;}s:32:\"0a16f30a7de493151df0838e8f0614ed\";a:2:{s:4:\"name\";s:7:\"Preview\";s:5:\"value\";N;}s:32:\"2c8e8a7c4512658e744f25080476dc86\";a:2:{s:4:\"name\";s:5:\"Trash\";s:5:\"value\";N;}s:32:\"f8a416c12dea55c2857aaf8eaf49aa88\";a:2:{s:4:\"name\";s:5:\"Title\";s:5:\"value\";N;}s:32:\"802886669980d44e23c45116950ccee4\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";N;}s:32:\"5c0f88b350a9dec052e83d8b7ab46656\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"8630e4c1db19346b37dcc353bedcc0b2\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"3b8de48ef9e24e57c7ebc625ce74b669\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";N;}s:32:\"5564293b759d79cc3c82e0eff0f96a6a\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"13d3e34226670623a663aefeaa78ca6c\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"ae0dc8360f1493bb1dfdc83b6e6da0f1\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"f2d9ce115a38fd7516ed8a2ef5a68a73\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8f754f671153823c0750dc643fc10862\";a:2:{s:4:\"name\";s:15:\"Category Create\";s:5:\"value\";N;}s:32:\"851a31d3ad3aa806fd6a9dba6c528322\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"5308d7cefd8421a79357324f8dc8772b\";a:2:{s:4:\"name\";s:21:\"Category Edit : :Name\";s:5:\"value\";N;}s:32:\"69713a0a387e995af5d4a0658331fad0\";a:2:{s:4:\"name\";s:19:\"Error update failed\";s:5:\"value\";N;}s:32:\"0872e85c3750746b17455d97c8bcb8bc\";a:2:{s:4:\"name\";s:19:\"Update Successfully\";s:5:\"value\";N;}s:32:\"18d1ad637ea8f7048f3cca0ea41ffae9\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f98a5e080dabc6134a7c4ea0b04504b8\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"af0a44f35003a9dbaa408b83154f38b9\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"529f58491b46aff94ca99602cf946dac\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"fde32b5d6b669a314d238d1c03a261a6\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"2441925e45663a1b875bddb8da5097d7\";a:2:{s:4:\"name\";s:5:\"First\";s:5:\"value\";N;}s:32:\"623ddc2bc5e277840e5663367daf6888\";a:2:{s:4:\"name\";s:4:\"Last\";s:5:\"value\";N;}s:32:\"6737c71e7b6cfb4a479493d55d1d686d\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"eae111172ccf87f9791f4fad5b88eb90\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";N;}s:32:\"a5b2ad2d51a03c36fe21c0ac0d9ee796\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"245bd2f466ada51ae30b4177235cbbf4\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"3289e64e9ef6be1a2e63d0d14a1d9fda\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"66f32c75234daa84ef72fd70cebe9bbc\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"55844f1d7bd9cf7eeb2bbf8816c09411\";a:2:{s:4:\"name\";s:5:\"Close\";s:5:\"value\";N;}s:32:\"47c93d3fb5b69ba533bdaf0b683fd3ce\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"1a47920739d655627abbbe64e252fdfa\";a:2:{s:4:\"name\";s:10:\"List Empty\";s:5:\"value\";N;}s:32:\"3a963be719849b97adcd2f3004daa881\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0597b0a564fb58743fc6d56fef3bcca0\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"babff3d7d82fcbd62d056172e3877987\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"18ba178ee292addde5f8c6f79362c3ba\";a:2:{s:4:\"name\";s:17:\"Edit Layout :name\";s:5:\"value\";N;}s:32:\"0e8c4816046b55336d6e814a86b448c6\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"187e3809546af1aa3991787a76520951\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";N;}s:32:\"67fcc91a851da49e419f5ecfd68efdb0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"4c646971faaaba867e81f561949f6579\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"918988b09faaf85b7991572f0075a4d9\";a:2:{s:4:\"name\";s:4:\"User\";s:5:\"value\";N;}s:32:\"d593a775811890a31bd954beacc8795c\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"f1b516fce95fc8c8f1da6a8a9c8945bd\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a38af5b949d3d781fd959a6c7e70c23b\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"1ce429690616260932f6d1f420a9ebd0\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"dcf421d4e90c67b917fdfc633d8eb888\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"8b1a590c6ea2219f7703f9311e3c8a51\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"c80a7ff131257d81c9de11547282e1db\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"5223e67481b9e54b00bd15dc35dea91b\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"e5346cbe203e7a2ccab781a684158097\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"e971f5985667dc6ee3d309fc9986ed9c\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"8b5e739c13eeaf9a3e4f6514f56b9082\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"6170a61cd0b42b6ed27d8e532578c9ab\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"6867adf0a7247b763595aef0b22da0d9\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";N;}s:32:\"1451ce67c3106687fd85920423867128\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"6ab18be957da5d271ca74517a1096d85\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"cn\";a:63:{s:32:\"c54e439ce10495935e37b5e9e2c4d6dc\";a:2:{s:4:\"name\";s:2:\"Id\";s:5:\"value\";N;}s:32:\"9263cf79ab9b3749d1c8a881f8ae6505\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"cbbe35271deb32d04718517a7e6fd525\";a:2:{s:4:\"name\";s:4:\"Type\";s:5:\"value\";N;}s:32:\"bfe602fddfc0cd02ea67a43931e2b9b3\";a:2:{s:4:\"name\";s:6:\"Status\";s:5:\"value\";N;}s:32:\"14d838e8568853b6c12bde092cf6fcbb\";a:2:{s:4:\"name\";s:9:\"Create At\";s:5:\"value\";N;}s:32:\"1941f6f0e1790f221a9306bd06a9c05b\";a:2:{s:4:\"name\";s:9:\"Update At\";s:5:\"value\";N;}s:32:\"caabbc50d2205d323279eb0de28df194\";a:2:{s:4:\"name\";s:4:\"Edit\";s:5:\"value\";N;}s:32:\"0a16f30a7de493151df0838e8f0614ed\";a:2:{s:4:\"name\";s:7:\"Preview\";s:5:\"value\";N;}s:32:\"2c8e8a7c4512658e744f25080476dc86\";a:2:{s:4:\"name\";s:5:\"Trash\";s:5:\"value\";N;}s:32:\"f8a416c12dea55c2857aaf8eaf49aa88\";a:2:{s:4:\"name\";s:5:\"Title\";s:5:\"value\";N;}s:32:\"802886669980d44e23c45116950ccee4\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";N;}s:32:\"5c0f88b350a9dec052e83d8b7ab46656\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"8630e4c1db19346b37dcc353bedcc0b2\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"3b8de48ef9e24e57c7ebc625ce74b669\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";N;}s:32:\"5564293b759d79cc3c82e0eff0f96a6a\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"13d3e34226670623a663aefeaa78ca6c\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"ae0dc8360f1493bb1dfdc83b6e6da0f1\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"f2d9ce115a38fd7516ed8a2ef5a68a73\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8f754f671153823c0750dc643fc10862\";a:2:{s:4:\"name\";s:15:\"Category Create\";s:5:\"value\";N;}s:32:\"851a31d3ad3aa806fd6a9dba6c528322\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"5308d7cefd8421a79357324f8dc8772b\";a:2:{s:4:\"name\";s:21:\"Category Edit : :Name\";s:5:\"value\";N;}s:32:\"69713a0a387e995af5d4a0658331fad0\";a:2:{s:4:\"name\";s:19:\"Error update failed\";s:5:\"value\";N;}s:32:\"0872e85c3750746b17455d97c8bcb8bc\";a:2:{s:4:\"name\";s:19:\"Update Successfully\";s:5:\"value\";N;}s:32:\"18d1ad637ea8f7048f3cca0ea41ffae9\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f98a5e080dabc6134a7c4ea0b04504b8\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"af0a44f35003a9dbaa408b83154f38b9\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"529f58491b46aff94ca99602cf946dac\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"fde32b5d6b669a314d238d1c03a261a6\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"2441925e45663a1b875bddb8da5097d7\";a:2:{s:4:\"name\";s:5:\"First\";s:5:\"value\";N;}s:32:\"623ddc2bc5e277840e5663367daf6888\";a:2:{s:4:\"name\";s:4:\"Last\";s:5:\"value\";N;}s:32:\"6737c71e7b6cfb4a479493d55d1d686d\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"eae111172ccf87f9791f4fad5b88eb90\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";N;}s:32:\"a5b2ad2d51a03c36fe21c0ac0d9ee796\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"245bd2f466ada51ae30b4177235cbbf4\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"3289e64e9ef6be1a2e63d0d14a1d9fda\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"66f32c75234daa84ef72fd70cebe9bbc\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"55844f1d7bd9cf7eeb2bbf8816c09411\";a:2:{s:4:\"name\";s:5:\"Close\";s:5:\"value\";N;}s:32:\"47c93d3fb5b69ba533bdaf0b683fd3ce\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"1a47920739d655627abbbe64e252fdfa\";a:2:{s:4:\"name\";s:10:\"List Empty\";s:5:\"value\";N;}s:32:\"3a963be719849b97adcd2f3004daa881\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0597b0a564fb58743fc6d56fef3bcca0\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"babff3d7d82fcbd62d056172e3877987\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"18ba178ee292addde5f8c6f79362c3ba\";a:2:{s:4:\"name\";s:17:\"Edit Layout :name\";s:5:\"value\";N;}s:32:\"0e8c4816046b55336d6e814a86b448c6\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"187e3809546af1aa3991787a76520951\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";N;}s:32:\"67fcc91a851da49e419f5ecfd68efdb0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"4c646971faaaba867e81f561949f6579\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"918988b09faaf85b7991572f0075a4d9\";a:2:{s:4:\"name\";s:4:\"User\";s:5:\"value\";N;}s:32:\"d593a775811890a31bd954beacc8795c\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"f1b516fce95fc8c8f1da6a8a9c8945bd\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a38af5b949d3d781fd959a6c7e70c23b\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"1ce429690616260932f6d1f420a9ebd0\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"dcf421d4e90c67b917fdfc633d8eb888\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"8b1a590c6ea2219f7703f9311e3c8a51\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"c80a7ff131257d81c9de11547282e1db\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"5223e67481b9e54b00bd15dc35dea91b\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"e5346cbe203e7a2ccab781a684158097\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"e971f5985667dc6ee3d309fc9986ed9c\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"8b5e739c13eeaf9a3e4f6514f56b9082\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"6170a61cd0b42b6ed27d8e532578c9ab\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"6867adf0a7247b763595aef0b22da0d9\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";N;}s:32:\"1451ce67c3106687fd85920423867128\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"6ab18be957da5d271ca74517a1096d85\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}}}', NULL, NULL),
(3, 'core:layout', 'option', 'a:1:{s:4:\"data\";a:2:{s:7:\"columns\";a:6:{s:2:\"id\";s:2:\"id\";s:4:\"name\";s:4:\"name\";s:4:\"type\";s:4:\"type\";s:6:\"status\";s:6:\"status\";s:10:\"created_at\";s:10:\"created_at\";s:10:\"updated_at\";s:10:\"updated_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"35\";}}}', NULL, NULL),
(4, 'core:page', 'option', 'a:1:{s:4:\"data\";a:2:{s:7:\"columns\";a:5:{s:2:\"id\";s:2:\"id\";s:5:\"title\";s:5:\"title\";s:6:\"status\";s:6:\"status\";s:10:\"created_at\";s:10:\"created_at\";s:10:\"updated_at\";s:10:\"updated_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"20\";}}}', NULL, NULL),
(5, 'blog:category', 'category', 'a:1:{s:4:\"data\";a:2:{i:0;a:2:{s:4:\"name\";s:4:\"game\";s:2:\"id\";s:2:\"21\";}i:1;a:3:{s:4:\"name\";s:3:\"abc\";s:2:\"id\";s:2:\"12\";s:8:\"children\";a:2:{i:0;a:3:{s:4:\"name\";s:3:\"mmm\";s:2:\"id\";s:2:\"16\";s:8:\"children\";a:1:{i:0;a:2:{s:4:\"name\";s:4:\"cccc\";s:2:\"id\";s:2:\"18\";}}}i:1;a:2:{s:4:\"name\";s:3:\"bbb\";s:2:\"id\";s:2:\"19\";}}}}}', NULL, NULL),
(6, 'category', 'category', 'a:2:{i:0;a:1:{s:2:\"id\";s:1:\"1\";}i:1;a:2:{s:2:\"id\";s:1:\"4\";s:8:\"children\";a:1:{i:0;a:1:{s:2:\"id\";s:1:\"5\";}}}}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_layout`
--

CREATE TABLE `cms_layout` (
  `id` int(5) NOT NULL,
  `token` varchar(255) NOT NULL,
  `theme` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_layout`
--

INSERT INTO `cms_layout` (`id`, `token`, `theme`, `name`, `slug`, `type`, `status`, `content`, `created_at`, `updated_at`) VALUES
(7, '094bde12-ffeb-4fdc-ae8e-a5c1a80e2d9f', 'zoe', 'demo', 'demo', 'partial', 1, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6NDp7czo4OiJjb21waWxlciI7YTowOnt9czozOiJ0YWciO3M6NDoibm9uZSI7czo2OiJzdGF0dXMiO2k6MTtzOjI6ImlkIjtzOjM2OiI4NjU4MDliNy00YTA1LWYxODYtODM3Yi0yMDRlNjBmMzc5ZGUiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjk6IjEzNDUzNDg5NiI7fX1zOjM6Im9wdCI7YTowOnt9fXM6NDoidmlldyI7YToxOntpOjA7YTowOnt9fX19fXM6Njoid2lkZ2V0IjthOjA6e319', '2019-08-02 21:54:56', '2019-08-14 10:19:37'),
(8, '43cf4e41-5e88-4163-88e2-e8dd47c9eae7', 'zoe', 'demo', 'demo', 'layout', 1, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6NDp7czo4OiJjb21waWxlciI7YTowOnt9czozOiJ0YWciO3M6NDoibm9uZSI7czo2OiJzdGF0dXMiO2k6MTtzOjI6ImlkIjtzOjM2OiIxMGFhMGIyZS1kMTE4LWE1N2QtYTA1ZC01ZjIyYzEzY2RmZmMiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjEwOiIxNzkyOTMwNDg1Ijt9fXM6Mzoib3B0IjthOjA6e319czo0OiJ2aWV3IjthOjE6e2k6MDthOjE6e2k6MDtzOjM2OiI1Y2U0YWFkMy0xMjM3LTcxNzctZjgxZi0wMmEzM2ZkMjU1ZmYiO319fX19czo2OiJ3aWRnZXQiO2E6MTp7czozNjoiNWNlNGFhZDMtMTIzNy03MTc3LWY4MWYtMDJhMzNmZDI1NWZmIjthOjM6e3M6MzoiY2ZnIjthOjg6e3M6NToidGl0bGUiO047czo0OiJmdW5jIjtzOjEzOiJDb21tZW50c1xtYWluIjtzOjQ6InZpZXciO3M6NDM6InBsdWdpbkNvbW1lbnQ6OmNvbXBvbmVudC5jb21tZW50LnZpZXdzLm1haW4iO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6NjoicHVibGljIjtzOjE6IjEiO3M6NzoiZHluYW1pYyI7czoxOiIxIjtzOjg6InRlbXBsYXRlIjthOjI6e3M6NDoidmlldyI7czoxOiIwIjtzOjQ6ImRhdGEiO2E6Mzp7aTowO047aToxO047aToyO047fX1zOjI6ImlkIjtzOjM2OiI1Y2U0YWFkMy0xMjM3LTcxNzctZjgxZi0wMmEzM2ZkMjU1ZmYiO31zOjM6InN0ZyI7YTo2OntzOjY6InN5c3RlbSI7czo2OiJwbHVnaW4iO3M6NjoibW9kdWxlIjtzOjc6IkNvbW1lbnQiO3M6NDoidHlwZSI7czo5OiJjb21wb25lbnQiO3M6MzoicG9zIjtOO3M6NDoibmFtZSI7czo3OiJjb21tZW50IjtzOjQ6Im1haW4iO2E6Mjp7czoxMzoiQ29tbWVudHNcbWFpbiI7czo0OiJkYXRhIjtzOjE2OiJDb21tZW50c1xMaXN0TmV3IjtzOjQ6ImRhdGEiO319czozOiJvcHQiO2E6MTp7czo1OiJsaXN0cyI7YTo0OntpOjA7YTozOntzOjQ6Im5hbWUiO047czo1OiJpbWFnZSI7TjtzOjQ6ImxpbmsiO047fWk6MTthOjM6e3M6NDoibmFtZSI7TjtzOjU6ImltYWdlIjtOO3M6NDoibGluayI7Tjt9aToyO2E6Mzp7czo0OiJuYW1lIjtOO3M6NToiaW1hZ2UiO047czo0OiJsaW5rIjtOO31pOjM7YTozOntzOjQ6Im5hbWUiO047czo1OiJpbWFnZSI7TjtzOjQ6ImxpbmsiO047fX19fX19', '2019-08-13 06:36:50', '2019-08-14 10:21:56'),
(14, 'a0edb072-260e-436e-92e6-9d9857db26c9', 'zoe', 'Home', 'home', 'layout', 0, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6NDp7czo4OiJjb21waWxlciI7YTowOnt9czozOiJ0YWciO3M6NDoibm9uZSI7czo2OiJzdGF0dXMiO2k6MTtzOjI6ImlkIjtzOjM2OiJiNzZiZGY0OS1kNGE1LThhNzEtZjJiNy05YzBjYzFjYTVkY2MiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjEwOiIxNzczMjE2ODU2Ijt9fXM6Mzoib3B0IjthOjA6e319czo0OiJ2aWV3IjthOjE6e2k6MDthOjI6e2k6MDtzOjM2OiI1Y2U0YWFkMy0xMjM3LTcxNzctZjgxZi0wMmEzM2ZkMjU1ZmYiO2k6MTtzOjM2OiJhMDJjZTk3NS1hZjU4LTQxZWItM2UyZC04OTYwYjExZGZlZWYiO319fX19czo2OiJ3aWRnZXQiO2E6Mjp7czozNjoiNWNlNGFhZDMtMTIzNy03MTc3LWY4MWYtMDJhMzNmZDI1NWZmIjthOjM6e3M6MzoiY2ZnIjthOjk6e3M6NToidGl0bGUiO3M6NjoiZGVtbyAxIjtzOjQ6ImZ1bmMiO3M6MTM6IkNvbW1lbnRzXG1haW4iO3M6NDoidmlldyI7czo0MzoicGx1Z2luQ29tbWVudDo6Y29tcG9uZW50LmNvbW1lbnQudmlld3MubWFpbiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo2OiJwdWJsaWMiO3M6MToiMSI7czo3OiJkeW5hbWljIjtzOjE6IjEiO3M6ODoidGVtcGxhdGUiO2E6Mjp7czo0OiJ2aWV3IjtzOjE6IjAiO3M6NDoiZGF0YSI7YTozOntpOjA7czowOiIiO2k6MTtzOjA6IiI7aToyO3M6MDoiIjt9fXM6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjA6e31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiNWNlNGFhZDMtMTIzNy03MTc3LWY4MWYtMDJhMzNmZDI1NWZmIjt9czozOiJzdGciO2E6Njp7czo2OiJzeXN0ZW0iO3M6NjoicGx1Z2luIjtzOjY6Im1vZHVsZSI7czo3OiJDb21tZW50IjtzOjQ6InR5cGUiO3M6OToiY29tcG9uZW50IjtzOjM6InBvcyI7TjtzOjQ6Im5hbWUiO3M6NzoiY29tbWVudCI7czo0OiJtYWluIjthOjI6e3M6MTM6IkNvbW1lbnRzXG1haW4iO3M6NDoiZGF0YSI7czoxNjoiQ29tbWVudHNcTGlzdE5ldyI7czo0OiJkYXRhIjt9fXM6Mzoib3B0IjthOjE6e3M6NToibGlzdHMiO2E6NDp7aTowO2E6Mzp7czo0OiJuYW1lIjtzOjA6IiI7czo1OiJpbWFnZSI7czowOiIiO3M6NDoibGluayI7czowOiIiO31pOjE7YTozOntzOjQ6Im5hbWUiO3M6MDoiIjtzOjU6ImltYWdlIjtzOjA6IiI7czo0OiJsaW5rIjtzOjA6IiI7fWk6MjthOjM6e3M6NDoibmFtZSI7czowOiIiO3M6NToiaW1hZ2UiO3M6MDoiIjtzOjQ6ImxpbmsiO3M6MDoiIjt9aTozO2E6Mzp7czo0OiJuYW1lIjtzOjA6IiI7czo1OiJpbWFnZSI7czowOiIiO3M6NDoibGluayI7czowOiIiO319fX1zOjM2OiJhMDJjZTk3NS1hZjU4LTQxZWItM2UyZC04OTYwYjExZGZlZWYiO2E6Mjp7czozOiJjZmciO2E6Nzp7czo1OiJ0aXRsZSI7czo2OiJkZW1vIDIiO3M6NDoiZnVuYyI7czo5OiJObyBBY3Rpb24iO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NzoiZHluYW1pYyI7czoxOiIwIjtzOjg6ImNvbXBpbGVyIjthOjI6e3M6NDoiZ3JpZCI7YTowOnt9czo1OiJibGFkZSI7YTowOnt9fXM6MjoiaWQiO3M6MzY6ImEwMmNlOTc1LWFmNTgtNDFlYi0zZTJkLTg5NjBiMTFkZmVlZiI7fXM6Mzoic3RnIjthOjY6e3M6Njoic3lzdGVtIjtzOjU6InRoZW1lIjtzOjY6Im1vZHVsZSI7czozOiJ6b2UiO3M6NDoidHlwZSI7czo3OiJwYXJ0aWFsIjtzOjI6ImlkIjtzOjE6IjciO3M6NToidG9rZW4iO3M6MzY6IjA5NGJkZTEyLWZmZWItNGZkYy1hZThlLWE1YzFhODBlMmQ5ZiI7czo0OiJuYW1lIjtzOjQ6ImRlbW8iO319fX0=', '2019-08-14 03:11:43', '2019-08-14 10:22:47'),
(15, '7d8b1cf8-6ba6-442c-8305-33b4c5e0040f', 'zoe', 'olala', 'olala', 'layout', 1, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6Nzp7czo1OiJ0aXRsZSI7czoyOiJmZyI7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjA6IiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czozOiJ0YWciO3M6NDoibm9uZSI7czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiI5ZGFkMDgxYy04MDYyLTNiNzctZWI0ZC03ZWQ3Y2JlODQ0M2IiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjk6IjU1ODI0NDkwMiI7fX1zOjM6Im9wdCI7YToxOntzOjQ6ImF0dHIiO2E6Mjp7czo1OiJjbGFzcyI7czowOiIiO3M6MjoiaWQiO3M6MDoiIjt9fX1zOjQ6InZpZXciO2E6MTp7aTowO2E6MDp7fX19fX1zOjY6IndpZGdldCI7YTowOnt9fQ==', '2019-08-24 02:05:30', '2019-08-24 02:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `cms_migrations`
--

CREATE TABLE `cms_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_migrations`
--

INSERT INTO `cms_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_07_22_100913_blog', 1),
(2, '2019_07_23_023604_user', 1),
(3, '2019_07_27_025039_create_page_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cms_module`
--

CREATE TABLE `cms_module` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `version` varchar(5) NOT NULL DEFAULT '1.0.0',
  `data` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_module`
--

INSERT INTO `cms_module` (`id`, `name`, `version`, `data`, `status`, `create_at`) VALUES
(1, 'blog', '1.0.0', '[]', 1, '2019-08-18 08:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`id`, `slug`, `title`, `description`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'gioi-thieu-1', 'Giới thiệu 1', 'demo sfsdfsfsf', '<p>@for ($i = 0; $i &lt; 10; $i++)</p>\r\n<div>The current value is {{ $i }}</div>\r\n<p>@endfor</p>', 1, '2019-07-26 20:14:53', '2019-08-17 04:15:32'),
(2, 'lien-he', 'Liên hệ', 'demo', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"/uploads/bg_win.png\" alt=\"\" />{{demo()}}</p>', 0, '2019-07-26 20:35:32', '2019-08-19 03:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `cms_permissions`
--

CREATE TABLE `cms_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_permissions`
--

INSERT INTO `cms_permissions` (`id`, `name`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'dashboard:list', 1, '2019-07-23 17:00:00', '2019-07-23 17:00:00'),
(2, 'module:blog:dashboard', 1, '2019-07-23 17:00:00', '2019-07-23 17:00:00'),
(3, 'blog', 1, '2019-07-23 17:00:00', '2019-07-23 17:00:00'),
(4, 'module:blog:post:list', 1, '2019-07-23 17:00:00', '2019-07-23 17:00:00'),
(5, 'module:user:index:index', 1, '2019-07-23 17:00:00', '2019-07-23 17:00:00'),
(6, 'module:user:role:index', 1, '2019-07-23 17:00:00', '2019-07-23 17:00:00'),
(7, 'module:user:permission:index', 1, '2019-07-23 17:00:00', '2019-07-23 17:00:00'),
(8, 'user:home:member', 3, '2019-07-23 17:00:00', '2019-07-23 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cms_permissions_user`
--

CREATE TABLE `cms_permissions_user` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_permissions_user`
--

INSERT INTO `cms_permissions_user` (`id`, `user_id`, `name`, `guard_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'user', 'backend', 1, '2019-08-01 17:00:00', '2019-08-01 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cms_role`
--

CREATE TABLE `cms_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_role`
--

INSERT INTO `cms_role` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '2019-07-23 17:00:00', '2019-07-23 17:00:00'),
(2, 'post', 'admin', '2019-07-23 17:00:00', '2019-07-23 17:00:00'),
(3, 'member', 'web', '2019-07-23 17:00:00', '2019-07-23 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cms_tag`
--

CREATE TABLE `cms_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(120) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_tag`
--

INSERT INTO `cms_tag` (`id`, `name`, `slug`, `type`, `status`, `created_at`) VALUES
(1, 'demo', 'demo', 'blog:post', 1, '2019-08-22 09:46:51'),
(2, 'abc', 'abc', 'blog:post', 1, '2019-08-19 15:48:51'),
(3, 'đào', 'dao', 'blog:post', 1, '2019-08-22 09:46:51'),
(4, 'mạnh', 'manh', 'blog:post', 1, '2019-08-22 09:46:51'),
(5, 'Trung', 'trung', 'blog:post', 1, '2019-08-19 16:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `cms_tag_item`
--

CREATE TABLE `cms_tag_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_tag_item`
--

INSERT INTO `cms_tag_item` (`id`, `tag_id`, `item_id`) VALUES
(3, 1, 5),
(5, 3, 5),
(6, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cms_user`
--

CREATE TABLE `cms_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_user`
--

INSERT INTO `cms_user` (`id`, `name`, `role_id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'trungtea', 3, 'trungtea', '$2y$10$6nktFKIDAHcjsdCgf8/hyuycapBFxHtmXyH/ctY8KgVHq36AJTAHa', NULL, '2019-07-22 20:22:21', '2019-07-22 20:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '2018-01-18 01:11:34', '2018-01-18 01:11:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_admin`
--
ALTER TABLE `cms_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cms_admin_username_unique` (`username`);

--
-- Indexes for table `cms_blog_post`
--
ALTER TABLE `cms_blog_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_blog_post_category`
--
ALTER TABLE `cms_blog_post_category`
  ADD PRIMARY KEY (`category_id`,`post_id`);

--
-- Indexes for table `cms_blog_post_translation`
--
ALTER TABLE `cms_blog_post_translation`
  ADD UNIQUE KEY `post_id` (`post_id`,`lang_code`);

--
-- Indexes for table `cms_categories`
--
ALTER TABLE `cms_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`,`type`),
  ADD KEY `cms_categories_parent_id_index` (`parent_id`);

--
-- Indexes for table `cms_component`
--
ALTER TABLE `cms_component`
  ADD UNIQUE KEY `id` (`id`,`type`);

--
-- Indexes for table `cms_config`
--
ALTER TABLE `cms_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_layout`
--
ALTER TABLE `cms_layout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_migrations`
--
ALTER TABLE `cms_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `cms_permissions`
--
ALTER TABLE `cms_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`role_id`);

--
-- Indexes for table `cms_permissions_user`
--
ALTER TABLE `cms_permissions_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_role`
--
ALTER TABLE `cms_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_tag`
--
ALTER TABLE `cms_tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`,`type`);

--
-- Indexes for table `cms_tag_item`
--
ALTER TABLE `cms_tag_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_user`
--
ALTER TABLE `cms_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cms_user_username_unique` (`username`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_users_user_id_index` (`user_id`),
  ADD KEY `role_users_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_admin`
--
ALTER TABLE `cms_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_blog_post`
--
ALTER TABLE `cms_blog_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cms_categories`
--
ALTER TABLE `cms_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cms_config`
--
ALTER TABLE `cms_config`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cms_layout`
--
ALTER TABLE `cms_layout`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cms_migrations`
--
ALTER TABLE `cms_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_permissions`
--
ALTER TABLE `cms_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cms_permissions_user`
--
ALTER TABLE `cms_permissions_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms_role`
--
ALTER TABLE `cms_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_tag`
--
ALTER TABLE `cms_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cms_tag_item`
--
ALTER TABLE `cms_tag_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cms_user`
--
ALTER TABLE `cms_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
