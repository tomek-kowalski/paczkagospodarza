<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

	get_header();

	global $wp, $query_args;

	$current = esc_url(home_url(add_query_arg($query_args, $wp->request)));
	$str = substr(strrchr($current, '?'), 1);
	$variable = substr($str, 0, strpos($str, "&"));

	if ($variable == 'left') {
		$classes[] = 'shop-left-sidebar';
	} elseif ($variable == 'right') {
		$classes[] = 'shop-right-sidebar';
	} elseif ($variable == 'full') {
		$div_class = 'full-width';
	} else {
		$div_class = tmpmela_sidebar_position();
	}
	?>
	<?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
		<div class="page-title">
			<div class="page-title-inner">
				<h3 class="entry-title-main"><?php echo __('Dziś w promocji','burge'); ?></h3>
			</div>
		</div>
	<?php endif; ?>
	<div class="main-content-inner <?php echo esc_attr($div_class); ?>">

		<div id="main-content" class="main-content <?php echo esc_attr(tmpmela_page_layout()); ?> <?php echo esc_attr($div_class); ?>">
			<?php do_action('woocommerce_before_main_content'); ?>
			<?php echo do_shortcode('[template_count_today]'); ?>
			<?php echo do_shortcode('[filters_category]'); ?>
			<?php
           $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 16,
            'meta_query'     => array(array(
                'key'     => '_todays_promo',
                'value'   => 'yes',
                'compare' => '=',
            ),
            ),
            );

            $product_loop = new WP_query($args);

			if ($product_loop->have_posts()) {
				do_action('woocommerce_before_shop_loop');
				woocommerce_product_loop_start();
				while ($product_loop->have_posts()) {
					$product_loop->the_post();
					wc_get_template_part('content', 'product');
				}
			} else {
				do_action('woocommerce_no_products_found');
			}
			do_action('woocommerce_after_main_content');
			wp_reset_query();
			?>
		</div>
	</div>
	<?php
		$woo = new My_woo();
		$woo->display_pagination_template_today();
		?>
	<?php get_footer(); ?>