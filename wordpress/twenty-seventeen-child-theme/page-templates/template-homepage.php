<?php
/**
 * Template Name: Homepage Redesign
 * Template Post Type: page
 *
 * Assign this template to a page under Page Attributes > Template. All of its
 * content comes from the Homepage Redesign field group, so no page builder
 * rows are needed.
 *
 * @package Twenty_Seventeen_Child
 */

get_header();

// The guide, FAQ and contact blocks are not listed here: they render in the
// global footer, so they appear on every page rather than the homepage only.
$we_sections = array( 'hero', 'stats', 'services', 'features', 'about', 'process', 'projects', 'reviews', 'cta' );

/**
 * Filter the homepage sections and their order.
 *
 * @param string[] $we_sections Section slugs, rendered in order.
 */
foreach ( apply_filters( 'we_home_sections', $we_sections ) as $we_section ) {
	get_template_part( 'template-parts/home/section', $we_section );
}

get_footer();
