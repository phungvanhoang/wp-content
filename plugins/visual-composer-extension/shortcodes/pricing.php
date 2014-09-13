<?php
// Register Shortcode -------------------------------------------------------------------------- >

if( !function_exists('vcex_pricing_shortcode') ) {
	function vcex_pricing_shortcode( $atts, $content = null  ) {
		
		extract( shortcode_atts( array(
			'size'						=> 'one-half',
			'position'					=> '',
			'featured'					=> 'no',
			'plan'						=> 'Basic',
			'cost'						=> '$20',
			'per'						=> '',
			'button_url'				=> '',
			'button_text'				=> 'Purchase',
			'button_color'				=> 'blue',
			'button_target'			=> 'self',
			'button_rel'				=> 'nofollow',
			'button_border_radius'	=> '',
			'class'						=> '',
		), $atts ) );
		
		//set variables
		$featured_pricing = ( $featured == 'yes' ) ? 'featured' : NULL;
		$border_radius_style = ( $button_border_radius ) ? 'style="border-radius:'. $button_border_radius .'"' : NULL;
		
		//start content  
		$pricing_content ='';
		$pricing_content .= '<div class="vcex-pricing vcex-'. $size .' '. $featured_pricing .' vcex-column-'. $position. ' '. $class .'">';
			$pricing_content .= '<div class="vcex-pricing-header clr">';
				$pricing_content .= '<h5>'. $plan. '</h5>';
			$pricing_content .= '</div>';
			$pricing_content .= '<div class="vcex-pricing-cost clr">';
				$pricing_content .= '<div class="vcex-pricing-ammount">'. $cost .'</div><div class="vcex-pricing-per">'. $per .'</div>';
			$pricing_content .= '</div>';
			$pricing_content .= '<div class="vcex-pricing-content">';
				$pricing_content .= ''. $content. '';
			$pricing_content .= '</div>';
			if( $button_url ) {
				$pricing_content .= '<div class="vcex-pricing-button"><a href="'. $button_url .'" target="_'. $button_target .'" rel="'. $button_rel .'" '. $border_radius_style .' class="theme-button">'. $button_text .'</a></div>';
			}
		$pricing_content .= '</div>';  
		return $pricing_content;
	}
}
add_shortcode( 'vcex_pricing', 'vcex_pricing_shortcode' );


// Add to visual composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Pricing Table", 'vcex' ),
	"base"					=> "vcex_pricing",
	"class"					=> "",
	"category"				=> __( "Business", "wpex" ),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-pricing",
	"params"				=> array(
		array(
			"type"			=> "textarea_html",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __( "Features", 'vcex' ),
			"param_name"	=> "content",
			"value"			=> "<ul>
									<li>30GB Storage</li>
									<li>512MB Ram</li>
									<li>10 databases</li>
									<li>1,000 Emails</li>
									<li>25GB Bandwidth</li>
								</ul>",
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Featured", 'vcex' ),
			"param_name"	=> "featured",
			"value"			=> array(
				__( "No", "wpex" )	=> "no",
				__( "Yes", "wpex")	=> "yes",
			),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Plan", 'vcex' ),
			"param_name"	=> "plan",
			"value"			=> "Basic",
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Cost", 'vcex' ),
			"param_name"	=> "cost",
			"value"			=> "$20",
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Per (optional)", 'vcex' ),
			"param_name"	=> "per",
			"value"			=> "/ month",
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Button: Text", 'vcex' ),
			"param_name"	=> "button_text",
			"value"			=> "Button Text",
			"description"	=> __( "Button: Text", 'vcex' )
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
				 __( "None", "wpex")		=> "none",
				 __( "Nofollow", "wpex" )	=> "nofollow",
			),
		),
	)
) );
?>