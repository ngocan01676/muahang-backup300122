-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 08, 2019 at 05:31 PM
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
(1, 'language', 'json', 'a:1:{s:4:\"lang\";a:4:{s:2:\"en\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:9:\"Dashboard\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";s:3:\"Key\";}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:7:\"Plugins\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"vi\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:22:\"Trình điều khiển\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";s:5:\"Khóa\";}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:9:\"Bổ sung\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"jp\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:21:\"ダッシュボード\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:15:\"プラグイン\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"cn\";a:19:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:9:\"仪表盘\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";s:6:\"插件\";}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}}}'),
(2, 'language', 'data', 'a:1:{s:4:\"lang\";a:4:{s:5:\"en-US\";a:53:{s:32:\"74be16979710d4c4e7c6647856088456\";a:2:{s:4:\"name\";N;s:5:\"value\";N;}s:32:\"1ea0bad6924b73e132cac7bee38f9ad0\";a:2:{s:4:\"name\";s:6:\"System\";s:5:\"value\";N;}s:32:\"4aada3a7641e12e63d4f07ea14db3147\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";N;}s:32:\"d222b0480a59760fe9165c7ebc203c19\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"53c4c836a4a51819222ed36cf596b601\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"2afc1ae5c1d04b5f8f42dbcb9c2d99bc\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";N;}s:32:\"b92a0bf00ca22fca7d57f4f5d33e3b57\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"103ba5e1e5d4b3feed9a5223584f91fd\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"0e0351cb9c354b2bb81dca9743451071\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";N;}s:32:\"a9a0d1899df240235c7315df67d67871\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"066923ceb0e8b19e772da586dd918aa6\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";N;}s:32:\"660144cd3bfa5b0af27e4786c5f5c5ab\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"1ce40393b259e2977cb78840007e6be1\";a:2:{s:4:\"name\";s:13:\"Category List\";s:5:\"value\";N;}s:32:\"0774fde7c3c87feef9f1c5c1ee9ba488\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"d4309e732c55b2cc7e3e7776e787d926\";a:2:{s:4:\"name\";s:27:\"Reset Position Successfully\";s:5:\"value\";N;}s:32:\"d5f8439526f9f52b1847853956890991\";a:2:{s:4:\"name\";s:7:\"Confirm\";s:5:\"value\";N;}s:32:\"45fcfe8aa0abd67eb0df5ebfda161619\";a:2:{s:4:\"name\";s:33:\"Are you sure to delete this item?\";s:5:\"value\";N;}s:32:\"5678b21d08b6ab375a49e7e9a35933a2\";a:2:{s:4:\"name\";s:17:\"Manager Component\";s:5:\"value\";N;}s:32:\"ef2b832c480f0d7cefee57f11c99b91d\";a:2:{s:4:\"name\";s:21:\"Manager Configuration\";s:5:\"value\";N;}s:32:\"fd076f906f24905156bd7b4113e82c35\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"452a133e3befca4a74292bf3cdec7893\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"2c33ba01cba900cce4287ce30f92866b\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"0bf24321bc4a59f82723d2dee839e205\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"6a8758e140fb1efe3ba9a12d081e1b05\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"9484fabeb5e1a9f0117ef38a3df4b526\";a:2:{s:4:\"name\";s:14:\"Manager Module\";s:5:\"value\";N;}s:32:\"86aabab43ca86c0fb8f61f5a8e0abfc2\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"72f14339ff02a69f691311cd54ed61fd\";a:2:{s:4:\"name\";s:15:\"Manager Plugins\";s:5:\"value\";N;}s:32:\"8108a6e213503016830b51831e938a06\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"c8e3bce21e386602ae168af717ed5732\";a:2:{s:4:\"name\";s:6:\"Search\";s:5:\"value\";N;}s:32:\"dd6f8071a9c6f4f651bd149f03e0a078\";a:2:{s:4:\"name\";s:13:\"Configuration\";s:5:\"value\";N;}s:32:\"1280be03f83aa0a0233d5773117012f7\";a:2:{s:4:\"name\";s:6:\"Module\";s:5:\"value\";N;}s:32:\"d88c7389f879372a2294d6e0339db5b5\";a:2:{s:4:\"name\";s:12:\"Error :class\";s:5:\"value\";N;}s:32:\"d24584099f4c18f1cbe630e42bd28e0e\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"091c6db51ffe68a6319dbd38de2ca191\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"62e8ea7f29a166bb4a7c5017a8383e6f\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8b790d36a6f1cac6a219fb1951ae8b0a\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";N;}s:32:\"4ecbf1634a3e4e1e2753a299b070d9b0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"c2b0c74543d0ec15a11b2ee1d2e34643\";a:2:{s:4:\"name\";s:7:\"Members\";s:5:\"value\";N;}s:32:\"384e97614d7734eee709c4d1a545767c\";a:2:{s:4:\"name\";s:5:\"Users\";s:5:\"value\";N;}s:32:\"e55863d457dd9473186427730f3c2994\";a:2:{s:4:\"name\";s:4:\"Role\";s:5:\"value\";N;}s:32:\"e70ed0291c0813727fc7cffdde52a41e\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"89be00f9644d7e4fe24a5afccf23181a\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"253c79cc37c07c30b4854d5be5f39763\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"22e6132fff18fbfd8fa43b0d32bc1c9a\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"b628564009e1802e3c8ac78518858d70\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"f17cfd1f21ddeeb109300ade810d1408\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a4c7dc56186aaf14cb52b6ad6e320d91\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"be013f3a6d6715a1c8d71f78afc27c85\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"5e9de4614577a55731770828b4aba6db\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"6b9a32f46538611d4a68a2e495a727db\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"82a53d2bd9095f91036742bd7562dd70\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"0dbb53b31dc5a2711c1cea33bf4c862d\";a:2:{s:4:\"name\";s:18:\"Manager User Admin\";s:5:\"value\";N;}s:32:\"526258c9809c7c9ffb2734f60f35e967\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"vi\";a:53:{s:32:\"74be16979710d4c4e7c6647856088456\";a:2:{s:4:\"name\";N;s:5:\"value\";N;}s:32:\"1ea0bad6924b73e132cac7bee38f9ad0\";a:2:{s:4:\"name\";s:6:\"System\";s:5:\"value\";s:12:\"Hệ thống\";}s:32:\"4aada3a7641e12e63d4f07ea14db3147\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:10:\"Thông kê\";}s:32:\"d222b0480a59760fe9165c7ebc203c19\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";s:11:\"Ngôn ngữ\";}s:32:\"53c4c836a4a51819222ed36cf596b601\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";s:11:\"Giao diện\";}s:32:\"2afc1ae5c1d04b5f8f42dbcb9c2d99bc\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";s:5:\"Trang\";}s:32:\"b92a0bf00ca22fca7d57f4f5d33e3b57\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"103ba5e1e5d4b3feed9a5223584f91fd\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";s:11:\"Thêm mới\";}s:32:\"0e0351cb9c354b2bb81dca9743451071\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";s:11:\"Cài đặt\";}s:32:\"a9a0d1899df240235c7315df67d67871\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"066923ceb0e8b19e772da586dd918aa6\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";s:11:\"Bài viết\";}s:32:\"660144cd3bfa5b0af27e4786c5f5c5ab\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"1ce40393b259e2977cb78840007e6be1\";a:2:{s:4:\"name\";s:13:\"Category List\";s:5:\"value\";N;}s:32:\"0774fde7c3c87feef9f1c5c1ee9ba488\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"d4309e732c55b2cc7e3e7776e787d926\";a:2:{s:4:\"name\";s:27:\"Reset Position Successfully\";s:5:\"value\";N;}s:32:\"d5f8439526f9f52b1847853956890991\";a:2:{s:4:\"name\";s:7:\"Confirm\";s:5:\"value\";N;}s:32:\"45fcfe8aa0abd67eb0df5ebfda161619\";a:2:{s:4:\"name\";s:33:\"Are you sure to delete this item?\";s:5:\"value\";N;}s:32:\"5678b21d08b6ab375a49e7e9a35933a2\";a:2:{s:4:\"name\";s:17:\"Manager Component\";s:5:\"value\";N;}s:32:\"ef2b832c480f0d7cefee57f11c99b91d\";a:2:{s:4:\"name\";s:21:\"Manager Configuration\";s:5:\"value\";N;}s:32:\"fd076f906f24905156bd7b4113e82c35\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";s:4:\"Lưu\";}s:32:\"452a133e3befca4a74292bf3cdec7893\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"2c33ba01cba900cce4287ce30f92866b\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"0bf24321bc4a59f82723d2dee839e205\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"6a8758e140fb1efe3ba9a12d081e1b05\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"9484fabeb5e1a9f0117ef38a3df4b526\";a:2:{s:4:\"name\";s:14:\"Manager Module\";s:5:\"value\";N;}s:32:\"86aabab43ca86c0fb8f61f5a8e0abfc2\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"72f14339ff02a69f691311cd54ed61fd\";a:2:{s:4:\"name\";s:15:\"Manager Plugins\";s:5:\"value\";N;}s:32:\"8108a6e213503016830b51831e938a06\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"c8e3bce21e386602ae168af717ed5732\";a:2:{s:4:\"name\";s:6:\"Search\";s:5:\"value\";N;}s:32:\"dd6f8071a9c6f4f651bd149f03e0a078\";a:2:{s:4:\"name\";s:13:\"Configuration\";s:5:\"value\";s:11:\"Cấu hình\";}s:32:\"1280be03f83aa0a0233d5773117012f7\";a:2:{s:4:\"name\";s:6:\"Module\";s:5:\"value\";N;}s:32:\"d88c7389f879372a2294d6e0339db5b5\";a:2:{s:4:\"name\";s:12:\"Error :class\";s:5:\"value\";N;}s:32:\"d24584099f4c18f1cbe630e42bd28e0e\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"091c6db51ffe68a6319dbd38de2ca191\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"62e8ea7f29a166bb4a7c5017a8383e6f\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8b790d36a6f1cac6a219fb1951ae8b0a\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";s:12:\"Bình luận\";}s:32:\"4ecbf1634a3e4e1e2753a299b070d9b0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"c2b0c74543d0ec15a11b2ee1d2e34643\";a:2:{s:4:\"name\";s:7:\"Members\";s:5:\"value\";s:12:\"Tài khoản\";}s:32:\"384e97614d7734eee709c4d1a545767c\";a:2:{s:4:\"name\";s:5:\"Users\";s:5:\"value\";s:18:\"Quản trị viên\";}s:32:\"e55863d457dd9473186427730f3c2994\";a:2:{s:4:\"name\";s:4:\"Role\";s:5:\"value\";s:23:\"Nhóm và phân quyền\";}s:32:\"e70ed0291c0813727fc7cffdde52a41e\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"89be00f9644d7e4fe24a5afccf23181a\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"253c79cc37c07c30b4854d5be5f39763\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"22e6132fff18fbfd8fa43b0d32bc1c9a\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"b628564009e1802e3c8ac78518858d70\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"f17cfd1f21ddeeb109300ade810d1408\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a4c7dc56186aaf14cb52b6ad6e320d91\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"be013f3a6d6715a1c8d71f78afc27c85\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";s:4:\"Tên\";}s:32:\"5e9de4614577a55731770828b4aba6db\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"6b9a32f46538611d4a68a2e495a727db\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"82a53d2bd9095f91036742bd7562dd70\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"0dbb53b31dc5a2711c1cea33bf4c862d\";a:2:{s:4:\"name\";s:18:\"Manager User Admin\";s:5:\"value\";N;}s:32:\"526258c9809c7c9ffb2734f60f35e967\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"ja\";a:53:{s:32:\"74be16979710d4c4e7c6647856088456\";a:2:{s:4:\"name\";N;s:5:\"value\";N;}s:32:\"1ea0bad6924b73e132cac7bee38f9ad0\";a:2:{s:4:\"name\";s:6:\"System\";s:5:\"value\";N;}s:32:\"4aada3a7641e12e63d4f07ea14db3147\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";N;}s:32:\"d222b0480a59760fe9165c7ebc203c19\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"53c4c836a4a51819222ed36cf596b601\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"2afc1ae5c1d04b5f8f42dbcb9c2d99bc\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";N;}s:32:\"b92a0bf00ca22fca7d57f4f5d33e3b57\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"103ba5e1e5d4b3feed9a5223584f91fd\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"0e0351cb9c354b2bb81dca9743451071\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";N;}s:32:\"a9a0d1899df240235c7315df67d67871\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"066923ceb0e8b19e772da586dd918aa6\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";N;}s:32:\"660144cd3bfa5b0af27e4786c5f5c5ab\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"1ce40393b259e2977cb78840007e6be1\";a:2:{s:4:\"name\";s:13:\"Category List\";s:5:\"value\";N;}s:32:\"0774fde7c3c87feef9f1c5c1ee9ba488\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"d4309e732c55b2cc7e3e7776e787d926\";a:2:{s:4:\"name\";s:27:\"Reset Position Successfully\";s:5:\"value\";N;}s:32:\"d5f8439526f9f52b1847853956890991\";a:2:{s:4:\"name\";s:7:\"Confirm\";s:5:\"value\";N;}s:32:\"45fcfe8aa0abd67eb0df5ebfda161619\";a:2:{s:4:\"name\";s:33:\"Are you sure to delete this item?\";s:5:\"value\";N;}s:32:\"5678b21d08b6ab375a49e7e9a35933a2\";a:2:{s:4:\"name\";s:17:\"Manager Component\";s:5:\"value\";N;}s:32:\"ef2b832c480f0d7cefee57f11c99b91d\";a:2:{s:4:\"name\";s:21:\"Manager Configuration\";s:5:\"value\";N;}s:32:\"fd076f906f24905156bd7b4113e82c35\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"452a133e3befca4a74292bf3cdec7893\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"2c33ba01cba900cce4287ce30f92866b\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"0bf24321bc4a59f82723d2dee839e205\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"6a8758e140fb1efe3ba9a12d081e1b05\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"9484fabeb5e1a9f0117ef38a3df4b526\";a:2:{s:4:\"name\";s:14:\"Manager Module\";s:5:\"value\";N;}s:32:\"86aabab43ca86c0fb8f61f5a8e0abfc2\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"72f14339ff02a69f691311cd54ed61fd\";a:2:{s:4:\"name\";s:15:\"Manager Plugins\";s:5:\"value\";N;}s:32:\"8108a6e213503016830b51831e938a06\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"c8e3bce21e386602ae168af717ed5732\";a:2:{s:4:\"name\";s:6:\"Search\";s:5:\"value\";N;}s:32:\"dd6f8071a9c6f4f651bd149f03e0a078\";a:2:{s:4:\"name\";s:13:\"Configuration\";s:5:\"value\";N;}s:32:\"1280be03f83aa0a0233d5773117012f7\";a:2:{s:4:\"name\";s:6:\"Module\";s:5:\"value\";N;}s:32:\"d88c7389f879372a2294d6e0339db5b5\";a:2:{s:4:\"name\";s:12:\"Error :class\";s:5:\"value\";N;}s:32:\"d24584099f4c18f1cbe630e42bd28e0e\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"091c6db51ffe68a6319dbd38de2ca191\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"62e8ea7f29a166bb4a7c5017a8383e6f\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8b790d36a6f1cac6a219fb1951ae8b0a\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";N;}s:32:\"4ecbf1634a3e4e1e2753a299b070d9b0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"c2b0c74543d0ec15a11b2ee1d2e34643\";a:2:{s:4:\"name\";s:7:\"Members\";s:5:\"value\";N;}s:32:\"384e97614d7734eee709c4d1a545767c\";a:2:{s:4:\"name\";s:5:\"Users\";s:5:\"value\";N;}s:32:\"e55863d457dd9473186427730f3c2994\";a:2:{s:4:\"name\";s:4:\"Role\";s:5:\"value\";N;}s:32:\"e70ed0291c0813727fc7cffdde52a41e\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"89be00f9644d7e4fe24a5afccf23181a\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"253c79cc37c07c30b4854d5be5f39763\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"22e6132fff18fbfd8fa43b0d32bc1c9a\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"b628564009e1802e3c8ac78518858d70\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"f17cfd1f21ddeeb109300ade810d1408\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a4c7dc56186aaf14cb52b6ad6e320d91\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"be013f3a6d6715a1c8d71f78afc27c85\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"5e9de4614577a55731770828b4aba6db\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"6b9a32f46538611d4a68a2e495a727db\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"82a53d2bd9095f91036742bd7562dd70\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"0dbb53b31dc5a2711c1cea33bf4c862d\";a:2:{s:4:\"name\";s:18:\"Manager User Admin\";s:5:\"value\";N;}s:32:\"526258c9809c7c9ffb2734f60f35e967\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:5:\"zh-cn\";a:53:{s:32:\"74be16979710d4c4e7c6647856088456\";a:2:{s:4:\"name\";N;s:5:\"value\";N;}s:32:\"1ea0bad6924b73e132cac7bee38f9ad0\";a:2:{s:4:\"name\";s:6:\"System\";s:5:\"value\";N;}s:32:\"4aada3a7641e12e63d4f07ea14db3147\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";N;}s:32:\"d222b0480a59760fe9165c7ebc203c19\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"53c4c836a4a51819222ed36cf596b601\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"2afc1ae5c1d04b5f8f42dbcb9c2d99bc\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";N;}s:32:\"b92a0bf00ca22fca7d57f4f5d33e3b57\";a:2:{s:4:\"name\";s:17:\"Manager Blog Post\";s:5:\"value\";N;}s:32:\"103ba5e1e5d4b3feed9a5223584f91fd\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"0e0351cb9c354b2bb81dca9743451071\";a:2:{s:4:\"name\";s:6:\"Option\";s:5:\"value\";N;}s:32:\"a9a0d1899df240235c7315df67d67871\";a:2:{s:4:\"name\";s:11:\"Page Option\";s:5:\"value\";N;}s:32:\"066923ceb0e8b19e772da586dd918aa6\";a:2:{s:4:\"name\";s:4:\"Post\";s:5:\"value\";N;}s:32:\"660144cd3bfa5b0af27e4786c5f5c5ab\";a:2:{s:4:\"name\";s:21:\"Manager Blog Category\";s:5:\"value\";N;}s:32:\"1ce40393b259e2977cb78840007e6be1\";a:2:{s:4:\"name\";s:13:\"Category List\";s:5:\"value\";N;}s:32:\"0774fde7c3c87feef9f1c5c1ee9ba488\";a:2:{s:4:\"name\";s:28:\"Update Position Successfully\";s:5:\"value\";N;}s:32:\"d4309e732c55b2cc7e3e7776e787d926\";a:2:{s:4:\"name\";s:27:\"Reset Position Successfully\";s:5:\"value\";N;}s:32:\"d5f8439526f9f52b1847853956890991\";a:2:{s:4:\"name\";s:7:\"Confirm\";s:5:\"value\";N;}s:32:\"45fcfe8aa0abd67eb0df5ebfda161619\";a:2:{s:4:\"name\";s:33:\"Are you sure to delete this item?\";s:5:\"value\";N;}s:32:\"5678b21d08b6ab375a49e7e9a35933a2\";a:2:{s:4:\"name\";s:17:\"Manager Component\";s:5:\"value\";N;}s:32:\"ef2b832c480f0d7cefee57f11c99b91d\";a:2:{s:4:\"name\";s:21:\"Manager Configuration\";s:5:\"value\";N;}s:32:\"fd076f906f24905156bd7b4113e82c35\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"452a133e3befca4a74292bf3cdec7893\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"2c33ba01cba900cce4287ce30f92866b\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"0bf24321bc4a59f82723d2dee839e205\";a:2:{s:4:\"name\";s:14:\"Manager Layout\";s:5:\"value\";N;}s:32:\"6a8758e140fb1efe3ba9a12d081e1b05\";a:2:{s:4:\"name\";s:13:\"Layout Option\";s:5:\"value\";N;}s:32:\"9484fabeb5e1a9f0117ef38a3df4b526\";a:2:{s:4:\"name\";s:14:\"Manager Module\";s:5:\"value\";N;}s:32:\"86aabab43ca86c0fb8f61f5a8e0abfc2\";a:2:{s:4:\"name\";s:12:\"Manager Page\";s:5:\"value\";N;}s:32:\"72f14339ff02a69f691311cd54ed61fd\";a:2:{s:4:\"name\";s:15:\"Manager Plugins\";s:5:\"value\";N;}s:32:\"8108a6e213503016830b51831e938a06\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"c8e3bce21e386602ae168af717ed5732\";a:2:{s:4:\"name\";s:6:\"Search\";s:5:\"value\";N;}s:32:\"dd6f8071a9c6f4f651bd149f03e0a078\";a:2:{s:4:\"name\";s:13:\"Configuration\";s:5:\"value\";N;}s:32:\"1280be03f83aa0a0233d5773117012f7\";a:2:{s:4:\"name\";s:6:\"Module\";s:5:\"value\";N;}s:32:\"d88c7389f879372a2294d6e0339db5b5\";a:2:{s:4:\"name\";s:12:\"Error :class\";s:5:\"value\";N;}s:32:\"d24584099f4c18f1cbe630e42bd28e0e\";a:2:{s:4:\"name\";s:6:\"Plugin\";s:5:\"value\";N;}s:32:\"091c6db51ffe68a6319dbd38de2ca191\";a:2:{s:4:\"name\";s:4:\"Blog\";s:5:\"value\";N;}s:32:\"62e8ea7f29a166bb4a7c5017a8383e6f\";a:2:{s:4:\"name\";s:8:\"Category\";s:5:\"value\";N;}s:32:\"8b790d36a6f1cac6a219fb1951ae8b0a\";a:2:{s:4:\"name\";s:7:\"Comment\";s:5:\"value\";N;}s:32:\"4ecbf1634a3e4e1e2753a299b070d9b0\";a:2:{s:4:\"name\";s:12:\"Manager Post\";s:5:\"value\";N;}s:32:\"c2b0c74543d0ec15a11b2ee1d2e34643\";a:2:{s:4:\"name\";s:7:\"Members\";s:5:\"value\";N;}s:32:\"384e97614d7734eee709c4d1a545767c\";a:2:{s:4:\"name\";s:5:\"Users\";s:5:\"value\";N;}s:32:\"e55863d457dd9473186427730f3c2994\";a:2:{s:4:\"name\";s:4:\"Role\";s:5:\"value\";N;}s:32:\"e70ed0291c0813727fc7cffdde52a41e\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"89be00f9644d7e4fe24a5afccf23181a\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"253c79cc37c07c30b4854d5be5f39763\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"22e6132fff18fbfd8fa43b0d32bc1c9a\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"b628564009e1802e3c8ac78518858d70\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"f17cfd1f21ddeeb109300ade810d1408\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"a4c7dc56186aaf14cb52b6ad6e320d91\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"be013f3a6d6715a1c8d71f78afc27c85\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"5e9de4614577a55731770828b4aba6db\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"6b9a32f46538611d4a68a2e495a727db\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"82a53d2bd9095f91036742bd7562dd70\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"0dbb53b31dc5a2711c1cea33bf4c862d\";a:2:{s:4:\"name\";s:18:\"Manager User Admin\";s:5:\"value\";N;}s:32:\"526258c9809c7c9ffb2734f60f35e967\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}}}'),
(3, 'core:layout', 'option', 'a:1:{s:4:\"data\";a:2:{s:7:\"columns\";a:6:{s:2:\"id\";s:2:\"id\";s:4:\"name\";s:4:\"name\";s:4:\"type\";s:4:\"type\";s:6:\"status\";s:6:\"status\";s:10:\"created_at\";s:10:\"created_at\";s:10:\"updated_at\";s:10:\"updated_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"35\";}}}'),
(4, 'core:page', 'option', 'a:1:{s:4:\"data\";a:2:{s:7:\"columns\";a:5:{s:2:\"id\";s:2:\"id\";s:5:\"title\";s:5:\"title\";s:6:\"status\";s:6:\"status\";s:10:\"created_at\";s:10:\"created_at\";s:10:\"updated_at\";s:10:\"updated_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"20\";}}}'),
(5, 'blog:category', 'category', 'a:1:{s:4:\"data\";a:2:{i:0;a:2:{s:4:\"name\";s:4:\"game\";s:2:\"id\";s:2:\"21\";}i:1;a:3:{s:4:\"name\";s:3:\"abc\";s:2:\"id\";s:2:\"12\";s:8:\"children\";a:2:{i:0;a:3:{s:4:\"name\";s:3:\"mmm\";s:2:\"id\";s:2:\"16\";s:8:\"children\";a:1:{i:0;a:2:{s:4:\"name\";s:4:\"cccc\";s:2:\"id\";s:2:\"18\";}}}i:1;a:2:{s:4:\"name\";s:3:\"bbb\";s:2:\"id\";s:2:\"19\";}}}}}'),
(7, 'core:user:list', 'option', 'a:1:{s:4:\"data\";a:2:{s:7:\"columns\";a:7:{s:2:\"id\";s:2:\"id\";s:4:\"name\";s:4:\"name\";s:8:\"username\";s:8:\"username\";s:6:\"avatar\";s:6:\"avatar\";s:6:\"status\";s:6:\"status\";s:10:\"created_at\";s:10:\"created_at\";s:10:\"updated_at\";s:10:\"updated_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"20\";}}}'),
(8, 'system', 'config', 'a:1:{s:4:\"data\";a:1:{s:4:\"core\";a:9:{s:9:\"site_name\";s:7:\"Zoe CMS\";s:9:\"time_zone\";s:16:\"Asia/Ho_Chi_Minh\";s:10:\"short_date\";s:5:\"d-m-Y\";s:9:\"long_date\";s:5:\"M d Y\";s:13:\"site_language\";s:2:\"vi\";s:18:\"site_meta_keywords\";N;s:21:\"site_meta_description\";N;s:16:\"google_analytics\";N;s:24:\"google_site_verification\";s:43:\"hs2Js3WGGpf1pzyhUNehvVDSIrmO3XZpm7PggNZECxE\";}}}'),
(9, 'blog', 'config', 'a:1:{s:4:\"data\";a:1:{s:4:\"post\";a:3:{s:8:\"language\";s:2:\"vi\";s:5:\"image\";a:3:{s:5:\"width\";s:3:\"150\";s:6:\"height\";s:3:\"150\";s:4:\"unit\";s:2:\"px\";}s:14:\"items_per_page\";s:2:\"20\";}}}'),
(10, 'user', 'config', 'a:1:{s:4:\"data\";a:8:{s:9:\"allow_reg\";s:1:\"1\";s:11:\"allow_login\";s:1:\"1\";s:13:\"enable_active\";s:1:\"1\";s:12:\"welcom_email\";s:1:\"1\";s:19:\"user_minimum_length\";s:1:\"6\";s:18:\"pwd_minimum_length\";s:1:\"6\";s:13:\"login_attemps\";s:2:\"10\";s:15:\"activation_time\";s:1:\"5\";}}'),
(12, 'lists', 'plugin', 'a:1:{s:4:\"data\";a:8:{s:9:\"Mega Menu\";i:1566890966;s:6:\"Backup\";i:1566923832;s:6:\"Layout\";i:1567309777;s:7:\"Builder\";i:1567314372;s:7:\"Comment\";i:1567314329;s:8:\"MegaMenu\";i:1567351751;s:7:\"Gallery\";i:1567440116;s:12:\"Announcement\";i:1567440120;}}'),
(14, 'active', 'theme', 'a:1:{s:4:\"data\";s:3:\"zoe\";}'),
(15, 'core:blog:post', 'option', 'a:2:{s:4:\"data\";a:2:{s:7:\"columns\";a:6:{s:2:\"id\";s:2:\"id\";s:5:\"title\";s:5:\"title\";s:5:\"image\";s:5:\"image\";s:6:\"status\";s:6:\"status\";s:5:\"views\";s:5:\"views\";s:10:\"created_at\";s:10:\"created_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"20\";}}s:4:\"lang\";N;}');

