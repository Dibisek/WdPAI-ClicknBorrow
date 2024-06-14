<?php

require_once 'Routing.php';

require_once 'src/controllers/DefaultController.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

function isAdmin() {
    if (!isset($_SESSION['user'])) {
        return false;
    }

    $user = unserialize($_SESSION['user']);
    return $user->getIsAdmin();
}

Routing::get('', 'DefaultController');
Routing::get('error', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');


if (isset($_SESSION['user'])) {
    Routing::get('homepage', 'BooksController');
    Routing::get('bookmarks', 'DefaultController');
    Routing::get('bookDetails', 'BooksController');
    Routing::get('account', 'DefaultController');
    Routing::get('search', 'BooksController');
    Routing::get('logout', 'SecurityController');
    Routing::post('filterBooks', 'BooksController');
    Routing::post('reservationHandler', 'AdminController');

}
if (isAdmin()) {
    Routing::get('reservationsAdmin', 'AdminController');
}

Routing::run($path);
?>