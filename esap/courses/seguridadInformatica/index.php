
<?php
require_once '../../config.php';

$id = optional_param('id', 0, PARAM_INT);

if (empty($id)) {
    /* si no existe un id del programa se vuelve a la pagian anterior */
    header('Location: /');
    return;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Language" content="es">
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title>Pagina nueva 2</title>
        <link href="<?php echo $resourcesRoot; ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $resourcesRoot; ?>/css/mine.css" rel="stylesheet">
        <link href="/esap/courses/seguridadInformatica/css/styles.css" rel="stylesheet">
    </head>

    <body>
        <div id="loadUnity"></div>

        <script src="<?php echo $resourcesRoot; ?>/js/jquery-3.2.1.min.js"></script>
        <script src="<?php echo $resourcesRoot; ?>/js/bootstrap.min.js"></script>
        <script src="/esap/courses/seguridadInformatica/js/vista.js"></script>

        <script language=javascript>
            var urls = {
                unityid: '<?php echo "/esap/courses/seguridadInformatica/unidad$id.php"; ?>'
            }
        </script>

    </body>

</html>