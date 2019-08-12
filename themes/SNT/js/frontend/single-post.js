(function ($) {
    $('#scroll-cm').on('click', function () {
        $('html').animate({ scrollTop: $('#comments').offset().top }, 600);
        $(this).css('display', 'none')
    });
})(jQuery);
jQuery(document).ready(function ($) {
    var $cont = $('#content-post'), $aside = $('main aside'), $win = $(window), scCm = $('#scroll-cm');
    $aside.on('aside:adjust', function () {
        var height = $aside.height(), $main = $('main');
        if (1024 > window.innerWidth || $main.height() < height) {
            if ('static' === $aside.css('position')) { return }
            $aside.css({ position: 'static', top: 'initial' });
            return
        }
        if ($cont.height() < height ) {
            $aside.css({ position: 'relative', top: ($('time', $main).offset().top - $main.offset().top) + 'px' });
            return
        }
        $aside.css({ position: 'relative', top: ($cont.offset().top - $main.offset().top) + 'px' })
    });
    $('a', $cont).each(function () {
        if ($(this).attr('rel') && 'external' === $(this).attr('rel')) {
            $(this).append('<span class="snt-icon snt-external-link"></span>')
        }
    });
    $aside.trigger('aside:adjust');
    $(window).resize(function () { $aside.trigger('aside:adjust'); });
    $('img', $cont).addClass('img-resp').css({height: '', width: ''});
    $('figure', $cont).each(function () {
        var html = $('figcaption', $(this)).html().trim();
        $(this).wrap('<a href="' + $('img', $(this)).attr('src') + '"></a>').css('width', '');
        if (html) { $('figcaption', $(this)).html('<p>' + html + '</p>') }
    });
    $win.on('scroll:up', function () {
        if ('none' === scCm.css('display')) { return false }
        scCm.css('display', 'none')
    });
    $win.on('scroll:down', function (e, s) {
        if ($('#comments').offset().top / parseFloat($('body').css('font-size')) - 40 < s){
            scCm.css('display', 'none');
            return false
        }
        scCm.css('display', 'block')
    })
});