-- --------------------------------------------------------

--
-- Table structure for table `cms_layout`
--

CREATE TABLE `cms_layout` (
  `id` int(5) NOT NULL,
  `token` varchar(255) NOT NULL,
  `theme` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `type_group` varchar(20) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_layout`
--

INSERT INTO `cms_layout` (`id`, `token`, `theme`, `name`, `type_group`, `slug`, `type`, `status`, `content`, `created_at`, `updated_at`) VALUES
(7, '094bde12-ffeb-4fdc-ae8e-a5c1a80e2d9f', 'zoe', 'Home', 'theme', 'home', 'layout', 1, 'YToyOntzOjQ6ImRhdGEiO2E6Mjp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6Nzp7czo1OiJ0aXRsZSI7czowOiIiO3M6NDoiZnVuYyI7czo5OiJObyBBY3Rpb24iO3M6NDoidmlldyI7czowOiIiO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6MzoidGFnIjtzOjQ6Im5vbmUiO3M6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjE6e2k6MDtzOjg6Im1haW5tZW51Ijt9czo1OiJibGFkZSI7YTowOnt9fXM6MjoiaWQiO3M6MzY6Ijg2NTgwOWI3LTRhMDUtZjE4Ni04MzdiLTIwNGU2MGYzNzlkZSI7fXM6Mzoic3RnIjthOjM6e3M6MzoiY29sIjthOjE6e2k6MDtzOjI6IjEyIjt9czo0OiJ0eXBlIjtzOjQ6ImdpcmQiO3M6NToicGxhY2UiO2E6MTp7aTowO3M6OToiMTM0NTM0ODk2Ijt9fXM6Mzoib3B0IjthOjE6e3M6NDoiYXR0ciI7YToyOntzOjU6ImNsYXNzIjtzOjA6IiI7czoyOiJpZCI7czowOiIiO319fXM6NDoidmlldyI7YToxOntpOjA7YToyOntpOjA7czozNjoiYmZlNGExYTYtMjcyYi1lMzI1LTUxODUtNGY2ZDJhMWQ4NzgwIjtpOjE7czozNjoiYzAxNzUxYTktMDFlMi03ZmViLTk5ZjctNzY5Yjc1OWFiYjQyIjt9fX19aToxO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6ODp7czo1OiJ0aXRsZSI7czoxNToiaG9tZXBhZ2Utc2xpZGVyIjtzOjQ6ImZ1bmMiO3M6OToiTm8gQWN0aW9uIjtzOjQ6InZpZXciO3M6MDoiIjtzOjY6InN0YXR1cyI7czoxOiIxIjtzOjY6InB1YmxpYyI7czoxOiIwIjtzOjM6InRhZyI7czo1OiJibG9jayI7czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiIxZTk0MGQyYi04MTdjLWQ0NjMtOThlMi0wODNkNTMwOWY1NzYiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjEwOiIyMDgzMDQzNzQzIjt9fXM6Mzoib3B0IjthOjE6e3M6NDoiYXR0ciI7YToyOntzOjU6ImNsYXNzIjtzOjE1OiJob21lcGFnZS1zbGlkZXIiO3M6MjoiaWQiO3M6MDoiIjt9fX1zOjQ6InZpZXciO2E6MTp7aTowO2E6Mzp7aTowO3M6MzY6ImQ5OWNlYmM4LTY3YzUtY2NmMy01MzBlLTI2ZDRlNzFhNGFkZSI7aToxO3M6MzY6IjFjOTRmMTk1LWJmYzYtNGExMy1hZTI2LWEyNDY5MTQxNmJkZCI7aToyO3M6MzY6IjZlOWRkODBhLTJiMTgtOWY5Mi0zMjAyLTgyYmJlMDYyZjFmNCI7fX19fX1zOjY6IndpZGdldCI7YTo1OntzOjM2OiJiZmU0YTFhNi0yNzJiLWUzMjUtNTE4NS00ZjZkMmExZDg3ODAiO2E6Mzp7czozOiJjZmciO2E6MTA6e3M6NToidGl0bGUiO3M6MDoiIjtzOjQ6ImZ1bmMiO3M6OToiTm8gQWN0aW9uIjtzOjQ6InZpZXciO3M6Mzc6InRoZW1lOjp3aWRnZXRzLm1lbnUtZXh0cmFzLnZpZXdzLm1haW4iO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NzoiZHluYW1pYyI7czoxOiIwIjtzOjY6InJlbmRlciI7czo0OiJodG1sIjtzOjg6InRlbXBsYXRlIjthOjI6e3M6NDoidmlldyI7czoxOiIwIjtzOjQ6ImRhdGEiO2E6Mzp7aTowO3M6MDoiIjtpOjE7czowOiIiO2k6MjtzOjA6IiI7fX1zOjg6ImNvbXBpbGVyIjthOjI6e3M6NDoiZ3JpZCI7YTowOnt9czo1OiJibGFkZSI7YTowOnt9fXM6MjoiaWQiO3M6MzY6ImJmZTRhMWE2LTI3MmItZTMyNS01MTg1LTRmNmQyYTFkODc4MCI7fXM6Mzoic3RnIjthOjY6e3M6Njoic3lzdGVtIjtzOjU6InRoZW1lIjtzOjY6Im1vZHVsZSI7czozOiJ6b2UiO3M6NDoidHlwZSI7czo3OiJ3aWRnZXRzIjtzOjM6InBvcyI7czo4OiJmcm9udGVuZCI7czo2OiJsYXlvdXQiO3M6Njoid2lkZ2V0IjtzOjQ6Im5hbWUiO3M6MTE6Im1lbnUtZXh0cmFzIjt9czozOiJvcHQiO2E6MDp7fX1zOjM2OiJjMDE3NTFhOS0wMWUyLTdmZWItOTlmNy03NjliNzU5YWJiNDIiO2E6Mzp7czozOiJjZmciO2E6MTA6e3M6NToidGl0bGUiO3M6MDoiIjtzOjQ6ImZ1bmMiO3M6OToiTm8gQWN0aW9uIjtzOjQ6InZpZXciO3M6Mzg6InRoZW1lOjpjb21wb25lbnRzLm1lZ2EtbWVudS52aWV3cy5tYWluIjtzOjY6InN0YXR1cyI7czoxOiIxIjtzOjY6InB1YmxpYyI7czoxOiIwIjtzOjc6ImR5bmFtaWMiO3M6MToiMCI7czo2OiJyZW5kZXIiO3M6NDoiaHRtbCI7czo4OiJ0ZW1wbGF0ZSI7YToyOntzOjQ6InZpZXciO3M6MToiMCI7czo0OiJkYXRhIjthOjM6e2k6MDtzOjA6IiI7aToxO3M6MDoiIjtpOjI7czowOiIiO319czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiJjMDE3NTFhOS0wMWUyLTdmZWItOTlmNy03NjliNzU5YWJiNDIiO31zOjM6InN0ZyI7YTo3OntzOjY6InN5c3RlbSI7czo2OiJwbHVnaW4iO3M6NjoibW9kdWxlIjtzOjg6Ik1lZ2FNZW51IjtzOjQ6InR5cGUiO3M6MTA6ImNvbXBvbmVudHMiO3M6MzoicG9zIjtzOjA6IiI7czo2OiJsYXlvdXQiO3M6NjoibGF5b3V0IjtzOjQ6Im5hbWUiO3M6OToibWVnYS1tZW51IjtzOjQ6Im1haW4iO2E6MTp7czoxMzoiTWVnYU1lbnVcbWFpbiI7czo0OiJkYXRhIjt9fXM6Mzoib3B0IjthOjA6e319czozNjoiZDk5Y2ViYzgtNjdjNS1jY2YzLTUzMGUtMjZkNGU3MWE0YWRlIjthOjY6e3M6MzoiY2ZnIjthOjEwOntzOjU6InRpdGxlIjtzOjY6InNsaWRlciI7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjMyOiJ0aGVtZTo6d2lkZ2V0cy5zbGlkZXIudmlld3MubWFpbiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo2OiJwdWJsaWMiO3M6MToiMCI7czo3OiJkeW5hbWljIjtzOjE6IjAiO3M6NjoicmVuZGVyIjtzOjQ6Imh0bWwiO3M6ODoidGVtcGxhdGUiO2E6Mjp7czo0OiJ2aWV3IjtzOjE6IjAiO3M6NDoiZGF0YSI7YTozOntpOjA7czowOiIiO2k6MTtzOjA6IiI7aToyO3M6MDoiIjt9fXM6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjA6e31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiZDk5Y2ViYzgtNjdjNS1jY2YzLTUzMGUtMjZkNGU3MWE0YWRlIjt9czozOiJzdGciO2E6Njp7czo2OiJzeXN0ZW0iO3M6NToidGhlbWUiO3M6NjoibW9kdWxlIjtzOjM6InpvZSI7czo0OiJ0eXBlIjtzOjc6IndpZGdldHMiO3M6MzoicG9zIjtzOjg6ImZyb250ZW5kIjtzOjY6ImxheW91dCI7czo2OiJ3aWRnZXQiO3M6NDoibmFtZSI7czo2OiJzbGlkZXIiO31zOjM6Im9wdCI7YToyOntzOjU6Imxpc3RzIjthOjM6e2k6MDthOjU6e3M6NDoibmFtZSI7czoxMDoiUmVzcG9uc2l2ZSI7czo0OiJsaW5rIjtzOjE3OiJiYWNrZW5kOnBhZ2U6bGlzdCI7czo1OiJpbWFnZSI7czo0MDoidGhlbWUvem9lL2ltZy9ob21lcGFnZS1zbGlkZXIvc2xpZGUxLnBuZyI7czo0OiJpbmZvIjtzOjYwOiJJdCBsb29rcyBncmVhdCBvbiBkZXNrdG9wcywgbGFwdG9wcywgdGFibGV0cyBhbmQgc21hcnRwaG9uZXMiO3M6MjoiYmciO3M6MzoiYmcxIjt9aToxO2E6NTp7czo0OiJuYW1lIjtzOjEzOiJDb2xvciBTY2hlbWVzIjtzOjQ6ImxpbmsiO3M6MTc6ImJhY2tlbmQ6cGFnZTplZGl0IjtzOjU6ImltYWdlIjtzOjQwOiJ0aGVtZS96b2UvaW1nL2hvbWVwYWdlLXNsaWRlci9zbGlkZTIucG5nIjtzOjQ6ImluZm8iO3M6NTg6IkNvbWVzIHdpdGggNSBjb2xvciBzY2hlbWVzIGFuZCBpdCdzIGVhc3kgdG8gbWFrZSB5b3VyIG93biEiO3M6MjoiYmciO3M6MzoiYmcyIjt9aToyO2E6NTp7czo0OiJuYW1lIjtzOjEyOiJGZWF0dXJlIFJpY2giO3M6NDoibGluayI7czoxOToiYmFja2VuZDpwbHVnaW46bGlzdCI7czo1OiJpbWFnZSI7czo0MDoidGhlbWUvem9lL2ltZy9ob21lcGFnZS1zbGlkZXIvc2xpZGUzLnBuZyI7czo0OiJpbmZvIjtzOjUxOiJIdWdlIGFtb3VudCBvZiBjb21wb25lbnRzIGFuZCBvdmVyIDMwIHNhbXBsZSBwYWdlcyEiO3M6MjoiYmciO3M6MzoiYmczIjt9fXM6NToicGFyYW0iO2E6Mzp7aTowO2E6MTp7czo0OiJsaW5rIjtzOjEwOiJ7ImlkIjoiNSJ9Ijt9aToxO2E6MTp7czo0OiJsaW5rIjtzOjExOiJ7ImlkIjoiMTAifSI7fWk6MjthOjE6e3M6NDoibGluayI7czoyOiJ7fSI7fX19czo1OiJsaXN0cyI7YToyOntpOjA7YTozOntzOjQ6Im5hbWUiO3M6NjoibmFtZSAxIjtzOjQ6ImxpbmsiO3M6MTc6ImJhY2tlbmQ6cGFnZTplZGl0IjtzOjU6ImltYWdlIjtzOjc6ImltYWdlIDEiO31pOjE7YTozOntzOjQ6Im5hbWUiO3M6NjoibmFtZSAyIjtzOjQ6ImxpbmsiO3M6MTQ6InBhc3N3b3JkLnJlc2V0IjtzOjU6ImltYWdlIjtzOjc6ImltYWdlIDIiO319czo1OiJwYXJhbSI7YToyOntpOjA7YToxOntzOjQ6ImxpbmsiO3M6MTE6InsiaWQiOiIxMCJ9Ijt9aToxO2E6MTp7czo0OiJsaW5rIjtzOjEwOiJ7ImlkIjoiNSJ9Ijt9fXM6NDoibGFuZyI7YTo0OntzOjU6ImVuLVVTIjthOjY6e3M6MzI6IjBmYjZkMDk3NjRhODBlMDBkMmM1ZjNmYjFkYTdjMzRjIjthOjI6e3M6Mzoia2V5IjtzOjEwOiJSZXNwb25zaXZlIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiI4NjY4OGVkZTlkYmJmNjM3Zjc5MGEzNzc5MzZjNWU1MiI7YToyOntzOjM6ImtleSI7czoxMzoiQ29sb3IgU2NoZW1lcyI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiNGQxOTY1NzQwMTc3MWNmYTIyMjIyYzljMzdkZmY2ZDciO2E6Mjp7czozOiJrZXkiO3M6MTI6IkZlYXR1cmUgUmljaCI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiNmZjZjk0ODlmYzMzOGViMWYzYTg2ODM5YmMyMzRlMDEiO2E6Mjp7czozOiJrZXkiO3M6NTE6Ikh1Z2UgYW1vdW50IG9mIGNvbXBvbmVudHMgYW5kIG92ZXIgMzAgc2FtcGxlIHBhZ2VzISI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiNDVlZGI2YzdlMzA5N2RjMjM5NjM5YzZlZWYxNGIzNzgiO2E6Mjp7czozOiJrZXkiO3M6NjA6Ikl0IGxvb2tzIGdyZWF0IG9uIGRlc2t0b3BzLCBsYXB0b3BzLCB0YWJsZXRzIGFuZCBzbWFydHBob25lcyI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiMGQ4MTEyYTcxYzg0ZDg2NTA3MGUwOThmNjc2ZmM5OTEiO2E6Mjp7czozOiJrZXkiO3M6NTg6IkNvbWVzIHdpdGggNSBjb2xvciBzY2hlbWVzIGFuZCBpdCdzIGVhc3kgdG8gbWFrZSB5b3VyIG93biEiO3M6MzoidmFsIjtzOjA6IiI7fX1zOjI6InZpIjthOjY6e3M6MzI6IjBmYjZkMDk3NjRhODBlMDBkMmM1ZjNmYjFkYTdjMzRjIjthOjI6e3M6Mzoia2V5IjtzOjEwOiJSZXNwb25zaXZlIjtzOjM6InZhbCI7czoxMToixJHDoXAg4bupbmciO31zOjMyOiI4NjY4OGVkZTlkYmJmNjM3Zjc5MGEzNzc5MzZjNWU1MiI7YToyOntzOjM6ImtleSI7czoxMzoiQ29sb3IgU2NoZW1lcyI7czozOiJ2YWwiO3M6MTE6IlBo4buRaSBtw6B1Ijt9czozMjoiNGQxOTY1NzQwMTc3MWNmYTIyMjIyYzljMzdkZmY2ZDciO2E6Mjp7czozOiJrZXkiO3M6MTI6IkZlYXR1cmUgUmljaCI7czozOiJ2YWwiO3M6MjI6IlTDrW5oIG7Eg25nIHBob25nIHBow7oiO31zOjMyOiI2ZmNmOTQ4OWZjMzM4ZWIxZjNhODY4MzliYzIzNGUwMSI7YToyOntzOjM6ImtleSI7czo1MToiSHVnZSBhbW91bnQgb2YgY29tcG9uZW50cyBhbmQgb3ZlciAzMCBzYW1wbGUgcGFnZXMhIjtzOjM6InZhbCI7czo2MzoiU+G7kSBsxrDhu6NuZyBs4bubbiBjw6FjIHRow6BuaCBwaOG6p24gdsOgIGjGoW4gMzAgdHJhbmcgbeG6q3UhIjt9czozMjoiNDVlZGI2YzdlMzA5N2RjMjM5NjM5YzZlZWYxNGIzNzgiO2E6Mjp7czozOiJrZXkiO3M6NjA6Ikl0IGxvb2tzIGdyZWF0IG9uIGRlc2t0b3BzLCBsYXB0b3BzLCB0YWJsZXRzIGFuZCBzbWFydHBob25lcyI7czozOiJ2YWwiO3M6MTI2OiIgTsOzIHRyw7RuZyB0dXnhu4d0IHbhu51pIHRyw6puIG3DoXkgdMOtbmggxJHhu4MgYsOgbiwgbcOheSB0w61uaCB4w6FjaCB0YXksIG3DoXkgdMOtbmggYuG6o25nIHbDoCDEkWnhu4duIHRob+G6oWkgdGjDtG5nIG1pbmgiO31zOjMyOiIwZDgxMTJhNzFjODRkODY1MDcwZTA5OGY2NzZmYzk5MSI7YToyOntzOjM6ImtleSI7czo1ODoiQ29tZXMgd2l0aCA1IGNvbG9yIHNjaGVtZXMgYW5kIGl0J3MgZWFzeSB0byBtYWtlIHlvdXIgb3duISI7czozOiJ2YWwiO3M6ODY6IiDEkGkga8OobSB24bubaSA1IGPDoWNoIHBo4buRaSBtw6B1IHbDoCB0aOG6rXQgZOG7hSBkw6BuZyDEkeG7gyBsw6BtIGNobyByacOqbmcgYuG6oW4hIjt9fXM6MjoiamEiO2E6Njp7czozMjoiMGZiNmQwOTc2NGE4MGUwMGQyYzVmM2ZiMWRhN2MzNGMiO2E6Mjp7czozOiJrZXkiO3M6MTA6IlJlc3BvbnNpdmUiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6Ijg2Njg4ZWRlOWRiYmY2MzdmNzkwYTM3NzkzNmM1ZTUyIjthOjI6e3M6Mzoia2V5IjtzOjEzOiJDb2xvciBTY2hlbWVzIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiI0ZDE5NjU3NDAxNzcxY2ZhMjIyMjJjOWMzN2RmZjZkNyI7YToyOntzOjM6ImtleSI7czoxMjoiRmVhdHVyZSBSaWNoIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiI2ZmNmOTQ4OWZjMzM4ZWIxZjNhODY4MzliYzIzNGUwMSI7YToyOntzOjM6ImtleSI7czo1MToiSHVnZSBhbW91bnQgb2YgY29tcG9uZW50cyBhbmQgb3ZlciAzMCBzYW1wbGUgcGFnZXMhIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiI0NWVkYjZjN2UzMDk3ZGMyMzk2MzljNmVlZjE0YjM3OCI7YToyOntzOjM6ImtleSI7czo2MDoiSXQgbG9va3MgZ3JlYXQgb24gZGVza3RvcHMsIGxhcHRvcHMsIHRhYmxldHMgYW5kIHNtYXJ0cGhvbmVzIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiIwZDgxMTJhNzFjODRkODY1MDcwZTA5OGY2NzZmYzk5MSI7YToyOntzOjM6ImtleSI7czo1ODoiQ29tZXMgd2l0aCA1IGNvbG9yIHNjaGVtZXMgYW5kIGl0J3MgZWFzeSB0byBtYWtlIHlvdXIgb3duISI7czozOiJ2YWwiO3M6MDoiIjt9fXM6NToiemgtY24iO2E6Njp7czozMjoiMGZiNmQwOTc2NGE4MGUwMGQyYzVmM2ZiMWRhN2MzNGMiO2E6Mjp7czozOiJrZXkiO3M6MTA6IlJlc3BvbnNpdmUiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6Ijg2Njg4ZWRlOWRiYmY2MzdmNzkwYTM3NzkzNmM1ZTUyIjthOjI6e3M6Mzoia2V5IjtzOjEzOiJDb2xvciBTY2hlbWVzIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiI0ZDE5NjU3NDAxNzcxY2ZhMjIyMjJjOWMzN2RmZjZkNyI7YToyOntzOjM6ImtleSI7czoxMjoiRmVhdHVyZSBSaWNoIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiI2ZmNmOTQ4OWZjMzM4ZWIxZjNhODY4MzliYzIzNGUwMSI7YToyOntzOjM6ImtleSI7czo1MToiSHVnZSBhbW91bnQgb2YgY29tcG9uZW50cyBhbmQgb3ZlciAzMCBzYW1wbGUgcGFnZXMhIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiI0NWVkYjZjN2UzMDk3ZGMyMzk2MzljNmVlZjE0YjM3OCI7YToyOntzOjM6ImtleSI7czo2MDoiSXQgbG9va3MgZ3JlYXQgb24gZGVza3RvcHMsIGxhcHRvcHMsIHRhYmxldHMgYW5kIHNtYXJ0cGhvbmVzIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiIwZDgxMTJhNzFjODRkODY1MDcwZTA5OGY2NzZmYzk5MSI7YToyOntzOjM6ImtleSI7czo1ODoiQ29tZXMgd2l0aCA1IGNvbG9yIHNjaGVtZXMgYW5kIGl0J3MgZWFzeSB0byBtYWtlIHlvdXIgb3duISI7czozOiJ2YWwiO3M6MDoiIjt9fX19czozNjoiMWM5NGYxOTUtYmZjNi00YTEzLWFlMjYtYTI0NjkxNDE2YmRkIjthOjQ6e3M6MzoiY2ZnIjthOjEwOntzOjU6InRpdGxlIjtzOjA6IiI7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjM0OiJ0aGVtZTo6d2lkZ2V0cy5jb3ZlcmFnZS52aWV3cy5tYWluIjtzOjY6InN0YXR1cyI7czoxOiIxIjtzOjY6InB1YmxpYyI7czoxOiIwIjtzOjc6ImR5bmFtaWMiO3M6MToiMCI7czo2OiJyZW5kZXIiO3M6NToiYmxhZGUiO3M6ODoidGVtcGxhdGUiO2E6Mjp7czo0OiJ2aWV3IjtzOjE6IjAiO3M6NDoiZGF0YSI7YTozOntpOjA7czowOiIiO2k6MTtzOjA6IiI7aToyO3M6MDoiIjt9fXM6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjA6e31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiMWM5NGYxOTUtYmZjNi00YTEzLWFlMjYtYTI0NjkxNDE2YmRkIjt9czozOiJzdGciO2E6Njp7czo2OiJzeXN0ZW0iO3M6NToidGhlbWUiO3M6NjoibW9kdWxlIjtzOjM6InpvZSI7czo0OiJ0eXBlIjtzOjc6IndpZGdldHMiO3M6MzoicG9zIjtzOjg6ImZyb250ZW5kIjtzOjY6ImxheW91dCI7czo2OiJ3aWRnZXQiO3M6NDoibmFtZSI7czo4OiJjb3ZlcmFnZSI7fXM6Mzoib3B0IjthOjA6e31zOjQ6ImxhbmciO2E6NDp7czo1OiJlbi1VUyI7YToyOntzOjMyOiI3MDhiOWE1ZGFiNWU3ZmE2ZTM5NjAzZTg2OTAxOTUwNyI7YToyOntzOjM6ImtleSI7czo5NjoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSAxIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiJkZGM5OTVjZDI5MGI4MTNlZTk1ODM4OTkzZDNmNGJiNSI7YToyOntzOjM6ImtleSI7czo5NjoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSAyIjtzOjM6InZhbCI7czowOiIiO319czoyOiJ2aSI7YToyOntzOjMyOiI3MDhiOWE1ZGFiNWU3ZmE2ZTM5NjAzZTg2OTAxOTUwNyI7YToyOntzOjM6ImtleSI7czo5NjoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSAxIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiJkZGM5OTVjZDI5MGI4MTNlZTk1ODM4OTkzZDNmNGJiNSI7YToyOntzOjM6ImtleSI7czo5NjoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSAyIjtzOjM6InZhbCI7czowOiIiO319czoyOiJqYSI7YToyOntzOjMyOiI3MDhiOWE1ZGFiNWU3ZmE2ZTM5NjAzZTg2OTAxOTUwNyI7YToyOntzOjM6ImtleSI7czo5NjoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSAxIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiJkZGM5OTVjZDI5MGI4MTNlZTk1ODM4OTkzZDNmNGJiNSI7YToyOntzOjM6ImtleSI7czo5NjoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSAyIjtzOjM6InZhbCI7czowOiIiO319czo1OiJ6aC1jbiI7YToyOntzOjMyOiI3MDhiOWE1ZGFiNWU3ZmE2ZTM5NjAzZTg2OTAxOTUwNyI7YToyOntzOjM6ImtleSI7czo5NjoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSAxIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiJkZGM5OTVjZDI5MGI4MTNlZTk1ODM4OTkzZDNmNGJiNSI7YToyOntzOjM6ImtleSI7czo5NjoiTW9yYmkgZWxlaWZlbmQgY29uZ3VlIGVsaXQgbmVjIHNhZ2l0dGlzLiBQcmFlc2VudCBhbGlxdWFtIGxvYm9ydGlzIHRlbGx1cywgbmVjIGNvbnNlcXVhdCB2aXRhZSAyIjtzOjM6InZhbCI7czowOiIiO319fX1zOjM2OiI2ZTlkZDgwYS0yYjE4LTlmOTItMzIwMi04MmJiZTA2MmYxZjQiO2E6NDp7czozOiJjZmciO2E6MTA6e3M6NToidGl0bGUiO3M6MDoiIjtzOjQ6ImZ1bmMiO3M6OToiTm8gQWN0aW9uIjtzOjQ6InZpZXciO3M6MzQ6InRoZW1lOjp3aWRnZXRzLnNlcnZpY2VzLnZpZXdzLm1haW4iO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NzoiZHluYW1pYyI7czoxOiIwIjtzOjY6InJlbmRlciI7czo0OiJodG1sIjtzOjg6InRlbXBsYXRlIjthOjI6e3M6NDoidmlldyI7czoxOiIwIjtzOjQ6ImRhdGEiO2E6Mzp7aTowO3M6MDoiIjtpOjE7czowOiIiO2k6MjtzOjA6IiI7fX1zOjg6ImNvbXBpbGVyIjthOjI6e3M6NDoiZ3JpZCI7YTowOnt9czo1OiJibGFkZSI7YTowOnt9fXM6MjoiaWQiO3M6MzY6IjZlOWRkODBhLTJiMTgtOWY5Mi0zMjAyLTgyYmJlMDYyZjFmNCI7fXM6Mzoic3RnIjthOjY6e3M6Njoic3lzdGVtIjtzOjU6InRoZW1lIjtzOjY6Im1vZHVsZSI7czozOiJ6b2UiO3M6NDoidHlwZSI7czo3OiJ3aWRnZXRzIjtzOjM6InBvcyI7czo4OiJmcm9udGVuZCI7czo2OiJsYXlvdXQiO3M6Njoid2lkZ2V0IjtzOjQ6Im5hbWUiO3M6ODoic2VydmljZXMiO31zOjM6Im9wdCI7YToyOntzOjU6Imxpc3RzIjthOjM6e2k6MDthOjU6e3M6NDoibmFtZSI7czoyMToiQWxpcXVhbSBpbiBhZGlwaXNjaW5nIjtzOjQ6ImxpbmsiO3M6MTc6ImJhY2tlbmQ6cGFnZTpsaXN0IjtzOjQ6Imljb24iO3M6Mjg6ImltZy9zZXJ2aWNlLWljb24vZGlhbW9uZC5wbmciO3M6NjoidGFyZ2V0IjtzOjY6Il9ibGFuayI7czo0OiJpbmZvIjtzOjEyNToiUHJhZXNlbnQgcmhvbmN1cyBtYXVyaXMgYWMgc29sbGljaXR1ZGluIHZlaGljdWxhLiBOYW0gZnJpbmdpbGxhIHR1cnBpcyB0dXJwaXMsIGF0IHBvc3VlcmUgdHVycGlzIGFsaXF1ZXQgc2l0IGFtZXQgY29uZGltZW50dW0iO31pOjE7YTo1OntzOjQ6Im5hbWUiO3M6MTY6IkN1cmFiaXR1ciBtb2xsaXMiO3M6NDoibGluayI7czoyMToiYmFja2VuZDpsYW5ndWFnZTpsaXN0IjtzOjQ6Imljb24iO3M6MjY6ImltZy9zZXJ2aWNlLWljb24vcnVsZXIucG5nIjtzOjY6InRhcmdldCI7czo2OiJfYmxhbmsiO3M6NDoiaW5mbyI7czoxMjg6IlN1c3BlbmRpc3NlIGVnZXQgbGliZXJvIG1pLiBGdXNjZSBsaWd1bGEgb3JjaSwgdnVscHV0YXRlIG5lYyBlbGl0IHVsdHJpY2VzLCBvcm5hcmUgZmF1Y2lidXMgb3JjaS4gQWVuZWFuIGxlY3R1cyBzYXBpZW4sIHZlaGljdWxhIjt9aToyO2E6NTp7czo0OiJuYW1lIjtzOjE0OiJWaXZhbXVzIG1hdHRpcyI7czo0OiJsaW5rIjtzOjE5OiJiYWNrZW5kOmxheW91dDpsaXN0IjtzOjQ6Imljb24iO3M6MjQ6ImltZy9zZXJ2aWNlLWljb24vYm94LnBuZyI7czo2OiJ0YXJnZXQiO3M6NjoiX2JsYW5rIjtzOjQ6ImluZm8iO3M6MTM0OiJQaGFzZWxsdXMgcG9zdWVyZSBldCBuaXNsIGFjIGNvbW1vZG8uIE51bGxhIGZhY2lsaXNpLiBTZWQgdGluY2lkdW50IGJpYmVuZHVtIGN1cnN1cy4gQWVuZWFuIHZ1bHB1dGF0ZSBhbGlxdWFtIHJpc3VzIHJ1dHJ1bSBzY2VsZXJpc3F1ZSI7fX1zOjU6InBhcmFtIjthOjM6e2k6MDthOjE6e3M6NDoibGluayI7czoyOiJ7fSI7fWk6MTthOjE6e3M6NDoibGluayI7czoyOiJ7fSI7fWk6MjthOjE6e3M6NDoibGluayI7czoyOiJ7fSI7fX19czo0OiJsYW5nIjthOjQ6e3M6NToiZW4tVVMiO2E6NDp7czozMjoiZjk5YzFmNDA1MmI0OTRmZmMzZjQ0NGNmM2Q5NzY5YzIiO2E6Mjp7czozOiJrZXkiO3M6MjE6IkFsaXF1YW0gaW4gYWRpcGlzY2luZyI7czozOiJ2YWwiO3M6MTc6IiBsaXZlIHJlYWwgZXN0YXRlIjt9czozMjoiYzViYzQxMzYzZTZjYjVkNTNlMDY1Y2YxZWE2OTc5YWEiO2E6Mjp7czozOiJrZXkiO3M6MTY6IkN1cmFiaXR1ciBtb2xsaXMiO3M6MzoidmFsIjtzOjEwOiIgY2hhdCBzb2Z0Ijt9czozMjoiYTQwNzYyN2JiM2M1YTcxMDQxMGY1OTE0M2UyZGNiNWUiO2E6Mjp7czozOiJrZXkiO3M6MTQ6IlZpdmFtdXMgbWF0dGlzIjtzOjM6InZhbCI7czoxNzoiIGxpdmUgcmVhbCBlc3RhdGUiO31zOjMyOiIyODFmY2RmOWYxMzk0ODcyNmFlMjNkNmVmZDRiMDFhOSI7YToyOntzOjM6ImtleSI7czo5OiJSZWFkIG1vcmUiO3M6MzoidmFsIjtzOjk6IlJlYWQgbW9yZSI7fX1zOjI6InZpIjthOjQ6e3M6MzI6ImY5OWMxZjQwNTJiNDk0ZmZjM2Y0NDRjZjNkOTc2OWMyIjthOjI6e3M6Mzoia2V5IjtzOjIxOiJBbGlxdWFtIGluIGFkaXBpc2NpbmciO3M6MzoidmFsIjtzOjI5OiJUcm9uZyBt4buZdCBz4buRIMSR4bqhaSBo4buNYyI7fXM6MzI6ImM1YmM0MTM2M2U2Y2I1ZDUzZTA2NWNmMWVhNjk3OWFhIjthOjI6e3M6Mzoia2V5IjtzOjE2OiJDdXJhYml0dXIgbW9sbGlzIjtzOjM6InZhbCI7czoxOToiVHLDsiBjaHV54buHbiBt4buBbSI7fXM6MzI6ImE0MDc2MjdiYjNjNWE3MTA0MTBmNTkxNDNlMmRjYjVlIjthOjI6e3M6Mzoia2V5IjtzOjE0OiJWaXZhbXVzIG1hdHRpcyI7czozOiJ2YWwiO3M6MjY6ImLhuqV0IMSR4buZbmcgc+G6o24gc+G7kW5nIjt9czozMjoiMjgxZmNkZjlmMTM5NDg3MjZhZTIzZDZlZmQ0YjAxYTkiO2E6Mjp7czozOiJrZXkiO3M6OToiUmVhZCBtb3JlIjtzOjM6InZhbCI7czoxMjoixJDhu41jIHRow6ptIjt9fXM6MjoiamEiO2E6NDp7czozMjoiZjk5YzFmNDA1MmI0OTRmZmMzZjQ0NGNmM2Q5NzY5YzIiO2E6Mjp7czozOiJrZXkiO3M6MjE6IkFsaXF1YW0gaW4gYWRpcGlzY2luZyI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiYzViYzQxMzYzZTZjYjVkNTNlMDY1Y2YxZWE2OTc5YWEiO2E6Mjp7czozOiJrZXkiO3M6MTY6IkN1cmFiaXR1ciBtb2xsaXMiO3M6MzoidmFsIjtzOjA6IiI7fXM6MzI6ImE0MDc2MjdiYjNjNWE3MTA0MTBmNTkxNDNlMmRjYjVlIjthOjI6e3M6Mzoia2V5IjtzOjE0OiJWaXZhbXVzIG1hdHRpcyI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiMjgxZmNkZjlmMTM5NDg3MjZhZTIzZDZlZmQ0YjAxYTkiO2E6Mjp7czozOiJrZXkiO3M6OToiUmVhZCBtb3JlIjtzOjM6InZhbCI7czowOiIiO319czo1OiJ6aC1jbiI7YTo0OntzOjMyOiJmOTljMWY0MDUyYjQ5NGZmYzNmNDQ0Y2YzZDk3NjljMiI7YToyOntzOjM6ImtleSI7czoyMToiQWxpcXVhbSBpbiBhZGlwaXNjaW5nIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiJjNWJjNDEzNjNlNmNiNWQ1M2UwNjVjZjFlYTY5NzlhYSI7YToyOntzOjM6ImtleSI7czoxNjoiQ3VyYWJpdHVyIG1vbGxpcyI7czozOiJ2YWwiO3M6MDoiIjt9czozMjoiYTQwNzYyN2JiM2M1YTcxMDQxMGY1OTE0M2UyZGNiNWUiO2E6Mjp7czozOiJrZXkiO3M6MTQ6IlZpdmFtdXMgbWF0dGlzIjtzOjM6InZhbCI7czowOiIiO31zOjMyOiIyODFmY2RmOWYxMzk0ODcyNmFlMjNkNmVmZDRiMDFhOSI7YToyOntzOjM6ImtleSI7czo5OiJSZWFkIG1vcmUiO3M6MzoidmFsIjtzOjA6IiI7fX19fX19', '2019-08-02 21:54:56', '2019-09-08 16:54:58'),
(8, '43cf4e41-5e88-4163-88e2-e8dd47c9eae7', 'zoe', 'demo', '', 'demo', 'layout', 1, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6NDp7czo4OiJjb21waWxlciI7YTowOnt9czozOiJ0YWciO3M6NDoibm9uZSI7czo2OiJzdGF0dXMiO2k6MTtzOjI6ImlkIjtzOjM2OiIxMGFhMGIyZS1kMTE4LWE1N2QtYTA1ZC01ZjIyYzEzY2RmZmMiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjEwOiIxNzkyOTMwNDg1Ijt9fXM6Mzoib3B0IjthOjA6e319czo0OiJ2aWV3IjthOjE6e2k6MDthOjE6e2k6MDtzOjM2OiI1Y2U0YWFkMy0xMjM3LTcxNzctZjgxZi0wMmEzM2ZkMjU1ZmYiO319fX19czo2OiJ3aWRnZXQiO2E6MTp7czozNjoiNWNlNGFhZDMtMTIzNy03MTc3LWY4MWYtMDJhMzNmZDI1NWZmIjthOjM6e3M6MzoiY2ZnIjthOjg6e3M6NToidGl0bGUiO047czo0OiJmdW5jIjtzOjEzOiJDb21tZW50c1xtYWluIjtzOjQ6InZpZXciO3M6NDM6InBsdWdpbkNvbW1lbnQ6OmNvbXBvbmVudC5jb21tZW50LnZpZXdzLm1haW4iO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6NjoicHVibGljIjtzOjE6IjEiO3M6NzoiZHluYW1pYyI7czoxOiIxIjtzOjg6InRlbXBsYXRlIjthOjI6e3M6NDoidmlldyI7czoxOiIwIjtzOjQ6ImRhdGEiO2E6Mzp7aTowO047aToxO047aToyO047fX1zOjI6ImlkIjtzOjM2OiI1Y2U0YWFkMy0xMjM3LTcxNzctZjgxZi0wMmEzM2ZkMjU1ZmYiO31zOjM6InN0ZyI7YTo2OntzOjY6InN5c3RlbSI7czo2OiJwbHVnaW4iO3M6NjoibW9kdWxlIjtzOjc6IkNvbW1lbnQiO3M6NDoidHlwZSI7czo5OiJjb21wb25lbnQiO3M6MzoicG9zIjtOO3M6NDoibmFtZSI7czo3OiJjb21tZW50IjtzOjQ6Im1haW4iO2E6Mjp7czoxMzoiQ29tbWVudHNcbWFpbiI7czo0OiJkYXRhIjtzOjE2OiJDb21tZW50c1xMaXN0TmV3IjtzOjQ6ImRhdGEiO319czozOiJvcHQiO2E6MTp7czo1OiJsaXN0cyI7YTo0OntpOjA7YTozOntzOjQ6Im5hbWUiO047czo1OiJpbWFnZSI7TjtzOjQ6ImxpbmsiO047fWk6MTthOjM6e3M6NDoibmFtZSI7TjtzOjU6ImltYWdlIjtOO3M6NDoibGluayI7Tjt9aToyO2E6Mzp7czo0OiJuYW1lIjtOO3M6NToiaW1hZ2UiO047czo0OiJsaW5rIjtOO31pOjM7YTozOntzOjQ6Im5hbWUiO047czo1OiJpbWFnZSI7TjtzOjQ6ImxpbmsiO047fX19fX19', '2019-08-13 06:36:50', '2019-08-14 10:21:56'),
(14, 'a0edb072-260e-436e-92e6-9d9857db26c9', 'zoe', 'Home', '', 'home', 'layout', 0, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6NDp7czo4OiJjb21waWxlciI7YTowOnt9czozOiJ0YWciO3M6NDoibm9uZSI7czo2OiJzdGF0dXMiO2k6MTtzOjI6ImlkIjtzOjM2OiJiNzZiZGY0OS1kNGE1LThhNzEtZjJiNy05YzBjYzFjYTVkY2MiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjEwOiIxNzczMjE2ODU2Ijt9fXM6Mzoib3B0IjthOjA6e319czo0OiJ2aWV3IjthOjE6e2k6MDthOjI6e2k6MDtzOjM2OiI1Y2U0YWFkMy0xMjM3LTcxNzctZjgxZi0wMmEzM2ZkMjU1ZmYiO2k6MTtzOjM2OiJhMDJjZTk3NS1hZjU4LTQxZWItM2UyZC04OTYwYjExZGZlZWYiO319fX19czo2OiJ3aWRnZXQiO2E6Mjp7czozNjoiNWNlNGFhZDMtMTIzNy03MTc3LWY4MWYtMDJhMzNmZDI1NWZmIjthOjM6e3M6MzoiY2ZnIjthOjk6e3M6NToidGl0bGUiO3M6NjoiZGVtbyAxIjtzOjQ6ImZ1bmMiO3M6MTM6IkNvbW1lbnRzXG1haW4iO3M6NDoidmlldyI7czo0MzoicGx1Z2luQ29tbWVudDo6Y29tcG9uZW50LmNvbW1lbnQudmlld3MubWFpbiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo2OiJwdWJsaWMiO3M6MToiMSI7czo3OiJkeW5hbWljIjtzOjE6IjEiO3M6ODoidGVtcGxhdGUiO2E6Mjp7czo0OiJ2aWV3IjtzOjE6IjAiO3M6NDoiZGF0YSI7YTozOntpOjA7czowOiIiO2k6MTtzOjA6IiI7aToyO3M6MDoiIjt9fXM6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjA6e31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiNWNlNGFhZDMtMTIzNy03MTc3LWY4MWYtMDJhMzNmZDI1NWZmIjt9czozOiJzdGciO2E6Njp7czo2OiJzeXN0ZW0iO3M6NjoicGx1Z2luIjtzOjY6Im1vZHVsZSI7czo3OiJDb21tZW50IjtzOjQ6InR5cGUiO3M6OToiY29tcG9uZW50IjtzOjM6InBvcyI7TjtzOjQ6Im5hbWUiO3M6NzoiY29tbWVudCI7czo0OiJtYWluIjthOjI6e3M6MTM6IkNvbW1lbnRzXG1haW4iO3M6NDoiZGF0YSI7czoxNjoiQ29tbWVudHNcTGlzdE5ldyI7czo0OiJkYXRhIjt9fXM6Mzoib3B0IjthOjE6e3M6NToibGlzdHMiO2E6NDp7aTowO2E6Mzp7czo0OiJuYW1lIjtzOjA6IiI7czo1OiJpbWFnZSI7czowOiIiO3M6NDoibGluayI7czowOiIiO31pOjE7YTozOntzOjQ6Im5hbWUiO3M6MDoiIjtzOjU6ImltYWdlIjtzOjA6IiI7czo0OiJsaW5rIjtzOjA6IiI7fWk6MjthOjM6e3M6NDoibmFtZSI7czowOiIiO3M6NToiaW1hZ2UiO3M6MDoiIjtzOjQ6ImxpbmsiO3M6MDoiIjt9aTozO2E6Mzp7czo0OiJuYW1lIjtzOjA6IiI7czo1OiJpbWFnZSI7czowOiIiO3M6NDoibGluayI7czowOiIiO319fX1zOjM2OiJhMDJjZTk3NS1hZjU4LTQxZWItM2UyZC04OTYwYjExZGZlZWYiO2E6Mjp7czozOiJjZmciO2E6Nzp7czo1OiJ0aXRsZSI7czo2OiJkZW1vIDIiO3M6NDoiZnVuYyI7czo5OiJObyBBY3Rpb24iO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NzoiZHluYW1pYyI7czoxOiIwIjtzOjg6ImNvbXBpbGVyIjthOjI6e3M6NDoiZ3JpZCI7YTowOnt9czo1OiJibGFkZSI7YTowOnt9fXM6MjoiaWQiO3M6MzY6ImEwMmNlOTc1LWFmNTgtNDFlYi0zZTJkLTg5NjBiMTFkZmVlZiI7fXM6Mzoic3RnIjthOjY6e3M6Njoic3lzdGVtIjtzOjU6InRoZW1lIjtzOjY6Im1vZHVsZSI7czozOiJ6b2UiO3M6NDoidHlwZSI7czo3OiJwYXJ0aWFsIjtzOjI6ImlkIjtzOjE6IjciO3M6NToidG9rZW4iO3M6MzY6IjA5NGJkZTEyLWZmZWItNGZkYy1hZThlLWE1YzFhODBlMmQ5ZiI7czo0OiJuYW1lIjtzOjQ6ImRlbW8iO319fX0=', '2019-08-14 03:11:43', '2019-08-14 10:22:47'),
(15, '7d8b1cf8-6ba6-442c-8305-33b4c5e0040f', 'zoe', 'olala', '', 'olala', 'layout', 1, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6Nzp7czo1OiJ0aXRsZSI7czoyOiJmZyI7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjA6IiI7czo2OiJzdGF0dXMiO3M6MToiMSI7czozOiJ0YWciO3M6NDoibm9uZSI7czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiI5ZGFkMDgxYy04MDYyLTNiNzctZWI0ZC03ZWQ3Y2JlODQ0M2IiO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjk6IjU1ODI0NDkwMiI7fX1zOjM6Im9wdCI7YToxOntzOjQ6ImF0dHIiO2E6Mjp7czo1OiJjbGFzcyI7czowOiIiO3M6MjoiaWQiO3M6MDoiIjt9fX1zOjQ6InZpZXciO2E6MTp7aTowO2E6MDp7fX19fX1zOjY6IndpZGdldCI7YTowOnt9fQ==', '2019-08-24 02:05:30', '2019-08-24 02:05:30'),
(16, 'd2a18129-0003-4ff6-b37c-eb331e9a6d79', 'zoe', 'mega menu', 'theme', 'mega-menu', 'layout', 1, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6Nzp7czo1OiJ0aXRsZSI7czowOiIiO3M6NDoiZnVuYyI7czo5OiJObyBBY3Rpb24iO3M6NDoidmlldyI7czowOiIiO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6MzoidGFnIjtzOjQ6Im5vbmUiO3M6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjA6e31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiMDg2NTBmMDMtMTc4ZC1mMzRkLTMxOTYtNWFlOWE5NzVhNGNiIjt9czozOiJzdGciO2E6Mzp7czozOiJjb2wiO2E6MTp7aTowO3M6MjoiMTIiO31zOjQ6InR5cGUiO3M6NDoiZ2lyZCI7czo1OiJwbGFjZSI7YToxOntpOjA7czoxMDoiMjA4NTQwMzY3MyI7fX1zOjM6Im9wdCI7YToxOntzOjQ6ImF0dHIiO2E6Mjp7czo1OiJjbGFzcyI7czowOiIiO3M6MjoiaWQiO3M6MDoiIjt9fX1zOjQ6InZpZXciO2E6MTp7aTowO2E6Mjp7aTowO3M6MzY6IjIxZjA4YjkxLWRlNTMtYWI3Ny03MGJmLWZkMDMxZjEwYjQ3MSI7aToxO3M6MzY6Ijk2ZTIzNzlmLWE5NjYtYmNjMy01YTlkLTI3ZjNjMmM3ZjUyNCI7fX19fX1zOjY6IndpZGdldCI7YToyOntzOjM2OiIyMWYwOGI5MS1kZTUzLWFiNzctNzBiZi1mZDAzMWYxMGI0NzEiO2E6Mzp7czozOiJjZmciO2E6OTp7czo1OiJ0aXRsZSI7czoyOiJjYyI7czo0OiJmdW5jIjtzOjk6Ik5vIEFjdGlvbiI7czo0OiJ2aWV3IjtzOjQzOiJ0aGVtZTo6Y29tcG9uZW50LnRodW1ibmFpbC1pbWFnZS52aWV3cy5saXN0IjtzOjY6InN0YXR1cyI7czoxOiIxIjtzOjY6InB1YmxpYyI7czoxOiIwIjtzOjc6ImR5bmFtaWMiO3M6MToiMCI7czo4OiJ0ZW1wbGF0ZSI7YToyOntzOjQ6InZpZXciO3M6MToiMCI7czo0OiJkYXRhIjthOjM6e2k6MDtzOjA6IiI7aToxO3M6MDoiIjtpOjI7czowOiIiO319czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6Mjp7aTowO3M6NDoibWFpbiI7aToxO3M6OToiY29udGFpbmVyIjt9czo1OiJibGFkZSI7YTowOnt9fXM6MjoiaWQiO3M6MzY6IjIxZjA4YjkxLWRlNTMtYWI3Ny03MGJmLWZkMDMxZjEwYjQ3MSI7fXM6Mzoic3RnIjthOjU6e3M6Njoic3lzdGVtIjtzOjU6InRoZW1lIjtzOjY6Im1vZHVsZSI7czozOiJ6b2UiO3M6NDoidHlwZSI7czo5OiJjb21wb25lbnQiO3M6MzoicG9zIjtzOjg6ImZyb250ZW5kIjtzOjQ6Im5hbWUiO3M6MTU6InRodW1ibmFpbC1pbWFnZSI7fXM6Mzoib3B0IjthOjE6e3M6NToibGlzdHMiO2E6NDp7aTowO2E6Mzp7czo0OiJuYW1lIjtzOjA6IiI7czo1OiJpbWFnZSI7czowOiIiO3M6NDoibGluayI7czowOiIiO31pOjE7YTozOntzOjQ6Im5hbWUiO3M6MDoiIjtzOjU6ImltYWdlIjtzOjA6IiI7czo0OiJsaW5rIjtzOjA6IiI7fWk6MjthOjM6e3M6NDoibmFtZSI7czowOiIiO3M6NToiaW1hZ2UiO3M6MDoiIjtzOjQ6ImxpbmsiO3M6MDoiIjt9aTozO2E6Mzp7czo0OiJuYW1lIjtzOjA6IiI7czo1OiJpbWFnZSI7czowOiIiO3M6NDoibGluayI7czowOiIiO319fX1zOjM2OiI5NmUyMzc5Zi1hOTY2LWJjYzMtNWE5ZC0yN2YzYzJjN2Y1MjQiO2E6Mzp7czozOiJjZmciO2E6OTp7czo1OiJ0aXRsZSI7czo0OiJzZGZzIjtzOjQ6ImZ1bmMiO3M6MTM6IkNvbW1lbnRzXG1haW4iO3M6NDoidmlldyI7czo0NzoicGx1Z2luQ29tbWVudDo6Y29tcG9uZW50LmNvbW1lbnQudmlld3MubGlzdC1uZXciO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6NjoicHVibGljIjtzOjE6IjAiO3M6NzoiZHluYW1pYyI7czoxOiIwIjtzOjg6InRlbXBsYXRlIjthOjI6e3M6NDoidmlldyI7czoxOiIwIjtzOjQ6ImRhdGEiO2E6Mzp7aTowO3M6MDoiIjtpOjE7czowOiIiO2k6MjtzOjA6IiI7fX1zOjg6ImNvbXBpbGVyIjthOjI6e3M6NDoiZ3JpZCI7YTowOnt9czo1OiJibGFkZSI7YTowOnt9fXM6MjoiaWQiO3M6MzY6Ijk2ZTIzNzlmLWE5NjYtYmNjMy01YTlkLTI3ZjNjMmM3ZjUyNCI7fXM6Mzoic3RnIjthOjY6e3M6Njoic3lzdGVtIjtzOjY6InBsdWdpbiI7czo2OiJtb2R1bGUiO3M6NzoiQ29tbWVudCI7czo0OiJ0eXBlIjtzOjk6ImNvbXBvbmVudCI7czozOiJwb3MiO3M6MDoiIjtzOjQ6Im5hbWUiO3M6NzoiY29tbWVudCI7czo0OiJtYWluIjthOjI6e3M6MTM6IkNvbW1lbnRzXG1haW4iO3M6NDoiZGF0YSI7czoxNjoiQ29tbWVudHNcTGlzdE5ldyI7czo0OiJkYXRhIjt9fXM6Mzoib3B0IjthOjE6e3M6NToibGlzdHMiO2E6NDp7aTowO2E6Mzp7czo0OiJuYW1lIjtzOjA6IiI7czo1OiJpbWFnZSI7czowOiIiO3M6NDoibGluayI7czowOiIiO31pOjE7YTozOntzOjQ6Im5hbWUiO3M6MDoiIjtzOjU6ImltYWdlIjtzOjA6IiI7czo0OiJsaW5rIjtzOjA6IiI7fWk6MjthOjM6e3M6NDoibmFtZSI7czowOiIiO3M6NToiaW1hZ2UiO3M6MDoiIjtzOjQ6ImxpbmsiO3M6MDoiIjt9aTozO2E6Mzp7czo0OiJuYW1lIjtzOjA6IiI7czo1OiJpbWFnZSI7czowOiIiO3M6NDoibGluayI7czowOiIiO319fX19fQ==', '2019-08-24 06:49:34', '2019-09-04 13:15:15');

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
