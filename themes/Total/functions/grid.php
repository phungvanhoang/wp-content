<?php
/**
 * Returns the correct grid class based on column number
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/

if ( ! function_exists( 'wpex_grid_class' ) ) {
	function wpex_grid_class($col) {
		$classname = 'span_8';
		if ( $col == '1' ) $classname = 'span_1_of_1';
		if ( $col == '2' ) $classname = 'span_1_of_2';
		if ( $col == '3' ) $classname = 'span_1_of_3';
		if ( $col == '4' ) $classname = 'span_1_of_4';
		if ( $col == '5' ) $classname = 'span_1_of_5';
		if ( $col == '6' ) $classname = 'span_1_of_6';
		if ( $col == '7' ) $classname = 'span_1_of_7';
		if ( $col == '8' ) $classname = 'span_1_of_8';
		if ( $col == '9' ) $classname = 'span_1_of_9';
		if ( $col == '10' ) $classname = 'span_1_of_10';
		if ( $col == '11' ) $classname = 'span_1_of_11';
		if ( $col == '12' ) $classname = 'span_1_of_12';
		return $classname;
	}
}