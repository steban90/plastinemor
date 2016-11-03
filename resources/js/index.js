$(function () {

    // Detect window scroll to animate content
    $(window).scroll(function () {

        // window height
        var wh = ($(window).height() / 2);

        // window's scroll position        
        var wtop = $(window).scrollTop() + wh;

        // #info's offset from the top 
        var inftop = $("#info").offset().top;

        // #envelope's offset from the top
        var envtop = $("#envelope").offset().top;

        if (wtop > inftop) {
            showInfo();
        }
        if (wtop > envtop) {
            showEnvelope();
        }
    });

});

function showInfo() {
    $("#info,#globe,#question").transition({marginLeft: 0, opacity: 1}, 800, 'easeOutSine');
}
function showEnvelope() {
    $("#envelope").transition({opacity: 1}, 2000, "ease");
}