/* 
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 12-jul-2017, 19:33:13
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

            if ($(".input-tags").length > 0) {
                try {
                    $(".input-tags").tagsInput({
                        width: "100%",
                        interactive: true,
                        removeWithBackspace: true
                    });
                } catch (e) {
                    alert(e);
                }
            }

            if ($(".form_wizard").length > 0) {
                $('#wizard_install').smartWizard({
                    buttonOrder: ['next', 'prev'],
                    enableFinish: false,
                    hideButtonsOnDisabled: true,
                    onShowStep: function (obj, step) {
                        if ($(".buttonFinish").length > 0) {
                            $(".buttonFinish").remove();
                        }
                        if (step.toStep == 3) {
                            if ($(".btn-finish").length < 1) {
                                $(".actionBar").append('<button class="btn btn-dark btn-finish buttonFinish" type="submit">Finish</button>');
                                $(".btn-finish").css("margin-top", "4px");
                            }
                        }
                    }
                });
            }

            if ($(".select2-selection--multiple").length > 0) {
                $(".select2-selection--multiple").select2();
                $('.select2-selection--multiple').on('select2:select', function (evt) {
                    var h_id = $(this).data('input');
                    if (h_id != undefined && h_id != '') {
                        $("#" + h_id).val($(this).val());                        
                    }
                });
                $('.select2-selection--multiple').on('select2:unselect', function (evt) {
                    var h_id = $(this).data('input');
                    if (h_id != undefined && h_id != '') {
                        $("#" + h_id).val($(this).val());
                    }
                });
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

        } catch (e) {
            VideoGO.Notify(e, "error");
        }
    },
    Notify: function (msg, style) {
        new PNotify({text: msg, type: style, styling: 'bootstrap3', delay: 2000});
    },
    CallApi: function (form) {
        var view = $(form).data("view");
        if (view == '' || view == undefined) {
            view = 'api-view';
        }
        if ($("." + view).length < 1) {
            $(form).append('<div class="' + view + '"></div>');
        }
        $("." + view).html('<center><h5><img src="data:image/gif;base64,R0lGODlhEAAQAIABAAAAAP///yH/C05FVFNDQVBFMi4wAwEAAAAh+QQJCgABACwAAAAAEAAQAAACHYyPqcvtD6M0oAJo78vYzsOFXiBW5Fhe3GmmX1AAACH5BAkKAAEALAAAAAAQABAAAAIcjI+py+0PowIUwGofvlXKDXZBSI0iaW1miXpGAQAh+QQJCgABACwAAAAAEAAQAAACH4yPacCg2txDcdJms62aZ79h2ngxAXhU6IKtZyuSTwEAIfkECQoAAQAsAAAAABAAEAAAAiCMj2nAEO0UfE1RdmOa03rbfZm4VGRIpiV2miLqwepXAAAh+QQJCgABACwAAAAAEAAQAAACHoyPacAQ7eBqj8rKcKS6XwUeX9iRU2aW6cq27guDBQAh+QQJCgABACwAAAAAEAAQAAACHoyPacAQ7eBqj8rKcKS6XwWGySeSoQmi4sq27guDBQAh+QQJCgABACwAAAAAEAAQAAACHoyPqQEN7JZ7U8aqKl68m92BnGg13lk+J5lFq4seBQAh+QQJCgABACwAAAAAEAAQAAACHoyPqQoNm9yDR9Lqrl5W9/tR4cZlo2GdQZoxZksaBQA7" /></h5></center>');
        $.ajax({
            url: "/api",
            method: "POST",
            data: new FormData(form),
            contentType: false,
            processData: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Accept', "text/html; charset=utf-8");
            },
            success: function (response) {
                $("." + view).html(response);
            },
            error: function (xhr, status, response) {
                VideoGO.Notify(xhr.statusText, "error");
                $("." + view).html("");
            }
        });


    }
}


$(document).ready(function () {
    try {
        VideoGO.__construct();
    } catch (e) {
        console.log(e);
    }
});