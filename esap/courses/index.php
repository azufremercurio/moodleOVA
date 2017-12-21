<?php
/*
 * Listar los cursos del usuario
 */

require_once '../config.php';
require_once '../Controller/controller.php';

//insertRegister();

/* obtener el array de los cursos */
$enrolCourses = enrol_get_all_users_courses($USER->id);



?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>ESAP-Programas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <!-- inclusion de las hojas de estilo -->
        <link href="../Resources/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Resources/css/jquery-ui.min.css" rel="stylesheet">
        <link href="../Resources/css/mine.css" rel="stylesheet">

    </head>
    <body>
        <header>
            <div class="col-sm-12">Juan Dominguez</div>
        </header>
        <section>
            <div class="container">
                <h1>Estos son tus Cursos disponibles</h1>

                <div class="row">
                    <div class="col-sm-12">
                        <?php foreach ($enrolCourses as $course) { ?>
                            <div class="col-sx-12 col-sm-4 tagPost">
                                <a href="seguridadInformatica/">
                                    <img src="../Resources/multimedia/safe.jpg" alt="" width="50"> <?php echo $course->fullname; ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </section>
        <footer>

        </footer>
        <script src="../Resources/js/jquery-3.2.1.min.js"></script>
        <script src="../Resources/js/bootstrap.min.js"></script>
        <script src="../Resources/js/jquery-ui.min.js"></script>
    </body>
</html>