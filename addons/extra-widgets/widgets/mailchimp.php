<?php
/**
 * Mailchimp Widget.
 *
 * @package Kemet Addons
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mail_chimp_widgets = array(
	'title'       => __( 'Kemet Mailchimp', 'kemet-addons' ),
	'classname'   => 'kfw-widget-mail-chimp',
	'id'          => 'kemet-widget-mail-chimp',
	'description' => __( 'Mailchimp subscribe widget', 'kemet-addons' ),
	'fields'      => array(
		array(
			'id'      => 'title',
			'type'    => 'text',
			'title'   => __( 'Title:', 'kemet-addons' ),
			'default' => __( 'Subscribe', 'kemet-addons' ),
		),
		array(
			'id'    => 'description',
			'type'  => 'textarea',
			'title' => __( 'Description', 'kemet-addons' ),
		),
		array(
			'id'      => 'button-align',
			'type'    => 'select',
			'title'   => __( 'Align button', 'kemet-addons' ),
			'options' => array(
				'left'   => __( 'Left', 'kemet-addons' ),
				'center' => __( 'Center', 'kemet-addons' ),
				'right'  => __( 'Right', 'kemet-addons' ),
			),
			'default' => 'left',
		),
	),
);

if ( ! function_exists( 'kemet_widget_mail_chimp' ) ) {
	/**
	 * Create widget
	 *
	 * @param object $args args.
	 * @param object $instance instance.
	 * @param int    $id widget id.
	 * @return void
	 */
	function kemet_widget_mail_chimp( $args, $instance, $id ) {
		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . esc_html( apply_filters( 'widget_title', $instance['title'] ) ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		$submit_text  = isset( $instance['submit-text'] ) ? $instance['submit-text'] : 'Subscribe';
		$decription   = isset( $instance['description'] ) ? $instance['description'] : '';
		$button_align = isset( $instance['button-align'] ) ? $instance['button-align'] : 'left';
		$align        = '';
		switch ( $button_align ) {
			case 'left':
				$align = 'margin-left: 0';
				break;
			case 'right':
				$align = 'margin-left: auto; margin-right: 0';
				break;
			case 'center':
				$align = 'margin: auto';
				break;
		}
		$list = kemet_get_integration( 'kmt-mailchimp-list-id' );

		$output  = '';
		$output .= '<div class="mailchimp-form">';
		$output .= '<div class="mailchimp-description">';
		$output .= esc_html( $decription );
		$output .= '</div>';
		$output .= '<form class="kmt-mailchimp-form" name="kmt-mailchimp-form" action="' . esc_url( admin_url( 'admin-ajax.php' ) ) . '" method="POST">';
		$output .= '<div>';
		$output .= '<input type="text" value="" name="email" placeholder="' . esc_html__( 'Email', 'kemet-addons' ) . '">';
		$output .= '<span class="alert warning">' . esc_html__( 'Invalid or empty email', 'kemet-addons' ) . '</span>';
		$output .= '</div>';

		$output .= '<div class="send-div">';
		$output .= '<button type="submit" class="button" style="' . esc_attr( $align ) . '" name="subscribe">' . esc_html( $submit_text ) . '</button>';
		$output .= '<div class="sending"></div>';
		$output .= '</div>';

		$output .= '<div class="kmt-mailchimp-success alert final success">' . esc_html__( 'You have successfully subscribed to the newsletter.', 'kemet-addons' ) . '</div>';
		$output .= '<div class="kmt-mailchimp-error alert final error">' . esc_html__( 'Something went wrong. Your subscription failed.', 'kemet-addons' ) . '</div>';

		$output .= '<input type="hidden" value="' . $list . '" name="list">';
		$output .= '<input type="hidden" name="action" value="kmt_mailchimp" />';
		$output .= wp_nonce_field( 'kmt_mailchimp_action', 'kmt_mailchimp_nonce', false, false );

		$output .= '</form>';
		$output .= '</div>';

		$html_args          = kemet_allowed_html( array( 'div', 'span', 'button' ) );
		$html_args['form']  = array(
			'class'  => true,
			'name'   => true,
			'action' => true,
			'method' => true,
		);
		$html_args['input'] = array(
			'class'       => true,
			'type'        => true,
			'value'       => true,
			'name'        => true,
			'placeholder' => true,
		);
		echo wp_kses(
			$output,
			$html_args
		);?>

		<?php
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

register_widget( Kemet_Addon_Create_Widget::instance( 'kemet_widget_mail_chimp', $mail_chimp_widgets ) );
