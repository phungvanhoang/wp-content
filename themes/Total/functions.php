<?php
/**
 * Total functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
 
 
 
/*------------------------------------------------*/
/* - Define Constants
/*------------------------------------------------*/

define( 'WPEX_JS_DIR_URI', get_template_directory_uri().'/js/' );
define( 'WPEX_CSS_DIR_UIR', get_template_directory_uri().'/css/' );
define( 'WPEX_DUMMY_THUMB_URL', get_template_directory_uri().'/images/base/dummy-image.png' );


/*------------------------------------------------*/
/* - Globals & Theme Setup
/*------------------------------------------------*/

// Define the default $content_width variable
if ( ! isset( $content_width ) ) $content_width = 980;

// Theme setup - load_theme_domain, add_theme_support, register_nav_menus
require_once( get_template_directory() .'/functions/theme-setup.php' );

// Recommend some useful plugins for this theme via TGMA script
require_once( get_template_directory() .'/functions/recommend-plugins.php' );


/*------------------------------------------------*/
/* - ReduxFramework Admin Panel
/*------------------------------------------------*/

// Include the Redux theme options Framework
if ( !class_exists( 'ReduxFramework' ) ) {
	require_once( dirname( __FILE__ ) . '/admin/framework.php' );
}

// Tweak the Redux framework
// Register all the theme options
// Registers the wpex_option function
if ( !isset( $redux_demo ) ) {
	require_once( dirname( __FILE__ ) . '/functions/admin-config.php' );
}

// Define branding constant based on theme options
$wpex_theme_branding = wpex_option( 'theme_branding', 'Total' );
define( 'WPEX_THEME_BRANDING', $wpex_theme_branding );


/*------------------------------------------------*/
/* - CSS / JS
/*------------------------------------------------*/

// Loads all the core css and js for this theme
if ( ! is_admin() ) {
	require_once( get_template_directory() .'/functions/scripts.php' );
}


/*------------------------------------------------*/
/* - Site Styling, Layout, Custom Fonts
/*------------------------------------------------*/

// outputs css for theme panel styling options
require_once( get_template_directory() .'/functions/styling.php' );

// outputs css for theme panel layout options
require_once( get_template_directory() .'/functions/layout.php' );

// outputs custom css from theme options
require_once( get_template_directory() .'/functions/custom-css.php' );


/*------------------------------------------------*/
/* - Other Theme Functions
/*------------------------------------------------*/

