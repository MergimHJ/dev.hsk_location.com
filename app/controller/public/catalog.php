<?php

function catalog()
{
    require_once '../app/config/db.php';
    $pdo = db();

    // Configuration de la pagination
    $itemsPerPage = 12;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max(1, $page);
    $offset = ($page - 1) * $itemsPerPage;

    // Récupération des filtres depuis l'URL
    $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
    $fuelFilter = isset($_GET['fuel']) ? $_GET['fuel'] : '';
    $priceFilter = isset($_GET['price']) ? $_GET['price'] : '';
    $categoryFilter = isset($_GET['category']) ? (int)$_GET['category'] : 0;
    $themeFilter = isset($_GET['theme']) ? (int)$_GET['theme'] : 0;
    $sortFilter = isset($_GET['sort']) ? $_GET['sort'] : 'default';

    // Construction de la requête avec filtres
    $whereConditions = ["c.status = 'published'"];
    $params = [];

    // Filtre de recherche par nom
    if (!empty($searchTerm)) {
        $whereConditions[] = "c.title LIKE :search";
        $params['search'] = '%' . $searchTerm . '%';
    }

    // Filtre carburant
    if (!empty($fuelFilter)) {
        $whereConditions[] = "c.fuel_type = :fuel";
        $params['fuel'] = $fuelFilter;
    }

    // Filtre prix
    if (!empty($priceFilter)) {
        $priceRange = explode('-', $priceFilter);
        if (count($priceRange) === 2) {
            $minPrice = (int)$priceRange[0];
            $maxPrice = (int)$priceRange[1];
            if ($maxPrice >= 999999) {
                $whereConditions[] = "c.price >= :min_price";
                $params['min_price'] = $minPrice;
            } else {
                $whereConditions[] = "c.price BETWEEN :min_price AND :max_price";
                $params['min_price'] = $minPrice;
                $params['max_price'] = $maxPrice;
            }
        }
    }

    // Filtre catégorie
    if ($categoryFilter > 0) {
        $whereConditions[] = "c.category_tag_id = :category";
        $params['category'] = $categoryFilter;
    }

    // Filtre thème
    if ($themeFilter > 0) {
        $whereConditions[] = "c.theme_tag_id = :theme";
        $params['theme'] = $themeFilter;
    }

    // Construction de la clause WHERE
    $whereClause = implode(' AND ', $whereConditions);

    // Clause ORDER BY selon le tri
    $orderBy = "c.created_at DESC"; // Par défaut
    switch ($sortFilter) {
        case 'price-asc':
            $orderBy = "c.price ASC";
            break;
        case 'price-desc':
            $orderBy = "c.price DESC";
            break;
        case 'name-asc':
            $orderBy = "c.title ASC";
            break;
        case 'year-desc':
            $orderBy = "c.year DESC";
            break;
    }

    // Compter le nombre total de voitures FILTRÉES
    $countQuery = "SELECT COUNT(*) as total FROM car c 
                   LEFT JOIN tag cat ON c.category_tag_id = cat.id AND cat.type = 'category'
                   LEFT JOIN tag theme ON c.theme_tag_id = theme.id AND theme.type = 'theme'
                   WHERE $whereClause";
    
    $countStmt = $pdo->prepare($countQuery);
    $countStmt->execute($params);
    $totalCars = $countStmt->fetch()['total'];
    $totalPages = ceil($totalCars / $itemsPerPage);

    // Récupération des voitures avec pagination ET filtres
    $mainQuery = "
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
        WHERE $whereClause
        ORDER BY $orderBy
        LIMIT :limit OFFSET :offset
    ";
    
    $stmt = $pdo->prepare($mainQuery);
    
    // Ajouter les paramètres de pagination
    $params['limit'] = $itemsPerPage;
    $params['offset'] = $offset;
    
    // Bind des paramètres
    foreach ($params as $key => $value) {
        if ($key === 'limit' || $key === 'offset') {
            $stmt->bindValue(':' . $key, $value, PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':' . $key, $value);
        }
    }
    
    $stmt->execute();
    $cars = $stmt->fetchAll();
    
    // Ajouter le statut "nouveau" en PHP
    $newCarIds = [25, 26, 27];
    foreach ($cars as &$car) {
        $car['is_actually_new'] = in_array($car['id'], $newCarIds) ? 1 : 0;
    }
    
    // Statistiques pour le catalogue (basées sur toutes les voitures publiées, pas les filtres)
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
        'start_item' => $totalCars > 0 ? $offset + 1 : 0,
        'end_item' => min($offset + $itemsPerPage, $totalCars),
        'has_previous' => $page > 1,
        'has_next' => $page < $totalPages,
        'previous_page' => max(1, $page - 1),
        'next_page' => min($totalPages, $page + 1)
    ];
    
    // Préparer les filtres actuels pour les passer à la vue
    $currentFilters = [
        'search' => $searchTerm,
        'fuel' => $fuelFilter,
        'price' => $priceFilter,
        'category' => $categoryFilter,
        'theme' => $themeFilter,
        'sort' => $sortFilter
    ];
    
    $data = [
        'cars' => $cars,
        'stats' => $stats,
        'fuelTypes' => $fuelTypes,
        'categories' => $categories,
        'themes' => $themes,
        'priceRanges' => $priceRanges,
        'pagination' => $pagination,
        'currentFilters' => $currentFilters
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