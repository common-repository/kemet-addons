<?php
/**
 * Kemet Custom Fonts Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_CUSTOM_FONTS_DIR', KEMET_ADDONS_DIR . 'addons/custom-fonts/' );
define( 'KEMET_CUSTOM_FONTS_URL', KEMET_ADDONS_URL . 'addons/custom-fonts/' );
define( 'KEMET_CUSTOM_FONTS_POST_TYPE', 'kemet_custom_fonts' );

if ( ! class_exists( 'Kemet_Addon_Custom_Fonts' ) ) {

	/**
	 * Custom Fonts
	 */
	class Kemet_Addon_Custom_Fonts {

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

			require_once KEMET_CUSTOM_FONTS_DIR . 'classes/class-kemet-addon-custom-fonts-settings.php';
			require_once KEMET_CUSTOM_FONTS_DIR . 'classes/class-kemet-addon-custom-fonts-partials.php';
			require_once KEMET_CUSTOM_FONTS_DIR . 'classes/class-kemet-addon-custom-fonts-meta.php';

		}

	}
	Kemet_Addon_Custom_Fonts::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
