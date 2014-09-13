<?php
/**
 * This file contains the styling for Testimonial entries  
 *
 * @package WordPress
 * @subpackage Total WordPress Theme
 */
?>

<?php
global $wpex_count;
$wpex_testimonial_author = get_post_meta( get_the_ID(), 'wpex_testimonial_author', true );
$wpex_testimonial_company = get_post_meta( get_the_ID(), 'wpex_testimonial_company', true );
$wpex_testimonial_url = get_post_meta( get_the_ID(), 'wpex_testimonial_url', true );
$wpex_grid_class = wpex_grid_class( wpex_option( 'testimonials_entry_columns', '4' ) ); ?>

<article id="#post-<?php the_ID(); ?>" class="testimonial-entry col <?php echo $wpex_grid_class; ?> col-<?php echo $wpex_count; ?>">

	<div class="testimonial-entry-content clr">
		<span class="testimonial-caret"></span>
		<?php the_content(); ?>
	</div><!-- .home-testimonial-entry-content-->
	<div class="testimonial-entry-bottom">
		<div class="testimonial-entry-thumb">
			<img src="<?php echo wpex_get_featured_image_url(); ?>" alt="<?php echo the_title(); ?>" />
		</div><!-- /testimonial-thumb -->
		<div class="testimonial-entry-meta">
			<?php if ( $wpex_testimonial_author ) { ?>
				<span class="testimonial-entry-author"><?php echo $wpex_testimonial_author; ?></span>
			<?php } ?>
			<?php if ( $wpex_testimonial_company ) { ?>
				<?php if ( $wpex_testimonial_url ) { ?>
					<a href="<?php echo $wpex_testimonial_url; ?>" class="testimonial-entry-company" title="<?php echo $wpex_testimonial_company; ?>" target="_blank"><?php echo $wpex_testimonial_company; ?></a>
				<?php } else { ?>
					<span class="testimonial-entry-company"><?php echo $wpex_testimonial_company; ?></span>
				<?php } ?>
			<?php } ?>
		</div><!-- .testimonial-entry-meta -->
	</div><!-- .home-testimonial-entry-bottom -->
</article><!-- .testimonial-entry -->