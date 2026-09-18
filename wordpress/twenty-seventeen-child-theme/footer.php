<?php
/**
 * Global footer for the redesign.
 *
 * @package Twenty_Seventeen_Child
 */

$we_logo  = we_opt( 'opt_logo' );
$we_phone = we_opt( 'opt_phone' );
$we_tel   = 'tel:' . preg_replace( '/\s+/', '', (string) $we_phone );
$we_fcta  = we_link( we_opt( 'opt_footer_cta' ), __( 'Free Quote', 'twentyseventeen-child' ) );
?>
</div><!-- #we-main -->

<?php
/*
 * The guide and FAQ block, then the contact block, are part of the global
 * footer, so they appear on every page. Their content lives on the Site
 * Design options page rather than on any single page.
 */
get_template_part( 'template-parts/global/faq' );
get_template_part( 'template-parts/global/contact' );
?>

<footer class="we-site-footer">
	<div class="we-container">
		<div class="we-footer-grid">

			<div class="we-footer-brand">
				<a class="we-footer-brand__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<?php we_the_image( $we_logo, get_bloginfo( 'name' ), 'full' ); ?>
				</a>
				<p><?php echo esc_html( we_opt( 'opt_footer_about' ) ); ?></p>

				<?php $we_social = we_opt_rows( 'opt_social' ); ?>
				<?php if ( $we_social ) : ?>
					<div class="we-foot-social">
						<?php foreach ( $we_social as $s ) : ?>
							<a href="<?php echo esc_url( $s['url'] ); ?>"
								<?php echo ( 0 === strpos( $s['url'], 'http' ) ) ? ' target="_blank" rel="noopener"' : ''; ?>
								aria-label="<?php echo esc_attr( $s['label'] ); ?>">
								<i class="<?php echo esc_attr( $s['icon'] ); ?>"></i>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<div>
				<h4><?php esc_html_e( 'Quick Links', 'twentyseventeen-child' ); ?></h4>
				<ul class="we-foot-links">
					<?php foreach ( we_opt_rows( 'opt_footer_links' ) as $l ) : ?>
						<li><a href="<?php echo esc_url( $l['url'] ); ?>"><?php echo esc_html( $l['label'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div>
				<h4><?php esc_html_e( 'Services', 'twentyseventeen-child' ); ?></h4>
				<ul class="we-foot-links">
					<?php foreach ( we_opt_rows( 'opt_footer_services' ) as $l ) : ?>
						<li><a href="<?php echo esc_url( $l['url'] ); ?>"><?php echo esc_html( $l['label'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div>
				<h4><?php esc_html_e( 'Contact Info', 'twentyseventeen-child' ); ?></h4>
				<ul class="we-foot-contact">
					<?php foreach ( we_opt_rows( 'opt_footer_contact' ) as $c ) : ?>
						<li>
							<i class="<?php echo esc_attr( $c['icon'] ); ?>"></i>
							<?php if ( ! empty( $c['url'] ) ) : ?>
								<a href="<?php echo esc_url( $c['url'] ); ?>"><?php echo we_nl2br( $c['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
							<?php else : ?>
								<span><?php echo we_nl2br( $c['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
				<a<?php echo we_link_attrs( $we_fcta ); // phpcs:ignore WordPress.Security.EscapeOutput ?> class="we-btn we-btn--block" style="margin-top:6px">
					<i class="fa-solid fa-clipboard-check"></i> <?php echo esc_html( $we_fcta['title'] ); ?>
				</a>
			</div>

		</div>
	</div>

	<div class="we-footer-bottom">
		<div class="we-container">
			<p style="margin:0"><?php echo esc_html( we_opt( 'opt_copyright' ) ); ?></p>
			<p style="margin:0">
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'twentyseventeen-child' ); ?></a>
				&nbsp;|&nbsp;
				<a href="<?php echo esc_url( home_url( '/sitemap/' ) ); ?>"><?php esc_html_e( 'Sitemap', 'twentyseventeen-child' ); ?></a>
			</p>
		</div>
	</div>
</footer>

<button class="we-to-top" id="we-toTop" aria-label="<?php esc_attr_e( 'Scroll back to top', 'twentyseventeen-child' ); ?>"><i class="fa-solid fa-chevron-up"></i></button>

<?php // Floating call button, phones only. ?>
<a href="<?php echo esc_url( $we_tel ); ?>" class="we-call-now" id="we-callNow">
	<i class="fa-solid fa-phone"></i> <?php echo esc_html( we_opt( 'opt_call_label' ) ); ?>
</a>

<?php wp_footer(); ?>
</body>
</html>
