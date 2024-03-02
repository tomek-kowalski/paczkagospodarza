<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * @package WordPress
 * @subpackage CodeZeel
 * @since CodeZeel 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-main-content">
	<?php if ( is_search() || !is_single()) : // Only display Excerpts for Search and not single pages ?>
	  <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
		 <div class="blog-icon"></div>
			<?php tmpmela_sticky_post(); ?>
			<?php 
				 the_post_thumbnail('tmpmela-blog-posts-list');
               $postImage = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
				?>
				<?php 
				if(!empty($postImage)): ?>
					<div class="block_hover">
					<div class="links">
					<a href="<?php echo esc_url($postImage); ?>" title="<?php esc_html_e( 'Click to view Full Image', 'burge' );?>" data-lightbox="example-set" class="icon mustang-gallery"><i class="fa fa-plus"></i></a> <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php esc_html_e( 'Click to view Read More', 'burge' );?>" class="icon readmore"><i class="fa fa-link"></i></a> 
					</div>
				</div>
				<?php endif; ?>
		</div>			
		  <?php else : ?>			
			<?php if ($postImage = tmpmela_get_first_post_images(get_the_ID())):?>			 
				 <div class="entry-thumbnail">
					<span class="blog-posts-list"><img src="<?php echo esc_url($postImage); ?>"></span>
					<?php 
					if(!empty($postImage)): ?>
					<div class="block_hover">
					<div class="links">
					<a href="<?php echo esc_url($postImage); ?>" title="<?php esc_html_e( 'Click to view Full Image', 'burge' );?>" data-lightbox="example-set" class="icon mustang-gallery"><i class="fa fa-plus"></i></a> <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php esc_html_e( 'Click to view Read More', 'burge' );?>" class="icon readmore"><i class="fa fa-link"></i></a> 
					</div>
					</div>
				<?php endif; ?>
					</div>		
			<?php endif; ?>				
  		<?php endif; ?>
		<div class="post-info <?php if(empty($postImage)): ?> non <?php endif; ?>"><!-- post-info -->
		<div class="entry-content-inner">
			<div class="entry-meta-inner">
				<div class="entry-meta">
				  <?php tmpmela_entry_date(); ?>
				  <?php tmpmela_comments_link(); ?>
		  		</div>
		 	 </div>
			<div class="entry-main-header post-header">
			 <a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"></a>
				<div class="blog-header"><!-- blog-header -->
						<?php 
							if( $post->post_title == '' ) : 
								$entry_meta_class = "empty-entry-header";
							else :
								$entry_meta_class = "";
							endif; ?>
						<header class="entry-header <?php echo esc_attr($entry_meta_class); ?>">					
								<h1 class="entry-title"> <a href="<?php esc_url(the_permalink()); ?>" rel="bookmark">
								<?php the_title(); ?>
								</a> </h1>					
						</header><!-- .entry-header -->	
				</div><!-- blog-header -->	
		</div><!-- .entry-main-header -->	
		
		  </div>
  	<?php endif; ?>
	<div class="entry-content-other">		
		<?php if ( is_search() || !is_single()) : // Only display Excerpts for Search and not single pages ?>
			<div class="entry-summary">
				<div class="excerpt"> <?php echo tmpmela_posts_short_description(); ?> </div>
			</div><!-- .entry-summary -->
		</div><!-- post-info -->
			<?php else : ?>
			<div class="entry-main-header">
				<?php 
				if( $post->post_title == '' ) : 
				$entry_meta_class = "empty-entry-header";
				else :
				$entry_meta_class = "";
				endif; ?>
				<header class="entry-header <?php echo esc_attr($entry_meta_class); ?>">					
				<h1 class="entry-title"> 
				<?php the_title(); ?>
				<?php tmpmela_sticky_post(); ?> </h1>					
				</header><!-- .entry-header -->
			</div><!-- .entry-main-header -->
			<div class="entry-content">
			 <?php 
				 the_post_thumbnail('tmpmela-blog-posts-list');
				 $postImage = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
			 ?>
			 <?php the_content( wp_kses( __('Continue reading <span class="meta-nav">&rarr;</span>', 'burge' ),tmpmela_allowed_html())); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'burge' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div><!-- .entry-content -->	
		<?php endif; ?>
	</div> <!-- entry-content-other -->	
  </div>
</article>
<!-- #post -->