
var loadm = {
    ajax: function (params) {

        var type = 'get';
        var data = {};
        var dataType = 'json';
        if (params.type) {
            type = params.type;
        }
        if (params.data) {
            data = params.data;
        }
        if (params.dataType) {
            dataType = params.dataType;
        }

        $.ajax({
            type: type,
            url: params.url,
            data: data,
            dataType: dataType,
            success: function (data, textStatus, jqXHR) {
                if (params.callback) {
                    params.callback(data);
                }
            }
        });
    }
};

function fxloadm() {
//    $('.buttons-content').load('/esap/courses/seguridadInformatica/proteccionDatos/index.php?id=1');
    
    var btn1 = $('<a>');
    var btn2 = $('<a>');
    var btn3 = $('<a>');
            
    $(btn1).html('Protección de datos').addClass('courseUnity btn btn-primary')
            .prop({href: '/esap/courses/seguridadInformatica/proteccionDatos/?id=1', disabled: true});
    $(btn2).html('Encriptación de datos').addClass('courseUnity btn btn-primary')
            .prop('href', '/esap/courses/seguridadInformatica/proteccionDatos/?id=2');
    $(btn3).html('Analisis de vulnerabilidad').addClass('courseUnity btn btn-primary')
            .prop('href', '/esap/courses/seguridadInformatica/proteccionDatos/?id=3');

    $('.buttons-content').append(btn1);
    $('.buttons-content').append(btn2);
    $('.buttons-content').append(btn3);
}
