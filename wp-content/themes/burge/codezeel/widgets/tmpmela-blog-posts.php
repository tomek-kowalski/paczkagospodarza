<?php
/**
 * CodeZeel
 * @copyright  Copyright (c) 2010 CodeZeel. (http://www.codezeel.com)
 * @license    http://www.codezeel.com/license/
 */
?>
<?php  // Reference:  http://codex.wordpress.org/Widgets_API
class BlogPostsWidget extends WP_Widget
{
    function __construct(){
		$widget_settings = array('description' => 'Blog Posts Widget', 'classname' => 'widgets-blog-posts');
		parent::__construct(false,$name='TM - Blog Posts Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$totalblog = empty($instance['totalblog']) ? '' : $instance['totalblog'];
	
		echo balanceTags($before_widget);	
		if(!empty($title)) :		
			echo balanceTags($before_title);			
		endif;
		if($title)		
		echo balanceTags($title);	
		if(!empty($title)) :			
			echo balanceTags($after_title);				
		endif;			
		?> 
		<ul class="toggle-block">
	
		<?php $latest = new WP_Query( array( 'posts_per_page' => $totalblog));
		if( $latest->have_posts() ) :?>
		
		 <?php while( $latest->have_posts() ) : $latest->the_post(); ?>
			<li>      
			<?php if ( has_post_thumbnail()) : ?>
			 <?php the_post_thumbnail(array(80,80), array('class' => 'icon80')); ?>    
			<?php endif; ?>
			<div class="post-detail">
			<?php tmpmela_post_entry_date(); ?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
			</li>
		 <?php endwhile; ?>
		<?php endif; wp_reset_postdata(); ?>
		</ul>
		<?php		
		echo balanceTags($after_widget);				
	}
	function update($new_instance, $old_instance){
		$instance = $old_instance;	
		$instance['title'] =($new_instance['title']);		
		$instance['totalblog'] =($new_instance['totalblog']);
		return $instance;
	}
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
		'title'=>'Latest News',
		'totalblog'=>'') );	
		$title	= esc_attr($instance['title']);			
		$totalblog	= esc_attr($instance['totalblog']);	
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php esc_html_e('Title:', 'burge'); ?></label><input class="widefat" type="text"  id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title'));?>" value="<?php echo esc_attr($title);?>"/></p>
	<p><label for="<?php echo esc_attr($this->get_field_id('totalblog'));?>"><?php esc_html_e('Display Blog:', 'burge'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('totalblog'));?>" name="<?php echo esc_attr($this->get_field_name('totalblog'));?>" type="text" value="<?php echo esc_attr($totalblog);?>" />
		<label>(e.g. 1,2,3,4,...)</label><br />
	</p>
	<?php
	}
}
function BlogPosts_Intit_Widget(){
	return register_widget('BlogPostsWidget');
}
add_action('widgets_init', 'BlogPosts_Intit_Widget');
?>