<?php
/**
 * CodeZeel
 * @copyright  Copyright (c) 2010 CodeZeel.
 */
?>
<?php  // Reference:  http://codex.wordpress.org/Widgets_API
class LeftBannerWidget extends WP_Widget
{
    function __construct(){
		$widget_settings = array('description' => 'Left Banner Widget', 'classname' => 'widgets-leftbanner');
		parent::__construct(false,$name='TM - Left Banner Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$window_target = isset($instance['window_target']) ? $instance['window_target'] : false;
		$is_template_path1 = isset($instance['is_template_path1']) ? $instance['is_template_path1'] : false;
		$imageSrc1 = empty($instance['imageSrc1']) ? '' : $instance['imageSrc1'];
		$linkURL = empty($instance['linkURL']) ? '' : $instance['linkURL'];
		if($is_template_path1 == 1):
			$imageSrc1 = get_stylesheet_directory_uri() . '/images/codezeel/banners/' . $imageSrc1; 
		endif;	
		echo wp_kses( $before_widget,tmpmela_allowed_html());	
	?>
			<div class="left-banner">
				<a href="<?php if($linkURL == ""): echo esc_url(home_url( '/' )); else:?><?php echo esc_url($linkURL); endif;?>" 
					<?php if($window_target == true) echo 'target="_Self"'; ?>> 
					<img src="<?php echo esc_url($imageSrc1); ?>" alt="<?php echo esc_html_e('leftbanner','burge'); ?>" class="vv" />
				 </a> 
			</div>
	<?php		
	echo wp_kses( $after_widget,tmpmela_allowed_html());
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['window_target'] = false;
		$instance['is_template_path1'] = false;
		if (isset($new_instance['window_target'])) $instance['window_target'] = true;
		if (isset($new_instance['is_template_path1'])) $instance['is_template_path1'] = true;
		$instance['linkURL'] = strip_tags($new_instance['linkURL']);
		$instance['imageSrc1'] = strip_tags($new_instance['imageSrc1']);
		if($is_template_path1 == 1):
			$imageSrc1 = get_template_directory_uri() . '/images/banners/' . $imageSrc1; 
		endif;
		return $instance;
	}
    function form($instance){
		$instance = wp_parse_args( (array) $instance, array('imageSrc1'=>'left-banner.jpg','linkURL'=>'#','window_target'=>'', 'is_template_path1'=>true) );
		$linkURL = esc_attr($instance['linkURL']);	
		$imageSrc1 = esc_attr($instance['imageSrc1']);
		$window_target =  esc_attr($instance['window_target']);
		$is_template_path1 =  esc_attr($instance['is_template_path1']); 
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('imageSrc1'));?>">Image URL:<br /></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('imageSrc1'));?>" name="<?php echo esc_attr($this->get_field_name('imageSrc1'));?>" type="text" value="<?php echo esc_attr($imageSrc1);?>" /><br />
			<input class="checkbox" type="checkbox" <?php checked($instance['is_template_path1'], true) ?> id="<?php echo esc_attr($this->get_field_id('is_template_path1')); ?>" name="<?php echo esc_attr($this->get_field_name('is_template_path1')); ?>" /><label for="<?php echo esc_attr($this->get_field_id('is_template_path1')); ?>">Use Template Path for Image</label>
		</p>	
<p>
  <label for="<?php echo esc_attr($this->get_field_id('linkURL'));?>">Link URL:<br />
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL'));?>" type="text" value="<?php echo esc_attr($linkURL);?>" />
  <label>(e.g. http://www.yoursite.com/...)</label>
  <br />
  <input class="checkbox" type="checkbox" <?php checked($instance['window_target'], true) ?> id="<?php echo esc_attr($this->get_field_id('window_target')); ?>" name="<?php echo esc_attr($this->get_field_name('window_target')); ?>" />
  <label for="<?php echo esc_attr($this->get_field_id('window_target')); ?>">Open Link In New Window</label>
</p>
<?php
	}
}
function LeftBanner_Intit_Widget(){
	return register_widget('LeftBannerWidget');
}
add_action('widgets_init', 'LeftBanner_Intit_Widget');
// end ServicesWidget
?>