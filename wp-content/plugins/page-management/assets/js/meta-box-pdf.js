   
/*
* https://wordpress.stackexchange.com/questions/266094/upload-button-in-meta-box-not-opening-library
* Attaches the image uploader to the input field
*/
jQuery(document).ready(function($){

  var meta_image_frame;

   jQuery("#header_ndt_btn").click(function(e){

    e.preventDefault();

    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }

    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_header.title,
        button: { text:  meta_image_header.button },
        library: { type: 'image' }
    });
    meta_image_frame.on('select', function(){

        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

       jQuery('#meta_image_header').val(media_attachment.url);
    });

    meta_image_frame.open();
});

jQuery("#header_ndt_btn_2").click(function(e){

    e.preventDefault();

    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }

    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_header.title,
        button: { text:  meta_image_header.button },
        library: { type: 'image' }
    });
    meta_image_frame.on('select', function(){

        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

       jQuery('#meta_image_header_2').val(media_attachment.url);
    });

    meta_image_frame.open();
});

});

