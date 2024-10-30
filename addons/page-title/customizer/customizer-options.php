<?php
/**
 * Page Title Section Customizer
 *
 * @package Kemet Addons
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$defaults = Kemet_Theme_Options::defaults();

/**
 * Option: Page Title Layouts
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[page-title-layouts]',
	array(
		'default'           => $defaults['page-title-layouts'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);

$wp_customize->add_control(
	new Kemet_Control_Radio_Image(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[page-title-layouts]',
		array(
			'section'  => 'section-page-title-header',
			'priority' => 1,
			'label'    => __( 'Page Title Layouts', 'kemet-addons' ),
			'type'     => 'kmt-radio-image',
			'choices'  => array(
				'disable'             => array(
					'label' => __( 'Disable', 'kemet-addons' ),
					'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/disable-page-title.png',
				),
				'page-title-layout-1' => array(
					'label' => __( 'Page Title Layout 1', 'kemet-addons' ),
					'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-01.png',
				),
				'page-title-layout-2' => array(
					'label' => __( 'Page Title Layout 2', 'kemet-addons' ),
					'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-02.png',
				),
				'page-title-layout-3' => array(
					'label' => __( 'Page Title Layout 3', 'kemet-addons' ),
					'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-03.png',
				),
			),
		)
	)
);

/**
 * Option: Page Title Alignment
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[page_title_alignment]',
	array(
		'default'           => $defaults['page_title_alignment'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[page-title-layouts]',
			'conditions' => '==',
			'values'     => 'page-title-layout-1',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Icon_Select(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[page_title_alignment]',
		array(
			'priority' => 5,
			'section'  => 'section-page-title-header',
			'label'    => __( 'Page Title Alignment', 'kemet-addons' ),
			'choices'  => array(
				'left'   => array(
					'icon' => 'dashicons-editor-alignleft',
				),
				'center' => array(
					'icon' => 'dashicons-editor-aligncenter',
				),
				'right'  => array(
					'icon' => 'dashicons-editor-alignright',
				),
			),
		)
	)
);
/**
 * Option: Merge Page Title with the main header
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[merge-with-header]',
	array(
		'default'           => $defaults['merge-with-header'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[merge-with-header]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-page-title-header',
		'label'    => __( 'Merge/Combine Page Title With Main Header', 'kemet-addons' ),
		'priority' => 6,

	)
);
/**
 * Option: Page Title Divider Color
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[page-title-border-right-color]',
	array(
		'default'           => $defaults['page-title-border-right-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[page-title-layouts]',
			'conditions' => '==',
			'values'     => 'page-title-layout-3',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[page-title-border-right-color]',
		array(
			'section'  => 'section-page-title-header',
			'priority' => 10,
			'label'    => __( 'Page Title Divider Color', 'kemet-addons' ),
		)
	)
);
/**
* Option: Sticky Header Background
*/
$fields = array(
	array(
		'id'           => '[page-title-bg-obj]',
		'default'      => $defaults['page-title-bg-obj'],
		'type'         => 'option',
		'control_type' => 'kmt-background',
		'section'      => 'section-page-title-header',
		'priority'     => 1,
		'transport'    => 'postMessage',
	),

);
$group_settings = array(
	'parent_id' => KEMET_THEME_SETTINGS . '[kmt-page-title-bg-obj]',
	'type'      => 'kmt-group',
	'label'     => __( 'Page Title Background', 'kemet-addons' ),
	'section'   => 'section-page-title-header',
	'priority'  => 30,
	'settings'  => array(),
);
new Kemet_Generate_Control_Group( $wp_customize, $group_settings, $fields );
/**
 * Option: Title
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-page-title-settings]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Page Title Settings', 'kemet-addons' ),
			'section'  => 'section-page-title-header',
			'priority' => 20,
			'settings' => array(),
		)
	)
);

/**
* Option - Page Title Spacing
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[page-title-space]',
	array(
		'default'           => $defaults['page-title-space'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[page-title-space]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-page-title-header',
			'priority'       => 30,
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
 * Option:Page Title Responsive
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[page-title-responsive]',
	array(
		'default'           => $defaults['page-title-responsive'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[page-title-responsive]',
	array(
		'priority' => 35,
		'section'  => 'section-page-title-header',
		'type'     => 'select',
		'label'    => __( 'Page Title Visibility', 'kemet-addons' ),
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
		KEMET_THEME_SETTINGS . '[kmt-page-title-style]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Page Title Content Style', 'kemet-addons' ),
			'section'  => 'section-page-title-header',
			'priority' => 40,
			'settings' => array(),
		)
	)
);
/**
 * Option: Page Title Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[page-title-color]',
	array(
		'default'           => $defaults['page-title-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[page-title-color]',
		array(
			'label'    => __( 'Font Color', 'kemet-addons' ),
			'priority' => 45,
			'section'  => 'section-page-title-header',
		)
	)
);
/**
* Option: Typography
*/
$fields = array(
	/**
	* Option: Page Title Font Size
	*/
	array(
		'id'           => '[page-title-font-size]',
		'default'      => $defaults ['page-title-font-size'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-page-title-header',
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
		'id'           => '[page-title-font-family]',
		'default'      => $defaults['page-title-font-family'],
		'type'         => 'option',
		'control_type' => 'kmt-font-family',
		'label'        => __( 'Font Family', 'kemet-addons' ),
		'section'      => 'section-page-title-header',
		'priority'     => 3,
		'connect'      => KEMET_THEME_SETTINGS . '[page-title-font-weight]',
	),
	/**
	 * Option: Font Weight
	 */
	array(
		'id'           => '[page-title-font-weight]',
		'default'      => $defaults['page-title-font-weight'],
		'type'         => 'option',
		'control_type' => 'kmt-font-weight',
		'label'        => __( 'Font Weight', 'kemet-addons' ),
		'section'      => 'section-page-title-header',
		'priority'     => 4,
		'connect'      => KEMET_THEME_SETTINGS . '[page-title-font-family]',
	),
	/**
	* Option: Page Title Text Transform
	*/
	array(
		'id'           => '[pagetitle-text-transform]',
		'default'      => $defaults['pagetitle-text-transform'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-select',
		'label'        => __( 'Text Transform', 'kemet-addons' ),
		'section'      => 'section-page-title-header',
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
	* Option: Page Title Font Style
	*/
	array(
		'id'           => '[pagetitle-font-style]',
		'default'      => $defaults['pagetitle-font-style'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-select',
		'label'        => __( 'Font Style', 'kemet-addons' ),
		'section'      => 'section-page-title-header',
		'priority'     => 5,
		'choices'      => array(
			'inherit' => __( 'Inherit', 'kemet-addons' ),
			'normal'  => __( 'Normal', 'kemet-addons' ),
			'italic'  => __( 'Italic', 'kemet-addons' ),
			'oblique' => __( 'Oblique', 'kemet-addons' ),
		),
	),
	/**
	* Option: Page Title Line Height
	*/
	array(
		'id'           => '[pagetitle-line-height]',
		'default'      => $defaults ['pagetitle-line-height'],
		'type'         => 'option',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-page-title-header',
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
	* Option: Page Title Letter Spacing
	*/
	array(
		'id'           => '[page-title-letter-spacing]',
		'default'      => $defaults ['page-title-letter-spacing'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-page-title-header',
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
	'parent_id' => KEMET_THEME_SETTINGS . '[kmt-page-title-typography]',
	'type'      => 'kmt-group',
	'label'     => __( 'Typography', 'kemet-addons' ),
	'section'   => 'section-page-title-header',
	'priority'  => 50,
	'settings'  => array(),
);

new Kemet_Generate_Control_Group( $wp_customize, $group_settings, $fields );
/**
 * Option: Page Title Bottom Line Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[pagetitle-bottomline-color]',
	array(
		'default'           => $defaults['pagetitle-bottomline-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[pagetitle-bottomline-color]',
		array(
			'label'    => __( 'Separator Color', 'kemet-addons' ),
			'priority' => 75,
			'section'  => 'section-page-title-header',
		)
	)
);

/**
 * Option: Separator Height
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[pagetitle-bottomline-height]',
	array(
		'default'           => $defaults['pagetitle-bottomline-height'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[pagetitle-bottomline-height]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-page-title-header',
			'priority'    => 80,
			'label'       => __( 'Separator Height', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min' => 0,
				'max' => 20,
			),
		)
	)
);

/**
 * Option: Page Title Bottom Line width
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[pagetitle-bottomline-width]',
	array(
		'default'           => $defaults['pagetitle-bottomline-width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[pagetitle-bottomline-width]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-page-title-header',
			'priority'    => 85,
			'label'       => __( 'Separator Width', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min' => 0,
				'max' => 300,
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
		KEMET_THEME_SETTINGS . '[kmt-page-sub-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Sub Title Content Style', 'kemet-addons' ),
			'section'  => 'section-page-title-header',
			'priority' => 90,
			'settings' => array(),
		)
	)
);
/**
 * Option: Sub Title Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sub-title-color]',
	array(
		'default'           => $defaults['sub-title-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[sub-title-color]',
		array(
			'label'    => __( 'Text Color', 'kemet-addons' ),
			'priority' => 95,
			'section'  => 'section-page-title-header',
		)
	)
);

/**
* Option: Typography
*/
$fields = array(
	/**
	* Option: Sub Title Font Size
	*/
	array(
		'id'           => '[sub-title-font-size]',
		'default'      => $defaults ['sub-title-font-size'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-page-title-header',
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
		'id'           => '[sub-title-font-family]',
		'default'      => $defaults['sub-title-font-family'],
		'type'         => 'option',
		'control_type' => 'kmt-font-family',
		'label'        => __( 'Font Family', 'kemet-addons' ),
		'section'      => 'section-page-title-header',
		'priority'     => 3,
		'connect'      => KEMET_THEME_SETTINGS . '[sub-title-font-weight]',
	),
	/**
	 * Option: Font Weight
	 */
	array(
		'id'           => '[sub-title-font-weight]',
		'default'      => $defaults['sub-title-font-weight'],
		'type'         => 'option',
		'control_type' => 'kmt-font-weight',
		'label'        => __( 'Font Weight', 'kemet-addons' ),
		'section'      => 'section-page-title-header',
		'priority'     => 4,
		'connect'      => KEMET_THEME_SETTINGS . '[sub-title-font-family]',
	),
	/**
	* Option: Sub Title Text Transform
	*/
	array(
		'id'           => '[sub-title-text-transform]',
		'default'      => $defaults['sub-title-text-transform'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-select',
		'label'        => __( 'Text Transform', 'kemet-addons' ),
		'section'      => 'section-page-title-header',
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
	* Option: Sub Title Line Height
	*/
	array(
		'id'           => '[sub-title-line-height]',
		'default'      => $defaults ['sub-title-line-height'],
		'type'         => 'option',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-page-title-header',
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
	* Option: Sub Title Letter Spacing
	*/
	array(
		'id'           => '[sub-title-letter-spacing]',
		'default'      => $defaults ['sub-title-letter-spacing'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-page-title-header',
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
	'parent_id' => KEMET_THEME_SETTINGS . '[kmt-sub-title-typography]',
	'type'      => 'kmt-group',
	'label'     => __( 'Typography', 'kemet-addons' ),
	'section'   => 'section-page-title-header',
	'priority'  => 100,
	'settings'  => array(),
);

new Kemet_Generate_Control_Group( $wp_customize, $group_settings, $fields );
/**
 * Option: Show item title
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[breadcrumbs-enabled]',
	array(
		'default'           => $defaults['breadcrumbs-enabled'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[breadcrumbs-enabled]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-breadcrumbs',
		'label'    => __( 'Enable Breadcrumbs', 'kemet-addons' ),
		'priority' => 1,

	)
);
/**
 * Option: Show item title
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[show-item-title]',
	array(
		'default'           => $defaults['show-item-title'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[show-item-title]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-breadcrumbs',
		'label'    => __( 'Show Current Location', 'kemet-addons' ),
		'priority' => 5,

	)
);
/**
 * Option: Breadcrumbs Separator
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[breadcrumb-prefix]',
	array(
		'default'           => $defaults['breadcrumb-prefix'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[breadcrumb-prefix]',
	array(
		'type'     => 'text',
		'section'  => 'section-breadcrumbs',
		'priority' => 10,
		'label'    => __( 'Breadcrumbs Prefix Text', 'kemet-addons' ),
	)
);

/**
* Option: Typography
*/
$fields = array(
	/**
	* Option: Breadcrumbs Font Size
	*/
	array(
		'id'           => '[breadcrumbs-font-size]',
		'default'      => $defaults ['breadcrumbs-font-size'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-breadcrumbs',
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
		'id'           => '[breadcrumbs-font-family]',
		'default'      => $defaults['breadcrumbs-font-family'],
		'type'         => 'option',
		'control_type' => 'kmt-font-family',
		'label'        => __( 'Font Family', 'kemet-addons' ),
		'section'      => 'section-breadcrumbs',
		'priority'     => 3,
		'connect'      => KEMET_THEME_SETTINGS . '[breadcrumbs-font-weight]',
	),
	/**
	 * Option: Font Weight
	 */
	array(
		'id'           => '[breadcrumbs-font-weight]',
		'default'      => $defaults['breadcrumbs-font-weight'],
		'type'         => 'option',
		'control_type' => 'kmt-font-weight',
		'label'        => __( 'Font Weight', 'kemet-addons' ),
		'section'      => 'section-breadcrumbs',
		'priority'     => 4,
		'connect'      => KEMET_THEME_SETTINGS . '[breadcrumbs-font-family]',
	),
	/**
	* Option: Breadcrumbs Text Transform
	*/
	array(
		'id'           => '[breadcrumbs-text-transform]',
		'default'      => $defaults['breadcrumbs-text-transform'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-select',
		'label'        => __( 'Text Transform', 'kemet-addons' ),
		'section'      => 'section-breadcrumbs',
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
	* Option: Breadcrumbs Line Height
	*/
	array(
		'id'           => '[breadcrumbs-line-height]',
		'default'      => $defaults ['breadcrumbs-line-height'],
		'type'         => 'option',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-breadcrumbs',
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
	* Option: Breadcrumbs Letter Spacing
	*/
	array(
		'id'           => '[breadcrumbs-letter-spacing]',
		'default'      => $defaults ['breadcrumbs-letter-spacing'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-responsive-slider',
		'section'      => 'section-breadcrumbs',
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
	'parent_id' => KEMET_THEME_SETTINGS . '[kmt-breadcrumbs-typography]',
	'type'      => 'kmt-group',
	'label'     => __( 'Typography', 'kemet-addons' ),
	'section'   => 'section-breadcrumbs',
	'priority'  => 15,
	'settings'  => array(),
);

new Kemet_Generate_Control_Group( $wp_customize, $group_settings, $fields );
/**
 * Option: Home Item
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[breadcrumb-home-item]',
	array(
		'default'           => $defaults['breadcrumb-home-item'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[breadcrumb-home-item]',
	array(
		'type'     => 'select',
		'section'  => 'section-breadcrumbs',
		'priority' => 45,
		'label'    => __( 'Home Item', 'kemet-addons' ),
		'choices'  => array(
			'text' => esc_html__( 'Text', 'kemet-addons' ),
			'icon' => esc_html__( 'Icon', 'kemet-addons' ),
		),
	)
);
/**
 * Option: Title
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-breadcrumbs-display-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Breadcrumbs Display', 'kemet-addons' ),
			'section'  => 'section-breadcrumbs',
			'priority' => 50,
			'settings' => array(),
		)
	)
);
/**
 * Option: Disable on Archive
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-archive]',
	array(
		'default'           => $defaults['disable-breadcrumbs-in-archive'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-archive]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-breadcrumbs',
		'label'    => __( 'Disable on Archive', 'kemet-addons' ),
		'priority' => 65,

	)
);
/**
 * Option: Disable on Single Page
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-single-page]',
	array(
		'default'           => $defaults['disable-breadcrumbs-in-single-page'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-single-page]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-breadcrumbs',
		'label'    => __( 'Disable on Single Page', 'kemet-addons' ),
		'priority' => 70,

	)
);
/**
 * Option: Disable on Single Post
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-single-post]',
	array(
		'default'           => $defaults['disable-breadcrumbs-in-single-post'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-single-post]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-breadcrumbs',
		'label'    => __( 'Disable on Single Post', 'kemet-addons' ),
		'priority' => 75,

	)
);
/**
 * Option: Disable on 404 Page
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-404-page]',
	array(
		'default'           => $defaults['disable-breadcrumbs-in-404-page'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-404-page]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-breadcrumbs',
		'label'    => __( 'Disable on 404 Page', 'kemet-addons' ),
		'priority' => 85,

	)
);
/**
 * Option: Breadcrumbs Separator
 */

$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[breadcrumb-separator]',
	array(
		'default'           => $defaults['breadcrumb-separator'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[breadcrumb-separator]',
	array(
		'type'     => 'text',
		'section'  => 'section-breadcrumbs',
		'priority' => 95,
		'label'    => __( 'Custom Levels Divider', 'kemet-addons' ),
	)
);

/**
 * Option: Breadcrumbs Taxonomy
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[breadcrumb-posts-taxonomy]',
	array(
		'default'           => $defaults['breadcrumb-posts-taxonomy'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[breadcrumb-posts-taxonomy]',
	array(
		'type'        => 'select',
		'section'     => 'section-breadcrumbs',
		'priority'    => 100,
		'label'       => __( 'Posts Taxonomy', 'kemet-addons' ),
		'choices'     => array(
			'category' => esc_html__( 'Category', 'kemet-addons' ),
			'post_tag' => esc_html__( 'Tag', 'kemet-addons' ),
			'blog'     => esc_html__( 'Blog Page', 'kemet-addons' ),
		),
		'description' => esc_html__( 'Choose the Taxonomy Item Parent.', 'kemet-addons' ),
	)
);

/**
* Option - Breadcrumbs Spacing
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[breadcrumbs-space]',
	array(
		'default'           => $defaults['breadcrumbs-space'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[breadcrumbs-space]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-breadcrumbs',
			'priority'       => 105,
			'label'          => __( 'Breadcrumbs Spacing', 'kemet-addons' ),
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
 * Option: Title
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-breadcrumbs-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Breadcrumbs Style', 'kemet-addons' ),
			'section'  => 'section-breadcrumbs',
			'priority' => 110,
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
		'id'           => '[breadcrumbs-color]',
		'default'      => $defaults ['breadcrumbs-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Text Color', 'kemet-addons' ),
		'priority'     => 1,
		'section'      => 'section-breadcrumbs',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	array(
		'id'           => '[breadcrumbs-link-color]',
		'default'      => $defaults ['breadcrumbs-link-color'],
		'type'         => 'option',
		'control_type' => 'kmt-color',
		'transport'    => 'postMessage',
		'label'        => __( 'Link Color', 'kemet-addons' ),
		'priority'     => 2,
		'section'      => 'section-breadcrumbs',
		'tab'          => __( 'Normal', 'kemet-addons' ),
	),
	/**
	* Option - Hover Color
	*/
	array(
		'id'           => '[breadcrumbs-link-h-color]',
		'default'      => $defaults ['breadcrumbs-link-h-color'],
		'type'         => 'option',
		'transport'    => 'postMessage',
		'control_type' => 'kmt-color',
		'label'        => __( 'Link Color', 'kemet-addons' ),
		'priority'     => 3,
		'section'      => 'section-breadcrumbs',
		'tab'          => __( 'Hover', 'kemet-addons' ),
	),
);
$group_settings = array(
	'parent_id' => KEMET_THEME_SETTINGS . '[kmt-breadcrumbs-colors]',
	'type'      => 'kmt-group',
	'label'     => __( 'Colors', 'kemet-addons' ),
	'section'   => 'section-breadcrumbs',
	'priority'  => 115,
	'settings'  => array(),
);
new Kemet_Generate_Control_Group( $wp_customize, $group_settings, $fields );





