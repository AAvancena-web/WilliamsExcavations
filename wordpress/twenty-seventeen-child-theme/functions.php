<?php
/**
 * Twenty Seventeen child theme functions.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

/* -------------------------------------------------------------------------
 * Redesign
 * ---------------------------------------------------------------------- */

define( 'WE_VERSION', '1.0.0' );

require_once get_stylesheet_directory() . '/inc/defaults.php';
require_once get_stylesheet_directory() . '/inc/helpers.php';
require_once get_stylesheet_directory() . '/inc/nav-walkers.php';
require_once get_stylesheet_directory() . '/inc/acf-fields.php';
require_once get_stylesheet_directory() . '/inc/seeder.php';

/**
 * Styles and scripts.
 *
 * The redesign stylesheet loads after the child stylesheet on purpose, so its
 * base element rules win over the older bare selectors in style.css.
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), WE_VERSION );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ), WE_VERSION );

	wp_enqueue_style(
		'we-fonts',
		'https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'we-redesign',
		get_stylesheet_directory_uri() . '/assets/css/we-redesign.css',
		array( 'child-style' ),
		WE_VERSION
	);

	wp_enqueue_script(
		'we-redesign',
		get_stylesheet_directory_uri() . '/assets/js/we-redesign.js',
		array(),
		WE_VERSION,
		true
	);
}

/**
 * Font Awesome.
 *
 * The site already loads a Font Awesome 5 Pro kit in the old header. The new
 * header uses wp_head(), so it is enqueued properly here instead. Swap the url
 * for the account kit if the Pro licence is still active.
 */
add_action( 'wp_enqueue_scripts', 'we_enqueue_icons' );
function we_enqueue_icons() {
	wp_enqueue_style(
		'we-fontawesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
		array(),
		'6.5.2'
	);
}

/** Body classes that make the redesign easier to target. */
add_filter( 'body_class', 'we_body_class' );
function we_body_class( $classes ) {
	$classes[] = 'we-redesign';
	if ( is_page_template( 'page-templates/template-homepage.php' ) ) {
		$classes[] = 'we-home';
	}
	return $classes;
}

/**
 * Twenty Seventeen wraps page content in a narrow column and prints its own
 * page header. The redesign supplies both, so the front page panels are
 * switched off on the homepage template.
 */
add_filter( 'twentyseventeen_front_page_sections', 'we_disable_front_page_sections' );
function we_disable_front_page_sections( $num ) {
	return is_page_template( 'page-templates/template-homepage.php' ) ? 0 : $num;
}

/* -------------------------------------------------------------------------
 * Existing child theme code, unchanged
 * ---------------------------------------------------------------------- */

// Disable Gutenberg.
if ( version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' ) ) {
	add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );
} else {
	add_filter( 'gutenberg_can_edit_post_type', '__return_false', 10 );
}

register_sidebar(
	array(
		'name'          => __( 'Footer 3', 'twentyseventeen' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	)
);

register_sidebar(
	array(
		'name'          => __( 'Footer 4', 'twentyseventeen' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	)
);

register_sidebar(
	array(
		'name'          => __( 'Footer Top', 'twentyseventeen' ),
		'id'            => 'footer-top',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	)
);

register_sidebar(
	array(
		'name'          => __( 'Menu Top Number', 'twentyseventeen' ),
		'id'            => 'menu-top-number',
		'description'   => __( 'Add widgets here to appear in your top bar.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	)
);

register_sidebar(
	array(
		'name'          => __( 'Header Phone Number', 'twentyseventeen' ),
		'id'            => 'header-p-number',
		'description'   => __( 'Add widgets here to appear in your top bar.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	)
);

if ( file_exists( get_stylesheet_directory() . '/breadcrumbs.php' ) ) {
	include_once get_stylesheet_directory() . '/breadcrumbs.php';
}
