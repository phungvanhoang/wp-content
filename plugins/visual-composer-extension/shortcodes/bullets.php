<?php
// Register Shortcode -------------------------------------------------------------------------- >
if( !function_exists('vcex_bullets_shortcode') ) {
	function vcex_bullets_shortcode( $atts, $content = NULL ) {
		extract( shortcode_atts( array(
			'style'	=> ''
		),
		$atts ) );
		return '<div class="vcex-bullets vcex-bullets-' . $style . '">' . do_shortcode( $content ) . '</div>';
	}
}
add_shortcode('vcex_bullets', 'vcex_bullets_shortcode');



// Add To Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Bullets", 'vcex' ),
	"base"					=> "vcex_bullets",
	"class"					=> "",
	"category"				=> __( "Lists", "wpex" ),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-bullets",
	"params"				=> array(
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Style", 'vcex' ),
			"param_name"	=> "style",
			"admin_label"	=> true,
			"value"			=> array(
				 __( "Check", "wpex")		=> "check",
				 __( "Blue", "wpex" )		=> "blue",
				 __( "Gray", "wpex" )		=> "gray",
				 __( "Purple", "wpex" )	=> "purple",
				 __( "Red", "wpex" )		=> "red",
			),
			"description"	=> __( "Select your bullet style.", 'vcex' )
		),
		array(
			"type"			=> "textarea_html",
			"heading"		=> __( "List", 'vcex' ),
			"param_name"	=> "content",
			"value"			=> "<ul><li>List 1</li><li>List 2</li><li>List 3</li><li>List 4</li></ul>",
			"description"	=> __( "Insert your unordered list here.", 'vcex' )
		),
	)
) );
?>