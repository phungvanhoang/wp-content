<?php
/*
 * Plugin Name: Visual Composer Extension
 * Plugin URI: http://wpexplorer.com
 * Description: Extends the amazing Visual Composer plugin
 * Version: 1.02
 * Author: Alexander Clarke
 * Author URI: http://wpexplorer.com
 * Text Domain: vcex
 * Domain Path: languages
 *
 *
 *
 * @package VCEX
 * @author AJ Clarke
 * @version 1.0
*/



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Main Extend_Visual_Composer Class
 *
 * @since 1.0
 */
if ( ! class_exists( 'VCEX_Visual_Composer_Extension' ) ) :

	class VCEX_Visual_Composer_Extension {
		
		/**
		* @var Singleton Instance
		* @since 1.0
		*/
  		private static $instance;
		
		/**
         * Main VCEX_Visual_Composer_Extension Instance
         *
         * @since 1.0
         * @static
         * @staticvar array $instance
         * @uses Easy_Digital_Downloads::setup_globals() Setup the globals needed
         * @uses Easy_Digital_Downloads::includes() Include the required files
         * @uses Easy_Digital_Downloads::setup_actions() Setup the hooks and actions
         * @see EDD()
         * @return VCEX_Visual_Composer_Extension instance
         */
        public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof VCEX_Visual_Composer_Extension ) ) {
				self::$instance = new VCEX_Visual_Composer_Extension;
				self::$instance->setup_constants();
				self::$instance->includes();
				self::$instance->load_textdomain();
			}
			return self::$instance;
        }
		
		/**
         * Setup plugin constants
         *
         * @access private
         * @since 1.0
         * @return void
		*/
		private function setup_constants() {
			
			// Plugin version
			if ( ! defined( 'VCEX_VERSION' ) ) {
				define( 'VCEX_VERSION', '1.0' );
			}
			
			// Plugin Folder Path
			if ( ! defined( 'VCEX_PLUGIN_DIR' ) ) {
				define( 'VCEX_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}
			
			// Plugin Folder URL
			if ( ! defined( 'VCEX_PLUGIN_URL' ) ) {
				define( 'VCEX_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}
			
			// Plugin Root File
			if ( ! defined( 'VCEX_PLUGIN_FILE' ) ) {
				define( 'VCEX_PLUGIN_FILE', __FILE__ );
			}
			
		} // End setup_constants() function
	
		/**
		* Includes
		*
		* @access private
		* @since 1.0
		* @return void
		*/
		private function includes() {
			
			// Include file that loads scripts
			require_once VCEX_PLUGIN_DIR . 'includes/scripts.php';
			
			// Include required functions - move these into the class?
			require_once VCEX_PLUGIN_DIR . 'includes/functions.php';
			
			// Include the aqua image resizer
			if ( ! function_exists( 'aq_resize' ) ) {
				require_once VCEX_PLUGIN_DIR . 'includes/aq-resizer.php';
			}
						
			// Main Shortcodes
			require_once VCEX_PLUGIN_DIR . 'shortcodes/spacing.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/divider.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/callout.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/list_item.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/bullets.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/button.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/pricing.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/skillbar.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/icon.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/icon_box.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/milestone.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/teaser.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/image_flexslider.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/image_carousel.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/image_grid.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/recent_news.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/blog_grid.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/testimonials_grid.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/testimonials_slider.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/portfolio_grid.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/portfolio_carousel.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/staff_grid.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/staff_carousel.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/login_form.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/newsletter_form.php';
			require_once VCEX_PLUGIN_DIR . 'shortcodes/layerslider.php';
			
			// Layerslider module
			if ( function_exists( 'lsSliders' ) ) {
				require_once VCEX_PLUGIN_DIR . 'shortcodes/layerslider.php';
			}
			
			// WooCommerce Shortcodes			
			if ( class_exists('Woocommerce') ) {
				require_once VCEX_PLUGIN_DIR . 'shortcodes/woocommerce_carousel.php';
			}
			
		
		} // End includes() function
		
		/**
         * Load Text Domain for translations
         *
         * @access private
         * @since 1.0
         * @return void
		*/
		private function load_textdomain() {
			
			// Set filter for plugin's languages directory
			$vcex_lang_dir = dirname( plugin_basename( VCEX_PLUGIN_FILE ) ) . '/languages/';
			$vcex_lang_dir = apply_filters( 'vcex_languages_directory', $vcex_lang_dir );
			
		} // End load_textdomain() function
		
	}

endif; // End if class_exists check


/**
 * The main function responsible for returning the VCEX_Visual_Composer_Extension
 * Instance to functions everywhere.
 *
 * @since 1.0
 * @return VCEX_Visual_Composer_Extension Instance
 */
function visual_composer_extension_run() {
	return VCEX_Visual_Composer_Extension::instance();
}


/**
 * WP-Updates custom code
 *
 * @since 1.0
 * @return void
 */
require_once('wp-updates-plugin.php');
new WPUpdatesPluginUpdater_277( 'http://wp-updates.com/api/2/plugin', plugin_basename(__FILE__));