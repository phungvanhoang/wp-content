<?php
/**
 * Remove elements and params from the default Visual Composer
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */


/* Remove composer elements */
if ( function_exists('vc_remove_element') ) {
	add_action( 'init', 'vcex_vc_modules_remove' );
	if ( !function_exists( 'vcex_vc_modules_remove' )) {	
		function vcex_vc_modules_remove() {		
			vc_remove_element('vc_teaser_grid');
			vc_remove_element('vc_posts_grid');
			vc_remove_element('vc_posts_slider');
			vc_remove_element('vc_carousel');
			vc_remove_element('vc_wp_tagcloud');
			vc_remove_element('vc_wp_archives');
			vc_remove_element('vc_wp_calendar');
			vc_remove_element('vc_wp_pages');
			vc_remove_element('vc_wp_links');
			vc_remove_element('vc_wp_posts');
			vc_remove_element('vc_separator');
			vc_remove_element('vc_gallery');
			vc_remove_element('vc_button');
			vc_remove_element('vc_cta_button');
			vc_remove_element('vc_wp_categories');
			vc_remove_element('vc_wp_rss');
			vc_remove_element('vc_wp_text');
			vc_remove_element('vc_wp_meta');
			vc_remove_element('vc_wp_recentcomments');
			vc_remove_element('vc_images_carousel');		
		} // End function	
	} // End if
} // End if

// remove certain composer params
if ( function_exists('vc_remove_param') ) {
	
	// Rows
	vc_remove_param( 'vc_row', 'font_color' );
	vc_remove_param( 'vc_row', 'padding' );
	vc_remove_param( 'vc_row', 'bg_color' );
	vc_remove_param( 'vc_row', 'bg_image' );
	vc_remove_param( 'vc_row', 'bg_image_repeat' );
	vc_remove_param( 'vc_row', 'margin_bottom' );
	
	// Single Image
	vc_remove_param( 'vc_single_image', 'img_link_target' );
	
}