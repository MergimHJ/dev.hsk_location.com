-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 09 juin 2025 à 19:53
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hsk_location`
--

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

CREATE TABLE `booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_number` varchar(20) NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `car_id` int(10) UNSIGNED NOT NULL,
  `pickup_date` datetime NOT NULL,
  `return_date` datetime NOT NULL,
  `duration` int(10) UNSIGNED DEFAULT NULL COMMENT 'Nombre de jours de location',
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','canceled','completed') DEFAULT 'pending',
  `payment_status` enum('pending','partial','paid','refunded') DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL COMMENT 'Path to brand logo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `brand`
--

INSERT INTO `brand` (`id`, `name`, `slug`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Mercedes-Benz', 'mercedes-benz', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(2, 'BMW', 'bmw', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(3, 'Audi', 'audi', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(4, 'Ferrari', 'ferrari', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(6, 'Porsche', 'porsche', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(7, 'Bentley', 'bentley', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(8, 'Aston Martin', 'aston-martin', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(9, 'Maserati', 'maserati', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(10, 'Rolls-Royce', 'rolls-royce', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(11, 'McLaren', 'mclaren', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(12, 'Lexus', 'lexus', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(13, 'Tesla', 'tesla', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(14, 'Volkswagen', 'volkswagen', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(15, 'Cupra', 'cupra', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(16, 'Renault', 'renault', NULL, '2024-12-31 23:00:00', '2024-12-31 23:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

CREATE TABLE `car` (
  `id` int(10) UNSIGNED NOT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `category_tag_id` int(10) UNSIGNED NOT NULL COMMENT 'Tag pour la catégorie (SUV, berline, etc.)',
  `theme_tag_id` int(10) UNSIGNED NOT NULL COMMENT 'Tag pour le thème (mariage, business, etc.)',
  `model` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `year` int(10) UNSIGNED NOT NULL COMMENT 'Year of manufacture',
  `seats` int(10) UNSIGNED DEFAULT 2 COMMENT 'Number of seats',
  `doors` int(10) UNSIGNED DEFAULT 2 COMMENT 'Number of doors',
  `transmission` enum('automatic','manual','semi-automatic') DEFAULT 'automatic',
  `fuel_type` enum('gasoline','diesel','hybrid','electric') DEFAULT 'gasoline',
  `horsepower` int(10) UNSIGNED DEFAULT NULL,
  `top_speed` int(10) UNSIGNED DEFAULT NULL COMMENT 'Top speed in km/h',
  `acceleration` decimal(4,1) DEFAULT NULL COMMENT '0-100 km/h in seconds',
  `image` varchar(255) DEFAULT NULL COMMENT 'Main image path',
  `cylinders` int(16) NOT NULL COMMENT 'cylinders',
  `deposit` decimal(10,2) DEFAULT NULL COMMENT 'Security deposit amount',
  `stock` int(10) UNSIGNED DEFAULT 1 COMMENT 'Number of same models available',
  `status` enum('draft','published','archived') DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `wheel-transmission` varchar(50) NOT NULL,
  `carrosserie` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `operator_id`, `brand_id`, `category_tag_id`, `theme_tag_id`, `model`, `title`, `slug`, `description`, `content`, `year`, `seats`, `doors`, `transmission`, `fuel_type`, `horsepower`, `top_speed`, `acceleration`, `image`, `cylinders`, `deposit`, `stock`, `status`, `created_at`, `updated_at`, `wheel-transmission`, `carrosserie`, `price`) VALUES
(1, 1, 4, 1, 19, '488 GTB', 'Ferrari 488 GTB', 'ferrari-488-gtb', 'Voiture de sport italienne emblématique aux performances explosives.', 'Avec son moteur V8 bi-turbo de 670 ch, la Ferrari 488 GTB est conçue pour offrir sensations fortes et prestige.', 2020, 2, 2, 'automatic', 'gasoline', 670, 330, 3.0, 'ferrari-488-gtb.webp', 12, 5000.00, 1, 'published', '2025-05-12 15:09:59', '2025-06-08 05:37:57', '2', 'Coupé', 1000),
(2, 1, 2, 1, 19, 'Huracán Evo', 'Lamborghini Huracán Evo', 'lamborghini-huracan-evo', 'Un coupé sportif à la fois brutal et raffiné.', 'Dotée d’un V10 atmosphérique, la Huracán Evo incarne la puissance pure et l’élégance italienne.', 2021, 2, 2, 'automatic', 'gasoline', 640, 325, 2.9, 'lamborghini_huracan_evo.jpg', 10, 6000.00, 1, 'published', '2025-05-12 15:09:59', '2025-06-09 17:29:02', '4', 'Coupé', 1200),
(3, 1, 6, 1, 16, '911 Turbo S', 'Porsche 911 Turbo S', 'porsche-911-turbo-s', 'Le mélange parfait entre sportivité, élégance et confort.', 'La Porsche 911 Turbo S est une icône des voitures sportives avec ses performances impressionnantes et sa finition irréprochable.', 2022, 4, 2, 'automatic', 'gasoline', 650, 330, 2.7, '911-turbo-s.webp', 8, 4000.00, 2, 'published', '2025-05-12 15:09:59', '2025-06-09 17:29:12', '4', 'Coupé', 900),
(4, 2, 7, 7, 14, 'Continental GT', 'Bentley Continental GT V8', 'bentley-continental-gt-v8', 'Coupé de luxe à la fois puissant et confortable.', 'La Bentley Continental GT incarne le summum du luxe britannique avec un moteur V8 dynamique.', 2022, 4, 2, 'automatic', 'gasoline', 550, 318, 3.9, 'bentley-continental-gt.webp', 8, 3500.00, 1, 'published', '2025-05-12 15:09:59', '2025-06-09 17:29:29', '4', 'Coupé', 800),
(5, 2, 1, 7, 15, 'S-Class Coupé', 'Mercedes-Benz S 63 AMG Coupé', 'mercedes-s63-amg-coupe', 'L’alliance ultime du luxe et des performances signée AMG.', 'Ce coupé Mercedes impressionne par sa prestance, son moteur V8 Biturbo et son confort intérieur exceptionnel.', 2020, 4, 2, 'automatic', 'gasoline', 612, 300, 3.5, 'mercedes-amg-s63-coupe.webp', 8, 3000.00, 2, 'published', '2025-05-12 15:09:59', '2025-06-09 17:29:39', '4', 'Coupé', 850),
(6, 1, 2, 7, 18, 'M8 Competition', 'BMW M8 Competition Coupé', 'bmw-m8-competition', 'La version la plus puissante de BMW avec luxe et performance.', 'Avec 625 chevaux sous le capot, la M8 Competition offre une expérience digne des supercars.', 2021, 4, 2, 'automatic', 'gasoline', 625, 305, 3.2, 'bmw-m8-competition.webp', 8, 3000.00, 2, 'published', '2025-05-12 15:34:51', '2025-06-09 17:29:55', '4', 'Coupé', 750),
(7, 2, 3, 1, 16, 'R8 V10 Plus', 'Audi R8 V10 Plus', 'audi-r8-v10', 'La supercar d’Audi avec moteur V10 central.', 'L’Audi R8 V10 Plus allie élégance, technologie quattro et puissance déchaînée.', 2020, 2, 2, 'automatic', 'gasoline', 610, 330, 3.1, 'r8-v10.jpg', 10, 4000.00, 1, 'published', '2025-05-12 15:34:51', '2025-06-08 05:40:15', '4', 'Coupé', 950),
(8, 1, 8, 1, 16, 'DB11', 'Aston Martin DB11 V8', 'aston-martin-db-11', 'La classe britannique par excellence.', 'Mélange de puissance et de raffinement, la DB11 est idéale pour les escapades de prestige.', 2021, 2, 2, 'automatic', 'gasoline', 503, 300, 4.0, 'db-11.jpg', 8, 3500.00, 1, 'published', '2025-05-12 15:34:51', '2025-06-08 05:43:04', '2', 'Coupé', 950),
(9, 2, 9, 10, 15, 'Ghibli Trofeo', 'Maserati Ghibli Trofeo', 'maserati-ghibli-trofeo', 'Berline de luxe italienne avec un moteur Ferrari.', 'Le luxe et la sportivité réunis dans cette version Trofeo très haut de gamme.', 2022, 5, 4, 'automatic', 'gasoline', 580, 326, 4.3, 'maserati_ghibli_trofeo.jpg', 8, 3500.00, 2, 'published', '2025-05-12 15:34:51', '2025-06-09 17:30:46', '2', 'Berline', 600),
(10, 1, 10, 7, 14, 'Wraith', 'Rolls-Royce Wraith', 'rolls-royce-wraith', 'Le grand luxe dans un coupé majestueux.', 'La Wraith représente le summum de l’élégance, avec un moteur V12 et un intérieur somptueux.', 2020, 4, 2, 'automatic', 'gasoline', 624, 250, 4.4, 'rr-wraith.jpg', 12, 8000.00, 1, 'published', '2025-05-12 15:34:51', '2025-06-08 05:45:06', '4', 'Coupé', 1500),
(11, 2, 11, 1, 17, '720S', 'McLaren 720S', 'mclaren-720s', 'Supercar anglaise au look futuriste.', 'Avec son châssis en carbone et son moteur V8 biturbo, la 720S offre des performances de piste.', 2022, 2, 2, 'automatic', 'gasoline', 720, 341, 2.8, '720S.webp', 12, 7000.00, 1, 'published', '2025-05-12 15:34:51', '2025-06-08 05:45:42', '2', 'Coupé', 1300),
(12, 1, 6, 7, 15, 'Panamera Turbo S', 'Porsche Panamera Turbo S', 'panamera-turbo-s', 'Berline de luxe avec performances de supercar.', 'La Panamera Turbo S combine confort de grande routière et motorisation ultra-sportive.', 2021, 4, 4, 'automatic', 'hybrid', 700, 315, 3.1, 'panamera-turbo-s.jpg', 8, 4000.00, 1, 'published', '2025-05-12 15:34:51', '2025-06-09 17:31:26', '4', 'Berline', 700),
(13, 2, 2, 7, 15, 'i8 Roadster', 'BMW i8 Roadster Hybride', 'bmw-i8-roadster', 'Design futuriste et technologie hybride.', 'Le BMW i8 Roadster allie performances et conduite électrique dans un écrin de luxe.', 2020, 2, 2, 'automatic', 'hybrid', 374, 250, 4.6, 'i8-roadster.jpg', 3, 2500.00, 1, 'published', '2025-05-12 15:34:51', '2025-06-09 17:38:46', '2', 'Roadster', 600),
(14, 2, 12, 7, 15, 'LC 500', 'Lexus LC 500 Sport+', 'lexus-lc-500', 'Coupé japonais au look audacieux et moteur V8.', 'La Lexus LC 500 combine style, confort haut de gamme et performances routières solides.', 2021, 4, 2, 'automatic', 'gasoline', 471, 270, 4.4, 'lc-500.jpg', 6, 3000.00, 1, 'published', '2025-05-12 15:34:51', '2025-06-09 17:39:15', '4', 'Coupé', 550),
(15, 1, 13, 7, 15, 'Model S Plaid', 'Tesla Model S Plaid', 'model-s-plaid', 'La berline électrique la plus rapide du marché.', 'La Tesla Model S Plaid combine accélération fulgurante et technologie de pointe 100% électrique.', 2023, 5, 4, 'automatic', 'electric', 1020, 322, 2.1, 'tesla-model-s-plaid.jpg', 1, 4000.00, 2, 'published', '2025-05-12 15:34:51', '2025-06-08 05:49:16', '4', 'Berline', 750),
(16, 1, 2, 7, 18, 'M2 Competition', 'BMW M2 Competition', 'bmw-m2-competition', 'Coupé compact et musclé, symbole du plaisir de conduite BMW.', 'Avec son moteur 6 cylindres biturbo, la M2 offre un excellent rapport puissance/agilité.', 2020, 4, 2, 'manual', 'gasoline', 410, 280, 4.2, 'm2-competition.avif', 6, 2000.00, 2, 'published', '2025-05-12 15:44:52', '2025-06-08 05:49:48', '2', 'Compacte', 400),
(17, 1, 2, 9, 18, 'M140i', 'BMW M140i xDrive', 'bmw-m140i', 'Une compacte puissante et discrète.', 'Dotée d’un 6 cylindres en ligne, la M140i allie performance et polyvalence.', 2020, 5, 5, 'automatic', 'gasoline', 340, 250, 4.6, 'm140i.webp', 6, 1800.00, 2, 'published', '2025-05-12 15:44:52', '2025-06-08 05:50:35', '4', 'Compacte', 350),
(18, 1, 3, 9, 18, 'RS3 Sportback', 'Audi RS3 Sportback', 'audi-rs3', 'La compacte explosive d’Audi avec moteur 5 cylindres.', 'La RS3 est redoutable en ligne droite comme sur routes sinueuses.', 2022, 5, 5, 'automatic', 'gasoline', 400, 290, 3.8, 'audi-rs3.webp', 5, 2000.00, 2, 'published', '2025-05-12 15:44:52', '2025-06-08 05:51:10', '4', 'Compacte', 450),
(19, 2, 3, 10, 15, 'S3 Berline', 'Audi S3 Berline', 'audi-s3', 'La petite sœur de la RS3, efficace et plus accessible.', 'Une voiture agile et classe avec transmission quattro.', 2021, 5, 4, 'automatic', 'gasoline', 310, 250, 4.8, 'audi-s3.jpg', 4, 1500.00, 1, 'published', '2025-05-12 15:44:52', '2025-06-09 17:40:21', '4', 'Compacte', 300),
(20, 2, 1, 9, 18, 'A45 S AMG', 'Mercedes-AMG A45 S 4MATIC+', 'mercedes-a45-s', 'La compacte la plus puissante du marché.', 'Avec 421 chevaux et une transmission 4MATIC+, l’A45 S est une véritable bombe.', 2022, 5, 5, 'automatic', 'gasoline', 421, 270, 3.9, 'a45-s.jpg', 4, 2500.00, 1, 'published', '2025-05-12 15:44:52', '2025-06-08 05:52:23', '4', 'Compacte', 450),
(21, 1, 1, 10, 16, 'CLA 45 AMG', 'Mercedes-AMG CLA 45 S', 'mercedes-cla45-s', 'Berline compacte au look racé.', 'La CLA 45 S allie design agressif et puissance impressionnante pour une compacte.', 2021, 5, 4, 'automatic', 'gasoline', 421, 270, 4.0, 'cla-45.jpg', 4, 2300.00, 1, 'published', '2025-05-12 15:44:52', '2025-06-09 17:40:33', '4', 'Compacte', 400),
(22, 2, 14, 9, 16, 'Golf 8 R', 'Volkswagen Golf 8 R', 'volkswagen-golf-8r', 'La Golf la plus performante jamais produite.', 'Avec 320 chevaux, 4 roues motrices et un châssis affûté, la Golf R reste une référence.', 2022, 5, 5, 'automatic', 'gasoline', 320, 270, 4.7, 'volkswagen-golf-8r.jpg', 4, 1800.00, 2, 'published', '2025-05-12 15:44:52', '2025-06-08 05:53:33', '4', 'Compacte', 350),
(23, 1, 14, 9, 17, 'Golf 7 GTI Clubsport', 'Volkswagen Golf GTI Clubsport', 'gti-clubsport', 'Version la plus affûtée de la GTI.', 'Un équilibre entre sportivité, confort et efficacité redoutable sur route.', 2020, 5, 5, 'automatic', 'gasoline', 300, 250, 5.2, 'gti-clubsport.webp', 4, 1600.00, 1, 'published', '2025-05-12 15:44:52', '2025-06-08 05:54:11', '2', 'Compacte', 300),
(24, 2, 15, 9, 15, 'Leon Cupra R', 'Cupra Leon R ST', 'leon-r-st', 'Compacte allemande très sportive.', 'Une voiture familiale au tempérament de feu avec un châssis affûté et 310 ch.', 2021, 5, 5, 'automatic', 'gasoline', 310, 250, 4.9, 'seat-leon-r-st.jpg', 4, 1700.00, 1, 'published', '2025-05-12 15:44:52', '2025-06-08 05:54:52', '2', 'Compacte', 300),
(25, 1, 16, 9, 17, 'Megane RS Trophy', 'Renault Mégane RS Trophy', 'megane-rs-trophy', 'La compacte française la plus radicale.', 'Avec un châssis Cup, la Mégane RS Trophy est une vraie pistarde homologuée route.', 2020, 5, 5, 'manual', 'gasoline', 300, 260, 5.7, 'megane-rs-trophy.jpg', 4, 1400.00, 1, 'published', '2025-05-12 15:44:52', '2025-06-08 05:55:14', '2', 'Compacte', 280),
(26, 2, 3, 13, 14, 'Q7', 'Audi Q7 V12 TDI', 'audi-q7-v12-tdi', 'v12 papa', '', 2010, 5, 4, 'automatic', 'diesel', 500, 250, 5.5, 'audi-q7-v12-tdi.jpg', 12, 1500.00, 1, 'published', '2025-06-08 06:14:53', '2025-06-08 06:34:09', '4', '4x4', 600),
(27, 1, 2, 10, 19, 'M3 G80', 'BMW M3 G80', 'bmw-m3-g80', 'm3 papa', '', 2025, 5, 4, 'automatic', 'gasoline', 525, 250, 3.5, 'bmw-m3-g80.webp', 8, 2500.00, 1, 'published', '2025-06-08 06:30:10', '2025-06-08 06:48:58', '4', 'Berline', 550);

-- --------------------------------------------------------

--
-- Structure de la table `car_tag`
--

CREATE TABLE `car_tag` (
  `car_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `collection`
