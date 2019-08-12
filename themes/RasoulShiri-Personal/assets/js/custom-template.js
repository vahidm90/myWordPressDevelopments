jQuery(window).on('scroll', function (e) {
    var $topBar = $('#static-top-bar');
    if ( parseInt($topBar.css('height'), 10) < e.currentTarget.scrollY)
        $topBar.addClass('fixed-top');
    else
        $topBar.removeClass('fixed-top');
});
