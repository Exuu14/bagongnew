-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 07:24 PM
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
-- Database: `street_style`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('Credit/Debit Card','GCash','Cash on Delivery') NOT NULL,
  `status` enum('Pending','Processing','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `id`, `total_amount`, `payment_method`, `status`, `created_at`) VALUES
(1, 1, 43.00, 'GCash', 'Pending', '2025-05-26 16:52:28'),
(2, 1, 20.00, 'Credit/Debit Card', 'Pending', '2025-05-26 17:03:42'),
(3, 1, 25.89, 'Credit/Debit Card', 'Pending', '2025-05-26 17:17:10'),
(4, 1, 44.97, 'Cash on Delivery', 'Pending', '2025-05-26 17:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 23.00),
(2, 1, 3, 2, 10.00),
(3, 2, 3, 2, 10.00),
(4, 3, 11, 2, 5.45),
(5, 3, 10, 1, 14.99),
(6, 4, 10, 3, 14.99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `image`, `created_at`) VALUES
(1, 'Baggy Jeans', 23.00, 'images/model1.jpg', '2025-05-26 16:17:53'),
(2, 'Ripped Jeans', 14.59, 'images/Ripped.jpg', '2025-05-26 16:17:53'),
(3, 'Strap Shirt', 10.00, 'images/model3.jpg', '2025-05-26 16:17:53'),
(4, 'Gray Shirt', 7.59, 'images/model4a.jpg', '2025-05-26 16:17:53'),
(5, 'Hoodie', 7.00, 'images/hoodie.jpg', '2025-05-26 16:17:53'),
(6, 'Plain Black Shirt', 2.00, 'images/gongyo.jpg', '2025-05-26 16:17:53'),
(7, 'Sando', 4.99, 'images/cha.jpg', '2025-05-26 16:17:53'),
(8, 'Windbreaker', 7.35, 'images/parkbogum.jpg', '2025-05-26 16:17:53'),
(9, 'Summer Style Jeans', 20.00, 'images/haerin.jpg', '2025-05-26 16:17:53'),
(10, 'Jumpsuit', 14.99, 'images/karina.jpg', '2025-05-26 16:17:53'),
(11, 'Crop Top', 5.45, 'images/mica.jpg', '2025-05-26 16:17:53'),
(12, 'Gray & White Tank Top', 7.59, 'images/hanni.jpg', '2025-05-26 16:17:53'),
(13, 'Sweater Set', 15.54, 'images/momo.jpg', '2025-05-26 16:17:53'),
(14, 'Polo Shirt', 8.69, 'images/vanessa.jpg', '2025-05-26 16:17:53'),
(15, 'Tambay Cap', 7.80, 'images/winter.jpg', '2025-05-26 16:17:53'),
(16, 'Cuddle Sweater', 7.00, 'images/chaewon.jpg', '2025-05-26 16:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'jazel lyka ', 'Pore', 'lyka pore', 'lil.north123@gmail.com', '$2y$10$GE5dAqWk/ik2C3kxr2C41uQNTny2HSrBPdgIPkzhtec3rmmXZFnYu', '2025-05-26 15:27:16'),
(2, 'arby', 'paloga', 'arby123', 'arby@gmail.com', '$2y$10$lO3rwsdEpriUKJ0sfHqb4e8wpbPiLbAQpiOcz4AxNBE73GojF2zmi', '2025-05-26 17:19:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
