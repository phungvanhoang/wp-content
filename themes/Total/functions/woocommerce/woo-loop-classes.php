<?php
/**
 * Change default Product loop classes
 *
 * @package WordPress
 * @subpackage Total
 * @since 1.0
 */


add_filter('post_class', 'woocommerce_product_classes');
function woocommerce_product_classes($classes) {
	global $woocommerce_loop;
	if ( isset($woocommerce_loop['columns']) ) {
		$classes[] = 'col';
 		$classes[] = wpex_grid_class($woocommerce_loop['columns']);
	}
    return $classes;
}