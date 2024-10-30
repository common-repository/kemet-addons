<?php
/**
 * Kemet Extra Widgets
 *
 * @package Kemet Addons
 */

define( 'KEMET_WIDGETS_DIR', KEMET_ADDONS_DIR . 'addons/extra-widgets/' );
define( 'KEMET_WIDGETS_URL', KEMET_ADDONS_URL . 'addons/extra-widgets/' );

if ( ! class_exists( 'Kemet_Addon_Extra_Widgets' ) ) {

	/**
	 * Widgets Setup
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Extra_Widgets {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
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

			require_once KEMET_WIDGETS_DIR . 'classes/class-kemet-addon-create-widget.php';
			require_once KEMET_WIDGETS_DIR . 'classes/class-kemet-addon-extra-widgets-partials.php';
			require_once KEMET_WIDGETS_DIR . 'classes/class-kemet-addon-extra-widgets-settings.php';
			if ( ! is_admin() ) {
				require_once KEMET_WIDGETS_DIR . 'classes/dynamic.css.php';
			}

		}

	}

	Kemet_Addon_Extra_Widgets::get_instance();
}
