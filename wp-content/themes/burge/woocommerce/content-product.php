<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
// Ensure visibility
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php post_class(); ?>>
    <div class="container-inner">
        <span class="product-loading"></span>
        <div class="product-block-inner">
            <?php do_action('woocommerce_before_shop_loop_item'); ?>
            <div class="image-block">
                <a href="<?php esc_url(the_permalink()); ?>">
                    <?php
                    /**
                     * woocommerce_before_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action('woocommerce_before_shop_loop_item_title');
                    ?>
                </a>
                <?php
                // Display Brand
                $brand = get_the_terms($product->get_id(), 'pwb-brand');
                if ($brand && !is_wp_error($brand)) {
                    echo '<div class="pwb-brands-in-loop">';
                    echo '<span><a href="' . esc_url(get_term_link($brand[0])) . '">' . esc_html($brand[0]->name) . '</a></span>';
                    echo '</div>';
                }
                ?>
                <div class="product-button-hover"></div>
            </div>
            <div class="product-detail-wrapper">
                <?php
                // Display Rating
                echo wc_get_rating_html($product->get_average_rating());
                ?>
                <a href="<?php esc_url(the_permalink()); ?>">
                    <h3 class="product-name"><?php the_title(); ?></h3>
                </a>
                <?php do_action('woocommerce_after_shop_loop_item'); ?>
            </div>
        </div>
    </div>
</li>


