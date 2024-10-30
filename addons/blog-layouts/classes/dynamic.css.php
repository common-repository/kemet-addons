<?php
/**
 * Extra Blogs - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_blog_layouts_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css dynamic css.
 * @return string
 */
function kemet_blog_layouts_dynamic_css( $dynamic_css ) {

	$theme_color                  = kemet_get_option( 'theme-color' );
	$global_border_color          = kemet_get_option( 'global-border-color' );
	$global_bg_color              = kemet_get_option( 'global-background-color' );
	$text_meta_color              = kemet_get_option( 'text-meta-color' );
	$posts_border_color           = kemet_get_option( 'blog-posts-border-color', $global_border_color );
	$posts_border_size            = kemet_get_option( 'blog-posts-border-size' );
	$posts_border_size2           = kemet_get_option( 'layout-2-post-border-size' );
	$title_meta_border_color      = kemet_get_option( 'blog-title-meta-border-color', $global_border_color );
	$title_meta_border_size       = kemet_get_option( 'blog-title-meta-border-size' );
	$post_image_height            = kemet_get_option( 'post-image-height' );
	$overlay_bg_color             = kemet_get_option( 'overlay-image-bg-color', $theme_color );
	$overlay_icon_color           = kemet_get_option( 'overlay-icon-color', $global_border_color );
	$post_inner_spacing           = kemet_get_option( 'blog-container-inner-spacing' );
	$post_margin_bottom           = kemet_get_option( 'post-margin-bottom' );
	$blog_pagination_border_color = kemet_get_option( 'blog-pagination-border-color', $global_border_color );
	$inifinte_loader_color        = kemet_get_option( 'blog-infinite-loader-color', $theme_color );

	$css_content = array(
		'.blog-layout-3 .kmt-article-post .post-content'  => array(
			'border-width' => kemet_get_css_value( $posts_border_size, 'px' ),
			'border-color' => esc_attr( $posts_border_color ),
		),
		'.blog-layout-2 .blog-post-layout-2 , body:not(.kmt-separate-container) .blog-layout-2 .kmt-article-post .blog-post-layout-2' => array(
			'border-color'        => esc_attr( $posts_border_color ),
			'border-top-width'    => kemet_responsive_spacing( $posts_border_size2, 'top', 'desktop' ),
			'border-right-width'  => kemet_responsive_spacing( $posts_border_size2, 'right', 'desktop' ),
			'border-left-width'   => kemet_responsive_spacing( $posts_border_size2, 'left', 'desktop' ),
			'border-bottom-width' => kemet_responsive_spacing( $posts_border_size2, 'bottom', 'desktop' ),
		),
		'.blog .blog-posts-container:not(.blog-layout-2) .kmt-article-post , .blog-layout-2 .kmt-article-post > div' => array(
			'padding-top'    => kemet_responsive_spacing( $post_inner_spacing, 'top', 'desktop' ),
			'padding-right'  => kemet_responsive_spacing( $post_inner_spacing, 'right', 'desktop' ),
			'padding-left'   => kemet_responsive_spacing( $post_inner_spacing, 'left', 'desktop' ),
			'padding-bottom' => kemet_responsive_spacing( $post_inner_spacing, 'bottom', 'desktop' ),
		),
		'.blog-layout-3 .kmt-article-post .entry-content' => array(
			'border-top-color' => esc_attr( $title_meta_border_color ),
			'border-top-width' => kemet_get_css_value( $title_meta_border_size, 'px' ),
		),
		'.squares .overlay-image .overlay-color .section-1:before ,.squares .overlay-image .overlay-color .section-1:after ,.squares .overlay-image .overlay-color .section-2:before ,.squares .overlay-image .overlay-color .section-2:after , .bordered .overlay-color ,.framed .overlay-color' => array(
			'background-color' => esc_attr( $overlay_bg_color ),
		),
		'.overlay-image .post-details a:before , .overlay-image .post-details a:after' => array(
			'background-color' => esc_attr( $overlay_icon_color ),
		),
		'.blog-layout-3 .kmt-article-post.has-post-thumbnail .post-content' => array(
			'background-color' => esc_attr( $global_bg_color ),
		),
		'.blog-layout-4 .blog-post-layout-4 .entry-header .kmt-default-featured-section' => array(
			'background-color' => esc_attr( kemet_color_brightness( $global_bg_color, 0.94, 'dark' ) ),
		),
		'.blog-layout-4 .blog-post-layout-4 .entry-header .kmt-default-featured-section:before' => array(
			'background-color' => esc_attr( $global_bg_color ),
			'color'            => esc_attr( kemet_color_brightness( $global_bg_color, 0.94, 'dark' ) ),
		),
		'.bordered .overlay-color .color-section-1 .color-section-2:after, .bordered .overlay-color .color-section-1 .color-section-2:before' => array(
			'border-color' => esc_attr( kemet_color_brightness( $global_border_color, 0.3, 'dark' ) ),
		),
		'.blog-layout-1 .kmt-article-post, .blog-layout-3 .kmt-article-post, .blog-layout-5 .kmt-article-post' => array(
			'margin-bottom' => kemet_get_css_value( $post_margin_bottom, 'px' ),
		),
		'.kmt-pagination.standard .nav-links > a'         => array(
			'border-color' => esc_attr( $blog_pagination_border_color ),
		),
		'.kmt-infinite-scroll-loader .kmt-infinite-scroll-dots .kmt-loader' => array(
			'background-color' => esc_attr( $inifinte_loader_color ),
		),
	);

	$parse_css = kemet_parse_css( $css_content );

	$css_tablet = array(
		'.blog .blog-posts-container:not(.blog-layout-2) .kmt-article-post , .blog-layout-2 .kmt-article-post > div' => array(
			'padding-top'    => kemet_responsive_spacing( $post_inner_spacing, 'top', 'tablet' ),
			'padding-right'  => kemet_responsive_spacing( $post_inner_spacing, 'right', 'tablet' ),
			'padding-left'   => kemet_responsive_spacing( $post_inner_spacing, 'left', 'tablet' ),
			'padding-bottom' => kemet_responsive_spacing( $post_inner_spacing, 'bottom', 'tablet' ),
		),
		'.blog-layout-2 .blog-post-layout-2 , body:not(.kmt-separate-container) .blog-layout-2 .kmt-article-post .blog-post-layout-2' => array(
			'border-top-width'    => kemet_responsive_spacing( $posts_border_size2, 'top', 'tablet' ),
			'border-right-width'  => kemet_responsive_spacing( $posts_border_size2, 'right', 'tablet' ),
			'border-left-width'   => kemet_responsive_spacing( $posts_border_size2, 'left', 'tablet' ),
			'border-bottom-width' => kemet_responsive_spacing( $posts_border_size2, 'bottom', 'tablet' ),
		),
	);
	$parse_css .= kemet_parse_css( $css_tablet, '', '768' );

	$css_mobile = array(
		'.blog .blog-posts-container:not(.blog-layout-2) .kmt-article-post , .blog-layout-2 .kmt-article-post > div' => array(
			'padding-top'    => kemet_responsive_spacing( $post_inner_spacing, 'top', 'mobile' ),
			'padding-right'  => kemet_responsive_spacing( $post_inner_spacing, 'right', 'mobile' ),
			'padding-left'   => kemet_responsive_spacing( $post_inner_spacing, 'left', 'mobile' ),
			'padding-bottom' => kemet_responsive_spacing( $post_inner_spacing, 'bottom', 'mobile' ),
		),
		'.blog-layout-2 .blog-post-layout-2 , body:not(.kmt-separate-container) .blog-layout-2 .kmt-article-post .blog-post-layout-2' => array(
			'border-top-width'    => kemet_responsive_spacing( $posts_border_size2, 'top', 'mobile' ),
			'border-right-width'  => kemet_responsive_spacing( $posts_border_size2, 'right', 'mobile' ),
			'border-left-width'   => kemet_responsive_spacing( $posts_border_size2, 'left', 'mobile' ),
			'border-bottom-width' => kemet_responsive_spacing( $posts_border_size2, 'bottom', 'mobile' ),
		),
	);
	$parse_css .= kemet_parse_css( $css_mobile, '', '544' );

	return $dynamic_css . $parse_css;

}
