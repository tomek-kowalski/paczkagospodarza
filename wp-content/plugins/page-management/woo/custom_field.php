<?php


if ( ! defined( 'WPINC' ) ) {
	die;
}

class My_woo {

function __construct() {


    $this->woo_load_files();
    add_action('woocommerce_product_options_general_product_data', [$this,'recommended_this_week']);
    add_action('woocommerce_product_options_general_product_data', [$this,'todays_promo']);
    add_action('woocommerce_process_product_meta', [$this,'save_custom_field_value']);
    add_action('product_cat_edit_form_fields', [$this,'add_category_custom_fields']);
    add_action('edited_term', [$this, 'save_category_custom_fields'], 10, 3);
    add_filter('vc_grid_item_shortcodes', [$this, 'my_module_add_grid_shortcodes'], 10);
    add_action('vc_grid_item_shortcodes', [$this,'this_week_add_grid_shortcodes'],10);
    add_action('vc_grid_item_shortcodes', [$this,'today_add_grid_shortcodes'],10);
    add_action('wp_ajax_adding_item', [$this,'adding_item']);
    add_action('wp_ajax_nopriv_adding_item', [$this,'adding_item']);
    add_action('wp_enqueue_scripts', [$this,'ajax_script']);
    add_shortcode('button_recommended_this_week', [$this,'button_recommended_this_week_function'],10);
    add_shortcode('category_button', [$this, 'selected_category_button_shortcode'], 10);
    add_shortcode('button_recommended_today', [$this,'button_recommended_today_function'],10);
    add_shortcode('button_blog', [$this,'button_blog_function'],10);
    add_shortcode('button_certified', [$this,'button_certified_function'],10);
    add_shortcode('recommended_products', [$this, 'recommended_products_shortcode']);
    add_shortcode('recommended_products_today', [$this, 'recommended_products_today_shortcode']);
    add_shortcode('recommended_products_2', [$this, 'recommended_products_shortcode_2']);
    add_shortcode('recommended_products_today_2', [$this, 'recommended_products_today_shortcode_2']);
    add_shortcode('selected_category', [$this, 'selected_category_shortcode']);
    add_shortcode('front_certified',[$this, 'my_certified_front']);
    add_shortcode('front_certified_mobile',[$this, 'my_certified_mobile']);
    add_shortcode('front_images',[$this, 'my_images_front']);
    add_shortcode('filters_category',[$this, 'my_dropdown_function']);
    add_shortcode('template_count',[$this, 'template_count']);
    add_shortcode('template_count_archive',[$this, 'template_count_archive']);
    add_shortcode('template_count_today',[$this, 'template_count_today']);
    add_shortcode('template_count_search',[$this, 'template_count_search']);
    add_shortcode('template_count_category_selected',[$this, 'template_count_category_selected']);
    add_filter('woocommerce_loop_add_to_cart_link', [$this,'remove_add_to_cart_button'], 10, 2);
    add_filter('loop_shop_columns', [$this,'custom_wc_category_columns']);
    add_action('woocommerce_loop_add_to_cart_link', [$this,'add_to_cart_button_to_products_template'], 10, 3);
    add_filter('loop_shop_per_page', [$this,'product_pagination_by_category']);
    add_filter('woocommerce_breadcrumb_defaults', [$this,'custom_change_breadcrumb_home_text']);
    add_action('wp_ajax_custom_product_filter', [$this, 'custom_product_filter']);
    add_action('wp_ajax_nopriv_custom_product_filter', [$this, 'custom_product_filter']);    
    add_action('wp_ajax_display_pagination', [$this, 'display_pagination']);
    add_action('wp_ajax_nopriv_display_pagination', [$this, 'display_pagination']); 

    add_action('wp_ajax_custom_product_archive_filter', [$this, 'custom_product_archive_filter']);
    add_action('wp_ajax_nopriv_custom_product_archive_filter', [$this, 'custom_product_archive_filter']);    
    add_action('wp_ajax_display_pagination_archive', [$this, 'display_pagination_archive']);
    add_action('wp_ajax_nopriv_display_pagination_archive', [$this, 'display_pagination_archive']); 
    add_action('wp_ajax_template_count_ajax_archive', [$this, 'template_count_ajax_archive']);
    add_action('wp_ajax_nopriv_template_count_ajax_archive', [$this, 'template_count_ajax_archive']); 
    add_action('wp_ajax_custom_product_filter_today', [$this, 'custom_product_filter_today']);
    add_action('wp_ajax_nopriv_custom_product_filter_today', [$this, 'custom_product_filter_today']);    

    add_action('wp_ajax_template_count_ajax', [$this, 'template_count_ajax']);
    add_action('wp_ajax_nopriv_template_count_ajax', [$this, 'template_count_ajax']); 
    add_action('wp_ajax_custom_product_general_archive_filter', [$this, 'custom_product_general_archive_filter']);
    add_action('wp_ajax_nopriv_custom_product_general_archive_filter', [$this, 'custom_product_general_archive_filter']);   
    add_action('wp_ajax_display_pagination_general_archive', [$this, 'display_pagination_general_archive']);
    add_action('wp_ajax_nopriv_display_pagination_general_archive', [$this, 'display_pagination_general_archive']);
    
    add_action('wp_ajax_display_pagination_today', [$this, 'display_pagination_today']);
    add_action('wp_ajax_nopriv_display_pagination_today', [$this, 'display_pagination_today']); 
    add_action('wp_ajax_template_count_ajax_today', [$this, 'template_count_ajax_today']);
    add_action('wp_ajax_nopriv_template_count_ajax_today', [$this, 'template_count_ajax_today']); 

    add_action('wp_ajax_template_count_ajax_search', [$this, 'template_count_ajax_search']);
    add_action('wp_ajax_nopriv_template_count_ajax_search', [$this, 'template_count_ajax_search']); 
    add_action('wp_ajax_template_count_ajax_category_selected', [$this, 'template_count_ajax_category_selected']);
    add_action('wp_ajax_nopriv_template_count_ajax_category_selected', [$this, 'template_count_ajax_category_selected']); 

    add_action('wp_ajax_custom_product_search_filter', [$this, 'custom_product_search_filter']);
    add_action('wp_ajax_nopriv_custom_product_search_filter', [$this, 'custom_product_search_filter']);    
    add_action('wp_ajax_display_pagination_ajax_search', [$this, 'display_pagination_ajax_search']);
    add_action('wp_ajax_nopriv_display_pagination_ajax_search', [$this, 'display_pagination_ajax_search']);

    add_action('woocommerce_after_quantity_input_field', [$this, 'display_quantity_plus'],10 );
    add_action('woocommerce_before_quantity_input_field', [$this, 'display_quantity_minus' ],10 );
    add_action('wp_footer', [$this, 'add_cart_quantity_plus_minus' ]);
    add_action('init', [$this, 'remove_woocommerce_rating']);
    add_action( 'woocommerce_after_add_to_cart_button', [$this,'price_based_on_quantity_on_single'] );
    add_filter( 'woocommerce_product_single_add_to_cart_text', [$this,'change_add_to_cart_button_text'] );
}


public function change_add_to_cart_button_text( $text ) {
    return __( 'Dodaj do koszyka', 'page_manage' ); 
}


public function price_based_on_quantity_on_single() {
    if (is_product()) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var originalPriceHtml = $('.summary.entry-summary .price .woocommerce-Price-amount').html();
                var currencySymbolHtml = $('.summary.entry-summary .price .woocommerce-Price-currencySymbol').html();
                var originalPrice = parseFloat(originalPriceHtml.replace(/[^\d.,]/g, '').replace(',', '.'));

                var salePriceHtml = $('.summary.entry-summary .price ins .woocommerce-Price-amount').html();
                var salePrice = salePriceHtml ? parseFloat(salePriceHtml.replace(/[^\d.,]/g, '').replace(',', '.')) : 0;

                var priceToUse = salePrice > 0 ? salePrice : originalPrice;
                var priceElementToUpdate = salePrice > 0 ? '.summary.entry-summary .price ins .woocommerce-Price-amount' : '.summary.entry-summary .price .woocommerce-Price-amount';

                function updatePriceOnQuantityChange() {
                    var cxc_qty = parseInt($(this).val());

                    if (isNaN(priceToUse)) {
                        var toUsePriceHtml = salePrice > 0 ? $('.summary.entry-summary .price ins .woocommerce-Price-amount').html() : $('.summary.entry-summary .price .woocommerce-Price-amount').html();
                        priceToUse = parseFloat(toUsePriceHtml.replace(/[^\d.,]/g, '').replace(',', '.'));
                    }

                    var modifiedPrice = (priceToUse * cxc_qty).toFixed(2);
                    var formattedPrice = '<span class="woocommerce-Price-amount amount"><bdi>' + modifiedPrice.replace('.', ',') + '&nbsp;<span class="woocommerce-Price-currencySymbol">' + currencySymbolHtml + '</span></bdi></span>';

                    $(priceElementToUpdate).html(formattedPrice);
                }

                $(document).on('change', '.quantity input[name=quantity]', updatePriceOnQuantityChange);

            });
        </script>
        <?php
    }
}


