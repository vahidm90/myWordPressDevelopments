$('.category .tab a', '#welcome').click(function (e) {
    e.stopPropagation();
    e.preventDefault();
    var $clkCat = $(this).parents('.category');
    if ($clkCat.hasClass('open')) {
        $clkCat.animate({width: 0}, 500).removeClass('open');
        return;
    }
    $('.category').not($clkCat).animate({width: 0}, 500).removeClass('open');
    $clkCat.animate({width: "90%"}, 500).addClass('open');
});
$('.category', '#welcome').click(function (e) {
    e.stopPropagation();
});
$('#welcome').click(function () {
    $('.category', $(this)).animate({width: 0}, 500).removeClass('open');
});
$(function () {
});