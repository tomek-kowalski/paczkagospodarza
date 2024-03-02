<?php
    $button_pdf    = get_post_meta( $post->ID, 'footer_ndt', true );
    $button_pdf_1  = get_post_meta( $post->ID, 'footer_ndt_1', true );
    $button_pdf_2  = get_post_meta( $post->ID, 'footer_ndt_2', true );
    $button_pdf_3  = get_post_meta( $post->ID, 'footer_ndt_3', true );
    $button_phone =  get_post_meta( $post->ID, 'footer_text', true );
    $button_email =  get_post_meta( $post->ID, 'footer_title', true );
?>
<table class="form-table footer-metabox"> 
    <input type="hidden" name="footer_nonce" value="<?php echo wp_create_nonce( "footer_nonce" ); ?>">

    <tr>
        <th>
            <label for="footer_ndt"><?php esc_html_e( 'Footer Img', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="url" 
                name="footer_ndt" 
                id="footer-pdf" 
                class="regular-text"
                value="<?php echo( isset ( $button_pdf ) ) ? esc_url( $button_pdf ) : ''; ?>"
            >
            <input type="button" name="footer_ndt" id="footer_ndt_btn" class="button btn-plugin" value="<?php _e( 'Choose an Image', 'page_manage' )?>" />
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
            <label for="footer_phone_number"><?php esc_html_e( 'Footer Text', 'page-manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="footer_text" 
                id="footer_phone_number" 
                class="regular-text"
                value="<?php echo( isset ( $button_phone ) ) ? esc_html_e( $button_phone ) : ''; ?>"
            >
        </td>
    </tr> 
    <tr>
        <th>
            <label for="footer_email"><?php esc_html_e( 'Footer Ttile', 'page-manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="text" 
                name="footer_title" 
                id="footer_email" 
                class="regular-text"
                value="<?php echo( isset ( $button_email ) ) ? esc_html_e( $button_email ) : ''; ?>"
            >
        </td>
    </tr> 
    <tr>
        <th>
            <label for="footer_ndt_1"><?php esc_html_e( 'Social Icon 1', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="url" 
                name="footer_ndt_1" 
                id="footer-pdf_1" 
                class="regular-text"
                value="<?php echo( isset ( $button_pdf_1 ) ) ? esc_url( $button_pdf_1 ) : ''; ?>"
            >
            <input type="button" name="footer_ndt_1" id="footer_ndt_btn_1" class="button btn-plugin" value="<?php _e( 'Choose an Image', 'page_manage' )?>" />
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
            <label for="footer_ndt_2"><?php esc_html_e( 'Social Icon 2', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="url" 
                name="footer_ndt_2" 
                id="footer-pdf_2" 
                class="regular-text"
                value="<?php echo( isset ( $button_pdf_2 ) ) ? esc_url( $button_pdf_2 ) : ''; ?>"
            >
            <input type="button" name="footer_ndt_2" id="footer_ndt_btn_2" class="button btn-plugin" value="<?php _e( 'Choose an Image', 'page_manage' )?>" />
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
            <label for="footer_ndt_3"><?php esc_html_e( 'Social Icon 3', 'page_manage' ); ?></label>
        </th>
        <td class="first-cell">
            <input 
                type="url" 
                name="footer_ndt_3" 
                id="footer-pdf_3" 
                class="regular-text"
                value="<?php echo( isset ( $button_pdf_3) ) ? esc_url( $button_pdf_3 ) : ''; ?>"
            >
            <input type="button" name="footer_ndt_3" id="footer_ndt_btn_3" class="button btn-plugin" value="<?php _e( 'Choose an Image', 'page_manage' )?>" />
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
</table>