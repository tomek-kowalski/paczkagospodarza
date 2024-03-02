<?php


    $image_1            = get_post_meta( $post->ID, 'front_page_image_1', true );
    $text_1             = get_post_meta( $post->ID, 'front_page_text_1', true );

    $icon_1             = get_post_meta( $post->ID, 'front_page_icon_1', true );
    $title_1            = get_post_meta( $post->ID, 'front_page_title_1', true );
    $text_section_1     = get_post_meta( $post->ID, 'front_page_text_section_1', true );

    $icon_2             = get_post_meta( $post->ID, 'front_page_icon_2', true );
    $title_2            = get_post_meta( $post->ID, 'front_page_title_2', true );
    $text_section_2     = get_post_meta( $post->ID, 'front_page_text_section_2', true );

    $icon_3             = get_post_meta( $post->ID, 'front_page_icon_3', true );
    $title_3            = get_post_meta( $post->ID, 'front_page_title_3', true );
    $text_section_3     = get_post_meta( $post->ID, 'front_page_text_section_3', true );

    $icon_4             = get_post_meta( $post->ID, 'front_page_icon_4', true );
    $title_4            = get_post_meta( $post->ID, 'front_page_title_4', true );
    $text_section_4     = get_post_meta( $post->ID, 'front_page_text_section_4', true );

    $images_1            = get_post_meta( $post->ID, 'front_page_images_1', true );
    $images_2            = get_post_meta( $post->ID, 'front_page_images_2', true );
    $images_3            = get_post_meta( $post->ID, 'front_page_images_3', true );


