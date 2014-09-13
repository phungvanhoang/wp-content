<?php
// Register Shortcode -------------------------------------------------------------------------- >
if( !function_exists('vcex_newsletter_form_shortcode') ) {
	
	function vcex_newsletter_form_shortcode( $atts ) {
		
		// Shortcode params
		extract( shortcode_atts( array(
			'provider'					=> '',
			'mailchimp_form_action'	=> '',
			'input_width'				=> '100%',
			'input_height'				=> '50px',
			'placeholder_text'			=> '',
		  ),
		$atts ) );
		
		// Vars
		$output='';
		
			// Mailchimp
			if ( $provider == 'mailchimp' ) {
				$output .='<div class="vcex-newsletter-form clr">';
					$output .='<!-- Begin MailChimp Signup Form -->
								<div id="mc_embed_signup" class="vcex-newsletter-form-wrap" style="width: '. $input_width .';">
									<form action="'. $mailchimp_form_action .'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
										<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" style="height: '. $input_height .'" placeholder="'. $placeholder_text .'">
										<input type="submit" value="" name="subscribe" id="mc-embedded-subscribe" class="vcex-newsletter-form-button">
									</form>
								</div><!--End mc_embed_signup-->';
				$output .='</div><!-- .vcex-newsletter-form -->';
			}

		
		// Return output
		return $output;
		
	} // End shortcode function
	
} // End if

add_shortcode( 'vcex_newsletter_form', 'vcex_newsletter_form_shortcode' );


// Add To Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Newsletter Form", 'vcex' ),
	"base"					=> "vcex_newsletter_form",
	"class"					=> "",
	"category"				=> __( "Content", "wpex" ),
	'admin_enqueue_js'		=> "",
	'admin_enqueue_css'	=> "",
	"icon" 					=> "icon-wpb-vcex-newsletter_form",
	"params"				=> array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Input Width", 'vcex' ),
			"param_name"	=> "input_width",
			"value"			=> '100%',
			"description"	=> __( "Enter a width for your input form. It can be in px or %.","wpex"),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Input Height", 'vcex' ),
			"param_name"	=> "input_height",
			"value"			=> '50px',
			"description"	=> __( "Enter a width for your input form in pixels.","wpex"),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Placeholder Text", 'vcex' ),
			"param_name"	=> "placeholder_text",
			"value"			=> __('Enter your email address','vcex'),
			"description"	=> __( "Enter your custom placeholder text","wpex"),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Provider", 'vcex' ),
			"param_name"	=> "provider",
			"value"			=> array(
				'MailChimp'	=> 'mailchimp',
			),
			"description"	=> __( "Select your newsletter provider.","wpex"),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Mailchimp Form Action", 'vcex' ),
			"param_name"	=> "mailchimp_form_action",
			"value"			=> "http://domain.us1.list-manage.com/subscribe/post?u=numbers_go_here",
			"description"	=> __( "Enter the MailChimp form action URL.","wpex"),
			"dependency" => Array('element'	=> "provider", 'value' => "mailchimp" ),
		),
	)
) );
?>