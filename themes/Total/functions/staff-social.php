<?php
/**
 * Social profiles for staff members
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/

if ( ! function_exists( 'wpex_get_staff_social' ) ) {
	function wpex_get_staff_social($id=NULL) {
		$post_id = $id ? $id : get_the_ID();
		$output='';
		$profiles = array(
			'twitter'		=> 'Twitter',
			'facebook'		=> 'Facebook',
			'google-plus'	=> 'Google Plus',
			'linkedin'		=> 'LinkedIn',
			'dribbble'		=> 'Dribbble',
			
		);
		$output .='<div class="staff-social clr">';
			foreach ( $profiles as $key => $value ) {
				$meta = get_post_meta( $post_id, 'wpex_staff_'. $key, true );
				if ( $meta ) {
					$output .='<a href="'. $meta .'" title="'. $value .'" class="staff-'. $key .' tooltip-up"><span class="fa fa-'. $key .'"></span></a>';
				}
			}
		$output .='</div><!-- .staff-social -->';
		return $output;
	}
}
add_shortcode( 'staff_social', 'wpex_get_staff_social' );