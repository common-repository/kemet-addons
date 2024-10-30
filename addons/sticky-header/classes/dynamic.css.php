<?php
/**
 * Sticky Header - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_sticky_header_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css css.
 * @return string
 */
function kemet_sticky_header_dynamic_css( $dynamic_css ) {

	$global_border_color         = kemet_get_option( 'global-border-color' );
	$global_bg_color             = kemet_get_option( 'global-background-color' );
	$sticky_bg_obj               = kemet_get_option( 'sticky-bg-obj', array( 'background-color' => kemet_color_brightness( $global_bg_color, 0.99, 'dark' ) ) );
	$sticky_logo_width           = kemet_get_option( 'sticky-logo-width' );
	$sticky_menu_link_color      = kemet_get_option( 'sticky-menu-link-color' );
	$sticky_menu_link_h_color    = kemet_get_option( 'sticky-menu-link-h-color' );
	$sticky_submenu_bg_color     = kemet_get_option( 'sticky-submenu-bg-color' );
	$sticky_submenu_link_color   = kemet_get_option( 'sticky-submenu-link-color' );
	$sticky_submenu_link_h_color = kemet_get_option( 'sticky-submenu-link-h-color' );
	$sticky_border_bottom_color  = kemet_get_option( 'sticky-border-bottom-color', $global_border_color );
	$submenu_border_color        = kemet_get_option( 'sticky-submenu-border-color' );
	$space_sticky_header         = kemet_get_option( 'sticky-header-padding' );
	$site_identity_spacing       = kemet_get_option( 'sticky-site-identity-spacing' );
	$menu_link_spacing           = kemet_get_option( 'sticky-menu-item-spacing' );
	$sticky_border_width         = kemet_get_option( 'sticky-border-width' );

	$css_output = array(
		// Sticky Header.
			'.kmt-is-sticky .main-header-menu a'          => array(
				'color' => esc_attr( $sticky_menu_link_color ),
			),
		'.kmt-header-break-point .site-header.kmt-is-sticky .main-navigation ul li > a,.site-header.kmt-is-sticky .kmt-sitehead-custom-menu-items > *:not(.button),.site-header.kmt-is-sticky .main-header-menu li > a' => array(
			'padding-top'    => kemet_responsive_spacing( $menu_link_spacing, 'top', 'desktop' ),
			'padding-bottom' => kemet_responsive_spacing( $menu_link_spacing, 'bottom', 'desktop' ),
			'padding-right'  => kemet_responsive_spacing( $menu_link_spacing, 'right', 'desktop' ),
			'padding-left'   => kemet_responsive_spacing( $menu_link_spacing, 'left', 'desktop' ),
		),
		'.kmt-is-sticky .main-header-menu li:hover a,.kmt-is-sticky .main-header-menu li.current_page_item a' => array(
			'color' => esc_attr( $sticky_menu_link_h_color ),
		),
		'.kmt-is-sticky .main-header-menu .sub-menu li a' => array(
			'color' => esc_attr( $sticky_submenu_link_color ),
		),
		'.kmt-is-sticky .main-header-menu .sub-menu li:hover > a' => array(
			'color' => esc_attr( $sticky_submenu_link_h_color ),
		),
		'.kmt-is-sticky .main-header-menu ul.sub-menu'    => array(
			'background-color' => esc_attr( $sticky_submenu_bg_color ),
		),
		'#sitehead .site-logo-img .custom-logo-link.sticky-custom-logo img' => array(
			'max-width' => kemet_responsive_slider( $sticky_logo_width, 'desktop' ),
		),
		'.kmt-is-sticky .main-header-menu .sub-menu a'    => array(
			'border-bottom-color' => esc_attr( $submenu_border_color ),
		),
		'.kmt-is-sticky.header-main-layout-4 .main-header-container.logo-menu-icon , .kmt-is-sticky .main-header-bar' => array(
			'border-bottom-color' => esc_attr( $sticky_border_bottom_color ),
			'border-bottom-width' => kemet_responsive_slider( $sticky_border_width, 'desktop' ),
		),
		'.kmt-is-sticky .main-header-bar'                 => array(
			'padding-top'    => kemet_responsive_spacing( $space_sticky_header, 'top', 'desktop' ),
			'padding-bottom' => kemet_responsive_spacing( $space_sticky_header, 'bottom', 'desktop' ),
			'padding-right'  => kemet_responsive_spacing( $space_sticky_header, 'right', 'desktop' ),
			'padding-left'   => kemet_responsive_spacing( $space_sticky_header, 'left', 'desktop' ),
		),
		/* Site Identity Spacing */
		'#sitehead.site-header.kmt-is-sticky .kmt-site-identity' => array(
			'padding-top'    => kemet_responsive_spacing( $site_identity_spacing, 'top', 'desktop' ),
			'padding-right'  => kemet_responsive_spacing( $site_identity_spacing, 'right', 'desktop' ),
			'padding-bottom' => kemet_responsive_spacing( $site_identity_spacing, 'bottom', 'desktop' ),
			'padding-left'   => kemet_responsive_spacing( $site_identity_spacing, 'left', 'desktop' ),
		),
	);

	$parse_css = kemet_parse_css( $css_output );

	$parse_css .= kemet_get_background_obj( '.site-header.kmt-is-sticky .main-header-bar', $sticky_bg_obj );

	$css_tablet = array(
		'#sitehead .site-logo-img .custom-logo-link.sticky-custom-logo img' => array(
			'max-width' => kemet_responsive_slider( $sticky_logo_width, 'tablet' ),
		),
		'.kmt-is-sticky .main-header-bar' => array(
			'padding-top'    => kemet_responsive_spacing( $space_sticky_header, 'top', 'tablet' ),
			'padding-bottom' => kemet_responsive_spacing( $space_sticky_header, 'bottom', 'tablet' ),
			'padding-right'  => kemet_responsive_spacing( $space_sticky_header, 'right', 'tablet' ),
			'padding-left'   => kemet_responsive_spacing( $space_sticky_header, 'left', 'tablet' ),
		),
		/* Site Identity Spacing */
		'#sitehead.site-header.kmt-is-sticky .kmt-site-identity' => array(
			'padding-top'    => kemet_responsive_spacing( $site_identity_spacing, 'top', 'tablet' ),
			'padding-right'  => kemet_responsive_spacing( $site_identity_spacing, 'right', 'tablet' ),
			'padding-bottom' => kemet_responsive_spacing( $site_identity_spacing, 'bottom', 'tablet' ),
			'padding-left'   => kemet_responsive_spacing( $site_identity_spacing, 'left', 'tablet' ),
		),
		'.kmt-header-break-point .site-header.kmt-is-sticky .main-navigation ul li > a,.site-header.kmt-is-sticky .kmt-sitehead-custom-menu-items > *:not(.button),.site-header.kmt-is-sticky .main-header-menu li > a' => array(
			'padding-top'    => kemet_responsive_spacing( $menu_link_spacing, 'top', 'tablet' ),
			'padding-bottom' => kemet_responsive_spacing( $menu_link_spacing, 'bottom', 'tablet' ),
			'padding-right'  => kemet_responsive_spacing( $menu_link_spacing, 'right', 'tablet' ),
			'padding-left'   => kemet_responsive_spacing( $menu_link_spacing, 'left', 'tablet' ),
		),
		'.kmt-is-sticky.header-main-layout-4 .main-header-container.logo-menu-icon , .kmt-is-sticky .main-header-bar' => array(
			'border-bottom-color' => esc_attr( $sticky_border_bottom_color ),
			'border-bottom-width' => kemet_responsive_slider( $sticky_border_width, 'tablet' ),
		),
	);
	$parse_css .= kemet_parse_css( $css_tablet, '', '768' );

	$css_mobile = array(
		'#sitehead .site-logo-img .custom-logo-link.sticky-custom-logo img' => array(
			'max-width' => kemet_responsive_slider( $sticky_logo_width, 'mobile' ),
		),
		'.kmt-is-sticky .main-header-bar' => array(
			'padding-top'    => kemet_responsive_spacing( $space_sticky_header, 'top', 'mobile' ),
			'padding-bottom' => kemet_responsive_spacing( $space_sticky_header, 'bottom', 'mobile' ),
			'padding-right'  => kemet_responsive_spacing( $space_sticky_header, 'right', 'mobile' ),
			'padding-left'   => kemet_responsive_spacing( $space_sticky_header, 'left', 'mobile' ),
		),
		/* Site Identity Spacing */
		'#sitehead.site-header.kmt-is-sticky .kmt-site-identity' => array(
			'padding-top'    => kemet_responsive_spacing( $site_identity_spacing, 'top', 'mobile' ),
			'padding-right'  => kemet_responsive_spacing( $site_identity_spacing, 'right', 'mobile' ),
			'padding-bottom' => kemet_responsive_spacing( $site_identity_spacing, 'bottom', 'mobile' ),
			'padding-left'   => kemet_responsive_spacing( $site_identity_spacing, 'left', 'mobile' ),
		),
		'.kmt-header-break-point .site-header.kmt-is-sticky .main-navigation ul li > a,.site-header.kmt-is-sticky .kmt-sitehead-custom-menu-items > *:not(.button),.site-header.kmt-is-sticky .main-header-menu li > a' => array(
			'padding-top'    => kemet_responsive_spacing( $menu_link_spacing, 'top', 'mobile' ),
			'padding-bottom' => kemet_responsive_spacing( $menu_link_spacing, 'bottom', 'mobile' ),
			'padding-right'  => kemet_responsive_spacing( $menu_link_spacing, 'right', 'mobile' ),
			'padding-left'   => kemet_responsive_spacing( $menu_link_spacing, 'left', 'mobile' ),
		),
		'.kmt-is-sticky.header-main-layout-4 .main-header-container.logo-menu-icon , .kmt-is-sticky .main-header-bar' => array(
			'border-bottom-color' => esc_attr( $sticky_border_bottom_color ),
			'border-bottom-width' => kemet_responsive_slider( $sticky_border_width, 'mobile' ),
		),
	);

	$parse_css .= kemet_parse_css( $css_mobile, '', '544' );

	$sticky_header_box_shadow = kemet_get_option( 'sticky-header-box-shadow' );

	if ( $sticky_header_box_shadow ) {
		$box_shadow_css = array(
			'.site-header.kmt-is-sticky' => array(
				'box-shadow' => esc_attr( '0px 2px 5px rgba(0,0,0,0.1)' ),
			),
		);
		$parse_css     .= kemet_parse_css( $box_shadow_css );
	}

	return $dynamic_css . $parse_css;
}
