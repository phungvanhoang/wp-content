<?php
/**
 * Displays the copyright info in the footer
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


if ( ! function_exists( 'wpex_footer_copyright' ) ) {
	function wpex_footer_copyright() {
		$output;
		$copyright = wpex_option('footer_copyright');
		$copyright_content = wpex_option('footer_copyright_text');

		if ( $copyright !== '1' ) return;
		$output = do_shortcode( $copyright_content );
		$output = apply_filters( 'wpex_copyright_info', $output );
		echo $output;
	} // End function
} // End if