<?php
/**
 * Template for Single post
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

?>

<div <?php kemet_blog_layout_class( 'single-layout-1' ); ?>>

	<?php kemet_single_header_before(); ?>

	<header class="entry-header <?php kemet_entry_header_class(); ?>">

		<?php kemet_single_header_top(); ?>

		<?php kemet_single_post_thumbnai_and_title_order(); ?>

		<?php kemet_single_header_bottom(); ?>

	</header><!-- .entry-header -->

	<?php kemet_single_header_after(); ?>

	<div class="entry-content clear" itemprop="text">

		<?php kemet_entry_content_before(); ?>

		<?php the_content(); ?>

		<?php
			kemet_edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'kemet-addons' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>

		<?php kemet_entry_content_after(); ?>

		<?php
			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . esc_html( kemet_theme_strings( 'string-single-page-links-before', false ) ),
					'after'       => '</div>',
					'link_before' => '<span class="page-link">',
					'link_after'  => '</span>',
				)
			);
			?>
	</div><!-- .entry-content .clear -->
</div>

<?php
if ( kemet_get_option( 'enable-author-box' ) == true ) {
	add_action( 'kemet_entry_after', 'author_box_template', 1 );
	/**
	 * Author box template
	 *
	 * @return void
	 */
	function author_box_template() {
		?>
		<section class="kmt-author-box-info"> 
			<div class="kmt-author-info">
				<div class="kmt-author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'email' ), 120 ); ?>
				</div>
				<div class="author-information">
					<h4 class='author-title'><?php echo get_the_author(); ?></h4>
					<p><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
				</div>
			</div>
		</section>
<?php }
} ?>
