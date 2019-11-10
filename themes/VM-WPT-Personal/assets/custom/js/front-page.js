$('.letter:not(:last-child)').on('animationend', function () {
    $(this).next().addClass('animated zoomIn')
});
$('.letter:last-child').on('animationend', function () {
    setTimeout(function () {
        $('#splash').fadeOut(1000);
        $('body').css('overflow', 'auto');
    }, 500);
});
$(document).ready(function () {
    $('.letter:first-child').addClass('animated zoomIn');
});
$('.vmPS').vmPerfectSlider();
