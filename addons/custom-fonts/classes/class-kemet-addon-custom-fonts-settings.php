<?php
/**
 * Custom Fonts
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Custom_Fonts_Settings' ) ) {
	/**
	 * Custom_fonts Settings
	 */
	class Kemet_Addon_Custom_Fonts_Settings {

		/**
		 * Instance
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 *  Initiator
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
			add_action( 'init', array( $this, 'custom_post_type' ) );
			if ( is_admin() ) {
				add_action( 'admin_menu', array( $this, 'add_custom_fonts_item' ), 100 );
			}
		}

		/**
		 * Add sub menu page
		 */
		public function add_custom_fonts_item() {

			// Name.
			add_submenu_page(
				'kemet_panel',
				esc_html__( 'Custom Fonts', 'kemet-addons' ),
				esc_html__( 'Custom Fonts', 'kemet-addons' ),
				'manage_options',
				'edit.php?post_type=' . KEMET_CUSTOM_FONTS_POST_TYPE
			);

		}

		/**
		 * Register post type
		 */
		public static function custom_post_type() {

			// Register the post type.
			register_post_type(
				KEMET_CUSTOM_FONTS_POST_TYPE,
				apply_filters(
					'kemet_custom_fonts_args',
					array(
						'labels'              => array(
							'name'          => esc_html__( 'Custom Fonts', 'kemet-addons' ),
							'singular_name' => esc_html__( 'Custom Font', 'kemet-addons' ),
							'search_items'  => esc_html__( 'Search Custom Fonts', 'kemet-addons' ),
							'all_items'     => esc_html__( 'All Custom Fonts', 'kemet-addons' ),
							'edit_item'     => esc_html__( 'Edit Custom Font', 'kemet-addons' ),
							'view_item'     => esc_html__( 'View Custom Font', 'kemet-addons' ),
							'add_new'       => esc_html__( 'Add New', 'kemet-addons' ),
							'update_item'   => esc_html__( 'Update Custom Font', 'kemet-addons' ),
							'add_new_item'  => esc_html__( 'Add New', 'kemet-addons' ),
							'new_item_name' => esc_html__( 'New Custom Font Name', 'kemet-addons' ),
						),
						'public'              => false,
						'publicly_queryable'  => false,
						'map_meta_cap'        => true,
						'show_ui'             => true,
						'exclude_from_search' => true,
						'show_in_menu'        => false,
						'query_var'           => true,
						'rewrite'             => false,
						'has_archive'         => false,
						'show_in_rest'        => true,
						'hierarchical'        => false,
						'menu_position'       => null,
						'supports'            => array( 'title' ),
					)
				)
			);

		}
	}
}
Kemet_Addon_Custom_Fonts_Settings::get_instance();
