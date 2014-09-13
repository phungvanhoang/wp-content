<?php
/*
 * Used for the search overlay
 *
 * @package WordPress
 * @subpackage Total
 * @since 1.0
*/

if ( ! function_exists('wpex_search_overlay') ) {
	
	function wpex_search_overlay() {
		
		// Do nothing if the main search is disabled
		if ( wpex_option( 'main_search', '1' ) !== '1' ) return;
		
		// Only display on header style 1
		if ( wpex_option( 'header_style', 'one' ) !== 'one' ) return;
		
			ob_start(); ?>
			
			<span class="search-overlay"></span>
			<section id="site-searchform" class="header-one-searchform">
				<div id="site-searchform-title"><?php _e('Search','wpex'); ?></div>
				<div class="site-searchform-inner clr">
					<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
						<input type="search" name="s" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" autocomplete="off" />
					</form>
				</div><!-- .site-searchform-inner -->
			</section><!-- #site-searchform -->
		<?php
		echo ob_get_clean();
		
	} // End function
	
} // End if