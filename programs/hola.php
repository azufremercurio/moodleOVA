
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Language" content="es">
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title>Pagina nueva 2</title>
        <link href="Resources/css/bootstrap.min.css" rel="stylesheet">
        <link href="Resources/css/mine.css" rel="stylesheet">

        <style>
            #div {
                position:absolute; 
                /*height: 80%;*/ 
                width: 80%; 
                margin: 30px;
                -webkit-transition: all 1s ease-in-out;
                -moz-transition: all 1s ease-in-out;
                -o-transition: all 1s ease-in-out;
                transition: all 1s ease-in-out;
                border-radius: 50%
            }
            #div img{
                width: 100%;
                height: 100%;
                transform: rotate(45deg);
            }
            .content-circle{
                position: relative;
                overflow: hidden;
                background-color: #ccc;
            }
        </style>

    </head>

    //Configuramos el body para que al cargarse la página se inicie la función girar()
    <body>
        <button id="button">rotate</button>
        <div class="content-circle">
            <div class="col-sm-12">
                <div id="div"><img src="Resources/multimedia/circulo.png"></div>
            </div>
        </div>
        <div id="val"></div>

        <script src="Resources/js/jquery-3.2.1.min.js"></script>
        <script src="Resources/js/bootstrap.min.js"></script>

        <script language=javascript>
            var deg = 0;

            $('#button').click(function () {
                deg += 90;
                $("#div").css({'transform': 'rotate(-' + deg + 'deg)'});
                $('#val').text(deg);
            });
        </script>

    </body>

</html>