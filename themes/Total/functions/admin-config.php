<?php

/**
	ReduxFramework Sample Config File
	For full documentation, please visit http://reduxframework.com/docs/
**/


/** 
	Most of your editing will be done in this section.
	Here you can override default values, uncomment args and change their values.
	No $args are required, but they can be overridden if needed.
	
**/
$args = array();


// For use with a tab example below
$tabs = array();


// BEGIN Sample Config

// Setting dev mode to true allows you to view the class settings/info in the panel.
// Default: true
$args['dev_mode'] = false;

// Set the icon for the dev mode tab.
// If $args['icon_type'] = 'image', this should be the path to the icon.
// If $args['icon_type'] = 'iconfont', this should be the icon name.
// Default: info-sign
//$args['dev_mode_icon'] = 'info-sign';

// Set the class for the dev mode tab icon.
// This is ignored unless $args['icon_type'] = 'iconfont'
// Default: null
//args['dev_mode_icon_class'] = 'el-icon-large';

// Set a custom option name. Don't forget to replace spaces with underscores!
$args['opt_name'] = 'wpex_options';

// Setting system info to true allows you to view info useful for debugging.
// Default: false
//$args['system_info'] = false;

// Theme Panel Main Display Name
$args['display_name'] = __('Theme Options Panel','wpex');
$args['display_version'] = false;

// If you want to use Google Webfonts, you MUST define the api key.
$args['google_api_key'] = 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII';

// Define the starting tab for the option panel.
// Default: '0';
$args['last_tab'] = '0';

// Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
// If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
// If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
// Default: 'standard'
$args['admin_stylesheet'] = 'standard';

// Enable the import/export feature.
// Default: true
//$args['show_import_export'] = false;

// Set the icon for the import/export tab.
// If $args['icon_type'] = 'image', this should be the path to the icon.
// If $args['icon_type'] = 'iconfont', this should be the icon name.
// Default: refresh
//$args['import_icon'] = 'refresh';

// Set the class for the import/export tab icon.
// This is ignored unless $args['icon_type'] = 'iconfont'
// Default: null
$args['import_icon_class'] = 'el-icon-large';

// Set a custom menu icon.
$args['menu_icon'] = get_template_directory_uri() .'/images/icons/admin.png';

// Set a custom title for the options page.
// Default: Options
$args['menu_title'] = __('Theme Options', 'wpex');

// Set a custom page title for the options page.
// Default: Options
$args['page_title'] = __('Theme Options', 'wpex');

// Set a custom page slug for options page (wp-admin/themes.php?page=***).
// Default: redux_options
$args['page_slug'] = 'wpex_options';

// Show Default
$args['default_show'] = false;

// Default Mark
$args['default_mark'] = '';

// Set a custom page capability.
// Default: manage_options
//$args['page_cap'] = 'manage_options';

// Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
// Default: menu
//$args['page_type'] = 'submenu';

// Set the parent menu.
// Default: themes.php
// A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'options_general.php';

// Set a custom page location. This allows you to place your menu where you want in the menu order.
// Must be unique or it will override other items!
// Default: null
//$args['page_position'] = null;

// Set a custom page icon class (used to override the page icon next to heading)
$args['page_icon'] = 'icon-themes';

// Set the icon type. Set to "iconfont" for Elusive Icon, or "image" for traditional.
// Redux no longer ships with standard icons!
// Default: iconfont
//$args['icon_type'] = 'image';

// Disable the panel sections showing as submenu items.
// Default: true
//$args['allow_sub_menu'] = false;

// Set the help sidebar for the options page.                                        
//$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'wpex');

// Add content after the form.
$args['footer_text'] = "";

// Set footer/credit line.
$args['footer_credit'] = "";

// Declare sections array
$sections = array();



// General -------------------------------------------------------------------------- >	
$sections[] = array(
	'title' => __('General', 'wpex'),
	'header' => __('Welcome to the Simple Options Framework Demo', 'wpex'),
	'desc' => '',
	'icon_class' => 'el-icon-large',
	'icon' => 'el-icon-cog',
	'submenu' => true,
	'fields' => array(
	
		array(
			'id'=>'theme_branding',
			'url'=> true,
			'type' => 'text', 
			'title' => __('Theme Branding', 'wpex'),
			'default' => 'Total',
			'subtitle' => __('Enter your custom name to rebrand your theme. This string is used in situations such as the customw widget titles.', 'wpex'),
		),
		
		array(
			'id'=>'custom_logo',
			'url'=> true,
			'type' => 'media', 
			'title' => __('Logo', 'wpex'),
			'default' => array( 'url' => get_template_directory_uri() .'/images/logo/logo.png' ),
			'subtitle' => __('Upload your custom site logo.', 'wpex'),
		),
		
		array(
			'id'=>'retina_logo',
			'url'=> true,
			'type' => 'media', 
			'title' => __('Retina Logo', 'wpex'),
			'default' => array( 'url' => get_template_directory_uri() .'/images/logo/logo-retina.png' ),
			'subtitle' => __('Upload your retina logo (optional).', 'wpex'),
		),
		
		array(
			'id'=>'retina_logo_height',
			'type' => 'text', 
			'default' => '90px',
			'title' => __('Standard Logo Height', 'wpex'),
			'subtitle' => __('Enter your standard logo height. Used for retina logo.', 'wpex'),
		),
		
		array(
			'id'=>'retina_logo_width',
			'type' => 'text', 
			'default' => '40px',
			'title' => __('Standard Logo Width', 'wpex'),
			'subtitle' => __('Enter your standard logo width. Used for retina logo.', 'wpex'),
		),
		
		array(
			'id'=>'favicon',
			'url'=> true,
			'type' => 'media', 
			'title' => __('Favicon', 'wpex'),
			'default' => array( 'url' => get_template_directory_uri() .'/images/favicons/favicon.png' ),
			'subtitle' => __('Upload your custom site favicon.', 'wpex'),
		),
		
		array(
			'id'=>'iphone_icon',
			'url'=> true,
			'type' => 'media', 
			'title' => __('Apple iPhone Icon ', 'wpex'),
			'default' => array( 'url' => get_template_directory_uri() .'/images/favicons/apple-touch-icon.png' ),
			'subtitle' => __('Upload your custom iPhone icon (57px by 57px).', 'wpex'),
		),
		
		array(
			'id'=>'iphone_icon_retina',
			'url'=> true,
			'type' => 'media', 
			'title' => __('Apple iPhone Retina Icon ', 'wpex'),
			'default' => array( 'url' => get_template_directory_uri() .'/images/favicons/apple-touch-icon-114x114.png' ),
			'subtitle' => __('Upload your custom iPhone retina icon (114px by 114px).', 'wpex'),
		),
		
		array(
			'id'=>'ipad_icon',
			'url'=> true,
			'type' => 'media', 
			'title' => __('Apple iPad Icon ', 'wpex'),
			'default' => array( 'url' => get_template_directory_uri() .'/images/favicons/apple-touch-icon-72x72.png' ),
			'subtitle' => __('Upload your custom iPad icon (72px by 72px).', 'wpex'),
		),
		
		array(
			'id'=>'ipad_icon_retina',
			'url'=> true,
			'type' => 'media', 
			'title' => __('Apple iPad Retina Icon ', 'wpex'),
			'default' => array( 'url' => get_template_directory_uri() .'/images/favicons/apple-touch-icon-114x114.png' ),
			'subtitle' => __('Upload your custom iPad retina icon (144px by 144px).', 'wpex'),
		),
		
		array(
			'id'=>'tracking',
			'type' => 'textarea',      
			'title' => __('Tracking Code', 'wpex'), 
			'subtitle' => __('Paste your Google Analytics javascript or other tracking code here. This code will be added before the closing <head> tag.', 'wpex'),
			'desc' => "",
			'default' => ""
		),
		
	),
);


// Layout -------------------------------------------------------------------------- >	
$sections[] = array(
	'title' => __('Layout', 'wpex'),
	'header' => '',
	'desc' => '',
	'icon_class' => 'el-icon-large',
    'icon' => 'el-icon-website',
    'submenu' => true,
	'fields' => array(
	
		array(
			'id'=>'main_layout_style',
			'type' => 'button_set',
			'title' => __('Layout Style', 'wpex'), 
			'subtitle' => __('Select your website layout style.', 'wpex'),
			'desc' => "",
			'options' => array('full_width' => __('Full Width','wpex'), 'boxed' => __('Boxed','wpex') ),
			'default' => 'full_width'
		),
		
		array(
			'id'=>'main_container_width',
			'type' => 'text',
			'title' => __('Main Container Width', 'wpex'),
			'subtitle' => __('Enter your custom main container width in pixels.', 'wpex'),
			'desc' => "",
			'default' => '980px',
			'class' => 'small-text'
		),
		
		array(
			'id'=>'left_container_width',
			'type' => 'text',
			'title' => __('Left Container Width', 'wpex'),
			'subtitle' => __('Enter your width in pixels or percentage for your left container.', 'wpex'),
			'desc' => "",
			'default' => '680px',
			'class' => 'small-text'
		),
		
		array(
			'id'=>'sidebar_width',
			'type' => 'text',
			'title' => __('Sidebar Width', 'wpex'),
			'subtitle' => __('Enter your width in pixels or percentage for your sidebar.', 'wpex'),
			'desc' => "",
			'default' => '250px',
			'class' => 'small-text'
		),
			
	),
);



