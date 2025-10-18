-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2025 at 05:27 PM
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
-- Database: `krisok`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'Shreejani', 'shreejani@gmail.com', '12345'),
(2, 'Haswati', 'haswati@gmail.com', '12345'),
(3, 'Oindrila', 'oindrila@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `crop_insurance`
--

CREATE TABLE `crop_insurance` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `aadhaar` varchar(12) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `pan` varchar(10) NOT NULL,
  `crop_type` varchar(50) NOT NULL,
  `season` varchar(50) NOT NULL,
  `area` decimal(5,2) NOT NULL,
  `block` varchar(100) NOT NULL,
  `proof` varchar(255) NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_insurance`
--

INSERT INTO `crop_insurance` (`id`, `name`, `aadhaar`, `phone`, `pan`, `crop_type`, `season`, `area`, `block`, `proof`, `submission_date`, `status`) VALUES
(10, 'anua manna', '980765432117', '2435876543', 'ALWQD2133K', 'Rice', 'Rabi', 0.30, '0', 'uploads/BCA 6 SEM Syllabus.pdf', '2025-06-13 04:59:05', 'pending'),
(11, 'anua manna', '980765432117', '2435876543', 'ALWQD2133K', 'Wheat', 'Kharif', 0.30, '0', 'uploads/tour and travels PHP final documentation (checked).pdf', '2025-06-13 05:01:40', 'pending'),
(12, 'Sohirya Manna', '784767979631', '5346534135', 'SOWQD2133K', 'Rice', 'Kharif', 0.40, '0', 'uploads/Resume Trideep (18.09.2023).pdf', '2025-06-15 03:27:59', 'pending'),
(13, 'Sohirya Manna', '784767979631', '5346534135', 'SOWQD2133K', 'Maize', 'Rabi', 0.50, '0', 'uploads/Internship Task for Python Development .pdf', '2025-06-15 04:08:45', 'pending'),
(14, 'Sohirya Manna', '784767979631', '5346534135', 'SOWQD2133K', 'Mustard', 'Zaid', 1.20, '0', 'uploads/Resume Trideep (18.09.2023).pdf', '2025-06-15 04:16:06', 'pending'),
(15, 'Sohirya Manna', '784767979631', '5346534135', 'SOWQD2133K', 'Maize', 'Kharif', 0.40, '0', 'uploads/BCA 6 SEM Syllabus.pdf', '2025-06-15 04:19:38', 'pending'),
(16, 'Sohirya Manna', '784767979631', '5346534135', 'SOWQD2133K', 'Wheat', 'Zaid', 0.50, '0', 'uploads/BCA 6 SEM Syllabus.pdf', '2025-06-15 04:22:06', 'pending'),
(17, 'Sohirya Manna', '784767979631', '5346534135', 'SOWQD2133K', 'Maize', 'Rabi', 0.50, '0', 'uploads/ShreejaniManna_Resume.pdf', '2025-06-15 04:25:12', 'pending'),
(18, 'Sohirya Manna', '784767979631', '5346534135', 'SOWQD2133K', 'Maize', 'Kharif', 0.50, '0', 'uploads/ShreejaniManna_Resume.pdf', '2025-06-15 05:57:27', 'pending'),
(19, 'Sohirya Manna', '784767979631', '5346534135', 'SOWQD2133K', 'Potato', 'Kharif', 0.60, '0', 'uploads/ShreejaniManna_Resume.pdf', '2025-06-15 13:49:37', 'pending'),
(20, 'putu mannna', '541653453515', '5612329641', 'AEMQD2133K', 'Rice', 'Kharif', 0.40, '0', 'uploads/ShreejaniManna_Resume.pdf', '2025-06-15 14:31:02', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `disaster_subsidy_applications`
--

CREATE TABLE `disaster_subsidy_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `aadhaar_no` char(12) NOT NULL,
  `phone_no` char(10) NOT NULL,
  `pan_no` char(10) NOT NULL,
  `block_name` varchar(50) NOT NULL,
  `disaster_date` date NOT NULL,
  `disaster_type` varchar(20) NOT NULL,
  `damage_details` text NOT NULL,
  `estimated_loss` decimal(12,2) NOT NULL,
  `proof_path` varchar(255) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `ifsc_code` char(11) NOT NULL,
  `branch_location` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disaster_subsidy_applications`
--

INSERT INTO `disaster_subsidy_applications` (`id`, `user_id`, `name`, `aadhaar_no`, `phone_no`, `pan_no`, `block_name`, `disaster_date`, `disaster_type`, `damage_details`, `estimated_loss`, `proof_path`, `account_no`, `ifsc_code`, `branch_location`, `created_at`, `status`) VALUES
(1, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Purbasthali-I', '2025-05-23', 'Flood', 'cyclone', 34555.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 08:01:43', 'approved'),
(2, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Purbasthali-I', '2025-05-23', 'Flood', 'cyclone', 34555.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 08:02:13', 'rejected'),
(3, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Aushgram-II', '2025-05-21', 'Flood', 'flood', 5600.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 08:04:53', 'approved'),
(4, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Aushgram-II', '2025-05-21', 'Flood', 'flood', 5600.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 08:11:13', 'approved'),
(5, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Aushgram-II', '2025-05-21', 'Flood', 'flood', 5600.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 08:11:18', 'approved'),
(6, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Kalna-II', '2025-05-30', 'Drought', 'drought', 7855.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 08:12:02', 'approved'),
(7, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Kalna-II', '2025-05-30', 'Drought', 'drought', 7855.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 08:13:46', 'approved'),
(8, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Kalna-II', '2025-05-30', 'Drought', 'drought', 7855.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 08:13:48', 'approved'),
(9, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Burdwan-II', '2025-05-31', 'Flood', 'flood', 7900.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 09:42:39', 'approved'),
(10, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Purbasthali-I', '2025-05-01', 'Drought', 'Drought', 5000.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 09:50:03', 'approved'),
(11, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Purbasthali-I', '2025-05-01', 'Drought', 'Drought', 5000.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 09:55:12', 'approved'),
(12, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Purbasthali-I', '2025-05-01', 'Drought', 'Drought', 5000.00, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-05-23 09:55:52', 'approved'),
(13, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Aushgram-II', '2025-05-25', 'Cyclone', 'Cyclone', 10001.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH BRANCH, DIST.BARDDHAMAN, WEST BENGAL', '2025-05-25 18:20:34', 'approved'),
(14, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Aushgram-II', '2025-05-26', 'Flood', 'Flood', 5100.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH BRANCH, DIST.BARDDHAMAN, WEST BENGAL', '2025-05-25 18:31:21', 'approved'),
(15, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Purbasthali-II', '2025-06-02', 'Drought', 'Drought', 9800.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH BRANCH, DIST.BARDDHAMAN, WEST BENGAL', '2025-06-02 05:44:32', 'approved'),
(16, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Aushgram-II', '2025-06-02', 'Cyclone', 'cyclone', 3400.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH BRANCH, DIST.BARDDHAMAN, WEST BENGAL', '2025-06-02 10:24:31', 'approved'),
(17, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Aushgram-II', '2025-06-02', 'Cyclone', 'vzsdv', 9600.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH BRANCH, DIST.BARDDHAMAN, WEST BENGAL', '2025-06-02 10:32:12', 'approved'),
(18, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Purbasthali-II', '2025-06-12', 'Drought', 'Severe drought', 8400.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH BRANCH, DIST.BARDDHAMAN, WEST BENGAL', '2025-06-05 07:39:46', 'approved'),
(19, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Purbasthali-I', '2025-06-05', 'Flood', 'flood', 8900.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', '2025-06-05 07:49:01', 'approved'),
(20, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Aushgram-II', '2025-06-05', 'Flood', 'vvx', 6789.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', '2025-06-05 08:11:36', 'approved'),
(21, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Aushgram-II', '2025-06-05', 'Cyclone', 'A cyclone damage claim description should detail the extent and nature of damage caused by a cyclone, including specific items impacted and the severity of their damage.', 7501.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', '2025-06-05 09:00:53', 'rejected'),
(22, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Kalna-I', '2025-06-05', 'Flood', 'wtwet', 9088.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', '2025-06-05 10:35:59', 'approved'),
(23, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'Aushgram-II', '2025-06-09', 'Cyclone', 'amphan', 60000.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', '2025-06-09 06:27:34', 'approved'),
(24, 9, 'Oindrila Batabyal', '985450008000', '9876543210', 'BHTDR9540K', 'Katwa-II', '2025-05-14', 'Hailstorm', 'gulhlkj', 10000.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', '2025-06-09 06:39:38', 'approved'),
(25, 12, 'Haswati', '146854547986', '9433652480', 'BHTDR9540H', 'Aushgram-I', '2025-06-02', 'Flood', 'rice damage', 5486.00, '0', '52645316555155', 'UCBA0001602', 'konnagar', '2025-06-09 07:01:33', 'approved'),
(26, 14, 'Sohirya Manna', '784767979631', '5346534135', 'SOWQD2133K', 'Bhatar', '2025-06-17', 'Hailstorm', 'gcgvb bjhhvcgbv', 9999999999.99, '0', '987654321098765432', 'BARB0PANAGA', 'PANAGARH', '2025-06-15 06:12:29', 'approved'),
(27, 15, 'putu mannna', '541653453515', '5612329641', 'AEMQD2133K', 'Block A', '2025-07-03', 'chfcb', 'tdgbnmsx', 45654135.00, '0', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', '2025-06-15 15:24:58', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_id_applications`
--

CREATE TABLE `farmer_id_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `aadhaar` varchar(12) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `pan` varchar(10) DEFAULT NULL,
  `land_proof` varchar(255) DEFAULT NULL,
  `authority_approval` varchar(255) DEFAULT NULL,
  `applied_at` datetime DEFAULT NULL,
  `farmer_id` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_id_applications`
--

INSERT INTO `farmer_id_applications` (`id`, `user_id`, `name`, `aadhaar`, `phone`, `pan`, `land_proof`, `authority_approval`, `applied_at`, `farmer_id`, `status`) VALUES
(2, 1, 'Amit Ray', '987654321012', '7602361407', 'ABCDE1234F', 'uploads/farmer_id/6832e3f7df539_1748165623.pdf', 'approved', '2025-05-25 15:03:43', 'FRM000002', 'approved'),
(3, 8, 'Uma Agarwal', '548550008000', '9874563210', 'BITFG3568D', 'uploads/farmer_id/68466eb5d6bdb_1749446325.pdf', 'approved', '2025-06-09 10:48:45', 'FRM000003', 'approved'),
(4, 9, 'Oindrila Batabyal', '985450008000', '9876543210', 'BHTDR9540K', 'uploads/farmer_id/68467fa0821da_1749450656.pdf', 'approved', '2025-06-09 12:00:56', 'FRM000004', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `father` varchar(100) NOT NULL,
  `mother` varchar(100) NOT NULL,
  `adhaar` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `state` varchar(100) NOT NULL,
  `account` varchar(30) NOT NULL,
  `ifsc` varchar(15) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `village` varchar(100) DEFAULT NULL,
  `field` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL CHECK (`amount` <= 50000),
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `release_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `user_id`, `name`, `father`, `mother`, `adhaar`, `address`, `pincode`, `state`, `account`, `ifsc`, `branch`, `village`, `field`, `amount`, `status`, `created_at`, `release_date`) VALUES
(1, 1, 'Amit Ray', ' S Ray', 'm Ray', '986574521369', 'dsdfascfas', '713147', 'West Bengal', '986532', 'BARB0PANAGA', 'PANAGARH', 'ad', 'd', 7000.00, 1, '2025-05-22 11:27:26', NULL),
(2, 1, 'Amit Ray', ' S Ray', 'm Ray', '987654321012', 'hfh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'ad', '.305', 8960.00, 2, '2025-05-23 09:57:48', '2025-05-25'),
(3, 7, 'Utpaul', 'Ram Paul', 'Chanda Paul', '987456145872', 'Konnagar', '987450', 'West Bengal', '7410236578963', 'BARB0PANAGA', 'KONNAGARH', 'Konnagar', '0.36', 15000.00, 1, '2025-05-25 10:24:27', NULL),
(4, 6, 'Arup Mitra', 'GOPAL', 'MALATI', '123456789016', 'BANDEL', '123456', 'West Bengal', '789654123012', 'BARB0PANAGA', 'BANDEL', 'BANDEL', '0.36', 10000.00, 1, '2025-05-25 11:23:24', '2025-05-25'),
(5, 6, 'Arup Mitra', 'Ram Paul', 'Chanda Paul', '123456789016', 'jol', '987450', 'West Bengal', '789654124578', 'BARB0PANAGA', 'KONNAGARH', 'jol', '.36', 8500.00, 1, '2025-05-25 11:31:46', '2025-05-25'),
(6, 1, 'Amit Ray', ' S Ray', 'm Ray', '987654321012', 'hfh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'ad', '.305', 8970.00, 1, '2025-05-25 13:24:27', '2025-05-25'),
(7, 1, 'Amit Ray', ' S Ray', 'm Ray', '987654321012', 'hfh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'ad', '.305', 8970.00, 1, '2025-05-25 13:25:38', '2025-05-25'),
(8, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.305', 5000.00, 2, '2025-05-25 18:06:17', '2025-05-25'),
(9, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.305', 4000.00, 1, '2025-05-25 18:08:53', '2025-05-25'),
(10, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.305', 4001.00, 2, '2025-05-25 18:09:28', '2025-05-25'),
(11, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.305', 4005.00, 1, '2025-05-25 18:13:51', '2025-05-25'),
(12, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.305', 5001.00, 1, '2025-05-31 04:56:35', '2025-05-31'),
(13, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.305', 15001.00, 1, '2025-06-02 05:12:58', '2025-06-04'),
(14, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.305', 8001.00, 1, '2025-06-05 06:06:02', '2025-06-05'),
(15, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.305', 8001.00, 2, '2025-06-05 06:19:23', '2025-06-05'),
(16, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.305', 8001.00, 1, '2025-06-05 07:49:20', '2025-06-05'),
(17, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.305', 8001.00, 2, '2025-06-05 08:21:04', '2025-06-05'),
(18, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.305', 8501.00, 1, '2025-06-05 08:59:21', '2025-06-09'),
(19, 1, 'Amit Ray', 'S Ray', 'M Ray', '987654321012', 'Panagarh', '713147', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'Panagarh', '.025', 50000.00, 1, '2025-06-09 06:18:04', '2025-06-09'),
(20, 9, 'Oindrila Batabyal', 'nkjlj', 'gfhfh', '985450008000', 'gfsihflshf lihfifs', '142252', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'hgdljfjds;', '.025', 20000.00, 2, '2025-06-09 06:35:17', '2025-06-09'),
(21, 14, 'Sohirya Manna', 'jgfdxcvbhmjhgcv', 'ucgvhjkhjghgfdzsxfghj', '784767979631', 'zdvbnbgjgtrgxrfgh', '456123', 'West Bengal', '4654563312986413165', 'BARB0PANAGA', 'PANAGARH', 'jgfdzfxcvnbmn', '1.222', 41323.00, 1, '2025-06-15 06:08:15', '2025-06-15'),
(22, 15, 'putu mannna', 'fdcsdca', 'sddsdcefdv', '541653453515', 'fdgdvdd', '456123', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'vdfedverdf', '.222', 4654.00, 2, '2025-06-15 14:15:21', '2025-06-15'),
(23, 15, 'putu mannna', 'fdcsdca', 'sddsdcefdv', '541653453515', 'fdgdvdd', '456128', 'West Bengal', '987654321098765434', 'BARB0PANAGA', 'PANAGARH', 'vdfedverdf', '.222', 4654.00, 0, '2025-06-15 14:45:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `aadhaar_no` varchar(12) NOT NULL,
  `pan_no` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `phone_no`, `aadhaar_no`, `pan_no`, `created_at`) VALUES
(1, 'Amit Ray', '$2y$10$1YnR48cJX9omV.MFodsvUO0jz1ri3aQ.aE/6GxDKalN5q3m.XefHG', 'amit.ray455@gmail.com', '7602361407', '987654321012', 'ABCDE1234F', '2025-05-22 05:53:43'),
(4, 'Amit Ray', '$2y$10$WgjdeRFmVZYYBwcxUilg.uvFeCV1rpUeseAvk4/quIA24BGdDbcVq', 'examcell.bstm@gmail.com', '7602361407', '123456789012', 'bitpr3460f', '2025-05-22 06:00:46'),
(5, 'Arup Mitra', '$2y$10$IebJnjWXJdGTbkGZlyqCH.aDCciq6t5yB6hdBsWeNdJRbCc0RtT4e', 'amitra.base@gmail.com', '7602361409', '523456789012', 'XYZ3590J80', '2025-05-22 06:04:21'),
(6, 'Arup Mitra', '$2y$10$IG8mJpBVQ.HVc5l2Pie2s..msOg65MPp3SlVYnHn.u/6oEySJUxAe', 'amitrabase@gmail.com', '9865121478', '123456789016', 'bitpr3460x', '2025-05-22 06:07:37'),
(7, 'Utpaul', '$2y$10$PWCN4OqcgrjVJPLgfou/nuZKV1PchCITlHfaSw4nK3oXquYwXU7xe', 'utpalu@gmail.com', '9865741240', '987456145872', 'AZXOU7894P', '2025-05-25 10:22:12'),
(8, 'Uma Agarwal', '$2y$10$wQL.QK6R4pnNtL.tNhHjduI2LuMuAhdbnlGASKO.dRSWcg03eJN8C', 'umaagarwal@gmail.com', '9874563210', '548550008000', 'BITFG3568D', '2025-06-09 05:17:35'),
(9, 'Oindrila Batabyal', '$2y$10$xSyHKQ5FtWQeVq/O0vGOzO.jnuDv74VT5fzokYXE1.N60o5vwZX1y', 'oindrila@gmail.com', '9876543210', '985450008000', 'BHTDR9540K', '2025-06-09 06:08:06'),
(10, 'shreejani manna', '$2y$10$jfx8x09Kbp.YsRDZc32Yfurp8KCrKOr9BQUFEUTLIHB/23UQj9Yi.', 'shree@gmail.com', '6545616145', '564656165456', 'BHTDR9540P', '2025-06-09 06:12:50'),
(12, 'Haswati', '$2y$10$gTkeHAmkZDwj2uGsJRc0neAsaoQtT7KXXYX63lcLj3TZ4jLJcWumu', 'haswati@gmail.com', '9433652480', '146854547986', 'BHTDR9540H', '2025-06-09 06:51:09'),
(13, 'anua manna', '$2y$10$H8PGthT45gXLkaU18N1vmeAnK9KH0lJr1gHNgWf6yUouwUVIYexDi', 'anua@gmail.com', '2435876543', '980765432117', 'ALWQD2133K', '2025-06-13 04:58:31'),
(14, 'Sohirya Manna', '$2y$10$dC7p.nJGAW4eehnE/J9yq.tlzIktFOHQRoWDGhrbvItSD6BmiTr66', 'so@gmail.com', '5346534135', '784767979631', 'SOWQD2133K', '2025-06-15 03:10:04'),
(15, 'putu mannna', '$2y$10$6b5ll6mg5vPfjwh0yb6PNe3b2mEKQOzPGwVjj4yX7BEWokDMkYaDa', 'pu@gmail.com', '5612329641', '541653453515', 'AEMQD2133K', '2025-06-15 14:04:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `crop_insurance`
--
ALTER TABLE `crop_insurance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disaster_subsidy_applications`
--
ALTER TABLE `disaster_subsidy_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `farmer_id_applications`
--
ALTER TABLE `farmer_id_applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `farmer_id` (`farmer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `aadhaar_no` (`aadhaar_no`),
  ADD UNIQUE KEY `pan_no` (`pan_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crop_insurance`
--
ALTER TABLE `crop_insurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `disaster_subsidy_applications`
--
ALTER TABLE `disaster_subsidy_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `farmer_id_applications`
--
ALTER TABLE `farmer_id_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disaster_subsidy_applications`
--
ALTER TABLE `disaster_subsidy_applications`
  ADD CONSTRAINT `disaster_subsidy_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `farmer_id_applications`
--
ALTER TABLE `farmer_id_applications`
  ADD CONSTRAINT `farmer_id_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
