<?php

class Menu extends PM {

    function __construct()
    {
        $this->load_files();
		add_filter('wp_nav_menu_item_custom_fields', [$this, 'add_menu_item_custom_fields'], 10, 4);
        add_action('admin_enqueue_scripts', array($this,'meta_image_enqueue') );
        add_filter('wp_update_nav_menu_item', [$this, 'save_menu_item_custom_fields'], 10, 3);
        add_filter('walker_nav_menu_start_el', [$this,'custom_info_menu_walker'], 10,4);
    }

    public function load_files() 
	{
        require_once( PM_PATH. 'nav/walker/extend-menu.php');
	}   

    function add_menu_item_custom_fields($item_id) {
        $current_location = get_theme_mod('nav_menu_locations');
        $header_info_menu_id = isset($current_location['header-info']) ? $current_location['header-info'] : 0;
        $footer_info_menu_id = isset($current_location['footer-info']) ? $current_location['footer-info'] : 0;
        $footer_menu_contact_id = isset($current_location['menu-contact']) ? $current_location['menu-contact'] : 0;
    
        if ($header_info_menu_id || $footer_info_menu_id || $footer_menu_contact_id) {
            $menu_items        = wp_get_nav_menu_items($header_info_menu_id);
            $menu_footer_items = wp_get_nav_menu_items($footer_info_menu_id);
            $menu_contact_items = wp_get_nav_menu_items($footer_menu_contact_id);
            
            $menu_footer_item_ids = wp_list_pluck($menu_items, 'ID');
            $menu_item_ids = wp_list_pluck($menu_footer_items, 'ID');
            $menu_contact_ids = wp_list_pluck( $menu_contact_items, 'ID');
            if (in_array($item_id, $menu_item_ids) || in_array($item_id, $menu_footer_item_ids) || in_array($item_id, $menu_contact_ids)) {
                $icon = get_post_meta($item_id, '_menu_item_icon', true);
    
                $output = '<p class="description description-wide">';
                $output .= '<label for="meta_image_' . $item_id . '">' . esc_html__('Icon', 'page_manage') . '</label><br>';
                $output .= '<input style="display:none" ';
                $output .= 'type="text"';
                $output .= ' name="menu-icon_' . $item_id . '"';
                $output .= ' id="meta_image_' . $item_id . '"';
                $output .= ' class="regular-text"';
                $output .= ' value="' . (isset($icon) ? esc_url($icon) : '') . '">';
                $output .= '<span class="menu-img-frame">';
                $output .= '<input type="button" id="btn-img-menu-' . $item_id . '" class="button btn-plugin-menu" value="' . esc_attr__('Choose an image', 'page_manage') . '" />';
                $output .= '<img height="40px" src="' . (isset($icon) ? $icon : '') . '">';
                $output .= '</span>';
                $output .= '</p>';
    
                echo $output;
            }
        }
    }
    
    

    public function save_menu_item_custom_fields($menu_id, $menu_item_db_id, $args) {
        if (isset($_POST['menu-icon_' . $menu_item_db_id])) {
            $icon_value = sanitize_text_field($_POST['menu-icon_' . $menu_item_db_id]);
            update_post_meta($menu_item_db_id, '_menu_item_icon', $icon_value);
        }
        return $menu_id;
    }
    
    
    public function custom_info_menu_walker($output, $item, $depth, $args) {

        $current_location = get_theme_mod('nav_menu_locations');

        if (!empty($current_location['header-info']) && $current_location['header-info']) {
            require_once 'walker/extend-menu.php';
        }

        if(!empty($current_location['footer-info']) && $current_location['footer-info']) {
            require_once 'walker/extend-footer-menu.php';
        }
        if(!empty($current_location['menu-contact']) && $current_location['menu-contact']) {
            require_once 'walker/extend-contact-menu.php';
        }


        return $output ;
    }

    
    public function meta_image_enqueue() {
  
        wp_enqueue_media();

        wp_register_script( 'meta-menu', PM_URL . 'assets/js/meta-menu.js', array( 'jquery' ) );
        wp_localize_script( 'meta-menu', 'meta_image_menu',
            array(
                'title'  => __( 'Choose an Image', 'page_manage' ),
                'button' => __( 'Use this image', 'page_manage' ),
            )
        );
        wp_enqueue_script( 'meta-menu' );
    }

}

$menu = new Menu();

