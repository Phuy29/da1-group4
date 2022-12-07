-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2022 at 09:16 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quan_ly_khach_san_du_an_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bed_types`
--

CREATE TABLE `bed_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bed_types`
--

INSERT INTO `bed_types` (`id`, `name`) VALUES
(1, 'Giường đơn'),
(2, 'Giường cỡ lớn'),
(3, 'Giường cỡ đại'),
(4, 'Giường có bánh xe');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `discount` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `status` tinyint(5) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `fullname`, `phone_number`, `email`, `adults`, `children`, `checkin`, `checkout`, `discount`, `total_price`, `status`, `created_at`) VALUES
(1, 'Nguyễn Duy Quang Vinh', '0968739042', 'nguyenduyquangvinh2906@gmail.com', 2, 0, '2022-12-23', '2022-12-30', 0.00, 100.00, 0, '2022-12-02 14:39:12'),
(2, 'Nguyễn Quang Vinh', '0968739042', 'quangvinks@gmail.com', 5, 0, '2022-12-06', '2022-12-12', 0.00, 660.00, 0, '2022-12-02 19:30:47'),
(3, 'Nguyễn Quang Vinh', '0968739042', 'quangvinks@gmail.com', 3, 0, '2022-12-13', '2022-12-15', 0.00, 72.00, 0, '2022-12-02 19:32:00'),
(4, 'Nguyễn Quang Vinh', '0968739042', 'quangvinks@gmail.com', 3, 0, '2022-12-09', '2022-12-14', 40.00, 81.00, 0, '2022-12-02 19:36:17'),
(5, 'Nguyễn Quang Vinh', '0968739042', 'quangvinks@gmail.com', 5, 0, '2022-12-13', '2022-12-14', 0.00, 110.00, 0, '2022-12-02 19:59:23'),
(6, 'Nguyễn Duy Quang Vinh', '0123456789', 'nguyenduyquangvinh2906@gmail.com', 1, 0, '2022-12-05', '2022-12-06', 40.00, 16.20, 0, '2022-12-02 20:02:51'),
(7, 'Nguyễn Duy Quang Vinh', '0968739042', 'quangvinks@gmail.com', 2, 0, '2022-12-07', '2022-12-09', 40.00, 32.40, 0, '2022-12-03 03:07:05'),
(8, 'Nguyễn Vinh', '0968739042', 'quangvinks@gmail.com', 3, 0, '2022-12-10', '2022-12-12', 0.00, 72.00, 0, '2022-12-03 15:43:37'),
(9, 'Nguyễn Duy Quang Vinh', '0968739042', 'nguyenduyquangvinh2906@gmail.com', 6, 1, '2022-12-17', '2022-12-20', 0.00, 330.00, 0, '2022-12-03 19:48:20'),
(10, 'Nguyễn Duy Quang Vinh', '0968739042', 'quangvinks@gmail.com', 4, 0, '2022-12-09', '2022-12-16', 40.00, 462.00, -1, '2022-12-03 19:50:20'),
(11, 'Nguyễn Quang Vinh', '0968739042', 'quangvinks@gmail.com', 2, 0, '2022-12-06', '2022-12-09', 15.00, 91.80, 0, '2022-12-05 09:26:49'),
(12, 'Nguyễn Quang Vinh', '0968739042', 'quangvinks@gmail.com', 6, 0, '2022-12-17', '2022-12-19', 15.00, 187.00, 1, '2022-12-05 09:39:16'),
(13, 'Nguyễn Duy Quang Vinh', '0123456789', 'nguyenduyquangvinh2906@gmail.com', 7, 0, '2022-12-12', '2022-12-16', 0.00, 440.00, 1, '2022-12-05 15:59:59'),
(14, 'Nguyễn Duy Quang Vinh', '0123456789', 'nguyenduyquangvinh2906@gmail.com', 7, 0, '2022-12-07', '2022-12-11', 40.00, 264.00, 0, '2022-12-06 03:45:46'),
(15, 'Nguyễn Quang Vinh', '0968739042', 'quangvinks@gmail.com', 10, 0, '2022-12-13', '2022-12-14', 0.00, 36.00, 0, '2022-12-07 13:58:08'),
(16, 'Nguyễn Duy Quang Vinh', '0968739042', 'quangvinks@gmail.com', 7, 0, '2022-12-20', '2022-12-30', 40.00, 162.00, 0, '2022-12-07 15:03:31'),
(17, 'Nguyễn Duy Quang Vinh', '0123456789', 'nguyenduyquangvinh2906@gmail.com', 4, 0, '2022-12-15', '2022-12-20', 0.00, 180.00, 0, '2022-12-07 17:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

CREATE TABLE `booking_detail` (
  `id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_detail`
--

INSERT INTO `booking_detail` (`id`, `room_type_id`, `booking_id`, `price`) VALUES
(1, 17, 1, 100),
(2, 18, 2, 110),
(3, 17, 3, 36),
(4, 16, 4, 27),
(5, 18, 5, 110),
(6, 16, 6, 27),
(7, 16, 7, 27),
(8, 17, 8, 36),
(9, 18, 9, 110),
(10, 18, 10, 110),
(11, 17, 11, 36),
(12, 18, 12, 110),
(13, 18, 13, 110),
(14, 18, 14, 110),
(15, 17, 15, 36),
(16, 16, 16, 27),
(17, 17, 17, 36);

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `started_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finished_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `name`, `started_at`, `finished_at`) VALUES
(1, 'Giáng sinh', '2022-12-23 03:18:51', '2022-12-26 03:18:51'),
(3, 'Tết Âm lịch', '2023-01-20 17:00:00', '2023-01-24 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `room_galleries`
--

CREATE TABLE `room_galleries` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `room_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_galleries`
--

INSERT INTO `room_galleries` (`id`, `image`, `room_type_id`) VALUES
(21, 'public/uploads/loai-phong/16/0.jpg', 16),
(22, 'public/uploads/loai-phong/16/1.jpg', 16),
(23, 'public/uploads/loai-phong/16/2.jpg', 16),
(24, 'public/uploads/loai-phong/16/3.jpg', 16),
(25, 'public/uploads/loai-phong/16/4.jpg', 16),
(26, 'public/uploads/loai-phong/16/5.jpg', 16),
(27, 'public/uploads/loai-phong/17/0.jpg', 17),
(28, 'public/uploads/loai-phong/17/1.jpg', 17),
(29, 'public/uploads/loai-phong/17/2.jpg', 17),
(30, 'public/uploads/loai-phong/17/3.jpg', 17),
(31, 'public/uploads/loai-phong/17/4.jpg', 17),
(32, 'public/uploads/loai-phong/17/5.jpg', 17),
(33, 'public/uploads/loai-phong/17/6.jpg', 17),
(34, 'public/uploads/loai-phong/17/7.jpg', 17),
(36, 'public/uploads/loai-phong/18/1.jpg', 18),
(37, 'public/uploads/loai-phong/18/2.jpg', 18),
(38, 'public/uploads/loai-phong/18/3.jpg', 18),
(39, 'public/uploads/loai-phong/18/4.jpg', 18),
(40, 'public/uploads/loai-phong/18/5.jpg', 18);

-- --------------------------------------------------------

--
-- Table structure for table `room_services`
--

CREATE TABLE `room_services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_services`
--

INSERT INTO `room_services` (`id`, `name`) VALUES
(1, 'TV'),
(2, 'Free Wifi'),
(3, 'Máy lạnh'),
(4, 'Máy sưởi'),
(7, 'Giặt là'),
(8, 'Điện thoại bàn');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `adults` int(11) NOT NULL,
  `size` double(10,2) NOT NULL,
  `bed_type_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `adults`, `size`, `bed_type_id`, `description`, `price`) VALUES
(16, 'King Deluxe Studio', 3, 35.00, 2, 'King Deluxe Studio rộng 35 m2 được thiết kế với một giường lớn tiện dụng, một ban công gần gũi với thiên nhiên tạo nên nét đẹp phù hợp với khách hàng cần thời gian thư giãn, nghỉ ngơi sao khi về thừ nơi làm việc.\r\n\r\nHân hạnh được mang đến cho bạn những phú giây tuyệt vời tại đây.', 27.00),
(17, 'King Deluxe 1 Bedroom', 2, 45.00, 3, 'King Deluxe Studio rộng 45 m2 được thiết kế với 1 phòng ngủ riêng có một giường lớn tiện dụng, một phòng khách cso sofa và bếp phù hợp với khách hàng cần có khoảng không gian tiện nghi như ở nhà.\r\n\r\nHân hạnh được mang đến cho bạn những phú giây tuyệt vời tại đây.', 36.00),
(18, 'ROOFTOP 5BR', 10, 330.00, 3, 'IREST ROOFTOP 5BR WITH TERRACE là loại phòng nằm ở những tầng cao nhất của tòa nhà hiện đại giữa lòng Hà Nội với tổng diện tích 330 m2.\r\nGồm 1 phòng khách lớn đầy sang trọng cùng TV thông minh có kích thước lên tới 65\", 5 phòng ngủ mang lại cảm giác ấm cúng, 4 phòng tắm, 1 bếp lớn đầy đủ tiện nghi và 1 sân ngoài rộng hướng ra thành phố thủ đô, loại phòng được thiết kế đơn giản, ấm cúng nhưng cực kỳ hiện đại này chắc chắn sẽ đem đến cho khách hàng những trải nghiệm tốt nhất!', 110.00);

-- --------------------------------------------------------

--
-- Table structure for table `service_room_type`
--

CREATE TABLE `service_room_type` (
  `id` int(11) NOT NULL,
  `room_service_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_room_type`
--

INSERT INTO `service_room_type` (`id`, `room_service_id`, `room_type_id`) VALUES
(40, 1, 16),
(41, 2, 16),
(42, 3, 16),
(43, 4, 16),
(44, 7, 16),
(45, 8, 16),
(46, 1, 17),
(47, 2, 17),
(48, 3, 17),
(49, 4, 17),
(50, 7, 17),
(51, 8, 17),
(52, 1, 18),
(59, 2, 18),
(60, 3, 18),
(61, 4, 18),
(62, 7, 18),
(63, 8, 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone_number`, `email`, `password`, `role`) VALUES
(1, 'Nguyễn Quang Vinh', '0968739042', 'quangvinks@gmail.com', 'quangvinh26', 0),
(2, 'Nguyễn Văn Quang', '0965212247', 'nguyenvanquanglc2003@gmail.com', 'quangngu', 0),
(3, 'Nguyễn Duy Quang Vinh', '0123456789', 'nguyenduyquangvinh2906@gmail.com', 'quangvinh', 2),
(4, 'Nguyễn Linh Anh', '0123456789', 'nguyenduyquangvinh@gmail.com', 'linhanh26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `refresh_time` int(11) DEFAULT '0',
  `used` int(11) DEFAULT '0',
  `max` int(11) DEFAULT NULL,
  `status` tinyint(3) NOT NULL COMMENT '- 0 là không thể sử dụng\r\n- 1 là mã nhập vô hạn\r\n- 2 là mã nhập 1 lần'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `discount`, `campaign_id`, `refresh_time`, `used`, `max`, `status`) VALUES
