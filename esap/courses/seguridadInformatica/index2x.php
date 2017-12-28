<?php
/*
 * Listar las unidades del curso
 * Las unidades se desbloquean segun el avance del usuario en las actividades
 */

require_once '../../config.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>ESAP-Programas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- inclusion de las hojas de estilo -->
        <link rel="stylesheet" href="../../Resources/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../Resources/css/mine.css">
        <link rel="stylesheet" href="../../Resources/css/jquery-ui.min.css">

    </head>
    <body>
        <header>
            <div class="col-sm-12">Juan Dominguez</div>
        </header>
        <section>
            <div class="container">
                <h1>Bienvenido al curso de Seguridad Informática</h1>
                <div class="row">
                    <div class="col-sm-12">Estas son los Objetos Virtuales de Apendizaje de debes aprobar</div>
                </div>
                
                <div class="col-xs-12 col-sm-3 tagPost"><a href="proteccionDatos/?id=1">Protección de datos</a></div>
                <div class="col-xs-12 col-sm-3 tagPost"><a href="proteccionDatos/?id=2">Encriptación de datos</a></div>
                <div class="col-xs-12 col-sm-3 tagPost"><a href="proteccionDatos/?id=3">Analisis de vulnerabilidad</a></div>
            </div>
        </section>
        <footer>

        </footer>

        <script src="../../Resources/js/jquery-3.2.1.min.js"></script>
        <script src="../../Resources/js/bootstrap.min.js"></script>
        <script src="../../Resources/js/jquery-ui.min.js"></script>
    </body>
</html>