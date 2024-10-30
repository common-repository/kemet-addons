<?php
/**
 * Top Bar Section Customizer
 *
 * @package Kemet Addons
 */

$defaults = Kemet_Theme_Options::defaults();

/**
 * Option: Top Bar Section 1 Item/s
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[top-section-1]',
	array(
		'default'           => $defaults['top-section-1'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Sortable(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[top-section-1]',
		array(
			'type'     => 'kmt-sortable',
			'section'  => 'section-topbar-header',
			'priority' => 5,
			'label'    => __( 'Top Bar Section 1 Item/s', 'kemet-addons' ),
			'choices'  => array(
				'search'    => __( 'Search', 'kemet-addons' ),
				'menu'      => __( 'Menu', 'kemet-addons' ),
				'widget'    => __( 'Widget', 'kemet-addons' ),
				'text-html' => __( 'Text/HTML', 'kemet-addons' ),
			),
		)
	)
);

/**
 * Option: Right Section Text / HTML
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[top-section-1-html]',
	array(
		'default'           => $defaults['top-section-1-html'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[top-section-1]',
			'conditions' => 'inarray',
			'values'     => 'text-html',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[top-section-1-html]',
	array(
		'type'     => 'textarea',
		'section'  => 'section-topbar-header',
		'priority' => 10,
		'label'    => __( 'Custom Text/HTML', 'kemet-addons' ),
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		KEMET_THEME_SETTINGS . '[topbar-section-1-html]',
		array(
			'selector'            => '.kemet-top-header-section-1',
			'container_inclusive' => true,
			'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_topbar_section_1_html' ),
		)
	);
}

/**
 * Option: Top Bar Section 1 Item/s Alignment
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[section1-content-align]',
	array(
		'default'           => $defaults['section1-content-align'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_icon_select' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[top-section-1]',
			'conditions' => 'notEmpty',
			'values'     => '',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Icon_Select(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[section1-content-align]',
		array(
			'priority' => 15,
			'section'  => 'section-topbar-header',
			'label'    => __( 'Section 1 Item/s Alignment', 'kemet-addons' ),
			'choices'  => array(
				'flex-start' => array(
					'icon' => 'dashicons-editor-alignleft',
				),
				'center'     => array(
					'icon' => 'dashicons-editor-aligncenter',
				),
				'flex-end'   => array(
					'icon' => 'dashicons-editor-alignright',
				),
			),
		)
	)
);

/**
 * Option: Top Bar Section 2 Item/s
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[top-section-2]',
	array(
		'default'           => $defaults['top-section-2'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Sortable(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[top-section-2]',
		array(
			'type'     => 'kmt-sortable',
			'section'  => 'section-topbar-header',
			'priority' => 20,
			'label'    => __( 'Top Bar Section 2 Item/s', 'kemet-addons' ),
			'choices'  => array(
				'search'    => __( 'Search', 'kemet-addons' ),
				'menu'      => __( 'Menu', 'kemet-addons' ),
				'widget'    => __( 'Widget', 'kemet-addons' ),
				'text-html' => __( 'Text/HTML', 'kemet-addons' ),
			),
		)
	)
);

/**
 * Option: Right Section Text / HTML
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[top-section-2-html]',
	array(
		'default'           => $defaults['top-section-2-html'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[top-section-2]',
			'conditions' => 'inarray',
			'values'     => 'text-html',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[top-section-2-html]',
	array(
		'type'     => 'textarea',
		'section'  => 'section-topbar-header',
		'priority' => 25,
		'label'    => __( 'Custom Text/HTML', 'kemet-addons' ),
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		KEMET_THEME_SETTINGS . '[top-section-2-html]',
		array(
			'selector'            => '.kemet-top-header-section-2',
			'container_inclusive' => true,
			'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_topbar_section_2_html' ),
		)
	);
}

/**
 * Option: Top Bar Section 2 Item/s Alignment
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[section2-content-align]',
	array(
		'default'           => $defaults['section2-content-align'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_icon_select' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[top-section-2]',
			'conditions' => 'notEmpty',
			'values'     => '',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Icon_Select(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[section2-content-align]',
		array(
			'priority' => 28,
			'section'  => 'section-topbar-header',
			'label'    => __( 'Section 2 Item/s Alignment', 'kemet-addons' ),
			'choices'  => array(
				'flex-start' => array(
					'icon' => 'dashicons-editor-alignleft',
				),
				'center'     => array(
					'icon' => 'dashicons-editor-aligncenter',
				),
				'flex-end'   => array(
					'icon' => 'dashicons-editor-alignright',
				),
			),
		)
	)
);

/**
 * Option: Title
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-top-bar-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Top Bar Settings', 'kemet-addons' ),
			'section'  => 'section-topbar-header',
			'priority' => 30,
			'settings' => array(),
		)
	)
);

/**
* Option - Top Bar Spacing
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[topbar-item-padding]',
	array(
		'default'           => $defaults['topbar-item-padding'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[topbar-item-padding]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-topbar-header',
			'priority'       => 35,
			'label'          => __( 'Item Spacing', 'kemet-addons' ),
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
* Option - Top Bar Spacing
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[topbar-padding]',
	array(
		'default'           => $defaults['topbar-padding'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[topbar-padding]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-topbar-header',
			'priority'       => 33,
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
* Option - Top Bar Spacing
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[topbar-border-size]',
	array(
		'default'           => $defaults['topbar-border-size'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[topbar-border-size]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-topbar-header',
			'priority'       => 40,
			'label'          => __( 'Border Size', 'kemet-addons' ),
			'linked_choices' => true,
			'unit_choices'   => array( 'px' ),
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
* Option: Typography
*/
$fields = array(
	/**
	* Option: Top Bar Font Size
	*/
	array(
		'id'           => '[topbar-font-size]',
		'default'      => $defaults ['topbar-font-size'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-topbar-header',
		'priority'     => 2,
		'label'        => __( 'Font Size', 'kemet-addons' ),
		'unit_choices' => array(
			'px' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 200,
			),
			'em' => array(
				'min'  => 0.1,
				'step' => 0.1,
				'max'  => 10,
			),
		),
	),
	/**
	 * Option: Font Family
	 */
	array(
		'id'           => '[top-bar-font-family]',
		'default'      => $defaults['top-bar-font-family'],
		'type'         => 'option',
		'control_type' => 'kmt-font-family',
		'label'        => __( 'Font Family', 'kemet-addons' ),
		'section'      => 'section-topbar-header',
		'priority'     => 3,
		'connect'      => KEMET_THEME_SETTINGS . '[top-bar-font-weight]',
	),
	/**
	 * Option: Font Weight
	 */
	array(
		'id'           => '[top-bar-font-weight]',
		'default'      => $defaults['top-bar-font-weight'],
		'type'         => 'option',
		'control_type' => 'kmt-font-weight',
		'label'        => __( 'Font Weight', 'kemet-addons' ),
		'section'      => 'section-topbar-header',
		'priority'     => 4,
		'connect'      => KEMET_THEME_SETTINGS . '[top-bar-font-family]',
	),
	/**
	* Option: Top Bar Text Transform
	*/
	array(
		'id'           => '[top-bar-text-transform]',
		'default'      => $defaults['top-bar-text-transform'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-select',
		'label'        => __( 'Text Transform', 'kemet-addons' ),
		'section'      => 'section-topbar-header',
		'priority'     => 5,
		'choices'      => array(
			''           => __( 'Default', 'kemet-addons' ),
			'none'       => __( 'None', 'kemet-addons' ),
			'capitalize' => __( 'Capitalize', 'kemet-addons' ),
			'uppercase'  => __( 'Uppercase', 'kemet-addons' ),
			'lowercase'  => __( 'Lowercase', 'kemet-addons' ),
		),
	),
	/**
	* Option: Top Bar Line Height
	*/
	array(
		'id'           => '[top-bar-line-height]',
		'default'      => $defaults ['top-bar-line-height'],
		'type'         => 'option',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-topbar-header',
		'transport'    => 'postMessage',
		'priority'     => 6,
		'label'        => __( 'Line Height', 'kemet-addons' ),
		'unit_choices' => array(
			'px' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 100,
			),
			'em' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 10,
			),
		),
	),
	/**
	* Option: Top Bar Letter Spacing
	*/
	array(
		'id'           => '[top-bar-letter-spacing]',
		'default'      => $defaults ['top-bar-letter-spacing'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-topbar-header',
		'priority'     => 7,
		'label'        => __( 'Letter Spacing', 'kemet-addons' ),
		'unit_choices' => array(
			'px' => array(
				'min'  => 0.1,
				'step' => 0.1,
				'max'  => 10,
			),
		),
	),
);
$group_settings = array(
	'parent_id' => KEMET_THEME_SETTINGS . '[kmt-top-bar-typography]',
	'type'      => 'kmt-group',
	'label'     => __( 'Typography', 'kemet-addons' ),
	'section'   => 'section-topbar-header',
	'priority'  => 45,
	'settings'  => array(),
);

