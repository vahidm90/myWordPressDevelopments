$('.category', '#welcome').each(function (i) {
    $(this).delay(2000 * i).fadeIn(500).animate({width: "5px"}, 500).css("overflow", "visible");
});
$('.category .tab a', '#welcome').click(function (e) {
    e.stopPropagation();
    e.preventDefault();
    var $clkCat = $(this).parents('.category');
    if ($clkCat.hasClass('open')) {
        $clkCat.animate({width: "5px"}, 500).css("overflow", "visible").removeClass('open');
        return;
    }
    $('.category').not($clkCat).animate({width: "5px"}, 500).css("overflow", "visible").removeClass('open');
    $clkCat.animate({width: "90%"}, 500).css("overflow", "visible").addClass('open');
});
$('#welcome').click(function () {
    $('.category', $(this)).animate({width: "5px"}, 500).css("overflow", "visible").removeClass('open');
});
$(function () {
});