<?php
/**
 * Adds classes to the body tag for various page/post layout styles
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/

add_filter( 'body_class', 'wpex_body_classes' );
if ( !function_exists('wpex_body_classes') ) {
	function wpex_body_classes( $classes ) {
		
		// WPExplorer class
		$classes[] = 'wpex-theme';
		
		// Layout Style
		if ( ! is_singular('page') ) {
			$classes[] = wpex_option( 'main_layout_style', 'full-width') .'-main-layout';
		} else {
			global $post;
			$meta = get_post_meta($post->ID, 'wpex_main_layout', true);
			if ( $meta !== '' ) {
				$classes[] = $meta .'-main-layout';
			} else {
				$classes[] = wpex_option( 'main_layout_style', 'full-width') .'-main-layout';
			}
		}
		
		// Responsive
		if( wpex_option( 'responsive', '1' ) == '1' ) {
			$classes[] = 'wpex-responsive';
		}
		
		// Remove header bottom margin
		if ( is_singular() ) {
			global $post;
			$disable_header_margin = get_post_meta($post->ID, 'wpex_disable_header_margin', true);
			$slider = get_post_meta( $post->ID, 'wpex_post_slider_shortcode', true );
			if ( $disable_header_margin == 'on' || $slider ) {
				$classes[] = 'no-header-margin';
			}

		}
		
		// WooCommerce
		if ( class_exists('Woocommerce') ) {
			if ( wpex_option( 'woo_shop_slider' ) !== '' && is_shop() ) {
				$classes[] = 'page-with-slider';
			}
			if ( wpex_option( 'woo_shop_title', '1' ) !== '1' && is_shop() ) {
				$classes[] = 'page-without-title';
			}
		}
		
		return $classes;
	}
}
?>