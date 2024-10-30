<?php
/**
 * Blog Layouts
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Blog_Layouts_Partials' ) ) {

	/**
	 * Class Kemet_Blog_Layouts_Partials
	 */
	class Kemet_Blog_Layouts_Partials {

		/**
		 * Instance
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 * Instance
		 *
		 * @return object
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
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ), 5 );
			remove_action( 'kemet_pagination', 'kemet_number_pagination' );
			add_action( 'kemet_pagination', array( $this, 'kemet_addons_number_pagination' ) );
			add_filter( 'post_class', array( $this, 'kemet_post_class_blog_grid' ) );
			add_filter( 'excerpt_length', array( $this, 'kemet_custom_excerpt_length' ) );
			add_filter( 'kemet_blog_post_container', array( $this, 'kemet_blog_post_container' ) );
			add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'site_scripts' ), 1 );
			add_filter( 'kemet_theme_js_localize', array( $this, 'blog_js_localize' ) );
			add_action( 'wp_ajax_kemet_pagination_infinite', array( $this, 'kemet_pagination_infinite' ) );
			add_action( 'wp_ajax_nopriv_kemet_pagination_infinite', array( $this, 'kemet_pagination_infinite' ) );
			add_action( 'kemet_featured_image_attrs', array( $this, 'kemet_blog_featured_image_custom_attrs' ) );
		}

		/**
		 * Featured Image Custom Width and Height
		 *
		 * @param string $image image.
		 * @return string
		 */
		public function kemet_blog_featured_image_custom_attrs( $image ) {
			if ( 'post' === get_post_type() && ( is_archive() || is_search() || is_home() ) ) {
				$blog_featured_image_width  = kemet_get_option( 'blog-featured-image-width' );
				$blog_featured_image_height = kemet_get_option( 'blog-featured-image-height' );

				$attributes = array(
					'width'  => empty( $blog_featured_image_width ) ? false : $blog_featured_image_width,
					'height' => empty( $blog_featured_image_height ) ? false : $blog_featured_image_height,
					'crop'   => ( empty( $blog_featured_image_width ) || empty( $blog_featured_image_height ) ) ? false : true,
				);

				if ( ! $attributes['width'] && ! $attributes['height'] ) {
					$attributes = array();
				}

				$image_id = get_post_thumbnail_id( get_the_ID(), 'full' );

				$blog_post_structure = kemet_get_option( 'blog-post-structure' );

				if ( in_array( 'image', $blog_post_structure ) ) {
					if ( $attributes && function_exists( 'ipq_get_theme_image' ) ) {
						$image = ipq_get_theme_image(
							$image_id,
							array(
								array( $attributes['width'], $attributes['height'], $attributes['crop'] ),
							),
							array(
								'class' => '',
							)
						);
					}
				}
			}

			return $image;
		}

		/**
		 * Blog Classes
		 *
		 * @param array $classes post classes.
		 * @return array
		 */
		public function kemet_post_class_blog_grid( $classes ) {

			$is_ajax_pagination = $this->is_ajax_pagination();

			if ( is_archive() || is_home() || is_search() || $is_ajax_pagination ) {

				$blog_layout = kemet_get_option( 'blog-layouts' );
				$blog_grids  = kemet_get_option( 'blog-grids' );

				if ( $is_ajax_pagination ) {
					$classes[] = 'kmt-col-sm-12';
					$classes[] = 'kmt-article-post';
				}

				if ( 'blog-layout-2' == $blog_layout ) {

					if ( in_array( 'kmt-col-sm-12', $classes ) ) {
						$overlay_enabled = array_search( 'kmt-col-sm-12', $classes );
						unset( $classes[ $overlay_enabled ] );
					}
					$desktop_columns = ! empty( $blog_grids['desktop'] ) ? ' kmt-col-md-' . strval( 12 / $blog_grids['desktop'] ) : '';
					$tablet_columns  = ! empty( $blog_grids['tablet'] ) ? ' kmt-col-sm-' . strval( 12 / $blog_grids['tablet'] ) : ' kmt-col-sm-12';
					$mobile_columns  = ! empty( $blog_grids['mobile'] ) ? ' kmt-col-xs-' . strval( 12 / $blog_grids['mobile'] ) : ' kmt-col-xs-12';
					$classes[]       = $desktop_columns . $tablet_columns . $mobile_columns;
				}
			}

			return $classes;

		}
		/**
		 * Posts container classes
		 *
		 * @param array $classes array of classes.
		 * @return array
		 */
		public function kemet_blog_post_container( $classes ) {
			$classes[]   = kemet_get_option( 'blog-layouts' );
			$blog_layout = kemet_get_option( 'blog-layouts' );

			if ( 'blog-layout-2' == $blog_layout ) {
				$classes [] = ! empty( kemet_get_option( 'blog-layout-mode' ) ) ? kemet_get_option( 'blog-layout-mode' ) : 'fitRows';
			}
			$classes[] = kemet_get_option( 'overlay-image-style' ) != 'none' ? kemet_get_option( 'overlay-image-style' ) : '';
			$classes[] = kemet_get_option( 'hover-image-effect' ) != 'none' ? kemet_get_option( 'hover-image-effect' ) : '';
			$classes[] = kemet_get_option( 'post-image-position' ) == 'left' ? 'kmt-img-left' : 'kmt-img-right';
			return $classes;
		}
		/**
		 * Excerpt Length
		 *
		 * @return int
		 */
		public function kemet_custom_excerpt_length() {
			$excerpt_length = ! empty( kemet_get_option( 'blog-excerpt-length' ) ) ? kemet_get_option( 'blog-excerpt-length' ) : 50;

			return $excerpt_length;
		}

		/**
		 * Kemet addons Pagination
		 *
		 * @return void
		 */
		public function kemet_addons_number_pagination() {
			global $numpages;

			$enabled          = apply_filters( 'kemet_pagination_enabled', true );
			$pagination_style = kemet_get_option( 'blog-pagination-style' );
			$prev_text        = 'next-prev' == $pagination_style ? kemet_theme_strings( 'string-blog-navigation-previous', false ) : '<span class="dashicons dashicons-arrow-left-alt2"></span>';
			$next_text        = 'next-prev' == $pagination_style ? kemet_theme_strings( 'string-blog-navigation-next', false ) : '<span class="dashicons dashicons-arrow-right-alt2"></span>';

			if ( isset( $numpages ) && $enabled && 'infinite-scroll' != $pagination_style ) {
				ob_start();
				echo wp_kses(
					"<div class='kmt-pagination " . $pagination_style . "'>",
					kemet_allowed_html( array( 'div' ) )
				);
				the_posts_pagination(
					array(
						'prev_text'    => $prev_text,
						'next_text'    => $next_text,
						'taxonomy'     => 'category',
						'in_same_term' => true,
					)
				);
				echo wp_kses(
					'</div>',
					kemet_allowed_html( array( 'div' ) )
				);
				$output = ob_get_clean();
				echo apply_filters( 'kemet_pagination_markup', $output ); // WPCS: XSS OK.

			} elseif ( 'infinite-scroll' == $pagination_style ) {
				$end_text        = kemet_get_option( 'blog-infinite-scroll-last-text' );
				$msg             = esc_html( $end_text, 'kemet-addons' );
				$load_more_style = kemet_get_option( 'load-more-style' );
				$load_more_text  = esc_html( kemet_get_option( 'load-more-text' ), 'kemet-addons' );
				?>

				<div class="kmt-infinite-scroll-loader">
				<div class="kmt-infinite-scroll-dots">
					<span class="kmt-loader"></span>
					<span class="kmt-loader"></span>
					<span class="kmt-loader"></span>
					<span class="kmt-loader"></span>
				</div>
				

				<?php
				if ( 'button' == $load_more_style ) {
					?>
				<div class="kmt-load-more">
					<button class="load-more-text"><?php echo esc_html( $load_more_text, 'kemet-addons' ); ?></button>
				</div>
		<?php } ?>
				<p class="infinite-scroll-end-msg"><?php echo esc_attr( $msg ); ?></p>
			</div>           
				<?php
			}
		}

		/**
		 * Infinite Posts Show on scroll
		 *
		 * @since 1.0
		 * @param array $localize   JS localize variables.
		 * @return array
		 */
		public function blog_js_localize( $localize ) {

			global $wp_query;
			$blog_pagination = kemet_get_option( 'blog-pagination-style' );

			$localize['ajax_url']              = admin_url( 'admin-ajax.php' );
			$localize['blog_infinite_count']   = 2;
			$localize['blog_infinite_total']   = $wp_query->max_num_pages;
			$localize['blog_pagination_style'] = $blog_pagination;
			$localize['blog_infinite_nonce']   = wp_create_nonce( 'kmt-load-more-nonce' );
			$localize['query_vars']            = wp_json_encode( $wp_query->query_vars );
			$localize['blog_load_more_style']  = kemet_get_option( 'load-more-style' );

			return $localize;
		}


		/**
		 * Infinite Posts Show on scroll
		 */
		public function kemet_pagination_infinite() {

			check_ajax_referer( 'kmt-load-more-nonce', 'nonce' );

			do_action( 'kemet_pagination_infinite' );

			$query_vars                = isset( $_POST['query_vars'] ) ? json_decode( sanitize_text_field( wp_unslash( $_POST['query_vars'] ) ), true ) : '';
			$query_vars['paged']       = ( isset( $_POST['page_no'] ) ) ? sanitize_text_field( wp_unslash( $_POST['page_no'] ) ) : 1;
			$query_vars['post_status'] = 'publish';
			$posts                     = new WP_Query( $query_vars );

			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
					$posts->the_post();
					get_template_part( 'templates/content', 'blog' );
				}
			}
			wp_reset_query();

			wp_die();
		}

		/**
		 * Check if ajax pagination is calling.
		 *
		 * @return boolean classes
		 */
		public function is_ajax_pagination() {

			$pagination = false;

			if ( isset( $_POST['kemet_infinite'] ) && wp_doing_ajax() && check_ajax_referer( 'kmt-load-more-nonce', 'nonce', false ) ) {
				$pagination = true;
			}

			return $pagination;
		}

		/**
		 * Enqueue Scripts
		 *
		 * @return void
		 */
		public function site_scripts() {
			wp_enqueue_script( 'masonry' );
		}
		/**
		 * Styles
		 *
		 * @return void
		 */
		public function add_styles() {
			Kemet_Style_Generator::kmt_add_css( KEMET_BLOG_LAYOUTS_DIR . 'assets/css/minified/blog-layouts.min.css' );

		}
		/**
		 * Scripts
		 *
		 * @return void
		 */
		public function add_scripts() {
			Kemet_Style_Generator::kmt_add_js( KEMET_BLOG_LAYOUTS_DIR . 'assets/js/minified/blog-layouts.min.js' );
		}
	}
}
Kemet_Blog_Layouts_Partials::get_instance();
