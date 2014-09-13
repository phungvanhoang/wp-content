<?php
/**
 * Add classes to the blog entries wrap
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */

if ( ! function_exists( 'wpex_blog_wrap_classes' ) ) {
	
	function wpex_blog_wrap_classes( $classes=false ) {
		
		// Return custom class if set
		if ( $classes !== false ) return $class;
		
		
		// Admin defaults
		$style = wpex_option( 'blog_style' );
		$pagination = wpex_option( 'blog_pagination_style' );
		$author_avatars = wpex_option( 'blog_entry_author_avatar' );
		
		// Category options
		if ( is_category() ) {
			
			// Get taxonomy meta
			$term = get_query_var('cat');
			$term_data = get_option("category_$term");
			
			if ( isset($term_data['wpex_term_style']) ) {
				$term_style = $term_data['wpex_term_style'] !== '' ? $term_data['wpex_term_style'] .'' : $wpex_term_style;
			}
			
			if ( isset($term_data['wpex_term_pagination']) ) {
				$term_pagination = $term_data['wpex_term_pagination'] !== '' ? $term_data['wpex_term_pagination'] .'' : '';
			}
			
			if ( $term_style ) {
				$style = $term_style .'-entry-style';
			}
			
			if ( $term_pagination ) {
				$pagination = $term_pagination;
			}
			
		}
		
		
		// Isotope classes
		if ( $style == 'grid-entry-style' ) {
			$classes .= 'wpex-masonry-grid blog-masonry-grid ';
		}
		
		// Add some margin when author is enabled
		if ( $style == 'grid-entry-style' && $author_avatars == '1' ) {
			$classes .= 'grid-w-avatars';
		}
		
		// Infinite scroll classes
		if ( $pagination == 'infinite_scroll' ) {
			$classes .= 'infinite-scroll-wrap';
		}
		

// Return classes -------------------------------------------------------------------------- >	
	
		echo $classes;
		
	} // End function
	
} // End if