<?php
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering',30);
remove_action('woocommerce_after_shop_loop', 'woocommerce_catalog_ordering',30);
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination',10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

function custom_remove_result_count() {
    if (!is_search()) {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    }
}
add_action('init', 'custom_remove_result_count');

/**
 * Set up the content width value based on the theme's design.
 *
 * @see tmpmela_content_width()
 *
 * @since CodeZeel 1.0
 */
   
    function register_shipment_send_to_warehouse_status() {
        register_post_status( 'wc-sent-warehouse', array(
            'label'                     => 'Przekazane do magazynu',
            'public'                    => true,
            'show_in_admin_status_list' => true,
            'show_in_admin_all_list'    => true,
            'exclude_from_search'       => false,
            'label_count'               => _n_noop( 'Przekazane do magazynu <span class="count">(%s)</span>', 'Przekazane do magazynu <span  class="count">(%s)</span>' )
        ) );
		
		 register_post_status( 'wc-taken-warehouse', array(
            'label'                     => 'Pobrane przez magazyn',
            'public'                    => true,
            'show_in_admin_status_list' => true,
            'show_in_admin_all_list'    => true,
            'exclude_from_search'       => false,
            'label_count'               => _n_noop( 'Pobrane przez magazyn <span class="count">(%s)</span>', 'Pobrane przez magazyn <span class="count">(%s)</span>' )
        ) );
		 register_post_status( 'wc-taken-courier', array(
            'label'                     => 'Przekazane kurierowi',
            'public'                    => true,
            'show_in_admin_status_list' => true,
            'show_in_admin_all_list'    => true,
            'exclude_from_search'       => false,
            'label_count'               => _n_noop( 'Przekazane kurierowi <span class="count">(%s)</span>', 'Przekazane kurierowi <span class="count">(%s)</span>' )
        ) );
    }
    add_action( 'init', 'register_shipment_send_to_warehouse_status' );
    function add_awaiting_shipment_to_order_statuses( $order_statuses ) {
        $new_order_statuses = array();
        foreach ( $order_statuses as $key => $status ) {
            $new_order_statuses[ $key ] = $status;
            if ( 'wc-processing' === $key ) {
                $new_order_statuses['wc-sent-warehouse'] = 'Przekazane do magazynu';
				$new_order_statuses['wc-taken-warehouse'] = 'Pobrane przez magazyn';
				$new_order_statuses['wc-taken-courier'] = 'Przekazane kurierowi';
            }
        }
        return $new_order_statuses;
    }
    add_filter( 'wc_order_statuses', 'add_awaiting_shipment_to_order_statuses' );

 

add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);

function wcs_custom_get_availability( $availability, $_product ) {
    
    // Change In Stock Text
    if ( $_product->is_in_stock() ) {
        $availability['availability'] = __('Na stanie', 'woocommerce');
    }
    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = __('Obecnie brak', 'woocommerce');
    }
    return $availability;
} 

if ( ! isset( $content_width ) ) {
	$content_width = 1400;
}
function tmpmela_setup() {
	/*
	* Makes Codezeel available for translation.
	*
	* Translations can be added to the /languages/ directory.
	* If you're building a theme based on tm, use a find and
	* replace to change 'burge' to the name of your theme in all
	* template files.
	*/
	load_theme_textdomain( 'burge', get_template_directory() . '/languages' );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/font-awesome.css', '/fonts/css/font-awesome.css', tmpmela_fonts_url() ) );
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );
	global $wp_version;
	if ( version_compare( $wp_version, '3.4', '>=' ) ) {
		add_theme_support( 'custom-background' ); 
	}
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		 'primary'   	 => esc_html__('TM Header Navigation', 'burge' ),
		 'header-menu'   => esc_html__('TM Header Top Links', 'burge' ),
		 'header-info'   => esc_html__('TM Header Info', 'burge' ),
		 'header-cat'    => esc_html__('TM Header Category', 'burge' ),
		 'menu-contact'  => esc_html__('TM Menu Contact', 'burge' ),
		 'footer-info'   => esc_html__('TM Footer info', 'burge' ),
	) );
	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'tmpmela_setup' );
/********************************************************
**************** CODEZEEL CONTENT WIDTH ******************
********************************************************/
function tmpmela_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tmpmela_content_width', 895 );
}
add_action( 'after_setup_theme', 'tmpmela_content_width', 0 );
/**
 * Getter function for Featured Content Plugin.
 *
 * @since CodeZeel 1.0
 *
 * @return array An array of WP_Post objects.
 */
function tmpmela_get_featured_posts() {
	/**
	 * Filter the featured posts to return in CodeZeel.
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'tmpmela_get_featured_posts', array() );
}
/**
 * A helper conditional function that returns a boolean value.
 * @return bool Whether there are featured posts.
 */
function tmpmela_has_featured_posts() {
	return ! is_paged() && (bool) tmpmela_get_featured_posts();
}
/********************************************************
**************** CODEZEEL SIDEBAR ******************
********************************************************/
function tmpmela_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'burge' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'burge' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
}
add_action( 'widgets_init', 'tmpmela_widgets_init' );
/********************************************************
**************** CODEZEEL FONT SETTING ******************
********************************************************/
function tmpmela_fonts_url() {
	$fonts_url = '';
	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'burge' );
	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'burge' );
	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();
		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';
		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = esc_url( add_query_arg( $query_args, "//fonts.googleapis.com/css" ));
	}
	return $fonts_url;
}
/********************************************************
************ CODEZEEL SCRIPT SETTING ***************
********************************************************/
function tmpmela_scripts_styles() {
	// Add Poppins fonts, used in the main stylesheet.
	wp_enqueue_style( 'tmpmela-fonts', tmpmela_fonts_url(), array(), null );
	wp_enqueue_style( 'FontAwesome', get_template_directory_uri() . '/fonts/css/font-awesome.css', array(), '4.7.0' );
	wp_enqueue_style( 'tmpmela-style', get_stylesheet_uri(), array(), '1.0' );
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'tmpmela-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}
	// Loads JavaScript file with functionality specific to Codezeel.
	//wp_enqueue_script( 'tmpmela-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2014-02-01', true );
	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	//wp_enqueue_script( 'tmpmela-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'tmpmela_scripts_styles' );
/********************************************************
************ CODEZEEL GET URL **********************
********************************************************/
function tmpmela_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );
	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
