
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

$(document).ready(function () {

    var loadSections = {
        courseId: 0,
        init: function () {
            load.courseId = load.getCourseId('id');
            load.getSectionsByUser();
        },
        getSectionsByUser: function () {
            var data = {
                url: '/esap/app.php/set/user/course/sections',
                data: {idCourse: load.courseId},
                callback: function (result) {
                    load.loadOvaBySection(result);
                }
            };
            load.ajax(data);
        },
        loadOvaBySection: function (result) {
            /*
             * observar los <li> con #section- de manera que
             * se consulte el <div> con clase .buttons-content
             */
            var count = 1;
            $.each(result.sections, function (index, item) {
                var liPropId = "#section-" + item.sectiontheme;
                var content = $(liPropId).find('.buttons-content');

                if ($(content).length > 0) {
                    var btn = $('<a href="' + result.path + '?id=' + count + '">');
                    $(btn).addClass('courseUnity btn btn-primary').html(item.title);
                    $(content).append(btn);
                    count++;
                }
            });
        },
        getCourseId: function (param) {
            var strUrl = window.location;
            var url = new URL(strUrl);
            var urlSearchParams = url.searchParams;
            return urlSearchParams.get(param);
        },
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

    var load = loadSections;
    load.init();
});