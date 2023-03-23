-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 23, 2023 at 02:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercesignup`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessocategories`
--
-- Error reading structure for table ecommercesignup.accessocategories: #1932 - Table 'ecommercesignup.accessocategories' doesn't exist in engine
-- Error reading data for table ecommercesignup.accessocategories: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `ecommercesignup`.`accessocategories`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `accesso_categories`
--

CREATE TABLE `accesso_categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL,
  `category_img` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accesso_categories`
--

INSERT INTO `accesso_categories` (`category_id`, `category_title`, `category_img`) VALUES
(1, 'Aquarium', ''),
(2, 'Spade', ''),
(3, 'Spade', 0x43617563757320496e7669746174696f6e2e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_user` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_user`, `admin_pass`) VALUES
('bulacanpetfish', '$2y$10$i5FiainnfFLXSBR4oiiitusgxEaBJfpUOeDYazlpzR2Ui/HevTMcu'),
('bulacanpetfish', 'BulacanPetFish2020');

-- --------------------------------------------------------

--
-- Table structure for table `aquarium_categories`
--

CREATE TABLE `aquarium_categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL,
  `category_img` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aquarium_categories`
--

INSERT INTO `aquarium_categories` (`category_id`, `category_title`, `category_img`) VALUES
(1, 'Aquarium', 0x7175696e6f2d616c2d4c637934546a706d3233592d756e73706c6173682e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `cart_details_id` int(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_img` blob NOT NULL,
  `quantity` int(255) NOT NULL,
  `selected_price` int(100) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`product_id`, `cart_details_id`, `ip_address`, `product_title`, `product_img`, `quantity`, `selected_price`, `userId`) VALUES
(10, 30, '::1', 'Clown Fish', 0x636c6f776e2d666973682e6a7067, 1, 160, 16);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL,
  `category_img` mediumblob DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`, `category_img`, `date_added`) VALUES
(27, 'Fishes', 0x506c616365686f6c646572312e706e67, '2022-08-24 08:19:48'),
(29, 'Aquarium', 0x417175617269756d2e6a7067, '2022-10-17 11:08:26'),
(30, 'Accessories', 0x666973682d6e65742e6a7067, '2022-10-27 07:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `completed_orders`
--

CREATE TABLE `completed_orders` (
  `user_id` int(11) NOT NULL,
  `order_id` int(255) NOT NULL,
  `completed_orders_id` int(255) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `delivered_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL,
  `shipping_fee` int(11) NOT NULL,
  `order_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `completed_orders`
--

INSERT INTO `completed_orders` (`user_id`, `order_id`, `completed_orders_id`, `amount_due`, `invoice_number`, `total_products`, `delivered_date`, `order_status`, `shipping_fee`, `order_type`) VALUES
(16, 155, 18, 136, 2061271024, 3, '2023-03-21 13:11:29', 'Delivered', 20, 'Wholesale');

-- --------------------------------------------------------

--
-- Table structure for table `completed_order_products`
--

CREATE TABLE `completed_order_products` (
  `order_id` int(11) NOT NULL,
  `user_order_products_id` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_img` blob NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `selected_price` int(100) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `completed_order_products`
--

INSERT INTO `completed_order_products` (`order_id`, `user_order_products_id`, `product_id`, `product_title`, `product_img`, `ip_address`, `quantity`, `selected_price`, `userId`) VALUES
(154, 42, 15, 'Flower Horn', 0x666c6f776572686f726e2e6a7067, '::1', 1, 19, 16),
(155, 43, 15, 'Flower Horn', 0x666c6f776572686f726e2e6a7067, '::1', 1, 19, 16),
(154, 44, 10, 'Clown Fish', 0x636c6f776e2d666973682e6a7067, '::1', 1, 111, 16),
(155, 45, 10, 'Clown Fish', 0x636c6f776e2d666973682e6a7067, '::1', 1, 111, 16),
(154, 46, 13, 'Molly', 0x62657474612e6a7067, '::1', 1, 6, 16),
(155, 47, 13, 'Molly', 0x62657474612e6a7067, '::1', 1, 6, 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_categ` varchar(255) NOT NULL,
  `retail_price` varchar(100) NOT NULL,
  `wholesale_price` varchar(100) NOT NULL,
  `stock_no` int(100) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_img` blob NOT NULL,
  `category_id` int(255) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_categ`, `retail_price`, `wholesale_price`, `stock_no`, `product_desc`, `product_img`, `category_id`, `date_added`, `status`, `category_title`) VALUES
(9, 'Betta Fish', '27', '150', '100', 3, 'Betta Fish', 0x62657474612e6a7067, NULL, '2023-03-21 12:41:50', '', ''),
(10, 'Clown Fish', '27', '160', '111', 46, 'Clown Fish', 0x636c6f776e2d666973682e6a7067, NULL, '2023-03-21 13:08:47', '', ''),
(13, 'Molly', '27', '12', '6', 0, 'Lorem epsum. Etc. Fish. ', 0x62657474612e6a7067, NULL, '2023-03-21 13:08:47', '', ''),
(14, 'Angel Fish', '27', '99', '89', 44, 'Let\'s go', 0x416e67656c666973682e6a7067, NULL, '2023-03-21 12:44:17', '', ''),
(15, 'Flower Horn', '27', '20', '19', 191, 'Let\'s go', 0x666c6f776572686f726e2e6a7067, NULL, '2023-03-21 13:08:47', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersFirstName` varchar(128) NOT NULL,
  `usersLastName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `user_contact` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_brgy` varchar(100) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `user_postal` varchar(100) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `vkey` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersFirstName`, `usersLastName`, `usersEmail`, `user_contact`, `user_address`, `user_brgy`, `user_city`, `user_postal`, `usersUid`, `usersPwd`, `vkey`) VALUES
(16, 'Bulacan', 'Pet Fish', 'bulacanpetfishsupply@gmail.com', '09451258011', '396 Sto. Domingo Street, CSJDM, Bulacan', 'Fatima I', 'CSDJM', '3024', 'bulacanpetfish', '$2y$10$iUZW5Z9zFgP/a9FP9NafieVndXDhmcOK/Qzc7HZ6tYcPESuvGazBa', NULL),
(41, 'John', 'Duka', 'johnduka21@gmail.com', '0', '', '', '', '', 'johnduka21', '$2y$10$PsrGubUE725525PxihGiwufMbj9ukEtko7LWytTJ8zfD17vCs5kbu', 'd66f0a7d2f24506c5947173acf508625'),
(49, 'John', 'Duka', 'dukadukss@gmail.com', '12121212121', '396 Sto. Domingo', 'Fatima I', 'CSDJM', '3024', '19002336200', '$2y$10$iLyOpvhl7.MUu1ej3pHBaOsR5h779VRb.m.xwR/RlF/tQeI.wrrqC', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL,
  `shipping_fee` int(11) NOT NULL,
  `order_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`, `shipping_fee`, `order_type`) VALUES
(154, 16, 89, 1366862894, 1, '2023-03-21 13:15:46', 'Pending', 20, 'Wholesale');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders_products`
--

CREATE TABLE `user_orders_products` (
  `order_id` int(11) NOT NULL,
  `user_order_products_id` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_img` blob NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `selected_price` int(100) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_orders_products`
--

INSERT INTO `user_orders_products` (`order_id`, `user_order_products_id`, `product_id`, `product_title`, `product_img`, `ip_address`, `quantity`, `selected_price`, `userId`) VALUES
(154, 70, 14, 'Angel Fish', 0x416e67656c666973682e6a7067, '::1', 1, 89, 16);

-- --------------------------------------------------------

--
-- Table structure for table `wholesale`
--

CREATE TABLE `wholesale` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `selected_price` int(100) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wholesale_cart`
--

CREATE TABLE `wholesale_cart` (
  `product_id` int(11) NOT NULL,
  `cart_details_id` int(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_img` blob NOT NULL,
  `quantity` int(11) NOT NULL,
  `selected_price` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesso_categories`
--
ALTER TABLE `accesso_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `aquarium_categories`
--
ALTER TABLE `aquarium_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_details_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `completed_orders`
--
ALTER TABLE `completed_orders`
  ADD PRIMARY KEY (`completed_orders_id`);

--
-- Indexes for table `completed_order_products`
--
ALTER TABLE `completed_order_products`
  ADD PRIMARY KEY (`user_order_products_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_orders_products`
--
ALTER TABLE `user_orders_products`
  ADD PRIMARY KEY (`user_order_products_id`);

--
-- Indexes for table `wholesale`
--
ALTER TABLE `wholesale`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `wholesale_cart`
--
ALTER TABLE `wholesale_cart`
  ADD PRIMARY KEY (`cart_details_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesso_categories`
--
ALTER TABLE `accesso_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aquarium_categories`
--
ALTER TABLE `aquarium_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `cart_details_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `completed_orders`
--
ALTER TABLE `completed_orders`
  MODIFY `completed_orders_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `completed_order_products`
--
ALTER TABLE `completed_order_products`
  MODIFY `user_order_products_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `user_orders_products`
--
ALTER TABLE `user_orders_products`
  MODIFY `user_order_products_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `wholesale_cart`
--
ALTER TABLE `wholesale_cart`
  MODIFY `cart_details_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
