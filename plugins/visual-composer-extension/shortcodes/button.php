<?php
// Register Shortcode -------------------------------------------------------------------------- >
if( !function_exists('vcex_button_shortcode') ) {
	function vcex_button_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'style'				=> 'graphical',
			'color'				=> 'blue',
			'url'				=> 'http://www.vcexplorer.com',
			'title'				=> __('Visit Site', 'vcex' ),
			'target'			=> 'self',
			'size'				=> 'normal',
			'font_size'		=> '',
			'align'				=> 'alignleft',
			'rel'				=> '',
			'border_radius'	=> '',
			'class'				=> '',
			'icon_left'		=> '',
			'icon_right'		=> '',
			'css_animation'	=> '',
		), $atts ) );
		
		// Load required scripts
		if ( ( $icon_left && $icon_left !== 'none' ) || (  $icon_right && $icon_right !== 'none' ) ) {
			wp_enqueue_style('vcex_shortcode_font_awesome');
		}
		
		// Rel
		$rel = ( $rel !== 'none' ) ? 'rel="'.$rel.'"' : NULL;
		
		// Animation
		$css_animation_classes = '';
		if ( $css_animation !== '' ) {
			$css_animation_classes = 'wpb_animate_when_almost_visible wpb_'. $css_animation .'';
		}
		
		// Custom Style
		$inline_style = array();
		
		if ( $font_size ) {
			$inline_style[] = 'font-size: '. $font_size .';';
		}
		
		if ( $border_radius ) {
			$inline_style[] = 'border-radius: '. $border_radius .';';
		}
		
		$inline_style = implode('', $inline_style);
		
		if ( $inline_style ) {
			$inline_style = wp_kses( $inline_style, array() );
			$inline_style = ' style="' . esc_attr($inline_style) . '"';
		}
		
		// Display Button
		$output= NULL;
		if ( $align == 'center' ) {
			$output.= '<div class="textcenter">';
		}
		$output.= '<a href="' . $url . '" class="vcex-button '. $style .' align-'. $align .' '. $size .' ' . $color . ' '. $class .' '. $css_animation_classes .'" target="_'.$target.'" title="'. $title .'" '. $inline_style .' '. $rel .'>';
			$output.= '<span class="vcex-button-inner" '. $inline_style .'>';
				if ( $icon_left && $icon_left !== 'none' ) $output.= '<i class="vcex-button-icon-left fa fa-'. $icon_left .'"></i>';
				$output.= $content;
				if ( $icon_right && $icon_right !== 'none' ) $output.= '<i class="vcex-button-icon-right fa fa-'. $icon_right .'"></i>';
			$output.= '</span>';			
		$output.= '</a>';
		if ( $align == 'center' ) {
			$output.= '</div>';
		}
		return $output;
	}
}
add_shortcode('vcex_button', 'vcex_button_shortcode');



// Extend Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Button", 'vcex' ),
	"base"					=> "vcex_button",
	"class"					=> "",
	"category"				=> __( "Business", "wpex" ),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-button",
	"params"				=> array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "URL", 'vcex' ),
			"param_name"	=> "url",
			"admin_label"	=> true,
			"value"			=> "http://www.google.com/",
			"description"	=> __( "Button URL", 'vcex' )
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Content", 'vcex' ),
			"param_name"	=> "content",
			"value"			=> "Button Text",
			"description"	=> __( "Button\'s Text", 'vcex' )
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Link Title", 'vcex' ),
			"param_name"	=> "title",
			"value"			=> "Visit Site",
			"description"	=> __( "Add A Link Title", 'vcex' )
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
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Button Style", 'vcex' ),
			"param_name"	=> "style",
			"admin_label"	=> true,
			"description"	=> __( "Select a button style.", 'vcex' ),
			"value"			=> array(
				 __( "Graphical", "wpex")	=> "graphical",
				 __( "Flat", "wpex" )		=> "flat",
				 __( "3D", "wpex" )		=> "three-d",
				 __( "Outline", "wpex" )	=> "outline",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Button Color", 'vcex' ),
			"param_name"	=> "color",
			"admin_label"	=> true,
			"description"	=> __( "Select a button color.", 'vcex' ),
			"value"			=> array(
				 __( "Black", "wpex")	=> "black",
				 __( "Blue", "wpex" )	=> "blue",
				 __( "Brown", "wpex" )	=> "brown",
				 __( "Grey", "wpex" )	=> "grey",
				 __( "Green", "wpex" )	=> "green",
				 __( "Gold", "wpex" )	=> "gold",
				 __( "Orange", "wpex" ) => "orange",
				 __( "Pink", "wpex" )	=> "pink",
				 __( "Purple", "wpex" ) => "purple",
				 __( "Red", "wpex" ) => "red",
				 __( "Rosy", "wpex" )	=> "rosy",
				 __( "Teal", "wpex" )	=> "teal",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Button Size", 'vcex' ),
			"param_name"	=> "size",
			"description"	=> __( "Select a button size.", 'vcex' ),
			"value"			=> array(
				 __( "Small", "wpex")	=> "small",
				 __( "Medium", "wpex" )	=> "medium",
				 __( "Large", "wpex" )	=> "large",
			),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Custom Font Size", 'vcex' ),
			"param_name"	=> "font_size",
			"value"			=> "",
			"description"	=> __( "Border Radius", 'vcex' ),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Border Radius", 'vcex' ),
			"param_name"	=> "border_radius",
			"value"			=> "3px",
			"description"	=> __( "Border Radius", 'vcex' ),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Link Target", 'vcex' ),
			"param_name"	=> "target",
			"value"			=> array(
				 __( "Self", "wpex")		=> "self",
				 __( "Blank", "wpex" )	=> "blank",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Link Rel", 'vcex' ),
			"param_name"	=> "rel",
			"value"			=> array(
				 __( "None", "wpex")			=> "none",
				 __( "Nofollow", "wpex" )	=> "nofollow",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Button Align", 'vcex' ),
			"param_name"	=> "align",
			"value"			=> array(
				 __( "Left", "wpex")		=> "left",
				 __( "Right", "wpex")		=> "right",
				 __( "Center", "wpex" )	=> "center",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Icon Left", 'vcex' ),
			"param_name"	=> "icon_left",
			"description"	=> sprintf( __( 'Icon to the left of your button text. See all the icons at %s', 'vcex' ), '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a>' ),
			"value"			=> vcex_font_icons_array(),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Icon Right", 'vcex' ),
			"param_name"	=> "icon_right",
			"description"	=> sprintf( __( 'Icon to the right of your button text. See all the icons at %s', 'vcex' ), '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a>' ),
			"value"			=> vcex_font_icons_array(),
		),
	)
) );
?>