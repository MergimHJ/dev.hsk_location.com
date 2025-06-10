<?php
function home()
{
    require_once '../app/config/db.php';
    $pdo = db();

    // Récupère les 6 véhicules les plus spectaculaires (premium)
    $stmt = $pdo->query("
        SELECT 
            c.*,
            cat.name as category_name,
            theme.name as theme_name,
            b.name as brand_name,
            CASE 
                WHEN c.stock > 2 THEN 'Disponible'
                WHEN c.stock > 0 THEN 'Stock limité' 
                ELSE 'Non disponible'
            END as availability_text,
            CASE 
                WHEN c.stock > 2 THEN 'available'
                WHEN c.stock > 0 THEN 'limited'
                ELSE 'unavailable'
            END as availability_class,
            -- Score de prestige basé sur prix, puissance et marque
            (c.price * 0.3 + c.horsepower * 0.5 + 
             CASE 
                WHEN b.name IN ('Ferrari', 'Lamborghini', 'McLaren', 'Bugatti') THEN 1000
                WHEN b.name IN ('Porsche', 'Aston Martin', 'Bentley') THEN 800
                WHEN b.name IN ('Mercedes-Benz', 'BMW', 'Audi') THEN 600
                ELSE 400
             END) as prestige_score
        FROM car c 
        LEFT JOIN tag cat ON c.category_tag_id = cat.id AND cat.type = 'category'
        LEFT JOIN tag theme ON c.theme_tag_id = theme.id AND theme.type = 'theme'
        LEFT JOIN brand b ON c.brand_id = b.id
        WHERE c.status = 'published' 
        ORDER BY prestige_score DESC, c.created_at DESC 
        LIMIT 6
    ");
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Statistiques impressionnantes pour le hero
    $statsQuery = $pdo->query("
        SELECT 
            COUNT(*) as total_cars,
            COUNT(CASE WHEN status = 'published' THEN 1 END) as published_cars,
            AVG(price) as avg_price,
            MAX(price) as max_price,
            MIN(price) as min_price,
            COUNT(DISTINCT fuel_type) as fuel_types,
            COUNT(DISTINCT b.name) as total_brands,
            AVG(horsepower) as avg_horsepower,
            MAX(horsepower) as max_horsepower,
            -- Statistiques premium
            COUNT(CASE WHEN price > 1000 THEN 1 END) as premium_cars,
            COUNT(CASE WHEN horsepower > 500 THEN 1 END) as supercars,
            COUNT(CASE WHEN b.name IN ('Ferrari', 'Lamborghini', 'McLaren', 'Bugatti', 'Koenigsegg') THEN 1 END) as hypercars
        FROM car c
        LEFT JOIN brand b ON c.brand_id = b.id
        WHERE c.status = 'published'
    ");
    $stats = $statsQuery->fetch(PDO::FETCH_ASSOC);
    
    // Top marques pour la section marques
    $brandsQuery = $pdo->query("
        SELECT 
            b.name,
            COUNT(c.id) as car_count,
            AVG(c.price) as avg_price,
            MAX(c.horsepower) as max_power
        FROM brand b
        LEFT JOIN car c ON b.id = c.brand_id AND c.status = 'published'
        WHERE b.name IN ('Ferrari', 'Lamborghini', 'Porsche', 'McLaren', 'Bentley', 'Aston Martin', 'Mercedes-Benz', 'BMW', 'Audi')
        GROUP BY b.id, b.name
        ORDER BY avg_price DESC, max_power DESC
        LIMIT 8
    ");
    $brands = $brandsQuery->fetchAll(PDO::FETCH_ASSOC);
    
    // Témoignages récents (si vous avez une table reviews)
    $testimonialsQuery = $pdo->query("
        SELECT 
            'Alexandre M.' as customer_name,
            'Une expérience absolument magique ! Service impeccable et Ferrari de rêve.' as comment,
            5 as rating,
            'Ferrari 488 GTB' as car_used
        UNION ALL
        SELECT 
            'Sophie L.' as customer_name,
            'Parfait pour mon mariage ! La Lamborghini a fait sensation.' as comment,
            5 as rating,
            'Lamborghini Huracán'
        UNION ALL
        SELECT 
            'Thomas R.' as customer_name,
            'Professionnalisme et passion. McLaren exceptionnelle !' as comment,
            5 as rating,
            'McLaren 720S'
        LIMIT 3
    ");
    $testimonials = $testimonialsQuery->fetchAll(PDO::FETCH_ASSOC);
    
    // Événements spéciaux ou promotions (optionnel)
    $specialOffersQuery = $pdo->query("
        SELECT 
            'Weekend Ferrari' as offer_title,
            'Location 3 jours = 2 jours payés sur toute la gamme Ferrari' as offer_description,
            '15%' as discount,
            DATE_ADD(NOW(), INTERVAL 30 DAY) as expiry_date
        UNION ALL
        SELECT 
            'Mariage de Luxe' as offer_title,
            'Package complet mariage avec décoration et chauffeur inclus' as offer_description,
            '20%' as discount,
            DATE_ADD(NOW(), INTERVAL 60 DAY) as expiry_date
        LIMIT 2
    ");
    $specialOffers = $specialOffersQuery->fetchAll(PDO::FETCH_ASSOC);
    
    // Enrichir les données des voitures avec des infos marketing
    foreach ($cars as &$car) {
        // Ajouter des tags marketing
        $car['marketing_tags'] = [];
        
        if ($car['horsepower'] > 600) {
            $car['marketing_tags'][] = 'BEAST MODE';
        }
        if ($car['price'] > 1500) {
            $car['marketing_tags'][] = 'ULTRA PREMIUM';
        }
        if (in_array($car['brand_name'], ['Ferrari', 'Lamborghini', 'McLaren'])) {
            $car['marketing_tags'][] = 'SUPERCAR';
        }
        if ($car['year'] >= 2022) {
            $car['marketing_tags'][] = 'LATEST MODEL';
        }
        
        // Score d'émotion (pour l'ordre d'affichage)
        $car['emotion_score'] = 
            ($car['horsepower'] * 0.4) + 
            ($car['price'] * 0.3) + 
            ($car['year'] * 0.3);
            
        // Message d'accroche personnalisé
        if ($car['brand_name'] === 'Ferrari') {
            $car['tagline'] = "La légende italienne vous attend";
        } elseif ($car['brand_name'] === 'Lamborghini') {
            $car['tagline'] = "Rugissement de taureau, élégance absolue";
        } elseif ($car['brand_name'] === 'McLaren') {
            $car['tagline'] = "Technologie F1 pour la route";
        } elseif ($car['brand_name'] === 'Porsche') {
            $car['tagline'] = "Perfection allemande, passion pure";
        } else {
            $car['tagline'] = "Excellence et performance réunies";
        }
    }
    
    $data = [
        'cars' => $cars,
        'stats' => $stats,
        'brands' => $brands,
        'testimonials' => $testimonials,
        'special_offers' => $specialOffers,
        'page_title' => 'HSK Locations - Supercars de Luxe à Paris',
        'meta_description' => 'Louez les plus belles supercars : Ferrari, Lamborghini, McLaren. Service premium, livraison gratuite. Vivez l\'exception avec HSK Locations.',
        'hero_stats' => [
            'total_cars' => $stats['total_cars'],
            'premium_cars' => $stats['premium_cars'],
            'brands_count' => $stats['total_brands'],
            'max_power' => $stats['max_horsepower']
        ]
    ];
    
    render('home/home.php', $data);
}