<?php
/**
 * Blog Layouts
 *
 * @package Kemet Addons
 */

if ( ! function_exists( 'kemet_is_valid_url' ) ) {

	/**
	 * Validate given URL format
	 *
	 * @param strint $url url.
	 * @return bool
	 */
	function kemet_is_valid_url( $url ) {
		return (bool) wp_parse_url( $url, PHP_URL_SCHEME );
	}
}

if ( ! function_exists( 'kemet_get_post_thumbnail_format' ) ) {

	/**
	 * Get post thumbnail url if added or default image based on poet format
	 *
	 * @param int    $post_id Post id.
	 * @param string $size Image size.
	 * @return string Image URL.
	 */
	function kemet_get_post_thumbnail_format( $post_id, $size ) {
		$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
		if ( false == $attachment_image ) {
			return ( get_post_format( $post_id ) ) ? get_post_format( $post_id ) : 'standard';
		} else {
			return $attachment_image[0];
		}
	}
}

if ( ! function_exists( 'kemet_get_the_post_thumbnail_background' ) ) {

	/**
	 * Get post thumbnail url if added or default image based on poet format
	 *
	 * @param int    $post_id Post id.
	 * @param string $size Image size.
	 * @return string Image URL
	 */
	function kemet_get_the_post_thumbnail_background( $post_id, $size ) {
		$thumbnail_format = kemet_get_post_thumbnail_format( $post_id, $size );
		$overlay_style    = kemet_get_option( 'overlay-image-style' );
		$output           = '';
		if ( kemet_is_valid_url( $thumbnail_format ) ) {
			$output .= '<div class="kmt-blog-featured-section post-thumb">';
			$output .= '<div class="kmt-blog-featured-bg" style="background-image:url(' . $thumbnail_format . ');">';
			$output .= '<a class="link-post" href=' . esc_url( get_permalink() ) . '></a>';
			$output .= '</div>';
			if ( 'none' != $overlay_style ) {
				$output .= '<div class="overlay-image">';
				$output .= '<div class="overlay-color">';
				if ( 'bordered' == $overlay_style ) {
					$output .= '<div class="color-section-1"><div class="color-section-2"></div></div>';
				} elseif ( 'squares' == $overlay_style ) {
					$output .= '<div class="section-1"></div><div class="section-2"></div>';
				}
				$output .= '</div>';
				$output .= '<div class="post-details">';
				$output .= '<a class="post-link" href=' . esc_url( get_permalink() ) . '></a>';
				$output .= '<a class="enlarge"  href="' . get_the_post_thumbnail_url( get_the_ID() ) . '"></a>';
				$output .= '</div></div>';
			}
			$output .= '</div>';
			return $output;
		} else {
			$output .= '<div class="kmt-default-featured-section post-thumb' . $thumbnail_format . '">';
			$output .= '<a class="link-post" href=' . esc_url( get_permalink() ) . '></a>';
			if ( 'none' != $overlay_style ) {
				$output .= '<div class="overlay-image">';
				$output .= '<div class="overlay-color">';
				if ( 'bordered' == $overlay_style ) {
					$output .= '<div class="color-section-1"><div class="color-section-2"></div></div>';
				} elseif ( 'squares' == $overlay_style ) {
					$output .= '<div class="section-1"></div><div class="section-2"></div>';
				}
				$output .= '</div>';
				$output .= '<div class="post-details">';
				$output .= '<a class="post-link" href=' . esc_url( get_permalink() ) . '></a>';
				$output .= '</div></div>';
			}
			$output .= '</div>';
			return $output;
		}
	}
}
/**
 * Kemet Addons get post thumbnail image.
 */
if ( ! function_exists( 'kemet_addons_get_thumbnail_with_overlay' ) ) {

	/**
	 * Kemet Addons get post thumbnail image
	 *
	 * @param string  $before Markup before thumbnail image.
	 * @param string  $after  Markup after thumbnail image.
	 * @param boolean $echo   Output print or return.
	 * @return string|void
	 */
	function kemet_addons_get_thumbnail_with_overlay( $before = '', $after = '', $echo = true ) {

		$output = '';

		$check_is_singular = is_singular();

		$featured_image = true;

		$featured_image = apply_filters( 'kemet_featured_image_enabled', $featured_image );

		$blog_post_thumb = kemet_get_option( 'blog-post-structure' );

		$overlay_style = kemet_get_option( 'overlay-image-style' );

		if ( ( ( ! $check_is_singular && in_array( 'image', $blog_post_thumb ) ) || is_page() ) && has_post_thumbnail() ) {

			if ( $featured_image && ( ! ( $check_is_singular ) || ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) ) ) {

				$post_thumb = get_the_post_thumbnail(
					get_the_ID(),
					apply_filters( 'kemet_post_thumbnail_default_size', 'full' ),
					array(
						'itemprop' => 'image',
					)
				);

				if ( '' != $post_thumb && ! is_singular( 'post' ) ) {
					$output .= '<div class="post-thumb-img-content post-thumb">';
					$output .= $post_thumb;
					$output .= '<div class="overlay-image">';
					$output .= '<div class="overlay-color">';
					if ( 'bordered' == $overlay_style ) {
						$output .= '<div class="color-section-1"><div class="color-section-2"></div></div>';
					} elseif ( 'squares' == $overlay_style ) {
						$output .= '<div class="section-1"></div><div class="section-2"></div>';
					}
					$output .= '</div>';
					$output .= '<div class="post-details">';
					$output .= '<a class="post-link" href=' . esc_url( get_permalink() ) . '></a>';
					$output .= '</div></div>';
					$output .= '</div>';
				}
			}
		}

		if ( ! $check_is_singular ) {
			$output = apply_filters( 'kemet_blog_post_featured_image_after', $output );
		}

		$output = apply_filters( 'kemet_get_post_thumbnail', $output, $before, $after );

		if ( $echo ) {
			echo $before . $output . $after; // WPCS: XSS OK.
		} else {
			return $before . $output . $after;
		}
	}
}
/**
 * Set theme images sizes
 */
function kemet_image_sizes() {
	add_image_size( '570x570', 570, 570, true );
}

add_action( 'after_setup_theme', 'kemet_image_sizes' );
