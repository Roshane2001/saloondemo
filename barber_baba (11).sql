-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2026 at 06:57 AM
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
(719192236, '41b8f3b3a0a5c62d3ce1dea79a46e2351772260100.jpg', 'Supun Saloon', 1, 'wijesinghesupun250@gmail.com', '', '29/A1, Garden City, Minuwangoda Road, Ekala, Ja El', '41b8f3b3a0a5c62d3ce1dea79a46e2351772261714.jpg');

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
(1, 'Admin', 'Supunsaloon', '+94719192236', 'wijesinghesupun250@gmail.com', 'ff64805f8499eabb0f864df8371e2670', '2025-06-18 06:21:50');

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
  `branch_id` int(11) DEFAULT NULL,
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
(1, 'Ekala Juntion'),
(2, 'CTB Juntion'),
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
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0 = inactive, 1 = active',
  `service_time` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblservices`
--

INSERT INTO `tblservices` (`ID`, `ServiceName`, `Description`, `Cost`, `Image`, `opening_stock`, `cate_id`, `type`, `CreationDate`, `status`, `service_time`) VALUES
(1, 'Hair Cut Only', 'Mens hair cut', 500, '55ccf27d26d7b23839986b6ae2e447ab1771912990.jpg', -3, '1', 2, '2026-02-23 08:25:41', 1, 35),
(2, 'Hair and Beard Trimming ', 'Both hair and beard trimming ', 1100, '2f63515c67bf7ec8291582d183edda6c1772532192.png', -14, '1', 2, '2026-02-23 08:27:35', 1, 60),
(3, 'Beard Trimming', 'Bear trimming only', 500, 'fdd923a9015cd896b4610d47b251b6a91772532212.jpg', -25, '1', 2, '2026-02-23 08:28:25', 1, 30),
(4, 'Children Hair Cut', 'children school cut', 450, 'bb5e3d3cff477ef0ac3e8bedf2b68f581772532241.jpg', -30, '1', 2, '2026-02-23 08:29:13', 1, 20),
(5, 'Oil Treatment', 'oil massage tratment only', 3500, '5c642ec854a6a92a56d7ebf0b9648eea1771913214.jpg', -28, '2', 2, '2026-02-23 08:30:07', 1, 45),
(6, 'Berhmin Oil', 'using berahming oil message tratment', 1000, '4962c05b99e8520a079d9850442ffd771772532279.jpg', -8, '2', 1, '2026-02-23 08:32:36', 1, 25),
(7, 'Nawarathna Oil', 'use nawarathna oil for massage ', 1000, '49a2c87fa8b27b75b56835fd225684fb1772532303.jpg', 11, '2', 1, '2026-02-23 08:33:23', 1, 20),
(8, 'Vitamin E', 'use vitmin E 2 tabs', 1000, 'dbe8c1faa78c87fb239983a94a8967921772532324.jpg', 10, '2', 1, '2026-02-23 08:34:07', 1, 15),
(9, 'Aex Oil Tretment', 'using axe oil for massage treatment', 1000, '88c8411221159180b311eafd05b5bb0e1772532355.jpg', -11, '2', 1, '2026-02-23 08:35:08', 1, 20),
(10, 'Hena Dye', 'hena dye using for hair colour', 600, '0dab6fe960109559ff3c6302a914eb1e1772532378.jpg', -6, '3', 1, '2026-02-23 08:36:19', 1, 15),
(11, 'Lannis', 'use lannis colouring', 1000, 'be2d71b807ab08ff4ff7fd56e1ea0c8b1772532410.jpg', -1, '3', 1, '2026-02-23 08:36:59', 1, 60),
(12, 'Begen / Dreamro', 'Begen / Dreamro use for hair colour', 1500, '103e0a87212c535a7672592229dcd9b31772532432.jpg', 0, '3', 1, '2026-02-23 08:38:27', 1, 60),
(13, 'Evon', 'Evon colour products', 1000, '94724da5cf87fef6c0d5cf0857aa54921772532458.jpeg', 0, '3', 1, '2026-02-23 08:39:02', 1, 50),
(14, 'Loreal / Keune / Ganiya', 'Loreal / Keune / Ganiya addition pay for wash hair', 1500, '2d99ae9e904f880eef8feb4e61882b791771913359.jpg', 0, '3', 1, '2026-02-23 08:42:06', 1, 45),
(15, 'Facial ', 'facial for face', 3500, 'e9db84d0e11b5c26723e9951e4f7204b1771913390.jpg', -2, '4', 2, '2026-02-23 08:42:56', 1, 45),
(16, 'clean Up ', 'clean up the face using facial', 3000, 'b9fb9d37bdf15a699bc071ce49baea531772532513.jpg', 0, '4', 2, '2026-02-23 08:44:12', 1, 40),
(17, 'Aryuweda Facial', 'using ayuruwedic products', 4000, 'c825c120b1a9b63424eacfdb0e381d281772532540.jpg', 0, '4', 2, '2026-02-23 08:44:53', 1, 45),
(18, 'Gold Facial', 'gold use and do the facial', 4500, '5a50384cae0f97de34cf8eb2c34942881772532558.jpg', 0, '4', 2, '2026-02-23 08:52:49', 1, 75),
(19, 'Face Massage treatment', 'face massage tretment ', 800, '27eb6d16ab6e1d702c5f0a5fb967036e1772532589.jpg', -1, '4', 2, '2026-02-23 09:01:40', 1, 60),
(20, 'Conditional Treatment', 'hair condition tratment', 2500, 'cb768b829d8b4bea0bc49713cac214181772532640.jpg', -1, '5', 2, '2026-02-23 09:02:56', 1, 50),
(21, 'Hena Treatment', 'hena using tratment', 2000, '746659867baea332dadc08308d9845421772532665.jpg', 0, '5', 2, '2026-02-23 09:03:37', 1, 15),
(22, 'Oil Treatment', 'oil using treatment', 3000, 'b59e2fe48689bbc4cea831bbae32101d1772532685.jpg', 0, '5', 2, '2026-02-23 09:05:08', 1, 46),
(24, 'Foot Massage ', 'foot massage treatment', 4000, 'b3f98875d8f39496698e36c9f2ec4d9d1771913647.jpg', 0, '5', 2, '2026-02-23 09:07:36', 1, 30),
(25, 'Straight Hair', 'straight the hair ', 37000, '5c3f3707a54f7cba9a71195736de0f7a1772532739.jpg', 0, '6', 2, '2026-02-23 09:08:48', 1, 45),
(26, 'Curly Hair', 'Carle the hair using items', 37000, '3cf259f0834b64710fc933b9be10271c1772532762.jpg', 0, '6', 2, '2026-02-23 09:09:59', 1, 75),
(27, 'Rebordin hair', 'rebouring the hair ', 37000, 'adde6949ed2e18517b2f13ad80c8d4091771913518.jpg', 0, '6', 2, '2026-02-23 09:10:40', 1, 90),
(28, 'Keratin Hair', 'Keratin the hair', 50000, 'c258427dd865b161e8d6415361cf9e871772532821.jpg', -1, '6', 2, '2026-02-23 09:11:23', 1, 55),
(29, 'Fashion Colours', 'Fashion Colours', 15000, '60ccc7317972014e416efbabb4d09c321772532891.jpg', -2, '3', 2, '2026-03-03 10:14:51', 1, 60),
(30, 'Nail treatment', 'Nail treatment', 5000, 'ffe74ae13c03398368aba8ff562e895e1772533005.jpg', 0, '7', 2, '2026-03-03 10:16:45', 1, 40);

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
-- Table structure for table `tbl_branch_stock`
--

CREATE TABLE `tbl_branch_stock` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_branch_stock`
--

