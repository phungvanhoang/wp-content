<?php
/**
 * The template used for single portfolio posts.
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */

// Get site header
get_header(); ?>

	<?php
	// Start the standard WP loop
	while ( have_posts() ) : the_post(); ?>
		
	<?php
	// Display the page header - see functions/page-header.php
	wpex_page_header(); ?>
	
	<?php
	// Displays full-width slider, see functions/post-slider.php
	wpex_post_slider(); ?>
		
    <div id="content-wrap" class="container clr <?php echo wpex_get_post_layout_class(); ?>">
		<section id="primary" class="content-area">
			<div id="content" class="site-content clr" role="main">
			
				<article class="entry clr">
					<?php the_content(); ?>
				</article><!-- .entry clr -->
				
				<?php
				// Social sharing links
				if ( wpex_option( 'portfolio_social_share', '1' ) == '1' ) { ?>
					<?php wpex_social_share(); ?>
				<?php } ?>
				
				<?php
				// Get comments & comment form if enabled for portfoliop posts
				if ( wpex_option( 'portfolio_comments' ) == '1' ) { ?>
				<section id="portfolio-post-comments" class="clr">
					<?php comments_template(); ?>
				</section><!-- #portfolio-post-comments -->
				<?php } ?>
					
				<?php
				// Display Related or other Portfolio Items
				if ( wpex_option( 'portfolio_related', '1' ) == '1' &&  wpex_get_post_layout_class() !== 'full-screen' && !post_password_required() ) {
					
					// Create an array of current category ID's
					$wpex_related_cats = wp_get_post_terms( get_the_ID(), 'portfolio_category' ); 
					$wpex_related_cats_ids = array();  
					foreach($wpex_related_cats as $wpex_related_cat) {
						$wpex_related_cats_ids[] = $wpex_related_cat->term_id; 
					}
					
					// Related query arguments
					$args = array(
						'post_type'			=> 'portfolio',
						'posts_per_page'		=> wpex_option( 'portfolio_related_count', '4' ),
						'orderby' 				=> 'rand',
						'post__not_in'			=> array(get_the_ID()),
						'no_found_rows'		=> true,
						'tax_query'			=> array (
							array (
								 'taxonomy'	=> 'portfolio_category',
								 'field' 		=> 'id',
								 'terms' 		=> $wpex_related_cats_ids,
								 'operator'	=> 'IN',
							),
						),
					);
					$wpex_related_query = new wp_query( $args );  
					
					// If posts were found display related items
					if( $wpex_related_query->have_posts() ) { ?>
						<section class="related-portfolio-posts clr">
							<div class="theme-heading"><span><?php echo wpex_option( 'portfolio_related_title', __( 'Related Projects', 'wpex' ) ); ?></span></div>
							<?php
							// Create counter var and set to 0
							$wpex_count=0;
							// Loop through related posts
							foreach( $wpex_related_query->posts as $post ) : setup_postdata( $post );
								// Counter for clearing floats
								$wpex_count++;
								// Get the portfolio entry content
								get_template_part( 'content-portfolio', get_post_format() );
								// Reset loop counter
								if( $wpex_count == wpex_option( 'portfolio_related_count','4' ) ) {
									$wpex_count=0;
								}
							// Related posts loop ends here
							endforeach; ?>
						</section><!-- .related-portfolio-posts -->
					<?php } // End related items
					
					// Reset query post data
					wp_reset_postdata(); ?>	
					
				<?php } // Endif ?>
					
				</div><!-- #content -->
				
			</section><!-- #primary -->
		
			<?php
			// Get main sidebar
			get_sidebar(); ?>
			
			<?php
			// Display next/prev links if enabled
			if ( wpex_option( 'portfolio_next_prev', '1' ) == '1' ) {
				wpex_next_prev();
			} ?>
			
		</div><!-- .container -->
	
	<?php endwhile; ?>

<?php
// Get site footer
get_footer();?>