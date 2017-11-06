jQuery(function() {
    var simplemde = new SimpleMDE({element : jQuery(".simplemde")[0]});

    // live-title
    jQuery(document.body).on('keyup', '.live-title', function() {
        jQuery('.live-title-content').text('"' + jQuery(this).val() + '"');
    });
});
