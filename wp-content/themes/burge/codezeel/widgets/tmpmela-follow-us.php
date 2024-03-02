<?php
/**
 * CodeZeel
 */
?>
<?php // Reference:  http://codex.wordpress.org/Widgets_API
class FollowMeWidget extends WP_Widget
{
    function __construct(){
		$widget_settings = array('description' => 'Follow Us Widget', 'classname' => 'widgets-follow-us');
		parent::__construct(false,$name='TM - Follow Us Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$linkURL1 = empty($instance['linkURL1']) ? '' : $instance['linkURL1'];
		$linkURL2 = empty($instance['linkURL2']) ? '' : $instance['linkURL2'];
		$linkURL3 = empty($instance['linkURL3']) ? '' : $instance['linkURL3'];
		$linkURL4 = empty($instance['linkURL4']) ? '' : $instance['linkURL4'];
		$linkURL5 = empty($instance['linkURL5']) ? '' : $instance['linkURL5'];
		$linkURL6 = empty($instance['linkURL6']) ? '' : $instance['linkURL6'];
		$linkURL7 = empty($instance['linkURL7']) ? '' : $instance['linkURL7'];
		$linkURL8 = empty($instance['linkURL8']) ? '' : $instance['linkURL8'];
		$linkURL9 = empty($instance['linkURL9']) ? '' : $instance['linkURL9'];	
		echo wp_kses( $before_widget,tmpmela_allowed_html());	
		if(!empty($title)) :		
			echo wp_kses( $before_title,tmpmela_allowed_html());		
		endif;
		if($title)		
		echo wp_kses( $title,tmpmela_allowed_html());
		if(!empty($title)) :			
			echo wp_kses( $after_title,tmpmela_allowed_html());				
		endif;		
		?>
	<div id="follow_us" class="follow-us">	
	<ul class="toggle-block">
	<li>
	<?php if(!empty($linkURL1)) :  ?>
		<a href="<?php echo esc_url($linkURL1); ?>" title="<?php echo esc_html__('Facebook', 'burge');?>" class="facebook icon"><i class="fa fa-facebook"></i></a>
	<?php endif; ?>
	<?php if(!empty($linkURL2)) :  ?>
		<a href="<?php echo esc_url($linkURL2); ?>" title="<?php echo esc_html__('Twitter', 'burge');?>" class="twitter icon"><i class="fa fa-twitter"></i></a>
	<?php endif; ?>	
	<?php if(!empty($linkURL3)) :  ?>
		<a href="<?php echo esc_url($linkURL3); ?>" title="<?php echo esc_html__('Linkedin', 'burge');?>" class="linkedin icon"><i class="fa fa-linkedin"></i></a>
	<?php endif; ?>
	<?php if(!empty($linkURL4)) :  ?>
		<a href="<?php echo esc_url($linkURL4); ?>" title="<?php echo esc_html__('RSS', 'burge');?>" class="rss icon"><i class="fa fa-rss"></i></a>
	<?php endif; ?>
	<?php if(!empty($linkURL5)) :  ?>
		<a href="<?php echo esc_url($linkURL5); ?>" title="<?php echo esc_html__('Youtube', 'burge');?>" class="youtube icon"><i class="fa fa-youtube"></i></a>
	<?php endif; ?>	
	<?php if(!empty($linkURL6)) :  ?>
		<a href="<?php echo esc_url($linkURL6); ?>" title="<?php echo esc_html__('Pinterest', 'burge');?>" class="pinterest icon"><i class="fa fa-pinterest"></i></a>
	<?php endif; ?>
	<?php if(!empty($linkURL7)) :  ?>
		<a href="<?php echo esc_url($linkURL7); ?>" title="<?php echo esc_html__('Google Plus', 'burge');?> " class="google-plus icon"><i class="fa fa-google-plus"></i></a>
	<?php endif; ?>
	<?php if(!empty($linkURL8)) :  ?>
		<a href="<?php echo esc_url($linkURL8); ?>" title="<?php echo esc_html__('Skype', 'burge');?>" class="skype icon"><i class="fa fa-skype"></i></a>
	<?php endif; ?>
	<?php if(!empty($linkURL9)) :  ?>
		<a href="<?php echo esc_url($linkURL9); ?>" title="<?php echo esc_html__('Instagram', 'burge');?>" class="instagram icon"><i class="fa fa-instagram"></i></a>
	<?php endif; ?>	
	</li>
	</ul>
</div>
<?php
		echo wp_kses( $after_widget,tmpmela_allowed_html());
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['linkURL1'] = strip_tags($new_instance['linkURL1']);
		$instance['linkURL2'] = strip_tags($new_instance['linkURL2']);
		$instance['linkURL3'] = strip_tags($new_instance['linkURL3']);
		$instance['linkURL4'] = strip_tags($new_instance['linkURL4']);
		$instance['linkURL5'] = strip_tags($new_instance['linkURL5']);
		$instance['linkURL6'] = strip_tags($new_instance['linkURL6']);
		$instance['linkURL7'] = strip_tags($new_instance['linkURL7']);
		$instance['linkURL8'] = strip_tags($new_instance['linkURL8']);
		$instance['linkURL9'] = strip_tags($new_instance['linkURL9']);		
		return $instance;
	}
    function form($instance){	
		$instance = wp_parse_args( (array) $instance, array(	
		'title'=>'Follow Us',	
		'linkURL1' => '#', 
		'linkURL2' => '#',
		'linkURL3' => '#', 
		'linkURL4' => '#', 
		'linkURL5' => '#',
		'linkURL6' => '#',
		'linkURL7' => '#',
		'linkURL8' => '#',
		'linkURL9' => '#') );
		$title = esc_attr($instance['title']);		
		$linkURL1 = esc_attr($instance['linkURL1']);
		$linkURL2 = esc_attr($instance['linkURL2']);
		$linkURL3 = esc_attr($instance['linkURL3']);
		$linkURL4 = esc_attr($instance['linkURL4']);
		$linkURL5 = esc_attr($instance['linkURL5']);
		$linkURL6 = esc_attr($instance['linkURL6']);
		$linkURL7 = esc_attr($instance['linkURL7']);
		$linkURL8 = esc_attr($instance['linkURL8']);
		$linkURL9 = esc_attr($instance['linkURL9']);?>
<p><label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php esc_html_e('Title:', 'burge'); ?></label><input class="widefat" id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title'));?>" type="text" value="<?php echo esc_attr($title);?>" /></p>
<p style="text-align:center">
  <label for="<?php echo esc_attr($this->get_field_id('linkURL1'));?>"><strong>Facebook</strong></label>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('linkURL1'));?>">Link URL:<br />
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL1'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL1'));?>" type="text" value="<?php echo esc_attr($linkURL1);?>" />
  <label>(e.g. http://www.facebook.com/...)</label>
  <br />
</p>
<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
<p style="text-align:center">
  <label for="<?php echo esc_attr($this->get_field_id('linkURL2'));?>"><strong>Twitter</strong></label>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('linkURL2'));?>">Link URL:<br />
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL2'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL2'));?>" type="text" value="<?php echo esc_attr($linkURL2);?>" />
  <label>(e.g. http://www.Twitter.com/...)</label>
  <br />
</p>
<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
<p style="text-align:center">
  <label for="<?php echo esc_attr($this->get_field_id('linkURL3'));?>"><strong>Linkedin</strong></label>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('linkURL3'));?>">Link URL:<br />
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL3'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL3'));?>" type="text" value="<?php echo esc_attr($linkURL3);?>" />
  <label>(e.g. http://linkedin.com...)</label>
  <br />
</p>
<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
<p style="text-align:center">
  <label for="<?php echo esc_attr($this->get_field_id('linkURL4'));?>"><strong>RSS</strong></label>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('linkURL4'));?>">Link URL:<br />
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL4'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL4'));?>" type="text" value="<?php echo esc_attr($linkURL4);?>" />
  <label>(e.g. http://feeds.feedburner.com/...)</label>
  <br />
</p>
<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
<p style="text-align:center">
  <label for="<?php echo esc_attr($this->get_field_id('linkURL5'));?>"><strong>Youtube</strong></label>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('linkURL5'));?>">Link URL:<br />
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL5'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL5'));?>" type="text" value="<?php echo esc_attr($linkURL5);?>" />
  <label>(e.g. http://www.youtube.com/...)</label>
  <br />
</p>
<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
<p style="text-align:center">
  <label for="<?php echo esc_attr($this->get_field_id('linkURL6'));?>"><strong>Pinterest</strong></label>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('linkURL6'));?>">Link URL:<br />
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL6'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL6'));?>" type="text" value="<?php echo esc_attr($linkURL6);?>" />
  <label>(e.g. http://www.pinterest.com/...)</label>
  <br />
</p>
<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
<p style="text-align:center">
  <label for="<?php echo esc_attr($this->get_field_id('linkURL7'));?>"><strong>Google Plus</strong></label>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('linkURL7'));?>">Link URL:<br />
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL7'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL7'));?>" type="text" value="<?php echo esc_attr($linkURL7);?>" />
  <label>(e.g. http://www.google.com/...)</label>
  <br />
</p>
<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
<p style="text-align:center">
  <label for="<?php echo esc_attr($this->get_field_id('linkURL8'));?>"><strong>Skype</strong></label>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('linkURL8'));?>">Link URL:<br />
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL8'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL8'));?>" type="text" value="<?php echo esc_attr($linkURL8);?>" />
  <label>(e.g. http://www.skype.com/...)</label>
  <br />
</p>
<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
<p style="text-align:center">
  <label for="<?php echo esc_attr($this->get_field_id('linkURL9'));?>"><strong>Instagram</strong></label>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('linkURL9'));?>">Link URL:<br />
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL9'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL9'));?>" type="text" value="<?php echo esc_attr($linkURL9);?>" />
  <label>(e.g. http://www.instagram.com/...)</label>
  <br />
</p>
<?php
	}
}
function FollowMe_Intit_Widget(){
	return register_widget('FollowMeWidget');
}
add_action('widgets_init', 'FollowMe_Intit_Widget');
// end foolow me widgets
?>