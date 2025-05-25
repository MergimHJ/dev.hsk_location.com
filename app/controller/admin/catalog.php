<?php
function add(){
    render('catalog/add.php', [], 'admin');
}

function save(){
    $car = [
        'operator_id' => $_POST['operator_id'],
        'brand_id' => $_POST['brand_id'],
        'model' => $_POST['model'],
        'title' => $_POST['title'],
        'slug' => $_POST['slug'],
        'description' => $_POST['description'],
        'content' => $_POST['content'],
        'year' => $_POST['year'],
        'seats' => $_POST['seats'],
        'doors' => $_POST['doors'],
        'transmission' => $_POST['transmission'],
        'fuel_type' => $_POST['fuel_type'],
        'horsepower' => $_POST['horsepower'],
        'top_speed' => $_POST['top_speed'],
        'acceleration' => $_POST['acceleration'],
        'category_tag_id' =>1,
        'theme_tag_id' =>1

    ];
    db()->prepare('INSERT INTO car (operator_id, brand_id, model, title, slug, description, content, year, seats, doors, transmission, fuel_type, horsepower, top_speed, acceleration, category_tag_id, theme_tag_id) 
            VALUES (:operator_id, :brand_id, :model, :title, :slug, :description, :content, :year, :seats, :doors, :transmission, :fuel_type, :horsepower, :top_speed, :acceleration, :category_tag_id, :theme_tag_id)')
        ->execute($car);
    // Redirect to the catalog page
    header('Location: /admin/catalog/add');
}

function category(){
    render('catalog/theme.php', [], 'admin');
}