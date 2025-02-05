-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 05, 2025 at 09:44 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tnm_clothes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int NOT NULL,
  `number_order` int NOT NULL,
  `image_link` text NOT NULL,
  `product_link` text NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `number_order`, `image_link`, `product_link`, `status`, `title`, `content`) VALUES
(4, 1, './uploads/1733645370fashion-slideshow-01.jpg', 'http://localhost/DA1_WD19316/?act=product-detail&id=83&variant_id=163', 1, 'Giảm giá đến 70%', 'Dành cho các hội viên mới có cơ hội săn các sản phẩm'),
(7, 2, './uploads/1732986297fashion-slideshow-02.jpg', '#', 1, 'Giảm 50% cho người lần đầu mua hàng', 'Dành cho các hội viên mới có cơ hội săn các sản phẩm'),
(8, 3, './uploads/1732986329fashion-slideshow-03.jpg', '#', 1, 'Giảm 20% tất cả sản phẩm trong shop', 'Các ưu đãi lớn mua ngay nào');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `variant_id` int NOT NULL,
  `quantity` int NOT NULL,
  `user_id` int NOT NULL,
  `size_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`id`, `product_id`, `variant_id`, `quantity`, `user_id`, `size_id`) VALUES
(68, 105, 192, 20, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `status`) VALUES
(2, 'Quần', '', 0),
(3, 'Quần mùa đông ', '', 0),
(5, 'dép', '', 0),
(6, 'giày', '', 0),
(9, 'Áo mùa đông', '', 0),
(11, 'Áo khoác', '', 1),
(12, 'Áo phông', '', 1),
(13, 'Áo polo', '', 1),
(14, 'Áo giữ nhiệt', '', 1),
(15, 'Áo len', '', 1),
(16, 'Áo chống nắng', '', 1),
(17, 'Áo phao', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_details`
--

