<?php
/**
 * Used to rename built-in custom post types
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */



/**
* Portfolio Post Type
* @since 1.0
*/
if ( ! function_exists( 'wpex_custom_portfolio_args' ) ) {
	function wpex_custom_portfolio_args( $args ) {
		
		//post name based on theme options
		$post_type_name = wpex_option('portfolio_labels', __('Portfolio','wpex'));
		$post_slug = 'portfolio-item';
		$post_slug = wpex_option('portfolio_slug','staff') ? wpex_option('portfolio_slug','portfolio-item') : 'portfolio-item';
		
		$labels = array(
			'name'					=> $post_type_name,
			'singular_name'		=> $post_type_name . ' '. __( 'Item', 'wpex' ),
			'add_new'				=> __( 'Add New Item', 'wpex' ),
			'add_new_item'			=> __( 'Add New','wpex') . ' ' . $post_type_name . ' ' . __( 'Item', 'wpex' ),
			'edit_item'			=> __( 'Edit New','wpex') . ' ' . $post_type_name . ' ' . __( 'Item', 'wpex' ),
			'new_item'				=> __( 'Add New','wpex') . ' ' . $post_type_name . ' ' . __( 'Item', 'wpex' ),
			'view_item'			=> __( 'View Item', 'wpex' ),
			'search_items'			=> __( 'Search', 'wpex' ). $post_type_name,
			'not_found'			=>  __( 'No','wpex') . ' ' . $post_type_name . ' ' . __( 'items found', 'wpex' ),
			'not_found_in_trash'	=> __( 'No','wpex') . ' ' . $post_type_name . ' ' . __( 'items found in the trash', 'wpex' ),
		);
		
		$custom_args = array(
			'labels'	=> $labels,
			'rewrite'	=> array("slug"	=> $post_slug)
		);
		return $custom_args + $args;
	}
	add_filter( 'wpex_portfolio_args', 'wpex_custom_portfolio_args' );
}

/**
* Staff Post Type
* @since 1.0
*/
if ( ! function_exists( 'wpex_custom_staff_args' ) ) {
	function wpex_custom_staff_args( $args ) {
		
		//post name based on theme options
		$post_type_name = wpex_option('staff_labels',__('Staff','wpex'));
		$post_slug = wpex_option('staff_slug','staff-member');
		
		$labels = array(
			'name'					=> $post_type_name,
			'singular_name'		=> $post_type_name . ' '. __( 'Item', 'wpex' ),
			'add_new'				=> __( 'Add New Item', 'wpex' ),
			'add_new_item'			=> __( 'Add New','wpex') . ' ' . $post_type_name . ' ' . __( 'Item', 'wpex' ),
			'edit_item'			=> __( 'Edit New','wpex') . ' ' . $post_type_name . ' ' . __( 'Item', 'wpex' ),
			'new_item'				=> __( 'Add New','wpex') . ' ' . $post_type_name . ' ' . __( 'Item', 'wpex' ),
			'view_item'			=> __( 'View Item', 'wpex' ),
			'search_items'			=> __( 'Search', 'wpex' ). $post_type_name,
			'not_found'			=>  __( 'No','wpex') . ' ' . $post_type_name . ' ' . __( 'items found', 'wpex' ),
			'not_found_in_trash'	=> __( 'No','wpex') . ' ' . $post_type_name . ' ' . __( 'items found in the trash', 'wpex' ),
		);
		
		$custom_args = array(
			'labels'	=> $labels,
			'rewrite'	=> array("slug"	=> $post_slug),
		);
		return $custom_args + $args;
	}
	add_filter( 'wpex_staff_args', 'wpex_custom_staff_args' );
}

/**
* Testimonials Post Type
* @since 1.0
*/
if ( ! function_exists( 'wpex_custom_testimonials_args' ) ) {
	function wpex_custom_testimonials_args( $args ) {
		
		//post name based on theme options
		$post_type_name = wpex_option('testimonials_labels',__('Testimonials','wpex'));
		$post_slug = wpex_option('testimonials_slug','testimonial-item');
		
		$labels = array(
			'name'					=> $post_type_name,
			'singular_name'		=> $post_type_name . ' '. __( 'Item', 'wpex' ),
			'add_new'				=> __( 'Add New Item', 'wpex' ),
			'add_new_item'			=> __( 'Add New','wpex') . ' ' . $post_type_name . ' ' . __( 'Item', 'wpex' ),
			'edit_item'			=> __( 'Edit New','wpex') . ' ' . $post_type_name . ' ' . __( 'Item', 'wpex' ),
			'new_item'				=> __( 'Add New','wpex') . ' ' . $post_type_name . ' ' . __( 'Item', 'wpex' ),
			'view_item'			=> __( 'View Item', 'wpex' ),
			'search_items'			=> __( 'Search', 'wpex' ). $post_type_name,
			'not_found'			=>  __( 'No','wpex') . ' ' . $post_type_name . ' ' . __( 'items found', 'wpex' ),
			'not_found_in_trash'	=> __( 'No','wpex') . ' ' . $post_type_name . ' ' . __( 'items found in the trash', 'wpex' ),
		);
		
		$custom_args = array(
			'labels'	=> $labels,
			'rewrite'	=> array("slug"	=> $post_slug),
		);
		return $custom_args + $args;
	}
	add_filter( 'wpex_testimonials_args', 'wpex_custom_testimonials_args' );
}
?>