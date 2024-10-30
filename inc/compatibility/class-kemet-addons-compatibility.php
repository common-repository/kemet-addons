<?php
/**
 * Compatiblity
 *
 * @package Kemet Addons
 */

define( 'KEMET_COMPATIBLITY_DIR', KEMET_ADDONS_DIR . 'inc/compatibility/' );
define( 'KEMET_COMPATIBLITY_URL', KEMET_ADDONS_URL . 'inc/compatibility/' );

if ( ! class_exists( 'Kemet_Addons_Compatibility' ) ) {

	/**
	 * Kemet Addons Page Builder Compatiblity
	 */
	class Kemet_Addons_Compatibility {

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
			require_once KEMET_COMPATIBLITY_DIR . 'classes/class-kemet-addons-page-builder-compatiblity.php';
			require_once KEMET_COMPATIBLITY_DIR . 'classes/class-kemet-addons-advanced-posts-search.php';
		}
	}

	Kemet_Addons_Compatibility::get_instance();
}
