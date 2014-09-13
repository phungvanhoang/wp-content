<?php
// Register Shortcode -------------------------------------------------------------------------- >
if( !function_exists( 'vcex_portfolio_carousel_shortcode' ) ) {

	function vcex_portfolio_carousel_shortcode($atts) {
		
		// Define shortcode params
		extract( shortcode_atts( array(
				'unique_id'		=> '',
				'style'				=> 'default',
				'term_slug'		=> 'all',
				'count'				=> '8',
				'item_width'		=> '230',
				'min_slides'		=> '1',
				'max_slides'		=> '4',
				'items_scroll'		=> 'page',
				'animation'		=> 'CSS',
				'auto_play'		=> 'false',
				'timeout_duration'	=> '5000',
				'arrows'			=> 'true',
				'order'				=> 'DESC',
				'orderby'			=> 'date',
				'thumbnail_link'	=> 'post',
				'img_crop'			=> 'true',
				'img_width'		=> '9999',
				'img_height'		=> '9999',
				'title'				=> 'true',
				'excerpt'			=> 'true',
				'excerpt_length'	=> '30',
				'filter_content'	=> 'false',
				'offset'			=> 0,
				'taxonomy'			=> '',
				'terms'				=>'',
				'img_hover_style'	=> '',
				'img_overlay_disable' => '',
			), $atts ) );
			
		$output = '';
		
		// Required Scripts
		wp_enqueue_script( 'vcex-caroufredsel' );
		
		// Give caroufredsel a unique name
		$rand_num = rand(1, 100);
		$unique_carousel_id = 'caroufredsel-'. $rand_num;
		
		// Output filter JS into the footer like a WP Jedi Master
		$output .='
			<script type="text/javascript">
				jQuery(function($){
					$(document).ready(function(){
						$("#'. $unique_carousel_id .'").carouFredSel({
							responsive : true,
							height: "variable",
							width : "100%",
							auto : {
								play: '. $auto_play .',
								timeoutDuration : '. $timeout_duration .',
							},
							swipe : {
								onTouch: true,
								onMouse: true,
							},';
							if ( $items_scroll !== 'page' ) {
								$output .= 'scroll : {
									items : '. $items_scroll .',
								},';
							}
							if ( $arrows == 'true' ) {
								$output .= 'prev : "#prev-'. $rand_num .'",';
    							$output .= 'next : "#next-'. $rand_num .'",';
							}
							$output .='items : {
								width : '. intval($item_width) .',
								height: "variable",
								visible : {
									min : '. intval($min_slides) .',
									max : '. intval($max_slides) .'
								}
							}
						});
					});
					$(window).load(function(){
						$(".vcex-caroufredsel-loading").removeClass("vcex-caroufredsel-loading");
						$(".vcex-caroufredsel").animate({ opacity: 1 });
					});
				});
			</script>';
		
		// Start Tax Query
		if( $term_slug !== 'all' ) {
			$tax_query = array(
				array (
					'taxonomy'	=> 'portfolio_category',
					'field'		=> 'slug',
					'terms'		=> $term_slug,
				)
			);
		} else {
			$tax_query = NULL;
		}
		
		// The Query
		$vcex_carousel_query = new WP_Query(
			array(
				'post_type' 		=> 'portfolio',
				'posts_per_page'	=> $count,
				'offset'			=> $offset,
				'order'				=> $order,
				'orderby'			=> $orderby,
				'filter_content'	=> $filter_content,
				'no_found_rows'	=> true,
				'tax_query'		=> $tax_query,
				'meta_query' 		=> array( array( 'key' => '_thumbnail_id' ) ) // only show items with thumbnails
			)
		);

		//Output posts
		if( $vcex_carousel_query->posts ) :
		
			$unique_id = $unique_id ? ' id="'. $unique_id .'"' : NULL;
		
			// Main wrapper div	
			$output .= '<div class="vcex-caroufredsel-wrap clr vcex-caroufredsel-portfolio vcex-caroufredsel-'. $style .' vcex-caroufredsel-loading"'. $unique_id  .'>';

				$output .= '<div class="vcex-caroufredsel"><ul id="'. $unique_carousel_id .'">';
			
				// Loop through posts
				foreach ( $vcex_carousel_query->posts as $post ) :
				
					// Post VARS
					$postid = $post->ID;
					$featured_img_url	= wp_get_attachment_url( get_post_thumbnail_id( $postid ) );
					$featured_img = wp_get_attachment_url( get_post_thumbnail_id( $postid ) );
					$url = get_permalink( $postid );
					$post_title = get_the_title( $postid );
					$the_content = $post->post_content;
					$the_content_stripped = strip_shortcodes($the_content);
					
					// Load scripts
					if ( $thumbnail_link == 'lightbox' ) {
						wp_enqueue_script( 'vcex-magnific-popup' );
						wp_enqueue_script( 'vcex-lightbox' );
					}
					
					// Crop featured images if necessary
					if( $img_crop == 'true' ) {
						$thumbnail_hard_crop = $img_height == '9999' ? false : true;
						$img_width = intval($img_width);
						$img_height = intval($img_height);
						$featured_img = aq_resize( $featured_img_url, $img_width, $img_height, $thumbnail_hard_crop );
					}
		
					// Carousel item start
					$output .= '<li class="vcex-caroufredsel-slide">';
					
						// Image hover styles
						$img_hover_style_class = $img_hover_style ? 'vcex-img-hover-parent vcex-img-hover-'. $img_hover_style : '';
					
						// Media Wrap
						if( has_post_thumbnail($postid) ) {
							$output .= '<div class="vcex-caroufredsel-entry-media '. $img_hover_style_class .'">';
							
								if ( $thumbnail_link == 'none' ) {
									$output .= '<img src="'. $featured_img .'" alt="'. $post_title .'" />';
								} elseif ( $thumbnail_link == 'lightbox' ) {
									$output .= '<a href="'. $featured_img_url .'" title="'. $post_title .'" class="vcex-caroufredsel-entry-img vcex-lightbox">';
										$output .= '<img src="'. $featured_img .'" alt="'. $post_title .'" />';
										if ( $img_overlay_disable !== 'yes' ) {
											$output .= '<span class="portfolio-entry-overlay"></span>';
										}
									$output .= '</a><!-- .vcex-caroufredsel-entry-img -->';
								} else {
									$output .= '<a href="'. $url .'" title="'. $post_title .'" class="vcex-caroufredsel-entry-img">';
										$output .= '<img src="'. $featured_img .'" alt="'. $post_title .'" />';
										$output .= '<span class="portfolio-entry-overlay"></span>';
									$output .= '</a><!-- .vcex-caroufredsel-entry-img -->';
								}
								
								$output .= '</div>';
						}
						
						if ( $title == 'true' ||  $excerpt == 'true' ) {
							
							$output .= '<div class="vcex-caroufredsel-entry-details">';
								
							if ( $title == 'true' && $post_title ) {
								$centered_title = $excerpt == 'true' ? '' : 'textcenter';
								$output .= '<div class="vcex-caroufredsel-entry-title '. $centered_title .'"><a href="'. $url .'" title="'. $post_title .'">'. $post_title .'</a></div>';
							}
							
							if ( $excerpt == 'true' && !empty($the_content) ) {
								if ( has_excerpt( $postid ) ) {
									$the_excerpt = $post->post_excerpt;
									$output .= '<div class="vcex-caroufredsel-entry-excerpt">'. $the_excerpt .'</div>';
								} else {
									$output .= '<div class="vcex-caroufredsel-entry-excerpt">'. wp_trim_words( $the_content_stripped, $excerpt_length ) .'</div>';
								}
							}
						
							$output .= '</div>';
						
						}
						
					// Close main wrap	
					$output .= '</li>';
				
				// End foreach loop
				endforeach;
				
				// End UL
				$output .= '</ul>';
				
				// Next/Prev arrows	
				if ( $arrows == 'true' ) {
					$output .= '<div id="prev-'. $rand_num .'" class="vcex-caroufredsel-prev theme-button"><span class="fa fa-chevron-left"></span></div><div id="next-'. $rand_num .'" class="vcex-caroufredsel-next theme-button"><span class="fa fa-chevron-right"></span></div>';
				}
			
			// Close main wrap
			$output .= '</div></div><div class="vcex-clear-floats"></div>';
		
		endif; // End has posts check
		
		
		// Set things back to normal
		$vcex_carousel_query = NULL;
		wp_reset_postdata();

		// Return data
		return $output; 
		
	}
}
add_shortcode("vcex_portfolio_carousel", "vcex_portfolio_carousel_shortcode");




