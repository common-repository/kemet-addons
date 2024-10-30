<?php
/**
 * Page Title addon - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_ext_page_title_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css css.
 * @return string
 */
function kemet_ext_page_title_dynamic_css( $dynamic_css ) {

	$theme_color                  = kemet_get_option( 'theme-color' );
	$text_meta_color              = kemet_get_option( 'text-meta-color' );
	$global_bg_color              = kemet_get_option( 'global-background-color' );
	$page_title_bg                = kemet_get_option( 'page-title-bg-obj', array( 'background-color' => kemet_color_brightness( $global_bg_color, 0.9, 'dark' ) ) );
	$page_title_space             = kemet_get_option( 'page-title-space' );
	$page_title_color             = kemet_get_option( 'page-title-color' );
	$page_title_font_size         = kemet_get_option( 'page-title-font-size' );
	$page_title_letter_spacing    = kemet_get_option( 'page-title-letter-spacing' );
	$page_title_font_family       = kemet_get_option( 'page-title-font-family' );
	$page_title_font_weight       = kemet_get_option( 'page-title-font-weight' );
	$page_title_font_transform    = kemet_get_option( 'pagetitle-text-transform' );
	$page_title_font_style        = kemet_get_option( 'pagetitle-font-style' );
	$page_title_line_height       = kemet_get_option( 'pagetitle-line-height' );
	$page_title_bottomline_height = kemet_get_option( 'pagetitle-bottomline-height' );
	$page_title_bottomline_color  = kemet_get_option( 'pagetitle-bottomline-color', $theme_color );
	$page_title_bottomline_width  = kemet_get_option( 'pagetitle-bottomline-width' );
	$layout3_border_right_color   = kemet_get_option( 'page-title-border-right-color' );
	$page_title_algin             = kemet_get_option( 'page_title_alignment' );
	$sub_title_color              = apply_filters( 'sub_title_color', kemet_get_option( 'sub-title-color', $text_meta_color ) );
	$sub_title_font_family        = kemet_get_option( 'sub-title-font-family' );
	$sub_title_font_size          = kemet_get_option( 'sub-title-font-size' );
	$sub_title_font_weight        = kemet_get_option( 'sub-title-font-weight' );
	$sub_title_letter_spacing     = kemet_get_option( 'sub-title-letter-spacing' );
	$sub_title_text_transform     = kemet_get_option( 'sub-title-text-transform' );
	$sub_title_line_height        = kemet_get_option( 'sub-title-line-height' );
	// Breadcrumbs.
	$breadcrumbs_spacing        = kemet_get_option( 'breadcrumbs-space' );
	$breadcrumbs_color          = kemet_get_option( 'breadcrumbs-color', $page_title_color );
	$breadcrumbs_font_size      = kemet_get_option( 'breadcrumbs-font-size' );
	$breadcrumbs_letter_spacing = kemet_get_option( 'breadcrumbs-letter-spacing' );
	$breadcrumbs_font_family    = kemet_get_option( 'breadcrumbs-font-family' );
	$breadcrumbs_font_weight    = kemet_get_option( 'breadcrumbs-font-weight' );
	$breadcrumbs_text_transform = kemet_get_option( 'breadcrumbs-text-transform' );
	$breadcrumbs_line_height    = kemet_get_option( 'breadcrumbs-line-height' );
	$breadcrumbs_font_size      = kemet_get_option( 'breadcrumbs-font-size' );
	$breadcrumbs_link_color     = kemet_get_option( 'breadcrumbs-link-color', $page_title_color );
	$breadcrumbs_link_h_color   = kemet_get_option( 'breadcrumbs-link-h-color', $theme_color );

	$css_content = array(
		'.kmt-page-title-addon-content, .header-transparent .kmt-page-title-addon-content,.merged-header-transparent .kmt-page-title-addon-content' => array(
			'padding-top'    => kemet_responsive_spacing( $page_title_space, 'top', 'desktop' ),
			'padding-right'  => kemet_responsive_spacing( $page_title_space, 'right', 'desktop' ),
			'padding-bottom' => kemet_responsive_spacing( $page_title_space, 'bottom', 'desktop' ),
			'padding-left'   => kemet_responsive_spacing( $page_title_space, 'left', 'desktop' ),
		),
		'.kemet-page-title'                         => array(
			'color'          => esc_attr( $page_title_color ),
			'font-family'    => kemet_get_css_value( $page_title_font_family, 'font' ),
			'font-weight'    => kemet_get_css_value( $page_title_font_weight, 'font' ),
			'font-size'      => kemet_responsive_slider( $page_title_font_size, 'desktop' ),
			'letter-spacing' => kemet_responsive_slider( $page_title_letter_spacing, 'desktop' ),
			'text-transform' => esc_attr( $page_title_font_transform ),
			'font-style'     => esc_attr( $page_title_font_style ),
			'line-height'    => kemet_responsive_slider( $page_title_line_height, 'desktop' ),
		),
		'.taxonomy-description'                     => array(
			'color' => esc_attr( $page_title_color ),
		),
		'.kmt-page-title.page-title-layout-1'       => array(
			'text-align' => esc_attr( $page_title_algin ),
		),
		'.kemet-page-title::after'                  => array(
			'background-color' => esc_attr( $page_title_bottomline_color ),
			'height'           => kemet_get_css_value( $page_title_bottomline_height, 'px' ),
			'width'            => kemet_get_css_value( $page_title_bottomline_width, 'px' ),
		),
		'.page-title-layout-3 .kmt-page-title-wrap' => array(
			'border-color' => esc_attr( $layout3_border_right_color ),
		),
		'.kemet-page-sub-title'                     => array(
			'color'          => esc_attr( $sub_title_color ),
			'font-family'    => kemet_get_css_value( $sub_title_font_family, 'font' ),
			'font-weight'    => kemet_get_css_value( $sub_title_font_weight, 'font' ),
			'font-size'      => kemet_responsive_slider( $sub_title_font_size, 'desktop' ),
			'letter-spacing' => kemet_responsive_slider( $sub_title_letter_spacing, 'desktop' ),
			'text-transform' => esc_attr( $sub_title_text_transform ),
			'line-height'    => kemet_responsive_slider( $sub_title_line_height, 'desktop' ),
		),
		'.kemet-breadcrumb-trail'                   => array(
			'padding-top'    => kemet_responsive_spacing( $breadcrumbs_spacing, 'top', 'desktop' ),
			'padding-right'  => kemet_responsive_spacing( $breadcrumbs_spacing, 'right', 'desktop' ),
			'padding-bottom' => kemet_responsive_spacing( $breadcrumbs_spacing, 'bottom', 'desktop' ),
			'padding-left'   => kemet_responsive_spacing( $breadcrumbs_spacing, 'left', 'desktop' ),
		),
		'.kemet-breadcrumb-trail li > span , .kemet-breadcrumb-trail li > span > span , .kemet-breadcrumb-trail > span' => array(
			'color' => esc_attr( $breadcrumbs_color ),
		),
		'.kemet-breadcrumb-trail a span'            => array(
			'color' => esc_attr( $breadcrumbs_link_color ),
		),
		'.kemet-breadcrumb-trail a:hover span'      => array(
			'color' => esc_attr( $breadcrumbs_link_h_color ),
		),
		'.kemet-breadcrumb-trail , .kemet-breadcrumb-trail *:not(.dashicons)' => array(
			'font-size'      => kemet_responsive_slider( $breadcrumbs_font_size, 'desktop' ),
			'line-height'    => kemet_responsive_slider( $breadcrumbs_line_height, 'desktop' ),
			'letter-spacing' => kemet_responsive_slider( $breadcrumbs_letter_spacing, 'desktop' ),
			'font-family'    => kemet_get_font_family( $breadcrumbs_font_family ),
			'font-weight'    => esc_attr( $breadcrumbs_font_weight ),
			'text-transform' => esc_attr( $breadcrumbs_text_transform ),
		),
	);

	$parse_css = kemet_parse_css( $css_content );
	// Background.
	$parse_css .= kemet_get_background_obj( '.kmt-page-title-addon-content, .kemet-merged-header-title', $page_title_bg );

	$css_tablet = array(
		'.kmt-page-title-addon-content, .header-transparent .kmt-page-title-addon-content,.merged-header-transparent .kmt-page-title-addon-content' => array(
			'padding-top'    => kemet_responsive_spacing( $page_title_space, 'top', 'tablet' ),
			'padding-right'  => kemet_responsive_spacing( $page_title_space, 'right', 'tablet' ),
			'padding-bottom' => kemet_responsive_spacing( $page_title_space, 'bottom', 'tablet' ),
			'padding-left'   => kemet_responsive_spacing( $page_title_space, 'left', 'tablet' ),
		),
		'.kemet-page-title'       => array(
			'font-size'      => kemet_responsive_slider( $page_title_font_size, 'tablet' ),
			'letter-spacing' => kemet_responsive_slider( $page_title_letter_spacing, 'tablet' ),
			'line-height'    => kemet_responsive_slider( $page_title_line_height, 'tablet' ),
		),
		'.kemet-breadcrumb-trail' => array(
			'padding-top'    => kemet_responsive_spacing( $breadcrumbs_spacing, 'top', 'tablet' ),
			'padding-right'  => kemet_responsive_spacing( $breadcrumbs_spacing, 'right', 'tablet' ),
			'padding-bottom' => kemet_responsive_spacing( $breadcrumbs_spacing, 'bottom', 'tablet' ),
			'padding-left'   => kemet_responsive_spacing( $breadcrumbs_spacing, 'left', 'tablet' ),
			'font-size'      => kemet_responsive_slider( $breadcrumbs_font_size, 'tablet' ),
		),
		'.kemet-page-sub-title'   => array(
			'font-size'      => kemet_responsive_slider( $sub_title_font_size, 'tablet' ),
			'letter-spacing' => kemet_responsive_slider( $sub_title_letter_spacing, 'tablet' ),
			'line-height'    => kemet_responsive_slider( $sub_title_line_height, 'tablet' ),
		),
		'.kemet-breadcrumb-trail , .kemet-breadcrumb-trail *:not(.dashicons)' => array(
			'font-size'      => kemet_responsive_slider( $breadcrumbs_font_size, 'tablet' ),
			'line-height'    => kemet_responsive_slider( $breadcrumbs_line_height, 'tablet' ),
			'letter-spacing' => kemet_responsive_slider( $breadcrumbs_letter_spacing, 'tablet' ),
		),
	);
	$parse_css .= kemet_parse_css( $css_tablet, '', '768' );

	$css_mobile = array(
		'.kmt-page-title-addon-content, .header-transparent .kmt-page-title-addon-content,.merged-header-transparent .kmt-page-title-addon-content' => array(
			'padding-top'    => kemet_responsive_spacing( $page_title_space, 'top', 'mobile' ),
			'padding-right'  => kemet_responsive_spacing( $page_title_space, 'right', 'mobile' ),
			'padding-bottom' => kemet_responsive_spacing( $page_title_space, 'bottom', 'mobile' ),
			'padding-left'   => kemet_responsive_spacing( $page_title_space, 'left', 'mobile' ),
		),
		'.kemet-page-title'       => array(
			'font-size'      => kemet_responsive_slider( $page_title_font_size, 'mobile' ),
			'letter-spacing' => kemet_responsive_slider( $page_title_letter_spacing, 'mobile' ),
			'line-height'    => kemet_responsive_slider( $page_title_line_height, 'mobile' ),
		),
		'.kemet-breadcrumb-trail' => array(
			'padding-top'    => kemet_responsive_spacing( $breadcrumbs_spacing, 'top', 'mobile' ),
			'padding-right'  => kemet_responsive_spacing( $breadcrumbs_spacing, 'right', 'mobile' ),
			'padding-bottom' => kemet_responsive_spacing( $breadcrumbs_spacing, 'bottom', 'mobile' ),
			'padding-left'   => kemet_responsive_spacing( $breadcrumbs_spacing, 'left', 'mobile' ),
			'font-size'      => kemet_responsive_slider( $breadcrumbs_font_size, 'mobile' ),
		),
		'.kemet-page-sub-title'   => array(
			'font-size'      => kemet_responsive_slider( $sub_title_font_size, 'mobile' ),
			'letter-spacing' => kemet_responsive_slider( $sub_title_letter_spacing, 'mobile' ),
			'line-height'    => kemet_responsive_slider( $sub_title_line_height, 'mobile' ),
		),
		'.kemet-breadcrumb-trail , .kemet-breadcrumb-trail *:not(.dashicons)' => array(
			'font-size'      => kemet_responsive_slider( $breadcrumbs_font_size, 'mobile' ),
			'line-height'    => kemet_responsive_slider( $breadcrumbs_line_height, 'mobile' ),
			'letter-spacing' => kemet_responsive_slider( $breadcrumbs_letter_spacing, 'mobile' ),
		),
	);
	$parse_css .= kemet_parse_css( $css_mobile, '', '544' );

	return $dynamic_css . $parse_css;
}
