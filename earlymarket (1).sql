 -- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2022 at 07:08 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earlymarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_id` varchar(30) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_id`, `cat_name`, `date_created`) VALUES
(1, '5859834', 'Mobile Phones', '2022-08-29 15:53:02'),
(2, '4377853', 'Computers', '2022-08-29 15:53:28'),
(3, '1536579', 'Fashion', '2022-08-29 15:53:34'),
(4, '7278861', 'Home Appliances', '2022-08-29 15:53:51'),
(5, '8909927', 'Gaming', '2022-08-29 16:02:51'),
(7, '3632647', 'Photography', '2022-08-29 16:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `cat_id` varchar(30) NOT NULL,
  `sub_id` varchar(30) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` varchar(100) NOT NULL,
  `stock` varchar(50) NOT NULL,
  `descr` varchar(2000) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `cat_id`, `sub_id`, `title`, `price`, `stock`, `descr`, `date_created`) VALUES
(2, '42663639', '8909927', '8096679', 'Playstation 5', '300000', '12', 'Very good game', '2022-08-29 17:05:05'),
(4, '38832973', '3632647', '6659780', 'Video', '3000000', '2', 'Good', '2022-08-30 15:31:09'),
(5, '38832973', '3632647', '6659780', 'Video', '3000000', '2', 'Good', '2022-08-30 15:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `product_id` varchar(30) NOT NULL,
  `image_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image_name`) VALUES
(1, '42663639', '1661877165.jpg'),
(2, '42663639', '1661877211.jpg'),
(3, '42663639', '1661877235.jpg'),
(4, '38832973', '1661877961.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `cat_id` varchar(30) NOT NULL,
  `sub_id` varchar(30) NOT NULL,
  `sub_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `cat_id`, `sub_id`, `sub_name`) VALUES
(1, '8909927', '8096679', 'Playstation'),
(2, '8909927', '7844470', 'X Box'),
(3, '8909927', '4482943', 'Sega'),
(4, '8909927', '3894909', 'Nintendo'),
(5, '7278861', '3592103', 'Pots'),
(6, '3632647', '6659780', 'Camera');

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `order_stats` varchar(5) NOT NULL,
  `date_proccessed` varchar(19) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `email` varchar(300) NOT NULL,
  `passwords` varchar(300) NOT NULL,
  `prof_pic` varchar(100) NOT NULL,
  `user_role` varchar(10) NOT NULL,
  `password_reset` varchar(10) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `email`, `passwords`, `prof_pic`, `user_role`, `password_reset`, `date_created`) VALUES
(1, 'Chris', 'Graham', '+2348124423122', 'admin@gmail.com', '$2y$10$XS6iNHvvJxLeHNEMdzUQxOpH8ISLsixaiztFQhl7.1hN/Me7Fxncu', '', 'admin', '', '2022-08-20'),
(3, 'Chris', 'Graham', '+2348124423122', 'chrisgraham2625@gmail.com', '$2y$10$5lI3x.NgLTSV4fYlH.CgFuSb9PJgzRSN9VUdUf5c8Epw2heHJsKGW', 'profile3.jpg', 'user', '', '2022-08-20'),
(6, 'John', 'Doe', '09017196914', 'tester@gmail.com', '$2y$10$dFI3LoxVSMOQcWMCILU1dec3SEyVpEcSuj.Twb1rtiYD0LkTqbCMq', 'profile6.jpg', 'user', '', '2022-08-22'),
(7, 'Emmanuel', 'Odobo', '08124423122', 'emmanuelodobo10@gmail.com', '$2y$10$a4Nypd2hpWlOtnLL7pDf5eh2cfSqmW5TqEOUwMWmeJUfW.Clt4uZi', '', 'user', '', '2022-08-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
