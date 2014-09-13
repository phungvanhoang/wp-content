<?php
/**
 * Used for your portfolio entries
 * See single-portfolio.php for single post layout
 *
 * @package WordPress
 * @subpackage Total WordPress Theme
 */

	
// Counter for clearing floats and margins
global $wpex_count;

// Variable for adding correct css grid class to the portfolio-entry element
$wpex_grid_class = wpex_grid_class( wpex_option( 'portfolio_entry_columns', '4' ) ); ?>

<article id="#post-<?php the_ID(); ?>" class="portfolio-entry col <?php echo $wpex_grid_class; ?> col-<?php echo $wpex_count; ?>">
	<?php
	// Media wrap if post has thumbnail
	if( has_post_thumbnail() ) { ?>
		<div class="portfolio-entry-media">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
				<img src="<?php echo wpex_get_featured_image_url(); ?>" alt="<?php the_title(); ?>" class="portfolio-entry-img" />
				<span class="portfolio-entry-overlay"></span>
			</a>
		</div><!-- .portfolio-entry-media -->
	<?php } // End if ?>
	<?php
	// Display portfolio details if enabled
	if ( wpex_option('portfolio_entry_details', '1' ) == '1' ) { ?>
		<div class="portfolio-entry-details clr">
			<h2 class="portfolio-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
			<div class="portfolio-entry-excerpt clr"><?php wpex_excerpt( wpex_option( 'portfolio_entry_excerpt_length', '20'), false ); ?></div>
		</div><!-- .portfolio-entry-details -->
	<?php } // End if ?>
</article><!-- .portfolio-entry -->