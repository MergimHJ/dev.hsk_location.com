
-- ---------------------------------------------------------------------
-- INSERTS pour préremplir les tables nécessaires avant d’insérer dans `car`
-- ---------------------------------------------------------------------

-- 1) Opérateurs (operator_id = 1 et 2)
INSERT INTO `operator` (
  `id`, `username`, `password`, `email`, `is_active`, `created_at`, `updated_at`
) VALUES
  (1, 'admin1', '$2y$10$examplehashedpassword1', 'admin1@example.com', TRUE, '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (2, 'admin2', '$2y$10$examplehashedpassword2', 'admin2@example.com', TRUE, '2025-01-01 00:00:00', '2025-01-01 00:00:00');

-- 2) Marques (brand_id ∈ {1,2,3,4,6,7,8,9,10,11,12,13,14,15,16})
INSERT INTO `brand` (
  `id`, `name`, `slug`, `created_at`, `updated_at`
) VALUES
  (1,  'Mercedes-Benz',      'mercedes-benz',      '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (2,  'BMW',                'bmw',                '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (3,  'Audi',               'audi',               '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (4,  'Ferrari',            'ferrari',            '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (6,  'Porsche',            'porsche',            '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (7,  'Bentley',            'bentley',            '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (8,  'Aston Martin',       'aston-martin',       '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (9,  'Maserati',           'maserati',           '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (10, 'Rolls-Royce',        'rolls-royce',        '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (11, 'McLaren',            'mclaren',            '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (12, 'Lexus',              'lexus',              '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (13, 'Tesla',              'tesla',              '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (14, 'Volkswagen',         'volkswagen',         '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (15, 'Cupra',              'cupra',              '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (16, 'Renault',            'renault',            '2025-01-01 00:00:00', '2025-01-01 00:00:00');

-- 3) Tags (category_tag_id ∈ {1,2} et theme_tag_id ∈ {1,2,3})
--    On crée :
--    • id = 1 et 2 en type 'category'  
--    • id = 3    en type 'theme'
INSERT INTO `tag` (
  `id`, `name`, `slug`, `type`, `parent_id`, `operator_id`, `created_at`, `updated_at`
) VALUES
  (1, 'Catégorie Générique',      'categorie-generique',      'category', NULL, 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (2, 'Catégorie Alternative',     'categorie-alternative',     'category', NULL, 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
  (3, 'Thème Générique',           'theme-generique',           'theme',    NULL, 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00');

-- À présent, on peut lancer les INSERT dans `car` sans violation de clé étrangère.
-- ---------------------------------------------------------------------
-- INSERTS dans `car`
-- ---------------------------------------------------------------------
INSERT INTO `car` (
  `id`, `operator_id`, `brand_id`, `category_tag_id`, `theme_tag_id`,
  `model`, `title`, `slug`, `description`, `content`, `year`, `seats`, `doors`,
  `transmission`, `fuel_type`, `horsepower`, `top_speed`, `acceleration`, `image`,
  `cylinders`, `deposit`, `stock`, `status`, `created_at`, `updated_at`,
  `wheel-transmission`, `carrosserie`, `price`
) VALUES
( 1, 1,  4, 1, 1, '488 GTB',            'Ferrari 488 GTB',          'ferrari-488-gtb',
 'Voiture de sport italienne emblématique aux performances explosives.',
 'Avec son moteur V8 bi-turbo de 670 ch, la Ferrari 488 GTB est conçue pour offrir sensations fortes et prestige.',
 2020,  2,  2, 'automatic', 'gasoline', 670, 330, 3.0, 'ferrari-488-gtb.webp',  12, 5000.00, 1, 'published', '2025-05-12 17:09:59', '2025-05-21 18:59:16', 0, '', 0 ),
( 2, 1,  2, 1, 1, 'Huracán Evo',         'Lamborghini Huracán Evo',  'lamborghini-huracan-evo',
 'Un coupé sportif à la fois brutal et raffiné.',
 'Dotée d’un V10 atmosphérique, la Huracán Evo incarne la puissance pure et l’élégance italienne.',
 2021,  2,  2, 'automatic', 'gasoline', 640, 325, 2.9, 'lamborghini_huracan_evo.jpg', 1099, 6000.00, 1, 'published', '2025-05-12 17:09:59', '2025-05-21 18:59:48', 0, '', 0 ),
( 3, 1,  6, 1, 2, '911 Turbo S',         'Porsche 911 Turbo S',      'porsche-911-turbo-s',
 'Le mélange parfait entre sportivité, élégance et confort.',
 'La Porsche 911 Turbo S est une icône des voitures sportives avec ses performances impressionnantes et sa finition irréprochable.',
 2022,  4,  2, 'automatic', 'gasoline', 650, 330, 2.7, '911-turbo-s.webp',         899, 4000.00, 2, 'published', '2025-05-12 17:09:59', '2025-05-21 19:00:07', 0, '', 0 ),
( 4, 2,  7, 1, 3, 'Continental GT',      'Bentley Continental GT V8', 'bentley-continental-gt-v8',
 'Coupé de luxe à la fois puissant et confortable.',
 'La Bentley Continental GT incarne le summum du luxe britannique avec un moteur V8 dynamique.',
 2022,  4,  2, 'automatic', 'gasoline', 550, 318, 3.9, 'bentley-continental-gt.webp', 799, 3500.00, 1, 'published', '2025-05-12 17:09:59', '2025-05-21 19:01:06', 0, '', 0 ),
( 5, 2,  1, 1, 3, 'S-Class Coupé',        'Mercedes-Benz S 63 AMG Coupé', 'mercedes-s63-amg-coupe',
 'L’alliance ultime du luxe et des performances signée AMG.',
 'Ce coupé Mercedes impressionne par sa prestance, son moteur V8 Biturbo et son confort intérieur exceptionnel.',
 2020,  4,  2, 'automatic', 'gasoline', 612, 300, 3.5, 'mercedes-amg-s63-coupe.webp', 749, 3000.00, 2, 'published', '2025-05-12 17:09:59', '2025-05-21 19:01:30', 0, '', 0 ),
( 6, 1,  2, 1, 3, 'M8 Competition',       'BMW M8 Competition Coupé',  'bmw-m8-competition',
 'La version la plus puissante de BMW avec luxe et performance.',
 'Avec 625 chevaux sous le capot, la M8 Competition offre une expérience digne des supercars.',
 2021,  4,  2, 'automatic', 'gasoline', 625, 305, 3.2, 'bmw-m8-competition.webp', 649, 3000.00, 2, 'published', '2025-05-12 17:34:51', '2025-05-21 19:01:42', 0, '', 0 ),
( 7, 2,  3, 1, 1, 'R8 V10 Plus',         'Audi R8 V10 Plus',         'audi-r8-v10',
 'La supercar d’Audi avec moteur V10 central.',
 'L’Audi R8 V10 Plus allie élégance, technologie quattro et puissance déchaînée.',
 2020,  2,  2, 'automatic', 'gasoline', 610, 330, 3.1, 'r8-v10.jpg',               899, 4000.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-22 17:17:27', 0, '', 0 ),
( 8, 1,  8, 1, 1, 'DB11',                'Aston Martin DB11 V8',     'aston-martin-db-11',
 'La classe britannique par excellence.',
 'Mélange de puissance et de raffinement, la DB11 est idéale pour les escapades de prestige.',
 2021,  2,  2, 'automatic', 'gasoline', 503, 300, 4.0, 'db-11.jpg',               749, 3500.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-22 17:19:06', 0, '', 0 ),
( 9, 2,  9, 1, 3, 'Ghibli Trofeo',       'Maserati Ghibli Trofeo',    'maserati-ghibli-trofeo',
 'Berline de luxe italienne avec un moteur Ferrari.',
 'Le luxe et la sportivité réunis dans cette version Trofeo très haut de gamme.',
 2022,  5,  4, 'automatic', 'gasoline', 580, 326, 4.3, 'maserati_ghibli_trofeo.jpg', 699, 3500.00, 2, 'published', '2025-05-12 17:34:51', '2025-05-21 19:02:22', 0, '', 0 ),
(10, 1, 10, 1, 2, 'Wraith',              'Rolls-Royce Wraith',       'rolls-royce-wraith',
 'Le grand luxe dans un coupé majestueux.',
 'La Wraith représente le summum de l’élégance, avec un moteur V12 et un intérieur somptueux.',
 2020,  4,  2, 'automatic', 'gasoline', 624, 250, 4.4, 'rr-wraith.jpg',           1299, 8000.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-21 19:02:34', 0, '', 0 ),
(11, 2, 11, 1, 3, '720S',                'McLaren 720S',            'mclaren-720s',
 'Supercar anglaise au look futuriste.',
 'Avec son châssis en carbone et son moteur V8 biturbo, la 720S offre des performances de piste.',
 2022,  2,  2, 'automatic', 'gasoline', 720, 341, 2.8, '720S.webp',             1149, 7000.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-21 19:02:48', 0, '', 0 ),
(12, 1,  6, 1, 2, 'Panamera Turbo S',     'Porsche Panamera Turbo S',  'panamera-turbo-s',
 'Berline de luxe avec performances de supercar.',
 'La Panamera Turbo S combine confort de grande routière et motorisation ultra-sportive.',
 2021,  4,  4, 'automatic', 'hybrid', 700, 315, 3.1, 'panamera-turbo-s.jpg', 799, 4000.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-22 17:19:33', 0, '', 0 ),
(13, 2,  2, 1, 3, 'i8 Roadster',          'BMW i8 Roadster Hybride',   'bmw-i8-roadster',
 'Design futuriste et technologie hybride.',
 'Le BMW i8 Roadster allie performances et conduite électrique dans un écrin de luxe.',
 2020,  2,  2, 'automatic', 'hybrid', 374, 250, 4.6, 'i8-roadster.jpg',         599, 2500.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-21 19:03:12', 0, '', 0 ),
(14, 2, 12, 1, 2, 'LC 500',               'Lexus LC 500 Sport+',      'lexus-lc-500',
 'Coupé japonais au look audacieux et moteur V8.',
 'La Lexus LC 500 combine style, confort haut de gamme et performances routières solides.',
 2021,  4,  2, 'automatic', 'gasoline', 471, 270, 4.4, 'lc-500.jpg',            649, 3000.00, 1, 'published', '2025-05-12 17:34:51', '2025-05-21 19:03:22', 0, '', 0 ),
(15, 1, 13, 1, 1, 'Model S Plaid',        'Tesla Model S Plaid',      'model-s-plaid',
 'La berline électrique la plus rapide du marché.',
 'La Tesla Model S Plaid combine accélération fulgurante et technologie de pointe 100% électrique.',
 2023,  5,  4, 'automatic', 'electric', 1020, 322, 2.1, 'tesla-model-s-plaid.jpg', 849, 4000.00, 2, 'published', '2025-05-12 17:34:51', '2025-05-22 17:27:30', 0, '', 0 ),
(16, 1,  2, 2, 3, 'M2 Competition',       'BMW M2 Competition',        'bmw-m2-competition',
 'Coupé compact et musclé, symbole du plaisir de conduite BMW.',
 'Avec son moteur 6 cylindres biturbo, la M2 offre un excellent rapport puissance/agilité.',
 2020,  4,  2, 'manual',    'gasoline', 410, 280, 4.2, 'm2-competition.avif',   449, 2000.00, 2, 'published', '2025-05-12 17:44:52', '2025-05-21 19:07:51', 0, '', 0 ),
(17, 1,  2, 2, 3, 'M140i',               'BMW M140i xDrive',          'bmw-m140i',
 'Une compacte puissante et discrète.',
 'Dotée d’un 6 cylindres en ligne, la M140i allie performance et polyvalence.',
 2020,  5,  5, 'automatic', 'gasoline', 340, 250, 4.6, 'm140i.webp',            399, 1800.00, 2, 'published', '2025-05-12 17:44:52', '2025-05-21 19:29:35', 0, '', 0 ),
(18, 1,  3, 2, 1, 'RS3 Sportback',       'Audi RS3 Sportback',        'audi-rs3',
 'La compacte explosive d’Audi avec moteur 5 cylindres.',
 'La RS3 est redoutable en ligne droite comme sur routes sinueuses.',
 2022,  5,  5, 'automatic', 'gasoline', 400, 290, 3.8, 'audi-rs3.webp',          449, 2000.00, 2, 'published', '2025-05-12 17:44:52', '2025-05-22 17:20:10', 0, '', 0 ),
(19, 2,  3, 2, 3, 'S3 Berline',          'Audi S3 Berline',           'audi-s3',
 'La petite sœur de la RS3, efficace et plus accessible.',
 'Une voiture agile et classe avec transmission quattro.',
 2021,  5,  4, 'automatic', 'gasoline', 310, 250, 4.8, 'audi-s3.jpg',            349, 1500.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:20:20', 0, '', 0 ),
(20, 2,  1, 2, 3, 'A45 S AMG',           'Mercedes-AMG A45 S 4MATIC+', 'mercedes-a45-s',
 'La compacte la plus puissante du marché.',
 'Avec 421 chevaux et une transmission 4MATIC+, l’A45 S est une véritable bombe.',
 2022,  5,  5, 'automatic', 'gasoline', 421, 270, 3.9, 'a45-s.jpg',              499, 2500.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:20:32', 0, '', 0 ),
(21, 1,  1, 2, 3, 'CLA 45 AMG',          'Mercedes-AMG CLA 45 S',      'mercedes-cla45-s',
 'Berline compacte au look racé.',
 'La CLA 45 S allie design agressif et puissance impressionnante pour une compacte.',
 2021,  5,  4, 'automatic', 'gasoline', 421, 270, 4.0, 'cla-45.jpg',             489, 2300.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:20:41', 0, '', 0 ),
(22, 2, 14, 2, 3, 'Golf 8 R',            'Volkswagen Golf 8 R',       'volkswagen-golf-8r',
 'La Golf la plus performante jamais produite.',
 'Avec 320 chevaux, 4 roues motrices et un châssis affûté, la Golf R reste une référence.',
 2022,  5,  5, 'automatic', 'gasoline', 320, 270, 4.7, 'volkswagen-golf-8r.jpg', 429, 1800.00, 2, 'published', '2025-05-12 17:44:52', '2025-05-22 17:20:55', 0, '', 0 ),
(23, 1, 14, 2, 3, 'Golf 7 GTI Clubsport', 'Volkswagen Golf GTI Clubsport', 'gti-clubsport',
 'Version la plus affûtée de la GTI.',
 'Un équilibre entre sportivité, confort et efficacité redoutable sur route.',
 2020,  5,  5, 'automatic', 'gasoline', 300, 250, 5.2, 'gti-clubsport.webp',      349, 1600.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:27:19', 0, '', 0 ),
(24, 2, 15, 2, 3, 'Leon Cupra R',         'Cupra Leon R ST',           'leon-r-st',
 'Compacte espagnole très sportive.',
 'Une voiture familiale au tempérament de feu avec un châssis affûté et 310 ch.',
 2021,  5,  5, 'automatic', 'gasoline', 310, 250, 4.9, 'seat-leon-r-st.jpg',       369, 1700.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:27:06', 0, '', 0 ),
(25, 1, 16, 2, 3, 'Megane RS Trophy',     'Renault Mégane RS Trophy',    'megane-rs-trophy',
 'La compacte française la plus radicale.',
 'Avec un châssis Cup, la Mégane RS Trophy est une vraie pistarde homologuée route.',
 2020,  5,  5, 'manual',    'gasoline', 300, 260, 5.7, 'megane-rs-trophy.jpg',     329, 1400.00, 1, 'published', '2025-05-12 17:44:52', '2025-05-22 17:26:55', 0, '', 0 );
