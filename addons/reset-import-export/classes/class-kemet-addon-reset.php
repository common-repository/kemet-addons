<?php
/**
 * Customizer Reset
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Reset' ) ) {

	/**
	 * Kemet Customizer Reset
	 */
	class Kemet_Addon_Reset {

		/**
		 * Instance
		 *
		 * @var object
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
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_register', array( $this, 'export' ) );
			add_action( 'customize_register', array( $this, 'import' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'wp_ajax_customizer_reset', array( $this, 'handle_ajax' ) );
		}

		/**
		 * Customizer Options
		 *
		 * @param object $wp_customize wp_customize.
		 * @return void
		 */
		public function customize_register( $wp_customize ) {
			$this->wp_customize = $wp_customize;
		}

		/**
		 * Enqueue assets
		 *
		 * @return void
		 */
		public function enqueue_scripts() {
			global $wp;

			// CSS.
			wp_enqueue_style( 'kmt-customizer-reset', KEMET_RESET_URL . 'assets/css/kmt-customizer-reset.css', true ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

			// JS.
			wp_enqueue_script( 'kmt-customizer-reset', KEMET_RESET_URL . 'assets/js/kmt-customizer-reset.js', array( 'jquery' ), KEMET_ADDONS_VERSION, true );

			// Require the customizer import form.
			require KEMET_RESET_DIR . 'templates/import-form.php';

			wp_localize_script(
				'kmt-customizer-reset',
				'kmtResetCustomizerObj',
				array(
					'buttons'       => array(
						'reset'  => array(
							'text' => __( 'Reset Options', 'kemet-addons' ),
						),
						'export' => array(
							'text' => __( 'Export', 'kemet-addons' ),
						),
						'import' => array(
							'text' => __( 'Import', 'kemet-addons' ),
						),
					),
					'customizerUrl' => admin_url( 'customize.php' ),
					'message'       => array(
						'resetWarning'  => __( 'WARNING! By clicking ok you will remove all Kemet theme customizer options!', 'kemet-addons' ),
						'importWarning' => __( 'WARNING! By running the import tool, your existing kemet customizer data will be replaced.', 'kemet-addons' ),
						'emptyImport'   => __( 'Please select a JSON file to import.', 'kemet-addons' ),
					),
					'importForm'    => array(
						'templates' => $customizer_import_form,
					),
					'nonces'        => array(
						'reset'  => wp_create_nonce( 'kmt-customizer-reset' ),
						'export' => wp_create_nonce( 'customizer-export' ),
					),
				)
			);
		}

		/**
		 * Handle ajax kemet customizer reset
		 *
		 * @return void
		 */
		public function handle_ajax() {
			if ( ! $this->wp_customize->is_preview() ) {
				wp_send_json_error( 'not_preview' );
			}

			if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), 'kmt-customizer-reset' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
				wp_send_json_error( 'invalid_nonce' );
			}

			$this->reset_customizer();
			$this->reset_default_customizer();
			wp_send_json_success();
		}

		/**
		 * Setup customizer export
		 *
		 * @return void
		 */
		public function export() {

			if ( ! is_customize_preview() ) {
				return;
			}

			if ( ! isset( $_GET['action'] ) || 'customizer_export' !== $_GET['action'] ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
				return;
			}

			if ( ! isset( $_GET['nonce'] ) || ! wp_verify_nonce( wp_unslash( $_GET['nonce'] ), 'customizer-export' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
				return;
			}

			$exporter = new Kemet_Addon_Export( $this->wp_customize );

			$exporter->export();
		}

		/**
		 * Setup customizer import
		 *
		 * @return void
		 */
		public function import() {
			if ( ! is_customize_preview() ) {
				return;
			}

			if ( ! isset( $_POST['kemet_import_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['kemet_import_nonce'] ), 'kemet_import_nonce' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
				return;
			}
			if ( empty( $_POST['kemet_ie_action'] ) || 'import_settings' !== $_POST['kemet_ie_action'] ) {
				return;
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$importer = new Kemet_Addon_Import();

			$importer->import();
		}

		/**
		 * Reset customizer
		 *
		 * @return void
		 */
		public function reset_customizer() {

			if ( defined( 'KEMET_THEME_SETTINGS' ) ) {

				$default_options = array();

				if ( ! empty( $default_options ) ) {
					update_option( KEMET_THEME_SETTINGS, $default_options );
				} else {
					delete_option( KEMET_THEME_SETTINGS );
				}
			}
		}

		/**
		 * Reset default settings
		 *
		 * @return void
		 */
		public function reset_default_customizer() {
			$settings = $this->wp_customize->settings();
			foreach ( $settings as $setting ) {
				if ( 'theme_mod' == $setting->type ) {
					remove_theme_mod( $setting->id );
				}
			}
		}
	}
}
Kemet_Addon_Reset::get_instance();
