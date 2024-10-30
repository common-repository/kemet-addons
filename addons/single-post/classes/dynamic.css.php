<?php
/**
 * Single Post - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_single_post_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css css.
 * @return string
 */
function kemet_single_post_dynamic_css( $dynamic_css ) {
	global $post;
	$header_featured_image    = '';
	$title_meta_poistion      = kemet_get_option( 'title-meta-position' );
	$content_alignment        = kemet_get_option( 'content-alignment' );
	$padding_inside_container = kemet_get_option( 'padding-inside-container' );
	$parse_css                = '';

	if ( kemet_get_option( 'featured-image-header' ) == true ) {
		if ( has_post_thumbnail( $post->ID ) ) {
			$image            = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
			$image_page_title = array(
				'.kmt-page-title-addon-content, .kemet-merged-header-title' => array(
					'background-image'      => 'url("' . $image[0] . '") !important;',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				),
			);
			$parse_css        = kemet_parse_css( $image_page_title );
		}
	}

	$css_content = array(
		'.single .entry-header' => array(
			'text-align' => esc_attr( $title_meta_poistion ),
		),
		'.single-post .kmt-article-single, .single-post .comments-area .comment-respond , .single-post .kmt-author-box-info , .single-post .kmt-comment-list li' => array(
			'padding-top'    => kemet_responsive_spacing( $padding_inside_container, 'top', 'desktop' ),
			'padding-right'  => kemet_responsive_spacing( $padding_inside_container, 'right', 'desktop' ),
			'padding-bottom' => kemet_responsive_spacing( $padding_inside_container, 'bottom', 'desktop' ),
			'padding-left'   => kemet_responsive_spacing( $padding_inside_container, 'left', 'desktop' ),
		),
		'.single .entry-content , .single .comments-area , .single .comments-area .comment-form-textarea textarea' => array(
			'text-align' => esc_attr( $content_alignment ),
		),
	);

	$css_tablet = array(
		'.single-post .kmt-article-single, .single-post .comments-area .comment-respond , .single-post .kmt-author-box-info , .single-post .kmt-comment-list li' => array(
			'padding-top'    => kemet_responsive_spacing( $padding_inside_container, 'top', 'tablet' ),
			'padding-right'  => kemet_responsive_spacing( $padding_inside_container, 'right', 'tablet' ),
			'padding-bottom' => kemet_responsive_spacing( $padding_inside_container, 'bottom', 'tablet' ),
			'padding-left'   => kemet_responsive_spacing( $padding_inside_container, 'left', 'tablet' ),
		),
	);
	$parse_css .= kemet_parse_css( $css_tablet, '', '768' );

	$css_mobile = array(
		'.single-post .kmt-article-single, .single-post .comments-area .comment-respond , .single-post .kmt-author-box-info , .single-post .kmt-comment-list li' => array(
			'padding-top'    => kemet_responsive_spacing( $padding_inside_container, 'top', 'mobile' ),
			'padding-right'  => kemet_responsive_spacing( $padding_inside_container, 'right', 'mobile' ),
			'padding-bottom' => kemet_responsive_spacing( $padding_inside_container, 'bottom', 'mobile' ),
			'padding-left'   => kemet_responsive_spacing( $padding_inside_container, 'left', 'mobile' ),
		),
	);
	$parse_css .= kemet_parse_css( $css_mobile, '', '544' );

	$parse_css .= kemet_parse_css( $css_content );

	return $dynamic_css . $parse_css;
}
