<?php
/**
 * Top Bar Section
 *
 * @package Kemet Addons
 */

define( 'KEMET_TOPBAR_DIR', KEMET_ADDONS_DIR . 'addons/top-bar-section/' );
define( 'KEMET_TOPBAR_URL', KEMET_ADDONS_URL . 'addons/top-bar-section/' );

if ( ! class_exists( 'Kemet_Addon_Top_Bar_Section' ) ) {

	/**
	 * Meta Box Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Top_Bar_Section {

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

			require_once KEMET_TOPBAR_DIR . 'classes/class-kemet-addon-top-bar-settings.php';
			require_once KEMET_TOPBAR_DIR . 'classes/class-kemet-addon-top-bar-partials.php';
			require_once KEMET_TOPBAR_DIR . 'classes/class-kemet-addon-top-bar-metabox.php';

			if ( ! is_admin() ) {
				require_once KEMET_TOPBAR_DIR . 'classes/dynamic.css.php';
			}
		}
	}
	Kemet_Addon_Top_Bar_Section::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
