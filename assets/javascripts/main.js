var canvas, stage, exportRoot;

function init_animation() {
    canvas = document.getElementById("canvas");
    images = images || {};

    var manifest = [
		{ src: "/assets/_01.png", id: "_01" },
        { src: "/assets/_02.png", id: "_02" },
        { src: "/assets/_03.png", id: "_03" },
        { src: "/assets/_05.png", id: "_05" },
        { src: "/assets/_06.png", id: "_06" }
    ];

    var loader = new createjs.LoadQueue(false);
    loader.addEventListener("fileload", handleFileLoad);
    loader.addEventListener("complete", handleComplete);
    loader.loadManifest(manifest);
}

function handleFileLoad(evt) {
    if (evt.item.type == "image") { images[evt.item.id] = evt.result; }
}

function handleComplete() {
    exportRoot = new lib.Index();

    stage = new createjs.Stage(canvas);
    stage.addChild(exportRoot);
    stage.update();

    createjs.Ticker.setFPS(24);
    createjs.Ticker.addEventListener("tick", stage);
}

function isEmail(email) {
    // pass regex for validating an e-mail address
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function completeInviteForm() {
    setTimeout(function () {
        $("#completeform").fadeOut(400, function () {
            $(this).before('<span class="msg">All set! We will be in touch.</span>');
            
        });
    }, 1100);
}



var erdiv = $("#error-msg");
var btnwrap = $("#btnwrap");


$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('.scrollup').fadeIn();
    } else {
        $('.scrollup').fadeOut();
    }
});

function scrollToDiv(element, navheight) {
    var offset = element.offset();
    var offsetTop = offset.top;
    var totalScroll = offsetTop - navheight;

    $('body,html').animate({
        scrollTop: totalScroll
    }, 500);
}
;
