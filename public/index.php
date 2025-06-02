<?php

session_start();
define('SITE_ROOT', __DIR__.'/../');

require_once(SITE_ROOT.'app/view/template_engine.php');
require_once(SITE_ROOT.'app/config/db.php');

// var_dump($_GET);
// var_dump($_SERVER["REQUEST_URI"]);

$temp = parse_url($_SERVER["REQUEST_URI"]);
$uri_parts = explode('/', trim($temp['path'], '/'));

$zone = 'public';
if(!empty($uri_parts[0]) && $uri_parts[0] === 'admin'){
    $zone = 'admin';
    array_shift($uri_parts);
}


if(empty($uri_parts[0])){
    $controller = 'home';
}
else{
    $controller = $uri_parts[0];
}

if($zone === 'admin' && empty($_SESSION['active_user']))
    header('Location: /checkin');


if (empty($uri_parts[1])) {
    $action = $controller;
} else {
    $action = $uri_parts[1];
}

$slug = null;
if (!empty($uri_parts[2])) {
    $slug = $uri_parts[2];
} 
$controller_path = SITE_ROOT . "app/controller/$zone/$controller.php";


$failedToLoad = false;


if (file_exists($controller_path)) {
    include $controller_path;
    if(function_exists($action)){
        call_user_func($action, $slug);
    } else {
        $failedToLoad = true;
    }
} else {
    $failedToLoad = true;
}

if($failedToLoad === true){
    echo "<h1>404 Not Found</h1>";
    echo "<p>The requested URL was not found on this server.</p>";
    var_dump($controller_path, $uri_parts);

    http_response_code(404);
}