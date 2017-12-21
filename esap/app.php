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

$arrRoutings = [
    '/test' => ['Curso', 'index'],
    '/testx' => ['Curso', 'default'],
];

if(!array_key_exists($callResource, $arrRoutings)){
    die("Ruta no encontrada");
    return;
}

$arrPath = $arrRoutings[$callResource];

$class = $arrPath[0];
$action = $arrPath[1];

require_once "Controller/$class.php";
$objClass = new $class;

$data = [];
if($method == 'POST') {
    $data = $_POST;
} elseif ($method == 'GET') {
    $data = $_GET;
}

echo $objClass->{$action."Action"}($data);
