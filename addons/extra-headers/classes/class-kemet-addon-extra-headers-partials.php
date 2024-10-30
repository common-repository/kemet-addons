<?php
/**
 * Extra Headers
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Extra_Headers_Partials' ) ) {
	/**
	 * Extra Headers Settings
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Extra_Headers_Partials {

		/**
		 * Member Variable
		 *
		 * @var object instance
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
		 *  Constructor
		 */
		public function __construct() {

			add_filter( 'body_class', array( $this, 'kemet_body_classes' ) );
			add_action( 'kemet_sitehead', array( $this, 'sitehead_markup_loader' ), 1 );
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			add_filter( 'kemet_header_class', array( $this, 'header_classes' ), 10, 1 );
			add_action( 'kemet_before_top_bar', array( $this, 'header_with_top_bar' ) );
			add_action( 'kemet_after_main_header', array( $this, 'after_main_header' ) );
			add_filter( 'header_container_classes', array( $this, 'kemet_header_container' ) );
		}

		/**
		 * Kemet Header Container Classes
		 *
		 * @param array $classes header container classes.
		 * @return array
		 */
		public function kemet_header_container( $classes ) {
			$header_width        = apply_filters( 'kemet_header_width', kemet_get_option( 'header-main-layout-width' ) );
			$kemet_header_layout = kemet_get_option( 'header-layouts' );
			$kemet_header_layout = apply_filters( 'kemet_primary_header_layout', $kemet_header_layout );

			if ( 'boxed' == $header_width ) {
				$classes[] = 'main-header-content';
			} elseif ( 'stretched' == $header_width && 'header-main-layout-3' != $kemet_header_layout ) {
				$classes[] = 'main-header-content';
			}

			return $classes;
		}

		/**
		 * Header markup loader
		 *
		 * @return void
		 */
		public function html_markup_loader() {
			?>

			<header itemtype="https://schema.org/WPHeader" itemscope="itemscope" id="sitehead" <?php kemet_header_classes(); ?> role="banner">

				<?php kemet_sitehead_top(); ?>

				<?php kemet_sitehead(); ?>

				<?php kemet_sitehead_bottom(); ?>

			</header><!-- #sitehead -->
			<?php
		}

		/**
		 * Header markup loader
		 *
		 * @return void
		 */
		public function sitehead_markup_loader() {

			$kemet_header_layout = kemet_get_option( 'header-layouts' );
			$kemet_header_layout = apply_filters( 'kemet_primary_header_layout', $kemet_header_layout );
			$options             = get_option( 'kemet_addons_options' );

			if ( 'disable' !== $kemet_header_layout ) {
				if ( 'header-main-layout-1' !== $kemet_header_layout && 'header-main-layout-2' !== $kemet_header_layout && 'header-main-layout-3' !== $kemet_header_layout ) {
					add_action( 'kemet_header', array( $this, 'html_markup_loader' ) );
					remove_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' );
					kemetaddons_get_template( 'extra-headers/templates/' . esc_attr( $kemet_header_layout ) . '.php' );

				} elseif ( 1 !== ( $options['extra-headers'] ) ) {
					add_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' );
				}
			}
		}

		/**
		 * Header with top bar
		 *
		 * @return void
		 */
		public function header_with_top_bar() {
			$merge_top_bar_with_header = apply_filters( 'kemet_addons_merge_top_bar_with_header', kemet_get_option( 'merge-top-bar-header' ) );
			$kemet_header_layout       = apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );
			$unsupported_headers       = array( 'header-main-layout-5', 'header-main-layout-6', 'header-main-layout-7' );
			if ( $merge_top_bar_with_header && ( ! empty( kemet_get_option( 'top-section-1' ) ) || ! empty( kemet_get_option( 'top-section-2' ) ) ) && ! in_array( $kemet_header_layout, $unsupported_headers ) ) {
				$combined = 'kemet-merged-top-bar-header';
				printf(
					'<div class="%1$s">',
					esc_attr( $combined )
				);
			}
		}

		/**
		 * Header with top bar
		 *
		 * @return void
		 */
		public function after_main_header() {
			$kemet_header_layout       = apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );
			$unsupported_headers       = array( 'header-main-layout-5', 'header-main-layout-6', 'header-main-layout-7' );
			$merge_top_bar_with_header = apply_filters( 'kemet_addons_merge_top_bar_with_header', kemet_get_option( 'merge-top-bar-header' ) );
			if ( $merge_top_bar_with_header && ( ! empty( kemet_get_option( 'top-section-1' ) ) || ! empty( kemet_get_option( 'top-section-2' ) ) ) && ! in_array( $kemet_header_layout, $unsupported_headers ) ) {
				echo '</div><!-- .kemet-merged-top-bar-header -->';
			}

		}

		/**
		 * Body classes
		 *
		 * @param array $classes array of body classes.
		 * @return array
		 */
		public function kemet_body_classes( $classes ) {
			$kemet_header_layout = apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );
			$meta                = get_post_meta( get_the_ID(), 'kemet_page_options', true );

			if ( 'header-main-layout-5' == $kemet_header_layout ) {

				$classes[] = 'header-main-layout-5';
				$classes[] = 'kemet-main-v-header-align-' . kemet_get_option( 'v-headers-position' );
			}
			if ( 'header-main-layout-7' == $kemet_header_layout ) {

				$classes[] = 'header-main-layout-7';
				$classes[] = 'kemet-main-v-header-align-' . kemet_get_option( 'v-headers-position' );
			}
			if ( is_singular() ) {
				if ( isset( $meta['kemet-main-header-display'] ) && '1' == $meta['kemet-main-header-display'] ) {
					$header_align_class = 'kemet-main-v-header-align-' . kemet_get_option( 'v-headers-position' );
					if ( in_array( $header_align_class, $classes ) ) {
						$align_header = array_search( $header_align_class, $classes );
						unset( $classes[ $align_header ] );
					}
				}
			}

			$header_transparent = kemet_get_option( 'enable-transparent' ) ? 'enable' : 'disable';
			$header_transparent = apply_filters( 'kemet_trnsparent_header', $header_transparent );
			$top_bar_enable     = apply_filters( 'kemet_top_bar_enabled', true );
			$top_bar_1          = kemet_get_option( 'top-section-1' );
			$top_bar_2          = kemet_get_option( 'top-section-2' );

			if ( 'enable' == $header_transparent && $top_bar_enable && ( ! empty( $top_bar_1 ) || ! empty( $top_bar_2 ) ) ) {
				$classes[] = 'merged-header-transparent';
			} elseif ( 'enable' == $header_transparent && ( ! $top_bar_enable || ( empty( $top_bar_1 ) && empty( $top_bar_2 ) ) ) ) {
				$classes[] = 'header-transparent';
			}

			return $classes;
		}

		/**
		 * Header classes
		 *
		 * @param array $classes array of classes.
		 * @return array
		 */
		public function header_classes( $classes ) {
			$header_transparent = kemet_get_option( 'enable-transparent' );
			if ( $header_transparent ) {
				$classes[] = 'kmt-header-transparent';
			}

			$meta                   = get_post_meta( get_the_ID(), 'kemet_page_options', true );
			$kemet_header_layout    = apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );
			$vheader_has_box_shadow = kemet_get_option( 'vheader-box-shadow' );
			if ( 'header-main-layout-7' == $kemet_header_layout || 'header-main-layout-5' == $kemet_header_layout || 'header-main-layout-6' == $kemet_header_layout ) {
				if ( in_array( 'kmt-header-transparent', $classes ) ) {
					$overlay_enabled = array_search( 'kmt-header-transparent', $classes );
					unset( $classes[ $overlay_enabled ] );
				}
			}
			if ( 'header-main-layout-7' == $kemet_header_layout ) {
				if ( true == $vheader_has_box_shadow ) {
					$classes[] = 'has-box-shadow';
				}
				$classes[] = 'v-header-align-' . kemet_get_option( 'v-headers-position' );
			}
			if ( 'header-main-layout-5' == $kemet_header_layout ) {

				if ( true == $vheader_has_box_shadow ) {
					$classes[] = 'has-box-shadow';
				}

				$classes[] = 'v-header-align-' . kemet_get_option( 'v-headers-position' );
			}
			if ( is_singular() ) {
				if ( isset( $meta['kemet-main-header-display'] ) && '1' == $meta['kemet-main-header-display'] ) {
					$header_align_class = 'v-header-align-' . kemet_get_option( 'v-headers-position' );
					if ( in_array( $header_align_class, $classes ) ) {
						$align_header = array_search( $header_align_class, $classes );
						unset( $classes[ $align_header ] );
					}
				}
			}

			$kemet_header_content_width = apply_filters( 'kemet_header_width', kemet_get_option( 'header-main-layout-width' ) );
			$classes[]                  = 'header-' . $kemet_header_content_width . '-width';
			return $classes;
		}

		/**
		 * Styles for the header layouts.
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

			Kemet_Style_Generator::kmt_add_css( KEMET_EXTRA_HEADERS_DIR . 'assets/css/' . $dir . '/extra-header-layouts' . $css_prefix );
			Kemet_Style_Generator::kmt_add_css( KEMET_EXTRA_HEADERS_DIR . 'assets/css/minified/simple-scrollbar.min.css' );
		}

		/**
		 * Scripts for the header layouts.
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

			Kemet_Style_Generator::kmt_add_js( KEMET_EXTRA_HEADERS_DIR . 'assets/js/' . $dir . '/extra-header-layouts' . $js_prefix );
			Kemet_Style_Generator::kmt_add_js( KEMET_EXTRA_HEADERS_DIR . 'assets/js/minified/simple-scrollbar.min.js' );

		}
	}
}
Kemet_Addon_Extra_Headers_Partials::get_instance();
