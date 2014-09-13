<?php
// Register Shortcode -------------------------------------------------------------------------- >
if( !function_exists( 'vcex_image_flexslider_shortcode' ) ) {

	function vcex_image_flexslider_shortcode($atts) {
		
		// Define shortcode params
		extract( shortcode_atts( array(
				'unique_id'			=> '',
				'image_ids'			=> '',
				'animation'			=> 'slide',
				'slideshow'			=> 'true',
				'randomize'			=> 'false',
				'direction'			=> 'horizontal',
				'slideshow_speed'		=> '7000',
				'animation_speed'		=> '600',			
				'control_nav'			=> 'true',
				'direction_nav'		=> 'true',
				'pause_on_hover'		=> 'true',
				'smooth_height'		=> 'true',
				'thumbnail_link'		=> 'lightbox',
				'custom_links'			=> '',
    			'custom_links_target'	=> '_self',
				'img_crop'				=> 'false',
				'img_width'			=> '9999',
				'img_height'			=> '9999',
				'caption'				=> 'true',
			), $atts ) );
			
		if ( empty($image_ids) ) echo __( 'Please select your images for your slider', 'vcex' );
			
		$output = '';
		
		// Required Scripts
		wp_enqueue_script( 'vcex-flexslider' );
		
		// Give flexslider a unique name
		$rand_num = rand(1, 100);
		$unique_flexslider_id	= 'flexslider-'. $rand_num;
		
		// Output filter JS into the footer like a WP Jedi Master
		$output .='
			<script type="text/javascript">
				jQuery(function($){
					$(window).load(function() {
						$("#'. $unique_flexslider_id .'").flexslider({
							animation: "'. $animation .'",
							slideshow : '. $slideshow .',
							randomize : '. $randomize .',
							direction: "'. $direction .'",
							slideshowSpeed: '. $slideshow_speed .',
							animationSpeed: '. $animation_speed .',
							controlNav : '. $control_nav .',
							directionNav: '. $direction_nav .',
							pauseOnHover: '. $pause_on_hover .',
							smoothHeight: '. $smooth_height .',
							prevText : \'<i class=fa fa-chevron-left"></i>\',
							nextText : \'<i class="fa fa-chevron-right"></i>\'
						});
					});
				});
			</script>';
		
		// Get Attachments
		$attachments = explode(",",$image_ids);
		$attachments = array_combine($attachments,$attachments);
		
		// Custom Links
		if ( $thumbnail_link == 'custom_link' ) {
			$custom_links = explode( ',', $custom_links);
		}

		//Output images
		if( $attachments ) :
		
			$unique_id = $unique_id ? ' id="'. $unique_id .'"' : NULL;
		
			// Main wrapper div
			$output .= '<div class="vcex-flexslider-wrap clr vcex-img-flexslider"'. $unique_id  .'>';

				$output .= '<div id="'. $unique_flexslider_id .'" class="vcex-flexslider flexslider"><ul class="slides">';
			
				// Loop through attachments
				$count=-1;
				foreach ( $attachments as $attachment ) :
				$count++;
				
					// Attachment VARS
					$attachment_link = get_post_meta( $attachment, '_wp_attachment_url', true );
					$attachment_img_url = wp_get_attachment_url( $attachment );
					$attachment_img = wp_get_attachment_url( $attachment );
					$attachment_alt = strip_tags( get_post_meta($attachment, '_wp_attachment_image_alt', true) );
					$attachment_caption = get_post_field('post_excerpt', $attachment);
					
					// Load scripts
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
		
					// Slide item start
					$output .= '<li class="vcex-flexslider-slide slide">';
					
							$output .= '<div class="vcex-flexslider-entry-media">';
							
								if ( $thumbnail_link == 'lightbox' ) {
									$output .= '<a href="'. $attachment_img_url .'" title="'. $attachment_alt .'" class="vcex-flexslider-entry-img vcex-lightbox">';
										$output .= $image_output;
									$output .= '</a>';
								} elseif ( $thumbnail_link == 'custom_link' ) {
									$custom_link = !empty($custom_links[$count]) ? $custom_links[$count] : '#';
									if ( $custom_link == '#' ) {
										$output .= $image_output;
									} else {
										$output .= '<a href="'. $custom_link .'" title="'. $attachment_alt .'" class="vcex-flexslider-entry-img" target="'. $custom_links_target .'">';
											$output .= $image_output;
										$output .= '</a>';
									}
								} else {
									$output .= $image_output;
								}
								
								if ( $caption == 'true' && $attachment_caption ) {
									$output .= '<div class="vcex-flexslider-entry-title">'. $attachment_caption .'</div>';
								}
								
							$output .= '</div>';
						
					// Close main wrap
					$output .= '</li>';
				
				// End foreach loop
				endforeach;
				
				// End UL
				$output .= '</ul>';
			
			// Close main wrap
			$output .= '</div></div><div class="vcex-clear-floats"></div>';
		
		endif; // End has posts check
		
		// Reset query
		wp_reset_postdata();

		// Return data
		return $output; 
		
	}
	add_shortcode("vcex_image_flexslider", "vcex_image_flexslider_shortcode");
}



// Add to visual composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Image FlexSlider", 'vcex' ),
	"base"					=> "vcex_image_flexslider",
	"class"					=> "",
	"category"				=> __( "Sliders","wpex"),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-image_flexslider",
	"params"				=> array(
		array(
			"type"			=> "attach_images",
			"admin_label"	=> true,
			"class"			=> "",
			"heading"		=> __( "Attach Images", 'vcex' ),
			"param_name"	=> "image_ids",
			"description"	=> __( "Attach images to your post.", 'vcex' ),
		),
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
			"heading"		=> __( "Image Width", 'vcex' ),
			"param_name"	=> "img_width",
			"value"			=> "9999",
			"description"	=> __( "Enter a width in pixels.", 'vcex' ),
			"dependency" => Array('element'	=> "img_crop", 'value' => "yes" ),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Image Height", 'vcex' ),
			"param_name"	=> "img_height",
			"value"			=> "9999",
			"description"	=> __( 'Enter a height in pixels. Set to "9999" to disable vertical cropping and keep image proportions.', 'vcex' ),
			"dependency" => Array('element'	=> "img_crop", 'value' => "yes" ),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Display Caption", 'vcex' ),
			"param_name"	=> "caption",
			"value"			=> array(
				 __( "True", "wpex")		=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Animation", 'vcex' ),
			"param_name"	=> "animation",
			"value"			=> array(
				 __( "Slide", "wpex")	=> "slide",
				 __( "Fade", "wpex" )	=> "fade",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Slideshow", 'vcex' ),
			"param_name"	=> "slideshow",
			"value"			=> array(
				 __( "True", "wpex")		=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Randomize", 'vcex' ),
			"param_name"	=> "randomize",
			"value"			=> array(
				 __( "False", "wpex" )	=> "false",
				 __( "True", "wpex")		=> "true",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Control Nav", 'vcex' ),
			"param_name"	=> "control_nav",
			"value"			=> array(
				 __( "True", "wpex")		=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Direction Nav", 'vcex' ),
			"param_name"	=> "direction_nav",
			"value"			=> array(
				 __( "True", "wpex")		=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Slideshow Speed", 'vcex' ),
			"param_name"	=> "slideshow_speed",
			"value"			=> "7000",
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Animation Speed", 'vcex' ),
			"param_name"	=> "animation_speed",
			"value"			=> "600",
		),
	)
	
) );
?>