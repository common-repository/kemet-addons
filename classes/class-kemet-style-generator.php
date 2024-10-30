<?php
/**
 * Generator Class
 *
 * @package     Kemet
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kemet_Style_Generator' ) ) {

	/**
	 * Kemet_Merged_Style
	 */
	class Kemet_Style_Generator {

		/**
		 * Css files
		 *
		 * @var array
		 */
		private static $css_files = array();

		/**
		 * Js files
		 *
		 * @var array
		 */
		private static $js_files = array();

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
			add_action( 'wp_enqueue_scripts', array( $this, 'merge_all_scripts' ) );
		}

		/**
		 * Merge all js files
		 *
		 * @return void
		 */
		public function merge_all_scripts() {
			$merged_css_url = self::get_css_url();
			$merged_js_url  = self::get_js_url();

			if ( false != $merged_css_url ) {
				wp_enqueue_style( 'kemet-addons-css', $merged_css_url, array(), KEMET_ADDONS_VERSION, 'all' );
			}

			if ( false != $merged_js_url ) {
				wp_enqueue_script( 'kemet-addons-js', $merged_js_url, array( 'jquery' ), KEMET_ADDONS_VERSION, 'all' );
			}

			wp_add_inline_style( 'kemet-addons-css', apply_filters( 'kemet_dynamic_css', '' ) );
			wp_localize_script( 'kemet-addons-js', 'kemet_addons_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		}

		/**
		 * Css url
		 *
		 * @return mixed
		 */
		public static function get_css_url() {

			$css_files    = self::get_css_files();
			$files_count  = count( $css_files );
			$merged_style = '';
			/* new */
			if ( $files_count > 0 ) {

				foreach ( $css_files as $k => $file ) {

					$merged_style .= file_get_contents( $file );
					if ( $files_count == $k + 1 ) {
						$handle = 'kmt-addons-css';
					}

					require_once ABSPATH . 'wp-admin/includes/file.php'; // We will probably need to load this file.
					global $wp_filesystem;
					$upload_dir = wp_upload_dir(); // Grab uploads folder array.
					$dir        = trailingslashit( $upload_dir['basedir'] ) . 'kemet-addons/'; // Set storage directory path.

					WP_Filesystem(); // Initial WP file system.
					$wp_filesystem->mkdir( $dir ); // Make a new folder for storing our file.
					$wp_filesystem->put_contents( $dir . 'style.css', $merged_style, 0777 | 0644 ); // Finally, store the file :D.
					$wp_upload_dir = $upload_dir['baseurl'] . '/' . 'kemet-addons/';
					$merged_file   = $wp_upload_dir . 'style.css';
				}
				return $merged_file;
			} else {
				return false;
			}

		}

		/**
		 * Js url
		 *
		 * @return mixed
		 */
		public static function get_js_url() {

			$js_files     = self::get_js_files();
			$files_count  = count( $js_files );
			$merged_style = '';

			if ( $files_count > 0 ) {

				foreach ( $js_files as $k => $file ) {
					// $js_file_path = $handle;
					$merged_style .= file_get_contents( $file );
					if ( $files_count == $k + 1 ) {
						$handle = 'kemet-addons-js';
					}
					// Stash JS in uploads directory.
					require_once ABSPATH . 'wp-admin/includes/file.php'; // We will probably need to load this file.
					global $wp_filesystem;
					$upload_dir = wp_upload_dir(); // Grab uploads folder array.
					$dir        = trailingslashit( $upload_dir['basedir'] ) . 'kemet-addons/'; // Set storage directory path.

					WP_Filesystem(); // Initial WP file system.
					$wp_filesystem->mkdir( $dir ); // Make a new folder for storing our file.
					$wp_filesystem->put_contents( $dir . 'style.js', $merged_style, 0777 | 0644 ); // Finally, store the file :D.
					$wp_upload_dir = $upload_dir['baseurl'] . '/' . 'kemet-addons/';
					$merged_file   = $wp_upload_dir . 'style.js';
				}
				return $merged_file;
			} else {
				return false;
			}
		}

		/**
		 * Css files
		 *
		 * @return mixed
		 */
		public static function get_css_files() {

			if ( 1 > count( self::$css_files ) ) {
				do_action( 'kemet_get_css_files' );
			}

			return apply_filters( 'kemet_kmt_add_css_file', self::$css_files );
		}

		/**
		 * Js files
		 *
		 * @return mixed
		 */
		public static function get_js_files() {

			if ( 1 > count( self::$js_files ) ) {
				do_action( 'kemet_get_js_files' );

			}
			return apply_filters( 'kemet_kmt_add_js_file', self::$js_files );
		}

		/**
		 * Add css
		 *
		 * @param string  $src source.
		 * @param boolean $handle handle.
		 * @return void
		 */
		public static function kmt_add_css( $src = null, $handle = false ) {
			if ( false != $handle ) {
				self::$css_files[ $handle ] = $src;
			} else {
				self::$css_files[] = $src;
			}
		}

		/**
		 * Add js
		 *
		 * @param string  $src source.
		 * @param boolean $handle handle.
		 * @return void
		 */
		public static function kmt_add_js( $src = null, $handle = false ) {

			if ( false != $handle ) {
				self::$js_files[ $handle ] = $src;
			} else {
				self::$js_files[] = $src;
			}
		}
	}

	Kemet_Style_Generator::get_instance();
}
