<?php
/**
 * Outputs your social links
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */


if ( !function_exists('wpex_display_social') ) {
	
	function wpex_display_social( $id = false ) {
		if ( ! $id ) return;
		global $smof_data;
		$wpex_social_links = $smof_data[$id]; //get the social array from the admin panel
		if ( !$wpex_social_links ) return;
		if ( $id == 'topbar_social_options' ) {
			$output = '<ul class="clr">';
		} else {
			$output = '<ul id="social" class="clr">';
		}
			foreach ( $wpex_social_links as $social_link ) {
				if ( $social_link['link'] ) {
					$output .= '<li class="'. strtolower($social_link['title']) .'"><a href="'. $social_link['link'].'" title="'. $social_link['description'] .'" target="_blank"><img src="'. $social_link['url'] .'" alt="'. $social_link['description'] .'" /></a></li>';
				}
			}
		$output .= '</ul><!-- #social -->';
		echo apply_filters('wpex_display_social', $output);
	}
	
}