public function remove_woocommerce_rating() {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
}

public function display_quantity_plus() {
    echo '<button type="button" class="plus">+</button>';
}

public function display_quantity_minus() {
    echo '<button type="button" class="minus">-</button>';
}

public function add_cart_quantity_plus_minus() {
    if ( ! is_product() && ! is_cart() ) {
        return;
    }
    wc_enqueue_js(
        "$(document).on( 'click', 'button.plus, button.minus', function() {
            var qty = $( this ).parent( '.quantity' ).find( '.qty' );
            var val = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( max <= val ) ) {
                qty.val( max ).change();
                } else {
                qty.val( val + step ).change();
                }
            } else {
                if ( min && ( min >= val ) ) {
                qty.val( min ).change();
                } else if ( val > 1 ) {
                qty.val( val - step ).change();
                }
            }
        });"
    );
}

public function template_count_search() {
    ?>
    <p class="woocommerce-result-count">
        <?php
        $current = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
        $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
        $this_args = $this->get_product_query_search_args($current, $search_query); 
        
        $wp_query = new WP_Query($this_args);

        $total_products = $wp_query->found_posts;


        $per_page = $wp_query->get('posts_per_page');
        wp_reset_postdata();

        if (1 === intval($total_products)) {
            _e('Dostępne lokalne produkty', 'woocommerce');
        } elseif ( $total_products <= $per_page || -1 === $per_page )  {
            printf(_n('Dostępne lokalne produkty', 'Dostępne %d lokalne produkty', $total_products, 'woocommerce'), $total_products);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last = min($total_products, $per_page * $current);
            printf(_nx('Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', 'Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', $total_products, 'with first and last result', 'woocommerce'), $first, $last, $total_products);
        }
        ?>
    </p>
    <?php
}

public function template_count_ajax_search() {
    ?>
    <p class="woocommerce-result-count">
        <?php
        $current = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $search_query = isset($_POST['search_query']) ? sanitize_text_field($_POST['search_query']) : '';
        $this_args = $this->get_product_query_search_args_to_ajax($current, $search_query); 
        
        $wp_query = new WP_Query($this_args);
        $total_products = $wp_query->found_posts;
        $per_page = $wp_query->get('posts_per_page');
        wp_reset_postdata();

        if (1 === intval($total_products)) {
            _e('Dostępne lokalne produkty', 'woocommerce');
        } elseif ($total_products <= $per_page || -1 === $per_page) {
            printf(_n('Dostępne lokalne produkty', 'Dostępne %d lokalne produkty', $total_products, 'woocommerce'), $total_products);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last = min($total_products, $per_page * $current);
            printf(
                _nx(
                    'Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty',
                    'Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty',
                    $total_products,
                    'with first and last result',
                    'woocommerce'
                ),
                $first,
                $last,
                $total_products
            );
        }
        ?>
    </p>
    <?php
    die();
}

public function get_product_query_search_args($paged, $search_query) { 

    $select = isset($_POST['select']) ? $_POST['select'] :'menu_order';
    $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
    
    if ($select === 'date') {
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'orderby'        => 'date',
            'order'          => 'DESC',
            's'              => $search_query,
        );
    } else {
        $meta_key = $this->get_meta_key();
        $order = $this->get_order();
        
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'meta_key'       => $meta_key,
            's'              => $search_query,
            'orderby'        => array(
                'menu_order'      => 'ASC',
                'meta_value_num'  => $meta_key === 'menu_order' ? 'ASC' : $order,
            ),
        );
    }
}

