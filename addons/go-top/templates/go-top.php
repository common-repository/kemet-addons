<?php
/**
 * Template for Go Top Template
 *
 * @package Kemet Addons
 */

$gotop_responsive = kemet_get_option( 'go-top-responsive' );
?>
<div class="kmt-go-top-container <?php echo esc_attr( $gotop_responsive ); ?>">
	<button class="kmt-go-top-link" id="kmt-go-top">
		<span><?php esc_html_e( 'Go Top', 'kemet-addons' ); ?></span>
	</button>
</div> 
