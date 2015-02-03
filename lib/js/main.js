$(document).ready(function () {
    new WOW().init();
    $(".pulseanimation").hover(function () {
        $(this).addClass("animated pulse");
    }, function () {
        $(this).removeClass("animated pulse");
    });

    $(".tadaanimation").hover(function () {
        $(this).addClass("animated tada");
    }, function () {
        $(this).removeClass("animated tada");
    });
    var imgbackheight=window.innerHeight;
    $(".imgback").height(imgbackheight);
});