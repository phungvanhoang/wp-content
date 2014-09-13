<?php
/**
 * Used for your standard post entry content and single post media
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
 
 

/******************************************************
 * Single Posts
 * @since 1.0
*****************************************************/

if ( is_singular('post') ) { ?>
	
	<?php if( wpex_option('blog_single_thumbnail','1') == '1' && has_post_thumbnail() ) { ?>
    	<div id="post-media" class="clr">
			<img src="<?php echo wpex_get_featured_image_url(); ?>" alt="<?php echo the_title(); ?>" />
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

	<article id="post-<?php the_ID(); ?>" <?php post_class(); // required* ?>>
		<?php
		// Display the post thumbnail if one is set and the post is not password protected
		if ( has_post_thumbnail() && ! post_password_required() ) { ?>
			<div class="blog-entry-media">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="blog-entry-media-link"><img src="<?php echo wpex_get_featured_image_url(); ?>" alt="<?php echo the_title(); ?>" /></a>
            </div><!-- .blog-entry-media -->
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
				// Display excerpt if auto excerpts are enavled in the admin
				if ( wpex_option( 'blog_exceprt', '1' ) == '1' ) {
					// Get excerpt length & output excerpt
					// See functions/excerpts.php
					$wpex_excerpt_length = wpex_excerpt_length();
					wpex_excerpt( $wpex_excerpt_length );
				} else {
				// Display full content
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