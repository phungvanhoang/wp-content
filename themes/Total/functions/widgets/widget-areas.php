<?php
/**
 * This file registers the theme's widget regions
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */


// Sidebar headings style
$wpex_sidebar_headings = wpex_option( 'sidebar_headings', 'div' );
$wpex_sidebar_headings = apply_filters( 'wpex_sidebar_headings', $wpex_sidebar_headings );


// Footer headings style
$wpex_footer_headings = wpex_option( 'footer_headings', 'div' );
$wpex_footer_headings = apply_filters( 'wpex_footer_headings', $wpex_footer_headings );

// Main
register_sidebar( array (
	'name'				=> __( 'Main Sidebar','wpex'),
	'id'				=> 'sidebar',
	'description'		=> __( 'Widgets in this area are used in the default sidebar. This sidebar will be used for your standard blog posts.','wpex' ),
	'before_widget'	=> '<div class="sidebar-box %2$s clr">',
	'after_widget'		=> '</div>',
	'before_title'		=> '<'. $wpex_sidebar_headings .' class="widget-title">',
	'after_title'		=> '</'. $wpex_sidebar_headings .'>',
) );


// Pages
if ( wpex_option( 'pages_custom_sidebar', '1' ) == '1' ) {
	register_sidebar( array (
		'name'				=> __( 'Pages Sidebar','wpex'),
		'id'				=> 'pages_sidebar',
		'description'		=> __( 'Widgets in this area are used for your pages sidebar.','wpex' ),
		'before_widget'	=> '<div class="sidebar-box %2$s clr">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<'. $wpex_sidebar_headings .' class="widget-title">',
		'after_title'		=> '</'. $wpex_sidebar_headings .'>',
	) );
}


// Portfolio
if ( wpex_option( 'portfolio_custom_sidebar', '1' ) == '1' ) {
	register_sidebar( array (
		'name'				=> __( 'Portfolio Sidebar','wpex'),
		'id'				=> 'portfolio_sidebar',
		'description'		=> __( 'Widgets in this area are used for your Portfolio post type sidebar.','wpex' ),
		'before_widget'	=> '<div class="sidebar-box %2$s clr">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<'. $wpex_sidebar_headings .' class="widget-title">',
		'after_title'		=> '</'. $wpex_sidebar_headings .'>',
	) );
}


// Staff
if ( wpex_option( 'staff_custom_sidebar', '1' ) == '1' ) {
	register_sidebar( array (
		'name'				=> __( 'Staff Sidebar','wpex'),
		'id'				=> 'staff_sidebar',
		'description'		=> __( 'Widgets in this area are used for your Staff post type sidebar.','wpex' ),
		'before_widget'	=> '<div class="sidebar-box %2$s clr">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<'. $wpex_sidebar_headings .' class="widget-title">',
		'after_title'		=> '</'. $wpex_sidebar_headings .'>',
	) );
}


// WooCommerce
if ( class_exists('Woocommerce') && wpex_option( 'woo_custom_sidebar', '1' ) == '1' ) {
	register_sidebar( array (
		'name'				=> __( 'WooCommerce Sidebar','wpex'),
		'id'				=> 'woo_sidebar',
		'description'		=> __( 'Widgets in this area are used in the default sidebar. This sidebar will be used for your standard blog posts.','wpex' ),
		'before_widget'	=> '<div class="sidebar-box %2$s clr">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<'. $wpex_sidebar_headings .' class="widget-title">',
		'after_title'		=> '</'. $wpex_sidebar_headings .'>',
	) );
}


// Footer
if( wpex_option('widgetized_footer','1') == '1' ) {
	
	// Footer 1
	register_sidebar( array (
		'name'				=> __( 'Footer 1','wpex'),
		'id'				=> 'footer_one',
		'description'		=> __( 'Widgets in this area are used in the first footer column','wpex' ),
		'before_widget'	=> '<div class="footer-widget %2$s clr">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<'. $wpex_footer_headings .' class="widget-title">',
		'after_title'		=> '</'. $wpex_footer_headings .'>',
	) );
	
	// Footer 2
	register_sidebar( array (
		'name'				=> __( 'Footer 2','wpex'),
		'id'				=> 'footer_two',
		'description'		=> __( 'Widgets in this area are used in the second footer column','wpex' ),
		'before_widget'	=> '<div class="footer-widget %2$s clr">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<'. $wpex_footer_headings .' class="widget-title">',
		'after_title'		=> '</'. $wpex_footer_headings .'>'
	) );
	
	// Footer 3
	register_sidebar( array (
		'name'				=> __( 'Footer 3','wpex'),
		'id'				=> 'footer_three',
		'description'		=> __( 'Widgets in this area are used in the third footer column','wpex' ),
		'before_widget'	=> '<div class="footer-widget %2$s clr">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<'. $wpex_footer_headings .' class="widget-title">',
		'after_title'		=> '</'. $wpex_footer_headings .'>',
	) );
	
	// Footer 4
	register_sidebar( array (
		'name' 				=> __( 'Footer 4','wpex'),
		'id' 				=> 'footer_four',
		'description'		=> __( 'Widgets in this area are used in the fourth footer column','wpex' ),
		'before_widget'	=> '<div class="footer-widget %2$s clr">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<'. $wpex_footer_headings .' class="widget-title">',
		'after_title'		=> '</'. $wpex_footer_headings .'>',
	) );
	
} // End Footer widgets