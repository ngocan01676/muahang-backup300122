-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2020 at 12:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

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
-- Table structure for table `cms_shop_order_excel`
--

CREATE TABLE `cms_shop_order_excel` (
  `id` int(20) NOT NULL,
  `session_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `company` varchar(30) NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(15) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL,
  `pay_method` int(5) NOT NULL DEFAULT 1,
  `product_id` int(10) NOT NULL,
  `count` int(1) NOT NULL,
  `order_create_date` varchar(50) NOT NULL,
  `order_image` text NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `order_hours` varchar(100) NOT NULL,
  `order_ship` int(5) NOT NULL,
  `order_ship_cou` int(5) DEFAULT NULL,
  `order_check` varchar(100) NOT NULL,
  `order_info` varchar(255) CHARACTER SET utf8 NOT NULL,
  `order_link` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_shop_order_excel`
--

INSERT INTO `cms_shop_order_excel` (`id`, `session_id`, `admin_id`, `company`, `fullname`, `address`, `phone`, `zipcode`, `province`, `pay_method`, `product_id`, `count`, `order_create_date`, `order_image`, `order_date`, `order_hours`, `order_ship`, `order_ship_cou`, `order_check`, `order_info`, `order_link`, `status`, `updated_at`) VALUES
(10, 2, 1, 'YAMADA', 'VUONG VAN NGHI', '広島市西区中広町３丁目１−４０-404号', '070-1398-2234', '733-0012', '広島県', 1, 1, 20, '2020-09-01 00:00:00', '', '2020-09-01 00:00:00', '14:00～16:00', 0, 0, '', '', '', 0, '2020-09-01 16:58:11'),
(11, 2, 1, 'YAMADA', 'NGUYEN QUOC PHAT', '名古屋市千種区今池３丁目４レオパレス２１龍庵 111号', '070-1398-2234', '464-0850', '愛知県', 1, 1, 1, '2020-09-01 00:00:00', '', '2020-09-01 00:00:00', '14:00～16:00', 0, 0, '', '', '', 0, '2020-09-01 16:58:11'),
(12, 2, 1, 'YAMADA', 'KHONG MINH DAT', '本巣市神海237-1(自然応用科学寮102号)', '070-1398-2234', '501-1235', '岐阜県', 1, 1, 1, '2020-09-01 00:00:00', '', '2020-09-01 00:00:00', '14:00～16:00', 0, 0, '', '', '', 0, '2020-09-01 16:58:11'),
(13, 2, 1, 'YAMADA', 'KHAC HIEP', '下伊那郡松川町大島１２９５−５', '070-1398-2234', '399-3304', '長野県', 1, 1, 1, '2020-09-01 00:00:00', '', '2020-09-01 00:00:00', '14:00～16:00', 0, 0, '', '', '', 0, '2020-09-01 16:58:11'),
(14, 2, 1, 'YAMADA', 'HUY', '岡崎市東蔵前町五反畑79フォーブルリアン205号', '070-1398-2234', '444-2146', '愛知県', 1, 1, 1, '2020-09-01 00:00:00', '', '2020-09-01 00:00:00', '14:00～16:00', 0, 0, '', '', '', 0, '2020-09-01 16:58:11'),
(15, 2, 1, 'YAMADA', 'グエン ヴィエット クオン', '東諸県郡国富町大字本庄7022番地', '070-1398-2234', '880-1101', '宮崎県', 1, 1, 1, '2020-09-01 00:00:00', '', '2020-09-01 00:00:00', '14:00～16:00', 0, 0, '', '', '', 0, '2020-09-01 16:58:11'),
(16, 2, 1, 'YAMADA', 'NGUYEN THI HONG', '湖西市駅南２丁目１−１９コーポ Ura 13号', '070-1398-2234', '431-0427', '静岡県', 1, 1, 1, '2020-09-01 00:00:00', '', '2020-09-01 00:00:00', '14:00～16:00', 0, 0, '', '', '', 0, '2020-09-01 16:58:11'),
(17, 2, 1, 'YAMADA', 'ファン タイン ユオン', '市原市海保2446-2', '070-1398-2234', '290-0266', '千葉県', 1, 1, 1, '2020-09-01 00:00:00', '', '2020-09-01 00:00:00', '14:00～16:00', 0, 0, '', '', '', 0, '2020-09-01 16:58:11'),
(18, 2, 1, 'YAMADA', 'NGUYEN VAN HUNG', '苅田町神田町1丁目6-3 MDIマンション苅田駅前607', '070-1398-2234', '800-0361', '京都郡', 1, 1, 1, '2020-09-01 00:00:00', '', '2020-09-01 00:00:00', '14:00～16:00', 0, 0, '', '', '', 0, '2020-09-01 16:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `cms_shop_order_excel_session`
--

CREATE TABLE `cms_shop_order_excel_session` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL,
  `admin_id` int(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_shop_order_excel_session`
--

INSERT INTO `cms_shop_order_excel_session` (`id`, `name`, `date_time`, `admin_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SMSVuRy2qIsqb2ZK2op2gPUpWYMBBEUj25FXHvp5YTxkv0SqaY', '2020-09-01 16:06:04', 1, 0, '2020-09-01 16:06:04', '2020-09-01 16:06:04'),
(2, 'i5X4jxr6JR3g6UNBWWSjLYYnD79sfFfbvX5RyMswVMpDSV1bQy', '2020-09-01 16:58:11', 1, 0, '2020-09-01 16:10:07', '2020-09-01 16:58:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_shop_order_excel`
--
ALTER TABLE `cms_shop_order_excel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_shop_order_excel_session`
--
ALTER TABLE `cms_shop_order_excel_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_shop_order_excel`
--
ALTER TABLE `cms_shop_order_excel`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cms_shop_order_excel_session`
--
ALTER TABLE `cms_shop_order_excel_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
