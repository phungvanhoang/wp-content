<?php
// Register Shortcode -------------------------------------------------------------------------- >
if ( !function_exists('vcex_icon_box_shortcode')) {
	function vcex_icon_box_shortcode( $atts, $content = NULL ) {
		
		extract( shortcode_atts( array(
				'unique_id'		=> '',
				'style'				=> 'one',
				'image'				=> '',
				'icon'				=> '',
				'icon_color'		=> '#000000',
				'icon_size'		=> '24px',
				'icon_background'	=> '',
				'heading'			=> __('Sample heading','vcex'),
				'heading_type'		=> 'h2',
				'heading_color'	=> '',
				'heading_size'		=> '',
				'heading_weight'	=> '',
				'url'				=> '',
				'url_target'		=> '',
				'url_rel'			=> '',
				'css_animation'	=> '',
		), $atts ) );
	
		// VARS
		$output = $icon_background_class = $css_animation_classes = $link_class = $container_background = '';
		$icon = $icon ? $icon : 'flag';
		$icon_size = $icon_size == '' ? '24px' : $icon_size;
		
		// Link class
		if ( $url ) {
			$link_class = 'vcex-icon-box-with-link';
		}
		
		// CSS animation Class
		if ( $css_animation !== '' ) {
			$css_animation_classes = 'wpb_animate_when_almost_visible wpb_'. $css_animation .'';
		}
		
		// Container Style
		$container_style = array();
		
		if ( $style == 'six' ) {
			$container_style[] = 'background-color: '. $icon_background .';color: '. $icon_color .'';
		}
		
		$container_style = implode('', $container_style);
		
		if ( $container_style ) {
			$container_style = wp_kses( $container_style, array() );
			$container_style = ' style="' . esc_attr($container_style) . '"';
		}
		
		// Heading Style
		$heading_style = array();
		
		if ( $heading_color !== '' ) {
			$heading_style[] = 'color: '. $heading_color .';';
		}
		
		if ( $heading_size !== '' ) {
			$heading_size = intval($heading_size);
			$heading_style[] = 'font-size: '. $heading_size .'px;';
		}
		
		if ( $heading_weight !== '' ) {
			$heading_weight = intval($heading_weight);
			$heading_style[] = 'font-weight: '. $heading_weight .';';
		}
		
		$heading_style = implode('', $heading_style);
		
		if ( $heading_style ) {
			$heading_style = wp_kses( $heading_style, array() );
			$heading_style = ' style="' . esc_attr($heading_style) . '"';
		}
		
		//Link Style
		$link_style = array();
		
		if ( $style == 'six' ) {
			$link_style[] = 'color: '. $icon_color .'';
		}
		
		$link_style = implode('', $link_style);
		
		if ( $link_style ) {
			$link_style = wp_kses( $link_style, array() );
			$link_style = ' style="' . esc_attr($link_style) . '"';
		}
		
		// Icon Style
		$icon_style = array();
	
		if ( $icon_color ) {
			$icon_style[] = 'color: ' . $icon_color . ';';
		}
		
		if ( $icon_size ) {
			$icon_style[] = 'font-size: ' . intval($icon_size) . 'px;';
		}
		
		if ( $icon_background && $style !== 'one' && $style !== 'four' && $style !== 'five' && $style !== 'six' ) {
			$icon_style[] = 'background-color: ' . $icon_background . ';';
			$icon_background_class = 'vcex-icon-box-icon-with-bg';
		}
		
		$icon_style = implode('', $icon_style);
		
		if ( $icon_style ) {
			$icon_style = wp_kses( $icon_style, array() );
			$icon_style = ' style="' . esc_attr($icon_style) . '"';
		}
		
		// Seperate icons into a couple groups for styling/html purposes
		$standard_boxes = array('one','two','three');
		$clickable_boxes = array('four','five','six');
		
		// Output the icon box
		$output .= '<article class="vcex-icon-box-'. $style .' '. $css_animation_classes .' '. $link_class .'" '. $container_style .'>';
		
				// Open link if there is one
				if ( $url ) {
					$output .= '<a href="'. $url .'" title="'. $heading .'" class="vcex-icon-box-'. $style .'-link" target="'. $url_target .'" rel="'. $url_rel .'" '. $link_style .'>';
				}
				
				// Display image alternative
				if ( $image ){
					$image_url = wp_get_attachment_url( $image );
					$output .= '<img class="vcex-icon-box-'. $style .'-img-alt" src="'. $image_url .'" alt="'. $heading .'" />';

				} else {
					// Display Icon
					$output .= '<span class="vcex-icon-box-'. $style .'-icon fa fa-'. $icon .' '. $icon_background_class .'" '. $icon_style .'></span>';
				}
					
				// The heading
				$output .= '<'. $heading_type .' class="vcex-icon-box-'. $style .'-heading" '. $heading_style .'>';
					$output .= $heading;
				$output .= '</'. $heading_type .'>';
					
				// Close link
				if ( $url && in_array( $style, $standard_boxes ) ) {
					$output .= '</a>';
				}
				
				// The box content
				if ( $content ) {
					$output .= '<div class="vcex-icon-box-'. $style .'-content clr">';
						$output .= $content;
					$output .= '</div>';
				}
				
				// Close link
				if ( $url && in_array($style, $clickable_boxes ) ) {
					$output .= '</a>';
				}
				
		$output .= '</article>';
		
		return $output;
	}
}
add_shortcode( 'vcex_icon_box', 'vcex_icon_box_shortcode' );




