<?php
/**
 * Used for your staff entries
 *
 * @package WordPress
 * @subpackage Total WordPress Theme
 */

	
// Counter for clearing floats and margins
global $wpex_count;

// Variable for adding correct css grid class to the staff-entry element
$wpex_grid_class = wpex_grid_class( wpex_option('staff_entry_columns','4') ); ?>

<?php if( has_post_thumbnail() ) { ?>
	<article id="#post-<?php the_ID(); ?>" class="staff-entry col <?php echo $wpex_grid_class; ?> col-<?php echo $wpex_count; ?>">
		<div class="staff-entry-media">
			<?php if ( wpex_option( 'staff_links_enable', '1' ) == '1' ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
			<?php } ?>
				<img src="<?php echo wpex_get_featured_image_url(); ?>" alt="<?php the_title(); ?>" />
				<div class="staff-entry-position">
					<span><?php echo get_post_meta( get_the_ID(), 'wpex_staff_position', true ); ?></span>
				</div><!-- .staff-entry-position -->
			<?php if ( wpex_option( 'staff_links_enable', '1' ) == '1' ) echo '</a>'; ?>
			<?php if ( wpex_option( 'staff_links_enable', '1' ) !== '1' && get_post_meta( get_the_ID(), 'wpex_staff_position', true ) !== '' ) { ?>
				<div class="staff-entry-position">
					<span><?php echo get_post_meta( get_the_ID(), 'wpex_staff_position', true ); ?></span>
				</div><!-- .staff-entry-position -->
			<?php } ?>
		</div><!-- .staff-entry-media -->
		<div class="staff-entry-details">
			<h2 class="staff-entry-title">
			<?php if ( wpex_option( 'staff_links_enable', '1' ) == '1' ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
			<?php } else { ?>
				<?php the_title(); ?>
			<?php } ?>
			</h2>
			<div class="staff-entry-excerpt clr">
				<?php wpex_excerpt( '40', false ); ?>
			</div><!-- .staff-entry-excerpt -->
			<?php echo wpex_get_staff_social(); ?>
		</div><!-- .staff-entry-details -->
   </article><!-- .staff-entry -->
<?php } ?>