// Add to Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Portfolio Posts Carousel", 'vcex' ),
	"base"					=> "vcex_portfolio_carousel",
	"class"					=> "vcex_portfolio_carousel",
	"category"				=> array(__("Portfolio","wpex"),__("Sliders","wpex")),
	"icon" 					=> "icon-wpb-vcex-portfolio_carousel",
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
			"class"			=> "",
			"heading"		=> __( "Style", 'vcex' ),
			"param_name"	=> "style",
			"value"			=> array(
				 __( "Default", "wpex")		=> "default",
				 __( "No Margins", "wpex" )	=> "no-margins",
			),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Category", 'vcex' ),
			"param_name"	=> "term_slug",
			"admin_label"	=> true,
			"value"			=> "all",
			"description"	=> __( "Enter a category slug to limit your posts.", 'vcex' ),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Post Count", 'vcex' ),
			"param_name"	=> "count",
			"value"			=> "8",
			"description"	=> __( "How many items do you wish to show.", 'vcex' ),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Order", 'vcex' ),
			"param_name"	=> "order",
			"description"	=> sprintf( __( 'Designates the ascending or descending order. More at %s.', 'vcex' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
			"value"			=> array(
				 __( "DESC", "wpex")	=> "DESC",
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
			"heading"		=> __( "Slide Width", 'vcex' ),
			"param_name"	=> "item_width",
			"value"			=> "230",
			"description"	=> __('The width of each slide in pixels.','vcex')
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Min Slides", 'vcex' ),
			"param_name"	=> "min_slides",
			"value"			=> "1",
			"description"	=> __('The minimum number of slides to be shown.','vcex'),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Max Slides", 'vcex' ),
			"param_name"	=> "max_slides",
			"value"			=> "4",
			"description"	=> __('The maximum number of slides to be shown.','vcex'),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Items To Scroll", 'vcex' ),
			"param_name"	=> "items_scroll",
			"value"			=> "page",
			"description"	=> __('The number of items to scroll at a time. Enter "page" to scroll to the first item of the previous/next "page".','vcex'),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Auto Play", 'vcex' ),
			"param_name"	=> "auto_play",
			"value"			=> array(
				 __( "True", "wpex" )	=> "true",
				 __( "False", "wpex")	=> "false",
			),
			"description"	=> __('Determines whether the carousel should scroll automatically or not.','vcex'),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __('Timeout Duration (in milliseconds)', 'vcex'),
			"param_name"	=> "timeout_duration",
			"value"			=> "5000",
			"dependency" => Array('element'	=> "auto_play", 'value' => "true" ),
			"description"	=> __('The amount of milliseconds the carousel will pause.','vcex'),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Display Arrows?", 'vcex' ),
			"param_name"	=> "arrows",
			"value"			=> array(
				 __( "True", "wpex" )	=> "true",
				 __( "False", "wpex")	=> "false",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Image Links To", 'vcex' ),
			"param_name"	=> "thumbnail_link",
			"value"			=> array(
				 __( "Post", "wpex")		=> "post",
				 __( "Lightbox", "wpex" )	=> "lightbox",
				 __( "None", "wpex" )		=> "none",
			),
		),
		array(
			"type"			=> "checkbox",
			"class"			=> "",
			"heading"		=> __( "Disable Image Overlay?", 'vcex' ),
			"param_name"	=> "img_overlay_disable",
			"value"			=> Array(__("Yes please.", "wpex") => 'yes'),
			"description"	=> __("Check this box to hide the default overlay when a user hovers over the featured image.", "wpex"),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "CSS3 Image Hover", 'vcex' ),
			"param_name"	=> "img_hover_style",
			"value"			=> vcex_image_hovers(),
			"description"	=> __("Select your preferred image hover effect. Please note this will only work if the image links to a URL or a large version of itself. Please note these effects may not work in all browsers.", "wpex"),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Image Width", 'vcex' ),
			"param_name"	=> "img_width",
			"value"			=> "500",
			"description"	=> __( "Enter a width in pixels.", 'vcex' ),
			"dependency" => Array('element'	=> "img_crop", 'value' => "true" ),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Image Height", 'vcex' ),
			"param_name"	=> "img_height",
			"value"			=> "350",
			"description"	=> __( 'Enter a height in pixels. Set to "9999" to disable vertical cropping and keep image proportions.', 'vcex' ),
			"dependency" => Array('element'	=> "img_crop", 'value' => "true" ),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Display Title", 'vcex' ),
			"param_name"	=> "title",
			"value"			=> array(
				 __( "True", "wpex")	=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Display Excerpt", 'vcex' ),
			"param_name"	=> "excerpt",
			"value"			=> array(
				 __( "True", "wpex")	=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Excerpt Length", 'vcex' ),
			"param_name"	=> "excerpt_length",
			"value"			=> "30",
			"dependency" => Array('element'	=> "excerpt", 'value' => "true" ),
		),
	)
) );
?>