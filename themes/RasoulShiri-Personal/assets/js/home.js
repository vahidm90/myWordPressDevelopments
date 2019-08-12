jQuery('document').ready(function () {
    var $navItems = $('#dynamic-nav .nav-link');
    $navItems.each(function () {
        var myTooltip = new Tooltip($(this), {
            placement: "left",
            delay: {show: 0, hide: 100},
            title: $(this).attr('title'),
            trigger: 'hover focus click',
            template: '<div class="vmp-tooltip nav-tooltip"><div class="tooltip-arrow"></div><div class="tooltip-txt"></div></div>',
            innerSelector: '.tooltip-txt'
        });
    });
});
jQuery(window).on('scroll', function (e) {
    var $topBar = $('#static-top-bar');
    if (e.currentTarget.innerHeight < e.currentTarget.scrollY)
        $topBar.addClass('fixed-top');
    else
        $topBar.removeClass('fixed-top');
});
