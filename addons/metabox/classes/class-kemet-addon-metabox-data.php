<?php
/**
 * Create a Metabox Options
 *
 * @package Kemet Addons
 */

if ( class_exists( 'KFW' ) ) {

	$prefix_page_opts = 'kemet_page_options';

	KFW::create_metabox(
		$prefix_page_opts,
		array(
			'title'     => __( 'Kemet Page Options', 'kemet-addons' ),
			'post_type' => array(
				'page',
				'post',
				'product',
			),

			'data_type' => 'serialize',
			'theme'     => 'light',
		)
	);

	// Create a section.
	KFW::create_section(
		$prefix_page_opts,
		array(
			'title'        => __( 'Main', 'kemet-addons' ),
			'icon'         => 'dashicons dashicons-admin-home',
			'priority_num' => 1,
			'fields'       => array(
				array(
					'id'          => 'site-sidebar-layout',
					'type'        => 'select',
					'title'       => __( 'Sidebar Layout', 'kemet-addons' ),
					'placeholder' => __( 'Select an option', 'kemet-addons' ),
					'default'     => '',
					'options'     => array(
						'no-sidebar'    => __( 'No Sidebar', 'kemet-addons' ),
						'left-sidebar'  => __( 'Left Sidebar', 'kemet-addons' ),
						'right-sidebar' => __( 'Right Sidebar', 'kemet-addons' ),
					),
				),
				array(
					'id'          => 'site-content-layout',
					'type'        => 'select',
					'title'       => __( 'Page Layout', 'kemet-addons' ),
					'placeholder' => __( 'Select an option', 'kemet-addons' ),
					'options'     => array(
						'boxed-container'         => __( 'Boxed Layout', 'kemet-addons' ),
						'content-boxed-container' => __( 'Boxed Content', 'kemet-addons' ),
						'plain-container'         => __( 'Full Width Content', 'kemet-addons' ),
						'page-builder'            => __( 'Stretched Content', 'kemet-addons' ),
					),
				),
				array(
					'id'      => 'kemet-featured-img',
					'type'    => 'checkbox',
					'title'   => __( 'Disable Featured Image', 'kemet-addons' ),
					'label'   => __( 'Disable The Featured Image in The Current Page/Post.', 'kemet-addons' ),
					'default' => false,
				),
				array(
					'id'          => 'kemet-content-padding',
					'type'        => 'spacing',
					'title'       => 'Content Padding',
					'left'        => false,
					'right'       => false,
					'top_icon'    => false,
					'bottom_icon' => false,
				),
			),
		)
	);

	KFW::create_section(
		$prefix_page_opts,
		array(
			'title'        => __( 'Footer', 'kemet-addons' ),
			'icon'         => 'dashicons dashicons-admin-generic',
			'priority_num' => 10,
			'fields'       => array(
				array(
					'id'      => 'kemet-disable-footer',
					'type'    => 'checkbox',
					'title'   => __( 'Disable Footer Area', 'kemet-addons' ),
					'label'   => __( 'Disable The Footer Area in The Current Page/Post.', 'kemet-addons' ),
					'default' => false,
				),
				array(
					'id'      => 'kemet-disable-copyright-footer',
					'type'    => 'checkbox',
					'title'   => __( 'Disable Copyright Area', 'kemet-addons' ),
					'label'   => __( 'Disable The Copyright Area in The Current Page/Post.', 'kemet-addons' ),
					'default' => false,
				),
				array(
					'id'      => 'kemet-disable-go-top',
					'type'    => 'checkbox',
					'title'   => __( 'Disable Go Top Icon', 'kemet-addons' ),
					'label'   => __( 'Disable The Go Top Icon in The Current Page/Post.', 'kemet-addons' ),
					'default' => false,
				),
			),
		)
	);
}
