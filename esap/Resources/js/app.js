
/*
 * Funciones generales y globales usadas en el proyecto
 */

var loadm = {
    ajax: function (params) {

        var type = 'post';
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

