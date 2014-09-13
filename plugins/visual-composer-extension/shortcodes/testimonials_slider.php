<?php
// Register Shortcode -------------------------------------------------------------------------- >
if( !function_exists('vcex_testimonials_slider_shortcode') ) {
	function vcex_testimonials_slider_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'count'				=> '3',
			'term_slug'		=> '',
			'category'			=> 'all',
			'order'				=> 'DESC',
			'orderby'			=> 'date',
			'skin'				=> 'light',
			'background'		=> '',
			'background_image'	=> '',
			'background_style'	=> 'stretch',
			'css_animation'	=> '',
			'filter_content'	=> 'false',
			'offset'			=> 0,
			'unique_id'		=> '',
			'slideshow'		=> 'true',
			'slideshow_speed'	=> '7000',
			'animation_speed'	=> '600',
			'display_author_name'		=> 'false',
			'display_author_avatar'	=> 'false',
		), $atts ) );
		
		// Animation
		$css_animation_classes = '';
		if ( $css_animation !== '' ) {
			$css_animation_classes = 'wpb_animate_when_almost_visible wpb_'. $css_animation .'';
		}
		
		// Background image
		$background_image_style = '';
		if ( $background_image !== '' ) {
			$img_url = wp_get_attachment_url($background_image);
			$background_image_style = 'background-image: url('. $img_url .');';
		}
		
		if ( $background_style == 'parallax' ) {
			 wp_enqueue_script( 'vcex-parallax' );
		}
		
		
		// Start Tax Query
		$tax_query = '';
		if( $term_slug !== '' && $term_slug !== 'all' ) {
			$tax_query = array(
				array(
					'taxonomy'	=> 'testimonials_category',
					'field'		=> 'slug',
					'terms'		=> $term_slug,
				),
			);
		}
		
		// The Query
		$vcex_testimonials_query = new WP_Query(
			array(
				'post_type'		=> 'testimonials',
				'posts_per_page'	=> $count,
				'offset'			=> $offset,
				'order'				=> $order,
				'orderby'			=> $orderby,
				'tax_query'		=> $tax_query,
				'filter_content'	=> $filter_content,
				'no_found_rows'	=> true,
			)
		);

		$output = '';

		//Output posts
		if( $vcex_testimonials_query->posts ) :
		
			$unique_id = $unique_id ? ' id="'. $unique_id .'"' : NULL;
			
			// Give flexslider a unique name
			$rand_num = rand(1, 100);
			$unique_flexslider_id	= 'flexslider-'. $rand_num;
			
			// Load Flexslider script
			wp_enqueue_script( 'vcex-flexslider' );
			
			// Output filter JS into the footer like a WP Jedi Master
			$output .='
				<script type="text/javascript">
					jQuery(function($){
						$(window).load(function() {
							$(".vcex-flexslider-wrap").removeClass("flexslider-loader");
							$("#'. $unique_flexslider_id .'").flexslider({
								animation: "fade",
								slideshow : '. $slideshow .',
								slideshowSpeed: '. $slideshow_speed .',
								animationSpeed: '. $animation_speed .',
								controlNav : true,
								directionNav: false,
								pauseOnHover: true,
								smoothHeight: true,
								prevText : \'<i class=icon-angle-left"></i>\',
								nextText : \'<i class="icon-angle-right"></i>\',
								controlsContainer: ".vcex-slider-container-'. $rand_num .'"
							});
						});
					});
				</script>';
			
			$css_animation_classes = '';
			if ( $css_animation !== '' ) {
				$css_animation_classes = 'wpb_animate_when_almost_visible wpb_'. $css_animation .'';
			}
		
			// Main wrapper div
			$output .= '<div class="vcex-testimonials-fullslider vcex-flexslider-wrap '. $skin .'-skin vcex-background-'. $background_style .' '. $css_animation_classes .' vcex-slider-container-'. $rand_num .'"'. $unique_id .'  style="background-color: '. $background .';'. $background_image_style .'">';
			
				$output .= '<div id="'. $unique_flexslider_id .'" class="flexslider"><ul class="slides">';
				
					$output .= '<ul class="slides">';
				
						// Loop through posts
						foreach ( $vcex_testimonials_query->posts as $post ) :
						
							// Post VARS
							$postid = $post->ID;
							$post_title = get_the_title($postid);
							$post_content = $post->post_content;
							$author_name = get_post_meta( $postid, 'wpex_testimonial_author', true );
				
							// Testimonial start
							if ( $post_content !== '' || $custom_excerpt !== '' ) {
								$output .= '<li class="slide">';
									$output .= '<article id="post-'. $postid .'" class="vcex-testimonials-fullslider-entry container">';
										// Author avatar
										if ( $display_author_avatar == 'yes' ) {
											$post_thumb_id = get_post_thumbnail_id($postid);
											$attachment_url = wp_get_attachment_url( $post_thumb_id );
											if ( function_exists('aq_resize') ) {
												$img_url = aq_resize( $attachment_url, '70', '70', true );
											} else {
												$img_url = $attachment_url;
											}
											$output .= '<div class="vcex-testimonials-fullslider-avatar"><img src="'. $img_url .'" alt="'. $author_name .'" /></div>';
										}
										// Content
										$output .= $post_content;
										// Author name
										if ( $author_name && $display_author_name == 'yes' ) {
											$output .= '<div class="vcex-testimonials-fullslider-author"><span>-</span>'. $author_name .'</div>';
										}
									$output .= '</article><!-- .vcex-testimonials-fullslider-entry -->';
								$output .= '</li>';
							}
						
						// End foreach loop
						endforeach;
					
					$output .= '</ul>';
			
				$output .= '</div>';
			
			// Close main wrap
			$output .= '</div><!-- .vcex-testimonials-fullslider --><div class="vcex-clear-floats"></div>';
		
		endif; // End has posts check
				
		// Set things back to normal
		$vcex_testimonials_query = NULL;
		wp_reset_postdata();

		// Return data
		return $output;
		
		
	}
}
add_shortcode('vcex_testimonials_slider', 'vcex_testimonials_slider_shortcode');


