-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 05, 2023 at 10:21 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_machineproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`id`, `name`, `username`, `password`) VALUES
(1211, 'Ronn Parcia', 'rparcia', 'par1234'),
(1212, 'Ralph Bucal', 'rbucal', 'buc1234'),
(1213, 'Andrew Gonzales', 'agonzales', 'gon1234'),
(1214, 'John Gokongwei', 'jgokongwei', 'gok1234');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_name`) VALUES
('Drinks'),
('Mains'),
('Sides');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combos`
--

CREATE TABLE `tbl_combos` (
  `combo_id` int(11) NOT NULL,
  `combo_name` varchar(100) NOT NULL,
  `main_item_id` int(11) DEFAULT NULL,
  `side_item_id` int(11) DEFAULT NULL,
  `drink_item_id` int(11) DEFAULT NULL,
  `discount_pct` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_combos`
--

INSERT INTO `tbl_combos` (`combo_id`, `combo_name`, `main_item_id`, `side_item_id`, `drink_item_id`, `discount_pct`) VALUES
(1, 'Chicken Mash Tea Combo', 3, 5, 7, 0.1),
(2, 'Steak Veg Beer Combo', 1, 6, 8, 0.15),
(12, 'Steak Bake Tea', 1, 4, 7, 0.5),
(14, 'Healthy', 2, 6, 9, 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `inventory_qty` int(11) NOT NULL DEFAULT 100,
  `image_url` varchar(255) DEFAULT 'https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`item_id`, `item_name`, `category_name`, `price`, `inventory_qty`, `image_url`) VALUES
(1, 'Steak', 'Mains', 900, 78, 'https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/steak.png'),
(2, 'Salmon', 'Mains', 850, 79, 'https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/salmon.png'),
(3, 'Chicken', 'Mains', 500, 71, 'https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/chicken.png'),
(4, 'Baked Potato', 'Sides', 80, 95, 'https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/baked-potato.png'),
(5, 'Mashed Potato', 'Sides', 75, 30, 'https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/mashed-potato.png'),
(6, 'Steamed Veggies', 'Sides', 50, 70, 'https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/steamed-vegetables.png'),
(7, 'Iced Tea', 'Drinks', 55, 70, 'https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/iced-tea.png'),
(8, 'Root Beer', 'Drinks', 60, 97, 'https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/root-beer.png'),
(9, 'Water', 'Drinks', 25, 88, 'https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/water.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `customer_name` varchar(100) NOT NULL,
  `main_id` int(11) DEFAULT NULL,
  `main_qty` int(11) NOT NULL,
  `side_id` int(11) DEFAULT NULL,
  `side_qty` int(11) NOT NULL,
  `drink_id` int(11) DEFAULT NULL,
  `drink_qty` int(11) NOT NULL,
  `initial_total_price` float NOT NULL,
  `discount` float NOT NULL,
  `discounted_total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `order_date`, `customer_name`, `main_id`, `main_qty`, `side_id`, `side_qty`, `drink_id`, `drink_qty`, `initial_total_price`, `discount`, `discounted_total_price`) VALUES
