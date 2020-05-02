

/*
    Plugins
 */



/**
 * Toggles menu open and closed.
 *
 * @param action A string determining the action to be carried out; accepts either 'o' (open) or 'c' (close); default: 'o'
 * @param options
 * @returns {$}     The menu jQuery object
 *
 */
$.fn.vmMenuToggle = function (action, options) {

    action = (('string' !== typeof action) || (0 > ['o', 'c'].indexOf(action))) ? 'o' : action;

    return this.each(function () {

        var settings = $.extend({}, $.fn.vmMenuToggle.defaults, options),
            $toggle = $($(this).attr('data-' + settings.toggleDataAttr)),
            $fadeElem = $($(this).attr('data-' + settings.fadingElementDataAttr)),
            $that = $(this);

        switch (action) {
            case 'o' :
                settings.beforeOpen();
                $(this).addClass('open');
                $toggle.addClass('open');
                $fadeElem.animate({opacity: .1}, 300).on('click', function () {
                    $that.vmMenuToggle('c');
                    return false;
                });
                settings.afterOpen();
                break;
            case 'c' :
                settings.beforeClose();
                $(this).removeClass('open');
                $toggle.removeClass('open');
                $fadeElem.animate({opacity: 1}, 300).off('click');
                settings.afterClose();
                break;
        }

    });
};


/*
    Plugin Defaults
 */

$.fn.vmMenuToggle.defaults = {
    toggleDataAttr: "ctrl-toggle",
    fadingElementDataAttr: "ctrl-fade",
    beforeOpen: function() {},
    afterOpen: function () {},
    beforeClose: function() {},
    afterClose: function () {},
};


/*
    Initials
 */

$(document).ready(function () {

    // Bind menu toggle events
    $('.menu-toggle').on('click ', function () {

        if ($(this).hasClass('open'))
            $($(this).attr('data-ctrl-menu')).vmMenuToggle('c');
        else
            $($(this).attr('data-ctrl-menu')).vmMenuToggle('o');

        return false;

    });
});


/*
    Scroll effects
 */

/* Initial scrollY needs to be set globally */
var scrollY0 = window.scrollY;

$(window).on('scroll', function () {
    if ( scrollY0 > window.scrollY )
        $(this).trigger('scrollUp.vm', { scrollY0: scrollY0, scrollY: window.scrollY });
    else
        $(this).trigger( 'scrollDown.vm', {scrollY0: scrollY0, scrollY: window.scrollY});
    scrollY0 = window.scrollY;
});

$(window).on('scrollDown.vm', function (e, data) {
    $('#top-bar').removeClass('fixed');
});

$(window).on('scrollUp.vm', function (e, data) {
    var $topBar = $('#top-bar');
    if( ($topBar.height() < data.scrollY) && (!$topBar.hasClass('fixed')) )
        $topBar.addClass('fixed')
})