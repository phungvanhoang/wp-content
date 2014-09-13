<?php
/**
 * The template used for single staff posts.
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
	
	<?php
	// Displays full-width slider, see functions/post-slider.php
	wpex_post_slider(); ?>
    
    <div id="content-wrap" class="container clr <?php echo wpex_get_post_layout_class(); ?>">
        <section id="primary" class="content-area clr">
            <div id="content" class="clr site-content" role="main">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clr' ); ?>>
                        <div class="entry-content entry clr">
                            <?php the_content(); ?>
                        </div><!-- .entry-content -->
                    </article><!-- #post -->
					<?php
					// Get comments & comment form if enabled for portfoliop posts
					if ( wpex_option( 'staff_comments' ) == '1' ) { ?>
					<section id="staff-post-comments" class="clr">
						<?php comments_template(); ?>
					</section><!-- #staff-post-comments -->
					<?php } ?>
                <?php endwhile; ?>
            </div><!-- #content -->
        </section><!-- #primary -->
        <?php
		// Get site sidebar
		get_sidebar(); ?>
		<div class="clr"></div>
			<?php
			// Display Related staff posts if enabled
			if ( wpex_option( 'staff_related', '1' ) == '1' ) { ?>
				<?php
				// Query related staff posts based on category similarity
				$terms = wp_get_post_terms( get_the_ID(), 'staff_category');
				$related_query = $tax_query = NULL;
				if ( wpex_option( 'staff_related_same_cat' ) == '1' ) {
					if ( $terms[0]->term_id !== '' ) {
						$tax_query = array ( array (
						'taxonomy'	=> 'staff_category',
						'field'		=> 'id',
						'terms'		=> $terms[0]->term_id ) );
					}
				}
				$related_query = new WP_Query(
				array(
					'post_type'		=> 'staff',
					'posts_per_page'	=> wpex_option( 'staff_related_count', '4' ),
					'exclude'			=> get_the_ID(),
					'no_found_rows'	=> true,
					'tax_query'		=> $tax_query
					)
				);
				if( $related_query->posts ) { ?>
					<section class="related-staff-posts clr">
						<div class="theme-heading"><span><?php echo wpex_option( 'staff_related_title', __( 'Related Staff', 'wpex' ) ); ?></span></div>
						<?php
						// Loop through posts
						$wpex_count=0;
							while( $related_query->have_posts() ) : $related_query->the_post();
							$wpex_count++;
							get_template_part( 'content-staff', get_post_format() );
							if( $wpex_count == wpex_option( 'staff_related_count', '4' ) ) $wpex_count=0;
						endwhile; ?>
					</section><!-- .related-staff-posts -->
				<?php } // End related items ?>
			<?php } ?>
			
		<?php
		// Get main sidebar
		get_sidebar(); ?>
		
		<?php
		// Display next and previous post links if enabled
		// See functions/next-prev.php
		if ( wpex_option( 'staff_next_prev', '1' ) == '1' ) {
			wpex_next_prev();
		} ?>
    </div><!-- .container -->

<?php
// Get site footer
get_footer(); ?>