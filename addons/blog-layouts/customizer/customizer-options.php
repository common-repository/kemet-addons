<?php
/**
 * Extra Blogs - Customizer options.
 *
 * @package Kemet Addons
 */

$defaults = Kemet_Theme_Options::defaults();

$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-layouts]',
	array(
		'default'           => $defaults['blog-layouts'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);

$wp_customize->add_control(
	new Kemet_Control_Radio_Image(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[blog-layouts]',
		array(
			'section'  => 'section-blog',
			'priority' => 1,
			'label'    => __( 'Blog Layouts', 'kemet-addons' ),
			'type'     => 'kmt-radio-image',
			'choices'  => array(
				'blog-layout-1' => array(
					'label' => __( 'Blog Layout 1', 'kemet-addons' ),
					'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/large-blog.png',
				),
				'blog-layout-2' => array(
					'label' => __( 'Blog Layout 2', 'kemet-addons' ),
					'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/grid-blog.png',
				),
				'blog-layout-3' => array(
					'label' => __( 'Blog Layout 3', 'kemet-addons' ),
					'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/large-modern-blog.png',
				),
				'blog-layout-4' => array(
					'label' => __( 'Blog Layout 4', 'kemet-addons' ),
					'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/right-left-blog.png',
				),
				'blog-layout-5' => array(
					'label' => __( 'Blog Layout 5', 'kemet-addons' ),
					'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/classic-blog.png',
				),
			),
		)
	)
);
/**
* Option: Blog Columns
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-grids]',
	array(
		'default'           => $defaults['blog-grids'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_select' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-layouts]',
			'conditions' => '==',
			'values'     => 'blog-layout-2',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Select(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[blog-grids]',
		array(
			'type'     => 'kmt-responsive-select',
			'section'  => 'section-blog',
			'priority' => 5,
			'label'    => __( 'Blog Columns', 'kemet-addons' ),
			'choices'  => array(
				1 => 'One',
				2 => 'Two',
				3 => 'Three',
				4 => 'Four',
			),
		)
	)
);
/**
* Option: Grid Style
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-layout-mode]',
	array(
		'default'           => $defaults['blog-layout-mode'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-layouts]',
			'conditions' => '==',
			'values'     => 'blog-layout-2',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[blog-layout-mode]',
	array(
		'type'     => 'select',
		'section'  => 'section-blog',
		'priority' => 5,
		'label'    => __( 'Grid Style', 'kemet-addons' ),
		'choices'  => array(
			'masonry'  => __( 'Masonry', 'kemet-addons' ),
			'fit-rows' => __( 'Fit Rows', 'kemet-addons' ),
		),
	)
);

/**
* Option: Image Position
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[post-image-position]',
	array(
		'default'           => $defaults['post-image-position'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-layouts]',
			'conditions' => '==',
			'values'     => 'blog-layout-5',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[post-image-position]',
	array(
		'type'     => 'select',
		'section'  => 'section-blog',
		'priority' => 5,
		'label'    => __( 'Image Position', 'kemet-addons' ),
		'choices'  => array(
			'left'  => __( 'Left', 'kemet-addons' ),
			'right' => __( 'Right', 'kemet-addons' ),
		),
	)
);

/**
* Option: Border Size
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-posts-border-size]',
	array(
		'default'           => $defaults['blog-posts-border-size'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-layouts]',
			'conditions' => '==',
			'values'     => 'blog-layout-3',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[blog-posts-border-size]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-blog',
			'priority'    => 5,
			'label'       => __( 'Posts Border Size', 'kemet-addons' ),
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
* Option - Border Size
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[layout-2-post-border-size]',
	array(
		'default'           => $defaults['layout-2-post-border-size'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-layouts]',
			'conditions' => '==',
			'values'     => 'blog-layout-2',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[layout-2-post-border-size]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-blog',
			'priority'       => 5,
			'label'          => __( 'Posts Border Size', 'kemet-addons' ),
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
* Option: Posts Border Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-posts-border-color]',
	array(
		'default'           => $defaults['blog-posts-border-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-layouts]/' . KEMET_THEME_SETTINGS . '[blog-layouts]',
			'conditions' => '==/==',
			'values'     => 'blog-layout-2/blog-layout-3',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[blog-posts-border-color]',
		array(
			'label'    => __( 'Posts Border Color', 'kemet-addons' ),
			'section'  => 'section-blog',
			'priority' => 5,
		)
	)
);
/**
* Option: Title & Meta Border Size
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-title-meta-border-size]',
	array(
		'default'           => $defaults['blog-title-meta-border-size'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-layouts]',
			'conditions' => '==',
			'values'     => 'blog-layout-3',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[blog-title-meta-border-size]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-blog',
			'priority'    => 5,
			'label'       => __( 'Title & Meta Border Size', 'kemet-addons' ),
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
* Option: Title Meta Border Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-title-meta-border-color]',
	array(
		'default'           => $defaults['blog-title-meta-border-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-layouts]',
			'conditions' => '==',
			'values'     => 'blog-layout-3',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[blog-title-meta-border-color]',
		array(
			'label'    => __( 'Title & Meta Border Color', 'kemet-addons' ),
			'section'  => 'section-blog',
			'priority' => 5,
		)
	)
);
/**
* Option: Display Post Structure
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-post-structure]',
	array(
		'default'           => $defaults['blog-post-structure'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-layouts]/' . KEMET_THEME_SETTINGS . '[blog-layouts]',
			'conditions' => '==/==',
			'values'     => 'blog-layout-1/blog-layout-2',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Sortable(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[blog-post-structure]',
		array(
			'type'     => 'kmt-sortable',
			'section'  => 'section-blog',
			'priority' => 15,
			'label'    => __( 'Blog Post Structure', 'kemet-addons' ),
			'choices'  => array(
				'image'            => __( 'Featured Image', 'kemet-addons' ),
				'title-meta'       => __( 'Title & Blog Meta', 'kemet-addons' ),
				'content-readmore' => __( 'Content & Readmore', 'kemet-addons' ),
			),
		)
	)
);
/**
* Option: Excerpt Length
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-excerpt-length]',
	array(
		'default'           => $defaults['blog-excerpt-length'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[blog-excerpt-length]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-blog',
			'priority'    => 26,
			'label'       => __( 'Excerpt Length', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 500,
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
		KEMET_THEME_SETTINGS . '[kmt-overlay-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Overlay Image Style', 'kemet-addons' ),
			'section'  => 'section-blog',
			'priority' => 118,
			'settings' => array(),
		)
	)
);
/**
 * Option: Overlay Styles
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[overlay-image-style]',
	array(
		'default'           => $defaults['overlay-image-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[overlay-image-style]',
	array(
		'type'     => 'select',
		'section'  => 'section-blog',
		'priority' => 119,
		'label'    => __( 'Overlay Styles', 'kemet-addons' ),
		'choices'  => array(
			'none'     => __( 'None', 'kemet-addons' ),
			'framed'   => __( 'Framed', 'kemet-addons' ),
			'diagonal' => __( 'Diagonal', 'kemet-addons' ),
			'bordered' => __( 'Bordered', 'kemet-addons' ),
			'squares'  => __( 'Squares', 'kemet-addons' ),
		),
	)
);
/**
 * Option: Hover Image Effect
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[hover-image-effect]',
	array(
		'default'           => $defaults['hover-image-effect'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[hover-image-effect]',
	array(
		'type'     => 'select',
		'section'  => 'section-blog',
		'priority' => 119,
		'label'    => __( 'Hover Image Effect', 'kemet-addons' ),
		'choices'  => array(
			'none'      => __( 'None', 'kemet-addons' ),
			'zoom-in'   => __( 'Zoom In', 'kemet-addons' ),
			'zoom-out'  => __( 'Zoom Out', 'kemet-addons' ),
			'scale'     => __( 'Scale', 'kemet-addons' ),
			'grayscale' => __( 'Grayscale', 'kemet-addons' ),
		),
	)
);
/**
* Option: Title
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[kmt-blog-overlay-image]',
	array(
		'sanitize_callback' => false,
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[overlay-image-style]',
			'conditions' => '!=',
			'values'     => 'none',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-blog-overlay-image]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Overlay Image Style', 'kemet-addons' ),
			'section'  => 'section-blog',
			'priority' => 120,
			'settings' => array(),
		)
	)
);
/**
 * Option: Overlay Image Background Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[overlay-image-bg-color]',
	array(
		'default'           => $defaults['overlay-image-bg-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[overlay-image-style]/' . KEMET_THEME_SETTINGS . '[overlay-image-style]',
			'conditions' => '!=/!=',
			'values'     => 'none/diagonal',
			'operators'  => '&&',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[overlay-image-bg-color]',
		array(
			'section'  => 'section-blog',
			'priority' => 125,
			'label'    => __( 'Overlay Image Background Color', 'kemet-addons' ),
		)
	)
);
/**
 * Option:Post Overlay Icon Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[overlay-icon-color]',
	array(
		'default'           => $defaults['overlay-icon-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[overlay-image-style]',
			'conditions' => '!=',
			'values'     => 'none',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[overlay-icon-color]',
		array(
			'label'    => __( 'Overlay Icon Color', 'kemet-addons' ),
			'priority' => 130,
			'section'  => 'section-blog',
		)
	)
);
/**
* Option - Container Inner Spacing
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-container-inner-spacing]',
	array(
		'default'           => $defaults['blog-container-inner-spacing'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[blog-container-inner-spacing]',
		array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-blog',
			'priority'       => 150,
			'label'          => __( 'Spacing', 'kemet-addons' ),
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
	* Option: Post Margin Bottom
	*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[post-margin-bottom]',
	array(
		'default'           => $defaults['post-margin-bottom'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[post-margin-bottom]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-blog',
			'priority'    => 151,
			'label'       => __( 'Post Margin Bottom', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 500,
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
		KEMET_THEME_SETTINGS . '[kemet-blog-pagination-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Pagination Style', 'kemet-addons' ),
			'section'  => 'section-blog',
			'priority' => 155,
			'settings' => array(),
		)
	)
);
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-pagination-style]',
	array(
		'default'           => $defaults['blog-pagination-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
/**
 * Option: Pagination
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-pagination-style]',
	array(
		'default'           => $defaults['blog-pagination-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[blog-pagination-style]',
	array(
		'type'     => 'select',
		'section'  => 'section-blog',
		'priority' => 155,
		'label'    => __( 'Pagination', 'kemet-addons' ),
		'choices'  => array(
			'next-prev'       => __( 'Next/Prev', 'kemet-addons' ),
			'standard'        => __( 'Standard', 'kemet-addons' ),
			'infinite-scroll' => __( 'Infinite', 'kemet-addons' ),
		),
	)
);
/**
* Option: Pagination Border Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-pagination-border-color]',
	array(
		'default'           => $defaults['blog-pagination-border-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-pagination-style]',
			'conditions' => '==',
			'values'     => 'standard',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[blog-pagination-border-color]',
		array(
			'label'    => __( 'Pagination Border Color', 'kemet-addons' ),
			'section'  => 'section-blog',
			'priority' => 160,
		)
	)
);
/**
 * Option: Load More Style
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[load-more-style]',
	array(
		'default'           => $defaults['load-more-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-pagination-style]',
			'conditions' => '==',
			'values'     => 'infinite-scroll',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[load-more-style]',
	array(
		'type'     => 'select',
		'section'  => 'section-blog',
		'priority' => 161,
		'label'    => __( 'Load More Style', 'kemet-addons' ),
		'choices'  => array(
			'dots'   => __( 'Dots', 'kemet-addons' ),
			'button' => __( 'Button', 'kemet-addons' ),
		),
	)
);
/**
 * Option: Load More Text
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[load-more-text]',
	array(
		'default'           => $defaults['load-more-text'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-pagination-style]/' . KEMET_THEME_SETTINGS . '[load-more-style]',
			'conditions' => '==/==',
			'values'     => 'infinite-scroll/button',
			'operators'  => '&&',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[load-more-text]',
	array(
		'section'  => 'section-blog',
		'priority' => 162,
		'label'    => __( 'Load More Text', 'kemet-addons' ),
		'type'     => 'text',
	)
);
/**
* Option: Dots Color
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-infinite-loader-color]',
	array(
		'default'           => $defaults['blog-infinite-loader-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-pagination-style]/' . KEMET_THEME_SETTINGS . '[load-more-style]',
			'conditions' => '==/==',
			'values'     => 'infinite-scroll/dots',
			'operators'  => '&&',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[blog-infinite-loader-color]',
		array(
			'label'    => __( 'Infinite Scroll Loader Color', 'kemet-addons' ),
			'section'  => 'section-blog',
			'priority' => 165,
		)
	)
);
/**
 * Option: Infinite Scroll: Last Text
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-infinite-scroll-last-text]',
	array(
		'default'           => $defaults['blog-infinite-scroll-last-text'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[blog-pagination-style]',
			'conditions' => '==',
			'values'     => 'infinite-scroll',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[blog-infinite-scroll-last-text]',
	array(
		'section'  => 'section-blog',
		'priority' => 170,
		'label'    => __( 'Infinite Scroll: Last Text', 'kemet-addons' ),
		'type'     => 'text',
	)
);

/**
* Option: Title
*/
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-featured-image]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Featured Image Settings', 'kemet' ),
			'section'  => 'section-blog',
			'priority' => 180,
			'settings' => array(),
		)
	)
);

/**
 * Option: Featured Image Custom Width
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-featured-image-width]',
	array(
		'default'           => $defaults['blog-featured-image-width'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[blog-featured-image-width]',
	array(
		'type'        => 'number',
		'section'     => 'section-blog',
		'priority'    => 185,
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
	KEMET_THEME_SETTINGS . '[blog-featured-image-height]',
	array(
		'default'           => $defaults['blog-featured-image-height'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[blog-featured-image-height]',
	array(
		'type'        => 'number',
		'section'     => 'section-blog',
		'priority'    => 190,
		'label'       => __( 'Featured Image Custom Height', 'kemet' ),
		'input_attrs' => array(
			'min' => 0,
		),
	)
);
