<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$shipping_zones = WC_Shipping_Zones::get_zones();
?>
<div class="product_meta">

    <?php do_action( 'woocommerce_product_meta_start' ); ?>

    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

        <span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

    <?php endif; ?>

    <?php

    $displayed_methods = 0;

    foreach ( $shipping_zones as $shipping_zone ) {
        if ( isset( $shipping_zone['shipping_methods'] ) && is_array( $shipping_zone['shipping_methods'] ) ) {
			echo '<ul class="methods">';
            foreach ( $shipping_zone['shipping_methods'] as $shipping_method ) {

                if ( $shipping_method instanceof WC_Shipping_Method && $shipping_method->is_enabled() ) {
                    

                    if ( $displayed_methods === 0 ) {
                        $cost_dv = __('Koszt dostawy: ', 'woocommerce');
                        echo '<li><span class="delivery">' . $cost_dv . '</span><span class="delivery-text">' . $shipping_method->title . '</span></li>';
                        $displayed_methods++;
                    }

                    elseif ( $displayed_methods === 1 ) {
                        $date_dv = __('Termin dostawy: ', 'woocommerce');
                        echo '<li><span class="delivery">' . $date_dv . '</span><span class="delivery-text">' . $shipping_method->title . '</span></li>';
                        $displayed_methods++;
                    }

                    if ( $displayed_methods >= 2 ) {
                        
                        break 2; 
                    }
                }
            }
			echo '</ul>';
        }
    }
    ?>

    <?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>





