<?php
/**
 * The Footer Sidebar
 *
 * @package WordPress
 * @subpackage CodeZeel
 * @since CodeZeel 1.0
 */
if ( !is_active_sidebar( 'first-footer-widget-area'  )
	&& ! is_active_sidebar( 'second-footer-widget-area' )
	&& ! is_active_sidebar( 'third-footer-widget-area'  )
	&& ! is_active_sidebar( 'fourth-footer-widget-area' )
)
{
	return;
}
?>
<div id="footer-widget-area">
	  <?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
		  <div id="first" class="first-widget footer-widget">
			<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
		  </div>
		  <!-- #first .widget-area -->
	  <?php endif; ?>
	  <?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
		  <div id="second" class="second-widget footer-widget">
			<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
		  </div>
	  <!-- #second .widget-area -->
	  <?php endif; ?>
	  <?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
		  <div id="third" class="third-widget footer-widget">
			<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
		  </div>
	  <!-- #third .widget-area -->
	  <?php endif; ?>
	  <?php if ( is_active_sidebar( 'forth-footer-widget-area' ) ) : ?>
	  	<div id="forth" class="forth-widget footer-widget">
			<?php dynamic_sidebar( 'forth-footer-widget-area' ); ?>
		</div>
	<?php endif; ?>
</div>