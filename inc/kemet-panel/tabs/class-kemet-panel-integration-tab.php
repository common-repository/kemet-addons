<?php
/**
 * Panel_Options_Tab
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Panel_Integration_Tab' ) ) {

	/**
	 * Kemet Panel
	 *
	 * @since 1.0.0
	 */
	class Kemet_Panel_Integration_Tab {

		/**
		 * Default values
		 *
		 * @var array defaults
		 */
		private $defaults = array();

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
		 * Get Defaults
		 *
		 * @return $defaults
		 */
		public function get_defaults() {
			$options = $this->get_options();
			foreach ( $options as $option ) {
				$this->defaults[ $option['id'] ] = $option['default'];
			}
			return $this->defaults;
		}

		/**
		 * Get Options
		 *
		 * @return $options
		 */
		public function get_options() {
			return array(
				array(
					'id'       => 'kemet-mailchimp-api-key',
					'type'     => 'text',
					'title'    => __( 'Mailchimp API Key', 'kemet-addons' ),
					'subtitle' => sprintf( '%s <a href="%s" target="%s">%s</a> %s', esc_html__( 'Used for the MailChimp widget which working with Extra Widgets Addon.', 'kemet-addons' ), esc_url( 'https://mailchimp.com/help/about-api-keys/' ), esc_attr( '_blank' ), esc_html__( 'Follow this article', 'kemet-addons' ), esc_html__( 'to get your API Key.', 'kemet-addons' ) ),
					'default'  => '',
				),
				array(
					'id'       => 'kemet-mailchimp-list-id',
					'type'     => 'text',
					'title'    => __( 'Mailchimp List ID', 'kemet-addons' ),
					'subtitle' => sprintf( '%s <a href="%s" target="%s">%s</a> %s', esc_html__( 'Used for the MailChimp widget which working with Extra Widgets Addon.', 'kemet-addons' ), esc_url( 'https://mailchimp.com/help/find-audience-id/' ), esc_attr( '_blank' ), esc_html__( 'Follow this article', 'kemet-addons' ), esc_html__( 'to get your List ID.', 'kemet-addons' ) ),
					'default'  => '',
				),

			);
		}

		/**
		 * Render integration tab html
		 *
		 * @return void
		 */
		public function render_html() {
			$switcher = new KFW();
			$options  = $this->get_options();
			foreach ( $options as $option ) {
				$kemet_options = get_option( 'kemet_addons_integration', array() );
				$value         = isset( $kemet_options[ $option['id'] ] ) ? $kemet_options[ $option['id'] ] : $option['default'];
				$switcher->field( $option, $value );
			}
		}
	}
}
