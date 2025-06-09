<?php

function catalog()
{
    $cars = db()->query('SELECT * FROM car')->fetchAll();
    $categories = db()->query('SELECT * FROM tag WHERE type = "category"')->fetchAll();
    $themes = db()->query('SELECT * FROM tag WHERE type = "theme"')->fetchAll();

    render('catalog/catalog.php', ['cars' => $cars, 'categories' => $categories, 'themes' => $themes], 'admin');
}

function add()
{
    $operators = db()->query('SELECT id, username FROM operator')->fetchAll();
    $brands = db()->query('SELECT id, name FROM brand')->fetchAll();
    $categories = db()->query('SELECT * FROM tag WHERE type = "category"')->fetchAll();
    $themes = db()->query('SELECT * FROM tag WHERE type = "theme"')->fetchAll();
    render('catalog/form.php', ['categories' => $categories, 'brands' => $brands, 'themes' => $themes, 'operators' => $operators],  'admin');
}

function edit($id)
{
    $car = db()->prepare('SELECT * FROM car WHERE id = :id');
    $car->execute(['id' => $id]);
    $car = $car->fetch();

    $operators = db()->query('SELECT id, username FROM operator')->fetchAll();
    $brands = db()->query('SELECT id, name FROM brand')->fetchAll();

    if (!$car) {
        header('Location: /admin/catalog');
        exit;
    }

    $categories = db()->query('SELECT * FROM tag WHERE type = "category"')->fetchAll();
    $themes = db()->query('SELECT * FROM tag WHERE type = "theme"')->fetchAll();

    render('catalog/form.php', ['car' => $car, 'categories' => $categories, 'brands' => $brands, 'themes' => $themes, 'operators' => $operators],  'admin');
}

function save()
{
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        update();
    } else {
        create();
    }
}

