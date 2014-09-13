<?php
$output = $el_class = '';
extract(shortcode_atts(array(
	'el_class'			=> '',
	'css_animation'	=> '',
	'center_row'		=> '',
	'min_height'		=> '',
	'style'				=> '',
	'bg_color'			=> '',
	'bg_image'			=> '',
	'bg_style'			=> '',
	'border_color'		=> '',
	'border_style'		=> '',
	'border_width'		=> '',
	'margin_top'		=> '',
	'margin_bottom'	=> '',
	'padding_top'		=> '',
	'padding_bottom'	=> '',
	'padding_left'		=> '',
	'padding_right'	=> '',
	'border'			=> '',
	'video_bg'			=> '',
	'video_bg_mp4'		=> '',
	'video_bg_ogv'		=> '',
	'video_bg_webm'	=> '',
	'video_bg_overlay'	=> 'dashed-overlay',
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

// Animation
$css_animation_class = $css_animation !=='' ? 'wpb_animate_when_almost_visible wpb_'. $css_animation .'' : '';

// Load parallax js
if ( $bg_style == 'parallax' && $bg_image ) {
	 wp_enqueue_script( 'vcex_parallax' );
}

// VCEX Background class
if ( $bg_style && $bg_image ) {
	$bg_style_class = 'vcex-background-'. $bg_style;
} else {
	$bg_style_class = '';
}

// Style tag for background, padding, margin
$add_style = array();

	if ( $min_height ) {
		$add_style[] = 'min-height: '. $min_height .';';
	}

	if ( $bg_image ) {
		$img_url = wp_get_attachment_url($bg_image);
		$add_style[] = 'background-image: url('. $img_url .');';
	}
	
	if ( $bg_color ) {
		$add_style[] = 'background-color: '. $bg_color .';';
	} 
	
	if ( $border_color && $border_style && $border_width ) {
		$add_style[] = 'border-color: '. $border_color .';';
		$add_style[] = 'border-style: '. $border_style .';';
		$add_style[] = 'border-width: '. $border_width .';';
	}
	
	if ( $margin_top ) {
		$add_style[] = 'margin-top: ' . intval($margin_top) . 'px;';
	}
	
	if ( $margin_bottom ) {
		$add_style[] = 'margin-bottom: ' . intval($margin_bottom) . 'px;';
	}
	
	if ( $padding_top ) {
		$add_style[] = 'padding-top: ' . intval($padding_top) . 'px;';
	}
	
	if ( $padding_bottom ) {
		$add_style[] = 'padding-bottom: ' . intval($padding_bottom) . 'px;';
	}
	
	if ( $padding_left ) {
		$add_style[] = 'padding-left: ' . intval($padding_left) . 'px;';
	}
	
	if ( $padding_right ) {
		$add_style[] = 'padding-right: ' . intval($padding_right) . 'px;';
	}

$add_style = implode('', $add_style);

if ( $add_style ) {
	$add_style = wp_kses( $add_style, array() );
	$add_style = ' style="' . esc_attr($add_style) . '"';
}

// Center row
if ( $center_row == 'yes' ) {
	$center_row_class = 'container';
} else {
	$center_row_class = '';
}

// Main VC class
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $this->settings['base']);

// Open wrap for video bgs
if ( $video_bg == 'yes' ) {
	$output .= '<div class="vcex-video-bg-wrap clr">';
}

	// Open background area div
	if ( $bg_image || $bg_color ) {
		$output .= '<div class="'. $bg_style_class .' vcex-row-bg-container vcex-row-skin-'. $style .'" '. $add_style .'>';
	} else {
		$output .= '<div class="clr vcex-row-skin-'. $style .'" '. $add_style .'>';
	}

	// Open VC Row
	$output .= '<div class="'.$css_class.' '. $css_animation_class .' '. $center_row_class .'">';
		// The Inner Row
		$output .= wpb_js_remove_wpautop($content);
	// Close VC Row
	$output .= '</div>'.$this->endBlockComment('row');
	
	// Video Background
	if ( $video_bg == 'yes' ) {
		$output .= '<video class="vcex-video-bg" poster="'. $bg_image .'" preload="auto" autoplay="true" loop="loop" muted volume="0">';
			if ( $video_bg_webm !== '' ) {
				$output .= '<source src="'. $video_bg_webm .'" type="video/webm"/>';
			}
			if ( $video_bg_ogv !== '' ) {
				$output .= '<source src="'. $video_bg_ogv .'" type="video/ogg ogv" />';
			}
			if ( $video_bg_mp4 !== '' ) {
				$output .= '<source src="'. $video_bg_mp4 .'" type="video/mp4"/>';	
			}
		$output .= '</video>';
		if ( $video_bg_overlay !== 'none' ) {
			$output .= '<span class="vcex-video-bg-overlay '. $video_bg_overlay .'-overlay"></span>';	
		}
	}

	// Close background area div
	$output .= '</div>';
	
// Close video bg wrap
if ( $video_bg == 'yes' ) {
	$output .= '</div>';
}

echo $output;