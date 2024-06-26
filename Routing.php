<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/ErrorController.php';
require_once 'src/controllers/BooksController.php';
require_once 'src/controllers/AdminController.php';
require_once 'src/controllers/ReservationController.php';
require_once  'src/controllers/BookmarkController.php';


class Routing {
    public static $routes;

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($url) {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {
            ErrorController::getInstance()->error();
            return;
        }

        $controller = self::$routes[$action];
        $object = new $controller;

        $action = $action ?: 'index';

        $id = $urlParts[1] ?? '';

        $object->$action($id);
    }

}