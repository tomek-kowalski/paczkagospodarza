<?php  // Reference:  http://codex.wordpress.org/Widgets_API
class FooterContactUsWidget extends WP_Widget
{
    function __construct(){
		$widget_settings = array('description' => 'Footer Contact Us Widget', 'classname' => 'widgets-footercontact');
		parent::__construct(false,$name='TM - Footer Contact Us Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$text = empty($instance['text']) ? '' : $instance['text'];
		$address = empty($instance['address']) ? '' : $instance['address'];
		$imageSrc = empty($instance['imageSrc']) ? '' : $instance['imageSrc'];
		$email_title = empty($instance['email_title']) ? '' : $instance['email_title'];
		$linkURL = empty($instance['linkURL']) ? '' : $instance['linkURL'];
		$is_template_path = isset($instance['is_template_path']) ? $instance['is_template_path'] : false;
	    $window_target = isset($instance['window_target']) ? $instance['window_target'] : false;
		$ph_no = empty($instance['ph_no']) ? '' : $instance['ph_no'];
		if($is_template_path == 1 && $imageSrc != ""):
			$imageSrc= get_stylesheet_directory_uri() . '/images/codezeel/' . $imageSrc; 
		endif;
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
		<ul class="toggle-block">
			<li>
				<div class="contact_wrapper">
					<?php if($is_template_path == 1 && $imageSrc != "") : ?>
						<div class="tmpmela-footer-logo">
							 <a href="<?php if($linkURL == ""): echo esc_url(home_url( '#' )); else:?><?php echo esc_url($linkURL); endif;?>" 
								<?php if($window_target == true) echo 'target="_Self"'; ?>> 
								<img src="<?php echo esc_url($imageSrc); ?>" alt="<?php echo get_the_title() ?>" class="vv" />
							 </a>
						</div>
					<?php endif; ?>
						<div class="address">
							<div class="address_content">						
									<?php if(!empty($text)) : ?>
									<div class="contact_title">
										<?php echo esc_attr($text); ?>
									</div>
									<?php endif; ?>
									<?php if(!empty($address)) : ?>
									<i class="fa fa-map-marker" aria-hidden="true"></i>
									<div class="contact_address"><?php echo esc_attr($address); ?></div>
									<?php endif; ?>	
							</div>	
						</div>			
							<div class="phone">							
									<?php if(!empty($ph_no)) : ?>
									<i class="fa fa-phone" aria-hidden="true"></i>
									<div class="contact_phone"><?php echo esc_attr($ph_no); ?></div>
									<?php endif; ?>	
									</div>
							<div class="email">							
								<?php if(!empty($email_title)) : ?>
								<i class="fa fa-envelope" aria-hidden="true"></i>
								<div class="contact_email"><a href="<?php if($linkURL == ""): echo esc_url(home_url( '/' )) ; else:?>
								<?php echo esc_url($linkURL); endif;?>" <?php if($window_target == true) echo 'target="_Self"'; ?>>
								<?php echo esc_attr($email_title);  ?></a>
								</div>
								<?php endif; ?>
							</div>
				</div>
			</li>
		</ul>
		<?php		
		echo wp_kses( $after_widget,tmpmela_allowed_html());
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;		
		$instance['window_target'] = false;
		$instance['is_template_path'] = false;
		if (isset($new_instance['window_target'])) $instance['window_target'] = true;
		if (isset($new_instance['is_template_path'])) $instance['is_template_path'] = true;
		$instance['title'] =($new_instance['title']);
		$instance['text'] =($new_instance['text']);
		$instance['address'] =($new_instance['address']);
		$instance['imageSrc'] = strip_tags($new_instance['imageSrc']);
		$instance['email_title'] =($new_instance['email_title']);
		$instance['linkURL'] = strip_tags($new_instance['linkURL']);
		$instance['ph_no'] =($new_instance['ph_no']);
		return $instance;
	}
    function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
		'is_template_path'=>1,
		'title'=>'Contact Us', 		
		'text'=>'',
		'address'=>'60, 29th Street, San Francisco, CA 94110, United States of America',
		'imageSrc'=>'footer_logo.png', 
		'email_title'=>'demo@example.com',
		'linkURL'=>'#',
		'ph_no'=>'(+00) 123-456-789',
		'window_target'=> true) );	
		$title = esc_attr($instance['title']);
		$text = esc_attr($instance['text']);
		$imageSrc = esc_attr($instance['imageSrc']);
		$address = esc_attr($instance['address']);
		$email_title = esc_attr($instance['email_title']);
		$ph_no = esc_attr($instance['ph_no']);
		$linkURL = esc_attr($instance['linkURL']);
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('imageSrc'));?>">Logo Image URL1:<br /></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('imageSrc'));?>" name="<?php echo esc_attr($this->get_field_name('imageSrc'));?>" type="text" value="<?php echo esc_attr($imageSrc);?>" /><br />
			<input class="checkbox" type="checkbox" <?php checked($instance['is_template_path'], true) ?> id="<?php echo esc_attr($this->get_field_id('is_template_path')); ?>" name="<?php echo esc_attr($this->get_field_name('is_template_path')); ?>" /><label for="<?php echo esc_attr($this->get_field_id('is_template_path')); ?>">Use Template Path for Image</label>
		</p>
		<p><label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php esc_html_e('Title:', 'burge'); ?></label><input class="widefat" id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title'));?>" type="text" value="<?php echo esc_attr($title);?>" /></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('text'));?>"><?php esc_html_e('Text:', 'burge'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo esc_attr($this->get_field_id('text'));?>" name="<?php echo esc_attr($this->get_field_name('text'));?>" ><?php echo esc_attr($text);?></textarea></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('address'));?>"><?php esc_html_e('Address:', 'burge'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo esc_attr($this->get_field_id('address'));?>" name="<?php echo esc_attr($this->get_field_name('address'));?>" ><?php echo esc_attr($address);?></textarea></p>	
		<p><label for="<?php echo esc_attr($this->get_field_id('email_title'));?>"><?php esc_html_e('E-mail:', 'burge'); ?></label><input class="widefat" id="<?php echo esc_attr($this->get_field_id('email_title'));?>" name="<?php echo esc_attr($this->get_field_name('email_title'));?>" type="text" value="<?php echo esc_attr($email_title);?>" /></p>	
		<p><label for="<?php echo esc_attr($this->get_field_id('linkURL'));?>"><?php esc_html_e('Link URL:', 'burge'); ?><br /></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkURL'));?>" name="<?php echo esc_attr($this->get_field_name('linkURL'));?>" type="text" value="<?php echo esc_attr($linkURL);?>" />
		<label>(e.g. mailto:demo@example.com)</label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['window_target'], true) ?> id="<?php echo esc_attr($this->get_field_id('window_target')); ?>" name="<?php echo esc_attr($this->get_field_name('window_target')); ?>" /><label for="<?php echo esc_attr($this->get_field_id('window_target')); ?>"><?php esc_html_e('Open Link In New Window', 'burge'); ?></label></p>		
		<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
		<p><label for="<?php echo esc_attr($this->get_field_id('ph_no'));?>"><?php esc_html_e('Phone No:', 'burge'); ?></label><input class="widefat" id="<?php echo esc_attr($this->get_field_id('ph_no'));?>" name="<?php echo esc_attr($this->get_field_name('ph_no'));?>" type="text" value="<?php echo esc_attr($ph_no);?>" /></p>	
		<?php
	}
}
function FooterContactUs_Intit_Widget(){
	return register_widget('FooterContactUsWidget');
}
add_action('widgets_init', 'FooterContactUs_Intit_Widget');
// end BlogWidget
?>