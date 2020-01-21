-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 21, 2020 at 06:43 PM
-- Server version: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.3.8-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lash_appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `lat`, `lng`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '23.1212', '36.48454', 'lorem ipsum', '2020-01-15 10:39:45', '2020-01-15 05:10:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_type` enum('0','1') NOT NULL DEFAULT '0' COMMENT ' 0 Gust User , 1 Register user',
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `appointment_by` enum('user','admin') NOT NULL,
  `appointment_date` date NOT NULL,
  `repeat_type` enum('0','1','2','3') DEFAULT '0' COMMENT '1 Daily . 2 Weekly , 3  Monthly',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cancel_user_id` int(11) DEFAULT NULL,
  `cancel_reason` text,
  `appointment_status` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT ' 0 For Pending , 1 Completed , 2 Cancel ',
  `time_slot` varchar(255) NOT NULL,
  `total_cost` decimal(8,2) DEFAULT NULL,
  `paid_amount` decimal(8,2) DEFAULT NULL,
  `payment_type` enum('1','2') NOT NULL COMMENT '1 Fully , 2 Partially',
  `payment_mode` enum('paypal','card','cod') NOT NULL COMMENT '0 cod, 1 paypal, 2 card ',
  `payment_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 due, 1 completed',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_type`, `user_id`, `appointment_by`, `appointment_date`, `repeat_type`, `name`, `email`, `phone`, `address`, `cancel_user_id`, `cancel_reason`, `appointment_status`, `time_slot`, `total_cost`, `paid_amount`, `payment_type`, `payment_mode`, `payment_status`, `created_at`, `deleted_at`, `updated_at`) VALUES
