<?php
/**
 * Scripts
 *
 * @package     Visual Composer Extend
 * @subpackage  Functions
 * @copyright   Copyright (c) 2013, AJ Clarke
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Load Back-End Scripts
 *
 * @since 1.0
 * @return void
 */
function vcex_load_backend_scripts() {
	$css_dir = VCEX_PLUGIN_URL . 'assets/css/';
	wp_enqueue_style( 'vcex-admin-css', $css_dir . 'vcex-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'vcex_load_backend_scripts' );

/**
 * Load Front-End Scripts
 *
 * @since 1.0
 * @return void
 */
function vcex_load_frontend_scripts() {
	
	$js_dir = VCEX_PLUGIN_URL . 'assets/js/';
	$css_dir = VCEX_PLUGIN_URL . 'assets/css/';
	
	// Js
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'vcex-skillbar', $js_dir . 'vcex-skillbar.js', array ( 'jquery' ), '1.0', true );
	wp_register_script( 'vcex-magnific-popup', $js_dir . 'magnific-popup.min.js', array ( 'jquery' ), '0.9.4', true );
	wp_register_script( 'vcex-lightbox', $js_dir . 'vcex-lightbox.js', array ( 'jquery', 'vcex-magnific-popup' ), '1.0', true );
	wp_register_script( 'vcex-touchSwipe', $js_dir . 'touchSwipe.js', array ( 'jquery' ), '6.2.1', true );
	wp_register_script( 'vcex-caroufredsel', $js_dir . 'caroufredsel.js', array ( 'jquery', 'vcex-touchSwipe' ), '6.2.1', true );
	wp_register_script( 'vcex-flexslider', $js_dir . 'flexslider.js', array ( 'jquery' ), '2.2.0', true );
	wp_register_script( 'vcex-parallax', $js_dir . 'vcex-parallax.js', array ( 'jquery' ), '1.0', true );
	wp_register_script( 'vcex-isotope', $js_dir . 'isotope.js', array ( 'jquery' ), '1.5.25', true );
	wp_register_script( 'vcex-masonry', $js_dir . 'masonry.js', array ( 'jquery' ), '3.1.2', true );
	wp_register_script( 'vcex-appear', $js_dir . 'appear.js', array ( 'jquery' ), '', true );
	wp_register_script( 'vcex-countTo', $js_dir . 'countTo.js', array ( 'jquery' ), '', true );
	wp_register_script( 'vcex-milestone', $js_dir . 'vcex-milestone.js', array ( 'jquery', 'vcex-countTo', 'vcex-appear' ), '', true );
	
	// CSS
	wp_enqueue_style( 'vcex-lightbox', $css_dir . 'lightbox.css' );
	wp_enqueue_style( 'vcex-composer-extend', $css_dir . 'vcex-shortcodes.css' );
	wp_enqueue_style( 'vcex-font-awesome', $css_dir . 'font-awesome.min.css' );
	
}
add_action( 'wp_enqueue_scripts', 'vcex_load_frontend_scripts' );