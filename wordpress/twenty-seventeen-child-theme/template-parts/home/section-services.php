<?php
/**
 * Homepage services. Each card is a single clickable link. The poster strip
 * scrolls continuously underneath.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$services = we_rows( 'services' );
$posters  = we_rows( 'posters' );
?>
<section class="we-section" id="we-services">
	<div class="we-container">

		<div class="we-section-head we-section-head--center" data-reveal>
			<?php we_eyebrow( we_f( 'services_eyebrow' ) ); ?>
			<h2 class="we-h-lg"><?php echo esc_html( we_f( 'services_heading' ) ); ?></h2>
			<?php if ( we_f( 'services_intro' ) ) : ?>
				<p class="we-lead"><?php echo esc_html( we_f( 'services_intro' ) ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $services ) : ?>
			<div class="we-svc-grid">
				<?php foreach ( $services as $i => $card ) : ?>
					<?php $link = we_link( $card['link'], __( 'Explore service', 'twentyseventeen-child' ) ); ?>
					<a class="we-svc-card"<?php echo we_link_attrs( $link ); // phpcs:ignore WordPress.Security.EscapeOutput ?> data-reveal>
						<span class="we-svc-card__no"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<div class="we-svc-card__icon"><?php we_the_image( $card['icon'], '', 'thumbnail' ); ?></div>
						<h3><?php echo esc_html( $card['title'] ); ?></h3>
						<p><?php echo esc_html( $card['text'] ); ?></p>
						<span class="we-svc-card__link"><?php echo esc_html( $link['title'] ); ?> <i class="fa-solid fa-arrow-right-long"></i></span>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $posters ) : ?>
			<?php // Two identical sets, so the loop has no visible seam. ?>
			<div class="we-marquee" role="group" aria-label="<?php esc_attr_e( 'Our service posters', 'twentyseventeen-child' ); ?>">
				<div class="we-marquee__track">
					<?php for ( $set = 0; $set < 2; $set++ ) : ?>
						<?php foreach ( $posters as $p ) : ?>
							<?php $link = we_link( $p['link'] ); ?>
							<a class="we-marquee__item"<?php echo we_link_attrs( $link ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
								<?php echo $set ? ' aria-hidden="true" tabindex="-1"' : ''; ?>>
								<?php we_the_image( $p['image'], $set ? '' : $p['alt'], 'medium_large', 'loading="lazy"' ); ?>
							</a>
						<?php endforeach; ?>
					<?php endfor; ?>
				</div>
			</div>
		<?php endif; ?>

	</div>
</section>
