<?php

require_once 'Routing.php';

require_once 'src/controllers/DefaultController.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('index', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');

if (isset($_SESSION['user'])) {
    Routing::get('homepage', 'DefaultController');
    Routing::get('bookmarks', 'DefaultController');
    Routing::get('account', 'DefaultController');
    Routing::get('search', 'DefaultController');
    Routing::get('logout', 'SecurityController');
}

Routing::run($path);
?>