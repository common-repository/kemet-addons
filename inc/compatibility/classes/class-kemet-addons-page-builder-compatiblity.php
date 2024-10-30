<?php
/**
 * Page Builders Compatiblity
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addons_Page_Builder_Compatiblity' ) ) {

	/**
	 * Kemet Addons Page Builder Compatiblity
	 */
	class Kemet_Addons_Page_Builder_Compatiblity {

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
		 * Render content for post.
		 *
		 * @param int $post_id post id.
		 * @return mixed
		 */
		public function render_content( $post_id ) {
			global $wp_post_types;
			$post = get_post( $post_id );

			if ( class_exists( '\Elementor\Plugin' ) ) {
				if ( ( version_compare( ELEMENTOR_VERSION, '1.5.0', '<' ) &&
					'builder' === Elementor\Plugin::$instance->db->get_edit_mode( $post_id ) ) || Elementor\Plugin::$instance->db->is_built_with_elementor( $post_id ) ) {

					return self::render_elementor_content( $post_id );
				}
			}

			if ( class_exists( 'FLBuilderModel' ) && apply_filters( 'fl_builder_do_render_content', true, FLBuilderModel::get_post_id() ) && get_post_meta( $post_id, '_fl_builder_enabled', true ) ) {
				return self::render_beaver_builder_content( $post_id );
			}

			if ( function_exists( 'et_pb_is_pagebuilder_used' ) && et_pb_is_pagebuilder_used( $post_id ) ) {
				return self::render_divi_content( $post_id );
			}

			if ( class_exists( 'Brizy_Editor_Post' ) ) {
				try {
					$post = Brizy_Editor_Post::get( $post_id );

					if ( $post ) {
						self::render_brizy_editor_content( $post_id );
					}
				} catch ( Exception $exception ) { // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
					// The post type is not supported by Brizy hence Brizy should not be used render the post.
				}
			}

			$rest_support = $wp_post_types[ KEMET_CUSTOM_LAYOUT_POST_TYPE ]->show_in_rest;

			if ( $rest_support ) {
				return self::render_gutenberg_content( $post_id );
			}
		}

		/**
		 * Render content for post
		 *
		 * @param int $post_id post id.
		 * @return mixed
		 */
		public function enqueue_scripts( $post_id ) {

			global $wp_post_types;
			$post = get_post( $post_id );

			if ( class_exists( '\Elementor\Plugin' ) ) {
				if ( ( version_compare( ELEMENTOR_VERSION, '1.5.0', '<' ) &&
					'builder' === Elementor\Plugin::$instance->db->get_edit_mode( $post_id ) ) || Elementor\Plugin::$instance->db->is_built_with_elementor( $post_id ) ) {

					return self::elementor_enqueue_scripts( $post_id );
				}
			}

			if ( class_exists( 'FLBuilderModel' ) && apply_filters( 'fl_builder_do_render_content', true, FLBuilderModel::get_post_id() ) && get_post_meta( $post_id, '_fl_builder_enabled', true ) ) {
				return self::render_beaver_builder_enqueue_scripts( $post_id );
			}

			if ( class_exists( 'Brizy_Editor_Post' ) ) {
				try {
					$post = Brizy_Editor_Post::get( $post_id );

					if ( $post ) {
						return self::brizy_enqueue_scripts( $post_id );
					}
				} catch ( Exception $exception ) { // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
					// The post type is not supported by Brizy hence Brizy should not be used render the post.
				}
			}

		}

		/**
		 * Render elementor content for post
		 *
		 * @param int $post_id post id.
		 * @return void
		 */
		public function render_elementor_content( $post_id ) {

			// set post to glabal post.
			$elementor_instance = Elementor\Plugin::instance();
			echo $elementor_instance->frontend->get_builder_content_for_display( $post_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Load elementor styles and scripts
		 *
		 * @param int $post_id post id.
		 * @return void
		 */
		public function elementor_enqueue_scripts( $post_id ) {

			if ( '' !== $post_id ) {
				if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
					$css_file = \Elementor\Core\Files\CSS\Post::create( $post_id );
				} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
					$css_file = new \Elementor\Post_CSS_File( $post_id );
				}

				$css_file->enqueue();
			}
		}

		/**
		 * Render beaver builder content for post
		 *
		 * @param int $post_id post id.
		 * @return void
		 */
		public function render_beaver_builder_content( $post_id ) {

			FLBuilder::render_content_by_id(
				$post_id,
				'div',
				array()
			);
		}

		/**
		 * Load beaver builder styles and scripts
		 *
		 * @param int $post_id post id.
		 * @return void
		 */
		public function render_beaver_builder_enqueue_scripts( $post_id ) {

			if ( is_callable( 'FLBuilder::enqueue_layout_styles_scripts_by_id' ) ) {
				// Enqueue styles and scripts for this post.
				FLBuilder::enqueue_layout_styles_scripts_by_id( $post_id );
			}
		}

		/**
		 * Render Divi content for post
		 *
		 * @param int $post_id post id.
		 * @return void
		 */
		public function render_divi_content( $post_id ) {

			$get_post = get_post( $post_id, OBJECT );

			global $post;
			$post                   = $get_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$get_post->post_content = self::divi_container_wrap( $get_post->post_content );
			$get_post->post_content = apply_filters( 'the_content', $get_post->post_content );

			if ( strpos( $get_post->post_content, '<div id="et-boc" class="et-boc">' ) === false ) {
				$get_post->post_content = self::divi_main_wrapper( $get_post->post_content );
			}

			echo $get_post->post_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			wp_reset_postdata();
		}

		/**
		 * Add Divi container wrapper to post content
		 *
		 * @param string $content post content.
		 * @return string
		 */
		public static function divi_container_wrap( $content ) {

			$outer_content_class   = apply_filters( 'et_builder_outer_content_class', array( 'et_builder_outer_content' ) );
			$outer_content_classe  = implode( ' ', $outer_content_class );
			$outer_content_id      = apply_filters( 'et_builder_outer_content_id', 'et_builder_outer_content' );
			$inner_content_class   = apply_filters( 'et_builder_inner_content_class', array( 'et_builder_inner_content' ) );
			$inner_content_classes = implode( ' ', $inner_content_class );

			$content = sprintf(
				'<div class="%2$s" id="%4$s">
					<div class="%3$s">
						%1$s
					</div>
				</div>',
				$content,
				esc_attr( $outer_content_classe ),
				esc_attr( $inner_content_classes ),
				esc_attr( $outer_content_id )
			);

			return $content;
		}

		/**
		 * Add Divi main wrapper to post content
		 *
		 * @param string $content post content.
		 * @return string
		 */
		public static function divi_main_wrapper( $content ) {

			$content = sprintf(
				'<div id="%2$s" class="%2$s">
					%1$s
				</div>',
				$content,
				esc_attr__( 'et-boc', 'kemet-addons' ),
				esc_attr__( 'et-boc', 'kemet-addons' )
			);
			return $content;
		}

		/**
		 * Render brizy content for post
		 *
		 * @param int $post_id post id.
		 * @return void
		 */
		public function render_brizy_editor_content( $post_id ) {

			$post = Brizy_Editor_Post::get( $post_id );

			if ( $post && $post->uses_editor() ) {

				$content = apply_filters( 'brizy_content', $post->get_compiled_html(), Brizy_Editor_Project::get(), $post->get_wp_post() );

				echo do_shortcode( $content );
			}
		}

		/**
		 * Load brizy styles and scripts
		 *
		 * @param int $post_id post id.
		 * @return void
		 */
		public function brizy_enqueue_scripts( $post_id ) {

			$post = Brizy_Editor_Post::get( $post_id );
			$main = method_exists( 'Brizy_Public_Main', 'get' ) ? Brizy_Public_Main::get( $post ) : new Brizy_Public_Main( $post );

			// Add page CSS.
			add_filter( 'body_class', array( $main, 'body_class_frontend' ) );
			add_action( 'wp_enqueue_scripts', array( $main, '_action_enqueue_preview_assets' ), 9999 );

			add_action(
				'wp_head',
				function() use ( $post ) {

					$params = array( 'content' => '' );

					if ( ! $post->get_compiled_html() ) {

						$compiled_html_head = $post->get_compiled_html_head();
						$compiled_html_head = Brizy_SiteUrlReplacer::restoreSiteUrl( $compiled_html_head );
						$post->set_needs_compile( true )
								->saveStorage();

						$params['content'] = $compiled_html_head;
					} else {
						$compiled_page     = $post->get_compiled_page();
						$head              = $compiled_page->get_head();
						$params['content'] = $head;
					}

					$params['content'] = apply_filters( 'brizy_content', $params['content'], Brizy_Editor_Project::get(), $post->getWpPost(), 'head' );

				}
			);

			if ( $post && $post->uses_editor() ) {

				// Add page admin edit menu.
				add_action(
					'admin_bar_menu',
					function( $wp_admin_bar ) use ( $post ) {
						$wp_post_id = $post->get_wp_post()->ID;
						$args       = array(
							'id'    => 'brizy_Edit_page_' . $wp_post_id . '_link',
							/* translators: 1: Post id link, 2: Current post id */
							'title' => sprintf( __( 'Edit %1$s with %2$s', 'kemet-addons' ), get_the_title( $wp_post_id ), is_callable( 'Brizy_Editor::get' ) ? Brizy_Editor::get()->get_name() : 'Brizy' ),
							'href'  => $post->edit_url(),
							'meta'  => array(),
						);

						if ( true === $wp_admin_bar->get_node( 'brizy_Edit_page_link' ) ) {
							$args['parent'] = 'brizy_Edit_page_link';
						}

						$wp_admin_bar->add_node( $args );

					},
					1000
				);
			}
		}

		/**
		 * Render Gutenberg Blocks content for post
		 *
		 * @param int $post_id post id.
		 * @return void
		 */
		public function render_gutenberg_content( $post_id ) {

			$output   = '';
			$get_post = get_post( $post_id, OBJECT );

			$priority = has_filter( 'the_content', 'wpautop' );
			if ( false !== $priority && doing_filter( 'the_content' ) && has_blocks( $get_post ) ) {
				remove_filter( 'the_content', 'wpautop', $priority );
				add_filter( 'the_content', '_restore_wpautop_hook', $priority + 1 );
			}

			if ( has_blocks( $get_post ) && isset( $get_post->post_content ) ) {

				$blocks = parse_blocks( $get_post->post_content );

				foreach ( $blocks as $block ) {
					$output .= render_block( $block );
				}
			} elseif ( isset( $get_post->post_content ) ) {
				$output = $get_post->post_content;
			}

			ob_start();
			echo do_shortcode( $output );
			echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

	}

	/**
	 * Initialize class object with 'get_instance()' method
	 */
	Kemet_Addons_Page_Builder_Compatiblity::get_instance();
}
