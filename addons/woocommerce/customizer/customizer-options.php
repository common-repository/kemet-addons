<?php
/**
 * Woocommerce customizer options
 *
 * @package Kemet Addons
 */

$defaults = Kemet_Theme_Options::defaults();

/**
 * Option: General
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-on-sale-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'On Sale Badge', 'kemet-addons' ),
			'section'  => 'section-woo-general',
			'priority' => 5,
			'settings' => array(),
		)
	)
);

/**
 * Option: Sale Notification
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sale-content]',
	array(
		'default'           => $defaults['sale-content'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[sale-content]',
	array(
		'type'     => 'select',
		'section'  => 'section-woo-general',
		'priority' => 10,
		'label'    => __( 'Sale Notification Content', 'kemet-addons' ),
		'choices'  => array(
			'sale-text' => __( 'Text', 'kemet-addons' ),
			'percent'   => __( 'Percentage', 'kemet-addons' ),
		),
	)
);

/**
 * Option: Content Text Color
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sale-text-color]',
	array(
		'default'           => $defaults['sale-text-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[sale-text-color]',
		array(
			'label'    => __( 'Text Color', 'kemet-addons' ),
			'priority' => 11,
			'section'  => 'section-woo-general',
		)
	)
);

/**
 * Option: Content Text Color
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[sale-background-color]',
	array(
		'default'           => $defaults['sale-background-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Color(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[sale-background-color]',
		array(
			'label'    => __( 'Background Color', 'kemet-addons' ),
			'priority' => 12,
			'section'  => 'section-woo-general',
		)
	)
);

/**
 * Option: Title
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-wishlist]',
		array(
			'type'        => 'kmt-title',
			'label'       => __( 'Wishlist', 'kemet-addons' ),
			'description' => sprintf( '%s <a href="%s" target="%s">%s</a> %s', esc_html__( 'You need to activate the', 'kemet-addons' ), esc_url( 'https://wordpress.org/plugins/yith-woocommerce-wishlist/' ), esc_attr( '_blank' ), esc_html__( 'YITH WooCommerce Wishlist', 'kemet-addons' ), esc_html__( 'plugin to add a wishlist button and icon', 'kemet-addons' ) ),
			'section'     => 'section-woo-general',
			'priority'    => 14,
			'settings'    => array(),
		)
	)
);

/**
 * Option: Add wishlist to header
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[wishlist-in-header]',
	array(
		'default'           => $defaults['wishlist-in-header'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[wishlist-in-header]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-woo-general',
		'label'    => __( 'Add Wishlist Header', 'kemet-addons' ),
		'priority' => 15,
	)
);

/**
 * Option: Shop Layout
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[shop-layout]',
	array(
		'default'           => $defaults['shop-layout'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[shop-layout]',
	array(
		'type'     => 'select',
		'section'  => 'woocommerce_product_catalog',
		'priority' => 18,
		'label'    => __( 'Shop Layout', 'kemet-addons' ),
		'choices'  => array(
			'shop-grid'   => __( 'Boxed', 'kemet-addons' ),
			'hover-style' => __( 'Simple', 'kemet-addons' ),
		),
	)
);

/**
 * Option: Product Content Alignment
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[product-content-alignment]',
	array(
		'default'           => $defaults['product-content-alignment'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Icon_Select(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[product-content-alignment]',
		array(
			'priority' => 36,
			'section'  => 'woocommerce_product_catalog',
			'label'    => __( 'Product Content Alignment', 'kemet-addons' ),
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
		KEMET_THEME_SETTINGS . '[kmt-quick-view-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Quick View Settings', 'kemet-addons' ),
			'section'  => 'woocommerce_product_catalog',
			'priority' => 36,
			'settings' => array(),
		)
	)
);

/**
 * Option: Enable Quick view
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[enable-quick-view]',
	array(
		'default'           => $defaults['enable-quick-view'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[enable-quick-view]',
	array(
		'type'     => 'checkbox',
		'section'  => 'woocommerce_product_catalog',
		'label'    => __( 'Enable Quick View', 'kemet-addons' ),
		'priority' => 36,
	)
);

/**
 * Option: Quick View
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[quick-view-style]',
	array(
		'default'           => $defaults['quick-view-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[shop-layout]/' . KEMET_THEME_SETTINGS . '[enable-quick-view]',
			'conditions' => '==/==',
			'values'     => 'shop-grid/' . true,
			'operators'  => '&&',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[quick-view-style]',
	array(
		'type'     => 'select',
		'section'  => 'woocommerce_product_catalog',
		'priority' => 36,
		'label'    => __( 'Quick View Position', 'kemet-addons' ),
		'choices'  => array(
			'qv-icon'       => __( 'Top Right Corner', 'kemet-addons' ),
			'on-image'      => __( 'On Product Image', 'kemet-addons' ),
			'after-summary' => __( 'After Product Summary', 'kemet-addons' ),
		),
	)
);

/**
 * Option: Title
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kemet-product-structure]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Product Structure', 'kemet-addons' ),
			'section'  => 'woocommerce_product_catalog',
			'priority' => 55,
			'settings' => array(),
		)
	)
);

/**
 * Option: Shop Structure
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[shop-list-product-structure]',
	array(
		'default'           => kemet_get_option( 'shop-list-product-structure' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[shop-layout]',
			'conditions' => '==',
			'values'     => 'hover-style',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Sortable(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[shop-list-product-structure]',
		array(
			'type'     => 'kmt-sortable',
			'section'  => 'woocommerce_product_catalog',
			'priority' => 55,
			'label'    => __( 'Product Structure', 'kemet-addons' ),
			'choices'  => array(
				'title'      => __( 'Title', 'kemet-addons' ),
				'price'      => __( 'Price', 'kemet-addons' ),
				'ratings'    => __( 'Ratings', 'kemet-addons' ),
				'short_desc' => __( 'Short Description', 'kemet-addons' ),
				'add_cart'   => __( 'Add To Cart', 'kemet-addons' ),
				'category'   => __( 'Category', 'kemet-addons' ),
			),
		)
	)
);

/**
 * Option: Shop Structure
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[shop-list-style-structure]',
	array(
		'default'           => kemet_get_option( 'shop-list-style-structure' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Sortable(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[shop-list-style-structure]',
		array(
			'type'     => 'kmt-sortable',
			'section'  => 'woocommerce_product_catalog',
			'priority' => 55,
			'label'    => __( 'List Style Structure', 'kemet-addons' ),
			'choices'  => array(
				'title'      => __( 'Title', 'kemet-addons' ),
				'price'      => __( 'Price', 'kemet-addons' ),
				'ratings'    => __( 'Ratings', 'kemet-addons' ),
				'short_desc' => __( 'Short Description', 'kemet-addons' ),
				'add_cart'   => __( 'Add To Cart', 'kemet-addons' ),
				'category'   => __( 'Category', 'kemet-addons' ),
			),
		)
	)
);

/**
 * Option: Disable Short Description In Responsive
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[disable-list-short-desc-in-responsive]',
	array(
		'default'           => $defaults['disable-list-short-desc-in-responsive'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[shop-list-style-structure]',
			'conditions' => 'inarray',
			'values'     => 'short_desc',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[disable-list-short-desc-in-responsive]',
	array(
		'type'     => 'checkbox',
		'section'  => 'woocommerce_product_catalog',
		'label'    => __( 'Disable Short Description In Responsive', 'kemet-addons' ),
		'priority' => 55,
	)
);

/**
 * Option: Shop Product Structure
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[shop-product-structure]',
	array(
		'default'           => kemet_get_option( 'shop-product-structure' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[shop-layout]',
			'conditions' => '==',
			'values'     => 'shop-grid',
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Sortable(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[shop-product-structure]',
		array(
			'type'     => 'kmt-sortable',
			'section'  => 'woocommerce_product_catalog',
			'priority' => 60,
			'label'    => __( 'Shop Product Structure', 'kemet-addons' ),
			'choices'  => array(
				'short_desc' => __( 'Short Description', 'kemet-addons' ),
				'add_cart'   => __( 'Add To Cart', 'kemet-addons' ),
				'category'   => __( 'Category', 'kemet-addons' ),
			),
		)
	)
);

/**
 * Option: Pagination Settings
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-pagination-group-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Pagination Settings', 'kemet-addons' ),
			'section'  => 'woocommerce_product_catalog',
			'priority' => 61,
			'settings' => array(),
		)
	)
);

/**
 * Option: Pagination Style
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[woo-pagination-style]',
	array(
		'default'           => $defaults['woo-pagination-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[woo-pagination-style]',
	array(
		'type'     => 'select',
		'section'  => 'woocommerce_product_catalog',
		'priority' => 61,
		'label'    => __( 'Pagination Style', 'kemet-addons' ),
		'choices'  => array(
			'standard'        => __( 'Standard', 'kemet-addons' ),
			'infinite-scroll' => __( 'Infinite Scroll', 'kemet-addons' ),
		),
	)
);

/**
 * Option: Load More Style
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[woo-load-more-style]',
	array(
		'default'           => $defaults['woo-load-more-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[woo-pagination-style]',
			'conditions' => '==',
			'values'     => 'infinite-scroll',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[woo-load-more-style]',
	array(
		'type'     => 'select',
		'section'  => 'woocommerce_product_catalog',
		'priority' => 61,
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
	KEMET_THEME_SETTINGS . '[woo-load-more-text]',
	array(
		'default'           => $defaults['woo-load-more-text'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[woo-pagination-style]/' . KEMET_THEME_SETTINGS . '[woo-load-more-style]',
			'conditions' => '==/==',
			'values'     => 'infinite-scroll/button',
			'operators'  => '&&',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[woo-load-more-text]',
	array(
		'section'  => 'woocommerce_product_catalog',
		'priority' => 61,
		'label'    => __( 'Load More Text', 'kemet-addons' ),
		'type'     => 'text',
	)
);

/**
 * Option: Loader Color
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[infinite-scroll-loader-color]',
	array(
		'default'           => $defaults['infinite-scroll-loader-color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[woo-pagination-style]/' . KEMET_THEME_SETTINGS . '[woo-load-more-style]',
			'conditions' => '==/==',
			'values'     => 'infinite-scroll/dots',
			'operators'  => '&&',
		),
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[infinite-scroll-loader-color]',
		array(
			'section'  => 'woocommerce_product_catalog',
			'label'    => __( 'Infinite Scroll Loader Color', 'kemet-addons' ),
			'priority' => 61,
		)
	)
);

/**
 * Option: Infinite Scroll: Last Text
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[infinite-scroll-last-text]',
	array(
		'default'           => $defaults['infinite-scroll-last-text'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[woo-pagination-style]',
			'conditions' => '==',
			'values'     => 'infinite-scroll',
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[infinite-scroll-last-text]',
	array(
		'section'  => 'woocommerce_product_catalog',
		'priority' => 61,
		'label'    => __( 'Infinite Scroll: Last Text', 'kemet-addons' ),
		'type'     => 'text',
	)
);

/**
 * Option: Enable Filter Button
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[enable-filter-button]',
	array(
		'default'           => $defaults['enable-filter-button'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[enable-filter-button]',
	array(
		'type'     => 'checkbox',
		'section'  => 'woocommerce_product_catalog',
		'label'    => __( 'Enable Filter Button', 'kemet-addons' ),
		'priority' => 80,
	)
);

/**
 * Option: Title
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[kmt-filter-title]',
	array(
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-filter-button]',
			'conditions' => '==',
			'values'     => '1',
		),
		'sanitize_callback' => 'wp_kses',
	)
);
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-filter-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Filter Settings', 'kemet-addons' ),
			'section'  => 'woocommerce_product_catalog',
			'priority' => 80,
		)
	)
);

/**
 * Option: Filter Button Text
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[off-canvas-filter-label]',
	array(
		'default'           => $defaults['off-canvas-filter-label'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[enable-filter-button]',
			'conditions' => '==',
			'values'     => true,
		),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[off-canvas-filter-label]',
	array(
		'section'  => 'woocommerce_product_catalog',
		'priority' => 80,
		'label'    => __( 'Filter Button Text', 'kemet-addons' ),
		'type'     => 'text',
	)
);

/**
 * Option: Single Product
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-single-product-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Single Product Settings', 'kemet-addons' ),
			'section'  => 'section-woo-shop-single',
			'priority' => 1,
			'settings' => array(),
		)
	)
);

/**
 * Option: Ajax Add To Cart
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[enable-single-ajax-add-to-cart]',
	array(
		'default'           => $defaults['enable-single-ajax-add-to-cart'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[enable-single-ajax-add-to-cart]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-woo-shop-single',
		'label'    => __( 'Enable Ajax Add To Cart', 'kemet-addons' ),
		'priority' => 15,
	)
);

/**
 * Option: Enable Product Navigation
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[enable-product-navigation]',
	array(
		'default'           => $defaults['enable-product-navigation'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[enable-product-navigation]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-woo-shop-single',
		'label'    => __( 'Enable Product Navigation', 'kemet-addons' ),
		'priority' => 16,
	)
);

/**
 * Option: Gallary Style
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[product-gallery-style]',
	array(
		'default'           => $defaults['product-gallery-style'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[product-gallery-style]',
	array(
		'type'     => 'select',
		'section'  => 'section-woo-shop-single',
		'priority' => 20,
		'label'    => __( 'Gallery Style', 'kemet-addons' ),
		'choices'  => array(
			'horizontal' => __( 'Below Product Image', 'kemet-addons' ),
			'vertical'   => __( 'Beside Product Image', 'kemet-addons' ),
		),
	)
);

/**
 * Option: Image Width
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[product-image-width]',
	array(
		'default'           => $defaults['product-image-width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[product-image-width]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-woo-shop-single',
			'priority'    => 25,
			'label'       => __( 'Image Width (%)', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 100,
			),
		)
	)
);

/**
 * Title
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-related-products-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Related Products Settings', 'kemet-addons' ),
			'section'  => 'section-woo-shop-single',
			'priority' => 35,
			'settings' => array(),
		)
	)
);

/**
 * Option: Disable Related Products
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[disable-related-products]',
	array(
		'default'           => $defaults['disable-related-products'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[disable-related-products]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-woo-shop-single',
		'label'    => __( 'Disable Related Products', 'kemet-addons' ),
		'priority' => 35,
	)
);

/**
 * Option: Related Products Count
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[related-products-count]',
	array(
		'default'           => $defaults['related-products-count'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[disable-related-products]',
			'conditions' => '==',
			'values'     => false,
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[related-products-count]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-woo-shop-single',
			'priority'    => 40,
			'label'       => __( 'Related Products Count', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 3,
				'step' => 1,
				'max'  => 100,
			),
		)
	)
);

/**
 * Option: Related Products Colunms
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[related-products-colunms]',
	array(
		'default'           => $defaults['related-products-colunms'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[disable-related-products]',
			'conditions' => '==',
			'values'     => false,
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[related-products-colunms]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-woo-shop-single',
			'priority'    => 45,
			'label'       => __( 'Related Products Columns', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 6,
			),
		)
	)
);

/**
 * Title
 */
