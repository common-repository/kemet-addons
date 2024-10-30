<?php
/**
 * Blog Layout 1
 *
 * @package     Kemet Addons
 * @author      Kemet Addons
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

$blog_post_order = kemet_get_option( 'blog-post-structure' );
$enable_overlay  = kemet_get_option( 'overlay-image-style' );
$blog_layout     = kemet_get_option( 'blog-layouts' );
$container_class = 'blog-layout-1' == $blog_layout ? 'blog-post-layout-1' : 'blog-post-layout-2';
$divs_class      = 'blog-layout-1' == $blog_layout ? 'kmt-col-md-12' : '';
?>
<div <?php kemet_blog_layout_class( $container_class ); ?>>

	<div class="post-content <?php echo esc_attr( $divs_class ); ?>">
	<?php foreach ( $blog_post_order as $item ) { ?>
		<?php
		switch ( $item ) {
			case 'image':
				$overlay_image = 'none' != $enable_overlay ? kemet_addons_get_thumbnail_with_overlay( '<div class="kmt-blog-featured-section post-thumb ' . $divs_class . '">', '</div>' ) : kemet_get_post_thumbnail( '<div class="kmt-blog-featured-section post-thumb ' . $divs_class . '">', '</div>' );

				break;

			case 'title-meta':
				do_action( 'kemet_archive_entry_header_before' );
				?>
			
			<header class="entry-header">
					<?php

					do_action( 'kemet_archive_post_title_before' );

					/* translators: 1: Current post link, 2: Current post id */
					kemet_the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>', get_the_id() );

					do_action( 'kemet_archive_post_title_after' );

					?>
					<?php

					do_action( 'kemet_archive_post_meta_before' );

					kemet_blog_get_post_meta();

					do_action( 'kemet_archive_post_meta_after' );

					?>
			</header><!-- .entry-header -->
				<?php
				break;

			case 'content-readmore':
				do_action( 'kemet_archive_entry_header_after' );
				?>
				<div class="entry-content clear" itemprop="text">

					<?php kemet_entry_content_before(); ?>

					<?php kemet_the_excerpt(); ?>

					<?php kemet_entry_content_after(); ?>

					<?php
					wp_link_pages(
						array(
							'before'      => '<div class="page-links">' . esc_html( kemet_theme_strings( 'string-blog-page-links-before', false ) ),
							'after'       => '</div>',
							'link_before' => '<span class="page-link">',
							'link_after'  => '</span>',
						)
					);
					?>
			</div><!-- .entry-content .clear -->
				<?php
				break;
		}
		?>
		<?php } ?>
	</div><!-- .post-content -->

</div> <!-- .blog-layout-1 -->
