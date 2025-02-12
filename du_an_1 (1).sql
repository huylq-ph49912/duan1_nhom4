-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2024 at 05:32 PM
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
-- Database: `du_an_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bai_viets`
--

CREATE TABLE `bai_viets` (
  `id` int NOT NULL,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_dang` date NOT NULL,
  `trang_thai` enum('active','inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bai_viets`
--

INSERT INTO `bai_viets` (`id`, `tieu_de`, `noi_dung`, `ngay_dang`, `trang_thai`) VALUES
(2, 'Giảm giá mạnh nè anh em ^^', 'Nhân ngày 19-11 quốc tế đàn ông, mixishop sẽ tặng cho anh chị em một mã giảm giá cực sốc', '2024-11-18', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int NOT NULL,
  `ten_banner` varchar(255) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `mo_ta` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `ten_banner`, `hinh_anh`, `mo_ta`) VALUES
(3, 'Banner mixi', './uploads/17321318271.png', ''),
(4, 'Mixi Sale', './uploads/17321326572.png', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `binh_luans`
--

CREATE TABLE `binh_luans` (
  `id` int NOT NULL,
  `nguoi_dung_id` text NOT NULL,
  `san_pham_id` int NOT NULL,
  `noi_dung` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `trang_thai` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `binh_luans`
--

INSERT INTO `binh_luans` (`id`, `nguoi_dung_id`, `san_pham_id`, `noi_dung`, `created_at`, `trang_thai`) VALUES
(24, '16', 2, 'Sản phẩm quá đẹp', '2024-12-05 10:30:26', 1),
(25, '14', 2, 'Okok', '2024-12-06 12:09:07', 1),
(26, '14', 1, 'Áo Đẹp', '2024-12-07 16:24:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id` int NOT NULL,
  `don_hang_id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `don_gia` int NOT NULL,
  `so_luong` int NOT NULL,
  `tai_khoan_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chi_tiet_don_hangs`
--

INSERT INTO `chi_tiet_don_hangs` (`id`, `don_hang_id`, `san_pham_id`, `don_gia`, `so_luong`, `tai_khoan_id`) VALUES
(1, 97, 9, 300000, 3, 5),
(2, 97, 6, 300000, 1, 5),
(3, 96, 7, 300000, 5, 5),
(4, 96, 7, 300000, 2, 5),
(5, 106, 2, 300000, 2, 5),
(6, 106, 5, 300000, 1, 5),
(7, 106, 10, 300000, 1, 5),
(8, 107, 15, 300000, 1, 5),
(9, 108, 10, 300000, 1, 5),
(10, 109, 15, 300000, 1, 5),
(11, 110, 12, 300000, 4, 5),
(12, 110, 6, 300000, 1, 5),
(13, 111, 12, 300000, 1, 5),
(17, 113, 10, 300000, 1, 9),
(23, 119, 10, 300000, 1, 9),
(24, 119, 1, 300000, 1, 9),
(25, 119, 14, 300000, 1, 9),
(33, 145, 4, 500, 1, 5),
(34, 146, 2, 250, 5, 5),
(35, 147, 10, 400, 3, 12),
(36, 148, 4, 500, 9, 12),
(38, 150, 4, 500, 3, 12),
(39, 151, 1, 110, 3, 12),
(40, 152, 1, 110, 500, 12),
(42, 154, 14, 300000, 2, 12),
(43, 155, 2, 250, 450, 12),
(45, 157, 1, 110, 35, 14),
(46, 158, 2, 250000, 1, 14),
(47, 158, 10, 170000, 1, 14),
(48, 158, 5, 230000, 1, 14),
(49, 159, 1, 130000, 1, 15),
(50, 160, 2, 250000, 1, 16),
(51, 161, 4, 480000, 10, 14),
(52, 162, 15, 290000, 2, 14),
(53, 162, 2, 250000, 1, 14),
(54, 163, 4, 480000, 1, 14),
(55, 164, 2, 250000, 1, 14),
(56, 165, 1, 130000, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_gio_hangs`
--

CREATE TABLE `chi_tiet_gio_hangs` (
  `id` int NOT NULL,
  `gio_hang_id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `so_luong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chi_tiet_gio_hangs`
--

INSERT INTO `chi_tiet_gio_hangs` (`id`, `gio_hang_id`, `san_pham_id`, `so_luong`) VALUES
(41, 11, 2, 2),
(42, 11, 5, 1),
(43, 12, 15, 1),
(44, 12, 14, 2),
(45, 12, 10, 1),
(46, 11, 10, 1),
(47, 13, 15, 1),
(48, 14, 10, 1),
(49, 15, 15, 1),
(50, 16, 12, 4),
(51, 16, 6, 1),
(52, 17, 12, 1),
(53, 18, 9, 1),
(54, 19, 2, 1),
(55, 20, 10, 1),
(56, 21, 14, 1),
(57, 22, 12, 3),
(58, 23, 4, 1),
(59, 24, 10, 1),
(60, 24, 1, 1),
(61, 24, 14, 1),
(62, 25, 15, 1),
(63, 25, 4, 4),
(64, 26, 4, 1),
(65, 26, 2, 3),
(66, 27, 10, 1),
(67, 27, 2, 1),
(68, 28, 4, 2),
(69, 29, 15, 1),
(70, 30, 2, 1),
(71, 31, 15, 1),
(72, 32, 15, 1),
(73, 33, 4, 1),
(74, 34, 2, 5),
(75, 35, 10, 3),
(76, 36, 4, 9),
(77, 37, 2, 5),
(78, 38, 4, 3),
(79, 39, 1, 3),
(80, 40, 1, 500),
(81, 41, 14, 1),
(82, 42, 14, 2),
(83, 43, 2, 450),
(84, 44, 1, 35),
(85, 46, 1, 35),
(86, 47, 2, 1),
(87, 47, 10, 1),
(88, 47, 5, 1),
(89, 48, 1, 1),
(90, 49, 2, 1),
(91, 50, 4, 10),
(92, 51, 15, 2),
(93, 51, 2, 1),
(94, 52, 4, 1),
(95, 53, 2, 1),
(96, 54, 1, 1),
(97, 55, 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `chuc_vus`
--

CREATE TABLE `chuc_vus` (
  `id` int NOT NULL,
  `ten_chuc_vu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chuc_vus`
--

INSERT INTO `chuc_vus` (`id`, `ten_chuc_vu`) VALUES
(1, 'Quản Trị Viên'),
(2, 'Khách Hàng');

-- --------------------------------------------------------

--
-- Table structure for table `danh_gias`
--

CREATE TABLE `danh_gias` (
  `id` int NOT NULL,
  `nguoi_dung_id` text,
  `san_pham_id` int DEFAULT NULL,
  `diem_danh_gia` decimal(3,1) DEFAULT NULL,
  `noi_dung` text,
  `trang_thai` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `danh_gias`
--

INSERT INTO `danh_gias` (`id`, `nguoi_dung_id`, `san_pham_id`, `diem_danh_gia`, `noi_dung`, `trang_thai`, `created_at`) VALUES
(2, 'quan', 1, '4.5', 'Chất lượng ổn, giao hàng nhanh chóng.', 1, '2024-11-19 17:39:29'),
(3, 'phuong', 2, '3.0', 'Sản phẩm vừa đủ chất lượng nhưng giá hơi cao.', 1, '2024-11-19 17:39:29'),
(4, 'huy', 3, '4.0', 'Màu sắc đẹp nhưng hơi nhỏ hơn so với hình.', 1, '2024-11-19 17:39:29'),
(5, 'hong', 2, '5.0', 'Tuyệt vời, tôi sẽ mua thêm!', 1, '2024-11-19 17:39:29'),
(6, 'khương', 3, '2.5', 'Không như tôi mong đợi, có thể cải thiện.', 1, '2024-11-19 17:39:29'),
(44, '1', 1, '5.0', 'Sản phẩm rất tốt, tôi rất hài lòng!', 1, '2024-11-19 17:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` int NOT NULL,
  `ten_danh_muc` varchar(255) NOT NULL,
  `mo_ta` text,
  `hinh_anh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten_danh_muc`, `mo_ta`, `hinh_anh`) VALUES
(1, 'Đồ Xuân Hè ', 'Trang phục xuân hè thường được thiết kế với các chất liệu mỏng nhẹ, thoáng mát và dễ thấm hút mồ hôi, phù hợp với thời tiết ấm áp, đôi khi hơi oi bức.', 'Screenshot 2024-12-03 213547.png'),
(2, 'Đồ Thu Đông', 'Đồ thu đông thường bao gồm các trang phục được thiết kế để giữ ấm cơ thể khi thời tiết trở nên se lạnh.', 'Screenshot 2024-12-03 213503.png'),
(3, 'Cốc bình', 'Cốc và bình là các loại đồ dùng uống nước thiết yếu và có nhiều kiểu dáng, chất liệu đa dạng, phù hợp với nhu cầu sử dụng', 'Screenshot 2024-12-03 213713.png'),
(5, 'Lego', 'Logo và quà lưu niệm MixiGaming là những sản phẩm được cộng đồng người hâm mộ yêu thích, mang dấu ấn của Độ Mixi và Bộ tộc MixiGaming. Các sản phẩm này không chỉ thể hiện sự ủng hộ đối với Độ Mixi mà còn là cách để người hâm m', 'Screenshot 2024-11-29 022215.png');

-- --------------------------------------------------------

--
-- Table structure for table `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` int NOT NULL,
  `ma_don_hang` varchar(50) NOT NULL,
  `ngay_dat` date NOT NULL,
  `tong_tien` decimal(10,2) NOT NULL,
  `ngay_hoan_thanh` date DEFAULT NULL,
  `ghi_chu` text,
  `ma_khuyen_mai` varchar(50) DEFAULT NULL,
  `trang_thai_id` int NOT NULL,
  `phuong_thuc_thanh_toan_id` int NOT NULL,
  `trang_thai_thanh_toan_id` int DEFAULT '1',
  `ten_nguoi_nhan` varchar(100) DEFAULT NULL,
  `email_nguoi_nhan` varchar(100) DEFAULT NULL,
  `sdt_nguoi_nhan` varchar(15) DEFAULT NULL,
  `dia_chi_nguoi_nhan` varchar(255) NOT NULL,
  `tai_khoan_id` int NOT NULL,
  `san_pham_id` int DEFAULT NULL,
  `payment_method_id` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `don_hangs`
--

INSERT INTO `don_hangs` (`id`, `ma_don_hang`, `ngay_dat`, `tong_tien`, `ngay_hoan_thanh`, `ghi_chu`, `ma_khuyen_mai`, `trang_thai_id`, `phuong_thuc_thanh_toan_id`, `trang_thai_thanh_toan_id`, `ten_nguoi_nhan`, `email_nguoi_nhan`, `sdt_nguoi_nhan`, `dia_chi_nguoi_nhan`, `tai_khoan_id`, `san_pham_id`, `payment_method_id`) VALUES
(96, 'DH3931', '2024-11-28', '748490.00', NULL, 'ádasdsadddddddddddddádasdsadddddddddddddádasdsadddddddddddddádasdsadddddddddddddádasdsaddddddddddddd', NULL, 5, 1, 1, 'Nguyễn Huy Hoàngg', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 5, NULL, 1),
(97, 'DH7056', '2024-11-28', '748490.00', NULL, 'xin hãy đươc ạ', NULL, 5, 1, 1, 'Nguyễn Huy Hoàngg', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 5, NULL, 1),
(106, 'DH7412', '2024-12-01', '1160.00', NULL, 'oke không??', NULL, 5, 1, 1, 'Nguyễn Huy Hoàngg Hoàng nhé', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 5, NULL, 1),
(107, 'DH7273', '2024-12-02', '180.00', NULL, 'ádfghjkl', NULL, 5, 1, 1, 'Nguyễn Huy Hoàngg', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 5, NULL, 1),
(108, 'DH7232', '2024-12-03', '430.00', NULL, 'têst hôm nay nhé', NULL, 5, 1, 1, 'Nguyễn Huy Hoàngg', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 5, NULL, 1),
(109, 'DH3449', '2024-12-03', '180.00', NULL, '', NULL, 5, 1, 1, 'Nguyễn Huy Hoàngg', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 5, NULL, 1),
(110, 'DH1855', '2024-12-03', '1730.00', NULL, 'dfghjkkasdfghjkhgfdsasdfghjkqwertyu', NULL, 5, 1, 1, 'Nguyễn Huy Hoàngg', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 5, NULL, 1),
(111, 'DH7909', '2024-12-03', '380.00', NULL, 'ád', NULL, 5, 1, 1, 'Nguyễn Huy Hoàngg', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 5, NULL, 1),
(112, 'DH3088', '2024-12-03', '380.00', NULL, 'sadf', NULL, 7, 1, 1, 'Nguyễn Huy Hoàngg', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 9, NULL, 1),
(113, 'DH4427', '2024-12-03', '600580.00', NULL, 'sdfg', NULL, 7, 1, 1, 'test', 'test@gmail.com', '0123456789', 'Nhà Hoàng', 9, NULL, 1),
(114, 'DH7171', '2024-12-03', '280.00', NULL, '', NULL, 5, 1, 1, 'Nguyễn Huy Hoàngg', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 5, NULL, 1),
(115, 'DH3915', '2024-12-03', '430.00', NULL, 'sdfg', NULL, 7, 1, 1, 'test', 'test@gmail.com', '0123456789', 'Nhà Hoàng', 9, NULL, 1),
(116, 'DH2419', '2024-12-03', '300030.00', NULL, '', NULL, 7, 1, 1, 'test', 'test@gmail.com', '0123456789', 'Nhà Hoàng', 9, NULL, 1),
(117, 'DH5951', '2024-12-03', '1080.00', NULL, '', NULL, 5, 1, 1, 'test', 'test@gmail.com', '0123456789', 'Nhà Hoàng', 9, NULL, 1),
(118, 'DH7544', '2024-12-03', '530.00', NULL, '', NULL, 5, 1, 1, 'test', 'test@gmail.com', '0123456789', 'Nhà Hoàng', 9, NULL, 1),
(119, 'DH8408', '2024-12-03', '300540.00', NULL, '', NULL, 5, 1, 1, 'test', 'test@gmail.com', '0123456789', 'Nhà Hoàng', 9, NULL, 1),
(120, 'DH8875', '2024-12-03', '2180.00', NULL, 'hàng mơi snhaast', NULL, 5, 1, 1, 'test', 'test@gmail.com', '0123456789', 'Nhà Hoàng', 9, NULL, 1),
(145, 'DH5527', '2024-12-03', '530.00', NULL, 'mới nhất', NULL, 1, 1, 1, 'Nguyễn Huy Hoàngg', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 5, NULL, 1),
(146, 'DH4184', '2024-12-03', '1280.00', NULL, 'nhất định đc', NULL, 1, 1, 1, 'Nguyễn Huy Hoàngg', 'hoangnhph50063@gmail.com', '0123456789', 'Nhà Hoàng', 5, NULL, 1),
(147, 'DH7387', '2024-12-03', '1230.00', NULL, 'sịn sịnnn', NULL, 1, 1, 1, 'Nguyễn Huy', 'huy@gmail.com', '0123456789', 'Nhà Hoàng', 12, NULL, 1),
(148, 'DH8227', '2024-12-03', '4530.00', NULL, 'đc của ló', NULL, 5, 1, 1, 'Nguyễn Huy', 'huy@gmail.com', '0123456789', 'Nhà Hoàng', 12, NULL, 1),
(150, 'DH1702', '2024-12-03', '1530.00', NULL, '', NULL, 2, 1, 1, 'Nguyễn Huy', 'huy@gmail.com', '0123456789', 'Nhà Hoàng', 12, NULL, 1),
(151, 'DH9196', '2024-12-03', '360.00', NULL, '', NULL, 1, 1, 1, 'Nguyễn Huy', 'huy@gmail.com', '0123456789', 'Nhà Hoàng', 12, NULL, 1),
(152, 'DH2575', '2024-12-03', '55030.00', NULL, '', NULL, 1, 1, 1, 'Nguyễn Huy', 'huy@gmail.com', '0123456789', 'Nhà Hoàng', 12, NULL, 1),
(154, 'DH3087', '2024-12-03', '600030.00', NULL, '', NULL, 4, 1, 1, 'Nguyễn Huy', 'huy@gmail.com', '0123456789', 'Nhà Hoàng', 12, NULL, 1),
(155, 'DH9486', '2024-12-03', '112530.00', NULL, '', NULL, 7, 1, 1, 'Nguyễn Huy', 'huy@gmail.com', '0123456789', 'Nhà Hoàng', 12, NULL, 1),
(157, 'DH2928', '2024-12-04', '3880.00', NULL, '', NULL, 5, 1, 1, 'Lã Thị Oanh', 'oanhne123@gmail.com', '0123789456', 'Tam Điệp', 14, NULL, 1),
(158, 'DH5707', '2024-12-05', '680000.00', NULL, '', NULL, 1, 1, 1, 'Lã Thị Oanh', 'oanhne123@gmail.com', '0123789456', 'Tam Điệp', 14, NULL, 1),
(159, 'DH6356', '2024-12-05', '160000.00', NULL, '', NULL, 5, 1, 1, 'Ngoan', 'ngoannehihi@gmail.com', '098776554', 'Ninh Bình', 15, NULL, 1),
(160, 'DH4489', '2024-12-05', '280000.00', NULL, 'Giao hàng nhanh cho tôi', NULL, 4, 1, 1, 'Quân', 'quan@gmail.com', '0187847394', 'Ninh Bình', 16, NULL, 1),
(161, 'DH2896', '2024-12-05', '4830000.00', NULL, 'ưeaesd', NULL, 5, 1, 1, 'Lã Thị Oanh', 'oanhne123@gmail.com', '0123789456', 'Tam Điệp', 14, NULL, 1),
(162, 'DH6917', '2024-12-05', '860000.00', NULL, '', NULL, 5, 1, 1, 'Lã Thị Oanh222222222222', 'oanhne123@gmail.com', '0123789456', 'Tam Điệp', 14, NULL, 1),
(163, 'DH2473', '2024-12-05', '510000.00', NULL, '', NULL, 2, 1, 1, 'Lã Thị Oanh', 'oanhne123@gmail.com', '0123789456', 'Tam Điệp', 14, NULL, 1),
(164, 'DH4290', '2024-12-06', '280000.00', NULL, '', NULL, 5, 1, 1, 'Lã Thị Oanh', 'oanhne123@gmail.com', '0123789456', 'Tam Điệp', 14, NULL, 1),
(165, 'DH9995', '2024-12-07', '160000.00', NULL, '', NULL, 7, 1, 1, 'Lã Thị Oanh', 'oanhne123@gmail.com', '0123789456', 'Tam Điệp', 14, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gio_hangs`
--

CREATE TABLE `gio_hangs` (
  `id` int NOT NULL,
  `tai_khoan_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gio_hangs`
--

INSERT INTO `gio_hangs` (`id`, `tai_khoan_id`) VALUES
(45, 12),
(55, 14);

-- --------------------------------------------------------

--
-- Table structure for table `hinh_anh_san_phams`
--

CREATE TABLE `hinh_anh_san_phams` (
  `id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `link_hinh_anh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hinh_anh_san_phams`
--

INSERT INTO `hinh_anh_san_phams` (`id`, `san_pham_id`, `link_hinh_anh`) VALUES
(9, 5, './uploads/1733239519Screenshot 2024-12-03 222403.png'),
(10, 5, './uploads/1733239519Screenshot 2024-12-03 222425.png'),
(11, 6, './uploads/1733239729Screenshot 2024-12-03 222710.png'),
(12, 6, './uploads/1733239729Screenshot 2024-12-03 222749.png'),
(13, 7, './uploads/1731225610Screenshot 2024-11-10 145954.png'),
(14, 8, './uploads/1731225686Screenshot 2024-11-10 150034.png'),
(15, 8, './uploads/1731225686Screenshot 2024-11-10 150045.png'),
(16, 9, './uploads/1733240391Screenshot 2024-12-03 223910.png'),
(17, 9, './uploads/1733240391Screenshot 2024-12-03 223740.png'),
(18, 10, './uploads/1733240559Screenshot 2024-12-03 224142.png'),
(19, 10, './uploads/1733240559Screenshot 2024-12-03 224155.png'),
(24, 12, './uploads/1733240791Screenshot 2024-12-03 224456.png'),
(25, 12, './uploads/1733240791Screenshot 2024-12-03 224511.png'),
(26, 13, './uploads/1733240972Screenshot 2024-12-03 224905.png'),
(27, 13, './uploads/1733240972Screenshot 2024-12-03 224821.png'),
(34, 16, './uploads/1733241325Screenshot 2024-12-03 225429.png'),
(35, 1, './uploads/1733238799Screenshot 2024-12-03 221149.png'),
(36, 1, './uploads/1733238799Screenshot 2024-12-03 221210.png'),
(37, 1, './uploads/1733238799Screenshot 2024-12-03 221243.png'),
(38, 1, './uploads/1733238806Screenshot 2024-12-03 221129.png'),
(39, 2, './uploads/1733239028Screenshot 2024-12-03 221510.png'),
(40, 2, './uploads/1733239028Screenshot 2024-12-03 221533.png'),
(41, 2, './uploads/1733239028Screenshot 2024-12-03 221550.png'),
(42, 2, './uploads/1733239028Screenshot 2024-12-03 221604.png'),
(43, 4, './uploads/1733239329Screenshot 2024-12-03 222006.png'),
(44, 4, './uploads/1733239329Screenshot 2024-12-03 222024.png'),
(45, 4, './uploads/1733239329Screenshot 2024-12-03 222049.png'),
(46, 4, './uploads/1733239329Screenshot 2024-12-03 222115.png'),
(47, 5, './uploads/1733239519Screenshot 2024-12-03 222435.png'),
(48, 5, './uploads/1733239519Screenshot 2024-12-03 222445.png'),
(49, 6, './uploads/1733239729Screenshot 2024-12-03 222806.png'),
(50, 6, './uploads/1733239729Screenshot 2024-12-03 222822.png'),
(51, 9, './uploads/1733240391Screenshot 2024-12-03 223750.png'),
(52, 9, './uploads/1733240391Screenshot 2024-12-03 223759.png'),
(53, 10, './uploads/1733240559Screenshot 2024-12-03 224204.png'),
(54, 10, './uploads/1733240559Screenshot 2024-12-03 224215.png'),
(55, 12, './uploads/1733240791Screenshot 2024-12-03 224520.png'),
(56, 12, './uploads/1733240791Screenshot 2024-12-03 224532.png'),
(57, 13, './uploads/1733240972Screenshot 2024-12-03 224831.png'),
(58, 13, './uploads/1733240972Screenshot 2024-12-03 224841.png'),
(59, 14, './uploads/1733241117Screenshot 2024-11-29 022215.png'),
(60, 14, './uploads/1733241117Screenshot 2024-11-29 022226.png'),
(61, 14, './uploads/1733241117Screenshot 2024-11-29 022236.png'),
(62, 14, './uploads/1733241117Screenshot 2024-11-29 022247.png'),
(63, 15, './uploads/1733241216Screenshot 2024-11-29 022327.png'),
(64, 15, './uploads/1733241216Screenshot 2024-11-29 022337.png'),
(65, 15, './uploads/1733241216Screenshot 2024-11-29 022350.png'),
(66, 15, './uploads/1733241216Screenshot 2024-11-29 022401.png'),
(67, 16, './uploads/1733241325Screenshot 2024-12-03 225437.png'),
(68, 16, './uploads/1733241325Screenshot 2024-12-03 225448.png'),
(69, 16, './uploads/1733241325Screenshot 2024-12-03 225500.png');

-- --------------------------------------------------------

--
-- Table structure for table `khuyen_mais`
--

CREATE TABLE `khuyen_mais` (
  `id` int NOT NULL,
  `ten_khuyen_mai` varchar(255) NOT NULL,
  `ma_khuyen_mai` varchar(50) NOT NULL,
  `gia_tri` decimal(10,2) NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `mo_ta` text,
  `trang_thai` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `khuyen_mais`
--

INSERT INTO `khuyen_mais` (`id`, `ten_khuyen_mai`, `ma_khuyen_mai`, `gia_tri`, `ngay_bat_dau`, `ngay_ket_thuc`, `mo_ta`, `trang_thai`) VALUES
(1, 'Voucher 100k', 'VC100', '10000.00', '2024-11-01', '2024-11-15', 'fedfwq', NULL),
(2, 'MixiVoucher', 'MCH', '50.00', '2024-11-13', '2024-11-19', 'Đơn hàng từ 150k trở lên', NULL),
(3, 'Chương Trình Giáng Sinh', 'GS227', '50.00', '2024-11-21', '2024-12-05', 'Ngon, bổ, rẻ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lien_hes`
--

CREATE TABLE `lien_hes` (
  `id` int NOT NULL,
  `ten_lien_he` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `thong_tin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  `trang_thai_id` int NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lien_hes`
--

INSERT INTO `lien_hes` (`id`, `ten_lien_he`, `email`, `thong_tin`, `trang_thai`, `trang_thai_id`) VALUES
(2, 'Phạm Thị Liên', 'lienptph1806@gmail.com', 'Cho tôi đổi trả sản phẩm', 2, 1),
(12, 'Nguyễn Huy Hoàng', 'hoangnhph50063@gmail.com', 'gháudu ahsodhas dahosd haohd \r\n', 0, 2),
(15, 'Nguyễn Huy Hoàng', 'hoangnhph50063@gmail.com', 'sdrrefwse ', 0, 1),
(16, 'Ngoan', 'ngoan@gmail.com', 'ngoan ngoan', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `phuong_thuc_thanh_toan`
--

CREATE TABLE `phuong_thuc_thanh_toan` (
  `id` int NOT NULL,
  `ten_phuong_thuc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phuong_thuc_thanh_toan`
--

INSERT INTO `phuong_thuc_thanh_toan` (`id`, `ten_phuong_thuc`) VALUES
(1, 'Thanh toán khi nhận hàng'),
(2, 'Chuyển khoản'),
(3, 'Thẻ tín dụng');

-- --------------------------------------------------------

--
-- Table structure for table `san_phams`
--

CREATE TABLE `san_phams` (
  `id` int NOT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `gia_san_pham` decimal(10,2) NOT NULL,
  `gia_khuyen_mai` decimal(10,2) DEFAULT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `so_luong` int NOT NULL,
  `luot_xem` int DEFAULT '0',
  `ngay_nhap` date NOT NULL,
  `mo_ta` text,
  `danh_muc_id` int NOT NULL,
  `trang_thai` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `san_phams`
--

INSERT INTO `san_phams` (`id`, `ten_san_pham`, `gia_san_pham`, `gia_khuyen_mai`, `hinh_anh`, `so_luong`, `luot_xem`, `ngay_nhap`, `mo_ta`, `danh_muc_id`, `trang_thai`) VALUES
(1, 'Áo Ba Lỗ Mixi-ABL', '130000.00', '100000.00', './uploads/1733238827Screenshot 2024-12-03 221129.png', 35, 0, '2024-12-02', 'Áo mùa hè được làm từ chất liệu thoáng mát như cotton, linen, hoặc vải lụa, giúp thấm hút mồ hôi tốt và giữ cho cơ thể luôn mát mẻ trong thời tiết nóng bức. Kiểu dáng gọn nhẹ, với các gam màu sáng hoặc họa tiết nhiệt đới, mang lại sự trẻ trung và năng động. Dễ dàng phối hợp với quần short, chân váy hoặc quần jeans để tạo nên phong cách thoải mái nhưng vẫn thời thượng trong mùa hè.', 1, 1),
(2, 'Áo Phông Mixi - AP', '250000.00', '200000.00', './uploads/1733239037Screenshot 2024-12-03 221510.png', 50, 0, '2024-11-06', 'Áo mùa hè được làm từ chất liệu thoáng mát như cotton, linen, hoặc vải lụa, giúp thấm hút mồ hôi tốt và giữ cho cơ thể luôn mát mẻ trong thời tiết nóng bức. Kiểu dáng gọn nhẹ, với các gam màu sáng hoặc họa tiết nhiệt đới, mang lại sự trẻ trung và năng động. Dễ dàng phối hợp với quần short, chân váy hoặc quần jeans để tạo nên phong cách thoải mái nhưng vẫn thời thượng trong mùa hè.', 1, 1),
(4, 'Bộ Quần Áo Mixi Nỉ Da Cá', '480000.00', '430000.00', './uploads/1733239358Screenshot 2024-12-03 222006.png', 10, 0, '2024-11-16', 'Áo mùa hè được làm từ chất liệu thoáng mát như cotton, linen, hoặc vải lụa, giúp thấm hút mồ hôi tốt và giữ cho cơ thể luôn mát mẻ trong thời tiết nóng bức. Kiểu dáng gọn nhẹ, với các gam màu sáng hoặc họa tiết nhiệt đới, mang lại sự trẻ trung và năng động. Dễ dàng phối hợp với quần short, chân váy hoặc quần jeans để tạo nên phong cách thoải mái nhưng vẫn thời thượng trong mùa hè.', 1, 1),
(5, 'Áo Khoác Mixi Đen', '230000.00', '200000.00', './uploads/1733239557Screenshot 2024-12-03 222403.png', 25, 0, '2024-11-25', 'Áo mùa đông được thiết kế với chất liệu dày dặn như lông cừu, nỉ, hoặc bông tổng hợp, giúp giữ ấm cơ thể trong thời tiết lạnh giá. Với lớp lót chống gió và khả năng giữ nhiệt tốt, áo mang lại cảm giác thoải mái và ấm áp. Thiết kế thời trang, phù hợp với nhiều phong cách, từ năng động đến sang trọng, kết hợp với mũ trùm đầu hoặc túi áo tiện dụng. Đây là sự lựa chọn hoàn hảo cho mùa đông lạnh giá.', 2, 1),
(6, 'Áo Nỉ Dài Tay Mixi', '150000.00', '130000.00', './uploads/1733239742Screenshot 2024-12-03 222710.png', 10, 0, '2024-11-19', 'Áo mùa đông được thiết kế với chất liệu dày dặn như lông cừu, nỉ, hoặc bông tổng hợp, giúp giữ ấm cơ thể trong thời tiết lạnh giá. Với lớp lót chống gió và khả năng giữ nhiệt tốt, áo mang lại cảm giác thoải mái và ấm áp. Thiết kế thời trang, phù hợp với nhiều phong cách, từ năng động đến sang trọng, kết hợp với mũ trùm đầu hoặc túi áo tiện dụng. Đây là sự lựa chọn hoàn hảo cho mùa đông lạnh giá.', 2, 1),
(9, 'Áo Hoodie Mixi Classic', '350000.00', '260000.00', './uploads/1733240411Screenshot 2024-12-03 223740.png', 2, 0, '2024-11-28', 'Áo mùa đông được thiết kế với chất liệu dày dặn như lông cừu, nỉ, hoặc bông tổng hợp, giúp giữ ấm cơ thể trong thời tiết lạnh giá. Với lớp lót chống gió và khả năng giữ nhiệt tốt, áo mang lại cảm giác thoải mái và ấm áp. Thiết kế thời trang, phù hợp với nhiều phong cách, từ năng động đến sang trọng, kết hợp với mũ trùm đầu hoặc túi áo tiện dụng. Đây là sự lựa chọn hoàn hảo cho mùa đông lạnh giá.', 2, 1),
(10, 'Bình Giữ Nhiệt Fan Cứng Mixi', '170000.00', '140000.00', './uploads/1733240588Screenshot 2024-12-03 224142.png', 15, 0, '2024-11-20', 'Bình giữ nhiệt cao cấp với khả năng giữ nóng và giữ lạnh vượt trội trong thời gian dài, lý tưởng cho việc mang theo cà phê, trà, hoặc nước giải khát. Chất liệu thép không gỉ chống gỉ sét, an toàn cho sức khỏe và dễ dàng vệ sinh. Thiết kế hiện đại với nắp đậy kín khít chống rò rỉ, kiểu dáng nhỏ gọn, tiện lợi mang theo trong mọi hoạt động như học tập, làm việc, hoặc dã ngoại.', 3, 1),
(12, 'Bình Giữ Nhiệt Mixi', '150000.00', '140000.00', './uploads/1733240811Screenshot 2024-12-03 224456.png', 25, 0, '2024-11-19', 'Bình giữ nhiệt cao cấp với khả năng giữ nóng và giữ lạnh vượt trội trong thời gian dài, lý tưởng cho việc mang theo cà phê, trà, hoặc nước giải khát. Chất liệu thép không gỉ chống gỉ sét, an toàn cho sức khỏe và dễ dàng vệ sinh. Thiết kế hiện đại với nắp đậy kín khít chống rò rỉ, kiểu dáng nhỏ gọn, tiện lợi mang theo trong mọi hoạt động như học tập, làm việc, hoặc dã ngoại.', 3, 1),
(13, 'Cốc Mixi 1200ml', '250000.00', '230000.00', './uploads/1733241001Screenshot 2024-12-03 224905.png', 3, 0, '2024-11-21', 'Bình giữ nhiệt cao cấp với khả năng giữ nóng và giữ lạnh vượt trội trong thời gian dài, lý tưởng cho việc mang theo cà phê, trà, hoặc nước giải khát. Chất liệu thép không gỉ chống gỉ sét, an toàn cho sức khỏe và dễ dàng vệ sinh. Thiết kế hiện đại với nắp đậy kín khít chống rò rỉ, kiểu dáng nhỏ gọn, tiện lợi mang theo trong mọi hoạt động như học tập, làm việc, hoặc dã ngoại.', 3, 1),
(14, 'Lego Mixi - SS01', '350000.00', '340000.00', './uploads/1733241148Screenshot 2024-11-29 022215.png', 2, 0, '2024-11-25', 'Bộ Lego sáng tạo với hàng trăm mảnh ghép đa dạng về màu sắc và kích thước, giúp trẻ em phát triển khả năng tư duy logic, sáng tạo và khéo léo. Các mảnh ghép dễ lắp ráp, làm từ nhựa an toàn đạt tiêu chuẩn quốc tế. Với nhiều chủ đề hấp dẫn như thành phố, siêu anh hùng, hoặc robot, Lego không chỉ là món đồ chơi mà còn là công cụ học tập bổ ích, phù hợp cho mọi lứa tuổi.', 5, 1),
(15, 'Lego Mixi - SS02', '290000.00', '250000.00', './uploads/1733241239Screenshot 2024-11-29 022327.png', 2, 0, '2024-11-27', 'Bộ Lego sáng tạo với hàng trăm mảnh ghép đa dạng về màu sắc và kích thước, giúp trẻ em phát triển khả năng tư duy logic, sáng tạo và khéo léo. Các mảnh ghép dễ lắp ráp, làm từ nhựa an toàn đạt tiêu chuẩn quốc tế. Với nhiều chủ đề hấp dẫn như thành phố, siêu anh hùng, hoặc robot, Lego không chỉ là món đồ chơi mà còn là công cụ học tập bổ ích, phù hợp cho mọi lứa tuổi.', 5, 1),
(16, 'Lego Mixi - SS03', '40000.00', '380000.00', './uploads/1733241359Screenshot 2024-12-03 225429.png', 5, 0, '2024-11-27', 'Bộ Lego sáng tạo với hàng trăm mảnh ghép đa dạng về màu sắc và kích thước, giúp trẻ em phát triển khả năng tư duy logic, sáng tạo và khéo léo. Các mảnh ghép dễ lắp ráp, làm từ nhựa an toàn đạt tiêu chuẩn quốc tế. Với nhiều chủ đề hấp dẫn như thành phố, siêu anh hùng, hoặc robot, Lego không chỉ là món đồ chơi mà còn là công cụ học tập bổ ích, phù hợp cho mọi lứa tuổi.', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoans`
--

CREATE TABLE `tai_khoans` (
  `id` int NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `anh_dai_dien` varchar(255) DEFAULT NULL,
  `ngay_sinh` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gioi_tinh` tinyint(1) NOT NULL DEFAULT '1',
  `dia_chi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `chuc_vu_id` int NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tai_khoans`
--

INSERT INTO `tai_khoans` (`id`, `ho_ten`, `anh_dai_dien`, `ngay_sinh`, `email`, `so_dien_thoai`, `gioi_tinh`, `dia_chi`, `mat_khau`, `chuc_vu_id`, `trang_thai`) VALUES
(1, 'Nguyễn Văn Phương', NULL, '2005-07-22', 'phuongnvph52264@gmail.com', '0789182477', 1, 'Tam Điệp, Ninh Bình', '$2y$10$YOSRyKU8ahElue1WQ4WN0O/u8Qwis00U4lyRrzZRE49bA5NhhBUyK', 1, 1),
(2, 'Nguyễn Thị Hồng Ngoan', NULL, '2005-11-10', 'ngoannthph50034@gmail.com', '0787198330', 2, 'Thái Bình', '$2y$10$g.bF4Agr6bjmgim2omrn6ON8MFHey5Xh4nMl0M8mdW3fcxoXGgKZO', 1, 1),
(3, 'Nguyễn Văn Vũ', NULL, '2003-11-27', 'vunvph2711@gmail.com', '0878217983', 1, 'Ninh Bình', '$2y$10$BR6VPnKZthviCtO0Ca9IC.MdV2tgPOY1wvHtlycH9Xbu8/Nnq2niS', 2, 2),
(5, 'Nguyễn Huy Hoàngg', NULL, '2024-11-22', 'hoangnhph50063@gmail.com', '0123456789', 1, 'Nhà Hoàng', '$2y$10$HZn5jjwI0HBxhiV8i10ahe24kMA5Gmo0MxiZdz503pzmOh.WsuJoa', 2, 2),
(6, 'dinhtv7@fpt.edu.vn', NULL, '2024-11-23', 'dinhtv7@fpt.edu.vn', '0123456789', 1, 'dinhtv7@fpt.edu.vn', '$2y$10$w03JSkXpy14yxkLKT2z7Q.d9WhYEzhygmYITQAF7EwyBqNSoutAjS', 2, 1),
(8, 'dinhtv7@fpt.edu.vn', NULL, '2023-06-26', 'hoang@gmail.com', '0123456789', 1, 'Nhà Hoàng', '$2y$10$n8W0DYgHl/N7kSS4mcXq7eddEhYCDPPXd6IyLrWwfhPq/Wu2NA/ha', 2, 1),
(9, 'test', NULL, '2023-02-15', 'test@gmail.com', '0123456789', 1, 'Nhà Hoàng', '$2y$10$X0hdbVVJsPzblnqyw8ni2.q0s1OyFISsKe1OxZL6Of.7Foj.HM9gS', 2, 1),
(12, 'Nguyễn Huy', NULL, '2023-11-11', 'huy@gmail.com', '0123456789', 0, 'Nhà Hoàng', '$2y$10$Y8prAEWVuUr6LfyRGUVF5uBYsSLmjxKJprxUalATGLLrEs6kV6iU2', 2, 1),
(13, 'Nguyễn ', NULL, '2023-11-11', 'ng@gmail.com', '0123456789', 1, 'Nhà Hoàng', '$2y$10$4ti6AL59AzIXiC6awdRnbOARulK9w9O9ri9JXLUCdZmA5svPznWIK', 2, 1),
(14, 'Lã Thị Oanh', NULL, '2022-02-04', 'oanhne123@gmail.com', '0123789456', 0, 'Tam Điệp', '$2y$10$YkJ4dO6C4RfYwR5cSb2LwemsI8V1puvkjdh9x0jym5cADwR7xRpDy', 2, 1),
(15, 'Ngoan', NULL, '2005-11-10', 'ngoannehihi@gmail.com', '098776554', 0, 'Ninh Bình', '$2y$10$5vOh/FEWVncBqkxXVP8LVencOgpvMVhDhxD87QVMHlzAbb1qMLeUO', 2, 1),
(16, 'Quân', NULL, '2005-07-22', 'quan@gmail.com', '0187847394', 1, 'Ninh Bình', '$2y$10$gr0fMXx.XuzUJnnC5QZmrukRdUk88V/0QXDQBPVnVPFO1kpYVy10O', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tin_tucs`
--

CREATE TABLE `tin_tucs` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `thong_tin` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `hinh_anh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tin_tucs`
--

INSERT INTO `tin_tucs` (`id`, `name`, `thong_tin`, `hinh_anh`) VALUES
(2, 'MixiShop: Nơi Gắn Kết Cộng Đồng Bộ Tộc Mixi', 'MixiShop - thương hiệu gắn liền với tên tuổi của streamer nổi tiếng Độ Mixi, không chỉ là một cửa hàng mà còn là biểu tượng của sự đoàn kết trong cộng đồng fan \"Bộ Tộc Mixi\". Với những sản phẩm độc đáo mang dấu ấn riêng, MixiShop đã trở thành điểm đến quen thuộc của hàng triệu người hâm mộ trên khắp cả nước.\r\nMixiShop không chỉ là một cửa hàng mua sắm trực tuyến, mà còn là cầu nối giữa những người có chung sở thích và đam mê. Chúng tôi hướng tới việc xây dựng một cộng đồng vững mạnh, nơi mỗi thành viên có thể chia sẻ và kết nối với nhau qua những sản phẩm mang giá trị đích thực.', './uploads/17326162241731224549Screenshot 2024-11-10 144130.png'),
(4, 'Hành Trình Xây Dựng Thương Hiệu', 'Được thành lập vào năm 2019, MixiShop ban đầu chỉ là một cửa hàng nhỏ phục vụ những người yêu mến Độ Mixi. Tuy nhiên, nhờ sự sáng tạo và tình yêu của cộng đồng fan, MixiShop đã phát triển mạnh mẽ, trở thành một trong những cửa hàng merchandise nổi bật nhất Việt Nam.\r\n\r\nCửa hàng tập trung vào các sản phẩm thể hiện phong cách cá nhân của Độ Mixi, từ quần áo, phụ kiện đến các món đồ gia dụng. Tất cả đều được thiết kế tỉ mỉ để mang đến trải nghiệm gần gũi và đặc biệt cho người hâm mộ.', './uploads/17326162401731225356Screenshot 2024-11-10 145508.png'),
(6, 'Sản Phẩm Độc Quyền', 'Các sản phẩm tại MixiShop luôn mang dấu ấn của \"Bộ Tộc Mixi\":\r\n\r\nÁo Thun & Hoodie: Thiết kế trẻ trung, năng động, in logo hoặc câu nói viral của Độ Mixi.\r\nPhụ Kiện Độc Lạ: Từ balo, mũ, dây đeo cổ đến các sản phẩm phiên bản giới hạn, được săn đón ngay khi ra mắt.\r\nĐồ Gia Dụng: Cốc uống nước, lót chuột, bình giữ nhiệt – tất cả đều là \"must-have\" cho các thành viên Bộ Tộc.\r\nĐặc biệt, nhiều sản phẩm chỉ sản xuất trong một thời gian ngắn, tạo nên sức hút lớn và luôn trong tình trạng \"cháy hàng\".', './uploads/17326162511731225239Screenshot 2024-11-10 145302.png'),
(11, 'Sự Kiện & Hoạt Động Cộng Đồng', 'MixiShop không ngừng tổ chức các sự kiện kết nối cộng đồng:\r\n\r\nNgày Hội Bộ Tộc: Fan có thể gặp gỡ, giao lưu và tham gia các hoạt động thú vị.\r\nƯu Đãi Đặc Biệt: Dịp lễ hoặc sự kiện livestream, MixiShop luôn có những phần quà độc đáo dành riêng cho fan.\r\nPhiên Bản Giới Hạn: Một số sản phẩm chỉ được ra mắt trong các sự kiện quan trọng, mang giá trị sưu tầm cao.', './uploads/17326162581731224361images (1).jpg'),
(12, 'MixiShop: Cầu Nối Cộng Đồng', 'Không chỉ là nơi mua sắm, MixiShop còn là biểu tượng của sự gắn bó trong cộng đồng fan Bộ Tộc Mixi. Những sản phẩm từ cửa hàng không chỉ thể hiện tình yêu với Độ Mixi mà còn là cách để các fan thể hiện tinh thần đoàn kết và tự hào khi là một phần của cộng đồng này.\r\n\r\nMixiShop sẽ tiếp tục phát triển, mang đến nhiều sản phẩm và trải nghiệm ý nghĩa hơn, đồng hành cùng sự lớn mạnh của Bộ Tộc Mixi. Nếu bạn là fan của Độ Mixi, đừng bỏ lỡ cơ hội sở hữu những món đồ đặc biệt từ MixiShop để đánh dấu hành trình ý nghĩa này!', './uploads/17326162661731224361images (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_don_hang`
--

CREATE TABLE `trang_thai_don_hang` (
  `id` int NOT NULL,
  `ten_trang_thai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trang_thai_don_hang`
--

INSERT INTO `trang_thai_don_hang` (`id`, `ten_trang_thai`) VALUES
(1, 'Chờ xác nhận'),
(2, 'Đã xác nhận'),
(3, 'Đang giao'),
(4, 'Đã giao'),
(5, 'Giao hàng thành công'),
(6, 'Giao hàng thất bại'),
(7, 'Đã huỷ');

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_lien_he`
--

CREATE TABLE `trang_thai_lien_he` (
  `id` int NOT NULL,
  `ten_trang_thai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trang_thai_lien_he`
--

INSERT INTO `trang_thai_lien_he` (`id`, `ten_trang_thai`) VALUES
(1, 'Đã liên hệ'),
(2, 'Chưa liên hệ');

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_thanh_toan`
--

CREATE TABLE `trang_thai_thanh_toan` (
  `id` int NOT NULL,
  `ten_trang_thai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trang_thai_thanh_toan`
--

INSERT INTO `trang_thai_thanh_toan` (`id`, `ten_trang_thai`) VALUES
(1, 'Đã thanh toán'),
(2, 'Chưa thanh toán');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bai_viets`
--
ALTER TABLE `bai_viets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sanpham_binhluan` (`san_pham_id`);

--
-- Indexes for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `don_hang_id` (`don_hang_id`),
  ADD KEY `san_pham_id` (`san_pham_id`),
  ADD KEY `tai_khoan_id` (`tai_khoan_id`);

--
-- Indexes for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chuc_vus`
--
ALTER TABLE `chuc_vus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danh_gias`
--
ALTER TABLE `danh_gias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trang_thai_id` (`trang_thai_id`),
  ADD KEY `phuong_thuc_thanh_toan_id` (`phuong_thuc_thanh_toan_id`),
  ADD KEY `trang_thai_thanh_toan_id` (`trang_thai_thanh_toan_id`),
  ADD KEY `fk_san_pham_id` (`san_pham_id`);

--
-- Indexes for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khuyen_mais`
--
ALTER TABLE `khuyen_mais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_khuyen_mai` (`ma_khuyen_mai`);

--
-- Indexes for table `lien_hes`
--
ALTER TABLE `lien_hes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trang_thai_id` (`trang_thai_id`);

--
-- Indexes for table `phuong_thuc_thanh_toan`
--
ALTER TABLE `phuong_thuc_thanh_toan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tin_tucs`
--
ALTER TABLE `tin_tucs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trang_thai_don_hang`
--
ALTER TABLE `trang_thai_don_hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trang_thai_lien_he`
--
ALTER TABLE `trang_thai_lien_he`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trang_thai_thanh_toan`
--
ALTER TABLE `trang_thai_thanh_toan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bai_viets`
--
ALTER TABLE `bai_viets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `binh_luans`
--
ALTER TABLE `binh_luans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `chuc_vus`
--
ALTER TABLE `chuc_vus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `khuyen_mais`
--
ALTER TABLE `khuyen_mais`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lien_hes`
--
ALTER TABLE `lien_hes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `phuong_thuc_thanh_toan`
--
ALTER TABLE `phuong_thuc_thanh_toan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tin_tucs`
--
ALTER TABLE `tin_tucs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trang_thai_don_hang`
--
ALTER TABLE `trang_thai_don_hang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trang_thai_lien_he`
--
ALTER TABLE `trang_thai_lien_he`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trang_thai_thanh_toan`
--
ALTER TABLE `trang_thai_thanh_toan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD CONSTRAINT `chi_tiet_don_hangs_ibfk_1` FOREIGN KEY (`don_hang_id`) REFERENCES `don_hangs` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hangs_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hangs_ibfk_3` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoans` (`id`);

--
-- Constraints for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD CONSTRAINT `fk_san_pham_id` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `lien_hes`
--
ALTER TABLE `lien_hes`
  ADD CONSTRAINT `lien_hes_ibfk_1` FOREIGN KEY (`trang_thai_id`) REFERENCES `trang_thai_lien_he` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
