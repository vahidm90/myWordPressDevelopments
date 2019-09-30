$('.letter:not(.last)').on('animationend', function () {
    $(this).next().addClass('animated zoomIn')
});
$('.letter.last').on('animationend', function () {
    setTimeout(function () {
        $('#splash h1').animate({top:'8px', marginLeft: '16px', fontSize:'20px'}, 1000);
        $('#splash').fadeOut(2000);
    }, 1000);
});
$(document).ready(function () {
    $('#splash').css({display:'block'});
    $('.letter:first-child').addClass('animated zoomIn')
});
var bodyScrYpos = 0;
$('.cat-ball').click(function () {
    bodyScrYpos = window.pageYOffset || document.documentElement.scrollTop;
    var $target = $($(this).data('cat'));
    if ($target.length) {
        $target.css('marginTop',  '-100vh').removeClass('d-none');
        $('body').animate({marginTop:'100vh'}, 1000);
        $target.animate({marginTop:0}, 1000);
    }
});
$('.cat-content-back-btn').click(function (e) {
    e.preventDefault();
    document.documentElement.scrollTop = document.body.scrollTop = bodyScrYpos;
    var $target = $($(this).data('cat'));
    if ($target.length) {
        $('body').animate({marginTop: 0}, 1000);
        $target.animate({marginTop:'-100vh'}, 1000, function () {
            $(this).addClass('d-none');
        });
    }
});
