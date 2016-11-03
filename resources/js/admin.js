;
$(function () {

    // send credentials for validation
    $("#form-credentials").submit(function (e) {
        sendCredentials($(this).serialize(), e);
    });
    
    $(document).ajaxStart(function(){
        $("#loader").animate({opacity: 1},400);
    }).ajaxComplete(function(){
        setTimeout(function(){
            $("#loader").animate({opacity: 0},400);
        },800);
    });    
});// ./ doc.ready


function sendCredentials(info, e) {

    $.ajax({
        url: 'restricted/model/credm/',
        type: 'POST',
        data: info,
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
        },
        success: function (data, textStatus, jqXHR) {
                                    
            var info = JSON.parse(data);
            
            console.log(info);
            
            if(info.response === 'fail'){
                sendMsg("Usuario/Contraseña incorrectos");
            }else if(info.response === 'ok'){
                window.location.href = "capuchones-para-flores/plastinemor/plasti/";
            }else{
                sendMsg("Intente de nuevo.");
            }
        }        
    });

    e.preventDefault();
}


function sendMsg(msg) {
    $("#msg p").text(msg);
    $("#msg").fadeIn(100);
    $("#msg").fadeOut(100);
    $("#msg").fadeIn(100);

    setTimeout(function () {
        $("#msg").fadeOut();
    }, 10000);

    $("#msg .close").click(function () {
        $("#msg").fadeOut();
    });
}