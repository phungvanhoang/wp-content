<?php
/**
 * The template for displaying Author archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */


// Get site header
get_header(); ?>

	<?php if ( have_posts() ) : ?>
	
		<?php the_post(); ?>
		<header class="page-header archive-header">
        	<div class="container clr">
                <h1 class="page-header-title archive-title"><?php printf( __( 'All Posts By %s', 'wpex' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
                <div id="page-header-description" class="clr">
                	<?php _e( 'This author has written', 'wpex' ); ?> <?php echo $wp_query->found_posts; ?> <?php _e( 'articles', 'wpex' ); ?>
                </div><!-- #page-header-description -->
                <?php wpex_display_breadcrumbs(); // see functions/breadcrumbs.php ?>
            </div><!-- .container -->
		</header><!-- .archive-header -->

		<div id="content-wrap" class="container clr <?php echo wpex_get_post_layout_class(); ?>">
			<section id="primary" class="content-area clr">
                <div id="content" class="site-content" role="main">
                    <?php rewind_posts(); ?>
                	  <div id="blog-entries" class="clr <?php wpex_blog_wrap_classes(); ?>">
						<?php
						// Loop through posts
						while ( have_posts() ) : the_post();
                     		get_template_part('content', get_post_format() );
                      endwhile; ?>
                    </div><!-- #blog-entries -->
					<?php
					// Display post pagination
					wpex_blog_pagination(); ?>
                </div><!-- #content -->
			</section><!-- #primary -->
        <?php endif; ?>
		<?php
		// Get site footer
		get_sidebar(); ?>
    </div><!-- #content-wrap -->

<?php
// Get site footer
get_footer(); ?>