$wp_customize->add_control(
	new Kemet_Control_Title(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[kmt-up-sells-title]',
		array(
			'type'     => 'kmt-title',
			'label'    => __( 'Up-Sells Products Settings', 'kemet-addons' ),
			'section'  => 'section-woo-shop-single',
			'priority' => 50,
			'settings' => array(),
		)
	)
);

/**
 * Option: Disable Up-Sells
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[disable-up-sells-products]',
	array(
		'default'           => $defaults['disable-up-sells-products'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	KEMET_THEME_SETTINGS . '[disable-up-sells-products]',
	array(
		'type'     => 'checkbox',
		'section'  => 'section-woo-shop-single',
		'label'    => __( 'Disable Up-Sells Products', 'kemet-addons' ),
		'priority' => 50,
	)
);

/**
 * Option: Up-Sells Count
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[up-sells-products-count]',
	array(
		'default'           => $defaults['up-sells-products-count'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[disable-up-sells-products]',
			'conditions' => '==',
			'values'     => false,
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[up-sells-products-count]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-woo-shop-single',
			'priority'    => 55,
			'label'       => __( 'Up-Sells Count', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 3,
				'step' => 1,
				'max'  => 100,
			),
		)
	)
);

/**
 * Option: Up-Sells Colunms
 */
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[up-sells-products-colunms]',
	array(
		'default'           => $defaults['up-sells-products-colunms'],
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		'dependency'        => array(
			'controls'   => KEMET_THEME_SETTINGS . '[disable-up-sells-products]',
			'conditions' => '==',
			'values'     => false,
		),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Slider(
		$wp_customize,
		KEMET_THEME_SETTINGS . '[up-sells-products-colunms]',
		array(
			'type'        => 'kmt-slider',
			'section'     => 'section-woo-shop-single',
			'priority'    => 60,
			'label'       => __( 'Up-Sells Columns', 'kemet-addons' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 6,
			),
		)
	)
);
