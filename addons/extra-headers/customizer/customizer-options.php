<?php
/**
 * Customizer options.
 *
 * @package Kemet Addons
 */

$defaults = Kemet_Theme_Options::defaults();

/**
* Option: Header Layout
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[header-layouts]',
	array(
		'default'           => $defaults['header-layouts'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);

$wp_customize->add_control(
	new Kemet_Control_Radio_Image(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[header-layouts]',
		array(
			'section'  => 'section-header',
			'priority' => 10,
			'label'    => __( 'Kemet Headers', 'kemet-addons' ),
			'type'     => 'kmt-radio-image',
			'choices'  => array(
				'disable'              => array(
					'label' => __( 'Disable', 'kemet-addons' ),
					'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/disable.png',
				),
				'header-main-layout-1' => array(
					'label' => __( 'Header 1', 'kemet-addons' ),
					'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-01.png',
				),
				'header-main-layout-2' => array(
					'label' => __( 'Header 2', 'kemet-addons' ),
					'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-02.png',
				),
				'header-main-layout-3' => array(
					'label' => __( 'Header 3', 'kemet-addons' ),
					'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-03.png',
				),
				'header-main-layout-4' => array(
					'label' => __( 'Header 4', 'kemet-addons' ),
					'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-04.png',
				),
				'header-main-layout-5' => array(
					'label' => __( 'Header 5', 'kemet-addons' ),
					'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-05.png',
				),
				'header-main-layout-6' => array(
					'label' => __( 'Header 6', 'kemet-addons' ),
					'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-06.png',
				),
				'header-main-layout-7' => array(
					'label' => __( 'Header 7', 'kemet-addons' ),
					'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-07.png',
				),
				'header-main-layout-8' => array(
					'label' => __( 'Header 8', 'kemet-addons' ),
					'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-08.png',
				),
			),
		)
	)
);
/**
 * Option: Title
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[kmt-header-title-title]',
	array(
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '!=',
			'values'     => 'header-main-layout-6',
		),
		'sanitize_callback' => 'wp_kses',
	)
);
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-header-title-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Header Layout Settings', 'kemet-addons' ),
			'section'  => 'section-header',
			'priority' => 20,
		)
	)
);

/**
 * Option: Vertical Header Position
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[v-headers-position]',
	array(
		'default'           => $defaults['v-headers-position'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==/==',
			'values'     => 'header-main-layout-7/header-main-layout-5',
			'operators'  => '||',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[v-headers-position]',
	array(
		'type'     => 'select',
		'section'  => 'section-header',
		'priority' => 21,
		'label'    => __( 'Header Position', 'kemet-addons' ),
		'choices'  => array(
			'left'  => __( 'Left', 'kemet-addons' ),
			'right' => __( 'Right', 'kemet-addons' ),
		),
	)
);

/**
 * Option: Enter Width
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[vertical-header-width]',
	array(
		'default'           => $defaults['vertical-header-width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==',
			'values'     => 'header-main-layout-5',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[vertical-header-width]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-header',
			'priority'    => 22,
			'label'       => __( 'Vertical Header Width [PX]', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 100,
				'step' => 1,
				'max'  => 400,
			),
		)
	)
);
/**
 * Option: Enter Width
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[mini-vheader-width]',
	array(
		'default'           => $defaults['mini-vheader-width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==',
			'values'     => 'header-main-layout-7',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[mini-vheader-width]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-header',
			'priority'    => 22,
			'label'       => __( 'Vertical Header Width [PX]', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 50,
				'step' => 1,
				'max'  => 100,
			),
		)
	)
);

/**
 * Option: Vertical Headers Enable Box Shadow
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[vheader-box-shadow]',
	array(
		'default'           => $defaults['vheader-box-shadow'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==/==',
			'values'     => 'header-main-layout-7/header-main-layout-5',
			'operators'  => '||',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[vheader-box-shadow]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-header',
		'label'    => __( 'Enable Box Shadow', 'kemet-addons' ),
		'priority' => 23,
	)
);
/**
* Option: Header Width
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[header-main-layout-width]',
	array(
		'default'           => $defaults['header-main-layout-width'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '!=/!=/!=',
			'values'     => 'header-main-layout-6/header-main-layout-5/header-main-layout-7',
			'operators'  => '&&/&&',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[header-main-layout-width]',
	array(
		'type'     => 'select',
		'section'  => 'section-header',
		'priority' => 30,
		'label'    => __( 'Header Width', 'kemet-addons' ),
		'choices'  => array(
			'full'      => __( 'Full Width', 'kemet-addons' ),
			'content'   => __( 'Content Width', 'kemet-addons' ),
			'boxed'     => __( 'Boxed Content', 'kemet-addons' ),
			'stretched' => __( 'Stretched Content', 'kemet-addons' ),
		),
	)
);
/**
* Option: Header8 Logo Icon Separator Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[header-content-bg-color]',
	array(
		'default'           => $defaults['header-content-bg-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-main-layout-width]/' . KEMET_THEME_SETTINGS . '[header-main-layout-width]',
			'conditions' => '!=/!=/!=/==/==',
			'values'     => 'header-main-layout-6/header-main-layout-5/header-main-layout-7/boxed/stretched',
			'operators'  => '&&/&&/&&/||',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[header-content-bg-color]',
		array(
			'label'    => __( 'Header Content Background Color', 'kemet-addons' ),
			'section'  => 'section-header',
			'priority' => 31,
		)
	)
);
/**
* Option: Transparent header
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[enable-transparent]',
	array(
		'default'           => $defaults['enable-transparent'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '!=/!=/!=',
			'values'     => 'header-main-layout-6/header-main-layout-5/header-main-layout-7',
			'operators'  => '&&/&&',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[enable-transparent]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-header',
		'label'    => __( 'Enable Overlay Header', 'kemet-addons' ),
		'priority' => 40,
	)
);
/**
 * Option: Merge/Combine Top Bar With Main Header
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[merge-top-bar-header]',
	array(
		'default'           => $defaults['merge-top-bar-header'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[top-section-1]/' . KEMET_THEME_SETTINGS . '[top-section-2]',
			'conditions' => '!=/!=/!=/notEmpty/notEmpty',
			'values'     => 'header-main-layout-6/header-main-layout-5/header-main-layout-7//',
			'operators'  => '&&/&&/&&/||',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[merge-top-bar-header]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-header',
		'label'    => __( 'Merge/Combine Top Bar With Main Header', 'kemet-addons' ),
		'priority' => 41,
	)
);
// Header8.
/**
 * Option: Disable Logo Icon Separator
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[disable-logo-icon-separator]',
	array(
		'default'           => $defaults['disable-logo-icon-separator'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==',
			'values'     => 'header-main-layout-8',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[disable-logo-icon-separator]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-header',
		'label'    => __( 'Disable Logo Icon Separator', 'kemet-addons' ),
		'priority' => 42,
	)
);
/**
* Option: Header8 Logo Icon Separator Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[logo-icon-separator-color]',
	array(
		'default'           => $defaults['logo-icon-separator-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[disable-logo-icon-separator]',
			'conditions' => '==/!=',
			'values'     => 'header-main-layout-8/' . true,
			'operators'  => '&&',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[logo-icon-separator-color]',
		array(
			'label'    => __( 'Logo Icon Separator Color', 'kemet-addons' ),
			'section'  => 'section-header',
			'priority' => 43,
		)
	)
);
	/**
 * Option: Separator Height
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[header-separator-height]',
	array(
		'default'           => $defaults['header-separator-height'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[disable-logo-icon-separator]',
			'conditions' => '==/!=',
			'values'     => 'header-main-layout-8/' . true,
			'operators'  => '&&',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[header-separator-height]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-header',
			'priority'    => 44,
			'label'       => __( 'Logo Icon Separator Height', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 50,
			),
		)
	)
);

/**
* Option: Title
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[kmt-header-hamburger-style]',
	array(
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==/==/==/==',
			'values'     => 'header-main-layout-4/header-main-layout-6/header-main-layout-7/header-main-layout-8',
			'operators'  => '||/||/||',
		),
		'sanitize_callback' => 'wp_kses',
	)
);
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-header-hamburger-style]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Hamburger Menu Style', 'kemet-addons' ),
			'section'  => 'section-menu-header',
			'priority' => 56,
		)
	)
);

/**
 * Option:Vertical menu items border bottom color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[vertical-menu-items-border-color]',
	array(
		'default'           => $defaults['vertical-menu-items-border-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==/==/==/==',
			'values'     => 'header-main-layout-5/header-main-layout-6/header-main-layout-7/header-main-layout-7',
			'operators'  => '||/||/||',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[vertical-menu-items-border-color]',
		array(
			'label'    => __( 'Link Border Bottom Color', 'kemet-addons' ),
			'priority' => 55,
			'section'  => 'section-menu-header',
		)
	)
);

/**
 * Option: Icon Label
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[header-icon-label]',
	array(
		'default'           => $defaults['header-icon-label'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==/==',
			'values'     => 'header-main-layout-4/header-main-layout-6',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[header-icon-label]',
	array(
		'section'  => 'section-menu-header',
		'priority' => 56,
		'label'    => __( 'Hamburger Menu Label', 'kemet-addons' ),
		'type'     => 'text',
	)
);
/**
* Option: Colors
*/
$fields = array(

	/**
	* Option - Color
	*/
	array(
		'id'           => '[header-icon-label-color]',
		'default'      => $defaults ['header-icon-label-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Label Color', 'kemet-addons' ),
		'priority'     => 1,
		'section'      => 'section-menu-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[header-icon-bars-color]',
		'default'      => $defaults ['header-icon-bars-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Icon Color', 'kemet-addons' ),
		'priority'     => 2,
		'section'      => 'section-menu-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[header-icon-bars-bg-color]',
		'default'      => $defaults ['header-icon-bars-bg-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Background Color', 'kemet-addons' ),
		'priority'     => 3,
		'section'      => 'section-menu-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	/**
	* Option - Hover Color
	*/
	array(
		'id'           => '[header-icon-label-hover-color]',
		'default'      => $defaults ['header-icon-label-hover-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Label Color', 'kemet-addons' ),
		'priority'     => 4,
		'section'      => 'section-menu-header',
		'tab'          => __( 'Hover', 'kemet-addons' ),
	),
	array(
		'id'           => '[header-icon-bars-h-color]',
		'default'      => $defaults ['header-icon-bars-h-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Icon Color', 'kemet-addons' ),
		'priority'     => 5,
		'section'      => 'section-menu-header',
		'tab'          => __( 'Hover', 'kemet-addons' ),
	),
	array(
		'id'           => '[header-icon-bars-bg-h-color]',
		'default'      => $defaults ['header-icon-bars-bg-h-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Background Color', 'kemet-addons' ),
		'priority'     => 5,
		'section'      => 'section-menu-header',
		'tab'          => __( 'Hover', 'kemet-addons' ),
	),
);
$group_settings = array(
	'parent_id'  => KEMET_THEME_SETTINGS . '[kmt-hamburger-menu-colors]',
	'type'       => 'kmt-group',
	'label'      => __( 'Hamburger Menu Colors', 'kemet-addons' ),
	'section'    => 'section-menu-header',
	'priority'   => 56,
	'settings'   => array(),
	'dependency' => array(
		'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]',
		'conditions' => '==/==/==/==',
		'values'     => 'header-main-layout-4/header-main-layout-6/header-main-layout-7/header-main-layout-8',
		'operators'  => '||/||/||',
	),
);
new Kemet_Generate_Control_Group( $wp_customize, $group_settings, $fields );
	/**
 * Option: Icon Border Radius
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[header-icon-bars-border-radius]',
	array(
		'default'           => $defaults['header-icon-bars-border-radius'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==/==/==/==',
			'values'     => 'header-main-layout-4/header-main-layout-6/header-main-layout-7/header-main-layout-8',
			'operators'  => '||/||/||',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[header-icon-bars-border-radius]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-menu-header',
			'priority'    => 56,
			'label'       => __( 'Hamburger Menu Border Radius[PX]', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 100,
			),
		)
	)
);

/**
* Option - Menu Icon Spacing
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[menu-icon-bars-space]',
	array(
		'default'           => $defaults['menu-icon-bars-space'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==/==/==/==',
			'values'     => 'header-main-layout-4/header-main-layout-6/header-main-layout-7/header-main-layout-8',
			'operators'  => '||/||/||',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[menu-icon-bars-space]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-menu-header',
			'priority'       => 56,
			'label'          => __( 'Hamburger Menu Spacing', 'kemet-addons' ),
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
* Option: Icon Background Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[header-icon-bars-logo-bg-color]',
	array(
		'default'           => $defaults['header-icon-bars-logo-bg-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==',
			'values'     => 'header-main-layout-4',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[header-icon-bars-logo-bg-color]',
		array(
			'label'    => __( 'Logo and Hamburger Menu Background Color', 'kemet-addons' ),
			'section'  => 'section-menu-header',
			'priority' => 56,
		)
	)
);

$wp_customize->selective_refresh->add_partial(
	'header-icon-bars-logo-bg-color',
	array(
		'selector'            => '.main-header-container.logo-menu-icon',
		'settings'            => array(
			'header-icon-bars-logo-bg-color',
		),
		'render_callback'     => 'panel-layout',
		'container_inclusive' => true,
	)
);


/**
 * Option: Vertical Headers Border Style
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[vheader-border-style]',
	array(
		'default'           => $defaults['vheader-border-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-layouts]',
			'conditions' => '==/==',
			'values'     => 'header-main-layout-7/header-main-layout-5',
			'operators'  => '||',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[vheader-border-style]',
	array(
		'type'     => 'select',
		'section'  => 'section-header',
		'priority' => 75,
		'label'    => __( 'Border Type', 'kemet-addons' ),
		'choices'  => array(
			'hidden' => __( 'Hidden', 'kemet-addons' ),
			'dotted' => __( 'Dotted', 'kemet-addons' ),
			'dashed' => __( 'Dashed', 'kemet-addons' ),
			'solid'  => __( 'Solid', 'kemet-addons' ),
			'double' => __( 'Double', 'kemet-addons' ),
			'groove' => __( 'Groove', 'kemet-addons' ),
			'ridge'  => __( 'Ridge', 'kemet-addons' ),
			'inset'  => __( 'Inset', 'kemet-addons' ),
			'outset' => __( 'Outset', 'kemet-addons' ),
		),
	)
);


