<?php
/**
 * Panel
 *
 * @package Kemet Addons
 */

define( 'KEMET_PANEL_DIR', KEMET_ADDONS_DIR . 'inc/kemet-panel/' );
define( 'KEMET_PANEL_URL', KEMET_ADDONS_URL . 'inc/kemet-panel/' );

if ( ! class_exists( 'Kemet_Addons_Panel' ) ) {

	/**
	 * Kemet Panel
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addons_Panel {

		/**
		 * Default values
		 *
		 * @var array defaults
		 */
		private $defaults = array();

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
			$tabs = $this->tabs();
			foreach ( $tabs as $tab => $values ) {
				require_once KEMET_PANEL_DIR . 'tabs/class-kemet-panel-' . $tab . '-tab.php';
			}
			add_action( 'wp_ajax_kemet-panel-save-options', array( $this, 'save_options' ) );
			add_action( 'wp_ajax_kemet-panel-reset-options', array( $this, 'reset_options' ) );
			add_action( 'wp_ajax_kemet-panel-enable-all', array( $this, 'enable_all_options' ) );
			add_action( 'wp_ajax_kemet-panel-disable-all', array( $this, 'disable_all_options' ) );
			add_action( 'admin_menu', array( $this, 'register_custom_menu_page' ) );
			add_action( 'admin_bar_menu', array( $this, 'admin_bar_item' ), 500 );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_script' ) );
			add_action( 'wp_loaded', array( $this, 'set_default_options' ) );
			add_action( 'enable_kemet_admin_menu_item', '__return_true' );
		}

		/**
		 * Add kemet panel to admin bar
		 *
		 * @param WP_Admin_Bar $admin_bar admin bar.
		 * @return void
		 */
		public function admin_bar_item( WP_Admin_Bar $admin_bar ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}
			$admin_bar->add_menu(
				array(
					'id'     => 'menu-id',
					'parent' => null,
					'group'  => null,
					'title'  => __( 'Kemet', 'kemet-addons' ), // you can use img tag with image link. it will show the image icon Instead of the title.
					'href'   => admin_url( 'admin.php?page=kemet_panel' ),
					'meta'   => array(
						'title' => __( 'Kemet', 'kemet-addons' ), // This title will show on hover.
					),
				)
			);
		}

		/**
		 * Add kemet panel menu
		 *
		 * @return void
		 */
		public function register_custom_menu_page() {
			$tabs = $this->tabs();
			add_submenu_page( 'kemet_panel', __( 'Kemet Panel', 'kemet-addons' ), __( 'Kemet Panel', 'kemet-addons' ), 'manage_options', 'kemet_panel', array( $this, 'render' ), null );
			foreach ( $tabs as $tab => $values ) {
				add_submenu_page( 'kemet_panel', $values['title'], $values['title'], 'manage_options', 'admin.php?page=kemet_panel#tab=' . $values['slug'] );
			}
			remove_submenu_page( 'kemet_panel', 'kemet_panel' );
		}

		/**
		 * Tabs
		 *
		 * @return object
		 */
		public function tabs() {
			$tabs = array(
				'options'     => array(
					'title'      => __( 'Customizer & Page Options', 'kemet-addons' ),
					'slug'       => 'customizer',
					'reset'      => true,
					'enable_all' => true,
				),
				'integration' => array(
					'title' => __( 'Integrations', 'kemet-addons' ),
					'slug'  => 'integration',
					'reset' => true,
				),
				'plugins'     => array(
					'title' => __( 'Plugins', 'kemet-addons' ),
					'slug'  => 'plugins',
				),
				'system'      => array(
					'title' => __( 'System Info', 'kemet-addons' ),
					'slug'  => 'system',
				),
			);

			return $tabs;
		}

		/**
		 * Render panel html
		 *
		 * @return void
		 */
		public function render() {
			$tabs = $this->tabs();?>
			<div class="kemet-panel-container">
				<div class="kemet-panel-header">
					<div class="kemet-panel-header-inner">
						<div class="logo">
							<div class="icon"></div>
							<div class="title">
								<h1>
									<span><?php esc_html_e( 'Welcome to', 'kemet-addons' ); ?></span>
									<strong><?php esc_html_e( 'Kemet Theme', 'kemet-addons' ); ?></strong>
									<small><?php esc_html_e( 'by Leap13', 'kemet-addons' ); ?></small>
								</h1>
							</div>
						</div>
					</div>
				</div>
				<div class="kemet-panel-body">
					<div class="kemet-panel-tabs-group">
						<div class="kemet-panel-tabs">
							<ul class="kemet-panel-tabs">
								<?php foreach ( $tabs as $tab => $values ) { ?>
								<li class="<?php echo esc_attr( $values['slug'] . '-tab' ); ?>"><a href="#tab=<?php echo esc_attr( $values['slug'] ); ?>"><span><?php echo esc_html( $values['title'] ); ?></span></a></li>
								<?php } ?>
							</ul>
						</div>
						<div class="kemet-panel-tabs-content">
							<?php foreach ( $tabs as $tab => $values ) { ?>
								<div id="<?php echo esc_attr( $values['slug'] ); ?>" class="tab">
									<?php
										$class = 'Kemet_Panel_' . ucfirst( $tab ) . '_Tab';
										echo '<div class="tab-content">';
										$class::get_instance()->render_html();
										echo '</div>';
										$enable_all = isset( $values['enable_all'] ) ? $values['enable_all'] : false;
									if ( isset( $values['reset'] ) && $values['reset'] ) {
										$this->render_footer( $tab, $values['slug'], $enable_all );
									}
									?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Render tab
		 *
		 * @param string  $class tab class.
		 * @param int     $id tab id.
		 * @param boolean $enable_all has enable all button.
		 * @return void
		 */
		public function render_footer( $class, $id, $enable_all ) {
			?>
			<div class="kemet-panel-footer">
				<div class="kemet-panel-footer-inner">
					<div class="footer-button">
						<button data-class="<?php echo esc_attr( $class ); ?>" data-id="<?php echo esc_attr( $id ); ?>" class="button button-primary kemet-save-ajax"><?php esc_html_e( 'Save', 'kemet-addons' ); ?></button>
						<?php if ( $enable_all ) : ?>
							<button data-class="<?php echo esc_attr( $class ); ?>" data-id="<?php echo esc_attr( $id ); ?>" class="button button-secondary kemet-enable-all-options"><?php esc_html_e( 'Enable All', 'kemet-addons' ); ?></button>
							<button data-class="<?php echo esc_attr( $class ); ?>" data-id="<?php echo esc_attr( $id ); ?>" class="button button-secondary kemet-disable-all-options"><?php esc_html_e( 'Disable All', 'kemet-addons' ); ?></button>
						<?php endif; ?>
						<button data-class="<?php echo esc_attr( $class ); ?>" data-id="<?php echo esc_attr( $id ); ?>" class="button button-secondary kemet-reset-options"><?php esc_html_e( 'Reset All', 'kemet-addons' ); ?></button>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Save option by ajax
		 *
		 * @return void
		 */
		public function save_options() {
			check_ajax_referer( 'kemet-panel', 'nonce' );

			$options = isset( $_POST['options'] ) ? sanitize_post( wp_unslash( $_POST['options'] ) ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			$class   = isset( $_POST['class'] ) ? sanitize_text_field( wp_unslash( $_POST['class'] ) ) : '';
			switch ( $class ) {
				case 'options':
					update_option( 'kemet_addons_options', $options );
					wp_send_json_success();
					break;
				case 'integration':
					update_option( 'kemet_addons_integration', $options );
					wp_send_json_success();
					break;
			}
			wp_send_json_error();
		}

		/**
		 * Reset options by ajax
		 *
		 * @return void
		 */
		public function reset_options() {
			check_ajax_referer( 'kemet-panel', 'nonce' );

			$class   = isset( $_POST['class'] ) ? sanitize_text_field( wp_unslash( $_POST['class'] ) ) : '';
			$options = $this->get_defaults();
			$options = isset( $options[ 'Kemet_Panel_' . ucfirst( $class ) . '_Tab' ] ) ? $options[ 'Kemet_Panel_' . ucfirst( $class ) . '_Tab' ] : array();
			switch ( $class ) {
				case 'options':
					update_option( 'kemet_addons_options', $options );
					wp_send_json_success();
					break;
				case 'integration':
					update_option( 'kemet_addons_integration', $options );
					wp_send_json_success();
					break;
			}
			wp_send_json_error();
		}

		/**
		 * Enable all options by ajax
		 *
		 * @return void
		 */
		public function enable_all_options() {
			check_ajax_referer( 'kemet-panel', 'nonce' );

			$class   = isset( $_POST['class'] ) ? sanitize_text_field( wp_unslash( $_POST['class'] ) ) : '';
			$options = isset( $_POST['options'] ) ? sanitize_post( wp_unslash( $_POST['options'] ) ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

			switch ( $class ) {
				case 'options':
					update_option( 'kemet_addons_' . $class, $options );
					wp_send_json_success();
					break;
			}
			wp_send_json_error();
		}

		/**
		 * Disable all options by ajax
		 *
		 * @return void
		 */
		public function disable_all_options() {
			check_ajax_referer( 'kemet-panel', 'nonce' );

			$class   = isset( $_POST['class'] ) ? sanitize_text_field( wp_unslash( $_POST['class'] ) ) : '';
			$options = isset( $_POST['options'] ) ? sanitize_post( wp_unslash( $_POST['options'] ) ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			switch ( $class ) {
				case 'options':
					update_option( 'kemet_addons_' . $class, $options );
					wp_send_json_success();
					break;
			}
			wp_send_json_error();
		}

		/**
		 * Get Defaults
		 *
		 * @return $defaults
		 */
		public function get_defaults() {
			$tabs     = $this->tabs();
			$defaults = array();
			foreach ( $tabs as $tab => $values ) {
				$class = 'Kemet_Panel_' . ucfirst( $tab ) . '_Tab';
				if ( method_exists( $class, 'get_defaults' ) ) {
					$options            = $class::get_instance()->get_defaults();
					$defaults[ $class ] = $options;
				}
			}
			$this->defaults = $defaults;
			return $this->defaults;
		}

		/**
		 * Set Defaults
		 *
		 * @return $defaults
		 */
		public function set_default_options() {
			$default_option = get_option( 'kemet_panel_default_options_added' );
			if ( $default_option ) {
				return;
			}
			$tabs = $this->tabs();
			foreach ( $tabs as $tab => $values ) {
				$class = 'Kemet_Panel_' . ucfirst( $tab ) . '_Tab';
				if ( method_exists( $class, 'get_defaults' ) ) {
					$options = $class::get_instance()->get_defaults();
					update_option( 'kemet_addons_' . $tab, $options );
				}
			}
			update_option( 'kemet_panel_default_options_added', true );
		}

		/**
		 * Enqueue a script in the WordPress admin on edit.php
		 *
		 * @param string $hook current location.
		 * @return void
		 */
		public function enqueue_admin_script( $hook ) {
			$js_prefix  = '.min.js';
			$css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$css_prefix = '.css';
				$dir        = 'unminified';
			}
			if ( is_rtl() ) {
				$css_prefix = '-rtl.min.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
			}
			wp_enqueue_style( 'kemet-panel-css', KEMET_PANEL_URL . 'assets/css/' . $dir . '/kemet-panel' . $css_prefix, false, KEMET_ADDONS_VERSION );
			if ( 'toplevel_page_kemet_panel' != $hook ) {
				return;
			}
			wp_enqueue_script( 'kemet-panel-js', KEMET_PANEL_URL . 'assets/js/' . $dir . '/kemet-panel' . $js_prefix, array( 'jquery', 'jquery-ui-tabs', 'jquery-ui-core' ), KEMET_ADDONS_VERSION );

			wp_localize_script(
				'kemet-panel-js',
				'kemetPanelVars',
				array(
					'nonce' => wp_create_nonce( 'kemet-panel' ),
				)
			);
		}
	}
	Kemet_Addons_Panel::get_instance();
}
