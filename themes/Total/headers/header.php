<?php
/**
 * Header Style One
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
?>
<header id="site-header" class="header-one clr <?php if ( wpex_option( 'fixed_header', '1' ) == '1' && !wp_is_mobile() ) echo 'fixed-scroll'; ?>" role="banner">
	<div id="site-header-inner" class="header-one-inner container clr">
		<?php
		// Responsive menu - see functions/mobile-menu.php
		wpex_mobile_menu(); ?>
		<div id="site-logo" class="header-one-logo">
			<?php if ( wpex_option('custom_logo', false, 'url') !== '' ) : ?>
				<?php /* Custom Image Logo */ ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo wpex_option('custom_logo', false, 'url'); ?>" alt="<?php get_bloginfo( 'name' ) ?>" /></a>
			<?php else : ?>
				<?php /* Standard Logo */ ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a>                  
			<?php endif; ?>
		</div><!-- .header-one-logo -->
		<?php
		// Add extra classes to the menu
		$wpex_menu_classes = '';
		if ( wpex_option( 'main_search', '1' ) == '1' ) {
			$wpex_menu_classes .= 'site-navigation-with-search';
			if ( class_exists('Woocommerce') && wpex_option( 'woo_menu_icon', '1' ) !== '1' ) {
				$wpex_menu_classes .= ' site-navigation-without-cart-icon';
			} elseif ( !class_exists('Woocommerce') ) {
				$wpex_menu_classes .= ' site-navigation-without-cart-icon';
			}
		} ?>	
		<div id="site-navigation-wrap" class="clr navbar-style-one">   
			<nav id="site-navigation" class="navigation main-navigation clr <?php echo $wpex_menu_classes; ?>" role="navigation">
				<?php
				// Display main menu
				wp_nav_menu( array(
					'theme_location'	=> 'main_menu',
					'sort_column'		=> 'menu_order',
					'menu_class'		=> 'dropdown-menu sf-menu',
					'fallback_cb'		=> false,
					'walker'			=> new WPEX_Dropdown_Walker_Nav_Menu()
				) ); ?>
				<?php
				// Display search icon toggle
				if ( wpex_option( 'main_search', '1' ) == '1' ) { ?>
					<a href="#site-searchform" class="site-search-toggle"><span class="fa fa-search"></span></a>
				<?php } ?>
			</nav><!-- #site-navigation -->
		</div><!-- #navbar-one -->
	</div><!-- #navbar-inner -->
</header><!-- #header -->