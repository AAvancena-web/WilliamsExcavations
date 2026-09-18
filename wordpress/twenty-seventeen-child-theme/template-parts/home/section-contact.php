<?php
/**
 * Homepage contact block: info cards and map on the left, form on the right.
 * Sits directly above the footer.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$cards = we_rows( 'contact_cards' );
$map   = we_f( 'contact_map' );
?>
<section class="we-section we-section--alt" id="we-contact">
	<div class="we-container">

		<div class="we-section-head we-section-head--center" data-reveal>
			<?php we_eyebrow( we_f( 'contact_eyebrow' ) ); ?>
			<h2 class="we-h-lg"><?php echo esc_html( we_f( 'contact_heading' ) ); ?></h2>
			<?php if ( we_f( 'contact_intro' ) ) : ?>
				<p class="we-lead"><?php echo esc_html( we_f( 'contact_intro' ) ); ?></p>
			<?php endif; ?>
		</div>

		<div class="we-contact-grid">

			<div class="we-contact-aside" data-reveal="left">
				<?php if ( $cards ) : ?>
					<div class="we-info-cards">
						<?php foreach ( $cards as $card ) : ?>
							<div class="we-info-card<?php echo ! empty( $card['wide'] ) ? ' we-info-card--wide' : ''; ?>">
								<i class="<?php echo esc_attr( $card['icon'] ); ?>"></i>
								<div>
									<h4><?php echo esc_html( $card['title'] ); ?></h4>
									<?php if ( ! empty( $card['url'] ) ) : ?>
										<a href="<?php echo esc_url( $card['url'] ); ?>"><?php echo we_nl2br( $card['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
									<?php else : ?>
										<span><?php echo we_nl2br( $card['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( $map ) : ?>
					<div class="we-map-wrap">
						<iframe
							title="<?php esc_attr_e( 'Service area map', 'twentyseventeen-child' ); ?>"
							src="<?php echo esc_url( $map ); ?>"
							loading="lazy"
							referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				<?php endif; ?>
			</div>

			<div class="we-contact-form-card" data-reveal="right">
				<h2 class="we-h-md"><?php echo esc_html( we_f( 'contact_form_heading' ) ); ?></h2>
				<p class="we-quote-card__sub"><?php echo esc_html( we_f( 'contact_form_sub' ) ); ?></p>
				<?php we_form( we_f( 'contact_form_id' ) ); ?>
				<?php if ( we_f( 'contact_form_note' ) ) : ?>
					<p class="we-form-note"><?php echo esc_html( we_f( 'contact_form_note' ) ); ?></p>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
