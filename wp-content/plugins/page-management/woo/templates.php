<?php 

class Template extends My_woo  {
    

    function __construct() {
        add_action( 'init', array( $this, 'create_this_week' ) );
        add_action( 'init', array( $this, 'create_today' ) );
    }

    public function create_this_week() {
        register_post_type(
            'polecane-w-tygodniu',
            array(
                'public'    => true,
                'supports'  => array(),
                'hierarchical'  => false,
                'show_ui'   => false,
                'show_in_menu'  => false,
                'show_in_admin_bar' => false,
                'show_in_nav_menus' => false,
                'can_export'    => true,
                'has_archive'   => 'polecane-w-tygodniu',
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'show_in_rest'  => true,
                'menu_icon' => false,
            )
        );
    }

    public function create_today() {
        register_post_type(
            'dzis-w-promocji',
            array(
                'public'    => true,
                'supports'  => array(),
                'hierarchical'  => false,
                'show_ui'   => false,
                'show_in_menu'  => false,
                'show_in_admin_bar' => false,
                'show_in_nav_menus' => false,
                'can_export'    => true,
                'has_archive'   => 'dzis-w-promocji',
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'show_in_rest'  => true,
                'menu_icon' => false,
            )
        );
    }
}

$template = new Template();
