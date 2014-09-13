<?php
/**
 * Remove the default Woo page title
 *
 * @package WordPress
 * @subpackage Total
 * @since 1.0
*/


// Remove woo page title from shop
if ( !function_exists( 'wpex_remove_woo_shop_title' ) ) {
	function wpex_remove_woo_shop_title() {
		if ( is_shop() && is_singular('product') ) {
			return false;
		}
	}
}
add_filter('woocommerce_show_page_title', 'wpex_remove_woo_shop_title');