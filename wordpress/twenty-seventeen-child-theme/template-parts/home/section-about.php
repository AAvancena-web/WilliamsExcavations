<?php
/**
 * Homepage about block.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$primary   = we_link( we_f( 'about_cta_primary' ) );
$secondary = we_link( we_f( 'about_cta_secondary' ) );
$list      = we_rows( 'about_list' );
?>
<section class="we-section" id="we-about">
	<div class="we-container">
		<div class="we-about-grid">

			<div class="we-about-media" data-reveal="left">
				<div class="we-about-media__frame">
					<?php we_the_image( we_f( 'about_image' ), we_f( 'about_heading' ), 'large', 'loading="lazy"' ); ?>
				</div>
				<?php if ( we_f( 'about_badge_number' ) ) : ?>
					<div class="we-about-badge">
						<strong><?php echo esc_html( we_f( 'about_badge_number' ) ); ?></strong>
						<span><?php echo esc_html( we_f( 'about_badge_label' ) ); ?></span>
					</div>
				<?php endif; ?>
			</div>

			<div class="we-about-copy" data-reveal="right">
				<?php we_eyebrow( we_f( 'about_eyebrow' ) ); ?>
				<h2 class="we-h-lg"><?php echo esc_html( we_f( 'about_heading' ) ); ?></h2>
				<p class="we-lead"><?php echo esc_html( we_f( 'about_lead' ) ); ?></p>
				<p><?php echo esc_html( we_f( 'about_copy' ) ); ?></p>

				<?php if ( $list ) : ?>
					<ul class="we-about-list">
						<?php foreach ( $list as $item ) : ?>
							<li><i class="fa-solid fa-circle-check"></i> <?php echo esc_html( $item['text'] ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<div class="we-hero__ctas" style="margin-top:0">
					<?php if ( $primary['url'] ) : ?>
						<a<?php echo we_link_attrs( $primary ); // phpcs:ignore WordPress.Security.EscapeOutput ?> class="we-btn"><i class="fa-solid fa-users"></i> <?php echo esc_html( $primary['title'] ); ?></a>
					<?php endif; ?>
					<?php if ( $secondary['url'] ) : ?>
						<a<?php echo we_link_attrs( $secondary ); // phpcs:ignore WordPress.Security.EscapeOutput ?> class="we-btn we-btn--dark"><i class="fa-solid fa-phone"></i> <?php echo esc_html( $secondary['title'] ); ?></a>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</section>
