-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 05:16 PM
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
-- Database: `projets`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$K5IPsB.4cWi7i/yM/nzTvettT8ZB0TDbQ76XD3RQM6XhLGgs3U8/6', '2025-03-04 15:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`post_id`, `title`, `content`, `author_id`, `created_at`, `updated_at`, `image`) VALUES
(17, 'Discover the Magic of Morocco: A Land of Contrasts', 'Explore Morocco\'s ❤️unique blend of cultures,🏕️ landscapes, and history. From the bustling markets of Marrakesh to the tranquil Atlas Mountains 🏔️, Morocco offers something for every traveler.💞\r\n', 1, '2025-03-05 00:57:13', '2025-03-05 01:36:50', 'uploadeAdmin/blgs1.jpg'),
(19, 'The Best Moroccan Cuisine: A Taste of Tradition', 'Moroccan cuisine🍽️🥗 is a perfect reflection of its rich cultural heritage😋 featuring a combination of spices❣️ herbs, and fresh ingredients. Discover the must-try dishes🍵', 1, '2025-03-05 01:43:54', '2025-03-05 01:43:54', 'uploadeAdmin/blogs2.jpg'),
(20, '5 Essential Moroccan Experiences You Can\'t Miss', 'Morocco is filled with experiences🪂 that you won’t find anywhere else.💛 Here are five that should be on every traveler’s bucket list.\r\n🐫Camel trekking in the Sahara Desert.\r\n🛒Exploring the souks and markets of Marrakesh.\r\n💞Visiting the ancient city of Fes and its medina.\r\n🏔️Hiking in the Atlas Mountains.\r\n ❣️Enjoying a traditional Moroccan spa (Hammam) experience', 1, '2025-03-05 01:52:39', '2025-03-05 01:52:39', 'uploadeAdmin/blogs3.jpg'),
(25, 'Shopping in Morocco: Souks, Spices, and Souvenirs', 'Morocco is famous for its markets and souks,🛒 where you can find everything from spices❣️ to handmade crafts. Discover the best places to shop and what to buy.💛💛', 1, '2025-03-31 23:58:54', '2025-03-31 23:58:54', 'uploadeAdmin/blogs4.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_phone` varchar(20) NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `num_persons` int(11) NOT NULL,
  `tour_name` varchar(100) NOT NULL,
  `tour_date` date NOT NULL,
  `tour_persons` int(11) NOT NULL,
  `tour_price` decimal(10,2) NOT NULL,
  `tour_details` text NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `card_expiry` varchar(10) DEFAULT NULL,
  `card_cvv` varchar(5) DEFAULT NULL,
  `bank_account` varchar(50) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `branch_code` varchar(20) DEFAULT NULL,
  `account_holder_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `client_name`, `client_email`, `client_phone`, `arrival_date`, `departure_date`, `num_persons`, `tour_name`, `tour_date`, `tour_persons`, `tour_price`, `tour_details`, `payment_method`, `card_number`, `card_expiry`, `card_cvv`, `bank_account`, `bank_name`, `branch_code`, `account_holder_name`) VALUES
(1, 'rayan', 'rayan@gmail.com', '0640003518', '2025-03-25', '2025-04-05', 2, 'marrakech city tour', '2025-04-03', 2, 0.00, ' jnjnjnjnj', 'bankTransfer', NULL, NULL, NULL, '1234567890', 'banc of morrocan', '2342', 'lamyae ragragui');

-- --------------------------------------------------------

--
-- Table structure for table `city_images`
--

CREATE TABLE `city_images` (
  `image_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `city_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city_images`
--

INSERT INTO `city_images` (`image_id`, `city_id`, `image_path`, `city_slug`) VALUES
(114, 28, 'uploadeAdmin/casablanca2.jpeg', 'casablanca'),
(116, 28, 'uploadeAdmin/casablanca4.jpg', 'casablanca'),
(117, 28, 'uploadeAdmin/casablanca7.jpg', 'casablanca'),
(118, 28, 'uploadeAdmin/casablanca 6.jpg', 'casablanca'),
(119, 28, 'uploadeAdmin/casablanca8.jpg', 'casablanca'),
(120, 28, 'uploadeAdmin/casablanca9.webp', 'casablanca'),
(121, 28, 'uploadeAdmin/casablanca10.jpg', 'casablanca'),
(122, 28, 'uploadeAdmin/casablanca11.jpg', 'casablanca'),
(123, 28, 'uploadeAdmin/casablanca12.webp', 'casablanca'),
(124, 28, 'uploadeAdmin/casablanca13.jpeg', 'casablanca'),
(125, 28, 'uploadeAdmin/casablanca15.jpg', 'casablanca'),
(126, 28, 'uploadeAdmin/casablanca 14.jpg', 'casablanca'),
(127, 28, 'uploadeAdmin/casablanca16.jpg', 'casablanca'),
(128, 28, 'uploadeAdmin/casablanca17.jpg', 'casablanca'),
(129, 28, 'uploadeAdmin/casablanca18.webp', 'casablanca'),
(130, 28, 'uploadeAdmin/casablanca19.jpg', 'casablanca'),
(131, 28, 'uploadeAdmin/casablanca20.jpg', 'casablanca'),
(132, 28, 'uploadeAdmin/casablanca21.jpg', 'casablanca'),
(133, 28, 'uploadeAdmin/casablanca22.jpg', 'casablanca'),
(134, 28, 'uploadeAdmin/casablanca23.jpg', 'casablanca'),
(135, 28, 'uploadeAdmin/casablanca24.jpg', 'casablanca'),
(136, 28, 'uploadeAdmin/casablanca25.jpg', 'casablanca'),
(137, 28, 'uploadeAdmin/casablanca26.jpg', 'casablanca'),
(138, 28, 'uploadeAdmin/casablanca27.jpg', 'casablanca'),
(139, 29, 'uploadeAdmin/tanger1.jpg', 'tanger'),
(140, 29, 'uploadeAdmin/tanger2.webp', 'tanger'),
(141, 29, 'uploadeAdmin/tanger3.jpg', 'tanger'),
(142, 29, 'uploadeAdmin/tanger4.jpg', 'tanger'),
(143, 29, 'uploadeAdmin/tanger5.jpg', 'tanger'),
(144, 29, 'uploadeAdmin/tanger6.jpg', 'tanger'),
(145, 29, 'uploadeAdmin/tanger7.webp', 'tanger'),
(146, 29, 'uploadeAdmin/tanger8.jpg', 'tanger'),
(147, 29, 'uploadeAdmin/tanger9.jpg', 'tanger'),
(148, 29, 'uploadeAdmin/tanger10.jpg', 'tanger'),
(149, 29, 'uploadeAdmin/tanger11.jpg', 'tanger'),
(150, 29, 'uploadeAdmin/tanger12.jpg', 'tanger'),
(151, 29, 'uploadeAdmin/tanger13.jpg', 'tanger'),
(152, 29, 'uploadeAdmin/tanger14.jpg', 'tanger'),
(153, 29, 'uploadeAdmin/tanger15.jpg', 'tanger'),
(154, 30, 'uploadeAdmin/rabat2.jpg', 'rabat'),
(155, 30, 'uploadeAdmin/rabat3.jpg', 'rabat'),
(156, 30, 'uploadeAdmin/rabat4.jpg', 'rabat'),
(157, 30, 'uploadeAdmin/rabat5.webp', 'rabat'),
(158, 30, 'uploadeAdmin/rabat6.jpg', 'rabat'),
(159, 30, 'uploadeAdmin/rabat7.jpg', 'rabat'),
(160, 30, 'uploadeAdmin/rabat8.webp', 'rabat'),
(161, 30, 'uploadeAdmin/rabat9.jpg', 'rabat'),
(162, 30, 'uploadeAdmin/rabat10.jpeg', 'rabat'),
(163, 30, 'uploadeAdmin/rabat11.webp', 'rabat'),
(164, 30, 'uploadeAdmin/rabat12.jpg', 'rabat'),
(165, 30, 'uploadeAdmin/rabat13.jpg', 'rabat'),
(166, 30, 'uploadeAdmin/rabat14.jpg', 'rabat'),
(167, 30, 'uploadeAdmin/rabat15.jpg', 'rabat'),
(168, 30, 'uploadeAdmin/rabat16.jpg', 'rabat'),
(169, 30, 'uploadeAdmin/rabat17.jpg', 'rabat'),
(170, 29, 'uploadeAdmin/tanger16.jpg', 'tanger'),
(171, 29, 'uploadeAdmin/tanger17.webp', 'tanger'),
(172, 29, 'uploadeAdmin/tanger18.webp', 'tanger'),
(173, 31, 'uploadeAdmin/essaouira1.jpg', 'essaouira'),
(174, 31, 'uploadeAdmin/essaouira2.jpg', 'essaouira'),
(175, 31, 'uploadeAdmin/essaouira3.jpg', 'essaouira'),
(176, 31, 'uploadeAdmin/essaouira4.jpg', 'essaouira'),
(177, 31, 'uploadeAdmin/essaouira5.jpg', 'essaouira'),
(178, 31, 'uploadeAdmin/essaouira6.jpg', 'essaouira'),
(179, 31, 'uploadeAdmin/essaouira7.jpg', 'essaouira'),
(180, 31, 'uploadeAdmin/essaouira8.webp', 'essaouira'),
(181, 31, 'uploadeAdmin/essaouira9.webp', 'essaouira'),
(182, 31, 'uploadeAdmin/essaouira10.jpg', 'essaouira'),
(183, 31, 'uploadeAdmin/essaouira11.jpg', 'essaouira'),
(184, 31, 'uploadeAdmin/essaouira12.jpg', 'essaouira'),
(185, 31, 'uploadeAdmin/essaouira13.jpg', 'essaouira'),
(186, 31, 'uploadeAdmin/essaouira14.jpg', 'essaouira'),
(187, 31, 'uploadeAdmin/essaouira15.jpg', 'essaouira'),
(188, 32, 'uploadeAdmin/dakhla1.jpg', 'dakhla'),
(189, 32, 'uploadeAdmin/dakhla2.jpg', 'dakhla'),
(190, 32, 'uploadeAdmin/dakhla3.jpg', 'dakhla'),
(191, 32, 'uploadeAdmin/dakhla4.jpg', 'dakhla'),
(192, 32, 'uploadeAdmin/dakhla5.jpg', 'dakhla'),
(193, 32, 'uploadeAdmin/dakhla6.jpg', 'dakhla'),
(194, 32, 'uploadeAdmin/dakhla6.jpg', 'dakhla'),
(195, 32, 'uploadeAdmin/dakhla7.avif', 'dakhla'),
(196, 32, 'uploadeAdmin/dakhla8.jpg', 'dakhla'),
(197, 32, 'uploadeAdmin/dakhla9.jpg', 'dakhla'),
(198, 32, 'uploadeAdmin/dakhla10.jpg', 'dakhla'),
(199, 32, 'uploadeAdmin/dakhla11.avif', 'dakhla'),
(200, 32, 'uploadeAdmin/dakhla12.jpg', 'dakhla'),
(201, 32, 'uploadeAdmin/dakhla13.jpg', 'dakhla'),
(202, 32, 'uploadeAdmin/dakhla14.jpg', 'dakhla'),
(203, 32, 'uploadeAdmin/dakhla15.jpg', 'dakhla'),
(204, 34, 'uploadeAdmin/agadir1.jpg', 'agadir'),
(205, 34, 'uploadeAdmin/agadir2.jpg', 'agadir'),
(206, 34, 'uploadeAdmin/agadir3.jpg', 'agadir'),
(207, 34, 'uploadeAdmin/agadir4.jpg', 'agadir'),
(208, 34, 'uploadeAdmin/agadir5.webp', 'agadir'),
(209, 34, 'uploadeAdmin/agadir6.jpg', 'agadir'),
(210, 34, 'uploadeAdmin/agadir7.png', 'agadir'),
(211, 34, 'uploadeAdmin/agadir8.jpg', 'agadir'),
(212, 34, 'uploadeAdmin/agadir9.jpg', 'agadir'),
(213, 34, 'uploadeAdmin/agadir10.avif', 'agadir'),
(214, 34, 'uploadeAdmin/agadir11.jpg', 'agadir'),
(215, 34, 'uploadeAdmin/agadir12.webp', 'agadir'),
(216, 34, 'uploadeAdmin/agadir13.png', 'agadir'),
(217, 34, 'uploadeAdmin/agadir14.webp', 'agadir'),
(218, 34, 'uploadeAdmin/agadir15.jpg', 'agadir');

-- --------------------------------------------------------

--
-- Table structure for table `city_images_nocoastal`
--

CREATE TABLE `city_images_nocoastal` (
  `image_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `city_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coastal_cities`
--

CREATE TABLE `coastal_cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `city_slug` varchar(255) NOT NULL,
  `city_image` varchar(255) DEFAULT NULL,
  `city_description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coastal_cities`
--

INSERT INTO `coastal_cities` (`city_id`, `city_name`, `city_slug`, `city_image`, `city_description`) VALUES
(28, 'casablanca', 'casablanca', '/lamyae/uploadeAdmin/casablanca5.png', 'Casablanca, locally known as Casa, is the largest city in Morocco and its economic capital. Located on the Atlantic coast, the city offers stunning sea views and mild weather throughout the year. One of the city\'s main highlights is the Hassan II Mosque, one of the largest mosques in the world, featuring a towering minaret and breathtaking oceanfront views. Another famous spot is the Ain Diab Corniche, perfect for a stroll along the beach, with many upscale restaurants and cafes. Casablanca\'s Old Medina also retains its traditional charm with narrow streets and vibrant markets. The city is home to the famous Twin Center Towers and is a major business hub, hosting numerous international companies and commercial centers. Additionally, Casablanca\'s port is one of the largest in Africa, making it an important global trading center. With a mild climate year-round, Casablanca offers a mix of activities, from shopping and enjoying seafood to relaxing on the beach and exploring its rich cultur'),
(29, 'tanger', 'tanger', '/lamyae/uploadeAdmin/tanger.jpg', 'Tangier, located in northern Morocco, is a city with a long history and rich culture, making it one of the most prominent tourist destinations in Morocco. The city overlooks both the Mediterranean Sea and the Atlantic Ocean, adding to its natural beauty and positioning it as a point of convergence between two continents. Tangier is often referred to as the \"Gateway to Africa\" because of its location at the Strait of Gibraltar, which separates the Atlantic Ocean from the Mediterranean Sea.\r\n\r\nThe city is known for its strategic location and its ability to blend Moroccan traditions with European influences. Notable landmarks in Tangier include the Old Medina, characterized by narrow streets, winding alleys, and traditional white houses. Other must-see spots include the Café de Paris in 9 Avril Square and the Kasbah Palace, which offers a breathtaking view of the city and the sea.\r\n\r\nThe Tangier Beach is an ideal place to relax on golden sands with crystal-clear waters, attracting visitor'),
(30, 'rabat', 'rabat', '/lamyae/uploadeAdmin/rabat.jpg', 'Rabat is the capital of Morocco, a city distinguished by a wonderful blend of modernity and tradition. Located on the Atlantic coast, it is one of the most prominent cultural and historical cities in the country. The city is famous for its ancient landmarks, such as the Hassan Tower, one of the most significant historical monuments, and the Mausoleum of Mohammed V, which is an architectural masterpiece. Visitors can also explore the Old Medina, which retains its traditional atmosphere, as well as the Kasbah of the Oudayas, offering stunning views of the Atlantic Ocean and the Bou Regreg River. Rabat is also a hub for culture and art in Morocco, home to numerous museums and beautiful gardens, such as the Andalusian Gardens. It is a city that combines rich history with modern life, making it a unique tourist destination in Morocco.'),
(31, 'essaouira', 'essaouira', '/lamyae/uploadeAdmin/essaouira.jpg', 'Essaouira is one of the most beautiful tourist destinations in Morocco, located on the Atlantic coast. The city is known for its mild and refreshing climate throughout the year, making it a favorite destination for visitors from around the world. The old Medina of Essaouira, a UNESCO World Heritage site, is characterized by its narrow streets and white buildings with blue windows, as well as the historic walls that surround it. One of the city\'s main attractions is its historic port, one of the oldest in Morocco, where you can find traditional ships and restaurants offering fresh seafood. Essaouira is also famous for its beautiful beaches, which are perfect for water sports such as surfing. The city is known for its local crafts, including woodwork, perfumes, and jewelry, sold in traditional markets. Essaouira is a charming destination that blends history and natural beauty.'),
(32, 'dakhla', 'dakhla', '/lamyae/uploadeAdmin/dakhla.jpeg', 'Dakhla is a charming coastal city located in the southern part of Morocco, near the border with Western Sahara. Known for its unique blend of desert and ocean landscapes, Dakhla offers a peaceful atmosphere with breathtaking views of the Atlantic Ocean. The city is famous for its pristine beaches, making it a hotspot for water sports such as kite surfing and windsurfing. Dakhla also has a rich cultural heritage, with its traditional fishing port and vibrant markets. The city is ideal for travelers looking for adventure, nature, and a peaceful escape from the hustle and bustle of larger cities.'),
(34, 'agadir', 'agadir', '/lamyae/uploadeAdmin/agadir.jpg', 'Agadir is a popular tourist destination located along Morocco\'s southern Atlantic coast. Known for its beautiful sandy beaches, modern infrastructure, and vibrant atmosphere, Agadir attracts both locals and international tourists. The city offers a mix of relaxation and adventure, with opportunities for surfing, hiking, and exploring nearby attractions like the Souss-Massa National Park and the Agadir Kasbah. Agadir has a rich history, having been rebuilt after a devastating earthquake in 1960, and today, it features a blend of modern buildings and traditional Moroccan elements. The city\'s warm climate and laid-back vibe make it a favorite destination for holidaymakers.'),
(35, 'Tetouan', 'tetouan', '/lamyae/uploadeAdmin/te.jpg', 'Tetouan is a historic city located in the northern part of Morocco, near the Mediterranean Sea. Known for its rich Andalusian heritage, Tetouan is a blend of Arab, Berber, and Spanish influences, which is reflected in its architecture, culture, and cuisine. The city’s Medina, a UNESCO World Heritage site, is a maze of narrow streets lined with whitewashed buildings and intricate designs. Tetouan is also famous for its vibrant markets, traditional crafts, and close proximity to the Rif Mountains and the Mediterranean coastline. The city offers a mix of cultural exploration, historical landmarks, and natural beauty.');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`contact_id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'lamiaereg', 'rriar252@gmail.com', '0640603518', 'ml,l', '2025-03-04 01:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id_experience` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `user_comment` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id_experience`, `users_id`, `user_comment`, `image_path`, `video_path`, `created_at`) VALUES
(3, 1, 'hhhhhbhjjhbj', NULL, NULL, '2025-03-11 22:59:01'),
(4, 1, 'jnnjnjn', NULL, NULL, '2025-03-11 22:59:10'),
(5, 1, 'jnjjnjnjnnjnhuhbh', NULL, NULL, '2025-03-20 12:10:59'),
(6, 2, 'welcome', NULL, NULL, '2025-04-01 21:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `stars` int(11) DEFAULT NULL CHECK (`stars` between 1 and 5),
  `price_per_night` decimal(10,2) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `city_id`, `hotel_name`, `description`, `stars`, `price_per_night`, `location`, `phone`, `image_path`) VALUES
(38, 28, 'Hotel Kenzi Basma', NULL, 4, 989.00, 'Avenue Moulay Hassan 1er, Boulevard Zerktouni, Casablanca 22000, Maroc ', '+212 (0) 5 22 22 33 58', 'hotelkenz.webp');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_images`
--

CREATE TABLE `hotel_images` (
  `hotimage_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_images`
--

INSERT INTO `hotel_images` (`hotimage_id`, `hotel_id`, `image_path`) VALUES
(20, 38, 'hotelkenz.jpg'),
(21, 38, 'hotelkenz1.jpg'),
(22, 38, 'hotelkenz2.jpg'),
(23, 38, 'hotelkenz4.jpg'),
(24, 38, 'hotelkenz5.jpg'),
(25, 38, 'hotelkenz6.jpg'),
(26, 38, 'hotelkenz8.jpg'),
(27, 38, 'hotelkenz7.jpg'),
(28, 38, 'hotelkenz7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `local_dishes`
--

CREATE TABLE `local_dishes` (
  `dishes_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `dish_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `availability` enum('Always Available','Limited Days') DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `non_coastal_cities`
--

CREATE TABLE `non_coastal_cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `city_slug` varchar(255) NOT NULL,
  `city_image` varchar(255) DEFAULT NULL,
  `city_description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `non_coastal_cities`
--

INSERT INTO `non_coastal_cities` (`city_id`, `city_name`, `city_slug`, `city_image`, `city_description`) VALUES
(5, 'fes', 'fes', '/lamyae/uploadeAdmin/fes.jpg', 'Fes is one of Morocco\'s most historic and culturally rich cities, known as the country\'s spiritual and intellectual capital. It is home to the oldest university in the world, Al-Qarawiyyin University, founded in 859 AD. The city\'s ancient medina, a UNESCO World Heritage Site, is a labyrinth of narrow streets lined with vibrant souks, traditional workshops, and historic mosques. Fes is renowned for its intricate architecture, including the stunning Bou Inania Madrasa and the Al-Attarine Madrasa. The city is also famous for its traditional tanneries, where leather is still dyed using natural methods. With its rich history, vibrant culture, and timeless traditions, Fes offers visitors a truly authentic Moroccan experience.'),
(6, 'ouarzazat', 'ouarzazat', '/lamyae/uploadeAdmin/ouarzazat.jpg', 'Ouarzazate is known as the \"Gateway to the Sahara\" and is famous for its breathtaking desert landscapes and historic kasbahs. The city is home to the impressive Kasbah of Ait Ben Haddou, a UNESCO World Heritage Site, which has been the backdrop for many famous films and TV series. Ouarzazate is also known for its large film studios, including the Atlas Studios, where epic movies like Gladiator and Lawrence of Arabia were filmed. Surrounded by majestic mountains and golden sand dunes, the city offers a unique blend of natural beauty and cultural heritage. Visitors can explore the ancient kasbahs, visit the Taourirt Kasbah, and experience the warmth of Berber hospitality'),
(7, 'ifran', 'ifran', '/lamyae/uploadeAdmin/ifran.jpg', 'Ifrane is often referred to as the \"Switzerland of Morocco\" due to its Alpine-style architecture, clean streets, and cool climate. Nestled in the Middle Atlas Mountains, the city is known for its lush green landscapes, cedar forests, and snow-capped peaks during winter. Ifrane is home to the prestigious Al Akhawayn University, which adds a vibrant, youthful atmosphere to the town. Visitors can explore the Lion Stone, a famous sculpture carved into a rock, or enjoy outdoor activities such as hiking, skiing, and exploring the nearby Cedre Gouraud Forest, home to the endangered Barbary macaques. The city\'s well-kept gardens, lakes, and peaceful environment make it a perfect destination for relaxation and nature lovers'),
(8, 'taza', 'taza', '/lamyae/uploadeAdmin/taza.jpg', 'Taza is a historic city located in the northeastern part of Morocco, nestled between the Rif Mountains and the Middle Atlas Mountains. It serves as a strategic gateway between eastern and western Morocco, making it historically significant as a military and trade route.\r\n\r\nTaza is known for its well-preserved medina, ancient walls, and traditional markets. The city offers a glimpse into Morocco’s rich history with landmarks such as the Great Mosque of Taza, which dates back to the Almohad era, showcasing exquisite architectural details.\r\n\r\nNature lovers will appreciate the nearby Tazekka National Park, home to the stunning Friouato Caves, known for their impressive underground chambers and stalactites. The city\'s mountainous surroundings provide breathtaking views and opportunities for hiking and exploring Morocco’s natural beauty.\r\n\r\nTaza’s culture reflects a blend of Arab and Berber influences, seen in its music, cuisine, and traditional crafts. Its calm atmosphere and rich history m'),
(9, 'zagoura', 'zagoura', '/lamyae/uploadeAdmin/zagoura.jpg', 'Zagora is a charming city located in the southern part of Morocco, in the Draa Valley, at the edge of the Sahara Desert. Known as the gateway to the desert, Zagora offers a unique blend of desert landscapes and rich cultural heritage.\r\n\r\nThe city is famous for its palm groves, which stretch along the Draa River, creating a lush contrast to the surrounding desert terrain. The palm trees provide an oasis-like feel, and the area is known for its dates, which are some of the best in Morocco.\r\n\r\nOne of Zagora\'s most iconic features is the signpost that reads \"Tombouctou 52 days,\" marking the old caravan routes that once connected Morocco to the legendary city of Timbuktu in Mali. This symbolized the city’s importance as a crossroads for traders and travelers in centuries past.\r\n\r\nZagora is also a hub for exploring the Sahara Desert. Many visitors use it as a starting point for camel treks, exploring the vast dunes and experiencing the timeless beauty of the desert. Visitors can spend a nigh'),
(10, 'azilal', 'azilal', '/lamyae/uploadeAdmin/azilal.jpg', 'Azilal is a picturesque town located in the central region of Morocco, nestled in the Atlas Mountains. Known for its natural beauty, Azilal is a perfect destination for those looking to experience both the mountains and the traditional Moroccan lifestyle.\r\n\r\nThe town is surrounded by stunning landscapes, including lush valleys, waterfalls, and high mountain peaks. One of the most famous attractions near Azilal is the Ouzoud Waterfalls, which is one of the most visited natural wonders in Morocco. The waterfalls cascade down from a height of 110 meters, surrounded by green olive groves, making it a beautiful spot for hiking and picnicking.\r\n\r\nAzilal is also famous for its Berber culture, and visitors can explore the local markets, where handmade crafts, textiles, and pottery are sold by local artisans. The town’s architecture reflects traditional Berber designs, with mud-brick homes and kasbahs (fortresses) blending seamlessly with the natural environment.\r\n\r\nThe surrounding region is pe'),
(12, 'marackech', 'marackech', '/lamyae/uploadeAdmin/marrakech.jpg', 'Marrakech, known as the \"Red City,\" is one of Morocco\'s oldest and most beautiful cities, making it a top global tourist destination. It is famous for its traditional markets (souks), narrow lively alleys, and the iconic Jemaa el-Fnaa square, which comes alive with street performers, storytellers, and food vendors. Marrakech is home to unique historical landmarks such as Bahia Palace, Ben Youssef Madrasa, and the colorful Majorelle Gardens. The city also offers a distinctive accommodation experience in its traditional riads, blending authentic Moroccan architecture with modern comforts. The charm of Marrakech extends to its rich culinary scene, where visitors can savor tagine, couscous, and sweet treats like chebakia.');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offers_id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `offer_type` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offers_id`, `users_id`, `offer_type`, `name`, `email`, `booking_date`) VALUES
(1, 1, 'Spring Trip Special Offer', 'lamiaereg', 'rriar252@gmail.com', '2025-03-04 00:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id_reviews` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id_reviews`, `users_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 2, 'kmklm', '2025-03-04 00:51:31'),
(2, 1, 3, 'jjjugdvb', '2025-03-11 22:57:00'),
(3, 1, 2, 'kmkmkmkmijnjn', '2025-03-20 12:10:00'),
(4, 2, 3, 'jjjjjjjjjjjjsbqjhbhnqjoqko', '2025-04-01 21:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `title`, `icon`, `description`) VALUES
(1, 'Tour Planning', 'fas fa-map-marked-alt', 'Customized trips designed just for you. We create itineraries based on your preferences and interests.'),
(2, 'Tour Guide', 'fas fa-user-tie', 'Experienced guides to lead you through Morocco’s rich history, culture, and attractions'),
(3, 'Adventure Tours', 'fas fa-mountain', 'Exciting trips to explore Morocco\'s natural beauty, from the Atlas Mountains to the Sahara desert.'),
(5, 'Transportation', 'fas fa-car', 'Reliable and comfortable transportation services for your tours, with options for group and private rides'),
(6, 'Cultural Tours', 'fas fa-users', 'Guided cultural tours through Morocco’s ancient cities, markets, and historical sites.'),
(7, 'Coastal Tours', 'fas fa-umbrella-beach', 'Relaxing and scenic coastal tours, visiting beautiful Moroccan beaches and seaside cities.'),
(8, 'Nature Tours', 'fas fa-tree', 'Explore the diverse Moroccan landscapes, from lush forests to desert oases and lakes.\r\n'),
(9, 'Private Tours', 'fas fa-user-secret', 'Enjoy a personalized tour experience tailored to your preferences, with flexibility and privacy');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `name`, `price`, `details`) VALUES
(2, 'marrakech city tour', 300.00, ''),
(3, 'Sahara Desert Adventure', 150.00, ''),
(4, 'Atlas Mountains Trek ', 200.00, ''),
(5, 'Fes Medina Tour ', 100.00, ''),
(6, 'Chefchaouen Blue City Tour', 350.00, ''),
(7, 'Essaouira Beach and Medina Tour', 199.00, ''),
(8, 'Ouarzazate and Ait Benhaddou Tour', 190.00, ''),
(9, 'Meknes and Volubilis Tour', 110.00, ''),
(10, 'Todra Gorges and Dades Valley Tour', 180.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `reset_code` varchar(6) DEFAULT NULL,
  `code_expiry` datetime DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `name`, `email`, `password`, `password_reset_token`, `token_expiry`, `reset_code`, `code_expiry`, `role`) VALUES
(1, 'lamiaereg', 'rriar252@gmail.com', '$2y$10$fDm6lSSKTxxRLR/BRsrUGenL32g3NEl.ww4s/j.uZdh0f7yli9GrS', '599814f337faf7adeb7e239d1b0df808a2d1b900d7470eac3693ed88fd93af81f91cf45164b0ca03af6c646502305b9c96b2', '2025-03-22 16:51:28', NULL, NULL, 'user'),
(2, 'rachida', 'rachida@gmail.com', '$2y$10$IXdIW0L6auiyE6kA4GShKuDb50Z1HBZ7t61IrXmyUm9BFId4d5Lvy', NULL, NULL, NULL, NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `fk_author_id` (`author_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `city_images`
--
ALTER TABLE `city_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `city_images_nocoastal`
--
ALTER TABLE `city_images_nocoastal`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `coastal_cities`
--
ALTER TABLE `coastal_cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD PRIMARY KEY (`hotimage_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `local_dishes`
--
ALTER TABLE `local_dishes`
  ADD PRIMARY KEY (`dishes_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `non_coastal_cities`
--
ALTER TABLE `non_coastal_cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offers_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_reviews`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `city_images`
--
ALTER TABLE `city_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `city_images_nocoastal`
--
ALTER TABLE `city_images_nocoastal`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `coastal_cities`
--
ALTER TABLE `coastal_cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id_experience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `hotel_images`
--
ALTER TABLE `hotel_images`
  MODIFY `hotimage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `local_dishes`
--
ALTER TABLE `local_dishes`
  MODIFY `dishes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `non_coastal_cities`
--
ALTER TABLE `non_coastal_cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_reviews` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `fk_author_id` FOREIGN KEY (`author_id`) REFERENCES `users` (`users_id`);

--
-- Constraints for table `city_images`
--
ALTER TABLE `city_images`
  ADD CONSTRAINT `city_images_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `coastal_cities` (`city_id`) ON DELETE CASCADE;

--
-- Constraints for table `city_images_nocoastal`
--
ALTER TABLE `city_images_nocoastal`
  ADD CONSTRAINT `city_images_nocoastal_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `non_coastal_cities` (`city_id`);

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `coastal_cities` (`city_id`) ON DELETE CASCADE;

--
-- Constraints for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD CONSTRAINT `hotel_images_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`);

--
-- Constraints for table `local_dishes`
--
ALTER TABLE `local_dishes`
  ADD CONSTRAINT `local_dishes_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `coastal_cities` (`city_id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE SET NULL;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
