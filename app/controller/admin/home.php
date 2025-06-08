
<?php

function home(){
    $cars = db()->query('SELECT * FROM car')->fetchAll();
    $stats = [
        'total_cars' => count($cars),
        'published' => count(array_filter($cars, fn($car) => $car['status'] === 'published')),
        'draft' => count(array_filter($cars, fn($car) => $car['status'] === 'draft')),
        'revenue' => '45.2k€'
    ];
    render('home.php', ['cars' => $cars, 'stats' => $stats], 'admin');
}