CREATE TABLE `category_details` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category_details`
--

INSERT INTO `category_details` (`id`, `product_id`, `category_id`) VALUES
(317, 102, 9),
(320, 104, 12),
(321, 104, 11),
(322, 105, 11),
(325, 108, 9),
(326, 108, 14),
(327, 109, 9),
(328, 109, 11),
(329, 110, 13),
(330, 111, 2),
(331, 111, 3),
(332, 112, 11),
(333, 112, 14),
(334, 113, 12),
(335, 113, 13),
(336, 114, 12),
(337, 114, 13),
(338, 106, 11),
(339, 106, 17),
(340, 115, 14),
(341, 115, 15);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `content` text NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `user_id` int DEFAULT NULL,
  `customer_name` varchar(50) NOT NULL,
  `shipping_address` text,
  `customer_email` varchar(50) DEFAULT NULL,
  `customer_phone` varchar(10) DEFAULT NULL,
  `payment_method_id` int DEFAULT NULL,
  `order_status_id` int DEFAULT '1',
  `update_at` timestamp NULL DEFAULT NULL,
  `voucher_id` int DEFAULT NULL,
  `shipping` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `order_code`, `user_id`, `customer_name`, `shipping_address`, `customer_email`, `customer_phone`, `payment_method_id`, `order_status_id`, `update_at`, `voucher_id`, `shipping`) VALUES
(23, '2024-11-01 06:46:18', 'DH63860738809913666', 6, 'Thái Đỗ Văn', 'Hà Nội, Xã Đoan Hạ, Huyện Thanh Thuỷ, Tỉnh Phú Thọ', 'thaidvph50988@gmail.com', '0388954747', 1, 1, '2024-12-01 06:46:18', 2, 0),
(24, '2024-11-01 06:46:45', 'DH61600809911861134', 6, 'Thái Đỗ Văn', 'Hà Nội, Xã Hiền Hào, Huyện Cát Hải, Thành phố Hải Phòng', 'thaidvph50988@gmail.com', '0388954747', 1, 8, '2024-12-01 06:46:45', NULL, 20000),
(25, '2024-12-01 06:47:14', 'DH77082270708161570', 6, 'Thái Đỗ Văn', 'Hà Nội, Xã Hoàng Xá, Huyện Thanh Thuỷ, Tỉnh Phú Thọ', 'thaidvph50988@gmail.com', '0388954747', 1, 1, '2024-12-01 06:47:14', NULL, 0),
(26, '2024-12-01 06:47:33', 'DH68839439358788197', 6, 'Thái Đỗ Văn', 'Hà Nội, Xã Nguyệt Đức, Huyện Thuận Thành, Tỉnh Bắc Ninh', 'thaidvph50988@gmail.com', '0388954747', 1, 6, '2024-12-04 05:08:19', NULL, 0),
(27, '2024-12-01 06:47:55', 'DH20265920990421160', 6, 'Thái Đỗ Văn', 'Hà Nội, Xã Thạch Sơn, Huyện Lâm Thao, Tỉnh Phú Thọ', 'thaidvph50988@gmail.com', '0388954747', 1, 6, '2024-12-04 04:10:26', NULL, 0),
(28, '2024-12-01 06:48:11', 'DH72660488210991798', 6, 'Thái Đỗ Văn', 'Hà Nội, Xã Cao Xá, Huyện Lâm Thao, Tỉnh Phú Thọ', 'thaidvph50988@gmail.com', '0388954747', 1, 6, '2024-12-07 08:30:08', 2, 0),
(29, '2024-12-01 13:22:52', 'DH19448286933795924', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Đông Cứu, Huyện Gia Bình, Tỉnh Bắc Ninh', 'thaidvph50988@gmail.com', '0388954747', 1, 1, '2024-12-01 13:22:52', NULL, 20000),
(30, '2024-12-01 16:50:29', 'DH15316319409580786', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Đạp Thanh, Huyện Ba Chẽ, Tỉnh Quảng Ninh', 'thaidvph50988@gmail.com', '0388954747', 1, 6, '2024-12-01 16:50:29', NULL, 0),
(31, '2024-12-02 00:33:35', 'DH5043021606237', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Đông Cửu, Huyện Thanh Sơn, Tỉnh Phú Thọ', 'thaidvph50988@gmail.com', '0388954747', 2, 6, '2024-12-02 00:33:35', 2, 0),
(32, '2024-12-02 00:59:25', 'DH5739656488709', 1, 'Thái Đỗ Văn', '84 Đường đại tự, Xã Liên Châu, Huyện Yên Lạc, Tỉnh Vĩnh Phúc', 'thaidvph50988@gmail.com', '0388954747', 2, 6, '2024-12-02 00:59:25', 2, 0),
(33, '2024-12-02 01:24:38', 'DH55146881204443419', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Duyên Hà, Huyện Thanh Trì, Thành phố Hà Nội', 'thaidvph50988@gmail.com', '0388954747', 1, 1, '2024-12-02 01:24:38', 2, 0),
(34, '2024-12-02 01:54:52', 'DH77292208666801636', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Phùng Nguyên, Huyện Lâm Thao, Tỉnh Phú Thọ', 'thaidvph50988@gmail.com', '0388954747', 1, 1, '2024-12-02 01:54:52', NULL, 0),
(35, '2024-11-26 02:01:15', 'DH2022032947032', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Liên Châu, Huyện Yên Lạc, Tỉnh Vĩnh Phúc', 'thaidvph50988@gmail.com', '0388954747', 2, 7, '2024-11-26 02:23:23', NULL, 0),
(36, '2024-12-02 06:40:09', 'DH681160524314', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Mường Kim, Huyện Than Uyên, Tỉnh Lai Châu', 'thaidvph50988@gmail.com', '0388954747', 2, 7, '2024-12-04 05:06:29', NULL, 0),
(37, '2024-12-03 12:40:18', 'DH72308770549583064', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Tiền Phong, Huyện Mê Linh, Thành phố Hà Nội', 'thaidvph50988@gmail.com', '0388954747', 1, 6, '2024-12-04 05:08:48', NULL, 0),
(38, '2024-12-03 12:54:20', 'DH84513451694142978', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Đại Tự, Huyện Yên Lạc, Tỉnh Vĩnh Phúc', 'thaidvph50988@gmail.com', '0388954747', 1, 1, '2024-12-03 12:54:20', NULL, 0),
(39, '2024-12-03 13:06:28', 'DH63478871203024530', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Thạch Sơn, Huyện Lâm Thao, Tỉnh Phú Thọ', 'thaidvph50988@gmail.com', '0388954747', 1, 6, '2024-12-07 08:30:08', NULL, 0),
(40, '2024-12-03 13:58:34', 'DH24863738512001175', 1, 'Thái Đỗ Văn', '84 Đường đại tự, Xã Cảnh Thụy, Huyện Yên Dũng, Tỉnh Bắc Giang', 'thaidvph50988@gmail.com', '0388954747', 1, 1, '2024-12-03 13:58:34', 2, 0),
(41, '2024-12-04 01:18:05', 'DH59509536933606235', 1, 'Thái Đỗ Văn', '84 Đường đại tự, Phường Đồng Nguyên, Thị xã Từ Sơn, Tỉnh Bắc Ninh', 'thaidvph50988@gmail.com', '0388954747', 1, 7, '2024-12-04 01:18:05', 2, 0),
(42, '2024-12-04 02:40:18', 'DH65066492559241278', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Nguyệt Đức, Huyện Thuận Thành, Tỉnh Bắc Ninh', 'thaidvph50988@gmail.com', '0388954747', 1, 1, '2024-12-04 02:40:18', 2, 0),
(43, '2024-12-04 02:59:20', 'DH60611460671486378', 1, 'Thái Đỗ Văn', 'Hà Nội, Xã Sơn Vi, Huyện Lâm Thao, Tỉnh Phú Thọ', 'thaidvph50988@gmail.com', '0388954747', 1, 1, '2024-12-04 02:59:20', NULL, 0),
(44, '2024-12-04 03:40:45', 'DH45271816345408457', 1, 'asdasdasd', 'Hà Nội, Xã Thanh Hà, Huyện Thanh Ba, Tỉnh Phú Thọ', 'thaidv@gmail.com', '0388954747', 1, 1, '2024-12-04 03:40:45', NULL, 0),
(45, '2024-12-08 05:58:17', 'DH30651469173868313', 1, 'Đỗ Văn Thái', '84 Đường đại tự, Xã Liên Châu, Huyện Yên Lạc, Tỉnh Vĩnh Phúc', 'thaidvph50988@gmail.com', '0388954747', 1, 7, '2024-12-08 05:58:17', NULL, 0),
(46, '2024-12-08 06:07:57', 'DH170377457606328', 1, 'Đỗ Văn Thái', 'Hà Nội, Xã Duyên Hà, Huyện Thanh Trì, Thành phố Hà Nội', 'thaidvph50988@gmail.com', '0388954747', 1, 7, '2024-12-08 06:07:57', NULL, 0),
(47, '2024-12-09 00:03:37', 'DH3482368695269', 1, 'Đỗ Văn Thái', '84 Đường đại tự, Xã Ngũ Thái, Huyện Thuận Thành, Tỉnh Bắc Ninh', 'thaidvph50988@gmail.com', '0388954747', 2, 1, '2024-12-09 00:03:37', 1, 0),
(48, '2024-12-09 00:33:56', 'DH23002700964310237', 6, 'Lý Cẩm Lee', 'Hà Nội, Phường Anh Dũng, Quận Dương Kinh, Thành phố Hải Phòng', 'lee@gmail.com', '0923493843', 1, 1, '2024-12-09 00:33:56', NULL, 0),
(49, '2024-12-09 00:35:06', 'DH5736887747110', 6, 'Lý Cẩm Lee', '84 Đường đại tự, Xã Phùng Nguyên, Huyện Lâm Thao, Tỉnh Phú Thọ', 'lee@gmail.com', '0923493843', 2, 7, '2024-12-09 00:35:06', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `order_id` int NOT NULL,
  `variant_id` int NOT NULL,
  `product_quantity` int NOT NULL,
  `size` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `unit_cost` int NOT NULL,
  `status_review` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `product_id`, `order_id`, `variant_id`, `product_quantity`, `size`, `created_at`, `update_at`, `unit_cost`, `status_review`) VALUES
(29, 102, 25, 183, 1, 'M', '2024-12-01 06:47:14', '2024-12-01 06:47:14', 664050, 0),
(30, 102, 26, 183, 1, 'L', '2024-12-01 06:47:33', '2024-12-01 06:47:33', 664050, 0),
(31, 102, 26, 183, 1, 'S', '2024-12-01 06:47:33', '2024-12-01 06:47:33', 664050, 0),
(32, 102, 27, 183, 1, 'L', '2024-12-01 06:47:55', '2024-12-01 06:47:55', 664050, 0),
(33, 102, 27, 183, 1, 'XL', '2024-12-01 06:47:55', '2024-12-01 06:47:55', 664050, 0),
(34, 102, 28, 183, 1, 'M', '2024-12-01 06:48:11', '2024-12-01 06:48:11', 664050, 1),
(38, 105, 31, 194, 2, 'M', '2024-12-02 00:33:35', '2024-12-02 00:33:35', 539000, 1),
(39, 105, 32, 192, 1, 'L', '2024-12-02 00:59:25', '2024-12-02 00:59:25', 539000, 1),
(40, 102, 32, 183, 1, 'XL', '2024-12-02 00:59:25', '2024-12-02 00:59:25', 664050, 1),
(41, 102, 33, 183, 1, 'XL', '2024-12-02 01:24:38', '2024-12-02 01:24:38', 664050, 0),
(42, 102, 34, 183, 1, 'M', '2024-12-02 01:54:52', '2024-12-02 01:54:52', 664050, 0),
(43, 104, 35, 189, 1, 'M', '2024-12-02 02:01:15', '2024-12-02 02:01:15', 1169000, 0),
(44, 105, 36, 192, 1, 'S', '2024-12-02 06:40:09', '2024-12-02 06:40:09', 539000, 0),
(45, 102, 37, 183, 2, 'L', '2024-12-03 12:40:18', '2024-12-03 12:40:18', 664050, 0),
(46, 105, 38, 192, 2, 'S', '2024-12-03 12:54:20', '2024-12-03 12:54:20', 539000, 0),
(47, 104, 39, 189, 1, 'S', '2024-12-03 13:06:28', '2024-12-03 13:06:28', 1169000, 0),
(48, 105, 40, 192, 2, 'S', '2024-12-03 13:58:34', '2024-12-03 13:58:34', 539000, 0),
(49, 105, 40, 192, 2, 'XL', '2024-12-03 13:58:34', '2024-12-03 13:58:34', 539000, 0),
(50, 104, 40, 189, 1, 'M', '2024-12-03 13:58:34', '2024-12-03 13:58:34', 1169000, 0),
(51, 106, 40, 195, 4, 'XL', '2024-12-03 13:58:34', '2024-12-03 13:58:34', 1259000, 0),
(52, 108, 41, 202, 1, 'M', '2024-12-04 01:18:05', '2024-12-04 01:18:05', 359000, 0),
(53, 109, 41, 205, 3, 'S', '2024-12-04 01:18:05', '2024-12-04 01:18:05', 1169000, 0),
(54, 104, 41, 189, 1, 'L', '2024-12-04 01:18:05', '2024-12-04 01:18:05', 1169000, 0),
(55, 108, 42, 202, 1, 'L', '2024-12-04 02:40:18', '2024-12-04 02:40:18', 359000, 0),
(56, 104, 43, 189, 1, 'XL', '2024-12-04 02:59:20', '2024-12-04 02:59:20', 1169000, 0),
(57, 104, 44, 189, 1, 'L', '2024-12-04 03:40:45', '2024-12-04 03:40:45', 1169000, 0),
(58, 102, 45, 183, 1, 'L', '2024-12-08 05:58:17', '2024-12-08 05:58:17', 664050, 0),
(59, 104, 45, 189, 3, 'XL', '2024-12-08 05:58:17', '2024-12-08 05:58:17', 1169000, 0),
(60, 102, 46, 183, 1, 'L', '2024-12-08 06:07:57', '2024-12-08 06:07:57', 664050, 0),
(61, 108, 46, 202, 1, 'M', '2024-12-08 06:07:57', '2024-12-08 06:07:57', 359000, 0),
(62, 105, 47, 192, 1, 'S', '2024-12-09 00:03:38', '2024-12-09 00:03:38', 539000, 0),
(63, 105, 48, 192, 1, 'M', '2024-12-09 00:33:56', '2024-12-09 00:33:56', 539000, 0),
(64, 109, 48, 205, 5, 'XL', '2024-12-09 00:33:56', '2024-12-09 00:33:56', 1169000, 0),
(65, 104, 49, 189, 1, 'L', '2024-12-09 00:35:06', '2024-12-09 00:35:06', 1169000, 0),
(66, 105, 49, 192, 3, '2XL', '2024-12-09 00:35:06', '2024-12-09 00:35:06', 539000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status`) VALUES
(1, 'Chưa xác nhận'),
(2, 'Đã xác nhận'),
(3, 'Đang chuẩn bị'),
(4, 'Đang vận chuyển'),
(5, 'Đã giao'),
(6, 'Hoàn thành'),
(7, 'Huỷ hàng'),
(8, 'Hoàn hàng');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int NOT NULL,
  `payment_method_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `payment_method_name`) VALUES
(1, 'COD - Thanh toán khi nhận hàng'),
(2, 'VNPAY - Thanh toán online - Đã  thanh toán');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product_name` text NOT NULL,
  `product_description` text,
  `view` int DEFAULT '0',
  `status` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_description`, `view`, `status`, `created_at`, `update_at`) VALUES
(102, ' Áo Phao Nam Trần Trám Nẹp Giấu Khoá', 'abc', 86, 1, '2024-11-30 17:10:20', NULL),
(104, ' Phao Vip Nữ Lông Vũ Tay Raglan Có Mũ', 'Sản phẩm dày dặn phù hợp cho mùa đông', 22, 1, '2024-12-02 00:17:32', NULL),
(105, ' Áo Khoác Thể Thao Nữ Siêu Nhẹ Siêu Co Giãn Chống Tia Uv', 'Sản phẩm dày, nhẹ, thoáng mát ', 97, 1, '2024-12-02 00:21:39', NULL),
(106, ' Áo Phao Nữ Dáng Dài Lỡ Trần Sóng Mũ Rời', 'Sản phẩm dày dặn với màu sắc hài hoà, phù hợp cho mùa đông', 4, 1, '2024-12-02 00:26:48', '2024-12-03 16:41:43'),
(108, 'Áo Len Nữ Cổ Bẻ', 'Sản phẩm dày dặn ấm áp', 9, 1, '2024-12-03 14:41:52', NULL),
(109, ' Phao Vip Nữ Lông Vũ Tay Raglan Có Mũ', 'Sản phẩm dày dặn, kín đáo, giữ ấm cho mùa đông', 3, 1, '2024-12-03 14:46:02', NULL),
(110, ' Áo Polo Thể Thao Nam Airy Cool Phối Bo', 'Sản phẩm thoáng mát, lịch lãm', 0, 1, '2024-12-03 14:52:17', NULL),
(111, 'Quần Jean Nữ Giấy Tencel Suông Chiết Ly', 'Siêu thoải mái cùng Quần Jean Nữ Giấy Tencel Suông Chiết Ly. Quần được làm tự sợi tencel có độ bóng mờ, vẻ ngoài cổ điển, giản dị, cảm giác tay mềm mại. Thiết kế dáng suông siêu thoải mái cùng chất mềm, nhẹ và vô cùng thoáng cho ngày hè tự tin diện đẹp.', 2, 1, '2024-12-03 14:55:22', NULL),
(112, ' Áo Khoác Nỉ Thể Thao Nam Double Face Smart', 'Áo khoác nỉ cổ dựng, có túi khóa hai bên sườn, thân sau có logo cao su in cao thành cùng màu vải chính. Form dáng cơ bản ôm vừa tôn dáng mang lại cảm giác gọn gàng cho người mặc. Thiết kế trơn màu đơn giản.', 8, 1, '2024-12-03 14:58:32', NULL),
(113, ' Áo Polo Nữ Chân Nẹp Chéo, Phối Màu', 'Polo Airycool vẫn luôn là lựa chọn hàng đầu của các tín đồ YODY. Áo cho cảm giác mặc chạm mát tức thì trên da nên vô cùng dễ dịu. Thấm hút nhanh, khô nhanh, co giãn và đàn hồi tốt đều là những điểm cộng không nên bỏ lỡ khi tìm kiếm em áo polo diện đẹp đi làm, đi chơi hàng ngày.', 0, 1, '2024-12-03 15:04:38', NULL),
(114, ' ÁO POLO NỮ ICE CAFE IN SƯỜN', 'Nằm trong BST Polo Cool, áo polo có form slimfit phù hợp với nhiều dáng người. Chi tiết hình in phối màu sườn áo và nẹp áo mang phong cách thể thao khoẻ khoắn. Công nghệ in silicon bền chắc sau nhiều lần giặt.', 0, 1, '2024-12-03 15:10:22', NULL),
(115, ' Áo Phao Nam Trần Trám Nẹp Giấu Khoá', 'abvc', 0, 1, '2024-12-09 00:49:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating_star` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `variant_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_detail_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating_star`, `content`, `variant_id`, `created_at`, `order_detail_id`) VALUES
(6, 102, 6, 5, 'Sản phẩm chất lượng', 183, '2024-12-01 16:43:12', 34),
(9, 105, 1, 5, 'Sản phẩm chất lượng', 192, '2024-12-02 01:07:53', 39),
(10, 102, 1, 5, 'Sản phẩm chất lượng\r\n', 183, '2024-12-02 01:08:13', 40),
(11, 105, 1, 4, 'ádấdsda', 194, '2024-12-09 01:50:35', 38),
(12, 105, 1, 5, 'q21323123', 194, '2024-12-09 01:50:49', 38);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int NOT NULL,
  `size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, '2XL');

-- --------------------------------------------------------

--
-- Table structure for table `size_details`
--

CREATE TABLE `size_details` (
  `id` int NOT NULL,
  `variant_id` int NOT NULL,
  `quantity_size` int NOT NULL,
  `size_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `size_details`
