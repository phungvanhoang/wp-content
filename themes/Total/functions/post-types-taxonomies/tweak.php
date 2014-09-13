<?php
/**
 * Used to tweak the custom post types
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
 
 
// Alter Portfolio $args
if ( ! function_exists( 'wpex_tweak_portfolio_args' ) ) {
	function wpex_tweak_portfolio_args($args) {
		
		// Vars
		$search = wpex_option('portfolio_search','1');
		$menu_icon = wpex_option('portfolio_admin_icon', false, 'url' );
		
		// Tweaks
		if ( $search !== '1' ) {
			$args['exclude_from_search'] = true;
		}
		
		if ( $menu_icon !== '' ) {
			$args['menu_icon'] = $menu_icon;
		}
		
		return $args;
		
	} // End function
} // End if
add_action('wpex_portfolio_args','wpex_tweak_portfolio_args');


// Alter Staff $args
if ( ! function_exists( 'wpex_tweak_staff_args' ) ) {
	function wpex_tweak_staff_args($args) {
		
		// Vars
		$search = wpex_option('staff_search','1');
		$menu_icon = wpex_option('staff_admin_icon', false, 'url' );
		
		// Tweaks
		if ( $search !== '1' ) {
			$args['exclude_from_search'] = true;
		}
		
		if ( $menu_icon !== '' ) {
			$args['menu_icon'] = $menu_icon;
		}
		
		return $args;
		
	} // End function
} // End if
add_action('wpex_staff_args','wpex_tweak_staff_args');


// Alter Testimonials $args
if ( ! function_exists( 'wpex_tweak_testimonials_args' ) ) {
	function wpex_tweak_testimonials_args($args) {
		
		// Vars
		$search = wpex_option('testimonials_search','1');
		$menu_icon = wpex_option('testimonials_admin_icon', false, 'url' );
		
		// Tweaks
		if ( $search !== '1' ) {
			$args['exclude_from_search'] = true;
		}
		
		if ( $menu_icon !== '' ) {
			$args['menu_icon'] = $menu_icon;
		}
		
		return $args;
		
	} // End function
} // End if
add_action('wpex_testimonials_args','wpex_tweak_testimonials_args');