<?php
/**
 * Global header for the redesign.
 *
 * Replaces the Twenty Seventeen header markup entirely, so every page on the
 * site gets the new design. Menus come from the existing `top` nav menu
 * location, so the menu stays editable in Appearance > Menus.
 *
 * @package Twenty_Seventeen_Child
 */

$we_logo  = we_opt( 'opt_logo' );
$we_phone = we_opt( 'opt_phone' );
$we_tel   = 'tel:' . preg_replace( '/\s+/', '', (string) $we_phone );
$we_mail  = we_opt( 'opt_email' );
$we_cta   = we_link( we_opt( 'opt_header_cta' ), __( 'Free Quote', 'twentyseventeen-child' ) );
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="we-progress" id="we-progress"></div>

<a class="skip-link screen-reader-text" href="#we-main"><?php esc_html_e( 'Skip to content', 'twentyseventeen' ); ?></a>

<header class="we-site-header" id="we-siteHeader">

	<div class="we-topbar">
		<div class="we-container">
			<div class="we-topbar-note">
				<i class="fa-solid fa-helmet-safety"></i>
				<span><?php echo esc_html( we_opt( 'opt_topbar_note' ) ); ?></span>
			</div>
			<div class="we-topbar-links">
				<?php if ( $we_phone ) : ?>
					<a href="<?php echo esc_url( $we_tel ); ?>"><i class="fa-solid fa-phone"></i> <?php echo esc_html( $we_phone ); ?></a>
				<?php endif; ?>
				<?php if ( $we_mail ) : ?>
					<a href="mailto:<?php echo esc_attr( $we_mail ); ?>"><i class="fa-solid fa-envelope"></i> <?php echo esc_html( $we_mail ); ?></a>
				<?php endif; ?>
				<?php if ( we_opt( 'opt_address' ) ) : ?>
					<a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>"><i class="fa-solid fa-location-dot"></i> <?php echo esc_html( we_opt( 'opt_address' ) ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="we-headbar">
		<div class="we-container">

			<a class="we-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				<?php we_the_image( $we_logo, get_bloginfo( 'name' ), 'full' ); ?>
			</a>

			<nav class="we-main-nav" aria-label="<?php esc_attr_e( 'Main menu', 'twentyseventeen-child' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'top',
						'container'      => false,
						'depth'          => 2,
						'fallback_cb'    => false,
						'walker'         => new WE_Nav_Walker(),
					)
				);
				?>
			</nav>

			<div class="we-header-cta">
				<a<?php echo we_link_attrs( $we_cta ); // phpcs:ignore WordPress.Security.EscapeOutput ?> class="we-btn we-btn--dark">
					<i class="fa-solid fa-clipboard-check"></i> <?php echo esc_html( $we_cta['title'] ); ?>
				</a>
			</div>

			<?php // Circular phone button, to the left of the hamburger. ?>
			<div class="we-header-actions">
				<a href="<?php echo esc_url( $we_tel ); ?>" class="we-phone-round" aria-label="<?php echo esc_attr( sprintf( __( 'Call us on %s', 'twentyseventeen-child' ), $we_phone ) ); ?>">
					<i class="fa-solid fa-phone"></i>
				</a>
				<button class="we-burger" id="we-burger" aria-label="<?php esc_attr_e( 'Open menu', 'twentyseventeen-child' ); ?>" aria-expanded="false" aria-controls="we-navDrawer">
					<span></span><span></span><span></span>
				</button>
			</div>

		</div>
	</div>
</header>

<div class="we-nav-scrim" id="we-navScrim"></div>

<aside class="we-nav-drawer" id="we-navDrawer" aria-label="<?php esc_attr_e( 'Mobile menu', 'twentyseventeen-child' ); ?>">
	<div class="we-nav-drawer__top">
		<a class="we-nav-drawer__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php we_the_image( $we_logo, get_bloginfo( 'name' ), 'full' ); ?>
		</a>
		<button class="we-drawer-close" id="we-drawerClose" aria-label="<?php esc_attr_e( 'Close menu', 'twentyseventeen-child' ); ?>"><i class="fa-solid fa-xmark"></i></button>
	</div>

	<nav aria-label="<?php esc_attr_e( 'Mobile navigation', 'twentyseventeen-child' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'top',
				'container'      => false,
				'depth'          => 2,
				'fallback_cb'    => false,
				'walker'         => new WE_Drawer_Walker(),
			)
		);
		?>
	</nav>

	<div class="we-drawer-foot">
		<a<?php echo we_link_attrs( $we_cta ); // phpcs:ignore WordPress.Security.EscapeOutput ?> class="we-btn we-btn--block">
			<i class="fa-solid fa-clipboard-check"></i> <?php echo esc_html( $we_cta['title'] ); ?>
		</a>
		<?php if ( $we_phone ) : ?>
			<div class="we-meta"><i class="fa-solid fa-phone"></i> <a href="<?php echo esc_url( $we_tel ); ?>"><?php echo esc_html( $we_phone ); ?></a></div>
		<?php endif; ?>
		<?php if ( $we_mail ) : ?>
			<div class="we-meta"><i class="fa-solid fa-envelope"></i> <a href="mailto:<?php echo esc_attr( $we_mail ); ?>"><?php echo esc_html( $we_mail ); ?></a></div>
		<?php endif; ?>
		<?php if ( we_opt( 'opt_address' ) ) : ?>
			<div class="we-meta"><i class="fa-solid fa-location-dot"></i> <?php echo esc_html( we_opt( 'opt_address' ) ); ?></div>
		<?php endif; ?>
	</div>
</aside>

<div id="we-main" class="we-main">
<?php
// Inner pages carry the banner with the quote form on the right.
// Note: this is a div, not <main>. Twenty Seventeen's page.php opens its own
// <main id="main"> inside it, and main elements cannot nest.
if ( we_is_inner_page() ) {
	get_template_part( 'template-parts/global/inner', 'banner' );
}