// Non Admin Function
if ( is_admin() ) {
	
	// TinyMCE buttons & edits
	require_once( get_template_directory() .'/functions/tinymce/mce-buttons.php' );
		
	// Gallery metabox function used to define images for your gallery post format
	require_once( get_template_directory() .'/functions/meta/gallery-metabox/gmb-admin.php' );
	
	// Function used to display featured images in your dashboard columns
	if ( wpex_option( 'blog_dash_thumbs', '1' ) == '1' ) {
		require_once( get_template_directory() .'/functions/dashboard-thumbnails.php' );
	}

// Non Admin functions	
} else {
	
	// Returns the correct grid class based on column numbers
	require_once( get_template_directory() .'/functions/grid.php' );
	
	// Retuns the correct post layout class
	require_once( get_template_directory() .'/functions/post-layout.php' );
	
	// Adds additional classes to your posts
	require_once( get_template_directory() .'/functions/post-classes.php' );
	
	// Show/hide the main header depending on current post meta
	require_once( get_template_directory() .'/functions/header-display.php' );
	
	// Used for the overlay style search
	require_once( get_template_directory() .'/functions/search-overlay.php');
	
	// Show/hide the main footer depending on current post meta
	require_once( get_template_directory() .'/functions/footer-display.php' );
	
	// Show/hide the footer callout depending on current post meta
	require_once( get_template_directory() .'/functions/footer-callout.php' );
	
	// Displays the copyright info in the footer
	require_once( get_template_directory() .'/functions/footer-copyright.php' );
	
	// Adds custom classes to blog wraps based on blog styles
	require_once( get_template_directory() .'/functions/blog-classes.php' );
	
	// Exclude blog categories from the main blog page / index
	require_once( get_template_directory() .'/functions/blog-exclude-categories.php' );
	
	// Output custom classes to the body tag
	require_once( get_template_directory() .'/functions/body-classes.php' );

	// Some cool function functions to tweak widgets
	require_once( get_template_directory() .'/functions/widgets/widget-tweaks.php' );
	
	// Returns the correct sidebar region depending on the post/page/archive and theme settings
	require_once( get_template_directory() .'/functions/widgets/get-sidebar.php' );
	
	// Returns the correct cropped or non-cropped featured image URLs - Requires that the AquaResizer is called first
	require_once( get_template_directory() .'/functions/featured-images.php');
	
	// outputs code in the <head> tag for your favicons
	require_once( get_template_directory() .'/functions/favicon-apple-icons.php' );
	
	// outputs js for your retina logo
	require_once( get_template_directory() .'/functions/retina-logo.php' );
	
	// outputs css for theme panel responsive width options
	require_once( get_template_directory() .'/functions/responsive-widths.php' );
	
	// outputs HTML and loads scripts for the responsive toggle menu
	require_once( get_template_directory() .'/functions/mobile-menu.php' );
	
	// outputs your tracking code in the <head> tag
	require_once( get_template_directory() .'/functions/tracking-code.php' );
	
	// used to add CSS to the <head> tag for your custom background settings
	require_once( get_template_directory() .'/functions/backgrounds.php' );
	
	// Used to tweak the_excerpt() function and also defines the wpex_excerpt() function
	require_once( get_template_directory() .'/functions/excerpts.php' );
	
	// Creates an array of font awesome icons for use in your theme
	require_once( get_template_directory() .'/functions/font-awesome.php');
	
	// Built-in breadcrumbs function
	require_once( get_template_directory() .'/functions/breadcrumbs.php' );
	
	// The main page title class - displays title/breadcrumbs/title backgrounds/subheading - etc.
	require_once( get_template_directory() .'/functions/page-header.php' );
	
	// Pagination functions - default, infinite scroll and next/prev
	require_once( get_template_directory() .'/functions/pagination.php' );
	
	// Next & Previous single post pagination
	require_once( get_template_directory() .'/functions/next-prev.php' );
	
	// Outputs the post meta for blog posts & entries
	require_once( get_template_directory() .'/functions/post-meta.php' );
	
	// Outputs the current post entry avatar
	require_once( get_template_directory() .'/functions/post-entry-author-avatar.php' );
	
	// Used for the readmore links on standard posts
	require_once( get_template_directory() .'/functions/post-readmore-link.php' );
	
	// Function used to alter the number of posts displayed for your custom post type archives
	require_once( get_template_directory() .'/functions/posts-per-page.php' );
	
	// Comments callback function
	require_once( get_template_directory() .'/functions/comments-callback.php');
	
	// Custom menu walker used to add classes & icons to menus
	require_once( get_template_directory() .'/functions/menu-walker.php');
	
	// Increase the quality of resized jpgs
	require_once( get_template_directory() .'/functions/better-jpgs.php' );
		
	// Image cropping/resizing script
	require_once( get_template_directory() .'/functions/aqua-resizer.php' );
	
	// Used to fix spacing issues with shortcodes
	require_once( get_template_directory() .'/functions/shortcodes-fix.php' );
	
	// Used to display images defined by the gallery metabox function
	require_once( get_template_directory() .'/functions/meta/gallery-metabox/gmb-display.php' );
	
	// Output social options as defined in the theme panel
	require_once( get_template_directory() .'/functions/social-output.php' );
	
	// Used to display your post slider as defined in the wpex_post_slider meta value
	require_once( get_template_directory() .'/functions/post-slider.php' );
	
	// Outputs the social sharing icons for posts and pages
	require_once( get_template_directory() .'/functions/social-share.php' );
	
	// Alter the default output of the WordPress gallery shortcode
	if ( wpex_option( 'custom_wp_gallery', '1' ) == '1' ) {
		require_once( get_template_directory() .'/functions/wp-gallery.php');
	}
	
} // End else - is_admin()

// Define the widget areas for this theme
require_once( get_template_directory() .'/functions/widgets/widget-areas.php' );

// Custom widgets
require_once( get_template_directory() .'/functions/widgets/widget-social.php' );
require_once( get_template_directory() .'/functions/widgets/widget-flickr.php' );
require_once( get_template_directory() .'/functions/widgets/widget-video.php' );
require_once( get_template_directory() .'/functions/widgets/widget-posts-thumbnails.php' );
require_once( get_template_directory() .'/functions/widgets/widget-recent-posts-thumb-grid.php' );
	
// Function used for defining meta options
require_once( get_template_directory() .'/functions/meta/usage.php');

// Meta fields for Standard Categories
require_once( get_template_directory() .'/functions/meta/taxonomies/category-meta.php');

// Loads some js in the backend for showing/hiding meta settings
require_once( get_template_directory() .'/functions/meta/display.php');

// A few small optimizations for speed - clean up the <head>, remove useless jetpack scripts, etc.
require_once( get_template_directory() .'/functions/optimizations.php');


/*------------------------------------------------*/
/* - Portfolio Post Type
/*------------------------------------------------*/

