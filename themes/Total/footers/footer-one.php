<?php
// Display footer Widgets if enabled
if ( wpex_option( 'footer_widgets', '1' ) ) { ?>

	<footer id="footer" class="site-footer footer-one">
		<div id="footer-widgets" class="footer-one-widgets container row clr <?php if ( wpex_option( 'footer_col' ) == '1' ) echo 'single-col-footer-one'; ?>">
			<div class="footer-box <?php echo wpex_grid_class(wpex_option('footer_col','3')); ?> col col-1">
				<?php dynamic_sidebar('footer_one'); ?>
			</div><!-- .footer-one-box -->
			<div class="footer-box <?php echo wpex_grid_class(wpex_option('footer_col','3')); ?> col col-2">
				<?php dynamic_sidebar('footer_two'); ?>
			</div><!-- .footer-one-box -->
			<div class="footer-box <?php echo wpex_grid_class(wpex_option('footer_col','3')); ?> col <?php if ( wpex_option( 'footer_col' ) == '2' ) echo 'col-1'; ?> col-3 ">
				<?php dynamic_sidebar('footer_three'); ?>
			</div><!-- .footer-one-box -->
			<div class="footer-box <?php echo wpex_grid_class(wpex_option('footer_col','3')); ?> col <?php if ( wpex_option( 'footer_col' ) == '3' ) echo 'col-1'; ?> col-4">
				<?php dynamic_sidebar('footer_four'); ?>
			</div><!-- .footer-box -->
		</div><!-- #footer-widgets -->
	</footer><!-- #footer -->   
	        
<?php } ?>
	
	
<?php
// Display footer bottom area if enabled
if ( wpex_option( 'footer_copyright', '1' ) ) { ?>
	<div id="footer-bottom" class="footer-one-bottom clr">
		<div id="footer-bottom-inner" class="footer-one-bottom-inner container clr">
			<div id="copyright" class="clr footer-one-copyright" role="contentinfo">
				<?php
				// Display copyright info
				wpex_footer_copyright(); ?>
			</div><!-- #copyright -->
			<div id="footer-menu" class="footer-one-menu clr">
			   <?php
				// Display footer menu
				wp_nav_menu( array(
					'theme_location'	=> 'footer_menu',
					'sort_column'		=> 'menu_order',
					'fallback_cb'		=> false,
				) ); ?>
			</div><!-- #footer-menu -->
		</div><!-- #footer-bottom-inner -->
	</div><!-- #footer-bottom -->
<?php } ?>