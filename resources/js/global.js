var isChatOpen = false;
var id_emp = null;
var listening;
$(function () {

    $("#admin-link-trigger").mousedown(function (e) {
        e.preventDefault();
        switch (e.which) {
            case 3:
                $("#admin-link").animate({left: 100}, 500, "easeOutExpo");
                break;
        }
        return false;
    });

    $("#admin-link").on('click', function () {
        $(this).css('left', '-100%');
    });

    if (!is_touch_device()) {
        sendMsg("Haga doble click en el capuchón para abrir el chat.");
    }

    $("#form-gather-client-info").submit(function (e) {

        var informacion = $(this).serialize();

        gatherClientInfo(informacion, e);
    });

    $(".anchors").on('click', function (e) {

        var anchor = $(this).children("span").children('a').attr('href');

        if (anchor.indexOf("#") !== -1) {

            e.preventDefault();

            var sk2 = $("" + anchor + "").offset().top;

            $("html,body").animate({
                scrollTop: sk2
            }, 800, "easeOutExpo");
        } else {
            window.location.href = anchor;
        }
    });

    $(window).scroll(function () {
        var wsk = $(window).scrollTop();
        if (wsk > 100) {
            $("#btn-scroll-up").transition({opacity: 1});
        }
    });

    $("#btn-scroll-up").click(function () {
        $('html,body').animate({scrollTop: 0}, 1000, "easeOutExpo");
    });

    setChat();

    $(".bring").on('click', function () {
        bringChat($(this));
    });

    $("#chat-head").on('dblclick', function () {
        init_new_chat();
    });

    $("#chat-head").on('taphold', function (e) {
        init_new_chat();
    });

    var ismousedown = false;

    $(".messages-container").mousedown(function () {
        ismousedown = true;
    }).mouseup(function () {
        ismousedown = false;
    });

    // AUTO SCROLL .messages-container when new messages are appended
    $("#chat-body .messages-container").on('DOMNodeInserted', function () {
        if (ismousedown === false) {
            $(".messages-container").animate({
                scrollTop: $(this)[0].scrollHeight
            }, 0);
        }
    });

    // on message submit, ajax-send new message
    $("#messaging-form").submit(function (e) {
        var serializedMsg = $(this).serialize();
        sendNewMessage(serializedMsg, e);
    });

    $('.close').on('click', function () {
        abrirChat();
    });

    $("#upload-btn").on('click', function () {
        $('#trigger-upload-window').trigger('click');
    });

    $('#trigger-upload-window').on('change', function () {
        $("#form-send-file").submit();
    });

    $("#form-send-file").submit(function (e) {
        sendFile($(this)[0]);
        e.preventDefault();
    });

});
// ============================   ./ DOCUMENT .READY 

$(window).resize(function () {
    setChat();
});

function sendFile(formObj) {
    var form = new FormData(formObj);
    form.append('file', $('#trigger-upload-window')[0].files[0]);
    form.append('id_empresa', $("#hidden-form-id-empresa").val());

    $.ajax({
        url: "restricted/model/file-manage/",
        type: 'POST',
        data: form,
        contentType: false,
        cache: false,
        processData: false,
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        },
        success: function (data, textStatus, jqXHR) {

            var info = JSON.parse(data);

            if (info.response === 'wrong file type') {
                sendMsg('Ese tipo de archivo no se permite.');
            } else {
                $("#messaging-form input[type='text']").val("MENSAJE AUTOMÁTICO, el archivo " + info.saved_file_name + " se ha adjuntado");
                $("#messaging-form").submit();
            }

        }
    });
}

function sendNewMessage(messageData, e) {

    $.ajax({
        url: 'restricted/model/scm/',
        type: 'POST',
        data: messageData,
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        },
        success: function (data, textStatus, jqXHR) {

            var response = JSON.parse(data);

            var txt = response.txt_sanitized;
            $("#chat-body #messaging-form input[type='text']").val("");

            // APPEND NEW MESSAGE TO .message-container
            var newMsg = "<div class='client-msg chat-msg'><p>" + txt + "</p><cite>" + response.date + "</cite></div>";
            $("#chat-body .messages-container").append(newMsg);
        }
    });

    e.preventDefault();
}

