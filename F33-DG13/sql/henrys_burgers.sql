-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2023 at 04:55 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `henrys_burgers`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `img_src` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `price`, `category`, `image`) VALUES
(1, 'Beef Burger', 'Just a normal beef burger', '7.00', 'burgers', 'beefburger.jpg'),
(2, 'Chicken Burger', 'Just a normal chicken burger', '6.99', 'burgers', 'chickenburger.jpg'),
(3, 'Lamb Burger', 'Just a normal lamb burger', '7.99', 'burgers', 'lambburger.jpg'),
(4, 'Fish Burger', 'Just a normal fish burger', '5.99', 'burgers', 'fishburger.jpg'),
(5, 'Croquette Burger', 'Just a normal croquette burger', '5.99', 'burgers', 'croquetteburger.jpg'),
(6, 'Chicken Katsu Burger', 'Chicken katsu with cabbages dressed in our signature sauce', '4.99', 'burgers', 'katsuburger.jpg'),
(7, 'French Fries', 'Freshly fried fries you will never forget', '3.99', 'sides', 'fries.jpg'),
(8, 'Croquette Pie', 'Hot and crunchy croquette', '3.99', 'sides', 'pie.jpg'),
(9, 'Clam Chowder', 'Creamy goodness', '4.99', 'sides', 'clamchowder.jpg'),
(10, 'Green Salad', 'Going GREEN', '2.99', 'sides', 'salad.jpg'),
(11, 'Cola', 'Refreshing cola to beat the heat', '2.99', 'drinks', 'cola.jpg'),
(12, 'Fanta Grape', 'Grape flavored soft drink with a crisp taste', '2.99', 'drinks', 'fantagrape.jpg'),
(13, 'Ice Lemon Tea', 'Ice-cold tea with lemons', '2.99', 'drinks', 'icelemontea.jpg'),
(14, 'Bottled Water', 'Nothing beats H2O', '1.00', 'drinks', 'water.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `img_src` varchar(255) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `cart_id`, `product_name`, `description`, `price`, `quantity`, `img_src`, `order_date`) VALUES
(1, 1, 1, 'Beef Burger', 'Just a normal beef burger', '7.99', 5, 'pics/beefburger.jpg', '2023-11-05 14:09:14'),
(2, 1, 1, 'French Fries', 'Freshly fried fries you will never forget', '3.99', 5, 'pics/fries.jpg', '2023-11-05 14:09:14'),
(3, 1, 1, 'Cola', 'Refreshing cola to beat the heat', '2.99', 5, 'pics/cola.jpg', '2023-11-05 14:09:14'),
(4, 3, 1, 'Beef Burger', 'Just a normal beef burger', '7.99', 2, 'pics/beefburger.jpg', '2023-11-06 05:00:59'),
(5, 3, 2, 'Beef Burger', 'Just a normal beef burger', '7.00', 2, 'pics/beefburger.jpg', '2023-11-06 05:02:05'),
(6, 3, 3, 'Beef Burger', 'Just a normal beef burger', '7.00', 1, 'pics/beefburger.jpg', '2023-11-06 05:04:32'),
(7, 3, 4, 'French Fries', 'Freshly fried fries you will never forget', '3.99', 2, 'pics/fries.jpg', '2023-11-06 05:41:28'),
(8, 4, 1, 'Chicken Burger', 'Just a normal chicken burger', '6.99', 1, 'pics/chickenburger.jpg', '2023-11-06 12:41:39'),
(9, 4, 1, 'Fish Burger', 'Just a normal fish burger', '5.99', 1, 'pics/fishburger.jpg', '2023-11-06 12:41:39'),
(10, 4, 2, 'Chicken Burger', 'Just a normal chicken burger', '6.99', 6, 'pics/chickenburger.jpg', '2023-11-06 13:30:34'),
(11, 4, 2, 'Fish Burger', 'Just a normal fish burger', '5.99', 4, 'pics/fishburger.jpg', '2023-11-06 13:30:34'),
(12, 4, 2, 'Croquette Burger', 'Just a normal croquette burger', '5.99', 3, 'pics/croquetteburger.jpg', '2023-11-06 13:30:34'),
(13, 4, 3, 'Chicken Burger', 'Just a normal chicken burger', '6.99', 2, 'pics/chickenburger.jpg', '2023-11-06 13:36:20'),
(14, 4, 3, 'Cola', 'Refreshing cola to beat the heat', '2.99', 1, 'pics/cola.jpg', '2023-11-06 13:36:20'),
(15, 4, 4, 'Croquette Pie', 'Hot and crunchy croquette', '3.99', 1, 'pics/pie.jpg', '2023-11-06 13:41:36'),
(16, 4, 4, 'Green Salad', 'Going GREEN', '2.99', 1, 'pics/salad.jpg', '2023-11-06 13:41:36'),
(17, 4, 5, 'Clam Chowder', 'Creamy goodness', '4.99', 1, 'pics/clamchowder.jpg', '2023-11-06 13:44:52'),
(18, 4, 6, 'Bottled Water', 'Nothing beats H2O', '1.00', 1, 'pics/water.jpg', '2023-11-06 13:46:12'),
(19, 4, 7, 'Beef Burger', 'Just a normal beef burger', '7.99', 1, 'pics/beefburger.jpg', '2023-11-06 13:47:41'),
(20, 4, 7, 'French Fries', 'Freshly fried fries you will never forget', '3.99', 1, 'pics/fries.jpg', '2023-11-06 13:47:41'),
(21, 4, 7, 'Croquette Pie', 'Hot and crunchy croquette', '3.99', 1, 'pics/pie.jpg', '2023-11-06 13:47:41'),
(22, 4, 8, 'Croquette Pie', 'Hot and crunchy croquette', '3.99', 1, 'pics/pie.jpg', '2023-11-06 13:54:33'),
(23, 4, 8, 'Cola', 'Refreshing cola to beat the heat', '2.99', 1, 'pics/cola.jpg', '2023-11-06 13:54:33'),
(24, 4, 8, 'Lamb Burger', 'Just a normal lamb burger', '7.99', 1, 'pics/lambburger.jpg', '2023-11-06 13:54:33'),
(25, 4, 9, 'Chicken Katsu Burger', 'Chicken katsu with cabbages dressed in our signature sauce', '4.99', 9, 'pics/katsuburger.jpg', '2023-11-06 14:19:40'),
(26, 4, 10, 'Fish Burger', 'Just a normal fish burger', '5.99', 1, 'pics/fishburger.jpg', '2023-11-06 15:13:58'),
(27, 4, 10, 'Croquette Burger', 'Just a normal croquette burger', '5.99', 1, 'pics/croquetteburger.jpg', '2023-11-06 15:13:58'),
(28, 4, 10, 'Chicken Burger', 'Just a normal chicken burger', '6.99', 1, 'pics/chickenburger.jpg', '2023-11-06 15:13:58'),
(29, 4, 10, 'Beef Burger', 'Just a normal beef burger', '7.99', 1, 'pics/beefburger.jpg', '2023-11-06 15:13:58'),
(30, 4, 10, 'Chicken Katsu Burger', 'Chicken katsu with cabbages dressed in our signature sauce', '4.99', 1, 'pics/katsuburger.jpg', '2023-11-06 15:13:58'),
(31, 4, 10, 'French Fries', 'Freshly fried fries you will never forget', '3.99', 5, 'pics/fries.jpg', '2023-11-06 15:13:58'),
(32, 4, 10, 'Fanta Grape', 'Grape flavored soft drink with a crisp taste', '2.99', 3, 'pics/fantagrape.jpg', '2023-11-06 15:13:58'),
(33, 4, 10, 'Ice Lemon Tea', 'Ice-cold tea with lemons', '2.99', 3, 'pics/icelemontea.jpg', '2023-11-06 15:13:58'),
(34, 3, 5, 'French Fries', 'Freshly fried fries you will never forget', '3.99', 1, 'pics/fries.jpg', '2023-11-07 01:39:57'),
(35, 3, 5, 'Beef Burger', 'Just a normal beef burger', '7.99', 1, 'pics/beefburger.jpg', '2023-11-07 01:39:57'),
(36, 8, 1, 'French Fries', 'Freshly fried fries you will never forget', '3.99', 1, 'pics/fries.jpg', '2023-11-07 02:05:39'),
(37, 3, 6, 'French Fries', 'Freshly fried fries you will never forget', '3.99', 2, 'pics/fries.jpg', '2023-11-07 03:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', '$2y$10$1.hbwleouuBC8wsEOAntfOhvJZHhjWWkIQI8m6TzCCUGG/J7dzgNm'),
(2, 'wang@gmail.com', '$2y$10$BVuc/8/8D8fOFbHuBgd4yuS5tOjO865OZQigFIDwUsQex2MjM2HM.'),
(3, 'alex@alex.com', '$2y$10$ZhtMUlKigHCtCYoOjf6PHuw7oThgyX04y2QmpbXOKBPjmZyqVUe6u'),
(4, 'maba@gmail.com', '$2y$10$RmKcS8G4UQOsxQDknM8qT.zfgEEVjAfAsvKVImLBsGYTWe0rrYzZC'),
(5, 'ben@gmail.co.uk', '$2y$10$2W9fvx.zVoosKRmQrAuzOeqWUl0edwtmDkl2ykdDxbW.v27JimHbS'),
(6, 'we@gmail', '$2y$10$qlpeEw1a3KtxEq8P.yzfqOo2zy8hE4tqi3MckhLeNaYLdNROGnE46'),
(7, 'test@gmail.co.uk.sg', '$2y$10$rkAwGqt6RRzITCjfBv2LbOYSpuIAI1sCXqPJGnbnAvTczJu8O5Dg2'),
(8, 'david@david.com', '$2y$10$WmbcLgcqHUH.ELerBSng.ubCrvzO0UqlfwEypMF2pODWYWwiKqsH.'),
(9, 'john@gmail.com', '$2y$10$e2gPRBV.9tEHba4wxpCi..yva.19CfYG0Ky0Nr9rMXIkadobAPALS');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `email`, `name`, `contact`, `address`) VALUES
(1, 'admin@admin.com', 'admin', '00000000', 'admin'),
(2, 'wang@gmail.com', 'Henry Chen', '97150650', 'ewewewewe'),
(3, 'alex@alex.com', 'Alex', '11111111', '11111111'),
(4, 'maba@gmail.com', 'Ameerul', '98765432', '123 Nanyang Road, #03-248'),
(5, 'ben@gmail.co.uk', 'Ben', '88889999', '312 Oxley Road'),
(6, 'we@gmail', 'Frank', '132131313', '312 Oxley Road'),
(7, 'test@gmail.co.uk.sg', 'Sam', '98765432', '567 Oxley Road'),
(8, 'david@david.com', 'David', '12345678', 'david123'),
(9, 'john@gmail.com', 'john', '12345678', 'david123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
