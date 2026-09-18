<?php
/**
 * Homepage hero: copy and buttons on the left, quote form on the right.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$primary   = we_link( we_f( 'hero_cta_primary' ) );
$secondary = we_link( we_f( 'hero_cta_secondary' ) );
?>
<section class="we-hero" id="we-quote">
	<div class="we-hero__bg">
		<?php we_the_image( we_f( 'hero_image' ), '', 'full', 'fetchpriority="high"' ); ?>
	</div>

	<div class="we-container">
		<div class="we-hero__grid">

			<div class="we-hero__content">
				<?php we_eyebrow( we_f( 'hero_eyebrow' ) ); ?>
				<h1>
					<span class="we-line"><span><?php echo esc_html( we_f( 'hero_heading_top' ) ); ?></span></span>
					<span class="we-line"><span><?php echo esc_html( we_f( 'hero_heading_mid' ) ); ?></span></span>
					<span class="we-line"><span class="we-accent"><?php echo esc_html( we_f( 'hero_heading_accent' ) ); ?></span></span>
				</h1>

				<p class="we-hero__copy"><?php echo esc_html( we_f( 'hero_copy' ) ); ?></p>

				<div class="we-hero__ctas">
					<?php if ( $primary['url'] ) : ?>
						<a<?php echo we_link_attrs( $primary ); // phpcs:ignore WordPress.Security.EscapeOutput ?> class="we-btn we-btn--lg">
							<i class="fa-solid fa-clipboard-check"></i> <?php echo esc_html( $primary['title'] ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $secondary['url'] ) : ?>
						<a<?php echo we_link_attrs( $secondary ); // phpcs:ignore WordPress.Security.EscapeOutput ?> class="we-btn we-btn--light we-btn--lg">
							<i class="fa-solid fa-phone"></i> <?php echo esc_html( $secondary['title'] ); ?>
						</a>
					<?php endif; ?>
				</div>

				<?php $trust = we_rows( 'hero_trust' ); ?>
				<?php if ( $trust ) : ?>
					<ul class="we-hero__trust">
						<?php foreach ( $trust as $t ) : ?>
							<li><i class="fa-solid fa-check"></i> <?php echo esc_html( $t['text'] ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<div class="we-quote-card" data-reveal="right">
				<?php if ( we_f( 'hero_form_tag' ) ) : ?>
					<span class="we-quote-card__tag"><?php echo esc_html( we_f( 'hero_form_tag' ) ); ?></span>
				<?php endif; ?>
				<h2><?php echo esc_html( we_f( 'hero_form_heading' ) ); ?></h2>
				<p class="we-quote-card__sub"><?php echo esc_html( we_f( 'hero_form_sub' ) ); ?></p>
				<?php we_form( we_f( 'hero_form_id' ) ); ?>
				<?php if ( we_f( 'hero_form_note' ) ) : ?>
					<p class="we-form-note"><?php echo esc_html( we_f( 'hero_form_note' ) ); ?></p>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
