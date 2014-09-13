<?php
/**
 * This file is used for all the styling options in the admin
 * All custom color options are output to the <head> tag
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */


if ( is_admin() ) return; // We don't need this in the admin

add_action('wp_head', 'wpex_styling_css');

if ( !function_exists( 'wpex_styling_css' ) ) {
	
	function wpex_styling_css() {
	
		$custom_css ='';
		$header_style = wpex_option( 'header_style' );	
		
		if ( wpex_option( 'custom_styling', '1' ) !== '1' ) return;
			
		// Link
		$link_color = wpex_option( 'link_color' );
		if ( $link_color !== '' ) {
			$custom_css .= 'body a { color: '. $link_color .'; }h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover{color: '. $link_color .' !important;}';
		}
		
		// Theme Button
		$theme_button_bg = wpex_option( 'theme_button_bg' );
		if ( !empty($theme_button_bg) ) {
			$from=$to='';
			$from = $theme_button_bg['from'];
			$to = $theme_button_bg['to'];
			if ( $from || $to ) {
				$custom_css .= '.edit-post-link a, #commentform #submit, .wpcf7 .wpcf7-submit, #comments .comment-reply-link, .theme-button, .readmore-link, #current-shop-items .buttons a, .woocommerce .button, .vcex-filter-links li a:hover, .vcex-filter-links li.active a, .page-numbers a:hover, .page-numbers.current, .page-numbers.current:hover, input[type="submit"] { background: '. $to .'; background: -webkit-linear-gradient('. $from .','. $to .');background: -moz-linear-gradient('. $from .','. $to .');background: -o-linear-gradient('. $from .','. $to .');background: linear-gradient('. $from .','. $to .');}';
			}
		}
		
		$theme_button_color = wpex_option( 'theme_button_color' );
		if ( $theme_button_color !== '' ) {
			$custom_css .= '.edit-post-link a, #commentform #submit, .wpcf7 .wpcf7-submit, #comments .comment-reply-link, .theme-button, .readmore-link, #current-shop-items .buttons a, .woocommerce .button, input[type="submit"] { color: '. $theme_button_color .' !important; }';
		}
		
		$theme_button_hover_bg = wpex_option( 'theme_button_hover_bg' );
		if ( !empty($theme_button_hover_bg) ) {
			$from=$to='';
			$from = $theme_button_hover_bg['from'];
			$to = $theme_button_hover_bg['to'];
			if ( $from || $to ) {
				$custom_css .= '.edit-post-link a:hover, #commentform #submit:hover, .wpcf7 .wpcf7-submit:hover, #comments .comment-reply-link:hover, .theme-button:hover, .readmore-link:hover, #current-shop-items .buttons a:hover, .woocommerce .button:hover, input[type="submit"]:hover { background: '. $to .'; background: -webkit-linear-gradient('. $from .','. $to .');background: -moz-linear-gradient('. $from .','. $to .');background: -o-linear-gradient('. $from .','. $to .');background: linear-gradient('. $from .','. $to .');}';
			}
		}
		
		$theme_button_hover_color = wpex_option( 'theme_button_hover_color' );
		if ( $theme_button_hover_color !== '' ) {
			$custom_css .= '.edit-post-link a:hover, #commentform #submit:hover, .wpcf7 .wpcf7-submit:hover, #comments .comment-reply-link:hover, .theme-button:hover, .readmore-link:hover, #current-shop-items .buttons a:hover, .woocommerce .button:hover, input[type="submit"]:hover { color: '. $theme_button_hover_color .' !important; }';
		}
		
		// Header BG
		$header_background = wpex_option( 'header_background' );
		if ( $header_background !== '' ) {
			$custom_css .= '#site-header { background: '. $header_background .'; }.is-sticky #site-header { border-bottom: 0; }';
		}
		
		// Logo
		$logo_color = wpex_option( 'logo_color' );
		if ( $logo_color !== '' ) {
			$custom_css .= '#site-logo a { color:'. $logo_color .'; }';
		}			
		
		// Menu Background
		$menu_background = wpex_option('menu_background');
		if ( $menu_background !== '' ) {
			$custom_css .= '#site-navigation-wrap { background:'. $menu_background .'; }';
		}
		
		// Menu Borders
		$menu_borders = wpex_option('menu_borders');
		if ( $menu_borders !== '' ) {
			$custom_css .= '#site-navigation li, #site-navigation a, #site-navigation { border-color:'. $menu_borders .'; }';
		}
		
		// Menu Link Color
		$menu_color = wpex_option( 'menu_link_color' );
		$menu_color_regular=$menu_color_hover=$menu_color_active='';
		if ( isset($menu_color['regular']) ) {
			$menu_color_regular = $menu_color['regular'];
		}
		if ( isset($menu_color['hover']) ) {
			$menu_color_hover = $menu_color['hover'];
		}
		if ( isset($menu_color['active']) ) {
			$menu_color_active = $menu_color['active'];
		}
		if ( $menu_color_regular ) {
			$custom_css .= '#site-navigation .dropdown-menu > li > a { color:'. $menu_color_regular .'; }';
		}
		if ( $menu_color_hover ) {
			$custom_css .= '#site-navigation .dropdown-menu > li > a:hover { color:'. $menu_color_hover .'; }';
		}
		if ( $menu_color_active ) {
			$custom_css .= '#site-navigation .dropdown-menu > .current-menu-item > a, #site-navigation .dropdown-menu > .current-menu-item > a:hover { color:'. $menu_color_active .'; }';
		}
		
		// Menu hover bg
		$menu_link_hover_background = wpex_option( 'menu_link_hover_background' );
		if ( $menu_link_hover_background !== '' && $header_style !== 'one' ) {
			$custom_css .= '#site-navigation .dropdown-menu > li > a:hover { background:'. $menu_link_hover_background .'; }';
		}
		
		// Menu Active
		$menu_link_active_background = wpex_option( 'menu_link_active_background' );
		if ( $menu_link_active_background !== '' && $header_style !== 'one' ) {
			$custom_css .= '#site-navigation .dropdown-menu > .current-menu-item > a { background:'. $menu_link_active_background .'; }';
		}

		// Dropdown bg
		$dropdown_menu_background = wpex_option( 'dropdown_menu_background' );
		if ( $dropdown_menu_background ) {
			$custom_css .= '#site-navigation .dropdown-menu ul { background:'. $dropdown_menu_background .'; } .navbar-style-one .dropdown-menu ul:after { border-bottom-color: '. $dropdown_menu_background .';}';
		}
		
		// Dropdown borders
		$dropdown_menu_borders = wpex_option( 'dropdown_menu_borders' );
		if ( $dropdown_menu_borders !== '' ) {
			$custom_css .= '#site-navigation .dropdown-menu ul { border-color: '. $dropdown_menu_borders .'; }.navbar-style-one .dropdown-menu ul:before, #site-navigation .dropdown-menu ul li, #site-navigation .dropdown-menu ul li a { border-bottom-color: '. $dropdown_menu_borders .';}';
		}
		
		// Dropdown color
		$dropdown_menu_link_color = wpex_option( 'dropdown_menu_link_color' );
		$dropdown_menu_color_regular=$dropdown_menu_color_hover=$dropdown_menu_color_active='';
		if ( isset($dropdown_menu_link_color['regular']) ) {
			$dropdown_menu_color_regular = $dropdown_menu_link_color['regular'];
		}
		if ( isset($dropdown_menu_link_color['hover']) ) {
			$dropdown_menu_color_hover = $dropdown_menu_link_color['hover'];
		}
		if ( isset($dropdown_menu_link_color['active']) ) {
			$dropdown_menu_color_active = $dropdown_menu_link_color['active'];
		}
		if ( $dropdown_menu_color_regular ) {
			$custom_css .= '#site-navigation .dropdown-menu ul > li > a { color:'. $dropdown_menu_color_regular .'; }';
		}
		if ( $dropdown_menu_color_hover ) {
			$custom_css .= '#site-navigation .dropdown-menu ul > li > a:hover { color:'. $dropdown_menu_color_hover .'; }';
		}
		if ( $dropdown_menu_color_active ) {
			$custom_css .= '#site-navigation .dropdown-menu ul > .current-menu-item > a { color:'. $dropdown_menu_color_active .'; }';
		}


		// Dropdown color hover bg
		$dropdown_menu_link_hover_bg = wpex_option( 'dropdown_menu_link_hover_bg' );
		if ( !empty($dropdown_menu_link_hover_bg) ) {
			$from=$to='';
			$from = $dropdown_menu_link_hover_bg['from'];
			$to = $dropdown_menu_link_hover_bg['to'];
			if ( $from || $to ) {
				$custom_css .= '#site-navigation .dropdown-menu ul > li > a:hover { background: '. $to .'; background: -webkit-linear-gradient('. $from .','. $to .');background: -moz-linear-gradient('. $from .','. $to .');background: -o-linear-gradient('. $from .','. $to .');background: linear-gradient('. $from .','. $to .');}';
			}
		}
		
		// Shop Button
		$shop_background = wpex_option( 'shop_button_background' );
		if ( !empty ( $shop_background ) ) {
			$from=$to='';
			$from = $shop_background['from'];
			$to = $shop_background['to'];
			if ( $from || $to ) {
				$custom_css .= '.header-one .dropdown-menu .wcmenucart, .header-one .dropdown-menu .wcmenucart:hover, .header-one .dropdown-menu .wcmenucart:active { background: '. $to .'; background: -webkit-linear-gradient('. $from .','. $to .');background: -moz-linear-gradient('. $from .','. $to .');background: -o-linear-gradient('. $from .','. $to .');background: linear-gradient('. $from .','. $to .'); border-color: rgba(0,0,0,0.15); }';
			}
		}
		
		$shop_color = wpex_option( 'shop_button_color' );
		if ( $shop_color ) {
			$custom_css .= '.header-one .dropdown-menu .wcmenucart, .header-one .dropdown-menu .wcmenucart:hover, .header-one .dropdown-menu .wcmenucart:active { color: '. $shop_color .' !important; }';
		}
		
		
		// Search Button
		$search_button_background = wpex_option( 'search_button_background' );
		if ( !empty ( $search_button_background ) ) {
			$from=$to='';
			$from = $search_button_background['from'];
			$to = $search_button_background['to'];
			if ( $from || $to ) {
				$custom_css .= '.site-search-toggle, .site-search-toggle:hover, .site-search-toggle:active{ background: '. $to .'; background: -webkit-linear-gradient('. $from .','. $to .');background: -moz-linear-gradient('. $from .','. $to .');background: -o-linear-gradient('. $from .','. $to .');background: linear-gradient('. $from .','. $to .'); border-color: rgba(0,0,0,0.15);-webkit-box-shadow: inset 0 1px 1px rgba(255,255,255,0.5), 0 1px 3px -1px rgba(45,60,72,0.1);-moz-box-shadow: inset 0 1px 1px rgba(255,255,255,0.5), 0 1px 3px -1px rgba(45,60,72,0.1); box-shadow: inset 0 1px 1px rgba(255,255,255,0.5), 0 1px 3px -1px rgba(45,60,72,0.1); }';
			}
		}
		
		$search_button_color = wpex_option( 'search_button_color' );
		if ( $search_button_color ) {
			$custom_css .= '.site-search-toggle, .site-search-toggle:hover, .site-search-toggle:active{ color: '. $search_button_color .' !important; }';
		}
		
		// Sidebar bg
		$sidebar_background = wpex_option( 'sidebar_background' );
		if ( $sidebar_background ) {
			$custom_css .= '#sidebar { background:'. $sidebar_background .'; }';
		}
		
		// Sidebar link color
		$sidebar_link_color = wpex_option( 'sidebar_link_color' );
		$regular=$hover=$active='';
		if ( isset($sidebar_link_color['regular']) ) {
			$regular = $sidebar_link_color['regular'];
		}
		if ( isset($sidebar_link_color['hover']) ) {
			$hover = $sidebar_link_color['hover'];
		}
		if ( isset($sidebar_link_color['active']) ) {
			$active = $sidebar_link_color['active'];
		}
		if ( $regular ) {
			$custom_css .= '#sidebar a{ color:'. $regular .'; }';
		}
		if ( $hover ) {
			$custom_css .= '#sidebar a:hover { color:'. $hover .'; }';
		}
		if ( $active ) {
			$custom_css .= '#sidebar a:active { color:'. $active .'; }';
		}

		
		// Footer bg
		$footer_background = wpex_option( 'footer_background' );
		if ( $footer_background ) {
			$custom_css .= '#footer { background:'. $footer_background .'; }';
		}
		
		// Footer color
		$footer_color = wpex_option( 'footer_color' );
		if ( $footer_color !== '' ) {
			$custom_css .= '#footer, #footer p { color:'. $footer_color .'; }';
		}
		
		// Footer headings
		$footer_headings_color = wpex_option( 'footer_headings_color' );
		if ( $footer_headings_color !== '' ) {
			$custom_css .= '#footer .widget-title { color:'. $footer_headings_color .'; }';
		}
		
		// Footer borders
		$footer_borders = wpex_option( 'footer_borders' );
		if ( $footer_borders !== '' ) {
			$custom_css .= '#footer li,#footer #wp-calendar thead th,#footer #wp-calendar tbody td { border-color:'. $footer_borders .'; }';
		}

		
		// Footer link color
		$footer_link_color = wpex_option( 'footer_link_color' );
		$regular=$hover=$active='';
		if ( isset($footer_link_color['regular']) ) {
			$regular = $footer_link_color['regular'];
		}
		if ( isset($footer_link_color['hover']) ) {
			$hover = $footer_link_color['hover'];
		}
		if ( isset($footer_link_color['active']) ) {
			$active = $footer_link_color['active'];
		}
		if ( $regular ) {
			$custom_css .= '#footer a { color:'. $regular .'; }';
		}
		if ( $hover ) {
			$custom_css .= '#footer a:hover { color:'. $hover .'; }';
		}
		if ( $active ) {
			$custom_css .= '#footer a:active { color:'. $active .'; }';
		}
		
		
		// Bottom Footer bg
		$bottom_footer_background = wpex_option( 'bottom_footer_background' );
		if ( $bottom_footer_background ) {
			$custom_css .= '#footer-bottom { background:'. $bottom_footer_background .'; }';
		}
		
		// Bottom Footer color
		$bottom_footer_color = wpex_option( 'bottom_footer_color' );
		if ( $bottom_footer_color !== '' ) {
			$custom_css .= '#footer-bottom, #footer-bottom p { color:'. $bottom_footer_color .'; }';
		}
		
		// Bottom Footer link color
		$bottom_footer_link_color = wpex_option( 'bottom_footer_link_color' );
		$regular=$hover=$active='';
		if ( isset($bottom_footer_link_color['regular']) ) {
			$regular = $bottom_footer_link_color['regular'];
		}
		if ( isset($bottom_footer_link_color['hover']) ) {
			$hover = $bottom_footer_link_color['hover'];
		}
		if ( isset($bottom_footer_link_color['active']) ) {
			$active = $bottom_footer_link_color['active'];
		}
		if ( $regular ) {
			$custom_css .= '#footer-bottom a { color:'. $regular .'; }';
		}
		if ( $hover ) {
			$custom_css .= '#footer-bottom a:hover { color:'. $hover .'; }';
		}
		if ( $active ) {
			$custom_css .= '#footer-bottom a:active { color:'. $active .'; }';
		}
		
		
		// Footer Callout Button
		$footer_callout_button_bg = wpex_option( 'footer_callout_button_bg' );
		if ( !empty($footer_callout_button_bg) ) {
			$from=$to='';
			$from = $footer_callout_button_bg['from'];
			$to = $footer_callout_button_bg['to'];
			if ( $from || $to ) {
				$custom_css .= '#footer-callout .theme-button { background: '. $to .'; background: -webkit-linear-gradient('. $from .','. $to .');background: -moz-linear-gradient('. $from .','. $to .');background: -o-linear-gradient('. $from .','. $to .');background: linear-gradient('. $from .','. $to .');}';
			}
		}
		
		
		// Shop Onsale
		$onsale_bg = wpex_option( 'onsale_bg' );
		if ( !empty($onsale_bg) ) {
			$from=$to='';
			$from = $onsale_bg['from'];
			$to = $onsale_bg['to'];
			if ( $from || $to ) {
				$custom_css .= 'ul.products li.product .onsale, .single-product .onsale { background: '. $to .'; background: -webkit-linear-gradient('. $from .','. $to .');background: -moz-linear-gradient('. $from .','. $to .');background: -o-linear-gradient('. $from .','. $to .');background: linear-gradient('. $from .','. $to .');}';
			}
		}
		
		// Add some padding to search icon when woo icon is disabled
		if ( wpex_option('woo_menu_icon','1') !== '1' ) {
			if ( wpex_option('main_search','1') == '1' ) {
				$custom_css .= '#site-navigation-wrap .site-navigation-with-search { padding-right: 50px; }';
			}
		}
		
		// trim white space for faster page loading
		$custom_css_trimmed =  preg_replace( '/\s+/', ' ', $custom_css );
		
		// output css on front end
		$css_output = "<!-- Custom CSS -->\n<style type=\"text/css\">\n" . $custom_css_trimmed . "\n</style>";
		if( !empty($custom_css) ) {
			echo $css_output;
		}
		
	}
	
}