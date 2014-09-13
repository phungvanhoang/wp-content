<?php
/**
 * This file is used for your search result entries
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
 
 
// Add classes to the post_class
$search_entry_classes = array();
$search_entry_classes[] = 'search-entry';
$search_entry_classes[] = 'clr';
if( !has_post_thumbnail () ) {
	$search_entry_classes[] = 'search-entry-no-thumb';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $search_entry_classes ); ?>> 
	<?php
	// Display thumbnail if one is set
	if( has_post_thumbnail() ) {  ?>
		<div class="search-entry-thumb">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" class="search-entry-img-link">
				<img src="<?php echo wpex_get_featured_image_url(); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
			</a>
		</div><!-- .search-entry-thumb -->
    <?php } ?>  
    <div class="search-entry-text">
        <header>
            <h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
       </header>
        <?php
		// Custom excerpt function - see functions/excerpts.php
		wpex_excerpt( '30', true ); ?>
    </div><!-- .search-entry-text -->
</article><!-- .entry -->