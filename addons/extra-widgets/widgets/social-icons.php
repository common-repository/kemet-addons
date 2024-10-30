<?php
/**
 * Social Widget.
 *
 * @package Kemet Addons
 */

require_once KEMET_WIDGETS_DIR . 'classes/class-kemet-addon-extra-widgets-partials.php';
$social_icons_widget = array(
	'title'       => __( 'Kemet Social Icons', 'kemet-addons' ),
	'classname'   => 'kwf-widget-social-icon',
	'id'          => 'kemet-widget-social-icons',
	'description' => __( 'Social Icons', 'kemet-addons' ),
	'fields'      => array(
		array(
			'id'    => 'title',
			'type'  => 'text',
			'title' => __( 'Title', 'kemet-addons' ),
		),
		array(
			'id'    => 'description',
			'type'  => 'textarea',
			'title' => __( 'Description', 'kemet-addons' ),
		),
		array(
			'id'    => 'enable-title',
			'type'  => 'switcher',
			'title' => __( 'Display Icon Title', 'kemet-addons' ),
		),
		array(
			'id'      => 'alignment',
			'type'    => 'select',
			'title'   => __( 'Alignment', 'kemet-addons' ),
			'options' => array(
				'row'    => __( 'Inline', 'kemet-addons' ),
				'column' => __( 'Stack', 'kemet-addons' ),
			),
			'default' => 'inline',
		),
		array(
			'id'         => 'align',
			'type'       => 'select',
			'title'      => __( 'Align', 'kemet-addons' ),
			'options'    => array(
				'flex-start' => __( 'Left', 'kemet-addons' ),
				'center'     => __( 'Center', 'kemet-addons' ),
				'flex-end'   => __( 'Right', 'kemet-addons' ),
			),
			'default'    => 'center',
			'dependency' => array( 'alignment', '==', 'row' ),
		),
		array(
			'id'      => 'icon-style',
			'type'    => 'select',
			'class'   => 'social-icons-icons-style',
			'title'   => __( 'Icon Style', 'kemet-addons' ),
			'options' => array(
				'simple'         => __( 'Simple', 'kemet-addons' ),
				'circle'         => __( 'Circle', 'kemet-addons' ),
				'square'         => __( 'Square', 'kemet-addons' ),
				'circle-outline' => __( 'Circle Outline', 'kemet-addons' ),
				'square-outline' => __( 'Square Outline', 'kemet-addons' ),
			),
			'default' => 'simple',
		),
		array(
			'id'    => 'icon-width',
			'type'  => 'number',
			'title' => __( 'Icon Width', 'kemet-addons' ),
			'unit'  => 'px',
		),
		array(
			'id'    => 'icon-font-size',
			'type'  => 'number',
			'title' => __( 'Font Size', 'kemet-addons' ),
			'unit'  => 'px',
		),
		array(
			'id'          => 'space-between-icon-text',
			'type'        => 'number',
			'title'       => __( 'Space Between Icon & Text:', 'kemet-addons' ),
			'unit'        => 'px',
			'output_mode' => 'padding',
			'dependency'  => array( 'enable-title', '==', 'true' ),
		),
		array(
			'id'          => 'space-between-profiles',
			'type'        => 'number',
			'title'       => __( 'Space Between Social Icons:', 'kemet-addons' ),
			'unit'        => 'px',
			'output_mode' => 'padding',
		),
		array(
			'id'                   => 'social-profile',
			'type'                 => 'group',
			'title'                => __( 'Add Icon', 'kemet-addons' ),
			'button_title'         => __( 'Add Icon', 'kemet-addons' ),
			'accordion_title_auto' => true,
			'fields'               => array(

				array(
					'id'    => 'profile-title',
					'type'  => 'text',
					'title' => __( 'Title', 'kemet-addons' ),
				),
				array(
					'id'       => 'link',
					'type'     => 'text',
					'title'    => __( 'Link', 'kemet-addons' ),
					'validate' => 'kfw_validate_url',
				),
				array(
					'id'      => 'link-target',
					'type'    => 'select',
					'title'   => __( 'Target', 'kemet-addons' ),
					'options' => array(
						'_self'  => __( 'Same Page', 'kemet-addons' ),
						'_blank' => __( 'New Page', 'kemet-addons' ),
					),
					'default' => 'new-page',
				),
				array(
					'id'           => 'social-icon',
					'type'         => 'icon',
					'button_title' => __( 'Select Icon', 'kemet-addons' ),
					'title'        => __( 'Icon', 'kemet-addons' ),
				),
				array(
					'id'    => 'icon-color',
					'type'  => 'color',
					'title' => __( 'Icon Color', 'kemet-addons' ),
				),
				array(
					'id'    => 'icon-hover-color',
					'type'  => 'color',
					'title' => __( 'Icon Hover Color', 'kemet-addons' ),
				),
				array(
					'id'    => 'icon-bg-color',
					'class' => 'icon-bg-color',
					'type'  => 'color',
					'title' => __( 'Background Color', 'kemet-addons' ),
				),
				array(
					'id'    => 'icon-hover-bg-color',
					'class' => 'icon-hover-bg-color',
					'type'  => 'color',
					'title' => __( 'Background Hover Color', 'kemet-addons' ),
				),
				array(
					'id'    => 'icon-border-color',
					'class' => 'icon-border-color',
					'type'  => 'color',
					'title' => __( 'Border Color', 'kemet-addons' ),
				),
				array(
					'id'    => 'icon-hover-border-color',
					'class' => 'icon-hover-border-color',
					'type'  => 'color',
					'title' => __( 'Border Hover Color', 'kemet-addons' ),
				),
			),
		),
	),
);

