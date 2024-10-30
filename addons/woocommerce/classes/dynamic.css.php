<?php
/**
 * Woocommerce - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_woocommerce_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css css.
 * @return string
 */
function kemet_woocommerce_dynamic_css( $dynamic_css ) {
	// Global.
	$global_border_color  = kemet_get_option( 'global-border-color' );
	$theme_color          = kemet_get_option( 'theme-color' );
	$text_meta_color      = kemet_get_option( 'text-meta-color' );
	$headings_links_color = kemet_get_option( 'headings-links-color' );
	$btn_color            = kemet_get_option( 'button-color', '#ffffff' );
	$btn_h_color          = kemet_get_option( 'button-h-color', $btn_color );
	$btn_bg_color         = kemet_get_option( 'button-bg-color', $theme_color );
	$btn_bg_h_color       = kemet_get_option( 'button-bg-h-color', kemet_color_brightness( $theme_color, 0.8, 'dark' ) );
	$global_bg_color      = kemet_get_option( 'global-background-color' );
	$input_bg_color       = kemet_get_option( 'input-bg-color', kemet_color_brightness( $global_bg_color, 0.99, 'dark' ) );

	// Shop.
	$sale_color          = kemet_get_option( 'sale-text-color' );
	$sale_bg_color       = kemet_get_option( 'sale-background-color' );
	$loader_color        = kemet_get_option( 'infinite-scroll-loader-color', $theme_color );
	$inifinte_text_color = kemet_get_option( 'woo-infinite-text-color', $btn_color );

	// Single Product.
	$image_width = ! empty( kemet_get_option( 'product-image-width' ) ) ? kemet_get_option( 'product-image-width' ) : 50;

	$css_content                = array(
		'.hover-style .product-btn-group .woo-wishlist-btn .yith-wcwl-add-to-wishlist .add_to_wishlist' => array(
			'color' => esc_attr( $btn_color ),
		),
		'.woocommerce .product .onsale , .product .onsale' => array(
			'color'            => esc_attr( $sale_color ),
			'background-color' => esc_attr( $sale_bg_color ),
		),
		'.woocommerce .kmt-qv-icon,.kmt-qv-icon'           => array(
			'background-color' => kemet_color_brightness( $global_bg_color, 0.94, 'dark' ),
			'border-color'     => $global_border_color,
		),
		'.woocommerce #content .kmt-woocommerce-container div.product div.images,.woocommerce .kmt-woocommerce-container div.product div.images' => array(
			'width'     => kemet_get_css_value( $image_width, '%' ),
			'max-width' => kemet_get_css_value( $image_width, '%' ),
		),
		'.woocommerce #content .kmt-woocommerce-container div.product div.summary,.woocommerce .kmt-woocommerce-container div.product div.summary' => array(
			'width'     => kemet_get_css_value( ( 100 - $image_width ) - 3, '%' ),
			'max-width' => kemet_get_css_value( ( 100 - $image_width ) - 3, '%' ),
		),
		'.woocommerce .kmt-toolbar ,body .kmt-toolbar'     => array(
			'border-top-color'    => esc_attr( $global_border_color ),
			'border-bottom-color' => esc_attr( $global_border_color ),
		),
		'.woocommerce .kmt-toolbar .shop-list-style a , body .kmt-toolbar .shop-list-style a' => array(
			'border-color' => esc_attr( $global_border_color ),
		),
		'.woocommerce .kmt-toolbar .shop-list-style a:hover , .woocommerce .kmt-toolbar .shop-list-style a.active,body .kmt-toolbar .shop-list-style a.active' => array(
			'border-color' => esc_attr( $theme_color ),
			'color'        => esc_attr( $theme_color ),
		),
		'.hover-style ul.products li.product .kemet-shop-thumbnail-wrap .product-top .product-btn-group .woo-wishlist-btn , .shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn' => array(
			'background-color' => esc_attr( $btn_bg_color ),
			'color'            => esc_attr( $btn_color ),
		),
		'.shop-list ul.products li.product .kemet-shop-thumbnail-wrap .kemet-shop-summary-wrap .kmt-qv-on-list' => array(
			'border-color' => esc_attr( $global_border_color ),
			'color'        => esc_attr( $text_meta_color ),
		),
		'.shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn' => array(
			'border-color' => esc_attr( $global_border_color ),
		),
		'.shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn .yith-wcwl-add-to-wishlist > *' => array(
			'color' => esc_attr( $text_meta_color ),
		),
		'.shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn:hover a' => array(
			'color' => esc_attr( $text_meta_color ),
		),
		'div.product .summary .yith-wcwl-wishlistexistsbrowse:hover' => array(
			'color' => esc_attr( $theme_color ),
		),
		'.single-product div.product .entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-icon, .single-product div.product .entry-summary .compare:before' => array(
			'background-color' => esc_attr( kemet_color_brightness( $global_bg_color, 0.94, 'dark' ) ),
		),
		'.hover-style ul.products li.product .kemet-shop-thumbnail-wrap .product-top .product-btn-group .woo-wishlist-btn:hover' => array(
			'background-color' => esc_attr( $btn_bg_h_color ),
			'color'            => esc_attr( $btn_h_color ),
		),
		'.product-list-img a.kmt-qv-on-image, .add-to-cart-group .added_to_cart' => array(
			'background-color' => esc_attr( $btn_bg_color ),
			'color'            => esc_attr( $btn_color ),
		),
		'.product-list-img a.kmt-qv-on-image:hover, .add-to-cart-group .added_to_cart:hover' => array(
			'background-color' => esc_attr( $btn_bg_h_color ),
			'color'            => esc_attr( $btn_h_color ),
		),
		'.kmt-woo-infinite-scroll-loader .kmt-woo-infinite-scroll-dots .kmt-woo-loader' => array(
			'background-color' => esc_attr( $loader_color ),
		),
		'a.plus, a.minus'                                  => array(
			'border-color'     => esc_attr( $global_border_color ),
			'background-color' => esc_attr( $input_bg_color ),
		),
		'.kmt-woo-load-more .woo-load-more-text'           => array(
			'color' => esc_attr( $inifinte_text_color ),
		),
		'.shop-grid .yith-wcwl-add-to-wishlist'            => array(
			'color' => esc_attr( $headings_links_color ),
		),
		'.shop-grid .yith-wcwl-add-to-wishlist:hover'      => array(
			'color' => esc_attr( $theme_color ),
		),
	);
	$parse_css                  = kemet_parse_css( $css_content );
	$disable_desc_in_responsive = kemet_get_option( 'disable-list-short-desc-in-responsive' );
	if ( $disable_desc_in_responsive ) {
		$desc_in_responsive = array(
			'.woocommerce .kmt-woo-shop-product-description' => array(
				'display' => esc_attr( 'none' ),
			),
		);
		$parse_css         .= kemet_parse_css( $desc_in_responsive, '', '768' );
	}
	return $dynamic_css . $parse_css;
}
