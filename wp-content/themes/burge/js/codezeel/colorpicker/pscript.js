jQuery(document).ready(function() {
	jQuery('#tmpmela-panel-switch').addClass('panel-open');
	//=================== Show or Hide Control Panel ========================//
	jQuery('#tmpmela-panel-switch').click(function(){
		if ( jQuery(this).hasClass('panel-open') ) {
			jQuery('#tmpmela-control-panel').animate( { left: 0 } );
			jQuery(this).removeClass('panel-open');
			jQuery(this).addClass('panel-close');
			jQuery.cookie('tmpmela_panel_open', 0);
		}else if ( jQuery(this).hasClass('panel-close') ) {
			jQuery('#tmpmela-control-panel').animate( { left: -250 } );
			jQuery(this).addClass('panel-open');
			jQuery(this).removeClass('panel-close');
			jQuery.cookie('tmpmela_panel_open', 1);
		}
	});
	//=================== BACKGROUND COLOR SETTINGS ========================//
	var tmpmela_bkgcolor;
	if(jQuery.cookie('tmpmela_bkgcolor')) {
		tmpmela_bkgcolor = jQuery.cookie('tmpmela_bkgcolor');
	} else {
		tmpmela_bkgcolor = bkg_color_default;
	}
	jQuery('#tmpmela-panel-bkgcolor').ColorPicker({
		color: tmpmela_bkgcolor,
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('body').css('backgroundColor', '#' + hex);
			jQuery('#tmpmela-panel-bkgcolor').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tmpmela_bkgcolor', hex);
		    });
		}
	});
	//=================== TEXTURE SETTINGS ========================//
	jQuery('#tmpmela-control-panel a.tmpmela-panel-item').click(function(){
		var tmpmela_texture_value = jQuery(this).attr('title');
		jQuery('body').css('backgroundImage', 'url(' + tmpmela_theme_path + '/images/codezeel/colorpicker/pattern/' + tmpmela_texture_value + '.png)' );
		jQuery('body').css('background-repeat','repeat');		
		jQuery('#panel_form').submit(function() {
			jQuery.cookie('tmpmela_texture', tmpmela_texture_value);
		});
	});
	//=================== BODY SETTINGS ========================//
	var tmpmela_bodyfont_tag = 'body';
	jQuery('#tmpmela-panel-body-font').change(function(){
		var tmpmela_bodyfont_encoded = jQuery(this).val(),
			tmpmela_bodyfont_value = jQuery(this).val().replace(' ','+');
		jQuery('head').append('<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family='+ tmpmela_bodyfont_value + '" />');
		jQuery('head').append('<style type="text/css">' + tmpmela_bodyfont_tag + ' { font-family: "' + tmpmela_bodyfont_encoded + '"; }</style>');
		jQuery('#panel_form').submit(function() {
			jQuery.cookie('tmpmela_bodyfont', tmpmela_bodyfont_encoded);
	    });
	});
	var tmpmela_bodyfont_color;
	if(jQuery.cookie('tmpmela_bodyfont_color')) {
		tmpmela_bodyfont_color = jQuery.cookie('tmpmela_bodyfont_color');
	} else {
		tmpmela_bodyfont_color = bodyfont_color_default;
	}
	jQuery('#tmpmela-panel-body-font-color').ColorPicker({
		color: tmpmela_bodyfont_color,
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery(tmpmela_bodyfont_tag).css('color', '#' + hex);
			jQuery('#tmpmela-panel-body-font-color').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tmpmela_bodyfont_color', hex);
	    	});
		}
	});
	//=================== HEADER SETTINGS ========================//
	var tmpmela_headerfont_tag = 'h1,h2,h3,h4,h5,h6';
	jQuery('#tmpmela-panel-header-font').change(function(){
		var tmpmela_headerfont_encoded = jQuery(this).val(),
			tmpmela_headerfont_value = jQuery(this).val().replace(' ','+');
			jQuery('head').append('<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=' + tmpmela_headerfont_value + '" />');
			jQuery('head').append('<style type="text/css">' + tmpmela_headerfont_tag + ' { font-family: "' + tmpmela_headerfont_encoded + '"; }</style>');
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tmpmela_headerfont', tmpmela_headerfont_encoded);
	    	});
	});
	var tmpmela_headerfont_color;
	if(jQuery.cookie('tmpmela_headerfont_color')) {
		tmpmela_headerfont_color = jQuery.cookie('tmpmela_headerfont_color');
	} else {
		tmpmela_headerfont_color = headerfont_color_default;
	}
	jQuery('#tmpmela-panel-header-font-color').ColorPicker({
		color: tmpmela_headerfont_color,
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery(tmpmela_headerfont_tag).css('color', '#' + hex);
			jQuery('#tmpmela-panel-header-font-color').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tmpmela_headerfont_color', hex);
	    	});
		}
	});
	//=================== NAVIGATION SETTINGS ========================//
	var tmpmela_navfont_tag = '.primary-navigation a';
	jQuery('#tmpmela-panel-nav-font').change(function(){
		var tmpmela_navfont_encoded = jQuery(this).val(),
			tmpmela_navfont_value = jQuery(this).val().replace(' ','+');
		jQuery('head').append('<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + tmpmela_navfont_value + '" />');
		jQuery('head').append('<style type="text/css">' + tmpmela_navfont_tag + ' { font-family: "' + tmpmela_navfont_encoded + '"; }</style>');
		jQuery('#panel_form').submit(function() {
			jQuery.cookie('tmpmela_navfont', tmpmela_navfont_encoded);
	    });
	});
	var tmpmela_navfont_color;
	if(jQuery.cookie('tmpmela_navfont_color')) {
		tmpmela_navfont_color = jQuery.cookie('tmpmela_navfont_color');
	} else {
		tmpmela_navfont_color = navfont_color_default;
	}
	jQuery('#tmpmela-panel-nav-font-color').ColorPicker({
		color: tmpmela_navfont_color,
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery(tmpmela_navfont_tag).css('color', '#' + hex );
			jQuery('#tmpmela-panel-nav-font-color').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tmpmela_navfont_color', hex);
	    	});
		}
	});
	//=================== LINK COLOR SETTINGS ========================//
	var tmpmela_linkcolor;
	if(jQuery.cookie('tmpmela_linkcolor')) {
		tmpmela_linkcolor = jQuery.cookie('tmpmela_linkcolor');
	} else {
		tmpmela_linkcolor = link_color_default;
	}
	jQuery('#tmpmela-panel-linkcolor').ColorPicker({
		color: tmpmela_linkcolor,
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('a').css('color', '#' + hex);
			jQuery('#tmpmela-panel-linkcolor').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tmpmela_linkcolor', hex);
		    });
		}
	});
	//=================== FOOTER COLOR SETTINGS ========================//
	var tmpmela_footercolor_tag = '.footer-main a',
		tmpmela_footercolor;
	if(jQuery.cookie('tmpmela_footercolor')) {
		tmpmela_footercolor = jQuery.cookie('tmpmela_footercolor');
	} else {
		tmpmela_footercolor = footer_link_color_default;
	}
	jQuery('#tmpmela-panel-footercolor').ColorPicker({
		color: tmpmela_footercolor,
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery(tmpmela_footercolor_tag).css('color', '#' + hex);
			jQuery('#tmpmela-panel-footercolor').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tmpmela_footercolor', hex);
		    });
		}
	}); 
	//=================== RESET ALL COOKIES ========================//
	jQuery('#reset_panel_form').submit(function() {
		jQuery.cookie('tmpmela_bkgcolor', null);	
		jQuery.cookie('tmpmela_texture', null);
		jQuery.cookie('tmpmela_bodyfont', null);
		jQuery.cookie('tmpmela_bodyfont_color', null);
		jQuery.cookie('tmpmela_headerfont', null);
		jQuery.cookie('tmpmela_headerfont_color', null);
		jQuery.cookie('tmpmela_navfont', null);
		jQuery.cookie('tmpmela_navfont_color', null);
		jQuery.cookie('tmpmela_linkcolor', null);
		jQuery.cookie('tmpmela_footercolor', null);
	});
});