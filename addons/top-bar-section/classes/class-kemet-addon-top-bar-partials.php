<?php
/**
 * Top Bar Section
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Top_Bar_Partials' ) ) {

	/**
	 * Top Bar Partials
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Top_Bar_Partials {

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
		 *  Constructor
		 */
		public function __construct() {
			add_action( 'kemet_sitehead_top', array( $this, 'kemet_top_header_template' ), 9 );
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'widgets_init', array( $this, 'kemet_addons_top_bar_widgets_init' ) );
		}

		/**
		 * Register widget area.
		 *
		 * @see https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function kemet_addons_top_bar_widgets_init() {

			/**
			 * Register Top Section1 Widget
			 */
			register_sidebar(
				apply_filters(
					'kemet_top_widget_sectio1',
					array(
						'name'          => esc_html__( 'Top Bar Section 1', 'kemet-addons' ),
						'id'            => 'top-widget-section1',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="widget-head"><div class="title"><h4 class="widget-title">',
						'after_title'   => '</h4></div></div>',
					)
				)
			);

			/**
			 * Register Top Section2 Widget
			 */
			register_sidebar(
				apply_filters(
					'kemet_top_widget_sectio2',
					array(
						'name'          => esc_html__( 'Top Bar Section 2', 'kemet-addons' ),
						'id'            => 'top-widget-section2',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="widget-head"><div class="title"><h4 class="widget-title">',
						'after_title'   => '</h4></div></div>',
					)
				)
			);
		}

		/**
		 * Top bar template
		 *
		 * @return void
		 */
		public function kemet_top_header_template() {

			if ( apply_filters( 'kemet_top_bar_enabled', true ) ) {
				kemetaddons_get_template( 'top-bar-section/templates/topbar-layout.php' );
			}
		}

		/**
		 * Enqueues styles for top bar
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
			Kemet_Style_Generator::kmt_add_css( KEMET_TOPBAR_DIR . 'assets/css/' . $dir . '/style' . $css_prefix );
		}
	}
}
Kemet_Addon_Top_Bar_Partials::get_instance();
