<?php
/**
 * Returns the correct main layout class for the current post/page/archive/etc
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


if ( ! function_exists( 'wpex_get_post_layout_class' ) ) {
	
	function wpex_get_post_layout_class() {
		
		// Vars
		$class = 'right-sidebar';
		$post_types = get_post_types( '', 'names' ); 
		$blog_archives_layout = wpex_option( 'blog_archives_layout', 'right-sidebar' );
		
		// Loop through post types
		foreach ( $post_types as $post_type ) {
			if ( is_singular($post_type) ) {
				if ( $post_type == 'post' ) $post_type = 'blog';
				global $post;
				$post_id = $post->ID;
				$admin_id = $post_type .'_single_layout';
				$admin_setting = wpex_option( $admin_id, 'right-sidebar' );
				$meta = get_post_meta( $post_id, 'wpex_post_layout', true );
				if ( $meta !== '' ) {
					$class = $meta;
				} else {
					$class = $admin_setting;
				}		
			}
		}
		
		// Archives
		if ( is_archive() || is_author() || is_page_template('templates/blog.php') ) {
			$class = $blog_archives_layout;
		}
		
		// Cats
		if ( is_category() ) {
			$term = get_query_var('cat');
			$term_data = get_option("category_$term");
			if ( $term_data ) {
				if( $term_data['wpex_term_layout'] !== '' ){
					$class = $term_data['wpex_term_layout'];
				}
			} else {
				$class = $blog_archives_layout;
			}
		}
		
		// Portfolio tax
		if ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) ) {
			$class = wpex_option( 'portfolio_archive_layout', 'full-width' );
		}
		
		// Staff tax
		if ( is_tax( 'staff_category' ) || is_tax( 'staff_tag' ) ) {
			$class = wpex_option( 'staff_archive_layout', 'full-width' );
		}
		
		// Testimonials tax
		if ( is_tax( 'testimonials_category' ) || is_tax( 'testimonials_tag' ) ) {
			$class = wpex_option( 'testimonials_archive_layout', 'full-width' );
		}
		
		// Return the correct class name
		$class = apply_filters( 'wpex_post_layout_class', $class );
		
		return $class;
		
	} // End function
} // End if
