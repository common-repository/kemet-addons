<?php
/**
 * Go Top Settings Defaults, Customizer, Customizer Preview
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Go_Top_Settings' ) ) {

	/**
	 * Go Top Section
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Go_Top_Settings {


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
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );
		}

		/**
		 * Go top customizer section
		 *
		 * @param object $wp_customize wp_customize.
		 * @return void
		 */
		public function customize_register( $wp_customize ) {

			// Update the Customizer Sections under Layout.
			$wp_customize->add_section(
				new Kemet_WP_Customize_Section(
					$wp_customize,
					'section-go-top',
					array(
						'title'    => __( 'Go Top Section', 'kemet-addons' ),
						'panel'    => 'panel-layout',
						'section'  => 'section-footer-group',
						'priority' => 40,
					)
				)
			);
			require_once KEMET_GOTOP_DIR . 'customizer/customizer-options.php';
		}

		/**
		 * Customizer options default values
		 *
		 * @param object $defaults object of default values.
		 * @return object
		 */
		public function theme_defaults( $defaults ) {
			$defaults['enable-go-top']        = '1';
			$defaults['go-top-button-size']   = '';
			$defaults['go-top-icon-size']     = '';
			$defaults['go-top-border-radius'] = '';
			$defaults['go-top-icon-color']    = '';
			$defaults['go-top-icon-h-color']  = '';
			$defaults['go-top-bg-color']      = '';
			$defaults['go-top-bg-h-color']    = '';
			$defaults['go-top-responsive']    = 'all-devices';

			return $defaults;
		}

		/**
		 * Admin Scripts
		 *
		 * @return void
		 */
		public function preview_scripts() {
			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-go-top-customize-preview-js', KEMET_GOTOP_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );
			} else {
				wp_enqueue_script( 'kemet-go-top-customize-preview-js', KEMET_GOTOP_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );
			}
		}
	}
}
Kemet_Addon_Go_Top_Settings::get_instance();