public function get_product_query_search_args_to_ajax($paged, $search_query) { 
    $select = isset($_POST['select']) ? $_POST['select'] : 'menu_order';
    $search_query = isset($_POST['search_query']) ? sanitize_text_field($_POST['search_query']) : '';

    $meta_key = $this->get_meta_key();
    $order = $this->get_order();
    $orderby = array(
        'menu_order' => 'ASC',
        'meta_value_num' => $meta_key === 'menu_order' ? 'ASC' : $order,
    );

    if ($select === 'date') {
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'orderby'        => 'date',
            'order'          => 'DESC',
            's'              => $search_query,
        );
    } else {
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'meta_key'       => $meta_key,
            'orderby'        => $orderby,
            's'              => $search_query,
        );
    }
}

public function display_pagination_search() {
    $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
    $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    $this_args = $this-> get_product_query_search_args($paged, $search_query );
    $wp_query = new WP_Query($this_args);

    $prev_arrow = '&larr;';
    $next_arrow = '&rarr;';
    $big        = 999999999; 

    $args = array(
        'base'         => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'       => '?paged=%#%',
        'current'      => $paged,
        'aria_current' => 'page',
        'total'        => $wp_query->max_num_pages,
        'type'         => 'list',
        'prev_text'    => $prev_arrow,
        'next_text'    => $next_arrow,
    );

    $pagination = paginate_links($args);

    if (!empty($pagination)) {
        echo '<nav class="woocommerce-pagination"><ul class="page-numbers">';
        echo $pagination;
        echo '</ul></nav>';
    }
    wp_reset_query();
}

public function display_pagination_ajax_search() {
    $paged = isset($_POST['pagedPagination']) ? intval($_POST['pagedPagination']) : 1;
    $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    $this_args = $this-> get_product_query_search_args_to_ajax($paged, $search_query );
    $wp_query = new WP_Query($this_args);

   

    $prev_arrow = '&larr;';
    $next_arrow = '&rarr;';
    $big        = 999999999; 

    $args = array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'aria_current' => 'page',
        'total'     => $wp_query->max_num_pages,
        'type'      => 'list',
        'prev_text' => $prev_arrow,
        'next_text' => $next_arrow,
    );

    $pagination = paginate_links($args);

    if (!empty($pagination)) {
        echo '<nav class="woocommerce-pagination"><ul class="page-numbers">';
        echo $pagination;
        echo '</ul></nav>';
    }
    wp_reset_query();

    die();
}



public function template_count_ajax_today() {
    ?>
    <p class="woocommerce-result-count">
        <?php
        $current = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $this_args = $this->get_product_query_today_args($current); 
        $wp_query = new WP_Query($this_args);
        $total_products = $wp_query->found_posts;
        $per_page = $wp_query->get('posts_per_page');
        wp_reset_postdata();

        if (1 === intval($total_products)) {
            _e('Dostępne lokalne produkty', 'woocommerce');
        } elseif ( $total_products <= $per_page || -1 === $per_page )  {
            printf(_n('Dostępne lokalne produkty', 'Dostępne %d lokalne produkty', $total_products, 'woocommerce'), $total_products);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last = min($total_products, $per_page * $current);
            printf(_nx('Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', 'Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', $total_products, 'with first and last result', 'woocommerce'), $first, $last, $total_products);
        }
        ?>
    </p>
    <?php
    die();
}

public function template_count_today() {
    ?>
    <p class="woocommerce-result-count">
        <?php
        $current = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $this_args = $this->get_product_query_today_args($current); 
        $wp_query = new WP_Query($this_args);
        $total_products = $wp_query->found_posts;
        $per_page = $wp_query->get('posts_per_page');
        wp_reset_postdata();

        if (1 === intval($total_products)) {
            _e('Dostępne lokalne produkty', 'woocommerce');
        } elseif ( $total_products <= $per_page || -1 === $per_page )  {

            printf(_n('Dostępne lokalne produkty', 'Dostępne %d lokalne produkty', $total_products, 'woocommerce'), $total_products);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last = min($total_products, $per_page * $current);
            printf(_nx('Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', 'Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', $total_products, 'with first and last result', 'woocommerce'), $first, $last, $total_products);
        }
        ?>
    </p>
    <?php
}

public function template_count_ajax_archive() {
    ?>
    <p class="woocommerce-result-count">
        <?php
        $current = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $this_args = $this->get_product_query_this_week_args($current); 
        $wp_query = new WP_Query($this_args);
        $total_products = $wp_query->found_posts;
        $per_page = $wp_query->get('posts_per_page');
        wp_reset_postdata();

        if (1 === intval($total_products)) {
            _e('Dostępne lokalne produkty', 'woocommerce');
        } elseif ( $total_products <= $per_page || -1 === $per_page )  {
            printf(_n('Dostępne lokalne produkty', 'Dostępne %d lokalne produkty', $total_products, 'woocommerce'), $total_products);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last = min($total_products, $per_page * $current);
            printf(_nx('Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', 'Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', $total_products, 'with first and last result', 'woocommerce'), $first, $last, $total_products);
        }
        ?>
    </p>
    <?php
    die();
}

public function template_count_archive() {
    ?>
    <p class="woocommerce-result-count">
        <?php
        $current = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $this_args = $this->get_product_query_this_week_args($current); 
        $wp_query = new WP_Query($this_args);
        $total_products = $wp_query->found_posts;
        $per_page = $wp_query->get('posts_per_page');
        wp_reset_postdata();

        if (1 === intval($total_products)) {
            _e('Dostępne lokalne produkty', 'woocommerce');
        } elseif ( $total_products <= $per_page || -1 === $per_page )  {

            printf(_n('Dostępne lokalne produkty', 'Dostępne %d lokalne produkty', $total_products, 'woocommerce'), $total_products);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last = min($total_products, $per_page * $current);
            printf(_nx('Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', 'Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', $total_products, 'with first and last result', 'woocommerce'), $first, $last, $total_products);
        }
        ?>
    </p>
    <?php
}

