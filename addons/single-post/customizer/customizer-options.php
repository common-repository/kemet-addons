<?php
/**
 * Customizer options.
 *
 * @package Kemet Addons
 */

$defaults = Kemet_Theme_Options::defaults();

/**
* Option: Page Title In Content
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[enable-page-title-content-area]',
	array(
		'default'           => $defaults['enable-page-title-content-area'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[enable-page-title-content-area]',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Post Title in Content Area', 'kemet-addons' ),
			'section'  => 'section-blog-single',
			'priority' => 16,
		)
	)
);

/**
* Option: Next / Prev links
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[prev-next-links]',
	array(
		'default'           => $defaults['prev-next-links'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[prev-next-links]',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Disable Next / Prev Links', 'kemet-addons' ),
			'section'  => 'section-blog-single',
			'priority' => 17,
		)
	)
);

/**
* Option: Author Box
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[enable-author-box]',
	array(
		'default'           => $defaults['enable-author-box'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[enable-author-box]',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Author Box', 'kemet-addons' ),
			'section'  => 'section-blog-single',
			'priority' => 18,
		)
	)
);

/**
 * Title and meta position
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[title-meta-position]',
	array(
		'default'           => $defaults['title-meta-position'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Icon_Select(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[title-meta-position]',
		array(
			'priority' => 45,
			'section'  => 'section-blog-single',
			'label'    => __( 'Title And Meta Position', 'kemet-addons' ),
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
* Option: Title
*/
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-single-post-page-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Page Title', 'kemet-addons' ),
			'section'  => 'section-blog-single',
			'priority' => 50,
			'settings' => array(),
		)
	)
);

/**
* Option: Featured Image In Header
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[featured-image-header]',
	array(
		'default'           => $defaults['featured-image-header'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[featured-image-header]',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Featured Image in Page Title', 'kemet-addons' ),
			'section'  => 'section-blog-single',
			'priority' => 55,
		)
	)
);

/**
 * Option: Page Title Format
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[page-header-title]',
	array(
		'default'           => $defaults['page-header-title'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[page-header-title]',
	array(
		'section'  => 'section-blog-single',
		'label'    => __( 'Page Title Format', 'kemet-addons' ),
		'type'     => 'select',
		'priority' => 60,
		'choices'  => array(
			'blog'       => __( 'Blog', 'kemet-addons' ),
			'post-title' => __( 'Post Title', 'kemet-addons' ),
		),
	)
);

/**
 * Content Alignment
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[content-alignment]',
	array(
		'default'           => $defaults['content-alignment'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Icon_Select(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[content-alignment]',
		array(
			'priority' => 65,
			'section'  => 'section-blog-single',
			'label'    => __( 'Content Alignment', 'kemet-addons' ),
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
* Option - Padding Inside Container
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[padding-inside-container]',
	array(
		'default'           => $defaults['padding-inside-container'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[padding-inside-container]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-blog-single',
			'priority'       => 70,
			'label'          => __( 'Container Padding', 'kemet-addons' ),
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
		KEMET_THEME_SETTINGS . '[kmt-single-post-featured-image]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Featured Image Settings', 'kemet' ),
			'section'  => 'section-blog-single',
			'priority' => 75,
			'settings' => array(),
		)
	)
);

/**
 * Option: Featured Image Custom Width
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[single-post-featured-image-width]',
	array(
		'default'           => $defaults['single-post-featured-image-width'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[single-post-featured-image-width]',
	array(
		'type'        => 'number',
		'section'     => 'section-blog-single',
		'priority'    => 80,
		'label'       => __( 'Featured Image Custom Width', 'kemet' ),
		'input_attrs' => array(
			'min' => 0,
		),
	)
);

/**
 * Option: Featured Image Custom Height
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[single-post-featured-image-height]',
	array(
		'default'           => $defaults['single-post-featured-image-height'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[single-post-featured-image-height]',
	array(
		'type'        => 'number',
		'section'     => 'section-blog-single',
		'priority'    => 85,
		'label'       => __( 'Featured Image Custom Height', 'kemet' ),
		'input_attrs' => array(
			'min' => 0,
		),
	)
);





