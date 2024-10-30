<?php
/**
 * Extra Headers Meta Box
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Extra_Headers_Meta_Box' ) ) {

	/**
	 * Header Meta
	 */
	class Kemet_Addon_Extra_Headers_Meta_Box {

		/**
		 * Instance
		 *
		 * @var $instance
		 */
		private static $instance;

		/**
		 * Initiator
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
			self::add_extra_headers_meta_box();
			add_action( 'wp', array( $this, 'meta_options_hooks' ) );
		}

		/**
		 * Metabox Hooks
		 *
		 * @return void
		 */
		public function meta_options_hooks() {

			if ( is_singular() ) {
				add_filter( 'kemet_primary_header_layout', array( $this, 'primary_header' ) );
				add_filter( 'kemet_header_class', array( $this, 'add_header_class' ) );
				add_filter( 'kemet_trnsparent_header', array( $this, 'transparent_header' ) );
				add_filter( 'kemet_header_width', array( $this, 'header_width' ) );
				add_filter( 'kemet_main_menu_link_color', array( $this, 'main_menu_color' ) );
				add_filter( 'kemet_main_menu_link_h_color', array( $this, 'main_menu_hover_color' ) );
				add_filter( 'kemet_main_menu_slug', array( $this, 'main_menu_slug' ) );
			}

		}

		/**
		 * Meta Options
		 *
		 * @return void
		 */
		public function add_extra_headers_meta_box() {

			KFW::create_section(
				'kemet_page_options',
				array(
					'title'        => __( 'Header', 'kemet-addons' ),
					'icon'         => 'dashicons dashicons-admin-post',
					'priority_num' => 3,
					'fields'       => array(
						array(
							'id'      => 'kemet-main-header-display',
							'type'    => 'image-select',
							'title'   => __( 'Display Primary Header', 'kemet-addons' ),
							'options' => array(
								'default'              => KEMET_EXTRA_HEADERS_URL . '/assets/images/default.png',
								'header-main-layout-1' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-01.png',
								'header-main-layout-2' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-02.png',
								'header-main-layout-3' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-03.png',
								'header-main-layout-4' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-04.png',
								'header-main-layout-5' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-05.png',
								'header-main-layout-6' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-06.png',
								'header-main-layout-7' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-07.png',
								'header-main-layout-8' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-08.png',
								'disable'              => KEMET_EXTRA_HEADERS_URL . '/assets/images/disable.png',
							),
							'default' => 'default',
						),
						array(
							'id'         => 'kemet-meta-enable-header-transparent',
							'type'       => 'button-set',
							'title'      => __( 'Overlay Header', 'kemet-addons' ),
							'options'    => array(
								'default' => __( 'Default', 'kemet-addons' ),
								'enable'  => __( 'Enable', 'kemet-addons' ),
								'disable' => __( 'Disable', 'kemet-addons' ),
							),
							'default'    => 'default',
							'dependency' => array( 'kemet-main-header-display', '!=', 'disable' ),
						),
						array(
							'id'      => 'header-main-layout-width',
							'type'    => 'select',
							'title'   => __( 'Header Width', 'kemet-addons' ),
							'options' => array(
								'default'   => __( 'Default', 'kemet-addons' ),
								'full'      => __( 'Full Width', 'kemet-addons' ),
								'content'   => __( 'Content Width', 'kemet-addons' ),
								'boxed'     => __( 'Boxed Content', 'kemet-addons' ),
								'stretched' => __( 'Stretched Content', 'kemet-addons' ),
							),
							'default' => 'default',
						),
						array(
							'id'         => 'main-menu-color',
							'type'       => 'color',
							'title'      => __( 'Main menu Item Color', 'kemet-addons' ),
							'dependency' => array( 'kemet-main-header-display', '!=', 'disable' ),
						),
						array(
							'id'         => 'main-menu-hover-color',
							'type'       => 'color',
							'title'      => __( 'Main menu Item Hover Color', 'kemet-addons' ),
							'dependency' => array( 'kemet-main-header-display', '!=', 'disable' ),
						),
						array(
							'id'          => 'header-main-menu-slug',
							'type'        => 'select',
							'title'       => __( 'Main Menu', 'kemet-addons' ),
							'placeholder' => __( 'Select an option', 'kemet-addons' ),
							'options'     => $this->get_wp_menus(),
						),
					),
				)
			);
		}

		/**
		 * Get WP menus
		 */
		function get_wp_menus() {
			$menus     = array();
			$get_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
			foreach ( $get_menus as $menu ) {
				$menus[ $menu->term_id ] = $menu->name;
			}
			return $menus;
		}

		/**
		 * Transparent Header Option
		 *
		 * @param string $classes header classes.
		 * @param string $default default value.
		 * @return string
		 */
		public function add_header_class( $classes, $default = '' ) {

			$enable_trans_header = kemet_get_option( 'enable-transparent' );
			$meta                = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$trans_meta_option   = ( isset( $meta['kemet-meta-enable-header-transparent'] ) ) ? $meta['kemet-meta-enable-header-transparent'] : $default;

			if ( ( 'enable' === $trans_meta_option && $enable_trans_header ) || 'enable' === $trans_meta_option ) {

				$classes[] = 'kmt-header-transparent';

			} elseif ( 'disable' === $trans_meta_option && $enable_trans_header ) {
				if ( in_array( 'kmt-header-transparent', $classes ) ) {
					unset( $classes[ array_search( 'kmt-header-transparent', $classes ) ] );
				}
			}

			return $classes;
		}

		/**
		 * Disable Primary Header
		 *
		 * @param string $defaults default layout.
		 * @return string
		 */
		public function primary_header( $defaults ) {

			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true );

			$display_header = ( isset( $meta['kemet-main-header-display'] ) && 'default' != $meta['kemet-main-header-display'] ) ? $meta['kemet-main-header-display'] : $defaults;

			return $display_header;
		}

		/**
		 * Transparent Header
		 *
		 * @param boolean $default default value.
		 * @return boolean
		 */
		public function transparent_header( $default ) {

			$meta              = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$trans_meta_option = ( isset( $meta['kemet-meta-enable-header-transparent'] ) && 'default' != $meta['kemet-meta-enable-header-transparent'] ) ? $meta['kemet-meta-enable-header-transparent'] : $default;

			return $trans_meta_option;
		}

		/**
		 * Header Width
		 *
		 * @param string $default default header width.
		 * @return string
		 */
		public function header_width( $default ) {
			$meta         = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$header_width = ( isset( $meta['header-main-layout-width'] ) && 'default' != $meta['header-main-layout-width'] ) ? $meta['header-main-layout-width'] : $default;

			return $header_width;
		}

		/**
		 * Main menu item color
		 *
		 * @param mixed $default default color.
		 * @return mixed
		 */
		public function main_menu_color( $default ) {
			$meta                 = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$main_menu_link_color = isset( $meta['main-menu-color'] ) ? $meta['main-menu-color'] : '';

			if ( '' != $main_menu_link_color ) {
				if ( is_array( $default ) ) {
					$default['desktop'] = $main_menu_link_color;
				} else {
					return $main_menu_link_color;
				}
			}
			return $default;
		}

		/**
		 * Main menu item hover color
		 *
		 * @param mixed $default default hover color.
		 * @return mixed
		 */
		public function main_menu_hover_color( $default ) {
			$meta                 = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$main_menu_link_color = isset( $meta['main-menu-hover-color'] ) ? $meta['main-menu-hover-color'] : '';

			if ( '' != $main_menu_link_color ) {
				if ( is_array( $default ) ) {
					$default['desktop'] = $main_menu_link_color;
				} else {
					return $main_menu_link_color;
				}
			}
			return $default;
		}

		/**
		 * Main menu slug
		 *
		 * @param string $default defult menu slug.
		 * @return mixed
		 */
		public function main_menu_slug( $default ) {
			$meta           = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$main_menu_slug = isset( $meta['header-main-menu-slug'] ) ? $meta['header-main-menu-slug'] : '';

			if ( '' != $main_menu_slug ) {
				return $main_menu_slug;
			}
			return $default;
		}
	}
}

new Kemet_Addon_Extra_Headers_Meta_Box();
