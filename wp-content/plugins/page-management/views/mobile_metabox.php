<?php
    $button_pdf    = get_post_meta( $post->ID, 'mobile_ic_1', true );
    $button_pdf_1  = get_post_meta( $post->ID, 'mobile_ic_2', true );
    $button_pdf_2  = get_post_meta( $post->ID, 'mobile_ic_3', true );
    $button_pdf_3  = get_post_meta( $post->ID, 'mobile_ic_4', true );
    $button_pdf_4  = get_post_meta( $post->ID, 'mobile_ic_5', true );
    $text_1        = get_post_meta( $post->ID, 'mobile_text_1', true );
    $text_2        = get_post_meta( $post->ID, 'mobile_text_2', true );
    $text_3        = get_post_meta( $post->ID, 'mobile_text_3', true );
    $text_4        = get_post_meta( $post->ID, 'mobile_text_4', true );
?>
<table class="form-table footer-metabox"> 
    <input type="hidden" name="footer_nonce" value="<?php echo wp_create_nonce( "footer_nonce" ); ?>">

    <tr>
        <th>
            <label for="mobile_ndt"><?php esc_html_e( 'Mobile Icon 1', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="url" 
                name="mobile_ic_1" 
                id="mobile-pdf" 
                class="regular-text"
                value="<?php echo( isset ( $button_pdf ) ) ? esc_url( $button_pdf ) : ''; ?>"
            >
            <input type="button" name="mobile_ic_1" id="mobile_ndt_btn" class="button btn-plugin" value="<?php _e( 'Choose an Image', 'page_manage' )?>" />
        </td>
        <?php 
            if($button_pdf) {
            $img_src = $button_pdf;
            }
             ?>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src  ) ) ? ($img_src ) : ''; ?>">
        </td>
    </tr> 
    <tr>
        <th>
            <label for="mobile_ndt_1"><?php esc_html_e( 'Mobile Icon 2', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="url" 
                name="mobile_ic_2" 
                id="mobile-pdf_1" 
                class="regular-text"
                value="<?php echo( isset ( $button_pdf_1 ) ) ? esc_url( $button_pdf_1 ) : ''; ?>"
            >
            <input type="button" name="mobile_ic_2" id="mobile_ndt_btn_1" class="button btn-plugin" value="<?php _e( 'Choose an Image', 'page_manage' )?>" />
        </td>
        <?php 
            if($button_pdf_1) {
            $img_src_1 = $button_pdf_1;
            }
             ?>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src_1 ) ) ? ($img_src_1 ) : ''; ?>">
        </td>
    </tr> 
    <tr>
        <th>
            <label for="mobile_ndt_2"><?php esc_html_e( 'Mobile Icon 3', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="url" 
                name="mobile_ic_3" 
                id="mobile-pdf_2" 
                class="regular-text"
                value="<?php echo( isset ( $button_pdf_2 ) ) ? esc_url( $button_pdf_2 ) : ''; ?>"
            >
            <input type="button" name="mobile_ic_3" id="mobile_ndt_btn_2" class="button btn-plugin" value="<?php _e( 'Choose an Image', 'page_manage' )?>" />
        </td>
        <?php 
            if($button_pdf_2) {
            $img_src_2 = $button_pdf_2;
            }
             ?>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src_2  ) ) ? ($img_src_2 ) : ''; ?>">
        </td>
    </tr> 
    <tr>
        <th>
            <label for="mobile_ndt_3"><?php esc_html_e( 'Mobile Icon 4', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="url" 
                name="mobile_ic_4" 
                id="mobile-pdf_3" 
                class="regular-text"
                value="<?php echo( isset ( $button_pdf_3) ) ? esc_url( $button_pdf_3 ) : ''; ?>"
            >
            <input type="button" name="mobile_ic_4" id="mobile_ndt_btn_3" class="button btn-plugin" value="<?php _e( 'Choose an Image', 'page_manage' )?>" />
        </td>
        <?php 
            if($button_pdf_3) {
            $img_src_3 = $button_pdf_3;
            }
             ?>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src_3  ) ) ? ($img_src_3 ) : ''; ?>">
        </td>
    </tr> 
    <tr>
        <th>
            <label for="mobile_ndt_4"><?php esc_html_e( 'Mobile Icon 5', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="url" 
                name="mobile_ic_5" 
                id="mobile-pdf_4" 
                class="regular-text"
                value="<?php echo( isset ( $button_pdf_4) ) ? esc_url( $button_pdf_4 ) : ''; ?>"
            >
            <input type="button" name="mobile_ic_5" id="mobile_ndt_btn_4" class="button btn-plugin" value="<?php _e( 'Choose an Image', 'page_manage' )?>" />
        </td>
        <?php 
            if($button_pdf_4) {
            $img_src_4 = $button_pdf_4;
            }
             ?>
        <td>
            <img height="40px" src="<?php echo( isset ( $img_src_4  ) ) ? ($img_src_4) : ''; ?>">
        </td>
    </tr> 
    <tr>
        <th>
            <label for="mobile_1"><?php esc_html_e( 'Text 1', 'page-manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="mobile_text_1" 
                id="mobile_1" 
                class="regular-text"
                value="<?php echo( isset ( $text_1 ) ) ? esc_html_e(  $text_1) : ''; ?>"
            >
        </td>
    </tr> 
    <tr>
        <th>
            <label for="mobile_2"><?php esc_html_e( 'Text 2', 'page-manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="mobile_text_2" 
                id="mobile_2" 
                class="regular-text"
                value="<?php echo( isset (  $text_2  ) ) ? esc_html_e( $text_2  ) : ''; ?>"
            >
        </td>
    </tr> 
    <tr>
        <th>
            <label for="mobile_3"><?php esc_html_e( 'Text 3', 'page-manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="mobile_text_3" 
                id="mobile_3" 
                class="regular-text"
                value="<?php echo( isset ( $text_3 ) ) ? esc_html_e($text_3  ) : ''; ?>"
            >
        </td>
    </tr> 
    <tr>
        <th>
            <label for="mobile_4"><?php esc_html_e( 'Text 4', 'page-manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="mobile_text_4" 
                id="mobile_4" 
                class="regular-text"
                value="<?php echo( isset ( $text_4 ) ) ? esc_html_e( $text_4 ) : ''; ?>"
            >
        </td>
    </tr> 
</table>