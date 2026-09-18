<?php
/**
 * Homepage project grid. Every tile is the same square size.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$shots = we_rows( 'projects' );
if ( ! $shots ) {
	return;
}
?>
<section class="we-section" id="we-projects">
	<div class="we-container">
		<div class="we-section-head we-section-head--center" data-reveal>
			<?php we_eyebrow( we_f( 'projects_eyebrow' ) ); ?>
			<h2 class="we-h-lg"><?php echo esc_html( we_f( 'projects_heading' ) ); ?></h2>
			<?php if ( we_f( 'projects_intro' ) ) : ?>
				<p class="we-lead"><?php echo esc_html( we_f( 'projects_intro' ) ); ?></p>
			<?php endif; ?>
		</div>

		<div class="we-gallery">
			<?php foreach ( $shots as $shot ) : ?>
				<div class="we-shot" data-reveal="zoom">
					<?php we_the_image( $shot['image'], $shot['caption'], 'medium_large', 'loading="lazy"' ); ?>
					<?php if ( ! empty( $shot['caption'] ) ) : ?>
						<span class="we-shot__cap"><?php echo esc_html( $shot['caption'] ); ?></span>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