(1, '2023-06-24', 'Ronn Parcia', 2, 1, 6, 1, 7, 1, 955, 0, 955),
(2, '2023-06-24', 'Henry', 1, 1, 6, 4, 8, 2, 1220, 183, 1037),
(3, '2023-06-24', 'Ronn Parcia', 1, 3, 4, 2, 7, 1, 2915, 0, 2915),
(4, '2023-06-24', 'Br. Bloemen', 3, 1, 5, 2, 9, 3, 510, 0, 510),
(5, '2023-06-24', 'Adele', 3, 3, 5, 1, 7, 2, 1085, 108.5, 976.5),
(6, '2023-06-24', 'Adele', 3, 3, 5, 1, 7, 2, 1085, 108.5, 976.5),
(7, '2023-06-24', 'Beyonce', 3, 1, 5, 1, 8, 1, 435, 0, 435),
(8, '2023-06-24', 'John', 1, 1, 6, 1, 8, 1, 1010, 151.5, 858.5),
(9, '2023-06-24', 'Ralph', 3, 1, 5, 2, 7, 10, 1000, 100, 900),
(10, '2023-06-24', 'Wonwoo', 3, 1, 5, 1, 7, 1, 430, 43, 387),
(11, '2023-06-24', 'Mitski', 1, 3, 6, 2, 8, 2, 2920, 438, 2482),
(12, '2023-06-24', 'Tina Turner', 3, 2, 5, 1, 7, 2, 785, 78.5, 706.5),
(13, '2023-06-24', 'Joseph Hall', 2, 1, 6, 1, 7, 2, 1010, 0, 1010),
(14, '2023-06-24', 'Rizal Park', 1, 1, 6, 1, 8, 1, 1010, 151.5, 858.5),
(15, '2023-06-24', 'Miguel Hall', 3, 6, 6, 12, 9, 18, 2760, 0, 2760),
(16, '2023-06-24', 'Juan dela Cruz', 3, 1, 6, 2, 9, 3, 460, 0, 460),
(17, '2023-06-24', 'Maria Clara', 1, 2, 6, 1, 8, 3, 2030, 304.5, 1725.5),
(18, '2023-06-24', 'Grogu', 3, 1, 6, 1, 9, 10, 550, 0, 550),
(19, '2023-06-24', 'Ronn', 2, 3, 4, 2, 8, 3, 2890, 0, 2890),
(20, '2023-06-24', 'Mayaman', 2, 10, 5, 20, 9, 30, 10600, 0, 10600),
(22, '2023-06-24', 'Ralph', 1, 1, 5, 1, 9, 1, 995, 0, 995),
(23, '2023-06-24', 'Ronaldo', 3, 1, 5, 20, 7, 1, 1855, 185.5, 1669.5),
(24, '2023-06-26', 'Charles', 1, 2, 6, 3, 9, 2, 1990, 0, 1990),
(25, '2023-06-26', 'Ronn Parcia', 1, 2, 5, 4, 8, 4, 2340, 0, 2340),
(26, '2023-06-26', 'Adele', 3, 2, 5, 4, 7, 2, 1010, 101, 909),
(27, '2023-06-26', 'Beyonce', 1, 1, 6, 1, 8, 1, 1010, 151.5, 858.5),
(28, '2023-06-29', 'Ramon', 2, 2, 5, 1, 9, 1, 1795, 0, 1795),
(30, '2023-07-23', 'Ronn Parcia', 3, 1, 5, 1, 7, 1, 430, 43, 387),
(32, '2023-07-24', 'Ralph', 1, 4, 6, 1, 8, 1, 3710, 556.5, 3153.5),
(34, '2023-07-25', 'Rosalie', 2, 5, 5, 3, 9, 2, 4515, 0, 4515),
(35, '2023-07-25', 'Allysa', 1, 2, 6, 3, 8, 2, 2070, 310.5, 1759.5),
(36, '2023-07-25', 'Julienne', 3, 4, 5, 6, 7, 4, 2670, 267, 2403);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_name`);

--
-- Indexes for table `tbl_combos`
--
ALTER TABLE `tbl_combos`
  ADD PRIMARY KEY (`combo_id`),
  ADD KEY `fk_combos_items_main` (`main_item_id`),
  ADD KEY `fk_combos_items_side` (`side_item_id`),
  ADD KEY `fk_combos_item_drink` (`drink_item_id`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_items_categories` (`category_name`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_orders_items_main` (`main_id`),
  ADD KEY `fk_orders_items_side` (`side_id`),
  ADD KEY `fk_orders_items_drink` (`drink_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1215;

--
-- AUTO_INCREMENT for table `tbl_combos`
--
ALTER TABLE `tbl_combos`
  MODIFY `combo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_combos`
--
ALTER TABLE `tbl_combos`
  ADD CONSTRAINT `fk_combos_item_drink` FOREIGN KEY (`drink_item_id`) REFERENCES `tbl_items` (`item_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_combos_items_main` FOREIGN KEY (`main_item_id`) REFERENCES `tbl_items` (`item_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_combos_items_side` FOREIGN KEY (`side_item_id`) REFERENCES `tbl_items` (`item_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD CONSTRAINT `fk_items_categories` FOREIGN KEY (`category_name`) REFERENCES `tbl_categories` (`category_name`);

--
-- Constraints for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `fk_orders_items_drink` FOREIGN KEY (`drink_id`) REFERENCES `tbl_items` (`item_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_orders_items_main` FOREIGN KEY (`main_id`) REFERENCES `tbl_items` (`item_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_orders_items_side` FOREIGN KEY (`side_id`) REFERENCES `tbl_items` (`item_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
