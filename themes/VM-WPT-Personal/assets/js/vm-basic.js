

/*
    Plugins
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
    return this.each(function () {

        var $toggle = $($(this).attr('data-ctrl-toggle')), $fadeDiv = $($(this).attr('data-ctrl-fade')), $that = $(this);

        switch (action) {
            case 'o' :
                $(this).addClass('open');
                $toggle.animate({right: $(this).width()}, 300).addClass('highlighted open');
                $fadeDiv.animate({opacity: .1}, 300).on('click', function () {
                    $that.menuToggle('c');
                    return false;
                });
                break;
            case 'c' :
                $(this).removeClass('open');
                $toggle.animate({right: 0}, 300).removeClass('highlighted open');
                $fadeDiv.animate({opacity: 1}, 300).off('click');
                break;
        }

    });
};


/*
    Initials
 */

$(document).ready(function () {
    $('.menu-toggle').on('click ', function () {
        if ($(this).hasClass('open')) {
            $($(this).attr('data-ctrl-menu')).menuToggle('c');
        } else {
            $($(this).attr('data-ctrl-menu')).menuToggle('o');
        }
    });
});