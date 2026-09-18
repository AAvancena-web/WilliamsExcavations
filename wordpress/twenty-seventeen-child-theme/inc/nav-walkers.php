<?php
/**
 * Navigation walkers for the redesign.
 *
 * Both read the existing `top` menu location, so the menu stays editable
 * under Appearance > Menus.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

/** Desktop menu: adds the caret on parents and the active state. */
class WE_Nav_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<ul class="we-submenu">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$has_children = in_array( 'menu-item-has-children', (array) $item->classes, true );
		$is_current   = in_array( 'current-menu-item', (array) $item->classes, true )
			|| in_array( 'current-menu-ancestor', (array) $item->classes, true );

		$output .= '<li class="' . esc_attr( implode( ' ', array_filter( (array) $item->classes ) ) ) . '">';
		$output .= '<a href="' . esc_url( $item->url ) . '"';
		$output .= $is_current ? ' class="we-is-active" aria-current="page"' : '';
		$output .= $item->target ? ' target="' . esc_attr( $item->target ) . '" rel="noopener"' : '';
		$output .= '>' . esc_html( $item->title );
		if ( $has_children && 0 === $depth ) {
			$output .= ' <i class="fa-solid fa-chevron-down we-caret"></i>';
		}
		$output .= '</a>';
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}

/**
 * Mobile drawer menu.
 *
 * The toggle button sits beside the link rather than inside it, since
 * interactive elements cannot legally nest inside an anchor.
 */
class WE_Drawer_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<ul class="we-submenu-m">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$has_children = in_array( 'menu-item-has-children', (array) $item->classes, true );

		$output .= '<li class="' . esc_attr( implode( ' ', array_filter( (array) $item->classes ) ) ) . '">';

		if ( 0 === $depth ) {
			$output .= '<div class="we-drawer-row">';
			$output .= '<a href="' . esc_url( $item->url ) . '"';
			$output .= $item->target ? ' target="' . esc_attr( $item->target ) . '" rel="noopener"' : '';
			$output .= '>' . esc_html( $item->title ) . '</a>';
			if ( $has_children ) {
				$output .= '<button type="button" class="we-sub-toggle" aria-expanded="false" aria-label="'
					/* translators: %s: menu item title */
					. esc_attr( sprintf( __( 'Toggle %s submenu', 'twentyseventeen-child' ), $item->title ) )
					. '"><i class="fa-solid fa-chevron-down"></i></button>';
			}
			$output .= '</div>';
		} else {
			$output .= '<a href="' . esc_url( $item->url ) . '"';
			$output .= $item->target ? ' target="' . esc_attr( $item->target ) . '" rel="noopener"' : '';
			$output .= '>' . esc_html( $item->title ) . '</a>';
		}
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}