--

INSERT INTO `size_details` (`id`, `variant_id`, `quantity_size`, `size_id`) VALUES
(273, 183, 0, 1),
(274, 183, 0, 2),
(275, 183, 20, 3),
(276, 183, 7, 4),
(277, 183, 0, 5),
(278, 184, 2, 1),
(279, 184, 3, 2),
(280, 184, 23, 3),
(281, 184, 112, 4),
(282, 184, 2, 5),
(283, 185, 2, 1),
(284, 185, 32, 2),
(285, 185, 21, 3),
(286, 185, 1, 4),
(287, 185, 0, 5),
(303, 189, 11, 1),
(304, 189, 0, 2),
(305, 189, 21, 3),
(306, 189, 14, 4),
(307, 189, 0, 5),
(308, 190, 12, 1),
(309, 190, 32, 2),
(310, 190, 12, 3),
(311, 190, 12, 4),
(312, 190, 0, 5),
(313, 191, 1, 1),
(314, 191, 12, 2),
(315, 191, 12, 3),
(316, 191, 32, 4),
(317, 191, 0, 5),
(318, 192, 6, 1),
(319, 192, 33, 2),
(320, 192, 22, 3),
(321, 192, 10, 4),
(322, 192, 12, 5),
(323, 193, 16, 1),
(324, 193, 4, 2),
(325, 193, 12, 3),
(326, 193, 17, 4),
(327, 193, 0, 5),
(328, 194, 1, 1),
(329, 194, 30, 2),
(330, 194, 12, 3),
(331, 194, 12, 4),
(332, 194, 22, 5),
(333, 195, 121, 1),
(334, 195, 132, 2),
(335, 195, 23, 3),
(336, 195, 119, 4),
(337, 195, 32, 5),
(338, 196, 12, 1),
(339, 196, 32, 2),
(340, 196, 21, 3),
(341, 196, 12, 4),
(342, 196, 32, 5),
(343, 197, 23, 1),
(344, 197, 22, 2),
(345, 197, 12, 3),
(346, 197, 32, 4),
(347, 197, 22, 5),
(348, 198, 12, 1),
(349, 198, 23, 2),
(350, 198, 23, 3),
(351, 198, 21, 4),
(352, 198, 23, 5),
(368, 202, 12, 1),
(369, 202, 54, 2),
(370, 202, 331, 3),
(371, 202, 34, 4),
(372, 202, 22, 5),
(373, 203, 12, 1),
(374, 203, 33, 2),
(375, 203, 43, 3),
(376, 203, 12, 4),
(377, 203, 32, 5),
(378, 204, 12, 1),
(379, 204, 23, 2),
(380, 204, 33, 3),
(381, 204, 20, 4),
(382, 204, 33, 5),
(383, 205, 119, 1),
(384, 205, 322, 2),
(385, 205, 122, 3),
(386, 205, 317, 4),
(387, 205, 223, 5),
(388, 206, 223, 1),
(389, 206, 211, 2),
(390, 206, 223, 3),
(391, 206, 122, 4),
(392, 206, 123, 5),
(393, 207, 123, 1),
(394, 207, 222, 2),
(395, 207, 332, 3),
(396, 207, 122, 4),
(397, 207, 234, 5),
(398, 208, 22, 1),
(399, 208, 32, 2),
(400, 208, 123, 3),
(401, 208, 21, 4),
(402, 208, 32, 5),
(403, 209, 23, 1),
(404, 209, 23, 2),
(405, 209, 43, 3),
(406, 209, 65, 4),
(407, 209, 34, 5),
(408, 210, 123, 1),
(409, 210, 223, 2),
(410, 210, 432, 3),
(411, 210, 234, 4),
(412, 210, 234, 5),
(413, 211, 123, 1),
(414, 211, 233, 2),
(415, 211, 232, 3),
(416, 211, 123, 4),
(417, 211, 232, 5),
(418, 212, 123, 1),
(419, 212, 234, 2),
(420, 212, 454, 3),
(421, 212, 343, 4),
(422, 212, 233, 5),
(423, 213, 123, 1),
(424, 213, 232, 2),
(425, 213, 12, 3),
(426, 213, 122, 4),
(427, 213, 232, 5),
(428, 214, 123, 1),
(429, 214, 232, 2),
(430, 214, 121, 3),
(431, 214, 123, 4),
(432, 214, 232, 5),
(433, 215, 122, 1),
(434, 215, 234, 2),
(435, 215, 234, 3),
(436, 215, 324, 4),
(437, 215, 323, 5),
(438, 216, 23, 1),
(439, 216, 23, 2),
(440, 216, 23, 3),
(441, 216, 12, 4),
(442, 216, 10, 5),
(443, 217, 22, 1),
(444, 217, 33, 2),
(445, 217, 22, 3),
(446, 217, 12, 4),
(447, 217, 23, 5),
(448, 218, 12, 1),
(449, 218, 23, 2),
(450, 218, 23, 3),
(451, 218, 12, 4),
(452, 218, 33, 5),
(453, 219, 22, 1),
(454, 219, 123, 2),
(455, 219, 22, 3),
(456, 219, 11, 4),
(457, 219, 23, 5),
(458, 220, 123, 1),
(459, 220, 234, 2),
(460, 220, 322, 3),
(461, 220, 123, 4),
(462, 220, 121, 5),
(463, 221, 123, 1),
(464, 221, 212, 2),
(465, 221, 123, 3),
(466, 221, 321, 4),
(467, 221, 122, 5),
(468, 222, 123, 1),
(469, 222, 123, 2),
(470, 222, 111, 3),
(471, 222, 212, 4),
(472, 222, 122, 5),
(473, 223, 23, 1),
(474, 223, 32, 2),
(475, 223, 12, 3),
(476, 223, 22, 4),
(477, 223, 0, 5),
(478, 224, 23, 1),
(479, 224, 22, 2),
(480, 224, 33, 3),
(481, 224, 44, 4),
(482, 224, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `avatar` text,
  `role_id` int DEFAULT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `date_of_birth`, `gender`, `status`, `avatar`, `role_id`, `password`, `created_at`, `update_at`) VALUES
