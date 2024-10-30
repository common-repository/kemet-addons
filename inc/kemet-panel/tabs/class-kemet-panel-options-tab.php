<?php
/**
 * Panel_Options_Tab
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Panel_Options_Tab' ) ) {

	/**
	 * Kemet Panel
	 *
	 * @since 1.0.0
	 */
	class Kemet_Panel_Options_Tab {

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
			$options = array(
				// A switcher field.
				array(
					'id'       => 'metabox',
					'type'     => 'switcher',
					'title'    => __( 'Single Page/Post Options', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable the single page/post options that will allow you to individually customize your single page or post.', 'kemet-addons' ),
					'default'  => true,
				),
				array(
					'id'       => 'extra-headers',
					'type'     => 'switcher',
					'title'    => __( 'Advanced Headers', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable more header layouts and no header option in both customizer and page/post options.', 'kemet-addons' ),
					'default'  => false,
				),
				array(
					'id'       => 'sticky-header',
					'type'     => 'switcher',
					'title'    => __( 'Sticky Header', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable Kemet sticky header options.', 'kemet-addons' ),
					'default'  => false,
				),
				array(
					'id'       => 'top-bar-section',
					'type'     => 'switcher',
					'title'    => __( 'Top Bar Section', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable the top bar area that includes right and left sections with unlimited content possibilities.', 'kemet-addons' ),
					'default'  => false,
				),
				array(
					'id'       => 'page-title',
					'type'     => 'switcher',
					'title'    => __( 'Page Title', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable the page title area that includes page/post title and breadcrumbs.', 'kemet-addons' ),
					'default'  => false,
				),
				array(
					'id'       => 'go-top',
					'type'     => 'switcher',
					'title'    => __( 'Go to Top Button', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable the Go to Top button including its customization options.', 'kemet-addons' ),
					'default'  => false,
				),
				array(
					'id'       => 'extra-widgets',
					'type'     => 'switcher',
					'title'    => __( 'Extra Widgets', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable Kemet extra widgets that have been built to enrich your WordPress website.', 'kemet-addons' ),
					'default'  => false,
				),
				array(
					'id'       => 'blog-layouts',
					'type'     => 'switcher',
					'title'    => __( 'Blog Layouts', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable Extra Blog Layouts', 'kemet-addons' ),
					'default'  => false,
				),
				array(
					'id'       => 'single-post',
					'type'     => 'switcher',
					'title'    => __( 'Single Post Options', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable the extra options that will allow you to customize your single post content.', 'kemet-addons' ),
					'default'  => false,
				),
				array(
					'id'       => 'custom-layout',
					'type'     => 'switcher',
					'title'    => __( 'Custom Layout', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable custom layout option that will allow you to create your own custom content, script, or code on various hook locations.', 'kemet-addons' ),
					'default'  => false,
				),
				array(
					'id'       => 'mega-menu',
					'type'     => 'switcher',
					'title'    => __( 'Mega Menu', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable Mega Menu', 'kemet-addons' ),
					'default'  => false,
				),
				array(
					'id'       => 'custom-fonts',
					'type'     => 'switcher',
					'title'    => __( 'Custom Fonts', 'kemet-addons' ),
					'subtitle' => __( 'Enable/Disable Custom fonts.', 'kemet-addons' ),
					'default'  => false,
				),
			);

			$woo_option = array(
				'id'       => 'woocommerce',
				'type'     => 'switcher',
				'title'    => __( 'Woocommerce', 'kemet-addons' ),
				'subtitle' => __( 'Enable/Disable the extra options that allows you to control & customize WooCommerce product page and product listing.', 'kemet-addons' ),
				'default'  => false,
			);
			if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				$woo_option += array( 'class' => 'hidden-field-input' );
				$woo_option += array( 'desc' => __( 'To use this add-on, please activate WooCommerce plugin.', 'kemet-addons' ) );
			}

			array_push( $options, $woo_option );

			$reset_import = array(
				'id'       => 'reset-import-export',
				'type'     => 'switcher',
				'title'    => __( 'Customizer Reset, Import, and Export Buttons', 'kemet-addons' ),
				'subtitle' => __( 'Enable/Disable the import, export and reset buttons that will give you the ability to apply any of those actions to the customizer settings.', 'kemet-addons' ),
				'default'  => false,
			);

			array_push( $options, $reset_import );

			return $options;
		}

		/**
		 * Render options tab html
		 *
		 * @return void
		 */
		public function render_html() {
			$switcher = new KFW();
			$options  = $this->get_options();
			foreach ( $options as $option ) {
				$kemet_options = get_option( 'kemet_addons_options', array() );
				$value         = isset( $kemet_options[ $option['id'] ] ) ? $kemet_options[ $option['id'] ] : $option['default'];
				$switcher->field( $option, $value );
			}
		}
	}
}
