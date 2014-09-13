<?php
/**
 * The template for displaying image attachments.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */

get_header(); ?>
    
    <header class="page-header">
    	<div class="container clr">
			<h1 class="page-header-title"><?php the_title(); ?></h1>
            <?php while ( have_posts() ) : the_post(); ?>
            <?php if ( !empty( $post->post_excerpt ) ) : ?>
                <div id="page-header-description" class="clr">
                    <?php the_excerpt(); ?>
                </div><!-- #page-header-description -->
			<?php endif; ?>
            <?php endwhile; ?>
			<?php wpex_display_breadcrumbs(); // see functions/breadcrumbs.php ?>
        </div>
	</header>
    
    <div class="container clr">
        <section id="primary" class="content-area full-width">
            <div id="content" class="site-content" role="main">
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
                    <a href="<?php echo wp_get_attachment_url( get_the_ID(), 'full' ); ?>" class="wpex-lightbox"><?php $img = wp_get_attachment_image( get_the_ID(), 'full' ); echo preg_replace( '#(width|height)="\d+"#','',$img ); ?></a>
                    <?php the_content(); ?>
                </article><!-- #post -->
            </div><!-- #content -->    
        </section><!-- #primary -->
    </div><!-- .container -->
    
<?php get_footer(); ?>