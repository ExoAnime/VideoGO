/* 
 * Project's Name: VideoGO
 * Description: Sistema para reproducir videos de forma anonima y directa
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 02-jul-2017, 23:11:43
 * File Name: script.js
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */


var VideoGO = {
    __construct: function () {
        try {
            if ($("form").length > 0) {
                $("form").submit(function () {
                    try {
                        VideoGO.CallApi(this);
                    } catch (e) {
                        alert(e);
                    }
                    return false;
                });
            }

            if ($("#activeform").length > 0) {
                $("#activeform").submit();
            }

            if ($(".btn_upload_avatar").length > 0) {
                $(".btn_upload_avatar").click(function () {
                    $("#upload_avatar").val("");
                    $("#upload_avatar").click();
                });
                $("#upload_avatar").change(function () {
                    if ($(this).val() != '') {
                        $("#form_upload").submit();
                    }
                });
            }

            if ($(".btn-facebook").length > 0) {
                this.load_fb_app_js();
                $(".btn-facebook").click(function () {
                    VideoGO.fb_app_vinculate();
                });
            }

            if ($(".btn-gender-active").length > 0) {
                $(".btn-gender-active").click();
            }

        } catch (e) {
            alert(e);
        }
    },
    load_fb_app_js: function () {
        var s = document.createElement("script");
        s.src = "//www.videogo.es/vendors/build/js/fb_app.js?v=" + Math.random();
        document.querySelector("head").appendChild(s);
    },
    fb_app_vinculate: function () {
        fb.login(function () {
            if (fb.logged) {
                $("#form_fb input:last-child").val(JSON.stringify(fb.user));
                $("#form_fb").submit();
            } else {
                VideoGO.Notify("No autorizaste nuestra aplicacion", "error");
            }
        })
    },
    CallApi: function (form) {
        var view = $(form).data("view");
        if (view == '' || view == undefined) {
            view = 'api-view';
        }
        if ($("." + view).length < 1) {
            $(form).append('<div class="' + view + '"></div>');
        }
        var formData = new FormData(form);
        $("." + view).html('<center><h5><img src="data:image/gif;base64,R0lGODlhEAAQAIABAAAAAP///yH/C05FVFNDQVBFMi4wAwEAAAAh+QQJCgABACwAAAAAEAAQAAACHYyPqcvtD6M0oAJo78vYzsOFXiBW5Fhe3GmmX1AAACH5BAkKAAEALAAAAAAQABAAAAIcjI+py+0PowIUwGofvlXKDXZBSI0iaW1miXpGAQAh+QQJCgABACwAAAAAEAAQAAACH4yPacCg2txDcdJms62aZ79h2ngxAXhU6IKtZyuSTwEAIfkECQoAAQAsAAAAABAAEAAAAiCMj2nAEO0UfE1RdmOa03rbfZm4VGRIpiV2miLqwepXAAAh+QQJCgABACwAAAAAEAAQAAACHoyPacAQ7eBqj8rKcKS6XwUeX9iRU2aW6cq27guDBQAh+QQJCgABACwAAAAAEAAQAAACHoyPacAQ7eBqj8rKcKS6XwWGySeSoQmi4sq27guDBQAh+QQJCgABACwAAAAAEAAQAAACHoyPqQEN7JZ7U8aqKl68m92BnGg13lk+J5lFq4seBQAh+QQJCgABACwAAAAAEAAQAAACHoyPqQoNm9yDR9Lqrl5W9/tR4cZlo2GdQZoxZksaBQA7" /></h5></center>');
        $.ajax({
            type: "POST",
            url: "/api",
            enctype: 'multipart/form-data',
            data: formData,
            cache: false,
            processData: false
        }).done(function (data) {
            $("." + view).html(data);
        }).fail(function () {
            $("." + view).html("");
            VideoGO.Notify("Error no se logro encontrar el recurso solicitado", "error");
        });
    },
    Notify: function (msg, style) {
        new PNotify({text: msg, type: style, styling: 'bootstrap3', delay: 2000});
    }
}

$(document).ready(function () {
    try {
        VideoGO.__construct();
    } catch (e) {
        console.log(e);
    }
});