if ( wpex_option( 'portfolio_enable', '1' ) == '1' ) {
	
	// Register the portfolio post type
	require_once( get_template_directory() .'/functions/post-types-taxonomies/register-portfolio.php' );
	
	// Displays an array of portfolio categories
	require_once( get_template_directory() .'/functions/portfolio-categories.php' );
		
}


/*------------------------------------------------*/
/* - Post Series custom Taxonomy
/*------------------------------------------------*/

if ( wpex_option( 'post_series', '1' ) == '1' ) {
	
	// Registers the post series custom taxonomy for the standard post type
	require_once( get_template_directory() .'/functions/post-types-taxonomies/register-post-series.php' );
	
}

require_once( get_template_directory() .'/functions/post-series.php' );


/*------------------------------------------------*/
/* - Staff Post Type
/*------------------------------------------------*/

if ( wpex_option( 'staff_enable', '1' ) == '1' ) {
	
	// Register the staff custom post type
	require_once( get_template_directory() .'/functions/post-types-taxonomies/register-staff.php' );
	
}

if ( ! is_admin() ) {
	
	// Used to display the social options for your staff members
	require_once( get_template_directory() .'/functions/staff-social.php' );
	
	// Staff entry image overlay
	require_once( get_template_directory() .'/functions/staff-overlay.php' );

}


/*------------------------------------------------*/
/* - Testimonials Post Type
/*------------------------------------------------*/

if ( wpex_option( 'testimonials_enable', '1' ) == '1' ) {
	
	// Register the testimonials custom post type
	require_once( get_template_directory() .'/functions/post-types-taxonomies/register-testimonials.php' );
	
}


/*------------------------------------------------*/
/* - Custom Post Type & Taxonomy Functions
/*------------------------------------------------*/

// Function used to alter your post type labels via theme options
require_once( get_template_directory() .'/functions/post-types-taxonomies/post-type-labels.php' );

// Function used to alter your taxonomy labels via theme options
require_once( get_template_directory() .'/functions/post-types-taxonomies/taxonomies-labels.php' );

// Tweak custom post types based on theme options
require_once( get_template_directory() .'/functions/post-types-taxonomies/tweak.php' );


/*------------------------------------------------*/
/* - WooCommerce
/*------------------------------------------------*/

// WooCommerce specific functions
if ( class_exists('Woocommerce') ) {
	
	if ( ! is_admin() ) {
	
		// Adds classes for the WooCommerce main layouts - sidebar, no sidebar, etc.
		require_once( get_template_directory() .'/functions/woocommerce/woo-layouts.php' );
		
		// Remove Woo scripts
		require_once( get_template_directory() .'/functions/woocommerce/woo-scripts.php' );
		
		// Remove the ajax add to cart button for the shop
		require_once( get_template_directory() .'/functions/woocommerce/woo-remove-ajax-cart.php' );
		
		// Change default Woo loop classes
		require_once( get_template_directory() .'/functions/woocommerce/woo-loop-classes.php' );
		
		// Alter WooCommerce columns/pagination
		require_once( get_template_directory() .'/functions/woocommerce/woo-columns.php' );
		
		// Change default Woo Image sizes & other edits
		require_once( get_template_directory() .'/functions/woocommerce/woo-image-edits.php' );
		
		// Remove Woo scripts
		require_once( get_template_directory() .'/functions/woocommerce/woo-scripts.php' );
		
		// Remove the default Woo page title
		require_once( get_template_directory() .'/functions/woocommerce/woo-remove-page-title.php' );
		
		// Display shopping cart $ in the nav
		if ( wpex_option( 'woo_menu_icon', '1' ) == '1' ) {
			require_once( get_template_directory() .'/functions/woocommerce/woo-menucart.php' );
		}
	
	} // End if is admin
	
}

// Cart widget displays current cart items
if ( ! is_admin() ) {
	require_once( get_template_directory() .'/functions/woocommerce/woo-cartwidget.php' );
}


/*------------------------------------------------*/
/* - Visual Composer Tweaks
/*------------------------------------------------*/

// Set composer settings pages as settings page.
if( function_exists('vc_set_as_theme') ) {
	
	// Set Visual Composer to run in Theme Mode
	vc_set_as_theme(true);

	// Run the Visual Composer Extension
	if ( function_exists('visual_composer_extension_run') ) {
		visual_composer_extension_run();
	}
	
	// Remove certain default VC modules
	require_once( get_template_directory() .'/functions/visual-composer/remove.php' );
	
	// Add new parameters to VC items
	require_once( get_template_directory() .'/functions/visual-composer/add-params.php' );
	
	// Visual Composer Filter tweaks
	require_once( get_template_directory() .'/functions/visual-composer/filters.php' );
	
	// Remove teaser metabox
	if ( is_admin() ) {
		function wpex_remove_meta_boxes() {
			if( !current_user_can('manage_options') ) {
				remove_meta_box('linktargetdiv', 'link', 'normal');
			} // End privalages check
		} // End function
		add_action( 'admin_menu', 'wpex_remove_meta_boxes' );
	} // Is admin check

}