public function template_count_ajax() {
    ?>
    <p class="woocommerce-result-count">
        <?php
        $current = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $this_args = $this->get_product_general_archive_ajax_query_args($current); 
        $wp_query = new WP_Query($this_args);

        $total_products = $wp_query->found_posts;
        $per_page = $wp_query->get('posts_per_page');
        wp_reset_postdata();

        if (1 === intval($total_products)) {
            _e('Dostępne lokalne produkty', 'woocommerce');
        } elseif ( $total_products <= $per_page || -1 === $per_page )  {
            printf(_n('Dostępne lokalne produkty', 'Dostępne %d lokalne produkty', $total_products, 'woocommerce'), $total_products);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last = min($total_products, $per_page * $current);
            printf(_nx('Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', 'Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', $total_products, 'with first and last result', 'woocommerce'), $first, $last, $total_products);
        }
        ?>
    </p>
    <?php
    die();
}

public function template_count() {
    ?>
    <p class="woocommerce-result-count">
        <?php
        $current = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $this_args = $this->get_product_general_archive_query_args($current); 
        $wp_query = new WP_Query($this_args);
        $total_products = $wp_query->found_posts;
        $per_page = $wp_query->get('posts_per_page');
        wp_reset_postdata();

        if (1 === intval($total_products)) {
            _e('Dostępne lokalne produkty', 'woocommerce');
        } elseif ( $total_products <= $per_page || -1 === $per_page )  {

            printf(_n('Dostępne lokalne produkty', 'Dostępne %d lokalne produkty', $total_products, 'woocommerce'), $total_products);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last = min($total_products, $per_page * $current);
            printf(_nx('Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', 'Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', $total_products, 'with first and last result', 'woocommerce'), $first, $last, $total_products);
        }
        ?>
    </p>
    <?php
}

public function template_count_ajax_category_selected() {
    ?>
    <p class="woocommerce-result-count">
        <?php
        $current = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $this_args = $this->get_product_query_args($current); 
        $wp_query = new WP_Query($this_args);
        $total_products = $wp_query->found_posts;
        $per_page = $wp_query->get('posts_per_page');
        wp_reset_postdata();

        if (1 === intval($total_products)) {
            _e('Dostępne lokalne produkty', 'woocommerce');
        } elseif ( $total_products <= $per_page || -1 === $per_page )  {
            printf(_n('Dostępne lokalne produkty', 'Dostępne %d lokalne produkty', $total_products, 'woocommerce'), $total_products);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last = min($total_products, $per_page * $current);
            printf(_nx('Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', 'Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', $total_products, 'with first and last result', 'woocommerce'), $first, $last, $total_products);
        }
        ?>
    </p>
    <?php
    die();
}

public function template_count_category_selected() {
    ?>
    <p class="woocommerce-result-count">
        <?php
        $current = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $this_args = $this->get_product_query_args($current); 
        $wp_query = new WP_Query($this_args);
        $total_products = $wp_query->found_posts;
        $per_page = $wp_query->get('posts_per_page');
        wp_reset_postdata();

        if (1 === intval($total_products)) {
            _e('Dostępne lokalne produkty', 'woocommerce');
        } elseif ( $total_products <= $per_page || -1 === $per_page )  {

            printf(_n('Dostępne lokalne produkty', 'Dostępne %d lokalne produkty', $total_products, 'woocommerce'), $total_products);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last = min($total_products, $per_page * $current);
            printf(_nx('Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', 'Dostępne %1$d&ndash;%2$d / %3$d lokalne produkty', $total_products, 'with first and last result', 'woocommerce'), $first, $last, $total_products);
        }
        ?>
    </p>
    <?php
}
public function custom_product_search_filter() {
    check_admin_referer('custom_product_filter', 'nonce');
    $search_query = sanitize_text_field($_POST['search_query']);
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    
    if (isset($_POST['select']) && isset($search_query)) {
        $args = $this->get_product_query_search_args_to_ajax($paged, $search_query);
        $this->process_product_query($args);
    }
    
    wp_die();
} 

public function custom_product_filter() {
    check_admin_referer('custom_product_filter', 'nonce');
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    
    if (isset($_POST['select'])) {
        $args = $this->get_product_query_args($paged);
        $this->process_product_query($args);
    }
    
    die();
}    

public function custom_product_general_archive_filter() {
    check_admin_referer('custom_product_filter', 'nonce');
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    
    if (isset($_POST['select'])) {
        $args = $this->get_product_general_archive_ajax_query_args($paged);
        $this->process_product_query($args);
    }
    
    die();
} 

public function custom_product_archive_filter() {
    check_admin_referer('custom_product_filter', 'nonce');
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    
    if (isset($_POST['select'])) {
        $args = $this->get_product_query_this_week_args($paged);
        $this->process_product_query($args);
    }
    
    die();
}  

public function custom_product_filter_today() {
    check_admin_referer('custom_product_filter', 'nonce');
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    
    if (isset($_POST['select'])) {
        $args = $this->get_product_query_today_args($paged);
        $this->process_product_query($args);
    }
    
    die();
}

private function get_product_query_today_args($paged) { 

    $select = isset($_POST['select']) ? $_POST['select'] :'menu_order';
    
    if ($select === 'date') {
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'meta_query'     => array(array(
                'key'     => '_todays_promo',
                'value'   => 'yes',
                'compare' => '=',
                ),
            ),
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
    } else {
        $meta_key = $this->get_meta_key();
        $order = $this->get_order();
        
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'meta_query'     => array(array(
                'key'     => '_todays_promo',
                'value'   => 'yes',
                'compare' => '=',
                ),
            ),
            'meta_key'       => $meta_key,
            'orderby'        => array(
                'menu_order'      => 'ASC',
                'meta_value_num'  => $meta_key === 'menu_order' ? 'ASC' : $order,
            ),
        );
    }
}

private function get_product_query_this_week_args($paged) { 

    $select = isset($_POST['select']) ? $_POST['select'] :'menu_order';
    
    if ($select === 'date') {
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'meta_query'     => array(array(
                'key'     => '_recommended_this_week',
                'value'   => 'yes',
                'compare' => '=',
                ),
            ),
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
    } else {
        $meta_key = $this->get_meta_key();
        $order = $this->get_order();
        
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'meta_query'     => array(array(
                'key'     => '_recommended_this_week',
                'value'   => 'yes',
                'compare' => '=',
                ),
            ),
            'meta_key'       => $meta_key,
            'orderby'        => array(
                'menu_order'      => 'ASC',
                'meta_value_num'  => $meta_key === 'menu_order' ? 'ASC' : $order,
            ),
        );
    }
}

