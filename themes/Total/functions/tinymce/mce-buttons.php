<?php
/**
 * Add more buttons to the MCE editor
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
 
 

// Enable font size buttons in the editor
add_filter("mce_buttons_2", "wpex_fontsizeselect_mce");
if ( !function_exists( 'wpex_fontsizeselect_mce' ) ) {
	function wpex_fontsizeselect_mce($buttons) {
	  $buttons[] = 'fontsizeselect';
	  return $buttons;
	}
}

// Customize mce editor font sizes
add_filter('tiny_mce_before_init', 'wpex_customize_text_sizes');
if ( !function_exists( 'wpex_customize_text_sizes' ) ) {
	function wpex_customize_text_sizes($initArray){
		$initArray['theme_advanced_font_sizes'] = "9px,10px,12px,13px,14px,16px,18px,21px,24px,28px,32px,36px";
		return $initArray;
	}
}


// Add "Styles" drop-down  
function wde_mcekit_editor_buttons($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

add_filter('mce_buttons_2', 'wde_mcekit_editor_buttons');


// Add hr to editor
add_filter("mce_buttons_2", "wpex_hr_mce");
if ( !function_exists('wpex_hr_mce' ) ) {
	function wpex_hr_mce($buttons) {
		$buttons[] = 'hr';
		return $buttons;
	}
}


// Add "Styles" drop-down content or classes 
add_filter('tiny_mce_before_init', 'wdex_mcekit_editor_settings');
if ( !function_exists('wdex_mcekit_editor_settings' ) ) {
	function wdex_mcekit_editor_settings($settings) {
		if (!empty($settings['theme_advanced_styles']))
			$settings['theme_advanced_styles'] .= ';';    
		else
			$settings['theme_advanced_styles'] = '';
		$classes = array(
		   __('Theme Button','wpex') => 'theme-button',
		   __('Highlight','wpex') => 'text-highlight',
			__('Thin Font','wpex') => 'thin-font',
		);
		$class_settings = '';
		foreach ( $classes as $name => $value )
			$class_settings .= "{$name}={$value};";
	
		$settings['theme_advanced_styles'] .= trim($class_settings, '; ');
		return $settings;
	}
}