if ( ! function_exists( 'kemet_widget_social_profiles' ) ) {
	/**
	 * Create widget
	 *
	 * @param object $args args.
	 * @param object $instance instance.
	 * @param int    $id widget id.
	 * @return void
	 */
	function kemet_widget_social_profiles( $args, $instance, $id ) {
		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . esc_html( apply_filters( 'widget_title', $instance['title'] ) ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		if ( ! empty( $instance['social-profile'] ) ) {
			?>
			<?php if ( isset( $instance['description'] ) && ! empty( $instance['description'] ) ) : ?>
			<p class="kmt-social-description"><?php echo esc_html( $instance['description'] ); ?></p>
			<?php endif; ?>
			<?php if ( ! empty( $instance['social-profile'] ) ) { ?>
			<div class="kmt-social-profiles <?php echo esc_attr( $instance['icon-style'] ); ?>">
				<?php
				foreach ( $instance['social-profile'] as $profile ) {
					$link_target = isset( $profile['link-target'] ) ? $profile['link-target'] : '_blank';
					if ( ! empty( $profile['social-icon'] ) ) {
						$icon_class = explode( '-', $profile['social-icon'], 2 )[1];
					} else {
						$icon_class = '';
					}
					?>

				<a href="<?php echo esc_attr( $profile['link'] ); ?>" class="kmt-profile-link" target="<?php echo esc_attr( $link_target ); ?>">
					<span class="profile-icon <?php echo esc_attr( $icon_class ); ?>"><span class="dashicons <?php echo esc_attr( $profile['social-icon'] ); ?>"></span></span>
						<?php if ( $instance['enable-title'] ) { ?>
					<span class='profile-title'><?php echo esc_attr( $profile['profile-title'] ); ?></span>
					<?php } ?>
				</a>
				<?php } ?>
			</div>
				<?php
			}
		}
		// Css Style.
		$icon_color             = ! empty( $instance['icon-color'] ) ? $instance['icon-color'] : '';
		$icon_hover_color       = ! empty( $instance['icon-hover-color'] ) ? $instance['icon-hover-color'] : '';
		$alignment              = ! empty( $instance['alignment'] ) ? $instance['alignment'] : '';
		$align                  = ! empty( $instance['align'] ) ? $instance['align'] : 'center';
		$space_between_profiles = array();
		$spacing_direction      = '';
		if ( ! empty( $instance['space-between-profiles'] ) ) {
			switch ( $instance['alignment'] ) {
				case 'row':
					$spacing_direction      = is_rtl() ? 'left' : 'right';
					$space_between_profiles = array( 'padding-' . $spacing_direction => kemet_get_css_value( $instance['space-between-profiles'], 'px' ) );
					break;

				case 'column':
					$space_between_profiles = array( 'padding-bottom' => kemet_get_css_value( $instance['space-between-profiles'], 'px' ) );
					break;
			}
		}

		$icon_width      = ! empty( $instance['icon-width'] ) ? $instance['icon-width'] : 20;
		$font_size       = ! empty( $instance['icon-font-size'] ) ? $instance['icon-font-size'] . 'px' : 'initial';
		$space_text_icon = ! empty( $instance['space-between-icon-text'] ) ? $instance['space-between-icon-text'] : '';

		$style     = array(
			$id . '.kmt-social-profiles .kmt-profile-link .profile-icon span' => array(
				'font-size' => esc_attr( $font_size ),
			),
			$id . '.kmt-social-profiles .kmt-profile-link .profile-icon' => array(
				'width'       => kemet_get_css_value( $icon_width, 'px' ),
				'height'      => kemet_get_css_value( $icon_width, 'px' ),
				'line-height' => kemet_get_css_value( $icon_width, 'px' ),
			),
			$id . '.kmt-social-profiles .kmt-profile-link .profile-title' => array(
				'padding-' . $spacing_direction => kemet_get_css_value( $space_text_icon, 'px' ),
			),
			$id . '.kmt-social-profiles .kmt-profile-link:not(:last-child)' => $space_between_profiles,
			$id . '.kmt-social-profiles' => array(
				'flex-direction' => esc_attr( $alignment ),
			),
		);
		$parse_css = kemet_parse_css( $style );

		if ( 'row' == $instance['alignment'] ) {
			$widget_align = array(
				$id . '.kmt-social-profiles' => array(
					'justify-content' => esc_attr( $align ),
				),
			);
			$parse_css   .= kemet_parse_css( $widget_align );
		}

		if ( isset( $instance['social-profile'] ) && ! empty( $instance['social-profile'] ) ) {

			foreach ( $instance['social-profile'] as $profile ) {
				if ( ! empty( $profile['social-icon'] ) ) {
					$icon_class               = explode( '-', $profile['social-icon'], 2 )[1];
					$icon_bg_color            = ! empty( $profile['icon-bg-color'] ) ? $profile['icon-bg-color'] : '';
					$icon__hover_bg_color     = ! empty( $profile['icon-hover-bg-color'] ) ? $profile['icon-hover-bg-color'] : '';
					$border_color             = ! empty( $profile['icon-border-color'] ) ? $profile['icon-border-color'] : '';
					$icon__hover_border_color = ! empty( $profile['icon-hover-border-color'] ) ? $profile['icon-hover-border-color'] : '';

					$icons_style = array(
						$id . '.kmt-social-profiles .kmt-profile-link .profile-icon.' . esc_attr( $icon_class ) => array(
							'color' => esc_attr( $profile['icon-color'] ),
						),
						$id . '.kmt-social-profiles.circle-outline .kmt-profile-link .profile-icon.' . esc_attr( $icon_class ) . ', ' . $id . '.kmt-social-profiles.square-outline .kmt-profile-link .profile-icon.' . esc_attr( $icon_class ) => array(
							'border-color' => esc_attr( $border_color ),
						),
						$id . '.kmt-social-profiles.circle .kmt-profile-link .profile-icon.' . esc_attr( $icon_class ) . ', ' . $id . '.kmt-social-profiles.square .kmt-profile-link .profile-icon.' . esc_attr( $icon_class ) => array(
							'background-color' => esc_attr( $icon_bg_color ),
						),
						$id . '.kmt-social-profiles .kmt-profile-link .profile-icon.' . esc_attr( $icon_class ) . ':hover' => array(
							'color' => esc_attr( $profile['icon-hover-color'] ),
						),
						$id . '.kmt-social-profiles.circle-outline .kmt-profile-link .profile-icon.' . esc_attr( $icon_class ) . ':hover , ' . $id . '.kmt-social-profiles.square-outline .kmt-profile-link .profile-icon.' . esc_attr( $icon_class ) . ':hover' => array(
							'border-color' => esc_attr( $icon__hover_border_color ),
						),
						$id . '.kmt-social-profiles.circle .kmt-profile-link .profile-icon.' . esc_attr( $icon_class ) . ':hover , ' . $id . '.kmt-social-profiles.square .kmt-profile-link .profile-icon.' . esc_attr( $icon_class ) . ':hover' => array(
							'background-color' => esc_attr( $icon__hover_bg_color ),
						),
					);
				}
				$parse_css .= kemet_parse_css( $icons_style );
			}
		}
		$style_id = str_replace( array( '#', ' ' ), '', $id );
		printf(
			wp_kses(
				"<style type='text/css' class='" . $style_id . "-inline-style'>%s</style>",
				array(
					'style' => array(
						'type'  => true,
						'class' => true,
					),
				)
			),
			esc_attr( $parse_css )
		);

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

register_widget( Kemet_Addon_Create_Widget::instance( 'kemet_widget_social_profiles', $social_icons_widget ) );
