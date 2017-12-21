<?php

require_once '../config.php';

require_login();

$method = $_SERVER['REQUEST_METHOD'];
$urlActual = $_SERVER['REQUEST_URI'];
$appUrl = explode('app.php', $urlActual);

if(count($appUrl) == 1) {
    return;
}

$callResource = $appUrl[1];

$routingContent = file_get_contents('routing.json');
$arrRoutings = json_decode($routingContent, true);

if(!array_key_exists($callResource, $arrRoutings)){
    die("Ruta no encontrada");
    return;
}

$arrPath = $arrRoutings[$callResource];

$class = $arrPath['class'];
$action = $arrPath['action'];

require_once "Controller/$class.php";
$objClass = new $class;

$data = [];
if($method == 'POST') {
    $data = $_POST;
} elseif ($method == 'GET') {
    $data = $_GET;
}

echo $objClass->{$action."Action"}($data);
