<?php


if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * @link              http://www.kowalski-consulting.com/
 * @since             1.00
 * @package           Page Management
 * 
 * @wordpress-plugin
 * Plugin Name:       Page Management
 * Description:       Management of page content.
 * Version:           1.00
 * Author:            Tomasz Kowalski
 * Author URI:        https://kowalski-consulting.pl/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       page_manage
 * Date:    		  2024-02-15  
 */


 class PM 
 {

	function __construct()
	{
		$this->define_constants();
		$this->load_files();
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_filter( 'single_template', array( $this, 'load_custom_single_template' ) );
		add_action('wp_enqueue_scripts', [$this,'plugin_styles']);
		add_action( 'widgets_init', [$this,'pm_register_sidebars'] );
	}
	

	function pm_register_sidebars() {
		register_sidebar( array(
			'name' => esc_html__( 'Header Shopping Cart Widget Area', 'burge' ),
			'id' => 'header-widget',
			'description' => esc_html__( 'The Cart on header', 'burge' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s tab_content">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	}

	public function save_meta_field($save_meta_field)
	{
	global $post;

	if (isset($_POST[$save_meta_field])) {
		update_post_meta($post->ID, $save_meta_field, $_POST[$save_meta_field]);
		}
	}

	public static function activate(){
		update_option( 'rewrite_rules', '' );
	}

	public static function deactivate(){
		flush_rewrite_rules();
		unregister_post_type( 'header' );
		unregister_post_type( 'front-page' );
		unregister_post_type( 'footer' );
		unregister_post_type( 'mobile' );
	}

	public static function uninstall(){

		delete_option( 'manage_options' );

		$posts = get_posts(
			array(
				'post_type' => 'header',
				'number_posts'  => -1,
				'post_status'   => 'any'
			)
		);

		foreach( $posts as $post ){
			wp_delete_post( $post->ID, true );
		}

		$posts_1 = get_posts(
			array(
				'post_type' => 'footer',
				'number_posts'  => -1,
				'post_status'   => 'any'
			)
		);

		foreach( $posts_1 as $post_1 ){
			wp_delete_post( $post_1->ID, true );
		}

		$posts_2 = get_posts(
			array(
				'post_type' => 'front-page',
				'number_posts'  => -1,
				'post_status'   => 'any'
			)
		);

		foreach( $posts_2 as $post_2 ){
			wp_delete_post( $post_2->ID, true );
		}
	}

	public function load_files() 
	{
 		require_once( PM_PATH. 'nav/custom-menu.php');
		require_once( PM_PATH. 'post-types/header-cpt.php' );
		require_once( PM_PATH. 'post-types/front-page-cpt.php' );
		require_once( PM_PATH. 'post-types/footer-cpt.php' );
		require_once( PM_PATH. 'post-types/mobile-cpt.php' );
		require_once( PM_PATH. 'class/pm-settings.php' );
		require_once( PM_PATH. 'search/search_init.php' );
		require_once( PM_PATH. 'woo/custom_field.php' );
		
	}

	public function load_custom_single_template( $tpl ){

			if( is_singular( 'header' ) ){
				$tpl = $this->get_template_part_location( 'single-header.php' );
			}
			if( is_singular( 'front-page' ) ){
				$tpl = $this->get_template_part_location( 'single-front-page.php' );
			}
			if( is_singular( 'footer' ) ){
				$tpl = $this->get_template_part_location( 'single-footer.php' );
			}
			if( is_singular( 'mobile' ) ){
				$tpl = $this->get_template_part_location( 'single-mobile.php' );
			}
		
		return $tpl;
	}

	public function get_template_part_location( $file ){
		if( file_exists( PM_PATH . 'views/templates/' . $file ) ){
			$file = PM_PATH . 'views/templates/' .$file;
		}else{
			$file = PM_PATH . 'views/templates/' . $file;
		}
		return $file;
	}

	public function define_constants()
	{
		define( 'PM_PATH', plugin_dir_path( __FILE__ ) );
		define( 'PM_URL', plugin_dir_url( __FILE__ ) );
		define( 'PM_VERSION', '1.0.0' );
	}

	public function add_menu(){
		add_menu_page(
			__('Page Management','page_manage'),
			'Page management',
			'manage_options',
			'pm_admin',
			array( $this, 'pm_settings_page' ),
			'dashicons-images-alt2'
		);

		add_submenu_page(
			'pm_admin',
			__( 'Settings', 'page_manage' ),
			__( 'Settings', 'page_manage' ),
			'manage_options',
			'pm_admin',
			null,
			null
		);

		add_submenu_page(
			'pm_admin',
			__( 'Header', 'page_manage' ),
			__( 'Header', 'page_manage' ),
			'manage_options',
			'edit.php?post_type=header',
			null,
			null
		);

		add_submenu_page(
			'pm_admin',
			__( 'Front Page', 'page_manage' ),
			__( 'Front Page', 'page_manage' ),
			'manage_options',
			'edit.php?post_type=front-page',
			null,
			null
		);

		add_submenu_page(
			'pm_admin',
			__( 'Footer', 'page_manage' ),
			__( 'Footer', 'page_manage' ),
			'manage_options',
			'edit.php?post_type=footer',
			null,
			null
		);
		add_submenu_page(
			'pm_admin',
			__( 'Mobile', 'page_manage' ),
			__( 'Mobile', 'page_manage' ),
			'manage_options',
			'edit.php?post_type=mobile',
			null,
			null
		);
	}
	public function pm_settings_page(){
		if( ! current_user_can( 'manage_options' ) ){
			return;
		}

		if( isset( $_GET['settings-updated'] ) ){
			add_settings_error( 'pm_options', 'pm_message', esc_html__( 'Settings Saved', 'page_manage' ), 'success' );
		}
		
		settings_errors( 'pm_options' );

		require( PM_PATH . 'views/settings-page.php' );
	}

	public function plugin_styles() {

		wp_enqueue_style('header-footer-style', PM_URL . '/assets/css/header-footer.css', array(), 'all');
		wp_enqueue_script('pm-script', PM_URL . '/assets/js/pm-script.js', array('jquery'), null, false);
		
		if(is_front_page()) {
			wp_enqueue_style('front-style', PM_URL . '/assets/css/frontend.css', array(), 'all');
			wp_enqueue_script('pm-front', PM_URL . '/assets/js/pm-front.js', array('jquery'), null, false);
		}
		if (is_product_category() || is_tax('product_tag') || is_post_type_archive('product') || is_post_type_archive('polecane-w-tygodniu')
		|| is_post_type_archive('dzis-w-promocji')) {
			wp_enqueue_style('woo-category', PM_URL . '/assets/css/woo-category.css', array(), null, false);
		}
		if (is_post_type_archive('polecane-w-tygodniu') || is_post_type_archive('dzis-w-promocji')) {
			wp_enqueue_style('woo-archive', PM_URL . '/assets/css/woo-archive.css', array(), null, false);
		}
		if (is_post_type_archive('polecane-w-tygodniu') && !is_search()) {
			wp_enqueue_script('recommended-this-week', PM_URL . '/assets/js/this-week.js', array('jquery'), null, false);
		}
		if (is_post_type_archive('dzis-w-promocji') && !is_search()) {
			wp_enqueue_script('today', PM_URL . '/assets/js/today.js', array('jquery'), null, false);
		}
		if (is_search()) {
			wp_enqueue_script('search', PM_URL . '/assets/js/search.js', array('jquery'), null, false);
		}
	}


 }

 if( class_exists( 'PM' ) ){
    register_activation_hook( __FILE__, array( 'PM', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'PM', 'deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'PM', 'uninstall' ) );

    $pm = new PM();
} 
 

