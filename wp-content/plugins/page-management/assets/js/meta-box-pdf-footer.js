jQuery(document).ready(function($){
  var meta_image_frame;

   jQuery('#footer_ndt_btn').click(function(e){

    e.preventDefault();

    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }

    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_footer.title,
        button: { text:  meta_image_footer.button },
        library: { type: 'image' }
    });


    meta_image_frame.on('select', function(){

        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

       jQuery('#footer-pdf').val(media_attachment.url);
    });

    meta_image_frame.open();
});

jQuery('#footer_ndt_btn_1').click(function(e){

    e.preventDefault();

    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }

    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_footer.title,
        button: { text:  meta_image_footer.button },
        library: { type: 'image' }
    });


    meta_image_frame.on('select', function(){

        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

       jQuery('#footer-pdf_1').val(media_attachment.url);
    });

    meta_image_frame.open();
});

jQuery('#footer_ndt_btn_2').click(function(e){

    e.preventDefault();

    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }

    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_footer.title,
        button: { text:  meta_image_footer.button },
        library: { type: 'image' }
    });


    meta_image_frame.on('select', function(){

        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

       jQuery('#footer-pdf_2').val(media_attachment.url);
    });

    meta_image_frame.open();
});

jQuery('#footer_ndt_btn_3').click(function(e){

    e.preventDefault();

    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }

    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_footer.title,
        button: { text:  meta_image_footer.button },
        library: { type: 'image' }
    });


    meta_image_frame.on('select', function(){

        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

       jQuery('#footer-pdf_3').val(media_attachment.url);
    });

    meta_image_frame.open();
});
});

