<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */

// Get site header
get_header(); ?>

	<?php
	// Display the page header - see functions/page-header.php
	wpex_page_header(); ?>
    
	<div id="content-wrap" class="container clr <?php echo wpex_get_post_layout_class(); ?>">
		<section id="primary" class="content-area clr">
			<div id="content" class="site-content" role="main">
				<?php
				// Execute the following code if posts infact exist
				if ( have_posts() ) : ?>
                	<div id="blog-entries" class="clr <?php wpex_blog_wrap_classes(); ?>">
						<?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'content', get_post_format() ); ?>
                        <?php endwhile; ?>
					</div><!-- #blog-entries -->
				<?php
				// Display pagination - see function/pagination.php
				wpex_blog_pagination(); ?>
				<?php
				// Show message because there aren't any posts
				else : ?>
					<article class="clr"><?php _e( 'No Posts found.', 'wpex' ); ?></article>
				<?php endif; ?>
            </div><!-- #content -->
        </section><!-- #primary -->
		<?php
		// Get site sidebar
		get_sidebar(); ?>
    </div><!-- .container -->
    
<?php
// Get site footer
get_footer(); ?>