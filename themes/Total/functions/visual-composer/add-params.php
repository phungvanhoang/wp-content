<?php
/**
 * Add new params to the vc composer
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */


// Leave file if the vc_add_param parameter doesn't exist
if ( !function_exists('vc_add_param') ) {
	return;
}

  
/*------------------------------------------------*/
/* Single Image
/*------------------------------------------------*/


if ( function_exists('vcex_image_hovers') ) {
	vc_add_param( "vc_single_image", array(
		"type"			=> "dropdown",
		"class"			=> "",
		"heading"		=> __( "CSS3 Image Hover", 'vcex' ),
		"param_name"	=> "img_hover",
		"value"			=> vcex_image_hovers(),
		"description"	=> __("Select your preferred image hover effect. Please note this will only work if the image links to a URL or a large version of itself. Please note these effects may not work in all browsers.", "wpex"),
	) );
}

vc_add_param( "vc_single_image", array(
		"type"			=> "textfield",
		"class"			=> "",
		"heading"		=> __( "Image Link Caption", 'vcex' ),
		"param_name"	=> "img_caption",
		"value"			=> "",
		"description"	=> __("Use this field to add a caption to any single image with a link.", "wpex"),
) );


/*------------------------------------------------*/
/* Add Font size to seperator w/ text
/*------------------------------------------------*/
vc_add_param( "vc_text_separator", array(
	"type"			=> "dropdown",
	"class"			=> "",
	"heading"		=> __("Style","wpex"),
	"param_name"	=> "style",
	"value"			=> array(
		__("Bottom Border", "wpex") => 'one',
		__("Bottom Border With Color", "wpex") => "two",
		__("Line Through", "wpex") => "three",
		__("Double Line Through", "wpex") => "four",
		__("Dotted", "wpex") => "five",
		__("Dashed", "wpex") => "six",
		__("Top & Bottom Borders", "wpex") => "seven",
		__("Graphical", "wpex") => "eight",
		__("Outlined", "wpex") => "nine",
	),
) );

vc_add_param( "vc_text_separator", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Font size (px or em)","wpex"),
	"param_name"	=> "font_size",
	"value"			=> "",
) );

vc_add_param( "vc_text_separator", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __( "Font Weight", 'vcex' ),
	"param_name"	=> "font_weight",
	"value"			=> "",
	"description"	=> __("Enter a custom font weight for your heading (300,400,600,700).", "wpex"),
) );

vc_add_param( "vc_text_separator", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Bottom Margin","wpex"),
	"param_name"	=> "margin_bottom",
	"value"			=> "",
) );

vc_add_param( "vc_text_separator", array(
	"type"			=> "colorpicker",
	"class"			=> "",
	"heading"		=> __("Background Color","wpex"),
	"param_name"	=> "span_background",
	"value"			=> "",
	"description"	=> __("The background color option is used for the background behind the text.","wpex"),
	"dependency" => Array('element'	=> "style", 'value' => array('three','four','five','six'))
) );

vc_add_param( "vc_text_separator", array(
	"type"			=> "colorpicker",
	"class"			=> "",
	"heading"		=> __("Font Color","wpex"),
	"param_name"	=> "span_color",
	"value"			=> "",
) );

/*------------------------------------------------*/
/* Columns
/*------------------------------------------------*/
vc_add_param( "vc_column", array(
	"type"			=> "dropdown",
	"class"			=> "",
	"heading"		=> __("Animation","wpex"),
	"param_name"	=> "css_animation",
	"value"			=> array(
		__("No", "wpex")					=> '',
		__("Top to bottom", "wpex")		=> "top-to-bottom",
		__("Bottom to top", "wpex")		=> "bottom-to-top",
		__("Left to right", "wpex")		=> "left-to-right",
		__("Right to left", "wpex")		=> "right-to-left",
		__("Appear from center", "wpex")	=> "appear" ),
) );
vc_add_param( "vc_column", array(
	"type"			=> "dropdown",
	"class"			=> "",
	"heading"		=> __("Style","wpex"),
	"param_name"	=> "style",
	"value"			=> array(
		__("Default", "wpex") => 'default',
		__("Bordered", "wpex") => "bordered",
		__("Boxed", "wpex") => "boxed",
	),
) );

vc_add_param( "vc_column", array(
	"type"			=> "checkbox",
	"class"			=> "",
	"heading"		=> __("Drop Shadow?","wpex"),
	"param_name"	=> "drop_shadow",
	"value"			=> Array(__("Yes please.", "wpex") => 'yes'),
) );

/*------------------------------------------------*/
/* Tabs
/*------------------------------------------------*/
vc_add_param( "vc_tabs", array(
	"type"			=> "dropdown",
	"class"			=> "",
	"heading"		=> __("Style","wpex"),
	"param_name"	=> "style",
	"value"			=> array(
		__("Default", "wpex")			=> 'default',
		__("Alternative #1", "wpex")	=> "alternative-one",
		__("Alternative #2", "wpex")	=> "alternative-two",
	),
	
) );


/*------------------------------------------------*/
/* Tour
/*------------------------------------------------*/
vc_add_param( "vc_tour", array(
	"type"			=> "dropdown",
	"class"			=> "",
	"heading"		=> __("Style","wpex"),
	"param_name"	=> "style",
	"value"			=> array(
		__("Default", "wpex")			=> 'default',
		__("Alternative #1", "wpex")	=> "alternative-one",
		__("Alternative #2", "wpex")	=> "alternative-two",
	),
	
) );


