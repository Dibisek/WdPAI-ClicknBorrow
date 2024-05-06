<?php

require_once 'src/controllers/AppController.php';

// echo "<h1>Hello world 🙋</h1>";

$controller = new AppController();

$path = trim($_SERVER['REQUEST_URI']);
$path = parse_url($path, PHP_URL_PATH);
$action = explode('/', $path)[1];
$action = $action == NULL ? 'login' : $action;
// var_dump($_SERVER['REQUEST_URI']);

$controller->render($action);
?>