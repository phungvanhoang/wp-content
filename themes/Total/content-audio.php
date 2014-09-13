<?php
/**
 * Used for your audio post entry content and single post media
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */

 
// VARS
$wpex_post_oembed = get_post_meta( get_the_ID(), 'wpex_post_oembed', true );
$wpex_post_self_hosted = get_post_meta( get_the_ID(), 'wpex_post_self_hosted_shortcode', true ); 
 

/******************************************************
 * Single Posts
 * @since 1.0
*****************************************************/

if ( is_singular('post') ) { ?>
	
    <div id="post-media" class="clr">
		<?php if( wpex_option('blog_single_thumbnail','1') == '1' && has_post_thumbnail() ) { ?>
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="blog-entry-img-link"><img src="<?php echo wpex_get_featured_image_url(); ?>" alt="<?php echo the_title(); ?>" /></a>
        <?php } ?>
        <?php if ( $wpex_post_oembed !== '' ) { ?>
            <div class="blog-post-audio clr wpex-fitvids"><?php echo wp_oembed_get( $wpex_post_oembed ); ?></div>
        <?php } elseif ( $wpex_post_self_hosted !== '' ) { ?>
            <div class="blog-post-audio clr"><?php echo apply_filters( 'the_content', $wpex_post_self_hosted ); ?></div>
        <?php } ?>
	</div><!-- #post-media -->

<?php
}
/******************************************************
 * Entries
 * @since 1.0
*****************************************************/
else { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if ( !post_password_required() ) { ?>
            <div class="blog-entry-media">
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="blog-entry-img-link">
						<img src="<?php echo wpex_get_featured_image_url(); ?>" alt="<?php echo the_title(); ?>" />
						<div class="blog-entry-music-icon-overlay"><span class="fa fa-music"></span></div>
					</a>
                <?php } ?>
            </div><!-- .blog-entry-media -->
        <?php } ?>
        <div class="blog-entry-content clr">
            <header class="clr <?php if ( wpex_post_entry_author_avatar_enabled() ) { echo 'header-with-avatar'; } ?>">
				<h2 class="blog-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="blog-entry-media-link"><?php the_title(); ?></a></h2>
				<?php
				// Displays the post entry author avatar - see functions/post-entry-author-avatar.php
				wpex_post_entry_author_avatar();
				
				// Display post meta - see functions/post-meta.php
				wpex_post_meta(); ?>
			</header>
			<div class="blog-entry-excerpt entry">
				<?php
				// Display excerpt
				if ( wpex_option( 'blog_exceprt', '1' ) == '1' ) {
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