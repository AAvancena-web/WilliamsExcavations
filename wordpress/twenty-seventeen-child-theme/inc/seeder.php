<?php
/**
 * One time content seeder.
 *
 * Runs itself once in wp-admin, writes the packaged default content into ACF,
 * then records the version in an option so it never runs again. There is no
 * settings screen and no page to create: bump WE_SEED_VERSION to re-run.
 *
 * It never overwrites a field an editor has already filled in unless the
 * force flag is used, so re-running after adding new fields is safe.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

define( 'WE_SEED_VERSION', '1.0.0' );
define( 'WE_SEED_OPTION', 'we_seed_version' );
define( 'WE_HOME_TEMPLATE', 'page-templates/template-homepage.php' );

/**
 * Find the page to seed: the page using the homepage template, else the
 * configured static front page.
 */
function we_seed_target_page() {
	$found = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'meta_query'     => array(
				array( 'key' => '_wp_page_template', 'value' => WE_HOME_TEMPLATE ),
			),
		)
	);
	if ( $found ) {
		return (int) $found[0];
	}

	$front = (int) get_option( 'page_on_front' );
	return $front ? $front : 0;
}

/** Resolve a seeded media url to an attachment id, falling back to the url. */
function we_seed_media( $value ) {
	if ( ! is_string( $value ) || ! preg_match( '#^https?://#', $value ) ) {
		return $value;
	}
	$id = attachment_url_to_postid( $value );
	if ( ! $id ) {
		// Try the un-scaled original, which WordPress stores for large uploads.
		$id = attachment_url_to_postid( preg_replace( '/-\d+x\d+(\.[a-z]+)$/i', '$1', $value ) );
	}
	return $id ? $id : $value;
}

/** Walk a value and swap any media url for its attachment id. */
function we_seed_prepare( $value ) {
	if ( is_array( $value ) ) {
		foreach ( $value as $k => $v ) {
			// Leave link arrays alone, they hold urls on purpose.
			if ( is_array( $v ) && isset( $v['url'] ) && ( isset( $v['title'] ) || isset( $v['target'] ) ) ) {
				continue;
			}
			$value[ $k ] = we_seed_prepare( $v );
		}
		return $value;
	}
	if ( is_string( $value ) && preg_match( '#^https?://.+\.(jpe?g|png|gif|webp|svg)$#i', $value ) ) {
		return we_seed_media( $value );
	}
	return $value;
}

/**
 * Write one field, skipping anything an editor has already set.
 *
 * @param string   $key     Field name.
 * @param mixed    $value   Value to write.
 * @param int|string $target Post id or 'option'.
 * @param bool     $force   Overwrite existing values.
 */
function we_seed_field( $key, $value, $target, $force = false ) {
	if ( ! $force ) {
		$existing = get_field( $key, $target );
		if ( ! ( null === $existing || '' === $existing || false === $existing || array() === $existing ) ) {
			return false;
		}
	}
	return update_field( $key, we_seed_prepare( $value ), $target );
}

/**
 * Run the seeder.
 *
 * @param bool $force Overwrite values that already exist.
 * @return array Report of what happened.
 */
function we_run_seeder( $force = false ) {
	$report = array( 'page' => 0, 'page_fields' => 0, 'option_fields' => 0, 'skipped' => 0, 'notices' => array() );

	if ( ! function_exists( 'update_field' ) ) {
		$report['notices'][] = __( 'Advanced Custom Fields is not active, so nothing was seeded.', 'twentyseventeen-child' );
		return $report;
	}

	/* Site wide options. */
	foreach ( we_default_options() as $key => $value ) {
		if ( we_seed_field( $key, $value, 'option', $force ) ) {
			$report['option_fields']++;
		} else {
			$report['skipped']++;
		}
	}

	/* Homepage. */
	$page_id = we_seed_target_page();
	if ( ! $page_id ) {
		$report['notices'][] = __( 'No page is using the Homepage Redesign template yet, so the homepage content was not seeded. Assign the template to a page and the seeder will finish on the next admin screen.', 'twentyseventeen-child' );
		return $report;
	}

	$report['page'] = $page_id;
	foreach ( we_default_home() as $key => $value ) {
		if ( we_seed_field( $key, $value, $page_id, $force ) ) {
			$report['page_fields']++;
		} else {
			$report['skipped']++;
		}
	}

	return $report;
}

/** Fire the seeder once per version, in wp-admin only. */
add_action( 'admin_init', 'we_maybe_seed' );
function we_maybe_seed() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( get_option( WE_SEED_OPTION ) === WE_SEED_VERSION ) {
		return;
	}
	if ( ! function_exists( 'update_field' ) ) {
		return; // wait for ACF, do not burn the version
	}

	$report = we_run_seeder( false );

	// Only record the version once the homepage itself was reachable, so the
	// seeder finishes the job after the template is assigned.
	if ( $report['page'] ) {
		update_option( WE_SEED_OPTION, WE_SEED_VERSION, false );
	}

	set_transient( 'we_seed_report_' . get_current_user_id(), $report, 60 );
}

/** Report what the seeder did, once. */
add_action( 'admin_notices', 'we_seed_notice' );
function we_seed_notice() {
	$key    = 'we_seed_report_' . get_current_user_id();
	$report = get_transient( $key );
	if ( ! $report ) {
		return;
	}
	delete_transient( $key );

	$class = $report['notices'] ? 'notice-warning' : 'notice-success';
	echo '<div class="notice ' . esc_attr( $class ) . ' is-dismissible"><p><strong>Williams Excavations:</strong> ';
	printf(
		/* translators: 1: page field count, 2: option field count, 3: skipped count */
		esc_html__( 'seeder wrote %1$d homepage fields and %2$d site wide fields, and left %3$d already filled fields alone.', 'twentyseventeen-child' ),
		(int) $report['page_fields'],
		(int) $report['option_fields'],
		(int) $report['skipped']
	);
	foreach ( $report['notices'] as $notice ) {
		echo ' ' . esc_html( $notice );
	}
	echo '</p></div>';
}

/**
 * Manual re-run: add ?we_reseed=1 to any admin url, or ?we_reseed=force to
 * overwrite values that already exist. Restricted to administrators.
 */
add_action( 'admin_init', 'we_manual_seed', 5 );
function we_manual_seed() {
	if ( empty( $_GET['we_reseed'] ) || ! current_user_can( 'manage_options' ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		return;
	}
	check_admin_referer( 'we_reseed' );

	$force  = ( 'force' === $_GET['we_reseed'] ); // phpcs:ignore WordPress.Security.NonceVerification
	$report = we_run_seeder( $force );
	if ( $report['page'] ) {
		update_option( WE_SEED_OPTION, WE_SEED_VERSION, false );
	}
	set_transient( 'we_seed_report_' . get_current_user_id(), $report, 60 );
}
