<?php
/**
 * Quick view image template.
 *
 * @package Kemet Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post, $product, $woocommerce; ?>

<div class="kmt-qv-image flexslider images">
	<ul class="kmt-qv-slides slides">
		<?php
		if ( has_post_thumbnail() ) {
			$attachment_ids = $product->get_gallery_image_ids();
			$props          = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image          = get_the_post_thumbnail(
				$post->ID,
				'shop_single',
				array(
					'title' => $props['title'],
					'alt'   => $props['alt'],
				)
			);
			echo sprintf(
				'<li class="%s">%s</li>',
				esc_attr( 'woocommerce-product-gallery__image' ),
				wp_kses(
					$image,
					kemet_allowed_html( array( 'img' ) )
				)
			);

			if ( $attachment_ids ) {
				$loop = 0;

				foreach ( $attachment_ids as $attachment_id ) {

					$props = wc_get_product_attachment_props( $attachment_id, $post );

					if ( ! $props['url'] ) {
						continue;
					}

					echo sprintf(
						'<li class="%s">%s</li>',
						'woocommerce-product-gallery__image',
						wp_get_attachment_image( $attachment_id, 'shop_single', 0, $props )
					);

					$loop++;
				}
			}
		} else {
			echo sprintf( '<li><img src="%s" alt="%s" /></li>', wp_kses( wc_placeholder_img_src(), kemet_allowed_html( array( 'img' ) ) ), esc_html__( 'Placeholder', 'kemet-addons' ) );
		}
		?>
	</ul>
</div>
