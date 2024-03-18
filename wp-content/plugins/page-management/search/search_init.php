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
    
        $args = array(
            'post_type'      => 'product',
            's'              => $search_query,
            'posts_per_page' => 10,
        );
    
        $query = new WP_Query($args);

        $count = count($query->posts) ? count($query->posts) : '0';
    
        if ($query->have_posts()) {
            $html = '<span class="title-frame"><p class="search-title">' . __('Szybkie wyszukiwanie - znaleziono produkty (' . $count .'):') . '</p><span class="close-serch">X</span></span>';
    
            while ($query->have_posts()) {
                $query->the_post();
    
                $product = wc_get_product(get_the_ID());
    
                $result = array(
                    'thumbnail'      => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
                    'title'          => get_the_title(),
                    'price'          => $product->get_price(),
                    'product_id'     => get_the_ID(),
                    'url'            => get_permalink(get_the_ID()),
                    'brand'          => get_the_terms(get_the_ID(), 'pwb-brand'),
                    'average_rating' => $product->get_average_rating(),
                );
    
                $currency_symbol = get_woocommerce_currency_symbol();
    
                $html .= '<div class="search-result">';
                $html .= '<div class="col-img">';
                $html .= '<a href="'. $result['url'] . '"><img src="' . esc_url($result['thumbnail']) . '" alt="' . esc_attr($result['title']) . '"></a>';
                $html .= '</div>';
                $html .= '<div class="col-content">';
                $html .= '<div class="pwb-brands-in-loop">';
                $html .= '<span><a href="' . esc_url(get_term_link($result['brand'][0])) . '">' . esc_html($result['brand'][0]->name) . '</a></span>';
                $html .= '</div>';
                $html .=  wc_get_rating_html($result['average_rating']);
                $html .= '<a href="' . $result['url']. '"><h2>' . esc_html($result['title']) . '</h2></a>';
                $html .= '</div>';
                $html .= '<div class="col-action">';
                $html .= '<a product-id="' . esc_html($result['product_id']) .'"  class="my-cart-search">' . __('Zakup','page_manage') . '</a>';
                $html .= '<span class="price">' . esc_html($result['price']) . ' ' . $currency_symbol . '</span>';
                $html .= '</div>';
                $html .= '</div>';
            }
    
            wp_reset_postdata();
            wp_send_json_success(array('results' => $html));
            die();
        }
        else {
            wp_send_json_error('No products found');
            die();
        } 
    }
}



$search = new Search();