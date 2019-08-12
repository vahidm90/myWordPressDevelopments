(function ($) {
    $.fn.sntUnCheckBox = function () {
        return this.each( function () {
            $(this).addClass('snt-checkbox-unchecked').removeClass('snt-checkbox-checked')
        })
    };
    $.fn.sntCheckBox = function () {
        return this.each( function () {
            $(this).addClass('snt-checkbox-checked').removeClass('snt-checkbox-unchecked')
        })
    }
})(jQuery);
jQuery(document).ready(function ($) {
    if (1024 > window.innerWidth) { return }
    $('.chk-btn', $('#regs')).click(function () {
        if ($(this).hasClass('active')) { return }
        var $con = $('#reg-' + $(this).data('reg'));
        $con.find('.holder').each(function () {
            $(this).removeClass('active').children('.chk-btn').removeClass('active').children('span').sntUnCheckBox()}
        );
        $(this).children('span').sntCheckBox();
        var $clkTtl = $(this).parents('.holder');
        var $img = $('.img-bg', $con), exc = "<p class='exc-post'>" + $clkTtl.data('exc') + "</p>";
        $clkTtl.addClass('active');
        $img.css('background-image', 'url(' + $clkTtl.data('img') + ')').empty().append(exc);
        $('.lnk-img-bg', $con).attr('href', $clkTtl.data('lnk'))
    })
});