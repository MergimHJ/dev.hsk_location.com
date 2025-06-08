<?php

function catalog()
{
    require_once '../app/config/db.php';
    $pdo = db();

    // Récupération des voitures avec plus d'informations
    $stmt = $pdo->query("
        SELECT 
            c.*,
            CASE 
                WHEN c.stock > 2 THEN 'Disponible'
                WHEN c.stock > 0 THEN 'Stock limité' 
                ELSE 'Non disponible'
            END as availability_text,
            CASE 
                WHEN c.stock > 2 THEN 'available'
                WHEN c.stock > 0 THEN 'limited'
                ELSE 'unavailable'
            END as availability_class
        FROM car c 
        WHERE c.status = 'published' 
        ORDER BY c.created_at DESC
    ");
    $cars = $stmt->fetchAll();
    
    // Statistiques pour le catalogue
    $statsQuery = $pdo->query("
        SELECT 
            COUNT(*) as total_cars,
            COUNT(DISTINCT fuel_type) as fuel_types,
            MIN(price) as min_price,
            MAX(price) as max_price,
            AVG(price) as avg_price,
            COUNT(DISTINCT SUBSTRING(title, 1, LOCATE(' ', title) - 1)) as brands
        FROM car 
        WHERE status = 'published'
    ");
    $stats = $statsQuery->fetch();
    
    // Types de carburant disponibles pour le filtre
    $fuelQuery = $pdo->query("
        SELECT DISTINCT fuel_type 
        FROM car 
        WHERE status = 'published' AND fuel_type IS NOT NULL
        ORDER BY fuel_type
    ");
    $fuelTypes = $fuelQuery->fetchAll(PDO::FETCH_COLUMN);
    
    // Gammes de prix pour le filtre
    $priceRanges = [
        ['min' => 0, 'max' => 500, 'label' => 'Moins de 500€'],
        ['min' => 500, 'max' => 1000, 'label' => '500€ - 1000€'],
        ['min' => 1000, 'max' => 2000, 'label' => '1000€ - 2000€'],
        ['min' => 2000, 'max' => 999999, 'label' => 'Plus de 2000€']
    ];
    
    $data = [
        'cars' => $cars,
        'stats' => $stats,
        'fuelTypes' => $fuelTypes,
        'priceRanges' => $priceRanges
    ];
    
    render('catalog/catalog.php', $data);
}

function item($slug)
{
    require_once '../app/config/db.php';
    $pdo = db();
    
    $stmt = $pdo->prepare('SELECT * FROM car WHERE slug = :slug AND status = "published"');
    $stmt->execute(['slug' => $slug]);
    $car = $stmt->fetch();
    
    if (!$car) {
        header('Location: /catalog');
        exit;
    }
    
    // Véhicules similaires
    $similarQuery = $pdo->prepare("
        SELECT * FROM car 
        WHERE status = 'published' 
        AND id != :current_id 
        AND (fuel_type = :fuel_type OR price BETWEEN :price_min AND :price_max)
        ORDER BY RAND() 
        LIMIT 3
    ");
    $similarQuery->execute([
        'current_id' => $car['id'],
        'fuel_type' => $car['fuel_type'],
        'price_min' => $car['price'] - 200,
        'price_max' => $car['price'] + 200
    ]);
    $similarCars = $similarQuery->fetchAll();
    
    $data = [
        'car' => $car,
        'similarCars' => $similarCars
    ];
    
    render('catalog/item.php', $data);
}