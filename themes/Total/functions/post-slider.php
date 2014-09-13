<?php
/*
 * Display page slider based on meta option
 *
 * @package WordPress
 * @subpackage Total
 * @since 1.0
*/


if ( ! function_exists('wpex_post_slider') ) {
	function wpex_post_slider() {
		global $post;
		$slider = get_post_meta( $post->ID, 'wpex_post_slider_shortcode', true );
		$main_title = get_post_meta( get_the_ID(), 'wpex_disable_title', true );
		$margin =  get_post_meta( get_the_ID(), 'wpex_post_slider_bottom_margin', true );
		if ( $slider  !== '' ) { ?>
			<div class="page-slider clr">
				<?php echo apply_filters( 'the_content', $slider ); ?>
			</div><!-- .page-slider -->
			<?php if ( $margin ) { ?>
				<div style="height:<?php echo $margin; ?>;"></div>
			<?php } ?>
		<?php }
	}
}