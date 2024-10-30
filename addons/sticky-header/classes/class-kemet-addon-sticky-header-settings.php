<?php
/**
 * Sticky Header Settings
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Sticky_Header_Settings' ) ) {

	/**
	 * Sticky Header Settings
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Sticky_Header_Settings {

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

			add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );
		}

		/**
		 * Customizer options register
		 *
		 * @param object $wp_customize wp_customize object.
		 * @return void
		 */
		public function customize_register( $wp_customize ) {

			// Update the Customizer Sections under Layout.
			$wp_customize->add_section(
				new Kemet_WP_Customize_Section(
					$wp_customize,
					'section-sticky-header',
					array(
						'title'    => __( 'Sticky Header', 'kemet-addons' ),
						'panel'    => 'panel-layout',
						'section'  => 'section-header-group',
						'priority' => 17,
					)
				)
			);
			require_once KEMET_STICKY_HEADER_DIR . 'customizer/customizer-options.php';
		}

		/**
		 * Customizer options default values
		 *
		 * @param object $defaults object of default values.
		 * @return object
		 */
		public function theme_defaults( $defaults ) {
			$defaults['enable-sticky']                = false;
			$defaults['sticky-top-bar']               = false;
			$defaults['sticky-bg-obj']                = '';
			$defaults['sticky-logo-width']            = '';
			$defaults['sticky-logo']                  = '';
			$defaults['sticky-menu-link-color']       = '';
			$defaults['sticky-menu-link-h-color']     = '';
			$defaults['sticky-submenu-bg-color']      = '';
			$defaults['sticky-submenu-link-color']    = '';
			$defaults['sticky-submenu-link-h-color']  = '';
			$defaults['sticky-border-bottom-color']   = '';
			$defaults['sticky-submenu-border-color']  = '';
			$defaults['sticky-responsive']            = 'all-devices';
			$defaults['sticky-style']                 = 'sticky-fade';
			$defaults['sticky-header-padding']        = '';
			$defaults['sticky-header-box-shadow']     = false;
			$defaults['sticky-site-identity-spacing'] = '';
			$defaults['sticky-menu-item-spacing']     = '';
			$defaults['sticky-border-width']          = '';
			return $defaults;
		}

		/**
		 * Add Preview Scripts
		 *
		 * @return void
		 */
		public function preview_scripts() {
			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-sticky-header-customize-preview-js', KEMET_STICKY_HEADER_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );
			} else {
				wp_enqueue_script( 'kemet-sticky-header-customize-preview-js', KEMET_STICKY_HEADER_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );          }
		}
	}
}
Kemet_Addon_Sticky_Header_Settings::get_instance();
