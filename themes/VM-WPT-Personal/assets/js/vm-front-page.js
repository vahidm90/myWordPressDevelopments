/*
    Variables
 */
// Store '.menu-toggle' fade timeout.
var menuTTimeOut;


/*
    Functions
 */


/**
 * Toggles menu open and closed.
 *
 * @param action A string ('s'/'o') determining the action to be carried out
 *
 * @returns {$}     The menu jQuery object
 *
 */
$.fn.menuToggle = function (action) {
    var $menuT = $('.menu-toggle');
    switch (action) {
        default :
            return;
            break;
        case 'o' :
            this.addClass('open');
            $menuT.animate({right: this.width()}, 300).addClass('highlighted open');
            clearTimeout(menuTTimeOut);
            return this;
            break;
        case 'c' :
            this.removeClass('open');
            $menuT.animate({right: 0}, 300).removeClass('highlighted open');
            return this;
            break;
    }
};


/*
    Init
 */
$('body').scrollspy({target: '#fp-nav-items'});
$(document).ready(function () {
    $('#fp-tier-1 .post-roll').overlayScrollbars({
        className: "os-theme-round-dark",
        scrollbars: {autoHide: "move"},
    });
    $('.menu-toggle').on('click', function () {
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $('#fp-nav-items').menuToggle('c');
        } else {
            $(this).addClass('open');
            $('#fp-nav-items').menuToggle('o');
        }
    });
    $('#fp-nav-items .nav-link').on('click', function () {
        $('#fp-nav-items').menuToggle('c');
    })
});


/*
    Scroll effects
 */
$(window).on('activate.bs.scrollspy', function () {
    var $links = $('#fp-nav-items .nav-link');
    $links.removeClass('disabled').parent().removeClass('active');
    $links.filter('.active').addClass('disabled').parent().addClass('active');
});
$(window).on('scroll', function (e) {
    if (992 > e.currentTarget.innerWidth) {
        var $menuT = $('.menu-toggle');
        if ($menuT.hasClass('highlighted')) {
            return;
        }
        $menuT.addClass('highlighted', 100, function () {
            menuTTimeOut = setTimeout(function () {
                $menuT.removeClass('highlighted', 300);
            }, 10000);
        });
    } else {
        var $bar = $('#fp-nav-items');
        if (e.currentTarget.innerHeight < e.currentTarget.scrollY)
            $bar.addClass('fixed');
        else
            $bar.removeClass('fixed');
    }
});


/*
    Swipe events
 */
var xDown, yDown, xUp, yUp;
$(window).on('mousedown touchstart', function (e) {
    if ('undefined' === typeof e.originalEvent.touches) {
        return;
    }
    // console.log('startX', e.originalEvent.touches[0].pageX);
    xDown = e.originalEvent.touches[0].pageX;
    // console.log('startY', e.originalEvent.touches[0].pageY);
    yDown = e.originalEvent.touches[0].pageY;
}).on('mouseup touchend', function (e) {
    if ('undefined' === typeof e.originalEvent.changedTouches) {
        return;
    }
    // console.log('endX', e.originalEvent.changedTouches[0].pageX);
    xUp = e.originalEvent.changedTouches[0].pageX;
    // console.log('endY', e.originalEvent.changedTouches[0].pageY);
    yUp = e.originalEvent.changedTouches[0].pageY;
    if ((30 < Math.max(yUp - yDown, yDown - yUp))) {
        return;
    }
    var $menu = $('#fp-nav-items');
    if (((e.currentTarget.innerWidth / 4) < (xDown - xUp))) {
        // console.log('swipe left!');
        if ($menu.hasClass('open')) {
            return;
        }
        $menu.menuToggle('o');
    } else if (((e.currentTarget.innerWidth / 4) < (xUp - xDown))) {
        // console.log('swipe right!');
        if (!$menu.hasClass('open')) {
            return;
        }
        $menu.menuToggle('c');
    }
});