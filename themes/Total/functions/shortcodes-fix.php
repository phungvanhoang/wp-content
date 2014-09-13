<?php
/**
 * Fixes spacing issues with shortcodes
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/

if( !function_exists('vcex_fix_shortcodes') ) {
	function vcex_fix_shortcodes($content){   
		$array = array (
			'<p>['		=> '[', 
			']</p>'		=> ']', 
			']<br />'	=> ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
}
add_filter('the_content', 'vcex_fix_shortcodes');