--

CREATE TABLE `collection` (
  `id` int(10) UNSIGNED NOT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL COMMENT 'Opérateur propriétaire de la collection',
  `title` varchar(100) NOT NULL COMMENT 'Ex: Nouveautés, Coup de cœur, etc.',
  `slug` varchar(100) NOT NULL COMMENT 'Utilisable dans l''URL ou pour requêtes',
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `collection_car`
--

CREATE TABLE `collection_car` (
  `collection_id` int(10) UNSIGNED NOT NULL,
  `car_id` int(10) UNSIGNED NOT NULL,
  `sort_order` int(10) UNSIGNED DEFAULT 0 COMMENT 'Pour définir l''ordre d''apparition',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL COMMENT 'Optional for registered users',
  `phone` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `driving_license` varchar(50) DEFAULT NULL,
  `license_issue_date` date DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `is_spam` tinyint(1) DEFAULT 0,
  `operator_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `operator`
--

CREATE TABLE `operator` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'Hashed with password_hash()',
  `email` varchar(100) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `operator`
--

INSERT INTO `operator` (`id`, `username`, `password`, `email`, `last_login`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'mergim', 'mergim', 'admin1@example.com', NULL, 1, '2024-12-31 23:00:00', '2025-06-02 18:48:56'),
(2, 'admin2', '$2y$10$examplehashedpassword2', 'admin2@example.com', NULL, 1, '2024-12-31 23:00:00', '2024-12-31 23:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('credit_card','bank_transfer','cash','other') NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','completed','failed','refunded') DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

CREATE TABLE `review` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `car_id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `is_published` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `search`
--

CREATE TABLE `search` (
  `id` int(10) UNSIGNED NOT NULL,
  `visitor_id` int(10) UNSIGNED DEFAULT NULL,
  `query` varchar(255) NOT NULL,
  `results_count` int(10) UNSIGNED DEFAULT 0,
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `type` enum('feature','category','theme','custom') DEFAULT 'custom',
  `parent_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Hiérarchie pour tags',
  `operator_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Créateur du tag (admin)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `name`, `slug`, `type`, `parent_id`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'Supercar', 'supercar', 'category', NULL, 1, '2024-12-31 23:00:00', '2025-06-08 05:20:46'),
(2, 'Hypercar', 'hypercar', 'category', NULL, 1, '2024-12-31 23:00:00', '2025-06-08 05:21:05'),
(3, 'Thème Générique', 'theme-generique', 'theme', NULL, 1, '2024-12-31 23:00:00', '2024-12-31 23:00:00'),
(7, 'Coupé', 'coupé', 'category', NULL, NULL, '2025-06-08 05:15:04', '2025-06-08 06:07:20'),
(8, 'Cabriolet', 'cabriolet', 'category', NULL, NULL, '2025-06-08 05:15:40', '2025-06-08 05:15:40'),
(9, 'Citadine', 'citadine', 'category', NULL, NULL, '2025-06-08 05:15:52', '2025-06-08 05:15:52'),
(10, 'Berline', 'berline', 'category', NULL, NULL, '2025-06-08 05:17:39', '2025-06-08 05:17:39'),
(11, 'Break', 'break', 'category', NULL, NULL, '2025-06-08 05:17:47', '2025-06-08 05:17:47'),
(12, 'SUV', 'suv', 'category', NULL, NULL, '2025-06-08 05:17:59', '2025-06-08 05:17:59'),
(13, '4x4', '4x4', 'category', NULL, NULL, '2025-06-08 05:18:14', '2025-06-08 05:18:14'),
(14, 'Mariage', 'mariage', 'theme', NULL, NULL, '2025-06-08 05:18:25', '2025-06-08 05:18:25'),
(15, 'Business', 'business', 'theme', NULL, NULL, '2025-06-08 05:18:33', '2025-06-08 05:18:33'),
(16, 'Weekend', 'weekend', 'theme', NULL, NULL, '2025-06-08 05:18:40', '2025-06-08 05:18:40'),
(17, 'Circuit', 'circuit', 'theme', NULL, NULL, '2025-06-08 05:18:48', '2025-06-08 05:18:48'),
(18, 'Plaisir', 'plaisir', 'theme', NULL, NULL, '2025-06-08 05:19:02', '2025-06-08 05:19:02'),
(19, 'Adrénaline', 'adrnaline', 'theme', NULL, NULL, '2025-06-08 05:19:10', '2025-06-08 05:19:10');

-- --------------------------------------------------------

--
-- Structure de la table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(10) UNSIGNED NOT NULL,
  `visitor_token` varchar(255) NOT NULL COMMENT 'Session or cookie-based identifier',
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `dark_mode` tinyint(1) DEFAULT 0,
  `font_size` enum('small','medium','large') DEFAULT 'medium',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_activity` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_booking_number` (`booking_number`),
  ADD KEY `idx_booking_customer_id` (`customer_id`),
  ADD KEY `idx_booking_car_id` (`car_id`);

--
-- Index pour la table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_brand_name` (`name`),
  ADD UNIQUE KEY `uniq_brand_slug` (`slug`);

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_car_slug` (`slug`),
  ADD KEY `idx_car_operator_id` (`operator_id`),
  ADD KEY `idx_car_brand_id` (`brand_id`),
  ADD KEY `idx_car_category_tag_id` (`category_tag_id`),
  ADD KEY `idx_car_theme_tag_id` (`theme_tag_id`);

--
-- Index pour la table `car_tag`
--
ALTER TABLE `car_tag`
  ADD PRIMARY KEY (`car_id`,`tag_id`),
  ADD KEY `car_tag_ibfk_2` (`tag_id`);

--
-- Index pour la table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_collection_slug` (`slug`),
  ADD KEY `idx_collection_operator_id` (`operator_id`);

--
-- Index pour la table `collection_car`
--
ALTER TABLE `collection_car`
  ADD PRIMARY KEY (`collection_id`,`car_id`),
  ADD KEY `idx_collection_car_car_id` (`car_id`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_customer_email` (`email`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_message_operator_id` (`operator_id`);

--
-- Index pour la table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_operator_username` (`username`),
  ADD UNIQUE KEY `uniq_operator_email` (`email`);

--
-- Index pour la table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_payment_booking_id` (`booking_id`);

--
-- Index pour la table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_review_customer_id` (`customer_id`),
  ADD KEY `idx_review_car_id` (`car_id`),
  ADD KEY `idx_review_booking_id` (`booking_id`);

--
-- Index pour la table `search`
--
ALTER TABLE `search`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_search_visitor_id` (`visitor_id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_tag_name` (`name`),
  ADD UNIQUE KEY `uniq_tag_slug` (`slug`),
  ADD KEY `idx_tag_operator_id` (`operator_id`);

--
-- Index pour la table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_visitor_token` (`visitor_token`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `search`
--
ALTER TABLE `search`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_car` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`),
  ADD CONSTRAINT `fk_booking_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Contraintes pour la table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`id`),
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `car_ibfk_3` FOREIGN KEY (`category_tag_id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `car_ibfk_4` FOREIGN KEY (`theme_tag_id`) REFERENCES `tag` (`id`);

--
-- Contraintes pour la table `car_tag`
--
ALTER TABLE `car_tag`
  ADD CONSTRAINT `car_tag_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `car_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `fk_collection_operator` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`id`);

--
-- Contraintes pour la table `collection_car`
--
ALTER TABLE `collection_car`
  ADD CONSTRAINT `fk_collection_car_car` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_collection_car_collection` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_operator` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`);

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_review_car` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_review_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `search`
--
ALTER TABLE `search`
  ADD CONSTRAINT `fk_search_visitor` FOREIGN KEY (`visitor_id`) REFERENCES `visitor` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `fk_tag_operator` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
