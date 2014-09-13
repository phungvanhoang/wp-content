<?php
/**
 * Displays the post entry author avatar
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


// Check if Author Avatar is enabled
if ( ! function_exists( 'wpex_post_entry_author_avatar_enabled' ) ) {	

	function wpex_post_entry_author_avatar_enabled() {
		
		// Theme settings
		$author_avatar_toggle = wpex_option( 'blog_entry_author_avatar' );
		$blog_style = wpex_option ( 'blog_style' );
		
		if ( $author_avatar_toggle !== '1' ) return false;
		if ( !is_category() && $blog_style !== 'large-image-entry-style' ) return false;
		
		// Category settings
		if ( is_category() ) {
			$term = get_query_var('cat');
			$term_data = get_option("category_$term");
			if ( isset($term_data['wpex_term_style']) ) {
				if ( $term_data['wpex_term_style'] !== '' ) {
					$blog_style = $term_data['wpex_term_style'];
				}
			}
			if ( $blog_style !== 'large-image-entry-style' ) return false;	
		} // End if category check
		
		return true; // If all else fails return true
		
	} // End function	
	
} // End if


// Display Author Avatar
if ( ! function_exists( 'wpex_post_entry_author_avatar' ) ) {
	
	function wpex_post_entry_author_avatar() {
		
		// Lets bail if the author avatar shouldn't be displayed
		if ( !wpex_post_entry_author_avatar_enabled() ) return;
		
		// Get post data
		global $post;
		$post_id = $post->ID;
		$output = '';
		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		$author_avatar = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 74 ) );
		
		// Output the author avatar
		$output .= '<div class="blog-entry-author-avatar">';
			$output .= '<a href="'. $author_url .'" title="'. __( 'Visit Author Page', 'wpex' ) .'">'. $author_avatar .'</a>';
		$output .= '</div>';
		
		echo $output;
		
	} // End function
	
} // End if
