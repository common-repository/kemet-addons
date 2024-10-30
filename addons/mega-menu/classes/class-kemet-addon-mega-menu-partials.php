<?php
/**
 * Mega menu
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Mega_Menu_Partials' ) ) {

	/**
	 * Mega menu addon partials
	 */
	class Kemet_Addon_Mega_Menu_Partials {

		/**
		 * Mega Menu Style
		 *
		 * @var string
		 */
		private static $mega_menu_style = '';

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Meta values
		 *
		 * @var array meta_values
		 */
		private static $meta_values = array();

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
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_script' ) );
			add_filter( 'wp_nav_menu_args', array( $this, 'nav_menu_args' ) );
			add_filter( 'wp_footer', array( $this, 'megamenu_style' ) );
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'update_meta_values_array' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'update_meta_values_array' ) );
		}

		/**
		 * Update menu item values
		 *
		 * @param object $item menu item object.
		 * @return object
		 */
		public function update_meta_values_array( $item ) {

			if ( isset( $item->ID ) ) {
				$template = get_post_meta( $item->ID, 'column-template', true );

				if ( ! empty( $template ) ) {
					self::$meta_values[ $item->ID ] = $template;
				}
			}

			return $item;

		}

		/**
		 * Nav menu arguments
		 *
		 * @param object $args menu arguments.
		 * @return object
		 */
		public function nav_menu_args( $args ) {

			if ( 'primary' == $args['theme_location'] ) {
				$args['walker'] = new Kemet_Addon_Mega_Menu_Walker_Nav_Menu();
			}

			return $args;
		}

		/**
		 * Admin styles & scripts
		 *
		 * @return void
		 */
		public function admin_script() {

			$css_prefix = '.min.css';
			$js_prefix  = '.min.js';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$css_prefix = '.css';
				$js_prefix  = '.js';
				$dir        = 'unminified';
			}

			wp_enqueue_script(
				'kemet-addons-mega-menu-js',
				KEMET_MEGA_MENU_URL . 'assets/js/' . $dir . '/mega-menu-backend' . $js_prefix,
				array(
					'jquery',
					'kemet-addons-select2',
				),
				KEMET_ADDONS_VERSION,
				true
			);

			wp_enqueue_style( 'kemet-addons-mega-menu-css', KEMET_MEGA_MENU_URL . 'assets/css/' . $dir . '/mega-menu' . $css_prefix, KEMET_ADDONS_VERSION ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

			wp_localize_script(
				'kemet-addons-mega-menu-js',
				'kemetAddons',
				apply_filters(
					'kemet_addons_admin_js_localize',
					array(
						'ajax_url'            => admin_url( 'admin-ajax.php' ),
						'ajax_nonce'          => wp_create_nonce( 'kemet-addons-ajax-get-post' ),
						'template_meta_value' => self::$meta_values,
						'ajax_title_nonce'    => wp_create_nonce( 'kemet-addons-ajax-get-title' ),
					)
				)
			);
		}

		/**
		 * Enqueues scripts and styles for the mega menu
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

			Kemet_Style_Generator::kmt_add_css( KEMET_MEGA_MENU_DIR . 'assets/css/' . $dir . '/style' . $css_prefix );
		}

		/**
		 * Append CSS style to class variable.
		 *
		 * @param string $style Inline style string.
		 * @return void
		 */
		public static function add_css( $style ) {
			self::$mega_menu_style .= $style;
		}

		/**
		 * Print inline CSS to footer.
		 *
		 * @return void
		 */
		public function megamenu_style() {

			if ( '' != self::$mega_menu_style ) {
				printf( "<style type='text/css' class='kemet-megamenu-inline-style'>%s</style>", esc_attr( self::$mega_menu_style ) );
			}
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

			Kemet_Style_Generator::kmt_add_js( KEMET_MEGA_MENU_DIR . 'assets/js/' . $dir . '/mega-menu' . $js_prefix );
		}

		/**
		 * Add admin Scripts
		 */
		public function enqueue_scripts() {

			$menu_locations = get_nav_menu_locations();

			foreach ( $menu_locations as $menu_id ) {
				$nav_items = wp_get_nav_menu_items( $menu_id );

				if ( ! empty( $nav_items ) ) {
					foreach ( $nav_items as $nav_item ) {

						if ( isset( $nav_item->megamenu_column_template ) && '' != $nav_item->megamenu_column_template ) {

							$template_id = explode( '-', $nav_item->megamenu_column_template );
							$template_id = $template_id[1];

							if ( class_exists( 'Kemet_Addons_Page_Builder_Compatiblity' ) ) {
								$custom_layout_compat = Kemet_Addons_Page_Builder_Compatiblity::get_instance();
								$custom_layout_compat->enqueue_scripts( $template_id );
							}
						}
					}
				}
			}
		}
	}
}
Kemet_Addon_Mega_Menu_Partials::get_instance();
