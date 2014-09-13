<?php
/**
 * Used for next and previous post links
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


if ( ! function_exists( 'wpex_next_prev' ) ) {
	function wpex_next_prev() {
		
		// Not singular so bye bye!
		if ( !is_singular() ) return;
		
		ob_start(); ?>
			<div class="clr"></div>
			<ul class="post-pagination clr">
				<?php previous_post_link( '<li class="post-next">%link<span>&rarr;</span></li>' ); ?><?php next_post_link( '<li class="post-prev"><span>&larr;</span>%link</li>' ); ?>
			</ul><!-- .post-post-pagination -->
		<?php echo ob_get_clean();
	}
}