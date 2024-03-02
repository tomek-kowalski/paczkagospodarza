<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, CodeZeel
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage CodeZeel
 * @since CodeZeel 1.0
 */
get_header(); ?>
<header>
<div class="page-title"><div class="page-title-inner"><?php the_archive_title( '<h1 class="entry-title-main">', '</h1>' ); ?><?php tmpmela_breadcrumbs(); ?></div></div>
</header>
<div id="main-content" class="main-content blog-page blog-list">
<div class="main-content-inner">
<?php 
if (get_option('tmpmela_page_sidebar') == 'yes') : ?>
<section id="primary" class="content-area">
<?php else : ?>
<section id="primary" class="main-content-inner-full">
<?php endif; ?>
      <div id="content" class="site-content" role="main">
	  <div class="blog">
    <?php if ( have_posts() ) : ?>   
    <!-- .page-header -->
    <?php			// Start the Loop.
					while ( have_posts() ) : the_post();
						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					endwhile;?>
	 </div>
	  <?php
					// Previous/next page navigation.
					tmpmela_paging_nav();
				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );
				endif;
			?>
  </div><!-- #content -->
</section><!-- #primary -->
<?php
if (get_option('tmpmela_page_sidebar') == 'yes') : 
	get_sidebar( 'content' );
	get_sidebar();
endif;  ?>
</div><!--main-content-inner -->
</div><!-- main-content -->
<?php  get_footer(); ?>