// Add to visual composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Icon Box", 'vcex' ),
	"base"					=> "vcex_icon_box",
	"class"					=> "",
	"category"				=> __( "Icons", "wpex" ),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-icon_box",
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
				__("Right to left", "wpex")		=> "right-to-left",
				__("Appear from center", "wpex")	=> "appear"),
		  "description"	=> __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "wpex"),
		),
		array(
			"type"			=> "textarea_html",
			"class"			=> "",
			"holder"		=> "div",
			"heading"		=> __( "Content", 'vcex' ),
			"param_name"	=> "content",
			 "value"		=> __("Don't forget to change this dummy text in your page editor for this lovely icon box.", "wpex")
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Icon Box Style", 'vcex' ),
			"param_name"	=> "style",
			"description"	=> __( "Select your preferred icon box style", "wpex" ),
			"value"			=> array(
				 __( "Left Icon", "wpex") => "one",
				 __( "Top Icon", "wpex" ) => "two",
				 __( "Top Icon & Background", "wpex" ) => "three",
				 __( "Outlined & Top Icon", "wpex" ) => "four",
				 __( "Boxed & Top Icon", "wpex" ) => "five",
				 __( "Boxed & Top Icon & Custom Background Color", "wpex" ) => "six",
			),
		),
		
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Icon", 'vcex' ),
			"param_name"	=> "icon",
			"description"	=> sprintf( __( 'Select a FontAwesome icon. See all the icons at %s', 'vcex' ), '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a>' ),
			"value"			=> vcex_font_icons_array(),
		),
				
		array(
			"type"			=> "attach_image",
			"heading"		=> __("Icon Image Alternative", "wpex"),
			"param_name"	=> "image",
			"value"			=> "",
			"description"	=> __("Select an image instead of using a font icon.", "wpex"),
		),
		
		array(
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __( "Icon Color", 'vcex' ),
			"param_name"	=> "icon_color",
			"value"			=> "#000000",
		),
		
		array(
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __( "Icon Background", 'vcex' ),
			"param_name"	=> "icon_background",
			"value"			=> "",
			"description"	=> __('Note: Not all icon box styles support this setting.','vcex'),
			"dependency" => Array('element'	=> "style", 'value' => array('three','six'))
		),
		
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Icon Size In Pixels", 'vcex' ),
			"param_name"	=> "icon_size",
			"value"			=> "24px",
			"dependency" => Array('element'	=> "icon", 'not_empty' => true )
		),
		
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Title", 'vcex' ),
			"param_name"	=> "heading",
			"value"			=> "Sample Heading",
			"description"	=> __("Enter your custom title here.", "wpex"),
		),
		
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Title Heading Type", 'vcex' ),
			"param_name"	=> "heading_type",
			 "value"		=> array(
				__("h2", "wpex")	=> "h2",
				__("h3", "wpex")	=> "h3",
				__("h4", "wpex")	=> "h4",
				__("h5", "wpex")	=> "h5",
			),
			"description"	=> __("Select your title heading type for SEO reasons.", "wpex"),
		),
				
		array(
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __( "Heading Font Color", 'vcex' ),
			"param_name"	=> "heading_color",
			"value"			=> "",
			"description"	=> __("Select a custom font color for your title (optional).", "wpex"),
		),
		
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Title Font Size", 'vcex' ),
			"param_name"	=> "heading_size",
			"value"			=> "",
			"description"	=> __("Enter a custom font size in pixels for your title (optional).", "wpex"),
		),
		
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Title Font Weight", 'vcex' ),
			"param_name"	=> "heading_weight",
			"value"			=> "",
			"description"	=> __("Enter a custom font weight for your heading (300,400,600,700).", "wpex"),
		),
		
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "URL", 'vcex' ),
			"param_name"	=> "url",
			"value"			=> "",
		),
		
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "URL Target", 'vcex' ),
			"param_name"	=> "url_target",
			 "value"		=> array(
				__("Self", "wpex")		=> "_self",
				__("Blank", "wpex")	=> "_blank",
			),
			"dependency" => Array('element' => "url", 'not_empty' => true),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "URL Rel", 'vcex' ),
			"param_name"	=> "url_rel",
			 "value"		=> array(
				__("None", "wpex")			=> "",
				__("Nofollow", "wpex")	=> "nofollow",
			),
			"dependency" => Array('element' => "url", 'not_empty' => true),
		),
	)
) );
?>