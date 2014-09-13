<?php
// Register Shortcode -------------------------------------------------------------------------- >	
if( !function_exists('vcex_callout_shortcode') ) {
	function vcex_callout_shortcode( $atts, $content = NULL  ) {		
		extract( shortcode_atts( array(
			'caption'					=> '',
			'button_text'				=> '',
			'button_style'				=> 'graphical',
			'button_color'				=> 'blue',
			'button_url'				=> 'http://www.wpexplorer.com',
			'button_rel'				=> 'nofollow',
			'button_target'			=> 'blank',
			'button_border_radius'	=> '',
			'button_title'				=> __('Visit Site', 'vcex' ),
			'button_icon_left'			=> '',
			'button_icon_right'		=> '',
			'css_animation'			=> '',
		), $atts ) );
		
		// CSS animation Class
		$css_animation_classes='';
		if ( $css_animation !== '' ) {
			$css_animation_classes = 'wpb_animate_when_almost_visible wpb_'. $css_animation .'';
		}
		
		//Set Vars
		$button_border_radius = ( $button_border_radius ) ? 'style="border-radius:'. $button_border_radius .'"' : NULL;		
		$button_rel = ( $button_rel !== 'none' ) ? 'rel="'.$button_rel.'"' : NULL;
		
		// Display Callout
		$output = '<div class="vcex-callout vcex-clearfix '. $css_animation_classes .'">';
		$output .= '<div class="vcex-callout-caption">';
			$output .= do_shortcode ( $content );
		$output .= '</div>';	
		if ( $button_text !== '' ) {
			$output .= '<div class="vcex-callout-button">';
				$output .= '<a href="' . $button_url . '" class="vcex-button '. $button_style .' ' . $button_color . '" target="_'.$button_target.'" title="'. $button_title .'" '. $button_border_radius .' '. $button_rel .'>';
					$output.= '<span class="vcex-button-inner" '.$button_border_radius.'>';
						if ( $button_icon_left && $button_icon_left !== 'none' ) $output.= '<i class="vcex-button-icon-left fa fa-'. $button_icon_left .'"></i>';
							$output.= $button_text;
						if ( $button_icon_right && $button_icon_right !== 'none' ) $output.= '<i class="vcex-button-icon-right fa fa-'. $button_icon_right .'"></i>';
					$output.= '</span>';			
				$output.= '</a>';
			$output .='</div>';
		}
		$output .= '</div>';
		
		return $output;
	}
}
add_shortcode( 'vcex_callout', 'vcex_callout_shortcode' );



// Add to Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Callout", 'vcex' ),
	"base"					=> "vcex_callout",
	"category"				=> __( "Business", "wpex" ),
	"class"					=> "",
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-callout",
	"params"				=> array(
	
		array(
			"type"				=> "textarea_html",
			"holder"			=> "div",
			"class"				=> "vcex-callout",
			"heading"			=> __( "Callout Content", 'vcex' ),
			"param_name"		=> "content",
			"value"				=> __( "Enter your content here.", 'vcex' ),
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
			"heading"		=> __( "Button: URL", 'vcex' ),
			"param_name"	=> "button_url",
			"value"			=> "http://www.google.com/",
			"description"	=> __( "Button: URL", 'vcex' )
		),
		
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Button: Text", 'vcex' ),
			"param_name"	=> "button_text",
			"value"			=> "Button Text",
		),
		
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Button Style", 'vcex' ),
			"param_name"	=> "button_style",
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
			"heading"		=> __( "Button: Color", 'vcex' ),
			"param_name"	=> "button_color",
			"value"			=> array(
				 __( "Black", "wpex")	=> "black",
				 __( "Blue", "wpex" )	=> "blue",
				 __( "Brown", "wpex" )	=> "brown",
				 __( "Grey", "wpex" )	=> "grey",
				 __( "Green", "wpex" )	=> "green",
				 __( "Gold", "wpex" )	=> "gold",
				 __( "Orange", "wpex" )	=> "orange",
				 __( "Pink", "wpex" )	=> "pink",
				 __( "Red", "wpex" )		=> "red",
				 __( "Rosy", "wpex" )	=> "rosy",
				 __( "Teal", "wpex" )	=> "teal",
			),
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Button: Border Radius", 'vcex' ),
			"param_name"	=> "button_border_radius",
			"value"			=> "3px",
		),
		
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Button: Link Target", 'vcex' ),
			"param_name"	=> "button_target",
			"value"			=> array(
				 __( "Self", "wpex")		=> "self",
				 __( "Blank", "wpex" )	=> "blank",
			),
		),
		
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Button: Rel", 'vcex' ),
			"param_name"	=> "button_rel",
			"value"			=> array(
				 __( "None", "wpex")			=> "none",
				 __( "Nofollow", "wpex" )	=> "nofollow",
			),
		),
		
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Button: Icon Left", 'vcex' ),
			"param_name"	=> "button_icon_left",
			"description"	=> sprintf( __( 'Icon to the left of your button text. See all the icons at %s', 'vcex' ), '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a>' ),
			"value"			=> vcex_font_icons_array(),
		),
		
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Button: Icon Right", 'vcex' ),
			"param_name"	=> "button_icon_right",
			"description"	=> sprintf( __( 'Icon to the right of your button text. See all the icons at %s', 'vcex' ), '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a>' ),
			"value"			=> vcex_font_icons_array(),
		),
		
	)
) );
?>