private function get_product_query_args($paged) {
    $cat_id = $this->get_category_id_with_custom_field();

    $select = isset($_POST['select']) ? $_POST['select'] :'menu_order';
    
    if ($select === 'date') {
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $cat_id,
                ),
            ),
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
    } else {
        $meta_key = $this->get_meta_key();
        $order = $this->get_order();
        
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $cat_id,
                ),
            ),
            'meta_key'       => $meta_key,
            'orderby'        => array(
                'menu_order'      => 'ASC',
                'meta_value_num'  => $meta_key === 'menu_order' ? 'ASC' : $order,
            ),
        );
    }
}

private function get_product_general_archive_query_args($paged) {
    global $wp_query;
    $category = $wp_query->get_queried_object(); 
    $cat_id = '';
    if($category) {
        $cat_id = $category->term_id;
    }
    $select = isset($_POST['select']) ? sanitize_text_field($_POST['select']) : 'menu_order';
    
    if ($select === 'date') {
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $cat_id,
                ),
            ),
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
    } else {
        $meta_key = $this->get_meta_key();
        $order = $this->get_order();
        
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $cat_id,
                ),
            ),
            'meta_key'       => $meta_key,
            'orderby'        => array(
                'menu_order'      => 'ASC',
                'meta_value_num'  => $meta_key === 'menu_order' ? 'ASC' : $order,
            ),
        );
    }
}

private function get_product_general_archive_ajax_query_args($paged) {
    $cat_id = isset($_POST['termId']) ? sanitize_text_field($_POST['termId']) : '0';

    $select = isset($_POST['select']) ? sanitize_text_field($_POST['select']) : 'menu_order';
    
    if ($select === 'date') {
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $cat_id,
                ),
            ),
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
    } else {
        $meta_key = $this->get_meta_key();
        $order = $this->get_order();
        
        return array(
            'post_type'      => 'product',
            'post_status'    => 'publish',  
            'paged'          => $paged,
            'posts_per_page' => 16,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $cat_id,
                ),
            ),
            'meta_key'       => $meta_key,
            'orderby'        => array(
                'menu_order'      => 'ASC',
                'meta_value_num'  => $meta_key === 'menu_order' ? 'ASC' : $order,
            ),
        );
    }
}


private function process_product_query($args) {
    $query = new WP_Query($args);
    $product_output = '';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ob_start();
            wc_get_template_part('content', 'product');
            $product_output .= ob_get_clean();
        }

    }
    wp_reset_postdata();
    wp_reset_query();

    if (($product_output)) {
        echo $product_output;
    }
    die();
}

private function get_meta_key() {
    $select = isset($_POST['select']) ? $_POST['select'] : '';

    switch ($select) {
        case 'popularity':
            return 'total_sales';
        case 'rating':
            return '_wc_average_rating';
        case 'price':
        case 'price_desc':
            return '_price';
        default:
            return '';
    }
}

private function get_order() {
    $select = isset($_POST['select']) ? $_POST['select'] : '';
    if ($select === 'rating' || $select === 'price_desc') {
        return 'DESC';
    } else {
        return 'ASC';
    }
}


public function display_pagination_today() {
    $paged = isset($_POST['pagedPagination']) ? intval($_POST['pagedPagination']) : 1;

    $this_args = $this-> get_product_query_today_args($paged);
    $wp_query = new WP_Query($this_args);

    $prev_arrow = '&larr;';
    $next_arrow = '&rarr;';
    $big        = 999999999; 

    $args = array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'aria_current' => 'page',
        'total'     => $wp_query->max_num_pages,
        'type'      => 'list',
        'prev_text' => $prev_arrow,
        'next_text' => $next_arrow,
    );

    $pagination = paginate_links($args);

    if (!empty($pagination)) {
        echo $pagination;
    }
    wp_reset_query();

    die();
}

public function display_pagination_template_today() {
    $paged = isset($_POST['pagedPagination']) ? intval($_POST['pagedPagination']) : 1;

    $this_args = $this-> get_product_query_today_args($paged);
    $wp_query = new WP_Query($this_args);

    $prev_arrow = '&larr;';
    $next_arrow = '&rarr;';
    $big        = 999999999; 

    $args = array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'aria_current' => 'page',
        'total'     => $wp_query->max_num_pages,
        'type'      => 'list',
        'prev_text' => $prev_arrow,
        'next_text' => $next_arrow,
    );

    $pagination = paginate_links($args);

    if (!empty($pagination)) {
        echo '<nav class="woocommerce-pagination"><ul class="page-numbers">';
        echo $pagination;
        echo '</ul></nav>';
    }
    wp_reset_query();
}

public function display_pagination_archive() {
    $paged = isset($_POST['pagedPagination']) ? intval($_POST['pagedPagination']) : 1;

    $this_args = $this-> get_product_query_this_week_args($paged);
    $wp_query = new WP_Query($this_args);

    $prev_arrow = '&larr;';
    $next_arrow = '&rarr;';
    $big        = 999999999; 

    $args = array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'aria_current' => 'page',
        'total'     => $wp_query->max_num_pages,
        'type'      => 'list',
        'prev_text' => $prev_arrow,
        'next_text' => $next_arrow,
    );

    $pagination = paginate_links($args);

    if (!empty($pagination)) {
        echo $pagination;
    }
    wp_reset_query();

    die();
}

public function display_pagination_template_archive() {
    $paged = isset($_POST['pagedPagination']) ? intval($_POST['pagedPagination']) : 1;

    $this_args = $this-> get_product_query_this_week_args($paged);
    $wp_query = new WP_Query($this_args);

    $prev_arrow = '&larr;';
    $next_arrow = '&rarr;';
    $big        = 999999999; 

    $args = array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'aria_current' => 'page',
        'total'     => $wp_query->max_num_pages,
        'type'      => 'list',
        'prev_text' => $prev_arrow,
        'next_text' => $next_arrow,
    );

    $pagination = paginate_links($args);

    if (!empty($pagination)) {
        echo '<nav class="woocommerce-pagination"><ul class="page-numbers">';
        echo $pagination;
        echo '</ul></nav>';
    }
    wp_reset_query();
}


