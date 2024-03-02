jQuery(document).ready(function($){

var meta_image_frame;

var page_edits = document.querySelectorAll('.item-edit');

page_edits.forEach((page_edit) => {
    page_edit.addEventListener('click', () => {
        var id = page_edit.getAttribute('id');
        var numericPart = id.match(/\d+/)[0];
        console.log(numericPart);

        jQuery('#btn-img-menu-' + numericPart).click(function (e) {
            e.preventDefault();
            if (meta_image_frame) {
                meta_image_frame.open();
                return;
            }
            meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                title: meta_image_menu.title,
                button: { text: meta_image_menu.button },
                library: { type: 'image' }
            });
            meta_image_frame.on('select', function () {
                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
                jQuery('#meta_image_' + numericPart).val(media_attachment.url);
            });
            meta_image_frame.open();
        });
    });
});


});



