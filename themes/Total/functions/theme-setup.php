<?php
/**
 * Setup the theme - yay!
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
 

add_action( 'after_setup_theme', 'wpex_theme_setup' );

function wpex_theme_setup() {
	
	// Localization support
	load_theme_textdomain( 'wpex', get_template_directory() .'/languages' );

	// Register navigation menus
	register_nav_menus (
		array(
			'main_menu'	=> __( 'Main', 'wpex' ),
			'footer_menu'	=> __( 'Footer', 'wpex' ),
			'mobile_menu'	=> __( 'Mobile Icons', 'wpex' ),
		)
	);		
		
	// Enable some useful post formats for the blog
	add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote' ) );
	
	// Add automatic feed links in the header - for themecheck nagg
	add_theme_support( 'automatic-feed-links' );
	
	// Enable the custom background dashboard
	add_theme_support( 'custom-background' );
	
	// Enable featured image support
	add_theme_support( 'post-thumbnails' );
	
	// Add header support - for Themecheck nagg
	add_theme_support( 'custom-header', array( 'header-text'	=> false ) );
	
	// And HTML5 support
	add_theme_support( 'html5' );
	
	// Enable excerpts for pages.
	add_post_type_support( 'page', 'excerpt' );
	
	// Add support for WooCommerce - Yay!
	add_theme_support( 'woocommerce' );

}


// Editor CSS
add_action( 'init', 'wpex_add_editor_style' );
if ( ! function_exists('wpex_add_editor_style') ) {
	function wpex_add_editor_style() {
		add_editor_style( 'editor-style.css' );
	}
}