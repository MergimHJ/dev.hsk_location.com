<?php

function catalog()
{
    require_once '../app/config/db.php';
    $pdo = db();

    // Configuration de la pagination
    $itemsPerPage = 12;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max(1, $page); // S'assurer que la page est au minimum 1
    $offset = ($page - 1) * $itemsPerPage;

    // Compter le nombre total de voitures
    $countQuery = $pdo->query("
        SELECT COUNT(*) as total
        FROM car c 
        WHERE c.status = 'published'
    ");
    $totalCars = $countQuery->fetch()['total'];
    $totalPages = ceil($totalCars / $itemsPerPage);

    // Récupération des voitures avec pagination
    $stmt = $pdo->prepare("
        SELECT 
            c.*,
            cat.name as category_name,
            theme.name as theme_name,
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
        LEFT JOIN tag cat ON c.category_tag_id = cat.id AND cat.type = 'category'
        LEFT JOIN tag theme ON c.theme_tag_id = theme.id AND theme.type = 'theme'
        WHERE c.status = 'published' 
        ORDER BY c.created_at DESC
        LIMIT :limit OFFSET :offset
    ");
    
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $cars = $stmt->fetchAll();
    
    
    // Ajouter le statut "nouveau" en PHP
    $newCarIds = [25, 26, 27]; // IDs des voitures à marquer comme nouvelles
    foreach ($cars as &$car) {
        $car['is_actually_new'] = in_array($car['id'], $newCarIds) ? 1 : 0;
    }
    
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
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
    
    // Récupération des catégories pour le filtre
    $categoriesQuery = $pdo->query("
        SELECT id, name 
        FROM tag 
        WHERE type = 'category' 
        ORDER BY name
    ");
    $categories = $categoriesQuery->fetchAll();
    
    // Récupération des thèmes pour le filtre
    $themesQuery = $pdo->query("
        SELECT id, name 
        FROM tag 
        WHERE type = 'theme' 
        ORDER BY name
    ");
    $themes = $themesQuery->fetchAll();
    
    // Gammes de prix pour le filtre
    $priceRanges = [
        ['min' => 0, 'max' => 500, 'label' => 'Moins de 500€'],
        ['min' => 500, 'max' => 1000, 'label' => '500€ - 1000€'],
        ['min' => 1000, 'max' => 2000, 'label' => '1000€ - 2000€'],
        ['min' => 2000, 'max' => 999999, 'label' => 'Plus de 2000€']
    ];
    
    // Calculer les informations de pagination
    $pagination = [
        'current_page' => $page,
        'total_pages' => $totalPages,
        'total_items' => $totalCars,
        'items_per_page' => $itemsPerPage,
        'start_item' => $offset + 1,
        'end_item' => min($offset + $itemsPerPage, $totalCars),
        'has_previous' => $page > 1,
        'has_next' => $page < $totalPages,
        'previous_page' => max(1, $page - 1),
        'next_page' => min($totalPages, $page + 1)
    ];
    
    $data = [
        'cars' => $cars,
        'stats' => $stats,
        'fuelTypes' => $fuelTypes,
        'categories' => $categories,
        'themes' => $themes,
        'priceRanges' => $priceRanges,
        'pagination' => $pagination
    ];
    
    render('catalog/catalog.php', $data);
}

function item($slug)
{
    require_once '../app/config/db.php';
    $pdo = db();
    
    // Récupérer la voiture avec les informations des tags
    $stmt = $pdo->prepare('
        SELECT c.*, 
               cat.name as category_name,
               theme.name as theme_name,
               b.name as brand_name
        FROM car c 
        LEFT JOIN tag cat ON c.category_tag_id = cat.id AND cat.type = "category"
        LEFT JOIN tag theme ON c.theme_tag_id = theme.id AND theme.type = "theme"
        LEFT JOIN brand b ON c.brand_id = b.id
        WHERE c.slug = :slug AND c.status = "published"
    ');
    $stmt->execute(['slug' => $slug]);
    $car = $stmt->fetch();
    
    if (!$car) {
        header('Location: /catalog');
        exit;
    }
    
    // Véhicules similaires
    $similarQuery = $pdo->prepare("
        SELECT c.*, 
               cat.name as category_name,
               theme.name as theme_name
        FROM car c
        LEFT JOIN tag cat ON c.category_tag_id = cat.id AND cat.type = 'category'
        LEFT JOIN tag theme ON c.theme_tag_id = theme.id AND theme.type = 'theme'
        WHERE c.status = 'published' 
        AND c.id != :current_id 
        AND (c.fuel_type = :fuel_type OR c.price BETWEEN :price_min AND :price_max)
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