public function display_pagination_general_archive() {
    $paged = isset($_POST['pagedPagination']) ? intval($_POST['pagedPagination']) : 1;

    $this_args = $this-> get_product_general_archive_ajax_query_args($paged);
    $wp_query = new WP_Query($this_args);

    error_log('1');

    $prev_arrow = '&larr;';
    $next_arrow = '&rarr;';
    $big        = 999999999; 

    $args = array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'aria_current' => 'page',
        'total'     => $wp_query->max_num_pages,
        'type'      => 'list',
        'prev_text' => $prev_arrow,
        'next_text' => $next_arrow,
    );

    $pagination = paginate_links($args);

    if (!empty($pagination)) {
        echo $pagination;
    }
    wp_reset_query();

    die();
}

public function display_pagination_template_general_archive() {
    $paged = isset($_POST['pagedPagination']) ? intval($_POST['pagedPagination']) : 1;

    $this_args = $this-> get_product_general_archive_query_args($paged);
    $wp_query = new WP_Query($this_args);

    $prev_arrow = '&larr;';
    $next_arrow = '&rarr;';
    $big        = 999999999; 

    $args = array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'aria_current' => 'page',
        'total'     => $wp_query->max_num_pages,
        'type'      => 'list',
        'prev_text' => $prev_arrow,
        'next_text' => $next_arrow,
    );

    $pagination = paginate_links($args);

    if (!empty($pagination)) {
        echo '<nav class="woocommerce-pagination"><ul class="page-numbers">';
        echo $pagination;
        echo '</ul></nav>';
    }
    wp_reset_query();
}

public function display_pagination() {
    $paged = isset($_POST['pagedPagination']) ? intval($_POST['pagedPagination']) : 1;

    $this_args = $this-> get_product_query_args($paged);
    $wp_query = new WP_Query($this_args);

    $prev_arrow = '&larr;';
    $next_arrow = '&rarr;';
    $big        = 999999999; 

    $args = array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'aria_current' => 'page',
        'total'     => $wp_query->max_num_pages,
        'type'      => 'list',
        'prev_text' => $prev_arrow,
        'next_text' => $next_arrow,
    );

    $pagination = paginate_links($args);

    if (!empty($pagination)) {
        echo $pagination;
    }
    wp_reset_query();

    die();
}

public function display_pagination_template() {
    $paged = isset($_POST['pagedPagination']) ? intval($_POST['pagedPagination']) : 1;

    $this_args = $this-> get_product_query_args($paged);
    $wp_query = new WP_Query($this_args);

    $prev_arrow = '&larr;';
    $next_arrow = '&rarr;';
    $big        = 999999999; 

    $args = array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'aria_current' => 'page',
        'total'     => $wp_query->max_num_pages,
        'type'      => 'list',
        'prev_text' => $prev_arrow,
        'next_text' => $next_arrow,
    );

    $pagination = paginate_links($args);

    if (!empty($pagination)) {
        echo '<nav class="woocommerce-pagination"><ul class="page-numbers">';
        echo $pagination;
        echo '</ul></nav>';
    }
    wp_reset_query();
}

public function my_dropdown_function() {
    $output = '';
    $output .= '<form method="post" class="border" action="' . admin_url('admin-ajax.php') . '">';
    $output .= wp_nonce_field('custom_product_filter', 'nonce', true, false);
    $output .= '<input name="action" value="custom_product_filter" type="hidden">';
    $output .= '<div class="my-custom-select">';
    $output .= '<select class="select-filter">';
    $output .= '<option value="menu_order" selected>Dostępne</option>';
    $output .= '<option value="popularity">Najpopularniejsze</option>';
    $output .= '<option value="rating">Najlepiej ocenione</option>';
    $output .= '<option value="date">Ostatnio dodane</option>';
    $output .= '<option value="price">Od Najtańszych</option>';
    $output .= '<option value="price_desc">Od Najdroższych</option>';
    $output .= '</select>';
    $output .= '</div>';
    $output .= '</form>';

    echo $output;
}

public function custom_change_breadcrumb_home_text($defaults) {
    $defaults['home'] = 'Sklep ';
    return $defaults;
}


public function product_pagination_by_category() {
    $limit = 16;

    if( is_product_category() ) {
        $limit = 16;
    }

    return $limit;
}

public function custom_wc_category_columns($columns) {
    return 4; 
}

function remove_add_to_cart_button($link, $product) {
    if ($product->is_type('simple')) {
        return '';
    }
    return $link;
}

public function woo_load_files() 
{
    require_once( PM_PATH. 'woo/templates.php');
}

public function my_images_front() {
    require_once( PM_PATH. 'extra-functions/my-images.php' );
}

public function my_certified_mobile() {
    require_once( PM_PATH. 'extra-functions/certified_front_mobile.php' );
}
public function my_certified_front() {
    require_once( PM_PATH. 'extra-functions/custom_functions.php' );
}

public function ajax_script() {

    if (is_product_category($this->get_category_id_with_custom_field())) {
		wp_enqueue_script('woo-category-ajax', PM_URL . '/assets/js/woo-category-ajax.js', array(), null, false);

        wp_localize_script('woo-category-ajax', 'filterCat', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('custom_product_filter'),
        ));
	}

    if (is_product_category() && !is_product_category($this->get_category_id_with_custom_field()) ) {
		wp_enqueue_script('woo-all-category-ajax', PM_URL . '/assets/js/woo-all-category-ajax.js', array(), null, false);

        wp_localize_script('woo-all-category-ajax', 'filterCatAll', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('custom_product_filter'),
        ));
	}

    if (is_post_type_archive('polecane-w-tygodniu')) {
		wp_enqueue_script('woo-archive-ajax', PM_URL . '/assets/js/woo-archive-ajax.js', array(), null, false);

        wp_localize_script('woo-archive-ajax', 'filterCatArchive', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('custom_product_filter'),
        ));
	}

    if (is_post_type_archive('dzis-w-promocji')) {
		wp_enqueue_script('woo-archive-today-ajax', PM_URL . '/assets/js/woo-archive-today-ajax.js', array(), null, false);

        wp_localize_script('woo-archive-today-ajax', 'filterCatToday', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('custom_product_filter'),
        ));
	}

    if (is_search()) {
		wp_enqueue_script('woo-search-ajax', PM_URL . '/assets/js/woo-search-ajax.js', array(), null, false);

        wp_localize_script('woo-search-ajax', 'filterCatSearch', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('custom_product_filter'),
        ));
	}

    if(is_front_page()) {
        wp_enqueue_script('woo-scripts', PM_URL . 'assets/js/ajax_script.js',array(),null, false);

        wp_localize_script( 'woo-scripts', 'toTheCart', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ) );
    }
}

