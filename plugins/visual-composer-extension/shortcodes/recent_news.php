<?php
// Register Shortcode -------------------------------------------------------------------------- >
if( !function_exists( 'vcex_news_shortcode' ) ) {

	function vcex_news_shortcode($atts) {
		
		// Define shortcode params
		extract( shortcode_atts( array(
				'unique_id'		=> '',
				'term_slug'		=> 'all',
				'count'				=> '12',
				'columns'			=> '3',
				'order'				=> 'DESC',
				'orderby'			=> 'date',
				'header'			=> '',
				'heading'			=> 'h3',
				'date'				=> 'true',
				'excerpt_length'	=> '15',
				'read_more'		=> 'false',
				'read_more_text'	=> __( 'read more', 'vcex' ),
				'filter_content'	=> 'false',
				'offset'			=> 0,
				'taxonomy'			=> '',
				'terms'				=>'',
				'css_animation'	=> '',
			), $atts));
		
		// Start Tax Query
		$tax_query = '';
		if( $term_slug !== 'all' ) {
			$tax_query = array(
				'taxonomy'	=> 'category',
				'field'		=> 'slug',
				'terms'		=> $term_slug,
			);
		}
		
		// The Query
		$vcex_news_query = new WP_Query(
			array(
				'post_type'		=> 'post',
				'posts_per_page'	=> $count,
				'offset'			=> $offset,
				'order'				=> $order,
				'orderby'			=> $orderby,
				'filter_content'	=> $filter_content,
				'no_found_rows'	=> true,
				'tax_query' => array(
					'relation' => 'AND',
					$tax_query,
					 array(
						 'taxonomy' => 'post_format',
						 'field' => 'slug',
						 'terms' => array( 'post-format-quote','post-format-link' ),
						 'operator' => 'NOT IN',
					 ),
			 	)
			)
		);

		$output = '';

		//Output posts
		if( $vcex_news_query->posts ) :
		
			$unique_id = $unique_id ? ' id="'. $unique_id .'"' : NULL;
			
			$css_animation_classes = '';
			if ( $css_animation !== '' ) {
				$css_animation_classes = 'wpb_animate_when_almost_visible wpb_'. $css_animation .'';
			}
		
			// Main wrapper div
			$output .= '<div class="vcex-recent-news '. $css_animation_classes .'"'. $unique_id .'>';
			
			// Header
			if ( $header !== '' ) {
				$output .= '<h2 class="vcex-recent-news-header">'. $header .'</h2>';
			}
		
			// Loop through posts
			foreach ( $vcex_news_query->posts as $post ) :
			
				// Post VARS
				$postid = $post->ID;
				$url = get_permalink($postid);
				$post_title = get_the_title($postid);
				$post_excerpt = $post->post_excerpt;
				$post_content = $post->post_content;
	
				// News article start
				$output .= '<article id="post-'. $postid .'" class="vcex-recent-news-entry">';
				
					// Date
					if ( $date ) {
						$output .= '<div class="vcex-recent-news-date"><span class="day">'. get_the_time('d', $postid) .'</span><span class="month">'. get_the_time('M', $postid) .'</span></div>';
					}
				
					// Open recent news entry
					$output .='<div class="vcex-news-entry-details vcex-clearfix">';

						// Title
						$output .= '<header class="vcex-recent-news-entry-title">';
							$output .= '<'. $heading .' class="vcex-recent-news-entry-title-heading"><a href="'. $url .'" title="'. $post_title .'">'. $post_title .'</a></'. $heading .'>';
						$output .= '</header><!-- .vcex-recent-news-entry-title -->';
						
						// Excerpt
						$output .='<div class="vcex-recent-news-entry-excerpt vcex-clearfix">';
							if ( !empty($post_excerpt) ) {
								$output .= $post_excerpt .'...';
							} else {
								$output .= wp_trim_words( $post_content, $excerpt_length );
							}
							if( $read_more == 'true' && empty($post_excerpt) ) { 
								$output .= '<a href="'. $url .'" title="'. $post_title .'" class="vcex-recent-news-entry-readmore">'. $read_more_text .' &rarr;</a>';
							}
						$output .=' </div><!-- .vcex-recent-news-entry-excerpt -->';
					
					// Close details div
					$output .='</div><!-- .vcex-recent-news-entry-details -->';
					
				// Close main wrap	
				$output .= '</article><!-- .vcex-recent-news-entry -->';

			// End foreach loop
			endforeach;
			
			// Close main wrap
			$output .= '</div><!-- .vcex-recent-news --><div class="vcex-clear-floats"></div>';
		
		endif; // End has posts check
				
		// Set things back to normal
		wp_reset_postdata();

		// Return data
		return $output; 
		
	}
}
add_shortcode("vcex_recent_news", "vcex_news_shortcode");


// Add to visual composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Recent News", 'vcex' ),
	"base"					=> "vcex_recent_news",
	"class"					=> "",
	"category"				=> __( "Blog", "wpex" ),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-recent_news",
	"params"				=> array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Unique Id", 'vcex' ),
			"param_name"	=> "unique_id",
			"value"			=> "",
			"description"	=> __( "You can enter a unique ID here for styling purposes.", 'vcex' ),
		),
		array(
		  "type"			=> "dropdown",
		  "heading"		=> __("CSS Animation", "wpex"),
		  "param_name"		=> "css_animation",
		  "value"			=> array(
		  		__("No", "wpex")					=> '',
				__("Top to bottom", "wpex")		=> "top-to-bottom",
				__("Bottom to top", "wpex")		=> "bottom-to-top",
				__("Left to right", "wpex")		=> "left-to-right",
				__("Right to left", "wpex")		=> "right-to-left",
				__("Appear from center", "wpex")	=> "appear"),
		  "description"	=> __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "wpex")
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Header", 'vcex' ),
			"param_name"	=> "header",
			"value"			=> "",
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Category", 'vcex' ),
			"param_name"	=> "term_slug",
			"admin_label"	=> true,
			"value"			=> "all"
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Post Count", 'vcex' ),
			"param_name"	=> "count",
			"value"			=> "3",
			"description"	=> __( "How many items do you wish to show.", 'vcex' ),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Order", 'vcex' ),
			"param_name"	=> "order",
			"description"	=> sprintf( __( 'Designates the ascending or descending order. More at %s.', 'vcex' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
			"value"			=> array(
				 __( "DESC", "wpex")		=> "DESC",
				 __( "ASC", "wpex" )	=> "ASC",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Order By", 'vcex' ),
			"param_name"	=> "orderby",
			"description"	=> sprintf( __( 'Select how to sort retrieved posts. More at %s.', 'vcex' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
			"value"			=> array(
				 __( "Date", "wpex")				=> "date",
				 __( "Name", "wpex" )				=> "name",
				 __( "Modified", "wpex")			=> "modified",
				 __( "Author", "wpex" )			=> "author",
				 __( "Random", "wpex")				=> "rand",
				 __( "Comment Count", "wpex" )	=> "comment_count",
			),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Excerpt Length", 'vcex' ),
			"param_name"	=> "excerpt_length",
			"value"			=> "30",
			"description"	=> __( "How many words do you want to display for your excerpt?", 'vcex' ),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Read More Link?", 'vcex' ),
			"param_name"	=> "read_more",
			"value"			=> array(
				 __( "True", "wpex")		=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),	
	)
) );
?>