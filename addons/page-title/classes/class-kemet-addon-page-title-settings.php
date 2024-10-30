<?php
/**
 * Page Title Section
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Page_Title_Settings' ) ) {

	/**
	 * Page Title Section
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Page_Title_Settings {

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
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );
		}

		/**
		 * Go top customizer section
		 *
		 * @param object $wp_customize wp_customize.
		 * @return void
		 */
		public function customize_register( $wp_customize ) {
			// Update the Customizer Sections under Layout.
			$wp_customize->add_section(
				new Kemet_WP_Customize_Section(
					$wp_customize,
					'section-page-title-header',
					array(
						'title'    => __( 'Page Title', 'kemet-addons' ),
						'panel'    => 'panel-layout',
						'section'  => 'section-header-group',
						'priority' => 45,
					)
				)
			);

			$wp_customize->add_section(
				new Kemet_WP_Customize_Section(
					$wp_customize,
					'section-breadcrumbs',
					array(
						'title'    => __( 'Breadcrumbs', 'kemet-addons' ),
						'panel'    => 'panel-layout',
						'section'  => 'section-header-group',
						'priority' => 50,
					)
				)
			);
			require_once KEMET_PAGE_TITLE_DIR . 'customizer/customizer-options.php';
		}

		/**
		 * Customizer options default values
		 *
		 * @param object $defaults object of default values.
		 * @return object
		 */
		public function theme_defaults( $defaults ) {
			// Page title Options.
			$defaults['page-title-layouts']          = 'page-title-layout-1';
			$defaults['page_title_alignment']        = 'center';
			$defaults['page-title-bg-obj']           = '';
			$defaults['merge-with-header']           = false;
			$defaults['page-title-space']            = '';
			$defaults['page-title-color']            = '';
			$defaults['page-title-font-size']        = '';
			$defaults['page-title-letter-spacing']   = '';
			$defaults['page-title-font-family']      = 'inherit';
			$defaults['page-title-font-weight']      = 'inherit';
			$defaults['pagetitle-text-transform']    = '';
			$defaults['pagetitle-font-style']        = 'inherit';
			$defaults['pagetitle-line-height']       = '';
			$defaults['page-title-responsive']       = 'all-devices';
			$defaults['pagetitle-bottomline-height'] = '';
			$defaults['pagetitle-bottomline-width']  = 150;
			$defaults['pagetitle-bottomline-color']  = '';
			$defaults['sub-title-color']             = '';
			$defaults['sub-title-font-size']         = '';
			$defaults['sub-title-letter-spacing']    = '';
			$defaults['sub-title-font-family']       = 'inherit';
			$defaults['sub-title-font-weight']       = 'inherit';
			$defaults['sub-title-text-transform']    = '';
			$defaults['sub-title-line-height']       = '';
			// Breadcrumbs Defaults.
			$defaults['show-item-title']                    = true;
			$defaults['breadcrumb-separator']               = '»';
			$defaults['breadcrumb-prefix']                  = '';
			$defaults['breadcrumbs-font-size']              = '';
			$defaults['breadcrumbs-letter-spacing']         = '';
			$defaults['breadcrumbs-font-family']            = 'inherit';
			$defaults['breadcrumbs-font-weight']            = 'inherit';
			$defaults['breadcrumbs-text-transform']         = '';
			$defaults['breadcrumbs-line-height']            = '';
			$defaults['breadcrumb-home-item']               = 'text';
			$defaults['disable-breadcrumbs-in-archive']     = false;
			$defaults['disable-breadcrumbs-in-single-page'] = false;
			$defaults['disable-breadcrumbs-in-single-post'] = false;
			$defaults['disable-breadcrumbs-in-404-page']    = false;
			$defaults['breadcrumb-posts-taxonomy']          = 'category';
			$defaults['breadcrumbs-space']                  = '';
			$defaults['breadcrumbs-color']                  = '';
			$defaults['breadcrumbs-link-color']             = '';
			$defaults['breadcrumbs-link-h-color']           = '';
			$defaults['page-title-border-right-color']      = '';
			$defaults['breadcrumbs-enabled']                = true;
			return $defaults;
		}

		/**
		 * Admin Scripts
		 *
		 * @return void
		 */
		public function preview_scripts() {
			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-pagetitle-customize-preview-js', KEMET_PAGE_TITLE_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );
			} else {
				wp_enqueue_script( 'kemet-pagetitle-customize-preview-js', KEMET_PAGE_TITLE_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true );         }
		}


	}
}
Kemet_Addon_Page_Title_Settings::get_instance();
