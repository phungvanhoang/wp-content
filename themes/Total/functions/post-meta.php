<?php
/**
 * Outputs the post meta for blog posts & entries
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


if ( ! function_exists( 'wpex_post_meta' ) ) {
	
	function wpex_post_meta() {
		
		global $post;
		$post_id = $post->ID;
		$category = get_the_category();
		$fist_category = $category[0];
		
		ob_start(); ?>
		
		<ul class="meta clr">
			<li class="meta-date"><span class="fa fa-clock-o"></span><?php echo get_the_date(); ?></li>
			<?php if($fist_category){ ?>
				<li class="meta-category"><span class="fa fa-folder-o"></span><a href="<?php echo get_category_link($category[0]->term_id ); ?>" title="<?php echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></li>
			<?php } ?>
			<?php if( comments_open() ) { ?>
				<li class="meta-comments comment-scroll"><span class="fa fa-comment-o"></span><?php comments_popup_link( __( '0 Comments', 'wpex' ), __( '1 Comment',  'wpex' ), __( '% Comments', 'wpex' ), 'comments-link' ); ?></li>
			<?php } ?>
			<?php if ( is_singular('post') && wpex_option( 'post_next_prev_meta', '1' ) == '1' ) { ?>
				<li id="single-post-next-prev" class="clr">
					<?php next_post_link( '%link','<span class="theme-button"><span class="fa fa-chevron-left"></span></span>' ); ?>
					<?php previous_post_link( '%link','<span class="theme-button"><span class="fa fa-chevron-right"></span></span>' ); ?>
				</li><!-- #single-post-next-prev -->
			<?php } ?>
		</ul>
		
		<?php
		echo ob_get_clean();
		
	} // End function
	
} // End if
