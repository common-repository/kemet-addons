<?php
/**
 * Custom fonts
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Custom_Fonts_Meta' ) ) {
	/**
	 * Custom_fonts options
	 */
	class Kemet_Addon_Custom_Fonts_Meta {

		/**
		 * Instance
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {
			$prefix_page_opts = 'kemet_custom_font_options';
			$this->create_custom_fonts_meta( $prefix_page_opts );
		}

		/**
		 * Create Meta
		 *
		 * @param string $prefix meta prefix.
		 * @return void
		 */
		public function create_custom_fonts_meta( $prefix ) {

			KFW::create_metabox(
				$prefix,
				array(
					'title'     => __( 'Kemet Custom Font options', 'kemet-addons' ),
					'priority'  => 'high',
					'post_type' => array( KEMET_CUSTOM_FONTS_POST_TYPE ),
					'data_type' => 'serialize',
					'theme'     => 'light',
				)
			);

			KFW::create_section(
				$prefix,
				array(
					'priority_num' => 1,
					'fields'       => array(
						array(
							'id'      => 'font-type',
							'type'    => 'select',
							'title'   => __( 'Font Type', 'kemet-addons' ),
							'options' => array(
								'file'      => __( 'Upload File', 'kemet-addons' ),
								'adobe-kit' => __( 'Adobe TypeKit', 'kemet-addons' ),
							),
							'default' => 'file',
						),
						array(
							'id'         => 'adobe-project-id',
							'type'       => 'text',
							'title'      => __( 'Adobe TypeKit Project ID', 'kemet-addons' ),
							'dependency' => array( 'font-type', '==', 'adobe-kit' ),
							'after'      => $this->typekit_fonts(),
						),
						array(
							'id'         => 'font-name',
							'type'       => 'text',
							'title'      => __( 'Font Name', 'kemet-addons' ),
							'desc'       => __( 'The name of the font as it appears in the customizer options.', 'kemet-addons' ),
							'dependency' => array( 'font-type', '==', 'file' ),
						),
						array(
							'id'         => 'font-fallback',
							'type'       => 'text',
							'title'      => __( 'Font Fallback', 'kemet-addons' ),
							'desc'       => __( "Add the font's fallback names with comma(,) separator. eg. Helvetica, Arial", 'kemet-addons' ),
							'dependency' => array( 'font-type', '==', 'file' ),
						),
						array(
							'id'         => 'font-display',
							'type'       => 'select',
							'title'      => __( 'Font Display', 'kemet-addons' ),
							'default'    => 'auto',
							'options'    => array(
								'auto'     => __( 'Auto', 'kemet-addons' ),
								'block'    => __( 'Block', 'kemet-addons' ),
								'swap'     => __( 'Swap', 'kemet-addons' ),
								'fallback' => __( 'Fallback', 'kemet-addons' ),
								'optional' => __( 'Optional', 'kemet-addons' ),
							),
							'dependency' => array( 'font-type', '==', 'file' ),
						),
						array(
							'id'         => 'font-weight',
							'type'       => 'select',
							'title'      => __( 'Font Weight', 'kemet-addons' ),
							'default'    => '400',
							'options'    => array(
								'inherit' => __( 'Inherit', 'kemet-addons' ),
								'100'     => __( 'Thin 100', 'kemet-addons' ),
								'200'     => __( 'Extra-Light 200', 'kemet-addons' ),
								'300'     => __( 'Light 300', 'kemet-addons' ),
								'400'     => __( 'Normal 400', 'kemet-addons' ),
								'500'     => __( 'Medium 500', 'kemet-addons' ),
								'600'     => __( 'Semi-Bold 600', 'kemet-addons' ),
								'700'     => __( 'Bold 700', 'kemet-addons' ),
								'800'     => __( 'Extra-Bold 800', 'kemet-addons' ),
								'900'     => __( 'Ultra-Bold 900', 'kemet-addons' ),
							),
							'dependency' => array( 'font-type', '==', 'file' ),
						),
						array(
							'id'         => 'woff-font',
							'type'       => 'upload',
							'title'      => __( '.woff Font file', 'kemet-addons' ),
							'desc'       => __( 'Upload .woff file', 'kemet-addons' ),
							'dependency' => array( 'font-type', '==', 'file' ),
						),
						array(
							'id'         => 'woff2-font',
							'type'       => 'upload',
							'title'      => __( '.woff2 Font file', 'kemet-addons' ),
							'desc'       => __( 'Upload .woff2 file', 'kemet-addons' ),
							'dependency' => array( 'font-type', '==', 'file' ),
						),
						array(
							'id'         => 'ttf-font',
							'type'       => 'upload',
							'title'      => __( '.ttf Font file', 'kemet-addons' ),
							'desc'       => __( 'Upload .ttf file', 'kemet-addons' ),
							'dependency' => array( 'font-type', '==', 'file' ),
						),
						array(
							'id'         => 'eot-font',
							'type'       => 'upload',
							'title'      => __( '.eot Font file', 'kemet-addons' ),
							'desc'       => __( 'Upload .eot file', 'kemet-addons' ),
							'dependency' => array( 'font-type', '==', 'file' ),
						),
						array(
							'id'         => 'svg-font',
							'type'       => 'upload',
							'title'      => __( '.svg Font file', 'kemet-addons' ),
							'desc'       => __( 'Upload .svg file', 'kemet-addons' ),
							'dependency' => array( 'font-type', '==', 'file' ),
						),
						array(
							'id'         => 'otf-font',
							'type'       => 'upload',
							'title'      => __( '.otf Font file', 'kemet-addons' ),
							'desc'       => __( 'Upload .otf file', 'kemet-addons' ),
							'dependency' => array( 'font-type', '==', 'file' ),
						),
					),
				)
			);
		}

		/**
		 * Adobe web project fonts table
		 */
		public function typekit_fonts() {

			if ( $this->check_post_type() ) {
				$meta = get_post_meta( $this->check_post_type(), 'kemet_custom_font_options', true );
				if ( $meta ) {
					$font_type = $meta['font-type'];
					$html      = '';
					if ( 'adobe-kit' == $font_type && ! empty( $meta['adobe-project-id'] ) ) {
						$fonts = Kemet_Addon_Custom_Fonts_Partials::get_instance()->get_adobe_project( $meta['adobe-project-id'] );
						$html .= '<table class="wp-list-table widefat striped" style="margin-top: 20px;">';
						$html .= '<thead>';
						$html .= '<tr>';
						$html .= '<td>' . esc_html__( 'Fonts', 'kemet-addons' ) . '</td>';
						$html .= '<td>' . esc_html__( 'Variations', 'kemet-addons' ) . '</td>';
						$html .= '</thead>';
						$html .= '<tbody>';
						foreach ( $fonts['kit']['families'] as $font_family ) {
							$html      .= '<tr>';
							$variations = $font_family['variations'];
							$weights    = array();
							foreach ( $variations as $variation ) {
								$font_variations = str_split( $variation );
								$weight          = $font_variations[1] . '00';
								if ( ! in_array( $weight, $weights ) ) {
									$weights[] = $weight;
								}
							}
							sort( $weights );
							$weights = implode( ', ', $weights );
							$html   .= '<td>' . esc_html( $font_family['name'] ) . '</td>';
							$html   .= '<td>' . esc_html( $weights ) . '</td>';
							$html   .= '</tr>';
						}
						$html .= '</tbody>';
						$html .= '</table>';

						return $html;
					}
				}
			}
		}

		/**
		 * Check post type in admin
		 *
		 * @return mixed
		 */
		public function check_post_type() {
			// Global object containing current admin page.
			global $pagenow;

			// If current page is post.php and post isset than query for its post type.
			// if the post type is 'event' do something.
			if ( 'post.php' === $pagenow && isset( $_GET['post'] ) && KEMET_CUSTOM_FONTS_POST_TYPE === get_post_type( $_GET['post'] ) ) { //phpcs:ignore
				return sanitize_text_field( wp_unslash( $_GET['post'] ) );
			}
			return false;
		}
	}
}
Kemet_Addon_Custom_Fonts_Meta::get_instance();

