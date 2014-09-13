<?php
/**
 * Remove the ajax add to cart button for the shop
 *
 * @package WordPress
 * @subpackage Total
 * @since 1.0
 */

/* Actually lets keep this.
add_action('init','wpex_remove_woo_ajax_cart_button');
if ( !function_exists( 'wpex_remove_woo_ajax_cart_button' ) ) {
	function wpex_remove_woo_ajax_cart_button(){
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	}
}
*/