<?php
/**
 * Used for your standard post entry content and single post media
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
 
 
// Get post image attachments
$attachments = wpex_get_gallery_ids();


/******************************************************
 * Single Posts
 * @since 1.0
*****************************************************/

if ( is_singular( 'post' ) ) { ?>

	<?php	
	// Display slider if there are images saved in the DB
	if ( !empty($attachments) ) { ?>
		
		<div id="post-media" class="clr">
            <div class="gallery-format-post-slider-wrap clr">
                <div class="gallery-format-post-slider flexslider-container">
                    <div class="flexslider">
                        <ul class="slides">
                         <?php
							// Loop through each attachment ID
							foreach ( $attachments as $attachment ) :
								// Get image alt tag
								$attachment_alt = strip_tags( get_post_meta( $attachment, '_wp_attachment_image_alt', true ) ); ?>
                        		<li class="slide" data-thumb="<?php echo aq_resize( wp_get_attachment_url( $attachment ), 100, 100, true ); ?>">
									<?php
									// Display image with lightbox
									if ( wpex_gallery_is_lightbox_enabled() == 'on' ) { ?>
								   <a href="<?php echo wp_get_attachment_url( $attachment ); ?>" title="<?php echo get_post_field('post_excerpt', $attachment ); ?>" class="wpex-lightbox"><img src="<?php echo wpex_get_featured_image_url( get_the_id(), $attachment ); ?>" alt="<?php echo $attachment_alt; ?>" /></a>
								   <?php } else {
									   // Lightbox is disabled, only show image ?>
									  <img src="<?php echo wpex_get_featured_image_url( get_the_id(), $attachment ); ?>" alt="<?php echo $attachment_alt; ?>" />
								   <?php } ?>
                                </li>
                            <?php endforeach; ?>
                        </ul><!-- .slides -->
                    </div><!-- .flexslider -->
                </div><!-- .flexslider-container -->
            </div><!-- .gallery-format-post-slider-wrap -->
		</div><!-- #post-media -->
	<?php } ?>

<?php
}
/******************************************************
 * Entries
 * @since 1.0
*****************************************************/
else {
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( !post_password_required() ) { ?>
			<?php
			// Display slider if there are images saved in the DB
			if ( $attachments ) { ?>
				<div class="gallery-format-post-slider-wrap blog-entry-media clr">
					<div class="gallery-format-post-slider flexslider-container">
							<div class="flexslider">
								<ul class="slides">
									<?php
									// Loop through each attachment ID
									foreach ( $attachments as $attachment ) :
									// Get image alt tag
									$attachment_alt = strip_tags( get_post_meta( $attachment, '_wp_attachment_image_alt', true ) ); ?>
										<li class="slide" data-thumb="<?php echo aq_resize( wp_get_attachment_url( $attachment ),  '100', '100', true ); ?>">
											<?php
											// Display image with lightbox
											if ( wpex_gallery_is_lightbox_enabled() == 'on' ) { ?>
												<a href="<?php echo wp_get_attachment_url( $attachment ); ?>" title="<?php echo $attachment_alt; ?>" class="wpex-lightbox"><img src="<?php echo wpex_get_featured_image_url( get_the_id(), $attachment ); ?>" alt="<?php echo $attachment_alt; ?>" /></a>
											<?php } else {
												// Lightbox is disabled, only show image ?>
												<img src="<?php echo wpex_get_featured_image_url( get_the_id(), $attachment ); ?>" alt="<?php echo $attachment_alt; ?>" />
											<?php } ?>
										</li>
									<?php endforeach; ?>
								</ul><!-- .slides --> 
							</div><!-- .flexslider --> 
					</div><!-- .flexslider-container --> 
				</div><!-- .gallery-format-post-slider-wrap -->
			<?php } ?>
		<?php } ?>
        <div class="blog-entry-content clr">
            <header class="clr <?php if ( wpex_post_entry_author_avatar_enabled() ) { echo 'header-with-avatar'; } ?>">
				<h2 class="blog-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php
				// Displays the post entry author avatar - see functions/post-entry-author-avatar.php
				wpex_post_entry_author_avatar();
				
				// Display post meta - see functions/post-meta.php
				wpex_post_meta(); ?>
            </header>
            <div class="blog-entry-excerpt entry">
               <?php
				// Display excerpt
				if ( wpex_option('blog_exceprt','1') == '1' ) {
					// Get excerpt length & output excerpt
					// See functions/excerpts.php
					$wpex_excerpt_length = wpex_excerpt_length();
					wpex_excerpt( $wpex_excerpt_length );
				} else {
					the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpex' ) );
				} ?>
            </div><!-- .entry-excerpt -->
			<?php
			// Read more link - see functions/post-readmore-link.php
			wpex_post_readmore_link();
			
			// Social sharing links
			wpex_social_share(); ?>
        </div><!-- .blog-entry-content -->
    </article><!-- .blog-entry-entry -->

<?php } ?>