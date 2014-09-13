<?php
/**
 * Returns the correct sidebar region
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


if ( ! function_exists( 'wpex_get_sidebar' ) ) {
	
	function wpex_get_sidebar($sidebar='sidebar') {
		
		// Pages
		$custom_pages_sidebar = wpex_option(	'pages_custom_sidebar', '1' );
		if ( is_singular( 'pages' ) && $custom_pages_sidebar == '1' ) {
			return 'pages_sidebar';
		}
		
		// Staff
		$custom_staff_sidebar = wpex_option(	'staff_custom_sidebar', '1' );
		if ( is_singular( 'staff' ) && $custom_staff_sidebar == '1' ) {
			return 'staff_sidebar';
		}
		
		// Portfolio
		$custom_portfolio_sidebar = wpex_option( 'portfolio_custom_sidebar', '1' );
		if ( is_singular( 'portfolio' ) && $custom_portfolio_sidebar == '1' ) {
			return 'portfolio_sidebar';
		}
		
		// WooCommerce
		if ( class_exists('Woocommerce') ) {
			$woo_custom_sidebar = wpex_option( 'woo_custom_sidebar', '1' );
			if ( $woo_custom_sidebar == '1' && is_woocommerce() ) {
				return 'woo_sidebar';
			}
		}
		
		// Return the correct sidebar name & add useful hook
		return apply_filters( 'wpex_get_sidebar', $sidebar );
		
	} // End function
	
} // End if