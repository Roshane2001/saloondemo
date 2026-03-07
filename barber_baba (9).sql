-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2026 at 08:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barber_baba`
--

-- --------------------------------------------------------

--
-- Table structure for table `branding`
--

CREATE TABLE `branding` (
  `phone_no` int(10) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `id` int(10) NOT NULL,
  `company_email` varchar(50) NOT NULL,
  `website_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `favicon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branding`
--

INSERT INTO `branding` (`phone_no`, `logo`, `brand_name`, `id`, `company_email`, `website_name`, `address`, `favicon`) VALUES
(2147483647, '41b8f3b3a0a5c62d3ce1dea79a46e2351772260100.jpg', 'Saloon Test', 1, 'saloontesting@gmail.com', 'www.saloontest.lk', 'pamunugma bjhf', '41b8f3b3a0a5c62d3ce1dea79a46e2351772261714.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `emailsetting`
--

CREATE TABLE `emailsetting` (
  `id` int(11) NOT NULL,
  `smtp_server` varchar(255) NOT NULL,
  `smtp_username` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `stmp_port` varchar(255) NOT NULL,
  `smtp_type` varchar(255) NOT NULL,
  `email` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emailsetting`
--

INSERT INTO `emailsetting` (`id`, `smtp_server`, `smtp_username`, `smtp_password`, `stmp_port`, `smtp_type`, `email`) VALUES
(1, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `membership_plans`
--

CREATE TABLE `membership_plans` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `duration_days` int(11) DEFAULT NULL,
  `services_included` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_plans`
--

INSERT INTO `membership_plans` (`id`, `plan_name`, `description`, `price`, `duration_days`, `services_included`, `created_at`) VALUES
(2, 'Groom Plan', 'Groom Plan', 499.00, 3, NULL, '2025-06-09 06:44:33'),
(3, 'Basic Beauty Plan', 'Perfect for quick touch-ups and essential grooming. Ideal for clients who need routine maintenance.', 399.00, 3, NULL, '2025-06-09 06:47:15'),
(4, 'Glam Refresh Plan', 'A mid-range beauty package for a polished, fresh look with a bit of pampering.', 345.00, 1, NULL, '2025-06-09 06:48:39'),
(5, 'Luxe Makeover Plan', 'A deluxe beauty treatment ideal for full transformation or self-care weekends.', 299.00, 2, NULL, '2025-06-09 06:49:13'),
(6, ' Bridal Elegance Plan', ' Full-service bridal plan covering both trial and wedding day preparations.\r\n\r\n', 3599.00, 3, NULL, '2025-06-09 06:50:05'),
(7, 'Monthly Membership Plan', 'Perfect for clients who love regular care and exclusive discounts.', 999.00, 30, NULL, '2025-06-09 06:51:20'),
(8, 'Hair cleaning', 'hair wash and clean by washing', 400.00, 1, NULL, '2026-02-17 17:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` char(50) DEFAULT NULL,
  `UserName` char(50) DEFAULT NULL,
  `MobileNumber` varchar(100) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'Supunsaloon', '+91 95292 30400', 'work@mayurik.com', 'ff64805f8499eabb0f864df8371e2670', '2025-06-18 06:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblappointment`
--

CREATE TABLE `tblappointment` (
  `ID` int(10) NOT NULL,
  `AptNumber` varchar(80) DEFAULT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `PhoneNumber` bigint(11) DEFAULT NULL,
  `AptDate` varchar(120) DEFAULT NULL,
  `AptTime` varchar(120) DEFAULT NULL,
  `Services` varchar(120) DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(250) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `total` varchar(50) NOT NULL,
  `grand_total` varchar(50) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `RemarkDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblbranch`
--

CREATE TABLE `tblbranch` (
  `branch_id` int(10) NOT NULL,
  `branch_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbranch`
--

INSERT INTO `tblbranch` (`branch_id`, `branch_name`) VALUES
(1, 'branch 01'),
(2, 'branch 02'),
(3, 'branch 03');

-- --------------------------------------------------------

--
-- Table structure for table `tblcashier`
--

CREATE TABLE `tblcashier` (
  `ID` int(10) NOT NULL,
  `branch_id` int(10) DEFAULT NULL,
  `CashierName` varchar(120) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcashier`
--

INSERT INTO `tblcashier` (`ID`, `branch_id`, `CashierName`, `UserName`, `MobileNumber`, `Password`, `CreationDate`) VALUES
(1, 1, 'Sugath Perera', 'sugath123', 9861234567, '83a54f35bc8f4aebd7a8f4abf3d32edc', '2026-03-03 03:51:35'),
(2, 2, 'Priyamal ', 'priyamal_janaka', 773672637, '2d1ecc70b17a7fd62d18a662700c8163', '2026-03-03 03:52:35'),
(3, 3, 'Namal', 'namal123', 773423183, 'c8d107702b32b3cd5cd209315c3632d7', '2026-03-03 03:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomers`
--

CREATE TABLE `tblcustomers` (
  `ID` int(10) NOT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Gender` enum('Female','Male','Transgender') DEFAULT NULL,
  `dob` date NOT NULL,
  `marriage_date` date NOT NULL,
  `Details` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice`
--

CREATE TABLE `tblinvoice` (
  `id` int(11) NOT NULL,
  `Userid` int(11) DEFAULT NULL,
  `ServiceId` varchar(255) DEFAULT NULL,
  `BillingId` int(11) DEFAULT NULL,
  `staff` varchar(50) NOT NULL DEFAULT '',
  `commision` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax` varchar(50) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `received_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `qty` int(11) NOT NULL DEFAULT 0,
  `payment_method` varchar(100) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `CashierId` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `customer_phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblinvoice`
--

INSERT INTO `tblinvoice` (`id`, `Userid`, `ServiceId`, `BillingId`, `staff`, `commision`, `tax`, `discount`, `total`, `received_amount`, `qty`, `payment_method`, `type`, `CashierId`, `branch_id`, `PostingDate`, `customer_phone`) VALUES
(1, NULL, '4', 805707437, '', 0.00, '0', 0.00, 950.00, 1000.00, 1, 'Cash', 1, 1, 0, '2026-03-04 05:42:55', ''),
(2, NULL, '3', 805707437, '', 0.00, '0', 0.00, 950.00, 1000.00, 1, 'Cash', 1, 1, 0, '2026-03-04 05:42:55', ''),
(3, NULL, '9', 641605131, '', 0.00, '0', 0.00, 1600.00, 1600.00, 1, 'Cash', 1, 1, 0, '2026-03-04 08:30:44', ''),
(4, NULL, '10', 641605131, '', 0.00, '0', 0.00, 1600.00, 1600.00, 1, 'Cash', 1, 1, 0, '2026-03-04 08:30:44', ''),
(5, NULL, '4', 108957220, '', 0.00, '0', 0.00, 3950.00, 4000.00, 1, 'Cash', 1, 1, 0, '2026-03-04 08:31:25', ''),
(6, NULL, '5', 108957220, '', 0.00, '0', 0.00, 3950.00, 4000.00, 1, 'Cash', 1, 1, 0, '2026-03-04 08:31:25', ''),
(7, NULL, '8', 521362922, '', 0.00, '0', 0.00, 2000.00, 2000.00, 1, 'Cash', 1, 1, 0, '2026-03-04 08:32:45', ''),
(8, NULL, '9', 521362922, '', 0.00, '0', 0.00, 2000.00, 2000.00, 1, 'Cash', 1, 1, 0, '2026-03-04 08:32:45', ''),
(9, NULL, '8', 206012116, '', 0.00, '0', 0.00, 2450.00, 2450.00, 1, 'Cash', 1, 1, 0, '2026-03-04 08:33:53', ''),
(10, NULL, '9', 206012116, '', 0.00, '0', 0.00, 2450.00, 2450.00, 1, 'Cash', 1, 1, 0, '2026-03-04 08:33:53', ''),
(11, NULL, '4', 206012116, '', 0.00, '0', 0.00, 2450.00, 2450.00, 1, 'Cash', 1, 1, 0, '2026-03-04 08:33:53', ''),
(12, NULL, '1', 586854484, '2', 0.00, '0', 0.00, 600.00, 600.00, 1, 'Cash', 1, 1, 1, '2026-03-04 11:37:57', ''),
(13, NULL, '2', 486323704, '2', 0.00, '0', 0.00, 2200.00, 2200.00, 1, 'Cash', 1, 1, 0, '2026-03-05 08:14:00', ''),
(14, NULL, '2', 486323704, '3', 0.00, '0', 0.00, 2200.00, 2200.00, 1, 'Cash', 1, 1, 0, '2026-03-05 08:14:00', ''),
(15, NULL, '29', 471961162, '2', 0.00, '0', 0.00, 80000.00, 80000.00, 1, 'Cash', 1, 1, 0, '2026-03-05 08:16:25', ''),
(16, NULL, '28', 471961162, '2', 0.00, '0', 0.00, 80000.00, 80000.00, 1, 'Cash', 1, 1, 0, '2026-03-05 08:16:25', ''),
(17, NULL, '29', 471961162, '3', 0.00, '0', 0.00, 80000.00, 80000.00, 1, 'Cash', 1, 1, 0, '2026-03-05 08:16:25', ''),
(18, NULL, '3', 681279959, '2', 0.00, '0', 0.00, 1400.00, 1400.00, 1, 'Cash', 1, 1, 1, '2026-03-05 08:18:32', ''),
(19, NULL, '4', 681279959, '3', 0.00, '0', 0.00, 1400.00, 1400.00, 2, 'Cash', 1, 1, 1, '2026-03-05 08:18:32', ''),
(20, NULL, '3', 196822864, '2', 0.00, '0', 0.00, 1450.00, 1450.00, 1, 'Cash', 1, 1, 0, '2026-03-05 11:10:52', ''),
(21, NULL, '4', 196822864, '3', 0.00, '0', 0.00, 1450.00, 1450.00, 1, 'Cash', 1, 1, 0, '2026-03-05 11:10:52', ''),
(22, NULL, '3', 196822864, '3', 0.00, '0', 0.00, 1450.00, 1450.00, 1, 'Cash', 1, 1, 0, '2026-03-05 11:10:52', ''),
(23, NULL, '8', 463906290, '2', 0.00, '0', 0.00, 2000.00, 2000.00, 1, 'Cash', 1, 1, 1, '2026-03-05 11:24:29', ''),
(24, NULL, '8', 463906290, '3', 0.00, '0', 0.00, 2000.00, 2000.00, 1, 'Cash', 1, 1, 1, '2026-03-05 11:24:29', ''),
(25, NULL, '9', 264587583, '2', 0.00, '0', 0.00, 2000.00, 2000.00, 1, 'Cash', 1, 1, 0, '2026-03-05 11:26:21', ''),
(26, NULL, '9', 264587583, '3', 0.00, '0', 0.00, 2000.00, 2000.00, 1, 'Cash', 1, 1, 0, '2026-03-05 11:26:21', ''),
(27, NULL, '5', 478194354, '2', 0.00, '0', 0.00, 7000.00, 7000.00, 1, 'Cash', 1, 1, 1, '2026-03-05 11:28:25', ''),
(28, NULL, '5', 478194354, '3', 0.00, '0', 0.00, 7000.00, 7000.00, 1, 'Cash', 1, 1, 1, '2026-03-05 11:28:25', ''),
(29, NULL, '2', 381461123, '2', 0.00, '0', 0.00, 3800.00, 3800.00, 2, 'Cash', 1, 1, 1, '2026-03-06 04:30:14', ''),
(30, NULL, '3', 381461123, '3', 0.00, '0', 0.00, 3800.00, 3800.00, 1, 'Cash', 1, 1, 1, '2026-03-06 04:30:14', ''),
(31, NULL, '2', 381461123, '3', 0.00, '0', 0.00, 3800.00, 3800.00, 1, 'Cash', 1, 1, 1, '2026-03-06 04:30:14', ''),
(32, NULL, '2', 476195440, '2', 0.00, '0', 0.00, 2100.00, 2100.00, 1, 'Cash', 1, 1, 1, '2026-03-06 07:20:14', ''),
(33, NULL, '3', 476195440, '2', 0.00, '0', 0.00, 2100.00, 2100.00, 1, 'Cash', 1, 1, 1, '2026-03-06 07:20:14', ''),
(34, NULL, '3', 476195440, '3', 0.00, '0', 0.00, 2100.00, 2100.00, 1, 'Cash', 1, 1, 1, '2026-03-06 07:20:14', ''),
(35, NULL, '4', 829667038, '2', 0.00, '0', 0.00, 450.00, 450.00, 1, 'Split', 1, 1, 1, '2026-03-06 09:39:16', 'testinh'),
(36, NULL, '5', 745349698, '2', 0.00, '0', 0.00, 3500.00, 3500.00, 1, 'Cash', 1, 1, 1, '2026-03-06 09:39:49', ''),
(37, NULL, '5', 145449044, '2', 0.00, '0', 0.00, 3500.00, 3500.00, 1, 'Cash', 1, 1, 1, '2026-03-06 09:49:06', ''),
(38, NULL, '7', 609761874, '2', 0.00, '0', 0.00, 1000.00, 0.00, 1, 'Split', 1, 1, 0, '2026-03-07 05:47:39', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblservices`
--

CREATE TABLE `tblservices` (
  `ID` int(10) NOT NULL,
  `ServiceName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `Cost` int(10) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `opening_stock` int(11) NOT NULL DEFAULT 0,
  `cate_id` varchar(50) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0 = inactive, 1 = active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblservices`
--

INSERT INTO `tblservices` (`ID`, `ServiceName`, `Description`, `Cost`, `Image`, `opening_stock`, `cate_id`, `type`, `CreationDate`, `status`) VALUES
(1, 'Hair Cut Only', 'Mens hair cut', 600, '55ccf27d26d7b23839986b6ae2e447ab1771912990.jpg', -3, '1', 2, '2026-02-23 08:25:41', 1),
(2, 'Hair and Beard Trimming ', 'Both hair and beard trimming ', 1100, '2f63515c67bf7ec8291582d183edda6c1772532192.png', -14, '1', 2, '2026-02-23 08:27:35', 1),
(3, 'Beard Trimming', 'Bear trimming only', 500, 'fdd923a9015cd896b4610d47b251b6a91772532212.jpg', -25, '1', 2, '2026-02-23 08:28:25', 1),
(4, 'Children Hair Cut', 'children school cut', 450, 'bb5e3d3cff477ef0ac3e8bedf2b68f581772532241.jpg', -30, '1', 2, '2026-02-23 08:29:13', 1),
(5, 'Oil Treatment', 'oil massage tratment only', 3500, '5c642ec854a6a92a56d7ebf0b9648eea1771913214.jpg', -28, '2', 2, '2026-02-23 08:30:07', 1),
(6, 'Berhmin Oil', 'using berahming oil message tratment', 1000, '4962c05b99e8520a079d9850442ffd771772532279.jpg', -8, '2', 2, '2026-02-23 08:32:36', 1),
(7, 'Nawarathna Oil', 'use nawarathna oil for massage ', 1000, '49a2c87fa8b27b75b56835fd225684fb1772532303.jpg', 11, '2', 1, '2026-02-23 08:33:23', 1),
(8, 'Vitamin E', 'use vitmin E 2 tabs', 1000, 'dbe8c1faa78c87fb239983a94a8967921772532324.jpg', 10, '2', 1, '2026-02-23 08:34:07', 1),
(9, 'Aex Oil Tretment', 'using axe oil for massage treatment', 1000, '88c8411221159180b311eafd05b5bb0e1772532355.jpg', -11, '2', 2, '2026-02-23 08:35:08', 1),
(10, 'Hena Dye', 'hena dye using for hair colour', 600, '0dab6fe960109559ff3c6302a914eb1e1772532378.jpg', -6, '3', 1, '2026-02-23 08:36:19', 1),
(11, 'Lannis', 'use lannis colouring', 1000, 'be2d71b807ab08ff4ff7fd56e1ea0c8b1772532410.jpg', -1, '3', 1, '2026-02-23 08:36:59', 1),
(12, 'Begen / Dreamro', 'Begen / Dreamro use for hair colour', 1500, '103e0a87212c535a7672592229dcd9b31772532432.jpg', 0, '3', 1, '2026-02-23 08:38:27', 1),
(13, 'Evon', 'Evon colour products', 1000, '94724da5cf87fef6c0d5cf0857aa54921772532458.jpeg', 0, '3', 1, '2026-02-23 08:39:02', 1),
(14, 'Loreal / Keune / Ganiya', 'Loreal / Keune / Ganiya addition pay for wash hair', 1500, '2d99ae9e904f880eef8feb4e61882b791771913359.jpg', 0, '3', 1, '2026-02-23 08:42:06', 1),
(15, 'Facial ', 'facial for face', 3500, 'e9db84d0e11b5c26723e9951e4f7204b1771913390.jpg', -2, '4', 2, '2026-02-23 08:42:56', 1),
(16, 'clean Up ', 'clean up the face using facial', 3000, 'b9fb9d37bdf15a699bc071ce49baea531772532513.jpg', 0, '4', 2, '2026-02-23 08:44:12', 1),
(17, 'Aryuweda Facial', 'using ayuruwedic products', 4000, 'c825c120b1a9b63424eacfdb0e381d281772532540.jpg', 0, '4', 2, '2026-02-23 08:44:53', 1),
(18, 'Gold Facial', 'gold use and do the facial', 4500, '5a50384cae0f97de34cf8eb2c34942881772532558.jpg', 0, '4', 2, '2026-02-23 08:52:49', 1),
(19, 'Face Massage treatment', 'face massage tretment ', 800, '27eb6d16ab6e1d702c5f0a5fb967036e1772532589.jpg', -1, '4', 2, '2026-02-23 09:01:40', 1),
(20, 'Conditional Treatment', 'hair condition tratment', 2500, 'cb768b829d8b4bea0bc49713cac214181772532640.jpg', -1, '5', 2, '2026-02-23 09:02:56', 1),
(21, 'Hena Treatment', 'hena using tratment', 2000, '746659867baea332dadc08308d9845421772532665.jpg', 0, '5', 2, '2026-02-23 09:03:37', 1),
(22, 'Oil Treatment', 'oil using treatment', 3000, 'b59e2fe48689bbc4cea831bbae32101d1772532685.jpg', 0, '5', 2, '2026-02-23 09:05:08', 1),
(24, 'Foot Massage ', 'foot massage treatment', 4000, 'b3f98875d8f39496698e36c9f2ec4d9d1771913647.jpg', 0, '5', 2, '2026-02-23 09:07:36', 1),
(25, 'Straight Hair', 'straight the hair ', 37000, '5c3f3707a54f7cba9a71195736de0f7a1772532739.jpg', 0, '6', 2, '2026-02-23 09:08:48', 1),
(26, 'Curly Hair', 'Carle the hair using items', 37000, '3cf259f0834b64710fc933b9be10271c1772532762.jpg', 0, '6', 2, '2026-02-23 09:09:59', 1),
(27, 'Rebordin hair', 'rebouring the hair ', 37000, 'adde6949ed2e18517b2f13ad80c8d4091771913518.jpg', 0, '6', 2, '2026-02-23 09:10:40', 1),
(28, 'Keratin Hair', 'Keratin the hair', 50000, 'c258427dd865b161e8d6415361cf9e871772532821.jpg', -1, '6', 2, '2026-02-23 09:11:23', 1),
(29, 'Fashion Colours', 'Fashion Colours', 15000, '60ccc7317972014e416efbabb4d09c321772532891.jpg', -2, '3', 2, '2026-03-03 10:14:51', 1),
(30, 'Nail treatment', 'Nail treatment', 5000, 'ffe74ae13c03398368aba8ff562e895e1772533005.jpg', 0, '7', 2, '2026-03-03 10:16:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscriber`
--

CREATE TABLE `tblsubscriber` (
  `ID` int(5) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `DateofSub` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubscriber`
--

INSERT INTO `tblsubscriber` (`ID`, `Email`, `DateofSub`) VALUES
(1, 'ani@gmail.com', '2023-12-09 07:32:33'),
(2, 'rahul@gmail.com', '2023-12-09 07:32:33'),
(3, 'ganesh@gmail.com', '2023-12-09 07:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `status`) VALUES
(1, 'Hair Cut', 1),
(2, 'Massage', 1),
(3, 'Hair Colouring', 1),
(4, 'Facial', 1),
(5, 'Hear Tretment', 1),
(6, 'Hair Fashion', 1),
(7, 'Minique', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `nic_no` varchar(200) NOT NULL,
  `branch_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`id`, `name`, `email`, `contact`, `nic_no`, `branch_id`) VALUES
(1, 'Sagath jya', 'suagath@gmail.com', '0448598392', '300290847832', 2),
(2, 'testing one', 'testing@gmail.com', '0889658432', '', 1),
(3, 'testing name', 'testing@gmail.comm', '0445367563', '099012347832', 1),
(4, 'danith', 'danith@gmail.com', '03328784672', '299478320931', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_schedule`
--

CREATE TABLE `tbl_staff_schedule` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `shift_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Scheduled',
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax`
--

CREATE TABLE `tbl_tax` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `delete_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_memberships`
--

CREATE TABLE `user_memberships` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('active','expired') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emailsetting`
--
ALTER TABLE `emailsetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_plans`
--
ALTER TABLE `membership_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbranch`
--
ALTER TABLE `tblbranch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `tblcashier`
--
ALTER TABLE `tblcashier`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_staff_schedule`
--
ALTER TABLE `tbl_staff_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_memberships`
--
ALTER TABLE `user_memberships`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `membership_plans`
--
ALTER TABLE `membership_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblappointment`
--
ALTER TABLE `tblappointment`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblbranch`
--
ALTER TABLE `tblbranch`
  MODIFY `branch_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcashier`
--
ALTER TABLE `tblcashier`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_staff_schedule`
--
ALTER TABLE `tbl_staff_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_memberships`
--
ALTER TABLE `user_memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
