<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'wpex_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function wpex_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'wpex_';
	
	// PAGE
	$meta_boxes[] = array(
		'id'        	=> 'wpex-page-meta',
		'title'     	=> __( 'Page Settings', 'wpex' ),
		'pages'     	=> array( 'page' ),
		'context'   	=> 'normal',
		'priority'  	=> 'high',
		'show_names'	=> true,
		'fields'    	=> array(
			array(
				'name' 		=> __( 'Site Layout', 'wpex' ),
				'id'		=> $prefix . 'main_layout',
				'desc'		=> '',
				'type'		=> 'select',
				'options'	=> array(
					array(
						'name'	=> __( 'Full-Width', 'wpex' ),
						'value'	=> 'full-width',
					),
					array(
						'name'	=> __( 'Boxed', 'wpex' ),
						'value'	=> 'boxed',
					),
				),
			),
			array(
				'name' 		=> __( 'Page Layout', 'wpex' ),
				'id'		=> $prefix . 'post_layout',
				'desc'		=> '',
				'type'		=> 'select',
				'options'	=> array(
					array(
						'name'	=> __( 'Default', 'wpex' ),
						'value'	=> '',
					),
					array(
						'name'	=> __( 'Right Sidebar', 'wpex' ),
						'value'	=> 'right-sidebar',
					),
					array(
						'name'	=> __( 'Left Sidebar', 'wpex' ),
						'value'	=> 'left-sidebar',
					),
					array(
						'name'	=> __( 'No Sidebar', 'wpex' ),
						'value'	=> 'full-width',
					),
					array(
						'name'	=> __( 'Full Screen', 'wpex' ),
						'value'	=> 'full-screen',
					),
				),
			),
			array(
				'name'	=> __( 'Disable Header', 'wpex' ),
				'desc'	=> __( 'Check to disable the main header.', 'wpex' ),
				'id'  	=> $prefix . 'disable_header',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Title', 'wpex' ),
				'desc'	=> __( 'Check to disable the main title.', 'wpex' ),
				'id'  	=> $prefix . 'disable_title',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Title Margin', 'wpex' ),
				'desc'	=> __( 'Check to disable the bottom margin on the main page header.', 'wpex' ),
				'id'  	=> $prefix . 'disable_header_margin',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Callout', 'wpex' ),
				'desc'	=> __( 'Check to disable the footer callout area if active.', 'wpex' ),
				'id'  	=> $prefix . 'disable_footer_callout',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Footer', 'wpex' ),
				'desc'	=> __( 'Check to disable the main footer.', 'wpex' ),
				'id'  	=> $prefix . 'disable_footer',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Page Subheading', 'wpex' ),
				'desc'	=> __( 'Enter your page subheading. Shortcodes & HTML is allowed.', 'wpex' ),
				'id'  	=> $prefix . 'post_subheading',
				'type'	=> 'text',
			),
			array(
				'name'	=> __( 'Slider Shortcode', 'wpex' ),
				'desc'	=> __( 'Enter a slider shortcode here to display a slider at the top of the page.', 'wpex' ),
				'id'  	=> $prefix . 'post_slider_shortcode',
				'type'	=> 'textarea_code',
			),
			array(
				'name'	=> __( 'Slider Bottom Margin', 'wpex' ),
				'desc'	=> __( 'Enter a bottom margin for your slider in pixels', 'wpex' ),
				'id'  	=> $prefix . 'post_slider_bottom_margin',
				'type'	=> 'text',
			),
			array(
				'name' 		=> __( 'Title Style', 'wpex' ),
				'id'		=> $prefix . 'post_title_style',
				'desc'		=> '',
				'type'		=> 'select',
				'options'	=> array(
					array(
						'name'	=> __( 'Default', 'wpex' ),
						'value'	=> '',
					),
					array(
						'name'	=> __( 'Centered', 'wpex' ),
						'value'	=> 'centered',
					),
					array(
						'name'	=> __( 'Centered Minimal', 'wpex' ),
						'value'	=> 'centered-minimal',
					),
					array(
						'name'	=> __( 'Background Image', 'wpex' ),
						'value'	=> 'background-image',
					),
				),
			),
			array(
				'name'	=> __( 'Title Background Image', 'wpex' ),
				'desc'	=> __( 'Select a custom header image for your main title.', 'wpex' ),
				'id'  	=> $prefix . 'post_title_background',
				'type'	=> 'file',
			),
			array(
				'name'	=> __( 'Title Background Height', 'wpex' ),
				'desc'	=> __( 'Select your custom height for your title background. Default is 400px.', 'wpex' ),
				'id'  	=> $prefix . 'post_title_height',
				'type'	=> 'text_small',
			),
		)
	);
	
	
	
	// Posts
	$meta_boxes[] = array(
		'id'        	=> 'wpex-post-metabox',
		'title'     	=> __( 'Post Settings', 'wpex' ),
		'pages'     	=> array( 'post' ),
		'context'   	=> 'normal',
		'priority'  	=> 'high',
		'show_names'	=> true,
		'fields'    	=> array(
			array(
				'name' 		=> __( 'Select Layout', 'wpex' ),
				'id'		=> $prefix . 'post_layout',
				'desc'		=> '',
				'type'		=> 'select',
				'options'	=> array(
					array(
						'name'	=> __( 'Default', 'wpex' ),
						'value'	=> '',
					),
					array(
						'name'	=> __( 'Right Sidebar', 'wpex' ),
						'value'	=> 'right-sidebar',
					),
					array(
						'name'	=> __( 'Left Sidebar', 'wpex' ),
						'value'	=> 'left-sidebar',
					),
					array(
						'name'	=> __( 'No Sidebar', 'wpex' ),
						'value'	=> 'full-width',
					),
				),
			),
			array(
				'name'	=> __( 'Disable Header', 'wpex' ),
				'desc'	=> __( 'Check to disable the main header.', 'wpex' ),
				'id'  	=> $prefix . 'disable_header',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Title', 'wpex' ),
				'desc'	=> __( 'Check to disable the main title.', 'wpex' ),
				'id'  	=> $prefix . 'disable_title',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Title Margin', 'wpex' ),
				'desc'	=> __( 'Check to disable the bottom margin on the main page header.', 'wpex' ),
				'id'  	=> $prefix . 'disable_header_margin',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Callout', 'wpex' ),
				'desc'	=> __( 'Check to disable the footer callout area if active.', 'wpex' ),
				'id'  	=> $prefix . 'disable_footer_callout',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Footer', 'wpex' ),
				'desc'	=> __( 'Check to disable the main footer.', 'wpex' ),
				'id'  	=> $prefix . 'disable_footer',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Slider Shortcode', 'wpex' ),
				'desc'	=> __( 'Enter a slider shortcode here to display a slider at the top of the page.', 'wpex' ),
				'id'  	=> $prefix . 'post_slider_shortcode',
				'type'	=> 'textarea_code',
			),
			array(
				'name'	=> __( 'Slider Bottom Margin', 'wpex' ),
				'desc'	=> __( 'Enter a bottom margin for your slider in pixels', 'wpex' ),
				'id'  	=> $prefix . 'post_slider_bottom_margin',
				'type'	=> 'text',
			),
			array(
				'name'	=> __( 'oEmbed URL', 'wpex' ),
				'desc'	=>  __( 'Enter a URL that is compatible with WP\'s built-in oEmbed feature. This setting is used for your video and audio post formats.', 'wpex' ) .'<br /><a href="http://codex.wordpress.org/Embeds" target="_blank">'. __( 'Learn More', 'wpex' ) .' &rarr;</a>',
				'id'	=> $prefix . 'post_oembed',
				'type'	=> 'text',
				'std'	=> ''
       		),
			array(
				'name'	=> __( 'Self Hosted', 'wpex' ),
				'desc'	=>  __( 'Insert your self hosted video or audio url here.', 'wpex' ) .'<br /><a href="http://make.wordpress.org/core/2013/04/08/audio-video-support-in-core/" target="_blank">'. __( 'Learn More', 'wpex' ) .' &rarr;</a>',
				'id'	=> $prefix . 'post_self_hosted_shortcode',
				'type'	=> 'file',
				'std'	=> ''
       		),
		)
	);
	
	// Testimonials
	$meta_boxes[] = array(
		'id'        	=> 'wpex_testimonials_metabox',
		'title'     	=> __( 'Post Settings', 'wpex' ),
		'pages'     	=> array( 'testimonials' ),
		'context'   	=> 'normal',
		'priority'  	=> 'high',
		'show_names'	=> true,
		'fields'    	=> array(
		
			array(
				'name'		=> __( 'Author', 'wpex' ),
				'desc'		=> __( 'Enter the name of the author for this testimonial.', 'wpex' ),
				'id'		=> $prefix .'testimonial_author',
				'type'		=> 'text',
				'std'		=> '',
			),
			
			array(
				'name'		=> __( 'Company', 'wpex' ),
				'desc'		=> __( 'Enter the name of the company for this testimonial.', 'wpex' ),
				'id'		=> $prefix .'testimonial_company',
				'type'		=> 'text',
				'std'		=> '',
			),
			
			array(
				'name'		=> __( 'Company URL', 'wpex' ),
				'desc'		=> __( 'Enter the url for the company for this testimonial.', 'wpex' ),
				'id'		=> $prefix .'testimonial_url',
				'type'		=> 'text',
				'std'		=> '',
			),
			
		)
	);
	
	// Staff
	$meta_boxes[] = array(
		'id'        	=> 'wpex_staff_metabox',
		'title'     	=> __( 'Post Settings', 'wpex' ),
		'pages'     	=> array( 'staff' ),
		'context'   	=> 'normal',
		'priority'  	=> 'high',
		'show_names'	=> true,
		'fields'    	=> array(
			array(
				'name'		=> __( 'Position', 'wpex' ),
				'id'		=> $prefix .'staff_position',
				'type'		=> 'text',
				'std'		=> '',
			),
			array(
				'name'		=> __( 'Twitter URl', 'wpex' ),
				'id'		=> $prefix .'staff_twitter',
				'type'		=> 'text',
				'std'		=> '',
			),
			array(
				'name'		=> __( 'Facebook URl', 'wpex' ),
				'id'		=> $prefix .'staff_facebook',
				'type'		=> 'text',
				'std'		=> '',
			),
			array(
				'name'		=> __( 'Google Plus URl', 'wpex' ),
				'id'		=> $prefix .'staff_google-plus',
				'type'		=> 'text',
				'std'		=> '',
			),
			array(
				'name'		=> __( 'LinkedIn URl', 'wpex' ),
				'id'		=> $prefix .'staff_linkedin',
				'type'		=> 'text',
				'std'		=> '',
			),
			array(
				'name'		=> __( 'Dribbble URl', 'wpex' ),
				'id'		=> $prefix .'staff_dribbble',
				'type'		=> 'text',
				'std'		=> '',
			),
			array(
				'name' 		=> __( 'Select Layout', 'wpex' ),
				'id'		=> $prefix . 'post_layout',
				'desc'		=> '',
				'type'		=> 'select',
				'options'	=> array(
					array(
						'name'	=> __( 'Default', 'wpex' ),
						'value'	=> '',
					),
					array(
						'name'	=> __( 'Right Sidebar', 'wpex' ),
						'value'	=> 'right-sidebar',
					),
					array(
						'name'	=> __( 'Left Sidebar', 'wpex' ),
						'value'	=> 'left-sidebar',
					),
					array(
						'name'	=> __( 'No Sidebar', 'wpex' ),
						'value'	=> 'full-width',
					),
					array(
						'name'	=> __( 'Full Screen', 'wpex' ),
						'value'	=> 'full-screen',
					),
				),
			),
			array(
				'name'	=> __( 'Disable Header', 'wpex' ),
				'desc'	=> __( 'Check to disable the main header.', 'wpex' ),
				'id'  	=> $prefix . 'disable_header',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Title', 'wpex' ),
				'desc'	=> __( 'Check to disable the main title.', 'wpex' ),
				'id'  	=> $prefix . 'disable_title',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Title Margin', 'wpex' ),
				'desc'	=> __( 'Check to disable the bottom margin on the main page header.', 'wpex' ),
				'id'  	=> $prefix . 'disable_header_margin',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Callout', 'wpex' ),
				'desc'	=> __( 'Check to disable the footer callout area if active.', 'wpex' ),
				'id'  	=> $prefix . 'disable_footer_callout',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Footer', 'wpex' ),
				'desc'	=> __( 'Check to disable the main footer.', 'wpex' ),
				'id'  	=> $prefix . 'disable_footer',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Page Subheading', 'wpex' ),
				'desc'	=> __( 'Enter your page subheading. Shortcodes & HTML is allowed.', 'wpex' ),
				'id'  	=> $prefix . 'post_subheading',
				'type'	=> 'text',
			),
			array(
				'name'	=> __( 'Slider Shortcode', 'wpex' ),
				'desc'	=> __( 'Enter a slider shortcode here to display a slider at the top of the page.', 'wpex' ),
				'id'  	=> $prefix . 'post_slider_shortcode',
				'type'	=> 'textarea_code',
			),
			array(
				'name'	=> __( 'Slider Bottom Margin', 'wpex' ),
				'desc'	=> __( 'Enter a bottom margin for your slider in pixels', 'wpex' ),
				'id'  	=> $prefix . 'post_slider_bottom_margin',
				'type'	=> 'text',
			),
			array(
				'name' 		=> __( 'Title Style', 'wpex' ),
				'id'		=> $prefix . 'post_title_style',
				'desc'		=> '',
				'type'		=> 'select',
				'options'	=> array(
					array(
						'name'	=> __( 'Default', 'wpex' ),
						'value'	=> '',
					),
					array(
						'name'	=> __( 'Centered', 'wpex' ),
						'value'	=> 'centered',
					),
					array(
						'name'	=> __( 'Centered Minimal', 'wpex' ),
						'value'	=> 'centered-minimal',
					),
					array(
						'name'	=> __( 'Background Image', 'wpex' ),
						'value'	=> 'background-image',
					),
				),
			),
			array(
				'name'	=> __( 'Title Background Image', 'wpex' ),
				'desc'	=> __( 'Select a custom header image for your main title.', 'wpex' ),
				'id'  	=> $prefix . 'post_title_background',
				'type'	=> 'file',
			),
			array(
				'name'	=> __( 'Title Background Height', 'wpex' ),
				'desc'	=> __( 'Select your custom height for your title background. Default is 400px.', 'wpex' ),
				'id'  	=> $prefix . 'post_title_height',
				'type'	=> 'text_small',
			),
		)
	);


	// Portfolio
	$meta_boxes[] = array(
		'id'        	=> 'wpex-portfolio',
		'title'     	=> __( 'Post Settings', 'wpex' ),
		'pages'     	=> array( 'portfolio' ),
		'context'   	=> 'normal',
		'priority'  	=> 'high',
		'show_names'	=> true,
		'fields'    	=> array(
			array(
				'name' 		=> __( 'Select Layout', 'wpex' ),
				'id'		=> $prefix . 'post_layout',
				'desc'		=> '',
				'type'		=> 'select',
				'options'	=> array(
					array(
						'name'	=> __( 'Default', 'wpex' ),
						'value'	=> '',
					),
					array(
						'name'	=> __( 'Right Sidebar', 'wpex' ),
						'value'	=> 'right-sidebar',
					),
					array(
						'name'	=> __( 'Left Sidebar', 'wpex' ),
						'value'	=> 'left-sidebar',
					),
					array(
						'name'	=> __( 'No Sidebar', 'wpex' ),
						'value'	=> 'full-width',
					),
					array(
						'name'	=> __( 'Full Screen', 'wpex' ),
						'value'	=> 'full-screen',
					),
				),
			),
			array(
				'name'	=> __( 'Disable Header', 'wpex' ),
				'desc'	=> __( 'Check to disable the main header.', 'wpex' ),
				'id'  	=> $prefix . 'disable_header',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Title', 'wpex' ),
				'desc'	=> __( 'Check to disable the main title.', 'wpex' ),
				'id'  	=> $prefix . 'disable_title',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Title Margin', 'wpex' ),
				'desc'	=> __( 'Check to disable the bottom margin on the main page header.', 'wpex' ),
				'id'  	=> $prefix . 'disable_header_margin',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Callout', 'wpex' ),
				'desc'	=> __( 'Check to disable the footer callout area if active.', 'wpex' ),
				'id'  	=> $prefix . 'disable_footer_callout',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Disable Footer', 'wpex' ),
				'desc'	=> __( 'Check to disable the main footer.', 'wpex' ),
				'id'  	=> $prefix . 'disable_footer',
				'type'	=> 'checkbox',
			),
			array(
				'name'	=> __( 'Page Subheading', 'wpex' ),
				'desc'	=> __( 'Enter your page subheading. Shortcodes & HTML is allowed.', 'wpex' ),
				'id'  	=> $prefix . 'post_subheading',
				'type'	=> 'text',
			),
			array(
				'name'	=> __( 'Slider Shortcode', 'wpex' ),
				'desc'	=> __( 'Enter a slider shortcode here to display a slider at the top of the page.', 'wpex' ),
				'id'  	=> $prefix . 'post_slider_shortcode',
				'type'	=> 'textarea_code',
			),
			array(
				'name'	=> __( 'Slider Bottom Margin', 'wpex' ),
				'desc'	=> __( 'Enter a bottom margin for your slider in pixels', 'wpex' ),
				'id'  	=> $prefix . 'post_slider_bottom_margin',
				'type'	=> 'text',
			),
			array(
				'name' 		=> __( 'Title Style', 'wpex' ),
				'id'		=> $prefix . 'post_title_style',
				'desc'		=> '',
				'type'		=> 'select',
				'options'	=> array(
					array(
						'name'	=> __( 'Default', 'wpex' ),
						'value'	=> '',
					),
					array(
						'name'	=> __( 'Centered', 'wpex' ),
						'value'	=> 'centered',
					),
					array(
						'name'	=> __( 'Centered Minimal', 'wpex' ),
						'value'	=> 'centered-minimal',
					),
					array(
						'name'	=> __( 'Background Image', 'wpex' ),
						'value'	=> 'background-image',
					),
				),
			),
			array(
				'name'	=> __( 'Title Background Image', 'wpex' ),
				'desc'	=> __( 'Select a custom header image for your main title.', 'wpex' ),
				'id'  	=> $prefix . 'post_title_background',
				'type'	=> 'file',
			),
			array(
				'name'	=> __( 'Title Background Height', 'wpex' ),
				'desc'	=> __( 'Select your custom height for your title background. Default is 400px.', 'wpex' ),
				'id'  	=> $prefix . 'post_title_height',
				'type'	=> 'text_small',
			),
		),
	);
	
	

	return $meta_boxes;
}

add_action( 'init', 'cmb_initializewpexmeta_boxes', 9999 );

/**
 * Initialize the metabox class.
 */
function cmb_initializewpexmeta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once( get_template_directory() .'/functions/meta/init.php' );

}