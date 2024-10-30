<?php
/**
 * Panel_Options_Tab
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Panel_System_Tab' ) ) {

	/**
	 * Kemet Panel
	 *
	 * @since 1.0.0
	 */
	class Kemet_Panel_System_Tab {

		/**
		 * Member Variable
		 *
		 * @var object instance
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
		 * Render system information tab html
		 *
		 * @return void
		 */
		public function render_html() {
			?>
		<table class="widefat" cellspacing="0">
			<thead>
				<tr>
					<th colspan="2"><?php esc_html_e( 'WordPress Environment', 'kemet-addons' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php esc_html_e( 'Home URL', 'kemet-addons' ); ?>:</td>
					<td><?php form_option( 'home' ); ?></td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'Site URL', 'kemet-addons' ); ?>:</td>
					<td><?php form_option( 'siteurl' ); ?></td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'WP Version', 'kemet-addons' ); ?>:</td>
					<td><?php bloginfo( 'version' ); ?></td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'WP Multisite', 'kemet-addons' ); ?>:</td>
					<td>
					<?php
					if ( is_multisite() ) {
						echo '&#10004;';
					} else {
						echo '&ndash;';
					}
					?>
						</td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'WP Memory Limit', 'kemet-addons' ); ?>:</td>
					<td>
					<?php
						$memory_limit = wp_convert_hr_to_bytes( WP_MEMORY_LIMIT );
					if ( $memory_limit < 67108864 ) {
						echo sprintf(
							wp_kses(
								'<mark>%s - %s</mark>',
								kemet_allowed_html( array( 'mark' ) )
							),
							esc_html( size_format( $memory_limit ) ),
							esc_html__( 'We recommend setting wp memory at least 64MB.', 'kemet-addons' )
						);
					} else {
						echo esc_html( size_format( $memory_limit ) );
					}
					?>
				</td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'Theme Version', 'kemet-addons' ); ?>:</td>
					<td><?php echo esc_html( KEMET_THEME_VERSION ); ?></td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'WP Path', 'kemet-addons' ); ?>:</td>
					<td><?php echo esc_html( ABSPATH ); ?></td>
				</tr>


				<tr>
					<td><?php esc_html_e( 'WP Debug Mode', 'kemet-addons' ); ?>:</td>
					<td>
						<?php
						if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
							echo esc_html( '&#10004;' );
						} else {
							echo esc_html( '&ndash;' );
						}
						?>
					</td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'Language', 'kemet-addons' ); ?>:</td>
					<td><?php echo esc_html( get_locale() ); ?></td>
				</tr>
			</tbody>
		</table>
		<br>
		<table class="widefat" cellspacing="0">
			<thead>
				<tr>
					<th colspan="2" data-export-label="Server Environment"><?php esc_html_e( 'Server Environment', 'kemet-addons' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php esc_html_e( 'Server Info', 'kemet-addons' ); ?>:</td>
					<td><?php echo isset( $_SERVER['SERVER_SOFTWARE'] ) ? esc_html( sanitize_text_field( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ) ) : ''; ?></td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'PHP Version', 'kemet-addons' ); ?>:</td>
					<td>
					<?php
						// Check if phpversion function exists.
					if ( function_exists( 'phpversion' ) ) {
						$php_version = phpversion();

						echo esc_html( $php_version );
					} else {
						esc_html_e( "Couldn't determine PHP version because phpversion() doesn't exist.", 'kemet-addons' );
					}
					?>
						</td>
				</tr>
				<?php if ( function_exists( 'ini_get' ) ) : ?>
					<tr>
						<td><?php esc_html_e( 'PHP Memory Limit', 'kemet-addons' ); ?>:</td>
						<td><?php echo esc_html( size_format( wp_convert_hr_to_bytes( ini_get( 'memory_limit' ) ) ) ); ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'PHP Post Max Size', 'kemet-addons' ); ?>:</td>
						<td><?php echo esc_html( size_format( wp_convert_hr_to_bytes( ini_get( 'post_max_size' ) ) ) ); ?></td>
					</tr>
					<tr>
						<td ><?php esc_html_e( 'PHP Time Limit', 'kemet-addons' ); ?>:</td>
						<td>
							<?php
							$time_limit = ini_get( 'max_execution_time' );
							if ( $time_limit < 60 && 0 != $time_limit ) {
								echo sprintf(
									wp_kses(
										'<mark>%s - %s</mark>',
										kemet_allowed_html( array( 'mark' ) )
									),
									esc_html( $time_limit ),
									esc_html__( 'We recommend setting max execution time at least 60.', 'kemet-addons' )
								);
							} else {
								echo esc_html( $time_limit );
							}
							?>
						</td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'PHP Max Input Vars', 'kemet-addons' ); ?>:</td>
						<td><?php echo esc_html( ini_get( 'max_input_vars' ) ); ?></td>
					</tr>
					<tr>
						<td ><?php esc_html_e( 'SUHOSIN Installed', 'kemet-addons' ); ?>:</td>
						<td><?php echo extension_loaded( 'suhosin' ) ? esc_html( '&#10004;' ) : esc_html( '&ndash;' ); ?></td>
					</tr>
				<?php endif; ?>
				<tr>
					<td><?php esc_html_e( 'MySQL Version', 'kemet-addons' ); ?>:</td>
					<td>
						<?php
						global $wpdb;
						echo esc_html( $wpdb->db_version() );
						?>
					</td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'Max Upload Size', 'kemet-addons' ); ?>:</td>
				<td><?php echo esc_html( size_format( wp_max_upload_size() ) ); ?></td>
				</tr>
				</tbody>
		</table>
		<br>
		<table class="widefat" cellspacing="0">
			<thead>
				<tr>
					<th colspan="2"><?php esc_html_e( 'Active Plugins', 'kemet-addons' ); ?> (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$active_plugins = (array) get_option( 'active_plugins', array() );

				if ( is_multisite() ) {
					$network_activated_plugins = array_keys( get_site_option( 'active_sitewide_plugins', array() ) );
					$active_plugins            = array_merge( $active_plugins, $network_activated_plugins );
				}

				foreach ( $active_plugins as $plugin ) {
					$plugin_data    = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
					$dirname        = dirname( $plugin );
					$version_string = '';
					$network_string = '';

					if ( ! empty( $plugin_data['Name'] ) ) {

						// link the plugin name to the plugin url if available.
						$plugin_name = esc_html( $plugin_data['Name'] );

						if ( ! empty( $plugin_data['PluginURI'] ) ) {
							$plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . esc_html__( 'Visit plugin homepage', 'kemet-addons' ) . '" target="_blank">' . $plugin_name . '</a>';
						}
						?>
						<tr>
							<td>
							<?php
								echo wp_kses(
									$plugin_name,
									kemet_allowed_html( array( 'a' ) )
								);
							?>
							</td>
							<td>
							<?php
								echo sprintf(
									wp_kses(
										esc_html__( 'by', 'kemet-addons' ) . ' ' . $plugin_data['Author'] . esc_html( ' &ndash; ' ) . esc_html( $plugin_data['Version'] ) . $version_string . $network_string,
										kemet_allowed_html( array( 'a' ) )
									)
								);
							?>
							</td>
						</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>
			<?php
		}
	}
}
