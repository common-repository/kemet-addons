<?php
/**
 * Mega menu walker
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Mega_Menu_Walker_Nav_Menu' ) ) {

	/**
	 * Mega menu walker
	 */
	class Kemet_Addon_Mega_Menu_Walker_Nav_Menu extends Walker_Nav_Menu {

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker::start_lvl()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function start_lvl( &$output, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}

			$indent = str_repeat( $t, $depth );

			// Default class.
			$classes = array( 'sub-menu' );

			$columns = ! empty( $this->megamenu_col ) ? ( 'col-' . $this->megamenu_col ) : 'col-2';
			$style   = array();
			if ( 0 === $depth && true == $this->megamenu ) {
				$classes[] = 'kemet-megamenu';
				$classes[] = $columns;

				$bg_obj          = $this->megamenu_bg_obj;
				$global_bg_color = kemet_get_option( 'global-background-color' );
				$bg_color        = empty( $bg_obj['background-color'] ) ? kemet_get_option( 'submenu-bg-color', kemet_color_brightness( $global_bg_color, 0.99, 'dark' ) ) : $bg_obj['background-color'];

				if ( ! empty( $bg_color ) || ! empty( $bg_obj['background-image']['url'] ) ) {

					$bg_object = array(
						'background-color'    => $bg_color,
						'background-repeat'   => $bg_obj['background-repeat'],
						'background-size'     => $bg_obj['background-size'],
						'background-position' => $bg_obj['background-position'],
						'background-image'    => 'url(' . $bg_obj['background-image']['url'] . ');',
					);
					$style[ 'body:not(.kmt-header-break-point) #site-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' ul.kemet-megamenu ,body:not(.kmt-header-break-point) #site-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' .mega-menu-full-wrap' ] = $bg_object;

				}
				$spacing = $this->megamenu_spacing;

				$style[ '.main-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' .kemet-megamenu' ] = array(
					'padding-top'    => kemet_get_css_value( $spacing['top'], $spacing['unit'] ),
					'padding-left'   => kemet_get_css_value( $spacing['left'], $spacing['unit'] ),
					'padding-bottom' => kemet_get_css_value( $spacing['bottom'], $spacing['unit'] ),
					'padding-right'  => kemet_get_css_value( $spacing['right'], $spacing['unit'] ),
				);

				Kemet_Addon_Mega_Menu_Partials::add_css( kemet_parse_css( $style ) );

				if ( 'full' === $this->megamenu_width ) {
					$output .= "\n$indent<div class='mega-menu-full-wrap'>\n";
				}
			}

			/**
			 * Filters the CSS class(es) applied to a menu list element.
			 *
			 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
			 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$output .= "{$n}{$indent}<ul$class_names>{$n}";
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker::end_lvl()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function end_lvl( &$output, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent  = str_repeat( $t, $depth );
			$output .= "$indent</ul>{$n}";
		}

		/**
		 * Starts the element output.
		 *
		 * @see Walker::start_el()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param WP_Post  $item   Menu item data object.
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 * @param int      $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			// Set some vars.
			if ( 0 === $depth ) {
				$this->megamenu         = get_post_meta( $item->ID, 'enable-mega-menu', true );
				$this->megamenu_col     = get_post_meta( $item->ID, 'mega-menu-columns', true );
				$this->megamenu_bg_obj  = get_post_meta( $item->ID, 'mega-menu-background', true );
				$this->megamenu_width   = get_post_meta( $item->ID, 'mega-menu-width', true );
				$this->megamenu_spacing = get_post_meta( $item->ID, 'mega-menu-spacing', true );
				$this->menu_item_id     = $item->ID;
			}
			$this->column_heading              = get_post_meta( $item->ID, 'column-heading', true );
			$this->megamenu_disable_link       = get_post_meta( $item->ID, 'disable-link', true );
			$this->megamenu_disable_item_label = get_post_meta( $item->ID, 'disable-item-label', true );

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			if ( 0 === $depth && '' != $this->megamenu ) {
				$classes[] = 'kemet-megamenu-item';
				$classes[] = 'mega-menu-' . $this->megamenu_width . '-width';
			}

			if ( ! empty( $item->description ) ) {
				$classes[] = 'has-description';
			}

			if ( $this->column_heading ) {
				$classes[] = 'heading-item';
			}
			if ( $this->megamenu_disable_item_label ) {
				$classes[] = 'disable-item-label';
			}
			$classes[] = 'menu-item-' . $item->ID;

			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param WP_Post  $item  Menu item data object.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

			/**
			 * Filters the CSS classes applied to a menu item's list item element.
			 *
			 * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
			 * @param WP_Post  $item    The current menu item.
			 * @param stdClass $args    An object of wp_nav_menu() arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post  $item    The current menu item.
			 * @param stdClass $args    An object of wp_nav_menu() arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			if ( '_blank' === $item->target && empty( $item->xfn ) ) {
				$atts['rel'] = 'noopener noreferrer';
			} else {
				$atts['rel'] = $item->xfn;
			}
			$atts['href']         = ! empty( $item->url ) ? $item->url : '';
			$atts['aria-current'] = $item->current ? 'page' : '';

			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title        Title attribute.
			 *     @type string $target       Target attribute.
			 *     @type string $rel          The rel attribute.
			 *     @type string $href         The href attribute.
			 *     @type string $aria_current The aria-current attribute.
			 * }
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );

					if ( 'href' === $attr && $item->megamenu_disable_link ) {
						$value = 'javascript:void(0)';
					}

					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', $item->title, $item->ID );

			/**
			 * Filters a menu item's title.
			 *
			 * @param string   $title The menu item's title.
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

			$title_html = '';

			if ( ! empty( $item->description ) ) {

				$title_html = '<span>';

			}

			if ( isset( $item->megamenu_icon ) && ! empty( $item->megamenu_icon ) ) {

				$title_html .= '<span class="dashicons ' . esc_html( $item->megamenu_icon ) . '"></span>' . $item->title;
			} else {

				$title_html .= $item->title;
			}

			if ( isset( $item->megamenu_label ) && ! empty( $item->megamenu_label ) ) {
				$label_bg = ! empty( $item->megamenu_label_bg_color ) ? $item->megamenu_label_bg_color : '#f0f0f0';
				$style    = array(
					'.menu-item-' . $item->ID . ' .kemet-mega-menu-label' => array(
						'color'            => esc_attr( $item->megamenu_label_color ),
						'background-color' => esc_attr( $label_bg ),
					),
				);

				Kemet_Addon_Mega_Menu_Partials::add_css( kemet_parse_css( $style ) );

				$title_html .= '<span class="kemet-mega-menu-label">' . esc_html( $item->megamenu_label ) . '</span>';
			}

			if ( ! empty( $item->description ) ) {

				$title_html .= '</span>';

				$title_html .= '<span class="kemet-menu-decription">' . esc_html( $item->description ) . '</span>';
			}

			$title = $title_html;

			$item_output  = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . $title . $args->link_after;
			$item_output .= '</a>';

			ob_start();
			$content = '';

			if ( false != $this->megamenu && $item->megamenu_enable_template && ! empty( $item->megamenu_column_template ) ) {

				$template_id = explode( '-', $item->megamenu_column_template );
				$content    .= '<div class="kemet-mega-menu-content">';
				if ( class_exists( 'Kemet_Addons_Page_Builder_Compatiblity' ) ) {
					$custom_layout_compat = Kemet_Addons_Page_Builder_Compatiblity::get_instance();
					$custom_layout_compat->render_content( $template_id[1] );
				}
				$content .= ob_get_contents();
				$content .= '</div>';
			}

			ob_end_clean();
			$item_output .= $content;
			$item_output .= $args->after;

			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @param string   $item_output The menu item's starting HTML output.
			 * @param WP_Post  $item        Menu item data object.
			 * @param int      $depth       Depth of menu item. Used for padding.
			 * @param stdClass $args        An object of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @see Walker::end_el()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param WP_Post  $item   Page data object. Not used.
		 * @param int      $depth  Depth of page. Not Used.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function end_el( &$output, $item, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$output .= "</li>{$n}";
		}

	}

}
