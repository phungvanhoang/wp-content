<?php
// Add layerslider to visual composer -------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "LayerSlider", 'vcex' ),
	"base"					=> "layerslider",
	"class"					=> "",
	"category"				=> __( "Sliders","wpex"),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-layerslider",
	"params"				=> array(
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __( "Enter your slider ID", 'vcex' ),
			"param_name"	=> "id",
			"value"			=> "1",
			"description"	=> ""
		),
	)
) );
?>