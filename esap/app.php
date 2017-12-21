<?php

require_once '../config.php';

require_login();

$rqMethod = $_SERVER['REQUEST_METHOD'];
$urlActual = $_SERVER['REQUEST_URI'];
$appUrl = explode('app.php', $urlActual);

if (count($appUrl) == 1) {
    return;
}

$callResource = $appUrl[1];

$routingContent = file_get_contents('routing.json');
$arrRoutings = json_decode($routingContent, true);

if (!array_key_exists($callResource, $arrRoutings)) {
    die("Ruta no encontrada");
    return;
}

$arrPath = $arrRoutings[$callResource];

$class = $arrPath['class'];
$action = $arrPath['action'];
$method = 'GET';

if (array_key_exists('method', $arrPath)) {
    $method = $arrPath['method'];
}

require_once "Controller/$class.php";
$objClass = new $class;

$data = [];
/* validar si el prametro es POST para observar el contenido */
if ($rqMethod == 'POST' && $method == 'POST') {
    /* obtener todos los valores del post */
    $data = $_POST;
    if (empty($data)) {
        echo "params are void";
        return;
    }
} elseif ($rqMethod == 'GET') {
    $data = $_GET;
}

echo $objClass->{$action . "Action"}($data);
