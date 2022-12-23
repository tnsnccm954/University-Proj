-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 12:12 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swu_market`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_member`
--

CREATE TABLE `admin_member` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_member`
--

INSERT INTO `admin_member` (`admin_id`, `username`, `pass`, `admin_name`, `tel`, `time_stamp`) VALUES
(1, 'admin', 'admin', 'Verasith', '0832964420', '2020-11-29 04:33:16'),
(2, 'admin2', 'admin2', 'Markian', '0832964420', '2020-11-29 05:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `area_manage`
--

CREATE TABLE `area_manage` (
  `time_market` date NOT NULL,
  `A1` varchar(255) NOT NULL,
  `A2` varchar(255) NOT NULL,
  `A3` varchar(255) NOT NULL,
  `A4` varchar(255) NOT NULL,
  `B1` varchar(255) NOT NULL,
  `B2` varchar(255) NOT NULL,
  `B3` varchar(255) NOT NULL,
  `B4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area_manage`
--

INSERT INTO `area_manage` (`time_market`, `A1`, `A2`, `A3`, `A4`, `B1`, `B2`, `B3`, `B4`) VALUES
('2020-11-13', '1', '1', '1', '1', '1', '1', '1', '1'),
('2020-11-24', '1', '1', '1', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `category_m`
--

CREATE TABLE `category_m` (
  `category_m_id` int(11) NOT NULL,
  `category_m_type` varchar(255) NOT NULL,
  `category_m_icon` varchar(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_member`
--

CREATE TABLE `user_member` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_co_name` varchar(255) NOT NULL,
  `shop_product` varchar(255) NOT NULL,
  `shop_type` varchar(255) NOT NULL,
  `shop_option` varchar(255) NOT NULL,
  `tel_num` varchar(10) NOT NULL,
  `shop_cost` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_member`
--

INSERT INTO `user_member` (`user_id`, `username`, `pass`, `shop_name`, `shop_co_name`, `shop_product`, `shop_type`, `shop_option`, `tel_num`, `shop_cost`, `time_stamp`) VALUES
(1, 'ad', 'av', 'dr', 'qe', 'qwe', '', '', '', 0, '2020-11-30 04:35:17'),
(2, 'user2', 'user2', 'user2', 'user2A', 'user2AE', '', '', '', 0, '2020-11-30 04:36:40'),
(3, 'user3', 'user3', 'user3', 'user3', 'user3', '', '', '', 0, '2020-11-30 04:39:30'),
(4, 'user4', 'user4', 'user4', 'user4', 'user4', '', '', '', 0, '2020-11-30 04:43:07'),
(5, 'user5', 'user5', 'user5', 'user5', 'user5', '', '', '123456789', 0, '2020-11-30 04:44:00'),
(6, 'user6', 'user6', 'user6', 'user6', 'user6', 'ผลไม้', '', '123456789', 0, '2020-11-30 04:46:26'),
(7, 'user7', 'user7', 'user7', 'user7', 'user7', 'ของใช้', '', '123456789', 0, '2020-11-30 04:52:11'),
(8, 'ad', 'ad', 'ad', 'ad', 'ad', 'ผลไม้', '', '1234522222', 0, '2020-11-30 10:58:18'),
(9, 'ad', 'aaa', 'ad', 'ad', 'ad', 'ผลไม้', '', '1234522222', 0, '2020-11-30 11:00:47'),
(10, 'ad', 'aaa', 'ad', 'ad', 'ad', 'ผลไม้', '', '1234522222', 0, '2020-11-30 11:03:03'),
(11, 'ad', 'aaa', 'ad', 'ad', 'ad', 'ผลไม้', '', '1234522222', 4800, '2020-11-30 11:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_member_verify`
--

CREATE TABLE `user_member_verify` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_co_name` varchar(255) NOT NULL,
  `shop_category` varchar(255) NOT NULL,
  `shop_product` varchar(255) NOT NULL,
  `shop_detail` varchar(255) NOT NULL,
  `shop_option` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_member_verify`
--

INSERT INTO `user_member_verify` (`user_id`, `username`, `pass`, `shop_name`, `shop_co_name`, `shop_category`, `shop_product`, `shop_detail`, `shop_option`, `tel`, `time_stamp`) VALUES
(1, 'user1', 'user1', 'Babymommy', 'Kanyaluck', '', '', 'อาหารแม่และเด็ก', '', '0932853953', '2020-11-29 10:08:09'),
(2, 'silly1', 'silly1', 'beffyme', 'buffer', '', '', 'อาหารกรด', '', '123456790', '2020-11-29 10:08:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_member`
--
ALTER TABLE `admin_member`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `area_manage`
--
ALTER TABLE `area_manage`
  ADD PRIMARY KEY (`time_market`);

--
-- Indexes for table `category_m`
--
ALTER TABLE `category_m`
  ADD PRIMARY KEY (`category_m_id`);

--
-- Indexes for table `user_member`
--
ALTER TABLE `user_member`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_member_verify`
--
ALTER TABLE `user_member_verify`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_member`
--
ALTER TABLE `admin_member`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_m`
--
ALTER TABLE `category_m`
  MODIFY `category_m_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_member`
--
ALTER TABLE `user_member`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_member_verify`
--
ALTER TABLE `user_member_verify`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
