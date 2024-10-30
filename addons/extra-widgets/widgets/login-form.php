<?php
/**
 * Login Form widget.
 *
 * @package Kemet Addons
 */

$login_form_widgets = array(
	'title'       => __( 'Kemet Login Form', 'kemet-addons' ),
	'classname'   => 'kfw-widget-login-form',
	'id'          => 'kemet-widget-login-form',
	'description' => __( 'Login Form', 'kemet-addons' ),
	'fields'      => array(
		array(
			'id'      => 'title',
			'type'    => 'text',
			'title'   => __( 'Title:', 'kemet-addons' ),
			'default' => __( 'Login Form', 'kemet-addons' ),
		),
	),
);

if ( ! function_exists( 'kemet_widget_login_form' ) ) {
	/**
	 * Create widget
	 *
	 * @param object $args args.
	 * @param object $instance instance.
	 * @param int    $id widget id.
	 * @return void
	 */
	function kemet_widget_login_form( $args, $instance, $id ) {
		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . esc_html( apply_filters( 'widget_title', $instance['title'] ) ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		global $user_identity;
		$redirect = isset( $_SERVER['HTTP_HOST'] ) && isset( $_SERVER['REQUEST_URI'] ) ? ( is_ssl() ? 'https://' : 'http://' ) . wp_unslash( $_SERVER['HTTP_HOST'] ) . wp_unslash( $_SERVER['REQUEST_URI'] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		?>
		<?php if ( is_user_logged_in() ) : ?>
		<p><?php esc_html_e( 'You are logged in as', 'kemet-addons' ); ?> <strong><?php echo esc_html( $user_identity ); ?></strong>.</p>	
		<ul>
			<li><a href="<?php echo esc_url( get_dashboard_url() ); ?>"><?php echo esc_html__( 'Dashboard', 'kemet-addons' ); ?> </a></li>
			<li><a href="<?php echo esc_url( get_edit_user_link() ); ?>"><?php echo esc_html__( 'Your Profile', 'kemet-addons' ); ?> </a></li>
		</ul>
	<?php else : ?>
		<div>
			<?php wp_login_form( array() ); ?>
		</div>
		<ul>
			<?php if ( get_option( 'users_can_register' ) ) : ?>
				<li><a href="<?php echo esc_url( wp_registration_url() ); ?>"><?php echo esc_html__( 'Register', 'kemet-addons' ); ?></a></li>
			<?php endif; ?>
			<li><a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php echo esc_html__( 'Lost your password?', 'kemet-addons' ); ?></a></li>
		</ul>
		<?php
	endif;
	echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

register_widget( Kemet_Addon_Create_Widget::instance( 'kemet_widget_login_form', $login_form_widgets ) );
