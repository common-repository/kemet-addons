<?php
/**
 * Go Top - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_ext_go_top_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css css.
 * @return string
 */
function kemet_ext_go_top_dynamic_css( $dynamic_css ) {
	// Go Top Link.
	$go_top_icon_color    = kemet_get_option( 'go-top-icon-color' );
	$go_top_icon_h_color  = kemet_get_option( 'go-top-icon-h-color' );
	$go_top_icon_size     = kemet_get_option( 'go-top-icon-size' );
	$go_top_bg_color      = kemet_get_option( 'go-top-bg-color' );
	$go_top_bg_h_color    = kemet_get_option( 'go-top-bg-h-color' );
	$go_top_border_radius = kemet_get_option( 'go-top-border-radius' );
	$go_top_button_size   = kemet_get_option( 'go-top-button-size' );

	$css_content = array(
		'.kmt-go-top-link'        => array(
			'background-color' => esc_attr( $go_top_bg_color ),
			'border-radius'    => kemet_responsive_slider( $go_top_border_radius, 'desktop' ),
			'width'            => kemet_responsive_slider( $go_top_button_size, 'desktop' ),
			'height'           => kemet_responsive_slider( $go_top_button_size, 'desktop' ),
			'line-height'      => kemet_responsive_slider( $go_top_button_size, 'desktop' ),
			'color'            => esc_attr( $go_top_icon_color ),
		),
		'.kmt-go-top-link:before' => array(
			'font-size' => kemet_responsive_slider( $go_top_icon_size, 'desktop' ),
		),
		'.kmt-go-top-link:hover'  => array(
			'color'            => esc_attr( $go_top_icon_h_color ),
			'background-color' => esc_attr( $go_top_bg_h_color ),
		),

	);

	$parse_css = kemet_parse_css( $css_content );

	$css_tablet = array(
		'.kmt-go-top-link:before' => array(
			'font-size' => kemet_responsive_slider( $go_top_icon_size, 'tablet' ),
		),
		'.kmt-go-top-link'        => array(
			'border-radius' => kemet_responsive_slider( $go_top_border_radius, 'tablet' ),
			'width'         => kemet_responsive_slider( $go_top_button_size, 'tablet' ),
			'height'        => kemet_responsive_slider( $go_top_button_size, 'tablet' ),
			'line-height'   => kemet_responsive_slider( $go_top_button_size, 'tablet' ),
		),
	);
	$parse_css .= kemet_parse_css( $css_tablet, '', '768' );

	$css_mobile = array(
		'.kmt-go-top-link:before' => array(
			'font-size' => kemet_responsive_slider( $go_top_icon_size, 'mobile' ),
		),
		'.kmt-go-top-link'        => array(
			'border-radius' => kemet_responsive_slider( $go_top_border_radius, 'mobile' ),
			'width'         => kemet_responsive_slider( $go_top_button_size, 'mobile' ),
			'height'        => kemet_responsive_slider( $go_top_button_size, 'mobile' ),
			'line-height'   => kemet_responsive_slider( $go_top_button_size, 'mobile' ),
		),
	);
	$parse_css .= kemet_parse_css( $css_mobile, '', '544' );

	return $dynamic_css . $parse_css;
}