public function adding_item() {

    if (isset($_POST['product_id'])) {
        $product_id = absint($_POST['product_id']);
        $product = wc_get_product($product_id);
        //error_log($product_id);

        if ($product) {
            WC()->cart->add_to_cart($product_id);
            wp_send_json_success(array('message' => 'Product added to cart successfully.'));
        } else {
            wp_send_json_error(array('message' => 'Product cannot be added to cart.'));
        }
    } else {
            wp_send_json_error(array('message' => 'Invalid request. Product ID not provided.'));
    }
    die();
}

public function today_add_grid_shortcodes( $shortcodes ) {
    $shortcodes['button_recommended_today'] = array(
        'name'         => __( 'Selected todays products button', 'burge' ),
        'base'         => 'button_recommended_today',
        'category'     => __( 'Content', 'burge' ),
        'description'  => __( 'Button for todays products', 'burge' ),
        'post_type'    => Vc_Grid_Item_Editor::postType(),
    );
    return $shortcodes;
}

public function button_blog_function() {
    $template_link = site_url('/blog');
    $output = '<div class="button-frame-blog">';
    $output .= '<h3>' . __('Poczytaj naszego bloga','burge') . '</h3>';
    $output .= '<a class="button-front" href="' . $template_link . '">' . __('Zobacz wszystko', 'woocommerce') . '</a>';
    $output .= '</div>';

    return $output;
}


public function button_recommended_today_function() {
    $template_link = get_post_type_archive_link('dzis-w-promocji');
    $output = '<div class="button-frame">';
    $output .= '<h3>' . __('Dziś w promocji','burge') . '</h3>';
    $output .= '<a class="button-front" href="' . $template_link . '">' . __('Zobacz wszystko', 'woocommerce') . '</a>';
    $output .= '</div>';

    return $output;
}

public function button_certified_function() {
    $output = '<div class="border-title"></div>';
    $output .= '<div class="button-frame-certified">';
    $output .= '<h3>' . __('Dlaczego Warto Nam Zaufać','burge') . '</h3>';
    $output .= '</div>';

    return $output;
}

public function this_week_add_grid_shortcodes( $shortcodes ) {
    $shortcodes['button_recommended_this_week'] = array(
        'name'         => __( 'Selected this week products button', 'burge' ),
        'base'         =>   'button_recommended_this_week',
        'category'     => __( 'Content', 'burge' ),
        'description'  => __( 'Button for selected products this week', 'burge' ),
        'post_type'    => Vc_Grid_Item_Editor::postType(),
    );
    return $shortcodes;
}


public function button_recommended_this_week_function() {
    $template_link = get_post_type_archive_link('polecane-w-tygodniu');
    $output = '<div class="button-frame">';
    $output .= '<h3>' . __('Polecane w tym tygodniu','burge') . '</h3>';
    $output .= '<a class="button-front" href="' . esc_url($template_link) . '">' . __('Zobacz wszystko', 'woocommerce') . '</a>';
    $output .= '</div>';

    return $output;
}

function my_module_add_grid_shortcodes( $shortcodes ) {
    $shortcodes['category_button'] = array(
        'name'         => __( 'Selected category button', 'burge' ),
        'base'         => 'category_button',
        'category'     => __( 'Content', 'burge' ),
        'description'  => __( 'Button for selected categories', 'burge' ),
        'post_type'    => Vc_Grid_Item_Editor::postType(),
    );
    return $shortcodes;
}


public function selected_category_button_shortcode() {
    $category_id = $this->get_category_id_with_custom_field();
    $category_link = get_category_link($category_id);
    $category_name = $this->get_category_name_with_custom_field();

    $output = '<div class="button-frame">';
    $output .= '<h3>' . $category_name . '</h3>';
    $output .= '<a class="button-front" href="' . $category_link . '">' . __('Zobacz wszystko', 'woocommerce') . '</a>';
    $output .= '</div>';

    return $output;
}

public function recommended_this_week() {
    woocommerce_wp_checkbox(
        array(
            'id'          => '_recommended_this_week',
            'label'       => __('Polecane w tym tygodniu', 'woocommerce'),
            'desc_tip'    => 'true',
            'description' => __('Recommended this week.'),
        )
    );
}

public function todays_promo() {
    woocommerce_wp_checkbox(
        array(
            'id'          => '_todays_promo',
            'label'       => __('Dziś w promocji', 'woocommerce'),
            'desc_tip'    => 'true',
            'description' => __('Promoted today.'),
        )
    );
}

public function save_custom_field_value($post_id) {
    $custom_field = isset($_POST['_recommended_this_week']) ? sanitize_text_field($_POST['_recommended_this_week']) : '';
    update_post_meta($post_id, '_recommended_this_week', $custom_field);

    $custom_field = isset($_POST['_todays_promo']) ? sanitize_text_field($_POST['_todays_promo']) : '';
    update_post_meta($post_id, '_todays_promo', $custom_field);
}

