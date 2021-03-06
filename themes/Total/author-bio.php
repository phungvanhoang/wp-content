<?php
/**
 * The template for displaying Author bios.
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
?>

<section class="author-bio">
	<div class="author-bio-avatar">
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php _e( 'Visit Author Page', 'wpex' ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 74 ) ); ?></a>
	</div><!-- .author-bio-avatar -->
	<div class="author-bio-content">
		<div class="author-bio-title"><span><?php echo get_the_author(); ?></span></div>
		<p><?php the_author_meta( 'description' ); ?></p>
	</div><!-- .author-bio-content -->
</section><!-- .author-bio -->