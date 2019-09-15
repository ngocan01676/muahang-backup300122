-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 15, 2019 at 05:38 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `status` tinyint(1) DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_admin`
--

INSERT INTO `cms_admin` (`id`, `name`, `role_id`, `avatar`, `username`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'NGUYEN VAN TUAN 1', 1, 'module/admin/dist/img/user2-160x160.jpg', 'admin', '$2y$10$P0GK/41Xk88OL55si5OGpeGrRBRaEkxZcuIbzx1fZiTWIfA1WjaFC', 1, NULL, '2019-07-23 00:23:29', '2019-07-23 00:23:29'),
(2, 'NGUYEN VAN TUAN 2', 2, 'module/admin/dist/img/user2-160x160.jpg', 'admin1', '$2y$10$P0GK/41Xk88OL55si5OGpeGrRBRaEkxZcuIbzx1fZiTWIfA1WjaFC', 1, NULL, '2019-07-23 00:23:29', '2019-07-23 00:23:29'),
(3, 'NGUYEN VAN TUAN 3', 2, 'module/admin/dist/img/user2-160x160.jpg', 'admin2', '$2y$10$P0GK/41Xk88OL55si5OGpeGrRBRaEkxZcuIbzx1fZiTWIfA1WjaFC', 1, NULL, '2019-07-23 00:23:29', '2019-07-23 00:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `cms_blog`
--

CREATE TABLE `cms_blog` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_blog_post`
--

CREATE TABLE `cms_blog_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `featured` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_blog_post`
--

