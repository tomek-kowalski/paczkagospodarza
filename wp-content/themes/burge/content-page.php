<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage CodeZeel
 * @since CodeZeel 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
		// Page thumbnail and title.
		tmpmela_post_thumbnail();
		?>
  <div class="entry-content">
    <?php the_content(); ?>
    <div class="inner-container">
	<?php 
		wp_link_pages( array(
		'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'burge' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
		) );		
		edit_post_link( esc_html__( 'Edit', 'burge' ), '<span class="edit-link">', '</span>' );
	?>
    </div>
    <!-- .inner-container -->
  </div>
  <!-- .entry-content -->
</article>
<!-- #post-## -->