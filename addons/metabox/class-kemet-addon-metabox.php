<?php
/**
 * Kemet Meta Box Options
 *
 * @package Kemet Addons
 */

define( 'KEMET_METABOX_DIR', KEMET_ADDONS_DIR . 'addons/metabox/' );
define( 'KEMET_METABOX_URL', KEMET_ADDONS_URL . 'addons/metabox/' );

if ( ! class_exists( 'Kemet_Addon_Metabox' ) ) {

	/**
	 * Meta Box Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Metabox {

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
			require_once KEMET_METABOX_DIR . 'classes/class-kemet-addon-metabox-data.php';
			require_once KEMET_METABOX_DIR . 'classes/class-kemet-addon-metabox-helper.php';
		}

	}
	Kemet_Addon_Metabox::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