INSERT INTO `cms_blog_post` (`id`, `slug`, `image`, `status`, `user_id`, `featured`, `views`, `created_at`, `updated_at`) VALUES
(4, 'demo', '/uploads/bg_win.png', 1, 1, 1, 0, '2019-08-18 18:50:18', '2019-08-28 03:49:54'),
(5, 'demo', '/uploads/bg_win.png', 1, 1, 1, 0, '2019-08-18 18:53:43', '2019-08-18 20:17:11'),
(6, 'demo', '/uploads/bg_win.png', 1, 1, 1, 0, '2019-08-28 20:06:59', '2019-08-28 20:06:59');

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
(12, 6),
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
(5, 'vi', 'Ví dụ 1', 'Mô tả 1', '<p>Nội dung</p>'),
(6, 'vi', 'deo', 'dsfsdf', '<p>dsfsdfs</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cms_categories`
--

CREATE TABLE `cms_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `type` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'category',
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `order` tinyint(4) NOT NULL DEFAULT '0',
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
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
-- Table structure for table `cms_comments`
--

CREATE TABLE `cms_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_component`
--

CREATE TABLE `cms_component` (
  `id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `data` text CHARACTER SET utf8 NOT NULL,
  `layout` varchar(255) NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `layout_id` int(5) NOT NULL DEFAULT '0',
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
  `data` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_config`
--

INSERT INTO `cms_config` (`id`, `name`, `type`, `data`) VALUES
(1, 'language', 'json', 'a:1:{s:4:\"lang\";a:4:{s:2:\"en\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:9:\"Dashboard\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";s:3:\"Key\";}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:7:\"Plugins\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"vi\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:22:\"Trình điều khiển\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";s:5:\"Khóa\";}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:9:\"Bổ sung\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"jp\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:21:\"ダッシュボード\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:15:\"プラグイン\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"cn\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:9:\"仪表盘\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:6:\"插件\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}}}');
INSERT INTO `cms_config` (`id`, `name`, `type`, `data`) VALUES
(2, 'language', 'data', 'a:1:{s:4:\"lang\";a:4:{s:5:\"en-US\";a:121:{s:32:\"7d1203376941a26e897f96b7df50483f\";a:2:{s:4:\"name\";s:23:\"No Category false , abc\";s:5:\"value\";N;}s:32:\"be013f3a6d6715a1c8d71f78afc27c85\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"d6ac5f29b58eb50fd1586a04ff2bc796\";a:2:{s:4:\"name\";s:4:\"Link\";s:5:\"value\";N;}s:32:\"a76476aa25bc867e1a45525b4ce543f5\";a:2:{s:4:\"name\";s:5:\"Image\";s:5:\"value\";N;}s:32:\"1ea0bad6924b73e132cac7bee38f9ad0\";a:2:{s:4:\"name\";s:6:\"System\";s:5:\"value\";N;}s:32:\"9874f35b4edf9ab4be4e3e1024939df8\";a:2:{s:4:\"name\";s:2:\"Id\";s:5:\"value\";N;}s:32:\"31497ca43f9b1639f32b90def9a41ef1\";a:2:{s:4:\"name\";s:4:\"Type\";s:5:\"value\";N;}s:32:\"e1e4805c69cb37f0402621596b17f09e\";a:2:{s:4:\"name\";s:6:\"Status\";s:5:\"value\";N;}s:32:\"9502493520055a141899a698293ba5ff\";a:2:{s:4:\"name\";s:9:\"Create At\";s:5:\"value\";N;}s:32:\"a91d2c67bb7f442079430ebdff1d1db8\";a:2:{s:4:\"name\";s:9:\"Update At\";s:5:\"value\";N;}s:32:\"6395b093377ea906b538dea341afc0fc\";a:2:{s:4:\"name\";s:4:\"Edit\";s:5:\"value\";N;}s:32:\"06bf2221a23ef07badcd9234dc20603c\";a:2:{s:4:\"name\";s:7:\"Preview\";s:5:\"value\";N;}s:32:\"8dfc62f2baac840aa626d35b0afad08c\";a:2:{s:4:\"name\";s:5:\"Trash\";s:5:\"value\";N;}s:32:\"bf8497f2333ced522040a34e6a266922\";a:2:{s:4:\"name\";s:6:\"Public\";s:5:\"value\";N;}s:32:\"31b41713ed7df12145c2d5538e4f964c\";a:2:{s:4:\"name\";s:8:\"UnPublic\";s:5:\"value\";N;}s:32:\"a1306620c8fc103f942d3860666b0984\";a:2:{s:4:\"name\";s:5:\"Title\";s:5:\"value\";N;}s:32:\"6491c152f7a7ec45afe8cfb872a780d8\";a:2:{s:4:\"name\";s:4:\"Home\";s:5:\"value\";N;}s:32:\"4aada3a7641e12e63d4f07ea14db3147\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";N;}s:32:\"d222b0480a59760fe9165c7ebc203c19\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"53c4c836a4a51819222ed36cf596b601\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"2afc1ae5c1d04b5f8f42dbcb9c2d99bc\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";N;}s:32:\"164686a8229694746f348ce78ee3ef77\";a:2:{s:4:\"name\";s:9:\"Component\";s:5:\"value\";N;}s:32:\"e41d80423fc08b05866f0d07f7b488c3\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"b08b0fcf53f434f1bbcffe83fce093d5\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"8150a15d38d7095f62428de30bb71254\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"dd6f8071a9c6f4f651bd149f03e0a078\";a:2:{s:4:\"name\";s:13:\"Configuration\";s:5:\"value\";N;}s:32:\"420d62b86ce5e7b63cad002f4bdf51f9\";a:2:{s:4:\"name\";s:9:\"Site Name\";s:5:\"value\";N;}s:32:\"a7e40fb978761ec2e404ffb3d77f4158\";a:2:{s:4:\"name\";s:4:\"Logo\";s:5:\"value\";N;}s:32:\"b92a0bf00ca22fca7d57f4f5d33e3b57\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"103ba5e1e5d4b3feed9a5223584f91fd\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"0e0351cb9c354b2bb81dca9743451071\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";N;}s:32:\"a9a0d1899df240235c7315df67d67871\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"066923ceb0e8b19e772da586dd918aa6\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";N;}s:32:\"660144cd3bfa5b0af27e4786c5f5c5ab\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"1ce40393b259e2977cb78840007e6be1\";a:2:{s:4:\"name\";s:13:\"Category List\";s:5:\"value\";N;}s:32:\"edfbf1eede6542ed7a338e75ff6aa60c\";a:2:{s:4:\"name\";s:15:\"Category Create\";s:5:\"value\";N;}s:32:\"3460106eb8ab19d14a1f7245aed17bc7\";a:2:{s:4:\"name\";s:11:\"Description\";s:5:\"value\";N;}s:32:\"0774fde7c3c87feef9f1c5c1ee9ba488\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"d4309e732c55b2cc7e3e7776e787d926\";a:2:{s:4:\"name\";s:27:\"Reset Position Successfully\";s:5:\"value\";N;}s:32:\"fb4bc1a781c0cec4e6f874db63188d92\";a:2:{s:4:\"name\";s:21:\"Category Edit : :Name\";s:5:\"value\";N;}s:32:\"d5f8439526f9f52b1847853956890991\";a:2:{s:4:\"name\";s:7:\"Confirm\";s:5:\"value\";N;}s:32:\"45fcfe8aa0abd67eb0df5ebfda161619\";a:2:{s:4:\"name\";s:33:\"Are you sure to delete this item?\";s:5:\"value\";N;}s:32:\"e5315753d89e19ce33a574ecbfe40c0e\";a:2:{s:4:\"name\";s:19:\"Error update failed\";s:5:\"value\";N;}s:32:\"275e1bcd4e8ed52847857d98c15100a2\";a:2:{s:4:\"name\";s:19:\"Update Successfully\";s:5:\"value\";N;}s:32:\"5678b21d08b6ab375a49e7e9a35933a2\";a:2:{s:4:\"name\";s:17:\"Manager Component\";s:5:\"value\";N;}s:32:\"ef2b832c480f0d7cefee57f11c99b91d\";a:2:{s:4:\"name\";s:21:\"Manager Configuration\";s:5:\"value\";N;}s:32:\"fd076f906f24905156bd7b4113e82c35\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"0bf24321bc4a59f82723d2dee839e205\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"452a133e3befca4a74292bf3cdec7893\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"2c33ba01cba900cce4287ce30f92866b\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"2ee3e7d26f0124e483066ca04bcf3d39\";a:2:{s:4:\"name\";s:5:\"First\";s:5:\"value\";N;}s:32:\"586022c7c851d9e9c074f8f3cc8dcccc\";a:2:{s:4:\"name\";s:4:\"Last\";s:5:\"value\";N;}s:32:\"c0c88c792449c06be76548550a7c576b\";a:2:{s:4:\"name\";s:5:\"Build\";s:5:\"value\";N;}s:32:\"71b8645c30c6ab0f1429e411595bd8a8\";a:2:{s:4:\"name\";s:6:\"Delete\";s:5:\"value\";N;}s:32:\"e5d1e132c5f008e35d1ff73ab2507c24\";a:2:{s:4:\"name\";s:8:\"View Php\";s:5:\"value\";N;}s:32:\"4e00c6dfc98ef41c01f2534ad0cd84ce\";a:2:{s:4:\"name\";s:10:\"View Blade\";s:5:\"value\";N;}s:32:\"6a8758e140fb1efe3ba9a12d081e1b05\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"f2cbda659ed15f7011c32b875657df17\";a:2:{s:4:\"name\";s:3:\"All\";s:5:\"value\";N;}s:32:\"c019ce79e6af30304fc69e85f07cb98a\";a:2:{s:4:\"name\";s:6:\"Filter\";s:5:\"value\";N;}s:32:\"9484fabeb5e1a9f0117ef38a3df4b526\";a:2:{s:4:\"name\";s:14:\"Manager Module\";s:5:\"value\";N;}s:32:\"ed1c2a77066726f5ac1bfbe401c9ed5e\";a:2:{s:4:\"name\";s:7:\"Install\";s:5:\"value\";N;}s:32:\"080edf40b683ed4bb2fd9350750874ab\";a:2:{s:4:\"name\";s:9:\"UnInstall\";s:5:\"value\";N;}s:32:\"054939b11bbd2f583540d49e1e35abe6\";a:2:{s:4:\"name\";s:6:\"Remove\";s:5:\"value\";N;}s:32:\"0b66d27e047813f4ff4dfb1857f962e0\";a:2:{s:4:\"name\";s:27:\"Plugin :plugin not install!\";s:5:\"value\";N;}s:32:\"c365ef199e7721497ced70fa9846ad78\";a:2:{s:4:\"name\";s:25:\"Plugin :plugin not exits!\";s:5:\"value\";N;}s:32:\"86aabab43ca86c0fb8f61f5a8e0abfc2\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"72f14339ff02a69f691311cd54ed61fd\";a:2:{s:4:\"name\";s:15:\"Manager Plugins\";s:5:\"value\";N;}s:32:\"061bd00c0b1b030924e3ad6c1073074d\";a:2:{s:4:\"name\";s:34:\"Plugin :plugin use in :pluginUse !\";s:5:\"value\";N;}s:32:\"b87dc8b31e3b714fe68356bfa9769a36\";a:2:{s:4:\"name\";s:38:\"Plugin :plugin use in module :modUse !\";s:5:\"value\";N;}s:32:\"8108a6e213503016830b51831e938a06\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"86ccbc3cc25e6b61154c022c74d4e39d\";a:2:{s:4:\"name\";s:6:\"Source\";s:5:\"value\";N;}s:32:\"e69ea79340fe528de0cbdb828ef2bd30\";a:2:{s:4:\"name\";s:7:\"Builder\";s:5:\"value\";N;}s:32:\"8424232737e62df6692f1c5fc272798d\";a:2:{s:4:\"name\";s:5:\"Close\";s:5:\"value\";N;}s:32:\"c8e3bce21e386602ae168af717ed5732\";a:2:{s:4:\"name\";s:6:\"Search\";s:5:\"value\";N;}s:32:\"e3a4bb3f7d1b383108da57a380405640\";a:2:{s:4:\"name\";s:10:\"List Empty\";s:5:\"value\";N;}s:32:\"9c8889895070eb96c8a9cc9c101520ba\";a:2:{s:4:\"name\";s:17:\"Edit Layout :name\";s:5:\"value\";N;}s:32:\"1280be03f83aa0a0233d5773117012f7\";a:2:{s:4:\"name\";s:6:\"Module\";s:5:\"value\";N;}s:32:\"d88c7389f879372a2294d6e0339db5b5\";a:2:{s:4:\"name\";s:12:\"Error :class\";s:5:\"value\";N;}s:32:\"d24584099f4c18f1cbe630e42bd28e0e\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"091c6db51ffe68a6319dbd38de2ca191\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"91694378dca318866f2de732eaddbe1a\";a:2:{s:4:\"name\";s:6:\"Avatar\";s:5:\"value\";N;}s:32:\"3472b3cb5c6c358dfb7a3ca6815b685f\";a:2:{s:4:\"name\";s:5:\"Views\";s:5:\"value\";N;}s:32:\"62e8ea7f29a166bb4a7c5017a8383e6f\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8b790d36a6f1cac6a219fb1951ae8b0a\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";N;}s:32:\"f400ae25f8512e2fc3f6f0791e32750a\";a:2:{s:4:\"name\";s:6:\"Langer\";s:5:\"value\";N;}s:32:\"abe6e97d618f282789ebe7be47a09220\";a:2:{s:4:\"name\";s:16:\"Language Default\";s:5:\"value\";N;}s:32:\"61fb35ec4c35628bc3fc64ee8801124e\";a:2:{s:4:\"name\";s:11:\"Image width\";s:5:\"value\";N;}s:32:\"6329d41393fcb4b2dd87518bff68dc3b\";a:2:{s:4:\"name\";s:12:\"Image height\";s:5:\"value\";N;}s:32:\"a852924dd4ccacba1238f6607b955712\";a:2:{s:4:\"name\";s:10:\"Image unit\";s:5:\"value\";N;}s:32:\"dba881ddcd9e5b0131b6354d1442dae5\";a:2:{s:4:\"name\";s:14:\"Items per page\";s:5:\"value\";N;}s:32:\"4ecbf1634a3e4e1e2753a299b070d9b0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"b6bda532a7e8a7ea0a75069f35ae864f\";a:2:{s:4:\"name\";s:8:\"Username\";s:5:\"value\";N;}s:32:\"c2b0c74543d0ec15a11b2ee1d2e34643\";a:2:{s:4:\"name\";s:7:\"Members\";s:5:\"value\";N;}s:32:\"384e97614d7734eee709c4d1a545767c\";a:2:{s:4:\"name\";s:5:\"Users\";s:5:\"value\";N;}s:32:\"e55863d457dd9473186427730f3c2994\";a:2:{s:4:\"name\";s:4:\"Role\";s:5:\"value\";N;}s:32:\"2b2a4102279387bd6441bf12ad308f44\";a:2:{s:4:\"name\";s:18:\"Allow Registration\";s:5:\"value\";N;}s:32:\"4d304efd20fc00982ecae0f9aa6900c8\";a:2:{s:4:\"name\";s:11:\"Allow Login\";s:5:\"value\";N;}s:32:\"9bb729ff5c457b0a4b4793048829fbf8\";a:2:{s:4:\"name\";s:18:\"Enable Activation?\";s:5:\"value\";N;}s:32:\"d4af530e6f6f2ab3b93b2cbb1a24e2d3\";a:2:{s:4:\"name\";s:14:\"Welcome Email?\";s:5:\"value\";N;}s:32:\"b97a26bfaf6dca0b57ae02ba7596fb0c\";a:2:{s:4:\"name\";s:24:\"Username minimum length?\";s:5:\"value\";N;}s:32:\"a19616f3736fc87ce866c5574836941e\";a:2:{s:4:\"name\";s:24:\"Password minimum length?\";s:5:\"value\";N;}s:32:\"183a44098df2e5536ffff4b5fcf9f922\";a:2:{s:4:\"name\";s:13:\"Login attemps\";s:5:\"value\";N;}s:32:\"5a68577bdd46b8818f0a112c4ca9456f\";a:2:{s:4:\"name\";s:25:\"Activation link exists in\";s:5:\"value\";N;}s:32:\"e70ed0291c0813727fc7cffdde52a41e\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"89be00f9644d7e4fe24a5afccf23181a\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"253c79cc37c07c30b4854d5be5f39763\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"22e6132fff18fbfd8fa43b0d32bc1c9a\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"b628564009e1802e3c8ac78518858d70\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"f17cfd1f21ddeeb109300ade810d1408\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a4c7dc56186aaf14cb52b6ad6e320d91\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"5e9de4614577a55731770828b4aba6db\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"6b9a32f46538611d4a68a2e495a727db\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"82a53d2bd9095f91036742bd7562dd70\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"0dbb53b31dc5a2711c1cea33bf4c862d\";a:2:{s:4:\"name\";s:18:\"Manager User Admin\";s:5:\"value\";N;}s:32:\"6593eaba89ca42a748e34d9599dc0468\";a:2:{s:4:\"name\";s:38:\"Or login with your Facebook or Twitter\";s:5:\"value\";N;}s:32:\"4d618a69ad8dd5c0cc0b5dcfb6721d07\";a:2:{s:4:\"name\";s:9:\"Mega Menu\";s:5:\"value\";N;}s:32:\"526258c9809c7c9ffb2734f60f35e967\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}s:32:\"18942d163adbbaef8db2824fafd2e7e1\";a:2:{s:4:\"name\";s:4:\"Icon\";s:5:\"value\";N;}s:32:\"ca61d819d9d337f3b3c70bb88f465076\";a:2:{s:4:\"name\";s:6:\"Target\";s:5:\"value\";N;}s:32:\"73eb836c67c379681dbf39689b1642a4\";a:2:{s:4:\"name\";s:4:\"Info\";s:5:\"value\";N;}s:32:\"9e755a921f1305e48f88f5b39c01b84f\";a:2:{s:4:\"name\";s:10:\"Background\";s:5:\"value\";N;}}s:2:\"vi\";a:121:{s:32:\"7d1203376941a26e897f96b7df50483f\";a:2:{s:4:\"name\";s:23:\"No Category false , abc\";s:5:\"value\";N;}s:32:\"be013f3a6d6715a1c8d71f78afc27c85\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";s:4:\"Tên\";}s:32:\"d6ac5f29b58eb50fd1586a04ff2bc796\";a:2:{s:4:\"name\";s:4:\"Link\";s:5:\"value\";N;}s:32:\"a76476aa25bc867e1a45525b4ce543f5\";a:2:{s:4:\"name\";s:5:\"Image\";s:5:\"value\";N;}s:32:\"1ea0bad6924b73e132cac7bee38f9ad0\";a:2:{s:4:\"name\";s:6:\"System\";s:5:\"value\";s:12:\"Hệ thống\";}s:32:\"9874f35b4edf9ab4be4e3e1024939df8\";a:2:{s:4:\"name\";s:2:\"Id\";s:5:\"value\";N;}s:32:\"31497ca43f9b1639f32b90def9a41ef1\";a:2:{s:4:\"name\";s:4:\"Type\";s:5:\"value\";N;}s:32:\"e1e4805c69cb37f0402621596b17f09e\";a:2:{s:4:\"name\";s:6:\"Status\";s:5:\"value\";N;}s:32:\"9502493520055a141899a698293ba5ff\";a:2:{s:4:\"name\";s:9:\"Create At\";s:5:\"value\";N;}s:32:\"a91d2c67bb7f442079430ebdff1d1db8\";a:2:{s:4:\"name\";s:9:\"Update At\";s:5:\"value\";N;}s:32:\"6395b093377ea906b538dea341afc0fc\";a:2:{s:4:\"name\";s:4:\"Edit\";s:5:\"value\";s:5:\"Sửa\";}s:32:\"06bf2221a23ef07badcd9234dc20603c\";a:2:{s:4:\"name\";s:7:\"Preview\";s:5:\"value\";N;}s:32:\"8dfc62f2baac840aa626d35b0afad08c\";a:2:{s:4:\"name\";s:5:\"Trash\";s:5:\"value\";N;}s:32:\"bf8497f2333ced522040a34e6a266922\";a:2:{s:4:\"name\";s:6:\"Public\";s:5:\"value\";N;}s:32:\"31b41713ed7df12145c2d5538e4f964c\";a:2:{s:4:\"name\";s:8:\"UnPublic\";s:5:\"value\";N;}s:32:\"a1306620c8fc103f942d3860666b0984\";a:2:{s:4:\"name\";s:5:\"Title\";s:5:\"value\";N;}s:32:\"6491c152f7a7ec45afe8cfb872a780d8\";a:2:{s:4:\"name\";s:4:\"Home\";s:5:\"value\";s:11:\"Trang chủ\";}s:32:\"4aada3a7641e12e63d4f07ea14db3147\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:10:\"Thông kê\";}s:32:\"d222b0480a59760fe9165c7ebc203c19\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";s:11:\"Ngôn ngữ\";}s:32:\"53c4c836a4a51819222ed36cf596b601\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";s:11:\"Giao diện\";}s:32:\"2afc1ae5c1d04b5f8f42dbcb9c2d99bc\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";s:5:\"Trang\";}s:32:\"164686a8229694746f348ce78ee3ef77\";a:2:{s:4:\"name\";s:9:\"Component\";s:5:\"value\";N;}s:32:\"e41d80423fc08b05866f0d07f7b488c3\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"b08b0fcf53f434f1bbcffe83fce093d5\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"8150a15d38d7095f62428de30bb71254\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"dd6f8071a9c6f4f651bd149f03e0a078\";a:2:{s:4:\"name\";s:13:\"Configuration\";s:5:\"value\";s:11:\"Cấu hình\";}s:32:\"420d62b86ce5e7b63cad002f4bdf51f9\";a:2:{s:4:\"name\";s:9:\"Site Name\";s:5:\"value\";N;}s:32:\"a7e40fb978761ec2e404ffb3d77f4158\";a:2:{s:4:\"name\";s:4:\"Logo\";s:5:\"value\";N;}s:32:\"b92a0bf00ca22fca7d57f4f5d33e3b57\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"103ba5e1e5d4b3feed9a5223584f91fd\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";s:11:\"Thêm mới\";}s:32:\"0e0351cb9c354b2bb81dca9743451071\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";s:11:\"Cài đặt\";}s:32:\"a9a0d1899df240235c7315df67d67871\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"066923ceb0e8b19e772da586dd918aa6\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";s:11:\"Bài viết\";}s:32:\"660144cd3bfa5b0af27e4786c5f5c5ab\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"1ce40393b259e2977cb78840007e6be1\";a:2:{s:4:\"name\";s:13:\"Category List\";s:5:\"value\";N;}s:32:\"edfbf1eede6542ed7a338e75ff6aa60c\";a:2:{s:4:\"name\";s:15:\"Category Create\";s:5:\"value\";N;}s:32:\"3460106eb8ab19d14a1f7245aed17bc7\";a:2:{s:4:\"name\";s:11:\"Description\";s:5:\"value\";N;}s:32:\"0774fde7c3c87feef9f1c5c1ee9ba488\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"d4309e732c55b2cc7e3e7776e787d926\";a:2:{s:4:\"name\";s:27:\"Reset Position Successfully\";s:5:\"value\";N;}s:32:\"fb4bc1a781c0cec4e6f874db63188d92\";a:2:{s:4:\"name\";s:21:\"Category Edit : :Name\";s:5:\"value\";N;}s:32:\"d5f8439526f9f52b1847853956890991\";a:2:{s:4:\"name\";s:7:\"Confirm\";s:5:\"value\";N;}s:32:\"45fcfe8aa0abd67eb0df5ebfda161619\";a:2:{s:4:\"name\";s:33:\"Are you sure to delete this item?\";s:5:\"value\";N;}s:32:\"e5315753d89e19ce33a574ecbfe40c0e\";a:2:{s:4:\"name\";s:19:\"Error update failed\";s:5:\"value\";N;}s:32:\"275e1bcd4e8ed52847857d98c15100a2\";a:2:{s:4:\"name\";s:19:\"Update Successfully\";s:5:\"value\";N;}s:32:\"5678b21d08b6ab375a49e7e9a35933a2\";a:2:{s:4:\"name\";s:17:\"Manager Component\";s:5:\"value\";N;}s:32:\"ef2b832c480f0d7cefee57f11c99b91d\";a:2:{s:4:\"name\";s:21:\"Manager Configuration\";s:5:\"value\";N;}s:32:\"fd076f906f24905156bd7b4113e82c35\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";s:4:\"Lưu\";}s:32:\"0bf24321bc4a59f82723d2dee839e205\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"452a133e3befca4a74292bf3cdec7893\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"2c33ba01cba900cce4287ce30f92866b\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"2ee3e7d26f0124e483066ca04bcf3d39\";a:2:{s:4:\"name\";s:5:\"First\";s:5:\"value\";N;}s:32:\"586022c7c851d9e9c074f8f3cc8dcccc\";a:2:{s:4:\"name\";s:4:\"Last\";s:5:\"value\";N;}s:32:\"c0c88c792449c06be76548550a7c576b\";a:2:{s:4:\"name\";s:5:\"Build\";s:5:\"value\";N;}s:32:\"71b8645c30c6ab0f1429e411595bd8a8\";a:2:{s:4:\"name\";s:6:\"Delete\";s:5:\"value\";N;}s:32:\"e5d1e132c5f008e35d1ff73ab2507c24\";a:2:{s:4:\"name\";s:8:\"View Php\";s:5:\"value\";N;}s:32:\"4e00c6dfc98ef41c01f2534ad0cd84ce\";a:2:{s:4:\"name\";s:10:\"View Blade\";s:5:\"value\";N;}s:32:\"6a8758e140fb1efe3ba9a12d081e1b05\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"f2cbda659ed15f7011c32b875657df17\";a:2:{s:4:\"name\";s:3:\"All\";s:5:\"value\";N;}s:32:\"c019ce79e6af30304fc69e85f07cb98a\";a:2:{s:4:\"name\";s:6:\"Filter\";s:5:\"value\";N;}s:32:\"9484fabeb5e1a9f0117ef38a3df4b526\";a:2:{s:4:\"name\";s:14:\"Manager Module\";s:5:\"value\";N;}s:32:\"ed1c2a77066726f5ac1bfbe401c9ed5e\";a:2:{s:4:\"name\";s:7:\"Install\";s:5:\"value\";N;}s:32:\"080edf40b683ed4bb2fd9350750874ab\";a:2:{s:4:\"name\";s:9:\"UnInstall\";s:5:\"value\";N;}s:32:\"054939b11bbd2f583540d49e1e35abe6\";a:2:{s:4:\"name\";s:6:\"Remove\";s:5:\"value\";N;}s:32:\"0b66d27e047813f4ff4dfb1857f962e0\";a:2:{s:4:\"name\";s:27:\"Plugin :plugin not install!\";s:5:\"value\";N;}s:32:\"c365ef199e7721497ced70fa9846ad78\";a:2:{s:4:\"name\";s:25:\"Plugin :plugin not exits!\";s:5:\"value\";N;}s:32:\"86aabab43ca86c0fb8f61f5a8e0abfc2\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"72f14339ff02a69f691311cd54ed61fd\";a:2:{s:4:\"name\";s:15:\"Manager Plugins\";s:5:\"value\";N;}s:32:\"061bd00c0b1b030924e3ad6c1073074d\";a:2:{s:4:\"name\";s:34:\"Plugin :plugin use in :pluginUse !\";s:5:\"value\";N;}s:32:\"b87dc8b31e3b714fe68356bfa9769a36\";a:2:{s:4:\"name\";s:38:\"Plugin :plugin use in module :modUse !\";s:5:\"value\";N;}s:32:\"8108a6e213503016830b51831e938a06\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"86ccbc3cc25e6b61154c022c74d4e39d\";a:2:{s:4:\"name\";s:6:\"Source\";s:5:\"value\";N;}s:32:\"e69ea79340fe528de0cbdb828ef2bd30\";a:2:{s:4:\"name\";s:7:\"Builder\";s:5:\"value\";N;}s:32:\"8424232737e62df6692f1c5fc272798d\";a:2:{s:4:\"name\";s:5:\"Close\";s:5:\"value\";N;}s:32:\"c8e3bce21e386602ae168af717ed5732\";a:2:{s:4:\"name\";s:6:\"Search\";s:5:\"value\";N;}s:32:\"e3a4bb3f7d1b383108da57a380405640\";a:2:{s:4:\"name\";s:10:\"List Empty\";s:5:\"value\";N;}s:32:\"9c8889895070eb96c8a9cc9c101520ba\";a:2:{s:4:\"name\";s:17:\"Edit Layout :name\";s:5:\"value\";N;}s:32:\"1280be03f83aa0a0233d5773117012f7\";a:2:{s:4:\"name\";s:6:\"Module\";s:5:\"value\";N;}s:32:\"d88c7389f879372a2294d6e0339db5b5\";a:2:{s:4:\"name\";s:12:\"Error :class\";s:5:\"value\";N;}s:32:\"d24584099f4c18f1cbe630e42bd28e0e\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"091c6db51ffe68a6319dbd38de2ca191\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"91694378dca318866f2de732eaddbe1a\";a:2:{s:4:\"name\";s:6:\"Avatar\";s:5:\"value\";N;}s:32:\"3472b3cb5c6c358dfb7a3ca6815b685f\";a:2:{s:4:\"name\";s:5:\"Views\";s:5:\"value\";N;}s:32:\"62e8ea7f29a166bb4a7c5017a8383e6f\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8b790d36a6f1cac6a219fb1951ae8b0a\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";s:12:\"Bình luận\";}s:32:\"f400ae25f8512e2fc3f6f0791e32750a\";a:2:{s:4:\"name\";s:6:\"Langer\";s:5:\"value\";N;}s:32:\"abe6e97d618f282789ebe7be47a09220\";a:2:{s:4:\"name\";s:16:\"Language Default\";s:5:\"value\";N;}s:32:\"61fb35ec4c35628bc3fc64ee8801124e\";a:2:{s:4:\"name\";s:11:\"Image width\";s:5:\"value\";N;}s:32:\"6329d41393fcb4b2dd87518bff68dc3b\";a:2:{s:4:\"name\";s:12:\"Image height\";s:5:\"value\";N;}s:32:\"a852924dd4ccacba1238f6607b955712\";a:2:{s:4:\"name\";s:10:\"Image unit\";s:5:\"value\";N;}s:32:\"dba881ddcd9e5b0131b6354d1442dae5\";a:2:{s:4:\"name\";s:14:\"Items per page\";s:5:\"value\";N;}s:32:\"4ecbf1634a3e4e1e2753a299b070d9b0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"b6bda532a7e8a7ea0a75069f35ae864f\";a:2:{s:4:\"name\";s:8:\"Username\";s:5:\"value\";N;}s:32:\"c2b0c74543d0ec15a11b2ee1d2e34643\";a:2:{s:4:\"name\";s:7:\"Members\";s:5:\"value\";s:12:\"Tài khoản\";}s:32:\"384e97614d7734eee709c4d1a545767c\";a:2:{s:4:\"name\";s:5:\"Users\";s:5:\"value\";s:18:\"Quản trị viên\";}s:32:\"e55863d457dd9473186427730f3c2994\";a:2:{s:4:\"name\";s:4:\"Role\";s:5:\"value\";s:23:\"Nhóm và phân quyền\";}s:32:\"2b2a4102279387bd6441bf12ad308f44\";a:2:{s:4:\"name\";s:18:\"Allow Registration\";s:5:\"value\";N;}s:32:\"4d304efd20fc00982ecae0f9aa6900c8\";a:2:{s:4:\"name\";s:11:\"Allow Login\";s:5:\"value\";N;}s:32:\"9bb729ff5c457b0a4b4793048829fbf8\";a:2:{s:4:\"name\";s:18:\"Enable Activation?\";s:5:\"value\";N;}s:32:\"d4af530e6f6f2ab3b93b2cbb1a24e2d3\";a:2:{s:4:\"name\";s:14:\"Welcome Email?\";s:5:\"value\";N;}s:32:\"b97a26bfaf6dca0b57ae02ba7596fb0c\";a:2:{s:4:\"name\";s:24:\"Username minimum length?\";s:5:\"value\";N;}s:32:\"a19616f3736fc87ce866c5574836941e\";a:2:{s:4:\"name\";s:24:\"Password minimum length?\";s:5:\"value\";N;}s:32:\"183a44098df2e5536ffff4b5fcf9f922\";a:2:{s:4:\"name\";s:13:\"Login attemps\";s:5:\"value\";N;}s:32:\"5a68577bdd46b8818f0a112c4ca9456f\";a:2:{s:4:\"name\";s:25:\"Activation link exists in\";s:5:\"value\";N;}s:32:\"e70ed0291c0813727fc7cffdde52a41e\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";s:13:\"Đăng nhập\";}s:32:\"89be00f9644d7e4fe24a5afccf23181a\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"253c79cc37c07c30b4854d5be5f39763\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"22e6132fff18fbfd8fa43b0d32bc1c9a\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"b628564009e1802e3c8ac78518858d70\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"f17cfd1f21ddeeb109300ade810d1408\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a4c7dc56186aaf14cb52b6ad6e320d91\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"5e9de4614577a55731770828b4aba6db\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"6b9a32f46538611d4a68a2e495a727db\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"82a53d2bd9095f91036742bd7562dd70\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"0dbb53b31dc5a2711c1cea33bf4c862d\";a:2:{s:4:\"name\";s:18:\"Manager User Admin\";s:5:\"value\";N;}s:32:\"6593eaba89ca42a748e34d9599dc0468\";a:2:{s:4:\"name\";s:38:\"Or login with your Facebook or Twitter\";s:5:\"value\";s:63:\"Hoặc đăng nhập bằng Facebook hoặc Twitter của bạn\";}s:32:\"4d618a69ad8dd5c0cc0b5dcfb6721d07\";a:2:{s:4:\"name\";s:9:\"Mega Menu\";s:5:\"value\";N;}s:32:\"526258c9809c7c9ffb2734f60f35e967\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}s:32:\"18942d163adbbaef8db2824fafd2e7e1\";a:2:{s:4:\"name\";s:4:\"Icon\";s:5:\"value\";N;}s:32:\"ca61d819d9d337f3b3c70bb88f465076\";a:2:{s:4:\"name\";s:6:\"Target\";s:5:\"value\";N;}s:32:\"73eb836c67c379681dbf39689b1642a4\";a:2:{s:4:\"name\";s:4:\"Info\";s:5:\"value\";N;}s:32:\"9e755a921f1305e48f88f5b39c01b84f\";a:2:{s:4:\"name\";s:10:\"Background\";s:5:\"value\";N;}}s:2:\"ja\";a:121:{s:32:\"7d1203376941a26e897f96b7df50483f\";a:2:{s:4:\"name\";s:23:\"No Category false , abc\";s:5:\"value\";N;}s:32:\"be013f3a6d6715a1c8d71f78afc27c85\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"d6ac5f29b58eb50fd1586a04ff2bc796\";a:2:{s:4:\"name\";s:4:\"Link\";s:5:\"value\";N;}s:32:\"a76476aa25bc867e1a45525b4ce543f5\";a:2:{s:4:\"name\";s:5:\"Image\";s:5:\"value\";N;}s:32:\"1ea0bad6924b73e132cac7bee38f9ad0\";a:2:{s:4:\"name\";s:6:\"System\";s:5:\"value\";N;}s:32:\"9874f35b4edf9ab4be4e3e1024939df8\";a:2:{s:4:\"name\";s:2:\"Id\";s:5:\"value\";N;}s:32:\"31497ca43f9b1639f32b90def9a41ef1\";a:2:{s:4:\"name\";s:4:\"Type\";s:5:\"value\";N;}s:32:\"e1e4805c69cb37f0402621596b17f09e\";a:2:{s:4:\"name\";s:6:\"Status\";s:5:\"value\";N;}s:32:\"9502493520055a141899a698293ba5ff\";a:2:{s:4:\"name\";s:9:\"Create At\";s:5:\"value\";N;}s:32:\"a91d2c67bb7f442079430ebdff1d1db8\";a:2:{s:4:\"name\";s:9:\"Update At\";s:5:\"value\";N;}s:32:\"6395b093377ea906b538dea341afc0fc\";a:2:{s:4:\"name\";s:4:\"Edit\";s:5:\"value\";N;}s:32:\"06bf2221a23ef07badcd9234dc20603c\";a:2:{s:4:\"name\";s:7:\"Preview\";s:5:\"value\";N;}s:32:\"8dfc62f2baac840aa626d35b0afad08c\";a:2:{s:4:\"name\";s:5:\"Trash\";s:5:\"value\";N;}s:32:\"bf8497f2333ced522040a34e6a266922\";a:2:{s:4:\"name\";s:6:\"Public\";s:5:\"value\";N;}s:32:\"31b41713ed7df12145c2d5538e4f964c\";a:2:{s:4:\"name\";s:8:\"UnPublic\";s:5:\"value\";N;}s:32:\"a1306620c8fc103f942d3860666b0984\";a:2:{s:4:\"name\";s:5:\"Title\";s:5:\"value\";N;}s:32:\"6491c152f7a7ec45afe8cfb872a780d8\";a:2:{s:4:\"name\";s:4:\"Home\";s:5:\"value\";N;}s:32:\"4aada3a7641e12e63d4f07ea14db3147\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";N;}s:32:\"d222b0480a59760fe9165c7ebc203c19\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"53c4c836a4a51819222ed36cf596b601\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"2afc1ae5c1d04b5f8f42dbcb9c2d99bc\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";N;}s:32:\"164686a8229694746f348ce78ee3ef77\";a:2:{s:4:\"name\";s:9:\"Component\";s:5:\"value\";N;}s:32:\"e41d80423fc08b05866f0d07f7b488c3\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"b08b0fcf53f434f1bbcffe83fce093d5\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"8150a15d38d7095f62428de30bb71254\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"dd6f8071a9c6f4f651bd149f03e0a078\";a:2:{s:4:\"name\";s:13:\"Configuration\";s:5:\"value\";N;}s:32:\"420d62b86ce5e7b63cad002f4bdf51f9\";a:2:{s:4:\"name\";s:9:\"Site Name\";s:5:\"value\";N;}s:32:\"a7e40fb978761ec2e404ffb3d77f4158\";a:2:{s:4:\"name\";s:4:\"Logo\";s:5:\"value\";N;}s:32:\"b92a0bf00ca22fca7d57f4f5d33e3b57\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"103ba5e1e5d4b3feed9a5223584f91fd\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"0e0351cb9c354b2bb81dca9743451071\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";N;}s:32:\"a9a0d1899df240235c7315df67d67871\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"066923ceb0e8b19e772da586dd918aa6\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";N;}s:32:\"660144cd3bfa5b0af27e4786c5f5c5ab\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"1ce40393b259e2977cb78840007e6be1\";a:2:{s:4:\"name\";s:13:\"Category List\";s:5:\"value\";N;}s:32:\"edfbf1eede6542ed7a338e75ff6aa60c\";a:2:{s:4:\"name\";s:15:\"Category Create\";s:5:\"value\";N;}s:32:\"3460106eb8ab19d14a1f7245aed17bc7\";a:2:{s:4:\"name\";s:11:\"Description\";s:5:\"value\";N;}s:32:\"0774fde7c3c87feef9f1c5c1ee9ba488\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"d4309e732c55b2cc7e3e7776e787d926\";a:2:{s:4:\"name\";s:27:\"Reset Position Successfully\";s:5:\"value\";N;}s:32:\"fb4bc1a781c0cec4e6f874db63188d92\";a:2:{s:4:\"name\";s:21:\"Category Edit : :Name\";s:5:\"value\";N;}s:32:\"d5f8439526f9f52b1847853956890991\";a:2:{s:4:\"name\";s:7:\"Confirm\";s:5:\"value\";N;}s:32:\"45fcfe8aa0abd67eb0df5ebfda161619\";a:2:{s:4:\"name\";s:33:\"Are you sure to delete this item?\";s:5:\"value\";N;}s:32:\"e5315753d89e19ce33a574ecbfe40c0e\";a:2:{s:4:\"name\";s:19:\"Error update failed\";s:5:\"value\";N;}s:32:\"275e1bcd4e8ed52847857d98c15100a2\";a:2:{s:4:\"name\";s:19:\"Update Successfully\";s:5:\"value\";N;}s:32:\"5678b21d08b6ab375a49e7e9a35933a2\";a:2:{s:4:\"name\";s:17:\"Manager Component\";s:5:\"value\";N;}s:32:\"ef2b832c480f0d7cefee57f11c99b91d\";a:2:{s:4:\"name\";s:21:\"Manager Configuration\";s:5:\"value\";N;}s:32:\"fd076f906f24905156bd7b4113e82c35\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"0bf24321bc4a59f82723d2dee839e205\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"452a133e3befca4a74292bf3cdec7893\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"2c33ba01cba900cce4287ce30f92866b\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"2ee3e7d26f0124e483066ca04bcf3d39\";a:2:{s:4:\"name\";s:5:\"First\";s:5:\"value\";N;}s:32:\"586022c7c851d9e9c074f8f3cc8dcccc\";a:2:{s:4:\"name\";s:4:\"Last\";s:5:\"value\";N;}s:32:\"c0c88c792449c06be76548550a7c576b\";a:2:{s:4:\"name\";s:5:\"Build\";s:5:\"value\";N;}s:32:\"71b8645c30c6ab0f1429e411595bd8a8\";a:2:{s:4:\"name\";s:6:\"Delete\";s:5:\"value\";N;}s:32:\"e5d1e132c5f008e35d1ff73ab2507c24\";a:2:{s:4:\"name\";s:8:\"View Php\";s:5:\"value\";N;}s:32:\"4e00c6dfc98ef41c01f2534ad0cd84ce\";a:2:{s:4:\"name\";s:10:\"View Blade\";s:5:\"value\";N;}s:32:\"6a8758e140fb1efe3ba9a12d081e1b05\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"f2cbda659ed15f7011c32b875657df17\";a:2:{s:4:\"name\";s:3:\"All\";s:5:\"value\";N;}s:32:\"c019ce79e6af30304fc69e85f07cb98a\";a:2:{s:4:\"name\";s:6:\"Filter\";s:5:\"value\";N;}s:32:\"9484fabeb5e1a9f0117ef38a3df4b526\";a:2:{s:4:\"name\";s:14:\"Manager Module\";s:5:\"value\";N;}s:32:\"ed1c2a77066726f5ac1bfbe401c9ed5e\";a:2:{s:4:\"name\";s:7:\"Install\";s:5:\"value\";N;}s:32:\"080edf40b683ed4bb2fd9350750874ab\";a:2:{s:4:\"name\";s:9:\"UnInstall\";s:5:\"value\";N;}s:32:\"054939b11bbd2f583540d49e1e35abe6\";a:2:{s:4:\"name\";s:6:\"Remove\";s:5:\"value\";N;}s:32:\"0b66d27e047813f4ff4dfb1857f962e0\";a:2:{s:4:\"name\";s:27:\"Plugin :plugin not install!\";s:5:\"value\";N;}s:32:\"c365ef199e7721497ced70fa9846ad78\";a:2:{s:4:\"name\";s:25:\"Plugin :plugin not exits!\";s:5:\"value\";N;}s:32:\"86aabab43ca86c0fb8f61f5a8e0abfc2\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"72f14339ff02a69f691311cd54ed61fd\";a:2:{s:4:\"name\";s:15:\"Manager Plugins\";s:5:\"value\";N;}s:32:\"061bd00c0b1b030924e3ad6c1073074d\";a:2:{s:4:\"name\";s:34:\"Plugin :plugin use in :pluginUse !\";s:5:\"value\";N;}s:32:\"b87dc8b31e3b714fe68356bfa9769a36\";a:2:{s:4:\"name\";s:38:\"Plugin :plugin use in module :modUse !\";s:5:\"value\";N;}s:32:\"8108a6e213503016830b51831e938a06\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"86ccbc3cc25e6b61154c022c74d4e39d\";a:2:{s:4:\"name\";s:6:\"Source\";s:5:\"value\";N;}s:32:\"e69ea79340fe528de0cbdb828ef2bd30\";a:2:{s:4:\"name\";s:7:\"Builder\";s:5:\"value\";N;}s:32:\"8424232737e62df6692f1c5fc272798d\";a:2:{s:4:\"name\";s:5:\"Close\";s:5:\"value\";N;}s:32:\"c8e3bce21e386602ae168af717ed5732\";a:2:{s:4:\"name\";s:6:\"Search\";s:5:\"value\";N;}s:32:\"e3a4bb3f7d1b383108da57a380405640\";a:2:{s:4:\"name\";s:10:\"List Empty\";s:5:\"value\";N;}s:32:\"9c8889895070eb96c8a9cc9c101520ba\";a:2:{s:4:\"name\";s:17:\"Edit Layout :name\";s:5:\"value\";N;}s:32:\"1280be03f83aa0a0233d5773117012f7\";a:2:{s:4:\"name\";s:6:\"Module\";s:5:\"value\";N;}s:32:\"d88c7389f879372a2294d6e0339db5b5\";a:2:{s:4:\"name\";s:12:\"Error :class\";s:5:\"value\";N;}s:32:\"d24584099f4c18f1cbe630e42bd28e0e\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"091c6db51ffe68a6319dbd38de2ca191\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"91694378dca318866f2de732eaddbe1a\";a:2:{s:4:\"name\";s:6:\"Avatar\";s:5:\"value\";N;}s:32:\"3472b3cb5c6c358dfb7a3ca6815b685f\";a:2:{s:4:\"name\";s:5:\"Views\";s:5:\"value\";N;}s:32:\"62e8ea7f29a166bb4a7c5017a8383e6f\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8b790d36a6f1cac6a219fb1951ae8b0a\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";N;}s:32:\"f400ae25f8512e2fc3f6f0791e32750a\";a:2:{s:4:\"name\";s:6:\"Langer\";s:5:\"value\";N;}s:32:\"abe6e97d618f282789ebe7be47a09220\";a:2:{s:4:\"name\";s:16:\"Language Default\";s:5:\"value\";N;}s:32:\"61fb35ec4c35628bc3fc64ee8801124e\";a:2:{s:4:\"name\";s:11:\"Image width\";s:5:\"value\";N;}s:32:\"6329d41393fcb4b2dd87518bff68dc3b\";a:2:{s:4:\"name\";s:12:\"Image height\";s:5:\"value\";N;}s:32:\"a852924dd4ccacba1238f6607b955712\";a:2:{s:4:\"name\";s:10:\"Image unit\";s:5:\"value\";N;}s:32:\"dba881ddcd9e5b0131b6354d1442dae5\";a:2:{s:4:\"name\";s:14:\"Items per page\";s:5:\"value\";N;}s:32:\"4ecbf1634a3e4e1e2753a299b070d9b0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"b6bda532a7e8a7ea0a75069f35ae864f\";a:2:{s:4:\"name\";s:8:\"Username\";s:5:\"value\";N;}s:32:\"c2b0c74543d0ec15a11b2ee1d2e34643\";a:2:{s:4:\"name\";s:7:\"Members\";s:5:\"value\";N;}s:32:\"384e97614d7734eee709c4d1a545767c\";a:2:{s:4:\"name\";s:5:\"Users\";s:5:\"value\";N;}s:32:\"e55863d457dd9473186427730f3c2994\";a:2:{s:4:\"name\";s:4:\"Role\";s:5:\"value\";N;}s:32:\"2b2a4102279387bd6441bf12ad308f44\";a:2:{s:4:\"name\";s:18:\"Allow Registration\";s:5:\"value\";N;}s:32:\"4d304efd20fc00982ecae0f9aa6900c8\";a:2:{s:4:\"name\";s:11:\"Allow Login\";s:5:\"value\";N;}s:32:\"9bb729ff5c457b0a4b4793048829fbf8\";a:2:{s:4:\"name\";s:18:\"Enable Activation?\";s:5:\"value\";N;}s:32:\"d4af530e6f6f2ab3b93b2cbb1a24e2d3\";a:2:{s:4:\"name\";s:14:\"Welcome Email?\";s:5:\"value\";N;}s:32:\"b97a26bfaf6dca0b57ae02ba7596fb0c\";a:2:{s:4:\"name\";s:24:\"Username minimum length?\";s:5:\"value\";N;}s:32:\"a19616f3736fc87ce866c5574836941e\";a:2:{s:4:\"name\";s:24:\"Password minimum length?\";s:5:\"value\";N;}s:32:\"183a44098df2e5536ffff4b5fcf9f922\";a:2:{s:4:\"name\";s:13:\"Login attemps\";s:5:\"value\";N;}s:32:\"5a68577bdd46b8818f0a112c4ca9456f\";a:2:{s:4:\"name\";s:25:\"Activation link exists in\";s:5:\"value\";N;}s:32:\"e70ed0291c0813727fc7cffdde52a41e\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"89be00f9644d7e4fe24a5afccf23181a\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"253c79cc37c07c30b4854d5be5f39763\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"22e6132fff18fbfd8fa43b0d32bc1c9a\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"b628564009e1802e3c8ac78518858d70\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"f17cfd1f21ddeeb109300ade810d1408\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a4c7dc56186aaf14cb52b6ad6e320d91\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"5e9de4614577a55731770828b4aba6db\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"6b9a32f46538611d4a68a2e495a727db\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"82a53d2bd9095f91036742bd7562dd70\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"0dbb53b31dc5a2711c1cea33bf4c862d\";a:2:{s:4:\"name\";s:18:\"Manager User Admin\";s:5:\"value\";N;}s:32:\"6593eaba89ca42a748e34d9599dc0468\";a:2:{s:4:\"name\";s:38:\"Or login with your Facebook or Twitter\";s:5:\"value\";N;}s:32:\"4d618a69ad8dd5c0cc0b5dcfb6721d07\";a:2:{s:4:\"name\";s:9:\"Mega Menu\";s:5:\"value\";N;}s:32:\"526258c9809c7c9ffb2734f60f35e967\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}s:32:\"18942d163adbbaef8db2824fafd2e7e1\";a:2:{s:4:\"name\";s:4:\"Icon\";s:5:\"value\";N;}s:32:\"ca61d819d9d337f3b3c70bb88f465076\";a:2:{s:4:\"name\";s:6:\"Target\";s:5:\"value\";N;}s:32:\"73eb836c67c379681dbf39689b1642a4\";a:2:{s:4:\"name\";s:4:\"Info\";s:5:\"value\";N;}s:32:\"9e755a921f1305e48f88f5b39c01b84f\";a:2:{s:4:\"name\";s:10:\"Background\";s:5:\"value\";N;}}s:5:\"zh-cn\";a:121:{s:32:\"7d1203376941a26e897f96b7df50483f\";a:2:{s:4:\"name\";s:23:\"No Category false , abc\";s:5:\"value\";N;}s:32:\"be013f3a6d6715a1c8d71f78afc27c85\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"d6ac5f29b58eb50fd1586a04ff2bc796\";a:2:{s:4:\"name\";s:4:\"Link\";s:5:\"value\";N;}s:32:\"a76476aa25bc867e1a45525b4ce543f5\";a:2:{s:4:\"name\";s:5:\"Image\";s:5:\"value\";N;}s:32:\"1ea0bad6924b73e132cac7bee38f9ad0\";a:2:{s:4:\"name\";s:6:\"System\";s:5:\"value\";N;}s:32:\"9874f35b4edf9ab4be4e3e1024939df8\";a:2:{s:4:\"name\";s:2:\"Id\";s:5:\"value\";N;}s:32:\"31497ca43f9b1639f32b90def9a41ef1\";a:2:{s:4:\"name\";s:4:\"Type\";s:5:\"value\";N;}s:32:\"e1e4805c69cb37f0402621596b17f09e\";a:2:{s:4:\"name\";s:6:\"Status\";s:5:\"value\";N;}s:32:\"9502493520055a141899a698293ba5ff\";a:2:{s:4:\"name\";s:9:\"Create At\";s:5:\"value\";N;}s:32:\"a91d2c67bb7f442079430ebdff1d1db8\";a:2:{s:4:\"name\";s:9:\"Update At\";s:5:\"value\";N;}s:32:\"6395b093377ea906b538dea341afc0fc\";a:2:{s:4:\"name\";s:4:\"Edit\";s:5:\"value\";N;}s:32:\"06bf2221a23ef07badcd9234dc20603c\";a:2:{s:4:\"name\";s:7:\"Preview\";s:5:\"value\";N;}s:32:\"8dfc62f2baac840aa626d35b0afad08c\";a:2:{s:4:\"name\";s:5:\"Trash\";s:5:\"value\";N;}s:32:\"bf8497f2333ced522040a34e6a266922\";a:2:{s:4:\"name\";s:6:\"Public\";s:5:\"value\";N;}s:32:\"31b41713ed7df12145c2d5538e4f964c\";a:2:{s:4:\"name\";s:8:\"UnPublic\";s:5:\"value\";N;}s:32:\"a1306620c8fc103f942d3860666b0984\";a:2:{s:4:\"name\";s:5:\"Title\";s:5:\"value\";N;}s:32:\"6491c152f7a7ec45afe8cfb872a780d8\";a:2:{s:4:\"name\";s:4:\"Home\";s:5:\"value\";N;}s:32:\"4aada3a7641e12e63d4f07ea14db3147\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";N;}s:32:\"d222b0480a59760fe9165c7ebc203c19\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"53c4c836a4a51819222ed36cf596b601\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"2afc1ae5c1d04b5f8f42dbcb9c2d99bc\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";N;}s:32:\"164686a8229694746f348ce78ee3ef77\";a:2:{s:4:\"name\";s:9:\"Component\";s:5:\"value\";N;}s:32:\"e41d80423fc08b05866f0d07f7b488c3\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"b08b0fcf53f434f1bbcffe83fce093d5\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"8150a15d38d7095f62428de30bb71254\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"dd6f8071a9c6f4f651bd149f03e0a078\";a:2:{s:4:\"name\";s:13:\"Configuration\";s:5:\"value\";N;}s:32:\"420d62b86ce5e7b63cad002f4bdf51f9\";a:2:{s:4:\"name\";s:9:\"Site Name\";s:5:\"value\";N;}s:32:\"a7e40fb978761ec2e404ffb3d77f4158\";a:2:{s:4:\"name\";s:4:\"Logo\";s:5:\"value\";N;}s:32:\"b92a0bf00ca22fca7d57f4f5d33e3b57\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"103ba5e1e5d4b3feed9a5223584f91fd\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"0e0351cb9c354b2bb81dca9743451071\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";N;}s:32:\"a9a0d1899df240235c7315df67d67871\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"066923ceb0e8b19e772da586dd918aa6\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";N;}s:32:\"660144cd3bfa5b0af27e4786c5f5c5ab\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"1ce40393b259e2977cb78840007e6be1\";a:2:{s:4:\"name\";s:13:\"Category List\";s:5:\"value\";N;}s:32:\"edfbf1eede6542ed7a338e75ff6aa60c\";a:2:{s:4:\"name\";s:15:\"Category Create\";s:5:\"value\";N;}s:32:\"3460106eb8ab19d14a1f7245aed17bc7\";a:2:{s:4:\"name\";s:11:\"Description\";s:5:\"value\";N;}s:32:\"0774fde7c3c87feef9f1c5c1ee9ba488\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"d4309e732c55b2cc7e3e7776e787d926\";a:2:{s:4:\"name\";s:27:\"Reset Position Successfully\";s:5:\"value\";N;}s:32:\"fb4bc1a781c0cec4e6f874db63188d92\";a:2:{s:4:\"name\";s:21:\"Category Edit : :Name\";s:5:\"value\";N;}s:32:\"d5f8439526f9f52b1847853956890991\";a:2:{s:4:\"name\";s:7:\"Confirm\";s:5:\"value\";N;}s:32:\"45fcfe8aa0abd67eb0df5ebfda161619\";a:2:{s:4:\"name\";s:33:\"Are you sure to delete this item?\";s:5:\"value\";N;}s:32:\"e5315753d89e19ce33a574ecbfe40c0e\";a:2:{s:4:\"name\";s:19:\"Error update failed\";s:5:\"value\";N;}s:32:\"275e1bcd4e8ed52847857d98c15100a2\";a:2:{s:4:\"name\";s:19:\"Update Successfully\";s:5:\"value\";N;}s:32:\"5678b21d08b6ab375a49e7e9a35933a2\";a:2:{s:4:\"name\";s:17:\"Manager Component\";s:5:\"value\";N;}s:32:\"ef2b832c480f0d7cefee57f11c99b91d\";a:2:{s:4:\"name\";s:21:\"Manager Configuration\";s:5:\"value\";N;}s:32:\"fd076f906f24905156bd7b4113e82c35\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"0bf24321bc4a59f82723d2dee839e205\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"452a133e3befca4a74292bf3cdec7893\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"2c33ba01cba900cce4287ce30f92866b\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"2ee3e7d26f0124e483066ca04bcf3d39\";a:2:{s:4:\"name\";s:5:\"First\";s:5:\"value\";N;}s:32:\"586022c7c851d9e9c074f8f3cc8dcccc\";a:2:{s:4:\"name\";s:4:\"Last\";s:5:\"value\";N;}s:32:\"c0c88c792449c06be76548550a7c576b\";a:2:{s:4:\"name\";s:5:\"Build\";s:5:\"value\";N;}s:32:\"71b8645c30c6ab0f1429e411595bd8a8\";a:2:{s:4:\"name\";s:6:\"Delete\";s:5:\"value\";N;}s:32:\"e5d1e132c5f008e35d1ff73ab2507c24\";a:2:{s:4:\"name\";s:8:\"View Php\";s:5:\"value\";N;}s:32:\"4e00c6dfc98ef41c01f2534ad0cd84ce\";a:2:{s:4:\"name\";s:10:\"View Blade\";s:5:\"value\";N;}s:32:\"6a8758e140fb1efe3ba9a12d081e1b05\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"f2cbda659ed15f7011c32b875657df17\";a:2:{s:4:\"name\";s:3:\"All\";s:5:\"value\";N;}s:32:\"c019ce79e6af30304fc69e85f07cb98a\";a:2:{s:4:\"name\";s:6:\"Filter\";s:5:\"value\";N;}s:32:\"9484fabeb5e1a9f0117ef38a3df4b526\";a:2:{s:4:\"name\";s:14:\"Manager Module\";s:5:\"value\";N;}s:32:\"ed1c2a77066726f5ac1bfbe401c9ed5e\";a:2:{s:4:\"name\";s:7:\"Install\";s:5:\"value\";N;}s:32:\"080edf40b683ed4bb2fd9350750874ab\";a:2:{s:4:\"name\";s:9:\"UnInstall\";s:5:\"value\";N;}s:32:\"054939b11bbd2f583540d49e1e35abe6\";a:2:{s:4:\"name\";s:6:\"Remove\";s:5:\"value\";N;}s:32:\"0b66d27e047813f4ff4dfb1857f962e0\";a:2:{s:4:\"name\";s:27:\"Plugin :plugin not install!\";s:5:\"value\";N;}s:32:\"c365ef199e7721497ced70fa9846ad78\";a:2:{s:4:\"name\";s:25:\"Plugin :plugin not exits!\";s:5:\"value\";N;}s:32:\"86aabab43ca86c0fb8f61f5a8e0abfc2\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"72f14339ff02a69f691311cd54ed61fd\";a:2:{s:4:\"name\";s:15:\"Manager Plugins\";s:5:\"value\";N;}s:32:\"061bd00c0b1b030924e3ad6c1073074d\";a:2:{s:4:\"name\";s:34:\"Plugin :plugin use in :pluginUse !\";s:5:\"value\";N;}s:32:\"b87dc8b31e3b714fe68356bfa9769a36\";a:2:{s:4:\"name\";s:38:\"Plugin :plugin use in module :modUse !\";s:5:\"value\";N;}s:32:\"8108a6e213503016830b51831e938a06\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"86ccbc3cc25e6b61154c022c74d4e39d\";a:2:{s:4:\"name\";s:6:\"Source\";s:5:\"value\";N;}s:32:\"e69ea79340fe528de0cbdb828ef2bd30\";a:2:{s:4:\"name\";s:7:\"Builder\";s:5:\"value\";N;}s:32:\"8424232737e62df6692f1c5fc272798d\";a:2:{s:4:\"name\";s:5:\"Close\";s:5:\"value\";N;}s:32:\"c8e3bce21e386602ae168af717ed5732\";a:2:{s:4:\"name\";s:6:\"Search\";s:5:\"value\";N;}s:32:\"e3a4bb3f7d1b383108da57a380405640\";a:2:{s:4:\"name\";s:10:\"List Empty\";s:5:\"value\";N;}s:32:\"9c8889895070eb96c8a9cc9c101520ba\";a:2:{s:4:\"name\";s:17:\"Edit Layout :name\";s:5:\"value\";N;}s:32:\"1280be03f83aa0a0233d5773117012f7\";a:2:{s:4:\"name\";s:6:\"Module\";s:5:\"value\";N;}s:32:\"d88c7389f879372a2294d6e0339db5b5\";a:2:{s:4:\"name\";s:12:\"Error :class\";s:5:\"value\";N;}s:32:\"d24584099f4c18f1cbe630e42bd28e0e\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"091c6db51ffe68a6319dbd38de2ca191\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"91694378dca318866f2de732eaddbe1a\";a:2:{s:4:\"name\";s:6:\"Avatar\";s:5:\"value\";N;}s:32:\"3472b3cb5c6c358dfb7a3ca6815b685f\";a:2:{s:4:\"name\";s:5:\"Views\";s:5:\"value\";N;}s:32:\"62e8ea7f29a166bb4a7c5017a8383e6f\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8b790d36a6f1cac6a219fb1951ae8b0a\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";N;}s:32:\"f400ae25f8512e2fc3f6f0791e32750a\";a:2:{s:4:\"name\";s:6:\"Langer\";s:5:\"value\";N;}s:32:\"abe6e97d618f282789ebe7be47a09220\";a:2:{s:4:\"name\";s:16:\"Language Default\";s:5:\"value\";N;}s:32:\"61fb35ec4c35628bc3fc64ee8801124e\";a:2:{s:4:\"name\";s:11:\"Image width\";s:5:\"value\";N;}s:32:\"6329d41393fcb4b2dd87518bff68dc3b\";a:2:{s:4:\"name\";s:12:\"Image height\";s:5:\"value\";N;}s:32:\"a852924dd4ccacba1238f6607b955712\";a:2:{s:4:\"name\";s:10:\"Image unit\";s:5:\"value\";N;}s:32:\"dba881ddcd9e5b0131b6354d1442dae5\";a:2:{s:4:\"name\";s:14:\"Items per page\";s:5:\"value\";N;}s:32:\"4ecbf1634a3e4e1e2753a299b070d9b0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"b6bda532a7e8a7ea0a75069f35ae864f\";a:2:{s:4:\"name\";s:8:\"Username\";s:5:\"value\";N;}s:32:\"c2b0c74543d0ec15a11b2ee1d2e34643\";a:2:{s:4:\"name\";s:7:\"Members\";s:5:\"value\";N;}s:32:\"384e97614d7734eee709c4d1a545767c\";a:2:{s:4:\"name\";s:5:\"Users\";s:5:\"value\";N;}s:32:\"e55863d457dd9473186427730f3c2994\";a:2:{s:4:\"name\";s:4:\"Role\";s:5:\"value\";N;}s:32:\"2b2a4102279387bd6441bf12ad308f44\";a:2:{s:4:\"name\";s:18:\"Allow Registration\";s:5:\"value\";N;}s:32:\"4d304efd20fc00982ecae0f9aa6900c8\";a:2:{s:4:\"name\";s:11:\"Allow Login\";s:5:\"value\";N;}s:32:\"9bb729ff5c457b0a4b4793048829fbf8\";a:2:{s:4:\"name\";s:18:\"Enable Activation?\";s:5:\"value\";N;}s:32:\"d4af530e6f6f2ab3b93b2cbb1a24e2d3\";a:2:{s:4:\"name\";s:14:\"Welcome Email?\";s:5:\"value\";N;}s:32:\"b97a26bfaf6dca0b57ae02ba7596fb0c\";a:2:{s:4:\"name\";s:24:\"Username minimum length?\";s:5:\"value\";N;}s:32:\"a19616f3736fc87ce866c5574836941e\";a:2:{s:4:\"name\";s:24:\"Password minimum length?\";s:5:\"value\";N;}s:32:\"183a44098df2e5536ffff4b5fcf9f922\";a:2:{s:4:\"name\";s:13:\"Login attemps\";s:5:\"value\";N;}s:32:\"5a68577bdd46b8818f0a112c4ca9456f\";a:2:{s:4:\"name\";s:25:\"Activation link exists in\";s:5:\"value\";N;}s:32:\"e70ed0291c0813727fc7cffdde52a41e\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"89be00f9644d7e4fe24a5afccf23181a\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"253c79cc37c07c30b4854d5be5f39763\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"22e6132fff18fbfd8fa43b0d32bc1c9a\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"b628564009e1802e3c8ac78518858d70\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"f17cfd1f21ddeeb109300ade810d1408\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a4c7dc56186aaf14cb52b6ad6e320d91\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"5e9de4614577a55731770828b4aba6db\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"6b9a32f46538611d4a68a2e495a727db\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"82a53d2bd9095f91036742bd7562dd70\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"0dbb53b31dc5a2711c1cea33bf4c862d\";a:2:{s:4:\"name\";s:18:\"Manager User Admin\";s:5:\"value\";N;}s:32:\"6593eaba89ca42a748e34d9599dc0468\";a:2:{s:4:\"name\";s:38:\"Or login with your Facebook or Twitter\";s:5:\"value\";N;}s:32:\"4d618a69ad8dd5c0cc0b5dcfb6721d07\";a:2:{s:4:\"name\";s:9:\"Mega Menu\";s:5:\"value\";N;}s:32:\"526258c9809c7c9ffb2734f60f35e967\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}s:32:\"18942d163adbbaef8db2824fafd2e7e1\";a:2:{s:4:\"name\";s:4:\"Icon\";s:5:\"value\";N;}s:32:\"ca61d819d9d337f3b3c70bb88f465076\";a:2:{s:4:\"name\";s:6:\"Target\";s:5:\"value\";N;}s:32:\"73eb836c67c379681dbf39689b1642a4\";a:2:{s:4:\"name\";s:4:\"Info\";s:5:\"value\";N;}s:32:\"9e755a921f1305e48f88f5b39c01b84f\";a:2:{s:4:\"name\";s:10:\"Background\";s:5:\"value\";N;}}}}'),
(3, 'core:layout', 'option', 'a:1:{s:4:\"data\";a:2:{s:7:\"columns\";a:6:{s:2:\"id\";s:2:\"id\";s:4:\"name\";s:4:\"name\";s:4:\"type\";s:4:\"type\";s:6:\"status\";s:6:\"status\";s:10:\"created_at\";s:10:\"created_at\";s:10:\"updated_at\";s:10:\"updated_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"35\";}}}'),
(4, 'core:page', 'option', 'a:1:{s:4:\"data\";a:2:{s:7:\"columns\";a:5:{s:2:\"id\";s:2:\"id\";s:5:\"title\";s:5:\"title\";s:6:\"status\";s:6:\"status\";s:10:\"created_at\";s:10:\"created_at\";s:10:\"updated_at\";s:10:\"updated_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"20\";}}}'),
(5, 'blog:category', 'category', 'a:1:{s:4:\"data\";a:2:{i:0;a:2:{s:4:\"name\";s:4:\"game\";s:2:\"id\";s:2:\"21\";}i:1;a:3:{s:4:\"name\";s:3:\"abc\";s:2:\"id\";s:2:\"12\";s:8:\"children\";a:2:{i:0;a:3:{s:4:\"name\";s:3:\"mmm\";s:2:\"id\";s:2:\"16\";s:8:\"children\";a:1:{i:0;a:2:{s:4:\"name\";s:4:\"cccc\";s:2:\"id\";s:2:\"18\";}}}i:1;a:2:{s:4:\"name\";s:3:\"bbb\";s:2:\"id\";s:2:\"19\";}}}}}'),
(7, 'core:user:list', 'option', 'a:1:{s:4:\"data\";a:2:{s:7:\"columns\";a:7:{s:2:\"id\";s:2:\"id\";s:4:\"name\";s:4:\"name\";s:8:\"username\";s:8:\"username\";s:6:\"avatar\";s:6:\"avatar\";s:6:\"status\";s:6:\"status\";s:10:\"created_at\";s:10:\"created_at\";s:10:\"updated_at\";s:10:\"updated_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"20\";}}}'),
(8, 'system', 'config', 'a:1:{s:4:\"data\";a:1:{s:4:\"core\";a:9:{s:9:\"site_name\";s:7:\"Zoe CMS\";s:9:\"time_zone\";s:16:\"Asia/Ho_Chi_Minh\";s:10:\"short_date\";s:5:\"d-m-Y\";s:9:\"long_date\";s:5:\"M d Y\";s:13:\"site_language\";s:2:\"vi\";s:18:\"site_meta_keywords\";N;s:21:\"site_meta_description\";N;s:16:\"google_analytics\";N;s:24:\"google_site_verification\";s:43:\"hs2Js3WGGpf1pzyhUNehvVDSIrmO3XZpm7PggNZECxE\";}}}'),
(9, 'blog', 'config', 'a:1:{s:4:\"data\";a:1:{s:4:\"post\";a:3:{s:8:\"language\";s:2:\"vi\";s:5:\"image\";a:3:{s:5:\"width\";s:3:\"150\";s:6:\"height\";s:3:\"150\";s:4:\"unit\";s:2:\"px\";}s:14:\"items_per_page\";s:2:\"20\";}}}');
INSERT INTO `cms_config` (`id`, `name`, `type`, `data`) VALUES
(10, 'user', 'config', 'a:1:{s:4:\"data\";a:8:{s:9:\"allow_reg\";s:1:\"1\";s:11:\"allow_login\";s:1:\"1\";s:13:\"enable_active\";s:1:\"1\";s:12:\"welcom_email\";s:1:\"1\";s:19:\"user_minimum_length\";s:1:\"6\";s:18:\"pwd_minimum_length\";s:1:\"6\";s:13:\"login_attemps\";s:2:\"10\";s:15:\"activation_time\";s:1:\"5\";}}'),
(12, 'lists', 'plugin', 'a:1:{s:4:\"data\";a:8:{s:9:\"Mega Menu\";i:1566890966;s:6:\"Backup\";i:1566923832;s:6:\"Layout\";i:1567309777;s:7:\"Builder\";i:1567314372;s:7:\"Comment\";i:1567314329;s:8:\"MegaMenu\";i:1567351751;s:7:\"Gallery\";i:1567440116;s:12:\"Announcement\";i:1567440120;}}'),
(14, 'active', 'theme', 'a:1:{s:4:\"data\";s:3:\"zoe\";}'),
(15, 'core:blog:post', 'option', 'a:2:{s:4:\"data\";a:2:{s:7:\"columns\";a:6:{s:2:\"id\";s:2:\"id\";s:5:\"title\";s:5:\"title\";s:5:\"image\";s:5:\"image\";s:6:\"status\";s:6:\"status\";s:5:\"views\";s:5:\"views\";s:10:\"created_at\";s:10:\"created_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"20\";}}s:4:\"lang\";N;}'),
(16, 'frontend', 'router', 'a:1:{s:4:\"data\";a:1:{s:4:\"data\";a:7:{s:18:\"frontend:user:info\";a:5:{s:4:\"data\";a:3:{s:4:\"name\";s:18:\"frontend:user:info\";s:3:\"uri\";s:9:\"user/info\";s:10:\"middleware\";s:23:\"[\"web\",\"auth:frontend\"]\";}s:6:\"layout\";s:4:\"home\";s:5:\"cache\";s:1:\"0\";s:3:\"acl\";s:5:\"login\";s:6:\"status\";s:1:\"1\";}s:5:\"login\";a:5:{s:4:\"data\";a:3:{s:4:\"name\";s:5:\"login\";s:3:\"uri\";s:5:\"login\";s:10:\"middleware\";s:7:\"[\"web\"]\";}s:6:\"layout\";s:5:\"login\";s:5:\"cache\";s:1:\"0\";s:3:\"acl\";s:8:\"no-login\";s:6:\"status\";s:1:\"1\";}s:8:\"register\";a:5:{s:4:\"data\";a:3:{s:4:\"name\";s:8:\"register\";s:3:\"uri\";s:8:\"register\";s:10:\"middleware\";s:7:\"[\"web\"]\";}s:6:\"layout\";s:5:\"login\";s:5:\"cache\";s:1:\"0\";s:3:\"acl\";s:8:\"no-login\";s:6:\"status\";s:1:\"2\";}s:25:\"frontend:guest:login:post\";a:5:{s:4:\"data\";a:3:{s:4:\"name\";s:25:\"frontend:guest:login:post\";s:3:\"uri\";s:12:\"login/action\";s:10:\"middleware\";s:7:\"[\"web\"]\";}s:6:\"layout\";s:4:\"home\";s:5:\"cache\";s:1:\"0\";s:3:\"acl\";s:8:\"no-login\";s:6:\"status\";s:1:\"1\";}s:28:\"frontend:guest:register:post\";a:5:{s:4:\"data\";a:3:{s:4:\"name\";s:28:\"frontend:guest:register:post\";s:3:\"uri\";s:15:\"register/action\";s:10:\"middleware\";s:7:\"[\"web\"]\";}s:6:\"layout\";s:5:\"login\";s:5:\"cache\";s:1:\"0\";s:3:\"acl\";s:8:\"no-login\";s:6:\"status\";s:1:\"1\";}s:6:\"logout\";a:5:{s:4:\"data\";a:3:{s:4:\"name\";s:6:\"logout\";s:3:\"uri\";s:6:\"logout\";s:10:\"middleware\";s:7:\"[\"web\"]\";}s:6:\"layout\";s:4:\"home\";s:5:\"cache\";s:1:\"0\";s:3:\"acl\";s:8:\"no-login\";s:6:\"status\";s:1:\"1\";}s:18:\"frontend:home:list\";a:5:{s:4:\"data\";a:3:{s:4:\"name\";s:18:\"frontend:home:list\";s:3:\"uri\";s:1:\"/\";s:10:\"middleware\";s:23:\"[\"web\",\"auth:frontend\"]\";}s:6:\"layout\";s:5:\"login\";s:5:\"cache\";s:1:\"0\";s:3:\"acl\";s:5:\"login\";s:6:\"status\";s:1:\"1\";}}}}');

-- --------------------------------------------------------

--
-- Table structure for table `cms_layout`
--

CREATE TABLE `cms_layout` (
  `id` int(5) NOT NULL,
  `token` varchar(255) NOT NULL,
  `theme` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `type_group` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `content` text NOT NULL,
  `data` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_layout`
--

INSERT INTO `cms_layout` (`id`, `token`, `theme`, `name`, `type_group`, `slug`, `type`, `status`, `content`, `data`, `created_at`, `updated_at`) VALUES
(7, '094bde12-ffeb-4fdc-ae8e-a5c1a80e2d9f', 'zoe', 'Home', 'theme', 'home', 'layout', 1, 'YToyOntzOjQ6ImRhdGEiO2E6Mzp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6OTp7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjA6IiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo4OiJsb2FkdmlldyI7czo0OiJjb3B5IjtzOjY6InB1YmxpYyI7czoxOiIwIjtzOjY6InJlbmRlciI7czo1OiJibGFkZSI7czozOiJ0YWciO3M6NDoibm9uZSI7czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiJjMTRlMmY5Yi02NWYxLTRiMTItY2NjNi0xNTE3MmIzNjA3MTQiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjk6IjUzNzc4NzIxNCI7fX1zOjM6Im9wdCI7YToyOntzOjU6InRpdGxlIjtzOjA6IiI7czo0OiJhdHRyIjthOjI6e3M6NToiY2xhc3MiO3M6MDoiIjtzOjI6ImlkIjtzOjA6IiI7fX19czo0OiJ2aWV3IjthOjE6e2k6MDthOjE6e2k6MDtzOjM2OiJkZTgzMWJiZi1lNTY4LTdlMmMtOWExZC0yYzhlNmZmNDEyZWQiO319fX1pOjE7YToxOntzOjM6InJvdyI7YToyOntzOjY6Im9wdGlvbiI7YTozOntzOjM6ImNmZyI7YTo5OntzOjQ6ImZ1bmMiO3M6OToiTm8gQWN0aW9uIjtzOjQ6InZpZXciO3M6MDoiIjtzOjY6InN0YXR1cyI7czoxOiIxIjtzOjg6ImxvYWR2aWV3IjtzOjQ6ImNvcHkiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NjoicmVuZGVyIjtzOjU6ImJsYWRlIjtzOjM6InRhZyI7czo1OiJibG9jayI7czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiIxZTk0MGQyYi04MTdjLWQ0NjMtOThlMi0wODNkNTMwOWY1NzYiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjEwOiIyMDgzMDQzNzQzIjt9fXM6Mzoib3B0IjthOjI6e3M6NToidGl0bGUiO3M6MDoiIjtzOjQ6ImF0dHIiO2E6Mjp7czo1OiJjbGFzcyI7czoxNToiaG9tZXBhZ2Utc2xpZGVyIjtzOjI6ImlkIjtzOjA6IiI7fX19czo0OiJ2aWV3IjthOjE6e2k6MDthOjM6e2k6MDtzOjM2OiJkOTljZWJjOC02N2M1LWNjZjMtNTMwZS0yNmQ0ZTcxYTRhZGUiO2k6MTtzOjM2OiIxYzk0ZjE5NS1iZmM2LTRhMTMtYWUyNi1hMjQ2OTE0MTZiZGQiO2k6MjtzOjM2OiI2ZTlkZDgwYS0yYjE4LTlmOTItMzIwMi04MmJiZTA2MmYxZjQiO319fX1pOjI7YToxOntzOjM6InJvdyI7YToyOntzOjY6Im9wdGlvbiI7YTozOntzOjM6ImNmZyI7YTo5OntzOjQ6ImZ1bmMiO3M6OToiTm8gQWN0aW9uIjtzOjQ6InZpZXciO3M6MDoiIjtzOjY6InN0YXR1cyI7czoxOiIxIjtzOjg6ImxvYWR2aWV3IjtzOjQ6ImNvcHkiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NjoicmVuZGVyIjtzOjU6ImJsYWRlIjtzOjM6InRhZyI7czo0OiJub25lIjtzOjg6ImNvbXBpbGVyIjthOjI6e3M6NDoiZ3JpZCI7YTowOnt9czo1OiJibGFkZSI7YTowOnt9fXM6MjoiaWQiO3M6MzY6ImU5MDU5OWM0LTM5YWYtZGM1Mi1lNmMzLTMyYTU0Mjg0NjlkNiI7fXM6Mzoic3RnIjthOjM6e3M6MzoiY29sIjthOjE6e2k6MDtzOjI6IjEyIjt9czo0OiJ0eXBlIjtzOjQ6ImdpcmQiO3M6NToicGxhY2UiO2E6MTp7aTowO3M6OToiMzc4ODY4ODgzIjt9fXM6Mzoib3B0IjthOjI6e3M6NToidGl0bGUiO3M6MDoiIjtzOjQ6ImF0dHIiO2E6Mjp7czo1OiJjbGFzcyI7czowOiIiO3M6MjoiaWQiO3M6MDoiIjt9fX1zOjQ6InZpZXciO2E6MTp7aTowO2E6MTp7aTowO3M6MzY6IjA0MjQxMTQ1LTJhZjQtZjFjZC0wZTVmLTA3MDk3NjAxMzlmNiI7fX19fX1zOjY6IndpZGdldCI7YTo1OntzOjM2OiJkZTgzMWJiZi1lNTY4LTdlMmMtOWExZC0yYzhlNmZmNDEyZWQiO2E6Mzp7czozOiJjZmciO2E6ODp7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo4OiJsb2FkdmlldyI7czo0OiJjb3B5IjtzOjY6InB1YmxpYyI7czoxOiIwIjtzOjc6ImR5bmFtaWMiO3M6MToiMCI7czo2OiJyZW5kZXIiO3M6NToiYmxhZGUiO3M6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjA6e31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiZGU4MzFiYmYtZTU2OC03ZTJjLTlhMWQtMmM4ZTZmZjQxMmVkIjt9czozOiJzdGciO2E6Njp7czo2OiJzeXN0ZW0iO3M6NToidGhlbWUiO3M6NjoibW9kdWxlIjtzOjM6InpvZSI7czo0OiJ0eXBlIjtzOjc6InBhcnRpYWwiO3M6MjoiaWQiO2k6MTY7czo1OiJ0b2tlbiI7czozNjoiZDJhMTgxMjktMDAwMy00ZmY2LWIzN2MtZWIzMzFlOWE2ZDc5IjtzOjQ6Im5hbWUiO3M6NjoiaGVhZGVyIjt9czozOiJvcHQiO2E6MTp7czo1OiJ0aXRsZSI7czowOiIiO319czozNjoiZDk5Y2ViYzgtNjdjNS1jY2YzLTUzMGUtMjZkNGU3MWE0YWRlIjthOjY6e3M6MzoiY2ZnIjthOjExOntzOjQ6ImZ1bmMiO3M6OToiTm8gQWN0aW9uIjtzOjQ6InZpZXciO3M6MzI6InRoZW1lOjp3aWRnZXRzLnNsaWRlci52aWV3cy5tYWluIjtzOjY6InN0YXR1cyI7czoxOiIxIjtzOjg6ImxvYWR2aWV3IjtzOjQ6ImNvcHkiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NzoiZHluYW1pYyI7czoxOiIwIjtzOjY6InJlbmRlciI7czo0OiJodG1sIjtzOjEyOiJpbWFnZV9iYXNlNjQiO3M6MToiMCI7czo4OiJ0ZW1wbGF0ZSI7YToyOntzOjQ6InZpZXciO3M6MToiMCI7czo0OiJkYXRhIjthOjM6e2k6MDtzOjA6IiI7aToxO3M6MDoiIjtpOjI7czowOiIiO319czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiJkOTljZWJjOC02N2M1LWNjZjMtNTMwZS0yNmQ0ZTcxYTRhZGUiO31zOjM6InN0ZyI7YTo2OntzOjY6InN5c3RlbSI7czo1OiJ0aGVtZSI7czo2OiJtb2R1bGUiO3M6Mzoiem9lIjtzOjQ6InR5cGUiO3M6Nzoid2lkZ2V0cyI7czozOiJwb3MiO3M6ODoiZnJvbnRlbmQiO3M6NjoibGF5b3V0IjtzOjY6IndpZGdldCI7czo0OiJuYW1lIjtzOjY6InNsaWRlciI7fXM6Mzoib3B0IjthOjQ6e3M6NToidGl0bGUiO3M6MDoiIjtzOjY6InJvdXRlciI7czoxODoiZnJvbnRlbmQ6aG9tZTpsaXN0IjtzOjU6Imxpc3RzIjthOjM6e2k6MDthOjU6e3M6NDoibmFtZSI7czoxMDoiUmVzcG9uc2l2ZSI7czo0OiJsaW5rIjtzOjE3OiJiYWNrZW5kOnBhZ2U6bGlzdCI7czo1OiJpbWFnZSI7czo0MDoidGhlbWUvem9lL2ltZy9ob21lcGFnZS1zbGlkZXIvc2xpZGUxLnBuZyI7czo0OiJpbmZvIjtzOjYwOiJJdCBsb29rcyBncmVhdCBvbiBkZXNrdG9wcywgbGFwdG9wcywgdGFibGV0cyBhbmQgc21hcnRwaG9uZXMiO3M6MjoiYmciO3M6MzoiYmcxIjt9aToxO2E6NTp7czo0OiJuYW1lIjtzOjEzOiJDb2xvciBTY2hlbWVzIjtzOjQ6ImxpbmsiO3M6MTc6ImJhY2tlbmQ6cGFnZTplZGl0IjtzOjU6ImltYWdlIjtzOjQwOiJ0aGVtZS96b2UvaW1nL2hvbWVwYWdlLXNsaWRlci9zbGlkZTIucG5nIjtzOjQ6ImluZm8iO3M6NTg6IkNvbWVzIHdpdGggNSBjb2xvciBzY2hlbWVzIGFuZCBpdCdzIGVhc3kgdG8gbWFrZSB5b3VyIG93biEiO3M6MjoiYmciO3M6MzoiYmcyIjt9aToyO2E6NTp7czo0OiJuYW1lIjtzOjEyOiJGZWF0dXJlIFJpY2giO3M6NDoibGluayI7czoxOToiYmFja2VuZDpwbHVnaW46bGlzdCI7czo1OiJpbWFnZSI7czo0MDoidGhlbWUvem9lL2ltZy9ob21lcGFnZS1zbGlkZXIvc2xpZGUzLnBuZyI7czo0OiJpbmZvIjtzOjUxOiJIdWdlIGFtb3VudCBvZiBjb21wb25lbnRzIGFuZCBvdmVyIDMwIHNhbXBsZSBwYWdlcyEiO3M6MjoiYmciO3M6MzoiYmczIjt9fXM6NToicGFyYW0iO2E6Mzp7aTowO2E6MTp7czo0OiJsaW5rIjtzOjEwOiJ7ImlkIjoiNSJ9Ijt9aToxO2E6MTp7czo0OiJsaW5rIjtzOjExOiJ7ImlkIjoiMTAifSI7fWk6MjthOjE6e3M6NDoibGluayI7czoyOiJ7fSI7fX19czo1OiJsaXN0cyI7YToyOntpOjA7YTozOntzOjQ6Im5hbWUiO3M6NjoibmFtZSAxIjtzOjQ6ImxpbmsiO3M6MTc6ImJhY2tlbmQ6cGFnZTplZGl0IjtzOjU6ImltYWdlIjtzOjc6ImltYWdlIDEiO31pOjE7YTozOntzOjQ6Im5hbWUiO3M6NjoibmFtZSAyIjtzOjQ6ImxpbmsiO3M6MTQ6InBhc3N3b3JkLnJlc2V0IjtzOjU6ImltYWdlIjtzOjc6ImltYWdlIDIiO319czo1OiJwYXJhbSI7YToyOntpOjA7YToxOntzOjQ6ImxpbmsiO3M6MTE6InsiaWQiOiIxMCJ9Ijt9aToxO2E6MTp7czo0OiJsaW5rIjtzOjEwOiJ7ImlkIjoiNSJ9Ijt9fXM6NDoibGFuZyI7YTo0OntzOjU6ImVuLVVTIjthOjY6e3M6MzI6IjBmYjZkMDk3NjRhODBlMDBkMmM1ZjNmYjFkYTdjMzRjIjthOjI6e3M6Mzoia2V5IjtzOjEwOiJSZXNwb25zaXZlIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiI4NjY4OGVkZTlkYmJmNjM3Zjc5MGEzNzc5MzZjNWU1MiI7YToyOntzOjM6ImtleSI7czoxMzoiQ29sb3IgU2NoZW1lcyI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiNGQxOTY1NzQwMTc3MWNmYTIyMjIyYzljMzdkZmY2ZDciO2E6Mjp7czozOiJrZXkiO3M6MTI6IkZlYXR1cmUgUmljaCI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiNmZjZjk0ODlmYzMzOGViMWYzYTg2ODM5YmMyMzRlMDEiO2E6Mjp7czozOiJrZXkiO3M6NTE6Ikh1Z2UgYW1vdW50IG9mIGNvbXBvbmVudHMgYW5kIG92ZXIgMzAgc2FtcGxlIHBhZ2VzISI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiNDVlZGI2YzdlMzA5N2RjMjM5NjM5YzZlZWYxNGIzNzgiO2E6Mjp7czozOiJrZXkiO3M6NjA6Ikl0IGxvb2tzIGdyZWF0IG9uIGRlc2t0b3BzLCBsYXB0b3BzLCB0YWJsZXRzIGFuZCBzbWFydHBob25lcyI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiMGQ4MTEyYTcxYzg0ZDg2NTA3MGUwOThmNjc2ZmM5OTEiO2E6Mjp7czozOiJrZXkiO3M6NTg6IkNvbWVzIHdpdGggNSBjb2xvciBzY2hlbWVzIGFuZCBpdCdzIGVhc3kgdG8gbWFrZSB5b3VyIG93biEiO3M6MzoidmFsIjtzOjA6IiI7fX1zOjI6InZpIjthOjY6e3M6MzI6IjBmYjZkMDk3NjRhODBlMDBkMmM1ZjNmYjFkYTdjMzRjIjthOjI6e3M6Mzoia2V5IjtzOjEwOiJSZXNwb25zaXZlIjtzOjM6InZhbCI7czoxMToixJHDoXAg4bupbmciO31zOjMyOiI4NjY4OGVkZTlkYmJmNjM3Zjc5MGEzNzc5MzZjNWU1MiI7YToyOntzOjM6ImtleSI7czoxMzoiQ29sb3IgU2NoZW1lcyI7czozOiJ2YWwiO3M6MTE6IlBo4buRaSBtw6B1Ijt9czozMjoiNGQxOTY1NzQwMTc3MWNmYTIyMjIyYzljMzdkZmY2ZDciO2E6Mjp7czozOiJrZXkiO3M6MTI6IkZlYXR1cmUgUmljaCI7czozOiJ2YWwiO3M6MjI6IlTDrW5oIG7Eg25nIHBob25nIHBow7oiO31zOjMyOiI2ZmNmOTQ4OWZjMzM4ZWIxZjNhODY4MzliYzIzNGUwMSI7YToyOntzOjM6ImtleSI7czo1MToiSHVnZSBhbW91bnQgb2YgY29tcG9uZW50cyBhbmQgb3ZlciAzMCBzYW1wbGUgcGFnZXMhIjtzOjM6InZhbCI7czo2MzoiU+G7kSBsxrDhu6NuZyBs4bubbiBjw6FjIHRow6BuaCBwaOG6p24gdsOgIGjGoW4gMzAgdHJhbmcgbeG6q3UhIjt9czozMjoiNDVlZGI2YzdlMzA5N2RjMjM5NjM5YzZlZWYxNGIzNzgiO2E6Mjp7czozOiJrZXkiO3M6NjA6Ikl0IGxvb2tzIGdyZWF0IG9uIGRlc2t0b3BzLCBsYXB0b3BzLCB0YWJsZXRzIGFuZCBzbWFydHBob25lcyI7czozOiJ2YWwiO3M6MTI1OiJOw7MgdHLDtG5nIHR1eeG7h3QgduG7nWkgdHLDqm4gbcOheSB0w61uaCDEkeG7gyBiw6BuLCBtw6F5IHTDrW5oIHjDoWNoIHRheSwgbcOheSB0w61uaCBi4bqjbmcgdsOgIMSRaeG7h24gdGhv4bqhaSB0aMO0bmcgbWluaCI7fXM6MzI6IjBkODExMmE3MWM4NGQ4NjUwNzBlMDk4ZjY3NmZjOTkxIjthOjI6e3M6Mzoia2V5IjtzOjU4OiJDb21lcyB3aXRoIDUgY29sb3Igc2NoZW1lcyBhbmQgaXQncyBlYXN5IHRvIG1ha2UgeW91ciBvd24hIjtzOjM6InZhbCI7czo4NjoiIMSQaSBrw6htIHbhu5tpIDUgY8OhY2ggcGjhu5FpIG3DoHUgdsOgIHRo4bqtdCBk4buFIGTDoG5nIMSR4buDIGzDoG0gY2hvIHJpw6puZyBi4bqhbiEiO319czoyOiJqYSI7YTo2OntzOjMyOiIwZmI2ZDA5NzY0YTgwZTAwZDJjNWYzZmIxZGE3YzM0YyI7YToyOntzOjM6ImtleSI7czoxMDoiUmVzcG9uc2l2ZSI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiODY2ODhlZGU5ZGJiZjYzN2Y3OTBhMzc3OTM2YzVlNTIiO2E6Mjp7czozOiJrZXkiO3M6MTM6IkNvbG9yIFNjaGVtZXMiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6IjRkMTk2NTc0MDE3NzFjZmEyMjIyMmM5YzM3ZGZmNmQ3IjthOjI6e3M6Mzoia2V5IjtzOjEyOiJGZWF0dXJlIFJpY2giO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6IjZmY2Y5NDg5ZmMzMzhlYjFmM2E4NjgzOWJjMjM0ZTAxIjthOjI6e3M6Mzoia2V5IjtzOjUxOiJIdWdlIGFtb3VudCBvZiBjb21wb25lbnRzIGFuZCBvdmVyIDMwIHNhbXBsZSBwYWdlcyEiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6IjQ1ZWRiNmM3ZTMwOTdkYzIzOTYzOWM2ZWVmMTRiMzc4IjthOjI6e3M6Mzoia2V5IjtzOjYwOiJJdCBsb29rcyBncmVhdCBvbiBkZXNrdG9wcywgbGFwdG9wcywgdGFibGV0cyBhbmQgc21hcnRwaG9uZXMiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6IjBkODExMmE3MWM4NGQ4NjUwNzBlMDk4ZjY3NmZjOTkxIjthOjI6e3M6Mzoia2V5IjtzOjU4OiJDb21lcyB3aXRoIDUgY29sb3Igc2NoZW1lcyBhbmQgaXQncyBlYXN5IHRvIG1ha2UgeW91ciBvd24hIjtzOjM6InZhbCI7czowOiIiO319czo1OiJ6aC1jbiI7YTo2OntzOjMyOiIwZmI2ZDA5NzY0YTgwZTAwZDJjNWYzZmIxZGE3YzM0YyI7YToyOntzOjM6ImtleSI7czoxMDoiUmVzcG9uc2l2ZSI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiODY2ODhlZGU5ZGJiZjYzN2Y3OTBhMzc3OTM2YzVlNTIiO2E6Mjp7czozOiJrZXkiO3M6MTM6IkNvbG9yIFNjaGVtZXMiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6IjRkMTk2NTc0MDE3NzFjZmEyMjIyMmM5YzM3ZGZmNmQ3IjthOjI6e3M6Mzoia2V5IjtzOjEyOiJGZWF0dXJlIFJpY2giO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6IjZmY2Y5NDg5ZmMzMzhlYjFmM2E4NjgzOWJjMjM0ZTAxIjthOjI6e3M6Mzoia2V5IjtzOjUxOiJIdWdlIGFtb3VudCBvZiBjb21wb25lbnRzIGFuZCBvdmVyIDMwIHNhbXBsZSBwYWdlcyEiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6IjQ1ZWRiNmM3ZTMwOTdkYzIzOTYzOWM2ZWVmMTRiMzc4IjthOjI6e3M6Mzoia2V5IjtzOjYwOiJJdCBsb29rcyBncmVhdCBvbiBkZXNrdG9wcywgbGFwdG9wcywgdGFibGV0cyBhbmQgc21hcnRwaG9uZXMiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6IjBkODExMmE3MWM4NGQ4NjUwNzBlMDk4ZjY3NmZjOTkxIjthOjI6e3M6Mzoia2V5IjtzOjU4OiJDb21lcyB3aXRoIDUgY29sb3Igc2NoZW1lcyBhbmQgaXQncyBlYXN5IHRvIG1ha2UgeW91ciBvd24hIjtzOjM6InZhbCI7czowOiIiO319fX1zOjM2OiIxYzk0ZjE5NS1iZmM2LTRhMTMtYWUyNi1hMjQ2OTE0MTZiZGQiO2E6NDp7czozOiJjZmciO2E6MTA6e3M6NDoiZnVuYyI7czo5OiJObyBBY3Rpb24iO3M6NDoidmlldyI7czozNDoidGhlbWU6OndpZGdldHMuY292ZXJhZ2Uudmlld3MubWFpbiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo2OiJwdWJsaWMiO3M6MToiMCI7czo3OiJkeW5hbWljIjtzOjE6IjAiO3M6NjoicmVuZGVyIjtzOjQ6Imh0bWwiO3M6MTI6ImltYWdlX2Jhc2U2NCI7czoxOiIwIjtzOjg6InRlbXBsYXRlIjthOjI6e3M6NDoidmlldyI7czoxOiIwIjtzOjQ6ImRhdGEiO2E6Mzp7aTowO3M6MDoiIjtpOjE7czowOiIiO2k6MjtzOjA6IiI7fX1zOjg6ImNvbXBpbGVyIjthOjI6e3M6NDoiZ3JpZCI7YTowOnt9czo1OiJibGFkZSI7YTowOnt9fXM6MjoiaWQiO3M6MzY6IjFjOTRmMTk1LWJmYzYtNGExMy1hZTI2LWEyNDY5MTQxNmJkZCI7fXM6Mzoic3RnIjthOjY6e3M6Njoic3lzdGVtIjtzOjU6InRoZW1lIjtzOjY6Im1vZHVsZSI7czozOiJ6b2UiO3M6NDoidHlwZSI7czo3OiJ3aWRnZXRzIjtzOjM6InBvcyI7czo4OiJmcm9udGVuZCI7czo2OiJsYXlvdXQiO3M6Njoid2lkZ2V0IjtzOjQ6Im5hbWUiO3M6ODoiY292ZXJhZ2UiO31zOjM6Im9wdCI7YToxOntzOjU6InRpdGxlIjtzOjA6IiI7fXM6NDoibGFuZyI7YTo0OntzOjU6ImVuLVVTIjthOjM6e3M6MzI6IjliMzFhODZkMTIxMzJiZmI0MDRlZTRjNmFhNWI3ZTQxIjthOjI6e3M6Mzoia2V5IjtzOjk0OiJNb3JiaSBlbGVpZmVuZCBjb25ndWUgZWxpdCBuZWMgc2FnaXR0aXMuIFByYWVzZW50IGFsaXF1YW0gbG9ib3J0aXMgdGVsbHVzLCBuZWMgY29uc2VxdWF0IHZpdGFlIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiI3MDhiOWE1ZGFiNWU3ZmE2ZTM5NjAzZTg2OTAxOTUwNyI7YToyOntzOjM6ImtleSI7czo5NjoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSAxIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiJkZGM5OTVjZDI5MGI4MTNlZTk1ODM4OTkzZDNmNGJiNSI7YToyOntzOjM6ImtleSI7czo5NjoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSAyIjtzOjM6InZhbCI7czowOiIiO319czoyOiJ2aSI7YTozOntzOjMyOiI5YjMxYTg2ZDEyMTMyYmZiNDA0ZWU0YzZhYTViN2U0MSI7YToyOntzOjM6ImtleSI7czo5NDoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSI7czozOiJ2YWwiO3M6MzoiYWJjIjt9czozMjoiNzA4YjlhNWRhYjVlN2ZhNmUzOTYwM2U4NjkwMTk1MDciO2E6Mjp7czozOiJrZXkiO3M6OTY6Ik1vcmJpIGVsZWlmZW5kIGNvbmd1ZSBlbGl0IG5lYyBzYWdpdHRpcy4gUHJhZXNlbnQgYWxpcXVhbSBsb2JvcnRpcyB0ZWxsdXMsIG5lYyBjb25zZXF1YXQgdml0YWUgMSI7czozOiJ2YWwiO3M6MzoiZGVmIjt9czozMjoiZGRjOTk1Y2QyOTBiODEzZWU5NTgzODk5M2QzZjRiYjUiO2E6Mjp7czozOiJrZXkiO3M6OTY6Ik1vcmJpIGVsZWlmZW5kIGNvbmd1ZSBlbGl0IG5lYyBzYWdpdHRpcy4gUHJhZXNlbnQgYWxpcXVhbSBsb2JvcnRpcyB0ZWxsdXMsIG5lYyBjb25zZXF1YXQgdml0YWUgMiI7czozOiJ2YWwiO3M6MTA6ImdoZ2g2Nzg4NzYiO319czoyOiJqYSI7YTozOntzOjMyOiI5YjMxYTg2ZDEyMTMyYmZiNDA0ZWU0YzZhYTViN2U0MSI7YToyOntzOjM6ImtleSI7czo5NDoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiNzA4YjlhNWRhYjVlN2ZhNmUzOTYwM2U4NjkwMTk1MDciO2E6Mjp7czozOiJrZXkiO3M6OTY6Ik1vcmJpIGVsZWlmZW5kIGNvbmd1ZSBlbGl0IG5lYyBzYWdpdHRpcy4gUHJhZXNlbnQgYWxpcXVhbSBsb2JvcnRpcyB0ZWxsdXMsIG5lYyBjb25zZXF1YXQgdml0YWUgMSI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiZGRjOTk1Y2QyOTBiODEzZWU5NTgzODk5M2QzZjRiYjUiO2E6Mjp7czozOiJrZXkiO3M6OTY6Ik1vcmJpIGVsZWlmZW5kIGNvbmd1ZSBlbGl0IG5lYyBzYWdpdHRpcy4gUHJhZXNlbnQgYWxpcXVhbSBsb2JvcnRpcyB0ZWxsdXMsIG5lYyBjb25zZXF1YXQgdml0YWUgMiI7czozOiJ2YWwiO3M6MDoiIjt9fXM6NToiemgtY24iO2E6Mzp7czozMjoiOWIzMWE4NmQxMjEzMmJmYjQwNGVlNGM2YWE1YjdlNDEiO2E6Mjp7czozOiJrZXkiO3M6OTQ6Ik1vcmJpIGVsZWlmZW5kIGNvbmd1ZSBlbGl0IG5lYyBzYWdpdHRpcy4gUHJhZXNlbnQgYWxpcXVhbSBsb2JvcnRpcyB0ZWxsdXMsIG5lYyBjb25zZXF1YXQgdml0YWUiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6IjcwOGI5YTVkYWI1ZTdmYTZlMzk2MDNlODY5MDE5NTA3IjthOjI6e3M6Mzoia2V5IjtzOjk2OiJNb3JiaSBlbGVpZmVuZCBjb25ndWUgZWxpdCBuZWMgc2FnaXR0aXMuIFByYWVzZW50IGFsaXF1YW0gbG9ib3J0aXMgdGVsbHVzLCBuZWMgY29uc2VxdWF0IHZpdGFlIDEiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6ImRkYzk5NWNkMjkwYjgxM2VlOTU4Mzg5OTNkM2Y0YmI1IjthOjI6e3M6Mzoia2V5IjtzOjk2OiJNb3JiaSBlbGVpZmVuZCBjb25ndWUgZWxpdCBuZWMgc2FnaXR0aXMuIFByYWVzZW50IGFsaXF1YW0gbG9ib3J0aXMgdGVsbHVzLCBuZWMgY29uc2VxdWF0IHZpdGFlIDIiO3M6MzoidmFsIjtzOjA6IiI7fX19fXM6MzY6IjZlOWRkODBhLTJiMTgtOWY5Mi0zMjAyLTgyYmJlMDYyZjFmNCI7YTo0OntzOjM6ImNmZyI7YToxMTp7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjM0OiJ0aGVtZTo6d2lkZ2V0cy5zZXJ2aWNlcy52aWV3cy5tYWluIjtzOjY6InN0YXR1cyI7czoxOiIxIjtzOjg6ImxvYWR2aWV3IjtzOjQ6ImNvcHkiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NzoiZHluYW1pYyI7czoxOiIwIjtzOjY6InJlbmRlciI7czo0OiJodG1sIjtzOjEyOiJpbWFnZV9iYXNlNjQiO3M6MToiMSI7czo4OiJ0ZW1wbGF0ZSI7YToyOntzOjQ6InZpZXciO3M6MToiMCI7czo0OiJkYXRhIjthOjM6e2k6MDtzOjA6IiI7aToxO3M6MDoiIjtpOjI7czowOiIiO319czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiI2ZTlkZDgwYS0yYjE4LTlmOTItMzIwMi04MmJiZTA2MmYxZjQiO31zOjM6InN0ZyI7YTo2OntzOjY6InN5c3RlbSI7czo1OiJ0aGVtZSI7czo2OiJtb2R1bGUiO3M6Mzoiem9lIjtzOjQ6InR5cGUiO3M6Nzoid2lkZ2V0cyI7czozOiJwb3MiO3M6ODoiZnJvbnRlbmQiO3M6NjoibGF5b3V0IjtzOjY6IndpZGdldCI7czo0OiJuYW1lIjtzOjg6InNlcnZpY2VzIjt9czozOiJvcHQiO2E6Mzp7czo1OiJ0aXRsZSI7czowOiIiO3M6NToibGlzdHMiO2E6Mzp7aTowO2E6NTp7czo0OiJuYW1lIjtzOjIxOiJBbGlxdWFtIGluIGFkaXBpc2NpbmciO3M6NDoibGluayI7czoxNzoiYmFja2VuZDpwYWdlOmxpc3QiO3M6NDoiaWNvbiI7czoyODoiaW1nL3NlcnZpY2UtaWNvbi9kaWFtb25kLnBuZyI7czo2OiJ0YXJnZXQiO3M6NjoiX2JsYW5rIjtzOjQ6ImluZm8iO3M6MTI1OiJQcmFlc2VudCByaG9uY3VzIG1hdXJpcyBhYyBzb2xsaWNpdHVkaW4gdmVoaWN1bGEuIE5hbSBmcmluZ2lsbGEgdHVycGlzIHR1cnBpcywgYXQgcG9zdWVyZSB0dXJwaXMgYWxpcXVldCBzaXQgYW1ldCBjb25kaW1lbnR1bSI7fWk6MTthOjU6e3M6NDoibmFtZSI7czoxNjoiQ3VyYWJpdHVyIG1vbGxpcyI7czo0OiJsaW5rIjtzOjIxOiJiYWNrZW5kOmxhbmd1YWdlOmxpc3QiO3M6NDoiaWNvbiI7czoyNjoiaW1nL3NlcnZpY2UtaWNvbi9ydWxlci5wbmciO3M6NjoidGFyZ2V0IjtzOjY6Il9ibGFuayI7czo0OiJpbmZvIjtzOjEyODoiU3VzcGVuZGlzc2UgZWdldCBsaWJlcm8gbWkuIEZ1c2NlIGxpZ3VsYSBvcmNpLCB2dWxwdXRhdGUgbmVjIGVsaXQgdWx0cmljZXMsIG9ybmFyZSBmYXVjaWJ1cyBvcmNpLiBBZW5lYW4gbGVjdHVzIHNhcGllbiwgdmVoaWN1bGEiO31pOjI7YTo1OntzOjQ6Im5hbWUiO3M6MTQ6IlZpdmFtdXMgbWF0dGlzIjtzOjQ6ImxpbmsiO3M6MTk6ImJhY2tlbmQ6bGF5b3V0Omxpc3QiO3M6NDoiaWNvbiI7czoyNDoiaW1nL3NlcnZpY2UtaWNvbi9ib3gucG5nIjtzOjY6InRhcmdldCI7czo2OiJfYmxhbmsiO3M6NDoiaW5mbyI7czoxMzQ6IlBoYXNlbGx1cyBwb3N1ZXJlIGV0IG5pc2wgYWMgY29tbW9kby4gTnVsbGEgZmFjaWxpc2kuIFNlZCB0aW5jaWR1bnQgYmliZW5kdW0gY3Vyc3VzLiBBZW5lYW4gdnVscHV0YXRlIGFsaXF1YW0gcmlzdXMgcnV0cnVtIHNjZWxlcmlzcXVlIjt9fXM6NToicGFyYW0iO2E6Mzp7aTowO2E6MTp7czo0OiJsaW5rIjtzOjI6Int9Ijt9aToxO2E6MTp7czo0OiJsaW5rIjtzOjI6Int9Ijt9aToyO2E6MTp7czo0OiJsaW5rIjtzOjI6Int9Ijt9fX1zOjQ6ImxhbmciO2E6NDp7czo1OiJlbi1VUyI7YTo0OntzOjMyOiJmOTljMWY0MDUyYjQ5NGZmYzNmNDQ0Y2YzZDk3NjljMiI7YToyOntzOjM6ImtleSI7czoyMToiQWxpcXVhbSBpbiBhZGlwaXNjaW5nIjtzOjM6InZhbCI7czoxNzoiIGxpdmUgcmVhbCBlc3RhdGUiO31zOjMyOiJjNWJjNDEzNjNlNmNiNWQ1M2UwNjVjZjFlYTY5NzlhYSI7YToyOntzOjM6ImtleSI7czoxNjoiQ3VyYWJpdHVyIG1vbGxpcyI7czozOiJ2YWwiO3M6MTA6IiBjaGF0IHNvZnQiO31zOjMyOiJhNDA3NjI3YmIzYzVhNzEwNDEwZjU5MTQzZTJkY2I1ZSI7YToyOntzOjM6ImtleSI7czoxNDoiVml2YW11cyBtYXR0aXMiO3M6MzoidmFsIjtzOjE3OiIgbGl2ZSByZWFsIGVzdGF0ZSI7fXM6MzI6IjI4MWZjZGY5ZjEzOTQ4NzI2YWUyM2Q2ZWZkNGIwMWE5IjthOjI6e3M6Mzoia2V5IjtzOjk6IlJlYWQgbW9yZSI7czozOiJ2YWwiO3M6OToiUmVhZCBtb3JlIjt9fXM6MjoidmkiO2E6NDp7czozMjoiZjk5YzFmNDA1MmI0OTRmZmMzZjQ0NGNmM2Q5NzY5YzIiO2E6Mjp7czozOiJrZXkiO3M6MjE6IkFsaXF1YW0gaW4gYWRpcGlzY2luZyI7czozOiJ2YWwiO3M6Mjk6IlRyb25nIG3hu5l0IHPhu5EgxJHhuqFpIGjhu41jIjt9czozMjoiYzViYzQxMzYzZTZjYjVkNTNlMDY1Y2YxZWE2OTc5YWEiO2E6Mjp7czozOiJrZXkiO3M6MTY6IkN1cmFiaXR1ciBtb2xsaXMiO3M6MzoidmFsIjtzOjE5OiJUcsOyIGNodXnhu4duIG3hu4FtIjt9czozMjoiYTQwNzYyN2JiM2M1YTcxMDQxMGY1OTE0M2UyZGNiNWUiO2E6Mjp7czozOiJrZXkiO3M6MTQ6IlZpdmFtdXMgbWF0dGlzIjtzOjM6InZhbCI7czoyNjoiYuG6pXQgxJHhu5luZyBz4bqjbiBz4buRbmciO31zOjMyOiIyODFmY2RmOWYxMzk0ODcyNmFlMjNkNmVmZDRiMDFhOSI7YToyOntzOjM6ImtleSI7czo5OiJSZWFkIG1vcmUiO3M6MzoidmFsIjtzOjEyOiLEkOG7jWMgdGjDqm0iO319czoyOiJqYSI7YTo0OntzOjMyOiJmOTljMWY0MDUyYjQ5NGZmYzNmNDQ0Y2YzZDk3NjljMiI7YToyOntzOjM6ImtleSI7czoyMToiQWxpcXVhbSBpbiBhZGlwaXNjaW5nIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiJjNWJjNDEzNjNlNmNiNWQ1M2UwNjVjZjFlYTY5NzlhYSI7YToyOntzOjM6ImtleSI7czoxNjoiQ3VyYWJpdHVyIG1vbGxpcyI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiYTQwNzYyN2JiM2M1YTcxMDQxMGY1OTE0M2UyZGNiNWUiO2E6Mjp7czozOiJrZXkiO3M6MTQ6IlZpdmFtdXMgbWF0dGlzIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiIyODFmY2RmOWYxMzk0ODcyNmFlMjNkNmVmZDRiMDFhOSI7YToyOntzOjM6ImtleSI7czo5OiJSZWFkIG1vcmUiO3M6MzoidmFsIjtzOjA6IiI7fX1zOjU6InpoLWNuIjthOjQ6e3M6MzI6ImY5OWMxZjQwNTJiNDk0ZmZjM2Y0NDRjZjNkOTc2OWMyIjthOjI6e3M6Mzoia2V5IjtzOjIxOiJBbGlxdWFtIGluIGFkaXBpc2NpbmciO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6ImM1YmM0MTM2M2U2Y2I1ZDUzZTA2NWNmMWVhNjk3OWFhIjthOjI6e3M6Mzoia2V5IjtzOjE2OiJDdXJhYml0dXIgbW9sbGlzIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiJhNDA3NjI3YmIzYzVhNzEwNDEwZjU5MTQzZTJkY2I1ZSI7YToyOntzOjM6ImtleSI7czoxNDoiVml2YW11cyBtYXR0aXMiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6IjI4MWZjZGY5ZjEzOTQ4NzI2YWUyM2Q2ZWZkNGIwMWE5IjthOjI6e3M6Mzoia2V5IjtzOjk6IlJlYWQgbW9yZSI7czozOiJ2YWwiO3M6MDoiIjt9fX19czozNjoiMDQyNDExNDUtMmFmNC1mMWNkLTBlNWYtMDcwOTc2MDEzOWY2IjthOjM6e3M6MzoiY2ZnIjthOjg6e3M6NDoiZnVuYyI7czo5OiJObyBBY3Rpb24iO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6ODoibG9hZHZpZXciO3M6NDoiY29weSI7czo2OiJwdWJsaWMiO3M6MToiMCI7czo3OiJkeW5hbWljIjtzOjE6IjAiO3M6NjoicmVuZGVyIjtzOjQ6Imh0bWwiO3M6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjA6e31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiMDQyNDExNDUtMmFmNC1mMWNkLTBlNWYtMDcwOTc2MDEzOWY2Ijt9czozOiJzdGciO2E6Njp7czo2OiJzeXN0ZW0iO3M6NToidGhlbWUiO3M6NjoibW9kdWxlIjtzOjM6InpvZSI7czo0OiJ0eXBlIjtzOjc6InBhcnRpYWwiO3M6MjoiaWQiO2k6ODtzOjU6InRva2VuIjtzOjM2OiI0M2NmNGU0MS01ZTg4LTQxNjMtODhlMi1lOGRkNDdjOWVhZTciO3M6NDoibmFtZSI7czo2OiJGb290ZXIiO31zOjM6Im9wdCI7YToxOntzOjU6InRpdGxlIjtzOjA6IiI7fX19fQ==', 'YToxOntzOjU6ImxhbmdzIjthOjE6e3M6NjoibGF5b3V0IjthOjI6e3M6MjoidmkiO2E6MTM6e3M6MTA6IlJlc3BvbnNpdmUiO3M6MTE6IsSRw6FwIOG7qW5nIjtzOjEzOiJDb2xvciBTY2hlbWVzIjtzOjExOiJQaOG7kWkgbcOgdSI7czoxMjoiRmVhdHVyZSBSaWNoIjtzOjIyOiJUw61uaCBuxINuZyBwaG9uZyBwaMO6IjtzOjUxOiJIdWdlIGFtb3VudCBvZiBjb21wb25lbnRzIGFuZCBvdmVyIDMwIHNhbXBsZSBwYWdlcyEiO3M6NjM6IlPhu5EgbMaw4bujbmcgbOG7m24gY8OhYyB0aMOgbmggcGjhuqduIHbDoCBoxqFuIDMwIHRyYW5nIG3huqt1ISI7czo2MDoiSXQgbG9va3MgZ3JlYXQgb24gZGVza3RvcHMsIGxhcHRvcHMsIHRhYmxldHMgYW5kIHNtYXJ0cGhvbmVzIjtzOjEyNToiTsOzIHRyw7RuZyB0dXnhu4d0IHbhu51pIHRyw6puIG3DoXkgdMOtbmggxJHhu4MgYsOgbiwgbcOheSB0w61uaCB4w6FjaCB0YXksIG3DoXkgdMOtbmggYuG6o25nIHbDoCDEkWnhu4duIHRob+G6oWkgdGjDtG5nIG1pbmgiO3M6NjM6IkNvbWVzIHdpdGggNSBjb2xvciBzY2hlbWVzIGFuZCBpdCYjMDM5O3MgZWFzeSB0byBtYWtlIHlvdXIgb3duISI7czo4NjoiIMSQaSBrw6htIHbhu5tpIDUgY8OhY2ggcGjhu5FpIG3DoHUgdsOgIHRo4bqtdCBk4buFIGTDoG5nIMSR4buDIGzDoG0gY2hvIHJpw6puZyBi4bqhbiEiO3M6OTQ6Ik1vcmJpIGVsZWlmZW5kIGNvbmd1ZSBlbGl0IG5lYyBzYWdpdHRpcy4gUHJhZXNlbnQgYWxpcXVhbSBsb2JvcnRpcyB0ZWxsdXMsIG5lYyBjb25zZXF1YXQgdml0YWUiO3M6MzoiYWJjIjtzOjk2OiJNb3JiaSBlbGVpZmVuZCBjb25ndWUgZWxpdCBuZWMgc2FnaXR0aXMuIFByYWVzZW50IGFsaXF1YW0gbG9ib3J0aXMgdGVsbHVzLCBuZWMgY29uc2VxdWF0IHZpdGFlIDEiO3M6MzoiZGVmIjtzOjk2OiJNb3JiaSBlbGVpZmVuZCBjb25ndWUgZWxpdCBuZWMgc2FnaXR0aXMuIFByYWVzZW50IGFsaXF1YW0gbG9ib3J0aXMgdGVsbHVzLCBuZWMgY29uc2VxdWF0IHZpdGFlIDIiO3M6MTA6ImdoZ2g2Nzg4NzYiO3M6MjE6IkFsaXF1YW0gaW4gYWRpcGlzY2luZyI7czoyOToiVHJvbmcgbeG7mXQgc+G7kSDEkeG6oWkgaOG7jWMiO3M6MTY6IkN1cmFiaXR1ciBtb2xsaXMiO3M6MTk6IlRyw7IgY2h1eeG7h24gbeG7gW0iO3M6MTQ6IlZpdmFtdXMgbWF0dGlzIjtzOjI2OiJi4bqldCDEkeG7mW5nIHPhuqNuIHPhu5FuZyI7czo5OiJSZWFkIG1vcmUiO3M6MTI6IsSQ4buNYyB0aMOqbSI7fXM6NToiZW4tVVMiO2E6NDp7czoyMToiQWxpcXVhbSBpbiBhZGlwaXNjaW5nIjtzOjE3OiIgbGl2ZSByZWFsIGVzdGF0ZSI7czoxNjoiQ3VyYWJpdHVyIG1vbGxpcyI7czoxMDoiIGNoYXQgc29mdCI7czoxNDoiVml2YW11cyBtYXR0aXMiO3M6MTc6IiBsaXZlIHJlYWwgZXN0YXRlIjtzOjk6IlJlYWQgbW9yZSI7czo5OiJSZWFkIG1vcmUiO319fX0=', '2019-08-02 21:54:56', '2019-09-15 04:29:35'),
(8, '43cf4e41-5e88-4163-88e2-e8dd47c9eae7', 'zoe', 'Footer', 'theme', 'footer', 'partial', 1, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6OTp7czo1OiJ0aXRsZSI7czowOiIiO3M6NDoiZnVuYyI7czo5OiJObyBBY3Rpb24iO3M6NDoidmlldyI7czowOiIiO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NjoicmVuZGVyIjtzOjU6ImJsYWRlIjtzOjM6InRhZyI7czo0OiJub25lIjtzOjg6ImNvbXBpbGVyIjthOjI6e3M6NDoiZ3JpZCI7YTowOnt9czo1OiJibGFkZSI7YTowOnt9fXM6MjoiaWQiO3M6MzY6IjZkMWNiOTE2LWE4ZDktYWM0NS0wYjVjLTBlYTlkOGQ1MjEyYiI7fXM6Mzoic3RnIjthOjM6e3M6MzoiY29sIjthOjE6e2k6MDtzOjI6IjEyIjt9czo0OiJ0eXBlIjtzOjQ6ImdpcmQiO3M6NToicGxhY2UiO2E6MTp7aTowO3M6MTA6IjE0NDU0NDg2NjUiO319czozOiJvcHQiO2E6MTp7czo0OiJhdHRyIjthOjI6e3M6NToiY2xhc3MiO3M6MDoiIjtzOjI6ImlkIjtzOjA6IiI7fX19czo0OiJ2aWV3IjthOjE6e2k6MDthOjE6e2k6MDtzOjM2OiJlZTVlZjEyMC0xOTlhLWNmYzAtMmNlNi00Y2U2ZDRjYTk4ZDQiO319fX19czo2OiJ3aWRnZXQiO2E6MTp7czozNjoiZWU1ZWYxMjAtMTk5YS1jZmMwLTJjZTYtNGNlNmQ0Y2E5OGQ0IjthOjQ6e3M6MzoiY2ZnIjthOjExOntzOjQ6ImZ1bmMiO3M6OToiTm8gQWN0aW9uIjtzOjQ6InZpZXciO3M6Mzc6InRoZW1lOjp3aWRnZXRzLm91ci1jbGllbnRzLnZpZXdzLm1haW4iO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6ODoibG9hZHZpZXciO3M6NzoiaW5jbHVkZSI7czo2OiJwdWJsaWMiO3M6MToiMCI7czo3OiJkeW5hbWljIjtzOjE6IjAiO3M6NjoicmVuZGVyIjtzOjU6ImJsYWRlIjtzOjEyOiJpbWFnZV9iYXNlNjQiO3M6MToiMCI7czo4OiJ0ZW1wbGF0ZSI7YToyOntzOjQ6InZpZXciO3M6MToiMCI7czo0OiJkYXRhIjthOjM6e2k6MDtzOjA6IiI7aToxO3M6MDoiIjtpOjI7czowOiIiO319czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiJlZTVlZjEyMC0xOTlhLWNmYzAtMmNlNi00Y2U2ZDRjYTk4ZDQiO31zOjM6InN0ZyI7YTo2OntzOjY6InN5c3RlbSI7czo1OiJ0aGVtZSI7czo2OiJtb2R1bGUiO3M6Mzoiem9lIjtzOjQ6InR5cGUiO3M6Nzoid2lkZ2V0cyI7czozOiJwb3MiO3M6ODoiZnJvbnRlbmQiO3M6NjoibGF5b3V0IjtzOjY6IndpZGdldCI7czo0OiJuYW1lIjtzOjExOiJvdXItY2xpZW50cyI7fXM6Mzoib3B0IjthOjE6e3M6NToidGl0bGUiO3M6MTE6Ik91ciBDbGllbnRzIjt9czo0OiJsYW5nIjthOjQ6e3M6NToiZW4tVVMiO2E6Mjp7czozMjoiYTNiZThmZWE1NDYwOTRjMjk1OGIwODY1YzkwZjZmYzMiO2E6Mjp7czozOiJrZXkiO3M6MTE6Ik91ciBDbGllbnRzIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiIwZDlhYmY5ZGMxOWQyYTRjZWRjY2JjMmZjYWVhZTA2OSI7YToyOntzOjM6ImtleSI7czo0OiJHYW1lIjtzOjM6InZhbCI7czowOiIiO319czoyOiJ2aSI7YToyOntzOjMyOiJhM2JlOGZlYTU0NjA5NGMyOTU4YjA4NjVjOTBmNmZjMyI7YToyOntzOjM6ImtleSI7czoxMToiT3VyIENsaWVudHMiO3M6MzoidmFsIjtzOjM2OiJLaMOhY2ggaMOgbmcgY+G7p2EgY2jDum5nIHTDtGkgYWJjICEiO31zOjMyOiIwZDlhYmY5ZGMxOWQyYTRjZWRjY2JjMmZjYWVhZTA2OSI7YToyOntzOjM6ImtleSI7czo0OiJHYW1lIjtzOjM6InZhbCI7czoxMDoiVHLDsiBjaMahaSI7fX1zOjI6ImphIjthOjI6e3M6MzI6ImEzYmU4ZmVhNTQ2MDk0YzI5NThiMDg2NWM5MGY2ZmMzIjthOjI6e3M6Mzoia2V5IjtzOjExOiJPdXIgQ2xpZW50cyI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiMGQ5YWJmOWRjMTlkMmE0Y2VkY2NiYzJmY2FlYWUwNjkiO2E6Mjp7czozOiJrZXkiO3M6NDoiR2FtZSI7czozOiJ2YWwiO3M6MDoiIjt9fXM6NToiemgtY24iO2E6Mjp7czozMjoiYTNiZThmZWE1NDYwOTRjMjk1OGIwODY1YzkwZjZmYzMiO2E6Mjp7czozOiJrZXkiO3M6MTE6Ik91ciBDbGllbnRzIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiIwZDlhYmY5ZGMxOWQyYTRjZWRjY2JjMmZjYWVhZTA2OSI7YToyOntzOjM6ImtleSI7czo0OiJHYW1lIjtzOjM6InZhbCI7czowOiIiO319fX19fQ==', 'YToxOntzOjU6ImxhbmdzIjthOjE6e3M6NjoibGF5b3V0IjthOjE6e3M6MjoidmkiO2E6Mjp7czoxMToiT3VyIENsaWVudHMiO3M6MzY6Iktow6FjaCBow6BuZyBj4bunYSBjaMO6bmcgdMO0aSBhYmMgISI7czo0OiJHYW1lIjtzOjEwOiJUcsOyIGNoxqFpIjt9fX19', '2019-08-13 06:36:50', '2019-09-15 04:16:41'),
(14, 'a0edb072-260e-436e-92e6-9d9857db26c9', 'zoe', 'Home', 'plugin:mega-menu:layout', 'home', 'layout', 0, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6OTp7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjA6IiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo4OiJsb2FkdmlldyI7czo3OiJpbmNsdWRlIjtzOjY6InB1YmxpYyI7czoxOiIwIjtzOjY6InJlbmRlciI7czo1OiJibGFkZSI7czozOiJ0YWciO3M6NDoibm9uZSI7czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiI0NTI5YzhiOS1jNTE4LTI4MmYtOGM5MC0wMTEyZTMxZjZlNjYiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjEwOiIxMzg5MTU0OTY4Ijt9fXM6Mzoib3B0IjthOjI6e3M6NToidGl0bGUiO3M6MDoiIjtzOjQ6ImF0dHIiO2E6Mjp7czo1OiJjbGFzcyI7czowOiIiO3M6MjoiaWQiO3M6MDoiIjt9fX1zOjQ6InZpZXciO2E6MTp7aTowO2E6MDp7fX19fX1zOjY6IndpZGdldCI7YTowOnt9fQ==', 'YToxOntzOjU6ImxhbmdzIjthOjE6e3M6NjoibGF5b3V0IjthOjA6e319fQ==', '2019-08-14 03:11:43', '2019-09-14 17:16:16'),
(15, '7d8b1cf8-6ba6-442c-8305-33b4c5e0040f', 'zoe', 'Login', 'theme', 'login', 'layout', 1, 'YToyOntzOjQ6ImRhdGEiO2E6Mzp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6Nzp7czo1OiJ0aXRsZSI7czoyOiJmZyI7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjA6IiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czozOiJ0YWciO3M6NDoibm9uZSI7czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiI5ZGFkMDgxYy04MDYyLTNiNzctZWI0ZC03ZWQ3Y2JlODQ0M2IiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjk6IjU1ODI0NDkwMiI7fX1zOjM6Im9wdCI7YToxOntzOjQ6ImF0dHIiO2E6Mjp7czo1OiJjbGFzcyI7czowOiIiO3M6MjoiaWQiO3M6MDoiIjt9fX1zOjQ6InZpZXciO2E6MTp7aTowO2E6MTp7aTowO3M6MzY6IjA3MmFhMmZkLWQxN2YtZjdiZC1hNDhjLTljMWRkYTc2NjAxMiI7fX19fWk6MTthOjE6e3M6Mzoicm93IjthOjI6e3M6Njoib3B0aW9uIjthOjM6e3M6MzoiY2ZnIjthOjk6e3M6NDoiZnVuYyI7czo5OiJObyBBY3Rpb24iO3M6NDoidmlldyI7czowOiIiO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6ODoibG9hZHZpZXciO3M6NDoiY29weSI7czo2OiJwdWJsaWMiO3M6MToiMCI7czo2OiJyZW5kZXIiO3M6NToiYmxhZGUiO3M6MzoidGFnIjtzOjQ6Im5vbmUiO3M6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjA6e31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiZTQyY2ZkY2QtNDkyMS1lZDQyLWMwYjUtZWY3NTRlYjYxZTE2Ijt9czozOiJzdGciO2E6Mzp7czozOiJjb2wiO2E6MTp7aTowO3M6MjoiMTIiO31zOjQ6InR5cGUiO3M6NDoiZ2lyZCI7czo1OiJwbGFjZSI7YToxOntpOjA7czo5OiI3MTg4Mjg5MzMiO319czozOiJvcHQiO2E6Mjp7czo1OiJ0aXRsZSI7czowOiIiO3M6NDoiYXR0ciI7YToyOntzOjU6ImNsYXNzIjtzOjA6IiI7czoyOiJpZCI7czowOiIiO319fXM6NDoidmlldyI7YToxOntpOjA7YToxOntpOjA7czozNjoiYTJmODU4NjYtZWMxMy0wZTJhLWYyZGEtYTU2YzUyODFmZTZjIjt9fX19aToyO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6OTp7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjA6IiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo4OiJsb2FkdmlldyI7czo0OiJjb3B5IjtzOjY6InB1YmxpYyI7czoxOiIwIjtzOjY6InJlbmRlciI7czo1OiJibGFkZSI7czozOiJ0YWciO3M6NDoibm9uZSI7czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiIwYWRjOTMxZC0zN2I5LWFiNTYtNzY4Mi1lZjUxZDVlYWIzYTYiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjEwOiIxNjkzODY0NTg3Ijt9fXM6Mzoib3B0IjthOjI6e3M6NToidGl0bGUiO3M6MDoiIjtzOjQ6ImF0dHIiO2E6Mjp7czo1OiJjbGFzcyI7czowOiIiO3M6MjoiaWQiO3M6MDoiIjt9fX1zOjQ6InZpZXciO2E6MTp7aTowO2E6MTp7aTowO3M6MzY6IjEwYjQ0YWRkLTUyYzEtYmUzNS0wNDMwLTUxNTIxYmQ4MzkzYSI7fX19fX1zOjY6IndpZGdldCI7YTozOntzOjM2OiIwNzJhYTJmZC1kMTdmLWY3YmQtYTQ4Yy05YzFkZGE3NjYwMTIiO2E6Mzp7czozOiJjZmciO2E6ODp7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo4OiJsb2FkdmlldyI7czo0OiJjb3B5IjtzOjY6InB1YmxpYyI7czoxOiIwIjtzOjc6ImR5bmFtaWMiO3M6MToiMCI7czo2OiJyZW5kZXIiO3M6NToiYmxhZGUiO3M6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjA6e31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiMDcyYWEyZmQtZDE3Zi1mN2JkLWE0OGMtOWMxZGRhNzY2MDEyIjt9czozOiJzdGciO2E6Njp7czo2OiJzeXN0ZW0iO3M6NToidGhlbWUiO3M6NjoibW9kdWxlIjtzOjM6InpvZSI7czo0OiJ0eXBlIjtzOjc6InBhcnRpYWwiO3M6MjoiaWQiO2k6MTY7czo1OiJ0b2tlbiI7czozNjoiZDJhMTgxMjktMDAwMy00ZmY2LWIzN2MtZWIzMzFlOWE2ZDc5IjtzOjQ6Im5hbWUiO3M6NjoiaGVhZGVyIjt9czozOiJvcHQiO2E6MTp7czo1OiJ0aXRsZSI7czowOiIiO319czozNjoiYTJmODU4NjYtZWMxMy0wZTJhLWYyZGEtYTU2YzUyODFmZTZjIjthOjM6e3M6MzoiY2ZnIjthOjEwOntzOjQ6ImZ1bmMiO3M6OToiTm8gQWN0aW9uIjtzOjQ6InZpZXciO3M6MzY6InRoZW1lOjpjb21wb25lbnRzLmNvbnRlbnQudmlld3MudmlldyI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo4OiJsb2FkdmlldyI7czo3OiJpbmNsdWRlIjtzOjY6InB1YmxpYyI7czoxOiIwIjtzOjc6ImR5bmFtaWMiO3M6MToiMCI7czo2OiJyZW5kZXIiO3M6NToiYmxhZGUiO3M6ODoidGVtcGxhdGUiO2E6Mjp7czo0OiJ2aWV3IjtzOjE6IjAiO3M6NDoiZGF0YSI7YTozOntpOjA7czowOiIiO2k6MTtzOjA6IiI7aToyO3M6MDoiIjt9fXM6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjA6e31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiYTJmODU4NjYtZWMxMy0wZTJhLWYyZGEtYTU2YzUyODFmZTZjIjt9czozOiJzdGciO2E6Njp7czo2OiJzeXN0ZW0iO3M6NjoibW9kdWxlIjtzOjY6Im1vZHVsZSI7czo1OiJhZG1pbiI7czo0OiJ0eXBlIjtzOjEwOiJjb21wb25lbnRzIjtzOjM6InBvcyI7czo4OiJmcm9udGVuZCI7czo2OiJsYXlvdXQiO3M6NjoibGF5b3V0IjtzOjQ6Im5hbWUiO3M6NzoiY29udGVudCI7fXM6Mzoib3B0IjthOjE6e3M6NToidGl0bGUiO3M6MDoiIjt9fXM6MzY6IjEwYjQ0YWRkLTUyYzEtYmUzNS0wNDMwLTUxNTIxYmQ4MzkzYSI7YTozOntzOjM6ImNmZyI7YTo4OntzOjQ6ImZ1bmMiO3M6OToiTm8gQWN0aW9uIjtzOjY6InN0YXR1cyI7czoxOiIxIjtzOjg6ImxvYWR2aWV3IjtzOjc6ImluY2x1ZGUiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NzoiZHluYW1pYyI7czoxOiIwIjtzOjY6InJlbmRlciI7czo1OiJibGFkZSI7czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiIxMGI0NGFkZC01MmMxLWJlMzUtMDQzMC01MTUyMWJkODM5M2EiO31zOjM6InN0ZyI7YTo2OntzOjY6InN5c3RlbSI7czo1OiJ0aGVtZSI7czo2OiJtb2R1bGUiO3M6Mzoiem9lIjtzOjQ6InR5cGUiO3M6NzoicGFydGlhbCI7czoyOiJpZCI7aTo4O3M6NToidG9rZW4iO3M6MzY6IjQzY2Y0ZTQxLTVlODgtNDE2My04OGUyLWU4ZGQ0N2M5ZWFlNyI7czo0OiJuYW1lIjtzOjY6IkZvb3RlciI7fXM6Mzoib3B0IjthOjE6e3M6NToidGl0bGUiO3M6MDoiIjt9fX19', 'YToxOntzOjU6ImxhbmdzIjthOjE6e3M6NjoibGF5b3V0IjthOjA6e319fQ==', '2019-08-24 02:05:30', '2019-09-15 08:04:17'),
(16, 'd2a18129-0003-4ff6-b37c-eb331e9a6d79', 'zoe', 'header', 'theme', 'header', 'partial', 1, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6Nzp7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjA6IiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo2OiJyZW5kZXIiO3M6NToiYmxhZGUiO3M6MzoidGFnIjtzOjQ6Im5vbmUiO3M6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjE6e2k6MDtzOjg6Im1haW5tZW51Ijt9czo1OiJibGFkZSI7YTowOnt9fXM6MjoiaWQiO3M6MzY6IjA4NjUwZjAzLTE3OGQtZjM0ZC0zMTk2LTVhZTlhOTc1YTRjYiI7fXM6Mzoic3RnIjthOjM6e3M6MzoiY29sIjthOjE6e2k6MDtzOjI6IjEyIjt9czo0OiJ0eXBlIjtzOjQ6ImdpcmQiO3M6NToicGxhY2UiO2E6MTp7aTowO3M6MTA6IjIwODU0MDM2NzMiO319czozOiJvcHQiO2E6Mjp7czo1OiJ0aXRsZSI7czowOiIiO3M6NDoiYXR0ciI7YToyOntzOjU6ImNsYXNzIjtzOjA6IiI7czoyOiJpZCI7czowOiIiO319fXM6NDoidmlldyI7YToxOntpOjA7YToyOntpOjA7czozNjoiZmFhZjYzYmYtYzMwYy05MzU0LTg0YWUtODgzZWNmMjQ1MDQxIjtpOjE7czozNjoiMmFkZGQ1YmYtZGJhZC1kZThhLTAwZTUtMWQ2NGU4M2I3OGExIjt9fX19fXM6Njoid2lkZ2V0IjthOjI6e3M6MzY6ImZhYWY2M2JmLWMzMGMtOTM1NC04NGFlLTg4M2VjZjI0NTA0MSI7YTozOntzOjM6ImNmZyI7YToxMDp7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjM3OiJ0aGVtZTo6d2lkZ2V0cy5tZW51LWV4dHJhcy52aWV3cy5tYWluIjtzOjY6InN0YXR1cyI7czoxOiIxIjtzOjg6ImxvYWR2aWV3IjtzOjc6ImluY2x1ZGUiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NzoiZHluYW1pYyI7czoxOiIwIjtzOjY6InJlbmRlciI7czo1OiJibGFkZSI7czo4OiJ0ZW1wbGF0ZSI7YToyOntzOjQ6InZpZXciO3M6MToiMCI7czo0OiJkYXRhIjthOjM6e2k6MDtzOjA6IiI7aToxO3M6MDoiIjtpOjI7czowOiIiO319czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiJmYWFmNjNiZi1jMzBjLTkzNTQtODRhZS04ODNlY2YyNDUwNDEiO31zOjM6InN0ZyI7YTo2OntzOjY6InN5c3RlbSI7czo1OiJ0aGVtZSI7czo2OiJtb2R1bGUiO3M6Mzoiem9lIjtzOjQ6InR5cGUiO3M6Nzoid2lkZ2V0cyI7czozOiJwb3MiO3M6ODoiZnJvbnRlbmQiO3M6NjoibGF5b3V0IjtzOjY6IndpZGdldCI7czo0OiJuYW1lIjtzOjExOiJtZW51LWV4dHJhcyI7fXM6Mzoib3B0IjthOjE6e3M6NToidGl0bGUiO3M6MDoiIjt9fXM6MzY6IjJhZGRkNWJmLWRiYWQtZGU4YS0wMGU1LTFkNjRlODNiNzhhMSI7YTozOntzOjM6ImNmZyI7YToxMDp7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjM4OiJ0aGVtZTo6Y29tcG9uZW50cy5tZWdhLW1lbnUudmlld3MubWFpbiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo4OiJsb2FkdmlldyI7czo3OiJpbmNsdWRlIjtzOjY6InB1YmxpYyI7czoxOiIwIjtzOjc6ImR5bmFtaWMiO3M6MToiMCI7czo2OiJyZW5kZXIiO3M6NToiYmxhZGUiO3M6ODoidGVtcGxhdGUiO2E6Mjp7czo0OiJ2aWV3IjtzOjE6IjAiO3M6NDoiZGF0YSI7YTozOntpOjA7czowOiIiO2k6MTtzOjA6IiI7aToyO3M6MDoiIjt9fXM6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjA6e31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiMmFkZGQ1YmYtZGJhZC1kZThhLTAwZTUtMWQ2NGU4M2I3OGExIjt9czozOiJzdGciO2E6Nzp7czo2OiJzeXN0ZW0iO3M6NjoicGx1Z2luIjtzOjY6Im1vZHVsZSI7czo4OiJNZWdhTWVudSI7czo0OiJ0eXBlIjtzOjEwOiJjb21wb25lbnRzIjtzOjM6InBvcyI7czowOiIiO3M6NjoibGF5b3V0IjtzOjY6ImxheW91dCI7czo0OiJuYW1lIjtzOjk6Im1lZ2EtbWVudSI7czo0OiJtYWluIjthOjE6e3M6MTM6Ik1lZ2FNZW51XG1haW4iO3M6NDoiZGF0YSI7fX1zOjM6Im9wdCI7YToxOntzOjU6InRpdGxlIjtzOjA6IiI7fX19fQ==', 'YToxOntzOjU6ImxhbmdzIjthOjE6e3M6NjoibGF5b3V0IjthOjA6e319fQ==', '2019-08-24 06:49:34', '2019-09-15 04:33:32');

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
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_module`
--

INSERT INTO `cms_module` (`id`, `name`, `version`, `data`, `status`, `create_at`) VALUES
(9, 'blog', '1.0.0', 'a:1:{s:7:\"require\";a:1:{i:0;s:7:\"Comment\";}}', 1, '2019-09-01 04:17:48');

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
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`id`, `slug`, `title`, `description`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'gioi-thieu-1', 'Giới thiệu 1', 'demo sfsdfsfsf', '<p>@for ($i = 0; $i < 10; $i++)</p>\r\n<div>The current value is {{ $i }}</div>\r\n<p>@endfor</p>', 1, '2019-07-26 20:14:53', '2019-09-15 17:17:25'),
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
  `status` tinyint(1) NOT NULL DEFAULT '1',
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
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
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
(5, 'Trung', 'trung', 'blog:post', 1, '2019-08-19 16:03:32'),
(6, 'a', 'a', 'blog:post', 1, '2019-09-02 16:13:06');

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
(6, 4, 5),
(7, 6, 6);

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
-- Table structure for table `cms_users1`
--

CREATE TABLE `cms_users1` (
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `cms_blog`
--
ALTER TABLE `cms_blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cms_blog_user_id_index` (`user_id`);

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
-- Indexes for table `cms_comments`
--
ALTER TABLE `cms_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cms_comments_user_id_index` (`user_id`);

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
-- Indexes for table `cms_module`
--
ALTER TABLE `cms_module`
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
-- Indexes for table `cms_users1`
--
ALTER TABLE `cms_users1`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cms_blog`
--
ALTER TABLE `cms_blog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_blog_post`
--
ALTER TABLE `cms_blog_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cms_categories`
--
ALTER TABLE `cms_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cms_comments`
--
ALTER TABLE `cms_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_config`
--
ALTER TABLE `cms_config`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cms_layout`
--
ALTER TABLE `cms_layout`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cms_migrations`
--
ALTER TABLE `cms_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_module`
--
ALTER TABLE `cms_module`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cms_tag_item`
--
ALTER TABLE `cms_tag_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cms_user`
--
ALTER TABLE `cms_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms_users1`
--
ALTER TABLE `cms_users1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
