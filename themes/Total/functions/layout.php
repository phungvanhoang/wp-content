<?php
/**
 * This file is used for all the styling options in the admin
 * All custom color options are output to the <head> tag
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */


if ( is_admin() ) return; // We don't need this in the admin


if ( !function_exists( 'wpex_layout_css' ) ) {
	
	function wpex_layout_css() {
	
		$custom_css ='';
		
		// Main Container With
		$main_container_width = wpex_option( 'main_container_width' );
		if ( $main_container_width !== '' && $main_container_width !== '980px' ) {
			$custom_css .= '@media only screen and (min-width: 960px) {
				.container, .wpb_row .wpb_row, .vc_row-fluid.container, .boxed-main-layout #wrap { width: '. $main_container_width .'; }
				.boxed-main-layout .is-sticky #site-header { width: '. $main_container_width .'; }
			}';
		}
		
		// Left container width
		$left_container_width = wpex_option( 'left_container_width' );
		if ( $left_container_width !== '' && $left_container_width !== '680px' ) {
			$custom_css .= '@media only screen and (min-width: 960px) {
				.content-area { width: '. $left_container_width .'; }
			}';
		}
						
		// Sidebar width
		$sidebar_width = wpex_option( 'sidebar_width' );
		if ( $sidebar_width !== '' && $sidebar_width !== '260px' ) {
			$custom_css .= '@media only screen and (min-width: 960px) {#sidebar { width: '. $sidebar_width .'; }}';
		}
		
		// Header Top Padding
		$header_top_padding = wpex_option( 'header_top_padding' );
		if ( $header_top_padding !== '' && $header_top_padding !== '30px' ) {
			$custom_css .= '#site-header-inner { padding-top: '. intval($header_top_padding) .'px; }';
		}
		
		// Header Bottom Padding
		$header_bottom_padding = wpex_option( 'header_bottom_padding' );
		if ( $header_bottom_padding !== '' && $header_bottom_padding !== '30px' ) {
			$custom_css .= '#site-header-inner { padding-bottom: '. intval($header_bottom_padding) .'px; }';
		}
		
		// Logo top margin
		$logo_top_margin = wpex_option( 'logo_top_margin' );
		if ( $logo_top_margin !== '' && $logo_top_margin !== '0px' ) {
			$custom_css .= '#site-logo { margin-top: '. intval($logo_top_margin) .'px; }';
		}
		
		// Logo bottom margin
		$logo_bottom_margin = wpex_option( 'logo_bottom_margin' );
		if ( $logo_bottom_margin !== '' && $logo_bottom_margin !== '0px' ) {
			$custom_css .= '#site-logo { margin-bottom: '. intval($logo_bottom_margin) .'px; }';
		}
		
		// trim white space for faster page loading
		$custom_css_trimmed =  preg_replace( '/\s+/', ' ', $custom_css );
		
		// output css on front end
		$css_output = "<!-- Custom CSS -->\n<style type=\"text/css\">\n" . $custom_css_trimmed . "\n</style>";
		if( !empty($custom_css) ) {
			echo $css_output;
		}
		
	} // End function
	
} // End if
add_action('wp_head', 'wpex_layout_css');