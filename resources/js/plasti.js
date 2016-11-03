;
var new_msg_mp3 = new Audio('resources/mp3/mensaje-nuevo.mp3');
$(function () {

    // set time
    requestTime();
    // update time every minute
    setInterval(function () {
        requestTime();
    }, 60000);

    // perform logout
    $(".logout").click(function (e) {
        e.preventDefault();
        requestLogout();
    });

    // close chat window
    $("#admin-conversations-container").delegate('.admin-chat-window .close', 'click', function () {
        var w2r = $(this).closest(".admin-chat-window");
        removeChatWindow(w2r);
    });

    // render chat window
    $("#admin-conversation-list-container").on('click', '.admin-chat-list-item', function () {
        var id_empresa = $(this).find('.list-group-item-heading').text();
        renderChatWindow(id_empresa);
        $(this).children('.tag').text('0');
    });

    // send message from any chat window
    $("#admin-conversations-container").on('submit', '.admin-chat-messages-form', function (e) {
        sendNewMessage($(this).serialize(), e, $(this));
    });

    var ismousedown = false;
    $("#admin-chat-container").on('mousedown', '.admin-chat-window-messages-container', function () {
        ismousedown = true;
    }).on('mouseup', '.admin-chat-window-messages-container', function () {
        ismousedown = false;
    });

    // AUTO SCROLL .messages-container when new messages are appended
    $("#admin-conversations-container").on('DOMNodeInserted', '.admin-chat-window-messages-container', function () {
        if (ismousedown === false) {
            $(this).animate({
                scrollTop: $(this)[0].scrollHeight
            }, 0);
        }
    });

    // load all conversations and listen for new ones
    requestConversaciones();
    setInterval(function () {
        requestConversaciones();
    }, 3500);

    setInterval(function () {
        seekMessages();
    }, 3500);

    requestArchivosAdjuntos();
    setInterval(function () {
        requestArchivosAdjuntos();
    }, 10000);

    // set the title of #send-email-modal to its proper email to be sent 
    // Note:  this doesn't have an effect on the form submition
    $("#list_empresas").on('change', function () {
        $("#email-title").text($(this).val());
    });

    // send email from modal box: #send-email-modal
    $('#form-send-email').on('submit', function (e) {
        sendEmail($(this).serialize(), e);
    });

});
// ============================= ./  DOCUMENT.READY

function sendEmail(serializedData, e) {

    $.ajax({
        url: "restricted/model/send-mail/",
        type: 'POST',
        data: serializedData,
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        },
        success: function (data, textStatus, jqXHR) {
            var response = JSON.parse(data);
            sendMsg(response.response);
        }
    });

    $("#form-send-email").each(function () {
        this.reset();
    });
    $("#email-title").text("");
    $("#send-email-modal").modal('toggle');

    e.preventDefault();
}

function requestArchivosAdjuntos() {

    $.ajax({
        url: "restricted/model/la/",
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        },
        success: function (data, textStatus, jqXHR) {

            $("#archivos-adjuntos-tbody").empty();
            $("#archivos-adjuntos-tbody").append(data);
        }
    });
}

function requestConversaciones() {
    $.ajax({
        url: "restricted/model/lali/",
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        },
        success: function (data, textStatus, jqXHR) {

            var lali_response = JSON.parse(data);

            var curr_elem_size = $("#admin-conversation-list-container .list-group").length;

            // append new conversations only if they have changed
            if (lali_response.li_count !== curr_elem_size) {
                $("#admin-conversation-list-container").empty();
                $("#admin-conversation-list-container").append(lali_response.li_dom);
            }
            seekMessages();

            var map_empresa_email = lali_response.map_empresa_email;

            // append new email options only if there are more
            if ($("#list_empresas option").length === 1) {

                setEmailOptions(map_empresa_email);
            }
        }
    });
}

