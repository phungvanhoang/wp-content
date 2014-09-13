<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */

get_header(); ?>
	
	<?php
	// Display the page header - see functions/page-header.php
	wpex_page_header(); ?>
	
    <div class="container clr">
        <section id="primary" class="content-area full-width clr">
            <div id="content" class="clr site-content" role="main">
 				<div class="entry error404-content clr">
					<h1 class="error404-title"><?php _e( 'Sorry, the page you were looking for can not be found!', 'wpex' ) ?></h1>
					<h2 class="error404-message"><?php _e( 'Contact one of our Treatment Consultants today for assistance at 800.447.9081.', 'wpex' ); ?></h2>
				</div><!-- .entry -->
            </div><!-- #content -->
        </section><!-- #primary -->
    </div><!-- .container -->
<?php get_footer(); ?>