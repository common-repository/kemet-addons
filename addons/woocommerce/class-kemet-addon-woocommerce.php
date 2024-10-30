<?php
/**
 * Kemet Woocommerce Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_WOOCOMMERCE_DIR', KEMET_ADDONS_DIR . 'addons/woocommerce/' );
define( 'KEMET_WOOCOMMERCE_URL', KEMET_ADDONS_URL . 'addons/woocommerce/' );

if ( ! class_exists( 'Kemet_Addon_Woocommerce' ) ) {

	/**
	 * Woocommerce
	 *
	 * @since 1.0.3
	 */
	class Kemet_Addon_Woocommerce {

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

			if ( class_exists( 'WooCommerce' ) ) {

				require_once KEMET_WOOCOMMERCE_DIR . 'classes/class-kemet-addon-woocommerce-partials.php';
				require_once KEMET_WOOCOMMERCE_DIR . 'classes/class-kemet-addon-woocommerce-settings.php';

				if ( ! is_admin() ) {
					require_once KEMET_WOOCOMMERCE_DIR . 'classes/dynamic.css.php';
				}
			}
		}

	}
	Kemet_Addon_Woocommerce::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
