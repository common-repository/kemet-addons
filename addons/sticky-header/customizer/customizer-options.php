<?php
/**
 * Customizer options.
 *
 * @package Kemet Addons
 */

$defaults = Kemet_Theme_Options::defaults();
/**
 * Option: Enable Sticky Header
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[enable-sticky]',
	array(
		'default'           => $defaults['enable-sticky'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[enable-sticky]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-sticky-header',
		'label'    => __( 'Enable Sticky Header', 'kemet-addons' ),
		'priority' => 5,
	)
);

/**
 * Option: Enable Sticky Top Bar
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sticky-top-bar]',
	array(
		'default'           => $defaults['sticky-top-bar'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]/' . KEMET_THEME_SETTINGS . '[top-section-1]/' . KEMET_THEME_SETTINGS . '[top-section-2]',
			'conditions' => '==/notEmpty/notEmpty',
			'values'     => true . '//',
			'operators'  => '&&/||',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[sticky-top-bar]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-sticky-header',
		'label'    => __( 'Enable Sticky Top Bar', 'kemet-addons' ),
		'priority' => 5,
	)
);

/**
 * Option: Title
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[kmt-sticky-header]',
	array(
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
			'conditions' => '==',
			'values'     => true,
		),
		'sanitize_callback' => 'wp_kses',
	)
);
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-sticky-header]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Sticky Header Logo Settings', 'kemet-addons' ),
			'section'  => 'section-sticky-header',
			'priority' => 15,
			'settings' => array(),
		)
	)
);

/**
 * Option: Logo Image
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sticky-logo]',
	array(
		'default'           => $defaults['sticky-logo'],
		'type'              => 'option',
		'sanitize_callback' => 'esc_url_raw',
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
			'conditions' => '==',
			'values'     => true,
		),
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[sticky-logo]',
		array(
			'section'        => 'section-sticky-header',
			'priority'       => 20,
			'label'          => __( 'Logo Image', 'kemet-addons' ),
			'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
		)
	)
);

/**
 * Option: Sticky Logo Width
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sticky-logo-width]',
	array(
		'default'           => $defaults['sticky-logo-width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
			'conditions' => '==',
			'values'     => true,
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[sticky-logo-width]',
		array(
			'type'         => 'kmt-responsive-slider',
			'section'      => 'section-sticky-header',
			'priority'     => 25,
			'label'        => __( 'Logo Width', 'kemet-addons' ),
			'unit_choices' => array(
				'px' => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 300,
				),
				'em' => array(
					'min'  => 0.1,
					'step' => 0.1,
					'max'  => 10,
				),
				'%'  => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 100,
				),
			),
		)
	)
);

/**
 * Option: Sticky Border Size
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sticky-border-width]',
	array(
		'default'           => $defaults['sticky-border-width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
			'conditions' => '==',
			'values'     => true,
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[sticky-border-width]',
		array(
			'type'         => 'kmt-responsive-slider',
			'section'      => 'section-sticky-header',
			'priority'     => 26,
			'label'        => __( 'border Width', 'kemet-addons' ),
			'unit_choices' => array(
				'px' => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 15,
				),
			),
		)
	)
);

/**
 * Option: Title
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[kmt-sticky-header-style]',
	array(
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
			'conditions' => '==',
			'values'     => true,
		),
		'sanitize_callback' => 'wp_kses',
	)
);
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-sticky-header-style]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Sticky Header Style', 'kemet-addons' ),
			'section'  => 'section-sticky-header',
			'priority' => 35,
			'settings' => array(),
		)
	)
);

/**
 * Option:Enable Box Shadow
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sticky-header-box-shadow]',
	array(
		'default'           => $defaults['sticky-header-box-shadow'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
			'conditions' => '==',
			'values'     => true,
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[sticky-header-box-shadow]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-sticky-header',
		'label'    => __( 'Enable Box Shadow', 'kemet-addons' ),
		'priority' => 36,
	)
);

/**
* Option: Sticky Header Background
*/
$fields = array(
	array(
		'id'           => '[sticky-bg-obj]',
		'default'      => $defaults['sticky-bg-obj'],
		'type'         => 'option',
		'control_type' => 'kmt-background',
		'section'      => 'section-sticky-header',
		'priority'     => 1,
		'transport'    => 'postMessage',
	),

);
$group_settings = array(
	'parent_id'  => KEMET_THEME_SETTINGS . '[kmt-sticky-bg-obj]',
	'type'       => 'kmt-group',
	'label'      => __( 'Sticky Header Background', 'kemet-addons' ),
	'section'    => 'section-sticky-header',
	'priority'   => 37,
	'settings'   => array(),
	'dependency' => array(
		'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
		'conditions' => '==',
		'values'     => true,
	),
);
new Kemet_Generate_Control_Group( $wp_customize, $group_settings, $fields );

