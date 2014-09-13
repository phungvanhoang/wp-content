<?php
/**
 * Add Menu Cart to menu
 *
 * Code elegantly lifted from: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 * Edited by WPExplorer
 *
 * @package WordPress
 * @subpackage Total
 * @since 1.0
*/


if ( ! function_exists('wpex_cart_widget') ) {
	function wpex_cart_widget() {
		
		// WooCommerce is not active, so bail
		if ( ! class_exists('Woocommerce') ) return;
		
		// If disabled bail
		if ( wpex_option('woo_menu_icon','1') !== '1' ) return;
				
		// Globals & vars
		global $woocommerce;
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		
		// Not needed on checkout
		if ( is_checkout() ) return false;
		
		// Not needed on cart page when items exist
		if ( is_cart() && sizeof( $cart_contents_count ) !== 0 ) return false;
		
		ob_start(); ?>
		
		<section id="current-shop-items" class="clr">
			<div id="current-shop-items-inner" class="clr">
				<?php
				// Display WooCommerce cart
				if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
					the_widget( 'WC_Widget_Cart', 'title= ' );
				} else {
					the_widget( 'WooCommerce_Widget_Cart', 'title= ' );
				} ?>
			</div><!-- #current-shop-items-inner -->
		</section><!-- #current-shop-items -->
		
	<?php echo ob_get_clean();
	}
}