?>
<table class="form-table front-page-metabox"> 
    <input type="hidden" name="front-page_nonce" value="<?php echo wp_create_nonce( "front-page_nonce" ); ?>">
    <tr>
        <th>
        <label for="promo_line"><?php esc_html_e( 'Promo Line', 'page-manage' ); ?></label>
        </th>
            <td class="first-cell">
        <textarea 
            rows="4"
            type="text" 
            name="front_page_text_1" 
            id="promo_line" 
            class="regular-text"
        ><?php echo esc_textarea( isset( $text_1 ) ? $text_1 : '' ); ?></textarea>
        </td>
    </tr>
    <tr>
        <th>
            <label for="meta_image_1"><?php esc_html_e( 'Main Image', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="front_page_image_1" 
                id="meta_image_1" 
                class="regular-text"
                value="<?php echo( isset ( $image_1 ) ) ? esc_url( $image_1 ) : ''; ?>"
            > 
            <input type="button" id="front_page_image_1_target" class="button btn-plugin" value="<?php _e( 'Choose an image', 'page_manage' )?>" />
            <?php 
            if($image_1) {
            $img_src = $image_1;
            }
             ?>
        </td>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src ) ) ? $img_src : ''; ?>">
        </td>
    </tr> 

    <tr>
        <th>
        <label for="text_section_1"><?php esc_html_e( 'Text Section 1', 'page-manage' ); ?></label>
        </th>
            <td class="first-cell">
        <textarea 
            rows="4"
            type="text" 
            name="front_page_text_section_1" 
            id="text_section_1" 
            class="regular-text"
        ><?php echo esc_textarea( isset( $text_section_1 ) ? $text_section_1 : '' ); ?></textarea>
        </td>
    </tr>

    <tr>
        <th>
        <label for="title_section_1"><?php esc_html_e( 'Title Section 1', 'page-manage' ); ?></label>
        </th>
            <td class="first-cell">
        <input 
            type="text" 
            name="front_page_title_1" 
            id="title_section_1" 
            class="regular-text"
            value="<?php echo( isset (  $title_1  ) ) ? esc_html_e( $title_1  ) : ''; ?>"
        >
        </td>
    </tr>

    <tr>
        <th>
            <label for="icon_section_1"><?php esc_html_e( 'Icon Section 1', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="front_page_icon_1" 
                id="icon_section_1" 
                class="regular-text"
                value="<?php echo( isset ( $icon_1 ) ) ? esc_url( $icon_1 ) : ''; ?>"
            > 
            <input type="button" id="front_page_icon_1_target" class="button btn-plugin" value="<?php _e( 'Choose an image', 'page_manage' )?>" />
            <?php 
            if($icon_1) {
            $img_src_1 = $icon_1;
            }
            ?>
        </td>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src_1 ) ) ? $img_src_1 : ''; ?>">
        </td>
    </tr> 

    <tr>
        <th>
        <label for="text_section_2"><?php esc_html_e( 'Text Section 2', 'page-manage' ); ?></label>
        </th>
            <td class="first-cell">
        <textarea 
            rows="4"
            type="text" 
            name="front_page_text_section_2" 
            id="text_section_2" 
            class="regular-text"
        ><?php echo esc_textarea( isset( $text_section_2 ) ? $text_section_2 : '' ); ?></textarea>
        </td>
    </tr>

    <tr>
        <th>
        <label for="title_section_2"><?php esc_html_e( 'Title Section 2', 'page-manage' ); ?></label>
        </th>
            <td class="first-cell">
        <input 
            type="text" 
            name="front_page_title_2" 
            id="title_section_2" 
            class="regular-text"
            value="<?php echo( isset (  $title_2  ) ) ? esc_html_e( $title_2  ) : ''; ?>"
        >
        </td>
    </tr>

    <tr>
        <th>
            <label for="icon_section_2"><?php esc_html_e( 'Icon Section 2', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="front_page_icon_2" 
                id="icon_section_2" 
                class="regular-text"
                value="<?php echo( isset ( $icon_2 ) ) ? esc_url( $icon_2 ) : ''; ?>"
            > 
            <input type="button" id="front_page_icon_2_target" class="button btn-plugin" value="<?php _e( 'Choose an image', 'page_manage' )?>" />
            <?php 
            if($icon_2) {
            $img_src_2 = $icon_2;
            }
            ?>
        </td>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src_2 ) ) ? $img_src_2 : ''; ?>">
        </td>
    </tr> 

    <tr>
        <th>
        <label for="text_section_3"><?php esc_html_e( 'Text Section 3', 'page-manage' ); ?></label>
        </th>
            <td class="first-cell">
        <textarea 
            rows="4"
            type="text" 
            name="front_page_text_section_3" 
            id="text_section_3" 
            class="regular-text"
        ><?php echo esc_textarea( isset( $text_section_3 ) ? $text_section_3 : '' ); ?></textarea>
        </td>
    </tr>

    <tr>
        <th>
        <label for="title_section_3"><?php esc_html_e( 'Title Section 3', 'page-manage' ); ?></label>
        </th>
            <td class="first-cell">
        <input 
            type="text" 
            name="front_page_title_3" 
            id="title_section_3" 
            class="regular-text"
            value="<?php echo( isset (  $title_3  ) ) ? esc_html_e( $title_3  ) : ''; ?>"
        >
        </td>
    </tr>

    <tr>
        <th>
            <label for="icon_section_3"><?php esc_html_e( 'Icon Section 3', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="front_page_icon_3" 
                id="icon_section_3" 
                class="regular-text"
                value="<?php echo( isset ( $icon_3 ) ) ? esc_url( $icon_3 ) : ''; ?>"
            > 
            <input type="button" id="front_page_icon_3_target" class="button btn-plugin" value="<?php _e( 'Choose an image', 'page_manage' )?>" />
            <?php 
            if($icon_3) {
            $img_src_3 = $icon_3;
            }
            ?>
        </td>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src_3 ) ) ? $img_src_3 : ''; ?>">
        </td>
    </tr> 

    <tr>
        <th>
        <label for="text_section_4"><?php esc_html_e( 'Text Section 4', 'page-manage' ); ?></label>
        </th>
            <td class="first-cell">
        <textarea 
            rows="4"
            type="text" 
            name="front_page_text_section_4" 
            id="text_section_1" 
            class="regular-text"
        ><?php echo esc_textarea( isset( $text_section_4 ) ? $text_section_4 : '' ); ?></textarea>
        </td>
    </tr>

    <tr>
        <th>
        <label for="title_section_4"><?php esc_html_e( 'Title Section 4', 'page-manage' ); ?></label>
        </th>
            <td class="first-cell">
        <input 
            type="text" 
            name="front_page_title_4" 
            id="title_section_4" 
            class="regular-text"
            value="<?php echo( isset (  $title_4  ) ) ? esc_html_e( $title_4  ) : ''; ?>"
        >
        </td>
    </tr>

    <tr>
        <th>
            <label for="icon_section_4"><?php esc_html_e( 'Icon Section 4', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="front_page_icon_4" 
                id="icon_section_4" 
                class="regular-text"
                value="<?php echo( isset ( $icon_4 ) ) ? esc_url( $icon_4 ) : ''; ?>"
            > 
            <input type="button" id="front_page_icon_4_target" class="button btn-plugin" value="<?php _e( 'Choose an image', 'page_manage' )?>" />
            <?php 
            if($icon_4) {
            $img_src_4 = $icon_4;
            }
            ?>
        </td>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src_4 ) ) ? $img_src_4 : ''; ?>">
        </td>
    </tr> 

    <tr>
        <th>
            <label for="images_1"><?php esc_html_e( 'Image 1/3', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="front_page_images_1" 
                id="images_1" 
                class="regular-text"
                value="<?php echo( isset ( $images_1 ) ) ? esc_url( $images_1 ) : ''; ?>"
            > 
            <input type="button" id="front_page_images_1_target" class="button btn-plugin" value="<?php _e( 'Choose an image', 'page_manage' )?>" />
            <?php 
            if($images_1) {
            $images_src_1 = $images_1;
            }
            ?>
        </td>
        <td>
            <img height="40px" src="<?php echo( isset ( $images_src_1 ) ) ? $images_src_1: ''; ?>">
        </td>
    </tr> 

    <tr>
        <th>
            <label for="images_2"><?php esc_html_e( 'Image 2/3', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="front_page_images_2" 
                id="images_2" 
                class="regular-text"
                value="<?php echo( isset ($images_2) ) ? esc_url( $images_2) : ''; ?>"
            > 
            <input type="button" id="front_page_images_2_target" class="button btn-plugin" value="<?php _e( 'Choose an image', 'page_manage' )?>" />
            <?php 
            if($images_2 ) {
            $images_src_2 = $images_2 ;
            }
            ?>
        </td>
        <td>
            <img height="40px" src="<?php echo( isset ( $images_src_2 ) ) ? $images_src_2: ''; ?>">
        </td>
    </tr> 

    <tr>
        <th>
            <label for="images_3"><?php esc_html_e( 'Image 3/3', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="front_page_images_3" 
                id="images_3" 
                class="regular-text"
                value="<?php echo( isset ( $images_3 ) ) ? esc_url( $images_3 ) : ''; ?>"
            > 
            <input type="button" id="front_page_images_3_target" class="button btn-plugin" value="<?php _e( 'Choose an image', 'page_manage' )?>" />
            <?php 
            if($images_3) {
            $images_src_3 = $images_3;
            }
            ?>
        </td>
        <td>
            <img height="40px" src="<?php echo( isset ( $images_src_3 ) ) ? $images_src_3  : ''; ?>">
        </td>
    </tr> 

</table>