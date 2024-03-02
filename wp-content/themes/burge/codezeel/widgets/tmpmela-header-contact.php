<?php  // Reference:  http://codex.wordpress.org/Widgets_API
class HeaderContactWidget extends WP_Widget
{
    function __construct(){
		$widget_settings = array('description' => 'Header Contact Widget', 'classname' => 'widgets-headercontact');
		parent::__construct(false,$name='TM - Header Contact Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$phoneno1 = empty($instance['phoneno1']) ? '' : $instance['phoneno1'];
		$phoneno2 = empty($instance['phoneno2']) ? '' : $instance['phoneno2'];
		$whatsapp = empty($instance['whatsapp']) ? '' : $instance['whatsapp'];
		$skype = empty($instance['skype']) ? '' : $instance['skype'];
		$is_template_path = isset($instance['is_template_path']) ? $instance['is_template_path'] : false;
	    $window_target = isset($instance['window_target']) ? $instance['window_target'] : false;
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
			<li>
				<div class="header_contact_wrapper">
							<?php if(!empty($phoneno1)) : ?>
									<div class="contact phoneno1">				
												<i class="fa fa-phone" aria-hidden="true"></i>
												<div class="phone contact_phoneno1"><?php echo esc_attr($phoneno1); ?></div>
									</div>		
							<?php endif; ?>					
							<?php if(!empty($phoneno2)) : ?>
								<div class="contact phoneno2">				
									<i class="fa fa-phone" aria-hidden="true"></i>
									<div class="phone contact_phoneno2"><?php echo esc_attr($phoneno2); ?></div>
								</div>
							<?php endif; ?>				
							<?php if(!empty($whatsapp)) : ?>
									<div class="contact whatsapp">				
										<i class="fa fa-whatsapp" aria-hidden="true"></i>
										<div class="phone contact_phoneno2"><?php echo esc_attr($whatsapp); ?></div>
									</div>
							<?php endif; ?>					
							<?php if(!empty($skype)) : ?>
									<div class="contact skype">			
										<i class="fa fa-skype" aria-hidden="true"></i>
										<div class="phone contact_skype"><?php echo esc_attr($skype); ?></div>
									</div>
							<?php endif; ?>	
				</div>
			</li>
		</ul>
		<?php		
		echo balanceTags($after_widget);		
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;		
		$instance['window_target'] = false;
		$instance['is_template_path'] = false;
		if (isset($new_instance['window_target'])) $instance['window_target'] = true;
		if (isset($new_instance['is_template_path'])) $instance['is_template_path'] = true;
		$instance['title'] =($new_instance['title']);
		$instance['phoneno1'] =($new_instance['phoneno1']);
		$instance['phoneno2'] =($new_instance['phoneno2']);
		$instance['whatsapp'] =($new_instance['whatsapp']);
		$instance['skype'] =($new_instance['skype']);
		return $instance;
	}
    function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
		'is_template_path'=>1,
		'title'=>'Need Help ?',
		'phoneno1'=>'0000-00-00', 		
		'phoneno2'=>'9876543210',
		'whatsapp'=>'8888-888-88',
		'skype'=>'+9876543210', 
		'window_target'=> true) );	
		$title = esc_attr($instance['title']);
		$phoneno1 = esc_attr($instance['phoneno1']);
		$phoneno2 = esc_attr($instance['phoneno2']);
		$whatsapp = esc_attr($instance['whatsapp']);
		$skype = esc_attr($instance['skype']);
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php esc_html_e('Title:', 'burge'); ?></label><input class="widefat" id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title'));?>" type="text" value="<?php echo esc_attr($title);?>" /></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('phoneno1'));?>"><?php esc_html_e('Phone No 1:', 'burge'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo esc_attr($this->get_field_id('phoneno1'));?>" name="<?php echo esc_attr($this->get_field_name('phoneno1'));?>" ><?php echo esc_attr($phoneno1);?></textarea></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('phoneno2'));?>"><?php esc_html_e('Phone No 2:', 'burge'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo esc_attr($this->get_field_id('phoneno2'));?>" name="<?php echo esc_attr($this->get_field_name('phoneno2'));?>" ><?php echo esc_attr($phoneno2);?></textarea></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('whatsapp'));?>"><?php esc_html_e('Whatsapp:', 'burge'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo esc_attr($this->get_field_id('whatsapp'));?>" name="<?php echo esc_attr($this->get_field_name('whatsapp'));?>" ><?php echo esc_attr($whatsapp);?></textarea></p>	
		<p><label for="<?php echo esc_attr($this->get_field_id('skype'));?>"><?php esc_html_e('Skype:', 'burge'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo esc_attr($this->get_field_id('skype'));?>" name="<?php echo esc_attr($this->get_field_name('skype'));?>" ><?php echo esc_attr($skype);?></textarea></p>	
		<?php
	}
}
function HeaderContact_Intit_Widget(){
	return register_widget('HeaderContactWidget');
}
add_action('widgets_init', 'HeaderContact_Intit_Widget');
// end BlogWidget
?>