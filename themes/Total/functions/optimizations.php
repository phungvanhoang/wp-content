<?php
/**
 * Make a few general site optimizations
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/

 
// Cleans up your site's <head> from auto added WP code
if ( wpex_option( 'remove_header_junk' ) == '1' ) {
	remove_action( 'wp_head', 'feed_links_extra'); // Display the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links'); // Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'index_rel_link' ); // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10); // prev link
	remove_action( 'wp_head', 'start_post_rel_link', 10); // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10); // Display relational links for the posts adjacent to the current post.
	remove_action( 'wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
}


// Remove Jetpack devicepx script
if ( wpex_option( 'remove_jetpack_devicepx', '1' ) == '1' ) {
	add_action('wp_enqueue_scripts', create_function( null, "wp_dequeue_script('devicepx');" ), 20);
}