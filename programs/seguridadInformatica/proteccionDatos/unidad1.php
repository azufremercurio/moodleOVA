<?php require_once '../../config.php'; ?>
<!-- Recurso correspondiente a la Proteccion de Datos -->

<div class="col-sm-12">
    <div class="col-sm-12 sky">

        <div class="content-circle">
            <div id="btnPrev" class="cursorClick">
                <img src="<?php echo $resourcesRoot; ?>/multimedia/btnBack.png" alt="Atras">
            </div>
            <div id="btnNext" class="cursorClick">
                <img src="<?php echo $resourcesRoot; ?>/multimedia/btnNext.png" alt="Next">
            </div>
            <div class="imgPlane">
                <img src="<?php echo $resourcesRoot; ?>/multimedia/astronauta.gif" alt="plane">
            </div>

            <div id="div">
                <img src="<?php echo $resourcesRoot; ?>/multimedia/circulo.png">
            </div>

            <div class="concept cursorClick" id="concept1" concept="1" data-toggle="modal" data-target="#myModal">
                <img src="<?php echo $resourcesRoot; ?>/multimedia/satelite.gif">
            </div>
            <div class="concept cursorClick hide" id="concept2" concept="2" data-toggle="modal" data-target="#myModal">
                <img src="<?php echo $resourcesRoot; ?>/multimedia/radio.gif">
            </div>
            <div class="concept cursorClick hide" id="concept3" concept="3" data-toggle="modal" data-target="#myModal">
                <img src="<?php echo $resourcesRoot; ?>/multimedia/televisor.gif">
            </div>
            <div class="concept cursorClick hide" id="concept4" concept="4" data-toggle="modal" data-target="#myModal">
                <img src="<?php echo $resourcesRoot; ?>/multimedia/engranaje.gif">
            </div>
        </div>

    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="col-sm-12">
        <div class="modal-content">
            <video class="centerVideo" src="<?php echo $resourcesRoot; ?>/multimedia/SeguridadInformatica.mp4" controls=""></video>
        </div>
    </div>
</div>