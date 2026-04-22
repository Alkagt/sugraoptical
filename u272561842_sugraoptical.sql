-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2026 at 11:57 AM
-- Server version: 11.8.6-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u272561842_sugraoptical`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `category_description` longtext NOT NULL,
  `status` enum('1') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_slug`, `category_image`, `category_description`, `status`, `created_at`, `updated_at`) VALUES
(56, 'Trial Lens Set', 'trial-lens-set', '1773730923_tls.webp', '<p>Welcome to IndoSurgicals Private Limited, the largest and most trusted <strong>manufacturer, supplier, and exporter of top-quality Diagnostic Equipments</strong>. Our extensive product range covers a wide array of essential medical devices, ensuring that healthcare professionals have access to the best tools for accurate diagnostics.</p>\r\n<p>Among our offerings are high-quality&nbsp;<strong>Stethoscopes</strong>, <strong>BP Monitors or Sphygmomanometers</strong>, <strong>Laryngoscopes</strong>, <strong>Medical Reflex Hammers</strong>, <strong>ECG Machines</strong>, <strong>Fetal Dopplers &amp; Monitors</strong>, <strong>Patient Monitors</strong>, <strong>Pulse Oximeters</strong>, <strong>Tongue Depressors</strong>, <strong>Otoscopes</strong>, <strong>Ophthalmoscopes</strong>, <strong>Trial Lens Sets</strong>, <strong>Schiotz Tonometers</strong>, <strong>Tuning Forks</strong>, <strong>Goniometers</strong>, <strong>Nebulizers</strong>, <strong>Thermometers</strong>, <strong>Glucometers</strong>, <strong>Peak Flow Meters</strong>, <strong>Aero Spacers</strong>, and more.&nbsp;</p>\r\n<p>At IndoSurgicals, we prioritize the quality and reliability of our products. We adhere to&nbsp;<strong>stringent manufacturing standards</strong> and conduct rigorous quality checks to ensure that <strong>every piece of equipment meets and exceeds industry expectations</strong>. Our Diagnostic Equipments are designed to deliver accurate results, enhancing the precision and efficiency of diagnostic procedures.</p>\r\n<p>With IndoSurgicals, you can trust that you are getting superior diagnostic devices that&nbsp;<strong>healthcare professionals rely on worldwide</strong>. Experience the difference in quality, performance, and durability with our top-of-the-line Diagnostic Equipments. Contact us today to learn more about our products or to place an order.</p>\r\n<p>Please send your Diagnostic Equipment requirement with quantity at <a href=\"mailto:info@indosurgicals.com\">info@indosurgicals.com</a> so that we can provide you our best CIF/C&amp;F prices.</p>\r\n<p>&nbsp;</p>', '1', '2026-03-25 08:23:27', '0000-00-00 00:00:00'),
(58, 'Auto Refractometers', 'auto-refractometers', '1773730881_Ophthalmic.webp', '<p><em>Just for testig</em></p>', '1', '2026-03-25 08:23:55', '0000-00-00 00:00:00'),
(59, 'Optical Instruments', 'optical-instruments', '1774252622_55.webp', '<p><strong>This is a Optical Instruments category.&nbsp;</strong></p>', '1', '2026-03-25 06:57:58', '0000-00-00 00:00:00'),
(60, 'test', 'test', '1774253716_trial-frame-child-1.webp', '<p><strong><img src=\"assets/uploads/1774427209_computer-img.png\" alt=\"\"></strong></p>\r\n<p><strong><img src=\"assets/uploads/1774427286_trial-lens-set-RB-SAGWAN-WOOD-scaled.webp\" alt=\"\" width=\"800\" height=\"600\"></strong></p>\r\n<ol>\r\n<li><strong>fdsdf</strong></li>\r\n<li><strong>vbcvbvc</strong></li>\r\n<li><strong>dfdfds</strong></li>\r\n<li><strong>xvxcv</strong></li>\r\n<li><strong>cvcx</strong></li>\r\n<li><strong>cvcxvcx</strong></li>\r\n</ol>', '1', '2026-03-25 09:09:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `packaging_type` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `product_specification` longtext NOT NULL,
  `product_description` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_slug`, `category_id`, `price`, `brand`, `country`, `product_image`, `packaging_type`, `material`, `size`, `product_specification`, `product_description`, `created_at`, `updated_at`) VALUES
(16, 'Test Product 1', 'test-product-1', 59, 45, 'tesd', 'Made in India', '1773741924_trial-frame-child-1.webp', 'box', 'zx', '231,45', '<ul>\r\n<li><strong><em>test</em></strong></li>\r\n<li><strong><em>test1</em></strong></li>\r\n<li><strong><em>test2</em></strong></li>\r\n</ul>', '<p>tests</p>', '2026-03-13 09:52:47', '2026-03-23 07:43:15'),
(25, 'Test Product 2', 'test-product-2', 58, 3434, 'tesd', 'Made in India', '1773742063_RAF-RULER.webp', 'box', 'zx', '231,45', '<p><em>sdsa</em></p>', '<p>dfd</p>', '2026-03-15 11:02:14', '2026-03-23 07:44:37'),
(26, 'Test Product 3', 'test-product-3', 56, 3434, 'tesd', 'Made in India', '1773742118_prism-bar-set.webp', 'box', 'zx', '231,45', '<p><em>sdsa</em></p>', '<p>dfd</p>', '2026-03-15 11:02:21', '2026-03-23 07:45:02'),
(30, 'Test Product 4', 'test-product-4', 56, 23, 'test', 'Made in India', '1773741446_led-vision-chart.webp', 'packet', 'cotton', '23,46', '<p><em>sddasd</em></p>', '<p>dsfs</p>', '2026-03-17 09:57:26', '2026-03-23 07:45:22'),
(31, 'Test Product 5', 'test-product-5', 58, 560, 'sds', 'Made in India', '1773741538_55.webp', 'Bottle', 'dfdf', '45,45', '<ol>\r\n<li>test</li>\r\n<li>test2</li>\r\n</ol>', '<p>test</p>', '2026-03-17 09:58:58', '2026-03-23 07:45:56'),
(32, 'Test Product 6', 'test-product-6', 59, 120, 'sds', 'Made in India', '1773741567_trial-lens-set-RB-SAGWAN-WOOD-scaled.webp', 'Bottle', 'dfdf', '45,45', '<ol>\r\n<li>test</li>\r\n<li>test2</li>\r\n</ol>', '<p>test</p>', '2026-03-17 09:59:27', '2026-03-23 07:46:18'),
(36, 'test', 'test', 58, 33, 'sda', 'Made in India', '1774183771_Optical.webp', 'dds', 'sad', '23,46', '<p><em>dasda</em></p>', '<p><strong>fsdf</strong></p>\r\n<p><strong>hgjgj</strong></p>\r\n<p><strong>kjj</strong></p>', '2026-03-22 12:49:31', '2026-03-25 09:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `user_name`, `password`, `user_email`, `user_phone`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@123', 'admin@gmail.com', '7999999999', '0000-00-00 00:00:00', '2026-02-05 16:26:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
