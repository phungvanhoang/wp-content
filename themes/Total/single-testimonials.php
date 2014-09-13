<?php
/**
 * The template used for single testimonial posts.
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */

// Get site header
get_header(); ?>
	
	<?php
	// Display the page header
	// See functions/page-header.php
	wpex_page_header(); ?>
    
	<div id="content-wrap" class="container clr full-width">
        <section id="primary" class="content-area clr">
            <div id="content" class="clr site-content" role="main">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clr' ); ?>>
                        <div class="entry-content entry clr">
								<blockquote><?php the_content(); ?></blockquote>
                        </div><!-- .entry-content -->
                    </article><!-- #post -->
                <?php endwhile; ?>
            </div><!-- #content -->
        </section><!-- #primary -->
    </div><!-- .container -->

<?php
// Get site footer
get_footer(); ?>