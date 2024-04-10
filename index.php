<?php

use app\core\Router;

error_reporting(E_ALL);
ini_set('display_errors', 1);

function debug($data) {
    echo '<pre>';
    print_r($data);
}

function findKey($what, $where) {
    $key = array_search($what, $where);

    return $key;
}

spl_autoload_register(function ($class) {
    $file = $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$router = new Router();
$router->routing();
