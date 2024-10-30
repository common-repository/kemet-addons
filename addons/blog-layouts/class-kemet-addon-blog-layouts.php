<?php
/**
 * Kemet Extra Blog Layouts Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_BLOG_LAYOUTS_DIR', KEMET_ADDONS_DIR . 'addons/blog-layouts/' );
define( 'KEMET_BLOG_LAYOUTS_URL', KEMET_ADDONS_URL . 'addons/blog-layouts/' );

if ( ! class_exists( 'Kemet_Addon_Blog_Layouts' ) ) {

	/**
	 * Blog Layouts
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Blog_Layouts {

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
			require_once KEMET_BLOG_LAYOUTS_DIR . 'classes/class-kemet-blog-layouts-partials.php';
			require_once KEMET_BLOG_LAYOUTS_DIR . 'classes/class-kemet-blog-layouts-settings.php';
			require_once KEMET_BLOG_LAYOUTS_DIR . 'classes/class-blog-layouts-helpers.php';
			if ( ! is_admin() ) {
				require_once KEMET_BLOG_LAYOUTS_DIR . 'classes/dynamic.css.php';
			}
		}

	}
	/**
	*  Kicking this off by calling 'get_instance()' method
	*/
	Kemet_Addon_Blog_Layouts::get_instance();
}