(1, 'Đỗ Văn Thái', 'thaidvph50988@gmail.com', '0388954747', '2003-10-15', 'Nam', 1, './uploads/1733047371z5883237060167_d88d90c70e56cef9bdc2757b3c5d81dd (1).jpg', 0, '$2y$10$/CfX2FIbN7grGgwEcHj0Q.Kiwjgjv/4y2Gt9mFCdEDN/mKxW5ce3.', '2024-11-19 05:30:44', '2024-12-01 10:02:51'),
(4, 'Nguyễn Tuyễn Vũ', 'ngtvu23423@gmail.cpm', '0983485732', '2005-09-14', 'Nam', 1, './uploads/1732026822DALL·E 2024-10-31 19.30.02 - A modern, minimalist logo for \'TNM Clothes\' with bold, clear \'TNM\' lettering and the word \'Clothes\' in smaller, elegant text directly below it. The de.webp', 2, '$2y$10$y/7KbrTlTkg7x2NgwDZDbeIpWzkE9R6xJin61ygHxAXdJlqtH5aIO', '2024-11-19 14:33:42', '0000-00-00 00:00:00'),
(5, 'Phạm Ngọc Nal', 'lannp@gmail.com', '0923849393', '2005-05-31', 'Nữ', 1, './uploads/1732027969images.jpg', 2, '$2y$10$vR1BZb2RpdestdZag6zhyugeGliMTg7843J1MKkx27kXNyz8UyK1.', '2024-11-19 14:52:49', '0000-00-00 00:00:00'),
(6, 'Lý Cẩm Lee', 'lee@gmail.com', '0923493843', '2005-11-06', 'Nam', 1, './uploads/1732028672DALL·E 2024-10-31 19.30.02 - A modern, minimalist logo for \'TNM Clothes\' with bold, clear \'TNM\' lettering and the word \'Clothes\' in smaller, elegant text directly below it. The de.webp', 2, '$2y$10$DdoWSdwRh6cijsVPZxaks.iA8Wi.ETyjcW1GM6K8mkSx3uhSjUTBO', '2024-11-19 15:04:32', '0000-00-00 00:00:00'),
(7, 'Đỗ Văn Thái', 'thaidvph50988123@gmail.com', '0388954747', '2005-12-10', 'Nam', 1, './uploads/1732672202DALL·E 2024-10-31 19.30.16 - A modern, minimalist logo for \'TNM Clothes\' with clearly recognizable and bold letters \'TNM.\' The design should use sleek, sharp typography with each .webp', 2, '$2y$10$OHZD8Vdaov4yX4nkWpDbXuKjjsl6kfaTFXlVU/68jg9JLJQHsHPte', '2024-11-27 01:50:02', '2024-11-27 01:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `color` varchar(50) NOT NULL,
  `thumbnail_variant` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` int DEFAULT NULL,
  `promotion_price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `product_id`, `color`, `thumbnail_variant`, `price`, `promotion_price`) VALUES
