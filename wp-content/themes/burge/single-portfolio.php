<?php
/**
 * CodeZeel
 * @copyright  Copyright (c) CodeZeel.
 * @author         CodeZeel
 * @version        Release: 1.0
 */
?>
<?php
//taxonomy
$taxonomy = 'portfolio_categories';
$link_page= '';
//category link
$terms = get_the_terms($post->ID, $taxonomy);
$i=0;
foreach ($terms as $taxindex => $taxitem) {
	if($i==0):
		$link_cat=get_term_link($taxitem->slug,$taxonomy);
		$term_slug = $taxitem->slug;
		$term_id = $taxitem->term_id;    
	endif;
$i++;
}
?>
<?php get_header(); ?>
<!--Start #primary-->
<?php if (get_option('tmpmela_page_sidebar') == 'yes') : ?>
<div id="primary" class="content-area  image-attachment">
<?php else : ?>
<div id="primary" class="main-content-inner-full image-attachment">
<?php endif; ?>
    <!--Start #content-->
  <div id="content" class="site-content" role="main">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="entry-main-content">
         <div class="entry-content-inner">
		 <div class="entry-meta">
	<?php tmpmela_entry_date(); ?>
	<div class="meta-inner"><span class="parent-post-link"><a href="<?php echo esc_url(get_permalink( $post->post_parent )); ?>" rel="gallery"><?php echo esc_attr(get_the_title( $post->post_parent )); ?></a></span></div>
	<?php edit_post_link( esc_html__( 'Edit', 'burge' ), '<span class="edit-link"><i class="fa fa-pencil"></i>', '</span>' ); ?>
	       </div>
		  </div>
		<?php the_content(); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . esc_html__( 'Pages:', 'burge' ), 'after' => '</div>' ) ); ?>
      </div>
      <!-- .entry-content -->
      <div class="entry-utility-port">
        <?php edit_post_link( esc_html__( 'Edit', 'burge' ), '<span class="edit-link">', '</span>' ); ?>
      </div>
      <!-- .entry-utility -->
      <?php if ( comments_open() ) : ?>
      <?php comments_template( '', true ); ?>
      <?php endif; ?>
    </div>
    <!-- #post-## -->
    <?php endwhile; // end of the loop. ?>
  </div><!-- End #content -->
</div><!-- End #primary-->
<?php 
if (get_option('tmpmela_page_sidebar') == 'yes') : 
		get_sidebar( 'content' );
		get_sidebar();
	endif; 
 get_footer(); ?>