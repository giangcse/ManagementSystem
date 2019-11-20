-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2019 at 02:07 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `B_ID` int(11) NOT NULL,
  `B_TIME` datetime NOT NULL,
  `B_TOTAL` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`B_ID`, `B_TIME`, `B_TOTAL`) VALUES
(1, '2019-11-19 11:11:37', 78000),
(2, '2019-11-19 11:11:03', 432000),
(3, '2019-11-19 11:11:42', 225000),
(4, '2019-11-20 07:11:23', 180000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_bill`
--

CREATE TABLE `detail_bill` (
  `P_ID` int(11) NOT NULL,
  `B_ID` int(11) NOT NULL,
  `S_ID` int(11) NOT NULL,
  `DB_QUANTITY` int(11) NOT NULL,
  `DB_TOTAL` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `detail_bill`
--

INSERT INTO `detail_bill` (`P_ID`, `B_ID`, `S_ID`, `DB_QUANTITY`, `DB_TOTAL`) VALUES
(1, 1, 42, 2, 78000),
(2, 2, 42, 4, 116000),
(3, 2, 42, 3, 87000),
(4, 2, 42, 1, 29000),
(5, 2, 42, 1, 45000),
(6, 2, 42, 1, 55000),
(7, 2, 42, 1, 45000),
(7, 3, 42, 2, 90000),
(8, 2, 42, 1, 55000),
(11, 4, 42, 4, 180000),
(13, 3, 42, 3, 135000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_import`
--

CREATE TABLE `detail_import` (
  `SU_ID` int(11) NOT NULL,
  `W_ID` int(11) NOT NULL,
  `S_ID` int(11) NOT NULL,
  `DI_QUANTITY` float NOT NULL,
  `DI_UNIT` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `DI_COST` float NOT NULL,
  `DI_DAY` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `detail_import`
--

INSERT INTO `detail_import` (`SU_ID`, `W_ID`, `S_ID`, `DI_QUANTITY`, `DI_UNIT`, `DI_COST`, `DI_DAY`) VALUES
(1, 1, 1, 1000, 'Ly', 750000, '2019-11-19 06:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `detail_shift`
--

CREATE TABLE `detail_shift` (
  `E_ID` int(11) NOT NULL,
  `S_ID` int(11) NOT NULL,
  `DS_SHIFTNAME` int(11) NOT NULL,
  `DS_DAYOFSHIFT` int(11) NOT NULL,
  `DS_SALARYOFSHIFT` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `detail_shift`
--

INSERT INTO `detail_shift` (`E_ID`, `S_ID`, `DS_SHIFTNAME`, `DS_DAYOFSHIFT`, `DS_SALARYOFSHIFT`) VALUES
(1, 1, 1, 2, 100000),
(1, 16, 2, 2, 100000),
(1, 17, 3, 2, 100000),
(1, 18, 4, 2, 100000),
(1, 19, 1, 3, 100000),
(1, 20, 2, 3, 100000),
(1, 21, 3, 3, 100000),
(1, 22, 4, 3, 100000),
(1, 23, 1, 4, 100000),
(1, 24, 2, 4, 100000),
(1, 25, 3, 4, 100000),
(1, 26, 4, 4, 100000),
(1, 27, 1, 5, 100000),
(1, 28, 2, 5, 100000),
(1, 29, 3, 5, 100000),
(1, 30, 4, 5, 100000),
(1, 31, 1, 6, 100000),
(1, 32, 2, 6, 100000),
(1, 33, 3, 6, 100000),
(1, 34, 4, 6, 100000),
(1, 35, 1, 7, 100000),
(1, 36, 2, 7, 100000),
(1, 37, 3, 7, 100000),
(1, 38, 4, 7, 100000),
(1, 39, 1, 8, 100000),
(1, 40, 2, 8, 100000),
(1, 41, 3, 8, 100000),
(1, 42, 4, 8, 100000),
(3, 43, 1, 2, 100000),
(3, 44, 2, 2, 100000),
(3, 45, 1, 3, 100000),
(3, 46, 2, 3, 100000),
(3, 47, 1, 4, 100000),
(3, 48, 2, 4, 100000),
(3, 49, 1, 5, 100000),
(3, 50, 2, 5, 100000),
(3, 51, 1, 6, 100000),
(3, 52, 2, 6, 100000),
(3, 53, 1, 7, 100000),
(3, 54, 2, 7, 100000),
(3, 55, 1, 8, 100000),
(3, 56, 2, 8, 100000),
(4, 2, 1, 2, 100000),
(4, 3, 2, 2, 100000),
(4, 4, 1, 3, 100000),
(4, 5, 2, 3, 100000),
(4, 6, 1, 4, 100000),
(4, 7, 2, 4, 100000),
(4, 8, 1, 5, 100000),
(4, 9, 2, 5, 100000),
(4, 10, 1, 6, 100000),
(4, 11, 2, 6, 100000),
(4, 12, 1, 7, 100000),
(4, 13, 2, 7, 100000),
(4, 14, 1, 8, 100000),
(4, 15, 2, 8, 100000),
(5, 71, 3, 2, 100000),
(5, 72, 4, 2, 100000),
(5, 73, 3, 3, 100000),
(5, 74, 4, 3, 100000),
(5, 75, 3, 4, 100000),
(5, 76, 4, 4, 100000),
(5, 77, 3, 5, 100000),
(5, 78, 4, 5, 100000),
(5, 79, 3, 6, 100000),
(5, 80, 4, 6, 100000),
(5, 81, 3, 7, 100000),
(5, 82, 4, 7, 100000),
(5, 83, 3, 8, 100000),
(5, 84, 4, 8, 100000),
(8, 57, 3, 2, 100000),
(8, 58, 4, 2, 100000),
(8, 59, 3, 3, 100000),
(8, 60, 4, 3, 100000),
(8, 61, 3, 4, 100000),
(8, 62, 4, 4, 100000),
(8, 63, 3, 5, 100000),
(8, 64, 4, 5, 100000),
(8, 65, 3, 6, 100000),
(8, 66, 4, 6, 100000),
(8, 67, 3, 7, 100000),
(8, 68, 4, 7, 100000),
(8, 69, 3, 8, 100000),
(8, 70, 4, 8, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `E_ID` int(11) NOT NULL,
  `E_FULLNAME` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `E_ACCOUNT` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `E_PASSWORD` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL,
  `E_ID_NUM` varchar(13) COLLATE utf8_vietnamese_ci NOT NULL,
  `E_ADDRESS` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `E_PHONE` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `E_JOB` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `E_START` int(11) NOT NULL,
  `E_USERGROUP` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`E_ID`, `E_FULLNAME`, `E_ACCOUNT`, `E_PASSWORD`, `E_ID_NUM`, `E_ADDRESS`, `E_PHONE`, `E_JOB`, `E_START`, `E_USERGROUP`) VALUES
(1, 'Phan Thanh Giáº£ng', 'giangphan', 'a940d8b1b4dbed2f777656fd0d965759d99c8ea9', '331800117', 'Tam BÃ¬nh, VÄ©nh Long', '0868442808', 'Quáº£n lÃ½', 2018, 'admin'),
(2, 'Tráº§n VÄ©nh TÆ°á»ng', 'tuongtran', 'e03a3b0df7ef2aa513131811010f32f66cfa8e06', '123456789', 'Ã” MÃ´n, Cáº§n ThÆ¡', '0907047617', 'Order', 2018, 'order'),
(3, 'Nguyá»…n PhÃºc Báº£o Khang', 'khangnguyen', 'c863bacbc71869fc68a88d11b1f8c6d3b2f42ca9', '012345678', 'Mang ThÃ­t, VÄ©nh Long', '0939964344', 'Phá»¥c vá»¥', 2018, ''),
(4, 'LÃ¢m VÄƒn Di', 'dilam', 'f502e82c25bba5a06cf68ffa87ecd02371c1a975', '123456780', 'ChÃ¢u ThÃ nh, KiÃªn Giang', '0859711330', 'Cháº¿ biáº¿n', 2018, ''),
(5, 'Nguyá»…n Minh Thuáº­t', 'thuatnguyen', '4aa49a57b3c11757e7e391f52347572bb837597f', '123456987', 'VÅ©ng LiÃªm, VÄ©nh Long', '0929090507', 'Phá»¥c vá»¥', 2018, ''),
(6, 'Tráº§n VÄƒn Khá»Ÿi', 'khoitran', 'cae1b52d0ab8b788a944a94be70dedffa876bd61', '123546987', 'Giá»“ng Riá»ng, KiÃªn Giang', '0392959702', 'Phá»¥c vá»¥', 2018, ''),
(7, 'Há»“ KhÃ¡nh Duy', 'duyho', '00fb8183479aed9947aebded28b36c57de7eb16b', '987654321', 'Tp. Há»“ ChÃ­ Minh', '0929262646', 'Phá»¥c vá»¥', 2018, ''),
(8, 'Nguyá»…n ÄÃ¬nh KhÃ¢m', 'khamnguyen', '5f79460e4f906c045759e7bb5580b62aceb2cc85', '321564789', 'Long Má»¹, Háº­u Giang', '0356879141', 'Cháº¿ biáº¿n', 2018, ''),
(9, 'LÃª Thanh LÆ°Æ¡ng', 'luongle', 'aa93e733a85dcd3e134fca45d926427e19a05afb', '123032154', 'Má»¹ TÃº, SÃ³c TrÄƒng', '0896542317', 'Order', 2018, 'order');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `P_ID` int(11) NOT NULL,
  `P_NAME` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `P_SPECIES` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `P_PRICE` int(11) NOT NULL,
  `P_THUMB_IMG` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`P_ID`, `P_NAME`, `P_SPECIES`, `P_PRICE`, `P_THUMB_IMG`) VALUES
(1, 'Americano', 'Cafe', 39000, 'https://product.hstatic.net/1000075078/product/americano_large.jpg'),
(2, 'Báº¡c sá»‰u', 'Cafe', 29000, 'https://product.hstatic.net/1000075078/product/white_vnese_coffee_9968c1184d7f4634a9bb9fce7b5ff313_large.jpg'),
(3, 'Cafe Ä‘en', 'Cafe', 29000, 'https://product.hstatic.net/1000075078/product/vnese_coffee_large.jpg'),
(4, 'Cafe Sá»¯a', 'Cafe', 29000, 'https://product.hstatic.net/1000075078/product/cfs_large.jpg'),
(5, 'Cappuccino', 'Cafe', 45000, 'https://product.hstatic.net/1000075078/product/cappuccino_large.jpg'),
(6, 'Caramel Macchiato', 'Cafe', 55000, 'https://product.hstatic.net/1000075078/product/caramel_macchiato_b6f694f469794e12b04a91845f5fce2d_large.jpg'),
(7, 'Cold brew cam sáº£', 'Cafe', 45000, 'https://product.hstatic.net/1000075078/product/colbrewcamsa_c2a45ec3fea94e248fd1b4f71abebe09_large.jpg'),
(8, 'Cold brew phÃºc bá»“n tá»­', 'Cafe', 55000, 'https://product.hstatic.net/1000075078/product/coldbrew_raspberry_ac577fc483484f0cb4e35efe6bf14426_large.png'),
(9, 'Cold brew sá»¯a tÆ°Æ¡i', 'Cafe', 50000, 'https://product.hstatic.net/1000075078/product/coldbrewmilk_09db086189ce43d5bb78172613af57dc_large.jpg'),
(10, 'Cold brew sá»¯a tÆ°Æ¡i macchiatio', 'Cafe', 50000, 'https://product.hstatic.net/1000075078/product/coldbrewmacchiato_af7dc44ed71b4856bfe48a756ed939e6_large.jpg'),
(11, 'Cold brew truyá»n thá»‘ng', 'Cafe', 45000, 'https://product.hstatic.net/1000075078/product/classic_47aa187278184a4ea36a59cf279350c0_large.jpg'),
(12, 'Espresso', 'Cafe', 35000, 'https://product.hstatic.net/1000075078/product/espresso_large.jpg'),
(13, 'Latte', 'Cafe', 45000, 'https://product.hstatic.net/1000075078/product/latte__1__large.jpg'),
(14, 'Mocha', 'Cafe', 49000, 'https://product.hstatic.net/1000075078/product/mocha_large.jpg'),
(15, 'Chocolate Ä‘Ã¡', 'Cafe', 55000, 'https://product.hstatic.net/1000075078/product/iced_chocolate_large.jpg'),
(16, 'TrÃ  cherry macchiato', 'TrÃ  & Macchiato', 55000, 'https://product.hstatic.net/1000075078/product/cherry_mac_6a3403fdb832464da88de8c6e6ddf662_large.jpg'),
(17, 'TrÃ  Ä‘Ã o cam sáº£', 'TrÃ  & Macchiato', 45000, 'https://product.hstatic.net/1000075078/product/tra_dao_cam_sa_on_bg_large.jpg'),
(18, 'TrÃ  Ä‘en macchiato', 'TrÃ  & Macchiato', 42000, 'https://product.hstatic.net/1000075078/product/blacktea_macchiat_large.jpg'),
(19, 'TrÃ  gáº¡o rang macchiato', 'TrÃ  & Macchiato', 48000, 'https://product.hstatic.net/1000075078/product/genmaicha_macchiatov_large.jpg'),
(20, 'TrÃ  matcha latte', 'TrÃ  & Macchiato', 59000, 'https://product.hstatic.net/1000075078/product/matcha_latte_large.jpg'),
(21, 'TrÃ  matcha macchiato', 'TrÃ  & Macchiato', 45000, 'https://product.hstatic.net/1000075078/product/matcha_macchiato_large.jpg'),
(22, 'TrÃ  oolong sen An nhiÃªn', 'TrÃ  & Macchiato', 45000, 'https://product.hstatic.net/1000075078/product/trasen_29e9b22739f941ff84671361ae53f3dd_large.jpg'),
(23, 'TrÃ  oolong váº£i NhÆ° Ã½', 'TrÃ  & Macchiato', 45000, 'https://product.hstatic.net/1000075078/product/travai_large.jpg'),
(24, 'TrÃ  phÃºc bá»“n tá»­', 'TrÃ  & Macchiato', 49000, 'https://product.hstatic.net/1000075078/product/tea_raspberry_fda1ba90f506483eb6568f433690173a_large.png'),
(25, 'TrÃ  xoÃ i macchiatio', 'TrÃ  & Macchiato', 55000, 'https://product.hstatic.net/1000075078/product/xoai_nong_mac_7f000cdac75e458e9ea5cdc3cb990419_large.jpg'),
(26, 'TrÃ  xoÃ i macchiatio', 'TrÃ  & Macchiato', 55000, 'https://product.hstatic.net/1000075078/product/xoai_mac_c4534cc7607f4d58addf470a162e8359_large.jpg'),
(27, 'Chanh sáº£ Ä‘Ã¡ xay', 'Thá»©c uá»‘ng Ä‘Ã¡ xay', 49000, 'https://product.hstatic.net/1000075078/product/chanhday_1x1_66281943c16b49d480a30860638fdc5e_large.jpg'),
(28, 'Chocolate Ä‘Ã¡ xay', 'Thá»©c uá»‘ng Ä‘Ã¡ xay', 59000, 'https://product.hstatic.net/1000075078/product/chocolate_ice_blended_large.jpg'),
(29, 'Cookies Ä‘Ã¡ xay', 'Thá»©c uá»‘ng Ä‘Ã¡ xay', 59000, 'https://product.hstatic.net/1000075078/product/cookies_ice_blended_large.jpg'),
(30, 'ÄÃ o viá»‡t quáº¥t Ä‘Ã¡ xay', 'Thá»©c uá»‘ng Ä‘Ã¡ xay', 59000, 'https://product.hstatic.net/1000075078/product/dao_a0adb67ef806443298524236a4cc7e3c_large.jpg'),
(31, 'Matcha Ä‘Ã¡ xay', 'Thá»©c uá»‘ng Ä‘Ã¡ xay', 59000, 'https://product.hstatic.net/1000075078/product/matcha_ice_blended_large.jpg'),
(32, 'á»”i há»“ng viá»‡t quáº¥t Ä‘Ã¡ xay', 'Thá»©c uá»‘ng Ä‘Ã¡ xay', 59000, 'https://product.hstatic.net/1000075078/product/oihong_eba1ad20923841f6830e40e2dfd3e42a_large.jpg'),
(33, 'PhÃºc bá»“n tá»­ cam Ä‘Ã¡ xay', 'Thá»©c uá»‘ng Ä‘Ã¡ xay', 59000, 'https://product.hstatic.net/1000075078/product/daxay_raspberry_01685c63649740678352a348f8b281a1_large.png'),
(34, 'Sinh tá»‘ cam xoÃ i', 'Thá»©c uá»‘ng trÃ¡i cÃ¢y', 59000, 'https://product.hstatic.net/1000075078/product/mango_smoothie_large.jpg'),
(35, 'Sinh tá»‘ viá»‡t quáº¥t', 'Thá»©c uá»‘ng trÃ¡i cÃ¢y', 59000, 'https://product.hstatic.net/1000075078/product/blueberry_smoothie_large.jpg'),
(36, 'BÃ¡nh bÃ´ng lan trá»©ng muá»‘i', 'BÃ¡nh & snack', 29000, 'https://product.hstatic.net/1000075078/product/trungmui1_9abf7c43946b44e9948dbac1eff95e40_large.jpg'),
(37, 'BÃ¡nh chocolate', 'BÃ¡nh & snack', 29000, 'https://product.hstatic.net/1000075078/product/choco_1x1_4faf8c80e6604cad88ce30528e2bd409_large.jpg'),
(38, 'BÃ¡nh Croissant bÆ¡ tá»i', 'BÃ¡nh & snack', 29000, 'https://product.hstatic.net/1000075078/product/sungtrau_1x1_0e9a3e2590794cb9a6ff7ad9d9562c25_large.jpg'),
(39, 'BÃ¡nh gáº¥u chocolate', 'BÃ¡nh & snack', 39000, 'https://product.hstatic.net/1000075078/product/gau_1x1_8b308db3a67a47688ff0d69a8c5615bf_large.jpg'),
(40, 'BÃ¡nh matcha', 'BÃ¡nh & snack', 29000, 'https://product.hstatic.net/1000075078/product/matcha_178bdeeb1f9b47ea9f782048eb145f49_large.jpg'),
(41, 'BÃ¡nh mÃ¬ chÃ  bÃ´ng phÃ´ mai', 'BÃ¡nh & snack', 32000, 'https://product.hstatic.net/1000075078/product/phomaichabong_1x1_e86c140c8a084458afcace64a93d2fd1_large.jpg'),
(42, 'BÃ¡nh passion cheese', 'BÃ¡nh & snack', 29000, 'https://product.hstatic.net/1000075078/product/chanhday_1x1_da85397059a149e1b886237434f7ce48_large.jpg'),
(43, 'BÃ¡nh tiramisu', 'BÃ¡nh & snack', 29000, 'https://product.hstatic.net/1000075078/product/tira_1x1_eb865751a24e4520be32a56129dd7a2d_large.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `S_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`S_ID`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54),
(55),
(56),
(57),
(58),
(59),
(60),
(61),
(62),
(63),
(64),
(65),
(66),
(67),
(68),
(69),
(70),
(71),
(72),
(73),
(74),
(75),
(76),
(77),
(78),
(79),
(80),
(81),
(82),
(83),
(84);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SU_ID` int(11) NOT NULL,
  `SU_NAME` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL,
  `SU_PHONE` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `SU_ADDRESS` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SU_ID`, `SU_NAME`, `SU_PHONE`, `SU_ADDRESS`) VALUES
(1, 'Phan Thanh Giáº£ng', '0868442808', 'PhÃº SÆ¡n B, Long PhÃº, Tam BÃ¬nh');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `W_ID` int(11) NOT NULL,
  `W_MATERIAL` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `W_UNIT` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `W_REMAIN` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`W_ID`, `W_MATERIAL`, `W_UNIT`, `W_REMAIN`) VALUES
(1, 'Ly nhá»±a', 'Ly', 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`B_ID`);

--
-- Indexes for table `detail_bill`
--
ALTER TABLE `detail_bill`
  ADD PRIMARY KEY (`P_ID`,`B_ID`,`S_ID`),
  ADD KEY `FK_BILL_BILL_DETAIL` (`B_ID`),
  ADD KEY `FK_SHIFT_DETAIL_BILL` (`S_ID`);

--
-- Indexes for table `detail_import`
--
ALTER TABLE `detail_import`
  ADD PRIMARY KEY (`SU_ID`,`W_ID`,`S_ID`),
  ADD KEY `FK_SHIFT_DETAIL_IMPORT` (`S_ID`),
  ADD KEY `FK_WAREHOUSE_DETAIL_IMPORT` (`W_ID`);

--
-- Indexes for table `detail_shift`
--
ALTER TABLE `detail_shift`
  ADD PRIMARY KEY (`E_ID`,`S_ID`),
  ADD KEY `FK_SHIFT_DETAIL_SHIFT` (`S_ID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`E_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`S_ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SU_ID`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`W_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_bill`
--
ALTER TABLE `detail_bill`
  ADD CONSTRAINT `FK_BILL_BILL_DETAIL` FOREIGN KEY (`B_ID`) REFERENCES `bill` (`B_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PRODUCT_DETAIL_BILL` FOREIGN KEY (`P_ID`) REFERENCES `product` (`P_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SHIFT_DETAIL_BILL` FOREIGN KEY (`S_ID`) REFERENCES `shift` (`S_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `detail_import`
--
ALTER TABLE `detail_import`
  ADD CONSTRAINT `FK_SHIFT_DETAIL_IMPORT` FOREIGN KEY (`S_ID`) REFERENCES `shift` (`S_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SUPPLIER_DETAIL_IMPORT` FOREIGN KEY (`SU_ID`) REFERENCES `supplier` (`SU_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_WAREHOUSE_DETAIL_IMPORT` FOREIGN KEY (`W_ID`) REFERENCES `warehouse` (`W_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `detail_shift`
--
ALTER TABLE `detail_shift`
  ADD CONSTRAINT `FK_EMPLOYEES_DETAIL_SHIFT` FOREIGN KEY (`E_ID`) REFERENCES `employees` (`E_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SHIFT_DETAIL_SHIFT` FOREIGN KEY (`S_ID`) REFERENCES `shift` (`S_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
