<?php
/**
 * Filters the image quality for thumbnails to be at the highest ratio possible.
 *
 * Supports the new 'wp_editor_set_quality' filter added in WP 3.5.
 *
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
 
add_filter( 'jpeg_quality', 'wpex_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'wpex_image_full_quality' );
if ( ! function_exists('wpex_image_full_quality') ) {
	function wpex_image_full_quality( $quality ) {
		return 100;
	}
}