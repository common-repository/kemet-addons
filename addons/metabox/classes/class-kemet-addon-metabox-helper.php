<?php
/**
 * Kemet Meta Box Helper
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Metabox_Helper' ) ) {

	/**
	 * Meta Box Helper
	 */
	class Kemet_Addon_Metabox_Helper {

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
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wp', array( $this, 'meta_options_hooks' ) );
		}

		/**
		 * Metabox Hooks
		 */
		public function meta_options_hooks() {

			if ( is_singular() ) {
				add_filter( 'kemet_featured_image_enabled', array( $this, 'featured_img' ) );
				add_filter( 'kemet_main_footer_disable', array( $this, 'kemet_footer_display' ) );
				add_filter( 'kmt_footer_copyright_layout_disable', array( $this, 'kemet_copyright_display' ), 1 );
				add_filter( 'display_go_top_icon', array( $this, 'kemet_go_top_display' ), 1 );
				add_filter( 'kemet_content_padding', array( $this, 'content_padding' ) );
				add_filter( 'kemet_get_content_layout', array( $this, 'content_layout' ) );

			}

		}

		/**
		 * Content Layout
		 *
		 * @param string $defaults default content layout.
		 * @return string
		 */
		public function content_layout( $defaults ) {
			$default_content_meta = get_post_meta( get_the_ID(), 'kemet-content-layout', true );
			$meta                 = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$content_layout       = ( isset( $meta['site-content-layout'] ) ) ? $meta['site-content-layout'] : '';

			if ( ! empty( $content_layout ) && isset( $default_content_meta ) ) {

				update_post_meta( get_the_ID(), 'kemet-content-layout', $content_layout );
			} elseif ( empty( $content_layout ) && ! isset( $default_content_meta ) ) {

				add_post_meta( get_the_ID(), 'kemet-content-layout', $defaults );
			} elseif ( ! empty( $content_layout ) && ! isset( $default_content_meta ) ) {

				add_post_meta( get_the_ID(), 'kemet-content-layout', $content_layout );
			} elseif ( empty( $content_layout ) && isset( $default_content_meta ) ) {
				$old_meta                        = ! empty( $meta ) ? $meta : array();
				$old_meta['site-content-layout'] = $default_content_meta;
				if ( isset( $meta ) ) {
					update_post_meta( get_the_ID(), 'kemet_page_options', $old_meta );
				} else {
					add_post_meta( get_the_ID(), 'kemet_page_options', $old_meta );
				}
			}

			return $defaults;
		}

		/**
		 * Disable Post / Page Featured Image
		 *
		 * @param boolean $defaults default value.
		 * @return boolean
		 */
		public function featured_img( $defaults ) {
			$meta         = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$featured_img = ( isset( $meta['kemet-featured-img'] ) ) ? $meta['kemet-featured-img'] : false;

			if ( $featured_img ) {
				$defaults = false;
			}

			return $defaults;
		}

		/**
		 * Disable Post / Page Footer Widgets
		 *
		 * @param boolean $defaults default value.
		 * @return boolean
		 */
		public function kemet_footer_display( $defaults ) {

			$meta           = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$footer_display = ( isset( $meta['kemet-disable-footer'] ) ) ? $meta['kemet-disable-footer'] : false;

			if ( $footer_display ) {
				$defaults = false;
			}

			return $defaults;
		}

		/**
		 * Disable Post / Page CopyRight
		 *
		 * @param boolean $defaults default value.
		 * @return boolean
		 */
		public function kemet_copyright_display( $defaults ) {
			$meta              = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$copyright_display = ( isset( $meta['kemet-disable-copyright-footer'] ) ) ? $meta['kemet-disable-copyright-footer'] : false;

			if ( $copyright_display ) {
				$defaults = false;
			}

			return $defaults;
		}
		/**
		 * Disable Post / Page Go Top Icon
		 *
		 * @param boolean $defaults default value.
		 * @return boolean
		 */
		public function kemet_go_top_display( $defaults ) {
			$meta           = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$go_top_display = ( isset( $meta['kemet-disable-go-top'] ) ) ? $meta['kemet-disable-go-top'] : false;

			if ( $go_top_display ) {
				$defaults = false;
			}

			return $defaults;
		}
		/**
		 * Post / Page Sidebar Display
		 *
		 * @param boolean $defaults default layout.
		 * @return boolean
		 */
		public function single_page_layout( $defaults ) {
			$meta                = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$sidebar_layout_meta = $meta['site-sidebar-layout'];

			if ( '1' == $sidebar_layout_meta ) {
				$defaults = false;
			}

			return $defaults;
		}
		/**
		 * Content Padding
		 *
		 * @param object $defaults default spacing.
		 * @return object
		 */
		public function content_padding( $defaults ) {
			$meta    = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$padding = ( isset( $meta['kemet-content-padding'] ) ) ? $meta['kemet-content-padding'] : '';

			if ( '' != $padding ) {
				$defaults = array(
					'desktop'      => array(
						'top'    => $padding['top'],
						'bottom' => $padding['bottom'],
					),
					'tablet'       => array(
						'top'    => '',
						'bottom' => '',
					),
					'mobile'       => array(
						'top'    => '',
						'bottom' => '',
					),
					'desktop-unit' => $padding['unit'],
					'tablet-unit'  => $padding['unit'],
					'mobile-unit'  => $padding['unit'],
				);
			}

			return $defaults;
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kemet_Addon_Metabox_Helper::get_instance();