// Extend Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Testimonials Slider", 'vcex' ),
	"base"					=> "vcex_testimonials_slider",
	"class"					=> "",
	"category"				=> array(__("Testimonials","wpex"),__("Sliders","wpex")),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-testimonials_slider",
	"params"				=> array(
		array(
		  "type"			=> "dropdown",
		  "heading"		=> __("CSS Animation", "wpex"),
		  "param_name"		=> "css_animation",
		  "value"			=> array(
		  		__("No", "wpex")					=> '',
				__("Top to bottom", "wpex")		=> "top-to-bottom",
				__("Bottom to top", "wpex")		=> "bottom-to-top",
				__("Left to right", "wpex")		=> "left-to-right",
				__("Right to left", "wpex")		=> "right-to-left"),
		  "description"	=> __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "wpex")
		),
		array(
		  "type"			=> "dropdown",
		  "heading"		=> __("Skin", "wpex"),
		  "param_name"		=> "skin",
		  "value"			=> array(
				__("Dark", "wpex") => "dark",
				__("Light (white text)", "wpex")	=> "light",
			)
		),
		array(
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __( "Background Color", 'vcex' ),
			"param_name"	=> "background",
			"value"			=> "",
			"description"	=> __( "Choose your custom background color (Hex value).", 'vcex' ),
		),
		array(
			"type"			=> "attach_image",
			"class"			=> "",
			"heading"		=> __( "Background Image", 'vcex' ),
			"param_name"	=> "background_image",
			"value"			=> "",
			"description"	=> __( "You can upload a custom background image for your testimonials slider.", 'vcex' ),
		),
		array(
		  "type"			=> "dropdown",
		  "heading"		=> __("Background Image Style", "wpex"),
		  "param_name"		=> "background_style",
		  "value"			=> array(
		  			__("Stretched", "wpex")	=> 'stretch',
					__("Fixed", "wpex")		=> "fixed",
					__("Parallax", "wpex")	=> "parallax",
					__("Repeat", "wpex")		=> "repeat",
				),
		  "dependency" => Array('element'	=> "background_image", 'not_empty' => true )
		),
		array(
		  "type"			=> "textfield",
		  "heading"		=> __("Category", "wpex"),
		  "param_name"		=> "term_slug",
		  "admin_label"	=> true,
		  "value"			=> "all",
		  "description"	=> __("Enter the SLUG of your testimonial category here to narrow your output.", "wpex")
    	),
		array(
		  "type"			=> "textfield",
		  "heading"		=> __("Count", "wpex"),
		  "param_name"		=> "count",
		  "value"			=> "3",
		  "description"	=> __("How many testimonials do you wish to show?", "wpex")
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
		  "type"			=> "checkbox",
		  "heading"		=> __("Display Author Name?", "wpex"),
		  "param_name"		=> "display_author_name",
		  "value"			=> Array(__("Yes please.", "wpex") => 'yes'),
    	),
		array(
		  "type"			=> "checkbox",
		  "heading"		=> __("Display Author Avatar?", "wpex"),
		  "param_name"		=> "display_author_avatar",
		  "value"			=> Array(__("Yes please.", "wpex") => 'yes'),
    	),
	)
) );
?>