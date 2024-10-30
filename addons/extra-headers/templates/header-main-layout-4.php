<?php
/**
 * Header 4 Layout
 *
 * @package Kemet Addons
 */

$icon_label = trim( apply_filters( 'icon_header_label', kemet_get_option( 'header-icon-label' ) ) );
$classes    = apply_filters( 'header_container_classes', array() );
?>
<?php do_action( 'kemet_before_main_header' ); ?>
<div class="main-header-bar-wrap">
	<div class="main-header-bar">
		<?php kemet_main_header_bar_top(); ?>
		<div class="header-logo-menu-icon">
				<div class="kmt-navbar-collapse">
				<?php kemet_primary_navigation_markup(); ?>
				</div>
				<div class="main-header-container logo-menu-icon">
				<div class="kmt-container">   
				<div class="mobile-icon-logo <?php echo esc_attr( implode( ' ', $classes ) ); ?>">   
				<?php kemet_site_branding_markup(); ?> 
				<?php kemet_toggle_buttons_markup(); ?>
				<div class="icon-last-menu-items">
					<?php echo kemet_header_custom_item_outside_menu(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<div class ="menu-icon-social">
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
					</div>
				</div>
				</div>
			</div>
		</div><!-- Header Layout 4 -->
		<?php kemet_main_header_bar_bottom(); ?>
	</div> 
</div>
<?php do_action( 'kemet_after_main_header' ); ?>
