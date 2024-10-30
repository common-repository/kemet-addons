<?php
/**
 * Extra Headers - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_ext_headers_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css dynamic css.
 * @return string
 */
function kemet_ext_headers_dynamic_css( $dynamic_css ) {
	// Defaults Colors.
	$theme_color             = kemet_get_option( 'theme-color' );
	$global_border_color     = kemet_get_option( 'global-border-color' );
	$global_bg_color         = kemet_get_option( 'global-background-color' );
	$headings_links_color    = kemet_get_option( 'headings-links-color' );
	$header_content_bg_color = kemet_get_option( 'header-content-bg-color' );
	$btn_border_radius       = kemet_get_option( 'button-radius' );
	$menu_bg_color           = kemet_get_option( 'menu-bg-color', kemet_color_brightness( $global_bg_color, 0.97, 'dark' ) );
	// Icon.
	$header_icon_bars_logo_bg_color = kemet_get_option( 'header-icon-bars-logo-bg-color' );
	$header_icon_bars_color         = kemet_get_option( 'header-icon-bars-color', $headings_links_color );
	$header_icon_bars_h_color       = kemet_get_option( 'header-icon-bars-h-color', $theme_color );
	$header_icon_bars_bg_color      = kemet_get_option( 'header-icon-bars-bg-color' );
	$header_icon_bars_bg_h_color    = kemet_get_option( 'header-icon-bars-bg-h-color' );
	$header_icon_bars_borderradius  = kemet_get_option( 'header-icon-bars-border-radius' );
	$space_icon_bars                = kemet_get_option( 'menu-icon-bars-space' );
	$icon_label_color               = kemet_get_option( 'header-icon-label-color' );
	$icon_label_hover_color         = kemet_get_option( 'header-icon-label-hover-color' );
	$vertical_header_width          = kemet_get_option( 'vertical-header-width' );
	$vertical_border_width          = kemet_get_option( 'header-main-sep' );
	$vheader_border_style           = kemet_get_option( 'vheader-border-style' );
	$vheader_border_color           = kemet_get_option( 'header-main-sep-color', $global_border_color );
	$mini_vheader_width             = kemet_get_option( 'mini-vheader-width' );

	// Main menu options.
	$menu_link_h_color             = kemet_get_option( 'menu-link-h-color', $theme_color );
	$menu_link_bottom_border_color = kemet_get_option( 'menu-link-bottom-border-color', isset( $menu_link_h_color['desktop'] ) ? $menu_link_h_color['desktop'] : $menu_link_h_color );
	$menu_link_bottom_color        = kemet_get_option( 'vertical-menu-items-border-color', $global_border_color );
	$menu_link_border_bottom       = kemet_get_option( 'menu-item-border-bottom', $global_border_color );

	// Header8.
	$logo_icon_separator        = kemet_get_option( 'logo-icon-separator-color', $global_border_color );
	$menu_icon_separator_height = kemet_get_option( 'header-separator-height' );
	$css_content                = array(
		'.ss-content .main-header-menu .menu-item>a, .ss-content .main-header-menu .page_item>a' => array(
			'border-bottom-color' => esc_attr( $menu_link_bottom_color ),
		),
		'.ss-content .main-header-menu .menu-item:hover>a, .ss-content .main-header-menu li.menu-item:last-child:hover>a, .ss-content .main-header-menu .page_item:hover>a, .ss-content .main-header-menu li.page_item:last-child:hover>a' => array(
			'border-bottom-color' => esc_attr( $menu_link_bottom_border_color ),
		),
		'.header-main-layout-4 .main-header-menu'     => array(
			'background-color' => kemet_responsive_color( $menu_bg_color, 'desktop' ),
		),
		'.header-boxed-width .main-header-content , .header-stretched-width .main-header-content' => array(
			'background-color' => esc_attr( $header_content_bg_color ),
		),
		'.menu-icon-social .header-icon-label'        => array(
			'color' => esc_attr( $icon_label_color ),
		),
		'.site-header .menu-icon'                     => array(
			'border-radius' => kemet_responsive_slider( $btn_border_radius, 'desktop' ),
		),
		'.menu-icon-social .header-icon-label'        => array(
			'color' => esc_attr( $icon_label_color ),
		),
		'.menu-icon-social .header-icon-label:hover'  => array(
			'color' => esc_attr( $icon_label_hover_color ),
		),
		'.logo-menu-icon'                             => array(
			'background-color' => esc_attr( $header_icon_bars_logo_bg_color ),
		),
		'.header-main-layout-8 .inline-logo-menu.vertical-separator .site-branding:after' => array(
			'background-color' => esc_attr( $logo_icon_separator ),
			'height'           => kemet_get_css_value( $menu_icon_separator_height, 'px' ),
		),
		'.site-header .menu-icon-social'              => array(
			'margin-top'    => kemet_responsive_spacing( $space_icon_bars, 'top', 'desktop' ),
			'margin-right'  => kemet_responsive_spacing( $space_icon_bars, 'right', 'desktop' ),
			'margin-bottom' => kemet_responsive_spacing( $space_icon_bars, 'bottom', 'desktop' ),
			'margin-left'   => kemet_responsive_spacing( $space_icon_bars, 'left', 'desktop' ),
		),
		'.site-header .menu-icon-social .icon-bars-btn span' => array(
			'background-color' => esc_attr( $header_icon_bars_color ),
		),
		'.site-header .menu-icon-social .menu-icon:hover span,.site-header .open .icon-bars-btn span' => array(
			'background-color' => esc_attr( $header_icon_bars_h_color ),
		),
		'.site-header .menu-icon-social .menu-icon'   => array(
			'background-color' => esc_attr( $header_icon_bars_bg_color ),
			'border-radius'    => kemet_get_css_value( $header_icon_bars_borderradius, 'px' ),
		),
		'.site-header .menu-icon-social .menu-icon:hover, .menu-icon-social .menu-icon.open' => array(
			'background-color' => esc_attr( $header_icon_bars_bg_h_color ),
		),
		'.header-main-layout-5 .main-header-bar-wrap' => array(
			'width'        => kemet_get_css_value( $vertical_header_width, 'px' ),
			'border-color' => esc_attr( $vheader_border_color ),
		),
		'.header-main-layout-7 .main-header-bar-wrap' => array(
			'width'        => kemet_get_css_value( $mini_vheader_width, 'px' ),
			'border-color' => esc_attr( $vheader_border_color ),
		),
		'.kemet-main-v-header-align-right.header-main-layout-7' => array(
			'padding-right' => kemet_get_css_value( $mini_vheader_width, 'px' ),
		),
		'.kemet-main-v-header-align-left.header-main-layout-7' => array(
			'padding-left' => kemet_get_css_value( $mini_vheader_width, 'px' ),
		),
		'.kemet-main-v-header-align-right .main-header-bar-wrap' => array(
			'border-left-style' => esc_attr( $vheader_border_style ),
			'border-left-width' => kemet_responsive_slider( $vertical_border_width, 'desktop' ),
		),
		'.kemet-main-v-header-align-left .main-header-bar-wrap' => array(
			'border-right-style' => esc_attr( $vheader_border_style ),
			'border-right-width' => kemet_responsive_slider( $vertical_border_width, 'desktop' ),
		),
		'.kemet-main-v-header-align-right.header-main-layout-5' => array(
			'padding-right' => kemet_get_css_value( $vertical_header_width, 'px' ),
		),
		'.kemet-main-v-header-align-left.header-main-layout-5' => array(
			'padding-left' => kemet_get_css_value( $vertical_header_width, 'px' ),
		),
		'.menu-icon-header-8 .menu-icon'              => array(
			'background-color' => esc_attr( kemet_color_brightness( $global_bg_color, 0.94, 'dark' ) ),
		),
		'.ss-content .main-header-menu li.menu-item:last-child>a, .ss-content .main-header-menu li.page_item:last-child>a' => array(
			'border-bottom-width' => kemet_get_css_value( $menu_link_border_bottom, 'px' ),
			'border-bottom-color' => esc_attr( $menu_link_bottom_color ),
		),
	);

	$parse_css = kemet_parse_css( $css_content );

	$css_tablet = array(
		'.site-header .menu-icon-social'          => array(
			'margin-top'    => kemet_responsive_spacing( $space_icon_bars, 'top', 'tablet' ),
			'margin-right'  => kemet_responsive_spacing( $space_icon_bars, 'right', 'tablet' ),
			'margin-bottom' => kemet_responsive_spacing( $space_icon_bars, 'bottom', 'tablet' ),
			'margin-left'   => kemet_responsive_spacing( $space_icon_bars, 'left', 'tablet' ),
		),
		'.header-main-layout-4 .main-header-menu' => array(
			'background-color' => kemet_responsive_color( $menu_bg_color, 'tablet' ),
		),
	);
	$parse_css .= kemet_parse_css( $css_tablet, '', '768' );

	$css_mobile = array(
		'.site-header .menu-icon-social'          => array(
			'margin-top'    => kemet_responsive_spacing( $space_icon_bars, 'top', 'mobile' ),
			'margin-right'  => kemet_responsive_spacing( $space_icon_bars, 'right', 'mobile' ),
			'margin-bottom' => kemet_responsive_spacing( $space_icon_bars, 'bottom', 'mobile' ),
			'margin-left'   => kemet_responsive_spacing( $space_icon_bars, 'left', 'mobile' ),
		),
		'.header-main-layout-4 .main-header-menu' => array(
			'background-color' => kemet_responsive_color( $menu_bg_color, 'mobile' ),
		),
	);
	$parse_css .= kemet_parse_css( $css_mobile, '', '544' );

	return $dynamic_css . $parse_css;
}
