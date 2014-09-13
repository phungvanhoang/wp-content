<?php
/**
 * Creates a function for your featured image sizes which can be altered via your child theme
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


if ( ! function_exists( 'wpex_get_featured_image_url' ) ) {
	
		function wpex_get_featured_image_url( $post_id = '', $attachment = '', $full_image = false ) {
			
			// Post Vars
			global $post;
			$post_id = $post_id ? $post_id : $post->ID;
			$post_type = get_post_type( $post_id );
			$attachment_id = get_post_thumbnail_id( $post_id );
			$attachment_id = $attachment ? $attachment :	 $attachment_id;
			$attachment_url = wp_get_attachment_url( $attachment_id );
			$post_layout = get_post_meta ( $post_id, 'wpex_post_layout', true );
			
			// Resizing Vars
			$width = 9999;
			$height = 9999;
			$crop = false;
			
			// Return full image url if set to true
			if ( $full_image ) return $attachment_url;
			
			
			// Pages -------------------------------------------------------------------------- >
			if ( $post_type == 'page' && is_singular( 'page' ) ) {
				$width = wpex_option( 'page_image_width', '9999' );
				$height = wpex_option( 'page_image_height', '9999' );
			}
				
			
			// Standard Post Type -------------------------------------------------------------------------- >
			
			if ( $post_type == 'post' ) {
				
				// Singular
				if ( is_singular( 'post' ) ) {
					
					// Width
					if ( wpex_option( 'blog_single_layout' ) == 'full-width' || $post_layout == 'full_width' ) {
						$width = wpex_option( 'blog_post_full_image_width', '9999' );
					} else {
						$width = wpex_option( 'blog_post_image_width', '9999' );
					}
					
					// Height
					if ( wpex_option( 'blog_single_layout' ) == 'full-width' || $post_layout == 'full_width' ) {
						$height =  wpex_option( 'blog_post_full_image_height', '9999' );
					} else {
						$height = wpex_option( 'blog_post_image_height', '9999' );
					}
					
				// Entries
				} else {
					
					// Categories
					if ( is_category() ) {
						
						// Get term data
						$term = get_query_var('cat');
						$term_data = get_option("category_$term");
						
						// Width
						if ( isset($term_data['wpex_term_image_width']) ) {
							if ( $term_data['wpex_term_image_width'] !== '' ) {
								$width = $term_data['wpex_term_image_width'];
							} else {
								$width = wpex_option( 'blog_entry_image_width', '9999' );
							}
						} else {
							$width = wpex_option( 'blog_entry_image_width', '9999' );
						}
						
						// height
						if ( isset($term_data['wpex_term_image_height']) ) {
							if ( $term_data['wpex_term_image_height'] !== '' ) {
								$height = $term_data['wpex_term_image_height'];
							} else {
								$height = wpex_option( 'blog_entry_image_height', '9999' );
							}
						} else {
							$height = wpex_option( 'blog_entry_image_height', '9999' );
						}
						
					// All Else
					} else {
					
						$width = wpex_option( 'blog_entry_image_width', '9999' );
						$height = wpex_option( 'blog_entry_image_height', '9999' );
					
					}
					
				} // End if singular
				
			} // End if post_type
			
		
		
			// Staff Post Type -------------------------------------------------------------------------- >
				
			if ( $post_type == 'staff' ) {
				$width = wpex_option( 'staff_entry_image_width', '9999' );
				$height = wpex_option( 'staff_entry_image_height', '9999' );		
			} // End if post_type
			
			
			
			
			// Portfolio Post Type -------------------------------------------------------------------------- >
			
			if ( $post_type == 'portfolio' ) {
				$width = wpex_option( 'portfolio_entry_image_width', '9999' );
				$height = wpex_option( 'portfolio_entry_image_height', '9999' );		
			} // End if post_type
			
			
			
			
			// Testimonials Post Type -------------------------------------------------------------------------- >
			
			if ( $post_type == 'testimonials' ) {
				$width = wpex_option( 'testimonial_entry_image_width', '9999' );
				$height = wpex_option( 'testimonial_entry_image_height', '9999' );		
			} // End if post_type
			
			
			
			// Search -------------------------------------------------------------------------- >
			if ( is_search() ) {
				$width = '100';
				$height = '100';	
			}
			
			
		
		// Return Dimensions & crop
		$width = intval($width);
		$height = intval($height);
		$crop = ( $height == '9999' ) ? false : true;
		$cropped_image = aq_resize( $attachment_url, $width, $height, $crop );
		$cropped_image = apply_filters( 'wpex_get_featured_image_url', $cropped_image );
		return $cropped_image;
			
			
		} // End function
	
} // End if