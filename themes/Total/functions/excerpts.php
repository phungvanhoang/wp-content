<?php
/**
 * Custom excerpt functions
 * 
 * http://codex.wordpress.org/Function_Reference/wp_trim_words
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


// Custom Excerpt output function
if ( !function_exists( 'wpex_excerpt' ) ) {
	
	function wpex_excerpt($length=30, $readmore=false ) {
		
		// Vars
		global $post;
		$id = $post->ID;
		$excerpt='';
		$meta_excerpt = get_post_meta( $id, 'wpex_excerpt_length', true );
		$length = $meta_excerpt ? $meta_excerpt : $length;	
		
		//Filter for changing the readmore text via a child theme
		$readmore_text = apply_filters( 'wpex_read_more_text', __('view post', 'wpex' ) );
		
		// Custom excerpt field
		if ( has_excerpt( $id ) ) {
			$excerpt = apply_filters( 'the_content', $post->post_excerpt );
			
		// Create excerpts from the trimmed content
		} else {
			$content = get_the_content('');
			$content = do_shortcode( $content );
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]>', $content);
			$content = apply_filters('the_content', $content);
			$excerpt = '<p>'. wp_trim_words( $content, $length ) .'</p>';
			if ( $readmore == true ) {
				$readmore_link = '<a href="'. get_permalink( $id ) .'" title="'. $readmore_text .'" rel="bookmark" class="readmore-link">'. $readmore_text .' &rarr;</a>';
				$excerpt .= apply_filters( 'wpex_readmore_link', $readmore_link );
			}
		}
		
		// Echo the excerpt
		echo $excerpt;
		
	} // End function
	
} // End if


// Custom Excerpt return function
if ( !function_exists( 'wpex_get_excerpt' ) ) {
	function wpex_get_excerpt($length=30) {
		global $post;
		$id = $post->ID;
		$excerpt='';
		if ( has_excerpt( $id ) ) {
			$excerpt = apply_filters( 'the_content', $post->post_excerpt );
		} else {
			$content = get_the_content('');
			$content = do_shortcode( $content );
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]>', $content);
			$content = apply_filters('the_content', $content);
			$excerpt = wp_trim_words( $content, $length );
		}
		return $excerpt;
	}
}

// Custom Excerpt length for posts
if ( !function_exists( 'wpex_excerpt_length' ) ) {	
	function wpex_excerpt_length() {
		
		// Theme panel length setting
		$length = wpex_option( 'blog_excerpt_length', '40');
		
		// Taxonomy setting
		if ( is_category() ) {
			
			// Get taxonomy meta
			$term = get_query_var('cat');
			$term_data = get_option("category_$term");
			
			if ( isset($term_data['wpex_term_excerpt_length']) ) {
				$length = $term_data['wpex_term_excerpt_length'] !== '' ? $term_data['wpex_term_excerpt_length'] .'' : $length;
			}
			
		}
		
		// Return length and add filter for quicker child theme editign
		return apply_filters( 'wpex_excerpt_length', $length );
		
	} // End function
} // End if


// Change default read more style
if ( !function_exists( 'wpex_excerpt_more' ) ) {
	function wpex_excerpt_more($more) {
		global $post;
		return '...';
	}
}
add_filter('excerpt_more', 'wpex_excerpt_more');


// Change default excerpt length
if ( !function_exists( 'wpex_custom_excerpt_length' ) ) {
	function wpex_custom_excerpt_length( $length ) {
		return wpex_option('excerpt_length','65');
	}
}
add_filter( 'excerpt_length', 'wpex_custom_excerpt_length', 999 );

// Prevent Page Scroll When Clicking the More Link
// Learn more @ http://codex.wordpress.org/Customizing_the_Read_More
if ( !function_exists( 'wpex_remove_more_link_scroll' ) ) {
	function wpex_remove_more_link_scroll( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
		return $link;
	}
}
add_filter( 'the_content_more_link', 'wpex_remove_more_link_scroll' );