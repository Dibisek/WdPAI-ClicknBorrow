<?php

require_once 'Routing.php';

require_once 'src/controllers/DefaultController.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('index', 'BooksController');
Routing::get('error', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('filterBooks', 'BooksController');

if (isset($_SESSION['user'])) {
    Routing::get('homepage', 'BooksController');
    Routing::get('bookmarks', 'DefaultController');
    Routing::get('bookDetails', 'BooksController');
    Routing::get('account', 'DefaultController');
    Routing::get('search', 'BooksController');
    Routing::get('logout', 'SecurityController');
}

Routing::run($path);
?>