/**
* Option: Colors
*/
$fields = array(

	/**
	* Option - Color
	*/
	array(
		'id'           => '[sticky-menu-link-color]',
		'default'      => $defaults ['sticky-menu-link-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Link Color', 'kemet-addons' ),
		'priority'     => 1,
		'section'      => 'section-sticky-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[sticky-border-bottom-color]',
		'default'      => $defaults ['sticky-border-bottom-color'],
		'type'         => 'option',
		'control_type' => 'kmt-color',
		'transport'    => 'postMessage',
		'label'        => __( 'Border Bottom Color', 'kemet-addons' ),
		'priority'     => 2,
		'section'      => 'section-sticky-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[sticky-submenu-bg-color]',
		'default'      => $defaults ['sticky-submenu-bg-color'],
		'type'         => 'option',
		'control_type' => 'kmt-color',
		'label'        => __( 'Submenu Background Color', 'kemet-addons' ),
		'priority'     => 3,
		'section'      => 'section-sticky-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[sticky-submenu-link-color]',
		'default'      => $defaults ['sticky-submenu-link-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Submenu Link Color', 'kemet-addons' ),
		'priority'     => 4,
		'section'      => 'section-sticky-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[sticky-submenu-border-color]',
		'default'      => $defaults ['sticky-submenu-border-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Submenu Border Color', 'kemet-addons' ),
		'priority'     => 5,
		'section'      => 'section-sticky-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	/**
			* Option - Hover Color
			*/
		array(
			'id'           => '[sticky-menu-link-h-color]',
			'default'      => $defaults ['sticky-menu-link-h-color'],
			'type'         => 'option',
			'transport'    => 'postMessage',
			'control_type' => 'kmt-color',
			'label'        => __( 'Link Color', 'kemet-addons' ),
			'priority'     => 6,
			'section'      => 'section-sticky-header',
			'tab'          => __( 'Hover', 'kemet-addons' ),
		),
	array(
		'id'           => '[sticky-submenu-link-h-color]',
		'default'      => $defaults ['sticky-submenu-link-h-color'],
		'type'         => 'option',
		'control_type' => 'kmt-color',
		'label'        => __( 'Submenu Link Color', 'kemet-addons' ),
		'priority'     => 7,
		'section'      => 'section-sticky-header',
		'tab'          => __( 'Hover', 'kemet-addons' ),
	),
);
$group_settings = array(
	'parent_id'  => KEMET_THEME_SETTINGS . '[kmt-sticky-header-colors]',
	'type'       => 'kmt-group',
	'label'      => __( 'Sticky Header Colors', 'kemet-addons' ),
	'section'    => 'section-sticky-header',
	'priority'   => 40,
	'settings'   => array(),
	'dependency' => array(
		'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
		'conditions' => '==',
		'values'     => true,
	),
);
new Kemet_Generate_Control_Group( $wp_customize, $group_settings, $fields );

/**
 * Option:Sticky Responsive
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sticky-responsive]',
	array(
		'default'           => $defaults['sticky-responsive'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
			'conditions' => '==',
			'values'     => true,
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[sticky-responsive]',
	array(
		'priority' => 75,
		'section'  => 'section-sticky-header',
		'type'     => 'select',
		'label'    => __( 'Sticky Header Visibility', 'kemet-addons' ),
		'choices'  => array(
			'all-devices'               => __( 'Show on All Devices', 'kemet-addons' ),
			'sticky-hide-tablet'        => __( 'Hide on Tablet', 'kemet-addons' ),
			'sticky-hide-mobile'        => __( 'Hide on Mobile', 'kemet-addons' ),
			'sticky-hide-tablet-mobile' => __( 'Hide on Tablet and Mobile', 'kemet-addons' ),
		),
	)
);

/**
 * Option:Sticky Responsive
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sticky-style]',
	array(
		'default'           => $defaults['sticky-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
			'conditions' => '==',
			'values'     => true,
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[sticky-style]',
	array(
		'priority' => 80,
		'section'  => 'section-sticky-header',
		'type'     => 'select',
		'label'    => __( 'Sticky Header Entrance Animation', 'kemet-addons' ),
		'choices'  => array(
			'sticky-fade'  => __( 'Fade', 'kemet-addons' ),
			'sticky-slide' => __( 'Slide', 'kemet-addons' ),
		),
	)
);

/**
* Option - Sticky Header Spacing
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sticky-header-padding]',
	array(
		'default'           => $defaults['sticky-header-padding'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
			'conditions' => '==',
			'values'     => true,
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[sticky-header-padding]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-sticky-header',
			'priority'       => 90,
			'label'          => __( 'Padding', 'kemet-addons' ),
			'linked_choices' => true,
			'unit_choices'   => array( 'px', 'em', '%' ),
			'choices'        => array(
				'top'    => __( 'Top', 'kemet-addons' ),
				'right'  => __( 'Right', 'kemet-addons' ),
				'bottom' => __( 'Bottom', 'kemet-addons' ),
				'left'   => __( 'Left', 'kemet-addons' ),
			),
		)
	)
);

/**
* Option - Site Identity Padding
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sticky-site-identity-spacing]',
	array(
		'default'           => $defaults['sticky-site-identity-spacing'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
			'conditions' => '==',
			'values'     => true,
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[sticky-site-identity-spacing]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-sticky-header',
			'priority'       => 95,
			'label'          => __( 'Logo Padding', 'kemet-addons' ),
			'linked_choices' => true,
			'unit_choices'   => array( 'px', 'em', '%' ),
			'choices'        => array(
				'top'    => __( 'Top', 'kemet-addons' ),
				'right'  => __( 'Right', 'kemet-addons' ),
				'bottom' => __( 'Bottom', 'kemet-addons' ),
				'left'   => __( 'Left', 'kemet-addons' ),
			),
		)
	)
);

/**
* Option - Menu Item Padding
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sticky-menu-item-spacing]',
	array(
		'default'           => $defaults['sticky-menu-item-spacing'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-sticky]',
			'conditions' => '==',
			'values'     => true,
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[sticky-menu-item-spacing]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-sticky-header',
			'priority'       => 100,
			'label'          => __( 'Menu Item Padding', 'kemet-addons' ),
			'linked_choices' => true,
			'unit_choices'   => array( 'px', 'em', '%' ),
			'choices'        => array(
				'top'    => __( 'Top', 'kemet-addons' ),
				'right'  => __( 'Right', 'kemet-addons' ),
				'bottom' => __( 'Bottom', 'kemet-addons' ),
				'left'   => __( 'Left', 'kemet-addons' ),
			),
		)
	)
);
