<?php
/**
 * Outputs the responsive/mobile menu for the header
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/

if ( ! function_exists( 'wpex_mobile_menu' ) ) {
	
	function wpex_mobile_menu() {
		
		// If responsive is disabled, bail
		if( wpex_option('responsive','1') !== '1' ) return false;
		
		// Vars
		$mobile_menu_contact = wpex_option('mobile_menu_contact');
		$mobile_menu_rss = wpex_option('mobile_menu_rss');
		
		ob_start(); ?>
		
		<!-- Mobile navigation -->
		<div id="sidr-close">
			<a href="#sidr-close" class="toggle-sidr-close"></a>
		</div>
		<div id="mobile-menu" class="clr">
			<a href="#sidr" class="mobile-menu-toggle"><span class="fa fa-bars"></span></a>
			<?php
			// Display items from the mobile menu
			$menu_name = 'mobile_menu';
			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
				$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
				$menu_items = wp_get_nav_menu_items($menu->term_id);
				foreach ( (array) $menu_items as $key => $menu_item ) {
					$title = $menu_item->title;
					$url = $menu_item->url;
					$attr_title = $menu_item->attr_title ?>
					<a href="<?php echo $url; ?>" title="<?php echo $attr_title; ?>" class="mobile-menu-extra-icons mobile-menu-<?php echo $title; ?>"><span class="fa fa-<?php echo $title; ?>"></span></a>
				<?php }
			} ?>
		</div><!-- #mobile-menu -->

		<?php echo ob_get_clean();
		
	} // End function
	
} // End if