/*------------------------------------------------*/
/* Rows
/*------------------------------------------------*/
vc_add_param("vc_row", array(
	"type"			=> "checkbox",
	"class"			=> "",
	"heading"		=> __("Center Row Content","wpex"),
	"param_name"	=> "center_row",
	"value"			=> Array(__("Yes please.", "wpex") => 'yes'),
	"description"	=> __("Use this option to center the inner content (Horizontally). Useful when using full-width pages.","wpex")
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Minimum Height","wpex"),
	"param_name"	=> "min_height",
	"value"			=> "",
	"description"	=> __("You can enter a minimum height for this row.","wpex")
));

vc_add_param( "vc_row", array(
	"type"			=> "dropdown",
	"class"			=> "",
	"heading"		=> __("Animation","wpex"),
	"param_name"	=> "css_animation",
	"value"			=> array(
		__("No", "wpex")					=> '',
		__("Top to bottom", "wpex")		=> "top-to-bottom",
		__("Bottom to top", "wpex")		=> "bottom-to-top",
		__("Left to right", "wpex")		=> "left-to-right",
		__("Right to left", "wpex")		=> "right-to-left",
		__("Appear from center", "wpex")	=> "appear" ),
) );

vc_add_param( "vc_row", array(
	"type"			=> "dropdown",
	"class"			=> "",
	"heading"		=> __("Typography Style","wpex"),
	"param_name"	=> "style",
	"value"			=> array(
		__("Dark Text", "wpex")	=> '',
		__("White Text", "wpex")	=> "light",
	)
) );


vc_add_param("vc_row", array(
	"type"			=> "colorpicker",
	"heading"		=> __("Background Color", "wpex"),
	"param_name"	=> "bg_color",
	"value"			=> "",
));


vc_add_param("vc_row", array(
	"type"			=> "attach_image",
	"heading"		=> __("Background Image", "wpex"),
	"param_name"	=> "bg_image",
	"value"			=> "",
	"description"	=> __("Select image from media library.", "wpex")
));

vc_add_param("vc_row", array(
	"type"			=> "dropdown",
	"heading"		=> __("Background Image Style", "wpex"),
	"param_name"	=> "bg_style",
	"value"			=> array(
		__("Stretched", "wpex")	=> 'stretch',
		__("Fixed", "wpex")		=> "fixed",
		__("Parallax", "wpex")	=> "parallax",
		__("Repeat", "wpex")		=> "repeat",
	),
	"dependency" => Array('element'	=> "background_image", 'not_empty' => true )
));

vc_add_param( "vc_row", array(
	"type"			=> 'checkbox',
	"heading"		=> __("Enable Self Hosted Video Background?", "wpex"),
	"param_name"	=> "video_bg",
	"description"	=> __("Check this box to enable the options for a self hosted video background.", "wpex"),
	"value"			=> Array(__("Yes, please", "wpex") => 'yes')
) );

vc_add_param( "vc_row", array(
	"type"			=> 'dropdown',
	"heading"		=> __("Video Background Overlay", "wpex"),
	"param_name"	=> "video_bg_overlay",
	"value"			=> array(
		__("None", "wpex")				=> 'none',
		__("Dark", "wpex")				=> "dark",
		__("Dotted", "wpex")			=> "dotted",
		__("Diagonal Lines", "wpex")	=> "dashed",
	),
	"dependency" => Array('element'	=> "video_bg", 'value' => "yes" ),
) );

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"heading"		=> __("Video URL: MP4 URL", "wpex"),
	"param_name"	=> "video_bg_mp4",
	"value"			=> "",
	"description"	=> __("Enter the URL to a SELF hosted video .mp4 file to create a video background for this row.", "wpex"),
	"dependency" => Array('element'	=> "video_bg", 'value' => "yes" ),
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"heading"		=> __("Video URL: OGV URL", "wpex"),
	"param_name"	=> "video_bg_ogv",
	"value"			=> "",
	"description"	=> __("Enter the URL to a SELF hosted video .webm file to create a video background for this row.", "wpex"),
	"dependency" => Array('element'	=> "video_bg", 'value' => "yes" ),
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"heading"		=> __("Video URL: WEBM URL", "wpex"),
	"param_name"	=> "video_bg_webm",
	"value"			=> "",
	"description"	=> __("Enter the URL to a SELF hosted video .webm file to create a video background for this row.", "wpex"),
	"dependency" => Array('element'	=> "video_bg", 'value' => "yes" ),
));

vc_add_param("vc_row", array(
	"type"			=> "colorpicker",
	"class"			=> "",
	"heading"		=> __("Border Color","wpex"),
	"param_name"	=> "border_color",
	"value" 		=> "",
));

vc_add_param("vc_row", array(
	"type"			=> "dropdown",
	"class"			=> "",
	"heading"		=> __("Border Style","wpex"),
	"param_name"	=> "border_style",
	"value"			=> array(
		__("Solid", "wpex")	=> 'solid',
		__("Dotted", "wpex")	=> "dotted",
		__("Dashed", "wpex")	=> "dashed",
	),
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Border Width","wpex"),
	"param_name"	=> "border_width",
	"value"			=> "",
	"description"	=> __("Your border width. Example: 1px 1px 1px 1px.", "wpex"),
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Margin Top","wpex"),
	"param_name"	=> "margin_top",
	"value"			=> "",
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Margin Bottom","wpex"),
	"param_name"	=> "margin_bottom",
	"value"			=> "",
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Padding Top","wpex"),
	"param_name"	=> "padding_top",
	"value"			=> "",
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Padding Bottom","wpex"),
	"param_name"	=> "padding_bottom",
	"value"			=> "",
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Padding Left","wpex"),
	"param_name"	=> "padding_left",
	"value"			=> "",
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Padding Right","wpex"),
	"param_name"	=> "padding_right",
	"value"			=> "",
));