<?php
/**
 * Kemet Addons Activate
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addons' ) ) {

	/**
	 * Kemet Theme Addons initial setup
	 */
	class Kemet_Addons {

		/**
		 * Plugin
		 *
		 * @var mixed
		 */
		public $plugin;

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Instance
		 *
		 * @return void
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
		}

		/**
		 *  Constructor
		 */
		public function __construct() {

			// Included Files.
			$this->includes();

			// Activation hook.
			register_activation_hook( KEMET_ADDONS_FILE, array( $this, 'activation' ) );

			// deActivation hook.
			register_deactivation_hook( KEMET_ADDONS_FILE, array( $this, 'deactivation' ) );

			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

			add_action( 'after_setup_theme', array( $this, 'setup' ) );
		}

		/**
		 * Plugin activation
		 *
		 * @return void
		 */
		public function activation() {
			// registered KA.
			// Flush rewrite rules.
			flush_rewrite_rules();
		}

		/**
		 * After Setup Theme
		 *
		 * @return void
		 */
		public function setup() {
			if ( ! defined( 'KEMET_THEME_VERSION' ) ) {
				return;
			}

			require_once KEMET_ADDONS_DIR . 'classes/class-kemet-addons-activate.php';
		}

		/**
		 * Plugin deactivation
		 *
		 * @return void
		 */
		public function deactivation() {
			// Flush rewrite rules.
			flush_rewrite_rules();
		}

		/**
		 * Includes
		 *
		 * @return void
		 */
		public function includes() {
			require_once KEMET_ADDONS_DIR . 'inc/image-processing-queue/class-kemet-image-processing-qeue.php';
			require_once KEMET_ADDONS_DIR . 'inc/kemet-panel/class-kemet-addons-panel.php';
			require_once KEMET_ADDONS_DIR . 'inc/compatibility/class-kemet-addons-compatibility.php';
			require_once KEMET_ADDONS_DIR . 'classes/class-kemet-style-generator.php';
			require_once KEMET_ADDONS_DIR . 'inc/k-framework/k-framework.php';
			require_once KEMET_ADDONS_DIR . 'inc/functions.php';
		}

		/**
		 * Plugin domain
		 *
		 * @return void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'kemet-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}
	}
}

Kemet_Addons::get_instance();