(1, '7JYK9VZFZH', 40.00, 1, 0, 2, 15, 2),
(2, '5IX8IDZNQL', 40.00, 1, 0, 0, NULL, 0),
(3, '8GXJOONFY9', 20.00, 1, 0, 0, NULL, 1),
(4, 'NH8QXE2N2I', 15.00, 3, 5, 1, 1, 2),
(5, 'R9HHDEX5GW', 10.00, 3, 0, 0, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_used`
--

CREATE TABLE `voucher_used` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(20) NOT NULL,
  `refresh_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voucher_used`
--

INSERT INTO `voucher_used` (`id`, `email`, `code`, `refresh_time`) VALUES
(1, 'quangvinks@gmail.com', 'NH8QXE2N2I', 2),
(2, 'quangvinks@gmail.com', 'NH8QXE2N2I', 4),
(3, 'nguyenduyquangvinh2906@gmail.com', '7JYK9VZFZH', 0),
(4, 'quangvinks@gmail.com', '7JYK9VZFZH', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bed_types`
--
ALTER TABLE `bed_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_galleries`
--
ALTER TABLE `room_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `room_services`
--
ALTER TABLE `room_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_room_type`
--
ALTER TABLE `service_room_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_service_id` (`room_service_id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_id` (`campaign_id`);

--
-- Indexes for table `voucher_used`
--
ALTER TABLE `voucher_used`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bed_types`
--
ALTER TABLE `bed_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_galleries`
--
ALTER TABLE `room_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `room_services`
--
ALTER TABLE `room_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `service_room_type`
--
ALTER TABLE `service_room_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `voucher_used`
--
ALTER TABLE `voucher_used`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD CONSTRAINT `booking_detail_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  ADD CONSTRAINT `booking_detail_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`);

--
-- Constraints for table `room_galleries`
--
ALTER TABLE `room_galleries`
  ADD CONSTRAINT `room_galleries_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`);

--
-- Constraints for table `service_room_type`
--
ALTER TABLE `service_room_type`
  ADD CONSTRAINT `service_room_type_ibfk_1` FOREIGN KEY (`room_service_id`) REFERENCES `room_services` (`id`),
  ADD CONSTRAINT `service_room_type_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`);

--
-- Constraints for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `vouchers_ibfk_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
