-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 19, 2019 at 12:14 AM
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
-- Table structure for table `cms_categories`
--

CREATE TABLE `cms_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `order` tinyint(4) NOT NULL DEFAULT '0',
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_component`
--

CREATE TABLE `cms_component` (
  `id` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `type` varchar(150) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_component`
--

INSERT INTO `cms_component` (`id`, `data`, `type`, `update_at`) VALUES
('16c612eb-58bb-b80b-3c6f-29a082c7d36a', 'a:3:{s:3:\"cfg\";a:5:{s:5:\"title\";N;s:4:\"view\";s:35:\"theme::component.content.views.view\";s:6:\"status\";s:1:\"1\";s:8:\"template\";a:2:{s:4:\"view\";s:1:\"0\";s:4:\"data\";a:3:{i:0;N;i:1;N;i:2;N;}}s:2:\"id\";s:36:\"16c612eb-58bb-b80b-3c6f-29a082c7d36a\";}s:3:\"stg\";a:5:{s:6:\"system\";s:6:\"module\";s:6:\"module\";s:5:\"admin\";s:4:\"type\";s:9:\"component\";s:3:\"pos\";s:8:\"frontend\";s:4:\"name\";s:7:\"content\";}s:3:\"opt\";a:2:{s:4:\"name\";s:13:\"Content Theme\";s:5:\"count\";s:1:\"5\";}}', 'component', '2019-08-13 17:33:02'),
('81d1b4ed-ecae-0e06-4f81-2dd9dfea2def', 'a:2:{s:3:\"cfg\";a:3:{s:5:\"title\";N;s:6:\"status\";s:1:\"1\";s:2:\"id\";s:36:\"81d1b4ed-ecae-0e06-4f81-2dd9dfea2def\";}s:3:\"stg\";a:5:{s:6:\"system\";s:5:\"theme\";s:6:\"module\";s:3:\"zoe\";s:4:\"type\";s:7:\"partial\";s:2:\"id\";s:2:\"10\";s:4:\"name\";s:4:\"Demo\";}}', 'partial', '2019-08-13 17:32:55'),
('ced989bc-a0e0-29b2-ea6b-8e11d923d465', 'a:3:{s:3:\"cfg\";a:6:{s:5:\"title\";N;s:4:\"view\";N;s:6:\"status\";s:1:\"1\";s:8:\"template\";a:2:{s:4:\"view\";s:1:\"0\";s:4:\"data\";a:3:{i:0;N;i:1;N;i:2;N;}}s:8:\"compiler\";a:1:{s:4:\"grid\";a:1:{i:0;s:4:\"main\";}}s:2:\"id\";s:36:\"ced989bc-a0e0-29b2-ea6b-8e11d923d465\";}s:3:\"stg\";a:5:{s:6:\"system\";s:5:\"theme\";s:6:\"module\";s:3:\"zoe\";s:4:\"type\";s:9:\"component\";s:3:\"pos\";s:8:\"frontend\";s:4:\"name\";s:15:\"thumbnail-image\";}s:3:\"opt\";a:1:{s:5:\"lists\";a:4:{i:0;a:3:{s:4:\"name\";N;s:5:\"image\";N;s:4:\"link\";N;}i:1;a:3:{s:4:\"name\";N;s:5:\"image\";N;s:4:\"link\";N;}i:2;a:3:{s:4:\"name\";N;s:5:\"image\";N;s:4:\"link\";N;}i:3;a:3:{s:4:\"name\";N;s:5:\"image\";N;s:4:\"link\";N;}}}}', 'component', '2019-08-13 17:32:03');

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
(1, 'language', 'data', 'a:1:{s:4:\"lang\";a:4:{s:2:\"en\";a:30:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:9:\"Dashboard\";}s:32:\"9a5e47e5d049ebe6b58467336720ac15\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";s:8:\"Language\";}s:32:\"408d117fea24967fa39d884654c26159\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";s:6:\"Layout\";}s:32:\"210ddedf41118efffdfbf85f7683c0f2\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";s:4:\"Page\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";s:16:\"Manager Language\";}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";s:4:\"Save\";}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"4bf215eea44727d83b8dc589df73f8b1\";a:2:{s:4:\"name\";s:4:\"User\";s:5:\"value\";s:4:\"User\";}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";s:9:\"List User\";}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";s:9:\"List Role\";}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";s:5:\"Login\";}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"a77f8c65f1072fb1fa9d2627e9d5e1f2\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"a104e7c59d69b3bd3fc861d033705502\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"51f5edcd0dab495f187c047a8e1772e2\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"41af94c71b40c89186230816c0e55517\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";s:4:\"Name\";}s:32:\"525c1708c804bbce4f459a07ce9fda06\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"7b80f37fca078e7dc8512c5e36cc99ed\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"6f3c7c53b51d1220d79ca5f7a4bfafdc\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"vi\";a:30:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:22:\"Bảng điều khiển\";}s:32:\"9a5e47e5d049ebe6b58467336720ac15\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";s:11:\"Ngôn ngữ\";}s:32:\"408d117fea24967fa39d884654c26159\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";s:11:\"Giao diện\";}s:32:\"210ddedf41118efffdfbf85f7683c0f2\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";s:5:\"Trang\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";s:22:\"Quản lý ngôn ngữ\";}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";s:4:\"Lưu\";}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"4bf215eea44727d83b8dc589df73f8b1\";a:2:{s:4:\"name\";s:4:\"User\";s:5:\"value\";s:12:\"Tài khoản\";}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";s:15:\"DS Tài Khoản\";}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";s:16:\"DS Nhóm quyền\";}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";s:13:\"Đăng nhập\";}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"a77f8c65f1072fb1fa9d2627e9d5e1f2\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"a104e7c59d69b3bd3fc861d033705502\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";s:11:\"Thêm mới\";}s:32:\"51f5edcd0dab495f187c047a8e1772e2\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"41af94c71b40c89186230816c0e55517\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";s:4:\"Tên\";}s:32:\"525c1708c804bbce4f459a07ce9fda06\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"7b80f37fca078e7dc8512c5e36cc99ed\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"6f3c7c53b51d1220d79ca5f7a4bfafdc\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"jp\";a:30:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";N;}s:32:\"9a5e47e5d049ebe6b58467336720ac15\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"408d117fea24967fa39d884654c26159\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"210ddedf41118efffdfbf85f7683c0f2\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";s:9:\"ページ\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";N;}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"4bf215eea44727d83b8dc589df73f8b1\";a:2:{s:4:\"name\";s:4:\"User\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"a77f8c65f1072fb1fa9d2627e9d5e1f2\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"a104e7c59d69b3bd3fc861d033705502\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"51f5edcd0dab495f187c047a8e1772e2\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"41af94c71b40c89186230816c0e55517\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"525c1708c804bbce4f459a07ce9fda06\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"7b80f37fca078e7dc8512c5e36cc99ed\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"6f3c7c53b51d1220d79ca5f7a4bfafdc\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}s:2:\"cn\";a:30:{s:32:\"54fff00fc06acbd0f412c5044e04c98f\";a:2:{s:4:\"name\";s:9:\"Dashboard\";s:5:\"value\";s:9:\"仪表盘\";}s:32:\"9a5e47e5d049ebe6b58467336720ac15\";a:2:{s:4:\"name\";s:8:\"Language\";s:5:\"value\";N;}s:32:\"408d117fea24967fa39d884654c26159\";a:2:{s:4:\"name\";s:6:\"Layout\";s:5:\"value\";N;}s:32:\"210ddedf41118efffdfbf85f7683c0f2\";a:2:{s:4:\"name\";s:4:\"Page\";s:5:\"value\";s:6:\"页面\";}s:32:\"2d0684157072a06b220535e1c72e65bf\";a:2:{s:4:\"name\";s:16:\"Manager Language\";s:5:\"value\";N;}s:32:\"f71e688777e6311cdf80f5922177e1fc\";a:2:{s:4:\"name\";s:4:\"Save\";s:5:\"value\";s:6:\"保存\";}s:32:\"029258c29a86a7c4477c700e6de58aac\";a:2:{s:4:\"name\";s:5:\":name\";s:5:\"value\";N;}s:32:\"3d01a30259713741dc3de5623c94b761\";a:2:{s:4:\"name\";s:3:\"Key\";s:5:\"value\";N;}s:32:\"42f11f5db57cf29530eb81b78e54641c\";a:2:{s:4:\"name\";s:33:\"Please enter at least 1 character\";s:5:\"value\";N;}s:32:\"8e91fdacb6dc4efd21d789d321b14b49\";a:2:{s:4:\"name\";s:11:\"List Layout\";s:5:\"value\";N;}s:32:\"8aa6aeebe0f35027fe928996262c0867\";a:2:{s:4:\"name\";s:7:\"Layouts\";s:5:\"value\";N;}s:32:\"0fe767d5d61cd7db3d2a48e712238b24\";a:2:{s:4:\"name\";s:7:\"Modules\";s:5:\"value\";N;}s:32:\"0f6e06a6bcdd5f1011c9a47c67974a71\";a:2:{s:4:\"name\";s:7:\"Plugins\";s:5:\"value\";N;}s:32:\"ac9cf3fd238f736684d9d82823c5786f\";a:2:{s:4:\"name\";s:6:\"Themes\";s:5:\"value\";N;}s:32:\"4bf215eea44727d83b8dc589df73f8b1\";a:2:{s:4:\"name\";s:4:\"User\";s:5:\"value\";N;}s:32:\"2d3a6e103f4999c8283e40f1c59aac87\";a:2:{s:4:\"name\";s:9:\"List User\";s:5:\"value\";N;}s:32:\"17139e1f66c7d05290e12b93e35b1958\";a:2:{s:4:\"name\";s:9:\"List Role\";s:5:\"value\";N;}s:32:\"6fee144e1a5aa0579a225f99252f6f97\";a:2:{s:4:\"name\";s:5:\"Login\";s:5:\"value\";N;}s:32:\"88055f200694faebf8973615749b878b\";a:2:{s:4:\"name\";s:29:\"Sign in to start your session\";s:5:\"value\";N;}s:32:\"41076198ed99667569bcb94120e59505\";a:2:{s:4:\"name\";s:11:\"Remember Me\";s:5:\"value\";N;}s:32:\"0ffc71968c588734b47b6925f63858c5\";a:2:{s:4:\"name\";s:7:\"Sign In\";s:5:\"value\";N;}s:32:\"a77f8c65f1072fb1fa9d2627e9d5e1f2\";a:2:{s:4:\"name\";s:12:\"Manager role\";s:5:\"value\";N;}s:32:\"a104e7c59d69b3bd3fc861d033705502\";a:2:{s:4:\"name\";s:7:\"Add New\";s:5:\"value\";N;}s:32:\"51f5edcd0dab495f187c047a8e1772e2\";a:2:{s:4:\"name\";s:2:\"ID\";s:5:\"value\";N;}s:32:\"41af94c71b40c89186230816c0e55517\";a:2:{s:4:\"name\";s:4:\"Name\";s:5:\"value\";N;}s:32:\"525c1708c804bbce4f459a07ce9fda06\";a:2:{s:4:\"name\";s:5:\"Guard\";s:5:\"value\";N;}s:32:\"7b80f37fca078e7dc8512c5e36cc99ed\";a:2:{s:4:\"name\";s:7:\"Created\";s:5:\"value\";N;}s:32:\"6f3c7c53b51d1220d79ca5f7a4bfafdc\";a:2:{s:4:\"name\";s:6:\"Update\";s:5:\"value\";N;}s:32:\"278448ba6135d00739ca5694ad895157\";a:2:{s:4:\"name\";s:4:\"List\";s:5:\"value\";N;}s:32:\"ed8e62a526c5037481887f66fda85118\";a:2:{s:4:\"name\";s:6:\"Review\";s:5:\"value\";N;}}}}', NULL, NULL),
(2, 'core:layout', 'option', 'a:1:{s:4:\"data\";a:2:{s:7:\"columns\";a:5:{s:2:\"id\";s:2:\"id\";s:4:\"name\";s:4:\"name\";s:4:\"type\";s:4:\"type\";s:6:\"status\";s:6:\"status\";s:10:\"created_at\";s:10:\"created_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"20\";}}}', NULL, NULL),
(3, 'core:page', 'option', 'a:1:{s:4:\"data\";a:2:{s:7:\"columns\";a:4:{s:2:\"id\";s:2:\"id\";s:5:\"title\";s:5:\"title\";s:6:\"status\";s:6:\"status\";s:10:\"created_at\";s:10:\"created_at\";}s:10:\"pagination\";a:1:{s:4:\"item\";s:2:\"20\";}}}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_layout`
--

CREATE TABLE `cms_layout` (
  `id` int(5) NOT NULL,
  `theme` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `type` varchar(30) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_layout`
--

INSERT INTO `cms_layout` (`id`, `theme`, `name`, `slug`, `type`, `token`, `status`, `content`, `created_at`, `updated_at`) VALUES
(8, 'zoe', 'Home', 'home', 'layout', 'abc', 1, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6NDp7czo4OiJjb21waWxlciI7YTowOnt9czozOiJ0YWciO3M6NDoibm9uZSI7czo2OiJzdGF0dXMiO2k6MTtzOjI6ImlkIjtzOjM2OiJlMDg0MzVjMC0yOTkyLWZlMzAtOWVhYS0zYjE5MzIzYzMxZjciO31zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjk6IjU4MTYzOTI0MiI7fX1zOjM6Im9wdCI7YTowOnt9fXM6NDoidmlldyI7YToxOntpOjA7YTozOntpOjA7YToxOntpOjA7YToxOntzOjM6InJvdyI7YToyOntzOjY6Im9wdGlvbiI7YTozOntzOjM6ImNmZyI7YTo0OntzOjg6ImNvbXBpbGVyIjthOjA6e31zOjM6InRhZyI7czo0OiJub25lIjtzOjY6InN0YXR1cyI7aToxO3M6MjoiaWQiO3M6MzY6ImU1MjllNDllLWFlOWQtMjMyNS0wNzkxLTFkZTJhM2U1NDUyOSI7fXM6Mzoic3RnIjthOjM6e3M6MzoiY29sIjthOjI6e2k6MDtzOjE6IjYiO2k6MTtzOjE6IjYiO31zOjQ6InR5cGUiO3M6NDoiZ2lyZCI7czo1OiJwbGFjZSI7YToyOntpOjA7czo4OiIyODA0ODE1NSI7aToxO3M6MTA6IjE3NjgzNDQ5NTAiO319czozOiJvcHQiO2E6MDp7fX1zOjQ6InZpZXciO2E6Mjp7aTowO2E6MTp7aTowO3M6MzY6ImNlZDk4OWJjLWEwZTAtMjliMi1lYTZiLThlMTFkOTIzZDQ2NSI7fWk6MTthOjA6e319fX19aToxO3M6MzY6IjE2YzYxMmViLTU4YmItYjgwYi0zYzZmLTI5YTA4MmM3ZDM2YSI7aToyO3M6MzY6IjgxZDFiNGVkLWVjYWUtMGUwNi00ZjgxLTJkZDlkZmVhMmRlZiI7fX19fX1zOjY6IndpZGdldCI7YTozOntzOjM2OiJjZWQ5ODliYy1hMGUwLTI5YjItZWE2Yi04ZTExZDkyM2Q0NjUiO2E6Mzp7czozOiJjZmciO2E6Njp7czo1OiJ0aXRsZSI7czowOiIiO3M6NDoidmlldyI7czowOiIiO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6ODoidGVtcGxhdGUiO2E6Mjp7czo0OiJ2aWV3IjtzOjE6IjAiO3M6NDoiZGF0YSI7YTozOntpOjA7czowOiIiO2k6MTtzOjA6IiI7aToyO3M6MDoiIjt9fXM6ODoiY29tcGlsZXIiO2E6Mjp7czo0OiJncmlkIjthOjE6e2k6MDtzOjQ6Im1haW4iO31zOjU6ImJsYWRlIjthOjA6e319czoyOiJpZCI7czozNjoiY2VkOTg5YmMtYTBlMC0yOWIyLWVhNmItOGUxMWQ5MjNkNDY1Ijt9czozOiJzdGciO2E6NTp7czo2OiJzeXN0ZW0iO3M6NToidGhlbWUiO3M6NjoibW9kdWxlIjtzOjM6InpvZSI7czo0OiJ0eXBlIjtzOjk6ImNvbXBvbmVudCI7czozOiJwb3MiO3M6ODoiZnJvbnRlbmQiO3M6NDoibmFtZSI7czoxNToidGh1bWJuYWlsLWltYWdlIjt9czozOiJvcHQiO2E6MTp7czo1OiJsaXN0cyI7YTo0OntpOjA7YTozOntzOjQ6Im5hbWUiO3M6MDoiIjtzOjU6ImltYWdlIjtzOjA6IiI7czo0OiJsaW5rIjtzOjA6IiI7fWk6MTthOjM6e3M6NDoibmFtZSI7czowOiIiO3M6NToiaW1hZ2UiO3M6MDoiIjtzOjQ6ImxpbmsiO3M6MDoiIjt9aToyO2E6Mzp7czo0OiJuYW1lIjtzOjA6IiI7czo1OiJpbWFnZSI7czowOiIiO3M6NDoibGluayI7czowOiIiO31pOjM7YTozOntzOjQ6Im5hbWUiO3M6MDoiIjtzOjU6ImltYWdlIjtzOjA6IiI7czo0OiJsaW5rIjtzOjA6IiI7fX19fXM6MzY6IjE2YzYxMmViLTU4YmItYjgwYi0zYzZmLTI5YTA4MmM3ZDM2YSI7YTozOntzOjM6ImNmZyI7YTo2OntzOjU6InRpdGxlIjtzOjA6IiI7czo0OiJ2aWV3IjtzOjM1OiJ0aGVtZTo6Y29tcG9uZW50LmNvbnRlbnQudmlld3MudmlldyI7czo2OiJzdGF0dXMiO3M6MToiMSI7czo4OiJ0ZW1wbGF0ZSI7YToyOntzOjQ6InZpZXciO3M6MToiMCI7czo0OiJkYXRhIjthOjM6e2k6MDtzOjA6IiI7aToxO3M6MDoiIjtpOjI7czowOiIiO319czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX1zOjI6ImlkIjtzOjM2OiIxNmM2MTJlYi01OGJiLWI4MGItM2M2Zi0yOWEwODJjN2QzNmEiO31zOjM6InN0ZyI7YTo1OntzOjY6InN5c3RlbSI7czo2OiJtb2R1bGUiO3M6NjoibW9kdWxlIjtzOjU6ImFkbWluIjtzOjQ6InR5cGUiO3M6OToiY29tcG9uZW50IjtzOjM6InBvcyI7czo4OiJmcm9udGVuZCI7czo0OiJuYW1lIjtzOjc6ImNvbnRlbnQiO31zOjM6Im9wdCI7YToyOntzOjQ6Im5hbWUiO3M6MTM6IkNvbnRlbnQgVGhlbWUiO3M6NToiY291bnQiO2k6NTt9fXM6MzY6IjgxZDFiNGVkLWVjYWUtMGUwNi00ZjgxLTJkZDlkZmVhMmRlZiI7YTozOntzOjM6ImNmZyI7YToyOntzOjg6ImNvbXBpbGVyIjthOjA6e31zOjI6ImlkIjtzOjM2OiI4MWQxYjRlZC1lY2FlLTBlMDYtNGY4MS0yZGQ5ZGZlYTJkZWYiO31zOjM6InN0ZyI7YTo1OntzOjY6InN5c3RlbSI7czo1OiJ0aGVtZSI7czo2OiJtb2R1bGUiO3M6Mzoiem9lIjtzOjQ6InR5cGUiO3M6NzoicGFydGlhbCI7czoyOiJpZCI7aToxMDtzOjQ6Im5hbWUiO3M6NDoiRGVtbyI7fXM6Mzoib3B0IjthOjA6e319fX0=', '2019-08-03 07:50:13', '2019-08-13 17:28:27'),
(10, 'zoe', 'Demo', 'demo', 'partial', 'def', 1, 'YToyOntzOjQ6ImRhdGEiO2E6MTp7aTowO2E6MTp7czozOiJyb3ciO2E6Mjp7czo2OiJvcHRpb24iO2E6Mzp7czozOiJjZmciO2E6NDp7czo1OiJ0aXRsZSI7czowOiIiO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6MzoidGFnIjtzOjU6ImJsb2NrIjtzOjg6ImNvbXBpbGVyIjthOjI6e3M6NDoiZ3JpZCI7YToxOntpOjA7czo0OiJjYXJkIjt9czo1OiJibGFkZSI7YTowOnt9fX1zOjM6InN0ZyI7YTozOntzOjM6ImNvbCI7YToxOntpOjA7czoyOiIxMiI7fXM6NDoidHlwZSI7czo0OiJnaXJkIjtzOjU6InBsYWNlIjthOjE6e2k6MDtzOjEwOiIyMDk1NDY4NzE3Ijt9fXM6Mzoib3B0IjthOjE6e3M6NDoiYXR0ciI7YToyOntzOjU6ImNsYXNzIjtzOjA6IiI7czoyOiJpZCI7czowOiIiO319fXM6NDoidmlldyI7YToxOntpOjA7YToyOntpOjA7aTowO2k6MTtpOjE7fX19fX1zOjY6IndpZGdldCI7YToyOntpOjA7YTozOntzOjM6ImNmZyI7YTo1OntzOjU6InRpdGxlIjtzOjA6IiI7czo0OiJ2aWV3IjtzOjc6ImR5bmFtaWMiO3M6Njoic3RhdHVzIjtzOjE6IjEiO3M6ODoidGVtcGxhdGUiO2E6Mjp7czo0OiJ2aWV3IjtzOjE6IjAiO3M6NDoiZGF0YSI7YTozOntpOjA7czo4OiJzZGZzZGZzZiI7aToxO3M6MDoiIjtpOjI7czowOiIiO319czo4OiJjb21waWxlciI7YToyOntzOjQ6ImdyaWQiO2E6MDp7fXM6NToiYmxhZGUiO2E6MDp7fX19czozOiJzdGciO2E6NTp7czo2OiJzeXN0ZW0iO3M6NjoibW9kdWxlIjtzOjY6Im1vZHVsZSI7czo1OiJhZG1pbiI7czo0OiJ0eXBlIjtzOjk6ImNvbXBvbmVudCI7czozOiJwb3MiO3M6ODoiZnJvbnRlbmQiO3M6NDoibmFtZSI7czo3OiJjb250ZW50Ijt9czozOiJvcHQiO2E6Mjp7czo0OiJuYW1lIjtzOjEzOiJDb250ZW50IFRoZW1lIjtzOjU6ImNvdW50IjtpOjU7fX1pOjE7YTozOntzOjM6ImNmZyI7YTo0OntzOjU6InRpdGxlIjtzOjA6IiI7czo0OiJ2aWV3IjtzOjQzOiJ0aGVtZTo6Y29tcG9uZW50LnRodW1ibmFpbC1pbWFnZS52aWV3cy5saXN0IjtzOjg6InRlbXBsYXRlIjthOjI6e3M6NDoidmlldyI7czoxOiIwIjtzOjQ6ImRhdGEiO2E6Mzp7aTowO3M6MDoiIjtpOjE7czowOiIiO2k6MjtzOjA6IiI7fX1zOjg6ImNvbXBpbGVyIjthOjI6e3M6NDoiZ3JpZCI7YTowOnt9czo1OiJibGFkZSI7YTowOnt9fX1zOjM6InN0ZyI7YTo1OntzOjY6InN5c3RlbSI7czo1OiJ0aGVtZSI7czo2OiJtb2R1bGUiO3M6Mzoiem9lIjtzOjQ6InR5cGUiO3M6OToiY29tcG9uZW50IjtzOjM6InBvcyI7czo4OiJmcm9udGVuZCI7czo0OiJuYW1lIjtzOjE1OiJ0aHVtYm5haWwtaW1hZ2UiO31zOjM6Im9wdCI7YToxOntzOjU6Imxpc3RzIjthOjQ6e2k6MDthOjM6e3M6NDoibmFtZSI7czowOiIiO3M6NToiaW1hZ2UiO3M6MDoiIjtzOjQ6ImxpbmsiO3M6MDoiIjt9aToxO2E6Mzp7czo0OiJuYW1lIjtzOjA6IiI7czo1OiJpbWFnZSI7czowOiIiO3M6NDoibGluayI7czowOiIiO31pOjI7YTozOntzOjQ6Im5hbWUiO3M6MDoiIjtzOjU6ImltYWdlIjtzOjA6IiI7czo0OiJsaW5rIjtzOjA6IiI7fWk6MzthOjM6e3M6NDoibmFtZSI7czowOiIiO3M6NToiaW1hZ2UiO3M6MDoiIjtzOjQ6ImxpbmsiO3M6MDoiIjt9fX19fX0=', '2019-08-13 11:32:20', '2019-08-13 11:53:37');

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
(1, 'blog', '1.0.0', '[]', 1, '2019-08-18 15:53:45');

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
(1, 'gioi-thieu-1', 'Giới thiệu 1', 'demo', '<p>@for ($i = 0; $i &lt; 10; $i++)</p>\r\n<div>The current value is {{ $i }}</div>\r\n<p>@endfor</p>', 1, '2019-07-26 20:14:53', '2019-08-18 15:04:56'),
(2, 'gioi-thieu-demo', 'Giới thiệu', 'demo', '<p>{{demo()}}</p>', 1, '2019-07-26 20:35:32', '2019-07-26 20:35:32');

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
-- Table structure for table `cms_posts`
--

CREATE TABLE `cms_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `featured` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `format_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_post_category`
--

CREATE TABLE `cms_post_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_post_tag`
--

CREATE TABLE `cms_post_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `cms_tags`
--

CREATE TABLE `cms_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `cms_categories`
--
ALTER TABLE `cms_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cms_categories_parent_id_index` (`parent_id`),
  ADD KEY `cms_categories_user_id_index` (`user_id`);

--
-- Indexes for table `cms_component`
--
ALTER TABLE `cms_component`
  ADD UNIQUE KEY `id` (`id`);

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
-- Indexes for table `cms_posts`
--
ALTER TABLE `cms_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_post_category`
--
ALTER TABLE `cms_post_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cms_post_category_category_id_index` (`category_id`),
  ADD KEY `cms_post_category_post_id_index` (`post_id`);

--
-- Indexes for table `cms_post_tag`
--
ALTER TABLE `cms_post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cms_post_tag_tag_id_index` (`tag_id`),
  ADD KEY `cms_post_tag_post_id_index` (`post_id`);

--
-- Indexes for table `cms_role`
--
ALTER TABLE `cms_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_tags`
--
ALTER TABLE `cms_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cms_tags_user_id_index` (`user_id`),
  ADD KEY `cms_tags_parent_id_index` (`parent_id`);

--
-- Indexes for table `cms_user`
--
ALTER TABLE `cms_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cms_user_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_admin`
--
ALTER TABLE `cms_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_categories`
--
ALTER TABLE `cms_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_config`
--
ALTER TABLE `cms_config`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_layout`
--
ALTER TABLE `cms_layout`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cms_migrations`
--
ALTER TABLE `cms_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_module`
--
ALTER TABLE `cms_module`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `cms_posts`
--
ALTER TABLE `cms_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_post_category`
--
ALTER TABLE `cms_post_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_post_tag`
--
ALTER TABLE `cms_post_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_role`
--
ALTER TABLE `cms_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_tags`
--
ALTER TABLE `cms_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_user`
--
ALTER TABLE `cms_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