new Kemet_Generate_Control_Group( $wp_customize, $group_settings, $fields );

/**
 * Option:Top Bar Responsive
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[topbar-responsive]',
	array(
		'default'           => $defaults['topbar-responsive'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[topbar-responsive]',
	array(
		'priority' => 50,
		'section'  => 'section-topbar-header',
		'type'     => 'select',
		'label'    => __( 'Visibility', 'kemet-addons' ),
		'choices'  => array(
			'all-devices'        => __( 'Show on All Devices', 'kemet-addons' ),
			'hide-tablet'        => __( 'Hide on Tablet', 'kemet-addons' ),
			'hide-mobile'        => __( 'Hide on Mobile', 'kemet-addons' ),
			'hide-tablet-mobile' => __( 'Hide on Tablet and Mobile', 'kemet-addons' ),
		),
	)
);

/**
 * Option: Title
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-top-bar-style]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Top Bar Style', 'kemet-addons' ),
			'section'  => 'section-topbar-header',
			'priority' => 55,
			'settings' => array(),
		)
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
		'id'           => '[topbar-bg-color]',
		'default'      => $defaults ['topbar-bg-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Background Color', 'kemet-addons' ),
		'priority'     => 1,
		'section'      => 'section-topbar-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[topbar-text-color]',
		'default'      => $defaults ['topbar-text-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Text Color', 'kemet-addons' ),
		'priority'     => 2,
		'section'      => 'section-topbar-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[topbar-link-color]',
		'default'      => $defaults ['topbar-link-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Link Color', 'kemet-addons' ),
		'priority'     => 3,
		'section'      => 'section-topbar-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[topbar-border-color]',
		'default'      => $defaults ['topbar-border-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Border Color', 'kemet-addons' ),
		'priority'     => 4,
		'section'      => 'section-topbar-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[topbar-submenu-bg-color]',
		'default'      => $defaults ['topbar-submenu-bg-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Submenu Background Color', 'kemet-addons' ),
		'priority'     => 5,
		'section'      => 'section-topbar-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[topbar-submenu-items-color]',
		'default'      => $defaults ['topbar-submenu-items-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Submenu Link Color', 'kemet-addons' ),
		'priority'     => 6,
		'section'      => 'section-topbar-header',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	/**
	* Option - Hover Color
	*/
	array(
		'id'           => '[topbar-link-h-color]',
		'default'      => $defaults ['topbar-link-h-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Link Color', 'kemet-addons' ),
		'priority'     => 7,
		'section'      => 'section-topbar-header',
		'tab'          => __( 'Hover', 'kemet-addons' ),
	),
	array(
		'id'           => '[topbar-submenu-items-h-color]',
		'default'      => $defaults ['topbar-submenu-items-h-color'],
		'type'         => 'option',
		'control_type' => 'kmt-color',
		'label'        => __( 'Submenu Background Color', 'kemet-addons' ),
		'priority'     => 8,
		'section'      => 'section-topbar-header',
		'tab'          => __( 'Hover', 'kemet-addons' ),
	),
);
$group_settings = array(
	'parent_id' => KEMET_THEME_SETTINGS . '[kmt-top-bar-colors]',
	'type'      => 'kmt-group',
	'label'     => __( 'Top Bar Colors', 'kemet-addons' ),
	'section'   => 'section-topbar-header',
	'priority'  => 60,
	'settings'  => array(),
);
new Kemet_Generate_Control_Group( $wp_customize, $group_settings, $fields );

/**
 * Option: Search Style
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[top-bar-search-style]',
	array(
		'default'           => $defaults['top-bar-search-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[top-bar-search-style]',
	array(
		'type'     => 'select',
		'section'  => 'section-topbar-header',
		'priority' => 100,
		'label'    => __( 'Search Box Style', 'kemet-addons' ),
		'choices'  => array(
			'search-icon' => __( 'Icon', 'kemet-addons' ),
			'search-box'  => __( 'Search Box', 'kemet-addons' ),
		),
	)
);
