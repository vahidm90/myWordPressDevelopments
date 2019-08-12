jQuery(document).ready(function ($) { $('#post-body').removeClass('columns-2') } );
(function ($) {
    var $cont = $('#related-meta-box'), $cont2 = $('#source-meta-box');
    var $in = $('#add-related', $cont), $div = $('#cur-rel', $cont);
    var $now = $('input', $div), cur = parseInt($in.data('id'), 10);
    function SNTAddBtn(title){
        var val = $in.val(), now = ($now.val() ? $now.val().split(',') : []);
        $('.rel-sug', $cont).remove();
        $in.val('');
        if (-1 === now.indexOf(val)) { now.push(val) } else { return }
        $now.val(now);
        var icoId = '<span class="dashicons-before dashicons-no-alt">' + val + '</span>';
        $('p', $div).addClass('hide-txt');
        $div.append('<button class="cur-rel"  value="' + val + '" title="' + title + '">' + icoId + '</button>')
    }
    $in.on('input', function () {
        var val = parseInt($(this).val(), 10), add = '', icon = '<span class="dashicons dashicons-info"></span>';
        if (cur === val) {
            add = '<div class="rel-sug same">' + icon + '<span>' + SNTAddEditPost.relSame + '</span></div>'
        }
        $.ajax({
            url:      SNTAddEditPost.url,
            data:     { action: 'snt-show-related-title', rel_id: val },
            method:   'POST',
            dataType: 'json',
            error: function () {
                if (isNaN(val)) {
                    add = ''
                } else {
                    add = sprintf( SNTAddEditPost.relMsg, val );
                    add = '<div class="rel-sug null">' + icon + '<span>' + add + '</span></div>'
                }
            },
            success: function (t) {
                if (cur !== val){
                    var title = t.post_title;
                    var content = '<span><i>' + val + '</i> ' + title + '</span>';
                    add = '<div class="rel-sug rel-sug-item" data-title="' + title + '">' + content + '</div>'
                }
            },
            complete: function () {
                $('.rel-sug', $cont).remove();
                $in.after(add);
                $('.rel-sug-item', $cont).addClass('sel')
            }
        })
    });
    $in.on('keydown', function (e) {
        var key = e.keyCode, $item = $('.rel-sug-item', $cont), $sug = $('.rel-sug', $cont);
        if (-1 < $.inArray( key, [13, 27, 37, 38, 39, 40])) { e.preventDefault() }
        if (!$sug.length){ return }
        switch ( key ) {
            default: break;
            case 37: case 38: case 39: case 40:
            $item.toggleClass('sel');
            break;
            case 13:
                if (!$sug.hasClass('sel') || !$item.length) { break }
                SNTAddBtn($item.data('title'));
                break;
            case 27:
                $in.val('');
                $sug.remove();
                break;
            case 8:
                $sug.remove();
                break;
        }
    });
    $cont.on('click', '.rel-sug', function () {
        if($(this).hasClass('.rel-sug-item')){
            SNTAddBtn($(this).data('title'));
        }
        $(this).remove();
    });
    $cont.on('click', '.cur-rel .dashicons-no-alt', function (){
        var val = $now.val().split(',');
        var pos = val.indexOf($(this).val());
        if (-1 < pos) {
            val.splice(pos, 1);
            $now.val(val)
        } else { return }
        if (!val.length) { $('p', $div).removeClass('hide-txt') }
        $(this).remove()
    });
    $('#div-add-related').on('click', '.rel-sug-item', $(this).data('title'), SNTAddBtn);
    var $countSrc = $('input#count-source', $cont2);
    $('#add-src', $cont2).click(function () {
        var i, j = null, html = '', fields = ['name', 'url'];
        for (i=0; i < 100; i++) {
            if ($('#item-src-' + i, $cont2).length < 1){
                j = i;
                break
            }
        }
        if ( null === j ){ return false }
        var attr = 'data-row="' + j + '"';
        fields.forEach(function (t) {
            var radioAttr = attr + ' type="radio" name="switch-src-' + j + '" class="switch-src enable-' + t + '"', txt;
            if ('name' === t) {
                radioAttr += ' value="1" checked';
                txt = SNTAddEditPost.srcNameRadio
            } else {
                radioAttr += ' value="2"';
                txt = SNTAddEditPost.srcUrlRadio
            }
            html += '<label><input ' + radioAttr + '/><span>' + txt +   '</span></label><br />';
        });
        fields.forEach(function (t) {
            var txtAttr = attr + ' id="' + t + '-source-' + j + '" name="source[' + j + '][' + t + ']"', txt;
            if ('name' === t) {
                txtAttr += 'class="in-txt-src" required';
                txt = SNTAddEditPost.srcNamePlaceholder;
            } else {
                txtAttr += 'class="url-src in-txt-src" disabled';
                txt = SNTAddEditPost.srcUrlPlaceholder;
            }
            html += '<input  ' + txtAttr + ' placeholder="' + txt + '" /><br />';
        });
        html += '<button type="button" class="del-src" ' + attr + '>';
        html += '<span class="dashicons dashicons-dismiss"></span>';
        html += '</button>';
        $countSrc.val(parseInt($countSrc.val(), 10) + 1);
        $(this).before( '<div class="item-src" id="item-src-' + j + '" ' + attr + '>' + html + '</div>');
    });
    $cont2.on('change', 'input.switch-src', function () {
        var $in = $('input#url-source-' + $(this).data('row'), $cont2);
        if ($(this).hasClass('enable-name')){
            $in.prop('required', false);
            $in.prop('disabled', true)
        } else {
            $in.prop('disabled', false);
            $in.prop('required', true)
        }
    });
    $cont2.on('click', 'button.del-src', function () {
        $countSrc.val(parseInt($countSrc.val(), 10) - 1);
        $('div#item-src-' + $(this).data('row'), $cont2).remove()
    });
    $cont2.on('click', '.msg-src button', function () {$(this).parents().filter('.msg-src').remove()});
    $cont2.on('change', 'input.url-src', function () {
        if ( !$(this).val() ) { return false }
        var url = $(this).val(), msg = '', row = parseInt($(this).data('row'), 10);
        $.ajax({
            url:      SNTAddEditPost.url,
            data:     { action: 'snt-check-url', url: url},
            method:   'POST',
            dataType: 'json',
            error: function () {
                msg += '<p class="dashicons-before dashicons-no fail-src">' + SNTAddEditPost.srcUrlFail + '</p>';
                msg += '<button class="dashicons dashicons-dismiss"></button><p>';
                msg += sprintf( SNTAddEditPost.srcUrlCheck, '<span class="failed-url">' + url + '</span>' );
                msg += '</p>';
                $('.ttl-src', $('#item-src-' + row)).remove();
            },
            success: function (t) {
                msg += '<p class="dashicons-before dashicons-yes ok-src">' + SNTAddEditPost.srcUrlSuccess + '</p>';
                msg += '<button class="dashicons dashicons-dismiss"></button><p>';
                msg += '<span>' + SNTAddEditPost.srcUrlTitle + '</span><span class="ttl-page"> ' + t.ttl + '</span>';
                msg += '</p>';
                var $item = $('#item-src-' + row);
                $('.ttl-src', $item).remove();
                var input = ' id="ttl-src-' + row + '" title="ttl-src-' + row + '"';
                input += ' value="' + t.esc_ttl + '" name="source[' + row + '][ttl]"';
                $('button', $item).before('<input type="hidden" class="ttl-src" ' + input + '/>')
            },
            complete: function () {
                $cont2.append('<div class="msg-src">' + msg + '</div>');
            }
        })

    })
})(jQuery);