function add_category_custom_fields($term) {
    $custom_field_value = get_term_meta($term->term_id, '_custom_field', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="custom_field"><?php _e('Promuj kategorie', 'woocommerce'); ?></label></th>
        <td>
            <label for="custom_field">
                <input type="checkbox" name="_custom_field" id="custom_field" <?php checked($custom_field_value, 'yes'); ?>>
                <?php _e('Rozpocznij promowanie kategorii', 'woocommerce'); ?>
            </label>
        </td>
    </tr>
    <?php
}

public function save_category_custom_fields($term_id, $tt_id, $taxonomy) {

    if (!current_user_can('manage_categories')) {
        return;
    }
    if ($taxonomy !== 'product_cat') {
        return;
    }
    $categories = get_terms(array(
        'taxonomy'   => 'product_cat',
        'post_type'  =>  'product',
        'hide_empty' => false,
        'fields'   => 'ids',
    ));

    foreach ($categories as $category_id) {
        if ($category_id !== $term_id) {
            update_term_meta($category_id, '_custom_field', 'no');
        }
    }

    if (isset($_POST['_custom_field'])) {
        $custom_field_value = ($_POST['_custom_field'] === 'on') ? 'yes' : 'no';

        update_term_meta($term_id, '_custom_field', $custom_field_value);
    }
}

public static function modify_recommended_products_query($query_args, $attributes) {
    $query_args['meta_query'] = array(
        array(
            'key'     => '_recommended_this_week',
            'value'   => 'yes',
            'compare' => '=',
        ),
    );

    return $query_args;
}

public function add_to_cart_button_to_products_template(){

    $product_id = get_the_ID();

    $addToCartButton = '<a data-product-id="' . $product_id . '" class="my-cart" href="">' . __('Dodaj do koszyka', 'burge') . '</a>';

    echo '<div class="woocommerce-product-item">' . $addToCartButton . '</div>';
}

public static function modify_recommended_today_products_query($query_args, $attributes) {
    $query_args['meta_query'] = array(
        array(
            'key'     => '_todays_promo',
            'value'   => 'yes',
            'compare' => '=',
        ),
    );

    return $query_args;

}

public function selected_category_shortcode($atts) {
    $category_id = $this->get_category_id_with_custom_field();

    $atts = shortcode_atts(
        array(
            'columns' => '2',
        ),
        $atts,
        'selected_category'
    );

    if ($category_id) {
        add_filter('woocommerce_shortcode_before_selected_category', function ($output, $shortcode_atts) {
            ob_start();
            echo '<ul class="products columns-' . esc_attr($shortcode_atts['columns']) . '">';
            return ob_get_clean();
        }, 10, 2);

        add_filter('woocommerce_shortcode_after_selected_category', function ($output) {
            ob_start();
            echo '</ul>';
            return ob_get_clean();
        });

        $args = array(
            'columns'        => intval($atts['columns']),
            'post_type'      => 'product',
            'limit'          => '12',
            'category'       => $category_id,
        );

        //error_log('args: ' . print_r($args,true));

        $shortcode = new WC_Shortcode_Products($args, 'selected_category');
        $content = $shortcode->get_content();

        remove_filter('woocommerce_shortcode_before_selected_category', function () {});
        remove_filter('woocommerce_shortcode_after_selected_category', function () {});

        return $content;
    } else {
        return 'No category found.';
    }
}

public function get_category_id_with_custom_field() {
    $categories = get_terms(array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
        'fields'     => 'all', 
    ));

    foreach ($categories as $category) {
        $field_value = get_term_meta($category->term_id, '_custom_field', true);

        if ($field_value === 'yes') {
            return $category->term_id;
        }
    }

    return false;
}

private function get_category_name_with_custom_field() {
    $categories = get_terms(array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
        'fields'     => 'all', 
    ));

    foreach ($categories as $category) {
        $field_value = get_term_meta($category->term_id, '_custom_field', true);

        if ($field_value === 'yes') {
            return $category->name;
        }
    }
    return false;
}

public function recommended_products_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'limit'        => '12',
            'columns'      => '4',
            'cat_operator' => 'IN',
        ),
        $atts,
        'recommended_products'
    );

    $args = array(
        'post_type'      => 'product',
        'limit' => intval($atts['limit']),
        'columns'        => intval($atts['columns']),
        'cat_operator'   => $atts['cat_operator'],
    );

    add_filter('woocommerce_shortcode_products_query', [$this, 'modify_recommended_products_query'], 10, 2);
    $shortcode = new WC_Shortcode_Products($args, 'recommended_products');
    remove_filter('woocommerce_shortcode_products_query', [$this, 'modify_recommended_products_query'], 10, 2);
    $content = $shortcode->get_content();

    return $content;
}

public function recommended_products_shortcode_2($atts) {
    $atts = shortcode_atts(
        array(
            'limit'        => '12',
            'columns'      => '2',
            'cat_operator' => 'IN',
        ),
        $atts,
        'recommended_products'
    );

    $args = array(
        'post_type'      => 'product',
        'limit' => intval($atts['limit']),
        'columns'        => intval($atts['columns']),
        'cat_operator'   => $atts['cat_operator'],
    );

    add_filter('woocommerce_shortcode_products_query', [$this, 'modify_recommended_products_query'], 10, 2);
    $shortcode = new WC_Shortcode_Products($args, 'recommended_products');
    remove_filter('woocommerce_shortcode_products_query', [$this, 'modify_recommended_products_query'], 10, 2);
    $content = $shortcode->get_content();

    return $content;
}

public function recommended_products_today_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'limit'        => '12',
            'columns'      => '4',
            'cat_operator' => 'IN',
        ),
        $atts,
        'recommended_products_today'
    );

    $args = array(
        'post_type'      => 'product',
        'limit' => intval($atts['limit']),
        'columns'        => intval($atts['columns']),
        'cat_operator'   => $atts['cat_operator'],
    );

    add_filter('woocommerce_shortcode_products_query', [$this, 'modify_recommended_today_products_query'], 10, 2);

    $shortcode = new WC_Shortcode_Products($args, 'recommended_products_today');

    remove_filter('woocommerce_shortcode_products_query', [$this, 'modify_recommended_today_products_query'], 10, 2);

    $content = $shortcode->get_content();

    return $content;
}

public function recommended_products_today_shortcode_2($atts) {
    $atts = shortcode_atts(
        array(
            'limit'        => '12',
            'columns'      => '2',
            'cat_operator' => 'IN',
        ),
        $atts,
        'recommended_products_today'
    );

    $args = array(
        'post_type'      => 'product',
        'limit' => intval($atts['limit']),
        'columns'        => intval($atts['columns']),
        'cat_operator'   => $atts['cat_operator'],
    );

    add_filter('woocommerce_shortcode_products_query', [$this, 'modify_recommended_today_products_query'], 10, 2);

    $shortcode = new WC_Shortcode_Products($args, 'recommended_products_today');

    remove_filter('woocommerce_shortcode_products_query', [$this, 'modify_recommended_today_products_query'], 10, 2);

    $content = $shortcode->get_content();

    return $content;
}

}

$woo = new My_woo();