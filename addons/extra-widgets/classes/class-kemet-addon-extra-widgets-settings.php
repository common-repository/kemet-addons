<?php
/**
 * Extra Widgets
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Extra_Widgets_Settings' ) ) {

	/**
	 * Extra widgets settings
	 */
	class Kemet_Addon_Extra_Widgets_Settings {

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
			add_filter( 'dynamic_sidebar_params', array( $this, 'insert_attributes' ) );
		}

		/**
		 * Insert Widget attributes
		 *
		 * @param object $params params.
		 * @return object
		 */
		public static function insert_attributes( $params ) {
			global $wp_registered_widgets;

			$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
			$settings_get    = $settings_getter->get_settings();
			$settings        = $settings_get[ $params[1]['number'] ];

			if ( empty( $settings['title'] ) ) {
				$params[0]['before_widget'] .= '<div class="widget-content">';
				$params[0]['after_widget']   = '</div>' . $params[0]['after_widget'];
			} elseif ( isset( $settings['title'] ) ) {
				$params[0]['after_title'] .= '<div class="widget-content">';
				$params[0]['after_widget'] = '</div>' . $params[0]['after_widget'];
			} else {
				$params[0]['before_widget'] .= '<div class="widget-content">';
				$params[0]['after_widget']   = '</div>' . $params[0]['after_widget'];
			}

			$widget_id = $params[0]['widget_id'];

			$widget_style = kemet_get_option( 'widgets-style' );

			$kmt_widget_class = '';
			if ( ! empty( $widget_style ) ) {
				$kmt_widget_class = 'kmt-widget-' . $widget_style;
			}

			// Footer Custom Style.
			$kmt_footet_widget_class = '';
			$footer_widget_style     = kemet_get_option( 'footer-widgets-style' );

			if ( ( ! empty( $footer_widget_style ) ) && ( strpos( $params[0]['id'], 'main-footer-widget' ) !== false || strpos( $params[0]['id'], 'copyright-widget' ) !== false ) ) {
				$kmt_widget_class = 'kmt-widget-' . $footer_widget_style;
			}
			if ( ! empty( $kmt_widget_class ) && ( strpos( $params[0]['id'], 'header-widget' ) !== 0 ) ) {
				$params[0] = array_replace( $params[0], array( 'before_widget' => str_replace( 'widget ', 'widget ' . $kmt_widget_class . ' ', $params[0]['before_widget'] ) ) );
			}

			return $params;
		}

		/**
		 * Customizer options register
		 *
		 * @param obect $wp_customize wp_customize object.
		 * @return void
		 */
		public function customize_register( $wp_customize ) {

			require_once KEMET_WIDGETS_DIR . 'customizer/customizer-options.php';
		}

		/**
		 * Admin Scripts
		 *
		 * @return void
		 */
		public function preview_scripts() {
			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-extra-widgets-customize-preview-js', KEMET_WIDGETS_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );
			} else {
				wp_enqueue_script( 'kemet-extra-widgets-customize-preview-js', KEMET_WIDGETS_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );            }
		}

		/**
		 * Customizer options default values
		 *
		 * @param object $defaults object of default values.
		 * @return object
		 */
		public function theme_defaults( $defaults ) {
			$defaults['widgets-style']                = 'style1';
			$defaults['widget-border-color']          = '';
			$defaults['widget-style-bg-color']        = '';
			$defaults['footer-widget-border-color']   = '';
			$defaults['footer-widget-title-bg-color'] = '';
			$defaults['footer-widgets-style']         = '';
			return $defaults;
		}

	}
}
Kemet_Addon_Extra_Widgets_Settings::get_instance();
