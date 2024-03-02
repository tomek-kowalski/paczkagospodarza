<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage CodeZeel
 * @since CodeZeel 1.0
 */
?>
<?php $extra = tmpmela_content_after(); ?>
</div>
<!-- .main-content-inner -->
</div>
<!-- .main_inner -->
</div>
<!-- #main -->
<?php tmpmela_footer_before(); ?>
<div class="theme-container">	
</div>
<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-top">
			<div class="footer-container">	
				<?php 
						$menu = wp_nav_menu( array(
							'theme_location'  => 'footer-info',
						  	'walker'          => new Custom_Menu_Footer_Walker(),
							'menu'            => 'nav',
							'container'       => 'div',
							'container_class' => 'footer-info',
							'container_id'    => 'footerSupportedContent',
							'menu_class'      => 'footer-navigation',
							'menu_id'         => 'footer-navigation navigation',
							'echo'            => true,
							'list_item_class' => 'menu-footer-item-info',
							'link_class'      => 'nav-footer__link',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="primary-footer-list" class="footer-wrapper">%3$s</ul></nav>',
							'depth'           => 0,
					  ));
						$mobile_data	= wp_get_recent_posts(array(
							'post_type'		   => 'mobile',
							'numberposts'	   =>  1,
							'post_status' 	   => 'publish',
							'orderby'          => 'post_date',
							'order'            => 'DESC',
					));
					  	$footer_data	= wp_get_recent_posts(array(
							'post_type'		   => 'footer',
							'postnumber'	   =>  1,
							'post_status' 	   => 'publish',
							'orderby'          => 'post_date',
							'order'            => 'DESC',
					));
					?>	
	   		</div> 
	   </div> 
	   <div class="footer-middle__line"></div>
		<div class="footer-middle">	

				<?php
				foreach ($footer_data as $data) :
    					$postid = $data['ID'];
    					$image_footer_url = get_post_meta($postid, 'footer_ndt', true);
						$footer_text = get_post_meta($postid, 'footer_text', true);
						$footer_title = get_post_meta($postid, 'footer_title', true);

    					if ($image_footer_url) {

							echo '<div class="footer-img__frame">';
    
            				echo '<img class="footer-img" src="' . esc_url($image_footer_url) . '" alt="Subskrypcja" >';

							echo '</div>';
    					}

						if($footer_text || $footer_title) {

							echo '<div class="footer-text__frame">';

							if($footer_title) {
								echo '<div class="footer-title" >' . esc_html($footer_title,'burge') . '</div>';
							}
							if($footer_text) {
								echo '<div class="footer-text" >' . esc_html($footer_text,'burge').  '</div>';
							}

							echo '</div>';

						}

				endforeach;
				?>
			
			<div class="footer-newsletter">	
				<?php echo do_shortcode('[newsletter_form form="1"]');?>
	        </div> 
	   </div> 
	   <div class="footer-middle__line"></div>
	  
		<div class="footer-bottom">	
			<div class="footer-bottom-container">

			   <div class="site-info">  
			   <?php 
				foreach ($footer_data as $data) :
    					$postid = $data['ID'];
    					$image_1 = get_post_meta($postid, 'footer_ndt_1', true);
						$image_2 = get_post_meta($postid, 'footer_ndt_2', true);
						$image_3 = get_post_meta($postid, 'footer_ndt_3', true);

						echo '<div class="footer-bottom__frame">';

    					if ($image_1) {
            				echo '<img class="footer-img" src="' . esc_url($image_1) . '" alt="Facebook" >';
    					}
						if ($image_2) {
            				echo '<img class="footer-img" src="' . esc_url($image_2) . '" alt="TikTok" >';
    					}
						if ($image_3) {
            				echo '<img class="footer-img" src="' . esc_url($image_3) . '" alt="X" >';
    					}


						echo '</div>';

					endforeach;
					?>
				<div class="footer-copyright">
					<?php echo esc_html__( 'Copyright', 'burge' ); ?> &copy; <?php echo  bloginfo() . ' ' .esc_attr(date('Y')); ?>
				</div>
				</div>
 			</div>
    	</div>

