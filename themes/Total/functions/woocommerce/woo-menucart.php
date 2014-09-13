<?php
/**
 * Add Menu Cart to menu
 *
 * Code elegantly lifted from: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 *
 * @package WordPress
 * @subpackage Total
 * @since 1.0
*/


add_filter( 'wp_nav_menu_items', 'wpex_add_itemcart_to_menu' , 10, 2 );
add_filter( 'add_to_cart_fragments', 'wpex_wcmenucart_add_to_cart_fragment' );
		

function wpex_add_itemcart_to_menu( $items, $args ) {
	global $options;
	if( $args->theme_location == 'main_menu' ) {
		
		// Only add toggle class when needed
		if ( is_cart() || is_checkout() ) {
			$classes = '';
		} else {
			$classes = 'wcmenucart-toggle';
		}
		
		$items .= '<li class="'.$classes.'">' . wpex_wcmenucart_menu_item() . '</li>';
	}
	return $items;
}

function wpex_wcmenucart_add_to_cart_fragment( $fragments ) {
	$fragments['.wcmenucart'] = wpex_wcmenucart_menu_item();
	return $fragments;
}

function wpex_wcmenucart_menu_item() {
	global $woocommerce;
	global $options;
	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
	$cart_total = $woocommerce->cart->get_cart_total();
	$menu_item = '';
	$icon_output = '<span class="fa fa-shopping-cart"></span>';
	
	return '<a href="'. $shop_page_url .'" class="wcmenucart" title="'. __('Your Cart','wpex') .'"><span class="wcmenucart-count">'. $icon_output .''. $cart_total. '</span></a>';
}