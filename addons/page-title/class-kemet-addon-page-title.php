<?php
/**
 * Page Title Section
 *
 * @package Kemet Addons
 */

define( 'KEMET_PAGE_TITLE_DIR', KEMET_ADDONS_DIR . 'addons/page-title/' );
define( 'KEMET_PAGE_TITLE_URL', KEMET_ADDONS_URL . 'addons/page-title/' );

if ( ! class_exists( 'Kemet_Addon_Page_Title' ) ) {

	/**
	 * Page Title Section
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Page_Title {

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

			require_once KEMET_PAGE_TITLE_DIR . 'classes/class-kemet-addon-page-title-settings.php';
			require_once KEMET_PAGE_TITLE_DIR . 'classes/class-kemet-addon-page-title-partials.php';
			require_once KEMET_PAGE_TITLE_DIR . 'classes/class-kemet-addon-breadcrumb-trail.php';
			require_once KEMET_PAGE_TITLE_DIR . 'classes/class-kemet-addon-page-title-metabox.php';

			if ( ! is_admin() ) {
				require_once KEMET_PAGE_TITLE_DIR . 'classes/dynamic.css.php';
			}
		}
	}
	Kemet_Addon_Page_Title::get_instance();
}
