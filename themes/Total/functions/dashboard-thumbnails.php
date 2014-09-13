<?php
/**
 * Create Custom Columns for the WP dashboard
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */

 
// Add thumbnails to post admin dashboard
add_filter('manage_posts_columns', 'wpex_posts_columns', 10);
add_action('manage_posts_custom_column', 'wpex_posts_custom_columns', 10, 2);

function wpex_posts_columns($defaults){
    $defaults['wpex_post_thumbs'] = __( 'Thumbnail', 'wpex' );
    return $defaults;
}

function wpex_posts_custom_columns( $column_name, $id ){
	$post_id = get_the_ID();
    if( $column_name != 'wpex_post_thumbs' ) {
        return;	
	}
	$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
	if ( $thumbnail_id ) {
		$width = (int) 60;
		$height = (int) 60;
		$edit_link = get_edit_post_link($post_id);
		echo '<a href="'. $edit_link .'">'. wp_get_attachment_image( $thumbnail_id, array($width, $height), true ) .'</a>';
	} else {
		return;
	}
}