-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2026 at 12:55 PM
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
(2147483647, '1bb87d41d15fe27b500a4bfcde01bb0e1771915323.png', 'Saloon Test', 1, 'saloontesting@gmail.com', 'www.saloontest.lk', 'pamunugma bjhf', '779b7513263ef185b6d094af290ef5401771914971.png');

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
(1, 'Admin', 'mayurik', '+91 95292 30400', 'work@mayurik.com', '098586b40115aced2ce2c46428309fda', '2025-06-18 06:21:50');

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

--
-- Dumping data for table `tblappointment`
--

INSERT INTO `tblappointment` (`ID`, `AptNumber`, `Name`, `Email`, `PhoneNumber`, `AptDate`, `AptTime`, `Services`, `ApplyDate`, `Remark`, `Status`, `total`, `grand_total`, `payment_id`, `order_id`, `RemarkDate`) VALUES
(1, '406902384', '2', 'singh@gmail.com', 9861234567, '2025-06-22', '10:19', '1', '2025-06-18 05:49:20', 'booke', '1', ' 120', '132.00', '', '', '2025-06-18 06:03:43'),
(2, '838216640', '6', 'manish@gmail.com', 9879879798, '2025-06-20', '10:19', '2,4', '2025-06-18 05:49:58', 'come on time', '1', ' 1000', '1100.00', '', '', '2025-06-18 06:04:50'),
(3, '198518991', '9', 'ananya.sharma@email.com', 9876543210, '2025-06-23', '11:00', '8,10', '2025-06-18 05:51:07', 'come on time', '1', ' 4249', '4673.90', '', '', '2025-06-18 06:05:50'),
(4, '614651899', '10', 'baxiwo2548@3dboxer.com', 9823456781, '2025-06-22', '12:00', '17', '2025-06-18 05:51:49', 'come on time', '1', ' 85', '93.50', '', '', '2025-06-18 06:10:05'),
(5, '305700091', '12', 'neha.patil@email.com', 9765432198, '2025-06-24', '12:00', '18', '2025-06-18 05:52:30', 'come', '1', ' 10', '11.00', '', '', '2025-06-18 06:06:22'),
(6, '469626681', '11', 'pri.d@email.com', 989898989, '2025-06-26', '10:00', '1', '2025-06-18 06:01:07', 'booked', '1', ' 120', '132.00', '', '', '2025-06-18 06:06:55'),
(7, '931285159', '15', 'nitin@gmail.com', 9861234567, '2025-06-27', '01:00', '12', '2025-06-18 06:01:35', 'not available', '2', '', '', '', '', '2025-06-18 06:08:00'),
(8, '191691176', '16', 'nirja@gmail.com', 9861234567, '2025-06-30', '12:00', '9', '2025-06-18 06:02:07', 'not available', '2', '', '', '', '', '2025-06-18 06:08:27'),
(9, '724442498', '14', 'hrao@email.com', 9823412398, '2025-06-25', '11:00', '17', '2025-06-18 06:02:33', 'cancel', '2', '', '', '', '', '2025-06-18 06:10:49'),
(10, '700954060', '13', 'rohan.kapoor@email.com', 9832123456, '2025-06-25', '11:00', '6', '2025-06-18 06:03:12', 'booked', '1', ' 300', '330.00', '', '', '2025-06-18 06:09:09'),
(11, '316060975', '6', 'manish@gmail.com', 9879879798, '2025-06-19', '11:20', '6', '2025-06-18 17:23:55', NULL, NULL, '', '', '', '', NULL),
(12, '604285254', '17', 'malaka@gmail.com', 773672637, '2026-02-19', '19:34', '4', '2026-02-17 11:01:13', 'errerg', '1', ' 500', '550.00', '', '', '2026-02-17 11:02:20'),
(13, '797761146', '18', 'praneethrp2001@gmail.com', 778378673, '2026-02-20', '18:35', '6', '2026-02-17 11:03:46', 'your appoiment is confirm', '1', ' 300', '330.00', '', '', '2026-02-17 11:04:29'),
(14, '311128180', '6', 'manish@gmail.com', 9879879798, '2026-02-18', '17:48', '3', '2026-02-23 10:16:47', NULL, NULL, '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcashier`
--

CREATE TABLE `tblcashier` (
  `ID` int(10) NOT NULL,
  `CashierName` varchar(120) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
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

--
-- Dumping data for table `tblcustomers`
--

INSERT INTO `tblcustomers` (`ID`, `Name`, `Email`, `MobileNumber`, `Gender`, `dob`, `marriage_date`, `Details`, `CreationDate`, `UpdationDate`) VALUES
(2, 'Rahul Singh', 'singh@gmail.com', 9861234567, 'Male', '1988-06-30', '0000-00-00', 'Taken haircut by him', '2023-12-08 11:10:02', '2026-02-17 11:41:10'),
(6, 'Manish patil', 'manish@gmail.com', 9879879798, 'Male', '1995-12-19', '0000-00-00', 'Hair spa every 2nd Saturday', '2023-12-08 11:10:02', '2025-06-05 12:03:11'),
(9, 'Ananya Sharma	', 'ananya.sharma@email.com', 9876543210, 'Female', '1993-05-12', '0000-00-00', 'Prefers evening appointments', '2025-06-05 11:56:48', NULL),
(10, 'Rahul Mehta	', 'baxiwo2548@3dboxer.com', 9823456781, 'Male', '1998-06-10', '1915-06-10', 'Allergic to certain hair dyes', '2025-06-05 11:58:26', '2025-06-09 09:35:35'),
(11, 'Pritam Deshmukh	', 'pri.d@email.com', 989898989, 'Female', '2000-10-03', '0000-00-00', 'Regular manicure every 15 days', '2025-06-05 11:59:36', '2025-06-18 05:59:43'),
(12, 'Suresh Nair	', 'neha.patil@email.com', 9765432198, 'Male', '1997-06-17', '0000-00-00', 'Vegan products only', '2025-06-05 12:00:36', NULL),
(13, 'Rohan Kapoor	', 'rohan.kapoor@email.com', 9832123456, 'Male', '2002-03-20', '0000-00-00', 'Monthly haircut & beard trim', '2025-06-05 12:01:36', NULL),
(14, 'Harsh Rao	', 'hrao@email.com', 9823412398, 'Female', '2002-06-19', '0000-00-00', 'Bridal makeup booked in Sept', '2025-06-05 12:04:23', '2025-06-18 05:58:58'),
(15, 'Nitin Patil', 'nitin@gmail.com', 9861234567, 'Female', '1990-01-01', '2025-05-05', 'booked before', '2025-06-18 05:47:14', '2025-06-18 06:00:28'),
(16, 'Niraj Pagar ', 'nirja@gmail.com', 9861234567, 'Female', '1991-06-02', '0000-00-00', 'working', '2025-06-18 05:48:48', '2025-06-18 05:59:19'),
(17, 'Malaka Silva', 'malaka@gmail.com', 773672637, 'Male', '2017-02-08', '0000-00-00', 'salonn', '2026-02-17 11:00:37', NULL),
(18, 'Roshane Perera', 'praneethrp2001@gmail.com', 778378673, 'Male', '2001-02-16', '0000-00-00', 'testing email', '2026-02-17 11:03:15', NULL),
(19, 'madushika FE IT', 'madushika@gmail.com', 887867564, 'Female', '1994-01-12', '0000-00-00', 'testing onw', '2026-02-18 10:21:44', NULL),
(20, 'Mech', 'mech@gmail.com', 778370098, 'Male', '2015-02-25', '0000-00-00', 'rbggvvd', '2026-02-24 06:25:08', NULL);

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
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `qty` int(11) NOT NULL DEFAULT 0,
  `payment_method` varchar(100) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `CashierId` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `customer_phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblinvoice`
--

INSERT INTO `tblinvoice` (`id`, `Userid`, `ServiceId`, `BillingId`, `staff`, `commision`, `tax`, `total`, `qty`, `payment_method`, `type`, `CashierId`, `PostingDate`, `customer_phone`) VALUES
(1, 2, '1,2', 786714662, '3', 13.20, '10', 132.00, 0, '', 0, NULL, '2025-06-18 00:00:00', NULL),
(2, 6, '2', 916334187, '7', 55.00, '10', 1100.00, 0, '', 0, NULL, '2025-06-18 00:00:00', NULL),
(3, 6, '4', 916334187, '7', 55.00, '10', 1100.00, 0, '', 0, NULL, '2025-06-18 00:00:00', NULL),
(4, 9, '8', 611651392, '3', 233.70, '10', 4673.90, 0, '', 0, NULL, '2025-06-18 00:00:00', NULL),
(5, 9, '10', 611651392, '3', 233.70, '10', 4673.90, 0, '', 0, NULL, '2025-06-18 00:00:00', NULL),
(6, 12, '18', 449785482, '7', 1.10, '10', 11.00, 0, '', 0, NULL, '2025-06-18 00:00:00', NULL),
(7, 11, '1', 266019248, '6', 13.20, '10', 132.00, 0, '', 0, NULL, '2025-06-18 00:00:00', NULL),
(8, 13, '6', 204305143, '4', 33.00, '10', 330.00, 0, '', 0, NULL, '2025-06-18 00:00:00', NULL),
(9, 10, '17', 746950582, '5', 9.35, '10', 93.50, 0, '', 0, NULL, '2025-06-18 00:00:00', NULL),
(10, 2, '22', 691714693, '', 0.00, '10', 2420.00, 1, '1', 1, NULL, '2025-06-18 00:00:00', NULL),
(11, 2, '11', 691714693, '', 0.00, '10', 2420.00, 1, '1', 1, NULL, '2025-06-18 00:00:00', NULL),
(12, 10, '25', 435735784, '', 0.00, '10', 1010.90, 1, '1', 1, NULL, '2025-06-18 00:00:00', NULL),
(13, 10, '26', 435735784, '', 0.00, '10', 1010.90, 1, '1', 1, NULL, '2025-06-18 00:00:00', NULL),
(14, 14, '28', 347426140, '', 0.00, '10', 5280.00, 2, '2', 1, NULL, '2025-06-18 00:00:00', NULL),
(15, 14, '29', 347426140, '', 0.00, '10', 5280.00, 2, '2', 1, NULL, '2025-06-18 00:00:00', NULL),
(16, 13, '24', 750091638, '', 0.00, '10', 1177.00, 1, '1', 1, NULL, '2025-06-18 00:00:00', NULL),
(17, 13, '26', 750091638, '', 0.00, '10', 1177.00, 1, '1', 1, NULL, '2025-06-18 00:00:00', NULL),
(18, 14, '26', 293695303, '', 0.00, '10', 682.00, 1, '1', 1, NULL, '2025-06-18 00:00:00', NULL),
(19, 2, '22', 464480648, '', 0.00, '10', 3186.70, 2, '1', 1, NULL, '2025-06-18 00:00:00', NULL),
(20, 2, '25', 464480648, '', 0.00, '10', 3186.70, 3, '1', 1, NULL, '2025-06-18 00:00:00', NULL),
(21, 17, '4', 327119341, '6', 55.00, '10', 550.00, 0, '', 0, NULL, '2026-02-17 00:00:00', NULL),
(22, 18, '6', 525400904, '4', 33.00, '10', 330.00, 0, '', 0, NULL, '2026-02-17 00:00:00', NULL),
(23, 18, '27', 639217453, '', 0.00, '10', 4400.00, 4, '5', 1, NULL, '2026-02-17 00:00:00', NULL),
(24, NULL, '4', 714099206, '', 0.00, '0', 363.00, 1, 'Cash', 1, 1, '2026-02-24 05:35:17', NULL),
(25, NULL, '3', 714099206, '', 0.00, '0', 363.00, 1, 'Cash', 1, 1, '2026-02-24 05:35:18', NULL),
(26, NULL, '4', 490501647, '', 0.00, '0', 198.00, 1, 'Cash', 1, 1, '2026-02-24 05:35:44', NULL),
(27, NULL, '4', 673399983, '', 0.00, '0', 330.00, 1, 'Cash', 1, 1, '2026-02-24 05:36:29', NULL),
(28, NULL, '3', 673399983, '', 0.00, '0', 330.00, 1, 'Cash', 1, 1, '2026-02-24 05:36:29', NULL),
(29, NULL, '5', 511574999, '', 0.00, '0', 400.00, 1, 'Card', 1, 1, '2026-02-24 05:37:08', NULL),
(30, NULL, '9', 344116033, '', 0.00, '0', 520.00, 1, 'Cash', 1, 1, '2026-02-24 05:37:34', NULL),
(31, NULL, '10', 344116033, '', 0.00, '0', 520.00, 1, 'Cash', 1, 1, '2026-02-24 05:37:34', NULL),
(32, NULL, '5', 991678040, '', 0.00, '0', 400.00, 1, 'Cash', 1, 1, '2026-02-24 07:18:10', NULL),
(33, NULL, '5', 509270385, '', 0.00, '0', 400.00, 1, 'Cash', 1, 1, '2026-02-24 07:21:21', NULL),
(34, NULL, '5', 250533192, '', 0.00, '0', 580.00, 1, 'Cash', 1, 1, '2026-02-24 08:26:24', NULL),
(35, NULL, '4', 250533192, '', 0.00, '0', 580.00, 1, 'Cash', 1, 1, '2026-02-24 08:26:24', NULL),
(36, NULL, '5', 534710821, '', 0.00, '0', 580.00, 1, 'Cash', 1, 1, '2026-02-24 08:32:59', NULL),
(37, NULL, '4', 534710821, '', 0.00, '0', 580.00, 1, 'Cash', 1, 1, '2026-02-24 08:32:59', NULL),
(38, NULL, '5', 218850151, '', 0.00, '0', 580.00, 1, 'Cash', 1, 1, '2026-02-24 08:39:11', NULL),
(39, NULL, '4', 218850151, '', 0.00, '0', 580.00, 1, 'Cash', 1, 1, '2026-02-24 08:39:11', NULL),
(40, NULL, '5', 998807484, '', 0.00, '0', 580.00, 1, 'Cash', 1, 1, '2026-02-24 08:42:22', NULL),
(41, NULL, '4', 998807484, '', 0.00, '0', 580.00, 1, 'Cash', 1, 1, '2026-02-24 08:42:22', NULL),
(42, NULL, '2', 173883723, '', 0.00, '0', 350.00, 1, 'Cash', 1, 1, '2026-02-24 08:56:02', NULL),
(43, NULL, '10', 234063782, '', 0.00, '0', 520.00, 1, 'Cash', 1, 1, '2026-02-24 09:15:29', NULL),
(44, NULL, '9', 234063782, '', 0.00, '0', 520.00, 1, 'Cash', 1, 1, '2026-02-24 09:15:29', NULL),
(45, NULL, '5', 582706842, '', 0.00, '0', 850.00, 1, 'Cash', 1, 1, '2026-02-24 09:22:26', NULL),
(46, NULL, '6', 582706842, '', 0.00, '0', 850.00, 1, 'Cash', 1, 1, '2026-02-24 09:22:26', NULL),
(47, NULL, '5', 518165408, '', 0.00, '0', 850.00, 1, 'Cash', 1, 1, '2026-02-24 09:23:07', NULL),
(48, NULL, '6', 518165408, '', 0.00, '0', 850.00, 1, 'Cash', 1, 1, '2026-02-24 09:23:07', NULL),
(49, NULL, '5', 197077671, '', 0.00, '0', 400.00, 1, 'Cash', 1, 1, '2026-02-24 09:26:11', NULL),
(50, NULL, '5', 600605470, '', 0.00, '0', 400.00, 1, 'Cash', 1, 1, '2026-02-24 10:14:19', NULL),
(51, NULL, '5', 273828198, '', 0.00, '0', 400.00, 1, 'Cash', 1, 1, '2026-02-24 10:53:05', NULL),
(52, NULL, '1', 989556491, '', 0.00, '0', 450.00, 1, 'Cash', 1, 1, '2026-02-24 11:09:19', NULL),
(53, NULL, '7', 989556491, '', 0.00, '0', 450.00, 1, 'Cash', 1, 1, '2026-02-24 11:09:19', NULL),
(54, NULL, '9', 293361999, '', 0.00, '0', 520.00, 1, 'Cash', 1, 1, '2026-02-24 11:11:09', NULL),
(55, NULL, '10', 293361999, '', 0.00, '0', 520.00, 1, 'Cash', 1, 1, '2026-02-24 11:11:09', NULL),
(56, NULL, '3', 269507715, '', 0.00, '0', 330.00, 1, 'Cash', 1, 1, '2026-02-24 11:27:46', '0897563562'),
(57, NULL, '4', 269507715, '', 0.00, '0', 330.00, 1, 'Cash', 1, 1, '2026-02-24 11:27:46', '0897563562'),
(58, NULL, '3', 483728340, '', 0.00, '0', 500.00, 1, 'Cash', 1, 1, '2026-02-24 11:28:59', '0993894293'),
(59, NULL, '2', 483728340, '', 0.00, '0', 500.00, 1, 'Cash', 1, 1, '2026-02-24 11:28:59', '0993894293'),
(60, NULL, '2', 925928908, '', 0.00, '0', 350.00, 1, 'Cash', 1, 1, '2026-02-24 11:30:29', '0887654342'),
(61, NULL, '2', 134248999, '', 0.00, '0', 1200.00, 1, 'Cash', 1, 1, '2026-02-24 11:31:36', '0778378673'),
(62, NULL, '5', 134248999, '', 0.00, '0', 1200.00, 1, 'Cash', 1, 1, '2026-02-24 11:31:36', '0778378673'),
(63, NULL, '6', 134248999, '', 0.00, '0', 1200.00, 1, 'Cash', 1, 1, '2026-02-24 11:31:36', '0778378673'),
(64, NULL, '2', 909203278, '', 0.00, '0', 500.00, 1, 'Cash', 1, 1, '2026-02-24 11:32:36', '0894537408'),
(65, NULL, '3', 909203278, '', 0.00, '0', 500.00, 1, 'Cash', 1, 1, '2026-02-24 11:32:36', '0894537408'),
(66, NULL, '8', 287119990, '', 0.00, '0', 450.00, 1, 'Cash', 1, 1, '2026-02-24 11:35:51', '0894537408'),
(67, NULL, '7', 287119990, '', 0.00, '0', 450.00, 1, 'Cash', 1, 1, '2026-02-24 11:35:51', '0894537408'),
(68, NULL, '2', 654546795, '', 0.00, '0', 500.00, 1, 'Cash', 1, 1, '2026-02-24 11:45:46', '0778376463'),
(69, NULL, '3', 654546795, '', 0.00, '0', 500.00, 1, 'Cash', 1, 1, '2026-02-24 11:45:46', '0778376463');

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
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblservices`
--

INSERT INTO `tblservices` (`ID`, `ServiceName`, `Description`, `Cost`, `Image`, `opening_stock`, `cate_id`, `type`, `CreationDate`) VALUES
(1, 'Hair Cut Only', 'Mens hair cut', 200, '55ccf27d26d7b23839986b6ae2e447ab1771912990.jpg', -1, '1', 1, '2026-02-23 08:25:41'),
(2, 'Hair and Beard Trimming ', 'Both hair and beard trimming ', 350, '55ccf27d26d7b23839986b6ae2e447ab1771912768.jpg', -6, '1', 2, '2026-02-23 08:27:35'),
(3, 'Beard Trimming', 'Bear trimming only', 150, '55ccf27d26d7b23839986b6ae2e447ab1771912797.jpg', -6, '1', 2, '2026-02-23 08:28:25'),
(4, 'Vhildren Hair Cut', 'children school cut', 180, '55ccf27d26d7b23839986b6ae2e447ab1771913134.jpg', -8, '1', 2, '2026-02-23 08:29:13'),
(5, 'Oil Treatment', 'oil massage tratment only', 400, '5c642ec854a6a92a56d7ebf0b9648eea1771913214.jpg', -13, '2', 2, '2026-02-23 08:30:07'),
(6, 'Berhmin Oil', 'using berahming oil message tratment', 450, '5c642ec854a6a92a56d7ebf0b9648eea1771913225.jpg', -3, '2', 2, '2026-02-23 08:32:36'),
(7, 'Nawarathna Oil', 'use nawarathna oil for massage ', 250, '5c642ec854a6a92a56d7ebf0b9648eea1771913236.jpg', -2, '2', 2, '2026-02-23 08:33:23'),
(8, 'Vitamin E', 'use vitmin E 2 tabs', 200, '5c642ec854a6a92a56d7ebf0b9648eea1771913248.jpg', -1, '2', 2, '2026-02-23 08:34:07'),
(9, 'Aex Oil Tretment', 'using axe oil for massage treatment', 220, '5c642ec854a6a92a56d7ebf0b9648eea1771913258.jpg', -3, '2', 2, '2026-02-23 08:35:08'),
(10, 'Hena Dye', 'hena dye using for hair colour', 300, '2d99ae9e904f880eef8feb4e61882b791771913303.jpg', -3, '3', 2, '2026-02-23 08:36:19'),
(11, 'Lannis', 'use lannis colouring', 600, '2d99ae9e904f880eef8feb4e61882b791771913316.jpg', 0, '3', 2, '2026-02-23 08:36:59'),
(12, 'Begen / Dreamro', 'Begen / Dreamro use for hair colour', 1000, '2d99ae9e904f880eef8feb4e61882b791771913331.jpg', 0, '3', 2, '2026-02-23 08:38:27'),
(13, 'Evon', 'Evon colour products', 1100, '2d99ae9e904f880eef8feb4e61882b791771913345.jpg', 0, '3', 2, '2026-02-23 08:39:02'),
(14, 'Loreal / Keune / Ganiya', 'Loreal / Keune / Ganiya addition pay for wash hair', 1500, '2d99ae9e904f880eef8feb4e61882b791771913359.jpg', 0, '3', 2, '2026-02-23 08:42:06'),
(15, 'Facial ', 'facial for face', 1300, 'e9db84d0e11b5c26723e9951e4f7204b1771913390.jpg', 0, '4', 2, '2026-02-23 08:42:56'),
(16, 'clean Up ', 'clean up the face using facial', 1600, 'e9db84d0e11b5c26723e9951e4f7204b1771913403.jpg', 0, '4', 2, '2026-02-23 08:44:12'),
(17, 'Aryuweda Facial', 'using ayuruwedic products', 2000, 'e9db84d0e11b5c26723e9951e4f7204b1771913417.jpg', 0, '4', 2, '2026-02-23 08:44:53'),
(18, 'Gold Facial', 'gold use and do the facial', 2500, 'e9db84d0e11b5c26723e9951e4f7204b1771913430.jpg', 0, '4', 2, '2026-02-23 08:52:49'),
(19, 'Face Massage treatment', 'face massage tretment ', 3000, 'e9db84d0e11b5c26723e9951e4f7204b1771913443.jpg', 0, '4', 2, '2026-02-23 09:01:40'),
(20, 'Conditional Treatment', 'hair condition tratment', 3200, 'b3f98875d8f39496698e36c9f2ec4d9d1771913809.jpg', 0, '5', 2, '2026-02-23 09:02:56'),
(21, 'Hena Treatment', 'hena using tratment', 4000, 'b3f98875d8f39496698e36c9f2ec4d9d1771913793.jpg', 0, '5', 2, '2026-02-23 09:03:37'),
(22, 'Oil Treatment', 'oil using treatment', 3300, 'b3f98875d8f39496698e36c9f2ec4d9d1771913780.jpg', 0, '5', 2, '2026-02-23 09:05:08'),
(23, 'Hair treatment', 'hair treatment using ', 2800, 'b3f98875d8f39496698e36c9f2ec4d9d1771913767.jpg', 0, '5', 2, '2026-02-23 09:06:16'),
(24, 'Foot Massage ', 'foot massage treatment', 4000, 'b3f98875d8f39496698e36c9f2ec4d9d1771913647.jpg', 0, '5', 2, '2026-02-23 09:07:36'),
(25, 'Straight Hair', 'straight the hair ', 6000, 'adde6949ed2e18517b2f13ad80c8d4091771913554.jpg', 0, '6', 2, '2026-02-23 09:08:48'),
(26, 'Curly Hair', 'Carle the hair using items', 5000, 'adde6949ed2e18517b2f13ad80c8d4091771913531.jpg', 0, '6', 2, '2026-02-23 09:09:59'),
(27, 'Reborin hair', 'rebouring the hair ', 5500, 'adde6949ed2e18517b2f13ad80c8d4091771913518.jpg', 0, '6', 2, '2026-02-23 09:10:40'),
(28, 'Keratin Hair', 'Keratin the hair', 3600, 'adde6949ed2e18517b2f13ad80c8d4091771913505.jpg', 0, '6', 2, '2026-02-23 09:11:23');

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
(6, 'Hair Fashion', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`id`, `name`, `email`, `contact`, `address`) VALUES
(3, 'Priya Sharma', '12 Rosewood Apartments, MG Road, Bangalore, Karnataka', '9876543210', 'priya.sharma@example.com'),
(4, 'Rahul Mehta', '45 Green Park, Sector 14, Gurgaon, Haryana', '9123456789', 'rahul.mehta@example.com'),
(5, 'Anjali Verma', '78 Lake View Colony, Pune, Maharashtra', '9988766554', 'anjali.verma@example.com'),
(6, ' Karan Singh', '23 Palm Street, Salt Lake, Kolkata, West Bengal', '9567233445', 'karan.singh@example.com'),
(7, 'Sneha Joshi', '67 Hilltop Residency, Whitefield, Bangalore, Karnataka', '9874512345', 'sneha.joshi@example.com'),
(8, 'Amit Desaii', '90 Coral Sands, Juhu, Mumbai, Maharashtra', '90 Coral Sands, Juhu, Mumbai, Maharashtra', 'amit.desai@example.com'),
(9, 'tyron', 'ty@gmail.com', '0998765453', 'pamunugama');

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

--
-- Dumping data for table `tbl_staff_schedule`
--

INSERT INTO `tbl_staff_schedule` (`id`, `staff_id`, `shift_date`, `start_time`, `end_time`, `status`, `note`, `created_at`) VALUES
(1, 3, '2025-06-19', '10:00:00', '05:00:00', 'Working', NULL, '2025-06-18 06:28:10'),
(2, 4, '2025-06-04', '11:00:00', '06:00:00', 'Working', NULL, '2025-06-18 06:28:45'),
(3, 5, '2025-06-07', '10:00:00', '05:00:00', 'Day Off', NULL, '2025-06-18 06:29:29'),
(4, 5, '2026-02-18', '17:59:00', '14:02:00', 'Working', NULL, '2026-02-17 11:28:41');

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
-- Dumping data for table `user_memberships`
--

INSERT INTO `user_memberships` (`id`, `user_id`, `plan_id`, `start_date`, `end_date`, `status`) VALUES
(1, 6, 3, '2026-02-19', '2026-02-22', 'active'),
(3, 12, 6, '2025-06-09', '2025-06-12', 'active'),
(4, 16, 3, '2025-06-18', '2025-06-21', 'active'),
(5, 18, 5, '2026-02-17', '2026-02-19', 'active');

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblcashier`
--
ALTER TABLE `tblcashier`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_staff_schedule`
--
ALTER TABLE `tbl_staff_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_memberships`
--
ALTER TABLE `user_memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
