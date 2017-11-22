var tagsModule = function() {

    var self = this;
    self.tagsInputFocus = true;
    self.tagsList = jQuery('.tags-list');
    self.tagsContent = self.tagsList.find('.tags-list-content');
    self.tagsOffer = '.tags-list .tags-offer';
    self.tagsInput = self.tagsList.find('#tags');

    self.init = function() {
        jQuery(document.body).on('focus', '#tags', function() {
            self.tagsInputFocus = false;
        });

        jQuery(document.body).on('focusout', '#tags', function() {
            self.tagsInputFocus = true;
        });
        jQuery(document.body).on('keypress', '.tags-list input', function(e) {
            self.inputEnter(e);
        });

        // Remove
        jQuery(document.body).on('click', '.tags-list .tag .remove', function(e) {
            e.preventDefault();
            self.removeTagHtml(e);
        });

        // Chose offer
        jQuery(document.body).on('click', '.tags-list .tags-offer li', function(e) {
            e.preventDefault();

            self.selectOffer(e);
        });

        // View tags offer list
        jQuery(document.body).on('keyup', '.tags-list input', function(e) {
            var tag_name = self.tagsInput.val().trim();

            if(tag_name !== '' && tag_name.length > 0) {
                // Search
                jQuery.get({
                    url : '/json/tag-search',
                    data : {
                        tag : tag_name
                    },
                    dataType : 'json'
                }).done(function(data) {
                    if(typeof data.tags !== "undefined") {
                        self.insertTagsOffer(data.tags);
                    }
                });
            } else {
                self.removeTagsOffer();
            }
        });
    };

    self.selectOffer = function(e) {
        var element = jQuery(e.target);

        self.insertTag(element.text());
        self.clearInput();
        self.focusOnInput();
        self.removeTagsOffer();
    };

    self.inputEnter = function(e) {
        // If Enter button press
        if(e.charCode === 13) {
            if(self.tagsInputFocus === false) {
                e.preventDefault();

                var tags = self.tagsInput.val().trim();
                if(tags !== '') {
                    var tags_array = tags.split(',');

                    jQuery.each(tags_array, function(key, tag) {
                        self.insertTag(tag.trim());
                    });

                    // Clear input
                    self.clearInput();
                }
            }
        }
    };

    self.insertTag = function(tag) {
        var tagHtml = '<div class="btn btn-sm btn-info tag">\n' +
            '<input type="hidden" name="tags[]" value="' + tag + '">\n' +
            '              ' + tag + '\n' +
            '              <div class="badge badge-light remove">&times;</div>\n' +
            '          </div>';

        if(tag !== '')
            self.tagsContent.append('&nbsp;' + tagHtml);
    };

    self.insertTagsOffer = function(data) {
        if(typeof data !== "undefined" && typeof data === "object") {

            var html = '<ul class="tags-offer"></ul>';

            if(jQuery(self.tagsOffer).length === 0) {
                self.tagsList.append(html);
            }

            jQuery(self.tagsOffer).empty();

            jQuery.each(data, function(i, tag) {
                jQuery(self.tagsOffer).prepend('<li>' + tag + '</li>');
            });
        }
    };

    self.removeTagsOffer = function() {
        if(jQuery(self.tagsOffer).length > 0) {
            jQuery(self.tagsOffer).remove();
        }
    };

    self.removeTagHtml = function(e) {
        jQuery(e.target).closest('.tag').remove();
    };

    self.clearInput = function() {
        self.tagsInput.val('');
    }

    self.focusOnInput = function() {
        self.tagsInput.focus();
    }

    return self;
}

jQuery(function() {
    var simplemde = new SimpleMDE({element : jQuery(".simplemde")[0]});

    // live-title
    jQuery(document.body).on('keyup', '.live-title', function() {
        jQuery('.live-title-content').text('"' + jQuery(this).val() + '"');
    });

    // tagsModule
    var tags = new tagsModule();
    tags.init();

});
