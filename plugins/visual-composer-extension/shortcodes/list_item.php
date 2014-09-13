<?php
// Register Shortcode -------------------------------------------------------------------------- >
if( !function_exists('vcex_list_item_shortcode') ) {
	function vcex_list_item_shortcode( $atts, $content = NULL ) {
		extract( shortcode_atts( array(
			'style'				=> '',
			'icon'				=> '',
			'color'				=> '#fff',
			'font_color'		=> '',
			'text_align'		=> 'textleft',
			'margin_right'		=> '',
			'css_animation'	=> '',
			'font_size'		=> '',
			'css_animation'	=> '',
		),
		$atts ) );
		
		// Main Styles
		$add_style = array();
		
		if( $font_size ) {
			$add_style[] = 'font-size:'. $font_size .';';
		}
		
		if ( $font_color ) {
			$add_style[] = 'color: '. $font_color .';';
		}
		
		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
		
		// Icon margin right
		if ( $margin_right ) {
			$margin_right = 'margin-right:'. intval($margin_right) .'px;';
		}
		
		// CSS animations
		$css_animation_classes = '';
		if ( $css_animation !== '' ) {
			$css_animation_classes = 'wpb_animate_when_almost_visible wpb_'. $css_animation .'';
		}
		
		// Output
		$output ='<div class="vcex-list_item '. $css_animation_classes .' '. $text_align .'" '. $add_style .'>';
			$output .= '<span class="fa fa-'. $icon .'" style="color:'. $color .';'. $margin_right.'"></span>';
			$output .= do_shortcode( $content );
		$output .= '</div>';
		
		return $output;
	}
}
add_shortcode('vcex_list_item', 'vcex_list_item_shortcode');



// Add To Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "List Item", 'vcex' ),
	"base"					=> "vcex_list_item",
	"class"					=> "",
	"category"				=> __( "Lists", "wpex" ),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-list_item",
	"params"				=> array(
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Icon", 'vcex' ),
			"param_name"	=> "icon",
			"admin_label"	=> true,
			"description"	=> sprintf( __( 'Select a FontAwesome icon. See all the icons at %s', 'vcex' ), '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a>' ),
			"value"			=> vcex_font_icons_array(),
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
		  "description"	=> __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "wpex"),
		  "dependency" => Array('element'	=> "icon", 'not_empty' => true )
		),
		array(
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __( "Icon Color", 'vcex' ),
			"param_name"	=> "color",
			"value"			=> "#7dbd21",
			"dependency"	=> Array('element'	=> "icon", 'not_empty' => true )
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Icon Right Margin", 'vcex' ),
			"param_name"	=> "margin_right",
			"value"			=> "",
			"description"	=> __( "Enter a custom right side margin for your icon. Example: 10px", 'vcex' ),
			"dependency"	=> Array('element'	=> "icon", 'not_empty' => true )
		),
		array(
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __( "Font Color", 'vcex' ),
			"param_name"	=> "font_color",
			"value"			=> "",
			"dependency"	=> Array('element'	=> "icon", 'not_empty' => true )
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Custom Font Size", 'vcex' ),
			"param_name"	=> "font_size",
			"value"			=> "",
			"description"	=> __( "Enter a custom font size in pixels, such as 18px (optional). This will alter the icon and text size.", 'vcex' ),
			"dependency"	=> Array('element'	=> "icon", 'not_empty' => true )
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Text Align", 'vcex' ),
			"param_name"	=> "text_align",
			"value"			=> array(
				__('Left','vcex') => 'textleft',
				__('Center','vcex') => 'textcenter',
				__('Right','vcex') => 'textright',
			),
			"description"	=> __( "Select your preferred text alignment.", 'vcex' ),
			"dependency"	=> Array('element'	=> "icon", 'not_empty' => true )
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Content", 'vcex' ),
			"param_name"	=> "content",
			"value"			=> __( 'This is a pretty list item', 'vcex' ),
			"description"	=> __( "Insert your unordered list here.", 'vcex' ),
			"dependency"	=> Array('element'	=> "icon", 'not_empty' => true )
		),
	)
) );
?>