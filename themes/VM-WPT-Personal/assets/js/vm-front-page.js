

/*
    Variables
 */

var tnToggleUnHighlightTimer;


/*
    Functions
 */

/**
 * Sets timeout to remove tier navigation toggle 'highlighted' class.
 *
 * @param wait The amount of time in milliseconds to wait before removing the class
 *
 * @returns {number}    Timeout ID, can be used later to cancel the timeout
 *
 */
function setTnToggleUnHighlightTimer(wait) {

    wait = (('number' !== typeof wait) || (0 > wait)) ? 5000 : wait;

    return setTimeout(function () {
        $('#tier-nav-toggle').removeClass('highlighted');
    }, wait);

}


/**
 * Resets timeout to remove tier navigation toggle 'highlighted' class.
 *
 * @param manual Whether to wait for user action to remove the class
 *
 */
function resetTnToggleUnHighlightTimer(manual) {

    manual = ('boolean' !== typeof manual) ? false : manual;
    var $tnToggle = $('#tier-nav-toggle');

    clearTimeout(tnToggleUnHighlightTimer);

    if (!$tnToggle.hasClass('highlighted'))
        $tnToggle.addClass('highlighted');

    if (!manual)
        tnToggleUnHighlightTimer = setTnToggleUnHighlightTimer();

}


/*
    Init
 */

// Initiate bootstrap scroll spy
$('body').scrollspy({target: '#tier-nav'});

$(document).ready(function () {


    // variables

    var $tnToggle = $('#tier-nav-toggle'), $tnDiv = $('#tier-nav');
    var $tnLinks = $tnDiv.find('a');


    // overlay scrollbars

    $('.tier').find('.content-roll').overlayScrollbars({
        className: "os-theme-round-dark",
        scrollbars: {autoHide: "move"},
    });

    // initiate tier navigation

    $tnLinks.filter('.active').parent().addClass('active');


    // initiate menu toggle plugin

    $.fn.vmMenuToggle.defaults.beforeOpen = function () {
        $tnToggle.animate({right: $tnDiv.width()}, 300);
        resetTnToggleUnHighlightTimer(true);
    };
    $.fn.vmMenuToggle.defaults.beforeClose = function() {
        $tnToggle.animate({right: 0}, 300);
        resetTnToggleUnHighlightTimer();
    }


    // bind tier navigation events

    $tnLinks.on('click', function () {
        $tnDiv.vmMenuToggle('c');
        return true;
    });

    $tnToggle.on('click', function () {

        if ($(this).hasClass('open'))
            $tnDiv.vmMenuToggle('c');
        else
            $tnDiv.vmMenuToggle('o');

        return false;

    });

});


/*
    Scroll effects
 */

// Update tier navigation upon page scroll
$(window).on('activate.bs.scrollspy', function () {
    var $tnLinks = $('#tier-nav').find('.nav-link');
    $tnLinks.removeClass('disabled').parent().removeClass('active');
    $tnLinks.filter('.active').addClass('disabled').parent().addClass('active');
});

// Highlight tier navigation toggle on small screens, make it sticky on large ones
$(window).on('scroll', function () {

    if (992 > window.innerWidth) {

        resetTnToggleUnHighlightTimer();

    } else {

        var $tnDiv = $('#tier-nav');

        if (window.innerHeight < window.scrollY)
            $tnDiv.addClass('fixed');
        else
            $tnDiv.removeClass('fixed');

    }

    return true;

})
;


/*
    Swipe effects
 */

// Swipe start point coordinates need to be set globally
var xDown, yDown;

$(window).on('mousedown touchstart', function (e) {

    if (('undefined' === typeof e.originalEvent.touches) || (991 < window.innerWidth)) {
        return true;
    }

    // console.log('startX', e.originalEvent.touches[0].pageX);
    xDown = e.originalEvent.touches[0].pageX;
    // console.log('startY', e.originalEvent.touches[0].pageY);
    yDown = e.originalEvent.touches[0].pageY;

}).on('mouseup touchend', function (e) {

    if (('undefined' === typeof e.originalEvent.changedTouches) || (991 < window.innerWidth)) {
        return true;
    }

    // console.log('endX', e.originalEvent.changedTouches[0].pageX);
    // console.log('endY', e.originalEvent.changedTouches[0].pageY);

    // Swipe up/down threshold
    if (30 < Math.max(e.originalEvent.changedTouches[0].pageY - yDown, yDown - e.originalEvent.changedTouches[0].pageY)) {
        return true;
    }

    var $tnDiv = $('#tier-nav');

    // Swipe left/right threshold
    if (10 < (xDown - e.originalEvent.changedTouches[0].pageX)) {

        // console.log('swipe left!');

        if ($tnDiv.hasClass('open'))
            return true;

        $tnDiv.vmMenuToggle('o');

        return false;

    } else if (10 < (e.originalEvent.changedTouches[0].pageX - xDown)) {

        // console.log('swipe right!');

        if (!$tnDiv.hasClass('open')) {
            resetTnToggleUnHighlightTimer();
            return true;
        }

        $tnDiv.vmMenuToggle('c');

        return false;

    }

    return true;

});