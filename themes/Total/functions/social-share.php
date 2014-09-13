<?php
/**
 * Create simple social sharing buttons.
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


if ( !function_exists( 'wpex_social_share' ) ) {
	function wpex_social_share( $postid=false ) {
		
		// Bail
		$site_layout = wpex_option( 'main_layout_style', 'full-width');
		if( $site_layout == 'boxed' && !is_singular() ) return;
		if ( post_password_required() ) return;
		
		// Get sharing options
		$sharing_sites = wpex_option('social_share_sites');
		
		if ( empty($sharing_sites) ) return;
		
		// Get post
		global $post;
		$postid = $postid ? $postid :$post->ID;
		if (!$postid) return;
		$post_type = get_post_type($post);
		$meta = get_post_meta($postid, 'wpex_disable_social', true );
		
		// If disabled show nothing
		if ( $meta == 'true' ) return;
		if ( !is_singular('post') && $post_type = 'post' && wpex_option( 'social_share_blog_entries', '1' ) !== '1' ) return;
		if ( is_singular('post') && wpex_option( 'social_share_blog_posts', '1' ) !== '1' ) return;
		if ( is_singular('page') && wpex_option( 'social_share_pages', '1' ) !== '1' ) return;
		if ( is_singular('portfolio') && wpex_option( 'social_share_portfolio', '1' ) !== '1' ) return;
		
		if ( class_exists('Woocommerce') ) {
			if ( is_singular('product') && is_woocommerce() && wpex_option( 'social_share_woo' ) !== '1' ) return;
			if ( !is_singular('product') && is_woocommerce() ) return;	
			if ( is_cart() || is_checkout() ) return;
		}
		
		// Vars		
		$url = get_permalink($postid);
		$url = urlencode( $url );
		$title = esc_attr( the_title_attribute( 'echo=0' ) );
		$summary = wpex_get_excerpt('40');
		$img = wp_get_attachment_url( get_post_thumbnail_id($postid) );
		$source = home_url();
		$social_share_title = __( 'Please Share This', 'wpex' );
		$social_share_title = apply_filters( 'wpex_social_share_title', $social_share_title );
		$wpex_post_layout = wpex_get_post_layout_class();
		$output = '';
		
		// Tooltip Style
		if ( is_rtl() ) {
			$tooltip_class = 'tooltip-right';
		} elseif( $site_layout == 'boxed' ) {
			$tooltip_class = 'tooltip-up';
		} else {
			if ( $wpex_post_layout == 'left-sidebar' ) {
				$tooltip_class ='tooltip-left';
			} else {
				$tooltip_class ='tooltip-right';
			}
		}
		
		// Display heading on Boxed layout
		if( is_singular() ) {
			$output .= '<div class="social-share-title theme-heading"><span>'. $social_share_title .'</span></div>';
		}
		
		// Open URL
		$output .= '<ul class="social-share-buttons clr">';
			
			// Loop through them
			foreach ( $sharing_sites as $key => $value ) {
				
				// Twitter
				if ( $key == 'twitter' && $value ) {
					$output .= '<li class="share-twitter"><a href="http://twitter.com/share?text='. $title .'&url='. $url .'" target="_blank" title="'. __( 'Share on Twitter', 'wpex' ) .'" rel="nofollow" class="'. $tooltip_class .'"><span class="fa fa-twitter"></span></a></li>';	
				}
				
				// Facebook
				if ( $key == 'facebook' && $value ) {
					$output .= '<li class="share-facebook"><a href="http://www.facebook.com/sharer.php?s=100&p[url]='.$url.'&p[images][0]='. $img .'&p[title]='. $title .'&p[summary]='. $summary .'" target="_blank" title="'. __( 'Share on Facebook', 'wpex' ) .'" rel="nofollow" class="'. $tooltip_class .'"><span class="fa fa-facebook"></span></a></li>';
				}
				
				// Google+
				if ( $key == 'google_plus' && $value ) {
					$output .= '<li class="share-googleplus"><a title="'. __( 'Share on Google+', 'wpex' ) .'" rel="external" href="https://plusone.google.com/_/+1/confirm?url=' . $url . '" target="_blank" rel="nofollow" class="'. $tooltip_class .'"><span class="fa fa-google-plus"></span></a></li>';
				}
				
				// Pinterest
				if ( $key == 'pinterest' && $value ) {
					$output .= '<li class="share-pinterest"><a href="http://pinterest.com/pin/create/button/?url='. $url .'&media='. $img .'&description='. $summary .'" target="_blank" title="'. __( 'Share on Pinterest', 'wpex' ) .'" rel="nofollow" class="'. $tooltip_class .'"><span class="fa fa-pinterest"></span></a></li>';
				}
				
				// LinkedIn
				if ( $key == 'linkedin' && $value ) {
					$output .= '<li class="share-linkedin"><a title="'. __( 'Share on LinkedIn', 'wpex' ) .'" rel="external" href="http://www.linkedin.com/shareArticle?mini=true&url='. $url .'&title='. $title .'&summary='. $summary .'&source='. $source .'" target="_blank" rel="nofollow" class="'. $tooltip_class .'"><span class="fa fa-linkedin"></span></a></li>';
				}
			
			}
			
		// Close UL
		$output .= '</ul>';
		
		// Echo the social sharing icons
		echo $output;		
		
	}
}