jQuery(window).on('scroll', function (e) {
    var $topBar = $('#fp-top-bar');
    if (0 < e.currentTarget.scrollY)
        $topBar.addClass('fixed-top');
    else
        $topBar.removeClass('fixed-top');
});
