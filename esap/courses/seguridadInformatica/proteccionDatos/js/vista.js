$(document).ready(function () {

    var pageconcepts = {
        deg: 0,
        btnRL: 1,
        conceptTag: 1,
        conceptTotal: 0,
        contentUnity: null,
        init: function () {
            concepts.contentUnity = $('#loadUnity');
            /* url de la unidad de aprendizaje  acargar */
            $('#loadUnity').load(urls.unityid);
            concepts.loadEvents();
        },
        loadEvents: function () {
            /* girar el planeta a la derecha */
            $(concepts.contentUnity).on('click', '#btnNext', function () {
                concepts.conceptTotal = $('.concept').length;
                concepts.btnRL = 1;
                concepts.deg += 90;
                concepts.hideConcepts();
                var rotate = 'rotate(-' + concepts.deg + 'deg)';

                $("#div").css({transform: rotate}, 1000);
                setTimeout(concepts.showConcepts, 1000);
            });

            /* girar el planeta a la izquierda */
            $(concepts.contentUnity).on('click', '#btnPrev', function () {
                concepts.conceptTotal = $('.concept').length;
                if (concepts.deg == 0) {
                    return;
                } else {
                    concepts.deg -= 90;
                }
                btnRL = 0;
                concepts.hideConcepts();
                var rotate = 'rotate(-' + concepts.deg + 'deg)';
                $("#div").css({'transform': rotate});
                setTimeout(concepts.showConcepts, 1000);
            });
        },
        hideConcepts: function () {
            var currentObj = $('.concept[concept=' + concepts.conceptTag + ']');
            $(currentObj).animate({opacity: 0.1}, 300, function () {
                $(currentObj).addClass('hide');
            });
        },

        showConcepts: function () {
            if (concepts.btnRL == 1) {
                concepts.conceptTag++;
            } else {
                concepts.conceptTag--;
            }

            if (concepts.conceptTag > concepts.conceptTotal) {
                concepts.conceptTag = 1;
            }
            if (concepts.conceptTag == 0) {
                concepts.conceptTag = 4;
            }
            var nextObj = $('.concept[concept=' + concepts.conceptTag + ']');
            $(nextObj).css({opacity: 0});
            $(nextObj).removeClass('hide');
            $(nextObj).animate({opacity: 1}, 300);
        }
    };

    var concepts = pageconcepts;
    concepts.init();

});