-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 01:39 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anon inter rice`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationNo` int(11) NOT NULL COMMENT 'รหัสสถานที่รับซื้อ',
  `location` varchar(50) NOT NULL COMMENT 'สถานที่รับซื้อ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationNo`, `location`) VALUES
(1, 'noData'),
(2, 'สายทองวัฒนา'),
(3, 'สายทอง.ข้าวหอม'),
(4, 'สายทอง.จัสมิน'),
(5, 'สกต.อ่างทอง'),
(6, 'สยามธัญญกิจ'),
(7, 'สยามรวงทอง'),
(8, 'ตักต่อโซว'),
(9, '1'),
(10, '2'),
(11, '3'),
(13, '5'),
(14, '6'),
(15, '7'),
(16, '8'),
(17, '9'),
(18, '10'),
(19, '11'),
(20, '12'),
(21, '13'),
(22, '14'),
(23, 'end'),
(26, '4'),
(28, '12346789012346578901234678901234567890123456789013'),
(29, 'ส1'),
(30, 'ส2'),
(31, 'ส3'),
(32, 'ส4'),
(33, 'ส5'),
(34, 'ส6'),
(35, 'ส7'),
(38, 'ส8'),
(39, 'l 5');

-- --------------------------------------------------------

--
-- Table structure for table `mill`
--

CREATE TABLE `mill` (
  `millNo` int(11) NOT NULL COMMENT 'รหัสโรงสีข้าว',
  `mill` varchar(50) NOT NULL COMMENT 'โรงสีข้าว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mill`
--

INSERT INTO `mill` (`millNo`, `mill`) VALUES
(1, 'noData'),
(2, 'ศิริพร'),
(3, 'ธนพร'),
(4, 'สินอุดม'),
(5, 'ดิลก'),
(6, 'ร 1'),
(7, 'ร2'),
(8, 'ร3'),
(9, 'ร4'),
(10, 'ร5'),
(11, 'ร6'),
(12, 'ร7'),
(13, 'ร8'),
(14, 'ร9'),
(15, '[ 5');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `positionNo` int(11) NOT NULL,
  `position` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`positionNo`, `position`) VALUES
