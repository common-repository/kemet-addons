<?php
/**
 * Header 6 Layout
 *
 * @package Kemet Addons
 */

$icon_label = trim( apply_filters( 'icon_header_label', kemet_get_option( 'header-icon-label' ) ) );
?>
<?php do_action( 'kemet_before_main_header' ); ?>
<?php kemet_main_header_bar_top(); ?>
<div class="main-header-bar-wrap">
	<?php kemet_site_branding_markup(); ?>
	<div class="menu-icon-social">
		<?php if ( ! empty( $icon_label ) ) { ?>
			<span class="header-icon-label"><?php echo esc_html( $icon_label ); ?></span>
		<?php } ?>
		<div class="menu-icon">
			<a id="nav-icon" class="icon-bars-btn">
				<span></span>
				<span></span>
				<span></span>
			</a>   
		</div> 
	</div>
	<div class="main-header-bar ss-content">
		<div class="kmt-flex main-header-container">
			<?php kemet_toggle_buttons_markup(); ?>
			<?php kemet_primary_navigation_markup(); ?>
			<?php echo kemet_header_custom_item_outside_menu(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>    
	<?php kemet_main_header_bar_bottom(); ?>
</div>
<?php do_action( 'kemet_after_main_header' ); ?>
