jQuery(document).ready(function ($) {
    var tax = '', $form = $('div#wpbody-content > form > table');
    var $forms = $('input.add-def-tax', $form);
    $forms.keypress(function () { tax = $(this).data('tax') });
    $forms.autoComplete({
        delay: 50,
        minChars: 3,
        source: function (name, resp) {
            $.ajax({
                url: SNTDefs.url,
                data: { action: 'get-def-nh-taxes', term: name, tax: tax, security: SNTDefs.nonce },
                method: 'POST',
                dataType: 'json',
                success: function (d) { resp(d) }
            })
        },
        onSelect: function (e, term) {
            e.preventDefault();
            var $cont = $('div#div-current-def-' + tax, $form);
            var $input = $('input', $cont);
            var val = $input.val().split(',').filter(function (t) { return t });
            if (-1 === val.indexOf(term)) {
                var icoTerm = '<span>' + term + '</span><span class="dashicons dashicons-no-alt"></span>';
                var attr = 'type="button" value="' + term + '" class="def-term-item" data-tax="' + tax + '"';
                $cont.append('<button ' + attr + '>' + icoTerm + '</button>');
                val.push(term);
                $('p', $cont).addClass('hide-txt');
                $input.val(val)
            }
            $('input#input-add-' + tax, $form).val('')
        }
    });
    $('div.current-def-terms', $form).on('click', 'button', function () {
        tax = $(this).data('tax');
        var $cont = $('div#div-current-def-' + tax, $form);
        var $input = $('input', $cont), term = $(this).val();
        var val = $input.val().split(',');
        var pos = val.indexOf(term);
        if (-1 < pos) {
            val.splice(pos, 1);
            $input.val(val)
        } else { return }
        if (!val.length) { $('p', $cont).removeClass('hide-txt') }
        $(this).remove()
    });
    $('input#reset').click(function (e) {
        e.preventDefault();
        $('.def-tax-input', $form).each(function () {
            if ('SELECT' === $(this).prop('tagName')) {
                $('option[value=""]', $(this)).attr('selected', 'selected') } else { $(this).val('') }
        });
        $('button', $form).remove();
        $('p', $form).removeClass('hide-txt')
    })
});