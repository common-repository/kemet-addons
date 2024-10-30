<?php
/**
 * Page Title Meta Box
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Page_Title_Metabox' ) ) {

	/**
	 * Page Title Meta Box
	 */
	class Kemet_Addon_Page_Title_Metabox {

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
			self::add_page_title_meta_box();
			add_action( 'wp', array( $this, 'meta_options_hooks' ) );
		}

		/**
		 * Metabox Hooks
		 *
		 * @return void
		 */
		public function meta_options_hooks() {

			if ( is_singular() ) {
				add_filter( 'kemet_the_page_title_layout', array( $this, 'post_title' ) );
				add_filter( 'kemet_disable_breadcrumbs', array( $this, 'disable_breadcrumbs' ) );
				add_filter( 'kemet_sub_title_addon', array( $this, 'post_sub_title' ) );
				add_filter( 'sub_title_color', array( $this, 'post_sub_title_color' ) );
			}

		}

		/**
		 * Add page title meta
		 *
		 * @return void
		 */
		public function add_page_title_meta_box() {
			KFW::create_section(
				'kemet_page_options',
				array(
					'title'        => __( 'Page Title', 'kemet-addons' ),
					'icon'         => 'dashicons dashicons-format-quote',
					'priority_num' => 5,
					'fields'       => array(
						array(
							'id'      => 'kemet-page-title-display',
							'type'    => 'image-select',
							'title'   => __( 'Display Page Title', 'kemet-addons' ),
							'options' => array(
								'default'             => KEMET_PAGE_TITLE_URL . '/assets/images/default-page-title.png',
								'page-title-layout-1' => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-01.png',
								'page-title-layout-2' => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-02.png',
								'page-title-layout-3' => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-03.png',
								'disable'             => KEMET_PAGE_TITLE_URL . '/assets/images/disable-page-title.png',
							),
							'default' => 'default',
						),
						array(
							'id'    => 'sub-title',
							'type'  => 'text',
							'title' => __( 'Page Title Bar Subtitle Text', 'kemet-addons' ),
						),
						array(
							'id'         => 'sub-title-color',
							'type'       => 'color',
							'title'      => __( 'Sub Title Color', 'kemet-addons' ),
							'dependency' => array( 'sub-title', '!=', '' ),
						),
					),
				)
			);
			KFW::create_section(
				'kemet_page_options',
				array(
					'title'        => __( 'Breadcrumbs', 'kemet-addons' ),
					'icon'         => 'dashicons dashicons-tag',
					'priority_num' => 6,
					'fields'       => array(
						array(
							'id'      => 'kemet-disable-breadcrumbs',
							'type'    => 'checkbox',
							'title'   => __( 'Disable Breadcrumbs', 'kemet-addons' ),
							'label'   => __( 'Disable The Breadcrumbs in The Current Page/Post.', 'kemet-addons' ),
							'default' => false,
						),
					),
				)
			);
		}

		/**
		 * Disable Post / Page Title
		 *
		 * @param string $defaults default layout.
		 * @return string
		 */
		public function post_title( $defaults ) {
			$meta  = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$title = ( isset( $meta['kemet-page-title-display'] ) && 'default' != $meta['kemet-page-title-display'] ) ? $meta['kemet-page-title-display'] : $defaults;

			return $title;
		}

		/**
		 * Post / Page SubTitle
		 *
		 * @return string
		 */
		public function post_sub_title() {
			$meta      = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$sub_title = ( isset( $meta['sub-title'] ) ) ? $meta['sub-title'] : '';

			return $sub_title;
		}

		/**
		 * Post / Page SubTitle Color
		 *
		 * @param string $default default color.
		 * @return string
		 */
		public function post_sub_title_color( $default ) {
			$meta            = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$sub_title_color = ( isset( $meta['sub-title-color'] ) ) ? $meta['sub-title-color'] : '';
			if ( ! empty( $sub_title_color ) ) {
				$default = $sub_title_color;
			}
			return $default;
		}

		/**
		 * Breadcrumbs Option
		 *
		 * @param boolean $default default value.
		 * @return boolean
		 */
		public function disable_breadcrumbs( $default ) {

			$meta                = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$disable_breadcrumbs = ( isset( $meta['kemet-disable-breadcrumbs'] ) ) ? $meta['kemet-disable-breadcrumbs'] : false;

			if ( $disable_breadcrumbs ) {
				$default = false;
			}

			return $default;
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Kemet_Addon_Page_Title_Metabox();
