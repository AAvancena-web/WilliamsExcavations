<?php
/**
 * ACF field groups, registered in PHP.
 *
 * Registering in code rather than in the database means the fields ship with
 * the theme, deploy with git, cannot be deleted by accident in wp-admin, and
 * need no JSON sync step between environments.
 *
 * Requires ACF Pro for the repeater field and the options page.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

/** Options page for the global header, footer and inner page banner. */
add_action( 'acf/init', 'we_acf_options_page' );
function we_acf_options_page() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}
	acf_add_options_page(
		array(
			'page_title' => __( 'Site Design Settings', 'twentyseventeen-child' ),
			'menu_title' => __( 'Site Design', 'twentyseventeen-child' ),
			'menu_slug'  => 'we-site-design',
			'capability' => 'manage_options',
			'icon_url'   => 'dashicons-admin-appearance',
			'position'   => 59,
			'redirect'   => false,
		)
	);
}

/** Shorthand for a repeater sub field. */
function we_sub( $name, $label, $type = 'text', $extra = array() ) {
	return array_merge(
		array(
			'key'   => 'field_we_' . $name . '_' . substr( md5( $label . $type ), 0, 8 ),
			'name'  => $name,
			'label' => $label,
			'type'  => $type,
		),
		$extra
	);
}

add_action( 'acf/init', 'we_acf_register_fields' );
function we_acf_register_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$img  = array( 'return_format' => 'array', 'preview_size' => 'medium' );
	$link = array( 'return_format' => 'array' );
	$cf7  = array(
		'type'          => 'post_object',
		'post_type'     => array( 'wpcf7_contact_form' ),
		'return_format' => 'id',
		'allow_null'    => 1,
		'ui'            => 1,
		'instructions'  => __( 'Pick the Contact Form 7 form to render here.', 'twentyseventeen-child' ),
	);

	/* ---------------------------------------------------------------
	 * Homepage
	 * --------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'      => 'group_we_home',
			'title'    => __( 'Homepage Redesign', 'twentyseventeen-child' ),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-templates/template-homepage.php',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'hide_on_screen'        => array( 'the_content' ),
			'active'                => true,
			'description'           => __( 'Content for the redesigned homepage. Leave a field empty to fall back to the packaged default.', 'twentyseventeen-child' ),
			'fields'                => array(

				/* Hero */
				array( 'key' => 'field_we_tab_hero', 'label' => __( 'Hero', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'hero_eyebrow', __( 'Eyebrow', 'twentyseventeen-child' ) ),
				we_sub( 'hero_heading_top', __( 'Heading line 1', 'twentyseventeen-child' ) ),
				we_sub( 'hero_heading_mid', __( 'Heading line 2', 'twentyseventeen-child' ) ),
				we_sub( 'hero_heading_accent', __( 'Heading line 3 (highlighted)', 'twentyseventeen-child' ) ),
				we_sub( 'hero_copy', __( 'Intro copy', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 4, 'new_lines' => '' ) ),
				we_sub( 'hero_image', __( 'Background image', 'twentyseventeen-child' ), 'image', $img ),
				we_sub( 'hero_cta_primary', __( 'Primary button', 'twentyseventeen-child' ), 'link', $link ),
				we_sub( 'hero_cta_secondary', __( 'Secondary button', 'twentyseventeen-child' ), 'link', $link ),
				we_sub( 'hero_trust', __( 'Trust points', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'table',
					'button_label' => __( 'Add point', 'twentyseventeen-child' ),
					'sub_fields'   => array( we_sub( 'text', __( 'Text', 'twentyseventeen-child' ) ) ),
				) ),
				we_sub( 'hero_form_tag', __( 'Form badge', 'twentyseventeen-child' ) ),
				we_sub( 'hero_form_heading', __( 'Form heading', 'twentyseventeen-child' ) ),
				we_sub( 'hero_form_sub', __( 'Form intro', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 3, 'new_lines' => '' ) ),
				we_sub( 'hero_form_id', __( 'Form', 'twentyseventeen-child' ), 'post_object', $cf7 ),
				we_sub( 'hero_form_note', __( 'Form footnote', 'twentyseventeen-child' ) ),

				/* Stats */
				array( 'key' => 'field_we_tab_stats', 'label' => __( 'Stats', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'stats', __( 'Stats', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'table',
					'button_label' => __( 'Add stat', 'twentyseventeen-child' ),
					'sub_fields'   => array(
						we_sub( 'icon', __( 'Icon class', 'twentyseventeen-child' ), 'text', array( 'placeholder' => 'fa-solid fa-award' ) ),
						we_sub( 'number', __( 'Number', 'twentyseventeen-child' ) ),
						we_sub( 'decimals', __( 'Decimals', 'twentyseventeen-child' ), 'number', array( 'default_value' => 0, 'min' => 0, 'max' => 2 ) ),
						we_sub( 'suffix', __( 'Suffix', 'twentyseventeen-child' ) ),
						we_sub( 'label', __( 'Label', 'twentyseventeen-child' ) ),
					),
				) ),

				/* Services */
				array( 'key' => 'field_we_tab_services', 'label' => __( 'Services', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'services_eyebrow', __( 'Eyebrow', 'twentyseventeen-child' ) ),
				we_sub( 'services_heading', __( 'Heading', 'twentyseventeen-child' ) ),
				we_sub( 'services_intro', __( 'Intro', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 3, 'new_lines' => '' ) ),
				we_sub( 'services', __( 'Service cards', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'block',
					'button_label' => __( 'Add service', 'twentyseventeen-child' ),
					'sub_fields'   => array(
						we_sub( 'icon', __( 'Icon', 'twentyseventeen-child' ), 'image', $img ),
						we_sub( 'title', __( 'Title', 'twentyseventeen-child' ) ),
						we_sub( 'text', __( 'Text', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 3, 'new_lines' => '' ) ),
						we_sub( 'link', __( 'Link', 'twentyseventeen-child' ), 'link', $link ),
					),
				) ),
				we_sub( 'posters', __( 'Poster strip', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'block',
					'button_label' => __( 'Add poster', 'twentyseventeen-child' ),
					'instructions' => __( 'Scrolls continuously below the service cards.', 'twentyseventeen-child' ),
					'sub_fields'   => array(
						we_sub( 'image', __( 'Poster', 'twentyseventeen-child' ), 'image', $img ),
						we_sub( 'alt', __( 'Alt text', 'twentyseventeen-child' ) ),
						we_sub( 'link', __( 'Link', 'twentyseventeen-child' ), 'link', $link ),
					),
				) ),

				/* Features */
				array( 'key' => 'field_we_tab_features', 'label' => __( 'Popular', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'features_eyebrow', __( 'Eyebrow', 'twentyseventeen-child' ) ),
				we_sub( 'features_heading', __( 'Heading', 'twentyseventeen-child' ) ),
				we_sub( 'features', __( 'Tiles', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'block',
					'button_label' => __( 'Add tile', 'twentyseventeen-child' ),
					'sub_fields'   => array(
						we_sub( 'image', __( 'Image', 'twentyseventeen-child' ), 'image', $img ),
						we_sub( 'title', __( 'Title', 'twentyseventeen-child' ) ),
						we_sub( 'text', __( 'Text', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 3, 'new_lines' => '' ) ),
						we_sub( 'link', __( 'Link', 'twentyseventeen-child' ), 'link', $link ),
					),
				) ),

				/* About */
				array( 'key' => 'field_we_tab_about', 'label' => __( 'About', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'about_eyebrow', __( 'Eyebrow', 'twentyseventeen-child' ) ),
				we_sub( 'about_heading', __( 'Heading', 'twentyseventeen-child' ) ),
				we_sub( 'about_image', __( 'Image', 'twentyseventeen-child' ), 'image', $img ),
				we_sub( 'about_badge_number', __( 'Badge number', 'twentyseventeen-child' ) ),
				we_sub( 'about_badge_label', __( 'Badge label', 'twentyseventeen-child' ) ),
				we_sub( 'about_lead', __( 'Lead paragraph', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 4, 'new_lines' => '' ) ),
				we_sub( 'about_copy', __( 'Second paragraph', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 4, 'new_lines' => '' ) ),
				we_sub( 'about_list', __( 'Checklist', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'table',
					'button_label' => __( 'Add item', 'twentyseventeen-child' ),
					'sub_fields'   => array( we_sub( 'text', __( 'Text', 'twentyseventeen-child' ) ) ),
				) ),
				we_sub( 'about_cta_primary', __( 'Primary button', 'twentyseventeen-child' ), 'link', $link ),
				we_sub( 'about_cta_secondary', __( 'Secondary button', 'twentyseventeen-child' ), 'link', $link ),

				/* Process */
				array( 'key' => 'field_we_tab_process', 'label' => __( 'Process', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'process_eyebrow', __( 'Eyebrow', 'twentyseventeen-child' ) ),
				we_sub( 'process_heading', __( 'Heading', 'twentyseventeen-child' ) ),
				we_sub( 'process_intro', __( 'Intro', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 3, 'new_lines' => '' ) ),
				we_sub( 'process_steps', __( 'Steps', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'block',
					'button_label' => __( 'Add step', 'twentyseventeen-child' ),
					'sub_fields'   => array(
						we_sub( 'step', __( 'Step label', 'twentyseventeen-child' ) ),
						we_sub( 'title', __( 'Title', 'twentyseventeen-child' ) ),
						we_sub( 'text', __( 'Text', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 2, 'new_lines' => '' ) ),
						we_sub( 'icon', __( 'Icon class', 'twentyseventeen-child' ) ),
					),
				) ),

				/* Projects */
				array( 'key' => 'field_we_tab_projects', 'label' => __( 'Projects', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'projects_eyebrow', __( 'Eyebrow', 'twentyseventeen-child' ) ),
				we_sub( 'projects_heading', __( 'Heading', 'twentyseventeen-child' ) ),
				we_sub( 'projects_intro', __( 'Intro', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 3, 'new_lines' => '' ) ),
				we_sub( 'projects', __( 'Gallery', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'block',
					'button_label' => __( 'Add project', 'twentyseventeen-child' ),
					'instructions' => __( 'Shown as equal squares, so upload images that crop well to a square.', 'twentyseventeen-child' ),
					'sub_fields'   => array(
						we_sub( 'image', __( 'Image', 'twentyseventeen-child' ), 'image', $img ),
						we_sub( 'caption', __( 'Caption', 'twentyseventeen-child' ) ),
					),
				) ),

				/* Reviews */
				array( 'key' => 'field_we_tab_reviews', 'label' => __( 'Reviews', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'reviews_eyebrow', __( 'Eyebrow', 'twentyseventeen-child' ) ),
				we_sub( 'reviews_heading', __( 'Heading', 'twentyseventeen-child' ) ),
				we_sub( 'reviews', __( 'Reviews', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'block',
					'button_label' => __( 'Add review', 'twentyseventeen-child' ),
					'sub_fields'   => array(
						we_sub( 'text', __( 'Review', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 4, 'new_lines' => '' ) ),
						we_sub( 'name', __( 'Name', 'twentyseventeen-child' ) ),
						we_sub( 'location', __( 'Location', 'twentyseventeen-child' ) ),
						we_sub( 'rating', __( 'Stars', 'twentyseventeen-child' ), 'number', array( 'default_value' => 5, 'min' => 1, 'max' => 5 ) ),
					),
				) ),

				/* Quote band */
				array( 'key' => 'field_we_tab_cta', 'label' => __( 'Quote band', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'cta_eyebrow', __( 'Eyebrow', 'twentyseventeen-child' ) ),
				we_sub( 'cta_heading', __( 'Heading', 'twentyseventeen-child' ) ),
				we_sub( 'cta_text', __( 'Text', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 3, 'new_lines' => '' ) ),
				we_sub( 'cta_image', __( 'Background image', 'twentyseventeen-child' ), 'image', $img ),
				we_sub( 'cta_primary', __( 'Primary button', 'twentyseventeen-child' ), 'link', $link ),
				we_sub( 'cta_secondary', __( 'Secondary button', 'twentyseventeen-child' ), 'link', $link ),

				/* Guide and FAQ */
				array( 'key' => 'field_we_tab_faq', 'label' => __( 'Guide and FAQ', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'faq_eyebrow', __( 'Eyebrow', 'twentyseventeen-child' ) ),
				we_sub( 'faq_heading', __( 'Heading', 'twentyseventeen-child' ) ),
				we_sub( 'faq_intro_lead', __( 'Opening paragraph', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 4, 'new_lines' => '' ) ),
				we_sub( 'faq_intro_more', __( 'Hidden behind read more', 'twentyseventeen-child' ), 'wysiwyg', array( 'media_upload' => 0, 'tabs' => 'visual', 'toolbar' => 'basic' ) ),
				we_sub( 'faq_cta_primary', __( 'Primary button', 'twentyseventeen-child' ), 'link', $link ),
				we_sub( 'faq_cta_secondary', __( 'Secondary button', 'twentyseventeen-child' ), 'link', $link ),
				we_sub( 'faq_list_heading', __( 'Questions heading', 'twentyseventeen-child' ) ),
				we_sub( 'faqs', __( 'Questions', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'block',
					'button_label' => __( 'Add question', 'twentyseventeen-child' ),
					'instructions' => __( 'Every answer is always visible. There is no expand and collapse.', 'twentyseventeen-child' ),
					'sub_fields'   => array(
						we_sub( 'question', __( 'Question', 'twentyseventeen-child' ) ),
						we_sub( 'answer', __( 'Answer', 'twentyseventeen-child' ), 'wysiwyg', array( 'media_upload' => 0, 'tabs' => 'visual', 'toolbar' => 'basic' ) ),
					),
				) ),

				/* Contact */
				array( 'key' => 'field_we_tab_contact', 'label' => __( 'Contact', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'contact_eyebrow', __( 'Eyebrow', 'twentyseventeen-child' ) ),
				we_sub( 'contact_heading', __( 'Heading', 'twentyseventeen-child' ) ),
				we_sub( 'contact_intro', __( 'Intro', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 3, 'new_lines' => '' ) ),
				we_sub( 'contact_cards', __( 'Info cards', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'block',
					'button_label' => __( 'Add card', 'twentyseventeen-child' ),
					'sub_fields'   => array(
						we_sub( 'icon', __( 'Icon class', 'twentyseventeen-child' ) ),
						we_sub( 'title', __( 'Title', 'twentyseventeen-child' ) ),
						we_sub( 'text', __( 'Text', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 2, 'new_lines' => '' ) ),
						we_sub( 'url', __( 'Link', 'twentyseventeen-child' ) ),
						we_sub( 'wide', __( 'Full width', 'twentyseventeen-child' ), 'true_false', array( 'ui' => 1 ) ),
					),
				) ),
				we_sub( 'contact_map', __( 'Map embed url', 'twentyseventeen-child' ), 'url', array(
					'instructions' => __( 'The src of a Google Maps embed. The packaged default needs no API key.', 'twentyseventeen-child' ),
				) ),
				we_sub( 'contact_form_heading', __( 'Form heading', 'twentyseventeen-child' ) ),
				we_sub( 'contact_form_sub', __( 'Form intro', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 2, 'new_lines' => '' ) ),
				we_sub( 'contact_form_id', __( 'Form', 'twentyseventeen-child' ), 'post_object', $cf7 ),
				we_sub( 'contact_form_note', __( 'Form footnote', 'twentyseventeen-child' ) ),
			),
		)
	);

	/* ---------------------------------------------------------------
	 * Site wide options
	 * --------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'      => 'group_we_options',
			'title'    => __( 'Site Design Settings', 'twentyseventeen-child' ),
			'location' => array(
				array(
					array( 'param' => 'options_page', 'operator' => '==', 'value' => 'we-site-design' ),
				),
			),
			'fields'   => array(

				array( 'key' => 'field_we_tab_header', 'label' => __( 'Header', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'opt_logo', __( 'Logo', 'twentyseventeen-child' ), 'image', $img ),
				we_sub( 'opt_topbar_note', __( 'Top bar note', 'twentyseventeen-child' ) ),
				we_sub( 'opt_phone', __( 'Phone', 'twentyseventeen-child' ) ),
				we_sub( 'opt_email', __( 'Email', 'twentyseventeen-child' ) ),
				we_sub( 'opt_address', __( 'Address', 'twentyseventeen-child' ) ),
				we_sub( 'opt_header_cta', __( 'Header button', 'twentyseventeen-child' ), 'link', $link ),
				we_sub( 'opt_call_label', __( 'Mobile call button label', 'twentyseventeen-child' ) ),

				array( 'key' => 'field_we_tab_inner', 'label' => __( 'Inner page banner', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'opt_inner_image', __( 'Default banner image', 'twentyseventeen-child' ), 'image', $img ),
				we_sub( 'opt_inner_form_tag', __( 'Form badge', 'twentyseventeen-child' ) ),
				we_sub( 'opt_inner_form_heading', __( 'Form heading', 'twentyseventeen-child' ) ),
				we_sub( 'opt_inner_form_sub', __( 'Form intro', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 3, 'new_lines' => '' ) ),
				we_sub( 'opt_inner_form_id', __( 'Form', 'twentyseventeen-child' ), 'post_object', $cf7 ),
				we_sub( 'opt_inner_form_note', __( 'Form footnote', 'twentyseventeen-child' ) ),

				array( 'key' => 'field_we_tab_footer', 'label' => __( 'Footer', 'twentyseventeen-child' ), 'type' => 'tab' ),
				we_sub( 'opt_footer_about', __( 'About text', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 4, 'new_lines' => '' ) ),
				we_sub( 'opt_social', __( 'Social icons', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'table',
					'button_label' => __( 'Add icon', 'twentyseventeen-child' ),
					'sub_fields'   => array(
						we_sub( 'icon', __( 'Icon class', 'twentyseventeen-child' ) ),
						we_sub( 'url', __( 'Url', 'twentyseventeen-child' ) ),
						we_sub( 'label', __( 'Accessible label', 'twentyseventeen-child' ) ),
					),
				) ),
				we_sub( 'opt_footer_links', __( 'Quick links', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'table',
					'button_label' => __( 'Add link', 'twentyseventeen-child' ),
					'sub_fields'   => array( we_sub( 'label', __( 'Label', 'twentyseventeen-child' ) ), we_sub( 'url', __( 'Url', 'twentyseventeen-child' ) ) ),
				) ),
				we_sub( 'opt_footer_services', __( 'Services links', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'table',
					'button_label' => __( 'Add link', 'twentyseventeen-child' ),
					'sub_fields'   => array( we_sub( 'label', __( 'Label', 'twentyseventeen-child' ) ), we_sub( 'url', __( 'Url', 'twentyseventeen-child' ) ) ),
				) ),
				we_sub( 'opt_footer_contact', __( 'Contact info', 'twentyseventeen-child' ), 'repeater', array(
					'layout'       => 'block',
					'button_label' => __( 'Add line', 'twentyseventeen-child' ),
					'sub_fields'   => array(
						we_sub( 'icon', __( 'Icon class', 'twentyseventeen-child' ) ),
						we_sub( 'text', __( 'Text', 'twentyseventeen-child' ), 'textarea', array( 'rows' => 2, 'new_lines' => '' ) ),
						we_sub( 'url', __( 'Link', 'twentyseventeen-child' ) ),
					),
				) ),
				we_sub( 'opt_footer_cta', __( 'Footer button', 'twentyseventeen-child' ), 'link', $link ),
				we_sub( 'opt_copyright', __( 'Copyright line', 'twentyseventeen-child' ) ),
			),
		)
	);
}
