<?php
/**
 * Extra Headers
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Extra_Headers_Settings' ) ) {

	/**
	 * Settings class
	 */
	class Kemet_Addon_Extra_Headers_Settings {

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

			add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );

		}

		/**
		 * Customizer options default values
		 *
		 * @param object $defaults object of default values.
		 * @return object
		 */
		public function theme_defaults( $defaults ) {
			$defaults['header-layouts']                 = 'header-main-layout-1';
			$defaults['header-icon-label']              = '';
			$defaults['vheader-box-shadow']             = false;
			$defaults['vheader-border-style']           = 'solid';
			$defaults['header-icon-bars-logo-bg-color'] = '';
			$defaults['header-icon-bars-color']         = '';
			$defaults['header-icon-bars-h-color']       = '';
			$defaults['header-icon-bars-bg-color']      = '';
			$defaults['header-icon-bars-bg-h-color']    = '';
			$defaults['header-icon-bars-border-radius'] = '';
			$defaults['menu-icon-bars-space']           = '';
			$defaults['logo-icon-separator-color']      = '';
			$defaults['enable-transparent']             = false;
			$defaults['header-main-layout-width']       = 'content';
			$defaults['header-content-bg-color']        = '';
			$defaults['header-icon-label-color']        = '';
			$defaults['header-icon-label-hover-color']  = '';
			$defaults['merge-top-bar-header']           = false;
			// Vertical Headers.
			$defaults['header6-position']                 = '';
			$defaults['vertical-header-width']            = 300;
			$defaults['mini-vheader-width']               = 60;
			$defaults['v-headers-position']               = 'left';
			$defaults['header6-border-width']             = '';
			$defaults['header6-border-style']             = '';
			$defaults['header6-border-color']             = '';
			$defaults['header8-position']                 = '';
			$defaults['header8-width']                    = '';
			$defaults['disable-logo-icon-separator']      = false;
			$defaults['header-separator-height']          = '';
			$defaults['vertical-menu-items-border-color'] = '';
			return $defaults;
		}

		/**
		 * Customizer options register
		 *
		 * @param object $wp_customize wp_customize object.
		 * @return void
		 */
		public function customize_register( $wp_customize ) {
			require_once KEMET_EXTRA_HEADERS_DIR . 'customizer/customizer-options.php';

		}

		/**
		 * Add Preview Scripts
		 *
		 * @return void
		 */
		public function preview_scripts() {
			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-extra-headers-customize-preview-js', KEMET_EXTRA_HEADERS_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );
			} else {
				wp_enqueue_script( 'kemet-extra-headers-customize-preview-js', KEMET_EXTRA_HEADERS_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );          }
		}


	}
}
Kemet_Addon_Extra_Headers_Settings::get_instance();
