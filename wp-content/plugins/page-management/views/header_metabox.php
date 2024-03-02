<?php
    $image_1 = get_post_meta( $post->ID, 'header_ndt', true );
    $image_2 = get_post_meta( $post->ID, 'header_ndt_2', true );
?>
<table class="form-table header-metabox"> 
    <input type="hidden" name="header_nonce" value="<?php echo wp_create_nonce( "header_nonce" ); ?>">
    <tr>
        <th>
            <label for="meta_image_header"><?php esc_html_e( 'Account Icon', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="header_ndt" 
                id="meta_image_header" 
                class="regular-text"
                value="<?php echo( isset ( $image_1 ) ) ? $image_1 : ''; ?>"
            >
            <input type="button" name="header_ndt" id="header_ndt_btn" class="button btn-plugin" value="<?php _e( 'Choose an Image', 'page_manage' )?>" />
        </td>
        <?php 
            if($image_1) {
                $img_src = $image_1;
                }
             ?>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src  ) ) ? ($img_src ) : ''; ?>">
        </td>
    </tr> 

    <tr>
        <th>
            <label for="meta_image_header_2"><?php esc_html_e( 'Cart Icon', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="header_ndt_2" 
                id="meta_image_header_2" 
                class="regular-text"
                value="<?php echo( isset ( $image_2 ) ) ? $image_2 : ''; ?>"
            >
            <input type="button" name="header_ndt_2" id="header_ndt_btn_2" class="button btn-plugin" value="<?php _e( 'Choose an Image', 'page_manage' )?>" />
        </td>
        <?php 
            if($image_2) {
                $img_src_2 = $image_2;
            }
            ?>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src_2  ) ) ? ($img_src_2 ) : ''; ?>">
        </td>
    </tr> 

 
</table>