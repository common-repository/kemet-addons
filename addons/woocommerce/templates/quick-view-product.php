<?php
/**
 * WooCommerce - Quick View Product
 *
 * @package Kemet Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

while ( have_posts() ) :
	the_post();
	?>
<div class="kmt-woo-product">
	<div id="product-<?php the_ID(); ?>" <?php post_class( 'product' ); ?>>
		<?php do_action( 'kemet_woo_qv_product_image' ); ?>
		<div class="summary entry-summary">
			<div class="summary-content">
				<?php
					/**
					 * Add Product Title on shop page for all products.
					 */
					echo sprintf( '<a href="%s">', esc_url( esc_url( get_the_permalink() ) ) );
					kemet_woo_woocommerce_template_loop_product_title();
					echo sprintf( '</a>' );

					/**
					 * Add rating on shop page for all products.
					 */
					woocommerce_template_loop_rating();

					/**
					 * Add Product Price on shop page for all products.
					 */
					woocommerce_template_loop_price();

					/**
					 * Add Product excerpt on shop page for all products.
					 */
					woocommerce_template_single_excerpt();

					/**
					 * Add Product add to cart form on shop page for all products.
					 */
					woocommerce_template_single_add_to_cart();

					/**
					 * Add Product meta on shop page for all products.
					 */
					woocommerce_template_single_meta();
				?>
			</div>
		</div>
	</div>
</div>
	<?php
endwhile; // end of the loop.