function abrirChat(nombre_empresa) {

    // set chat title
    $("#chat-body .panel-title").html("Plastinemor &leftrightarrow; " + nombre_empresa);
    $("#hidden-form-id-empresa").val(nombre_empresa);
    $("#messaging-form #msg_id_empresa").val(nombre_empresa);

    var ch2 = $("#chat-head").width() / 2;
    var margL = -285;
    var margT = "93%";

    if (is_touch_device()) {
        margL = -150 + ch2;
        margT = "100%";
    }

    if (isChatOpen) {   // CLOSE CHAT        
        $("#chat-body").animate({
            width: 0,
            height: 0,
            marginLeft: 0
        }, 500, "easeOutExpo", function () {
            isChatOpen = false;
            updateChatDragArea(false);
        });
    } else {
        $("#chat-body").animate({// OPEN CHAT
            width: 300,
            height: 400,
            marginLeft: margL,
            marginTop: margT
        }, 500, "easeOutExpo", function () {
            isChatOpen = true;
            updateChatDragArea(true);
            $("#chat-body #messaging-form input[type='text']").focus();
        });
    }

    $(".messages-container").empty();
    requestMessages(nombre_empresa);
    startListening(nombre_empresa);
}

function startListening(nom_emp) {
    listening = setInterval(function () {
        requestMessages(nom_emp);
    }, 1000);
}

function requestMessages(id_empresa) {

    id_emp = id_empresa;

    $.ajax({
        url: "restricted/model/lm/",
        data: "id_empresa=" + id_empresa,
        type: 'POST',
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        },
        success: function (data, textStatus, jqXHR) {

            // append HTML to .messages-conainer
            $("#chat-body .messages-container").empty();
            $("#chat-body .messages-container").append(data);
        }
    });
}

function gatherClientInfo(informacion, e) {

    $.post({
        url: "restricted/model/gci/",
        data: informacion,
        error: function (jqXHR, textStatus, errorThrown) {
            sendMsg("Hubo un error, intente más tarde");
        },
        success: function (data, textStatus, jqXHR) {
            var respuesta = JSON.parse(data);
            if (respuesta.response === "no info") {
                sendMsg(respuesta.validation);
            } else if (respuesta.response === "success") {
                $("#close-modal-gather-info").click();

                var client = respuesta.client[0];
                abrirChat(client);

            }
        }
    });
    e.preventDefault();

}

function init_new_chat() {
    $.ajax({
        url: "restricted/model/chat-init/",
        type: 'POST',
        error: function (jqXHR, textStatus, errorThrown) {            
            sendMsg("algo pasó, intente refrescar la página si persiste el problema.");
            setTimeout(function () {
                $("#plasti-title").click();
            }, 1500);
        },
        success: function (data, textStatus, jqXHR) {
            var info = JSON.parse(data);

            if (info.response === "new") {
                $("#btn-gather-client-info").click();
            } else if (info.response === "old") {

                var client = info.client[0];

                abrirChat(client.id_empresa);

            }
        }
    });
}

function updateChatDragArea(isOpen) {

    var ww = $(window).width() - 120;
    var wh = $("body").height() - 465;

    if (isOpen) {
        ww = $(window).width() - 120;
        wh = $("body").height() - 465;
    } else {
        ww = $(window).width() - 60;
        wh = $("body").height() - 60;
    }

    $("#chat-head").draggable({
        containment: [0, 0, ww, wh],
        scroll: false,
        cancel: "#chat-body"
    });
}

function setChat() {

    $("#chat-head").draggable({
        containment: "window",
        scroll: false,
        cancel: "#chat-body"
    });
}

function bringChat(obj) {

    var ww = $(window).width();
    var chw = $("#chat-head").width();
    var margL = ((ww / 2) - (chw / 2));
    var margT = $(obj).offset().top + $(obj).height();

    $("#chat-head").animate({
        left: margL,
        top: margT
    }, 500, 'easeOutCirc');

    init_new_chat();
}



function sendMsg(msg) {
    $("#msg p").text(msg);
    $("#msg").fadeIn(300);
    $("#msg").fadeOut(300);
    $("#msg").fadeIn(300);
    $("#msg").fadeOut(300);
    $("#msg").fadeIn(300);

    setTimeout(function () {
        $("#msg").fadeOut();
    }, 10000);

    $("#msg .close").click(function () {
        $("#msg").fadeOut();
    });
}

function is_touch_device() {
    return 'ontouchstart' in window        // works on most browsers 
            || navigator.maxTouchPoints;       // works on IE10/11 and Surface
}
;