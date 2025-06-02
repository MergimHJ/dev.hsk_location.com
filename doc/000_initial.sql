CREATE TABLE `operator` (
  `id` INT UNSIGNED,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL COMMENT 'Hashed with password_hash()',
  `email` VARCHAR(100) NOT NULL,
  `last_login` TIMESTAMP NULL,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `visitor` (
  `id` INT UNSIGNED,
  `visitor_token` VARCHAR(255) NOT NULL COMMENT 'Session or cookie-based identifier',
  `ip_address` VARCHAR(45) NULL,
  `user_agent` TEXT NULL,
  `dark_mode` BOOLEAN DEFAULT FALSE,
  `font_size` ENUM('small','medium','large') DEFAULT 'medium',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_activity` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tag` (
  `id` INT UNSIGNED,
  `name` VARCHAR(50) NOT NULL,
  `slug` VARCHAR(50) NOT NULL,
  `type` ENUM('feature','category','theme','custom') DEFAULT 'custom',
  `parent_id` INT UNSIGNED NULL COMMENT 'Hiérarchie pour tags',
  `operator_id` INT UNSIGNED NULL COMMENT 'Créateur du tag (admin)',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `brand` (
  `id` INT UNSIGNED,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL,
  `logo` VARCHAR(255) NULL COMMENT 'Path to brand logo',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `car` (
  `id` INT UNSIGNED,
  `operator_id` INT UNSIGNED NOT NULL,
  `brand_id` INT UNSIGNED NOT NULL,
  `category_tag_id` INT UNSIGNED NOT NULL COMMENT 'Tag pour la catégorie (SUV, berline, etc.)',
  `theme_tag_id` INT UNSIGNED NOT NULL COMMENT 'Tag pour le thème (mariage, business, etc.)',
  `model` VARCHAR(100) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `content` LONGTEXT DEFAULT NULL,
  `year` INT UNSIGNED NOT NULL COMMENT 'Year of manufacture',
  `seats` INT UNSIGNED DEFAULT 2 COMMENT 'Number of seats',
  `doors` INT UNSIGNED DEFAULT 2 COMMENT 'Number of doors',
  `transmission` ENUM('automatic','manual','semi-automatic') DEFAULT 'automatic',
  `fuel_type` ENUM('gasoline','diesel','hybrid','electric') DEFAULT 'gasoline',
  `horsepower` INT UNSIGNED DEFAULT NULL,
  `top_speed` INT UNSIGNED DEFAULT NULL COMMENT 'Top speed in km/h',
  `acceleration` DECIMAL(4,1) DEFAULT NULL COMMENT '0-100 km/h in seconds',
  `image` VARCHAR(255) DEFAULT NULL COMMENT 'Main image path',
  `cylinders` INT(16) NOT NULL COMMENT 'cylinders',
  `deposit` DECIMAL(10,2) DEFAULT NULL COMMENT 'Security deposit amount',
  `stock` INT UNSIGNED DEFAULT 1 COMMENT 'Number of same models available',
  `status` ENUM('draft','published','archived') DEFAULT 'draft',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wheel-transmission` INT(11) NOT NULL,
  `carrosserie` VARCHAR(50) NOT NULL,
  `price` INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `car_tag` (
  `car_id` INT UNSIGNED NOT NULL,
  `tag_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `collection` (
  `id` INT UNSIGNED,
  `operator_id` INT UNSIGNED NOT NULL COMMENT 'Opérateur propriétaire de la collection',
  `title` VARCHAR(100) NOT NULL COMMENT 'Ex: Nouveautés, Coup de cœur, etc.',
  `slug` VARCHAR(100) NOT NULL COMMENT 'Utilisable dans l''URL ou pour requêtes',
  `description` TEXT NULL,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `collection_car` (
  `collection_id` INT UNSIGNED NOT NULL,
  `car_id` INT UNSIGNED NOT NULL,
  `sort_order` INT UNSIGNED DEFAULT 0 COMMENT 'Pour définir l''ordre d''apparition',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `customer` (
  `id` INT UNSIGNED,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NULL COMMENT 'Optional for registered users',
  `phone` VARCHAR(20) NOT NULL,
  `address` TEXT NULL,
  `city` VARCHAR(100) NULL,
  `postal_code` VARCHAR(20) NULL,
  `country` VARCHAR(100) NULL,
  `driving_license` VARCHAR(50) NULL,
  `license_issue_date` DATE NULL,
  `date_of_birth` DATE NULL,
  `is_verified` BOOLEAN DEFAULT FALSE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `booking` (
  `id` INT UNSIGNED,
  `booking_number` VARCHAR(20) NOT NULL,
  `customer_id` INT UNSIGNED NOT NULL,
  `car_id` INT UNSIGNED NOT NULL,
  `pickup_date` DATETIME NOT NULL,
  `return_date` DATETIME NOT NULL,
  `duration` INT UNSIGNED DEFAULT NULL COMMENT 'Nombre de jours de location',
  `total_price` DECIMAL(10,2) NOT NULL,
  `status` ENUM('pending','confirmed','canceled','completed') DEFAULT 'pending',
  `payment_status` ENUM('pending','partial','paid','refunded') DEFAULT 'pending',
  `notes` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `payment` (
  `id` INT UNSIGNED,
  `booking_id` INT UNSIGNED NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `payment_method` ENUM('credit_card','bank_transfer','cash','other') NOT NULL,
  `transaction_id` VARCHAR(255) NULL,
  `status` ENUM('pending','completed','failed','refunded') DEFAULT 'pending',
  `payment_date` TIMESTAMP NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `search` (
  `id` INT UNSIGNED,
  `visitor_id` INT UNSIGNED NULL,
  `query` VARCHAR(255) NOT NULL,
  `results_count` INT UNSIGNED DEFAULT 0,
  `session_id` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `review` (
  `id` INT UNSIGNED,
  `customer_id` INT UNSIGNED NOT NULL,
  `car_id` INT UNSIGNED NOT NULL,
  `booking_id` INT UNSIGNED NULL,
  `rating` TINYINT UNSIGNED NOT NULL CHECK (rating BETWEEN 1 AND 5),
  `comment` TEXT NULL,
  `is_verified` BOOLEAN DEFAULT FALSE,
  `is_published` BOOLEAN DEFAULT FALSE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `message` (
  `id` INT UNSIGNED,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `subject` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `is_read` BOOLEAN DEFAULT FALSE,
  `is_spam` BOOLEAN DEFAULT FALSE,
  `operator_id` INT UNSIGNED NULL,
  `ip_address` VARCHAR(45) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `read_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- 2) Ajout des PK, UNIQ, INDEX et FK via ALTER TABLE
--

-- Table operator
ALTER TABLE `operator`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_operator_username` (`username`),
  ADD UNIQUE KEY `uniq_operator_email` (`email`);

-- Table visitor
ALTER TABLE `visitor`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_visitor_token` (`visitor_token`);

-- Table tag
ALTER TABLE `tag`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_tag_name` (`name`),
  ADD UNIQUE KEY `uniq_tag_slug` (`slug`),
  ADD KEY `idx_tag_operator_id` (`operator_id`),
  ADD CONSTRAINT `fk_tag_operator` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`id`) ON DELETE SET NULL;

-- Table brand
ALTER TABLE `brand`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_brand_name` (`name`),
  ADD UNIQUE KEY `uniq_brand_slug` (`slug`);

-- Table car
ALTER TABLE `car`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_car_slug` (`slug`),
  ADD KEY `idx_car_operator_id` (`operator_id`),
  ADD KEY `idx_car_brand_id` (`brand_id`),
  ADD KEY `idx_car_category_tag_id` (`category_tag_id`),
  ADD KEY `idx_car_theme_tag_id` (`theme_tag_id`),
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `car_ibfk_3` FOREIGN KEY (`category_tag_id`) REFERENCES `tag` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `car_ibfk_4` FOREIGN KEY (`theme_tag_id`) REFERENCES `tag` (`id`) ON DELETE RESTRICT;

-- Table car_tag
ALTER TABLE `car_tag`
  ADD PRIMARY KEY (`car_id`, `tag_id`),
  ADD CONSTRAINT `car_tag_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `car_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

-- Table collection
ALTER TABLE `collection`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_collection_slug` (`slug`),
  ADD KEY `idx_collection_operator_id` (`operator_id`),
  ADD CONSTRAINT `fk_collection_operator` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`id`) ON DELETE RESTRICT;

-- Table collection_car
ALTER TABLE `collection_car`
  ADD PRIMARY KEY (`collection_id`, `car_id`),
  ADD KEY `idx_collection_car_car_id` (`car_id`),
  ADD CONSTRAINT `fk_collection_car_collection` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_collection_car_car` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE;

-- Table customer
ALTER TABLE `customer`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_customer_email` (`email`);

-- Table booking
ALTER TABLE `booking`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_booking_number` (`booking_number`),
  ADD KEY `idx_booking_customer_id` (`customer_id`),
  ADD KEY `idx_booking_car_id` (`car_id`),
  ADD CONSTRAINT `fk_booking_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `fk_booking_car` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE RESTRICT;

-- Table payment
ALTER TABLE `payment`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_payment_booking_id` (`booking_id`),
  ADD CONSTRAINT `fk_payment_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE RESTRICT;

-- Table search
ALTER TABLE `search`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_search_visitor_id` (`visitor_id`),
  ADD CONSTRAINT `fk_search_visitor` FOREIGN KEY (`visitor_id`) REFERENCES `visitor` (`id`) ON DELETE SET NULL;

-- Table review
ALTER TABLE `review`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_review_customer_id` (`customer_id`),
  ADD KEY `idx_review_car_id` (`car_id`),
  ADD KEY `idx_review_booking_id` (`booking_id`),
  ADD CONSTRAINT `fk_review_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_review_car` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_review_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE SET NULL;

-- Table message
ALTER TABLE `message`
  MODIFY COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_message_operator_id` (`operator_id`),
  ADD CONSTRAINT `fk_message_operator` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`id`) ON DELETE SET NULL;
