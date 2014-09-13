<?php
/**
 * Alter default WooCommerce columns/pagination
 *
 * @package WordPress
 * @subpackage Total
 * @since 1.0
 */

	
// Change products per/page for the shop
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );


// Change number or products per row to 3
add_filter('loop_shop_columns', 'wpex_loop_columns');
if (!function_exists('wpex_loop_columns')) {
	function wpex_loop_columns() {
		$columns = wpex_option( 'woocommerce_shop_columns', '3' );
		return $columns;
	}
}


// Change number of products for related products
function woocommerce_output_related_products($columns) {
	$posts_per_page = wpex_option( 'woocommerce_related_columns', '3' );
	woocommerce_related_products($columns,$posts_per_page);
}


// Change number of related products on product page
function woo_related_products_limit() {
  global $product, $orderby, $related;	
  $posts_per_page = wpex_option( 'woocommerce_related_count', '3' );
  $args = array(
		'post_type'        		=> 'product',
		'no_found_rows'    		=> 1,
		'posts_per_page'   		=> $posts_per_page,
		'ignore_sticky_posts' 	=> 1,
		'orderby'             	=> $orderby,
		'post__in'            	=> $related,
		'post__not_in'        	=> array($product->id)
	);
	return $args;
}
add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );




// Change number of columns for upsells
function woocommerce_upsell_display( $posts_per_page = 4, $columns = 4, $orderby = 'rand' ) {
	$woo_product_layout = wpex_option( 'woo_product_layout', 'full-width' );
	$posts_per_page = wpex_option( 'woocommerce_upsell_columns', '4' );
	if ( is_singular() && $woo_product_layout != 'full-width' ) {
		$posts_per_page = wpex_option( 'woocommerce_with_sidebar_upsell_columns', '3' );
	}
	woocommerce_get_template( 'single-product/up-sells.php', array(
		'posts_per_page' => $posts_per_page,
		'orderby' => $orderby,
		'columns' => $columns
	) );
}



//Change number of products for upsells
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );
if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
	function woocommerce_output_upsells() {
		$woo_product_layout = wpex_option( 'woo_product_layout', 'full-width' );
		$columns = wpex_option( 'woocommerce_upsell_columns', '4' );
		if ( is_singular() && $woo_product_layout != 'full-width' ) {
			$columns = wpex_option( 'woocommerce_with_sidebar_upsell_columns', '3' );
		}
	    woocommerce_upsell_display( $columns, $columns );
	}
}