<?php
function home()
{
    require_once '../app/config/db.php';
    $pdo = db();

    // Récupère les 6 dernières voitures publiées
    $stmt = $pdo->query("SELECT * FROM car WHERE status = 'published' ORDER BY created_at DESC LIMIT 6");
    $data['cars'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    render('home/home.php', $data);
}