(183, 102, 'Rêu đen', './uploads/1732986620PHM7009-XDE, ATM7004-TRA (4).webp', 699000, 664050),
(184, 102, 'Xanh đen', './uploads/1732986620PHM7009-REU, ATM7004-DEN (3).webp', 699000, 664050),
(185, 102, 'Cát cháy', './uploads/1732986620ao-phao-nam-yody-PHM7009-CAC (13).webp', 699000, 664050),
(189, 104, 'Nâu', './uploads/1733098652ao-phao-nu-vip-long-vu-PVN7010-NAU (1).webp', 1299000, 1169000),
(190, 104, 'Xanh đen', './uploads/1733098652ao-phao-vip-nu-PVN7010-TIT (10).webp', 1299000, 1169000),
(191, 104, 'Trắng', './uploads/1733098652ao-phao-nu-vip-long-vu-PVN7010-TRA (1).webp', 1299000, 1169000),
(192, 105, 'Xanh nhạt', './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-XNH (10).webp', 599000, 539000),
(193, 105, 'Trắng', './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-GNH (10).webp', 599000, 539000),
(194, 105, 'Hồng phấn', './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-HPH (10).webp', 599000, 539000),
(195, 106, 'Be', './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-BEE (6).webp', 1399000, 1259000),
(196, 106, 'Xanh lơ', './uploads/1733099208ao-khoac-the-thao-nu-SKN7007-XNH (16).webp', 1399000, 1259000),
(197, 106, 'Tím than', './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-TIT (4).webp', 1399000, 1259000),
(198, 106, 'Đen', './uploads/1733099208ao-phao-nu-PVN7032-DEN (2).webp', 1399000, 1259000),
(202, 108, 'Nâu', './uploads/1733236912ao-len-nu-yody-ALN7026-NAU (4).webp', 399000, 359000),
(203, 108, 'Đen', './uploads/1733236912ao-len-nu-yody-ALN7026-DEN (4).webp', 399000, 359000),
(204, 108, 'Đỏ', './uploads/1733236912ao-len-nu-yody-ALN7026-DDO (5).webp', 399000, 359000),
(205, 109, 'Tím than', './uploads/1733237162ao-phao-vip-nu-PVN7010-TIT (10) (1).webp', 1299000, 1169000),
(206, 109, 'Đen', './uploads/1733237162ao-phao-nu-vip-long-vu-PVN7010-DEN (1).webp', 1299000, 1169000),
(207, 109, 'Trắng', './uploads/1733237162ao-phao-nu-vip-long-vu-PVN7010-TRA (1) (1).webp', 1299000, 1169000),
(208, 110, 'Đen', './uploads/1733237537sam5003-den-4.webp', 799000, 659000),
(209, 110, 'Xanh xám', './uploads/1733237537sam5003-xla-14.webp', 799000, 659000),
(210, 110, 'Trắng', './uploads/1733237537sam5003-tra-4.webp', 799000, 659000),
(211, 111, 'Xanh', './uploads/1733237722quan-jeans-nu-yody-BLN7016-TRA, QJN7062-XAH (4).webp', 399000, 329000),
(212, 111, 'Xanh nhạt', './uploads/1733237723quan-jeans-nu-yody-QJN7062-XNH (8).webp', 399000, 329000),
(213, 112, 'Trắng', './uploads/1733237912ao-khoac-nam-swm6005-bee-2.webp', 590000, 529000),
(214, 112, 'Xanh đen', './uploads/1733237912ao-khoac-nam-swm6005-nav-5.webp', 590000, 529000),
(215, 112, 'Đen', './uploads/1733237912ao-khoac-nam-swm6005-den-3.webp', 590000, 529000),
(216, 113, 'Vàng', './uploads/1733238278ao-polo-nu-yody-APN7218-VAG, QJN7046-XDM (4).webp', 259000, 169000),
(217, 113, 'Hồng nhạt', './uploads/1733238278ao-polo-nu-yody-APN7218-HOG, QAN6046-DEN (4).webp', 259000, 169000),
(218, 113, 'Xanh đen', './uploads/1733238278ao-polo-nu-yody-APN7218-NAV (5).webp', 259000, 169000),
(219, 113, 'Trắng', './uploads/1733238278ao-polo-nu-yody-APN7218-TRA, SSN7018-GHI (3).webp', 259000, 169000),
(220, 114, 'Hồng', './uploads/1733238622apn7254-hog-cvn6150-ghd-4.webp', 329000, 299000),
(221, 114, 'Trắng', './uploads/1733238622apn7254-trg-4.webp', 329000, 299000),
(222, 114, 'Xanh đen', './uploads/1733238622apn7254-nav-qan6208-nau-10.webp', 329000, 299000),
(223, 115, 'Đen', './uploads/1733705388ao-khoac-nam-swm6005-den-6.webp', 699000, 664050),
(224, 115, 'Trắng', './uploads/1733705388ao-khoac-nam-swm6005-bee-2.webp', 699000, 664050);

