<?php
/**
 * Header Style Two
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
?>
<header id="site-header" class="header-two clr <?php if ( wpex_option( 'static_header', '1' ) == '1' && !wp_is_mobile() ) echo 'fixed-scroll'; ?>" role="banner">
	<div id="site-header-inner" class="header-two-inner container clr">
		<?php
		// Responsive menu - see functions/mobile-menu.php
		wpex_mobile_menu(); ?>
		<div id="site-logo" class="header-two-logo">
			<?php
			//Custom image logo
			if ( wpex_option('custom_logo', false, 'url') !== '' ) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo wpex_option('custom_logo', false, 'url'); ?>" alt="<?php get_bloginfo( 'name' ) ?>" /></a>
			<?php
			// Standard text logo
			} else { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a>                  
			<?php } ?>
		</div><!-- .header-two-logo -->
		<aside id="header-aside" class=" header-two-aside clr">
			<span class="goldHeading">Immediate Help Available 24/7</span>
			<span class="headPhone">800.840.4056</span>
				</aside><!-- #header-two-aside -->
	</div><!-- #header-two-inner -->
	<div id="site-navigation-wrap" class="clr navbar-style-two">      
			<nav id="site-navigation" class="navigation main-navigation container clr" role="navigation">
			<?php
			// Display main menu
			wp_nav_menu( array(
				'theme_location'	=> 'main_menu',
				'sort_column'		=> 'menu_order',
				'menu_class'		=> 'dropdown-menu sf-menu',
				'fallback_cb'		=> false,
				'walker'			=> new WPEX_Dropdown_Walker_Nav_Menu()
			) ); ?>
		</nav><!-- #site-navigation -->
	</div><!-- #navbar-two -->
	<?php
	// Cart widget displays current items in the cart
	wpex_cart_widget(); ?>
</header><!-- #header-two -->