
jQuery(function ($) {

    $('#the-list').on('click', 'button.editinline', function () {
        var $row = $(this).closest('tr'),
            img = $('td.image', $row).html();
        if (img && img.match(/<span class="hidden cat-img-id">\d*<\/span><img src=.+ alt="" class="cat-img">/)) {
            vmDisplayCatImg(
                $('#edit-' + $row[0].id.replace(/tag-(\d+)/, "$1") + ' .cat-qe-img'),
                img.replace(/.*<img src="([^"]+)" alt="" class="cat-img">/, "$1"),
                img.replace(/<span class="hidden cat-img-id">(\d+)<\/span>.*/, "$1")
            );
        } else {
            vmHideCatImg($('#edit-' + $row.attr('id').replace(/tag-(\d+)/, "$1") + ' .cat-qe-img'));
        }
    });


    function vmHideCatImg($con) {

        // Delete the image id from the hidden input
        $('.cat-img-input', $con).val('');

        // Delete the image element
        $('.cat-img-box', $con).html('');

        // Responsive behaviour
        $('.change-cat-img', $con).addClass('hidden');
        $('.remove-cat-img', $con).addClass('hidden');
        $('.add-cat-img', $con).removeClass('hidden');
        $('.description', $con).removeClass('hidden');
        $('.cat-img-container', $con).removeClass('has-img');

    }


    function vmDisplayCatImg($con, url, id) {

        // Send the attachment URL to our custom image input field.
        $('.cat-img-box', $con).html('<img src="' + url + '" alt="" class="cat-img" />');

        // Send the attachment id to our hidden input
        $('.cat-img-input', $con).val(id);

        // Responsive behaviour
        $('.change-cat-img', $con).removeClass('hidden');
        $('.remove-cat-img', $con).removeClass('hidden');
        $('.cat-img-container', $con).addClass('has-img');
        $('.add-cat-img', $con).addClass('hidden');
        $('.description', $con).addClass('hidden');

    }


    function vmModifyCatImg($con) {

        // Set all variables to be used in scope
        var frame;

        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Media Of Your Chosen Persuasion',//TODO: add translation strings.
            button: {
                text: 'Use this media'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });


        // When an image is selected in the media frame...
        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();

            vmDisplayCatImg($con, attachment.url, attachment.id);

        });

        // Finally, open the modal on click
        frame.open();

    }

    $('.add-cat-img,.change-cat-img,.remove-cat-img').on('click', function (e) {
        e.preventDefault();
        var $con =
            ($(this).closest('.term-img-wrap').length > 0) ?
                $(this).closest('.term-img-wrap') : $(this).closest('.cat-qe-img');
        if ($(this).is('.remove-cat-img')) { vmHideCatImg($con); } else { vmModifyCatImg($con)}
    });

});