(34, '1', 8, 'user', '2020-01-22', '0', 'test', 'test@gmail.com', '1236547890', 'Lorem ipsum', NULL, NULL, '0', '10:30 AM', '220.00', '20.00', '2', 'paypal', '0', '2020-01-21 18:17:27', NULL, NULL),
(35, '1', 8, 'user', '2020-01-21', '0', 'test', 'test@gmail.com', '1236547890', 'Lorem ipsum', NULL, NULL, '0', '12:00 PM', '100.00', '20.00', '2', 'paypal', '0', '2020-01-21 18:21:09', NULL, NULL),
(36, '1', 8, 'user', '2020-01-23', '0', 'test', 'test@gmail.com', '1236547890', 'Lorem ipsum', NULL, NULL, '0', '12:00 PM', '100.00', '20.00', '2', 'paypal', '0', '2020-01-21 18:24:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_notes`
--

CREATE TABLE `appointment_notes` (
  `appointment_id` int(11) UNSIGNED NOT NULL,
  `appointment_note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_partial_payment`
--

CREATE TABLE `appointment_partial_payment` (
  `appointment_id` int(11) UNSIGNED NOT NULL,
  `partial_amount` decimal(8,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment_partial_payment`
--

INSERT INTO `appointment_partial_payment` (`appointment_id`, `partial_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(34, '20.00', '2020-01-21 18:17:27', NULL, NULL),
(35, '20.00', '2020-01-21 18:21:09', NULL, NULL),
(36, '20.00', '2020-01-21 18:24:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_services`
--

CREATE TABLE `appointment_services` (
  `appointment_id` int(11) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_price` decimal(8,2) NOT NULL,
  `service_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment_services`
--

INSERT INTO `appointment_services` (`appointment_id`, `service_id`, `service_price`, `service_name`) VALUES
(34, 2, '100.00', 'Service 1'),
(34, 4, '120.00', 'Service 3'),
(35, 2, '100.00', 'Service 1'),
(36, 2, '100.00', 'Service 1');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_times`
--

CREATE TABLE `appointment_times` (
  `appointment_id` int(11) NOT NULL,
  `time_slot` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `heading_text` varchar(255) NOT NULL,
  `sub_heading_text` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_image`, `heading_text`, `sub_heading_text`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'tAGjx2lMhJ.1578995893.png', 'Lorem Ipsum', 'Lorem Ipsum Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum', '1', '2020-01-14 14:47:54', '2020-01-14 09:58:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_week_days`
--

CREATE TABLE `business_week_days` (
  `id` int(11) NOT NULL,
  `day_name` varchar(255) NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `slot_duration` int(11) DEFAULT NULL,
  `is_open` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_week_days`
--

INSERT INTO `business_week_days` (`id`, `day_name`, `open_time`, `close_time`, `slot_duration`, `is_open`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Monday', '08:00:00', '14:00:00', NULL, '1', '2019-12-07 00:00:00', '2020-01-10 04:50:02', NULL),
(2, 'Tuesday', '08:00:00', '14:00:00', NULL, '1', '2019-12-07 00:00:00', '2020-01-10 04:50:02', NULL),
(3, 'Wednesday', '08:00:00', '14:00:00', NULL, '1', '2019-12-07 00:00:00', '2020-01-10 04:50:02', NULL),
(4, 'Thursday', '08:00:00', '14:00:00', NULL, '1', '2019-12-07 00:00:00', '2020-01-10 04:50:02', NULL),
(5, 'Friday', '08:00:00', '14:00:00', NULL, '1', '2019-12-07 00:00:00', '2020-01-10 04:50:03', NULL),
(6, 'Saturday', '08:00:00', '14:00:00', NULL, '1', '2019-12-07 00:00:00', '2020-01-10 04:50:03', NULL),
(7, 'Sunday', '09:00:00', '14:00:00', NULL, '1', '2019-12-07 00:00:00', '2020-01-10 04:50:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `meta_data` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `item_type` enum('Product','Service','Class') NOT NULL,
  `item_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `class_description` text NOT NULL,
  `class_cost` float(8,2) NOT NULL,
  `allotted_seats` int(11) NOT NULL,
  `class_start_date` date NOT NULL,
  `class_end_date` date NOT NULL,
  `class_start_time` time NOT NULL,
  `class_end_time` time NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `class_description`, `class_cost`, `allotted_seats`, `class_start_date`, `class_end_date`, `class_start_time`, `class_end_time`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Class 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 100.00, 15, '2020-01-01', '2020-01-25', '17:00:00', '19:00:00', '1', '2020-01-07 08:51:10', '2020-01-13 17:23:51', NULL),
(11, 'Class 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 120.00, 15, '2019-01-01', '2019-01-01', '17:00:00', '19:00:00', '1', '2020-01-07 08:51:20', '2020-01-07 08:51:20', NULL),
(12, 'Class 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 130.00, 15, '2019-01-01', '2019-01-01', '17:00:00', '19:00:00', '1', '2020-01-07 08:51:26', '2020-01-07 08:51:26', NULL),
(13, 'Class 4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 140.00, 15, '2019-01-01', '2019-01-01', '17:00:00', '19:00:00', '1', '2020-01-07 08:51:31', '2020-01-07 08:51:31', NULL),
(14, 'Class 5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 150.00, 15, '2019-01-01', '2019-01-01', '17:00:00', '19:00:00', '1', '2020-01-07 08:51:37', '2020-01-07 08:51:37', NULL),
(15, 'Class 6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 160.00, 15, '2019-01-01', '2019-01-01', '17:00:00', '19:00:00', '1', '2020-01-07 08:51:42', '2020-01-07 08:51:42', NULL),
(16, 'Class 7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 170.00, 15, '2019-01-01', '2019-01-01', '17:00:00', '19:00:00', '1', '2020-01-07 08:51:47', '2020-01-07 08:51:47', NULL),
(17, 'Class 8', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 180.00, 15, '2019-01-01', '2019-01-01', '17:00:00', '19:00:00', '1', '2020-01-07 08:51:52', '2020-01-07 08:51:52', NULL),
(18, 'Class 9', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 190.00, 15, '2019-01-01', '2019-01-01', '17:00:00', '19:00:00', '1', '2020-01-07 08:51:57', '2020-01-07 08:51:57', NULL),
(19, 'Class 10', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 200.00, 15, '2019-01-01', '2019-01-01', '17:00:00', '19:00:00', '1', '2020-01-07 08:52:05', '2020-01-07 08:52:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_booking`
--

CREATE TABLE `class_booking` (
  `id` int(11) NOT NULL,
  `user_type` enum('0','1') NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `payment_type` enum('1','2') NOT NULL,
  `payment_mode` varchar(10) NOT NULL,
  `payment_status` enum('0','1') NOT NULL,
  `total_cost` decimal(8,2) DEFAULT NULL,
  `paid_amount` decimal(8,2) DEFAULT NULL,
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `booking_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_booking`
--

INSERT INTO `class_booking` (`id`, `user_type`, `user_id`, `name`, `email`, `phone`, `address`, `payment_type`, `payment_mode`, `payment_status`, `total_cost`, `paid_amount`, `class_id`, `class_name`, `created_at`, `updated_at`, `deleted_at`, `booking_status`) VALUES
(30, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, '2', 'cod', '0', '130.00', NULL, 12, 'Class 3', '2020-01-21 17:10:20', NULL, NULL, '0'),
(31, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, '2', 'paypal', '0', '150.00', '12.00', 14, 'Class 5', '2020-01-21 17:13:47', NULL, NULL, '0'),
(32, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, '2', 'paypal', '0', '150.00', '12.00', 14, 'Class 5', '2020-01-21 17:18:17', NULL, NULL, '0'),
(33, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, '2', 'paypal', '0', '150.00', '12.00', 14, 'Class 5', '2020-01-21 17:19:22', NULL, NULL, '0'),
(34, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, '2', 'paypal', '0', '150.00', '12.00', 14, 'Class 5', '2020-01-21 17:30:39', NULL, NULL, '0'),
(35, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, '2', 'paypal', '0', '150.00', '12.00', 14, 'Class 5', '2020-01-21 17:31:52', NULL, NULL, '0'),
(36, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, '2', 'card', '0', '200.00', '150.00', 19, 'Class 10', '2020-01-21 17:39:21', NULL, NULL, '0'),
(37, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, '2', 'card', '0', '200.00', '150.00', 19, 'Class 10', '2020-01-21 17:40:03', NULL, NULL, '0'),
(38, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, '2', 'paypal', '0', '150.00', '12.00', 14, 'Class 5', '2020-01-21 17:59:39', NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `class_booking_partial_payment`
--

CREATE TABLE `class_booking_partial_payment` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `partial_amount` decimal(8,2) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_booking_partial_payment`
--

INSERT INTO `class_booking_partial_payment` (`id`, `booking_id`, `partial_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 1, '12.00', '2020-01-21 17:13:47', NULL, NULL),
(14, 1, '12.00', '2020-01-21 17:18:17', NULL, NULL),
(15, 1, '12.00', '2020-01-21 17:19:22', NULL, NULL),
(16, 1, '12.00', '2020-01-21 17:30:39', NULL, NULL),
(17, 1, '12.00', '2020-01-21 17:31:52', NULL, NULL),
(18, 1, '150.00', '2020-01-21 17:39:21', NULL, NULL),
(19, 1, '150.00', '2020-01-21 17:40:03', NULL, NULL),
(20, 1, '12.00', '2020-01-21 17:59:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `key`, `value`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'week_start_day', '2', '1', '2019-12-07 16:32:26', '2020-01-17 15:38:00', NULL),
(2, 'slot_duration', '30', '1', '2020-01-08 11:32:55', '2020-01-10 12:30:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_type` enum('0','1') NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `payment_mode` enum('paypal','card','cod') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `total_cost` double(8,2) NOT NULL,
  `payment_status` enum('0','1','2') NOT NULL DEFAULT '0',
  `order_status` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_type`, `user_id`, `name`, `email`, `phone`, `address`, `payment_mode`, `created_at`, `updated_at`, `product_id`, `product_name`, `total_cost`, `payment_status`, `order_status`, `deleted_at`) VALUES
(20, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, 'paypal', '2020-01-21 15:16:38', NULL, 1, 'Product 11', 10.00, '1', '0', NULL),
(21, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, 'card', '2020-01-21 15:19:13', NULL, 1, 'Product 11', 10.00, '1', '0', NULL),
(22, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, 'cod', '2020-01-21 15:20:37', NULL, 1, 'Product 11', 10.00, '0', '0', NULL),
(23, '1', 8, 'test8', 'test8@gmail.com', '8888888888', NULL, 'cod', '2020-01-21 15:30:26', NULL, 1, 'Product 11', 10.00, '0', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partial_payments`
--

CREATE TABLE `partial_payments` (
  `payment_for` enum('class','service') NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `payment_for_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_cost` float(8,2) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(100) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_cost`, `product_description`, `product_image`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Product 11', 10.00, 'product description', 'DiIpYiA1Eh.1578658749.jpeg', '1', '2019-12-16 12:05:23', '2020-01-10 12:19:09', NULL),
(2, 'Product 2', 20.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', '9vGFW3ptiO.1578387192.jpg', '1', '2020-01-07 08:53:12', '2020-01-07 14:23:28', NULL),
(3, 'Product 3', 20.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 'U2THQL16nG.1578387237.jpg', '1', '2020-01-07 08:53:57', '2020-01-07 08:53:57', NULL),
(4, 'Product 4', 20.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 'RYMHrkd5BP.1578387244.jpg', '1', '2020-01-07 08:54:04', '2020-01-07 08:54:04', NULL),
(5, 'Product 5', 20.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', '9d74IU5VIW.1578387253.jpg', '1', '2020-01-07 08:54:13', '2020-01-07 08:54:13', NULL),
(6, 'Product 6', 20.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 'tDmbzcLCJB.1578387263.jpg', '1', '2020-01-07 08:54:23', '2020-01-07 08:54:23', NULL),
(7, 'Product 7', 20.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 'XLO3dtYcFz.1578387268.jpg', '1', '2020-01-07 08:54:28', '2020-01-07 08:54:28', NULL),
(8, 'Product 8', 20.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 'qe6NfqsNGh.1578387271.jpg', '1', '2020-01-07 08:54:31', '2020-01-07 08:54:31', NULL),
(9, 'Product 9', 20.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 'w8H2CPxpqg.1578387274.jpg', '1', '2020-01-07 08:54:34', '2020-01-07 08:54:34', NULL),
(10, 'Product 10', 20.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', 'kJn63sQAB5.1578387279.jpg', '1', '2020-01-07 08:54:39', '2020-01-07 08:54:39', NULL),
(11, 'Product 1', 10.00, 'product description', 'nX9Kj6nxCn.1579602103.png', '1', '2020-01-21 10:21:43', '2020-01-21 10:21:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_ratings`
--

CREATE TABLE `review_ratings` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_ratings`
--

INSERT INTO `review_ratings` (`id`, `appointment_id`, `user_id`, `review`, `rating`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 7, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 3, '2020-01-16 18:49:58', '2020-01-20 17:49:09', '2020-01-17 11:16:02', '2'),
(2, 8, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 2, '2020-01-16 18:49:58', '2020-01-20 17:49:11', NULL, '0'),
(3, 9, 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 5, '2020-01-16 18:49:58', '2020-01-20 17:49:13', NULL, '0'),
(4, 10, 6, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 1, '2020-01-16 18:49:58', '2020-01-20 17:49:16', NULL, '0'),
(5, 11, 7, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 5, '2020-01-16 18:49:58', '2020-01-20 17:49:18', NULL, '0'),
(6, NULL, 8, 'sfdsfsdf', 2, '2020-01-21 11:31:42', NULL, NULL, '0'),
(7, NULL, 8, 'fdsfsf', 2, '2020-01-21 11:39:34', NULL, NULL, '0'),
(8, NULL, 8, 'fsdfsf', 2, '2020-01-21 11:40:25', NULL, NULL, '0'),
(9, 31, 8, 'FSFDSF sfdsf', 2, '2020-01-21 11:41:49', '2020-01-21 12:03:05', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_cost` float(8,2) NOT NULL,
  `service_image` varchar(255) NOT NULL,
  `service_description` text NOT NULL,
  `service_color` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `service_cost`, `service_image`, `service_description`, `service_color`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Service 1', 100.00, 'w6dftrvfAX.1578381755.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', '#ffffff', '1', '2020-01-07 07:22:35', '2020-01-07 07:22:35', NULL),
(3, 'test 1', 100.00, 'q4iqV0eCbz.1578381767.jpg', 'Lorem ipsum', '#ffffff', '1', '2020-01-07 07:22:47', '2020-01-07 10:08:20', NULL),
(4, 'Service 3', 120.00, 'iTmxNDj9sj.1578381780.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', '#ffffff', '1', '2020-01-07 07:23:00', '2020-01-07 07:23:00', NULL),
(5, 'Service 4', 130.00, 'l9Us0ifgzt.1578381787.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', '#ffffff', '1', '2020-01-07 07:23:07', '2020-01-07 07:23:07', NULL),
(6, 'Service 5', 140.00, 'qajCr7pr2L.1578381792.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', '#ffffff', '1', '2020-01-07 07:23:12', '2020-01-07 07:23:12', NULL),
(7, 'Service 6', 150.00, 'XpksfwxUN5.1578381798.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', '#ffffff', '1', '2020-01-07 07:23:18', '2020-01-07 07:23:18', NULL),
(8, 'Service 7', 160.00, 'Pll07y72rk.1578381803.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', '#ffffff', '1', '2020-01-07 07:23:23', '2020-01-07 07:23:23', NULL),
(9, 'Service 8', 180.00, 'aTcK4k23jF.1578381809.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', '#ffffff', '1', '2020-01-07 07:23:29', '2020-01-07 07:23:29', NULL),
(10, 'Service 9', 190.00, 'vDfgnWlrvI.1578381815.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', '#ffffff', '1', '2020-01-07 07:23:35', '2020-01-07 07:23:35', NULL),
(11, 'Service 10', 210.00, 'MJgfGqpA7H.1578381828.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the', '#ffffff', '1', '2020-01-07 07:23:48', '2020-01-07 07:23:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `time_slot_blockers`
--

CREATE TABLE `time_slot_blockers` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_slot` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_slot_blockers`
--

INSERT INTO `time_slot_blockers` (`id`, `date`, `time_slot`, `note`) VALUES
(9, '2019-01-14', '08:00 AM', 'Hello'),
(10, '2019-01-14', '09:00 PM', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_mode` enum('paypal','card') NOT NULL,
  `transaction_for` enum('product','appointment','class','') NOT NULL,
  `card_type` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `transaction_status` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `item_id`, `transaction_id`, `user_id`, `payment_mode`, `transaction_for`, `card_type`, `currency`, `amount`, `transaction_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 20, 'VJ5M9Z9YDAAT4', 8, 'paypal', 'product', NULL, 'USD', '10.00', '1', '2020-01-21 15:16:38', '2020-01-21 15:16:38', NULL),
(14, 21, '9zwmkdqy', 8, 'card', 'product', 'Visa', 'SAR', '10.00', '1', '2020-01-21 15:19:13', '2020-01-21 15:19:13', NULL),
(31, 1, 'VJ5M9Z9YDAAT4', 8, 'paypal', 'class', NULL, 'USD', '100.00', '1', '2020-01-21 17:13:47', '2020-01-21 17:13:47', NULL),
(32, 1, 'VJ5M9Z9YDAAT4', 8, 'paypal', 'class', NULL, 'USD', '120.00', '1', '2020-01-21 17:18:17', '2020-01-21 17:18:17', NULL),
(33, 1, 'VJ5M9Z9YDAAT4', 8, 'paypal', 'class', NULL, 'USD', '150.00', '1', '2020-01-21 17:19:22', '2020-01-21 17:19:22', NULL),
(34, 1, 'VJ5M9Z9YDAAT4', 8, 'paypal', 'class', NULL, 'USD', '130.00', '1', '2020-01-21 17:30:39', '2020-01-21 17:30:39', NULL),
(35, 1, 'VJ5M9Z9YDAAT4', 8, 'paypal', 'class', NULL, 'USD', '150.00', '1', '2020-01-21 17:31:52', '2020-01-21 17:31:52', NULL),
(36, 1, 'c744b8hh', 8, 'card', 'class', 'Visa', 'SAR', '150.00', '1', '2020-01-21 17:39:21', '2020-01-21 17:39:21', NULL),
(37, 1, 'exfk2447', 8, 'card', 'class', 'Visa', 'SAR', '150.00', '1', '2020-01-21 17:40:03', '2020-01-21 17:40:03', NULL),
(38, 1, 'VJ5M9Z9YDAAT4', 8, 'paypal', 'class', NULL, 'USD', '120.00', '1', '2020-01-21 17:59:39', '2020-01-21 17:59:39', NULL),
(39, 34, 'VJ5M9Z9YDAAT4', 8, 'paypal', 'appointment', NULL, 'USD', '340.00', '1', '2020-01-21 18:08:21', '2020-01-21 18:17:27', NULL),
(40, 35, 'VJ5M9Z9YDAAT4', 8, 'paypal', 'appointment', NULL, 'USD', '100.00', '1', '2020-01-21 18:21:09', '2020-01-21 18:21:09', NULL),
(41, 36, 'VJ5M9Z9YDAAT4', 8, 'paypal', 'appointment', NULL, 'USD', '100.00', '1', '2020-01-21 18:24:00', '2020-01-21 18:24:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `gender` enum('0','1','2') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `register_type` enum('0','1','2','') NOT NULL DEFAULT '0',
  `social_id` varchar(250) DEFAULT NULL,
  `device_type` enum('1','2') DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `user_image`, `gender`, `email`, `phone`, `dob`, `password`, `remember_token`, `is_active`, `register_type`, `social_id`, `device_type`, `device_token`, `created_at`, `updated_at`, `deleted_at`, `address`) VALUES
(1, 'admin', 'codemeg', 'admin codemeg', NULL, '1', 'admin@codemeg.com', 'XXXXXXXXXX', NULL, '$2y$10$tVQSiKS3AdH/MeX5WjQV.OtTjpNt1PaoJsQlDus6ypFVD0YljeqqC', NULL, '1', '0', NULL, NULL, NULL, '2019-12-07 17:03:06', '2020-01-03 12:02:56', NULL, NULL),
(3, NULL, NULL, 'test3', NULL, NULL, 'test3@gmail.com', '3333333333', '2010-02-02', '$2y$10$CmuKaS.40EdIiKutgTL3cO22wS6YLcDxdp/80gpGUs05VxgI4ypVu', 'FUK3RBeSuJ0p5XBK1SNFM1EUDKCBGaxTwfzX1XMJald2od71gw5m97uz2SYG', '1', '0', NULL, NULL, NULL, '2020-01-07 06:16:58', '2020-01-15 13:25:30', NULL, NULL),
(4, NULL, NULL, 'test4', NULL, NULL, 'test4@gmail.com', '4444444444', '2010-02-02', '$2y$10$W9kW91l3aB98nUrxWajbPup1nMnklL4ST9miJby8877s7O8/wcHFK', 'nOP2NkSq2ZLYwt4BRRjqjTPsiDgTh66QdFkcW1RASzM9yFdIXDK7sJzpY52M', '1', '0', NULL, NULL, NULL, '2020-01-07 06:52:25', '2020-01-15 11:34:15', NULL, NULL),
(5, NULL, NULL, 'test5', NULL, NULL, 'test5@gmail.com', '5555555555', '2010-02-02', '$2y$10$vT4KZw90YZE3ewojVE1ttOahWSIzE1wrG8LBgHSzWOjBw/9Vv5Izi', 'iTExENyWYv3R92UzEufaB2W2WkJTP8NYRNHqSKqHxMoB1Qya644weunnnBmX', '1', '0', NULL, NULL, NULL, '2020-01-07 06:53:04', '2020-01-15 13:08:50', NULL, NULL),
(6, NULL, NULL, 'test6', NULL, NULL, 'test6@gmail.com', '6666666666', '2010-02-02', '$2y$10$n0dHxV04EmGfibCJ1yIVPe8bO1G6Ya1gv4m2iGaTpbG39XIgf90lu', 'R8s9bJ5BLhpQvO8qJQnu72iFiPSVZ6iFRbVWipS9vcJQfw3hjTsskBa6unrV', '1', '0', NULL, NULL, NULL, '2020-01-07 06:55:01', '2020-01-15 11:34:36', NULL, NULL),
(7, NULL, NULL, 'test7', NULL, NULL, 'test7@gmail.com', '7777777777', '2010-02-02', '$2y$10$ppy.KgFZsDS6Vlpe7W9kh.MEDwq/A.AElj8jF9TIHhuC8AB.Amy4a', 'zwWIZy8vc2kQxSYTMWYyWNFUu4M4PYyN2u2gF1NRRpL5rlAkuCbymPgDV2xH', '1', '0', NULL, NULL, NULL, '2020-01-07 07:03:10', '2020-01-15 11:34:41', NULL, NULL),
(8, NULL, NULL, 'test8', '8QVn6Kd0Vk.1578380754.jpeg', NULL, 'test8@gmail.com', '8888888888', '2010-02-02', '$2y$10$FfzkZ7haMmzHMSpr0Gn6BOlKwlmtUcGrAbVITjfTDLZy9yo8uiQoa', 'UZAoPmdAihtl8rvATBt01yt9OtIaNY9C1HWQpwDGhKNX0NLZnwjQNqXdKsR3', '1', '0', NULL, NULL, NULL, '2020-01-07 07:05:54', '2020-01-15 11:34:47', NULL, NULL),
(9, NULL, NULL, 'test9', '1ujMINzHhF.1578381013.jpeg', NULL, 'test9@gmail.com', '9999999999', '2010-02-02', '$2y$10$GE02hjuT326IKR2ZGpzENuS6Jqy4QBdRGM5do3cwevC8BxtNVJyGy', 'XpUbf00AA6LgMhmAQ1eruN7KifX7AQq3cJZ7mhQoxMMThaRgptFM3vrLBtCx', '1', '0', NULL, NULL, NULL, '2020-01-07 07:10:14', '2020-01-15 11:34:52', NULL, NULL),
(10, NULL, NULL, 'test10', 'QsPTXSBd0C.1578381100.jpeg', NULL, 'test10@gmail.com', '1010101010', '2010-02-02', '$2y$10$wrCrt7YKGJmJjgFZoBcEt.r6akLW3SRX5kofXma5jgoXQfw5PzNZq', '1iL3CA2pVEBczqfWWBY6eS5uQoMf9LqOhRqLGdD8f9q9BbRZEpjE8r7Nh4Kd', '1', '0', NULL, NULL, NULL, '2020-01-07 07:11:40', '2020-01-15 11:35:02', NULL, NULL),
(11, NULL, NULL, 'test 11', 'test-11-McrI4LuYod.1578381191.jpeg', NULL, 'test11@gmail.com', '11111111111', '2010-02-02', '$2y$10$Qg0Lhiin2AZhoLcDqHFeteONHHK/Aqk7sHalmCG1/nVV8vXt4OcI2', 'uOWfjqILjyMmJPr8vgtcJMdly860fWJTFhpOLPgpJZ2somNWfH7t8ME45aqS', '1', '0', NULL, NULL, NULL, '2020-01-07 07:13:12', '2020-01-15 11:35:53', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_ibfk_1` (`user_id`);

--
-- Indexes for table `appointment_notes`
--
ALTER TABLE `appointment_notes`
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `appointment_partial_payment`
--
ALTER TABLE `appointment_partial_payment`
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `appointment_services`
--
ALTER TABLE `appointment_services`
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_week_days`
--
ALTER TABLE `business_week_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_ibfk_1` (`cart_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_booking`
--
ALTER TABLE `class_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_booking_partial_payment`
--
ALTER TABLE `class_booking_partial_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_ratings`
--
ALTER TABLE `review_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slot_blockers`
--
ALTER TABLE `time_slot_blockers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `business_week_days`
--
ALTER TABLE `business_week_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `class_booking`
--
ALTER TABLE `class_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `class_booking_partial_payment`
--
ALTER TABLE `class_booking_partial_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `review_ratings`
--
ALTER TABLE `review_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `time_slot_blockers`
--
ALTER TABLE `time_slot_blockers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `appointment_notes`
--
ALTER TABLE `appointment_notes`
  ADD CONSTRAINT `appointment_notes_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointment_partial_payment`
--
ALTER TABLE `appointment_partial_payment`
  ADD CONSTRAINT `appointment_partial_payment_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointment_services`
--
ALTER TABLE `appointment_services`
  ADD CONSTRAINT `appointment_services_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
