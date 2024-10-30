<?php
/**
 * Kemet Single Post
 *
 * @package Kemet Addons
 */

define( 'KEMET_SINGLE_POST_DIR', KEMET_ADDONS_DIR . 'addons/single-post/' );
define( 'KEMET_SINGLE_POST_URL', KEMET_ADDONS_URL . 'addons/single-post/' );

if ( ! class_exists( 'Kemet_Addon_Single_Post' ) ) {

	/**
	 * Single Post
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Single_Post {

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

			require_once KEMET_SINGLE_POST_DIR . 'classes/class-kemet-addon-single-post-partials.php';
			require_once KEMET_SINGLE_POST_DIR . 'classes/class-kemet-addon-single-post-settings.php';

			if ( ! is_admin() ) {
				require_once KEMET_SINGLE_POST_DIR . 'classes/dynamic.css.php';
			}
		}
	}
	Kemet_Addon_Single_Post::get_instance();
}
/**
*  Kicking this off by calling 'get_instance()' method
*/
