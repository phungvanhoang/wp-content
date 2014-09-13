<?php
/**
 * Main header functions
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/

// Whether the header should display or not
if ( ! function_exists( 'wpex_display_header' ) ) {
	function wpex_display_header() {
		if ( !is_singular() ) return true;
		if ( is_singular() ) {
			global $post;
			$post_id = $post->ID;
			$meta = get_post_meta( get_the_ID(), 'wpex_disable_header', true );
			if ( $meta == 'on' ) {
				return false;
			}
		}
		return true;
	} // End if
} // End wpex_display_header() function



// Return the correct header style
if ( ! function_exists( 'wpex_get_header_style' ) ) {
	function wpex_get_header_style($style='one') {
		$style = wpex_option('header_style','one');
		if ( is_singular() ) {
			global $post;
			$post_id = $post->ID;
			$meta = get_post_meta( $post_id, 'wpex_header_style', true );
			if ( $meta ) {
				$style = $meta;
			}
		}
		return $style;
	} // End if
} // End wpex_get_header_style() function