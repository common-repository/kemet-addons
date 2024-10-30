<?php
/**
 * Kemet Mega Menu Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_MEGA_MENU_DIR', KEMET_ADDONS_DIR . 'addons/mega-menu/' );
define( 'KEMET_MEGA_MENU_URL', KEMET_ADDONS_URL . 'addons/mega-menu/' );

if ( ! class_exists( 'Kemet_Addon_Mega_Menu' ) ) {

	/**
	 * Mega Menu
	 */
	class Kemet_Addon_Mega_Menu {

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

			require_once KEMET_MEGA_MENU_DIR . 'classes/class-kemet-addon-mega-menu-settings.php';
			require_once KEMET_MEGA_MENU_DIR . 'classes/class-kemet-addon-mega-menu-partials.php';
			require_once KEMET_MEGA_MENU_DIR . 'classes/class-kemet-addon-mega-menu-options.php';
			require_once KEMET_MEGA_MENU_DIR . 'classes/class-kemet-addon-mega-menu-walker-nav-menu.php';

			if ( ! is_admin() ) {
				require_once KEMET_MEGA_MENU_DIR . 'classes/dynamic.css.php';
			}
		}

	}
	Kemet_Addon_Mega_Menu::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
