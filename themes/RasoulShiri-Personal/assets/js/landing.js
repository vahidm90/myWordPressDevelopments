jQuery(function ($) {
    $('a[href*="#"]:not([href="#"]):not([href^="#tab"]):not([href^="#collapse"])').click(function ()
    {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') || location.hostname === this.hostname) {
            let target = $(this.hash);
            if (target.length) {
                if ('top-bar-items' === $(this).parent().attr('id'))
                    $(this).parent().removeClass('show');
                $('html,body').animate({scrollTop: (target.offset().top)}, 300, 'swing');
            }
        }
    });
});