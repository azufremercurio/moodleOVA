
/*
 * Funciones generales y globales usadas en el proyecto
 */

var app = {
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
    },
    events: function() {
        $('#loadUnity').on('click', '.objmultimedia', function(){
            var objName = $(this).attr('objName');
            myApp.registResource(objName);
        });
        
    },
    registResource: function(objName){
        var params = {
            url: '/esap/app.php/set/user/resource',
            data: {objName: objName},
            callback: function(data){
                console.log(data);
            }
        };
        myApp.ajax(params);
    }
};
var myApp = app;
