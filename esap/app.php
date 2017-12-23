<?php

require_once '../config.php';
require_once 'Libraries/spyc/spyc.php';

require_login();

$rqMethod = $_SERVER['REQUEST_METHOD'];
$urlActual = $_SERVER['REQUEST_URI'];

$routGet = explode('?', $urlActual);

$appUrl = explode('app.php', $routGet[0]);

if (count($appUrl) == 1) {
    throw new Exception('There is not a valid route');
}

$callResource = $appUrl[1];

$arrRoutings = Spyc::YAMLLoad('routing.yml'); 

if (!array_key_exists($callResource, $arrRoutings)) {
    throw new Exception('There is not a valid route');
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
if ($rqMethod != 'POST' && $method == 'POST') {
    throw new Exception('Method type are different');
}

if ($rqMethod == 'POST' && $method == 'POST') {
    /* obtener todos los valores del post */
    $data = $_POST;
    if (empty($data)) {
        throw new Exception('Params are void');
    }
} elseif ($rqMethod == 'GET') {
    $data = $_GET;
}
echo $objClass->{$action . "Action"}($data);
