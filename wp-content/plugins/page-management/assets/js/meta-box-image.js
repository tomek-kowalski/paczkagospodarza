   
/*
* https://wordpress.stackexchange.com/questions/266094/upload-button-in-meta-box-not-opening-library
* Attaches the image uploader to the input field
*/
jQuery(document).ready(function($){

var meta_image_frame;
   
jQuery('#front_page_image_1_target').click(function(e){
    e.preventDefault();
    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }
    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_img.title,
        button: { text:  meta_image_img.button },
        library: { type: 'image' }
    });
    meta_image_frame.on('select', function(){
        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
       jQuery('#meta_image_1').val(media_attachment.url);
    });
    meta_image_frame.open();
});

jQuery('#front_page_icon_1_target').click(function(e){
    e.preventDefault();
    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }
    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_img.title,
        button: { text:  meta_image_img.button },
        library: { type: 'image' }
    });
    meta_image_frame.on('select', function(){
        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
       jQuery('#icon_section_1').val(media_attachment.url);
    });
    meta_image_frame.open();

});

jQuery('#front_page_icon_2_target').click(function(e){
    e.preventDefault();
    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }
    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_img.title,
        button: { text:  meta_image_img.button },
        library: { type: 'image' }
    });
    meta_image_frame.on('select', function(){
        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
        jQuery('#icon_section_2').val(media_attachment.url);
        });
        meta_image_frame.open();
});

jQuery('#front_page_icon_3_target').click(function(e){
    e.preventDefault();
    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }
    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_img.title,
        button: { text:  meta_image_img.button },
        library: { type: 'image' }
    });
    meta_image_frame.on('select', function(){
        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
       jQuery('#icon_section_3').val(media_attachment.url);
    });
    meta_image_frame.open();
});

jQuery('#front_page_icon_4_target').click(function(e){
    e.preventDefault();
    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }
    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_img.title,
        button: { text:  meta_image_img.button },
        library: { type: 'image' }
    });
    meta_image_frame.on('select', function(){
        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
       jQuery('#icon_section_4').val(media_attachment.url);
    });
    meta_image_frame.open();
});


jQuery('#front_page_images_1_target').click(function(e){
    e.preventDefault();
    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }
    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_img.title,
        button: { text:  meta_image_img.button },
        library: { type: 'image' }
    });
    meta_image_frame.on('select', function(){
        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
       jQuery('#images_1').val(media_attachment.url);
    });
    meta_image_frame.open();
});

jQuery('#front_page_images_2_target').click(function(e){
    e.preventDefault();
    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }
    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_img.title,
        button: { text:  meta_image_img.button },
        library: { type: 'image' }
    });
    meta_image_frame.on('select', function(){
        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
       jQuery('#images_2').val(media_attachment.url);
    });
    meta_image_frame.open();
});

jQuery('#front_page_images_3_target').click(function(e){
    e.preventDefault();
    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }
    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: meta_image_img.title,
        button: { text:  meta_image_img.button },
        library: { type: 'image' }
    });
    meta_image_frame.on('select', function(){
        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
       jQuery('#images_3').val(media_attachment.url);
    });
    meta_image_frame.open();
});


});



