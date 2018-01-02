<html>
    <head>
        <title>SELECCIONE CURSO Y UNIDAD</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="Resources/css/bootstrap.min.css" rel="stylesheet">
        <link href="Resources/css/jquery-ui.min.css" rel="stylesheet">
        <link href="Resources/css/mine.css" rel="stylesheet">

        <style>
            .ui-autocomplete-loading {
                /*background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;*/
            }
        </style>

    </head>
    <body>

        <div class="panel panel-default">
            <div class="panel-body">

                <form class="form-inline" role="form" method="POST">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Curso</label>
                            <input type="text" class="form-control" id="course" placeholder="Ingresa el curso">
                            <input type="hidden" id="idCourse" name="idCourse">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 col-lg-12">
                            <label class="form-label" for="section">Seleccione la unidad</label>
                            <select class="form-control" id="unit">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-default">Entrar</button>
                </form>

            </div>
        </div>
        <footer>
        </footer>
        <script src="Resources/js/jquery-3.2.1.min.js"></script>
        <script src="Resources/js/bootstrap.min.js"></script>
        <script src="Resources/js/jquery-ui.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#course').autocomplete({
                    source: function (request, response) {
                        $.ajax({
                            url: "/esap/app.php/get/courses/like/name",
                            type: 'post',
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    minLength: 2,
                    select: function (event, ui) {
                        $('#idCourse').val(ui.item.id);
                    }
                });
            });
        </script>

    </body>
</html>