(1, 'Admin'),
(2, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `rice_account`
--

CREATE TABLE `rice_account` (
  `accountNo` int(11) NOT NULL COMMENT 'รหัสบัญชี',
  `dated` date DEFAULT NULL COMMENT 'วันที่ลงบัญชี',
  `datePost` datetime NOT NULL COMMENT 'วันที่ลงรายการ',
  `locationNo` varchar(50) DEFAULT NULL COMMENT 'สถานที่รับซื้อ',
  `typeNo` varchar(50) DEFAULT NULL COMMENT 'ชนิด',
  `purchase` decimal(11,2) DEFAULT NULL COMMENT 'ซื้อข้าว/กก.',
  `total` decimal(11,2) DEFAULT NULL COMMENT 'ยอดเงินที่ซื้อ',
  `service` decimal(11,2) DEFAULT NULL COMMENT 'ค่าบริการ',
  `average` decimal(11,2) DEFAULT NULL COMMENT 'ค่าเฉลี่ย/ตัน',
  `income` decimal(11,2) DEFAULT NULL COMMENT 'เงินเข้า',
  `interest` decimal(11,2) DEFAULT NULL COMMENT 'ดอกเบี้ย',
  `withdraw` decimal(11,2) DEFAULT NULL COMMENT 'เบิกเงิน',
  `note` varchar(1000) DEFAULT NULL COMMENT 'หมายเหตุ',
  `balance` float DEFAULT NULL COMMENT 'คงเหลือ',
  `pay` decimal(11,2) DEFAULT NULL COMMENT 'ค่าจ้างรถ',
  `scoop` float DEFAULT NULL COMMENT 'นน.ตักออก',
  `millNo` varchar(100) DEFAULT NULL COMMENT 'โรงสีข้าว',
  `destination` float DEFAULT NULL COMMENT 'นน.ปลายทาง',
  `sell` decimal(11,2) DEFAULT NULL COMMENT 'ราคาที่ขาย',
  `scale` float DEFAULT NULL COMMENT 'ค่าชั่ง',
  `transferDate` date DEFAULT NULL COMMENT 'วันที่โอน',
  `bank` varchar(100) DEFAULT NULL COMMENT 'ธนาคาร',
  `transferAmount` decimal(11,2) DEFAULT NULL COMMENT 'จำนวนเงินที่โอน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rice_account`
--

INSERT INTO `rice_account` (`accountNo`, `dated`, `datePost`, `locationNo`, `typeNo`, `purchase`, `total`, `service`, `average`, `income`, `interest`, `withdraw`, `note`, `balance`, `pay`, `scoop`, `millNo`, `destination`, `sell`, `scale`, `transferDate`, `bank`, `transferAmount`) VALUES
(1, '2020-01-29', '2020-01-29 11:19:11', '2', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '563514.00', 'ถอนไปเข้า สตม.สายทอง2 400000', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(2, '2020-01-28', '2020-01-29 11:20:00', '2', '2', '10668.00', '70720.00', '1088.00', '6600.00', '1001200.00', '0.00', '313660.00', 'ถอนเข้า สตม.สายทอง2 300000', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(3, '2020-01-27', '2020-01-29 11:29:00', '2', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(4, '2020-01-29', '2020-01-29 11:58:36', '3', '3', '20930.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 6910, '2', 0, '0.00', 0, NULL, NULL, NULL),
(5, '2020-01-29', '2020-01-29 12:15:47', '8', '4', '40300.00', '306280.00', '0.00', '7600.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(6, '2020-01-29', '2020-01-29 15:29:18', '2', '1', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 30750, '2', 0, '0.00', 0, NULL, NULL, NULL),
(7, '2020-02-28', '2020-02-01 14:15:38', '2', '2', '1.10', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '2', 0, '0.00', 0, NULL, NULL, NULL),
(8, '2020-02-27', '2020-02-01 14:15:38', '3', '3', '1.20', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '3', 0, '0.00', 0, NULL, NULL, NULL),
(9, '2020-02-26', '2020-02-01 14:15:38', '4', '4', '1.30', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '4', 0, '0.00', 0, NULL, NULL, NULL),
(10, '2020-02-29', '2020-02-01 14:15:38', '2', '5', '1.40', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '5', 0, '0.00', 0, NULL, NULL, NULL),
(11, '2020-02-03', '2020-02-03 19:15:40', '1', '1', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1', NULL, NULL, 1, '1', 1, '1.00', 1, NULL, NULL, NULL),
(12, '2020-02-03', '2020-02-03 19:15:40', '1', '1', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2', NULL, NULL, 2, '1', 2, '2.00', 2, NULL, NULL, NULL),
(13, '2020-02-03', '2020-02-03 19:15:40', '1', '1', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3', NULL, NULL, 3, '1', 3, '3.00', 3, NULL, NULL, NULL),
(14, '2020-02-03', '2020-02-03 19:25:44', '1', '1', '1.00', '1.00', '1.00', '1.00', '1.00', '11.00', '1.00', '1', NULL, NULL, 1, '1', 1, '0.00', 0, NULL, NULL, NULL),
(15, '2020-02-03', '2020-02-03 19:25:59', '1', '1', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(16, '2020-02-03', '2020-02-03 19:25:59', '1', '1', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(17, '2020-02-03', '2020-02-03 19:28:19', '1', '1', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(18, '2020-02-03', '2020-02-03 19:28:19', '1', '1', '2.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(19, '2020-02-03', '2020-02-03 19:28:19', '1', '1', '3.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(20, '2020-02-03', '2020-02-03 19:28:19', '1', '1', '4.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(21, '2020-02-03', '2020-02-03 19:28:19', '1', '1', '5.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(22, '2020-02-03', '2020-02-03 19:28:19', '1', '1', '6.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(23, '2020-02-03', '2020-02-03 19:28:19', '1', '1', '7.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(24, '2020-02-03', '2020-02-03 19:28:19', '1', '1', '8.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(25, '2020-02-03', '2020-02-03 19:28:19', '1', '1', '9.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL),
(26, '2020-02-03', '2020-02-03 19:28:19', '1', '1', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, 0, '1', 0, '0.00', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffNo` int(11) NOT NULL,
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `positionNo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffNo`, `fName`, `lName`, `sex`, `username`, `password`, `positionNo`) VALUES
(1, 'Siwat', 'Jremwatthana', 'M', 'admin', 'd042be1b4b72c110d21287b3dad13867', '1'),
(2, 'Zom', 'Niparat\r\n', 'F', 'Stwn', '864f9a4fbb8df49f1f59068a7f9a94d4', '2');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `typeNo` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`typeNo`, `type`) VALUES
(1, 'noData'),
(2, 'ข้าวรวม'),
(3, 'หอมปทุม'),
(4, 'จัสมิน'),
(5, 'มะลิ'),
(6, 'ก'),
(7, 'ก1'),
(8, 'ก2'),
(9, 'ก3'),
(10, 'ก4'),
(11, 'ก5'),
(12, 'ก6'),
(13, 'ก7'),
(14, 'ก8'),
(15, 'ก9'),
(16, 'ก10'),
(17, '5 5');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicleNo` int(11) NOT NULL COMMENT 'รหัสทะเบียนรถ',
  `vehicle` varchar(10) NOT NULL COMMENT 'ทะเบียนรถ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicleNo`, `vehicle`) VALUES
(1, 'noData'),
(2, 'test 15'),
(3, 'test 2'),
(5, 'test 4'),
(6, 'test 5'),
(7, 'test 6'),
(8, 'test 7'),
(9, 'test 8'),
(10, 'test 9'),
(11, 'test 10'),
(12, 'test 11'),
(15, '88'),
(16, 'test 50');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_account`
--

CREATE TABLE `vehicle_account` (
  `vehicleAcc` int(11) NOT NULL COMMENT 'รหัสบัญชีรถวิ่งเข้าลานตัก',
  `vehicleNo` varchar(10) NOT NULL COMMENT 'รหัสทะเบียนรถ',
  `accountNo` varchar(10) NOT NULL COMMENT 'รหัสบัญชี'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_account`
--

INSERT INTO `vehicle_account` (`vehicleAcc`, `vehicleNo`, `accountNo`) VALUES
(8, '2', '14'),
(9, '3', '14'),
(10, '2', '15'),
(11, '2', '16'),
(12, '3', '16'),
(13, '5', '16'),
(14, '2', '17'),
(15, '2', '18'),
(16, '3', '18'),
(17, '2', '19'),
(18, '3', '19'),
(19, '5', '19'),
(20, '2', '20'),
(21, '3', '20'),
(22, '5', '20'),
(23, '6', '20'),
(24, '2', '21'),
(25, '3', '21'),
(26, '5', '21'),
(27, '6', '21'),
(28, '7', '21'),
(29, '2', '22'),
(30, '2', '23'),
(31, '3', '23'),
(32, '2', '24'),
(33, '3', '24'),
(34, '5', '24'),
(35, '2', '25'),
(36, '3', '25'),
(37, '5', '25'),
(38, '6', '25'),
(39, '2', '26'),
(40, '3', '26'),
(41, '5', '26'),
(42, '6', '26'),
(43, '7', '26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationNo`);

--
-- Indexes for table `mill`
--
ALTER TABLE `mill`
  ADD PRIMARY KEY (`millNo`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`positionNo`);

--
-- Indexes for table `rice_account`
--
ALTER TABLE `rice_account`
  ADD PRIMARY KEY (`accountNo`) USING BTREE;

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffNo`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`typeNo`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicleNo`);

--
-- Indexes for table `vehicle_account`
--
ALTER TABLE `vehicle_account`
  ADD PRIMARY KEY (`vehicleAcc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสถานที่รับซื้อ', AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `mill`
--
ALTER TABLE `mill`
  MODIFY `millNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสโรงสีข้าว', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `positionNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rice_account`
--
ALTER TABLE `rice_account`
  MODIFY `accountNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสบัญชี', AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `typeNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicleNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสทะเบียนรถ', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vehicle_account`
--
ALTER TABLE `vehicle_account`
  MODIFY `vehicleAcc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสบัญชีรถวิ่งเข้าลานตัก', AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
