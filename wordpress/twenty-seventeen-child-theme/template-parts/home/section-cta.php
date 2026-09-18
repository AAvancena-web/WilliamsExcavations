<?php
/**
 * Homepage quote band.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$primary   = we_link( we_f( 'cta_primary' ) );
$secondary = we_link( we_f( 'cta_secondary' ) );
?>
<section class="we-cta-band">
	<div class="we-cta-band__bg">
		<?php we_the_image( we_f( 'cta_image' ), '', 'large', 'loading="lazy"' ); ?>
	</div>
	<div class="we-container">
		<div data-reveal="left">
			<?php we_eyebrow( we_f( 'cta_eyebrow' ) ); ?>
			<h2><?php echo esc_html( we_f( 'cta_heading' ) ); ?></h2>
			<p><?php echo esc_html( we_f( 'cta_text' ) ); ?></p>
		</div>
		<div class="we-cta-band__actions" data-reveal="right">
			<?php if ( $primary['url'] ) : ?>
				<a<?php echo we_link_attrs( $primary ); // phpcs:ignore WordPress.Security.EscapeOutput ?> class="we-btn we-btn--lg"><i class="fa-solid fa-clipboard-check"></i> <?php echo esc_html( $primary['title'] ); ?></a>
			<?php endif; ?>
			<?php if ( $secondary['url'] ) : ?>
				<a<?php echo we_link_attrs( $secondary ); // phpcs:ignore WordPress.Security.EscapeOutput ?> class="we-btn we-btn--light we-btn--lg"><i class="fa-solid fa-phone"></i> <?php echo esc_html( $secondary['title'] ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>
