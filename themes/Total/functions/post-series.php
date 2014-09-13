<?php
/**
 * Outputs a list of posts that belong to the same "series"
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */


if ( !function_exists('wpex_post_series') ) {
	function wpex_post_series($postid=NULL) {
		
		// Return nothing if the post series taxonomy is disabled
		if ( wpex_option( 'post_series', '1' ) !== '1' ) return false;

		// Get the post data
		global $post;
		
		// Get post terms
		$terms = wp_get_post_terms( $postid, 'post_series' );	
		
		if($terms) {
		
		 ob_start(); ?>
		 
			<section id="post-series" class="clr">
				<?php
				foreach($terms as $term) { ?>
				<div id="post-series-title">Post Series: <?php echo $term->name; ?></div>
				<ul>
					<?php
					// Get all posts in series
					$post_series = get_posts(array(
						'order' => 'DESC',
						'post_type' =>'post',
						'numberposts' => -1,
						'tax_query' =>array(
							array(
								'taxonomy' => 'post_series',
								'field' => 'id',
								'terms' => $term->term_id
								)
							)
					) );
					$count=0;
					foreach($post_series as $post) : setup_postdata($post);
					$count++;
					$current_post_id = $post->ID;
					if( $current_post_id == $postid ) { ?>
						<li class="post-series-current"><span class="post-series-count"><?php echo $count; ?>.</span><span class="post-series-current-inner"><?php the_title(); ?></span></li>
					<?php } else { ?>
						<li><span class="post-series-count"><?php echo $count; ?>.</span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li> 
					<?php } endforeach; ?>
				</ul>
			</section>
			
			<?php } ?>
		<?php } wp_reset_postdata();
		
		echo ob_get_clean();
		
	}
}