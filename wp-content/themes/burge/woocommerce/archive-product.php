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
$cat_slug = ''; 

$categories = get_terms(array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'fields'     => 'all', 
));

foreach ($categories as $category) {
    $field_value = get_term_meta($category->term_id, '_custom_field', true);

    if ($field_value === 'yes') {
        $cat_slug = $category->slug;
    }
}

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
            <h3 class="entry-title-main"><?php woocommerce_page_title(); ?></h3>
        </div>
    </div>
<?php endif; ?>
<div class="main-content-inner <?php echo esc_attr($div_class); ?>">

    <div id="main-content" class="main-content <?php echo esc_attr(tmpmela_page_layout()); ?> <?php echo esc_attr($div_class); ?>">
        <?php do_action('woocommerce_before_main_content'); ?>
        <?php if(is_search()) {
            echo do_shortcode('[template_count_search]');
        } elseif(is_product_category($cat_slug)) {
            echo do_shortcode('[template_count_category_selected]');
        } elseif(is_post_type_archive('product') || is_product_category()
        && !is_product_category($cat_slug))  {
            echo do_shortcode('[template_count]');
        }
        ?>
        <?php echo do_shortcode('[filters_category]'); ?>
        <?php 
        if (have_posts()) {
            do_action('woocommerce_before_shop_loop');
            woocommerce_product_loop_start();
            while (have_posts()) {
                the_post();
                wc_get_template_part('content', 'product');
            }
        } else {
            do_action('woocommerce_no_products_found');
        }
        do_action('woocommerce_after_main_content');
        wp_reset_query();
        ?>
    </div>
    <?php
    $woo = new My_woo();
    if(is_search()) {
        $woo->display_pagination_search();
    } elseif(is_product_category($cat_slug)) {
        $woo->display_pagination_template();
    } elseif(is_product_category() || is_shop() && !is_search() && !is_product_category($cat_slug)) {
		$woo->display_pagination_template_general_archive();
	}
    
    ?>
</div>
<?php get_footer(); ?>

