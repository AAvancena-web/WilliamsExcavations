<?php
/**
 * Template helpers.
 *
 * Every getter falls back to inc/defaults.php, so the templates render
 * correctly before the seeder has run, if ACF is deactivated, or if an editor
 * clears a field by mistake.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

/** True when ACF is available. */
function we_has_acf() {
	return function_exists( 'get_field' );
}

/** Homepage field with fallback to the default content. */
function we_f( $key, $post_id = null ) {
	$value = we_has_acf() ? get_field( $key, $post_id ) : null;
	if ( null === $value || '' === $value || false === $value || array() === $value ) {
		$defaults = we_default_home();
		return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	}
	return $value;
}

/** Options page field with fallback to the default content. */
function we_opt( $key ) {
	$value = we_has_acf() ? get_field( $key, 'option' ) : null;
	if ( null === $value || '' === $value || false === $value || array() === $value ) {
		$defaults = we_default_options();
		return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	}
	return $value;
}

/** Repeater rows, always an array. */
function we_rows( $key, $post_id = null ) {
	$rows = we_f( $key, $post_id );
	return is_array( $rows ) ? $rows : array();
}

/** Options page repeater rows, always an array. */
function we_opt_rows( $key ) {
	$rows = we_opt( $key );
	return is_array( $rows ) ? $rows : array();
}

/**
 * Normalise an image value to url and alt.
 *
 * Accepts an ACF image array, an attachment id, or a plain url, so seeded
 * values and hand entered values behave the same.
 */
function we_image( $value, $size = 'large' ) {
	$out = array( 'url' => '', 'alt' => '', 'width' => '', 'height' => '' );

	if ( is_array( $value ) && isset( $value['url'] ) ) {
		$out['url']    = $value['url'];
		$out['alt']    = isset( $value['alt'] ) ? $value['alt'] : '';
		$out['width']  = isset( $value['width'] ) ? $value['width'] : '';
		$out['height'] = isset( $value['height'] ) ? $value['height'] : '';
		if ( isset( $value['sizes'][ $size ] ) ) {
			$out['url']    = $value['sizes'][ $size ];
			$out['width']  = isset( $value['sizes'][ $size . '-width' ] ) ? $value['sizes'][ $size . '-width' ] : '';
			$out['height'] = isset( $value['sizes'][ $size . '-height' ] ) ? $value['sizes'][ $size . '-height' ] : '';
		}
		return $out;
	}

	if ( is_numeric( $value ) ) {
		$src = wp_get_attachment_image_src( (int) $value, $size );
		if ( $src ) {
			$out['url']    = $src[0];
			$out['width']  = $src[1];
			$out['height'] = $src[2];
			$out['alt']    = (string) get_post_meta( (int) $value, '_wp_attachment_image_alt', true );
		}
		return $out;
	}

	if ( is_string( $value ) && '' !== $value ) {
		$out['url'] = $value;
	}
	return $out;
}

/** Echo an <img> for an image field. */
function we_the_image( $value, $alt = '', $size = 'large', $attr = '' ) {
	$img = we_image( $value, $size );
	if ( ! $img['url'] ) {
		return;
	}
	$alt = $alt ? $alt : $img['alt'];
	printf(
		'<img src="%s" alt="%s"%s%s %s>',
		esc_url( $img['url'] ),
		esc_attr( $alt ),
		$img['width'] ? ' width="' . esc_attr( $img['width'] ) . '"' : '',
		$img['height'] ? ' height="' . esc_attr( $img['height'] ) . '"' : '',
		$attr // phpcs:ignore WordPress.Security.EscapeOutput -- fixed template strings only.
	);
}

/**
 * Normalise an ACF link value.
 *
 * Accepts the ACF link array, a url string, or a row using 'label' and 'url'.
 */
function we_link( $value, $fallback_label = '' ) {
	$out = array( 'url' => '', 'title' => $fallback_label, 'target' => '' );

	if ( is_array( $value ) ) {
		$out['url']    = isset( $value['url'] ) ? $value['url'] : '';
		$out['title']  = ! empty( $value['title'] ) ? $value['title'] : ( ! empty( $value['label'] ) ? $value['label'] : $fallback_label );
		$out['target'] = ! empty( $value['target'] ) ? $value['target'] : '';
	} elseif ( is_string( $value ) ) {
		$out['url'] = $value;
	}
	return $out;
}

/** Attributes for a link, including rel on external targets. */
function we_link_attrs( $link ) {
	$attrs = ' href="' . esc_url( $link['url'] ) . '"';
	if ( ! empty( $link['target'] ) ) {
		$attrs .= ' target="' . esc_attr( $link['target'] ) . '" rel="noopener"';
	}
	return $attrs;
}

/**
 * Render a Contact Form 7 form.
 *
 * Accepts a form post id or a full shortcode. Returns an editor friendly
 * notice when the plugin is missing or no form has been chosen, rather than
 * failing silently.
 */
function we_form( $value ) {
	$value = is_array( $value ) ? reset( $value ) : $value;
	$value = is_object( $value ) && isset( $value->ID ) ? $value->ID : $value;

	if ( empty( $value ) ) {
		if ( current_user_can( 'edit_posts' ) ) {
			echo '<p class="we-form-note">' . esc_html__( 'No Contact Form 7 form selected yet. Choose one in the page fields.', 'twentyseventeen-child' ) . '</p>';
		}
		return;
	}

	if ( ! shortcode_exists( 'contact-form-7' ) ) {
		if ( current_user_can( 'edit_posts' ) ) {
			echo '<p class="we-form-note">' . esc_html__( 'Contact Form 7 is not active.', 'twentyseventeen-child' ) . '</p>';
		}
		return;
	}

	$shortcode = ( false !== strpos( (string) $value, '[' ) )
		? $value
		: sprintf( '[contact-form-7 id="%d"]', (int) $value );

	echo do_shortcode( $shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput -- shortcode output.
}

/** Paragraph safe output for text that may contain line breaks. */
function we_nl2br( $text ) {
	return nl2br( esc_html( $text ) );
}

/** Section eyebrow. Never renders a dash, per the brand guidance. */
function we_eyebrow( $text ) {
	if ( ! $text ) {
		return;
	}
	echo '<span class="we-eyebrow">' . esc_html( $text ) . '</span>';
}

/** True on pages that should show the inner page banner. */
function we_is_inner_page() {
	if ( is_front_page() || is_page_template( 'page-templates/template-homepage.php' ) ) {
		return false;
	}
	return ! is_404();
}
