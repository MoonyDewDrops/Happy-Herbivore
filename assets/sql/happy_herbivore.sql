-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2025 at 10:28 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `happy_herbivore`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Breakfast', 'Breakfast'),
(2, 'Lunch & Dinner', 'Lunch & Dinner'),
(3, 'Sides', 'Sides'),
(4, 'Snacks', 'Snacks'),
(5, 'Dips', 'Dips'),
(6, 'Drinks', 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `filename`, `description`) VALUES
(1, 'breakfast1.webp', 'Breakfast item 1'),
(2, 'breakfast2.webp', 'Breakfast item 2'),
(3, 'breakfast3.webp', 'Breakfast item 3'),
(4, 'lunch&dinner1.webp', 'Lunch & Dinner item 1'),
(5, 'lunch&dinner2.webp', 'Lunch & Dinner item 2'),
(6, 'lunch&dinner3.webp', 'Lunch & Dinner item 3'),
(7, 'sides1.webp', 'Sides item 1'),
(8, 'sides2.webp', 'Sides item 2'),
(9, 'sides3.webp', 'Sides item 3'),
(10, 'sides4.webp', 'Sides item 4'),
(11, 'snacks1.webp', 'Snacks item 1'),
(12, 'snacks2.webp', 'Snacks item 2'),
(13, 'snacks3.webp', 'Snacks item 3'),
(14, 'snacks4.webp', 'Snacks item 4'),
(15, 'snacks5.webp', 'Snacks item 5'),
(16, 'snacks6.webp', 'Snacks item 6'),
(17, 'snacks7webp', 'Snacks item 7'),
(18, 'dips1.webp', 'Dips item 1'),
(19, 'dips2.webp', 'Dips item 2'),
(20, 'dips3.webp', 'Dips item 3'),
(21, 'dips4.webp', 'Dips item 4'),
(22, 'dips5.webp', 'Dips item 5'),
(23, 'dips6.webp', 'Dips item 6'),
(24, 'dips7.webp', 'Dips item 7'),
(25, 'drinks1.webp', 'Drink item 1'),
(26, 'drinks2.webp', 'Drink item 2'),
(27, 'drinks3.webp', 'Drink item 3'),
(28, 'drinks4.webp', 'Drink item 4'),
(29, 'drinks5.webp', 'Drink item 5');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `order_status_id` int NOT NULL,
  `pickup_number` tinyint NOT NULL,
  `price` decimal(25,0) NOT NULL,
  `datetime` datetime NOT NULL,
  `ordered_product` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` decimal(25,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `description`) VALUES
(1, 'Start order'),
(2, 'Placed and paid'),
(3, 'Preparing'),
(4, 'Ready for pickup'),
(5, 'Picked up');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  `image_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` decimal(25,0) NOT NULL,
  `kcal` varchar(25) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `image_id`, `name`, `description`, `price`, `kcal`, `available`) VALUES
(1, 1, 1, 'Morning Boost Smoothie Bowl', 'A blend of acai, banana, and mixed berries topped with granola, chia seeds, and coconut flakes.', '5', '300', 1),
(2, 1, 2, 'Eggcellent Wrap', 'Whole-grain wrap filled with scrambled eggs, spinach, and a light yogurt-based sauce.', '4', '250', 1),
(3, 1, 3, 'Peanut Butter Power Toast', 'Whole-grain toast with natural peanut butter and banana slices.', '3', '220', 1),
(4, 2, 4, 'Protein-Packed Bowl', 'Quinoa, grilled tofu, roasted vegetables, and a tahini dressing.', '6', '450', 1),
(5, 2, 5, 'Supergreen Salad', 'Kale, spinach, avocado, edamame, cucumber, and a lemon-olive oil vinaigrette.', '5', '300', 1),
(6, 2, 6, 'Zesty Chickpea Wrap', 'Whole-grain wrap with spiced chickpeas, shredded carrots, lettuce, and hummus.', '5', '400', 1),
(7, 3, 7, 'Sweet Potato Wedges', 'Oven-baked sweet potato wedges seasoned with paprika and a touch of olive oil.', '4', '250', 1),
(8, 3, 8, 'Quinoa Salad Cup', 'Mini cup of quinoa mixed with cucumber, cherry tomatoes, parsley, and lemon dressing.', '3', '200 ', 1),
(9, 3, 9, 'Mini Veggie Platter', 'A selection of carrot sticks, celery, cucumber slices, and cherry tomatoes served with a dip of your choice.', '3', '150 ', 1),
(10, 3, 10, 'Brown Rice & Edamame Bowl', 'A small portion of brown rice topped with steamed edamame and a drizzle of soy sauce.', '4', '300 ', 1),
(11, 4, 11, 'Roasted Chickpeas (Spicy or Herb)', 'Crunchy roasted chickpeas with your choice of spicy paprika or herb seasoning.', '3', '180 ', 1),
(12, 4, 12, 'Trail Mix Cup', 'A mix of nuts, dried fruits, and seeds for an energy boost.', '2', '200 ', 1),
(13, 4, 13, 'Chia Pudding Cup', 'Creamy chia pudding made with almond milk and topped with fresh fruit.', '3', '250 ', 1),
(14, 4, 14, 'Baked Falafel Bites (4 pcs)', 'Baked falafel balls served with a dip of your choice.', '4', '220', 1),
(15, 4, 15, 'Mini Whole-Grain Breadsticks', 'Crisp, wholesome breadsticks perfect for pairing with hummus or salsa.', '2', '150 ', 1),
(16, 4, 16, 'Apple & Cinnamon Chips', 'Baked apple slices lightly dusted with cinnamon.', '3', '100 ', 1),
(17, 4, 17, 'Zucchini Fries', 'Baked zucchini sticks coated in a light breadcrumb crust.', '3', '180 ', 1),
(18, 5, 18, 'Classic Hummus', '', '1', '70 ', 1),
(19, 5, 19, 'Avocado Lime Dip', '', '1', '80 ', 1),
(20, 5, 20, 'Greek Yogurt Ranch', '', '1', '50 ', 1),
(21, 5, 21, 'Spicy Sriracha Mayo', '', '1', '60 ', 1),
(22, 5, 22, 'Garlic Tahini Sauce', '', '1', '90 ', 1),
(23, 5, 23, 'Zesty Tomato Salsa', '', '1', '20', 1),
(24, 5, 24, 'Peanut Dipping Sauce', '', '1', '100 ', 1),
(25, 6, 25, 'Green Glow Smoothie', 'Spinach, pineapple, cucumber, and coconut water.', '4', '120', 1),
(26, 6, 26, 'Iced Matcha Latte', 'Lightly sweetened matcha green tea with almond milk.', '3', '90', 1),
(27, 6, 27, 'Fruit-Infused Water', 'Freshly infused water with a choice of lemon-mint, strawberry-basil, or cucumber-lime.', '2', '0', 1),
(28, 6, 21, 'Berry Blast Smoothie', 'A creamy blend of strawberries, blueberries, and raspberries with almond milk.', '4', '140 ', 1),
(29, 6, 29, 'Citrus Cooler', 'A refreshing mix of orange juice, sparkling water, and a hint of lime.', '3', '90 ', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `Constraint_FK_order_status` (`order_status_id`),
  ADD KEY `ordered_item` (`ordered_product`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `Constraint_FK_product` (`product_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `Constraint_FK_image` (`image_id`),
  ADD KEY `Constraint_FK_category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Constraint_FK_order_status` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`order_status_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `ordered_item` FOREIGN KEY (`ordered_product`) REFERENCES `order_product` (`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `Constraint_FK_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Constraint_FK_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Constraint_FK_image` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
