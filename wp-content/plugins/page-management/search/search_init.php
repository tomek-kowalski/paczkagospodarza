<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Search extends PM {

    function __construct(){
        add_filter( 'get_product_search_form' , [$this,'woo_custom_product_searchform']);
        add_action('wp_enqueue_scripts', [$this,'enqueue_search_script']);
        add_action('wp_ajax_product_search', [$this,'product_search']);
        add_action('wp_ajax_nopriv_product_search', [$this, 'product_search']);
    }

    public function woo_custom_product_searchform($output) {
        $output .= '<div class="search-frame">';
        $output .= '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">';
        $output .= '<input class="search-input" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __('Szukaj produktu (np. mleko)','woocommerce') . '" />';
        $output .= '<input type="submit" id="searchsubmit" class="search-button" value="' . esc_html('Szukaj', 'woocommerce') . '" />';
        $output .= '<input type="submit" id="searchsubmit-mobile" class="search-button-mobile" value="" />';
        $output .= '<input type="hidden" name="post_type" value="product" />';
        $output .= '</form>';
        $output .= '</div>';

        return $output;
    }

    public function enqueue_search_script() {
        wp_enqueue_script('woo-search-scripts', PM_URL . 'assets/js/ajax_search_script.js', array('jquery'), null, true);
        wp_localize_script('woo-search-scripts', 'toSearch', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('toSearch'),
        ));
    }

    public function product_search() {
        check_ajax_referer('toSearch', 'nonce');

        $search_query = sanitize_text_field($_POST['search_query']);

        //error_log('12');

        $args = array(
            'post_type' => 'product',
            's' => $search_query,
        );

        $query = new WP_Query($args);

        //error_log('query search: '. print_r($query,true));

        if ($query->have_posts()) {
            $results = array();

            while ($query->have_posts()) {
                $query->the_post();
                $result = array(
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
                    'title' => get_the_title(),
                    'price' => get_post_meta(get_the_ID(), '_price', true),
                );
                $results[] = $result;
            }

            wp_reset_postdata();

            $html = '';
            foreach ($results as $result) {
                $html .= '<div class="search-result">';
                $html .= '<img src="' . esc_url($result['thumbnail']) . '" alt="' . esc_attr($result['title']) . '">';
                $html .= '<h2>' . esc_html($result['title']) . '</h2>';
                $html .= '<span class="price">' . esc_html($result['price']) . '</span>';
                $html .= '</div>';
            }

            wp_send_json_success(array('results' => $html));
        } else {
            wp_send_json_error('No products found');
        } 
    }
}



$search = new Search();