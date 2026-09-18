<?php
/**
 * Homepage feature tiles. Whole tile is a link.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$tiles = we_rows( 'features' );
if ( ! $tiles ) {
	return;
}
?>
<section class="we-section we-section--alt we-section--tight">
	<div class="we-container">
		<div class="we-section-head we-section-head--center" data-reveal>
			<?php we_eyebrow( we_f( 'features_eyebrow' ) ); ?>
			<h2 class="we-h-lg"><?php echo esc_html( we_f( 'features_heading' ) ); ?></h2>
		</div>

		<div class="we-feature-grid">
			<?php foreach ( $tiles as $tile ) : ?>
				<?php $link = we_link( $tile['link'], $tile['title'] ); ?>
				<a class="we-feature"<?php echo we_link_attrs( $link ); // phpcs:ignore WordPress.Security.EscapeOutput ?> data-reveal="zoom">
					<?php we_the_image( $tile['image'], $tile['title'], 'large', 'loading="lazy"' ); ?>
					<div class="we-feature__body">
						<h3><?php echo esc_html( $tile['title'] ); ?></h3>
						<p><?php echo esc_html( $tile['text'] ); ?></p>
						<span class="we-feature__pill"><?php echo esc_html( $link['title'] ); ?> <i class="fa-solid fa-arrow-right-long"></i></span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
