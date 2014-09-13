<?php
/**
 * Remove WooCommerce Styles & Scripts
 *
 * @package WordPress
 * @subpackage Total
 * @since 1.0
 */

	
// Remove WooThemes styles 
define('WOOCOMMERCE_USE_CSS', false);


add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );
function child_manage_woocommerce_styles() {
	
	// Remove Woo generator in <head>
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );	
	
	// Remove prettyPhoto Init
	wp_dequeue_script( 'prettyPhoto-init' );
	
	// Load prettyPhoto init for non-mobile devices
	if ( !wp_is_mobile() ) {
		wp_enqueue_script( 'wpex-prettyPhoto-init', get_template_directory_uri() .'/js/prettyphoto-init.js', array('prettyPhoto'), '', true );
	}
	
}