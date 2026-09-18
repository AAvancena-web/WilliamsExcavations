<?php
/**
 * Homepage guide and FAQ.
 *
 * The intro is centred and full width. Only the opening paragraph shows on
 * load, behind a plain text read more control. Every FAQ answer is always
 * visible, there is no expand and collapse.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$faqs      = we_rows( 'faqs' );
$primary   = we_link( we_f( 'faq_cta_primary' ) );
$secondary = we_link( we_f( 'faq_cta_secondary' ) );
$more      = we_f( 'faq_intro_more' );
?>
<section class="we-section" id="we-faq">
	<div class="we-container">

		<div class="we-section-head we-section-head--center" data-reveal>
			<?php we_eyebrow( we_f( 'faq_eyebrow' ) ); ?>
			<h2 class="we-h-lg"><?php echo esc_html( we_f( 'faq_heading' ) ); ?></h2>
		</div>

		<div class="we-faq-intro" data-reveal>
			<p><?php echo esc_html( we_f( 'faq_intro_lead' ) ); ?></p>

			<?php if ( $more ) : ?>
				<div class="we-faq-intro__more" id="we-introMore" aria-hidden="true">
					<?php echo wp_kses_post( $more ); ?>
				</div>

				<button type="button" class="we-read-more" id="we-introToggle" aria-expanded="false" aria-controls="we-introMore">
					<span class="we-read-more__label"><?php esc_html_e( 'Read More', 'twentyseventeen-child' ); ?></span>
					<i class="fa-solid fa-chevron-down"></i>
				</button>
			<?php endif; ?>

			<div class="we-faq-intro__ctas">
				<?php if ( $primary['url'] ) : ?>
					<a<?php echo we_link_attrs( $primary ); // phpcs:ignore WordPress.Security.EscapeOutput ?> class="we-btn we-btn--lg"><i class="fa-solid fa-clipboard-check"></i> <?php echo esc_html( $primary['title'] ); ?></a>
				<?php endif; ?>
				<?php if ( $secondary['url'] ) : ?>
					<a<?php echo we_link_attrs( $secondary ); // phpcs:ignore WordPress.Security.EscapeOutput ?> class="we-btn we-btn--dark we-btn--lg"><i class="fa-solid fa-phone"></i> <?php echo esc_html( $secondary['title'] ); ?></a>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( $faqs ) : ?>
			<div class="we-faq-heading" data-reveal>
				<h2 class="we-h-md"><?php echo esc_html( we_f( 'faq_list_heading' ) ); ?></h2>
				<span class="we-rule"></span>
			</div>

			<div class="we-faq-grid">
				<?php foreach ( $faqs as $i => $faq ) : ?>
					<article class="we-faq-item" data-reveal>
						<span class="we-faq-item__no"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<h3><?php echo esc_html( $faq['question'] ); ?></h3>
						<?php echo wp_kses_post( $faq['answer'] ); ?>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
