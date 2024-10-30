<?php
/**
 * Sticky Headers Meta Box
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Sticky_Header_Metabox' ) ) {

	/**
	 * Sticky Header Metabox
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Sticky_Header_Metabox {

		/**
		 * Instance
		 *
		 * @var $instance
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
		 * Constructor
		 */
		public function __construct() {
			self::add_sticky_headers_meta_box();
			add_action( 'wp', array( $this, 'meta_options_hooks' ) );
		}

		/**
		 * Metabox Hooks
		 *
		 * @return void
		 */
		public function meta_options_hooks() {

			if ( is_singular() ) {
				add_filter( 'kemet_disable_sticky_header', array( $this, 'disable_sticky_header' ) );
			}

		}

		/**
		 * Add sticky header meta
		 *
		 * @return void
		 */
		public function add_sticky_headers_meta_box() {

			KFW::create_section(
				'kemet_page_options',
				array(
					'title'        => __( 'Sticky Header', 'kemet-addons' ),
					'icon'         => 'dashicons dashicons-admin-site-alt2',
					'priority_num' => 4,
					'fields'       => array(
						array(
							'id'      => 'kemet-disable-sticky-header',
							'type'    => 'button-set',
							'title'   => __( 'Disable Sticky Header', 'kemet-addons' ),
							'options' => array(
								'default' => __( 'Default', 'kemet-addons' ),
								'enable'  => __( 'Enable', 'kemet-addons' ),
								'disable' => __( 'Disable', 'kemet-addons' ),
							),
							'label'   => __( 'Disable The Sticky Header in The Current Page/Post.', 'kemet-addons' ),
							'default' => 'default',
						),
					),
				)
			);
		}

		/**
		 * Sticky Header Option
		 *
		 * @param string $default default value.
		 * @return string
		 */
		public function disable_sticky_header( $default ) {

			$meta                  = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$disable_sticky_header = ( isset( $meta['kemet-disable-sticky-header'] ) ) ? $meta['kemet-disable-sticky-header'] : 'default';

			if ( 'disable' === $disable_sticky_header ) {
				$default = false;
			} elseif ( 'enable' === $disable_sticky_header ) {
				$default = true;
			}

			return $default;
		}
	}
}

new Kemet_Addon_Sticky_Header_Metabox();
