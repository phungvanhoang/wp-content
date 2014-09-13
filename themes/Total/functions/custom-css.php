<?php
/**
 * Adds your admin custom CSS to the wp_head() hook.
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */


if ( is_admin() ) return; // We don't need this in the admin

if ( !function_exists( 'wpex_custom_css' ) ) {
	
	function wpex_custom_css() {
	
		$custom_css ='';		

		if ( wpex_option( 'custom_css' ) !== '' ) {
			$custom_css .= wpex_option( 'custom_css' );
		}
		
		// trim white space for faster page loading
		$custom_css_trimmed =  preg_replace( '/\s+/', ' ', $custom_css );
		
		// output css on front end
		$css_output = "<!-- Custom CSS -->\n<style type=\"text/css\">\n" . $custom_css_trimmed . "\n</style>";
		if( !empty($custom_css) ) {
			echo $css_output;
		}
		
	} //end wpex_custom_css()
	
} // End if
add_action('wp_head', 'wpex_custom_css');