<?php
/**
 * The Template for displaying all single posts.
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
            <div id="content" class="site-content clr" role="main"> 
				<?php
				// Display post meta info
				wpex_post_meta(); ?>
				<article class="entry clr">
                	<?php if ( !post_password_required() ) { ?>
                    	<?php get_template_part('content', get_post_format() ); ?>
					<?php } ?>
					<?php
					// Loop through the current post
					while ( have_posts() ) : the_post(); ?>
						<?php
						// Displays list of all post in the series if available
						wpex_post_series( get_the_ID() ); ?>
						<?php
						// Get post content for all formats except quote && link
						if ( get_post_format() !== 'quote' && get_post_format() !== 'link' ) {
							the_content();
						} ?>
						<?php
						// Post Tags
						if ( wpex_option('blog_tags','1') =='1' ) : ?>
							<?php the_tags('<div class="post-tags clr">','','</div>'); ?>
						<?php endif; ?>
				</article><!-- .entry -->
				<?php
				// Link pages when using <!--nextpage-->
				wp_link_pages( array( 'before' => '<div class="page-links clr">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				
				<?php
				// Display author bio, related posts and comments if post isn't password protected
				if ( ! post_password_required() ) : ?>
				
					<?php
					// Social sharing links
					if ( wpex_option( 'blog_social_share', '1' ) == '1' ) wpex_social_share(); ?>
				
					<?php
					// Author bio
					if ( wpex_option('blog_bio','1') == '1' && get_the_author_meta( 'description' ) && get_post_meta( get_the_ID(), 'wpex_post_author', true ) !== 'hide' ) {
						get_template_part('author-bio');
					} ?>
					
					<?php
					// Related Posts Query
					if ( wpex_option( 'blog_related', '1' ) == '1' ) {
						
						// Create an array of current category ID's
						$wpex_related_cats = wp_get_post_terms( get_the_ID(), 'category' ); 
						$wpex_related_cats_ids = array();  
    					foreach($wpex_related_cats as $wpex_related_cat) {
							$wpex_related_cats_ids[] = $wpex_related_cat->term_id; 
						}
						
						// Related query arguments
						$args = array(
							'posts_per_page'		=> wpex_option( 'blog_related_count', '3' ),
							'orderby' 				=> 'rand',
							'category__in'			=> $wpex_related_cats_ids,
							'post__not_in'			=> array(get_the_ID()),
							'no_found_rows'		=> true,
							'tax_query'			=> array (
							'relation'	=> 'AND',
								array (
									 'taxonomy'	=> 'post_format',
									 'field' 		=> 'slug',
									 'terms' 		=> array( 'post-format-quote', 'post-format-link' ),
									 'operator'	=> 'NOT IN',
								),
							),
						);
						$wpex_related_query = new wp_query( $args );  
						if( $wpex_related_query->have_posts() ) { ?>
							 <section class="related-posts clr">
								<div class="related-posts-title theme-heading"><span><?php _e( 'Related Posts', 'wpex' ); ?></span></div>
								<?php
								// Loop through related posts
								$wpex_count=0;
								foreach( $wpex_related_query->posts as $post ) : setup_postdata( $post );
								$wpex_count++; ?>
									<article class="clr col span_1_of_3 col-<?php echo $wpex_count; ?>">
										<?php
										// Display related post thumbnail
										if ( has_post_thumbnail() ) { ?>
											<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="related-post-thumb"><img src="<?php echo wpex_get_featured_image_url(); ?>" alt="<?php echo the_title(); ?>" /></a>
										<?php } else { ?>
											<?php
											// Display post video if video post type
											if ( get_post_meta( get_the_ID(), 'wpex_post_oembed', true ) !== '' ) { ?>
												<div class="related-post-video responsive-video-wrap"><?php echo wp_oembed_get( get_post_meta( get_the_ID(), 'wpex_post_oembed', true ) ); ?></div>
											<?php } elseif ( get_post_meta( get_the_ID(), 'wpex_post_self_hosted_shortcode', true ) !== '' ) { ?>
												<div class="related-post-video responsive-video-wrap"><?php echo do_shortcode( get_post_meta( get_the_ID(), 'wpex_post_self_hosted_shortcode', true ) ); ?></div>
											<?php } ?>
										<?php } ?>
										<div class="related-post-content clr">
											<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="related-post-title"><?php the_title(); ?></a>
											<div class="related-post-excerpt clr">
												<?php wpex_excerpt( '15', false ); ?>
											</div><!-- related-post-excerpt -->
										</div><!-- .related-post-content -->
									</article>
								<?php endforeach; ?>
							 </section>
						<?php } ?>
						<?php
						// Reset related posts query
						wp_reset_postdata(); ?>
					<?php } ?>
					<?php
					// Get the post comments & comment_form
					comments_template(); ?>
				<?php
				//end password protection check 
				endif; ?>
				<?php endwhile; ?>
			</div><!-- #content -->
		</section><!-- #primary -->
		
       <?php
	   // Get site sidebar
		get_sidebar(); ?>
		
		<?php
		// Display next/prev links if enabled - see functions/commons.php
		if ( wpex_option( 'blog_next_prev', '1' ) == '1' ) wpex_next_prev(); ?>
		
	</div><!-- .container -->

<?php
// Get site footer
get_footer(); ?>