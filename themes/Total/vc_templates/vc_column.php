<?php
$output = $el_class = $width = '';
extract(shortcode_atts(array(
    'el_class'			=> '',
    'width'			=> '1/1',
    'css_animation'	=> '',
	'style'				=> '',
	'drop_shadow'		=> '',
), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);

$css_animation_class = $css_animation !=='' ? 'wpb_animate_when_almost_visible wpb_'. $css_animation .'' : '';

if ( $style !== 'default' && $style !== '' ) {
	$el_class .= ' '. $style .'-column';
}

if ( $drop_shadow == 'yes' ) {
	$el_class .= ' column-dropshadow';
}

$el_class .= ' wpb_column column_container '.$css_animation_class;

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class, $this->settings['base']);
$output .= "\n\t".'<div class="'.$css_class.'">';
//$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
//$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;