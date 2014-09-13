<?php
// Register Shortcode ----------------------------------------------------------------------------- >	
if( !function_exists( 'vcex_image_carousel_shortcode' ) ) {

	function vcex_image_carousel_shortcode($atts) {
		
		// Define shortcode params
		extract( shortcode_atts( array(
				'unique_id'			=> '',
				'style'					=> 'default',
				'image_ids'			=> '',
				'item_width'			=> '400',
				'timeout_duration'		=> '5000',
				'min_slides'			=> '1',
				'max_slides'			=> '4',
				'items_scroll'			=> 'page',
				'animation'			=> 'CSS',
				'auto_play'			=> 'false',
				'arrows'				=> 'true',
				'thumbnail_link'		=> 'lightbox',
				'custom_links'			=> '',
    			'custom_links_target'	=> '_self',
				'img_crop'				=> 'false',
				'img_width'			=> '9999',
				'img_height'			=> '9999',
				'title'					=> 'true',
				'img_filter'			=> 'true',
				'rounded_image'		=> '',
				'img_hover_style'		=> '',
			), $atts ) );
			
		$output = '';
		
		if ( empty($image_ids) ) return;
		
		// Required Scripts
		wp_enqueue_script( 'vcex-caroufredsel' );
		
		// Give caroufredsel a unique name
		$rand_num 			= rand(1, 100);
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
								onMouse: true
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
								width : "'. intval($item_width) .'",
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
		
		// Get Attachments
		$images = explode(",",$image_ids);
		$images = array_combine($images,$images);
		
		// Classes
		$img_classes = array();	
		if ( $rounded_image == 'yes' ) {
			$img_classes[] = 'vcex-rounded-images';
		}
		if ( $img_filter ) {
			$img_classes[] = 'vcex-'. $img_filter;
		}
		if ( $img_hover_style ) {
			$img_classes[] = ' vcex-img-hover-parent vcex-img-hover-'. $img_hover_style;
		}
		$img_classes = implode(' ', $img_classes);
		
		// Custom Links
		if ( $thumbnail_link == 'custom_link' ) {
			$custom_links = explode( ',', $custom_links);
		}
		
		//Output images
		if( $images ) :
		
			$unique_id = $unique_id ? ' id="'. $unique_id .'"' : NULL;
		
			// Main wrapper div
			$output .= '<div class="vcex-caroufredsel-wrap clr vcex-caroufredsel-images vcex-caroufredsel-'. $style .' vcex-caroufredsel-loading"'. $unique_id  .'>';
				
				$output .= '<div class="vcex-caroufredsel"><ul id="'. $unique_carousel_id .'">';
			
				// Loop through images
				$count=-1;
				foreach ( $images as $attachment ) :
				$count++;
				
					// Attachment VARS
					$attachment_link = get_post_meta( $attachment, '_wp_attachment_url', true );
					$attachment_img_url = wp_get_attachment_url( $attachment );
					$attachment_img = wp_get_attachment_url( $attachment );
					$attachment_alt = strip_tags( get_post_meta($attachment, '_wp_attachment_image_alt', true) );
					$attachment_title = get_the_title($attachment);
					
					if ( $thumbnail_link == 'lightbox' ) {
						wp_enqueue_script( 'vcex-magnific-popup' );
						wp_enqueue_script( 'vcex-lightbox' );
					}
					
					// Crop featured images if necessary
					if( $img_crop == 'yes' ) {
						$thumbnail_hard_crop = $img_height == '9999' ? false : true;
						$img_width = intval($img_width);
						$img_height = intval($img_height);
						$attachment_img = aq_resize( $attachment_img, $img_width, $img_height, $thumbnail_hard_crop );
					}
					
					// Image output
					$image_output = '<img src="'. $attachment_img .'" alt="'. $attachment_alt .'" />';
		
					// Carousel item start
					$output .= '<li class="vcex-caroufredsel-slide">';
					
						// Media Wrap
						$output .= '<div class="vcex-caroufredsel-entry-media '. $img_classes .'">';
						
							if ( $thumbnail_link == 'lightbox' ) {
								$output .= '<a href="'. $attachment_img_url .'" title="'. $attachment_title .'" class="vcex-caroufredsel-entry-img vcex-lightbox">';
									$output .= $image_output;
								$output .= '</a><!-- .vcex-caroufredsel-entry-img -->';
							} elseif ( $thumbnail_link == 'custom_link' ) {
								$custom_link = !empty($custom_links[$count]) ? $custom_links[$count] : '#';
								if ( $custom_link == '#' ) {
									$output .= $image_output;
								} else {
									$output .= '<a href="'. $custom_link .'" title="'. $attachment_alt .'" class="vcex-caroufredsel-entry-img" target="'. $custom_links_target .'">';
										$output .= $image_output;
									$output .= '</a>';
								}
							} else {
								$output .= $image_output;
							}
							
						$output .= '</div>';
							
						if ( $title == 'yes' && $attachment_title ) {
							$output .= '<div class="vcex-caroufredsel-entry-title">'. $attachment_title .'</div>';
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
		
		endif; // End has images check
		
		// Reset query
		wp_reset_postdata();

		// Return data
		return $output; 
		
	}
}
add_shortcode("vcex_image_carousel", "vcex_image_carousel_shortcode");


// Add to visual composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Image Carousel", 'vcex' ),
	"base"					=> "vcex_image_carousel",
	"class"					=> "",
	"category"				=> __("Images","wpex"),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-image_carousel",
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
			"type"			=> "attach_images",
			"class"			=> "",
			"admin_label"	=> true,
			"heading"		=> __( "Attach Images", 'vcex' ),
			"param_name"	=> "image_ids",
			"description"	=> __( "Attach images to your post.", 'vcex' ),
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
			"heading"		=> __( "Image Link", 'vcex' ),
			"param_name"	=> "thumbnail_link",
			"value"			=> array(
				 __( "None", "wpex" )			=> "none",
				 __( "Lightbox", "wpex" )		=> "lightbox",
				 __( "Custom Links", "wpex" ) => "custom_link",
			),
		),
		array(
		  "type"			=> "exploded_textarea",
		  "heading"		=> __("Custom links", "wpex"),
		  "param_name"		=> "custom_links",
		  "description"	=> __('Enter links for each slide here. Divide links with linebreaks (Enter). For images without a link enter a # symbol. And don\'t forget to include the http:// at the front.', 'vcex'),
		  "dependency"		=> Array('element' => "thumbnail_link", 'value' => array('custom_link'))
		),
		array(
		  "type"			=> "dropdown",
		  "heading" 		=> __("Custom link target", "wpex"),
		  "param_name" 	=> "custom_links_target",
		  "description"	=> __('Select where to open  custom links.', 'vcex'),
		  "dependency"		=> Array('element' => "thumbnail_link", 'value' => array('custom_link')),
		  "value"			=> array(
		  		__("Same window", "wpex") => "_self",
				__("New window", "wpex") => "_blank"
			)
		),
		array(
			"type"			=> "checkbox",
			"class"			=> "",
			"heading"		=> __( "Crop Images?", 'vcex' ),
			"param_name"	=> "img_crop",
			"value"			=> Array(__("Yes please.", "wpex") => 'yes'),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Image Crop Width", 'vcex' ),
			"param_name"	=> "img_width",
			"value"			=> "500",
			"description"	=> __( "Enter a width in pixels.", 'vcex' ),
			"dependency" => Array('element'	=> "img_crop", 'value' => "yes" ),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Image Crop Height", 'vcex' ),
			"param_name"	=> "img_height",
			"value"			=> "500",
			"description"	=> __( 'Enter a height in pixels. Set to "9999" to disable vertical cropping and keep image proportions.', 'vcex' ),
			"dependency" => Array('element'	=> "img_crop", 'value' => "yes" ),
		),
		array(
			"type"			=> "checkbox",
			"class"			=> "",
			"heading"		=> __( "Rounded Image?", 'vcex' ),
			"param_name"	=> "rounded_image",
			"value"			=> Array(__("Yes please.", "wpex") => 'yes'),
			"description"	=> __( "For truely rounded images make sure your images are cropped to the same width and height.", "wpex"),
		),
		array(
			"type"			=> "checkbox",
			"class"			=> "",
			"heading"		=> __( "Display Title", 'vcex' ),
			"param_name"	=> "title",
			"value"			=> Array(__("Yes please.", "wpex") => 'yes'),
			"description"	=> __( "Note: The title will only display on some grid styles. For example the grid without margins will not display the title.", "wpex"),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Image Filter", 'vcex' ),
			"param_name"	=> "img_filter",
			"value"			=> vcex_image_filters()
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "CSS3 Image Hover", 'vcex' ),
			"param_name"	=> "img_hover_style",
			"value"			=> vcex_image_hovers(),
			"description"	=> __("Select your preferred image hover effect. Please note this will only work if the image links to a URL or a large version of itself. Please note these effects may not work in all browsers.", "wpex"),
		),
	)
) );
?>