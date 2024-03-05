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
    add_filter('woocommerce_loop_add_to_cart_link', [$this,'remove_add_to_cart_button'], 10, 2);
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

private function add_to_cart_button_to_products($content) {
    libxml_use_internal_errors(true);

    $dom = new DOMDocument();
    $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    libxml_clear_errors();

    $products = $dom->getElementsByTagName('li');

    foreach ($products as $product) {

        $addToCartButton = $dom->createElement('a', __('Dodaj do koszyka','burge'));
        $addToCartButton->setAttribute('class', 'my-cart');

        $product->appendChild($addToCartButton);
    }

    return $dom->saveHTML();
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

        error_log('args: ' . print_r($args,true));

        $shortcode = new WC_Shortcode_Products($args, 'selected_category');
        $content = $shortcode->get_content();
        $modified_content = $this->add_to_cart_button_to_products($content);

        // Remove filters
        remove_filter('woocommerce_shortcode_before_selected_category', function () {});
        remove_filter('woocommerce_shortcode_after_selected_category', function () {});

        //error_log('modified_content: ' . print_r($modified_content, true));

        return $modified_content;
    } else {
        return 'No category found.';
    }
}



private function get_category_id_with_custom_field() {
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
    $modified_content = $this->add_to_cart_button_to_products($content);

    return $modified_content;
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
    $modified_content = $this->add_to_cart_button_to_products($content);

    return $modified_content;
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
    $modified_content = $this->add_to_cart_button_to_products($content);

    return $modified_content;
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
    $modified_content = $this->add_to_cart_button_to_products($content);

    return $modified_content;
}


}

$woo = new My_woo();