-- --------------------------------------------------------

--
-- Table structure for table `variant_albums`
--

CREATE TABLE `variant_albums` (
  `id` int NOT NULL,
  `variant_id` int NOT NULL,
  `link_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `variant_albums`
--

INSERT INTO `variant_albums` (`id`, `variant_id`, `link_image`) VALUES
(482, 183, './uploads/1732986620PHM7009-XDE, ATM7004-TRA, QKM6017-XAM (3).webp'),
(483, 183, './uploads/1732986620PHM7009-XDE, ATM7004-TRA (6).webp'),
(484, 183, './uploads/1732986620PHM7009-XDE, ATM7004-TRA (5).webp'),
(485, 184, './uploads/1732986620PHM7009-REU, ATM7004-DEN, QJM7005-DNI (3).webp'),
(486, 184, './uploads/1732986620PHM7009-REU, ATM7004-DEN (1).webp'),
(487, 184, './uploads/1732986620PHM7009-REU, ATM7004-DEN (4).webp'),
(488, 185, './uploads/1732986620ao-phao-nam-yody-PHM7009-CAC (18).webp'),
(489, 185, './uploads/1732986620ao-phao-nam-yody-PHM7009-CAC (7).webp'),
(499, 189, './uploads/1733098652ao-phao-nu-vip-long-vu-PVN7010-NAU (6).webp'),
(500, 189, './uploads/1733098652ao-phao-nu-vip-long-vu-PVN7010-NAU (2).webp'),
(501, 189, './uploads/1733098652ao-phao-nu-vip-long-vu-PVN7010-NAU (7).webp'),
(502, 190, './uploads/1733098652ao-phao-vip-nu-PVN7010-TIT (12).webp'),
(503, 190, './uploads/1733098652ao-phao-vip-nu-PVN7010-TIT (16).webp'),
(504, 190, './uploads/1733098652ao-phao-vip-nu-PVN7010-TIT (17).webp'),
(505, 190, './uploads/1733098652ao-phao-vip-nu-PVN7010-TIT (11).webp'),
(506, 191, './uploads/1733098652ao-phao-nu-vip-long-vu-PVN7010-TRA (7).webp'),
(507, 191, './uploads/1733098652ao-phao-nu-vip-long-vu-PVN7010-TRA (3).webp'),
(508, 191, './uploads/1733098652ao-phao-nu-vip-long-vu-PVN7010-TRA (8).webp'),
(509, 192, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-XNH (12).webp'),
(510, 192, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-XNH (16).webp'),
(511, 192, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-XNH (14) - Copy.webp'),
(512, 192, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-XNH (17) - Copy.webp'),
(513, 193, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-GNH (12).webp'),
(514, 193, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-GNH (16).webp'),
(515, 193, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-GNH (11) - Copy.webp'),
(516, 194, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-GNH (10).webp'),
(517, 194, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-HPH (13).webp'),
(518, 194, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-HPH (14).webp'),
(519, 194, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-HPH (12).webp'),
(520, 194, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-HPH (11).webp'),
(521, 194, './uploads/1733098899ao-khoac-the-thao-nu-SKN7007-HPH (16).webp'),
(522, 195, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-BEE (2).webp'),
(523, 195, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-BEE (4).webp'),
(524, 195, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-BEE (3).webp'),
(525, 195, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-BEE (1).webp'),
(526, 196, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-XLO (2).webp'),
(527, 196, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-XLO (6).webp'),
(528, 196, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-XLO (8).webp'),
(529, 196, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-XLO (3).webp'),
(530, 196, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-XLO (1).webp'),
(531, 196, './uploads/1733099208ao-khoac-the-thao-nu-SKN7007-XNH (12).webp'),
(532, 197, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-TIT (2).webp'),
(533, 197, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-TIT (6).webp'),
(534, 197, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-TIT (1).webp'),
(535, 197, './uploads/1733099208ao-phao-nu-dang-dai-PVN7032-TIT (9).webp'),
(536, 198, './uploads/1733099208ao-phao-nu-PVN7032-DEN (1).webp'),
(537, 198, './uploads/1733099208ao-phao-nu-PVN7032-DEN (6).webp'),
(551, 202, './uploads/1733236912ao-len-nu-yody-ALN7026-NAU (9).webp'),
(552, 202, './uploads/1733236912ao-len-nu-yody-QAN7138-BEE, ALN7026-NAU (1).webp'),
(553, 202, './uploads/1733236912ao-len-nu-yody-ALN7026-NAU (8).webp'),
(554, 202, './uploads/1733236912ao-len-nu-yody-ALN7026-NAU (6) - Copy.webp'),
(555, 203, './uploads/1733236912ao-len-nu-yody-ALN7026-DEN (1).webp'),
(556, 203, './uploads/1733236912ao-len-nu-yody-ALN7026-DEN, QJN7014-XNH (1).webp'),
(557, 203, './uploads/1733236912ao-len-nu-yody-ALN7026-DEN (6).webp'),
(558, 203, './uploads/1733236912ao-len-nu-yody-ALN7026-DEN (5) - Copy.webp'),
(559, 204, './uploads/1733236912ao-len-nu-yody-ALN7026-DDO (8).webp'),
(560, 204, './uploads/1733236912ao-len-nu-yody-ALN7026-DDO (9).webp'),
(561, 204, './uploads/1733236912ao-len-nu-yody-ALN7026-DDO, CVN7167-GHD (1).webp'),
(562, 204, './uploads/1733236912ao-len-nu-yody-ALN7026-DDO (6).webp'),
(563, 204, './uploads/1733236912ao-len-nu-yody-ALN7026-DDO (3).webp'),
(564, 205, './uploads/1733237162ao-phao-nu-PVN7010-TIT  (7).webp'),
(565, 205, './uploads/1733237162ao-phao-nu-PVN7010-TIT  (2).webp'),
(566, 205, './uploads/1733237162ao-phao-nu-PVN7010-TIT  (1).webp'),
(567, 205, './uploads/1733237162ao-phao-vip-nu-PVN7010-TIT (13).webp'),
(568, 205, './uploads/1733237162ao-phao-vip-nu-PVN7010-TIT (16) (1).webp'),
(569, 205, './uploads/1733237162ao-phao-vip-nu-PVN7010-TIT (17) (1).webp'),
(570, 206, './uploads/1733237162ao-phao-vip-nu-PVN7010-DEN (1).webp'),
(571, 206, './uploads/1733237162ao-phao-nu-vip-long-vu-PVN7010-DEN (2).webp'),
(572, 206, './uploads/1733237162ao-phao-nu-vip-long-vu-PVN7010-DEN (6).webp'),
(573, 206, './uploads/1733237162ao-phao-nu-vip-long-vu-PVN7010-DEN (8).webp'),
(574, 207, './uploads/1733237162ao-phao-vip-nu-PVN7010-TRA (1).webp'),
(575, 207, './uploads/1733237162ao-phao-nu-vip-long-vu-PVN7010-TRA (5).webp'),
(576, 207, './uploads/1733237162ao-phao-nu-vip-long-vu-PVN7010-TRA (7) (1).webp'),
(577, 207, './uploads/1733237162ao-phao-nu-vip-long-vu-PVN7010-TRA (3) (1).webp'),
(578, 208, './uploads/1733237537sam5003-den-2.webp'),
(579, 208, './uploads/1733237537sam5003-den-1.webp'),
(580, 208, './uploads/1733237537sam5003-den-5.webp'),
(581, 209, './uploads/1733237537sam5003-xla-10.webp'),
(582, 209, './uploads/1733237537sam5003-xla-11.webp'),
(583, 209, './uploads/1733237537sam5003-xla-15.webp'),
(584, 210, './uploads/1733237537sam5003-tra-6.webp'),
(585, 210, './uploads/1733237537sam5003-tra-3.webp'),
(586, 210, './uploads/1733237537sam5003-tra-1.webp'),
(587, 211, './uploads/1733237722quan-jeans-nu-yody-BLN7016-TRA, QJN7062-XAH (10).webp'),
(588, 211, './uploads/1733237722quan-jeans-nu-yody-BLN7016-TRA, QJN7062-XAH (12).webp'),
(589, 211, './uploads/1733237722quan-jeans-nu-yody-BLN7016-TRA, QJN7062-XAH (9).webp'),
(590, 211, './uploads/1733237722quan-jeans-nu-yody-BLN7016-TRA, QJN7062-XAH (8).webp'),
(591, 212, './uploads/1733237723quan-jeans-nu-yody-QJN7062-XNH (10).webp'),
(592, 212, './uploads/1733237723quan-jeans-nu-yody-QJN7062-XNH (9).webp'),
(593, 212, './uploads/1733237723quan-jeans-nu-yody-QJN7062-XNH (5).webp'),
(594, 212, './uploads/1733237723quan-jeans-nu-yody-QJN7062-XNH (4).webp'),
(595, 212, './uploads/1733237723quan-jeans-nu-yody-QJN7062-XNH (3).webp'),
(596, 213, './uploads/1733237912ao-khoac-nam-swm6005-bee-7.webp'),
(597, 213, './uploads/1733237912ao-khoac-nam-swm6005-bee-1.webp'),
(598, 213, './uploads/1733237912ao-khoac-nam-swm6005-bee-3.webp'),
(599, 213, './uploads/1733237912ao-khoac-nam-swm6005-bee-4.webp'),
(600, 214, './uploads/1733237912ao-khoac-nam-swm6005-nav-6.webp'),
(601, 214, './uploads/1733237912ao-khoac-nam-swm6005-nav-3.webp'),
(602, 214, './uploads/1733237912ao-khoac-nam-swm6005-nav-1.webp'),
(603, 214, './uploads/1733237912ao-khoac-nam-swm6005-nav-4.webp'),
(604, 215, './uploads/1733237912ao-khoac-nam-swm6005-den-6.webp'),
(605, 215, './uploads/1733237912ao-khoac-nam-swm6005-den-5.webp'),
(606, 215, './uploads/1733237912ao-khoac-nam-swm6005-den-2.webp'),
(607, 215, './uploads/1733237912ao-khoac-nam-swm6005-den-4.webp'),
(608, 216, './uploads/1733238278ao-polo-nu-yody-APN7218-VAG (3).webp'),
(609, 216, './uploads/1733238278ao-polo-nu-yody-APN7218-VAG (1).webp'),
(610, 216, './uploads/1733238278ao-polo-nu-yody-APN7218-VAG, QJN7046-XDM (2).webp'),
(611, 216, './uploads/1733238278ao-polo-nu-yody-APN7218-VAG, QJN7046-XDM (7).webp'),
(612, 216, './uploads/1733238278ao-polo-nu-yody-APN7218-VAG, QJN7046-XDM (6).webp'),
(613, 217, './uploads/1733238278ao-polo-nu-yody-APN7218-HOG (4).webp'),
(614, 217, './uploads/1733238278ao-polo-nu-yody-APN7218-HOG (3).webp'),
(615, 217, './uploads/1733238278ao-polo-nu-yody-APN7218-HOG, QAN6046-DEN (3).webp'),
(616, 217, './uploads/1733238278ao-polo-nu-yody-APN7218-HOG, QAN6046-DEN (1).webp'),
(617, 217, './uploads/1733238278ao-polo-nu-yody-APN7218-HOG, QAN6046-DEN (5).webp'),
(618, 218, './uploads/1733238278ao-polo-nu-yody-APN7218-NAV (3).webp'),
(619, 218, './uploads/1733238278ao-polo-nu-yody-APN7218-NAV (2).webp'),
(620, 218, './uploads/1733238278ao-polo-nu-yody-APN7218-NAV (1).webp'),
(621, 218, './uploads/1733238278ao-polo-nu-yody-APN7218-NAV (6).webp'),
(622, 219, './uploads/1733238278ao-polo-nu-yody-APN7218-TRA (2).webp'),
(623, 219, './uploads/1733238278ao-polo-nu-yody-APN7218-TRA, SSN7018-GHI (1).webp'),
(624, 220, './uploads/1733238622apn7254-hog-cvn6150-ghd-9.webp'),
(625, 220, './uploads/1733238622apn7254-hog-cvn6150-ghd-3.webp'),
(626, 220, './uploads/1733238622apn7254-hog-cvn6150-ghd-1.webp'),
(627, 221, './uploads/1733238622apn7254-trg-1.webp'),
(628, 221, './uploads/1733238622apn7254-trg-3.webp'),
(629, 221, './uploads/1733238622apn7254-trg-6.webp'),
(630, 221, './uploads/1733238622apn7254-trg-5.webp'),
(631, 222, './uploads/1733238622apn7254-nav-qan6208-nau-8.webp'),
(632, 222, './uploads/1733238622apn7254-nav-qan6208-nau-2.webp'),
(633, 222, './uploads/1733238622apn7254-nav-qan6208-nau-7.webp'),
(634, 222, './uploads/1733238622apn7254-nav-qan6208-nau-6.webp'),
(635, 223, './uploads/1733705388ao-khoac-nam-swm6005-den-5.webp'),
(636, 223, './uploads/1733705388ao-khoac-nam-swm6005-den-2.webp'),
(637, 223, './uploads/1733705388ao-khoac-nam-swm6005-den-4.webp'),
(638, 223, './uploads/1733705388ao-khoac-nam-swm6005-den-3.webp'),
(639, 224, './uploads/1733705388ao-khoac-nam-swm6005-bee-7.webp'),
(640, 224, './uploads/1733705388ao-khoac-nam-swm6005-bee-1.webp'),
(641, 224, './uploads/1733705388ao-khoac-nam-swm6005-bee-3.webp'),
(642, 224, './uploads/1733705388ao-khoac-nam-swm6005-bee-4.webp');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int NOT NULL,
  `title_voucher` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `used_count` int NOT NULL,
  `created_date` timestamp NOT NULL,
  `end_date` datetime NOT NULL,
  `disscount_value` int NOT NULL,
  `max_disscount_amount` int NOT NULL,
  `min_order_amount` int NOT NULL,
  `quantity_limit` int NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `title_voucher`, `description`, `used_count`, `created_date`, `end_date`, `disscount_value`, `max_disscount_amount`, `min_order_amount`, `quantity_limit`, `status`) VALUES
(1, 'Giảm giá 15% tối đa 50k cho đơn hàng từ 400.000', 'Abc', 2, '2024-11-19 17:00:00', '2024-11-21 21:31:00', 15, 50000, 400000, 15, 1),
(2, 'Giảm giá 15% cho đơn hàng 300k Tối đa 20k', 'Giảm giá 15% cho đơn hàng 300k Tối đa 20k', 15, '2024-11-20 17:00:00', '2024-11-26 12:00:00', 15, 20000, 300000, 15, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_details`
--
ALTER TABLE `category_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_status_id` (`order_status_id`),
  ADD KEY `payment_method_id` (`payment_method_id`),
  ADD KEY `voucher_id` (`voucher_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `variant_id` (`variant_id`),
  ADD KEY `order_detail_id` (`order_detail_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size_details`
--
ALTER TABLE `size_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `size_id` (`size_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `variant_albums`
--
ALTER TABLE `variant_albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category_details`
--
ALTER TABLE `category_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `size_details`
--
ALTER TABLE `size_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `variant_albums`
--
ALTER TABLE `variant_albums`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=643;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_details_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_details_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_details_ibfk_5` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `category_details`
--
ALTER TABLE `category_details`
  ADD CONSTRAINT `category_details_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `category_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reviews_ibfk_5` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reviews_ibfk_6` FOREIGN KEY (`order_detail_id`) REFERENCES `order_details` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `size_details`
--
ALTER TABLE `size_details`
  ADD CONSTRAINT `size_details_ibfk_1` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `size_details_ibfk_2` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `variant_albums`
--
ALTER TABLE `variant_albums`
  ADD CONSTRAINT `variant_albums_ibfk_1` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
