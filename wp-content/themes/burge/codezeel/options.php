<?php
/** Adding TM Menu in admin panel. */
function tmpmela_theme_setting_menu() {	
	add_theme_page( esc_html__('Theme Settings','burge'), esc_html__('TM Theme Settings','burge'), 'manage_options', 'tmpmela_theme_settings', 'tmpmela_theme_settings_page' );		
	add_theme_page( esc_html__('Hook Manager','burge'), esc_html__('TM Hook Manager','burge'), 'manage_options', 'tmpmela_hook_manage', 'tmpmela_hook_manage_page');	
}
?>