<?php
/**
 * Extra Headers
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Blog_Layouts_Settings' ) ) {
	/**
	 * Extra Headers Settings
	 *
	 * @since 1.0.0
	 */
	class Kemet_Blog_Layouts_Settings {

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
		 *  Constructor
		 */
		public function __construct() {

			add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'wp_head', array( $this, 'custom_template' ), 1 );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );
			add_action( 'kemet_pagination_infinite', array( $this, 'custom_template' ) );
		}

		/**
		 * Default Values
		 *
		 * @param array $defaults default value.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {
			$defaults['blog-layouts']                   = 'blog-layout-1';
			$defaults['blog-grids']                     = array(
				'desktop' => 3,
				'tablet'  => 2,
				'mobile'  => 1,
			);
			$defaults['blog-excerpt-length']            = 50;
			$defaults['blog-posts-border-color']        = '';
			$defaults['blog-posts-border-size']         = '';
			$defaults['blog-title-meta-border-color']   = '';
			$defaults['blog-title-meta-border-size']    = '';
			$defaults['blog-layout-mode']               = 'masonry';
			$defaults['overlay-image-style']            = 'none';
			$defaults['overlay-image-bg-color']         = '';
			$defaults['overlay-icon-color']             = '';
			$defaults['hover-image-effect']             = 'none';
			$defaults['blog-container-inner-spacing']   = '';
			$defaults['post-image-position']            = 'left';
			$defaults['blog-pagination-style']          = 'next-prev';
			$defaults['blog-pagination-border-color']   = '';
			$defaults['blog-infinite-loader-color']     = '';
			$defaults['blog-infinite-scroll-last-text'] = __( 'No more posts to show.', 'kemet-addons' );
			$defaults['post-margin-bottom']             = '';
			$defaults['layout-2-post-border-size']      = '';
			$defaults['load-more-style']                = 'dots';
			$defaults['load-more-text']                 = 'Load More';
			$defaults['blog-featured-image-width']      = '';
			$defaults['blog-featured-image-height']     = '';

			return $defaults;
		}

		/**
		 * Custom Templates
		 *
		 * @return void
		 */
		public function custom_template() {

			remove_action( 'kemet_entry_content_blog', 'kemet_entry_content_blog_template' );
			add_action( 'kemet_entry_content_blog', array( $this, 'blog_template' ), 1 );
		}
		/**
		 * Blog Template
		 *
		 * @return void
		 */
		public function blog_template() {
			$blog_layout = kemet_get_option( 'blog-layouts' );
			if ( 'blog-layout-1' == $blog_layout || 'blog-layout-2' == $blog_layout ) {
				kemetaddons_get_template( 'blog-layouts/templates/blog-layout-1.php' );
			} else {
				kemetaddons_get_template( 'blog-layouts/templates/' . esc_attr( $blog_layout ) . '.php' );
			}

		}

		/**
		 * Customizer Options
		 *
		 * @param object $wp_customize wp_customize.
		 * @return void
		 */
		public function customize_register( $wp_customize ) {
			require_once KEMET_BLOG_LAYOUTS_DIR . 'customizer/customizer-options.php';

		}

		/**
		 * Admin Scripts
		 *
		 * @return void
		 */
		public function preview_scripts() {
			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-extra-blogs-customize-preview-js', KEMET_BLOG_LAYOUTS_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );
			} else {
				wp_enqueue_script( 'kemet-extra-blogs-customize-preview-js', KEMET_BLOG_LAYOUTS_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );         }
		}

	}
}
Kemet_Blog_Layouts_Settings::get_instance();