/********************************************************
************ CODEZEEL LIST AUTHOR SETTING**************
********************************************************/
if ( ! function_exists( 'tmpmela_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 * @return void
 */
function tmpmela_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );
	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );
		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>
<div class="contributor">
  <div class="contributor-info">
    <div class="contributor-avatar"><?php echo esc_attr(get_avatar( $contributor_id, 132 )); ?></div>
    <div class="contributor-summary">
      <h2 class="contributor-name"><?php echo esc_attr(get_the_author_meta( 'display_name', $contributor_id )); ?></h2>
      <p class="contributor-bio"> <?php echo esc_attr(get_the_author_meta( 'description', $contributor_id )); ?> </p>
      <a class="contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>"> <?php printf( _n( '%d Article', '%d Articles', $post_count, 'burge' ), $post_count ); ?> </a> </div>
    <!-- .contributor-summary -->
  </div><!-- .contributor-info -->
</div><!-- .contributor -->
<?php
	endforeach;
}
endif;
/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since CodeZeel 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function tmpmela_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} else {
		$classes[] = 'masthead-fixed';
	}
	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}
	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
	}
	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}
	if ( is_front_page() && 'slider' == get_theme_mod( 'tmpmela_Featured_Content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}
	return $classes;
}
add_filter( 'body_class', 'tmpmela_body_classes' );
/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function tmpmela_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}
	return $classes;
}
add_filter( 'post_class', 'tmpmela_post_classes' );
/**
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function tmpmela_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() ) {
		return $title;
	}
	// Add the site name.
	$title .= get_bloginfo( 'name' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}
	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'burge' ), max( $paged, $page ) );
	}
	return $title;
}
add_filter( 'wp_title', 'tmpmela_wp_title', 10, 2 );
// Implement Custom Header features.
require_once get_stylesheet_directory() . '/inc/custom-header.php';
// Custom template tags for this theme.
require_once get_stylesheet_directory() . '/inc/template-tags.php';
// Add Theme Customizer functionality.
require_once get_stylesheet_directory() . '/inc/customizer.php' ;
/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own tmpmela_Featured_Content class on or
 * before the 'setup_theme' hook.
*/
if ( ! class_exists( 'tmpmela_Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {	
	get_template_part('inc/featured-content' );
}
function tmpmela_title_tag() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'tmpmela_title_tag' );
/*Add Codezeel custom function */
require_once get_stylesheet_directory() . '/codezeel/codezeel-functions.php';

/*Add Codezeel theme setting in menu */
require_once get_stylesheet_directory() . '/codezeel/options.php';
/*Add TGMPA library file */
require_once get_stylesheet_directory(). '/codezeel/tmpmela-plugins-install.php';
add_action( 'admin_menu', 'tmpmela_theme_setting_menu' );
function tmpmela_theme_settings_page() {
	$locale_file = get_stylesheet_directory() . '/codezeel/admin/theme-setting.php';
	if (is_readable( $locale_file ))		
require_once get_stylesheet_directory() . '/codezeel/admin/theme-setting.php';
}
function tmpmela_hook_manage_page() {
	$locale_file = get_stylesheet_directory() . '/codezeel/admin/theme-hook.php';
	if (is_readable( $locale_file ))		
require_once get_stylesheet_directory() . '/codezeel/admin/theme-hook.php';
} 
/* Control Panel Tags Function Includes */
require_once get_stylesheet_directory() . '/codezeel/controlpanel/tmpmela_control_panel.php';
require_once get_stylesheet_directory() . '/codezeel/admin/hook-functions.php';
require_once get_stylesheet_directory() . '/mr-image-resize.php';
/* Adds woocommerce functions if active */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
require_once get_stylesheet_directory() . '/codezeel/woocommerce-functions.php';
endif;


add_action( 'wp_print_styles', 'remove_styls_and_scripts_in_main' );

function remove_styls_and_scripts_in_main() {
	wp_dequeue_style('js_composer_front');
	wp_dequeue_style('wp-block-library');	
	wp_dequeue_style('contact-form-7');	
	wp_dequeue_style('pwb-styles-frontend');
	wp_dequeue_style('animate_min');
	wp_dequeue_style('tmpmela_shortcode_style');
	wp_dequeue_style('wc-blocks-style');
	wp_dequeue_style('wc-blocks-vendors-style');


	wp_dequeue_style('js_composer_front');
	wp_dequeue_script('wpcf7-recaptcha');	
	wp_dequeue_script('underscore');	
	wp_dequeue_script('wpb_composer_front_js');	
	wp_dequeue_script('jquery.colorbox');	
	wp_dequeue_script('tmpmela_html5');	
	wp_dequeue_script('phpvariable');	

}


?>