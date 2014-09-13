<?php
// Register shortcode -------------------------------------------------------------------------- >	
if( !function_exists('vcex_spacing_shortcode') ) {
	function vcex_spacing_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'size'	=> '20px',
			'class'	=> '',
		  ),
		  $atts ) );
	 return '<hr class="vcex-spacing '. $class .'" style="height: '. $size .'" />';
	}
}
add_shortcode( 'vcex_spacing', 'vcex_spacing_shortcode' );


// Add to visual composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Spacing", 'js_composer' ),
	"base"					=> "vcex_spacing",
	"class"					=> "",
	"category"				=> __( "Seperators", "wpex" ),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-spacing",
	"params"				=> array(
		array(
			"type"			=> "textfield",
			"admin_label"	=> true,
			"class"			=> "",
			"heading"		=> __( "Spacing", 'js_composer' ),
			"param_name"	=> "size",
			"value"			=> "30px",
			"description"	=> __( "Enter a height in pixels for your spacing.", 'js_composer' )
		),
	)
) );
?>