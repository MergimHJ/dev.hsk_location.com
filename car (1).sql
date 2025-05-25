-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 25 mai 2025 à 15:05
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
-- Base de données : `dev.hsk_location.com`
--

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
  `wheel-transmission` int(11) NOT NULL,
  `carrosserie` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `operator_id`, `brand_id`, `category_tag_id`, `theme_tag_id`, `model`, `title`, `slug`, `description`, `content`, `year`, `seats`, `doors`, `transmission`, `fuel_type`, `horsepower`, `top_speed`, `acceleration`, `image`, `cylinders`, `deposit`, `stock`, `status`, `created_at`, `updated_at`, `wheel-transmission`, `carrosserie`, `price`) VALUES
(1, 1, 4, 1, 1, '488 GTB', 'Ferrari 488 GTB', 'ferrari-488-gtb', 'Voiture de sport italienne emblématique aux performances explosives.', 'Avec son moteur V8 bi-turbo de 670 ch, la Ferrari 488 GTB est conçue pour offrir sensations fortes et prestige.', 2020, 2, 2, 'automatic', 'gasoline', 670, 330, 3.0, 'ferrari-488-gtb.webp', 12, 5000.00, 1, 'published', '2025-05-12 17:09:59', '2025-05-21 18:59:16', 0, '', 0),
(2, 1, 2, 1, 1, 'Huracán Evo', 'Lamborghini Huracán Evo', 'lamborghini-huracan-evo', 'Un coupé sportif à la fois brutal et raffiné.', 'Dotée d’un V10 atmosphérique, la Huracán Evo incarne la puissance pure et l’élégance italienne.', 2021, 2, 2, 'automatic', 'gasoline', 640, 325, 2.9, 'lamborghini_huracan_evo.jpg', 1099, 6000.00, 1, 'published', '2025-05-12 17:09:59', '2025-05-21 18:59:48', 0, '', 0),
(3, 1, 6, 1, 2, '911 Turbo S', 'Porsche 911 Turbo S', 'porsche-911-turbo-s', 'Le mélange parfait entre sportivité, élégance et confort.', 'La Porsche 911 Turbo S est une icône des voitures sportives avec ses performances impressionnantes et sa finition irréprochable.', 2022, 4, 2, 'automatic', 'gasoline', 650, 330, 2.7, '911-turbo-s.webp', 899, 4000.00, 2, 'published', '2025-05-12 17:09:59', '2025-05-21 19:00:07', 0, '', 0),
(4, 2, 7, 1, 3, 'Continental GT', 'Bentley Continental GT V8', 'bentley-continental-gt-v8', 'Coupé de luxe à la fois puissant et confortable.', 'La Bentley Continental GT incarne le summum du luxe britannique avec un moteur V8 dynamique.', 2022, 4, 2, 'automatic', 'gasoline', 550, 318, 3.9, 'bentley-continental-gt.webp', 799, 3500.00, 1, 'published', '2025-05-12 17:09:59', '2025-05-21 19:01:06', 0, '', 0),
(5, 2, 1, 1, 3, 'S-Class Coupé', 'Mercedes-Benz S 63 AMG Coupé', 'mercedes-s63-amg-coupe', 'L’alliance ultime du luxe et des performances signée AMG.', 'Ce coupé Mercedes impressionne par sa prestance, son moteur V8 Biturbo et son confort intérieur exceptionnel.', 2020, 4, 2, 'automatic', 'gasoline', 612, 300, 3.5, 'mercedes-amg-s63-coupe.webp', 749, 3000.00, 2, 'published', '2025-05-12 17:09:59', '2025-05-21 19:01:30', 0, '', 0),
(6, 1, 2, 1, 3, 'M8 Competition', 'BMW M8 Competition Coupé', 'bmw-m8-competition', 'La version la plus puissante de BMW avec luxe et performance.', 'Avec 625 chevaux sous le capot, la M8 Competition offre une expérience digne des supercars.', 2021, 4, 2, 'automatic', 'gasoline', 625, 305, 3.2, 'bmw-m8-competition.webp', 649, 3000.00, 2, 'published', '2025-05-12 17:34:51', '2025-05-21 19:01:42', 0, '', 0),
(7, 2, 3, 1, 1, 'R8 V10 Plus', 'Audi R8 V10 Plus', 'audi-r8-v10', 'La supercar d’Audi avec moteur V10 central.', 'L’Audi R8 V10 Plus allie élégance, technologie quattro et puissance déchaînée.', 2020, 2, 2, 'automatic', 'gasoline', 610, 330, 3.1, 'r8-v10.jpg', 899, 4000.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-22 17:17:27', 0, '', 0),
(8, 1, 8, 1, 1, 'DB11', 'Aston Martin DB11 V8', 'aston-martin-db-11', 'La classe britannique par excellence.', 'Mélange de puissance et de raffinement, la DB11 est idéale pour les escapades de prestige.', 2021, 2, 2, 'automatic', 'gasoline', 503, 300, 4.0, 'db-11.jpg', 749, 3500.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-22 17:19:06', 0, '', 0),
(9, 2, 9, 1, 3, 'Ghibli Trofeo', 'Maserati Ghibli Trofeo', 'maserati-ghibli-trofeo', 'Berline de luxe italienne avec un moteur Ferrari.', 'Le luxe et la sportivité réunis dans cette version Trofeo très haut de gamme.', 2022, 5, 4, 'automatic', 'gasoline', 580, 326, 4.3, 'maserati_ghibli_trofeo.jpg', 699, 3500.00, 2, 'published', '2025-05-12 17:34:51', '2025-05-21 19:02:22', 0, '', 0),
(10, 1, 10, 1, 2, 'Wraith', 'Rolls-Royce Wraith', 'rolls-royce-wraith', 'Le grand luxe dans un coupé majestueux.', 'La Wraith représente le summum de l’élégance, avec un moteur V12 et un intérieur somptueux.', 2020, 4, 2, 'automatic', 'gasoline', 624, 250, 4.4, 'rr-wraith.jpg', 1299, 8000.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-21 19:02:34', 0, '', 0),
(11, 2, 11, 1, 3, '720S', 'McLaren 720S', 'mclaren-720s', 'Supercar anglaise au look futuriste.', 'Avec son châssis en carbone et son moteur V8 biturbo, la 720S offre des performances de piste.', 2022, 2, 2, 'automatic', 'gasoline', 720, 341, 2.8, '720S.webp', 1149, 7000.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-21 19:02:48', 0, '', 0),
(12, 1, 6, 1, 2, 'Panamera Turbo S', 'Porsche Panamera Turbo S', 'panamera-turbo-s', 'Berline de luxe avec performances de supercar.', 'La Panamera Turbo S combine confort de grande routière et motorisation ultra-sportive.', 2021, 4, 4, 'automatic', 'hybrid', 700, 315, 3.1, 'panamera-turbo-s.jpg', 799, 4000.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-22 17:19:33', 0, '', 0),
(13, 2, 2, 1, 3, 'i8 Roadster', 'BMW i8 Roadster Hybride', 'bmw-i8-roadster', 'Design futuriste et technologie hybride.', 'Le BMW i8 Roadster allie performances et conduite électrique dans un écrin de luxe.', 2020, 2, 2, 'automatic', 'hybrid', 374, 250, 4.6, 'i8-roadster.jpg', 599, 2500.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-21 19:03:12', 0, '', 0),
(14, 2, 12, 1, 2, 'LC 500', 'Lexus LC 500 Sport+', 'lexus-lc-500', 'Coupé japonais au look audacieux et moteur V8.', 'La Lexus LC 500 combine style, confort haut de gamme et performances routières solides.', 2021, 4, 2, 'automatic', 'gasoline', 471, 270, 4.4, 'lc-500.jpg', 649, 3000.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-21 19:03:22', 0, '', 0),
(15, 1, 13, 1, 1, 'Model S Plaid', 'Tesla Model S Plaid', 'model-s-plaid', 'La berline électrique la plus rapide du marché.', 'La Tesla Model S Plaid combine accélération fulgurante et technologie de pointe 100% électrique.', 2023, 5, 4, 'automatic', 'electric', 1020, 322, 2.1, 'tesla-model-s-plaid.jpg', 849, 4000.00, 2, 'published', '2025-05-12 17:34:51', '2025-05-22 17:27:30', 0, '', 0),
(16, 1, 2, 2, 3, 'M2 Competition', 'BMW M2 Competition', 'bmw-m2-competition', 'Coupé compact et musclé, symbole du plaisir de conduite BMW.', 'Avec son moteur 6 cylindres biturbo, la M2 offre un excellent rapport puissance/agilité.', 2020, 4, 2, 'manual', 'gasoline', 410, 280, 4.2, 'm2-competition.avif', 449, 2000.00, 2, 'published', '2025-05-12 17:44:52', '2025-05-21 19:07:51', 0, '', 0),
(17, 1, 2, 2, 3, 'M140i', 'BMW M140i xDrive', 'bmw-m140i', 'Une compacte puissante et discrète.', 'Dotée d’un 6 cylindres en ligne, la M140i allie performance et polyvalence.', 2020, 5, 5, 'automatic', 'gasoline', 340, 250, 4.6, 'm140i.webp', 399, 1800.00, 2, 'published', '2025-05-12 17:44:52', '2025-05-21 19:29:35', 0, '', 0),
(18, 1, 3, 2, 1, 'RS3 Sportback', 'Audi RS3 Sportback', 'audi-rs3', 'La compacte explosive d’Audi avec moteur 5 cylindres.', 'La RS3 est redoutable en ligne droite comme sur routes sinueuses.', 2022, 5, 5, 'automatic', 'gasoline', 400, 290, 3.8, 'audi-rs3.webp', 449, 2000.00, 2, 'published', '2025-05-12 17:44:52', '2025-05-22 17:20:10', 0, '', 0),
(19, 2, 3, 2, 3, 'S3 Berline', 'Audi S3 Berline', 'audi-s3', 'La petite sœur de la RS3, efficace et plus accessible.', 'Une voiture agile et classe avec transmission quattro.', 2021, 5, 4, 'automatic', 'gasoline', 310, 250, 4.8, 'audi-s3.jpg', 349, 1500.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:20:20', 0, '', 0),
(20, 2, 1, 2, 3, 'A45 S AMG', 'Mercedes-AMG A45 S 4MATIC+', 'mercedes-a45-s', 'La compacte la plus puissante du marché.', 'Avec 421 chevaux et une transmission 4MATIC+, l’A45 S est une véritable bombe.', 2022, 5, 5, 'automatic', 'gasoline', 421, 270, 3.9, 'a45-s.jpg', 499, 2500.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:20:32', 0, '', 0),
(21, 1, 1, 2, 3, 'CLA 45 AMG', 'Mercedes-AMG CLA 45 S', 'mercedes-cla45-s', 'Berline compacte au look racé.', 'La CLA 45 S allie design agressif et puissance impressionnante pour une compacte.', 2021, 5, 4, 'automatic', 'gasoline', 421, 270, 4.0, 'cla-45.jpg', 489, 2300.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:20:41', 0, '', 0),
(22, 2, 14, 2, 3, 'Golf 8 R', 'Volkswagen Golf 8 R', 'volkswagen-golf-8r', 'La Golf la plus performante jamais produite.', 'Avec 320 chevaux, 4 roues motrices et un châssis affûté, la Golf R reste une référence.', 2022, 5, 5, 'automatic', 'gasoline', 320, 270, 4.7, 'volkswagen-golf-8r.jpg', 429, 1800.00, 2, 'published', '2025-05-12 17:44:52', '2025-05-22 17:20:55', 0, '', 0),
(23, 1, 14, 2, 3, 'Golf 7 GTI Clubsport', 'Volkswagen Golf GTI Clubsport', 'gti-clubsport', 'Version la plus affûtée de la GTI.', 'Un équilibre entre sportivité, confort et efficacité redoutable sur route.', 2020, 5, 5, 'automatic', 'gasoline', 300, 250, 5.2, 'gti-clubsport.webp', 349, 1600.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:27:19', 0, '', 0),
(24, 2, 15, 2, 3, 'Leon Cupra R', 'Cupra Leon R ST', 'leon-r-st', 'Compacte espagnole très sportive.', 'Une voiture familiale au tempérament de feu avec un châssis affûté et 310 ch.', 2021, 5, 5, 'automatic', 'gasoline', 310, 250, 4.9, 'seat-leon-r-st.jpg', 369, 1700.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:27:06', 0, '', 0),
(25, 1, 16, 2, 3, 'Megane RS Trophy', 'Renault Mégane RS Trophy', 'megane-rs-trophy', 'La compacte française la plus radicale.', 'Avec un châssis Cup, la Mégane RS Trophy est une vraie pistarde homologuée route.', 2020, 5, 5, 'manual', 'gasoline', 300, 260, 5.7, 'megane-rs-trophy.jpg', 329, 1400.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:26:55', 0, '', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_tag_id` (`category_tag_id`),
  ADD KEY `theme_tag_id` (`theme_tag_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`id`),
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `car_ibfk_3` FOREIGN KEY (`category_tag_id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `car_ibfk_4` FOREIGN KEY (`theme_tag_id`) REFERENCES `tag` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
