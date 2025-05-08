-- Table des administrateurs (opérateurs)
CREATE TABLE operator (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL COMMENT 'Hashed with password_hash()',
    email VARCHAR(100) NOT NULL UNIQUE,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des visiteurs (préférences anonymes ou loguées)
CREATE TABLE visitor (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    visitor_token VARCHAR(255) NOT NULL UNIQUE COMMENT 'Session or cookie-based identifier',
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    dark_mode BOOLEAN DEFAULT FALSE,
    font_size ENUM('small', 'medium', 'large') DEFAULT 'medium',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_activity TIMESTAMP NULL
);

-- Table des tags (fonctionnalités, etc.)
CREATE TABLE tag (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    slug VARCHAR(50) NOT NULL UNIQUE,
    type ENUM('feature', 'category', 'theme', 'custom') DEFAULT 'custom',
    parent_id INT UNSIGNED NULL COMMENT 'Hiérarchie pour tags',
    operator_id INT UNSIGNED NULL COMMENT 'Créateur du tag (admin)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (parent_id) REFERENCES tag(id) ON DELETE SET NULL,
    FOREIGN KEY (operator_id) REFERENCES operator(id) ON DELETE SET NULL
);

-- Table des marques de voitures
CREATE TABLE brand (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    slug VARCHAR(100) NOT NULL UNIQUE,
    logo VARCHAR(255) NULL COMMENT 'Path to brand logo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des voitures (items à louer)
CREATE TABLE car (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    operator_id INT UNSIGNED NOT NULL,
    brand_id INT UNSIGNED NOT NULL,
    category_tag_id INT UNSIGNED NOT NULL COMMENT 'Tag pour la catégorie (SUV, berline, etc.)',
    theme_tag_id INT UNSIGNED NOT NULL COMMENT 'Tag pour le thème (mariage, business, etc.)',
    model VARCHAR(100) NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    content LONGTEXT,
    year INT UNSIGNED NOT NULL COMMENT 'Year of manufacture',
    seats INT UNSIGNED DEFAULT 2 COMMENT 'Number of seats',
    doors INT UNSIGNED DEFAULT 2 COMMENT 'Number of doors',
    transmission ENUM('automatic', 'manual', 'semi-automatic') DEFAULT 'automatic',
    fuel_type ENUM('gasoline', 'diesel', 'hybrid', 'electric') DEFAULT 'gasoline',
    horsepower INT UNSIGNED NULL,
    top_speed INT UNSIGNED NULL COMMENT 'Top speed in km/h',
    acceleration DECIMAL(4,1) NULL COMMENT '0-100 km/h in seconds',
    image VARCHAR(255) NULL COMMENT 'Main image path',
    price DECIMAL(10,2) NOT NULL COMMENT 'Rental price per day',
    deposit DECIMAL(10,2) NULL COMMENT 'Security deposit amount',
    stock INT UNSIGNED DEFAULT 1 COMMENT 'Number of same models available',
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (operator_id) REFERENCES operator(id) ON DELETE RESTRICT,
    FOREIGN KEY (brand_id) REFERENCES brand(id) ON DELETE RESTRICT,
    FOREIGN KEY (category_tag_id) REFERENCES tag(id) ON DELETE RESTRICT,
    FOREIGN KEY (theme_tag_id) REFERENCES tag(id) ON DELETE RESTRICT
);

-- Table de liaison voiture <-> tag
CREATE TABLE car_tag (
    car_id INT UNSIGNED NOT NULL,
    tag_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (car_id, tag_id),
    FOREIGN KEY (car_id) REFERENCES car(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tag(id) ON DELETE CASCADE
);

-- Table des mises en avant éditoriales
CREATE TABLE collection (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    operator_id INT UNSIGNED NOT NULL COMMENT 'Opérateur propriétaire de la collection',
    title VARCHAR(100) NOT NULL COMMENT 'Ex: Nouveautés, Coup de cœur, etc.',
    slug VARCHAR(100) NOT NULL UNIQUE COMMENT 'Utilisable dans l''URL ou pour requêtes',
    description TEXT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (operator_id) REFERENCES operator(id) ON DELETE RESTRICT
);

-- Table de liaison collection <-> car
CREATE TABLE collection_car (
    collection_id INT UNSIGNED NOT NULL,
    car_id INT UNSIGNED NOT NULL,
    sort_order INT UNSIGNED DEFAULT 0 COMMENT 'Pour définir l''ordre d''apparition',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (collection_id, car_id),
    FOREIGN KEY (collection_id) REFERENCES collection(id) ON DELETE CASCADE,
    FOREIGN KEY (car_id) REFERENCES car(id) ON DELETE CASCADE
);

-- Table des clients
CREATE TABLE customer (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NULL COMMENT 'Optional for registered users',
    phone VARCHAR(20) NOT NULL,
    address TEXT NULL,
    city VARCHAR(100) NULL,
    postal_code VARCHAR(20) NULL,
    country VARCHAR(100) NULL,
    driving_license VARCHAR(50) NULL,
    license_issue_date DATE NULL,
    date_of_birth DATE NULL,
    is_verified BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des réservations
CREATE TABLE booking (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    booking_number VARCHAR(20) NOT NULL UNIQUE,
    customer_id INT UNSIGNED NOT NULL,
    car_id INT UNSIGNED NOT NULL,
    pickup_date DATETIME NOT NULL,
    return_date DATETIME NOT NULL,
    duration INT UNSIGNED NULL COMMENT 'Nombre de jours de location',
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'canceled', 'completed') DEFAULT 'pending',
    payment_status ENUM('pending', 'partial', 'paid', 'refunded') DEFAULT 'pending',
    notes TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE RESTRICT,
    FOREIGN KEY (car_id) REFERENCES car(id) ON DELETE RESTRICT
);

-- Trigger pour calculer automatiquement la durée en jours
DELIMITER //
CREATE TRIGGER before_booking_insert
BEFORE INSERT ON booking
FOR EACH ROW
BEGIN
    SET NEW.duration = DATEDIFF(NEW.return_date, NEW.pickup_date);
END //

CREATE TRIGGER before_booking_update
BEFORE UPDATE ON booking
FOR EACH ROW
BEGIN
    SET NEW.duration = DATEDIFF(NEW.return_date, NEW.pickup_date);
END //
DELIMITER ;

-- Table des paiements
CREATE TABLE payment (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    booking_id INT UNSIGNED NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('credit_card', 'bank_transfer', 'cash', 'other') NOT NULL,
    transaction_id VARCHAR(255) NULL,
    status ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    payment_date TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (booking_id) REFERENCES booking(id) ON DELETE RESTRICT
);

-- Table des recherches (historique, stats)
CREATE TABLE search (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    visitor_id INT UNSIGNED NULL,
    query VARCHAR(255) NOT NULL,
    results_count INT UNSIGNED DEFAULT 0,
    session_id VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (visitor_id) REFERENCES visitor(id) ON DELETE SET NULL
);

-- Table des avis clients
CREATE TABLE review (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id INT UNSIGNED NOT NULL,
    car_id INT UNSIGNED NOT NULL,
    booking_id INT UNSIGNED NULL,
    rating TINYINT UNSIGNED NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT NULL,
    is_verified BOOLEAN DEFAULT FALSE,
    is_published BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE,
    FOREIGN KEY (car_id) REFERENCES car(id) ON DELETE CASCADE,
    FOREIGN KEY (booking_id) REFERENCES booking(id) ON DELETE SET NULL
);

-- Table des messages de contact
CREATE TABLE message (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    is_spam BOOLEAN DEFAULT FALSE,
    operator_id INT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    read_at TIMESTAMP NULL,
    
    FOREIGN KEY (operator_id) REFERENCES operator(id) ON DELETE SET NULL
);