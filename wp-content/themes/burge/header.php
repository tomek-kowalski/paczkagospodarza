<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Codezeel
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

 <?php wp_head();?> 
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PZTRQ85');</script>
<!-- End Google Tag Manager -->
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PZTRQ85"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php if ( get_option('tmpmela_control_panel') == 'yes' ) do_action('tmpmela_show_panel'); ?>
<div id="page" class="hfeed site <?php //echo esc_attr(tmpmela_page_layout()); ?>">
<!-- Header -->
<?php //tmpmela_header_before(); ?>
<header id="masthead" class="site-header site-header-fix">
    <div class="topbar-outer">

		<?php
		$menu = wp_nav_menu( array(
  			'theme_location'  => 'header-info',
			'walker'          => new Custom_Menu_Walker(),
  			'menu'            => 'nav',
  			'container'       => 'div',
  			'container_class' => 'header-info',
  			'container_id'    => 'navbarSupportedContent',
  			'menu_class'      => 'primary-navigation',
  			'menu_id'         => 'site-navigation navigation',
  			'echo'            => true,
  			'list_item_class' => 'menu-item-info',
  			'link_class'      => 'nav__link',
  			'before'          => '',
  			'after'           => '',
  			'link_before'     => '',
  			'link_after'      => '',
  			'items_wrap'      => '<ul id="primary-menu-list" class="menu-wrapper">%3$s</ul></nav>',
  			'depth'           => 0,
		));
		$header_data	= wp_get_recent_posts(array(
    		'post_type'		   => 'header',
			'numberposts'	   =>  1,
			'post_status' 	   => 'publish',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
		));
		?>
	</div>

	<div class="site-header-main header-fix">
		<div class="header-main">
		<div class="theme-container">	
				<div class="header-top">
								
							<!-- Start header_left -->	
							<div class="header-left">		
								

								<!-- Header LOGO-->
									<div class="header-logo">
									<?php if (get_option('tmpmela_logo_image') != '') : ?>
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
										<?php tmpmela_get_logo(); ?>
										</a>
									<?php else: ?>
										<h3 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
											<?php bloginfo( 'name' ); ?>
											</a>
										</h3>
									<?php endif; ?>
									</div>
									<!-- Header Mob LOGO-->
									<div class="header-mob-logo">
									<?php if (get_option('tmpmela_mob_logo_image') != '') : ?>
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
										<?php tmpmela_get_mob_logo(); ?>
										</a>
									<?php else: ?>
										<h3 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
											<?php bloginfo( 'name' ); ?>
											</a>
										</h3>
									<?php endif; ?>
									</div>	
								<?php tmpmela_header_inside(); ?>
							</div>	
							<?php if (class_exists('Search')) {
    						$search = new Search();
    						$custom_search_form = $search->woo_custom_product_searchform('');

    						echo $custom_search_form;
							} ?>  
		
	
								<a class="screen-reader-text skip-link" href="#content" title="<?php esc_html_e( 'Skip to content', 'burge' ); ?>"><?php esc_html_e( 'Skip to content', 'burge' ); ?></a>	
									<div class="mega-menu">
										<?php echo
										wp_nav_menu( array( 
										'theme_location' => 'primary',
										'menu_class' => 'mega' ) ); ?>		
									</div>	

									<?php if ( has_nav_menu('header-menu') ): ?> 				
									<div class="topbar-link">
										<?php

										foreach ($header_data as $data) :
    											$postid = $data['ID'];
    											$image_account_url = get_post_meta($postid, 'header_ndt', true);

    											if ($image_account_url) {
        										$image_account_id = attachment_url_to_postid($image_account_url);
        										$image_account_size = wp_get_attachment_image_src($image_account_id, 'my-icon-size');

        										if ($image_account_size) {
            										echo '<img class="img-account" src="' . esc_url($image_account_size[0]) . '" alt="Account" width="' . esc_attr($image_account_size[1]) . '" height="' . esc_attr($image_account_size[2]) . '">';
        										}
    										}
											endforeach;
											?>
										<span class="account-title">Konto</span>										

										 <div class="topbar-link-wrapper">   
													<div class="header-menu-links">					
															<?php 
															$tmpmela_header_menu =array(
															'menu' => esc_html__('TM Header Top Links','burge'),
															'depth'=> 1,
															'echo' => false,
															'menu_class'      => 'header-menu', 
															'container'       => '', 
															'container_class' => '', 
															'theme_location' => 'header-menu'
															);
															echo wp_nav_menu($tmpmela_header_menu);				    
															?>
															<?php
															$logout_url = '';
															if ( is_user_logged_in() ) {
																$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' ); 
																if ( $myaccount_page_id ) { 
																$logout_url = wp_logout_url( get_permalink( $myaccount_page_id ) ); 
																if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' )
																if (is_ssl()) {
																$logout_url = str_replace( 'http:', 'https:', $logout_url );
																}
																} ?>
																<a href="<?php echo esc_url($logout_url); ?>" ><?php echo 			esc_html_e('Wyloguj','burge'); ?></a>
																<?php }
																else { ?>
																<a href="<?php echo  get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php echo esc_html_e('Zaloguj','burge'); ?></a>
															<?php } ?>  
													</div>			
													</div>
												</div>		
											<?php endif; ?>		
											

										<?php if (get_option('tm_show_topbar_contact') == 'yes') : ?>
										<div class="header-contact-cms">
			
											<div class="header-cart headercart-block">
											<?php 

											if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_active_sidebar('header-widget') ) : ?>											
												<div class="cart togg">
												<?php global $woocommerce;
												$cart_count = $woocommerce->cart->cart_contents_count;
												$cart_total = $woocommerce->cart->get_cart_total();
												ob_start();?>						
											<div class="shopping_cart tog"  title="<?php esc_html_e('View your shopping cart', 'burge'); ?>">
												<a class="cart-content" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_html_e('View your shopping cart', 'burge'); ?>">
												<div class="cart-price">
												<?php
											foreach ($header_data as $data) :
    											$postid = $data['ID'];
    											$image_cart_url = get_post_meta($postid, 'header_ndt_2', true);

    											if ($image_cart_url) {
        										$image_cart_id = attachment_url_to_postid($image_cart_url);
        										$image_cart_size = wp_get_attachment_image_src($image_cart_id, 'my-icon-size');

        										if ($image_cart_size) {
            										echo '<img class="img-cart" src="' . esc_url($image_cart_size[0]) . '" alt="Koszyk" width="' . esc_attr($image_cart_size[1]) . '" height="' . esc_attr($image_cart_size[2]) . '">';
        										}
    										}
											endforeach;
												?>
													
													<div class="cart-total"><?php echo $cart_total; ?></div>
													<div class="cart-qty"><?php echo sprintf(_n('%d', '%d', $cart_count, 'burge'), $cart_count); ?></div>
												</div></a>
											</div>	
											<?php global $woocommerce; ?>
											<?php tmpmela_get_widget('header-widget'); ?>
								    		</div>							
											<?php endif; ?>	
											</div>	
											</div>
										<?php endif; ?>
										</div>		

						<div class="header-bottom"></div>		
					</div>
				</div>			    
			</div>	
			<?php
			$tmpmela_header_menu =array(
				'menu' => esc_html__('TM Header Category','burge'),
				'depth'=> 1,
				'echo' => false,
				'menu_class'      => 'header-cat', 
				'container'       => 'div', 
				'container_class' => 'frame-header-cat', 
				'theme_location' => 'header-cat'
				);
			echo wp_nav_menu($tmpmela_header_menu);	?>
		</header>
		<?php tmpmela_header_after(); ?>
		<?php tmpmela_main_before(); ?>
		<?php 
			$tmpmela_page_layout = tmpmela_page_layout(); 
			if( isset( $tmpmela_page_layout) && !empty( $tmpmela_page_layout ) ):
			$tmpmela_page_layout = $tmpmela_page_layout; 
			else:
			$tmpmela_page_layout = '';
			endif;
		?>
	<?php 
	$shop = '0';

	if(is_shop()) {
		$tmpmela_page_layout = 'wide-page';
		$shop = '1';
	}
	?>
	<div id="main" class="site-main">
	<div class="main_inner">

	<?php if ( !is_page_template('page-templates/home.php')) : ?>
		<div class="page-title header">
  		<div class="page-title-inner">
     		<h3 class="entry-title-main">
		<?php	    
	  	if($shop == '1') {
	       		if(is_shop()) :
		    		echo '';
				elseif(tmpmela_is_blog()):
				        esc_html_e( 'Blog', 'burge' );
				elseif(is_search()) :
					printf( esc_html__( 'Search Results for: "%s"', 'burge' ), get_search_query() ); 
				elseif( is_front_page() && is_home()):
				    esc_html_e( 'Blog', 'burge' );	    
				elseif(is_singular('post')):
					esc_html_e( 'Blog', 'burge' );	    
				else :
				    the_title();
	        	endif; 	
	   }	else {		   		
			 if(tmpmela_is_blog()):
				esc_html_e( 'Blog', 'burge' );		
			elseif(is_search()) :
				printf( esc_html__( 'Search Results for: "%s"', 'burge' ), get_search_query() ); 		
			elseif(is_singular('post') ) :
				esc_html_e( 'Blog', 'burge' );				
			else :
				    the_title();
			endif; 	
		}  
	  ?>
    		</h3>
    		<?php tmpmela_breadcrumbs(); ?>
  		</div>
		</div>
		<?php endif; ?>
		<?php 

	if ( $tmpmela_page_layout == 'wide-page' ) : ?>
	<div class="main-content-inner-full">
	<?php else: 		
	if(is_archive() || is_tag() || is_404()) : ?>
		<div class="main-content">
	<?php else : ?>
		<div class="main-content-inner  <?php echo esc_attr(tmpmela_sidebar_position()); ?>">
	<?php endif; ?>
	<?php endif; ?>
	<?php tmpmela_content_before(); ?>
	<div id="search-results"></div>

			    
