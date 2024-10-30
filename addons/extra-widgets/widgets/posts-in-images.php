<?php
/**
 * Posts In Images Widget.
 *
 * @package Kemet Addons
 */

$categories_obj = get_categories();
$categories     = array();
foreach ( $categories_obj as $category ) {
	$categories[ $category->term_id ] = esc_html( $category->name );
}
$posts_in_images_widget = array(
	'title'       => __( 'Kemet Posts In Images', 'kemet-addons' ),
	'classname'   => 'kfw-widget-posts-images',
	'id'          => 'kemet-widget-posts-in-images',
	'description' => __( 'Posts In Images', 'kemet-addons' ),
	'fields'      => array(
		array(
			'id'      => 'title',
			'type'    => 'text',
			'title'   => __( 'Title:', 'kemet-addons' ),
			'default' => __( 'Posts In Images', 'kemet-addons' ),
		),
		array(
			'id'      => 'posts-number',
			'type'    => 'number',
			'title'   => __( 'Number of posts to show', 'kemet-addons' ),
			'default' => 12,
		),
		array(
			'id'       => 'select-category',
			'type'     => 'select',
			'title'    => __( 'Category', 'kemet-addons' ),
			'options'  => $categories,
			'multiple' => true,
			'default'  => 1,
		),
		array(
			'id'      => 'posts-order',
			'type'    => 'select',
			'title'   => __( 'Posts Order', 'kemet-addons' ),
			'options' => array(
				'most-recent' => __( 'Most Recent', 'kemet-addons' ),
				'random'      => __( 'Random', 'kemet-addons' ),
			),
			'default' => 'most-recent',
		),
	),
);

if ( ! function_exists( 'kemet_widget_posts_in_images' ) ) {
	/**
	 * Create widget
	 *
	 * @param object $args args.
	 * @param object $instance instance.
	 * @param int    $id widget id.
	 * @return void
	 */
	function kemet_widget_posts_in_images( $args, $instance, $id ) {
		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . esc_html( apply_filters( 'widget_title', $instance['title'] ) ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		global $post;
		$orig_post = $post;

		$order        = isset( $instance['posts-order'] ) ? $instance['posts-order'] : 'random';
		$category     = isset( $instance['select-category'] ) ? $instance['select-category'] : 1;
		$posts_number = isset( $instance['posts-number'] ) ? $instance['posts-number'] : 12;
		$query        = array(
			'posts_per_page'      => $posts_number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'tax_query'           => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $category,
				),
			),
		);
		if ( 'random' == $order ) {
			$query['orderby'] = esc_html( 'rand' );
		}
		$cat_posts = new WP_Query( $query );

		if ( $cat_posts->have_posts() ) {
			foreach ( $cat_posts->posts as $q_post ) {
				if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( $q_post->ID ) ) {
					$post_title = get_the_title( $q_post->ID );
					$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
					?>
		  <div class="wgt-img">
			<a class="ttip" title="<?php echo esc_html( $title ); ?>" href="<?php the_permalink( $q_post->ID ); ?>" ><?php echo get_the_post_thumbnail( $q_post->ID, array( '50', '50' ) ); ?></a>
		  </div><!-- wgt-img /-->
					<?php
				}
			}
			?>
			<?php
		}
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

register_widget( Kemet_Addon_Create_Widget::instance( 'kemet_widget_posts_in_images', $posts_in_images_widget ) );
