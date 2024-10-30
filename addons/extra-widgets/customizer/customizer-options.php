<?php
/**
 * Customizer options.
 *
 * @package Kemet Addons
 */

$defaults = Kemet_Theme_Options::defaults();

/**
 * Option: Widgets Style
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[widgets-style]',
	array(
		'default'           => $defaults['widgets-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[widgets-style]',
	array(
		'type'     => 'select',
		'section'  => 'section-widgets',
		'priority' => 1,
		'label'    => __( 'Widgets Style', 'kemet-addons' ),
		'choices'  => array(
			'style1' => __( 'Style 1', 'kemet-addons' ),
			'style2' => __( 'Style 2', 'kemet-addons' ),
			'style3' => __( 'Style 3', 'kemet-addons' ),
			'style4' => __( 'Style 4', 'kemet-addons' ),
			'style5' => __( 'Style 5', 'kemet-addons' ),
			'style6' => __( 'Style 6', 'kemet-addons' ),
			'style7' => __( 'Style 7', 'kemet-addons' ),
			'style8' => __( 'Style 8', 'kemet-addons' ),
			'style9' => __( 'Style 9', 'kemet-addons' ),
		),
	)
);

/**
* Option: Widget Style Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[widget-border-color]',
	array(
		'default'           => $defaults['widget-border-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[widgets-style]/' . KEMET_THEME_SETTINGS . '[widgets-style]/' . KEMET_THEME_SETTINGS . '[widgets-style]',
			'conditions' => '!=/!=/!=',
			'values'     => 'style1/style2/style4',
			'operators'  => '&&/&&',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[widget-border-color]',
		array(
			'section'  => 'section-widgets',
			'priority' => 3,
			'label'    => __( 'Widget Border Color', 'kemet-addons' ),
		)
	)
);
/**
* Option: Widget Style Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[widget-style-bg-color]',
	array(
		'default'           => $defaults['widget-style-bg-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[widgets-style]/' . KEMET_THEME_SETTINGS . '[widgets-style]/' . KEMET_THEME_SETTINGS . '[widgets-style]',
			'conditions' => '!=/==/==',
			'values'     => 'style1/style2/style4',
			'operators'  => '&&/||',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[widget-style-bg-color]',
		array(
			'section'  => 'section-widgets',
			'priority' => 3,
			'label'    => __( 'Widget Title Background Color', 'kemet-addons' ),
		)
	)
);
/**
 * Option: Widgets Style
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[footer-widgets-style]',
	array(
		'default'           => $defaults['footer-widgets-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[footer-layout]',
			'conditions' => '!=',
			'values'     => 'disabled',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[footer-widgets-style]',
	array(
		'type'     => 'select',
		'section'  => 'section-kemet-footer',
		'priority' => 139,
		'label'    => __( 'Widgets Style', 'kemet-addons' ),
		'choices'  => array(
			''       => __( 'Default', 'kemet-addons' ),
			'style1' => __( 'Style 1', 'kemet-addons' ),
			'style2' => __( 'Style 2', 'kemet-addons' ),
			'style3' => __( 'Style 3', 'kemet-addons' ),
			'style4' => __( 'Style 4', 'kemet-addons' ),
			'style5' => __( 'Style 5', 'kemet-addons' ),
			'style6' => __( 'Style 6', 'kemet-addons' ),
			'style7' => __( 'Style 7', 'kemet-addons' ),
			'style8' => __( 'Style 8', 'kemet-addons' ),
			'style9' => __( 'Style 9', 'kemet-addons' ),
		),
	)
);
/**
* Option: Footer Widget Style Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[footer-widget-border-color]',
	array(
		'default'           => $defaults['footer-widget-border-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[footer-widgets-style]/' . KEMET_THEME_SETTINGS . '[footer-layout]/' . KEMET_THEME_SETTINGS . '[footer-widgets-style]/' . KEMET_THEME_SETTINGS . '[footer-widgets-style]',
			'conditions' => '!=/!=/!=/!=',
			'values'     => 'style1/disabled/style2/style4',
			'operators'  => '&&/&&/&&',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[footer-widget-border-color]',
		array(
			'section'  => 'section-kemet-footer',
			'priority' => 139,
			'label'    => __( 'Widget Border Color', 'kemet-addons' ),
		)
	)
);

/**
* Option: Footer Widget Style Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[footer-widget-title-bg-color]',
	array(
		'default'           => $defaults['footer-widget-title-bg-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[footer-widgets-style]/' . KEMET_THEME_SETTINGS . '[footer-layout]/' . KEMET_THEME_SETTINGS . '[footer-widgets-style]/' . KEMET_THEME_SETTINGS . '[footer-widgets-style]',
			'conditions' => '!=/!=/==/==',
			'values'     => 'style1/disabled/style2/style4',
			'operators'  => '&&/&&/||',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[footer-widget-title-bg-color]',
		array(
			'section'  => 'section-kemet-footer',
			'priority' => 139,
			'label'    => __( 'Widget Title Background Color', 'kemet-addons' ),
		)
	)
);
