$('a[href*="#"]:not([href="#"]):not([href^="#tab"]):not([href^="#collapse"])').click(function ()
{
    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') || location.hostname === this.hostname) {
        var target = $(this.hash);
        if (target.length) {
            $('html,body').animate({scrollTop: (target.offset().top)}, 300, 'swing');
        }
    }
});
