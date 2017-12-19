<?php

/*
 * Archivo para las inclusiones mas necesarias
 */

require_once(__DIR__ . '/../config.php');
require_once($CFG->dirroot . '/my/lib.php');

/*
 * reenviar al login en caso de no haber session
 */
if (!isloggedin()) {
    require_login();
    return;
}

function interpretacionUrl() {
    
}

/**
 * obtener la ruta del dominio hasta al carpeta programs
 * con el fin de obtener los recursos multimedia
 * @return string
 */
function getUrlPath() {
    $actualLink = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    $urlArr = explode('/esap', $actualLink);
    $urlNeed = $urlArr[0];

    return $urlNeed;
}

$urlPath = getUrlPath();
$programsRoot = "$urlPath/esap/courses";
$resourcesRoot = "$urlPath/esap/Resources";

