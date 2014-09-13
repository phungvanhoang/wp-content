<?php
/**
 * Main sidebar area containing your defined widgets
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */


// Don't display sidebar for full-screen and full-width layouts
$wpex_post_layout = wpex_get_post_layout_class();
if ( $wpex_post_layout == 'full-screen' || $wpex_post_layout == 'full-width' ) return; ?>

<aside id="sidebar" class="sidebar-container sidebar-primary" role="complementary">
	<?php
	// Display the correct sidebar area
	// See functions/get-sidebar.php
	$wpex_get_sidebar = wpex_get_sidebar();
	dynamic_sidebar( $wpex_get_sidebar ); ?>
</aside><!-- #sidebar -->