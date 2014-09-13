<?php
// Register Shortcode -------------------------------------------------------------------------- >	
if( !function_exists('vcex_milestone_shortcode') ) {
	function vcex_milestone_shortcode( $atts, $content = NULL  ) {		
		extract( shortcode_atts( array(
			'speed'				=> '2500',
			'interval'			=> '50',
			'animated'			=> 'yes',
			'number'			=> '',
			'number_size'		=> '54',
			'number_color'		=> '#bcbcbc',
			'caption'			=> '',
			'caption_size'		=> '16',
			'caption_color'	=> '54',
			'button_url'		=> '',
			'button_rel'		=> 'nofollow',
			'button_target'	=> 'blank',
		), $atts ) );
		
		// Extra classes
		$extra_classes = '';
		
		// Load required scripts
		if ( $animated == 'yes' && !wp_is_mobile() ) {
			wp_enqueue_script('vcex-appear');
			wp_enqueue_script('vcex-countTo');
			wp_enqueue_script('vcex-milestone');
			$extra_classes = 'vcex-animated-milestone';
		}
		
		// NUmber Style
		$number_style = array();
		$number_style[] = 'color: '. $number_color .';';
		$number_style[] = 'font-size: '. intval($number_size) .'px;';
		$number_style = implode('', $number_style);
		$number_style = wp_kses( $number_style, array() );
		$number_style = ' style="' . esc_attr($number_style) . '"';
		
		// Caption Style
		$caption_style = array();
		$caption_style[] = 'color: '. $caption_color .';';
		$caption_style[] = 'font-size: '. intval($caption_size) .'px;';
		$caption_style = implode('', $caption_style);
		$caption_style = wp_kses( $caption_style, array() );
		$caption_style = ' style="' . esc_attr($caption_style) . '"';
		
		// Display MileStone
		$output = '<div class="vcex-milestone vcex-clearfix '. $extra_classes .'">';
		
		$output .= '<div class="vcex-milestone-number">';
			if ( $number !== '' ) {
				$output .= '<span class="vcex-milestone-time" data-from="0" data-to="'. intval($number) .'" data-speed="'. $speed .'" data-refresh-interval="'. $interval .'" '. $number_style .'>';
					$output .= $number;
				$output .= '</span>';
			} else {
				$output .= __('Please enter a number!','vcex');
			}
		$output .= '</div>';
		if ( $caption !== '' ) {
			$output .= '<div class="vcex-milestone-caption" '. $caption_style .'>';
				$output .= $caption;
			$output .= '</div>';	
		}
		$output .= '</div>';
		
		return $output;
	}
}
add_shortcode( 'vcex_milestone', 'vcex_milestone_shortcode' );



// Add to Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Milestone", 'vcex' ),
	"base"					=> "vcex_milestone",
	"category"				=> __( "Business", "wpex" ),
	"class"					=> "",
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-milestone",
	"params"				=> array(
	
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "vcex-animated-counter-number",
			"heading"		=> __( "Speed", 'vcex' ),
			"param_name"	=> "speed",
			"value"			=> "2500",
			"description"	=> __('The number of milliseconds it should take to finish counting.','vcex'),
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "vcex-animated-counter-number",
			"heading"		=> __( "Refresh Interval", 'vcex' ),
			"param_name"	=> "interval",
			"value"			=> "50",
			"description"	=> __('The number of milliseconds to wait between refreshing the counter.','vcex'),
		),
	
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "vcex-animated-counter-number",
			"heading"		=> __( "Number", 'vcex' ),
			"param_name"	=> "number",
			"value"			=> "45",
		),
		
		array(
			"type"			=> "colorpicker",
			"heading"		=> __( "Number: Color", 'vcex' ),
			"param_name"	=> "number_color",
			"value"			=> "#bcbcbc",
		),
		
		array(
			"type"			=> "textfield",
			"heading"		=> __( "Number: Font Size", 'vcex' ),
			"param_name"	=> "number_size",
			"value"			=> "54px",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "vcex-animated-counter-caption",
			"heading"		=> __( "Caption", 'vcex' ),
			"param_name"	=> "caption",
			"value"			=> "Awards Won",
		),
		
		array(
			"type"			=> "colorpicker",
			"heading"		=> __( "Caption: Color", 'vcex' ),
			"param_name"	=> "caption_color",
			"value"			=> "#898989",
		),
		
		array(
			"type"			=> "textfield",
			"heading"		=> __( "Caption: Font Size", 'vcex' ),
			"param_name"	=> "caption_size",
			"value"			=> "16px",
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
			"value"			=> array(
				 __( "Self", "wpex")	=> "self",
				 __( "Blank", "wpex" )	=> "blank",
			),
		),
		
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "URl Rel", 'vcex' ),
			"param_name"	=> "url_rel",
			"value"			=> array(
				 __( "None", "wpex")		=> "none",
				 __( "Nofollow", "wpex" )	=> "nofollow",
			),
		),
		
	)
) );
?>