function update()
{
    $pdo = db(); // Corrigé: utilise la fonction db()

    try {
        $stmt = $pdo->prepare("
        UPDATE car SET
            operator_id = :operator_id,
            brand_id = :brand_id,
            category_tag_id = :category_tag_id,
            theme_tag_id = :theme_tag_id,
            model = :model,
            title = :title,
            slug = :slug,
            description = :description,
            content = :content,
            year = :year,
            seats = :seats,
            doors = :doors,
            transmission = :transmission,
            fuel_type = :fuel_type,
            horsepower = :horsepower,
            top_speed = :top_speed,
            acceleration = :acceleration,
            cylinders = :cylinders,
            deposit = :deposit,
            stock = :stock,
            status = :status,
            `wheel-transmission` = :wheel_transmission,
            carrosserie = :carrosserie,
            price = :price
        WHERE id = :id
    ");

        $stmt->execute([
            ':id' => $_POST['id'],
            ':operator_id' => $_POST['operator_id'],
            ':brand_id' => $_POST['brand_id'],
            ':category_tag_id' => $_POST['category_tag_id'],
            ':theme_tag_id' => $_POST['theme_tag_id'],
            ':model' => $_POST['model'],
            ':title' => $_POST['title'],
            ':slug' => $_POST['slug'],
            ':description' => $_POST['description'],
            ':content' => $_POST['content'],
            ':year' => $_POST['year'],
            ':seats' => $_POST['seats'],
            ':doors' => $_POST['doors'],
            ':transmission' => $_POST['transmission'],
            ':fuel_type' => $_POST['fuel_type'],
            ':horsepower' => $_POST['horsepower'],
            ':top_speed' => $_POST['top_speed'],
            ':acceleration' => $_POST['acceleration'],
            ':cylinders' => $_POST['cylinders'],
            ':deposit' => $_POST['deposit'],
            ':stock' => $_POST['stock'],
            ':status' => $_POST['status'],
            ':wheel_transmission' => $_POST['wheel-transmission'],
            ':carrosserie' => $_POST['carrosserie'],
            ':price' => $_POST['price']
        ]);

        header('Location: /admin/catalog?success=updated');
        exit;
    } catch (PDOException $e) {
        header('Location: /admin/catalog?error=' . urlencode($e->getMessage()));
        exit;
    }
}

function create()
{
    $pdo = db(); // Corrigé: utilise la fonction db()

    $car = [
        'operator_id' => $_POST['operator_id'] ?? 1,
        'brand_id' => $_POST['brand_id'] ?? 1,
        'category_tag_id' => $_POST['category_tag_id'] ?? 1,
        'theme_tag_id' => $_POST['theme_tag_id'] ?? 1,
        'model' => $_POST['model'] ?? '',
        'title' => $_POST['title'] ?? '',
        'slug' => $_POST['slug'] ?? '',
        'description' => $_POST['description'] ?? null,
        'content' => $_POST['content'] ?? null,
        'year' => $_POST['year'] ?? 2023,
        'seats' => $_POST['seats'] ?? 2,
        'doors' => $_POST['doors'] ?? 2,
        'transmission' => $_POST['transmission'] ?? 'automatic',
        'fuel_type' => $_POST['fuel_type'] ?? 'gasoline',
        'horsepower' => $_POST['horsepower'] ?? null,
        'top_speed' => $_POST['top_speed'] ?? null,
        'acceleration' => $_POST['acceleration'] ?? null,
        'cylinders' => $_POST['cylinders'] ?? 8,
        'deposit' => $_POST['deposit'] ?? 1000.00,
        'stock' => $_POST['stock'] ?? 1,
        'status' => $_POST['status'] ?? 'draft',
        'wheel_transmission' => $_POST['wheel-transmission'] ?? 1,
        'carrosserie' => $_POST['carrosserie'] ?? 'Coupé',
        'price' => $_POST['price'] ?? 1000
    ];

    try {
        $stmt = $pdo->prepare("
        INSERT INTO car (
            operator_id, brand_id, category_tag_id, theme_tag_id,
            model, title, slug, description, content,
            year, seats, doors, transmission, fuel_type,
            horsepower, top_speed, acceleration,
            cylinders, deposit, stock, status,
            `wheel-transmission`, carrosserie, price
        )
        VALUES (
            :operator_id, :brand_id, :category_tag_id, :theme_tag_id,
            :model, :title, :slug, :description, :content,
            :year, :seats, :doors, :transmission, :fuel_type,
            :horsepower, :top_speed, :acceleration,
            :cylinders, :deposit, :stock, :status,
            :wheel_transmission, :carrosserie, :price
        )
    ");

        $stmt->execute($car);
        
        header('Location: /admin/catalog?success=created');
        exit;
    } catch (PDOException $e) {
        header('Location: /admin/catalog?error=' . urlencode($e->getMessage()));
        exit;
    }
}

function category()
{
    render('catalog/category.php', [], 'admin');
}

function addcategory()
{
    $tag = [
        'name' => $_POST['name'],
        'slug' => $_POST['slug'],
        'type' => $_POST['type'] ?? 'category'
    ];

    try {
        db()->prepare('INSERT INTO tag (name, slug, type, parent_id, operator_id) 
                VALUES (:name, :slug, :type, NULL, NULL)')
            ->execute($tag);
        
        header('Location: /admin/catalog/category?success=created');
        exit;
    } catch (PDOException $e) {
        header('Location: /admin/catalog/category?error=' . urlencode($e->getMessage()));
        exit;
    }
}

function delete()
{
    if (isset($_POST['id'])) {
        try {
            $stmt = db()->prepare('DELETE FROM car WHERE id = :id');
            $stmt->execute([':id' => $_POST['id']]);
            
            header('Location: /admin/catalog?success=deleted');
            exit;
        } catch (PDOException $e) {
            header('Location: /admin/catalog?error=' . urlencode($e->getMessage()));
            exit;
        }
    }
}