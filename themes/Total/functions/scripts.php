<?php
/**
 * This file loads css and js for our theme and other script related functions
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


// Load all CSS & JS for the theme
add_action('wp_enqueue_scripts','wpex_load_scripts');

if ( ! function_exists( 'wpex_load_scripts' ) ) {
	
	function wpex_load_scripts() {
		
		
		/*******
		*** CSS
		*******************/
		
		// Load Visual composer CSS at top of site
		if ( function_exists( 'vc_map' ) ) {
			wp_enqueue_style( 'js_composer_front' );
		}
		
		// Main css
		wp_enqueue_style( 'wpex-style', get_stylesheet_uri() );
		
		// Font awesome icons
		wp_enqueue_style( 'font-awesome', WPEX_CSS_DIR_UIR .'font-awesome.min.css', array( 'wpex-style' ) );
		
		// WooCommerce
		if ( class_exists('Woocommerce') ) {
			wp_enqueue_style( 'wpex-woocommerce', WPEX_CSS_DIR_UIR .'woocommerce.css' );
		}
		
		// Responsive
		if( wpex_option( 'responsive', '1' ) == '1' ) {
			wp_enqueue_style( 'wpex-responsive', WPEX_CSS_DIR_UIR .'responsive.css', array( 'wpex-style' ) );
		}
		
		// Remove CSS
		wp_deregister_style( 'vcex-font-awesome' );
		
		// This design is inteded to use Open Sans, so lets load up this sucker ourself rather then relying on the admin panel
		$main_font = wpex_option( 'body_font' );
		if ( isset($main_font) ) {
			if ( isset($main_font['font-family']) == 'Open Sans' ) {
				wp_enqueue_style( 'wpex-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic' );
			}
		}
		
		
	
		/*******
		*** jQuery
		*******************/
		
		// Add scripts
		wp_enqueue_script( 'jquery' );
		if ( wpex_option( 'retina', '1' ) == '1' ) {
			wp_enqueue_script('retina', WPEX_JS_DIR_URI .'retina.js', array('jquery'), '0.0.2', true);
		}
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script('comment-reply');
		} 
		wp_enqueue_script( 'wpex-plugins', WPEX_JS_DIR_URI .'plugins.js', array( 'jquery' ), '1.0', true);
		wp_enqueue_script( 'wpex-global', WPEX_JS_DIR_URI .'global.js', array( 'jquery', 'wpex-plugins' ), '1.0', true);
		wp_localize_script( 'wpex-global', 'wpexLocalize', array( 'responsiveMenuText' => wpex_option( 'responsive_menu_text', __('Menu','wpex') ) ) );
		
		// Remove JS
		wp_deregister_script( 'flexslider' );
		wp_deregister_script( 'vcex-flexslider' );
		wp_deregister_script( 'vcex-isotope' );
		wp_deregister_script( 'vcex-magnific-popup' );
		wp_deregister_script( 'vcex-isotope' );
		
	} // End function

} // End if


// Browser Specific CSS
if ( !function_exists('wpex_ie_css') ) {
	add_action('wp_head', 'wpex_ie_css');
	function wpex_ie_css() {
		echo '<!--[if IE]>';
			echo '<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>';
		echo '<![endif]-->';
	} // End function
} // End if


// Remove script versions if enabled
if ( ! function_exists( 'wpex_remove_wp_ver_css_js' ) ) {
	function wpex_remove_wp_ver_css_js( $src ) {
	if ( wpex_option( 'remove_scripts_version', '1' ) == '1' ) {
		if ( strpos( $src, 'ver=' ) ) {
			$src = remove_query_arg( 'ver', $src );
		}
	}
    return $src;
	} // End function
} // End if
add_filter( 'style_loader_src', 'wpex_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'wpex_remove_wp_ver_css_js', 9999 );