INSERT INTO `tbl_branch_stock` (`id`, `branch_id`, `service_id`, `quantity`) VALUES
(1, 1, 12, 0),
(2, 2, 12, 0),
(3, 3, 12, 0),
(4, 1, 13, 0),
(5, 2, 13, 0),
(6, 3, 13, 0),
(7, 1, 10, 0),
(8, 2, 10, 0),
(9, 3, 10, 0),
(10, 1, 11, 0),
(11, 2, 11, 0),
(12, 3, 11, 0),
(13, 1, 14, 0),
(14, 2, 14, 0),
(15, 3, 14, 0),
(16, 1, 7, 0),
(17, 2, 7, 0),
(18, 3, 7, 0),
(19, 1, 8, 0),
(20, 2, 8, 0),
(21, 3, 8, 0),
(75, 1, 9, 0),
(76, 2, 9, 0),
(77, 3, 9, 0),
(81, 1, 6, 0),
(82, 2, 6, 0),
(83, 3, 6, 0);

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
-- Indexes for table `tbl_branch_stock`
--
ALTER TABLE `tbl_branch_stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branch_product_unique` (`branch_id`,`service_id`),
  ADD KEY `service_id` (`service_id`);

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_branch_stock`
--
ALTER TABLE `tbl_branch_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_branch_stock`
--
ALTER TABLE `tbl_branch_stock`
  ADD CONSTRAINT `tbl_branch_stock_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_branch_stock_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `tblservices` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
