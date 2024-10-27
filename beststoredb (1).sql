-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 06:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beststoredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_quantity` int(100) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `product_id`, `order_quantity`, `order_date`, `order_status`) VALUES
(1, 1, 3, 2, '2024-10-01 10:30:00', 'completed'),
(2, 2, 4, 1, '2024-10-02 12:45:00', 'pending'),
(3, 3, 1, 28, '2024-10-03 09:10:00', 'shipped'),
(4, 4, 2, 5, '2024-10-04 15:25:00', 'completed'),
(6, 1, 2, 2, '2024-10-06 08:40:00', 'canceled'),
(7, 3, 4, 5, '2024-10-07 17:05:00', 'shipped'),
(8, 2, 1, 2, '2024-10-08 16:30:00', 'completed'),
(9, 4, 3, 1, '2024-10-09 11:15:00', 'pending'),
(11, 1, 4, 5, '2024-10-11 10:00:00', 'completed'),
(12, 2, 3, 3, '2024-10-12 12:00:00', 'shipped'),
(13, 3, 2, 2, '2024-10-13 14:30:00', 'pending'),
(14, 4, 1, 2, '2024-10-14 09:45:00', 'completed'),
(16, 1, 1, 1, '2024-10-12 14:28:37', 'pending'),
(17, 1, 6, 1, '2024-10-12 14:28:53', 'pending'),
(18, 1, 2, 3, '2024-10-12 14:29:12', 'pending'),
(19, 1, 6, 1, '2024-10-12 14:30:09', 'pending'),
(20, 1, 1, 1, '2024-10-12 14:31:20', 'pending'),
(21, 1, 1, 14, '2024-10-12 14:34:54', 'pending'),
(22, 1, 5, 5, '2024-10-12 14:35:32', 'pending'),
(23, 1, 3, 2, '2024-10-12 14:35:41', 'pending'),
(25, 1, 7, 2, '2024-10-12 14:38:13', 'pending'),
(26, 1, 1, 12, '2024-10-12 14:40:20', 'pending'),
(27, 8, 1, 2, '2024-10-12 14:40:46', 'pending'),
(28, 8, 2, 2, '2024-10-12 14:40:53', 'pending'),
(29, 8, 3, 2, '2024-10-12 14:40:54', 'pending'),
(30, 8, 5, 3, '2024-10-12 14:40:55', 'pending'),
(32, 8, 8, 11, '2024-10-12 14:41:04', 'pending'),
(34, 8, 4, 12, '2024-10-12 14:42:21', 'pending'),
(36, 1, 10, 2, '2024-10-27 23:47:12', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `image`, `created_at`) VALUES
(1, 'Office Chair', 'Comfortable ergonomic office chair.', '120.50', 15, 'office_chair.jpg', '2024-10-11 03:17:20'),
(2, 'Desk Lamp', 'LED desk lamp with adjustable brightness.', '35.00', 50, 'desk_lamp.jpg', '2024-10-11 03:17:20'),
(3, 'Notebook', '200-page spiral notebook for office use.', '5.75', 200, 'notebook.jpg', '2024-10-11 03:17:20'),
(4, 'Ballpoint Pens', 'Pack of 10 smooth-writing ballpoint pens.', '3.50', 500, 'pens.jpg', '2024-10-11 03:17:20'),
(5, 'Filing Cabinet', 'Steel filing cabinet with 4 drawers.', '250.00', 10, 'filing_cabinet.jpg', '2024-10-11 03:17:20'),
(6, 'Paper Clips', 'Box of 100 metal paper clips.', '1.50', 1000, 'paper_clips.jpg', '2024-10-11 03:17:20'),
(7, 'Whiteboard Markers', 'Set of 4 assorted colors.', '7.99', 100, 'whiteboard_markers.jpg', '2024-10-11 03:17:20'),
(8, 'Stapler', 'Heavy-duty office stapler with extra staples.', '12.25', 40, 'stapler.jpg', '2024-10-11 03:17:20'),
(9, 'Desk Organizer', 'Wooden desk organizer with multiple compartments.', '22.99', 30, 'desk_organizer.jpg', '2024-10-11 03:17:20'),
(10, 'Printer Paper', 'Ream of 500 sheets, 80gsm.', '6.99', 300, 'printer_paper.jpg', '2024-10-11 03:17:20'),
(11, 'USB Flash Drive', '32GB USB 3.0 flash drive.', '10.50', 150, 'usb_flash_drive.jpg', '2024-10-11 03:17:20'),
(12, 'Mouse Pad', 'Non-slip mouse pad with gel wrist support.', '8.75', 75, 'mouse_pad.jpg', '2024-10-11 03:17:20'),
(13, 'Monitor Stand', 'Adjustable monitor stand for comfortable viewing.', '25.00', 20, 'monitor_stand.jpg', '2024-10-11 03:17:20'),
(14, 'Laptop Bag', 'Water-resistant laptop bag with padded compartments.', '40.99', 25, 'laptop_bag.jpg', '2024-10-11 03:17:20'),
(15, 'Shredder', 'Cross-cut paper shredder for office use.', '85.00', 8, 'shredder.jpg', '2024-10-11 03:17:20'),
(16, 'Conference Phone', 'Polycom conference phone for meeting rooms.', '199.99', 5, 'conference_phone.jpg', '2024-10-11 03:17:20'),
(17, 'Pen Holder', 'Metal mesh pen holder for desk.', '4.50', 100, 'pen_holder.jpg', '2024-10-11 03:17:20'),
(18, 'Sticky Notes', 'Pack of 6 pads of sticky notes in assorted colors.', '3.99', 250, 'sticky_notes.jpg', '2024-10-11 03:17:20'),
(19, 'Calculator', 'Basic 12-digit office calculator.', '15.75', 60, 'calculator.jpg', '2024-10-11 03:17:20'),
(20, 'Paper Shredder Oil', 'Lubricant for maintaining shredder blades.', '9.99', 40, 'shredder_oil.jpg', '2024-10-11 03:17:20'),
(21, 'Logitech Mouse', 'Silent-click', '600.00', 23, 'mouse.jpg', '2024-10-12 01:53:08'),
(22, 'pena', 'pena', '245.00', 1, 'pena.jpg', '2024-10-12 02:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review_text` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `product_id`, `rating`, `review_text`, `review_date`) VALUES
(1, 1, 3, 4, 'Great product, highly recommend!', '2024-10-12 02:07:08'),
(2, 1, 2, 5, 'Exceeded my expectations!', '2024-10-12 02:07:08'),
(3, 1, 1, 3, 'Good but can be improved', '2024-10-12 02:07:08'),
(4, 1, 5, 2, 'Not worth the price', '2024-10-12 02:07:08'),
(5, 2, 4, 4, 'Satisfied with the quality', '2024-10-12 02:07:08'),
(6, 2, 3, 3, 'It’s okay, nothing special', '2024-10-12 02:07:08'),
(7, 2, 1, 5, 'Amazing product, will buy again', '2024-10-12 02:07:08'),
(8, 2, 2, 4, 'Good value for money', '2024-10-12 02:07:08'),
(9, 8, 3, 2, 'Didn’t work as expected', '2024-10-12 02:07:08'),
(10, 8, 5, 1, 'Very poor quality, not recommended', '2024-10-12 02:07:08'),
(11, 8, 4, 5, 'Superb, will buy more!', '2024-10-12 02:07:08'),
(12, 8, 2, 3, 'Average product, could be better', '2024-10-12 02:07:08'),
(13, 8, 1, 4, 'Decent product, happy with the purchase', '2024-10-12 02:07:08'),
(14, 1, 4, 5, 'Fantastic! High quality.', '2024-10-12 02:07:08'),
(15, 2, 5, 2, 'Disappointed with the product', '2024-10-12 02:07:08'),
(16, 1, 6, 3, 'It’s fine, nothing extraordinary', '2024-10-12 02:07:08'),
(17, 2, 6, 4, 'Good deal for the price', '2024-10-12 02:07:08'),
(18, 8, 6, 3, 'It was okay, met my expectations', '2024-10-12 02:07:08'),
(19, 8, 1, 4, 'Pretty decent for the price', '2024-10-12 02:07:08'),
(20, 2, 3, 5, 'Perfect! Very pleased with this purchase', '2024-10-12 02:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'client',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `password`, `role`, `created_at`) VALUES
(1, 'Joshua Patrick', 'Chiu', 'joshuapatrickchiu76@gmail.com', '09989182612', '132 Margosa Street', '$2y$10$tR806s6wdNXbSvlefThgle6mQmqN7Yn7c6MnvQOxtF21avY9iWJaq', 'client', '2024-10-07 10:49:36'),
(2, 'Marie', 'Durban', 'marie@gmail.com', '09876554337', 'Oak Street', '$2y$10$R8SqRK4IqB9Mrn.i7mrWM.IEqAPcQJb9RtH/EIEOqacEq.ipugS1C', 'client', '2024-10-07 10:54:37'),
(3, 'Marie', 'Durban', 'marie1@gmail.com', '09876554337', 'Oak Street', '$2y$10$fnNpAhEQcfAjjRnrKWnT/.KBs9EZtYceV4YvTDN0z5XQMVZEs7nEG', 'client', '2024-10-07 10:59:57'),
(4, 'Marie', 'Durban', 'marie2@gmail.com', '09876554337', 'Oak Street', '$2y$10$CZTaCZD/rxinqmjePP95ve44ahMpy0TIap7WhXYCl3e34JE9ZHIXy', 'client', '2024-10-07 11:00:58'),
(6, 'Slam', 'Dunk', 'slam@gmail.com', '09989182612', 'slam dunk', '$2y$10$JJ5nuUnzFz3uF.7jzj9MPOFW.bDr8NxRPai3a2OhFWxqehss41FpG', 'client', '2024-10-08 09:51:38'),
(7, 'admin', 'head', 'admin@gmail.com', '09989182612', 'Oak Street', '$2y$10$ci8pgk9xLvGxBsQ8XzQaOuaExeG.GowfSj.EdXl..widX2egW7L8u', 'admin', '2024-10-11 07:54:15'),
(8, 'Chris', 'Belarmino', 'belarmino@gmail.com', '09989182612', 'Oak Street', '$2y$10$lsaAp6eWr.bALH6tlBXODe/F9nTbgIA/EOyh4Wn776kzOe4cs4Ksq', 'client', '2024-10-11 20:54:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
