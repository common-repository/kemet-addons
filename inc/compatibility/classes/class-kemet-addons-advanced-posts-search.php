<?php
/**
 * Kemet Addons Advanced Posts Search
 *
 * @package Kemet Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'Kemet_Addons_Advanced_Posts_Search' ) ) {

	/**
	 * Kemet Addons Advanced Posts Search
	 */
	class Kemet_Addons_Advanced_Posts_Search {

		/**
		 * Member Variable
		 *
		 * @var object instance
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
			add_action( 'wp_ajax_kemet_ajax_get_posts_list', array( $this, 'kemet_ajax_get_posts_list' ) );
			add_action( 'wp_ajax_kemet_get_post_title', array( $this, 'ajax_get_post_title' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_script' ) );
		}

		/**
		 * Ajax handeler to return the posts based on the search query.
		 * When searching for the post/pages only titles are searched for.
		 *
		 * @return void
		 */
		public function kemet_ajax_get_posts_list() {
			check_ajax_referer( 'kemet-addons-ajax-get-post', 'nonce' );

			$search_query = isset( $_POST['query'] ) ? sanitize_text_field( wp_unslash( $_POST['query'] ) ) : '';
			$data         = array();
			$result       = array();

			$args = array(
				'public'   => true,
				'_builtin' => false,
			);

			$output   = 'names'; // 'names' or 'objects' (default: 'names')
			$operator = 'and'; // 'and' or 'or' (default: 'and')

			$post_types = get_post_types( $args, $output, $operator );

			$post_types['Posts'] = 'post';
			$post_types['Pages'] = 'page';

			foreach ( $post_types as $key => $post_type ) {
				$data = array();

				add_filter( 'posts_search', array( $this, 'search_by_title_only' ), 500, 2 );

				$query = new WP_Query(
					array(
						's'              => $search_query,
						'post_type'      => $post_type,
						'posts_per_page' => - 1,
					)
				);

				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$title  = get_the_title();
						$title .= ( 0 != $query->post->post_parent ) ? ' (' . get_the_title( $query->post->post_parent ) . ')' : '';
						$id     = get_the_id();
						$data[] = array(
							'id'   => 'post-' . $id,
							'text' => $title,
						);
					}
				}
				if ( is_array( $data ) && ! empty( $data ) ) {
					$result[] = array(
						'text'     => $key,
						'children' => $data,
					);
				}
			}

			$data = array();

			wp_reset_postdata();

			$args = array(
				'public' => true,
			);

			$output     = 'objects'; // names or objects, note names is the default.
			$operator   = 'and'; // also supports 'or'.
			$taxonomies = get_taxonomies( $args, $output, $operator );

			foreach ( $taxonomies as $taxonomy ) {
				$terms = get_terms(
					$taxonomy->name,
					array(
						'orderby'    => 'count',
						'hide_empty' => 0,
						'name__like' => $search_query,
					)
				);

				$data = array();

				$label = ucwords( $taxonomy->label );

				if ( ! empty( $terms ) ) {
					foreach ( $terms as $term ) {
						$term_taxonomy_name = ucfirst( str_replace( '_', ' ', $taxonomy->name ) );

						$data[] = array(
							'id'   => 'tax-' . $term->term_id,
							'text' => $term->name . ' archive page',
						);

						$data[] = array(
							'id'   => 'tax-' . $term->term_id . '-single-' . $taxonomy->name,
							'text' => 'All singulars from ' . $term->name,
						);
					}
				}

				if ( is_array( $data ) && ! empty( $data ) ) {
					$result[] = array(
						'text'     => $label,
						'children' => $data,
					);
				}
			}

			// return the result in json.
			wp_send_json( $result );
		}

		/**
		 * Search by title
		 *
		 * @param string $search Search SQL for WHERE clause.
		 * @param object $wp_query The current WP_Query.
		 * @return string
		 */
		public function search_by_title_only( $search, $wp_query ) {
			global $wpdb;
			if ( empty( $search ) ) {
				return $search; // skip processing - no search term in query.
			}
			$search    = '';
			$q         = $wp_query->query_vars;
			$n         = ! empty( $q['exact'] ) ? '' : '%';
			$searchand = '';
			foreach ( (array) $q['search_terms'] as $term ) {
				$term      = esc_sql( $wpdb->esc_like( $term ) );
				$search   .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
				$searchand = ' AND ';
			}
			if ( ! empty( $search ) ) {
				$search = " AND ({$search}) ";
				if ( ! is_user_logged_in() ) {
					$search .= " AND ($wpdb->posts.post_password = '') ";
				}
			}
			return $search;
		}

		/**
		 * Get post title by ajax
		 *
		 * @return void
		 */
		public function ajax_get_post_title() {
			check_ajax_referer( 'kemet-addons-ajax-get-title', 'nonce' );

			$post_id = isset( $_POST['post_id'] ) ? explode( '-', sanitize_text_field( wp_unslash( $_POST['post_id'] ) ) )[1] : '';
			if ( ! empty( $post_id ) ) {
				$name = ! empty( get_the_title( $post_id ) ) ? get_the_title( $post_id ) : get_term( $post_id )->name;
				echo esc_html( $name );
			}
			wp_die();
		}

		/**
		 * Admin Script
		 *
		 * @param string $hook current location.
		 * @return void
		 */
		public function admin_script( $hook ) {

			$js_prefix  = '.min.js';
			$css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$css_prefix = '.css';
				$dir        = 'unminified';
			}

			wp_enqueue_script( 'kemet-addons-select2', KEMET_COMPATIBLITY_URL . 'assets/js/' . $dir . '/select2' . $js_prefix, array( 'jquery' ), KEMET_ADDONS_VERSION, true );

			$wordpress_lang = get_locale();
			$lang           = '';
			if ( '' !== $wordpress_lang ) {
				$select2_lang = array(
					''               => 'en',
					'hi_IN'          => 'hi',
					'mr'             => 'mr',
					'af'             => 'af',
					'ar'             => 'ar',
					'ary'            => 'ar',
					'as'             => 'as',
					'azb'            => 'az',
					'az'             => 'az',
					'bel'            => 'be',
					'bg_BG'          => 'bg',
					'bn_BD'          => 'bn',
					'bo'             => 'bo',
					'bs_BA'          => 'bs',
					'ca'             => 'ca',
					'ceb'            => 'ceb',
					'cs_CZ'          => 'cs',
					'cy'             => 'cy',
					'da_DK'          => 'da',
					'de_CH'          => 'de',
					'de_DE'          => 'de',
					'de_DE_formal'   => 'de',
					'de_CH_informal' => 'de',
					'dzo'            => 'dz',
					'el'             => 'el',
					'en_CA'          => 'en',
					'en_GB'          => 'en',
					'en_AU'          => 'en',
					'en_NZ'          => 'en',
					'en_ZA'          => 'en',
					'eo'             => 'eo',
					'es_MX'          => 'es',
					'es_VE'          => 'es',
					'es_CR'          => 'es',
					'es_CO'          => 'es',
					'es_GT'          => 'es',
					'es_ES'          => 'es',
					'es_CL'          => 'es',
					'es_PE'          => 'es',
					'es_AR'          => 'es',
					'et'             => 'et',
					'eu'             => 'eu',
					'fa_IR'          => 'fa',
					'fi'             => 'fi',
					'fr_BE'          => 'fr',
					'fr_FR'          => 'fr',
					'fr_CA'          => 'fr',
					'gd'             => 'gd',
					'gl_ES'          => 'gl',
					'gu'             => 'gu',
					'haz'            => 'haz',
					'he_IL'          => 'he',
					'hr'             => 'hr',
					'hu_HU'          => 'hu',
					'hy'             => 'hy',
					'id_ID'          => 'id',
					'is_IS'          => 'is',
					'it_IT'          => 'it',
					'ja'             => 'ja',
					'jv_ID'          => 'jv',
					'ka_GE'          => 'ka',
					'kab'            => 'kab',
					'km'             => 'km',
					'ko_KR'          => 'ko',
					'ckb'            => 'ku',
					'lo'             => 'lo',
					'lt_LT'          => 'lt',
					'lv'             => 'lv',
					'mk_MK'          => 'mk',
					'ml_IN'          => 'ml',
					'mn'             => 'mn',
					'ms_MY'          => 'ms',
					'my_MM'          => 'my',
					'nb_NO'          => 'nb',
					'ne_NP'          => 'ne',
					'nl_NL'          => 'nl',
					'nl_NL_formal'   => 'nl',
					'nl_BE'          => 'nl',
					'nn_NO'          => 'nn',
					'oci'            => 'oc',
					'pa_IN'          => 'pa',
					'pl_PL'          => 'pl',
					'ps'             => 'ps',
					'pt_BR'          => 'pt',
					'pt_PT_ao90'     => 'pt',
					'pt_PT'          => 'pt',
					'rhg'            => 'rhg',
					'ro_RO'          => 'ro',
					'ru_RU'          => 'ru',
					'sah'            => 'sah',
					'si_LK'          => 'si',
					'sk_SK'          => 'sk',
					'sl_SI'          => 'sl',
					'sq'             => 'sq',
					'sr_RS'          => 'sr',
					'sv_SE'          => 'sv',
					'szl'            => 'szl',
					'ta_IN'          => 'ta',
					'te'             => 'te',
					'th'             => 'th',
					'tl'             => 'tl',
					'tr_TR'          => 'tr',
					'tt_RU'          => 'tt',
					'tah'            => 'ty',
					'ug_CN'          => 'ug',
					'uk'             => 'uk',
					'ur'             => 'ur',
					'uz_UZ'          => 'uz',
					'vi'             => 'vi',
					'zh_CN'          => 'zh',
					'zh_TW'          => 'zh',
					'zh_HK'          => 'zh',
				);

				if ( isset( $select2_lang[ $wordpress_lang ] ) && file_exists( KEMET_COMPATIBLITY_URL . 'assets/js/' . $dir . '//i18n/' . $select2_lang[ $wordpress_lang ] . '.js' ) ) {
					$ast_lang = $select2_lang[ $wordpress_lang ];
					wp_enqueue_script(
						'kemet-addons-select2-lang',
						KEMET_COMPATIBLITY_URL . 'assets/js/' . $dir . '//i18n/' . $select2_lang[ $wordpress_lang ] . '.js',
						array(
							'jquery',
							'kemet-addons-select2',
						),
						KEMET_ADDONS_VERSION,
						true
					);
				}
			}

			wp_enqueue_style( 'kemet-addons-select2', KEMET_COMPATIBLITY_URL . 'assets/css/' . $dir . '/select2' . $css_prefix, KEMET_ADDONS_VERSION ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

			wp_localize_script(
				'kemet-addons-select2',
				'kemetAddons',
				apply_filters(
					'kemet_addons_admin_js_localize',
					array(
						'lang'   => $lang,
						'search' => __( 'Search pages / post / categories', 'kemet-addons' ),
					)
				)
			);
		}
	}
}

Kemet_Addons_Advanced_Posts_Search::get_instance();
