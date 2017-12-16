
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
                margin: auto 11%;
                width: 80%;
                -webkit-transition: all 1s ease-in-out;
                -moz-transition: all 1s ease-in-out;
                -o-transition: all 1s ease-in-out;
                transition: all 1s ease-in-out;
                border-radius: 50%;
            }
            #div img{
                width: 100%;
                height: 100%;
                transform: rotate(45deg);
            }
            .content-circle{
                position: relative;
                overflow: hidden;
                background-color: #555;
            }
            .contentImg{
                position: absolute;
                z-index: 1;
                top: 20%;
                left: 30%;
                background-color: #FFF;
                width: 80px;
            }
            .tag{
                padding: 20px;
                text-align: center;
                overflow: auto;
                height: 30px;
            }
            .tag.xa{
                background-color: #e46e00;
            }
            .tag.xb{
                background-color: #624bff;
            }
            .tag.xc{
                background-color: #62ff4b;
            }
            .concept{
                position: absolute;
                top: 45%;
                left: 44%;
                border-radius: 5px;
                width: 13%;
            }
            .concept img{
                width: 100%;
            }

            .imgPlane{
                position: absolute;
                left: 30%;
                z-index: 1;
                top: 0;
                width: 10%;
            }
            .imgPlane img{
                width: 100%;
                height: 100%;
            }
            .cursorClick{
                cursor: pointer;
            }
            #btnPrev,#btnNext{
                position: absolute;
                height: 100%;
                width: 12%;
                top: 0;
                z-index: 1;
            }
            #btnPrev:hover,#btnNext:hover{
                background-color: #eee;
                opacity: 0.3;
            }
            #btnPrev img,#btnNext img{
                position: absolute;
                width: 80%;
                opacity: 0.3;
                top: 30%;
            }
            #btnPrev{
                left: 1%;
            }
            #btnNext{
                right: 1%;
            }
            .centerVideo{
                margin: 2px 2%;
                display: block;
                width: 96%;
            }
            .sky{
                background-color: #555;
            }
            .content-head{
                position: absolute;
                height: 50%;
            }
        </style>

    </head>

    <body>
        <div class="col-sm-12">
            <div class="col-sm-12 sky">

                <div class="content-circle">
                    <div id="btnPrev" class="cursorClick">
                        <img src="Resources/multimedia/btnBack.png" alt="Atras">
                    </div>
                    <div id="btnNext" class="cursorClick">
                        <img src="Resources/multimedia/btnNext.png" alt="Next">
                    </div>
                    <div class="imgPlane">
                        <img src="Resources/multimedia/astronauta.gif" alt="plane">
                    </div>

                    <div id="div">
                        <img src="Resources/multimedia/circulo.png">
                    </div>

                    <div class="concept cursorClick" id="concept1" concept="1" data-toggle="modal" data-target="#myModal">
                        <img src="Resources/multimedia/satelite.gif">
                    </div>
                    <div class="concept cursorClick hide" id="concept2" concept="2" data-toggle="modal" data-target="#myModal">
                        <img src="Resources/multimedia/radio.gif">
                    </div>
                    <div class="concept cursorClick hide" id="concept3" concept="3" data-toggle="modal" data-target="#myModal">
                        <img src="Resources/multimedia/televisor.gif">
                    </div>
                    <div class="concept cursorClick hide" id="concept4" concept="4" data-toggle="modal" data-target="#myModal">
                        <img src="Resources/multimedia/engranaje.gif">
                    </div>
                </div>

            </div>
        </div>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="col-sm-12">
                <div class="modal-content">
                    <video class="centerVideo" src="Resources/multimedia/SeguridadInformatica.mp4" controls=""></video>
                </div>
            </div>
        </div>

        <script src="Resources/js/jquery-3.2.1.min.js"></script>
        <script src="Resources/js/bootstrap.min.js"></script>

        <script language=javascript>

            $(document).ready(function () {
                var deg = 0;
                var btnRL = 1;
                var conceptsQty = $('.concept').length;
                var conceptTag = 1;


                $('#btnNext').click(function () {
                    btnRL = 1;
                    deg += 90;
                    hideConcepts();
                    var rotate = 'rotate(-' + deg + 'deg)';

                    $("#div").css({transform: rotate}, 1000);
                    setTimeout(showConcepts, 1000);
                });

                $('#btnPrev').click(function () {
                    if (deg == 0) {
                        return;
                    } else {
                        deg -= 90;
                    }
                    btnRL = 0;
                    hideConcepts();
                    var rotate = 'rotate(-' + deg + 'deg)';
                    $("#div").css({'transform': rotate});
                    setTimeout(showConcepts, 1000);
                });

                function hideConcepts() {
                    var currentObj = $('.concept[concept=' + conceptTag + ']');
                    $(currentObj).animate({opacity: 0.1}, 300, function () {
                        $(currentObj).addClass('hide');
                    });
                }

                function showConcepts() {

                    if (btnRL == 1) {
                        conceptTag++;
                    } else {
                        conceptTag--;
                    }

                    if (conceptTag > conceptsQty) {
                        conceptTag = 1;
                    }
                    if (conceptTag == 0) {
                        conceptTag = 4;
                    }

                    var nextObj = $('.concept[concept=' + conceptTag + ']');
                    $(nextObj).css({opacity: 0});
                    $(nextObj).removeClass('hide');
                    $(nextObj).animate({opacity: 1}, 300);
                }
            }
            );

        </script>

    </body>

</html>