function setEmailOptions(map_empresa_email) {

    // empty first
    $('#list_empresas').empty();

    var default_option = '<option value="">Elija una empresa...</option>';
    $('#list_empresas').append(default_option);
    // append conversations to #send-email-modal in select menu.
    for (var j = 0; j < map_empresa_email.length; j++) {

        var option = '<option value="' + map_empresa_email[j][1] + '">' + map_empresa_email[j][0] + '</option>';
        $('#list_empresas').append(option);
    }

}

function sendNewMessage(messageData, e, obj) {

    $.ajax({
        url: 'restricted/model/spm/',
        type: 'POST',
        data: messageData,
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        },
        success: function (data, textStatus, jqXHR) {

            // set DOM object of INPUT 
            var txt_input_obj = $(obj).find('input[type="text"]');
            var id_emp = $(obj).find('input[type="hidden"]').val();

            // get input content
            var txt_content = $(txt_input_obj).val();

            // reset input DOM value
            $(txt_input_obj).val("");

            // APPEND NEW MESSAGE TO .message-container
            var newMsg = "<div class='plasti-msg chat-msg'><p>" + txt_content + "</p><cite>" + data + "</cite></div>";
            $(".admin-chat-window:contains('" + id_emp + "')").find('.admin-chat-window-messages-container').append(newMsg);

        }
    });

    e.preventDefault();

}


function removeChatWindow(obj) {
    $(obj).remove();
}

function requestLogout() {

    $.ajax({
        url: "restricted/util/log-out/",
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        },
        success: function (data, textStatus, jqXHR) {
            location.reload();
        }
    });
}

function requestTime() {
    $.ajax({
        url: "restricted/util/get-time/",
        success: function (data, textStatus, jqXHR) {
            $("#admin-menu .time").text(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        }
    });
}


function renderChatWindow(id_empresa) {

    $.ajax({
        url: "restricted/model/admin-chat-window/",
        type: 'POST',
        data: 'id_empresa=' + id_empresa,
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        },
        success: function (data, textStatus, jqXHR) {

            // add chat window if it does not exist
            if ($(".admin-chat-window:contains('" + id_empresa + "')").length === 0) {
                $("#admin-conversations-container").append(data);
                requestMessages(id_empresa);

                startListening(id_empresa);
            }
        }
    });
}

function startListening(id_empresa) {
    setInterval(function () {
        requestMessages(id_empresa);
    }, 1000);
}

function requestMessages(id_empresa) {

    $.ajax({
        url: "restricted/model/lm/",
        data: "id_empresa=" + id_empresa,
        type: 'POST',
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        },
        success: function (data, textStatus, jqXHR) {

            // append HTML to .messages-conainer IF is does not exist
            $(".admin-chat-window:contains('" + id_empresa + "')").find('.admin-chat-window-messages-container').empty();
            $(".admin-chat-window:contains('" + id_empresa + "')").find('.admin-chat-window-messages-container')
                    .append(data);

            var msg_len = $(".admin-chat-window:contains('" + id_empresa + "')")
                    .find('.admin-chat-window-messages-container .chat-msg')
                    .length;

        }
    });
}

function seekMessages() {

    $.ajax({
        url: "restricted/model/cnm/",
        type: 'POST',
        error: function (jqXHR, textStatus, errorThrown) {
            $("#plasti-title").click();
        },
        success: function (data, textStatus, jqXHR) {

            var info = JSON.parse(data);

            for (var i = 0; i < info.length; i++) {

                var empObj = info[i];

                // if chat window is not open, update .tag
                if ($(".admin-chat-window:contains('" + empObj.id_empresa + "')").length === 0) {

                    var emp_tag = $(".admin-chat-list-item .list-group-item-heading:contains('" + empObj.id_empresa + "')").siblings('.tag');

                    var num_msgs = $(emp_tag).attr('data-init-msg');

                    var diff = (empObj.num_mensajes - num_msgs);


                    $(emp_tag).attr('data-init-msg', Math.max(empObj.num_mensajes, num_msgs));



                    diff = (diff < 0) ? 0 : diff;

                    if (diff !== 0 && num_msgs !== 0) {
                        new_msg_mp3.play();
                        $(emp_tag).text(diff);
                        $(emp_tag).addClass('tag-red');
                    }
                }
            }
        }
    });
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