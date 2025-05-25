<?php
   

function catalog()
{
    
         require_once '../app/config/db.php';
        $pdo = db();

        $stmt = $pdo->query('SELECT * FROM car');
        $cars = $stmt->fetchAll();
        
        
        
        $data['car'] = $cars;
        render('catalog/catalog.php', $data);
        


}

function item($slug)
{
        
         require_once '../app/config/db.php';
        $pdo = db();
        $stmt = $pdo->prepare('SELECT * FROM car WHERE slug = :slug');
        $stmt->execute(['slug' => $slug]);
        $data['car'] = $stmt->fetch();
        render('catalog/item.php', $data);
}

