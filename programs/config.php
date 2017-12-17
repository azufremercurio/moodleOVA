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

/**
 * obtener la ruta del dominio hasta al carpeta programs
 * con el fin de obtener los recursos multimedia
 * @return string
 */
function getUrlPath() {
    $httpRefer = $_SERVER['HTTP_REFERER'];
    $urlArr = explode('/programs', $httpRefer);
    $urlNeed = $urlArr[0];

    return $urlNeed;
}

$urlPath = getUrlPath();
$programsRoot = "$urlPath/programs";
$resourcesRoot = "$urlPath/programs/Resources";

