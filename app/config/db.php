<?php
function db() {
    static $pdo = null;
    if ($pdo === null) {
        $host = 'localhost';
        $db   = 'hsk_location';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
    }
    return $pdo;
}

// $host = 'localhost';
// $db   = 'dev.hsk_location.com';
// $user = 'dev.hsk_location.com';
// $pass = 'sandbox';
// $charset = 'utf8mb4';

// $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
// $options = [
//     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//     PDO::ATTR_EMULATE_PREPARES   => false
// ];

// $pdo = new PDO($dsn, $user, $pass, $options);


