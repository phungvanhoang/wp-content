<?php
/**
 * Add post type classes to standard entries
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/

if ( ! function_exists( 'wpex_post_entry_classes' ) ) {
	
	function wpex_post_entry_classes( $classes ) {
		
		// Post Data
		global $post;
		$post_id = $post->ID;
		$post_type = get_post_type($post_id);
				
		// Only add classes to standard post type
		if ( $post_type !== 'post' ) return $classes;
		
		// Main vars
		$blog_style = 'large-image';
		$grid_columns = 'span_1_of_2';
		$admin_blog_style = wpex_option( 'blog_style', 'large-image' );
		$admin_grid_columns = wpex_option( 'blog_grid_columns', '2' );
		
		// Main Classes
		$classes[] = 'blog-entry clr';
		
		// Blog Styles
		if ( is_category() ) {
			$term = get_query_var('cat');
			$term_data = get_option("category_$term");
			$term_style  = '';
			$grid_columns = '';
			
			if ( $term_data ) {
				
				if ( isset($term_data['wpex_term_style']) ) {
					$term_style = $term_data['wpex_term_style'] !== '' ? $term_data['wpex_term_style'] .'' : '';
				}
				
				if ( isset($term_data['wpex_term_grid_cols']) ) {
					$grid_columns = $term_data['wpex_term_grid_cols'] !== '' ? $term_data['wpex_term_grid_cols'] .'' : '';
				}
			
			}
			
			$blog_style = $term_style !== '' ? $term_style .'-entry-style' : $admin_blog_style;
			
			$grid_columns = $grid_columns !== '' ? $grid_columns : $admin_grid_columns;
			
		} else {
			$blog_style = $admin_blog_style;
			$grid_columns = $admin_grid_columns;
		}		

		// Add columns for grid style entries
		if ( $blog_style == 'grid-entry-style' ) {
			$classes[] = wpex_grid_class( $grid_columns );
		}	

		// Return classes based on admin setting
		$classes[] = $blog_style;
			
		return $classes;
		
	} // End function
	
} // End if
add_filter('post_class', 'wpex_post_entry_classes');