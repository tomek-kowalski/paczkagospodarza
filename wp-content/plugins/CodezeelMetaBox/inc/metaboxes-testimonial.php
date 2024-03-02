<?php
/***********************************************************/
// Testimonial Template options
/***********************************************************/
$prefix = 'tmpmela_testimonial_list_';
$TM_META_BOXES[] = array(
	'id'		=> 'tmpmela_testimonial_list_columns',
	'title' 	=> esc_html__('TM - List Options', 'grassery'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'local_images' => true,
	'fields' 	=> array(	
		// Show number of posts per page
		array(
			'name'			=> esc_html__('Number of posts per page:', 'grassery'),
			'id'    		=> "{$prefix}posts_per_page",
			'type'  		=> 'text',
			'std'   		=> '5',
		),
	),
	'display_on'	=> array( 'template' => array(
		'page-templates/testimonial-list.php',
	) ),
);
$prefix = 'tmpmela_testimonial_box_';
$TM_META_BOXES[] = array(
	'id'		=> 'tmpmela_testimonial_box_columns',
	'title' 	=> esc_html__('TM - Box Options', 'grassery'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'local_images' => true,
	'fields' 	=> array(	
		// Show posts per column
		array(
			'name'    		=> esc_html__('Columns Options:', 'grassery'),
			'id'      		=> "{$prefix}columns",
			'type'    		=> 'radio',
			'std'			=> 'two',
			'options'		=> array(
				'two'		=> 'Two',
				'three'		=> 'Three',
				'four'		=> 'Four', 
			)
		),
		// Show number of posts per page
		array(
			'name'			=> esc_html__('Number of posts per page:', 'grassery'),
			'id'    		=> "{$prefix}posts_per_page",
			'type'  		=> 'text',
			'std'   		=> '5',
		),
	),
	'display_on'	=> array( 'template' => array(
		'page-templates/testimonial-box.php'
	) ),
);
?>