<?php
/**
 * Functions
 *
 * @package Kemet Addons
 */

/**
 * Locate template.
 *
 * Locate the called template.
 * Search Order:
 * 1. /themes/theme/templates/$template_name
 * 2. /themes/theme/$template_name
 * 3. /plugins/kemet-addons/addons/
 *
 * @since 1.0.0
 *
 * @param   string $template_name          Template to load.
 * @param   string $template_path  Path to templates.
 * @param   string $default_path           Default path to template files.
 * @return  string                          Path to the template file.
 */
function kemetaddons_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	// Set variable to search in the templates folder of theme.
	if ( ! $template_path ) :
		$template_path = KEMET_ADDONS_DIR . 'addons/';
	endif;
	// Set default plugin templates path.
	if ( ! $default_path ) :
		$default_path = KEMET_ADDONS_DIR . 'addons/'; // Path to the template folder.
	endif;
	// Search template file in theme folder.
	$template = locate_template(
		array(
			$template_path . $template_name,
			$template_name,
		)
	);
	// Get plugins template file.
	if ( ! $template ) :
		$template = $default_path . $template_name;
	endif;
	return apply_filters( 'kemetaddons_locate_template', $template, $template_name, $template_path, $default_path );
}

/**
 * Get template.
 *
 * Search for the template and include the file.
 *
 * @since 1.0.0
 *
 * @see PLUGIN_locate_template()
 *
 * @param string $template_name Template to load.
 * @param array  $args Args passed for the template file.
 * @param string $tempate_path $template_path Path to templates.
 * @param string $default_path Default path to template files.
 */
function kemetaddons_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {
	if ( is_array( $args ) && isset( $args ) ) :
		extract( $args ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
	endif;
	$template_file = kemetaddons_locate_template( $template_name, $tempate_path, $default_path );
	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return;
	endif;
	include $template_file;
}


/*
* Get Panel Option
*
*/
if ( ! function_exists( 'kemet_get_integration' ) ) {

	/**
	 * Mailchimp integration
	 *
	 * @param string $option options.
	 * @param string $default default value.
	 * @return string
	 */
	function kemet_get_integration( $option = '', $default = null ) {
		$options = get_option( 'kemet_addons_integration' ); // Attention: Set your unique id of the framework.
		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
	}
}
