<?php
/**
 * Plugin Name: Kemet Addons
 * Plugin URI: https://kemet.io
 * Description: This Plugin for Kemet Theme
 * Version: 1.1.21
 * Author: Leap13
 * Author URI: https://leap13.com
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: kemet-addons
 * Domain Path: /languages
 * License: GNU General Public License v3.0.
 *
 * @package Kemet Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( 'kemet' !== get_template() ) {
	return;
}

/*
 * Set constants.
 */
define( 'KEMET_ADDONS_FILE', __FILE__ );
define( 'KEMET_ADDONS_BASE', plugin_basename( KEMET_ADDONS_FILE ) );
define( 'KEMET_ADDONS_VERSION', '1.1.21' );
define( 'KEMET_ADDONS_URL', plugins_url( '/', KEMET_ADDONS_FILE ) );
define( 'KEMET_ADDONS_DIR', plugin_dir_path( KEMET_ADDONS_FILE ) );

/*
 * Main Kemet Addons
 */
require_once KEMET_ADDONS_DIR . 'classes/class-kemet-addons.php';
