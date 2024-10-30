<?php
/**
 * Create Widget Class.
 *
 * @package Kemet Addons
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class.
if ( ! class_exists( 'Kemet_Addon_Create_Widget' ) ) {

	/**
	 * Create Widget
	 */
	class Kemet_Addon_Create_Widget extends WP_Widget {

		/**
		 * Constans
		 *
		 * @var string
		 */
		public $unique = '';

		/**
		 * Args
		 *
		 * @var array
		 */
		public $args = array(
			'title'       => '',
			'classname'   => '',
			'id'          => '',
			'description' => '',
			'width'       => '',
			'defaults'    => array(),
			'fields'      => array(),
			'class'       => '',
		);

		/**
		 * Front function name.
		 *
		 * @var string
		 */
		public $front_end_function = '';

		/**
		 * Constructor
		 *
		 * @param string $key widget key.
		 * @param array  $params params.
		 */
		public function __construct( $key, $params ) {
			$widget_ops               = array();
			$control_ops              = array();
			$this->front_end_function = $key;
			$this->args               = apply_filters( "kfw_{$this->unique}_args", wp_parse_args( $params, $this->args ), $this );
			$this->unique             = $this->args['id'];
			// Set control options.
			if ( ! empty( $this->args['width'] ) ) {
				$control_ops['width'] = $this->args['width'];
			}

			// Set widget options.
			if ( ! empty( $this->args['description'] ) ) {
				$widget_ops['description'] = $this->args['description'];
			}

			if ( ! empty( $this->args['classname'] ) ) {
				$widget_ops['classname'] = $this->args['classname'];
			}

			// Set filters.
			$widget_ops  = apply_filters( "kfw_{$this->unique}_widget_ops", $widget_ops, $this );
			$control_ops = apply_filters( "kfw_{$this->unique}_control_ops", $control_ops, $this );
			parent::__construct( $this->unique, $this->args['title'], $widget_ops, $control_ops );
		}

		/**
		 * Register widget with WordPress
		 *
		 * @param string $key widget key.
		 * @param array  $params params.
		 * @return object
		 */
		public static function instance( $key, $params = array() ) {
			return new self( $key, $params );
		}

		/**
		 * Front-end display of widget
		 *
		 * @param object $args args.
		 * @param object $instance instance.
		 * @return void
		 */
		public function widget( $args, $instance ) {
			call_user_func( $this->front_end_function, $args, $instance, '#' . $this->id . ' ' );
		}

		/**
		 * Get Default
		 *
		 * @param string $field field.
		 * @param array  $options widget options.
		 * @return mixed
		 */
		public function get_default( $field, $options = array() ) {

			$default = ( isset( $this->args['defaults'][ $field['id'] ] ) ) ? $this->args['defaults'][ $field['id'] ] : null;
			$default = ( isset( $field['default'] ) ) ? $field['default'] : $default;
			$default = ( isset( $options[ $field['id'] ] ) ) ? $options[ $field['id'] ] : $default;

			return $default;

		}

		/**
		 * Back-end widget form
		 *
		 * @param object $instance instance.
		 * @return void
		 */
		public function form( $instance ) {
			if ( ! empty( $this->args['fields'] ) ) {

				$class = ( $this->args['class'] ) ? ' ' . $this->args['class'] : '';

				echo '<div class="kfw kfw-widgets kfw-fields' . esc_attr( $class ) . '">';

				foreach ( $this->args['fields'] as $field ) {

					$field_value  = '';
					$field_unique = '';

					if ( ! empty( $field['id'] ) ) {

						$field_value  = $this->get_default( $field, $instance );
						$field_unique = 'widget-' . $this->unique . '[' . $this->number . ']';

						if ( 'title' === $field['id'] ) {
							  $field['attributes']['id'] = 'widget-' . $this->unique . '-' . $this->number . '-title';
						}
					}

					KFW::field( $field, $field_value, $field_unique );

				}
				echo '</div>';

			}
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @param object $new_instance new instance.
		 * @param object $old_instance old instance.
		 * @return object
		 */
		public function update( $new_instance, $old_instance ) {

			// auto sanitize.
			foreach ( $this->args['fields'] as $field ) {
				if ( ! empty( $field['id'] ) && ( ! isset( $new_instance[ $field['id'] ] ) || is_null( $new_instance[ $field['id'] ] ) ) ) {
					$new_instance[ $field['id'] ] = '';
				}
			}
			$new_instance['color'] = isset( $new_instance['color'] ) ? strip_tags( $new_instance['color'] ) : '';

			$new_instance = apply_filters( 'kfw_{test}_save', $new_instance, $this->args, $this );

			do_action( "kfw_{$this->unique}_save_before", $new_instance, $this->args, $this );

			return $new_instance;

		}
	}

}
