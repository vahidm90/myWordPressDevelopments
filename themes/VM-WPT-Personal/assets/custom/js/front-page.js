$('.category', '#welcome' ).each(function (i) {
    $(this).delay(3000*i).fadeIn(500).animate({width:"5px"}, 500);
});
$('.category .tab a', '#welcome').click(function (e) {
    e.stopPropagation();
    e.preventDefault();
    var $clkCat = $(this).parents('.category');
    if ($clkCat.hasClass('open')) {
        $clkCat.animate({width:"5px"},500).removeClass('open');
        return;
    }
    $('.category').not($clkCat).animate({width:"5px"}, 500).removeClass('open');
    $clkCat.animate({width:"90%"}, 500).addClass('open');
});
$('#welcome').click(function () {
    $('.category', $(this)).animate({width:"5px"}, 500).removeClass('open');
});
$(function () {
});