<?php
// Register Shortcode -------------------------------------------------------------------------- >
if( !function_exists('vcex_login_form_shortcode') ) {
	
	function vcex_login_form_shortcode( $atts, $content=NULL ) {
		
		// Shortcode params
		extract( shortcode_atts( array(
			'unique_id'		=> '',
			'redirect'			=> '',
		  ),
		  $atts ) );
		  
		// If user is logged return text
		if ( is_user_logged_in() ) {
			return $content;
		}
		  
		 if ( $redirect == '' ) {
		 	$redirect = site_url( $_SERVER['REQUEST_URI'] );
		 }
		  
		 // Form args
		 $args = array(
		 	'echo' => true,
			'redirect' => $redirect, 
			'form_id' => 'vcex-loginform',
			'label_username' => __( 'Username', 'vcex' ),
			'label_password' => __( 'Password', 'vcex' ),
			'label_remember' => __( 'Remember Me', 'vcex' ),
			'label_log_in' => __( 'Log In', 'vcex' ),
			'remember' => true,
			'value_username' => NULL,
			'value_remember' => false,
		);
		
		// Ouput form
		ob_start(); ?>
		
			<div class="vcex-login-form clr">
				<?php wp_login_form($args); ?>
			</div><!-- .vcex-login-form -->

		<?php
		echo ob_get_clean();
		
	} // End shortcode function
	
} // End if

add_shortcode( 'vcex_login_form', 'vcex_login_form_shortcode' );


// Add To Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Login Form", 'vcex' ),
	"base"					=> "vcex_login_form",
	"class"					=> "",
	"category"				=> __( "Content", "wpex" ),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-login_form",
	"params"				=> array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Redirect", 'vcex' ),
			"param_name"	=> "redirect",
			"value"			=> "",
			"description"	=> __( "Enter a URL to redirect the user after they successfully log in. Leave blank to redirect to the current page.","wpex"),
		),
		array(
			"type"			=> "textarea_html",
			"heading"		=> __( "Logged in Content", 'vcex' ),
			"param_name" 	=> "content",
			"value"			=> __('You are currently logged in','vcex'),
			"description"	=> __( "The content to displayed for logged in users.","wpex"),
		),
	)
) );
?>