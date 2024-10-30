<?php
/**
 * Posts List Widget.
 *
 * @package Kemet Addons
 */

$posts_list_widget = array(
	'title'       => __( 'Kemet Posts List', 'kemet-addons' ),
	'classname'   => 'kfw-widget-posts-list',
	'id'          => 'kemet-widget-posts-list',
	'description' => __( 'Posts List', 'kemet-addons' ),
	'fields'      => array(
		array(
			'id'      => 'title',
			'type'    => 'text',
			'title'   => __( 'Title:', 'kemet-addons' ),
			'default' => __( 'Posts List', 'kemet-addons' ),
		),
		array(
			'id'      => 'posts-number',
			'type'    => 'number',
			'title'   => __( 'Number of posts to show', 'kemet-addons' ),
			'default' => 5,
		),
		array(
			'id'      => 'posts-order',
			'type'    => 'select',
			'title'   => __( 'Posts Order', 'kemet-addons' ),
			'options' => array(
				'most-recent' => __( 'Most Recent', 'kemet-addons' ),
				'popular'     => __( 'Popular', 'kemet-addons' ),
				'random'      => __( 'Random', 'kemet-addons' ),
			),
			'default' => 'most-recent',
		),
		array(
			'id'      => 'display-thumbinals',
			'type'    => 'checkbox',
			'title'   => __( 'Display Thumbinals', 'kemet-addons' ),
			'default' => true,
		),
	),
);

if ( ! function_exists( 'kemet_widget_posts_list' ) ) {
	/**
	 * Create widget
	 *
	 * @param object $args args.
	 * @param object $instance instance.
	 * @param int    $id widget id.
	 * @return void
	 */
	function kemet_widget_posts_list( $args, $instance, $id ) {
		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . esc_html( apply_filters( 'widget_title', $instance['title'] ) ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		global $post;
		$orig_post = $post;

		$order             = isset( $instance['posts-order'] ) ? $instance['posts-order'] : 'random';
		$posts_number      = isset( $instance['posts-number'] ) ? $instance['posts-number'] : 5;
		$display_thumbnail = isset( $instance['display-thumbinals'] ) ? $instance['display-thumbinals'] : true;
		$query             = array(
			'posts_per_page'      => $posts_number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);
		switch ( $order ) {
			case 'random':
				$query['orderby'] = esc_html( 'rand' );
				break;
			case 'popular':
				$query['orderby'] = esc_html( 'comment_count' );
				break;
		}
		$all_posts = new WP_Query( $query );
		if ( $all_posts->have_posts() ) {
			?>
	<ul class="kmt-wdg-posts-list">
			<?php
			foreach ( $all_posts->posts as $q_post ) {
				$post_title = get_the_title( $q_post->ID );
				$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				?>
				<li class="kmt-wgt-post">
					<?php
					if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( $q_post->ID ) && $display_thumbnail ) {
						?>
					<div class="wgt-img">
							<a class="ttip" title="<?php echo esc_html( $title ); ?>" href="<?php the_permalink( $q_post->ID ); ?>" ><?php echo get_the_post_thumbnail( $q_post->ID, array( '50', '50' ) ); ?></a>
					</div><!-- wgt-img /-->
					<?php } ?>
					<div class="wgt-post">
						<div class="wdg-posttitle"><a href="<?php the_permalink( $q_post->ID ); ?>"><?php echo esc_html( $title ); ?></a></div>
						<small class="small"><?php echo get_the_date( '', $q_post->ID ); ?></small>
					</div>
				</li>
				<?php
			}
			?>
	</ul>
			<?php
		}
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

register_widget( Kemet_Addon_Create_Widget::instance( 'kemet_widget_posts_list', $posts_list_widget ) );
