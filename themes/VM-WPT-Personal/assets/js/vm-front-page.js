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


/*
    Init
 */

$('body').scrollspy({target: '#tier-nav'});
$(document).ready(function () {
    var $tnToggle = $('#tier-nav-toggle'), $tnDiv = $('#tier-nav');
    var $tnLinks = $tnDiv.find('.nav-link');
    $('#tier-1 .post-roll').overlayScrollbars({
        className: "os-theme-round-dark",
        scrollbars: {autoHide: "move"},
    });
    $tnLinks.filter('.active').parent().addClass('active');
    $tnLinks.on('click', function () {
        $tnDiv.menuToggle('c');
        tnToggleUnHighlightTimer = setTnToggleUnHighlightTimer();
        return true;
    });
    $tnToggle.on('click', function () {
        clearTimeout(tnToggleUnHighlightTimer);
    });
});


/*
    Scroll effects
 */

$(window).on('activate.bs.scrollspy', function () {
    var $tnLinks = $('#tier-nav').find('.nav-link');
    $tnLinks.removeClass('disabled').parent().removeClass('active');
    $tnLinks.filter('.active').addClass('disabled').parent().addClass('active');
});
$(window).on('scroll', function (e) {

    var $tnToggle = $('#tier-nav-toggle'), $tnDiv = $('#tier-nav');

    if (992 > e.currentTarget.innerWidth) {
        if ($tnToggle.hasClass('highlighted')) {
            clearTimeout(tnToggleUnHighlightTimer);
        } else {
            $tnToggle.addClass('highlighted');
        }
        tnToggleUnHighlightTimer = setTnToggleUnHighlightTimer();
    } else {
        if (e.currentTarget.innerHeight < e.currentTarget.scrollY)
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

var xDown, yDown, xUp, yUp;
$(window).on('mousedown touchstart', function (e) {

    if ('undefined' === typeof e.originalEvent.touches) {
        return true;
    }

    // console.log('startX', e.originalEvent.touches[0].pageX);
    xDown = e.originalEvent.touches[0].pageX;
    // console.log('startY', e.originalEvent.touches[0].pageY);
    yDown = e.originalEvent.touches[0].pageY;

}).on('mouseup touchend', function (e) {

    if ('undefined' === typeof e.originalEvent.changedTouches) {
        return true;
    }

    // console.log('endX', e.originalEvent.changedTouches[0].pageX);
    xUp = e.originalEvent.changedTouches[0].pageX;

    // console.log('endY', e.originalEvent.changedTouches[0].pageY);
    yUp = e.originalEvent.changedTouches[0].pageY;

    // Swipe up/down threshold
    if ((30 < Math.max(yUp - yDown, yDown - yUp))) {
        return true;
    }

    var $tnToggle = $('#tier-nav-toggle'), $tnDiv = $('#tier-nav');

    if (((e.currentTarget.innerWidth / 4) < (xDown - xUp))) {

        // console.log('swipe left!');
        if ($tnDiv.hasClass('open')) {
            return true;
        }

        $tnDiv.menuToggle('o');
        clearTimeout(tnToggleUnHighlightTimer);

        return false;

    } else if (((e.currentTarget.innerWidth / 4) < (xUp - xDown))) {

        // console.log('swipe right!');
        if (!$tnDiv.hasClass('open')) {
            return true;
        }

        $tnDiv.menuToggle('c');
        clearTimeout(tnToggleUnHighlightTimer);

        return false;

    }

    return true;

});