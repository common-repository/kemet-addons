<?php
/**
 * Single Post Section
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Single_Post_Partials' ) ) {

	/**
	 * Single Post Section
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Single_Post_Partials {

		/**
		 * Instance
		 *
		 * @var object
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
		 *  Constructor
		 */
		public function __construct() {
			add_filter( 'body_class', array( $this, 'kemet_body_classes' ) );
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'kemet_entry_content_single', array( $this, 'kemet_single_post_template_loader' ), 1 );
			add_filter( 'kemet_the_title_enabled', array( $this, 'enable_page_title_in_content' ) );
			add_action( 'kemet_featured_image_attrs', array( $this, 'kemet_single_post_featured_image_custom_attrs' ) );
		}

		/**
		 * Featured Image Custom Width and Height
		 *
		 * @param string $image image.
		 * @return string
		 */
		public function kemet_single_post_featured_image_custom_attrs( $image ) {
			if ( is_singular( 'post' ) ) {
				$single_post_featured_image_width  = kemet_get_option( 'single-post-featured-image-width' );
				$single_post_featured_image_height = kemet_get_option( 'single-post-featured-image-height' );

				$attributes = array(
					'width'  => empty( $single_post_featured_image_width ) ? false : $single_post_featured_image_width,
					'height' => empty( $single_post_featured_image_height ) ? false : $single_post_featured_image_height,
					'crop'   => ( empty( $single_post_featured_image_width ) || empty( $single_post_featured_image_height ) ) ? false : true,
				);

				if ( ! $attributes['width'] && ! $attributes['height'] ) {
					$attributes = array();
				}

				$image_id = get_post_thumbnail_id( get_the_ID(), 'full' );

				$single_post_structure = kemet_get_option( 'blog-single-post-structure' );

				if ( in_array( 'single-image', $single_post_structure ) ) {
					if ( $attributes && function_exists( 'ipq_get_theme_image' ) ) {
						$image = ipq_get_theme_image(
							$image_id,
							array(
								array( $attributes['width'], $attributes['height'], $attributes['crop'] ),
							),
							array(
								'class' => '',
							)
						);
					}
				}
			}

			return $image;
		}

		/**
		 * Single post template
		 *
		 * @return void
		 */
		public function kemet_single_post_template_loader() {
			remove_action( 'kemet_entry_content_single', 'kemet_entry_content_single_template' );
			kemetaddons_get_template( 'single-post/templates/single-post-layout.php' );
		}

		/**
		 * Body Classes
		 *
		 * @param array $classes array of body classes.
		 * @return array
		 */
		public function kemet_body_classes( $classes ) {

			$prev_next_links = kemet_get_option( 'prev-next-links' );

			if ( true == $prev_next_links ) {
				$classes[] = 'hide-nav-links';
			}
			return $classes;
		}

		/**
		 * Enable / Disable page title in content area
		 *
		 * @param boolean $default default value.
		 * @return boolean
		 */
		public function enable_page_title_in_content( $default ) {
			if ( is_single() ) {
				$default = kemet_get_option( 'enable-page-title-content-area' );
			}
			return $default;
		}

		/**
		 * Enqueues scripts and styles for single post
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
			Kemet_Style_Generator::kmt_add_css( KEMET_SINGLE_POST_DIR . 'assets/css/' . $dir . '/style' . $css_prefix );
		}
	}
}
Kemet_Addon_Single_Post_Partials::get_instance();
