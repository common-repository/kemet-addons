<?php
/**
 * Custom Layout
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Custom_Layout_Settings' ) ) {
	/**
	 * Custom_Layout Settings
	 */
	class Kemet_Addon_Custom_Layout_Settings {

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
			add_filter( 'single_template', array( $this, 'get_custom_layout_template' ) );
			if ( is_admin() ) {
				add_action( 'admin_menu', array( $this, 'add_custom_layout_item' ), 100 );
			}
			add_filter( 'fl_builder_post_types', array( $this, 'add_to_beaver_builder_post_types' ), 10, 1 );
			add_action( 'do_meta_boxes', array( $this, 'remove_kemet_page_options' ) );
		}

		/**
		 * Remove Kemet Meta Box
		 */
		public function remove_kemet_page_options() {
			remove_meta_box( 'kemet_page_options', KEMET_CUSTOM_LAYOUT_POST_TYPE, 'side' );
		}

		/**
		 * Add page builder support to custom layout
		 *
		 * @param array $value post types.
		 * @return array
		 */
		public function add_to_beaver_builder_post_types( $value ) {

			$value[] = KEMET_CUSTOM_LAYOUT_POST_TYPE;

			return $value;
		}

		/**
		 * Custom layout template.
		 *
		 * @param  string $template Single Post template path.
		 * @return string
		 */
		public function get_custom_layout_template( $template ) {
			global $post;

			if ( KEMET_CUSTOM_LAYOUT_POST_TYPE == $post->post_type ) {
				$template = KEMET_CUSTOM_LAYOUT_DIR . 'templates/template.php';
			}

			return $template;
		}

		/**
		 * Add sub menu page
		 */
		public function add_custom_layout_item() {

			// Name.
			add_submenu_page(
				'kemet_panel',
				esc_html__( 'Custom Layouts', 'kemet-addons' ),
				esc_html__( 'Custom Layouts', 'kemet-addons' ),
				'manage_options',
				'edit.php?post_type=' . KEMET_CUSTOM_LAYOUT_POST_TYPE
			);

		}

		/**
		 * Register post type
		 */
		public static function custom_post_type() {

			$code_editor = true;

			// @codingStandardsIgnoreStart
			if ( isset( $_GET['code_editor'] ) || ( isset( $_GET['post'] ) && get_post_type( $_GET['post'] ) == KEMET_CUSTOM_LAYOUT_POST_TYPE && get_post_meta( $_GET['post'], 'enable-code-editor', true ) == true ) ) {
			// @codingStandardsIgnoreEnd
				$code_editor = false;
			}

			if ( isset( $_GET['wordpress_editor'] ) ) {
				$code_editor = true;
			}
			// Register the post type.
			register_post_type(
				KEMET_CUSTOM_LAYOUT_POST_TYPE,
				apply_filters(
					'kemet_custon_layouts_args',
					array(
						'labels'              => array(
							'name'          => esc_html__( 'Custom Layouts', 'kemet-addons' ),
							'singular_name' => esc_html__( 'Custom Layout', 'kemet-addons' ),
							'search_items'  => esc_html__( 'Search Custom Layouts', 'kemet-addons' ),
							'all_items'     => esc_html__( 'All Custom Layouts', 'kemet-addons' ),
							'edit_item'     => esc_html__( 'Edit Custom Layout', 'kemet-addons' ),
							'view_item'     => esc_html__( 'View Custom Layout', 'kemet-addons' ),
							'add_new'       => esc_html__( 'Add New', 'kemet-addons' ),
							'update_item'   => esc_html__( 'Update Custom Layout', 'kemet-addons' ),
							'add_new_item'  => esc_html__( 'Add New', 'kemet-addons' ),
							'new_item_name' => esc_html__( 'New Custom Layout Name', 'kemet-addons' ),
						),
						'public'              => true,
						'hierarchical'        => false,
						'show_ui'             => true,
						'show_in_menu'        => false,
						'show_in_nav_menus'   => false,
						'show_in_admin_bar'   => true,
						'can_export'          => true,
						'exclude_from_search' => true,
						'capability_type'     => 'post',
						'rewrite'             => false,
						'show_in_rest'        => $code_editor,
						'supports'            => array( 'title', 'editor', 'author', 'elementor' ),
					)
				)
			);

		}
	}
}
Kemet_Addon_Custom_Layout_Settings::get_instance();
