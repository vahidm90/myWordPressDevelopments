

/*
    Swipe effects
 */

// Swipe start point coordinates need to be set globally
var xDown, yDown;

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
    // console.log('endY', e.originalEvent.changedTouches[0].pageY);

    // Swipe up/down threshold
    if (30 < Math.max(e.originalEvent.changedTouches[0].pageY - yDown, yDown - e.originalEvent.changedTouches[0].pageY)) {
        return true;
    }

    // Swipe left/right threshold
    if (10 < (xDown - e.originalEvent.changedTouches[0].pageX)) {

        // console.log('swipe left!');

        return false;

    } else if (10 < (e.originalEvent.changedTouches[0].pageX - xDown)) {

        // console.log('swipe right!');

        return false;

    }

    return true;

});