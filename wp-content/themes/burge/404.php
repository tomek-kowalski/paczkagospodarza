<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage CodeZeel
 * @since CodeZeel 1.0
 */
get_header(); ?>
<header><div class="page-title"><div class="page-title-inner"><h1 class="entry-title-main"><?php esc_html_e( 'Not Found', 'burge' ); ?></h1><?php tmpmela_breadcrumbs(); ?></div></div></header>
<div class="main-content-inner">	
<?php if (get_option('tmpmela_page_sidebar') == 'yes') : ?>
<div id="primary" class="content-area">
<?php else : ?>
<div id="primary" class="main-content-inner-full">
<?php endif; ?>
  <div id="content" class="site-content" role="main">
    <div class="page-content">
      <p>
        <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'burge' ); ?>
      </p>
      <?php get_search_form(); ?>
    </div><!-- .page-content -->
  </div><!-- #content -->
</div><!-- #primary -->
<?php
if (get_option('tmpmela_page_sidebar') == 'yes') : 
	get_sidebar( 'content' );
	get_sidebar();
endif;  ?>
<?php get_footer(); ?>