jQuery(function ($) {

    // Set all variables to be used in scope
    var frame,
        con = $('.term-img-wrap'),
        addImgLnk = con.find('.add-cat-img'),
        delImgLnk = con.find('.remove-cat-img'),
        imgContainer = con.find('.cat-img'),
        imgIdInput = con.find('#tag-img');

    // ADD IMAGE LINK
    addImgLnk.on('click', function (e) {

        e.preventDefault();

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

            // Send the attachment URL to our custom image input field.
            imgContainer.append('<img src="' + attachment.url + '" alt="" />');

            // Send the attachment id to our hidden input
            imgIdInput.val(attachment.id);

            // Hide the add image link
            addImgLnk.addClass('hidden');
            con.find('.description').addClass('hidden');

            // Unhide the remove image link
            delImgLnk.removeClass('hidden');
        });

        // Finally, open the modal on click
        frame.open();
    });


    // DELETE IMAGE LINK
    delImgLnk.on('click', function (event) {

        event.preventDefault();

        // Clear out the preview image
        imgContainer.html('');

        // Un-hide the add image link
        addImgLnk.removeClass('hidden');
        con.find('.description').removeClass('hidden');

        // Hide the delete image link
        delImgLnk.addClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val('');

    });

});