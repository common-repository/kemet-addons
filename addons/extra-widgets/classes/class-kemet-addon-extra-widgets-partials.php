<?php
/**
 * Widgets Partials
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Extra_Widgets_Partials' ) ) {

	/**
	 * Extra widgets partial
	 */
	class Kemet_Addon_Extra_Widgets_Partials {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @var mixed
		 */
		private static $extra_widgets_style;

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
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'widgets_init', array( $this, 'kemet_extra_widgets_markup' ), 10 );
			add_action( 'wp_ajax_kmt_mailchimp', array( $this, 'mailchimp_action' ) );
			add_action( 'wp_ajax_nopriv_kmt_mailchimp', array( $this, 'mailchimp_action' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_script' ) );
		}

		/**
		 * Widgets loader
		 *
		 * @return void
		 */
		public static function kemet_extra_widgets_markup() {

			// Define array of custom widgets for the theme.
			$widgets = apply_filters(
				'kemet_custom_widgets',
				array(
					'mailchimp',
					'social-icons',
					'posts-in-images',
					'posts-list',
					'login-form',
				)
			);

			// Loop through widgets and load their files.
			if ( $widgets && is_array( $widgets ) ) {
				foreach ( $widgets as $widget ) {
					$file = KEMET_WIDGETS_DIR . 'widgets/' . $widget . '.php';
					if ( file_exists( $file ) ) {
						require_once $file;
					}
				}
			}
		}

		/**
		 * Mailchimp widget post
		 *
		 * @param string $email email.
		 * @param string $status status.
		 * @param int    $list_id list id.
		 * @param string $api_key api key.
		 * @return mixed
		 */
		public function mailchimp_post( $email, $status, $list_id, $api_key ) {

			$data = array(
				'apikey'        => $api_key,
				'email_address' => $email,
				'status'        => $status,
			);

			$url = 'https://' . substr( $api_key, strpos( $api_key, '-' ) + 1 ) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5( strtolower( $data['email_address'] ) );

			$headers    = array(
				'Content-Type: application/json',
				'Authorization: Basic ' . base64_encode( 'user:' . $api_key ),
			);
			$user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';
			// @codingStandardsIgnoreStart WordPress.WP.AlternativeFunctions.curl_curl_setopt
			$mailchimp  = curl_init();

			curl_setopt( $mailchimp, CURLOPT_URL, $url );
			curl_setopt( $mailchimp, CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $mailchimp, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $mailchimp, CURLOPT_CUSTOMREQUEST, 'PUT' );
			curl_setopt( $mailchimp, CURLOPT_TIMEOUT, 10 );
			curl_setopt( $mailchimp, CURLOPT_POST, true );
			curl_setopt( $mailchimp, CURLOPT_POSTFIELDS, wp_json_encode( $data ) );
			curl_setopt( $mailchimp, CURLOPT_USERAGENT, $user_agent );
			curl_setopt( $mailchimp, CURLOPT_SSL_VERIFYPEER, false );

			return curl_exec( $mailchimp );
			// @codingStandardsIgnoreEnd WordPress.WP.AlternativeFunctions.curl_curl_setopt
		}

		/**
		 * Mailchimp action
		 *
		 * @return void
		 */
		public function mailchimp_action() {

			if ( ! isset( $_POST['kmt_mailchimp_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kmt_mailchimp_nonce'] ) ), 'kmt_mailchimp_action' ) ) {
				exit;
			} else {

				$email   = isset( $_POST['email'] ) ? filter_var( wp_unslash( $_POST['email'] ), FILTER_SANITIZE_EMAIL ) : '';
				$list    = kemet_get_integration( 'kemet-mailchimp-list-id' );
				$api_key = kemet_get_integration( 'kemet-mailchimp-api-key' );

				$this->mailchimp_post( $email, 'subscribed', $list, $api_key );
				die;
			}
		}

		/**
		 * Style
		 *
		 * @return void
		 */
		public function add_styles() {

			$css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$css_prefix = '.css';
				$dir        = 'unminified';
			}

			if ( is_rtl() ) {
				$css_prefix = '-rtl.min.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
			}
			Kemet_Style_Generator::kmt_add_css( KEMET_WIDGETS_DIR . 'assets/css/' . $dir . '/style' . $css_prefix );
		}

		/**
		 * Scripts
		 *
		 * @return void
		 */
		public function add_scripts() {

			$js_prefix = '.min.js';
			$dir       = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix = '.js';
				$dir       = 'unminified';
			}

			Kemet_Style_Generator::kmt_add_js( KEMET_WIDGETS_DIR . 'assets/js/' . $dir . '/extre-widgets' . $js_prefix );
		}

		/**
		 * Admin Scripts
		 *
		 * @return void
		 */
		public function admin_script() {

			$js_prefix = '.min.js';
			$dir       = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix = '.js';
				$dir       = 'unminified';
			}

			wp_enqueue_script(
				'kemet-addons-extra-widgets-js',
				KEMET_WIDGETS_URL . 'assets/js/' . $dir . '/extra-widgets-admin' . $js_prefix,
				array(
					'jquery',
				),
				KEMET_ADDONS_VERSION,
				true
			);
		}
	}
}
Kemet_Addon_Extra_Widgets_Partials::get_instance();
