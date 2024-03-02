<?php
add_action( 'wp_head', 'tmpmela_customstyle' );
function tmpmela_customstyle() { ?>
<?php
$font_family1 = get_option('tmpmela_bodyfont');
$font_family1 = str_replace(' ', '+', $font_family1);
$font_family2 = get_option('tmpmela_navfont');
$font_family2 = str_replace(' ', '+', $font_family2);
$font_family3 = get_option('tmpmela_h1font');
$font_family3 = str_replace(' ', '+', $font_family3);
$font_family4 = get_option('tmpmela_h2font');
$font_family4 = str_replace(' ', '+', $font_family4);
$font_family5 = get_option('tmpmela_h3font');
$font_family5 = str_replace(' ', '+', $font_family5);
$font_family6 = get_option('tmpmela_h4font');
$font_family6 = str_replace(' ', '+', $font_family6);
$font_family7 = get_option('tmpmela_h5font');
$font_family7 = str_replace(' ', '+', $font_family7);
$font_family8 = get_option('tmpmela_h6font');
$font_family8 = str_replace(' ', '+', $font_family8);
$font_family9 = get_option('tmpmela_footerfont');
$font_family9 = str_replace(' ', '+', $font_family9);
// REMOVES DUPLICATE GOOGLE FONT CALL
$fonts_array = array($font_family1,$font_family2,$font_family3,$font_family4,$font_family5,$font_family6,$font_family7,$font_family8,$font_family9);
// REMOVES DUPLICATE GOOGLE FONT CALL
$fonts_array= array_unique($fonts_array);
foreach ($fonts_array as $key => $val) {
	if($val!='' && $val!='please-select' && $val!='Other+Fonts' && $val!='Open+Sans'){ ?>
		<link href='https://fonts.googleapis.com/css?family=<?php echo esc_attr($val); ?>' rel='stylesheet' type='text/css' />
	<?php }
}
// end REMOVES DUPLICATE GOOGLE FONT CALL
?>
<style type="text/css">
	<?php if( (get_option('tmpmela_h1font') == "Other+Fonts") || get_option('tmpmela_h1font') == "please-select"){  
	if	(get_option('tmpmela_h1font_other') != ""){ ?>
	h1 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h1font_other'))); ?>', Arial, Helvetica, sans-serif;		
	}	
	<?php } } elseif(get_option('tmpmela_h1font') != "" && get_option('tmpmela_h1font') != "please-select"){ ?>
	h1 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h1font'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php } ?>
	<?php if (get_option('tmpmela_h1color') != ""){ ?>
	h1 {	
		color:#<?php echo esc_attr(get_option('tmpmela_h1color')); ?>;	
	}	
	<?php } ?>
	<?php if( (get_option('tmpmela_h2font') == "Other+Fonts") || get_option('tmpmela_h2font') == "please-select"){  
	if	(get_option('tmpmela_h2font_other') != ""){ ?>
	h2 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h2font_other'))); ?>', Arial, Helvetica, sans-serif;	
	}	
	<?php } } elseif(get_option('tmpmela_h2font') != "" && get_option('tmpmela_h2font') != "please-select"){ ?>
	h2 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h2font'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php } ?>
	<?php if(get_option('tmpmela_h2color') != ""){ ?>
	h2 {	
		color:#<?php echo esc_attr(get_option('tmpmela_h2color')); ?>;	
	}	
	<?php } ?>
	<?php 
	if( (get_option('tmpmela_h3font') == "Other+Fonts") || get_option('tmpmela_h3font') == "please-select"){  
	if	(get_option('tmpmela_h3font_other') != ""){ ?>
	h3 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h3font_other'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php } } elseif(get_option('tmpmela_h3font') != "" && get_option('tmpmela_h3font') != "please-select"){ ?>
	h3 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h3font'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php } ?>
	<?php if (get_option('tmpmela_h3color') != ""){ ?>
	h3 { color:#<?php echo esc_attr(get_option('tmpmela_h3color')); ?>;}
	<?php } ?>
	<?php if( (get_option('tmpmela_h4font') == "Other+Fonts") || get_option('tmpmela_h4font') == "please-select"){  
	if	(get_option('tmpmela_h4font_other') != ""){ ?>
	h4 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h4font_other'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php } } elseif(get_option('tmpmela_h4font') != "" && get_option('tmpmela_h4font') != "please-select"){ ?>
	h4 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h4font'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php } ?>	
	<?php if(get_option('tmpmela_h4color') != ""){ ?>
	h4 {	
		color:#<?php echo esc_attr(get_option('tmpmela_h4color')); ?>;	
	}	
	<?php } ?>
	<?php if( (get_option('tmpmela_h5font') == "Other+Fonts") || get_option('tmpmela_h5font') == "please-select"){  
	if	(get_option('tmpmela_h5font_other') != ""){ ?>
	h5 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h5font_other'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php } } elseif(get_option('tmpmela_h5font') != "" && get_option('tmpmela_h5font') != "please-select"){ ?>
	h5 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h5font'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php } ?>
	<?php if(get_option('tmpmela_h5color') != ""){ ?>
	h5 {	
		color:#<?php echo esc_attr(get_option('tmpmela_h5color')); ?>;	
	}	
	<?php } ?>
	<?php if( (get_option('tmpmela_h6font') == "Other+Fonts") || get_option('tmpmela_h6font') == "please-select"){  
	if	(get_option('tmpmela_h6font_other') != ""){ ?>
	h6 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h6font_other'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php } } elseif(get_option('tmpmela_h6font') != "" && get_option('tmpmela_h6font') != "please-select"){ ?>
	h6 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h6font'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php }  ?>	
	<?php 
	if(get_option('tmpmela_h6color') != ""){ ?>
	h6 {	
		color:#<?php echo esc_attr(get_option('tmpmela_h6color')); ?>;	
	}	
	<?php } ?>
	<?php if( (get_option('tmpmela_h3font') == "Other+Fonts") || get_option('tmpmela_h3font') == "please-select"){  
	if	(get_option('tmpmela_h3font_other') != ""){ ?>
	.home-service h3.widget-title {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h3font_other'))); ?>', Arial, Helvetica, sans-serif;	
	}	
	<?php } } elseif(get_option('tmpmela_h3font') != "" && get_option('tmpmela_h3font') != "please-select"){ ?>
	.home-service h3.widget-title {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h3font'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php } ?>
	a {
		color:#<?php echo esc_attr(get_option('tmpmela_link_color')); ?>;
	}
	a:hover {
		color:#<?php echo esc_attr(get_option('tmpmela_hoverlink_color')); ?>;
	}
	.footer a, .site-footer a, .site-footer{
		color:#<?php echo esc_attr(get_option('tmpmela_footerlink_color')); ?>; 
	}
	.footer a:hover, .footer .footer-links li a:hover, .site-footer a:hover{
		color:#<?php echo esc_attr(get_option('tmpmela_footerhoverlink_color')); ?>;		 
	}
	.site-footer
	{
		background-color:#<?php echo esc_attr(get_option('tmpmela_footer_bkg_color')) ; ?>;
		<?php if(get_option('tmpmela_footer_background_upload')!=''){ ?>
		background-image: url("<?php echo esc_url(get_option('tmpmela_footer_background_upload')); ?>");
		background-position:<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_footer_back_position'))); ?>;
		background-repeat:<?php echo esc_attr(get_option('tmpmela_footer_back_repeat')); ?>;
		background-attachment:<?php echo esc_attr(get_option('tmpmela_footer_back_attachment')); ?>;
		<?php } ?>
	}
	<?php 
	if( (get_option('tmpmela_h3font') == "Other+Fonts") || get_option('tmpmela_h3font') == "please-select"){  
	if	(get_option('tmpmela_h3font_other') != ""){ ?>
	h3 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h3font_other'))); ?>', Arial, Helvetica, sans-serif;	
	}	
	<?php } } elseif(get_option('tmpmela_h3font') != "" && get_option('tmpmela_h3font') != "please-select"){ ?>
	h3 {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_h3font'))); ?>', Arial, Helvetica, sans-serif;	
	}	
	<?php } ?>	
	<?php 
	if( (get_option('tmpmela_footerfont') == "Other+Fonts") || get_option('tmpmela_footerfont') == "Please-Select"){  
	if	(get_option('tmpmela_footerfont_other') != ""){ ?>
	.site-footer {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_footerfont_other'))); ?>', Arial, Helvetica, sans-serif;
	}	
	<?php } } elseif(get_option('tmpmela_footerfont') != "" && get_option('tmpmela_footerfont') != "please-select"){ ?>
	.site-footer {	
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_footerfont'))); ?>', Arial, Helvetica, sans-serif;	
	}	
	<?php } ?>	
	.site-footer {
		background-color:<?php echo tmpmela_hex_to_rgba(esc_attr(get_option('tmpmela_footer_bkg_color'))); ?>; 
	}	
	body {
		background-color:#<?php echo esc_attr(get_option('tmpmela_bkg_color')) ; ?> ;
		<?php if(get_option('tmpmela_background_upload')==''){ ?>
		background-image: url("<?php echo esc_url(get_template_directory_uri()); ?>/images/codezeel/colorpicker/pattern/<?php echo esc_attr(get_option('tmpmela_texture')); ?>");
		background-position:<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_back_position'))); ?> ;
		background-repeat:<?php echo esc_attr(get_option('tmpmela_back_repeat')); ?>;
		background-attachment:<?php echo esc_attr(get_option('tmpmela_back_attachment')); ?>;
		<?php } else { ?>
		background-image: url("<?php echo esc_attr(get_option('tmpmela_background_upload')); ?>");
		background-position:<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_back_position'))); ?>;
		background-repeat:<?php echo get_option('tmpmela_back_repeat'); ?>;
		background-attachment:<?php echo esc_attr(get_option('tmpmela_back_attachment')); ?>;
		<?php } ?>			
		color:#<?php echo esc_attr(get_option('tmpmela_bodyfont_color')); ?>;
	} 	
	.topbar-outer{
	background-color: #<?php echo get_option('tmpmela_topheader_background_color');?>;
	}
	.mega-menu ul li a{color:#<?php echo esc_attr(get_option('tmpmela_top_menu_text_color')); ?>; }
	.mega-menu ul li a:hover,.mega-menu .current_page_item > a{color:#<?php echo esc_attr(get_option('tmpmela_top_menu_texthover_color')); ?>;
	background-color:#<?php echo esc_attr(get_option('tmpmela_top_menu_textbkghover_color')); ?>; }	
	.site-header {
		background-color:<?php echo tmpmela_hex_to_rgba(esc_attr(get_option('tmpmela_header_bkg_color')),esc_attr(get_option('tmpmela_header_bkg_opacity'))); ?>;
		<?php if(get_option('tmpmela_header_background_upload')!=''){ ?>
		background-image: url("<?php echo esc_attr(get_option('tmpmela_header_background_upload')); ?>");
		background-position:<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_header_back_position'))); ?>;
		background-repeat:<?php echo esc_attr(get_option('tmpmela_header_back_repeat')); ?>;
		background-attachment:<?php echo esc_attr(get_option('tmpmela_header_back_attachment')); ?>;
		<?php } ?>
	} 
	<?php 
	if( (get_option('tmpmela_bodyfont') == "Other+Fonts") || get_option('tmpmela_bodyfont') == "please-select"){  
	if	(get_option('tmpmela_bodyfont_other') != ""){ ?>
	body {	
		font-family: '<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_bodyfont_other'))); ?>', Arial, Helvetica, sans-serif;	
	}	
	<?php } } elseif(get_option('tmpmela_bodyfont') != "" && get_option('tmpmela_bodyfont') != "please-select"){ ?>
	body {	
		font-family: '<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_bodyfont'))); ?>', Arial, Helvetica, sans-serif;	
	}
.widget button, .widget input[type="button"], .widget input[type="reset"], .widget input[type="submit"], a.button, button, .contributor-posts-link, input[type="button"], input[type="reset"], input[type="submit"], .button_content_inner a, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce .wishlist_table td.product-add-to-cart a,.woocommerce .wc-proceed-to-checkout .checkout-button:hover,
.woocommerce-page input.button:hover,.woocommerce #content input.button.disabled,.woocommerce #content input.button:disabled,.woocommerce #respond input#submit.disabled,.woocommerce #respond input#submit:disabled,.woocommerce a.button.disabled,.woocommerce a.button:disabled,.woocommerce button.button.disabled,.woocommerce button.button:disabled,.woocommerce input.button.disabled,.woocommerce input.button:disabled,.woocommerce-page #content input.button.disabled,.woocommerce-page #content input.button:disabled,.woocommerce-page #respond input#submit.disabled,.woocommerce-page #respond input#submit:disabled,.woocommerce-page a.button.disabled,.woocommerce-page a.button:disabled,.woocommerce-page button.button.disabled,.woocommerce-page button.button:disabled,.woocommerce-page input.button.disabled,.woocommerce-page input.button:disabled, .loadgridlist-wrapper .woocount{
	background-color: #<?php echo get_option('tmpmela_button_bkg_color');?>;
	color:#<?php echo esc_attr(get_option('tmpmela_button_text_color')); ?>;
	 font-family:<?php echo esc_attr(get_option('tmpmela_button_font_family')); ?>;
<?php  if(get_option('tmpmela_button_font_family') != "" && get_option('tmpmela_button_font_family') != "please-select"){ ?>
		font-family:'<?php echo esc_attr(str_replace('+',' ',get_option('tmpmela_button_font_family'))); ?>', Arial, Helvetica, sans-serif;
	<?php } ?>
}
.widget input[type="button"]:hover,.widget input[type="button"]:focus,.widget input[type="reset"]:hover,.widget input[type="reset"]:focus,.widget input[type="submit"]:hover,.widget input[type="submit"]:focus,a.button:hover,a.button:focus,button:hover,button:focus,.contributor-posts-link:hover,input[type="button"]:hover,input[type="button"]:focus,input[type="reset"]:hover,input[type="reset"]:focus,input[type="submit"]:hover,input[type="submit"]:focus,.calloutarea_button a.button:hover,.calloutarea_button a.button:focus,.button_content_inner a:hover,.button_content_inner a:focus,.woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce #content table.cart .checkout-button:hover,#primary .entry-summary .single_add_to_cart_button:hover,.woocommerce .wc-proceed-to-checkout .checkout-button, .loadgridlist-wrapper .woocount:hover{
	background-color: #<?php echo get_option('tmpmela_buttonhover_bkg_color');?>;
		color:#<?php echo esc_attr(get_option('tmpmela_button_hover_text_color')); ?>;
	}	
	<?php }  ?>		
</style>
<?php if(get_option('tmpmela_control_panel') == 'no') return; 
	$bkg_color = get_option('tmpmela_bkg_color') ;
	$texture = get_option('tmpmela_texture');
	$bodyfont = str_replace('+',' ',get_option('tmpmela_bodyfont'));
	$bodyfont_color = get_option('tmpmela_bodyfont_color');
	$headerfont = str_replace('+',' ',get_option('tmpmela_headerfont'));
	$headerfont_color = get_option('tmpmela_h1color');
	$navfont = str_replace('+',' ',get_option('tmpmela_navfont'));
	$navfont_color = get_option('tmpmela_navlink_color');
	$link_color = get_option('tmpmela_link_color');
	$link_color_hover = get_option('tmpmela_hoverlink_color');
	$footer_link_color = get_option('tmpmela_footerlink_color');
?>
<script type="text/javascript">
var bkg_color_default = '<?php echo esc_attr($bkg_color); ?>',
	bodyfont_color_default = '<?php echo esc_attr($bodyfont_color); ?>',
	headerfont_color_default = '<?php echo esc_attr($headerfont_color); ?>',
	navfont_color_default = '<?php echo esc_attr($navfont_color); ?>',
	link_color_default = '<?php echo esc_attr($link_color); ?>',
	footer_link_color_default = '<?php echo esc_attr($footer_link_color); ?>';
</script>
<?php } 
add_action( 'wp_head', 'tmpmela_panel_head' );
function tmpmela_panel_head(){
	if(get_option('tmpmela_control_panel') == 'no') return;
	//=========================================== Background Settings ===========================================//
	$tmpmela_bkgcolor = isset($_COOKIE['tmpmela_bkgcolor']) ? $_COOKIE['tmpmela_bkgcolor'] : '';
	$tmpmela_texture = isset($_COOKIE['tmpmela_texture']) ? $_COOKIE['tmpmela_texture'] : '';
	$style = '';
	if ( $tmpmela_bkgcolor != '' || $tmpmela_texture != '' ) {
		if ( $tmpmela_bkgcolor != '' ) $style .= '<style type="text/css">body{ background-color: #' .$tmpmela_bkgcolor. '; }</style>';
		if ( $tmpmela_texture != '' ) $style .= '<style type="text/css">body{ background-image: url('.get_template_directory_uri().'/css/images/'.$tmpmela_texture.'.png) }</style>';
		echo wp_kses( $style,tmpmela_allowed_html());
	}	
	//=========================================== Body Settings ===========================================//
	$tmpmela_bodyfont_tag = 'body';
	$tmpmela_bodyfont = isset($_COOKIE['tmpmela_bodyfont']) ? $_COOKIE['tmpmela_bodyfont'] : '';
	$tmpmela_bodyfont_color = isset($_COOKIE['tmpmela_bodyfont_color']) ? $_COOKIE['tmpmela_bodyfont_color'] : '';
	$body_style = '';					
	if ( $tmpmela_bodyfont != '' || $tmpmela_bodyfont_color != '') {
		if ( $tmpmela_bodyfont != '' ) {
			$tmpmela_bodyfont_family = str_replace(' ', '+', $tmpmela_bodyfont);
			$body_style .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family='.$tmpmela_bodyfont_family.'" />';
			$body_style .= '<style type="text/css">'.$tmpmela_bodyfont_tag.' { font-family: '.$tmpmela_bodyfont.'; }</style>';
		}
		if ( $tmpmela_bodyfont_color != '' ) {
			$body_style .= '<style type="text/css">'.$tmpmela_bodyfont_tag.' { color: #'.$tmpmela_bodyfont_color.'; }</style>';
		}	
		echo wp_kses( $body_style,tmpmela_allowed_html());
	}
	//=========================================== Header Settings ===========================================//
	$tmpmela_headerfont_tag = 'h1,h2,h3,h4,h5,h6,.entry-title, .entry-title a,#secondary .widget-title,.widget-title,#footer-widget-area .widget-title,h3.service-block1,.block2 .widget-title,h3.featured-title-slide,.page h2,.block3 h3,.block3 h3,.entry-content a';
	$tmpmela_headerfont = isset($_COOKIE['tmpmela_headerfont']) ?	$_COOKIE['tmpmela_headerfont'] : '';
	$tmpmela_headerfont_color = isset($_COOKIE['tmpmela_headerfont_color']) ? $_COOKIE['tmpmela_headerfont_color'] : '';
	$header_style = '';
	if ( $tmpmela_headerfont != '' || $tmpmela_headerfont_color != '' ) {
		if ( $tmpmela_headerfont != '' ) {
			$tmpmela_headerfont_family = str_replace(' ', '+', $tmpmela_headerfont);
			$header_style .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family='.$tmpmela_headerfont_family.'" />';
			$header_style .= '<style type="text/css">'.$tmpmela_headerfont_tag.' { font-family: '.$tmpmela_headerfont.'; }</style>';
		}
		if ( $tmpmela_headerfont_color != '' ) {
			$header_style .= '<style type="text/css">'.$tmpmela_headerfont_tag.' { color: #'.$tmpmela_headerfont_color.'; }</style>';
		}	
		echo wp_kses( $header_style,tmpmela_allowed_html());
	}
	//=========================================== Navigation Settings ===========================================//
	$tmpmela_navfont_tag = '.mega-menu ul li a';
	$tmpmela_navfont = isset($_COOKIE['tmpmela_navfont']) ? $_COOKIE['tmpmela_navfont'] : '';
	$tmpmela_navfont_color = isset($_COOKIE['tmpmela_navfont_color']) ? $_COOKIE['tmpmela_navfont_color'] : '';
	$nav_style = '';
	if ( $tmpmela_navfont != '' || $tmpmela_navfont_color != '') {
		if ( $tmpmela_navfont != '' ) {
			$tmpmela_navfont_family = str_replace(' ', '+', $tmpmela_navfont);
			$nav_style .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family='.$tmpmela_navfont_family.'" />';
			$nav_style .= '<style type="text/css">'.$tmpmela_navfont_tag.' { font-family: '.$tmpmela_navfont.'; }</style>';
		}
		if ( $tmpmela_navfont_color != '' ) {
			$nav_style .= '<style type="text/css">'.$tmpmela_navfont_tag.'{ color: #'.$tmpmela_navfont_color.'; }</style>';
		}		
		echo wp_kses( $nav_style,tmpmela_allowed_html());
	}
	//=========================================== Link Settings ===========================================//
	$tmpmela_linkcolor = isset($_COOKIE['tmpmela_linkcolor']) ? $_COOKIE['tmpmela_linkcolor'] : '';
	$link_style = '';
	if ($tmpmela_linkcolor != '') {
		$link_style .= '<style type="text/css">a{ color: #' .$tmpmela_linkcolor. '; }</style>';	
		echo wp_kses( $link_style,tmpmela_allowed_html());
	}
	//=========================================== Footer Link Settings ===========================================//
	$tmpmela_footercolor_tag = '.footer a';
	$tmpmela_footercolor = isset($_COOKIE['tmpmela_footercolor']) ? $_COOKIE['tmpmela_footercolor'] : '';
	$footer_style = '';
	if ($tmpmela_footercolor != '') {
		$footer_style .= '<style type="text/css">'.$tmpmela_footercolor_tag.'{ color: #' .$tmpmela_footercolor. '; }</style>';	
		echo wp_kses( $footer_style,tmpmela_allowed_html());
	}	
}
add_action('tmpmela_show_panel','tmpmela_control_panel');
function tmpmela_control_panel(){
	$google_fonts = array('Droid+Sans','Antic','Bitter','Droid+Serif','Philosopher','Oxygen','Rokkitt','Galdeano','Open+Sans','Oswald','Play','Varela','Andika'); ?>
<div id="tmpmela-control-panel">
  <div id="tmpmela-panel-container">
    <div class="tmpmela-panel-bg"> <a id="tmpmela-panel-switch" href="#"><span class="icon-settings"></span></a>
      <div id="tmpmela-panel-inner">
        <div class="tmpmela-panel-title-main"> <span class="main-title"><?php esc_html__('Theme Settings','burge') ?></span> </div>
        <!--tmpmela-panel-title-main-->
        <form method="post" id="panel_form" name="panel_form">
          <div class="tmpmela-panel-block">
            <div class="tmpmela-panel-title-back">Background Color</div>
            <?php
						$bkgcolor = (isset($_COOKIE['tmpmela_bkgcolor'])) ? $_COOKIE['tmpmela_bkgcolor'] : (get_option('tmpmela_bkg_color'));
						if($bkgcolor == ''){$bkgcolor_style='style="background-color:#767676"';}else{$bkgcolor_style = ($bkgcolor != (get_option('tmpmela_bkg_color'))) ? 'style="background-color:#'.$bkgcolor.'"' : 'style="background-color:#'.(get_option('tmpmela_bkg_color')).'"';}
						?>
            <div class="tmpmela-panel-colorpicker">
              <input id="tmpmela-panel-bkgcolor" class="tmpmela-item" type="text" name="tmpmela-panel-bkgcolor" <?php echo esc_attr($bkgcolor_style); ?>>
            </div>
          </div>
          <!--tmpmela-panel-block-->
          <div class="tmpmela-panel-block">
            <div class="tmpmela-panel-title-text-back">Background Texture</div>
            <div class="clear"></div>
            <?php 
							for ( $i=1; $i<=18; $i++ ) { ?>
            <a id="tmpmela-bkg-texture<?php echo esc_attr($i); ?>" class="tmpmela-panel-item" href="#" title="body-bg<?php echo esc_attr($i); ?>"></a>
            <?php } ?>
          </div>
          <!--tmpmela-panel-block-->
          <div class="tmpmela-panel-block">
            <div class="tmpmela-panel-title">Body font</div>
            <?php 
						$bodyfont_color = (isset($_COOKIE['tmpmela_bodyfont_color'])) ? $_COOKIE['tmpmela_bodyfont_color'] : (get_option('tmpmela_bodyfont_color'));
						if($bodyfont_color == ''){$bodyfont_color_style='style="background-color:#555555"';}else{$bodyfont_color_style = ($bodyfont_color != (get_option('tmpmela_bodyfont_color'))) ? 'style="background-color:#'.$bodyfont_color.'"' : 'style="background-color:#'.(get_option('tmpmela_bodyfont_color')).'"';}
						?>
            <?php
						$body_font = '';
						$body_font = ( isset( $_COOKIE['tmpmela_bodyfont'] ) ) ? $_COOKIE['tmpmela_bodyfont'] : str_replace('+', ' ', get_option('tmpmela_bodyfont')); ?>
            <select name="tmpmela-panel-body-font" id="tmpmela-panel-body-font">
              <?php foreach( $google_fonts as $font ) { ?>
              <?php $encoded_value = str_replace( '+', ' ', $font ); ?>
              <option value="<?php echo esc_attr($encoded_value); ?>" <?php selected( $body_font, $encoded_value ); ?>><?php echo esc_attr($encoded_value); ?></option>
              <?php } ?>
            </select>
            <div class="tmpmela-panel-colorpicker">
              <input id="tmpmela-panel-body-font-color" class="tmpmela-item" type="text" name="tmpmela-panel-body-font-color" <?php echo esc_attr($bodyfont_color_style); ?>>
            </div>
          </div>
          <!--tmpmela-panel-block-->
          <div class="tmpmela-panel-block">
            <div class="tmpmela-panel-title">
              <?php esc_html_e('Header font','burge');?>
            </div>
            <?php 
						$headerfont_color = (isset($_COOKIE['tmpmela_headerfont_color'])) ? $_COOKIE['tmpmela_headerfont_color'] : (get_option('tmpmela_h1color'));
						if($headerfont_color == ''){$headerfont_color_style='style="background-color:#767676"';}else{	$headerfont_color_style = ($headerfont_color != (get_option('tmpmela_h1color'))) ? 'style="background-color:#'.$headerfont_color.'"' : 'style="background-color:#'.(get_option('tmpmela_h1color')).'"';}	
						?>
            <?php
						$header_font = '';
						$header_font = ( isset( $_COOKIE['tmpmela_headerfont'] ) ) ? $_COOKIE['tmpmela_headerfont'] : str_replace('+', ' ', get_option('tmpmela_headerfont')); ?>
            <select name="tmpmela-panel-header-font" id="tmpmela-panel-header-font">
              <?php foreach( $google_fonts as $font ) { ?>
              <?php $encoded_value = str_replace( '+', ' ', $font ); ?>
              <option value="<?php echo esc_attr($encoded_value); ?>" <?php selected( $header_font, $encoded_value ); ?>><?php echo esc_attr($encoded_value); ?></option>
              <?php } ?>
            </select>
            <div class="tmpmela-panel-colorpicker">
              <input id="tmpmela-panel-header-font-color" class="tmpmela-item" type="text" name="tmpmela-panel-header-font-color" <?php echo esc_attr($headerfont_color_style); ?>>
            </div>
          </div>
          <!--tmpmela-panel-block-->
          <div class="tmpmela-panel-block">
            <div class="tmpmela-panel-title">Navigation font</div>
            <?php 
						$navfont_color = (isset($_COOKIE['tmpmela_navfont_color'])) ? $_COOKIE['tmpmela_navfont_color'] : (get_option('tmpmela_navlink_color'));
						if($navfont_color == ''){$navfont_color_style='style="background-color:#333333"';}else{$navfont_color_style = ($navfont_color != (get_option('tmpmela_navlink_color'))) ? 'style="background-color:#'.$navfont_color.'"' : 'style="background-color:#'.(get_option('tmpmela_navlink_color')).'"';}
						?>
            <?php
						$nav_font = '';
						$nav_font = ( isset( $_COOKIE['tmpmela_navfont'] ) ) ? $_COOKIE['tmpmela_navfont'] : str_replace('+', ' ', get_option('tmpmela_navfont')); ?>
            <select name="tmpmela-panel-nav-font" id="tmpmela-panel-nav-font">
              <?php foreach( $google_fonts as $font ) { ?>
              <?php $encoded_value = str_replace( '+', ' ', $font ); ?>
              <option value="<?php echo esc_attr($encoded_value); ?>" <?php selected( $nav_font, $encoded_value ); ?>><?php echo esc_attr($encoded_value); ?></option>
              <?php } ?>
            </select>
            <div class="tmpmela-panel-colorpicker">
              <input id="tmpmela-panel-nav-font-color" class="tmpmela-item" type="text" name="tmpmela-panel-nav-font-color" <?php echo esc_attr($navfont_color_style); ?>>
            </div>
          </div>
          <!--tmpmela-panel-block-->
          <div class="tmpmela-panel-block">
            <div class="tmpmela-panel-title">
              <?php esc_html_e('Link Color','burge');?>
            </div>
            <?php
						$linkcolor = (isset($_COOKIE['tmpmela_linkcolor'])) ? $_COOKIE['tmpmela_linkcolor'] : (get_option('tmpmela_link_color'));
						if($linkcolor == ''){$linkcolor_style='style="background-color:#767676"';}else{$linkcolor_style = ($linkcolor != (get_option('tmpmela_link_color'))) ? 'style="background-color:#'.$linkcolor.'"' : 'style="background-color:#'.(get_option('tmpmela_link_color')).'"';}
						?>
            <div class="tmpmela-panel-colorpicker">
              <input id="tmpmela-panel-linkcolor" class="tmpmela-item" type="text" name="tmpmela-panel-linkcolor" <?php echo esc_attr($linkcolor_style); ?>>
            </div>
          </div>
          <!--tmpmela-panel-block-->
          <div class="more-set"> <a style="color:#000; font-size:12px;" href="<?php echo esc_url(admin_url()); ?>admin.php?page=tmpmela_theme_settings" target="_Self">
            <?php esc_html_e('See more settings in admin panel','burge');?>
            </a> </div>
          <!--more-set-->
        </form>
        <!--panel_form-->
        <?php
					if ( isset($_REQUEST['apply']) ) {
						$tmpmela_bkgcolor = $_COOKIE['tmpmela_bkgcolor'];
						$tmpmela_texture = $_COOKIE['tmpmela_texture'];
						$tmpmela_bodyfont = $_COOKIE['tmpmela_bodyfont'];
						$tmpmela_bodyfont_color = $_COOKIE['tmpmela_bodyfont_color'];
						$tmpmela_headerfont = $_COOKIE['tmpmela_headerfont'];
						$tmpmela_headerfont_color = $_COOKIE['tmpmela_headerfont_color'];
						$tmpmela_navfont = $_COOKIE['tmpmela_navfont'];
						$tmpmela_navfont_color = $_COOKIE['tmpmela_navfont_color'];
						$tmpmela_linkcolor = $_COOKIE['tmpmela_linkcolor'];
						$tmpmela_footercolor = $_COOKIE['tmpmela_footercolor'];
					} 
					elseif ( isset($_REQUEST['reset']) || !(isset($_REQUEST['reset'])) ) {
						$tmpmela_bkgcolor = $tmpmela_texture = $tmpmela_bodyfont = $tmpmela_bodyfont_color = $tmpmela_headerfont = $tmpmela_headerfont_color = $tmpmela_navfont = $tmpmela_navfont_color = $tmpmela_linkcolor = $tmpmela_footercolor ='';
 					} 
				?>
      </div>
      <!--tmpmela-panel-inner-->
    </div>
    <!--tmpmela-panel-bg-->
  </div>
  <!--tmpmela-panel-container-->
</div>
<!--tmpmela-control-panel-->
<?php } ?>