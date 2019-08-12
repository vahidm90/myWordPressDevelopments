(function ($) {
    $('.no-prop').on('click', function (e) { e.stopPropagation() });
    $('.btn-rot').on('click', function (e) {
        e.stopPropagation();
        var $box = $(this).parents('.box-rot');
        var conId = !$box.data('pre') ? '' : '#' + $box.data('pre');
        if ( $box.data('grp') || 0 === $box.data('grp') ) { conId += (!conId) ? '' : $box.data('grp') }
        if (conId) { $('.box-rot', $(conId)).removeClass('active') }
        $box.addClass('active')

    });
    $('.box-rot').on('click', function () { if ( $(this).hasClass('active') ) { $(this).removeClass('active') } });
    $('#scroll-up').on('click', function () {
        var $html = $('html');
        $html.animate({ scrollTop: 0 }, 600);
        window.scrollTo(0, 0);
        $(this).css('display', 'none');
    });
    var $menuParents = $('.parent-li'), $sections = $('#menu-bar-top');
    $menuParents.on('click', function (e) {
        $(this).toggleClass('open');
        e.stopPropagation()
    });
    $menuParents.on('mouseleave', function () {
        if (!$(this).hasClass('open')) { return false }
        $(this).removeClass('open')
    });
    $('.open-menu', $sections).on('click', function () {
        $(this).toggleClass('clk');
        $('nav', $sections).toggleClass('open')
    });
    $sections.on('mouseleave', function () {
        var $btn = $('.open-menu', $(this));
        if (!$btn.hasClass('clk')) { return false }
        $btn.removeClass('clk');
        $('nav', $sections).removeClass('open')
    });
    var $item = $('.slide-open');
    $item.on('click', '.btn-so', function () { $(this).parents('.slide-open').toggleClass('active') });
    $item.on('mouseleave', function () {
        if (!$(this).hasClass('active')) { return false }
        $(this).removeClass('active')
    });
    var $navRib = $('#nav-ribbon');
    $navRib.on('click', 'button', function (e) {
        e.stopPropagation();
        $navRib.toggleClass('active');
        if ($navRib.hasClass('active')) { $('.in-search', $navRib).focus() } else { $('.in-search', $navRib).blur() }
    });
    $('.in-search', $navRib).click(function (e) { e.stopPropagation() });
    $('body').on('click', function () {
        $('.in-search', $navRib).blur();
        if ($navRib.hasClass('active')) { $navRib.removeClass('active') }
    })
})(jQuery);
jQuery(document).ready(function ($) {
    var $ribs = $('.ribbon-rolls'), $win = $(window), delMul = {hot: 0, lat: 0}, rollRun = {hot: 0, lat: 0};
    $ribs.each(function () { delMul[$(this).attr('id').replace('rib-roll-', '')] = parseInt($(this).data('delay')) });
    var delay = {hot: 900000, lat: 600000}, dir = SNTGeneric.dir,  $scUp = $('#scroll-up');
    var reCk = {hot: delay.hot, lat: delay.lat}, initCk = {hot: delay.hot * delMul.hot, lat: delay.lat * delMul.lat};
    var rollRoll = {hot: undefined, lat: undefined}, rollCk = {hot: undefined, lat: undefined};
    var lastTopEm = 0, lastEnd = {hot: undefined, lat: undefined};
    function SNTPauseRoll(roll) {
        if (!rollRun[roll]) { return }
        rollRun[roll] = 0;
        clearTimeout(rollRoll[roll])
    }
    function SNTEndRoll($roll, roll) {
        lastEnd[roll] = undefined;
        rollRun[roll] =  0;
        clearTimeout(rollRoll[roll]);
        $roll.css('display', 'none');
        SNTStartRoll($roll, roll)
    }
    function SNTPlayRoll($roll, roll) {
        if (!rollRun[roll]) { return }
        var rollLeft = $('.end-roll', $roll).offset().left;
        var end = ('left' === dir ? rollLeft : ( $win.width() - rollLeft));
        if (99 > end || lastEnd[roll] === end) { SNTEndRoll($roll, roll) }
        lastEnd[roll] = end;
        $roll.css('margin-' + dir, ( parseInt($roll.css('margin-' + dir), 10) - 1 ) + 'px');
        rollRoll[roll] = setTimeout(SNTPlayRoll, 9, $roll, roll)
    }
    function SNTStartRoll($roll, roll) {
        rollRun[roll] = 1;
        if ('none' === $roll.css('display')) {
            var rollCss = {display: 'inline-block'}, mar = 'margin' + ('left' === dir ? 'Left' : 'Right');
            rollCss[mar] = $win.width().toString() + 'px';
            $roll.css(rollCss)
        }
        rollRoll[roll] = setTimeout(SNTPlayRoll, 9, $roll, roll)
    }
    function SNTCreateRoll(items, roll) {
        if (1 > parseInt(Object.keys(items).length, 10) ) { return }
        var rpt = '&nbsp', i, j, item, $rib = $ribs.filter('#rib-roll-' + roll), margin;
        rpt = rpt.repeat(10);
        margin = 'margin-' + dir + ':' + $win.width() + 'px;';
        var delimit = '<span>' + rpt + SNTGeneric.siteLogo + rpt + '</span>';
        var html = '<div class="roll" id="roll-' + roll + '"><div class="ttl-roll"><h2>' + SNTGeneric[roll] + '</h2>';
        html += '</div><div style="' + margin + '" class="content-roll" data-roll="' + roll + '">';
        $.each(items, function (i, item) {
            html += delimit + '<a href="' + item.lnk + '"><span class="ttl-post">' + item.ttl + '</span></a>'
        });
        html += delimit + '<span class="end-roll"></span></div>';
        html += '<div class="pin-roll snt-icon-before snt-pushpin" data-roll="' + roll + '"></div></div>';
        $rib.append(html);
        SNTStartRoll($('.content-roll', $rib), roll)
    }
    function SNTDeleteRoll(roll) {
        var $myRoll = $('#roll-' + roll, $ribs);
        if(rollRun[roll] || !$myRoll.length){ return }
        clearTimeout(rollRoll[roll]);
        $myRoll.remove()
    }
    function SNTRollsAjax(roll) {
        $.ajax({
            url: SNTGeneric.url,
            data: {action: 'snt-get-roll', roll: roll},
            method: 'POST',
            dataType: 'json',
            error: function () {
                clearTimeout(rollCk[roll]);
                rollCk[roll] = setTimeout(SNTCheckRollPosts, reCk[roll], roll);
                if (rollRun[roll] || $('#roll-' + roll, $ribs).length) {
                    rollRun[roll] = 0;
                    SNTDeleteRoll(roll)
                }
            },
            success: function (posts) {
                SNTCreateRoll(posts, roll);
                clearTimeout(rollCk[roll]);
                rollCk[roll] = setTimeout(SNTCheckRollPosts, reCk[roll], roll)
            }
        })
    }
    function SNTCheckRollPosts(roll) {
        var $roll = $('#roll-' + roll);
        if (0 < $roll.length || rollRun[roll]) {
            clearTimeout(rollRoll[roll]);
            $roll.hide(300);
            $roll.remove();
            rollRun[roll] = 0
        }
        SNTRollsAjax(roll)
    }
    rollCk.hot = setTimeout(SNTCheckRollPosts, initCk.hot, 'hot');
    rollCk.lat = setTimeout(SNTCheckRollPosts, initCk.lat, 'lat');
    $ribs.on({
        mouseenter: function () { SNTPauseRoll($(this).data('roll')) },
        mouseleave: function () { SNTStartRoll($(this), $(this).data('roll')) }
        }, '.content-roll');
    $ribs.on('click', '.pin-roll', function () {
        var roll = $(this).data('roll'), $rib = $ribs.filter('#rib-roll-' + roll);
        $rib.toggleClass('pinned');
        if ('hot' !== roll) { return false }
        $rib.data('pin', (0 < parseInt($rib.data('pin')) ? '0' : '1'))
    });
    $win.scroll(function () {
        var topEm = $(this).scrollTop() / parseFloat($('body').css('font-size'));
        if (lastTopEm < topEm) { $(this).trigger('scroll:down', topEm) } else { $(this).trigger('scroll:up', topEm) }
        lastTopEm = topEm
    });
    $win.on('scroll:up', function (e, s) {
        if (20 < s) {
            if ('none' !== $scUp.css('display')) { return false } else { $scUp.css('display', 'block') }
        } else {
            $ribs.filter('#rib-roll-hot').removeClass('pinned');
            $scUp . css('display', 'none')
        }
    });
    $win.on('scroll:down', function (e, s) {
        if ('none' !== $scUp.css('display')) { $scUp.css('display', 'none') }
        if (20 > s || !parseInt($ribs.filter('#rib-roll-hot').data('pin'))) { return false }
        $ribs.filter('#rib-roll-hot').addClass('pinned');
    })
});