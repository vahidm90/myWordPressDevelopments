(function ($) {
    var $wpInlineEdit = inlineEditPost.edit, taxes = SNTBulkEdit.snt_hct;
    inlineEditPost.edit = function (id) {
        $wpInlineEdit.apply(this, arguments);
        var $id = 0;
        if (typeof(id) === 'object') { $id = parseInt(this.getId(id)) }
        if ($id > 0) {
            var $eRow = $('#edit-' + $id), $pRow = $('#post-' + $id);
            $.each(taxes, function (i, tax) {
                var tId = $('div#' + tax + '_' + $id, $('div#inline_' + $id, $pRow)).html();
                if (tId) { $('select#sel-tax-' + tax + ' option[value=' + tId + ']', $eRow).attr('selected', true) }
            });
            if ($('td.column-top', $pRow).html()) {
                var meta = $('td.column-top a', $pRow).data('top');
                if (meta) { $('select#top option[value=' + meta + ']', $eRow).attr('selected', true) }
            }
        }
    };
    $(document).on('click', '#bulk_edit', function () {
        var $bE = $('#bulk-edit'), iArr = [];
        $bE.find('#bulk-titles').children().each(function () { iArr.push($(this).attr('id').replace(/^(ttle)/i, '')) });
        $.each(taxes, function (i, tax) {
            var term = parseInt($('select#sel-tax-' + tax, $bE).val());
            if (term) {
                $.ajax({
                    url: ajaxurl,
                    async: false,
                    cache: false,
                    method: 'POST',
                    data: {
                        ids: iArr,
                        tax: tax,
                        term: term,
                        action: 'snt-save-ct-bulk-edit-data',
                        security: SNTBulkEdit.nonce
                    }
                })
            }
        });
        var top = $('select#top', $bE).val();
        if (top) {
            $.ajax({
                url: ajaxurl,
                async: false,
                cache: false,
                method: 'POST',
                data: {
                    ids: iArr,
                    top: top,
                    action: 'snt-save-top-bulk-edit-data',
                    security: SNTBulkEdit.nonce
                }
            })
        }
    })
})(jQuery);