<?php
// Skillbars -------------------------------------------------------------------------- >	
if( !function_exists('vcex_skillbar_shortcode') ) {
	function vcex_skillbar_shortcode( $atts  ) {		
		extract( shortcode_atts( array(
			'title'				=> '',
			'percentage'		=> '100',
			'color'				=> '#6adcfa',
			'class'				=> '',
			'show_percent'		=> 'true',
			'css_animation'	=> '',
		), $atts ) );
		
		// Enque scripts
		wp_enqueue_script('vcex-skillbar');
		
		$css_animation_classes = '';
		if ( $css_animation !== '' ) {
			$css_animation_classes = 'wpb_animate_when_almost_visible wpb_'. $css_animation .'';
		}
		
		// Percentage
		$percentage = $percentage ? preg_replace("/[^0-9]/","", $percentage) : '';
		
		// Display the accordion	';
		$output = '<div class="vcex-skillbar vcex-clearfix '. $class .'" '. $css_animation_classes .'" data-percent="'. $percentage .'%">';
			$output .= '<div class="vcex-skillbar-title" style="background: '. $color .';"><span>'. $title .'</span></div>';
			$output .= '<div class="vcex-skillbar-bar" style="background:'. $color .';">';
				if ( $show_percent == 'true' ) {
					$output .= '<div class="vcex-skill-bar-percent">'.$percentage.'%</div>';
				}
			$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
}
add_shortcode( 'vcex_skillbar', 'vcex_skillbar_shortcode' );


// Add to visual composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Skill Bar", 'vcex' ),
	"base"					=> "vcex_skillbar",
	"class"					=> "",
	"category"				=> __( "Lists", "wpex" ),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-skillbar",
	"params"				=> array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Title", 'vcex' ),
			"param_name"	=> "title",
			"admin_label"	=> true,
			"value"			=> "Web Design",
			"description"	=> __( "Add your skillbar title.", 'vcex' )
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
			"heading"		=> __( "Percentage", 'vcex' ),
			"param_name"	=> "percentage",
			"value"			=> "70",
			"description"	=> __( "Add a percentage value.", 'vcex' )
		),
		array(
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __( "Background", 'vcex' ),
			"param_name"	=> "color",
			"value"			=> "#65C25C",
			"description"	=> __( "Choose your custom background color (Hex value).", 'vcex' ),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Display % Number", 'vcex' ),
			"param_name"	=> "show_percent",
			"value"			=> array(
				 __( "True", "wpex" )	=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),
	)
) );
?>