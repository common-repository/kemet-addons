<?php
/**
 * Kemet Go Top Options
 *
 * @package Kemet Addons
 */

define( 'KEMET_GOTOP_DIR', KEMET_ADDONS_DIR . 'addons/go-top/' );
define( 'KEMET_GOTOP_URL', KEMET_ADDONS_URL . 'addons/go-top/' );

if ( ! class_exists( 'Kemet_Addon_Go_Top' ) ) {

	/**
	 * Go Top Setup
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Go_Top {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 *  Initiator
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

			require_once KEMET_GOTOP_DIR . 'classes/class-kemet-addon-go-top-settings.php';
			require_once KEMET_GOTOP_DIR . 'classes/class-kemet-addon-go-top-partials.php';

			if ( ! is_admin() ) {
				require_once KEMET_GOTOP_DIR . 'classes/dynamic.css.php';
			}
		}

	}

	Kemet_Addon_Go_Top::get_instance();
}
