<?php

/**
 * Used for your quote format posts
 * The entries and the posts have the same design/layout
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<span class="fa fa-quote-right"></span>
	<?php
	// Content for single posts
	if ( is_singular( 'post' ) ) { ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="quote-entry-content clr">
				<?php the_content(); ?>
			</div><!-- .quote-entry-content -->
		<?php endwhile; ?>
	<?php } else {
		// Content for entries ?>
		<div class="quote-entry-content clr">
			<?php the_content(); ?>
		</div><!-- .quote-entry-content -->
	<?php } ?>
	<div class="quote-entry-author clr">
		<?php the_title(); ?>
	</div><!-- .quote-entry-author -->
</article><!-- .blog-entry -->