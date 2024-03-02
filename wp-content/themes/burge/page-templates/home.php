<?php
/* Template Name: Home */ 
?>
<?php 
get_header();
?>
<div id="main-content" class="main-content home-page <?php echo esc_attr(tmpmela_sidebar_position()); ?> <?php echo esc_attr(tmpmela_page_layout()); ?> ">

<?php
$frontpage_data	= wp_get_recent_posts(array(
    		'post_type'		   => 'front-page',
			'postnumber'	   =>  1,
			'post_status' 	   => 'publish',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
		));
?>
<?php
foreach ($frontpage_data as $data) :
    $postid = $data['ID'];
    $text_promo = get_post_meta($postid, 'front_page_text_1', true) ? get_post_meta($postid, 'front_page_text_1', true) : '';
	$image_front_img_url = get_post_meta($postid, 'front_page_image_1', true) ? get_post_meta($postid, 'front_page_image_1', true) : '';

    if ($text_promo) {
		echo '<div class="before-promo-line"></div>';
        echo '<div class="promo-line promo-text">' . esc_html($text_promo,'burge') . '</div>';
    }

	if ($image_front_img_url) {
		echo '<img class="img-front-page" src="' . esc_url($image_front_img_url) . '" alt="Koszyk" ">';
	}
    
endforeach;

?>

<?php if (get_option('tmpmela_page_sidebar') == 'yes') : ?>
<div id="primary" class="content-area">
<?php else : ?>
<div id="primary" class="main-content-inner-full">
<?php endif; ?> 
    <div id="content" class="site-content" role="main">
      <?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
					// Include the page content template.
					get_template_part( 'content', 'page' ); ?>
      <?php endwhile;
			?>
    </div><!-- #content -->
</div><!-- #primary -->
   <?php 
if (get_option('tmpmela_page_sidebar') == 'yes') : 
	get_sidebar( 'content' );
	get_sidebar();
endif;  ?><!-- #main-content -->
</div>
<?php get_footer(); ?>