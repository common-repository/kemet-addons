<?php
/**
 * Template for displaying customizer import form.
 *
 * @package Customizer_Reset
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

ob_start();
?>
<form action = '' method = 'post' class = 'customizer-import-form border-box' enctype = 'multipart/form-data'>
	<div class = 'postbox'>
		<h3><span class = 'dashicons dashicons-upload'></span>
		<?php
			esc_html_e( 'Import Kemet Customizer Options', 'kemet-addons' );
		?>
		</h3>
		<div class = 'inside'>
			<form method = 'post' enctype = 'multipart/form-data'>
				<div class = 'right-content'>
					<p><?php esc_html_e( 'Select JSON file to import.', 'kemet-addons' ); ?></p>
					<input type = 'file' name = 'import_file'/>
					<input type = 'hidden' name = 'kemet_ie_action' value = 'import_settings' />
					<?php wp_nonce_field( 'kemet_import_nonce', 'kemet_import_nonce' ); ?>
					</div>
					<div class = 'left-content'>
					<button class = 'button button-primary'>
					<?php
						esc_html_e( 'Import', 'kemet-addons' );
					?>
					</button>
				</div>
			</form>
			<span class = 'close dashicons dashicons-no-alt'></span>
		</div>
	</div>
</form>

<?php
$customizer_import_form = ob_get_clean();
