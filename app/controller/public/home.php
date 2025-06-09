<?php
function home()
{
    require_once '../app/config/db.php';
    $pdo = db();

    // Récupère les 6 dernières voitures publiées avec plus d'infos
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
        LIMIT 6
    ");
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Statistiques pour affichage
    $statsQuery = $pdo->query("
        SELECT 
            COUNT(*) as total_cars,
            COUNT(CASE WHEN status = 'published' THEN 1 END) as published_cars,
            AVG(price) as avg_price,
            COUNT(DISTINCT fuel_type) as fuel_types
        FROM car
    ");
    $stats = $statsQuery->fetch(PDO::FETCH_ASSOC);
    
    $data = [
        'cars' => $cars,
        'stats' => $stats
    ];
    
    render('home/home.php', $data);
}

