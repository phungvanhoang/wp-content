<?php
// Register Shortcode -------------------------------------------------------------------------- >
if( !function_exists( 'vcex_image_grid_shortcode' ) ) {

	function vcex_image_grid_shortcode($atts) {
		
		// Define shortcode params
		extract( shortcode_atts( array(
				'unique_id'			=> '',
				'columns'				=> '4',
				'image_ids'			=> '',
				'img_filter'			=> 'true',
				'grid_style'			=> '',
				'rounded_image'		=> '',
				'thumbnail_link'		=> 'lightbox',
				'custom_links'			=> '',
    			'custom_links_target'	=> '_self',
				'img_width'			=> '9999',
				'img_height'			=> '9999',
				'title'					=> 'true',
				'img_hover_style'		=> '',
			), $atts ) );
			
		if ( empty($image_ids) ) echo __( 'Please select your images for your grid', 'vcex' );
			
		$output = '';
		
		// Get Attachments
		$images = explode(",",$image_ids);
		$images = array_combine($images,$images);
		
		// Custom Links
		if ( $thumbnail_link == 'custom_link' ) {
			$custom_links = explode( ',', $custom_links);
		}

		//Output posts
		if( $images ) :
		
			// Classes
			$classes = array();
		
			// Set correct grid class
			$col_class = '';
			if ( $grid_style == 'no-margins' ) {
				if ( $columns == '1' ) $classes[] = 'full-width';
				if ( $columns == '2' ) $classes[] = 'one-half';
				if ( $columns == '3' ) $classes[] = 'one-third';
				if ( $columns == '4' ) $classes[] = 'one-fourth';
				if ( $columns == '5' ) $classes[] = 'one-fifth';
				if ( $columns == '6' ) $classes[] = 'one-sixth';
			} else {
				if ( $columns == '1' ) $classes[] = 'span_1_of_1';
				if ( $columns == '2' ) $classes[] = 'span_1_of_2';
				if ( $columns == '3' ) $classes[] = 'span_1_of_3';
				if ( $columns == '4' ) $classes[] = 'span_1_of_4';
				if ( $columns == '5' ) $classes[] = 'span_1_of_5';
				if ( $columns == '6' ) $classes[] = 'span_1_of_6';
			}
			
			// Add more classes
			if ( $rounded_image == 'yes' ) {
				$classes[] = 'vcex-rounded-images';
			}
			
			$classes = implode(' ', $classes);
		
			// Unique ID
			$rand_num = rand(1, 100);
			$unique_id = 'vcex-image-grid-'. $rand_num; 
			$unique_id_html = $unique_id ? ' id="'. $unique_id .'"' : 'id="'. $unique_id .'"';
			
			// No margins grid scripts and JS
			if ( $grid_style == 'no-margins' ) {
				// Enqueue Scripts
				wp_enqueue_script('vcex-masonry');
				$output .= '<script type="text/javascript">
				jQuery(function($){
					$(window).load(function() {
						$("#'. $unique_id .'").masonry({
						  itemSelector: ".vcex-image-grid-entry"
						});
					});
				});
				</script>';
			}
			
			// Lightbox Class
			$lightbox_class='';
			if ( $thumbnail_link == 'lightbox' ) {
				$lightbox_class = 'vcex-gallery-lightbox';
			}
		
			// Main wrapper div
			$output .= '<div class="vcex-image-grid grid-style-'. $grid_style .' clr '. $lightbox_class .'"'. $unique_id_html  .'>';
				
				$count=0;
				// Loop through images
				$count2=-1;
				foreach ( $images as $attachment ) :
				$count++;
					$count2++;
				
					// Attachment VARS
					$attachment_link = get_post_meta( $attachment, '_wp_attachment_url', true );
					$attachment_img_url = wp_get_attachment_url( $attachment );
					$attachment_img = wp_get_attachment_url( $attachment );
					$attachment_alt = strip_tags( get_post_meta($attachment, '_wp_attachment_image_alt', true) );
					$attachment_title = get_the_title($attachment);
					
					// Load scripts
					if ( $thumbnail_link == 'lightbox' ) {
						wp_enqueue_script( 'vcex-magnific-popup' );
						wp_enqueue_script( 'vcex-lightbox' );
					}
					
					// Crop featured images if necessary
					if( function_exists('aq_resize') ) {
						$thumbnail_hard_crop = $img_height == '9999' ? false : true;
						$attachment_img = aq_resize( $attachment_img, $img_width, $img_height, $thumbnail_hard_crop );
					}
					
					// Image output
					$image_output = '<img src="'. $attachment_img .'" alt="'. $attachment_alt .'" />';
		
					// Slide item start
					$output .= '<article class="vcex-image-grid-entry col '. $classes .' col-'. $count .'">';
					
							// Filter class
							$img_filter_class = $img_filter ? 'vcex-'. $img_filter : '';
							
							// Image hover styles
							$img_hover_style_class = $img_hover_style ? 'vcex-img-hover-parent vcex-img-hover-'. $img_hover_style : '';
							
							$output .= '<div class="vcex-image-grid-entry-img '. $img_filter_class .' '. $img_hover_style_class .'">';
							
								if ( $thumbnail_link == 'lightbox' ) {
									$output .= '<a href="'. $attachment_img_url .'" title="'. $attachment_title .'" class="vcex-image-grid-entry-img">';
										$output .= $image_output;
									$output .= '</a><!-- .vcex-image-grid-entry-img -->';
								} elseif ( $thumbnail_link == 'custom_link' ) {
									$custom_link = !empty($custom_links[$count2]) ? $custom_links[$count2] : '#';
									if ( $custom_link == '#' ) {
										$output .= $image_output;
									} else {
										$output .= '<a href="'. $custom_link .'" title="'. $attachment_alt .'" class="vcex-image-grid-entry-img" target="'. $custom_links_target .'">';
											$output .= $image_output;
										$output .= '</a>';
									}
								} else {
									$output .= $image_output;
								}
								
								if ( $title == 'yes' && $attachment_title && $grid_style !== 'no-margins' ) {
									$output .= '<div class="vcex-image-grid-entry-title">'. $attachment_title .'</div>';
								}
								
							$output .= '</div>';
						
					// Close main wrap
					$output .= '</article>';
					
					if ( $count == $columns ) $count = 0;
				
				// End foreach loop
				endforeach;
			
			// Close main wrap
			$output .= '</div>';
		
		endif; // End has posts check
		
		// Reset query
		wp_reset_postdata();

		// Return data
		return $output; 
		
	}
	add_shortcode("vcex_image_grid", "vcex_image_grid_shortcode");
}



// Add to visual composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Image Grid", 'vcex' ),
	"base"					=> "vcex_image_grid",
	"class"					=> "",
	"category"				=> __( "Images","wpex"),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-image_grid",
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
			"heading"		=> __( "Columns", 'vcex' ),
			"param_name"	=> "columns",
			"value" 		=> array(6,5, 4, 3, 2, 1),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Grid Style", 'vcex' ),
			"param_name"	=> "grid_style",
			"value"			=> array(
				__( "Default", "wpex" )		=> "default",
				__( "No Margins", "wpex" )	=> "no-margins",	
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
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Image Crop Width", 'vcex' ),
			"param_name"	=> "img_width",
			"value"			=> "500",
			"description"	=> __( "Enter a width in pixels.", 'vcex' ),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Image Crop Height", 'vcex' ),
			"param_name"	=> "img_height",
			"value"			=> "500",
			"description"	=> __( 'Enter a height in pixels. Set to "9999" to disable vertical cropping and keep image proportions.', 'vcex' ),
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