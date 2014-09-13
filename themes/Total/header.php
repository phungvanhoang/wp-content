<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */ ?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title><?php wp_title(''); ?><?php if( wp_title('', false) ) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if ( wpex_option('custom_favicon') ) : ?>
    	<link rel="shortcut icon" href="<?php echo wpex_option('custom_favicon'); ?>" />
    <?php endif; ?>
	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" href="http://substanceabuserehabs.com/wp-content/themes/Total/custom.css">
	<!-- Pinterest -->
	<meta name="p:domain_verify" content="7dc715d9faeae1fadbb59fada6ab3d7f"/>
</head>

<!-- Begin Body -->
<body <?php body_class(); ?>>

	<div id="wrap" class="clr">
	
		<?php
		// Display header if enabled
		// See functions/header-display.php
		if ( wpex_display_header() == true ) { ?>
			<?php
			// Get header style
			// See functions/header-display.php
			$wpex_header_style = wpex_get_header_style();
			get_template_part( 'headers/header', $wpex_header_style ); ?>
		<?php } ?>

	<div id="main" class="site-main clr">