// Responsive -------------------------------------------------------------------------- >	
$sections[] = array(
	'title' => __('Responsive', 'wpex'),
	'header' => '',
	'desc' => '',
	'icon_class' => 'el-icon-large',
    'icon' => 'el-icon-resize-small',
    'submenu' => true,
	'fields' => array(
	
		array(
			'id'=>'responsive',
			'type' => 'switch', 
			'title' => __('Responsive', 'wpex'),
			'subtitle'=> __('Enable this option to make your theme compatible with smart phones and tablets.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'custom_mobile_widths',
			'type' => 'switch', 
			'title' => __('Custom Responsive Widths', 'wpex'),
			'subtitle'=> __('Use this option to toggle the custom responsive widths below on or off. Good for testing purposes.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'tablet_main_container_width',
			'type' => 'text',
			'title' => __('Tablet: Main Container Width', 'wpex'),
			'subtitle' => __('Enter your custom main container width in pixels.', 'wpex'),
			'desc' => "",
			'default' => '700px',
			'class' => 'small-text',
			'required' => array('custom_mobile_widths','equals','1'),
		),
		
		array(
			'id'=>'tablet_left_container_width',
			'type' => 'text',
			'title' => __('Tablet: Left Container Width', 'wpex'),
			'subtitle' => __('Enter your width in pixels or percentage for your left container.', 'wpex'),
			'desc' => "",
			'default' => '440px',
			'class' => 'small-text',
			'required' => array('custom_mobile_widths','equals','1'),
		),
		
		array(
			'id'=>'tablet_sidebar_width',
			'type' => 'text',
			'title' => __('Tablet: Sidebar Width', 'wpex'),
			'subtitle' => __('Enter your width in pixels or percentage for your sidebar.', 'wpex'),
			'desc' => "",
			'default' => '220px',
			'class' => 'small-text',
			'required' => array('custom_mobile_widths','equals','1'),
		),
		
		array(
			'id'=>'mobile_landscape_main_container_width',
			'type' => 'text',
			'title' => __('Mobile Landscape: Main Container Width', 'wpex'),
			'subtitle' => __('Enter your custom main container width in pixels.', 'wpex'),
			'default' => "480px",
			'class' => 'small-text',
			'required' => array('custom_mobile_widths','equals','1'),
		),
						
		array(
			'id'=>'mobile_portrait_main_container_width',
			'type' => 'text',
			'title' => __('Mobile Portrait: Main Container Width', 'wpex'),
			'subtitle' => __('Enter your custom main container width in pixels.', 'wpex'),
			'default' => '90%',
			'class' => 'small-text',
			'required' => array('custom_mobile_widths','equals','1'),
		),
			
	),
);


// Background -------------------------------------------------------------------------- >	

//Patterns Reader
$bg_patterns_path = get_template_directory() . '/images/patterns/';
$bg_patterns_url  = get_template_directory_uri() . '/images/patterns/';
$bg_patterns      = array();

if ( is_dir( $bg_patterns_path ) ) :
        
  if ( $bg_patterns_dir = opendir( $bg_patterns_path ) ) :
          $bg_patterns = array();

    while ( ( $bg_patterns_file = readdir( $bg_patterns_dir ) ) !== false ) {

      if( stristr( $bg_patterns_file, '.png' ) !== false || stristr( $bg_patterns_file, '.jpg' ) !== false ) {
              $name = explode(".", $bg_patterns_file);
              $name = str_replace('.'.end($name), '', $bg_patterns_file);
              $bg_patterns[] = array( 'alt'=>$name,'img' => $bg_patterns_url . $bg_patterns_file );
      }
    }
  endif;
endif;

$sections[] = array(
	'title' => __('Background', 'wpex'),
	'header' => '',
	'desc' => '',
	'icon_class' => 'el-icon-large',
    'icon' => 'el-icon-picture',
    'submenu' => true,
	'fields' => array(
	
		array(
			'id'=>'background_color',
			'transparent' => false,
			'type' => 'color', 
			'title' => __('Background Color', 'wpex'),
			'default' => '',
			'subtitle' => __('Select your custom background color.', 'wpex'),
		),
		
		array(
			'id'=>'background_image_toggle',
			'type' => 'switch', 
			'title' => __('Background Image', 'wpex'),
			'subtitle'=> __('Toggle the custom background image option on/off.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
	
		array(
			'id'=>'background_image',
			'url'=> true,
			'type' => 'media', 
			'required' => array('background_image_toggle','equals','1'),
			'title' => __('Custom Background Image', 'wpex'),
			'default' => '',
			'subtitle' => __('Upload a custom background for your site.', 'wpex'),
		),
		
		array(
			'id'=>'background_style',
			'type' => 'button_set',
			'title' => __('Background Image Style', 'wpex'), 
			'required' => array('background_image_toggle','equals','1'),
			'subtitle' => __('Select your preferred background style.', 'wpex'),
			'desc' => "",
			'options' => array('stretched' => __('Stretched','wpex'), 'repeat' => __('Repeat','wpex'), 'fixed' => __('Center Fixed','wpex')),
			'default' => 'stretched'
		),
		
		array(
			'id'=>'background_pattern_toggle',
			'type' => 'switch', 
			'title' => __('Background Pattern', 'wpex'),
			'subtitle'=> __('Toggle the background pattern option on/off.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'background_pattern',
			'type' => 'image_select', 
			'tiles' => true,
			'required' => array('background_pattern_toggle','equals','1'),
			'title' => __('Images Option', 'wpex'),
			'subtitle'=> __('Select a background pattern.', 'wpex'),
			'default' => 0,
			'options' => $bg_patterns,
		),
		
	)
);



// Header -------------------------------------------------------------------------- >	
$sections[] = array(
	'title' => __('Header', 'wpex'),
	'header' => '',
	'desc' => '',
	'icon_class' => 'el-icon-large',
    'icon' => 'el-icon-screen',
    'submenu' => true,
	'fields' => array(
	
		array(
			'id'=>'header_style',
			'type' => 'button_set',
			'title' => __('Header Style', 'wpex'), 
			'subtitle' => __('Select your default header style.', 'wpex'),
			'desc' => "",
			'options' => array('one' => __('Header 1','wpex'),'two' => __('Header 2','wpex'),'three' => __('Header 3','wpex')),
			'default' => 'one'
		),
		
		array(
			'id'=>'fixed_header',
			'type' => 'switch', 
			'title' => __('Fixed Header on Scroll', 'wpex'),
			'subtitle'=> __('Toggle the fixed header when the user scrolls down the site on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'main_search',
			'type' => 'switch', 
			'title' => __('Header Search', 'wpex'),
			'subtitle'=> __('Toggle the search function in the header on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('header_style','equals',array('one','two')),
		),
		
		array(
			'id'=>'menu_arrow_down',
			'type' => 'switch', 
			'title' => __('Top Level Dropdown Icon', 'wpex'),
			'subtitle'=> __('Toggle the top menu dropdown icon indicator on or off.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'menu_arrow_side',
			'type' => 'switch', 
			'title' => __('Second+ Level Dropdown Icon', 'wpex'),
			'subtitle'=> __('Toggle the sub-menu item dropdown icon indicator on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'header_top_padding',
			'type' => 'text',
			'title' => __('Header Top Padding', 'wpex'),
			'subtitle' => __('Enter your custom header top padding in pixels.', 'wpex'),
			'default' => '30px',
			'class' => 'small-text',
		),
		
		array(
			'id'=>'header_bottom_padding',
			'type' => 'text',
			'title' => __('Header Bottom Padding', 'wpex'),
			'subtitle' => __('Enter your custom header top padding in pixels.', 'wpex'),
			'default' => '30px',
			'class' => 'small-text',
		),
		
		array(
			'id'=>'logo_top_margin',
			'type' => 'text',
			'title' => __('Logo Top Margin', 'wpex'),
			'subtitle' => __('Enter your custom logo top margin.', 'wpex'),
			'default' => '0px',
			'class' => 'small-text',
		),
		
		array(
			'id'=>'logo_bottom_margin',
			'type' => 'text',
			'title' => __('Logo Bottom Margin', 'wpex'),
			'subtitle' => __('Enter your custom logo top margin.', 'wpex'),
			'default' => '0px',
			'class' => 'small-text',
		),
		
		array(
			'id'=>'header_aside',
			'type' => 'editor',
			'title' => __('Header Aside Content', 'wpex'),
			'subtitle' => __('Enter your custom header aside content', 'wpex'),
			'default' => '30% OFF All Store!',
			'required' => array('header_style','equals',array('two','three')),
			'editor_options' => '',
		),
		
	)
);


// Typography -------------------------------------------------------------------------- >	
$sections[] = array(
	'title' => __('Typography', 'wpex'),
	'header' => '',
	'desc' => '',
	'icon_class' => 'el-icon-large',
    'icon' => 'el-icon-font',
    'submenu' => true,
	'fields' => array(
			
			array(
				'id'=>'body_font',
				'type' => 'typography', 
				'title' => __('Body', 'wpex'),
				'compiler'=>false,
				'google'=>true,
				'font-backup'=>false,
				'font-style'=>true,
				'subsets'=>true,
				'font-size'=>true,
				'line-height'=>false,
				'word-spacing'=>false,
				'letter-spacing'=>false,
				'color'=>true,
				'preview'=>true,
				'output' => array('body'),
				'units'=>'px',
				'subtitle'=> __('Select your custom font options for your main body font.', 'wpex'),
				'default'=> array(
					'color'=>"#555",
					'font-family'=>'Open Sans', 
					'font-size'=>'13px',
				)
			),
			
			array(
				'id'=>'headings_font',
				'type' => 'typography', 
				'title' => __('Headings', 'wpex'),
				'compiler'=>false,
				'google'=>true,
				'font-backup'=>false,
				'font-style'=>false,
				'subsets'=>true,
				'font-size'=>false,
				'line-height'=>false,
				'word-spacing'=>false,
				'letter-spacing'=>false,
				'color'=>false,
				'preview'=>true,
				'output' => array('h1,h2,h3,h4,h5,h6,.theme-heading, .widget-title'),
				'units'=>'px',
				'subtitle'=> __('Select your custom font options for your headings. h1, h2, h3, h4', 'wpex'),
				'default'=> array(
					'color'=>"#000",
					'font-family'=>'Open Sans',
					'font-weight'=>'600',
					),
			),
			
			array(
				'id'=>'logo_font',
				'type' => 'typography', 
				'title' => __('Logo', 'wpex'),
				'compiler'=>false,
				'google'=>true,
				'font-backup'=>false,
				'font-style'=>false,
				'subsets'=>true,
				'font-size'=>true,
				'line-height'=>false,
				'word-spacing'=>false,
				'letter-spacing'=>false,
				'color'=>false,
				'preview'=>true,
				'output' => array('#site-logo a'),
				'units'=>'px',
				'subtitle'=> __('Select your custom font options for your logo.', 'wpex'),
				'default'=> array(
					'font-family'=>'Open Sans', 
					'font-size'=>'24px',
					'font-weight'=>'700',
					),
			),
			
			array(
				'id'=>'menu_font',
				'type' => 'typography', 
				'title' => __('Menu', 'wpex'),
				'compiler'=>false,
				'google'=>true,
				'font-backup'=>false,
				'font-style'=>false,
				'subsets'=>true,
				'font-size'=>true,
				'line-height'=>false,
				'word-spacing'=>false,
				'letter-spacing'=>false,
				'color'=>false,
				'preview'=>true,
				'output' => array('.main-navigation .sf-menu a'),
				'units'=>'px',
				'subtitle'=> __('Select your custom font options for your main navigation menu.', 'wpex'),
				'default'=> array(
					'font-family'=>'Open Sans', 
					'font-size'=>'13px',
					'font-weight'=>'400',
				)
			),
			
			array(
				'id'=>'menu_dropdown_font',
				'type' => 'typography', 
				'title' => __('Menu Dropdowns', 'wpex'),
				'compiler'=>false,
				'google'=>true,
				'font-backup'=>false,
				'font-style'=>false,
				'subsets'=>true,
				'font-size'=>true,
				'line-height'=>false,
				'word-spacing'=>false,
				'letter-spacing'=>false,
				'color'=>false,
				'preview'=>true,
				'output' => array('#site-header .dropdown-menu ul a'),
				'units'=>'px',
				'subtitle'=> __('Select your custom font options for your main navigation menu dropdowns.', 'wpex'),
				'default'=> array(
					'font-family'=>'Open Sans', 
					'font-size'=>'12px',
					'font-weight'=>'400',
				)
			),
			
			array(
				'id'=>'page_header_font',
				'type' => 'typography', 
				'title' => __('Page Title', 'wpex'),
				'compiler'=>false,
				'google'=>true,
				'font-backup'=>false,
				'font-style'=>false,
				'subsets'=>true,
				'font-size'=>true,
				'line-height'=>false,
				'word-spacing'=>false,
				'letter-spacing'=>false,
				'color'=>true,
				'preview'=>true,
				'output' => array('.page-header-title'),
				'units'=>'px',
				'subtitle'=> __('Select your custom font options for your page/post titles.', 'wpex'),
				'default'=> array(
					'font-family'=>'Open Sans', 
					'font-size'=>'21px',
					'font-weight'=>'400',
				)
			),
			
			
		),
);


// Styling -------------------------------------------------------------------------- >	
$sections[] = array(
	'icon' => 'el-icon-brush',
	'icon_class' => 'el-icon-large',
	'title' => __('Styling', 'wpex'),
	'submenu' => true,
	'fields' => array(
	
		/*
		array(
			'id'=>'stylesheet',
			'type' => 'select',
			'title' => __('Theme Stylesheet', 'wpex'), 
			'subtitle' => __('Select your themes alternative color scheme.', 'wpex'),
			'options' => array('dark.css'=>'dark.css' ),
			'default' => '',
		),		
		*/
			
		array(
			'id'=>'custom_styling',
			'type' => 'switch', 
			'title' => __('Custom Styling', 'wpex'),
			'subtitle'=> __('Use this option to toggle the custom styling options below on or off. Great for testing purposes.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'multi-info',
			'type' => 'info',
			'desc' => __('Main', 'wpex'),
		),
		
		array(
			'id'=>'link_color',
			'type' => 'color',
			'title' => __('Links Color', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'transparent'=>false,
			'validate' => 'color',
		),
		
		
		array(
			'id'=>'multi-info',
			'type' => 'info',
			'desc' => __('Theme Button', 'wpex'),
		),
		
		array(
			'id'=>'theme_button_bg',
			'type' => 'color_gradient',
			'title' => __('Theme Button Background', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => array('from' => '1', 'to' => '1'),
			'transparent' => false,
		),
		
		array(
			'id'=>'theme_button_color',
			'type' => 'color',
			'title' => __('Theme Button Color', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		array(
			'id'=>'theme_button_hover_bg',
			'type' => 'color_gradient',
			'title' => __('Theme Button Hover Background', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => array('from' => '1', 'to' => '1'),
			'transparent' => false,
		),
		
		array(
			'id'=>'theme_button_hover_color',
			'type' => 'color',
			'title' => __('Theme Button Hover Color', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		
		array(
			'id'=>'multi-info',
			'type' => 'info',
			'desc' => __('Header', 'wpex'),
		),
		
		array(
			'id'=>'header_background',
			'type' => 'color',
			'title' => __('Header Background Color', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		array(
			'id'=>'logo_color',
			'type' => 'color',
			'title' => __('Logo Color', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		array(
			'id'=>'shop_button_background',
			'type' => 'color_gradient',
			'title' => __('Shop Button Background', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'default' => array('from' => '1', 'to' => '1'),
			'transparent' => false,
			'required' => array('header_style','equals',array('one')),
		),
		
		array(
			'id'=>'shop_button_color',
			'type' => 'color',
			'title' => __('Shop Button Color', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		array(
			'id'=>'search_button_background',
			'type' => 'color_gradient',
			'title' => __('Search Button Background', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'default' => array('from' => '1', 'to' => '1'),
			'transparent' => false,
			'required' => array('header_style','equals',array('one')),
		),
		
		array(
			'id'=>'search_button_color',
			'type' => 'color',
			'title' => __('Search Button Color', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		 array(
			'id'=>'multi-info',
			'type' => 'info',
			'desc' => __('Navigation', 'wpex'),
		),

		array(
			'id'=>'menu_background',
			'type' => 'color',
			'title' => __('Menu Background', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		array(
			'id'=>'menu_borders',
			'type' => 'color',
			'title' => __('Menu Borders', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		array(
			'id'=>'menu_link_color',
			'type' => 'link_color',
			'title' => __('Menu Link Color', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => array(
				'show_regular' => true,
				'show_hover' => true,
				'show_active' => true
			),
		),
		array(
			'id'=>'menu_link_hover_background',
			'type' => 'color',
			'title' => __('Hover Menu Link Background', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
			'required' => array('header_style','equals',array('two','three')),
		),
		array(
			'id'=>'menu_link_active_background',
			'type' => 'color',
			'title' => __('Active Menu Link Background', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
			'required' => array('header_style','equals',array('two','three')),
		),
		array(
			'id'=>'dropdown_menu_background',
			'type' => 'color',
			'title' => __('Menu Dropdown Background', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		array(
			'id'=>'dropdown_menu_borders',
			'type' => 'color',
			'title' => __('Menu Dropdown Borders', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		array(
			'id'=>'dropdown_menu_link_color',
			'type' => 'link_color',
			'title' => __('Dropdown Menu Link Color', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => array(
				'show_regular' => true,
				'show_hover' => true,
				'show_active' => true
			)
		),
		array(
			'id'=>'dropdown_menu_link_hover_bg',
			'type' => 'color_gradient',
			'title' => __('Menu Dropdown Link Hover Background', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => array('from' => '1', 'to' => '1'),
			'transparent' => false,
		),
		
		array(
			'id'=>'multi-info',
			'type' => 'info',
			'desc' => __('Sidebar', 'wpex'),
		),
		
		array(
			'id'=>'sidebar_background',
			'type' => 'color',
			'title' => __('Sidebar Background', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		 array(
			'id'=>'spacing',
			'type' => 'spacing',
			'output' => array('#sidebar'),
			'mode'=>'padding',
			'units' => 'px',
			'title' => __('Sidebar Padding', 'wpex'),
			'subtitle' => __('Select your custom sidebar padding', 'wpex'),
			'default' => '',
		),
		
		array(
			'id'=>'sidebar_border',
			'type' => 'border',
			'title' => __('Sidebar border', 'wpex'), 
			'subtitle' => __('Select your border style.', 'wpex'),
			'output' => array('#sidebar'),
			'default' => '',
			'transparent' => false,
			'all' => false,
		),
		
		array(
			'id'=>'sidebar_link_color',
			'type' => 'link_color',
			'title' => __('Sidebar Link Color', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => array(
				'show_regular' => true,
				'show_hover' => true,
				'show_active' => true
			),
		),
		
		array(
			'id'=>'multi-info',
			'type' => 'info',
			'desc' => __('Footer', 'wpex'),
		),
		
		array(
			'id'=>'footer_background',
			'type' => 'color',
			'title' => __('Footer Background', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		array(
			'id'=>'footer_border',
			'type' => 'border',
			'title' => __('Footer border', 'wpex'), 
			'subtitle' => __('Select your border style.', 'wpex'),
			'output' => array('#footer'),
			'default' => '',
			'transparent' => false,
			'all' => false,
		),
		
		array(
			'id'=>'footer_color',
			'type' => 'color',
			'title' => __('Footer Color', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		array(
			'id'=>'footer_headings_color',
			'type' => 'color',
			'title' => __('Footer Headings Color', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		array(
			'id'=>'footer_borders',
			'type' => 'color',
			'title' => __('Footer Borders', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		array(
			'id'=>'footer_link_color',
			'type' => 'link_color',
			'title' => __('Footer Link Color', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => array(
				'show_regular' => true,
				'show_hover' => true,
				'show_active' => true
			)
		),
		
		array(
			'id'=>'multi-info',
			'type' => 'info',
			'desc' => __('Bottom Footer', 'wpex'),
		),
		
		array(
			'id'=>'bottom_footer_background',
			'type' => 'color',
			'title' => __('Bottom Footer Background', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		array(
			'id'=>'bottom_footer_border',
			'type' => 'border',
			'title' => __('Bottom Footer Top border', 'wpex'), 
			'subtitle' => __('Select your border style.', 'wpex'),
			'output' => array('#footer-bottom'),
			'default' => '',
			'transparent' => false,
			'all' => false,
		),
		
		array(
			'id'=>'bottom_footer_color',
			'type' => 'color',
			'title' => __('Bottom Footer Color', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => '',
			'validate' => 'color',
			'transparent' => false,
		),
		
		array(
			'id'=>'bottom_footer_link_color',
			'type' => 'link_color',
			'title' => __('Bottom Footer Link Color', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => array(
				'show_regular' => true,
				'show_hover' => true,
				'show_active' => true
			)
		),
		
		
	)
);


// Portfolio -------------------------------------------------------------------------- >	
$sections[] = array(
	'icon' => 'el-icon-briefcase',
	'icon_class' => 'el-icon-large',
    'title' => __('Portfolio', 'wpex'),
	'submenu' => true,
	'fields' => array(
	
		array(
			'id'=>'portfolio_enable',
			'type' => 'switch', 
			'title' => __('Portfolio Post Type', 'wpex'),
			'subtitle'=> __('Toggle the portfolio custom post type on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'portfolio_url',
			'type' => 'text',
			'title' => __( 'Portfolio URL', 'wpex' ),
			'desc' => "",
			'subtitle' => __( 'Enter the URL to your main portfolio page. This is used for your breadcrumbs.', 'wpex' ),
			'default' => '',
			'class' => 'small-text',
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_comments',
			'type' => 'switch', 
			'title' => __('Portfolio Comments', 'wpex'),
			'subtitle'=> __('Toggle the comments on portfolio posts on or off.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_next_prev',
			'type' => 'switch', 
			'title' => __('Portfolio Next/Prev Links', 'wpex'),
			'subtitle'=> __('Toggle the next and previous pagination on portfolio posts on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_related',
			'type' => 'switch', 
			'title' => __('Portfolio Related', 'wpex'),
			'subtitle'=> __('Toggle the related portfolio items on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_related_count',
			'type' => 'text',
			'title' => __( 'Portfolio Related Count', 'wpex' ),
			'desc' => "",
			'subtitle' => __( 'Enter the number of related portfolio items to display on your single posts.', 'wpex' ),
			'default' => '',
			'class' => 'small-text',
			'required' => array('portfolio_related','equals','1'),
		),
		
		array(
			'id'=>'portfolio_related_title',
			'type' => 'text',
			'title' => __( 'Portfolio Related Title', 'wpex' ),
			'desc' => "",
			'subtitle' => __( 'Enter a custom string for your related portfolio items title.', 'wpex' ),
			'default' => '',
			'class' => 'small-text',
			'required' => array('portfolio_related','equals','1'),
		),
		
		array(
			'id'=>'portfolio_search',
			'type' => 'switch', 
			'title' => __('Portfolio in Search?', 'wpex'),
			'subtitle'=> __('Toggle whether items from this post type should display in search results on or off. Enabling this option will also cause items to not display in the category & tag archives, so use wisely!', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_entry_details',
			'type' => 'switch', 
			'title' => __('Detailed Entries', 'wpex'),
			'subtitle'=> __('Toggle the portfolio entry title/excerpts from your category and tag archives.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_custom_sidebar',
			'type' => 'switch', 
			'title' => __( 'Custom Portfolio Sidebar', 'wpex' ),
			'subtitle'=> __('Toggle the built-in custom Portfolio post type sidebar on or off. If disabled it will display the "Main" sidebar as a fallback.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_entry_columns',
			'type' => 'button_set',
			'title' => __('Portfolio Archive Columns', 'wpex'), 
			'subtitle' => __('Select your default column structure for your category and tag archives.', 'wpex'),
			'desc' => "",
			'options' => array('1' => '1','2' => '2','3' => '3','4' => '4'),
			'default' => '4',
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_archive_layout',
			'type' => 'button_set',
			'title' => __( 'Portfolio Archives Layout', 'wpex' ),
			'subtitle' => __('Select your preferred layout for your single posts. This setting can be overriten on a per post basis via the meta options.', 'wpex'),
			'desc' => "",
			'options' => array( 'right-sidebar' => __('Right Sidebar','wpex'), 'left-sidebar' => __('Left Sidebar','wpex'), 'full-width' => __('Full Width','wpex') ),
			'default' => 'full-width',
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_single_layout',
			'type' => 'button_set',
			'title' => __( 'Portfolio Single Post Layout', 'wpex' ),
			'subtitle' => __('Select your preferred layout for your single posts. This setting can be overriten on a per post basis via the meta options.', 'wpex'),
			'desc' => "",
			'options' => array( 'right-sidebar' => __('Right Sidebar','wpex'), 'left-sidebar' => __('Left Sidebar','wpex'), 'full-width' => __('Full Width','wpex') ),
			'default' => 'full-width',
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_admin_icon',
			'url'=> true,
			'type' => 'media', 
			'title' => __('Portfolio Admin Icon', 'wpex'),
			'subtitle' => __('Upload a custom 16px by 16px portfolio admin icon.', 'wpex'),
			'required' => array('portfolio_enable','equals','1'),
		),
		
	 	array(
			'id'=>'portfolio_labels',
			'type' => 'text',
			'title' => __('Portfolio Labels', 'wpex'),
			'desc' => "",
			'subtitle' => __('Use this field to rename your portfolio custom post type.', 'wpex'),
			'default' => 'Portfolio',
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_slug',
			'type' => 'text',
			'title' => __('Portfolio Slug', 'wpex'),
			'desc' => "",
			'subtitle' => __('Use this field to alter the default slug for portfolio items.', 'wpex'),
			'default' => 'portfolio-item',
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_cat_slug',
			'type' => 'text',
			'title' => __('Portfolio Category Slug', 'wpex'),
			'desc' => "",
			'subtitle' => __('Use this field to alter the default slug for the portfolio category taxonomy.', 'wpex'),
			'default' => 'portfolio-category',
			'required' => array('portfolio_enable','equals','1'),
		),
		
		array(
			'id'=>'portfolio_tag_slug',
			'type' => 'text',
			'title' => __('Portfolio Tag Slug', 'wpex'),
			'desc' => "",
			'subtitle' => __('Use this field to alter the default slug for the portfolio tag taxonomy.', 'wpex'),
			'default' => 'portfolio-tag',
			'required' => array('portfolio_enable','equals','1'),
		),
		
	)
);


// Staff -------------------------------------------------------------------------- >	
$sections[] = array(
	'icon' => 'el-icon-user',
	'icon_class' => 'el-icon-large',
    'title' => __('Staff', 'wpex'),
	'submenu' => true,
	'fields' => array(	
	
		array(
			'id'=>'staff_enable',
			'type' => 'switch', 
			'title' => __('Staff Post Type', 'wpex'),
			'subtitle'=> __('Toggle the staff custom post type on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'staff_url',
			'type' => 'text',
			'title' => __( 'Staff URL', 'wpex' ),
			'desc' => "",
			'subtitle' => __( 'Enter the URL to your main staff page. This is used for your breadcrumbs.', 'wpex' ),
			'default' => '',
			'class' => 'small-text',
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_comments',
			'type' => 'switch', 
			'title' => __('Staff Comments', 'wpex'),
			'subtitle'=> __('Toggle the comments on staff posts on or off.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_next_prev',
			'type' => 'switch', 
			'title' => __('Staff Next/Prev Links', 'wpex'),
			'subtitle'=> __('Toggle the next and previous pagination on staff posts on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_related',
			'type' => 'switch', 
			'title' => __('Staff Related', 'wpex'),
			'subtitle'=> __('Toggle the related staff items on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_related_count',
			'type' => 'text',
			'title' => __( 'Staff Related Count', 'wpex' ),
			'desc' => "",
			'subtitle' => __( 'Enter the number of related staff items to display on your single posts.', 'wpex' ),
			'default' => '4',
			'class' => 'small-text',
			'required' => array('staff_related','equals','1'),
		),
		
		array(
			'id'=>'staff_related_title',
			'type' => 'text',
			'title' => __( 'Staff Related Title', 'wpex' ),
			'desc' => "",
			'subtitle' => __( 'Enter a custom string for your related staff items title.', 'wpex' ),
			'default' => '',
			'class' => 'small-text',
			'required' => array('staff_related','equals','1'),
		),
		
		array(
			'id'=>'staff_search',
			'type' => 'switch', 
			'title' => __('Staff in Search?', 'wpex'),
			'subtitle'=> __('Toggle whether items from this post type should display in search results on or off. Enabling this option will also cause items to not display in the category & tag archives, so use wisely!', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_custom_sidebar',
			'type' => 'switch', 
			'title' => __( 'Custom Staff Sidebar', 'wpex' ),
			'subtitle'=> __('Toggle the built-in custom Staff post type sidebar on or off. If disabled it will display the "Main" sidebar as a fallback.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_entry_columns',
			'type' => 'button_set',
			'title' => __('Staff Archive Columns', 'wpex'), 
			'subtitle' => __('Select your default column structure for your category and tag archives.', 'wpex'),
			'desc' => "",
			'options' => array('1' => '1','2' => '2','3' => '3','4' => '4'),
			'default' => '4',
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_archive_layout',
			'type' => 'button_set',
			'title' => __( 'Staff Archives Layout', 'wpex' ),
			'subtitle' => __('Select your preferred layout for your posts. This setting can be overriten on a per post basis via the meta options.', 'wpex'),
			'desc' => "",
			'options' => array( 'right-sidebar' => __('Right Sidebar','wpex'), 'left-sidebar' => __('Left Sidebar','wpex'), 'full-width' => __('Full Width','wpex') ),
			'default' => 'full-width',
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_single_layout',
			'type' => 'button_set',
			'title' => __( 'Staff Single Post Layout', 'wpex' ),
			'subtitle' => __('Select your preferred layout for your single posts. This setting can be overriten on a per post basis via the meta options.', 'wpex'),
			'desc' => "",
			'options' => array( 'right-sidebar' => __('Right Sidebar','wpex'), 'left-sidebar' => __('Left Sidebar','wpex'), 'full-width' => __('Full Width','wpex') ),
			'default' => 'right-sidebar',
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_admin_icon',
			'url'=> true,
			'type' => 'media', 
			'title' => __('Staff Admin Icon', 'wpex'),
			'subtitle' => __('Upload a custom 16px by 16px staff admin icon.', 'wpex'),
			'required' => array('staff_enable','equals','1'),
		),
		
	 	array(
			'id'=>'staff_labels',
			'type' => 'text',
			'title' => __('Staff Labels', 'wpex'),
			'desc' => "",
			'subtitle' => __('Use this field to rename your staff custom post type.', 'wpex'),
			'default' => 'Staff',
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_slug',
			'type' => 'text',
			'title' => __('Staff Slug', 'wpex'),
			'desc' => "",
			'subtitle' => __('Use this field to alter the default slug for staff items.', 'wpex'),
			'default' => 'staff-item',
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_cat_slug',
			'type' => 'text',
			'title' => __('Staff Category Slug', 'wpex'),
			'desc' => "",
			'subtitle' => __('Use this field to alter the default slug for the staff category taxonomy.', 'wpex'),
			'default' => 'staff-category',
			'required' => array('staff_enable','equals','1'),
		),
		
		array(
			'id'=>'staff_tag_slug',
			'type' => 'text',
			'title' => __('Staff Tag Slug', 'wpex'),
			'desc' => "",
			'subtitle' => __('Use this field to alter the default slug for the staff tag taxonomy.', 'wpex'),
			'default' => 'staff-tag',
			'required' => array('staff_enable','equals','1'),
		),

	)
);



// Testimonials -------------------------------------------------------------------------- >	
$sections[] = array(
	'icon' => 'el-icon-quotes',
	'icon_class' => 'el-icon-large',
    'title' => __('Testimonials', 'wpex'),
	'submenu' => true,
	'fields' => array(
		array(
			'id'=>'testimonials_enable',
			'type' => 'switch', 
			'title' => __('Testimonials Post Type', 'wpex'),
			'subtitle'=> __('Toggle the testimonials custom post type on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		array(
			'id'=>'testimonials_next_prev',
			'type' => 'switch', 
			'title' => __('Testimonials Next/Prev Links', 'wpex'),
			'subtitle'=> __('Toggle the next and previous pagination on testimonials posts on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('testimonials_enable','equals','1'),
		),
		array(
			'id'=>'testimonials_search',
			'type' => 'switch', 
			'title' => __('Testimonials in Search?', 'wpex'),
			'subtitle'=> __('Toggle whether items from this post type should display in search results on or off. Enabling this option will also cause items to not display in the category & tag archives, so use wisely!', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('testimonials_enable','equals','1'),
		),
		array(
			'id'=>'testimonials_entry_columns',
			'type' => 'button_set',
			'title' => __('Testimonials Archive Columns', 'wpex'), 
			'subtitle' => __('Select your default column structure for your category and tag archives.', 'wpex'),
			'desc' => "",
			'options' => array('1' => '1','2' => '2','3' => '3','4' => '4'),
			'default' => '3',
			'required' => array('testimonials_enable','equals','1'),
		),
		array(
			'id'=>'testimonials_archive_layout',
			'type' => 'button_set',
			'title' => __( 'Testimonials Archives Layout', 'wpex' ),
			'subtitle' => __('Select your preferred layout for your single posts. This setting can be overriten on a per post basis via the meta options.', 'wpex'),
			'desc' => "",
			'options' => array( 'right-sidebar' => __('Right Sidebar','wpex'), 'left-sidebar' => __('Left Sidebar','wpex'), 'full-width' => __('Full Width','wpex') ),
			'default' => 'full-width',
			'required' => array('testimonials_enable','equals','1'),
		),
		array(
			'id'=>'testimonials_admin_icon',
			'url'=> true,
			'type' => 'media', 
			'title' => __('Testimonials Admin Icon', 'wpex'),
			'subtitle' => __('Upload a custom 16px by 16px testimonials admin icon.', 'wpex'),
			'required' => array('testimonials_enable','equals','1'),
		),
		array(
			'id'=>'testimonials_url',
			'type' => 'text',
			'title' => __( 'Testimonials URL', 'wpex' ),
			'desc' => "",
			'subtitle' => __( 'Enter the URL to your main testimonials page. This is used for your breadcrumbs.', 'wpex' ),
			'default' => '',
			'class' => 'small-text',
			'required' => array('testimonials_enable','equals','1'),
		),
	 	array(
			'id'=>'testimonials_labels',
			'type' => 'text',
			'title' => __('Testimonials Labels', 'wpex'),
			'desc' => "",
			'subtitle' => __('Use this field to rename your testimonials custom post type.', 'wpex'),
			'default' => 'Testimonials',
			'required' => array('testimonials_enable','equals','1'),
		),
		array(
			'id'=>'testimonials_slug',
			'type' => 'text',
			'title' => __('Testimonials Slug', 'wpex'),
			'desc' => "",
			'subtitle' => __('Use this field to alter the default slug for testimonials items.', 'wpex'),
			'default' => 'testimonials-item',
			'required' => array('testimonials_enable','equals','1'),
		),
		array(
			'id'=>'testimonials_cat_slug',
			'type' => 'text',
			'title' => __('Testimonials Category Slug', 'wpex'),
			'desc' => "",
			'subtitle' => __('Use this field to alter the default slug for the testimonials category taxonomy.', 'wpex'),
			'default' => 'testimonials-category',
			'required' => array('testimonials_enable','equals','1'),
		),
	
	)
);



// WooCommerce -------------------------------------------------------------------------- >	

if ( class_exists('Woocommerce') ) {

$sections[] = array(
	'icon' => 'el-icon-shopping-cart',
	'icon_class' => 'el-icon-large',
    'title' => __('WooCommerce', 'wpex'),
	'submenu' => true,
	'fields' => array(
		
		array(
			'id'=>'woo_menu_icon',
			'type' => 'switch', 
			'title' => __( 'Cart In Menu', 'wpex' ),
			'subtitle'=> __('Toggle the menu shopping cart on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'woo_custom_sidebar',
			'type' => 'switch', 
			'title' => __( 'WooCommerce Sidebar', 'wpex' ),
			'subtitle'=> __('Toggle the built-in custom WooCommerce sidebar on or off. If disabled it will display the "Main" sidebar as a fallback.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'woo_shop_title',
			'type' => 'switch', 
			'title' => __( 'Shop Title', 'wpex' ),
			'subtitle'=> __('Toggle the main shop page title on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'woo_shop_custom_title',
			'type' => 'text',
			'title' => __( 'Shop Title', 'wpex' ),
			'desc' => "",
			'subtitle' => __( 'Enter your custom shop title.', 'wpex' ),
			'default' => 'Products',
			'required' => array('woo_shop_title','equals','1'),
		),
		
		array(
			'id'=>'woo_shop_slider',
			'type' => 'text',
			'title' => __( 'Shop Slider', 'wpex' ),
			'desc' => "",
			'subtitle' => __( 'Insert your slider shortcode for your products archive.', 'wpex' ),
			'default' => '',
		),
		
		array(
			'id'=>'woo_shop_layout',
			'type' => 'button_set',
			'title' => __('Shop Layout', 'wpex'), 
			'subtitle' => __('Select your preferred layout for your WooCommmerce Shop.', 'wpex'),
			'desc' => "",
			'options' => array( 'right-sidebar' => __('Right Sidebar','wpex'), 'left-sidebar' => __('Left Sidebar','wpex'), 'full-width' => __('Full Width','wpex') ),
			'default' => 'left-sidebar'
		),
		
		array(
			'id'=>'woocommerce_shop_columns',
			'type' => 'button_set',
			'title' => __('Shop Columns', 'wpex'), 
			'subtitle' => __('Select how many columns you want for the main WooCommerce shop.', 'wpex'),
			'options' => array('2' => '2','3' => '3','4' => '4'),
			'default' => '3',
		),
		
		array(
			'id'=>'woo_product_layout',
			'type' => 'button_set',
			'title' => __('Product Layout', 'wpex'), 
			'subtitle' => __('Select your preferred layout for your WooCommmerce products.', 'wpex'),
			'desc' => "",
			'options' => array( 'right-sidebar' => __('Right Sidebar','wpex'), 'left-sidebar' => __('Left Sidebar','wpex'), 'full-width' => __('Full Width','wpex') ),
			'default' => 'left-sidebar'
		),
		
		array(
			'id'=>'woocommerce_related_count',
			'type' => 'text',
			'title' => __('How many related items?', 'wpex'), 
			'subtitle' => __('Enter the ammount of related items to display on product pages.', 'wpex'),
			'default' => '3',
		),
		
		
		array(
			'id'=>'woocommerce_related_columns',
			'type' => 'button_set',
			'title' => __('Related Products Columns', 'wpex'), 
			'subtitle' => __('Select how many columns you want for the related products section.', 'wpex'),
			'options' => array('2' => '2','3' => '3','4' => '4'),
			'default' => '3',
		),
		
		array(
			'id'=>'multi-info',
			'type' => 'info',
			'desc' => __('Custom Colors', 'wpex'),
		),
		
		array(
			'id'=>'onsale_bg',
			'type' => 'color_gradient',
			'title' => __('OnSale Background', 'wpex'),
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => array('from' => '1', 'to' => '1'),
			'transparent' => false,
		),
		
	)
);

}


// Blog -------------------------------------------------------------------------- >	
$sections[] = array(
	'icon' => 'el-icon-edit',
	'icon_class' => 'el-icon-large',
    'title' => __('Blog', 'wpex'),
	'submenu' => true,
	'fields' => array(
	
		array(
			'id'=>'blog_url',
			'type' => 'text',
			'title' => __( 'Blog URL', 'wpex' ),
			'desc' => "",
			'subtitle' => __( 'Enter the URL to your main blog page. This is used for your breadcrumbs.', 'wpex' ),
			'default' => '',
			'class' => 'small-text',
		),
		
		array(
			'id'=>'blog_style',
			'type' => 'button_set',
			'title' => __('Blog Style', 'wpex'), 
			'subtitle' => __('Select your preferred blog style.', 'wpex'),
			'desc' => "",
			'options' => array('large-image-entry-style' => __('Large Image','wpex'), 'thumbnail-entry-style' => __('Thumbnail','wpex'),'grid-entry-style' => __('Grid','wpex')),
			'default' => 'large-image-entry-style'
		),
		
		array(
			'id'=>'blog_grid_columns',
			'type' => 'button_set',
			'title' => __('Grid Style Columns', 'wpex'), 
			'subtitle' => __('Select how many columns you want for your grid style blog archives.', 'wpex'),
			'desc' => "",
			'options' => array('2' => '2','3' => '3','4' => '4'),
			'default' => '2',
			'required' => array('blog_style','equals','grid-entry-style'),
		),
		
		array(
			'id'=>'blog_archives_layout',
			'type' => 'button_set',
			'title' => __('Blog Archives Layout', 'wpex'), 
			'subtitle' => __('Select your preferred layout for your main blog page, categories and tags.', 'wpex'),
			'desc' => "",
			'options' => array( 'right-sidebar' => __('Right Sidebar','wpex'), 'left-sidebar' => __('Left Sidebar','wpex'), 'full-width' => __('Full Width','wpex') ),
			'default' => 'right-sidebar'
		),
		
		array(
			'id'=>'blog_single_layout',
			'type' => 'button_set',
			'title' => __( 'Single Post Layout', 'wpex' ),
			'subtitle' => __('Select your preferred layout for your single posts. This setting can be overriten on a per post basis via the meta options.', 'wpex'),
			'desc' => "",
			'options' => array( 'right-sidebar' => __('Right Sidebar','wpex'), 'left-sidebar' => __('Left Sidebar','wpex'), 'full-width' => __('Full Width','wpex') ),
			'default' => 'right-sidebar'
		),
		
		array(
			'id'=>'blog_pagination_style',
			'type' => 'button_set',
			'title' => __('Pagination Style', 'wpex'), 
			'subtitle' => __('Select your preferred pagination style for the blog.', 'wpex'),
			'desc' => "",
			'options' => array('standard' => __('Standard','wpex'),'infinite_scroll' => __('Infinite Scroll','wpex'),'next_prev' => __('Next/Prev','wpex')),
			'default' => 'standard'
		),
		
		array(
			'id'=>'blog_cats_exclude',
			'type' => 'select',
			'data' => 'categories',
			'multi' => true,
			'title' => __('Exclude Categories From Blog', 'wpex'), 
			'subtitle' => __('Use this option to exclude categories from your main blog template and/or your index (if using the homepage as a blog)', 'wpex'),
		),
		
		array(
			'id'=>'post_series',
			'type' => 'switch', 
			'title' => __('Post Series', 'wpex'),
			'subtitle'=> __('Toggle the post series custom taxonomy on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),

		array(
			'id'=>'blog_exceprt',
			'type' => 'switch', 
			'title' => __('Entry: Auto Excerpts', 'wpex'),
			'subtitle'=> __('Toggle your blog auto excerpts on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'blog_excerpt_length',
			'type' => 'text',
			'title' => __( 'Entry Excerpt length', 'wpex' ),
			'desc' => "",
			'subtitle' => __( 'How many words do you want to show for your blog entry excerpts?', 'wpex' ),
			'default' => '40',
			'class' => 'small-text',
			'required' => array('blog_exceprt','equals','1'),
		),
		
		array(
			'id'=>'blog_entry_readmore',
			'type' => 'switch', 
			'title' => __( 'Entry: Read More Button', 'wpex' ),
			'subtitle'=> __('Toggle the blog entry read more button on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'blog_entry_author_avatar',
			'type' => 'switch', 
			'title' => __( 'Entry: Author Avatar', 'wpex' ),
			'subtitle'=> __('Toggle the author avatar on your blog entries on or off. Note: This option only applies to certain blog styles.', 'wpex'),
			"default" => 0,
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
			'required' => array('blog_style','equals','large-image-entry-style'),
		),
		
		array(
			'id'=>'blog_single_thumbnail',
			'type' => 'switch', 
			'title' =>  __( 'Post: Featured Image', 'wpex' ),
			'subtitle'=> __('Toggle the display of featured images on single blog posts on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'blog_bio',
			'type' => 'switch', 
			'title' => __( 'Post: Author Bio', 'wpex' ),
			'subtitle'=> __('Toggle the author bio box on single blog posts on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'blog_tags',
			'type' => 'switch', 
			'title' => __( 'Post: Tags', 'wpex' ),
			'subtitle'=> __('Toggle the post tags display on single blog posts on or off.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'blog_related',
			'type' => 'switch', 
			'title' => __( 'Post: Related Articles', 'wpex' ),
			'subtitle'=> __('Toggle the related articles section on single blog posts on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
	
	)
);



// Images -------------------------------------------------------------------------- >	
$sections[] = array(
	'icon' => 'el-icon-camera',
	'icon_class' => 'el-icon-large',
    'title' => __('Image Cropping', 'wpex'),
	'submenu' => true,
	'fields' => array(
		
		array(
			'id'=>'image_resizing',
			'type' => 'switch', 
			'title' => __('Image Cropping', 'wpex'),
			'subtitle'=> __('Toggle the built-in image resizing function on or off.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'retina',
			'type' => 'switch', 
			'title' => __('Retina Support', 'wpex'),
			'subtitle'=> __('Toggle the retina support for your resized images on or off.', 'wpex'),
			"default" => 0,
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array( 
			"title"	=> __( 'Blog Entry: Image Width', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpex' ),
			"id" => "blog_entry_image_width",
			"default" => '680',
			"type" => "text",
		),
												
		array(
			"title"	 => __( 'Blog Entry: Image Height', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpex' ),
			"id" => "blog_entry_image_height",
			"default" => '380',
			"type" => "text",
		),
		
		array( 
			"title"	 => __( 'Blog Post: Image Width', 'wpex' ),
			"subtitle" => __( 'Enter your custom width in pixels.', 'wpex' ),
			"id" => "blog_post_image_width",
			"default" => '680',
			"type" => "text",
		),
												
		array(
			"title" => __( 'Blog Post: Image Height', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpex' ),
			"id" => "blog_post_image_height",
			"default" => '380',
			"type" => "text",
		),
		
		array( 
			"title" => __( 'Blog Full-Width Post: Image Width', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpex' ),
			"id" => "blog_post_full_image_width",
			"default"	=> '980',
			"type"	=> "text",
		),
												
		array(
			"title"	 => __( 'Blog Full-Width Post: Image Height', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpex' ),
			"id" => "blog_post_full_image_height",
			"default" => '9999',
			"type" => "text",
		),
		
		array( 
			"title" => __( 'Portfolio Archive Entry: Image Width', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpex' ),
			"id" => "portfolio_entry_image_width",
			"default" => '500',
			"type" => "text",
		),
												
		array(
			"title"	 => __( 'Portfolio Archive Entry: Image Height', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpex' ),
			"id" => "portfolio_entry_image_height",
			"default"	=> '350',
			"type"	=> "text",
		),
		
		array( 
			"title"	=> __( 'Staff Archive Entry: Image Width', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpex' ),
			"id"	=> "staff_entry_image_width",
			"default"	=> '500',
			"type"	=> "text",
		),
												
		array(
			"title"	=> __( 'Staff Archive Entry: Image Height', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpex' ),
			"id"	=> "staff_entry_image_height",
			"default"	=> '500',
			"type"	=> "text",
		),
		
		array( 
			"title"	=> __( 'Testimonial Archive Entry: Image Width', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpex' ),
			"id"	=> "testimonial_entry_image_width",
			"default"	=> '45',
			"type"	=> "text",
		),
												
		array(
			"title"	=> __( 'Testimonial Archive Entry: Image Height', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpex' ),
			"id"	=> "testimonial_entry_image_height",
			"default"	=> '45',
			"type"	=> "text",
		),
		
		array( 
			"title"	=> __( 'WooCommerce Entry: Image Width', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpex' ),
			"id"	=> "woo_entry_width",
			"default"	=> '350',
			"type"	=> "text",
		),
												
		array(
			"title"	=> __( 'WooCommerce Entry: Image Height', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpex' ),
			"id"	=> "woo_entry_height",
			"default"	=> '500',
			"type"	=> "text",
		),
		
		array( 
			"title"	=> __( 'WooCommerce Post: Image Width', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpex' ),
			"id"	=> "woo_post_image_width",
			"default"	=> '350',
			"type"	=> "text",
		),
												
		array(
			"title"	=> __( 'WooCommerce Post: Image Height', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpex' ),
			"id"	=> "woo_post_image_height",
			"default"	=> '500',
			"type"	=> "text",
		),
		
		array( 
			"title"	=> __( 'WooCommerce Category Entry: Image Width', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpex' ),
			"id"	=> "woo_cat_entry_width",
			"default"	=> '',
			"type"	=> "text",
		),
												
		array(
			"title"	=> __( 'WooCommerce Category Entry: Image Height', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpex' ),
			"id"	=> "woo_cat_entry_height",
			"default"	=> '',
			"type"	=> "text",
		),
		
		array( 
			"title"	=> __( 'Custom WP Gallery: Image Width', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpex' ),
			"id"	=> "gallery_image_width",
			"default"	=> '500',
			"type"	=> "text",
		),
												
		array(
			"title"	=> __( 'Custom WP Gallery: Image Height', 'wpex' ),
			"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpex' ),
			"id"	=> "gallery_image_height",
			"default"	=> '500',
			"type"	=> "text",
		),
	
	)
);


// Footer -------------------------------------------------------------------------- >	
$sections[] = array(
	'icon' => 'el-icon-bookmark',
	'icon_class' => 'el-icon-large',
    'title' => __('Footer', 'wpex'),
	'submenu' => true,
	'fields' => array(
		
		array(
			'id'=>'callout',
			'type' => 'switch', 
			'title' => __('Footer Callout', 'wpex'),
			'subtitle'=> __('Toggle the callout area in the footer on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'callout_text',
			'type' => 'editor',
			'title' => __('Footer Callout: Content', 'wpex'), 
			'subtitle' => __('Enter your custom content for your footer callout.', 'wpex'),
			'default' => 'I am the footer call-to-action block, here you can add some relevant/important information about your company or product. I can be disabled in the theme options.',
			'required' => array('callout','equals','1'),
			'editor_options' => '',
		),
		
		array(
			'id'=>'callout_link',
			'type' => 'text',
			'title' => __('Footer Callout: Link', 'wpex'), 
			'subtitle' => __('Enter a url for your footer callout button.', 'wpex'),
			'default' => 'http://www.wpexplorer.com',
			'required' => array('callout','equals','1'),
		),
		
		array(
			'id'=>'callout_link_txt',
			'type' => 'text',
			'title' => __('Footer Callout: Link Text', 'wpex'), 
			'subtitle' => __('Enter the text for your footer callout link.', 'wpex'),
			'default' => 'Get In Touch',
			'required' => array('callout','equals','1'),
		),
		
		array(
			'id'=>'footer_callout_button_bg',
			'type' => 'color_gradient',
			'title' => __('Footer Callout: Button Background', 'wpex'), 
			'subtitle' => __('Select your custom hex color.', 'wpex'),
			'default' => array('from' => '1', 'to' => '1'),
			'transparent' => false,
		),
		
		
		array(
			'id'=>'callout_button_target',
			'type' => 'button_set',
			'title' => __('Footer Callout: Button Target', 'wpex'),
			'subtitle'=> __('Select your footer callout button link target window.', 'wpex'),
			'options' => array('blank'=>'blank','self'=>'self'),
			'default' => 'blank',
			'required' => array('footer_social','equals','1'),
		),
		
		array(
			'id'=>'callout_button_rel',
			'type' => 'button_set',
			'title' => __('Footer Callout: Button Rel', 'wpex'),
			'subtitle'=> __('Select your footer callout button link rel value.', 'wpex'),
			'options' => array('dofollow'=>'dofollow','nofollow'=>'nofollow'),
			'default' => 'dofollow',
			'required' => array('footer_social','equals','1'),
		),
		
		array(
			'id'=>'footer_widgets',
			'type' => 'switch', 
			'title' => __('Footer Widgets', 'wpex'),
			'subtitle'=> __('Toggle the footer widgets on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'footer_col',
			'type' => 'button_set',
			'title' => __('Footer Widget Columns', 'wpex'), 
			'subtitle' => __('Select how many columns you want for your footer widgets.', 'wpex'),
			'desc' => "",
			'options' => array('1' => '1','2' => '2','3' => '3','4' => '4'),
			'default' => '4',
			'required' => array('footer_widgets','equals','1'),
		),
		
		array(
			'id'=>'footer_copyright',
			'type' => 'switch', 
			'title' => __('Bottom Footer Area', 'wpex'),
			'subtitle'=> __('Toggle the bottom footer area on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'footer_copyright_text',
			'type' => 'editor',
			'title' => __('Copyright', 'wpex'), 
			'subtitle' => __('Enter yoru custom copyright text.', 'wpex'),
			'default' => 'Copyright 2013 - All Rights Reserved',
			'required' => array('footer_copyright','equals','1'),
			'editor_options' => '',
		),

	)
);



// Social -------------------------------------------------------------------------- >	
$sections[] = array(
	'icon' => 'el-icon-twitter',
	 'icon_class' => 'el-icon-large',
    'title' => __('Social Sharing', 'wpex'),
	'submenu' => true,
	'fields' => array(
		
		array(
			'id'=>'social_share_blog_posts',
			'type' => 'switch', 
			'title' => __('Blog Posts: Social Share', 'wpex'),
			'subtitle'=> __('Toggle the social sharing for this section of your site on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
				
		array(
			'id'=>'social_share_blog_entries',
			'type' => 'switch', 
			'title' => __( 'Blog Entries: Social Share', 'wpex' ),
			'subtitle'=> __('Toggle the social sharing icons on your blog entries on or off. Note: They will only display on the Large Image style blog entries.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'social_share_pages',
			'type' => 'switch', 
			'title' => __('Pages: Social Share', 'wpex'),
			'subtitle'=> __('Toggle the social sharing for this section of your site on or off.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'social_share_portfolio',
			'type' => 'switch', 
			'title' => __('Portfolio: Social Share', 'wpex'),
			'subtitle'=> __('Toggle the social sharing for this section of your site on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'social_share_woo',
			'type' => 'switch', 
			'title' => __('WooCommerce: Social Share', 'wpex'),
			'subtitle'=> __('Toggle the social sharing for this section of your site on or off.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		 array(
			'id'=>'social_share_sites',
			'type' => 'checkbox',
			'title' => __('Social Sharing Links', 'wpex'), 
			'subtitle' => __('Select the social sharing links to include in the social sharing function.', 'wpex' ),
			'options' => array(
				'twitter' => 'Twitter',
				'facebook' => 'Facebook',
				'google_plus' => 'Google Plus',
				'pinterest' => 'Pinterest',
				'linkedin' => 'LinkedIn',
			),
			'default' => array(
				'twitter' => '1',
				'facebook' => '1',
				'google_plus' => '1',
				'pinterest' => '1',
				'linkedin' => false,
			)
		),
		
		
	)
);


// SEO -------------------------------------------------------------------------- >
$sections[] = array(
	'icon' => 'el-icon-search',
	'icon_class' => 'el-icon-large',
    'title' => __('SEO', 'wpex'),
	'submenu' => true,
	'fields' => array(
	
		array(
			'id'=>'sidebar_headings',
			'type' => 'button_set',
			'title' => __('Sidebar Widget Title Headings', 'wpex'), 
			'subtitle' => __('Select your preferred heading type.', 'wpex'),
			'desc' => "",
			'options' => array(
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
				'span' => 'span',
				'div' => 'div',
			),
			'default' => 'div'
		),
		
		array(
			'id'=>'footer_headings',
			'type' => 'button_set',
			'title' => __('Footer Widget Title Headings', 'wpex'), 
			'subtitle' => __('Select your preferred heading type.', 'wpex'),
			'desc' => "",
			'options' => array(
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
				'span' => 'span',
				'div' => 'div',
			),
			'default' => 'div'
		),
	
		array(
			'id'=>'breadcrumbs',
			'type' => 'switch', 
			'title' => __('Breadcrumbs', 'wpex'),
			'subtitle'=> __('Toggle the site breadcrumbs on or off', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'remove_scripts_version',
			'type' => 'switch', 
			'title' => __( 'Remove Version Parameter From JS & CSS Files', 'wpex' ),
			'subtitle'=> __('Most scripts and stylesheets called by WordPress include a query string identifying the version. This can cause issues with caching and such, which will result in less than optimal load times. You can toggle this setting on to remove the query string from such strings.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'remove_header_junk',
			'type' => 'switch', 
			'title' => __( 'Cleanup WP Head', 'wpex' ),
			'subtitle'=> __('Enable to clean up your site\'s header from auto code added by WP, such as the WP version.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
	
	)
	
);



// Other -------------------------------------------------------------------------- >
$sections[] = array(
	'icon' => 'el-icon-wrench',
	'icon_class' => 'el-icon-large',
    'title' => __('Other', 'wpex'),
	'submenu' => true,
	'fields' => array(
	
		array(
			'id'=>'page_layout',
			'type' => 'button_set',
			'title' => __( 'Page Layout', 'wpex' ),
			'subtitle' => __('Select your preferred layout for your pagess. This setting can be overriten on a per page basis via the meta options.', 'wpex'),
			'desc' => "",
			'options' => array( 'right-sidebar' => __('Right Sidebar','wpex'), 'left-sidebar' => __('Left Sidebar','wpex'), 'full-width' => __('Full Width','wpex') ),
			'default' => 'right-sidebar',
		),
		
		array(
			'id'=>'custom_wp_gallery',
			'type' => 'switch', 
			'title' => __( 'Custom WordPress Gallery Output', 'wpex' ),
			'subtitle'=> __( 'Toggle the built-in custom WordPress gallery output on or off.', 'wpex' ),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'scroll_top',
			'type' => 'switch', 
			'title' => __('Back To Top Button', 'wpex'),
			'subtitle'=> __('Toggle the back to top button on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'blog_dash_thumbs',
			'type' => 'switch', 
			'title' => __( 'Dashboard Featured Images', 'wpex' ),
			'subtitle'=> __('Toggle the display of featured images in your WP dashboard on or off.', 'wpex'),
			"default" => '1',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'page_comments',
			'type' => 'switch', 
			'title' => __( 'Comments on Pages', 'wpex' ),
			'subtitle'=> __('Toggle the display of comments in pages on or off.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
		array(
			'id'=>'remove_jetpack_devicepx',
			'type' => 'switch', 
			'title' => __( 'Remove Jetpack devicepx script', 'wpex' ),
			'subtitle'=> __('Toggle the jetpack devicepx script on/off. The file is used to optionally load retina/HiDPI versions of files (Gravatars etc) which are known to support it, for devices that run at a higher resolution. But can be disabled to prevent the extra js call.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		
	)
);


// Custom CSS -------------------------------------------------------------------------- >
$sections[] = array(
	'icon' => 'el-icon-css',
	'icon_class' => 'el-icon-large',
    'title' => __('Custom CSS', 'wpex'),
	'submenu' => true,
	'fields' => array(
		array(
			'id'=>'custom_css',
			'type' => 'textarea',
			'mode' => 'css',
			'theme' => 'chrome',
			'title' => __('Design Edits', 'wpex'),
			'subtitle' => __('Quickly add some CSS to your theme to make design adjustements by adding it to this block. It is a much better solution then manually editing style.css', 'wpex'),
			'validate' => 'css',
		),
	)
);



// Theme Info -------------------------------------------------------------------------- >
$wpex_docs_img_url = get_template_directory_uri() . '/images/docs/';
$sections[] = array(
	'icon_class' => 'el-icon-large',
	'icon' => 'el-icon-retweet',
	'title' => __('Theme Updates', 'wpex'),'submenu' => true,
	'fields' => array(
		array(
			'id'=>'enable_auto_updates',
			'type' => 'switch', 
			'title' => __( 'Enable Auto Updates', 'wpex' ),
			'subtitle'=> __('You can toggle the automatic updates for your theme on or off.', 'wpex'),
			"default" => '0',
			'on' => __('On', 'wpex' ),
			'off' => __('Off', 'wpex' ),
		),
		array(
			'id'=>'envato_license_key',
			'type' => 'text',
			'title' => __('Item Purchase Code', 'wpex'),
			'subtitle' => __('Enter your Envato license key here if you wish to receive auto updates for your theme.', 'wpex') .'<br /><br /><img src="'. $wpex_docs_img_url .'envato-license-key.png" />',
			'required' => array('enable_auto_updates','equals','1'),
		),
	)
);


global $ReduxFramework;
$ReduxFramework = new ReduxFramework($sections, $args, $tabs);

// Function used to retrieve theme option values
if ( ! function_exists('wpex_option') ) {
	function wpex_option($id, $fallback = false, $param = false ) {
		global $wpex_options;
		if ( $fallback == false ) $fallback = '';
		$output = ( isset($wpex_options[$id]) && $wpex_options[$id] !== '' ) ? $wpex_options[$id] : $fallback;
		if ( !empty($wpex_options[$id]) && $param ) {
			$output = $wpex_options[$id][$param];
		}
		return $output;
	}
}