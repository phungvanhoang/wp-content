<?php
// Register Shortcode -------------------------------------------------------------------------- >
if ( !function_exists('vcex_teaser_shortcode')) {
	function vcex_teaser_shortcode( $atts, $content = NULL ) {
		
		extract( shortcode_atts( array(
				'unique_id'		=> '',
				'heading'			=> __('Sample heading','vcex'),
				'heading_type'		=> 'h2',
				'style'				=> 'one',
				'text_align'		=> 'center',
				'image'				=> '',
				'video'				=> '',
				'url'				=> '',
				'url_target'		=> '',
				'url_rel'			=> '',
				'css_animation'	=> '',
		), $atts ) );
		
		$output = '';
		$css_animation_classes = '';
		if ( $css_animation !== '' ) {
			$css_animation_classes = 'wpb_animate_when_almost_visible wpb_'. $css_animation .'';
		}
		
		// Image Vars
		if ( $image ) {
			$image_img_url = wp_get_attachment_url( $image );
			$image_img = wp_get_attachment_url( $image );
			$image_alt = strip_tags( get_post_meta($image, '_wp_attachment_image_alt', true) );
		}
		
		$output .= '<article class="vcex-teaser vcex-teaser-'. $style .' vcex-text-align-'. $text_align .' '. $css_animation_classes .'">';
			if ( $video ) {
				$output .= '<div class="vcex-teaser-media vcex-video-wrap">'. wp_oembed_get($video) .'</div>';
			}
			if ( $url ) $output .= '<a href="'. $url .'" title="'. $heading .'" class="vcex-teaser-link" target="'. $url_target .'" rel="'. $url_rel .'">';
				if ( $image ) {
					$output .= '<figure class="vcex-teaser-media"><img src="'. $image_img_url .'" alt="'. $image_alt .'" /></figure>';
				}
			$output .= '<div class="vcex-teaser-content clr">';
				$output .= '<'. $heading_type .' class="vcex-teaser-heading">';
					$output .= $heading;
				$output .= '</'. $heading_type .'>';
				if ( $url ) $output .= '</a>';
				$output .= '<div class="vcex-teaser-text clr">';
					$output .= $content;
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</article>';
		
		return $output;
	}
}
add_shortcode( 'vcex_teaser', 'vcex_teaser_shortcode' );




// Add to visual composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Teaser Box", 'vcex' ),
	"base"					=> "vcex_teaser",
	"class"					=> "",
	"category"				=> __( "Content", "wpex" ),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-teaser",
	"params"				=> array(
		array(
			"type"			=> "textarea_html",
			"class"			=> "",
			"holder"		=> "div",
			"heading"		=> __( "Content", 'vcex' ),
			"param_name"	=> "content",
			 "value"		=> __("<p>Pass fremont street bust mandalay bay whale dice. Haze loose full house treasure island shooter vdara royal flush, sixth street betting limits edge vegas givecamp blackjack!</p>", "wpex")
		),
		array(
			"type"			=> "attach_image",
			"heading"		=> __("Image", "wpex"),
			"param_name"	=> "image",
			"value"			=> "",
			"description"	=> __("Select image from media library.", "wpex")
		),
		 array(
			"type" => "textfield",
			"heading" => __("Video link", "wpex"),
			"param_name" => "video",
			"description" => sprintf(__('Link to the video. More about supported formats at %s.', "wpex"), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>')
		),
		array(
		  "type"			=> "dropdown",
		  "heading"		=> __("Style", "wpex"),
		  "param_name"		=> "style",
		  "value"			=> array(
				__("Plain", "wpex")	=> "one",
				__("Boxed 1", "wpex")	=> "two",
				__("Boxed 2", "wpex")	=> "three",
				__("Outline", "wpex")	=> "four",
			)
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
		  "heading"		=> __("Text Align", "wpex"),
		  "param_name"		=> "text_align",
		  "value"			=> array(
				__("Center", "wpex")	=> "center",
				__("Left", "wpex")		=> "left",
				__("Right", "wpex")	=> "right",
			)
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Title", 'vcex' ),
			"param_name"	=> "heading",
			"value"			=> "Sample Heading",
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Heading Type", 'vcex' ),
			"param_name"	=> "heading_type",
			 "value"		=> array(
				__("h2", "wpex")	=> "h2",
				__("h3", "wpex")	=> "h3",
				__("h4", "wpex")	=> "h4",
				__("h5", "wpex")	=> "h5",
			)
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
			 "value"		=> array(
				__("Self", "wpex")		=> "_self",
				__("Blank", "wpex")	=> "_blank",
			),
			"dependency" => Array('element' => "url", 'not_empty' => true),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "URL Rel", 'vcex' ),
			"param_name"	=> "url_rel",
			 "value"		=> array(
				__("None", "wpex")			=> "",
				__("Nofollow", "wpex")	=> "nofollow",
			),
			"dependency" => Array('element' => "url", 'not_empty' => true),
		),
	)
) );
?>