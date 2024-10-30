<?php
/**
 * Export Customizer Settings
 *
 * @package Kemet Addons
 */

/**
 *  Kemet Customizer Export
 */
class Kemet_Addon_Export {

	/**
	 * An instance of WP_Customize_Manager.
	 *
	 * @access private
	 * @var object $wp_customize
	 */
	private $wp_customize;

	/**
	 * Class constructor
	 *
	 * @param object $wp_customize `WP_Customize_Manager` instance.
	 */
	public function __construct( $wp_customize = null ) {
		$this->wp_customize = $wp_customize;
	}

	/**
	 * Export the customizer.
	 */
	public function export() {
		$theme         = get_stylesheet();
		$mods          = get_theme_mods();
		$charset       = get_option( 'blog_charset' );
		$theme_options = array(
			'template' => $theme,
			'mods'     => $mods ? $mods : array(),
			'options'  => array(),
		);

		$theme_options['site-icon']           = get_option( 'site_icon' );
		$theme_options['customizer-settings'] = Kemet_Theme_Options::get_options();
		if ( function_exists( 'wp_get_custom_css_post' ) ) {
			$theme_options['wp_css'] = wp_get_custom_css();
		}

		nocache_headers();
		// Set the download headers.
		header( 'Content-disposition: attachment; filename=customizer-export-of-' . $theme . '.json' );
		header( 'Content-Type: application/octet-stream; charset=' . $charset );

		// Output the export data.
		echo wp_json_encode( $theme_options );

		// Start the download.
		exit;

	}
}