/*------------------------------------------------*/
/* - WP-Updates
/*------------------------------------------------*/

// Get user envato license as provided in theme panel
$wpex_envato_license_key = wpex_option( 'envato_license_key' );

// If envato license is defined load the auto update class and pass the license to it
if ( $wpex_envato_license_key && wpex_option( 'enable_auto_updates', '0' ) == '1' ) {
	require_once( get_template_directory() .'/wp-updates-theme.php');
	new WPUpdatesThemeUpdater_479( 'http://wp-updates.com/api/2/theme', basename(get_template_directory()), $wpex_envato_license_key );
}

/*------------Custom shortcode------------*/
function get_call_out_box($atts, $content=null) {
	extract(shortcode_atts(array(
	'topic' => 'alcohol',
	'drug'	=>	'drug'
			), $atts));
	

$alcohol="The decision to get help for ".$drug. " is never easy. Uncertainty, questions, and fears are all normal. Call our professional consultants, free of charge and commitment free, for answers and help to recovery";
$intervention="Have your love and concern been pushed to exhaustion by ".$drug. " addiction? Sometimes it takes a village. Call our treatment consultants to see how professional Intervention can help you help them.";
$detox="Experienced medical assistance can reduce the discomforts and dangers of withdrawal. If you need to detox, call our hotline pros. They’ll guide you quickly, smoothly, and safely to successful detox.";

	
	switch ($topic) {
		case 'alcohol':
			$callText=$alcohol;
			break;
		case 'intervention':
			$callText=$intervention;
			break;
		case 'detox':
			$callText=$detox;
			break;
	
	}

	
$toPrint='<div class="wpb_wrapper">
			<h2 class="alignCenter marginNone">'.$content.'</h2>

		</div> 
	</div> <hr class="vcex-spacing " style="height: 20px"><div class="clr vcex-row-skin-"><div class="wpb_row vc_row-fluid  ">
	<div class="vc_span6 wpb_column column_container ">
			
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<p>'.$callText.'<br>
<span class="goldColor font24 alignCenter">Immediate Help Available 24/7</span></p>

		</div> 
	</div> 
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<p><span class="font30 alignCenter"><strong>800.840.4056</strong></span></p>

		</div> 
	</div> 
	</div> 

	<div class="vc_span6 leftBorder wpb_column column_container ">
			
	<div class="wpb_raw_code wpb_content_element wpb_raw_html">
		<div class="wpb_wrapper">
			<form id="calloutForm" class="formFormat" method="POST" novalidate="novalidate">
<table class="formTable"><tbody><tr>
<td>
<label>Name <span>*</span></label>
<input maxlength="40" name="first_name" size="20" type="text">
</td>
<td>
<label>Phone Number<span>*</span></label>
<input maxlength="40" name="phone" size="20" type="tel">
</td>
</tr>
<tr>
<td colspan="2">
<input name="website" type="hidden" value="http://substanceabuserehabs.com">
<input name="oid" type="hidden" value="00DG0000000CLl1">
<input name="retURL" type="hidden" value="http://substanceabuserehabs.com/thanks/">
<input name="OwnerId" type="hidden" value="00GG0000001MB0uMAG">
<input name="recordType" type="hidden" value="012G0000001QDubIAG">
<input id="website2" style="display:none;" name="website2" type="text" value="">
<input id="website3" style="display:none;" name="website3" type="text" value="http://">
<input name="submit" type="submit" value="Contact Me Today >">
</td>
</tr>
</tbody></table>
</form>

		</div> 
	</div> 
	</div> 
</div>
';
	
	
	return $toPrint;
}

	
add_shortcode('callOutBox', 'get_call_out_box');
function scroll_for_more($atts) {
	
	return '<div class="vc_span12 wpb_column column_container ">
			
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<p><span class="scrollTo alignCenter">Scroll to Read More</span></p>

		</div> 
	</div> 
	<div class="wpb_single_image wpb_content_element wpb_animate_when_almost_visible wpb_top-to-bottom vc_align_center wpb_start_animation">
		<div class="wpb_wrapper">
			
			<img src="http://substanceabuserehabs.com/wp-content/uploads/2014/08/scroll-down-arrow1.gif" width="80" height="20" alt="scroll-down-arrow">
		</div> 
	</div> 
	</div>';
}
add_shortcode('scroll4More', 'scroll_for_more');
