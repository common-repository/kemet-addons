<?php
/**
 * Kemet Reset Import Export Customizer Options
 *
 * @package Kemet Addons
 */

define( 'KEMET_RESET_DIR', KEMET_ADDONS_DIR . 'addons/reset-import-export/' );
define( 'KEMET_RESET_URL', KEMET_ADDONS_URL . 'addons/reset-import-export/' );

if ( ! class_exists( 'Kemet_Addon_Reset_Import_Export' ) ) {

	/**
	 * Reset Setup
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Reset_Import_Export {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Instance
		 *
		 * @return object
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {
			require_once KEMET_RESET_DIR . 'classes/class-kemet-addon-reset.php';
			require_once KEMET_RESET_DIR . 'classes/class-kemet-addon-import.php';
			require_once KEMET_RESET_DIR . 'classes/class-kemet-addon-export.php';
		}
	}
	Kemet_Addon_Reset_Import_Export::get_instance();
}
