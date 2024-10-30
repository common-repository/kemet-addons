<?php
/**
 * Top Bar Section
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Top_Bar_Metabox' ) ) {

	/**
	 * Top Bar Metabox
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Top_Bar_Metabox {

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
			self::add_top_bar_meta_box();
			add_action( 'wp', array( $this, 'meta_options_hooks' ) );
		}

		/**
		 * Metabox Hooks
		 *
		 * @return void
		 */
		public function meta_options_hooks() {

			if ( is_singular() ) {
				add_filter( 'kemet_top_bar_enabled', array( $this, 'top_bar' ) );
				add_filter( 'kemet_addons_merge_top_bar_with_header', array( $this, 'merge_top_bar' ) );
				add_filter( 'kemet_addons_disable_top_bar_separators', array( $this, 'disable_top_bar_separator' ) );
			}
		}

		/**
		 * Add top bar meta
		 *
		 * @return void
		 */
		public function add_top_bar_meta_box() {

			KFW::create_section(
				'kemet_page_options',
				array(
					'title'        => __( 'Top Bar', 'kemet-addons' ),
					'icon'         => 'dashicons dashicons-admin-tools',
					'priority_num' => 2,
					'fields'       => array(
						array(
							'id'      => 'kemet-merge-top-bar-with-header',
							'type'    => 'checkbox',
							'title'   => __( 'Merge/Combine Top Bar With Main Header', 'kemet-addons' ),
							'label'   => __( 'Merge/Combine Top Bar With Main Header in The Current Page/Post.', 'kemet-addons' ),
							'default' => false,
						),
						array(
							'id'      => 'kemet-disable-top-bar-separators',
							'type'    => 'checkbox',
							'title'   => __( 'Disable top bar separators', 'kemet-addons' ),
							'label'   => __( 'Disable top bar separators in The Current Page/Post.', 'kemet-addons' ),
							'default' => false,
						),
						array(
							'id'      => 'kemet-top-bar-display',
							'type'    => 'checkbox',
							'title'   => __( 'Disable Top Bar', 'kemet-addons' ),
							'label'   => __( 'Disable The Top Bar in The Current Page/Post.', 'kemet-addons' ),
							'default' => false,
						),
					),
				)
			);
		}

		/**
		 * Disable topbar
		 *
		 * @param boolean $defaults default value.
		 * @return boolean
		 */
		public function top_bar( $defaults ) {

			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true );

			$display_top_bar = ( isset( $meta['kemet-top-bar-display'] ) ) ? $meta['kemet-top-bar-display'] : false;

			if ( true == $display_top_bar ) {
				$defaults = false;
			}

			return $defaults;
		}

		/**
		 * Merge Top Bar with main header
		 *
		 * @param boolean $defaults default value.
		 * @return boolean
		 */
		public function merge_top_bar( $defaults ) {

			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true );

			$merge_top_bar = ( isset( $meta['kemet-merge-top-bar-with-header'] ) && '' != $meta['kemet-merge-top-bar-with-header'] ) ? $meta['kemet-merge-top-bar-with-header'] : $defaults;

			return $merge_top_bar;
		}

		/**
		 * Disable Top Bar Separators
		 *
		 * @param boolean $defaults default value.
		 * @return boolean
		 */
		public function disable_top_bar_separator( $defaults ) {

			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true );

			$disable_separators = ( isset( $meta['kemet-disable-top-bar-separators'] ) ) ? $meta['kemet-disable-top-bar-separators'] : $defaults;

			return $disable_separators;
		}
	}
}

new Kemet_Addon_Top_Bar_Metabox();