<div class="mobile-panel">

<div class="mobile-footer-navigation">
	<div class="menu-toggle">
	<?php
	foreach ($mobile_data as $data) :
							$postid = $data['ID'];
							$image_menu_url = get_post_meta($postid, 'mobile_ic_1', true);
							$output = '';
							if ($image_menu_url) {
							
								$output .= '<img class="panel-menu-image" src="' . esc_url($image_menu_url) . '" alt="Menu" />';
							}

							echo $output;

	endforeach;
	?>
	</div>
	<div class="menu-text"><?php esc_html_e( 'Menu', 'burge' ); ?></div>
		<div class="vertical-mobile-menu">	
			<div class="mobile-menu">

				<?php 
					foreach ($mobile_data as $data) :
						$postid = $data['ID'];
						$image_menu_close_url = get_post_meta($postid, 'mobile_ic_5', true);
						$output = '';
						if ($image_menu_close_url) {
						
							$output .= '<img class="menu-close" src="' . esc_url($image_menu_close_url) . '" alt="Close" />';
						}
						echo $output;
					endforeach;
				
				?>
				<div class="header-mob-menu-logo">
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
							<?php wp_nav_menu( array( 'theme_location'    => 'header-cat',
													   'menu_class'       => 'mobile-menu-inner',
													   'depth'            => 2,
													   ) 
													   ); 
								wp_nav_menu( array(    'theme_location'   => 'menu-contact',
														'walker'          => new Custom_Menu_Contact_Walker(),
													   'menu_class'       => 'mobile-menu-inner',
													   'depth'            => 1,
													   ) 
													   ); 					   				 
							?>
						</div>	
					</div>
					<span class="background-overlay active"></span>
					</div>		

					<?php
					foreach ($mobile_data as $data) :
								$postid = $data['ID'];
								$image_search_url = get_post_meta($postid, 'mobile_ic_2', true);
								$text_search 	  = get_post_meta($postid, 'mobile_text_2', true);
								$image_account_url = get_post_meta($postid, 'mobile_ic_4', true);
								$text_account 	  = get_post_meta($postid, 'mobile_text_4', true);
								$output = '';

								if ($image_search_url) {

								$output .= '<div class="panel-search-mobile">';
								$output .= '<img class="panel-search-image" src="' . esc_url($image_search_url) . '" alt="Account" >';

								if($text_search) {
								$output .= '<div class="text-search">' . $text_search . '</div>';
								}
								$output .= '</div>';

								$output .= '<div class="topbar-footer-link">';

								if ($image_account_url) {
								$output .=  '<img class="img-account" src="' . esc_url($image_account_url) . '" alt="Account" />';
								}
								$output .= '<span class="account-title">'.$text_account .'</span>';

								echo $output;
								
							}
					endforeach;
					?>	
												

						 <div class="topbar-link-wrapper">   
									<div class="header-menu-links">					
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
							
						<div class="header-footer-contact-cms">
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
								<div class="cart-mobile-price">
								<?php
							foreach ($mobile_data as $data) :
								$postid = $data['ID'];
								$image_cart_url = get_post_meta($postid, 'mobile_ic_3', true);
								$text_cart      = get_post_meta($postid, 'mobile_text_3', true);
								$output = '';


								if ($image_cart_url) {
									$output .= '<img class="img-cart" src="' . esc_url($image_cart_url) . '" alt="Koszyk" >';
								}
								if ($text_cart) {
									$output .= '<div class="text-cart">'  . $text_cart . '</div>';
								}

								echo $output;

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
						</div>	
					</div>
				</div>
	</footer>

<!-- #page -->
<?php tmpmela_go_top(); ?>
<?php wp_footer(); ?>
</body>
</html>